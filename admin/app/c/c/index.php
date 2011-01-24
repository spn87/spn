<?php
/*
 * Author: An Souphorn
 * Email: ansouphorn@gmail.com
 * Blog: souphorn.blogspot.com
 * 
 * Created on Jan 24, 2011
 *
 */

require_once "Spn/Table.php";
class C_Index extends Spn_Controller
{
	private $fields = array(array("title"=>"Title"));
	public function index()
	{
		$m = $this->loadModel("index");
		$data = $m->fetchAll("",Spn_Db::ASSOC);
		
		$table = new Spn_Table($data, $this->fields);
		$table->setTableAttr(array("class"=>"admin-table"));
		$this->view->table = $table->getTable();
	}
}

?>