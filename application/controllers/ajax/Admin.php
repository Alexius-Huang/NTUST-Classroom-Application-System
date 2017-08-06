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
    $this->load->model('device_model');
    $this->load->model('apply_model');
    $this->load->model('device_apply_model');
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

  public function switch_device_state($device_id = '0') {
    if ($device_id === '0' || ! $device = $this->device_model->get_device($device_id)) {
      redirect(base_url() . 'admin');
    } else {
      $update = array('disabled' => ($device['disabled'] == 0 ? 1 : 0));
      $this->device_model->update_device($update, $device_id);

      $device_logs = $this->device_apply_model->get_device_logs(array('device_id' => $device['id']));
      foreach ($device_logs as $log) {
        $apply = $this->device_apply_model->get_device_apply($log['device_apply_id']);
        if ($apply['status'] == 0) {
          $this->device_apply_model->check_device_apply($apply['id'], 'reject');
          $this->device_apply_model->update_device_reject_due_to_disabled($apply['id'], $device['id']);
        }
      }
    }
  }

  public function change_classroom_name($classroom_id = '0') {
    if ($classroom_id === '0' || ! $classroom = $this->classroom_model->get_classroom($classroom_id)) {
      redirect(base_url() . 'admin');
    } else $this->classroom_model->update_classroom(array('name' => $this->input->post('name')), $classroom_id);
  }

  public function change_device_name($device_id = '0') {
    if ($device_id === '0' || ! $device = $this->device_model->get_device($device_id)) {
      redirect(base_url() . 'admin');
    } else $this->device_model->update_device(array('name_zh-TW' => $this->input->post('name_zh-TW'), 'name_en-us' => $this->input->post('name_en-us')), $device_id);
  }

  public function delete_classroom() {
    if ( ! $classroom = $this->classroom_model->get_classroom($this->input->post('id'))) {
      redirect(base_url() . 'admin');
    } else $this->classroom_model->delete_classroom($classroom['id']);
  }

  public function delete_device() {
    if ( ! $device = $this->device_model->get_device($this->input->post('id'))) {
      redirect(base_url() . 'admin');
    } else {
      /* Should reject the pending applications which contains the device */
      $device_logs = $this->device_apply_model->get_device_logs(array('device_id' => $device['id']));
      foreach ($device_logs as $log) {
        $apply = $this->device_apply_model->get_device_apply($log['device_apply_id']);
        if ($apply['status'] == '0' AND $apply['date'] > today()) {
          $this->device_apply_model->check_device_apply($apply['id'], 'reject');
          $this->device_apply_model->update_device_reject_due_to_deleted($apply['id'], $device['id']);
        }
      }

      $this->device_model->delete_device($device['id']); 
    }
  }

  public function delete_classroom_rules_by_classroom_id() {
    if ( ! $classroom = $this->classroom_model->get_classroom($this->input->post('id'))) {
      redirect(base_url() . 'admin');
    } else foreach($this->classroom_model->get_classroom_rules_by_classroom_id($classroom['id']) as $rule) {
      $this->classroom_model->delete_classroom_rule($rule['id']);
    }
  }

  public function delete_classroom_rule() {
    if ( ! $classroom_rule = $this->classroom_model->get_classroom_rule($this->input->post('id'))) {
      redirect(base_url().'admin');
    } else $this->classroom_model->delete_classroom_rule($classroom_rule['id']);
  }

  public function get_conflicted_applications() {
    if ($id = $this->input->post('application_id')) {
      $application = $this->apply_model->get_apply($id);
      $conflicted_ids = array();
      $conflicted = array();
      foreach (CLASSROOM_TIME_ARRAY_KEYS as $time) {
        $where = array(
          'classroom_id' => $application['classroom_id'],
          'time'.$time => '1',
          'date' => $application['date'],
          'status' => '0'
        );
        if ($application['time'.$time] == 1 AND $conflicted_applications = $this->apply_model->get_applies($where)) {
          foreach ($conflicted_applications as $ca) {
            if ( ! in_array($ca['id'], $conflicted_ids) AND $application['id'] != $ca['id']) {
              $conflicted_ids[] = $ca['id'];
              $ca['classroom'] = $this->classroom_model->get_classroom($ca['classroom_id']);
              $ca['time'] = classroom_rule_display_time($ca);
              $conflicted[] = $ca;
            }
          }
        }
      }
      echo json_encode($conflicted);
    }
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
        foreach (CLASSROOM_TIME_ARRAY_KEYS as $time) {
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
          foreach (CLASSROOM_TIME_ARRAY_KEYS as $time) {
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

  public function get_device_info() {
    if ($device_apply_id = $this->input->post('id')) {
      $logs = $this->device_apply_model->get_device_logs_by_device_apply($device_apply_id);
      $devices = array();
      foreach ($logs as $log) {
        $device = $this->device_model->get_device($log['device_id'], TRUE);
        $devices[$device['id']] = $device;
        $devices[$device['id']]['lease_count'] = $log['lease_count'];
      }
      echo json_encode($devices);
    }
  }

  public function check_device_application() {
    if ($id = $this->input->post('id') AND $mode = $this->input->post('mode')) {
      $this->device_apply_model->check_device_apply($id, $mode);

      $device_apply = $this->device_apply_model->get_device_apply($id);
      $device_logs = $this->device_apply_model->get_device_logs_by_device_apply($id);
      foreach ($device_logs as $device_log) {
        $device = $this->device_model->get_device($device_log['device_id']);
        
        $date = $device_apply['date'];
        $end_date = $device_apply['end_date'];
        while (strtotime($date) <= strtotime($end_date)) {
          $available_count = $device['total_count'];

          $approved_applies = $this->device_apply_model->get_device_applies(array(
            'date <=' => $date,
            'end_date >=' => $date,
            'status' => '1'
          ));
          
          foreach ($approved_applies as $apply) {
            $logs = $this->device_apply_model->get_device_logs_by_device_apply($apply['id']);
            foreach ($logs as $log) {
              if ($log['device_id'] == $device['id']) {
                $available_count -= $log['lease_count'];
                break;
              }
            }
          }

          $pending_applies = $this->device_apply_model->get_device_applies(array(
            'date <=' => $date,
            'end_date >=' => $date,
            'status' => '0'
          ));

          foreach ($pending_applies as $apply) {
            $logs = $this->device_apply_model->get_device_logs_by_device_apply($apply['id']);
            foreach ($logs as $log) {
              if ($log['device_id'] == $device['id']) {
                if ($available_count < $log['lease_count']) {
                  $this->device_apply_model->check_device_apply($apply['id'], 'reject');
                }
                break;
              }
            }
          }

          $date = date('Y-m-d', strtotime("+1 day", strtotime($date)));
        }
      }
    } else redirect('admin/main');
  }

}