<?php if ($lang === 'zh-TW'): ?>

<title>取消借用申請 - 學生活動大樓教室借用系統</title>
<section class="content-header">
  <h1>取消借用申請</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/apply_delete/zh-TW">學生活動大樓教室借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_delete/zh-TW">取消借用申請</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">以下為您正在審核以及通過的借用申請：</h3>
        </div>
        <div class="box-body">
          <?php if (count($applies) == 0): ?>您尚未有任何教室借用申請。<?php else : ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr> <th class="text-center">提出申請時間</th> <th class="text-center">申請狀態</th> <th class="text-center">借用地點</th> <th class="text-center">借用日期</th> <th class="text-center">借用時段</th> <th class="text-center">取消申請</th> </tr>
              </thead>
              <tbody>
                <?php foreach ($applies as $apply): ?>
                  <?php if ($apply['status'] == 2 OR $apply['status'] == 4): continue; endif; ?>
                  <tr>
                    <td><?php echo date('Y-m-d, H:i:s', $apply['created_at']) ?></td>
                    <?php
                      if ($apply['status'] == 0 AND ( ! $apply['past'])) {
                        echo '<td class="label-primary">'.render_icon('hourglass-start').'審核中</td>';
                      } else if ($apply['status'] == 1) echo '<td class="label-success">'.render_icon('check').'已通過</td>';
                    ?>
                    <td><?php echo $apply['classroom']['name']; ?></td>
                    <td><?php echo $apply['date']; ?></td>
                    <td><?php echo classroom_rule_display_time($apply); ?></td>
                    <td>
                      <button
                        data-id="<?php echo $apply['id']; ?>"
                        data-status="<?php echo ($apply['status'] == 0 ? '審核中' : '已通過'); ?>"
                        data-classroom="<?php echo $apply['classroom']['name']; ?>"
                        data-date="<?php echo $apply['date']; ?>"
                        data-time="<?php echo classroom_rule_display_time($apply); ?>"
                        class="btn btn-xs btn-danger btn-delete"
                      ><?php echo render_icon('times'); ?> 取消申請</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/apply_delete_js', array('lang' => $lang)); ?>
</section>

<?php elseif ($lang === 'en-us'): ?>

<title>Apply Cancel - Classroom Leasing System</title>
<section class="content-header">
  <h1>Apply Cancel</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/apply_delete/en-us">Classroom Leasing System</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_delete/en-us">Apply Cancel</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">The following are the details of the application you are going to cancel:</h3>
        </div>
        <div class="box-body">
          <?php if (count($applies) == 0): ?>You haven't had any applications yet.<?php else : ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr> <th class="text-center">Apply Timing</th> <th class="text-center">Status</th> <th class="text-center">Place</th> <th class="text-center">Date</th> <th class="text-center">Time</th> <th class="text-center">Cancel Apply</th> </tr>
              </thead>
              <tbody>
                <?php foreach ($applies as $apply): ?>
                  <?php if ($apply['status'] == 2 OR $apply['status'] == 4): continue; endif; ?>
                  <tr>
                    <td><?php echo date('Y-m-d, H:i:s', $apply['created_at']) ?></td>
                    <?php
                      if ($apply['status'] == 0 AND ( ! $apply['past'])) {
                        echo '<td class="label-primary">'.render_icon('hourglass-start').'Pending</td>';
                      } else if ($apply['status'] == 1) echo '<td class="label-success">'.render_icon('check').'Accepted</td>';
                    ?>
                    <td><?php echo $apply['classroom']['name']; ?></td>
                    <td><?php echo $apply['date']; ?></td>
                    <td><?php echo classroom_rule_display_time($apply); ?></td>
                    <td>
                      <button
                        data-id="<?php echo $apply['id']; ?>"
                        data-status="<?php echo ($apply['status'] == 0 ? 'Pending' : 'Accepted'); ?>"
                        data-classroom="<?php echo $apply['classroom']['name']; ?>"
                        data-date="<?php echo $apply['date']; ?>"
                        data-time="<?php echo classroom_rule_display_time($apply); ?>"
                        class="btn btn-xs btn-danger btn-delete"
                      ><?php echo render_icon('times'); ?> Cancel Apply</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/apply_delete_js', array('lang' => $lang)); ?>
</section>

<?php endif; ?>