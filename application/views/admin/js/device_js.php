<script>
$(document).ready(function() {
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
    if ($(this).data('state') == 0) {
      swal({
        title: '確定要關閉該器材借用？',
        html: html,
        showCancelButton: true,
        confirmButtonText: '確定',
        cancelButtonText: '取消',
        cancelButtonColor: '#dd4b39'
      }).then(function() {

      }, function() { /* DO NOTHING */ });
    } else {
      swal({
        title: '確定要啟用該器材借用？',
        html: html,
        showCancelButton: true,
        confirmButtonText: '確定',
        cancelButtonText: '取消',
        cancelButtonColor: '#dd4b39'
      }).then(function() {
        
      }, function() { /* DO NOTHING */ });
    }
  });
});
</script>