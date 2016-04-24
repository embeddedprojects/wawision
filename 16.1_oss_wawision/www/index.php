<?php
/**
 * WaWision
 * Copyright © 2014 embedded projects GmbH
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "WaWision" is a registered trademark of embedded projects GmbH
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 *
 * @category   WaWision
 * @package    WaWision
 * @subpackage WaWision
 * @copyright  Copyright (c) 2014, embedded projects GmbH (http://www.wawision.de)
 * @version    $Id$
 * @author     Benedikt Sauter
 * @author     $Author$
 */
session_start();
//error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
error_reporting(E_ERROR);
header("Content-Type: text/html; charset=utf-8");
ini_set("default_charset", 'utf-8');
/*
if(get_magic_quotes_gpc())
{
echo "Bitte deaktivieren Sie magic_quote_gpc!";
exit;
}
*/
$missing = false;


include("eproosystem.php");


if(!is_file("../conf/main.conf.php"))
	header('Location: ./setup/setup.php');
else {

// layer 1 -> mechnik steht bereit
include("../conf/main.conf.php");
$config = new Config();

$app = new erpooSystem($config);

// layer 2 -> darfst du ueberhaupt?
include("../phpwf/class.session.php");
$session = new Session();
$session->Check($app);

// layer 3 -> nur noch abspielen
include("../phpwf/class.player.php");
$player = new Player();
$player->Run($session);
}

?>
