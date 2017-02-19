<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta name="resource-type" content="document" />
		<meta name="robots" content="all, index, follow"/>
		<meta name="googlebot" content="all, index, follow" />
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
    <link href="<?php echo base_url(); ?>assets/themes/default/bootstrap/bootstrap.min.css" rel="stylesheet">
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

  <body>

    <!-- Navbar -->

    <div class="row">
	    <?php echo $output;?>
		</div>

    <!-- Footer -->

</body></html>
