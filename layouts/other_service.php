<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 *copyright All right reserved
 * Nov 17, 2010
 */


?>
<?php include 'includes/header.inc';?>
        <!-- content -->
        <div id="content">
        	<?php include 'includes/roomreview.php';?>
	        <div class="wrapper">
		        
			        	<?php 
						//Get mvc object
						echo $this->getController()->display();
						?>
			     
	        </div>
        </div>        
<?php include 'includes/footer.inc';?>