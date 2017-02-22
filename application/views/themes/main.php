<!DOCTYPE html>
<html lang="zh-tw">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <meta name="description" content="國立台灣科技大學學生活動大樓教室借用系統。" />
  <meta name="theme-color" content="#1f1f1f" />
  <meta name="msapplication-navbutton-color" content="#1f1f1f" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/logo.png" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datepicker/css/bootstrap-datepicker.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/flag-icon.min.css" />
  <!--link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui.min.css" /-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css?v=f9f22a4" />
  <script> var lang = 'zh-tw'; </script>
  <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>assets//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="<?php echo base_url(); ?>assets//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
</head>
<body class="hold-transition skin-black-light sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="/" class="logo">
        <span class="logo-lg"><b>NTUST</b>SG</span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle hidden-sm hidden-md hidden-lg" data-toggle="offcanvas" role="button">
          <span class="sr-only">顯示/隱藏選單</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="nav-language">
              <a href="/en-us">
                <i class="flag-icon flag-icon-us"></i>
                <span class="hidden-xs hidden-sm">English Version</span>
              </a>
            </li>
            <li class="nav-status">
              <a href="status.shtml">
                <?php echo render_icon('calendar'); ?>
                <span class="hidden-xs hidden-sm">借用狀態查詢</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-circle" alt="NTUST Logo" />
          </div>
          <div class="pull-left info">
            <p><a href="/" class="site-title">學生活動大樓教室借用系統</a></p>
            <?php if ($this->session->userdata('signin')): ?>
              <p id="user_information"><span><?php echo $this->session->userdata('studentID'); ?></span> 您好！</p>
            <?php else: ?>
              <p id="not_login">您尚未登入。</p>
            <?php endif; ?>
          </div>
        </div>
        <ul class="sidebar-menu">
          <li class="header">借用功能</li>
          <?php if ($this->session->userdata('signin')): ?>
            <li class="nav-notice"><a href="<?php echo base_url(); ?>main/apply_notice"><?php echo render_icon('info-circle'); ?> 借用須知</a></li>
            <li class="nav-apply"><a href="<?php echo base_url(); ?>main/apply_new"><?php echo render_icon('file-text'); ?> 申請借用</a></li>
            <li class="nav-cancel"><a href="<?php echo base_url(); ?>main/apply_delete"><?php echo render_icon('trash'); ?> 取消借用</a></li>
            <li class="nav-record"><a href="<?php echo base_url(); ?>main/apply_record"><?php echo render_icon('history'); ?> 借用記錄</a></li>
          <?php endif; ?>
          <li class="nav-status"><a href="<?php echo base_url(); ?>main_authentication/classroom_status"><?php echo render_icon('calendar'); ?> 借用狀態查詢</a></li>

          <li class="header">帳號功能</li>
          <?php if ($this->session->userdata('signin')): ?>
            <li class="nav-logout"><a href="<?php echo base_url(); ?>main_authentication/signout"><?php echo render_icon('sign-out'); ?> 登出</a></li>
          <?php else: ?>
            <li class="nav-login"><a href="<?php echo base_url(); ?>main_authentication/signin"><?php echo render_icon('sign-in'); ?> 登入</a></li>
          <?php endif; ?>
        </ul>
      </section>
    </aside>
    <main class="content-wrapper">
      <?php echo $output; ?>
    </main>
    <footer class="main-footer">
        <div id="ie" class="label-warning"><!--[if lt IE 9]>本系統不支援低於 IE 9 之瀏覽器，若想獲得最佳使用體驗，請使用 Firefox 或其他瀏覽器（例如：Chrome、Safari、Opera）。<![endif]--></div>
        <div id="copyright">Copyright <a href="<?php echo base_url() ?>admin_authentication/signin">&copy;</a> 2016 <a href="http://sg.ntust.link" title="國立臺灣科技大學學生會">NTUSTSG</a>. All rights reserved.</div>
    </footer>
    <script src="/js/api.js"></script>
    <script src="/js/ga.js"></script>
  </div>
</body>
</html>
