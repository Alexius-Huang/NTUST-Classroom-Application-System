<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notice_model extends CI_Model {
  
  function get_notice($id = '1') {
    $this->db->where('id', $id);
    $this->db->limit(1);
    $query = $this->db->get('Notice');
    if ($query->num_rows() == 1) {
      return $query->row_array();
    } else return FALSE;
  }

  function update_notice($data, $id = '1') {
    $update = array();
    if (isset($data['zh-tw'])) { $update['zh-tw'] = $data['zh-tw']; }
    if (isset($data['en-us'])) { $update['en-us'] = $data['en-us']; }

    if ( ! empty($update)) {
      $update['updated_at'] = time();
      $this->db->where('id', $id);
      $this->db->update('Notice', $update);
    }
  }

}