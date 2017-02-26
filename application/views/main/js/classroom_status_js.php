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
    swal({
      title: title ? title : '錯誤！',
      type: 'error',
      text: content ? content : '系統內部似乎出錯，請聯絡相關負責人員！'
    });
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
        console.log(classrooms);
        for (var classroom of classrooms) {
          var tableRow = document.createElement('tr');
          var header = document.createElement('th');
          header.innerHTML = classroom.name;
          tableRow.append(header);
          for (var time of ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D']) {
            var tableData = document.createElement('td');
            switch(classroom['time' + time]) {
              case 'disabled':
                tableData.className = 'label-danger';
                tableData.innerHTML = '<?php echo render_icon('ban'); ?>'
                break;
                
              case 'await':
                tableData.className = 'label-primary';
                tableData.innerHTML = '<?php echo render_icon('hourglass-start'); ?>'
                break;

              case 'checked':
                tableData.className = 'label-success';
                tableData.innerHTML = '<?php echo render_icon('check'); ?>'
                break;
                
              default: /* NOTHING */
            }
            tableRow.append(tableData);
          }
          tableElement.append(tableRow);
        }
      },
      error: function() { show_error_message(); }
    })
  }

  /* Datepicker */
  $('#status_calendar div.table').datepicker({
    format: "yyyy-mm-dd",
    weekStart: 0,
    startDate: today,
    endDate: moment().add(2, 'months').format('YYYY-MM-DD'),
    todayBtn: "linked",
    language: 'zh-TW',
    beforeShowDay: function (date) {
      // var currentDate = moment(date).format('YYYY-MM-DD');
      // cells[currentDate] = '';
      // if (currentDate < today) { return { classes: 'date-' + currentDate }; }

      // $.ajax({
      //   type: 'post',
      //   cache: false,
      //   data: { date: currentDate, without_auth: true },
      //   async: false,
      //   url: '<?php echo base_url(); ?>ajax/main/get_datepicker_cell_class',
      //   dataType: 'json',
      //   success: function(data) {
      //     cells[currentDate] = data
      //   },
      //   error: function() { show_error_message(); }
      // });
      // return { classes: 'date-' + currentDate };
    }
  }).datepicker('setDate', moment().format('YYYY-MM-DD')).on('changeDate.datepicker', function(event) {
    var selectedDate = moment(event.date).format('YYYY-MM-DD');
    var currentDay = moment(event.date).format('DD');
    var currentMonth = moment(event.date).format('MM');

    get_classroom_state_table(selectedDate);

  }).datepicker('setMonth', moment().format('YYYY-MM-DD')).on('changeMonth.datepicker', function(event) {
    var selectedDate = moment(event.date).format('YYYY-MM-DD');
    var currentDay = moment(event.date).format('DD');
    var currentMonth = moment(event.date).format('MM');

    console.log(selectedDate)

  });

  get_classroom_state_table(today);
});
</script>