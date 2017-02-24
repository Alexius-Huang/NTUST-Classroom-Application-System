<?php defined('BASEPATH') OR exit('No direct script access allowed!');

class Main_session_model extends CI_Model {

  function verify_student($studentID, $password){
    return 0 != (new SoapClient("http://e-service.ntust.edu.tw/checkmember/service.asmx?wsdl"))->CheckStudent(json_decode(json_encode(array('StudentNo' => strtoupper($studentID), 'Stu_PassWord' => $password))))->CheckStudentResult;
  }

  function student_signin($studentID) {
    $session_data = array(
      'studentID' => ucfirst($studentID),
      'signin'    => TRUE,
      'ip'        => get_ip()
    );
    $this->session->set_userdata($session_data);
  }

  function admin_signin() {
    $session_data = array(
      'studentID' => 'admin',
      'signin'    => TRUE,
      'ip'        => get_ip()
    );
    $this->session->set_userdata($session_data);
  }

  function student_signout() {
    $this->session->sess_destroy();
  }

}
