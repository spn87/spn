<?php

class Spn_Mvc 
{
	private $c; //Controller object
	private $_m; //Module
	private $_c; //Controller
	private $_a; //Action
	
	public function __construct()
	{
		$this->determineMvc();
	}
	
	public function content()
	{
		//echo 'Displaying';
		echo $this->_m . ' - ' .$this->_c . ' - ' . $this->_a;
	}
	
	public function determineMvc()
	{
		//Determine module
		if ($this->_rq('m') == '')
			$this->_m = 'index';
		else
			$this->_m = $this->_rq('m');
		
		//Determine controller
		if ($this->_rq('c') == '')
			$this->_c = 'index';
		else
			$this->_c = $this->_rq('c');
			
		//Determine action
		if ($this->_rq('a') == '')
			$this->_a = 'index';
		else
			$this->_a = $this->_rq('a');
			
		//Load controller		
		require_once 'Spn/Controller.php';
		require_once APP_PATH.'/app/'.$this->_m.'/c/'.$this->_c.'.php';		
		$className = $this->_m .'_' . $this->_c;
		
		$controller = new $className($this->_m,$this->_c,$this->_a);
		$a = $this->_a;
		$controller->init();
		//Prepare before execute action
		$controller->prepare();
		
		$this->c = $controller;
		//Execute action
		$controller->$a();
		
		$this->display();		
	}
	
	private function _rq($rq)
	{

		$r = '';
		if (!isset($_GET[$rq]))
			return $r;
		
		return $_GET[$rq];
	}
	
	public function display()
	{	
		//Hide layout
		if ($this->c->_useLayout)
		{	
			if (!file_exists(APP_PATH."/layouts/default.php"))
				throw new Exception("Layout not set");
			else
			if ($this->c->layout == '')
				require_once "layouts/default.php";
			else
			{
				
				require_once APP_PATH.'/'.$this->c->layout;
			}
		} else
		{
			if ($this->c->_useView)
				echo $this->getController()->display();
		}
	}
	
	private function getController()
	{		
		return $this->c;
	}
}
?>