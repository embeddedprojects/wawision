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
/*
include(dirname(__FILE__)."/../conf/main.conf.php");
include(dirname(__FILE__)."/../phpwf/plugins/class.db.php");
include(dirname(__FILE__)."/../www/lib/imap.inc.php");
include(dirname(__FILE__)."/../www/lib/class.erpapi.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.phpmailer.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.smtp.php");




class app_t {
  var $DB;
  var $user;
}

//ENDE
*/
$app = new app_t();

$DEBUG = 0;


$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
$erp = new erpAPI($app);
$app->erp = $erp;

$firmendatenid = $app->DB->Select("SELECT MAX(id) FROM firmendaten LIMIT 1");

$benutzername = $app->DB->Select("SELECT benutzername FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");
$passwort = $app->DB->Select("SELECT passwort FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");
$host = $app->DB->Select("SELECT host FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");
$port = $app->DB->Select("SELECT port FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");
$mailssl = $app->DB->Select("SELECT mailssl FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");

$app->mail = new PHPMailer($app);
//$app->mail->PluginDir="plugins/phpmailer/";
$app->mail->IsSMTP();
$app->mail->SMTPAuth   = true;                  // enable SMTP authentication
if($mailssl)
$app->mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$app->mail->Host       = $host;
$app->mail->Port       = $port;                   // set the SMTP port for the GMAIL server

$app->mail->Username   = $benutzername;
$app->mail->Password   = $passwort;

//$app->erp->LogFile("start aufgabe");

$app->DB->Update("UPDATE aufgabe SET email_gesendet_vorankuendigung=0 WHERE DATE_SUB(abgabe_bis, INTERVAL vorankuendigung DAY) = DATE_FORMAT(NOW(),'%Y-%m-%d') AND vorankuendigung > 0 AND DATE_FORMAT(NOW(),'%H:%i') < DATE_FORMAT(abgabe_bis_zeit,'%H:%i')");

//einmalig
$app->DB->Update("UPDATE aufgabe SET email_gesendet=0 WHERE DATE_FORMAT(abgabe_bis, '%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') AND DATE_FORMAT(NOW(),'%H:%i') < DATE_FORMAT(abgabe_bis_zeit,'%H:%i')");


// vorankündigung einmalig
$meineauftraege = $app->DB->SelectArr("SELECT id FROM aufgabe WHERE emailerinnerung='1' AND DATE_SUB(abgabe_bis, INTERVAL vorankuendigung DAY) = DATE_FORMAT(NOW(),'%Y-%m-%d') AND vorankuendigung > 0 AND DATE_FORMAT(NOW(),'%H:%i') >= DATE_FORMAT(abgabe_bis_zeit,'%H:%i') AND email_gesendet_vorankuendigung!=1 AND intervall_tage=0 AND status!='abgeschlossen'");
for($i=0;$i<count($meineauftraege);$i++)
{
  //$this->AuftragEinzelnBerechnen($meineauftraege[$i][id]);
	//echo "Sende Aufgabe ID ".$meineauftraege[$i][id]."\r\n";
  $erp->AufgabenMail($meineauftraege[$i][id],true);
  $app->DB->Update("UPDATE aufgabe SET email_gesendet_vorankuendigung=1 WHERE id='".$meineauftraege[$i][id]."' LIMIT 1");
}


// echte mail einmalig
$meineauftraege = $app->DB->SelectArr("SELECT id FROM aufgabe WHERE emailerinnerung='1' AND DATE_FORMAT(abgabe_bis, '%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') AND DATE_FORMAT(NOW(),'%H:%i') >= DATE_FORMAT(abgabe_bis_zeit,'%H:%i') AND email_gesendet!=1 AND intervall_tage=0 AND status!='abgeschlossen'");

//$app->erp->LogFile("start aufgabe 2 Anzahl: ".count($meineauftraege));

for($i=0;$i<count($meineauftraege);$i++)
{
  //$this->AuftragEinzelnBerechnen($meineauftraege[$i][id]);
	//echo "Sende Aufgabe ID ".$meineauftraege[$i][id]."\r\n";
//  $app->erp->LogFile("starte aufgabe Aufgabe: ".$meineauftraege[$i][id]);
  $app->erp->AufgabenMail($meineauftraege[$i][id]);
  //$app->erp->LogFile("gesendet Aufgabe: ".$meineauftraege[$i][id]);

  $app->DB->Update("UPDATE aufgabe SET email_gesendet=1 WHERE id='".$meineauftraege[$i][id]."' LIMIT 1");
}


// echte mail taeglich
$app->DB->Update("UPDATE aufgabe SET email_gesendet=0 WHERE DATE_FORMAT(NOW(),'%H:%i') < DATE_FORMAT(abgabe_bis_zeit,'%H:%i') AND intervall_tage=1");
$meineauftraege = $app->DB->SelectArr("SELECT id FROM aufgabe WHERE emailerinnerung='1' AND DATE_FORMAT(NOW(),'%H:%i') >= DATE_FORMAT(abgabe_bis_zeit,'%H:%i') AND email_gesendet!=1 AND intervall_tage=1 AND status!='abgeschlossen'");
for($i=0;$i<count($meineauftraege);$i++)
{
  //$this->AuftragEinzelnBerechnen($meineauftraege[$i][id]);
	//echo "Sende Aufgabe ID ".$meineauftraege[$i][id]."\r\n";
  $app->erp->AufgabenMail($meineauftraege[$i][id]);
  $app->DB->Update("UPDATE aufgabe SET email_gesendet=1 WHERE id='".$meineauftraege[$i][id]."' LIMIT 1");
}

// echte mail woechentlich
//TODO
$app->DB->Update("UPDATE aufgabe SET email_gesendet=0 WHERE DATE_FORMAT(NOW(),'%w') = DATE_FORMAT(abgabe_bis_zeit,'%w')
AND DATE_FORMAT(NOW(),'%H:%i') < DATE_FORMAT(abgabe_bis_zeit,'%H:%i')  AND intervall_tage=2");

$meineauftraege = $app->DB->SelectArr("SELECT id FROM aufgabe WHERE emailerinnerung='1' AND DATE_FORMAT(NOW(),'%w') >= DATE_FORMAT(abgabe_bis_zeit,'%w') 
AND DATE_FORMAT(NOW(),'%H:%i') >= DATE_FORMAT(abgabe_bis_zeit,'%H:%i') AND email_gesendet!=1 AND intervall_tage=2 AND status!='abgeschlossen'");
for($i=0;$i<count($meineauftraege);$i++)
{
  //$this->AuftragEinzelnBerechnen($meineauftraege[$i][id]);
	//echo "Sende Aufgabe ID ".$meineauftraege[$i][id]."\r\n";
  $app->erp->AufgabenMail($meineauftraege[$i][id]);
  $app->DB->Update("UPDATE aufgabe SET email_gesendet=1 WHERE id='".$meineauftraege[$i][id]."' LIMIT 1");
}


// echte mail monatlich
$app->DB->Update("UPDATE aufgabe SET email_gesendet=0 WHERE DATE_FORMAT(abgabe_bis, '%d') = DATE_FORMAT(NOW(),'%d') AND DATE_FORMAT(NOW(),'%H:%i') < DATE_FORMAT(abgabe_bis_zeit,'%H:%i') AND intervall_tage=3");
$meineauftraege = $app->DB->SelectArr("SELECT id FROM aufgabe WHERE emailerinnerung='1' AND DATE_FORMAT(abgabe_bis, '%d') = DATE_FORMAT(NOW(),'%d') AND DATE_FORMAT(NOW(),'%H:%i') >= DATE_FORMAT(abgabe_bis_zeit,'%H:%i') AND email_gesendet!=1 AND intervall_tage=3 AND status!='abgeschlossen'");
for($i=0;$i<count($meineauftraege);$i++)
{
  //$this->AuftragEinzelnBerechnen($meineauftraege[$i][id]);
	//echo "Sende Aufgabe ID ".$meineauftraege[$i][id]."\r\n";
  $erp->AufgabenMail($meineauftraege[$i][id]);
  $app->DB->Update("UPDATE aufgabe SET email_gesendet=1 WHERE id='".$meineauftraege[$i][id]."' LIMIT 1");
}


//$app->erp->LogFile("ende aufgabe");

//TODO jaehrlich


?>
