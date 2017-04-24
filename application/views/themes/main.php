<!DOCTYPE html>
<html lang="zh-tw">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <meta name="description" content="<?php if ($lang === 'zh-TW'): ?>國立台灣科技大學學生活動中心場地暨器材借用管理系統。<?php elseif ($lang === 'en-us'): ?>National Taiwan University of Science and Technology - Classroom and Device Leasing System for Students<?php endif; ?>" />
  <meta name="theme-color" content="#1f1f1f" />
  <meta name="msapplication-navbutton-color" content="#1f1f1f" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/logo.png" />

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-5VXLRL8');</script>
  <!-- End Google Tag Manager -->
  
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.4.2/sweetalert2.min.css">
  <script> var lang = 'zh-tw'; </script>
  <!--[if lt IE 9]>
      <script src="<?php echo base_url(); ?>assets//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="<?php echo base_url(); ?>assets//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
  <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.2/sweetalert2.min.js"></script>
  <?php
    if(!empty($meta))
    foreach($meta as $name=>$content){
      echo "\n\t\t";
      ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
        }
    echo "\n";

    if(!empty($canonical))
    {
      echo "\n\t\t";
      ?><link rel="canonical" href="<?php echo $canonical?>" /><?php

    }
    echo "\n\t";

    foreach($css as $file){
      echo "\n\t\t";
      ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
    } echo "\n\t";

    foreach($js as $file){
        echo "\n\t\t";
        ?><script src="<?php echo $file; ?>"></script><?php
    } echo "\n\t";
  ?>
</head>
<body class="hold-transition skin-black-light sidebar-mini">

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VXLRL8"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <div class="wrapper">
    <header class="main-header">
      <a href="/" class="logo">
        <span class="logo-lg"><b>NTUST</b></span>
      </a>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle hidden-sm hidden-md hidden-lg" data-toggle="offcanvas" role="button">
          <span class="sr-only"><?php i18n($lang, 'main.view-or-hide-menu') ?></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="nav-language">
              <a href="<?php echo base_url(); ?>main_authentication/signin/<?php i18n($lang, 'general.link.change-lang'); ?>">
                <i class="flag-icon flag-icon-us"></i>
                <span class="hidden-xs hidden-sm"><?php i18n($lang, 'main.change-lang'); ?></span>
              </a>
            </li>
            <li class="nav-status">
              <a href="<?php echo base_url(); ?>main_authentication/classroom_status/<?php i18n($lang, 'general.link.current-lang'); ?>">
                <?php echo render_icon('users'); ?>
                <span class="hidden-xs hidden-sm"><?php i18n($lang, 'main.classroom.status-check'); ?></span>
              </a>
            </li>
            <li class="nav-status">
              <a href="<?php echo base_url(); ?>main_authentication/device_status/<?php i18n($lang, 'general.link.current-lang'); ?>">
                <?php echo render_icon('tasks'); ?>
                <span class="hidden-xs hidden-sm"><?php i18n($lang, 'main.device.status-check'); ?></span>
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
            <p><a href="<?php echo base_url(); ?>main_authentication/classroom_status/<?php i18n($lang, 'general.link.current-lang'); ?>" class="site-title"><?php i18n($lang, 'main.site-title') ?></a></p>
            <?php if ($this->session->userdata('signin')): ?>
              <p id="user_information"><span><?php echo $this->session->userdata('studentID'); ?></span> <?php i18n($lang, 'main.greeting'); ?></p>
            <?php else: ?>
              <p id="not_login"><?php i18n($lang, 'main.not-login'); ?></p>
            <?php endif; ?>
          </div>
        </div>
        <ul class="sidebar-menu">
          <?php if ($this->session->userdata('signin')): ?>
            <li class="header"><?php i18n($lang, 'main.leasing-facility'); ?></li>
            <?php if ($page === 'system'): ?>
              <li><a href="<?php echo base_url(); ?>main/apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('users'); ?> <?php i18n($lang, 'main.classroom.leasing-system'); ?></a></li>
              <li><a href="<?php echo base_url(); ?>main/device_apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('tasks'); ?> <?php i18n($lang, 'main.device.leasing-system'); ?></a></li>
            <?php elseif ($type === 'classroom') :?>
              <li class="nav-notice <?php if ($page === 'apply_notice') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main/apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('info-circle'); ?> <?php i18n($lang, 'main.classroom.info'); ?></a></li>
              <li class="nav-apply <?php if ($page === 'apply_new') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main/apply_new/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('file-text'); ?> <?php i18n($lang, 'main.classroom.new'); ?></a></li>
              <li class="nav-cancel <?php if ($page === 'apply_delete') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main/apply_delete/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('trash'); ?> <?php i18n($lang, 'main.classroom.cancel'); ?></a></li>
              <li class="nav-record <?php if ($page === 'apply_record') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main/apply_record/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('history'); ?> <?php i18n($lang, 'main.classroom.record'); ?></a></li>
              <li class="nav-status <?php if ($page === 'classroom_status') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main_authentication/classroom_status/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('calendar'); ?> <?php i18n($lang, 'main.classroom.status-check'); ?></a></li>
              <li class="header"><?php i18n($lang, 'main.switch-system'); ?></li>
              <li><a href="<?php echo base_url(); ?>main/device_apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('tasks'); ?> <?php i18n($lang, 'main.device.leasing-system'); ?></a></li>
            <?php elseif ($type === 'device'): ?>
              <li class="nav-notice <?php if ($page === 'device_apply_notice') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main/device_apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('info-circle'); ?> <?php i18n($lang, 'main.device.info'); ?></a></li>
              <li class="nav-apply <?php if ($page === 'device_apply_new') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main/device_apply_new/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('file-text'); ?> <?php i18n($lang, 'main.device.new'); ?></a></li>
              <li class="nav-cancel <?php if ($page === 'device_apply_delete') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main/device_apply_delete/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('trash'); ?> <?php i18n($lang, 'main.device.cancel'); ?></a></li>
              <li class="nav-record <?php if ($page === 'device_apply_record') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main/device_apply_record/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('history'); ?> <?php i18n($lang, 'main.device.record'); ?></a></li>
              <li class="nav-status <?php if ($page === 'device_status') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main_authentication/device_status/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('calendar'); ?> <?php i18n($lang, 'main.device.status-check'); ?></a></li>
              <li class="header"><?php i18n($lang, 'main.switch-system'); ?></li>
              <li><a href="<?php echo base_url(); ?>main/apply_notice/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('users'); ?> <?php i18n($lang, 'main.classroom.leasing-system'); ?></a></li>
            <?php endif; ?>
          <?php endif; ?>

          <li class="header"><?php i18n($lang, 'main.account-facility'); ?></li>
          <?php if ($this->session->userdata('signin')): ?>
            <li class="nav-logout"><a href="<?php echo base_url(); ?>main_authentication/signout/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('sign-out'); ?> <?php i18n($lang, 'main.signout') ?></a></li>
          <?php else: ?>
            <li class="nav-login <?php if ($page === 'main_signin') echo 'active'; ?>"><a href="<?php echo base_url(); ?>main_authentication/signin/<?php i18n($lang, 'general.link.current-lang'); ?>"><?php echo render_icon('sign-in'); ?> <?php i18n($lang, 'main.signin'); ?></a></li>
          <?php endif; ?>
        </ul>
      </section>
    </aside>
    <main class="content-wrapper">
      <?php echo $output; ?>
    </main>
    <footer class="main-footer">
      <div id="ie" class="label-warning"><!--[if lt IE 9]>本系統不支援低於 IE 9 之瀏覽器，若想獲得最佳使用體驗，請使用 Firefox 或其他瀏覽器（例如：Chrome、Safari、Opera）。<![endif]--></div>
      <div id="copyright">Copyright <a href="<?php echo base_url() ?>admin_authentication/signin/<?php i18n($lang, 'general.link.current-lang'); ?>">&copy;</a> 2016
    </footer>
  </div>

</body>
</html>
