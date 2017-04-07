<title><?php i18n($lang, 'general.device.page.notification'); ?> - <?php i18n($lang, 'general.device.leasing-system'); ?></title>
<section class="content-header">
  <h1><?php i18n($lang, 'general.device.page.notification'); ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/device_apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php i18n($lang, 'general.device.leasing-system'); ?></a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/device_apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php i18n($lang, 'general.device.page.notification'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?php i18n($lang, 'page.device.apply-notice.read-notice'); ?></h3>
        </div>
        <div id="notice" class="box-body">
          <?php echo $notice[strtolower($lang)]; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  span.marker { background-color: yellow; }
</style>