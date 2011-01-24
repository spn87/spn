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
class Room_index extends Spn_Controller
{
	private $n = "rooms";
	private $fields = array(array("room_num"=>"Room num"),array("guest_num"=>"Guess number"));
	private $fieldWrap = array("room_num"=>"<a href='?m=room&amp;c=index&amp;a=edit&amp;id={id}'>{this}</a>");
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
		$fields = array(array("room_num"=>"Room num"),array("guest_num"=>"Guess number",array("room_type"=>"Room type")));
		$form = new Spn_Form($this->n);
		$this->view->addForm = $form->getAddForm($fields);		
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
				$this->redirect("room","index","index");
			}
		} else
		{
			if ($m->updateBind("id='".$_POST['id']."'"))
			{
				$this->redirect("room","index","index");
			}
		}
	}
}


?>
