<title><?php i18n($lang, 'page.classroom-status.title'); ?> - <?php i18n($lang, 'general.classroom.leasing-system'); ?></title>
<section class="content-header">
  <h1><?php i18n($lang, 'page.classroom-status.title'); ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/classroom_status/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php i18n($lang, 'general.classroom.leasing-system'); ?></a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/classroom_status/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php i18n($lang, 'page.classroom-status.title'); ?></a></li>
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
                <?php foreach(TIME_ARRAY() as $time): ?>
                  <th class="status-time"><?php echo $time; ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody id="status-table-content"></tbody>
            <tfoot>
              <tr>
                <th colspan="15">
                  圖例：
                  <span class="status-figure label-primary" title="<?php i18n($lang, 'page.classroom-status.pending'); ?>">
                    <i class="fa fa-fw fa-hourglass-start"></i> <?php i18n($lang, 'page.classroom-status.pending'); ?>
                  </span>
                  <span class="status-figure label-success" title="<?php i18n($lang, 'page.classroom-status.approved'); ?>">
                    <i class="fa fa-fw fa-check"></i> <?php i18n($lang, 'page.classroom-status.approved'); ?>
                  </span>
                  <span class="status-figure label-danger" title="<?php i18n($lang, 'page.classroom-status.banned'); ?>">
                    <i class="fa fa-fw fa-ban"></i> <?php i18n($lang, 'page.classroom-status.banned'); ?>
                  </span>
                </th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/classroom_status_js'); ?>
</section>

<script>
  function checked_info(classroom, participant_count, date, time, organization, applicant, purpose) {
    <?php $i18n_str = 'page.classroom-status.checked-info.'; ?>
    swal({
      title: '<?php i18n($lang, 'page.classroom-status.title'); ?>',
      html: '<div class="box box-primary">' +
              '<div class="box-body text-left">' +
                '<p><?php i18n($lang, $i18n_str.'place') ?>' + classroom + '</p>' + 
                '<p><?php i18n($lang, $i18n_str.'participant-count') ?>' + participant_count + '</p>' +
                '<p><?php i18n($lang, $i18n_str.'date') ?>' + date + '</p>' +
                '<p><?php i18n($lang, $i18n_str.'time') ?>' + time + '</p>' +
                '<p><?php i18n($lang, $i18n_str.'organization') ?>' + organization + '</p>' +
                '<p><?php i18n($lang, $i18n_str.'applicant') ?>' + applicant + '</p>' +
                '<p><?php i18n($lang, $i18n_str.'purpose') ?>' + purpose + '</p>' +
              '</div>' +
            '</div>'
    });
  }

  function banned_info(classroom, type, date, time, weekday, purpose) {
    <?php $i18n_str = 'page.classroom-status.banned-info.'; ?>
    swal({
      title: '<?php i18n($lang, 'page.classroom-status.title'); ?>',
      html: '<div class="box box-primary">' +
              '<div class="box-body text-left">' +
                '<p><?php i18n($lang, $i18n_str.'place'); ?>' + classroom + '</p>' + 
                '<p><?php i18n($lang, $i18n_str.'type'); ?>' + type + '</p>' +
                '<p><?php i18n($lang, $i18n_str.'date'); ?>' + date + '</p>' +
                '<p><?php i18n($lang, $i18n_str.'time'); ?>' + time + '</p>' +
                '<p><?php i18n($lang, $i18n_str.'weekday'); ?>' + weekday + '</p>' +
                '<p><?php i18n($lang, $i18n_str.'purpose'); ?>' + purpose + '</p>' +
              '</div>' +
            '</div>'
    });
  }
</script>