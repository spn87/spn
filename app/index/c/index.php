<?php
	class index_index extends Spn_Controller
	{
		public function init()
		{
			
		}
		public function index()
		{
			$m = $this->loadAdminModel("index", "c");
			$contents = $m->fetchAll('',Spn_Db::ASSOC,2);
			
			$this->view->contents = $contents;
		}
		public function bookform()
		{
			
		}
	}
?>