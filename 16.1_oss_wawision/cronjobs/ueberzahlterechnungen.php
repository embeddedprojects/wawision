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

include(dirname(__FILE__)."/../conf/main.conf.php");
include(dirname(__FILE__)."/../phpwf/plugins/class.mysql.php");
include(dirname(__FILE__)."/../www/lib/imap.inc.php");
include(dirname(__FILE__)."/../www/lib/class.erpapi.php");
include(dirname(__FILE__)."/../www/lib/class.erpapi_custom.php");
include(dirname(__FILE__)."/../www/lib/class.remote.php");
include(dirname(__FILE__)."/../www/lib/class.httpclient.php");
include(dirname(__FILE__)."/../www/lib/class.aes.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.phpmailer.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.smtp.php");
include_once(dirname(__FILE__)."/../phpwf/plugins/class.secure.php");
include_once(dirname(__FILE__)."/../phpwf/plugins/class.user.php");

/*
class app_t {
  var $DB;
  var $erp;
  var $user;
  var $remote;
}

//ENDE

$app = new app_t();

$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
$erp = new erpAPICustom($app);
$app->erp = $erp;*/


class app_t {
  var $DB;
  var $User;
  var $erp;
}

if(!isset($app)){
	$app = new app_t();
	$conf = new Config();
  $app->User = new User($app);
	$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
	$erp = new erpAPI($app);
	$app->erp = $erp;
	$remote = new Remote($app);
}

//$app->DB->Update("UPDATE artikel SET cache_lagerplatzinhaltmenge='0'");

//$query = $app->DB->Query("UPDATE kontoauszuege set diffangelegt = null");
//$query = $app->DB->Query("UPDATE kontoauszuege_zahlungseingang set parameter2 = null");
$query = $app->DB->Query("SELECT * from kontoauszuege where (isnull(diffangelegt) or datediff(now(), diffangelegt) >= 1) and haben > 0");
while($row = $app->DB->Fetch_Array($query))
{
  $diff = 0;
  $eingaenge = $app->DB->SelectArr("SELECT * from kontoauszuege_zahlungseingang where kontoauszuege = ".$row['id']);
  if($eingaenge)
  {
    $summe = 0;
    foreach($eingaenge as $eingang)
    {
      if(($eingang['objekt'] == 'auftrag' || $eingang['objekt'] == 'rechnung') && $eingang['parameter'] )
      {
        $rechnung = $eingang['parameter'];
        if($eingang['objekt'] == 'auftrag')$rechnung = $app->DB->Select("SELECT id from rechnung where auftragid = ".(int)$eingang['parameter']." limit 1");
        if($rechnung)$app->DB->Update("UPDATE kontoauszuege_zahlungseingang set parameter2 = ".$rechnung." where id= ".$eingang['id']);
        
      }
      
      $summe += $eingang['betrag'];
    }
    if($summe < $row['haben'])$diff = $row['haben'] - $summe;
  }
  $app->DB->Update("UPDATE kontoauszuege set diff = ".$diff.", diffangelegt = now() where id = ".$row['id']);
  echo ".";
  //echo $row['vorgang']." diff: ".$diff."\r\n";
}
/*
if($message !="")
{
  $erp->MailSend($erp->GetFirmaMail(),$erp->GetFirmaName(),$erp->GetFirmaBCC1(),"Lagerverwaltung","Systemmeldung: Auto Update Lagerlampen",$message);
}
*/

?>
