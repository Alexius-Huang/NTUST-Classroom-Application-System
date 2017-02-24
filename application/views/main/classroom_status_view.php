<title>借用狀態查詢 - 學生活動大樓教室借用系統</title>
<section class="content-header">
  <h1>借用狀態查詢</h1>
  <ol class="breadcrumb">
    <li><a href="/">學生活動大樓教室借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/classroom_status">借用狀態查詢</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-4">
      <div class="box box-default">
        <div id="status_calendar" class="box-body">
          <div class="table table-bordered table-striped"></div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="box box-default">
        <div id="status" class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>場地</th>
                <?php foreach(array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'A', 'B', 'C', 'D') as $time): ?>
                  <th class="status-time"><?php echo $time; ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th colspan="15">
                  圖例：
                  <span class="status-figure label-primary" title="審核中">
                    <i class="fa fa-fw fa-hourglass-start"></i> 審核中
                  </span>
                  <span class="status-figure label-success" title="已通過">
                    <i class="fa fa-fw fa-check"></i> 已通過
                  </span>
                  <span class="status-figure label-danger" title="不開放">
                    <i class="fa fa-fw fa-ban"></i> 不開放
                  </span>
                </th>
              </tr>
            </tfoot>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/classroom_status_js'); ?>
</section>