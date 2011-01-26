<?php
class Spn_User
{
	private $isVerified = false;
	function __construct()
	{
		
	}
	
	/**
	 * @method Function will execute when login
	 * 
	 * @param $username Username
	 * @param $password Password
	 * @return True if login successfully
	 * 
	 */
	function login($username, $password, $isAdmin = false)
	{
		global $db;
		$table = TB_PREFIX.'users';
		$query = "SELECT * FROM $table " . " WHERE username='$username' and pwd=password('$password')". (($isAdmin) ? ' AND su=1':'');
		
		$r = $db->fetchAll($query);
		//print_r($r);
		if (count($r) == 1)
		{
			if ($isAdmin)
			{
				$_SESSION[SESS_AD_NAME] = $r[0]->name;
				$_SESSION[SESS_AD_USERANME] = $username;
				$_SESSION[SESS_AD_PASSWORD] = $r[0]->pwd;
				return true;
			} else
			{
				$_SESSION[SESS_NAME] = $r[0]->name;
				$_SESSION[SESS_USERNAME] = $username;
				$_SESSION[SESS_PASSWORD] = $r[0]->pwd;					
				return true;
			}
		} else
		{
			return false;
		}
	}
	
	/**
	 * @method Validate everytime that user in the system
	 * 
	 * @param mixed $username
	 * @param mixed $password
	 * @return boolean
	 */
	function validate($isAdmin=false)
	{
		
		global $db;
		$table = TB_PREFIX.'users';
		if (!$isAdmin)
		{
			if (!isset($_SESSION[SESS_USERNAME])) return false;
			
			if (!isset($_SESSION[SESS_PASSWORD])) return false;
			
			$query = "SELECT * FROM $table" . " WHERE username='".$_SESSION[SESS_USERNAME]."' and pwd='".$_SESSION[SESS_PASSWORD]."'";
		} else
		{
			if (!isset($_SESSION[SESS_AD_USERANME])) return false;
			
			if (!isset($_SESSION[SESS_AD_PASSWORD])) return false;
			
			$query = "SELECT * FROM $table" . " WHERE username='".$_SESSION[SESS_AD_USERANME]."' and pwd='".$_SESSION[SESS_AD_PASSWORD]."'" . (($isAdmin) ? ' AND su=1':'');
		}
		
		$r = $db->fetchAll($query);
		
		//Return true if valid session
		if (count($r) == 1)				
			return true;
		return false;
		
	}
	
	public function listAll()
	{
		global $db;
		$table = TB_PREFIX.'users';
		$query = "SELECT * FROM $table";
		
		return $db->fetchAll($query, "", Spn_Db::ASSOC);
	}
}
?>