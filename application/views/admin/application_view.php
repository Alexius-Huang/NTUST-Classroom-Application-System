<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">檢視申請紀錄</h3>
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
                data-created="<?php echo date('Y-m-d H:i:s', $apply['created_at']); ?>"
                data-status="<?php echo apply_state_type($apply['status']); ?>"
                data-classroom="<?php echo $apply['classroom']['name']; ?>"
                data-date="<?php echo $apply['date'].'（'.get_weekday_from_date($apply['date']).'）'; ?>"
                data-time="<?php echo classroom_rule_display_time($apply); ?>"
                data-organization="<?php echo $apply['organization']; ?>"
                data-applicant="<?php echo $apply['applicant'].'（'.$apply['applicantPosition'].'）'; ?>"
                data-phone="<?php echo $apply['phone']; ?>"
                data-participant-count="<?php echo $apply['participantCount']; ?>"
                data-purpose="<?php echo $apply['purpose']; ?>"
                class="btn btn-xs btn-primary btn-inspect"
              ><?php echo render_icon('eye'); ?> 檢視</button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php $this->load->view('admin/js/application_js'); ?>
  </div>
</div>