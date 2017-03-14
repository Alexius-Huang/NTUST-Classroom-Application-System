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

$(document).ready(function() {
  // THIS SECTION DUE TO SOME DATATABLE ERROR WAS MOVED TO application_view.php IN Admin SECTION
  // function setup_inspect_event() {
  //   $('button.btn-inspect').on('click', function(event) {
  //     event.preventDefault();
  //     var data = $(this).data();
  //     swal({
  //       title: '檢視申請紀錄',
  //       html: '<div class="box box-primary">' +
  //               '<div class="box-body text-left">' +
  //                 '<p>提出申請時間：' + data.created + '</p>' +
  //                 '<p>狀態：' + data.status + '</p>' +
  //                 '<p>借用場地：' + data.classroom + '</p>' +
  //                 '<p>場地人數：' + data.participantCount + '</p>' +
  //                 '<p>借用日期：' + data.date + '</p>' +
  //                 '<p>借用時段：' + data.time + '</p>' +
  //                 '<p>申請單位（社團）：' + data.organization + '</p>' +
  //                 '<p>申請人員：' + data.applicant + '</p>' +
  //                 '<p>申請人電話：' + data.phone + '</p>' +
  //                 '<p>申請目的：' + data.purpose + '</p>' +
  //               '</div>' +
  //             '</div>',
  //       confirmButtonText: '關閉'
  //     }).then(function () { /* DO NOTHING */ });
  //   });
  //   console.log('hello');
  // }

  /* Datatable */
  $('table#datatable').dataTable({
    lengthMenu: [[25, 50, 100, -1], [25, 50, 100, "顯示全部"]],
    order: [[2, 'desc']],
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
  
});
</script>