<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 *copyright All right reserved
 */
 
class Spn_Form 
{
	private $tableName;
	private $fields;
	private $isDefaultSubmit = true;
	private $db;
	private $idString = "id";
	private $hasCanel = true;
	
	
	public function __construct($tableName)
	{
		$tableName = TB_PREFIX.$tableName;		
		$this->tableName = $tableName;		
		require_once 'Spn/Form/Element.php';
		$this->db = new Spn_Db();
	}
	
	/**
	 * 
	 * Get html output of edit form
	 * @param int $id
	 * @param array $fields array(array("name"=>"My name","params"=>array())
	 */
	public function getEditForm($id, $fields=array())
	{
		$this->fields = $fields;		
		$data = $this->db->fetchRow($this->tableName,$this->idString."=".$id,Spn_Db::ASSOC);
		
		$db = new Spn_Db();
		$desc = $db->describe($this->tableName);
		
		$html = $this->getHtmlControls($desc,$data);
		
		$html .= "<input type='hidden' name='id' value='$id' />";
		
		return $html;
	}
	
	/**
	 * 
	 * Get the add form of table
	 * @param array $fields
	 * @return string
	 */
	public function getAddForm($fields = array())
	{
		//Setting the fields
		$this->fields = $fields;
		//$this->fields['id'] = 'Id';
		
		$db = new Spn_Db();
		$desc = $db->describe($this->tableName);		
		$html = $this->getHtmlControls($desc);
		
		return $html;
	}
	
	/**
	 * 
	 * Get the html output
	 * @param array $desc
	 * <p>The result of describing the table</p>
	 * @return string
	 */
	private function getHtmlControls(array $desc, array $data = array())
	{
		$formHtml = "";
		
		$desc = $this->filterField($desc);
		
		foreach ($desc as $field)
		{
			//Get array infor from provide array
			$labelControl = "";
			$valueControl = "";
			$params = null;
			foreach ($field['spn_params'] as $k=>$v)
			{
				if ($k != "params")
				{
					$labelControl = $v;
					$valueControl = (isset($data[$k])) ? $data[$k]:"";
				} else
				{
					$params = $v;
				}
			}
			
			//Getting label
			$label = ($labelControl != "") ? $labelControl : $field['Field'];			
			$valueControl = ($valueControl !="")?$valueControl:(isset($data[$field['Field']])) ? $data[$field['Field']]:"";
			
			$element = new Spn_Form_Element($field, $label,$params,$valueControl);
			
			$formHtml .= $element->getElement();
			
		}
		
		$formHtml .='
			<div>				
				<span><input type="submit" value="Submit"/></span> '.$this->getCancelButton().'
			</div>
		';
		
		return $formHtml;
	}
	
	/**
	 * 
	 * Handle the cancel button embed already with js
	 */
	private function getCancelButton($title = 'Cancel')
	{
		if ($this->hasCanel == false) return '';
		$cancelButton = '<span><input type="button" value="'.$title.'" onclick="window.history.back(-1);"/></span>';
		
		return $cancelButton;
	}
	
	private function getParams($field)
	{
		
	}
	
	/**
	 * 
	 * <p>Get only field that needed as specified in getAddForm</p>
	 * @param array $desc
	 * @return array
	 */
	private function filterField($desc)
	{
		$filtered = array();
		if (count($this->fields) == 0) return $desc;
		
		foreach ($desc as $field)
		{
			if ($f = $this->hasInFilter($field['Field']))
			{
				$field['spn_params'] = $f;				
				$filtered[] = $field;
			}
		}
		
		return $filtered;
	}
	
	/**
	 * 
	 * Check privided fields exist in a real table or not
	 * @param array $fieldName
	 */
	private function hasInFilter($fieldName)
	{
		foreach ($this->fields as $f)
		{
			foreach ($f as $field=>$title):
			{
				if ($field == $fieldName) return $f;
			}
			endforeach;
		}
		return false;
	}
}
?>