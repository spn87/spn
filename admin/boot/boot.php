<?php
	DEFINE('FROM_ADMIN',1);
	
	//Set include path
	set_include_path(get_include_path() . PATH_SEPARATOR . (APP_PATH .'/../libs') );
	
	//Create new DB Object
	if (USE_DB):
		require_once "Spn/Db.php";
		$db = new SPN_DB();
	endif;
	
	//Start session
	session_start();
	
	//User authentication
	require_once 'Spn/User.php';
	$user = new Spn_User();
	
	if (isset($_GET['m']))
	{
		if ($_GET['m'] != 'login' and !$user->validate(true))
		{
			header("location: login.php");
			return;
		}
	} else
		if (!$user->validate(true))
		{
			header("location: login.php");
			return;
		}
	
	//Execute MVC
	require_once "Spn/Mvc.php";
	$mvc = new Spn_Mvc(true);
	
?>
