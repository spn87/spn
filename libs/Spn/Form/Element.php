<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 *copyright All right reserved
 */
 
class Spn_Form_Element
{
	const REQUIRE_FIELD = 1;
	const TEXT_AREA = 2;
	const INPUT =3;
	const DROP_DOWN_LIST = 4;
	const D_DATA = 5;
		
	private $field;
	private $label;
	private $value = "";
	private $isRequire = false;
	private $controlType = self::INPUT;
	private $getElFunc = "getElement";
	
	//Drop down list info
	private $dData = array();
	/**
	 * 
	 * Get the html form element
	 * @param array $field
	 * @param string $label
	 * @return html
	 */
	public function __construct($field, $label, $params = array(),$value = "")
	{
		$this->field = $field;
		$this->label = $label;
		$this->value = $value;
		
		if (is_array($params))
		{
			foreach ($params as $k=>$p)
			{
				switch ($p)
				{
					case self::REQUIRE_FIELD:
						$this->isRequire = true;
						break;
					case self::TEXT_AREA:
						$this->controlType = self::TEXT_AREA;
						$this->getElFunc = "getTextAreaElement";
						break;
					case self::DROP_DOWN_LIST:
						$this->controlType = self::DROP_DOWN_LIST;
						$this->getElFunc = "getDropDownList";
						break;
					
				}
				
				switch($k)
				{
					case self::D_DATA:
						$this->dData = $p;
						break;
				}
			}
		}
	}
	
	public function getElement()
	{
		if ($this->controlType != self::INPUT) 
		{
			$func = $this->getElFunc;
			return $this->$func();
		}
		$html ="
			<tr>
				<td><label>".$this->label."</label></td>
				<td><span><input type='text' name='".$this->field['Field']."' id='".$this->field['Field']."' class='".($this->isRequire ? "required":"")."' value='".$this->value."'/></span></td>
			</tr>
			";
		
		return $html;
	}
	
	private function getTextAreaElement()
	{
		$html ="
			<tr>
				<td><label>".$this->label."</label></td>
				<td><span><textarea  name='".$this->field['Field']."' id='".$this->field['Field']."' class='".($this->isRequire ? "required":"")."' cols='50' rows='7'>$this->value</textarea></span></td>
			</tr>
			";
		
		return $html;
	}
	
	private function getDropDownList()
	{
		$option = "";
		
		foreach ($this->dData as $k=>$v)
		{
			$option .= "<option value='$k' ".(($this->value==$k) ? "selected" : "").">".$v."</option>";
		}
		$html ="
		<tr><td>$this->label</td><td><select name='".$this->field["Field"]."' id='".$this->field["Field"]."'>$option</select></td></tr>
		$option
		</select>
		";
		
		return $html;
	}
}

?>