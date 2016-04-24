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
<?

include("../conf/main.conf.php");
include("../phpwf/plugins/class.db.php");

$conf = new Config();

$db = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);


$arr = $db->SelectArr("SELECT * FROM artikel WHERE nummer LIKE '5%'");


$start = "500000";
foreach($arr as $key=>$value)
{
  $db->UpdateWithoutLog("UPDATE artikel SET nummer='$start' WHERE id='{$value[id]}' LIMIT 1");
  $start++;
}

echo "ready!\r\n";

?>
