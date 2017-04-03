<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('i18n')) {
  function i18n($lang, $translate) {
    $params = explode('.', $translate);
    switch($lang) {
      case 'zh-TW': switch($params[0]) {
        case 'main': switch($params[1]) {
          case 'site-title': echo '學生活動中心場地暨器材借用管理系統'; break;
          case 'view-or-hide-menu': echo '顯示/隱藏選單'; break;
          case 'change-lang': echo 'English Version'; break;
          case 'greeting': echo '您好！'; break;
          case 'not-login': echo '您尚未登入。'; break;
          case 'leasing-facility': echo '借用功能'; break;
          case 'account-facility': echo '帳號功能'; break;
          case 'signin': echo '登入'; break;
          case 'signout': echo '登出'; break;
          case 'link': switch($params[2]) {
            case 'change-lang': echo 'en-us'; break;
            case 'current-lang': echo 'zh-TW'; break;
          } break;
          case 'classroom': switch($params[2]) {
            case 'leasing-system': echo '場地借用系統'; break;
            case 'info': echo '場地借用須知'; break;
            case 'new': echo '申請場地借用'; break;
            case 'cancel': echo '取消場地借用'; break;
            case 'record': echo '場地借用紀錄'; break;
            case 'status-check': echo '場地借用狀態查詢'; break;
          } break;
          case 'device': switch($params[2]) {
            case 'leasing-system': echo '器材借用系統'; break;
            case 'info': echo '器材借用須知'; break;
            case 'new': echo '申請器材借用'; break;
            case 'cancel': echo '取消器材借用'; break;
            case 'record': echo '器材借用紀錄'; break;
            case 'status-check': echo '器材借用狀態查詢'; break;
          } break;
        }
      }
      break;

      case 'en-us': switch($params[0]) {
        case 'main': switch($params[1]) {
          case 'site-title': echo 'Classroom and Device Leasing System'; break;
          case 'view-or-hide-menu': echo 'Toggle Navigation'; break;
          case 'change-lang': echo '中文版本'; break;
          case 'greeting': echo 'Welcome！'; break;
          case 'not-login': echo 'You haven\'t sign in.'; break;
          case 'leasing-facility': echo 'Leasing System'; break;
          case 'account-facility': echo 'Account'; break;
          case 'signin': echo 'Sign In'; break;
          case 'signout': echo 'Sign Out'; break;
          case 'link': switch($params[2]) {
            case 'change-lang': echo 'zh-TW'; break;
            case 'current-lang': echo 'en-us'; break;
          } break;
          case 'classroom': switch($params[2]) {
            case 'leasing-system': echo 'Classroom Leasing System'; break;
            case 'info': echo 'Notice'; break;
            case 'new': echo 'Apply'; break;
            case 'cancel': echo 'Cancel'; break;
            case 'record': echo 'Record'; break;
            case 'status-check': echo 'Status of Classroom Leasing'; break;
          } break;
          case 'device': switch($params[2]) {
            case 'leasing-system': echo 'Device Leasing System'; break;
            case 'info': echo 'Info'; break;
            case 'new': echo 'New'; break;
            case 'cancel': echo 'Cancel'; break;
            case 'record': echo 'Record'; break;
            case 'status-check': echo 'Status of Device Leasing'; break;
          } break;
        }
      }
      break;

      default: return FALSE;
    }
  }
}