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


class Session {

  // set check to true when user have permissions
  private $check = false;

  public $module;
  public $action;

  // application object
  public  $app;


  function Session() 
  {


  }


  function Check($appObj)
  {
    $this->app = $appObj;
    $this->check =  true;


    $this->module = $this->app->Secure->GetGET("module");
    $this->action = $this->app->Secure->GetGET("action");


    if(!$this->app->acl->CheckTimeOut() && $this->module!="api" && ($this->module!="kalender" && $this->action!="ics") 
        && ($this->module!="welcome" && $this->action!="cronjob")
        && ($this->module!="welcome" && $this->action!="adapterbox")
        && ($this->module!="callcenter" && $this->action!="call")
        && ($this->module!="welcome" && $this->action!="poll")
      ){
      $this->check = false;
      $this->reason = "PLEASE_LOGIN";
    } else {

      if($this->module=="api")
        $this->check =  true;
      else if ($this->module=="kalender" && $this->action=="ics")
        $this->check =  true;
      else if ($this->module=="welcome" && $this->action=="cronjob")
        $this->check =  true;
      else if ($this->module=="welcome" && $this->action=="adapterbox")
        $this->check =  true;
      else if ($this->module=="callcenter" && $this->action=="call")
 
        $this->check =  true;
      else if ($this->module=="welcome" && $this->action=="poll")
        $this->check =  true;
      else	
      {
        //benutzer ist schon mal erfolgreich angemeldet
        if($this->app->acl->Check($this->app->User->GetType(),$this->module,$this->action, $this->app->User->GetID())){
          $this->check =  true;
          $this->app->calledWhenAuth($this->app->User->GetType());
        } else {
          $this->reason = "NO_PERMISSIONS";
          $this->check = false;
        }
      } 
    }

  }

  function GetCheck() { return $this->check; }

  function UserSessionCheck()
  {
    $this->check=false;
    $this->reason="PLEASE_LOGIN";
    //$this->reason="SESSION_TIMEOUT";
    return true;
  }


}





?>
