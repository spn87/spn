<?php
	class index_index extends Spn_Controller
	{
		public function init()
		{
			
		}
		public function index()
		{
			$m = $this->loadModel("index", "c");
			$contents = $m->getContents(10);
			
			$this->view->contents = $contents;
		}
		public function bookform()
		{
			
		}
	}
?>