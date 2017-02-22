<?php defined('BASEPATH') OR exit('No direct script access allowed!');

class Main extends WEB_Controller {

  public function __construct() {
    parent::__construct();
    $this->output->nocache();

    // Check if student already sign in
    if ( ! $studentID = $this->session->userdata('studentID')) {
      redirect('main_authentication/signin');
    }

    // Set default template
    $this->output->set_template('main');

    $this->load->model('classroom_model');
  }

  public function index() {
    redirect('main/apply_notice');
  }

  public function apply_notice() {
    $this->load->model('notice_model');
    $view = array('notice' => $this->notice_model->get_notice());
    $this->load->view('main/apply_notice', $view);
  }

  public function apply_new() {

  }

  public function apply_delete() {

  }

  public function apply_record() {

  }

}