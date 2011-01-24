<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010
 * @package: 
 * Blog: souphorn.blogspot.com
 */
 
 if (!session_id())
 	session_start();
 
 class Spn_Captcha
 {
 	public function getCaptcha()
	{
	$width=158;
	$height=45;


	// ##### SET UP IMAGE AND COLORS
	$image=imagecreatetruecolor($width,$height);
	imagesetthickness($image,1);
	imagealphablending($image,true);
	$color_black=imagecolorallocatealpha($image,0,0,0,0);
	$color_black_semi=imagecolorallocatealpha($image,0,0,0,115);
	$color_white=imagecolorallocatealpha($image,255,255,255,0);
	imagefill($image,0,0,$color_white);
	imagecolortransparent($image);


	// ##### BUILD RANDOM PASSWORD
	$acceptedCharsV="AEIOUY";
	$acceptedCharsC="BCDFGHJKLMNPQRSTVWXZ";
	$wordbuild=array(
	"cvcc","ccvc","ccvcc","cvccc", // monosyllabic nominal stems
	"cvcvc","cvcv","cvccv","ccvcv" // disyllabic nominal stems
	);
	$thisword=$wordbuild[mt_rand(0,sizeof($wordbuild)-1)];
	$stringlength=strlen($thisword);
	$password = '';
	for($i=0;$i<$stringlength;$i++) {
		if ($thisword[$i]=="c") {$password.=$acceptedCharsC{mt_rand(0,strlen($acceptedCharsC)-1)};}
		if ($thisword[$i]=="v") {$password.=$acceptedCharsV{mt_rand(0,strlen($acceptedCharsV)-1)};}
	}


	// ##### DRAW RANDOM LETTERS
	for($i=0;$i<50;$i++) 
	{
		$color=imagecolorallocatealpha($image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255),110);
		imagestring($image,mt_rand(1,3),mt_rand(-$width*0.25,$width*1.1),mt_rand(-$height*0.25,$height*1.1),
		$acceptedCharsC{mt_rand(0,strlen($acceptedCharsC)-1)},$color);
		imagestring($image,mt_rand(1,3),mt_rand(-$width*0.25,$width*1.1),mt_rand(-$height*0.25,$height*1.1),
		$acceptedCharsV{mt_rand(0,strlen($acceptedCharsV)-1)},$color);
		
	}


	// ##### DRAW PASSWORD
	for($i=0;$i<$stringlength;$i++) 
	{
		$buffer=imagecreatetruecolor(40,40);
		imagefill($buffer,0,0,$color_white);
		imagecolortransparent($buffer,$color_white);
	
		$buffer2=imagecreatetruecolor(40,40);
		imagefill($buffer2,0,0,$color_white);
		imagecolortransparent($buffer2,$color_white);
	
		$red=0;$green=0;$blue=0;
		while ($red+$green+$blue<400||$red+$green+$blue>450) 
		{
			$red = mt_rand(0,255);
			$green = mt_rand(0,255);
			$blue = mt_rand(0,255);
		}

	$color=imagecolorallocate($buffer,$red,$green,$blue);
	imagestring($buffer,2,0,0,substr($password,$i,1),$color);

	imagecopyresized($buffer2,$buffer,2,-5,0,0,mt_rand(30,40),mt_rand(30,40),10,14);
	$buffer=imagerotate($buffer2,mt_rand(-25,25),$color_white);

	$xpos=$i/$stringlength*($width-30)+(($width-30)/$stringlength/2)+5+mt_rand(-8,8);
	$ypos=(($height-50)/2)+5+mt_rand(-8,8);

	imagecolortransparent($buffer,$color_white);

	imagecopymerge($image,$buffer,$xpos,$ypos,0,0,imagesx($buffer),imagesy($buffer),100);
	imagedestroy($buffer);
	imagedestroy($buffer2);
	}


	// ##### DRAW ELLIPSES
	for($i=0;$i<12;$i++) {
		$color=imagecolorallocatealpha($image,mt_rand(0,158),mt_rand(0,158),mt_rand(0,158),110);
		imagefilledellipse($image,mt_rand(0,$width),mt_rand(0,$height),mt_rand(10,40),mt_rand(10,40),$color);
	}


	// ##### DRAW LINES
	for($i=0;$i<12;$i++) 
	{
		$color=imagecolorallocatealpha($image,mt_rand(0,200),mt_rand(0,200),mt_rand(0,200),110);
		imagesetthickness($image,mt_rand(8,20));
		imageline($image,mt_rand(-$width*0.25,$width*1.25),mt_rand(-$height*0.25,$height*1.25),
		mt_rand(-$width*0.25,$width*1.25),mt_rand(-$height*0.25,$height*1.25), $color);  
		imagesetthickness($image,1);
	}
	


	// ##### GRADIENT BACKGROUND HORIZONTALLY
	$red_from=mt_rand(0,255);	$red_to=mt_rand(0,255);
	$green_from=mt_rand(0,255);	$green_to=mt_rand(0,255);
	$blue_from=mt_rand(0,255);	$blue_to=mt_rand(0,255);

	for ($i=0;$i<$height;$i++) {
	$color=imagecolorallocatealpha($image,$red_from+($red_to-$red_from)/$height*$i,$green_from+($green_to-$green_from)/$height*$i,$blue_from+($blue_to-$blue_from)/$height*$i,100);
	//imageline($image,0,$i,$width,$i,$color);
	}
	
	// ##### GRADIENT BACKGROUND VERTICALLY
	$red_from=mt_rand(0,255);	$red_to=mt_rand(0,255);
	$green_from=mt_rand(0,255);	$green_to=mt_rand(0,255);
	$blue_from=mt_rand(0,255);	$blue_to=mt_rand(0,255);

	for ($i=0;$i<$width;$i++) {
	$color=imagecolorallocatealpha($image,$red_from+($red_to-$red_from)/$width*$i,$green_from+($green_to-$green_from)/$width*$i,$blue_from+($blue_to-$blue_from)/$width*$i,100);
	//imageline($image,$i,0,$i,$height,$color);
	}
	// ##### STORE PASSWORD	
	$_SESSION['spn_captcha'] = substr(md5($password),4,6);	
	
	// ##### OUTPUT
	header('Content-Type: image/png');
	imagepng($image);
	imagedestroy($image);
		
	}
	
	public function isValid($input)
	{
		if ($_SESSION['spn_captcha'] == substr(md5($input),4,6))
			return true;
		return false;
	}
 }
 ?>