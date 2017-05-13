<style>
  tr.appliance.active { color: white; }
  tr.appliance.active > td { background-color: #0088cc !important; }
  tr.appliance.active:hover > td { background-color: #0075b0 !important; }
</style>
<script>
$(document).ready(function() {
  function show_error_message(title, content) {
    swal({
      title: title ? title : '錯誤！',
      type: 'error',
      text: content ? content : '系統內部似乎出錯，請聯絡相關負責人員！'
    });
  }

  /* Datatable */
  $('table#datatable').dataTable({
    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "顯示全部"]],
    order: [[0, 'asc']],
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

  /* Popout inspect application */
  function post_check_application(data) {
    $.ajax({
      type: 'post',
      data: { 'id': data.id, 'mode': data.mode },
      url: '<?php echo base_url(); ?>ajax/admin/check_device_application',
      cache: false,
      success: function() { location.reload(); },
      error: function() { show_error_message(); }
    })
  }

  $('table#datatable').on('click', '.btn-inspect', function(event) {
    event.preventDefault();
    var data = $(this).data();

    $.ajax({
      url: '<?php echo base_url(); ?>ajax/admin/get_device_info',
      type: 'post',
      data: { id: data.id },
      dataType: 'json',
      cache: false,
      success: function(deviceInfo) {
        var html = '<div class="pre-scrollable" style="max-height: 500px;"><div class="box box-primary">' +
                     '<div class="box-body text-left">' +
                       '<p>提出申請時間：' + data.created + '</p>' +
                       '<p>借用日期：' + data.date + '</p>' +
                       '<p>預計歸還日期：' + data.end + '</p>' +
                       '<p>借用單位：' + data.organization + '</p>' +
                       '<p>借用申請人：' + data.applicant + '</p>' +
                       '<p>借用器材清單：' +
                         '<ul class="list-group">';
        for (var index of Object.keys(deviceInfo)) {
          var info = deviceInfo[index];
          html +=          '<li class="list-group-item">' + info['name_zh-TW'] + '（' + info['name_en-us'] + '）- ' + parseInt(info.lease_count, 10) + '</li>';
        } 
        html +=          '</ul>' +
                       '</p>' +
                       '<p>借用目的：' + data.purpose + '</p>' +
                       '<p>聯絡電話：' + data.phone + '</p>' +
                     '</div>' +
                   '</div>' +
                   '</div><br/><p>您即將審核此申請，<span style="color:red">若有其他申請其時段衝突到本申請時段，則此申請通過後其他的申請將自動駁回</span></p>';

        swal({
          title: '檢視審核借用申請',
          html: html,
          showCancelButton: true,
          confirmButtonText: '<?php echo render_icon('check'); ?> 通過申請',
          cancelButtonText: '<?php echo render_icon('times'); ?> 駁回申請',
          cancelButtonColor: '#dd4b39'
        }).then(function() {
          post_check_application({ id: data.id, mode: 'approve' });
        }, function(dismiss) {
          if (dismiss === 'cancel') { post_check_application({ id: data.id, mode: 'reject' }); }
        });
      },
      error: function() { show_error_message(); }
    });

  });
});
</script>