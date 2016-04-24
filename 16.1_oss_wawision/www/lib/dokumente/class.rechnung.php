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

class RechnungPDF extends Briefpapier {
  public $doctype;
  public $doctypeid;

  function RechnungPDF($app,$projekt="")
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="rechnung";
    $this->doctypeOrig="Rechnung";
    parent::Briefpapier($this->app,$projekt);
  } 

  function GetRechnung($id,$als="",$doppel=0, $_datum = null)
  {
    $this->doctypeid=$id;
    $adresse = $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$id' LIMIT 1");
    //      $this->setRecipientDB($adresse);
    $this->setRecipientLieferadresse($id,"rechnung");

    // OfferNo, customerId, OfferDate

    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1");
    $sprache = $this->app->DB->Select("SELECT sprache FROM adresse WHERE id='$adresse' LIMIT 1");
    $this->app->erp->BeschriftungSprache($sprache);

    $auftrag= $this->app->DB->Select("SELECT auftrag FROM rechnung WHERE id='$id' LIMIT 1");
    $buchhaltung= $this->app->DB->Select("SELECT buchhaltung FROM rechnung WHERE id='$id' LIMIT 1");
    $bearbeiter= $this->app->DB->Select("SELECT bearbeiter FROM rechnung WHERE id='$id' LIMIT 1");
    $bearbeiter = $this->app->erp->ReadyForPDF($bearbeiter);
    $vertrieb= $this->app->DB->Select("SELECT vertrieb FROM rechnung WHERE id='$id' LIMIT 1");
    $vertrieb = $this->app->erp->ReadyForPDF($vertrieb);
    $lieferschein = $this->app->DB->Select("SELECT lieferschein FROM rechnung WHERE id='$id' LIMIT 1");
    $lieferscheinid = $lieferschein;
    $this->projekt = $this->app->DB->Select("SELECT projekt FROM rechnung WHERE id='$id' LIMIT 1");
    $lieferschein = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$lieferschein' LIMIT 1");
    $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM rechnung WHERE id='$id' LIMIT 1");
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");
    $mahnwesen_datum = $this->app->DB->Select("SELECT DATE_FORMAT(mahnwesen_datum,'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");
    $lieferdatum = $this->app->DB->Select("SELECT DATE_FORMAT(lieferdatum,'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");

    if($doppel!=1)
      $doppel = $this->app->DB->Select("SELECT doppel FROM rechnung WHERE id='$id' LIMIT 1");

    $freitext = $this->app->DB->Select("SELECT freitext FROM rechnung WHERE id='$id' LIMIT 1");
    $systemfreitext = $this->app->DB->Select("SELECT systemfreitext FROM rechnung WHERE id='$id' LIMIT 1");
    $ustid = $this->app->DB->Select("SELECT ustid FROM rechnung WHERE id='$id' LIMIT 1");
    $this->anrede = $this->app->DB->Select("SELECT typ FROM rechnung WHERE id='$id' LIMIT 1");
    $keinsteuersatz = $this->app->DB->Select("SELECT keinsteuersatz FROM rechnung WHERE id='$id' LIMIT 1");
    $soll = $this->app->DB->Select("SELECT soll FROM rechnung WHERE id='$id' LIMIT 1");
    $ist = $this->app->DB->Select("SELECT ist FROM rechnung WHERE id='$id' LIMIT 1");
    $land = $this->app->DB->Select("SELECT land FROM rechnung WHERE id='$id' LIMIT 1");
    $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM rechnung WHERE id='$id' LIMIT 1");
    $zahlungsstatus = $this->app->DB->Select("SELECT zahlungsstatus FROM rechnung WHERE id='$id' LIMIT 1");
    $zahlungszieltage = $this->app->DB->Select("SELECT zahlungszieltage FROM rechnung WHERE id='$id' LIMIT 1");
    $zahlungszieltageskonto = $this->app->DB->Select("SELECT zahlungszieltageskonto FROM rechnung WHERE id='$id' LIMIT 1");
    $zahlungszielskonto = $this->app->DB->Select("SELECT zahlungszielskonto FROM rechnung WHERE id='$id' LIMIT 1");
    $ohne_briefpapier = $this->app->DB->Select("SELECT ohne_briefpapier FROM rechnung WHERE id='$id' LIMIT 1");
    $ihrebestellnummer = $this->app->DB->Select("SELECT ihrebestellnummer FROM rechnung WHERE id='$id' LIMIT 1");
    $ust_befreit = $this->app->DB->Select("SELECT ust_befreit FROM rechnung WHERE id='$id' LIMIT 1");
    $ihrebestellnummer = $this->app->erp->ReadyForPDF($ihrebestellnummer);

    if($ohne_briefpapier=="1")
    {
      $this->logofile = "";
      $this->briefpapier="";
      $this->briefpapier2="";
    }

    $zahlungdatum = $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD(datum, INTERVAL $zahlungszieltage DAY),'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");
    $zahlungszielskontodatum = $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD(datum, INTERVAL $zahlungszieltageskonto DAY),'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");

    if(!$this->app->erp->RechnungMitUmsatzeuer($id)){
      $this->ust_befreit=true;
    }


    $zahlungsweise = strtolower($zahlungsweise);
    //if($zahlungsweise=="rechnung"&&$zahlungsstatus!="bezahlt")
    if($zahlungsweise=="rechnung" || $zahlungsweise=="einzugsermaechtigung" || $zahlungsweise=="lastschrift")
    {

      if($zahlungsweise=="rechnung")
      {
        if($zahlungszieltage==0){
          $zahlungsweisetext = $this->app->erp->Beschriftung("zahlung_rechnung_sofort_de");
          if($zahlungsweisetext=="") $zahlungsweisetext ="Rechnung zahlbar sofort. ";
        }
        else {
          $zahlungsweisetext = $this->app->erp->Beschriftung("zahlung_rechnung_de");
          if($zahlungsweisetext=="") $zahlungsweisetext ="Rechnung zahlbar innerhalb von {ZAHLUNGSZIELTAGE} Tagen bis zum {ZAHLUNGBISDATUM}. ";
          $zahlungsweisetext = str_replace("{ZAHLUNGSZIELTAGE}",$zahlungszieltage,$zahlungsweisetext);
          $zahlungsweisetext = str_replace("{ZAHLUNGBISDATUM}",$zahlungdatum,$zahlungsweisetext);
        }

        if($zahlungszielskonto!=0)
        {
          $zahlungsweisetext .="\n".$this->app->erp->Beschriftung("dokument_skonto")." $zahlungszielskonto % ".$this->app->erp->Beschriftung("dokument_innerhalb")." $zahlungszieltageskonto ".$this->app->erp->Beschriftung("dokument_tagebiszum")." ".$zahlungszielskontodatum;	
        }
      } else {
        //lastschrift
        $zahlungsweisetext = $this->app->erp->Beschriftung("zahlung_".$zahlungsweise."_de");
        if($zahlungsweisetext=="") $zahlungsweisetext ="Der Betrag wird von Ihrem Konto abgebucht.";
        if($zahlungszielskonto!=0)
          $zahlungsweisetext .="\r\n".$this->app->erp->Beschriftung("dokument_skonto")." $zahlungszielskonto % aus Zahlungskonditionen";	
      }

    } 
    else {
      $zahlungsweisetext = $this->app->erp->Beschriftung("zahlung_".$zahlungsweise."_de");
      if($zahlungsweisetext=="" || $zahlungsweise=="vorkasse")
        $zahlungsweisetext = "Bezahlung per ".ucfirst($zahlungsweise);
    }

    if($zahlungszielskonto!=0)
    {
      $zahlungsweisetext = str_replace("{ZAHLUNGSZIELSKONTO}",$zahlungszielskonto,$zahlungsweisetext);
      $zahlungsweisetext = str_replace("{ZAHLUNGSZIELTAGESKONTO}",$zahlungszieltageskonto,$zahlungsweisetext);
      $zahlungsweisetext = str_replace("{ZAHLUNGSZIELSKONTODATUM}",$zahlungszielskontodatum,$zahlungsweisetext);
    } else {
      $zahlungsweisetext = str_replace("{ZAHLUNGSZIELSKONTO}","",$zahlungsweisetext);
      $zahlungsweisetext = str_replace("{ZAHLUNGSZIELTAGESKONTO}","",$zahlungsweisetext);
      $zahlungsweisetext = str_replace("{ZAHLUNGSZIELSKONTODATUM}","",$zahlungsweisetext);
    }

    if($belegnr=="" || $belegnr=="0") $belegnr = "- ".$this->app->erp->Beschriftung("dokument_entwurf");
    else {
      if($doppel==1 || $als=="doppel")
        $belegnr .= " (".$this->app->erp->Beschriftung("dokument_rechnung_kopie").")";
    }

    if($als=="zahlungserinnerung") 
      $this->doctypeOrig="Zahlungserinnerung vom ".(is_null($_datum)?$mahnwesen_datum:$_datum);
    else if($als=="mahnung1") 
      $this->doctypeOrig="1. Mahnung vom ".(is_null($_datum)?$mahnwesen_datum:$_datum);
    else if($als=="mahnung2") 
      $this->doctypeOrig="2. Mahnung vom ".(is_null($_datum)?$mahnwesen_datum:$_datum);
    else if($als=="mahnung3") 
      $this->doctypeOrig="3. Mahnung vom ".(is_null($_datum)?$mahnwesen_datum:$_datum);
    else if($als=="inkasso") 
      $this->doctypeOrig="Inkasso-Mahnung vom ".(is_null($_datum)?$mahnwesen_datum:$_datum);
    else
      $this->doctypeOrig=$this->app->erp->Beschriftung("dokument_rechnung")." $belegnr";

    $this->zusatzfooter = " (RE$belegnr)";

    if($rechnung=="") $rechnung = "-";
    if($kundennummer=="") $kundennummer= "-";

    if($auftrag=="0") $auftrag = "-";
    if($lieferschein=="0") $lieferschein= "-";
    if($lieferschein=="") $lieferschein= "-";

    $datumlieferschein = $this->app->DB->Select("SELECT DATE_FORMAT(datum, '%d.%m.%Y') 
        FROM lieferschein WHERE id='$lieferscheinid' LIMIT 1");

    if($datumlieferschein=="00.00.0000") $datumlieferschein = $datum;
    if($lieferdatum=="00.00.0000") $lieferdatum = $datum;
    if($mahnwesen_datum=="00.00.0000") $mahnwesen_datum = "";

    //* start
    if($vertrieb!=$bearbeiter)
    {
      if($lieferschein!='-')
      {
        if($auftrag!="-")
          $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_auftrag")=>$auftrag,$this->app->erp->Beschriftung("dokument_rechnungsdatum")=>$datum,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,
                $this->app->erp->Beschriftung("dokument_lieferschein")=>$lieferschein,$this->app->erp->Beschriftung("dokument_lieferdatum")=>$datumlieferschein,
                $this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter,$this->app->erp->Beschriftung("auftrag_bezeichnung_vertrieb")=>$vertrieb
                ));
        else
          $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_rechnungsdatum")=>$datum,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,
                $this->app->erp->Beschriftung("dokument_lieferschein")=>$lieferschein,$this->app->erp->Beschriftung("dokument_lieferdatum")=>$datumlieferschein,
                $this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter,$this->app->erp->Beschriftung("auftrag_bezeichnung_vertrieb")=>$vertrieb
                ));
      }
      else {
        if($auftrag!="-")
          $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_auftrag")=>$auftrag,$this->app->erp->Beschriftung("dokument_rechnungsdatum")=>$datum,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,
                $this->app->erp->Beschriftung("dokument_lieferdatum")=>$lieferdatum,
                $this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter,$this->app->erp->Beschriftung("auftrag_bezeichnung_vertrieb")=>$vertrieb
                ));
        else
          $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_rechnungsdatum")=>$datum,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,
                $this->app->erp->Beschriftung("dokument_lieferdatum")=>$lieferdatum,
                $this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter,$this->app->erp->Beschriftung("auftrag_bezeichnung_vertrieb")=>$vertrieb
                ));
      }
      //*ende hack
    } else {
      //start hack
      if($lieferschein!='-')
      {
        if($auftrag!="-")
          $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_auftrag")=>$auftrag,$this->app->erp->Beschriftung("dokument_rechnungsdatum")=>$datum,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,
                $this->app->erp->Beschriftung("dokument_lieferschein")=>$lieferschein,$this->app->erp->Beschriftung("dokument_lieferdatum")=>$datumlieferschein,
                $this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter
                ));
        else
          $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_rechnungsdatum")=>$datum,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,
                $this->app->erp->Beschriftung("dokument_lieferschein")=>$lieferschein,$this->app->erp->Beschriftung("dokument_lieferdatum")=>$datumlieferschein,
                $this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter
                ));
      }
      else {
        if($auftrag!="-")
          $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_auftrag")=>$auftrag,$this->app->erp->Beschriftung("dokument_rechnungsdatum")=>$datum,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,
                $this->app->erp->Beschriftung("dokument_lieferdatum")=>$lieferdatum,
                $this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter
                ));
        else
          $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_rechnungsdatum")=>$datum,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,
                $this->app->erp->Beschriftung("dokument_lieferdatum")=>$lieferdatum,
                $this->app->erp->Beschriftung("dokument_ansprechpartner")=>$buchhaltung
                ));
      }
    }
    //ende hack

    //if(!$this->app->erp->RechnungMitUmsatzeuer($id) && $ustid!="" )
    if(!$this->app->erp->RechnungMitUmsatzeuer($id) && $keinsteuersatz!="1")
    {
      $this->ust_befreit=true;
      if($keinsteuersatz!="1"){
        if($this->app->erp->Export($land))
          $steuer = $this->app->erp->Beschriftung("export_lieferung_vermerk");
        else
          $steuer = $this->app->erp->Beschriftung("eu_lieferung_vermerk");
        $steuer = str_replace('{USTID}',$ustid,$steuer);
        $steuer = str_replace('{LAND}',$land,$steuer);
      }
    }

    if($als!="")
    {
      $body = $this->app->erp->MahnwesenBody($id,$als,$_datum);
      $footer =$this->app->erp->ParseUserVars("rechnung",$id, $this->app->erp->Beschriftung("rechnung_footer"));
    }
    else {
      $body = $this->app->erp->Beschriftung("rechnung_header");
      $body = $this->app->erp->ParseUserVars("rechnung",$id,$body);
      if($systemfreitext!="") $systemfreitext = "\r\n\r\n".$systemfreitext;
      $footer = "$freitext"."\r\n".$this->app->erp->ParseUserVars("rechnung",$id,$this->app->erp->Beschriftung("rechnung_footer").
        "\r\n$steuer\r\n$zahlungsweisetext").$systemfreitext;
    }

    $this->setTextDetails(array(
          "body"=>$body,
          "footer"=>$footer));

    $artikel = $this->app->DB->SelectArr("SELECT * FROM rechnung_position WHERE rechnung='$id' ORDER By sort");
    $summe_rabatt = $this->app->DB->Select("SELECT SUM(rabatt) FROM rechnung_position WHERE rechnung='$id'");
    if($summe_rabatt > 0) $this->rabatt=1;

    if($this->app->erp->Firmendaten("modul_verband")=="1") $this->rabatt=1; 

    foreach($artikel as $key=>$value)
    {
      if($value[umsatzsteuer] != "ermaessigt") $value[umsatzsteuer] = "normal";

      $limit = 60;	
      $summary= $value[bezeichnung];
      if (strlen($summary) > $limit)
      {
        $value[desc]= $value[bezeichnung];
        $value[bezeichnung] = substr($summary, 0, strrpos(substr($summary, 0, $limit), ' ')) . '...';
      }

      $value['herstellernummer'] = $this->app->DB->Select("SELECT herstellernummer FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");
      $value['hersteller'] = $this->app->DB->Select("SELECT hersteller FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");

/*
      $value['zolltarifnummer'] = $this->app->DB->Select("SELECT zolltarifnummer FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");
      $value['herkunftsland'] = $this->app->DB->Select("SELECT herkunftsland FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");

      if($ust_befreit==2 && $value['zolltarifnummer']!="")
      {
        $value[beschreibung] = $value[beschreibung]."\r\nCustoms tariff number: ".$value['zolltarifnummer']." Country of origin: ".$value['herkunftsland'];
      }
*/

      if($value[explodiert_parent_artikel] > 0)
      {
        $check_ausblenden = $this->app->DB->Select("SELECT keineeinzelartikelanzeigen FROM artikel WHERE id='".$value[explodiert_parent_artikel]."' LIMIT 1");
      } else $check_ausblenden=0;


      if(!$this->app->erp->Export($land))
      {
        $value[zolltarifnummer]="";
        $value[herkunftsland]="";
      }


      if($check_ausblenden!=1)
      {
        $this->addItem(array('currency'=>$value[waehrung],
              'amount'=>$value[menge],
              'price'=>$value[preis],
              'tax'=>$value[umsatzsteuer],
              'itemno'=>$value[nummer],
              'unit'=>$value[einheit],
              'desc'=>$value[beschreibung],
              'hersteller'=>$value[hersteller],
              'zolltarifnummer'=>$value[zolltarifnummer],
              'herkunftsland'=>$value[herkunftsland],
              'herstellernummer'=>trim($value[herstellernummer]),
              'artikelnummerkunde'=>$value['artikelnummerkunde'],
              'lieferdatum'=>$value['lieferdatum'],
              'lieferdatumkw'=>$value['lieferdatumkw'],
              'grundrabatt'=>$value[grundrabatt],
              'rabatt1'=>$value[rabatt1],
              'rabatt2'=>$value[rabatt2],
              'rabatt3'=>$value[rabatt3],
              'rabatt4'=>$value[rabatt4],
              'rabatt5'=>$value[rabatt5],
              "name"=>ltrim($value[bezeichnung]),
              "rabatt"=>$value[rabatt]));
      }

      $netto_gesamt = $value[menge]*($value[preis]-($value[preis]/100*$value[rabatt]));
      $summe = $summe + $netto_gesamt;

      if($value[umsatzsteuer]=="" || $value[umsatzsteuer]=="normal")
      {
        $summeV = $summeV + (($netto_gesamt/100)*$this->app->erp->GetSteuersatzNormal(false,$id,"rechnung"));
      }
      else {
        $summeR = $summeR + (($netto_gesamt/100)*$this->app->erp->GetSteuersatzErmaessigt(false,$id,"rechnung"));
      }


    }
    /*
       $summe = $this->app->DB->Select("SELECT SUM(menge*preis) FROM rechnung_position WHERE rechnung='$id'");
       $summeV = $this->app->DB->Select("SELECT SUM(menge*preis) FROM rechnung_position WHERE rechnung='$id' AND (umsatzsteuer!='ermaessigt')")/100 * 19;
       $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM rechnung_position WHERE rechnung='$id' AND umsatzsteuer='ermaessigt'")/100 * 7;
     */     
    if($this->app->erp->RechnungMitUmsatzeuer($id))
    {
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe + $summeV + $summeR,"totalTaxV"=>$summeV,"totalTaxR"=>$summeR));
    } else
    {
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe));
    }

    /* Dateiname */
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM rechnung WHERE id='$id' LIMIT 1");
    $belegnr= $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
    $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
    $tmp_name = str_replace('.','',$tmp_name);

    if($als=="")
      $this->filename = $datum."_RE".$belegnr.".pdf";
    else
      $this->filename = $datum."_MA".$belegnr.".pdf";

    $this->setBarcode($belegnr);
  }


}
?>
