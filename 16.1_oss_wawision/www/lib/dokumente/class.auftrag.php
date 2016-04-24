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


class AuftragPDF extends Briefpapier {
  public $doctype;

  function AuftragPDF($app,$projekt="",$proforma="")
  {
    $this->app=&$app;
    //parent::Briefpapier();
    if($proforma=="")
    {
      $this->doctypeOrig="Auftrag";
      $this->doctype="auftrag";
    }
    else
    { 
      $this->doctypeOrig="Proformarechnung";
      $this->doctype="proforma";
    }
    parent::Briefpapier($this->app,$projekt);
  } 


  function GetAuftrag($id)
  {
    $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");
    //$this->setRecipientDB($adresse);
    $this->setRecipientLieferadresse($id,"auftrag");


    // OfferNo, customerId, OfferDate

    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1");
    $sprache = $this->app->DB->Select("SELECT sprache FROM adresse WHERE id='$adresse' LIMIT 1");
    $this->sprache = $sprache;
    $this->app->erp->BeschriftungSprache($sprache);

    //$anfrage= $this->app->DB->Select("SELECT angebot FROM auftrag WHERE id='$id' LIMIT 1");
    $angebotid= $this->app->DB->Select("SELECT angebotid FROM auftrag WHERE id='$id' LIMIT 1");
    if($angebotid > 0)
      $angebot= $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$angebotid' LIMIT 1");
    else
      $angebot ="";

    $vertrieb= $this->app->DB->Select("SELECT vertrieb FROM auftrag WHERE id='$id' LIMIT 1");
    $vertrieb = $this->app->erp->ReadyForPDF($vertrieb);
    $bearbeiter= $this->app->DB->Select("SELECT bearbeiter FROM auftrag WHERE id='$id' LIMIT 1");
    $bearbeiter = $this->app->erp->ReadyForPDF($bearbeiter);

    $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM auftrag WHERE id='$id' LIMIT 1");
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM auftrag WHERE id='$id' LIMIT 1");
    $land = $this->app->DB->Select("SELECT land FROM auftrag WHERE id='$id' LIMIT 1");
    $ustid = $this->app->DB->Select("SELECT ustid FROM auftrag WHERE id='$id' LIMIT 1");
    $keinsteuersatz = $this->app->DB->Select("SELECT keinsteuersatz FROM auftrag WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $freitext = $this->app->DB->Select("SELECT freitext FROM auftrag WHERE id='$id' LIMIT 1");
    $this->anrede = $this->app->DB->Select("SELECT typ FROM auftrag WHERE id='$id' LIMIT 1");

    $telefax= $this->app->DB->Select("SELECT telefax FROM auftrag WHERE id='$id' LIMIT 1");

    if($belegnr=="" || $belegnr=="0") $belegnr = "- ".$this->app->erp->Beschriftung("dokument_entwurf");
    if($this->doctype=="auftrag")
      $this->doctypeOrig=$this->app->erp->Beschriftung("dokument_auftrag_auftragsbestaetigung")." $belegnr";
    else
      $this->doctypeOrig=$this->app->erp->Beschriftung("dokument_proformarechnung")." $belegnr";

    $this->zusatzfooter = " (AB$belegnr)";

    if($auftrag=="") $auftrag = "-";
    if($kundennummer=="") $kundennummer= "-";

    $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM auftrag WHERE id='$id' LIMIT 1");
    $zahlungsstatus = $this->app->DB->Select("SELECT zahlungsstatus FROM auftrag WHERE id='$id' LIMIT 1");
    $zahlungszieltage = $this->app->DB->Select("SELECT zahlungszieltage FROM auftrag WHERE id='$id' LIMIT 1");
    $zahlungszieltageskonto = $this->app->DB->Select("SELECT zahlungszieltageskonto FROM auftrag WHERE id='$id' LIMIT 1");
    $zahlungszielskonto = $this->app->DB->Select("SELECT zahlungszielskonto FROM auftrag WHERE id='$id' LIMIT 1");
    $ihrebestellnummer = $this->app->DB->Select("SELECT ihrebestellnummer FROM auftrag WHERE id='$id' LIMIT 1");
    $ihrebestellnummer = $this->app->erp->ReadyForPDF($ihrebestellnummer);

    $ohne_briefpapier = $this->app->DB->Select("SELECT ohne_briefpapier FROM auftrag WHERE id='$id' LIMIT 1");

    if($ohne_briefpapier=="1")
    {
      $this->logofile = "";
      $this->briefpapier="";
      $this->briefpapier2="";
    }

    //$zahlungstext = "\nZahlungsweise: $zahlungsweise ";
    $zahlungstext = "\n".ucfirst($zahlungsweise);

    if($zahlungsweise=="lastschrift" || $zahlungsweise=="einzugsermaechtigung")
      $zahlungsweise="lastschrift";

    if($zahlungsweise=="rechnung")
    {
      // das ist immer ein Vorschlag und keine Rechnung! Daher hier anderen Text!
      if($zahlungszieltage >0) 
        $zahlungstext = $zahlungstext = $this->app->erp->Beschriftung("dokument_zahlung_rechnung_anab");
      else
        $zahlungstext = $this->app->erp->Beschriftung("zahlung_rechnung_sofort_de");

      if($zahlungszielskonto>0) $zahlungstext .= "\n".$this->app->erp->Beschriftung("dokument_skonto")." $zahlungszielskonto% ".$this->app->erp->Beschriftung("dokument_innerhalb")." $zahlungszieltageskonto ".$this->app->erp->Beschriftung("dokument_tagen");
    } 
    else {
      $zahlungstext = $this->app->erp->Beschriftung("zahlung_".$zahlungsweise."_de");          
      if($zahlungstext=="")
        $zahlungstext = "Bezahlung per ".ucfirst($zahlungsweise);

      if($zahlungszielskonto>0) $zahlungstext .= "\n".$this->app->erp->Beschriftung("dokument_skonto")." $zahlungszielskonto% ";
    }

    $zahlungsweise = ucfirst($zahlungsweise);

    if($telefax!="")
    {
      if($vertrieb!=$bearbeiter)
        $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_angebot")=>$angebot,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,
              $this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,$this->app->erp->Beschriftung("dokument_auftragsdatum")=>$datum,"Ihre Faxnummer"=>$telefax,$this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter,$this->app->erp->Beschriftung("auftrag_bezeichnung_vertrieb")=>$vertrieb));
      else
        $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_angebot")=>$angebot,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,$this->app->erp->Beschriftung("dokument_auftragsdatum")=>$datum,"Ihre Faxnummer"=>$telefax,$this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter));
    }
    else
    {
      if($vertrieb!=$bearbeiter)
        $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_angebot")=>$angebot,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,$this->app->erp->Beschriftung("dokument_auftragsdatum")=>$datum,$this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter,$this->app->erp->Beschriftung("auftrag_bezeichnung_vertrieb")=>$vertrieb));
      else
        $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_angebot")=>$angebot,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,$this->app->erp->Beschriftung("dokument_auftragsdatum")=>$datum,$this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter));
    }

    if(!$this->app->erp->AuftragMitUmsatzeuer($id) && $keinsteuersatz!="1") 
    {
      if($this->app->erp->Export($land))
        $steuerzeile = $this->app->erp->Beschriftung("export_lieferung_vermerk");
      else
        $steuerzeile = $this->app->erp->Beschriftung("eu_lieferung_vermerk");
      $steuerzeile = str_replace('{USTID}',$ustid,$steuerzeile);
      $steuerzeile = str_replace('{LAND}',$land,$steuerzeile);
    }



    $body=$this->app->erp->Beschriftung("auftrag_header");
    $body = $this->app->erp->ParseUserVars("auftrag",$id,$body);
    $this->setTextDetails(array(
          "body"=>$body,
          "footer"=>"$freitext\r\n".$this->app->erp->ParseUserVars("auftrag",$id,$this->app->erp->Beschriftung("auftrag_footer")."\r\n$steuerzeile\r\n$zahlungstext")));

    if(!$this->app->erp->AuftragMitUmsatzeuer($id)) $this->ust_befreit=true;

    $artikel = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$id' ORDER By sort");
    $summe_rabatt = $this->app->DB->Select("SELECT SUM(rabatt) FROM auftrag_position WHERE auftrag='$id'");
    if($summe_rabatt > 0) $this->rabatt=1;

    if($this->app->erp->Firmendaten("modul_verband")=="1") $this->rabatt=1;

    //$waehrung = $this->app->DB->Select("SELECT waehrung FROM auftrag_position WHERE auftrag='$id' LIMIT 1");
    foreach($artikel as $key=>$value)
    {
      if($value[umsatzsteuer] != "ermaessigt") $value[umsatzsteuer] = "normal";

      //if(!$this->app->erp->AuftragMitUmsatzeuer($id)) $value[umsatzsteuer] = ""; 
      if($value[explodiert] > 0 ) $value[bezeichnung] = $value[bezeichnung]." (".$this->app->erp->Beschriftung("dokument_stueckliste").")";
      if($value[explodiert_parent] > 0) { $value[preis] = "-"; $value[umsatzsteuer]="hidden"; 
        $value[bezeichnung] = "-".$value[bezeichnung];
        //$value[beschreibung] .= $value[beschreibung]." (Bestandteil von Stückliste)"; 
      }

      // Herstellernummer von Artikel
      $value['herstellernummer'] = $this->app->DB->Select("SELECT herstellernummer FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");
      $value['hersteller'] = $this->app->DB->Select("SELECT hersteller FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");


      if($value[explodiert_parent] > 0)
      {
        $artikelid_tmp = $this->app->DB->Select("SELECT artikel FROM auftrag_position WHERE id='".$value[explodiert_parent]."' LIMIT 1");
        $check_ausblenden = $this->app->DB->Select("SELECT keineeinzelartikelanzeigen FROM artikel WHERE id='".$artikelid_tmp."' LIMIT 1");
      }	else $check_ausblenden=0;


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
              'hersteller'=>trim($value[hersteller]),
              'herstellernummer'=>trim($value[herstellernummer]),
              'zolltarifnummer'=>$value[zolltarifnummer],
              'herkunftsland'=>$value[herkunftsland],
              'lieferdatum'=>$value['lieferdatum'],
              'lieferdatumkw'=>$value['lieferdatumkw'],
              'artikelnummerkunde'=>$value['artikelnummerkunde'],
              'keinrabatterlaubt'=>$value[keinrabatterlaubt],
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
        $summeV = $summeV + (($netto_gesamt/100)*$this->app->erp->GetSteuersatzNormal(false,$id,"auftrag"));
      }
      else {
        $summeR = $summeR + (($netto_gesamt/100)*$this->app->erp->GetSteuersatzErmaessigt(false,$id,"auftrag"));
      }
    }
    /*
       $summe = $this->app->DB->Select("SELECT SUM(menge*preis) FROM auftrag_position WHERE auftrag='$id'");

       $summeV = $this->app->DB->Select("SELECT SUM(menge*preis) FROM auftrag_position WHERE auftrag='$id' AND (umsatzsteuer='normal' or umsatzsteuer='')")/100 * 19;
       $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM auftrag_position WHERE auftrag='$id' AND umsatzsteuer='ermaessigt'")/100 * 7;
     */     
    if($this->app->erp->AuftragMitUmsatzeuer($id))
    {
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe + $summeV + $summeR,"totalTaxV"=>$summeV,"totalTaxR"=>$summeR));
    } else
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe));

    /* Dateiname */
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM auftrag WHERE id='$id' LIMIT 1");
    $belegnr= $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
    $tmp_name = str_replace('.','',$tmp_name);

    if($this->doctype=="auftrag")
      $this->filename = $datum."_AB".$belegnr.".pdf";
    else
      $this->filename = $datum."_PR".$belegnr.".pdf";
    $this->setBarcode($belegnr);
  }


}
?>
