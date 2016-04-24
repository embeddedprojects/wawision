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

class WidgetGenbestellung
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenbestellung($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function bestellungDelete()
  {
    
    $this->form->Execute("bestellung","delete");

    $this->bestellungList();
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
    $this->form = $this->app->FormHandler->CreateNew("bestellung");
    $this->form->UseTable("bestellung");
    $this->form->UseTemplate("bestellung.tpl",$this->parsetarget);

    $field = new HTMLInput("adresse","text","","10","","","","","","","pflicht","0");
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("angebot","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("datum","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("gewuenschteslieferdatum","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("bestellung_bestaetigt","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bestaetigteslieferdatum","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("bestellungbestaetigtper",0,"bestellungbestaetigtper");
    $field->AddOption('Internet','internet');
    $field->AddOption('E-Mail','email');
    $field->AddOption('Telefon','telefon');
    $field->AddOption('Telefax','telefax');
    $field->AddOption('Brief','brief');
    $field->AddOption('Sonstige','sonstige');
    $this->form->NewField($field);

    $field = new HTMLInput("bestellungbestaetigtabnummer","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("abweichendelieferadresse","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("schreibschutz","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("liefername","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferabteilung","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferunterabteilung","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferansprechpartner","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferadresszusatz","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferstrasse","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferplz","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferort","text","","22","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("typ",0,"typ");
    $field->AddOption('Firma','firma');
    $field->AddOption('Herr','herr');
    $field->AddOption('Frau','frau');
    $this->form->NewField($field);

    $field = new HTMLInput("name","text","","35","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("name","notempty","Pflichfeld!","MSGNAME");

    $field = new HTMLInput("telefon","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("ansprechpartner","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("telefax","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("abteilung","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("email","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("unterabteilung","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("anschreiben","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("adresszusatz","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("strasse","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("plz","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("ort","text","","15","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("freitext",5,110);   
    $this->form->NewField($field);

    $field = new HTMLInput("kundennummer","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("zahlungsweise",0,"zahlungsweise");
    $field->AddOption('Rechnung','rechnung');
    $field->AddOption('Vorkasse','vorkasse');
    $field->AddOption('Nachnahme','nachnahme');
    $field->AddOption('Kreditkarte','kreditkarte');
    $field->AddOption('Einzugsermaechtigung','einzugsermaechtigung');
    $field->AddOption('Bar','bar');
    $field->AddOption('PayPal','paypal');
    $this->form->NewField($field);

    $field = new HTMLInput("bearbeiter","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("bestellbestaetigung","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("keineartikelnummern","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("bestellungohnepreis","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("artikelnummerninfotext","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("ohne_briefpapier","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltage","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltageskonto","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszielskonto","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bank_inhaber","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bank_institut","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bank_blz","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bank_konto","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bank_inhaber","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bank_institut","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bank_blz","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bank_konto","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("paypalaccount","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("kreditkarte_typ",0,"kreditkarte_typ");
    $this->form->NewField($field);

    $field = new HTMLInput("kreditkarte_inhaber","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("kreditkarte_nummer","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("kreditkarte_pruefnummer","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("kreditkarte_monat",0,"kreditkarte_monat");
    $this->form->NewField($field);

    $field = new HTMLSelect("kreditkarte_jahr",0,"kreditkarte_jahr");
    $this->form->NewField($field);

    $field = new HTMLTextarea("internebemerkung",2,110);   
    $this->form->NewField($field);

    $field = new HTMLInput("ustid","text","","35","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("ust_befreit",0,"ust_befreit");
    $field->AddOption('Inland','0');
    $field->AddOption('EU-Lieferung','1');
    $field->AddOption('Import','2');
    $this->form->NewField($field);


  }

}

?>