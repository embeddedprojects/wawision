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
//include ("_gen/zeiterfassung.php");

class Zeiterfassung { //extends GenZeiterfassung {
  var $app;

  function Zeiterfassung($app) {    
    //parent::GenZeiterfassung($app);
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","ZeiterfassungCreate");
    $this->app->ActionHandler("edit","ZeiterfassungEdit");
    $this->app->ActionHandler("list","ZeiterfassungList");
    $this->app->ActionHandler("listuser","ZeiterfassungListUser");
    $this->app->ActionHandler("delete","ZeiterfassungDelete");
    $this->app->ActionHandler("arbeitspaket","ArbeitspaketDetails");
    $this->app->ActionHandler("details","ZeiterfassungDetails");
    $this->app->ActionHandler("minidetail","ZeiterfassungMinidetail");
    $this->app->ActionHandler("abrechnenpdf","ZeiterfassungAbrechnenpdf");
    $this->app->ActionHandler("dokuarbeitszeitpdf","ZeiterfassungDokuArbeitszeit");

    $this->app->Tpl->Parse('UEBERSCHRIFT',"Zeiterfassung");

    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }


  function ZeiterfassungMinidetail()
  {
    $id = $this->app->Secure->GetGET("id");


    $tmp = $this->app->DB->SelectArr("SELECT * FROM zeiterfassung WHERE id='$id'");
    $tmp = $tmp[0];
    $teilprojekt = $this->app->DB->Select("SELECT aufgabe FROM arbeitspaket WHERE id='".$tmp[arbeitspaket]."'");

    echo "<table width=\"710\">";
    echo "<tr><td width=\"200\"><b>Ort:</b></td><td>".$tmp[ort]."</td></tr>";
    echo "<tr><td><b>Tätigkeit:</b></td><td>".$tmp[aufgabe]."</td></tr>";
    echo "<tr valign=\"top\"><td><b>Beschreibung:</b></td><td>".nl2br($tmp[beschreibung])."</td></tr>";
    echo "<tr><td><b>Teilprojekt:</b></td><td>".$teilprojekt."</td></tr>";
    echo "<tr><td><b>Kostenstelle:</b></td><td>".$tmp[kostenstelle]."</td></tr>";
    echo "<tr><td><b>Verrechnungsart:</b></td><td>".$tmp[verrechnungsart]."</td></tr>";
    if($tmp[gps]!="") {
      $tmpgps = explode(';',$tmp[gps]);
      $link = "<a href=\" http://maps.google.com/maps?q=".$tmpgps[0].",".$tmpgps[1]."\" target=\"_blank\">Google Maps</a>";
    }
    echo "<tr><td><b>GPS Koordinaten:</b></td><td>".$tmp[gps]."&nbsp;$link</td></tr>";
    echo "</table>";

    exit;

  }

  function ZeiterfassungAbrechnenpdf()
  {
    //Create a new PDF file
    $pdf=new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',11);

    //Create lines (boxes) for each ROW (Product)
    //If you don't use the following code, you don't create the lines separating each row
    $tmp = $this->app->DB->SelectArr("SELECT a.kundennummer as kundennummer, a.name as name, z.aufgabe, SUM((UNIX_TIMESTAMP(z.bis)-UNIX_TIMESTAMP(z.von))/3600.0) as stunden
        FROM zeiterfassung z LEFT JOIN adresse a ON a.id=z.adresse_abrechnung WHERE z.abrechnen='1' AND (z.ist_abgerechnet IS NULL OR z.ist_abgerechnet='0') AND z.adresse_abrechnung > 0 GROUP BY 1");
    // Colors, line width and bold font
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    //$pdf->SetFont('','B');
    // Header

    $header = array('Kundennr.','Name','Stunden','OK');
    $w = array(30,130,20,10);
    $pdf->Cell($w[0],7,$header[0],1,0,'L',true);
    $pdf->Cell($w[1],7,$header[1],1,0,'L',true);
    $pdf->Cell($w[2],7,$header[2],1,0,'C',true);
    $pdf->Cell($w[3],7,$header[3],1,0,'C',true);
    $pdf->Ln();
    $pdf->SetFont('Arial','',11);
    // Color and font restoration

    // Data
    $fill = false;
    for($i=0;$i<count($tmp);$i++)
    {
      if($tmp[$i]["prio"]==0) $prio="";
      else if($tmp[$i]["prio"]==1) $prio="Ja";
      $pdf->Cell($w[0],6,$tmp[$i]["kundennummer"],'LRTB',0,'L',$fill);
      $pdf->Cell($w[1],6,$this->app->erp->ReadyForPDF($tmp[$i]["name"]),'LRTB',0,'L',$fill);
      $pdf->Cell($w[2],6,round($tmp[$i]["stunden"],2),'LRTB',0,'C',$fill);
      $pdf->Cell($w[3],6,"",'LRTB',0,'C',$fill);
      $pdf->Ln();
      $fill = !$fill;
    }
    $pdf->Ln();
    $pdf->SetFont('Arial','',8);
    $name=preg_replace("/[^a-zA-Z0-9_]/" , "" , $this->app->User->GetName());
    $name = strtoupper($name);

    $pdf->Cell(array_sum($w),0,date('Ymd')."_".$name."_ABRECHNEN.pdf",'',0,'R');

    $pdf->Output(date('Ymd')."_".$name."_ABRECHNEN.pdf",'D');
    exit;
  }

  function ZeiterfassungCreate()
  {
    $cmd=$this->app->Secure->GetGET("cmd");
    $back=$this->app->Secure->GetGET("back");

    //    $this->app->erp->MenuEintrag("index.php?module=zeiterfassung&action=list","&Uuml;bersicht");
    //   $this->app->erp->MenuEintrag("index.php?module=zeiterfassung&action=create","Neue Zeiterfassung");

    if($back=="zeiterfassung" || $cmd=="extern")
      $this->ZeiterfassungMenu();
    else {
      $this->app->erp->StartseiteMenu();
      //      $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Zeiterfassung");
    }

    $id =  $this->app->User->GetId();      
    if(is_numeric($id))
      $adr_id = $this->app->DB->Select("SELECT adresse FROM user WHERE id=$id");

    $this->ZeiterfassungManuell($adr_id);
    //$this->app->Tpl->Parse(PAGE,"zeiterfassung_create.tpl");
  }

  function ZeiterfassungListUser()
  {
    //$this->app->Tpl->Add(KURZUEBERSCHRIFT,"Zeiterfassung");
    $this->app->Tpl->Set('UEBERSCHRIFT',"Zeiterfassung");
    $this->app->erp->StartseiteMenu();

    if($this->app->Secure->GetGET("do")=="stornieren"){
      $lid = $this->app->Secure->GetGET("lid");
      $back = $this->app->Secure->GetGET("back");
      if($lid!="")
      {
        if($back=="zeiterfassung") {
          $this->app->DB->Delete("DELETE FROM zeiterfassung WHERE id='".$lid."'");
          header("Location: index.php?module=zeiterfassung&action=list");
        }
        else if($back=="zeiterfassungmitarbeiter") {
          $id = $this->app->Secure->GetGET("id");
          $this->app->DB->Delete("DELETE FROM zeiterfassung WHERE id='".$lid."'");
          header("Location: index.php?module=adresse&action=zeiterfassung&id=$id");
        }
        else if($back=="service") {
          $id = $this->app->Secure->GetGET("id");
          $this->app->DB->Delete("DELETE FROM zeiterfassung WHERE id='".$lid."'");
          header("Location: index.php?module=service&action=list");
        }
        else if($back=="aufgabe") {
          $id = $this->app->Secure->GetGET("id");
          $this->app->DB->Delete("DELETE FROM zeiterfassung WHERE id='".$lid."'");
          header("Location: index.php?module=aufgaben&action=list");
        }

        else if($back=="zeiterfassunguser")
        {
          $this->app->DB->Delete("DELETE FROM zeiterfassung WHERE id='".$lid."' AND gebucht_von_user='".$this->app->User->GetID()."'");
          header("Location: index.php?module=zeiterfassung&action=listuser");
        }
        else if ($back=="projekt")
        {
          $back_id = $this->app->Secure->GetGET("back_id");
          $back_sid = $this->app->Secure->GetGET("back_sid");
          header("Location: index.php?module=projekt&action=zeit&id=$back_id&sid=$back_sid");
        }
        else if ($back=="lohnabrechnung")
        {
          header("Location: index.php?module=lohnabrechnung&action=list");
        }
        else if ($back=="adresse")
        {
          $back_id = $this->app->Secure->GetGET("back_id");
          header("Location: index.php?module=adresse&action=abrechnungzeit&id=$back_id");                  
        }
        else
          header("Location: index.php?module=zeiterfassung&action=create");
        exit;
      }
    }

    $this->app->Tpl->Set(HEUTE,number_format($this->app->erp->ZeitGesamtHeuteArbeit($this->app->User->GetAdresse()),2,",",""));
    $this->app->Tpl->Set(PAUSE,number_format($this->app->erp->ZeitGesamtHeutePause($this->app->User->GetAdresse()),2,",",""));
    $this->app->Tpl->Set(WOCHEIST,number_format($this->app->erp->ZeitGesamtWocheIst($this->app->User->GetAdresse()),2,",",""));

    $offen = $this->app->erp->ZeitGesamtWocheOffen($this->app->User->GetAdresse());
    if($offen > 0)
    {
      $this->app->Tpl->Set(WOCHESOLL,number_format($this->app->erp->ZeitGesamtWocheSoll($this->app->User->GetAdresse()),2,",",""));
      $this->app->Tpl->Set(OFFEN,"<font color=blue>".number_format($offen,2,",","")."</font>");
    } else if ($offen < 0)
    {
      $this->app->Tpl->Set(WOCHESOLL,"-");
      $this->app->Tpl->Set(OFFEN,"-");
    } 
    else {
      $this->app->Tpl->Set(WOCHESOLL,number_format($this->app->erp->ZeitGesamtWocheSoll($this->app->User->GetAdresse()),2,",",""));
      $this->app->Tpl->Set(OFFEN,number_format($offen,2,",",""));
    }

    $this->app->YUI->TableSearch('TAB1',"zeiterfassunguser");

    //TODO wenn man das Recht  hat
    if(0)
    {
      $this->app->Tpl->Add('TAB1',
          "<table width=\"100%\"><tr><td align=\"center\"><input type=\"submit\" value=\"in Arbeitsnachweis &uuml;bernehmen\">&nbsp;".
          "<input type=\"submit\" value=\"in Auftrag &uuml;bernehmen\">&nbsp;".
          "<input type=\"submit\" value=\"in Lieferschein &uuml;bernehmen\">&nbsp;<input type=\"submit\" value=\"als abgeschlossen markieren\"></td></tr></table>");
    }

    $this->app->Tpl->Parse('PAGE',"zeiterfassunguseruebersicht.tpl");
  }



  function ZeiterfassungList()
  {
    //		$this->app->Tpl->Set(UEBERSCHRIFT,"Zeiterfassung");
    $this->ZeiterfassungMenu();

    if($this->app->Secure->GetGET("do")=="stornieren"){
      $lid = $this->app->Secure->GetGET("lid");
      $back = $this->app->Secure->GetGET("back");
      if($lid!="")
      {
        $this->app->DB->Delete("DELETE FROM zeiterfassung WHERE id=$lid");

        if($back=="zeiterfassung")
          header("Location: index.php?module=zeiterfassung&action=list");
        else if($back=="zeiterfassunguser")
          header("Location: index.php?module=zeiterfassung&action=listuser");
        else if($back=="service")
          header("Location: index.php?module=service&action=list");
        else if($back=="aufgabe")
          header("Location: index.php?module=aufgaben&action=list");
        else if($back=="zeiterfassungmitarbeiter")
        {
          $sid = $this->app->Secure->GetGET("sid");
          header("Location: index.php?module=adresse&action=zeiterfassung&id=$sid");
        }
        else if ($back=="projekt")
        {
          $back_id = $this->app->Secure->GetGET("back_id");
          $back_sid = $this->app->Secure->GetGET("back_sid");
          header("Location: index.php?module=projekt&action=zeit&id=$back_id&sid=$back_sid");
        }
        else if ($back=="lohnabrechnung")
        {
          header("Location: index.php?module=lohnabrechnung&action=list");
        }
        else if ($back=="adresse")
        {
          $back_id = $this->app->Secure->GetGET("back_id");
          header("Location: index.php?module=adresse&action=abrechnungzeit&id=$back_id");                  
        }
        else
          header("Location: index.php?module=zeiterfassung&action=create");
        exit;
      }
    }

    $this->app->YUI->TableSearch('TAB1',"zeiterfassung");
    $this->app->YUI->TableSearch('TAB2',"zeiterfassungkundenoffen");

    //TODO wenn man das Recht  hat
    if(0)
    {
      $this->app->Tpl->Add('TAB1',
          "<table width=\"100%\"><tr><td align=\"center\"><input type=\"submit\" value=\"in Arbeitsnachweis &uuml;bernehmen\">&nbsp;".
          "<input type=\"submit\" value=\"in Auftrag &uuml;bernehmen\">&nbsp;".
          "<input type=\"submit\" value=\"in Lieferschein &uuml;bernehmen\">&nbsp;<input type=\"submit\" value=\"als abgeschlossen markieren\"></td></tr></table>");
    }


    $this->app->Tpl->Parse('PAGE',"zeiterfassunguebersicht.tpl");


  }


  function ZeiterfassungMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Zeiterfassung");
    $this->app->erp->MenuEintrag("index.php?module=zeiterfassung&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=zeiterfassung&action=create&cmd=extern","Neue Zeiterfassung");

    //    $this->app->Tpl->Add(TABS,"<li><a href=\"index.php?module=zeiterfassung&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");
  }


  function ZeiterfassungEdit()
  {
    $back = $this->app->Secure->GetGET("back");
    if($back=="zeiterfassung")
      $this->ZeiterfassungMenu();
    else
      $this->app->erp->StartseiteMenu();

    $this->ZeiterfassungManuell($adr_id,true);

    //parent::ZeiterfassungEdit();
  }

  function ArbeitspaketReadDetails($index,&$ref)
  {
    $pakete = $ref->app->DB->SelectArr("SELECT * FROM arbeitspakete WHERE id='$index'");
    $myArr = $pakete[0];

    $ref->app->Tpl->Set(AUFGABE, $myArr["aufgabe"]);
    $ref->app->Tpl->Set(PROJEKT, $myArr["projekt"]);
    $this->app->Tpl->Set(BESCHREIBUNG, $myArr["beschreibung"]);
    $this->app->Tpl->Set(ZEITGEPLANT, $myArr["zeit_geplant"]);
    $this->app->Tpl->Set(KOSTENSTELLE, $myArr["kostenstelle"]);
    $this->app->Tpl->Set(STATUS, $myArr["status"]);
  }

  function ArbeitspaketDetails()
  {
    $this->app->Tpl->Set(HEADING,"Details zum Arbeitspaket");

    $this->app->Tpl->Set(SUBSUBHEADING, "Details");
    $this->app->Tpl->Set(DATUM, date("d.m.Y", time()));

    $this->app->Tpl->Add(TABS,
        "<li><h2>Zeiterfassung</h2></li>");

    $this->app->Tpl->Add(TABS,
        "<li><a href=\"index.php?module=zeiterfassung&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");

    // Adress-ID mit USER-ID abfragen
    $id =  $this->app->User->GetId();
    if($id!="")
      $adr_id = $this->app->DB->Select("SELECT adresse FROM user WHERE id=$id");

    $ap_id = $this->app->Secure->GetGET("lid");

    $pakete = $this->app->DB->SelectArr('SELECT * FROM arbeitspaket WHERE id='.$ap_id.' AND adresse='.$adr_id);
    $myArr = $pakete[0];    

    $this->app->Tpl->Set(AUFGABE, $myArr["aufgabe"]);
    $this->app->Tpl->Set(PROJEKT, $myArr["projekt"]);
    $this->app->Tpl->Set(BESCHREIBUNG, $myArr["beschreibung"]);
    $this->app->Tpl->Set(ZEITGEPLANT, $myArr["zeit_geplant"]);
    $this->app->Tpl->Set(KOSTENSTELLE, $myArr["kostenstelle"]);
    $this->app->Tpl->Set(STATUS, $myArr["status"]);

    if($myArr["abgabe"] == "abgegeben")
      $this->app->Tpl->Set(ABGABE, 'fertig' ); 
    else
      $this->app->Tpl->Set(ABGABE, '<input type="checkbox" name="abgabefeld" value="nicht abgegeben">' );

    if($this->app->Secure->GetPOST("abgabefeld") == "nicht abgegeben"){
      $this->app->DB->Update('UPDATE arbeitspakete SET abgabe="abgegeben", abgabedatum="'.date("Y-m-d").'" WHERE id='.$myArr["id"]);
      $myArr["abgabe"] = "abgegeben";
    }
    $this->app->Tpl->Parse(INHALT, "arbeitspaket_details.tpl");
    $this->app->Tpl->Parse(PAGE,"rahmen_submit_extend.tpl");
  }


  function ZeiterfassungManuell($adr_id)
  {
    $this->app->Tpl->Set(HEADING,"Zeiterfassung (&Uuml;bersicht)");

    $this->app->Tpl->Set(SUBSUBHEADING, "Zeit erfassen");

    //wenn id und kein post einmalig aus db holen    
    $id = $this->app->Secure->GetGET("id");

    if($id!="" && $this->app->Secure->GetPOST("art")=="")
    {
      $tmp = $this->app->DB->SelectArr("SELECT *,DATE_FORMAT(von,'%H:%i') as von, if(bis!='0000-00-00 00:00:00',DATE_FORMAT(bis,'%H:%i'),'') as bis, DATE_FORMAT(von,'%d.%m.%Y') as datum FROM zeiterfassung WHERE  id='$id' LIMIT 1");
      $aufgabe = $tmp[0]["aufgabe"];
      $art = $tmp[0]["art"];
      $ort = $tmp[0]["ort"];
      $gps = $tmp[0]["gps"];
      $beschreibung = $tmp[0]["beschreibung"];
      $internerkommentar = $tmp[0]["internerkommentar"];
      $paketauswahl = $tmp[0]["arbeitspaket"];
      $abrechnen = $tmp[0]["abrechnen"];
      $abgerechnet = $tmp[0]["abgerechnet"];

      if($paketauswahl > 0){
        $this->app->Tpl->Set(PROJEKTROW,"none");
      }

      if($tmp[0]["adresse"]!=$this->app->User->GetAdresse())
      {
        $this->app->Tpl->Set(ANDERERMITARBEITER,"checked");
        $this->app->Tpl->Set(DISPLAYANDERERMITARBEITER,"");
      } else {
        $this->app->Tpl->Set(DISPLAYANDERERMITARBEITER,"none");
      }

      $mitarbeiter = $this->app->DB->Select("SELECT CONCAT(mitarbeiternummer,' ',name) FROM adresse WHERE id='".$tmp[0]["adresse"]."'");
      $adresse_abrechnung = $tmp[0]["adresse_abrechnung"];
      $projekt_komplett = $this->app->DB->Select("SELECT CONCAT(abkuerzung,' ',name) FROM projekt WHERE id='".$tmp[0]["projekt"]."'");
      $adresse_abrechnung_komplett = $this->app->DB->Select("SELECT CONCAT(kundennummer,' ',name) FROM adresse WHERE id='".$tmp[0]["adresse_abrechnung"]."'");

      if($tmp[0]["adresse_abrechnung"]<=0)
        $adresse_abrechnung_komplett="";

      $mitarbeiter_komplett = $this->app->DB->Select("SELECT CONCAT(mitarbeiternummer,' ',name) FROM adresse WHERE id='".$tmp[0]["adresse"]."'");
      $kostenstelle_komplett = $this->app->DB->Select("SELECT CONCAT(nummer,' ',beschreibung) FROM kostenstellen WHERE nummer='".$tmp[0]["kostenstelle"]."'");
      $verrechnungsart_komplett = $this->app->DB->Select("SELECT CONCAT(nummer,' ',beschreibung) FROM verrechnungsart WHERE nummer='".$tmp[0]["verrechnungsart"]."'");


      $vonZeit = $tmp[0]["von"];
      $bisZeit = $tmp[0]["bis"];
      $datum = $tmp[0]["datum"];
    } else {
      if($this->app->Secure->GetPOST("datum")=="")
        $datum = date("d.m.Y", time());
      else
        $datum = $this->app->Secure->GetPOST("datum");

      $aufgabe = $this->app->Secure->GetPOST("aufgabe");
      $art= $this->app->Secure->GetPOST("art");

      $vonZeit = $this->app->Secure->GetPOST("vonZeit");
      $bisZeit = $this->app->Secure->GetPOST("bisZeit");

      $beschreibung = $this->app->Secure->GetPOST("beschreibung");
      $internerkommentar = $this->app->Secure->GetPOST("internerkommentar");
      $projekt = $this->app->Secure->GetPOST("projekt_manuell");
      $paketauswahl = $this->app->Secure->GetPOST("arbeitspakete");
      $abrechnen = $this->app->Secure->GetPOST("abrechnen");
      $abgerechnet = $this->app->Secure->GetPOST("abgerechnet");
      $aufgabe = $this->app->Secure->GetPOST("aufgabe");

      $mitarbeiter = $this->app->Secure->GetPOST("mitarbeiter");
      $kostenstelle = $this->app->Secure->GetPOST("kostenstelle");
      $verrechnungsart = $this->app->Secure->GetPOST("verrechnungsart");


      $ort = $this->app->Secure->GetPOST("ort");
      $gps = $this->app->Secure->GetPOST("gps");
      $adresse_abrechnung = $this->app->Secure->GetPOST("adresse_abrechnung");

      $mitarbeiter_komplett = $mitarbeiter;
      $kostenstelle_komplett = $kostenstellen;
      $verrechnungsart_komplett = $verrechnungsart;
      $projekt_komplett = $projekt;
      $adresse_abrechnung_komplett = $adresse_abrechnung;

      if($paketauswahl > 0)
        $this->app->Tpl->Set(PROJEKTROW,"none");

      if($mitarbeiter!=""){
        $this->app->Tpl->Set(ANDERERMITARBEITER,"checked");
      }
      else {
        $this->app->Tpl->Set(DISPLAYANDERERMITARBEITER,"none");
      }


    }
    $string = $mitarbeiter;	
    $string = trim ($string);
    $mitarbeiter = substr ($string , 0 , (strpos ($string , ' ')));	

    $string = $kostenstelle;	
    $string = trim ($string);
    $kostenstelle = substr ($string , 0 , (strpos ($string , ' ')));	

    $string = $verrechnungsart;
    $string = trim ($string);
    $verrechnungsart = substr ($string , 0 , (strpos ($string , ' ')));	

    if($mitarbeiter!=""){
      $adr_id = $this->app->DB->Select("SELECT id FROM adresse WHERE mitarbeiternummer='$mitarbeiter' LIMIT 1");
    }

    $this->app->YUI->AutoComplete("projekt_manuell","projektname");
    $this->app->YUI->AutoComplete("adresse_abrechnung","kunde");

    $this->app->YUI->AutoComplete("mitarbeiter","mitarbeiter");

    $this->app->YUI->AutoComplete("kostenstelle","kostenstelle");
    $this->app->YUI->AutoComplete("verrechnungsart","verrechnungsart");

    if($this->app->Secure->GetPOST("vonZeit")=="" && $id=="")
    {
      $vonZeit =  $this->app->DB->Select("SELECT DATE_FORMAT(MAX(bis),'%H:%i') FROM zeiterfassung 
          WHERE adresse='$adr_id' AND DATE_FORMAT(bis,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d')");
    }

    $this->app->Tpl->Set(VONZEIT,$vonZeit?$vonZeit:"09:00");

    if($vonZeit==$bisZeit) $bisZeit="";
    $this->app->Tpl->Set(BISZEIT,$bisZeit?$bisZeit:"");

    // Projekt grabben und notfalls wieder anzeigen
    $projekt_kennung = strstr($projekt, ' ', true);
    $projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='".$projekt_kennung."' LIMIT 1");


    // Kunde
    $adresse_abrechnung = strstr($adresse_abrechnung, ' ', true);
    if($adresse_abrechnung!="")
      $adresse_kunde = $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='".$adresse_abrechnung."' LIMIT 1");
    else
      $adresse_kunde = 'NULL';



    if($abrechnen=="1")
      $this->app->Tpl->Set(ABRECHNEN,"checked");

    if($abgerechnet=="1")
      $this->app->Tpl->Set(ABGERECHNET,"checked");



    $this->app->Tpl->Set(DATUM, $datum);
    $this->app->Tpl->Set(PROJEKT_MANUELL,$projekt_komplett);
    $this->app->Tpl->Set(ADRESSE_ABRECHNUNG,$adresse_abrechnung_komplett);
    $this->app->Tpl->Set(KOSTENSTELLE,$kostenstelle_komplett);
    $this->app->Tpl->Set(VERRECHNUNGSART,$verrechnungsart_komplett);
    $this->app->Tpl->Set(AUFGABE,$aufgabe);
    $this->app->Tpl->Set(MITARBEITER,$mitarbeiter_komplett);
    $this->app->Tpl->Set(ORT,$ort);
    $this->app->Tpl->Set(GPS,$gps);
    $this->app->Tpl->Set(BESCHREIBUNG,str_replace('\r\n',"\r\n",$beschreibung));
    $this->app->Tpl->Set(INTERNERKOMMENTAR,str_replace('\r\n',"\r\n",$internerkommentar));

    if($gps!="")
    {
      $tmpgps = explode(';',$gps);
      $this->app->Tpl->Set(GPSIMAGE,"<img width='180' height='180' src='http://maps.google.com/maps/api/staticmap?center=".$tmpgps[0].",".$tmpgps[1].
          "&markers=size:small|color:blue|".$tmpgps[0].",".$tmpgps[1]."&zoom=14&size=180x180&sensor=false' />");
    } else {

      $this->app->Tpl->Set(GPSBUTTON,'<input type="button" value="GPS Daten laden" onclick="Standpunkt();">');	
    }
    $this->app->Tpl->Set(ART, $this->app->erp->GetSelect($this->app->erp->GetZeiterfassungArt(),$art));

    $pakete = $this->app->DB->SelectArr('SELECT id, aufgabe,art,projekt FROM arbeitspaket WHERE (adresse = '.$adr_id.' or (art="teilprojekt" '.$this->app->erp->ProjektRechte("projekt").')) AND abgenommen!=1 AND geloescht!=1 AND status!=\'abgeschlossen\' order by projekt');
    $select = '<option value="0">-- kein --</option>';
    for($i =0; $i<sizeof($pakete); $i++){
      $myArr = $pakete[$i];
      if($myArr["art"]=="") $myArr["art"]="arbeitspaket";
      $projekt_ap = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='".$myArr["projekt"]."' LIMIT 1");
      if($paketauswahl==$myArr["id"])$checked=" selected"; else $checked ="";
      $select = $select.'<option value="'.$myArr["id"].'" '.$checked.'>Projekt: '.$projekt_ap.'->'.ucfirst($myArr["art"]).': '.$myArr["aufgabe"].'</option>';  
    }
    $this->app->Tpl->Set(PAKETAUSWAHL, $select);

    if($this->app->Secure->GetPOST("ok")){
      $vonZeit = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1")." ".$this->app->Secure->GetPOST("vonZeit").":00";
      $bisZeit = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1")." ".$this->app->Secure->GetPOST("bisZeit").":00";



      if($paketauswahl == 0){
        if(($aufgabe!="") && ($this->app->Secure->GetPOST("vonZeit")!="") && ($this->app->Secure->GetPOST("bisZeit")!="") && ($datum!="")){	
          {
            // Hier fehlt abrechnen und adresse_abrechnung
            $this->app->erp->AddArbeitszeit($adr_id, $vonZeit, $bisZeit, $aufgabe, $beschreibung, $ort, 
              $projekt, 0,$art,$adresse_kunde,$abrechnen,$verrechnungsart,$kostenstelle,$abgrechnet,$gps,0,$internerkommentar);
            $this->app->Tpl->Set(MESSAGE,"<div class=\"success\">T&auml;tigkeit erfolgreich gebucht!</div>");
            $msg = $this->app->erp->base64_url_encode("<div class=\"success\">T&auml;tigkeit erfolgreich gebucht!</div>  ");
            header("Location: index.php?module=zeiterfassung&action=create&msg=$msg");
            exit;
          }
        }else{
          $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Fehler! Die Felder \"Kurze Beschreibung\", am, von, bis m&uuml;ssen ausgef&uuml;llt sein!</div>");
        }
      }else{
        if(($this->app->Secure->GetPOST("vonZeit")!="") && ($this->app->Secure->GetPOST("bisZeit")!="") && ($datum!="")){
          //Paketauswahl buchen ...
          $projekt = $this->app->DB->Select("SELECT projekt FROM arbeitspaket WHERE id='$paketauswahl' LIMIT 1");
          $kunde = $this->app->DB->Select("SELECT kunde FROM projekt WHERE id='$projekt' LIMIT 1");
          if($adresse_kunde=="") $adresse_kunde=$kunde;
          $this->app->erp->AddArbeitszeit($adr_id, $vonZeit, $bisZeit, $aufgabe, $beschreibung, $ort, 
            $projekt, $paketauswahl,$art,$adresse_kunde,$abrechnen,$verrechnungsart,$kostenstelle,$abgerechnet,$gps,0,$internerkommentar); 

          $msg = $this->app->erp->base64_url_encode("<div class=\"success\">T&auml;tigkeit erfolgreich gebucht!</div>  ");
          header("Location: index.php?module=zeiterfassung&action=create&msg=$msg");
          exit;
        }else{
          $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Fehler! Die Felder \"Kurze Beschreibung\", am, von, bis m&uuml;ssen ausgef&uuml;llt sein!</div>");
        }
      }

      if($id=="")
        $vonZeit =  $this->app->DB->Select("SELECT DATE_FORMAT(MAX(bis),'%H:%i') FROM zeiterfassung WHERE adresse='$adr_id' AND DATE_FORMAT(bis,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d')");

    }  else {
      if($this->app->Secure->GetPOST("update")){
        if(($aufgabe!="") && ($this->app->Secure->GetPOST("vonZeit")!="") && ($this->app->Secure->GetPOST("bisZeit")!="") && ($datum!="")){	
          //				echo "update";
          //echo $datum;
          $vonZeit = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1")." ".$this->app->Secure->GetPOST("vonZeit").":00";
          $bisZeit = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1")." ".$this->app->Secure->GetPOST("bisZeit").":00";

          if($paketauswahl == 0)
          {
            $this->app->erp->UpdateArbeitszeit($id,$adr_id, $vonZeit, $bisZeit, $aufgabe, $beschreibung, $ort, 
              $projekt, $paketauswahl,$art,$adresse_kunde,$abrechnen,$verrechnungsart,$kostenstelle,$abgerechnet,$gps,$internerkommentar); 
          }
          else
          {
            $this->app->erp->UpdateArbeitszeit($id,$adr_id, $vonZeit, $bisZeit, $aufgabe, $beschreibung, $ort, 
              $projekt, $paketauswahl,$art,"",$abrechnen,$verrechnungsart,$kostenstelle,$gps,$internerkommentar); 
          }

          $back = $this->app->Secure->GetGET("back");
          if($back=="zeiterfassung") 
            header("Location: index.php?module=zeiterfassung&action=list");
          else if($back=="zeiterfassunguser") 
            header("Location: index.php?module=zeiterfassung&action=listuser");
          else if($back=="service") 
            header("Location: index.php?module=service&action=list");
          else if($back=="aufgabe") 
            header("Location: index.php?module=aufgaben&action=list");
          else if($back=="zeiterfassungmitarbeiter") 
          {
            $sid = $this->app->Secure->GetGET("sid");
            header("Location: index.php?module=adresse&action=zeiterfassung&id=$sid");
          }


          else if ($back=="projekt")
          {
            $back_id = $this->app->Secure->GetGET("back_id");
            $back_sid = $this->app->Secure->GetGET("back_sid");
            header("Location: index.php?module=projekt&action=zeit&id=$back_id&sid=$back_sid");	
          }
          else if ($back=="lohnabrechnung")
          {
            header("Location: index.php?module=lohnabrechnung&action=list");
          }

          else if ($back=="adresse")
          {
            $back_id = $this->app->Secure->GetGET("back_id");
            header("Location: index.php?module=adresse&action=abrechnungzeit&id=$back_id");	
          }
          else
            header("Location: index.php?module=zeiterfassung&action=create");

          exit;

        } else {
          $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Fehler! Die Felder \"Kurze Beschreibung\", am, von, bis m&uuml;ssen ausgef&uuml;llt sein!</div>");
        }

      }
    }

    //tabelle mit gebuchten tätigkeiten heute


    if($id=="")
    {
      $table = new EasyTable($this->app);

      $table->Query("SELECT DATE_FORMAT(z.bis, GET_FORMAT(DATE,'EUR')) AS Datum, 
          z.aufgabe as Taetigkeit,

          (SELECT name FROM adresse adr WHERE adr.id=z.adresse) as mitarbeiter,
          DATE_FORMAT(z.von,'%H:%i') as von, DATE_FORMAT(z.bis,'%H:%i') as bis,
          TIMEDIFF(z.bis, z.von) AS Dauer,

          p.abkuerzung as Projekt,
          ap.aufgabe as 'Unterprojekt/Arbeitspaket',


          IF(DATEDIFF(CURDATE(), z.bis)<= 5, 
            CONCAT('<a href=\"#\" onclick=\"if(!confirm(\'Wirklich stornieren?\')) return false; else window.location.href=\'index.php?module=zeiterfassung&action=list&do=stornieren&lid=', z.id, '\'\">Stornieren</a>&nbsp;|&nbsp;<a href=\"index.php?module=zeiterfassung&action=create&id=', z.id, '\">Edit</a>'), '')
          FROM zeiterfassung z LEFT JOIN projekt p ON p.id=z.projekt LEFT JOIN arbeitspaket ap ON z.arbeitspaket=ap.id
          WHERE z.gebucht_von_user=".$this->app->User->GetID()." AND DATE_FORMAT(z.bis,'%Y-%m-%d')= DATE_FORMAT(NOW(),'%Y-%m-%d')
          ORDER BY 1 DESC,2 DESC, 3 DESC
          ");
      $table->DisplayNew(TABELLE,"Aktion","noAction");
      $this->app->Tpl->Set(BUTTON,"<input type=\"submit\" value=\"T&auml;tigkeit jetzt einbuchen\" name=\"ok\">");
    } else {

      $back = $this->app->Secure->GetGET("back");

      if($back=="zeiterfassung")
        $link = "index.php?module=zeiterfassung&action=list";
      else if($back=="service")
        $link = "index.php?module=service&action=list";
      else if($back=="aufgabe")
        $link = "index.php?module=aufgaben&action=list";
      else if ($back=="projekt")
      {
        $back_id = $this->app->Secure->GetGET("back_id");
        $back_sid = $this->app->Secure->GetGET("back_sid");
        $link = "index.php?module=projekt&action=zeit&id=$back_id&sid=$back_sid";
      }
      else if ($back=="adresse")
      {
        $back_id = $this->app->Secure->GetGET("back_id");
        $link = "index.php?module=adresse&action=abrechnungzeit&id=$back_id";                  
      }
      else
        $link = "index.php?module=zeiterfassung&action=create";

      $this->app->Tpl->Set(BUTTON,"
          <input type=\"submit\" value=\"T&auml;tigkeit &auml;ndern\" name=\"update\">&nbsp;
          <input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='".$link."'\">&nbsp;
          ");
    }


    $this->app->YUI->TimePicker("vonZeit");
    $this->app->YUI->TimePicker("bisZeit");


    //$this->app->Tpl->Set(TABTEXT,"Zeiterfassung"); 
    $this->app->Tpl->Parse(TAB1, "zeiterfassung_manuell.tpl");
    $this->app->Tpl->Parse(PAGE, "tabview.tpl");
    //$this->app->Tpl->Parse(PAGE,"rahmen_submit_extend.tpl");
  }



  function ZeiterfassungOffen($adr_id)
  {
    $this->app->Tpl->Set(SUBSUBHEADING, "offene Arbeitspakete");
    $this->app->Tpl->Set(INHALT,"");

    $table = new EasyTable($this->app);
    $table->Query("SELECT DISTINCT a.aufgabe, a.zeit_geplant as vorgabe, 
        (SELECT FORMAT(SUM(TIMEDIFF(bis,von)/10000),2) FROM zeiterfassung WHERE arbeitspaket=a.id) as Gebucht, 
        DATE_FORMAT(a.abgabedatum,'%d.%m.%y') as bis, a.id
        FROM arbeitspaket a LEFT JOIN zeiterfassung z ON z.arbeitspaket=a.id
        WHERE a.adresse='$adr_id' AND (a.status = 'gestartet' OR a.status = 'besprochen')");

    $table->DisplayNew(INHALT,'[DETAILS%value%]');
    $this->app->YUI->Dialog($table,DETAILS,"Arbeitspaket","aufgabe","arbeitspaket_details.tpl",$this,"ArbeitspaketReadDetails"); 

    $this->app->Tpl->Parse(ARBEITSPAKETE,"rahmen70.tpl");

  }

  function ZeiterfassungAbgeschlossen($adr_id)
  {

    $monat = $this->app->DB->Select("SELECT DATE_FORMAT(NOW(),'%M')");
    $this->app->Tpl->Set(SUBSUBHEADING, "Zeiterfassung ($monat)");
    $this->app->Tpl->Set(INHALT,"");
    $table = new EasyTable($this->app);

    //  SELECT SUM(hour(z.bis) - hour(z.von)) AS dauer, a.aufgabe, a.zeit_geplant FROM zeiterfassung AS z, arbeitspakete AS a WHERE z.adresse = 2 AND z.adresse = a.adresse AND z.arbeitspaket = a.id  AND a.id = 2 AND (status = "gestartet" OR status = "besprochen") GROUP BY aufgabe

    $table->Query("SELECT DATE_FORMAT(bis, GET_FORMAT(DATE,'EUR')) AS Datum, DATE_FORMAT(von,'%H:%i') as von, DATE_FORMAT(bis,'%H:%i') as bis,
        TIMEDIFF(bis, von) AS Dauer,
        aufgabe as Taetigkeit,
        IF(DATEDIFF(CURDATE(), bis)<= 5, 
          CONCAT('<a href=\"#\" onclick=\"if(!confirm(\'Wirklich stornieren?\')) return false; else window.location.href=\'index.php?module=zeiterfassung&action=list&do=stornieren&lid=', id, '\'\">Stornieren</a>&nbsp;|&nbsp;<a href=\"\">Edit</a>'), '')
        FROM zeiterfassung
        WHERE adresse=$adr_id
        AND (
          MONTH(bis) = MONTH(NOW()) OR DATEDIFF(CURDATE(), bis)<= 5
          )  
        ORDER BY 1 DESC,2 DESC
        ");

    $table->DisplayNew(INHALT,"Aktion","noAction");


    // $this->app->Tpl->Set(INHALT,"Abgschlossen");
    $this->app->Tpl->Parse(ZEITERFASSUNGEN,"rahmen70.tpl");
  }

  function AufgabenOffen($adr_id){
    $this->app->Tpl->Set(SUBHEADING, "offene Aufgaben");
    $this->app->Tpl->Set(INHALT,"");

    // selektierte Aufgabe Updaten
    if($this->app->Secure->GetPOST("ok") != ""){
      $aufg_id = $this->app->Secure->GetPOST("aufg_id");
      foreach($aufg_id as $myId){
        $this->app->DB->Update("UPDATE aufgabe SET abgeschlossen_am = CURDATE(), abgeschlossen='1' WHERE id=$myId LIMIT 1");
        // Kopie nach aufgabe_erledigt
        $this->app->DB->Insert("INSERT INTO aufgabe_erledigt (adresse, aufgabe, abgeschlossen_am)
            VALUES ($adr_id, $myId, CURDATE())");
      }
    }

    $table = new EasyTable($this->app); 
    // Hole einmalige und wiederholende Aufgaben
    // bei wiederholenden Aufgaben werden nur die vom heutigen Tag und nach Schema startdatum + (intervall*n) geholt
    $table->Query("SELECT
        CONCAT(\"<input type='checkbox' name='aufg_id[]' value='\", id, \"'>\") AS Ok, 
        IF(intervall_tage=0, DATE_FORMAT(startdatum, '%d.%m.%Y'), 
          DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL MOD(DATEDIFF(CURDATE(),DATE_FORMAT(startdatum, '%Y:%m:%d')),intervall_tage) day),'%d.%m.%Y')) AS Datum,
        IF(intervall_tage=0, DATEDIFF(CURDATE(), startdatum) ,MOD(DATEDIFF(CURDATE(), startdatum),intervall_tage)) AS Verzug,
        IF(intervall_tage=0, 'einmalig', intervall_tage) AS Intervall,
        aufgabe, beschreibung
        FROM aufgabe
        WHERE
        (abgeschlossen=0 AND (adresse=$adr_id OR adresse=0))
        OR 
        (DATE_SUB(CURDATE(), INTERVAL MOD(DATEDIFF(CURDATE(),DATE_FORMAT(startdatum, '%Y:%m:%d')),intervall_tage) day)=CURDATE()
         AND DATE_SUB(CURDATE(), INTERVAL MOD(DATEDIFF(CURDATE(),DATE_FORMAT(startdatum, '%Y:%m:%d')),intervall_tage) day) != abgeschlossen_am
         AND intervall_tage>0 AND (adresse=$adr_id OR adresse=0))
        ORDER BY Datum");

    $table->DisplayNew(INHALT,"Beschreibung","noAction");

    $this->app->Tpl->Parse(AUFGABEN,"rahmen_submit_100.tpl");   
  }

  function ZeiterfassungArchiv($adr_id)
  {
    $this->app->Tpl->Set(SUBHEADING, "Archiv");
    $this->app->Tpl->Set(INHALT,"");  

    $table = new EasyTable($this->app);
    $table->Query("SELECT 
        MONTHNAME(bis) AS Monat,
        YEAR(bis) Jahr,
        CONCAT(ROUND(SUM(TIME_TO_SEC(TIMEDIFF(bis,von)))/3600,1),' Stunden') AS Arbeitszeit,
        CONCAT('<a href=\"index.php?module=zeiterfassung&action=details&month=', MONTH(bis),'&year=', YEAR(bis),'\" class=\"popup\" title=\"Details\">Details</a>')
        FROM `zeiterfassung` 
        WHERE adresse=$adr_id
        GROUP BY MONTHNAME(bis)
        ORDER BY bis DESC");

    $table->DisplayNew(INHALT,"Aktion", "noAction");

    $this->app->Tpl->Parse(ARCHIV,"rahmen100.tpl");
  }

  function ZeiterfassungDetails()
  {
    $monat = $this->app->Secure->GetGET("month");
    $jahr = $this->app->Secure->GetGET("year");
    $frame = $this->app->Secure->GetGET("frame");

    if($frame=="false")
    {
      // hier nur fenster größe anpassen
      $this->app->YUI->IframeDialog(650,730);
    } else {

      $id =  $this->app->User->GetId();
      if($id!="")
        $adr_id = $this->app->DB->Select("SELECT adresse FROM user WHERE id=$id");

      $monatsname = $this->app->DB->Select("SELECT MONTHNAME('$jahr-$monat-01')");

      $this->app->Tpl->Set(SUBHEADING, "Arbeitszeiten f&uuml;r $monatsname");
      $this->app->Tpl->Set(INHALT,"");  


      //    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Zeiterfassung");

      //$this->app->Tpl->Add(TABS,
      //  "<li><a href=\"index.php?module=zeiterfassung&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");

      $table = new EasyTable($this->app);
      $table->Query("SELECT  
          DATE_FORMAT(bis,'%d.%m.%y') as Datum,
          ROUND((TIME_TO_SEC(TIMEDIFF(bis,von))/3600)) AS Dauer,
          buchungsart,
          aufgabe
          FROM zeiterfassung
          WHERE adresse=$adr_id
          AND MONTH(bis)=$monat
          AND YEAR(bis)=$jahr");	

        $table->DisplayNew(INHALT,"T&auml;tigkeit", "noAction");
      //$this->app->Tpl->Set(AKTIV_TAB5,"selected"); 
      $this->app->Tpl->Parse(PAGE,"rahmen.tpl");
      $this->app->BuildNavigation=false;
    }


  }

  function ZeiterfassungDokuArbeitszeit()
  {
    $pdf = new DokuArbeitszeit();
    $filename = $tmp.date('Ymd')."_".$kundennummer."_".$name."_DOKUARBEITSZEIT.pdf";
    $pdf->Output($filename,'D');
  }
}
?>
