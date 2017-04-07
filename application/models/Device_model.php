<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Device_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_devices($where = array()) {
    $this->db->where($where);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('Device');
    return $query->result_array();
  }

  function get_device($id = '0') {
    if ($id == '0') {
      return FALSE;
    } else {
      $this->db->where('id', $id);
      $this->db->limit(1);
      $query = $this->db->get('Device');
      if ($query->num_rows() == 1) {
        return $query->row_array();
      } else return FALSE;
    }
  }

  function create_device($data) {
    $insert = array(
      'name_zh-TW'      => $data['name_zh-TW'],
      'name_en-us'      => $data['name_en-us'],
      'total_count'     => $data['total_count'],
      'max_lease_count' => $data['max_lease_count'],
      'enabled'         => '1',
      'created_at'      => time(),
      'updated_at'      => time()
    );
    $this->db->insert('Device', $insert);
    $id = $this->db->insert_id();
    return $id;
  }

  function update_device($data, $id) {
    $update = array();
    if (isset($data['name_zh-TW']))      { $update['name_zh-TW']      = $data['name_zh-TW'];      }
    if (isset($data['name_en-us']))      { $update['name_en-us']      = $data['name_en-us'];      }
    if (isset($data['total_count']))     { $update['total_count']     = $data['total_count'];     }
    if (isset($data['max_lease_count'])) { $update['max_lease_count'] = $data['max_lease_count']; }
    if (isset($data['enabled']))         { $update['enabled']         = $data['enabled'];         }

    if ( ! empty($update)) {
      $update['updated_at'] = time();
      $this->db->where('id', $id);
      $this->db->update('Device', $update);
    }
  }

  function delete_device($id) {
    $this->db->where('id', $id);
    $this->db->limit(1);
    $this->db->delete('Device');
  }
}