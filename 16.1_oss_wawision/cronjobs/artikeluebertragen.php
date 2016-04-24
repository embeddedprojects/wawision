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
include(dirname(__FILE__)."/../www/lib/class.erpapi_custom.php");
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

$conf = new Config();
$app->DB = new DB($conf->WFdbhost,$conf->WFdbname,$conf->WFdbuser,$conf->WFdbpass);
$erp = new erpAPI($app);
$remote = new Remote($app);
$app->erp = $erp;
$app->remote= $remote;


$shopartikel = $app->DB->SelectArr("SELECT id,shop,restmenge,name_de,lieferzeit,cache_lagerplatzinhaltmenge,juststueckliste FROM artikel WHERE shop > 0");
//echo "count ".count($shopartikel);
for($ij=0;$ij<count($shopartikel);$ij++)
{
      $app->remote->RemoteSendArticleList($shopartikel[$ij]['shop'],array($shopartikel[$ij]['id']));
      $app->erp->LagerSync($shopartikel[$ij]['id'],true);
}

$shopartikel = $app->DB->SelectArr("SELECT id,shop2 as shop,restmenge,name_de,lieferzeit,cache_lagerplatzinhaltmenge,juststueckliste FROM artikel WHERE shop2 > 0");
for($ij=0;$ij<count($shopartikel);$ij++)
{
      $app->remote->RemoteSendArticleList($shopartikel[$ij]['shop'],array($shopartikel[$ij]['id']));
      $app->erp->LagerSync($shopartikel[$ij]['id'],true);
}

$shopartikel = $app->DB->SelectArr("SELECT id,shop3 as shop,restmenge,name_de,lieferzeit,cache_lagerplatzinhaltmenge,juststueckliste FROM artikel WHERE shop3 > 0");
for($ij=0;$ij<count($shopartikel);$ij++)
{
      $app->remote->RemoteSendArticleList($shopartikel[$ij]['shop'],array($shopartikel[$ij]['id']));
      $app->erp->LagerSync($shopartikel[$ij]['id'],true);
}


?>
