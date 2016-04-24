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

class GenArbeitsnachweis_Position { 

  function GenArbeitsnachweis_Position(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","Arbeitsnachweis_PositionCreate");
    $this->app->ActionHandler("edit","Arbeitsnachweis_PositionEdit");
    $this->app->ActionHandler("copy","Arbeitsnachweis_PositionCopy");
    $this->app->ActionHandler("list","Arbeitsnachweis_PositionList");
    $this->app->ActionHandler("delete","Arbeitsnachweis_PositionDelete");

    $this->app->Tpl->Set(HEADING,"Arbeitsnachweis_Position");    $this->app->ActionHandlerListen($app);
  }

  function Arbeitsnachweis_PositionCreate(){
    $this->app->Tpl->Set(HEADING,"Arbeitsnachweis_Position (Anlegen)");
      $this->app->PageBuilder->CreateGen("arbeitsnachweis_position_create.tpl");
  }

  function Arbeitsnachweis_PositionEdit(){
    $this->app->Tpl->Set(HEADING,"Arbeitsnachweis_Position (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("arbeitsnachweis_position_edit.tpl");
  }

  function Arbeitsnachweis_PositionCopy(){
    $this->app->Tpl->Set(HEADING,"Arbeitsnachweis_Position (Kopieren)");
      $this->app->PageBuilder->CreateGen("arbeitsnachweis_position_copy.tpl");
  }

  function Arbeitsnachweis_PositionDelete(){
    $this->app->Tpl->Set(HEADING,"Arbeitsnachweis_Position (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("arbeitsnachweis_position_delete.tpl");
  }

  function Arbeitsnachweis_PositionList(){
    $this->app->Tpl->Set(HEADING,"Arbeitsnachweis_Position (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("arbeitsnachweis_position_list.tpl");
  }

} 
?>