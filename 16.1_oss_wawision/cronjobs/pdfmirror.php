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

set_time_limit(3600);


error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once(dirname(__FILE__)."/../conf/main.conf.php");
include_once(dirname(__FILE__)."/../phpwf/plugins/class.mysql.php");
include_once(dirname(__FILE__)."/../phpwf/plugins/class.secure.php");
include_once(dirname(__FILE__)."/../phpwf/plugins/class.user.php");
include_once(dirname(__FILE__)."/../www/lib/imap.inc.php");
include_once(dirname(__FILE__)."/../www/lib/class.erpapi.php");
include_once(dirname(__FILE__)."/../www/lib/class.remote.php");
include_once(dirname(__FILE__)."/../www/lib/class.httpclient.php");
include_once(dirname(__FILE__)."/../www/lib/class.aes.php");
include_once(dirname(__FILE__)."/../www/plugins/phpmailer/class.phpmailer.php");
include_once(dirname(__FILE__)."/../www/plugins/phpmailer/class.smtp.php");

class app_t {
  var $DB;
  var $erp;
  var $User;
  var $mail;
  var $remote;
  var $Secure;
}

//ENDE

if(!isset($app))
{

$app = new app_t();

$conf = new Config();
$app->Conf = $conf;
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
$erp = new erpAPI($app);
$app->erp = $erp;

$app->erp->LogFile("MLM gestartet");

$app->Secure = new Secure($app);
$app->User = new User($app);
}
echo "Suche nach nicht archivierten PDFs..\r\n";
$pdfmirror = $app->DB->SelectArr("SELECT * from pdfmirror_md5pool WHERE pdfarchiv_id = 0 AND checksum <> ''");
if($pdfmirror)
{
  foreach($pdfmirror as $key => $value)
  {
    if($newid = $app->erp->pdfmirrorZuArchiv($value['id']))
    {
      echo $value['id']." zu ".$newid." archiviert\r\n";
    }else{
      echo "Fehler beim archivieren von ".$value['id']."\r\n";
    }
  }
  echo "Archivieren abgeschlossen\r\n";
} else {
  echo "Nichts zum Archivieren\r\n";
}

?>