<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends WEB_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->output->nocache();

    // Check if admin already sign in
    if ( ! $this->session->userdata('id')) {
      redirect('admin_authentication/signin');
    }

    // Set default template
    $this->output->set_template('admin');

  }

  public function main() {
    $view = array(
      'username' => 'admin',
      'page' => 'main'
    );
    $this->load->view('admin/main_view', $view);
  }

  public function apply() {
    $view = array(
      'username' => 'admin',
      'page' => 'apply'
    );
    $this->load->view('admin/apply_view', $view);
  }

  public function application() {
    $view = array(
      'username' => 'admin',
      'page' => 'application'
    );
    $this->load->view('admin/application_view', $view);
  }

  public function notice() {
    $view = array(
      'username' => 'admin',
      'page' => 'notice'
    );
    $this->load->view('admin/notice_view', $view);
  }

  public function classroom() {
    $view = array(
      'username' => 'admin',
      'page' => 'classroom'
    );
    $this->load->view('admin/classroom_view', $view);
  }

  public function config() {
    $view = array(
      'username' => 'admin',
      'page' => 'config'
    );
    $this->load->view('admin/config_view', $view);
  }

}