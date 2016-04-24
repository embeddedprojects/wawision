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

class YUI {
  
  function YUI(&$app) {

    $this->app = & $app;
  }
  
  function Stroke($fieldstroke, $field) {

    return "if(" . $fieldstroke . ",CONCAT('<s>'," . $field . ",'</s>')," . $field . ")";
  }

  function AARLGEditable() {

    $module = $this->app->Secure->GetGET("module");
    $table = $this->AARLGPositionenModule2Tabelle();
    $id = $this->app->Secure->GetPOST("id"); //ACHTUNG auftrag_positions tabelle id

    $tmp = split('split', $id);
    $id = $tmp[0];
    $column = $tmp[1];
    $value = $this->app->Secure->GetPOST("value");
    $cmd = $this->app->Secure->GetGET("cmd");
    $column = $column - 1;
    
    if ($module == "arbeitsnachweis") {
      
      switch ($column) {
        case 1: // ort

          $this->app->DB->Update("UPDATE $table SET ort='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT ort FROM $table WHERE id='$id' LIMIT 1");
        break;
        case 2: // Datum

          $value = $this->app->String->Convert($value, "%1.%2.%3", "%3-%2-%1");
          $this->app->DB->Update("UPDATE $table SET datum='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT datum FROM $table WHERE id='$id' LIMIT 1");
          $result = $this->app->String->Convert($result, "%3-%2-%1", "%1.%2.%3");
        break;
        case 3: // von

          $this->app->DB->Update("UPDATE $table SET von='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT von FROM $table WHERE id='$id' LIMIT 1");
        break;
        case 4: // bis

          $this->app->DB->Update("UPDATE $table SET bis='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT bis FROM $table WHERE id='$id' LIMIT 1");
        break;
        case 5: //bezeichnung

          $this->app->DB->Update("UPDATE $table SET bezeichnung='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT bezeichnung FROM $table WHERE id='$id' LIMIT 1");
        break;
        default:;
      }
    } else 
    if ($module == "reisekosten") {
      
      switch ($column) {
        case 0: //Datum

          $value = $this->app->String->Convert($value, "%1.%2.%3", "%3-%2-%1");
          $this->app->DB->Update("UPDATE $table SET datum='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT datum FROM $table WHERE id='$id' LIMIT 1");
          $result = $this->app->String->Convert($result, "%3-%2-%1", "%1.%2.%3");
        break;
        case 2: // Betrag

          $value = str_replace(",", ".", $value);
          $this->app->DB->Update("UPDATE $table SET betrag='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT betrag FROM $table WHERE id='$id' LIMIT 1");
        break;
        case 6: // bezeichnung

          $this->app->DB->Update("UPDATE $table SET bezeichnung='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT bezeichnung FROM $table WHERE id='$id' LIMIT 1");
        break;
        default:;
      }
    } else 
    if ($module == "inventur") {
      
      switch ($column) {
        case 0: //Bezeichnung

          $this->app->DB->Update("UPDATE $table SET bezeichnung='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT bezeichnung FROM $table WHERE id='$id' LIMIT 1");
        break;
        case 2: // Nummer

          $this->app->DB->Update("UPDATE $table SET nummer='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT nummer FROM $table WHERE id='$id' LIMIT 1");
        break;
        case 3: // Menge

          $this->app->DB->Update("UPDATE $table SET menge='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT menge FROM $table WHERE id='$id' LIMIT 1");
        break;
        case 4: // preis

          $value = str_replace(",", ".", $value);
          $this->app->DB->Update("UPDATE $table SET preis='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT preis FROM $table WHERE id='$id' LIMIT 1");
        break;
        default:;
      }
    } else 
    if ($module == "produktion") {
    } else {
      
      switch ($column) {
        case 3: // Datum

          $value = $this->app->String->Convert($value, "%1.%2.%3", "%3-%2-%1");
          $this->app->DB->Update("UPDATE $table SET lieferdatum='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT lieferdatum FROM $table WHERE id='$id' LIMIT 1");
          $result = $this->app->String->Convert($result, "%3-%2-%1", "%1.%2.%3");
        break;
        case 4: // Menge

          $value = str_replace(",", ".", $value);
          
          if ($table == "bestellung_position") {

            // schau was mindestmenge bei diesem lieferant ist
            
            //$tmpartikel = $this->app->DB->Select("SELECT artikel FROM $table WHERE id='$id' LIMIT 1");
          }

          $this->app->DB->Update("UPDATE $table SET menge='$value' WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT menge FROM $table WHERE id='$id' LIMIT 1");

          // Menge im Lager reserviert anpassen
                break;
        case 5: //preis

          $value = str_replace(",", ".", $value);
          $this->app->DB->Update("UPDATE $table SET preis='$value' WHERE id='$id' LIMIT 1");
          $this->app->DB->Update("UPDATE $table SET keinrabatterlaubt='1',rabatt=0 WHERE id='$id' LIMIT 1");
          $result = $this->app->DB->Select("SELECT preis FROM $table WHERE id='$id' LIMIT 1");
        break;
        default:;
      }
      if ($table == "auftrag_position") {
        $tmpartikel = $this->app->DB->Select("SELECT artikel FROM $table WHERE id='$id' LIMIT 1");
        $tmptable_value = $this->app->DB->Select("SELECT auftrag FROM $table WHERE id='$id' LIMIT 1");
        $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE artikel='$tmpartikel' AND objekt='auftrag' AND parameter='$tmptable_value'");
        $this->app->erp->AuftragEinzelnBerechnen($tmptable_value);
        $this->app->erp->ANABREGSNeuberechnen($tmptable_value,"auftrag");
      }
      if ($table == "angebot_position") {
        $tmptable_value = $this->app->DB->Select("SELECT angebot FROM $table WHERE id='$id' LIMIT 1");
        $this->app->erp->ANABREGSNeuberechnen($tmptable_value,"angebot");
      }
      if ($table == "rechnung_position") {
        $tmptable_value = $this->app->DB->Select("SELECT rechnung FROM $table WHERE id='$id' LIMIT 1");
        $this->app->erp->ANABREGSNeuberechnen($tmptable_value,"rechnung");
      }
      if ($table == "gutschrift_position") {
        $tmptable_value = $this->app->DB->Select("SELECT gutschrift FROM $table WHERE id='$id' LIMIT 1");
        $this->app->erp->ANABREGSNeuberechnen($tmptable_value,"gutschrift");
      }



    }
    
    if ($cmd == "load") echo "Load";
    else echo $result;
    exit;
  }
  
  function AARLGPositionenModule2Tabelle() {

    $module = $this->app->Secure->GetGET("module");
    
    if ($module == "auftrag") $table = "auftrag_position";
    else 
    if ($module == "angebot") $table = "angebot_position";
    else 
    if ($module == "lieferschein") $table = "lieferschein_position";
    else 
    if ($module == "rechnung") $table = "rechnung_position";
    else 
    if ($module == "gutschrift") $table = "gutschrift_position";
    else 
    if ($module == "bestellung") $table = "bestellung_position";
    else 
    if ($module == "produktion") $table = "produktion_position";
    else 
    if ($module == "arbeitsnachweis") $table = "arbeitsnachweis_position";
    else 
    if ($module == "reisekosten") $table = "reisekosten_position";
    else 
    if ($module == "inventur") $table = "inventur_position";
    else 
    if ($module == "anfrage") $table = "anfrage_position";
    else exit;
    return $table;
  }
  
  function AARLGPositionen($iframe = true) {

    $module = $this->app->Secure->GetGET("module");
    
    if ($this->app->erp->Firmendaten("mysql55") == "1") {
      $extended_mysql55 = ",'de_DE'";
    }
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Select("set @order = 0;");
    $this->app->DB->Update("update " . $module . "_position set sort=@order:= @order + 1 WHERE " . $module . "='$id' order by sort asc");
    
    if ($iframe) {
      $this->app->Tpl->Set('POS', "<iframe name=\"framepositionen\" id=\"framepositionen\" style=\"\" src=\"index.php?module=$module&action=positionen&id=$id\" frameborder=\"no\" width=\"100%\" height=\"850\"></iframe>");
    } else {
      $table = $this->AARLGPositionenModule2Tabelle();

      /* neu anlegen formular */
      $artikelart = $this->app->Secure->GetPOST("artikelart");
      $bezeichnung = $this->app->Secure->GetPOST("bezeichnung");
      $vpe = $this->app->Secure->GetPOST("vpe");
      $umsatzsteuerklasse = $this->app->Secure->GetPOST("umsatzsteuerklasse");
      $waehrung = $this->app->Secure->GetPOST("waehrung");
      $projekt = $this->app->Secure->GetPOST("projekt");
      $preis = $this->app->Secure->GetPOST("preis");
      $preis = str_replace(',', '.', $preis);
      $menge = $this->app->Secure->GetPOST("menge");
      $ort = $this->app->Secure->GetPOST("ort");
      $lieferdatum = $this->app->Secure->GetPOST("lieferdatum");
      $lieferdatum = $this->app->String->Convert($lieferdatum, "%1.%2.%3", "%3-%2-%1");
      $datum = $this->app->Secure->GetPOST("datum");
      $datum = $this->app->String->Convert($datum, "%1.%2.%3", "%3-%2-%1");
      
      if ($lieferdatum == "") $lieferdatum = "00.00.0000";
      $ajaxbuchen = $this->app->Secure->GetPOST("ajaxbuchen");
      
      if ($ajaxbuchen != "") {
        $artikel = $this->app->Secure->GetPOST("artikel");
        $nummer = $this->app->Secure->GetPOST("nummer");
        $projekt = $this->app->Secure->GetPOST("projekt");
        $projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM $table WHERE $module='$id' LIMIT 1");
        $sort = $sort + 1;
        $adresse = $this->app->DB->Select("SELECT adresse FROM $module WHERE id='$id' LIMIT 1");
        $sprache = $this->app->DB->Select("SELECT sprache FROM adresse WHERE id='$adresse' LIMIT 1");
        $artikel_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' LIMIT 1");
        $bezeichnung = $artikel;
        $neue_nummer = $nummer;
        $waehrung = $this->app->DB->Select("SELECT waehrung FROM $module WHERE id='$id' LIMIT 1");
        
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id='$artikel_id' LIMIT 1");
        
        if ($sprache == "englisch") $beschreibung = $this->app->DB->Select("SELECT anabregs_text_en FROM artikel WHERE id='$artikel_id' LIMIT 1");
        else $beschreibung = $this->app->DB->Select("SELECT anabregs_text FROM artikel WHERE id='$artikel_id' LIMIT 1");
        $mlmpunkte = $this->app->DB->Select("SELECT mlmpunkte FROM artikel WHERE id='$artikel_id' LIMIT 1");
        $mlmbonuspunkte = $this->app->DB->Select("SELECT mlmbonuspunkte FROM artikel WHERE id='$artikel_id' LIMIT 1");
        $mlmdirektpraemie = $this->app->DB->Select("SELECT mlmdirektpraemie FROM artikel WHERE id='$artikel_id' LIMIT 1");


        $artikelnummerkunde = $this->app->DB->Select("SELECT kundenartikelnummer FROM verkaufspreise WHERE adresse='$adresse' AND artikel='$artikel_id' AND kundenartikelnummer!='' AND ab_menge <='$menge' AND (gueltig_bis<=NOW() OR gueltig_bis='0000-00-00') ORDER by ab_menge DESC LIMIT 1");
        $zolltarifnummer = $this->app->DB->Select("SELECT zolltarifnummer FROM artikel WHERE id='$artikel_id' LIMIT 1");
        $herkunftsland = $this->app->DB->Select("SELECT herkunftsland FROM artikel WHERE id='$artikel_id' LIMIT 1");

        
        if ($vpe < 1 || !is_numeric($vpe)) $vpe = '1';
        
        if ($module == "lieferschein" && $artikel_id > 0) {
          $this->app->DB->Insert("INSERT INTO $table (id,$module,artikel,bezeichnung,beschreibung,nummer,menge,sort,lieferdatum, status,projekt,vpe,artikelnummerkunde,zolltarifnummer,herkunftsland)
              VALUES ('','$id','$artikel_id','$bezeichnung','$beschreibung','$neue_nummer','$menge','$sort','$lieferdatum','angelegt','$projekt','$vpe','$artikelnummerkunde','$zolltarifnummer','$herkunftsland')");
        } else 
        if ($module == "arbeitsnachweis") {
          $bezeichnung = $this->app->Secure->GetPOST("bezeichnung");
          $von = $this->app->Secure->GetPOST("von");
          $bis = $this->app->Secure->GetPOST("bis");
          $adresse = $this->app->Secure->GetPOST("adresse");
          $adresse = explode(' ', $adresse);
          $adresse = $adresse[0];
          $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE mitarbeiternummer='$adresse' LIMIT 1");
          $this->app->DB->Insert("INSERT INTO $table (id,$module,artikel,bezeichnung,nummer,menge,sort,datum, status,projekt,ort,von,bis,adresse)
              VALUES ('','$id','$artikel_id','$bezeichnung','$neue_nummer','$menge','$sort','$datum','angelegt','$projekt','$ort','$von','$bis','$adresse')");
        } else 
        if ($module == "reisekosten") {
          $bezeichnung = $this->app->Secure->GetPOST("bezeichnung");
          $betrag = $this->app->Secure->GetPOST("betrag");
          $betrag = str_replace(',', '.', $betrag);
          $reisekostenart = $this->app->Secure->GetPOST("reisekostenart");
          $abrechnen = $this->app->Secure->GetPOST("abrechnen");
          $keineust = $this->app->Secure->GetPOST("keineust");
          $uststeuersatz = $this->app->Secure->GetPOST("uststeuersatz");
          $bezahlt_wie = $this->app->Secure->GetPOST("bezahlt_wie");

          /*adresse = $this->app->Secure->GetPOST("adresse");
            $adresse =explode(' ',$adresse);
            $adresse = $adresse[0];
            $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE mitarbeiternummer='$adresse' LIMIT 1");
          */
          $this->app->DB->Insert("INSERT INTO $table (id,$module,artikel,bezeichnung,nummer,menge,sort,datum, status,projekt,ort,von,bis,betrag,bezahlt_wie,reisekostenart,abrechnen,keineust,uststeuersatz)
              VALUES ('','$id','$artikel_id','$bezeichnung','$neue_nummer','$menge','$sort','$datum','angelegt','$projekt','$ort','$von','$bis','$betrag','$bezahlt_wie','$reisekostenart','$abrechnen','$keineust','$uststeuersatz')");
        } else 
        if ($module == "inventur" && $artikel_id > 0) {
          $bezeichnung = $this->app->Secure->GetPOST("artikel");
          $preis = $this->app->Secure->GetPOST("preis");
          $preis = str_replace(',', '.', $preis);
          $nummer = $this->app->Secure->GetPOST("nummer");

          /*adresse = $this->app->Secure->GetPOST("adresse");
            $adresse =explode(' ',$adresse);
            $adresse = $adresse[0];
            $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE mitarbeiternummer='$adresse' LIMIT 1");
          */
          $projekt = $this->app->Secure->GetPOST("projekt");
          $projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
          $sort = $this->app->DB->Select("SELECT MAX(sort) FROM $table WHERE $module='$id' LIMIT 1");
          $sort = $sort + 1;
          $artikel_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' LIMIT 1");
          $this->app->DB->Insert("INSERT INTO $table (id,$module,artikel,bezeichnung,nummer,menge,sort,projekt,preis)
              VALUES ('','$id','$artikel_id','$bezeichnung','$nummer','$menge','$sort','$projekt','$preis')");
        } else 
        if ($module == "anfrage" && $artikel_id > 0) {

          /*
             $bezeichnung = $this->app->Secure->GetPOST("artikel");
             $preis = $this->app->Secure->GetPOST("preis");
             $preis = str_replace(',','.',$preis);
             $nummer = $this->app->Secure->GetPOST("nummer");
          */

          /*adresse = $this->app->Secure->GetPOST("adresse");
            $adresse =explode(' ',$adresse);
            $adresse = $adresse[0];
            $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE mitarbeiternummer='$adresse' LIMIT 1");
          */
          $projekt = $this->app->Secure->GetPOST("projekt");
          $projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
          $sort = $this->app->DB->Select("SELECT MAX(sort) FROM $table WHERE $module='$id' LIMIT 1");
          $sort = $sort + 1;
          $artikel_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' LIMIT 1");
          $this->app->DB->Insert("INSERT INTO $table (id,$module,artikel,bezeichnung,nummer,menge,sort,projekt,preis)
              VALUES ('','$id','$artikel_id','$bezeichnung','$nummer','$menge','$sort','$projekt','$preis')");
        } else 
        if ($module == "bestellung" && $artikel_id > 0) {
          $bestellnummer = $this->app->Secure->GetPOST("bestellnummer");
          $bezeichnunglieferant = $this->app->Secure->GetPOST("bezeichnunglieferant");
          $waehrung = $this->app->Secure->GetPOST("waehrung");

          if($waehrung=="") 
            $waehrung = $this->app->DB->Select("SELECT waehrung FROM $module WHERE id='$id' LIMIT 1");

          //hier muesste man beeichnung bei lieferant auch noch speichern .... oder beides halt
          $this->app->DB->Insert("INSERT INTO $table (id,$module,artikel,bezeichnunglieferant,beschreibung,bestellnummer,menge,sort,lieferdatum, status,projekt,vpe,preis,waehrung,umsatzsteuer)
              VALUES ('','$id','$artikel_id','$bezeichnunglieferant','$beschreibung','$bestellnummer','$menge','$sort','$lieferdatum','angelegt','$projekt','$vpe','$preis','$waehrung','$umsatzsteuer')");
        } else 
        if ($module == "produktion" && $artikel_id > 0) {
        } else 
        if ($module == "gutschrift" && $artikel_id > 0) {

          // mlm punkte bei angebot, auftrag und rechnung
          $this->app->DB->Insert("INSERT INTO $table (id,$module,artikel,beschreibung,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe,artikelnummerkunde,zolltarifnummer,herkunftsland)
              VALUES ('','$id','$artikel_id','$beschreibung','$bezeichnung','$neue_nummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuer','angelegt','$projekt','$vpe','$artikelnummerkunde','$zolltarifnummer','$herkunftsland')");
          $this->app->erp->GutschriftNeuberechnen($id);
        } else 
        if ($module == "auftrag" || $module == "rechnung" || $module == "angebot") {
          
          if ($artikel_id > 0) {

            // mlm punkte bei angebot, auftrag und rechnung
            $this->app->DB->Insert("INSERT INTO $table (id,$module,artikel,beschreibung,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe,punkte,bonuspunkte,mlmdirektpraemie,artikelnummerkunde,zolltarifnummer,herkunftsland)
                VALUES ('','$id','$artikel_id','$beschreibung','$bezeichnung','$neue_nummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuer','angelegt','$projekt','$vpe','$mlmpunkte','$mlmbonuspunkte','$mlmdirektpraemie','$artikelnummerkunde','$zolltarifnummer','$herkunftsland')");
            
            switch ($module) {
              case "angebot":
                $this->app->erp->AngebotNeuberechnen($id);
              break;
              case "auftrag":
                $this->app->erp->AuftragNeuberechnen($id);
                $this->app->erp->AuftragEinzelnBerechnen($id);
              break;
              case "rechnung":
                $this->app->erp->RechnungNeuberechnen($id);
              break;
            }
          }
        } else {
          
          if ($artikel_id > 0) {

            // mlm punkte bei angebot, auftrag und rechnung
            $this->app->DB->Insert("INSERT INTO $table (id,$module,artikel,beschreibung,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe,punkte,bonuspunkte,mlmdirektpraemie)
                VALUES ('','$id','$artikel_id','$beschreibung','$bezeichnung','$neue_nummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuer','angelegt','$projekt','$vpe','$mlmpunkte','$mlmbonuspunkte','$mlmdirektpraemie')");
          }
        }
      }
      
      if ($module == "produktion") {
      }
      
      if ($module == "auftrag") {
        $this->app->erp->AuftragExplodieren($id, "auftrag");
      }

      /* ende neu anlegen formular */
      $this->app->Tpl->Set('SUBSUBHEADING', "Positionen");
      if($module == 'produktion')
      {
        $menu = array("edit" => "positioneneditpopup", "del" => "del{$module}position");        
      } else {
      
      $menu = array("up" => "up{$module}position", "down" => "down{$module}position",

      //"add"=>"addstueckliste",
      "edit" => "positioneneditpopup", "del" => "del{$module}position");
      }
      if ($module == "auftrag") {
        $sql = "SELECT 
          b.sort,
          if(b.explodiert_parent,if(b.beschreibung!='',
                if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT('<i>',SUBSTR(CONCAT(b.bezeichnung,' *'),1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...','</i>'),CONCAT('<i>',b.bezeichnung,' *','</i>')),
                if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT('<i>',SUBSTR(b.bezeichnung,1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...','</i>'),CONCAT('<i>',b.bezeichnung,' (zu St&uuml;ckliste ',(SELECT ba.nummer FROM $table ba WHERE ba.id=b.explodiert_parent LIMIT 1),')</i>'))),
              if(b.beschreibung!='',
                if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),CONCAT(b.bezeichnung,' *')),
                if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(b.bezeichnung,1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),b.bezeichnung))
            )
            as Artikel,



               p.abkuerzung as projekt, b.nummer as nummer, DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, b.preis as preis, b.rabatt as rabatt, b.id as id
                 FROM $table b
                 LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
                 WHERE b.$module='$id' ";

        //WHERE b.$module='$id' AND b.explodiert_parent='0'";
        
      } else 
      if ($module == "lieferschein") {
        $sql = "SELECT 
          b.sort,
          if(b.beschreibung!='',
              if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),CONCAT(b.bezeichnung,' *')),
              if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(b.bezeichnung,1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),b.bezeichnung))
            as Artikel,


               p.abkuerzung as projekt, b.nummer as nummer, DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, if(b.geliefert, b.geliefert,'-') as geliefert, b.id as id
                 FROM $table b
                 LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
                 WHERE b.$module='$id'";
      } else 
      if ($module == "inventur") {
        $sql = "SELECT 
          b.sort,
          if(b.beschreibung!='',
              if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),CONCAT(b.bezeichnung,' *')),
              if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(b.bezeichnung,1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),b.bezeichnung))
            as Artikel,


               p.abkuerzung as projekt, b.nummer as nummer, b.menge as menge, 
               b.preis,

               b.id as id
                 FROM $table b
                 LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
                 WHERE b.$module='$id'";
      } else 
      if ($module == "anfrage") {
        $sql = "SELECT 
          b.sort,
          if(b.beschreibung!='',
              if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),CONCAT(b.bezeichnung,' *')),
              if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(b.bezeichnung,1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),b.bezeichnung))
            as Artikel,


               p.abkuerzung as projekt, b.nummer as nummer, DATE_FORMAT(b.lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, if(b.geliefert, b.geliefert,'-') as geliefert,

               b.id as id
                 FROM $table b
                 LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
                 WHERE b.$module='$id'";
      } else 
      if ($module == "bestellung") {
        
        $check_waehrung = $this->app->DB->Select("SELECT COUNT(DISTINCT waehrung) FROM bestellung_position WHERE bestellung='$id'");
        if($check_waehrung >=2)
        {
          $this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">Achtung es ist mehr als eine W&auml;hrungsart angegeben. In der Bestellung darf nur eine W&auml;hrungsart angeben sein!</div>");
        } else {
          $waehrung_bestellung = $this->app->DB->Select("SELECT waehrung FROM bestellung_position WHERE bestellung='$id' LIMIT 1");
          $this->app->DB->Update("UPDATE bestellung SET waehrung='$waehrung_bestellung' WHERE id='$id' LIMIT 1");
        }

        $sql = "SELECT b.sort,if(b.beschreibung!='',
          if(CHAR_LENGTH(b.bezeichnunglieferant)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(CONCAT(b.bezeichnunglieferant,' *'),1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),CONCAT(b.bezeichnunglieferant,' *')),
            if(CHAR_LENGTH(b.bezeichnunglieferant)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(b.bezeichnunglieferant,1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),b.bezeichnunglieferant))
              as Artikel,
                 p.abkuerzung as projekt,  a.nummer as nummer, DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, b.preis as preis, b.waehrung, b.id as id
                   FROM $table b
                   LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
                   WHERE b.$module='$id'";
      } else 
      if ($module == "arbeitsnachweis") {
        $sql = "SELECT b.sort,
          adr.name as name,
          b.ort as ort,
          DATE_FORMAT(datum,'%d.%m.%Y') as rdatum,
          b.von as von,
          b.bis as bis,

          if(b.beschreibung!='',
              if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),CONCAT(b.bezeichnung,' *')),
              if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(b.bezeichnung,1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),b.bezeichnung))
            as Artikel,
               b.id as id
                 FROM $table b
                 LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN adresse adr ON adr.id=b.adresse LEFT JOIN projekt p ON b.projekt=p.id
                 WHERE b.$module='$id'";
      } else 
      if ($module == "reisekosten") {
        $sql = "SELECT b.sort,
          DATE_FORMAT(datum,'%d.%m.%Y') as rdatum,
          CONCAT(rk.nummer,'- ',rk.beschreibung) as kostenart,
          FORMAT(b.betrag,2{$extended_mysql55}) as betrag,
          if(b.abrechnen,'ja','') as abrechnen,
            if(b.keineust,'keine MwSt','') as keine,
              CONCAT(b.uststeuersatz,' %') as uststeuersatz,

                if(b.beschreibung!='',
                    if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung(-20) . ",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1," . $this->app->erp->MaxArtikelbezeichnung(-20) . "),'...'),CONCAT(b.bezeichnung,' *')),
                    if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung(-20) . ",CONCAT(SUBSTR(b.bezeichnung,1," . $this->app->erp->MaxArtikelbezeichnung(-20) . "),'...'),b.bezeichnung))
                  as Artikel,
                     b.bezahlt_wie as bezahlt,
                     b.id as id
                       FROM $table b
                       LEFT JOIN projekt p ON b.projekt=p.id LEFT JOIN reisekostenart rk ON rk.id=b.reisekostenart
                       WHERE b.$module='$id'";
      } else 
      if ($module == "produktion") {
      } else 
      if ($module == "rechnung" || $module == "angebot" || $module == "gutschrift") {

        //$sql = "SELECT if(b.beschreibung!='',if(CHAR_LENGTH(b.bezeichnung)>".$this->app->erp->MaxArtikelbezeichnung().",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1,".$this->app->erp->MaxArtikelbezeichnung()."),'...'),CONCAT(b.bezeichnung,' *'),SUBSTR(b.bezeichnung,1,".$this->app->erp->MaxArtikelbezeichnung().")) as Artikel,
        $sql = "SELECT b.sort, if(b.beschreibung!='',
                       if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),CONCAT(b.bezeichnung,' *')),
                         if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(b.bezeichnung,1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),b.bezeichnung))
                           as Artikel,
                              p.abkuerzung as projekt, a.nummer as nummer, b.nummer as nummer, DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, b.preis as preis, b.rabatt as rabatt, b.id as id
                                FROM $table b
                                LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
                                WHERE b.$module='$id'";
      } else {

        //$sql = "SELECT if(b.beschreibung!='',if(CHAR_LENGTH(b.bezeichnung)>".$this->app->erp->MaxArtikelbezeichnung().",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1,".$this->app->erp->MaxArtikelbezeichnung()."),'...'),CONCAT(b.bezeichnung,' *'),SUBSTR(b.bezeichnung,1,".$this->app->erp->MaxArtikelbezeichnung().")) as Artikel,
        $sql = "SELECT b.sort, if(b.beschreibung!='',
          if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(CONCAT(b.bezeichnung,' *'),1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),CONCAT(b.bezeichnung,' *')),
            if(CHAR_LENGTH(b.bezeichnung)>" . $this->app->erp->MaxArtikelbezeichnung() . ",CONCAT(SUBSTR(b.bezeichnung,1," . $this->app->erp->MaxArtikelbezeichnung() . "),'...'),b.bezeichnung))
              as Artikel,
                 p.abkuerzung as projekt, a.nummer as nummer, b.nummer as nummer, DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, b.preis as preis, b.id as id
                   FROM $table b
                   LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
                   WHERE b.$module='$id'";
      }

      //$this->app->Tpl->Add(EXTEND,"<input type=\"submit\" value=\"Gleiche Positionen zusammenf&uuml;gen\">");
      $this->app->YUI->SortListAdd('TAB1', $this, $menu, $sql);
      $schreibschutz = $this->app->DB->Select("SELECT schreibschutz FROM $module WHERE id='$id'");
      
      if ($schreibschutz != "1") {
        $this->app->Tpl->Add('TAB1', "<br><center><!--<input type=\"button\" value=\"Gleiche Positionen zusammenf&uuml;gen\">&nbsp;-->
            &nbsp;<input type=\"button\" value=\"Artikel manuell suchen / neu anlegen\" onclick=\"window.location.href='index.php?module=artikel&action=profisuche&cmd={$module}&id=$id';\"></center>");
      }
      $this->app->BuildNavigation = false;
      $this->app->Tpl->Add('PAGE', "<br><fieldset>");
      
      if ($module == "arbeitsnachweis") $this->app->Tpl->Parse(PAGE, "arbeitsnachweis_positionuebersicht.tpl");
      else $this->app->Tpl->Parse('PAGE', "auftrag_positionuebersicht.tpl");
      $this->app->Tpl->Add('PAGE', "</fieldset>");
    }
  }
  
  function ParserVarIf($parsvar, $choose) {

    
    if ($choose == 0) {
      $this->app->Tpl->Set($parsvar . "IF", "<!--");
      $this->app->Tpl->Set($parsvar . "ELSE", "-->");
      $this->app->Tpl->Set($parsvar . "ENDIF", "");
    } else {
      $this->app->Tpl->Set($parsvar . "IF", "");
      $this->app->Tpl->Set($parsvar . "ELSE", "<!--");
      $this->app->Tpl->Set($parsvar . "ENDIF", "-->");
    }
  }
  
  function ColorPicker($name) {

    $this->app->Tpl->Add(JQUERY, '$( "#' . $name . '" ).colorPicker();');
  }
  
  function DatePicker($name) {

    $this->app->Tpl->Add(JQUERY, '$( "#' . $name . '" ).datepicker({ dateFormat: \'dd.mm.yy\',dayNamesMin: [\'SO\', \'MO\', \'DI\', \'MI\', \'DO\', \'FR\', \'SA\'], firstDay:1,
          showWeek: true, monthNames: [\'Januar\', \'Februar\', \'März\', \'April\', \'Mai\', 
          \'Juni\', \'Juli\', \'August\', \'September\', \'Oktober\',  \'November\', \'Dezember\'], });');
  }
  
  function TimePicker($name) {

    $this->app->Tpl->Add(JQUERY, '$( "#' . $name . '" ).timepicker();');
  }
  
  function Message($class, $msg) {

    $this->app->Tpl->Add(MESSAGE, "<div class=\"$class\">$msg</div>");
  }
  
  function IconsSQLAll() {


    //  $go_lager = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/lagergo.png\" border=\"0\">";
    
    //  $stop_lager = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/lagerstop.png\" border=\"0\">";

    $abgeschlossen = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/grey.png\" border=\"0\">";
    $angelegt = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/dokumentoffen.png\" border=\"0\">";
    $storniert = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/storno.png\" border=\"0\">";
    $go_lager = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/dokumentok.png\" border=\"0\">";
    for ($i = 0;$i < 1;$i++) $tmp.= $abgeschlossen;
    for ($i = 0;$i < 1;$i++) $tmpblue.= $angelegt;
    for ($i = 0;$i < 1;$i++) $tmpstorno.= $storniert;
    return "if(a.status='angelegt','<table cellpadding=0 cellspacing=0><tr><td nowrap>$tmpblue</td></tr></table>',
           if(a.status='abgeschlossen' or a.status='storniert',
               if(a.status='abgeschlossen','<table cellpadding=0 cellspacing=0><tr><td nowrap>$tmp</td></tr></table>','<table cellpadding=0 cellspacing=0><tr><td nowrap>$tmpstorno</td></tr></table>'),

               CONCAT('<table cellpadding=0 cellspacing=0><tr><td nowrap>',
                 if(1,'$go_lager','$stop_lager'),'</td></tr></table>'
                 )))";
  }
  
  function IconsSQL() {

    $go_lager = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/lagergo.png\" style=\"margin-right:1px\" title=\"Artikel ist im Lager\" border=\"0\">";
    $stop_lager = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/lagerstop.png\" style=\"margin-right:1px\" title=\"Artikel fehlt im Lager\" border=\"0\">";
    $go_porto = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/portogo.png\" style=\"margin-right:1px\" title=\"Porto Check OK\" border=\"0\">";
    $stop_porto = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/portostop.png\" style=\"margin-right:1px\" title=\"Porto fehlt!\" border=\"0\">";
    $go_ust = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/ustgo.png\" title=\"UST Check OK\" border=\"0\" style=\"margin-right:1px\">";
    $stop_ust = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/uststop.png\" title=\"UST-Pr&uuml;fung fehlgeschlagen!\" border=\"0\" style=\"margin-right:1px\">";
    $go_vorkasse = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/vorkassego.png\" title=\"Zahlungscheck OK\" border=\"0\" style=\"margin-right:1px\">";
    $stop_vorkasse = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/vorkassestop.png\" title=\"Zahlungseingang bei Vorkasse fehlt!\" border=\"0\" style=\"margin-right:1px\">";
    $gostop_vorkasse = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/vorkassegostop.png\" title=\"Teilzahlung vorhanden!\" border=\"0\" style=\"margin-right:1px\">";
    $go_nachnahme = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/nachnahmego.png\" title=\"Nachnahme Check OK\" border=\"0\" style=\"margin-right:1px\">";
    $stop_nachnahme = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/nachnahmestop.png\" title=\"Nachnahmegeb&uuml;hr fehlt!\" border=\"0\" style=\"margin-right:1px\">";
    $go_autoversand = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/autoversandgo.png\" title=\"Autoversand erlaubt\" border=\"0\" style=\"margin-right:1px\">";
    $stop_autoversand = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/autoversandstop.png\" title=\"Kein Autoversand\" border=\"0\" style=\"margin-right:1px\">";
    $go_check = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/checkgo.png\" title=\"Kundencheck OK\" border=\"0\" style=\"margin-right:1px\">";
    $stop_check = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/checkstop.png\" title=\"Kundencheck fehlgeschlagen\" border=\"0\" style=\"margin-right:1px\">";
    $go_liefertermin = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/termingo.png\" title=\"Liefertermin OK\" border=\"0\" style=\"margin-right:1px\">";
    $stop_liefertermin = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/terminstop.png\" title=\"Liefertermin in Zukunft\" border=\"0\" style=\"margin-right:1px\">";
    $go_kreditlimit = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/kreditlimitgo.png\" title=\"Kreditlimit OK\" border=\"0\" style=\"margin-right:1px\">";
    $stop_kreditlimit = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/kreditlimitstop.png\" title=\"Krein Kreditlimit mehr verf&uuml;gbar!\" border=\"0\" style=\"margin-right:1px\">";
    $go_liefersperre = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/liefersperrego.png\" title=\"Liefersperre OK\" border=\"0\" style=\"margin-right:1px\">";
    $stop_liefersperre = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/liefersperrestop.png\" title=\"Liefersperre gesetzt\" border=\"0\" style=\"margin-right:1px\">";
    $reserviert = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/reserviert.png\" border=\"0\" style=\"margin-right:1px\">";
    $check = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/mail-mark-important.png\" border=\"0\" style=\"margin-right:1px\">";
    $abgeschlossen = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/grey.png\" title=\"Auftrag abgeschlossen\" border=\"0\" style=\"margin-right:1px\">";
    $angelegt = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/blue.png\" title=\"Auftrag noch nicht freigegeben!\" border=\"0\" style=\"margin-right:1px\">";
    $storniert = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/storno.png\" title=\"Auftrag storniert!\" border=\"0\" style=\"margin-right:1px\">";
    for ($i = 0;$i < 10;$i++) $tmp.= $abgeschlossen;
    for ($i = 0;$i < 10;$i++) $tmpblue.= $angelegt;
    for ($i = 0;$i < 10;$i++) $tmpstorno.= $storniert;
    return "if(a.status='angelegt','<table cellpadding=0 cellspacing=0><tr><td nowrap>$tmpblue</td></tr></table>',
           if(a.status='abgeschlossen' or a.status='storniert',
               if(a.status='abgeschlossen','<table cellpadding=0 cellspacing=0><tr><td nowrap>$tmp</td></tr></table>','<table cellpadding=0 cellspacing=0><tr><td nowrap>$tmpstorno</td></tr></table>'),

               CONCAT('<table cellpadding=0 cellspacing=0><tr><td nowrap>',
                 if(a.lager_ok,'$go_lager','$stop_lager'),if(a.porto_ok,'$go_porto','$stop_porto'),if(a.ust_ok,'$go_ust',CONCAT('<a href=\"/index.php?module=adresse&action=ustprf&id=',a.adresse,'\">','$stop_ust','</a>')),
                 if(a.vorkasse_ok=1,'$go_vorkasse',if(a.vorkasse_ok=2,'$gostop_vorkasse','$stop_vorkasse')),if(a.nachnahme_ok,'$go_nachnahme','$stop_nachnahme'),if(a.autoversand,'$go_autoversand','$stop_autoversand'),
                 if(a.check_ok,'$go_check','$stop_check'),if(a.liefertermin_ok,'$go_liefertermin','$stop_liefertermin'),if(a.kreditlimit_ok,'$go_kreditlimit','$stop_kreditlimit'),if(a.liefersperre_ok,'$go_liefersperre','$stop_liefersperre'),'</td></tr></table>'
                 )))";
  }
  
  function IconsSQLVerbindlichkeit() {

    $go_ware = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/ware_go.png\" style=\"margin-right:1px\" title=\"Wareneingangspr&uuml;fung OK\" border=\"0\">";
    $stop_ware = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/ware_stop.png\" style=\"margin-right:1px\" title=\"Wareneingangspr&uuml;fung fehlt\" border=\"0\">";
    $go_summe = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/summe_go.png\" style=\"margin-right:1px\" title=\"Rechnungseingangspr&uuml;fung OK\" border=\"0\">";
    $stop_summe = "<img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/summe_stop.png\" style=\"margin-right:1px\" title=\"Rechnungseingangspr&uuml;fung fehlt\" border=\"0\">";
    return "CONCAT(if(v.freigabe,'$go_ware','$stop_ware'),if(v.rechnungsfreigabe,'$go_summe','$stop_summe'))";
  }
  
  function TablePositionSearch($parsetarget, $name, $callback = "show", $gener) {

    $id = $this->app->Secure->GetGET("id");
    
    switch ($name) {
      case "auftragpositionen":

        /*
        // headings
        $heading =  array('Nummer','Artikel','Projekt','Menge','Einzelpreis','Men&uuml;');
        $width   =  array('10%','45%','15%','10%','10%','10%');
        $findcols = array('nummer','name_de','projekt','menge','preis','id');
        $searchsql = array('a.bezeichnung','a.nummer','p.abkuerzung');
        
        $menu =  "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>".
        "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>".
        "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";
        
        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.nummer as nummer, a.bezeichnung as name_de, p.abkuerzung as projekt, a.menge as menge, a.preis as preis, a.id as menu
        FROM  auftrag_position a LEFT JOIN projekt p ON p.id=a.projekt ";
        
        // fester filter
        $w;h;ere = " a.auftrag='$id'";
        
        $count = "SELECT COUNT(id) FROM auftrag_position WHERE auftrag='$id'";
        */
      break;
      default:
      break;
    }
    
    if ($callback == "show") {
      $this->app->Tpl->Add(ADDITIONALCSS, "

          .ex_highlight #$name tbody tr.even:hover, #example tbody tr.even td.highlighted {
          background-color: [TPLFIRMENFARBEHELL]; 
          }

          .ex_highlight_row #$name tr.even:hover {
          background-color: [TPLFIRMENFARBEHELL];
          }

          .ex_highlight_row #$name tr.even:hover td.sorting_1 {
          background-color: [TPLFIRMENFARBEHELL];
          }

          .ex_highlight_row #$name tr.odd:hover {
          background-color: [TPLFIRMENFARBEHELL];
          }

          .ex_highlight_row #$name tr.odd:hover td.sorting_1 {
          background-color: [TPLFIRMENFARBEHELL];
          }
          ");

      //"sPaginationType": "full_numbers",
      
      //"aLengthMenu": [[10, 25, 50, 200, 10000], [10, 25, 50, 200, "All"]],

      
      if ($name == "versandoffene") {
        $bStateSave = "false";
        $cookietime = 0;
      } else {
        $cookietime = 10 * 60;
        $bStateSave = "true";
      }
      $this->app->Tpl->Add('JAVASCRIPT', " var oTable" . $name . "; var oMoreData1" . $name . "=0; var oMoreData2" . $name . "=0; var oMoreData3" . $name . "=0; var oMoreData4" . $name . "=0; var oMoreData5" . $name . "=0;  var aData;
              ");
      $iframe = $this->app->Secure->GetGET("iframe");
      $this->app->Tpl->Add(DATATABLES, '
                  oTable' . $name . ' = $(\'#' . $name . '\').dataTable( {
                    "bAutoWidth": false,
                    "bProcessing": true,
                    "iCookieDuration": ' . $cookietime . ', //60*60*24,// 1 day (in seconds)
                    "iDisplayLength": 10,
                    "bStateSave": ' . $bStateSave . ',
                    "bServerSide": true,
                    "fnInitComplete": function (){
                    $(oTable' . $name . '.fnGetNodes()).click(function (){
                      alert(\'Demo\');// my js window....
                      });},
                    "fnServerData": function ( sSource, aoData, fnCallback ) {
                    /* Add some extra data to the sender */
                    aoData.push( { "name": "more_data1", "value": oMoreData1' . $name . ' } );
                    aoData.push( { "name": "more_data2", "value": oMoreData2' . $name . ' } );
                    aoData.push( { "name": "more_data3", "value": oMoreData3' . $name . ' } );
                    aoData.push( { "name": "more_data4", "value": oMoreData4' . $name . ' } );
                    aoData.push( { "name": "more_data5", "value": oMoreData5' . $name . ' } );
                    $.getJSON( sSource, aoData, function (json) { 
                      /* Do whatever additional processing you want on the callback, then tell DataTables */
                      fnCallback(json)
                      } );
                    },
                    "sAjaxSource": "./index.php?module=ajax&action=tableposition&cmd=' . $name . '&id=' . $id . '&iframe=' . $iframe . '"
                  } );



              ');
      
      if ($moreinfo) {
        $this->app->Tpl->Add(DATATABLES, '
                    $(\'#' . $name . ' tbody td img.details\').live( \'click\', function () {
                      var nTr = this.parentNode.parentNode;
                      aData =  oTable' . $name . '.fnGetData( nTr );

                      if ( this.src.match(\'details_close\') )
                      {
                      /* This row is already open - close it */
                      this.src = "./themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/details_open.png";
                      oTable' . $name . '.fnClose( nTr );
                      }
                      else
                      {
                      /* Open this row */
                      this.src = "./themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/details_close.png";
                      oTable' . $name . '.fnOpen( nTr, ' . $name . 'fnFormatDetails(nTr), \'details\' );
                      }
                      });
                    ');

        /*  $.get("index.php?module=auftrag&action=minidetail&id=2", function(text){
                    spin=0; 
                    miniauftrag = text;
                    });
        */
        $module = $this->app->Secure->GetGET("module");
        $this->app->Tpl->Add('JAVASCRIPT', 'function ' . $name . 'fnFormatDetails ( nTr ) {
                    //var aData =  oTable' . $name . '.fnGetData( nTr );
                    var str = aData[' . $menucol . '];

                    var match = str.match(/[1-9]{1}[0-9]*/);

                    var auftrag = parseInt(match[0], 10);

                    var miniauftrag;
                    var strUrl = "index.php?module=' . $module . '&action=minidetail&id="+auftrag; //whatever URL you need to call
                    var strReturn = "";

                    jQuery.ajax({
url:strUrl, success:function(html){strReturn = html;}, async:false
});

                    miniauftrag = strReturn;

                    var sOut = \'<table cellpadding="0" cellspacing="0" border="0" align="center" style="padding-left: 30px; padding-right:30px; width:100%;">\';
                    sOut += \'<tr><td>\'+miniauftrag+\'</td></tr>\';
                    sOut += \'</table>\';
                    return sOut;
                }
');
      }
      $colspan = count($heading);
      $this->app->Tpl->Add($parsetarget, '
    <br><br>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="' . $name . '">
    <thead>
    <tr><th colspan="' . $colspan . '"><br></th></tr>
    <tr>');
      for ($i = 0;$i < count($heading);$i++) {
        $this->app->Tpl->Add($parsetarget, '<th width="' . $width[$i] . '">' . $heading[$i] . '</th>');
      }
      $this->app->Tpl->Add($parsetarget, '</tr>
    </thead>
    <tbody>
    <tr>
    <td colspan="' . $colspan . '" class="dataTables_empty">Lade Daten</td>
    </tr>
    </tbody>

    <tfoot>
    <tr>
    ');
      for ($i = 0;$i < count($heading);$i++) {
        $this->app->Tpl->Add($parsetarget, '<th>' . $heading[$i] . '</th>');
      }
      $this->app->Tpl->Add($parsetarget, '
    </tr>
    </tfoot>
    </table>
    <br>
    <br>
    <br>
    ');
    } else 
    if ($callback == "sql") return $sql;
    else 
    if ($callback == "searchsql") return $searchsql;
    else 
    if ($callback == "searchsql_dir") return $searchsql_dir;
    else 
    if ($callback == "searchfulltext") return $searchfulltext;
    else 
    if ($callback == "heading") return $heading;
    else 
    if ($callback == "menu") return $menu;
    else 
    if ($callback == "findcols") return $findcols;
    else 
    if ($callback == "where") return $where;
    else 
    if ($callback == "count") return $count;
  }
  
  /*
  Parameter frommodule: Modulename
  Parameter fromclass:  Klassenname im Module
  falls $name nicht vorhanden wird das Modul included und die Funktion
    static function TableSearch(&$app, $name, $erlaubtevars)
  aufgerufen und dort nach $name gesucht und die callbackresults als array zurückgegeben
  */
  function TableSearch($parsetarget, $name, $callback = "show", $generic_sql = "", $generic_menu = "", $frommodule = "", $fromclass = "") {

    $id = $this->app->Secure->GetGET("id");
    $groupby = "";
    $allowed = array();
    $searchfulltext = "";
    
    if ($this->app->erp->Firmendaten("mysql55") == "1") {
      $extended_mysql55 = ",'de_DE'";
    }
    
    switch ($name) {
      case "kundeartikelpreise":
        $allowed['artikel'] = array('profisuche');

        // alle artikel die ein Kunde kaufen kann mit preisen netto brutto
        $cmd = $this->app->Secure->GetGET("smodule");
        $adresse = $this->app->DB->Select("SELECT adresse FROM {$cmd} WHERE id='$id' LIMIT 1");

        // headings
        $heading = array('Nummer', 'Artikel', 'Ab', 'Preis','W&auml;hrung', 'Lager', 'Reservierungen', 'Projekt', 'Men&uuml;');
        $width = array('10%', '45%', '10%', '10%', '10%', '10%','15%', '10%');
        $findcols = array('nummer', 'name_de', 'abmenge', 'preis','waehrung', 'lager', 'reserviert', 'projekt', 'id');
        $searchsql = array('a.name_de', 'a.nummer', 'p.abkuerzung');
        $menu = "<a href=\"#\" onclick=InsertDialog(\"index.php?module=artikel&action=profisuche&id=%value%&cmd=$cmd&sid=$id&insert=true\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/add.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.nummer as nummer, 
        CONCAT(a.name_de,' (',v.art,')') 
            as name_de, v.ab_menge as abmenge,v.preis as preis,v.waehrung,
            (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as lager, 
            (SELECT SUM(l.menge) FROM lager_reserviert l WHERE l.artikel=a.id) as reserviert, 
            p.abkuerzung as projekt, v.id as menu
            FROM  verkaufspreise v, artikel a LEFT JOIN projekt p ON p.id=a.projekt  ";
        $gruppenarr = $this->app->erp->GetGruppen($adresse);
        for ($i = 0;$i < count($gruppenarr);$i++) {
          
          if ($gruppenarr[$i] > 0) $gruppen.= " OR v.gruppe='" . $gruppenarr[$i] . "' ";
        }

        // fester filter
        $where = "a.geloescht=0 AND v.artikel=a.id AND ((v.adresse='$adresse' $gruppen) OR ((v.adresse='' OR v.adresse='0') AND v.art='Kunde')) ";
        $count = "SELECT COUNT(v.id) FROM verkaufspreise v, artikel a WHERE a.geloescht=0 AND v.artikel=a.id AND ((v.adresse='$adresse' $gruppen) OR ((v.adresse='' OR v.adresse='0') AND v.art='Kunde')) ";
        break;
      case "lieferantartikelpreise":
        $allowed['artikel'] = array('profisuche');

        // alle artikel die ein Kunde kaufen kann mit preisen netto brutto
        $cmd = $this->app->Secure->GetGET("smodule");
        $adresse = $this->app->DB->Select("SELECT adresse FROM {$cmd} WHERE id='$id' LIMIT 1");

        // headings
        $heading = array('Nummer', 'Artikel', 'Ab', 'Preis', 'Lager', 'Reservierungen', 'Projekt', 'Men&uuml;');
        $width = array('10%', '45%', '10%', '10%', '10%', '15%', '10%');
        $findcols = array('nummer', 'name_de', 'abmenge', 'preis', 'lager', 'reserviert', 'projekt', 'id');
        $searchsql = array('a.name_de', 'a.nummer', 'p.abkuerzung');
        $menu = "<a href=\"#\" onclick=InsertDialog(\"index.php?module=artikel&action=profisuche&id=%value%&cmd=$cmd&sid=$id&insert=true\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/add.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.nummer as nummer, a.name_de as name_de, v.ab_menge as abmenge,v.preis as preis,
              (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as lager,
              (SELECT SUM(l.menge) FROM lager_reserviert l WHERE l.artikel=a.id) as reserviert, 
              p.abkuerzung as projekt, v.id as menu
                FROM  einkaufspreise v, artikel a LEFT JOIN projekt p ON p.id=a.projekt  ";

        // fester filter
        $where = "a.geloescht=0 AND v.artikel=a.id AND (v.adresse='' OR v.adresse='$adresse' OR v.adresse='0') AND (v.gueltig_bis='0000-00-00' OR v.gueltig_bis >=NOW()) ";
        $count = "SELECT COUNT(v.id) FROM einkaufspreise v, artikel a WHERE a.geloescht=0 AND v.artikel=a.id AND (v.adresse='' OR v.adresse='$adresse')";
        break;
      case "lagerdifferenzen":
        $allowed['lager'] = array('differenzen');

        // headings
        $heading = array('Artikel-Nr.', 'Artikel', 'Eingang', 'Ausgang', 'Berechnet', 'Bestand', 'Differenz', 'Men&uuml;');
        $width = array('10%', '40%', '10%', '10%', '10%', '10%', '10%', '10%');
        $findcols = array('a.nummer', 'a.name_de', 'l.eingang', 'l.ausgang', 'l.berechnet', 'l.bestand', 'l.differenz', 'a.id');
        $searchsql = array('kurzbezeichnung');
        $defaultorder = 6;
        $defaultorderdesc = 1;
        $menu = "<a href=\"index.php?module=artikel&action=lager&id=%value%\" target=\"_blank\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;";

        /*
               ifnull((SELECT SUM(l.menge) FROM lager_bewegung l WHERE l.artikel=a.id AND l.eingang=1),0)-
               ifnull((SELECT SUM(l.menge) FROM lager_bewegung l WHERE l.artikel=a.id AND l.eingang=0),0)-
               ifnull((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),0) as differenz,
        */

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.nummer, a.name_de, FORMAT(l.eingang,0),FORMAT(l.ausgang,0),
              FORMAT(l.berechnet,0),FORMAT(l.bestand,0),
              if(l.bestand > l.berechnet, CONCAT('<font color=red>',FORMAT(l.differenz,0),'</font>'),FORMAT(l.differenz,0)), a.id FROM lager_differenzen l 
                LEFT JOIN artikel a ON a.id=l.artikel";

        // fester filter
        $where = " l.user='" . $this->app->User->GetID() . "' AND l.lager_platz = 0 ";
        $count = "SELECT COUNT(l.id) FROM lager_differenzen l WHERE l.user='" . $this->app->User->GetID() . "' AND l.lager_platz = 0 ";
        break;
      case "lagerdifferenzenlagerplatz":
        $allowed['lager'] = array('differenzenlagerplatz');

        // headings
        $heading = array('Artikel-Nr.', 'Artikel', 'Projekt', 'Eingang', 'Ausgang', 'Berechnet', 'Bestand', 'Differenz','Lagerplatz', 'Men&uuml;');
        $width = array('10%', '40%', '10%', '10%', '5%', '5%', '5%', '5%', '5%', '10%');
        $findcols = array('a.nummer', 'a.name_de', 'p.abkuerzung', 'l.eingang', 'l.ausgang', 'l.berechnet', 'l.bestand', 'l.differenz', 'l.lager_platz', 'a.id');
        $searchsql = array('a.nummer', 'a.name_de', 'p.abkuerzung', 'l.eingang', 'l.ausgang', 'l.berechnet', 'l.bestand', 'l.differenz', 'lp.kurzbezeichnung');
        $defaultorder = 6;
        $defaultorderdesc = 1;
        $menu = "<a href=\"index.php?module=artikel&action=lager&id=%value%\" target=\"_blank\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=LagerplatzdifferenzenEdit(\"%value%\") ><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/forward.png\" border=\"0\"></a>";

        /*
               ifnull((SELECT SUM(l.menge) FROM lager_bewegung l WHERE l.artikel=a.id AND l.eingang=1),0)-
               ifnull((SELECT SUM(l.menge) FROM lager_bewegung l WHERE l.artikel=a.id AND l.eingang=0),0)-
               ifnull((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),0) as differenz,
        */

        // SQL statement
        $sql = "
          SELECT 
            SQL_CALC_FOUND_ROWS a.id, 
            a.nummer, 
            a.name_de, 
            p.abkuerzung,
            FORMAT(l.eingang,0),
            FORMAT(l.ausgang,0),
            FORMAT(l.berechnet,0),
            FORMAT(l.bestand,0),
            if(l.bestand > l.berechnet, CONCAT('<font color=red>',FORMAT(l.differenz,0),'</font>'),
            FORMAT(l.differenz,0)), 
            lp.kurzbezeichnung,
            CONCAT(a.id,'_',lp.id)
          FROM 
            lager_differenzen l 
            LEFT JOIN artikel a ON a.id=l.artikel
            LEFT JOIN lager_platz lp ON lp.id = l.lager_platz
            LEFT JOIN projekt p ON a.projekt = p.id
        ";

        // fester filter
        $where = " l.user='" . $this->app->User->GetID() . "' AND l.lager_platz != 0 ";
        $count = "SELECT COUNT(l.id) FROM lager_differenzen l WHERE l.user='" . $this->app->User->GetID() . "' AND l.lager_platz != 0 ";
        break;
      case "lagerplatzinventurtabelle":

        // headings
        $heading = array('Bezeichnung', 'Men&uuml;');
        $width = array('30%', '20%', '20%', '20%');
        $findcols = array('kurzbezeichnung', 'id');
        $searchsql = array('kurzbezeichnung');
        $menu = "<a href=\"index.php?module=lager&action=platzeditpopup&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS id, kurzbezeichnung, id as menu FROM lager_platz ";

        // fester filter
        $where = " geloescht=0 AND id!=0";
        $count = "SELECT COUNT(id) FROM lager_platz WHERE geloescht=0";
        break;
      case "lagerplatztabelle":
        $allowed['lager'] = array('platz');

        // headings

        $heading = array('Bezeichnung', 'Nachschublager', 'Verbrauchslager', 'Sperrlager','Volumen','Men&uuml;');
        $width = array('30%', '15%', '15%','15%','15%','5%');
        $findcols = array('kurzbezeichnung', 'autolagersperre', 'verbrauchslager','sperrlager','breite','id');
        $searchsql = array('kurzbezeichnung');
        $defaultorder = 4;
        $defaultorderdesc = 1;

        $menu = "<a href=\"index.php?module=lager&action=platzeditpopup&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=lager&action=deleteplatz&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=PrintDialog(\"index.php?module=lager&action=regaletiketten&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/labelprinter.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS id, 
          kurzbezeichnung, if(autolagersperre,'kein Versand aus diesem Lager','') as autolagersperre, 
                if(verbrauchslager,'ja','') as verbrauchslager,
                if(sperrlager,'ja','') as sperrlager,
              if(laenge!=0.0,CONCAT(laenge,'/',breite,'/',hoehe),'-') as volumen,
              id as menu FROM lager_platz ";
        $id = $this->app->Secure->GetGET("id");

        // fester filter
        $where = " geloescht=0 AND id!=0 AND lager='$id' ";
        $count = "SELECT COUNT(id) FROM lager_platz WHERE geloescht=0 AND lager='$id' ";
        break;
      case 'abrechnungsartikel':
        $allowed['adresse'] = array('artikel');
        $heading = array('Artikel', 'Nummer', 'Ab', 'Preis', 'Projekt', 'Startdatum', 'Menge', 'Aktion');
        $width = array('20%', '10%', '10%', '10%', '10%', '10%', '10%', '10%');
        $findcols = array('a.name_de', 'a.nummer', 'ab', 'v.preis', 'projekt', 'lieferdatum', 'menge', 'v.id');
        $searchsql = array('a.name_de', 'a.nummer');
        $id = $this->app->Secure->GetGET('id');
        $menu = '<center><input type="button" value="anlegen" onclick="anlegen(' . $id . ',%value%)"></center>';
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,a.name_de, a.nummer, v.ab_menge AS ab, v.preis, p.abkuerzung as projekt,
              CONCAT('<center><input type=\"text\" size=\"10\" value=\"',DATE_FORMAT(NOW(),'%d.%m.%Y'),'\" id=\"datum',v.id,'\"></center>') AS lieferdatum,
              CONCAT('<center><input type=\"text\" size=\"3\" value=\"\" id=\"menge',v.id,'\"><select name=\"art',v.id,'\" id=\"art',v.id,'\"><option value=\"abo\">Abo</option><option value=\"einmalig\">Einmalig</option></select></center>') AS menge,
              v.id 
                FROM artikel AS a 
                LEFT JOIN verkaufspreise AS v ON v.artikel=a.id
                LEFT JOIN projekt AS p ON p.id=v.projekt ";
        $where = " v.ab_menge>=1 AND a.geloescht!=1";
        $count = "SELECT COUNT(a.id) FROM artikel AS a 
              LEFT JOIN verkaufspreise AS v ON v.artikel=a.id
              LEFT JOIN projekt AS p ON p.id=v.projekt
              WHERE v.ab_menge>=1 AND a.geloescht!=1";
        break;
      case "lieferantartikel":
        $allowed['adresse'] = array('lieferantartikel');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#offen').click( function() { fnFilterColumn1( 0 ); } );");
        for ($r = 1;$r < 2;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // headings
        $heading = array('Nummer', 'Artikel', 'Verkauf', 'LA', 'AB', 'BE', 'Reserv.', 'Fehlende', 'Gesamt', 'aktueller Monate', 'letzter Monat', 'Status', 'Men&uuml;');
        $width = array('5%', '40%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '5%', '15%');

        $findcols = array('nummer', 'name_de', 'verkauf', 'CAST(`lager` as SIGNED)', 'CAST(`offen` as SIGNED)', 'CAST(`bestellung` as SIGNED)', 'CAST(`res` as SIGNED)', 'CAST(`fehlende` as SIGNED)', 'CAST(`gesamt` as SIGNED)', 'CAST(`monat` as SIGNED)', 'CAST(`monat_last` as SIGNED)', 'status', 'id');

        $searchsql = array('a.name_de', "IFNULL((SELECT e.bestellnummer FROM einkaufspreise e WHERE e.artikel=a.id AND e.adresse='$id' AND e.geloescht!=1 AND e.bestellnummer!='' LIMIT 1),'')", 'a.nummer');
        $menu = "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";
        $aktuellermonat = $this->app->DB->Select("SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()))");
        $letztermonat = $this->app->DB->Select("SELECT CONCAT(YEAR( DATE_SUB( NOW() , INTERVAL 1 MONTH )),'-',DATE_FORMAT( DATE_SUB( NOW() , INTERVAL 1 MONTH ) ,'%m'))");

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.nummer as nummer, 

              CONCAT(if( (SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND auf.status='freigegeben') > IFNULL((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),0) + IFNULL((SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp LEFT JOIN bestellung b ON b.id=bp.bestellung WHERE bp.artikel=a.id AND b.status='versendet'),0)

                    , CONCAT('<font color=red><b>',a.name_de,'</b></font>'),a.name_de),'<br>Best-Nr.:',IFNULL((SELECT e.bestellnummer FROM einkaufspreise e WHERE e.artikel=a.id AND e.adresse='$id' AND e.geloescht!=1 AND e.bestellnummer!='' ORDER by e.id DESC LIMIT 1),'-'),'<br>Letzter EK-Preis: ',((SELECT e.preis FROM einkaufspreise e WHERE e.artikel=a.id AND (e.gueltig_bis > NOW() OR e.gueltig_bis='0000-00-00') AND e.geloescht!=1 AND e.preis > 0 ORDER by e.id DESC LIMIT 1)),' ab Menge ',(SELECT e.ab_menge FROM einkaufspreise e WHERE e.artikel=a.id AND (e.gueltig_bis > NOW() OR e.gueltig_bis='0000-00-00') AND e.geloescht!=1 AND e.preis > 0 ORDER by e.id DESC LIMIT 1)) as name, 


              ifnull((SELECT MAX(auftrag.datum) FROM auftrag LEFT JOIN
                    auftrag_position ON auftrag.id=auftrag_position.auftrag WHERE auftrag_position.artikel=a.id
                    ),0) as verkauf,



              ifnull(if( (SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND auf.status='freigegeben') > IFNULL((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),0) + IFNULL((SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp LEFT JOIN bestellung b ON b.id=bp.bestellung WHERE bp.artikel=a.id AND b.status='versendet'),0)
                    ,
                    CONCAT('<font color=red>',if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) > 0,(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),'-'),'</font>'),

                    if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) > 0,(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),'-')),0)
                as lager,

              ifnull((SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND auf.status='freigegeben'),0) as offen,

              ifnull((SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp LEFT JOIN bestellung b ON b.id=bp.bestellung WHERE bp.artikel=a.id AND b.status='versendet'),0) as bestellung,

              ifnull((if((SELECT SUM(l.menge) FROM lager_reserviert l WHERE l.artikel=a.id) > 0,(SELECT SUM(l.menge) FROM lager_reserviert l WHERE l.artikel=a.id),'-')),0) as res,

              ifnull(IF((SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND auf.status='freigegeben') - ( IFNULL((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),0) + IFNULL((SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp LEFT JOIN bestellung b ON b.id=bp.bestellung WHERE bp.artikel=a.id AND b.status='versendet'),0)) > 0,(SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND auf.status='freigegeben') - ( IFNULL((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),0) + IFNULL((SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp LEFT JOIN bestellung b ON b.id=bp.bestellung WHERE bp.artikel=a.id AND b.status='versendet'),0)),'-'),0) as fehlende,



              ifnull(if((SELECT SUM(ap.menge) FROM auftrag_position ap WHERE ap.artikel=a.id) > 0, (SELECT SUM(ap.menge) FROM auftrag_position ap WHERE ap.artikel=a.id),'-'),0) as gesamt,
              ifnull((SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND DATE_FORMAT(auf.datum,'%Y-%m')='$aktuellermonat'),0) as monat,
              ifnull((SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND DATE_FORMAT(auf.datum,'%Y-%m')='$letztermonat'),0) as monat_last,

              ifnull(if( (SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND auf.status='freigegeben') > IFNULL((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),0)+IFNULL((SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp LEFT JOIN bestellung b ON b.id=bp.bestellung WHERE bp.artikel=a.id AND b.status='versendet'),0), 'fehlt','ok'),'') as status, 
              a.id as menu
                FROM artikel a ";

        // START EXTRA more
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " (((SELECT MAX(auftrag.datum) FROM auftrag LEFT JOIN
              auftrag_position ON auftrag.id=auftrag_position.auftrag WHERE auftrag_position.artikel=a.id
                ) < DATE_SUB(NOW(),INTERVAL 6 MONTH)) AND (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) > 0 )";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];

        // fester filter
        $where = " a.adresse='$id' AND a.geloescht!=1 $tmp";
        $count = "SELECT COUNT(a.id) FROM artikel a WHERE a.adresse='$id' AND a.geloescht!=1 $tmp";
        break;
      case "artikel_auftraege_offen":
        $allowed['artikel'] = array('offeneauftraege');

        // headings
        $heading = array('Auftrag', 'Datum', 'Status', 'Zahlweise', 'Freigabe', 'Kunde', 'Menge', 'Geliefert', 'Preis', 'Men&uuml;');
        $width = array('10%', '10%', '15%', '10%', '10%', '30%', '10%', '10%');
        $findcols = array('a.id', 'a.belegnr', 'a.datum', 'a.status', 'a.zahlungsweise', 'adr.kundenfreigabe', 'adr.name', 'ap.menge', 'ap.geliefert_menge', "FORMAT(ap.preis*(100-ap.rabatt)/100,2)");
        $searchsql = array('a.belegnr', "DATE_FORMAT(a.datum,'%d.%m.%Y')", 'a.status', 'a.zahlungsweise', 'adr.kundenfreigabe', 'adr.name', 'ap.menge', 'ap.geliefert_menge', "FORMAT(ap.preis*(100-ap.rabatt)/100,2)");
        $menu = "<a href=\"index.php?module=auftrag&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, CONCAT('<a href=\"index.php?module=auftrag&action=edit&id=',a.id,'\">',a.belegnr,'</a>') as belegnr, DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.status, a.zahlungsweise, adr.kundenfreigabe as freigabe, CONCAT(a.name,'<br>', a.email) as Kunde, 
              ap.menge, ap.geliefert_menge as gelieferte, FORMAT(ap.preis*(100-ap.rabatt)/100,2) as preis, a.id 
              FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag, adresse adr";
        
        if ($name == "artikel_auftraege_offen") {

          // fester filter
          $where = " adr.id=a.adresse AND ap.artikel='$id' AND ap.geliefert_menge < ap.menge AND a.status='freigegeben'";
          $count = "SELECT COUNT(a.id) FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag, adresse adr 
                WHERE adr.id=a.adresse AND ap.artikel='$id' AND ap.geliefert_menge < ap.menge AND a.status='freigegeben'";
        } else {

          // fester filter
          $where = " adr.id=a.adresse AND ap.artikel='$id' AND a.status='abgeschlossen'";
          $count = "SELECT COUNT(a.id) FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag, adresse adr 
                WHERE adr.id=a.adresse AND ap.artikel='$id' AND a.status='abgeschlosse'";
        }
        break;
      case "artikel_auftraege_versendet":
        $allowed['artikel'] = array('offeneauftraege');

        // headings
        $heading = array('Auftrag', 'Datum', 'Status', 'Zahlweise', 'Freigabe', 'Kunde', 'Menge', 'Geliefert', 'Preis', 'Men&uuml;');
        $width = array('10%', '10%', '15%', '10%', '10%', '30%', '10%', '10%');
        $findcols = array('a.id', 'a.belegnr', 'a.datum', 'a.status', 'a.zahlungsweise', 'adr.kundenfreigabe', 'adr.name', 'ap.menge', 'ap.geliefert_menge', "FORMAT(ap.preis*(100-ap.rabatt)/100,2)");
        $searchsql = array('a.belegnr', "DATE_FORMAT(a.datum,'%d.%m.%Y')", 'a.status', 'a.zahlungsweise', 'adr.kundenfreigabe', 'adr.name', 'ap.menge', 'ap.geliefert_menge', "FORMAT(ap.preis*(100-ap.rabatt)/100,2)");
        $menu = "<a href=\"index.php?module=auftrag&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, CONCAT('<a href=\"index.php?module=auftrag&action=edit&id=',a.id,'\">',a.belegnr,'</a>') as belegnr, DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.status, a.zahlungsweise, adr.kundenfreigabe as freigabe, CONCAT(a.name,'<br>', a.email) as Kunde, 
              ap.menge, ap.geliefert_menge as gelieferte, FORMAT(ap.preis*(100-ap.rabatt)/100,2) as preis, a.id 
              FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag, adresse adr";

        // fester filter
        $where = " adr.id=a.adresse AND ap.artikel='$id' AND a.status='abgeschlossen'";
        $count = "SELECT COUNT(a.id) FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag, adresse adr 
              WHERE adr.id=a.adresse AND ap.artikel='$id' AND a.status='abgeschlosse'";
        break;
      case "adresse_artikel_gebuehr":
        $allowed['adresse'] = array('kundeartikel');

        // headings
        $heading = array('Nummer', 'Artikel', 'Rechnung', 'Datum', 'Menge', 'Einzelpreis', 'Rabatt', 'Men&uuml;');
        $width = array('10%', '45%', '15%', '10%', '10%', '10%', '10%', '10%');
        $findcols = array('nummer', 'name_de', 'rechnung', 'belegnr', 'menge', 'preis', 'rabatt', 'id');
        $searchsql = array('a.bezeichnung', 'a.nummer', 'auf.belegnr', "DATE_FORMAT(auf.datum,'%d.%m.%Y')", 'a.preis', 'a.rabatt');
        $menu = "<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.nummer as nummer, a.bezeichnung as name_de, auf.belegnr as rechnung, DATE_FORMAT(auf.datum,'%d.%m.%Y'), a.menge as menge, a.preis as preis, 
              a.rabatt as rabatt, a.rechnung as menu
              FROM rechnung_position a LEFT JOIN rechnung auf ON a.rechnung=auf.id LEFT JOIN artikel art ON art.id=a.artikel";

        // fester filter
        $where = " auf.adresse='$id' AND art.gebuehr=1";
        $count = "SELECT COUNT(a.id) FROM rechnung_position a LEFT JOIN rechnung auf ON a.rechnung=auf.id WHERE auf.adresse='$id'";
        break;

      case "adresse_artikel_serviceartikel":
        $allowed['adresse'] = array('kundeartikel');

        // headings
        $heading = array('Nummer', 'Artikel', 'Rechnung', 'Datum', 'Menge', 'Einzelpreis', 'Rabatt', 'Men&uuml;');
        $width = array('10%', '45%', '15%', '10%', '10%', '10%', '10%', '10%');
        $findcols = array('nummer', 'name_de', 'rechnung', 'belegnr', 'menge', 'preis', 'rabatt', 'id');
        $searchsql = array('a.bezeichnung', 'a.nummer', 'auf.belegnr', "DATE_FORMAT(auf.datum,'%d.%m.%Y')", 'a.preis', 'a.rabatt');
        $menu = "<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.nummer as nummer, a.bezeichnung as name_de, auf.belegnr as rechnung, DATE_FORMAT(auf.datum,'%d.%m.%Y'), a.menge as menge, a.preis as preis, 
              a.rabatt as rabatt, a.rechnung as menu
              FROM rechnung_position a LEFT JOIN rechnung auf ON a.rechnung=auf.id LEFT JOIN artikel art ON art.id=a.artikel";

        // fester filter
        $where = " auf.adresse='$id' AND art.serviceartikel=1";
        $count = "SELECT COUNT(a.id) FROM rechnung_position a LEFT JOIN rechnung auf ON a.rechnung=auf.id WHERE auf.adresse='$id'";
        break;
      case "adresse_artikel_geraet":
        $allowed['adresse'] = array('kundeartikel');

        // headings
        $heading = array('Nummer', 'Artikel', 'Rechnung', 'Datum', 'Menge', 'Einzelpreis', 'Rabatt', 'Men&uuml;');
        $width = array('10%', '45%', '15%', '10%', '10%', '10%', '10%', '10%');
        $findcols = array('nummer', 'name_de', 'rechnung', 'belegnr', 'menge', 'preis', 'rabatt', 'id');
        $searchsql = array('a.bezeichnung', 'a.nummer', 'auf.belegnr', "DATE_FORMAT(auf.datum,'%d.%m.%Y')", 'a.preis', 'a.rabatt');
        $menu = "<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.nummer as nummer, a.bezeichnung as name_de, auf.belegnr as rechnung, DATE_FORMAT(auf.datum,'%d.%m.%Y'), a.menge as menge, a.preis as preis, 
              a.rabatt as rabatt, a.rechnung as menu
              FROM rechnung_position a LEFT JOIN rechnung auf ON a.rechnung=auf.id LEFT JOIN artikel art ON art.id=a.artikel";

        // fester filter
        $where = " auf.adresse='$id' AND art.geraet=1";
        $count = "SELECT COUNT(a.id) FROM rechnung_position a LEFT JOIN rechnung auf ON a.rechnung=auf.id WHERE auf.adresse='$id'";
        break;
      case "adresseartikel":
        $allowed['adresse'] = array('kundeartikel');

        // headings
        $heading = array('Nummer', 'Artikel','Rechnung', 'Datum', 'Menge', 'Einzelpreis', 'Rabatt', 'Gesamt', 'Men&uuml;');
        $width = array('10%', '45%', '15%', '10%', '10%', '10%', '10%', '10%', '10%');
        $findcols = array('nummer', 'name_de', 'rechnung', 'belegnr', 'menge', 'preis', 'rabatt', 'gesamt', 'id');
        $searchsql = array('a.bezeichnung', 'a.nummer', 'auf.belegnr', "DATE_FORMAT(auf.datum,'%d.%m.%Y')", 'a.preis', 'a.rabatt');
        $sumcol = 8;
        $menu = "<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.nummer as nummer, a.bezeichnung as name_de, 
              auf.belegnr as rechnung, DATE_FORMAT(auf.datum,'%d.%m.%Y'), a.menge as menge, a.preis as preis, 
              a.rabatt as rabatt, 
              FORMAT(a.preis*a.menge*(IF(a.rabatt > 0, (100-a.rabatt)/100, 1)),2{$extended_mysql55}) as gesamt,
              a.rechnung as menu
                FROM rechnung_position a LEFT JOIN rechnung auf ON a.rechnung=auf.id ";

        // fester filter
        $where = " auf.adresse='$id' ";
        $count = "SELECT COUNT(a.id) FROM rechnung_position a LEFT JOIN rechnung auf ON a.rechnung=auf.id WHERE auf.adresse='$id'";
        break;
      case "lagertabelle":
        $allowed['lager'] = array('list');

        // headings
        $heading = array('Bezeichnung', 'Projekt','Men&uuml;');
        $width = array('70%', '20%', '8%');
        $findcols = array('l.bezeichnung', 'p.abkuerzung', 'l.id');
        $searchsql = array('l.bezeichnung', 'p.abkuerzung','p.name');
        $defaultorder = 3;
        $defaultorderdesc = 1;
        $menu = "<a href=\"index.php?module=lager&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=lager&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=PrintDialog(\"index.php?module=lager&action=regaletiketten&id=%value%&cmd=all\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/labelprinter.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, l.bezeichnung, CONCAT(p.name, ' (',p.abkuerzung,')'),
              l.id as menu FROM lager l 
            LEFT JOIN projekt p ON p.id=l.projekt ";

        // fester filter
        $where = " l.geloescht=0 AND l.id!=0";
        $count = "SELECT COUNT(id) FROM lager WHERE geloescht=0";
        break;
      case "adressestundensatz":
        $allowed['adresse'] = array('stundensatz');
        $heading = array("Projekt-ID", "Projekt", "Typ", "Stundensatz", "Men&uuml;");
        $width = array("10%", "50%", "10%", "15%", "15%");
        $findcols = array("p.id", "p.name", "typ", "satz", "ssid");
        $searchsql = array("p.name");
        $sql = "SELECT SQL_CALC_FOUND_ROWS  p.id, p.abkuerzung, p.name, IFNULL(ss.typ,'Standard') AS typ, 
              IFNULL(ss.satz, (SELECT satz 
                    FROM stundensatz
                    WHERE typ='Standard' AND adresse='$id'
                    ORDER BY datum DESC LIMIT 1)) AS satz,
              IFNULL(ss.id,CONCAT('&projekt=',p.id)) AS ssid
                FROM adresse_rolle ar
                LEFT JOIN projekt as p
                ON ar.parameter=p.id
                LEFT JOIN (SELECT * FROM stundensatz AS dss ORDER BY dss.datum DESC) AS ss
                ON p.id=ss.projekt AND ss.adresse=ar.adresse ";
        $where = " ar.adresse='$id' AND subjekt='Mitarbeiter' AND objekt='Projekt' GROUP BY p.id ";
        $count = "SELECT COUNT(parameter) FROM adresse_rolle WHERE adresse='$id' AND subjekt='Mitarbeiter' AND objekt='Projekt'";
        $menu = "<a href=\"index.php?module=adresse&action=stundensatzedit&user=$id&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=stundensatzdelete&user=$id&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";
        $moreinfo = false;
        break;
      case "adresselohn":
        $allowed['adresse'] = array('lohn');
        $heading = array('Monat', 'Stunden', 'Men&uuml;');
        $width = array('20%', '20%', '20%', '40%');
        $findcols = array('monat', 'stunden');
        $searchsql = array('monat');
        $sql = "SELECT SQL_CALC_FOUND_ROWS id,DATE_FORMAT(von,'%Y-%m') AS monat,  
              SUM(ROUND((UNIX_TIMESTAMP(bis) - UNIX_TIMESTAMP(von))/3600,2)) as stunden
              FROM zeiterfassung ";
        $where = " adresse='$id' GROUP by monat"; //ORDER BY STR_TO_DATE(CONCAT(MONTH(von),',',YEAR(von)), '%m,%Y') ";

        
        //$where = " adresse='$id' GROUP BY monat,jahr ORDER BY STR_TO_DATE(CONCAT(MONTH(von),',',YEAR(von)), '%m,%Y') ";

        $count = "SELECT FOUND_ROWS() AS treffer,MONTHNAME(von) AS monat, YEAR(von) AS jahr
              FROM zeiterfassung WHERE adresse='$id' GROUP BY monat,jahr "; // ORDER BY STR_TO_DATE(CONCAT(MONTH(von),',',YEAR(von)), '%m,%Y');";

        
        //                                                                      SELECT FOUND_ROWS();";

        $menu = "test";
        $moreinfo = false;
        break;
      case "backuplist":
        $allowed['backup'] = array('list');
        $heading = array('Name', 'Dateiname', 'Datum', 'Men&uuml;');
        $width = array('30%', '30%', '20%', '5%');
        $findcols = array('name', 'dateiname', 'datum', 'id');
        $searchsql = array('name', 'datum');
        $sql = "SELECT SQL_CALC_FOUND_ROWS id, name, dateiname, datum, id as menu FROM backup";
        $defaultorder = 4; //Optional wenn andere Reihenfolge gewuenscht
        $defaultorderdesc = 1;

        $where = "";
        $count = "SELECT COUNT(id) FROM backup";
        $menu = "<a href=\"#\" onclick=BackupDialog(\"index.php?module=backup&action=recover&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=backup&action=downloadsnapshot&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/download.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=backup&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";
        break;
      case "projekttabelle":
        $allowed['projekt'] = array('list');

        // headings
        $heading = array('Name', 'Abkuerzung', 'Verantwortlicher', '&Ouml;ffentlich', 'Men&uuml;');
        $width = array('30%', '20%', '20%', '5%', '2%');
        $findcols = array('name', 'abkuerzung', 'verantwortlicher', 'oeffentlich', 'id');
        $searchsql = array('name', 'abkuerzung', 'verantwortlicher');
        $defaultorder = 5; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<a href=\"index.php?module=projekt&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=projekt&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "<!--&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=projekt&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>-->";

        // SQL statement
        
        if ($this->app->Conf->WFdbType == "postgre") $sql = "SELECT id, name, abkuerzung, verantwortlicher, id as menu FROM projekt ";
        else $sql = "SELECT SQL_CALC_FOUND_ROWS p.id, p.name, p.abkuerzung, p.verantwortlicher,
                if(p.oeffentlich,'ja','-') as oeffentlich, p.id as menu FROM projekt p";

        // fester filter
        $where = " p.geloescht=0 AND p.id!=0 " . $this->app->erp->ProjektRechte();
        $count = "SELECT COUNT(id) FROM projekt WHERE geloescht=0";
        break;
      case "paketannahme":
        $allowed['wareneingang'] = array('paketannahme');

        // headings
        $heading = array('Name', 'Kunde', 'Lieferant', 'Land', 'PLZ', 'Ort', 'E-Mail', 'Projekt', 'Men&uuml;');
        $width = array('25%', '10%', '5%', '5%', '5%', '5%', '25%', '5%', '1%');
        $findcols = array('name', 'kundennummer', 'lieferantennummer', 'land', 'plz', 'ort', 'email', 'projekt', 'id');
        
        if ($this->app->erp->Firmendaten("adresse_freitext1_suche")) $searchsql = array('a.ort', 'a.name', 'p.abkuerzung', 'a.land', 'a.plz', 'a.email', 'a.kundennummer', 'a.lieferantennummer', 'a.ansprechpartner', 'a.freifeld1');
        else $searchsql = array('a.ort', 'a.name', 'p.abkuerzung', 'a.land', 'a.plz', 'a.email', 'a.kundennummer', 'a.lieferantennummer', 'a.ansprechpartner');
        $defaultorder = 2;
        $defaultorderdesc = 1;
        $menu = "<a href=\"index.php?module=wareneingang&action=paketannahme&id=%value%&vorlage=adresse\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/forward.png\" border=\"0\"></a>";

        // SQL statement
        
        //if(a.typ = 'herr' OR a.typ = 'frau',CONCAT(a.vorname,' ',a.name),a.name) as name,
            if ($this->app->erp->Firmendaten("adresse_freitext1_suche")) {
              $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, CONCAT(a.name,if(a.freifeld1!='',CONCAT(' (',a.freifeld1,')'),'')) as name,
                    if(a.kundennummer!='',a.kundennummer,'-') as kundennummer,
                      if(a.lieferantennummer!='',a.lieferantennummer,'-') as lieferantennummer, a.land as land, a.plz as plz, a.ort as ort, a.email as email, p.abkuerzung as projekt, a.id as menu
                        FROM  adresse AS a LEFT JOIN projekt p ON p.id=a.projekt ";
            } else {
              $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name as name,
                    if(a.kundennummer!='',a.kundennummer,'-') as kundennummer,
                      if(a.lieferantennummer!='',a.lieferantennummer,'-') as lieferantennummer, a.land as land, a.plz as plz, a.ort as ort, a.email as email, p.abkuerzung as projekt, a.id as menu
                        FROM  adresse AS a LEFT JOIN projekt p ON p.id=a.projekt ";
            }
        // fester filter
        $where = "a.geloescht=0 " . $this->app->erp->ProjektRechte();
        $count = "SELECT COUNT(a.id) FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 " . $this->app->erp->ProjektRechte();
        break;
      case "adresse_import":
        $allowed['adresse_import'] = array('list');

        // headings
        $heading = array('Name', 'Land', 'PLZ', 'Ort', 'E-Mail', 'Men&uuml;');
        $width = array('18%', '5%', '5%', '5%', '5%', '5%');
        $findcols = array('name', 'land', 'plz', 'ort', 'email', 'id');

        //     $defaultorder = 9;  //Optional wenn andere Reihenfolge gewuenscht
        
        //     $defaultorderdesc=1;

        $searchsql = array('a.ort', 'a.name', 'a.land', 'a.plz', 'a.email', 'a.ansprechpartner');
        $menu = "<a href=\"index.php?module=adresse_import&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse_import&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name as name,
              a.land as land, a.plz as plz, a.ort as ort, a.email as email, a.id FROM  adresse_import a ";

        // fester filter
        $where = "a.abgeschlossen!=1 "; //.$this->app->erp->ProjektRechte();

        $count = "SELECT COUNT(a.id) FROM adresse_import a WHERE a.abgeschlossen!=1 ";
        break;

      case "adresse_suche":
        $allowed['adresse'] = array('list');

        // headings
        $heading = array('Name', 'Kunde', 'Lieferant', 'Land', 'PLZ', 'Ort', 'E-Mail', 'Projekt', 'Men&uuml;');
        $width = array('18%', '10%', '5%', '5%', '5%', '5%', '5%', '15%', '10%');
        $findcols = array('name', 'kundennummer', 'lieferantennummer', 'land', 'plz', 'ort', 'email', 'projekt', 'id');
        $defaultorder = 9; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        
        $searchsql = array('a.sonstiges');

        $menu = "<a href=\"index.php?module=adresse&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";

        // SQL statement
        
        //if(a.typ = 'herr' OR a.typ = 'frau',CONCAT(a.vorname,' ',a.name),a.name) as name,

          if ($this->app->erp->Firmendaten("adresse_freitext1_suche")) {
            $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, CONCAT(a.name,if(a.freifeld1!='',CONCAT(' (',a.freifeld1,')'),'')) as name,
                  if(a.kundennummer!='',a.kundennummer,'-') as kundennummer,
                    if(a.lieferantennummer!='',a.lieferantennummer,'-') as lieferantennummer, a.land as land, a.plz as plz, a.ort as ort, a.email as email, p.abkuerzung as projekt, a.id as menu
                      FROM  adresse AS a LEFT JOIN projekt p ON p.id=a.projekt ";
          } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name as name,
                  if(a.kundennummer!='',a.kundennummer,'-') as kundennummer,
                    if(a.lieferantennummer!='',a.lieferantennummer,'-') as lieferantennummer, a.land as land, a.plz as plz, a.ort as ort, a.email as email, p.abkuerzung as projekt, a.id as menu
                      FROM  adresse AS a LEFT JOIN projekt p ON p.id=a.projekt ";
          }

        // fester filter
        $where = "a.geloescht=0 " . $this->app->erp->ProjektRechte();
        $count = "SELECT COUNT(a.id) FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 " . $this->app->erp->ProjektRechte();
        break;
      case "adressevertrieb":
        $allowed['adresse'] = array('list');
        // headings
        $heading = array('Name', 'Kunde', 'Lieferant', 'Land', 'PLZ', 'Ort', 'E-Mail', 'Projekt', 'Men&uuml;');
        $width = array('18%', '10%', '5%', '5%', '5%', '5%', '5%', '15%', '1%');
        $findcols = array('name', 'kundennummer', 'lieferantennummer', 'land', 'plz', 'ort', 'email', 'projekt', 'id');
        $defaultorder = 9; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $module = $this->app->Secure->GetGET("smodule"); 
        if ($this->app->erp->Firmendaten("adresse_freitext1_suche")) $searchsql = array('a.ort', 'a.name', 'p.abkuerzung', 'a.land', 'a.plz', 'a.email', 'a.kundennummer', 'a.lieferantennummer', 'a.ansprechpartner', 'a.freifeld1');
        else $searchsql = array('a.ort', 'a.name', 'p.abkuerzung', 'a.land', 'a.plz', 'a.email', 'a.kundennummer', 'a.lieferantennummer', 'a.ansprechpartner');
        $menu = "<a href=\"index.php?module=$module&action=edit&cmd=change&id=$id&sid=%value%\")><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/forward.png\" border=\"0\"></a>";

        // SQL statement
          
          if ($this->app->erp->Firmendaten("adresse_freitext1_suche")) {
            $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, CONCAT(a.name,if(a.freifeld1!='',CONCAT(' (',a.freifeld1,')'),'')) as name,
                  if(a.kundennummer!='',a.kundennummer,'-') as kundennummer,
                    if(a.lieferantennummer!='',a.lieferantennummer,'-') as lieferantennummer, a.land as land, a.plz as plz, a.ort as ort, a.email as email, p.abkuerzung as projekt, a.id as menu
                      FROM  adresse AS a LEFT JOIN projekt p ON p.id=a.projekt ";
          } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name as name,
                  if(a.kundennummer!='',a.kundennummer,'-') as kundennummer,
                    if(a.lieferantennummer!='',a.lieferantennummer,'-') as lieferantennummer, a.land as land, a.plz as plz, a.ort as ort, a.email as email, p.abkuerzung as projekt, a.id as menu
                      FROM  adresse AS a LEFT JOIN projekt p ON p.id=a.projekt ";
          }

        // fester filter
        $where = "a.geloescht=0 " . $this->app->erp->ProjektRechte();

        $count = "SELECT COUNT(a.id) FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 " . $this->app->erp->ProjektRechte();
        break;

      case "adressetabelle":
        $allowed['adresse'] = array('list');
        // headings
        $heading = array('','Name', 'Kunde', 'Lieferant', 'Land', 'PLZ', 'Ort', 'E-Mail', 'Projekt', 'Men&uuml;');
        $width = array('1%','18%', '10%', '5%', '5%', '5%', '5%', '5%', '15%', '1%');
        $findcols = array('id','name', 'kundennummer', 'lieferantennummer', 'land', 'plz', 'ort', 'email', 'projekt', 'id');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht
        $menucol = 9;
        $moreinfo = true;
        $moreinfoaction = "adr";
        
        $defaultorderdesc = 1;
        
        if ($this->app->erp->Firmendaten("adresse_freitext1_suche")) $searchsql = array('a.ort', 'a.name', 'p.abkuerzung', 'a.land', 'a.plz', 'a.email', 'a.kundennummer', 'a.lieferantennummer', 'a.ansprechpartner', 'a.freifeld1','a.ansprechpartner','a.adresszusatz');
        else $searchsql = array('a.ort', 'a.name', 'p.abkuerzung', 'a.land', 'a.plz', 'a.email', 'a.kundennummer', 'a.lieferantennummer', 'a.ansprechpartner','a.ansprechpartner','a.adresszusatz');
        $menu = "<a href=\"index.php?module=adresse&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";

        // SQL statement
        
        //if(a.typ = 'herr' OR a.typ = 'frau',CONCAT(a.vorname,' ',a.name),a.name) as name,

        $parameter = $this->app->User->GetParameter('table_filter_adresse');
        $parameter = base64_decode($parameter);
        $parameter = json_decode($parameter, true);
          if ($this->app->erp->Firmendaten("adresse_freitext1_suche")) {
            $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, CONCAT(a.name,if(a.freifeld1!='',CONCAT(' (',a.freifeld1,')'),'')) as name,
                  if(a.kundennummer!='',a.kundennummer,'-') as kundennummer,
                    if(a.lieferantennummer!='',a.lieferantennummer,'-') as lieferantennummer, a.land as land, a.plz as plz, a.ort as ort, a.email as email, p.abkuerzung as projekt, a.id as menu
                      FROM  adresse AS a LEFT JOIN projekt p ON p.id=a.projekt ";
          } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, a.name as name,
                  if(a.kundennummer!='',a.kundennummer,'-') as kundennummer,
                    if(a.lieferantennummer!='',a.lieferantennummer,'-') as lieferantennummer, a.land as land, a.plz as plz, a.ort as ort, a.email as email, p.abkuerzung as projekt, a.id as menu
                      FROM  adresse AS a LEFT JOIN projekt p ON p.id=a.projekt ";
          }

        /*
        if(isset($parameter['durchsuchenAnsprechpartner']) && !empty($parameter['durchsuchenAnsprechpartner'])) {
          $subJoins['durchsuchenAnsprechpartner'] = ' LEFT JOIN ansprechpartner ON ansprechpartner.adresse = adresse.id';
        }

        if(isset($parameter['durchsuchenLieferadresse']) && !empty($parameter['durchsuchenLieferadresse'])) {
          $subJoins['durchsuchenLieferadresse'] = ' LEFT JOIN lieferadressen ON lieferadressen.adresse = adresse.id';
        }
        */

        if (isset($parameter['rolle']) && !empty($parameter['rolle'])) {
          if(isset($parameter['gruppe']) &&  !empty($parameter['gruppe'])) {
            $sql .= "
               INNER JOIN adresse_rolle adr ON adr.adresse = a.id AND adr.subjekt LIKE '" . $parameter['rolle'] . "' AND adr.objekt = 'gruppe' AND adr.parameter = '".$parameter['gruppe']."'
                  INNER JOIN gruppen gr ON adr.parameter = gr.id  AND (gr.projekt = 0 OR (1 ".$this->app->erp->ProjektRechte('gr.projekt')."))
            ";            
          } else {
            $sql .= "
               INNER JOIN adresse_rolle adr ON adr.adresse = a.id AND adr.subjekt LIKE '" . $parameter['rolle'] . "' 
            ";            
          }
        }elseif(isset($parameter['gruppe']) &&  !empty($parameter['gruppe'])) {
            $sql .= "
               INNER JOIN adresse_rolle adr ON adr.adresse = a.id AND adr.objekt = 'gruppe' AND adr.parameter = '".$parameter['gruppe']."'  
               INNER JOIN gruppen gr ON adr.parameter = gr.id AND (gr.projekt = 0 OR (1 ".$this->app->erp->ProjektRechte('gr.projekt')."))
            ";            
          }

        /*
        if (isset($parameter['ansprechpartner']) && !empty($parameter['ansprechpartner'])) {
          $sql .= "
             LEFT JOIN ansprechpartner anp ON anp.adresse = a.id AND anp.name LIKE '%" . $parameter['ansprechpartner'] . "%' 
          ";
        }
        */


        // fester filter
        $where = "a.geloescht=0 " . $this->app->erp->ProjektRechte();


        /* STAMMDATEN */
        if(isset($parameter['kundennummer']) && !empty($parameter['kundennummer'])) {
          $paramsArray[] = "a.kundennummer LIKE '%".$parameter['kundennummer']."%' ";
        }

        if(isset($parameter['name']) && !empty($parameter['name'])) {
          $paramsArray[] = "a.name LIKE '%".$parameter['name']."%' ";
        }

        if(isset($parameter['ansprechpartner']) && !empty($parameter['ansprechpartner'])) {
          /*
          $paramsArray[] = "
            a.ansprechpartner LIKE '%".$parameter['ansprechpartner']."%' 
          ";
          */

          $paramsArray[] = "
            ( 
              a.ansprechpartner LIKE '%".$parameter['ansprechpartner']."%' 
              OR
              a.id IN
              (
                SELECT 
                  adresse 
                FROM 
                  ansprechpartner ansp 
                WHERE 
                  ansp.name LIKE '%" . $parameter['ansprechpartner'] . "%'
              )
            )
          ";
        }

        if(isset($parameter['abteilung']) && !empty($parameter['abteilung'])) {
          $paramsArray[] = "a.abteilung LIKE '%".$parameter['abteilung']."%' ";
        }
        if(isset($parameter['adresszusatz']) && !empty($parameter['adresszusatz'])) {
          $paramsArray[] = "a.adresszusatz LIKE '%".$parameter['adresszusatz']."%' ";
        }



        if(isset($parameter['strasse']) && !empty($parameter['strasse'])) {
          $paramsArray[] = "a.strasse LIKE '%".$parameter['strasse']."%' ";
        }

        if(isset($parameter['plz']) && !empty($parameter['plz'])) {
          $paramsArray[] = "a.plz LIKE '".$parameter['plz']."%'";
        }

        if(isset($parameter['ort']) && !empty($parameter['ort'])) {
          $paramsArray[] = "a.ort LIKE '%".$parameter['ort']."%' ";
        }

        if(isset($parameter['land']) && !empty($parameter['land'])) {
          $paramsArray[] = "a.land LIKE '".$parameter['land']."' ";
        }

        if(isset($parameter['ustid']) && !empty($parameter['ustid'])) {
          $paramsArray[] = "a.ustid LIKE '%".$parameter['ustid']."%' ";
        }

        if(isset($parameter['telefon']) && !empty($parameter['telefon'])) {
          $paramsArray[] = "a.telefon LIKE '%".$parameter['telefon']."%' ";
        }

        if(isset($parameter['email']) && !empty($parameter['email'])) {
          $paramsArray[] = "a.email LIKE '%".$parameter['email']."%' ";
        }

        /* XXX */
        if(isset($parameter['kdnrVon']) && !empty($parameter['kdnrVon'])) {
          $paramsArray[] = "a.kundennummer >= '" . $parameter['kdnrVon'] . "'";
        }

        if(isset($parameter['kdnrBis']) && !empty($parameter['kdnrBis'])) {
          $paramsArray[] = "a.kundennummer <= '" . $parameter['kdnrBis'] . "'";
        }

        if(isset($parameter['projekt']) && !empty($parameter['projekt'])) {

          $projektData = $this->app->DB->SelectArr('
            SELECT
              *
            FROM
              projekt
            WHERE
              abkuerzung LIKE "' . $parameter['projekt'] . '"
          ');
          $projektData = reset($projektData);
          $paramsArray[] = "a.projekt = '".$projektData['id']."' ";
        }

        if(isset($parameter['sonstiges']) && !empty($parameter['sonstiges'])) {
          $paramsArray[] = "a.sonstiges LIKE '%".$parameter['sonstiges']."%' ";
        }

        if(isset($parameter['infoAuftragserfassung']) && !empty($parameter['infoAuftragserfassung'])) {
          $paramsArray[] = "a.infoauftragserfassung LIKE '%".$parameter['infoAuftragserfassung']."%' ";
        }

        if(isset($parameter['aktion']) && !empty($parameter['aktion'])) {
          $paramsArray[] = "a.aktion LIKE '%".$parameter['aktion']."%' ";
        }

        if(isset($parameter['freitext']) && !empty($parameter['freitext'])) {
          $paramsArray[] = "a.freitext LIKE '%".$parameter['freitext']."%' ";
        }

        if(isset($parameter['zahlungsweise']) && !empty($parameter['zahlungsweise'])) {
          $paramsArray[] = "a.zahlungsweise LIKE '".$parameter['zahlungsweise']."' ";
        }

        if(isset($parameter['lieferantennummer']) && !empty($parameter['lieferantennummer'])) {
          $paramsArray[] = "a.adresse LIKE '%".$parameter['lieferantennummer']."%' ";
        }

        if(isset($parameter['lieferantennummer']) && !empty($parameter['lieferantennummer'])) {
          $paramsArray[] = "a.adresse LIKE '%".$parameter['lieferantennummer']."%' ";
        }
        
        if(isset($parameter['vertrieb']) && !empty($parameter['vertrieb'])) {
          $paramsArray[] = "a.vertrieb = '".$parameter['vertrieb']."' ";
        }

        if(isset($parameter['innendienst']) && !empty($parameter['innendienst'])) {
          $paramsArray[] = "a.innendienst = '".$parameter['innendienst']."' ";
        }
        
        if(isset($parameter['mitarbeiternummer']) && !empty($parameter['mitarbeiternummer'])) {
          $paramsArray[] = "a.mitarbeiternummer LIKE '%".$parameter['mitarbeiternummer']."%' ";
        }

        /*
        if(isset($parameter['rolle']) && !empty($parameter['rolle'])) {
          $paramsArray[] = "a.rolle LIKE '%".$parameter['rolle']."%' ";
        }
        */

        // projekt, belegnummer, internetnummer, bestellnummer, transaktionsId, freitext, internebemerkung, aktionscodes

        if ($paramsArray) {
          $where .= ' AND ' . implode(' AND ', $paramsArray);
        }

        $count = "SELECT COUNT(a.id) FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 " . $this->app->erp->ProjektRechte();
        break;
      case "artikeltabelleneu":
        $allowed['artikel'] = array('lagerlampe');

        // headings
        $heading = array('', 'Nummer', 'Artikel', 'Im Lager', 'Projekt', 'Men&uuml;');
        $width = array('5%', '10%', '45%', '8%', '15%', '1%');
        $findcols = array('nummer', 'name_de', 'projekt', 'lager', 'id');
        $searchsql = array('a.nummer', 'a.name_de','p.abkuerzung');
        $menu = "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "<!--&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>-->";

        // SQL statement
        
          $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, CONCAT('<input type=\"checkbox\" name=\"artikelmarkiert[]\" value=\"',a.id,'\">') as wahl, a.nummer as nummer, 
                a.name_de as name_de, (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as lager, p.abkuerzung as projekt, a.id as menu                                                                          
                FROM  artikel a LEFT JOIN projekt p ON p.id=a.projekt ";

        // fester filter
        $where = "a.geloescht=0 AND a.neu='1' AND a.shop >0 " . $this->app->erp->ProjektRechte();
        $count = "SELECT COUNT(a.id) FROM artikel a WHERE a.geloescht=0 AND a.shop > 0 AND a.neu=1 " . $this->app->erp->ProjektRechte();
        break;
      case "artikeltabellehinweisausverkauft":
        $allowed['artikel'] = array('lagerlampe');

        // headings
        $heading = array('', 'Nummer', 'Artikel', 'Im Lager', 'Projekt', 'Men&uuml;');
        $width = array('5%', '10%', '45%', '8%', '15%', '10%');
        $findcols = array('nummer', 'name_de', 'projekt', 'id');
        $searchsql = array('a.name_de', 'a.nummer', 'p.abkuerzung');
        $menu = "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "<!--&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>-->";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, CONCAT('<input type=\"checkbox\" name=\"artikelmarkiert[]\" value=\"',a.id,'\">') as wahl, a.nummer as nummer, a.name_de as name_de, (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as lager, p.abkuerzung as projekt, a.id as menu                                                                          
              FROM  artikel a LEFT JOIN projekt p ON p.id=a.projekt ";

        // fester filter
        $where = "a.geloescht=0 AND (a.ausverkauft='1' OR a.gesperrt=1) AND a.shop > 0 AND (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) > 0";
        $count = "SELECT COUNT(a.id) FROM artikel a WHERE a.geloescht=0 AND a.shop > 0 AND (a.ausverkauft=1 OR a.gesperrt=1) AND (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) > 0";
        break;
      case "artikeltabellelagerndabernichtlagernd":
        $allowed['artikel'] = array('lagerlampe');

        // headings
        $heading = array('', 'Nummer', 'Artikel', 'Im Lager', 'Projekt', 'Men&uuml;');
        $width = array('5%', '10%', '45%', '8%', '15%', '10%');
        $findcols = array('nummer', 'name_de', 'projekt', 'id');
        $searchsql = array('a.name_de', 'a.nummer', 'p.abkuerzung');
        $menu = "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "<!--&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>-->";
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, CONCAT('<input type=\"checkbox\" name=\"artikelmarkiert[]\" value=\"',a.id,'\">') as wahl, a.nummer as nummer, a.name_de as name_de, (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as lager, p.abkuerzung as projekt, a.id as menu                                                                          
              FROM  artikel a LEFT JOIN projekt p ON p.id=a.projekt ";
        $where = "a.geloescht=0 AND (a.lieferzeit='lager' || a.lieferzeit='') AND a.lagerartikel=1  AND (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) IS NULL 
              AND a.shop!=0 AND a.gesperrt=0 AND a.ausverkauft!='1' AND a.inaktiv!='1'";
        $count = "SELECT COUNT(a.id) FROM artikel a WHERE a.geloescht=0 AND (a.lieferzeit='lager' || a.lieferzeit='') AND (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) IS NULL 
              AND a.shop!=0 AND a.gesperrt=0 AND a.ausverkauft!='1' AND a.inaktiv!='1'";
        break;
      case "manuellagerlampe":
        $allowed['artikel'] = array('lagerlampe');
        $this->app->Tpl->Add('JQUERYREADY', "$('#green').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#yellow').click( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#red').click( function() { fnFilterColumn3( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#imlager').click( function() { fnFilterColumn4( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#nichtimlager').click( function() { fnFilterColumn5( 0 ); } );");

        // headings
        $heading = array('', 'Ampel', 'Nummer', 'Artikel', 'Lieferant', 'Im Lager', 'Projekt', 'Men&uuml;');
        $width = array('3%', '5%', '10%', '35%', '20%', '8%', '15%', '10%');
        $findcols = array('wahl', 'a.lieferzeit', 'a.nummer', 'a.name_de', 'a.lieferant', 'lager', 'projekt', 'a.id');
        $searchsql = array('a.name_de', 'a.nummer', 'adr.name', 'p.abkuerzung');
        $menu = "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "<!--&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>-->";

        // SQL statement
        
        /*                      CONCAT('<input type=\"checkbox\" class=\"chcktbl2\" name=\"artikelmarkiert[]\" value=\"',a.id,'\">') as wahl,

                                    CONCAT('<img src=./themes/new/images/shop_stock',a.lieferzeit,'.png>') as ampel, 
        */
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, 
              CONCAT('<input type=\"checkbox\" class=\"chcktbl\" name=\"artikelmarkiert[]\" value=\"',a.id,'\">') as wahl, 
              CONCAT('<img src=./themes/new/images/shop_stock',a.lieferzeit,'.png>') as ampel, 

              If(a.inaktiv,CONCAT('<strike>',a.nummer,'</strike>'),a.nummer) as nummer, 
              If(a.inaktiv,CONCAT('<strike>',a.name_de,'</strike>'),a.name_de) as name_de, 
              If(a.inaktiv,CONCAT('<strike>',adr.name,'</strike>'),adr.name) as lieferant, 

              (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as lager, 

              If(a.inaktiv,CONCAT('<strike>',p.abkuerzung,'</strike>'),p.abkuerzung) as projekt, 
              a.id as menu                                                                          
                FROM  artikel a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN  adresse adr ON a.adresse=adr.id ";
        for ($r = 1;$r < 9;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                      function fnFilterColumn' . $r . ' ( i )
                      {
                      if(oMoreData' . $r . $name . '==1)
                      oMoreData' . $r . $name . ' = 0;
                      else
                      oMoreData' . $r . $name . ' = 1;

                      $(\'#' . $name . '\').dataTable().fnFilter( 
                        \'A\',
                        i, 
                        0,0
                        );
                      }
                      ');
        }

        // START EXTRA more
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " a.lieferzeit='green' ";
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        
        if ($more_data2 == 1) $subwhere[] = " a.lieferzeit='yellow' ";
        $more_data3 = $this->app->Secure->GetGET("more_data3");
        
        if ($more_data3 == 1) $subwhere[] = " a.lieferzeit='red' ";
        $more_data4 = $this->app->Secure->GetGET("more_data4");
        
        if ($more_data4 == 1) $subwhere[] = " (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) > 0 ";
        $more_data5 = $this->app->Secure->GetGET("more_data5");
        
        if ($more_data5 == 1) $subwhere[] = " (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) IS NULL ";

        // ENDE EXTRA more
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];

        //            $where = " l.id!='' $tmp";
        
        // fester filter

        $where = "a.geloescht=0 AND a.shop > 0 AND a.lagerartikel=1 AND autolagerlampe!=1 " . $tmp;
        $count = "SELECT COUNT(id) FROM artikel WHERE geloescht=0 AND shop > 0  AND lagerartikel=1";
        break;
      case "autolagerlampe":
        $allowed['artikel'] = array('lagerlampe');

        // headings
        $heading = array('', 'Ampel', 'Art', 'Nummer', 'Artikel', 'Lieferant', 'Im Lager', 'Projekt', 'Men&uuml;');
        $width = array('1%', '7%', '3%', '10%', '30%', '20%', '10%', '10%');
        $findcols = array('a.id', 'a.lieferzeit', 'art', 'a.nummer', 'a.name_de', 'lieferant', 'projekt', 'a.id');
        $searchsql = array('a.name_de', 'a.nummer', 'adr.name', 'p.abkuerzung');
        $menu = "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "<!--&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>-->";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, 

              if(a.autolagerlampe,CONCAT('<input type=\"checkbox\" class=\"chcktbl2\" name=\"artikelmarkiert[',a.id,']\" checked value=\"1\"><input type=\"hidden\" name=\"artikelmarkierthidden[',a.id,']\" value=\"1\">'),
                  CONCAT('<input type=\"checkbox\" class=\"chcktbl2\" name=\"artikelmarkiert[',a.id,']\" value=\"1\"><input type=\"hidden\" name=\"artikelmarkierthidden[',a.id,']\" value=\"0\">')) as wahl, 
                CONCAT('<img src=./themes/new/images/shop_stock',a.lieferzeit,'.png>') as ampel, 

                  if(a.autolagerlampe,'auto','manuell') as art,

                    If(a.inaktiv,CONCAT('<strike>',a.nummer,'</strike>'),a.nummer) as nummer, 
                      If(a.inaktiv,CONCAT('<strike>',a.name_de,'</strike>'),a.name_de) as name_de, 
                      If(a.inaktiv,CONCAT('<strike>',adr.name,'</strike>'),adr.name) as lieferant, 
                      (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as lager, 
                      If(a.inaktiv,CONCAT('<strike>',p.abkuerzung,'</strike>'),p.abkuerzung) as projekt, 

                      a.id as menu                                                                          
                        FROM  artikel a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN  adresse adr ON a.adresse=adr.id ";
        $where = "a.geloescht=0 AND a.shop > 0 AND a.lagerartikel=1 ";
        $count = "SELECT COUNT(id) FROM artikel WHERE geloescht=0 AND shop > 0  AND lagerartikel=1";
        break;
      case "wareneingangartikelmanuellerfassen":
        $allowed['wareneingang'] = array('manuellerfassen');

        // headings
        $heading = array('', 'Nummer', 'Artikel', 'Lagerbestand', 'Projekt', 'Men&uuml;');
        $width = array('open', '10%', '60%', '5%', '15%', '10%');
        $findcols = array('open', 'nummer', 'name_de', 'CAST((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as SIGNED)', 'projekt', 'id');
        $menucol = 5;
        
        if ($this->app->erp->Firmendaten("artikel_suche_kurztext") == "1") {
          $searchsql = array('a.name_de', 'kurztext_de', 'a.nummer', 'p.abkuerzung', "a.hersteller", "a.herstellernummer", "a.anabregs_text", "(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1)");
        } else {
          $searchsql = array('a.name_de', 'a.nummer', 'p.abkuerzung', "a.hersteller", "a.herstellernummer", "(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1)");
        }
        $paket = $this->app->Secure->GetGET("id");
        $menu = "<a href=\"index.php?module=wareneingang&action=distrietiketten&id=$paket&pos=%value%&menge=1&cmd=manuell\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/forward.png\" border=\"0\"></a>";

        // SQL statement
        
        if ($this->app->Conf->WFdbType == "postgre") {
          $sql = "SELECT a.id, '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, a.nummer as nummer, 
                CASE WHEN a.intern_gesperrt='1'
                THEN CONCAT('<strike>',a.name_de,'</strike>',a.name_de)
                END as name_de, 
                    (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as lagerbestand,  p.abkuerzung as projekt, a.id as menu FROM  artikel a LEFT JOIN projekt p ON p.id=a.projekt ";
        } else {
          $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, a.nummer as nummer, 
                CONCAT('<span style=display:none>',a.name_de,'</span><a style=\"font-weight: normal;\" href=\"index.php?module=artikel&action=edit&id=',a.id,'\">',if(a.intern_gesperrt,CONCAT('<strike>',

                if(a.variante,CONCAT(name_de,' <font color=#848484>(Variante von ',(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1),')</font>'),name_de)

                  ,'</strike>'),

                    if(a.variante,CONCAT(name_de,' <font color=#848484>(Variante von ',(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1),')</font>'),name_de)

                      ),'</a>') as name_de, 
                CONCAT('<span style=display:none>',a.name_de,'</span><a style=\"font-weight: normal;\" href=\"index.php?module=artikel&action=lager&id=',a.id,'\">',(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id),'</a>') as lagerbestand,  
                  p.abkuerzung as projekt, a.id as menu 
                  FROM  artikel a LEFT JOIN projekt p ON p.id=a.projekt ";
        }

        // fester filter
        
        //if(a.variante,CONCAT('Variante von ',(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1),': ',a.name_de),a.name_de)

        
        //$where = "a.geloescht=0 ".$this->app->erp->ProjektRechte();

        $where = "a.geloescht=0 " . $this->app->erp->ProjektRechte();
        $moreinfo = true;
        $count = "SELECT COUNT(a.id) FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 " . $this->app->erp->ProjektRechte();
        break;
 
       case "artikeltabellebilder":
        $allowed['artikel'] = array('list');

        // headings
        $heading = array('', 'Bild', 'Nummer', 'Artikel', 'Lagerbestand', 'Projekt', 'Men&uuml;');
        $width = array('open', '5%', '10%', '55%', '5%', '15%', '10%');
        $findcols = array('open', '','nummer', 'name_de', 'CAST((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as SIGNED)', 'projekt', 'id');
        $menucol = 6;
        $defaultorder = 6; //Optional wenn andere Reihenfolge gewuenscht


      if ($this->app->erp->Firmendaten('iconset_dunkel')) {
        $str = '<img src="./themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/keinbild_dunkel.png" width=50>';
      } else {
        $str = '<img src="./themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/keinbild_hell.png" width=50>';
      }


        $defaultorderdesc = 1;
        
        if ($this->app->erp->Firmendaten("artikel_suche_kurztext") == "1") {
          $searchsql = array('a.name_de', 'kurztext_de', 'a.nummer', 'p.abkuerzung', "a.hersteller", "a.herstellernummer", "a.ean", "a.anabregs_text", "(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1)");
        } else {
          $searchsql = array('a.name_de', 'a.nummer', 'p.abkuerzung', "a.hersteller", "a.herstellernummer", "(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1)", "a.ean");
        }
        $menu = "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT 
              SQL_CALC_FOUND_ROWS a.id, 
              '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
                if((SELECT d.id FROM datei_stichwoerter d WHERE d.objekt='Artikel' AND (d.subjekt LIKE 'Shopbild' OR d.subjekt LIKE 'Bild') AND d.parameter=a.id LIMIT 1) > 0,
                        CONCAT('<img src=\"index.php?module=artikel&action=thumbnail&id=',a.id,'\" width=50>'),'$str') as bild,
              a.nummer as nummer, 
              CONCAT('<span style=display:none>',a.name_de,'</span><a style=\"font-weight: normal;\" href=\"index.php?module=artikel&action=edit&id=',a.id,'\">',if(a.intern_gesperrt,CONCAT('<strike>',

              if(a.variante,CONCAT(name_de,' <font color=#848484>(Variante von ',(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1),')</font>'),name_de)

                ,'</strike>'),

                  if(a.variante,CONCAT(name_de,' <font color=#848484>(Variante von ',(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1),')</font>'),name_de)

                    ),'</a>') as name_de, 
              (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as lagerbestand,  
              p.abkuerzung as projekt, a.id as menu 
                FROM  artikel a LEFT JOIN projekt p ON p.id=a.projekt ";

        // fester filter
        
        //if(a.variante,CONCAT('Variante von ',(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1),': ',a.name_de),a.name_de)

        
        //$where = "a.geloescht=0 ".$this->app->erp->ProjektRechte();

        $where = "a.geloescht=0 " . $this->app->erp->ProjektRechte();


        $parameter = $this->app->User->GetParameter('table_filter_artikel');
        $parameter = base64_decode($parameter);
        $parameter = json_decode($parameter, true);

        /* STAMMDATEN */
        if(isset($parameter['name']) && !empty($parameter['name'])) {
          $paramsArray[] = "a.name_de LIKE '%".$parameter['name']."%' ";
        }

        if(isset($parameter['nummer']) && !empty($parameter['nummer'])) {
          $paramsArray[] = "a.nummer LIKE '%".$parameter['nummer']."%' ";
        }

        if(isset($parameter['hersteller']) && !empty($parameter['hersteller'])) {
          $paramsArray[] = "a.hersteller LIKE '%".$parameter['hersteller']."%' ";
        }

        if(isset($parameter['lagerartikel']) && !empty($parameter['lagerartikel'])) {
          $paramsArray[] = "a.lagerartikel = 1 ";
        }

        if(isset($parameter['variante']) && !empty($parameter['variante'])) {
          $paramsArray[] = "a.variante = 1 ";
        }

        if(isset($parameter['freigabenotwending']) && !empty($parameter['freigabenotwending'])) {
          $paramsArray[] = "a.freigabenotwendig = 1 ";
        }

        if(isset($parameter['abverkauf']) && !empty($parameter['abverkauf'])) {
          $paramsArray[] = "a.restmenge > 0 ";
        }


        if(isset($parameter['standardlieferant']) && !empty($parameter['standardlieferant'])) {
          if(isset($parameter['standardlieferant']) && !empty($parameter['standardlieferant'])) {
            $lieferant = $this->app->DB->Select('
              SELECT
                id
              FROM
                adresse
              WHERE
                lieferantennummer = "' . $parameter['standardlieferant'] . '"
            ');

            $paramsArray[] = "a.adresse = '" . $lieferant . "'";
          }
        }

        if(isset($parameter['stueckliste']) && !empty($parameter['stueckliste'])) {
          $paramsArray[] = "a.stueckliste > 0 ";
        }

        if(isset($parameter['justintimestueckliste']) && !empty($parameter['justintimestueckliste'])) {
          $paramsArray[] = "a.juststueckliste > 0 ";
        }

        if(isset($parameter['gesperrt']) && !empty($parameter['gesperrt'])) {
          $paramsArray[] = "a.gesperrt > 0 ";
        }


        if(isset($parameter['projekt']) && !empty($parameter['projekt'])) {

          $projektData = $this->app->DB->SelectArr('
            SELECT
              *
            FROM
              projekt
            WHERE
              abkuerzung LIKE "' . $parameter['projekt'] . '"
          ');
          $projektData = reset($projektData);
          $paramsArray[] = "a.projekt = '".$projektData['id']."' ";
        }


        if(isset($parameter['internebemerkung']) && !empty($parameter['internebemerkung'])) {
          $paramsArray[] = "a.internerkommentar LIKE '%".$parameter['internebemerkung']."%' ";
        }

        if(isset($parameter['ean']) && !empty($parameter['ean'])) {
          $paramsArray[] = "a.ean LIKE '%" . $parameter['ean'] . "%' ";
        }

        if(isset($parameter['herstellernummer']) && !empty($parameter['herstellernummer'])) {
          $paramsArray[] = "a.herstellernummer LIKE '%" . $parameter['herstellernummer'] . "%' ";
        }

        if ($paramsArray) {
          $where .= ' AND ' . implode(' AND ', $paramsArray);
        }


        $moreinfo = true;
        $count = "SELECT COUNT(a.id) FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 " . $this->app->erp->ProjektRechte();
        break;

      case "artikeltabelle":
        $allowed['artikel'] = array('list');

        // headings
        $heading = array('', 'Nummer', 'Artikel', 'Lagerbestand', 'Projekt', 'Men&uuml;');
        $width = array('open', '10%', '60%', '5%', '15%', '8%');
        $findcols = array('open', 'nummer', 'name_de', 'CAST((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as SIGNED)', 'projekt', 'id');
        $menucol = 5;
        $defaultorder = 6; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        
        if ($this->app->erp->Firmendaten("artikel_suche_kurztext") == "1") {
          $searchsql = array('a.nummer','a.name_de', 'CAST((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as SIGNED)','p.abkuerzung','kurztext_de', "a.hersteller", "a.herstellernummer", "a.ean", "a.anabregs_text", "(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1)");
        } else {
          $searchsql = array('a.nummer','a.name_de','CAST((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) as SIGNED)','p.abkuerzung', "a.hersteller", "a.herstellernummer", "(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1)", "a.ean");
        }
        $menu = "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT 
              SQL_CALC_FOUND_ROWS a.id, 
              '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
              a.nummer as nummer, 
              CONCAT('<span style=display:none>',a.name_de,'</span><a style=\"font-weight: normal;\" href=\"index.php?module=artikel&action=edit&id=',a.id,'\">',if(a.intern_gesperrt,CONCAT('<strike>',

              if(a.variante,CONCAT(name_de,' <font color=#848484>(Variante von ',(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1),')</font>'),name_de)

                ,'</strike>'),

                  if(a.variante,CONCAT(name_de,' <font color=#848484>(Variante von ',(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1),')</font>'),name_de)

                    ),'</a>') as name_de, 
              (SELECT SUM(l.menge) FROM lager_platz_inhalt l LEFT JOIN lager_platz lp ON lp.id=l.lager_platz WHERE l.artikel=a.id AND lp.sperrlager!=1) as lagerbestand,  
              p.abkuerzung as projekt, a.id as menu 
                FROM  artikel a LEFT JOIN projekt p ON p.id=a.projekt ";

        // fester filter
        
        //if(a.variante,CONCAT('Variante von ',(SELECT tmp.nummer FROM artikel tmp WHERE a.variante_von=tmp.id LIMIT 1),': ',a.name_de),a.name_de)

        
        //$where = "a.geloescht=0 ".$this->app->erp->ProjektRechte();

        $where = "a.geloescht=0 " . $this->app->erp->ProjektRechte();

        $parameter = $this->app->User->GetParameter('table_filter_artikel');
        $parameter = base64_decode($parameter);
        $parameter = json_decode($parameter, true);

        /* STAMMDATEN */
        if(isset($parameter['name']) && !empty($parameter['name'])) {
          $paramsArray[] = "a.name_de LIKE '%".$parameter['name']."%' ";
        }

        if(isset($parameter['nummer']) && !empty($parameter['nummer'])) {
          $paramsArray[] = "a.nummer LIKE '%".$parameter['nummer']."%' ";
        }

        if(isset($parameter['hersteller']) && !empty($parameter['hersteller'])) {
          $paramsArray[] = "a.hersteller LIKE '%".$parameter['hersteller']."%' ";
        }

        if(isset($parameter['lagerartikel']) && !empty($parameter['lagerartikel'])) {
          $paramsArray[] = "a.lagerartikel = 1 ";
        }

        if(isset($parameter['variante']) && !empty($parameter['variante'])) {
          $paramsArray[] = "a.variante = 1 ";
        }

        if(isset($parameter['freigabenotwending']) && !empty($parameter['freigabenotwending'])) {
          $paramsArray[] = "a.freigabenotwendig = 1 ";
        }

        if(isset($parameter['abverkauf']) && !empty($parameter['abverkauf'])) {
          $paramsArray[] = "a.restmenge > 0 ";
        }


        if(isset($parameter['standardlieferant']) && !empty($parameter['standardlieferant'])) {
          $lieferant = $this->app->DB->Select('
            SELECT
              id
            FROM
              adresse
            WHERE
              lieferantennummer = "' . $parameter['standardlieferant'] . '"
          ');

          $paramsArray[] = "a.adresse = '" . $lieferant . "'";
        }

        if(isset($parameter['stueckliste']) && !empty($parameter['stueckliste'])) {
          $paramsArray[] = "a.stueckliste > 0 ";
        }

        if(isset($parameter['typ']) && !empty($parameter['typ'])) {
          $check = $this->app->DB->Select("SELECT id FROM artikelkategorien WHERE bezeichnung = '".$parameter['typ']."'");
          if($check)
          {
            $paramsArray[] = "a.typ = '".$check."_kat' ";
          } else {
            $paramsArray[] = "a.typ like '".$parameter['typ']."' ";
          }
        }
        
        if(isset($parameter['justintimestueckliste']) && !empty($parameter['justintimestueckliste'])) {
          $paramsArray[] = "a.juststueckliste > 0 ";
        }

        if(isset($parameter['gesperrt']) && !empty($parameter['gesperrt'])) {
          $paramsArray[] = "(a.gesperrt > 0 OR a.intern_gesperrt > 0) ";
        }


        if(isset($parameter['projekt']) && !empty($parameter['projekt'])) {

          $projektData = $this->app->DB->SelectArr('
            SELECT
              *
            FROM
              projekt
            WHERE
              abkuerzung LIKE "' . $parameter['projekt'] . '"
          ');
          $projektData = reset($projektData);
          $paramsArray[] = "a.projekt = '".$projektData['id']."' ";
        }


        if(isset($parameter['internebemerkung']) && !empty($parameter['internebemerkung'])) {
          $paramsArray[] = "a.internerkommentar LIKE '%".$parameter['internebemerkung']."%' ";
        }

        if(isset($parameter['ean']) && !empty($parameter['ean'])) {
          $paramsArray[] = "a.ean LIKE '%" . $parameter['ean'] . "%' ";
        }

        if(isset($parameter['herstellernummer']) && !empty($parameter['herstellernummer'])) {
          $paramsArray[] = "a.herstellernummer LIKE '%" . $parameter['herstellernummer'] . "%' ";
        }

        if ($paramsArray) {
          $where .= ' AND ' . implode(' AND ', $paramsArray);
        }

        $moreinfo = true;
        $count = "SELECT COUNT(a.id) FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 " . $this->app->erp->ProjektRechte();
        break;
      case "chargen":
        $allowed['artikel'] = array('chargen');

        // headings
        $heading = array('Lager', 'Menge', 'Charge', 'Eingang', 'Bemerkung', 'Men&uuml;');
        $width = array('10%', '30%', '20%', '10%', '20%', '5%');
        $findcols = array('l.kurzbezeichnung', 'lm.menge', 'lm.charge', 'lm.datum', 'lm.internebemerkung', 'id');
        $searchsql = array('l.kurzbezeichnung', 'lm.charge', "DATE_FORMAT(lm.datum,'%d.%m.%Y')", 'lm.internebemerkung');
        $menu = "<a href=\"index.php?module=artikel&action=chargedelete&id=$id&sid=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";

        /*<a href=\"index.php?module=artikel&action=edit&id=%value%\" target=\"_blank\">
              <img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";
        */

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS lm.id, IFNULL(l.kurzbezeichnung,'Zwischenlager') as lager, lm.menge, lm.charge, lm.datum as eingang, lm.internebemerkung,  lm.id
              FROM lager_charge lm LEFT JOIN lager_platz l ON l.id=lm.lager_platz";

        // Fester filter
        $where = " lm.artikel='$id' ";

        // gesamt anzahl
        $count = "SELECT COUNT(lm.id) FROM lager_charge lm LEFT JOIN lager_platz l ON l.id=lm.lager_platz WHERE lm.artikel='$id'";
        break;
      case "mindesthaltbarkeitsdatum":
        $allowed['artikel'] = array('mhd');

        // headings
        $heading = array('Lager', 'Menge', 'Verfallsdatum', 'Charge', 'Bemerkung', 'Men&uuml;');
        $width = array('10%', '10%', '20%', '10%', '30%', '5%');
        $findcols = array('l.kurzbezeichnung', 'lm.menge', 'lm.mhddatum', 'lm.charge', 'lm.internebemerkung', 'lm.id');
        $searchsql = array('l.kurzbezeichnung', "menge", "DATE_FORMAT(lm.mhddatum,'%d.%m.%Y')", 'lm.charge', 'lm.internebemerkung');
        $defaultorder = 3;
        $defaultorderdesc = 0;
        $menu = "<a href=\"index.php?module=artikel&action=mhddelete&id=$id&sid=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";

        /*<a href=\"index.php?module=artikel&action=edit&id=%value%\" target=\"_blank\">
              <img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";
        */

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS lm.id, IFNULL(l.kurzbezeichnung,'Zwischenlager') as lager, lm.menge, if(lm.mhddatum <= NOW(),CONCAT('<font color=red>',lm.mhddatum,'</font> abgelaufen seit ',DATEDIFF(NOW(),lm.mhddatum),' Tag(en)'),lm.mhddatum), lm.charge, lm.internebemerkung, lm.id
              FROM lager_mindesthaltbarkeitsdatum lm LEFT JOIN lager_platz l ON l.id=lm.lager_platz ";

        // Fester filter
        $where = " lm.artikel='$id' ";

        // gesamt anzahl
        $count = "SELECT COUNT(lm.id) FROM lager_mindesthaltbarkeitsdatum lm LEFT JOIN lager_platz l ON l.id=lm.lager_platz WHERE lm.artikel='$id'";
        break;
      case "mhdwarning":

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#nurabgelaufen').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#nurbaldabgelaufen').click( function() { fnFilterColumn2( 0 ); } );");
        for ($r = 1;$r < 3;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }
        $heading = array('Artikel', 'Nummer', 'Lager', 'Menge', 'Verfallsdatum', 'Charge', 'Bemerkung', 'Men&uuml;');
        $width = array('25%', '5%', '5%', '5%', '30%', '10%', '10%', '5%');
        $findcols = array('a.name_de', 'a.nummer', 'l.kurzbezeichnung', 'lm.menge', 'lm.mhddatum', 'lm.charge', 'lm.internebemerkung', 'lm.id');
        $searchsql = array('a.name_de', 'a.nummer', 'l.kurzbezeichnung', "DATE_FORMAT(lm.mhddatum,'%d.%m.%Y')", 'lm.charge', 'lm.internebemerkung');
        $menu = "<a href=\"index.php?module=artikel&action=mindesthaltbarkeitsdatum&id=%value%\" target=\"_blank\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";

        /*
               <a href=\"index.php?module=artikel&action=edit&id=%value%\" target=\"_blank\">
               <img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";
        */
        $defaultorder = 5;
        $defaultorderdesc = 0;

        //$this->app->erp->Firmendaten("mhd_warnung_tage");
        
        // SQL statement

        $sql = "SELECT SQL_CALC_FOUND_ROWS lm.id, a.name_de, a.nummer, IFNULL(l.kurzbezeichnung,'Zwischenlager') as lager, lm.menge, 
              if(lm.mhddatum <= NOW(),CONCAT('<font color=red>',lm.mhddatum,'</font> abgelaufen seit ',DATEDIFF(NOW(),lm.mhddatum),' Tag(en)'),lm.mhddatum), lm.charge, lm.internebemerkung, a.id
                FROM lager_mindesthaltbarkeitsdatum lm LEFT JOIN artikel a ON a.id=lm.artikel LEFT JOIN lager_platz l ON l.id=lm.lager_platz ";

        // START EXTRA more
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " DATEDIFF(NOW(),lm.mhddatum) > 0 ";
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        
        if ($more_data2 == 1) $subwhere[] = " DATEDIFF(NOW(),lm.mhddatum) + " . ($this->app->erp->Firmendaten("mhd_warnung_tage") + 1) . " > 0 ";

        // ENDE EXTRA more
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];

        // Fester filter
        $where = " lm.mhddatum IS NOT NULL $tmp";

        // gesamt anzahl
        $count = "SELECT COUNT(lm.id) FROM lager_mindesthaltbarkeitsdatum lm WHERE lm.mhddatum IS NOT NULL ";
        break;
      case "artikel_seriennummern_lager":
        $allowed['artikel'] = array('seriennummern');

        // headings
        $heading = array('Lager', 'Seriennummer', 'Bemerkung', 'Men&uuml;');
        $width = array('10%', '30%', '30%', '5%');
        $findcols = array('kurzbezeichnung', 'seriennummer', 'internebemerkung', 'id');
        $searchsql = array('l.kurzbezeichnung', 'lm.seriennummer', 'lm.internebemerkung');

        $menu = "<a href=\"index.php?module=artikel&action=srnlageredit&id=$id&sid=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a><a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=srnlagerdelete&id=$id&sid=%value%\")><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";
        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS lm.id, IFNULL(l.kurzbezeichnung,'Zwischenlager') as lager, lm.seriennummer, lm.internebemerkung, lm.id
              FROM lager_seriennummern lm LEFT JOIN lager_platz l ON l.id=lm.lager_platz ";

        $where = " lm.artikel='$id' ";
          // gesamt anzahl
        $count = "SELECT COUNT(lm.id) FROM lager_seriennummern lm LEFT JOIN lager_platz l ON l.id=lm.lager_platz WHERE lm.artikel='$id'";

        //Rechte Koppelung
        break;
      case "adresseseriennummern":
        $allowed['adresse'] = array('kundeartikel');

        // headings
        $heading = array('Datum', 'Artikel-Nr.', 'Artikel', 'Seriennummer', 'Lieferschein', 'Men&uuml;');
        $width = array('10%', '10%', '300px', '20%', '5%', '5%');
        $findcols = array('datum', 'nummer', 'name_de', 'seriennummer', 'belegnr', 'id');
        $searchsql = array('a.name_de', 'a.nummer', 'l.belegnr', "DATE_FORMAT(s.lieferung,'%d.%m.%Y')", 's.seriennummer');

        //$menu = "<a href=\"index.php?module=lieferschein&action=edit&id=%value%\" target=\"_blank\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";
        $menu = "<a href=\"index.php?module=artikel&action=srnadresseedit&id=$id&sid=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a><a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=adressesrndelete&id=$id&sid=%value%\")><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";

        // SQL statement
        
        /*                              $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, l.datum, adr.name, lp.seriennummer,

                                            if(l.belegnr > 0,l.belegnr,'-') as belegnr,
                                            l.status as status, l.id
                                            FROM lieferschein_position lp LEFT JOIN lieferschein l ON l.id=lp.lieferschein
                                            LEFT JOIN adresse adr ON adr.id=l.adresse ";
        */
        $sql = "SELECT SQL_CALC_FOUND_ROWS s.id, DATE_FORMAT(s.lieferung,'%d.%m.%Y') as datum, a.nummer,a.name_de, s.seriennummer, CONCAT('<a href=\"index.php?module=lieferschein&action=pdf&id=',s.lieferschein,'\">',l.belegnr,'</a>') as belegnr, s.id
              FROM seriennummern s LEFT JOIN artikel a ON a.id=s.artikel LEFT JOIN lieferschein l ON l.id=s.lieferschein ";

        // Fester filter
        $where = " s.adresse='$id' ";

        // gesamt anzahl
        $count = "SELECT COUNT(s.id) FROM seriennummern s WHERE s.adresse='$id' ";
        break;
      case "artikelseriennummern":

        // headings
        $heading = array('Datum', 'Kunde', 'Seriennummer', 'Lieferschein', 'Men&uuml;');
        $width = array('10%', '30%', '30%', '5%', '5%');
        $findcols = array('datum', 'name', 'seriennummer', 'belegnr', 'id');
        $searchsql = array('adr.name', 'l.belegnr', "DATE_FORMAT(s.lieferung,'%d.%m.%Y')", 's.seriennummer');

        //$menu = "<a href=\"index.php?module=lieferschein&action=edit&id=%value%\" target=\"_blank\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";
        $menu = "<a href=\"#\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";

        // SQL statement
        
        /*                              $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, l.datum, adr.name, lp.seriennummer,

                                            if(l.belegnr > 0,l.belegnr,'-') as belegnr,
                                            l.status as status, l.id
                                            FROM lieferschein_position lp LEFT JOIN lieferschein l ON l.id=lp.lieferschein
                                            LEFT JOIN adresse adr ON adr.id=l.adresse ";
        */
        $sql = "SELECT SQL_CALC_FOUND_ROWS s.id, DATE_FORMAT(s.lieferung,'%d.%m.%Y') as datum, IFNULL(adr.name,''), s.seriennummer, l.belegnr as belegnr, s.id
              FROM seriennummern s LEFT JOIN adresse adr ON adr.id=s.adresse LEFT JOIN lieferschein l ON l.id=s.lieferschein";

        // Fester filter
        $where = " s.artikel='$id' ";

        // gesamt anzahl
        $count = "SELECT COUNT(s.id) FROM seriennummern s WHERE s.artikel='$id' ";
        break;
      case "seriennummernlist":
        $allowed['seriennummern'] = array('list');

        // headings
        $heading = array('Datum', 'Kunden-Nr', 'Kunde', 'Artikel-Nr', 'Artikel', 'Seriennummer', 'Lieferschein', 'Men&uuml;');
        $width = array('10%', '10%', '20%', '10%', '20%', '5%', '5%');
        $findcols = array('s.lieferung', 'adr.kundennummer', 'adr.name', 'a.nummer', 'a.name_de', 's.seriennummer', 'belegnr', 'id');
        $searchsql = array('adr.name', 'l.belegnr', 'adr.kundennummer', 'a.nummer', 'a.name_de', "DATE_FORMAT(s.lieferung,'%d.%m.%Y')", 's.seriennummer');
        $menu = "<a href=\"index.php?module=seriennummern&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a></a><a href=\"#\" onclick=DeleteDialog(\"index.php?module=seriennummern&action=delete&id=%value%\")><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>";
        $sql = "SELECT SQL_CALC_FOUND_ROWS s.id, DATE_FORMAT(s.lieferung,'%d.%m.%Y') as datum, adr.kundennummer,adr.name, a.nummer, a.name_de, s.seriennummer, l.belegnr as belegnr, s.id
              FROM seriennummern s LEFT JOIN adresse adr ON s.adresse=adr.id LEFT JOIN lieferschein l ON s.lieferschein=l.id LEFT JOIN artikel a ON s.artikel=a.id ";

        // Fester filter
        $where = ""; // s.artikel='$id' ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(s.id) FROM seriennummern s "; //WHERE s.artikel='$id' ";

        break;
      case "instueckliste":
        $allowed['artikel'] = array('instueckliste');

        // headings
        $heading = array('Artikel', 'Nummer', 'Menge', 'Men&uuml;');
        $width = array('70%', '10%', '5%', '10%');
        $findcols = array('artikel', 'nummer', 'menge', 'id');
        $searchsql = array('a.name_de', 'a.nummer', 's.menge');
        $defaultorder = 4;
        $defaultorderdesc = 1;
        $menu = "<a href=\"index.php?module=artikel&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>";

        // SQL statement
        
        if ($this->app->Conf->WFdbType == "postgre") {
          $sql = "SELECT s.id, a.name_de as artikel,a.nummer as nummer, s.menge as menge, 
                CASE WHEN (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) > 0
                THEN (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id)
                ELSE 0
                END  as lager, s.artikel as menu
                FROM stueckliste s LEFT JOIN artikel a ON s.artikel=a.id ";
        } else {
          $sql = "SELECT SQL_CALC_FOUND_ROWS s.id, a.name_de as artikel,a.nummer as nummer, s.menge as menge,
                s.stuecklistevonartikel
                  as menu
                  FROM stueckliste s LEFT JOIN artikel a ON s.stuecklistevonartikel=a.id ";
        }

        // Fester filter
        $where = "s.artikel='$id' ";

        // gesamt anzahl
        $count = "SELECT COUNT(s.id) FROM stueckliste s WHERE s.stuecklistevonartikel='$id' ";
        break;
      case "stueckliste":
        $allowed['artikel'] = array('stueckliste');

        // headings
        $heading = array('Artikel', 'Nummer', 'Menge', 'Lager', 'Reserviert', 'Men&uuml;');
        $width = array('50%', '10%', '5%', '5%', '5%', '10%');
        $findcols = array('artikel', 'nummer', 'menge', 'lager', 'reserviert', 'id');
        $searchsql = array('a.name_de', 'a.nummer', 's.menge');
        $menu = "<a href=\"index.php?module=artikel&action=editstueckliste&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=delstueckliste&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=einkaufcopy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT s.id, CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',a.id,'\" target=\"_blank\">',a.name_de,'</a>') as artikel,
              CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',a.id,'\" target=\"_blank\">',a.nummer,'</a>') as nummer, s.menge as menge, 

                CASE WHEN (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id) > 0
                THEN (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=a.id)
                ELSE 0
                END  as lager, 

              CASE WHEN (SELECT SUM(lr.menge) FROM lager_reserviert lr WHERE lr.artikel=a.id)  > 0 
                THEN (SELECT SUM(lr.menge) FROM lager_reserviert lr WHERE lr.artikel=a.id)  
                ELSE 0
                END as reserviert, 

              s.id as menu
                FROM stueckliste s LEFT JOIN artikel a ON s.artikel=a.id ";

        // Fester filter
        $where = "s.stuecklistevonartikel='$id' ";

        // gesamt anzahl
        $count = "SELECT COUNT(s.id) FROM stueckliste s WHERE s.stuecklistevonartikel='$id' ";
        break;
      case "arbeitsnachweiseinbearbeitung":
        $allowed['arbeitsnachweis'] = array('create', 'list');
        $heading = array('', 'Arbeitsnachweis', 'Prefix', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '10%', '40%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'prefix', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'status', 'id');
        $searchsql = array('DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.prefix', 'l.land', 'p.abkuerzung', 'l.status');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=arbeitsnachweis&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=arbeitsnachweis&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=arbeitsnachweis&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 9;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 'ENTWURF' as belegnr, l.prefix as prefix, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              l.name as name,  l.land as land, p.abkuerzung as projekt, 
              UPPER(l.status) as status, l.id
                FROM  arbeitsnachweis l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id  ";

        // Fester filter
        $where = " ( l.status='angelegt') " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM arbeitsnachweis l WHERE ( l.status='angelegt')";
        $moreinfo = true;
        break;
      case "reisekosteninbearbeitung":
        $heading = array('', 'Reisekosten', 'Vom', 'Kd-Nr.', 'Kunde', 'Anlass', 'Projekt', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '30%', '30%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'anlass', 'projekt', 'status', 'id');
        $searchsql = array('DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.anlass', 'p.abkuerzung', 'l.status');
        $defaultorder = 9;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=reisekosten&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=reisekosten&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=reisekosten&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 8;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,
              'ENTWURF' as belegnr, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer, 
              l.name as name, l.anlass as anlass, p.abkuerzung as projekt,
              UPPER(l.status) as status, l.id
                FROM  reisekosten l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id 
                LEFT JOIN adresse ma ON ma.id=l.mitarbeiter ";

        // Fester filter
        $where = " ( l.status='angelegt') " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM reisekosten l WHERE ( l.status='angelegt')";
        $moreinfo = true;
        break;
      case "lieferscheineinbearbeitung":
        $allowed['lieferschein'] = array('create', 'list');

        // headings
        $heading = array('', 'Lieferschein', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Versand', 'Art', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '35%', '5%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'versandart', 'art', 'status', 'id');
        $searchsql = array('l.id', 'DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.land', 'p.abkuerzung', 'l.status', 'l.plz', 'l.id', 'adr.freifeld1', 'l.ihrebestellnummer');
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=lieferschein&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=lieferschein&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" .

        //             "&nbsp;<a href=\"index.php?module=paketmarke&action=create&frame=false&sid=lieferschein&id=%value%\" class=\"popup\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/stamp.png\" border=\"0\"></a>".
        "&nbsp;<a href=\"index.php?module=lieferschein&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 'ENTWURF' as belegnr, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              " . $this->app->erp->MarkerUseredit("l.name", "l.useredittimestamp") . " as kunde, l.land as land, p.abkuerzung as projekt, l.versandart as versandart,  
              l.lieferscheinart as art, UPPER(l.status) as status, l.id
                FROM  lieferschein l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id  ";
        $where = " ( l.status='angelegt') " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM lieferschein l WHERE ( l.status='angelegt')";
        $moreinfo = true;
        break;
      case "arbeitsnachweiseoffene":
        $allowed['arbeitsnachweis'] = array('list');
        $heading = array('', 'Arbeitsnachweis', 'Prefix', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '10%', '40%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'prefix', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'status', 'id');
        $searchsql = array('DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.prefix', 'l.land', 'p.abkuerzung', 'l.status');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=arbeitsnachweis&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=arbeitsnachweis&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=arbeitsnachweis&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 9;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, l.belegnr as belegnr, l.prefix as prefix, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              l.name as name,  l.land as land, p.abkuerzung as projekt, 
              UPPER(l.status) as status, l.id
                FROM  arbeitsnachweis l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id  ";

        // Fester filter
        $where = " l.id!='' AND l.status='freigegeben' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM arbeitsnachweis l WHERE l.status='freigegeben'";
        $moreinfo = true;
        break;
      case "reisekostenoffene":
        $heading = array('', 'Reisekosten', 'Vom', 'Kd-Nr.', 'Kunde', 'Anlass', 'Projekt', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '30%', '30%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'anlass', 'projekt', 'status', 'id');
        $searchsql = array('DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.anlass', 'p.abkuerzung', 'l.status');
        $defaultorder = 9;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=reisekosten&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=reisekosten&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=reisekosten&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 8;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,
              l.belegnr as belegnr, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer, 
              l.name as name, l.anlass as anlass, p.abkuerzung as projekt,
              UPPER(l.status) as status, l.id
                FROM  reisekosten l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id 
                LEFT JOIN adresse ma ON ma.id=l.mitarbeiter ";

        // Fester filter
        $where = " l.id!='' AND l.status='abgeschickt' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM reisekosten l WHERE l.status='abgeschickt'";
        $moreinfo = true;
        break;
 
    case "filiallieferungen_offene":
        $allowed['filiallieferung'] = array('list');

        // headings
        $heading = array( 'Lieferschein', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Versand', 'Art', 'Status', 'Men&uuml;');
        $width = array( '10%', '10%', '10%', '35%', '5%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array( 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'versandart', 'art', 'status', 'id');
        $searchsql = array('DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.land', 'p.abkuerzung', 'l.status', 'l.plz', 'l.id', 'adr.freifeld1', 'l.ihrebestellnummer');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=filiallieferung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=filiallieferung&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" .

        //             "&nbsp;<a href=\"index.php?module=paketmarke&action=create&frame=false&sid=lieferschein&id=%value%\" class=\"popup\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/stamp.png\" border=\"0\"></a>".
        "&nbsp;<a href=\"index.php?module=lieferschein&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id,l.belegnr, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              " . $this->app->erp->MarkerUseredit("l.name", "l.useredittimestamp") . " as kunde, l.land as land, p.abkuerzung as projekt, l.versandart as versandart,  
              l.lieferscheinart as art, UPPER(l.status) as status, l.id
                FROM  lieferschein l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id  ";
        $where = " l.id!='' AND (l.status='versendet' OR l.status='freigegeben') AND l.projektfiliale > 0 AND l.projektfiliale_eingelagert!=1 " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM lieferschein l WHERE (l.status='versendet' OR l.status='freigegeben') AND l.projektfiliale > 0 AND l.projektfiliale_eingelagert!=1";
        break;
 
    case "filiallieferungen_abgeschlossene":
        $allowed['filiallieferung'] = array('list');

        // headings
        $heading = array( 'Lieferschein', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Versand', 'Art', 'Status', 'Men&uuml;');
        $width = array( '10%', '10%', '10%', '35%', '5%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array( 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'versandart', 'art', 'status', 'id');
        $searchsql = array('DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.land', 'p.abkuerzung', 'l.status', 'l.plz', 'l.id', 'adr.freifeld1', 'l.ihrebestellnummer');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=lieferschein&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . 

        //             "&nbsp;<a href=\"index.php?module=paketmarke&action=create&frame=false&sid=lieferschein&id=%value%\" class=\"popup\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/stamp.png\" border=\"0\"></a>".
        "&nbsp;<a href=\"index.php?module=lieferschein&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id,l.belegnr, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              " . $this->app->erp->MarkerUseredit("l.name", "l.useredittimestamp") . " as kunde, l.land as land, p.abkuerzung as projekt, l.versandart as versandart,  
              l.lieferscheinart as art, UPPER(l.status) as status, l.id
                FROM  lieferschein l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id  ";
  
        $where = " l.id!='' AND (l.status='versendet' OR l.status='freigegeben') AND l.projektfiliale > 0 AND l.projektfiliale_eingelagert=1 " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM lieferschein l WHERE (l.status='versendet' OR l.status='freigegeben') AND l.projektfiliale > 0 AND l.projektfiliale_eingelagert=1";

        break;

      case "lieferscheineoffene":
        $allowed['lieferschein'] = array('list');

        // headings
        $heading = array('', 'Lieferschein', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Versand', 'Art', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '35%', '5%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'versandart', 'art', 'status', 'id');
        $searchsql = array('l.id', 'DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.land', 'p.abkuerzung', 'l.status', 'l.plz', 'l.id', 'adr.freifeld1', 'l.ihrebestellnummer');
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=lieferschein&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=lieferschein&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" .

        //             "&nbsp;<a href=\"index.php?module=paketmarke&action=create&frame=false&sid=lieferschein&id=%value%\" class=\"popup\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/stamp.png\" border=\"0\"></a>".
        "&nbsp;<a href=\"index.php?module=lieferschein&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, l.belegnr, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              " . $this->app->erp->MarkerUseredit("l.name", "l.useredittimestamp") . " as kunde, l.land as land, p.abkuerzung as projekt, l.versandart as versandart,  
              l.lieferscheinart as art, UPPER(l.status) as status, l.id
                FROM  lieferschein l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id  ";
        $where = " l.id!='' AND l.status='freigegeben' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM lieferschein l WHERE l.status='freigegeben'";
        $moreinfo = true;
        break;
      case "arbeitsnachweise":
        $allowed['arbeitsnachweis'] = array('list');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#arbeitsnachweisoffen').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#arbeitsnachweisheute').click( function() { fnFilterColumn2( 0 ); } );");
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        for ($r = 1;$r < 3;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // ENDE EXTRA checkboxen
        $heading = array('', '', 'Arbeitsnachweis', 'Prefix', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Status', 'Men&uuml;');
        $width = array('1%', '1%', '10%', '10%', '10%', '10%', '40%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'id', 'belegnr', 'prefix', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'status', 'id');
        $searchsql = array('DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.prefix', 'l.land', 'p.abkuerzung', 'l.status');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=arbeitsnachweis&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=arbeitsnachweis&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=arbeitsnachweis&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 

              CONCAT('<input type=\"checkbox\" name=\"arbeitsnachweis[]\" class=\"checkall\" value=\"',l.id,'\" ',if(l.status!='abgerechnet','checked',''),'>') as auswahl,

              l.belegnr as belegnr, l.prefix as prefix, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              l.name as name,  l.land as land, p.abkuerzung as projekt, 
              UPPER(l.status) as status, l.id
                FROM  arbeitsnachweis l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id  ";

        // Fester filter
        
        // START EXTRA more

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " l.status='freigegeben' ";
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        
        if ($more_data2 == 1) $subwhere[] = " l.datum=CURDATE() ";

        // ENDE EXTRA more
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " l.id!='' AND l.status!='angelegt' $tmp " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM arbeitsnachweis l";
        $moreinfo = true;
        break;
      case "anfrage":

        // START EXTRA checkboxen
        $heading = array('Vom', 'Mitarbeiter', 'Kd-Nr.', 'Kunde', 'Projekt', 'Status', 'Men&uuml;');
        $width = array('15%', '15%', '5%', '30%', '15%', '10%', '5%');
        $findcols = array('vom', 'mitarbeiter', 'kundennummer', 'name', 'projekt', 'status', 'id');
        $searchsql = array('l.datum', 'adr.name', 'adr2.kundennummer', 'l.name', 'p.abkuerzung', 'l.status', 'l.id');
        $defaultorder = 7; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=anfrage&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=anfrage&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=anfrage&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=anfrage&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, 
              adr.name as mitarbeiter,
              adr2.kundennummer,
              l.name,
              p.abkuerzung as projekt,
              UPPER(l.status) as status, l.id
                FROM  anfrage l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.bearbeiterid=adr.id 
                LEFT JOIN adresse adr2 ON l.adresse=adr2.id
                LEFT JOIN adresse ma ON ma.id=l.mitarbeiter ";

        // Fester filter
        
        if ($this->app->User->GetType() != "admin") {
          
          if ($this->app->User->GetProjektleiter()) {

            // normaler angestellter
            $where = " l.id!='' $tmp " . $this->app->erp->ProjektleiterRechte();
            $count = "SELECT COUNT(l.id) FROM anfrage l WHERE  l.id!='' " . $this->app->erp->ProjektleiterRechte();
          } else {

            // normaler angestellter
            $where = " l.id!='' AND l.status!='abgerechnet' AND l.bearbeiterid='" . $this->app->User->GetAdresse() . "'  
                  $tmp " . $this->app->erp->ProjektRechte();
            $count = "SELECT COUNT(l.id) FROM anfrage l WHERE 
                  l.bearbeiterid='" . $this->app->User->GetAdresse() . "' AND l.status!='abgerechnet'";
          }
        } else {
          $where = " l.id!='' $tmp " . $this->app->erp->ProjektRechte();
          $count = "SELECT COUNT(l.id) FROM anfrage l";
        }

        // gesamt anzahl
        
        //$moreinfo = true;

        break;
      case "anfrageinbearbeitung":

        // START EXTRA checkboxen
        $heading = array('Vom', 'Mitarbeiter', 'Kd-Nr.', 'Kunde', 'Projekt', 'Status', 'Men&uuml;');
        $width = array('15%', '15%', '5%', '30%', '15%', '10%', '10%');
        $findcols = array('vom', 'mitarbeiter', 'kundennummer', 'name', 'projekt', 'status', 'id');
        $searchsql = array('l.datum', 'adr.name', 'adr2.kundennummer', 'l.name', 'p.abkuerzung', 'l.status', 'l.id');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=anfrage&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=anfrage&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=anfrage&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, 
              adr.name as mitarbeiter,
              adr2.kundennummer,
              l.name,
              p.abkuerzung as projekt,
              UPPER(l.status) as status, l.id
                FROM  anfrage l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.bearbeiterid=adr.id 
                LEFT JOIN adresse adr2 ON l.adresse=adr2.id
                LEFT JOIN adresse ma ON ma.id=l.mitarbeiter ";

        // Fester filter
        
        if ($this->app->User->GetType() != "admin") {
          
          if ($this->app->User->GetProjektleiter()) {

            // normaler angestellter
            $where = " l.status='angelegt' AND l.id!='' $tmp " . $this->app->erp->ProjektleiterRechte();
            $count = "SELECT COUNT(l.id) FROM anfrage l WHERE  l.id!='' " . $this->app->erp->ProjektleiterRechte();
          } else {

            // normaler angestellter
            $where = " l.id!='' AND l.status='angelegt' AND l.bearbeiterid='" . $this->app->User->GetAdresse() . "'  
                  $tmp " . $this->app->erp->ProjektRechte();
            $count = "SELECT COUNT(l.id) FROM anfrage l WHERE 
                  l.bearbeiterid='" . $this->app->User->GetAdresse() . "' AND l.status='angelegt'";
          }
        } else {
          $where = "l.status='angelegt' AND l.id!='' $tmp " . $this->app->erp->ProjektRechte();
          $count = "SELECT COUNT(l.id) FROM anfrage l WHERE l.status='angelegt'";
        }

        // gesamt anzahl
        
        //$moreinfo = true;

        break;
      case "reisekosten":

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#reisekostenoffen').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#reisekostenheute').click( function() { fnFilterColumn2( 0 ); } );");
        for ($r = 1;$r < 3;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // ENDE EXTRA checkboxen
        $heading = array('', 'Reisekosten', 'Vom', 'Kd-Nr.', 'Kunde', 'Anlass', 'Projekt', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '30%', '30%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'anlass', 'projekt', 'status', 'id');
        $searchsql = array('DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.anlass', 'p.abkuerzung', 'l.status');
        $defaultorder = 9;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=reisekosten&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=reisekosten&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=reisekosten&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 8;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,
              l.belegnr, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer, 
              l.name as name, l.anlass as anlass, p.abkuerzung as projekt,
              UPPER(l.status) as status, l.id
                FROM  reisekosten l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id 
                LEFT JOIN adresse ma ON ma.id=l.mitarbeiter ";

        // Fester filter
        
        // START EXTRA more

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " l.status='abgeschickt' ";
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        
        if ($more_data2 == 1) $subwhere[] = " l.datum=CURDATE() ";

        // ENDE EXTRA more
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " l.id!='' AND l.status!='angelegt' $tmp " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM reisekosten l";
        $moreinfo = true;
        break;
      case "lieferscheine":
        $allowed['lieferschein'] = array('list');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#lieferscheinoffen').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#lieferscheinheute').click( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#anlieferanten').click( function() { fnFilterColumn3( 0 ); } );");
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        for ($r = 1;$r < 4;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('', 'Lieferschein', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Versand', 'Art', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '35%', '5%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'versandart', 'art', 'status', 'id');
        $searchsql = array('l.id', 'DATE_FORMAT(l.datum,\'%d.%m.%Y\')', 'l.belegnr', 'adr.kundennummer', 'l.name', 'l.land', 'p.abkuerzung', 'l.status', 'l.plz', 'l.id', 'adr.freifeld1', 'l.ihrebestellnummer');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=lieferschein&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=lieferschein&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=lieferschein&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>" .

        //             "&nbsp;<a href=\"index.php?module=paketmarke&action=create&frame=false&sid=lieferschein&id=%value%\" class=\"popup\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/stamp.png\" border=\"0\"></a>".
        "&nbsp;<a href=\"index.php?module=lieferschein&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        $parameter = $this->app->User->GetParameter('table_filter_lieferschein');
        $parameter = base64_decode($parameter);
        $parameter = json_decode($parameter, true);

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, l.belegnr, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              " . $this->app->erp->MarkerUseredit("l.name", "l.useredittimestamp") . " as kunde, l.land as land, p.abkuerzung as projekt, l.versandart as versandart,  
              l.lieferscheinart as art, UPPER(l.status) as status, l.id
                FROM  
                  lieferschein l 
                  LEFT JOIN projekt p ON p.id=l.projekt 
                  LEFT JOIN adresse adr ON l.adresse=adr.id
                  LEFT JOIN auftrag auf ON l.auftragid = auf.id
         ";

        // Fester filter
        
        // START EXTRA more

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " l.status='freigegeben' ";
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        
        if ($more_data2 == 1) $subwhere[] = " l.datum=CURDATE() ";
        $more_data3 = $this->app->Secure->GetGET("more_data3");
        
        if ($more_data3 == 1) $subwhere[] = " l.lieferantenretoure=1 ";

        // ENDE EXTRA more
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " l.id!='' AND l.status!='angelegt' $tmp " . $this->app->erp->ProjektRechte();

        /* STAMMDATEN */
        if(isset($parameter['kundennummer']) && !empty($parameter['kundennummer'])) {
          $paramsArray[] = "
            ( l.kundennummer LIKE '%".$parameter['kundennummer']."%' OR auf.kundennummer LIKE '%".$parameter['kundennummer']."%' )
          ";
        }

        if(isset($parameter['name']) && !empty($parameter['name'])) {
          $paramsArray[] = "
            ( l.name LIKE '%".$parameter['name']."%' OR auf.name LIKE '%".$parameter['name']."%' )
          ";
        }

        if(isset($parameter['ansprechpartner']) && !empty($parameter['ansprechpartner'])) {
          $paramsArray[] = "
            ( l.ansprechpartner LIKE '%".$parameter['ansprechpartner']."%' OR auf.ansprechpartner LIKE '%".$parameter['ansprechpartner']."%' )
          ";
        }

        if(isset($parameter['abteilung']) && !empty($parameter['abteilung'])) {
          $paramsArray[] = "
            ( l.abteilung LIKE '".$parameter['abteilung']."' OR auf.abteilung LIKE '".$parameter['abteilung']."' )
          ";
        }

        if(isset($parameter['strasse']) && !empty($parameter['strasse'])) {
          $paramsArray[] = "
            ( l.strasse LIKE '".$parameter['strasse']."' OR auf.strasse LIKE '".$parameter['strasse']."' )
          ";
        }

        if(isset($parameter['plz']) && !empty($parameter['plz'])) {
          $paramsArray[] = "
            ( l.plz LIKE '".$parameter['plz']."%' OR auf.plz LIKE '".$parameter['plz']."%' )
          ";
        }

        if(isset($parameter['ort']) && !empty($parameter['ort'])) {
          $paramsArray[] = "
            ( l.ort LIKE '".$parameter['ort']."%' OR auf.ort LIKE '".$parameter['ort']."%' )
          ";
        }

        if(isset($parameter['land']) && !empty($parameter['land'])) {
          $paramsArray[] = "
            ( l.land LIKE '".$parameter['land']."' OR auf.land LIKE '".$parameter['land']."' )
          ";
        }

        if(isset($parameter['ustid']) && !empty($parameter['ustid'])) {
          $paramsArray[] = "
            ( l.ustid LIKE '".$parameter['ustid']."' OR auf.ustid LIKE '".$parameter['ustid']."' )
          ";
        }

        if(isset($parameter['telefon']) && !empty($parameter['telefon'])) {
          $paramsArray[] = "
            ( l.telefon LIKE '".$parameter['telefon']."' OR auf.telefon LIKE '".$parameter['telefon']."' )
          ";
        }

        /* XXX */
        if(isset($parameter['datumVon']) && !empty($parameter['datumVon'])) {
          $paramsArray[] = "unix_timestamp(l.datum) >= " . strtotime($parameter['datumVon']);
        }

        if(isset($parameter['datumBis']) && !empty($parameter['datumBis'])) {
          $paramsArray[] = "unix_timestamp(l.datum) <= " . strtotime($parameter['datumBis']);
        }

        if(isset($parameter['projekt']) && !empty($parameter['projekt'])) {

          $projektData = $this->app->DB->SelectArr('
            SELECT
              *
            FROM
              projekt
            WHERE
              abkuerzung LIKE "' . $parameter['projekt'] . '"
          ');
          $projektData = reset($projektData);
          $paramsArray[] = "l.projekt = '".$projektData['id']."' ";
        }

        if(isset($parameter['belegnummer']) && !empty($parameter['belegnummer'])) {
          $paramsArray[] = "l.belegnr LIKE '".$parameter['belegnummer']."' ";
        }

        if(isset($parameter['internebemerkung']) && !empty($parameter['internebemerkung'])) {
          $paramsArray[] = "l.internebemerkung LIKE '".$parameter['internebemerkung']."' ";
        }

        if(isset($parameter['aktion']) && !empty($parameter['aktion'])) {
          $paramsArray[] = "l.aktion LIKE '".$parameter['aktion']."' ";
        }

        if(isset($parameter['freitext']) && !empty($parameter['freitext'])) {
          $paramsArray[] = "l.freitext LIKE '".$parameter['freitext']."' ";
        }

        if(isset($parameter['status']) && !empty($parameter['status'])) {
          $paramsArray[] = "l.status LIKE '%".$parameter['status']."%' ";
        }

        if(isset($parameter['versandart']) && !empty($parameter['versandart'])) {
          $paramsArray[] = "l.versandart LIKE '%".$parameter['versandart']."%' ";
        }

        // projekt, belegnummer, internetnummer, bestellnummer, transaktionsId, freitext, internebemerkung, aktionscodes

        if ($paramsArray) {
          $where .= ' AND ' . implode(' AND ', $paramsArray);
        }

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM lieferschein l";
        $moreinfo = true;
        break;
      case "gutschrifteninbearbeitung":
        $allowed['gutschrift'] = array('list');
        $heading = array('', 'Gutschrift', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlweise', 'Betrag', 'bezahlt', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '35%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'zahlungsweise', 'soll', 'zahlung', 'status', 'id');
        $searchsql = array('DATE_FORMAT(r.datum,\'%d.%m.%Y\')', 'r.belegnr', 'adr.kundennummer', 'r.name', 'r.land', 'p.abkuerzung', 'r.zahlungsweise', 'r.status', "FORMAT(r.soll,2{$extended_mysql55})", 'r.zahlungsstatus', 'adr.freifeld1', 'r.ihrebestellnummer');
        $defaultorder = 12; //Optional wenn andere Reihenfolge gewuenscht

        $alignright = array('9');
        $sumcol = 9;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=gutschrift&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 11;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
              'ENTWURF' as belegnr,
              DATE_FORMAT(r.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              " . $this->app->erp->MarkerUseredit("r.name", "r.useredittimestamp") . " as kunde, r.land as land, p.abkuerzung as projekt, r.zahlungsweise as zahlungsweise,  
              FORMAT(r.soll,2{$extended_mysql55}) as soll, r.zahlungsstatus as zahlung, UPPER(r.status) as status, r.id
                FROM  gutschrift r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";

        // Fester filter
        $where = " ( r.status='angelegt') " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(r.id) FROM gutschrift r WHERE ( r.status='angelegt') ";
        $moreinfo = true;
        break;
      case "gutschriftenoffene":
        $allowed['gutschrift'] = array('list');
        $heading = array('', 'Gutschrift', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlweise', 'Betrag', 'bezahlt', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '35%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'zahlungsweise', 'soll', 'zahlung', 'status', 'id');
        $searchsql = array('DATE_FORMAT(r.datum,\'%d.%m.%Y\')', 'r.belegnr', 'adr.kundennummer', 'r.name', 'r.land', 'p.abkuerzung', 'r.zahlungsweise', 'r.status', "FORMAT(r.soll,2{$extended_mysql55})", 'r.zahlungsstatus', 'adr.freifeld1', 'r.ihrebestellnummer');
        $defaultorder = 12; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $alignright = array('9');
        $sumcol = 9;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=gutschrift&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 11;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
              r.belegnr,
              DATE_FORMAT(r.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              " . $this->app->erp->MarkerUseredit("r.name", "r.useredittimestamp") . " as kunde, r.land as land, p.abkuerzung as projekt, r.zahlungsweise as zahlungsweise,  
              FORMAT(r.soll,2{$extended_mysql55}) as soll, r.zahlungsstatus as zahlung, UPPER(r.status) as status, r.id
                FROM  gutschrift r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";

        // Fester filter
        $where = " r.id!='' AND r.status='freigegeben' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(r.id) FROM gutschrift r";
        $moreinfo = true;
        break;
      case "gutschriften":
        $allowed['gutschrift'] = array('list');
        $heading = array('', 'Gutschrift', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlweise', 'Betrag', 'bezahlt', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '35%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'zahlungsweise', 'soll', 'zahlung', 'status', 'id');
        $searchsql = array('DATE_FORMAT(r.datum,\'%d.%m.%Y\')', 'r.belegnr', 'adr.kundennummer', 'r.name', 'r.land', 'p.abkuerzung', 'r.status', "FORMAT(r.soll,2{$extended_mysql55})", 'adr.freifeld1', 'r.ihrebestellnummer');
        $defaultorder = 12; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $alignright = array('9');
        $sumcol = 9;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=gutschrift&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=gutschrift&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 11;

        $parameter = $this->app->User->GetParameter('table_filter_gutschrift');
        $parameter = base64_decode($parameter);
        $parameter = json_decode($parameter, true);

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
              r.belegnr,
              DATE_FORMAT(r.datum,'%Y-%m-%d') as vom, adr.kundennummer as kundennummer,
              " . $this->app->erp->MarkerUseredit("r.name", "r.useredittimestamp") . " as kunde, r.land as land, p.abkuerzung as projekt, r.zahlungsweise as zahlungsweise,  
              FORMAT(r.soll,2{$extended_mysql55}) as soll, r.zahlungsstatus as zahlung, UPPER(r.status) as status, r.id
                FROM  gutschrift r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";



        // Fester filter
        
        //if($tmp!="")$tmp .= " AND r.belegnr!='' ";

        $where = " r.status!='angelegt' AND  r.id!='' " . $this->app->erp->ProjektRechte();

        /* STAMMDATEN */
        if(isset($parameter['kundennummer']) && !empty($parameter['kundennummer'])) {
          $paramsArray[] = "r.kundennummer LIKE '%".$parameter['kundennummer']."%' ";
        }

        if(isset($parameter['name']) && !empty($parameter['name'])) {
          $paramsArray[] = "r.name LIKE '%".$parameter['name']."%' ";
        }

        if(isset($parameter['ansprechpartner']) && !empty($parameter['ansprechpartner'])) {
          $paramsArray[] = "r.ansprechpartner LIKE '%".$parameter['ansprechpartner']."%' ";
        }

        if(isset($parameter['abteilung']) && !empty($parameter['abteilung'])) {
          $paramsArray[] = "r.abteilung LIKE '".$parameter['abteilung']."' ";
        }

        if(isset($parameter['strasse']) && !empty($parameter['strasse'])) {
          $paramsArray[] = "r.strasse LIKE '".$parameter['strasse']."' ";
        }

        if(isset($parameter['plz']) && !empty($parameter['plz'])) {
          $paramsArray[] = "r.plz LIKE '".$parameter['plz']."%'";
        }

        if(isset($parameter['ort']) && !empty($parameter['ort'])) {
          $paramsArray[] = "r.ort LIKE '".$parameter['ort']."%' ";
        }

        if(isset($parameter['land']) && !empty($parameter['land'])) {
          $paramsArray[] = "r.land LIKE '".$parameter['land']."' ";
        }

        if(isset($parameter['ustid']) && !empty($parameter['ustid'])) {
          $paramsArray[] = "r.ustid LIKE '".$parameter['ustid']."' ";
        }

        if(isset($parameter['telefon']) && !empty($parameter['telefon'])) {
          $paramsArray[] = "r.telefon LIKE '".$parameter['telefon']."' ";
        }

        if(isset($parameter['ustid']) && !empty($parameter['ustid'])) {
          $paramsArray[] = "r.ustid LIKE '".$parameter['ustid']."' ";
        }

        /* XXX */
        if(isset($parameter['datumVon']) && !empty($parameter['datumVon'])) {
          $paramsArray[] = "unix_timestamp(r.datum) >= " . strtotime($parameter['datumVon']);
        }

        if(isset($parameter['datumBis']) && !empty($parameter['datumBis'])) {
          $paramsArray[] = "unix_timestamp(r.datum) <= " . strtotime($parameter['datumBis']);
        }

        if(isset($parameter['projekt']) && !empty($parameter['projekt'])) {

          $projektData = $this->app->DB->SelectArr('
            SELECT
              *
            FROM
              projekt
            WHERE
              abkuerzung LIKE "' . $parameter['projekt'] . '"
          ');
          $projektData = reset($projektData);
          $paramsArray[] = "r.projekt = '".$projektData['id']."' ";
        }

        if(isset($parameter['belegnummer']) && !empty($parameter['belegnummer'])) {
          $paramsArray[] = "r.belegnr LIKE '".$parameter['belegnummer']."' ";
        }

        if(isset($parameter['internebemerkung']) && !empty($parameter['internebemerkung'])) {
          $paramsArray[] = "r.internebemerkung LIKE '".$parameter['internebemerkung']."' ";
        }

        if(isset($parameter['aktion']) && !empty($parameter['aktion'])) {
          $paramsArray[] = "r.aktion LIKE '".$parameter['aktion']."' ";
        }

        if(isset($parameter['freitext']) && !empty($parameter['freitext'])) {
          $paramsArray[] = "r.freitext LIKE '".$parameter['freitext']."' ";
        }

        if(isset($parameter['zahlungsweise']) && !empty($parameter['zahlungsweise'])) {
          $paramsArray[] = "r.zahlungsweise LIKE '".$parameter['zahlungsweise']."' ";
        }

        if(isset($parameter['status']) && !empty($parameter['status'])) {
          $paramsArray[] = "r.status LIKE '%".$parameter['status']."%' ";
        }

        if(isset($parameter['versandart']) && !empty($parameter['versandart'])) {
          $paramsArray[] = "r.versandart LIKE '%".$parameter['versandart']."%' ";
        }

        if(isset($parameter['betragVon']) && !empty($parameter['betragVon'])) {
          $paramsArray[] = "r.soll >= '" . $parameter['betragVon'] . "' ";
        }

        if(isset($parameter['betragBis']) && !empty($parameter['betragBis'])) {
          $paramsArray[] = "r.soll <= '" . $parameter['betragBis'] . "' ";
        }

        // projekt, belegnummer, internetnummer, bestellnummer, transaktionsId, freitext, internebemerkung, aktionscodes

        if ($paramsArray) {
          $where .= ' AND ' . implode(' AND ', $paramsArray);
        }

        // gesamt anzahl
        $count = "SELECT COUNT(r.id) FROM gutschrift r WHERE r.status='freigegeben'";
        $moreinfo = true;

        /*
            // headings
            $heading =  array('','Vom','Kunde','Gutschrift','Land','Projekt','Zahlung','Betrag','Zahlung','Status','Men&uuml;');
            $width   =  array('1%','1%','40%','1%','1%','1%','1%','1%','1%','1%');
            $findcols = array('open','vom','name','land','projekt','zahlungsweise','betrag','zahlung','status','icons','id');
            $searchsql = array('r.id','r.datum','r.belegnr','adr.kundennummer','r.name','r.land','p.abkuerzung','r.zahlungsweise','r.status','r.soll','r.ist','r.zahlungsstatus','r.plz','r.id');
        
            $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>".
            "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=gutschrift&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>".
            "&nbsp;<a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        
            $menucol=10;
            // SQL statement
            $sql = "SELECT SQL_CALC_FOUND_ROWS r.id,'<img src=/themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, DATE_FORMAT(r.datum,'%Y-%m-%d') as vom, 
            r.name as name, r.belegnr, r.land as land, p.abkuerzung as projekt, r.zahlungsweise as zahlungsweise,  
            r.soll as soll, r.zahlungsstatus as zahlung, UPPER(r.status) as status, r.id
            FROM  gutschrift r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";
            // Fester filter
        
        
            $where = " r.id!='' AND r.status='freigegeben' ";
        
            // gesamt anzahl
            $count = "SELECT COUNT(r.id) FROM gutschrift r WHERE r.status='freigegeben'";
        
            $moreinfo = true;
        */
        break;
      case "rechnungeninbearbeitung":
        $allowed['rechnung'] = array('list', 'create');

        // headings
        $heading = array('', 'Rechnung', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Zahlung', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '35%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'zahlungsweise', 'soll', 'zahlung', 'status', 'id');
        $searchsql = array('DATE_FORMAT(r.datum,\'%d.%m.%Y\')', 'r.belegnr', 'adr.kundennummer', 'r.name', 'r.land', 'p.abkuerzung', 'r.zahlungsweise', 'r.status', "FORMAT(r.soll,2{$extended_mysql55})", 'r.zahlungsstatus', 'adr.freifeld1', 'r.ihrebestellnummer');
        $defaultorder = 12; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $alignright = array('9');
        $sumcol = 9;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=rechnung&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 11;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 'ENTWURF' as belegnr, DATE_FORMAT(r.datum,'%Y-%m-%d') as vom, 
              adr.kundennummer, " . $this->app->erp->MarkerUseredit("r.name", "r.useredittimestamp") . " as kunde, r.land as land, p.abkuerzung as projekt, r.zahlungsweise as zahlungsweise,  
              FORMAT(r.soll,2{$extended_mysql55}) as soll, r.zahlungsstatus as zahlung, UPPER(r.status) as status, r.id
                FROM  rechnung r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";

        // Fester filter
        $where = " ( r.status='angelegt') " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(r.id) FROM rechnung r WHERE ( r.status='angelegt') ";
        $moreinfo = true;
        break;
      case "rechnungenoffene":

        // headings
        $allowed['rechnung'] = array('list');
        $heading = array('', 'Rechnung', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Zahlung', 'Status', 'Men&uuml;');

        //$width   =  array('1%','2%','5%','5%','50%','3%','3%','3%','3%','3%','3%','3%');
        $width = array('1%', '10%', '10%', '10%', '35%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'zahlungsweise', 'soll', 'zahlung', 'status', 'id');
        $searchsql = array('DATE_FORMAT(r.datum,\'%d.%m.%Y\')', 'r.belegnr', 'adr.kundennummer', 'r.name', 'r.land', 'p.abkuerzung', 'r.zahlungsweise', 'r.status', "FORMAT(r.soll,2{$extended_mysql55})", 'r.zahlungsstatus', 'adr.freifeld1', 'r.ihrebestellnummer');
        $defaultorder = 12; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $alignright = array('9');
        $sumcol = 9;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=rechnung&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 11;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, r.belegnr as belegnr, DATE_FORMAT(r.datum,'%Y-%m-%d') as vom, 
              adr.kundennummer, " . $this->app->erp->MarkerUseredit("r.name", "r.useredittimestamp") . " as kunde, r.land as land, p.abkuerzung as projekt, r.zahlungsweise as zahlungsweise,  
              FORMAT(r.soll,2{$extended_mysql55}) as soll, r.zahlungsstatus as zahlung, UPPER(r.status) as status, r.id
                FROM  rechnung r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";

        // Fester filter
        $where = " r.id!='' AND r.status='freigegeben' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(r.id) FROM rechnung r WHERE r.status='freigegeben'";
        $moreinfo = true;
        break;
      case "rechnungen":
        $allowed['rechnung'] = array('list');
        $this->app->Tpl->Add('JQUERYREADY', "$('#zahlungseingang').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#zahlungseingangfehlt').click( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#rechnungenheute').click( function() { fnFilterColumn3( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#rechnungenstorniert').click( function() { fnFilterColumn4( 0 ); } );");
        $defaultorder = 12; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $alignright = array('9');
        $sumcol = 9;
        for ($r = 1;$r < 5;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // headings
        $heading = array('', 'Rechnung', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Zahlung', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '35%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'zahlungsweise', 'soll', 'zahlung', 'status', 'id');
        $searchsql = array('DATE_FORMAT(r.datum,\'%d.%m.%Y\')', 'r.belegnr', 'adr.kundennummer', 'r.name', 'r.land', 'p.abkuerzung', 'r.zahlungsweise', 'r.status', "FORMAT(r.soll,2{$extended_mysql55})", 'r.zahlungsstatus', 'adr.freifeld1', 'r.ihrebestellnummer');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=rechnung&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=rechnung&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 11;

        $parameter = $this->app->User->GetParameter('table_filter_rechnung');
        $parameter = base64_decode($parameter);
        $parameter = json_decode($parameter, true);

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, r.belegnr, DATE_FORMAT(r.datum,'%Y-%m-%d') as vom, 
              adr.kundennummer, " . $this->app->erp->MarkerUseredit("r.name", "r.useredittimestamp") . " as kunde, r.land as land, p.abkuerzung as projekt, r.zahlungsweise as zahlungsweise,  
              FORMAT(r.soll,2{$extended_mysql55}) as soll, r.zahlungsstatus as zahlung, UPPER(r.status) as status, r.id
                FROM  rechnung r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";

        // Fester filter
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " r.zahlungsstatus='bezahlt' ";

        $more_data2 = $this->app->Secure->GetGET("more_data2");
        if ($more_data2 == 1) $subwhere[] = " r.zahlungsstatus!='bezahlt' ";

        $more_data3 = $this->app->Secure->GetGET("more_data3");
        if ($more_data3 == 1) {
          $subwhere[] = " r.datum=CURDATE() ";
          $ignore = true;
        }

        $more_data4 = $this->app->Secure->GetGET("more_data4");
        if ($more_data4 == 1) $subwhere[] = " r.status='storniert' ";

        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        
        if ($tmp != "" && !$ignore) $tmp.= " AND r.belegnr!='' ";
        $where = " r.id!='' AND r.status!='angelegt' $tmp " . $this->app->erp->ProjektRechte();

        /* STAMMDATEN */
        if(isset($parameter['kundennummer']) && !empty($parameter['kundennummer'])) {
          $paramsArray[] = "r.kundennummer LIKE '%".$parameter['kundennummer']."%' ";
        }

        if(isset($parameter['name']) && !empty($parameter['name'])) {
          $paramsArray[] = "r.name LIKE '%".$parameter['name']."%' ";
        }

        if(isset($parameter['ansprechpartner']) && !empty($parameter['ansprechpartner'])) {
          $paramsArray[] = "r.ansprechpartner LIKE '%".$parameter['ansprechpartner']."%' ";
        }

        if(isset($parameter['abteilung']) && !empty($parameter['abteilung'])) {
          $paramsArray[] = "r.abteilung LIKE '".$parameter['abteilung']."' ";
        }

        if(isset($parameter['strasse']) && !empty($parameter['strasse'])) {
          $paramsArray[] = "r.strasse LIKE '".$parameter['strasse']."' ";
        }

        if(isset($parameter['plz']) && !empty($parameter['plz'])) {
          $paramsArray[] = "r.plz LIKE '".$parameter['plz']."%'";
        }

        if(isset($parameter['ort']) && !empty($parameter['ort'])) {
          $paramsArray[] = "r.ort LIKE '".$parameter['ort']."%' ";
        }

        if(isset($parameter['land']) && !empty($parameter['land'])) {
          $paramsArray[] = "r.land LIKE '".$parameter['land']."' ";
        }

        if(isset($parameter['ustid']) && !empty($parameter['ustid'])) {
          $paramsArray[] = "r.ustid LIKE '".$parameter['ustid']."' ";
        }

        if(isset($parameter['telefon']) && !empty($parameter['telefon'])) {
          $paramsArray[] = "r.telefon LIKE '".$parameter['telefon']."' ";
        }

        /* XXX */
        if(isset($parameter['datumVon']) && !empty($parameter['datumVon'])) {
          $paramsArray[] = "unix_timestamp(r.datum) >= " . strtotime($parameter['datumVon']);
        }

        if(isset($parameter['datumBis']) && !empty($parameter['datumBis'])) {
          $paramsArray[] = "unix_timestamp(r.datum) <= " . strtotime($parameter['datumBis']);
        }

        if(isset($parameter['projekt']) && !empty($parameter['projekt'])) {

          $projektData = $this->app->DB->SelectArr('
            SELECT
              *
            FROM
              projekt
            WHERE
              abkuerzung LIKE "' . $parameter['projekt'] . '"
          ');
          $projektData = reset($projektData);
          $paramsArray[] = "r.projekt = '".$projektData['id']."' ";
        }

        if(isset($parameter['belegnummer']) && !empty($parameter['belegnummer'])) {
          $paramsArray[] = "r.belegnr LIKE '".$parameter['belegnummer']."' ";
        }

        if(isset($parameter['internebemerkung']) && !empty($parameter['internebemerkung'])) {
          $paramsArray[] = "r.internebemerkung LIKE '".$parameter['internebemerkung']."' ";
        }

        if(isset($parameter['aktion']) && !empty($parameter['aktion'])) {
          $paramsArray[] = "r.aktion LIKE '".$parameter['aktion']."' ";
        }

        if(isset($parameter['freitext']) && !empty($parameter['freitext'])) {
          $paramsArray[] = "r.freitext LIKE '".$parameter['freitext']."' ";
        }

        if(isset($parameter['zahlungsweise']) && !empty($parameter['zahlungsweise'])) {
          $paramsArray[] = "r.zahlungsweise LIKE '".$parameter['zahlungsweise']."' ";
        }

        if(isset($parameter['status']) && !empty($parameter['status'])) {
          $paramsArray[] = "r.status LIKE '%".$parameter['status']."%' ";
        }

        if(isset($parameter['versandart']) && !empty($parameter['versandart'])) {
          $paramsArray[] = "r.versandart LIKE '%".$parameter['versandart']."%' ";
        }

        if(isset($parameter['betragVon']) && !empty($parameter['betragVon'])) {
          $paramsArray[] = "r.soll >= '" . $parameter['betragVon'] . "' ";
        }

        if(isset($parameter['betragBis']) && !empty($parameter['betragBis'])) {
          $paramsArray[] = "r.soll <= '" . $parameter['betragBis'] . "' ";
        }

        // projekt, belegnummer, internetnummer, bestellnummer, transaktionsId, freitext, internebemerkung, aktionscodes

        if ($paramsArray) {
          $where .= ' AND ' . implode(' AND ', $paramsArray);
        }

        // gesamt anzahl
        $count = "SELECT COUNT(r.id) FROM rechnung r ";
        $moreinfo = true;
        break;
      case "bestellungeninbearbeitung":
        $allowed['bestellung'] = array('create', 'list');

        // headings
        $heading = array('', 'Bestellung', 'Vom', 'Lf-Nr.', 'Lieferant', 'Land', 'Projekt', 'Betrag', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '40%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'lieferantennummer', 'lieferant', 'land', 'projekt', 'summe', 'status', 'icons', 'id');
        $searchsql = array('DATE_FORMAT(b.datum,\'%d.%m.%Y\')', 'b.belegnr', 'adr.lieferantennummer', 'b.name', 'b.land', 'p.abkuerzung', 'b.status', 'b.gesamtsumme');
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $alignright = array('8');
        $sumcol = 8;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=bestellung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=bestellung&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=bestellung&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 9;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS b.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 'ENTWURF' as belegnr, DATE_FORMAT(b.datum,'%Y-%m-%d') as vom, adr.lieferantennummer as lieferantennummer,
              " . $this->app->erp->MarkerUseredit("b.name", "b.useredittimestamp") . " as lieferant,  b.land as land, p.abkuerzung as projekt,  
              FORMAT(b.gesamtsumme,2{$extended_mysql55}) as summe, UPPER(b.status) as status, b.id
                FROM  bestellung b LEFT JOIN projekt p ON p.id=b.projekt LEFT JOIN adresse adr ON b.adresse=adr.id  ";

        // Fester filter
        $where = " ( b.status='angelegt') " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(b.id) FROM bestellung b WHERE ( b.status='angelegt') ";
        $moreinfo = true;
        break;
      case "bestellungenoffene":

        // headings
        $heading = array('', 'Vom', 'Lf-Nr.', 'Lieferant', 'Land', 'Projekt', 'Betrag', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '40%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'vom', 'lieferantennummer', 'lieferant', 'land', 'projekt', 'betrag', 'status', 'icons', 'id');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'adr.lieferantennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', 'a.gesamtsumme', 'a.status');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=bestellung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=bestellung&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=bestellung&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 8;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS b.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, DATE_FORMAT(b.datum,'%Y-%m-%d') as vom, adr.lieferantennummer as lieferantennummer,
              " . $this->app->erp->MarkerUseredit("b.name", "b.useredittimestamp") . " as lieferant,  b.land as land, p.abkuerzung as projekt,  
              b.gesamtsumme as summe, UPPER(b.status) as status, b.id
                FROM  bestellung b LEFT JOIN projekt p ON p.id=b.projekt LEFT JOIN adresse adr ON b.adresse=adr.id  ";

        // Fester filter
        $where = " b.id!='' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(b.id) FROM bestellung b";
        $moreinfo = true;

        // gesamt anzahl
        $count = "SELECT COUNT(b.id) FROM bestellung b WHERE b.status='freigegeben'";
        $moreinfo = true;
        break;

        //offene
        
      case "bestellungen":
        $allowed['bestellung'] = array('list');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#bestellungenoffen').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#bestellungnichtbestaetigt').click( function() { fnFilterColumn2( 0 ); } );");
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $sumcol = 8;
        $alignright = array(8);
        for ($r = 1;$r < 3;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('', 'Bestellung', 'Vom', 'Lf-Nr.', 'Lieferant', 'Land', 'Projekt', 'Betrag', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '10%', '30%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'lieferantennummer', 'lieferant', 'land', 'projekt', 'summe', 'status', 'icons', 'id');
        $searchsql = array('DATE_FORMAT(b.datum,\'%d.%m.%Y\')', 'b.belegnr', 'adr.lieferantennummer', 'b.name', 'b.land', 'p.abkuerzung', 'b.status', 'b.gesamtsumme');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=bestellung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=bestellung&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=bestellung&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=bestellung&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 9;

        $parameter = $this->app->User->GetParameter('table_filter_bestellung');
        $parameter = base64_decode($parameter);
        $parameter = json_decode($parameter, true);

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS b.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
              if(b.status='storniert',CONCAT(b.belegnr),b.belegnr) as belegnr, 
                if(b.status='storniert',CONCAT(DATE_FORMAT(b.datum,'%Y-%m-%d')),DATE_FORMAT(b.datum,'%Y-%m-%d')) as vom, 
                  if(b.status='storniert',CONCAT(adr.lieferantennummer),adr.lieferantennummer) as lieferantennummer,  
                    if(b.status='storniert',CONCAT(" . $this->app->erp->MarkerUseredit("b.name", "b.useredittimestamp") . ")," . $this->app->erp->MarkerUseredit("b.name", "b.useredittimestamp") . ") as lieferant,  
                      if(b.status='storniert',CONCAT(b.land),b.land) as land, 
                        if(b.status='storniert',CONCAT(p.abkuerzung),p.abkuerzung) as projekt,
                          if(b.status='storniert',CONCAT(FORMAT(b.gesamtsumme,2{$extended_mysql55})),FORMAT(b.gesamtsumme,2{$extended_mysql55})) as summe, 
                            if(b.status='storniert',CONCAT('<font color=red>',UPPER(b.status),'</font>'),UPPER(b.status)) as status, b.id 
        ";

        $sql .= " 
        FROM  bestellung b 
        LEFT JOIN projekt p ON p.id=b.projekt 
        LEFT JOIN adresse adr ON b.adresse=adr.id  ";

        if(isset($parameter['artikel']) && !empty($parameter['artikel'])) {

          $artikelData = $this->app->DB->SelectArr('
            SELECT
              id
            FROM
              artikel
            WHERE
              nummer = ' . $parameter['artikel'] . '
          ');

          if ($artikelData) {
            $artikelData = reset($artikelData);
            $sql .= "
              RIGHT JOIN bestellung_position bp ON bp.bestellung = b.id AND bp.artikel = " . $artikelData['id'] . " 
            ";
          }
        }

        // Fester filter
        
        //FORMAT(b.gesamtsumme,2,'de_DE')

        
        // START EXTRA more

        
        // TODO: status abgeschlossen muss noch umgesetzt werden

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        if ($more_data1 == 1) $subwhere[] = " b.status!='abgeschlossen' ";

        $more_data2 = $this->app->Secure->GetGET("more_data2");
        if ($more_data2 == 1) $subwhere[] = " b.bestellung_bestaetigt!='1' AND b.status!='abgeschlossen' ";


        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];

        // START EXTRA more
        $where = " b.id!='' AND b.status!='angelegt' $tmp " . $this->app->erp->ProjektRechte();

      /* STAMMDATEN */
        if(isset($parameter['name']) && !empty($parameter['name'])) {
          $paramsArray[] = "b.name LIKE '%".$parameter['name']."'% ";
        }

        if(isset($parameter['ansprechpartner']) && !empty($parameter['ansprechpartner'])) {
          $paramsArray[] = "b.ansprechpartner LIKE '%".$parameter['ansprechpartner']."%' ";
        }

        if(isset($parameter['abteilung']) && !empty($parameter['abteilung'])) {
          $paramsArray[] = "b.abteilung LIKE '%".$parameter['abteilung']."%' ";
        }

        if(isset($parameter['strasse']) && !empty($parameter['strasse'])) {
          $paramsArray[] = "b.strasse LIKE '%".$parameter['strasse']."%' ";
        }

        if(isset($parameter['plz']) && !empty($parameter['plz'])) {
          $paramsArray[] = "b.plz LIKE '".$parameter['plz']."%'";
        }

        if(isset($parameter['ort']) && !empty($parameter['ort'])) {
          $paramsArray[] = "b.ort LIKE '%".$parameter['ort']."%' ";
        }

        if(isset($parameter['land']) && !empty($parameter['land'])) {
          $paramsArray[] = "b.land LIKE '%".$parameter['land']."%' ";
        }

        if(isset($parameter['ustid']) && !empty($parameter['ustid'])) {
          $paramsArray[] = "b.ustid LIKE '%".$parameter['ustid']."%' ";
        }

        if(isset($parameter['telefon']) && !empty($parameter['telefon'])) {
          $paramsArray[] = "b.telefon LIKE '%".$parameter['telefon']."%' ";
        }

        if(isset($parameter['email']) && !empty($parameter['email'])) {
          $paramsArray[] = "b.email LIKE '%".$parameter['email']."%' ";
        }


        if(isset($parameter['datumVon']) && !empty($parameter['datumVon'])) {
          $paramsArray[] = "unix_timestamp(b.datum) >= " . strtotime($parameter['datumVon']);
        }

        if(isset($parameter['datumBis']) && !empty($parameter['datumBis'])) {
          $paramsArray[] = "unix_timestamp(b.datum) <= " . strtotime($parameter['datumBis']);
        }

        if(isset($parameter['betragVon']) && !empty($parameter['betragVon'])) {
          $paramsArray[] = "b.gesamtsumme >= ' ".$parameter['betragVon']."' ";
        }

        if(isset($parameter['betragBis']) && !empty($parameter['betragBis'])) {
          $paramsArray[] = "b.gesamtsumme <= ' ".$parameter['betragBis']."' ";
        }

        if(isset($parameter['projekt']) && !empty($parameter['projekt'])) {

          $projektData = $this->app->DB->SelectArr('
            SELECT
              *
            FROM
              projekt
            WHERE
              abkuerzung LIKE "' . $parameter['projekt'] . '"
          ');

          $projektData = reset($projektData);
          $paramsArray[] = "b.projekt = '".$projektData['id']."' ";
        }

        if(isset($parameter['belegnummer']) && !empty($parameter['belegnummer'])) {
          $paramsArray[] = "b.belegnr LIKE '%".$parameter['belegnummer']."%' ";
        }

        if(isset($parameter['internebemerkung']) && !empty($parameter['internebemerkung'])) {
          $paramsArray[] = "b.internebemerkung LIKE '%".$parameter['internebemerkung']."%' ";
        }

        if(isset($parameter['aktion']) && !empty($parameter['aktion'])) {
          $paramsArray[] = "b.aktion LIKE '%".$parameter['aktion']."%' ";
        }

        if(isset($parameter['freitext']) && !empty($parameter['freitext'])) {
          $paramsArray[] = "b.freitext LIKE '%".$parameter['freitext']."%' ";
        }

        if(isset($parameter['zahlungsweise']) && !empty($parameter['zahlungsweise'])) {
          $paramsArray[] = "b.zahlungsweise LIKE '%".$parameter['zahlungsweise']."%' ";
        }

        if(isset($parameter['status']) && !empty($parameter['status'])) {
          $paramsArray[] = "b.status LIKE '%".$parameter['status']."%' ";
        }

        if(isset($parameter['versandart']) && !empty($parameter['versandart'])) {
          $paramsArray[] = "b.versandart LIKE '%".$parameter['versandart']."%' ";
        }

        if(isset($parameter['lieferantennummer']) && !empty($parameter['lieferantennummer'])) {
          $paramsArray[] = "b.lieferantennummer LIKE '%".$parameter['lieferantennummer']."%' ";
        }

        if ($paramsArray) {
          $where .= ' AND ' . implode(' AND ', $paramsArray);
        }


        // gesamt anzahl
        $count = "SELECT COUNT(b.id) FROM bestellung b WHERE b.status!='angelegt'";
        $moreinfo = true;
        break;
      case "vertreter":

        // headings
        $id = $this->app->Secure->GetGET('id');
        $heading = array('', 'Kennziffer', 'Name', 'Men&uuml;');
        $width = array('1%', '5%', '90%', '5%');
        $findcols = array('open', 'g.kennziffer', 'g.name', 'g.id');
        $searchsql = array('g.kennziffer', 'g.name');

        //$defaultorder = 6;  //Optional wenn andere Reihenfolge gewuenscht
        
        //$defaultorderdesc=1;

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=versanderzeugen&action=einzel&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a></td></tr></table>";

        //&nbsp;<a href=\"#\" onclick=\"if(!confirm('Auftrag wirklich aus dem Versand nehmen?')) return false; else window.location.href='index.php?module=versanderzeugen&action=delete&id=%value%';\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a></td></tr></table>";
        $menucol = 6;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS g.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
              g.kennziffer, g.name, g.id 
              FROM  gruppen g ";
        $where = " g.art='verband' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(g.id) FROM gruppen g WHERE g.art='verband' " . $this->app->erp->ProjektRechte();
        $moreinfo = false;
        break;
      case "wareneingang_lieferant":
        $allowed['wareneingang'] = array('distriinhalt');

        // headings
        $id = $this->app->Secure->GetGET('id');
        $adresse = $this->app->DB->Select("SELECT adresse FROM paketannahme WHERE id='$id' LIMIT 1");
        $heading = array('Bestellnummer', 'Nummer', 'Bestellung', 'Beschreibung', 'Lieferdatum', 'Projekt', 'Menge', 'Geliefert', 'Offen', 'Aktion');
        $width = array('5%', '5%', '5%', '30%', '5%', '5%', '5%', '5%', '5%', '5%');
        $findcols = array('bp.bestellnummer', 'art.nummer', 'b.belegnr', 'art.name_de', 'bp.lieferdatum', 'p.abkuerzung', 'bp.menge', 'bp.geliefert', 'offen', 'bp.id');
        $searchsql = array('bp.bestellnummer', 'art.nummer', 'b.belegnr', 'art.name_de', 'bp.lieferdatum', 'p.abkuerzung', 'bp.menge', 'bp.geliefert');

        //$defaultorder = 6;  //Optional wenn andere Reihenfolge gewuenscht
        
        //$defaultorderdesc=1;

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><form style=\"padding: 0px; margin: 0px;\" action=\"\" method=\"post\" name=\"eprooform\">Menge:&nbsp;<input type=\"text\" size=\"5\" name=\"pos[%value%]\">&nbsp;<input type=\"submit\" value=\"zuordnen\" name=\"submit\"></form></td></tr></table>";

        //&nbsp;<a href=\"#\" onclick=\"if(!confirm('Auftrag wirklich aus dem Versand nehmen?')) return false; else window.location.href='index.php?module=versanderzeugen&action=delete&id=%value%';\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a></td></tr></table>";
        $menucol = 4;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS bp.id, bp.bestellnummer, art.nummer, b.belegnr as `Bestellung`, CONCAT(LEFT(art.name_de,40),'<br>Bei Lieferant: ',LEFT(bp.bezeichnunglieferant,40)) as beschreibung, if(bp.lieferdatum,DATE_FORMAT(bp.lieferdatum,'%d.%m.%Y'),'sofort') as lieferdatum, p.abkuerzung as projekt, 
              bp.menge, bp.geliefert, bp.menge -  bp.geliefert as offen, bp.id FROM bestellung_position bp
              LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN artikel art ON art.id=bp.artikel LEFT JOIN projekt p ON b.projekt=p.id ";

        $where = " b.adresse='$adresse' AND b.belegnr != '' 
              AND bp.geliefert < bp.menge AND (bp.abgeschlossen IS NULL OR bp.abgeschlossen=0)  AND (b.status='versendet' OR b.status='freigegeben') " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "
              SELECT COUNT(bp.id) FROM bestellung_position bp LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN artikel art ON art.id=bp.artikel LEFT JOIN projekt p ON bp.projekt=p.id WHERE b.adresse='$adresse' AND b.belegnr !='' AND bp.geliefert < bp.menge AND (bp.abgeschlossen IS NULL OR bp.abgeschlossen=0) AND (b.status='versendet' OR b.status='freigegeben') " . $this->app->erp->ProjektRechte();
        $moreinfo = false;
        break;
      case "verbaende":

        // headings
        $id = $this->app->Secure->GetGET('id');
        $heading = array('', 'Kennziffer', 'Name', 'ZR', 'Men&uuml;');
        $width = array('1%', '5%', '90%', '5%', '5%');
        $findcols = array('open', 'g.kennziffer', 'g.name', 'zr', 'g.id');
        $searchsql = array('g.kennziffer', 'g.name');
        $defaultorder = 5;
        $defaultorderdesc = 1;

        //$defaultorder = 1;  //Optional wenn andere Reihenfolge gewuenscht
        
        //$defaultorderdesc=1;

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=gruppen&action=edit&id=%value%\" target=\"_blank\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>&nbsp;<a href=\"#\" onclick=VerbandAbrechnen(\"index.php?module=verband&action=starten&id=%value%\")><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/forward.png\" border=\"0\"></a></td></tr></table>";

        //&nbsp;<a href=\"#\" onclick=\"if(!confirm('Auftrag wirklich aus dem Versand nehmen?')) return false; else window.location.href='index.php?module=versanderzeugen&action=delete&id=%value%';\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a></td></tr></table>";
        $menucol = 4;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS g.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
              g.kennziffer, g.name, if(g.zentralregulierung,'ZR','-') as zr, g.id 
              FROM  gruppen g ";
        $where = " g.art='verband' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(g.id) FROM gruppen g WHERE g.art='verband' " . $this->app->erp->ProjektRechte();
        $moreinfo = true;
        break;
      case "adresse_angebot":
        $allowed['adresse'] = array('belege');

        // headings
        $id = $this->app->Secure->GetGET('id');
        $heading = array('Angebot', 'Vom', 'Anfrage', 'Projekt', 'Zahlung', 'Betrag', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '40%', '50%', '5%', '1%', '1%', '1%');
        $findcols = array('belegnr', 'vom', 'name', 'projekt', 'zahlungsweise', 'betrag', 'status', 'id');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'a.anfrage', 'a.status', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})");
        $defaultorder = 8; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $sumcol = 6;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=angebot&action=edit&id=%value%\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=angebot&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 9;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,
              if(belegnr='','ENTWURF',belegnr) as belegnr, DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, 
                a.anfrage as name, 
                  LEFT(UPPER( p.abkuerzung),10) as projekt, a.zahlungsweise as zahlungsweise,  
                  FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag, a.status as status,  a.id
                    FROM  angebot a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";
        $where = " a.adresse='$id' AND  a.id!='' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM angebot a WHERE a.belegnr!=0 AND a.adresse='$id' ";
        $moreinfo = false;
        break;
      case "adresse_auftrag":
        $allowed['adresse'] = array('belege');

        // headings
        $id = $this->app->Secure->GetGET('id');
        $heading = array('Auftrag', 'Vom', 'Kommission/Bestellnummer', 'Projekt', 'Zahlung', 'Betrag', 'Status', 'Monitor', 'Men&uuml;');
        $width = array('1%', '10%', '40%', '50%', '5%', '1%', '1%', '1%', '1%');
        $findcols = array('belegnr', 'vom', 'name', 'projekt', 'zahlungsweise', 'betrag', 'status', 'status', 'id');
        $searchsql = array('a.datum', 'a.belegnr', 'a.ihrebestellnummer', 'internet', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', 'a.gesamtsumme');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'a.ihrebestellnummer', 'internet', 'a.status', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})");
        $defaultorder = 9; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $sumcol = 6;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=auftrag&action=edit&id=%value%\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=auftrag&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 9;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,
              if(belegnr='','ENTWURF',belegnr) as belegnr, DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, 
                a.ihrebestellnummer as name, 
                  LEFT(UPPER( p.abkuerzung),10) as projekt, a.zahlungsweise as zahlungsweise,  
                  FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag, a.status as status, (" . $this->IconsSQL() . ")  as icons, a.id
                    FROM  auftrag a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";
        $where = " a.adresse='$id' AND  a.id!='' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM auftrag a WHERE a.belegnr!=0 AND a.lager_ok='1' AND a.vorkasse_ok='1' AND a.check_ok='1' AND a.inbearbeitung=0 AND a.nachlieferung!='1' AND a.ust_ok='1' AND a.adresse='$id' ";
        $moreinfo = false;
        break;
      case "adresse_rechnung":
        $allowed['adresse'] = array('belege');

        // headings
        $id = $this->app->Secure->GetGET('id');
        $heading = array('Rechnung', 'Vom', 'Kommission/Internetnummer', 'Projekt', 'Zahlung', 'Betrag', 'Zahlungsstatus', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '40%', '5%', '5%', '1%', '1%', '1%', '1%');
        $findcols = array('r.belegnr', 'r.datum', 'a.ihrebestellnummer', 'r.projekt', 'r.zahlungsweise', 'r.soll', 'r.zahlungsstatus', 'r.status', 'r.id');
        $searchsql = array('DATE_FORMAT(r.datum,\'%d.%m.%Y\')', 'r.belegnr', 'a.ihrebestellnummer', 'r.status', 'r.name', 'r.land', 'p.abkuerzung', 'r.zahlungsweise', 'r.status', "FORMAT(r.ist,2{$extended_mysql55})", "FORMAT(r.soll,2{$extended_mysql55})", 'r.zahlungsstatus', "if(r.zahlungsstatus='offen',
              if(DATEDIFF(NOW(),DATE_ADD(r.datum, INTERVAL r.zahlungszieltage day)) > 0,
                  CONCAT('<font color=red>',upper(substring(r.mahnwesen,1,1)),lower(substring(r.mahnwesen,2)),'</font>'),
                  'offen')

                ,if(r.zahlungsstatus='','offen',r.zahlungsstatus))");
        $defaultorder = 9;
        $defaultorderdesc = 1;
        $sumcol = 6;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 1;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id,
              if(r.belegnr='','ENTWURF',r.belegnr) as belegnr, 

                CONCAT(DATE_FORMAT(r.datum,'%Y-%m-%d'),' ',if(r.zahlungsstatus='offen',
                      if(DATE_ADD(r.datum, INTERVAL r.zahlungszieltage day) >= NOW(),CONCAT('<br><font color=blue>f&auml;llig in ',DATEDIFF(DATE_ADD(r.datum, INTERVAL r.zahlungszieltage day),NOW()),' Tagen</font>'),CONCAT('<br><font color=red>f&auml;llig seit ',DATEDIFF(NOW(),DATE_ADD(r.datum, INTERVAL r.zahlungszieltage day)),' Tagen</font>'))
                      ,'')) as vom, 

                  a.ihrebestellnummer, 
                  LEFT(UPPER( p.abkuerzung),10) as projekt, r.zahlungsweise as zahlungsweise,  
                  FORMAT(r.soll,2{$extended_mysql55}) as betrag, if(r.zahlungsstatus='offen',
                      if(DATEDIFF(NOW(),DATE_ADD(r.datum, INTERVAL r.zahlungszieltage day)) > 0,
                        CONCAT('<font color=red>',upper(substring(r.mahnwesen,1,1)),lower(substring(r.mahnwesen,2)),'</font>'),
                        'offen')

                      ,if(r.zahlungsstatus='','offen',r.zahlungsstatus)) as zahlungsstatus, r.status, r.id
                    FROM  rechnung r LEFT JOIN auftrag a ON r.auftragid=a.id LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";
        $where = " r.adresse='$id' AND  r.id!='' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(r.id) FROM rechnung r WHERE r.adresse='$id' ";
        $moreinfo = false;
        break;
      case "adresse_gutschrift":
        $allowed['adresse'] = array('belege');

        // headings
        $id = $this->app->Secure->GetGET('id');
        $heading = array('Gutschrift', 'Vom', 'Projekt', 'Zahlung', 'Betrag', 'Zahlungsstatus', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '5%', '5%', '1%', '1%', '1%', '1%');
        $findcols = array('g.belegnr', 'g.datum', 'g.projekt', 'g.zahlungsweise', 'g.soll', 'g.zahlungsstatus', 'g.status', 'g.id');
        $searchsql = array("DATE_FORMAT(g.datum,'%d.%m.%Y')", 'g.belegnr', 'g.status', 'g.name', 'g.land', 'p.abkuerzung', 'g.zahlungsweise', 'g.status', "FORMAT(g.ist,2{$extended_mysql55})", "FORMAT(g.soll,2{$extended_mysql55})");
        $defaultorder = 8;
        $defaultorderdesc = 1;
        $defaultsum = 5;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 1;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS g.id,
              if(g.belegnr='','ENTWURF',g.belegnr) as belegnr, DATE_FORMAT(g.datum,'%Y-%m-%d') as vom, 
                LEFT(UPPER( p.abkuerzung),10) as projekt, g.zahlungsweise as zahlungsweise,  
                  FORMAT(g.soll,2{$extended_mysql55}) as betrag, g.zahlungsstatus as zahlungsstatus, g.status, g.id
                    FROM  gutschrift g LEFT JOIN projekt p ON p.id=g.projekt LEFT JOIN adresse adr ON g.adresse=adr.id  ";
        $where = " g.adresse='$id' AND  g.id!='' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(g.id) FROM gutschrift g WHERE g.adresse='$id' ";
        $moreinfo = false;
        break;
      case "adresse_lieferschein":
        $allowed['adresse'] = array('belege');

        // headings
        $id = $this->app->Secure->GetGET('id');
        $heading = array('Lieferschein', 'Auftrag', 'Kommission/Bestellnummer', 'Vom', 'Projekt', 'Versandart', 'Tracking', 'Status', 'Men&uuml;');
        $width = array('5%', '5%', '30%', '10%', '5%', '10%', '1%', '1%');
        $findcols = array('l.belegnr', 'a.belegnr', 'a.ihrebestellnummer', 'l.datum', 'l.projekt', 'l.versandart', 'v.tracking', 'l.status', 'l.id');
        $searchsql = array("DATE_FORMAT(l.datum,'%d.%m.%Y')", 'a.belegnr', 'a.ihrebestellnummer', 'l.belegnr', 'a.ihrebestellnummer', 'l.status', 'v.tracking', 'l.name', 'l.land', 'p.abkuerzung', 'l.versandart', 'l.status');
        $defaultorder = 9;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=lieferschein&action=edit&id=%value%\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=lieferschein&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 1;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id,
              if(l.belegnr='','ENTWURF',l.belegnr) as belegnr, a.belegnr, a.ihrebestellnummer, DATE_FORMAT(l.datum,'%Y-%m-%d') as vom, 
                LEFT(UPPER( p.abkuerzung),10) as projekt, l.versandart, if(v.tracking,v.tracking,'-'), l.status, l.id
                  FROM  lieferschein l LEFT JOIN projekt p ON p.id=l.projekt LEFT JOIN adresse adr ON l.adresse=adr.id 
                  LEFT JOIN auftrag a ON l.auftragid=a.id LEFT JOIN versand v ON v.lieferschein=l.id ";
        $where = " l.adresse='$id' AND  l.id!='' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(l.id) FROM lieferschein l WHERE l.adresse='$id' ";
        $moreinfo = false;
        break;
      case "angeboteinbearbeitung":
        $allowed['angebot'] = array('create', 'list');

        // headings
        $heading = array('', 'Angebot', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Status', 'Men&uuml;');
        $width = array('1%', '1%', '10%', '10%', '40%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'name', 'land', 'projekt', 'zahlungsweise', 'betrag', 'status', 'id');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})", 'a.status', 'adr.freifeld1','a.anfrage');
        $defaultorder = 11;
        $defaultorderdesc = 1;
        $sumcol = 9;
        $alignright = array('9');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=angebot&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=angebot&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=angebot&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 'ENTWURF' as belegnr, DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, 
              adr.kundennummer as kundennummer, " . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . " as name, a.land as land, p.abkuerzung as projekt, a.zahlungsweise as zahlungsweise,  
              FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag, UPPER(a.status) as status, a.id
                FROM  angebot a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";
        $where = " ( a.status='angelegt') " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM angebot a WHERE ( a.status='angelegt') ";
        $moreinfo = true;
        break;
      case "angeboteoffene":
        $allowed['angebot'] = array('list');

        // headings
        $heading = array('', 'Angebot', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Status', 'Men&uuml;');
        $width = array('1%', '1%', '10%', '10%', '40%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'name', 'land', 'projekt', 'zahlungsweise', 'betrag', 'status', 'id');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})", 'a.status', 'adr.freifeld1','a.anfrage');
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $alignright = array('9');
        $sumcol = 9;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=angebot&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=angebot&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=angebot&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, a.belegnr as belegnr, DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, 
              adr.kundennummer as kundennummer, " . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . " as name, a.land as land, p.abkuerzung as projekt, a.zahlungsweise as zahlungsweise,  
              FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag, UPPER(a.status) as status, a.id
                FROM  angebot a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";
        $where = " a.id!='' AND a.status='freigegeben' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM angebot a WHERE a.status='freigegeben'";
        $moreinfo = true;
        break;
      case "aufgaben_archiv":
        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#aufgabenoffeneigenearchiv').click( function() { fnFilterColumn11( 0 ); } );");
        for ($r = 11;$r < 12;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('Aufgabe', 'Mitarbeiter', 'Projekt', 'Prio', 'Abgabe-Termin', 'Startseite', 'Status', 'Men&uuml;');
        $width = array('35%', '20%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('aufgabe', 'mitarbeiter', 'projekt', 'prio', 'abgabe', 'status', 'id');
        $searchsql = array('a.aufgabe', 'p.abkuerzung', 'adr.name', 'a.status', 'a.abgabe_bis', 'a.id');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=aufgaben&action=edit&id=%value%#tabs-3\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=FinalDialog(\"index.php?module=aufgaben&action=abschluss&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/versand.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=aufgaben&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "</td></tr></table>";

        //            $menucol=9;
        
        // SQL statement

        $sql = "SELECT a.id, 
              if(a.prio,CONCAT('<b><font color=red>',a.aufgabe,'</font></b>'),a.aufgabe) as aufgabe,
                adr.name as mitarbeiter,
                  p.abkuerzung as projekt,
                  if(a.prio,'<b><font color=red>Prio</font></b>','Normal') as prio, 
                    if(a.abgabe_bis,DATE_FORMAT(abgabe_bis,'%d.%m.%Y'),'') as abgabe,
                      if(a.startseite,'Ja','Nein') as startseite,if((angelegt_am AND a.status='offen'), CONCAT(a.status,' (',DATE_FORMAT(angelegt_am,'%d.%m.%Y'),')'),a.status) as status, a.id
                          FROM  aufgabe a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";

        // Fester filter
        
        // START EXTRA more

          $subwhere[] = " a.status='abgeschlossen' ";
          $count = "SELECT COUNT(a.id) FROM aufgabe a WHERE  (a.adresse='" . $this->app->User->GetAdresse() . "' OR a.initiator='" . $this->app->User->GetAdresse() . "') AND a.startdatum='0000-00-00' AND a.status='abgeschlossen'";
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " a.adresse='" . $this->app->User->GetAdresse() . "' ";

        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " (a.adresse='" . $this->app->User->GetAdresse() . "' OR a.initiator='" . $this->app->User->GetAdresse() . "' OR a.oeffentlich='1') AND a.startdatum='0000-00-00' AND a.id!='' $tmp";


        break;
 
      case "abrechnungzeit":
        $allowed['adresse'] = array('abrechnungzeit');
        $id = $this->app->Secure->GetGET('id');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#archiviert').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#abrechnung').click( function() { fnFilterColumn2( 0 ); } );");
        for ($r = 1;$r < 3;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('', 'Auswahl', 'Aufgabe', 'Mitarbeiter', 'Von', 'Bis', 'Stunden', 'Status', 'Men&uuml;');
        $width = array('1%', '1%', '25%', '15%', '15%', '25%', '1%', '1%', '1%');
        $findcols = array('open', 'auswahl', 'aufgabe', 'name', 'von', 'bis', 'status', 'id');
        $searchsql = array('aufgabe', 'name', 'von', 'bis', 'a.id');
        $defaultorder = 5;
        $defaultorderdesc = 1;
        $id = $this->app->Secure->GetGET("id");
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=zeiterfassung&action=create&id=%value%&back=adresse&back_id=$id#tabs-3\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=FinalDialog(\"index.php?module=adresse&action=abrechnungzeitabgeschlossen&id=$id&sid=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/versand.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=abrechnungzeitdelete&id=$id&sid=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "</td></tr></table>";

        //            $menucol=9;
        
        // SQL statement

        $sql = "SELECT SQL_CALC_FOUND_ROWS z.id, 
              '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,
              CONCAT('<input type=\"checkbox\" name=\"zeit[]\" value=\"',z.id,'\" ',if(z.abrechnen,if(z.abgerechnet!=1 AND z.abrechnen='1','checked',''),''),'>',if(z.abrechnen,'(A)','')) as auswahl,
              z.aufgabe as aufgabe, a.name as name, z.von as von, z.bis as bis, 
              CONCAT(LPAD(HOUR(TIMEDIFF(bis, von)),2,'0'),':',LPAD(MINUTE(TIMEDIFF(bis, von)),2,'0')) AS dauer


                ,if(z.abrechnen,if(z.abgerechnet!=1 AND z.abrechnen='1','offen','abgerechnet'),'abgeschlossen') as staus,z.id  as id
                FROM zeiterfassung z LEFT JOIN adresse a ON a.id=z.adresse ";

        // Fester filter
        
        // START EXTRA more

        
        //        $more_data1 = $this->app->Secure->GetGET("more_data1"); if($more_data1==1) $subwhere[] = " z.abrechnen='1' ";

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) {
          $subwhere[] = " (z.abgerechnet='1' OR z.abrechnen!='1') ";
        } else $subwhere[] = " z.abgerechnet!=1 ";

        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " z.adresse_abrechnung='" . $id . "' $tmp";
        $count = "SELECT COUNT(z.id) FROM zeiterfassung z WHERE  z.adresse_abrechnung='" . $id . "' $tmp";

        // gesamt anzahl
        $menucol = 8;
        $moreinfo = true;
        break;

    case "aufgaben":
       // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#aufgabenprio').click( function() { fnFilterColumn6( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#aufgabenoffeneigene').click( function() { fnFilterColumn7( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#aufgabenintervall').click( function() { fnFilterColumn8( 0 ); } );");
        for ($r = 6;$r < 9;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('Aufgabe','Kunde','Dauer (h)','Mitarbeiter', 'Projekt', 'Prio', 'Abgabe', 'Men&uuml;');
        $width = array('200px', '20%','1%', '20%', '1%', '1%', '1%');
        $findcols = array('aufgabe','kunde','stunden', 'mitarbeiter', 'projekt', 'prio', 'abgabe', 'id');
        $searchsql = array('a.aufgabe', 'kdr.name', 'a.stunden','p.abkuerzung', 'adr.name', 'a.abgabe_bis', 'a.id');

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=aufgaben&action=edit&id=%value%&back=alle#tabs-3\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=FinalDialog(\"index.php?module=aufgaben&action=abschluss&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/versand.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=aufgaben&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "</td></tr></table>";
        //            $menucol=9;
        
        // SQL statement
        $alignright=array(3);
        $sumcol = 3;

	$defaultorder = 8;

        $sql = "SELECT a.id, 
              
CONCAT(if(a.prio=1 OR (a.abgabe_bis <= NOW() AND a.abgabe_bis!='0000-00-00'),CONCAT('<b><font color=',if(DATE_FORMAT(a.abgabe_bis,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d'),'blue','red'),'>',a.aufgabe,'</font></b>',if(a.abgabe_bis <= NOW() AND a.abgabe_bis!='0000-00-00',if(DATE_FORMAT(a.abgabe_bis,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d'),' <b>Abgabe Heute!</b>',' <b>Abgabe &uuml;berf&auml;llig!!</b>'),'')),a.aufgabe),if(a.intervall_tage>0,' (',''),if(a.intervall_tage=2,'w&ouml;chentlich',if(a.intervall_tage=3,'monatlich',if(a.intervall_tage=4,'j&auml;hrlich',if(a.intervall_tage=1,'t&auml;glich','')))),if(a.intervall_tage>0,')','')) as aufgabe,

              kdr.name as kunde,
                if(a.stunden > 0,a.stunden,'') as stunden, 
                adr.name as mitarbeiter,
                  p.abkuerzung as projekt,
                  if(a.prio=1,'<b><font color=red>Prio</font></b>',if(a.prio=-1,'Keine&nbsp;Prio','Normal')) as prio, 
                  if(a.abgabe_bis,DATE_FORMAT(abgabe_bis,'%d.%m.%Y'),'') as abgabe,
                    a.id
                          FROM  aufgabe a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  LEFT JOIN adresse kdr ON a.adresse=kdr.id";

        // Fester filter
        
        // START EXTRA more

          $count = "SELECT COUNT(a.id) FROM aufgabe a WHERE  (a.adresse='" . $this->app->User->GetAdresse() . "' OR a.initiator='" . $this->app->User->GetAdresse() . "')";

        $more_data6 = $this->app->Secure->GetGET("more_data6");
        if ($more_data6 == 1) $subwhere[] = " a.prio=1 ";

        $more_data7 = $this->app->Secure->GetGET("more_data7");
        if ($more_data7 == 1) $subwhere[] = " (a.abgabe_bis <= NOW() AND a.abgabe_bis!='0000-00-00') ";


        $more_data8 = $this->app->Secure->GetGET("more_data8");
        if ($more_data8 == 1) { $subwhere[] = " a.intervall_tage > 0 "; }
        else {
          $where_wdh = "(a.intervall_tage > 0 AND a.abgabe_bis <=NOW() AND a.status!='abgeschlossen' {TMP} AND (a.adresse='" . $adresse . "' OR a.initiator='" . $this->app->User->GetAdresse() . "')) OR ";
          $where_wdh_else ="a.intervall_tage = 0 AND";
        }

        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];

        $where_wdh = str_replace('{TMP}',$tmp,$where_wdh);

        $where = " $where_wdh ($where_wdh_else (a.adresse='" . $adresse . "' OR a.initiator='" . $this->app->User->GetAdresse() . "') AND a.status!='abgeschlossen' $tmp)";

        $count = "SELECT COUNT(a.id) FROM aufgabe a WHERE $where_wdh ((a.adresse='" . $adresse . "' OR a.initiator='" . $this->app->User->GetAdresse() . "') AND a.status!='abgeschlossen')";

      break;


      case "aufgaben_meine":
       // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#aufgabenmeineprio').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#aufgabenmeineueberfaellige').click( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#aufgabenmeineintervall').click( function() { fnFilterColumn3( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#aufgabenabgeschlossene').click( function() { fnFilterColumn4( 0 ); } );");
        for ($r = 1;$r < 5;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                  function fnFilterColumn' . $r . ' ( i )
                  {
                  if(oMoreData' . $r . $name . '==1)
                  oMoreData' . $r . $name . ' = 0;
                  else
                  oMoreData' . $r . $name . ' = 1;

                  $(\'#' . $name . '\').dataTable().fnFilter( 
                    \'A\',
                    i, 
                    0,0
                    );
                  }
                  ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('Aufgabe','Mitarbeiter','Kunde','Dauer','Projekt', 'Prio', 'Abgabe', 'Status', 'Men&uuml;');
        $width = array('25%','25%','25%','1%', '1%', '1%', '1%');
        $findcols = array('aufgabe','mitarbeiter','kunde','stunden', 'projekt', 'prio', 'abgabe', 'status', 'id');
        $searchsql = array('a.aufgabe', "CONCAT(kdr.kundennummer,' ',kdr.name)","adr.name",'a.stunden','p.abkuerzung', 'a.status', 'a.abgabe_bis', 'a.id');

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=aufgaben&action=edit&id=%value%#tabs-3\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=FinalDialog(\"index.php?module=aufgaben&action=abschluss&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/versand.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=aufgaben&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "</td></tr></table>";
        //            $menucol=9;
        
        // SQL statement
        $alignright=array(4);
        $sumcol = 4;

	$defaultorder = 9;
 
        // START EXTRA more
        $sid = $this->app->User->GetParameter("aufgabe_benutzer_simulieren");
        if($sid !="" && $this->app->User->GetType()=="admin")
        {
          $adresse = $sid;
        }
        else
        {
          $adresse = $this->app->User->GetAdresse();
        }

        $sql = "SELECT a.id, 
CONCAT(if(a.prio=1 OR (a.abgabe_bis <= NOW() AND a.abgabe_bis!='0000-00-00'),CONCAT('<b><font color=',if(DATE_FORMAT(a.abgabe_bis,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d'),'blue','red'),'>',a.aufgabe,'</font></b>',if(a.abgabe_bis <= NOW() AND a.abgabe_bis!='0000-00-00',if(DATE_FORMAT(a.abgabe_bis,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d'),' <b>Abgabe Heute!</b>',' <b>Abgabe &uuml;berf&auml;llig!!</b>'),'')),a.aufgabe),if(a.intervall_tage>0,' (',''),if(a.intervall_tage=2,'w&ouml;chentlich',if(a.intervall_tage=3,'monatlich',if(a.intervall_tage=4,'j&auml;hrlich',if(a.intervall_tage=1,'t&auml;glich','')))),if(a.intervall_tage>0,')','')) as aufgabe,

                    if(adr.id='".$adresse."' OR adr.id IS NULL,(if(a.initiator!='$adresse' AND a.initiator!=a.adresse,CONCAT('Initiator: ',initi.name),'-')),adr.name) as mitarbeiter,
                  CONCAT(kdr.kundennummer,' ',kdr.name) as kunde, 
                if(a.stunden > 0,a.stunden,'') as stunden, 
                  p.abkuerzung as projekt,
                  if(a.prio=1,'<b><font color=red>Prio</font></b>',if(a.prio=-1,'Keine&nbsp;Prio','Normal')) as prio, 
                  if(a.abgabe_bis,DATE_FORMAT(abgabe_bis,'%d.%m.%Y'),'') as abgabe,
                        a.status as status, a.id
                          FROM  aufgabe a LEFT JOIN projekt p ON p.id=a.projekt 
                      LEFT JOIN adresse adr ON a.adresse=adr.id  
                      LEFT JOIN adresse initi ON a.initiator=initi.id  
                      LEFT JOIN adresse kdr ON a.kunde=kdr.id  
        ";

        // Fester filter
       
        
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        if ($more_data1 == 1) $subwhere[] = " a.prio=1 ";

        $more_data2 = $this->app->Secure->GetGET("more_data2");
        if ($more_data2 == 1) $subwhere[] = " (a.abgabe_bis <= NOW() AND a.abgabe_bis!='0000-00-00') ";

        $more_data3 = $this->app->Secure->GetGET("more_data3");
        if ($more_data3 == 1) { $subwhere[] = " a.intervall_tage > 0 "; }
        else {
          $where_wdh = "(a.intervall_tage > 0 AND a.abgabe_bis <=NOW() AND a.status!='abgeschlossen' {TMP} AND a.adresse='$adresse') OR ";
          $where_wdh_else ="a.intervall_tage = 0 AND";
        }
     
        $more_data4 = $this->app->Secure->GetGET("more_data4");
        if ($more_data4 == 1) $subwhere[] = " a.status='abgeschlossen' ";
        else $subwhere[] = " a.status!='abgeschlossen' ";



        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];

        $where_wdh = str_replace('{TMP}',$tmp,$where_wdh);

        $where = " $where_wdh ($where_wdh_else (a.adresse='" . $adresse . "' OR a.initiator='" . $adresse . "') $tmp)";

        $count = "SELECT COUNT(a.id) FROM aufgabe a WHERE $where_wdh ($where_wdh_else (a.adresse='" . $adresse . "' OR a.initiator='" . $adresse . "') $tmp)";

        break;

      case "angebote":
        $allowed['angebot'] = array('list');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#angeboteoffen').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#angeboteheute').click( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#angeboteohneab').click( function() { fnFilterColumn3( 0 ); } );");
        for ($r = 1;$r < 4;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                function fnFilterColumn' . $r . ' ( i )
                                {
                                if(oMoreData' . $r . $name . '==1)
                                oMoreData' . $r . $name . ' = 0;
                                else
                                oMoreData' . $r . $name . ' = 1;

                                $(\'#' . $name . '\').dataTable().fnFilter( 
                                  \'A\',
                                  i, 
                                  0,0
                                  );
                                }
                                ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('', 'Angebot', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Status', 'Men&uuml;');
        $width = array('1%', '1%', '10%', '10%', '40%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'name', 'land', 'projekt', 'zahlungsweise', 'betrag', 'status', 'id');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.anfrage','a.belegnr', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})", 'a.status', 'adr.freifeld1');
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $sumcol = 9;
        $alignright = array('9');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=angebot&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=angebot&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=angebot&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=angebot&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        $parameter = $this->app->User->GetParameter('table_filter_angebot');
        $parameter = base64_decode($parameter);
        $parameter = json_decode($parameter, true);

        $sql = "";

        $sql .= "
          SELECT SQL_CALC_FOUND_ROWS a.id,
          '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
          a.belegnr as belegnr, 
          DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, 
          adr.kundennummer as kundennummer, 
          " . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . " as name, 
          a.land as land, 
          p.abkuerzung as projekt, 
          a.zahlungsweise as zahlungsweise,  
          FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag, 
          UPPER(a.status) as status, 
          a.id
        ";

        $sql .= "
          FROM 
            angebot a 
            LEFT JOIN projekt p ON p.id=a.projekt 
            LEFT JOIN adresse adr ON a.adresse=adr.id 
        ";

        // SQL statement
        /*
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, a.belegnr as belegnr, DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, 
                            adr.kundennummer as kundennummer, " . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . " as name, a.land as land, p.abkuerzung as projekt, a.zahlungsweise as zahlungsweise,  
                            FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag, UPPER(a.status) as status, a.id
                              FROM  angebot a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id ";
        */
        // Fester filter
        
        // START EXTRA more

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " a.status='freigegeben' ";
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        
        if ($more_data2 == 1) $subwhere[] = " a.datum=CURDATE() AND a.status='freigegeben'";
        $more_data3 = $this->app->Secure->GetGET("more_data3");
        
        if ($more_data3 == 1) $subwhere[] = " a.auftragid <= 0 ";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " a.id!='' AND a.status!='angelegt' $tmp " . $this->app->erp->ProjektRechte();


        /* STAMMDATEN */
        if(isset($parameter['kundennummer']) && !empty($parameter['kundennummer'])) {
          $paramsArray[] = "a.kundennummer LIKE '%".$parameter['kundennummer']."%' ";
        }

        if(isset($parameter['name']) && !empty($parameter['name'])) {
          $paramsArray[] = "a.name LIKE '%".$parameter['name']."%' ";
        }

        if(isset($parameter['ansprechpartner']) && !empty($parameter['ansprechpartner'])) {
          $paramsArray[] = "a.ansprechpartner LIKE '%".$parameter['ansprechpartner']."%' ";
        }

        if(isset($parameter['abteilung']) && !empty($parameter['abteilung'])) {
          $paramsArray[] = "a.abteilung LIKE '%".$parameter['abteilung']."%' ";
        }

        if(isset($parameter['strasse']) && !empty($parameter['strasse'])) {
          $paramsArray[] = "a.strasse LIKE '%".$parameter['strasse']."%' ";
        }

        if(isset($parameter['plz']) && !empty($parameter['plz'])) {
          $paramsArray[] = "a.plz LIKE '".$parameter['plz']."%'";
        }

        if(isset($parameter['ort']) && !empty($parameter['ort'])) {
          $paramsArray[] = "a.ort LIKE '%".$parameter['ort']."%' ";
        }

        if(isset($parameter['land']) && !empty($parameter['land'])) {
          $paramsArray[] = "a.land LIKE '%".$parameter['land']."' ";
        }

        if(isset($parameter['ustid']) && !empty($parameter['ustid'])) {
          $paramsArray[] = "a.ustid LIKE '%".$parameter['ustid']."%' ";
        }

        if(isset($parameter['telefon']) && !empty($parameter['telefon'])) {
          $paramsArray[] = "a.telefon LIKE '%".$parameter['telefon']."%' ";
        }

        if(isset($parameter['email']) && !empty($parameter['email'])) {
          $paramsArray[] = "a.email LIKE '%".$parameter['email']."%' ";
        }

        /* XXX */
        if(isset($parameter['datumVon']) && !empty($parameter['datumVon'])) {
          $paramsArray[] = "unix_timestamp(a.datum) >= " . strtotime($parameter['datumVon']);
        }

        if(isset($parameter['datumBis']) && !empty($parameter['datumBis'])) {
          $paramsArray[] = "unix_timestamp(a.datum) <= " . strtotime($parameter['datumBis']);
        }

        if(isset($parameter['projekt']) && !empty($parameter['projekt'])) {

          $projektData = $this->app->DB->SelectArr('
            SELECT
              *
            FROM
              projekt
            WHERE
              abkuerzung LIKE "' . $parameter['projekt'] . '"
          ');
          $projektData = reset($projektData);
          $paramsArray[] = "a.projekt = '".$projektData['id']."' ";
        }

        if(isset($parameter['belegnummer']) && !empty($parameter['belegnummer'])) {
          $paramsArray[] = "a.belegnr LIKE '".$parameter['belegnummer']."' ";
        }

        if(isset($parameter['internebemerkung']) && !empty($parameter['internebemerkung'])) {
          $paramsArray[] = "a.internebemerkung LIKE '%".$parameter['internebemerkung']."%' ";
        }

        if(isset($parameter['aktion']) && !empty($parameter['aktion'])) {
          $paramsArray[] = "a.aktion LIKE '%".$parameter['aktion']."%' ";
        }

        if(isset($parameter['freitext']) && !empty($parameter['freitext'])) {
          $paramsArray[] = "a.freitext LIKE '%".$parameter['freitext']."%' ";
        }

        if(isset($parameter['zahlungsweise']) && !empty($parameter['zahlungsweise'])) {
          $paramsArray[] = "a.zahlungsweise LIKE '%".$parameter['zahlungsweise']."%' ";
        }

        if(isset($parameter['status']) && !empty($parameter['status'])) {
          $paramsArray[] = "a.status LIKE '%".$parameter['status']."%' ";
        }

        if(isset($parameter['versandart']) && !empty($parameter['versandart'])) {
          $paramsArray[] = "a.versandart LIKE '%".$parameter['versandart']."%' ";
        }

        if(isset($parameter['betragVon']) && !empty($parameter['betragVon'])) {
          $paramsArray[] = "a.gesamtsumme >= '" . $parameter['betragVon'] . "' ";
        }

        if(isset($parameter['betragBis']) && !empty($parameter['betragBis'])) {
          $paramsArray[] = "a.gesamtsumme <= '" . $parameter['betragBis'] . "' ";
        }
        // projekt, belegnummer, internetnummer, bestellnummer, transaktionsId, freitext, internebemerkung, aktionscodes

        if ($paramsArray) {
          $where .= ' AND ' . implode(' AND ', $paramsArray);
        }


        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM angebot a WHERE a.status!='angelegt'";
        $moreinfo = true;
        break;
      case "lagerletztebewegungen":
        $allowed['lager'] = array('letztebewegungen');

        // headings
        
        // headings

        $heading = array('Datum', 'Lager', 'Menge', 'Nummer', 'Artikel', 'Richtung', 'Referenz', 'Bearbeiter', 'Projekt', 'Men&uuml;');
        $width = array('1%', '5%', '5%', '5%', '5%', '5%', '40%', '20%', '5%', '1%');
        $findcols = array('zeit', 'lager', 'menge', 'nummer', 'name_de', 'Richtung', 'referenz', 'bearbeiter', 'projekt', 'id');
        $searchsql = array('lpi.referenz', 'lpi.bearbeiter', 'p.abkuerzung', 'DATE_FORMAT(lpi.zeit,\'%d.%m.%Y\')', 'lp.kurzbezeichnung', 'a.name_de', 'a.nummer');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "-";

        //$menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap></td></tr></table>";
        
        //<a href=\"#\"onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=dateien&action=delete&id=%value%';\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\" ></a>

        
        //            $menucol=3;

        
        /*

                                      SELECT DATE_FORMAT(lpi.zeit,'%d.%m.%Y') as datum, lp.kurzbezeichnung as lager, lpi.menge as menge, lpi.vpe as VPE, if(lpi.eingang,'Eingang','Ausgang') as Richtung, substring(lpi.referenz,1,60) as referenz, lpi.bearbeiter as bearbeiter, p.abkuerzung as projekt, 
                                      lpi.id FROM lager_bewegung lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id  WHERE lpi.artikel='$id' order by lpi.zeit DESC*/

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS lpi.id,
                DATE_FORMAT(lpi.zeit,'%d.%m.%Y') as datum, lp.kurzbezeichnung as lager, lpi.menge as menge, 
                a.nummer, a.name_de, if(lpi.eingang,'Eingang','Ausgang') as Richtung, substring(lpi.referenz,1,60) as referenz, lpi.bearbeiter as bearbeiter, p.abkuerzung as projekt, 
                lpi.id FROM lager_bewegung lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id LEFT JOIN artikel a ON a.id=lpi.artikel";

        // Fester filter
        
        //$where = " ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(lpi.id) FROM lager_bewegung lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id ";
        break;
      case "lagerbewegungartikel":
        $allowed['artikel'] = array('lager');

        // headings
        
        // headings

        $heading = array('Datum', 'Lager', 'Menge', 'VPE', 'Richtung', 'Referenz', 'Bearbeiter', 'Projekt', 'Inventur','Men&uuml;');
        $width = array('1%', '5%', '5%', '5%', '5%', '40%', '20%', '5%','10%', '1%');
        $findcols = array("CONCAT(lpi.zeit,lpi.id)", 'lager', 'menge', 'vpe', 'Richtung', 'referenz', 'bearbeiter', 'projekt', 'zeitstempel','id');
        $searchsql = array('lpi.referenz', 'lpi.bearbeiter', 'p.abkuerzung', 'DATE_FORMAT(lpi.zeit,\'%d.%m.%Y\')', 'lp.kurzbezeichnung');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "-";

        //$menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap></td></tr></table>";
        
        //<a href=\"#\"onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=dateien&action=delete&id=%value%';\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\" ></a>

        
        //            $menucol=3;
        /*

                                      SELECT DATE_FORMAT(lpi.zeit,'%d.%m.%Y') as datum, lp.kurzbezeichnung as lager, lpi.menge as menge, lpi.vpe as VPE, if(lpi.eingang,'Eingang','Ausgang') as Richtung, substring(lpi.referenz,1,60) as referenz, lpi.bearbeiter as bearbeiter, p.abkuerzung as projekt, 
                                      lpi.id FROM lager_bewegung lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id  WHERE lpi.artikel='$id' order by lpi.zeit DESC*/

        // SQL statement

        if($this->app->erp->GetKonfiguration("artikel_lager_bestandsanzeige")=="1")
        {
          $sql = "SELECT SQL_CALC_FOUND_ROWS lpi.id,
                 DATE_FORMAT(lpi.zeit,'%d.%m.%Y') as datum, lp.kurzbezeichnung as lager, lpi.menge as menge, lpi.vpe as VPE, if(lpi.eingang,'Eingang','Ausgang') as Richtung, CONCAT(substring(lpi.referenz,1,60),if(lpi.bestand >= 0 AND DATE_FORMAT(lpi.zeit,'%Y-%m-%d') >='2015-06-07' ,CONCAT(' (Neuer Bestand: ',lpi.bestand,')'),'')) as referenz, lpi.bearbeiter as bearbeiter, p.abkuerzung as projekt, DATE_FORMAT(api.zeitstempel,'%Y-%m-%d'),
                 lpi.id FROM lager_bewegung lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id LEFT JOIN artikel_permanenteinventur api ON api.id=lpi.permanenteinventur";
        } else {
          $sql = "SELECT SQL_CALC_FOUND_ROWS lpi.id,
                  DATE_FORMAT(lpi.zeit,'%d.%m.%Y') as datum, lp.kurzbezeichnung as lager, lpi.menge as menge, lpi.vpe as VPE, if(lpi.eingang,'Eingang','Ausgang') as Richtung, substring(lpi.referenz,1,60) as referenz, lpi.bearbeiter as bearbeiter, p.abkuerzung as projekt, DATE_FORMAT(api.zeitstempel,'%Y-%m-%d'),
                  lpi.id FROM lager_bewegung lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id  LEFT JOIN artikel_permanenteinventur api ON api.id=lpi.permanenteinventur";

        }
        // Fester filter
        $where = " lpi.artikel='$id'  ";

        // gesamt anzahl
        $count = "SELECT COUNT(lpi.id) FROM lager_bewegung lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id  WHERE lpi.artikel='$id'";
        break;
      case "mlmwartekonto":
        $allowed['adresse'] = array('multilevel');

        // headings
        
        // headings

        $heading = array('Bezeichnung', 'Betrag', 'Men&uuml;');
        $width = array('700px', '10%', '3%');
        $findcols = array('bezeichnung', 'betrag', 'id');
        $searchsql = array('bezeichnung', 'betrag', 'id');
        $id = $this->app->Secure->GetGET("id");
        $menu = "<a href=\"index.php?module=adresse&action=multilevel&cmd=edit&id=$id&sid=%value%#tabs-2\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\"></a><a href=\"index.php?module=adresse&action=multilevel&cmd=delete&id=$id&sid=%value%#tabs-2\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\" ></a>";

        //            $menucol=3;
        
        // SQL statement

        $sql = "SELECT SQL_CALC_FOUND_ROWS m.id, m.bezeichnung, m.betrag, m.id FROM mlm_wartekonto m "; //LEFT JOIN artikel a ON a.id=m.artikel ";

        
        // Fester filter

        $where = " m.adresse='$id' AND m.abgerechnet=0 ";

        // gesamt anzahl
        $count = "SELECT COUNT(id) FROM mlm_wartekonto WHERE adresse='$id' AND abgerechnet=0";
        break;
      case "auftraegeinbearbeitungimport":
        $allowed['auftrag'] = array('list');

        // headings
        $heading = array('', 'Auftrag', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Monitor', 'Men&uuml;');
        $width = array('1%', '1%', '10%', '10%', '40%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kunde', 'name', 'land', 'projekt', 'zahlungsweise', 'gesamtsumme', 'status', 'id');
        $searchsql = array('a.datum', 'a.belegnr', 'a.ihrebestellnummer', 'internet', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', 'a.gesamtsumme');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'a.ihrebestellnummer', 'internet', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})", 'adr.freifeld1');
        $sumcol = 9;
        $alignright = array('9');
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=auftrag&action=edit&id=%value%\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=auftrag&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=auftrag&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
                                     CONCAT(if(belegnr='','ENTWURF',belegnr),if(projektfiliale > 0,' (F)','')) as belegnr, DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, adr.kundennummer as kunde,
                                       CONCAT(" . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . ",if(a.internebemerkung='','',' <font color=red><strong>*</strong></font>'),if(a.freitext='','',' <font color=blue><strong>*</strong></font>')) as name, 
                                         IF(a.internet !='', CONCAT(a.land,' (I)'), a.land) as land,LEFT(UPPER( p.abkuerzung),10) as projekt, a.zahlungsweise as zahlungsweise,  
                                         FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag,  (" . $this->IconsSQL() . ")  as icons, a.id
                                           FROM  auftrag a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";
        $where = " a.id!='' AND a.status='angelegt' AND (a.shopextid > 0 OR a.shopextid!='')  " . $this->app->erp->ProjektRechte();
        $count = "SELECT COUNT(a.id) FROM auftrag a WHERE a.status='angelegt' AND (a.shopextid > 0 OR a.shopextid!='') ";
        $moreinfo = true;
        break;
      case "auftraegeinbearbeitung":
        $allowed['auftrag'] = array('create', 'list');

        // headings
        $heading = array('', 'Auftrag', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Monitor', 'Men&uuml;');
        $width = array('1%', '1%', '10%', '10%', '40%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kunde', 'name', 'land', 'projekt', 'zahlungsweise', 'gesamtsumme', 'status', 'id');
        $searchsql = array('a.datum', 'a.belegnr', 'a.ihrebestellnummer', 'internet', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', 'a.gesamtsumme');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'a.ihrebestellnummer', 'internet', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})", 'adr.freifeld1');
        $alignright = array('9');
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=auftrag&action=edit&id=%value%\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=auftrag&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=auftrag&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
                                     CONCAT(if(belegnr='','ENTWURF',belegnr),if(projektfiliale > 0,' (F)','')) as belegnr, DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, adr.kundennummer as kunde,
                                       CONCAT(" . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . ",if(a.internebemerkung='','',' <font color=red><strong>*</strong></font>'),if(a.freitext='','',' <font color=blue><strong>*</strong></font>')) as name, 
                                         IF(a.internet !='', CONCAT(a.land,' (I)'), a.land) as land,LEFT(UPPER( p.abkuerzung),10) as projekt, a.zahlungsweise as zahlungsweise,  
                                         FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag,  (" . $this->IconsSQL() . ")  as icons, a.id
                                           FROM  auftrag a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";
        $where = " a.id!='' AND a.status='angelegt' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM auftrag a WHERE a.status='angelegt' ";
        $moreinfo = true;
        break;
      case "auftraegeoffene":
        $allowed['auftrag'] = array('positionstabelle', 'list');

        // headings
        $heading = array('', '', 'Auftrag', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Monitor', 'Men&uuml;');
        $width = array('1%', '1%', '10%', '12%', '10%', '35%', '1%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'versand', 'belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'zahlungsweise', 'gesamtsumme', 'status', 'icons', 'id');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'a.ihrebestellnummer', 'internet', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'adr.freifeld1', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})");
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=auftrag&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=auftrag&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=auftrag&action=pdf&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $defaultorder = 11;
        $defaultorderdesc = 1;
        $menucol = 11;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
                                     CONCAT('<!--',if(a.autoversand='1' AND a.vorkasse_ok='1' AND a.liefertermin_ok='1' AND a.porto_ok='1' AND a.lager_ok='1' AND a.check_ok='1' AND a.ust_ok='1','checked',''),'--><input type=\"checkbox\" name=\"auftraegemarkiert[]\" value=\"',a.id,'\"',
                                         if(a.autoversand AND a.vorkasse_ok AND a.liefertermin_ok='1' AND a.porto_ok AND a.lager_ok='1' AND a.check_ok='1' AND a.ust_ok,'checked',''),'>') as versand, 
                                     CONCAT(a.belegnr,if(a.autoversand,'','')), a.datum as vom, adr.kundennummer as kundennummer, CONCAT(" . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . ",if(a.internebemerkung='','',' <font color=red><strong>*</strong></font>',if(a.freitext='','',' <font color=blue><strong>*</strong></font>'))) as kunde, 
                                     IF(a.internet !='', CONCAT(a.land,' (I)'), a.land) as land, 
                                     p.abkuerzung as projekt, a.zahlungsweise as zahlungsweise, FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag, (" . $this->IconsSQL() . ")  as icons, a.id 
                                       FROM  auftrag a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";

        // Fester filter
        $where = " a.id!='' AND (a.belegnr!=0 OR a.belegnr!='') AND a.status='freigegeben' AND a.inbearbeitung=0 AND a.nachlieferung!='1'  
                                     AND a.vorkasse_ok='1' AND a.porto_ok='1' AND a.lager_ok='1' AND a.check_ok='1' AND a.ust_ok='1' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM auftrag a WHERE  a.id!='' AND (a.belegnr!=0 OR a.belegnr!='') AND a.status='freigegeben' 
                                     AND a.inbearbeitung=0 AND a.nachlieferung!='1' AND a.vorkasse_ok='1' AND a.porto_ok='1' AND a.lager_ok='1' AND a.check_ok='1' AND a.ust_ok='1' ";
        $moreinfo = true;
        break;
      case "auftraege":
        $allowed['auftrag'] = array('list');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#artikellager').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#ustpruefung').click( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#zahlungseingang').click( function() { fnFilterColumn3( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#zahlungseingangfehlt').click( function() { fnFilterColumn5( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#manuellepruefung').click( function() { fnFilterColumn4( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#ohnerechnung').click( function() { fnFilterColumn10( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#auftragheute').click( function() { fnFilterColumn6( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#auftragoffene').click( function() { fnFilterColumn7( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#auftragstornierte').click( function() { fnFilterColumn8( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#auftragabgeschlossene').click( function() { fnFilterColumn9( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#teillieferung').click( function() { fnFilterColumn11( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#portofehlt').click( function() { fnFilterColumn12( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#teilzahlung').click( function() { fnFilterColumn13( 0 ); } );");

        //            $this->app->Tpl->Add('JQUERYREADY',"$('#artikellager').click( function() {  oTable".$name.".fnDraw(); } );");
        for ($r = 1;$r < 14;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                         function fnFilterColumn' . $r . ' ( i )
                                         {
                                         if(oMoreData' . $r . $name . '==1)
                                         oMoreData' . $r . $name . ' = 0;
                                         else
                                         oMoreData' . $r . $name . ' = 1;

                                         $(\'#' . $name . '\').dataTable().fnFilter( 
                                           \'A\',
                                           i, 
                                           0,0
                                           );
                                         }
                                         ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('', 'Auftrag', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Monitor', 'Men&uuml;');
        $width = array('1%', '1%', '10%', '10%', '40%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kunde', 'name', 'land', 'projekt', 'zahlungsweise', 'gesamtsumme', 'status', 'icons', 'id');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'a.ihrebestellnummer', 'a.internet', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})", 'adr.freifeld1');
        $alignright = array('9');
        $defaultorder = 12; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $sumcol = 9;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=auftrag&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=auftrag&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=auftrag&action=copy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=auftrag&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        $parameter = $this->app->User->GetParameter('table_filter_auftrag');
        $parameter = base64_decode($parameter);
        $parameter = json_decode($parameter, true);

        $sql = "";
        $sql .= "
          SELECT SQL_CALC_FOUND_ROWS a.id,'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, 
                                     CONCAT(if(a.status='angelegt','ENTWURF',a.belegnr),if(a.projektfiliale > 0,' (F)','')), 

      DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, adr.kundennummer as kunde,CONCAT(" . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . ",if(a.internebemerkung='','',' <font color=red><strong>*</strong></font>'),if(a.freitext='','',' <font color=blue><strong>*</strong></font>')) as name, 
                                       IF(a.internet !='', CONCAT(a.land,' (I)'), a.land) as land,LEFT(UPPER( p.abkuerzung),10) as projekt, a.zahlungsweise as zahlungsweise,  
                                         FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag,  (" . $this->IconsSQL() . ")  as icons, a.id
          FROM
            auftrag a 
            LEFT JOIN projekt p ON p.id=a.projekt 
            LEFT JOIN adresse adr ON a.adresse=adr.id
        ";


        // Fester filter
        
        // START EXTRA more

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " a.lager_ok=0 ";
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        
        if ($more_data2 == 1) $subwhere[] = " a.ust_ok=0 ";

        $more_data3 = $this->app->Secure->GetGET("more_data3");
        if ($more_data3 == 1) $subwhere[] = " a.vorkasse_ok=1 ";

        $more_data13 = $this->app->Secure->GetGET("more_data13");
        if ($more_data13 == 1) $subwhere[] = " a.vorkasse_ok=2 ";



        //$more_data4 = $this->app->Secure->GetGET("more_data4"); if($more_data4==1) $subwhere[] = " a.check_ok=0 ";
        $more_data4 = $this->app->Secure->GetGET("more_data4");
        
        if ($more_data4 == 1) $subwhere[] = " (a.check_ok=0 OR a.liefersperre_ok=0 OR a.kreditlimit_ok='0') ";
        $more_data5 = $this->app->Secure->GetGET("more_data5");
        
        if ($more_data5 == 1) $subwhere[] = " a.vorkasse_ok=0 ";
        $more_data6 = $this->app->Secure->GetGET("more_data6");
        
        if ($more_data6 == 1) {
          $subwhere[] = " a.datum=CURDATE() ";
          $ignore = true;
        }
        $more_data7 = $this->app->Secure->GetGET("more_data7");
        
        if ($more_data7 == 1) {
          $subwhere[] = " a.status='freigegeben' ";
          $ignore = true;
        }

        $more_data8 = $this->app->Secure->GetGET("more_data8");
        
        if ($more_data8 == 1) {
          $subwhere[] = " a.status='storniert' ";
          $ignore = true;
        }
        $more_data9 = $this->app->Secure->GetGET("more_data9");
        
        if ($more_data9 == 1) {
          $subwhere[] = " a.status='abgeschlossen' ";
          $ignore = true;
        }
        $more_data10 = $this->app->Secure->GetGET("more_data10");
        
        if ($more_data10 == 1) {
          $subwhere[] = " (SELECT COUNT(r.id) FROM rechnung r WHERE r.auftragid=a.id) <= 0 AND a.gesamtsumme > 0 ";
          $ignore = true;
        }
        $more_data11 = $this->app->Secure->GetGET("more_data11");
        
        if ($more_data11 == 1) {
          $subwhere[] = " a.teillieferung_moeglich='1' ";
        }
        $more_data12 = $this->app->Secure->GetGET("more_data12");
        
        if ($more_data12 == 1) {
          $subwhere[] = " a.porto_ok=0 ";
        }
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        
        if ($tmp != "" && !$ignore) $tmp.= " AND a.status='freigegeben' ";

        // ENDE EXTRA more
        $where = " a.id!='' $tmp " . $this->app->erp->ProjektRechte();

        /* STAMMDATEN */
        if(isset($parameter['kundennummer']) && !empty($parameter['kundennummer'])) {
          $paramsArray[] = "a.kundennummer LIKE '%".$parameter['kundennummer']."%' ";
        }

        if(isset($parameter['name']) && !empty($parameter['name'])) {
          $paramsArray[] = "a.name LIKE '%".$parameter['name']."%' ";
        }

        if(isset($parameter['ansprechpartner']) && !empty($parameter['ansprechpartner'])) {
          $paramsArray[] = "a.ansprechpartner LIKE '%".$parameter['ansprechpartner']."%' ";
        }

        if(isset($parameter['abteilung']) && !empty($parameter['abteilung'])) {
          $paramsArray[] = "a.abteilung LIKE '%".$parameter['abteilung']."%' ";
        }

        if(isset($parameter['strasse']) && !empty($parameter['strasse'])) {
          $paramsArray[] = "a.strasse LIKE '%".$parameter['strasse']."%' ";
        }

        if(isset($parameter['plz']) && !empty($parameter['plz'])) {
          $paramsArray[] = "a.plz LIKE '".$parameter['plz']."%'";
        }

        if(isset($parameter['ort']) && !empty($parameter['ort'])) {
          $paramsArray[] = "a.ort LIKE '%".$parameter['ort']."%' ";
        }

        if(isset($parameter['land']) && !empty($parameter['land'])) {
          $paramsArray[] = "a.land LIKE '%".$parameter['land']."%' ";
        }

        if(isset($parameter['ustid']) && !empty($parameter['ustid'])) {
          $paramsArray[] = "a.ustid LIKE '%".$parameter['ustid']."%' ";
        }

        if(isset($parameter['telefon']) && !empty($parameter['telefon'])) {
          $paramsArray[] = "a.telefon LIKE '%".$parameter['telefon']."%' ";
        }

        if(isset($parameter['email']) && !empty($parameter['email'])) {
          $paramsArray[] = "a.email LIKE '%".$parameter['email']."%' ";
        }


        /* XXX */
        if(isset($parameter['datumVon']) && !empty($parameter['datumVon'])) {
          $paramsArray[] = "unix_timestamp(a.datum) >= " . strtotime($parameter['datumVon']);
        }

        if(isset($parameter['datumBis']) && !empty($parameter['datumBis'])) {
          $paramsArray[] = "unix_timestamp(a.datum) <= " . strtotime($parameter['datumBis']);
        }

        if(isset($parameter['projekt']) && !empty($parameter['projekt'])) {

          $projektData = $this->app->DB->SelectArr('
            SELECT
              *
            FROM
              projekt
            WHERE
              abkuerzung LIKE "' . $parameter['projekt'] . '"
          ');

          $projektData = reset($projektData);
          $paramsArray[] = "a.projekt = '".$projektData['id']."' ";

        }

        if(isset($parameter['belegnummer']) && !empty($parameter['belegnummer'])) {
          $paramsArray[] = "a.belegnr LIKE '".$parameter['belegnummer']."' ";
        }

        if(isset($parameter['internebemerkung']) && !empty($parameter['internebemerkung'])) {
          $paramsArray[] = "a.internebemerkung LIKE '%".$parameter['internebemerkung']."%' ";
        }

        if(isset($parameter['aktion']) && !empty($parameter['aktion'])) {
          $paramsArray[] = "a.aktion LIKE '%".$parameter['aktion']."%' ";
        }

        if(isset($parameter['freitext']) && !empty($parameter['freitext'])) {
          $paramsArray[] = "a.freitext LIKE '%".$parameter['freitext']."%' ";
        }

        if(isset($parameter['zahlungsweise']) && !empty($parameter['zahlungsweise'])) {
          $paramsArray[] = "a.zahlungsweise LIKE '%".$parameter['zahlungsweise']."%' ";
        }

        if(isset($parameter['status']) && !empty($parameter['status'])) {
          $paramsArray[] = "a.status LIKE '%".$parameter['status']."%' ";
        }

        if(isset($parameter['versandart']) && !empty($parameter['versandart'])) {
          $paramsArray[] = "a.versandart LIKE '%".$parameter['versandart']."%' ";
        }

        if(isset($parameter['betragVon']) && !empty($parameter['betragVon'])) {
          $paramsArray[] = "a.gesamtsumme >= '" . $parameter['betragVon'] . "' ";
        }

        if(isset($parameter['betragBis']) && !empty($parameter['betragBis'])) {
          $paramsArray[] = "a.gesamtsumme <= '" . $parameter['betragBis'] . "' ";
        }

        // projekt, belegnummer, internetnummer, bestellnummer, transaktionsId, freitext, internebemerkung, aktionscodes

        if ($paramsArray) {
          $where .= ' AND ' . implode(' AND ', $paramsArray);
        }

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM auftrag a ";
        $moreinfo = true; // EXTRA

        break;
      case 'inhaltsseiten':
        $allowed['inhalt'] = array('list');

        // EXTRA CHECKBOXEN
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyde').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyen').click( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyonline').click( function() { fnFilterColumn3( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyoffline').click( function() { fnFilterColumn4( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyhtml').click( function() { fnFilterColumn5( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyemail').click( function() { fnFilterColumn6( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlygroups').click( function() { fnFilterColumn7( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyteaser').click( function() { fnFilterColumn8( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlynews').click( function() { fnFilterColumn9( 0 ); } );");
        for ($r = 1;$r < 10;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                         function fnFilterColumn' . $r . ' ( i )
                                         {
                                         if(oMoreData' . $r . $name . '==1)
                                         oMoreData' . $r . $name . ' = 0;
                                         else
                                         oMoreData' . $r . $name . ' = 1;

                                         $(\'#' . $name . '\').dataTable().fnFilter( 
                                           \'A\',
                                           i, 
                                           0,0
                                           );
                                         }
                                         ');
        }

        // ENDE EXTRA CHECKBOXEN
        $heading = array('Inhalts-ID', 'Typ', 'Sprache', 'Shop', 'Erstellt', 'Sichtbar bis', 'Status', 'Men&uuml;');
        $width = array('10%', '10%', '1%', '15%', '10%', '10%', '7%', '10%');
        $findcols = array('inhalt', 'inhaltstyp', 'sprache', 'shop', 'datum', 'sichtbarbis', 'aktiv', 'id');
        $searchsql = array('i.inhalt', 'i.inhaltstyp', 's.bezeichnung', 'i.datum', 'i.sichtbarbis');
        $menu = "<a href=\"index.php?module=inhalt&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=inhalt&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=inhalt&action=copy&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";
        $sql = "SELECT SQL_CALC_FOUND_ROWS i.id, i.inhalt, i.inhaltstyp, i.sprache, s.bezeichnung AS shop, i.datum, DATE(i.sichtbarbis) as sichtbarbis, 
                                     IF(i.aktiv=1,'<span style=\"background-color:green;color: #FFF;\">ONLINE</span>','OFFLINE') AS aktiv, i.id 
                                     FROM inhalt AS i LEFT JOIN shopexport AS s ON s.id=i.shop ";
        $subwhere = array();
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " i.sprache='de' ";
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        
        if ($more_data2 == 1) $subwhere[] = " i.sprache='en' ";
        $more_data3 = $this->app->Secure->GetGET("more_data3");
        
        if ($more_data3 == 1) $subwhere[] = " i.aktiv=1 ";
        $more_data4 = $this->app->Secure->GetGET("more_data4");
        
        if ($more_data4 == 1) $subwhere[] = " i.aktiv=1 ";
        $more_data5 = $this->app->Secure->GetGET("more_data5");
        
        if ($more_data5 == 1) $subwhere[] = " i.inhaltstyp='page' ";
        $more_data6 = $this->app->Secure->GetGET("more_data6");
        
        if ($more_data6 == 1) $subwhere[] = " i.inhaltstyp='email' ";
        $more_data7 = $this->app->Secure->GetGET("more_data7");
        
        if ($more_data7 == 1) $subwhere[] = " i.inhaltstyp='group' ";
        $more_data8 = $this->app->Secure->GetGET("more_data8");
        
        if ($more_data8 == 1) $subwhere[] = " i.inhaltstyp='teaser' ";
        $more_data9 = $this->app->Secure->GetGET("more_data9");
        
        if ($more_data9 == 1) $subwhere[] = " i.inhaltstyp='news' ";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = "i.id $tmp";
        $count = "SELECT COUNT(i.id) FROM inhalt i";
        $moreinfo = false;
        break;
      case 'inhaltsseitenshop':
        $allowed['inhalt'] = array('listshop');

        // EXTRA CHECKBOXEN
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyde').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyen').click( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyonline').click( function() { fnFilterColumn3( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyoffline').click( function() { fnFilterColumn4( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyhtml').click( function() { fnFilterColumn5( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyemail').click( function() { fnFilterColumn6( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlygroups').click( function() { fnFilterColumn7( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlyteaser').click( function() { fnFilterColumn8( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#onlynews').click( function() { fnFilterColumn9( 0 ); } );");
        for ($r = 1;$r < 10;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                         function fnFilterColumn' . $r . ' ( i )
                                         {
                                         if(oMoreData' . $r . $name . '==1)
                                         oMoreData' . $r . $name . ' = 0;
                                         else
                                         oMoreData' . $r . $name . ' = 1;

                                         $(\'#' . $name . '\').dataTable().fnFilter( 
                                           \'A\',
                                           i, 
                                           0,0
                                           );
                                         }
                                         ');
        }

        // ENDE EXTRA CHECKBOXEN
        $heading = array('Inhalts-ID', 'Typ', 'Sprache', 'Erstellt', 'Sichtbar bis', 'Status', 'Men&uuml;');
        $width = array('10%', '10%', '1%', '10%', '10%', '7%', '10%');
        $findcols = array('inhalt', 'inhaltstyp', 'sprache', 'datum', 'sichtbarbis', 'aktiv', 'id');
        $searchsql = array('i.inhalt', 'i.inhaltstyp', 's.bezeichnung', 'i.datum', 'i.sichtbarbis');
        $menu = "<a href=\"index.php?module=inhalt&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=inhalt&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=inhalt&action=copy&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";
        $sql = "SELECT SQL_CALC_FOUND_ROWS i.id, i.inhalt, i.inhaltstyp, i.sprache, i.datum, DATE(i.sichtbarbis) as sichtbarbis, 
                                     IF(i.aktiv=1,'<span style=\"background-color:green;color: #FFF;\">ONLINE</span>','OFFLINE') AS aktiv, i.id 
                                     FROM inhalt AS i LEFT JOIN shopexport AS s ON s.id=i.shop ";
        $subwhere = array();
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " i.sprache='de' ";
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        
        if ($more_data2 == 1) $subwhere[] = " i.sprache='en' ";
        $more_data3 = $this->app->Secure->GetGET("more_data3");
        
        if ($more_data3 == 1) $subwhere[] = " i.aktiv=1 ";
        $more_data4 = $this->app->Secure->GetGET("more_data4");
        
        if ($more_data4 == 1) $subwhere[] = " i.aktiv=1 ";
        $more_data5 = $this->app->Secure->GetGET("more_data5");
        
        if ($more_data5 == 1) $subwhere[] = " i.inhaltstyp='page' ";
        $more_data6 = $this->app->Secure->GetGET("more_data6");
        
        if ($more_data6 == 1) $subwhere[] = " i.inhaltstyp='email' ";
        $more_data7 = $this->app->Secure->GetGET("more_data7");
        
        if ($more_data7 == 1) $subwhere[] = " i.inhaltstyp='group' ";
        $more_data8 = $this->app->Secure->GetGET("more_data8");
        
        if ($more_data8 == 1) $subwhere[] = " i.inhaltstyp='teaser' ";
        $more_data9 = $this->app->Secure->GetGET("more_data9");
        
        if ($more_data9 == 1) $subwhere[] = " i.inhaltstyp='news' ";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $shop = $this->app->Secure->GetGET('id');
        $where = "i.id AND i.shop='$shop' $tmp";
        $count = "SELECT COUNT(i.id) FROM inhalt i WHERE i.shop='$shop'";
        $moreinfo = false;
        break;
      case "arbeitsnachweiseprojekt":
        $allowed['projekt'] = array('arbeitsnachweise');

        // headings
        $heading = array('Datum', 'Dauer', 'Teilprojekt/Aufgabe', 'Men&uuml;');
        $width = array('10%', '10%', '75%', '5%');
        $findcols = array('Datum', 'Dauer', 'aufgabe', 'id');
        $searchsql = array('z.id', 'z.bis');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=projekt&action=arbeitsnachweispdf&date=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";
        $menucol = 11;

        // SQL statement
        
        //'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,

        $sql = "SELECT
                                     'leer',
                                     DATE_FORMAT(z.bis, '%Y-%m-%d') AS Datum, SUM(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600) as Dauer, ap.aufgabe, CONCAT(DATE_FORMAT(z.bis, '%Y-%m-%d'),'-',ap.id) as id

                                       FROM zeiterfassung z LEFT JOIN arbeitspaket ap ON ap.id=z.arbeitspaket
                                       ";

        // Fester filter
        
        // START EXTRA more

        
        //        $more_data1 = $this->app->Secure->GetGET("more_data1"); if($more_data1==1) $subwhere[] = " a.status='freigegeben' ";

        
        //        $more_data2 = $this->app->Secure->GetGET("more_data2"); if($more_data2==1) $subwhere[] = " a.datum=CURDATE() AND a.status='freigegeben'";

        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $id = $this->app->Secure->GetGET("id");
        $where = " ap.aufgabe IS NOT NULL $tmp AND ap.projekt='$id' GROUP by Datum,ap.id ";

        // gesamt anzahl
        $count = "SELECT COUNT(z.id) FROM zeiterfassung z";

        //    $moreinfo = true;
        break;
      case "arbeitspakete":
        $this->app->Tpl->Add('JQUERYREADY', "$('#altearbeitspaket').click( function() { fnFilterColumn1( 0 ); } );");
        for ($r = 1;$r < 2;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                         function fnFilterColumn' . $r . ' ( i )
                                         {
                                         if(oMoreData' . $r . $name . '==1)
                                         oMoreData' . $r . $name . ' = 0;
                                         else
                                         oMoreData' . $r . $name . ' = 1;

                                         $(\'#' . $name . '\').dataTable().fnFilter( 
                                           \'A\',
                                           i, 
                                           0,0
                                           );
                                         }
                                         ');
        }

        // headings
        $heading = array('Art', 'Aufgabe', 'Verantwortlicher', 'Abgabe', 'geplant', 'gebucht', 'Status', 'Men&uuml;');
        $width = array('5%', '25%', '25%', '3%', '3%', '3%', '1%', '10%');
        $findcols = array('art', 'aufgabe', 'name', 'abgabedatum', 'geplant', 'gebucht', 'status', 'id');
        $searchsql = array('adr.name', 'ap.aufgabe', 'ap.abgabedatum', 'ap.status');
        $id = $this->app->Secure->GetGET("id");
        $menu = "<a href=\"index.php?module=projekt&action=arbeitspaketeditpopup&id=%value%&sid=$id\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DisableDialog(\"index.php?module=projekt&action=arbeitspaketdisable&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/versand.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=projekt&action=arbeitspaketdelete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=projekt&action=arbeitspaketcopy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";

        // SQL statement
        
        //'<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,

        $sql = "SELECT  SQL_CALC_FOUND_ROWS  ap.id, 
                                     if(ap.abgenommen,CONCAT('<i>',UCASE(ap.art),'</i>'),UCASE(ap.art)) as art, 
                                       if(ap.abgenommen,CONCAT('<i>',ap.aufgabe,'</i>'),ap.aufgabe) as aufgabe, 
                                         if(ap.abgenommen,CONCAT('<i>',adr.name,'</i>'),adr.name) as name, 
                                           if(ap.abgenommen,CONCAT('<i>',ap.abgabedatum,'</i>'),ap.abgabedatum) as abgabedatum, 
                                             if(ap.abgenommen,CONCAT('<i>',ap.zeit_geplant,'</i>'),ap.zeit_geplant) as geplant, 
                                               if(ap.abgenommen,CONCAT('<i>',

                                                     (SELECT FORMAT(SUM(TIME_TO_SEC(TIMEDIFF(z.bis, z.von)))/3600,2) FROM zeiterfassung z WHERE z.arbeitspaket=ap.id)


                                                     ,'</i>'),

                                                   (SELECT FORMAT(SUM(TIME_TO_SEC(TIMEDIFF(z.bis, z.von)))/3600,2) FROM zeiterfassung z WHERE z.arbeitspaket=ap.id)

                                                 ) as gebucht,
                                                 ap.status as status,
                                                   ap.id 
                                                     FROM arbeitspaket ap LEFT JOIN adresse adr ON ap.adresse=adr.id  ";
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " OR ( ap.abgenommen='1')  ";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= "  " . $subwhere[$j];

        //              if($tmp!="")$tmp .= " AND e.geloescht='1' ";
        
        // Fester filter

        $where = "ap.projekt='$id' AND (ap.geloescht='0' OR ap.geloescht IS NULL) AND ap.abgenommen!='1'$tmp";

        // Fester filter
        
        //            $where = "e.artikel='$id' AND e.geloescht='0' ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(ap.id) FROM arbeitspaket ap WHERE ap.projekt='$id' AND (ap.geloescht='0' OR  ap.geloescht IS NULL)";

        //                      $menucol = 6;
        
        //      $moreinfo = true;

        break;
      case "einkaufspreise":
        $allowed['artikel'] = array('einkauf');
        $this->app->Tpl->Add('JQUERYREADY', "$('#alteeinkaufspreise').click( function() { fnFilterColumn1( 0 ); } );");
        $defaultorder = 4; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 0;
        for ($r = 1;$r < 2;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                         function fnFilterColumn' . $r . ' ( i )
                                         {
                                         if(oMoreData' . $r . $name . '==1)
                                         oMoreData' . $r . $name . ' = 0;
                                         else
                                         oMoreData' . $r . $name . ' = 1;

                                         $(\'#' . $name . '\').dataTable().fnFilter( 
                                           \'A\',
                                           i, 
                                           0,0
                                           );
                                         }
                                         ');
        }

        // headings
        $heading = array('Lieferant', 'Bezeichnung', 'Bestellnummer', 'ab', 'VPE', 'Preis', 'W&auml;hrung', 'bis', 'Men&uuml;');
        $width = array('35%', '35%', '3%', '3%', '1%', '1%', '1%', '1%', '20%');
        $findcols = array('lieferant', 'bezeichnunglieferant', 'bestellnummer', 'ab_menge', 'vpe', 'preis', 'waehrung', 'gueltig_bis', 'id');
        $searchsql = array('adr.name', 'e.bezeichnunglieferant', 'e.bestellnummer', 'e.ab_menge', 'e.vpe');
        $menu = "<a href=\"index.php?module=artikel&action=einkaufeditpopup&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DisableDialog(\"index.php?module=artikel&action=einkaufdisable&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/disable.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=einkaufdelete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=einkaufcopy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";

        // SQL statement
        
          $sql = "SELECT SQL_CALC_FOUND_ROWS e.id, adr.name as lieferant, e.bezeichnunglieferant, e.bestellnummer, 
                                       e.ab_menge as ab_menge ,e.vpe as vpe,e.preis as preis,e.waehrung as waehrung, if(e.gueltig_bis='0000-00-00','-',e.gueltig_bis) as gueltig_bis, e.id as menu
                                       FROM  einkaufspreise e LEFT JOIN projekt p ON p.id=e.projekt LEFT JOIN adresse adr ON e.adresse=adr.id  ";
       
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        //              if($tmp!="")$tmp .= " AND e.geloescht='1' ";
        
        // Fester filter

        
        if ($more_data1 == 1) 
        	$where = "e.artikel='$id' ";
				else
        	$where = "e.artikel='$id'  AND e.geloescht='0' AND (e.gueltig_bis>NOW() OR e.gueltig_bis='0000-00-00') ";

        // Fester filter
        //            $where = "e.artikel='$id' AND e.geloescht='0' ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(e.id) FROM einkaufspreise e WHERE $where";
        break;
      case "verkaufspreise":
        $allowed['artikel'] = array('verkauf');
        $this->app->Tpl->Add('JQUERYREADY', "$('#alteverkaufspreise').click( function() { fnFilterColumn1( 0 ); } );");
        $defaultorder = 3; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 0;
        for ($r = 1;$r < 2;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                         function fnFilterColumn' . $r . ' ( i )
                                         {
                                         if(oMoreData' . $r . $name . '==1)
                                         oMoreData' . $r . $name . ' = 0;
                                         else
                                         oMoreData' . $r . $name . ' = 1;

                                         $(\'#' . $name . '\').dataTable().fnFilter( 
                                           \'A\',
                                           i, 
                                           0,0
                                           );
                                         }
                                         ');
        }
        $heading = array('Kunde/Gruppe', 'Hinweis', 'ab', 'Preis','W&auml;hrung', 'G&uuml;ltig bis', 'Men&uuml;');
        $width = array('40%', '15%', '10%', '5%', '10%', '10%','15%');
        $findcols = array('kunde', 'hinweis', 'ab_menge', 'preis', 'waehrung','gueltig_bis', 'id');
        $searchsql = array('adr.name', 'g.name', 'v.ab_menge', 'v.gueltig_bis','v.waehrung','v.preis');
        $menu = "<a href=\"index.php?module=artikel&action=verkaufeditpopup&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DisableDialog(\"index.php?module=artikel&action=verkaufdisable&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/disable.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=verkaufdelete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=artikel&action=verkaufcopy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS v.id, 
                            if(v.art='Kunde',if(v.adresse='' or v.adresse=0,'Standardpreis',CONCAT(adr.kundennummer,' ',adr.name)),CONCAT(g.name,' ',g.kennziffer)) as kunde,  
                             if(v.adresse > 0 OR v.gruppe >0,'(Keine Rabatte m&ouml;glich)','') as hinweis,
                                v.ab_menge as ab_menge, v.preis as preis, v.waehrung,v.gueltig_bis as gueltig_bis, v.id as menu
                                 FROM  verkaufspreise v LEFT JOIN adresse adr ON v.adresse=adr.id  LEFT JOIN gruppen g ON g.id=v.gruppe ";
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        

        if ($more_data1 == 1) 
          $where = "v.artikel='$id' "; 
        else
          $where = "v.artikel='$id'  AND v.geloescht='0' AND (v.gueltig_bis>NOW() OR v.gueltig_bis='0000-00-00') ";

        // gesamt anzahl
        $count = "SELECT COUNT(v.id) FROM verkaufspreise v WHERE $where";
        break;
      case "projektzeiterfassung":
        $allowed['projekt'] = array('zeit', 'arbeitspaket');
        $this->app->Tpl->Add('JQUERYREADY', "$('#altearbeitspaket').click( function() { fnFilterColumn1( 0 ); } );");
        for ($r = 1;$r < 2;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                         function fnFilterColumn' . $r . ' ( i )
                                         {
                                         if(oMoreData' . $r . $name . '==1)
                                         oMoreData' . $r . $name . ' = 0;
                                         else
                                         oMoreData' . $r . $name . ' = 1;

                                         $(\'#' . $name . '\').dataTable().fnFilter( 
                                           \'A\',
                                           i, 
                                           0,0
                                           );
                                         }
                                         ');
        }

        // headings
        $heading = array('', 'Art', 'Bezeichnung', 'Verantwortlicher', 'Abgabe', 'geplant', 'gebucht', 'Status', 'Men&uuml;');
        $width = array('1%', '5%', '25%', '25%', '3%', '8%', '3%', '1%', '10%');
        $findcols = array('open', 'art', 'bezeichnung', 'name', 'abgabedatum', 'geplant', 'gebucht', 'status', 'id');
        $searchsql = array('adr.name', 'ap.aufgabe', 'ap.abgabedatum', 'ap.status');
        $id = $this->app->Secure->GetGET("id");
        $menu = "<a href=\"index.php?module=projekt&action=arbeitspaketeditpopup&id=%value%&sid=$id\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "<!--&nbsp;<a href=\"#\" onclick=DisableDialog(\"index.php?module=projekt&action=arbeitspaketdisable&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/versand.png\" border=\"0\"></a>-->" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=projekt&action=arbeitspaketdelete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=CopyDialog(\"index.php?module=projekt&action=arbeitspaketcopy&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/copy.png\" border=\"0\"></a>";

        // SQL statement
        $sql = "SELECT  SQL_CALC_FOUND_ROWS  ap.id, 
                                     '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,
                                     if(ap.abgenommen,CONCAT('<i>',UCASE(ap.art),'</i>'),UCASE(ap.art)) as art, 
                                       if(ap.abgenommen,CONCAT('<i>',ap.aufgabe,'</i>'),ap.aufgabe) as 'Bezeichnung', 
                                         if(ap.abgenommen,CONCAT('<i>',adr.name,'</i>'),adr.name) as name, 
                                           if(ap.abgenommen,CONCAT('<i>',ap.abgabedatum,'</i>'),ap.abgabedatum) as abgabedatum, 
                                             if(ap.abgenommen,CONCAT('<i>',if(ap.art='material',CONCAT(FORMAT(ap.kosten_geplant,2{$extended_mysql55}),' &euro;'),ap.zeit_geplant),'</i>'),
                                                 if(ap.art='material' OR ap.kosten_geplant!=0,CONCAT(FORMAT(ap.kosten_geplant,2{$extended_mysql55}),' &euro;'),CONCAT(ap.zeit_geplant,' h'))) as geplant, 
                                               if(ap.abgenommen,CONCAT('<i>',
                                                     (SELECT FORMAT(SUM(TIME_TO_SEC(TIMEDIFF(z.bis, z.von)))/3600,2) FROM zeiterfassung z WHERE z.arbeitspaket=ap.id)

                                                     ,'</i>'),

                                                   (SELECT FORMAT(SUM(TIME_TO_SEC(TIMEDIFF(z.bis, z.von)))/3600,2) FROM zeiterfassung z WHERE z.arbeitspaket=ap.id)

                                                 ) as gebucht,
                                                 ap.status as status,
                                                   ap.id 
                                                     FROM arbeitspaket ap LEFT JOIN adresse adr ON ap.adresse=adr.id  ";
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " OR ( ap.abgenommen='1' AND ap.projekt='$id' AND (ap.geloescht='0' OR ap.geloescht IS NULL) )  ";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= "  " . $subwhere[$j];

        //              if($tmp!="")$tmp .= " AND e.geloescht='1' ";
        
        //           FORMAT(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600,2) AS Dauer,

        
        // Fester filter

        $where = "ap.projekt='$id' AND (ap.geloescht='0' OR ap.geloescht IS NULL) AND ap.abgenommen!='1'$tmp";

        // Fester filter
        
        //            $where = "e.artikel='$id' AND e.geloescht='0' ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(ap.id) FROM arbeitspaket ap WHERE ap.projekt='$id' AND (ap.geloescht='0' OR  ap.geloescht IS NULL)";
        $menucol = 8;

        //      $moreinfo = true;
        $moreinfo = true;
        break;
      case "zeiterfassungmitarbeiter":
        $allowed['adresse'] = array('zeiterfassung');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#offen').click( function() { fnFilterColumn1( 0 ); } );");

        //$this->app->Tpl->Add('JQUERYREADY',"$('#abrechnung').click( function() { fnFilterColumn2( 0 ); } );");
        for ($r = 1;$r < 2;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                               function fnFilterColumn' . $r . ' ( i )
                                               {
                                               if(oMoreData' . $r . $name . '==1)
                                               oMoreData' . $r . $name . ' = 0;
                                               else
                                               oMoreData' . $r . $name . ' = 1;

                                               $(\'#' . $name . '\').dataTable().fnFilter( 
                                                 \'A\',
                                                 i, 
                                                 0,0
                                                 );
                                               }
                                               ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        
        //$heading =  array('','A','Datum','Von','Bis','Dauer','Mitarbeiter','Aufabe','Projekt','Men&uuml;');

        $heading = array('', 'Datum', 'Von', 'Bis', 'Dauer', 'Mitarbeiter', 'Aufgabe', 'Projekt', 'Men&uuml;');

        //$width   =  array('1%','1%','1%','1%','1%','5%','20%','40%','10%','1%');
        $width = array('1%', '1%', '1%', '1%', '5%', '20%', '40%', '10%', '1%');

        //$findcols = array('open','Auswahl','z.von','von','bis','Dauer','Mitarbeiter','id');
        $findcols = array('open', 'z.von', 'von', 'bis', 'Dauer', 'Mitarbeiter', 'id');
        $searchsql = array('z.id', 'z.bis', 'z.aufgabe', 'a.name');
        $defaultorder = 9;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=zeiterfassung&action=create&id=%value%&back=zeiterfassungmitarbeiter&sid=$id\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=zeiterfassung&action=listuser&do=stornieren&id=$id&lid=%value%&back=zeiterfassungmitarbeiter\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        //CONCAT('<input type=\"checkbox\">') as auswahl,
        
        //$menucol=9;

        $menucol = 8;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS z.id,
                                           '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,

                                           DATE_FORMAT(z.bis, GET_FORMAT(DATE,'EUR')) AS Datum, 
                                           DATE_FORMAT(z.von,'%H:%i') as von, DATE_FORMAT(z.bis,'%H:%i') as bis,
                                           CONCAT(LPAD(HOUR(TIMEDIFF(z.bis, z.von)),2,'0'),':',LPAD(MINUTE(TIMEDIFF(z.bis, z.von)),2,'0')) AS Dauer,

                                           a.name as Mitarbeiter,
                                           if(z.adresse_abrechnung!=0,CONCAT('<i>Kunde: ',b.name,' (',b.kundennummer,')</i><br>',z.aufgabe),z.aufgabe) as Taetigkeit,
                                             p.abkuerzung,
                                               z.id

                                                 FROM zeiterfassung z 
                                                 LEFT JOIN adresse a ON a.id=z.adresse 
                                                 LEFT JOIN adresse b ON b.id=z.adresse_abrechnung
                                                 LEFT JOIN projekt p ON p.id=z.projekt 
                                                 LEFT JOIN arbeitspaket ap ON z.arbeitspaket=ap.id";

        // Fester filter
        
        // START EXTRA more

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " z.abrechnen='1' AND z.abgerechnet!='1' ";

        //        $more_data2 = $this->app->Secure->GetGET("more_data2"); if($more_data2==1) $subwhere[] = " a.datum=CURDATE() AND a.status='freigegeben'";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " z.id!='' AND z.adresse='" . $id . "' $tmp";
        $count = "SELECT COUNT(z.id) FROM zeiterfassung z WHERE z.adresse='" . $id . "'";
        $moreinfo = true;
        break;
      case "zeiterfassunguser":
        $allowed['zeiterfassung'] = array('listuser');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#offen').click( function() { fnFilterColumn1( 0 ); } );");

        //$this->app->Tpl->Add('JQUERYREADY',"$('#abrechnung').click( function() { fnFilterColumn2( 0 ); } );");
        for ($r = 1;$r < 2;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                               function fnFilterColumn' . $r . ' ( i )
                                               {
                                               if(oMoreData' . $r . $name . '==1)
                                               oMoreData' . $r . $name . ' = 0;
                                               else
                                               oMoreData' . $r . $name . ' = 1;

                                               $(\'#' . $name . '\').dataTable().fnFilter( 
                                                 \'A\',
                                                 i, 
                                                 0,0
                                                 );
                                               }
                                               ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        
        //$heading =  array('','A','Datum','Von','Bis','Dauer','Mitarbeiter','Aufabe','Projekt','Men&uuml;');

        $heading = array('', 'Datum', 'Von', 'Bis', 'Dauer', 'Mitarbeiter', 'Aufgabe', 'Abr.','Projekt', 'Men&uuml;');

        //$width   =  array('1%','1%','1%','1%','1%','5%','20%','40%','10%','1%');
        $width = array('1%', '1%', '1%', '1%', '5%', '20%', '40%', '5%','5%', '1%');

        //$findcols = array('open','Auswahl','z.von','von','bis','Dauer','Mitarbeiter','id');
        $findcols = array('open', 'z.von', 'von', 'bis', 'Dauer', 'Mitarbeiter','z.aufgabe','z.abrechnen','p.abkuerzung','id');
        $searchsql = array('z.id', 'z.bis', 'z.aufgabe', 'a.name', "if(z.adresse_abrechnung!=0,CONCAT('<i>Kunde: ',b.name,' (',b.kundennummer,')</i><br>',z.aufgabe),z.aufgabe)");
        $defaultorder = 2;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=zeiterfassung&action=create&id=%value%&back=zeiterfassunguser\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=zeiterfassung&action=listuser&do=stornieren&lid=%value%&back=zeiterfassunguser\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        //CONCAT('<input type=\"checkbox\">') as auswahl,
        
        //$menucol=9;

        $menucol = 9;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS z.id,
                                           '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,

                                           DATE_FORMAT(z.bis, GET_FORMAT(DATE,'EUR')) AS Datum, 
                                           DATE_FORMAT(z.von,'%H:%i') as von, DATE_FORMAT(z.bis,'%H:%i') as bis,
                                           CONCAT(LPAD(HOUR(TIMEDIFF(z.bis, z.von)),2,'0'),':',LPAD(MINUTE(TIMEDIFF(z.bis, z.von)),2,'0')) AS Dauer,

                                           a.name as Mitarbeiter,
                                           if(z.art='Pause','<font color=green>Pause</font>',if(z.adresse_abrechnung!=0,CONCAT('<i style=color:#999>Kunde: ',b.name,' (',b.kundennummer,')</i><br>',z.aufgabe),z.aufgabe)) as Taetigkeit,
if(z.abrechnen > 0,'(A)',''),
                                             p.abkuerzung,
                                               z.id

                                                 FROM zeiterfassung z 
                                                 LEFT JOIN adresse a ON a.id=z.adresse 
                                                 LEFT JOIN adresse b ON b.id=z.adresse_abrechnung
                                                 LEFT JOIN projekt p ON p.id=z.projekt 
                                                 LEFT JOIN arbeitspaket ap ON z.arbeitspaket=ap.id";

        // Fester filter
        
        // START EXTRA more

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        if ($more_data1 == 1) $subwhere[] = " z.abrechnen='1' AND z.abgerechnet!='1' ";

        //        $more_data2 = $this->app->Secure->GetGET("more_data2"); if($more_data2==1) $subwhere[] = " a.datum=CURDATE() AND a.status='freigegeben'";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " z.id!='' AND z.adresse='" . $this->app->User->GetAdresse() . "' $tmp";
        $count = "SELECT COUNT(z.id) FROM zeiterfassung z WHERE z.adresse='" . $this->app->User->GetAdresse() . "'";
        $moreinfo = true;
        break;

        // Administration-tables:
        
      case "userlist":
        $allowed['user'] = array('list');
        $allowed['benutzer'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Login','Typ', 'Beschreibung', 'Aktiv', 'Extern', 'Hardware', 'Men&uuml;');
        $width = array('30%','10%' ,'20%', '20%', '10%', '10%', '10%');
        $findcols = array('u.username','u.type' ,'a.name', 'u.activ', 'u.externlogin', 'u.hwtoken', 'u.id'); //'a.name','a.kundennummer',"SUM(TIME_TO_SEC(TIMEDIFF(z.bis, z.von)))/3600",'id');

        $searchsql = array('u.username','u.type', 'a.name', 'u.activ', 'u.externlogin', 'u.hwtoken');
        $defaultorder = 1; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 0;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=benutzer&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=benutzer&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS u.id, u.username as login, u.type,  a.name as beschreibung, if(u.activ,'ja','-') as aktiv,  if(u.externlogin,'erlaubt','-') as extern, 
        if(u.hwtoken=3,'WaWision OTP',if(u.hwtoken=1,'mOTP','')) as 'Hardware', u.id FROM user u LEFT JOIN adresse a ON a.id=u.adresse ";
        $where = ""; // z.abrechnen=1 AND z.abgerechnet!=1 AND a.id > 0 ";

        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM user";
        break;
      case "geschaeftsbrief_vorlagenlist":
        $allowed['geschaeftsbrief_vorlagen'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Typ', 'Betreff', 'Projekt', 'Sprache', 'Men&uuml;');
        $width = array('10%', '50%', '20%', '10%', '10%');
        $findcols = array('g.subjekt', 'g.betreff', 'p.abkuerzung', 'g.sprache', 'g.id');
        $searchsql = array('g.subjekt', 'g.betreff', 'p.abkuerzung', 'g.sprache');
        $menucol = 4;
        $defaultorder = 1; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 0;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=geschaeftsbrief_vorlagen&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=geschaeftsbrief_vorlagen&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS g.id, g.subjekt as typ, g.betreff, if(g.projekt<=0,'Standard Vorlage / ohne Projekt',p.abkuerzung) as projekt, g.sprache, g.id FROM geschaeftsbrief_vorlagen g 
                                           LEFT JOIN projekt p ON g.projekt=p.id ";
        $where = "g.firma='" . $this->app->User->GetFirma() . "' " . $this->app->erp->ProjektRechte();

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM geschaeftsbrief_vorlagen";
        break;
      case "artikeleinheitlist":
        $allowed['artikeleinheit'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Einheit', 'Men&uuml;');
        $width = array('40%', '20%');
        $findcols = array('a.einheit_de', 'a.id');
        $searchsql = array('a.einheit_de');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=artikeleinheit&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikeleinheit&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.einheit_de as einheit, a.id FROM artikeleinheit a ";
        $where = "";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM artikeleinheit";
        break;
      case "artikeloptionengruppelist":
        // headings
        $allowed['artikeloptionengruppe'] = array('list');
        $heading = array('Name', 'Projekt','Artikel', 'Men&uuml;');
        $width = array('20%', '30%','30%', '10%');
        $findcols = array('k.name', 'p.abkuerzung','a.nummer', 'k.id');
        $searchsql = array('k.name');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=artikeloptionengruppe&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikeloptionengruppe&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS k.id, k.name,p.abkuerzung,a.nummer, k.id FROM  artikeloptionengruppe k 
                                           LEFT JOIN projekt p ON p.id=k.projekt left join artikel a on a.id = k.artikel ";

        $where = " k.geloescht!=1 ";


        $count = "SELECT COUNT(id) FROM artikeloptionengruppe WHERE geloescht!=1";
        
      break;
      case "etikettenlist":
        $allowed['etiketten'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        // headings

        $heading = array('Nummer', 'Verwenden als', 'Format','Men&uuml;');
        $width = array('20%', '40%', '30%','10%');
        $findcols = array('k.name', 'k.verwendenals','k.format', 'k.id');
        $searchsql = array('k.name', 'k.verwendenals','k.format');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=etiketten&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=etiketten&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS k.id, k.name,k.verwendenals, k.format, k.id FROM etiketten k ";
        $where = "";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM etiketten";
        break;
      case "uebersetzunglist":
        $allowed['uebersetzung'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Variable', 'Sprache', '&Uuml;bersetzung', 'Men&uuml;');
        $width = array('20%', '10%', '60%', '10%');
        $findcols = array('u.label', 'u.sprache', 'u.beschriftung', 'u.id');
        $searchsql = array('u.label', 'u.sprache', 'u.beschriftung');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=uebersetzung&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=uebersetzung&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS u.id, u.label,u.sprache, 
                                           if(u.beschriftung='',CONCAT('<font color=red>&Uuml;bersetzung fehlt:</font> ',LEFT(u.original,110)),LEFT(u.beschriftung,120)), u.id FROM uebersetzung u";
        $where = "";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM uebersetzung";
        break;
      case "reisekostenartlist":
        $allowed['reisekostenart'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Numer', 'Beschreibung', 'Men&uuml;');
        $width = array('10%', '30%', '10%');
        $findcols = array('r.nummer', 'r.beschreibung', 'r.id');
        $searchsql = array('r.nummer', 'r.beschreibung');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=reisekostenart&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=reisekostenart&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id, r.nummer, r.beschreibung, r.id FROM reisekostenart r ";
        $where = "";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM reisekostenart";
        break;
      case "onlineshopslist":
        $allowed['onlineshops'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Bezeichnung', 'Url', 'Projekt', 'Aktiv', 'Men&uuml;');
        $width = array('30%', '20%', '10%', '10%', '10%');
        $findcols = array('s.bezeichnung', 's.url', 'p.name', 's.aktiv', 's.id');
        $searchsql = array('s.bezeichnung', 's.url', 'p.name', 's.aktiv');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=onlineshops&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=onlineshops&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS s.id, s.bezeichnung, s.url, p.name, if(s.aktiv,'ja','nein') as aktiv, s.id FROM shopexport s LEFT JOIN projekt p ON s.projekt=p.id";
        $where = "" . $this->app->erp->ProjektRechte();

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM shopexport";
        break;
      case "prozessstarterlist":
        $allowed['prozessstarter'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Bezeichnung', 'Art', 'Periode', 'Aktiviert', 'Laeuft', 'Letzte Ausfuehrung', 'Typ', 'Parameter', 'Men&uuml;');
        $width = array('15%', '10%', '10%', '10%', '10%', '20%', '5%', '10%', '10%');
        $findcols = array('p.bezeichnung', 'p.art', 'p.periode', 'p.aktiv', 'p.mutex', 'p.letzteausfuerhung', 'p.typ', 'p.parameter', 'p.id');
        $searchsql = array('p.bezeichnung', 'p.art', 'p.periode', 'p.aktiv', 'p.mutex', 'p.letzteausfuerhung', 'p.typ', 'p.parameter');
        $defaultorder = 2;
        $defaultorderdesc = 0;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=prozessstarter&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=prozessstarter&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS p.id, p.bezeichnung, p.art, p.periode, if(p.aktiv,'ja','-') as aktiviert, if(p.mutex,CONCAT('ja (Anzahl Versuche ',mutexcounter,')'),'-') as laeuft, p.letzteausfuerhung as 'letzte Ausf&uuml;hrung', p.typ, p.parameter, p.id FROM prozessstarter p ";
        $where = "p.firma='" . $this->app->User->GetFirma() . "'";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM prozessstarter";
        break;
      case "aktionscodes_gutschrift":
        $allowed['aktionscodes'] = array('list');
        // headings
        $heading = array('Gutschrift', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Zahlung', 'Status', 'Men&uuml;');

        //$width   =  array('1%','2%','5%','5%','50%','3%','3%','3%','3%','3%','3%','3%');
        $width = array('10%', '10%', '10%', '35%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'zahlungsweise', 'soll', 'zahlung', 'status', 'id');
        $searchsql = array('DATE_FORMAT(r.datum,\'%d.%m.%Y\')', 'r.belegnr', 'adr.kundennummer', 'r.name', 'r.land', 'p.abkuerzung', 'r.zahlungsweise', 'r.status', "FORMAT(r.soll,2{$extended_mysql55})", 'r.zahlungsstatus', 'adr.freifeld1');
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $alignright = array('8');
        $sumcol = 8;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=gutschrift&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 11;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id, r.belegnr as belegnr, DATE_FORMAT(r.datum,'%Y-%m-%d') as vom, 
                                           adr.kundennummer, " . $this->app->erp->MarkerUseredit("r.name", "r.useredittimestamp") . " as kunde, r.land as land, p.abkuerzung as projekt, r.zahlungsweise as zahlungsweise,  
                                           FORMAT(r.soll,2{$extended_mysql55}) as soll, r.zahlungsstatus as zahlung, UPPER(r.status) as status, r.id
                                             FROM  gutschrift r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";

        // Fester filter
        $actionscode_code = $this->app->User->GetParameter("aktionscodes_code");
        $actionscode_von = $this->app->User->GetParameter("aktionscodes_von");
        $actionscode_bis = $this->app->User->GetParameter("aktionscodes_bis");

        // START EXTRA more
        $where = " r.aktion='$actionscode_code' AND r.datum >='$actionscode_von' AND r.datum <='$actionscode_bis' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(r.id) FROM gutschrift r WHERE r.aktion='$actionscode_code' AND r.datum >='$actionscode_von' AND r.datum <='$actionscode_bis' ";
        break;
      case "aktionscodes_rechnung":
        $allowed['aktionscodes'] = array('list');
        // headings
        $heading = array('Rechnung', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Zahlung', 'Status', 'Men&uuml;');

        //$width   =  array('1%','2%','5%','5%','50%','3%','3%','3%','3%','3%','3%','3%');
        $width = array('10%', '10%', '10%', '35%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('belegnr', 'vom', 'kundennummer', 'kunde', 'land', 'projekt', 'zahlungsweise', 'soll', 'zahlung', 'status', 'id');
        $searchsql = array('DATE_FORMAT(r.datum,\'%d.%m.%Y\')', 'r.belegnr', 'adr.kundennummer', 'r.name', 'r.land', 'p.abkuerzung', 'r.zahlungsweise', 'r.status', "FORMAT(r.soll,2{$extended_mysql55})", 'r.zahlungsstatus', 'adr.freifeld1');
        $defaultorder = 11; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $alignright = array('8');
        $sumcol = 8;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=rechnung&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 11;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS r.id, r.belegnr as belegnr, DATE_FORMAT(r.datum,'%Y-%m-%d') as vom, 
                                           adr.kundennummer, " . $this->app->erp->MarkerUseredit("r.name", "r.useredittimestamp") . " as kunde, r.land as land, p.abkuerzung as projekt, r.zahlungsweise as zahlungsweise,  
                                           FORMAT(r.soll,2{$extended_mysql55}) as soll, r.zahlungsstatus as zahlung, UPPER(r.status) as status, r.id
                                             FROM  rechnung r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id  ";

        // Fester filter
        $actionscode_code = $this->app->User->GetParameter("aktionscodes_code");
        $actionscode_von = $this->app->User->GetParameter("aktionscodes_von");
        $actionscode_bis = $this->app->User->GetParameter("aktionscodes_bis");

        // START EXTRA more
        $where = " r.aktion='$actionscode_code' AND r.datum >='$actionscode_von' AND r.datum <='$actionscode_bis' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(r.id) FROM rechnung r WHERE r.aktion='$actionscode_code' AND r.datum >='$actionscode_von' AND r.datum <='$actionscode_bis' ";
        break;
      case "aktionscodes_auftrag":
        $allowed['aktionscodes'] = array('list');
        // headings
        $heading = array('Auftrag', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '40%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('open', 'belegnr', 'vom', 'kundennummer', 'name', 'land', 'projekt', 'zahlungsweise', 'betrag', 'status', 'id');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})", 'a.status', 'adr.freifeld1');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $sumcol = 8;
        $alignright = array('8');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=auftrag&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=auftrag&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=auftrag&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.belegnr as belegnr, DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, 
                                           adr.kundennummer as kundennummer, " . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . " as name, a.land as land, p.abkuerzung as projekt, a.zahlungsweise as zahlungsweise,  
                                           FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag, UPPER(a.status) as status, a.id
                                             FROM  auftrag a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";

        // Fester filter
        $actionscode_code = $this->app->User->GetParameter("aktionscodes_code");
        $actionscode_von = $this->app->User->GetParameter("aktionscodes_von");
        $actionscode_bis = $this->app->User->GetParameter("aktionscodes_bis");

        // START EXTRA more
        $where = " a.aktion='$actionscode_code' AND a.datum >='$actionscode_von' AND a.datum <='$actionscode_bis' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM auftrag a WHERE a.aktion='$actionscode_code' AND a.datum >='$actionscode_von' AND a.datum <='$actionscode_bis' ";
        break;
      case "aktionscodes_angebot":
        $allowed['aktionscodes'] = array('list');
        // headings
        $heading = array('Angebot', 'Vom', 'Kd-Nr.', 'Kunde', 'Land', 'Projekt', 'Zahlung', 'Betrag', 'Status', 'Men&uuml;');
        $width = array('1%', '10%', '10%', '40%', '5%', '1%', '1%', '1%', '1%', '1%', '1%', '1%');
        $findcols = array('belegnr', 'vom', 'kundennummer', 'name', 'land', 'projekt', 'zahlungsweise', 'betrag', 'status', 'id');
        $searchsql = array('DATE_FORMAT(a.datum,\'%d.%m.%Y\')', 'a.belegnr', 'adr.kundennummer', 'a.name', 'a.land', 'p.abkuerzung', 'a.zahlungsweise', 'a.status', "FORMAT(a.gesamtsumme,2{$extended_mysql55})", 'a.status', 'adr.freifeld1');
        $defaultorder = 10; //Optional wenn andere Reihenfolge gewuenscht

        $defaultorderdesc = 1;
        $sumcol = 8;
        $alignright = array('8');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=angebot&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=angebot&action=delete&id=%value%\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;<a href=\"index.php?module=angebot&action=pdf&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a></td></tr></table>";
        $menucol = 10;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.belegnr as belegnr, DATE_FORMAT(a.datum,'%Y-%m-%d') as vom, 
                                           adr.kundennummer as kundennummer, " . $this->app->erp->MarkerUseredit("a.name", "a.useredittimestamp") . " as name, a.land as land, p.abkuerzung as projekt, a.zahlungsweise as zahlungsweise,  
                                           FORMAT(a.gesamtsumme,2{$extended_mysql55}) as betrag, UPPER(a.status) as status, a.id
                                             FROM  angebot a LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN adresse adr ON a.adresse=adr.id  ";

        // Fester filter
        $actionscode_code = $this->app->User->GetParameter("aktionscodes_code");
        $actionscode_von = $this->app->User->GetParameter("aktionscodes_von");
        $actionscode_bis = $this->app->User->GetParameter("aktionscodes_bis");

        // START EXTRA more
        $where = " a.aktion='$actionscode_code' AND a.datum >='$actionscode_von' AND a.datum <='$actionscode_bis' " . $this->app->erp->ProjektRechte();

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM angebot a WHERE a.aktion='$actionscode_code' AND a.datum >='$actionscode_von' AND a.datum <='$actionscode_bis' ";
        break;
      case "lagerbestandsberechnung":
        $allowed['lager'] = array('wert');
        // headings
        $heading = array('Artikel-Nr.', 'Bezeichnung', 'Lager','Menge','Letzter Preis', 'Gesamt', 'Men&uuml;');
        $width = array('10%', '50%', '20%', '10%', '10%','10%', '10%', '1%');
        $findcols = array('a.nummer', 'a.name_de', "CONCAT(la.bezeichnung,' / ',lp.kurzbezeichnung)", 'l.menge', "IFNULL((SELECT e.preis FROM einkaufspreise e WHERE e.geloescht!=1 AND (e.gueltig_bis='0000-00-00' OR e.gueltig_bis <=NOW()) AND e.artikel=l.artikel ORDER by e.preis LIMIT 1),0)", "IFNULL((SELECT e.preis FROM einkaufspreise e WHERE e.geloescht!=1 AND (e.gueltig_bis='0000-00-00' OR e.gueltig_bis <=NOW()) AND e.artikel=l.artikel ORDER by e.preis LIMIT 1),0)*l.menge", 'l.id');
        $searchsql = array('a.nummer', 'a.name_de','la.bezeichnung','lp.kurzbezeichnung');
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=artikel&action=lager&id=%value%\" target=\"_blank\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/forward.png\" border=\"0\"></a>" . "</td></tr></table>";
        $sumcol = 6;
        $alignright = array(4,5,6);

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, a.nummer, a.name_de, CONCAT(la.bezeichnung,' / ',lp.kurzbezeichnung) ,l.menge,FORMAT(IFNULL((SELECT e.preis FROM einkaufspreise e WHERE e.geloescht!=1 AND (e.gueltig_bis='0000-00-00' OR e.gueltig_bis <=NOW()) AND e.artikel=l.artikel ORDER by e.id DESC LIMIT 1),0),2{$extended_mysql55}) as preis, FORMAT(IFNULL((SELECT e.preis FROM einkaufspreise e WHERE e.geloescht!=1 AND (e.gueltig_bis='0000-00-00' OR e.gueltig_bis <=NOW()) AND e.artikel=l.artikel ORDER by e.id DESC LIMIT 1),0)*l.menge,2{$extended_mysql55}) as wert, a.id FROM lager_platz_inhalt l LEFT JOIN artikel a ON a.id=l.artikel LEFT JOIN lager_platz lp ON lp.id=l.lager_platz LEFT JOIN lager la ON la.id=lp.lager";
        $where = " a.id > 0 ";

        //$groupby=" GROUP by z.adresse_abrechnung ";

        // gesamt anzahl

        $count = "SELECT COUNT(l.id) FROM lager_platz_inhalt l LEFT JOIN artikel a ON a.id=l.artikel WHERE a.id > 0";

        break;
      case "aktionscodes_angebot_nummern":
        $allowed['aktionscodes'] = array('list');
        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Actionscode', 'Anzahl');
        $width = array('90%', '10%');
        $findcols = array('a.aktion', 'COUNT(a.id)');
        $searchsql = array('a.aktion');

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.aktion, COUNT(a.id) as anzahl FROM angebot a ";
        $where = " a.aktion!='' "; //d.firma='".$this->app->User->GetFirma()."'";

        $menu = "%value%";
        $groupby = " GROUP by a.aktion ";

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM angebot a WHERE a.aktion!='' GROUP by a.aktion";
        break;
      case "aktionscodes_auftrag_nummern":
        $allowed['aktionscodes'] = array('list');
        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Actionscode', 'Anzahl');
        $width = array('90%', '10%');
        $findcols = array('a.aktion', 'COUNT(a.id)');
        $searchsql = array('a.aktion');

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.aktion, COUNT(a.id) as anzahl FROM auftrag a ";
        $where = " a.aktion!='' "; //d.firma='".$this->app->User->GetFirma()."'";

        $menu = "%value%";
        $groupby = " GROUP by a.aktion ";

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM auftrag a WHERE a.aktion!='' GROUP by a.aktion";
        break;
      case "aktionscodes_rechnung_nummern":
        $allowed['aktionscodes'] = array('list');
        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Actionscode', 'Anzahl');
        $width = array('90%', '10%');
        $findcols = array('a.aktion', 'COUNT(a.id)');
        $searchsql = array('a.aktion');

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.aktion, COUNT(a.id) as anzahl FROM rechnung a ";
        $where = " a.aktion!='' "; //d.firma='".$this->app->User->GetFirma()."'";

        $menu = "%value%";
        $groupby = " GROUP by a.aktion ";

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM rechnung a WHERE a.aktion!='' GROUP by a.aktion";
        break;
      case "aktionscodes_gutschrift_nummern":
        $allowed['aktionscodes'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Actionscode', 'Anzahl');
        $width = array('90%', '10%');
        $findcols = array('a.aktion', 'COUNT(a.id)');
        $searchsql = array('a.aktion');

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.aktion, COUNT(a.id) as anzahl FROM gutschrift a ";
        $where = " a.aktion!='' "; //d.firma='".$this->app->User->GetFirma()."'";

        $menu = "%value%";
        $groupby = " GROUP by a.aktion ";

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM gutschrift a WHERE a.aktion!='' GROUP by a.aktion";
        break;
      case "systemlog":

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        $allowed['systemlog'] = array('list');

        // headings
        $heading = array('', 'Level', 'Zeit', 'Bearbeiter', 'Module', 'Action', 'Parameter', 'Funktion', 'Meldung', 'Men&uuml;');
        $width = array('4%', '4%', '15%', '10%', '10%', '10%', '10%', '10%', '40%', '10%', '5%');
        $findcols = array('open', 'a.level', 'a.datum', 'a.bearbeiter', 'a.module', 'a.action', 'a.parameter', 'a.funktionsname', 'a.meldung', 'a.id');
        $searchsql = array("DATE_FORMAT(a.datum,'%d.%m.%Y %H:%i:%s')", 'a.bearbeiter', 'a.module', 'a.meldung', 'a.action', 'a.parameter', 'a.funktionsname');
        $defaultorder = 3;
        $defaultorderdesc = 1;
        $menucol = 1;
        $moreinfo = true;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . 
        "</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, a.level,DATE_FORMAT(a.datum,'%d.%m.%Y %H:%i:%s'), a.bearbeiter, 
  a.module, a.action, a.parameter, a.funktionsname,a.meldung,CONCAT('module=',a.module,'&action=',a.action,'&id=',a.parameter) FROM systemlog a";

        //$where = "d.firma='".$this->app->User->GetFirma()."'";
        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(a.id) FROM systemlog a";
        break;

      case "protokoll":

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        $allowed['protokoll'] = array('list');

        // headings
        $heading = array('', 'ID', 'Zeit', 'Bearbeiter', 'Module', 'Action', 'Parameter', 'Funktion', 'Meldung', 'Men&uuml;');
        $width = array('4%', '4%', '15%', '10%', '10%', '10%', '10%', '10%', '40%', '10%', '5%');
        $findcols = array('open', 'a.id', 'a.datum', 'a.bearbeiter', 'a.module', 'a.action', 'a.parameter', 'a.funktionsname', 'a.meldung', 'a.id');
        $searchsql = array("DATE_FORMAT(a.datum,'%d.%m.%Y %H:%i:%s')", 'a.bearbeiter', 'a.module', 'a.meldung', 'a.action', 'a.parameter', 'a.funktionsname');
        $defaultorder = 2;
        $defaultorderdesc = 1;
        $menucol = 1;
        $moreinfo = true;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?%value%\" target=\"_blank\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" .

        //                                              "&nbsp;".
        
        //                                                                "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=logfile&action=delete&id=%value%\");>".

        
        //                                                               "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>".

        "</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, a.id,DATE_FORMAT(a.datum,'%d.%m.%Y %H:%i:%s'), a.bearbeiter, 
                                           a.module, a.action, a.parameter, a.funktionsname,a.meldung,CONCAT('module=',a.module,'&action=',a.action,'&id=',a.parameter) FROM protokoll a";

        //$where = "d.firma='".$this->app->User->GetFirma()."'";
        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(a.id) FROM protokoll a";
        break;
      case "logfile":
        $allowed['logfile'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('', 'ID', 'Zeit', 'Bearbeiter', 'Module', 'Action', 'Funktion', 'Meldung', 'Men&uuml;');
        $width = array('4%', '4%', '15%', '10%', '10%', '10%', '10%', '40%', '10%', '5%');
        $findcols = array('open', 'a.id', 'a.datum', 'a.bearbeiter', 'a.module', 'a.action', 'a.funktionsname', 'a.meldung', 'a.id');
        $searchsql = array("DATE_FORMAT(a.datum,'%d.%m.%Y %H:%i:%s')", 'a.bearbeiter', 'a.module', 'a.meldung', 'a.action', 'a.funktionsname');
        $defaultorder = 2;
        $defaultorderdesc = 1;
        $menucol = 1;
        $moreinfo = true;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" .

        //                                                              "<a href=\"index.php?%value%\" target=\"_blank\">".
        
        //                                                             "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>".

        
        //                                              "&nbsp;".

        "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=logfile&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, a.id,DATE_FORMAT(a.datum,'%d.%m.%Y %H:%i:%s'), a.bearbeiter, 
                                           a.module, a.action, a.funktionsname,a.meldung, a.id FROM logfile a";

        //$where = "d.firma='".$this->app->User->GetFirma()."'";
        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(a.id) FROM logfile a";
        break;
      case "adapterbox_log":
        $allowed['adapterbox'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Zeit', 'IP', 'Seriennummer', 'Meldung', 'Men&uuml;');
        $width = array('15%', '15%', '15%', '40%', '10%');
        $findcols = array('a.datum', 'a.ip', 'a.seriennummer', 'a.meldung', 'a.id');
        $searchsql = array("DATE_FORMAT(a.datum,'%d.%m.%Y %H:%i:%s')", 'a.ip', 'a.meldung', 'a.seriennummer');
        $defaultorder = 5;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" .


        "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adapterbox&action=deletelog&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, DATE_FORMAT(a.datum,'%d.%m.%Y %H:%i:%s'), a.ip, a.seriennummer, a.meldung, a.id FROM adapterbox_log a";


        $count = "SELECT COUNT(a.id) FROM adapterbox_log a";
        break;
      case "exportvorlage":
        $allowed['exportvorlage'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Name', 'Ziel', 'Men&uuml;');
        $width = array('30%', '30%', '10%');
        $findcols = array('i.bezeichnung', 'i.ziel', 'i.id');
        $searchsql = array('i.ziel', 'i.bezeichnung');

        //                              $defaultorder=2;
        
        //            $defaultorderdesc=0;

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=exportvorlage&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"index.php?module=exportvorlage&action=export&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/download.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=exportvorlage&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS i.id, i.bezeichnung, i.ziel, i.id FROM exportvorlage i ";
        $where = ""; //d.firma='".$this->app->User->GetFirma()."'";

        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM exportvorlage";
        break;
      case "importvorlage":
        $allowed['importvorlage'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Name', 'Ziel', 'Men&uuml;');
        $width = array('30%', '30%', '10%');
        $findcols = array('i.bezeichnung', 'i.ziel', 'i.id');
        $searchsql = array('i.ziel', 'i.bezeichnung');

        //                              $defaultorder=2;
        
        //            $defaultorderdesc=0;

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=importvorlage&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"index.php?module=importvorlage&action=import&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/download.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=importvorlage&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS i.id, i.bezeichnung, i.ziel, i.id FROM importvorlage i ";
        $where = ""; //d.firma='".$this->app->User->GetFirma()."'";

        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM importvorlage";
        break;
      case "textvorlagenohnefilter":
        // START EXTRA checkboxen
  



        // headings
        $heading = array('', 'Name', 'Text', 'Stichw&ouml;rter', 'Projekt', 'Men&uuml;');
        //$width = array('1%', '10%', '15%', '30%', '20%', '5%', '25%', '5%','5%');
        $width = array('1%','10%', '40', '20', '10', '5%');
        $findcols = array('t.id', 't.name', 't.text', 't.stichwoerter', 't.projekt','t.id');
        $searchsql = array('t.id', 't.name', 't.text', 't.stichwoerter', 't.projekt','t.id');

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"#\" onclick=\"EditTextvorlage(%value%)\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteTextvorlage(%value%);>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" ."&nbsp;<a href=\"#\" onclick=UebernehmeTextvorlageOhneHTML(%value%);>" . "<img title=\"Text ohne HTML übernehmen\" src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/forward.png\" border=\"0\"></a></td></tr></table>";
//"&nbsp;" ."<a href=\"#\" onclick=UebernehmeTextvorlage(%value%);>" . "<img title=\"Text mit HTML übernehmen\" src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/forward.png\" border=\"0\"></a>" .
        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS t.id, concat('<span class=\"textvorlageid\" style=\"display:none;\">',t.id,'</span>'), t.name, t.text, t.stichwoerter, t.projekt, t.id from textvorlagen t";




        $count = "SELECT COUNT(t.id) FROM textvorlagen t ";

        //$moreinfo = false;
        $menucol = 5;
      
      break;
      case "adresse_abo":
        $allowed['adresse'] = array('abo');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Bezeichnung', 'Nummer', 'abgerechnet', 'Preis','Menge','Art','Men&uuml;');
        $width = array('30%', '10%', '10%', '10%', '10%','10%','10%');
        $findcols = array('aa.bezeichnung', 'art.nummer', 'aa.abgerechnetbis', 'aa.preis','aa.menge','art', 'aa.id');
        $searchsql = array('aa.bezeichnung', 'art.nummer', "DATE_FORMAT(aa.abgerechnetbis,'%d.%m.%Y')");
        //$defaultorder = 2; // sortiert nach dem oeffnen nach spalte 2

        //$defaultorderdesc = 0; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=adresse&action=positioneneditpopup&id=%value%&frame=false&pid=$id\" class=\"popup\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=artikel&action=deleteartikel&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS aa.id,  aa.bezeichnung,art.nummer, DATE_FORMAT(aa.abgerechnetbis,'%d.%m.%Y') as abgerechnet,
      aa.preis as preis, aa.menge as menge, if(aa.wiederholend=1 OR aa.preisart='monat' OR aa.preisart='jahr','wdh','einmalig') as art, aa.id as id
        FROM abrechnungsartikel aa LEFT JOIN artikel art ON art.id=aa.artikel";
        $where = " aa.adresse='" . $id . "'";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM abrechnungsartikel WHERE adresse='$id'";
        break;



      case "pinwand_list":
        $allowed['drucker'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Name', 'Erstellt von', 'Men&uuml;');
        $width = array('30%', '30%', '10%');
        $findcols = array('p.name', 'a.name', 'p.id');
        $searchsql = array('p.name', 'a.name');
//        $defaultorder = 2; // sortiert nach dem oeffnen nach spalte 2

 //       $defaultorderdesc = 0; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=pinwand&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=pinwand&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS p.id, p.name, a.name, p.id FROM pinwand p LEFT JOIN user u ON p.user=u.id LEFT JOIN adresse a ON a.id=u.adresse";

        if ($this->app->User->GetType() != "admin") 
        {
          $where = "p.user='" . $this->app->User->GetID() . "'";
          $where = "";
          $count = "SELECT COUNT(p.id) FROM pinwand p AND ".$where;
        } else {
          $where = "";
          $count = "SELECT COUNT(p.id) FROM pinwand p ";
        }

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        
        break;



      case "artikel_eigenschaftensuche":
        $allowed['artikel'] = array('eigenschaftensuche');

        $columnfilter=true; 

        $heading = array('Artikel-Nr.', 'Karat', 'Schliff', 'Reinheit','Labor','GA-Nr.','Men&uuml;');
        $width = array('30%', '20%', '20%','10%','10%','10%', '10%');
        $findcols = array('ae.nummer', 'ae.karat', 'ae.schliff', 'ae.reinheit','ae.labor','ae.ganr','ae.id');
        $searchsql = array('ae.nummer', "FORMAT(ae.karat,2{$extended_mysql55})",'ae.schliff','ae.reinheit','ae.labor','ae.ganr');
        $searchsql_dir = array('LR', 'R','LR','LR','LR','LR'); 

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=artikel&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "&nbsp;</td></tr></table>";


        $alignright=array('2');
        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS ae.id,  ae.nummer, FORMAT(ae.karat,2{$extended_mysql55}), ae.schliff, ae.reinheit,ae.labor,ae.ganr,ae.id
                                           FROM artikel_eigenschaftensuche ae ";
        //$where = "d.firma='" . $this->app->User->GetFirma() . "'";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM artikel_eigenschaftensuche";
        break;



      case "adapterbox_list":
        $allowed['adapterbox'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('Bezeichnung', 'Seriennummer', 'Verwenden als','Status','Men&uuml;');
        $width = array('40%', '35%','15%', '5%');
        $findcols = array('a.bezeichnung', 'a.seriennummer','a.verwendenals','a.letzteverbindung', 'a.id');
        $searchsql = array('a.bezeichnung', 'a.seriennummer','a.verwendenals', 'a.id');

        $defaultorder = 1; // sortiert nach dem oeffnen nach spalte 2

        $defaultorderdesc = 0; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=adapterbox&action=endgeraet&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" ."<a href=\"index.php?module=adapterbox&action=download&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/download.png\" border=\"0\"></a>". "&nbsp;"."<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adapterbox&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, if(a.bezeichnung='','Ohne Bezeichnung',a.bezeichnung) as bezeichnung, a.seriennummer, if(a.verwendenals='' || a.verwendenals='etikettendrucker','Etikettendrucker',if(a.verwendenals='waage','Waage',if(a.verwendenals='kamera','Kamera',''))),if(TIME_TO_SEC(TIMEDIFF(NOW(),a.letzteverbindung)) > 10 OR a.letzteverbindung IS NULL,'disconnected','connected'),a.id
                                           FROM adapterbox a ";
        //$where = "d.firma='" . $this->app->User->GetFirma() . "'";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM adapterbox";
        break;

    case "adresse_brief":
        $allowed['adresse'] = array('brief');

    // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#brief').change( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#email').change( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#telefon').change( function() { fnFilterColumn3( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#notiz').change( function() { fnFilterColumn4( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#ticket').change( function() { fnFilterColumn5( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#versendete').click( function() { fnFilterColumn6( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#nichtversendete').click( function() { fnFilterColumn7( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "fnFilterColumn8( 0 );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#belege').click( function() { fnFilterColumn9( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#wiedervorlage').change( function() { fnFilterColumn10( 0 ); } );");
        for ($r = 1;$r < 11;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                function fnFilterColumn' . $r . ' ( i )
                                {
                                if(oMoreData' . $r . $name . '==1)
                                oMoreData' . $r . $name . ' = 0;
                                else
                                oMoreData' . $r . $name . ' = 1;

                                $(\'#' . $name . '\').dataTable().fnFilter( 
                                  \'A\',
                                  i, 
                                  0,0
                                  );
                                }
                                ');
        }


        $heading = array('','Datum', 'Titel', 'Bearbeiter', 'Art', 'Gesendet', '');
        $width = array('1%','15%', '40%', '20%', '10%', '10%', '10%');
        $findcols = array('a.open','a.datum', 'a.title', 'a.bearbeiter', 'a.art','a.gesendet','a.did');
        $searchsql = array('a.datum', 'a.title', 'a.bearbeiter','a.art');

        $defaultorder = 2; // sortiert nach dem oeffnen nach spalte 2
        $defaultorderdesc = 1; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)
//index.php?module=adresse&action=korreseditpopup&id=%value% popup
        $menu = '';
        $menu .= '<table width="60" cellpadding="0" cellspacing="0">';
          $menu .= '<tr>';
            $menu .= '<td align="right">';
              $menu .= '<span style="display:none">%value%</span><a href="javascript:;" class="editEintrag"><img src="themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/edit.png" border="0"></a> ';
            $menu .= '</td>';
            $menu .= '<td align="right">';
              $menu .= '<a href="javascript:;" class="deleteEintrag"><img src="themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/delete.gif" border="0"></a> ';
            $menu .= '</td>';
            //$menu .= '<td align="right">';
            //  $menu .= '<a href="javascript:;" class="previewEintrag"><img src="themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/details_open.png" border="0"> <img src="themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/details_close.png" border="0" class="close" style="display:none;"></a> ';
            //$menu .= '</td>';

          $menu .= '</tr>';
        $menu .= '</table>';
        // $menu = '<a href="javascript:;" onclick="" class="previewEintrag">OPEN</a> <a href="javascript:;" onclick="" class="editEintrag">EDIT</a>';
        #$menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=adresse&action=ansprechpartner&edit&id=$id&iframe=$iframe&lid=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=ansprechpartner&delete=1&id=$id&iframe=$iframe&lid=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . $einfuegen . "&nbsp;</td></tr></table>";


        $adresseId = $this->app->User->GetParameter('adresse_brief_adresseId');
        
        $sql = '
          SELECT
            SQL_CALC_FOUND_ROWS a.id,
            a.open,
						a.datum,
						a.title,
						a.bearbeiter,
						a.art,
						a.gesendet,
            a.did
          FROM 
          (
            (
              SELECT
                d.id,"<img src=./themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/details_open.png class=details>" as open,
                CONCAT(DATE_FORMAT(d.datum, "%Y-%m-%d"), " ", IF(d.uhrzeit IS NULL OR DATE_FORMAT(d.uhrzeit, "%H:%i")="00:00", "", DATE_FORMAT(d.uhrzeit, "%H:%i")) ) as datum,
                d.betreff as title,
                bearbeiter,
                CONCAT(UCASE(LEFT(d.typ, 1)), SUBSTRING(d.typ, 2)) as art,
                CONCAT(IF(d.sent = 1, "JA", "NEIN"),"<a data-type=dokumente data-id=", d.id, "></a>") as gesendet,
                concat("1","-",d.id) as did
              FROM
                dokumente d
              WHERE
                adresse_to = ' . $adresseId . '
            )

            UNION ALL

            (
              SELECT
                id,"<img src=./themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/details_open.png class=details>" as open,
                CONCAT(DATE_FORMAT(zeit, "%Y-%m-%d")," ", IF(DATE_FORMAT(zeit, "%H:%i")="00:00", "", DATE_FORMAT(zeit, "%H:%i"))) as datum,
                betreff as title,
                bearbeiter,
                CONCAT(UCASE(LEFT(dokument, 1)), SUBSTRING(dokument, 2)) as art,
                CONCAT(IF(versendet = 1, "JA", "NEIN"),"<a data-type=dokumente_send data-id=", id, "></a>") as gesendet,
                concat("2","-",id) as did
              FROM
                dokumente_send
              WHERE
                adresse = ' . $adresseId . '
            )';
            if($this->app->erp->RechteVorhanden('wiedervorlage','list')){
            $sql .='
            UNION ALL

            (
              SELECT
                w.id,"<img src=./themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/details_open.png class=details>" as open,
                CONCAT(DATE_FORMAT(datum_erinnerung, "%Y-%m-%d"), " ", IF(zeit_erinnerung IS NULL OR DATE_FORMAT(zeit_erinnerung, "%H:%i")="00:00", "", DATE_FORMAT(zeit_erinnerung, "%H:%i")) ) as datum,
                w.bezeichnung as title,
                adr.name as bearbeiter,
                CONCAT("Wiedervorlage") as art,
                CONCAT("<a data-type=wiedervorlage data-id=", w.id, "></a>") as gesendet,
                concat("5","-",w.id) as did
              FROM
                wiedervorlage w left join adresse adr on w.bearbeiter = adr.id
              WHERE
                w.adresse = ' . $adresseId . '
            )';
            }
            $sql .='
          ) a
        ';


        $moreinfo = true;
        $doppelteids = true;
        $moreinfoaction = 'brief';
        $menucol = 6;
   
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        $more_data3 = $this->app->Secure->GetGET("more_data3");
        $more_data4 = $this->app->Secure->GetGET("more_data4");
        $more_data5 = $this->app->Secure->GetGET("more_data5");
        $more_data6 = $this->app->Secure->GetGET("more_data6");
        $more_data7 = $this->app->Secure->GetGET("more_data7");
        $more_data9 = $this->app->Secure->GetGET("more_data9");
        $more_data10 = $this->app->Secure->GetGET("more_data10");

        if ($more_data1 == 1) {
          $subWhereConditions[] = 'art LIKE "brief%"';
        }
        if ($more_data3 == 1) {
          $subWhereConditions[] = 'art LIKE "telefon"';
        }
        if ($more_data4 == 1) {
          $subWhereConditions[] = 'art LIKE "notiz"';
        }
        if ($more_data10 == 1) {
          $subWhereConditions[] = 'art LIKE "wiedervorlage"';
        }
        if ($more_data9 == 1) {
          $subWhereConditions[] = '(art LIKE "lieferschein" OR art LIKE "angebot" OR art LIKE "auftrag" OR art LIKE "rechnung" OR art LIKE "bestellung" OR art LIKE "gutschrift")';
        }

        if ($subWhereConditions) {
          $whereConditions[] = '( ' . implode(' OR ', $subWhereConditions) . ' )';
        }

        if ($more_data6 == 1) {
          $whereConditions[] = 'gesendet LIKE "ja%"';
        }

        if ($more_data7 == 1) {
          $whereConditions[] = 'gesendet LIKE "nein%"';
        }


        if ($whereConditions) {
          $where = implode(' AND ', $whereConditions);
        }

        //$orderby = 'UNIX_TIMESTAMP(a.datum)';

        //$groupby=" GROUP BY artikel.id ";
        
        // gesamt anzahl
        $count = '
          SELECT
            SUM(anzahl)
          FROM 
          (

            (
              SELECT
                COUNT(id) as anzahl
              FROM
                dokumente
              WHERE
                adresse_to = ' . $adresseId . '
            )

            UNION ALL

            (
              SELECT
                COUNT(id) as anzahl
              FROM
                dokumente_send
              WHERE
                adresse = ' . $adresseId . '
            )';
            if($this->app->erp->RechteVorhanden('ticket','list')){
            $count .= '
            UNION ALL

            ( 
              SELECT
                COUNT(ticket.id) as anzahl
              FROM
                ticket
                LEFT JOIN ticket_nachricht ON ticket.schluessel = ticket_nachricht.ticket
              WHERE
                ticket.adresse = ' . $adresseId . '
            )';
            }

            if($this->app->erp->RechteVorhanden('wiedervorlage','list')){
              $count .= '
              UNION ALL

              (
                SELECT
                  COUNT(id) as anzahl
                FROM
                  wiedervorlage
                WHERE
                 wiedervorlage.adresse = ' . $adresseId . '

              )';
            }
            $count .= '
          ) a
        ';
        break;
      case 'stammdatenbereinigen_list':

        $allowed['stammdatenbereinigen'] = array('list');

        $this->app->Tpl->Add('JQUERYREADY', "$('#stammdatenbereinigenName').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#stammdatenbereinigenPlz').click( function() { fnFilterColumn2( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#stammdatenbereinigenEMail').click( function() { fnFilterColumn3( 0 ); } );");
        for ($r = 1;$r <= 3;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
            function fnFilterColumn' . $r . ' ( i )
            {
            if(oMoreData' . $r . $name . '==1)
            oMoreData' . $r . $name . ' = 0;
            else
            oMoreData' . $r . $name . ' = 1;

            $(\'#' . $name . '\').dataTable().fnFilter( 
              \'A\',
              i, 
              0,0
              );
            }
          ');
        }

        $heading = array('Name', 'Straße', 'Ort','PLZ', 'Land', 'Anzahl','Projekt', 'Men&uuml;');
        $width = array('20%','20%','20%', '10%', '10%', '10%','5%', '5%');
        $findcols = array('a.name','a.strasse', 'a.ort', 'a.plz', 'a.land', 'p.abkuerzung','anzahl');
        $searchsql = array('a.name','a.strasse', 'a.ort', 'a.plz', 'a.land', 'p.abkuerzung');

        $defaultorder = 0; // sortiert nach dem oeffnen nach spalte 2
        $defaultorderdesc = 1; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)

        $menu = '';
        $menu = '<table cellpadding="0" cellspacing="0" width="100%">';
          $menu .= '<tr>';
            $menu .= '<td nowrap align="right">';
              $menu .= '<a href="javascript:;" onclick="zusammenfuehren(%value%);">';
                $menu .= '<img src="themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/edit.png" border="0">';
              $menu .= '</a>';
            $menu .= '</td>';
          $menu .= '</tr>';
        $menu .= '</table>';

        $grouping = 0;
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        if ($more_data1 == 1) {
          $groupABy[] = 'a.name';
          $paramsGroupBy[] = 'name';
          $grouping++;
        }

        $more_data2 = $this->app->Secure->GetGET("more_data2");
        if ($more_data2 == 1) {
          $groupABy[] = 'a.plz';
          $paramsGroupBy[] = 'plz';
          $grouping++;
        }

        $more_data3 = $this->app->Secure->GetGET("more_data3");
        if ($more_data3 == 1) {
          $groupABy[] = 'a.email';
          $paramsGroupBy[] = 'email';
          $grouping++;
        }
/*
        if ($grouping <= 0) {
          $groupABy = array();
          $groupABy[] = 'a.name';
          $paramsGroupBy[] = 'name';
        }
*/
        $this->app->User->SetParameter('stammdatenbereinigen_list_param', $paramsGroupBy);

        if(count($groupABy)>0)
        {
          $groupby = '
            GROUP BY ' . implode(',', $groupABy) . '
            HAVING count(*) > 1
          ';

          $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name, a.strasse, a.ort, a.plz, a.land, count(*) as anzahl, p.abkuerzung, a.id
          FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt ";

        } else {
            $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name, a.strasse, a.ort, a.plz, a.land, '1' as anzahl, p.abkuerzung, a.id
            FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt ";
        }

        $where = " a.geloescht!=1";
        
        // gesamt anzahl
        $count = 'SELECT COUNT(id) FROM adresse WHERE geloescht!=1';

      break;
      case 'lagermindestmengen_list':

        $allowed['lagermindestmengen'] = array('liste');

        $heading = array('Artikel-Nr','Artikel','Projekt/Filiale','Lager','Lagerplatz','Ist', 'Soll','Fehlmenge','In Lieferung','Men&uuml;');
        $width = array('10%','20%','10%','10%','10%','5%', '5%','5%','10%','5%');
        $findcols = array('artikel.nummer','artikel.name_de', 'p.abkuerzung','lager.bezeichnung',
        'lager_platz.kurzbezeichnung', 'mengeVorhanden', 'mengeSoll', 'mengeIst','lagermindestmengen.id','lagermindestmengen.id');
        $searchsql = array('artikel.nummer','artikel.name_de', 'lager_platz.kurzbezeichnung','IF(lager_platz_inhalt.menge IS NULL, 0, lager_platz_inhalt.menge)', 'lagermindestmengen.menge',"lagermindestmengen.menge - IF(lager_platz_inhalt.menge IS NULL, 0, lager_platz_inhalt.menge)",'lager.bezeichnung','p.abkuerzung');

        $defaultorder = 1; // sortiert nach dem oeffnen nach spalte 2
        $defaultorderdesc = 1; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)

        $alignright=array(6,7,8,9);
        $menu ="";

        $sql = "
          SELECT
            SQL_CALC_FOUND_ROWS lagermindestmengen.id,
            artikel.nummer,
            artikel.name_de,
            p.abkuerzung,
            lager.bezeichnung,
            lager_platz.kurzbezeichnung,
            IF(lager_platz_inhalt.menge IS NULL, 0, lager_platz_inhalt.menge) as mengeVorhanden,
            lagermindestmengen.menge as mengeSoll,
            lagermindestmengen.menge - IF(lager_platz_inhalt.menge IS NULL, 0, lager_platz_inhalt.menge) as mengeIst,
            IFNULL((SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag 
              WHERE auf.adresse=p.filialadresse AND (auf.status='angelegt' OR auf.status='freigegeben') AND auf.projektfiliale > 0 
                AND auf.projekt=lager.projekt AND ap.artikel=artikel.id),'-'),
            lagermindestmengen.id
          FROM
            lagermindestmengen
            LEFT JOIN lager_platz_inhalt ON lager_platz_inhalt.lager_platz = lagermindestmengen.lager_platz AND lager_platz_inhalt.artikel = lagermindestmengen.artikel
            LEFT JOIN artikel ON lagermindestmengen.artikel = artikel.id
            LEFT JOIN lager_platz ON lagermindestmengen.lager_platz = lager_platz.id
            LEFT JOIN lager ON lager.id = lager_platz.lager
	    LEFT JOIN projekt p ON lager.projekt=p.id
        ";

        //$groupby = '';

        $where = " lagermindestmengen.menge > IF(lager_platz_inhalt.menge IS NULL, 0, lager_platz_inhalt.menge) AND lagermindestmengen.id > 0 AND (lager.projekt <= 0 OR (lagermindestmengen.id > 0 ".$this->app->erp->ProjektRechte()."))";
        
        // gesamt anzahl
        $count = '
          SELECT 
            COUNT(lagermindestmengen.id) 
          FROM 
            lagermindestmengen            
            LEFT JOIN lager_platz_inhalt ON lager_platz_inhalt.lager_platz = lagermindestmengen.lager_platz AND lager_platz_inhalt.artikel = lagermindestmengen.artikel            
            LEFT JOIN lager_platz ON lagermindestmengen.lager_platz = lager_platz.id
            LEFT JOIN lager ON lager.id = lager_platz.lager
	    LEFT JOIN projekt p ON lager.projekt=p.id
          WHERE 
            lagermindestmengen.menge > IF(lager_platz_inhalt.menge IS NULL, 0, lager_platz_inhalt.menge)
          AND 
            (lager.projekt <=0 OR (lagermindestmengen.id > 0 '.$this->app->erp->ProjektRechte().'))
          ';

      break;

      case 'lagermindestmengen_createlist':

        $allowed['lagermindestmengen'] = array('liste');

        $heading = array('Artikel-Nr','Artikel','Projekt', 'Lager','Lagerplatz', 'Menge', 'Men&uuml;');
        $width = array('10%','30%','10%','15%', '15%', '5%', '3%');
        $findcols = array('artikel.nummer','artikel.name_de','p.abkuerzung',  'lager.bezeichnung','lager_platz.kurzbezeichnung', 'lagermindestmengen.menge', 'lagermindestmengen.id');
        $searchsql = array('artikel.nummer','artikel.name_de', 'lager.bezeichnung','lager_platz.kurzbezeichnung', 'p.abkuerzung', 'lagermindestmengen.menge');

        $defaultorder = 1; // sortiert nach dem oeffnen nach spalte 2
        $defaultorderdesc = 1; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)

        $alignright=array(6);

        $menu = '<table cellpadding="0" cellspacing="0">';
          $menu .= '<tr>';
            $menu .= '<td nowrap>';
              $menu .= '<a href="javascript:;" onclick="lagermindestmengenEdit(%value%);">';
                $menu .= '<img src="themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/edit.png" border="0">';
              $menu .= '</a>&nbsp;';
              $menu .= '<a href="#" onclick=lagermindestmengenDelete("%value%");>';
                $menu .= '<img src="themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/delete.gif" border="0">';
              $menu .= '</a>';
            $menu .= '</td>';
          $menu .= '</tr>';
        $menu .= '</table>';


        $sql = '

          SELECT
            SQL_CALC_FOUND_ROWS lagermindestmengen.id,
            artikel.nummer,
            artikel.name_de,
            p.abkuerzung,
            if(lager.id > 0,lager.bezeichnung,"-"),
            if(lager_platz.id>0,lager_platz.kurzbezeichnung,"-"),
            lagermindestmengen.menge,
            lagermindestmengen.id
          FROM
            lagermindestmengen 
            LEFT JOIN artikel ON artikel.id = lagermindestmengen.artikel
            LEFT JOIN lager_platz ON lager_platz.id = lagermindestmengen.lager_platz
            LEFT JOIN lager ON lager.id = lager_platz.lager
            LEFT JOIN projekt p ON p.id = lager.projekt
        ';

        //$groupby = '';

	$where = "lagermindestmengen.id > 0 AND (lager.projekt <= 0 OR (lagermindestmengen.id > 0 ".$this->app->erp->ProjektRechte()."))";
        
        // gesamt anzahl
        $count = 'SELECT COUNT(lagermindestmengen.id) FROM lagermindestmengen 
                  LEFT JOIN lager_platz ON lager_platz.id = lagermindestmengen.lager_platz
                  LEFT JOIN lager ON lager.id = lager_platz.lager
                  LEFT JOIN projekt p ON p.id=lager.projekt 
	          WHERE lagermindestmengen.id > 0 AND (lager.projekt <=0 OR (lagermindestmengen.id > 0 '.$this->app->erp->ProjektRechte().'))';

      break;

      case "drucker_spooler":
        $allowed['drucker'] = array('spooler');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Zeit', 'Dateiname', 'Bearbeiter','Men&uuml;');
        $width = array('30%', '30%', '20%', '10%', '10%');
        $findcols = array('d.zeitstempel', 'd.filename', 'a.name', 'd.id');
        $searchsql = array("DATE_FORMAT(d.zeitstempel,'%d.%m.%Y %H:%i:%s')", 'd.filename', 'a.name');
//        $defaultorder = 2; // sortiert nach dem oeffnen nach spalte 2

        $defaultorderdesc = 0; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=drucker&action=spoolerdownload&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/download.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=drucker&action=spoolerdelete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS d.id, DATE_FORMAT(d.zeitstempel,'%d.%m.%Y %H:%i:%s'), if(d.filename!='',d.filename,'Kein Dateiname vorhanden'), a.name,
                                           d.id FROM drucker_spooler d LEFT JOIN user u ON u.id=d.user LEFT JOIN adresse a ON a.id=u.adresse ";
        $where = " d.drucker='$id' ";//d.firma='" . $this->app->User->GetFirma() . "'";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM drucker_spooler WHERE drucker='$id'";
        break;


      case "berichte":
        $allowed['berichte'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Name', 'Men&uuml;');
        $width = array('95%','5%');
        $findcols = array('b.name', 'b.id');
        $searchsql = array('d.name', 'd.bezeichnung', 'd.anbindung', 'd.aktiv');


        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=berichte&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"index.php?module=berichte&action=pdf&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/pdf.png\" border=\"0\"></a>" . "&nbsp;". "<a href=\"index.php?module=berichte&action=csv&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/download.png\" border=\"0\"></a>" . "&nbsp;". "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=berichte&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS b.id, b.name, b.id
                                           FROM berichte b ";
        $where = "";//d.firma='" . $this->app->User->GetFirma() . "'";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM berichte";
        break;



      case "crm_list":
        $allowed['crm'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen
        
        // headings

        $heading = array('','Name', 'Land','PLZ', 'Ort', 'Stra&szlig;e','Projekt','Men&uuml;');
        $width = array('1%','30%', '5%', '10%', '20%', '10%','10%','10%');
        $findcols = array('a.id','a.name', 'a.land', 'a.plz', 'a.ort','a.strasse','p.abkuerzung', 'a.id');
        $searchsql = array('a.name', 'a.land', 'a.plz', 'a.ort','a.strasse','p.abkuerzung');
        $defaultorder = 2; // sortiert nach dem oeffnen nach spalte 2

        $defaultorderdesc = 0; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=adresse&action=brief&cmd=crm&id=%value%\" target=\"_blank\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=crm&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open, a.name, a.land,a.plz,a.ort,a.strasse, p.abkuerzung, a.id
                                           FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt";

        $where = "a.geloescht!=1";//d.firma='" . $this->app->User->GetFirma() . "'";

        $menucol = 7;
        $moreinfo=true;

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM adresse a WHERE $where";
        break;


      case "druckerlist":
        $allowed['drucker'] = array('list');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        
        // headings

        $heading = array('Name', 'Bezeichnung', 'Anbindung', 'Aktiv', 'Men&uuml;');
        $width = array('30%', '30%', '20%', '10%', '10%');
        $findcols = array('d.name', 'd.bezeichnung', 'd.anbindung', 'd.aktiv', 'd.id');
        $searchsql = array('d.name', 'd.bezeichnung', 'd.anbindung', 'd.aktiv');
        $defaultorder = 2; // sortiert nach dem oeffnen nach spalte 2

        $defaultorderdesc = 0; // 0 = auftsteigend , 1 = absteigen (eventuell notfalls pruefen)

        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=drucker&action=edit&id=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=drucker&action=delete&id=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS d.id, d.name, d.bezeichnung, 
                                           CONCAT(d.anbindung,if(d.adapterboxseriennummer='','',' SN:'),d.adapterboxseriennummer), if(d.aktiv,'ja','nein') as aktiv, 
                                           d.id FROM drucker d ";
        $where = "";//d.firma='" . $this->app->User->GetFirma() . "'";

        //$groupby=" GROUP by z.adresse_abrechnung ";
        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM drucker";
        break;

      case "adresse_stammdatenlieferadresselist":
        $allowed['adresse'] = array('ansprechpartner');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        $id = $this->app->Secure->GetGET('id');
        $lid = $this->app->Secure->GetGET("lid");
        $iframe = $this->app->Secure->GetGET("iframe");
        
        // headings
        $heading = array('Name', 'Bereich', 'Email', 'Telefon', 'Telefax', 'Men&uuml;');
        $width = array('20%', '15%', '15%', '10%', '10%', '10%', '5%');
        $findcols = array('a.name', 'a.abteilung', 'a.strasse', 'a.plz', 'a.ort', 'a.id');
        $searchsql = array('a.name', 'a.abteilung', 'a.strasse', 'a.plz', 'a.ort');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        
        if ($iframe == "true") $einfuegen = "<a onclick=AdresseStammdatenLieferscheinIframe(\"%value%\");><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/down.png\" border=\"0\"></a>";
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . $einfuegen . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name, a.abteilung, a.strasse, a.plz, a.ort, a.id FROM adresse a ";
        $where = " a.geloescht!=1 ";

        //$orderby = "a.name,a.strasse";
        
        //$orderby = "l.name, l.strasse";

        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(a.id) FROM ansprechpartner a WHERE a.adresse='" . $id . "' AND a.name!='Neuer Datensatz'";
        break;
 
      case "adresse_ansprechpartnerlieferadresselist":
        $allowed['adresse'] = array('ansprechpartner');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        $id = $this->app->Secure->GetGET('id');
        $lid = $this->app->Secure->GetGET("lid");
        $iframe = $this->app->Secure->GetGET("iframe");
        
        if ($lid > 0) $id = $this->app->DB->Select("SELECT adresse FROM ansprechpartner WHERE id='$lid' LIMIT 1");

        // headings
        $heading = array('Name', 'Bereich', 'Email', 'Telefon', 'Telefax', 'Mobil', 'Men&uuml;');
        $width = array('20%', '15%', '15%', '10%', '10%', '10%', '10%', '5%');
        $findcols = array('a.name', 'a.bereich', 'a.email', 'a.telefon', 'a.telefax', 'a.mobil', 'a.id');
        $searchsql = array('a.name', 'a.bereich', 'a.email', 'a.telefon', 'a.telefax', 'a.mobil');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        
        if ($iframe == "true") $einfuegen = "<a onclick=AnsprechpartnerLieferscheinIframe(\"%value%\");><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/down.png\" border=\"0\"></a>";
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=adresse&action=ansprechpartner&edit&id=$id&iframe=$iframe&lid=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=ansprechpartner&delete=1&id=$id&iframe=$iframe&lid=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . $einfuegen . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name, a.bereich, a.email, a.telefon, a.telefax, a.mobil, a.id FROM ansprechpartner a ";
        $where = "a.adresse='" . $id . "' AND a.name!='Neuer Datensatz' ";

        //$orderby = "a.name,a.strasse";
        
        //$orderby = "l.name, l.strasse";

        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(a.id) FROM ansprechpartner a WHERE a.adresse='" . $id . "' AND a.name!='Neuer Datensatz'";
        break;
  
      case "adresse_accounts":
        $allowed['adresse'] = array('accounts');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        $id = $this->app->Secure->GetGET('id');
        $lid = $this->app->Secure->GetGET("lid");
        $iframe = $this->app->Secure->GetGET("iframe");
        
        if ($lid > 0) $id = $this->app->DB->Select("SELECT adresse FROM adresse_accounts WHERE id='$lid' LIMIT 1");

        // headings
        $heading = array('Bezeichnung', 'Art', 'Benutzer', 'Aktiv', 'Men&uuml;');
        $width = array('20%', '15%', '15%', '10%', '10%', '5%');
        $findcols = array('a.bezeichnung', 'a.art', 'a.benutzer', 'a.aktiv', 'a.id');
        $searchsql = array('a.bezeichnung', 'a.art', 'a.benutzer', 'a.aktiv');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        
        if ($iframe == "true") $einfuegen = "<a onclick=AnsprechpartnerIframe(\"%value%\");><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/down.png\" border=\"0\"></a>";
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=adresse&action=accounts&edit&id=$id&iframe=$iframe&lid=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=accounts&delete=1&id=$id&iframe=$iframe&lid=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . $einfuegen . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.bezeichnung, a.art, a.benutzername, if(a.aktiv,'Ja','Nein'), a.id FROM adresse_accounts a ";
        $where = "a.adresse='" . $id . "' AND a.bezeichnung!='Neuer Datensatz' ";

        // gesamt anzahl
        $count = "SELECT COUNT(a.id) FROM adresse_accounts a WHERE a.adresse='" . $id . "' AND a.bezeichnung!='Neuer Datensatz'";
        break;

      case "adresse_ansprechpartnerlist":
        $allowed['adresse'] = array('ansprechpartner');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        $id = $this->app->Secure->GetGET('id');
        $lid = $this->app->Secure->GetGET("lid");
        $iframe = $this->app->Secure->GetGET("iframe");
        
        if ($lid > 0) $id = $this->app->DB->Select("SELECT adresse FROM ansprechpartner WHERE id='$lid' LIMIT 1");

        // headings
        $heading = array('Name', 'Bereich', 'Email', 'Telefon', 'Telefax', 'Mobil', 'Men&uuml;');
        $width = array('20%', '15%', '15%', '10%', '10%', '10%', '10%', '5%');
        $findcols = array('a.name', 'a.bereich', 'a.email', 'a.telefon', 'a.telefax', 'a.mobil', 'a.id');
        $searchsql = array('a.name', 'a.bereich', 'a.email', 'a.telefon', 'a.telefax', 'a.mobil');
        $defaultorder = 1;
        $defaultorderdesc = 0;
        
        if ($iframe == "true") $einfuegen = "<a onclick=AnsprechpartnerIframe(\"%value%\");><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/down.png\" border=\"0\"></a>";
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=adresse&action=ansprechpartner&edit&id=$id&iframe=$iframe&lid=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=ansprechpartner&delete=1&id=$id&iframe=$iframe&lid=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . $einfuegen . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, a.name, a.bereich, a.email, a.telefon, a.telefax, a.mobil, a.id FROM ansprechpartner a ";
        $where = "a.adresse='" . $id . "' AND a.name!='Neuer Datensatz' ";

        //$orderby = "a.name,a.strasse";
        
        //$orderby = "l.name, l.strasse";

        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(a.id) FROM ansprechpartner a WHERE a.adresse='" . $id . "' AND a.name!='Neuer Datensatz'";
        break;
      case "adresse_lieferadressenlist":
        $allowed['adresse'] = array('lieferadresse');

        // START EXTRA checkboxen
        
        // ENDE EXTRA checkboxen

        $id = $this->app->Secure->GetGET("id");
        $iframe = $this->app->Secure->GetGET("iframe");
        $lid = $this->app->Secure->GetGET("lid");
        
        if ($lid > 0) $id = $this->app->DB->Select("SELECT adresse FROM lieferadressen WHERE id='$lid' LIMIT 1");

        // headings
        $heading = array('Name', 'Strasse', 'Land', 'PLZ', 'Ort', 'Telefon','Email', 'Men&uuml;');
        $width = array('15%', '15%', '1%', '1%', '5%','10%', '15%', '1%');
        $findcols = array('l.name', 'l.strasse', 'l.land', 'l.plz', 'l.ort','l.telefon', 'l.email', 'l.id');
        $searchsql = array('l.name', 'l.strasse', 'l.land', 'l.plz', 'l.ort','l.telefon', 'l.email');
        $defaultorder = 1;
        $defaultorderdesc = 0;

        //                              $id = $this->app->Secure->GetGET("sid");
        
        if ($iframe == "true") $einfuegen = "<a onclick=LieferadresseIframe(\"%value%\");><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/down.png\" border=\"0\"></a>";
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap>" . "<a href=\"index.php?module=adresse&action=lieferadresse&edit&id=$id&iframe=$iframe&lid=%value%\">" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;" . "<a href=\"#\" onclick=DeleteDialog(\"index.php?module=adresse&action=lieferadresse&delete=1&id=$id&iframe=$iframe&lid=%value%\");>" . "<img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . $einfuegen . "&nbsp;</td></tr></table>";

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS l.id, if(l.standardlieferadresse,CONCAT('<strong>',l.name,' (Standardlieferadresse)</strong>'),l.name) as name2, l.strasse, 
                                           l.land, l.plz, l.ort, l.telefon,l.email, l.id FROM lieferadressen l ";
        $where = " l.adresse='" . $id . "' AND l.name!='Neuer Datensatz' ";

        //$orderby = "l.name, l.strasse";
        
        //$groupby=" GROUP by z.adresse_abrechnung ";

        
        // gesamt anzahl

        $count = "SELECT COUNT(id) FROM lieferadressen";
        break;
      case "zeiterfassungkundenoffen":
        $allowed['zeiterfassung'] = array('list');

        // nach kunden sortiert
        
        // START EXTRA checkboxen

        
        //$this->app->Tpl->Add('JQUERYREADY',"$('#offen').click( function() { fnFilterColumn1( 0 ); } );");

        
        //$this->app->Tpl->Add('JQUERYREADY',"$('#kunden').click( function() { fnFilterColumn2( 0 ); } );");

        
        /*

                                            for($r=1;$r<3;$r++)
                                            {
                                            $this->app->Tpl->Add('JAVASCRIPT','
                                            function fnFilterColumn'.$r.' ( i )
                                            {
                                            if(oMoreData'.$r.$name.'==1)
                                            oMoreData'.$r.$name.' = 0;
                                            else
                                            oMoreData'.$r.$name.' = 1;
        
                                            $(\'#'.$name.'\').dataTable().fnFilter( 
                                            \'A\',
                                            i, 
                                            0,0
                                            );
                                            }
                                            ');
                                            }
        */

        // ENDE EXTRA checkboxen
        
        // headings

        
        //$heading =  array('','A','Datum','Von','Bis','Dauer','Mitarbeiter','Aufabe','Projekt','Men&uuml;');

        $heading = array('Kunde', 'Kundennr', 'Offen Abr.', 'Offen ohne Abr.','Men&uuml;');
        $alignright = array(3,4);

        //$width   =  array('1%','1%','1%','1%','1%','5%','20%','40%','10%','1%');
        $width = array('10%', '5%', '15%', '15%','1%');

        //$findcols = array('open','Auswahl','z.von','von','bis','Dauer','Mitarbeiter','id');
        $findcols = array('a.name', 'a.kundennummer', "(SELECT SUM(TIME_TO_SEC(TIMEDIFF(z2.bis, z2.von))) FROM zeiterfassung z2 WHERE z2.adresse_abrechnung=a.id AND z2.abrechnen=1 AND z2.abgerechnet!=1)","(SELECT SUM(TIME_TO_SEC(TIMEDIFF(z2.bis, z2.von))) FROM zeiterfassung z2 WHERE z2.adresse_abrechnung=a.id AND z2.abrechnen!=1 AND z2.abgerechnet!=1)", 'z.id');
        $searchsql = array('a.name');
        $defaultorder = 4;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=adresse&action=abrechnungzeit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        //CONCAT(CASE WHEN FLOOR(SUM(FORMAT(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600,2)))>0 THEN CONCAT(LPAD(FLOOR(SUM(FORMAT(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600,2))),2,'0'),':') ELSE '00:' END,LPAD(60*(SUM(FORMAT(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600,2))-FLOOR(SUM(FORMAT(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600,2)))),2,'0')) as offen,
        
        //CONCAT('<input type=\"checkbox\">') as auswahl,

        
        //$menucol=9;

        
        //            $menucol=8;

        
        // SQL statement

        $sql = "SELECT 'leer',
                                           a.name,a.kundennummer,
         (SELECT FORMAT(SUM(TIME_TO_SEC(TIMEDIFF(z2.bis, z2.von)))/3600,2) FROM zeiterfassung z2 WHERE z2.adresse_abrechnung=a.id AND z2.abrechnen=1 AND z2.abgerechnet!=1) as offen,                                
         (SELECT FORMAT(SUM(TIME_TO_SEC(TIMEDIFF(z2.bis, z2.von)))/3600,2) FROM zeiterfassung z2 WHERE z2.adresse_abrechnung=a.id AND z2.abrechnen!=1 AND z2.abgerechnet!=1) as offen2,                                
                                           a.id
                                             FROM zeiterfassung z LEFT JOIN adresse a ON a.id=z.adresse_abrechnung ";

        //SELECT SQL_CALC_FOUND_ROWS z.id, a.name,a.kundennummer, FORMAT(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600,2) as offen FROM zeiterfassung z  LEFT JOIN adresse a ON a.id=z.adresse_abrechnung WHERE z.abrechnen=1 AND z.ist_abgrechnet!=1 GROUP by z.adresse_abrechnung
        
        // Fester filter

        
        // START EXTRA more

        
        /*

                                            $more_data1 = $this->app->Secure->GetGET("more_data1"); if($more_data1==1) $subwhere[] = " z.abrechnen='1' AND z.abgerechnet!='1' ";
        
                                            for($j=0;$j<count($subwhere);$j++)
                                            $tmp .=  " AND ".$subwhere[$j];
        */

        //              $where = " z.id!='' $tmp ";
        $where = " z.abgerechnet!=1 AND a.id > 0 ";
        $groupby = " GROUP by z.adresse_abrechnung ";

        // gesamt anzahl
        $count = "SELECT COUNT(distinct z.adresse_abrechnung) FROM zeiterfassung z WHERE z.abgerechnet!=1 AND z.adresse_abrechnung > 0 ";

        //                    $moreinfo = true;
        break;
      case "zeiterfassung":
        $allowed['zeiterfassung'] = array('list');

        // START EXTRA checkboxen
        $this->app->Tpl->Add('JQUERYREADY', "$('#offen').click( function() { fnFilterColumn1( 0 ); } );");
        for ($r = 1;$r < 2;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
                                               function fnFilterColumn' . $r . ' ( i )
                                               {
                                               if(oMoreData' . $r . $name . '==1)
                                               oMoreData' . $r . $name . ' = 0;
                                               else
                                               oMoreData' . $r . $name . ' = 1;

                                               $(\'#' . $name . '\').dataTable().fnFilter( 
                                                 \'A\',
                                                 i, 
                                                 0,0
                                                 );
                                               }
                                               ');
        }

        // ENDE EXTRA checkboxen
        
        // headings

        
        //$heading =  array('','A','Datum','Von','Bis','Dauer','Mitarbeiter','Aufabe','Projekt','Men&uuml;');

        $heading = array('', 'Datum', 'Von', 'Bis', 'Dauer', 'Mitarbeiter', 'Aufgabe', 'Abr.','Projekt', 'Men&uuml;');

        //$width   =  array('1%','1%','1%','1%','1%','5%','20%','40%','10%','1%');
        $width = array('1%', '1%', '1%', '1%', '5%', '20%', '40%','5%','5%', '1%');

        //$findcols = array('open','Auswahl','z.von','von','bis','Dauer','Mitarbeiter','id');
        $findcols = array('open', "z.von", 'z.von', 'z.bis', 'Dauer', 'Mitarbeiter', 'Taetigkeit', 'z.abrechnen','p.abkuerzung', 'z.id');
        $searchsql = array('z.id', 'z.bis', 'z.aufgabe', 'a.name', "DATE_FORMAT(z.bis, GET_FORMAT(DATE,'EUR'))");
        $defaultorder = 2;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=zeiterfassung&action=create&id=%value%&back=zeiterfassung\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;<a href=\"#\" onclick=DeleteDialog(\"index.php?module=zeiterfassung&action=list&do=stornieren&lid=%value%&back=zeiterfassung\");><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        //CONCAT('<input type=\"checkbox\">') as auswahl,
        
        //$menucol=9;

        $menucol = 9;

        // SQL statement
        $sql = "SELECT SQL_CALC_FOUND_ROWS z.id,
                                           '<img src=./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/details_open.png class=details>' as open,

                                           CONCAT('<!--',DATE_FORMAT(z.von,'%Y%m%d'),'-->',DATE_FORMAT(z.bis, GET_FORMAT(DATE,'EUR'))) AS Datum, 
                                           DATE_FORMAT(z.von,'%H:%i') as von, DATE_FORMAT(z.bis,'%H:%i') as bis,
                                           CONCAT(LPAD(HOUR(TIMEDIFF(z.bis, z.von)),2,'0'),':',LPAD(MINUTE(TIMEDIFF(z.bis, z.von)),2,'0')) AS Dauer,

                                           a.name as Mitarbeiter,
                                           if(z.adresse_abrechnung!=0,CONCAT('<i style=color:#999>Kunde: ',b.name,' (',b.kundennummer,')</i><br>',z.aufgabe),z.aufgabe) as Taetigkeit,
                                            if(z.abrechnen > 0,'(A)',''),
                                             p.abkuerzung,
                                               z.id

                                                 FROM zeiterfassung z 
                                                 LEFT JOIN adresse a ON a.id=z.adresse 
                                                 LEFT JOIN adresse b ON b.id=z.adresse_abrechnung
                                                 LEFT JOIN projekt p ON p.id=z.projekt 
                                                 LEFT JOIN arbeitspaket ap ON z.arbeitspaket=ap.id";

        // Fester filter
        
        // START EXTRA more

        $more_data1 = $this->app->Secure->GetGET("more_data1");
        if ($more_data1 == 1) $subwhere[] = " z.abrechnen='1' AND z.abgerechnet!='1' ";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " z.id!='' $tmp";

        // gesamt anzahl
        $count = "SELECT COUNT(z.id) FROM zeiterfassung z";
        $moreinfo = true;
        break;
      case "rechnungslaufabo":
        $allowed['rechnungslauf'] = array('abos');
        $columnfilter=true;

        $heading = array('Kunde', 'Kundennr','Bezeichnung','Nummer','Abgerechnet bis', 'Preis', 'Menge','Art','Zahlperiode','Dokument','Men&uuml;');
        $alignright = array(5,6);

        
        $width = array('10%', '5%', '15%','5%','5%','5%','5%','5%','5%', '5%','5%');

        //$findcols = array('open','Auswahl','z.von','von','bis','Dauer','Mitarbeiter','id');
        $findcols = array('a.name', 'a.kundennummer','ab.bezeichnung','ab.nummer', 'ab.abgerechnetbis' ,'ab.preis','ab.menge','ab.preisart','ab.zahlzyklus','ab.dokument', 'a.id');
        $searchsql = array('a.name', 'a.kundennummer','ab.bezeichnung','ab.nummer', 'ab.abgerechnetbis' ,'ab.preis','ab.menge','ab.preisart','ab.zahlzyklus','ab.dokument');
        $menucol = 10;
        $defaultorder = 4;
        $defaultorderdesc = 1;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=adresse&action=artikel&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>" . "&nbsp;</td></tr></table>";

        $sql = "SELECT SQL_CALC_FOUND_ROWS ab.id, a.name, a.kundennummer,ab.bezeichnung,ab.nummer, ab.abgerechnetbis, ab.preis, ab.menge,ab.preisart, ab.zahlzyklus, ab.dokument, a.id
                FROM abrechnungsartikel ab left join adresse a on ab.adresse = a.id

        ";
        
        $where = " ab.id > 0 ";
        //$groupby = " GROUP by z.adresse_abrechnung ";

        // gesamt anzahl
        $count = "SELECT COUNT(ab.id) FROM abrechnungsartikel ab ";

      break;
      case "serienbriefe":
        $allowed['serienbrief'] = array('list');
        //$columnfilter=true;
        //$this->app->Tpl->Add('JQUERYREADY', "$('#marketingsp').click( function() { fnFilterColumn1( 0 ); } );");
        $this->app->Tpl->Add('JQUERYREADY', "$('#auchohneauswahl').click( function() { fnFilterColumn2( 0 ); } );");

        for ($r = 2;$r <= 2;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
          function fnFilterColumn' . $r . ' ( i )
          {
          if(oMoreData' . $r . $name . '==1)
          oMoreData' . $r . $name . ' = 0;
          else
          oMoreData' . $r . $name . ' = 1;

          $(\'#' . $name . '\').dataTable().fnFilter( 
          \'A\',
          i, 
          0,0
          );
          }
          ');
        }
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        $more_data2 = $this->app->Secure->GetGET("more_data2");
        //$where = " 1 ";
        //if ($more_data1 != 1) $where .= " and a.marketingsperre = 0 ";
        //if($more_data2 == 1)$where .= " and a.serienbrief = 1 ";
        
        //if ($more_data1 != 1) $subwhere[] = " a.marketingsperre = 0 ";
        if($more_data2 == 1)$subwhere[] = "  a.serienbrief = 1 ";
        for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        $where = " a.id != '' $tmp";
        
        
        //for ($j = 0;$j < count($subwhere);$j++) $tmp.= " AND " . $subwhere[$j];
        //$where = " z.id!='' $tmp";
        
        $heading = array('','Kundennummer','Name','Land','PLZ','Ort','Marketingsperre','');
        $width = array('1%','15%','15%','5%','5%','10%','5%','1%');
        $findcols = array('a.id','a.kundennummer','a.name','a.land','a.plz','a.ort','a.marketingsperre','a.id');
        $searchsql = array('a.kundennummer','a.name','a.land','a.plz','a.ort');
        $menucol = 7;
        $defaultorder = 0;
        $defaultorderdesc = 1;
        $sql = "SELECT SQL_CALC_FOUND_ROWS a.id, concat('<input type=\"checkbox\" value=\"1\" id=\"serienbrief_',a.id,'\" onclick=\"chserienbrief(',a.id,')\"',if(a.serienbrief,' checked=\"checked\" ',''),' /> ') as cb, 
        a.kundennummer,
        a.name, 
        a.land, 
        a.plz,
        a.ort, IF(a.marketingsperre = '1','ja','nein') as marketingsperre,a.id
          from adresse a
        ";
        $count = "SELECT count(*) from adresse a";
        
      break;
      case "artikel_zertifikate":
        $allowed['artikel'] = array('zertifikate');
        $id = (int)$this->app->Secure->GetGET("id");
        
        $heading = array('Datum','Kunden-Nr','Kunde','Artikelnummer','Artikel','Men&uuml;');
        $width = array('5%','8%','8%','8%','15%','1%');
        $alignright = array(7);
        $findcols = array('z.erstellt_datum','a.kundennummer','a.name','ar.nummer','ar.name_de','z.id');
        $searchsql = array('z.erstellt_datum','a.kundennummer','a.name','ar.nummer','ar.name_de','z.id');
        $menucol = 5;
        $menu = "<table cellpadding=0 cellspacing=0><tr><td nowrap><a href=\"index.php?module=zertifikatgenerator&action=edit&id=%value%\"><img src=\"themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a></td></tr></table>";
        $defaultorder = 0;
        $defaultorderdesc = 1;
        $sql = "SELECT SQL_CALC_FOUND_ROWS z.id, 
        date_format(z.erstellt_datum,'%d.%m.%Y'),
        
        a.kundennummer,
        a.name,
        ar.nummer, 
        ar.name_de,
        z.id
          from zertifikatgenerator z
          inner join artikel ar on ar.id = z.artikel
          left join adresse a on z.adresse_kunde = a.id
        ";
        $where = "z.artikel = '$id'";
        $count = "SELECT count(z.id) from zertifikatgenerator z where z.artikel = '$id'";
      break;
      case "artikel_fremdnummern":
        $allowed['artikel'] = array('fremdnummern');
        $id = (int)$this->app->Secure->GetGET("id");
        
        $this->app->Tpl->Add('JQUERYREADY', "$('#inaktiv').click( function() { fnFilterColumn1( 0 ); } );");

        for ($r = 1;$r <= 1;$r++) {
          $this->app->Tpl->Add('JAVASCRIPT', '
          function fnFilterColumn' . $r . ' ( i )
          {
          if(oMoreData' . $r . $name . '==1)
          oMoreData' . $r . $name . ' = 0;
          else
          oMoreData' . $r . $name . ' = 1;

          $(\'#' . $name . '\').dataTable().fnFilter( 
          \'A\',
          i, 
          0,0
          );
          }
          ');
        }
        $more_data1 = $this->app->Secure->GetGET("more_data1");
        
        
        $heading = array('Aktiv','Bezeichnung','Fremdnummer','Shop','');
        $width = array('1%','20%','20%','15%','1%');
        $findcols = array('af.aktiv','af.bezeichnung','af.nummer','s.bezeichnung','af.id');
        $searchsql = array('af.bezeichnung','af.nummer','s.bezeichnung');
        $defaultorder = 0;
        $defaultorderdesc = 1;
        $sql = "SELECT SQL_CALC_FOUND_ROWS af.id, if(af.aktiv = 1,'ja','nein') as aktiv,
        af.bezeichnung,
        af.nummer,
        s.bezeichnung,af.id
          from artikelnummer_fremdnummern af
          left join shopexport s on af.shopid = s.id
        ";
        $where = "af.artikel = '$id' AND af.aktiv = 1";
        if($more_data1 == 1)$where = "af.artikel = '$id'";
        $count = "SELECT count(af.id) from artikelnummer_fremdnummern af
          left join shopexport s on af.shopid = s.id where $where";
      break;
      
      
      default:
        if($frommodule && $fromclass)
        {
          
          if(!class_exists($fromclass))
          {
            
            if(file_exists(dirname(__FILE__).'/../../www/pages/'.$frommodule))
            {
                           
              include_once(dirname(__FILE__).'/../../www/pages/'.$frommodule);

            }
            
          }
          if(class_exists($fromclass) && method_exists($fromclass, 'Tablesearch'))
          {
            $erlaubtevars = array('doppelteids','heading','width','sql','count','findcols','searchsql','defaultorder','defaultorderdesc','menu','menucol','where','groupby','allowed','moreinfo','moreinfoaction','sumcol');
            $erg = $fromclass::TableSearch($this->app, $name, $erlaubtevars);
            if($erg && is_array($erg))
            {
              foreach($erlaubtevars as $k => $v)
              {
                if(isset($erg[$v]))$$v = $erg[$v];
              }
            }
          }
          
        }
      
      
        break;
      }
      
      if ($callback == "show") {
        $this->app->Tpl->Add('ADDITIONALCSS', "

        .ex_highlight #$name tbody tr.even:hover, #example tbody tr.even td.highlighted {
        background-color: [TPLFIRMENFARBEHELL]; 
        }

        .ex_highlight_row #$name tr.even:hover {
        background-color: [TPLFIRMENFARBEHELL];
        }

        .ex_highlight_row #$name tr.even:hover td.sorting_1 {
        background-color: [TPLFIRMENFARBEHELL];
        }

        .ex_highlight_row #$name tr.odd:hover {
        background-color: [TPLFIRMENFARBEHELL];
        }

        .ex_highlight_row #$name tr.odd:hover td.sorting_1 {
        background-color: [TPLFIRMENFARBEHELL];
        }
        ");

        //"sPaginationType": "full_numbers",
        
        //"aLengthMenu": [[10, 25, 50, 10000], [10, 25, 50, "All"]],

        $this->app->Tpl->Add('JAVASCRIPT', " var oTable" . $name . "; var oMoreData1" . $name . "=0; var oMoreData2" . $name . "=0; var oMoreData3" . $name . "=0; var oMoreData4" . $name . "=0; var oMoreData5" . $name . "=0;  var oMoreData6" . $name . "=0; var oMoreData7" . $name . "=0; var oMoreData8" . $name . "=0; var oMoreData9" . $name . "=0; var oMoreData10" . $name . "=0; var oMoreData11" . $name . "=0; var oMoreData12" . $name . "=0; var oMoreData13" . $name . "=0; var aData;");
        $smodule = $this->app->Secure->GetGET("cmd");
        $sid = $this->app->Secure->GetGET("sid");
        
        if ($this->app->Secure->GetGET("module") == "artikel") {
          $sort = '"aaSorting": [[ 0, "desc" ]],';
        } else {
          $sort = '"aaSorting": [[ 1, "desc" ]],';
        }
        if(isset($alignright))
        {
          for ($aligni = 0;$aligni < count($alignright);$aligni++) {
            $this->app->Tpl->Add('YUICSS', '
  #' . $name . ' td:nth-child(' . $alignright[$aligni] . ') {
                    text-align: right;
                    }
                    ');
          }
        }
        $this->app->Tpl->Add('YUICSS', '
                /*
                 * Row highlighting example
                 */
                .ex_highlight #' . $name . ' tbody tr.even:hover, #' . $name . ' tbody tr.even td.highlighted {
                background-color: [TPLFIRMENFARBEHELL];
                }
                .ex_highlight #' . $name . ' tbody tr.odd:hover, #' . $name . ' tbody tr.odd td.highlighted {
                background-color: [TPLFIRMENFARBEHELL];
                }
                .ex_highlight_row #' . $name . ' tr.even:hover {
                background-color: [TPLFIRMENFARBEHELL];
                }
                .ex_highlight_row #' . $name . ' tr.even:hover td.sorting_1 {
                background-color: [TPLFIRMENFARBEHELL];
                }
                .ex_highlight_row #' . $name . ' tr.even:hover td.sorting_2 {
                background-color: [TPLFIRMENFARBEHELL];
                }
                .ex_highlight_row #' . $name . ' tr.even:hover td.sorting_3 {
                background-color: [TPLFIRMENFARBEHELL];
                }
                .ex_highlight_row #' . $name . ' tr.odd:hover {
                  background-color: [TPLFIRMENFARBEHELL];
                }
                .ex_highlight_row #' . $name . ' tr.odd:hover td.sorting_1 {
                  background-color: [TPLFIRMENFARBEHELL];
                }
                .ex_highlight_row #' . $name . ' tr.odd:hover td.sorting_2 {
                  background-color: #E0FF84;
                }
                .ex_highlight_row #' . $name . ' tr.odd:hover td.sorting_3 {
                  background-color: #DBFF70;
                }
                ');
        
        if ($name == "artikeltabelle") {

          //$js="alert($(nTds[0]).text()); //window.location.href='index.php?module=artikel&action=edit&nummer='+$(nTds[0]).text();";
          
        } else $js = "";
        $anzahl_datensaetze = $this->app->erp->Firmendaten("standard_datensaetze_datatables");
        
        if ($anzahl_datensaetze != 0 && $anzahl_datensaetze != "10" && $anzahl_datensaetze != "25" && $anzahl_datensaetze != "50" && $anzahl_datensaetze != "200" && $anzahl_datensaetze != "1000" && $anzahl_datensaetze != "") $extra_anzahl_datensaetze = $anzahl_datensaetze . ",";
        else {
          
          if ($anzahl_datensaetze > 0) {

            //$extra_anzahl_datensaetze=$anzahl_datensaetze.",";
            
          } else {
            $extra_anzahl_datensaetze = "";
            $anzahl_datensaetze = "10";
          }
        }
        
        if (isset($sumcol) && $sumcol >= 1) {
          $sumcol = $sumcol - 1;
          $footercallback = '"footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;

                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                      return typeof i === \'string\' ?
                        i.replace(/[\$,.]/g, \'\')*1 :
                        typeof i === \'number\' ?
                        i : 0;
                    };

                    // Total over all pages
                    data = api.column( ' . $sumcol . ' ).data();
                    total = data.length ?
                      data.reduce( function (a, b) {
                          return intVal(a) + intVal(b);
                          } ) :
                        0;

                        // Total over this page
                        data = api.column( ' . $sumcol . ', { page: \'current\'} ).data();
                        pageTotal = data.length ?
                          data.reduce( function (a, b) {
                              return intVal(a) + intVal(b);
                              } ) :
                            0;

                            //                                      if(typeof pageTotal === \'int\')
                            if(data.length > 1)
                            {
                              pageTotal = pageTotal / 100.0;  
                              text = pageTotal.toString();

                              var parts = text.toString().split(".");
                              parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                              showTotal =  parts.join(",");
                            }
                            else if(data.length > 0) { 
                              pageTotal = pageTotal.replace(/,/, "A");
                              pageTotal = pageTotal.replace(/A/, "\,");
                              showTotal = pageTotal;
                            }
                            else showTotal = 0;

                            $( api.column( ' . $sumcol . ' ).footer() ).html(
                                \'<font color=red>&Sigma;&nbsp;\' + showTotal + \'</font>\' 
                                );
                  },
                    ';
        }
        
        if ($name == "versandoffene") {
          $bStateSave = "false";
          $cookietime = 0;
        } else {
          $cookietime = 10 * 60;
          $bStateSave = "true";
        }
        $iframe = $this->app->Secure->GetGET("iframe");
if($this->app->erp->Firmendaten("datatables_export_button_flash")=="1")
{
        $tabletools = '
                      "dom": \'lfrtip<"clear spacer">T\',
                      "tableTools": {
                      "aButtons": [
                      "copy",
                      "csv",
                      {
                      "sExtends": "pdf",
                      "sPdfOrientation": "landscape",
                      "sPdfMessage": datetime
                      }

                      ],
                      "sSwfPath": "./plugins/datatables/copy_csv_xls_pdf.swf"
                      },';
}

        $this->app->Tpl->Add('DATATABLES', '
                    var currentdate = new Date();
                    var datetime = "Stand: " + currentdate.getDay() + "."+currentdate.getMonth() 
                    + "." + currentdate.getFullYear() + " um " 
                    + currentdate.getHours() + ":" 
                    + currentdate.getMinutes() + ":" + currentdate.getSeconds() + " von ' . $this->app->User->GetName() . '";

                     oTable' . $name . ' = $(\'#' . $name . '\').dataTable( {
                      "bAutoWidth": false,
                      "bProcessing": true,
                      "iCookieDuration": ' . $cookietime . ', //60*60*24,// 1 day (in seconds)
                      "aLengthMenu": [[' . (isset($extra_anzahl_datensaetze)?$extra_anzahl_datensaetze:'') . '10, 25, 50,200,1000], [' . (isset($extra_anzahl_datensaetze)?$extra_anzahl_datensaetze:'') . '10, 25, 50, 200,1000]],
                      "iDisplayLength": ' . $anzahl_datensaetze . ',
                      "bStateSave": ' . $bStateSave . ',
                      ' . $sort . '
                      "bServerSide": true,
                      '.$tabletools.'

                      "fnInitComplete": function (){
                        $(oTable' . $name . '.fnGetNodes()).click(function (){
                            var nTds = $(\'td\', this);
                            ' . $js . ' //alert($(nTds[1]).text());// my js window....
                            });},
                      ' . (isset($footercallback)?$footercallback:'') . '

                        "fnServerData": function ( sSource, aoData, fnCallback ) {
                          /* Add some extra data to the sender */
                          aoData.push( { "name": "more_data1", "value": oMoreData1' . $name . ' } );
                          aoData.push( { "name": "more_data2", "value": oMoreData2' . $name . ' } );
                          aoData.push( { "name": "more_data3", "value": oMoreData3' . $name . ' } );
                          aoData.push( { "name": "more_data4", "value": oMoreData4' . $name . ' } );
                          aoData.push( { "name": "more_data5", "value": oMoreData5' . $name . ' } );
                          aoData.push( { "name": "more_data6", "value": oMoreData6' . $name . ' } );
                          aoData.push( { "name": "more_data7", "value": oMoreData7' . $name . ' } );
                          aoData.push( { "name": "more_data8", "value": oMoreData8' . $name . ' } );
                          aoData.push( { "name": "more_data9", "value": oMoreData9' . $name . ' } );
                          aoData.push( { "name": "more_data10", "value": oMoreData10' . $name . ' } );
                          aoData.push( { "name": "more_data11", "value": oMoreData11' . $name . ' } );
                          aoData.push( { "name": "more_data12", "value": oMoreData12' . $name . ' } );
                          aoData.push( { "name": "more_data13", "value": oMoreData13' . $name . ' } );
                          $.getJSON( sSource, aoData, function (json) { 
                              /* Do whatever additional processing you want on the callback, then tell DataTables */
                              fnCallback(json)
                              } );
                        },

                      "sAjaxSource": "./index.php?module=ajax&action=table&smodule=' . $smodule . '&cmd=' . $name . '&id=' . $id . '&iframe=' . $iframe . '&sid=' . $sid.($frommodule&&$fromclass?'&frommodule='.$frommodule.'&fromclass='.$fromclass:'').'"
                    } );
                    ');

        if(isset($columnfilter) && $columnfilter)
          $this->app->Tpl->Add('DATATABLES', '$(\'#'.$name.'\').dataTable().columnFilter();');
        
        if (isset($moreinfo) && $moreinfo) {

          #auftraege > tbody:nth-child(2) > tr:nth-child(1) > td:nth-child(1) > img:nth-child(1)
          $this->app->Tpl->Add('DATATABLES', '
                          $(\'#' . $name . ' tbody td img.details\').live( \'click\', function () {
                            var nTr = this.parentNode.parentNode;
                            aData =  oTable' . $name . '.fnGetData( nTr );

                            if ( this.src.match(\'details_close\') )
                            {
                            /* This row is already open - close it */
                            this.src = "./themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/details_open.png";
                            oTable' . $name . '.fnClose( nTr );
                            }
                            else
                            {
                            /* Open this row */
                            this.src = "./themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/details_close.png";
                            oTable' . $name . '.fnOpen( nTr, ' . $name . 'fnFormatDetails(nTr), \'details\' );
                            }
                            });
                          ');

          /*  $.get("index.php?module=auftrag&action=minidetail&id=2", function(text){
                          spin=0; 
                          miniauftrag = text;
                          });
          */
          $module = $this->app->Secure->GetGET("module");
          if(isset($doppelteids)&& $doppelteids){$doppelteids = '\-[1-9]{1}[0-9]*';}else{$doppelteids = '';}
          $this->app->Tpl->Add('JAVASCRIPT', 'function ' . $name . 'fnFormatDetails ( nTr ) {
                          //var aData =  oTable' . $name . '.fnGetData( nTr );
                          var str = aData[' . $menucol . '];

                          if (str.match(\'string\')) {
                            str = str.replace("string", "");
                            var auftrag = str;
                          } else {
                            var match = str.match(/[1-9]{1}[0-9]*'.$doppelteids.'/);
                            '.($doppelteids==''?'var auftrag = parseInt(match[0], 10);':'var auftrag = match[0];').'
                          }

                          
                          //console.log(str);
                          //var match = str.match(/[1-9]{1}[0-9]*/);
                          //var auftrag = parseInt(match[0], 10);
                          

                          var miniauftrag;
                          var strUrl = "index.php?module=' . $module . '&action=minidetail'.(isset($moreinfoaction)&& $moreinfoaction?$moreinfoaction:'').'&id="+auftrag; //whatever URL you need to call
                          var strReturn = "";

                          jQuery.ajax({
url:strUrl, success:function(html){strReturn = html;}, async:false
});

                          miniauftrag = strReturn;

                          var sOut = \'<table cellpadding="0" cellspacing="0" border="0" align="center" style="padding-left: 30px; padding-right:30px; width:100%;">\';
                          sOut += \'<tr><td>\'+miniauftrag+\'</td></tr>\';
                          sOut += \'</table>\';
                          return sOut;
                      }
');
        }
        $colspan = count($heading);
        $this->app->Tpl->Add($parsetarget, '
    <br><br>
    <table cellpadding="0" cellspacing="0" border="0" style="width:" class="display" id="' . $name . '">
    <thead>
    <tr><th colspan="' . $colspan . '"><br></th></tr>
    <tr>');
        for ($i = 0;$i < count($heading);$i++) {
          $this->app->Tpl->Add($parsetarget, '<th width="' . $width[$i] . '">' . $heading[$i] . '</th>');
        }
        $this->app->Tpl->Add($parsetarget, '</tr>
    </thead>
    <tbody>
    <tr>
    <td colspan="' . $colspan . '" class="dataTables_empty">Lade Daten</td>
    </tr>
    </tbody>

    <tfoot>
    <tr>
    ');
        for ($i = 0;$i < count($heading);$i++) {
          $this->app->Tpl->Add($parsetarget, '<th>' . $heading[$i] . '</th>');
        }
        $this->app->Tpl->Add($parsetarget, '
    </tr>
    </tfoot>
    </table>
    <br>
    <br>
    <br>
    ');
      } else 
      if ($callback == "sql") return $sql;
      else 
      if ($callback == "searchsql") return $searchsql;
      else 
      if ($callback == "searchsql_dir") return $searchsql_dir;
      else 
      if ($callback == "searchfulltext") return $searchfulltext;
      else 
      if ($callback == "defaultorder") return $defaultorder;
      else 
      if ($callback == "defaultorderdesc") return $defaultorderdesc;
      else 
      if ($callback == "heading") return $heading;
      else 
      if ($callback == "menu") return $menu;
      else 
      if ($callback == "findcols") return $findcols;
      else 
      if ($callback == "moreinfo") return $moreinfo;
      else 
      if ($callback == "allowed") return $allowed;
      else 
      if ($callback == "where") return $where;
      else 
      if ($callback == "groupby") return $groupby;
      else 
      if ($callback == "count") return $count;
      else 
      if ($callback == "orderby") return isset($orderby)?$orderby:'';
    }

    function AutoCompleteAuftrag($fieldname, $filter, $onlyfirst = 0, $extendurl = "") {

      $module = $this->app->Secure->GetGET("module");
      $id = $this->app->Secure->GetGET("id");
      
      if ($onlyfirst) {
        $tpl = '
      $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '&smodule=' . $module . '&sid=' . $id . '",
select: function( event, ui ) {
var i = ui.item.value;
var zahl = i.indexOf(" ");
var text = i.slice(0, zahl);
$( "#' . $fieldname . '" ).val( ui.item.value );
$( "#' . $fieldname . '" ).blur();
return false;
},
create: function () {
$(this).data(\'ui-autocomplete\')._renderItem = function (ul, item) {
var suchstring = /(Aktuell kein Lagerbestand)/g;
var suchergebnis = suchstring.test( item.label );
if (suchergebnis != false)
{
return $(\'<li>\')
.append(\'<a style="color:red">\' + item.label + \'</a>\')
.appendTo(ul);
}
else
{
  return $(\'<li>\')
    .append(\'<a>\' + item.label + \'</a>\')
    .appendTo(ul);
}
};
}
});';
      } else {

        //TODO
        $tpl = '
    $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '"
});';
      }
      $this->app->Tpl->Add('AUTOCOMPLETE', $tpl);
      $this->app->Tpl->Set(strtoupper($fieldname) . 'START', '<div style="font-size: 8pt;"><div class="ui-widget" style="font-size: 8pt;">');
      $this->app->Tpl->Set(strtoupper($fieldname) . 'ENDE', '</div></div>');
    }
    
    function AutoCompleteBestellung($fieldname, $filter, $onlyfirst = 0, $extendurl = "") {

      
      if ($onlyfirst) {
        $tpl = '
      $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '",
select: function( event, ui ) {
var i = ui.item.value;
var zahl = i.indexOf(" ");
var text = i.slice(0, zahl);
$( "#' . $fieldname . '" ).val( ui.item.value );
$( "#' . $fieldname . '" ).blur();
return false;
}
});';
      } else {
        $tpl = '

    $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . '"
});';
      }
      $this->app->Tpl->Add('AUTOCOMPLETE', $tpl);
      $this->app->Tpl->Set(strtoupper($fieldname) . START, '<div style="font-size: 8pt;"><div class="ui-widget" style="font-size: 8pt;">');
      $this->app->Tpl->Set(strtoupper($fieldname) . ENDE, '</div></div>');
    }
    
    function AutoCompleteAddCut($fieldname, $filter, $onlyfirst = 0, $extendurl = "") {

      
      if ($onlyfirst) {
        $tpl = '
      $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '",
select: function( event, ui ) {
var j = ui.item.value;
var i = $( "#' . $fieldname . '" ).val()+ui.item.value;
var zahl = i.indexOf(",");
var zahl2 = j.indexOf(" ");
var text = i.slice(0, zahl);
var text2 = j.slice(0, zahl2);
if(zahl <=0)
$( "#' . $fieldname . '" ).val( text2 );
else {
var j = $( "#' . $fieldname . '" ).val();
var zahlletzte = j.lastIndexOf(",");
var text3 = j.substring(0,zahlletzte); 

$( "#' . $fieldname . '" ).val( text3 +","+ text2 );
}
return false;
}
});';
      } else {
        $tpl = '
    $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '",
select: function( event, ui ) {
var i = $( "#' . $fieldname . '" ).val()+ui.item.value;
var zahl = i.indexOf(",");

var text = i.slice(0, zahl);
if(zahl <=0)
$( "#' . $fieldname . '" ).val( ui.item.value );
else {
var j = $( "#' . $fieldname . '" ).val();
var zahlletzte = j.lastIndexOf(",");
var text2 = j.substring(0,zahlletzte); 

$( "#' . $fieldname . '" ).val( text2 + "," + ui.item.value );
}
return false;
}
});';
      }
      $this->app->Tpl->Add(AUTOCOMPLETE, $tpl);
      $this->app->Tpl->Set(strtoupper($fieldname) . START, '<div style="font-size: 8pt;"><div class="ui-widget" style="font-size: 8pt;">');
      $this->app->Tpl->Set(strtoupper($fieldname) . ENDE, '</div></div>');
    }
    
    function AutoCompleteAdd($fieldname, $filter, $onlyfirst = 0, $extendurl = "") {

      
      if ($onlyfirst) {
        $tpl = '
      $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '",
select: function( event, ui ) {
var j = ui.item.value;
var i = $( "#' . $fieldname . '" ).val()+ui.item.value;
var zahl = i.indexOf(",");
var zahl2 = j.indexOf(" ");
var text = i.slice(0, zahl);
var text2 = j.slice(0, zahl2);
if(zahl <=0)
$( "#' . $fieldname . '" ).val( text2 );
else {
var j = $( "#' . $fieldname . '" ).val();
var zahlletzte = j.lastIndexOf(",");
var text3 = j.substring(0,zahlletzte); 

$( "#' . $fieldname . '" ).val( text3 +","+ text2 );
}
return false;
}
});';
      } else {
        $tpl = '
    $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '",
select: function( event, ui ) {
var i = $( "#' . $fieldname . '" ).val()+ui.item.value;
var zahl = i.indexOf(",");

var text = i.slice(0, zahl);
if(zahl <=0)
$( "#' . $fieldname . '" ).val( ui.item.value );
else {
var j = $( "#' . $fieldname . '" ).val();
var zahlletzte = j.lastIndexOf(",");
var text2 = j.substring(0,zahlletzte); 

$( "#' . $fieldname . '" ).val( text2 + "," + ui.item.value );
}
return false;
}
});';
      }
      $this->app->Tpl->Add('AUTOCOMPLETE', $tpl);
      $this->app->Tpl->Set(strtoupper($fieldname) . 'START', '<div style="font-size: 8pt;"><div class="ui-widget" style="font-size: 8pt;">');
      $this->app->Tpl->Set(strtoupper($fieldname) . 'ENDE', '</div></div>');
    }
    
    function AutoCompleteAddEvent($fieldname, $filter, $onlyfirst = 0, $extendurl = "") {
      if ($onlyfirst) {
        $tpl = '
      $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '"
});';
      } else {
        $tpl = '
    $( "#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '"
});';
      }
      $this->app->Tpl->Add('AUTOCOMPLETE', $tpl);
      $this->app->Tpl->Set(strtoupper($fieldname) . 'START', '<div style="font-size: 8pt;"><div class="ui-widget" style="font-size: 8pt;">');
      $this->app->Tpl->Set(strtoupper($fieldname) . 'ENDE', '</div></div>');
    }
    
    function AutoComplete($fieldname, $filter, $onlyfirst = 0, $extendurl = "") {

      
      if ($onlyfirst) {
        $tpl = '
      $( "input#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '",
select: function( event, ui ) {
var i = ui.item.value;
var zahl = i.indexOf(" ");
var text = i.slice(0, zahl);
$( "input#' . $fieldname . '" ).val( text );
return false;
}
});';
      } else {
        $tpl = '

    $( "input#' . $fieldname . '" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=' . $filter . $extendurl . '",
});';
      }
      $this->app->Tpl->Add('AUTOCOMPLETE', $tpl);
      $this->app->Tpl->Set(strtoupper($fieldname) . 'START', '<div style="font-size: 8pt;"><div class="ui-widget" style="font-size: 8pt;">');
      $this->app->Tpl->Set(strtoupper($fieldname) . 'ENDE', '</div></div>');
    }
    
    function ChartDB($sql, $parsetarget, $width, $height, $limitmin = 0, $limitmax = 100, $gridy = 5) {

      $result = $this->app->DB->SelectArr($sql);
      for ($i = 0;$i < count($result);$i++) {
        $lables[] = $result[$i]['legende'];
        $values[] = $result[$i]['wert'];
      }
      $values = array_reverse($values, false);
      $lables = array_reverse($lables, false);
      $this->app->YUI->ChartAdd("#4040FF", $values);
      $this->app->YUI->Chart(TAB3, $lables, $width, $height, $limitmin, $limitmax, $gridy);
    }
    
    function Chart($parsetarget, $labels, $width = 400, $height = 200, $limitmin = 0, $limitmax = 100, $gridy = 5) {

      $values = $labels;
      for ($i = 0;$i < count($values) - 1;$i++) {
        $werte = $werte . "'" . $values[$i] . "',";
      }
      $werte = $werte . "'" . $values[$i + 1] . "'";
      $this->app->Tpl->Set('LABELS', "[" . $werte . "]");
      $this->app->Tpl->Set('CHART_WIDTH', $width);
      $this->app->Tpl->Set('CHART_HEIGHT', $height);
      $this->app->Tpl->Set('LIMITMIN', $limitmin);
      $this->app->Tpl->Set('LIMITMAX', $limitmax);
      $this->app->Tpl->Set('GRIDX', count($values));
      $this->app->Tpl->Set('GRIDY', $gridy);
      $this->app->Tpl->Parse($parsetarget, "chart.tpl");
    }
    
    function ChartAdd($color, $values) {

      for ($i = 0;$i < count($values) - 1;$i++) {
        $werte = $werte . $values[$i] . ",";
      }
      $werte = $werte . $values[$i + 1];
      $this->app->Tpl->Add(CHARTS, "c.add('', '$color', [ $werte]);");
    }
    
    function DateiUploadNeuVersion($parsetarget, $datei) {
      $speichern = $this->app->Secure->GetPOST("speichern");
      $module = $this->app->Secure->GetGET("module");
      $action = $this->app->Secure->GetGET("action");
      $id = $this->app->Secure->GetGET("id");
      
      if ($speichern != "") {
        $titel = $this->app->Secure->GetPOST("titel");
        $beschreibung = $this->app->Secure->GetPOST("beschreibung");
        $stichwort = $this->app->Secure->GetPOST("stichwort");
        $this->app->Tpl->Set('TITLE', $titel);
        $this->app->Tpl->Set('BESCHREIBUNG', $beschreibung);
        
        if ($_FILES['upload']['tmp_name'] == "") {
          $this->app->Tpl->Set('ERROR', "<div class=\"info\">Bitte w&auml;hlen Sie eine Datei aus und laden Sie diese herauf!</div>");
          $this->app->erp->EnableTab("tabs-2");
        } else {

          //$fileid = $this->app->erp->CreateDatei($_FILES['upload']['name'],$titel,$beschreibung,"",$_FILES['upload']['tmp_name'],$this->app->User->GetName());
          $this->app->erp->AddDateiVersion($datei, $this->app->User->GetName(), $_FILES['upload']['name'], "Neue Version", $_FILES['upload']['tmp_name']);
          header("Location: index.php?module=$module&action=$action&id=$id");
          exit;
        }
      }
      $this->app->Tpl->Set('STARTDISABLE', "<!--");
      $this->app->Tpl->Set('ENDEDISABLE', "-->");
      $this->app->Tpl->Parse($parsetarget, "datei_neudirekt.tpl");
    }
    
    function DateiUpload($parsetarget, $objekt, $parameter) {
      $speichern = $this->app->Secure->GetPOST("speichern");
      $module = $this->app->Secure->GetGET("module");
      $action = $this->app->Secure->GetGET("action");
      $id = $this->app->Secure->GetGET("id");
      
      if ($speichern != "") {
        $titel = $this->app->Secure->GetPOST("titel");
        $beschreibung = $this->app->Secure->GetPOST("beschreibung");
        $stichwort = $this->app->Secure->GetPOST("stichwort");
        $this->app->Tpl->Set(TITLE, $titel);
        $this->app->Tpl->Set(BESCHREIBUNG, $beschreibung);
        
        if ($_FILES['upload']['tmp_name'] == "") {
          $this->app->Tpl->Set(ERROR, "<div class=\"error\">Keine Datei ausgew&auml;hlt!</div>");
          $this->app->erp->EnableTab("tabs-2");
        } else {
          $fileid = $this->app->erp->CreateDatei($_FILES['upload']['name'], $titel, $beschreibung, "", $_FILES['upload']['tmp_name'], $this->app->User->GetName());

          // stichwoerter hinzufuegen
          $this->app->erp->AddDateiStichwort($fileid, $stichwort, $objekt, $parameter);
          header("Location: index.php?module=$module&action=$action&id=$id");
        }
      }
      
      if ($objekt != "" && $parameter != "") {
        $table = new EasyTable($this->app);
        $table->Query("SELECT d.titel, s.subjekt, v.version, v.ersteller, v.bemerkung, d.id FROM datei d LEFT JOIN datei_stichwoerter s ON d.id=s.datei  
        LEFT JOIN datei_version v ON v.datei=d.id
        WHERE s.objekt='$objekt' AND s.parameter='$parameter' AND d.geloescht=0");
        $table->DisplayNew(INHALT, "<!--<a href=\"index.php?module=dateien&action=send&fid=%value%&ext=.jpg\"  rel=\"group\" class=\"zoom2\">
        <img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/vorschau.png\" border=\"0\"></a>-->
        &nbsp;<a href=\"index.php?module=dateien&action=send&id=%value%\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/download.png\" border=\"0\"></a>&nbsp;
        <!--<a href=\"index.php?module=dateien&action=edit&id=%value%\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\" border=\"0\"></a>&nbsp;-->
        <a href=\"#\"onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=dateien&action=delete&id=%value%';\"><img src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\" border=\"0\" ></a>
        ");
      }
      $this->app->Tpl->Parse('TAB1', "rahmen70.tpl");
      $this->app->Tpl->Parse('TAB2', "datei_neudirekt.tpl");
      $this->app->Tpl->Set('AKTIV_TAB1', "selected");
      $this->app->Tpl->Parse($parsetarget, "dateienuebersicht.tpl");
    }
    
    function SortListAdd($parsetarget, &$ref, $menu, $sql, $sort = true) {

      $module = $this->app->Secure->GetGET("module");
      $id = $this->app->Secure->GetGET("id");
      $projekt = $this->app->DB->Select("SELECT projekt FROM `$module` WHERE id='$id' LIMIT 1");
      $schreibschutz = $this->app->DB->Select("SELECT schreibschutz FROM $module WHERE id='$id'");
      $table = new EasyTable($this->app);
      
      if ($sort) $table->Query($sql . " ORDER by sort");
      else $table->Query($sql);

      // letzte zeile anzeigen
      
      if ($module == "lieferschein") {
        
        if ($schreibschutz != 1) {
          $table->AddRow(array('<form action="" method="post">', '[ARTIKELSTART]<input type="text" autofocus="autofocus" size="30" name="artikel" id="artikel" onblur="window.setTimeout(\'selectafterblur()\',200);">[ARTIKELENDE]', '<input type="text" name="projekt" id="projekt" size="10" readonly onclick="checkhere()" >', '<input type="text" name="nummer" id="nummer" size="7">', '<input type="text" size="10" name="lieferdatum" id="lieferdatum">', '<input type="text" name="menge" id="menge" size="5" onblur="window.setTimeout(\'selectafterblurmenge()\',200);">', '<input type="hidden" name="preis" id="preis" size="5" onclick="checkhere();">', '<input type="submit" value="einf&uuml;gen" name="ajaxbuchen">

            <script type="text/javascript">
            document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
            document.getElementById("artikel").focus();
            document.getElementById("artikel").value="";
            document.getElementById("projekt").value="";
            document.getElementById("nummer").value="";
            document.getElementById("lieferdatum").value="";
            document.getElementById("menge").value="";
            }
            };
      </script>

        </form>'));
          $this->app->YUI->AutoCompleteAuftrag("artikel", "artikelnummer", 1, "&projekt=$projekt");
        }
      } else 
      if ($module == "inventur") {
        
        if ($schreibschutz != 1) {
          $table->AddRow(array('<form action="" method="post">', '[ARTIKELSTART]<input type="text" size="30" name="artikel" id="artikel" onblur="window.setTimeout(\'selectafterblur()\',200);" [COMMONREADONLYINPUT]>[ARTIKELENDE]', '<input type="text" name="projekt" id="projekt" size="10" readonly onclick="checkhere()" >', '<input type="text" name="nummer" id="nummer" size="7">', '<input type="text" name="menge" id="menge" size="5" onblur="window.setTimeout(\'selectafterblurmenge()\',200);">', '<input type="text" name="preis" id="preis" size="5" onclick="checkhere();">', '<input type="submit" value="einf&uuml;gen" name="ajaxbuchen">

            <script type="text/javascript">
            document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
            document.getElementById("artikel").focus();
            document.getElementById("projekt").value="";
            document.getElementById("artikel").value="";
            document.getElementById("nummer").value="";
            document.getElementById("menge").value="";
            document.getElementById("preis").value="";
            }
            };
      </script>

        </form>'));
          $this->app->YUI->AutoCompleteAddEvent("artikel", "artikelnummer", 1);
        }
      } else 
      if ($module == "anfrage") {
        
        if ($schreibschutz != 1) {
          $table->AddRow(array('<form action="" method="post">', '[ARTIKELSTART]<input type="text" size="30" name="artikel" id="artikel" onblur="window.setTimeout(\'selectafterblur()\',200);" [COMMONREADONLYINPUT]>[ARTIKELENDE]', '<input type="text" name="projekt" id="projekt" size="10" readonly onclick="checkhere()" >', '<input type="text" name="nummer" id="nummer" size="7">', '<input type="text" size="10" name="lieferdatum" id="lieferdatum">', '<input type="text" name="menge" id="menge" size="5" onblur="window.setTimeout(\'selectafterblurmenge()\',200);">', '<input type="hidden" name="preis" id="preis" size="5" onclick="checkhere();">', '<input type="submit" value="einf&uuml;gen" name="ajaxbuchen">
            <script type="text/javascript">
            document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
            document.getElementById("artikel").focus();
            document.getElementById("artikel").value="";
            document.getElementById("nummer").value="";
            document.getElementById("lieferdatum").value="";
            document.getElementById("menge").value="";
            document.getElementById("preis").value="";
            }
            };
      </script>
        </form>'));
          $this->app->YUI->AutoCompleteAddEvent("artikel", "artikelnummer", 1, "&projekt=$projekt");
        }
      } else 
      if ($module == "arbeitsnachweis") {
        
        if ($schreibschutz != 1) {
          $table->AddRow(array('<form action="" method="post">', '[ADRESSESTART]<input type="text" size="20" name="adresse" id="adresse">[ADRESSEENDE]', '<input type="text" name="ort" id="ort" size="10">', '<input type="text" name="datum" id="datum" size="10">', '<input type="text" name="von" id="von" size="5">', '<input type="text" name="bis" id="bis" size="5">', '<input type="text" name="bezeichnung" id="bezeichnung" size="30">', '<input type="submit" value="einf&uuml;gen" name="ajaxbuchen"> <input type="hidden" name="bezeichnunglieferant" id="bezeichnunglieferant"><input type="hidden" name="bestellnummer" id="bestellnummer">
            <script type="text/javascript">
            document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
            document.getElementById("adresse").focus();
            document.getElementById("adresse").value="";
            document.getElementById("ort").value="";
            document.getElementById("datum").value="";
            document.getElementById("von").value="";
            document.getElementById("bis").value="";
            document.getElementById("bezeichnung").value="";
            }
            };
      </script>
        </form>'));
          $this->app->YUI->AutoCompleteAddEvent("adresse", "mitarbeiter");
        }
      } else 
      if ($module == "reisekosten") {
        
        if ($schreibschutz != 1) {
          $table->AddRow(array('<form action="" method="post">', '<input type="text" name="datum" id="datum" size="10">', '<select name="reisekostenart">' . $this->app->erp->GetSelectReisekostenart() . '</select>', '<input type="text" name="betrag" id="betrag" size="8">', '<input type="checkbox" name="abrechnen" id="abrechnen" value="1">', '<input type="checkbox" name="keineust" id="keineust" value="1">', '<select name="uststeuersatz">' . $this->app->erp->GetSelectSteuersatz("", $id, "reisekosten") . '</select>', '<input type="text" name="bezeichnung" id="bezeichnung" size="30">', '<select name="bezahlt_wie">' . $this->app->erp->GetSelectBezahltWie() . '
            </select>', '<input type="submit" value="einf&uuml;gen" name="ajaxbuchen"> <input type="hidden" name="bezeichnunglieferant" id="bezeichnunglieferant"><input type="hidden" name="bestellnummer" id="bestellnummer">
            <script type="text/javascript">
            document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
            document.getElementById("datum").focus();
            document.getElementById("datum").value="";
            document.getElementById("betrag").value="";
            document.getElementById("umsatzsteuer").value="";
            document.getElementById("bezeichnung").value="";
            }
            };
      </script></form>'));
          $this->app->YUI->AutoCompleteAddEvent("adresse", "mitarbeiter");
        }
      } else 
      if ($module == "produktion") {
      } else 
      if ($module == "bestellung") {
        if ($schreibschutz != 1) {
          $table->AddRow(array('<form action="" method="post">', '[ARTIKELSTART]<input type="text" size="30" name="artikel" id="artikel" onblur="window.setTimeout(\'selectafterblur()\',300);"  >[ARTIKELENDE]', '<input type="text" name="projekt" id="projekt" size="10" readonly onclick="checkhere()" >', '<input type="text" name="nummer" id="nummer" size="7">', '<input type="text" size="8" name="lieferdatum" id="lieferdatum">', '<input type="text" name="menge" id="menge" size="5" onblur="window.setTimeout(\'selectafterblurmenge()\',200);"><input type="hidden" name="vpe" id="vpe">', '<input type="text" name="preis" id="preis" size="10" onclick="checkhere();">', '<input type="text" name="waehrung" id="waehrung" size="10" onclick="checkhere();">','<input type="submit" value="einf&uuml;gen" name="ajaxbuchen"> <input type="hidden" name="bezeichnunglieferant" id="bezeichnunglieferant"><input type="hidden" name="bestellnummer" id="bestellnummer">
            <script type="text/javascript">
            document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
            document.getElementById("artikel").focus();
            document.getElementById("artikel").value="";
            document.getElementById("projekt").value="";
            document.getElementById("nummer").value="";
            document.getElementById("lieferdatum").value="";
            document.getElementById("menge").value="";
            document.getElementById("preis").value="";
            document.getElementById("vpe").value="";
            document.getElementById("waehrung").value="";
            }
            };
      </script>
        </form>'));
        }
        $adresse = $this->app->DB->Select("SELECT adresse FROM bestellung WHERE id='$id' LIMIT 1");
        $this->app->YUI->AutoCompleteBestellung("artikel", "einkaufartikelnummerprojekt", 1, "&adresse=$adresse");
      } else 
      if ($module == "angebot" || $module == "auftrag" || $module == "rechnung" || $module == "gutschrift") {
        
        if ($schreibschutz != 1) {
          $table->AddRow(array('<form action="" method="post" id="myform">', '[ARTIKELSTART]<input type="text" autofocus="autofocus" size="30" name="artikel" id="artikel" onblur="window.setTimeout(\'selectafterblur()\',200);">[ARTIKELENDE]', '<input type="text" name="projekt" id="projekt" size="10" readonly onclick="checkhere()" >', '<input type="text" name="nummer" id="nummer" size="7">', '<input type="text" size="8" name="lieferdatum" id="lieferdatum">', '<input type="text" name="menge" id="menge" size="5" onblur="window.setTimeout(\'selectafterblur()\',1); document.getElementById(\'preis\').style.background =\'#FE2E2E\';">', '<input type="text" name="preis" id="preis" size="10" onclick="checkhere();">', '', '<input type="submit" value="einf&uuml;gen" name="ajaxbuchen">
            <script type="text/javascript">
            document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
            document.getElementById("artikel").focus();
            document.getElementById("artikel").value="";
            document.getElementById("projekt").value="";
            document.getElementById("nummer").value="";
            document.getElementById("lieferdatum").value="";
            document.getElementById("menge").value="";
            document.getElementById("preis").value="";
            }
            if (evt.keyCode == 160) { // pfeil rechts
              document.getElementById("menge").focus();
              document.getElementById("menge").select();
            }
            if (evt.keyCode == 39) { // pfeil rechts
              //checkhere();
              //document.getElementById("menge").focus();
              //checkhere();
            }
            };
      </script></form>'));
          $adresse = $this->app->DB->Select("SELECT adresse FROM $module WHERE id='$id' LIMIT 1");
          $this->app->YUI->AutoCompleteAuftrag("artikel", "verkaufartikelnummerprojekt", 1, "&projekt=$projekt&adresse=$adresse");
        }
      } else {
        if ($schreibschutz != 1) {
          $table->AddRow(array('<form action="" method="post">', '[ARTIKELSTART]<input type="text" autofocus="autofocus" size="30" name="artikel" id="artikel" onblur="window.setTimeout(\'selectafterblur()\',200);">[ARTIKELENDE]', '<input type="text" name="projekt" id="projekt" size="10" readonly onclick="checkhere()" >', '<input type="text" name="nummer" id="nummer" size="7">', '<input type="text" size="8" name="lieferdatum" id="lieferdatum">', '<input type="text" name="menge" id="menge" size="5" onblur="window.setTimeout(\'selectafterblurmenge()\',200);">', '<input type="text" name="preis" id="preis" size="10" onclick="checkhere();">', '<input type="submit" value="einf&uuml;gen" name="ajaxbuchen">
            <script type="text/javascript">
            document.onkeydown = function(evt) {
            evt = evt || window.event;
            if (evt.keyCode == 27) {
            document.getElementById("artikel").focus();
            document.getElementById("artikel").value="";
            document.getElementById("projekt").value="";
            document.getElementById("nummer").value="";
            document.getElementById("lieferdatum").value="";
            document.getElementById("menge").value="";
            document.getElementById("preis").value="";
            }
            };
      </script></form>'));
          $adresse = $this->app->DB->Select("SELECT adresse FROM $module WHERE id='$id' LIMIT 1");
          $this->app->YUI->AutoCompleteAuftrag("artikel", "verkaufartikelnummerprojekt", 1, "&projekt=$projekt&adresse=$adresse");
        }
      }
      $table->headings[0] = 'Pos';
      $table->headings[1] = 'Artikel';
      $table->headings[2] = 'Projekt';
      $table->headings[3] = 'Nummer';
      $table->headings[4] = 'Lieferung';
      $table->headings[5] = 'Menge';
      
      if ($module == "lieferschein" || $module == "anfrage") {
        $table->headings[6] = 'ausgeliefert';
      } else 
      if ($module == "inventur") {
        $table->headings[4] = 'Menge';
        $table->headings[5] = 'Preis';
      } else 
      if ($module == "produktion") {
        $table->headings[2] = 'Projekt';
        $table->headings[3] = 'Nummer';
        $table->headings[4] = 'Menge';
        $table->headings[5] = 'Lager';
        $table->headings[6] = 'Reserviert';
      } else 
      if ($module == "bestellung") {
        $table->headings[6] = 'Preis';
        $table->headings[7] = 'W&auml;hrung';
      } else 
      if ($module == "arbeitsnachweis") {
        $table->headings[0] = 'Pos';
        $table->headings[1] = 'Mitarbeiter';
        $table->headings[2] = 'Ort';
        $table->headings[3] = 'Datum';
        $table->headings[4] = 'Von';
        $table->headings[5] = 'Bis';
        $table->headings[6] = 'Tätigkeit';
      } else 
      if ($module == "reisekosten") {
        $table->headings[0] = 'Pos';
        $table->headings[1] = 'Datum';
        $table->headings[2] = 'Kostenart';
        $table->headings[3] = 'Betrag';
        $table->headings[4] = 'Abr. bei Kd';
        $table->headings[5] = 'sonst. MwSt'; // kann man auch umbenennen in Keine

        $table->headings[6] = 'MwSt';
        $table->headings[7] = 'Kommentar';
        $table->headings[8] = 'Bezahlt';
      } else {
        $table->headings[6] = 'Preis';
        
        if ($module == "angebot" || $module == "auftrag" || $module == "rechnung" || $module == "gutschrift") $table->headings[7] = 'Rabatt';
      }
      $table->widths[0] = '5%';
      $table->widths[1] = '25%';
      $table->widths[2] = '10%';
      $table->widths[3] = '10%';
      $table->widths[4] = '10%';
      $table->widths[5] = '10%';
      $table->widths[6] = '10%';
      
      if ($module == "produktion" || $module == "angebot" || $module == "auftrag" || $module == "rechnung" || $module == "gutschrift") $table->widths[7] = '10%';
      $this->app->YUI->DatePicker("lieferdatum");
      $this->app->YUI->DatePicker("datum");
      $this->app->YUI->TimePicker("von");
      $this->app->YUI->TimePicker("bis");

      //$this->app->YUI->AutoComplete(ARTIKELAUTO,"artikel",array('name_de','warengruppe'),"nummer");
      
      if ($module == "bestellung") $fillArtikel = "fillArtikelBestellung";
      elseif ($module == "inventur") $fillArtikel = "fillArtikelInventur";
      elseif ($module == "lieferschein" || $module == "anfrage") $fillArtikel = "fillArtikelLieferschein";
      elseif ($module == "produktion") $fillArtikel = "fillArtikelProduktion";
      else $fillArtikel = "fillArtikel";
      
      if ($fillArtikel == "fillArtikelBestellung") {
        $this->app->Tpl->Add($parsetarget, '<script type="text/javascript">
        var Tastencode;

        var status=1;

        var nureinmal=0;

        function selectafterblurmenge()
        {
        ' . $fillArtikel . '(document.getElementById("nummer").value,document.getElementById("menge").value);
        }


        function selectafterblur()
        {
        //  if(document.getElementById("artikel").value))
          {
            //      nureinmal=1;
            ' . $fillArtikel . '(document.getElementById("artikel").value,document.getElementById("menge").value);
          }
        }

        function TasteGedrueckt (Ereignis) {
          if (!Ereignis)
            Ereignis = window.event;
          if (Ereignis.which) {
            Tastencode = Ereignis.which;
          } else if (Ereignis.keyCode) {
            Tastencode = Ereignis.keyCode;
          }
          //if((Tastencode=="9" || Tastencode=="13") && !isNaN(document.getElementById("artikel").value) )
          if((Tastencode=="9" || Tastencode=="13"))
          {
            ' . $fillArtikel . '(document.getElementById("artikel").value,document.getElementById("menge").value);
            //document.myform.konto.focus();
            status=1;
          }
        }
        document.onkeydown = TasteGedrueckt;


        function updatehere()
        {
          //    ' . $fillArtikel . '(document.getElementById("nummer").value);

        }


        function checkhere()
        {
          //var test = document.getElementById("artikel").value;
          //if(!isNaN(test.substr(0,6)))
          // ' . $fillArtikel . '(document.getElementById("nummer").value,document.getElementById("menge").value);

          //if(!isNaN(test.substr(0,6))
          //      fillArtikel(document.getElementById("artikel").value);
          // wenn ersten 6 stellen nummer dann update
          //if(!isNaN(document.getElementById("artikel").value))
          //if(document.getElementById("artikel").value)
          //     fillArtikel(document.getElementById("artikel").value);

        }

        </script>

          ');
      } else {
        $this->app->Tpl->Add($parsetarget, '<script type="text/javascript">
        var Tastencode;

        var status=1;

        var nureinmal=0;

        function selectafterblurmenge()
        {
        ' . $fillArtikel . '(document.getElementById("nummer").value,document.getElementById("menge").value);
        }

        var oldvalue;
        function selectafterblur()
        {
        // if(nureinmal==0)// || !isNaN(document.getElementById("artikel").value))
        //      if(document.getElementById("artikel")=="") nureinmal=0;

          if(document.getElementById("nummer").value!="" && nureinmal==1)
            ' . $fillArtikel . '(document.getElementById("nummer").value+ " " +document.getElementById("artikel").value,document.getElementById("menge").value);
          else
            ' . $fillArtikel . '(document.getElementById("artikel").value,document.getElementById("menge").value);

          nureinmal=1;
          if(oldvalue!=document.getElementById("artikel").value) nureinmal=0;
          oldvalue=document.getElementById("artikel").value;
        }

    function TasteGedrueckt (Ereignis) {
      if (!Ereignis)
        Ereignis = window.event;
      if (Ereignis.which) {
        Tastencode = Ereignis.which;
      } else if (Ereignis.keyCode) {
        Tastencode = Ereignis.keyCode;
      }
      if((Tastencode=="9" || Tastencode=="13") && !isNaN(document.getElementById("artikel").value) )
      {
        if(document.getElementById("nummer").value!="")
          ' . $fillArtikel . '(document.getElementById("artikel").value,document.getElementById("menge").value);
        else
          ' . $fillArtikel . '(document.getElementById("nummer").value+ " " + document.getElementById("artikel").value,document.getElementById("menge").value);
        //document.myform.konto.focus();
        status=1;
      }
    }
    document.onkeydown = TasteGedrueckt;


    function updatehere()
    {
      ' . $fillArtikel . '(document.getElementById("artikel").value);

    }

    function checkhere()
    {
      //var test = document.getElementById("artikel").value;
      //if(!isNaN(test.substr(0,6)))
      //      ' . $fillArtikel . '(document.getElementById("artikel").value,document.getElementById("menge").value);

      //if(!isNaN(test.substr(0,6))
      //      fillArtikel(document.getElementById("artikel").value);
      // wenn ersten 6 stellen nummer dann update
      //if(!isNaN(document.getElementById("artikel").value))
      //if(document.getElementById("artikel").value)
      //     fillArtikel(document.getElementById("artikel").value);

    }

    </script>

      ');
      }

      //$this->app->YUI->AutoComplete(NUMMERAUTO,"artikel",array('nummer','name_de','warengruppe'),"nummer");
      
      if ($schreibschutz != 1) {
        foreach ($menu as $key => $value) {

          // im popup öffnen
          
          if ($key == "add") $tmp.= "<a href=\"index.php?module=$module&action=$value&id=%value%&frame=false&pid=$id\" 
          onclick=\"makeRequest(this);return false\"><img border=\"0\" src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/new.png\"></a>&nbsp;";
          else 
          if ($key == "del") $tmp.= "<a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=$module&action=$value&sid=%value%&id=$id';\" href=\"#\"><img border=\"0\" src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\"></a>&nbsp;";
          else 
          if ($key == "edit") $tmp.= "<a href=\"index.php?module=$module&action=$value&id=%value%&frame=false&pid=$id\" 
          class=\"popup\" title=\"Artikel &auml;ndern\"><img border=\"0\" src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/edit.png\"></a>&nbsp;";

          // nur aktion ausloesen und liste neu anzeigen
          else $tmp.= "<a href=\"index.php?module=$module&action=$value&sid=%value%&id=$id\"><img border=\"0\" src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/$key.png\"></a>&nbsp;";
        }
        $table->DisplayEditable($parsetarget, $tmp);
      } else $table->DisplayNew($parsetarget, $tmp);
    }
    
    function SortList($parsetarget, &$ref, $menu, $sql, $sort = true) {

      $module = $this->app->Secure->GetGET("module");
      $id = $this->app->Secure->GetGET("id");
      $table = new EasyTable($this->app);
      
      if ($sort) $table->Query($sql . " ORDER by sort");
      else $table->Query($sql);
      foreach ($menu as $key => $value) {

        // im popup öffnen
        
        if ($key == "add") $tmp.= "<a href=\"index.php?module=$module&action=$value&id=%value%&frame=false&pid=$id\" 
        onclick=\"makeRequest(this);return false\"><img border=\"0\" src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/new.png\"></a>&nbsp;";
        else 
        if ($key == "del") $tmp.= "<a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=$module&action=$value&sid=%value%&id=$id';\" href=\"#\"><img border=\"0\" src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/delete.gif\"></a>&nbsp;";
        else 
        if ($key == "edit") $tmp.= "<a href=\"index.php?module=$module&action=$value&id=%value%&frame=false&pid=$id\" class=\"popup\" title=\"Artikel &auml;ndern\">
        <img border=\"0\" src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/$key.png\"></a>&nbsp;";

        // nur aktion ausloesen und liste neu anzeigen
        else $tmp.= "<a href=\"index.php?module=$module&action=$value&sid=%value%&id=$id\"><img border=\"0\" src=\"./themes/{$this->app->Conf->WFconf['defaulttheme']}/images/$key.png\"></a>&nbsp;";
      }
      $table->DisplayNew($parsetarget, $tmp);
    }
    
    function SortListEvent($event, $table, $fremdschluesselindex) {

      $sid = $this->app->Secure->GetGET("sid");
      $id = $this->app->Secure->GetGET("id");
      $sort = $this->app->DB->Select("SELECT sort FROM $table WHERE id='$sid' LIMIT 1");
      
      if ($event == "up") {

        //gibt es ein element an hoeherer stelle?
        $nextsort = $this->app->DB->Select("SELECT sort FROM $table WHERE $fremdschluesselindex='$id' AND sort ='" . ($sort + 1) . "' LIMIT 1");
        
        if ($nextsort > $sort) {
          $nextid = $this->app->DB->Select("SELECT id FROM $table WHERE $fremdschluesselindex='$id' AND sort = '" . ($sort + 1) . "' LIMIT 1");
          $this->app->DB->Update("UPDATE $table SET sort='$nextsort' WHERE id='$sid' LIMIT 1");
          $this->app->DB->Update("UPDATE $table SET sort='$sort' WHERE id='$nextid' LIMIT 1");
        } else {

          // element ist bereits an oberster stelle
          
        }
      } else 
      if ($event == "down") {

        //gibt es ein element an hoeherer stelle?
        $prevsort = $this->app->DB->Select("SELECT sort FROM $table WHERE $fremdschluesselindex='$id' AND sort = '" . ($sort - 1) . "' LIMIT 1");
        
        if ($prevsort < $sort && $prevsort != 0) {
          $previd = $this->app->DB->Select("SELECT id FROM $table WHERE $fremdschluesselindex='$id' AND sort = '" . ($sort - 1) . "' LIMIT 1");
          $this->app->DB->Update("UPDATE $table SET sort='$prevsort' WHERE id='$sid' LIMIT 1");
          $this->app->DB->Update("UPDATE $table SET sort='$sort' WHERE id='$previd' LIMIT 1");
        } else {

          // element ist bereits an oberster stelle
          
        }
      } else 
      if ($event == "del") {
        
        if ($sid > 0) {
          
          if ($table == "auftrag_position" || $table == "produktion_position" || $table == "lieferschein_position") {
            
            switch ($table) {
              case "auftrag_position";
              $tmptable = "auftrag";
            break;
            case "lieferschein_position";
            $tmptable = "lieferschein";
          break;
          case "produktion_position";
          $tmptable = "produktion";
        break;
      }

      // alle reservierungen fuer die eine position loeschen
      $tmpartikel = $this->app->DB->Select("SELECT artikel FROM $table WHERE id='$sid' LIMIT 1");
      $tmptable_value = $this->app->DB->Select("SELECT $tmptable FROM $table WHERE id='$sid' LIMIT 1");
      $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE artikel='$tmpartikel' AND objekt='$tmptable' AND parameter='$tmptable_value'");
    }
    $this->app->DB->Delete("DELETE FROM $table WHERE id='$sid' LIMIT 1");
    $this->app->DB->Delete("UPDATE $table SET sort=sort-1 WHERE id='$sid' AND sort > $sort LIMIT 1");
    
    if ($tmptable == "auftrag") $this->app->erp->AuftragEinzelnBerechnen($tmptable_value);
  }
} else {
}
}

function IframeDialog($width, $height, $src = "") {

  $id = $this->app->Secure->GetGET("id");
  $sid = $this->app->Secure->GetGET("sid");
  $module = $this->app->Secure->GetGET("module");
  $action = $this->app->Secure->GetGET("action");
  
  if ($src != "") $this->app->Tpl->Set(PAGE, "<iframe name=\"framepositionen\" id=\"framepositionen\" width=\"$width\"  height=\"$height\" frameborder=\"0\" src=\"$src&iframe=true\"></iframe>");
  else $this->app->Tpl->Set(PAGE, "<iframe name=\"framepositionen\" id=\"framepositionen\" width=\"$width\"  height=\"$height\" frameborder=\"0\" src=\"index.php?module=$module&action=$action&id=$id&sid=$sid&iframe=true\"></iframe>");
  $this->app->BuildNavigation = false;
}
}
?>
