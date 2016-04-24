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
include("../../phpwf/plugins/class.db.php");
include("../lib/imap.inc.php");
include("../lib/class.remote.php");
include("../lib/class.aes.php");
include("../lib/class.httpclient.php");


class app_t {
  var $DB;
  var $user;
}

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$app = new app_t();
$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);


$remote= new Remote($app);


$artikel = $app->DB->SelectArr("SELECT id FROM artikel WHERE shopartikel='1' AND projekt='1'");

$id = "1"; //EPROO-SHOP

$time_start = microtime_float();

for($i=0;$i<count($artikel);$i++)
{
  echo "Article ".$artikel[$i][id]."\r\n";
  $remote->RemoteAddFileSubject($id,$artikel[$i][id]);
}
echo "finish...\r\n";
$time_end = microtime_float();
$time = $time_end - $time_start;

echo "duration: $time seconds\n";

?>
