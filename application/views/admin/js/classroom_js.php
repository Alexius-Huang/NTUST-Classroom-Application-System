<script>
$(document).ready(function() {
  function show_error_message() {
    swal({
      title: '錯誤！',
      type: 'error',
      text: '系統內部似乎出錯，請聯絡相關負責人員！'
    });
  }

  $('button#add-classroom').on('click', function(event) {
    event.preventDefault();
    var classroomName = $('input#classroom-name').val();
    if (classroomName !== '') {
      swal({
        title: '您即將要新增場地：' + classroomName,
        showCancelButton: true,
        confirmButtonText: '新增',
        cancelButtonText: '取消'
      }).then(function() {
        $.ajax({
          type: 'post',
          url: '<?php echo base_url(); ?>ajax/admin/create_classroom',
          data: { 'classroomName': classroomName },
          cache: false,
          success: function() { location.reload(); },
          error: function() { show_error_message(); }
        });
      }, function(dismiss) { /* DO NOTHING */ });
    } else {
      swal({
        type: 'error',
        title: '請輸入場地名稱！',
        timer: 1000
      });
    }
  })

  $('span').on('click', function(event) {
    var data = $(this).data();
    switch(data.type) {
      case 'edit':
        location.href = '<?php echo base_url(); ?>' + 'admin/classroom_edit/' + data.id;
        break;

      /* 切換教室開放狀態 */
      case 'switch':
        swal({
          title: '您確定要切換狀態嗎？',
          html: '<div class="box box-primary">' +
                  '<div class="box-body">' +
                    '<p>場地名稱：<span>' + data.classroom + '</span></p>' +
                    '<p>目前狀態：<span>' + (data.state == 0 ? '已啟用' : '停用中') + '</span></p>' +
                    '<p>您將切換狀態為 <span>' + (data.state == 0 ? '停用' : '啟用') + '</span> 嗎？</p>' + 
                  '</div>' +
                '</div>',
          showCancelButton: true,
          confirmButtonText: '確定',
          cancelButtonText: '取消',
          cancelButtonColor: '#dd4b39',
        }).then(function() {
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>ajax/admin/switch_classroom_state/' + data.id,
            cache: false,
            success: function() { location.reload(); },
            error: function() { show_error_message(); }
          });
        }, function(dismiss) { /* DO NOTHING*/ });
        break;

      /* 毀滅教室 */
      case 'destroy':
        swal({
          title: '您確定要刪除該場地： ' + data.classroom + ' ？',
          showCancelButton: true,
          confirmButtonText: '確定',
          cancelButtonText: '取消',
          confirmButtonColor: '#dd4b39',
          cancelButtonColor: '#3c8dbc'
        }).then(function() {
          $.ajax({
            type: 'post',
            url: '<?php echo base_url(); ?>ajax/admin/destroy_classroom/' + data.id,
            cache: false,
            success: function() { location.reload(); },
            error: function() { show_error_message(); }
          })
        }, function(dismiss) { /* DO NOTHING */ });
        break;
    }
  });
})
</script>