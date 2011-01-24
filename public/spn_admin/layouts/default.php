<html>
	<head>
		<title>Photo Management Admin</title>
		<link rel="stylesheet" type="text/css" href="css/admin.css" />
		<link rel="stylesheet" type="text/css" href="../css/global.css" />
		<link rel="stylesheet" type="text/css" href="../css/global.css" />
		<style>
		.ui-datepicker {background:#4d4d4d; font-size:10px;}
		.ui-icon-circle-triangle-w{color:#fff; float:left; padding:5px; cursor: pointer} 
		.ui-icon-circle-triangle-e {color:#fff; float:right; padding:5px; cursor:pointer}
		a.ui-state-default {color:#fff;}
		.ui-datepicker th {font-size:11px;}	
		.ui-datepicker-title {text-align:center; color:#fff;clear:both;}	
		</style>
		<script src="../includes/js/jquery.js"></script>
		<script src="../includes/js/jquery-ui-1.7.2.custom.min.js"></script>
	</head>
	<body>
		<div style="width: 950px; min-height:500px; border:0px solid red; margin: 0px auto;">
			<!-- Menus -->
			<div class="left">
				<div>
					<ul class="spn_menu_admin">
					<li><a href="index.php">Home</a></li>
					<li>
						<a href="?m=room">Rooms</a>						
					</li>
					<li>
						<a href="?m=rooma">Room availability</a>
					</li>
					<li>
						<a href="?m=roomtype">Room type</a>
					</li>					
				</ul>
				<ul>
					<li>Welcome, <?php echo $_SESSION[SESS_AD_NAME]?></li>
					<li><a href="?m=login&c=logout">Logout</a></li>
				</ul>
				</div>
				
			</div>
			<div class="right"><div>
				<div style="margin:0 10px 0 10px; border:0px dashed red; width: 100%; min-height:500px; padding-left:20px;">
					<?php $this->getController()->display();?>
				</div>			
			</div></div>
			<div style="clear:both;"></div>
		</div>
		
	</body>
</html>