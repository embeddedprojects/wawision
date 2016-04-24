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

class Netzwerk {
  var $app;
  
  function Netzwerk($app) {
    //parent::GenNetzwerk($app);
    $this->app=&$app;

    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
      $this->app->Tpl->Set(SUBHEADING,": ".
        $this->app->DB->Select("SELECT nummer FROM artikel WHERE id=$id LIMIT 1"));

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","NetzwerkCreate");
    $this->app->ActionHandler("edit","NetzwerkEdit");
    $this->app->ActionHandler("list","NetzwerkList");


    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }


  function NetzwerkCreate()
  {
    $this->app->Tpl->Add(TABS,
      "<a class=\"tab\" href=\"index.php?module=artikel&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a>");
  }

  function NetzwerkMenu()
  {

    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Add(TABS,"<li><h2>Netzwerk</h2></li>");
    $this->app->Tpl->Add(TABS,"<li><a  href=\"index.php?module=netzwerk&action=create&id=$id\">Station registrieren</a></li>");
    $this->app->Tpl->Add(TABS,"<li><a  href=\"index.php?module=netzwerk&action=list&id=$id\">&Uuml;bersicht</a></li>");
  }

  function NetzwerkList()
  {
    $this->NetzwerkMenu();

    $this->app->Tpl->Set(TABTEXT,"&Uuml;bersicht");

    $this->app->Tpl->Parse(TAB1,"netzwerk.tpl");
    $this->app->Tpl->Parse(PAGE,"tabview.tpl");

  }


  function NetzwerkEdit()
  {
    $this->NetzwerkMenu();
    $this->app->Tpl->Set(TABLE_ADRESSE_KONTAKTHISTORIE,"TDB");
    $this->app->Tpl->Set(TABLE_ADRESSE_ROLLEN,"TDB");

    $this->app->Tpl->Set(TABLE_ADRESSE_USTID,"TDB");
  }





}

?>
