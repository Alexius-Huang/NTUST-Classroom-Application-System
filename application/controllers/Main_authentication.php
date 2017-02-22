<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_authentication extends WEB_Controller {
  
  public function __construct() {
    parent::__construct();
    
    // Set default template
    $this->output->set_template('main');

    // Load default model
    $this->load->model('main_session_model');
  }

  public function index() {
    redirect(base_url() . 'main_authentication/signin');
  }

  public function signin() {
    $view = array('signin_failure' => FALSE);

    if ($post = $this->input->post()) {
      if ($this->main_session_model->verify_student($post['studentID'], $post['password'])) {
        $this->main_session_model->student_signin($post['studentID']);
        redirect('main/apply_notice');
      } else $view['signin_failure'] = TRUE;
    }
    $this->load->view('authentication/main_signin_view', $view);
  }

  public function signout() {
    $this->main_session_model->student_signout();
    redirect(base_url());
  }

  // 教室借用狀態
  public function classroom_status() {
  }
}