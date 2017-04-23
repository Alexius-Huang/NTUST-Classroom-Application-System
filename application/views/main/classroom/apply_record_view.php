<title><?php i18n($lang, 'page.classroom-apply-record.title'); ?> - <?php i18n($lang, 'general.classroom.leasing-system'); ?></title>
<section class="content-header">
  <h1><?php i18n($lang, 'page.classroom-apply-record.title'); ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/apply_record/<?php i18n($lang, 'general.link.current-lang') ?>"><?php i18n($lang, 'general.classroom.leasing-system'); ?></a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_record/<?php i18n($lang, 'general.link.current-lang') ?>"><?php i18n($lang, 'page.classroom-apply-record.title'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?php i18n($lang, 'page.classroom-apply-record.table-title'); ?></h3>
        </div>
        <div id="record" class="box-body">
          <?php if (count($applies) === 0): ?><?php i18n($lang, 'page.classroom-apply-record.no-record'); ?><?php else: ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><?php i18n($lang, 'page.classroom-apply-record.table-headers.status') ?></th>
                  <th><?php i18n($lang, 'page.classroom-apply-record.table-headers.place') ?></th>
                  <th><?php i18n($lang, 'page.classroom-apply-record.table-headers.date') ?></th>
                  <th><?php i18n($lang, 'page.classroom-apply-record.table-headers.time') ?></th>
                  <th><?php i18n($lang, 'page.classroom-apply-record.table-headers.apply-at') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($applies as $apply): ?>
                  <tr>
                    <?php switch((int)$apply['status']):
                            case 0:
                              if ( ! $apply['past']) { echo '<td class="label-primary">'.render_icon('hourglass-start').($lang === 'zh-TW' ? '審核中' : 'Pending').'</td>'; }
                              else echo '<td class="label-warning">'.render_icon('clock-o').apply_state_type('0', $lang).'</td>'; break;
                            case 1: echo '<td class="label-success">'.render_icon('check').apply_state_type('1', $lang).'</td>';  break;
                            case 2: echo '<td class="label-default">'.render_icon('trash').apply_state_type('2', $lang).'</td>';  break;
                            case 4: echo '<td class="label-danger">'.render_icon('times').apply_state_type('4', $lang).'</td>';   break;
                          endswitch; ?>
                    <td><?php echo $apply['classroom']['name']; ?></td>
                    <td><?php echo $apply['date']; ?></td>
                    <td><?php echo classroom_rule_display_time($apply); ?></td>
                    <td><?php echo get_datetime_from_timestamp($apply['created_at']); ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/apply_record_js', array('lang' => $lang)); ?>
</section>
