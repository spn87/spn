<?php 
require_once dirname(__FILE__).'/menus.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head xmlns="">
        <title>Hotel, Tours, Restaurant</title>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <meta content="text/css" http-equiv="Content-Style-Type" />
        <meta content="This is a wonderful homepage of the Hotel Website provided by Mr.Beng Ngim." name="description" />
        <link rel="stylesheet" type="text/css" href="style.css" />                
        <script src="includes/js/jquery-1.3.2.js"></script>
        <script src="includes/js/jquery-ui-1.7.2.custom.min.js"></script>        
        <script src="includes/js/jquery.lightbox-0.5.js"></script>
        <script type="text/javascript" src="includes/js/jquery.galleriffic.js"></script>
        <link media="screen" href="includes/css/jquery.lightbox-0.5.css" type="text/css" rel="stylesheet">        
        <link rel="stylesheet" type="text/css" href="layout.css" /><script src="maxheight.js" type="text/javascript"></script><!--[if lt IE 7]>
	<link href="ie_style.css" rel="stylesheet" type="text/css" />	
   <script type="text/javascript" src="ie_png.js"></script>
   <script type="text/javascript">
       ie_png.fix('.png, #header .row-2, #header .nav li a, #content, .gallery li');
   </script>
<![endif]-->	
    </head>
    <body id="page1" xmlns="" onload="new ElementMaxHeight();">
        <div id="main"><!-- header -->
        <div id="header">
	        <div class="row-1">
		        <div class="wrapper">
			        <div class="logo">
			        <h1><a href="?m=index">Home Sweet Home</a></h1>
			        <em>Siem Reap</em>&nbsp;<strong>True Luxury</strong></div>
			        <div class="phones">855-12-824-626<br />
			        855-12-939-856<br />
			        855-63-760-279</div>
		        </div>
	        </div>
	        <div>
	        	<?php //include 'includes/translator.php';?>
	        </div>
	        <div class="row-2">
		        <div class="indent"><!-- header-box begin -->
		        <div class="header-box">
			        <div class="inner">
				        <ul class="nav">				            
				            <?php
				            $selected = (!isset($_SESSION['m'])) ? "?m=index":$_SESSION['m'];
				            foreach ($m as $menu):
				            	$current = "";
				            	if ($selected == $menu['link']) $current = "current";
				            ?>
				            <li><a href="<?php echo $menu['link'];?>" class="<?php echo $current?>"><?php echo $menu['title']?></a></li>
				            <?php endforeach;?>
				        </ul>
			        </div>
		        </div>
		        <!-- header-box end -->
		        </div>
	        </div>
        </div>        