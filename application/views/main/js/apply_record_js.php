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
</script>