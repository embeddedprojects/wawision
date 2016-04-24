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

class Shopimport 
{

  function Shopimport(&$app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("login","ShopimportLogin");
    $this->app->ActionHandler("main","ShopimportMain");
    $this->app->ActionHandler("list","ShopimportList");
    $this->app->ActionHandler("alle","ShopimportAlle");
    $this->app->ActionHandler("import","ShopimportImport");
    $this->app->ActionHandler("navigation","ShopimportNavigation");
    $this->app->ActionHandler("logout","ShopimportLogout");
    $this->app->ActionHandler("archiv","ShopimportArchiv");

    $this->app->DefaultActionHandler("list");


    $this->app->Tpl->Set('UEBERSCHRIFT',"Shop Import");
    $this->app->ActionHandlerListen($app);
  }

  function ShopimportList()
  {
    $msg = $this->app->Secure->GetGET("msg");
    if($msg!="")
    { 
      $msg = base64_decode($msg);
      $this->app->Tpl->Set('MESSAGE',$msg);
    }
    $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=uebersicht","Zur&uuml;ck zur &Uuml;bersicht");

    //$this->app->Tpl->Add(TABS,"<li><h2 style=\"background-color: [FARBE5];\">Shopimport</h2></li>");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Shopimport");
    $this->app->erp->MenuEintrag("index.php?module=shopimport&action=alle","Alle importieren");
    //$this->app->Tpl->Set('SUBHEADING',"Imports");
    //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");
    $table = new EasyTable($this->app);
    $table->Query("SELECT ae.bezeichnung,p.abkuerzung, 
        ae.id FROM shopexport ae LEFT JOIN projekt p ON p.id=ae.projekt WHERE ae.aktiv='1'");
    $table->DisplayNew('INHALT',"<a href=\"index.php?module=shopimport&action=import&id=%value%\">Import</a>&nbsp;<!--<a href=\"index.php?module=shopimport&action=archiv&id=%value%\">Archiv</a>-->");
    $this->app->Tpl->Parse('TAB1',"rahmen.tpl");
    $this->app->Tpl->Set('INHALT',"");


    // Archiv GESTERN
    $table = new EasyTable($this->app);
    $table->Query("SELECT a.datum, a.internet, a.transaktionsnummer,a.name,  a.land, a.gesamtsumme as betrag, (SELECT SUM(r.soll) FROM rechnung r WHERE r.adresse=a.adresse AND r.status='offen') as mahnwesen, a.zahlungsweise, a.partnerid as Partner, a.id FROM auftrag a WHERE 
        (datum=DATE_FORMAT( DATE_SUB( NOW() , INTERVAL 1 DAY ) , '%Y-%m-%d' ) OR (datum=DATE_FORMAT( NOW(), '%Y-%m-%d' ))) AND a.internet>0 
        ORDER by a.id DESC");
    $table->DisplayNew('INHALT',"<a href=\"index.php?module=auftrag&action=edit&id=%value%\" target=\"_blank\"><img src=\"./themes/".$this->app->Conf->WFconf['defaulttheme']."/images/edit.png\"></a>
        <a href=\"index.php?module=auftrag&action=pdf&id=%value%\"><img src=\"./themes/".$this->app->Conf->WFconf['defaulttheme']."/images/pdf.png\"></a>");

    $this->app->Tpl->Parse('TAB2',"rahmen.tpl");
    $this->app->Tpl->Set('INHALT',"");


    $summe_heute = $this->app->DB->Select("SELECT SUM(a.gesamtsumme) FROM auftrag a WHERE 
        a.datum=DATE_FORMAT( NOW(), '%Y-%m-%d' ) AND a.internet>0 
        ");

    $summe_gestern = $this->app->DB->Select("SELECT SUM(a.gesamtsumme) FROM auftrag a WHERE 
        a.datum=DATE_FORMAT( DATE_SUB( NOW() , INTERVAL 1 DAY ) , '%Y-%m-%d' ) AND a.internet>0 
        ");

    $this->app->Tpl->Add('TAB2',"<div class=\"warning\">Heute: $summe_heute EUR (inkl. Steuer und Versand) <i>Umsatz aus den Online-Shop</i></div>");
    $this->app->Tpl->Add('TAB2',"<div class=\"warning\">Gestern: $summe_gestern EUR (inkl. Steuer und Versand) <i>Umsatz aus den Online-Shop</i></div>");

    $this->app->Tpl->Set('SUBHEADING',"");
    $this->app->Tpl->Parse('PAGE',"shopimport_list.tpl");
  }


  function ShopimportArchiv()
  {
    $id = $this->app->Secure->GetGET("id");
    $more = $this->app->Secure->GetGET("more");
    $datum = $this->app->Secure->GetGET("datum");

    $this->app->Tpl->Set('TABTEXT',"Shopimport - Archiv");


    //$this->app->YUI->TableSearch('TAB1',"shopimportarchiv");

    //$this->app->Tpl->Set('TAB1',"Shopimport - Archiv");

    if($datum=="") $datum = date('Y-m-d');

    $result = $this->app->DB->SelectArr("SELECT * FROM shopimport_auftraege WHERE DATE_FORMAT(logdatei,'%Y-%m-%d') = '$datum'");


    $table = "<table border=\"1\" width=\"100%\">";

    if(is_array($result))
    {
      foreach($result as $key=>$row)
      {
        //$table = $row['imported'];
        $warenkorb = unserialize(base64_decode($row['warenkorb']));


        $table .= "<tr><td>".$warenkorb["onlinebestellnummer"]."/".$warenkorb["transaktionsnummer"]."</td><td>".$warenkorb["name"]."</td><td>".$warenkorb["email"]."</td><td>".$warenkorb["gesamtsumme"]."</td><td>
          <a href=\"index.php?module=shopimport&action=archiv&id=$id&more=".$row['id']."&datum=$datum\">mehr Informationen</a></td></tr>";

      }	
    }

    $table .= "</table>";

    if($more > 0)
    {
      $result = $this->app->DB->Select("SELECT warenkorb FROM shopimport_auftraege WHERE id='$more' LIMIT 1");

      $warenkorb = unserialize(base64_decode($result));

      ob_start();
      var_dump($warenkorb);
      $var_dump_result = ob_get_clean();

      $table .="<pre>".$var_dump_result."</pre>";



    }



    $this->app->Tpl->Set('TAB1',$table);




    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }


  function ShopimportAlle()
  {
    $lastshop = false;
    $shops = $this->app->DB->SelectArr("SELECT ae.id as id FROM shopexport ae LEFT JOIN projekt p ON p.id=ae.projekt WHERE ae.aktiv='1' and ae.demomodus <> '1'");
    if($shops)
    {
      $anz = 0;
      $fp = $this->app->erp->ProzessLock("shopimport_alle");
      for($i=0;$i<count($shops)-1;$i++)
      {
        $anz += $this->ShopimportImport($shops[$i]['id'],$anz,true);
      }
      $lastshop=$shops[count($shops)-1]['id'];
      $this->app->erp->ProzessUnlock($fp);
    }
    if($lastshop && is_numeric($lastshop))
      header("Location: index.php?module=shopimport&action=import&id=$lastshop");
    else
      header("Location: index.php?module=shopimport&action=list");
    exit;
  }


  function ShopimportImport($id="", $count = 0, $returncount = false)
  {
    if(!is_numeric($id))
      $id = $this->app->Secure->GetGET("id");

    $projekt = $this->app->DB->Select("SELECT projekt FROM shopexport WHERE id='$id'");
    $demomodus = $this->app->DB->Select("SELECT demomodus FROM shopexport WHERE id='$id'");
    $einzelsync = $this->app->DB->Select("SELECT einzelsync FROM shopexport WHERE id='$id'");
    $utf8codierung = $this->app->DB->Select("SELECT utf8codierung FROM shopexport WHERE id='$id'");

    if(!$returncount)
    {
      $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Shopimport");
      $this->app->erp->MenuEintrag("index.php?module=shopimport&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    }
    //name, strasse, ort, plz und kundenummer, emailadresse  oder bestellung kam von login account ==> Kunde aus DB verwenden
    //ACHTUNG Lieferadresse immer aus Auftrag!!! aber Lieferadresse extra bei Kunden anlegen 
    if($this->app->Secure->GetPOST("submit")!="")
    {
      $auftraege = $this->app->Secure->GetPOST("auftrag");
      $kundennummer = $this->app->Secure->GetPOST("kundennummer");
      $import= $this->app->Secure->GetPOST("import");
      $import_kundennummer= $this->app->Secure->GetPOST("import_kundennummer");

      $sucess_import = 0;
      $unbekanntezahlungsweisen = false;
      for($i=0;$i<count($auftraege);$i++)
      {
        $adresse = "";
        $shopimportid =  $auftraege[$i];
        $shopid = $this->app->DB->Select("SELECT shopid FROM shopimport_auftraege WHERE id='$shopimportid' LIMIT 1");
        if($shopid)
        {
          $demomodus = $this->app->DB->Select("SELECT demomodus FROM shopexport WHERE id='$shopid'");
          $einzelsync = $this->app->DB->Select("SELECT einzelsync FROM shopexport WHERE id='$shopid'");
          $utf8codierung = $this->app->DB->Select("SELECT utf8codierung FROM shopexport WHERE id='$shopid'");          
        }
        $projekt = $this->app->DB->Select("SELECT projekt FROM shopimport_auftraege WHERE id='$shopimportid' LIMIT 1");
        if($import[$shopimportid]=="warten")
        {

        }
        else if($import[$shopimportid]=="muell")
        {
          $this->app->DB->Update("UPDATE shopimport_auftraege SET trash='1' WHERE id='$shopimportid' LIMIT 1");
        } else {
          $arr = $this->app->DB->SelectArr("SELECT * FROM shopimport_auftraege WHERE imported='0' AND trash='0' AND id='$shopimportid' LIMIT 1");
          $warenkorb = unserialize(base64_decode($arr[0]['warenkorb']));

          //alle leerzeichen am amfang und ende entfernen + umbrueche komplett entfernen
          if($utf8codierung=="1")
          {
            $warenkorb = $this->app->erp->CleanDataBeforImportUTF8($warenkorb);
          } else {
            $warenkorb = $this->app->erp->CleanDataBeforImport($warenkorb);
          }
          if($warenkorb['name']=="") $warenkorb['name']=$warenkorb['ansprechpartner'];

          //$projekt = $arr[0][projekt];
          if($warenkorb['name']!="")// && $warenkorb[ort]!="")
          {
            if($kundennummer[$shopimportid]=="1")
            { 
              $warenkorb['kundennummer']= $import_kundennummer[$shopimportid];
              if(strlen($warenkorb['kundennummer'])!="")
                $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='{$warenkorb['kundennummer']}' AND geloescht!=1 LIMIT 1");
              if($adresse<=0) {
                $adresse = $this->app->erp->KundeAnlegen($typ,$name,$abteilung,
                    $unterabteilung,$ansprechpartner,$adresszusatz,$strasse,$land,$plz,$ort,$email,$telefon,$telefax,$ustid,$partner,$projekt);
              }
              else {
                $typ = $warenkorb['anrede'];
                $name= $warenkorb['name'];
                $abteilung = $warenkorb['abteilung'];
                $unterabteilung = $warenkorb['unterabteilung'];
                $ansprechpartner = $warenkorb['ansprechpartner'];
                $adresszusatz = $warenkorb['adresszusatz'];
                $strasse = $warenkorb['strasse'];
                $land = $warenkorb['land'];
                $plz = $warenkorb['plz'];
                $ort = $warenkorb['ort'];
                $email = $warenkorb['email'];
                $telefon = $warenkorb['telefon'];
                $telefax = $warenkorb['telefax'];
                $ustid = $warenkorb['ustid'];
                $partner = $warenkorb['affiliate_ref'];

                // Update + protokoll
                $this->app->erp->KundeUpdate($adresse,$typ,$name,$abteilung,
                    $unterabteilung,$ansprechpartner,$adresszusatz,$strasse,$land,$plz,$ort,$email,$telefon,$telefax,$ustid,$partner,$projekt);
              }
            } 
            else {
              //echo "import als Neu-Kunde $shopimportid<br>";
              $typ = $warenkorb['anrede'];
              $name= $warenkorb['name'];
              $abteilung = $warenkorb['abteilung'];
              $unterabteilung = $warenkorb['unterabteilung'];
              $ansprechpartner = $warenkorb['ansprechpartner'];
              $adresszusatz = $warenkorb['adresszusatz'];
              $strasse = $warenkorb['strasse'];
              $land = $warenkorb['land'];
              $plz = $warenkorb['plz'];
              $ort = $warenkorb['ort'];
              $email = $warenkorb['email'];
              $telefon = $warenkorb['telefon'];
              $telefax = $warenkorb['telefax'];
              $ustid = $warenkorb['ustid'];
              $partner = $warenkorb['affiliate_ref'];

              // denn fall das es kunde 1:1 schon gibt = alte Kundennummer verwenden kommt vor allem vor, wenn ein Kunde an einem Tag oefters bestellt hat
              //								$adresse = $this->app->erp->KundeAnlegen($typ,$name,$abteilung,
              //								$unterabteilung,$ansprechpartner,$adresszusatz,$strasse,$land,$plz,$ort,$email,$telefon,$telefax,$ustid,$partner,$projekt);
              if(strlen($warenkorb['kundennummer'])!="")
                $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='{$warenkorb['kundennummer']}' AND geloescht!=1 LIMIT 1");

              if($adresse<=0) {
                $adresse = $this->app->erp->KundeAnlegen($typ,$name,$abteilung,
                    $unterabteilung,$ansprechpartner,$adresszusatz,$strasse,$land,$plz,$ort,$email,$telefon,$telefax,$ustid,$partner,$projekt);
              }
              else {
                // Update + protokoll
                $this->app->erp->KundeUpdate($adresse,$typ,$name,$abteilung,
                    $unterabteilung,$ansprechpartner,$adresszusatz,$strasse,$land,$plz,$ort,$email,$telefon,$telefax,$ustid,$partner,$projekt);
              }

              // abweichende lieferadresse gleich angelegen?
              if(strlen($warenkorb['lieferadresse_ansprechpartner'])>3)
              {
                $this->app->DB->Insert("INSERT INTO lieferadressen (typ,name,abteilung,unterabteilung,land,strasse,ort,plz,adresszusatz,adresse) VALUES
                    ('','{$warenkorb['lieferadresse_ansprechpartner']}',
                     '{$warenkorb['lieferadresse_abteilung']}','{$warenkorb['lieferadresse_unterabteilung']}','{$warenkorb['lieferadresse_land']}',
                     '{$warenkorb['lieferadresse_strasse']}','{$warenkorb['lieferadresse_ort']}','{$warenkorb['lieferadresse_plz']}','{$warenkorb['lieferadresse_adresszusatz']}','$adresse')");
              }

              if(strlen($warenkorb['lieferadresse_name'])>3 && $warenkorb['lieferadresse_ansprechpartner']=="")
              {
                $this->app->DB->Insert("INSERT INTO lieferadressen (typ,name,abteilung,unterabteilung,land,strasse,ort,plz,adresszusatz,adresse) VALUES
                    ('','{$warenkorb['lieferadresse_name']}',
                     '{$warenkorb['lieferadresse_abteilung']}','{$warenkorb['lieferadresse_unterabteilung']}','{$warenkorb['lieferadresse_land']}',
                     '{$warenkorb['lieferadresse_strasse']}','{$warenkorb['lieferadresse_ort']}','{$warenkorb['lieferadresse_plz']}','{$warenkorb['lieferadresse_adresszusatz']}','$adresse')");
              }
            } 

            //print_r($warenkorb);
            //echo "<br><br>Ende";
            //exit;
            //imort auf kunde 
            $bekanntezahlungsweisen = array('rechnung','vorkasse','nachnahme','kreditkarte','einzugsermaechtigung','bar','paypal','billsafe','amazon','amazon_bestellung','sofortueberweisung','amazoncba','secupay');
            if(! in_array(strtolower($warenkorb['zahlungsweise']),$bekanntezahlungsweisen))
            {
              if(!isset($unbekanntezahlungsweisen[strtolower($warenkorb['zahlungsweise'])]))$unbekanntezahlungsweisen[strtolower($warenkorb['zahlungsweise'])] = false;
              $tmp = false;
              $tmp['bestellnummer'] = $warenkorb['onlinebestellnummer'];
              $unbekanntezahlungsweisen[strtolower($warenkorb['zahlungsweise'])][] = $tmp;
            }
            
            $tmpauftragid = $this->app->erp->ImportAuftrag($adresse,$warenkorb,$projekt,$id);
            $this->app->DB->Update("UPDATE shopimport_auftraege SET imported='1' WHERE id='$shopimportid' LIMIT 1");
            $shopextid = $this->app->DB->Select("SELECT extid FROM shopimport_auftraege WHERE id='$shopimportid' LIMIT 1");
            $this->app->DB->Select("UPDATE auftrag SET shopextid='$shopextid' WHERE id='$tmpauftragid' LIMIT 1");


            $adresse ="";
            $sucess_import++;
          }
        }
      } // ende for
      
      
      if($unbekanntezahlungsweisen)
      {
        $meldung = '';
        foreach($unbekanntezahlungsweisen as $k => $v)
        {
          $meldung .= 'Unbekannte Zahlungsart: '.$k." in Bestellung(en): ";
          $first = true;
          foreach($v as $k2 => $v2)
          {
            if(!$first)$meldung .= ', ';
            $first = false;
            $meldung .= $v2['bestellnummer'];
            
          }
          $meldung .= "<br />\r\n";
          
        }
        
        $this->app->erp->EventMitSystemLog($this->app->User->GetID(), $meldung, -1,"", "warning", 1);
        
      }
      
      $msg = $this->app->erp->base64_url_encode("<div style=\"color:green\">$sucess_import Auftr&auml;ge importiert!</div>");
      header("Location: index.php?module=shopimport&action=list&msg=$msg");
      exit;
    }


    $pageContents = $this->app->remote->RemoteConnection($id);
    if($pageContents=="success")
    {
      $gesamtanzahl = $this->app->remote->RemoteGetAuftraegeAnzahl($id);
      if($einzelsync=="1" && $gesamtanzahl > 1)
        $gesamtanzahl=1;

      if($gesamtanzahl > 0)
      {
        for($i=0;$i<$gesamtanzahl;$i++)
        {
          //import au
          $result = $this->app->remote->RemoteGetAuftrag($id);

          if(is_array($result))
          {
            $auftrag = $result[0]['id'];
            $sessionid = $result[0]['sessionid'];
            $warenkorb = $result[0]['warenkorb'];
            $logdatei = $result[0]['logdatei'];
            $this->app->DB->Insert("INSERT INTO shopimport_auftraege (id,extid,sessionid,warenkorb,imported,projekt,bearbeiter,logdatei) 
                VALUES('','$auftrag','$sessionid','$warenkorb','0','$projekt','".$this->app->User->GetName()."','$logdatei')");
            $insid = $this->app->DB->GetInsertID();
            if($insid)$this->app->DB->Update("UPDATE shopimport_auftraege set shopid = '$id' where id = '$insid'");

            if($demomodus!="1")	
            {
              $this->app->remote->RemoteDeleteAuftrag($id,$auftrag);
            }
            else 
            {
              $i=$gesamtanzahl;
            }
          }
        }
      }
      else {
      }

    } else {
      if(!$returncount)$this->app->Tpl->Set('IMPORT',"<div class=\"error\">Verbindungsprobleme! Bitte Administrator kontaktieren! ($pageContents)</div>");
    }
    //$this->app->Tpl->Set(SUBSUBHEADING,"Auftragsimport");
    //$this->app->Tpl->Add('INHALT',"<table border=\"1\"><tr><td></td><td>Internet</td><td>Kunde</td><td>Land</td><td>Betrag</td></tr>");
    // Tabelle mit Radiobuttons

    if(!$returncount)
    {
      $htmltable = new HTMLTable(0,"100%","",3,1,"font-size:85%");
      $htmltable->AddRowAsHeading(array('Import','M&uuml;ll','Sp&auml;ter','Projekt','Internet','Name','Strasse','PLZ','Ort','Kd.Nr.','vorhanden','Land','Betrag','Offen','Zahlung','Partner'));
      $htmltable->ChangingRowColors('#e0e0e0','#fff');

      $arr = $this->app->DB->SelectArr("SELECT sa.*, p.abkuerzung FROM shopimport_auftraege sa left join projekt p on sa.projekt = p.id WHERE sa.imported='0' AND sa.trash='0' ORDER BY sa.logdatei");
      if(is_array($arr) && count($arr) > 0)
      {
        
        //Alte Auftraege prüfen
        $alteauftraegeohnebestellnummer = $this->app->DB->Query("SELECT sa.* FROM shopimport_auftraege sa WHERE isnull(bestellnummer) AND sa.trash='0'");
        while($row = $this->app->DB->Fetch_Array($alteauftraegeohnebestellnummer))
        {
          $warenkorb = unserialize(base64_decode($row['warenkorb']));
          $this->app->DB->Update("UPDATE shopimport_auftraege set bestellnummer = '".(isset($warenkorb['onlinebestellnummer'])?$warenkorb['onlinebestellnummer']:'')."' where id = '".$row['id']."'");
        }
        
        
        
        $unbekanntezahlungsweisen = false;
        $enthaeltdoppeltenummern = false;
        
        for($i=0;$i<count($arr);$i++)
        {
          $warenkorb = unserialize(base64_decode($arr[$i]['warenkorb']));
          foreach($warenkorb as $key=>$value)
            $warenkorb[$key] = trim($warenkorb[$key]);

          $checkid = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE name='".$warenkorb['name']."' AND email='".$warenkorb['email']."' AND abteilung='".$warenkorb['abteilung']."'
              AND strasse='".$warenkorb['strasse']."' AND plz='".$warenkorb['plz']."' AND ort='".$warenkorb['ort']."' AND geloescht!=1 LIMIT 1");


          if($warenkorb['email']!="amazon_import_bounce@nfxmedia.de")
          {
                  $checkidemail = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE email='".$warenkorb['email']."'  AND geloescht!=1 LIMIT 1");
          }
          if($checkidemail <=0)
            $checkidemail = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE name='".$warenkorb['name']."'  AND geloescht!=1 LIMIT 1");

          //echo "SELECT kundennummer FROM adresse WHERE email='".$warenkorb[email]."'  LIMIT 1";
          $validkundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE kundennummer='".$warenkorb['kundennummer']."' AND geloescht!=1 LIMIT 1");

          if($warenkorb['kundennummer']!="" && $validkundennummer==$warenkorb['kundennummer'])
          {
            $kdrnummer = $warenkorb['kundennummer'];
            $kdr_name = $this->app->DB->Select("SELECT name FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
            $email = $this->app->DB->Select("SELECT email FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
            $parts= explode("\n", wordwrap($kdr_name, 20, "\n"));
            $kdr_name = $parts[0];
            $kdr_name = "<br><i style=\"color:red\">".$kdr_name."</i>";
            $email = "<br><i style=\"color:red\">".$email."</i>";

            $kdr_strasse = $this->app->DB->Select("SELECT strasse FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
            $parts= explode("\n", wordwrap($kdr_strasse, 20, "\n"));
            $kdr_strasse = $parts[0];
            $kdr_strasse = "<br><i style=\"color:red\">".$kdr_strasse."</i>";

            $kdr_plz = "<br><i style=\"color:red\">".$this->app->DB->Select("SELECT plz FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1")."</i>";
            $kdr_ort = "<br><i style=\"color:red\">".$this->app->DB->Select("SELECT ort FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1")."</i>";
            $checked="";
          } 
          elseif ($checkid!="")
          {
            $checked="checked";
            $kdrnummer = $checkid;
            //$kdr_name = "<br><i style=\"color:purple\">".$this->app->DB->Select("SELECT name FROM adresse WHERE kundennummer='$kdrnummer' AND firma='".$this->app->User->GetFirma()."' LIMIT 1")."</i>";
            $kdr_name = $this->app->DB->Select("SELECT name FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
            $email = $this->app->DB->Select("SELECT email FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
            $parts= explode("\n", wordwrap($kdr_name, 20, "\n"));
            $kdr_name = $parts[0];
            $kdr_name = "<br><i style=\"color:green\">".$kdr_name."</i>";
            $email = "<br><i style=\"color:green\">".$email."</i>";

            $kdr_strasse = $this->app->DB->Select("SELECT strasse FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
            $parts= explode("\n", wordwrap($kdr_strasse, 20, "\n"));
            $kdr_strasse = $parts[0];
            $kdr_strasse = "<br><i style=\"color:green\">".$kdr_strasse."</i>";

            $kdr_plz = "<br><i style=\"color:green\">".$this->app->DB->Select("SELECT plz FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1")."</i>";
            $kdr_ort = "<br><i style=\"color:green\">".$this->app->DB->Select("SELECT ort FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1")."</i>";

          } 
          elseif ($checkidemail!="")
          {
            $checked="checked";
            $kdrnummer = $checkidemail;
            $warenkorb['kundennummer'] = $kdrnummer;
            //$kdr_name = "<br><i style=\"color:purple\">".$this->app->DB->Select("SELECT name FROM adresse WHERE kundennummer='$kdrnummer' AND firma='".$this->app->User->GetFirma()."' LIMIT 1")."</i>";
            $kdr_name = $this->app->DB->Select("SELECT name FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
            $email = $this->app->DB->Select("SELECT email FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
            $parts= explode("\n", wordwrap($kdr_name, 20, "\n"));
            $kdr_name = $parts[0];
            $kdr_name = "<br><i style=\"color:purple\">".$kdr_name."</i>";
            $email = "<br><i style=\"color:purple\">".$email."</i>";

            $kdr_strasse = $this->app->DB->Select("SELECT strasse FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
            $parts= explode("\n", wordwrap($kdr_strasse, 40, "\n"));
            $kdr_strasse = $parts[0];
            $kdr_strasse = "<br><i style=\"color:purple\">".$kdr_strasse."</i>";

            $kdr_plz = "<br><i style=\"color:purple\">".$this->app->DB->Select("SELECT plz FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1")."</i>";
            $kdr_ort = "<br><i style=\"color:purple\">".$this->app->DB->Select("SELECT ort FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1")."</i>";

          } 


          else {
            $checked="";
            $checkid="";
            $kdrnummer="";
            $checkidemail="";
            $kdr_name="";$kdr_strasse="";$kdr_plz="";$kdr_ort=""; 
            $email="";
          }
          if($kdrnummer != "")
            $kdr_addresse_id  = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$kdrnummer' AND geloescht!=1 LIMIT 1");
          else $kdr_addresse_id = "";

          $warenkorb['name']  = $this->app->erp->LimitWord($warenkorb['name'],20);
          $warenkorb['strasse']  = $this->app->erp->LimitWord($warenkorb['strasse'],20);

          $htmltable->NewRow();
          
          $doppelteonlinebestellnummer = false;
          if(isset($warenkorb['onlinebestellnummer']) && $warenkorb['onlinebestellnummer'])
          {
            $check = $this->app->DB->Select("SELECT id from shopimport_auftraege where id <> '".$arr[$i]['id']."' and shopid = '".$arr[$i]['shopid']."' and bestellnummer = '".$warenkorb['onlinebestellnummer']."' and trash = '0' LIMIT 1");
            if($check)
            {
              $doppelteonlinebestellnummer = true;
              $enthaeltdoppeltenummern = true;
            }
          }
          
          $htmltable->AddCol('<input type="hidden" name="auftrag[]" value="'.$arr[$i]['id'].'"><input type="radio" name="import['.$arr[$i]['id'].']" value="import" '.($doppelteonlinebestellnummer?'':' checked="checked" ').'>');
          $htmltable->AddCol('<input type="radio" name="import['.$arr[$i]['id'].']" value="muell">');
          $htmltable->AddCol('<input type="radio" name="import['.$arr[$i]['id'].']" value="warten"'.($doppelteonlinebestellnummer?' checked="checked" ':'').'>');
          $htmltable->AddCol($arr[$i]['abkuerzung']);
          
          
          $htmltable->AddCol(($doppelteonlinebestellnummer?'<b style="color:red">':'').$warenkorb['onlinebestellnummer'].($doppelteonlinebestellnummer?'</b>':''));
          $htmltable->AddCol($warenkorb['name'].$kdr_name."<br>".$warenkorb['email'].$email);
          $htmltable->AddCol($warenkorb['strasse'].$kdr_strasse);
          $htmltable->AddCol($warenkorb['plz'].$kdr_plz);
          $htmltable->AddCol($warenkorb['ort'].$kdr_ort);
          if($checkid!="")
            $htmltable->AddCol('<input type="text" size="10" value="'.$kdrnummer.'" name="import_kundennummer['.$arr[$i]['id'].']">');
          else
            $htmltable->AddCol('<input type="text" size="10" value="'.$warenkorb['kundennummer'].'" name="import_kundennummer['.$arr[$i]['id'].']">');


          $htmltable->AddCol('<input type="checkbox" '.$checked.' name="kundennummer['.$arr[$i]['id'].']" value="1">');
          //$htmltable->AddCol('<input type="text" size="8" value="'.$warenkorb[kundennummer].'">&nbsp;<img src="./themes/[THEME]/images/zoom_in.png" border="0">');
          $htmltable->AddCol($warenkorb['land']);
          $htmltable->AddCol($warenkorb['gesamtsumme']);
          $saldo_kunde = round($this->app->erp->SaldoAdresse($kdr_addresse_id),2);
          if($saldo_kunde > 0)
            $saldo_kunde = "<b style=\"color:red\">".number_format($saldo_kunde,2,",",".")."</b>";
          else
            $saldo_kunde = "-";
          $htmltable->AddCol($saldo_kunde);
          $htmltable->AddCol($warenkorb['zahlungsweise']);
          


          $htmltable->AddCol($warenkorb['affiliate_ref']);
          //$htmltable->AddCol('<a href="">Einzelimport</a>&nbsp;<a href="">verwerfen</a>');
          //$warenkorb[gesamtsumme] = str_replace(".","",$warenkorb[gesamtsumme]);
          $gesamtsumme = $gesamtsumme + $warenkorb['gesamtsumme'];

          //$this->app->Tpl->Add('INHALT',"<tr><td><input type=\"checkbox\" name=\"\" value=\"1\" checked></td><td>{$warenkorb[onlinebestellnummer]}</td><td>{$warenkorb[name]}</td><td>{$warenkorb[land]}</td><td>{$warenkorb[gesamtsumme]}</td></tr>");
        }

        
        } else {
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Aktuell sind keine Auftr&auml;ge in den Online-Shops vorhanden!</div>  ");
          header("Location: index.php?module=shopimport&action=list&msg=$msg");
          exit;
        }


      $htmltable->NewRow();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol();
      $htmltable->AddCol($gesamtsumme);
      $htmltable->AddCol();
      $htmltable->AddCol();

      if($enthaeltdoppeltenummern)$this->app->Tpl->Add('INHALT','<div class="error">Es wurde ein Auftrag aus einem Shop geholt, der bereits importiert wurde!</div>');
      $this->app->Tpl->Add('INHALT',$htmltable->Get());

      $this->app->Tpl->Add('INHALT',"<br><br>Bedeutung: <ul>
          <li style=\"color:red\">Kundennummer von Kunde angegeben, eventuell ist diese falsch!</li>
          <li style=\"color:red\">Doppelte Internetbestellnummer!</li>
          <li style=\"color:purple\">Kundennummer bitte manuell pr&uuml;fen!</li>
          <li style=\"color:green\">Kundennummer aufgrund Felder Ort, Strasse, Name, Abteilung und E-Mail eindeutig gefunden!</li>
          </ul>");

      $this->app->Tpl->Set('EXTEND',"<input type=\"submit\" value=\"Auftr&auml;ge importieren\" name=\"submit\">");  
      $this->app->Tpl->Parse('IMPORT',"rahmen70.tpl");


      $this->app->Tpl->Parse('PAGE',"shopimport_import.tpl");
    } else return $count+(isset($gesamtanzahl)?$gesamtanzahl:0);
  }



  function ShopimportNavigation()
  {
    $id = $this->app->Secure->GetGET("id");
    $tmp = new Navigation($this->app);
    $this->app->Tpl->Set('ID',$id);
    $this->app->Tpl->Set('INHALT',$tmp->Get());

    $this->app->Tpl->Set('SUBSUBHEADING',"Navigationsstruktur Online-Shop");
    $this->app->Tpl->Parse('PAGE',"rahmen_ohne_form.tpl");
    $this->app->BuildNavigation=false;
  }


}
?>
