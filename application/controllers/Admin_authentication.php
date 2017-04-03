<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_authentication extends WEB_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('admin_model');
  }
  
  public function index() {
    redirect('admin_authentication/signin');
  }

  public function signin() {
    /* If session already exist, then redirect to the main user page */
    if ($admin_id = $this->session->userdata('id')) { redirect('admin/main/'); }

    $this->load->library('form_validation');
    $view = array('warning_message' => '');

    if ($this->input->post()) {
      $result = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, stream_context_create(array(
        'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query(array('secret' => '6LccyhkUAAAAANbf8MvaQXzTBKexyF8jrsxMxXK2', 'response' => ($this->input->post('grecaptcha'))))
        )
      ))), true);

      if (!$result['success']) {
        $view['warning_message'] = '驗證失敗，是機器人嗎？';
      } else if (($account = $this->input->post('account')) && ($password = $this->input->post('password'))) {
        $this->form_validation->set_rules('account',  'Account',  'trim|required|max_length[255]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[255]');
        /* SHOULD ADD CAPTCHA */
        $this->form_validation->set_error_delimiters('<br>', '');
        if ($this->form_validation->run() == FALSE) {
          $view['warning_message'] = '帳號或密碼錯誤，請再試一次!';
        } else if ( ! $admin = $this->admin_model->admin_signin(trim($account), trim($password))) {
          $view['warning_message'] = '帳號或密碼錯誤，請再試一次!';
        } else redirect('admin/main');
      } elseif ($this->input->post('account') === '' || $this->input->post('password')) {
        $view['warning_message'] = '欄位有空，請再試一次!';
      }
    }

    $this->load->view('authentication/admin_signin_view', $view);
  }

  public function signout() {
    $this->admin_model->admin_signout();
    redirect('admin_authentication/signin');
  }
}