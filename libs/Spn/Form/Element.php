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
		
	private $field;
	private $label;
	private $value = "";
	private $isRequire = false;
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
			foreach ($params as $p)
			{
				if ($p == self::REQUIRE_FIELD)
					$this->isRequire = true;
			}
		}
	}
	
	public function getElement()
	{
		$html ="
			<div>
				<label>".$this->label."</label>
				<span><input type='text' name='".$this->field['Field']."' id='".$this->field['Field']."' class='".($this->isRequire ? "required":"")."' value='".$this->value."'/></span>
			</div>
			";
		
		return $html;
	}
}

?>