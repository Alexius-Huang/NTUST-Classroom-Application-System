<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta name="resource-type" content="document" />
		<meta name="robots" content="all, index, follow"/>
		<meta name="googlebot" content="all, index, follow" />
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
		<meta name="description" content="國立台灣科技大學學生活動中心場地借用系統。" />
		<meta name="theme-color" content="#1f1f1f" />
		<meta name="msapplication-navbutton-color" content="#1f1f1f" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<?php
	/** -- Copy from here -- */
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

	/** -- to here -- */
?>

    <!-- Le styles -->
		<link rel="icon" type="<?php echo base_url(); ?>assets/image/png" href="/images/logo.png" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" />
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
				<script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
				<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>    

	<div class="row">
		<?php echo $output;?>
	</div>

	<!-- Footer -->
	<footer class="main-footer">
		<div id="ie" class="label-warning"><!--[if lt IE 9]>本系統不支援低於 IE 9 之瀏覽器，若想獲得最佳使用體驗，請使用 Firefox 或其他瀏覽器（例如：Chrome、Safari、Opera）。<![endif]--></div>
		<div id="copyright">Copyright <a href="/admin/">&copy;</a> 2016 <a href="http://sg.ntust.link" title="國立臺灣科技大學學生會">NTUSTSG</a>. All rights reserved.</div>
	</footer>

</body>
</html>
