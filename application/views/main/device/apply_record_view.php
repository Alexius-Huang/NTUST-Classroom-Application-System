<title><?php i18n($lang, 'page.device-apply-record.title'); ?> - <?php i18n($lang, 'general.device.leasing-system'); ?></title>
<section class="content-header">
  <h1><?php i18n($lang, 'page.device-apply-record.title'); ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/device_apply_record/<?php i18n($lang, 'general.link.current-lang') ?>"><?php i18n($lang, 'general.device.leasing-system'); ?></a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/device_apply_record/<?php i18n($lang, 'general.link.current-lang') ?>"><?php i18n($lang, 'page.device-apply-record.title'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?php i18n($lang, 'page.device-apply-record.table-title'); ?></h3>
        </div>
        <div id="record" class="box-body">
          <?php if (count($applies) === 0): ?><?php i18n($lang, 'page.device-apply-record.no-record'); ?><?php else: ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><?php i18n($lang, 'page.device-apply-record.table-headers.status') ?></th>
                  <th><?php i18n($lang, 'page.device-apply-record.table-headers.date') ?></th>
                  <th><?php i18n($lang, 'page.device-apply-record.table-headers.end-date') ?></th>
                  <th><?php i18n($lang, 'page.device-apply-record.table-headers.remark') ?></th>
                  <th><?php i18n($lang, 'page.device-apply-record.table-headers.apply-at') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($applies as $apply): ?>
                  <tr>
                    <?php switch((int)$apply['status']):
                            case 0: echo '<td class="label-primary">'.render_icon('hourglass-start').($lang === 'zh-TW' ? '審核中' : 'Pending').'</td>'; break;
                            case 1: echo '<td class="label-success">'.render_icon('check').apply_state_type('1', $lang).'</td>';  break;
                            case 2: echo '<td class="label-default">'.render_icon('trash').apply_state_type('2', $lang).'</td>';  break;
                            case 4: echo '<td class="label-danger">'.render_icon('times').apply_state_type('4', $lang).'</td>';   break;
                          endswitch; ?>
                    <td><?php echo $apply['date']; ?></td>
                    <td><?php echo $apply['end_date']; ?></td>
                    <td>
                      <?php switch((int)$apply['status']):
                              case 1: ?> <a class="btn btn-xs btn-success" href="<?php echo base_url(); ?>pdf_download/device_pdf/<?php echo $lang; ?>/<?php echo $apply['id']; ?>"><?php i18n($lang, 'page.device-apply-record.print-pdf'); ?></a>
                      <?php     break;
                              case 4: echo (empty($apply['reject_info_'.$lang]) ? 'N/A' : '<span style="color: red">'.$apply['reject_info_'.$lang].'</span>');
                                break; 
                            endswitch; ?>
                    </td>
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
  <?php $this->load->view('main/js/device_apply_record_js', array('lang' => $lang)); ?>
</section>
