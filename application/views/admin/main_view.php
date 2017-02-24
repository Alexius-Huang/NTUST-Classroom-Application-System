<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo count($await_applies); ?></h3>
        <p>待審核申請</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-paper"></i>
      </div>
      <a href="<?php echo base_url(); ?>admin/apply" class="small-box-footer">前往審核申請 <i class="fa fa-fw fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo count($available_classroom).'/'.count($classrooms); ?></h3>
        <p>場地啟用狀態</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-pin"></i>
      </div>
      <a href="<?php echo base_url(); ?>admin/classroom" class="small-box-footer">前往場地設定 <i class="fa fa-fw fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-teal">
      <div class="inner">
        <h3><?php echo count($applies_approved_in_current_month).'/'.count($applies_in_current_month); ?></h3>
        <p><?php echo date('n'); ?>月借用場地申請與通過次數</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-paper"></i>
      </div>
      <a href="<?php echo base_url(); ?>admin/application" class="small-box-footer">前往申請記錄 <i class="fa fa-fw fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-light-blue">
      <div class="inner">
        <h3><?php echo count($applies_approved_in_history).'/'.count($applies_in_history); ?></h3>
        <p>歷史申請與通過次數</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-paper"></i>
      </div>
      <a href="<?php echo base_url(); ?>admin/application" class="small-box-footer">前往申請記錄 <i class="fa fa-fw fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>