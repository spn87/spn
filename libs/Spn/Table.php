<?php
/**
 *
 *@author An Souphorn <ansouphorn@gmail.com>
 *@blog souphorn.blogspot.com
 *copyright All right reserved
 */
 
class Spn_Table
{
	const TABLE = "table";
	const HEADER = "header";
	const TD = "td";
	
	private $fields = array();
	private $actions = array();
	private $actionName = "Operation(s)";
	
	private $tableAttr = "";
	private $headerAttr = "";
	private $tdAttr = "";
	
	private $deleteHref = "?a=delete&amp;id={id}";
	
	private $wrapField = array();
	
	private $data = array();
	
	/**
	 * 
	 * Generate table output base one array data and field
	 * @param array $data <p>The data provided must be an array of array. Ex: array(array("field_name"=>"value"))</p>
	 * @param unknown_type $fields
	 * @param unknown_type $actions
	 */
	public function __construct(array $data, $fields = array(), $actions = array())
	{
		$this->fields = $fields;
		$this->actions = $actions;
		$this->data = $data;
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function setWrapper(array $wrapField)
	{
		$this->wrapField = $wrapField;
	}
	
	/**
	 * Get the table
	 * @return string
	 */
	public function getTable()
	{
		$html = $this->getHeader();
		$html .= $this->getContent();
		$html .= $this->getFooter();
		
		return $html;
	}
	
	/**
	 * 
	 * Set the attribute of table. Ex: class name of table
	 * @param array $attr
	 * @return void
	 */
	public function setTableAttr(array $attr, $type = self::TABLE)
	{
		$tmpStr = "";
		foreach ($attr as $key=>$value)
		{
			$tmpStr .= " $key='$value'";
		}
		switch ($type)
		{
			case self::TABLE:
				$this->tableAttr = $tmpStr;
				break;
			case self::HEADER:
				$this->headerAttr= $tmpStr;
				break;
			case self::TD:
				$this->tdAttr = $tmpStr;
				break;
		}
	}
	
	/**
	 * 
	 * Display the content of the table
	 * @return string
	 */
	private function getContent()
	{
		$html = "";
		for ($i = 0; $i < count($this->data);$i++)
		{
			$d = $this->data[$i];			
			$html .= "<tr>";
			$html .= "<td ".$this->tdAttr.">".($i+1)."</td>";
			foreach ($this->fields as $field)
			{
				foreach ($field as $f=>$t)
				{
					if ($t == "params") continue;
					$value = $d[$f];
					foreach ($this->wrapField as $key=>$w)
					{
						if ($key == $f)
						{
							$value = str_replace("{this}", $value, $w);
							break;
						}
					}
					$value = $this->replaceWrap($d, $value);
					
					$html .="<td ".$this->tdAttr.">".$value."</td>";
				}
			}
			
			if ($this->deleteHref != "")
			{
				$link = Spn_View::getUrl(array("a"=>"delete","id"=>$d['id']));
				$html .= "<td class='action'><a href='$link'>Delete</a></td>";
			}
			$html .= "</tr>";			
		}
		
		return $html;
	}
	
	/**
	 * 
	 * Display the header of table
	 * @return string
	 */
	private function getHeader()
	{
		$html = "<table ".$this->tableAttr."><tr><th ".$this->headerAttr.">No</th>";
		foreach ($this->fields as $field)
		{
			
			foreach ($field as $f=>$t)
			{
				if ($f != "params")
					$html .= "<th ".$this->headerAttr.">".$t."</th>";
			}
		}
		if ($this->deleteHref != "")
			$html .="<th>Action(s)</th>";
		$html .= "</tr>";
		return $html;
	}
	
	/**
	 * 
	 * Display the footer of table
	 * @return string
	 */
	private function getFooter()
	{
		$html = "</table>";
		
		return $html;
	}
	
	/**
	 * 
	 * Replace the {string} with value
	 * @param array $data
	 * @param string $wrapString
	 */
	private function replaceWrap($data, $wrapString)
	{
		$start = strpos($wrapString, "{");
		$end = strpos($wrapString, "}"); 
		if ($start)
		{
			$toReplace = substr($wrapString, $start+1,$end - ($start+1));
			$wrapString = str_replace("{".$toReplace."}", $data[$toReplace], $wrapString);
			$start = strpos($wrapString, "{");
			if ($start)
				$this->replaceWrap($data, $wrapString);
			else
				return $wrapString;
			
		}
		
		return $wrapString;
		
	}
}

?>