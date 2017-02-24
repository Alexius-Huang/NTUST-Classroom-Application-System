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
    if ($id = $this->input->post('id') AND $mode = $this->input->post('mode')) {
      $this->apply_model->check_apply($id, $mode);
    } else redirect('admin/main');
  }

  public function check_applications() {
    if ($idArray = $this->input->post('idArray') AND $mode = $this->input->post('mode')) {
      $this->apply_model->check_applies($idArray, $mode);
    } else redirect('admin/main');
  }

}