<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_classrooms($where = array()) {
    $this->db->where($where);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('Classroom');
    return $query->result_array();
  }

  function get_classroom_rules($where = array()) {
    $this->db->where($where);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('ClassroomRule');
    return $query->result_array();
  }

  function get_classroom($id = '0') {
    if ($id == '0') {
      return FALSE;
    } else {
      $this->db->where('id', $id);
      $this->db->limit(1);
      $query = $this->db->get('Classroom');
      if ($query->num_rows() == 1) {
        return $query->row_array();
      } else {
        return FALSE;
      }
    }
  }

  function create_classroom($data) {
    $insert = array(
      'name'       => $data['name'],
      'disabled'   => '0',
      'created_at' => time(),
      'updated_at' => time()
    );
    $this->db->insert('Classroom', $insert);
    $id = $this->db->insert_id();
    return $id;
  }
  
  function create_classroom_rule($data) {
    $insert = array(
      'classroom_id' => $data['classroom_id'],
      'type'         => $data['type'],
      'start'        => $data['start'],
      'end'          => $data['end'],
      'weekday'      => $data['weekday'],
      'created_at'   => time(),
      'updated_at'   => time()
    );

    foreach (array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D') as $time) {
      $insert['time'.$time] = $data['time'.$time];
    }

    $this->db->insert('ClassroomRule', $insert);
    $id = $this->db->insert_id();
    return $id;
  }

  function update_classroom($data, $id) {
    $update = array();
    if (isset($data['name']))     { $update['name']     = $data['name'];     }
    if (isset($data['disabled'])) { $update['disabled'] = $data['disabled']; }

    if ( ! empty($update)) {
      $update['updated_at'] = time();
      $this->db->where('id', $id);
      $this->db->update('Classroom', $update);
    }
  }

  function delete_classroom($id) {
    $this->db->where('id', $id);
    $this->db->limit(1);
    $this->db->delete('Classroom');
  }
}