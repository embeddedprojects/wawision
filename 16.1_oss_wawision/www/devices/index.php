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
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include(dirname(__FILE__)."/../../conf/main.conf.php");
include(dirname(__FILE__)."/../../phpwf/plugins/class.mysql.php");

$conf = new Config();
$DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
//$erp = new erpAPI($app);
//$app->erp = $erp;

/*************************
 * config network        *
 *************************/

//all device serialnumbers
//$validDevices = array('000000000','999999999','123456789');
$tmpdevices = $DB->SelectArr("SELECT adapterboxseriennummer FROM drucker WHERE adapterboxseriennummer!='' AND aktiv='1' AND anbindung='adapterbox'");
$tmpdevices2 = $DB->SelectArr("SELECT seriennummer as adapterboxseriennummer FROM adapterbox WHERE seriennummer!=''");

//master device is always here
$validDevices[]="000000000";

for($i=0;$i<count($tmpdevices);$i++)
	$validDevices[]=$tmpdevices[$i]['adapterboxseriennummer'];

for($i=0;$i<count($tmpdevices2);$i++)
	$validDevices[]=$tmpdevices2[$i]['adapterboxseriennummer'];

$validDevices = array_values(array_unique($validDevices));


//Password
$validPass = $DB->Select("SELECT devicekey FROM firmendaten WHERE devicekey!='' LIMIT 1");
if($validPass=="") $vaidPass=rand()."".mt_rand();

/*************************
 * start application     *
 *************************/

include("lib.php");

$realm = 'DeviceID';

// Just a random id
$nonce = uniqid();

// Get the digest from the http header
$digest = getDigest();

$auth=$_GET['auth'];
$auth_succesfull=false;

foreach($validDevices as $deviceid)
{
  $validUser = $deviceid;
  if(generateHash($validPass,$deviceid)==$auth)
  {
    $auth_succesfull = true;
    $auth_deviceid = $deviceid;
    break;
  }
}

// If there was no digest, show login
if (is_null($digest) && !$auth_succesfull) requireLogin($realm,$nonce);

$digestParts = digestParse($digest);
if($auth_succesfull)
{
  $digestParts['username'] = $auth_deviceid;
  $succesfull=true;
}
else
  $succesfull=false;

foreach($validDevices as $deviceid)
{
  $validUser = $deviceid;
  // Based on all the info we gathered we can figure out what the response should be
  $A1 = md5("{$validUser}:{$realm}:{$validPass}");
  $A2 = md5("{$_SERVER['REQUEST_METHOD']}:{$digestParts['uri']}");

  $validResponse = md5("{$A1}:{$digestParts['nonce']}:{$digestParts['nc']}:{$digestParts['cnonce']}:{$digestParts['qop']}:{$A2}");
  if ($digestParts['response']==$validResponse) {
      $succesfull=true;
      break;
  }
}

if ($succesfull!=true) {
	requireLogin($realm,$nonce);
}
else {
  include("statemachine.php");
  RunStateMachine($DB,$auth_deviceid);//digestParts['username']);
}



function LogFile($DB,$message,$dump="")
{
  $DB->Insert("INSERT INTO logfile (id,module,action,meldung,dump,datum,bearbeiter,funktionsname) 
      VALUES ('','device','api','$message','$dump',NOW(),'','')");
}

function generateHash($key,$deviceid)
{
    //$date = gmdate('dmY');
    $hash = "";

    for($i = 0; $i <= 200; $i++)
      $hash = sha1($hash . $key . $deviceid);

    return $hash;
}

?>
