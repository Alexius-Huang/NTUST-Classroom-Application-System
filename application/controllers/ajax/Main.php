<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends WEB_Controller {

  public function __construct() {
    parent::__construct();
    $this->output->nocache();

    // Check if student already sign in
    if ( ! $this->session->userdata('studentID')) {
      redirect('main_authentication/signin');
    }

    $this->load->model('classroom_model');
  }

  public function get_classroom_name() {
    if ($post = $this->input->post() AND $classroom = $this->classroom_model->get_classroom($post['classroom_id'])) {
      header("Content-type: application/json; charset=UTF-8");
      echo json_encode(array('classroomName' => $classroom['name']));
    } else redirect('main/index');
  }

  public function apply_cancel() {
    if ($id = $this->input->post('id')) {
      $this->load->model('apply_model');
      $this->apply_model->check_apply($id, 'cancel');
    } else redirect('main/index');
  }

}