<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends WEB_Controller {
  
  public function __construct() {
    parent::__construct();
    $this->output->nocache();

    // Check if admin already sign in
    if ( ! $this->session->userdata('id')) {
      redirect('admin_authentication/signin');
    }
  }

  public function main() {
    
  }

}