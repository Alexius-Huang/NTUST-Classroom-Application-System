<title><?php i18n($lang, 'page.device-status.title'); ?> - <?php i18n($lang, 'general.device.leasing-system'); ?></title>
<section class="content-header">
  <h1><?php i18n($lang, 'page.device-status.title'); ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/device_status/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php i18n($lang, 'general.device.leasing-system'); ?></a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/device_status/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php i18n($lang, 'page.device-status.title'); ?></a></li>
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
          <ul id="device-list" class="list-group"></ul>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/device_status_js'); ?>
</section>
