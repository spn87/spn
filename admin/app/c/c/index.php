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
require_once "Spn/Form/Element.php";
class C_Index extends Spn_Controller
{
	private $fields = array(array("title"=>"Title"));
	private $addFields = array(array("title"=>"Title"),
						array("url"=>"Url"),
						array("content"=>"Content","params"=>array(Spn_Form_Element::TEXT_AREA)),);
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
		
		$this->view->form = $form->getAddForm($this->addFields);
	}
	
	public function save()
	{
		$this->hideView();
		$this->hideLayout();
		$data = $_POST;
		//$data["url"] = urlencode($data["url"]);
		
		//print_r($data);
		//exit();
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
		$form = new Spn_Form("contents");
		$this->view->form = $form->getEditForm($this->_rq("id"), $this->addFields);
	}
}

?>