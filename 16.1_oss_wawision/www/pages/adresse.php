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
include ("_gen/adresse.php");

class Adresse extends GenAdresse {
  var $app;

  function Adresse($app) {
    //parent::GenAdresse($app);
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","AdresseCreate");
    $this->app->ActionHandler("edit","AdresseEdit");
    $this->app->ActionHandler("getid","AdresseGetid");
    $this->app->ActionHandler("open","AdresseOpen");
    $this->app->ActionHandler("list","AdresseList");
    $this->app->ActionHandler("suche","AdresseSuche");
    $this->app->ActionHandler("delete","AdresseDelete");
    $this->app->ActionHandler("ustprf","AdresseUstprf");
    $this->app->ActionHandler("ustprfneu","AdresseUstprfNeu");
    $this->app->ActionHandler("ustprfedit","AdresseUstprfEdit");
    $this->app->ActionHandler("lieferantvorlage","AdresseLieferantvorlage");
    $this->app->ActionHandler("kundevorlage","AdresseKundevorlage");
    $this->app->ActionHandler("zeiterfassung","AdresseZeiterfassung");
    $this->app->ActionHandler("abrechnungzeit","AdresseAbrechnungzeit");
    $this->app->ActionHandler("abrechnungzeitabgeschlossen","AdresseAbrechnungzeitabgeschlossen");
    $this->app->ActionHandler("abrechnungzeitdelete","AdresseAbrechnungzeitdelete");
    $this->app->ActionHandler("pdf","AdresseStammblatt");

    $this->app->ActionHandler("lieferadresse","AdresseLieferadresse");
    $this->app->ActionHandler("lieferadresseneditpopup","AdresseLieferadressenEditPopup");
    $this->app->ActionHandler("ansprechpartner","AdresseAnsprechpartner");
    $this->app->ActionHandler("ansprechpartnereditpopup","AdresseAnsprechpartnerEditPopup");
    $this->app->ActionHandler("ansprechpartnerpopup","AdresseAnsprechpartnerPopup");

    $this->app->ActionHandler("accounts","AdresseAccounts");
    $this->app->ActionHandler("accountseditpopup","AdresseAccountsEditPopup");
    $this->app->ActionHandler("accountspopup","AdresseAccountsPopup");


    $this->app->ActionHandler("adressestammdatenpopup","AdresseStammdatenLieferadressePopup");
    $this->app->ActionHandler("ansprechpartnerlieferadressepopup","AdresseAnsprechpartnerLieferadressePopup");
    $this->app->ActionHandler("lieferadressepopup","AdresseLieferadressePopup");
    $this->app->ActionHandler("ustpopup","AdresseUSTPopup");
    $this->app->ActionHandler("rollen","AdresseRollen");
    $this->app->ActionHandler("kontakthistorie","AdresseKontakthistorie");
    $this->app->ActionHandler("kontakthistorieeditpopup","AdresseKontakthistorieEditPopup");
    $this->app->ActionHandler("rolecreate","AdresseRolleAnlegen");
    $this->app->ActionHandler("rolledatum","AdresseRolleDatum");
    $this->app->ActionHandler("roledel","AdresseRolleLoeschen");
    $this->app->ActionHandler("addposition","AdresseAddPosition");
    $this->app->ActionHandler("suchmaske","AdresseSuchmaske");
    $this->app->ActionHandler("dateien","AdresseDateien");
    $this->app->ActionHandler("brief","AdresseBrief");
    $this->app->ActionHandler("briefdelete","AdresseBriefDelete");
    $this->app->ActionHandler("briefpdf","AdresseBriefPDF");
    $this->app->ActionHandler("briefeditpopup","AdresseBriefEditPopup");

    $this->app->ActionHandler("brieferstellen","AdresseBriefErstellen");
    $this->app->ActionHandler("briefpreview","AdresseBriefPreview");
    $this->app->ActionHandler("briefbearbeiten","AdresseBriefBearbeiten");
    $this->app->ActionHandler("briefkorrpdf", "AdresseKorrBriefPdf");
    $this->app->ActionHandler("briefkorrdelete", "AdresseKorrBriefDelete");
    $this->app->ActionHandler("briefdrucken", "AdresseBriefDrucken");


    $this->app->ActionHandler("email","AdresseEmail");
    $this->app->ActionHandler("belege","AdresseBelege");
    $this->app->ActionHandler("positioneneditpopup","AdresseArtikelEditPopup");
    $this->app->ActionHandler("emaileditpopup","AdresseEmailEditPopup");
    $this->app->ActionHandler("artikel","AdresseArtikelPosition");
    $this->app->ActionHandler("lieferantartikel","AdresseLieferantArtikel");
    $this->app->ActionHandler("kundeartikel","AdresseKundeArtikel");
    $this->app->ActionHandler("delartikel","DelArtikel");
    $this->app->ActionHandler("upartikel","UpArtikel");
    $this->app->ActionHandler("downartikel","DownArtikel");

    $this->app->ActionHandler("rolledelete","AdresseRolleDelete");
    $this->app->ActionHandler("artikeleditpopup","AdresseArtikelEditPopup");
    $this->app->ActionHandler("kontakthistorie","AdresseKontaktHistorie");
    $this->app->ActionHandler("offenebestellungen","AdresseOffeneBestellungen");
    $this->app->ActionHandler("adressebestellungmarkieren","AdresseBestellungMarkiert");
    $this->app->ActionHandler("autocomplete","AdresseAutoComplete");

    $this->app->ActionHandler("lohn","AdresseLohnStundensatzUebersicht");
    $this->app->ActionHandler("stundensatz","AdresseStundensatz");
    $this->app->ActionHandler("stundensatzedit","AdresseStundensatzEdit");
    $this->app->ActionHandler("stundensatzdelete","AdresseStundensatzDelete");
    $this->app->ActionHandler("createdokument","AdresseCreateDokument");
    $this->app->ActionHandler("newkontakt","AdresseNewKontakt");
    $this->app->ActionHandler("delkontakt","AdresseDelKontakt");
    $this->app->ActionHandler("minidetail","AdresseMiniDetailZeit");
    $this->app->ActionHandler("minidetailadr","AdresseMiniDetailAdr");
    $this->app->ActionHandler("minidetailbrief","AdresseMiniDetailBrief");
    $this->app->ActionHandler("korreseditpopup","AdresseKorressEditPopup");
    $this->app->ActionHandler("sepamandat","AdresseSEPAMandat");

    $this->app->ActionHandler("verein","AdresseVerein");
    
    $this->app->ActionHandler("removeemailanhang","Adresseremoveemailanhang");
    $this->app->ActionHandler("downloaddatei", "AdresseDownloadDatei");

    
    $id = $this->app->Secure->GetGET("id");
    //$nummer = $this->app->Secure->GetPOST("nummer");

    //if($nummer=="")
    //$name = $this->app->DB->Select("SELECT CONCAT(name,'&nbsp;&nbsp;',
    $nummer = $this->app->DB->Select("SELECT CONCAT(
        if(kundennummer!='',CONCAT('Kunde: ',kundennummer),''),
          if(lieferantennummer!='',CONCAT(' Lieferant: ',lieferantennummer),'')) FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");


    if(is_numeric($id))
      $name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");

    // else
    //   $name = $nummer;

    if(isset($name) && $name!="")
      $this->app->Tpl->Set('UEBERSCHRIFT',"Adresse von: ".$name);
    else
      $this->app->Tpl->Set('UEBERSCHRIFT',"Adressen");

    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Adresse");
    if(isset($name) && isset($nummer) && $name!="" && $nummer!="")
      $this->app->Tpl->Set('KURZUEBERSCHRIFT2',"$name ($nummer)");
    else
      $this->app->Tpl->Set('KURZUEBERSCHRIFT2',isset($name)?$name:'');

    if(isset($name))$this->app->Tpl->Set('ANZEIGENUMMER',$name);
    if(isset($nummer))$this->app->Tpl->Set('ANZEIGENAMEDE'," ".$nummer);

    $this->app->Tpl->Set('FARBE',"[FARBE1]");


    $this->app->ActionHandlerListen($app);
    $this->app = $app;
  }
  
  
  function AdresseDownloadDatei()
  {
    $id = (int)$this->app->Secure->GetGET('id');
    if($this->app->DB->Select("SELECT id FROM datei_stichwoerter where datei = '$id' AND subjekt like 'anhang' and objekt like 'dokument' LIMIT 1"))
    {
      $this->app->erp->SendDatei($id);
    } else {
      header("Content-Disposition: attachment; filename=\"Fehler.txt\"");
    }
    exit;
  }
  
  function Adresseremoveemailanhang()
  {
    $res['status'] = false;
    $datei = (int)$this->app->Secure->GetGET('id');
    if($datei)
    {
      $checkstichwort = $this->app->DB->Select("SELECT datei FROM datei_stichwoerter WHERE datei = '$datei' AND subjekt like 'anhang' and objekt like 'dokument' LIMIT 1");
      if($checkstichwort)
      {
        $this->app->DB->Delete("DELETE FROM datei_version WHERE datei='$datei'");
        $this->app->DB->Delete("DELETE FROM datei_stichwoerter WHERE datei='$datei'");
        $this->app->DB->Update("UPDATE datei SET geloescht=1 WHERE id='$datei'");
        $res['status'] = true;      
      }
    }
    echo json_encode($res);
    exit;
  }

  function AdresseMiniDetailBrief($parsetarget = "", $menu = true)
  {
    $doppelteids = $this->app->Secure->GetGET("id");
    $ids = preg_split('/\-/',$doppelteids);
    if(count($ids) > 1)
    {
      $typ = (int)$ids[0];
      $id = (int)$ids[1];
      switch($typ)
      {
        case '1':
        
        $this->AdresseBriefPreview('dokumente',$id,false);
        break;
        case '2':
        
        $this->AdresseBriefPreview('dokumente_send',$id,false);
        break;
        
        case '5':
        
        $this->AdresseBriefPreview('wiedervorlage',$id,false);
        break;             
      }
      
    }
    exit;
  }
  
  function AdresseKorressEditPopup()
  {
    
    $id = $this->app->Secure->GetGET("id");

    // nach page inhalt des dialogs ausgeben
    echo ".";
    if (class_exists('WidgetDokumente')){
    $widget = new WidgetDokumente($this->app,'PAGE');
    echo ".";
    //$sid = $this->app->DB->Select("SELECT adresse FROM abrechnungsartikel WHERE id='$id' LIMIT 1");
    //$widget->form->SpecialActionAfterExecute("close_refresh",
    //    "index.php?module=adresse&action=artikel&id=$sid");
    $widget->Edit();
    echo ".";
    $this->app->BuildNavigation=false;
    echo ".";
    }
  }
  
  function AdresseMiniDetailAdr($parsetarget = "", $menu = true)
  {
    $id = (int)$this->app->Secure->GetGET("id");
    $adr = $this->app->DB->SelectArr("select *, DATE_FORMAT (mandatsreferenzdatum, '%e.%m.%Y') AS mandatsreferenzdatumd from adresse where id = ".$id." limit 1");
    if($adr)
    {
      
      $adr = reset($adr);

      $this->app->Tpl->Set('EMAIL',$adr['email']);
      $this->app->Tpl->Set('MOBIL',$adr['mobil']);
      $this->app->Tpl->Set('TELEFAX',$adr['telefax']);
      $this->app->Tpl->Set('TELEFON',$adr['telefon']);
      $this->app->Tpl->Set('ORT',$adr['ort']);
      $this->app->Tpl->Set('LAND',$adr['land']);
      $this->app->Tpl->Set('PLZ',$adr['plz']);
      $this->app->Tpl->Set('STRASSE',$adr['strasse']);
      $this->app->Tpl->Set('ANSPRECHPARTNERNAME',$adr['ansprechpartner']);

      $this->app->Tpl->Set('ZAHLUNGSWEISE',$adr['zahlungsweise']);
      $this->app->Tpl->Set('ZAHLUNGSZIELTAGE',$adr['zahlungszieltage']);
      $this->app->Tpl->Set('ZAHLUNGSZIELTAGESKONTO',$adr['zahlungszieltage']);
      $this->app->Tpl->Set('ZAHLUNGSZIELTAGESKONTO',$adr['zahlungszieltageskonto']);
      $this->app->Tpl->Set('ZAHLUNGSZIELSKONTO',$adr['zahlungszielskonto']);
      $this->app->Tpl->Set('KUNDENNUMMERLIEFERANT',$adr['kundennummerlieferant']);
      $this->app->Tpl->Set('ZAHLUNGSWEISELIEFERANT',$adr['zahlungsweiselieferant']);
      $this->app->Tpl->Set('ZAHLUNGSZIELTAGELIEFERANT',$adr['zahlungszieltagelieferant']);
      $this->app->Tpl->Set('ZAHLUNGSZIELTAGESKONTOLIEFERANT',$adr['zahlungszieltagelieferant']);
      $this->app->Tpl->Set('ZAHLUNGSZIELTAGESKONTOLIEFERANT',$adr['zahlungszieltageskontolieferant']);
      $this->app->Tpl->Set('ZAHLUNGSZIELSKONTOLIEFERANT',$adr['zahlungszielskontolieferant']);
      $this->app->Tpl->Set('VERSANDARTLIEFERANT', $adr['versandartlieferant']);
      
      
      $this->app->Tpl->Set('INHABER',$adr['inhaber']);
      $this->app->Tpl->Set('BANK',$adr['bank']);
      $this->app->Tpl->Set('SWIFT',$adr['swift']);
      $this->app->Tpl->Set('IBAN',$adr['iban']);
      $this->app->Tpl->Set('MANDATREFERENZ',$adr['mandatsreferenz']);
      $this->app->Tpl->Set('ZAHLUNGSZIELSKONTOLIEFERANT',$adr['zahlungszielskontolieferant']);
      $this->app->Tpl->Set('MANDATREFERENZART',$adr['mandatsreferenzart']);
      $this->app->Tpl->Set('MANDATSREFERENZDHART',$adr['mandatsreferenzdhart']);
      $this->app->Tpl->Set('MANDATSREFERENZDATUM',$adr['mandatsreferenzdatumd']);
      $this->app->Tpl->Set('MANDATSREFERENZAENDERUNG',($adr['mandatsreferenzaenderung']?'ja':'nein'));
      $this->app->Tpl->Set('WAEHRUNG',$adr['waehrung']);
      
      
      /*
        <table style="font-size: 8pt; background: white; color: #333333; border-collapse: collapse; border: 2px solid #cccccc;" width="100%" cellspacing="10" cellpadding="10">
          <tr><td class="auftraginfo_cell">Inhaber:</td><td colspan="4" class="auftraginfo_cell">[INHABER]</td><td class="auftraginfo_cell">Bank:</td><td colspan="4" class="auftraginfo_cell">[BANK]</td></tr>
          <tr><td class="auftraginfo_cell">BIC:</td><td colspan="4" class="auftraginfo_cell">[SWIFT]</td><td class="auftraginfo_cell">IBAN:</td><td colspan="4" class="auftraginfo_cell">[IBAN]</td></tr>
          <tr><td class="auftraginfo_cell">Mandatsreferenz:</td><td colspan="4" class="auftraginfo_cell">[MANDATREFERENZ]</td><td class="auftraginfo_cell">Lastschriftart:</td><td colspan="4" class="auftraginfo_cell">[MANDATREFERENZART] [MANDATSREFERENZDHART]</td></tr>
          <tr><td class="auftraginfo_cell">Mandatsreferenz Datum:</td><td colspan="4" class="auftraginfo_cell">[MANDATSREFERENZDATUM]</td><td class="auftraginfo_cell">Mandatsreferenz&auml;nderung:</td><td colspan="4" class="auftraginfo_cell">[MANDATSREFERENZAENDERUNG]</td></tr>
          <tr><td class="auftraginfo_cell">W&auml;hrung:</td><td colspan="4" class="auftraginfo_cell">[WAEHRUNG]</td><td class="auftraginfo_cell"></td><td colspan="4" class="auftraginfo_cell"></td></tr>
        </table></tr></td></tr>
      */
      
      $table = new EasyTable($this->app);
      $table->Query("SELECT a.name, a.bereich, a.email, a.telefon, a.telefax, a.mobil FROM ansprechpartner a WHERE adresse='$id'  AND a.name!='Neuer Datensatz' ORDER by id DESC");
      $table->DisplayNew('ANSPRECHPARTNER',"Mobil","noAction");
      $table2 = new EasyTable($this->app);
      $table2->Query("SELECT  if(l.standardlieferadresse,CONCAT('<strong>',l.name,' (Standardlieferadresse)</strong>'),l.name) as name2, l.strasse, 
                                             l.land, l.plz, l.ort, l.telefon,l.email FROM lieferadressen l where  l.adresse='". $id . "' AND l.name!='Neuer Datensatz'" );
      $table2->DisplayNew('LIEFERANTEN',"Email","noAction");                                   
      
    }
    if($parsetarget=="")
    {
      $this->app->Tpl->Output("adresse_minidetail.tpl");
      exit;
    }  else {
      $this->app->Tpl->Parse($parsetarget,"adresse_minidetail.tpl");
    }
  
  }
  

  function AdresseStammblatt()
  {
    $id = $this->app->Secure->GetGET("id");
    $Brief = new AdressstammblattPDF($this->app,$projekt);
    $Brief->GetAdressstammblatt($id);
    $Brief->displayDocument();
    exit;
  }



  function AdresseMiniDetailZeit() {

    $id = $this->app->Secure->GetGET("id");


    if(strpos($_SERVER['HTTP_REFERER'],'action=brief')!==false) {

      $data = explode('||', $id);
      /*
         echo '<pre>';
         print_r($data);
         echo '</pre>';
       */

      if (isset($data[1])) {

        $query = '';

        switch ($data[1]) {
          case 'dokumente':
            $query .= '
              SELECT
              von as personVon,
                  content as content,
                  DATE_FORMAT(datum, "%d.%m.%Y") as datum
                    FROM
                    dokumente
                    WHERE
                    id = ' . $data[0] . '
                    ';
            break;
          case 'dokumente_send':
            $query .= '
              SELECT
              bearbeiter as personVon,
                         text as content,
                         DATE_FORMAT(zeit, "%d.%m.%Y") as datum
                           FROM
                           dokumente_send
                           WHERE
                           id = ' . $data[0] . '
                           ';
            break;
          case 'ticket_nachricht':
            $query .= '
              SELECT
              verfasser as personVon,
                        text as content,
                        DATE_FORMAT(zeit, "%d.%m.%Y") as datum
                          FROM
                          ticket_nachricht
                          WHERE
                          id = ' . $data[0] . '
                          ';
            break;
          case 'emailbackup_mails':
            $query .= '
              SELECT
              sender as personVon,
                     action as content,
                     DATE_FORMAT(empfang, "%d.%m.%Y") as datum
                       FROM
                       emailbackup_mails
                       WHERE
                       id = ' . $data[0] . '
                       ';
            break;
          default:
            exit;
            break; 
        }

        $res = $this->app->DB->SelectArr($query);
        $res = reset($res);

        if ($res) {

          echo '<table cellpadding="0" cellspacing="0" width="100%" border=1>';

          echo '<tr>';
          echo '<td width="150">Datum:</td>';
          echo '<td>' . $res['datum'] . '</td>';
          echo '</tr>';

          echo '<tr>';
          echo '<td width="150">Von:</td>';
          echo '<td>' . $res['personVon'] . '</td>';
          echo '</tr>';

          echo '<tr>';
          echo '<td>Text:</td>';
          echo '<td>' . nl2br($res['content']) . '</td>';
          echo '</tr>';

          echo '</table>';

        }

        /*
           echo '<pre>';
           print_r($query);
           print_r($res);
           echo '</pre>';
         */


      }


      //echo $id;

    } else {


      $tmp = $this->app->DB->SelectArr("SELECT * FROM zeiterfassung WHERE id='$id'");
      $tmp = $tmp[0];
      $teilprojekt = $this->app->DB->Select("SELECT aufgabe FROM arbeitspaket WHERE id='".$tmp[arbeitspaket]."'");

      echo "<table width=\"710\">";
      echo "<tr><td width=\"200\"><b>Ort:</b></td><td>".$tmp['ort']."</td></tr>";
      echo "<tr><td><b>Tätigkeit:</b></td><td>".$tmp['aufgabe']."</td></tr>";
      echo "<tr valign=\"top\"><td><b>Beschreibung:</b></td><td>".nl2br($tmp['beschreibung'])."</td></tr>";
      echo "<tr><td><b>Teilprojekt:</b></td><td>".$teilprojekt."</td></tr>";
      echo "<tr><td><b>Kostenstelle:</b></td><td>".$tmp['kostenstelle']."</td></tr>";
      echo "<tr><td><b>Verrechnungsart:</b></td><td>".$tmp['verrechnungsart']."</td></tr>";
      echo "</table>";

    }

    exit;
  }

  function AdresseAbrechnungzeitabgeschlossen()
  {
    $sid = $this->app->Secure->GetGET("sid");
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE zeiterfassung SET ist_abgerechnet='1', abgerechnet='1' WHERE id='$sid' AND adresse_abrechnung='$id' LIMIT 1");
    $this->AdresseAbrechnungzeit();
  }


  function AdresseAbrechnungzeitdelete()
  {
    $sid = $this->app->Secure->GetGET("sid");
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Delete("DELETE FROM zeiterfassung WHERE id='$sid' AND adresse_abrechnung='$id' LIMIT 1");
    $this->AdresseAbrechnungzeit();
  }



  function AdresseZeiterfassung()
  {
    $this->AdresseMenu();
    $this->app->Tpl->Add(OFFENE,"<form action=\"\" method=\"post\">");
    $this->app->YUI->TableSearch(OFFENE,"zeiterfassungmitarbeiter");

    $id = $this->app->Secure->GetGET("id");

    $back=$this->app->erp->base64_url_encode("index.php?module=adresse&action=abrechnungzeit&id=$id");

    $this->app->Tpl->Set('BACK',$back);
    $this->app->Tpl->Set('ID',$id);
    /*
       $this->app->Tpl->Add(OFFENE,
       "<center>
       <input type=\"submit\" value=\"markierte Zeiten in Rechnung oder Auftrag &uuml;berf&uuml;hren\">
       <input type=\"submit\" value=\"als abgerechnet markieren\" name=\"abgerechnetmarkiert\">
       <input type=\"submit\" value=\"als offen markieren\" name=\"offenmarkiert\">
       </center>");
     */

    $this->app->Tpl->Parse('PAGE',"adresse_zeiterfassung.tpl");
  }



  function AdresseAbrechnungzeit()
  {
    $this->AdresseMenu();
    $this->app->Tpl->Set('VERS','Professional');
    $this->app->Tpl->Set('MODUL','Professional');
    $this->app->Tpl->Parse('PAGE', "only_version.tpl");
  }


  function AdresseCreateDokument()
  {
    $id = $this->app->Secure->GetGET("id");
    $cmd = $this->app->Secure->GetGET("cmd");

    $relocation = true;

    switch($cmd)
    {	
      case 'auftrag': $newid = $this->app->erp->CreateAuftrag($id); $this->app->erp->LoadAuftragStandardwerte($newid,$id); break;
      case 'angebot': $newid = $this->app->erp->CreateAngebot($id); $this->app->erp->LoadAngebotStandardwerte($newid,$id); break;
      case 'rechnung': $newid = $this->app->erp->CreateRechnung($id); $this->app->erp->LoadRechnungStandardwerte($newid,$id); break;
      case 'lieferschein': $newid = $this->app->erp->CreateLieferschein($id); $this->app->erp->LoadLieferscheinStandardwerte($newid,$id); break;
      case 'gutschrift': $newid = $this->app->erp->CreateGutschrift($id); $this->app->erp->LoadGutschriftStandardwerte($newid,$id); break;
      case 'bestellung': $newid = $this->app->erp->CreateBestellung($id); $this->app->erp->LoadBestellungStandardwerte($newid,$id);break;
      default: $relocation = false;
    }

    if($relocation)
    {
      header("Location: index.php?module=$cmd&action=edit&id=$newid");
      exit;
    }

  }

  function AdresseLohnStundensatzUebersicht()
  {
    $this->AdresseMenu();	

    $msg = $this->app->erp->base64_url_decode($this->app->Secure->GetGET("msg"));
    if($msg!="") $this->app->Tpl->Set('MESSAGE', $msg);

    $this->AdresseLohn();
    $this->AdresseStundensatz();

    $this->app->Tpl->Parse('PAGE',"adresse_lohn.tpl");
  }

  function AdresseLohn()
  {
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    {
      $this->app->YUI->TableSearch('TAB1',"adresselohn");
    }else
      $this->app->Tpl->Set('MESSAGE', "<div class=\"error\">Mitarbeiter-ID konnte nicht gefunden werden.</div>");

  }

  function AdresseStundensatz($id)
  {
    $id = $this->app->Secure->GetGET("id");	

    if(is_numeric($id))
    {
      $stundensatz = $this->app->Secure->GetPOST("Stundensatz_StandardStundensatz");
      $submit = $this->app->Secure->GetPOST("Stundensatz_Submit");

      // Speichere neuen Stundensatz
      if($submit!="")
      {
        $this->app->DB->Insert("INSERT INTO stundensatz (adresse, satz, typ, projekt, datum) VALUES ('$id', '$stundensatz', 'Standard', '0', NOW())");
        $this->app->Tpl->Set('MESSAGE', "<div class=\"success\">Der neue Standard-Stundensatz wurde &uuml;bernommen.</div>");
      }

      // Hole neuesten Stundensatz
      $standard = $this->app->DB->Select("SELECT satz 
          FROM stundensatz 
          WHERE typ='standard'
          AND adresse='$id'
          ORDER BY datum DESC LIMIT 1");
      $this->app->Tpl->Set(STANDARDSTUNDENSATZ, $standard);

      // Fülle Projekt-Tabelle
      $this->app->YUI->TableSearch('TAB2',"adressestundensatz");
    }else
      $this->app->Tpl->Set('MESSAGE', "<div class=\"error\">Mitarbeiter-ID konnte nicht gefunden werden.</div>");
  }

  function AdresseStundensatzEdit()
  {
    $this->AdresseMenu();

    $user = $this->app->Secure->GetGET("user");
    $id = $this->app->Secure->GetGET("id");	
    $projekt = $this->app->Secure->GetGET("projekt");

    $satz = $this->app->Secure->GetPOST("Stundensatz_Angepasst");
    $adapt = $this->app->Secure->GetPOST("Stundensatz_Adapt");
    $cancel = $this->app->Secure->GetPOST("Stundensatz_Angepasst_Cancel");
    $submit = $this->app->Secure->GetPOST("Stundensatz_Angepasst_Submit");


    if($cancel!="")
    {
      header("Location: ./index.php?module=adresse&action=lohn&id=$user");
      exit;
    }


    // Hole neuesten Standard-Stundensatz
    $standard = $this->app->DB->Select("SELECT satz 
        FROM stundensatz 
        WHERE typ='standard'
        AND adresse='$user'
        ORDER BY datum DESC LIMIT 1");

    if(is_numeric($id))
    {
      // Stundensatz existiert bereits, hole Daten
      $stundensatz = $this->app->DB->SelectArr("SELECT * FROM stundensatz WHERE id='$id' LIMIT 1");
      $this->app->Tpl->Set('STUNDENSATZANGEPASST', $stundensatz[0][satz]);

      if($submit!="")	
      {
        $projekt = $this->app->DB->Select("SELECT projekt FROM stundensatz WHERE id='$id' LIMIT 1");

        if($adapt!="")
          $this->app->DB->Update("UPDATE stundensatz SET satz='$satz' WHERE adresse='$user' AND projekt='$projekt'");

        $this->app->DB->Insert("INSERT INTO stundensatz (adresse, satz, typ, projekt, datum)
            VALUES ('$user', '$satz', 'Angepasst', '$projekt', NOW())");
        header("Location: ./index.php?module=adresse&action=lohn&id=$user&msg=$msg");
        exit;		
      }


      $this->app->Tpl->Set('MODE', "Stundensatz editieren");
    }else
    {
      // Stundensatz existiert noch nicht
      $this->app->Tpl->Set('STUNDENSATZANGEPASST', $standard);
      $this->app->Tpl->Set('ADAPTDISABLED', "DISABLED");

      if($submit!="")
      {
        // Schreibe neuen Satz
        $this->app->DB->Insert("INSERT INTO stundensatz (adresse, satz, typ, projekt, datum)
            VALUES ('$user', '$satz', 'Angepasst', '$projekt', NOW())");

        $msg = $this->app->erp->base64_url_encode("<div class=\"success\">Der Stundensatz wurde erfolgreich gespeichert.</div>");
        header("Location: ./index.php?module=adresse&action=lohn&id=$user&msg=$msg");
        exit;
      }	

      $this->app->Tpl->Set('MODE', "Stundensatz erstellen");
    }

    $this->app->Tpl->Parse('PAGE', "adresse_stundensatz_edit.tpl");	
  }

  function AdresseStundensatzDelete()
  {
    $user = $this->app->Secure->GetGET("user");
    $id = $this->app->Secure->GetGET("id");

    if(is_numeric($id))
      $this->app->DB->Delete("DELETE FROM stundensatz WHERE id='$id' LIMIT 1");
    else
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Stundensatz-ID konnte nicht gefunden werden. Standard-Stundens&auml;tze k&ouml;nnen nicht gel&ouml;scht werden.</div>"); 

    header("Location: ./index.php?module=adresse&action=lohn&id=$user&msg=$msg");
    exit; 
  }



  function AdresseAutoComplete()
  {

    $table = $this->app->Secure->GetGET("table");
    $filter = $this->app->Secure->GetGET("filter");
    $name = $this->app->Secure->GetGET("name");
    $query = $this->app->Secure->GetGET("query");
    $colsstring = $this->app->erp->base64_url_decode($this->app->Secure->GetGET("colsstring"));
    $returncol= $this->app->erp->base64_url_decode($this->app->Secure->GetGET("returncol"));
    if($table=="")
      $table=$name;

    if($filter=="kunde")
      $filter = "LEFT JOIN adresse_rolle ON adresse_rolle.adresse=adresse.id WHERE adresse_rolle.subjekt='Kunde' AND adresse.kundennummer!=0 AND adresse.geloescht=0 AND adresse.name LIKE '%$query%'";

    if($filter=="mitarbeiter")
      $filter = "LEFT JOIN adresse_rolle ON adresse_rolle.adresse=adresse.id WHERE (adresse_rolle.subjekt='Mitarbeiter' OR adresse_rolle.subjekt='Externer Mitarbeiter') AND adresse.mitarbeiternummer!=0 AND adresse.geloescht=0 
        AND adresse.name LIKE '%$query%'";


    if($filter=="lieferant")
      $filter = "LEFT JOIN adresse_rolle ON adresse_rolle.adresse=adresse.id WHERE adresse_rolle.subjekt='Lieferant' AND adresse.geloescht=0 AND adresse.name LIKE '%$query%'";

    if($filter=="kunde_auftrag")
      $filter = "LEFT JOIN adresse_rolle ON adresse_rolle.adresse=adresse.id LEFT JOIN auftrag ON auftrag.adresse=adresse.id WHERE adresse_rolle.subjekt='Kunde' AND ((auftrag.status='freigegeben' OR auftrag.status='storniert') OR (auftrag.vorkasse_ok=0 AND (auftrag.zahlungsweise='paypal' OR auftrag.zahlungsweise='vorkasse' OR auftrag.zahlungsweise='kreditkarte'))) AND adresse.geloescht=0
        AND adresse.name LIKE '%$query%'";

    if($filter=="kunde_rechnung")
      $filter = "LEFT JOIN adresse_rolle ON adresse_rolle.adresse=adresse.id LEFT JOIN rechnung ON rechnung.adresse=adresse.id WHERE adresse_rolle.subjekt='Kunde' AND rechnung.ist < rechnung.soll AND adresse.geloescht=0 AND adresse.name LIKE '%$query%'";

    if($filter=="kunde_gutschrift")
      $filter = "LEFT JOIN adresse_rolle ON adresse_rolle.adresse=adresse.id LEFT JOIN gutschrift ON gutschrift.adresse=adresse.id WHERE adresse_rolle.subjekt='Kunde' AND adresse.geloescht=0 AND adresse.name LIKE '%$query%'";


    if($table=="artikel")
      $filter = "WHERE name_de LIKE '%$query%'";


    if(($filter=="" || $filter=="adresse") && $name=="adresse")
      $filter = "WHERE adresse.geloescht=0 AND adresse.name LIKE '%$query%'";

    $arr = $this->app->DB->SelectArr("SELECT DISTINCT $colsstring, $returncol FROM $table $filter ORDER by 1 LIMIT 10");
    //      echo "SELECT DISTINCT $colsstring, $returncol FROM $table $filter ORDER by 1";

    $cols = split(',',$colsstring);
    foreach($arr as $key=>$value){
      //$tpl_end .= '{id:"'.$value[$returncol].'", cola:"'.$value[$cols[0]].'", colb:"'.$value[$cols[1]].'", colc:"'.$value[$cols[2]].'"},';
      echo $value[$returncol]."!*!".$value[$cols[0]].' '.$value[$cols[1]].' '.$value[$cols[2]]."\n";
      //echo $value[$cols[0]].' '.$value[$cols[1]].' '.$value[$cols[2]]."\n";
      //echo $value[$cols[0]]."\n";
    } 


    exit;

  }


  function AdresseDateien()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->AdresseMenu();
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Dateien)");
    $this->app->YUI->DateiUpload('PAGE',"Adressen",$id);
  }


  function AdresseDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE adresse SET geloescht='1',kundennummer=CONCAT('DEL-',kundennummer), lieferantennummer=CONCAT('DEL-',lieferantennummer), 
        mitarbeiternummer=CONCAT('DEL-',mitarbeiternummer) WHERE id='$id' LIMIT 1");
    $this->AdresseList();
  }


  function AdresseRolleDatum()
  {
    $id = $this->app->Secure->GetGET("id");
    $sid = $this->app->Secure->GetGET("sid");
    $von = $this->app->Secure->GetGET("von");
    $bis = $this->app->Secure->GetGET("bis");
    $von = $this->app->String->Convert($von,"%1.%2.%3","%3-%2-%1");
    $bis = $this->app->String->Convert($bis,"%1.%2.%3","%3-%2-%1");

    $this->app->DB->Delete("UPDATE adresse_rolle SET von='$von', bis='$bis' WHERE id='$sid' AND adresse='$id' LIMIT 1");

    $gruppe = $this->app->DB->Select("SELECT parameter FROM adresse_rolle WHERE id='$sid' AND adresse='$id' LIMIT 1");

    if($gruppe > 0)
    {
      if($von!="--" && $bis!="--")
      {
        $this->app->DB->Update("UPDATE auftrag SET gruppe='$gruppe' WHERE datum<='$bis' AND datum >='$von'	AND adresse='$id'");	
        $this->app->DB->Update("UPDATE rechnung SET gruppe='$gruppe' WHERE datum<='$bis' AND datum >='$von'	AND adresse='$id'");	
        $this->app->DB->Update("UPDATE gutschrift SET gruppe='$gruppe' WHERE datum<='$bis' AND datum >='$von'	AND adresse='$id'");	
      } else if($von!="--" && $bis=="--")
      {
        $this->app->DB->Update("UPDATE auftrag SET gruppe='$gruppe' WHERE datum>='$von' AND adresse='$id'");	
        $this->app->DB->Update("UPDATE rechnung SET gruppe='$gruppe' WHERE datum>='$von' AND adresse='$id'");	
        $this->app->DB->Update("UPDATE gutschrift SET gruppe='$gruppe' WHERE datum>='$von' AND adresse='$id'");	
      }	
    }

    $this->AdresseRollen();
  }




  function AdresseRolleDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    $sid = $this->app->Secure->GetGET("sid");

    $this->app->DB->Delete("DELETE FROM adresse_rolle WHERE id='$sid' AND adresse='$id' LIMIT 1");

    //    $this->app->Secure->POST['rolleanlegen'] = "true";
    //$this->AdresseEdit();
    $this->AdresseRollen();
    //$this->app->Tpl->Set(AKTIV_TAB3,"selected");
  }

  function AdresseCreate()
  {
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Adresse anlegen");
    $this->app->Tpl->Set('TOPHEADING',"Adresse anlegen");

    $this->app->erp->MenuEintrag("index.php?module=adresse&action=list","Zur&uuml;ck zur &Uuml;bersicht");

    parent::AdresseCreate();
  }


  function AdresseSuche()
  {

    $this->app->erp->MenuEintrag("index.php?module=adresse&action=list","&Uuml;bersicht");
    //    $this->app->erp->MenuEintrag("index.php?module=adresse&action=suche","Suche");
    $this->app->erp->MenuEintrag("index.php?module=adresse&action=create","Neue Adresse anlegen");

    $this->app->YUI->TableSearch('TAB1',"adresse_suche");
    $this->app->Tpl->Parse('PAGE',"adresse_suche.tpl");
  }


  function AdresseList()
  {


    $parameter = $this->app->User->GetParameter('table_filter_adresse');
    $parameter = json_decode($parameter, true);


    $this->app->erp->MenuEintrag("index.php?module=adresse&action=list","&Uuml;bersicht");
    //    $this->app->erp->MenuEintrag("index.php?module=adresse&action=suche","Suche");
    $this->app->erp->MenuEintrag("index.php?module=adresse&action=create","Neue Adresse anlegen");

    $zahlungsweisen = $this->app->DB->SelectArr('
        SELECT
        zahlungsweise
        FROM
        auftrag
        GROUP BY
        zahlungsweise
        ');

    $zahlungsweiseStr = '';
    if ($zahlungsweisen) {
      foreach ($zahlungsweisen as $zahlungsweise) {
        if (empty($zahlungsweise['zahlungsweise'])) {
          continue;
        }
        $zahlungsweiseStr .= '<option value="' . $zahlungsweise['zahlungsweise'] . '">' . ucfirst($zahlungsweise['zahlungsweise']) . '</option>';
      }
    }

    $rollen = $this->app->DB->SelectArr('
        SELECT
        *
        FROM
        adresse_rolle
        GROUP BY
        subjekt
        ');

    $rollenStr = '';
    if ($rollen) {
      foreach ($rollen as $rolle) {
        $rollenStr .= '<option value="' . $rolle['subjekt'] . '">' . $rolle['subjekt'] . '</option>';
      }
    }
    
    $gruppen = $this->app->DB->SelectArr("SELECT * FROM gruppen gr WHERE art = 'gruppe' AND (projekt = 0 OR (1 ".$this->app->erp->ProjektRechte('gr.projekt')."))");
    
    $gruppenStr = '';
    if ($gruppen) {
      foreach ($gruppen as $gruppe) {
        $gruppenStr .= '<option value="' . $gruppe['id'] . '">' . $gruppe['name'] . '</option>';
      }
    }
    
    $laender = $this->app->erp->GetSelectLaenderliste();
    $laenderStr = '';
    foreach ($laender as $landKey => $land) {
      $laenderStr .= '<option value="' . $landKey . '">' . $land . '</option>';
    }

    if( $this->app->erp->ModulVorhanden("verband") ) {
      $verbandsnummer = '';
      $verbandsnummer .= '<tr>';
      $verbandsnummer .= '<td>Verbandsnummer:</td>';
      $verbandsnummer .= '<td><input type="text" name="verbandsnummer" value=""></td>';
      $verbandsnummer .= '</tr>';
      $this->app->Tpl->Add('VERBANDSNUMMER',$verbandsnummer);
    }

    $this->app->YUI->AutoComplete("projekt", "projektname", 1);
    $this->app->YUI->AutoComplete("name", "adressename", 1);
    $this->app->YUI->AutoComplete("kundennummer", "kunde", 1);
    $this->app->YUI->AutoComplete("vertrieb","adresse");
    $this->app->YUI->AutoComplete("innendienst","adresse");
    $this->app->Tpl->Add('ZAHLUNGSWEISEN',$zahlungsweiseStr);
    $this->app->Tpl->Add('ROLLEN',$rollenStr);
    $this->app->Tpl->Add('GRUPPEN',$gruppenStr);
    $this->app->Tpl->Add('LAENDER',$laenderStr);
    $this->app->Tpl->Parse('TAB1',"adresse_table_filter.tpl");


    $this->app->YUI->TableSearch('TAB1',"adressetabelle");
    $this->app->Tpl->Parse('PAGE',"adresseuebersicht.tpl");
  }


  function AdresseMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $action= $this->app->Secure->GetGET("action");

    $cmd = $this->app->Secure->GetGET("cmd");
     
    if($cmd=="crm")
    {
      $this->app->erp->MenuEintrag("index.php?module=crm&action=list","Zur&uuml;ck zur &Uuml;bersicht");
      $this->app->erp->MenuEintrag("index.php?module=adresse&action=brief&cmd=crm&id=$id","Details");
      $this->app->erp->MenuEintrag("index.php?module=adresse&action=dateien&cmd=crm&id=$id","Dateien");
      $this->app->erp->MenuEintrag("index.php?module=adresse&action=edit&cmd=crm&id=$id","Adresse");
      $this->app->Tpl->Set('KURZUEBERSCHRIFT','CRM');
    } else {

      $this->app->erp->MenuEintrag("index.php?module=adresse&action=create","Neue Adresse anlegen");

      //    $this->app->Tpl->Add(TABS,"<li><h2 style=\"background-color: [FARBE1];\">Adresse</h2></li>");
      $this->app->erp->MenuEintrag("index.php?module=adresse&action=edit&id=$id","Details");

      if($this->app->erp->Version()!="stock")
        $this->app->erp->MenuEintrag("index.php?module=adresse&action=rollen&id=$id","Rollen");

      $this->app->erp->MenuEintrag("index.php?module=adresse&action=dateien&id=$id","Dateien");


      if($this->app->erp->RechteVorhanden("verein","list") && $this->app->erp->Firmendaten("modul_verein")=="1")
        $this->app->erp->MenuEintrag("index.php?module=adresse&action=verein&id=$id","Verein");


      // Ist Benutzer ein Mitarbeiter?
      if(is_numeric($id))
        $mitarbeiter = $this->app->DB->Select("SELECT id FROM adresse_rolle WHERE adresse='$id' AND subjekt='Mitarbeiter' LIMIT 1");
      if(is_numeric($mitarbeiter))
      {
        //		$this->app->erp->MenuEintrag("index.php?module=adresse&action=lohn&id=$id","Lohn");
        $this->app->erp->MenuEintrag("index.php?module=adresse&action=zeiterfassung&id=$id","Zeit");
      }

      $this->app->erp->MenuEintrag("index.php?module=adresse&action=ansprechpartner&id=$id","Ansprechpart.");
      $this->app->erp->MenuEintrag("index.php?module=adresse&action=lieferadresse&id=$id","Lieferadressen");
      //$this->app->Tpl->Add(TABS,"<li><a  href=\"index.php?module=adresse&action=kontakthistorie&id=$id\">Kontakthistorie</a></li>");
      $this->app->erp->MenuEintrag("index.php?module=adresse&action=accounts&id=$id","Accounts");

      $this->app->erp->MenuEintrag("index.php?module=adresse&action=brief&id=$id","Korresp.");

      if($this->app->erp->IsAdresseSubjekt($id,"Kunde"))
        $this->app->erp->MenuEintrag("index.php?module=adresse&action=belege&id=$id","Belege");



      //$this->app->Tpl->Add("index.php?module=adresse&action=email&id=$id\">E-Mail schreiben</a></li>");


      if($this->app->erp->Version()!="stock")
        $this->app->erp->MenuEintrag("index.php?module=adresse&action=kundeartikel&id=$id","Artikel");

      //    if($this->app->erp->IsAdresseSubjekt($id,"Kunde"))
      //      $this->app->erp->MenuEintrag("index.php?module=adresse&action=kundevorlage&id=$id","Zahlungsweise");

      if($this->app->erp->IsAdresseSubjekt($id,"Kunde"))
      {
        //$this->app->erp->MenuEintrag("index.php?module=adresse&action=email&id=$id","RMAs");
        $this->app->erp->MenuEintrag("index.php?module=adresse&action=abrechnungzeit&id=$id","Zeitkonto");
        if($this->app->erp->ModulVorhanden("rechnungslauf"))
        {
          $this->app->erp->MenuEintrag("index.php?module=adresse&action=artikel&id=$id","Abos");
        }
        //$this->app->erp->MenuEintrag("index.php?module=adresse&action=ustprf&id=$id","USt");
        //$this->app->Tpl->Add("index.php?module=adresse&action=email&id=$id\">Rabatte</a></li>");
      }

      if($this->app->erp->IsAdresseSubjekt($id,"Lieferant"))
      {
        //				$this->app->Tpl->Add(TABS,"<br><br>");
        //      $this->app->erp->MenuEintrag("index.php?module=adresse&action=email&id=$id","RMAs</a></li>");
        $this->app->erp->MenuEintrag("index.php?module=adresse&action=lieferantartikel&id=$id","Lieferprogramm");
        $this->app->erp->MenuEintrag("index.php?module=adresse&action=offenebestellungen&id=$id","Bestellungen");
      }

      //    $this->app->erp->MenuEintrag("index.php?module=adresse&action=create","Neue Adresse anlegen");
      /*
         if($action=="list")
         $this->app->erp->MenuEintrag("index.php?module=welcome&action=main","Zur&uuml;ck zur &Uuml;bersicht");
         else 
         $this->app->erp->MenuEintrag("index.php?module=adresse&action=list","Zur&uuml;ck zur &Uuml;bersicht");
       */
     
    }


    //$this->app->Tpl->Add(TABS,"<li><a href=\"index.php?module=adresse&action=kosten&id=$id\">Gesamtkalkulation</a></li>");
  }

  /*
     function AdresseKontaktHistorie()
     {
     $this->AdresseMenu();

     $this->app->Tpl->Set('SUBSUBHEADING',"Gespr&auml;che");
     $id = $this->app->Secure->GetGET("id");

  //Formula lieferadresse
  $table = new EasyTable($this->app);
  $table->Query("SELECT DATE_FORMAT(datum,'%d.%m.%Y %H:%i') as Kontakt, grund,bearbeiter 
  FROM adresse_kontakhistorie WHERE adresse='$id' order by datum DESC");
  $table->DisplayNew('INHALT', "<a href=\"index.php?module=bestellung&action=edit&id=%value%\">Lesen</a>&nbsp;
  <a href=\"index.php?module=bestellung&action=edit&id=%value%\">Antworten</a>&nbsp;");


  // easy table mit arbeitspaketen YUI als template 
  $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
  $this->app->Tpl->Set('AKTIV_TAB1',"selected");
  $this->app->Tpl->Set('TABTEXT',"Gespr&auml;che");
  $this->app->Tpl->Parse('PAGE',"tabview.tpl");

  } 
   */
  function AdresseKontaktHistorie()
  {
    $this->AdresseMenu();
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Kontakthistorie)");
    $this->app->Tpl->Set('SUBSUBHEADING',"Adressen");
    $id = $this->app->Secure->GetGET("id");

    // neues arbeitspaket
    $widget = new WidgetAnsprechpartner($this->app,'TAB2');
    $widget->form->SpecialActionAfterExecute("none",
        "index.php?module=adresse&action=ansprechpartner&id=$id");
    $widget->Create();


    //Formula ansprechpartner
    $table = new EasyTable($this->app);
    $table->Query("SELECT name, bereich, telefon, email,id FROM ansprechpartner WHERE adresse='$id'");
    $table->DisplayNew('INHALT', "<a href=\"index.php?module=adresse&action=ansprechpartnereditpopup&frame=false&id=%value%\" 
        onclick=\"makeRequest(this);return false\">Bearbeiten</a>");

    // easy table mit arbeitspaketen YUI als template 
    $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->Tpl->Parse('PAGE',"ansprechpartneruebersicht.tpl");
  }

  function AdresseKontaktHistorieEditPopup()
  {
    $frame = $this->app->Secure->GetGET("frame");
    $id = $this->app->Secure->GetGET("id");

    if($frame=="false")
    {
      // hier nur fenster größe anpassen
      $this->app->YUI->IframeDialog(600,320);
    } else {
      // nach page inhalt des dialogs ausgeben
      $widget = new WidgetAnsprechpartner($this->app,'PAGE');
      $adresse = $this->app->DB->Select("SELECT adresse FROM ansprechpartner WHERE id='$id' LIMIT 1");
      $widget->form->SpecialActionAfterExecute("close_refresh",
          "index.php?module=adresse&action=ansprechpartner&id=$adresse");

      $widget->Edit();
      $this->app->BuildNavigation=false;
    }
  }




  function AdresseRolle()
  {


  } 

  function AdresseNummern($id)
  {
    if(is_numeric($id)) {
      $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      $lieferantennummer = $this->app->DB->Select("SELECT lieferantennummer FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      $mitarbeiternummer= $this->app->DB->Select("SELECT mitarbeiternummer FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      $projekt= $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    }
    $tmp_data_adresse= $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    $tmp_data_adresse = reset($tmp_data_adresse);

    if($kundennummer==0 || $kundennummer==""){
      // pruefe ob rolle kunden vorhanden
      if(is_numeric($id))
        $check = $this->app->DB->Select("SELECT adresse FROM adresse_rolle WHERE adresse='$id' AND subjekt='Kunde' LIMIT 1");
      if($check!="")
      {
        $kundennummer = $this->app->erp->GetNextKundennummer($projekt,$tmp_data_adresse);
        $this->app->erp->ObjektProtokoll("adresse",$id,"adresse_next_kundennummer","Kundennummer erhalten: $kundennummer");
        
        $this->app->DB->Update("UPDATE adresse SET kundennummer='$kundennummer' WHERE id='$id' AND (kundennummer='0' OR kundennummer='') LIMIT 1");
      } else 
        $kundennummer="noch keine";
    }

    if($lieferantennummer==0){
      if(is_numeric($id))
        $check = $this->app->DB->Select("SELECT adresse FROM adresse_rolle WHERE adresse='$id' AND subjekt='Lieferant' LIMIT 1");
      if($check!="")
      {
        $lieferantennummer= $this->app->erp->GetNextLieferantennummer($projekt,$tmp_data_adresse);
        $this->app->erp->ObjektProtokoll("adresse",$id,"adresse_next_lieferantennummer","Lieferantennummer erhalten: $lieferantennummer");
        if(is_numeric($id))
          $this->app->DB->Update("UPDATE adresse SET lieferantennummer='$lieferantennummer' WHERE id='$id' AND (lieferantennummer='0' OR lieferantennummer='') LIMIT 1");
      } else 
        $lieferantennummer="noch keine";
    }

    if($mitarbeiternummer==0){
      if(is_numeric($id))
        $check = $this->app->DB->Select("SELECT adresse FROM adresse_rolle WHERE adresse='$id' AND (subjekt='Mitarbeiter' OR subjekt='Externer Mitarbeiter') LIMIT 1");
      if($check!="")
      {
        $mitarbeiternummer= $this->app->erp->GetNextMitarbeiternummer($projekt,$tmp_data_adresse);
        $this->app->erp->ObjektProtokoll("adresse",$id,"adresse_next_mitarbeiternummer","Mitarbeiternummer erhalten: $mitarbeiternummer");
        if(is_numeric($id))
          $this->app->DB->Update("UPDATE adresse SET mitarbeiternummer='$mitarbeiternummer' WHERE id='$id' AND (mitarbeiternummer='0' OR mitarbeiternummer='') LIMIT 1");

      } else 
        $mitarbeiternummer="noch keine";
    }
  }


  function AdresseDelKontakt()
  {
    $id = $this->app->Secure->GetGET("id");
    $lid = $this->app->Secure->GetGET("lid");

    //INSERT
    $this->app->DB->Delete("DELETE FROM adresse_kontakte WHERE id='$lid' LIMIT 1");

    //$this->AdresseEdit();
    header("Location: index.php?module=adresse&action=edit&id=$id");
    exit;
  }



  function AdresseNewKontakt()
  {
    $bezeichnung = $this->app->Secure->GetGET("bezeichnung");
    $kontakt = $this->app->Secure->GetGET("kontakt");
    $id = $this->app->Secure->GetGET("id");

    //INSERT
    $this->app->DB->Insert("INSERT INTO adresse_kontakte (id,adresse,bezeichnung,kontakt) VALUES ('','$id','$bezeichnung','$kontakt')");

    //$this->AdresseEdit();
    header("Location: index.php?module=adresse&action=edit&id=$id");
    exit;
  }

  function AdresseOpen()
  {

    $kundennummer=$this->app->Secure->GetGET("kundennummer");
    $projekt=$this->app->Secure->GetGET("projekt");

    if($projekt!="")
    {
      $projektid = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
      $id = $this->app->DB->Select("SELECT id FROM adresse WHERE projekt='$projektid' AND kundennummer='$kundennummer' LIMIT 1");
    } else {
      $id = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$kundennummer' LIMIT 1");
    }

    $cmd=$this->app->Secure->GetGET("cmd");
    header("Location: index.php?module=adresse&action=".$cmd."&id=".$id);
    exit;
  }	


  function AdresseGetid()
  {

    $kundennummer=$this->app->Secure->GetGET("kundennummer");
    $projekt=$this->app->Secure->GetGET("projekt");

    if($projekt!="")
    {
      $projektid = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
      $id = $this->app->DB->Select("SELECT id FROM adresse WHERE projekt='$projektid' AND kundennummer='$kundennummer' LIMIT 1");
    } else {
      $id = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$kundennummer' LIMIT 1");
    }

    echo $id;
    exit;
  }	


  function AdresseEdit()
  {
    $id = $this->app->Secure->GetGET("id");

    if($this->app->erp->DisableModul("adresse",$id))
    {
      //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","Zur&uuml;ck zur &Uuml;bersicht");
      $this->AdresseMenu();
      return;
    } 

    $adresse_kontakte = $this->app->Secure->GetPOST("adresse_kontakte");
    if(count($adresse_kontakte) > 0)
    {
      foreach($adresse_kontakte as $key=>$value)
        $this->app->DB->Update("UPDATE adresse_kontakte SET kontakt='$value' WHERE id='$key' LIMIT 1");
    }
    if(is_numeric($id)) {
      $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      $lieferantennummer = $this->app->DB->Select("SELECT lieferantennummer FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      $mitarbeiternummer= $this->app->DB->Select("SELECT mitarbeiternummer FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      $logfile = $this->app->DB->Select("SELECT logfile FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      $logfile  = str_replace(';',"\r\n",$logfile);
      $this->app->Tpl->Set('LOGFILE',"<textarea cols=\"60\" rows=\"5\">$logfile</textarea>");
    }

    //$this->app->erp->PrinterIcon();

    $telefon= $this->app->DB->Select("SELECT telefon FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    if($telefon!="")
    {
      $telefon = str_replace("/","",$telefon);
      $telefon = str_replace(" ","",$telefon);
      $this->app->Tpl->Set('TELEFONBUTTON',"<a href=\"tel://$telefon\">Call</a>");
    }


    $this->app->Tpl->Set('ABBRECHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=adresse&action=list';\">");

    //Weitere Kontakte
    $buttons_kontakte = "

      <script>

      $(document).ready(function(){

          $(\".button\").button();

          $('button#clipboard-dynamic').zclip({
path:'./js/ZeroClipboard.swf',
copy:function(){return '".$this->app->erp->AdresseAnschriftString($id)."';}
});
          });

</script>

<button type=button id=\"clipboard-dynamic\" class=\"button\">Adresse in Zwischenspeicher</button>

<a href=\"#\" class=\"button\" onclick=\"var bezeichnung =  prompt('Etikett bzw. Bezeichnung( (z.B. E-Mail, Skype, ICQ, ...):','Telefon Privat'); 
if((bezeichnung !=null && bezeichnung!='')) {var kontakt =  prompt('Kontakt:',''); if((bezeichnung !=null && bezeichnung!='') && (kontakt!=null && kontakt!='')) { window.location.href='index.php?module=adresse&action=newkontakt&id=".$id."&bezeichnung='+bezeichnung+'&kontakt='+kontakt;}}\">
Weitere Kontaktinfos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

$kontakte = $this->app->DB->SelectArr("SELECT * FROM adresse_kontakte WHERE adresse='$id'");
for($i=0;$i<count($kontakte);$i++)
{
  $table_kontakte .= "<tr><td width=260>".$kontakte[$i]['bezeichnung']."&nbsp;<a href=\"#\" onclick=\"if(!confirm('".$kontakte[$i]['bezeichnung']." wirklich entfernen?')) 
    return false; else window.location.href='index.php?module=adresse&action=delkontakt&id=".$id."&lid=".$kontakte[$i]['id']."';\">x</a></td><td><input type=text name=\"adresse_kontakte[".$kontakte[$i]['id']."]\" value=\"".$kontakte[$i]['kontakt']."\" size=\"30\"></td></tr>";
}


$this->app->Tpl->Set('BUTTON_KONTAKTE',"<table width=100%>$table_kontakte</table><br>");

$this->app->Tpl->Add('BUTTON_KONTAKTE',$buttons_kontakte);



$things = array('angebot','auftrag','rechnung','lieferschein','gutschrift');

foreach($things as $key=>$value)
  $buttons_kunde .= '
  <a href="#" onclick="if(!confirm(\''.ucfirst($value).' wirklich anlegen?\')) return false; else window.location.href=\'index.php?module=adresse&action=createdokument&id='.$id.'&cmd='.$value.'\';">
  <table width="110"><tr><td>'.ucfirst($value).'</td></tr></table></a>';

  $things = array('bestellung');
foreach($things as $key=>$value)
  $buttons_lieferant .= '
  <a href="#" onclick="if(!confirm(\''.ucfirst($value).' wirklich anlegen?\')) return false; else window.location.href=\'index.php?module=adresse&action=createdokument&id='.$id.'&cmd='.$value.'\';">
  <table width="110"><tr><td>'.ucfirst($value).'</td></tr></table></a>';



  if($kundennummer !="") $buttons = $buttons_kunde;
  if($lieferantennummer !="") $buttons .= $buttons_lieferant;

  if($buttons !=""){
    $this->app->Tpl->Set('BUTTONS','<fieldset><legend>Neu Anlegen</legend>
        <div class="tabsbutton" align="center">'.$buttons.'</div></fieldset>');
  }

if(is_numeric($id))
  $anzahl_rollen = $this->app->DB->Select("SELECT SUM(id) FROM adresse_rolle WHERE adresse='$id'");

$anzahl_lead = $this->app->DB->Select("SELECT lead FROM adresse WHERE id='$id'");
$anzahl_rollen = $anzahl_rollen + $anzahl_lead;


if($anzahl_rollen<1)
{

  if($this->app->erp->Version()=="stock") 
  {
    $lieferant_checked = "checked";
    $kunde_checked = "";
  } else {
    $lieferant_checked = "";
    $kunde_checked = "checked";
  }

  if($this->app->erp->RechteVorhanden("crm","list"))
    $leadbox = "<input type=\"checkbox\" value=\"1\" name=\"lead\">&nbsp;als Lead markieren";

  $this->app->Tpl->Set('MESSAGEROLLE',"
      <div class=\"success\">Die Adresse hat noch keine Rolle. Soll eine <a href=\"index.php?module=adresse&action=rollen&id=$id\">Rolle</a> anlegt werden: <form action=\"index.php?module=adresse&action=rollen&id=$id\" method=\"post\">
      <input type=\"checkbox\" value=\"1\" name=\"kunde\" $kunde_checked>&nbsp;als Kunde markieren
      <input type=\"checkbox\" value=\"1\" name=\"lieferant\" $lieferant_checked>&nbsp;als Lieferant markieren
      <input type=\"checkbox\" value=\"1\" name=\"mitarbeiter\">&nbsp;als Mitarbeiter markieren
      $leadbox
      <input type=\"submit\" value=\"Jetzt markieren\" name=\"submitrolle\">
      </form></div>");
}

if($anzahl_rollen==1 && $anzahl_lead==1)
{
$this->app->Tpl->Set('MESSAGEROLLE',"<div class=\"info\">Diese Adresse ist ein potentieller Neukunde (Lead).</div>");

}


/* google maps */
//$this->app->Tpl->Set(ONLOAD,'onload="load()" onunload="GUnload()"');

//$key = "ABQIAAAAF-3x19QGjrDnM0qot_5RLhRPMKv2yVfFADlvP9s78xqAFkzplRTXptJWNlxCNcnzn7tujwTd6WlJDQ";
/*
   $adresse= $this->app->DB->Select("SELECT CONCAT(strasse,'+,',plz,'+',ort,',+',land) FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
   $adresse = str_replace(' ','+',$adresse);
//$adresse = "1600+Amphitheatre+Parkway,+Mountain+View,+CA";
//$adresse = "Holzbachstrasse+4,+Augsburg";
$geo = implode(file("http://maps.google.com/maps/geo?q=".$adresse."&output=xml&hl=de&key=".$key));  $geo = utf8_encode($geo);

$xml = xml_parser_create();  xml_parse_into_struct($xml, $geo, $ausgabe);  xml_parser_free($xml);

foreach($ausgabe as $a) {    
if($a["tag"] == "COORDINATES") $position = $a["value"];    
}
$position = explode(",", $position);  $position = $position[1].",".$position[0];

$this->app->Tpl->Set(JAVASCRIPT,'  
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAF-3x19QGjrDnM0qot_5RLhRPMKv2yVfFADlvP9s78xqAFkzplRTXptJWNlxCNcnzn7tujwTd6WlJDQ"
type="text/javascript"></script>
<script type="text/javascript">

function load() {
if (GBrowserIsCompatible()) {
var map = new GMap2(document.getElementById("map"));
map.setCenter(new GLatLng('.$position.'), 13);
}
}
</script>    
<div id="map" style="width: 500px; height: 300px"></div>
'); 
 */
// aktiviere tab 1
$this->app->Tpl->Set('AKTIV_ADRESSE',"selected");
$this->AdresseNummern($id);
if($kundennummer==0) $kundennummer = "keine Kundennummer vorhanden";
if($lieferantennummer==0)$lieferantennummer = "keine Lieferantennummer vorhanden";
if($mitarbeiternummer==0)$mitarbeiternummer = "keine Mitarbeiternummer vorhanden";


$this->app->Tpl->Set('KUNDENNUMMERANZEIGE',$kundennummer);
$this->app->Tpl->Set('LIEFERANTENNUMMERANZEIGE',$lieferantennummer);
$this->app->Tpl->Set('MITARBEITERNUMMERANZEIGE',$mitarbeiternummer);

$this->AdresseMenu();
$this->app->Tpl->Set('TABLE_ADRESSE_KONTAKTHISTORIE',"TDB");
$this->app->Tpl->Set('TABLE_ADRESSE_ROLLEN',"TDB");

$this->app->Tpl->Set('TABLE_ADRESSE_USTID',"TDB");


$this->app->Tpl->Set('SUBSUBHEADING',"Rolle anlegen");
if($this->app->Secure->GetPOST("rolleanlegen")!="")
$this->app->Tpl->Set('AKTIV_TAB3',"selected");
else
$this->app->Tpl->Set('AKTIV_TAB1',"selected");

$abweichende_rechnungsadresse= $this->app->DB->Select("SELECT abweichende_rechnungsadresse FROM adresse WHERE id='$id' LIMIT 1");
$this->app->Tpl->Set('ABWEICHENDERECHNUNGSADRESSESTYLE',"none");
if($abweichende_rechnungsadresse=="1") $this->app->Tpl->Set('ABWEICHENDERECHNUNGSADRESSESTYLE',"");

$liefersperre= $this->app->DB->Select("SELECT liefersperre FROM adresse WHERE id='$id' LIMIT 1");
if($liefersperre=="1")
{
  $this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Achtung! Bei dieser Adresse ist die Liefersperre gesetzt!</div>");
}
parent::AdresseEdit();
$this->app->erp->MessageHandlerStandardForm();

}

function AdresseRollen()
{ 
  $this->AdresseMenu();

  $id = $this->app->Secure->GetGET("id");
  $reload = $this->app->Secure->GetGET("reload");
  $submitrolle = $this->app->Secure->GetPOST("submitrolle");

  $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$id' LIMIT 1");

  if($submitrolle!="")
  {

    if($this->app->Secure->GetPOST("kunde")=="1")
      $this->app->erp->AddRolleZuAdresse($id, "Kunde", "von", "Projekt", $projekt); 

    if($this->app->Secure->GetPOST("mitarbeiter")=="1")
      $this->app->erp->AddRolleZuAdresse($id, "Mitarbeiter", "von", "Projekt", $projekt); 

    if($this->app->Secure->GetPOST("lieferant")=="1")
      $this->app->erp->AddRolleZuAdresse($id, "Lieferant", "von", "Projekt", $projekt); 

    if($this->app->Secure->GetPOST("lead")=="1")
      $this->app->DB->Update("UPDATE adresse SET lead=1 WHERE id='$id' LIMIT 1");
  }

  $this->AdresseNummern($id);

  if($submitrolle!="")
  {
    header("Location: index.php?module=adresse&action=edit&id=$id");
    exit;
  }
  /*
     $widget = new WidgetAdresse_rolle($this->app,TAB1);
     $widget->form->SpecialActionAfterExecute("close_refresh",
     "index.php?module=adresse&action=rollen&id=$id&reload=true");

     $widget->Create();
   */

  if($this->app->Secure->GetPOST("rolleanlegen")!="")
  {
    $subjekt = $this->app->Secure->GetPOST("subjekt");
    $objekt = $this->app->Secure->GetPOST("objekt");
    if($objekt=="Projekt")
    {
      $projekt =  $this->app->Secure->GetPOST("parameter");
      $parameter = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
    } else {
      $gruppe=  $this->app->Secure->GetPOST("gruppe");
      $parameter = $this->app->DB->Select("SELECT id FROM gruppen WHERE CONCAT(name,' ',kennziffer)='$gruppe' LIMIT 1");
    }

    if(!($objekt=="Gruppe" && $parameter <=0))
    {
      $checkrolle_verband = $this->app->DB->Select("SELECT a.id FROM adresse_rolle a LEFT JOIN gruppen g ON g.id=a.parameter WHERE 
          (a.bis='0000-00-00' OR a.bis <=NOW()) AND a.adresse='$id' AND a.objekt='Gruppe' AND g.art='verband' LIMIT 1");

      $gruppe_is_verband = $this->app->DB->Select("SELECT id FROM gruppen WHERE id='$parameter' AND art='verband' LIMIT 1");
      /*
         if($checkrolle_verband > 0 && $gruppe_is_verband)
         {
         $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Jede Adresse (Kunde) darf nur in einem Verband sein! L&ouml;schen oder
         deaktivieren Sie die bestehende Rolle.</div>");
         header("Location: ./index.php?module=adresse&action=rollen&id=$id&msg=$msg");
         exit;
         } else 
       */
      $this->app->erp->AddRolleZuAdresse($id, $subjekt, "von", $objekt, $parameter); 
    }
    else {
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Rolle nicht gespeichert! Bitte geben Sie eine Gruppe an!</div>");
      header("Location: ./index.php?module=adresse&action=rollen&id=$id&msg=$msg");
      exit;
    }
  }	

  $this->app->YUI->AutoComplete("parameter","projektname",1);
  $this->app->YUI->AutoComplete("gruppe","gruppe");

  $subjekt= $this->app->erp->GetAdressSubject();
  $this->app->Tpl->Set('ROLLE_SELECT',$this->app->erp->GetSelect($subjekt,""));

  $this->app->Tpl->Parse('TAB1',"adresse_rolle.tpl");
  if($this->app->Secure->GetPOST("rolleanlegen")!="" || $reload=="true")
  {
    header("Location: index.php?module=adresse&action=rollen&id=$id");
    exit;
  } 


  $this->app->Tpl->Set('SUBSUBHEADING',"Rollen der Adresse");
  $this->app->Tpl->Set('TABTEXT',"Rollen");

  $table = new EasyTable($this->app);
  $table->Query("SELECT a.subjekt as Rolle, 
        if(a.objekt='','ALLE',a.objekt) as Zuordnung, 
        if(a.objekt='Projekt',if(a.parameter='','ALLE',p.abkuerzung),CONCAT(g.name,' ',g.kennziffer)) as auswahl, 
        DATE_FORMAT(a.von,'%d.%m.%Y') as seit, if(a.bis='0000-00-00','aktuell',DATE_FORMAT(a.bis,'%d.%m.%Y')) as bis,  a.id
        FROM adresse_rolle a  LEFT JOIN projekt p ON a.parameter=p.id 
        LEFT JOIN gruppen g ON g.id=a.parameter
        WHERE a.adresse='$id'");

  $table->DisplayNew('TAB1NEXT', "<!--<a href=\"index.php?module=adresse&action=rolleeditpopup&frame=false&id=%value%\" 
      onclick=\"makeRequest(this);return false\"><img src=\"./themes/[THEME]/images/edit.png\" border=\"0\"></a>&nbsp;-->
      <a onclick=\"if(!confirm('Rolle wirklich l&ouml;schen?')) return false; else window.location.href='index.php?module=adresse&action=rolledelete&id=$id&sid=%value%';\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a>&nbsp;<a onclick=\"var von =  prompt('Von Datum:','');   if((von !=null && von!='')) {var bis =  prompt('Bis Datum:',''); if((von !=null && von!='') ) { window.location.href='index.php?module=adresse&action=rolledatum&sid=%value%&id=".$id."&von='+von+'&bis='+bis;}}\"><img src=\"./themes/[THEME]/images/edit.png\" border=\"0\"></a>");


  $this->app->Tpl->Parse('PAGE',"tabview.tpl");
} 

function AdresseUSTPopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  $id = $this->app->Secure->GetGET("id");
  if($frame=="false")
  {
    // hier nur fenster größe anpassen
    $this->app->YUI->IframeDialog(650,530);
  } else {

    // nach page inhalt des dialogs ausgeben
    //$sid = $this->app->DB->Select("SELECT shop FROM shopexport_kampange WHERE id='$id' LIMIT 1");

    $this->AdresseUstprf();
    //$widget = new WidgetShopexport_kampange(&$this->app,'PAGE');

    //$widget->form->SpecialActionAfterExecute("close_refresh",
    //  "index.php?module=marketing&action=kampangenedit&id=$sid");

    //$widget->Edit();

    $this->app->BuildNavigation=false;
  }
}



function AdresseUstprf()
{

  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");

  //$this->app->Tpl->Set(HEADING,"Adresse (USTID-Pr&uuml;fung)");
  //$this->app->Tpl->Set('SUBSUBHEADING',"Umstatzsteuerpr&uuml;fungen");
  //Formula lieferadresse

  $table = new EasyTable($this->app);
  $table->Query("SELECT DATE_FORMAT(datum_online,GET_FORMAT(DATE,'EUR')) AS Datum, ustid,strasse, plz, ort,status,id FROM ustprf WHERE adresse='$id'");

  $table->DisplayNew('INHALT',"
      <a href=\"index.php?module=adresse&action=ustprfedit&id=$id&lid=%value%\">edit</a>
      <a href=\"index.php?module=adresse&action=ustprfneu&id=$id\">new</a>
      ","");
  //"<a href=\"index.php?module=adresse&action=ustprfneu&id=$id\">Neue USTID-Pr&uuml;fung anlegen</a>");

  $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
  $this->app->Tpl->Set('AKTIV_TAB1',"selected");

  $this->app->Tpl->Set('INHALT',"");


  if($this->app->Secure->GetPOST("name")!="")
  {
    //speichern
    $lid = $this->app->FormHandler->FormToDatabase("ustprf","adresse",$id);
    //$this->AdresseUstprf();
    //$lid = $this->app->DB->GetInsertID();
    header("Location: index.php?module=adresse&action=ustprfedit&id=$id&lid=$lid");
    exit;
  }

  //$this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">Adresse unterschiedlich!!! <br>Soll Adressdatensatz vom Kunden angepasst werden?</div>");

  //$this->app->Tpl->Set(SUBHEADING,"UST-ID Pr&uuml;fung neu anlegen");
  $this->app->FormHandler->FormGetVars("adresse",$id);

  $this->app->Tpl->Parse('INHALT',"ustprfneu.tpl");
  $this->app->Tpl->Parse('TAB2',"rahmen_submit.tpl");

  $this->app->Tpl->Parse('PAGE',"ustuebersicht.tpl");
}

function AdresseUstprfEdit()
{
  $id = $this->app->Secure->GetGET("id");
  $lid = $this->app->Secure->GetGET("lid");

  // $this->app->Tpl->Set(HEADING,"Adresse (USTID-Pr&uuml;fung)");

  $ust = $this->app->Secure->GetPOST("ustid");  
  //$ust = $this->app->Secure->GetPOST("ustid2");
  $name = $this->app->Secure->GetPOST("name");
  $ort = $this->app->Secure->GetPOST("ort");
  $strasse = $this->app->Secure->GetPOST("strasse");
  $plz = $this->app->Secure->GetPOST("plz");
  //$druck = $this->app->Secure->GetPOST("druck");

  if($this->app->Secure->GetPOST("aendern") != "")
  {
    //firmenname
    //ort
    //strasse
    //plz
    $this->app->DB->Update("UPDATE auftrag SET name='$name', ort='$ort',ustid='$ust', strasse='$strasse', plz='$plz' WHERE status='freigegeben' AND adresse='$id'");
    $this->app->DB->Update("UPDATE adresse SET name='$name', ort='$ort',ustid='$ust', strasse='$strasse', plz='$plz' WHERE id='$id'");
    $this->app->DB->Update("UPDATE ustprf SET name='$name' WHERE id='$lid'");
    $this->app->DB->Update("UPDATE ustprf SET plz='$plz' WHERE id='$lid'");
    $this->app->DB->Update("UPDATE ustprf SET ort='$ort' WHERE id='$lid'");
    $this->app->DB->Update("UPDATE ustprf SET ustid='$ust' WHERE id='$lid'");
    $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Adresse und USTID bei Kunde und offenen Auftraegen genaendert!</div>");  
  }


  $ust = str_replace(" ","",$ust);
  $status = $this->app->DB->Select("SELECT status FROM ustprf WHERE id='$lid' LIMIT 1");

  $datum_online = $this->app->DB->Select("SELECT datum_online FROM ustprf WHERE id='$lid' LIMIT 1");
  if($this->app->Secure->GetPOST("online")!="")
  {
    if($status!="erfolgreich" && $status!="fehlgeschlagen")
    {     

      if(!$this->app->erp->CheckUSTFormat($ust)){
        $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">UST-Nr. bzw. Format fuer Land ist nicht korrekt</div>");
      }else{
        //$UstStatus = $this->app->erp->CheckUst($ust,"SE556459933901","Wind River AB","Kista","Finlandsgatan 52","16493","ja");	

        $UstStatus = $this->app->erp->CheckUst("DE263136143", $ust, $name, $ort, $strasse, $plz, $druck="nein");

        if(is_array($UstStatus) && !is_numeric($UstStatus))
        {
          $tmp = new USTID();
          $msg = $tmp->errormessages($UstStatus['ERROR_CODE']);

          if($UstStatus['ERROR_CODE']==200)
            $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">UST g&uuml;ltig aber Name, Ort oder PLZ wird anders geschrieben!</div>");  
          else
            $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"error\">Fehlgeschlagen Code:<br>{$UstStatus['ERROR_CODE']}($msg)</div>");  

          $this->app->Tpl->Set('ERG_NAME', $UstStatus['ERG_NAME']);
          $this->app->Tpl->Set('ERG_PLZ', $UstStatus['ERG_PLZ']);
          $this->app->Tpl->Set('ERG_STR', $UstStatus['ERG_STR']);
          $this->app->Tpl->Set('ERG_ORT', $UstStatus['ERG_ORT']);

        } else if($UstStatus==1){
          $this->app->Tpl->Set(STATUS,"<div style=\"background-color: green;\">Vollst&auml;ndig</div>");
          // jetzt brief bestellen! 
          // $UstStatus = $this->app->erp->CheckUst("DE263136143", $ust, $name, $ort, $strasse, $plz, $druck="ja");
          // $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$lid.',"'.date("Y-m-d H:i:s").'","Online-Abfrage OK + Brief bestellt", "'.$this->app->User->GetName().'")');
          $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Online-Pr&uuml;fung erfolgreich!</div>");
          $this->app->DB->Update('UPDATE ustprf SET datum_online=NOW(),	status="erfolgreich" WHERE id='.$lid.'');
        } else {
          $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Allgemeiner Fehler! Es wurde kein Brief bestellt!<br><br>".$UstStatus."</div>");
          $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$lid.',"'.date("Y-m-d H:i:s").'","'.$UstStatus.'", "'.$this->app->User->GetName().'")');
          $this->app->DB->Update('UPDATE ustprf SET datum_online=NOW(),	status="allgemeiner fehler" WHERE id='.$lid.'');
        }

      }			
    } else {

      if($status=="fehlgeschlagen")
        $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Die Abfrage ist inaktiv da sie als fehlgeschlagen bereits markiert worden ist!</div>");
      else
      {
        $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Online-Pr&uuml;fung erfolgreich!</div>");
      }
    }
  } 

  $briefbestellt = $this->app->DB->Select("SELECT briefbestellt FROM ustprf WHERE id='$lid' LIMIT 1");

  if($this->app->Secure->GetPOST("brief")!="" && $briefbestellt=="0000-00-00" && $datum_online!="0000-00-00 00:00:00")
  {
    $UstStatus = $this->app->erp->CheckUst("DE263136143", $ust, $name, $ort, $strasse, $plz, $druck="ja");
    $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$lid.',"'.date("Y-m-d H:i:s").'","Online-Abfrage OK + Brief bestellt", "'.$this->app->User->GetName().'")');
    $this->app->DB->Update('UPDATE ustprf SET briefbestellt=NOW() WHERE id='.$lid.'');
    $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Brief wurde bestellt!</div>");
  } else if ($briefbestellt!="0000-00-00")
  {
    $briefbestellt = $this->app->String->Convert($briefbestellt,"%1-%2-%3","%3.%2.%1");
    $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Brief wurde bereits am $briefbestellt bestellt!</div>");
    $this->app->Tpl->Set('BESTELLT',$briefbestellt);
  }
  else if ($datum_online=="0000-00-00 00:00:00")
  {
    $briefbestellt = $this->app->String->Convert($briefbestellt,"%1-%2-%3","%3.%2.%1");
    $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Brief kann auf Grund erfolgloser Online-Pr&uuml;fung nicht bestellt werden!</div>");
    $this->app->Tpl->Set('BESTELLT',$briefbestellt);
  }


  if($this->app->Secure->GetPOST("benachrichtigen") != "")
  {

    if($status=="benachrichtig" || $status=="fehlgeschlagen")
    {
      if($status=="fehlgeschlagen")
        $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">UST-Pr&uuml;fung wurde bereits als fehlgeschlagen markiert! Kunde wurde ebenfalls bereits benachrichtigt!</div>");
      else
        $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Kunde wurde bereits benachrichtigt!</div>");
    } else {
      //echo "ACHTUNG hier muss noch eine MAIL versendet werden!!!!";

      $mailtext = $this->app->Secure->GetPOST("mailtext");

      $to = $this->app->DB->Select("SELECT email FROM adresse WHERE id='$id' LIMIT 1"); 
      $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$id' LIMIT 1"); 
      $to_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$id' LIMIT 1"); 

      $this->app->erp->MailSend($this->app->erp->GetFirmaMail(),$this->app->erp->GetFirmaName(),$to,$to_name,"Your Tax ID number",$mailtext);
      $this->app->DB->Insert("INSERT INTO dokumente_send (id,dokument,zeit,bearbeiter,adresse,projekt,art,betreff,text) VALUES('','vatid',NOW(),'".$this->app->User->GetName()."','$id','$projekt','email','Your Tax ID number','$mailtext')");

      $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$lid.',"'.date("Y-m-d H:i:s").'","Kunde wurde benachrichtigt", "'.$this->app->User->GetName().'")');
      $this->app->DB->Update('UPDATE ustprf SET datum_online=NOW(),	status="benachrichtig" WHERE id='.$lid.'');
      $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Kunde wurde per Mail benachrichtigt!</div>");
    }
  }

  if($this->app->Secure->GetPOST("manuellok") != "")
  {
    $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$lid.',"'.date("Y-m-d H:i:s").'","Manuell auf OK gesetzt", "'.$this->app->User->GetName().'")');
    $this->app->DB->Update('UPDATE ustprf SET briefbestellt=NOW(),datum_online=NOW(),status="erfolgreich" WHERE id='.$lid.'');
    $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">Wurde manuell auf OK gesetzt!</div>");
  }



  if($this->app->Secure->GetPOST("fehlgeschlagen") != "" && $briefbestellt=="0000-00-00")
  {
    if($status=="fehlgeschlagen")
    {
      $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">UST-Pr&uuml;fung wurde bereits als fehlgeschlagen markiert! Kunde wurde ebenfalls bereits benachrichtigt!</div>");
    } else 
    {
      echo "ACHTUNG hier muss noch eine MAIL versendet werden!!!! wenn man das will??????";
      $this->app->DB->Update('UPDATE ustprf SET datum_online=NOW(),	status="fehlgeschlagen" WHERE id='.$lid.'');
      $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$lid.',"'.date("Y-m-d H:i:s").'","Abfrage als fehlgeschlagen markiert", "'.$this->app->User->GetName().'")');
      $this->app->Tpl->Set('STATUSMELDUNG',"<div class=\"warning\">UST-Pr&uuml;fung wurde als fehlgeschlagen markiert! Kunde wurde per Mail benachrichtigt!</div>");
    }
  }

  $datum_brief = $this->app->DB->Select("SELECT datum_brief FROM ustprf WHERE id='$lid' LIMIT 1");
  if($datum_brief!='0000-00-00')
  {
    $datum_brief = $this->app->String->Convert($datum_brief ,"%1-%2-%3","%3.%2.%1");
    $this->app->Tpl->Set('EINGANG',$datum_brief);

  }


  $this->AdresseMenu();

  //$this->app->Tpl->Set(SUBHEADING,"UST-ID Pr&uuml;fung neu anlegen");
  $this->app->FormHandler->FormGetVars("ustprf",$lid);

  $name = $this->app->DB->Select("SELECT name FROM ustprf WHERE id='$lid'");
  $ort = $this->app->DB->Select("SELECT ort FROM ustprf WHERE id='$lid'");
  $land = $this->app->DB->Select("SELECT land FROM ustprf WHERE id='$lid'");

  $this->app->Tpl->Set('SUCHE',"$name+$ort+$land");

  $this->app->Tpl->Set('ID',$id);

  if($ust != "")
    $this->app->Tpl->Set('USTID', $ust);

  if($this->app->Secure->GetPOST("name") != "")
    $this->app->Tpl->Set('NAME', $this->app->Secure->GetPOST("name"));  

  if($this->app->Secure->GetPOST("ort") != "")
    $this->app->Tpl->Set('ORT', $this->app->Secure->GetPOST("ort"));

  if($this->app->Secure->GetPOST("plz") != "")
    $this->app->Tpl->Set('PLZ', $this->app->Secure->GetPOST("plz"));

  if($this->app->Secure->GetPOST("strasse") != "")
    $this->app->Tpl->Set('STRASSE', $this->app->Secure->GetPOST("strasse"));


  $this->app->Tpl->Set('ID',$this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1"));
  $this->app->Tpl->Set('LAND',$this->app->DB->Select("SELECT land FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1"));
  $this->app->Tpl->Set('STATUS',$this->app->DB->Select("SELECT status FROM ustprf WHERE id='$lid' LIMIT 1"));

  //$this->AdresseProtokoll($lid);

  $this->app->Tpl->Parse('INHALT',"ustprfedit.tpl");
  $this->app->Tpl->Parse('PAGE',"rahmen_submit.tpl");
}

function AdresseProtokoll($lid)
{
  if($lid!=""){
    $table = new EasyTable($this->app);

    $table->Query("SELECT DATE_FORMAT(zeit, '%d.%m.%Y %H:%i') AS Datum, bemerkung,bearbeiter FROM ustprf_protokoll WHERE ustprf_id='$lid' ORDER BY zeit DESC", 0, "noAction");

    $table->DisplayNew('PROTOKOLL',"", "noAction");

  }
}


function AdresseKundeArtikel()
{

  $this->AdresseMenu();

  $this->app->YUI->TableSearch('TAB1',"adresseartikel");
  $this->app->YUI->TableSearch('TAB2',"adresseseriennummern");
  $this->app->YUI->TableSearch('TAB3',"adresse_artikel_geraet");
  $this->app->YUI->TableSearch('TAB4',"adresse_artikel_serviceartikel");
  $this->app->YUI->TableSearch('TAB5',"adresse_artikel_gebuehr");

  $this->app->Tpl->Parse('PAGE',"adresse_artikel.tpl");

}

function AdresseLieferantArtikel()
{
  $this->AdresseMenu();

  $this->app->YUI->TableSearch('TAB1',"lieferantartikel");
  $this->app->Tpl->Parse('PAGE',"adresse_lieferprogramm.tpl");

}

function AdresseBestellungMarkiert()
{
  $id = $this->app->Secure->GetGET("id");
  $sid = $this->app->Secure->GetGET("sid");


  // markieren

  $geliefert = $this->app->DB->Select("SELECT geliefert FROM bestellung_position WHERE id='$sid' LIMIT 1");
  $menge  = $this->app->DB->Select("SELECT menge FROM bestellung_position WHERE id='$sid' LIMIT 1");
  $tmp = $menge - $geliefert;
  if($tmp < 0) $tmp=0;
  $this->app->DB->Update("UPDATE bestellung_position SET abgeschlossen='1', mengemanuellgeliefertaktiviert='$tmp', geliefert='$menge',manuellgeliefertbearbeiter='".$this->app->User->GetName()."' WHERE id='$sid' LIMIT 1");

  header("Location: index.php?module=adresse&action=offenebestellungen&id=$id&cmd=offeneartikel");
  exit;


}


function AdresseOffeneBestellungen()
{

  $cmd = $this->app->Secure->GetGET("cmd");
  $id = $this->app->Secure->GetGET("id");
  $this->app->Tpl->Set('ID',$id);


  $this->AdresseMenu();


  $this->app->Tpl->Set('UEBERSCHRIFT1',"Bestellungen");
  $this->app->Tpl->Set('INFORMATIONSTEXT',"Alle Bestellungen bei aktuellem Lieferant.");
  //Formula lieferadresse
  $table = new EasyTable($this->app);
  $table->Query("SELECT DATE_FORMAT(datum,'%d.%m.%Y') as Bestelldatum, if(belegnr,belegnr,'ohne Nummer') as beleg, name, status, 
      DATE_FORMAT(versendet_am,'%d.%m.%Y') versendet_am, versendet_durch, versendet_per, id
      FROM bestellung WHERE adresse='$id' order by datum DESC, id DESC LIMIT 10");
  $table->DisplayNew('INHALT', "<a href=\"index.php?module=bestellung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/edit.png\"></a>
      <a href=\"index.php?module=bestellung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/pdf.png\"></a>
      <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=bestellung&action=copy&id=%value%';\">
      <img src=\"./themes/[THEME]/images/copy.png\" border=\"0\"></a>
      ");
  $summe = $this->app->DB->Select("SELECT SUM(bp.menge*bp.preis) FROM bestellung_position bp LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN projekt p ON p.id=bp.projekt WHERE b.adresse='$id'");
  $this->app->Tpl->Set('EXTEND',"Gesamt: $summe EUR");

  // easy table mit arbeitspaketen YUI als template 
  $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
  $this->app->Tpl->Set('TAB1SELECT',"selected");
  $this->app->Tpl->Set('EXTEND',"");
  $this->app->Tpl->Set('INHALT',"");




  $this->app->Tpl->Set('UEBERSCHRIFT1',"Offen Artikel");
  $this->app->Tpl->Set('INFORMATIONSTEXT',"Alle noch nicht gelieferten Artikel bei aktuellem Lieferant. Jederzeit kann mit dem Pfeil eine Artikel als geliefert markiert werden. <br>Hinweis: Eigentlich
      sollte jeder Artikel durch die Paketdistribution aus dieser Liste bei der Lieferung verschwinden.");

  $this->app->Tpl->Set('SUBSUBHEADING',"Offene Artikel");
  //Formula lieferadresse
  $table = new EasyTable($this->app);
  $table->Query("SELECT DATE_FORMAT(b.datum,'%d.%m.%Y') as Bestellung, LEFT(bp.bezeichnunglieferant,20) as name, a.nummer as 'Artikel-Nr.', bp.bestellnummer as 'best.-Nr',
      if(bp.lieferdatum,DATE_FORMAT(bp.lieferdatum,'%d.%m.%Y'),'sofort') as lieferdatum,
      p.abkuerzung, bp.menge, bp.geliefert, FORMAT(bp.preis,2) as preis, bp.id
      FROM bestellung_position bp LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN artikel a ON a.id=bp.artikel LEFT JOIN projekt p ON p.id=bp.projekt 
      WHERE b.adresse='$id' AND bp.geliefert < bp.menge AND (bp.abgeschlossen IS NULL OR bp.abgeschlossen=0) ORDER by datum DESC");
  $table->DisplayNew('INHALT', "
      <a onclick=\"if(!confirm('Wirklich als geliefert markieren?')) return false; else window.location.href='index.php?module=adresse&action=adressebestellungmarkieren&sid=%value%&id=[ID]';\">
      <img src=\"./themes/[THEME]/images/right.png\"  width=\"18\"border=\"0\"></a>
      ","geliefert");

  // easy table mit arbeitspaketen YUI als template 
  $this->app->Tpl->Parse('TAB2',"rahmen70.tpl");

  $this->app->Tpl->Set('TAB2SELECT',"selected");
  $this->app->Tpl->Set('INHALT',"");



  $this->app->Tpl->Set('UEBERSCHRIFT1',"Abgeschlossene Artikel");
  $this->app->Tpl->Set('INFORMATIONSTEXT',"Alle abgeschlossenen Artikel der Bestellungen.");

  //Formula lieferadresse
  $table = new EasyTable($this->app);
  $table->Query("SELECT DATE_FORMAT(b.datum,'%d.%m.%Y') as Bestellung, b.belegnr, LEFT(bp.bezeichnunglieferant,20) as name, a.nummer as 'Artikel-Nr.', bp.bestellnummer as nummer, 
      if(bp.lieferdatum,DATE_FORMAT(bp.lieferdatum,'%d.%m.%Y'),'sofort') as lieferdatum, p.abkuerzung as projekt, bp.menge, bp.geliefert, bp.id
      FROM bestellung_position bp LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN artikel a ON a.id=bp.artikel LEFT JOIN projekt p ON p.id=bp.projekt WHERE b.adresse='$id' AND (bp.geliefert >= bp.menge  OR bp.abgeschlossen='1') ORDER by datum DESC");
  $table->DisplayNew('INHALT',"preis", "noAction");

  // easy table mit arbeitspaketen YUI als template 
  $this->app->Tpl->Parse('TAB3',"rahmen70.tpl");

  $this->app->Tpl->Parse('PAGE',"adressebestellung.tpl");

}

function AdresseAccountsPopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  $id = $this->app->Secure->GetGET("id");
  $cmd= $this->app->Secure->GetGET("cmd");

  $this->AdresseAccounts();
  $this->app->BuildNavigation=false;
}

function AdresseAccounts()
{
  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");
  $lid = $this->app->Secure->GetGET("lid");
  $delete = $this->app->Secure->GetGET("delete");
  $create= $this->app->Secure->GetGET("create");
  $cmd= $this->app->Secure->GetGET("cmd");

  $iframe = $this->app->Secure->GetGET("iframe");

  if($iframe=="true")
    $this->app->BuildNavigation=false;

  if($delete==1)
  {
    $this->app->DB->Delete("DELETE FROM adresse_accounts WHERE id='$lid' AND adresse='$id' LIMIT 1"); 
    header("Location: index.php?module=adresse&action=accounts$add_cmd&id=$id&iframe=$iframe");
    exit;
  }
  // neues arbeitspaket
  $widget = new WidgetAdresse_accounts($this->app,TAB1);
  $widget->form->SpecialActionAfterExecute("none",
      "index.php?module=adresse&action=accounts&id=$id&iframe=".$iframe.$add_cmd);
  if($lid > 0)
  {
    $widget->form->SpecialActionAfterExecute("none",
        "index.php?module=adresse&action=accounts&id=$id&iframe=".$iframe.$add_cmd);
    $widget->Edit();
  }
  else
  {
    $widget->Create();
  }

  if($iframe=="true") {
    $einfuegen = "<a onclick=\"Ansprechpartner('%value%'); parent.closeIframe();\"><img src=\"./themes/[THEME]/images/down.png\" border=\"0\"></a>";
  }

  //Formula lieferadresse
  // easy table mit arbeitspaketen YUI als template 
  $this->app->YUI->TableSearch('TAB1',"adresse_accounts");
  //$this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
  $this->app->Tpl->Set('AKTIV_TAB1',"selected");

  if($iframe=="true")
    $this->app->Tpl->Parse('PAGE',"adresse_accounts_uebersicht_popup.tpl");
  else
    $this->app->Tpl->Parse('PAGE',"adresse_accounts_uebersicht.tpl");

}


function AdresseAnsprechpartnerPopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  $id = $this->app->Secure->GetGET("id");
  $cmd= $this->app->Secure->GetGET("cmd");

  if($cmd=="alslieferadresse")
    $als_lieferadresse=true;
  else
    $als_lieferadresse=false;

  $this->AdresseAnsprechpartner($als_lieferadresse);
  $this->app->BuildNavigation=false;
}

function AdresseAnsprechpartnerLieferadressePopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  $id = $this->app->Secure->GetGET("id");

  $this->AdresseAnsprechpartner(true);
  $this->app->BuildNavigation=false;
}

function AdresseStammdatenLieferadressePopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  $id = $this->app->Secure->GetGET("id");

  $this->AdresseStammdaten(true);
  $this->app->BuildNavigation=false;
}



function AdresseStammdaten($als_lieferadresse=false)
{
  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");
  $lid = $this->app->Secure->GetGET("lid");
  $delete = $this->app->Secure->GetGET("delete");
  $create= $this->app->Secure->GetGET("create");
  $cmd= $this->app->Secure->GetGET("cmd");

  if($cmd=="alslieferadresse")
  {
    $this->app->Tpl->Set(STARTDISABLEANREDE,"<!--");
    $this->app->Tpl->Set(ENDEDISABLEANREDE,"-->");
    $als_lieferadresse=true;
    $add_cmd = "&cmd=alslieferadresse";
  }

  $iframe = $this->app->Secure->GetGET("iframe");

  if($iframe=="true")
    $this->app->BuildNavigation=false;

  // neues arbeitspaket

  if($iframe=="true") {
    if($als_lieferadresse)
      $einfuegen = "<a onclick=\"AnsprechpartnerLieferadresse('%value%'); parent.closeIframe();\"><img src=\"./themes/[THEME]/images/down.png\" border=\"0\"></a>";
    else
      $einfuegen = "<a onclick=\"Ansprechpartner('%value%'); parent.closeIframe();\"><img src=\"./themes/[THEME]/images/down.png\" border=\"0\"></a>";
  }
  //Formula lieferadresse
  // easy table mit arbeitspaketen YUI als template 
  if($als_lieferadresse)
    $this->app->YUI->TableSearch('TAB1',"adresse_stammdatenlieferadresselist");
  else
    $this->app->YUI->TableSearch('TAB1',"adresse_ansprechpartnerlist"); //TODO fehlt
  //$this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
  $this->app->Tpl->Set('AKTIV_TAB1',"selected");

  if($iframe=="true")
    $this->app->Tpl->Parse('PAGE',"ansprechpartneruebersicht_popup.tpl");
  else
    $this->app->Tpl->Parse('PAGE',"ansprechpartneruebersicht.tpl");
}


function AdresseAnsprechpartner($als_lieferadresse=false)
{
  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");
  $lid = $this->app->Secure->GetGET("lid");
  $delete = $this->app->Secure->GetGET("delete");
  $create= $this->app->Secure->GetGET("create");
  $cmd= $this->app->Secure->GetGET("cmd");

  if($cmd=="alslieferadresse")
  {
    $this->app->Tpl->Set('STARTDISABLEANREDE',"<!--");
    $this->app->Tpl->Set('ENDEDISABLEANREDE',"-->");
    $als_lieferadresse=true;
    $add_cmd = "&cmd=alslieferadresse";
  }

  $iframe = $this->app->Secure->GetGET("iframe");

  if($iframe=="true")
    $this->app->BuildNavigation=false;


  if($delete==1)
  {
    $this->app->DB->Delete("DELETE FROM ansprechpartner WHERE id='$lid' AND adresse='$id' LIMIT 1"); 
    header("Location: index.php?module=adresse&action=ansprechpartner$add_cmd&id=$id&iframe=$iframe");
    exit;
  }

  // neues arbeitspaket
  $widget = new WidgetAnsprechpartner($this->app,'TAB1');
  $widget->form->SpecialActionAfterExecute("none",
      "index.php?module=adresse&action=ansprechpartner&id=$id&iframe=".$iframe.$add_cmd);
  if($lid > 0)
  {
    $widget->form->SpecialActionAfterExecute("none",
        "index.php?module=adresse&action=ansprechpartner&id=$id&iframe=".$iframe.$add_cmd);
    $widget->Edit();
  }
  else
  {
    $widget->Create();
  }

  if($iframe=="true") {
    if($als_lieferadresse)
      $einfuegen = "<a onclick=\"AnsprechpartnerLieferadresse('%value%'); parent.closeIframe();\"><img src=\"./themes/[THEME]/images/down.png\" border=\"0\"></a>";
    else
      $einfuegen = "<a onclick=\"Ansprechpartner('%value%'); parent.closeIframe();\"><img src=\"./themes/[THEME]/images/down.png\" border=\"0\"></a>";
  }
  //Formula lieferadresse
  // easy table mit arbeitspaketen YUI als template 
  if($als_lieferadresse)
    $this->app->YUI->TableSearch('TAB1',"adresse_ansprechpartnerlieferadresselist");
  else
    $this->app->YUI->TableSearch('TAB1',"adresse_ansprechpartnerlist");
  //$this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
  $this->app->Tpl->Set('AKTIV_TAB1',"selected");

  if($iframe=="true")
    $this->app->Tpl->Parse('PAGE',"ansprechpartneruebersicht_popup.tpl");
  else
    $this->app->Tpl->Parse('PAGE',"ansprechpartneruebersicht.tpl");
}

function AdresseAnsprechpartnerEditPopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  $id = $this->app->Secure->GetGET("id");

  if($frame=="false")
  {
    // hier nur fenster größe anpassen
    $this->app->YUI->IframeDialog(600,320);
  } else {
    // nach page inhalt des dialogs ausgeben
    $widget = new WidgetAnsprechpartner($this->app,'PAGE');
    $adresse = $this->app->DB->Select("SELECT adresse FROM ansprechpartner WHERE id='$id' LIMIT 1");
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=adresse&action=ansprechpartner&id=$adresse");

    $widget->Edit();
    $this->app->BuildNavigation=false;
  }
}




function AdresseLieferadressePopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  $id = $this->app->Secure->GetGET("id");
  $this->AdresseLieferadresse();
  $this->app->BuildNavigation=false;
}


function AdresseLieferadresse()
{
  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");
  $lid = $this->app->Secure->GetGET("lid");
  $delete = $this->app->Secure->GetGET("delete");
  $create= $this->app->Secure->GetGET("create");
  $module= $this->app->Secure->GetGET("module");
  $action= $this->app->Secure->GetGET("action");

  $iframe = $this->app->Secure->GetGET("iframe");

  if($iframe=="true")
    $this->app->BuildNavigation=false;


  if($delete==1)
  {
    $this->app->DB->Delete("DELETE FROM lieferadressen WHERE id='$lid' AND adresse='$id' LIMIT 1"); 
    header("Location: index.php?module=adresse&action=lieferadresse&id=$id&iframe=$iframe");
    exit;
  }

  // neues arbeitspaket
  $widget = new WidgetLieferadressen($this->app,'TAB1');

  $widget->form->SpecialActionAfterExecute("none",
      "index.php?module=adresse&action=lieferadresse&id=$id&iframe=$iframe");

  if($lid > 0)
  {
    $widget->form->SpecialActionAfterExecute("none",
        "index.php?module=adresse&action=lieferadresse&id=$id&iframe=$iframe");
    $widget->Edit();
  }
  else
  {
    $widget->Create();
  }

  //Formula lieferadresse
  //		if($action=="lieferadressepopup")
  //		{
  //   	if($iframe=="true") $einfuegen = "<a onclick=\"LieferadresseLS('%value%'); parent.closeIframe();\"><img src=\"./themes/[THEME]/images/down.png\" border=\"0\"></a>";
  //	} else {
  if($iframe=="true") $einfuegen = "<a onclick=\"Lieferadresse('%value%'); parent.closeIframe();\"><img src=\"./themes/[THEME]/images/down.png\" border=\"0\"></a>";
  //	}
  /*
     $table = new EasyTable($this->app);
     $table->Query("SELECT name, strasse, land, plz, ort,id FROM lieferadressen WHERE adresse='$id' AND name!='Neuer Datensatz' ORDER by name,strasse");
     $table->DisplayNew(TABNEXT, "<a href=\"index.php?module=adresse&action=lieferadresse&id=$id&iframe=$iframe&lid=%value%\">
     <img src=\"./themes/[THEME]/images/edit.png\" border=\"0\"></a><a onclick=\"if(!confirm('Lieferadresse wirklich l&ouml;schen?')) return false; else window.location.href='index.php?module=adresse&action=lieferadresse&delete=1&iframe=$iframe&id=$id&lid=%value%';\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a>$einfuegen","","id",$id);
   */
  // easy table mit arbeitspaketen YUI als template 
  $this->app->YUI->TableSearch('TAB1',"adresse_lieferadressenlist");
  //	$this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
  $this->app->Tpl->Set('AKTIV_TAB1',"selected");

  if($iframe=="true")
    $this->app->Tpl->Parse('PAGE',"lieferadressenuebersicht_popup.tpl");
  else
    $this->app->Tpl->Parse('PAGE',"lieferadressenuebersicht.tpl");

}

function AdresseLieferadressenEditPopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  $id = $this->app->Secure->GetGET("id");

  if($frame=="false")
  {
    // hier nur fenster größe anpassen
    $this->app->YUI->IframeDialog(600,320);
  } else {
    // nach page inhalt des dialogs ausgeben
    $widget = new WidgetLieferadressen($this->app,'PAGE');
    $adresse = $this->app->DB->Select("SELECT adresse FROM lieferadressen WHERE id='$id' LIMIT 1");
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=adresse&action=lieferadresse&id=$adresse");

    $widget->Edit();
    $this->app->BuildNavigation=false;
  }
}

function DruckerSelect($selected='') {
  if($selected=="") {
    $selected = $this->app->DB->Select("SELECT standarddrucker FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
  }

  $drucker = $this->app->DB->SelectArr("SELECT id, name FROM  drucker WHERE firma='".$this->app->User->GetFirma()."' AND aktiv='1'");
  for($i=0;$i<count($drucker);$i++) {
    if($drucker[$i]['id']==$selected) {
      $mark="selected";
    } else {
      $mark="";
    }
    $out .="<option value=\"{$drucker[$i]['id']}\" $mark>{$drucker[$i]['name']}</option>";
  }
  return $out;
}

function AdresseBriefDrucken() {

  $id = $this->app->Secure->GetGET("id");
  $dokument = $this->app->DB->SelectArr('
    SELECT
      *,
      DATE_FORMAT(datum, "%d.%m.%Y") as datum
    FROM
      dokumente
    WHERE
      id = "' . $id . '"
  ');
  if ($dokument) {
    $dokument = reset($dokument);
  } else {
    echo 'Korrespondenz noch nicht gespeichert.';
    exit;
  }

  $adresse = $this->app->DB->SelectArr('
    SELECT
      *
    FROM
      adresse
    WHERE
      id = "' . $dokument['adresse_to'] . '"
  ');
  if ($adresse) {
    $adresse = reset($adresse);
  }

  if ($this->app->erp->Firmendaten("modul_mlm")) {
    $sponsor = $this->app->DB->SelectArr('
      SELECT
        *
      FROM
        adresse
      WHERE
        id = "' . $adresse['sponsor'] . '"
    ');
    if ($sponsor) {
      $sponsor = reset($sponsor);
      $sponsor = $sponsor['kundennummer'] . ' ' . $sponsor['name'];
    } else {
      $sponsor = 'Kein Sponsor';
    }

    $table = '';
    $table .= '<tr>';
      $table .= '<th align="left" style="border-bottom: 2px solid #d7d7d7;">Vertragsbeginn:</th>';
      $table .= '<td style="border-bottom: 2px solid #d7d7d7;"> ' . $adresse['mlmvertragsbeginn'] . '</td>';
      $table .= '<th align="left" style="border-bottom: 2px solid #d7d7d7;">Sponsor:</th>';
      $table .= '<td style="border-bottom: 2px solid #d7d7d7;"> ' . $sponsor . '</td>';
    $table .= '</tr>';


  $this->app->Tpl->Add('SPONSOR',$table);      

  }


  $this->app->Tpl->Add('KUNDENNUMMER',$adresse['kundennummer']);
  $this->app->Tpl->Add('ANREDE', ucfirst($adresse['typ']));
  $this->app->Tpl->Add('NAME',$adresse['name']);
  $this->app->Tpl->Add('TELEFON',$adresse['telefon']);
  $this->app->Tpl->Add('TELEFAX',$adresse['telefax']);
  $this->app->Tpl->Add('TITEL',$adresse['titel']);
  $this->app->Tpl->Add('ANSCHREIBEN',$adresse['anschreiben']);
  $this->app->Tpl->Add('ABTEILUNG',$adresse['abteilung']);
  $this->app->Tpl->Add('EMAIL',$adresse['email']);
  $this->app->Tpl->Add('UNTERABTEILUNG',$adresse['unterabteilung']);
  $this->app->Tpl->Add('MOBIL',$adresse['mobil']);
  $this->app->Tpl->Add('ADRESSZUSATZ',$adresse['adresszusatz']);
  $this->app->Tpl->Add('INTERNETSEITE',$adresse['internetseite']);
  $this->app->Tpl->Add('STRASSE',$adresse['strasse']);

  if ($adresse['kundenfreigabe'] == 1) {
    $this->app->Tpl->Add('KUNDENFREIGABE','Ja');
  } else {
    $this->app->Tpl->Add('KUNDENFREIGABE','Nein');
  }

  $this->app->Tpl->Add('PLZORT',$adresse['plz'] . ' ' . $adresse['ort']);

  if ($adresse['abweichende_rechnungsadresse'] == 1) {
    $this->app->Tpl->Add('ABWEICHENDE_RECHNUNGSADRESSE','Ja');
  } else {
    $this->app->Tpl->Add('ABWEICHENDE_RECHNUNGSADRESSE','Nein');
  }

  $this->app->Tpl->Add('LAND',$adresse['land']);

  $this->app->Tpl->Add('DATUM',$dokument['datum']);
  $this->app->Tpl->Add('UHRZEIT',$dokument['uhrzeit']);
  $this->app->Tpl->Add('BETREFF',$dokument['betreff']);
  $this->app->Tpl->Add('BEARBEITER',$dokument['bearbeiter']);
  $this->app->Tpl->Add('TEXT',nl2br($dokument['content']));

  $this->app->Tpl->Output('adresse_brief_druck.tpl');

  exit;

}

function AdresseBriefErstellen() {

  //$this->AdresseMenu();

  $id = $this->app->Secure->GetGET("id");
  $type = $this->app->Secure->GetGET('type');

  $adresse = $this->app->DB->SelectArr('
      SELECT
      *
      FROM
      adresse
      WHERE
      id = ' . $id . '
      ');
  $adresse = reset($adresse);

  $this->app->Tpl->Add('EMPFAENGER',$adresse['name']);
  $kundennummer = $this->app->DB->Select("SELECT kundennummer from adresse where id = ".(int)$id)."";
  //$this->app->Tpl->Add(BEARBEITER,$kundennummer." ".$this->app->DB->Select("SELECT name from adresse where id = ".(int)$id));
  $this->app->Tpl->Add('ADRESSE',$adresse['kundennummer']." ".$adresse['name']);
  $this->app->Tpl->Add('MITARBEITER',$this->app->DB->Select("SELECT mitarbeiternummer from adresse where id = ".$this->app->User->GetAdresse()." limit 1")." ".$this->app->User->GetName());
  $this->app->Tpl->Add('BEARBEITER',$this->app->DB->Select("SELECT mitarbeiternummer from adresse where id = ".$this->app->User->GetAdresse()." limit 1")." ".$this->app->User->GetName());
  //$this->app->BuildNavigation=false;

  $this->app->YUI->DatePicker("datum");
  $this->app->Tpl->Add('DATUM', date('d.m.Y'));
  $this->app->Tpl->Add('UHRZEIT', date('H:i'));

  $this->app->Tpl->Add('DATUM_ERINNERUNG',date("d.m.Y",strtotime ("+1 day")));
  $this->app->Tpl->Add('UHRZEIT_ERINNERUNG', date('H:i'));
  
  if ($type) {
    switch ($type) {
      case 'wiedervorlage':
        $this->app->YUI->DatePicker("datum_erinnerung");
        $template = 'adresse_brief_wiedervorlage.tpl';
        break;
      break;
      case 'brief':

        $this->app->Tpl->Add('SENDER', $this->app->User->GetName());
        $this->app->Tpl->Add('STRASSE',$adresse['strasse']);
        $this->app->Tpl->Add('PLZ',$adresse['plz']);
        $this->app->Tpl->Add('ORT',$adresse['ort']);

        $laender = $this->app->erp->GetSelectLaenderliste();
        $laenderStr = '';
        foreach ($laender as $landKey => $land) {
          $laenderStr .= '<option '.($adresse['land'] == $landKey?' selected="selected" ':'').' value="' . $landKey . '">' . $land . '</option>';
        }

        $this->app->Tpl->Add('LAND',$laenderStr);

        $this->app->Tpl->Set('DRUCKERSELECT', $this->DruckerSelect());

        $template = 'adresse_brief_brief.tpl';
        break;
      case 'email':

        $this->app->YUI->AutoComplete("email_an","emailname");
        $this->app->YUI->AutoCompleteAdd("email_cc","emailname");
        $this->app->YUI->AutoCompleteAdd("email_bcc","emailname");

        $this->app->Tpl->Set('EMAIL_SENDER', $this->app->erp->GetSelectEmailMitName());
        if (!empty($adresse['email'])) {
          $this->app->Tpl->Add('EMAIL_AN',$adresse['name'] . ' &lt;' . $adresse['email'] . '&gt;');
        }
        $anhaenge = '';
        $anhaenge .= '<tr><td nowrap>Datei:</td><td><input type="file" name="upload[]" id="file" /></td></tr>';
//        $anhaenge .= '<tr><td nowrap>Datei 2:</td><td><input type="file" name="upload[]" /></td></tr>';
//        $anhaenge .= '<tr><td nowrap>Datei 3:</td><td><input type="file" name="upload[]" /></td></tr>';
         

        $this->app->Tpl->Add('ANHAENGEHERAUFLADEN', $anhaenge);
        $anhaenge = '<tr><td colspan=3 align=center><i>Keine Anh&auml;nge vorhanden</i></td></tr>';
        $this->app->Tpl->Add('ANHAENGE', $anhaenge);
        
        // $this->app->Tpl->Parse('PAGE',"adresse_brief_email.tpl");
        $template = 'adresse_brief_email.tpl';
        break;
      case 'telefon':
        // $this->app->Tpl->Parse('PAGE',"adresse_brief_telefon.tpl");
        $template = 'adresse_brief_telefon.tpl';
        break;
      case 'notiz':
        // $this->app->Tpl->Parse('PAGE',"adresse_brief_notiz.tpl");
        $template = 'adresse_brief_notiz.tpl';
        break;
      default:
        // $this->app->Tpl->Parse('PAGE',"adresse_brief_email.tpl");
        $template = 'adresse_brief_email.tpl';
        break;
    }
  } else {
    $this->app->Tpl->Add('EMAIL',$adresse['email']);
    // $this->app->Tpl->Parse('PAGE',"adresse_brief_email.tpl");
    $template = 'adresse_brief_email.tpl';
  }

  $this->app->Tpl->Output($template);
  exit;

  /*
     $this->app->BuildNavigation=false;
     $this->app->Tpl->Set('INHALT',"");
     $this->app->Tpl->Parse('PAGE',"adresse_brief_email.tpl");
   */


}

/*
   function AdresseBriefSend() {

   $this->app->BuildNavigation=false;

   $id = $this->app->Secure->GetGET('id');
   $data = $this->ConvertFromDB($this->app->DB->SelectArr("SELECT * FROM dokumente WHERE id='$id' LIMIT 1"));

   $data['adresse_to'] = $this->app->DB->Select("SELECT adresse_to FROM dokumente WHERE id='$id' LIMIT 1");
   $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='".$data['adresse_to']."' LIMIT 1");

   switch($data['art']) {
   case 'email':
   if($this->app->erp->MailSend($data['email'],$data['von'],$data['email_an'],$data['to'],$data['betreff'],$data['content'],'',$projekt)=='1'){
   $this->app->Tpl->Set('PAGE',"<div class=\"success\">Die E-Mail wurde erfolgreich versendet.</div>");
   $this->app->DB->Update("UPDATE dokumente SET sent='1' WHERE id='$id' LIMIT 1");
   } else {
   $this->app->Tpl->Set('PAGE',"<div class=\"error\">Es gabe einen Fehler beim Versand der Mail: ".$this->app->erp->mail_error.".</div>");
   }
   break;
   case 'mail':
   $korrespondenz = $this->CreatePDF($data, false);
   $this->app->printer->Drucken($data['mail'],$korrespondenz);
   $this->app->DB->Update("UPDATE dokumente SET sent='1' WHERE id='$id' LIMIT 1");
   unlink($korrespondenz);
   $this->app->Tpl->Set('PAGE',"<div class=\"success\">Das Dokument wurde an den Drucker &uuml;bertragen</div>");
   break;
   case 'fax':
   $korrespondenz = $this->CreatePDF($data, false);
   $this->app->printer->Drucken($data['fax'],$korrespondenz);
   $this->app->DB->Update("UPDATE dokumente SET sent='1' WHERE id='$id' LIMIT 1");
   unlink($korrespondenz);
   $this->app->Tpl->Set('PAGE',"<div class=\"success\">Das Dokument wurde an das Fax &uuml;bertragen</div>");
   break;
   }

   }
 */

function AdresseBriefCreatePDF($dokumentId, $display=true) {

  $data = $this->app->DB->SelectArr('
      SELECT
      *
      FROM
      dokumente
      WHERE
      id = ' . $dokumentId  . '
      ');
  $data = reset($data);

  $data['firma'] = $this->app->DB->Select('
      SELECT
      MAX(id)
      FROM
      firma
      LIMIT 1
      ');

  $data['firma'] = $this->app->DB->Select('
      SELECT
      absender
      FROM
      firmendaten
      WHERE
      id = ' . $data['firma'] . '
      ');

  $korrespondenz = new KorrespondenzPDF($this->app);
  $korrespondenz->SetBetreff($this->app->erp->ReadyForPDF($data['betreff']));

  $korrespondenz->SetDetail('Datum', $this->app->String->Convert($data['datum'],"%1-%2-%3","%3.%2.%1"));
  $korrespondenz->SetDetail('Bearbeiter', $this->app->erp->ReadyForPDF($data['von']));

  $korrespondenz->setRecipient(
      array(
        $this->app->erp->ReadyForPDF($data['an']), 
        $this->app->erp->ReadyForPDF($data['ansprechpartner']),
        '',
        $this->app->erp->ReadyForPDF($data['adresse']),
        $data['plz'],
        $this->app->erp->ReadyForPDF($data['ort']),
        $data['land']
        )
      );

  $korrespondenz->setLetterDetails(
      array(
        $this->app->erp->ReadyForPDF($data['betreff']),
        str_replace('\r\n',"\n\n",$this->app->erp->ReadyForPDF($data['content']))
        )
      );
  $korrespondenz->setAbsender($data['firma']);

  $korrespondenz->Create();

  if($display) {
    $korrespondenz->displayDocument();
  } else {
    return $korrespondenz->displayTMP();
  }
}

function AdresseBriefSaveDocument() {

  $data = array();
  $data['user'] = '';
  $data['datum'] = $this->app->Secure->GetPOST('datum');
  $data['von'] = $this->app->Secure->GetPOST('von');
  $data['firma'] = $this->app->Secure->GetPOST('firma');
  $data['ansprechpartner'] = $this->app->Secure->GetPOST('ansprechpartner');
  $data['an'] = $this->app->Secure->GetPOST('an');
  $data['email_an'] = $this->app->Secure->GetPOST('email_an');
  $data['email_cc'] = $this->app->Secure->GetPOST('email_cc');
  $data['email_bcc'] = $this->app->Secure->GetPOST('email_bcc');
  $data['firma_an'] = $this->app->Secure->GetPOST('firma_an');
  $data['adresse'] = $this->app->Secure->GetPOST('adresse');
  $data['plz'] = $this->app->Secure->GetPOST('plz');
  $data['ort'] = $this->app->Secure->GetPOST('ort');
  $data['land'] = $this->app->Secure->GetPOST('land');
  $data['betreff'] = $this->app->Secure->GetPOST('betreff');
  $data['content'] = $this->app->Secure->GetPOST('content');
  $data['signatur'] = $this->app->Secure->GetPOST('signatur');
  $data['send_as'] = $this->app->Secure->GetPOST('send_as');
  $data['email'] = $this->app->Secure->GetPOST('email');
  $data['printer'] = $this->app->Secure->GetPOST('printer');
  $data['fax'] = $this->app->Secure->GetPOST('fax');
  $data['user'] = $this->app->Secure->GetGET("id");
  $data['signatur'] = $this->app->Secure->GetPOST('signatur');
  $data['eintragId'] = $this->app->Secure->GetPOST('eintragId');

  $data['uhrzeit'] = $this->app->Secure->GetPOST('uhrzeit');
  if (!$data['uhrzeit']) {
    $data['uhrzeit'] = date('H:i:s');
  }
  $data['bearbeiter'] = $this->app->Secure->GetPOST('bearbeiter');

  if (!empty($datra['signatur'])) {
    $data['signatur'] = 1;
  } else {
    $data['signatur'] = 0;
  }

  if (!$data['datum']) {
    $data['datum'] = date('d.m.Y');
  }

  $data['typ'] = $this->app->Secure->GetPOST('type');
  if (!$data['typ']) {
    $data['typ'] = 'brieffax';
  }

  $adresse = $this->app->User->GetAdresse();
  $datum = $this->app->String->Convert($data['datum'],"%1.%2.%3","%3-%2-%1");

  if (isset($data['eintragId']) && !empty($data['eintragId'])) {

    $this->app->DB->Insert('
        UPDATE
        dokumente
        SET
        adresse_from = "' . $adresse . '",
        adresse_to = "' . $data['user'] . '",
        typ = "' . $data['typ'] . '",
        von = "' . $data['von'] . '",
        firma = "' . $data['firma'] . '",
        ansprechpartner = "' . $data['ansprechpartner'] . '",
        an = "' . $data['an'] . '",
        email_an = "' . $data['email_an'] . '",
        email_cc = "' . $data['email_cc'] . '",
        email_bcc = "' . $data['email_bcc'] . '",
        firma_an = "' . $data['firma_an'] . '",
        adresse = "' . $data['adresse'] . '",
        plz = "' . $data['plz'] . '",
        ort = "' . $data['ort'] . '",
        land = "' . $data['land'] . '",
        datum = "' . $datum . '",
        betreff = "' . $data['betreff'] . '",
        content = "' . $data['content'] . '",
        signatur = "' . $data['signatur'] . '",
        send_as = "' . $data['send_as'] . '",
        email = "' . $data['email'] . '",
        printer = "' . $data['printer'] . '",
        fax = "' . $data['fax'] . '",
        created = NOW(),
        uhrzeit = "' . $data['uhrzeit'] . '",
        bearbeiter = "' . $data['bearbeiter'] . '"
          WHERE
          id = ' . $data['eintragId'] . '
          ');

    $returnId = $data['eintragId'];

  } else {


    $this->app->DB->Insert('
        INSERT INTO
        dokumente
        SET
        adresse_from = "' . $adresse . '",
        adresse_to = "' . $data['user'] . '",
        typ = "' . $data['typ'] . '",
        von = "' . $data['von'] . '",
        firma = "' . $data['firma'] . '",
        ansprechpartner = "' . $data['ansprechpartner'] . '",
        an = "' . $data['an'] . '",
        email_an = "' . $data['email_an'] . '",
        email_cc = "' . $data['email_cc'] . '",
        email_bcc = "' . $data['email_bcc'] . '",
        firma_an = "' . $data['firma_an'] . '",
        adresse = "' . $data['adresse'] . '",
        plz = "' . $data['plz'] . '",
        ort = "' . $data['ort'] . '",
        land = "' . $data['land'] . '",
        datum = "' . $datum . '",
        betreff = "' . $data['betreff'] . '",
        content = "' . $data['content'] . '",
        signatur = "' . $data['signatur'] . '",
        send_as = "' . $data['send_as'] . '",
        email = "' . $data['email'] . '",
        printer = "' . $data['printer'] . '",
        fax = "' . $data['fax'] . '",
        created = NOW(),
        uhrzeit = "' . $data['uhrzeit'] . '",
        bearbeiter = "' . $data['bearbeiter'] . '"
          ');

    $returnId = $this->app->DB->GetInsertID();

  }

  if($returnId && $data['typ'] == 'email')
  {
    if(isset($_FILES['upload']) && is_array($_FILES['upload']))
    {
      foreach($_FILES['upload']['tmp_name'] as $key => $file)
      {
        if($file != "")
        {
          $fileid = $this->app->erp->CreateDatei($_FILES['upload']['name'][$key], $_FILES['upload']['name'][$key], "", "", $_FILES['upload']['tmp_name'][$key], $this->app->User->GetName());
          // stichwoerter hinzufuegen
          $this->app->erp->AddDateiStichwort($fileid, "anhang", "dokument", $returnId);
        }
      }
    }
    $this->app->Tpl->Add('AJAXBRIEF', "
    		$.ajax({
			url: 'index.php',
			data: {
				module: 'adresse',
				action: 'briefbearbeiten',
        typ : 'email',
				id: ".$returnId."
			},
			beforeSend: function() {
				App.loading.open();
			},
			success: function(data) {

				$('.alleAnzeigen').show();

				$('.adresse_brief_anlegen').css({
					width: $('.adresse_brief_tabelle').width()
				});


				$('.adresse_brief_tabelle').find('fieldset').hide();
				$('.adresse_brief_tabelle').find('.adresse_brief_tabelle_view').hide();

				$('.adresse_brief_anlegen')
					.html(data)
					.show();

				fnFilterColumn8(0);
				App.loading.close();
			}
		});
    ");
  }
  
  return $returnId;

}

function AdresseBriefPreview($type = '', $id = '', $json = true) {
  
  if(!$type)$type = $this->app->Secure->GetGET('type');
  if(!$id)$id = $this->app->Secure->GetGET('id');

  $query = '';
  if ($type) {
    switch ($type) {
      case 'dokumente':
        $query .= '
          SELECT
          id,
          DATE_FORMAT(datum, "%d.%m.%Y") as datum,
          betreff,
          content
            FROM
            dokumente
            WHERE
            id = ' . $id . '
            ';
        break;
      case 'dokumente_send':
        $query .= '
          SELECT
          id,
          DATE_FORMAT(zeit, "%d.%m.%Y") as datum,
          betreff,
          text as content
            FROM
            dokumente_send
            WHERE
            id = ' . $id . '
            ';
        break;
      case 'wiedervorlage':
        $query .= '
          SELECT
          id,
          DATE_FORMAT(datum_angelegt, "%d.%m.%Y") as datum,
          DATE_FORMAT(datum_erinnerung, "%d.%m.%Y") as datum_erinnerung,
          DATE_FORMAT(zeit_angelegt,"%H:%i") as zeit_angelegt,
          zeit_erinnerung,
          bezeichnung as betreff,
          beschreibung as content
            FROM
            wiedervorlage
            WHERE
            id = ' . $id . '
            ';
        break;
    }

  }

  $res = $this->app->DB->SelectArr($query);
  if ($res) {
    $res = reset($res);
/*
    if (isset($res['content'])) {
      $res['content'] = '<input type="button" onclick="briefDrucken(' . $res['id'] . ');" value="Drucken"><br><br>'.nl2br($res['content']);
    }
*/
  }
  if(isset($res['datum']))
  {
    $res['content'] = '<b>Anglegt am: '.$res['datum'].(isset($res['zeit_angelegt'])?' '.$res['zeit_angelegt']:'')."</b><br />".$res['content'];
  }

  if($json)
  {
  echo json_encode($res);
  } else {
    //$ausg = "<h2>".$res['datum'].' '.$res['betreff']."</h2>".nl2br($res['content']);
    if($res['content']=="") $res['content']="Kein Inhalt vorhanden";
    $ausg = nl2br($res['content']);
    echo $ausg;
  }
  exit;

}

function AdresseBriefBearbeiten() {


  $type = $this->app->Secure->GetGET('type');
  $typ = $this->app->Secure->GetGET('typ');
  $id = $this->app->Secure->GetGET('id');

  if($typ == 'wiedervorlage')
  {
    $query = 'SELECT * from wiedervorlage where id = '.(int)$id;
  }else{
  
  $query .= '
    SELECT
    id,
    typ,
    von,
    firma,
    an,
    email_an,
    ansprechpartner,
    adresse,
    plz,
    ort,
    land,
    DATE_FORMAT(datum, "%d.%m.%Y") as datum,
    betreff,
    content,
    bearbeiter,
    DATE_FORMAT(uhrzeit,"%H:%i") as uhrzeit
      FROM
      dokumente
      WHERE
      id = ' . $id . '
      ';
  }
  $dokument = $this->app->DB->SelectArr($query);
  if($dokument)$dokument = reset($dokument);

  if($typ == 'wiedervorlage')
  {
    $template = 'adresse_brief_wiedervorlage.tpl';
    $mitarbeiternummer = $this->app->DB->Select("SELECT mitarbeiternummer from adresse where id = ".$dokument['adresse_mitarbeiter']." limit 1");
    $bearbeiternummer = $this->app->DB->Select("SELECT mitarbeiternummer from adresse where id = ".$dokument['bearbeiter']." limit 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer from adresse where id = ".$dokument['adresse']." limit 1");
    $dokument['datum_angelegt'] = $this->app->String->Convert($dokument['datum_angelegt'],"%1-%2-%3","%3.%2.%1");
    $dokument['datum_erinnerung'] = $this->app->String->Convert($dokument['datum_erinnerung'],"%1-%2-%3","%3.%2.%1");
    $this->app->Tpl->Add('DATUM',$dokument['datum_angelegt']);
    $this->app->Tpl->Add('UHRZEIT',$dokument['zeit_angelegt']);
    $this->app->Tpl->Add('BEARBEITER',$bearbeiternummer?$bearbeiternummer.' '.$this->app->DB->Select("SELECT name from adresse where id = ".$dokument['bearbeiter']." limit 1"):'');
    $this->app->Tpl->Add('BETREFF',$dokument['bezeichnung']);
    $this->app->Tpl->Add('MITARBEITER',$mitarbeiternummer?$mitarbeiternummer.' '.$this->app->DB->Select("SELECT name from adresse where id = ".$dokument['adresse_mitarbeiter']." limit 1"):'');
    $this->app->Tpl->Add('ADRESSE',$kundennummer?$kundennummer.' '.$this->app->DB->Select("SELECT name from adresse where id = ".$dokument['adresse']." limit 1"):'');
    $this->app->Tpl->Add('CONTENT',$dokument['beschreibung']);
    $this->app->Tpl->Add('DATUM_ERINNERUNG',$dokument['datum_erinnerung']);
    $this->app->Tpl->Add('UHRZEIT_ERINNERUNG',$dokument['zeit_erinnerung']);
    if($dokument['abgeschlossen']);

        
  }else {
    switch($dokument['typ']) {
      case 'brief':
        $template = 'adresse_brief_brief.tpl';
        break;
      case 'email':
      
      
        $anhaenge = '';
        $anhaenge .= '<tr><td nowrap>Datei:</td><td colspan="2"><input type="file" name="upload[]" id="file"/></td></tr>';
//        $anhaenge .= '<tr><td nowrap>Datei 2:</td><td colspan="2"><input type="file" name="upload[]" /></td></tr>';
//        $anhaenge .= '<tr><td nowrap>Datei 3:</td><td colspan="2"><input type="file" name="upload[]" /></td></tr>';

        $this->app->Tpl->Add('ANHAENGEHERAUFLADEN', $anhaenge);
        $anhaenge = "";
        
        $anhaengedb = $this->app->DB->SelectArr("SELECT ds.id, ds.datei, d.titel FROM datei_stichwoerter ds INNER JOIN datei d on ds.datei = d.id WHERE ds.parameter = '$id' AND ds.objekt = 'dokument' AND ds.subjekt = 'anhang' and d.geloescht <> 1");
        if($anhaengedb)
        {
          foreach($anhaengedb as $anhang)
          {
            $anhaenge .= '<tr id="trdatei_'.$anhang['datei'].'"><td><input type="checkbox" name="datei_'.$anhang['datei'].'" value="1" checked/></td><td><a style="font-weight:normal" href="index.php?module=adresse&action=downloaddatei&id='.$anhang['datei'].'">'.$anhang['titel'].'</a></td><td width=20><img src="./themes/' . $this->app->Conf->WFconf['defaulttheme'] . '/images/delete.gif" onclick="remdatei('.$anhang['datei'].');" style="border:0;" /></td></tr>';
          }
        } else {
          $anhaenge .= '<tr><td colspan=3 align=center><i>Keine Anh&auml;nge vorhanden</i></td></tr>';
        }
         
        $this->app->Tpl->Add('ANHAENGE', $anhaenge);
      
      
      
      
      
        $template = 'adresse_brief_email.tpl';
        break;
      case 'telefon':
        $template = 'adresse_brief_telefon.tpl';
        break;
      case 'notiz':
        $template = 'adresse_brief_notiz.tpl';
        break;
      default:
        $template = 'adresse_brief_brief.tpl';
      break;
    }
    $this->app->Tpl->Add('EMAIL_SENDER', $this->app->erp->GetSelectEmail());
    $this->app->Tpl->Add('EMPFAENGER',$dokument['an']);
    $this->app->Tpl->Add('SENDER',$dokument['von']);
    $this->app->Tpl->Add('ANSPRECHPARTNER',$dokument['ansprechpartner']);
    $this->app->Tpl->Add('DATUM',$dokument['datum']);
    $this->app->Tpl->Add('STRASSE',$dokument['adresse']);
    $this->app->Tpl->Add('PLZ',$dokument['plz']);
    $this->app->Tpl->Add('ORT',$dokument['ort']);

    $this->app->Tpl->Add('BEARBEITER',$dokument['bearbeiter']);
    $this->app->Tpl->Add('UHRZEIT',$dokument['uhrzeit']);

    // $this->app->Tpl->Add(LAND,$dokument['land']);

    $laender = $this->app->erp->GetSelectLaenderliste();
    $laenderStr = '';
    foreach ($laender as $landKey => $land) {
      $laenderStr .= '<option '.($dokument['land'] == $landKey?' selected="selected" ':'').' value="' . $landKey . '">' . $land . '</option>';
    }

    $this->app->Tpl->Add('LAND',$laenderStr);

    $this->app->Tpl->Add('BETREFF',$dokument['betreff']);
    $this->app->Tpl->Add('CONTENT',$dokument['content']);

    $this->app->Tpl->Add('EMAIL_AN',$dokument['email_an']);
    $this->app->Tpl->Add('EMAIL_CC',$dokument['email_cc']);
    $this->app->Tpl->Add('EMAIL_BCC',$dokument['email_bcc']);
  }



  $this->app->Tpl->Add('EINTRAGID',$dokument['id']);

  $this->app->Tpl->Add('DRUCKERSELECT', $this->DruckerSelect());

  $this->app->Tpl->Output($template);

  exit;

}

function AdresseKorrBriefPdf() {

  $id = $this->app->Secure->GetGET('id');
  $this->AdresseBriefCreatePDF($id, true);
  exit;

}

function AdresseKorrBriefDelete() {

  $typ = $this->app->Secure->GetGET('typ');
  $id = $this->app->Secure->GetGET('id');
  if(strtolower($typ) == 'wiedervorlage')
  {
    $this->app->DB->Delete('
        DELETE FROM
        wiedervorlage
        WHERE
        id = ' . $id . '
        ');
    
    
  }else{
    $this->app->DB->Delete('
        DELETE FROM
        dokumente
        WHERE
        id = ' . $id . '
        ');
    
    
  }
  


  $json['status'] = 0;
  $json['statusText'] = 'Email konnte nicht gesendet werden.';
  echo json_encode($json);
  exit;

}



function AdresseBriefSaveWiedervorlage()
{
  $data = array();
  $data['id'] = $this->app->Secure->GetPOST('eintragId');
  $data['adresse'] = $this->app->Secure->GetGET("id");
  $data['bearbeiter'] = (int)$this->app->DB->Select("SELECT id from adresse where mitarbeiternummer = '" .(int)$this->app->Secure->GetPOST('bearbeiter')."'");
  $data['adresse_mitarbeiter'] = (int)$this->app->DB->Select("SELECT id from adresse where mitarbeiternummer = '" .(int)$this->app->Secure->GetPOST('adresse_mitarbeiter')."'");
  $data['bezeichnung'] = $this->app->Secure->GetPOST('betreff');
  $data['beschreibung'] = $this->app->Secure->GetPOST('content');

  
  $data['datum_erinnerung'] = $_POST['datumerinnerung'];
  $data['zeit_erinnerung'] = $_POST['uhrzeiterinnerung']?$_POST['uhrzeiterinnerung']:'0:00';
  if(!$data['datum_erinnerung'])$data['datum_erinnerung'] = '0:00';
  $data['module'] = $this->app->Secure->GetGET("module");
  $data['action'] = $this->app->Secure->GetGET("action");
  $data['abgeschlossen'] = $this->app->Secure->GetGET("abgeschlossen");
  

  $data['datum_erinnerung'] = $this->app->String->Convert($data['datum_erinnerung'],"%1.%2.%3","%3-%2-%1");
  
  if($data['datum_erinnerung'] && $data['zeit_erinnerung'] && $data['bezeichnung'])
  {
    
    $id = 0;
    if($data['id'])
    {
      $id = $this->app->DB->Select("SELECT id from wiedervorlage where id = ".(int)$data['id']." Limit 1");
    }
    if($id)
    {
      $sql = 'UPDATE wiedervorlage set ';
      $first = true;
      foreach($data as $k => $v)
      {
        if($k != 'id')
        {
          if(!$first)$sql .= ', ';
          $first = false;
          $sql .= $k." = '".$v."'";
          
        }
        
      }
      $sql .= " where id = ".$id;
      
     if($this->app->DB->Update($sql))return $id;
     return false;
    } else {
      
      $data['datum_angelegt'] = $this->app->Secure->GetPOST('datum');
      $data['zeit_angelegt'] = $this->app->Secure->GetPOST('uhrzeit');
      $data['datum_angelegt'] = $this->app->String->Convert($data['datum_angelegt'],"%1.%2.%3","%3-%2-%1");
      
      $sql = "INSERT INTO wiedervorlage (";
      $first = true;
      foreach($data as $k => $v)
      {
        if($k != 'id')
        {
          if(!$first)$sql .= ', ';
          $first = false;
          $sql .= $k;
        }
      }
      $sql .= ") values (";
      $first = true;
      foreach($data as $k => $v)
      {
        if($k != 'id')
        {
          if(!$first)$sql .= ', ';
          $first = false;
          $sql .= "'".$v."'";
        }
      }
      $sql .= ")";
      
      if($this->app->DB->Insert($sql))return $this->app->DB->GetInsertID();
      return false;
    }
      
    
    
  } else {
    
  }
  return false;
  
}

function AdresseBrief() {

  $this->app->YUI->AutoComplete("ansprechpartner","ansprechpartner","","&adresse=$id");

  $pType = $this->app->Secure->GetPOST('type');
  $do = $this->app->Secure->GetPOST('do');

  $json['status'] = 0;
  $json['statusText'] = '';

  if (isset($pType) && !empty($pType)) {

    $newId = 0;
    if($pType != 'wiedervorlage')
    {
      $newId = $this->AdresseBriefSaveDocument();
    } else {
      $newId = $this->AdresseBriefSaveWiedervorlage();
    }

    if ($newId > 0) {
      $json['status'] = 1;
      $json['statusText'] = 'Das Dokument wurde gespeichert.';
      $json['statusId'] = $newId;
    }

    if($pType != 'email' || !$this->app->Secure->GetPOST('save'))
    {    
      if (isset($do) && !empty($do)) {

        switch ($do) {
          case 'PDF':

            $json['id'] = $newId;
            $json['responseType'] = 'PDF';
            $json['statusText'] = 'PDF wurde erstellt.';

            break;
          case 'DRUCKEN':

            $drucker = $this->app->Secure->GetPOST('drucker');

            $tmpBrief = $this->AdresseBriefCreatePDF($newId, false);
            $this->app->printer->Drucken($drucker, $tmpBrief);
            unlink($tmpBrief);
            $json['statusText'] = 'Dokument wird gedruckt.';
            $json['responseType'] = 'TEXT';
            break;
          case 'EMAIL':

            $data = $this->app->DB->SelectArr('
                SELECT
                *
                FROM
                dokumente
                WHERE
                id = ' . $newId . '
                ');
            $data = reset($data);

            // TODO MK korrekte cc und bcc holen
            $cc = $this->app->erp->get_emails($data['email_cc']);
            $bcc = $this->app->erp->get_emails($data['email_bcc']);

            //TODO MK email_an und to richtig extrahieren
            //$email_string = 'Benedikt Sauter <sauter@embedded-projects.net>';
            list($data['to'], $data['email_an']) = explode(' <', trim($data['email_an'], '> '));
            list($data['von'], $data['email']) = explode(' <', trim($data['von'], '> '));

      //$this->app->erp->LogFile("BCC $bcc CC $cc");

            $dateien = '';
            foreach($_POST as $pk => $pv)
            {
              $pka = explode('_',$pk);
              if($pka[0] == 'datei' && isset($pka[1]) && $pka[1] && is_numeric($pka[1]))
              {
                $dateiname = $this->app->erp->GetDateiName($pka[1]);
                if($dateiname)
                {
                  $dateiinhalt = $this->app->erp->GetDatei($pka[1]);
                  
                  if($handle = fopen ($this->app->erp->GetTMP()."/".$dateiname, "wb"))
                  {
                    fwrite($handle, $dateiinhalt);
                    fclose($handle);
                    $dateien[] = $this->app->erp->GetTMP()."/".$dateiname;
                  }                   
                }
              }
            }
            
            
      
            $mailSend = $this->app->erp->MailSend(
                $data['email'],
                $data['von'],
                $data['email_an'],
                $data['to'],
                $data['betreff'],
                $data['content'],
                $dateien,
                $projekt,true,$cc,$bcc
                );
                
            if($dateien && is_array($dateien))
            {
              foreach($dateien as $datei)unlink($datei);
            }

            if($mailSend =='1') {
              $json['status'] = 1;
              $json['statusText'] = 'Email wurde gesendet.';
              $this->app->DB->Update('
                  UPDATE
                  dokumente
                  SET
                  sent = 1,
                  send_as = "email"
                  WHERE
                  id = ' . $data['id'] . '
                  ');
            } else {
              $json['status'] = 0;
              $json['statusText'] = 'Email konnte nicht gesendet werden. ('.$this->app->erp->mail_error.')';
            }

          break;

          default:
          break;
        }

      }

      echo json_encode($json);
      exit;
    }
  }

  $id = $this->app->Secure->GetGET("id");

  $this->AdresseMenu();
 

  $this->app->User->SetParameter('adresse_brief_adresseId', $id);

  $count = 0;
  $count += $this->app->DB->Select('SELECT count(id) FROM dokumente WHERE adresse_to = ' . $id);
  $count += $this->app->DB->Select('SELECT count(id) FROM dokumente_send WHERE adresse = ' . $id);
  $count += $this->app->DB->Select('SELECT count(id) FROM wiedervorlage WHERE adresse = ' . $id);

  if ($count > 0) {
    $this->app->YUI->TableSearch('TABELLE', 'adresse_brief');
    $this->app->Tpl->Set('TABELLEFLAG', 0);
  } else {
    $this->app->Tpl->Set('TABELLE', '<div class="info">Keine Einträge vorhanden</div>');
    $this->app->Tpl->Set('TABELLEFLAG', 1);
  }

  if(!$this->app->erp->RechteVorhanden('wiedervorlage','list'))
  {
    $this->app->Tpl->Set('VORWIEDERVORLAGE','<!-- ');
    $this->app->Tpl->Set('NACHWIEDERVORLAGE',' -->');
  }


  $cmd = $this->app->Secure->GetGET("cmd");
  if($cmd=="crm")
    $this->app->Tpl->Parse('CRMTABELLE',"adresse_crm_tabelle.tpl");

  $this->app->Tpl->Parse('TAB1',"adresse_brief.tpl");
  $this->app->Tpl->Parse('PAGE',"tabview.tpl");

}



function AdresseBriefEditPopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  $id= $this->app->Secure->GetGET("id");
  $sid= $this->app->Secure->GetGET("sid");

  if($frame=="false")
  {
    // hier nur fenster größe anpassen
    $this->app->YUI->IframeDialog(800,650,"index.php?module=adresse&action=briefeditpopup&id=$id&sid=$sid");
  } else {

    $adresse = $id;

    $typ = $this->app->DB->Select("SELECT dokument FROM dokumente_send WHERE id='$sid' LIMIT 1");
    //$parameter = $this->app->DB->Select("SELECT parameter FROM dokumente_send WHERE id='$sid' LIMIT 1");
    $parameter = $sid;

    //echo "typ = $typ ".$parameter;

    $this->app->erp->DokumentMask('PAGE',$typ,$parameter,$adresse,'',true);

    $this->app->BuildNavigation=false;
  }
}


function AdresseBriefDelete()
{
  $sid = $this->app->Secure->GetGET("sid");
  $id = $this->app->Secure->GetGET("id");

  $this->app->DB->Update("UPDATE dokumente_send SET geloescht=1 WHERE id='$sid' LIMIT 1");

  $this->AdresseBrief();
}

function AdresseBriefPDF()
{
  $sid = $this->app->Secure->GetGET("sid");
  $id = $this->app->Secure->GetGET("id");

  //$Brief = new Geschaeftsbrief(&$this->app,$sid);
  $Brief = new BriefPDF($this->app);
  $Brief->GetBrief($sid);
  $Brief->displayDocument();

  $this->AdresseBrief();
}


function AdresseBelege()
{
  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");

  $kreditlimit = $this->app->DB->Select("SELECT kreditlimit FROM adresse WHERE id='$id' LIMIT 1");
  $saldo = $this->app->erp->SaldoAdresse($id);

  $kreditlimit_frei = $kreditlimit - $saldo;

  if($kreditlimit <=0) { 
    $kreditlimit="kein Limit";
    $kreditlimit_frei = "kein Limit";
  } else $kreditlimit = number_format($kreditlimit,2,',','.');

  $this->app->Tpl->Set('KREDITLIMIT',$kreditlimit);
  $this->app->Tpl->Set('KREDITLIMITFREI',$kreditlimit_frei);


  //$this->app->Tpl->Set('UMSATZ',number_format($this->app->erp->UmsatzAdresseAuftragJahr($id),2,',','.'));
  $this->app->Tpl->Set('UMSATZ',number_format($this->app->erp->UmsatzAdresseRechnungJahr($id),2,',','.'));

  $saldo = round($saldo,2);

  if($saldo > 0)
    $saldo = "<font color=red>-".number_format($saldo,2,',','.')."</font>";
  else if ($saldo==0) $saldo="0,00";
  else $saldo = number_format($saldo,2,',','.');

  $this->app->Tpl->Set('SALDO',$saldo);


  $this->app->YUI->TableSearch('TAB1',"adresse_angebot");
  $this->app->YUI->TableSearch('TAB2',"adresse_auftrag");
  $this->app->YUI->TableSearch('TAB3',"adresse_rechnung");
  $this->app->YUI->TableSearch('TAB4',"adresse_gutschrift");
  $this->app->YUI->TableSearch('TAB5',"adresse_lieferschein");

  $this->app->Tpl->Parse('PAGE',"adresse_belege.tpl");

}



function AdresseEmail()
{
  $this->AdresseMenu();


  // NEU füllen
  $widget = new WidgetEmail($this->app,'TAB2');
  $widget->Create();

  // UEBERSICHT füllen
  $this->app->Tpl->Set('HEADING',"Adresse");
  $this->app->Tpl->Set('SUBHEADING',"Email schreiben");
  $adresse = $this->app->User->GetAdresse();

  //Offene Aufgaben
  $table = new EasyTable($this->app);
  $table->Query("SELECT betreff, id FROM email");
  $table->DisplayNew('INHALT', "<a href=\"index.php?module=adresse&action=emaileditpopup&frame=false&id=%value%\" 
      onclick=\"makeRequest(this);return false\">Bearbeiten</a>");
  $this->app->Tpl->Parse('TAB1',"rahmen.tpl");

  // PARSE
  $this->app->Tpl->Set('AKTIV_TAB1',"selected");

  $this->app->Tpl->Parse('PAGE',"emailuebersicht.tpl");

}



function AdresseEmailEditPopup()
{
  $frame = $this->app->Secure->GetGET("frame");
  if($frame=="false")
  {
    // hier nur fenster größe anpassen
    $this->app->YUI->IframeDialog(510,610);
  } else {
    // nach page inhalt des dialogs ausgeben
    $widget = new WidgetEmail($this->app,'PAGE');
    $widget->Edit();
    $this->app->BuildNavigation=false;
  }
}




function AdresseSuchmaske()
{
  $typ=$this->app->Secure->GetGET("typ");

  $this->app->Tpl->Set('HEADING',"Suchmaske f&uuml;r Adressen");
  $table = new EasyTable($this->app);
  switch($typ) {
    case "auftragrechnung":
      $table->Query("SELECT typ,name, ort, plz, strasse, abteilung, unterabteilung, ustid, email, adresszusatz, id as kundeadressid, id FROM adresse WHERE geloescht=0
          order by name");
      break;
    case "auftraglieferschein":
      $table->Query("SELECT typ as liefertyp, name as liefername, ort as lieferort, plz as lieferplz, strasse as lieferstrasse, abteilung as lieferabteilung, unterabteilung
          as lieferunterabteilung, adresszusatz as lieferadresszusatz, id as lieferadressid  FROM adresse WHERE geloescht=0 order by name");
      break;
    default:
      $table->Query("SELECT typ,name, ort, plz, strasse, abteilung, unterabteilung, ustid, email, adresszusatz, id as kundeadressid, id FROM adresse WHERE geloescht=0 order by name");
  }

  $table->DisplayWithDelivery('PAGE');

  $this->app->BuildNavigation=false;
}



function AdresseKundevorlage()
{
  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");
  // prufe ob es schon einen eintrag gibt
  $check = $this->app->DB->Select("SELECT id FROM kundevorlage WHERE adresse='$id' LIMIT 1");
  if( !($check > 0 && is_numeric($check)))
  {
    $this->app->DB->Insert("INSERT INTO kundevorlage (id,adresse) VALUES ('','$id')");
  }

  $check = $this->app->DB->Select("SELECT id FROM kundevorlage WHERE adresse='$id' LIMIT 1");
  $this->app->Secure->GET['id']=$check;
  $this->app->Tpl->Set('AKTIV_TAB1',"selected");
  $widget = new WidgetKundevorlage($this->app,'PAGE');
  $widget->Edit();
  $this->app->Secure->GET['id']=$id;
}

function AdresseAddPosition()
{
  $sid = $this->app->Secure->GetGET("sid");
  $id = $this->app->Secure->GetGET("id");
  $menge = $this->app->Secure->GetGET("menge");
  $datum  = $this->app->Secure->GetGET("datum");
  $datum  = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1");
  $tmpid = $this->app->erp->AddAdressePosition($id, $sid,$menge,$datum);

  $art  = $this->app->Secure->GetGET("art");

  if($datum=='0000-00-00' || $datum=='--' || $datum=="") $datum=date('Y-m-d');
  if($art=="abo") $this->app->DB->Update("UPDATE abrechnungsartikel SET wiederholend=1,startdatum='$datum',zahlzyklus=1 WHERE id='$tmpid' LIMIT 1");

  header("Location: index.php?module=adresse&action=artikel&id=$id");
  exit;
}

function AdresseLieferantvorlage()
{

  //zahlungsweise   zahlungszieltage  zahlungszieltageskonto  zahlungszielskonto  versandart
  //zahlungsweiselieferant  zahlungszieltagelieferant   zahlungszieltageskontolieferant   zahlungszielskontolieferant   versandartlieferant
  $arr = $this->app->DB->SelectArr("SELECT id,kundennummerlieferant FROM adresse WHERE lieferantennummer >0");

  foreach($arr as $key=>$value)
  {
    if($value['kundennummerlieferant']=="")
    {
      $id = $value['id'];
      $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM lieferantvorlage WHERE adresse='$id' LIMIT 1");
      $zahlungsweiselieferant = $this->app->DB->Select("SELECT zahlungsweise FROM lieferantvorlage WHERE adresse='$id' LIMIT 1");
      $zahlungszieltagelieferant = $this->app->DB->Select("SELECT zahlungszieltage FROM lieferantvorlage WHERE adresse='$id' LIMIT 1");
      $zahlungszieltageskontolieferant = $this->app->DB->Select("SELECT zahlungszielskonto FROM lieferantvorlage WHERE adresse='$id' LIMIT 1");
      $versandartlieferant = $this->app->DB->Select("SELECT versandart FROM lieferantvorlage WHERE adresse='$id' LIMIT 1");

      if($kundennummer !="")	
      {
        echo "UPDATE adresse SET kundennummerlieferant='$kundennummer',zahlungsweiselieferant='$zahlungsweiselieferant',
             zahlungszieltagelieferant='$zahlungszieltagelieferant',zahlungszieltageskontolieferant='$zahlungszieltageskontolieferant',
             versandartlieferant='$versandartlieferant' WHERE id='$id';";
      } 
    }

  }


  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");
  // prufe ob es schon einen eintrag gibt
  $check = $this->app->DB->Select("SELECT id FROM lieferantvorlage WHERE adresse='$id' LIMIT 1");
  if( !($check > 0 && is_numeric($check)))
  {
    $this->app->DB->Insert("INSERT INTO lieferantvorlage (id,adresse) VALUES ('','$id')");
  }

  $check = $this->app->DB->Select("SELECT id FROM lieferantvorlage WHERE adresse='$id' LIMIT 1");
  $this->app->Secure->GET['id']=$check;
  $this->app->Tpl->Set('AKTIV_TAB1',"selected");
  $widget = new WidgetLieferantvorlage($this->app,'PAGE');
  $widget->Edit();
  $this->app->Secure->GET['id']=$id;
}




function AdresseArtikelPosition()
{
  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");
  /* neu anlegen formular */
  $artikelart = $this->app->Secure->GetPOST("artikelart");
  $bezeichnung = $this->app->Secure->GetPOST("bezeichnung");
  $vpe = $this->app->Secure->GetPOST("vpe");
  $umsatzsteuerklasse = $this->app->Secure->GetPOST("umsatzsteuerklasse");
  $waehrung = $this->app->Secure->GetPOST("waehrung");
  $projekt= $this->app->Secure->GetPOST("projekt");
  $preis = $this->app->Secure->GetPOST("preis");
  $preis = str_replace(',','.',$preis);
  $menge = $this->app->Secure->GetPOST("menge");
  $art = $this->app->Secure->GetPOST("art");
  $lieferdatum = $this->app->Secure->GetPOST("lieferdatum");
  $zahlzyklus = $this->app->Secure->GetPOST("zahlzyklus");
  $wiederholend= $this->app->Secure->GetPOST("wiederholend");
  $startdatum= $this->app->Secure->GetPOST("startdatum");

  if($lieferdatum=="") $lieferdatum=date("d.m.Y");


  $anlegen_artikelneu = $this->app->Secure->GetPOST("anlegen_artikelneu");

  if($anlegen_artikelneu!="")
  { 

    if($bezeichnung!="" && $menge!="" && $preis!="")
    { 

      $neue_nummer = $this->app->erp->NeueArtikelNummer($artikelart,$this->app->User->GetFirma(),$projekt);

      // anlegen als artikel
      $this->app->DB->Insert("INSERT INTO artikel (id,typ,nummer,projekt,name_de,umsatzsteuer,adresse,firma)  
          VALUES ('','$artikelart','$neue_nummer','$projekt','$bezeichnung','$umsatzsteuerklasse','$lieferant','".$this->app->User->GetFirma()."')");

      $artikel_id = $this->app->DB->GetInsertID();
      // einkaufspreis anlegen

      $this->app->DB->Insert("INSERT INTO verkaufspreise (id,artikel,adresse,objekt,projekt,preis,ab_menge,angelegt_am,bearbeiter)
          VALUES ('','$artikel_id','$id','Standard','$projekt','$preis','$menge',NOW(),'".$this->app->User->GetName()."')");

      $lieferdatum = $this->app->String->Convert($lieferdatum,"%1.%2.%3","%3-%2-%1");
      $startdatum= $this->app->String->Convert($startdatum,"%1.%2.%3","%3-%2-%1");

      if($art=="abo") $wiederholend=1; else $wiederholend=0;

      $this->app->DB->Insert("INSERT INTO abrechnungsartikel (id,artikel,bezeichnung,nummer,menge,preis, sort,lieferdatum, steuerklasse, status,projekt,wiederholend,zahlzyklus,adresse,startdatum) 
          VALUES ('','$artikel_id','$bezeichnung','$neue_nummer','$menge','$preis','$sort','$lieferdatum','$umsatzsteuerklasse','angelegt','$projekt','$wiederholend','$zahlzyklus','$id','$startdatum')");

      header("Location: index.php?module=adresse&action=artikel&id=$id");
      exit;
    } else
      $this->app->Tpl->Set(NEUMESSAGE,"<div class=\"error\">Bestellnummer, bezeichnung, Menge und Preis sind Pflichtfelder!</div>");

  }

  $ajaxbuchen = $this->app->Secure->GetPOST("ajaxbuchen");
  if($ajaxbuchen!="")
  {
    $artikel = $this->app->Secure->GetPOST("artikel");
    $nummer = $this->app->Secure->GetPOST("nummer");
    $projekt = $this->app->Secure->GetPOST("projekt");
    $projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
    $sort = $this->app->DB->Select("SELECT MAX(sort) FROM angebot_position WHERE auftrag='$id' LIMIT 1");
    $sort = $sort + 1;
    $artikel_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' LIMIT 1");
    $bezeichnung = $artikel;
    $neue_nummer = $nummer;
    $waehrung = 'EUR';
    $umsatzsteuerklasse = $this->app->DB->Select("SELECT umsatzsteuerklasse FROM artikel WHERE nummer='$nummer' LIMIT 1");
    $vpe = 'einzeln';

    //        $this->app->DB->Insert("INSERT INTO angebot_position (id,angebot,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
    //          VALUES ('','$id','$artikel_id','$bezeichnung','$neue_nummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuerklasse','angelegt','$projekt','$vpe')");
  }


  if(1)
  {
    $this->app->Tpl->Set('ARTIKELART',$this->app->erp->GetSelect($this->app->erp->GetArtikelart(),$artikelart));
    $this->app->Tpl->Set('VPE',$this->app->erp->GetSelect($this->app->erp->GetVPE(),$vpe));
    $this->app->Tpl->Set('WAEHRUNG',$this->app->erp->GetSelect($this->app->erp->GetWaehrung(),$vpe));
    $this->app->Tpl->Set('UMSATZSTEUERKLASSE',$this->app->erp->GetSelect($this->app->erp->GetUmsatzsteuerklasse(),$umsatzsteuerklasse));
    $this->app->Tpl->Set('PROJEKT',$this->app->erp->GetProjektSelect($projekt));
    $this->app->Tpl->Set('PREIS',$preis);
    $this->app->Tpl->Set('MENGE',$menge);
    $this->app->Tpl->Set('LIEFERDATUM',$lieferdatum);
    $this->app->Tpl->Set('ZAHLZYKLUS',$zahlzyklus);
    $this->app->Tpl->Set('BEZEICHNUNG',$bezeichung);

    $this->app->Tpl->Set('SUBSUBHEADING',"Neuen Artikel anlegen");
    //      $this->app->Tpl->Parse('INHALT',"aboabrechnungsartikel_artikelneu.tpl");
    //     $this->app->Tpl->Set(EXTEND,"<input type=\"submit\" value=\"Artikel anlegen\" name=\"anlegen_artikelneu\">");
    $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
    $this->app->Tpl->Set('EXTEND',"");
    $this->app->Tpl->Set('INHALT',"");

    /* ende neu anlegen formular */
    /* ende neu anlegen formular */
    // child table einfuegen

    $menu = array(//"up"=>"upartikel",
        //                          "down"=>"downartikel",
        //"add"=>"addstueckliste",
        "edit"=>"positioneneditpopup",
        "del"=>"delartikel");
    // wiederholende artikel
    $sql = "SELECT aa.bezeichnung,art.nummer, DATE_FORMAT(aa.abgerechnetbis,'%d.%m.%Y') as abgerechnet, 
      aa.preis as preis, aa.menge as menge, if(aa.wiederholend=1 OR aa.preisart='monat' OR aa.preisart='jahr' OR aa.preisart='monatx','wdh','einmalig') as art, aa.dokument,aa.id as id
      FROM abrechnungsartikel aa LEFT JOIN artikel art ON art.id=aa.artikel
      WHERE aa.adresse='$id'";

    $this->app->YUI->SortList('TAB1',$this,$menu,$sql,false);

    //    $this->app->YUI->TableSearch('TAB1',"adresse_abo");
    $this->app->YUI->TableSearch('TAB2','abrechnungsartikel');


    $this->app->Tpl->Parse('PAGE',"adresse_abo.tpl");
  }
}


function AdresseSEPAMandat()
{

  $id = $this->app->Secure->GetGET("id");
  $pdf = new SepaMandat(); 

  $data = $this->app->DB->SelectArr("SELECT name,strasse, ansprechpartner,ort,plz,land,email,kundennummer, inhaber, bank, swift as bic, iban FROM adresse WHERE id='$id' LIMIT 1");


  $musterlinie = "_____________________________________"; 

  $pdf->firma=$this->app->erp->ReadyForPDF($data[0]['name']);
  if($pdf->firma=="") $pdf->firma = $musterlinie;
  $pdf->name=$this->app->erp->ReadyForPDF($data[0]['ansprechpartner']);
  if($pdf->name=="") $pdf->name=$musterlinie;
  $pdf->strasse=$this->app->erp->ReadyForPDF($data[0]['strasse']);
  if($pdf->strasse=="") $pdf->strasse=$musterlinie;
  $pdf->plzOrt=$this->app->erp->ReadyForPDF($data[0]['land'])."-".$this->app->erp->ReadyForPDF($data[0]['plz'])." ".$this->app->erp->ReadyForPDF($data[0]['ort']);
  if($pdf->plzOrt=="-" || $pdf->plzOrt=="- ") $pdf->plzOrt=$musterlinie;
  $pdf->email=$this->app->erp->ReadyForPDF($data[0]['email']);
  if($pdf->email=="") $pdf->email=$musterlinie;

  $pdf->kundenNr=$this->app->erp->ReadyForPDF($data[0]['kundennummer']);
  //$pdf->benutzername="info@embedded-projects.net";

  $pdf->glID=$this->app->erp->Firmendaten("sepaglaeubigerid");
  $pdf->mandatsRef=$this->app->erp->ReadyForPDF($data[0]['kundennummer']);
  $pdf->swift="_____________________________________";
  $pdf->iban="_____________________________________";

  $pdf->ermaechText="Ich ermaechtige die ".$this->app->erp->GetFirmaName().", Zahlungen von meinem Konto mittels Lastschrift einzuziehen. Zugleich weise ich mein Kreditinstitut an, die von der ".$this->app->erp->GetFirmaName()." auf mein Konto gezogenen Lastschriften einzuloesen.";

  $pdf->hinweis="Hinweis: Ich kann (Wir können) innerhalb von acht Wochen, beginnend mit dem Belastungsdatum, die Erstattung des belasteten Betrages verlangen. Es gelten dabei die mit meinem (unserem) Kreditinstitut vereinbarten Bedingungen.";   

  $pdf->render();

  $name = $this->app->erp->UmlauteEntfernen($this->app->erp->ReadyForPDF($data[0]['name']));
  $name = str_replace(" ","",$name);
  $kundennummer = $data[0]['kundennummer'];

  $filename = $tmp.date('Ymd')."_".$kundennummer."_".$name."_SEPAMANDAT.pdf";
  $pdf->Output($filename,'D');
}

function AdresseArtikel()
{
  $this->AdresseMenu();
  $id = $this->app->Secure->GetGET("id");

  // neues arbeitspaket
  //$widget = new WidgetAbrechnungsartikel(&$this->app,'TAB2');
  //$widget->Create();


  // child table einfuegen

  $menu = array("up"=>"upartikel",
      "down"=>"downartikel",
      //"add"=>"addstueckliste",
      "edit"=>"artikeleditpopup",
      "del"=>"delartikel");

  // wiederholende artikel
  $this->app->Tpl->Set('SUBSUBHEADING',"wiederholende Artikel");
  $sql = "SELECT aa.bezeichnung, DATE_FORMAT(aa.abgerechnetbis,'%d.%m.%Y') as abgerechnet, 
    aa.preis as preis, aa.menge as menge, aa.id as id
    FROM abrechnungsartikel aa
    WHERE aa.adresse='$id' AND aa.wiederholend=1";
  $this->app->YUI->SortList('INHALT',$this,$menu,$sql,false);
  $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
  $this->app->Tpl->Set('INHALT',"");


  // einmalige artikel
  $this->app->Tpl->Set('SUBSUBHEADING',"einmalige Artikel");
  $sql = "SELECT aa.bezeichnung, DATE_FORMAT(aa.abgerechnetbis,'%d.%m.%Y') as abgerechnet, 
    aa.preis as preis, aa.menge as menge, aa.id as id
    FROM abrechnungsartikel aa
    WHERE aa.adresse='$id' AND aa.wiederholend=0 AND aa.abgerechnet=0";
  $this->app->YUI->SortList('INHALT',$this,$menu,$sql,false);
  $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

  $this->app->Tpl->Set('AKTIV_TAB1',"selected");
  $this->app->Tpl->Parse('PAGE',"artikeluebersicht.tpl");
}

function AdresseArtikelEditPopup()
{
  $id = $this->app->Secure->GetGET("id");

  // nach page inhalt des dialogs ausgeben
  $widget = new WidgetAbrechnungsartikel($this->app,'PAGE');
  $sid = $this->app->DB->Select("SELECT adresse FROM abrechnungsartikel WHERE id='$id' LIMIT 1");
  $widget->form->SpecialActionAfterExecute("close_refresh",
      "index.php?module=adresse&action=artikel&id=$sid");
  $widget->Edit();
  $this->app->BuildNavigation=false;
}

function UpArtikel()
{
  $this->app->YUI->SortListEvent("up","abrechnungsartikel","adresse");
  $this->AdresseArtikel();
}

function DownArtikel()
{
  $this->app->YUI->SortListEvent("down","abrechnungsartikel","adresse");
  $this->AdresseArtikel();
}


function DelArtikel()
{
  $this->app->YUI->SortListEvent("del","abrechnungsartikel","adresse");
  $this->AdresseArtikelPosition();
}

function AdresseVerein()
{
  $id = $this->app->Secure->GetGET("id");
  $submit = $this->app->Secure->GetPOST("submit");
  $this->AdresseMenu();

  $data['verein_mitglied_seit'] = $this->app->Secure->GetPOST("verein_mitglied_seit");
  $data['verein_mitglied_bis'] = $this->app->Secure->GetPOST("verein_mitglied_bis");
  $data['verein_spendenbescheinigung'] = $this->app->Secure->GetPOST("verein_spendenbescheinigung");
  $data['verein_mitglied_aktiv'] = $this->app->Secure->GetPOST("verein_mitglied_aktiv");

  if($data['verein_spendenbescheinigung']!="1") $data['verein_spendenbescheinigung']=0;
  if($data['verein_mitglied_aktiv']!="1") $data['verein_mitglied_aktiv']=0;

  $data['verein_mitglied_seit'] = $this->app->String->Convert($data['verein_mitglied_seit'],"%1.%2.%3","%3-%2-%1");
  $data['verein_mitglied_bis'] = $this->app->String->Convert($data['verein_mitglied_bis'],"%1.%2.%3","%3-%2-%1");

  $this->app->YUI->DatePicker("verein_mitglied_seit");
  $this->app->YUI->DatePicker("verein_mitglied_bis");

  if($submit!="")
  {
    $this->app->DB->Update("UPDATE adresse SET 
      verein_mitglied_seit='".$data['verein_mitglied_seit']."',
      verein_mitglied_bis='".$data['verein_mitglied_bis']."',
      verein_spendenbescheinigung='".$data['verein_spendenbescheinigung']."',
      verein_mitglied_aktiv='".$data['verein_mitglied_aktiv']."' 
      WHERE id='$id'");
  } 


  $data = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$id'");

  $data = reset($data);
  if($data['verein_spendenbescheinigung']=="1") $this->app->Tpl->Set(VEREIN_SPENDENBESCHEINIGUNG,"checked");
  if($data['verein_mitglied_aktiv']=="1") $this->app->Tpl->Set(VEREIN_MITGLIED_AKTIV,"checked");
  $this->app->Tpl->Set(VEREIN_MITGLIED_SEIT,str_replace('..','',$this->app->String->Convert($data['verein_mitglied_seit'],"%3-%2-%1","%1.%2.%3")));
  $this->app->Tpl->Set(VEREIN_MITGLIED_BIS,str_replace('..','',$this->app->String->Convert($data['verein_mitglied_bis'],"%3-%2-%1","%1.%2.%3")));

  $this->app->Tpl->Parse('PAGE',"adresse_verein.tpl");
}

}

?>
