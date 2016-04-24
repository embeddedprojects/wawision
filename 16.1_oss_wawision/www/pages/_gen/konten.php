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

class GenKonten { 

  function GenKonten(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","KontenCreate");
    $this->app->ActionHandler("edit","KontenEdit");
    $this->app->ActionHandler("copy","KontenCopy");
    $this->app->ActionHandler("list","KontenList");
    $this->app->ActionHandler("delete","KontenDelete");

    $this->app->Tpl->Set("HEADING","Konten");    //$this->app->ActionHandlerListen($app);
  }

  function KontenCreate(){
    $this->app->Tpl->Set("HEADING","Konten (Anlegen)");
      $this->app->PageBuilder->CreateGen("konten_create.tpl");
  }

  function KontenEdit(){
    $this->app->Tpl->Set("HEADING","Konten (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("konten_edit.tpl");
  }

  function KontenCopy(){
    $this->app->Tpl->Set("HEADING","Konten (Kopieren)");
      $this->app->PageBuilder->CreateGen("konten_copy.tpl");
  }

  function KontenDelete(){
    $this->app->Tpl->Set("HEADING","Konten (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("konten_delete.tpl");
  }

  function KontenList(){
    $this->app->Tpl->Set("HEADING","Konten (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("konten_list.tpl");
  }

} 
?>