<div class="box box-primary">
  <div class="box-header" id="page-header">
    <h3 class="box-title">檢視與審核場地申請</h3>
  </div>
  <div class="box-body">
    <table id="datatable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th class="text-center">提出申請時間</th>
          <th class="text-center">借用場地</th>
          <th class="text-center">借用日期</th>
          <th class="text-center">借用時段</th>
          <th class="text-center">借用申請人</th>
          <th class="text-center">借用單位</th>
          <th class="text-center">檢視</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($applies as $apply): ?>
          <tr data-id="<?php echo $apply['id']; ?>" class="appliance">
            <td class="text-center"><?php echo date('Y-m-d H:i:s', $apply['created_at']) ?></td>
            <td class="text-center"><?php echo $apply['classroom']['name']; ?></td>
            <td class="text-center"><?php echo $apply['date'].'（'.get_weekday_from_date($apply['date']).'）'; ?></td>
            <td class="text-center"><?php echo classroom_rule_display_time($apply); ?></td>
            <td class="text-center"><?php echo $apply['applicant'].'（'.$apply['applicantPosition'].'）'; ?></td>
            <td class="text-center"><?php echo $apply['organization']; ?></td>
            <td class="text-center">
              <button
                data-id="<?php echo $apply['id']; ?>"
                data-created="<?php echo date('Y-m-d H:i:s', $apply['created_at']); ?>"
                data-classroom="<?php echo $apply['classroom']['name']; ?>"
                data-participant-count="<?php echo $apply['participantCount']; ?>"
                data-date="<?php echo $apply['date'].'（'.get_weekday_from_date($apply['date']).'）'; ?>"
                data-time="<?php echo classroom_rule_display_time($apply); ?>"
                data-organization="<?php echo $apply['organization']; ?>"
                data-applicant="<?php echo $apply['applicant'].'（'.$apply['applicantPosition'].'）'; ?>"
                data-phone="<?php echo $apply['phone']; ?>"
                data-purpose="<?php echo $apply['purpose']; ?>"
                class="btn btn-warning btn-xs btn-inspect">
                <?php echo render_icon('eye'); ?> 檢視審核
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php $this->load->view('admin/js/apply_js'); ?>
  </div>
</div>