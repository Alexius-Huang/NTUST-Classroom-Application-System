<script>
$(document).ready(function() {
  /* Datepicker selection */
  $('#date').datepicker({
    format: "yyyy-mm-dd",
    weekStart: 0,
    startDate: moment().add(1, 'days').format('YYYY-MM-DD'),
    endDate: moment().add(2, 'months').format('YYYY-MM-DD'), // Restrict selectable date in 2 months
    language: 'zh-TW'
  }).datepicker('setDate', moment().format('YYYY-MM-DD')).on('changeDate.datepicker', function(event) {
    $('#date').datepicker('hide');
  });

  /* Cancel all time button  */
  $('a#cancel-all-time-btn').on('click', function(event) {
    event.preventDefault();
    $('input[name="times[]"]:checked').each(function() { $(this)[0].checked = false; });
    $('#time-field').find('label.active').removeClass('active');
    return false;
  });

  /* When submit */
  function show_error_message(title, content) {
    swal({
      title: title ? title : '錯誤！',
      type: 'error',
      text: content ? content : '系統內部似乎出錯，請聯絡相關負責人員！'
    });
  }

  $('button#application-submit-btn').on('click', function(event) {
    event.preventDefault();
    var data = {};
    var assertClassroomFieldShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('select#classroom').val() != '0') {
          data['classroom_id'] = $('select#classroom').val();
          resolve();
        } else show_error_message('請檢查未填項目！', '請記得選擇借用場地');
      });
    };
        
    var assertDateFieldShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#date').val() != '') {
          data['date'] = $('input#date').val();
          resolve();
        } else show_error_message('請檢查未填項目！', '請選擇借用場地日期');
      });
    };
    
    var assertTimeFieldShouldSelect = function() {
      return new Promise(function(resolve, reject){
        if ($('input[name="times[]"]:checked').length != 0) {
          data['times'] = [];
          $('input[name="times[]"]:checked').each(function() {
            data['times'].push($(this).val());
          });
          resolve();
        } else show_error_message('請檢查未填項目！', '請選擇借用場地時段');
      });
    };

    var assertOrganizationShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#organization').val() != '') {
          data['organization'] = $('input#organization').val();
          resolve();
        } else show_error_message('請檢查未填項目！', '請記得填入借用場地之單位名稱');
      });
    };

    var assertApplicantShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#applicant').val() != '') {
          data['applicant'] = $('input#applicant').val();
          resolve();
        } else show_error_message('請檢查未填項目！', '請記得填入借用場地之申請人姓名');
      });
    };

    var assertApplicantPositionShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#applicant-position').val() != '') {
          data['applicantPosition'] = $('input#applicant-position').val();
          resolve();
        } else show_error_message('請檢查未填項目！', '請記得填入借用場地之申請人在單位(社團)職稱');
      });
    };

    var assertPhoneShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#phone').val() != '') {
          resolve();
        } else show_error_message('請檢查未填項目！', '請記得填入借用場地之申請人聯絡電話');
      });
    };

    var assertPhoneShouldBeMatchNumberTypeRegex = function() {
      return new Promise(function(resolve, reject){
        if (/^\d+$/.test($('input#phone').val())) {
          data['phone'] = $('input#phone').val();
          resolve();
        } else show_error_message('請檢查項目填錯有誤！', '申請人聯絡電話欄位有誤');
      });
    };

    var assertParticipantCountShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#participant-count').val() != '') {
          resolve();
        } else show_error_message('請檢查未填項目！', '請記得填入使用場地人數');
      });
    };

    var assertParticipantCountShouldBeMatchNumberTypeRegex = function() {
      return new Promise(function(resolve, reject){
        if (/^\d+$/.test($('input#participant-count').val())) {
          data['participantCount'] = $('input#participant-count').val();
          resolve();
        } else show_error_message('請檢查項目填錯有誤！', '場地使用人數只能包含數字');
      });
    };

    var assertPurposeShouldFilled = function() {
      return new Promise(function(resolve, reject){
        if ($('input#purpose').val() != '') {
          data['purpose'] = $('input#purpose').val();
          resolve();
        } else show_error_message('請檢查未填項目！', '請簡述場地借用之目的');
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
          swal({
            title: '場地借用申請資料即將送出',
            html: '<div class="box box-primary">' +
                    '<div class="box-body">' +
                      '<span class="text-left">' +
                        '<p>申請場地：' + query.classroomName + '</p>' +
                        '<p>申請日期：' + data.date + '</p>' +
                        '<p>申請時段：' + data.times.join('、') + '</p>' +
                        '<p>申請單位：' + data.organization + '</p>' +
                        '<p>申請人姓名：' + data.applicant + '</p>' +
                        '<p>申請人職稱：' + data.applicantPosition + '</p>' +
                        '<p>申請人聯絡電話：' + data.phone + '</p>' +
                        '<p>場地人數：' + data.participantCount + '</p>' +
                        '<p>場地使用目的：' + data.purpose + '</p>' +
                      '</span>' +
                    '</div>' +
                  '</div><p><strong>請再次確認送出之場地申請資料！</strong></p>',
            showCancelButton: true,
            confirmButtonText: '送出',
            cancelButtonText: '取消',
            cancelButtonColor: '#dd4b39'
          }).then(function() {
            $('form#form_apply').submit();
          }, function(dismiss) { /* DO NOTHING */ });
        },
        error: function() { show_error_message(); }
      });
    });
  });
});
</script>