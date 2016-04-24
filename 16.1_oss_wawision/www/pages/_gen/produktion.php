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

class GenProduktion { 

  function GenProduktion(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","ProduktionCreate");
    $this->app->ActionHandler("edit","ProduktionEdit");
    $this->app->ActionHandler("copy","ProduktionCopy");
    $this->app->ActionHandler("list","ProduktionList");
    $this->app->ActionHandler("delete","ProduktionDelete");

    $this->app->Tpl->Set("HEADING","Produktion");    $this->app->ActionHandlerListen($app);
  }

  function ProduktionCreate(){
    $this->app->Tpl->Set("HEADING","Produktion (Anlegen)");
      $this->app->PageBuilder->CreateGen("produktion_create.tpl");
  }

  function ProduktionEdit(){
    $this->app->Tpl->Set("HEADING","Produktion (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("produktion_edit.tpl");
  }

  function ProduktionCopy(){
    $this->app->Tpl->Set("HEADING","Produktion (Kopieren)");
      $this->app->PageBuilder->CreateGen("produktion_copy.tpl");
  }

  function ProduktionDelete(){
    $this->app->Tpl->Set("HEADING","Produktion (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("produktion_delete.tpl");
  }

  function ProduktionList(){
    $this->app->Tpl->Set("HEADING","Produktion (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("produktion_list.tpl");
  }

} 
?>