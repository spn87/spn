<?php
/**
 * 
 * @author: An Souphorn <ansouphorn@gmail.com>
 * @copyright: Copyright 2010, Maxaware
 * @package: 
 * Blog: souphorn.blogspot.com
 */
 
 interface Cpanel 
 {
 	function createSubdomainPostField($parent, $name, $property = array());
 	function isSuccess($reponse);
 	function createDatabase($dbName, $domainId = 0);
 	function createDbUser($dbId, $userName, $password);
 	function getCurrentId($response);
 	function subdomainInfo($domain);
 }
 ?>