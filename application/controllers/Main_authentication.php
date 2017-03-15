<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_authentication extends WEB_Controller {
  
  public function __construct() {
    parent::__construct();
    
    // Set default template
    $this->output->set_template('main');

    // Load default model
    $this->load->model('main_session_model');
  }

  public function index($lang = 'zh-TW') {
    redirect(base_url().'main_authentication/signin/'.$lang);
  }

  public function signin($lang = 'zh-TW') {
    if ($this->session->userdata('studentID')) { redirect('main'); }

    $view = array(
      'signin_failure' => FALSE,
      'page' => 'main_signin',
      'lang' => $lang
    );

    if ($post = $this->input->post()) {
      if ($this->main_session_model->verify_student($post['studentID'], $post['password'])) {
        $this->main_session_model->student_signin($post['studentID']);
        redirect('main/apply_notice/'.$lang);
      } else if ($post['studentID'] === 'admin' AND hash('sha256', $post['password']) === "937e8d5fbb48bd4949536cd65b8d35c426b80d2f830c5c308e2cdec422ae2244") {
        $this->main_session_model->admin_signin();
        redirect('main/apply_notice/'.$lang);
      } else $view['signin_failure'] = TRUE;
    }
    $this->load->view('authentication/main_signin_view', $view);
  }

  public function signout($lang = 'zh-TW') {
    $this->main_session_model->student_signout();
    redirect('main_authentication/signin/'.$lang);
  }

  // 教室借用狀態
  public function classroom_status($lang = 'zh-TW') {
    $view = array('page' => 'classroom_status', 'lang' => $lang);

    $this->load->js('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js');
    $this->load->js('assets/datepicker/js/bootstrap-datepicker.min.js');
    $this->load->js('assets/datepicker/locales/bootstrap-datepicker.zh-TW.min.js');
    $this->load->view('main/classroom_status_view', $view);
  }
}