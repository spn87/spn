<?php
	require_once dirname(__FILE__)."/../conf/conf.php";
	
	//Set include path
	set_include_path(get_include_path() . PATH_SEPARATOR . (dirname(__FILE__) .'/../libs'));
	
	DEFINE('APP_PATH',dirname(__FILE__) . '/..');	
	DEFINE('ROOT', dirname(__FILE__) . "/../");
	
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
