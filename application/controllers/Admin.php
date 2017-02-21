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
    $view['classroom'] = $this->classroom_model->get_classroom($id);
    $this->load->view('admin/classroom_edit_view', $view);
  }

  public function classroom_rule_create($id = '0') {
    if ($id === '0') { redirect(base_url().'admin/classroom'); }
    
    if ($post = $this->input->post()) {
      $insert = array();
      $insert['classroom_id'] = $id;
      $insert['type'] = $post['rule-type'];
      switch($post['rule-type']) {
        case '0':
          $insert['start']   = $post['date'];
          $insert['end']     = NULL;
          $insert['weekday'] = 0;
          break;
        case '1':
          $insert['start']   = $post['date-start'];
          $insert['end']     = $post['date-end'];
          $insert['weekday'] = 0;
          break;
        case '2':
          $insert['start']   = $post['date-start'];
          $insert['end']     = $post['date-end'];
          $insert['weekday'] = 0;
          foreach ($post['weekday'] as $weekday) {
            switch($weekday) {
              case '日': $insert['weekday'] +=  1; break;
              case '一': $insert['weekday'] +=  2; break;
              case '二': $insert['weekday'] +=  4; break;
              case '三': $insert['weekday'] +=  8; break;
              case '四': $insert['weekday'] += 16; break;
              case '五': $insert['weekday'] += 32; break;
              case '六': $insert['weekday'] += 64; break;
            }
          }
          break;
      }

      $timeArray = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D'];
      foreach ($timeArray as $time) { $insert['time'.$time] = in_array($time, $post['time']) ? 1 : 0; }
    
      if ($this->classroom_model->create_classroom_rule($insert)) { redirect(base_url().'admin/classroom_edit/'.$id ); }
    }
    
    $view = array(
      'username' => 'admin',
      'page' => 'classroom_rule_create'
    );
    
    $view['classroom'] = $this->classroom_model->get_classroom($id);
    $this->load->css('assets/datepicker/css/bootstrap-datepicker.min.css');
    $this->load->js('assets/datepicker/js/bootstrap-datepicker.min.js');
    $this->load->js('assets/datepicker/locales/bootstrap-datepicker.zh-TW.min.js');
    $this->load->view('admin/classroom_rule_create_view', $view);
  }

}