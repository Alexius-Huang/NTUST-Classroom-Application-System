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
    $this->load->model('apply_model');
  }

  public function index() {
    redirect('main/apply_notice');
  }

  public function apply_notice() {
    $view = array('page' => 'apply_notice');

    $this->load->model('notice_model');
    $view['notice'] = $this->notice_model->get_notice();
    $this->load->view('main/apply_notice_view', $view);
  }

  public function apply_new() {
    $view = array('page' => 'apply_new', 'apply_failure' => FALSE);

    if ($post = $this->input->post()) {
      $insert = array(
        'classroom_id'      => $post['classroom_id'],
        'student_id'        => $this->session->userdata('studentID'),
        'status'            => '0',
        'date'              => $post['date'],
        'organization'      => $post['organization'],
        'applicant'         => $post['applicant'],
        'applicantPosition' => $post['applicant-position'],
        'phone'             => $post['phone'],
        'participantCount'  => $post['participant-count'],
        'purpose'           => $post['purpose']
      );
      foreach (array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D') as $time) {
        $insert['time'.$time] = in_array($time, $post['times']) ? '1' : '0';
      }
      
      if ($this->apply_model->create_apply($insert)) {
        redirect('main/apply_record');
      } else $view['apply_failure'] = TRUE;
    }

    $view['timeArray'] = array(
      '1' => '08:10 ~ 09:00',
      '2' => '09:10 ~ 10:00',
      '3' => '10:20 ~ 11:10',
      '4' => '11:20 ~ 12:10',
      '5' => '12:20 ~ 13:10',
      '6' => '13:20 ~ 14:10',
      '7' => '14:20 ~ 15:10',
      '8' => '15:30 ~ 16:20',
      '9' => '16:30 ~ 17:20',
      '10'=> '17:30 ~ 18:20',
      'A' => '18:25 ~ 19:15',
      'B' => '19:20 ~ 20:10',
      'C' => '20:15 ~ 21:05',
      'D' => '21:10 ~ 22:00',
    );

    $view['classroom_available'] = $this->classroom_model->get_classrooms();

    $this->load->js('http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js');
    $this->load->js('assets/datepicker/js/bootstrap-datepicker.min.js');
    $this->load->js('assets/datepicker/locales/bootstrap-datepicker.zh-TW.min.js');
    $this->load->view('main/apply_new_view', $view);
  }

  public function apply_delete() {
    $view = array(
      'page' => 'apply_delete',
      'applies' => $this->apply_model->get_applies_by_student_id($this->session->userdata('studentID'))
    );

    foreach ($view['applies'] as $index => $apply) {
      if ($apply['status'] == '0') { $view['applies'][$index]['past'] = today() >= $apply['date']; }
      $view['applies'][$index]['classroom'] = $this->classroom_model->get_classroom($apply['classroom_id']);
    }
    
    $this->load->css('assets/css/pending.css');
    $this->load->js('assets/plugins/datatables/jquery.dataTables.min.js');
    $this->load->js('assets/plugins/datatables/dataTables.bootstrap.min.js');
    $this->load->view('main/apply_delete_view', $view);
  }

  public function apply_record() {
    $view = array(
      'page' => 'apply_record',
      'applies' => $this->apply_model->get_applies_by_student_id($this->session->userdata('studentID'))
    );

    foreach ($view['applies'] as $index => $apply) {
      if ($apply['status'] == '0') { $view['applies'][$index]['past'] = today() >= $apply['date']; }
      $view['applies'][$index]['classroom'] = $this->classroom_model->get_classroom($apply['classroom_id']);
    }

    $this->load->css('assets/css/pending.css');
    $this->load->js('assets/plugins/datatables/jquery.dataTables.min.js');
    $this->load->js('assets/plugins/datatables/dataTables.bootstrap.min.js');
    $this->load->view('main/apply_record_view', $view);
  }

}