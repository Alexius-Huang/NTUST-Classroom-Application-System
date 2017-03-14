<script>
$(document).ready(function() {
  function dynamicForm() {
    switch($('input[name="rule-type"]:checked').val()) {
      case '0':
        $('#date-field').css('display', 'block');
        $('#start-date-field').css('display', 'none');
        $('#end-date-field').css('display', 'none');
        $('#weekday-field').css('display', 'none');
        break;
      case '1':
        $('#date-field').css('display', 'none');
        $('#start-date-field').css('display', 'block');
        $('#end-date-field').css('display', 'block');
        $('#weekday-field').css('display', 'none');
        break;
      case '2':
        $('#date-field').css('display', 'none');
        $('#start-date-field').css('display', 'block');
        $('#end-date-field').css('display', 'block');
        $('#weekday-field').css('display', 'block');
        break;
    }
  }

  dynamicForm();
  $('input[type="radio"][name="rule-type"]').change(function(event) { dynamicForm(); });

  $('a#weekday-cancel-all').on('click', function() {
    $('input[name="weekday[]"]:checked').each(function() { $(this)[0].checked = false; });
    $('#weekday-field').find('label.active').removeClass('active');
    return false;
  });

  $('a#time-cancel-all').on('click', function() {
    $('input[name="time[]"]:checked').each(function() { $(this)[0].checked = false; });
    $('#time-field').find('label.active').removeClass('active');
    return false;
  });

  $('input#date, input#date-start, input#date-end').datepicker({
    format: 'yyyy-mm-dd',
    todayBtn: "linked",
    weekStart: 0,
    language: 'zh-TW'
  }).datepicker("setDate", moment().format("YYYY-MM-DD")).on("changeDate.datepicker", function(event) {
    $(this).datepicker("hide");
  });

  /* When submit the form */
  function assertStartDateShouldBeforeThanEndDate(acceptedCallback) {
    if ($('input#date-start').val() >= $('input#date-end').val()) {
      swal({
        type: 'error',
        title: '請檢查輸入日期！',
        text: '開始日期須設定在結束日期之前',
        timer: 1500,
        showConfirmButton: false
      });
    } else acceptedCallback.call();
  }

  function assertWeekdayFieldShouldNotBeEmpty(acceptedCallback) {
    if ($('input[name="weekday[]"]:checked').length == 0) {
      swal({
        type: 'error',
        title: '有項目未填到！',
        text: '請記得選擇星期項目！',
        timer: 1500,
        showConfirmButton: false
      });
    } else acceptedCallback.call();
  }

  function assertTimeFieldShouldNotBeEmpty(acceptedCallback) {
    if ($('input[name="time[]"]:checked').length == 0) {
      swal({
        type: 'error',
        title: '有項目未填到！',
        text: '請記得選擇時段項目！',
        timer: 1500,
        showConfirmButton: false
      });
    } else acceptedCallback.call();
  }

  function assertPurposeFieldShouldNotBeEmpty(acceptedCallback) {
    if ($('input[name="purpose"]').val() == '') {
      swal({
        type: 'error',
        title: '有項目未填到！',
        text: '請記得選擇原由！',
        timer: 1500,
        showConfirmButton: false
      });
    } else acceptedCallback.call();
  }

  $('button#create-new-rule').on('click', function(event) {
    event.preventDefault();
    switch($('input[name="rule-type"]:checked').val()) {
      case '0':
        assertPurposeFieldShouldNotBeEmpty(function() {
          assertTimeFieldShouldNotBeEmpty(function() {
            $('form#create-new-rule-form').submit();
          });
        });
        break;
      case '1':
        assertPurposeFieldShouldNotBeEmpty(function() {
          assertStartDateShouldBeforeThanEndDate(function() {
            assertTimeFieldShouldNotBeEmpty(function() {
              $('form#create-new-rule-form').submit();
            });
          });
        });
        break;
      case '2':
        assertPurposeFieldShouldNotBeEmpty(function() {
          assertStartDateShouldBeforeThanEndDate(function() {
            assertWeekdayFieldShouldNotBeEmpty(function() {
              assertTimeFieldShouldNotBeEmpty(function() {
                $('form#create-new-rule-form').submit();
              });
            });
          });
        });
        break;
    }
  })
});
</script>