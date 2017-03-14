<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">檢視申請紀錄</h3>
    <a href="<?php echo base_url(); ?>admin/application/<?php echo date('Y-m', strtotime($year_month.' + 1 month')); ?>" class="btn btn-primary pull-right">檢視下一個月 >></a>
    <a href="<?php echo base_url(); ?>admin/application/<?php echo date('Y-m', strtotime($year_month.' - 1 month')); ?>" class="btn btn-primary pull-right"><< 檢視前一個月</a>
  </div>
  <div class="box-body">
    <table id="datatable" class="table table-striped table-bordered">
      <thead>
        <tr> <th class="text-center">提出申請時間</th> <th class="text-center">借用場地</th> <th class="text-center">借用日期</th> <th class="text-center">申請人員</th> <th class="text-center">狀態</th> <th class="text-center">檢視</th> </tr>
      </thead>
      <tbody>
        <?php foreach($applies as $apply): ?>
          <tr>
            <td class="text-center"><?php echo date('Y-m-d H:i:s', $apply['created_at']); ?></td>
            <td class="text-center"><?php echo $apply['classroom']['name']; ?></td>
            <td class="text-center"><?php echo $apply['date'].'（'.get_weekday_from_date($apply['date']).'）'; ?></td>
            <td class="text-center"><?php echo $apply['applicant'].'（'.$apply['applicantPosition'].'）'; ?></td>
            <?php
              switch((int)$apply['status']):
                case 0: echo '<td class="text-center label-primary">'.render_icon('hourglass-start').' 審核中</td>'; break;
                case 1: echo '<td class="text-center label-success">'.render_icon('check').' 已通過</td>'; break;
                case 2: echo '<td class="text-center label-default">'.render_icon('trash').' 已取消</td>'; break;
                case 4: echo '<td class="text-center label-danger">'.render_icon('times').' 已駁回</td>'; break;
              endswitch;    
            ?>
            <td class="text-center">
              <button
                class="btn btn-xs btn-primary btn-inspect"
                onclick="clicked(
                  '<?php echo date('Y-m-d H:i:s', $apply['created_at']); ?>',
                  '<?php echo apply_state_type($apply['status']); ?>',
                  '<?php echo $apply['classroom']['name']; ?>',
                  '<?php echo $apply['date'].'（'.get_weekday_from_date($apply['date']).'）'; ?>',
                  '<?php echo classroom_rule_display_time($apply); ?>',
                  '<?php echo $apply['organization']; ?>',
                  '<?php echo $apply['applicant'].'（'.$apply['applicantPosition'].'）'; ?>',
                  '<?php echo $apply['phone']; ?>',
                  '<?php echo $apply['participantCount']; ?>',
                  '<?php echo $apply['purpose']; ?>'

                )"
              ><?php echo render_icon('eye'); ?> 檢視</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php $this->load->view('admin/js/application_js'); ?>
  </div>
</div>

<script>
  function clicked(created, status, classroom, participantCount, date, time, organization, applicant, phone, purpose) {
    var data = $(this).data();
    swal({
      title: '檢視申請紀錄',
      html: '<div class="box box-primary">' +
              '<div class="box-body text-left">' +
                '<p>提出申請時間：' + created + '</p>' +
                '<p>狀態：' + status + '</p>' +
                '<p>借用場地：' + classroom + '</p>' +
                '<p>場地人數：' + participantCount + '</p>' +
                '<p>借用日期：' + date + '</p>' +
                '<p>借用時段：' + time + '</p>' +
                '<p>申請單位（社團）：' + organization + '</p>' +
                '<p>申請人員：' + applicant + '</p>' +
                '<p>申請人電話：' + phone + '</p>' +
                '<p>申請目的：' + purpose + '</p>' +
              '</div>' +
            '</div>',
      confirmButtonText: '關閉'
    }).then(function () { /* DO NOTHING */ });
  }
</script>
