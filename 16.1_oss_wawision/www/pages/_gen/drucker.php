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

class GenDrucker { 

  function GenDrucker(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","DruckerCreate");
    $this->app->ActionHandler("edit","DruckerEdit");
    $this->app->ActionHandler("copy","DruckerCopy");
    $this->app->ActionHandler("list","DruckerList");
    $this->app->ActionHandler("delete","DruckerDelete");

    $this->app->Tpl->Set(HEADING,"Drucker");    $this->app->ActionHandlerListen($app);
  }

  function DruckerCreate(){
    $this->app->Tpl->Set(HEADING,"Drucker (Anlegen)");
      $this->app->PageBuilder->CreateGen("drucker_create.tpl");
  }

  function DruckerEdit(){
    $this->app->Tpl->Set(HEADING,"Drucker (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("drucker_edit.tpl");
  }

  function DruckerCopy(){
    $this->app->Tpl->Set(HEADING,"Drucker (Kopieren)");
      $this->app->PageBuilder->CreateGen("drucker_copy.tpl");
  }

  function DruckerDelete(){
    $this->app->Tpl->Set(HEADING,"Drucker (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("drucker_delete.tpl");
  }

  function DruckerList(){
    $this->app->Tpl->Set(HEADING,"Drucker (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("drucker_list.tpl");
  }

} 
?>