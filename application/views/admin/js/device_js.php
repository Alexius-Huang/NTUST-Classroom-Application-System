<script>
$(document).ready(function() {
  function show_error_message(title, content) {
    swal({
      title: title ? title : '錯誤！',
      type: 'error',
      text: content ? content : '系統內部似乎出錯，請聯絡相關負責人員！'
    });
  }

  $('span').on('click', function(event) {
    var data = $(this).data();
    switch(data.type) {
      case 'edit':
        location.href = '<?php echo base_url(); ?>admin/device_edit/' + data.id;
        break;
      case 'edit-name':
        swal({
          title: '更改器材名稱',
          html: '<div class="text-left">' +
                  '中文名稱<input id="swal-input1" class="swal2-input">' +
                  '英文名稱<input id="swal-input2" class="swal2-input">' +
                '</div>',
          preConfirm: function () {
            return new Promise(function (resolve) {
              resolve([
                $('#swal-input1').val(),
                $('#swal-input2').val()
              ])
            })
          },
          onOpen: function () {
            $('#swal-input1').focus()
          }
        }).then(function (result) {
          $.ajax({
            url: '<?php echo base_url(); ?>ajax/admin/change_device_name/' + data.id,
            data: { 'name_zh-TW': result[0], 'name_en-us': result[1] },
            type: 'POST',
            cache: false,
            success: function() { location.reload(); },
            error: function() { show_error_message() }
          });
        }).catch(swal.noop)
        break;
      case 'switch':
        var html = '<div class="box box-primary">' +
                    '<div class="box-body">' +
                      '<p>器材名稱：' + data.device + '</p>' +
                      '<p>器材總數量：' + data.total + '</p>' +
                      '<p>器材單次最大借用數量：' + data.max + '</p>' +
                      '<p>目前狀態：' + (data.state == 0 ? '已啟用' : '停用' ) + '</p>' +
                      '<p><strong>您即將切換為 ' + (data.state == 0 ? '停用' : '啟用' ) + '狀態</strong/></p>' +
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
            url: '<?php echo base_url(); ?>ajax/admin/switch_device_state/' + data.id,
            type: 'post',
            cache: false,
            success: function() { location.reload(); },
            error: function() { show_error_message(); }
          });
        }.bind(this), function() { /* DO NOTHING */ });
      break;
    }
  })
});
</script>