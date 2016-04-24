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

class Einstellungen  {
  var $app;
  
  function Einstellungen($app) {
    $this->app=$app;

    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
      $this->app->Tpl->Set('SUBHEADING',": ".
        $this->app->DB->Select("SELECT nummer FROM artikel WHERE id=$id LIMIT 1"));

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","EinstellungenCreate");
    $this->app->ActionHandler("edit","EinstellungenEdit");
    $this->app->ActionHandler("list","EinstellungenList");


    $this->app->ActionHandlerListen($app);

    $this->app->Tpl->Set('UEBERSCHRIFT',"Einstellungen");
    $this->app->Tpl->Set('FARBE',"[FARBE5]");
  }


  function EinstellungenCreate()
  {
    $this->app->Tpl->Add('TABS',
      "<a class=\"tab\" href=\"index.php?module=artikel&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a>");
  }

  function EinstellungenList()
  {

    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Einstellungen");
		$this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","&Uuml;bersicht");
    $this->app->Tpl->Set('GREYUSERVORLAGE','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYEMAILBACKUP','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYTICKETVORLAGEN','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYUEBERSETZUNGEN','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYKONTORAHMEN','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYKONTEN','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYKOSTENSTELLEN','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYVERRECHNUNGSART','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYARTIKELKATEGORIEN','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYWARTESCHLANGEN','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYARBEITSFREIETAGE','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    $this->app->Tpl->Set('GREYGRUPPEN','<span style="left:0;position:absolute;display:inline-block; z-index=2; width:100%;height:100%;background: rgba(236,236,236,0.5)" ></span>');
    
    
    $this->app->Tpl->Parse('TAB1',"einstellungen.tpl");
    //$this->app->Tpl->Set(TABTEXT,"Einstellungen");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function EinstellungenMenu()
  {
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=edit&id=$id\">Einstellungen</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=edit&id=$id\">St&uuml;ckliste</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=edit&id=$id\">Verkauf</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=edit&id=$id\">Einkauf</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=edit&id=$id\">Projekte</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=edit&id=$id\">Lager</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=edit&id=$id\">Dateien</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=edit&id=$id\">Provisionen</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=etiketten&id=$id\">Etiketten</a>&nbsp;");
    //$this->app->Tpl->Add('TABS',"<a href=\"index.php?module=artikel&action=kosten&id=$id\">Gesamtkalkulation</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=artikel&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a>&nbsp;");
  }


  function EinstellungenEdit()
  {
    $this->EinstellungenMenu();
    $this->app->Tpl->Set('TABLE_ADRESSE_KONTAKTHISTORIE',"TDB");
    $this->app->Tpl->Set('TABLE_ADRESSE_ROLLEN',"TDB");

    $this->app->Tpl->Set('TABLE_ADRESSE_USTID',"TDB");

  }





}

?>
