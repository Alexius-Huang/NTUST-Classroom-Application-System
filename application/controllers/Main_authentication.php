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

  public function system($lang = 'zh-TW') {
    $view = array('page' => 'system', 'type' => 'general', 'lang' => $lang);
    $this->load->view('main/system_view', $view);
  }

  public function signin($lang = 'zh-TW') {
    if ($this->session->userdata('studentID')) { redirect('main_authentication/system/'.$lang); }

    $view = array(
      'signin_failure' => FALSE,
      'page' => 'main_signin',
      'lang' => $lang
    );

    if ($post = $this->input->post()) {
      if ( ! is_developing()) {
        $result = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, stream_context_create(array(
          'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query(array('secret' => '6LccyhkUAAAAANbf8MvaQXzTBKexyF8jrsxMxXK2', 'response' => $post['grecaptcha']))
          )
        ))), true);
      }
      if ( ! is_developing() AND ! $result['success']) {
        $view['signin_failure'] = TRUE;
      } else if ($this->main_session_model->verify_student($post['studentID'], $post['password'])) {
        $this->main_session_model->student_signin($post['studentID']);
        redirect('main_authentication/system/'.$lang);
      } else if ($post['studentID'] === 'admin' AND hash('sha256', $post['password']) === "54c588e584ec962d24789908e3c5d139e052e6e6ac3bd80081756910c7c26a4a") {
        $this->main_session_model->admin_signin();
        redirect('main_authentication/system/'.$lang);
      } else $view['signin_failure'] = TRUE;
    }
    $this->load->view('authentication/main_signin_view', $view);
  }

  public function signout($lang = 'zh-TW') {
    $this->main_session_model->student_signout();
    redirect('main_authentication/signin/'.$lang);
  }

  public function classroom_status($lang = 'zh-TW') {
    $view = array('page' => 'classroom_status', 'type' => 'classroom', 'lang' => $lang);

    $this->load->js('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js');
    $this->load->js('assets/datepicker/js/bootstrap-datepicker.min.js');
    $this->load->js('assets/datepicker/locales/bootstrap-datepicker.zh-TW.min.js');
    $this->load->view('main/classroom_status_view', $view);
  }

  public function device_status($lang = 'zh-TW') {
    $view = array('page' => 'device_status', 'type' => 'device', 'lang' => $lang);

    $this->load->js('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js');
    $this->load->js('assets/datepicker/js/bootstrap-datepicker.min.js');
    $this->load->js('assets/datepicker/locales/bootstrap-datepicker.zh-TW.min.js');
    $this->load->view('main/device_status_view', $view);
  }
}