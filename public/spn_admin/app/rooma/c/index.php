<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 * copyright All right reserved
 * Nov 1, 2010
 */
 
class Rooma_Index extends Spn_Controller
{
	public function index()
	{
		//if (!isset($_REQUEST['date'])) return;
		
		$m = $this->loadModel("index","room");
		$d = isset($_REQUEST['date']) ? $_REQUEST['date'] : date('Y-m-d',time());
		 
		$this->view->rooms = $m->getAvailabilityRoom($d);
		$this->view->date = $d;
	}
	
	public function add()
	{
		$this->hideLayout();
		$this->hideView();
		
		$id = isset($_REQUEST['rid']) ? $_REQUEST['rid']:0;
		$date = isset($_REQUEST['date']) ? $_REQUEST['date']: '';
		if ($id == 0 || $date == '') return;
		 
		$m = $this->loadModel("a");
		$m->addBooking($id,$date);

		header("location: ?m=rooma&date=$date");
	}
	
	public function delete()
	{
		$this->hideLayout();
		$this->hideView();
		
		$id = isset($_REQUEST['rid']) ? $_REQUEST['rid']:0;
		$date = isset($_REQUEST['date']) ? $_REQUEST['date']: '';
		if ($id == 0 || $date == '') return;

		$m = $this->loadModel("a");
		$m->deleteBooking($id,$date);
		
		header("location: ?m=rooma&date=$date");
	}
}

?>
