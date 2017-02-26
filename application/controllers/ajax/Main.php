<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends WEB_Controller {

  public function __construct() {
    parent::__construct();
    $this->output->nocache();

    // Check if student already sign in
    if ( ! $this->input->post('without_auth') AND ! $this->session->userdata('studentID')) {
      redirect('main_authentication/signin');
    }

    $this->load->model('classroom_model');
    $this->load->model('apply_model');
  }

  public function get_classroom_name() {
    if ($post = $this->input->post() AND $classroom = $this->classroom_model->get_classroom($post['classroom_id'])) {
      header("Content-type: application/json; charset=UTF-8");
      echo json_encode(array('classroomName' => $classroom['name']));
    } else redirect('main/index');
  }

  public function apply_cancel() {
    if ($id = $this->input->post('id')) {
      $this->apply_model->check_apply($id, 'cancel');
    } else redirect('main/index');
  }

  public function get_time_state() {
    if ($post = $this->input->post()) {
      $classroom = $this->classroom_model->get_classroom($post['classroom_id']);
      $date = $post['date'];
      $weekday = strftime('%w', strtotime($date));
      
      $rules = $this->classroom_model->get_classroom_rules_by_classroom_id($post['classroom_id']);
      $applies = $this->apply_model->get_applies_by_date($date);
      
      $timeArray = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D');
      foreach ($rules as $rule) {
        switch((int)$rule['type']) {
          case 0:
            if ($rule['start'] === $date) {
              foreach ($timeArray as $time) {
                if ($rule['time'.$time] == 1 && ( ! isset($classroom['time'.$time])))
                  $classroom['time'.$time] = 'disabled';
              }
            }
            break;
          case 1:
            if ($rule['start'] <= $date AND $rule['end'] >= $date) {
              foreach ($timeArray as $time) {
                if ($rule['time'.$time] == 1 && ( ! isset($classroom['time'.$time])))
                  $classroom['time'.$time] = 'disabled';
              }
            }
            break;
          case 2:
            if ($rule['start'] <= $date AND $rule['end'] >= $date AND (get_weekday_array($rule['weekday']))[$weekday] == 1) {
              foreach ($timeArray as $time) {
                if ($rule['time'.$time] == 1 && ( ! isset($classroom['time'.$time])))
                  $classroom['time'.$time] = 'disabled';
              }
            }
            break;
        }
      }
      echo json_encode($classroom);
    }
  }

  public function get_classroom_state_table() {
    if ($date = $this->input->post('date')) {
      $weekday = strftime('%w', strtotime($date));
      $classrooms = $this->classroom_model->get_classrooms(array('disabled' => '0'));
      $timeArray = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D');
      foreach ($classrooms as $index => $classroom) {
        $rules = $this->classroom_model->get_classroom_rules_by_classroom_id($classroom['id']);
        $applies = $this->apply_model->get_classroom_applies_with_date($classroom['id'], $date);
        foreach ($rules as $rule) {
          switch((int)$rule['type']) {
            case 0:
              if ($rule['start'] === $date) {
                foreach ($timeArray as $time) {
                  if ($rule['time'.$time] == 1 && ( ! isset($classrooms[$index]['time'.$time])))
                    $classrooms[$index]['time'.$time] = 'disabled';
                }
              }
              break;
            case 1:
              if ($rule['start'] <= $date AND $rule['end'] >= $date) {
                foreach ($timeArray as $time) {
                  if ($rule['time'.$time] == 1 && ( ! isset($classrooms[$index]['time'.$time])))
                    $classrooms[$index]['time'.$time] = 'disabled';
                }
              }
              break;
            case 2:
              if ($rule['start'] <= $date AND $rule['end'] >= $date AND (get_weekday_array($rule['weekday']))[$weekday] == 1) {
                foreach ($timeArray as $time) {
                  if ($rule['time'.$time] == 1 && ( ! isset($classrooms[$index]['time'.$time])))
                    $classrooms[$index]['time'.$time] = 'disabled';
                }
              }
              break;
          }
        }

        foreach ($applies as $apply) {
          switch((int)$apply['status']) {
            case 0:
              foreach ($timeArray as $time) {
                if ($apply['time'.$time] == 1 && ( ! isset($classrooms[$index]['time'.$time])))
                  $classrooms[$index]['time'.$time] = 'await';
              }
              break;
            case 1:
              foreach ($timeArray as $time) {
                if ($apply['time'.$time] == 1 && ( ! isset($classrooms[$index]['time'.$time])))
                  $classrooms[$index]['time'.$time] = 'checked';
              }
              break;
            case 4:
            default: continue;
          }
        }
      }

      echo json_encode($classrooms);
    }
  }

}