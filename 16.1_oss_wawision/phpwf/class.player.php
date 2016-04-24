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
/* Author: Benedikt Sauter, sauter@ibat.de, 2007
 * Player for PHP Applications
 */

class Player {

  public $DefautTemplates;
  public $DefautTheme;

  // the application object
  public $app;

  function Player()
  {
    $this->DefautTemplates="defaulttemplates";
    $this->DefautTheme="default";
  }

  function SetDefaultTemplates($path)
  {
  }

  function SetDefaultTheme($path)
  {

  }

  function BuildNavigation()
  {
    $type = $this->app->User->GetType();
    $version = $this->app->erp->Version();

    if(($version=="ENT" || $version=="PRE") && method_exists("erpAPI","Navigation"))
      $this->app->Page->CreateNavigation($this->app->erp->Navigation($this->app->User->GetType())); 
    else if($version=="PRO" && method_exists("erpAPI","Navigation"))
      $this->app->Page->CreateNavigation($this->app->erp->Navigation($this->app->User->GetType())); 
    else if($version=="STOCK" && method_exists("erpAPI","NavigationSTOCK"))
      $this->app->Page->CreateNavigation($this->app->erp->NavigationSTOCK($this->app->User->GetType())); 
    else 
      $this->app->Page->CreateNavigation($this->app->erp->NavigationOSS($this->app->User->GetType())); 
  
  }

  function Run($sessionObj)
  {
    $this->app = $sessionObj->app;
    // play application only when layer 2 said that its ok
    if(!$sessionObj->GetCheck()) {
      if($sessionObj->reason=="PLEASE_LOGIN")
      {
        $module = "welcome";
        $action = "login";
        $this->app->Secure->GET['module']="welcome";
        $this->app->Secure->GET['action']="login";
        //header("Location: index.php?module=welcome&action=login");
        //exit;
      } else {
        //echo "verboten: ".$sessionObj->reason;
      }
    } else {
      // Get actual commands from URL
      $module = $this->app->Secure->GetGET('module','alpha');
      $action = $this->app->Secure->GetGET('action','alpha');
      if($module =="") {
        $module = "welcome";
        $action = "main";
      }
      
      
    } 

    if($action!="list" && $action!="css" && $action!="logo" && $action!="poll" && $module!="ajax" && $module!="protokoll" && $action!="thumbnail")
      $this->app->erp->Protokoll();

    // plugin instanzieren
    // start module
    if(file_exists("pages/".$module.".php")){
      if(file_exists("pages/".$module."_custom.php")){
        include("pages/".$module.".php");
        include("pages/".$module."_custom.php");
        //create dynamical an object
        $constr=strtoupper($module{0}).substr($module, 1)."Custom";
        $myApp = new $constr($this->app);
      } else {
        include("pages/".$module.".php");
        //create dynamical an object
        $constr=strtoupper($module{0}).substr($module, 1);
        $myApp = new $constr($this->app);
      }
    }
    else {
      if(file_exists("pages/_gen/".$module.".php")){
        include("pages/_gen/".$module.".php");
        //create dynamical an object
        $constr="Gen".strtoupper($module{0}).substr($module, 1);
        $myApp = new $constr($this->app);
      }
      else {
        //echo "Dieses Modul gibt es nicht!";
        //echo $this->app->WFM->Error("Module <b>$module</b> doesn't exists in pages/");
      }
    }
    //$this->app->calledWhenAuth($this->app->User->GetType());
    // jetzt noch alles anzeigen
    //$this->app->Tpl->ReadTemplatesFromPath("../../conductor/themes/[THEME]/templates/");
    //$this->app->Tpl->ReadTemplatesFromPath("../../conductor/themes/[THEME]/templates/");
    
    $permission = true;
    if(isset($myApp) && method_exists($myApp,'CheckRights'))$permission = $myApp->CheckRights();
    
    if(!$permission)
    {
      if($this->app->User->GetID()<=0)
      {
        $this->app->erp->Systemlog("Keine gueltige Benutzer ID erhalten",1);
        echo str_replace('BACK',"index.php?module=welcome&action=login",$this->app->Tpl->FinalParse("permissiondenied.tpl"));
      }
      else {
        $this->app->erp->Systemlog("Fehlendes Recht",1);
        echo str_replace('BACK',isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'',$this->app->Tpl->FinalParse("permissiondenied.tpl"));
      }
      exit;
    }
    

    if($this->app->BuildNavigation==true)
      $this->BuildNavigation();

    $this->app->endtime = microtime(); 

    $starttime = explode(" ", $this->app->starttime);
    if(isset($starttime[0]))$startlow = $starttime[0];
    if(isset($starttime[1]))$starthigh = $starttime[1];
    $start = isset($starthigh)?$starthigh:0 + $startlow;
    
    $endtime = explode(" ", $this->app->endtime);
    if(isset($endtime[0]))$low = $endtime[0];
    if(isset($endtime[1]))$high = $endtime[1];
    $t    = isset($high)?$high:0 + $low;
    $used = $t - $start;

    $this->app->Tpl->Add('VERSIONUNDSTATUS',"&nbsp;|&nbsp;Generated page in ".$used." sec");

    $right = $this->app->Secure->GetGET("right");

    $firmenfarbedunkel = $this->app->erp->Firmendaten("firmenfarbedunkel");
    if($firmenfarbedunkel =="")
      $firmenfarbedunkel = "#3fbac9";
    $this->app->Tpl->Set('TPLFIRMENFARBEDUNKEL',$firmenfarbedunkel);


    
    if($this->app->BuildNavigation==true)
    {
      if($right==1) 
        echo $this->app->Tpl->FinalParse('right.tpl');
      else
      {
        if($module=="welcome" && $action=="login")
          echo $this->app->Tpl->FinalParse('loginpage.tpl');
        else {

          if($this->app->erp->UserDevice()=="smartphone")
            echo $this->app->Tpl->FinalParse('page_smartphone.tpl');
          else
            echo $this->app->Tpl->FinalParse('page.tpl');
        }
      }
    }
    else
      echo $this->app->Tpl->FinalParse('popup.tpl');
  }

}
