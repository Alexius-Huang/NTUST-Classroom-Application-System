<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends WEB_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->output->nocache();

    // Check if admin already sign in
    if ( ! $this->session->userdata('id')) {
      redirect('admin_authentication/signin');
    }

    $this->load->model('classroom_model');
    $this->load->model('apply_model');
  }

  public function create_classroom() {
    if ($name = $this->input->post('classroomName')) {
      $this->classroom_model->create_classroom(array('name' => $name));
    }
  }

  public function switch_classroom_state($classroom_id = '0') {
    if ($classroom_id === '0' || ! $classroom = $this->classroom_model->get_classroom($classroom_id)) {
      redirect(base_url() . 'admin');
    } else {
      $update = array('disabled' => ($classroom['disabled'] == 0 ? 1 : 0));
      $this->classroom_model->update_classroom($update, $classroom_id);
    }
  }

  public function change_classroom_name($classroom_id = '0') {
    if ($classroom_id === '0' || ! $classroom = $this->classroom_model->get_classroom($classroom_id)) {
      redirect(base_url() . 'admin');
    } else $this->classroom_model->update_classroom(array('name' => $this->input->post('name')), $classroom_id);
  }

  public function delete_classroom($classroom_id = '0') {
    if ($classroom_id === '0' || ! $classroom = $this->classroom_model->get_classroom($classroom_id)) {
      redirect(base_url() . 'admin');
    } else $this->classroom_model->delete_classroom($classroom_id);
  }

  public function delete_classroom_rules_by_classroom_id($classroom_id = '0') {
    if ($classroom_id === '0' || ! $classroom = $this->classroom_model->get_classroom($classroom_id)) {
      redirect(base_url() . 'admin');
    } else foreach($this->classroom_model->get_classroom_rules_by_classroom_id($classroom_id) as $rule) {
      $this->classroom_model->delete_classroom_rule($rule['id']);
    }
  }

  public function delete_classroom_rule($classroom_rule_id = '0') {
    if ($classroom_rule_id === '0' || ! $classroom_rule = $this->classroom_model->get_classroom_rule($classroom_rule_id)) {
      redirect(base_url().'admin');
    } else $this->classroom_model->delete_classroom_rule($classroom_rule_id);
  }

  public function check_application() {
    if (  $id = $this->input->post('id')
      AND $mode = $this->input->post('mode')
      AND $apply = $this->apply_model->get_apply($id)
    ) {
      /* Manipulate with the apply first */
      $this->apply_model->check_apply($id, $mode);

      if ($mode === 'approve') {
        /* Reject other conflict applies when approved */
        foreach (TIME_ARRAY as $time) {
          if ($apply['time'.$time] == 1) {
            $potential_applies = $this->apply_model->get_applies(array(
              'classroom_id' => $apply['classroom_id'],
              'status'       => '0',
              'time'.$time   => '1',
              'date'         => $apply['date']
            ));
            if ( ! empty($potential_applies)) {
              foreach ($potential_applies as $reject_apply) {
                $this->apply_model->check_apply($reject_apply['id'], 'reject');
              }
            }
          }
        }
      }
    } else redirect('admin/main');
  }

  public function check_applications() {
    if ($idArray = $this->input->post('idArray') AND sort($idArray)) {
      $result = array('approved' => array(), 'rejected' => array());
      foreach ($idArray as $id) {
        if ($apply = $this->apply_model->get_apply($id) AND $apply['status'] == '0') {
          
          /* Approve the apply first */
          $this->apply_model->check_apply($id, 'approve');
          $result['approved'][] = $id;

          /* Reject other conflict applies */
          foreach (TIME_ARRAY as $time) {
            if ($apply['time'.$time] == 1) {
              $potential_applies = $this->apply_model->get_applies(array(
                'classroom_id' => $apply['classroom_id'],
                'status'       => '0',
                'time'.$time   => '1',
                'date'         => $apply['date']
              ));
              if ( ! empty($potential_applies)) {
                foreach ($potential_applies as $reject_apply) {
                  $this->apply_model->check_apply($reject_apply['id'], 'reject');
                }
              }
            }
          }
        } elseif ($apply['status'] === '4') {
          $result['rejected'][] = $id;
        } else continue;
      }

      echo json_encode($result);
    } else redirect('admin/main');
  }

}