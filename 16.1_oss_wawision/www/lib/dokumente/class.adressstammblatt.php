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

class AdressstammblattPDF extends Dokumentenvorlage {
  public $doctype;

  function AdressstammblattPDF($app,$projekt="")
  {
    $this->app=&$app;
    //parent::Dokumentenvorlage();
    $this->doctype="reisekosten";
    $this->doctypeOrig="Adressstammblatt";
    parent::Dokumentenvorlage($this->app,$projekt);
  } 

  public function renderDocument() {
    // prepare page details
    parent::SuperFPDF('P','mm','A4');

    $this->AddPage();
    $this->SetDisplayMode("real","single");

    $this->SetMargins(15,50);
    $this->SetAutoPageBreak(true,40);
    $this->AliasNbPages('{nb}');

    //if($this->barcode!="")
    {
      $y = $this->GetY();
      $this->Code39(155, $y+1, $this->barcode, 1, 5);
    }

    // Bei Adressstammblatt immer oben beginnen
    $this->abstand_betreffzeileoben=0;
    $this->logofile = "";//$this->app->erp->GetTMP()."/".$this->app->Conf->WFdbname."_logo.jpg";
    $this->briefpapier="";

    $this->renderDoctype();

    $adresse = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='".$this->id."'");
    $adresse = reset($adresse);

    if($adresse['typ']=="firma")
    {
      $infofields[]=array("Firma",$adresse['name']);
      if($adresse['ansprechpartner']!="")
      $infofields[]=array("Ansprechpartner",$adresse['ansprechpartner']);
    } else {
      $infofields[]=array("Name",$adresse['name']);
    }

    $infofields[]=array("Anschrift",$adresse['land']."-".$adresse['plz']." ".$adresse['ort'].", ".$adresse['strasse']);

    $felder = array('telefon','telefax','mobil','email','web');
    foreach($felder as $feldname)
    {
      $infofields[]=array(ucfirst($feldname),$adresse[$feldname]);
    }


    if($this->app->erp->Firmendaten("modul_mlm")==1)
    {
      $mlmvertragsbeginn = $this->app->DB->Select("SELECT DATE_FORMAT(mlmvertragsbeginn,'%d.%m.%Y') FROM adresse WHERE id='".$adresse['id']."' LIMIT 1");
      if($mlmvertragsbeginn=="00.00.0000") $mlmvertragsbeginn = "kein Vertragsbeginn eingestellt";
      $sponsorid = $this->app->DB->Select("SELECT sponsor FROM adresse WHERE id='".$adresse['id']."' LIMIT 1");
      if($sponsorid> 0)
        $sponsor = $this->app->DB->Select("SELECT CONCAT(kundennummer,' ',name) FROM adresse WHERE id='$sponsorid' LIMIT 1");
      else
        $sponsor = "Kein Sponsor vorhanden";

      $erfasstam = $this->app->DB->Select("SELECT DATE_FORMAT(zeitstempel,'%d.%m.%Y') FROM objekt_protokoll WHERE objekt='adresse' AND objektid='".$adresse['id']."'                         AND action_long='adresse_create' LIMIT 1");

      $infofields[]=array("Sponsor",$sponsor);
      $infofields[]=array("Erfasst am",$erfasstam);
      $infofields[]=array("Vertragsbeginn am",$mlmvertragsbeginn);
    }

    $this->renderInfoBox($infofields);

    $this->Ln(5);


    $adresse['sonstiges'] = utf8_decode($adresse['sonstiges']);
    $adresse['sonstiges'] = html_entity_decode($adresse['sonstiges']);
    $adresse['sonstiges'] = str_replace("&euro;","EUR",$adresse['sonstiges']);

//echo $adresse['sonstiges'];

    $this->SetFont($this->GetFont(),'',7);
    $this->MultiCell(180,4,$this->WriteHTML(" ".$adresse['sonstiges']));

    $this->renderFooter();
  }



  function GetAdressstammblatt($id,$info="",$extrafreitext="")
  {
    $this->id = $id;
    // das muss vom reisekosten sein!!!!
    //$this->setRecipientLieferadresse($id,"reisekosten");

    // OfferNo, customerId, OfferDate
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1");
    $auftrag = $this->app->DB->Select("SELECT auftragid FROM reisekosten WHERE id='$id' LIMIT 1");
    $auftrag = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $bearbeiter = $this->app->DB->Select("SELECT bearbeiter FROM reisekosten WHERE id='$id' LIMIT 1");
    $prefix = $this->app->DB->Select("SELECT prefix FROM reisekosten WHERE id='$id' LIMIT 1");
    $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM reisekosten WHERE id='$id' LIMIT 1");
    $this->datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM reisekosten WHERE id='$id' LIMIT 1");

    $this->von = $this->app->DB->Select("SELECT DATE_FORMAT(von,'%d.%m.%Y') FROM reisekosten WHERE id='$id' LIMIT 1");
    $this->bis = $this->app->DB->Select("SELECT DATE_FORMAT(bis,'%d.%m.%Y') FROM reisekosten WHERE id='$id' LIMIT 1");
    $this->von_zeit = $this->app->DB->Select("SELECT von_zeit FROM reisekosten WHERE id='$id' LIMIT 1");
    $this->bis_zeit = $this->app->DB->Select("SELECT bis_zeit FROM reisekosten WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM reisekosten WHERE id='$id' LIMIT 1");
    $this->anlass = $this->app->DB->Select("SELECT anlass FROM reisekosten WHERE id='$id' LIMIT 1");
    $this->freitext = $this->app->DB->Select("SELECT freitext FROM reisekosten WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM reisekosten WHERE id='$id' LIMIT 1");
    $mitarbeiter = $this->app->DB->Select("SELECT mitarbeiter FROM reisekosten WHERE id='$id' LIMIT 1");
    $this->name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$mitarbeiter' LIMIT 1");

    $this->firmenname = $this->app->DB->Select("SELECT name FROM firmendaten WHERE firma='".$this->app->User->GetFirma()."' LIMIT 1");
    $this->projektabkuerzung = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$projekt'");

    $this->barcode=$belegnr;

    $ohne_briefpapier = $this->app->DB->Select("SELECT ohne_briefpapier FROM reisekosten WHERE id='$id' LIMIT 1");

    $kunde= $this->app->DB->SelectArr("SELECT name,kundennummer,lieferantennummer FROM adresse WHERE id='$id' LIMIT 1");
    $kunde = reset($kunde);

    if($kunde['lieferantennummer']!="")
      $this->doctypeOrig="Stammdatenblatt Lieferant ".$kunde['lieferantennummer']." ".$kunde['name'];



    if($kunde['kundennummer']!="")
      $this->doctypeOrig="Stammdatenblatt Kunde ".$kunde['kundennummer']." ".$kunde['name'];


    $artikel = $this->app->DB->SelectArr("SELECT *,DATE_FORMAT(datum,'%d.%m.%Y') as datum, CONCAT(rk.nummer,'- ',rk.beschreibung) as reisekostenart FROM reisekosten_position rp LEFT JOIN reisekostenart rk ON rk.id=rp.reisekostenart WHERE rp.reisekosten='$id' ORDER By rp.sort");

    //$waehrung = $this->app->DB->Select("SELECT waehrung FROM reisekosten_position WHERE reisekosten='$id' LIMIT 1");

    /* Dateiname */
    $this->filename = date('Ymd')."_STAMMDATEN_ADRESSE_".$this->app->erp->Dateinamen($kunde['name']).".pdf";

    $this->setBarcode($id);
  }


}
?>
