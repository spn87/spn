<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010
 * @package: 
 * Blog: souphorn.blogspot.com
 * Date: Jan 25, 2011 9:01:27 AM
 * 
 */
class C_Index extends Spn_Controller
{
	public function index()
	{
		
	}
	public function v()
	{
		$url = $this->_rq("url");
		
		$m = $this->loadModel("index");
		$row = $m->fetchRow("url='$url'");
		
		$this->view->row = $row;
	}
}
?>