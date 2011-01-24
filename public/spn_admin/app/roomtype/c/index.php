<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 * copyright All right reserved
 * Oct 31, 2010
 */

require_once 'Spn/Form.php';
require_once 'Spn/Table.php';
class Roomtype_index extends Spn_Controller
{
	private $n = "room_types";
	private $fields = array(array("name"=>"Room type"), array("price"=>"Price per day"));
	private $fieldWrap = array("name"=>"<a href='?m=roomtype&amp;c=index&amp;a=edit&amp;id={id}'>{this}</a>");
	public function index()
	{
		$m = $this->loadModel('index');
		$data = $m->fetchAll('',Spn_Db::ASSOC);
		
		$tableObj = new Spn_Table($data, $this->fields);
		$tableObj->setWrapper($this->fieldWrap);		
		$tableObj->setTableAttr(array("width"=>"100%"));
		$this->view->table = $tableObj->getTable();
	}
	
	public function add()
	{
		$form = new Spn_Form($this->n);
		$this->view->addForm = $form->getAddForm($this->fields);		
	}
	
	public function edit()
	{
		$id = $_REQUEST['id'];		
		$form = new Spn_Form($this->n);		
		$this->view->editForm = $form->getEditForm($id, $this->fields);
	}
	
	public function save()
	{
		$this->hideLayout();
		$this->hideView();
		
		$m = $this->loadModel("index");
		$m->bind($_POST);		
		if (!isset($_POST['id']))
		{
			if ($m->addBind())
			{
				echo 'dfdsfa';
				$this->redirect("roomtype","index","index");
			}
		} else
		{
			if ($m->updateBind("id='".$_POST['id']."'"))
			{
				$this->redirect("roomtype","index","index");
			}
		}
		
		$this->redirect("roomtype","index","index");
	}
	
	public function delete()
	{
		$this->hideLayout();
		$this->hideView();
		$m = $this->loadModel("index");
		$id = $_REQUEST['id'];
		$m->delete("id=$id");
		$this->redirect("roomtype","index","index");
	}
}


?>
