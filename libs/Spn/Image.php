<?php
class Spn_Image
{
	public static function getRatio($maxSize, $width, $height)
	{
		//Testing with width
		$ratio = $maxSize /$width;
		if ($ratio * $height > $maxSize)
		{
			$ratio = $maxSize / $height;
		}

		return $ratio;
	}
	
	/**
	 * 
	 * Upload image 
	 * @param $file
	 * @param $dest
	 */
	public static function uploadImage($file, $baseDir, $fName, $maxSize = 0)
	{
		require_once 'Spn/File.php';
		$ex = Spn_File::getFileExt($file['name']);
		$name = Spn_File::getFileNameOnlye($fName);
		
		$fNameThumb  = $name."_thumb".$ex;
		
		move_uploaded_file($file['tmp_name'], $baseDir .'/'.$fName);
		$size = getimagesize($baseDir .'/'.$fName);
		
		$reducePercent =1 ;
		if ($maxSize != 0)
		{
			$reducePercent =  Spn_Image::getRatio(175, $size[0], $size[1]);
		}
		
		//$reducePercent = 0.5;
		$width = $size[0];
		$height = $size[1];
		
		$newImage = imagecreatetruecolor($width * $reducePercent, $height * $reducePercent);
		$source = self::createImage(($baseDir .'/'.$fName),$ex);
		
		imagecopyresized($newImage, $source, 0, 0, 0, 0,  $width*$reducePercent, $height * $reducePercent, $width, $height);
		
		self::outputImage($newImage,  $baseDir .'/'.$fNameThumb, $ex);
	}
	
	public static function createImage($img, $ext)
	{
		$source = null;
		switch ($ext)
		{
			case '.jpg':
			case '.jpeg':
				$source = imagecreatefromjpeg($img);
				break;
			case '.png':			
				$source = imagecreatefrompng($img);
				break;
			case '.gif':
				$source = imagecreatefromgif($img);
				break;
		}
		
		return $source;
	}
	
	public static function outputImage($img, $dest, $ext)
	{
		switch ($ext)
		{
			case '.jpg':
			case '.jpeg':
				imagejpeg($img,$dest);
				break;
			case '.png':			
				imagepng($img, $dest);
				break;
			case '.gif':
				imagegif($img,$dest);
				break;
		}
	}
	
	public static function uploadLimit($file,$baseDir,$max=0,$name="", $ext=array(".jpg",".jpeg",".png",".gif"), $width=0)
	{
		require_once 'Spn/File.php';
		$ex = strtolower(Spn_File::getFileExt($file['name']));
		$name = ($name == "") ? $file['name']: $name;
		if (in_array($ex, $ext))
		{
			move_uploaded_file($file['tmp_name'], $baseDir.'/'.$name);			
		}
	}
}

?>
