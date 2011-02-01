<?php
/*
 * Author: An Souphorn
 * Email: ansouphorn@gmail.com
 * Blog: souphorn.blogspot.com
 * 
 * Created on Feb 1, 2011
 *
 */
 

class Cat_Index extends Spn_Controller
{
	public function index()
	{
		$m = $this->loadModel("index");
		$data = $m->fetchAll("",Spn_Db::ASSOC);
		
		require_once 'Spn/Tree.php';
		$treeObj = new Spn_Tree($data, "id","parent_id");
		
		$array = $treeObj->getHierachyArray(0);
		
		foreach ($array as $a)
		{
			$str = str_pad($a["name"], strlen($a["name"])+($a["__depth"]*2),"-", STR_PAD_LEFT);
			echo $str;
			echo "<hr />";
		}
		
		$this->hideLayout();
	}
}
?>