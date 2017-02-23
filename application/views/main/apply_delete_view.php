<title>取消借用申請 - 學生活動大樓教室借用系統</title>
<section class="content-header">
  <h1>取消借用申請</h1>
  <ol class="breadcrumb">
    <li><a href="/">學生活動大樓教室借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_delete">取消借用申請</a></li>
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
                <tr> <th>申請狀態</th> <th>借用地點</th> <th>借用日期</th> <th>借用時段</th> <th>刪除</th> </tr>
              </thead>
              <tbody>
                <?php foreach ($applies as $apply): ?>
                  <?php if ($apply['status'] == 2 OR $apply['status'] == 4): continue; endif; ?>
                  <tr>
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
                      ><?php echo render_icon('trash'); ?> 刪除</button>
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
  <?php $this->load->view('main/js/apply_delete_js'); ?>
</section>