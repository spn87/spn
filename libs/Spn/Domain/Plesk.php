<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010, Maxaware
 * @package: 
 * Blog: souphorn.blogspot.com
 */
 require_once 'Cpanel.php';
 class Spn_Domain_Plesk implements Cpanel
 {
 	public function createSubdomainPostField($parent, $name, $property = array())
 	{
 		$postField = '<parent>'.$parent.'</parent>';
 		$postField .= '<name>'.$name.'</name>';
 		$postField .= '<home>/subdomains/'.$name.'</home>';
 		
 		$propertyStr = '';
 		if (count($property) > 0)
 		{
 			$propertyStr = '<property>';
 			foreach ($property as $name=>$value)
 			{
 				$propertyStr .= '<name>'.$name.'</name>';
 				$propertyStr .= '<value>'.$value.'</value>';
 			}
 			$propertyStr .= '</property>';
 		}
 		
 		$postField .= $propertyStr;
 		$postField = <<<EOP
<packet version="1.5.2.0">
	<subdomain>
		<add>
		   $postField
		</add>
	</subdomain>
</packet>
EOP;

		return $postField;
 	}
 	
 	/**
 	 * Check the response of the plesk panel whether the request is success or not
 	 * @see libs/Spn/Domain/Domain::isSuccess()
 	 * @return boolean
 	 */
 	public function isSuccess($response)
 	{
 		$xml = simplexml_load_string($response);
 		
 		$parent = null;
 		$child = null;
 		foreach ($xml->children() as $c)
 		{
 			$parent = $c;
 			break;
 		}
 		
 		foreach ($parent->children() as $c)
 		{
 			$child = $c;
 			break;
 		}
 		
 		$parentAction = $parent->getName();
 		$childAction = $child->getName(); 		
 		$status = (array) $xml->$parentAction->$childAction->result->status; 		
 		if (count($status) >0) 
 		{
 			if ($status[0] == 'error') return false;
 		}
 			
 		return true;
 	}
 	
 	public function getCurrentId($response)
 	{
 		$xml = simplexml_load_string($response);
 		
 		$parent = null;
 		$child = null;
 		foreach ($xml->children() as $c)
 		{
 			$parent = $c;
 			break;
 		}
 		
 		foreach ($parent->children() as $c)
 		{
 			$child = $c;
 			break;
 		}
 		
 		$parentAction = $parent->getName();
 		$childAction = $child->getName(); 		
 		$status = (array) $xml->$parentAction->$childAction->result->id; 		
 		if (count($status) >0) 
 		{
 			return $status[0];
 		}
 			
 		return 0;
 	}
 	
 	public function createDatabase($dbName, $domainId = 0)
 	{
 		$postField =<<<EOF
<packet version="1.4.2.0">
	<database>
	<add-db>
	   <domain-id>$domainId</domain-id>
	   <name>$dbName</name>
	   <type>mysql</type>
	</add-db>
	</database>
</packet>
EOF;

 		return $postField;
 	}
 	
 	public function createDbUser($dbId, $userName, $password)
 	{
 		$postField =<<<EOF
<packet version="1.4.2.0">
	<database>
	   <add-db-user>
	      <db-id>$dbId</db-id>
	      <login>$userName</login>
	      <password>$password</password>
	   </add-db-user>
	</database>
</packet>
EOF;

 		return $postField;
 	}
 	
 	public function subdomainInfo($domain)
 	{
 		$postField =<<<EOF
<packet version="1.5.2.0">
	<subdomain>
	<get>
	   <filter>
	      <name>$domain</name>
	   </filter>
	</get>
	</subdomain>
</packet>
EOF;

 		return $postField;
 	}
 	
 	/**
 	 * 
 	 * Check if the domain exist or not
 	 * @param mixed $response
 	 * @return boolean
 	 */
 	public function domainExist($response)
 	{
 		$xml = (array)simplexml_load_string($response)->children();
 		
 		//Remove the @attributes which the first element
 		
 		foreach ($xml as $k=>$o) 
 		{
 			if (preg_match('/^[@]/',$k)) continue;
 			$el=(array)$o;break;
 		}
 		foreach ($el as $o) {$el=(array)$o;break;}
 		
 		$el = (array)$el['result'];
 		
 		if (isset($el['errcode']) && $el['errcode'] == 1013)
 		{
 			return false;
 		}
 		
 		return true;
 	}
 }
 ?>