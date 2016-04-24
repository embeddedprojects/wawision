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
include(dirname(__FILE__)."/../phpwf/plugins/class.mysql.php");
include(dirname(__FILE__)."/../www/lib/imap.inc.php");
include(dirname(__FILE__)."/../www/lib/class.erpapi.php");
include(dirname(__FILE__)."/../www/lib/class.remote.php");
include(dirname(__FILE__)."/../www/lib/class.httpclient.php");
include(dirname(__FILE__)."/../www/lib/class.aes.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.phpmailer.php");
include(dirname(__FILE__)."/../www/plugins/phpmailer/class.smtp.php");



class app_t {
  var $DB;
  var $erp;
  var $user;
  var $remote;
}
*/
//ENDE

echo "start 1 umsatzstatistik\r\n";
$app = new app_t();


$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
$erp = new erpAPI($app);
$app->erp = $erp;


echo $this->app->DB->Select("SELECT SUM(IFNULL((SELECT e.preis FROM einkaufspreise e WHERE e.geloescht!=1 AND (e.gueltig_bis='0000-00-00' OR e.gueltig_bis <=NOW()) AND e.artikel=l.artikel ORDER by e.ab_menge LIMIT 1),0))*l.menge FROM lager_platz_inhalt l");

//SELECT a.nummer, a.name_de, l.menge, IFNULL((SELECT e.preis FROM einkaufspreise e WHERE e.geloescht!=1 AND (e.gueltig_bis='0000-00-00' OR e.gueltig_bis <=NOW()) AND e.artikel=l.artikel ORDER by e.ab_menge LIMIT 1),0) as preis, IFNULL((SELECT e.preis FROM einkaufspreise e WHERE e.geloescht!=1 AND (e.gueltig_bis='0000-00-00' OR e.gueltig_bis <=NOW()) AND e.artikel=l.artikel ORDER by e.ab_menge LIMIT 1),0)*l.menge as wert FROM lager_platz_inhalt l LEFT JOIN artikel a ON a.id=l.artikel WHERE a.id > 0


echo "done\r\n";

?>
