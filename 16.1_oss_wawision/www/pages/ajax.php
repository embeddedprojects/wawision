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
class Ajax {
  var $app;

  function Ajax($app) {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("filter","AjaxFilter");
    $this->app->ActionHandler("table","AjaxTable");
    $this->app->ActionHandler("ansprechpartner","AjaxAnsprechpartner");
    $this->app->ActionHandler("lieferadresse","AjaxLieferadresse");
    $this->app->ActionHandler("adressestammdaten","AjaxAdresseStammdaten");
    $this->app->ActionHandler("tooltipsuche","AjaxTooltipSuche");
    $this->app->ActionHandler("tableposition","AjaxTablePosition");
    $this->app->ActionHandler("tablefilter", "AjaxTableFilter");
    $this->app->ActionHandler("moduleunlock", "AjaxModuleUnlock");

    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }
  
  function AjaxModuleUnlock() {
    if($this->app->erp->RechteVorhanden("welcome","unlock"))
    {
      if($salt = $this->app->Secure->GetGET('salt'))
      {
        $this->app->DB->Delete("DELETE from module_lock where salt = '".$salt."'");
      }
    }
    exit;
  }

  function AjaxTableFilter() {

    /*header("Content-Type: text/html; charset=utf-8");*/

    $do = $this->app->Secure->GetGET("do");
    $filter = $this->app->Secure->GetGET("filter");

    switch ($do) {
      case 'getParameters':
        $params = $this->app->User->GetParameter('table_filter_' . $filter);
        echo base64_decode($params);
        break;
      case 'setParameters':
        $params = base64_encode(json_encode($_GET)); 
        $this->app->User->SetParameter('table_filter_' . $filter, $params);
        break;
      case 'clearParameters':
        $this->app->User->SetParameter('table_filter_' . $filter,'');
        break;
      default:
        return false;
        break;
    }

    exit;

  }


  function AjaxTooltipSuche()
  {
    $term = $this->app->Secure->GetGET("term");

    if(is_numeric($term))
    {
      $rechnung = $this->app->DB->SelectArr("SELECT id,belegnr,soll,ist FROM rechnung WHERE belegnr='$term'");
      $gutschrift = $this->app->DB->SelectArr("SELECT id,belegnr,soll,ist FROM gutschrift WHERE belegnr='$term'");
      $auftrag = $this->app->DB->SelectArr("SELECT id,belegnr FROM auftrag WHERE belegnr='$term'");
      $internet = $this->app->DB->SelectArr("SELECT id,belegnr FROM auftrag WHERE internet='$term'");
      $kunde = $this->app->DB->SelectArr("SELECT id,name FROM adresse WHERE kundennummer='$term'");
    }
    if(is_array($rechnung))
    {
      foreach($rechnung as $value){
        echo "<table width=\"500\"><tr><td>Rechnung ".$value[belegnr]." SOLL:".$value[soll]." IST:".$value[ist]."</td></tr></table>";
      }
    }




    if(is_array($auftrag))
    {
      foreach($auftrag as $value){
        echo "Auftrag ".$value[belegnr];
      }
    }



    if(is_array($internet))
    {
      foreach($internet as $value){
        echo "Internet Auftrag ".$value[belegnr];
      }
    }


    if($internetnummer)
      echo "Internetnummer";


    if(is_array($kunde))
    {
      foreach($kunde as $value){
        echo "Kunde ".$value[name];
      }
    }


    echo "ENDE ";

    exit;

  }

  function AjaxAdresseStammdaten()
  {
    $id = $this->app->Secure->GetGET("id");	


    //name	abteilung		unterabteilung	land	strasse		ort		plz

    $values = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$id' LIMIT 1");

    foreach($values[0] as $key=>$value)
    {
      $values[0][$key]=$this->app->erp->ReadyForPDF($value);
    }

    echo $this->app->erp->ClearDataBeforeOutput($values[0][name]."#*#".$values[0][abteilung]."#*#".$values[0][unterabteilung]."#*#".$values[0][land]."#*#".$values[0][strasse]."#*#".$values[0][ort]."#*#".$values[0][plz]."#*#".$values[0][adresszusatz]."#*#".$values[0][ansprechpartner]."#*#".$values[0][id]);
    exit;

  }


  function AjaxLieferadresse()
  {
    $id = $this->app->Secure->GetGET("id");	


    //name	abteilung		unterabteilung	land	strasse		ort		plz

    $values = $this->app->DB->SelectArr("SELECT * FROM lieferadressen WHERE id='$id' LIMIT 1");

    foreach($values[0] as $key=>$value)
    {
      $values[0][$key]=$this->app->erp->ReadyForPDF($value);
    }

    echo $this->app->erp->ClearDataBeforeOutput($values[0][name]."#*#".$values[0][abteilung]."#*#".$values[0][unterabteilung]."#*#".$values[0][land]."#*#".$values[0][strasse]."#*#".$values[0][ort]."#*#".$values[0][plz]."#*#".$values[0][adresszusatz]."#*#".$values[0][ansprechpartner]."#*#".$values[0][id]);
    exit;

  }



  function AjaxAnsprechpartner()
  {
    $id = $this->app->Secure->GetGET("id");	

    $values = $this->app->DB->SelectArr("SELECT * FROM ansprechpartner WHERE id='$id' LIMIT 1");

    foreach($values[0] as $key=>$value)
    {
      $values[0][$key]=$this->app->erp->ReadyForPDF($value);
    }

    echo $this->app->erp->ClearDataBeforeOutput($values[0][name]."#*#".$values[0][email]."#*#".$values[0][telefon]."#*#".$values[0][telefax]."#*#".$values[0][abteilung]."#*#".$values[0][unterabteilung].
        "#*#".$values[0][ansprechpartner_land]."#*#".$values[0][strasse]."#*#".$values[0][plz]."#*#".$values[0][ort]."#*#".$values[0][adresszusatz]."#*#".$values[0][typ]."#*#".$values[0][anschreiben]."#*#".$values[0][id]);
    exit;

  }


  function AjaxFilter()
  {
    //$term = $this->app->Secure->GetGET("term");
    $term = $this->app->Secure->GetGET("term");
    $term2 = $term;
    $term3 = $term;
    $term = $this->app->erp->ConvertForDBUTF8($term);
    $term2 = $this->app->erp->ConvertForDB($term2);
    if($term2=="") $term2 = $term;
    $term = str_replace(' ','%',$term);
    $term2 = str_replace(' ','%',$term2);
    //$term = $this->app->erp->ConvertForDBUTF8($term);
    //		$term = str_replace(' ','%',$term);
    $filtername = $this->app->Secure->GetGET("filtername");

    $term = trim($term);
    $term2 = trim($term2);

    switch($filtername)
    {
      case "adressename":
        $arr = $this->app->DB->SelectArr("SELECT name FROM adresse WHERE (email LIKE '%$term%' OR name LIKE '%$term%') ORDER BY email LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = "{$arr[$i]['name']}";
        break;


      case "drucker":
        $arr = $this->app->DB->SelectArr("SELECT name FROM drucker WHERE name LIKE '%$term%' LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = "{$arr[$i]['name']}";
        break;

      case "artikelname":
        $arr = $this->app->DB->SelectArr("SELECT name_de FROM artikel WHERE geloescht=0 AND intern_gesperrt!=1 AND (name_de LIKE '%$term%' OR nummer LIKE '%$term%' OR CONCAT(nummer,' ',name_de) LIKE '%$term%') AND geloescht=0 ORDER by name_de LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name_de'];
        break;

      case "artikelgruppe":
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT typ FROM artikel WHERE geloescht=0 AND intern_gesperrt!=1 AND typ LIKE '%$term%' ORDER by typ");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['typ'];
        break;

      case "artikeleinheit":
        //$arr = $this->app->DB->SelectArr("SELECT DISTINCT einheit_de FROM artikeleinheit WHERE firma='".$this->app->User->GetFirma()."' AND einheit_de LIKE '%$term%' ORDER by einheit_de");
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT einheit_de FROM artikeleinheit WHERE einheit_de LIKE '%$term%' ORDER by einheit_de");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['einheit_de'];
        break;



      case "ihrebestellnummer":
        $adresse = $this->app->Secure->GetGET("adresse");
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT ihrebestellnummer FROM auftrag WHERE ihrebestellnummer LIKE '%$term%' AND adresse='$adresse' ORDER by ihrebestellnummer ");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['ihrebestellnummer'];
      break;


      case "accountart":
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT art FROM adresse_accounts WHERE art LIKE '%$term%' ORDER by art");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['art'];
        break;

      case "ansprechpartner":
        $adresse = $this->app->Secure->GetGET("adresse");
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT name FROM ansprechpartner WHERE adresse='$adresse' AND name LIKE '%$term%' ORDER by name");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;
      case "hersteller":
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT hersteller FROM artikel WHERE geloescht=0 AND intern_gesperrt!=1 AND hersteller LIKE '%$term%' ORDER by hersteller");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['hersteller'];
        break;
   


 
      case "uservorlage":
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT bezeichnung FROM uservorlage WHERE bezeichnung LIKE '%$term%' ORDER by bezeichnung");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['bezeichnung'];
        break;


      case "lagergrund":
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT TRIM(REPLACE(REPLACE(referenz,'Umlagern f&uuml; :',''),'Differenz:','')) as ergebnis FROM lager_bewegung WHERE REPLACE(referenz,'Differenz:','') LIKE '%$term%' AND referenz NOT LIKE '%Inventur%' AND referenz NOT LIKE '%Charge%' AND referenz NOT LIKE '%Lieferschein%'
            AND referenz NOT LIKE '%Manuell%' AND referenz NOT LIKE '%Wareneingang%' AND referenz NOT LIKE '%Lieferungen%' ORDER by LOWER(ergebnis) LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['ergebnis'];
        break;



      case "auftrag_zahlungseingang":
        if(strpos($term,',')!==false)
        {
          $term = substr($term,strripos($term,','));
          $term = str_replace(',','',$term);
        }

        $arr = $this->app->DB->SelectArr("SELECT CONCAT(r.belegnr,' ',a.name,' ',r.internet,' GESAMT: ',r.gesamtsumme,' (Kunde ',a.kundennummer,') vom ',DATE_FORMAT(r.datum,'%d.%m.%Y')) as name
            FROM auftrag r LEFT JOIN adresse a ON a.id=r.adresse WHERE r.belegnr!='' 
            AND (a.name LIKE '%$term%' OR r.belegnr LIKE '%$term%' OR a.kundennummer LIKE '%$term%' ) ORDER by r.belegnr  DESC LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;


      case "rechnung_zahlungseingang":
        if(strpos($term,',')!==false)
        {
          $term = substr($term,strripos($term,','));
          $term = str_replace(',','',$term);
        }

        $arr = $this->app->DB->SelectArr("SELECT CONCAT(r.belegnr,' Soll:',r.soll,' Ist:',r.ist,' ',' Diff:',(r.soll-r.ist)*-1,' ',
          if(r.zahlungszielskonto > 0,CONCAT('SK:',r.zahlungszielskonto,'%(',FORMAT((r.soll/100)*r.zahlungszielskonto,2),') '),''),a.name,'(Kunde ',a.kundennummer,') vom ',DATE_FORMAT(r.datum,'%d.%m.%Y')) as name
            FROM rechnung r LEFT JOIN adresse a ON a.id=r.adresse WHERE r.belegnr!='' AND (a.name LIKE '%$term%' OR r.belegnr LIKE '%$term%' OR a.kundennummer LIKE '%$term%') AND r.zahlungsstatus!='bezahlt' ORDER by r.belegnr DESC LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "gutschrift_zahlungseingang":
        if(strpos($term,',')!==false)
        {
          $term = substr($term,strripos($term,','));
          $term = str_replace(',','',$term);
        }


        $arr = $this->app->DB->SelectArr("SELECT CONCAT(r.belegnr,' SOLL: ',r.soll,' IST:',r.ist,' ',a.name,' (Kunde ',a.kundennummer,') vom ',DATE_FORMAT(r.datum,'%d.%m.%Y')) as name
            FROM gutschrift r LEFT JOIN adresse a ON a.id=r.adresse WHERE r.belegnr!='' AND (a.name LIKE '%$term%' OR r.belegnr LIKE '%$term%' OR a.kundennummer LIKE '%$term%') ORDER by r.belegnr DESC LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;



      case "angebot":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(belegnr,' ',name,' ',DATE_FORMAT(datum,'%d.%m.%Y')) as name 
            FROM angebot WHERE belegnr>0 AND (name LIKE '%$term%' OR belegnr LIKE '%$term%' OR DATE_FORMAT(datum,'%Y-%m-%d') LIKE '%$term%')  ORDER by belegnr LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "bestellung":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(belegnr,' ',name,' ',DATE_FORMAT(datum,'%d.%m.%Y')) as name 
            FROM bestellung WHERE belegnr>0 AND (name LIKE '%$term%' OR belegnr LIKE '%$term%' OR DATE_FORMAT(datum,'%Y-%m-%d') LIKE '%$term%')  ORDER by belegnr LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "auftrag":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(belegnr,' ',name,' ',DATE_FORMAT(datum,'%d.%m.%Y')) as name 
            FROM auftrag WHERE belegnr>0 AND (name LIKE '%$term%' OR belegnr LIKE '%$term%' OR DATE_FORMAT(datum,'%Y-%m-%d') LIKE '%$term%') ORDER by belegnr LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "arbeitsnachweis":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(belegnr,' ',name,' ',DATE_FORMAT(datum,'%d.%m.%Y')) as name 
            FROM arbeitsnachweis WHERE belegnr>0 AND (name LIKE '%$term%' OR belegnr LIKE '%$term%' OR DATE_FORMAT(datum,'%Y-%m-%d') LIKE '%$term%') ORDER by belegnr LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "lieferschein":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(belegnr,' ',name,' ',DATE_FORMAT(datum,'%d.%m.%Y')) as name 
            FROM lieferschein WHERE belegnr>0 AND  (name LIKE '%$term%' OR belegnr LIKE '%$term%' OR DATE_FORMAT(datum,'%Y-%m-%d') LIKE '%$term%') ORDER by belegnr LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "rechnung":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(belegnr,' ',name,' ',DATE_FORMAT(datum,'%d.%m.%Y')) as name 
            FROM rechnung WHERE belegnr>0 AND (name LIKE '%$term%' OR belegnr LIKE '%$term%' OR DATE_FORMAT(datum,'%Y-%m-%d') LIKE '%$term%') ORDER by belegnr LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "vpeartikel":
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT vpe FROM verkaufspreise WHERE geloescht=0 AND vpe LIKE '%$term%' ORDER by vpe");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['vpe'];
        break;

      case "herstellerlink":
        $arr = $this->app->DB->SelectArr("SELECT DISTINCT herstellerlink FROM artikel WHERE geloescht=0 AND intern_gesperrt!=1 AND herstellerlink LIKE '%$term%' ORDER by herstellerlink");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['herstellerlink'];
        break;


      case "lagerplatz":
        $arr = $this->app->DB->SelectArr("SELECT kurzbezeichnung FROM lager_platz WHERE geloescht=0 AND kurzbezeichnung LIKE '%$term%' ORDER by kurzbezeichnung");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['kurzbezeichnung'];
        break;


      case "lager":
        $arr = $this->app->DB->SelectArr("SELECT bezeichnung FROM lager WHERE geloescht=0 AND bezeichnung LIKE '%$term%' ORDER by bezeichnung");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['bezeichnung'];
        break;



      case "kostenstelle":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(nummer,' ',beschreibung) as name FROM kostenstellen WHERE beschreibung LIKE '%$term%' OR nummer LIKE '%$term%' ORDER by nummer");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "verrechnungsart":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(nummer,' ',beschreibung) as name FROM verrechnungsart WHERE beschreibung LIKE '%$term%' OR nummer LIKE '%$term%' ORDER by nummer");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;


      case "artikelnummer":
        $projekt = $this->app->Secure->GetGET("projekt");
        $checkprojekt = $this->app->DB->Select("SELECT id FROM projekt WHERE id='$projekt' LIMIT 1");
        $eigenernummernkreis = $this->app->DB->Select("SELECT eigenernummernkreis FROM projekt WHERE id='$projekt' LIMIT 1");

        if($checkprojekt > 0 && $eigenernummernkreis=="1") $tmp_where = " AND projekt='$checkprojekt' ";
        else $tmp_where = "";


        $arr = $this->app->DB->SelectArr("SELECT CONCAT(nummer,' ',name_de) as name FROM artikel WHERE geloescht=0 AND  (nummer LIKE '%$term%' OR name_de LIKE '%$term%' OR nummer LIKE '%$term2%' OR name_de LIKE '%$term2%' OR nummer LIKE '%$term3%' OR name_de LIKE '%$term3%') AND geloescht=0 AND intern_gesperrt!=1 $tmp_where LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "lagerartikelnummer":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(nummer,' ',name_de) as name 
            FROM artikel WHERE (nummer LIKE '%$term%' OR name_de LIKE '%$term%' OR name_de LIKE '%$term2%' OR  name_de LIKE '%$term3%'  OR herstellernummer LIKE '%$term%' OR ean LIKE '%$term%') AND geloescht=0  AND intern_gesperrt!=1
            AND lagerartikel='1' LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

      case "artikelnummerprojekt":

        $projekt = $this->app->Secure->GetGET("projekt");
        $checkprojekt = $this->app->DB->Select("SELECT id FROM projekt WHERE id='$projekt' LIMIT 1");
        $eigenernummernkreis = $this->app->DB->Select("SELECT eigenernummernkreis FROM projekt WHERE id='$projekt' LIMIT 1");
        $eanherstellerscan = $this->app->DB->Select("SELECT eanherstellerscan FROM projekt WHERE id='$projekt'");

        if($checkprojekt > 0 && $eigenernummernkreis=="1") $tmp_where = " AND a.projekt='$checkprojekt' ";
        else $tmp_where = "";

        // besser ist wenn man die immer scannt da es oberflächen gibt wo das projekt nicht angegeben werden kann
        if(0)//$eanherstellerscan)	
        {
          $arr = $this->app->DB->SelectArr("SELECT DISTINCT CONCAT(a.nummer,' ',a.name_de,if(a.herstellernummer IS NULL OR a.herstellernummer='','',CONCAT(' PN: ',a.herstellernummer))) as name FROM artikel a WHERE a.geloescht=0 AND a.intern_gesperrt!=1 AND (a.nummer LIKE '%$term%' OR a.name_de LIKE '%$term%' OR a.herstellernummer LIKE '%$term%' OR a.ean LIKE '%$term%') $tmp_where ORDER by a.id DESC LIMIT 20");
        }
        else {
          $arr = $this->app->DB->SelectArr("SELECT DISTINCT CONCAT(a.nummer,' ',a.name_de,if(a.herstellernummer IS NULL OR a.herstellernummer='','',CONCAT(' PN: ',a.herstellernummer))) as name FROM artikel a WHERE a.geloescht=0 AND a.intern_gesperrt!=1 AND (a.nummer LIKE '%$term%' OR a.name_de LIKE '%$term%' OR a.name_de LIKE '%$term2%' OR  a.name_de LIKE '%$term3%' OR a.herstellernummer LIKE '%$term%' OR a.ean LIKE '%$term%') $tmp_where ORDER by a.id DESC LIMIT 20");

        }
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;


      case "lagerartikelnummerprojekt":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(a.nummer,' ',a.name_de,' (',p.abkuerzung,')') as name FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 AND a.porto=0 AND a.intern_gesperrt!=1  
          AND (a.nummer LIKE '%$term%' OR a.name_de LIKE '%$term%' OR a.herstellernummer LIKE '%$term%' OR a.ean LIKE '%$term%') LIMIT 20");
            for($i=0;$i<count($arr);$i++)
            $newarr[] = $arr[$i]['name'];
            break;


            case "verkaufartikelnummerprojekt":

            $projekt = $this->app->Secure->GetGET("projekt");
            $checkprojekt = $this->app->DB->Select("SELECT id FROM projekt WHERE id='$projekt' LIMIT 1");
            $eigenernummernkreis = $this->app->DB->Select("SELECT eigenernummernkreis FROM projekt WHERE id='$projekt' LIMIT 1");

            if($checkprojekt > 0 && $eigenernummernkreis=="1") $tmp_where = " AND a.projekt='$checkprojekt' ";
            else $tmp_where = "";

            $arr = $this->app->DB->SelectArr("SELECT a.id as id, CONCAT(a.nummer,' ',a.name_de,' (',p.abkuerzung,if(a.lagerartikel=1,'',''),')',if(a.herstellernummer!='',CONCAT(' (PN: ',a.herstellernummer,')'),'')) as name FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 AND a.intern_gesperrt!=1  
          AND (a.nummer LIKE '%$term%' OR a.name_de LIKE '%$term%' OR a.herstellernummer LIKE '%$term%' OR a.nummer LIKE '%$term2%' OR a.name_de LIKE '%$term2%' OR a.herstellernummer LIKE '%$term2%' OR a.nummer LIKE '%$term3%' OR a.name_de LIKE '%$term3%' OR a.herstellernummer LIKE '%$term3%' OR a.ean LIKE '%$term%' OR CONCAT(a.nummer,' ',a.name_de) LIKE '%$term%') $tmp_where LIMIT 20");
        $smodule = $this->app->Secure->GetGET("smodule");	
        $sid = $this->app->Secure->GetGET("sid");	

        $rabatt = $this->app->DB->Select("SELECT realrabatt FROM $smodule WHERE id='$sid' LIMIT 1");
        $adresse = $this->app->DB->Select("SELECT adresse FROM $smodule WHERE id='$sid' LIMIT 1");

        for($i=0;$i<count($arr);$i++)
        {

          $arr[$i]['name'] = $this->app->DB->Select("SELECT CONCAT(nummer,' ',name_de,if(herstellernummer!='',CONCAT(' (PN: ',herstellernummer,')'),'') ) FROM artikel WHERE id='".$arr[$i]['id']."' LIMIT 1");
          $keinrabatterlaubt = $this->app->DB->Select("SELECT keinrabatterlaubt FROM artikel WHERE id='".$arr[$i]['id']."' LIMIT 1");
          $checkporto = $this->app->DB->Select("SELECT porto FROM artikel WHERE id='".$arr[$i]['id']."' LIMIT 1");
          $gruppenarray = $this->app->erp->GetGruppen($adresse);

          if(count($gruppenarray)>0) $sql_erweiterung = " OR ";
          for($gi=0;$gi<count($gruppenarray);$gi++)
          {
            $sql_erweiterung .= " gruppe='".$gruppenarray[$gi]."' ";

            if($gi<count($gruppenarray)-1)
              $sql_erweiterung .= " OR ";
          }

          $vkarr = $this->app->erp->GeneratePreisliste($arr[$i]['id'],$adresse,$rabatt);

          $check_lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='".$arr[$i]['id']."' LIMIT 1");
          //$newarr[]=$arr[$i]['name']." ($label Inkl. Rabatt ".$rabatt."%: ".$this->app->erp->Rabatt($arr[$i]['preis'],$rabatt).")";
          if($this->app->erp->LagerFreieMenge($arr[$i]['id']) <= 0 && $check_lagerartikel) $lager=" (Aktuell kein Lagerbestand) "; else $lager="";

          for($vi=0;$vi<count($vkarr);$vi++)
          {
            $tmprabatt = $rabatt;
            if($vkarr[$vi][art]=="Kunde" && ($vkarr[$vi][adresse]<=0 || $vkarr[$vi][adresse]==""))
              $vkarr[$vi][art]="Standardpreis";

            $preis = 0;
            if($letzte_menge !=$vkarr[$vi][ab_menge])
            {
              if($keinrabatterlaubt=="1" || $checkporto=="1")
              {
                $preis = $vkarr[$vi][preis]; //$this->app->erp->GetVerkaufspreis($arr[$i]['id'],$vkarr[$vi][ab_menge],$adresse);

                $newarr[]=$arr[$i]['name']." $lager ab Menge ".$vkarr[$vi][ab_menge]." | Preis: ".$preis.
                  " (".$vkarr[$vi][art]." - Kein Rabatt erlaubt) ";

              } else {
                if($this->app->erp->IsSpezialVerkaufspreis($arr[$i]['id'],$vkarr[$vi][ab_menge],$adresse))
                {
                  $tmprabatt=0;
                  $rabatt_string = " - Kein Rabatt auf Spezialpreis";
                  $uvp_string = "(UVP: ".$this->app->erp->GetVerkaufspreis($arr[$i]['id'],$vkarr[$vi][ab_menge],$adresse).") ";
                } else {
                  if($tmprabatt > 0) {
                    $rabatt_string = " Inkl. Rabatt ".$tmprabatt."%"; 
                    $uvp_string = "(UVP: ".$this->app->erp->GetVerkaufspreis($arr[$i]['id'],$vkarr[$vi][ab_menge],$adresse).") ";
                  } else {
                    $rabatt_string = "";
                    $uvp_string = "";
                  }
                }
                $preis = $vkarr[$vi][preis]; //$this->app->erp->GetVerkaufspreis($arr[$i]['id'],$vkarr[$vi][ab_menge],$adresse);
                //$preis = $this->app->erp->Rabatt($this->app->erp->GetVerkaufspreis($arr[$i]['id'],$vkarr[$vi][ab_menge],$adresse),$tmprabatt);


                $newarr[]=$arr[$i]['name']." $lager ab Menge ".$vkarr[$vi][ab_menge]." | Preis: ".$preis.
                  " $uvp_string(".$vkarr[$vi][art].$rabatt_string.") ";
              }
            }
          }	

          if($vi==0)
          {
            $rabattartikel = $this->app->DB->Select("SELECT rabatt FROM artikel WHERE id='".$arr[$i]['id']."' LIMIT 1");
            $rabattartikel_prozent = $this->app->DB->Select("SELECT rabatt_prozent FROM artikel WHERE id='".$arr[$i]['id']."' LIMIT 1");
            $arr[$i]['name'] = $this->app->DB->Select("SELECT CONCAT(nummer,' ',name_de,if(herstellernummer!='',CONCAT(' (PN: ',herstellernummer,')'),'')) FROM artikel WHERE id='".$arr[$i]['id']."' LIMIT 1");

            if($rabattartikel=="1")
              $newarr[] = $arr[$i]['name']." $lager ab Menge 1 | Preis: $rabattartikel_prozent% Rabatt auf Gesamtsumme ohne Porto";
            else {
              $preis = $this->app->erp->GetVerkaufspreis($arr[$i]['id'],1,$adresse);
              if($preis > 0)
                $newarr[] = $arr[$i]['name']." $lager ab Menge 1 | Preis: $preis";
              else
                $newarr[] = $arr[$i]['name']." $lager ab Menge 1 | Preis: nicht vorhanden";
            }
          }
        }
        break;

            case "einkaufartikelnummerprojekt":
        $adresse = $this->app->Secure->GetGET("adresse");

        $arr = $this->app->DB->SelectArr("SELECT CONCAT(a.nummer,' ', a.name_de,' | Bezeichnung bei Lieferant ',IFNULL(e.bestellnummer,'nicht vorhanden'),' ',LEFT(IFNULL(e.bezeichnunglieferant,'nicht vorhanden'),50),' | ',' ab Menge ',IFNULL(e.ab_menge,1), ' | Preis ',IFNULL(e.preis,0)) as name FROM artikel a 
            LEFT JOIN projekt p ON p.id=a.projekt LEFT JOIN einkaufspreise e ON e.artikel=a.id WHERE a.geloescht=0 AND a.intern_gesperrt!=1 AND (((e.gueltig_bis > NOW() OR e.gueltig_bis='0000-00-00') AND e.adresse='$adresse') OR a.allelieferanten=1)
            AND (a.nummer LIKE '%$term%' OR a.name_de LIKE '%$term%' OR a.name_de LIKE '%$term2%' OR a.name_de LIKE '%$term3%') GROUP by a.nummer, e.ab_menge LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

            case "lieferantname":
        $arr = $this->app->DB->SelectArr("SELECT name FROM adresse WHERE geloescht=0 AND a.lieferantennummer!='' AND a.lieferantennummer!='0' AND (name LIKE '%$term%' OR name LIKE '%$term2%' OR name LIKE '%$term3%') order by name LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

            case "lieferant":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(a.lieferantennummer,' ',a.name) as name FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 AND a.lieferantennummer!='' AND lieferantennummer!='0' AND (a.name LIKE '%$term%' OR a.lieferantennummer LIKE '%$term%' OR a.name LIKE '%$term2%' OR a.name LIKE '%$term3%') ".$this->app->erp->ProjektRechte()." order by a.name LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;


            case "adresse":
        $arr = $this->app->DB->SelectArr("SELECT if(a.lieferantennummer,CONCAT(a.id,' ',a.name,' (Kdr: ',a.kundennummer,' Liefr: ',a.lieferantennummer,')'),CONCAT(a.id,' ',a.name,' (Kdr: ',a.kundennummer,')')) as name FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 AND (a.name LIKE '%$term%' OR a.kundennummer LIKE '%$term%' OR a.lieferantennummer LIKE '%$term%' OR a.name LIKE '%$term2%' OR a.name LIKE '%$term3%') ".$this->app->erp->ProjektRechte()." order by a.name LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

       case "kundepos":
        if($this->app->erp->Firmendaten("adresse_freitext1_suche"))
        {
          $arr = $this->app->DB->SelectArr("SELECT CONCAT(a.kundennummer,' ',a.name,if(a.projekt > 0,CONCAT(' (',p.abkuerzung,')'),''),if(a.freifeld1!='',CONCAT(' (',a.freifeld1,')'),'')) as name FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 AND a.kundennummer!='' AND a.kundennummer!='0' AND (a.name LIKE '%$term%' OR a.kundennummer LIKE '%$term%' OR a.freifeld1 LIKE '%$term%' OR a.plz LIKE '%$term%' OR a.name LIKE '%$term2%' OR a.name LIKE '%$term3%' OR a.ansprechpartner LIKE '%$term%' OR a.ansprechpartner LIKE '%$term2%' OR a.ansprechpartner LIKE '%$term3%') order by name LIMIT 20");
        } else {
          $arr = $this->app->DB->SelectArr("SELECT CONCAT(a.kundennummer,' ',a.name,if(a.projekt > 0,CONCAT(' (',p.abkuerzung,')'),'')) as name FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 AND a.kundennummer!='' AND a.kundennummer!='0'   AND (a.name LIKE '%$term%' OR a.kundennummer LIKE '%$term%' OR a.name LIKE '%$term2%' OR a.name LIKE '%$term3%' OR a.ansprechpartner LIKE '%$term%' OR a.ansprechpartner LIKE '%$term2%' OR a.ansprechpartner LIKE '%$term3%') order by name LIMIT 20");
        }
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;



            case "kunde":
        if($this->app->erp->Firmendaten("adresse_freitext1_suche"))
        {
          $arr = $this->app->DB->SelectArr("SELECT CONCAT(a.kundennummer,' ',a.name,if(a.freifeld1!='',CONCAT(' (',a.freifeld1,')'),'')) as name FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 AND a.kundennummer!='' AND a.kundennummer!='0' AND (a.name LIKE '%$term%' OR a.kundennummer LIKE '%$term%' OR a.freifeld1 LIKE '%$term%' OR a.plz LIKE '%$term%' OR a.name LIKE '%$term2%' OR a.name LIKE '%$term3%') ".$this->app->erp->ProjektRechte()." order by name LIMIT 20");
        } else {
          $arr = $this->app->DB->SelectArr("SELECT CONCAT(a.kundennummer,' ',a.name) as name FROM adresse a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht=0 AND a.kundennummer!='' AND a.kundennummer!='0'   AND (a.name LIKE '%$term%' OR a.kundennummer LIKE '%$term%' OR a.name LIKE '%$term2%' OR a.name LIKE '%$term3%') ".$this->app->erp->ProjektRechte()." order by name LIMIT 20");
        }
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

            case "mitarbeiter":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(mitarbeiternummer,' ',name) as name FROM adresse WHERE geloescht=0 AND mitarbeiternummer!='' AND mitarbeiternummer!='0' AND (name LIKE '%$term%' OR mitarbeiternummer LIKE '%$term%') order by name LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

            case "mitarbeitername":
        $arr = $this->app->DB->SelectArr("SELECT name FROM adresse WHERE geloescht=0 AND mitarbeiternummer!='' AND mitarbeiternummer!='0' AND (name LIKE '%$term%' OR mitarbeiternummer LIKE '%$term%') order by name LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;
        
        case "emailadresse":
        if(strpos($term,',')!==false)
        {
          $term = substr($term,strripos($term,','));
          $term = str_replace(',','',$term);
        }
        
        $subwhere1 = '';
        $subwhere2 = '';
        if($this->app->Secure->GetGET('kundennummer'))
        {
          $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer like '".$this->app->Secure->GetGET('kundennummer')."' LIMIT 1");
          if($adresse)
          {
            $subwhere1 .= " AND adresse = '$adresse' ";
            $subwhere2 .= " AND id = '$adresse' ";
          }
        }

        $arr = $this->app->DB->SelectArr("SELECT email FROM ansprechpartner WHERE (name LIKE '%$term%' OR email LIKE '%$term%') and email <> '' $subwhere1 order by name LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['email'];
        $arr = $this->app->DB->SelectArr("SELECT email  FROM adresse WHERE (name LIKE '%$term%' OR email LIKE '%$term%') and email <> '' AND geloescht!='1' $subwhere2 order by name LIMIT 20");

        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['email'];

        $newarr = array_unique($newarr); 
        sort($newarr);
        break;


            case "emailname":
        if(strpos($term,',')!==false)
        {
          $term = substr($term,strripos($term,','));
          $term = str_replace(',','',$term);
        }

        $arr = $this->app->DB->SelectArr("SELECT CONCAT(name,' <',email,'>') as name FROM ansprechpartner WHERE (name LIKE '%$term%' OR email LIKE '%$term%') order by name LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];


        $arr = $this->app->DB->SelectArr("SELECT CONCAT(name,' <',email,'>') as name FROM adresse WHERE (name LIKE '%$term%' OR email LIKE '%$term%') AND geloescht!='1' order by name LIMIT 20");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];

        $newarr = array_unique($newarr); 
        sort($newarr); 
        break;

            case "shopname":
        $arr = $this->app->DB->SelectArr("SELECT bezeichnung FROM shopexport WHERE bezeichnung LIKE '%$term%'");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['bezeichnung'];
        break;

            case "gruppekennziffer":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(g.kennziffer,' ',g.name) as bezeichnung FROM gruppen g LEFT JOIN projekt p ON p.id=g.projekt  
          WHERE (g.name LIKE '%$term%' OR g.kennziffer LIKE '%$term%') ".$this->app->erp->ProjektRechte());
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['bezeichnung'];
        break;

            case "gruppe":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(g.name,' ',g.kennziffer) as bezeichnung FROM gruppen g 
          LEFT JOIN projekt p ON p.id=g.projekt WHERE (g.name LIKE '%$term%' OR g.kennziffer LIKE '%$term%') ".$this->app->erp->ProjektRechte());
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['bezeichnung'];
        break;

            case "verband":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(name,' ',kennziffer) as bezeichnung FROM gruppen WHERE (name LIKE '%$term%' OR kennziffer LIKE '%$term%') AND art='verband'");
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['bezeichnung'];
        break;

            case "projektname":
        $arr = $this->app->DB->SelectArr("SELECT CONCAT(p.abkuerzung,' ',p.name) as name FROM projekt p WHERE p.geloescht=0 AND (p.name LIKE '%$term%' OR p.abkuerzung LIKE '%$term%') ".$this->app->erp->ProjektRechte());
        for($i=0;$i<count($arr);$i++)
          $newarr[] = $arr[$i]['name'];
        break;

            default: ;
    }

    for($i=0;$i<count($newarr);$i++)
      $tmp[] = $this->app->erp->ClearDataBeforeOutput(html_entity_decode($newarr[$i], ENT_QUOTES, 'UTF-8'));


    echo json_encode($tmp);
    exit;
  }

  function AjaxTablePosition()
  {

    $iDisplayStart = $this->app->Secure->GetGET("iDisplayStart");
    $iDisplayLength = $this->app->Secure->GetGET("iDisplayLength");
    $iSortCol_0 = $this->app->Secure->GetGET("iSortCol_0");
    $iSortingCols = $this->app->Secure->GetGET("iSortingCols");
    $sSearch = $this->app->Secure->GetGET("sSearch");
    $sEcho = $this->app->Secure->GetGET("sEcho");
    $cmd = $this->app->Secure->GetGET("cmd");


    $sLimit = "";
    if ( isset($iDisplayStart) )
    {

      $sLimit = "LIMIT ".mysqli_real_escape_string($this->app->DB->connection, $iDisplayStart ).", ".
        mysqli_real_escape_string($this->app->DB->connection, $iDisplayLength );
    }

    /* Ordering */
    if ( isset( $iSortCol_0 ) )
    {
      $sOrder = "ORDER BY  ";
      for ( $i=0 ; $i<mysqli_real_escape_string($this->app->DB->connection, $iSortingCols ) ; $i++ )
      {
        $iSortingCols_tmp = $this->app->Secure->GetGET("iSortCol_".$i);
        $sSortDir_tmp = $this->app->Secure->GetGET("sSortDir_".$i);

        $sOrder .= $this->fnColumnToFieldPosition(mysqli_real_escape_string($this->app->DB->connection, $iSortingCols_tmp ))."
          ".mysqli_real_escape_string($this->app->DB->connection, $sSortDir_tmp ) .", ";
      }
      $sOrder = substr_replace( $sOrder, "", -2 );
    }

    /* Filtering - NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables, and MySQL's regex functionality is very limited
     */


    $sWhere = "";
    $where = $this->app->YUI->TablePositionSearch("",$cmd,"where");
    if ( $sSearch != "" )
    {
      $searchsql = $this->app->YUI->TablePositionSearch("",$cmd,"searchsql");

      if($where=="")
        $sWhere = " WHERE (";
      else
      {
        if(count($searchsql) >0)
          $sWhere = " WHERE $where AND (";
        else
          $sWhere = " WHERE $where ";
      }

      
      for($i=0;$i<count($searchsql)-1;$i++)
      {
        $sWhere .= $searchsql[$i]." LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch )."%' OR ";	
      }
      $sWhere .= $searchsql[$i]." LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch )."%')";	

    
    } else {
      if($where!="")
        $sWhere = " WHERE $where ";
    } 

   
    $searchfulltext = $this->app->YUI->TablePositionSearch("",$cmd,"searchfulltext");
    if($searchfulltext!="" && $sSearch!="")
    {
      $searchfulltext = " MATCH(".$searchfulltext.") AGAINST ('$sSearch') ";	
      if($sWhere=="")
        $sWhere = " WHERE $searchfulltext ";
      else 
        $sWhere .= "AND $searchfulltext ";
    }
    $tmp = $this->app->YUI->TablePositionSearch("",$cmd,"sql");


    $sQuery = "
      $tmp
      $sWhere 
      $sOrder
      $sLimit
      ";


    $rResult = mysqli_query($this->app->DB->connection, $sQuery);



    $sQuery = "
      SELECT FOUND_ROWS()
      ";
    $rResultFilterTotal = mysqli_query($this->app->DB->connection, $sQuery);
    $aResultFilterTotal = mysqli_fetch_array($this->app->DB->connection,$rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal[0];

    /*    
          $sQuery = "
          SELECT COUNT(id)
          FROM   artikel
          ";
     */
    $sQuery = $this->app->YUI->TablePositionSearch("",$cmd,"count");
    $rResultTotal = mysqli_query($this->app->DB->connection,$sQuery);
    $aResultTotal = mysqli_fetch_array($this->app->DB->connection,$rResultTotal);
    $iTotal = $aResultTotal[0];


    $heading = count($this->app->YUI->TablePositionSearch("",$cmd,"heading"));
    $menu = $this->app->YUI->TablePositionSearch("",$cmd,"menu");

    $sOutput = '{';
    $sOutput .= '"sEcho": '.intval($sEcho).', ';
    $sOutput .= '"iTotalRecords": '.$iTotal.', ';
    $sOutput .= '"iTotalDisplayRecords": '.$iFilteredTotal.', ';
    $sOutput .= '"aaData": [ ';
    while ( $aRow = mysqli_fetch_array($this->app->DB->connection, $rResult ) )
    {
      $sOutput .= "[";
      for($i=1;$i<$heading;$i++) 
        $sOutput .= '"'.addslashes($aRow[$i]).'",';

      $sOutput .= '"'.addslashes(str_replace('%value%',$aRow[$i],$menu)).'"';

      $sOutput .= "],";

    }
    $sOutput = substr_replace( $sOutput, "", -1 );
    $sOutput .= '] }';

    $sOutput = str_replace("\t","",$sOutput); 

    echo $this->app->erp->ClearDataBeforeOutput($sOutput);
    exit;
  }

  function AjaxTable()
  {
    $iDisplayStart = $this->app->Secure->GetGET("iDisplayStart");
    $iDisplayLength = $this->app->Secure->GetGET("iDisplayLength");
    $iSortCol_0 = $this->app->Secure->GetGET("iSortCol_0");
    $sSortDir_0  = $this->app->Secure->GetGET("sSortDir_0");
    $iSortingCols = $this->app->Secure->GetGET("iSortingCols");
    $sSearch = $this->app->Secure->GetGET("sSearch");
    $sEcho = $this->app->Secure->GetGET("sEcho");
    $cmd = $this->app->Secure->GetGET("cmd");
    $frommodule = $this->app->Secure->GetGET("frommodule");
    $fromclass = $this->app->Secure->GetGET("fromclass");
    $sSearch = trim($sSearch);
    $sSearch2 = $sSearch;
    $sSearch3 = $this->app->erp->ConvertForDB($sSearch);
    $sSearch = $this->app->erp->ConvertForDBUTF8($sSearch);

    $sLimit = "";
    if ( isset($iDisplayStart) )
    {
      $sLimit = "LIMIT ".mysqli_real_escape_string($this->app->DB->connection, $iDisplayStart ).", ".
        mysqli_real_escape_string($this->app->DB->connection, $iDisplayLength );
    }
    /* Ordering */
    $cmd = $this->app->Secure->GetGET("cmd");

    // check if is allowed
    if(!$this->app->erp->TableSearchAllowed($cmd)) 
    {
      $this->app->erp->Protokoll("Nicht erlaubter Zugriff auf $cmd von Benutzer ".$this->app->User->GetName());
      exit;
    }
  


    $findcolstmp = $this->app->YUI->TableSearch("",$cmd,"findcols","","",$frommodule, $fromclass);
    $moreinfo = $this->app->YUI->TableSearch("",$cmd,"moreinfo","","",$frommodule, $fromclass);

    if (isset( $iSortCol_0 ) && $sEcho > 1)
    {
      $sOrder = "ORDER BY  ";
      //	if($iSortCol_0 <=1)

      if($moreinfo)
      {
        if($iSortCol_0 <1)
          goto default_sort;
        else
          $iSortCol_0 = $iSortCol_0 + 2;
      } else {
        $iSortCol_0 = $iSortCol_0 + 2;

      }
      $sOrder = "ORDER BY ".$findcolstmp[$iSortCol_0-2]." $sSortDir_0";
    }
    else
    {
  default_sort:
      //standard einstellung nach datum absteigend wenn datumsspalte vorhanden
      $defaultorder = $this->app->YUI->TableSearch("",$cmd,"defaultorder","","",$frommodule, $fromclass);
      $defaultorderdesc = $this->app->YUI->TableSearch("",$cmd,"defaultorderdesc","","",$frommodule, $fromclass);
      if($defaultorder<=0) { $defaultorder = count($findcolstmp); $defaultorderdesc = 1;}

      if($defaultorderdesc=="1") $defaultorderdesc = " DESC"; else $defaultorderdesc="";


      if($defaultorder >=0 && is_numeric($defaultorder))
      {
        $defaultorder = $defaultorder + 1;
        $findcolstmp = $this->app->YUI->TableSearch("",$cmd,"findcols","","",$frommodule, $fromclass);

        $sOrder = "ORDER BY ".$findcolstmp[$defaultorder-2]." $defaultorderdesc";
      } 
    }




    /* Filtering - NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables, and MySQL's regex functionality is very limited
     */
    //echo "FUUUU";

    $sWhere = "";
    $where = $this->app->YUI->TableSearch("",$cmd,"where","","",$frommodule, $fromclass);
    //echo $where;
    if ( $sSearch != "" )
    {
      /*
         $sWhere = "WHERE a.nummer LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch )."%' OR ".
         "p.abkuerzung LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch )."%' OR ".
         "a.name_de LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch )."%'";
       */
      $searchsql = $this->app->YUI->TableSearch("",$cmd,"searchsql","","",$frommodule, $fromclass);

      if($where=="")
        $sWhere = " WHERE (";
      else
      {
        if(count($searchsql) > 0)
          $sWhere = " WHERE $where AND (";
        else
          $sWhere = " WHERE $where ";
      }

      // Prozent austauschen da dies mysql wildcat ist
      $sSearch = str_replace('&#37;','%',$sSearch);
      $sSearch = str_replace(' ','%',$sSearch);
      $sSearch2 = str_replace('&#37;','%',$sSearch2);
      $sSearch2 = str_replace(' ','%',$sSearch2);
      //$sSearch3 = str_replace('&#37;','%',$sSearch3);
      //$sSearch3 = str_replace(' ','%',$sSearch3);

      for($i=0;$i<count($searchsql)-1;$i++)
      {
        $sWhere .= "({$searchsql[$i]} LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch )."%' OR {$searchsql[$i]} LIKE '%".$this->app->erp->ConvertForTableSearch( $sSearch )."%' ) ";

        if($sSearch2!="")
          $sWhere .=" OR ({$searchsql[$i]} LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch2 )."%' OR {$searchsql[$i]} LIKE '%".$this->app->erp->ConvertForTableSearch( $sSearch2 )."%' ) ";

        if($sSearch3!="")
          $sWhere .= "OR ({$searchsql[$i]} LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch3 )."%' OR {$searchsql[$i]} LIKE '%".$this->app->erp->ConvertForTableSearch( $sSearch3 )."%' ) OR ";
        else $sWhere .= " OR ";

      }

      $searchfulltext = $this->app->YUI->TableSearch("",$cmd,"searchfulltext","","",$frommodule, $fromclass);
      if($searchfulltext!="" && $sSearch!="")
      {
        $sSearch = str_replace("&quot;",'"',$sSearch);
        $sSearch .= "*";
        $searchfulltext = ' MATCH(e.subject,e.sender,e.action,e.action_html) AGAINST (\''.$this->app->erp->ConvertForTableSearch($sSearch).'\' IN BOOLEAN MODE ) ';
      }
      if(count($searchsql) > 0){
        if($searchfulltext!="") $searchfulltext = " OR ".$searchfulltext;
        $sWhere .= "( {$searchsql[$i]} LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch )."%' OR {$searchsql[$i]} LIKE '%".$this->app->erp->ConvertForTableSearch( $sSearch )."%')     $searchfulltext           )";

      } else {
        $sWhere .= " AND $searchfulltext";

      }

    } else {
      if($where!="")
        $sWhere = " WHERE $where ";
    } 


    $searchsql = $this->app->YUI->TableSearch("",$cmd,"searchsql","","",$frommodule, $fromclass);
    $moreinfo = $this->app->YUI->TableSearch("",$cmd,"moreinfo","","",$frommodule, $fromclass);
    if($moreinfo) $offset = 1; else $offset=0;

    for($isearch=0;$isearch<count($searchsql);$isearch++)
    {
      $sSearch = $this->app->Secure->GetGET("sSearch_".$isearch);
      if($sSearch!="" && $sSearch!="A")
      { 
        if($sWhere=="")
				{
					if($searchsql[$isearch-$offset]!="")
        		$sWhere = "WHERE ".$searchsql[$isearch-$offset]." LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch )."%'";
				}
        else
				{
					if($searchsql[$isearch-$offset]!="")
        		$sWhere = "$sWhere AND (".$searchsql[$isearch-$offset]." LIKE '%".mysqli_real_escape_string($this->app->DB->connection, $sSearch )."%')";
				}
      }
    }



    $tmp = $this->app->YUI->TableSearch("",$cmd,"sql","","",$frommodule, $fromclass);
    $groupby = $this->app->YUI->TableSearch("",$cmd,"groupby","","",$frommodule, $fromclass);
    $orderby = $this->app->YUI->TableSearch("",$cmd,"orderby","","",$frommodule, $fromclass);
    if($orderby)$sOrder = $orderby;
    //$sQuery = $sWhere." ".$sOrder." ". $sLimit;

    $sQuery = "
      $tmp
      $sWhere 
      $groupby
      $sOrder
      $sLimit
      ";

    //SELECT * FROM emailbackup_mails e WHERE  MATCH(e.subject,e.sender,e.action,e.action_html) AGAINST ("+vetter" IN BOOLEAN MODE) 
    // TABLEOUT BENE
     //echo $sQuery;
     //exit;
    $rResult = $this->app->DB->Query( $sQuery);

    $sQuery = "
      SELECT FOUND_ROWS()
      ";
    $rResultFilterTotal = $this->app->DB->Query( $sQuery);
    $aResultFilterTotal = $this->app->DB->Fetch_Array($rResultFilterTotal);
    $iFilteredTotal = $aResultFilterTotal[0];

    /*    
          $sQuery = "
          SELECT COUNT(id)
          FROM   artikel
          ";
     */
    $sQuery = $this->app->YUI->TableSearch("",$cmd,"count","","",$frommodule, $fromclass);


    $rResultTotal = $this->app->DB->Query( $sQuery);
    $aResultTotal = $this->app->DB->Fetch_Array($rResultTotal);
    $iTotal = $aResultTotal[0];


    $heading = count($this->app->YUI->TableSearch("",$cmd,"heading","","",$frommodule, $fromclass));
    $menu = $this->app->YUI->TableSearch("",$cmd,"menu","","",$frommodule, $fromclass);

    $sOutput = '{';
    $sOutput .= '"sEcho": '.intval($sEcho).', ';
    $sOutput .= '"iTotalRecords": '.$iTotal.', ';
    $sOutput .= '"iTotalDisplayRecords": '.$iFilteredTotal.', ';
    $sOutput .= '"aaData": [ ';
    while ( $aRow = $this->app->DB->Fetch_Array( $rResult ) )
    {
      $sOutput .= "[";
      for($i=1;$i<$heading;$i++) 
      {
        $aRow[$i] = trim(str_replace("'","",$aRow[$i]));
        $aRow[$i] = str_replace("\r","",$aRow[$i]);
        $aRow[$i] = str_replace("\n","",$aRow[$i]);
        $sOutput .= '"'.addslashes($aRow[$i]).'",';
      }

      $sOutput .= '"'.addslashes(str_replace('%value%',$aRow[$i],$menu)).'"';

      $sOutput .= "],";

    }
    $sOutput = substr_replace( $sOutput, "", -1 );
    $sOutput .= '] }';

    $sOutput = str_replace("\t","",$sOutput); 

    // Eventuell deutsches Datumsformat in allen Tabellen und sortieren geht auch
    $repl =    preg_replace('~([1-2]{1}\d{3})-(\d{2})-(\d{2})~', '<!--$1-%s-%3--> $3.$2.$1', $sOutput);
    //$repl = preg_replace('~\"(\d{4})-(\d{2})-(\d{2})\"~', '"<!--$1-%s-%3-->$3.$2.$1"', $sOutput);	

    $repl = $this->app->erp->ClearDataBeforeOutput($repl);
    echo $repl;
    exit;

    }

  function fnColumnToFieldPosition( $i )
  {
    $cmd = $this->app->Secure->GetGET("cmd");
    $findcols = $this->app->YUI->TablePositionSearch("",$cmd,"findcols");

    return $findcols[$i];
  }

  function fnColumnToField( $i )
  {
    $cmd = $this->app->Secure->GetGET("cmd");
    $frommodule = $this->app->Secure->GetGET("frommodule");
    $fromclass = $this->app->Secure->GetGET("fromclass");
    $findcols = $this->app->YUI->TableSearch("",$cmd,"findcols","","",$frommodule, $fromclass);

    return $findcols[$i];

    if ( $i == 0 )
      return "nummer";
    else if ( $i == 1 )
      return "name_de";
    else if ( $i == 2 )
      return "projekt";
    else if ( $i == 3 )
      return "id";

  }




  }

?>
