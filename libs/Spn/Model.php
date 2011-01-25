<?php
class Spn_Model
{
	protected $_db;
	private $_tmp;
	protected $_name;
	private $_data;
	
	function __construct()
	{
		global $db;
		
		$this->_name = TB_PREFIX.$this->_name;
		$this->_db = $db;
		
	}
	
	/**
	 * Select all from sepecif table
	 * @param string $where
	 * @return Record
	 */
	public function fetchAll($where = "", $type = Spn_Db::OBJ)
	{
		if ($this->_name == "") return array();
		$query = "SELECT * FROM ".$this->_name. (($where != "") ? " WHERE $where":"");
		
		$rst = $this->_db->fetchAll($query, '',$type);
		
		return $rst;
	}
	
	public function fetchRow($where, $type = Spn_Db::OBJ)
	{
		if ($this->_name == "") return array();
		$query = "SELECT * FROM ".$this->_name. (($where != "") ? " WHERE $where":"");
		
		$rst = $this->_db->fetchAll($query,'',$type);
		if (count($rst) > 0)
			return $rst[0];
		return null;
	}
	
	/**
	 * Delete record
	 * @param string $where
	 * @return boolean
	 */
	public function delete($where = "")
	{
		$query = "DELETE FROM ".$this->_name.(($where != "") ? " WHERE $where":"");
		
		return $this->_db->query($query);
	}
	
	/**
	 * Save the data to table
	 * @param $data is an key and value array
	 * @return boolean
	 */
	function bind($data)
	{
		$query = "describe $this->_name";		
		$rst = $this->_db->fetchAll($query);
		
		$newData = array();
		
		foreach ($data as $k=>$v)
		{
			if (is_array($v)) continue;
			foreach ($rst as $r)
			{
				if ($k == $r->Field and $r->Key != "PRI")
				{
					$newData[$k] = $v;
					break;
				}
			}	
		}		
		$this->_data = $newData;
	}
	
	/**
	 * 
	 * Add another field key value
	 */
	function addBindData(array $data)
	{
		foreach ($data as $k=>$v)
		{
			$this->_data[$k] = $v;
		}
	}
	
	/**
	 * Save new record
	 * @return boolean
	 */
	function addBind()
	{	
		$query = "INSERT INTO $this->_name(".$this->_getField().") values(".$this->_getValue().")";
		
		return $this->_db->query($query);
	}
	
	/**
	 * Get the field string from binded data
	 * @return string
	 */
	private function _getField()
	{
		$keys = array();		
		if (!is_array($this->_data)) return;
		foreach ($this->_data as $k=>$v)
		{
			$keys[] = "`".$k."`";
		}		
		return implode(",",$keys);
	}
	
	/**
	 * Get the value of binded value
	 * @return string
	 */
	private function _getValue()
	{
		$val = array();
		if (!is_array($this->_data)) return;
		foreach ($this->_data as $k=>$v)
		{
			$val[] = "'".$v."'";
		}
		
		return implode(",",$val);
	}
	
	/**
	 * Update the data by using bind method
	 * @return boolean
	 */
	function updateBind($where = "")
	{
		$query = "UPDATE ".$this->_name." SET ".$this->_toUpdateData();
		
		if ($where != "")
		{
			$query .= " WHERE ".$where;
		}		
		return $this->_db->query($query);
	}
	
	private function _toUpdateData()
	{
		$newData = array();
		
		foreach ($this->_data as $k=>$v)
		{
			$newData[] = "`".$k."`='".$v."'"; 
		}
		
		return implode(",",$newData);
	}
}
?>