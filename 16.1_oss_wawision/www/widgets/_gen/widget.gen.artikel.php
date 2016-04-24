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

class WidgetGenartikel
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenartikel($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function artikelDelete()
  {
    
    $this->form->Execute("artikel","delete");

    $this->artikelList();
  }

  function Edit()
  {
    $this->form->Edit();
  }

  function Copy()
  {
    $this->form->Copy();
  }

  public function Create()
  {
    $this->form->Create();
  }

  public function Search()
  {
    $this->app->Tpl->Set($this->parsetarget,"SUUUCHEEE");
  }

  public function Summary()
  {
    $this->app->Tpl->Set($this->parsetarget,"grosse Tabelle");
  }

  function Form()
  {
    $this->form = $this->app->FormHandler->CreateNew("artikel");
    $this->form->UseTable("artikel");
    $this->form->UseTemplate("artikel.tpl",$this->parsetarget);

    $field = new HTMLInput("leerfeld","hidden","","","","","","","","","0");
    $this->form->NewField($field);


    $field = new HTMLInput("name_de","text","","70","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("name_de","notempty","Pflichtfeld!","MSGNAME_DE");

    $field = new HTMLInput("nummer","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("typ",0,"typ");
    $this->form->NewField($field);

    $field = new HTMLInput("adresse","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("anabregs_text",5,70);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("kurztext_de",2,70);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("internerkommentar",4,70);   
    $this->form->NewField($field);

    $field = new HTMLInput("hersteller","text","","45","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("herstellerlink","text","","45","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("herstellernummer","text","","40","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("ean","text","","40","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zolltarifnummer","text","","40","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("herkunftsland","text","","40","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("mindestlager","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("gewicht","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("mindestbestellung","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("laenge","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lager_platz","text","","11","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("breite","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("einheit","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("hoehe","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("lagerartikel","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("porto","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("rabatt","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rabatt_prozent","text","","4","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("variante","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("variante_von","text","","40","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("matrixprodukt","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("umsatzsteuer","","","ermaessigt","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("stueckliste","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("keinrabatterlaubt","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("juststueckliste","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("chargenverwaltung",0,"chargenverwaltung");
    $field->AddOption('keine','0');
    $field->AddOption('eigene erzeugen','1');
    $field->AddOption('originale nutzen','2');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("keineeinzelartikelanzeigen","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("autobestellung","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("seriennummern",0,"seriennummern");
    $field->AddOption('keine','keine');
    $field->AddOption('eigene erzeugen','eigene');
    $field->AddOption('originale nutzen','vomprodukt');
    $field->AddOption('originale einlagern + nutzen','vomprodukteinlagern');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("produktion","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("mindesthaltbarkeitsdatum","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("geraet","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("allelieferanten","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("serviceartikel","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("gebuehr","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("intern_gesperrtgrund",2,70);   
    $this->form->NewField($field);

    $field = new HTMLCheckbox("intern_gesperrt","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("freigabenotwendig","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freigaberegel","text","","","","","","","","","0");
    $this->form->NewField($field);



    $field = new HTMLInput("name_en","text","","70","60","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("kurztext_en",2,70);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("anabregs_text_en",5,70);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("uebersicht_de",2,25);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("uebersicht_en",2,25);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung_de",3,25);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung_en",3,25);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("links_de",2,25);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("links_en",2,25);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("startseite_de",2,25);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("startseite_en",2,25);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("metadescription_de",2,70);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("metadescription_en",2,70);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("metakeywords_de",2,70);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("metakeywords_en",2,70);   
    $this->form->NewField($field);

    $field = new HTMLCheckbox("katalog","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("katalogbezeichnung_de","text","","70","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("katalogbezeichnung_en","text","","70","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("katalogtext_de",6,70);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("katalogtext_en",6,70);   
    $this->form->NewField($field);



    $field = new HTMLInput("freifeld1","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld2","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld3","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld4","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld5","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld6","text","","20","","","","","","","0");
    $this->form->NewField($field);



    $field = new HTMLInput("shop","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("shop2","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("shop3","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("ausverkauft","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("inaktiv","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("autolagerlampe","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("restmenge","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("pseudolager","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferzeitmanuell","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("partnerprogramm_sperre","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("neu","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("topseller","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("startseite","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("downloadartikel","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("pseudopreis","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("generierenummerbeioption","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("autoabgleicherlaubt","","","1","0");
    $this->form->NewField($field);



    $field = new HTMLSelect("steuer_art_produkt",0,"steuer_art_produkt");
    $field->AddOption('Physisches Produkt','1');
    $field->AddOption('Digitaler Inhalt','2');
    $field->AddOption('Dienstleistung','3');
    $this->form->NewField($field);

    $field = new HTMLSelect("steuer_art_produkt_download",0,"steuer_art_produkt_download");
    $field->AddOption('Download','1');
    $field->AddOption('eBook','2');
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_erloese_inland_normal","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_aufwendung_inland_normal","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_erloese_inland_ermaessigt","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_aufwendung_inland_ermaessigt","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_erloese_inland_nichtsteuerbar","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_aufwendung_inland_nichtsteuerbar","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_erloese_inland_steuerfrei","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_aufwendung_inland_steuerfrei","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_erloese_inland_innergemeinschaftlich","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_aufwendung_inland_innergemeinschaftlich","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_erloese_inland_eunormal","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_aufwendung_inland_eunormal","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_erloese_inland_euermaessigt","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_aufwendung_inland_euermaessigt","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_erloese_inland_export","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuer_aufwendung_inland_import","text","","10","","","","","","","0");
    $this->form->NewField($field);


  }

}

?>