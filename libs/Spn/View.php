<?php
class Spn_View
{	
	public $__title = "";
	public function __construct()
	{
		
	}
	
	public function display($m,$c,$a,$formAdmin=false)
	{
		
		if (!$formAdmin)
		{
			require_once APP_PATH .'/'.$m.'/v/'.$c.'/'.$a.'.php';
		}
		else 
		{
			require_once ADMIN_APP_PATH .'/'.$m.'/v/'.$c.'/'.$a.'.php';
		}
	}
	
	public function url(array $url = array())
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
		
		$tmpParam = array();
		
		foreach ($params as $k=>$v)
		{
			if ($k == "m") $m = $v;
			else
			if ($k == "c") $c = $v;
			else
			if ($k == "a") $a = $v;
			else 
			{
				$tmpParam[] = "$k=$v";
			}
		}
		if (isset($_GET['a']) && $_GET['a'] != "" && $a == "") $a = $_GET['a'];
		if (isset($_GET['c']) && $_GET['c'] != "" && $c == "") $c = $_GET['c'];
		if (isset($_GET['m']) && $_GET['m'] != "" && $m == "") $m = $_GET['m'];
		
		$url = implode("&", $tmpParam);
		if ($a != "index" && $a != "")
			$url = "a=$a".($url!="" ? "&$url":"");
		if ($c != "index" && $c != "")
			$url = "c=$c".($url!="" ? "&$url":"");
		if ($m != "index" && $m != "")
			$url = "m=$m".($url!="" ? "&$url":"");
		  
		return "?".$url;
	}
}
?>
