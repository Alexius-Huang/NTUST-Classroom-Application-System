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
  var selected = [];
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
  var $deviceList = $('#device-list-group');
  var $deviceTable = null;

  function deviceOptionTitle(device) {
    return device['name_<?php echo $lang; ?>'] +
           " ( <?php i18n($lang, 'page.device-apply-new.label.current-available'); ?>" +
           device.current_available +
           " / <?php i18n($lang, 'page.device-apply-new.label.max-lease-count'); ?>" + device.max_lease_count + " )"
  }

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
        $deviceTable = JSON.parse(JSON.stringify(deviceTable));
        
        /* Remove original options if appears */
        if ($('select#device > option').first().siblings().length != 0) {
          $('select#device > option').first().siblings().each(function() {
            $(this).remove();
          });
        }

        /* Remove selected leased device if appears */
        if ($deviceList.children().length != 0) {
          $deviceList.children().each(function() {
            $(this).remove()
          });
          $deviceList.text('<?php i18n($lang, 'page.device-apply-new.no-device-selected'); ?>');
        }

        for (var id of Object.keys(deviceTable)) {
          var device = deviceTable[id];
          var optionTag = document.createElement('option');
          optionTag.setAttribute('value', device.id);
          optionTag.setAttribute('data-max', device.max_lease_count);
          optionTag.setAttribute('data-name', device['name_<?php echo $lang; ?>']);
          optionTag.innerHTML = deviceOptionTitle(device);
          $deviceSelect.append(optionTag);
        }
      },
      error: function() { show_error_message(); }
    });
  });

  $deviceSelect.on('change', function(event) {
    event.preventDefault();
    var selectedId = event.target.value;
    $deviceSelect.val('0');

    /* Generate Device List Item */
    var inputGroup = document.createElement('div');
    inputGroup.className = 'input-group';
    inputGroup.setAttribute('data-max', $deviceTable[Number(selectedId)].max_lease_count);
    inputGroup.setAttribute('data-name', $deviceTable[Number(selectedId)]['name_<?php echo $lang; ?>']);

    var addOn = document.createElement('div');
    addOn.className = 'input-group-addon';
    addOn.innerHTML = '<span data-id="' + selectedId + '"><?php echo render_icon('times'); ?></span> ' + $deviceTable[selectedId]['name_<?php echo $lang; ?>'];
    
    var deviceIDInput = document.createElement('input');
    deviceIDInput.setAttribute('name', 'device_ids[]');
    deviceIDInput.setAttribute('type', 'hidden');
    deviceIDInput.setAttribute('value', selectedId);

    var input = document.createElement('input');
    input.className = 'form-control';
    input.setAttribute('name', 'leasing_counts[]');
    input.setAttribute('type', 'text');
    
    inputGroup.appendChild(addOn);
    inputGroup.appendChild(deviceIDInput);
    inputGroup.appendChild(input);
    inputGroup.style.display = 'none';
    if ($('#device-list-group > div.input-group').length == 0) {
      $deviceList.html(inputGroup);
    } else {
      $deviceList.append(inputGroup);
    }
    $(inputGroup).fadeIn(500);

    $('option[value="' + selectedId + '"]').prop('disabled', true);
    
    $('span[data-id="' + selectedId + '"]').on('click', function(event) {
      $('option[value="' + selectedId + '"]').prop('disabled', false);
    
      $(this).parent().parent().remove();
      
      console.log($('#device-list-group > div.input-group').length);
      if ($('#device-list-group > div.input-group').length === 0) {
        $deviceList.text('<?php i18n($lang, 'page.device-apply-new.no-device-selected'); ?>');
      }
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

    var assertAtLeastOneDeviceSelected = function() {
      return new Promise(function(resolve, reject) {
        if ($('div#device-list-group').children().length === 0) {
          <?php if ($lang === 'zh-TW'): ?>
            show_error_message('請檢查未填項目！', '請至少借用一項器材');
          <?php elseif ($lang === 'en-us'): ?>
            show_error_message('Please check your input！', 'Please select at least one device.')
          <?php endif; ?>
        } else {
          data['device'] = [];
          var error = false;
          $('div#device-list-group').children().each(function() {
            var deviceId = $(this).find('input[name="device_ids[]"]').val();
            var leasing_count = $(this).find('input[name="leasing_counts[]"]').val();
            if (leasing_count && leasing_count > 0 && /^\d+$/g.test(leasing_count) && leasing_count <= $(this).data('max') ) {
              data['device'][deviceId] = leasing_count;
            } else if (leasing_count == 0) {
              <?php if ($lang === 'zh-TW'): ?>
                show_error_message('請檢查器材數量項目！', '器材借用數量有誤！' + $(this).data('name') + '最多只能借用數量為 ' + $(this).data('max') + ' 但不可為零或者空！');
              <?php elseif ($lang === 'en-us'): ?>
                show_error_message('Please check your input！', 'Device leasing count isn\'t correct. Max quantity of leasing ' + $(this).data('name').toLowerCase() + ' is ' + $(this).data('max') + ' but cannot be empty or zero!');
              <?php endif; ?>
              reject();
            } else {
              <?php if ($lang === 'zh-TW'): ?>
                show_error_message('請檢查器材數量項目！', '器材借用數量有誤！' + $(this).data('name') + '最多只能借用數量為 ' + $(this).data('max') + '!');
              <?php elseif ($lang === 'en-us'): ?>
                show_error_message('Please check your input！', 'Device leasing count isn\'t correct. Max quantity of leasing ' + $(this).data('name').toLowerCase() + ' is ' + $(this).data('max'));
              <?php endif; ?>
              reject();
            }
          });
          resolve();
        }
      })
    }

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
    .then(assertAtLeastOneDeviceSelected)
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