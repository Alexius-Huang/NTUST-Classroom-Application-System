<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_download extends WEB_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->output->nocache();

    // Check if student already sign in
    if ( ! $studentID = $this->session->userdata('studentID')) {
      redirect('main_authentication/signin/zh-TW');
    }

    $this->load->model('device_model');
    $this->load->model('device_apply_model');
  }

  public function device_pdf($lang = 'zh-TW', $device_apply_id = '0') {
    if ($device_apply = $this->device_apply_model->get_device_apply($device_apply_id)) {
      $view = array('lang' => $lang, 'device_apply' => $device_apply, 'devices' => array());
      $device_logs = $this->device_apply_model->get_device_logs_by_device_apply($device_apply_id);

      foreach ($device_logs as $log) {
        $device = $this->device_model->get_device($log['device_id'], TRUE);
        $view['devices'][(int)$device['id']] = $device;
        $view['devices'][(int)$device['id']]['lease_count'] = $log['lease_count'];
      }

      $this->load->view('main/device/device_pdf_view', $view);
  
    } else redirect('main/index/'.$lang);
  }

}