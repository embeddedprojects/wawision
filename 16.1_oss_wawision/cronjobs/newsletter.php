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
/*
include(dirname(__FILE__)."/../conf/main.conf.php");
include(dirname(__FILE__)."/../phpwf/plugins/class.mysql.php");
include(dirname(__FILE__)."/../www/lib/imap.inc.php");
include(dirname(__FILE__)."/../www/lib/class.erpapi.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.phpmailer.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.smtp.php");


class app_t {
  var $DB;
  var $user;
}


$app = new app_t();

*/

// von oben bis hier alles auskommentieren

$DEBUG = 0;

$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
$erp = new erpAPI($app);


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


//$sql = "SELECT `name`,`ansprechpartner`,`email`  FROM `adresse` WHERE `land` = 'DE' AND (`plz` LIKE '8%' OR `plz` LIKE '7%' OR `plz` LIKE '9%' OR `plz` LIKE '6%') AND `kundennummer` != '' AND `lieferantennummer` = '' AND marketingsperre='' AND projekt!='3'";

//$sql = "SELECT `name`,`ansprechpartner`,`email`  FROM `adresse` WHERE `land` = 'DE' AND `kundennummer` != '' AND `lieferantennummer` = '' AND marketingsperre='' AND projekt!='3' AND logdatei < '2013-10-01 12:00:00'";

//$sql = "SELECT `name`,`ansprechpartner`,`email`  FROM `adresse` WHERE name LIKE 'Benedikt Sauter' OR name LIKE 'Claudia Sauter'";
$sql = "SELECT `name`,`ansprechpartner`,`email`  FROM `adresse` WHERE name LIKE 'Benedikt Sauter'";

$von_mail = "no-reply@embedded-projects.net";
$von_name = "embedded projects GmbH";

$betreff = "embedded projects News 10/2013 (Kostenloser Eagle Workshop)";
$comment = "embeddednews102013";

$body = 
'
<span style="font-family:Helvetica,Helv">
Hallo [TONAME],

<p>anbei unsere neusten News Rund um Open-Source Hard- und Software aus
unserem Labor und unseren Plattformen.</p>

<h2>Kostenloser Eagle-Workshop in Unterhaching</h2>
<p>mit Eurocircuits und Cadsoft</p>
<img src="http://www.eurocircuits.de/images/Workshops/EAGLE/richardhammerl.png" align="left"><br>
<p>
Eurocrcuits veranstaltet gemeinsam mit CadSoft und Farnell einen Gratis-Workshop<br>
24. Oktober von 9:00 - 17:00 Uhr in Oberhaching.<br>

CadSoft\'s EAGLE Spezialist Richard Hammerl erklärt Einsteigern ebenso wie<br>
Fortgeschrittenen den professionellen Umgang mit dem verbreiteten Layoutpaket.<br>
<br>
<br>
<br>
<b>Schwerpunkt diesmal Bauteilerstellung mit EAGLE.</b>
<br>
Frau Schulz von Farnell wird einen Vortrag zur Stücklistenkonvertierung<br>
und zum Bauteil- und Beschaffungsservice halten.<br><br>
Ergänzend wird Uwe Dörr auf die Tücken eines Layouts aus Herstellersicht<br>
hinweisen und die Herstellung eines 4-Lagen Multilayers sowie den Online-Datencheck vorführen. 
</p>
Es gibt noch ein paar freie Pl&auml;tze.
<br>
<br>
<a href="http://be.eurocircuits.com/shop/events.aspx?e=bqyVBzisKsU%3d">Anmelden</a><br>

<h2>embedded projects Journal Ausgabe 18 - Online</h2>

<p>
<img src="http://journal.embedded-projects.net/index.php?module=archiv&action=thumbnail&id=20" align="right">
Das neue Journal ist Online. Viel Spass beim Lesen.
<ul><li>Erweiterung der Gnublin API</li>
<li>Experimentierboard</li>
<li>Dual Licensing</li>
<li>Ultra Low Power Design mit Atmel Mikrocontrollern</li>
<li>IPv6 Funkübertragung mit dem Merkurboard</li>
<li>Controlled Impedance for Edge-Coupled Coated Microstrip</li>
<li>CAN-Bootloader<li>
<li>Wetterballon mit Gnublin</li>
<li>NetIO mit Gnublin</li>
</ul>
</p>
<br>
<a href="http://journal.embedded-projects.net/index.php?module=archiv&action=list">Link zum Download</a>
<br>

<h2>Gnublin Live CD oder USB-Stick für PC</h2>

<p>
<img src="http://gnublin.embedded-projects.net/wp-content/uploads/2013/10/starter-300x275.png" align="right">
Der Einstieg in die Programmierung von embedded Linux bringt einige Hürden mit sich.<br>
Mit der neuen Gnublin Live CD kann man von einem beliebigen PC ganz einfach<br>
erste Schritte im Bereich Programmierung mit C/C++ mit embedded Linux machen<br>
ohne viel Einarbeitungszeit zu investieren.
<ul><li>Installierte Toolchain</li>
<li>Eclipse als Entwicklungsumgebung</li>
<li>Terminal für die Gnublin Konsole</li>
<li>Einfach neue SD-Karte erstellen</li>
</ul>
</p>
<br>
<a href="http://gnublin.embedded-projects.net/live-cd/">Link zur Live-CD</a>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>Viele Grüsse,
<br>Euer embedded projects Team

<br><br>Wenn Sie diesen Newsletter abbestellen möchten, klicken Sie bitte <a href="http://newsletter.embedded-projects.net/action.php?mail=[TOEMAIL]&cmd=unregister">hier</a>.
</span>
';



$mailadresse = $app->DB->SelectArr($sql);

//$mailadresse = array(0 => array('name'=>"Benedikt Sauter",'email'=>"bene@embedded-projects.net"));
$mail_limit = 50;

for($i=0;$i<count($mailadresse);$i++)
{

  $to_email = $mailadresse[$i]['email'];
  $to_name = $mailadresse[$i]['name'];
  $to_ansprechpartner = $mailadresse[$i]['ansprechpartner'];

  if($to_ansprechpartner!="") $to_name=$to_ansprechpartner;

  $custom_body = str_replace('[TONAME]',$to_name,$body);
  $custom_body = str_replace('[TOEMAIL]',$to_email,$custom_body);


  $checksum = $app->DB->Select("SELECT checksum FROM newslettercache WHERE checksum='".md5($to_email)."' AND comment='$comment' LIMIT 1");
  $blacklist = $app->DB->Select("SELECT email FROM newsletter_blacklist WHERE email='".$to_email."' LIMIT 1");

	// external check
	if($checksum=="")
	$homepage_blacklist = file_get_contents('http://newsletter.embedded-projects.net/action.php?check='.md5($to_email));

  if($blacklist!="" || $homepage_blacklist!="0")
  {
		if($homepage_blacklist!="0")
    	echo "homepage blacklist: $to_email\r\n";
		else
    	echo "blacklist: $to_email\r\n";
  }

  else if($checksum=="" && $to_email!="" && $blacklist=="")
  {
		$mail_limit--;
    echo "neu: $to_email\r\n";
    if($erp->MailSendNoBCCHTML($von_mail,$von_name,$to_email,$to_name,$betreff,$custom_body))
    $app->DB->Insert("INSERT INTO newslettercache (checksum,comment) VALUES ('".md5($to_email)."','".$comment."')");
		else echo "mail send fehler!\r\n";
  } else {
    echo "alt: $to_email\r\n";
  }

	if($mail_limit<=0)
		break;
}


?>
