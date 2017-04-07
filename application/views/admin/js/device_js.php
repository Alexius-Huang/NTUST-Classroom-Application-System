<script>
$(document).ready(function() {
  function show_error_message(title, content) {
    swal({
      title: title ? title : '錯誤！',
      type: 'error',
      text: content ? content : '系統內部似乎出錯，請聯絡相關負責人員！'
    });
  }

  /* 切換器材狀態 */
  $('span.device-btn').on('click', function(event) {
    var html = '<div class="box box-primary">' +
                 '<div class="box-body">' +
                   '<p>器材名稱：' + $(this).data('device') + '</p>' +
                   '<p>器材總數量：' + $(this).data('total') + '</p>' +
                   '<p>器材單次最大借用數量：' + $(this).data('max') + '</p>' +
                   '<p>目前狀態：' + ($(this).data('state') == 0 ? '已啟用' : '停用' ) + '</p>' +
                   '<p><strong>您即將切換為 ' + ($(this).data('state') == 0 ? '停用' : '啟用' ) + '狀態</strong/></p>' +
                 '</div>' +
               '</div>';
    swal({
      title: '確定要切換該器材借用狀態？',
      html: html,
      showCancelButton: true,
      confirmButtonText: '確定',
      cancelButtonText: '取消',
      cancelButtonColor: '#dd4b39'
    }).then(function() {
      $.ajax({
        url: '<?php echo base_url(); ?>ajax/admin/switch_device_state/' + $(this).data('id'),
        type: 'post',
        cache: false,
        success: function() { location.reload(); },
        error: function() { show_error_message(); }
      });
    }.bind(this), function() { /* DO NOTHING */ });
  });
});
</script>