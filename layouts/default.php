<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<title><?php echo SITE_NAME?> - <?php echo $this->getTitle()?></title>
	</head>
	<body>
        <!-- content -->
        <div id="content">
        <div class="wrapper">
	        <div class="aside maxheight">
	        <!-- box begin -->
		        <div class="box maxheight">
		        <div class="inner">
			        
		        </div>
		        </div>
	        <!-- box end -->
	        </div>
	        <div class="content">
		        <div class="indent">
		        	<?php 
					//Get mvc object
					echo $this->getController()->display();
					?>
		        </div>
	        </div>
        </div>
        </div>
	</body>        
</html>