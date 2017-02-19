<div class="row">
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3>' . $apply_count['c'] . '</h3>
        <p>待審核申請</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-paper"></i>
      </div>
      <a href="?page=apply" class="small-box-footer">前往審核申請 <i class="fa fa-fw fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3>' . $classroom_active_count['c'] . '/' . $classroom_count['c'] . '</h3>
        <p>場地啟用狀態</p>
      </div>
      <div class="icon">
        <i class="ion ion-android-pin"></i>
      </div>
      <a href="?page=classroom" class="small-box-footer">前往場地設定 <i class="fa fa-fw fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-teal">
      <div class="inner">
        <h3>' . $apply_month_accepted_count['c'] . '/' . $apply_month_count['c'] . '</h3>
        <p>' . $w . '月申請與通過次數</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-paper"></i>
      </div>
      <a href="?page=application" class="small-box-footer">前往申請記錄 <i class="fa fa-fw fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6">
    <div class="small-box bg-light-blue">
      <div class="inner">
        <h3>' . $apply_history_accepted_count['c'] . '/' . $apply_history_count['c'] . '</h3>
        <p>歷史申請與通過次數</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-paper"></i>
      </div>
      <a href="?page=application" class="small-box-footer">前往申請記錄 <i class="fa fa-fw fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>