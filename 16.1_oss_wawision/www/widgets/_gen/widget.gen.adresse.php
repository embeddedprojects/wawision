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

class WidgetGenadresse
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenadresse($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function adresseDelete()
  {
    
    $this->form->Execute("adresse","delete");

    $this->adresseList();
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
    $this->form = $this->app->FormHandler->CreateNew("adresse");
    $this->form->UseTable("adresse");
    $this->form->UseTemplate("adresse.tpl",$this->parsetarget);


    $field = new HTMLInput("vorname","hidden","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("typ",0,"typ");
    $field->AddOption('Firma','firma');
    $field->AddOption('Herr','herr');
    $field->AddOption('Frau','frau');
    $this->form->NewField($field);

    $field = new HTMLInput("name","text","","30","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("name","notempty","Pflichtfeld!","MSGNAME");

    $field = new HTMLInput("telefon","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("ansprechpartner","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("telefax","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("titel","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("anschreiben","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("abteilung","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("email","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("unterabteilung","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("mobil","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("adresszusatz","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("internetseite","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("strasse","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("kundenfreigabe",0,"kundenfreigabe");
    $field->AddOption('nein','0');
    $field->AddOption('ja','1');
    $this->form->NewField($field);

    $field = new HTMLInput("plz","text","","4","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("ort","text","","23","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("abweichende_rechnungsadresse","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_vorname","hidden","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("rechnung_typ",0,"rechnung_typ");
    $field->AddOption('Firma','firma');
    $field->AddOption('Herr','herr');
    $field->AddOption('Frau','frau');
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_name","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_telefon","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_ansprechpartner","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_telefax","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_titel","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_anschreiben","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_abteilung","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_email","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_unterabteilung","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_adresszusatz","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_strasse","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_plz","text","","4","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_ort","text","","23","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("ustid","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("steuernummer","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("ust_befreit",0,"ust_befreit");
    $field->AddOption('Deutschland','0');
    $field->AddOption('EU-Lieferung','1');
    $field->AddOption('Export','2');
    $field->AddOption('Steuerfrei Inland','3');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("steuerbefreit","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("sprache",0,"sprache");
    $field->AddOption('Deutsch','deutsch');
    $field->AddOption('Englisch','englisch');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("liefersperre","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("marketingsperre","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("liefersperregrund",5,40);   
    $this->form->NewField($field);

    $field = new HTMLCheckbox("lead","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("folgebestaetigungsperre","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("trackingsperre","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("rechnungsadresse","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("passwort_gesendet","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("sonstiges",20,120);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("infoauftragserfassung",10,120);   
    $this->form->NewField($field);

    $field = new HTMLInput("kundennummer","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferantennummer","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("mitarbeiternummer","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("verbandsnummer","text","","","","","","","","","0");
    $this->form->NewField($field);




    $field = new HTMLCheckbox("zahlungskonditionen_festschreiben","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("zahlungsweise",0,"zahlungsweise");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltage","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltageskonto","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszielskonto","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferantennummerbeikunde","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("zahlungsweiselieferant",0,"zahlungsweiselieferant");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltagelieferant","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszieltageskontolieferant","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlungszielskontolieferant","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("versandartlieferant","text","","","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("kundennummerlieferant","text","","","","","","","","","0");
    $this->form->NewField($field);




    $field = new HTMLInput("inhaber","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bank","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("konto","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("blz","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("swift","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("iban","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("mandatsreferenz","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("mandatsreferenzart",0,"mandatsreferenzart");
    $field->AddOption('Einmalig','einmalig');
    $field->AddOption('Wiederholend','wdh');
    $this->form->NewField($field);

    $field = new HTMLSelect("mandatsreferenzwdhart",0,"mandatsreferenzwdhart");
    $field->AddOption('Erste','erste');
    $field->AddOption('Folge','folge');
    $this->form->NewField($field);

    $field = new HTMLInput("mandatsreferenzdatum","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("mandatsreferenzaenderung","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("waehrung","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("paypalinhaber","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("paypal","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("paypalwaehrung","text","","30","","","","","","","0");
    $this->form->NewField($field);




    $field = new HTMLCheckbox("rechnung_papier","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_anzahlpapier","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("rechnung_permail","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("angebot_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("auftrag_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("gutschrift_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferschein_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bestellung_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("abperfax","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("angebot_fax_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("auftrag_fax_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rechnung_fax_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("gutschrift_fax_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferschein_fax_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bestellung_fax_cc","text","","30","","","","","","","0");
    $this->form->NewField($field);




    $field = new HTMLInput("vertrieb","text","","60","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("provision","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("innendienst","text","","60","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("portofrei_aktiv","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("portofreiab","text","","12","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("versandart",0,"versandart");
    $this->form->NewField($field);

    $field = new HTMLSelect("tour",0,"tour");
    $field->AddOption('Keine feste Tour','0');
    $field->AddOption('Montag','1');
    $field->AddOption('Dienstag','2');
    $field->AddOption('Mittwoch','3');
    $field->AddOption('Donnerstag','4');
    $field->AddOption('Freitag','5');
    $field->AddOption('Samstag','6');
    $field->AddOption('Sonntag','7');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("portofreilieferant_aktiv","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("portofreiablieferant","text","","12","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("kassiereraktiv","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("kassierernummer","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("kassiererprojekt","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("rabatte_festschreiben","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rabatt","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rabatt1","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus1","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus1_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus6","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus6_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rabatt2","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus2","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus2_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus7","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus7_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rabatt3","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus3","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus3_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus8","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus8_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rabatt4","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus4","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus4_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus9","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus9_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("rabatt5","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus5","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus5_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus10","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bonus10_ab","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("rabattinformation",10,120);   
    $this->form->NewField($field);

    $field = new HTMLInput("filiale","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("geburtstag","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("geburtstagkalender","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("verrechnungskontoreisekosten",0,"verrechnungskontoreisekosten");
    $this->form->NewField($field);

    $field = new HTMLInput("sachkonto","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("kreditlimit","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("arbeitszeitprowoche","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld1","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld2","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld3","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld4","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld5","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld6","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld7","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld8","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld9","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("freifeld10","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("kennung","text","","30","","","","","","","0");
    $this->form->NewField($field);



  }

}

?>