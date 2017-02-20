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

    $this->load->model('classroom_model');
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

    $view['table_columns'] = array(
      'name'     => array('name' => '場地名稱', 'class' => ''),
      'disabled' => array('name' => '狀態',    'class' => 'hidden-xs'),
      'toggle'   => array('name' => '切換狀態', 'class' => ''),
      'config'   => array('name' => '設定',    'class' => '')
    );
    $view['classrooms'] = $this->classroom_model->get_classrooms();
    $this->load->view('admin/classroom_view', $view);
  }

  public function classroom_edit($id = '0') {
    if ($id === '0') { redirect(base_url().'admin/classroom'); }
    $view = array(
      'username' => 'admin',
      'page' => 'classroom_edit'
    );
    $this->load->view('admin/classroom_edit_view', $view);
  }

}