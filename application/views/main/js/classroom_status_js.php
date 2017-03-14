<script>
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
  function show_error_message(title, content) {
    <?php if ($lang === 'zh-TW'): ?>
      swal({
        title: title ? title : '錯誤！',
        type: 'error',
        text: content ? content : '系統內部似乎出錯，請聯絡相關負責人員！'
      });
    <?php elseif ($lang === 'en-us'): ?>
      swal({
        title: title ? title : 'An error occurred！',
        type: 'error',
        text: content ? content : 'Internal system error occurred, please contact relevant personnel for more information.'
      });
    <?php endif; ?>
  }

  var today = moment().format('YYYY-MM-DD');
  var table = {};
  
  function get_classroom_state_table(date) {
    table = {};
    var tableElement = document.getElementById('status-table-content');
    tableElement.innerHTML = '';
    $.ajax({
      type: 'post',
      cache: false,
      dataType: 'json',
      url: '<?php echo base_url(); ?>ajax/main/get_classroom_state_table',
      data: { without_auth: true, date: date },
      success: function(classrooms) {
        /* RENDER TABLE DATA */
        for (var classroom of classrooms) {
          var tableRow = document.createElement('tr');
          var header = document.createElement('th');
          header.innerHTML = name;
          tableRow.append(header);
          for (var time of ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D']) {
            var tableData = document.createElement('td');
            if (classroom['time' + time] && classroom['time' + time].status ) {
              switch(classroom['time' + time].status) {
                case 'disabled':
                  tableData.className = 'label-danger';
                  if (classroom['time' + time].purpose == '') { classroom['time' + time].purpose = 'N/A' }
                  params = '\'' + classroom['time' + time].classroom + '\', \'' +
                                  classroom['time' + time].type + '\', \'' +
                                  classroom['time' + time].date + '\', \'' +
                                  classroom['time' + time].time + '\', \'' +
                                  classroom['time' + time].weekday + '\', \'' +
                                  classroom['time' + time].purpose + '\'';
                  tableData.innerHTML = '<a href="#" style="color: white" onclick="banned_info(' + params + ')"><?php echo render_icon('ban'); ?></a>';
                  break;
                  
                case 'await':
                  tableData.className = 'label-primary';
                  // tableData.innerHTML = '<?php echo render_icon('hourglass-start'); ?>'
                  if (classroom['time' + time].purpose == '') { classroom['time' + time].purpose = 'N/A' }
                  params = '\'' + classroom['time' + time].classroom + '\', \'' +
                                  classroom['time' + time].participant_count + '\', \'' +
                                  classroom['time' + time].date + '\', \'' +
                                  classroom['time' + time].time + '\', \'' +
                                  classroom['time' + time].organization + '\', \'' +
                                  classroom['time' + time].applicant + '\', \'' +
                                  classroom['time' + time].purpose + '\'';
                  tableData.innerHTML = '<a href="#" style="color: white" onclick="checked_info(' + params + ')"><?php echo render_icon('hourglass-start'); ?></a>'
                  break;

                case 'checked':
                  tableData.className = 'label-success';
                  if (classroom['time' + time].purpose == '') { classroom['time' + time].purpose = 'N/A' }
                  params = '\'' + classroom['time' + time].classroom + '\', \'' +
                                  classroom['time' + time].participant_count + '\', \'' +
                                  classroom['time' + time].date + '\', \'' +
                                  classroom['time' + time].time + '\', \'' +
                                  classroom['time' + time].organization + '\', \'' +
                                  classroom['time' + time].applicant + '\', \'' +
                                  classroom['time' + time].purpose + '\'';
                  tableData.innerHTML = '<a href="#" onclick="checked_info(' + params + ')"><?php echo render_icon('check'); ?></a>'
                  break;

                default: /* NOTHING */
              }
            }
            tableRow.append(tableData);
          }
          tableElement.append(tableRow);
        }
      },
      error: function() { show_error_message(); }
    })
  }

  /* Before load Datepicker => load classes */
  $.ajax({
    type: 'post',
    dataType: 'json',
    cache: false,
    url: '<?php echo base_url(); ?>ajax/main/get_datepicker_class',
    data: { without_auth: true },
    success: function(data) {
      $('#status_calendar div.table').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 0,
        startDate: today,
        //endDate: moment().add(2, 'months').format('YYYY-MM-DD'),
        todayBtn: "linked",
        language: '<?php echo $lang; ?>',
        beforeShowDay: function (date) {
          var currentDate = moment(date).format('YYYY-MM-DD');
          if (currentDate < today) { return; }

          var obj = { classes: '' };
          if (data[currentDate]) {
            data[currentDate].hasOwnProperty('danger')  && data[currentDate].danger  ? obj.classes += ' status-not-allowed ' : null;
            data[currentDate].hasOwnProperty('checked') && data[currentDate].checked ? obj.classes += ' status-active '      : null;
          } else return;

          return obj;
        }
      }).datepicker('setDate', moment().format('YYYY-MM-DD')).on('changeDate.datepicker', function(event) {
        var selectedDate = moment(event.date).format('YYYY-MM-DD');
        var currentDay = moment(event.date).format('DD');
        var currentMonth = moment(event.date).format('MM');

        get_classroom_state_table(selectedDate);
      });

      get_classroom_state_table(today);
    },
    error: function() { show_error_message(); }
  })
  
});
</script>