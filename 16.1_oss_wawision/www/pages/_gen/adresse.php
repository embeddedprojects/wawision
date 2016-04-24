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

class GenAdresse { 

  function GenAdresse(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","AdresseCreate");
    $this->app->ActionHandler("edit","AdresseEdit");
    $this->app->ActionHandler("copy","AdresseCopy");
    $this->app->ActionHandler("list","AdresseList");
    $this->app->ActionHandler("delete","AdresseDelete");

    $this->app->Tpl->Set("HEADING","Adresse");    //$this->app->ActionHandlerListen($app);
  }

  function AdresseCreate(){
    $this->app->Tpl->Set("HEADING","Adresse (Anlegen)");
      $this->app->PageBuilder->CreateGen("adresse_create.tpl");
  }

  function AdresseEdit(){
    $this->app->Tpl->Set("HEADING","Adresse (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("adresse_edit.tpl");
  }

  function AdresseCopy(){
    $this->app->Tpl->Set("HEADING","Adresse (Kopieren)");
      $this->app->PageBuilder->CreateGen("adresse_copy.tpl");
  }

  function AdresseDelete(){
    $this->app->Tpl->Set("HEADING","Adresse (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("adresse_delete.tpl");
  }

  function AdresseList(){
    $this->app->Tpl->Set("HEADING","Adresse (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("adresse_list.tpl");
  }

} 
?>