<?php
	require_once dirname(__FILE__)."/../conf/conf.php";
	DEFINE('FROM_ADMIN',0);
	
	//Set include path
	set_include_path(get_include_path() . PATH_SEPARATOR . (APP_PATH .'/../libs'));
	
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
	
	//Execute MVC
	require_once "Spn/Mvc.php";
	$mvc = new Spn_Mvc();
	
?>
