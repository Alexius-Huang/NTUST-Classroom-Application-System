<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
  
  function __construct() {
    parent::__construct();
  }

  /* BASIC QUERY METHODS */
  function get_admins($where = array()) {
    $this->db->where($where);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('Admin');
    return $query->result_array();
  }

  function get_admin($id = '0') {
    if ($id == '0') {
      return FALSE;
    } else {
      $this->db->where('id', $id);
      $this->db->limit(1);
      $query = $this->db->get('Admin');
      if ($query->num_rows() == 1) {
        return $query->row_array();
      } else {
        return FALSE;
      }
    }
  }

  // function update_user($data, $id) {
  //   $update = array();
  //   if (isset($data['email']))    { $update['email']    = $data['email'];          }
  //   if (isset($data['password'])) { $update['password'] = sha1($data['password']); }
  //   if (isset($data['username'])) { $update['username'] = $data['username'];       }
  //   if (isset($data['status']))   { $update['status']   = $data['status'];         }
    
  //   if ( ! empty($update)) {
  //     $update['updated_at'] = time();
  //     $this->db->where('id', $id);
  //     $this->db->update('User', $update);

  //     /* Update Session */
  //     $this->session->set_userdata(array(
  //       'email'    => isset($update['email'])    ? $update['email']          : $this->session->userdata['email'],
  //       'password' => isset($update['password']) ? sha1($update['password']) : $this->session->userdata['password'],
  //       'username' => isset($update['username']) ? $update['username']       : $this->session->userdata['username'],
  //       'status'   => isset($update['status'])   ? $update['status']         : $this->session->userdata['status']
  //     ));
  //   } 
  // }

  /* DELETE ADMIN METHOD */
  // function delete_user($id) {
  //   $this->db->where('id', $id);
  //   $this->db->delete('User');
  // }

  /* OTHER ACTIONS */
  function admin_signin($account = '', $password = '') {
    /* GET ADMIN BY EMAIL */
    $this->db->where('account', $account);
    $this->db->limit(1);
    $query = $this->db->get('Admin');
    if ($query->num_rows() == 1) {
      /* CHECK ADMIN'S PASSWORD */
      $admin = $query->row_array();
      if ($admin['password'] === ($password)) {
        /* SHOULD LOAD ADMIN SESSION */
        $admin_session = array(
          'id'          => $admin['id'],
          'account'     => $admin['account'],
          'status'      => $admin['status'],
          'admin'       => TRUE,
          'last_signin' => time()
        );
        $this->session->set_userdata($admin_session);
        $this->db->where('id', $admin['id']);
        $this->db->update('Admin', array('last_signin' => time()));
        return $admin_session;
      } else return FALSE;
    } else return FALSE;
  }

  function admin_signout() {
    /* SHOULD DROP ADMIN SESSION */
    $this->session->sess_destroy();
  }

}