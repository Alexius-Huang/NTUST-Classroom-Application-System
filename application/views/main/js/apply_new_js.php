<script>
$(document).ready(function() {
  function show_error_message(title, content) {
    swal({
      title: title ? title : '<?php i18n($lang, 'general.system.error-title'); ?>',
      type: 'error',
      text: content ? content : '<?php i18n($lang, 'general.system.error-message'); ?>'
    });
  }

  function get_time_state() {
    $.ajax({
      type: 'post',
      data: { classroom_id: $classroomID, date: $date },
      dataType: 'json',
      cache: false,
      url: '<?php echo base_url(); ?>ajax/main/get_time_state',
      success: function(data) {
        //console.log(data);
        var timeArray = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D'];
        for (var time of timeArray) {
          var label = $('label#time' + time);
          var checkbox = $('input#time' + time);
          switch(data['time' + time]) {
            case 'disabled':
              label.addClass('disabled btn-danger');
              label.removeClass('btn-default btn-warning btn-primary');
              checkbox.addClass('disabled');  
              break;
            case 'await':
              label.addClass('btn-primary');
              label.removeClass('btn-default btn-danger btn-warning disabled');
              checkbox.removeClass('disabled');
              break;
            case 'checked':
              label.addClass('disabled btn-warning');
              label.removeClass('btn-default btn-primary btn-danger');
              checkbox.addClass('disabled');  
              break;
            default:
              label.addClass('btn-default');
              label.removeClass('btn-warning btn-danger btn-primary disabled');
              checkbox.removeClass('disabled');
          }
        }
      },
      error: function() { show_error_message(); }
    });
  }

  var $date = '', $classroomID = 0, $datepciker_classes = [];
  
  /* Before Datepicker selection => load classes */  
  $.ajax({
    type: 'post',
    cache: false,
    data: { without_auth: true },
    dataType: 'json',
    url: '<?php echo base_url(); ?>ajax/main/get_datepicker_class_in_apply_page',
    success: function(data) {
      
      // console.log(data);
      
      $('#date').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 0,
        startDate: moment().add(1, 'days').format('YYYY-MM-DD'),
        endDate: moment().add(2, 'months').format('YYYY-MM-DD'), // Restrict selectable date in 2 months
        language: '<?php echo $lang; ?>',
        beforeShowDay: function(date) {
          var today = moment().format('YYYY-MM-DD');
          var currentDate = moment(date).format('YYYY-MM-DD');
          var currentMonth = moment(date).format('MM');

          if (currentDate > today && $classroomID != 0 && data[$classroomID] && data[$classroomID][currentDate]) {
            if (data[$classroomID][currentDate].disable) { return { classes: 'disabled date-full' }; }
            if (data[$classroomID][currentDate].status)  { return { classes: 'date-status' };        }
          } else return;
        }
      }).datepicker('setDate', moment().format('YYYY-MM-DD')).on('changeDate.datepicker', function(event) {
        $('#date').datepicker('hide');
        $datepciker_classes = [];
        $date = moment(event.date).format('YYYY-MM-DD');
        if ($classroomID != 0 && $date !== '') { get_time_state(); }
      });

    },
    error: function() { show_error_message(); }
  });

  $('select#classroom').change(function(event) {
    $classroomID = event.target.value;
    $('#date').datepicker('update');
    $datepciker_classes = [];
    if ($classroomID != 0 && $date !== '') { get_time_state(); }
  });

  /* Cancel all time button  */
  $('a#cancel-all-time-btn').on('click', function(event) {
    event.preventDefault();
    $('input[name="times[]"]:checked').each(function() { $(this)[0].checked = false; });
    $('#time-field').find('label.active').removeClass('active');
    return false;
  });

  /* When submit */
  $('button#application-submit-btn').on('click', function(event) {
    event.preventDefault();
    var data = {};
    var assertClassroomFieldShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('select#classroom').val() != '0') {
          data['classroom_id'] = $('select#classroom').val();
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查未填項目！', '請記得選擇借用場地');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Remember to select place.');
        <?php endif; ?>
      });
    };
        
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
    
    var assertTimeFieldShouldSelect = function() {
      return new Promise(function(resolve, reject){
        if ($('input[name="times[]"]:checked:not(.disabled)').length != 0) {
          data['times'] = [];
          $('input[name="times[]"]:checked:not(.disabled)').each(function() {
            data['times'].push($(this).val());
          });
          resolve();
        } else <?php if ($lang === 'zh-TW'): ?>
          show_error_message('請檢查未填項目！', '請選擇借用場地時段');
        <?php elseif ($lang === 'en-us'): ?>
          show_error_message('Please check your input！', 'Remember to select time.')
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

    assertClassroomFieldShouldFilled()
    .then(assertDateFieldShouldFilled)
    .then(assertTimeFieldShouldSelect)
    .then(assertOrganizationShouldFilled)
    .then(assertApplicantShouldFilled)
    .then(assertApplicantPositionShouldFilled)
    .then(assertPhoneShouldFilled)
    .then(assertPhoneShouldBeMatchNumberTypeRegex)
    .then(assertParticipantCountShouldFilled)
    .then(assertParticipantCountShouldBeMatchNumberTypeRegex)
    .then(assertPurposeShouldFilled)
    .then(function() {
      $.ajax({
        type: 'post',
        data: { 'classroom_id': data.classroom_id },
        cache: false,
        dataType: 'json',
        url: '<?php echo base_url(); ?>ajax/main/get_classroom_name',
        success: function(query) {
          <?php $i18n_str = 'page.classroom-apply-new.swal.'; ?>
          swal({
            title: '<?php i18n($lang, $i18n_str.'ready'); ?>',
            html: '<div class="box box-primary">' +
                    '<div class="box-body">' +
                      '<span class="text-left">' +
                        '<p><?php i18n($lang, $i18n_str.'place') ?>' + query.classroomName + '</p>' +
                        '<p><?php i18n($lang, $i18n_str.'date') ?>' + data.date + '</p>' +
                        '<p><?php i18n($lang, $i18n_str.'time') ?>' + data.times.join('、') + '</p>' +
                        '<p><?php i18n($lang, $i18n_str.'organization') ?>' + data.organization + '</p>' +
                        '<p><?php i18n($lang, $i18n_str.'applicant') ?>' + data.applicant + '</p>' +
                        '<p><?php i18n($lang, $i18n_str.'applicant-position') ?>' + data.applicantPosition + '</p>' +
                        '<p><?php i18n($lang, $i18n_str.'phone') ?>' + data.phone + '</p>' +
                        '<p><?php i18n($lang, $i18n_str.'participant-count') ?>' + data.participantCount + '</p>' +
                        '<p><?php i18n($lang, $i18n_str.'purpose') ?>' + data.purpose + '</p>' +
                      '</span>' +
                    '</div>' +
                  '</div><p><strong><?php i18n($lang, $i18n_str.'confirm-message'); ?></strong></p>',
            showCancelButton: true,
            confirmButtonText: '<?php echo render_icon('check'); ?> <?php i18n($lang, $i18n_str.'confirm'); ?>',
            cancelButtonText: '<?php echo render_icon('times'); ?> <?php i18n($lang, $i18n_str.'cancel'); ?>',
            cancelButtonColor: '#dd4b39'
          }).then(function() {
            data.ajax = true;
            $.ajax({
              type: 'post',
              cache: false,
              data: data,
              url: '<?php echo base_url(); ?>main/apply_new',
              success: function() { window.location = '<?php echo base_url(); ?>main/apply_record/<?php echo $lang; ?>'; },
              error: function() { show_error_message(); }
            });
          }, function(dismiss) { /* DO NOTHING */ });
        },
        error: function() { show_error_message(); }
      });
    });
  });
});
</script>