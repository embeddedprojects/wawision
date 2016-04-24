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
header_remove(); 
header ("Content-Type:text/xml");

function RunStateMachine($DB,$deviceid)
{
  $deviceid_destination = $_GET['device'];
  $cmd = $_GET['cmd'];

	echo "<xml>";
	$DB->Update("UPDATE adapterbox SET letzteverbindung=NOW() WHERE seriennummer='$deviceid' AND seriennummer!='' LIMIT 1");

	switch($cmd)
	{
		case "addJob":
			echo "<cmd>$cmd</cmd>";
			$job = $_POST['job'];
			$request_id = $_GET['request_id'];
			$art = $_GET['art'];
			//file_put_contents("/tmp/bene","add job for $deviceid_destination deviceid $deviceid job $job");
                        
			if($deviceid!="" && $deviceid_destination!="" && $job!="")
			{
				$job = base64_encode($job);
				$DB->Insert("INSERT INTO device_jobs (id,deviceidsource,deviceiddest,job,zeitstempel,request_id,art) 
                                  VALUES ('','$deviceid','$deviceid_destination','$job',NOW(),'$request_id','$art')");
				echo "<result>1</result>";
			} else {
				echo "<result>0</result>";
			}
		break;

		case "getJob":
			echo "<cmd>$cmd</cmd>";
			$tmp = $DB->SelectArr("SELECT id,job,art FROM device_jobs WHERE deviceiddest='$deviceid' AND abgeschlossen!='1' ORDER by zeitstempel LIMIT 1");
			$DB->Update("UPDATE device_jobs SET abgeschlossen='1' WHERE id='".$tmp[0]['id']."' LIMIT 1");
			if($tmp[0]['id'] > 0)
			{
				echo "<job>".$tmp[0]['job']."</job>";
				echo "<device>".$tmp[0]['art']."</device>";
				echo "<id>".$tmp[0]['id']."</id>";
				echo "<result>1</result>";
			}
			else
                        {
				echo "<result>0</result>";
                        }
			$DB->Delete("DELETE FROM device_jobs WHERE abgeschlossen='1'");
		break;

		case "logOut":
			echo "<cmd>$cmd</cmd>";

		break;

		case "state":
			echo "<cmd>$cmd</cmd>";
			if($deviceid_destination!="")
				$tmp = $DB->Select("SELECT COUNT(id) FROM device_jobs WHERE deviceiddest='$deviceid_destination' AND abgeschlossen!='1'");
			else
				$tmp = $DB->Select("SELECT COUNT(id) FROM device_jobs WHERE deviceiddest='$deviceid' AND abgeschlossen!='1'");
			echo "<numberofjobs>$tmp</numberofjobs>";
			echo "<deviceid>$deviceid</deviceid>";
		break;
		default:
			echo "<cmd>unkown</cmd>";
  		echo "<pre>DEVICE ID: $deviceid L1 $L1 L2 $L2 L3 $L3</pre>";
	}

	echo "</xml>";
}


?>
