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
  <div class="login-box<?php //echo $msg_class ?>">
    <div class="login-logo">
      <a href="./"><b>NTUST</b></a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <?php if ($warning_message): ?>
        <p class="login-box-msg" style="color: red"><?php echo $warning_message; ?></p>
      <?php endif; ?>
      <form action="<?php echo base_url(); ?>admin_authentication/signin" method="post">
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
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">登入</button>
          </div><!-- /.col -->
        </div>
        <!--
        <div class="g-recaptcha text-center" data-sitekey="6Le0QRYTAAAAADCcXwkg4u4dVH_uPbSUeJDutCB6">
        </div> /.g-recaptcha -->
      </form>

      <a href="/">&laquo; 返回 學生活動中心場地借用系統</a>

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
  </script>
</body>
</html>