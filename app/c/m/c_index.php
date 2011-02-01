<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010
 * @package: 
 * Blog: souphorn.blogspot.com
 * Date: Jan 25, 2011 9:12:49 AM
 * 
 */

class CIndex_Model extends Spn_Model
{
	public $limitStart = 0;
	public $limitEnd = 5;
	protected $_name = "contents";	
	public function baseUrlContent($url)
	{
		$query = "SELECT c.*,u.name AS creator FROM $this->_name AS c INNER JOIN ".Spn_User::$_table." AS u ON c.created_by=u.id WHERE url='".Spn_Db::e($url)."' LIMIT 0,1";
		//echo $query;
		$rows = $this->_db->fetchAll($query);
		if (count($rows)>0)
			return $rows[0];
		return null;
	}
	
	public function getContents($num=0)
	{
		$start = $this->limitStart;
		$end = ($num ==0) ? $this->limitEnd:$num;
		$query = "SELECT c.*,u.name AS creator FROM $this->_name AS c INNER JOIN ".Spn_User::$_table." AS u ON c.created_by=u.id LIMIT $start,$end";
		
		$rows = $this->_db->fetchAll($query,"",Spn_Db::ASSOC);
		if (count($rows)>0)
			return $rows;
		return array();
	}
}
?>