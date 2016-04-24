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


class BestellungPDF extends Briefpapier {
  public $doctype;

  function BestellungPDF($app,$projekt="")
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="bestellung";
    $this->doctypeOrig="Bestellung";
    $this->bestellungohnepreis=0;
    parent::Briefpapier($this->app,$projekt);
  } 


  function GetBestellung($id)
  {
    $adresse = $this->app->DB->Select("SELECT adresse FROM bestellung WHERE id='$id' LIMIT 1");
    //$this->setRecipientDB($adresse);
    $this->setRecipientLieferadresse($id,"bestellung");

    // OfferNo, customerId, OfferDate

    $kundennummer = $this->app->DB->Select("SELECT kundennummerlieferant FROM adresse WHERE id='$adresse' LIMIT 1");
    $kundennummer = $this->app->erp->ReadyForPDF($kundennummer);
    $sprache = $this->app->DB->Select("SELECT sprache FROM adresse WHERE id='$adresse' LIMIT 1");
    $this->sprache = $sprache;
    $this->app->erp->BeschriftungSprache($sprache);
    $angebot = $this->app->DB->Select("SELECT angebot FROM bestellung WHERE id='$id' LIMIT 1");
    $angebot = $this->app->erp->ReadyForPDF($angebot);

    $keineartikelnummern = $this->app->DB->Select("SELECT keineartikelnummern FROM bestellung WHERE id='$id' LIMIT 1");
    $artikelnummerninfotext = $this->app->DB->Select("SELECT artikelnummerninfotext FROM bestellung WHERE id='$id' LIMIT 1");
    $einkaeufer = $this->app->DB->Select("SELECT einkaeufer FROM bestellung WHERE id='$id' LIMIT 1");
    $einkaeufer = $this->app->erp->ReadyForPDF($einkaeufer);

    $ustid = $this->app->DB->Select("SELECT ustid FROM bestellung WHERE id='$id' LIMIT 1");
    $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM bestellung WHERE id='$id' LIMIT 1");
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM bestellung WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM bestellung WHERE id='$id' LIMIT 1");
    $freitext = $this->app->DB->Select("SELECT freitext FROM bestellung WHERE id='$id' LIMIT 1");

    $ohne_briefpapier = $this->app->DB->Select("SELECT ohne_briefpapier FROM bestellung WHERE id='$id' LIMIT 1");
    $this->bestellungohnepreis = $this->app->DB->Select("SELECT bestellungohnepreis FROM bestellung WHERE id='$id' LIMIT 1");

    if($this->bestellungohnepreis)
      $this->nichtsichtbar_summe=1;

    if($ohne_briefpapier=="1")
    {
      $this->logofile = "";
      $this->briefpapier="";
      $this->briefpapier2="";
    }

    if($belegnr=="" || $belegnr=="0") $belegnr = "- ".$this->app->erp->Beschriftung("dokument_entwurf");

    $this->doctypeOrig=$this->app->erp->Beschriftung("dokument_bestellung")." $belegnr";

    if($angebot=="") $angebot = "-";
    if($kundennummer=="") $kundennummer= "-";

    if(!$this->app->erp->BestellungMitUmsatzeuer($id)){
      $this->ust_befreit=true;
    }

    $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_bestellung_angebotnummer")=>$angebot,
      $this->app->erp->Beschriftung("dokument_bestellung_unserekundennummer")=>$kundennummer,
      $this->app->erp->Beschriftung("dokument_bestelldatum")=>$datum,
      $this->app->erp->Beschriftung("dokument_bestellung_einkauf")=>$einkaeufer));

    if(!$this->app->erp->BestellungMitUmsatzeuer($id) && $ustid!="" )
    {
      //$steuer = "\nSteuerfreie innergemeinschaftliche Lieferung. Ihre USt-IdNr. $ustid Land: $land";
      $this->ust_befreit=true;
      if($keinsteuersatz!="1")
        $steuer = $this->app->erp->Beschriftung("eu_lieferung_vermerk");
      $steuer = str_replace('{USTID}',$ustid,$steuer);
      $steuer = str_replace('{LAND}',$land,$steuer);
    }

    $body=$this->app->erp->Beschriftung("bestellung_header");
    $body = $this->app->erp->ParseUserVars("bestellung",$id,$body);


    if($bestellbestaetigung)
    {
      $this->setTextDetails(array(
            "body"=>$body,
            "footer"=>$freitext."\r\nDie Bestellung ist erst nach Eingang einer Bestätigung Ihrerseits gültig. Wird die Bestellung nicht innerhalb einer Woche bestätigt verfällt diese."));
    } else 
    {
      $this->setTextDetails(array(
            "body"=>$body,
            "footer"=>$freitext."\r\n".$this->app->erp->ParseUserVars("bestellung",$id,$this->app->erp->Beschriftung("bestellung_footer"))));
    }
    $artikel = $this->app->DB->SelectArr("SELECT * FROM bestellung_position WHERE bestellung='$id' ORDER By sort");

    //$waehrung = $this->app->DB->Select("SELECT waehrung FROM bestellung_position WHERE bestellung='$id' LIMIT 1");
    foreach($artikel as $key=>$value)
    {

      $lieferdatum = $this->app->String->Convert($value[lieferdatum],"%1-%2-%3","%3.%2.%1");

      if($lieferdatum=="00.00.0000") $lieferdatum =$this->app->erp->Beschriftung("dokument_lieferdatum_sofort");

      if($value[umsatzsteuer] != "ermaessigt") $value[umsatzsteuer] = "normal";

      //	if(!$this->app->erp->BestellungMitUmsatzeuer($id)) $value[umsatzsteuer] = ""; 

      if($keineartikelnummern==1)
        $value[bestellnummer]=$this->app->erp->Beschriftung("dokument_bestellung_keineartikelnummer");

      $value[artikelnummer]=$this->app->DB->Select("SELECT nummer FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");
      if($artikelnummerninfotext)
      {
        $value[beschreibung]= $value[beschreibung]."\n".$this->app->erp->Beschriftung("dokument_bestellung_bestellnummer").": ".$value[bestellnummer];
        $value[bestellnummer]=$value[artikelnummer];


      } else {
        if($value[artikelnummer]!="")
          $value[beschreibung]= $value[beschreibung]."\n".$this->app->erp->Beschriftung("dokument_bestellung_unsereartikelnummer").": ".$value[artikelnummer];
      }

      if($value[vpe] > 1 && is_numeric($value[vpe])) {
        $value[beschreibung] = $value[beschreibung]."\n".$this->app->erp->Beschriftung("dokument_bestellung_mengeinvpe").": ".$value[vpe];
 				//umschalbar in der Zukunft
        $value[preis] = $value[preis]*$value[menge]/($value[menge] / $value[vpe]);
        $value[menge] = round($value[menge] / $value[vpe],2);
        $value[einheit] = "VPE";
			}

      if($value[beschreibung]!="") $newline="\n";

      if($this->bestellungohnepreis) $value[preis] = "-";
  
      if($value[waehrung]!="" && $value[waehrung]!=$this->waehrung)
        $this->waehrung=$value[waehrung];

      $this->addItem(array('currency'=>$value[waehrung],'amount'=>$value[menge],'price'=>$value[preis],
            'tax'=>$value[umsatzsteuer],
            'vpe'=>$value[vpe],
            'unit'=>$value[einheit],
            'itemno'=>$value[bestellnummer],
            'desc'=>$value[beschreibung].$newline.$this->app->erp->Beschriftung("dokument_lieferdatum").": ".$lieferdatum,
            "name"=>$value[bezeichnunglieferant]));
    }

    $summe = $this->app->DB->Select("SELECT SUM(menge*preis) FROM bestellung_position WHERE bestellung='$id'");
    $summeV = $this->app->DB->Select("SELECT SUM(menge*preis) FROM bestellung_position WHERE bestellung='$id' AND (umsatzsteuer='normal' || umsatzsteuer='') ")/100 * $this->app->erp->GetSteuersatzNormal(false,$id,"bestellung");
    $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM bestellung_position WHERE bestellung='$id' AND umsatzsteuer='ermaessigt'")/100 * $this->app->erp->GetSteuersatzErmaessigt(false,$id,"bestellung");


    if($this->bestellungohnepreis!=1)
    {
      if($this->app->erp->BestellungMitUmsatzeuer($id))
      {
        $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe + $summeV + $summeR,"totalTaxV"=>$summeV,"totalTaxR"=>$summeR));
      } else
        $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe));
    }

    /* Dateiname */
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM bestellung WHERE id='$id' LIMIT 1");
    $belegnr= $this->app->DB->Select("SELECT belegnr FROM bestellung WHERE id='$id' LIMIT 1");
    $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
    $tmp_name = str_replace('.','',$tmp_name);

    $this->filename = $datum."_BE".$belegnr.".pdf";
    $this->setBarcode($belegnr);
  }


}
?>
