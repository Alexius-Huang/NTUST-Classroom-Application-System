<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Device_apply_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_device_applies($where = array()) {
    $this->db->where($where);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('DeviceApply');
    return $query->result_array();
  }

  function get_device_logs($where = array()) {
    $this->db->where($where);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('DeviceLog');
    return $query->result_array();
  }

  function get_device_logs_by_device_apply($device_apply_id = '0') {
    if ($device_apply_id == '0') {
      return FALSE;
    } else {
      $this->db->where('device_apply_id', $device_apply_id);
      $this->db->order_by('id', 'asc');
      $query = $this->db->get('DeviceLog');
      return $query->result_array();
    }
  }

  function get_device_apply($id = '0') {
    if ($id == '0') {
      return FALSE;
    } else {
      $this->db->where('id', $id);
      $this->db->limit(1);
      $query = $this->db->get('DeviceApply');
      if ($query->num_rows() == 1) {
        return $query->row_array();
      } else return FALSE;
    }
  }

  function get_device_apply_log($id = '0') {
    if ($id == '0') {
      return FALSE;
    } else {
      $this->db->where('id', $id);
      $this->db->limit(1);
      $query = $this->db->get('DeviceLog');
      if ($query->num_rows() == 1) {
        return $query->row_array();
      } else return FALSE;
    }
  }

  function create_device_apply($data) {
    $insert = array(
      'student_id'        => $data['student_id'],
      'status'            => $data['status'],
      'date'              => $data['date'],
      'organization'      => $data['organization'],
      'applicant'         => $data['applicant'],
      'applicantPosition' => $data['applicantPosition'],
      'phone'             => $data['phone'],
      'purpose'           => $data['purpose'],
      'ip'                => isset($data['ip']) ? $data['ip'] : get_ip(),
      'created_at'        => time(),
      'updated_at'        => time()
    );
    $this->db->insert('DeviceApply', $insert);
    $id = $this->db->insert_id();
    return $id;
  }

  function create_device_log($data) {
    $insert = array(
      'device_apply_id' => $data['device_apply_id'],
      'device_id'       => $data['device_id'],
      'lease_count'     => $data['lease_count']
    );
    $this->db->insert('DeviceLog', $insert);
    $id = $this->db->insert_id();
    return $id;
  }

  function delete_device_apply($id) {
    $this->db->where('id', $id);
    $this->db->limit(1);
    $this->db->delete('DeviceApply');
  }

  function delete_device_log($id) {
    $this->db->where('id', $id);
    $this->db->limit(1);
    $this->db->delete('DeviceLog');
  }
}