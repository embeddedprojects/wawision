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
include ("_gen/aufgabe.php");

class Aufgaben extends GenAufgabe {
  var $app;

  function Aufgaben($app) {
    //parent::GenAufgaben($app);
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("edit","AufgabenEdit");
    $this->app->ActionHandler("editwdh","AufgabenEditWdh");
    $this->app->ActionHandler("abschluss","AufgabenAbschluss");
    $this->app->ActionHandler("pdf","AufgabenPDF");
    $this->app->ActionHandler("pdfextern","AufgabenPDFExtern");
    $this->app->ActionHandler("delete","AufgabenDelete");
    $this->app->ActionHandler("list","AufgabenList");
    $this->app->ActionHandler("create","AufgabenCreate");
    $this->app->ActionHandler("kalender","AufgabenKalender");
    $this->app->ActionHandler("dragdropaufgabe","AufgabenDrapDrop");
    $this->app->ActionHandler("sortaufgabe","AufgabenSort");
    $this->app->ActionHandler("dateien","AufgabenDateien");

    $this->app->Tpl->Set('UEBERSCHRIFT',"Aufgaben");
    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }

  function AufgabenMenu()
  {
    $this->app->Tpl->Set(BEFORETABS,'$( "#accordion" ).accordion();');
    $this->app->erp->StartseiteMenu();
  } 


  function AufgabenDateien()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->MenuEintrag("index.php?module=aufgaben&action=edit&id=$id","Details");
    $this->app->erp->MenuEintrag("index.php?module=aufgaben&action=dateien&id=$id","Dateien");

    $this->app->Tpl->Add(UEBERSCHRIFT," (Dateien)");
    $this->app->YUI->DateiUpload(PAGE,"Aufgabe",$id);
  }

  function AufgabenPDFExtern()
  {
    //Create a new PDF file
    $pdf=new FPDFWAWISION();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',11);
    //Create lines (boxes) for each ROW (Product)
    //If you don't use the following code, you don't create the lines separating each row
    $tmp = $this->app->DB->SelectArr("SELECT a.aufgabe, if(a.stunden > 0,CONCAT(a.stunden,' h'),'') as dauer, adr.name as name,
        if(a.abgabe_bis,DATE_FORMAT(a.abgabe_bis,'%d.%m.%Y'),'') as datum, a.prio FROM aufgabe a 
        LEFT JOIN adresse adr ON adr.id=a.adresse WHERE a.status!='abgeschlossen' ORDER by a.prio DESC, a.abgabe_bis, adr.name");
    // Colors, line width and bold font
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    //$pdf->SetFont('','B');
    // Header

    $header = array('Aufgabe','Dauer','Mitarbeiter','Termin','Prio');
    $w = array(85,15,40,30,20);
    $pdf->Cell($w[0],7,$header[0],1,0,'L',true);
    $pdf->Cell($w[1],7,$header[1],1,0,'L',true);
    $pdf->Cell($w[2],7,$header[2],1,0,'L',true);
    $pdf->Cell($w[3],7,$header[3],1,0,'C',true);
    $pdf->Cell($w[4],7,$header[4],1,0,'C',true);
    $pdf->Ln();
    $pdf->SetFont('Arial','',10);
    // Color and font restoration

    // Data
    $fill = false;
    for($i=0;$i<count($tmp);$i++)
    {
      if($tmp[$i]["prio"]==0) $prio="";
      else if($tmp[$i]["prio"]==1) $prio="Ja";
      $pdf->Cell($w[0],6,$tmp[$i]["aufgabe"],'LRTB',0,'L',$fill);
      $pdf->Cell($w[1],6,$tmp[$i]["dauer"],'LRTB',0,'L',$fill);
      $pdf->Cell($w[2],6,$tmp[$i]["name"],'LRTB',0,'L',$fill);
      $pdf->Cell($w[3],6,$tmp[$i]["datum"],'LRTB',0,'C',$fill);
      $pdf->Cell($w[4],6,$prio,'LRTB',0,'C',$fill);
      $pdf->Ln();
      $fill = !$fill;
    }
    $pdf->Ln();
    $pdf->SetFont('Arial','',8);
    $name="ALL";

    $pdf->Cell(array_sum($w),0,date('Ymd')."_".$name."_TODO.pdf",'',0,'R');
    $pdf->Output(date('Ymd')."_".$name."_TODO.pdf",'D');
    exit;
  }

  function AufgabenPDF()
  {
    //Create a new PDF file
    $pdf=new FPDFWAWISION();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',11);


    //Create lines (boxes) for each ROW (Product)
    //If you don't use the following code, you don't create the lines separating each row
    $tmp = $this->app->DB->SelectArr("SELECT aufgabe, if(stunden > 0,CONCAT(stunden,' h'),'') as dauer,
        if(abgabe_bis,DATE_FORMAT(abgabe_bis,'%d.%m.%Y'),'') as datum, prio FROM aufgabe 
        WHERE adresse='".$this->app->User->GetAdresse()."' AND status!='abgeschlossen' ORDER by prio DESC,abgabe_bis ");
    // Colors, line width and bold font
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.3);
    //$pdf->SetFont('','B');
    // Header

    $header = array('Aufgabe','Dauer','Termin','Prio','OK');
    $w = array(85,15,40,30,20);
    $pdf->Cell($w[0],7,$header[0],1,0,'L',true);
    $pdf->Cell($w[1],7,$header[1],1,0,'L',true);
    $pdf->Cell($w[2],7,$header[2],1,0,'C',true);
    $pdf->Cell($w[3],7,$header[3],1,0,'C',true);
    $pdf->Cell($w[4],7,$header[1],1,0,'C',true);
    $pdf->Ln();
    $pdf->SetFont('Arial','',11);
    // Color and font restoration

    // Data
    $fill = false;
    for($i=0;$i<count($tmp);$i++)
    {
      if($tmp[$i]["prio"]==0) $prio="";
      else if($tmp[$i]["prio"]==1) $prio="Ja";
      $pdf->Cell($w[0],6,$tmp[$i]["aufgabe"],'LRTB',0,'L',$fill);
      $pdf->Cell($w[1],6,$tmp[$i]["dauer"],'LRTB',0,'C',$fill);
      $pdf->Cell($w[2],6,$tmp[$i]["datum"],'LRTB',0,'C',$fill);
      $pdf->Cell($w[3],6,$prio,'LRTB',0,'C',$fill);
      $pdf->Cell($w[4],6,"",'LRTB',0,'C',$fill);
      $pdf->Ln();
      $fill = !$fill;
    }
    $pdf->Ln();
    $pdf->SetFont('Arial','',8);
    $name=preg_replace("/[^a-zA-Z0-9_]/" , "" , str_replace(' ','_',$this->app->User->GetName()));
    $name = strtoupper($name);

    $pdf->Cell(array_sum($w),0,date('Ymd')."_".$name."_TODO.pdf",'',0,'R');

    $pdf->Output(date('Ymd')."_".$name."_TODO.pdf",'D');
    exit;
  }

  function AufgabenDelete()
  {
    $id = $this->app->Secure->GetGET("id");

    $check = $this->app->DB->Select("Select initiator FROM aufgabe WHERE id='$id' LIMIT 1");

    if($check==$this->app->User->GetAdresse() || $this->app->User->GetType()=="admin")
    {
      $this->app->DB->Update("DELETE FROM aufgabe WHERE id='$id' LIMIT 1");
      $msg = base64_encode("<div class=\"error2\">Die Aufgabe wurde gel&ouml;scht!</div>");
    } else {
      $msg = base64_encode("<div class=\"error2\">Die Aufgabe darf nur vom Initiator gel&ouml;scht werden!</div>");
    }
    header("Location: index.php?module=aufgaben&action=list&msg=$msg");
    exit;
  }


  function AufgabenAbschluss()
  {
    $id = $this->app->Secure->GetGET("id");
    $back = $this->app->Secure->GetGET("back");
    $referrer = $this->app->Secure->GetGET("referrer");

    // einmalig immer weg

    // aufgaben kopieren und dann wenn intervall_tage 2 = woechen 3 monatlich 4 jaehrlich
    // alles kopieren 1:1 neue hat mit dem datum von turnus +1 tag + 7 Tage oder monatlich immer wieder dann rein

    // ab taeglich kann man nur abschliessen abgabe_bis <= heute ist
    $result = $this->app->erp->AbschlussAufgabe($id);

    //$this->app->DB->Update("UPDATE aufgabe SET status='abgeschlossen',abgeschlossen_am=NOW() WHERE id='$id' LIMIT 1");
    if($result <=0)
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Die Aufgabe ist eine wiederholende und liegt in der Zukunft und darf noch nicht abgeschlossen werden!</div>");
    else {
      $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Die Aufgabe wurde abgeschlossen!</div>");

      $data = $this->app->DB->SelectArr("SELECT * FROM aufgabe WHERE id='$id' LIMIT 1");
      if($data[0]['zeiterfassung_pflicht']=="1")
      { 
        $mitarbeiter = $this->app->User->GetAdresse();
        $newid = $this->app->erp->AddArbeitszeit($mitarbeiter, date('Y-m-d H:00'),"", $data[0]['aufgabe'],$data[0]['beschreibung'],"",
           "", "","arbeit",$data[0]['kunde'],$data[0]['zeiterfassung_abrechnung'],"","","","",$id);   

        if($back=="")$back = "aufgabe";
        header("Location: index.php?module=zeiterfassung&action=create&id=$newid&back=$back");
        exit;
      }

    }

    if($referrer=="1")
      header("Location: index.php?msg=$msg");
    else {
      if($back=="wochenplan")
        header("Location: index.php?module=aufgaben&action=list&cmd=wochenplan&msg=$msg");
      else
        header("Location: index.php?module=aufgaben&action=list&msg=$msg");
    }
    exit;
  }

  function AufgabenKalender()
  {
    $this->AufgabenMenu();
    $adr_id = $this->app->User->GetAdresse();
    $this->app->erp->Wochenplan($adr_id,TAB1);
    $this->app->Tpl->Set(AKTIV_TAB1,"selected");
    $this->app->Tpl->Parse(PAGE,"aufgabenkalender.tpl");
  }

  function AufgabenCreate()
  {

    //$this->app->erp->MenuEintrag("index.php?module=artikel&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    $this->app->Tpl->Set(ABBRECHEN,"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=aufgaben&action=list';\">");
    parent::AufgabeCreate();

  }

  function AufgabenList()
  {
    $this->AufgabenMenu();
    $cmd = $this->app->Secure->GetGET("cmd");

    //$this->app->erp->MenuEintrag("index.php?module=aufgaben&action=list&rand=".time()."#tabs-3","Neue Aufgabe");
/*
    // neue aufgabe
    $widget = new WidgetAufgabe($this->app,NEUEAUFGABE); 
    $widget->form->SpecialActionAfterExecute("none",
        "index.php?module=aufgaben&action=list#tabs-1");


    $widget->Create();
*/


    if($this->app->erp->RechteVorhanden("aufgaben","pdfextern"))
    {
      $this->app->Tpl->Set(EXTERNELISTE,'<a href="index.php?module=aufgaben&action=pdfextern">Externe Aufgaben-Liste als PDF</a>');
    }

    /* offene Aufgabens */
    $adresse = $this->app->User->GetAdresse();

    if($this->app->User->GetType()=="admin")
    {
      $mitarbeiter_arr = $this->app->erp->GetMitarbeiter();
      $sid = $this->app->Secure->GetGET("sid");
      $cmd = $this->app->Secure->GetGET("cmd");

      if($sid=="") $sid = $this->app->User->GetParameter("aufgabe_benutzer_simulieren");

      if($sid!="") {
        $adresse = $sid;
        $this->app->Tpl->Set(MITARBEITER,$sid);
        $this->app->User->SetParameter("aufgabe_benutzer_simulieren",$sid);
      }

      for($mi=0;$mi<count($mitarbeiter_arr);$mi++)
      {
        if($adresse==$mitarbeiter_arr[$mi]['id']) {
	  $selected = "selected"; 
	} else {
	  $selected="";
	}
        $options .= "<option value=\"".$mitarbeiter_arr[$mi]['id']."\" $selected>".$mitarbeiter_arr[$mi]['name']."</option>";
      }

      if($this->app->User->GetParameter("aufgabe_benutzer_simulieren") > 0 && $this->app->User->GetParameter("aufgabe_benutzer_simulieren")!=$this->app->User->GetAdresse())
      {
	$name = $this->app->DB->Select("SELECT CONCAT(mitarbeiternummer,' ',name) FROM adresse WHERE id='".$this->app->User->GetParameter("aufgabe_benutzer_simulieren")."' LIMIT 1");
	$color = "#E5F5D2";
	$this->app->Tpl->Set(KURZUEBERSCHRIFT2,$name);
      } else {

	$name = $this->app->DB->Select("SELECT CONCAT(mitarbeiternummer,' ',name) FROM adresse WHERE id='".$this->app->User->GetAdresse()."' LIMIT 1");
	$this->app->Tpl->Set(KURZUEBERSCHRIFT2,$name);
      }
      $this->app->Tpl->Set(RTABSELECT,"
      <select style=\"background-color:$color;\" name=\"mitarbeiter\" id=\"mitarbeiter\" onchange=\"window.location.href='index.php?module=aufgaben&action=list&cmd=$cmd&sid=' + this.value\">".$options."</select>");
    }

    if($cmd=="wochenplan")
    {
      $this->app->Tpl->Add(ANZEIGE,$this->AufgabenWochenplan($adresse));
      if($this->app->User->GetType()=="admin")
      {
        $this->app->Tpl->Add(ANZEIGE,$this->AufgabenWochenplan($adresse,1));
        $this->app->Tpl->Add(ANZEIGE,$this->AufgabenWochenplan($adresse,2));
      }
      $this->app->Tpl->Set(AKTIVWOCHENPLAN,"aktiv");
    } else {
      $this->app->Tpl->Set(AKTIVAUFGABENLISTE,"aktiv");
      $this->app->Tpl->Parse(ANZEIGE,"aufgabenuebersicht_filtermeine.tpl");
      $this->app->YUI->TableSearch(ANZEIGE,"aufgaben_meine");
    }
    $this->app->YUI->TableSearch(WIEDERHOLENDE,"aufgabenwdh");
    $this->app->YUI->TableSearch(ALLE,"aufgaben");
    $this->app->YUI->TableSearch(AUFGABENARCHIV,"aufgaben_archiv");

    $this->app->Tpl->Parse(PAGE,"aufgabenuebersicht.tpl");
  }

  function AufgabenWochenplan($adresse=0,$moveweek=0)//,$jahr="",$woche="")
  {

      if($jahr=="") $jahr=date('Y');
      if($woche=="")$woche=date('W');

      if($moveweek > 0)
      {
        $jahr = date('Y',strtotime("+$moveweek week"));
        $woche = date('W',strtotime("+$moveweek week"));
      } else if ($moveweek <0)
      {
        $jahr = date('Y',strtotime("-$moveweek week"));
        $woche = date('W',strtotime("-$moveweek week"));
      }

      $tag[0] = "So";
      $tag[1] = "Mo";
      $tag[2] = "Di";
      $tag[3] = "Mi";
      $tag[4] = "Do";
      $tag[5] = "Fr";
      $tag[6] = "Sa";


      $tpl  = '
      <center>Jahr '.$jahr.' KW '.$woche.'</center><table class="mkTable" width="100%">';

     $timestamp_montag = strtotime("{$jahr}-W{$woche}");

      for($i=0;$i<7;$i++)
      {
        $datum = date("Y-m-d", $timestamp_montag) ;
        $timestamp_montag += 3600*24;

        $erste_zeiterfassung = $this->app->DB->Select("SELECT DATE_FORMAT(MIN(von),'%H:%i') FROM zeiterfassung WHERE adresse='$adresse' AND DATE_FORMAT(von,'%Y-%m-%d')='$datum'");
        $letzte_zeiterfassung = $this->app->DB->Select("SELECT DATE_FORMAT(MAX(bis),'%H:%i') FROM zeiterfassung WHERE adresse='$adresse' AND DATE_FORMAT(von,'%Y-%m-%d')='$datum'");

        // alle aufgaben von dem Tag
        if($adresse==0)
        {
          $tmp = $this->app->DB->SelectArr("SELECT * FROM aufgabe WHERE DATE_FORMAT(abgabe_bis,'%Y-%m-%d')='$datum' ORDER by sort,abgabe_bis,id");
        }
        else
        {
          $tmp = $this->app->DB->SelectArr("SELECT * FROM aufgabe WHERE DATE_FORMAT(abgabe_bis,'%Y-%m-%d')='$datum' AND adresse='".$adresse."' ORDER by sort,abgabe_bis,id");
          $summe_dauer = $this->app->DB->Select("SELECT SUM(stunden) FROM aufgabe WHERE DATE_FORMAT(abgabe_bis,'%Y-%m-%d')='$datum' AND adresse='".$adresse."'");
          $summe_dauer_abrechnen = $this->app->DB->Select("SELECT SUM(stunden) FROM aufgabe WHERE DATE_FORMAT(abgabe_bis,'%Y-%m-%d')='$datum' 
            AND adresse='".$adresse."' AND zeiterfasung_abrechnung=1");
          if($summe_dauer<=0) $summe_dauer=0;
          if($summe_dauer_abrechnen<=0) $summe_dauer_abrechnen=0;
        }
        $tmp_td = '';
        $tmp_td .= '<ul style="min-height: 30px; padding: 0; margin: 0; list-style: none;" class="drag_drop_list">';
        for($tmpi=0;$tmpi<count($tmp);$tmpi++)
        {
          $kunde = $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$tmp[$tmpi]['kunde']."' LIMIT 1");

          if($kunde != "") {
            $kunde = $kunde."<br>";
          }

          if($tmp[$tmpi]['stunden'] > 0) {
            $dauer = "<i style=\"color:grey\"><br>".$kunde."Geplant: ".$tmp[$tmpi]['stunden']." (h)</i>";
          } else {
            $dauer="";
          }

          $style = array();
          $style[] = 'font-size: 8pt;';
          $style[] = 'border: 2px solid #E0E0E0;';
          $style[] = 'cursor: pointer;';
          $style[] = 'position: absolute;';

          if($tmp[$tmpi]['status']=="abgeschlossen") {
            // $background_aufgabe = "#f0f0f0";
            // $color_aufgabe = "#aaa";
            $gedauert = $this->app->erp->ZeitGesamtAufgabe($tmp[$tmpi]['id']);
            if($gedauert > 0) $gedauert = "<br><i>Gebucht: ".number_format($gedauert,2)." (h)</i>"; else $gedauert="";
            $dauer .=$gedauert;

            $style[] = 'color: #AAA;';
            $style[] = 'background: #F0F0F0;';
          } else {
            // $background_aufgabe = "#D5ECF2";
            // $color_aufgabe = "black";
            $style[] = 'color: #000;';
            $style[] = 'background: #D5ECF2;';
          }

          $tmp_td .= '<li class="drag_drop_aufgabe drag_drop_relative" data-id="' . $tmp[$tmpi]['id'] . '" style="' . implode(' ', $style) . '">';
            $tmp_td .= '<table style="border:0;background:none; width:100%;">';
              $tmp_td .= '<tr>';
                $tmp_td .= '<td valign="top" style="border:0;background:none;">';
                  $tmp_td .= '<a style="" href="index.php?module=aufgaben&action=edit&id=' . $tmp[$tmpi]['id'] . '&back=wochenplan#tabs-3"><img src="themes/new/images/edit.png" height="20"></a>';
              $tmp_td .= '</td>';
              $tmp_td .= '<td valign="middle" style="border:0;background:none;">';
                $tmp_td .= '<span style="display: inline-block;"> ' . $tmp[$tmpi]['aufgabe'].$dauer . '</span>';
              $tmp_td .= '</td>';
            $tmp_td .= '</tr>';
          $tmp_td .= '</table>';
        $tmp_td .= '<li>';

        // $tmp_td .= "<li class=\"drag_drop_aufgabe\" data-id=\"" . $tmp[$tmpi]['id'] . "\" style=\"background-color:$background_aufgabe;border: 1px solid #E0E0E0;cursor:pointer;\" ><a onclick=\"window.location.href='index.php?module=aufgaben&action=edit&id=".$tmp[$tmpi]['id']."&back=wochenplan#tabs-3'\"><img src=\"themes/new/images/edit.png\" height=20></a> ".$tmp[$tmpi]['aufgabe'].$dauer."</li>";
      }

      $tmp_td .= "</ul>";
      if(date('Y-m-d')==$datum) {
        $background="style=\"background-color:white; color:red; border: 1px solid #E0E0E0;\""; 
      } else {
        $background="";
      }

      $tpl1 .= "<th width=\"14%\" $background>".$tag[date('w',strtotime($datum))].". ".date('d.m',strtotime($datum))."</th>";
      if($this->app->User->GetType()=="admin")
      {
        if($erste_zeiterfassung!="") { $strich = "-";  $arbeit="A:";}
	else { $strich=""; $arbeit="";}
        $tpl2 .= "
      <td>
      <table cellpadding=\"0\" cellspacing=\"0\" style=\"padding:0px;font-size:8pt;width:100%\">
      <tr><td style=\"padding:0px\">Geplant:</td><td style=\"padding:0px\">".$this->app->erp->ZeitInStundenMinuten($summe_dauer)."</td></tr>
      <tr><td style=\"padding:0px\">Mitarbeiter Soll:</td><td style=\"padding:0px\">".$this->app->erp->ZeitInStundenMinuten($this->app->erp->ZeitSollDatumArbeit($adresse,$datum))."</td></tr>
      <tr><td style=\"padding:0px\">Abrechnen Soll:</td><td style=\"padding:0px\">".$this->app->erp->ZeitInStundenMinuten($summe_dauer_abrechnen)."</td></tr>
      <tr><td style=\"padding:0px\">Mitarbeiter Ist:</td><td style=\"padding:0px\">".$this->app->erp->ZeitInStundenMinuten($this->app->erp->ZeitGesamtDatumArbeit($adresse,$datum))."</td></tr>
      <!--<tr><td style=\"padding:0px\">Mitarbeiter Pause:</td><td style=\"padding:0px\">".$this->app->erp->ZeitInStundenMinuten($this->app->erp->ZeitGesamtDatumPause($adresse,$datum))."</td></tr>-->
      <tr><td style=\"padding:0px\">Abrechnen Ist: </td><td style=\"padding:0px\">".$this->app->erp->ZeitInStundenMinuten($this->app->erp->ZeitGesamtDatumArbeitAbrechnen($adresse,$datum))."</td></tr>
      </table>
<!--	  <i style=\"padding:0px;font-size:8pt;\">$arbeit $erste_zeiterfassung $strich $letzte_zeiterfassung</i>-->
        </td>";
      } else {
        $tpl2 .= "<td><table cellpadding=\"0\" cellspacing=\"0\" style=\"padding:0px;font-size:8pt;width:100%\">
          <tr style=\"font-size:8pt;\"><td style=\"padding:0px\">Arbeitsstunden:</td><td style=\"padding:0px\">".
          number_format($this->app->erp->ZeitSollDatumArbeit($adresse,$datum),2)."</td></tr>
          <tr style=\"font-size:8pt;\"><td style=\"padding:0px\">Zeiterfassung:</td><td style=\"padding:0px\">".
          number_format($this->app->erp->ZeitGesamtDatumArbeit($adresse,$datum),2)."</td></tr></table></td>";

      }
      $tpl3 .= '<td style="min-height:60px" data-datum="' . $datum . '">' . $tmp_td . '</td>';
    }

    

    $tpl .='<tr valign="top">'.$tpl1.'</tr>';
    $tpl .='<tr valign="top">'.$tpl2.'</tr>';
    $tpl .='<tr valign="top" class="drag_drop_datum">'.$tpl3.'</tr>';
    $tpl .='</table><br><br>';

    return $tpl;
  }


  /* inhalt des popup fenster */
  function AufgabenEdit()
  {
    //$this->app->erp->StartseiteMenu();
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->MenuEintrag("index.php?module=aufgaben&action=edit&id=$id","Details");
    $this->app->erp->MenuEintrag("index.php?module=aufgaben&action=dateien&id=$id","Dateien");
/*
    $back = $this->app->Secure->GetGET("back");
    $cmd = $this->app->Secure->GetGET("cmd");
    $pinwand = $this->app->Secure->GetGET("pinwand");

    if($cmd=="list")   {
      header("Location: index.php?module=aufgaben&action=list");
      exit;
    }
    else if ($cmd=="popup")
    {
      $this->app->BuildNavigation=false;
    }

    $this->AufgabenMenu();
    $id = $this->app->Secure->GetGET("id");

    if($back=="wochenplan") $cmd = "wochenplan";

    if($cmd!="popup")
    {
      $this->app->Tpl->Set(ABBRECHEN,"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=aufgaben&action=list&cmd=$cmd#tabs-1';\">");
      $this->app->Tpl->Set(AUFGABEABSCHLIESSEN,"<input type=\"button\" value=\"Aufgabe abschlie&szlig;en\" onclick=\"FinalDialog('index.php?module=aufgaben&action=abschluss&back=$back&id=$id')\">");
    }
    $widget = new WidgetAufgabe($this->app,NEUEAUFGABE); 
    if($back=="alle")
    {
      $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=aufgaben&action=list#tabs-2");
    } 
    else if ($back=="wochenplan") {
      $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=aufgaben&action=list&cmd=wochenplan#tabs-1");
    }
    else if($cmd=="popup"){
      $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=welcome&action=pinwand&rand=".time()."&pinwand=".$pinwand."#tabs-1");
    }
    else {
      $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=aufgaben&action=list#tabs-1");
    }
    $widget->Edit();

    if($cmd=="popup"){
      $this->app->Tpl->Parse(PAGE,"aufgabe_popup.tpl");
    } else {
      $this->app->Tpl->Parse(PAGE,"aufgabenuebersicht.tpl");
    }
*/

    $this->app->Tpl->Set(ABBRECHEN,"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=aufgaben&action=list';\">");
parent::AufgabeEdit();
  }

  function AufgabenEditWdh()
  {
    $this->AufgabenMenu();
    $this->app->Tpl->Set(ABBRECHEN,"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=aufgaben&action=list#tabs-2';\">");
    $widget = new WidgetAufgabe($this->app,NEUEAUFGABE); 
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=aufgaben&action=list#tabs-2");

    $widget->Edit();

    $this->app->Tpl->Parse(PAGE,"aufgabenuebersicht.tpl");
  }

  function AufgabenDrapDrop() {

    $aufgabeId = $this->app->Secure->GetGET('aufgabeId');
    $aufgabeDatum = $this->app->Secure->GetGET('aufgabeDatum');

    if ($aufgabeId && $aufgabeDatum) {
      $this->app->DB->Update('
        UPDATE aufgabe SET abgabe_bis = "' . $aufgabeDatum . '" WHERE id = "' . $aufgabeId . '"
      ');
      echo json_encode(array(
        'status' => 1,
        'statusText' => 'Gespeichert',
        'debug' => $_GET
      ));
      exit;
    }

    echo json_encode(array(
      'status' => 0,
      'statusText' => 'Fehler',
      'debug' => $_GET
    ));
    exit;
  }

  function AufgabenSort() {

    $idList = $this->app->Secure->GetGET('idList');
    if ($idList) {
      $pos = 1;
      foreach ($idList as $id) {
        $this->app->DB->Update('UPDATE aufgabe SET sort = ' . $pos . ' WHERE id = ' . $id);
        $pos++;
      }
    }

    echo json_encode(array(
      'status' => 1,
      'statusText' => 'Gepsichert'
    ));

  }

}

?>
