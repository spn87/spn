<?php

class Login_Logout extends Spn_Controller
{
	function index()
	{
		$this->hideLayout();
		$this->hideView();
		
		session_destroy();
		$this->redirect("index","index","index");
		
	}
}
?>