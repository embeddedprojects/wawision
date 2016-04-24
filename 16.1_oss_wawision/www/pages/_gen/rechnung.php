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

class GenRechnung { 

  function GenRechnung(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","RechnungCreate");
    $this->app->ActionHandler("edit","RechnungEdit");
    $this->app->ActionHandler("copy","RechnungCopy");
    $this->app->ActionHandler("list","RechnungList");
    $this->app->ActionHandler("delete","RechnungDelete");

    $this->app->Tpl->Set("HEADING","Rechnung");    $this->app->ActionHandlerListen($app);
  }

  function RechnungCreate(){
    $this->app->Tpl->Set("HEADING","Rechnung (Anlegen)");
      $this->app->PageBuilder->CreateGen("rechnung_create.tpl");
  }

  function RechnungEdit(){
    $this->app->Tpl->Set("HEADING","Rechnung (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("rechnung_edit.tpl");
  }

  function RechnungCopy(){
    $this->app->Tpl->Set("HEADING","Rechnung (Kopieren)");
      $this->app->PageBuilder->CreateGen("rechnung_copy.tpl");
  }

  function RechnungDelete(){
    $this->app->Tpl->Set("HEADING","Rechnung (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("rechnung_delete.tpl");
  }

  function RechnungList(){
    $this->app->Tpl->Set("HEADING","Rechnung (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("rechnung_list.tpl");
  }

} 
?>