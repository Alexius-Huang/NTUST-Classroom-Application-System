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
  $('#status_calendar div.table').datepicker({
    format: "yyyy-mm-dd",
    weekStart: 0,
    startDate: moment().format('YYYY-MM-DD'),
    endDate: moment().add(2, 'months').format('YYYY-MM-DD'),
    todayBtn: "linked",
    language: 'zh-TW',
    beforeShowDay: function (date) {
        // var d = moment(date).format('YYYY-MM-DD');
        // return { classes: (dates_active.indexOf(d) === -1 ? '' : ' status-active') + (dates_not_allowed.indexOf(d) === -1 ? '' : ' status-not-allowed') };
    }
  }).datepicker('setDate', moment().format('YYYY-MM-DD')).on('changeDate.datepicker', function(event) {
    var selectedDate = moment(event.date).format('YYYY-MM-DD');
  });
});
</script>