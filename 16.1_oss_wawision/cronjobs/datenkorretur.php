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

include_once("/home/eproo/eproo-master/app/main/conf/main.conf.php");
include_once("/home/eproo/eproo-master/app/main/phpwf/plugins/class.db.php");
include_once("/home/eproo/eproo-master/app/main/www/lib/class.erpapi.php");



class app_t {
  var $DB;
  var $user;
}

$app = new app_t();

$DEBUG = 0;


$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
$erp = new erpAPI($app);


$data = $app->DB->SelectArr("SELECT kontoauszuege, id, betrag, DATE_FORMAT(datum,'%Y-%m') as datum FROM `kontoauszuege_zahlungseingang` ke WHERE ke.datum < '2010-10-12' AND ke.objekt='rechnung'");

for($i=0;$i<count($data);$i++)
{
$haben = $data[$i]['betrag'];
$datum = $data[$i]['datum'];


$kontoauszug_count = $app->DB->Select("SELECT COUNT(id) FROM kontoauszuege WHERE haben='$haben' AND DATE_FORMAT(buchung,'%Y-%m')='$datum' AND konto='{$data[$i]['kontoauszuege']}'");
$kontoauszug = $app->DB->Select("SELECT id FROM kontoauszuege WHERE haben='$haben' AND DATE_FORMAT(buchung,'%Y-%m')='$datum' AND konto='{$data[$i]['kontoauszuege']}'");

if($kontoauszug_count!=1)
{
  $kontoauszug="FEHLT!";
  $fehlt++;
} else {
  //$app->DB->Update("UPDATE kontoauszuege_zahlungseingang SET kontoauszuege='$kontoauszug' WHERE id='{$data[$i]['id']}' LIMIT 1");
  echo("UPDATE kontoauszuege_zahlungseingang SET kontoauszuege='$kontoauszug' WHERE id='{$data[$i]['id']}' LIMIT 1");
}

//echo $i." ".$datum." $haben $kontoauszug\n\r";
$gesamt++;

}

echo "fehlt: $fehlt gesamt: $gesamt";

?>
