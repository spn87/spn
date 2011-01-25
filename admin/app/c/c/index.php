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
require_once "Spn/Form.php";
class C_Index extends Spn_Controller
{
	private $fields = array(array("title"=>"Title"));
	public function index()
	{
		$m = $this->loadModel("index");
		$data = $m->fetchAll("",Spn_Db::ASSOC);
		
		$table = new Spn_Table($data, $this->fields);
		$table->setTableAttr(array("class"=>"admin-table"));
		$table->setWrapper(array("title"=>"<a href='?m=c&a=edit&id={id}'>{this}</a>"));
		$this->view->table = $table->getTable();
	}
	
	public function add()
	{
		$form = new Spn_Form("contents");
		
		$this->view->form = $form->getAddForm($this->fields);
	}
	
	public function save()
	{
		$this->hideView();
		$this->hideLayout();
		$data = $_POST;
		$m = $this->loadModel("index");
		$m->bind($data);
		$id = $this->_rq("id");
		
		if (!$this->_rq("id"))
		{
			if ($m->addBind())
			{
				$this->redirect("c","index","index");
			}
		} else
		{
			if ($m->updateBind("id='".$this->_rq("id")."'"))
			{
				$this->redirect("c","index","index");
			}
		}
	}
	
	public function edit()
	{
		$fields = array();
		$fieldExtra = array(array("url"=>"Url"));
		foreach ($this->fields as $f) $fields[] = $f;
		foreach ($fieldExtra as $f) $fields[] = $f;
		$form = new Spn_Form("contents");
		$this->view->form = $form->getEditForm($this->_rq("id"), $fields);
	}
}

?>