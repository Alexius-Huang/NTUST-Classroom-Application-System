<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends WEB_Controller {
  
  public function __construct() {
    parent::__construct();
  }

  // 學生登入系統
  public function index() {
    redirect(base_url() . 'main/signin');
  }

  public function signin() {

  }

  // 教室借用狀態
  public function status() {

  }
}