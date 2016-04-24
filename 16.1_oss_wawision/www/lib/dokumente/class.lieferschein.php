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


class LieferscheinPDF extends Briefpapier {
  public $doctype;

  function LieferscheinPDF($app,$projekt="")
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="lieferschein";
    $this->doctypeOrig="Lieferschein";
    parent::Briefpapier($this->app,$projekt);
  } 


  function GetLieferschein($id,$info="",$extrafreitext="")
  {
    $adresse = $this->app->DB->Select("SELECT adresse FROM lieferschein WHERE id='$id' LIMIT 1");

    // das muss vom lieferschein sein!!!!
    $this->setRecipientLieferadresse($id,"lieferschein");


    // OfferNo, customerId, OfferDate
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1");
    $sprache = $this->app->DB->Select("SELECT sprache FROM adresse WHERE id='$adresse' LIMIT 1");
    $this->sprache = $sprache;
    $this->app->erp->BeschriftungSprache($sprache);
    $auftrag = $this->app->DB->Select("SELECT auftragid FROM lieferschein WHERE id='$id' LIMIT 1");
    $auftrag = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $bearbeiter = $this->app->DB->Select("SELECT bearbeiter FROM lieferschein WHERE id='$id' LIMIT 1");
    $bearbeiter = $this->app->erp->ReadyForPDF($bearbeiter);
    $vertrieb = $this->app->DB->Select("SELECT vertrieb FROM lieferschein WHERE id='$id' LIMIT 1");
    $vertrieb = $this->app->erp->ReadyForPDF($vertrieb);
    $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM lieferschein WHERE id='$id' LIMIT 1");
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM lieferschein WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$id' LIMIT 1");
    $land = $this->app->DB->Select("SELECT land FROM lieferschein WHERE id='$id' LIMIT 1");
    $versandart = $this->app->DB->Select("SELECT versandart FROM lieferschein WHERE id='$id' LIMIT 1");
    $freitext = $this->app->DB->Select("SELECT freitext FROM lieferschein WHERE id='$id' LIMIT 1");
    $this->projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$id' LIMIT 1");

    $ohne_briefpapier = $this->app->DB->Select("SELECT ohne_briefpapier FROM lieferschein WHERE id='$id' LIMIT 1");
    $ihrebestellnummer = $this->app->DB->Select("SELECT ihrebestellnummer FROM lieferschein WHERE id='$id' LIMIT 1");
    $ihrebestellnummer = $this->app->erp->ReadyForPDF($ihrebestellnummer);


    if($ohne_briefpapier=="1")
    {
      $this->logofile = "";
      $this->briefpapier="";
      $this->briefpapier2="";
    }

    $this->doctype="deliveryreceipt";

    if($belegnr=="" || $belegnr=="0") $belegnr = "- ".$this->app->erp->Beschriftung("dokument_entwurf");

    $this->zusatzfooter = " (LS$belegnr)";

    if($info=="")
      $this->doctypeOrig=$this->app->erp->Beschriftung("dokument_lieferschein")." $belegnr";
    else
      $this->doctypeOrig=$this->app->erp->Beschriftung("dokument_lieferschein").$info." $belegnr";

    if($lieferschein=="") $lieferschein = "-";
    if($kundennummer=="") $kundennummer= "-";

    if($bearbeiter==$vertrieb) $vertrieb="";

    //$this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_auftrag")=>$auftrag,"Ihre Kunden-Nr."=>$kundennummer,"Versand"=>$datum,"Versand"=>$bearbeiter));
    $this->setCorrDetails(array($this->app->erp->Beschriftung("dokument_auftrag")=>$auftrag,$this->app->erp->Beschriftung("bezeichnungkundennummer")=>$kundennummer,$this->app->erp->Beschriftung("auftrag_bezeichnung_bestellnummer")=>$ihrebestellnummer,$this->app->erp->Beschriftung("dokument_lieferdatum")=>$datum,$this->app->erp->Beschriftung("auftrag_bezeichnung_bearbeiter")=>$bearbeiter,$this->app->erp->Beschriftung("auftrag_bezeichnung_vertrieb")=>$vertrieb));


    $body=$this->app->erp->Beschriftung("lieferschein_header");
    $body = $this->app->erp->ParseUserVars("lieferschein",$id,$body);

    $this->setTextDetails(array(
          "body"=>$body,
          "footer"=>"$freitext\r\n$extrafreitext\r\n".$this->app->erp->ParseUserVars("lieferschein",$id,$this->app->erp->Beschriftung("lieferschein_footer"))));

    $artikel = $this->app->DB->SelectArr("SELECT * FROM lieferschein_position WHERE lieferschein='$id' ORDER By sort");

    //$waehrung = $this->app->DB->Select("SELECT waehrung FROM lieferschein_position WHERE lieferschein='$id' LIMIT 1");
    foreach($artikel as $key=>$value)
    {
      if($value[seriennummer]!="")
      {
        if( $value[beschreibung]!="")  $value[beschreibung] =  $value[beschreibung]."\n";
        $value[beschreibung] = "SN: ".$value[seriennummer]."\n\n";
      }

      $value['herstellernummer'] = $this->app->DB->Select("SELECT herstellernummer FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");
      $value['hersteller'] = $this->app->DB->Select("SELECT hersteller FROM artikel WHERE id='".$value[artikel]."' LIMIT 1");

      if($value[explodiert_parent_artikel] > 0)
      {
        $check_ausblenden = $this->app->DB->Select("SELECT keineeinzelartikelanzeigen FROM artikel WHERE id='".$value[explodiert_parent_artikel]."' LIMIT 1");
      } else $check_ausblenden=0;
/*
      if($ust_befreit==2 && $value['zolltarifnummer']!="")
      {
        $value[beschreibung] = $value[beschreibung]."\r\nCustoms tariff number: ".$value['zolltarifnummer'];
      }
*/


    if(!$this->app->erp->Export($land))
      {
        $value[zolltarifnummer]="";
        $value[herkunftsland]="";
      }

      if($check_ausblenden!=1)
      {
        $this->addItem(array('amount'=>$value[menge],
              'itemno'=>$value[nummer],
              'desc'=>ltrim($value[beschreibung]),
              'unit'=>$value[einheit],
              'hersteller'=>$value[hersteller],
              'artikelnummerkunde'=>$value['artikelnummerkunde'],
              'lieferdatum'=>$value['lieferdatum'],
              'lieferdatumkw'=>$value['lieferdatumkw'],
              'zolltarifnummer'=>$value[zolltarifnummer],
              'herkunftsland'=>$value[herkunftsland],
              'herstellernummer'=>trim($value[herstellernummer]),
              "name"=>$value[bezeichnung]));
      }
    }


    /* Dateiname */
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM lieferschein WHERE id='$id' LIMIT 1");
    $belegnr= $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$id' LIMIT 1");
    $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
    $tmp_name = str_replace('.','',$tmp_name);

    $this->filename = $datum."_LS".$belegnr.".pdf";
    $this->setBarcode($belegnr);
  }


}
?>
