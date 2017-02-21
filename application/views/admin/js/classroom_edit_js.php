<script>
$(document).ready(function() {
  $('span#delete-all-rules').on('click', function(event) {
    event.preventDefault();
    swal({
      title: '您即將要刪除全部的不開放規則',
      text: '您是否要刪除場地 ' + $(this).data().classroom + ' 所有不開放規則？',
      showCancelButton: true,
      confirmButtonText: '確定',
      cancelButtonText: '取消',
      confirmButtonColor: '#dd4b39',
      cancelButtonColor: '#3c8dbc'
    }).then(function() {
      console.log('success')
    }, function(dismiss) { /* DO NOTHING */ });
  });
});
</script>