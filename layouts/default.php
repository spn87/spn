<?php include 'includes/header.inc';?>
        <!-- content -->
        <div id="content">
	        <div class="wrapper">
		        <div class="aside maxheight">
		        <!-- box begin -->
			        <div class="box maxheight">
			        <div class="inner">
			        	<?php include 'includes/left.php';?>				        
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
<?php include 'includes/footer.inc';?>