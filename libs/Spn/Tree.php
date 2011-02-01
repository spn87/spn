<?php
/*
 * Author: An Souphorn
 * Email: ansouphorn@gmail.com
 * Blog: souphorn.blogspot.com
 * 
 * Created on Feb 1, 2011
 *
 */
 
class Spn_Tree
{
	private $_data = null;
	private $_key = null;
	private $_parent = null;
	
	private $_tmp = null;
	
	public function __construct(array $data, $key, $parent)
	{
		$this->_data = $data;
		$this->_key = $key;
		$this->_parent = $parent;
	}
	
	/**
	 * 
	 * Root
	 * --Sub1
	 * --Sub2
	 * ----Sub2.1
	 * @param mixed $id
	 * @param string $separator
	 * @param int $depth
	 * @return array
	 */
	public function getHierachyArray($id, $depth = -1)
	{
		//Reset array if it is the first loop
		if ($depth < 0)
		{
			$this->_tmp = array();
		}
		
		if ($this->hasChildren($id))
		{
			$depth++;
			$i = 0;
			$sub = $this->loadDataIn($id);
			foreach ($sub as $s)
			{
				$i++;
				$s['__depth'] = $depth;
				$this->_tmp[] = $s;
				$this->getHierachyArray($s[$this->_key],$depth);
				
			}
			
			if ($depth == 0 && $i == count($sub))
			{
				$tmp = $this->_tmp;
				$this->_tmp = null;
				
				return $tmp;
			}
		}
		
	}
	
	/**
	 * 
	 * Load data in a specific node
	 * @param mixed $id
	 * @return array
	 */
	public function loadDataIn($id)
	{
		$return = array();
		foreach ($this->_data as $item)
		{
			if ($item[$this->_parent] == $id)
			{
				$return[] = $item;
			}
		}
		return $return;
	}
	
	private function hasChildren($id)
	{
		return (count($this->loadDataIn($id)) >0) ?true:false;
	}
}

?>