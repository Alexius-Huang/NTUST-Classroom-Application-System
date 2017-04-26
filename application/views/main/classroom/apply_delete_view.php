<title><?php i18n($lang, 'page.classroom-apply-delete.title'); ?> - <?php i18n($lang, 'general.classroom.leasing-system'); ?></title>
<section class="content-header">
  <h1><?php i18n($lang, 'page.classroom-apply-delete.title'); ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/apply_delete/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php i18n($lang, 'general.classroom.leasing-system'); ?></a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_delete/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php i18n($lang, 'page.classroom-apply-delete.title'); ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title"><?php i18n($lang, 'page.classroom-apply-delete.table-title'); ?></h3>
        </div>
        <div class="box-body">
          <?php if (count($applies) == 0): ?><?php i18n($lang, 'page.classroom-apply-delete.no-record'); ?><?php else : ?>
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center"><?php i18n($lang, 'page.classroom-apply-delete.table-headers.apply-at') ?></th>
                  <th class="text-center"><?php i18n($lang, 'page.classroom-apply-delete.table-headers.status') ?></th>
                  <th class="text-center"><?php i18n($lang, 'page.classroom-apply-delete.table-headers.place') ?></th>
                  <th class="text-center"><?php i18n($lang, 'page.classroom-apply-delete.table-headers.date') ?></th>
                  <th class="text-center"><?php i18n($lang, 'page.classroom-apply-delete.table-headers.time') ?></th>
                  <th class="text-center"><?php i18n($lang, 'page.classroom-apply-delete.table-headers.cancel-apply') ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($applies as $apply): ?>
                  <?php if ($apply['status'] == 2 OR $apply['status'] == 4): continue; endif; ?>
                  <tr>
                    <td><?php echo date('Y-m-d, H:i:s', $apply['created_at']) ?></td>
                    <?php
                      if ($apply['status'] == 0) {
                        echo '<td class="label-primary">'.render_icon('hourglass-start').apply_state_type('0', $lang).'</td>';
                      } else if ($apply['status'] == 1) echo '<td class="label-success">'.render_icon('check').apply_state_type('1', $lang).'</td>';
                    ?>
                    <td><?php echo $apply['classroom']['name']; ?></td>
                    <td><?php echo $apply['date']; ?></td>
                    <td><?php echo classroom_rule_display_time($apply); ?></td>
                    <td>
                      <button
                        data-id="<?php echo $apply['id']; ?>"
                        data-status="<?php echo apply_state_type($apply['status'] == 0 ? '0' : '1', $lang); ?>"
                        data-classroom="<?php echo $apply['classroom']['name']; ?>"
                        data-date="<?php echo $apply['date']; ?>"
                        data-time="<?php echo classroom_rule_display_time($apply); ?>"
                        class="btn btn-xs btn-danger btn-delete"
                      ><?php echo render_icon('times'); ?> <?php i18n($lang, 'page.classroom-apply-delete.cancel-apply'); ?></button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php $this->load->view('main/js/apply_delete_js', array('lang' => $lang)); ?>
</section>
