<!DOCTYPE html>
<html lang="zh-tw">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title><?php echo ($page === 'main' ? '後台首頁' : admin_page_name($page)) ?> | 學生活動中心場地借用系統</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <meta name="theme-color" content="#3b8ab8" />
  <meta name="msapplication-navbutton-color" content="#3b8ab8" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-5VXLRL8');</script>
  <!-- End Google Tag Manager -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets//css/pending.css" />
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets//images/logo.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.4.2/sweetalert2.min.css">
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-confirmation.min.js"></script>
  <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.2/sweetalert2.min.js"></script>
  <style>
    @media (min-width: 768px) {
      .main-header .sidebar-toggle {
        display: none;
      }
    }
  </style>

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
<body class="hold-transition skin-blue-light sidebar-mini page-<?php echo $page;?>">

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VXLRL8"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <div class="wrapper">
    <header class="main-header">
      <a href="./" class="logo">
        <span class="logo-lg"><b>NTUST</b></span>
      </a>

      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">顯示/隱藏選單</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="<?php echo base_url(); ?>admin_authentication/signout"><i class="fa fa-sign-out"> 登出</i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-circle" alt="NTUST Logo" />
          </div>
          <div class="pull-left info">
            <p><?php echo $username; ?></p>
            <a href="<?php echo base_url(); ?>admin_authentication/signout"><i class="fa fa-fw fa-sign-out text-success"></i> 登出後台</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">後台選單</li>
          <li<?php echo ($page === 'main'                                    ?  ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>admin/main"><?php echo render_icon('dashboard'); ?> 後台首頁</a></li>
          <li class="header">場地後台選單</li>
          <li<?php echo ($page === 'apply'                                   ?  ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>admin/apply"><?php echo render_icon('sticky-note-o'); ?> 審核申請</a></li>
          <li<?php echo ($page === 'application'                             ?  ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>admin/application"><?php echo render_icon('history'); ?> 申請記錄</a></li>
          <li<?php echo ($page === 'classroom' || $page === 'classroom_edit' ?  ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>admin/classroom"><?php echo render_icon('cog'); ?> 場地設定</a></li>
          <li<?php echo ($page === 'notice'                                  ?  ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>admin/notice_edit"><?php echo render_icon('info-circle'); ?> 編輯場地申請須知</a></li>
          <li class="header">器材後台選單</li>
          <li<?php echo ($page === 'device'    || $page === 'device_edit'    ?  ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>admin/device"><?php echo render_icon('cog'); ?> 器材設定</a></li>
          <li<?php echo ($page === 'device_notice'                           ?  ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>admin/device_notice_edit"><?php echo render_icon('info-circle'); ?> 編輯器材申請須知</a></li>
          <li class="header">返回借用系統</li>
          <li><a href="/"><i class="fa fa-fw fa-angle-double-left"></i> 返回借用系統</a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php echo admin_page_name($page); ?>
          <small>管理後台</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="./"><i class="fa fa-fw fa-dashboard"></i> 管理後台</a></li>
          
          <?php if ($page === 'classroom_edit' || $page === 'classroom_rule_create'): ?>
            <li><a href="#"><?php echo admin_page_name('classroom_edit'); ?></a></li>
            <li <?php if ($page === 'classroom_edit') { echo 'class="active"'; } ?>><a href="#"><?php echo admin_page_name('classroom'); ?></a></li>
            <?php if ($page === 'classroom_rule_create'): ?>
              <li class="active"><a href="#"><?php echo admin_page_name($page); ?></a></li>
            <?php endif; ?>
          <?php else: ?>
            <li class="active"><a href="#"><?php echo admin_page_name($page); ?></a></li>
          <?php endif; ?>
        </ol>
      </section>

      <section class="content">
        <div class="callout callout-info">
          <h4>提醒：將不會自動載入最新資料</h4>
          <p>因技術問題，若資料有更新將無法即時顯示，請您定期重新整理以確保您所檢視的資料為最新的狀態！</p>
        </div>

        <?php echo $output;?>
      </section>
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        本後台採用 <a href="https://almsaeedstudio.com" title="Almsaeed Studio"><b>Admin</b>LTE</a> 主題
      </div>
      <strong>Copyright <a href="<?php echo base_url(); ?>admin/main">&copy;</a> 2016.</strong> All rights reserved.
    </footer>

    <div class="control-sidebar-bg"></div>
  </div><!-- ./wrapper -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
  <script>moment.locale("zh-tw", { weekdaysMin: "日一二三四五六".split("") });</script>
</body>
</html>