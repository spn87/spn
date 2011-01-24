<?php

class Spn_File
{
	//Maximum size of file to upload
	const max_file_size = 2048;
	
	function __construct()
	{
		
	}
	
	/**
	 * Get file names base one type extension
	 * @param unknown_type $path
	 * @param array $types
	 * @return unknown_type
	 */
	public static function listFile($path, array $types)
	{
		$files = array();
		
		$dir = opendir($path);
		
		while (false !== ($f=readdir($dir)))
		{
			if (is_file("$path/$f") and self::getFilesOnlyIn($f,$types))
			{
				$files[] = $f;				
			}
		}
		closedir($dir);
		
		return $files;
	}
	
	/**
	 * Get the extension of a given file name
	 * 
	 * @param string $file
	 * @return string
	 */
	public static function getFileExt($file)
	{
		$part = explode(".",$file);
		
		if (count($part) <=1) return '';
		
		return '.'.$part[count($part)-1];
		
	}
	
	/**
	 * Return boolean status whether the given file name and the array of extension is valid or not
	 * @param string $file
	 * @param array $ext
	 * @return Boolean
	 */
	public static function getFilesOnlyIn($file, array $ext)
	{
		$fileExt = self::getFileExt($file);
		
		if (in_array($fileExt,$ext)) return true;
		return false;
	}
	
	/**
	 * 
	 * Upload file
	 * @param string $file
	 * @param string $path
	 * @param string $ext
	 * @param string $fileSize
	 */
	public static function updateFile($file, $path, $ext, $fileSize = 0)
	{
		if (move_uploaded_file($file['tmp_name'], $path . '/'.$file['name']))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * 
	 * Delete file
	 * @param string $file
	 */
	public static function deleteFile($file)
	{
		if ($file == "") return;
		if (file_exists($file))		
			unlink($file);
	}
	
	/**
	 * 
	 * Get the file name only
	 * @param string $file
	 * @return string
	 */
	public static function getFileNameOnlye($file)
	{
		$n = explode(".",$file);
		if (count($n) < 1) return false;
		
		$tmpArr = array();
		for ($i = 0; $i < count($n)-1; $i++)
		{
			$tmpArr[] = $n[$i]; 
		}
		
		return implode(".",$tmpArr);
	}
}

?>