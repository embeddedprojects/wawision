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

class GenWiedervorlage { 

  function GenWiedervorlage(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","WiedervorlageCreate");
    $this->app->ActionHandler("edit","WiedervorlageEdit");
    $this->app->ActionHandler("copy","WiedervorlageCopy");
    $this->app->ActionHandler("list","WiedervorlageList");
    $this->app->ActionHandler("delete","WiedervorlageDelete");

    $this->app->Tpl->Set("HEADING","Wiedervorlage");    //$this->app->ActionHandlerListen($app);
  }

  function WiedervorlageCreate(){
    $this->app->Tpl->Set("HEADING","Wiedervorlage (Anlegen)");
      $this->app->PageBuilder->CreateGen("wiedervorlage_create.tpl");
  }

  function WiedervorlageEdit(){
    $this->app->Tpl->Set("HEADING","Wiedervorlage (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("wiedervorlage_edit.tpl");
  }

  function WiedervorlageCopy(){
    $this->app->Tpl->Set("HEADING","Wiedervorlage (Kopieren)");
      $this->app->PageBuilder->CreateGen("wiedervorlage_copy.tpl");
  }

  function WiedervorlageDelete(){
    $this->app->Tpl->Set("HEADING","Wiedervorlage (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("wiedervorlage_delete.tpl");
  }

  function WiedervorlageList(){
    $this->app->Tpl->Set("HEADING","Wiedervorlage (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("wiedervorlage_list.tpl");
  }

} 
?>