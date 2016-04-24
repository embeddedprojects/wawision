<?php
include ("_gen/widget.gen.projekt.php");

class WidgetProjekt extends WidgetGenProjekt 
{
  private $app;
  function WidgetProjekt($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenProjekt($app,$parsetarget);
    $this->ExtendsForm();
    $this->ExtendsOutput();
  }

  function ExtendsForm()
  {
     $kommissionierverfahren = array(
    'rechnungsmail'=>'Ohne Lagerbuchung',
    'lieferschein'=>'Einfache Lagerbuchung ohne weiteren Prozess');
    $this->app->Secure->POST["firma"]=$this->app->User->GetFirma();
    $field = new HTMLInput("firma","hidden",$this->app->User->GetFirma());
    $this->form->NewField($field);

    $this->app->YUI->ColorPicker("farbe");
    $this->app->YUI->AutoComplete("kunde","kunde");
    $this->app->YUI->AutoComplete("kasse_laufkundschaft","kunde");


    $this->form->ReplaceFunction("go_standardgewicht",$this,"ReplaceDecimal");

    $this->app->YUI->AutoComplete("kasse_preisgruppe","gruppe");
    $this->form->ReplaceFunction("kasse_preisgruppe",$this,"ReplaceGruppe");

    $this->app->YUI->AutoComplete("abkuerzung","projektname",1);
    $this->app->YUI->AutoComplete("versandprojektfiliale","projektname",1);
    $this->form->ReplaceFunction("versandprojektfiliale",$this,"ReplaceProjekt");

    $this->app->YUI->AutoComplete("filialadresse","kunde");
    $this->form->ReplaceFunction("filialadresse",$this,"ReplaceKunde");

    $this->app->YUI->AutoComplete("auftragid","auftrag",1);

    $this->app->YUI->AutoComplete("kasse_lager","lager");

    $this->app->YUI->AutoComplete("kasse_rabatt_artikel","artikelnummerprojekt");
    $this->form->ReplaceFunction("kasse_rabatt_artikel",$this,"ReplaceArtikel");

    $this->form->ReplaceFunction("auftragid",$this,"ReplaceAuftrag");
    $this->form->ReplaceFunction("kasse_konto",$this,"ReplaceKasse");
    $this->form->ReplaceFunction("kunde",$this,"ReplaceKunde");
    $this->form->ReplaceFunction("abkuerzung",$this,"ReplaceAbkuerzung");
    $this->form->ReplaceFunction("kasse_lager",$this,"ReplaceLager");
    $this->form->ReplaceFunction("kasse_laufkundschaft",$this,"ReplaceKunde");

    $drucker = $this->app->erp->GetDrucker();
    $field = new HTMLSelect("druckerlogistikstufe1",0);
    $field->AddOptionsAsocSimpleArray($drucker);
    $this->form->NewField($field);


    $drucker = $this->app->erp->GetDrucker();
    $field = new HTMLSelect("druckerlogistikstufe2",0);
    $field->AddOptionsAsocSimpleArray($drucker);
    $this->form->NewField($field);


    $drucker = $this->app->erp->GetEtikettendrucker();
    $field = new HTMLSelect("etiketten_drucker",0);
    $field->AddOptionsAsocSimpleArray($drucker);
    $this->form->NewField($field);

    $drucker = $this->app->erp->GetEtiketten();
    $field = new HTMLSelect("etiketten_art",0);
    $field->AddOptionsAsocSimpleArray($drucker);
    $this->form->NewField($field);


    $drucker = $this->app->erp->GetDrucker();
    $field = new HTMLSelect("kasse_drucker",0);
    $field->AddOptionsAsocSimpleArray($drucker);
    $this->form->NewField($field);


    $versandart = $this->app->erp->GetDrucker();
    $field = new HTMLSelect("intraship_drucker",0);
    $field->AddOptionsAsocSimpleArray($versandart);
    $this->form->NewField($field);



    $versandart = $this->app->erp->GetDrucker();
    $field = new HTMLSelect("go_drucker",0);
    $field->AddOptionsAsocSimpleArray($versandart);
    $this->form->NewField($field);

    $laender = $this->app->erp->GetSelectLaenderliste();
    $field = new HTMLSelect("go_land",0);
    $field->AddOptionsAsocSimpleArray($laender);
    $this->form->NewField($field);
    
    
    $field = new HTMLInput("next_angebot","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);
    $field = new HTMLInput("next_auftrag","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);
    $field = new HTMLInput("next_lieferschein","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);
    $field = new HTMLInput("next_rechnung","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);
    $field = new HTMLInput("next_gutschrift","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);
    $field = new HTMLInput("next_bestellung","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);    
    $field = new HTMLInput("next_arbeitsnachweis","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);    
    $field = new HTMLInput("next_reisekosten","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);    
    $field = new HTMLInput("next_produktion","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);    
    $field = new HTMLInput("next_anfrage","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);    
    $field = new HTMLInput("next_kundennummer","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);    
    $field = new HTMLInput("next_lieferantennummer","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);    
    $field = new HTMLInput("next_mitarbeiternummer","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);    
    $field = new HTMLInput("next_artikelnummer","text","",40);
    $field->readonly="readonly";
    $this->form->NewField($field);
    $id = $this->app->Secure->getGET('id');
    if($id) {

      if(!file_exists(dirname(__FILE__).'/../pages/pos.php')){ 
        $this->app->Tpl->Set('POSINFOBOX','<div class="info">Diese Einstellungen sind nur f&uuml;r das Modul POS verf&uuml;gbar!
        Sie k&ouml;nnen das Modul in unerem <a href="http://shop.wawision.de/marktplatz-module">Marktplatz</a> erwerben.</div>');
      }
    }

/*
		$allowed = "/[^a-z0-9]/i"; 
		preg_replace($allowed,"",$this->app->Secure->POST["abkuerzung"]); 
		$this->app->Secure->POST["abkuerzung"]=strtoupper($this->app->Secure->POST["abkuerzung"]);
*/



//    $this->app->YUI->AutoComplete(ADRESSEAUTO,"adresse",array('name','ort','mitarbeiternummer'),"CONCAT(mitarbeiternummer,' ',name)","mitarbeiter");
    $this->app->YUI->AutoComplete("verantwortlicher","mitarbeiter");

    $this->form->ReplaceFunction("adresse",$this,"ReplaceMitarbeiter");

  }

  function ExtendsOutput()
  //function __destruct()
  {
    // formatierte extra ausgaben aus datenbank
    //LIEFERSCHEINBRIEFPAPIER

    $id = $this->app->Secure->GetGET("id");

		if(is_numeric($id))
    $lieferscheinbriefpapier = $this->app->DB->Select("SELECT lieferscheinbriefpapier FROM projekt WHERE id='$id' LIMIT 1");

    $this->app->Tpl->Set('LIEFERSCHEINBRIEFPAPIEROPTIONS',"<option value=1>test $lieferscheinbriefpapier wert 1</option><option value=2>test $lieferscheinbriefpapier wert 2</option>");

  }

  function ReplaceProjekt($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceProjekt($db,$value,$fromform);
  }


  function ReplaceGruppe($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceGruppe($db,$value,$fromform);
  }

  function ReplaceArtikel($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceArtikel($db,$value,$fromform);
  }


  function ReplaceAbkuerzung($db,$abkuerzung,$fromform)
	{
  	$allowed = "/[^a-z0-9]/i";
    $abkuerzung = preg_replace($allowed,"",$abkuerzung);
    return substr(strtoupper($abkuerzung),0,20);
	}


  function ReplaceAdresse($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceAdresse($db,$value,$fromform);
  }


  function ReplaceMitarbeiter($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceMitarbeiter($db,$value,$fromform);
  }

  function ReplaceAuftrag($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceAuftrag($db,$value,$fromform);
  }

  function ReplaceKunde($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceKunde($db,$value,$fromform);
  }


  function ReplaceKasse($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceKasse($db,$value,$fromform);
  }


  function ReplaceLager($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      if(is_numeric($id))
        $abkuerzung = $this->app->DB->Select("SELECT bezeichnung FROM lager WHERE id='$id' LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT id FROM lager WHERE bezeichnung='$value' LIMIT 1");
    }

    // wenn ziel datenbank
    if($db)
    {
      return $id;
    }
    // wenn ziel formular
    else
    {
      return $abkuerzung;
    }
  }

  function ReplaceDecimal($db,$value,$fromform)
  {
    //value muss hier vom format ueberprueft werden

    return str_replace(",",".",$value);
  }


}
?>
