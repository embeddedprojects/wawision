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
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

//error_reporting(0);
include(dirname(__FILE__)."/../conf/main.conf.php");
include(dirname(__FILE__)."/../phpwf/plugins/class.mysql.php");
include(dirname(__FILE__)."/../phpwf/plugins/class.secure.php");
include(dirname(__FILE__)."/../phpwf/plugins/class.user.php");
include(dirname(__FILE__)."/../www/lib/imap.inc.php");
include(dirname(__FILE__)."/../www/lib/class.erpapi.php");

if(is_file(dirname(__FILE__)."/../www/lib/class.erpapi_custom.php"))
  include(dirname(__FILE__)."/../www/lib/class.erpapi_custom.php");

include(dirname(__FILE__)."/../www/lib/class.httpclient.php");
include(dirname(__FILE__)."/../www/lib/class.aes.php");
include(dirname(__FILE__)."/../www/lib/class.remote.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.phpmailer.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.smtp.php");

class app_t {
  var $DB;
  var $user;
  var $mail;
  var $erp;
  var $remote;
}

$app = new app_t();

$DEBUG = 0;

$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);


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
{
  $app->mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
}

$app->mail->Host       = $host;
$app->mail->Port       = $port;                   // set the SMTP port for the GMAIL server

$app->mail->Username   = $benutzername;
$app->mail->Password   = $passwort;


$app->erp = new erpAPI($app);

if($DEBUG)
  $app->erp->LogFile("starter.php");

  $task = $app->DB->SelectArr("SELECT * from prozessstarter WHERE aktiv='1' ORDER by id DESC");

  for($task_index=0;$task_index<count($task);$task_index++)
{
  $run = 0;

  if($DEBUG)
    $app->erp->LogFile("Task: {$task[$task_index]['bezeichnung']} ".$task[$task_index]['art']);

  if($task[$task_index]['art']=="periodisch")
  {
    //$app->erp->LogFile("Periodisch");
    if($task[$task_index]['letzteausfuerhung']=="0000-00-00 00:00:00")
    {
      $run = 1;
    }
    else
    {
      $run = $app->DB->Select("SELECT IF(DATE_SUB(NOW(),INTERVAL {$task[$task_index]['periode']} MINUTE)>'{$task[$task_index]['letzteausfuerhung']}','1','0')");
    }
  }

  if($task[$task_index]['art']=="uhrzeit")
  {
    $task[$task_index]['startzeit'] = str_replace("0000-00-00",date("Y-m-d"),$task[$task_index]['startzeit']);
    $time = strtotime($task[$task_index]['startzeit']);

    $time_letzte = strtotime($task[$task_index]['letzteausfuerhung']);

    //pro minute maximal	
    if(date('H', $time) == date('H') && date('i', $time) == date('i'))// && (date('i',$time_letzte) != date('i')))
    {
      $run = 1;
    }
    else
      $run = 0;
  }

  // wenn art filter gesetzt ist
  if($task[$task_index]['art_filter']!="")
  {
    if(date('N')!=$task[$task_index]['art_filter'])
      $run =0;
  }

  if($run)
  {
    if($DEBUG)
      $app->erp->LogFile("Prozessstarter ".$task[$task_index]['parameter']);
    //update letzte ausfuerhung
    $app->DB->Update("UPDATE prozessstarter SET letzteausfuerhung=NOW() WHERE id='{$task[$task_index]['id']}' LIMIT 1");
    //start
    // wenn das skript laeuft hier abbrechen
    $mutexcounter = $app->DB->Select("SELECT mutexcounter FROM prozessstarter WHERE parameter='".$task[$task_index]['parameter']."' LIMIT 1");

    if($mutexcounter>5)
    {
      $app->DB->Update("UPDATE prozessstarter SET mutexcounter=0,mutex=0 WHERE parameter='".$task[$task_index]['parameter']."' LIMIT 1");
    }

    if($task[$task_index]['typ']=="cronjob")
    {
      include(dirname(__FILE__)."/".$task[$task_index]['parameter'].".php");
    }

    if($task[$task_index]['typ']=="url")
    {

    }

  } 

}



?>
