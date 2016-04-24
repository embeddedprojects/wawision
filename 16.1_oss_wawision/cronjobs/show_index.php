<?php
/*
**** COPYRIGHT & LICENSE NOTICE *** DO NOT REMOVE ****
* 
* WaWision (c) embedded projects GmbH, Holzbachstrasse 4, D-86154 Augsburg, * Germany 2015 
*
* This file is licensed under the Embedded Projects General Public License *Version 3.1. 
*
* You should have received a copy of this license from your vendor and/or *along with this file; If not, please visit www.wawision.de/Lizenzhinweis 
* to obtain the text of the corresponding license version.  
*
**** END OF COPYRIGHT & LICENSE NOTICE *** DO NOT REMOVE ****
*/
?>
<?php

// Nur einfache Fehler melden
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once("../conf/main.conf.php");
include_once("../phpwf/plugins/class.mysql.php");
include_once("../www/lib/class.erpapi.php");

class app_t {
  var $DB;
  var $user;
}

$app = new app_t();

$DEBUG = 0;


$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
$erp = new erpAPI($app);


$tables = $app->DB->SelectArr("SHOW TABLES");

foreach($tables as $key=>$rows)
{
	$tabelle =  $rows['Tables_in_wawision'];
  $tmp = $app->DB->SelectArr("SHOW INDEX FROM `".$tabelle."`");
  for($i=0;$i<count($tmp);$i++)
  {
		if($tmp[$i]['Key_name']!="PRIMARY")
		{
			$check = $tmp[$i]['Key_name'];
			if ( preg_match('/^[a-z_]{3,20}$/i', $check) ) 
			{
      	$vorlage[$tabelle][]=$tmp[$i]['Key_name'];
			}
  	}
  }
}   

foreach($vorlage as $key=>$row)
{

	$func = function($value) { return "'".$value."'"; };

	$row = array_map($func, $row);
	
	$tmp = rtrim(implode(",",$row),",");

	echo '$vorlage[\''.$key.'\'] = array('.$tmp.");\r\n";


}


?>
