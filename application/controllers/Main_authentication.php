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
    redirect(base_url().'main_authentication/signin');
  }

  public function signin() {
    $view = array(
      'signin_failure' => FALSE,
      'page' => 'main_signin'
    );

    if ($post = $this->input->post()) {
      if ($this->main_session_model->verify_student($post['studentID'], $post['password'])) {
        $this->main_session_model->student_signin($post['studentID']);
        redirect('main/apply_notice');
      } else if ($post['studentID'] === 'admin' AND hash('sha256', $post['password']) === "99839c1a6247bcc93f415af711aba9ddc76af965d10358a90474e7f143542a50") {
        $this->main_session_model->admin_signin();
      } else $view['signin_failure'] = TRUE;
    }
    $this->load->view('authentication/main_signin_view', $view);
  }

  public function signout() {
    $this->main_session_model->student_signout();
    redirect('main_authentication/signin');
  }

  // 教室借用狀態
  public function classroom_status() {
    $view = array('page' => 'classroom_status');

    $this->load->js('http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js');
    $this->load->js('assets/datepicker/js/bootstrap-datepicker.min.js');
    $this->load->js('assets/datepicker/locales/bootstrap-datepicker.zh-TW.min.js');
    $this->load->view('main/classroom_status_view', $view);
  }
}