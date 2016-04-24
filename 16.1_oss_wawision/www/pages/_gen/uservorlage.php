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

class GenUservorlage { 

  function GenUservorlage(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","UservorlageCreate");
    $this->app->ActionHandler("edit","UservorlageEdit");
    $this->app->ActionHandler("copy","UservorlageCopy");
    $this->app->ActionHandler("list","UservorlageList");
    $this->app->ActionHandler("delete","UservorlageDelete");

    $this->app->Tpl->Set(HEADING,"Uservorlage");    $this->app->ActionHandlerListen($app);
  }

  function UservorlageCreate(){
    $this->app->Tpl->Set(HEADING,"Uservorlage (Anlegen)");
      $this->app->PageBuilder->CreateGen("uservorlage_create.tpl");
  }

  function UservorlageEdit(){
    $this->app->Tpl->Set(HEADING,"Uservorlage (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("uservorlage_edit.tpl");
  }

  function UservorlageCopy(){
    $this->app->Tpl->Set(HEADING,"Uservorlage (Kopieren)");
      $this->app->PageBuilder->CreateGen("uservorlage_copy.tpl");
  }

  function UservorlageDelete(){
    $this->app->Tpl->Set(HEADING,"Uservorlage (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("uservorlage_delete.tpl");
  }

  function UservorlageList(){
    $this->app->Tpl->Set(HEADING,"Uservorlage (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("uservorlage_list.tpl");
  }

} 
?>