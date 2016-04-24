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
include ("_gen/prozessstarter.php");

class Prozessstarter extends GenProzessstarter {
  var $app;
  
  function Prozessstarter($app) {
    //parent::GenProzessstarter($app);
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","ProzessstarterCreate");
    $this->app->ActionHandler("edit","ProzessstarterEdit");
    $this->app->ActionHandler("list","ProzessstarterList");

    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }


  function ProzessstarterCreate()
  {
    $this->ProzessstarterMenu();
    parent::ProzessstarterCreate();
  }

  function ProzessstarterList()
  {
    $this->ProzessstarterMenu();
    parent::ProzessstarterList();
  }

  function ProzessstarterMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Prozessstarter");
    $this->app->erp->MenuEintrag("index.php?module=prozessstarter&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=prozessstarter&action=create","Neu");
    if($this->app->Secure->GetGET("action")=="list")
    $this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    else
    $this->app->erp->MenuEintrag("index.php?module=prozessstarter&action=list","Zur&uuml;ck zur &Uuml;bersicht");
  }


  function ProzessstarterEdit()
  {
    $this->ProzessstarterMenu();

    parent::ProzessstarterEdit();
  }





}

?>
