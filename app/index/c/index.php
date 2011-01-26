<?php
	class index_index extends Spn_Controller
	{
		public function init()
		{
			
		}
		public function index()
		{
			$m = $this->loadModel("index", "c");
			$contents = $m->getContents();
			
			$this->view->contents = $contents;
		}
		public function bookform()
		{
			
		}
	}
?>