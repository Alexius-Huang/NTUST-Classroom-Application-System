<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('admin_page_name')) {
  function admin_page_name($page = '') {
    $pages = array(
      'main'           => '首頁',
      'conflict'       => '衝突',
      'classroom_edit' => '場地詳細設定',
      'apply'          => '審核申請',
      'application'    => '申請記錄',
      'classroom'      => '場地設定',
      'notice'         => '申請須知'
    );

    if ($pages[$page]) {
      return $pages[$page];
    } else return $pages;
  }
}