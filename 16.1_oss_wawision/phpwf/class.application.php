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

function WithGUI()
{
	$module = isset($_GET['module'])?$_GET['module']:'';
	$action = isset($_GET['action'])?$_GET['action']:'';
	return !($module=="ajax" || $module=="api"
    || ($module=="welcome" && $action=="css")
    || ($module=="welcome" && $action=="cronjob")
    || ($module=="welcome" && $action=="adapterbox")
    || ($module=="welcome" && $action=="logo")
    || ($module=="artikel" && $action=="ajaxwerte")
    || ($module=="artikel" && $action=="thumbnail")
    || ($module=="benutzer" && $action=="chrights")
    || ($module=="callcenter" && $action=="call")
    || ($module=="chat" && $action=="messagelist")
    || ($module=="chat" && $action=="userlist")
    || ($module=="chat" && $action=="submit")
    || ($module=="waage" && $action=="gewicht")
    || ($module=="welcome" && $action=="poll"));
}

//include ("phpwf/engine/class.engine.php");
if(WithGUI())
{
	include ("../phpwf/plugins/class.formhandler.php");
	include ("../phpwf/plugins/class.pagebuilder.php");
	include ("../phpwf/plugins/class.widgetapi.php");
	include ("../phpwf/widgets/easytable.php");
	include ("../phpwf/widgets/grouptable.php");
	include ("../phpwf/widgets/childtable.php");
	include ("../phpwf/widgets/table.php");
	include ("../phpwf/plugins/class.picosafelogin.php");
	include ("../phpwf/plugins/class.wawision_otp.php");
	include("../phpwf/htmltags/all.php");
	include("../phpwf/types/class.simplelist.php");
	include ("../phpwf/plugins/class.databaseform.php");
}
include ("../phpwf/plugins/class.templateparser.php");
include ("../phpwf/plugins/class.yui.php");

include ("../phpwf/plugins/class.acl.php");
include ("../phpwf/plugins/class.user.php");
include ("../phpwf/plugins/class.page.php");
include ("../phpwf/plugins/class.phpwfapi.php");
include ("../phpwf/plugins/class.secure.php");
include ("../phpwf/plugins/class.wfmonitor.php");
include ("../phpwf/plugins/class.string.php");
include ("../phpwf/plugins/class.objectapi.php");

class Application
{

    var $ActionHandlerList;
    var $ActionHandlerDefault;

    function Application($config,$group="")
    {
      session_cache_limiter('private');
      @session_start();

      $this->Conf= $config;

			if(isset($this->Conf->WFdbType) && $this->Conf->WFdbType=="postgre")
			  include ("../phpwf/plugins/class.postgre.php");
			else
			  include ("../phpwf/plugins/class.mysql.php");


      if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=="on")
				$this->http = "https";
      else
				$this->http = "http";

    
      $this->Secure         = new Secure($this);   // empty $_GET, and $_POST so you
                                                // have to need the secure layer always
      $this->Tpl            = new TemplateParser($this);

			if(WithGUI()){
      	$this->FormHandler    = new FormHandler($this);
      	$this->DatabaseForm   = new DatabaseForm($this);
      	$this->Table	    = new Table($this);
      	$this->Widget	    = new WidgetAPI($this);
      	$this->PageBuilder    = new PageBuilder($this);
      	$this->Page           = new Page($this);
      	$this->ObjAPI	    = new ObjectAPI($this);
      	$this->WFM            = new WFMonitor($this);
			}

      $this->YUI            = new YUI($this);
      $this->User           = new User($this);
      $this->acl            = new Acl($this);
      $this->WF             = new phpWFAPI($this);
      $this->String         = new String();

      $this->BuildNavigation = true;
          
      $this->DB             = new DB($this->Conf->WFdbhost,$this->Conf->WFdbname,$this->Conf->WFdbuser,$this->Conf->WFdbpass,$this);

			if(WithGUI())
      	$this->Tpl->ReadTemplatesFromPath("../phpwf/widgets/templates/");

    }


    function __destruct() {
      $this->DB->Close();
    }

    function ActionHandlerInit(&$caller)
    {
      $this->caller = &$caller;
    }

 
    function ActionHandler($command,$function)
    {
      $this->ActionHandlerList[$command]=$function; 
    }
    
    function DefaultActionHandler($command)
    {
      $this->ActionHandlerDefault=$command;
    }

   
    function ActionHandlerListen(&$app)
    {
      $action = $app->Secure->GetGET("action","alpha");
      if($action!="")
				$fkt = $this->ActionHandlerList[$action];
      else
				$fkt = $this->ActionHandlerList[$this->ActionHandlerDefault];


      // check permissions
      @$this->caller->$fkt();
    }

    
}
?>
