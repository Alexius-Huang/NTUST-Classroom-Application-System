<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('admin_page_name')) {
  function admin_page_name($page = '') {
    $pages = array(
      'main'                  => '首頁',
      'conflict'              => '衝突',
      'apply'                 => '審核申請',
      'application'           => '申請記錄',
      'classroom_edit'        => '場地詳細設定',
      'classroom'             => '場地設定',
      'classroom_rule_create' => '新增不開放場地規則',
      'notice'                => '申請須知'
    );

    if ($pages[$page]) {
      return $pages[$page];
    } else return $pages;
  }
}

if ( ! function_exists('classroom_rule_type')) {
  function classroom_rule_type($type_id, $with_icon = FALSE) {
    $rules = array(
      '0' => '單日不開放',
      '1' => '連續不開放',
      '2' => '依星期不開放'
    );
    if ($with_icon) {
      $rules['0'] = render_icon('calendar-o').' '.$rules['0'];
      $rules['1'] = render_icon('calendar').' '.$rules['1'];
      $rules['2'] = render_icon('calendar-check-o').' '.$rules['2'];
    }

    if ($rules[$type_id]) {
      return $rules[$type_id];
    } else return $rules;
  }
}