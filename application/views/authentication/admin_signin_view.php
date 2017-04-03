<!DOCTYPE html>
<html lang="zh-tw">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>後台登入 | 學生活動中心場地借用系統</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <meta name="theme-color" content="#d2d6de" />
  <meta name="msapplication-navbutton-color" content="#d2d6de" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-5VXLRL8');</script>
  <!-- End Google Tag Manager -->

  <script src='https://www.google.com/recaptcha/api.js'></script>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css" />
  <link rel="icon" type="image/png" href="/images/logo.png" />
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
    .g-recaptcha {
      display: table;
      left: 50%;
      margin: 8px -152px;
      position: relative;
      right: 50%;
    }
    .login-box.login-failure .login-box-msg {
      color: #f00;
    }
  </style>
  <!--
  <script src="//www.google.com/recaptcha/api.js"></script>
  -->
</head>
<body class="hold-transition login-page">

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VXLRL8"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <div class="login-box<?php //echo $msg_class ?>">
    <div class="login-logo">
      <a href="./"><b>NTUST</b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <?php if ($warning_message): ?>
        <p class="login-box-msg" style="color: red"><?php echo $warning_message; ?></p>
      <?php endif; ?>
      <form id="form_login" action="<?php echo base_url(); ?>admin_authentication/signin" method="post">
        <div class="form-group has-feedback">
          <input name="account" class="form-control" placeholder="帳號" />
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input name="password" type="password" class="form-control" placeholder="密碼" />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <!--div class="checkbox icheck">
              <label>
                <input type="checkbox" /> 記住帳號密碼
              </label>
            </div-->
          </div><!-- /.col -->
          <div class="g-recaptcha" data-sitekey="6LccyhkUAAAAAMcR3B5UeI7Hct19RBRL8s5SzuEJ"></div>
          <input type="hidden" name="grecaptcha" value="" /> 
          <div class="col-xs-4">
            <button id="signin-submit-btn" type="submit" class="btn btn-primary btn-block btn-flat">登入</button>
          </div><!-- /.col -->
        </div>        <!--
        <div class="g-recaptcha text-center" data-sitekey="6Le0QRYTAAAAADCcXwkg4u4dVH_uPbSUeJDutCB6">
        </div> /.g-recaptcha -->
      </form>

      <br>
      <a href="/">&laquo; 返回 學生活動中心場地借用系統</a>
      <p>備註：建議使用 IE 以外的瀏覽器</p>

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });

    $('button#signin-submit-btn').on('click', function(event) {
      event.preventDefault();
      $('input[name="grecaptcha"]')[0].setAttribute('value', grecaptcha.getResponse());
      $('form#form_login').submit();
    });
  </script>
</body>
</html>