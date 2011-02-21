<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010
 * @package: 
 * Blog: souphorn.blogspot.com
 * Date: Feb 7, 2011 7:19:14 PM
 * 
 */

//Authentication



$var = file_get_contents('php://input');

try
{
	$xml = @new SimpleXMLElement($var);
} catch(Exception $e)
{
	die("Invalid structure");
}
$contents = $xml->xpath("/content/add/content");

//Loop through each content
foreach ($contents as $c)
{
	echo $c->title;	
}
?>