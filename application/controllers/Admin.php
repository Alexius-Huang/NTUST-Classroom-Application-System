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
    $this->load->model('device_model');
    $this->load->model('apply_model');
    $this->load->model('device_apply_model');
  }

  public function index() {
    redirect('admin/main');
  }

  public function main() {
    $view = array(
      'username' => 'admin',
      'page' => 'main',
      'await_applies' => $this->apply_model->get_applies(array('status' => '0', 'date >' => today())),
      'available_classroom' => $this->classroom_model->get_classrooms(array('disabled' => '0')),
      'classrooms' => $this->classroom_model->get_classrooms(),
      'applies_in_current_month' => $this->apply_model->get_applies(array('month(date)' => date('m'), 'year(date)' => date('Y'))),
      'applies_approved_in_current_month' => $this->apply_model->get_applies(array('status' => '1', 'month(date)' => date('m'), 'year(date)' => date('Y'))),
      'applies_in_history' => $this->apply_model->get_applies(),
      'applies_approved_in_history' => $this->apply_model->get_applies(array('status' => '1'))
    );
    $this->load->view('admin/main_view', $view);
  }

  public function apply() {
    $view = array(
      'username' => 'admin',
      'page' => 'apply',
      'applies' => $this->apply_model->get_applies(array('status' => '0', 'date >=' => today()))
    );

    /* Outdated classroom applications should be rejected */
    $outdated = $this->apply_model->get_applies(array('status' => '0', 'date <' => today()));
    if ( ! empty($outdated)) {
      foreach ($outdated as $apply) {
        $this->apply_model->check_apply($apply['id'], 'reject');
      } 
    }

    foreach ($view['applies'] as $index => $apply) {
      if ($classroom = $this->classroom_model->get_classroom($apply['classroom_id'])) {
        $view['applies'][$index]['classroom'] = $classroom;
      } else $view['applies'][$index]['classroom']['name'] = 'N/A';
    }

    $this->load->js('assets/plugins/datatables/jquery.dataTables.min.js');
    $this->load->js('assets/plugins/datatables/dataTables.bootstrap.min.js');
    $this->load->view('admin/apply_view', $view);
  }

  public function application($year_month = '0') {
    if ($year_month === '0' OR ! validate_date($year_month, 'Y-m')) { $year_month = date('Y-m'); }

    $view = array(
      'username' => 'admin',
      'page' => 'application',
      'year_month' => $year_month,
      'applies' => $this->apply_model->get_applies(array('date >' => $year_month.'-01', 'date <' => date('Y-m', strtotime($year_month.' + 1 month')).'-01'))
    );
    
    foreach ($view['applies'] as $index => $apply) {
      $view['applies'][$index]['classroom'] = $this->classroom_model->get_classroom($apply['classroom_id']);
      if (empty($view['applies'][$index]['classroom']['name'])) { $view['applies'][$index]['classroom']['name'] = 'N/A'; }
    }

    $this->load->view('admin/application_view', $view);
  }

  public function device_application($year_month = '0') {
    if ($year_month === '0' OR ! validate_date($year_month, 'Y-m')) { $year_month = date('Y-m'); }

    $view = array(
      'username' => 'admin',
      'page' => 'device_application',
      'year_month' => $year_month,
      'applies' => $this->device_apply_model->get_device_applies(array('date >' => $year_month.'-01', 'date <' => date('Y-m', strtotime($year_month.' + 1 month')).'-01'))
    );

    $this->load->view('admin/device_application_view', $view);
  }

  public function classroom() {
    $view = array(
      'username' => 'admin',
      'page' => 'classroom',
      'classrooms' => $this->classroom_model->get_classrooms()
    );

    $view['table_columns'] = array(
      'name'     => array('name' => '場地名稱', 'class' => ''),
      'disabled' => array('name' => '狀態',    'class' => 'hidden-xs'),
      'toggle'   => array('name' => '切換狀態', 'class' => ''),
      'config'   => array('name' => '設定',    'class' => '')
    );
    $this->load->view('admin/classroom_view', $view);
  }

  public function classroom_edit($id = '0') {
    if ($id === '0' OR ( ! $classroom = $this->classroom_model->get_classroom($id))) { redirect(base_url().'admin/classroom'); }
    $view = array(
      'username' => 'admin',
      'page' => 'classroom_edit'
    );
    $view['classroom'] = $classroom;
    $view['classroom_rules'] = $this->classroom_model->get_classroom_rules_by_classroom_id($id);
    $this->load->view('admin/classroom_edit_view', $view);
  }

  public function classroom_rule_create($id = '0') {
    if ($id === '0' OR ( ! $classroom = $this->classroom_model->get_classroom($id))) { redirect(base_url().'admin/classroom'); }
    
    if ($post = $this->input->post()) {
      $insert = array();
      $insert['classroom_id'] = $id;
      $insert['type'] = $post['rule-type'];
      $insert['purpose'] = $post['purpose'];

      $weekdayArray = array();
      switch((int) $post['rule-type']) {
        case 0:
          $insert['start']   = $post['date'];
          $insert['end']     = NULL;
          $insert['weekday'] = 0;
          break;
        case 1:
          $insert['start']   = $post['date-start'];
          $insert['end']     = $post['date-end'];
          $insert['weekday'] = 0;
          break;
        case 2:
          $insert['start']   = $post['date-start'];
          $insert['end']     = $post['date-end'];
          $insert['weekday'] = 0;
          foreach ($post['weekday'] as $weekday) {
            switch($weekday) {
              case '日': $insert['weekday'] +=  1; $weekdayArray[] = 0; break;
              case '一': $insert['weekday'] +=  2; $weekdayArray[] = 1; break;
              case '二': $insert['weekday'] +=  4; $weekdayArray[] = 2; break;
              case '三': $insert['weekday'] +=  8; $weekdayArray[] = 3; break;
              case '四': $insert['weekday'] += 16; $weekdayArray[] = 4; break;
              case '五': $insert['weekday'] += 32; $weekdayArray[] = 5; break;
              case '六': $insert['weekday'] += 64; $weekdayArray[] = 6; break;
            }
          }
          break;
      }

      $this->load->model('apply_model');

      foreach (CLASSROOM_TIME_ARRAY_KEYS as $time) {
        $insert['time'.$time] = in_array($time, $post['time']) ? 1 : 0;
        if ($insert['time'.$time] == 1) {
          switch($post['rule-type']) {
            case 0:
              $potential_applies = $this->apply_model->get_classroom_applies_with_date($id, $post['date'], array('time'.$time => 1));
              if ( ! empty($potential_applies)) {
                foreach ($potential_applies as $apply) { $this->apply_model->check_apply($apply['id'], 'reject'); }
              }
              break;
            case 1:
              $date = $post['date-start'];
              $end_date = $post['date-end'];
              while (strtotime($date) <= strtotime($end_date)) {
                $potential_applies = $this->apply_model->get_classroom_applies_with_date($id, $date, array('time'.$time => 1));
                if ( ! empty($potential_applies)) {
                  foreach ($potential_applies as $apply) { $this->apply_model->check_apply($apply['id'], 'reject'); }
                }
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
              }
              break;
            case 2:
              $date = $post['date-start'];
              $end_date = $post['date-end'];
              while (strtotime($date) <= strtotime($end_date)) {
                $weekday = strftime('%w', strtotime($date));
                if (in_array($weekday, $weekdayArray)) {
                  $potential_applies = $this->apply_model->get_classroom_applies_with_date($id, $date, array('time'.$time => 1));
                  if ( ! empty($potential_applies)) {
                    foreach ($potential_applies as $apply) { $this->apply_model->check_apply($apply['id'], 'reject'); }
                  }
                }
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
              }
              break;
          }
        }
      }
    
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

  public function classroom_rule_create_to_all() {    
    if ($post = $this->input->post()) {
      $insert = array();
      $insert['type'] = $post['rule-type'];
      $insert['purpose'] = $post['purpose'];

      $weekdayArray = array();
      switch((int) $post['rule-type']) {
        case 0:
          $insert['start']   = $post['date'];
          $insert['end']     = NULL;
          $insert['weekday'] = 0;
          break;
        case 1:
          $insert['start']   = $post['date-start'];
          $insert['end']     = $post['date-end'];
          $insert['weekday'] = 0;
          break;
        case 2:
          $insert['start']   = $post['date-start'];
          $insert['end']     = $post['date-end'];
          $insert['weekday'] = 0;
          foreach ($post['weekday'] as $weekday) {
            switch($weekday) {
              case '日': $insert['weekday'] +=  1; $weekdayArray[] = 0; break;
              case '一': $insert['weekday'] +=  2; $weekdayArray[] = 1; break;
              case '二': $insert['weekday'] +=  4; $weekdayArray[] = 2; break;
              case '三': $insert['weekday'] +=  8; $weekdayArray[] = 3; break;
              case '四': $insert['weekday'] += 16; $weekdayArray[] = 4; break;
              case '五': $insert['weekday'] += 32; $weekdayArray[] = 5; break;
              case '六': $insert['weekday'] += 64; $weekdayArray[] = 6; break;
            }
          }
          break;
      }

      $this->load->model('apply_model');
      $classrooms = $this->classroom_model->get_classrooms(array('disabled' => '0'));
      $classroom_ids = array();
      foreach ($classrooms as $classroom) { $classroom_ids[] = $classroom['id']; }

      foreach ($classroom_ids as $id) {
        $insert['classroom_id'] = $id;
        foreach (CLASSROOM_TIME_ARRAY_KEYS as $time) {
          $insert['time'.$time] = in_array($time, $post['time']) ? 1 : 0;
          if ($insert['time'.$time] == 1) {
            switch($post['rule-type']) {
              case 0:
                $potential_applies = $this->apply_model->get_classroom_applies_with_date($id, $post['date'], array('time'.$time => 1));
                if ( ! empty($potential_applies)) {
                  foreach ($potential_applies as $apply) { $this->apply_model->check_apply($apply['id'], 'reject'); }
                }
                break;
              case 1:
                $date = $post['date-start'];
                $end_date = $post['date-end'];
                while (strtotime($date) <= strtotime($end_date)) {
                  $potential_applies = $this->apply_model->get_classroom_applies_with_date($id, $date, array('time'.$time => 1));
                  if ( ! empty($potential_applies)) {
                    foreach ($potential_applies as $apply) { $this->apply_model->check_apply($apply['id'], 'reject'); }
                  }
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                break;
              case 2:
                $date = $post['date-start'];
                $end_date = $post['date-end'];
                while (strtotime($date) <= strtotime($end_date)) {
                  $weekday = strftime('%w', strtotime($date));
                  if (in_array($weekday, $weekdayArray)) {
                    $potential_applies = $this->apply_model->get_classroom_applies_with_date($id, $date, array('time'.$time => 1));
                    if ( ! empty($potential_applies)) {
                      foreach ($potential_applies as $apply) { $this->apply_model->check_apply($apply['id'], 'reject'); }
                    }
                  }
                  $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
                }
                break;
            }
          }
        }
      
        $this->classroom_model->create_classroom_rule($insert);
      }

      redirect(base_url().'admin/classroom/' );
    }
    
    $view = array(
      'username' => 'admin',
      'page' => 'classroom_rule_create'
    );
    
    $view['classroom'] = '全部的場地';
    $this->load->css('assets/datepicker/css/bootstrap-datepicker.min.css');
    $this->load->js('assets/datepicker/js/bootstrap-datepicker.min.js');
    $this->load->js('assets/datepicker/locales/bootstrap-datepicker.zh-TW.min.js');
    $this->load->view('admin/classroom_rule_create_view', $view);
  }

  public function device() {
    $view = array(
      'page' => 'device',
      'username' => 'admin',
      'devices' => $this->device_model->get_devices()
    );

    $view['table_columns'] = array(
      'name'     => array('name' => '器材名稱', 'class' => ''),
      'disabled' => array('name' => '狀態',    'class' => 'hidden-xs'),
      'toggle'   => array('name' => '切換狀態', 'class' => ''),
      'config'   => array('name' => '設定',    'class' => '')
    );

    $this->load->view('admin/device_view', $view);
  }

  public function device_new() {
    $view = array(
      'page' => 'device_new',
      'username' => 'admin',
    );
    
    if ($post = $this->input->post()) {
      $insert = array(
        'name_zh-TW'      => $post['name_zh-TW'],
        'name_en-us'      => $post['name_en-us'],
        'total_count'     => $post['total_count'],
        'max_lease_count' => $post['max_lease_count'],
        'remark'          => $post['remark']
      );
      if ($this->device_model->create_device($insert)) { redirect('admin/device'); };
    }

    $this->load->view('admin/device_new_view', $view);
  }

  public function device_edit($id = '0') {
    if ($id === '0' OR ( ! $device = $this->device_model->get_device($id))) { redirect(base_url().'admin/device'); }
    $view = array(
      'page' => 'device_edit',
      'username' => 'admin',
      'device' => $device
    );

    if ($post = $this->input->post()) {
      $update = array(
        'name_zh-TW'      => $post['name_zh-TW'],
        'name_en-us'      => $post['name_en-us'],
        'total_count'     => $post['total_count'],
        'max_lease_count' => $post['max_lease_count'],
        'remark'          => $post['remark']
      );
      $this->device_model->update_device($update, $id);

      /* When device updated, check the application which contains the device */
      $device_logs = $this->device_apply_model->get_device_logs(array('device_id' => $device['id']));
      $device_applies = array();
      foreach ($device_logs as $log) {
        $apply = $this->device_apply_model->get_device_apply($log['device_apply_id']);
        if ($apply['status'] == 0 AND $apply['date'] > today()) {
          $this->device_apply_model->check_device_apply($apply['id'], 'reject');
          $this->device_apply_model->update_device_reject_due_to_edit($apply['id'], $device['id']);
        }
      }

      redirect('admin/device');
    }

    $this->load->view('admin/device_edit_view', $view);
  }

  public function device_apply() {
    $view = array(
      'username' => 'admin',
      'page' => 'device_apply',
      'applies' => $this->device_apply_model->get_device_applies(array('status' => '0', 'date >=' => today()))
    );

    /* Outdated device applications should be rejected */
    $outdated = $this->device_apply_model->get_device_applies(array('status' => '0', 'date <' => today()));
    if ( ! empty($outdated)) {
      foreach ($outdated as $apply) {
        $this->device_apply_model->check_device_apply($apply['id'], 'reject');
      }
    }

    $this->load->js('assets/plugins/datatables/jquery.dataTables.min.js');
    $this->load->js('assets/plugins/datatables/dataTables.bootstrap.min.js');
    $this->load->view('admin/device_apply_view', $view);
  }

  public function notice_edit() {
    $this->load->model('notice_model');   
    $view = array(
      'username' => 'admin',
      'page' => 'notice',
      'notice_updated' => FALSE
    );

    if ($post = $this->input->post()) {
      $update = array('zh-tw' => $post['classroom-zh-tw'], 'en-us' => $post['classroom-en-us']);
      $this->notice_model->update_notice($update);
      $view['notice_updated'] = TRUE;
    }

    $view['classroom_notice'] = $this->notice_model->get_classroom_notice();
    
    $this->load->js('https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js');
    $this->load->view('admin/notice_edit_view', $view);
  }

  public function device_notice_edit() {
    $this->load->model('notice_model');   
    $view = array(
      'username' => 'admin',
      'page' => 'device_notice',
      'notice_updated' => FALSE
    );

    if ($post = $this->input->post()) {
      $update = array('zh-tw' => $post['device-zh-tw'], 'en-us' => $post['device-en-us']);
      $this->notice_model->update_notice($update, '2');  
      $view['notice_updated'] = TRUE;
    }

    $view['device_notice'] = $this->notice_model->get_device_notice();

    $this->load->js('https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js');
    $this->load->view('admin/device_notice_edit_view', $view); 
  }

}