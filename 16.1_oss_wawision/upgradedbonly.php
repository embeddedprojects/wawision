<?php

//include("wawision.inc.php");

// Nur einfache Fehler melden
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ERROR | E_PARSE);


include_once("conf/main.conf.php");
include_once("phpwf/plugins/class.mysql.php");
include_once("www/lib/class.erpapi.php");


class app_t {
    var $DB;
      var $user;
      var $Conf;
}

$app = new app_t();

$DEBUG = 0;

$app->Conf = new Config();
$app->DB = new DB($app->Conf->WFdbhost,$app->Conf->WFdbname,$app->Conf->WFdbuser,$app->Conf->WFdbpass);
$erp = new erpAPI($app);

echo "STARTE DB Upgrade\r\n";
$erp->UpgradeDatabase();
echo "ENDE   DB Upgrade\r\n";


?>
