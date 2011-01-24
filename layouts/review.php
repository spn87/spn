<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 *copyright All right reserved
 * Nov 18, 2010
 */


?>
<?php include 'includes/header.inc';?>
        <!-- content -->
        <div id="content">
	        <div class="wrapper">
		        
		        
			        	<?php 
						//Get mvc object
						echo $this->getController()->display();
						?>
			    
	        </div>
        </div>        
<?php include 'includes/footer.inc';?>