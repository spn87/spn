<?php 
require_once 'includes/menus.php';
?>
<!-- footer -->
        <div id="footer">
	        <ul class="nav">	            
	            <?php 
	            $str = "";
	            foreach ($m as $menu):	      
	            	$link = $menu['link'];
	            	$title = $menu['title'];      
	            	$str .=<<<EOF
	            	<li><a href="$link">$title</a>|</li>
EOF;
	            ?>
	            
	            <?php 
	            endforeach;
	            
	            echo substr($str,1,-6);
	            ?>
	        </ul>
	        <div class="wrapper">
		        <div class="fleft">Copyright (c) 2010 Home Sweet Home</div>
		        <div class="fright">Powered by <a href="http://www.bengngim.co.nr/">Beng Ngim</a> Professional Web design</div>
		        <div style="clear:both;"></div>
		        <div class="fright">Developed by <a href="mailto:ansouphorn@gmail.com">An Souphorn</a></div>
	        </div>
        </div>
        </div>
        
        <?php require_once 'booking.php';?>        
    </body>
    
</html>