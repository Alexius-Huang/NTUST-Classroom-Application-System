<?php if ($lang === 'zh-TW'): ?>

<title>借用須知 - 學生活動大樓教室借用系統</title>
<section class="content-header">
  <h1>借用須知</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/apply_notice/zh-TW">學生活動大樓教室借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_notice/zh-TW">借用須知</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">使用本系統前，請詳閱以下借用須知：</h3>
        </div>
        <div id="notice" class="box-body">
          <?php echo $notice['zh-tw']; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php elseif ($lang === 'en-us'): ?>

<title>Notice - Classroom Leasing System</title>
<section class="content-header">
  <h1>Notice</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/apply_notice/en-us">Classroom Leasing System</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_notice/en-us">Notice</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Before using the system, please read the following notice :</h3>
        </div>
        <div id="notice" class="box-body">
          <?php echo $notice['en-us']; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php endif; ?>

<style>
  span.marker { background-color: yellow; }
</style>