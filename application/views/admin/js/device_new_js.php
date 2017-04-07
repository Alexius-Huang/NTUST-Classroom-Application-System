<script>
$(document).ready(function() {
  function error_message(text, title) {
    swal({
      type: 'error',
      title: title || '有項目填錯！',
      text:  text,
      timer: 2000,
      showConfirmButton: false
    });
  }

  function match(value, regex) {
    return regex.test(value);
  }

  var validateDeviceNameFieldFilled = function() {
    return new Promise(function(resolve, reject) {
      if ($('#name-zh-TW').val() == "" || $('#name-en-us').val() == "") {
        error_message("請檢查器材中文以及英文名稱是否填妥");
      } else resolve();
    });
  }

  var validateTotalCountFieldFilled = function() {
    return new Promise(function(resolve, reject) {
      if (isNaN(parseInt($('#total-count').val())) || ! match(parseInt($('#total-count').val()), /^[0-9]*$/)) {
        error_message("器材總數量必須是數字");
      } else resolve();
    });
  }

  var validateTotalCountFieldIsPositive = function() {
    return new Promise(function(resolve, reject) {
      if (parseInt($('#total-count').val()) < 1) {
        error_message("器材總數量必須大於零", "數量有錯誤！");
      } else resolve();
    });
  }

  var validateMaxLeaseCountFieldFilled = function() {
    return new Promise(function(resolve, reject) {
      if (isNaN(parseInt($('#max-lease-count').val())) || ! match(parseInt($('#max-lease-count').val()), /^[0-9]*$/)) {
        error_message("器材單次最大借用數量必須是數字");
      } else resolve();
    });
  }

  var validateMaxLeaseCountFieldIsSmallerThanTotalCountAndPositive = function() {
    return new Promise(function(resolve, reject) {
      if (parseInt($('#max-lease-count').val()) < 1 || parseInt($('#max-lease-count').val()) > parseInt($('#total-count').val())) {
        error_message("器材單次最大借用數量必須大於零而且不大於總數量", "數量有錯誤！");
      } else resolve();
    });
  }

  var empty = function() {};

  $('button#create-new-device').on('click', function(event) {
    event.preventDefault();

    validateDeviceNameFieldFilled()
    .then(validateTotalCountFieldFilled, empty)
    .then(validateTotalCountFieldIsPositive, empty)
    .then(validateMaxLeaseCountFieldFilled, empty)
    .then(validateMaxLeaseCountFieldIsSmallerThanTotalCountAndPositive, empty)
    .then(function() {
      swal({
        title: '即將要新增器材',
        html: '<div class="box box-primary">' +
                '<div class="box-body text-left">' +
                  '<p>器材名稱：' + $('#name-zh-TW').val() + '(' + $('#name-en-us').val() + ')</p>' +
                  '<p>器材總數量：' + parseInt($('#total-count').val()) + '</p>' +
                  '<p>器材最大借用數量：' + parseInt($('#max-lease-count').val()) + '</p>' +
                  '<p>備註：' + $('#remark').val() + '</p>' +
                '</div>' +
              '</div>',
        showCancelButton: true,
        confirmButtonText: '<?php echo render_icon('check'); ?> 確定新增',
        cancelButtonText: '<?php echo render_icon('times'); ?> 取消新增',
        cancelButtonColor: '#dd4b39'
      }).then(function() {
        $('form#create-device-form').submit();
      }, empty);
    });

  });

});
</script>