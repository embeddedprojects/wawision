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

class GenVerrechnungsart { 

  function GenVerrechnungsart(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","VerrechnungsartCreate");
    $this->app->ActionHandler("edit","VerrechnungsartEdit");
    $this->app->ActionHandler("copy","VerrechnungsartCopy");
    $this->app->ActionHandler("list","VerrechnungsartList");
    $this->app->ActionHandler("delete","VerrechnungsartDelete");

    $this->app->Tpl->Set(HEADING,"Verrechnungsart");    $this->app->ActionHandlerListen($app);
  }

  function VerrechnungsartCreate(){
    $this->app->Tpl->Set(HEADING,"Verrechnungsart (Anlegen)");
      $this->app->PageBuilder->CreateGen("verrechnungsart_create.tpl");
  }

  function VerrechnungsartEdit(){
    $this->app->Tpl->Set(HEADING,"Verrechnungsart (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("verrechnungsart_edit.tpl");
  }

  function VerrechnungsartCopy(){
    $this->app->Tpl->Set(HEADING,"Verrechnungsart (Kopieren)");
      $this->app->PageBuilder->CreateGen("verrechnungsart_copy.tpl");
  }

  function VerrechnungsartDelete(){
    $this->app->Tpl->Set(HEADING,"Verrechnungsart (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("verrechnungsart_delete.tpl");
  }

  function VerrechnungsartList(){
    $this->app->Tpl->Set(HEADING,"Verrechnungsart (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("verrechnungsart_list.tpl");
  }

} 
?>