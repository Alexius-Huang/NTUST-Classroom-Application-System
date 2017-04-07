<section class="content">
  <div class="callout callout-info">
    <h4><?php i18n($lang, 'general.system.notify-title'); ?></h4>
    <p><?php i18n($lang, 'general.system.notify-content'); ?></p>
  </div>
  
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3 style="font-size: 180%">場地借用系統</h3>
          <p>Classroom Leasing System Entry</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-paper"></i>
        </div>
        <a href="<?php echo base_url(); ?>main/apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>" class="small-box-footer"><?php i18n($lang, 'main.classroom.go-to-leasing-system'); ?> <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3 style="font-size: 180%">器材借用系統</h3>
          <p>Device Leasing System Entry</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-pin"></i>
        </div>
        <a href="<?php echo base_url(); ?>main/device_apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>" class="small-box-footer"><?php i18n($lang, 'main.device.go-to-leasing-system'); ?> <i class="fa fa-fw fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</section>