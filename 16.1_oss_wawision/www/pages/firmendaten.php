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

class Firmendaten  {
  var $app;

  function Firmendaten($app) {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);
    $this->app->ActionHandler("edit","FirmendatenEdit");
    $this->app->ActionHandler("briefpapier","FirmendatenBriefpapierDownload");
    $this->app->ActionHandler("logo","FirmendatenLogoDownload");
    $this->app->ActionHandler("nextnumber","FirmendatenNextNumber");

    $this->app->ActionHandler("testmail","FirmendatenTestmail");

    $this->app->ActionHandlerListen($app);

    $this->app->Tpl->Set('UEBERSCHRIFT',"Einstellungen");
    $this->app->Tpl->Set('FARBE',"[FARBE5]");


    $this->app = $app;
  }

  function FirmendatenNextNumber()
  {
    $cmd = $this->app->Secure->GetGET("cmd");
    $nummer = $this->app->Secure->GetGET("nummer");
    switch($cmd)
    {
      case "angebot": $this->app->erp->FirmendatenSet("next_angebot",$nummer); break;
      case "auftrag": $this->app->erp->FirmendatenSet("next_auftrag",$nummer); break;
      case "rechnung": $this->app->erp->FirmendatenSet("next_rechnung",$nummer); break;
      case "lieferschein": $this->app->erp->FirmendatenSet("next_lieferschein",$nummer); break;
      case "gutschrift": $this->app->erp->FirmendatenSet("next_gutschrift",$nummer); break;
      case "bestellung": $this->app->erp->FirmendatenSet("next_bestellung",$nummer); break;
      case "arbeitsnachweis": $this->app->erp->FirmendatenSet("next_arbeitsnachweis",$nummer); break;
      case "reisekosten": $this->app->erp->FirmendatenSet("next_reisekosten",$nummer); break;
      case "produktion": $this->app->erp->FirmendatenSet("next_produktion",$nummer); break;
      case "anfrage": $this->app->erp->FirmendatenSet("next_anfrage",$nummer); break;
      case "kundennummer": $this->app->erp->FirmendatenSet("next_kundennummer",$nummer); break;
      case "lieferantennummer": $this->app->erp->FirmendatenSet("next_lieferantennummer",$nummer); break;
      case "mitarbeiternummer": $this->app->erp->FirmendatenSet("next_mitarbeiternummer",$nummer); break;
      case "artikelnummer": $this->app->erp->FirmendatenSet("next_artikelnummer",$nummer); break;
    }
    header("Location: index.php?module=firmendaten&action=edit#tabs-6");
    exit;
  }


  function FirmendatenTestmail()
  {
    // 2. = to
    if($this->app->erp->MailSend($this->app->erp->GetFirmaMail(),$this->app->erp->GetFirmaName(),$this->app->erp->Firmendaten("testmailempfaenger"),"Testmail Empfaenger","WaWision: Testmail","Dies ist eine Testmail"))
    {
      $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Die Testmail wurde erfolgreich versendet. ".$this->app->erp->mail_error."</div>");
    } else {
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Die Testmail wurde nicht versendet: ".$this->app->erp->mail_error."</div>");
    }
    header("Location: index.php?module=firmendaten&action=edit&msg=$msg#tabs-4");
    exit;
    //,array($tmpbrief));
  }

  function FirmendatenLogoDownload()
  {

    $id = $this->app->DB->Select("SELECT MAX(id) FROM firma LIMIT 1");
    $logo = $this->app->DB->Select("SELECT logo FROM firmendaten WHERE firma='$id'");
    $logo_type = $this->app->DB->Select("SELECT logo_type FROM firmendaten WHERE firma='$id'");
    header('Content-type: '.$logo_type);

    $endung = str_replace("image/","",$logo_type);	

    header('Content-Disposition: attachment; filename="logo.'.$endung.'"');

    echo base64_decode($logo);

  }


  function FirmendatenBriefpapierDownload()
  {

    $id = $this->app->DB->Select("SELECT MAX(id) FROM firma LIMIT 1");
    $briefpapier = $this->app->DB->Select("SELECT briefpapier FROM firmendaten WHERE firma='$id'");
    header('Content-type: application/pdf');

    header('Content-Disposition: attachment; filename="briefpapier.pdf"');

    echo base64_decode($briefpapier);

  }

  function FirmendatenEdit()
  {
    //    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Firmendaten");
    $this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=firmendaten&action=edit","&Uuml;bersicht");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Grundeinstellungen");


    $this->app->Tpl->Set(MYSQLVERSION,$this->app->DB->Select("SELECT VERSION( ) AS mysql_version"));

    //    $this->app->YUI->ColorPicker("firmenfarbehell");
    //    $this->app->YUI->ColorPicker("firmenfarbedunkel");
    //    $this->app->YUI->ColorPicker("firmenfarbeganzdunkel");


    if($this->app->erp->Firmendaten("version")=="")
      $this->app->erp->FirmendatenSet("version",$this->app->erp->RevisionPlain());

    $lizenz = $this->app->erp->Firmendaten("lizenz");
    $schluessel = $this->app->erp->Firmendaten("schluessel");
    if($lizenz=="" || $schluessel=="")
    {
      if(is_file("../wawision.inc.php"))
      {
        include_once("../wawision.inc.php");
        $this->app->erp->FirmendatenSet("lizenz",$WAWISION['serial']);
        $this->app->erp->FirmendatenSet("schluessel",$WAWISION['authkey']);
      }
    }

    $id = $this->app->DB->Select("SELECT MAX(id) FROM firma LIMIT 1");

    $this->app->YUI->AutoComplete("projekt","projektname",1);
    //$this->app->YUI->AutoComplete("standardversanddrucker","drucker");
    //$this->app->YUI->AutoComplete("standardetikettendrucker","drucker");

    $this->app->Tpl->Set(NEXT_ANGEBOT_MAX,$this->app->DB->Select("SELECT MAX(belegnr) FROM angebot WHERE DATE_FORMAT(datum,'%Y')=DATE_FORMAT(NOW(),'%Y')"));
    $this->app->Tpl->Set(NEXT_RECHNUNG_MAX,$this->app->DB->Select("SELECT MAX(belegnr) FROM rechnung WHERE DATE_FORMAT(datum,'%Y')=DATE_FORMAT(NOW(),'%Y')"));
    $this->app->Tpl->Set(NEXT_AUFTRAG_MAX,$this->app->DB->Select("SELECT MAX(belegnr) FROM auftrag WHERE DATE_FORMAT(datum,'%Y')=DATE_FORMAT(NOW(),'%Y')"));
    $this->app->Tpl->Set(NEXT_LIEFERSCHEIN_MAX,$this->app->DB->Select("SELECT MAX(belegnr) FROM lieferschein WHERE DATE_FORMAT(datum,'%Y')=DATE_FORMAT(NOW(),'%Y')"));
    $this->app->Tpl->Set(NEXT_GUTSCHRIFT_MAX,$this->app->DB->Select("SELECT MAX(belegnr) FROM gutschrift WHERE DATE_FORMAT(datum,'%Y')=DATE_FORMAT(NOW(),'%Y')"));
    $this->app->Tpl->Set(NEXT_BESTELLUNG_MAX,$this->app->DB->Select("SELECT MAX(belegnr) FROM bestellung WHERE DATE_FORMAT(datum,'%Y')=DATE_FORMAT(NOW(),'%Y')"));
    $this->app->Tpl->Set(NEXT_ARBEITSNACHWEIS_MAX,$this->app->DB->Select("SELECT MAX(belegnr) FROM arbeitsnachweis WHERE DATE_FORMAT(datum,'%Y')=DATE_FORMAT(NOW(),'%Y')"));

    $this->app->Tpl->Set(NEXT_KUNDENNUMMER_MAX,$this->app->DB->Select("SELECT MAX(kundennummer) FROM adresse"));
    $this->app->Tpl->Set(NEXT_LIEFERANTENNUMMER_MAX,$this->app->DB->Select("SELECT MAX(lieferantennummer) FROM adresse"));
    $this->app->Tpl->Set(NEXT_MITARBEITERNUMMER_MAX,$this->app->DB->Select("SELECT MAX(mitarbeiternummer) FROM adresse"));

    $this->app->Tpl->Set(NEXT_WAREN_MAX,$this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE typ='produkt' OR typ=''"));
    $this->app->Tpl->Set(NEXT_PRODUKTION_MAX,$this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE typ='produktion'"));
    $this->app->Tpl->Set(NEXT_SONSTIGES_MAX,$this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE typ='material' OR typ='fremdleistung' OR typ='gebuehr'"));



    // Hole Post-Daten
    $data = $this->getPostData();

    $testmail = $this->app->Secure->GetPOST("testmail");
    $submit = $this->app->Secure->GetPOST("submitFirmendaten");


    if($submit!="")
    {
      $error = "";
      $logo_error = "";
      $briefpapier_error = ""; 
      $firmenlogo_error = ""; 

      // Seite 2
      if($_FILES[firmenlogo][size]>0)
      {
        $firmenlogo_error = $this->app->erp->checkImage($_FILES[firmenlogo],0,0,0,3);
        if($firmenlogo_error=="")
        {
          $firmenlogo = $this->app->erp->uploadFileIntoDB($_FILES[firmenlogo]);
          $this->app->DB->Update("UPDATE firmendaten SET firmenlogo='{$firmenlogo['file']}' WHERE firma='$id'");
        }
        else
          $error .= "$firmenlogo_error<br>";
      }



      if($data[hintergrund] == "logo")
      {
        if($_FILES[logo][size]>0)
        {
          $logo_error = $this->app->erp->checkImage($_FILES[logo]);
          if($logo_error=="")
          {
            $logo = $this->app->erp->uploadImageIntoDB($_FILES[logo]);	  
            $this->app->DB->Update("UPDATE firmendaten SET logo='{$logo[image]}', logo_type='{$logo[type]}' WHERE firma='$id' LIMIT 1");
          }
          else
            $error .= "$logo_error<br>";
        }else
        {
          //pruefe ob logo vorhanden
          $logo = $this->app->DB->Select("SELECT logo FROM firmendaten WHERE firma=$id LIMIT 1");
          if(strlen($logo)<10)
            $error .= "Geben Sie bitte ein Logo zum Hochladen an.<br>";
        }
      }

      if($data[hintergrund] == "briefpapier")
      {
        // Seite 2
        if($_FILES[briefpapier2][size]>0)
        {
          $briefpapier2_error = $this->app->erp->checkFile($_FILES[briefpapier2],"application/pdf");
          if($briefpapier2_error=="")
          {
            $briefpapier2 = $this->app->erp->uploadFileIntoDB($_FILES[briefpapier2]);
            $this->app->DB->Update("UPDATE firmendaten SET briefpapier2='{$briefpapier2['file']}' WHERE firma='$id'");
          }
          else
            $error .= "$briefpapier2_error<br>";
        }

        // Seite 1
        if($_FILES[briefpapier][size]>0)
        {
          $briefpapier_error = $this->app->erp->checkFile($_FILES[briefpapier],"application/pdf");
          if($briefpapier_error=="")
          {
            $briefpapier = $this->app->erp->uploadFileIntoDB($_FILES[briefpapier]);
            $this->app->DB->Update("UPDATE firmendaten SET briefpapier='{$briefpapier['file']}', briefpapier_type='{$briefpapier[type]}' WHERE firma='$id'");
          }
          else
            $error .= "$briefpapier_error<br>";
        } else
          $briefpapier = $this->app->DB->Select("SELECT briefpapier FROM firmendaten WHERE firma=$id LIMIT 1");

        if($briefpapier=="")
          $error .= "Geben Sie bitte das Briefpapier zum Hochladen an.<br>";
      }
      /*
         if($data[benutzername]=="")
         $error .= "Geben Sie bitte einen E-Mail-Benutzername an.<br>";

         if($data[passwort]=="")
         $error .= "Geben Sie bitte ein E-Mail-Passwort an.<br>";

         if($data[host]=="")
         $error .= "Geben Sie bitte einen E-Mail-Host an.<br>";

         if($data[port]=="")
         $error .= "Geben Sie bitte einen E-Mail-Port (Standard 25) an.<br>";

         if($data[email]=="")
         $error .= "Geben Sie bitte einen E-Mail Adresse an.<br>";
       */     
      if($error=="")
      {
        $vorhanden = $this->app->DB->Select("SELECT id FROM firmendaten WHERE firma='$id' LIMIT 1");

        if(!is_numeric($vorhanden)) {
          $this->app->DB->Insert("INSERT INTO firmendaten (firma) VALUES ('$id')");
        }

        // Update Bilder

        // suche max nummern

        //suche projekt ID von abkuerzung

        $data[projekt] = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='{$data[projekt]}' LIMIT 1");

        // wenn cloud hole data[lizenz] data[schluessel]

        if(!($this->app->Conf->WFcloud==true))
        {
          $extendsql = "lizenz='{$data[lizenz]}',
            schluessel='{$data[schluessel]}',";
        }


        $this->app->DB->Update("UPDATE firmendaten SET 
            $extendsql	
            absender='{$data[absender]}', 
            sichtbar='{$data[sichtbar]}', 
            rechnung_gutschrift_ansprechpartner='{$data[rechnung_gutschrift_ansprechpartner]}', 
            knickfalz='{$data[knickfalz]}', 
            standardaufloesung='{$data[standardaufloesung]}', 
            standardversanddrucker='{$data[standardversanddrucker]}', 
            standardetikettendrucker='{$data[standardetikettendrucker]}', 
            etikettendrucker_wareneingang='{$data[etikettendrucker_wareneingang]}', 
            firmenlogoaktiv='{$data[firmenlogoaktiv]}', 
            barcode='{$data[barcode]}', schriftgroesse='{$data[schriftgroesse]}',
            betreffszeile='{$data[betreffszeile]}', dokumententext='{$data[dokumententext]}', tabellenbeschriftung='{$data[tabellenbeschriftung]}', 
            tabelleninhalt='{$data[tabelleninhalt]}', zeilenuntertext='{$data[zeilenuntertext]}', freitext='{$data[freitext]}', infobox='{$data[infobox]}', brieftext='{$data[brieftext]}',
            spaltenbreite='{$data[spaltenbreite]}', footer_0_0='{$data[footer][0][0]}', footer_0_1 ='{$data[footer][0][1]}', footer_0_2 ='{$data[footer][0][2]}', 
            footer_0_3 ='{$data[footer][0][3]}', footer_0_4 ='{$data[footer][0][4]}', footer_0_5 ='{$data[footer][0][5]}', footer_1_0 ='{$data[footer][1][0]}', 
            footer_1_1 ='{$data[footer][1][1]}', footer_1_2 ='{$data[footer][1][2]}', footer_1_3 ='{$data[footer][1][3]}', footer_1_4 ='{$data[footer][1][4]}', 
            footer_1_5 ='{$data[footer][1][5]}', footer_2_0 ='{$data[footer][2][0]}', footer_2_1 ='{$data[footer][2][1]}', footer_2_2 ='{$data[footer][2][2]}', 
            footer_2_3 ='{$data[footer][2][3]}', footer_2_4 ='{$data[footer][2][4]}', footer_2_5 ='{$data[footer][2][5]}', footer_3_0 ='{$data[footer][3][0]}', 
            footer_3_1 ='{$data[footer][3][1]}', footer_3_2 ='{$data[footer][3][2]}', footer_3_3 ='{$data[footer][3][3]}', footer_3_4 ='{$data[footer][3][4]}', 
            footer_3_5 ='{$data[footer][3][5]}', seite_von_sichtbar='{$data[seite_von_sichtbar]}', seite_von_ausrichtung='{$data[seite_von_ausrichtung]}',
            footersichtbar='{$data[footersichtbar]}', 
            briefpapier2vorhanden='{$data[briefpapier2vorhanden]}', 
            hintergrund='{$data[hintergrund]}', benutzername='{$data[benutzername]}', 
            abstand_adresszeileoben='{$data[abstand_adresszeileoben]}',
            abstand_boxrechtsoben='{$data[abstand_boxrechtsoben]}',
            abstand_boxrechtsoben_lr='{$data[abstand_boxrechtsoben_lr]}',
            abstand_betreffzeileoben='{$data[abstand_betreffzeileoben]}',
            abstand_artikeltabelleoben='{$data[abstand_artikeltabelleoben]}',
            abstand_name_beschreibung='{$data[abstand_name_beschreibung]}',
            artikel_suche_kurztext='{$data[artikel_suche_kurztext]}',
            adresse_freitext1_suche='{$data[adresse_freitext1_suche]}',

            freifeld1='{$data[freifeld1]}',
            freifeld2='{$data[freifeld2]}',
            freifeld3='{$data[freifeld3]}',
            freifeld4='{$data[freifeld4]}',
            freifeld5='{$data[freifeld5]}',
            freifeld6='{$data[freifeld6]}',


            standard_datensaetze_datatables='{$data[standard_datensaetze_datatables]}',
            waehrung='{$data[waehrung]}',
            branch='{$data[branch]}',
            api_initkey='{$data[api_initkey]}',
            api_remotedomain='{$data[api_remotedomain]}',
            api_eventurl='{$data[api_eventurl]}',
            api_enable='{$data[api_enable]}',
            api_importwarteschlange='{$data[api_importwarteschlange]}',
            api_importwarteschlange_name='{$data[api_importwarteschlange_name]}',
            warnung_doppelte_nummern='{$data[warnung_doppelte_nummern]}',
            wareneingang_zwischenlager='{$data[wareneingang_zwischenlager]}',
            boxausrichtung='{$data[boxausrichtung]}',
            footer_breite1='{$data[footer_breite1]}',
            footer_breite2='{$data[footer_breite2]}',
            footer_breite3='{$data[footer_breite3]}',
            footer_breite4='{$data[footer_breite4]}',
            steuersatz_normal='{$data[steuersatz_normal]}',
            steuersatz_ermaessigt='{$data[steuersatz_ermaessigt]}',
            parameterundfreifelder='{$data[parameterundfreifelder]}',
            angebot_ohnebriefpapier='{$data[angebot_ohnebriefpapier]}',
            auftrag_ohnebriefpapier='{$data[auftrag_ohnebriefpapier]}',
            rechnung_ohnebriefpapier='{$data[rechnung_ohnebriefpapier]}',
            lieferschein_ohnebriefpapier='{$data[lieferschein_ohnebriefpapier]}',
            gutschrift_ohnebriefpapier='{$data[gutschrift_ohnebriefpapier]}',
            bestellung_ohnebriefpapier='{$data[bestellung_ohnebriefpapier]}',
            arbeitsnachweis_ohnebriefpapier='{$data[arbeitsnachweis_ohnebriefpapier]}',
            externereinkauf='{$data[externereinkauf]}',
            modul_mlm='{$data[modul_mlm]}',
            modul_mhd='{$data[modul_mhd]}',
            modul_verband='{$data[modul_verband]}',
            projektnummerimdokument='{$data[projektnummerimdokument]}',
            mailanstellesmtp='{$data[mailanstellesmtp]}',
            herstellernummerimdokument='{$data[herstellernummerimdokument]}',
            artikeleinheit='{$data[artikeleinheit]}',
            artikeleinheit_standard='{$data[artikeleinheit_standard]}',
            auftrag_bezeichnung_bearbeiter='{$data[auftrag_bezeichnung_bearbeiter]}',
            auftrag_bezeichnung_bestellnummer='{$data[auftrag_bezeichnung_bestellnummer]}',
            bezeichnungkundennummer='{$data[bezeichnungkundennummer]}',
            auftrag_bezeichnung_vertrieb='{$data[auftrag_bezeichnung_vertrieb]}',
            standardmarge='{$data[standardmarge]}',
            schriftart='{$data[schriftart]}',

            firmenfarbehell='{$data[firmenfarbehell]}',
            firmenfarbedunkel='{$data[firmenfarbedunkel]}',
            firmenfarbeganzdunkel='{$data[firmenfarbeganzdunkel]}',
            navigationfarbe='{$data[navigationfarbe]}',
            navigationfarbeschrift='{$data[navigationfarbeschrift]}',
            unternavigationfarbe='{$data[unternavigationfarbe]}',
            unternavigationfarbeschrift='{$data[unternavigationfarbeschrift]}',

            zahlung_rechnung='{$data[zahlung_rechnung]}',
            zahlung_vorkasse='{$data[zahlung_vorkasse]}',
            zahlung_nachnahme='{$data[zahlung_nachnahme]}',
            zahlung_bar='{$data[zahlung_bar]}',
            zahlung_paypal='{$data[zahlung_paypal]}',
            zahlung_amazon='{$data[zahlung_amazon]}',
            zahlung_lastschrift='{$data[zahlung_lastschrift]}',
            zahlung_kreditkarte='{$data[zahlung_kreditkarte]}',
            zahlung_ratenzahlung='{$data[zahlung_ratenzahlung]}',
            zahlung_rechnung_sofort_de='{$data[zahlung_rechnung_sofort_de]}',
            zahlung_rechnung_de='{$data[zahlung_rechnung_de]}',
            zahlung_vorkasse_de='{$data[zahlung_vorkasse_de]}',
            zahlung_bar_de='{$data[zahlung_bar_de]}',
            zahlung_lastschrift_de='{$data[zahlung_lastschrift_de]}',
            zahlung_nachnahme_de='{$data[zahlung_nachnahme_de]}',
            zahlung_paypal_de='{$data[zahlung_paypal_de]}',
            zahlung_amazon_de='{$data[zahlung_amazon_de]}',
            zahlung_kreditkarte_de='{$data[zahlung_kreditkarte_de]}',
            zahlung_ratenzahlung_de='{$data[zahlung_ratenzahlung_de]}',
            zahlungszieltage='{$data[zahlungszieltage]}',
            zahlungszieltageskonto='{$data[zahlungszieltageskonto]}',
            zahlungszielskonto='{$data[zahlungszielskonto]}',
            kleinunternehmer='{$data[kleinunternehmer]}',
            schnellanlegen='{$data[schnellanlegen]}',
            bestellvorschlaggroessernull='{$data[bestellvorschlaggroessernull]}',
            immernettorechnungen='{$data[immernettorechnungen]}',

            rechnung_header='{$data[rechnung_header]}',
            rechnung_footer='{$data[rechnung_footer]}',

            lieferschein_header='{$data[lieferschein_header]}',
            lieferschein_footer='{$data[lieferschein_footer]}',
            auftrag_header='{$data[auftrag_header]}',
            auftrag_footer='{$data[auftrag_footer]}',
            angebot_header='{$data[angebot_header]}',
            angebot_footer='{$data[angebot_footer]}',
            gutschrift_header='{$data[gutschrift_header]}',
            gutschrift_footer='{$data[gutschrift_footer]}',
            bestellung_header='{$data[bestellung_header]}',
            bestellung_footer='{$data[bestellung_footer]}',
            arbeitsnachweis_header='{$data[arbeitsnachweis_header]}',
            arbeitsnachweis_footer='{$data[arbeitsnachweis_footer]}',
            provisionsgutschrift_header='{$data[provisionsgutschrift_header]}',
            provisionsgutschrift_footer='{$data[provisionsgutschrift_footer]}',
            eu_lieferung_vermerk='{$data[eu_lieferung_vermerk]}',
            export_lieferung_vermerk='{$data[export_lieferung_vermerk]}',

            wareneingang_kamera_waage ='{$data[wareneingang_kamera_waage]}', 
            layout_iconbar ='{$data[layout_iconbar]}', 

            passwort='{$data[passwort]}',  host='{$data[host]}', port='{$data[port]}', mailssl='{$data[mailssl]}', signatur='{$data[signatur]}',email='{$data[email]}',
            absendername='{$data[absendername]}',bcc1='{$data[bcc1]}',bcc2='{$data[bcc2]}',firmenfarbe='{$data[firmenfarbe]}',
            name='{$data[name]}',strasse='{$data[strasse]}',plz='{$data[plz]}',ort='{$data[ort]}',
            steuernummer='{$data[steuernummer]}', projekt='{$data[projekt]}' WHERE firma='$id' LIMIT 1");

        $fields = $this->app->erp->GetFirmaFields();
        foreach($fields as $key)
        {
          $this->app->DB->Update("UPDATE firmendaten SET $key='{$data[$key]}' WHERE firma='$id' LIMIT 1");
        }

        $fields_checkbox = $this->app->erp->GetFirmaFieldsCheckbox();
        foreach($fields_checkbox as $key)
        {
          $this->app->DB->Update("UPDATE firmendaten SET $key='{$data[$key]}' WHERE firma='$id' LIMIT 1");
        }



        $this->app->DB->Update("UPDATE firma SET name='{$data[name]}', standardprojekt='{$data[projekt]}' WHERE id='$id' LIMIT 1");

        $this->app->Tpl->Set(MESSAGE, "<div class=\"error2\">Ihre Daten wurden erfolgreich gespeichert.</div>");
        $this->FillFormFromDB($id); 
      }else 
      {
        // Im Fehlerfall sollen das Formular mit den POST-Daten gefuellt werden
        $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">$error</div>");
        $this->fillForm($data);
      }
    }else
      $this->FillFormFromDB($id);


    //   $this->app->Tpl->Set(TABTEXT,"Firmendaten Einstellungen");
    $this->app->Tpl->Parse(PAGE,"firmendaten.tpl");
    //    $this->app->Tpl->Parse(PAGE,"tabview.tpl");

  }

  function fillFormFromDB($id)
  {
    $vorhanden = $this->app->DB->Select("SELECT id FROM firmendaten WHERE firma='$id' LIMIT 1");

    if(!is_numeric($vorhanden))
    {
      // Falls das Formular zum ersten mal aufgerufen wird
      $this->app->Tpl->Set(SICHTBAR , "checked");
      $this->app->Tpl->Set(HINTERGRUNDKEIN, "checked");
    }else
    {
      // Lade Formular aus DB
      $data = $this->app->DB->SelectArr("SELECT * FROM firmendaten WHERE firma='$id' LIMIT 1");

      //Brief Absender
      $this->app->Tpl->Set(ABSENDER , $data[0][absender]);    
      $this->app->Tpl->Set(SICHTBAR , $this->parseCheckbox($data[0][sichtbar]));
      $this->app->Tpl->Set(RECHNUNG_GUTSCHRIFT_ANSPRECHPARTNER , $this->parseCheckbox($data[0][rechnung_gutschrift_ansprechpartner]));
      $this->app->Tpl->Set(KNICKFALZ , $this->parseCheckbox($data[0][knickfalz]));
      $this->app->Tpl->Set(STANDARDAUFLOESUNG, $this->parseCheckbox($data[0][standardaufloesung]));
      $this->app->Tpl->Set(FIRMENLOGOAKTIV , $this->parseCheckbox($data[0][firmenlogoaktiv]));
      $this->app->Tpl->Set(ARTIKELSUCHEKURZTEXT , $this->parseCheckbox($data[0][artikel_suche_kurztext]));
      $this->app->Tpl->Set(ADRESSE_FREITEXT1_SUCHE , $this->parseCheckbox($data[0][adresse_freitext1_suche]));
      $this->app->Tpl->Set(PARAMETERUNDFREIFELDER , $this->parseCheckbox($data[0][parameterundfreifelder]));
      $this->app->Tpl->Set(FREIFELD1 , $data[0][freifeld1]);    
      $this->app->Tpl->Set(FREIFELD2 , $data[0][freifeld2]);    
      $this->app->Tpl->Set(FREIFELD3 , $data[0][freifeld3]);    
      $this->app->Tpl->Set(FREIFELD4 , $data[0][freifeld4]);    
      $this->app->Tpl->Set(FREIFELD5 , $data[0][freifeld5]);    
      $this->app->Tpl->Set(FREIFELD6 , $data[0][freifeld6]);    
      $this->app->Tpl->Set(STANDARD_DATENSAETZE_DATATABLES , $data[0][standard_datensaetze_datatables]);    
      $this->app->Tpl->Set(STEUERSATZNORMAL , $data[0][steuersatz_normal]);    
      $this->app->Tpl->Set(STEUERSATZERMAESSIGT , $data[0][steuersatz_ermaessigt]);    
      $this->app->Tpl->Set(WAEHRUNG , $data[0][waehrung]);    
      $this->app->Tpl->Set(LIZENZ , $data[0][lizenz]);    
      $this->app->Tpl->Set(SCHLUESSEL , $data[0][schluessel]);    
      $this->app->Tpl->Set(BRANCH , $data[0][branch]);    
      $this->app->Tpl->Set(VERSION , $data[0][version]);    

      if($data[0][api_initkey]!="" && $data[0][api_remotedomain]!="")
        $this->app->Tpl->Set(APITEMPKEY,$this->app->erp->generateHash($data[0][api_remotedomain],$data[0][api_initkey]));


      $this->app->Tpl->Set(APIINITKEY , $data[0][api_initkey]);    
      $this->app->Tpl->Set(APIREMOTEDOMAIN , $data[0][api_remotedomain]);    
      $this->app->Tpl->Set(APIEVENTURL , $data[0][api_eventurl]);    
      $this->app->Tpl->Set(APIENABLE , $this->parseCheckbox($data[0][api_enable]));
      $this->app->Tpl->Set(API_IMPORTWARTESCHLANGE , $this->parseCheckbox($data[0][api_importwarteschlange]));
      $this->app->Tpl->Set(API_IMPORTWARTESCHLANGE_NAME , $data[0][api_importwarteschlange_name]);
      $this->app->Tpl->Set(BOXAUSRICHTUNG , $data[0][boxausrichtung]);    
      $this->app->Tpl->Set(FOOTERBREITE1 , $data[0][footer_breite1]);    
      $this->app->Tpl->Set(FOOTERBREITE2 , $data[0][footer_breite2]);    
      $this->app->Tpl->Set(FOOTERBREITE3 , $data[0][footer_breite3]);    
      $this->app->Tpl->Set(FOOTERBREITE4 , $data[0][footer_breite4]);    
      $this->app->Tpl->Set(WARNUNG_DOPPELTE_NUMMERN , $this->parseCheckbox($data[0][warnung_doppelte_nummern]));
      $this->app->Tpl->Set(WARENEINGANG_ZWISCHENLAGER , $this->parseCheckbox($data[0][wareneingang_zwischenlager]));

      //Formatierung
      $this->app->Tpl->Set(BARCODE , $this->parseCheckbox($data[0][barcode]));    
      $this->app->Tpl->Set(SCHRIFTGROESSE , ($data[0][schriftgroesse]));    
      $this->app->Tpl->Set(BETREFFSZEILE , ($data[0][betreffszeile]));    
      $this->app->Tpl->Set(DOKUMENTENTEXT , ($data[0][dokumententext]));    
      $this->app->Tpl->Set(TABELLENBESCHRIFTUNG , ($data[0][tabellenbeschriftung]));    
      $this->app->Tpl->Set(TABELLENINHALT , ($data[0][tabelleninhalt]));    
      $this->app->Tpl->Set(ZEILENUNTERTEXT , ($data[0][zeilenuntertext]));    
      $this->app->Tpl->Set(FREITEXT , ($data[0][freitext]));    
      $this->app->Tpl->Set(BRIEFTEXT , ($data[0][brieftext]));    
      $this->app->Tpl->Set(INFOBOX , ($data[0][infobox]));    
      $this->app->Tpl->Set(SPALTENBREITE , ($data[0][spaltenbreite]));

      $this->app->Tpl->Set(ABSTANDADRESSZEILEOBEN , ($data[0][abstand_adresszeileoben]));    
      $this->app->Tpl->Set(ABSTANDBOXRECHTSOBEN , ($data[0][abstand_boxrechtsoben]));    
      $this->app->Tpl->Set(ABSTANDBOXRECHTSOBENLR , ($data[0][abstand_boxrechtsoben_lr]));    
      $this->app->Tpl->Set(ABSTANDBETREFFZEILEOBEN , ($data[0][abstand_betreffzeileoben]));    
      $this->app->Tpl->Set(ABSTANDARTIKELTABELLEOBEN , ($data[0][abstand_artikeltabelleoben]));    
      $this->app->Tpl->Set(ABSTANDNAMEBESCHREIBUNG , ($data[0][abstand_name_beschreibung]));    
      $this->app->Tpl->Set(ARTIKELEINHEITSTANDARD , ($data[0][artikeleinheit_standard]));    
      $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_BEARBEITER , ($data[0][auftrag_bezeichnung_bearbeiter]));    
      $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_VERTRIEB , ($data[0][auftrag_bezeichnung_vertrieb]));    
      $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_BESTELLNUMMER , ($data[0][auftrag_bezeichnung_bestellnummer]));    
      $this->app->Tpl->Set(BEZEICHNUNGKUNDENNUMMER , ($data[0][bezeichnungkundennummer]));    

      // Footer
      $this->app->Tpl->Set(FOOTER00 , $data[0][footer_0_0]);
      $this->app->Tpl->Set(FOOTER01 , $data[0][footer_0_1]);
      $this->app->Tpl->Set(FOOTER02 , $data[0][footer_0_2]);
      $this->app->Tpl->Set(FOOTER03 , $data[0][footer_0_3]);
      $this->app->Tpl->Set(FOOTER04 , $data[0][footer_0_4]);
      $this->app->Tpl->Set(FOOTER05 , $data[0][footer_0_5]);
      $this->app->Tpl->Set(FOOTER10 , $data[0][footer_1_0]);
      $this->app->Tpl->Set(FOOTER11 , $data[0][footer_1_1]);
      $this->app->Tpl->Set(FOOTER12 , $data[0][footer_1_2]);
      $this->app->Tpl->Set(FOOTER13 , $data[0][footer_1_3]);
      $this->app->Tpl->Set(FOOTER14 , $data[0][footer_1_4]);
      $this->app->Tpl->Set(FOOTER15 , $data[0][footer_1_5]);
      $this->app->Tpl->Set(FOOTER20 , $data[0][footer_2_0]);
      $this->app->Tpl->Set(FOOTER21 , $data[0][footer_2_1]);
      $this->app->Tpl->Set(FOOTER22 , $data[0][footer_2_2]);
      $this->app->Tpl->Set(FOOTER23 , $data[0][footer_2_3]);
      $this->app->Tpl->Set(FOOTER24 , $data[0][footer_2_4]);
      $this->app->Tpl->Set(FOOTER25 , $data[0][footer_2_5]);
      $this->app->Tpl->Set(FOOTER30 , $data[0][footer_3_0]);
      $this->app->Tpl->Set(FOOTER31 , $data[0][footer_3_1]);
      $this->app->Tpl->Set(FOOTER32 , $data[0][footer_3_2]);
      $this->app->Tpl->Set(FOOTER33 , $data[0][footer_3_3]);
      $this->app->Tpl->Set(FOOTER34 , $data[0][footer_3_4]);
      $this->app->Tpl->Set(FOOTER35 , $data[0][footer_3_5]);

      $this->app->Tpl->Set(RECHNUNG_HEADER , $data[0][rechnung_header]);
      $this->app->Tpl->Set(LIEFERSCHEIN_HEADER , $data[0][lieferschein_header]);
      $this->app->Tpl->Set(GUTSCHRIFT_HEADER , $data[0][gutschrift_header]);
      $this->app->Tpl->Set(ANGEBOT_HEADER , $data[0][angebot_header]);
      $this->app->Tpl->Set(AUFTRAG_HEADER , $data[0][auftrag_header]);
      $this->app->Tpl->Set(BESTELLUNG_HEADER , $data[0][bestellung_header]);
      $this->app->Tpl->Set(ARBEITSNACHWEIS_HEADER , $data[0][arbeitsnachweis_header]);
      $this->app->Tpl->Set(PROVISIONSGUTSCHRIFT_HEADER , $data[0][provisionsgutschrift_header]);

      $this->app->Tpl->Set(RECHNUNG_FOOTER , $data[0][rechnung_footer]);
      $this->app->Tpl->Set(LIEFERSCHEIN_FOOTER , $data[0][lieferschein_footer]);
      $this->app->Tpl->Set(GUTSCHRIFT_FOOTER , $data[0][gutschrift_footer]);
      $this->app->Tpl->Set(ANGEBOT_FOOTER , $data[0][angebot_footer]);
      $this->app->Tpl->Set(AUFTRAG_FOOTER , $data[0][auftrag_footer]);
      $this->app->Tpl->Set(BESTELLUNG_FOOTER , $data[0][bestellung_footer]);
      $this->app->Tpl->Set(ARBEITSNACHWEIS_FOOTER , $data[0][arbeitsnachweis_footer]);
      $this->app->Tpl->Set(PROVISIONSGUTSCHRIFT_FOOTER , $data[0][provisionsgutschrift_footer]);
      $this->app->Tpl->Set(EU_LIEFERUNG_VERMERK , $data[0][eu_lieferung_vermerk]);
      $this->app->Tpl->Set(EXPORT_LIEFERUNG_VERMERK , $data[0][export_lieferung_vermerk]);

      $this->app->Tpl->Set(STANDARDVERSANDDRUCKER , $this->app->erp->GetSelectDrucker($data[0][standardversanddrucker]));
      $this->app->Tpl->Set(STANDARDETIKETTENDRUCKER , $this->app->erp->GetSelectEtikettenDrucker($data[0][standardetikettendrucker]));
      $this->app->Tpl->Set(ETIKETTENDRUCKERWARENEINGANG , $this->app->erp->GetSelectEtikettenDrucker($data[0][etikettendrucker_wareneingang]));

      $this->app->Tpl->Set(FOOTERSICHTBAR , $this->parseCheckbox($data[0][footersichtbar]));
      $this->app->Tpl->Set(BRIEFPAPIER2VORHANDEN , $this->parseCheckbox($data[0][briefpapier2vorhanden]));
      $this->app->Tpl->Set(ANGEBOT_OHNEBRIEFPAPIER , $this->parseCheckbox($data[0][angebot_ohnebriefpapier]));
      $this->app->Tpl->Set(AUFTRAG_OHNEBRIEFPAPIER , $this->parseCheckbox($data[0][auftrag_ohnebriefpapier]));
      $this->app->Tpl->Set(RECHNUNG_OHNEBRIEFPAPIER , $this->parseCheckbox($data[0][rechnung_ohnebriefpapier]));
      $this->app->Tpl->Set(LIEFERSCHEIN_OHNEBRIEFPAPIER , $this->parseCheckbox($data[0][lieferschein_ohnebriefpapier]));
      $this->app->Tpl->Set(GUTSCHRIFT_OHNEBRIEFPAPIER , $this->parseCheckbox($data[0][gutschrift_ohnebriefpapier]));
      $this->app->Tpl->Set(BESTELLUNG_OHNEBRIEFPAPIER , $this->parseCheckbox($data[0][bestellung_ohnebriefpapier]));
      $this->app->Tpl->Set(ARBEITSNACHWEIS_OHNEBRIEFPAPIER , $this->parseCheckbox($data[0][arbeitsnachweis_ohnebriefpapier]));
      $this->app->Tpl->Set(EXTERNEREINKAUF , $this->parseCheckbox($data[0][externereinkauf]));
      $this->app->Tpl->Set(MODUL_MLM , $this->parseCheckbox($data[0][modul_mlm]));
      $this->app->Tpl->Set(MODUL_MHD , $this->parseCheckbox($data[0][modul_mhd]));
      $this->app->Tpl->Set(MODUL_VERBAND , $this->parseCheckbox($data[0][modul_verband]));

      $this->app->Tpl->Set(PROJEKTNUMMERIMDOKUMENT , $this->parseCheckbox($data[0][projektnummerimdokument]));
      $this->app->Tpl->Set(MAILANSTELLESMTP , $this->parseCheckbox($data[0][mailanstellesmtp]));
      $this->app->Tpl->Set(HERSTELLERNUMMERIMDOKUMENT , $this->parseCheckbox($data[0][herstellernummerimdokument]));
      $this->app->Tpl->Set(ARTIKELEINHEIT , $this->parseCheckbox($data[0][artikeleinheit]));
      $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_BEARBEITER , $data[0][auftrag_bezeichnung_bearbeiter]);
      $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_VETRIEB , $data[0][auftrag_bezeichnung_vertrieb]);
      $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_BESTELLNUMMER , $data[0][auftrag_bezeichnung_bestellnummer]);
      $this->app->Tpl->Set(BEZEICHNUNGKUNDENNUMMER , $data[0][bezeichnungkundennummer]);
      $this->app->Tpl->Set(STANDARDMARGE , $data[0][standardmarge]);

      $this->app->Tpl->Set(SEITEVONSICHTBAR , $this->parseCheckbox($data[0][seite_von_sichtbar]));
      $this->app->Tpl->Set(SEITEVONAUSRICHTUNG , $data[0][seite_von_ausrichtung]);
      $this->app->Tpl->Set(SCHRIFTART , $data[0][schriftart]);

      $this->app->Tpl->Set(FIRMENFARBEHELL,$data[0][firmenfarbehell]);
      $this->app->Tpl->Set(FIRMENFARBEDUNKEL,$data[0][firmenfarbedunkel]);
      $this->app->Tpl->Set(FIRMENFARBEGANZDUNKEL,$data[0][firmenfarbeganzdunkel]);

      $this->app->Tpl->Set(NAVIGATIONFARBE,$data[0][navigationfarbe]);
      $this->app->Tpl->Set(NAVIGATIONFARBESCHRIFT,$data[0][navigationfarbeschrift]);
      $this->app->Tpl->Set(UNTERNAVIGATIONFARBE,$data[0][unternavigationfarbe]);
      $this->app->Tpl->Set(UNTERNAVIGATIONFARBESCHRIFT,$data[0][unternavigationfarbeschrift]);

      $this->app->Tpl->Set(ZAHLUNG_RECHNUNG , $this->parseCheckbox($data[0][zahlung_rechnung]));
      $this->app->Tpl->Set(ZAHLUNG_VORKASSE , $this->parseCheckbox($data[0][zahlung_vorkasse]));
      $this->app->Tpl->Set(ZAHLUNG_NACHNAHME , $this->parseCheckbox($data[0][zahlung_nachnahme]));
      $this->app->Tpl->Set(ZAHLUNG_LASTSCHRIFT , $this->parseCheckbox($data[0][zahlung_lastschrift]));
      $this->app->Tpl->Set(ZAHLUNG_BAR , $this->parseCheckbox($data[0][zahlung_bar]));
      $this->app->Tpl->Set(ZAHLUNG_KREDITKARTE , $this->parseCheckbox($data[0][zahlung_kreditkarte]));
      $this->app->Tpl->Set(ZAHLUNG_PAYPAL , $this->parseCheckbox($data[0][zahlung_paypal]));
      $this->app->Tpl->Set(ZAHLUNG_AMAZON , $this->parseCheckbox($data[0][zahlung_amazon]));
      $this->app->Tpl->Set(ZAHLUNG_RATENZAHLUNG , $this->parseCheckbox($data[0][zahlung_ratenzahlung]));
      $this->app->Tpl->Set(KLEINUNTERNEHMER , $this->parseCheckbox($data[0][kleinunternehmer]));
      $this->app->Tpl->Set(SCHNELLANLEGEN , $this->parseCheckbox($data[0][schnellanlegen]));
      $this->app->Tpl->Set(BESTELLVORSCHLAGSGROESSERNULL , $this->parseCheckbox($data[0][bestellvorschlaggroessernull]));
      $this->app->Tpl->Set(IMMERNETTORECHNUNGEN , $this->parseCheckbox($data[0][immernettorechnungen]));

      $this->app->Tpl->Set(ZAHLUNG_RECHNUNG_SOFORT_DE, $data[0][zahlung_rechnung_sofort_de]);
      $this->app->Tpl->Set(ZAHLUNG_RECHNUNG_DE, $data[0][zahlung_rechnung_de]);

      $fields = $this->app->erp->GetFirmaFields();
      foreach($fields as $key)
      {
        $this->app->Tpl->Set(strtoupper($key), $data[0][$key]);
      }


      $fields_checkbox = $this->app->erp->GetFirmaFieldsCheckbox();
      foreach($fields_checkbox as $key)
      {
        $this->app->Tpl->Set(strtoupper($key), $this->parseCheckbox($data[0][$key]));
      }

      $this->app->Tpl->Set(VERSANDART, $this->app->erp->GetSelectAsso($this->app->erp->GetVersandartAuftrag(),$data[0][versandart]));    
      $this->app->Tpl->Set(ZAHLUNGSWEISE, $this->app->erp->GetSelectAsso($this->app->erp->GetZahlungsweise(),$data[0][zahlungsweise]));    


      $this->app->Tpl->Set(ZAHLUNG_VORKASSE_DE, $data[0][zahlung_vorkasse_de]);
      $this->app->Tpl->Set(ZAHLUNG_NACHNAHME_DE, $data[0][zahlung_nachnahme_de]);
      $this->app->Tpl->Set(ZAHLUNG_BAR_DE, $data[0][zahlung_bar_de]);
      $this->app->Tpl->Set(ZAHLUNG_PAYPAL_DE, $data[0][zahlung_paypal_de]);
      $this->app->Tpl->Set(ZAHLUNG_LASTSCHRIFT_DE, $data[0][zahlung_lastschrift_de]);
      $this->app->Tpl->Set(ZAHLUNG_KREDITKARTE_DE, $data[0][zahlung_kreditkarte_de]);
      $this->app->Tpl->Set(ZAHLUNG_AMAZON_DE, $data[0][zahlung_amazon_de]);
      $this->app->Tpl->Set(ZAHLUNG_RATENZAHLUNG_DE, $data[0][zahlung_ratenzahlung_de]);

      $this->app->Tpl->Set(ZAHLUNGSZIELTAGE, $data[0][zahlungszieltage]);
      $this->app->Tpl->Set(ZAHLUNGSZIELTAGESKONTO, $data[0][zahlungszieltageskonto]);
      $this->app->Tpl->Set(ZAHLUNGSZIELSKONTO, $data[0][zahlungszielskonto]);


      $this->app->Tpl->Set(WARENEINGANG_KAMERA_WAAGE, $this->parseCheckbox($data[0][wareneingang_kamera_waage]));
      $this->app->Tpl->Set(LAYOUT_ICONBAR, $this->parseCheckbox($data[0][layout_iconbar]));

      $this->app->Tpl->Set(NEXT_ANGEBOT , $data[0][next_angebot]);
      $this->app->Tpl->Set(NEXT_AUFTRAG , $data[0][next_auftrag]);
      $this->app->Tpl->Set(NEXT_LIEFERSCHEIN , $data[0][next_lieferschein]);
      $this->app->Tpl->Set(NEXT_RECHNUNG , $data[0][next_rechnung]);
      $this->app->Tpl->Set(NEXT_GUTSCHRIFT , $data[0][next_gutschrift]);
      $this->app->Tpl->Set(NEXT_BESTELLUNG , $data[0][next_bestellung]);
      $this->app->Tpl->Set(NEXT_ARBEITSNACHWEIS , $data[0][next_arbeitsnachweis]);
      $this->app->Tpl->Set(NEXT_KUNDENNUMMER , $data[0][next_kundennummer]);
      $this->app->Tpl->Set(NEXT_LIEFERANTENNUMMER , $data[0][next_lieferantennummer]);
      $this->app->Tpl->Set(NEXT_MITARBEITERNUMMER , $data[0][next_mitarbeiternummer]);
      $this->app->Tpl->Set(NEXT_ARTIKELNUMMER , $data[0][next_artikelnummer]);
      $this->app->Tpl->Set(NEXT_WAREN , $data[0][next_waren]);
      $this->app->Tpl->Set(NEXT_SONSTIGES , $data[0][next_sonstiges]);
      $this->app->Tpl->Set(NEXT_PRODUKTION , $data[0][next_produktion]);
      $this->app->Tpl->Set(NEXT_REISEKOSTEN, $data[0][next_reisekosten]);
      $this->app->Tpl->Set(NEXT_ANFRAGE , $data[0][next_anfrage]);

      //Briefpapier Hintergrund
      if($data[0][hintergrund]=="logo")
      {
        $this->app->Tpl->Set(HINTERGRUNDLOGO, "checked");
        $this->app->Tpl->Set(HINTERGRUNDTEXT, "Logo (<a href=\"index.php?module=firmendaten&action=logo\">ansehen</a>)");
      }else if($data[0][hintergrund]=="briefpapier")
      {
        $this->app->Tpl->Set(HINTERGRUNDBRIEFPAPIER, "checked");
        $this->app->Tpl->Set(HINTERGRUNDTEXT, "PDF (<a href=\"index.php?module=firmendaten&action=briefpapier\">ansehen</a>)");
      }else {
        $this->app->Tpl->Set(HINTERGRUNDKEIN, "checked");
        $this->app->Tpl->Set(HINTERGRUNDTEXT, "Kein");
      }

      //Versand E-Mail
      $this->app->Tpl->Set(BENUTZERNAME , $data[0][benutzername]);
      $this->app->Tpl->Set(PASSWORT , $data[0][passwort]);
      $this->app->Tpl->Set(HOST , $data[0][host]);
      $this->app->Tpl->Set(PORT , $data[0][port]);
      if($data[0][mailssl]=="2")
        $this->app->Tpl->Set(SSL , "selected");
      else if($data[0][mailssl]=="1")
        $this->app->Tpl->Set(TLS , "selected");

      // Signatur
      $this->app->Tpl->Set(SIGNATUR , base64_decode($data[0][signatur]));
      $this->app->Tpl->Set(EMAIL , $data[0][email]);
      $this->app->Tpl->Set(ABSENDERNAME , $data[0][absendername]);
      $this->app->Tpl->Set(BCC1 , $data[0][bcc1]);
      $this->app->Tpl->Set(BCC2 , $data[0][bcc2]);
      $this->app->Tpl->Set(FIRMENFARBE , $data[0][firmenfarbe]);
      $this->app->Tpl->Set(NAME , $data[0][name]);
      $this->app->Tpl->Set(STRASSE , $data[0][strasse]);
      $this->app->Tpl->Set(PLZ , $data[0][plz]);
      $this->app->Tpl->Set(ORT , $data[0][ort]);
      $this->app->Tpl->Set(STEUERNUMMER , $data[0][steuernummer]);

      $data[0][projekt] = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='{$data[0][projekt]}' LIMIT 1");
      $this->app->Tpl->Set(PROJEKT , $data[0][projekt]);

      $this->app->Tpl->Set(STANDARDVERSANDDRUCKER , $this->app->erp->GetSelectDrucker($data[0][standardversanddrucker]));
      $this->app->Tpl->Set(STANDARDETIKETTENDRUCKER , $this->app->erp->GetSelectEtikettenDrucker($data[0][standardetikettendrucker]));
      $this->app->Tpl->Set(ETIKETTENDRUCKERWARENEINGANG , $this->app->erp->GetSelectEtikettenDrucker($data[0][etikettendrucker_wareneingang ]));

      if($this->app->Conf->WFcloud==true)
      {
        $this->app->Tpl->Set(LIZENZ,"Cloud Lizenz");
        $this->app->Tpl->Set(SCHLUESSEL,"Cloud Schluessel");
      }
    }
  }


  function fillForm($data)
  {
    //Brief Absender
    $this->app->Tpl->Set(ABSENDER , $data[absender]);    
    $this->app->Tpl->Set(SICHTBAR , $this->parseCheckbox($data[sichtbar]));
    $this->app->Tpl->Set(RECHNUNG_GUTSCHRIFT_ANSPRECHPARTNER , $this->parseCheckbox($data[rechnung_gutschrift_ansprechpartner]));
    $this->app->Tpl->Set(KNICKFALZ , $this->parseCheckbox($data[knickfalz]));
    $this->app->Tpl->Set(STANDARDAUFLOESUNG , $this->parseCheckbox($data[standardaufloesung]));
    $this->app->Tpl->Set(FIRMENLOGOAKTIV , $this->parseCheckbox($data[firmenlogoaktiv]));
    $this->app->Tpl->Set(ARTIKELSUCHEKURZTEXT , $this->parseCheckbox($data[artikel_suche_kurztext]));
    $this->app->Tpl->Set(ADRESSE_FREITEXT1_SUCHE , $this->parseCheckbox($data[adresse_freitext1_suche]));
    $this->app->Tpl->Set(PARAMETERUNDFREIFELDER , $this->parseCheckbox($data[parameterundfreifelder]));
    $this->app->Tpl->Set(FREIFELD1 , $data[freifeld1]);    
    $this->app->Tpl->Set(FREIFELD2 , $data[freifeld2]);    
    $this->app->Tpl->Set(FREIFELD3 , $data[freifeld3]);    
    $this->app->Tpl->Set(FREIFELD4 , $data[freifeld4]);    
    $this->app->Tpl->Set(FREIFELD5 , $data[freifeld5]);    
    $this->app->Tpl->Set(FREIFELD6 , $data[freifeld6]);    
    $this->app->Tpl->Set(STANDARD_DATENSAETZE_DATATABLES , $data[standard_datensaetze_datatables]);    
    $this->app->Tpl->Set(STEUERSATZNORMAL , $data[steuersatz_normal]);    
    $this->app->Tpl->Set(STEUERSATZERMAESSIGT , $data[steuersatz_ermaessigt]);    
    $this->app->Tpl->Set(WAEHRUNG , $data[waehrung]);    
    $this->app->Tpl->Set(LIZENZ , $data[lizenz]);    
    $this->app->Tpl->Set(SCHLUESSEL , $data[schluessel]);    
    $this->app->Tpl->Set(BRANCH , $data[branch]);    
    $this->app->Tpl->Set(VERSION , $data[version]);    

    if($data[api_initkey]!="" && $data[api_remotedomain]!="")
      $this->app->Tpl->Set(APITEMPKEY,$this->app->erp->generateHash($data[api_remotedomain],$data[api_initkey]));

    $this->app->Tpl->Set(APIINITKEY , $data[api_initkey]);    
    $this->app->Tpl->Set(APIREMOTEDOMAIN , $data[api_remotedomain]);    
    $this->app->Tpl->Set(APIEVENTURL , $data[api_eventurl]);    
    $this->app->Tpl->Set(APIENABLE , $this->parseCheckbox($data[api_enable]));
    $this->app->Tpl->Set(API_IMPORTWARTESCHLANGE , $this->parseCheckbox($data[api_importwarteschlange]));
    $this->app->Tpl->Set(API_IMPORTWARTESCHLANGE_NAME , $data[api_importwarteschlange_name]);
    $this->app->Tpl->Set(WARNUNG_DOPPELTE_NUMMERN , $this->parseCheckbox($data[warnung_doppelte_nummern]));
    $this->app->Tpl->Set(WARENEINGANG_ZWISCHENLAGER , $this->parseCheckbox($data[wareneingang_zwischenlager]));

    $this->app->Tpl->Set(BOXAUSRICHTUNG , $data[boxausrichtung]);    
    $this->app->Tpl->Set(FOOTERBREITE1 , $data[footer_breite1]);    
    $this->app->Tpl->Set(FOOTERBREITE2 , $data[footer_breite2]);    
    $this->app->Tpl->Set(FOOTERBREITE3 , $data[footer_breite3]);    
    $this->app->Tpl->Set(FOOTERBREITE4 , $data[footer_breite4]);    


    //Formatierung
    $this->app->Tpl->Set(BARCODE , $this->parseCheckbox($data[barcode]));    
    $this->app->Tpl->Set(SCHRIFTGROESSE , ($data[schriftgroesse]));    
    $this->app->Tpl->Set(BETREFFSZEILE , ($data[betreffszeile]));    
    $this->app->Tpl->Set(DOKUMENTENTEXT , ($data[dokumententext]));    
    $this->app->Tpl->Set(TABELLENBESCHRIFTUNG , ($data[tabellenbeschriftung]));    
    $this->app->Tpl->Set(TABELLENINHALT , ($data[tabelleninhalt]));    
    $this->app->Tpl->Set(ZEILENUNTERTEXT , ($data[zeilenuntertext]));    
    $this->app->Tpl->Set(FREITEXT , ($data[freitext]));    
    $this->app->Tpl->Set(BRIFTEXT , ($data[brieftext]));    
    $this->app->Tpl->Set(INFOBOX , ($data[infobox]));    
    $this->app->Tpl->Set(SPALTENBREITE , ($data[spaltenbreite]));    

    $this->app->Tpl->Set(ABSTANDADRESSZEILEOBEN , ($data[abstand_adresszeileoben]));    
    $this->app->Tpl->Set(ABSTANDBOXRECHTSOBEN , ($data[abstand_boxrechtsoben]));    
    $this->app->Tpl->Set(ABSTANDBOXRECHTSOBENLR , ($data[abstand_boxrechtsoben_lr]));    
    $this->app->Tpl->Set(ABSTANDBETREFFZEILEOBEN , ($data[abstand_betreffzeileoben]));    
    $this->app->Tpl->Set(ABSTANDARTIKELTABELLEOBEN , ($data[abstand_artikeltabelleoben]));    
    $this->app->Tpl->Set(ABSTANDNAMEBESCHREIBUNG , ($data[abstand_name_beschreibung]));    
    $this->app->Tpl->Set(ARTIKELEINHEIT_STANDARD , ($data[artikeleinheit_standard]));    
    $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_BEARBEITER, ($data[auftrag_bezeichnung_bearbeiter]));    
    $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_VERTRIEB, ($data[auftrag_bezeichnung_vertrieb]));    
    $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_BESTELLNUMMER, ($data[auftrag_bezeichnung_bestellnummer]));    
    $this->app->Tpl->Set(BEZEICHNUNGKUNDENNUMMER, ($data[bezeichnungkundennummer]));    




    //Footer
    for($x=0; $x < 4; $x++)
      for($y=0; $y < 6; $y++)
        $this->app->Tpl->Set("FOOTER$x$y" ,$data[footer][$x][$y]);

    $this->app->Tpl->Set(FOOTERSICHTBAR , $this->parseCheckbox($data[footersichtbar]));    
    $this->app->Tpl->Set(STANDARDAUFLOESUNG , $this->parseCheckbox($data[standardaufloesung]));    
    $this->app->Tpl->Set(BRIEFPAPIER2VORHANDEN , $this->parseCheckbox($data[briefpapier2vorhanden]));    
    $this->app->Tpl->Set(SEITEVONSICHTBAR , $this->parseCheckbox($data[seite_von_sichtbar]));    
    $this->app->Tpl->Set(SEITEVONAUSRICHTUNG , $data[seite_von_ausrichtung]);    
    $this->app->Tpl->Set(ANGEBOT_OHNEBRIEFPAPIER , $this->parseCheckbox($data[angebot_ohnebriefpapier]));
    $this->app->Tpl->Set(AUFTRAG_OHNEBRIEFPAPIER , $this->parseCheckbox($data[auftrag_ohnebriefpapier]));
    $this->app->Tpl->Set(RECHNUNG_OHNEBRIEFPAPIER , $this->parseCheckbox($data[rechnung_ohnebriefpapier]));
    $this->app->Tpl->Set(LIEFERSCHEIN_OHNEBRIEFPAPIER , $this->parseCheckbox($data[lieferschein_ohnebriefpapier]));
    $this->app->Tpl->Set(GUTSCHRIFT_OHNEBRIEFPAPIER , $this->parseCheckbox($data[gutschrift_ohnebriefpapier]));
    $this->app->Tpl->Set(BESTELLUNG_OHNEBRIEFPAPIER , $this->parseCheckbox($data[bestellung_ohnebriefpapier]));
    $this->app->Tpl->Set(ARBEITSNACHWEIS_OHNEBRIEFPAPIER , $this->parseCheckbox($data[arbeitsnachweis_ohnebriefpapier]));
    $this->app->Tpl->Set(EXTERNEREINKAUF , $this->parseCheckbox($data[externereinkauf]));
    $this->app->Tpl->Set(MODUL_VERBAND , $this->parseCheckbox($data[modul_verband]));
    $this->app->Tpl->Set(MODUL_MLM , $this->parseCheckbox($data[modul_mlm]));
    $this->app->Tpl->Set(MODUL_MHD , $this->parseCheckbox($data[modul_mhd]));

    $this->app->Tpl->Set(PROJEKTNUMMERIMDOKUMENT , $this->parseCheckbox($data[projektnummerimdokument]));
    $this->app->Tpl->Set(MAILANSTELLESMTP , $this->parseCheckbox($data[mailanstellesmtp]));
    $this->app->Tpl->Set(HERSTELLERNUMMERIMDOKUMENT , $this->parseCheckbox($data[herstellernummerimdokument]));
    $this->app->Tpl->Set(ARTIKELEINHEIT , $this->parseCheckbox($data[artikeleinheit]));
    $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_BEARBEITER , $data[auftrag_bezeichnung_bearbeiter]);
    $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_VERTRIEB , $data[auftrag_bezeichnung_vertrieb]);
    $this->app->Tpl->Set(AUFTRAG_BEZEICHNUNG_BESTELLNUMMER , $data[auftrag_bezeichnung_bestellnummer]);
    $this->app->Tpl->Set(BEZEICHNUNGNUMMER , $data[bezeichnungkundennummer]);
    $this->app->Tpl->Set(STANDARDMARGE , $data[standardmarge]);
    $this->app->Tpl->Set(STANDARDVERSANDDRUCKER , $this->app->erp->GetSelectDrucker($data[0][standardversanddrucker]));
    $this->app->Tpl->Set(STANDARDETIKETTENDRUCKER , $this->app->erp->GetSelectEtikettenDrucker($data[0][standardetikettendrucker]));
    $this->app->Tpl->Set(ETIKETTENDRUCKERWARENEINGANG , $this->app->erp->GetSelectEtikettenDrucker($data[0][etikettendrucker_wareneingang]));



    $this->app->Tpl->Set(SCHRIFTART , $data[schriftart]);


    $this->app->Tpl->Set(FIRMENFARBEHELL,$data[firmenfarbehell]);
    $this->app->Tpl->Set(FIRMENFARBEDUNKEL,$data[firmenfarbedunkel]);
    $this->app->Tpl->Set(FIRMENFARBEGANZDUNKEL,$data[firmenfarbeganzdunkel]);
    $this->app->Tpl->Set(NAVIGATIONFARBE,$data[navigationfarbe]);
    $this->app->Tpl->Set(NAVIGATIONFARBESCHRIFT,$data[navigationfarbeschrift]);
    $this->app->Tpl->Set(UNTERNAVIGATIONFARBE,$data[unternavigationfarbe]);
    $this->app->Tpl->Set(UNTERNAVIGATIONFARBESCHRIFT,$data[unternavigationfarbeschrift]);

    $this->app->Tpl->Set(ZAHLUNG_RECHNUNG , $this->parseCheckbox($data[zahlung_rechnung]));
    $this->app->Tpl->Set(ZAHLUNG_VORKASSE , $this->parseCheckbox($data[zahlung_vorkasse]));
    $this->app->Tpl->Set(ZAHLUNG_NACHNAHME , $this->parseCheckbox($data[zahlung_nachnahme]));
    $this->app->Tpl->Set(ZAHLUNG_LASTSCHRIFT , $this->parseCheckbox($data[zahlung_lastschrift]));
    $this->app->Tpl->Set(ZAHLUNG_BAR , $this->parseCheckbox($data[zahlung_bar]));
    $this->app->Tpl->Set(ZAHLUNG_KREDITKARTE , $this->parseCheckbox($data[zahlung_kreditkarte]));
    $this->app->Tpl->Set(ZAHLUNG_PAYPAL , $this->parseCheckbox($data[zahlung_paypal]));
    $this->app->Tpl->Set(ZAHLUNG_AMAZON , $this->parseCheckbox($data[zahlung_amazon]));
    $this->app->Tpl->Set(ZAHLUNG_RATENZAHLUNG , $this->parseCheckbox($data[zahlung_ratenzahlung]));
    $this->app->Tpl->Set(KLEINUNTERNEHMER , $this->parseCheckbox($data[kleinunternehmer]));
    $this->app->Tpl->Set(SCHNELLANLEGEN , $this->parseCheckbox($data[schnellanlegen]));
    $this->app->Tpl->Set(BESTELLVORSCHLAGSGROESSERNULL , $this->parseCheckbox($data[bestellvorschlaggroessernull]));
    $this->app->Tpl->Set(IMMERNETTORECHNUNGEN , $this->parseCheckbox($data[immernettorechnungen]));

    $this->app->Tpl->Set(ZAHLUNG_RECHNUNG_SOFORT_DE, $data[zahlung_rechnung_sofort_de]);
    $this->app->Tpl->Set(ZAHLUNG_RECHNUNG_DE, $data[zahlung_rechnung_de]);

    $fields = $this->app->erp->GetFirmaFields();
    foreach($fields as $key)
    {
      $this->app->Tpl->Set(strtoupper($key), $data[$key]);
    }


    $fields_checkbox = $this->app->erp->GetFirmaFieldsCheckbox();
    foreach($fields_checkbox as $key)
    {
      $this->app->Tpl->Set(strtoupper($key), $this->parseCheckbox($data[$key]));
    }


    $this->app->Tpl->Set(ZAHLUNG_VORKASSE_DE, $data[zahlung_vorkasse_de]);
    $this->app->Tpl->Set(ZAHLUNG_NACHNAHME_DE, $data[zahlung_nachnahme_de]);
    $this->app->Tpl->Set(ZAHLUNG_LASTSCHRIFT_DE, $data[zahlung_lastschrift_de]);
    $this->app->Tpl->Set(ZAHLUNG_AMAZON_DE, $data[zahlung_amazon_de]);
    $this->app->Tpl->Set(ZAHLUNG_BAR_DE, $data[zahlung_bar_de]);
    $this->app->Tpl->Set(ZAHLUNG_PAYPAL_DE, $data[zahlung_paypal_de]);
    $this->app->Tpl->Set(ZAHLUNG_KREDITKARTE_DE, $data[zahlung_kreditkarte_de]);
    $this->app->Tpl->Set(ZAHLUNG_RATENZAHLUNG_DE, $data[zahlung_ratenzahlung_de]);

    $this->app->Tpl->Set(ZAHLUNGSZIELTAGE, $data[zahlungszieltage]);
    $this->app->Tpl->Set(ZAHLUNGSZIELTAGESKONTO, $data[zahlungszieltageskonto]);
    $this->app->Tpl->Set(ZAHLUNGSZIELSKONTO, $data[zahlungszielskonto]);

    $this->app->Tpl->Set(VERSANDART, $this->app->erp->GetSelectAsso($this->app->erp->GetVersandartAuftrag(),$data[versandart]));    
    $this->app->Tpl->Set(ZAHLUNGSWEISE, $this->app->erp->GetSelectAsso($this->app->erp->GetZahlungsweise(),$data[zahlungsweise]));    



    $this->app->Tpl->Set(RECHNUNG_HEADER , $data[rechnung_header]);
    $this->app->Tpl->Set(LIEFERSCHEIN_HEADER , $data[lieferschein_header]);
    $this->app->Tpl->Set(GUTSCHRIFT_HEADER , $data[gutschrift_header]);
    $this->app->Tpl->Set(ANGEBOT_HEADER , $data[angebot_header]);
    $this->app->Tpl->Set(AUFTRAG_HEADER , $data[auftrag_header]);
    $this->app->Tpl->Set(BESTELLUNG_HEADER , $data[bestellung_header]);
    $this->app->Tpl->Set(ARBEITSNACHWEIS_HEADER , $data[arbeitsnachweis_header]);
    $this->app->Tpl->Set(PROVISIONSGUTSCHRIFT_HEADER , $data[provisionsgutschrift_header]);

    $this->app->Tpl->Set(RECHNUNG_FOOTER , $data[rechnung_footer]);
    $this->app->Tpl->Set(LIEFERSCHEIN_FOOTER , $data[lieferschein_footer]);
    $this->app->Tpl->Set(GUTSCHRIFT_FOOTER , $data[gutschrift_footer]);
    $this->app->Tpl->Set(ANGEBOT_FOOTER , $data[angebot_footer]);
    $this->app->Tpl->Set(AUFTRAG_FOOTER , $data[auftrag_footer]);
    $this->app->Tpl->Set(BESTELLUNG_FOOTER , $data[bestellung_footer]);
    $this->app->Tpl->Set(ARBEITSNACHWEIS_FOOTER , $data[arbeitsnachweis_footer]);
    $this->app->Tpl->Set(PROVISIONSGUTSCHRIFT_FOOTER , $data[provisionsgutschrift_footer]);
    $this->app->Tpl->Set(EU_LIEFERUNG_VERMERK , $data[eu_lieferung_vermerk]);
    $this->app->Tpl->Set(EXPORT_LIEFERUNG_VERMERK , $data[export_lieferung_vermerk]);

    $this->app->Tpl->Set(WARENEINGANG_KAMERA_WAAGE , $this->parseCheckbox($data[wareneingang_kamera_waage]));    
    $this->app->Tpl->Set(LAYOUT_ICONBAR , $this->parseCheckbox($data[layout_iconbar]));    

    $this->app->Tpl->Set(NEXT_ANGEBOT , ($data[next_angebot]));    
    $this->app->Tpl->Set(NEXT_AUFTRAG , ($data[next_auftrag]));    
    $this->app->Tpl->Set(NEXT_RECHNUNG , ($data[next_rechnung]));    
    $this->app->Tpl->Set(NEXT_LIEFERSCHEIN , ($data[next_lieferschein]));    
    $this->app->Tpl->Set(NEXT_BESTELLUNG , ($data[next_bestellung]));    
    $this->app->Tpl->Set(NEXT_ARBEITSNACHWEIS , ($data[next_arbeitsnachweis]));    
    $this->app->Tpl->Set(NEXT_GUTSCHRIFT , ($data[next_gutschrift]));    
    $this->app->Tpl->Set(NEXT_KUNDENNUMMER , ($data[next_kundennummer]));    
    $this->app->Tpl->Set(NEXT_LIEFERANTENNUMMER , ($data[next_lieferantennummer]));    
    $this->app->Tpl->Set(NEXT_MITARBEITERNUMMER , ($data[next_mitarbeiternummer]));    
    $this->app->Tpl->Set(NEXT_ARTIKELNUMMER , ($data[next_artikelnummer]));    
    $this->app->Tpl->Set(NEXT_WAREN , ($data[next_waren]));    
    $this->app->Tpl->Set(NEXT_SONSTIGES , ($data[next_sonstiges]));    
    $this->app->Tpl->Set(NEXT_PRODUKTION , ($data[next_produktion]));    
    $this->app->Tpl->Set(NEXT_REISEKOSTEN , ($data[next_reisekosten]));    
    $this->app->Tpl->Set(NEXT_ANFRAGE , ($data[next_anfrage]));    

    //Briefpapier Hintergrund
    if($data[hintergrund]=="logo")
    {
      $this->app->Tpl->Set(HINTERGRUNDLOGO, "checked");
      $this->app->Tpl->Set(HINTERGRUNDTEXT, "Logo");
    }else if($data[hintergrund]=="briefpapier")
    {
      $this->app->Tpl->Set(HINTERGRUNDBRIEFPAPIER, "checked");
      $this->app->Tpl->Set(HINTERGRUNDTEXT, "Briefpapier");
    }else
      $this->app->Tpl->Set(HINTERGRUNDKEIN, "checked");


    //Versand E-Mail
    $this->app->Tpl->Set(BENUTZERNAME , $data[benutzername]);    
    $this->app->Tpl->Set(PASSWORT , $data[passwort]);    
    $this->app->Tpl->Set(HOST , $data[host]);    
    $this->app->Tpl->Set(PORT , $data[port]);    
    if($data[mailssl]=="2")
      $this->app->Tpl->Set(SSL ,"selected");
    else if($data[mailssl]=="1")
      $this->app->Tpl->Set(TLS ,"selected");


    // Signatur
    $this->app->Tpl->Set(SIGNATUR , base64_decode($data[signatur]));    
    $this->app->Tpl->Set(EMAIL , $data[email]);    
    $this->app->Tpl->Set(ABSENDERNAME , $data[absendername]);    
    $this->app->Tpl->Set(BCC1 , $data[bcc1]);    
    $this->app->Tpl->Set(BCC2 , $data[bcc2]);    
    $this->app->Tpl->Set(FIRMENFARBE , $data[firmenfarbe]);    
    $this->app->Tpl->Set(NAME , $data[name]);    
    $this->app->Tpl->Set(STRASSE , $data[strasse]);    
    $this->app->Tpl->Set(PLZ , $data[plz]);    
    $this->app->Tpl->Set(ORT , $data[ort]);    
    $this->app->Tpl->Set(STEUERNUMMER , $data[steuernummer]);    


  }



  function getPostData()
  {
    $data = array();


    // Brief Absender
    $data[absender] = $this->app->Secure->GetPOST("absender");
    $data[sichtbar] = $this->parseCheckbox($this->app->Secure->GetPOST("sichtbar"));
    $data[rechnung_gutschrift_ansprechpartner] = $this->parseCheckbox($this->app->Secure->GetPOST("rechnung_gutschrift_ansprechpartner"));
    $data[artikel_suche_kurztext] = $this->parseCheckbox($this->app->Secure->GetPOST("artikel_suche_kurztext"));
    $data[adresse_freitext1_suche] = $this->parseCheckbox($this->app->Secure->GetPOST("adresse_freitext1_suche"));
    $data[parameterundfreifelder] = $this->parseCheckbox($this->app->Secure->GetPOST("parameterundfreifelder"));
    $data[freifeld1] = $this->app->Secure->GetPOST("freifeld1");
    $data[freifeld2] = $this->app->Secure->GetPOST("freifeld2");
    $data[freifeld3] = $this->app->Secure->GetPOST("freifeld3");
    $data[freifeld4] = $this->app->Secure->GetPOST("freifeld4");
    $data[freifeld5] = $this->app->Secure->GetPOST("freifeld5");
    $data[freifeld6] = $this->app->Secure->GetPOST("freifeld6");
    $data[standard_datensaetze_datatables] = $this->app->Secure->GetPOST("standard_datensaetze_datatables");
    $data[steuersatz_normal] = $this->app->Secure->GetPOST("steuersatz_normal");
    $data[steuersatz_ermaessigt] = $this->app->Secure->GetPOST("steuersatz_ermaessigt");
    $data[waehrung] = $this->app->Secure->GetPOST("waehrung");
    $data[lizenz] = $this->app->Secure->GetPOST("lizenz");
    $data[schluessel] = $this->app->Secure->GetPOST("schluessel");
    $data[branch] = $this->app->Secure->GetPOST("branch");

    $data[boxausrichtung] = $this->app->Secure->GetPOST("boxausrichtung");
    $data[footer_breite1] = $this->app->Secure->GetPOST("footer_breite1");
    $data[footer_breite2] = $this->app->Secure->GetPOST("footer_breite2");
    $data[footer_breite3] = $this->app->Secure->GetPOST("footer_breite3");
    $data[footer_breite4] = $this->app->Secure->GetPOST("footer_breite4");


    // Formatierung
    $data[barcode] = $this->parseCheckbox($this->app->Secure->GetPOST("barcode"));
    $data[schriftgroesse] = ($this->app->Secure->GetPOST("schriftgroesse"));
    $data[betreffszeile] = ($this->app->Secure->GetPOST("betreffszeile"));
    $data[dokumententext] = ($this->app->Secure->GetPOST("dokumententext"));
    $data[tabellenbeschriftung] = ($this->app->Secure->GetPOST("tabellenbeschriftung"));
    $data[tabelleninhalt] = ($this->app->Secure->GetPOST("tabelleninhalt"));
    $data[zeilenuntertext] = ($this->app->Secure->GetPOST("zeilenuntertext"));
    $data[freitext] = ($this->app->Secure->GetPOST("freitext"));
    $data[brieftext] = ($this->app->Secure->GetPOST("brieftext"));
    $data[infobox] = ($this->app->Secure->GetPOST("infobox"));
    $data[spaltenbreite] = ($this->app->Secure->GetPOST("spaltenbreite"));

    $data[abstand_adresszeileoben] = $this->app->Secure->GetPOST("abstand_adresszeileoben");
    $data[abstand_boxrechtsoben] = $this->app->Secure->GetPOST("abstand_boxrechtsoben");
    $data[abstand_boxrechtsoben_lr] = $this->app->Secure->GetPOST("abstand_boxrechtsoben_lr");
    $data[abstand_betreffzeileoben] = $this->app->Secure->GetPOST("abstand_betreffzeileoben");
    $data[abstand_artikeltabelleoben] = $this->app->Secure->GetPOST("abstand_artikeltabelleoben");
    $data[abstand_name_beschreibung] = $this->app->Secure->GetPOST("abstand_name_beschreibung");
    $data[artikeleinheit_standard] = $this->app->Secure->GetPOST("artikeleinheit_standard");
    $data[auftrag_bezeichnung_bearbeiter] = $this->app->Secure->GetPOST("auftrag_bezeichnung_bearbeiter");
    $data[auftrag_bezeichnung_vertrieb] = $this->app->Secure->GetPOST("auftrag_bezeichnung_vertrieb");
    $data[auftrag_bezeichnung_bestellnummer] = $this->app->Secure->GetPOST("auftrag_bezeichnung_bestellnummer");
    $data[bezeichnungkundennummer] = $this->app->Secure->GetPOST("bezeichnungkundennummer");


    // Footer
    $data[footer] = $this->app->Secure->GetPOST("footer");
    $data[footersichtbar] = $this->parseCheckbox($this->app->Secure->GetPOST("footersichtbar"));
    $data[briefpapier2vorhanden] = $this->parseCheckbox($this->app->Secure->GetPOST("briefpapier2vorhanden"));
    $data[seite_von_sichtbar] = $this->parseCheckbox($this->app->Secure->GetPOST("seite_von_sichtbar"));
    $data[seite_von_ausrichtung] = $this->app->Secure->GetPOST("seite_von_ausrichtung");

    $data[angebot_ohnebriefpapier] = $this->parseCheckbox($this->app->Secure->GetPOST("angebot_ohnebriefpapier"));
    $data[auftrag_ohnebriefpapier] = $this->parseCheckbox($this->app->Secure->GetPOST("auftrag_ohnebriefpapier"));
    $data[rechnung_ohnebriefpapier] =  $this->parseCheckbox($this->app->Secure->GetPOST("rechnung_ohnebriefpapier"));
    $data[lieferschein_ohnebriefpapier] =  $this->parseCheckbox($this->app->Secure->GetPOST("lieferschein_ohnebriefpapier"));
    $data[gutschrift_ohnebriefpapier] = $this->parseCheckbox($this->app->Secure->GetPOST("gutschrift_ohnebriefpapier"));
    $data[bestellung_ohnebriefpapier] = $this->parseCheckbox($this->app->Secure->GetPOST("bestellung_ohnebriefpapier"));
    $data[arbeitsnachweis_ohnebriefpapier] = $this->parseCheckbox($this->app->Secure->GetPOST("arbeitsnachweis_ohnebriefpapier"));
    $data[externereinkauf] = $this->parseCheckbox($this->app->Secure->GetPOST("externereinkauf"));
    $data[modul_verband] = $this->parseCheckbox($this->app->Secure->GetPOST("modul_verband"));
    $data[modul_mlm] = $this->parseCheckbox($this->app->Secure->GetPOST("modul_mlm"));
    $data[modul_mhd] = $this->parseCheckbox($this->app->Secure->GetPOST("modul_mhd"));


    $data[projektnummerimdokument] = $this->parseCheckbox($this->app->Secure->GetPOST("projektnummerimdokument"));
    $data[mailanstellesmtp] = $this->parseCheckbox($this->app->Secure->GetPOST("mailanstellesmtp"));
    $data[herstellernummerimdokument] = $this->parseCheckbox($this->app->Secure->GetPOST("herstellernummerimdokument"));
    $data[artikeleinheit] = $this->parseCheckbox($this->app->Secure->GetPOST("artikeleinheit"));
    $data[standardmarge] = $this->app->Secure->GetPOST("standardmarge");
    $data[auftrag_bezeichnung_bearbeiter] = $this->app->Secure->GetPOST("auftrag_bezeichnung_bearbeiter");
    $data[auftrag_bezeichnung_vertrieb] = $this->app->Secure->GetPOST("auftrag_bezeichnung_vertrieb");
    $data[bezeichnungkundennummer] = $this->app->Secure->GetPOST("bezeichnungkundennummer");
    $data[auftrag_bezeichnung_bestellnummer] = $this->app->Secure->GetPOST("auftrag_bezeichnung_bestellnummer");

    $data[schriftart] = $this->app->Secure->GetPOST("schriftart");

    $fields_checkbox = $this->app->erp->GetFirmaFieldsCheckbox();
    foreach($fields_checkbox as $key=>$value)
    {
      $data[$value] = $this->parseCheckbox($this->app->Secure->GetPOST($value));
    }

    $fields = $this->app->erp->GetFirmaFields();
    foreach($fields as $key)
    {
      $data[$key] = $this->app->Secure->GetPOST($key);
    }

    $data[rechnung_header] = $this->app->Secure->GetPOST("rechnung_header");
    $data[rechnung_footer] = $this->app->Secure->GetPOST("rechnung_footer");
    $data[angebot_header] = $this->app->Secure->GetPOST("angebot_header");
    $data[angebot_footer] = $this->app->Secure->GetPOST("angebot_footer");
    $data[auftrag_header] = $this->app->Secure->GetPOST("auftrag_header");
    $data[auftrag_footer] = $this->app->Secure->GetPOST("auftrag_footer");
    $data[lieferschein_header] = $this->app->Secure->GetPOST("lieferschein_header");
    $data[lieferschein_footer] = $this->app->Secure->GetPOST("lieferschein_footer");
    $data[bestellung_header] = $this->app->Secure->GetPOST("bestellung_header");
    $data[arbeitsnachweis_header] = $this->app->Secure->GetPOST("arbeitsnachweis_header");
    $data[bestellung_footer] = $this->app->Secure->GetPOST("bestellung_footer");
    $data[arbeitsnachweis_footer] = $this->app->Secure->GetPOST("arbeitsnachweis_footer");
    $data[gutschrift_header] = $this->app->Secure->GetPOST("gutschrift_header");
    $data[gutschrift_footer] = $this->app->Secure->GetPOST("gutschrift_footer");
    $data[provisionsgutschrift_header] = $this->app->Secure->GetPOST("provisionsgutschrift_header");
    $data[provisionsgutschrift_footer] = $this->app->Secure->GetPOST("provisionsgutschrift_footer");
    $data[eu_lieferung_vermerk] = $this->app->Secure->GetPOST("eu_lieferung_vermerk");
    $data[export_lieferung_vermerk] = $this->app->Secure->GetPOST("export_lieferung_vermerk");


    // Briefpapier Hintergrund
    $data[logo] = $this->app->Secure->GetPOST("logo");
    $data[briefpapier] = $this->app->Secure->GetPOST("briefpapier");
    $data[hintergrund] = $this->app->Secure->GetPOST("hintergrund");

    // Versand E-Mail
    $data[benutzername] = $this->app->Secure->GetPOST("benutzername");
    $data[passwort] = $this->app->Secure->GetPOST("passwort");
    $data[host] = $this->app->Secure->GetPOST("host");
    $data[port] = $this->app->Secure->GetPOST("port");

    $data[mailssl] = $this->app->Secure->GetPOST("mailssl");

    // Signatur
    $data[signatur] = base64_encode($this->app->Secure->POST["signatur"]);
    $data[email] = ($this->app->Secure->POST["email"]);
    $data[absendername] = ($this->app->Secure->POST["absendername"]);
    $data[bcc1] = ($this->app->Secure->POST["bcc1"]);
    $data[bcc2] = ($this->app->Secure->POST["bcc2"]);
    $data[name] = ($this->app->Secure->POST["name"]);
    $data[firmenfarbe] = ($this->app->Secure->POST["firmenfarbe"]);
    $data[strasse] = ($this->app->Secure->POST["strasse"]);
    $data[plz] = ($this->app->Secure->POST["plz"]);
    $data[ort] = ($this->app->Secure->POST["ort"]);
    $data[steuernummer] = ($this->app->Secure->POST["steuernummer"]);
    $data[projekt] = ($this->app->Secure->POST["projekt"]);

    $data[standardversanddrucker] = ($this->app->Secure->POST["standardversanddrucker"]);
    $data[standardetikettendrucker] = ($this->app->Secure->POST["standardetikettendrucker"]);
    $data[etikettendrucker_wareneingang] = ($this->app->Secure->POST["etikettendrucker_wareneingang"]);

    $data[wareneingang_kamera_waage] =$this->parseCheckbox ($this->app->Secure->POST["wareneingang_kamera_waage"]);
    $data[layout_iconbar] =$this->parseCheckbox ($this->app->Secure->POST["layout_iconbar"]);

    $data[next_angebot] = ($this->app->Secure->POST["next_angebot"]);
    $data[next_auftrag] = ($this->app->Secure->POST["next_auftrag"]);
    $data[next_lieferschein] = ($this->app->Secure->POST["next_lieferschein"]);
    $data[next_rechnung] = ($this->app->Secure->POST["next_rechnung"]);
    $data[next_bestellung] = ($this->app->Secure->POST["next_bestellung"]);
    $data[next_arbeitsnachweis] = ($this->app->Secure->POST["next_arbeitsnachweis"]);
    $data[next_gutschrift] = ($this->app->Secure->POST["next_gutschrift"]);
    $data[next_kundennummer] = ($this->app->Secure->POST["next_kundennummer"]);
    $data[next_lieferantennummer] = ($this->app->Secure->POST["next_lieferantennummer"]);
    $data[next_mitarbeiternummer] = ($this->app->Secure->POST["next_mitarbeiternummer"]);
    $data[next_artikelnummer] = ($this->app->Secure->POST["next_artikelnummer"]);
    $data[next_waren] = ($this->app->Secure->POST["next_waren"]);
    $data[next_sonstiges] = ($this->app->Secure->POST["next_sonstiges"]);
    $data[next_produktion] = ($this->app->Secure->POST["next_produktion"]);
    $data[next_reisekosten] = ($this->app->Secure->POST["next_reisekosten"]);
    $data[next_anfrage] = ($this->app->Secure->POST["next_anfrage"]);

    return $data;
  }

  function parseCheckBox($checkbox)
  {
    if($checkbox=='0')
      return '';

    if($checkbox=='1')
      return 'checked';

    if($checkbox=='on')
      return 1;

    if($checkbox=='')
      return 0;
  }


}

?>
