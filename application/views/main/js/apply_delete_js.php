<script>
/* Hourglass Icon */
setInterval(function() {
  var a = $('.fa.fa-hourglass-start'),
      b = $('.fa.fa-hourglass-half'),
      c = $('.fa.fa-hourglass-end.rotate-0'),
      d = $('.fa.fa-hourglass-end.rotate-1');
  a.removeClass('fa-hourglass-start').addClass('fa-hourglass-half');
  b.removeClass('fa-hourglass-half').addClass('fa-hourglass-end').addClass('rotate-0');
  c.removeClass('rotate-0').addClass('rotate-1');
  d.removeClass('rotate-1').addClass('rotate-2').removeClass('fa-hourglass-end').addClass('fa-hourglass-start').removeClass('rotate-2');
}, 1000);

/* Datatable */
$('table#datatable').dataTable({
  lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "顯示全部"]],
  order: [[ 2, "desc" ], [ 3, "asc" ], [ 0, "asc" ], [ 1, "asc" ]],
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
  }
});

$(document).ready(function() {
  function show_error_message(title, content) {
    swal({
      title: title ? title : '錯誤！',
      type: 'error',
      text: content ? content : '系統內部似乎出錯，請聯絡相關負責人員！'
    });
  }
  
  $('button.btn-delete').on('click', function(event) {
    event.preventDefault();
    var data = $(this).data();
    swal({
      title: '您即將要刪除此場地申請',
      html: '<div class="box box-primary">' +
              '<div class="box-body">' +
                '<p class="text-left">申請狀態：' + data.status + '</p>' +
                '<p class="text-left">申請場地：' + data.classroom + '</p>' +
                '<p class="text-left">借用日期：' + data.date + '</p>' +
                '<p class="text-left">借用時段：' + data.time + '</p>' +
              '</div>' +
            '</div><p>確定要取消以上申請嗎？</p>',
      showCancelButton: true,
      confirmButtonText: '確定',
      cancelButtonText: '取消',
      confirmButtonColor: '#dd4b39',
      cancelButtonColor: '#3c8dbc'
    }).then(function() {
      $.ajax({
        type: 'post',
        data: { 'classroom_id': data.id },
        cache: false,
        url: '<?php echo base_url(); ?>main/apply_delete',
        success: function() { location.reload(); },
        error: function() { show_error_message(); }
      });
    }, function(dismiss) { /* DO NOTHING */ });
  });
});
</script>