<?php if ($lang === 'zh-TW'): ?>

<title>場地借用狀態查詢 - 學生活動中心場地暨器材借用系統</title>
<section class="content-header">
  <h1>場地借用狀態查詢</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/classroom_status/zh-TW">學生活動中心場地暨器材借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/classroom_status/zh-TW">場地借用狀態查詢</a></li>
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
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/classroom_status_js'); ?>
</section>

<?php elseif ($lang === 'en-us'): ?>

<title>Status of Classroom Leasing - Classroom and Device Leasing System</title>
<section class="content-header">
  <h1>Status of Classroom Renting</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/classroom_status/en-us">Classroom and Device Leasing System</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/classroom_status/en-us">Status of Classroom Renting</a></li>
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
                <?php foreach(TIME_ARRAY() as $time): ?>
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

<script>
  function checked_info(classroom, participant_count, date, time, organization, applicant, purpose) {
    swal({
      title: <?php if ($lang == 'zh-TW'): ?> '借用狀態查詢' <?php else: ?> 'Status of Classroom Leasing' <?php endif; ?>,
      html: '<div class="box box-primary">' +
              '<div class="box-body text-left">' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '借用教室：' <?php else: ?> 'Place : ' <?php endif; ?> + classroom + '</p>' + 
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '借用人數：' <?php else: ?> 'Participant Count : ' <?php endif; ?> + participant_count + '</p>' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '借用日期：' <?php else: ?> 'Date : ' <?php endif; ?> + date + '</p>' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '借用時段：' <?php else: ?> 'Time : ' <?php endif; ?> + time + '</p>' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '借用單位（社團）' <?php else: ?> 'Organization(Club) : ' <?php endif; ?> + organization + '</p>' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '申請人：' <?php else: ?> 'Applicant : ' <?php endif; ?> + applicant + '</p>' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '申請目的：' <?php else: ?> 'Purpose : ' <?php endif; ?> + purpose + '</p>' +
              '</div>' +
            '</div>'
    });
  }

  function banned_info(classroom, type, date, time, weekday, purpose) {
    swal({
      title: <?php if ($lang == 'zh-TW'): ?> '借用狀態查詢' <?php else: ?> 'Status of Classroom Leasing' <?php endif; ?>,
      html: '<div class="box box-primary">' +
              '<div class="box-body text-left">' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '不開放教室：' <?php else: ?> 'Place Not Leasing : ' <?php endif; ?> + classroom + '</p>' + 
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '不開放類型：' <?php else: ?> 'Type : ' <?php endif; ?> + type + '</p>' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '日期：' <?php else: ?> 'Date : ' <?php endif; ?> + date + '</p>' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '時段：' <?php else: ?> 'Time : ' <?php endif; ?> + time + '</p>' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '每週：' <?php else: ?> 'Weekday : ' <?php endif; ?> + weekday + '</p>' +
                '<p>' + <?php if ($lang == 'zh-TW'): ?> '目的：' <?php else: ?> 'Purpose : ' <?php endif; ?> + purpose + '</p>' +
              '</div>' +
            '</div>'
    });
  }
</script>