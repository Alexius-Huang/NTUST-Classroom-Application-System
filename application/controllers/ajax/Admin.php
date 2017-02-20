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

  public function destroy_classroom($classroom_id = '0') {
    if ($classroom_id === '0' || ! $classroom = $this->classroom_model->get_classroom($classroom_id)) {
      redirect(base_url() . 'admin');
    } else $this->classroom_model->delete_classroom($classroom_id);
  }
}