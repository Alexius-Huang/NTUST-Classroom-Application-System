<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('render_icon')) {
  function render_icon($icon_type) {
    return '<i class="fa fa-fw fa-'.$icon_type.'"></i>';
  }
}

if ( ! function_exists('today')) {
  function today($format = 'Y-m-d') { return date($format, strtotime('today')); }
}

if ( ! function_exists('validate_date')) {
  function validate_date($date, $format = 'Y-m-d H:i:s'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }
}

if ( ! function_exists('get_datetime_from_timestamp')) {
  function get_datetime_from_timestamp($timestamp, $format = 'Y-m-d H:i:s') { return date($format, $timestamp); }
}

if ( ! function_exists('get_ip')) {
  function get_ip() {
    if ( ! empty($_SERVER['HTTP_CLIENT_IP'])){
      return $_SERVER['HTTP_CLIENT_IP'];
    } else if ( ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
      return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else return $_SERVER['REMOTE_ADDR'];
  }
}

if ( ! function_exists('get_weekday_from_date')) {
  function get_weekday_from_date($date) {
    switch(strftime('%w', strtotime($date))) {
      case 0: return '日';
      case 1: return '一';
      case 2: return '二';
      case 3: return '三';
      case 4: return '四';
      case 5: return '五';
      case 6: return '六';
    }
  }
}

if ( ! function_exists('get_weekday')) {
  function get_weekday($num) {
    switch($num) {
      case 0: return '日';
      case 1: return '一';
      case 2: return '二';
      case 3: return '三';
      case 4: return '四';
      case 5: return '五';
      case 6: return '六';
    }
  }
}

if ( ! function_exists('get_weekday_array')) {
  function get_weekday_array($binary) {
    return str_split(strrev(str_pad((string)decbin($binary), 7, '0', STR_PAD_LEFT)));
  }
}

if ( ! function_exists('classroom_rule_display_date')) {
  function classroom_rule_display_date($start, $end = NULL) {
    if (is_null($start)) { return FALSE; }
    $result = $start.'（'.get_weekday_from_date($start).'）';
    if ( ! is_null($end)) {
      $result .= '～ '.$end.'（'.get_weekday_from_date($end).'）';
    }
    return $result;
  }
}

if ( ! function_exists('classroom_rule_display_weekday')) {
  function classroom_rule_display_weekday($weekdayNum) {
    if ((int)$weekdayNum !== 0) {
      $weekday = (string)decbin($weekdayNum);
      while(strlen($weekday) < 7) { $weekday = '0'.$weekday; }
      $weekdayBitArr = str_split($weekday);
      $weekdayArr = array();
      foreach ($weekdayBitArr as $index => $weekdayBit) {
        if ($weekdayBit == 1) { $weekdayArr[] = get_weekday($index); }
      }
      return implode('、', $weekdayArr);
    } else return '-';
  }
}

if ( ! function_exists('classroom_rule_display_time')) {
  function classroom_rule_display_time($times, $separator = ', ', $glue = '~', $t = null, $array = true) {
    if ($t === null) $t = array(
      'time1'  =>  '1',
      'time2'  =>  '2',
      'time3'  =>  '3',
      'time4'  =>  '4',
      'time5'  =>  '5',
      'time6'  =>  '6',
      'time7'  =>  '7',
      'time8'  =>  '8',
      'time9'  =>  '9',
      'time10' => '10',
      'timeA'  =>  'A',
      'timeB'  =>  'B',
      'timeC'  =>  'C',
      'timeD'  =>  'D',
    );

    $first = false;
    $last = false;
    $time = '';

    foreach ($t as $c => $d) {
      $b = $array ? $times[$c] : ($c & $times);
      if ($b && $last === false) {
        $first = true;
        if (!empty($time)) $time .= $separator;
        $time .= $d;
      } else {
        if (!$b && $last && !$first) {
          if (!empty($time)) $time .= $glue;
          $time .= $last;
        }
        $first = false;
      }
      $last = $b ? $d : false;
    }
    if ($last && !$first) {
      if (!empty($time)) $time .= $glue;
      $time .= $last;
    }

    return $time;
  }
}
