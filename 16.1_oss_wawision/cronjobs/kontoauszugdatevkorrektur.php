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


function UpdateKontoauszug($zeile,$gegenkonto,$belegfeld1,$buchungstext)
{
  global $app;

  $app->DB->UPDATE("UPDATE kontoauszuege SET buchungstext='$buchungstext',belegfeld1='$belegfeld1',gegenkonto='$gegenkonto' WHERE id='$zeile' LIMIT 1");
}

$app = new app_t();

$DEBUG = 0;


$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
$erp = new erpAPI($app);


//$data = $app->DB->SelectArr("SELECT * FROM `kontoauszuege` WHERE buchungstext=''");
$data = $app->DB->SelectArr("SELECT * FROM `kontoauszuege` WHERE gegenkonto='1370'");

for($i=0;$i<count($data);$i++)
{

  $zeile = $data[$i]['id'];

  // schaue ob kontoausgang vorhanden

  $anzahl_ausgang = $app->DB->Select("SELECT COUNT(id) FROM kontoauszuege_zahlungsausgang WHERE kontoauszuege='$zeile'");
  if($anzahl_ausgang >1)
  {
    echo "Achtung zuviele kontoauszuege_zahlungsausgang bei kontoauszugszeile $zeile\r\n";
  } else if($anzahl_ausgang==1)
  {
    // beheben auftrag gutschrift oder verbindlichkeit ( auf 1370 )
    $ausgang = $app->DB->SelectArr("SELECT * FROM kontoauszuege_zahlungsausgang WHERE kontoauszuege='$zeile' LIMIT 1");

    if($ausgang[0]['objekt']=="auftrag")
    {
      $belegfeld1 = $app->DB->Select("SELECT belegnr FROM auftrag WHERE id='{$ausgang[0]['parameter']}' LIMIT 1");
      $buchungstext = $app->DB->Select("SELECT CONCAT(name,' ',kundennummer) FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      $gegenkonto = $app->DB->Select("SELECT kundennummer FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      UpdateKontoauszug($zeile,$gegenkonto,$belegfeld1,$buchungstext);
    }
    else if($ausgang[0]['objekt']=="gutschrift")
    {
      $belegfeld1 = $app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='{$ausgang[0]['parameter']}' LIMIT 1");
      $buchungstext = $app->DB->Select("SELECT CONCAT(name,' ',kundennummer) FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      $gegenkonto = $app->DB->Select("SELECT kundennummer FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      UpdateKontoauszug($zeile,$gegenkonto,$belegfeld1,$buchungstext);
    }
    else if($ausgang[0]['objekt']=="verbindlichkeit")
    {
      $belegfeld1 = $app->DB->Select("SELECT rechnung FROM verbindlichkeit WHERE id='{$ausgang[0]['parameter']}' LIMIT 1");
      $buchungstext = $app->DB->Select("SELECT CONCAT(name,' ',kundennummer) FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      $gegenkonto = 1370;
      UpdateKontoauszug($zeile,$gegenkonto,$belegfeld1,$buchungstext);
    }

  }
    
  // schaue ob kontoeingang vorhanden

  $anzahl_eingang = $app->DB->Select("SELECT COUNT(id) FROM kontoauszuege_zahlungseingang WHERE kontoauszuege='$zeile'");
  if($anzahl_eingang >1)
  {
    echo "Achtung zuviele kontoauszuege_zahlungseingang bei kontoauszugszeile $zeile\r\n";
  } else if($anzahl_eingang==1)
  {
    // beheben auftrag gutschrift oder verbindlichkeit ( auf 1370 )
    $ausgang = $app->DB->SelectArr("SELECT * FROM kontoauszuege_zahlungseingang WHERE kontoauszuege='$zeile' LIMIT 1");

    if($ausgang[0]['objekt']=="auftrag")
    {
      $belegfeld1 = $app->DB->Select("SELECT belegnr FROM auftrag WHERE id='{$ausgang[0]['parameter']}' LIMIT 1");
      $buchungstext = $app->DB->Select("SELECT CONCAT(name,' ',kundennummer) FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      $gegenkonto = $app->DB->Select("SELECT kundennummer FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      UpdateKontoauszug($zeile,$gegenkonto,$belegfeld1,$buchungstext);
    }
    else if($ausgang[0]['objekt']=="rechnung")
    {
      $belegfeld1 = $app->DB->Select("SELECT belegnr FROM rechnung WHERE id='{$ausgang[0]['parameter']}' LIMIT 1");
      $buchungstext = $app->DB->Select("SELECT CONCAT(name,' ',kundennummer) FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      $gegenkonto = $app->DB->Select("SELECT kundennummer FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      UpdateKontoauszug($zeile,$gegenkonto,$belegfeld1,$buchungstext);
    }
    else if($ausgang[0]['objekt']=="datev")
    {
      $belegfeld1 = "";$app->DB->Select("SELECT rechnung FROM verbindlichkeit WHERE id='{$ausgang[0]['parameter']}' LIMIT 1");
      $buchungstext = "";//$app->DB->Select("SELECT CONCAT(name,' ',kundennummer) FROM adresse WHERE id='{$ausgang[0]['adresse']}' LIMIT 1");
      $gegenkonto = 1460;
      UpdateKontoauszug($zeile,$gegenkonto,$belegfeld1,$buchungstext);
    }

  }
   
  // schaue ob datev vorhanden


  $anzahl_datev = $app->DB->Select("SELECT COUNT(id) FROM datev_buchungen WHERE kontoauszug='$zeile'");
  if($anzahl_datev >1)
  {
    echo "Achtung zuviele kontoauszuege_zahlungseingang bei kontoauszugszeile $zeile\r\n";
  } else if($anzahl_datev==1)
  {
    // beheben auftrag gutschrift oder verbindlichkeit ( auf 1370 )
    $ausgang = $app->DB->SelectArr("SELECT * FROM datev_buchungen WHERE kontoauszug='$zeile' LIMIT 1");

      $belegfeld1 = $app->DB->Select("SELECT belegfeld1 FROM datev_buchungen WHERE id='{$ausgang[0]['id']}' LIMIT 1");
      $buchungstext = $app->DB->Select("SELECT buchungstext FROM datev_buchungen WHERE id='{$ausgang[0]['id']}' LIMIT 1");
      $gegenkonto = $app->DB->Select("SELECT gegenkonto FROM datev_buchungen WHERE id='{$ausgang[0]['id']}' LIMIT 1");
      UpdateKontoauszug($zeile,$gegenkonto,$belegfeld1,$buchungstext);
  }
   


//echo $i." ".$datum." $haben $kontoauszug\n\r";
$gesamt++;
}

echo "fehlt: $fehlt gesamt: $gesamt";

?>
