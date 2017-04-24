<script>
$(document).ready(function() {
  function show_error_message(title, content) {
    swal({
      title: title ? title : '<?php i18n($lang, 'general.system.error-title'); ?>',
      type: 'error',
      text: content ? content : '<?php i18n($lang, 'general.system.error-message'); ?>'
    });
  }

  var today = moment().format('YYYY-MM-DD');
  var table = {};
  
  function get_device_state_table(date) {
    $.ajax({
      type: 'post',
      cache: false,
      dataType: 'json',
      url: '<?php echo base_url(); ?>ajax/main/get_device_state_table',
      data: { without_auth: true, date: date },
      success: function(deviceTable) {
        $('ul#device-list').html("");
        for (var deviceID of Object.keys(deviceTable)) {
          var device = deviceTable[deviceID];
          var html = '<li class="list-group-item"' + (device['current_available'] == 0 ? 'style="color: red"' : '') + '>' + device['name_zh-TW'] + '（' + device['name_en-us'] + '） ' +
                       '<?php i18n($lang, 'page.device-status.total-count'); ?>' + device['total_count'] + ' | ' +
                       '<?php i18n($lang, 'page.device-status.available-count'); ?>' + (device['current_available'] < 0 ? '0' : device['current_available']) +
                     '</li>';
          $('ul#device-list').append(html);
        }
      },
      error: function() { show_error_message(); }
    })
  }

  $('#status_calendar div.table').datepicker({
    format: "yyyy-mm-dd",
    weekStart: 0,
    startDate: today,
    endDate: moment().add(1, 'month').format('YYYY-MM-DD'),
    todayBtn: "linked",
    language: '<?php echo $lang; ?>',
    beforeShowDay: function (date) {
      var currentDate = moment(date).format('YYYY-MM-DD');
    }
  }).datepicker('setDate', moment().format('YYYY-MM-DD')).on('changeDate.datepicker', function(event) {
    var selectedDate = moment(event.date).format('YYYY-MM-DD');
    var currentDay = moment(event.date).format('DD');
    var currentMonth = moment(event.date).format('MM');

    get_device_state_table(selectedDate);
  });

  get_device_state_table(today);
  
});
</script>