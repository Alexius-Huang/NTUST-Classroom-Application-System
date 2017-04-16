<title><?php i18n($lang, 'page.device-apply-new.title'); ?> - <?php i18n($lang, 'general.device.leasing-system'); ?></title>
<section class="content-header">
  <h1><?php i18n($lang, 'page.device-apply-new.title'); ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main/apply_new/<?php i18n($lang, 'general.link.current-lang') ?>"><?php i18n($lang, 'general.device.leasing-system'); ?></a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main/apply_new/<?php i18n($lang, 'general.link.current-lang') ?>"><?php i18n($lang, 'page.device-apply-new.title'); ?></a></li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <form id="form_apply" role="form" method="post" action="<?php echo base_url(); ?>main/device/apply_new">
      
        <?php if ($apply_failure): ?>
          <div id="apply_failure" class="alert alert-danger">
            <h4><i class="icon fa fa-user-times"></i> <?php i18n($lang, 'page.device-apply-new.apply-fail'); ?></h4>
            <?php i18n($lang, 'page.device-apply-new.apply-fail-message'); ?>
          </div>
        <?php endif; ?>
        
        <div class="box box-primary">
          <div class="box-body">
            <div class="row">

              <!-- Select Date -->
              <div class="col-md-12 form-group">
                <label for="date"><?php i18n($lang, 'page.device-apply-new.label.date'); ?></label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></div>
                  <input id="date" name="date" class="form-control" required />
                </div>
              </div>

              <!-- Select device -->
              <div class="col-md-12 form-group">
                <label for="device"><?php i18n($lang, 'page.device-apply-new.label.device'); ?></label>
                <div class="input-group">
                  <div class="input-group-addon"><?php echo render_icon('wrench'); ?></div>
                  <select id="device" name="device_id" class="form-control" disabled>
                    <option value="0"><?php i18n($lang, 'page.device-apply-new.label.select-device'); ?></option>
                  </select>
                </div>
              </div>

              <!-- Device List -->
              <div class="col-md-12 form-group">
                <label for="device-list"><?php i18n($lang, 'page.device-apply-new.label.device-list'); ?></label>
                <div id="device-list-group"><?php i18n($lang, 'page.device-apply-new.no-device-selected'); ?></div>
              </div>

              <!-- Input Organization -->
              <div class="col-md-6 form-group">
                <label for="organization"><?php i18n($lang, 'page.device-apply-new.label.organization'); ?></label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-university"></i></div>
                  <input id="organization" name="organization" class="form-control" required />
                </div>
              </div>

              <!-- Input Applicant -->
              <div class="col-md-6 form-group">
                <label for="applicant"><?php i18n($lang, 'page.device-apply-new.label.applicant'); ?></label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></div>
                  <input id="applicant" name="applicant" class="form-control" required />
                </div>
              </div>

              <!-- Input Applicant Position -->
              <div class="col-md-6 form-group">
                <label for="applicant"><?php i18n($lang, 'page.device-apply-new.label.applicant-position'); ?></label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                  <input id="applicant-position" name="applicant-position" class="form-control" required />
                </div>
              </div>

              <!-- Input Applicant's phone number -->
              <div class="col-md-6 form-group">
                <label for="phone"><?php i18n($lang, 'page.device-apply-new.label.phone'); ?></label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                  <input id="phone" name="phone" class="form-control" required />
                </div>
              </div>

              <!-- Input apply purpose -->
              <div class="col-md-12 form-group">
                <label for="purpose"><?php i18n($lang, 'page.device-apply-new.label.purpose'); ?></label>
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-tasks"></i></div>
                  <input id="purpose" name="purpose" class="form-control" required />
                </div>
              </div>
            </div>
          </div>

          <div class="box-footer">
            <button id="application-submit-btn" class="btn btn-primary"><?php i18n($lang, 'page.device-apply-new.submit'); ?></button>
          </div>

          <?php $this->load->view('main/js/device_apply_new_js', array('lang' => $lang)); ?>
        </div>
      </form>
    </div>
  </div>
</section>
