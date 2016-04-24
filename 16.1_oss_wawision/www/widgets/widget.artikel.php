<?php
include ("_gen/widget.gen.artikel.php");

class WidgetArtikel extends WidgetGenArtikel 
{
  private $app;
  function WidgetArtikel($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenArtikel($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    //$this->app->YUI->AutoComplete(STANDARDLAGERAUTO,"lager_platz",array('kurzbezeichnung'),"kurzbezeichnung");
    //$this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");
    $this->app->YUI->AutoComplete("projekt","projektname",1);
    $this->app->YUI->AutoComplete("adresse","lieferant");
    $this->app->YUI->AutoComplete("typ","artikelgruppe");
    $this->app->YUI->AutoComplete("shop","shopname");
    $this->app->YUI->AutoComplete("shop2","shopname");
    $this->app->YUI->AutoComplete("shop3","shopname");
    $this->app->YUI->AutoComplete("variante_von","artikelnummer");
    $this->app->YUI->AutoComplete("hersteller","hersteller");
    $this->app->YUI->AutoComplete("einheit","artikeleinheit");
    $this->app->YUI->AutoComplete("herstellerlink","herstellerlink");
    $this->app->YUI->AutoComplete("lager_platz","lagerplatz");

    $this->form->ReplaceFunction("adresse",$this,"ReplaceLieferant");
    $this->form->ReplaceFunction("gueltigbis",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("lager_platz",$this,"ReplaceLagerplatz");
    $this->form->ReplaceFunction("shop",$this,"ReplaceShopname");
    $this->form->ReplaceFunction("shop2",$this,"ReplaceShopname");
    $this->form->ReplaceFunction("shop3",$this,"ReplaceShopname");
    $this->form->ReplaceFunction("variante_von",$this,"ReplaceArtikel");
    $this->form->ReplaceFunction("projekt",$this,"ReplaceProjekt");
    $this->form->ReplaceFunction("pseudopreis",$this,"ReplaceDecimal");


    $id = $this->app->Secure->GetGET("id");    
    $action = $this->app->Secure->GetGET("action");    
    $nummer = $this->app->Secure->GetPOST("nummer"); 
    $submit = $this->app->Secure->GetPOST("speichern"); 

    $projekt = $this->app->Secure->GetPOST("projekt"); 
    //$projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
    $projekttmp = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$id' LIMIT 1");
    $artikelart = $this->app->erp->GetArtikelgruppe($projekttmp);

    $field = new HTMLSelect("typ",0);
    $field->AddOptionsSimpleArray($artikelart);
    $this->form->NewField($field);

    $land = $this->app->erp->GetSelectLaenderliste();

    $field = new HTMLSelect("herkunftsland",0);
    $field->AddOptionsSimpleArray($land);
    $this->form->NewField($field);
    
    $field = new HTMLSelect("seriennummern",0,"seriennummern");
    $field->AddOption('keine','keine');
    $this->form->NewField($field);
    
    $field = new HTMLSelect("chargenverwaltung",0,"chargenverwaltung");
    $field->AddOption('keine','0');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("rabatt","","","1");
    $field->onclick="rabattevent();";
    $this->form->NewField($field);

    $field = new HTMLCheckbox("juststueckliste","","","1");
    $field->onclick="juststuecklisteevent(this.form.juststueckliste.value);";
    $this->form->NewField($field);

    /* pruefung Artikel nummer doppel */
    if(is_numeric($id))
      $nummer_db = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
    if(is_numeric($id))
      $artikelart= $this->app->DB->Select("SELECT typ FROM artikel WHERE id='$id' LIMIT 1");

    $anzahl_nummer = $this->app->DB->Select("SELECT count(id) FROM artikel WHERE firma='".$this->app->User->GetFirma()."' AND nummer='$nummer_db'");

    if($nummer > 0)
      $fremde_anzahl_nummer = $this->app->DB->Select("SELECT count(id) FROM artikel WHERE firma='".$this->app->User->GetFirma()."' AND nummer='$nummer' AND id!='$id' AND geloescht=0");
    else $fremde_anzahl_nummer = 0;

    //exec('echo "hallo ('.$submit.') nummer: ('.$nummer.') action:('.$action.')" >> /tmp/test');
    $neuenummervergeben=0;

    if($this->app->erp->Firmendaten("parameterundfreifelder")!=1)
    {
      $this->app->Tpl->Set('DISABLEOPENPARAMETER',"<!--");
      $this->app->Tpl->Set('DISABLECLOSEPARAMETER',"-->");
    } else {

      if($this->app->erp->Firmendaten("freifeld1")!="")
        $this->app->Tpl->Set('FREIFELD1BEZEICHNUNG',$this->app->erp->Firmendaten("freifeld1"));
      else 
        $this->app->Tpl->Set('FREIFELD1BEZEICHNUNG',"Freifeld 1");
      if($this->app->erp->Firmendaten("freifeld2")!="")
        $this->app->Tpl->Set('FREIFELD2BEZEICHNUNG',$this->app->erp->Firmendaten("freifeld2"));
      else 
        $this->app->Tpl->Set('FREIFELD2BEZEICHNUNG',"Freifeld 2");
      if($this->app->erp->Firmendaten("freifeld3")!="")
        $this->app->Tpl->Set('FREIFELD3BEZEICHNUNG',$this->app->erp->Firmendaten("freifeld3"));
      else 
        $this->app->Tpl->Set('FREIFELD3BEZEICHNUNG',"Freifeld 3");
      if($this->app->erp->Firmendaten("freifeld4")!="")
        $this->app->Tpl->Set('FREIFELD4BEZEICHNUNG',$this->app->erp->Firmendaten("freifeld4"));
      else 
        $this->app->Tpl->Set('FREIFELD4BEZEICHNUNG',"Freifeld 4");
      if($this->app->erp->Firmendaten("freifeld5")!="")
        $this->app->Tpl->Set('FREIFELD5BEZEICHNUNG',$this->app->erp->Firmendaten("freifeld5"));
      else 
        $this->app->Tpl->Set('FREIFELD5BEZEICHNUNG',"Freifeld 5");
      if($this->app->erp->Firmendaten("freifeld6")!="")
        $this->app->Tpl->Set('FREIFELD6BEZEICHNUNG',$this->app->erp->Firmendaten("freifeld6"));
      else 
        $this->app->Tpl->Set('FREIFELD6BEZEICHNUNG',"Freifeld 6");

    }



    if($nummer == "" && $action=="edit" && $submit!="")
    { 
      // erst platt machen
      $this->app->DB->Update("UPDATE artikel SET nummer='' WHERE id='$id'");
      $artikelart = $this->app->Secure->GetPOST("typ");
      $neue_nummer = $this->app->erp->GetNextArtikelnummer($artikelart,$this->app->User->GetFirma(),$projekt);
      $nummer_db = $neue_nummer;
      $this->app->Secure->POST["nummer"]=$neue_nummer;

      if($this->app->Conf->WFdbType=="postgre")
        $this->app->DB->Update("UPDATE artikel SET nummer='$neue_nummer' WHERE id='$id'");
      else
        $this->app->DB->Update("UPDATE artikel SET nummer='$neue_nummer' WHERE id='$id' LIMIT 1");

      $field = new HTMLInput("nummer","hidden",$neue_nummer);
      $this->form->NewField($field);

      $this->app->YUI->Message("info","Es wurde eine neue Artikelnummer vergeben.");

      $neuenummervergeben=1;
    } else {
      //$this->app->YUI->Message("info","Es wurde keine neue Artikelnummer vergeben.");
      //exit;

    }

    if($nummer == "" && $action=="create" && $submit!="")
    { 
      //exec('echo  "neu  '.$submit.' '.$nummer.' '.$action.' '.$artikelart.'" >> /tmp/test');
      // erst platt machen
      $artikelart = $this->app->Secure->GetPOST("typ");
      $neue_nummer = $this->app->erp->GetNextArtikelnummer($artikelart,$this->app->User->GetFirma(),$projekt);
      $nummer_db = $neue_nummer;
      $this->app->Secure->POST["nummer"]=$neue_nummer;

      $field = new HTMLInput("nummer","hidden",$neue_nummer);
      $this->form->NewField($field);

      $this->app->YUI->Message("info","Es wurde eine neue Artikelnummer vergeben.");

      $neuenummervergeben=1;
    } 

    if($action=="create")
    {
      if($this->app->erp->Version()=="stock")
      {
        $this->app->Secure->POST["lagerartikel"]=1;
        $field = new HTMLInput("lagerartikel","hidden",1);
        $this->form->NewField($field);
      }
      //$this->app->YUI->Message("info","Es wurde keine neue Artikelnummer vergeben.");
      //exit;
    }






    $already_set=0;
    $anzahl_nummer = $this->app->DB->Select("SELECT count(id) FROM artikel WHERE firma='".$this->app->User->GetFirma()."' AND nummer='$nummer_db' AND geloescht!=1");
    if(($anzahl_nummer > 1 || $fremde_anzahl_nummer > 0) && $neuenummervergeben!=1 && $action=="edit")
    { 
      //$this->app->Tpl->Add(MESSAGE,"<div class=\"error\">Achtung Artikel Nr. doppelt vergeben!</div>");
      $this->app->YUI->Message("error","Achtung! Die Artikelnummer wurde doppelt vergeben!");
    }


    //$this->app->Tpl->Set(KALENDER_GUELTIGBIS,
    //    "<input type=\"button\" value=\"Datum\" onclick=\"displayCalendar(document.forms[0].gueltigbis,'dd.mm.yyyy',this)\">");


    $warengruppe = $this->app->erp->GetArtikelWarengruppe();

    $field = new HTMLSelect("warengruppe",0);
    $field->AddOptionsSimpleArray($warengruppe);
    $this->form->NewField($field);

    $this->app->Secure->POST["firma"]=$this->app->User->GetFirma();
    $field = new HTMLInput("firma","hidden",$this->app->User->GetFirma());
    $this->form->NewField($field);
  }


  function ReplaceDecimal($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceDecimal($db,$value,$fromform);
  }

  function ReplaceProjekt($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceProjekt($db,$value,$fromform);
  }

  function ReplaceDatum($db,$value,$fromform)
  {
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(strpos($value,'-') > 0) $dbformat = 1;

    // wenn ziel datenbank
    if($db)
    { 
      if($dbformat) return $value;
      else return $this->app->String->Convert($value,"%1.%2.%3","%3-%2-%1");
    }
    // wenn ziel formular
    else
    { 
      if($dbformat) return $this->app->String->Convert($value,"%1-%2-%3","%3.%2.%1");
      else return $value;
    }
  }


  function ReplaceShopname($db,$value,$fromform)
  {
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      if(is_numeric($id))
        $abkuerzung = $this->app->DB->Select("SELECT bezeichnung FROM shopexport WHERE id='$id' LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT id FROM shopexport WHERE bezeichnung='$value' LIMIT 1");
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



  function ReplaceLagerplatz($db,$value,$fromform)
  {
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      if(is_numeric($id))
        $abkuerzung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$id' LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$value' LIMIT 1");
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


  function ReplaceLieferant($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceLieferant($db,$value,$fromform);
  }


  function ReplaceArtikel($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceArtikel($db,$value,$fromform);
  }

  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT nummer, name_de as name,barcode, id FROM artikel order by nummer");
    $table->Display($this->parsetarget);
  }



  public function Search()
  {
    //$this->app->Tpl->Set($this->parsetarget,"suchmaske");
    //$this->app->Table(
    //$table = new OrderTable("veranstalter");
    //$table->Heading(array('Name','Homepage','Telefon'));
  }


}
?>
