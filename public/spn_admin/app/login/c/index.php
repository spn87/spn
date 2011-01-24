<?php
class login_index extends Spn_Controller
{
	function init()
	{
		require_once "Spn/User.php";
	}
	function index()
	{
		$this->hideLayout();
		$this->hideView();
		
		
		if(isset($_POST['u']) and isset($_POST['p']))
		{
			
			$u = $_POST['u'];
			$p = $_POST['p'];
			
			
			$user = new Spn_User();
			
			$user->login($u,$p,true);
			
			$this->redirect("index","index","index");
		}
		
	}
}
?>
