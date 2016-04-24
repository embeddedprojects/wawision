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

include(dirname(__FILE__)."/../conf/main.conf.php");
include(dirname(__FILE__)."/../phpwf/plugins/class.db.php");
include(dirname(__FILE__)."/../www/lib/imap.inc.php");
include(dirname(__FILE__)."/../www/lib/class.erpapi.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.phpmailer.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.smtp.php");


class app_t {
  var $DB;
  var $user;
  var $erp;
}


$app = new app_t();

$DEBUG = 0;


$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
//$erp = new erpAPI($app);
$app->erp = new erpAPI($app);

//lager zahlen neu berechnen
$app->DB->Update("UPDATE artikel a SET a.cache_lagerplatzinhaltmenge=(SELECT SUM(lp.menge) FROM lager_platz_inhalt lp WHERE lp.artikel=a.id) WHERE a.lagerartikel=1 AND a.geloescht=0");



$auftraege = $app->DB->SelectArr("SELECT id FROM auftrag WHERE status='freigegeben' AND inbearbeitung=0 ORDER By datum");


echo "Berechne ".count($auftraege)." Auftraege\r\n";

for($i=0;$i<count($auftraege);$i++)
{

  echo "Auftrag ".$auftraege[$i][id]."\r\n";
  $app->erp->AuftragNeuberechnen($auftraege[$i][id]);
  $app->erp->AuftragEinzelnBerechnen($auftraege[$i][id]);
}








?>
