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
            case 'error-title': echo '錯誤！'; break;
            case 'error-message': echo '系統內部似乎出錯，請聯絡相關負責人員！'; break;
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
          case 'signin': switch($params[2]) {
            case 'title': echo '登入'; break;
            case 'failure': echo '登入失敗！'; break;
            case 'failure-message': echo '請確認您輸入的登入資訊是否正確。'; break;
            case 'student-id-placeholder': echo '請輸入您的學號'; break;
            case 'password-placeholder': echo '請輸入學生資訊系統密碼'; break;
            case 'signin': echo '登入'; break;
            case 'remark': echo '備註：建議使用 IE 以及 Edge 以外的瀏覽器'; break;
          } break;

          case 'classroom': switch($params[2]) {
            case 'apply-notice': switch($params[3]) {
              case 'read-notice': echo '使用本系統前，請閱讀以下場地借用須知：'; break;
            } break;
          } break;
          
          case 'classroom-apply-new': switch($params[2]) {
            case 'title': echo '場地申請借用'; break;
            case 'apply-fail': echo '場地申請失敗！'; break;
            case 'apply-fail-message': echo '請確認您輸入的申請資訊是否正確。'; break;
            case 'cancel-all': echo '全部取消'; break;
            case 'submit': echo '送出場地申請'; break;
            case 'label': switch($params[3]) {
              case 'classroom': echo '場地：'; break;
              case 'select-classroom': echo '請選擇場地'; break;
              case 'date': echo '日期：'; break;
              case 'time': echo '時段：（審核中時段將以藍色標記，紅色為不開放時段，橘色為該時段已有他人借用）'; break;
              case 'organization': echo '單位（社團）名稱：'; break;
              case 'applicant': echo '申請人姓名：'; break;
              case 'applicant-position': echo '申請人（社團）職稱：'; break;
              case 'phone': echo '申請人聯絡電話：'; break;
              case 'participant-count': echo '場地人數：'; break;
              case 'purpose': echo '場地借用目的（請簡述）：'; break;
            } break;
          } break;
          
          case 'classroom-apply-record': switch($params[2]) {
            case 'title': echo '場地申請紀錄'; break;
            case 'table-title': echo '以下為您的場地借用紀錄：'; break;
            case 'no-record': echo '您尚未有任何場地借用紀錄'; break;
            case 'table-headers': switch($params[3]) {
              case 'status': echo '申請狀態'; break;
              case 'place': echo '借用地點'; break;
              case 'date': echo '借用日期'; break;
              case 'time': echo '借用時段'; break;
              case 'apply-at': echo '申請時間'; break;
            } break;
          } break;

          case 'classroom-apply-delete': switch($params[2]) {
            case 'title': echo '取消場地借用申請'; break;
            case 'table-title': echo '以下為您正在審核以及通過之場地借用申請：'; break;
            case 'no-record': echo '您尚未有任何審核以及通過之場地借用申請'; break;
            case 'cancel-apply': echo '取消申請'; break;
            case 'table-headers': switch($params[3]) {
              case 'apply-at': echo '提出申請時間'; break;
              case 'status': echo '申請狀態'; break;
              case 'place': echo '借用地點'; break;
              case 'date': echo '借用日期'; break;
              case 'time': echo '借用時段'; break;
              case 'cancel-apply': echo '取消申請'; break;
            } break;
            case 'swal': switch($params[3]) {
              case 'title': echo '您即將要取消此場地申請'; break;
              case 'status': echo '申請狀態：'; break;
              case 'place': echo '申請場地：'; break;
              case 'date': echo '申請日期：'; break;
              case 'time': echo '申請時段：'; break;
              case 'ask': echo '確定要取消以上申請嗎？'; break;
              case 'confirm': echo '確定'; break;
              case 'cancel': echo '取消'; break;
            } break;
          } break;

          case 'device-apply-new': switch($params[2]) {
            case 'title': echo '申請借用'; break;
            case 'apply-fail': echo '申請失敗！'; break;
            case 'apply-fail-message': echo '請確認您輸入的申請資訊是否正確。'; break;
            case 'cancel-all': echo '全部取消'; break;
            case 'submit': echo '送出申請'; break;
            case 'confirm-submit': echo render_icon('check').' 確認送出'; break;
            case 'cancel-submit': echo render_icon('times').' 取消送出'; break;
            case 'submit-message': echo '請再次確認送出之場地申請資料！<br/><span style="color: red">審核通過後，請自行至器材借用紀錄列印“器材借用提領單”</span>'; break;
            case 'no-device-selected': echo '目前未選擇任何器材'; break;
            case 'ready': echo '器材借用申請資料即將送出'; break;
            case 'more-info': echo '若借用器材資料過多，請上下捲動以檢視更多'; break;
            case 'label': switch($params[3]) {
              case 'device': echo '器材：'; break;
              case 'device-list': echo '申請借用器材列表：'; break;
              case 'select-device': echo '請選擇器材'; break;
              case 'current-available': echo '當日剩餘器材數量：'; break;
              case 'max-lease-count': echo '單次最多借用數量：'; break;
              case 'date': echo '日期（請先選擇日期再指定借用器材）：'; break;
              case 'end-date': echo '結束借用日期：'; break;
              case 'organization': echo '單位（社團）名稱：'; break;
              case 'applicant': echo '申請人姓名：'; break;
              case 'applicant-position': echo '申請人（社團）職稱：'; break;
              case 'phone': echo '申請人聯絡電話：'; break;
              case 'purpose': echo '器材借用目的（請簡述）：'; break;
            } break;
            case 'submit-info': switch($params[3]) {
              case 'date': echo '借用日期：'; break;
              case 'end-date': echo '結束借用日期：'; break;
              case 'device-list': echo '借用器材列表'; break;
              case 'organization': echo '借用單位：'; break;
              case 'applicant': echo '申請人姓名：'; break;
              case 'applicant-position': echo '申請人職稱：'; break;
              case 'phone'; echo '申請人聯絡電話：'; break;
              case 'purpose': echo '器材使用目的：'; break;
            } break;
          } break;

          case 'device-apply-delete': switch($params[2]) {
            case 'title': echo '取消器材借用申請'; break;
            case 'table-title': echo '以下為您正在審核以及通過之器材借用申請：'; break;
            case 'no-record': echo '您尚未有任何審核以及通過之器材借用申請'; break;
            case 'cancel-apply': echo '取消申請'; break;
            case 'table-headers': switch($params[3]) {
              case 'apply-at': echo '提出申請時間'; break;
              case 'status': echo '申請狀態'; break;
              case 'date': echo '借用日期'; break;
              case 'end-date': echo '結束借用日期'; break;
              case 'action': echo '工具'; break;
            } break;
            case 'swal': switch($params[3]) {
              case 'title': echo '您即將要取消此器材申請'; break;
              case 'date': echo '借用日期：'; break;
              case 'end-date': echo '結束借用日期：'; break;
              case 'status': echo '申請狀態：'; break;
              case 'device-list': echo '申請之器材清單：'; break;
              case 'organization': echo '申請單位：'; break;
              case 'applicant': echo '申請人姓名：'; break;
              case 'phone': echo '申請人電話：'; break;
              case 'purpose': echo '申請目的：'; break;
              case 'ask': echo '確定要取消以上申請嗎？'; break;
              case 'confirm': echo '確定'; break;
              case 'cancel': echo '取消'; break;
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
            case 'error-title': echo 'Internal Error Occurred！'; break;
            case 'error-message': echo 'Internal system error occurred, please contact relevant personnel.'; break;
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
          case 'signin': switch($params[2]) {
            case 'title': echo 'Sign In'; break;
            case 'failure': echo 'Sign In Failure！'; break;
            case 'failure-message': echo 'Please check your input and try again!'; break;
            case 'student-id-placeholder': echo 'Please Enter your Student ID'; break;
            case 'password-placeholder': echo 'Please Enter your Student Password'; break;
            case 'signin': echo 'Sign In'; break;
            case 'remark': echo 'Hint: It is recommended to use browsers other than IE or Edge'; break;
          } break;

          case 'classroom': switch($params[2]) {
            case 'apply-notice': switch($params[3]) {
              case 'read-notice': echo 'Before using the system, please read the following classroom leasing notice :'; break;
            } break;
          } break;

          case 'classroom-apply-new': switch($params[2]) {
            case 'title': echo 'Apply Place Leasing'; break;
            case 'apply-fail': echo 'Failure Record！'; break;
            case 'apply-fail-message': echo 'Please check the input data and try again'; break;
            case 'cancel-all': echo 'Cancel All'; break;
            case 'submit': echo 'Submit'; break;
            case 'label': switch($params[3]) { 
              case 'classroom': echo 'Place：'; break;
              case 'select-classroom': echo 'Please select place'; break;
              case 'date': echo 'Date：'; break;
              case 'time': echo 'Time: (pendings are marked as blue, reds are the time which is not allowed, orange is for the time that already has leasing)'; break;
              case 'organization': echo 'Organization(Club)：'; break;
              case 'applicant': echo 'Applicant：'; break;
              case 'applicant-position': echo 'Applicant Position in Organization(Club)：'; break;
              case 'phone': echo 'Phone：'; break;
              case 'participant-count': echo 'Number of Participant：'; break;
              case 'purpose': echo 'Purpose(Description)：'; break;
            } break;
          } break;

          case 'classroom-apply-record': switch($params[2]) {
            case 'title': echo 'Record'; break;
            case 'table-title': echo 'Applied applications are listed below：'; break;
            case 'no-record': echo 'You haven\'t applied any application yet'; break;
            case 'table-headers': switch($params[3]) {
              case 'status': echo 'Status'; break;
              case 'place': echo 'Place'; break;
              case 'date': echo 'Date'; break;
              case 'time': echo 'Time'; break;
              case 'apply-at': echo 'Apply Time'; break;
            } break;
          } break;
          case 'classroom-apply-delete': switch($params[2]) {
            case 'title': echo 'Apply Cancel'; break;
            case 'table-title': echo 'The following are the details of the pending or approved applications：'; break;
            case 'no-record': echo 'You haven\'t had any applications yet.'; break;
            case 'cancel-apply': echo 'Cancel Apply'; break;
            case 'table-headers': switch($params[3]) {
              case 'apply-at': echo 'Apply Timing'; break;
              case 'status': echo 'Status'; break;
              case 'place': echo 'Place'; break;
              case 'date': echo 'Date'; break;
              case 'time': echo 'Time'; break;
              case 'cancel-apply': echo 'Cancel Apply'; break;
            } break;
            case 'swal': switch($params[2]) {
              case 'title': echo 'You are going to cancel application'; break;
              case 'status': echo 'Status：'; break;
              case 'place': echo 'Place：'; break;
              case 'date': echo 'Date：'; break;
              case 'time': echo 'Time：'; break;
              case 'ask': echo 'Are you sure to cancel down the application？'; break;
              case 'confirm': echo 'Confirm'; break;
              case 'cancel': echo 'Cancel'; break;
            } break;
          } break;

          case 'device-apply-new': switch($params[2]) {
            case 'title': echo 'Apply Device Leasing'; break;
            case 'apply-fail': echo 'Failure Record！'; break;
            case 'apply-fail-message': echo 'Please check the input data and try again'; break;
            case 'cancel-all': echo 'Cancel All'; break;
            case 'submit': echo 'Submit'; break;
            case 'confirm-submit': echo render_icon('check').' Confirm'; break;
            case 'cancel-submit': echo render_icon('times').' Cancel'; break;
            case 'submit-message': echo 'Please reconfirm the device leasing application！<br/><span style="color: red">After apply succeeded, please remember to print out the "Device Leasing Sheet" in leasing record section</span>'; break;
            case 'no-device-selected': echo 'Currently there are no device selected'; break;
            case 'ready': echo 'Application is going to submit'; break;
            case 'more-info': echo 'When there are too much device leasing information, please scroll down to view more'; break;
            case 'label': switch($params[3]) {
              case 'device': echo 'Device：'; break;
              case 'device-list': echo 'Leasing device list：'; break;
              case 'select-device': echo 'Please select device'; break;
              case 'current-available': echo 'Available：'; break;
              case 'max-lease-count': echo 'Max Lease per Application：'; break;
              case 'date': echo 'Date(Please choose the date first and then appoint leasing devices)：'; break;
              case 'end-date': echo 'Expiration Time：'; break;
              case 'organization': echo 'Organization(Club)：'; break;
              case 'applicant': echo 'Applicant：'; break;
              case 'applicant-position': echo 'Applicant Position in Organization(Club)：'; break;
              case 'phone': echo 'Phone：'; break;
              case 'purpose': echo 'Purpose(Description)：'; break;
            } break;
            case 'submit-info': switch($params[3]) {
              case 'date': echo 'Date：'; break;
              case 'end-date': echo 'Expiration Time：'; break;
              case 'device-list': echo 'Device List'; break;
              case 'organization': echo 'Organization：'; break;
              case 'applicant': echo 'Applicant：'; break;
              case 'applicant-position': echo 'Applicant Position：'; break;
              case 'phone'; echo 'Phone：'; break;
              case 'purpose': echo 'Purpose(Description)：'; break;
            } break;
          } break;

          case 'device-apply-delete': switch($params[2]) {
            case 'title': echo 'Cancel Device Leasing Application'; break;
            case 'table-title': echo 'Pending and approved leasing applications are listed below：'; break;
            case 'no-record': echo 'You haven\'t have any applications yet.'; break;
            case 'cancel-apply': echo 'Cancel Apply'; break;
            case 'table-headers': switch($params[3]) {
              case 'apply-at': echo 'Apply Timing'; break;
              case 'status': echo 'Status'; break;
              case 'date': echo 'Date'; break;
              case 'end-date': echo 'Expiration Date'; break;
              case 'action': echo 'Action'; break;
            } break;
            case 'swal': switch($params[3]) {
              case 'title': echo 'You are going to cancel application'; break;
              case 'date': echo 'Date：'; break;
              case 'end-date': echo 'Expiration Date：'; break;
              case 'status': echo 'Status：'; break;
              case 'device-list': echo 'Device List'; break;
              case 'organization': echo 'Organization：'; break;
              case 'applicant': echo 'Applicant：'; break;
              case 'phone': echo 'Phone：'; break;
              case 'purpose': echo 'Purpose：'; break;
              case 'ask': echo 'Are you sure to cancel down application'; break;
              case 'confirm': echo 'Confirm'; break;
              case 'cancel': echo 'Cancel'; break;
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