<?php

class Spn_Controller
{
	private $_m,$_c,$_a;
	
	
	public $layout;
	public $view;
	public $_useLayout = true;
	public $_useView = true;	
	
	public function init(){}
	
	public function __construct($m,$c,$a)
	{
		$this->_m = $m;
		$this->_c = $c;
		$this->_a = $a;
	}
	
	public function prepare()
	{
		if (!$this->_useView)
		{
			$this->view = new stdClass();
		}else
		{
			require_once "Spn/View.php";
			$this->view = new Spn_View();		
		}		
	}
	
	public function hideLayout()
	{
		$this->_useLayout = false;
	}
	
	public function hideView()
	{
		$this->_useView = false;
	}
	
	protected function _rq($rq)
	{
		//Return
		$r = '';
		if (!isset($_REQUEST[$rq]))
			return $r;
		
		return $_REQUEST[$rq];
	}
	
	public function display($forAdmin=false)
	{
		if ($this->_useView)
			$this->view->display($this->_m,$this->_c,$this->_a,$forAdmin);
		
	}
	
	public function setLayout($file)
	{
		$this->layout = $file;
	}
	
	public function setController($m,$c,$a)
	{
		$this->_m = $m;
		$this->_c = $c;
		$this->_a = $a;
	}
	
	public function redirect($m,$c,$a)
	{
		header("location: ?m=$m&c=$c&a=$a");
	}
	
	public function setView($m,$c,$a)
	{
		$this->_m = $m;
		$this->_c = $c;
		$this->_a = $a;
	}
	
	/**
	 * Load model
	 * @param string $model
	 * @return Spn_Model
	 */
	protected function loadModel($model, $module = null)
	{
		$path = $this->getDir($module);		
		require_once 'Spn/Model.php';
		if (is_null($module))
		{
			require_once $path .'/m/'.$this->_m.'_'.$model.'.php';
			$className = strtoupper(substr($this->_m,0,1)) . substr($this->_m,1).strtoupper(substr($model,0,1)) . substr($model,1) .'_Model';
		}
		else
		{
			require_once $path .'/m/'.$module.'_'.$model.'.php';
			$className = strtoupper(substr($module,0,1)) . substr($module,1).strtoupper(substr($model,0,1)) . substr($model,1) .'_Model';
			
		}		
		
		/**
		 * Return the Spn_Model object
		 */
		return new $className();
		
	}
	
	protected function loadAdminModel($model, $module)
	{
		require_once 'Spn/Model.php';
		$path = ADMIN_APP_PATH.'/'.$module.'/m/'.$module.'_'.$model.'.php';
		
		require_once $path;
		$className = strtoupper(substr($module,0,1)) . substr($module,1).strtoupper(substr($model,0,1)) . substr($model,1) .'_Model';
		
		return new $className();
	}
	
	/**
	 * Get the current directory of model which controller is called
	 * @return string
	 */
	protected function getDir($model)
	{
		$path = (FROM_ADMIN) ? ADMIN_APP_PATH:APP_PATH;
		if (is_null($model))
			$path = $path. '/'.$this->_m ;
		else
			$path = $path . '/'.$model ;
		
		return $path;
	}
}

?>