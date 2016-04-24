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


class AngebotPDF extends Briefpapier {
  public $doctype;

  function AngebotPDF($app,$projekt="")
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="angebot";
    $this->doctypeOrig="Angebot";
    parent::Briefpapier($this->app,$projekt);
  } 

  function GetAngebot($id)
  {
    $adresse = $this->app->DB->Select("SELECT adresse FROM angebot WHERE id='$id' LIMIT 1");
    //$this->setRecipientDB($adresse);
    $this->setRecipientLieferadresse($id,"angebot");

    // OfferNo, customerId, OfferDate
    //$kundennummer = $this->app->DB->Select("SELECT kundennummer FROM angebot WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1");
    $sprache = $this->app->DB->Select("SELECT sprache FROM adresse WHERE id='$adresse' LIMIT 1");
    $this->sprache = $sprache;
    $this->app->erp->BeschriftungSprache($sprache);

    $ustid= $this->app->DB->Select("SELECT ustid FROM angebot WHERE id='$id' LIMIT 1");
    $keinsteuersatz= $this->app->DB->Select("SELECT keinsteuersatz FROM angebot WHERE id='$id' LIMIT 1");
    $land= $this->app->DB->Select("SELECT land FROM angebot WHERE id='$id' LIMIT 1");
    $anfrage= $this->app->DB->Select("SELECT anfrage FROM angebot WHERE id='$id' LIMIT 1");
    $anfrage = $this->app->erp->ReadyForPDF($anfrage);
    $vertrieb= $this->app->DB->Select("SELECT vertrieb FROM angebot WHERE id='$id' LIMIT 1");
    $vertrieb = $this->app->erp->ReadyForPDF($vertrieb);
    $bearbeiter= $this->app->DB->Select("SELECT bearbeiter FROM angebot WHERE id='$id' LIMIT 1");
    $bearbeiter = $this->app->erp->ReadyForPDF($bearbeiter);
    $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM angebot WHERE id='$id' LIMIT 1");
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM angebot WHERE id='$id' LIMIT 1");
    $gueltigbis = $this->app->DB->Select("SELECT DATE_FORMAT(gueltigbis,'%d.%m.%Y') FROM angebot WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
    $freitext = $this->app->DB->Select("SELECT freitext FROM angebot WHERE id='$id' LIMIT 1");
    $this->anrede = $this->app->DB->Select("SELECT typ FROM angebot WHERE id='$id' LIMIT 1");


    $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM angebot WHERE id='$id' LIMIT 1");
    $zahlungsweise = $this->app->erp->ReadyForPDF($zahlungsweise);

    $zahlungsstatus = $this->app->DB->Select("SELECT zahlungsstatus FROM angebot WHERE id='$id' LIMIT 1");
    $angebotersatz = $this->app->DB->Select("SELECT abweichendebezeichnung FROM angebot WHERE id='$id' LIMIT 1");
    $zahlungszieltage = $this->app->DB->Select("SELECT zahlungszieltage FROM angebot WHERE id='$id' LIMIT 1");
    $zahlungszieltageskonto = $this->app->DB->Select("SELECT zahlungszieltageskonto FROM angebot WHERE id='$id' LIMIT 1");
    $zahlungszielskonto = $this->app->DB->Select("SELECT zahlungszielskonto FROM angebot WHERE id='$id' LIMIT 1");
    $this->projekt = $this->app->DB->Select("SELECT projekt FROM angebot WHERE id='$id' LIMIT 1");


    $ohne_briefpapier = $this->app->DB->Select("SELECT ohne_briefpapier FROM angebot WHERE id='$id' LIMIT 1");

    if($ohne_briefpapier=="1")
    {
      $this->logofile = "";
      $this->briefpapier="";
      $this->briefpapier2="";
    }


    //$zahlungstext = "\nZahlungsweise: $zahlungsweise ";
    if($zahlungsweise=="rechnung")
    {
      if($zahlungszieltage >0) $zahlungstext = $this->app->erp->Beschriftung("dokument_zahlung_rechnung_anab");
      else {
        $zahlungstext = $this->app->erp->Beschriftung("zahlung_rechnung_sofort_de");
      }
      if($zahlungszielskonto>0) $zahlungstext .= "\n".$this->app->erp->Beschriftung("dokument_skonto")." $zahlungszielskonto% ".$this->app->erp->Beschriftung("dokument_innerhalb")." $zahlungszieltageskonto ".$this->app->erp->Beschriftung("dokument_tagen");
    } else {
      $zahlungstext = $this->app->erp->Beschriftung("zahlung_".$zahlungsweise."_de");
      if($zahlungstext=="")
        $zahlungstext = "Bezahlung per ".ucfirst($zahlungsweise);
    }

    $zahlungsweise = ucfirst($zahlungsweise);	
 
    if($belegnr=="" || $belegnr=="0") $belegnr = "- ".$this->app->erp->Beschriftung("dokument_entwurf");

    if($angebotersatz)
      $this->doctypeOrig=($this->app->erp->Beschriftung("bezeichnungangebotersatz")?$this->app->erp->Beschriftung("bezeichnungangebotersatz"):$this->app->erp->Beschriftung("dokument_angebot"))." $belegnr";
    else
      $this->doctypeOrig=$this->app->erp->Beschriftung("dokument_angebot")." $belegnr";
    

    $this->zusatzfooter = " (AN$belegnr)";

    if($angebot=="") $angebot = "-";
    if($kundennummer=="") $kundennummer= "-";

    if($vertrieb==$bearbeiter)
      $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_angebot_anfrage")=>$anfrage,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("dokument_datum")=>$datum,$this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter));
    else
      $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_angebot_anfrage")=>$anfrage,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("dokument_datum")=>$datum,$this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter,$this->app->erp->Beschriftung("auftrag_bezeichnung_vertrieb")=>$vertrieb));

    if(!$this->app->erp->AngebotMitUmsatzeuer($id) && $keinsteuersatz!="1")
    {
      if($this->app->erp->Export($land))
        $steuer = $this->app->erp->Beschriftung("export_lieferung_vermerk");
      else
        $steuer = $this->app->erp->Beschriftung("eu_lieferung_vermerk");
      $steuer = str_replace('{USTID}',$ustid,$steuer);
      $steuer = str_replace('{LAND}',$land,$steuer);
    }

    $body=$this->app->erp->Beschriftung("angebot_header");
    $body = $this->app->erp->ParseUserVars("angebot",$id,$body);
    $this->setTextDetails(array(
          "body"=>$body,
          "footer"=>"$freitext\r\n".$this->app->erp->ParseUserVars("angebot",$id,$this->app->erp->Beschriftung("angebot_footer")."\r\n$steuer\r\n$zahlungstext")));

    $artikel = $this->app->DB->SelectArr("SELECT * FROM angebot_position WHERE angebot='$id' ORDER By sort");
    if(!$this->app->erp->AngebotMitUmsatzeuer($id)) $this->ust_befreit=true;

    $summe_rabatt = $this->app->DB->Select("SELECT SUM(rabatt) FROM angebot_position WHERE angebot='$id'");
    if($summe_rabatt > 0) $this->rabatt=1;

    if($this->app->erp->Firmendaten("modul_verband")=="1") $this->rabatt=1; 

    $summe = 0;
    //$waehrung = $this->app->DB->Select("SELECT waehrung FROM angebot_position WHERE angebot='$id' LIMIT 1");
    foreach($artikel as $key=>$value)
    {
      if($value[umsatzsteuer] != "ermaessigt") $value[umsatzsteuer] = "normal";
      // Herstellernummer von Artikel
      $value['herstellernummer'] = $this->app->DB->Select("SELECT herstellernummer FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");
      $value['hersteller'] = $this->app->DB->Select("SELECT hersteller FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");

      $is_angebot_mit_bild=0;
      if($is_angebot_mit_bild) {
          $image_tmp = $this->app->erp->GetArtikelStandardbild($value['artikel']);
          $value['image'] = $image_tmp['image'];
          $value['image_type'] = $image_tmp['extenstion'];
      }

      if($value[optional]=="1") $value[bezeichnung] = "Optional: ".$value[bezeichnung];


      if(!$this->app->erp->Export($land))
      {
        $value[zolltarifnummer]="";
        $value[herkunftsland]="";
      }

      $this->addItem(array('currency'=>$value[waehrung],
            'amount'=>$value[menge],
            'price'=>$value[preis],
            'tax'=>$value[umsatzsteuer],
            'itemno'=>$value[nummer],
            'desc'=>$value[beschreibung],
            'optional'=>$value[optional],
            'unit'=>$value[einheit],
            'hersteller'=>$value[hersteller],
              'zolltarifnummer'=>$value[zolltarifnummer],
              'herkunftsland'=>$value[herkunftsland],
            'herstellernummer'=>trim($value[herstellernummer]),
            'lieferdatum'=>$value['lieferdatum'],
            'lieferdatumkw'=>$value['lieferdatumkw'],
            'artikelnummerkunde'=>$value['artikelnummerkunde'],
            'grundrabatt'=>$value[grundrabatt],
            'rabatt1'=>$value[rabatt1],
            'rabatt2'=>$value[rabatt2],
            'rabatt3'=>$value[rabatt3],
            'rabatt4'=>$value[rabatt4],
            'rabatt5'=>$value[rabatt5],

            "name"=>ltrim($value[bezeichnung]),
            "rabatt"=>$value[rabatt]));

      $netto_gesamt = $value[menge]*($value[preis]-($value[preis]/100*$value[rabatt]));

      if($value[optional]!="1"){
        $summe = $summe + $netto_gesamt;

        if($value[umsatzsteuer]=="" || $value[umsatzsteuer]=="normal")
        {
          $summeV = $summeV + (($netto_gesamt/100)*$this->app->erp->GetSteuersatzNormal(false,$id,"angebot"));
        }
        else {
          $summeR = $summeR + (($netto_gesamt/100)*$this->app->erp->GetSteuersatzErmaessigt(false,$id,"angebot"));
        }
      }
    }

    if($this->app->erp->AngebotMitUmsatzeuer($id))
    {
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe + $summeV + $summeR,"totalTaxV"=>$summeV,"totalTaxR"=>$summeR));
    } else {
      $this->setTotals(array("totalArticles"=>$summe,"total"=>$summe));
    }

    /* Dateiname */
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM angebot WHERE id='$id' LIMIT 1");
    $belegnr= $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
    //$tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
    //$tmp_name = str_replace('.','',$tmp_name);

    $this->filename = $datum."_AN".$belegnr.".pdf";
    $this->setBarcode($belegnr);
  }


}
?>
