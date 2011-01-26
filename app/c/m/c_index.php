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
	protected $_name = "contents";	
	public function baseUrlContent($url)
	{
		$query = "SELECT c.*,u.name AS creator FROM $this->_name AS c INNER JOIN ".Spn_User::$_table." AS u ON c.created_by=u.id WHERE url='".Spn_Db::e($url)."'";
		//echo $query;
		$rows = $this->_db->fetchAll($query);
		if (count($rows)>0)
			return $rows[0];
		return null;
	}
}
?>