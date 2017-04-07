<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('i18n')) {
  function i18n($lang, $translate) {
    $params = explode('.', $translate);
    switch($lang) {
      case 'zh-TW': switch($params[0]) {
        case 'general': switch($params[1]) {
          case 'link': switch($params[2]) {
            case 'change-lang': echo 'en-us'; break;
            case 'current-lang': echo 'zh-TW'; break;
          } break;
          case 'classroom': switch($params[2]) {
            case 'leasing-system': echo '學生活動中心場地借用系統'; break;
            case 'page': switch($params[3]) {
              case 'notification': echo '場地借用須知'; break;
            } break;
          } break;
          case 'device': switch($params[2]) {
            case 'leasing-system': echo '學生活動中心器材借用系統'; break;
            case 'page': switch($params[3]) {
              case 'notification': echo '器材借用須知'; break;
            } break;
          } break;
          case 'system': switch($params[2]) {
            case 'notify-title': echo '學生活動中心場地暨器材借用系統更新通知'; break;
            case 'notify-content': echo '本系統分為場地借用以及器材借用系統'; break;
          } break;
        }  break;

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
          case 'classroom': switch($params[2]) {
            case 'go-to-leasing-system': echo '前往場地借用系統'; break;
            case 'leasing-system': echo '場地借用系統'; break;
            case 'info': echo '場地借用須知'; break;
            case 'new': echo '申請場地借用'; break;
            case 'cancel': echo '取消場地借用'; break;
            case 'record': echo '場地借用紀錄'; break;
            case 'status-check': echo '場地借用狀態查詢'; break;
          } break;
          case 'device': switch($params[2]) {
            case 'go-to-leasing-system': echo '前往器材借用系統'; break;
            case 'leasing-system': echo '器材借用系統'; break;
            case 'info': echo '器材借用須知'; break;
            case 'new': echo '申請器材借用'; break;
            case 'cancel': echo '取消器材借用'; break;
            case 'record': echo '器材借用紀錄'; break;
            case 'status-check': echo '器材借用狀態查詢'; break;
          } break;
        } break;

        case 'page': switch($params[1]) {
          case 'classroom': switch($params[2]) {
            case 'apply-notice': switch($params[3]) {
              case 'read-notice': echo '使用本系統前，請閱讀以下場地借用須知：'; break;
            } break;
          } break;
          case 'device': switch($params[2]) {
            case 'apply-notice': switch($params[3]) {
              case 'read-notice': echo '使用本系統前，請閱讀以下器材借用須知：'; break;
            }
          } break;
        } break;
      }
      break;

      case 'en-us': switch($params[0]) {
        case 'general': switch($params[1]) {
          case 'link': switch($params[2]) {
            case 'change-lang': echo 'zh-TW'; break;
            case 'current-lang': echo 'en-us'; break;
          } break;
          case 'classroom': switch($params[2]) {
            case 'leasing-system': echo 'Classroom Leasing System'; break;
            case 'page': switch($params[3]) {
              case 'notification': echo 'Classroom Leasing Notice'; break;
            } break;
          } break;
          case 'device': switch($params[2]) {
            case 'leasing-system': echo 'Device Leasing System'; break;
            case 'page': switch($params[3]) {
              case 'notification': echo 'Device Leasing Notice'; break;
            } break;
          } break;
          case 'system': switch($params[2]) {
            case 'notify-title': echo 'Classroom and Device Leasing System Update Notice'; break;
            case 'notify-content': echo 'This system provides two different service, classroom or device leasing.'; break;
          } break;
        }  break;
        
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
          case 'classroom': switch($params[2]) {
            case 'go-to-leasing-system': echo 'Go to Classroom Leasing System'; break;
            case 'leasing-system': echo 'Classroom Leasing System'; break;
            case 'info': echo 'Classroom Leasing Info'; break;
            case 'new': echo 'Classroom Leasing New'; break;
            case 'cancel': echo 'Classroom Leasing Cancel'; break;
            case 'record': echo 'Classroom Leasing Record'; break;
            case 'status-check': echo 'Status of Classroom Leasing'; break;
          } break;
          case 'device': switch($params[2]) {
            case 'go-to-leasing-system': echo 'Go to Device Leasing System'; break;
            case 'leasing-system': echo 'Device Leasing System'; break;
            case 'info': echo 'Device Leasing Info'; break;
            case 'new': echo 'Device Leasing New'; break;
            case 'cancel': echo 'Device Leasing Cancel'; break;
            case 'record': echo 'Device Leasing Record'; break;
            case 'status-check': echo 'Status of Device Leasing'; break;
          } break;
        } break;

        case 'page': switch($params[1]) {
          case 'classroom': switch($params[2]) {
            case 'apply-notice': switch($params[3]) {
              case 'read-notice': echo 'Before using the system, please read the following classroom leasing notice :'; break;
            } break;
          } break;
          case 'device': switch($params[2]) {
            case 'apply-notice': switch($params[3]) {
              case 'read-notice': echo 'Before using the system, please read the following device leasing notice :'; break;
            }
          } break;
        } break;
      }
      break;

      default: return FALSE;
    }
  }
}