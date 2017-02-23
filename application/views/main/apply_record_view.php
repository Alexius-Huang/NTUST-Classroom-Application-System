<title>借用紀錄 - 學生活動大樓教室借用系統</title>
<section class="content-header">
  <h1>借用紀錄</h1>
  <ol class="breadcrumb">
    <li><a href="/">學生活動大樓教室借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_record">借用紀錄</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">以下為您的借用紀錄：</h3>
        </div>
        <div id="record" class="box-body">
          <?php if (count($applies) === 0): ?>您尚未有任何教室借用紀錄。<?php else: ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr><th>申請狀態</th> <th>借用地點</th> <th>借用日期</th> <th>借用時段</th> <th>申請時間</th></tr>
              </thead>
              <tbody>
                <?php foreach ($applies as $apply): ?>
                  <tr>
                    <?php switch((int)$apply['status']):
                            case 0:
                              if ( ! $apply['past']) { echo '<td class="label-primary">'.render_icon('hourglass-start').'審核中</td>'; }
                              else echo '<td class="label-warning">'.render_icon('clock-o').'已過期</td>'; break;
                            case 1: echo '<td class="label-success">'.render_icon('check').'已通過</td>';  break;
                            case 2: echo '<td class="label-default">'.render_icon('trash').'已取消</td>';  break;
                            case 4: echo '<td class="label-danger">'.render_icon('times').'已駁回</td>';   break;
                          endswitch; ?>
                    <td><?php echo $apply['classroom']['name']; ?></td>
                    <td><?php echo $apply['date']; ?></td>
                    <td><?php echo classroom_rule_display_time($apply); ?></td>
                    <td><?php echo get_datetime_from_timestamp($apply['created_at']); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/apply_record_js'); ?>
</section>