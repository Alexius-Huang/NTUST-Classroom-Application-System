<title><?php i18n($lang, 'page.signin.title') ?> - <?php i18n($lang, 'main.site-title') ?></title>
<section class="content-header">
  <h1><?php i18n($lang, 'page.signin.title') ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/signin/<?php i18n($lang, 'general.link.current-lang') ?>"><?php i18n($lang, 'main.site-title') ?></a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/signin/<?php i18n($lang, 'general.link.current-lang') ?>"><?php i18n($lang, 'page.signin.title') ?></a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-12 col-lg-offset-3 col-md-offset-2">
      <form id="form_login" action="<?php echo base_url(); ?>main_authentication/signin/<?php i18n($lang, 'general.link.current-lang') ?>" role="form" method="post">
        <?php if ($signin_failure): ?>
          <div id="login_failure" class="alert alert-danger">
            <h4><i class="icon fa fa-user-times"></i> <?php i18n($lang, 'page.signin.failure'); ?></h4>
            <?php i18n($lang, 'page.signin.failure-message'); ?>
          </div>
        <?php endif; ?>
        <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-12">
              <div class="form-group has-feedback">
                <input class="form-control" name="studentID" placeholder="<?php i18n($lang, 'page.signin.student-id-placeholder'); ?>" />
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input class="form-control has-feedback" name="password" type="password" placeholder="<?php i18n($lang, 'page.signin.password-placeholder'); ?>" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <?php if ( ! is_developing()): ?>
              <div class="g-recaptcha" data-sitekey="6LccyhkUAAAAAMcR3B5UeI7Hct19RBRL8s5SzuEJ"></div>
              <input type="hidden" name="grecaptcha" value="" />
              <? endif; ?>
            </div>
          </div>
          <div class="box-footer">
            <button id="signin-submit-btn" class="btn btn-primary"><?php i18n($lang, 'page.signin.signin'); ?></button>
            <br>
            <p><?php i18n($lang, 'page.signin.remark'); ?></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<script src='https://www.google.com/recaptcha/api.js'></script>

<?php if ( ! is_developing()):?>
<script>
  $('button#signin-submit-btn').on('click', function(event) {
    event.preventDefault();
    $('input[name="grecaptcha"]')[0].setAttribute('value', grecaptcha.getResponse());
    $('form#form_login').submit();
  });
</script>
<?php endif; ?>