<?php
require_once 'Spn/Table.php';
require_once 'Spn/Form.php';
require_once 'Spn/Form/Element.php';
class Artist_Index extends Spn_Controller
{
	private $fields = array(array("name"=>"Name","params"=>array(Spn_Form_Element::REQUIRE_FIELD)),array("address"=>"Address"),array("city"=>"City"));
	
	function index()
	{
		$str = "dfdakjfdksad";
		$m = preg_grep("/^(df)/", $subject);
		/*
		print_r($m);
		echo"<hr />";
		
		exit();
		*/
		$m = $this->loadModel('artist');
		$this->view->artists = $m->fetchAll();
		
		$table = new Spn_Table($m->fetchAll('',Spn_Db::ASSOC));		
		$table->setTableAttr(array("style"=>"color:green;"), Spn_Table::TD);
		echo $table->getTable();
		
	}
	
	function add()
	{
		$form = new Spn_Form("artist");
		
		$this->view->addForm = $form->getAddForm($this->fields);
	}
	function save()
	{
		$this->hideView();
		$this->hideLayout();
		
		$m = $this->loadModel('artist');
		$m->bind($_POST);
		
		if ($m->addBind())
			$this->redirect("artist","index","index");
		
	}
	
	function delete()
	{
		$this->hideLayout();
		$this->hideView();
		
		$id = $_GET['id'];
		
		$m = $this->loadModel("artist");
		
		if ($m->delete("id=".$id))
			$this->redirect("artist","index","index");
	}

	function edit()
	{
		$m = $this->loadModel("artist");
		$id = $_GET['id'];
		$this->view->artist = $m->fetchRow("id=".$id);
		
		$form = new Spn_Form("artist");
		$formData = $form->getEditForm($id,$this->fields);
		
		$this->view->editForm = $formData;
	}
	
	function update()
	{
		$this->hideLayout();
		$this->hideView();
		$m = $this->loadModel("artist");
		$id = $_POST['id'];
		
		$m->bind($_POST);
		if ($m->updateBind("id=".$id))
			$this->redirect("artist","index","index");
	}
}
?>