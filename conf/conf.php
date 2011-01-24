<?php
	DEFINE("HOST","localhost");
	DEFINE("USER","souphorn");
	DEFINE("PASSWORD","souphorn");
	DEFINE("DB","spn");
	DEFINE('TB_PREFIX','hsh_');
	
	//Authentication
	DEFINE('SESS_USERNAME','spn_username');
	DEFINE('SESS_PASSWORD','spn_pwd');
	DEFINE('SESS_NAME','spn_name');
	//Authenication for Admin
	DEFINE('SESS_AD_USERANME', 'spn_ad_username');
	DEFINE('SESS_AD_PASSWORD', 'spn_ad_pwd');
	DEFINE('SESS_AD_NAME','spn_ad_name');
	
	DEFINE('ADMIN_APP_PATH',dirname(__FILE__).'/../admin/app');
	DEFINE('APP_PATH',dirname(__FILE__).'/../app');
	
	DEFINE('USE_DB',1);
	DEFINE('SITE_NAME','Spn');
?>
