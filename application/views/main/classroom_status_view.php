<?php if ($lang === 'zh-TW'): ?>

<title>借用狀態查詢 - 學生活動大樓教室借用系統</title>
<section class="content-header">
  <h1>借用狀態查詢</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/classroom_status/zh-TW">學生活動大樓教室借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/classroom_status/zh-TW">借用狀態查詢</a></li>
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
                <?php foreach(TIME_ARRAY as $time): ?>
                  <th class="status-time"><?php echo $time; ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody id="status-table-content"></tbody>
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

<?php elseif ($lang === 'en-us'): ?>

<title>Status of Classroom Leasing - Classroom Leasing System</title>
<section class="content-header">
  <h1>Status of Class Renting</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/classroom_status/en-us">Classroom Leasing System</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/classroom_status/en-us">Status of Class Renting</a></li>
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
                <th>Place</th>
                <?php foreach(TIME_ARRAY as $time): ?>
                  <th class="status-time"><?php echo $time; ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody id="status-table-content"></tbody>
            <tfoot>
              <tr>
                <th colspan="15">
                  Figure:
                <span class="status-figure label-primary" title="Pending">
                  <i class="fa fa-fw fa-hourglass-start"></i> Pending
                </span>
                <span class="status-figure label-success" title="Accepted">
                  <i class="fa fa-fw fa-check"></i> Accepted
                </span>
                <span class="status-figure label-danger" title="Not Allowed">
                  <i class="fa fa-fw fa-ban"></i> Not Allowed
                </span>
                </th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/classroom_status_js', array('lang' => $lang)); ?>
</section>
<?php endif; ?>