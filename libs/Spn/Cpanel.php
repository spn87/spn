<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010, Maxaware
 * @package: Domain
 * Blog: souphorn.blogspot.com
 */
 require_once 'Domain/Plesk.php';
 class Spn_Cpanel
 {
 	const PLESK = 1;
 	const CONTENT_TYPE_XML = 'text/xml';
 	private $panel;
 	private $header = array();
 	private $url;
 	private $postField; 
 	private $currentId = 0;	
 	
 	function __construct($url, $username, $password, $contentType = self::CONTENT_TYPE_XML)
 	{
 		$this->url = $url;
 		$this->header = array("HTTP_AUTH_LOGIN: $username", 
 							  "HTTP_AUTH_PASSWD: $password",
 							  "Content-type: $contentType");
 		$this->panel = self::PLESK;
 		$this->postField = new Spn_Domain_Plesk();
 	}
 	
 	/**
 	 * 
 	 * Set the panel
 	 * @param string $type
 	 * @return void
 	 */
 	public function setPanel($type = self::PLESK)
 	{
 		
 		$this->panel = $type;
 		switch ($type)
 		{
 			case self::PLESK:
 				$this->postField = new Spn_Domain_Plesk();
 				break;
 		}
 	}
 	
 	/**
 	 * 
 	 * Execute the curl request to server
 	 * @return 
 	 */
 	private function exec()
 	{
 		$args = func_get_args();
 		$funName = $args[0];
 		
 		//Remove the first element
 		array_shift($args);

 		//Get the postfield
 		$postField = call_user_func_array(array($this->postField,$funName), $args);
 		 	
 		//Init curl
 		$curl = $this->initProcess();
 		
 		//Post the postfield
 		curl_setopt($curl, CURLOPT_POSTFIELDS, $postField);
 		
 		//Execute
 		$info = curl_exec($curl);
 		
 		//Get the result
 		$isSucess = $this->postField->isSuccess($info);
 		$this->currentId = $this->postField->getCurrentId($info);
 		
 		//Close connection
 		$this->closeProcess($curl);
 		
 		return $isSucess;
 	}
 	
 	public function subdomainExist($domain)
 	{
 		$postField = $this->postField->subdomainInfo($domain);
 		$curl = $this->initProcess();
 		
 		//Post the postfield
 		curl_setopt($curl, CURLOPT_POSTFIELDS, $postField);
 		
 		//Execute
 		$info = curl_exec($curl);
 		
 		$exist = $this->postField->domainExist($info);
 		//Close connection
 		$this->closeProcess($curl);
 		
 		return $exist;
 	}
 	/**
 	 * 
 	 * Create datanases
 	 * @param string $dbName
 	 * @param int $domainId
 	 * @return boolean
 	 */
 	public function createDatabase($dbName, $domainId = 0)
 	{
 		return $this->exec("createDatabase",$dbName,$domainId); 		
 	}
 	
 	/**
 	 * 
 	 * Create sub domain
 	 * @return boolean
 	 */
 	function createSubDomain($parent, $name, $property = array())
 	{	
 		return $this->exec('createSubdomainPostField',$parent, $name, array("php"=>"true"));
 	}
 	
 	/**
 	 * 
 	 * Create database user
 	 * @param mixed $dbId
 	 * @param string $name
 	 * @param string $password
 	 */
 	public function createDbUser($dbId, $name, $password)
 	{
 		return $this->exec('createDbUser', $dbId,$name,$password);
 	}
 	/**
 	 * 
 	 * Initiate everything necessary for processing request
 	 * @return curl object
 	 */
 	private function initProcess()
 	{
 		//Initiate obj
 		$curl = curl_init();
 		
 		//Set options
 		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
 		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
 		curl_setopt($curl, CURLOPT_HTTPHEADER, $this->header);
 		curl_setopt($curl,CURLOPT_URL,$this->url);
 		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 		
 		return $curl;
 	}
 	
 	/**
 	 * 
 	 * Close the connection of the request
 	 * @param curl $initObj
 	 */
 	private function closeProcess($initObj)
 	{
 		curl_close($initObj);
 		ini_set('display_errors', 1);
 	}
 	
 	/**
 	 * 
 	 * Get current id of created operation
 	 * @return int
 	 */
 	public function getCurrentId()
 	{
 		return $this->currentId;
 	}
 }
 ?>