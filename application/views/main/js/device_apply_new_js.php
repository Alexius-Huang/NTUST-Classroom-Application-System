<script>
$(document).ready(function() {
  function show_error_message(title, content) {
    swal({
      title: title ? title : '<?php i18n($lang, 'general.system.error-title'); ?>',
      type: 'error',
      text: content ? content : '<?php i18n($lang, 'general.system.error-message'); ?>'
    });
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

  var $dateConfig = function(beforeShowDayCallback){
    return  {
      format: "yyyy-mm-dd",
      weekStart: 0,
      startDate: moment().add(1, 'days').format('YYYY-MM-DD'),
      endDate: moment().add(2, 'weeks').format('YYYY-MM-DD'), // Restrict selectable date in 2 months
      language: '<?php echo $lang; ?>',
      daysOfWeekDisabled: [0, 6],
      beforeShowDay: function(date) { beforeShowDayCallback(date); }
    };
  };

  var $endDateConfig = function(beforeShowDayCallback) {
    return {
      format: 'yyyy-mm-dd',
      weekStart: 0,
      startDate: moment().add(1, 'days').format('YYYY-MM-DD'),
      endDate: moment().add(1, 'days').format('YYYY-MM-DD'),
      language: '<?php echo $lang; ?>',
      daysOfWeekDisabled: [0, 6],
      beforeShowDay: function(date) { beforeShowDayCallback(date); }
    };
  };

  function resetEndDateRange(startDate) {
    $('#end_date').datepicker('clearDates')
                  .datepicker('setStartDate', moment(startDate).add(1, 'day').format('YYYY-MM-DD'))
                  .datepicker('setEndDate', moment(startDate).add(7, 'days').format('YYYY-MM-DD'));
  };

  function getAvailableDeviceInfo(date, endDate, callback) {
    $.ajax({
      url: '<?php echo base_url(); ?>ajax/main/get_available_device_info_by_date_range',
      data: { date: date, end_date: endDate },
      dataType: 'json',
      type: 'post',
      cache: false,
      success: function(deviceInfo) { callback(deviceInfo) },
      error: function() { show_error_message(); }
    });
  }

  function clearDeviceOption() {
    /* Remove original options if appears */
    if ($('select#device > option').first().siblings().length != 0) {
      $('select#device > option').first().siblings().each(function() {
        $(this).remove();
      });
    }
  }

  function clearDeviceList() {
    /* Remove selected leased device if appears */
    if ($deviceList.children().length != 0) {
      $deviceList.children().each(function() {
        $(this).remove()
      });
      $deviceList.text('<?php i18n($lang, 'page.device-apply-new.no-device-selected'); ?>');
    }
  }

  $('#date').datepicker($dateConfig(function(date) {
    var today = moment().format('YYYY-MM-DD');
    var currentDate = moment(date).format('YYYY-MM-DD');
    var currentMonth = moment(date).format('MM');
  })).datepicker('setDate', moment().format('YYYY-MM-DD')).on('changeDate.datepicker', function(event) {
    var date = moment(event.date).format('YYYY-MM-DD');
    if ($('#end_date').is(':disabled')) { $('#end_date').prop('disabled', false); }
    resetEndDateRange(date);
    $deviceSelect.attr('disabled', true);
    clearDeviceOption();
    clearDeviceList();
  });

  $('#end_date').datepicker($endDateConfig(function(date) {
    clearDeviceOption();
    clearDeviceList();
  })).datepicker('setDate', moment().format('YYYY-MM-DD')).on('changeDate.datepicker', function(event) {
    var date = $('#date').val(), endDate = $('#end_date').val();
    if (date && endDate) {
      getAvailableDeviceInfo(date, endDate, function(deviceTable) {
        $deviceTable = JSON.parse(JSON.stringify(deviceTable));

        for (var id of Object.keys(deviceTable)) {
          var device = deviceTable[id];
          var optionTag = document.createElement('option');
          optionTag.setAttribute('value', device.id);
          optionTag.setAttribute('data-max', device.max_lease_count);
          optionTag.setAttribute('data-available', device.current_available);
          optionTag.setAttribute('data-name', device['name_<?php echo $lang; ?>']);
          optionTag.innerHTML = deviceOptionTitle(device);
          if (device.current_available <= 0) {
            optionTag.setAttribute('disabled', true);
          }
          $deviceSelect.append(optionTag);
        }

        if ($deviceSelect.is(":disabled")) { $deviceSelect.attr('disabled', false); }
      });
    }
  });

  $('input#end_date').prop('disabled', true);

  /* Option onclick event */
  $deviceSelect.on('change', function(event) {
    event.preventDefault();
    var selectedId = event.target.value;
    $deviceSelect.val('0');

    /* Generate Device List Item */
    var inputGroup = document.createElement('div');
    inputGroup.className = 'input-group';
    inputGroup.setAttribute('data-max', $deviceTable[Number(selectedId)].max_lease_count);
    inputGroup.setAttribute('data-available', $deviceTable[Number(selectedId)].current_available);
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

  /* When submit */
  $('button#application-submit-btn').on('click', function(event) {
    event.preventDefault();
    var data = {};
    /* ASSERT FIELDS */
      var assertDateFieldShouldFilled = function() {
        return new Promise(function(resolve, reject){
          if ($('input#date').val() != '') {
            data['date'] = $('input#date').val();
            resolve();
          } else <?php if ($lang === 'zh-TW'): ?>
            show_error_message('請檢查未填項目！', '請選擇借用器材日期');
          <?php elseif ($lang === 'en-us'): ?>
            show_error_message('Please check your input！', 'Remember to select date.')
          <?php endif; ?>
        });
      };

      var assertEndDateFieldShouldFilled = function() {
        return new Promise(function(resolve, reject){
          if ($('input#end_date').val() != '') {
            data['end_date'] = $('input#end_date').val();
            resolve();
          } else <?php if ($lang === 'zh-TW'): ?>
            show_error_message('請檢查未填項目！', '請選擇結束借用日期');
          <?php elseif ($lang === 'en-us'): ?>
            show_error_message('Please check your input！', 'Remember to select expiration date.')
          <?php endif; ?>
        });
      };

      var assertAtLeastOneDeviceSelected = function() {
        return new Promise(function(resolve, reject) {
          if ($deviceList.children().length === 0) {
            <?php if ($lang === 'zh-TW'): ?>
              show_error_message('請檢查未填項目！', '請至少借用一項器材');
            <?php elseif ($lang === 'en-us'): ?>
              show_error_message('Please check your input！', 'Please select at least one device.')
            <?php endif; ?>
          } else {
            data['device'] = {};
            var error = false;
            $deviceList.children().each(function() {
              var deviceId = $(this).find('input[name="device_ids[]"]').val();
              console.log($(this).data('available'))
              var leasing_count = $(this).find('input[name="leasing_counts[]"]').val();
              if (leasing_count && leasing_count > 0 && /^\d+$/g.test(leasing_count) && leasing_count <= $(this).data('max') && leasing_count <= $(this).data('available') ) {
                data['device'][deviceId] = parseInt(leasing_count, 10);
              } else if (leasing_count > $(this).data('available')) {
                <?php if ($lang === 'zh-TW'): ?>
                  show_error_message('請檢查器材數量項目！', '器材借用數量有誤！' + $(this).data('name') + ' 當日剩餘借用數量為 ' + $(this).data('available') + '！');
                <?php elseif ($lang === 'en-us'): ?>
                  show_error_message('Please check your input！', 'Device leasing count isn\'t correct. Remaining quantity of device : ' + $(this).data('name').toLowerCase() + ' is ' + $(this).data('available') + ' !');
                <?php endif; ?>
                reject();
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
    /* ASSERT FIELDS */

    assertDateFieldShouldFilled()
    .then(assertEndDateFieldShouldFilled)
    .then(assertAtLeastOneDeviceSelected)
    .then(assertOrganizationShouldFilled)
    .then(assertApplicantShouldFilled)
    .then(assertApplicantPositionShouldFilled)
    .then(assertPhoneShouldFilled)
    .then(assertPhoneShouldBeMatchNumberTypeRegex)
    .then(assertPurposeShouldFilled)
    .then(function() {
      console.log(data.device);
      // return;
      var html = '<div class="box box-primary">' +
                '<div class="box-body pre-scrollable">' +
                  '<span class="text-left">' +
                    '<p><?php i18n($lang, 'page.device-apply-new.more-info'); ?></p>' +
                    '<p><?php i18n($lang, 'page.device-apply-new.submit-info.date'); ?>' + data.date + '</p>' +
                    '<p><?php i18n($lang, 'page.device-apply-new.submit-info.end-date'); ?>' + data.end_date + '</p>' +
                    '<p><?php i18n($lang, 'page.device-apply-new.submit-info.device-list'); ?>' +
                      '<ul class="list-group">';
      
      $deviceList.children().each(function() {
        var deviceName = $(this).data('name');
        var deviceCount = $(this).find('input[name="leasing_counts[]"]').val();
        html +=         '<li class="list-group-item">' + deviceName + ' - ' + parseInt(deviceCount, 10) + '</li>';
      });

      html +=         '</ul>' +
                    '</p>' +
                    '<p><?php i18n($lang, 'page.device-apply-new.submit-info.organization'); ?>' + data.organization + '</p>' +
                    '<p><?php i18n($lang, 'page.device-apply-new.submit-info.applicant'); ?>' + data.applicant + '</p>' +
                    '<p><?php i18n($lang, 'page.device-apply-new.submit-info.applicant-position'); ?>' + data.applicantPosition + '</p>' +
                    '<p><?php i18n($lang, 'page.device-apply-new.submit-info.phone'); ?>' + data.phone + '</p>' +
                    '<p><?php i18n($lang, 'page.device-apply-new.submit-info.purpose'); ?>' + data.purpose + '</p>' +
                  '</span>' +
                '</div>' +
              '</div><p><strong><?php i18n($lang, 'page.device-apply-new.submit-message'); ?></strong></p>'
              
      swal({
        title: '<?php i18n($lang, 'page.device-apply-new.ready'); ?>',
        html: html,
        showCancelButton: true,
        confirmButtonText: '<?php i18n($lang, 'page.device-apply-new.confirm-submit'); ?>',
        cancelButtonText: '<?php i18n($lang, 'page.device-apply-new.cancel-submit'); ?>',
        cancelButtonColor: '#dd4b39'
      }).then(function() {
        // data.ajax = true;
        $.ajax({
          type: 'post',
          cache: false,
          data: data,
          url: '<?php echo base_url(); ?>main/device_apply_new/<?php echo $lang; ?>',
          success: function() { window.location = '<?php echo base_url(); ?>main/device_apply_record/<?php echo $lang; ?>'; },
          error: function() { show_error_message(); }
        });
        console.log('should submit')
      }, function(dismiss) { /* DO NOTHING */ });
    });
  });
});
</script>