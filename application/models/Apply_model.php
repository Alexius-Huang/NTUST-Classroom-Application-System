<?php defined('BASEPATH') OR exit('No direct script access allowed!');

class Apply_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_applies($where = array()) {
    $this->db->where($where);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('Apply');
    return $query->result_array();
  }

  function get_applies_by_student_id($id = '0') {
    if ($id === '0' OR $id !== $this->session->userdata('studentID')) {
      return FALSE;
    }
    $this->db->where('student_id', $id);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('Apply');
    return $query->result_array();
  }

  function get_apply($id = '0') {
    if ($id == '0') {
      return FALSE;
    } else {
      $this->db->where('id', $id);
      $this->db->limit(1);
      $query = $this->db->get('Apply');
      if ($query->num_rows() == 1) {
        return $query->row_array();
      } else return FALSE;
    }
  }

  function create_apply($data) {
    $insert = array(
      'classroom_id'      => $data['classroom_id'],
      'student_id'        => $data['student_id'],
      'status'            => isset($data['status']) ? $data['status'] : '0',
      'date'              => $data['date'],
      'organization'      => $data['organization'],
      'applicant'         => $data['applicant'],
      'applicantPosition' => $data['applicantPosition'],
      'phone'             => $data['phone'],
      'participantCount'  => $data['participantCount'],
      'purpose'           => $data['purpose'],
      'ip'                => isset($data['ip']) ? $data['ip'] : get_ip(),
      'created_at'        => time(),
      'updated_at'        => time()
    );
    foreach (array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D') as $time) {
      $insert['time'.$time] = $data['time'.$time];
    }

    $this->db->insert('Apply', $insert);
    $id = $this->db->insert_id();
    return $id;
  }

  function check_apply($id = '0', $mode = NULL) {
    if ($id === '0' OR is_null($mode)) {
      return FALSE;
    } else if ($apply = $this->get_apply($id)) {
      $this->db->where('id', $apply['id']);
      switch($mode) {
        case 'approve': $update = array('status' => '1'); break;
        case 'reject':  $update = array('status' => '4'); break;
        case 'cancel':  $update = array('status' => '2'); break;
        default: return FALSE;
      }
      $update['updated_at'] = time();
      $this->db->update('Apply', $update);
    } else return FALSE;
  }

  function check_applies($idArray = array(), $mode = NULL) {
    if (empty($idArray) OR is_null($mode)) {
      return FALSE;
    } else {
      foreach ($idArray as $id) {
        if ($apply = $this->get_apply($id)) {
          $this->db->where('id', $id);
          switch($mode) {
            case 'approve': $update = array('status' => '1'); break;
            case 'reject':  $update = array('status' => '4'); break;
            case 'cancel':  $update = array('status' => '2'); break;
            default: continue;
          }
          $update['updated_at'] = time();
          $this->db->update('Apply', $update);
        } else continue;
      }
    }
  }

  function delete_apply($id) {
    $this->db->where('id', $id);
    $this->db->limit(1);
    $this->db->delete('Apply');
  }

}