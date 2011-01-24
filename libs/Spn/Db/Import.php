<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010, Maxaware
 * @package: 
 * Blog: souphorn.blogspot.com
 */
 
 class Spn_Db_Import
 {
 	private $db = null;
 	
 	public function import($file, $db =null)
 	{
 		$this->db = $db;
 		if ($this->db == null) die ("No db");
 		
 		//Read from .sql file
 		$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
 		
		$buffer = '';
		foreach ($lines as $line)
		{
			if (($line = trim($line)) == '')
				continue;
			
			// skipping SQL comments
			if (substr(ltrim($line), 0, 2) == '--')
		 		continue;
		 	
			if (substr($line, -1) != ';') 
			{
		 		// Add to buffer
				$buffer .= $line;		 		
		 		continue;
		 	} else
		 		if ($buffer) 
		 		{
		 			$line = $buffer . $line;
		 			// Ok, reset the buffer
		 			$buffer = '';
		 		}
		 		
		 	//Execute query
		 	mysql_query($line);
		 }
 	}
 }
 ?>