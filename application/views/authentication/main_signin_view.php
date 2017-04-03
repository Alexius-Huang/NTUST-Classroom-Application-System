<?php if ($lang === 'zh-TW'): ?>

<title>登入 - 學生活動中心場地借用系統</title>
<section class="content-header">
  <h1>登入</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/signin/zh-TW">學生活動中心場地借用系統</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/signin/zh-TW">登入</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-12 col-lg-offset-3 col-md-offset-2">
      <form id="form_login" action="<?php echo base_url(); ?>main_authentication/signin/zh-TW" role="form" method="post">
        <?php if ($signin_failure): ?>
          <div id="login_failure" class="alert alert-danger">
            <h4><i class="icon fa fa-user-times"></i> 登入失敗！</h4>
            請確認您輸入的登入資訊是否正確。
          </div>
        <?php endif; ?>
        <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-12">
              <div class="form-group has-feedback">
                <input class="form-control" name="studentID" placeholder="請輸入您的學號" />
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input class="form-control has-feedback" name="password" type="password" placeholder="請輸入學生資訊系統密碼" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <?php if ( ! is_developing()): ?>
              <div class="g-recaptcha" data-sitekey="6LccyhkUAAAAAMcR3B5UeI7Hct19RBRL8s5SzuEJ"></div>
              <input type="hidden" name="grecaptcha" value="" />
              <? endif; ?>
            </div>
          </div>
          <div class="box-footer">
            <button id="signin-submit-btn" class="btn btn-primary">登入</button>
            <br>
            <p>備註：建議使用 IE 以外的瀏覽器</p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php elseif ($lang === 'en-us'): ?>

<title>Sign In - Classroom Leasing System</title>
<section class="content-header">
  <h1>Sign In</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>main_authentication/signin/en-us">Classroom Leasing System</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>main_authentication/signin/en-us">Sign In</a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-lg-6 col-md-8 col-sm-12 col-lg-offset-3 col-md-offset-2">
      <form id="form_login" action="<?php echo base_url(); ?>main_authentication/signin/en-us" role="form" method="post">
        <?php if ($signin_failure): ?>
          <div id="login_failure" class="alert alert-danger">
            <h4><i class="icon fa fa-user-times"></i> Sign In Failure！</h4>
            Please check your input and try again!
          </div>
        <?php endif; ?>
        <div class="box box-primary">
          <div class="box-body">
            <div class="col-md-12">
              <div class="form-group has-feedback">
                <input class="form-control" name="studentID" placeholder="Please Enter your Student ID" />
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input class="form-control has-feedback" name="password" type="password" placeholder="Please Enter your Student Password" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <?php if ( ! is_developing()): ?>
              <div class="g-recaptcha" data-sitekey="6LccyhkUAAAAAMcR3B5UeI7Hct19RBRL8s5SzuEJ"></div>
              <input type="hidden" name="grecaptcha" value="" />
              <?php endif; ?>
            </div>
          </div>
          <div class="box-footer">
            <button id="signin-submit-btn" class="btn btn-primary">Sign In</button>
            <br>
            <p>Hint: It is recommanded to use browsers other than IE</p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<?php endif; ?>

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