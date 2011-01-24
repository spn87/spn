<?php
class Spn_Db
{
	const OBJ = 'obj';
	const ASSOC = 'assoc';
	public $db;
	function __construct()
	{
		$this->db = mysql_connect(HOST,USER,PASSWORD);
		mysql_select_db(DB);	
	}
	
	public function save(array $data)
	{
		
		$fields = array();
		$values = '';
		foreach ($data as $k=>$v)
		{
			$fields[] = '`'.$k.'`';
			if ($k == 'pwd')
			{
				$values[] = 'password("'.$v.'")';
			} else
			{
				$values[] = '"'.$v.'"';
			}
			
		}
		
		$table = TB_PREFIX.'users';
		
		$query = "insert into $table(".implode(",",$fields).") values(".implode(",",$values).")";
			
		$r = mysql_query($query);
		
		return $r;
	}
	
	public function fetchAll($query, $where ='', $type = self::OBJ)
	{
		$arr = array();
		$query = $query . '' . ((trim($where) != '')?" WHERE $where":"");		
		$rst = mysql_query($query);
		if ($type == self::OBJ)
		{
			while ($row = mysql_fetch_object($rst))
				$arr[] = $row;
		} else
		{
			while ($row = mysql_fetch_assoc($rst))
				$arr[] = $row;
		}
		
		return $arr;
	}
	
	public function fetchRow($table, $where ='', $type = self::OBJ)
	{
		$table = $table;
		
		$query = "SELECT * FROM $table";
		$arr = $this->fetchAll($query,$where, $type);
		
		if (count($arr) >0)
			return $arr[0];
		return array();
	}
	
	public function query($query)
	{
		if ($query == "") return;
		
		return mysql_query($query);
	}
	
	public function queryRows($query)
	{
		if ($query == "") return;
		$rst = mysql_query($query);
		
		//False in case result not found
		if (!$rst) return false;
		
		//Get the result and push to array
		$rows = array();
		while ($row = mysql_fetch_array($rst))
		{
			$rows[] = $row;
		}
		return $rows;
	}
	
	public function describe($table)
	{
		$table = $table;		
		$query = "describe $table";		
		$result = $this->queryRows($query);
		
		return $result;
	}
}
?>