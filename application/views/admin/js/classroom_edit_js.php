<script>
$(document).ready(function() {
  function show_error_message() {
    swal({
      title: '錯誤！',
      type: 'error',
      text: '系統內部似乎出錯，請聯絡相關負責人員！'
    });
  }

  $('span#delete-all-rules').on('click', function(event) {
    event.preventDefault();
    var data = $(this).data();
    swal({
      title: '您即將要刪除全部的不開放規則',
      text: '您是否要刪除場地 ' + data.classroom + ' 所有不開放規則？',
      showCancelButton: true,
      confirmButtonText: '確定',
      cancelButtonText: '取消',
      confirmButtonColor: '#dd4b39',
      cancelButtonColor: '#3c8dbc'
    }).then(function() {
      $.ajax({
        type: 'post',
        cache: false,
        data: { id: data.id },
        url: '<?php echo base_url(); ?>ajax/admin/delete_classroom_rules_by_classroom_id',
        success: function() { location.reload(); },
        error: function() { show_error_message(); }
      });
    }, function(dismiss) { /* DO NOTHING */ });
  });

  $('span.delete-classroom-rule').on('click', function(event) {
    event.preventDefault();
    var data = $(this).data();
    swal({
      title: '您確定要刪除此規則嗎？',
      html: '<div class="box box-primary">' +
              '<div class="box-body text-left">' +
                '<p>場地：' + data.classroom + '</p>' +
                '<p>類型：' + data.ruletype + '</p>' +
                '<p>日期：' + data.date + '</p>' +
                '<p>星期：' + data.weekday + '</p>' +
                '<p>時段：' + data.time + '</p>' +
              '</div>' +
            '</div>',
      showCancelButton: true,
      confirmButtonText: '確定',
      cancelButtonText: '取消',
      confirmButtonColor: '#dd4b39',
      cancelButtonColor: '#3c8dbc'
    }).then(function() {
      $.ajax({
        type: 'post',
        cache: false,
        data: { id: data.id },
        url: '<?php echo base_url(); ?>ajax/admin/delete_classroom_rule',
        success: function() { location.reload(); },
        error: function() { show_error_message(); }
      });
    }, function(dismiss) { /* DO NOTHING */ });
  });

  $('span#delete-classroom').on('click', function(event) {
    event.preventDefault();
    var data = $(this).data();
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
        data: { id: data.id },
        url: '<?php echo base_url(); ?>ajax/admin/delete_classroom',
        cache: false,
        success: function() { location.reload(); },
        error: function() { show_error_message(); }
      })
    }, function(dismiss) { /* DO NOTHING */ });
  });

  /* Datatable */
  $('table#rules').DataTable({
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, '顯示全部']],
    order: [[ 3, "desc" ], [ 0, "desc" ]],
    language: {
      emptyTable:     "無資料可供顯示。",
      info:           "正在顯示第 _START_ 至 _END_ 筆資料，共 _TOTAL_ 筆",
      infoEmpty:      "無資料可供顯示。",
      infoFiltered:   "（從 _MAX_ 筆資料中篩選）",
      infoPostFix:    "",
      lengthMenu:     "每頁顯示 _MENU_ 筆資料",
      loadingRecords: "載入中…",
      processing:     "處理中…",
      search:         "篩選結果：",
      zeroRecords:    "找不到符合的結果。",
      paginate: { sPrevious: "&laquo; 上一頁", sNext: "下一頁 &raquo;" }
    },
  });
});
</script>