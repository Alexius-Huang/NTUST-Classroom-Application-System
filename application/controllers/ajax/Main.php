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
    $this->load->model('device_model');
    $this->load->model('device_apply_model');
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
      $applies = $this->apply_model->get_classroom_applies_with_date($classroom['id'], $date);
      
      foreach ($rules as $rule) {
        switch((int)$rule['type']) {
          case 0:
            if ($rule['start'] === $date) {
              foreach (TIME_ARRAY() as $time) {
                if ($rule['time'.$time] == 1 AND ( ! isset($classroom['time'.$time])))
                  $classroom['time'.$time] = 'disabled';
              }
            }
            break;
          case 1:
            if ($rule['start'] <= $date AND $rule['end'] >= $date) {
              foreach (TIME_ARRAY() as $time) {
                if ($rule['time'.$time] == 1 AND ( ! isset($classroom['time'.$time])))
                  $classroom['time'.$time] = 'disabled';
              }
            }
            break;
          case 2:
            $weekdayArray = get_weekday_array($rule['weekday']);
            if ($rule['start'] <= $date AND $rule['end'] >= $date AND $weekdayArray[$weekday] == 1) {
              foreach (TIME_ARRAY() as $time) {
                if ($rule['time'.$time] == 1 AND ( ! isset($classroom['time'.$time])))
                  $classroom['time'.$time] = 'disabled';
              }
            }
            break;
        }
      }

      foreach ($applies as $apply) {
        switch((int)$apply['status']) {
          case 0:
            foreach (TIME_ARRAY() as $time) {
              if ($apply['time'.$time] == 1 && ( ! isset($classroom['time'.$time])))
                $classroom['time'.$time] = 'await';
            }
            break;
          case 1:
            foreach (TIME_ARRAY() as $time) {
              if ($apply['time'.$time] == 1 && ( ! isset($classroom['time'.$time])))
                $classroom['time'.$time] = 'checked';
            }
            break;
          case 4:
          default: continue;
        }
      }
      echo json_encode($classroom);
    }
  }

  public function get_classroom_state_table() {
    if ($date = $this->input->post('date')) {
      $weekday = strftime('%w', strtotime($date));
      $classrooms = $this->classroom_model->get_classrooms(array('disabled' => '0'));
      foreach ($classrooms as $index => $classroom) {
        $rules = $this->classroom_model->get_classroom_rules_by_classroom_id($classroom['id']);
        $applies = $this->apply_model->get_classroom_applies_with_date($classroom['id'], $date);
        foreach ($rules as $rule) {
          switch((int)$rule['type']) {
            case 0:
              if ($rule['start'] === $date) {
                foreach (TIME_ARRAY() as $time) {
                  if ($rule['time'.$time] == 1 AND ( ! isset($classrooms[$index]['time'.$time]))) {
                    $classrooms[$index]['time'.$time] = array(
                      'status'    => 'disabled',
                      'type'      => '單日不開放',
                      'classroom' => $classroom['name'],
                      'purpose'   => $rule['purpose'],
                      'date'      => $rule['start'],
                      'weekday'   => 'N/A',
                      'time'      => classroom_rule_display_time($rule)
                    );
                  }
                }
              }
              break;
            case 1:
              if ($rule['start'] <= $date AND $rule['end'] >= $date) {
                foreach (TIME_ARRAY() as $time) {
                  if ($rule['time'.$time] == 1 AND ( ! isset($classrooms[$index]['time'.$time]))) {
                    $classrooms[$index]['time'.$time] = array(
                      'status'    => 'disabled',
                      'type'      => '連續不開放',
                      'classroom' => $classroom['name'],
                      'purpose'   => $rule['purpose'],
                      'weekday'   => 'N/A',
                      'date'      => classroom_rule_display_date($rule['start'], $rule['end']),
                      'time'      => classroom_rule_display_time($rule)
                    );
                  }
                }
              }
              break;
            case 2:
              $weekdayArray = get_weekday_array($rule['weekday']);
              if ($rule['start'] <= $date AND $rule['end'] >= $date AND $weekdayArray[$weekday] == 1) {
                foreach (TIME_ARRAY() as $time) {
                  if ($rule['time'.$time] == 1 AND ( ! isset($classrooms[$index]['time'.$time]))) {
                    $classrooms[$index]['time'.$time] = array(
                      'status'    => 'disabled',
                      'type'      => '依星期不開放',
                      'classroom' => $classroom['name'],
                      'purpose'   => $rule['purpose'],
                      'date'      => classroom_rule_display_date($rule['start'], $rule['end']),
                      'weekday'   => classroom_rule_display_weekday($rule['weekday']),
                      'time'      => classroom_rule_display_time($rule)
                    );
                  }
                }
              }
              break;
          }
        }

        foreach ($applies as $apply) {
          switch((int)$apply['status']) {
            case 0:
              foreach (TIME_ARRAY() as $time) {
                if ($apply['time'.$time] == 1  AND ( ! isset($classrooms[$index]['time'.$time]))) {
                  $classrooms[$index]['time'.$time] = array(
                    'status'            => 'await',
                    'classroom'         => $classroom['name'],
                    'participant_count' => $apply['participantCount'],
                    'date'              => $apply['date'],
                    'time'              => classroom_rule_display_time($apply),
                    'organization'      => $apply['organization'],
                    'applicant'         => $apply['applicant'] + '（' + $apply['applicantPosition'] + '）',
                    'purpose'           => $apply['purpose']
                  );
                }
              }
              break;
            case 1:
              foreach (TIME_ARRAY() as $time) {
                if ($apply['time'.$time] == 1  AND ( ! isset($classrooms[$index]['time'.$time]))) {
                  $classrooms[$index]['time'.$time] = array(
                    'status'            => 'checked',
                    'classroom'         => $classroom['name'],
                    'participant_count' => $apply['participantCount'],
                    'date'              => $apply['date'],
                    'time'              => classroom_rule_display_time($apply),
                    'organization'      => $apply['organization'],
                    'applicant'         => $apply['applicant'].'（'.$apply['applicantPosition'].'）',
                    'purpose'           => $apply['purpose']
                  );
                }
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

  public function get_datepicker_class() {
    $datepicker_classes = array();

    $rules = $this->classroom_model->get_classroom_rules();
    foreach ($rules as $rule) {
      switch((int)$rule['type']){
        case 0:
          $datepicker_classes[$rule['start']]['danger'] = TRUE;
          break;
        case 1:
          $date = $rule['start'];
          $end_date = $rule['end'];
          while (strtotime($date) <= strtotime($end_date)) {
            $datepicker_classes[$date]['danger'] = TRUE;
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
          }
          break;
        case 2:
          $date = $rule['start'];
          $end_date = $rule['end'];
          $weekdayArray = get_weekday_array($rule['weekday']);
          while (strtotime($date) <= strtotime($end_date)) {
            $weekday = strftime('%w', strtotime($date));
            if ($weekdayArray[$weekday] == 1) {
              $datepicker_classes[$date]['danger'] = TRUE;
            }
            $date = date('Y-m-d', strtotime("+1 day", strtotime($date)));
          }
          break;
      }
    }

    $applies = $this->apply_model->get_applies();
    foreach ($applies as $apply) {
      if ($apply['status'] == 2 OR $apply['status'] == 4) { continue; }
      $datepicker_classes[$apply['date']]['checked'] = TRUE;
    }

    echo json_encode($datepicker_classes);
  }

  public function get_datepicker_class_in_apply_page() {
    $datepicker_classes = array();
    $classrooms = $this->classroom_model->get_classrooms(array('disabled' => 0));

    foreach ($classrooms as $classroom) {
      $rules = $this->classroom_model->get_classroom_rules(array('classroom_id' => $classroom['id']));
      foreach($rules as $rule) {
        switch((int)$rule['type']) {
          case 0:
            foreach (TIME_ARRAY() as $time) {
              if ($time == 'D' AND $rule['timeD'] == 1) {
                $datepicker_classes[$classroom['id']][$rule['start']]['disable'] = TRUE;
              } else if ($rule['time'.$time] == 1) {
                continue;
              } else {
                $datepicker_classes[$classroom['id']][$rule['start']]['status'] = TRUE;
                break;
              }
            }
            break;
          case 1:
            $date = $rule['start'];
            $end_date = $rule['end'];
            while (strtotime($date) <= strtotime($end_date)) {
              foreach (TIME_ARRAY() as $time) {
                if ($time == 'D' AND $rule['timeD'] == 1) {
                  $datepicker_classes[$classroom['id']][$date]['disable'] = TRUE;
                } else if ($rule['time'.$time] == 1) {
                  continue;
                } else {
                  $datepicker_classes[$classroom['id']][$date]['status'] = TRUE;
                  break;
                }
              }
              $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
            }
            break;
          case 2:
            $date = $rule['start'];
            $end_date = $rule['end'];
            $weekdayArray = get_weekday_array($rule['weekday']);
            while (strtotime($date) <= strtotime($end_date)) {
              $weekday = strftime('%w', strtotime($date));
              if ($weekdayArray[$weekday] == 1) {
                foreach (TIME_ARRAY() as $time) {
                  if ($time == 'D' AND $rule['timeD'] == 1) {
                    $datepicker_classes[$classroom['id']][$date]['disable'] = TRUE;
                  } else if ($rule['time'.$time] == 1) {
                    continue;
                  } else {
                    $datepicker_classes[$classroom['id']][$date]['status']  = TRUE;
                    $datepicker_classes[$classroom['id']][$date]['disable'] = FALSE;
                    break;
                  }
                }
              }
              $date = date('Y-m-d', strtotime('+1 day', strtotime($date)));
            }
            break;
        }
      }

      $applies = $this->apply_model->get_applies(array('classroom_id' => $classroom['id']));
      foreach ($applies as $apply) {
        if ($apply['status'] == '2' OR $apply['status'] == '4') { continue; }
        $datepicker_classes[$classroom['id']][$apply['date']]['status'] = TRUE;
      }
    }
  
    echo json_encode($datepicker_classes);
  }

  public function get_available_device_info_by_date_range() {
    if ($date = $this->input->post('date') AND $end_date = $this->input->post('end_date')) {
      /* Get all of the enabled devices */
      $devices = $this->device_model->get_devices(array('disabled' => 0));
      $device_table = array();
      foreach ($devices as $device) {
        $device['current_available'] = $device['total_count'];
        $device_table[$device['id']] = $device;
      }

      /* Get all of the device application with the same date in status of pending or success */
      $device_applies = array();
      while (strtotime($date) <= strtotime($end_date)) {
        $device_applies += $this->device_apply_model->get_device_applies_by_date($date);
        $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
      }

      /* Calculate each device count in corresponding day */
      foreach ($device_applies as $device_apply) {
        if ($device_apply['status'] == '2' OR $device_apply['status'] == '4') { continue; }
        $device_logs = $this->device_apply_model->get_device_logs_by_device_apply($device_apply['id']);
        foreach ($device_logs as $log) {
          if ($device_table[$log['device_id']]) {
            $device_table[$log['device_id']]['current_available'] -= $log['lease_count'];
            if ($device_table[$log['device_id']]['current_available'] < 0) $device_table[$log['device_id']]['current_available'] = 0;
          }
        }
      }

      echo json_encode($device_table);
    } else redirect('main/index');
  }

  public function get_device_details() {
    if (  $apply_id = $this->input->post('id')
      AND $device_logs = $this->device_apply_model->get_device_logs_by_device_apply($apply_id)
    ) {
      $device_info = array();
      foreach($device_logs as $log) {
        $device = $this->device_model->get_device($log['device_id']);
        $device_info[$device['id']] = $device;
        $device_info[$device['id']]['lease_count'] = $log['lease_count'];
      }
      echo json_encode($device_info);
    }
  }

  public function device_apply_cancel() {
    if ($apply_id = $this->input->post('id')) {
      $this->device_apply_model->delete_device_apply_along_with_logs($apply_id);
    }
  }
}