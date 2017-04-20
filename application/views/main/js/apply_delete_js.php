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
<?php if ($lang === 'zh-TW'): ?>
$('table#datatable').dataTable({
  lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "顯示全部"]],
  order: [[0, 'desc']],
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
<?php elseif ($lang === 'en-us'): ?>
$('table#datatable').dataTable({
  lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Show All"]],
  order: [[0, 'desc']]
});
<?php endif; ?>

$(document).ready(function() {
  function show_error_message(title, content) {
    swal({
      title: title ? title : "<?php i18n($lang, 'general.system.error-title'); ?>",
      type: 'error',
      text: content ? content : '<?php i18n($lang, 'general.system.error-message'); ?>'
    });
  }
  
  $('table#datatable').on('click', '.btn-delete', function(event) {
    event.preventDefault();
    var data = $(this).data();
    swal({
      title: '<?php i18n($lang, 'page.classroom-apply-delete.swal.title'); ?>',
      html: '<div class="box box-primary">' +
              '<div class="box-body">' +
                '<p class="text-left"><?php i18n($lang, 'page.classroom-apply-delete.swal.status') ?>' + data.status + '</p>' +
                '<p class="text-left"><?php i18n($lang, 'page.classroom-apply-delete.swal.place') ?>' + data.classroom + '</p>' +
                '<p class="text-left"><?php i18n($lang, 'page.classroom-apply-delete.swal.date') ?>' + data.date + '</p>' +
                '<p class="text-left"><?php i18n($lang, 'page.classroom-apply-delete.swal.time') ?>' + data.time + '</p>' +
              '</div>' +
            '</div><p><?php i18n($lang, 'page.classroom-apply-delete.swal.ask'); ?></p>',
      showCancelButton: true,
      confirmButtonText: '<?php i18n($lang, 'page.classroom-apply-delete.swal.confirm'); ?>',
      cancelButtonText: '<?php i18n($lang, 'page.classroom-apply-delete.swal.cancel'); ?>',
      confirmButtonColor: '#dd4b39',
      cancelButtonColor: '#3c8dbc'
    }).then(function() {
      $.ajax({
        type: 'post',
        data: { id: data.id },
        cache: false,
        url: '<?php echo base_url(); ?>ajax/main/apply_cancel',
        success: function() { location.reload(); },
        error: function() { show_error_message(); }
      });
    }, function(dismiss) { /* DO NOTHING */ });
  });
});
</script>