<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('TIME_ARRAY')) {
  function TIME_ARRAY() {
    return array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D');
  }
}

if ( ! function_exists('admin_page_name')) {
  function admin_page_name($page = '') {
    $pages = array(
      'main'                  => '首頁',
      'conflict'              => '衝突',
      'apply'                 => '審核場地借用申請',
      'device_apply'          => '審核器材借用申請',
      'application'           => '場地申請記錄',
      'device_application'    => '器材申請紀錄',
      'classroom_edit'        => '場地詳細設定',
      'device_edit'           => '器材詳細設定',
      'device_new'            => '新增器材',
      'classroom'             => '場地設定',
      'device'                => '器材設定',
      'classroom_rule_create' => '新增不開放場地規則',
      'notice'                => '場地借用申請須知',
      'device_notice'         => '器材借用申請須知'
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

  if ( ! function_exists('apply_state_type')) {
    function apply_state_type($type_id, $lang = 'zh-TW', $with_icon = FALSE) {   
      $type_list = array(
        '0' => $lang === 'zh-TW' ? '審核中' : 'Pending',
        '1' => $lang === 'zh-TW' ? '已通過' : 'Approved',
        '2' => $lang === 'zh-TW' ? '已取消' : 'Cancelled',
        '4' => $lang === 'zh-TW' ? '已駁回' : 'Rejected'
      );

      if ($with_icon) {

      }

      if ($type_list[$type_id]) { 
        return $type_list[$type_id];
      } else return $type_list;
    };
  }
}