<?php
function GetGewicht()
{
include("IXR_Library.inc.php");


$client = new IXR_Client('http://192.168.0.95/server.php');
if (!$client->query('waage')) {
   die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
   }
   return $client->getResponse();
}

?>
