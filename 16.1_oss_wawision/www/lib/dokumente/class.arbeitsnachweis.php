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


class ArbeitsnachweisPDF extends Briefpapier {
  public $doctype;

  function ArbeitsnachweisPDF($app,$projekt="")
  {
    $this->app=&$app;
    //parent::Briefpapier();
    $this->doctype="arbeitsnachweis";
    $this->doctypeOrig="Arbeitsnachweis";
    parent::Briefpapier($this->app,$projekt);
  } 


  function GetArbeitsnachweis($id,$info="",$extrafreitext="",$formular=false)
  {
    $adresse = $this->app->DB->Select("SELECT adresse FROM arbeitsnachweis WHERE id='$id' LIMIT 1");

    // das muss vom arbeitsnachweis sein!!!!
    $this->setRecipientLieferadresse($id,"arbeitsnachweis");


    // OfferNo, customerId, OfferDate
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1");
    $auftrag = $this->app->DB->Select("SELECT auftragid FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $auftrag = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $bearbeiter = $this->app->DB->Select("SELECT bearbeiter FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $prefix = $this->app->DB->Select("SELECT prefix FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $freitext = $this->app->DB->Select("SELECT freitext FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $this->projekt = $this->app->DB->Select("SELECT projekt FROM arbeitsnachweis WHERE id='$id' LIMIT 1");

    $ohne_briefpapier = $this->app->DB->Select("SELECT ohne_briefpapier FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $anzeige_verrechnungsart = $this->app->DB->Select("SELECT anzeige_verrechnungsart FROM arbeitsnachweis WHERE id='$id' LIMIT 1");

    if($ohne_briefpapier=="1")
    {
      $this->logofile = "";
      $this->briefpapier="";
      $this->briefpapier2="";
    }

    $this->doctype="arbeitsnachweis";
    if($belegnr<=0) $belegnr = "- Entwurf";


    if($info=="")
      $this->doctypeOrig="Arbeitsnachweis $belegnr";
    else
      $this->doctypeOrig="Arbeitsnachweis$info $belegnr";

    if($arbeitsnachweis=="") $arbeitsnachweis = "-";
    if($kundennummer=="") $kundennummer= "-";

    //$this->setCorrDetails(array("Auftrag"=>$auftrag,"Ihre Kunden-Nr."=>$kundennummer,"Versand"=>$datum,"Versand"=>$bearbeiter));
    $this->setCorrDetails(array("Auftrag"=>$auftrag,"Ihre Kunden-Nr."=>$kundennummer,"Datum"=>$datum,"Prefix"=>$prefix,"Bearbeiter"=>$bearbeiter));

    $this->zusatzfooter = "Suffix: ".$prefix;

    $footer_extra = $this->app->erp->ParseUserVars("arbeitsnachweis",$id,$this->app->erp->Firmendaten("arbeitsnachweis_footer"));
    $footer_extra = str_replace("{SUFFIX}",$prefix,$footer_extra);
    $footer_extra = str_replace("{DATUM}",$datum,$footer_extra);


    $body=$this->app->erp->Firmendaten("arbeitsnachweis_header");      
    $body = $this->app->erp->ParseUserVars("arbeitsnachweis",$id,$body);

    $this->setTextDetails(array(
          "body"=>$body,
          "footer"=>"$freitext\r\n$extrafreitext\r\n".$footer_extra));

    $artikel = $this->app->DB->SelectArr("SELECT * FROM arbeitsnachweis_position WHERE arbeitsnachweis='$id' ORDER By sort");

    //$waehrung = $this->app->DB->Select("SELECT waehrung FROM arbeitsnachweis_position WHERE arbeitsnachweis='$id' LIMIT 1");
    if($formular)
    {
      for($reihen=0;$reihen<6;$reihen++)
      {
        $this->addItem(array('amount'=>"",'itemno'=>"",'desc'=>"________________________________________________________",
              "name"=>'',"person"=>''));
      }
    } else {
      foreach($artikel as $key=>$value)
      {

        if($value[seriennummer]!="")
        {
          if( $value[beschreibung]!="")  $value[beschreibung] =  $value[beschreibung]."\n";
          $value[beschreibung] = "Seriennummer: ".$value[seriennummer]."\n\n";
        }

        $value[menge] = $this->app->erp->get_time_difference($value[von].":00",$value[bis].":00");

        $adr_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='{$value[adresse]}' LIMIT 1");

        $add_sum = explode(":", $value[menge]);
        $hour = $hour + $add_sum[0];
        $minutes = $minutes + $add_sum[1];

        // anpassung zeit
        $value[menge] = $this->app->erp->ZeitinMenge($value[menge]);

        $verrechnungsart = $this->app->DB->Select("SELECT verrechnungsart FROM zeiterfassung 
            WHERE arbeitsnachweispositionid='{$value[id]}' LIMIT 1");
        if($verrechnungsart!="" && $anzeige_verrechnungsart==1)
        {
          $verrechnungsart = $this->app->DB->Select("SELECT beschreibung FROM verrechnungsart WHERE nummer='$verrechnungsart' LIMIT 1");
          $value[beschreibung] .= "\r\nVerrechnungsart: ".$verrechnungsart;
        }

        $value[beschreibung] .="\r\nDatum: ".date('d.m.Y',strtotime($value[datum]))." Uhrzeit: ".$value['von']." bis ".$value[bis];


        $this->addItem(array('amount'=>$value[menge],'itemno'=>$value[ort],'desc'=>$value[bemerkung],'desc'=>ltrim($value[beschreibung]),
              "name"=>$value[bezeichnung],"person"=>$adr_name));
      }
    }

    $final_hours = floor($minutes / 60) + $hour;
    $final_minutes = str_pad($minutes % 60,2,'0',STR_PAD_LEFT);
    $summe = $final_hours.":".$final_minutes;

    // anpassung zeit
    $summe = $this->app->erp->ZeitinMenge($summe);

    if(!$formular)
      $this->setTotals(array("total"=>$summe));

    /* Dateiname */
    $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%Y%m%d') FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $belegnr= $this->app->DB->Select("SELECT belegnr FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
    $tmp_name = str_replace(' ','',trim($this->recipient['enterprise']));
    $tmp_name = str_replace('.','',$tmp_name);

    $this->filename = $datum."_ABN".$belegnr.".pdf";
    $this->setBarcode($belegnr);
  }


}
?>
