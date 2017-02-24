<style>
  tr.appliance.active { color: white; }
  tr.appliance.active > td { background-color: #0088cc !important; }
  tr.appliance.active:hover > td { background-color: #0075b0 !important; }
</style>
<script>

var selectedApplicationIDs = [];

$(document).ready(function() {
  function show_error_message(title, content) {
    swal({
      title: title ? title : '錯誤！',
      type: 'error',
      text: content ? content : '系統內部似乎出錯，請聯絡相關負責人員！'
    });
  }

  /* Table rows are selectable */
  $('table#datatable tr.appliance').on('click', function(event) {
    if ($(event.target).is('button')) return;

    if ($(this).hasClass('active')) {
      var index = selectedApplicationIDs.indexOf($(this).data().id);
      if (index > -1) {
        selectedApplicationIDs.splice(index, 1);
        $(this).removeClass('active');
      } else show_error_message();
    } else {
      selectedApplicationIDs.push($(this).data().id);
      $(this).addClass('active');
    }
    
    if (selectedApplicationIDs.length === 0) {
      $('button#approve-applications-btn').remove();
    } else {
      if ($('button#approve-applications-btn')[0]) {
        $('button#approve-applications-btn').html('<?php echo render_icon('check-square-o'); ?> 通過所有已勾選之 ' + selectedApplicationIDs.length + ' 個申請');
      } else {
        var button = document.createElement('button');
        button.setAttribute('id', 'approve-applications-btn');
        button.setAttribute('class', 'btn btn-success btn-sm pull-right');
        button.innerHTML = '<?php echo render_icon('check-square-o'); ?> 通過所有已勾選之 1 個申請';  
        document.getElementById('page-header').append(button);
        button.addEventListener('click', function(event) {
          event.preventDefault();

          /* ACTION YET TO BE IMPLEMENTED */

        });
      }
    }
  })

  /* Popout inspect application */
  function post_check_application(data) {
    $.ajax({
      type: 'post',
      data: { 'id': data.id, 'mode': data.mode },
      url: '<?php echo base_url(); ?>ajax/admin/check_application',
      cache: false,
      success: function() { location.reload(); },
      error: function() { show_error_message(); }
    })
  }

  $('button.btn-inspect').on('click', function(event) {
    event.preventDefault();
    var data = $(this).data();
    swal({
      title: '檢視審核借用申請',
      html: '<div class="box box-primary">' +
              '<div class="box-body text-left">' +
                '<p>提出申請時間：' + data.created + '</p>' +
                '<p>借用場地：' + data.classroom + '</p>' +
                '<p>借用場地人數：' + data.participantCount + '</p>' +
                '<p>借用日期：' + data.date + '</p>' +
                '<p>借用時段：' + data.time + '</p>' +
                '<p>借用單位：' + data.organization + '</p>' +
                '<p>借用申請人：' + data.applicant + '</p>' +
                '<p>借用目的：' + data.purpose + '</p>' +
              '</div>' +
            '</div><p>您即將審核此申請，<span style="color:red">若有其他申請其時段衝突到本申請時段，則此申請通過後其他的申請將自動駁回</span></p>',
      showCancelButton: true,
      confirmButtonText: '<?php echo render_icon('check'); ?> 通過申請',
      cancelButtonText: '<?php echo render_icon('times'); ?> 駁回申請',
      cancelButtonColor: '#dd4b39'
    }).then(function() {
      post_check_application({ id: data.id, mode: 'approve' });
    }, function(dismiss) {
      post_check_application({ id: data.id, mode: 'reject' });
    });
  });
});
</script>