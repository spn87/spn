<?php
class Spn_View
{	
	public function __construct()
	{
		
	}
	
	public function display($m,$c,$a)
	{
		require_once APP_PATH .'/app/'.$m.'/v/'.$c.'/'.$a.'.php';
	}
	
	public function url(array $url)
	{
		$urlStr = '';
		foreach ($url as $k=>$v)
		{
			$urlStr .= $k . '=' . $v . '&';
		}
		
		$urlStr = substr($urlStr,0,strlen($urlStr)-1);
		
		$urlStr = 'index.php?' . $urlStr;
		
		return $urlStr;
	}
	
	public static function getUrl($params = array())
	{
		$url = "";
		$m = "";
		$c = "";
		$a = "";
		
		foreach ($params as $k=>$v)
		{
			if ($k == "m") $m = $v;
			else
			if ($k == "c") $c = $v;
			else
			if ($k == "a") $a = $v;
			else 
			{
				$url .= "&$k=$v";
			}
		}
		if (isset($_GET['a']) && $_GET['a'] != "" && $a == "") $a = $_GET['a'];
		if (isset($_GET['c']) && $_GET['c'] != "" && $c == "") $c = $_GET['c'];
		if (isset($_GET['m']) && $_GET['m'] != "" && $m == "") $m = $_GET['m'];
		
		if ($a != "index" && $a != "")
			$url = "a=$a&".$url;
		if ($c != "index" && $c != "")
			$url = "c=$c&".$url;
		if ($m != "index" && $m != "")
			$url = "m=$m&".$url;  
		return "?".$url;
	}
}
?>
