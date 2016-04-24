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

class Dateien {
  var $app;
  var $id;
  
  function Dateien($app) {
    //parent::GenDateien($app);
    $this->app=&$app;
    $this->id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Set('ID', $this->id );
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","DateienCreate");
    $this->app->ActionHandler("edit","DateienEdit");
    $this->app->ActionHandler("list","DateienList");
    $this->app->ActionHandler("archiv","DateienArchiv");
    $this->app->ActionHandler("artikel","DateienArtikel");
    $this->app->ActionHandler("send","DateienSend");
    $this->app->ActionHandler("delete","DateienDelete");
    $this->app->ActionHandler("zahlung","DateienZahlung");
    $this->app->ActionHandler("protokoll","DateienProtokoll");
    $this->app->ActionHandler("abschicken","DateienAbschicken");
    $this->app->ActionHandler("freigabe","DateienFreigabe");
    $this->app->ActionHandler("delete","DateienDelete");
    $this->app->ActionHandler("listfreigegebene","DateienListFreigegebene");
    $this->app->ActionHandler("kundeuebernehmen","DateienKundeuebernehmen");
    $this->app->ActionHandler("versand","DateienVersand");
    $this->app->ActionHandler("lieferadresseneu","DateienLieferadresseNeu");
    $this->app->ActionHandler("download","DateienDownload");
    $this->app->ActionHandler("lieferadresseauswahl","DateienLieferadresseAuswahl");

    $this->app->ActionHandlerListen($app);
  }


  function DateienHauptMenu()
  {
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Dateien");
//    $this->app->erp->MenuEintrag("index.php?module=dateien&action=create","Neue Datei anlegen");
 //   $this->app->erp->MenuEintrag("index.php?module=dateien&action=list","&Uuml;bersicht");

  }


  function DateienList()
  {
    $this->DateienHauptMenu();

    
    /* Dateiene zur Nachbesserung */ 
    $this->app->Tpl->Set('HEADING',"Dateien");

    $this->app->Tpl->Set('SUBHEADING',"Neuste Dateien");
    //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");
    $table = new EasyTable($this->app);
    $table->Query("SELECT d.titel, s.subjekt, v.version, v.ersteller, v.bemerkung, d.id FROM datei d LEFT JOIN datei_stichwoerter s ON d.id=s.datei                                                                  LEFT JOIN datei_version v ON v.datei=d.id ORDER by d.id DESC LIMIT 10");
    $table->Display('INHALT');
    $this->app->Tpl->Parse('PAGE',"rahmen.tpl");
    $this->app->Tpl->Set('INHALT',"");

/*
    $this->app->Tpl->Set(SUBHEADING,"Scans zum Zuordnen");
    //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");
    $table = new EasyTable($this->app);
    $table->Query("SELECT titel, nummer, id FROM datei");
    $table->Display(INHALT);
    $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
    $this->app->Tpl->Set(INHALT,"");
*/

  }
  
  function DateienDownload()
  {
    $typ = $this->app->Secure->GetGET('typ');
    $id = (int)$this->app->Secure->GetGET('id');
    $erlaubt = false;
    if($typ && $id)
    {
      switch($typ)
      {
        case "bestellung":
        case "angebot":
        case "lieferschein":
        case "rechnung":
        case "gutschrift":
        case "auftrag":
        case "arbeitsnachweis":
        case "brieffax": 
          if($this->app->erp->RechteVorhanden($typ,'edit'))$erlaubt = true;
        break;
        case "brieffax":
          if($this->app->erp->RechteVorhanden('adresse','brief'))$erlaubt = true;
          $typ = "dokument";
        break;
      }
      if($erlaubt)
      {
        $dateianhang = $this->app->DB->SelectArr("SELECT ds.id, ds.datei, d.titel FROM datei_stichwoerter ds INNER JOIN datei d on ds.datei = d.id where d.geloescht <> 1 AND ds.datei = '$id' AND objekt like '$typ' LIMIT 1");
        if($dateianhang)
        {
          $dateianhang = reset($dateianhang);
          $this->app->erp->SendDatei($id);
          exit;
        } else {
          echo mysqli_error($this->app->DB->connection);
        }
        
      } else {
        echo "Fehlende Rechte";
        exit;
      }
    }
    echo "Fehler";
    exit;
  }

  
  function DateienMenu()
  {
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=dateien&action=edit&id=$id\">Dateien</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=dateien&action=artikel&id=$id\">Artikel</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=dateien&action=zahlung&id=$id\">Zahlungsinformation</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=dateien&action=versand&id=$id\">Versand</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=dateien&action=abschicken&id=$id\">Abschicken</a>&nbsp;");
    //if($this->app->User->GetType()=="admin" || $this->app->User->GetType()=="sauterbe")
    //  $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=dateien&action=freigabe&id=$id\">FREIGABE</a>&nbsp;");
    //$this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=dateien&action=protokoll&id=$id\">Protokoll</a>&nbsp;");
    //$this->app->Tpl->Add('TABS',"<a href=\"index.php?module=dateien&action=kosten&id=$id\">Gesamtkalkulation</a>&nbsp;");
    $this->app->Tpl->Add('TABS',"<a class=\"tab\" href=\"index.php?module=dateien&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a>&nbsp;");
  }

  function DateienCreate()
  {
    $id = $this->id;
    $this->DateienHauptMenu();

 
    $speichern = $this->app->Secure->GetPOST("speichern");
    if($speichern !="")
    {
      $titel= $this->app->Secure->GetPOST("titel");
      $beschreibung= $this->app->Secure->GetPOST("beschreibung");
      $nummer= $this->app->Secure->GetPOST("nummer");
      $subjekt= $this->app->Secure->GetPOST("subjekt");
      $objekt= $this->app->Secure->GetPOST("objekt");

      $this->app->Tpl->Set('TITLE',$titel);
      $this->app->Tpl->Set('BESCHREIBUNG',$beschreibung);
      $this->app->Tpl->Set('NUMMER',$nummer);
      $this->app->Tpl->Set('SUBJEKT',$subjekt);
      $this->app->Tpl->Set('OBJEKT',$objekt);

      if($_FILES['upload']['tmp_name']=="")
      {
	$this->app->Tpl->Set(ERROR,"<div class=\"info\">Bitte w&auml;hlen Sie eine Datei aus und laden Sie diese herauf!</div>");

      } else {
	// nach /tmp
	//move_uploaded_file($_FILES['upload']['tmp_name'],"//".$_FILES['upload']['name'])){
	$fileid = $this->app->erp->CreateDatei($_FILES['upload']['name'],$titel,$beschreibung,$nummer,$_FILES['upload']['tmp_name'],$this->app->User->GetName());

	// stichwoerter hinzufuegen
	$this->app->erp->AddDateiStichwort($fileid,$subjekt,$objekt);
	header("Location: index.php?module=dateien&action=edit&id=$fileid");
	//loeschen von /tmp	
      }

    }    
      //$this->DateienMenu();
      $this->app->Tpl->Set('HEADING',"Datei (Neu)");
      $this->app->Tpl->Parse('PAGE',"datei_neu.tpl");


  }

  function DateienEdit()
  {
    $id = $this->app->Secure->GetGET("id");

    $this->DateienHauptMenu();
    $this->app->YUI->DateiUploadNeuVersion('NEUEVERSION',$id);


    $speichern = $this->app->Secure->GetPOST("speichern");
    if($speichern !="")
    {
      $titel= $this->app->Secure->GetPOST("titel");
      $beschreibung= $this->app->Secure->GetPOST("beschreibung");

      $this->app->DB->Update("UPDATE datei SET titel='$titel', beschreibung='$beschreibung' WHERE id='$id' LIMIT 1");
/*
      $subjekt= $this->app->Secure->GetPOST("subjekt");
      $objekt= $this->app->Secure->GetPOST("objekt");
      $bemerkung= $this->app->Secure->GetPOST("bemerkung");
     
      $ersteller = $this->app->User->GetName();

      if(isset($_FILES['upload']['tmp_name'])){
	$this->app->erp->AddDateiVersion($id,$ersteller,$_FILES['upload']['name'],$bemerkung,$_FILES['upload']['tmp_name']);
      }

      if($subjekt!="")
	$this->app->erp->AddDateiStichwort($id,$subjekt,$objekt);
*/

    }

    $titel = $this->app->DB->Select("SELECT titel FROM datei WHERE id='$id' LIMIT 1");
    $beschreibung = $this->app->DB->Select("SELECT beschreibung FROM datei WHERE id='$id' LIMIT 1");
    $nummer= $this->app->DB->Select("SELECT nummer FROM datei WHERE id='$id' LIMIT 1");


    $this->app->Tpl->Set('TITEL',$titel);
    $this->app->Tpl->Set('KURZUEBERSCHRIFT2',$titel);
    $this->app->Tpl->Set('BESCHREIBUNG',$beschreibung);
    $this->app->Tpl->Set('NUMMER',$nummer);


    $table = new EasyTable($this->app);
    $table->Query("SELECT version,dateiname,datum,ersteller,bemerkung,id FROM datei_version WHERE datei='$id'");
    $table->DisplayNew('VERSIONEN',"
      <!--<a href=\"index.php?module=adresse&action=dateiversion&id=$id&lid=%value%\">edit</a>-->
      <a href=\"#\"onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=dateien&action=delete&fid=%value%&version=true&id=$id';\" ><img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
      <a href=\"index.php?module=dateien&action=send&fid=%value%&id=$id\"><img src=\"./themes/new/images/download.png\" border=\"0\"></a>
      ",
      "<!--<a href=\"index.php?module=adresse&action=lieferadresseneu&id=$id\">Neue Version anlegen</a>-->");
  

    $table = new EasyTable($this->app);
    $table->Query("SELECT subjekt,objekt,parameter FROM datei_stichwoerter WHERE datei='$id'");
    $table->DisplayNew('STICHWORTE',"Parameter","noAction");
/*
      <a href=\"index.php?module=adresse&action=dateiversion&id=$id&lid=%value%\">edit</a>
      <a href=\"index.php?module=adresse&action=dateiversion&id=$id\">del</a>
      <a href=\"index.php?module=adresse&action=dateiversion&id=$id\">new</a>
      ",
      "");
*/
    
    //$this->DateienMenu();
    $this->app->Tpl->Set('HEADING',"Datei (Bearbeiten)");
    $this->app->Tpl->Parse('PAGE',"datei.tpl");

  }
  function DateienFreigabeCheck($id,&$msg)
  {
    $dateien = $this->app->DB->SelectArr("SELECT * FROM dateien WHERE id='$id' LIMIT 1");
    $dateien = $dateien[0];

    //komische adresse?</li>
    if(($dateien[plz] <= "01001" and $dateien[plz] >= "99998") && $dateien['land']=="DE") 
      $msg[] = "Kunde: Postleitzahl nicht g&uuml;ltig";
    if(!($dateien[lieferplz] <= "01001" and $dateien['lieferplz'] >= "99998") && $dateien[lieferland]=="DE") 
      $msg[] = "Lieferadresse: Postleitzahl nicht g&uuml;ltig";

    //alle wichtigen felder ausgefuellt?</li>
    $check = array('versandart','typ','name','land','strasse','ort','plz');
    foreach($check as $value)
    {
      if($dateien[$value]=="")
	$msg[] = "Kunde: Datenfeld: <b>".ucFirst($value)."</b> darf nicht leer sein";
    }
 
    if($dateien['abweichendelieferadresse']=="1")
    {
      $check = array('liefertyp','liefername','lieferland','lieferstrasse','lieferort','lieferplz');
      foreach($check as $value)
      {
	if($dateien[$value]=="")
	  $msg[] = "Lieferadresse: Datenfeld: <b>".ucFirst($value)."</b> darf nicht leer sein";
      }
    } 


    //zahlungsweise alle daten da?


    //nachnahme geht nur nach deutschland
    if($dateien['zahlungsweise']=="nachnahme" && $dateien['land']!="DE")
      $msg[] = "Zahlung: Nachnahme geht nur innerhalb Deutschlands";


    //rechnung geht nur nach deutschland
    if($dateien['zahlungsweise']=="rechnung" && $dateien['land']!="DE")
      $msg[] = "Zahlung: Rechnung geht nur innerhalb Deutschlands";


    /* REGELN welcher Versand/Zahlkombinationen nicht gehen */
    if($dateien['versandart']=="versandunternehmen" && $dateien['zahlungsweise']=="bar")
      $msg[] = "Versandart: <b>Versandunternehmen</b> kann nicht mit Zahlweise: <b>Bar</b> bezahlt werden";
    if($dateien['versandart']=="packstation" && $dateien['zahlungsweise']=="bar")
      $msg[] = "Versandart: <b>Packstation</b> kann nicht mit Zahlweise: <b>Bar</b> bezahlt werden";

    if($dateien['versandart']=="selbstabholer" && $dateien['zahlungsweise']=="nachnahme")
      $msg[] = "Versandart: <b>Selbstabholer</b> kann nicht mit Zahlweise: <b>Nachnahme</b> bezahlt werden";
    if($dateien['versandart']=="keinversand" && $dateien['zahlungsweise']=="nachnahme")
      $msg[] = "Versandart: <b>Kein Versand</b> kann nicht mit Zahlweise: <b>Nachnahme</b> bezahlt werden";



    //lieferadresse da wenn feld gesetzt?</li>
    
    //korrekte packstation?</li>
    if($dateien['versandart']=="packstation")
    {
      //packstation nummer
      if(!is_numeric($dateien['lieferabteilung']) && strlen($dateien['lieferabteilung'])!=3)
	  $msg[] = "Lieferadresse: Packstationsnummer muss 3-stellig sein";
      //postident nummer
      if(!is_numeric($dateien['lieferunterabteilung']) && strlen($dateien['lieferunterabteilung'])>3)
	  $msg[] = "Lieferadresse: PostIdentNummer darf nur aus Zahlen bestehen";
    }

    
    //UST-ID ok (Rechnung und Lieferschein passt zur Rechnung)</li>
    if($dateien['ustid']!="" && $dateien['land']!="DE")
    {

      //passt land zu nummer?
      if($dateien[land]!=substr($dateien['ustid'],0,2) && $dateien['land']!="GR")
	  $msg[] = "UST: Land <b>{$dateien['land']}</b> stimmt nicht mit USTID &uuml;berein <b>{$dateien['ustid']}</b>";

      if($dateien[land]=="GR" && substr($dateien['ustid'],0,2)!="EL")
	  $msg[] = "UST: Land (Griechenlandregel) <b>{$dateien['land']} stimmt nicht mit USTID &uuml;berein <b>{$dateien['ustid']}</b>";


      // ist land EU?
      //check ust format
      if($this->app->erp->CheckUSTFormat($dateien[ustid])=="0")
	  $msg[] = "UST: Umsatzsteuerformat stimmt nicht ({$dateien['ustid']})";

    }

    
    //Porto ok</li>

    //Steuerklasse? passt es drittland eu etc</li>

    //Nachnahme gebuher</li>

    //Zahlen auf Rechnung ok?</li>

    //Kreditkarte gueltig</li>

    //Projekt richtig angebene?</li>
    return count($msg);
  }

  function DateienSend()
  {
    $fid = $this->app->Secure->GetGET("fid");
    $id = $this->app->Secure->GetGET("id");

    $this->app->erp->SendDatei($id,$fid); 
    exit;
  }

  function DateienDelete()
  {
    $fid = $this->app->Secure->GetGET("fid");
    $id = $this->app->Secure->GetGET("id");
    $version = $this->app->Secure->GetGET("version");
    if($version!="")
    {
    if(is_numeric($fid))
      	$this->app->DB->Delete("DELETE FROM datei_version WHERE id='$fid' AND datei='$id' LIMIT 1");
      // TODO Datei aus dem Dateisystem entfernen
      header("Location: index.php?module=dateien&action=edit&id=$id");
    } else {
      // stichweoeter loeschen
      if(is_numeric($id)){
      $this->app->DB->Delete("DELETE FROM datei_version WHERE datei='$id'");
      $this->app->DB->Delete("DELETE FROM datei_stichwoerter WHERE datei='$id'");
      $this->app->DB->Update("UPDATE datei SET geloescht=1 WHERE id='$id'");
      }
      header("Location: ".$_SERVER['HTTP_REFERER']);
    }
    exit;
  }




  function DateienProtokoll()
  {
    $this->app->Tpl->Set('PROTOKOLL',"pro tabelle");

    $this->DateienMenu();
    $this->app->Tpl->Set('HEADING',"Dateien (Protokoll)");
    $this->app->Tpl->Parse('PAGE',"dateien_protokoll.tpl");
  }





}

?>
