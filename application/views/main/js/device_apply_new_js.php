<script>
$(document).ready(function() {
  function show_error_message(title, content) {
    <?php if ($lang === 'zh-TW'): ?>
      swal({
        title: title ? title : '錯誤！',
        type: 'error',
        text: content ? content : '系統內部似乎出錯，請聯絡相關負責人員！'
      });
    <?php elseif ($lang === 'en-us'): ?>
      swal({
        title: title ? title : 'Internal Error Occurred！',
        type: 'error',
        text: content ? content : 'Internal system error occurred, please contact relevant personnel.'
      });
    <?php endif; ?>
  }
  
  /* Geenerating Device Selection Object */
  var device_selectable = [];
  <?php foreach ($device_available as $device): ?>
  device_selectable.push({
    "id": <?php echo $device['id']; ?>,
    "name_zh-TW": "<?php echo $device['name_zh-TW']; ?>",
    "name_en-us": "<?php echo $device['name_en-us']; ?>",
    "available_count": null,
    "max_lease_count": <?php echo $device['max_lease_count']; ?>,
    "remark": "<?php echo $device['remark']; ?>"
  });
  <?php endforeach; ?>

  var $deviceSelect = $('select#device');
  $('#date').datepicker({
    format: "yyyy-mm-dd",
    weekStart: 0,
    startDate: moment().add(1, 'days').format('YYYY-MM-DD'),
    endDate: moment().add(1, 'month').format('YYYY-MM-DD'), // Restrict selectable date in 2 months
    language: '<?php echo $lang; ?>',
    beforeShowDay: function(date) {
      var today = moment().format('YYYY-MM-DD');
      var currentDate = moment(date).format('YYYY-MM-DD');
      var currentMonth = moment(date).format('MM');

      // if (currentDate > today && $classroomID != 0 && data[$classroomID] && data[$classroomID][currentDate]) {
      //   if (data[$classroomID][currentDate].disable) { return { classes: 'disabled date-full' }; }
      //   if (data[$classroomID][currentDate].status)  { return { classes: 'date-status' };        }
      // } else return;
    }
  }).datepicker('setDate', moment().format('YYYY-MM-DD')).on('changeDate.datepicker', function(event) {
    var date = moment(event.date).format('YYYY-MM-DD');
    
    /* Enable device list if originally disabled */
    if ($deviceSelect.is(':disabled')) { $deviceSelect.attr('disabled', false); }
    
    $.ajax({
      url: '<?php echo base_url(); ?>ajax/main/get_available_device_state_by_date',
      data: { date: date },
      dataType: 'json',
      type: 'post',
      cache: false,
      success: function(deviceTable) {
        console.log(Object.keys(deviceTable));
        for (var id of Object.keys(deviceTable)) {
          var device = deviceTable[id];
          var optionTag = document.createElement('option');
          optionTag.setAttribute('value', device.id);
          optionTag.innerHTML = device['name_<?php echo $lang; ?>'] +
                                " ( <?php i18n($lang, 'page.device-apply-new.label.current-available'); ?>" +
                                device.current_available +
                                " / <?php i18n($lang, 'page.device-apply-new.label.max-lease-count'); ?>" + device.max_lease_count + " )";
          $deviceSelect.append(optionTag);
        }
      },
      error: function() { show_error_message(); }
    });
  });


  var $date = '', $classroomID = 0, $datepciker_classes = [];

  /* When submit */
  $('button#application-submit-btn').on('click', function(event) {
    event.preventDefault();
    var data = {};

    var assertDateFieldShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#date').val() != '') {
          data['date'] = $('input#date').val();
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查未填項目！', '請選擇借用場地日期');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Remember to select date.')
        <?php endif; ?>
      });
    };

    var assertOrganizationShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#organization').val() != '') {
          data['organization'] = $('input#organization').val();
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查未填項目！', '請填入借用場地之單位名稱');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Remember to fill in organization (club).')
        <?php endif; ?>
      });
    };

    var assertApplicantShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#applicant').val() != '') {
          data['applicant'] = $('input#applicant').val();
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查未填項目！', '請填入借用場地之申請人姓名');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Remember to fill in applicant.')
        <?php endif; ?>
      });
    };

    var assertApplicantPositionShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#applicant-position').val() != '') {
          data['applicantPosition'] = $('input#applicant-position').val();
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查未填項目！', '請填入借用場地之申請人在單位（社團）職稱');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Remember to fill in applicant position in organization (club).')
        <?php endif; ?>
      });
    };

    var assertPhoneShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#phone').val() != '') {
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查未填項目！', '請填入借用場地之申請人聯絡電話');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Remember to fill in applicant phone.')
        <?php endif; ?>
      });
    };

    var assertPhoneShouldBeMatchNumberTypeRegex = function() {
      return new Promise(function(resolve, reject){
        if (/^\d+$/.test($('input#phone').val())) {
          data['phone'] = $('input#phone').val();
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查項目填錯有誤！', '申請人聯絡電話欄位有誤');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Check your phone field again. (Digit Only)')
        <?php endif; ?>
      });
    };

    var assertParticipantCountShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#participant-count').val() != '') {
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查未填項目！', '請記得填入使用場地人數');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Remember to fill in the count of participants.')
        <?php endif; ?>
      });
    };

    var assertParticipantCountShouldBeMatchNumberTypeRegex = function() {
      return new Promise(function(resolve, reject){
        if (/^\d+$/.test($('input#participant-count').val())) {
          data['participantCount'] = $('input#participant-count').val();
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查項目填錯有誤！', '場地使用人數只能包含數字');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Check your count of participants field again. (Digit Only)')
        <?php endif; ?>
      });
    };

    var assertPurposeShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#purpose').val() != '') {
          data['purpose'] = $('input#purpose').val();
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查未填項目！', '請記得填入借用場地之目的');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Remember to fill in the purpose of leasing.')
        <?php endif; ?>
      });
    };

    assertDateFieldShouldFilled()
    .then(assertOrganizationShouldFilled)
    .then(assertApplicantShouldFilled)
    .then(assertApplicantPositionShouldFilled)
    .then(assertPhoneShouldFilled)
    .then(assertPhoneShouldBeMatchNumberTypeRegex)
    .then(assertParticipantCountShouldFilled)
    .then(assertParticipantCountShouldBeMatchNumberTypeRegex)
    .then(assertPurposeShouldFilled)
    .then(function() {
      console.log(data);
      // $.ajax({
      //   type: 'post',
      //   data: { 'classroom_id': data.classroom_id },
      //   cache: false,
      //   dataType: 'json',
      //   url: '<?php echo base_url(); ?>ajax/main/get_classroom_name',
      //   success: function(query) {
      //     swal({
      //       title: '<?php echo ($lang === 'zh-TW' ? '場地借用申請資料即將送出' : 'Application is going to submit'); ?>',
      //       html: '<div class="box box-primary">' +
      //               '<div class="box-body">' +
      //                 '<span class="text-left">' +
      //                   '<p><?php echo ($lang === 'zh-TW' ? '申請場地' : 'Apply Location') ?>：' + query.classroomName + '</p>' +
      //                   '<p><?php echo ($lang === 'zh-TW' ? '申請日期' : 'Date'); ?>：' + data.date + '</p>' +
      //                   '<p><?php echo ($lang === 'zh-TW' ? '申請時段' : 'Time'); ?>：' + data.times.join('、') + '</p>' +
      //                   '<p><?php echo ($lang === 'zh-TW' ? '申請單位' : 'Organization'); ?>：' + data.organization + '</p>' +
      //                   '<p><?php echo ($lang === 'zh-TW' ? '申請人姓名' : 'Applicant'); ?>：' + data.applicant + '</p>' +
      //                   '<p><?php echo ($lang === 'zh-TW' ? '申請人職稱' : 'Applicant Position'); ?>：' + data.applicantPosition + '</p>' +
      //                   '<p><?php echo ($lang === 'zh-TW' ? '申請人聯絡電話' : 'Phone'); ?>：' + data.phone + '</p>' +
      //                   '<p><?php echo ($lang === 'zh-TW' ? '場地人數' : 'Participant Count'); ?>：' + data.participantCount + '</p>' +
      //                   '<p><?php echo ($lang === 'zh-TW' ? '場地使用目的' : 'Purpose'); ?>：' + data.purpose + '</p>' +
      //                 '</span>' +
      //               '</div>' +
      //             '</div><p><strong><?php echo ($lang === 'zh-TW' ? '請再次確認送出之場地申請資料！<br/><span style="color: red">系學會申請場地均需至社團管理系統登錄活動申請</span>' : 'Please check your application again!' ); ?></strong></p>',
      //       showCancelButton: true,
      //       confirmButtonText: '<?php echo ($lang === 'zh-TW' ? '送出' : 'Submit' ) ?>',
      //       cancelButtonText: '<?php echo ($lang === 'zh-TW' ? '取消' : 'Cancel' ); ?>',
      //       cancelButtonColor: '#dd4b39'
      //     }).then(function() {
      //       data.ajax = true;
      //       $.ajax({
      //         type: 'post',
      //         cache: false,
      //         data: data,
      //         url: '<?php echo base_url(); ?>main/apply_new',
      //         success: function() { window.location = '<?php echo base_url(); ?>main/apply_record/<?php echo $lang; ?>'; },
      //         error: function() { show_error_message(); }
      //       });
      //     }, function(dismiss) { /* DO NOTHING */ });
      //   },
      //   error: function() { show_error_message(); }
      // });
    });
  });
});
</script>