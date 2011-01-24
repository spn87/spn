<?php

class Spn_Mvc 
{
	private $c; //Controller object
	private $_m; //Module
	private $_c; //Controller
	private $_a; //Action
	
	public function __construct($forAdmin=false)
	{
		$this->determineMvc($forAdmin);
	}
	
	public function content()
	{
		//echo 'Displaying';
		echo $this->_m . ' - ' .$this->_c . ' - ' . $this->_a;
	}
	
	public function determineMvc($forAdmin=false)
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
		if (!$forAdmin)
			require_once APP_PATH.'/'.$this->_m.'/c/'.$this->_c.'.php';
		else 
			require_once ADMIN_APP_PATH.'/'.$this->_m.'/c/'.$this->_c.'.php';
		$className = $this->_m .'_' . $this->_c;
		
		$controller = new $className($this->_m,$this->_c,$this->_a);
		$a = $this->_a;
		$controller->init();
		//Prepare before execute action
		$controller->prepare();
		
		$this->c = $controller;
		//Execute action
		$controller->$a();
		
		$this->display($forAdmin);		
	}
	
	private function _rq($rq)
	{

		$r = '';
		if (!isset($_GET[$rq]))
			return $r;
		
		return $_GET[$rq];
	}
	
	public function display($forAdmin=false)
	{
		$path = APP_PATH;
		if ($forAdmin) $path = ADMIN_APP_PATH;	
		//Hide layout
		if ($this->c->_useLayout)
		{	
			if (!file_exists($path."/../layouts/default.php"))
				throw new Exception("Layout not set");
			else
			if ($this->c->layout == '')
			{
				require_once $path."/../layouts/default.php";
			}	
			else
			{
				require_once $path.'/../'.$this->c->layout;
			}
		} else
		{
			if ($this->c->_useView)
				echo $this->getController()->display($forAdmin);
		}
	}
	
	private function getController()
	{		
		return $this->c;
	}
}
?>