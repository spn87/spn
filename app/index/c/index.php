<?php
	class index_index extends Spn_Controller
	{
		public function init()
		{
			
		}
		public function index()
		{
			$m = $this->loadAdminModel("index", "c");
			$contents = $m->fetchAll("id!=0 ORDER BY id desc",Spn_Db::ASSOC,2);
			
			$this->view->contents = $contents;
		}
		public function bookform()
		{
			
		}
	}
?>