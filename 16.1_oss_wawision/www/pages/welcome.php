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
class Welcome 
{

  function Welcome(&$app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("login","WelcomeLogin");
    $this->app->ActionHandler("main","WelcomeMain");
    $this->app->ActionHandler("poll","WelcomePoll");
    $this->app->ActionHandler("list","TermineList");
    $this->app->ActionHandler("cronjob","WelcomeCronjob");
    $this->app->ActionHandler("adapterbox","WelcomeAdapterbox");
    $this->app->ActionHandler("help","WelcomeHelp");
    $this->app->ActionHandler("info","WelcomeInfo");
    $this->app->ActionHandler("icons","WelcomeIcons");
    $this->app->ActionHandler("vorgang","VorgangAnlegen");
    $this->app->ActionHandler("removevorgang","VorgangEntfernen");
    $this->app->ActionHandler("editvorgang","VorgangEdit");
    $this->app->ActionHandler("logout","WelcomeLogout");
    $this->app->ActionHandler("start","WelcomeStart");
    $this->app->ActionHandler("list","WelcomeStart");
    $this->app->ActionHandler("settings","WelcomeSettings");
    $this->app->ActionHandler("upgrade","WelcomeUpgrade");
    $this->app->ActionHandler("upgradedb","WelcomeUpgradeDB");
    $this->app->ActionHandler("startseite","WelcomeStartseite");
    
    $this->app->ActionHandler("addnote","WelcomeAddNote");
    $this->app->ActionHandler("addpinwand","WelcomeAddPinwand");
    $this->app->ActionHandler("movenote","WelcomeMoveNote");
    $this->app->ActionHandler("oknote","WelcomeOkNote");
    $this->app->ActionHandler("delnote","WelcomeDelNote");
    $this->app->ActionHandler("pinwand","WelcomePinwand");
    
    $this->app->ActionHandler("css","WelcomeCss");
    $this->app->ActionHandler("logo","WelcomeLogo");
    $this->app->ActionHandler("unlock","WelcomeUnlock");
    $this->app->ActionHandler("direktzugriff","WelcomeDirektzugriff");

    $this->app->DefaultActionHandler("login");

    $this->app->ActionHandlerListen($app);
  }
 
  
  function WelcomePoll()
  {
    $smodule = $this->app->Secure->GetGET("smodule");
    $saction = $this->app->Secure->GetGET("saction");
    $sid = $this->app->Secure->GetGET("sid");
    $user = $this->app->Secure->GetGET("user");

    $this->app->erp->TimeoutUseredit($smodule,$sid,$user);

    
    $result = $this->app->erp->UserEvent();
    if($result['event']!="")
    {
      echo json_encode($result);
    } else {
      echo json_encode(array());
    }
    //uodate nur erlauben wenn time stamp in 		
    //echo "red";
    exit;
  }	


  function WelcomeDirektzugriff()
  {
    $direktzugriff = $this->app->Secure->GetPOST("direktzugriff");


    switch($direktzugriff)
    {
      case "1": $link="index.php?module=adresse&action=list"; break;
      case "11": $link="index.php?module=adresse&action=list"; break;
      case "12": $link="index.php?module=artikel&action=list"; break;
      case "13": $link="index.php?module=projekt&action=list"; break;

      case "2": $link="index.php?module=angebot&action=list"; break;
      case "21": $link="index.php?module=anfrage&action=list"; break;
      case "22": $link="index.php?module=angebot&action=list"; break;
      case "23": $link="index.php?module=auftrag&action=list"; break;

      case "3": $link="index.php?module=bestellung&action=list"; break;
      case "31": $link="index.php?module=bestellung&action=list"; break;
      case "32": $link="index.php?module=lager&action=ausgehend"; break;
      case "33": $link="index.php?module=produktion&action=list"; break;

      case "5": $link="index.php?module=rechnung&action=list"; break;

      case "8": $link="index.php?module=lieferschein&action=list"; break;
      case "81": $link="index.php?module=lieferschein&action=list"; break;
      case "82": $link="index.php?module=lager&action=list"; break;
      case "84": $link="index.php?module=versanderzeugen&action=offene"; break;
      default: $link="index.php";
    }

    header("Location: $link");
    exit;
  }

  function WelcomeAdapterbox()
  {
    $ip = $this->app->Secure->GetGET("ip");
    $serial = $this->app->Secure->GetGET("serial");
    $device = $this->app->Secure->GetGET("device");
    if(is_numeric($ip))
      $ip = long2ip($ip);
    else $ip="";

    echo "OK";
    $this->app->DB->Delete("DELETE FROM adapterbox_log WHERE ip='$ip'");
    $this->app->DB->Insert("INSERT INTO adapterbox_log (id,datum,ip,meldung,seriennummer,device)
        VALUES ('',NOW(),'$ip','Adapterbox connected ($device)','$serial','device')");


    // check if there is an adapterbox
    $anzahldrucker = $this->app->DB->Select("SELECT COUNT(id) FROM drucker WHERE art=2 AND anbindung='adapterbox'");

    if($anzahldrucker <= 0 && $device=="zebra")
    {
      $this->app->DB->Insert("INSERT INTO drucker (id,art,anbindung,adapterboxseriennummer,bezeichnung,name,aktiv,firma)
          VALUES ('','2','adapterbox','$serial','Zebra','Etikettendrucker',1,1)");
      $tmpid = $this->app->DB->GetInsertID();

      $this->app->erp->FirmendatenSet("standardetikettendrucker",$tmpid);
    }

    $xml ='
      <label>
      <line x="3" y="3" size="4">Step 2 of 2</line>
      <line x="3" y="8" size="4">Connection establish</line>
      <line x="3" y="13" size="4">Server: '.$_SERVER['SERVER_ADDR'].'</line>
      </label>
      ';

    if($this->app->erp->Firmendaten("deviceenable")!="1")
    {
      //HttpClient::quickPost("http://".$ip."/labelprinter.php?amount=1",array('label'=>$xml,'amount'=>1));
      //$this->app->erp->EtikettenDrucker("xml",1,"","","",$xml);
    } else {
      $job = base64_encode(json_encode(array('label'=>base64_encode($xml),'amount'=>$anzahl)));//."<amount>".$anzahl."</amount>");
      $this->app->DB->Insert("INSERT INTO device_jobs (id,zeitstempel,deviceidsource,deviceiddest,job,art) VALUES ('',NOW(),'000000000','$serial','$job','labelprinter')");
    }	


    // update ip
    if($ip!="")
      $this->app->DB->Update("UPDATE drucker SET adapterboxip='$ip' WHERE adapterboxseriennummer='$serial' LIMIT 1");

    //uodate nur erlauben wenn time stamp in 		
    //echo "red";
    exit;
  }	




  function WelcomeCronjob()
  {
    system("php5 ../cronjobs/starter.php");
    exit;
  }	

  function WelcomeStart()
  {

    if($this->app->erp->UserDevice()=="smartphone")
    {
      $this->WelcomeStartSmartphone();
    } else {
      $this->WelcomeStartDesktop();
    }
  }

  function WelcomeStartSmartphone()
  {
    header("Location: index.php?module=mobile&action=list");
    exit;
  }

  function WelcomeStartDesktop()
  {
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Ihre Startseite");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT2',"[BENUTZER]");
    $this->app->erp->StartseiteMenu();

    $this->app->Tpl->Set('TABTEXT',"Ihre Startseite");

    $module = $this->app->Secure->GetGET("module");


    //fenster rechts offene vorgaenge ***
    $this->app->Tpl->Set('SUBSUBHEADING',"Vorg&auml;nge");
    $arrVorgaenge = $this->app->DB->SelectArr("SELECT * FROM offenevorgaenge WHERE adresse='{$this->app->User->GetAdresse()}' ORDER by id DESC");
    $this->app->Tpl->Set('INHALT',"");
    if(count($arrVorgaenge) > 0)
    {
      for($i=0;$i<count($arrVorgaenge);$i++)
      {

        $this->app->Tpl->Add('VORGAENGE',"<tr><td>".substr(ucfirst($arrVorgaenge[$i]['titel']),0,100)."</td><td align=\"right\"><img src=\"./themes/[THEME]/images/1x1t.gif\" width=\"7\" border=\"0\" align=\"right\">
            <a href=\"index.php?".$arrVorgaenge[$i]['href']."\"><img src=\"./themes/[THEME]/images/right.png\" border=\"0\" align=\"right\" title=\"Erledigen\"></a>&nbsp;
            <a href=\"index.php?module=welcome&action=removevorgang&vorgang={$arrVorgaenge[$i]['id']}\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\" align=\"right\" title=\"Erledigt\"></a>&nbsp;
            <img src=\"./themes/[THEME]/images/1x1t.gif\" width=\"3\" border=\"0\" align=\"right\">
            <a href=\"javascript: var ergebnistext=prompt('Offenen Vorgang umbenennen:','".ucfirst($arrVorgaenge[$i]['titel'])."'); if(ergebnistext!='' && ergebnistext!=null) window.location.href='index.php?module=welcome&action=editvorgang&vorgang={$arrVorgaenge[$i]['id']}&titel='+ergebnistext;\"><img src=\"./themes/[THEME]/images/edit.png\" alt=\"Bearbeiten\" title=\"Bearbeiten\" border=\"0\" align=\"right\"></a></td></tr>");

      }
    }

    $this->app->erp->KalenderList('KALENDER');

    $this->app->Tpl->Parse('STARTSEITE',"lesezeichen.tpl");

    if($this->app->User->GetType()=="admin")
    {
      $tmpprojects = $this->app->DB->SelectArr("SELECT id,abkuerzung FROM projekt WHERE geloescht='0' ORDER by abkuerzung");

      $montag = $this->app->erp->getFirstDayOfWeek(date('Y'), date('W'));

      for($i=0;$i<count($tmpprojects);$i++)
      {
        $projektid = $tmpprojects[$i]['id'];
        $abkuerzung = $tmpprojects[$i]['abkuerzung'];
        $summe_auftraege = $this->app->DB->Select("SELECT SUM(ap.preis*ap.menge) FROM auftrag a LEFT JOIN
            auftrag_position ap ON ap.auftrag=a.id LEFT JOIN artikel art ON art.id=ap.artikel WHERE 
            art.projekt='$projektid' AND a.datum >='$montag' ");

        $gesamtsumme += $summe_auftraege;

        setlocale(LC_MONETARY, 'de_DE');

        if($summe_auftraege > 0)
        {
          $tpl .='<tr><td>'.$abkuerzung.'</td><td align="right"> '.money_format('%= ^-14#8.2i',$summe_auftraege).' EUR</td></tr>';
        }
      }
      /*
         $sql = "SELECT FLOOR(SUM(FORMAT(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600,2)))
         FROM zeiterfassung z WHERE z.abrechnen=1 AND z.ist_abgerechnet!=1 AND z.adresse_abrechnung > 0 AND 
         DATE_FORMAT(z.von,'%Y-%m-%d') >='$montag'";

         $gesamt_stunden = $this->app->DB->Select($sql);
         $tpl .='<tr><td>Gesamt (netto)</td><td align="right">'.money_format('%= ^-14#8.2i',$gesamtsumme).' EUR</td></tr>';
         $tpl .='<tr><td>Gebuchte Stunden</td><td align="right">'.money_format('%= ^-14#8.2i',$gesamt_stunden).'</td></tr>';
         $tpl .='<tr><td>mit Ausgaben (netto)</td><td align="right"><b>'.money_format('%= ^-14#8.2i',$gesamtsumme/100*20).' EUR</b></td></tr>';
         $tpl .='<tr><td>ca. Umsatz Stunden</td><td align="right"><b>'.money_format('%= ^-14#8.2i',$gesamt_stunden*65).' EUR</b></td></tr>';
       */			
      $this->app->Tpl->Set('UMSATZ','<h1 onmouseover="document.getElementById(\'umsatzwoche\').style.display=\'block\';" onmouseout="document.getElementById(\'umsatzwoche\').style.display=\'none\';">Umsatz ab Montag</h1>
          <div style="margin:5px;display:none" id="umsatzwoche"><table width="90%">
          '.$tpl.'
          </table>
          </div>
          <br>');
    }

    if($this->app->Conf->WFdbType=="postgre")
      $this->app->Tpl->Set('TERMINE', $this->Termine($this->app->DB->Select("SELECT CAST(now() AS date);")));
    else
      $this->app->Tpl->Set('TERMINE', $this->Termine($this->app->DB->Select("SELECT CURDATE();")));


    if($this->app->Conf->WFdbType=="postgre")
      $this->app->Tpl->Set('TERMINEMORGEN', $this->Termine($this->app->DB->Select("SELECT CAST(now() AS date) + INTERVAL '1 DAY'")));
    else	
      $this->app->Tpl->Set('TERMINEMORGEN', $this->Termine($this->app->DB->Select("SELECT DATE_ADD(CURDATE(), INTERVAL 1 DAY);")));

    if($this->app->Conf->WFdbType=="postgre") {
      $summestunden = $this->app->DB->Select("SELECT SUM((extract(epoch from z.bis)-extract(epoch from z.von))/3600.0) as stunden
          FROM zeiterfassung z WHERE z.abrechnen='1' AND z.ist_abgerechnet IS NULL OR z.ist_abgerechnet='0'");
    } else {
      $summestunden = $this->app->DB->Select("SELECT SUM((UNIX_TIMESTAMP(z.bis)-UNIX_TIMESTAMP(z.von))/3600.0) as stunden
          FROM zeiterfassung z WHERE z.abrechnen='1' AND z.ist_abgerechnet IS NULL OR z.ist_abgerechnet='0' AND z.adresse_abrechnung > 0");
    }

    if($summestunden > 0)
      $this->app->Tpl->Add('DRINGEND','<li>'.number_format($summestunden,2,',','.').' Stunden nicht abgerechnet (<a href="index.php?module=zeiterfassung&action=abrechnenpdf">PDF</a>)</li>');

    // reservierungen ohne auftraege
    /*
       $tmp = $this->app->DB->SelectArr("SELECT a.id,a.nummer, a.name_de, (SELECT SUM(ap.menge-ap.geliefert) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND auf.status='freigegeben') as auftrag,
       (SELECT SUM(l.menge) FROM lager_reserviert l WHERE l.artikel=a.id) as reserviert FROM artikel a WHERE (SELECT SUM(l.menge) FROM lager_reserviert l WHERE l.artikel=a.id) > (SELECT SUM(ap.menge-ap.geliefert) FROM auftrag_position ap LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE ap.artikel=a.id AND auf.status='freigegeben')");
    //(SELECT SUM(ap.menge-ap.geliefert) FROM auftrag_position ap WHERE ap.artikel=a.id)");

    if(count($tmp)>0)
    $this->app->Tpl->Add('DRINGEND','<li><b>Sonderreservierungen</b></li><ul style="list-style-position:outside;">');
    for($i=0;$i<count($tmp);$i++)
    {
    $this->app->Tpl->Add('DRINGEND','<li>'.$tmp[$i]['name_de'].'&nbsp;<a href="index.php?module=artikel&action=lager&id='.$tmp[$i]['id'].'"><img src="./themes/new/images/edit.png"></a></li>');

    }
    if(count($tmp)>0)
    $this->app->Tpl->Add('DRINGEND','</ul>');
     */


    // Wiki-Einträge
    //$data = $this->app->DB->SelectArr("SELECT * FROM accordion ORDER BY position");


    $this->app->Tpl->Set('USERNAME',$this->app->User->GetName());

    $tmp = $this->app->DB->SelectArr("SELECT * FROM aufgabe WHERE (adresse='".$this->app->User->GetAdresse()."' OR (initiator='".$this->app->User->GetAdresse()."' AND adresse<=0)) AND startseite='1' AND (status='offen' or status='') ORDER by prio DESC");
    //TODOFORUSER

    for($i=0;$i<count($tmp);$i++)
    {
      $name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$tmp[$i]['initiator']."' LIMIT 1");
      $high="";
      if($tmp[$i]['initiator']!=$tmp[$i]['adresse']) $additional = "<br><font style=\"font-size:8pt\">von ".$name."</font>"; else $additional="";


      if($tmp[$i]['prio']=="1") { $class="noteit_highprio"; $high="&nbsp;(Prio)"; }
      else $class="noteit";



$this->app->Tpl->Add('TODOFORUSER',"<tr><td>".$tmp[$i]['aufgabe'].$additional.$high."</td><td width=\"50\"><span style=\"cursor:pointer\" onclick=\"if(!confirm('Wirklich ".$tmp[$i]['aufgabe']." bearbeiten?')) return false; else window.location.href='index.php?module=aufgaben&action=edit&id=".$tmp[$i]['id']."&referrer=1#tabs-3';\"><img src=\"./themes/new/images/edit.png\"></span>
          <span style=\"cursor:pointer\" onclick=\"if(!confirm('Wirklich ".$tmp[$i]['aufgabe']." abschließen?')) return false; else window.location.href='index.php?module=aufgaben&action=abschluss&id=".$tmp[$i]['id']."&referrer=1';\"><img src=\"./themes/new/images/forward.png\"></span></td></tr>");


/*
  $this->app->Tpl->Add('TODOFORUSER',"<div class=\"$class\">".$tmp[$i]['aufgabe'].$additional."$high
<div style=\"text-align: right;
position:relative;
width: 100%;
top: -30px;\">
          <span style=\"cursor:pointer\" onclick=\"if(!confirm('Wirklich ".$tmp[$i]['aufgabe']." bearbeiten?')) return false; else window.location.href='index.php?module=aufgaben&action=edit&id=".$tmp[$i]['id']."&referrer=1#tabs-3';\"><img src=\"./themes/new/images/edit.png\"></span>
          <span style=\"cursor:pointer\" onclick=\"if(!confirm('Wirklich ".$tmp[$i]['aufgabe']." abschließen?')) return false; else window.location.href='index.php?module=aufgaben&action=abschluss&id=".$tmp[$i]['id']."&referrer=1';\"><img src=\"./themes/new/images/forward.png\"></span></div></div>
          ");
*/
    }

    if($i<=0)
      $this->app->Tpl->Add('TODOFORUSER',"<tr><td><center><i>Keine Aufgaben f&uuml;r die Startseite</i></center></td></tr>");

    $tmp = $this->app->DB->SelectArr("SELECT * FROM aufgabe WHERE initiator='".$this->app->User->GetAdresse()."' AND adresse!='".$this->app->User->GetAdresse()."' AND adresse > 0 AND startseite='1' AND status='offen' ORDER by prio DESC");

    if(count($tmp) > 0)
      $this->app->Tpl->Add('TODOFORMITARBEITER',"<h4>&nbsp;Vergebene Aufgaben:</h4>");


    for($i=0;$i<count($tmp);$i++)
    {
      $name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$tmp[$i]['adresse']."' LIMIT 1");
      $high="";
      if($tmp[$i]['prio']=="1") { $class="noteit_highprio"; $high="&nbsp;(Prio)"; }
      else $class="noteit";


      $this->app->Tpl->Add('TODOFORMITARBEITER',"<tr><td>".$tmp[$i]['aufgabe']."$high<br><font style=\"font-size:8pt\">f&uuml;r&nbsp;".$name."</font></td></tr>");





    }

    $this->app->Tpl->Set('ACCORDION', $this->Accordion());

    $ctx = stream_context_create(array(
    'http' => array(
        'timeout' => 1
        )
    )
    ); 

    $result_news = file_get_contents("http://www.wawision.de/news.php?version=".$this->app->erp->Version(),0, $ctx);

    if($result_news=="")
    {
      $result_news ="<ul><li><a href=\"http://www.wawision.de/\" target=\"_blank\">Link zur Homepage</a></li><li><a href=\"https://www.facebook.com/wawision\"  target=\"_blank\">Link zu Facebook</a></li></ul>";
    }


    $this->app->Tpl->Set('EXTERNALNEWS', $result_news);

    $result_handbook =  file_get_contents("http://www.wawision.de/handbook.php?version=".$this->app->erp->Version(),0, $ctx);
    if($result_handbook=="") 
    {
      $result_handbook='<ul>
<li><a href="http://helpdesk.wawision.de/doku.php?id=wawision:kurzanleitung_einrichtung_faq_leitfaden" target="_blank">Erste Schritte / Einstieg</a></li>
<li><a style="font-weight:normal" href="http://helpdesk.wawision.de/doku.php?id=wawision:kurzanleitung_import_von_stammdaten" target="_blank">Import von Stammdaten</a> <a href="http://helpdesk.wawision.de/doku.php?id=wawision:kurzanleitung_import_von_stammdaten" target="_blank">mehr</a></li>
<li><a style="font-weight:normal" href="http://helpdesk.wawision.de/doku.php?id=entwickler:backup" target="_blank">Automatisches Backup einrichten</a> <a href="http://helpdesk.wawision.de/doku.php?id=entwickler:backup" target="_blank">mehr</a></li>
<li><a href="http://helpdesk.wawision.de" target="_blank">Link zu Online-Handbuch</a></li>
<li><a href="http://forum.wawision.de" target="_blank">Forum f&uuml;r Open-Source Version</a></li><li><a href="http://www.wawision.de/support-uebersicht/" target="_blank">Supportvertr&auml;ge f&uuml;r WaWision</a></li></ul>';
    }

    $this->app->Tpl->Set('EXTERNALHANDBOOK', $result_handbook);



    $this->WaWisionUpgradeFeed();


    $this->app->Tpl->Parse('PAGE',"startseite.tpl");
    //    $this->app->Tpl->Parse(PAGE,"tabview.tpl");
  }


  function WelcomeIcons()
  {
    $type = $this->app->Secure->GetGET("type");
    header("Content-type: image/svg+xml");

    switch($type)
    {
      case "artikelgruppe.svg":
        $xml = file_get_contents("./images/icons/artikelgruppe.svg");
        break;
    }
    //style="fill:#3fb9cd; hintergrund"
    //style="fill:#e43f25;
    //style="fill:#a6e0be;
    //style="fill:#449cbe;

    $farbe1 = $this->app->erp->Firmendaten("firmenfarbeganzdunkel");

    if($farbe1 =="")
      $farbe1 = "rgb(7, 134, 153)";

    $farbe2 = "#e43f25"; // rot im artikel
    $farbe3 = "#a6e0be"; // hell tyrkis im artikel kreis
    $farbe4 = "#449cbe"; // dunkelblau im artikel rechteck 

    $xml = str_replace('#3fb9cd',$farbe1,$xml);
    $xml = str_replace('#e43f25',$farbe2,$xml);
    $xml = str_replace('#a6e0be',$farbe3,$xml);
    $xml = str_replace('#449cbe',$farbe4,$xml);

    echo $xml;
    exit;
  }

  function WelcomeLogo()
  {
    if($this->app->erp->Firmendaten("firmenlogo")!="")
    {
      header("Content-Type: image/png");
      echo base64_decode($this->app->erp->Firmendaten("firmenlogo"));
      exit;
    }

  }


  function WelcomeCss()
  {
    $file = $this->app->Secure->GetGET("file");

    if ($this->app->erp->UserDevice()=="smartphone") {

    } else { 

      if($file=="style.css")
        $tmp = file_get_contents("./themes/new/css/style.css");


      if($file=="popup.css")
        $tmp = file_get_contents("./themes/new/css/popup.css");


      if($file=="grid.css")
        $tmp = file_get_contents("./themes/new/css/grid.css");
    }	

    $firmenfarbehell = $this->app->erp->Firmendaten("firmenfarbehell");
    if($firmenfarbehell =="")
      $firmenfarbehell = "#c2e3ea";//rgb(67, 187, 209)"; //ALT

    $firmenfarbedunkel = $this->app->erp->Firmendaten("firmenfarbedunkel");
    if($firmenfarbedunkel =="")
      $firmenfarbedunkel = "#53bed0";//rgb(2, 125, 141)"; //ALT

    $firmenfarbeganzdunkel = $this->app->erp->Firmendaten("firmenfarbeganzdunkel");
    if($firmenfarbeganzdunkel =="")
      $firmenfarbeganzdunkel = "#018fa3";

    $navigationfarbe = $this->app->erp->Firmendaten("navigationfarbe"); //ALT
    if($navigationfarbe =="")
      $navigationfarbe = "#48494b";

    $navigationfarbeschrift = $this->app->erp->Firmendaten("navigationfarbeschrift");
    if($navigationfarbeschrift =="")
      $navigationfarbeschrift = "#c9c9cb";

    $unternavigationfarbe = $this->app->erp->Firmendaten("unternavigationfarbe");
    if($unternavigationfarbe =="")
      $unternavigationfarbe = "#d5ecf2";

    $unternavigationfarbeschrift = $this->app->erp->Firmendaten("unternavigationfarbeschrift");
    if($unternavigationfarbeschrift =="")
      $unternavigationfarbeschrift = "#027d8d";


    $firmenfarbe = $this->app->erp->Firmendaten("firmenfarbe");
    if($firmenfarbe =="")
      $firmenfarbe = "#48494b";	



    $tmp = str_replace("[TPLSYSTEMBASE]",$firmenfarbe,$tmp);

    //$firmenfarbehell = $this->app->erp->Firmendaten("firmenfarbehell");

    if($this->app->erp->Firmendaten("iconset_dunkel")=="1")
      $tmp = str_replace("[TPLNACHRICHTBOX]","rgba(255,255,255,0.5)",$tmp);
    else
      $tmp = str_replace("[TPLNACHRICHTBOX]","rgba(255,255,255,0.1)",$tmp);

    $tmp = str_replace("[TPLFIRMENFARBEHELL]",$firmenfarbehell,$tmp);
    $tmp = str_replace("[TPLFIRMENFARBEDUNKEL]",$firmenfarbedunkel,$tmp);
    $tmp = str_replace("[TPLFIRMENFARBEGANZDUNKEL]",$firmenfarbeganzdunkel,$tmp);
    $tmp = str_replace("[TPLNAVIGATIONFARBE]",$navigationfarbe,$tmp);
    $tmp = str_replace("[TPLNAVIGATIONFARBESCHRIFT]",$navigationfarbeschrift,$tmp);

    $tmp = str_replace("[TPLUNTERNAVIGATIONFARBE]",$unternavigationfarbe,$tmp);
    $tmp = str_replace("[TPLUNTERNAVIGATIONFARBESCHRIFT]",$unternavigationfarbeschrift,$tmp);


    $subaction = $this->app->Secure->GetGET("subaction");
    $submodule = $this->app->Secure->GetGET("submodule");
    if($subaction=="pinwand" || $subaction=="start" || $submodule=="kalender")
      $tmp = str_replace("[JSDMMZINDEX]","10000",$tmp);
    else
      $tmp = str_replace("[JSDMMZINDEX]","10",$tmp);


    if($this->app->erp->Firmendaten("standardaufloesung")=="1"){
      $tmp = str_replace("[CSSSMALL1]","1000",$tmp);
      $tmp = str_replace("[CSSSMALL2]","1000",$tmp);
      $tmp = str_replace("[CSSMARGIN]","margin-left: auto; margin-right: auto;",$tmp);
    } else {
      $tmp = str_replace("[CSSSMALL1]","1200",$tmp);
      $tmp = str_replace("[CSSSMALL2]","1200",$tmp);
      $tmp = str_replace("[CSSMARGIN]","margin-left: auto; margin-right: auto;",$tmp);
    }



    header("Content-type: text/css");
    echo $tmp;

    exit;

  }

  function WaWisionUpgradeFeed($max=3)
  {
    if(!$this->app->Conf->WFoffline)
    {
      //$branch = $this->app->erp->Branch();
      $version = $this->app->erp->Version();
      $revision = $this->app->erp->Revision();

      $tmp = explode('.',$revision);
      $branch = strtolower($version)."_".$tmp[0].".".$tmp[1];

      $BLOGURL = 'http://update.embedded-projects.net/wawision_2016.php?branch='.$branch; 
      $NUMITEMS = 2; $TIMEFORMAT = "j F Y, g:ia"; 
      $CACHEFILE = $this->app->erp->GetTMP().md5($BLOGURL); 
      $CACHETIME = 4; # hours


        if(!file_exists($CACHEFILE) || ((time() - filemtime($CACHEFILE)) > 3600 * $CACHETIME)) { 
          if($feed_contents = @file_get_contents($BLOGURL)) { 
            $fp = fopen($CACHEFILE, 'w'); 
            fwrite($fp, $feed_contents); 
            fclose($fp); 
          } 
        }
      $feed_contents = file_get_contents($CACHEFILE);


      $xml = simplexml_load_string($feed_contents);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);

      for($i=0;$i<count($array['channel']['item']);$i++)
      {
        $this->app->Tpl->Add('WAIWISONFEEDS',"<tr><td><b>".$array['channel']['item'][$i]['title']
            ."</b></td></tr><tr><td  style=\"font-size:7pt\">".$array['channel']['item'][$i]['description']."</td></tr>");
      }

      if($this->app->erp->Version()=="OSS")
      {
      $this->app->Tpl->Set('INFO',"<br>Sie verwenden die Open-Source Version. Wir bieten f&uuml;r diese an:
          <ul style=\"margin-left:-20px\"><li><a href=\"http://shop.wawision.de/sonstige/1-jahr-zugang-updateserver-open-source-version.html?c=164\" target=\"_blank\">Hotfix, Patches per Live-Update</a></li><li>Zubeh&ouml;r und Module im <a href=\"http://shop.wawision.de\" target=\"_blank\">AppStore</a></li></ul>");
      }

      $this->app->Tpl->Parse('WELCOMENEWS',"welcome_news.tpl");
    }
  }

  
  function WelcomeAddPinwand()
  {

    $user = $this->app->User->GetID();
    $users = $this->app->DB->SelectArr("SELECT u.id, a.name as description FROM user u LEFT JOIN adresse a ON a.id=u.adresse WHERE u.activ='1' ORDER BY u.username");
    for($i=0; $i<count($users);$i++){
      $select = (($user==$users[$i]['id']) ? "selected" : "");
      $user_out .= "<option value=\"{$users[$i]['id']}\" $select>{$users[$i]['description']}</option>";
    }
    $this->app->Tpl->Set('PERSONEN', $user_out);


    if($this->app->Secure->GetPOST("name")!="")
    {
      $name = $this->app->Secure->GetPOST("name");
      $personen = $this->app->Secure->GetPOST("personen");


      $this->app->DB->Insert("INSERT INTO pinwand (id,name,user) VALUES ('','$name','$user')");
      $pinwand = $this->app->DB->GetInsertID();

      for($i=0;$i<=count($personen);$i++)
      {
        if($personen[$i] > 0)
        {
          $this->app->DB->Insert("INSERT INTO pinwand_user (pinwand,user) VALUES ('$pinwand','".$personen[$i]."')");
        }
      }

      $this->app->Tpl->Set('PAGE', "<script>
          parent.location.href = './index.php?module=welcome&action=pinwand';
          </script>");
    }
    else 
      $this->app->Tpl->Parse('PAGE',"welcome_pinwand_addpinwand.tpl");

    $this->app->BuildNavigation=false;
  }

  function WelcomeAddNote()
  {
    $aufgabeid = (int)$this->app->Secure->GetGET("aufgabeid");
  
    if($this->app->Secure->GetPOST("note-body")!="")
    {
      $color = $this->app->Secure->GetPOST("color");
      $aufgabe = $this->app->Secure->GetPOST("note-body");
      $pinwand = $this->app->Secure->GetGET("pinwand");

      $aufgabe =  str_replace('\r\n',' ',$aufgabe);

      $beschreibung = $this->app->Secure->GetPOST("note-body");
      $max_z = $this->app->DB->Select("SELECT MAX(note_z) FROM aufgabe WHERE adresse='".$this->app->User->GetAdresse()."' ");
      $new = true;
      if($aufgabeid)
      {
        $cuid = $this->app->DB->Select("SELECT id FROM aufgabe WHERE adresse = '".$this->app->User->GetAdresse()."' AND id = ".$aufgabeid." LIMIT 1");
        if($cuid)
        {
          $new = false;
          $id = $cuid;
        }
      }
      if($new)$id = $this->app->erp->CreateAufgabe($this->app->User->GetAdresse(),$aufgabe);
      $this->app->DB->Update("UPDATE aufgabe SET pinwand='1',pinwand_id='$pinwand', note_color='$color', note_z='$max_z',beschreibung='$beschreibung' WHERE id='$id' LIMIT 1");

      $this->app->Tpl->Set('PAGE', "<script>
          parent.location.href = './index.php?module=welcome&action=pinwand&pinwand=$pinwand';
          </script>");
    }
    else {
      if($aufgabeid)
      {
        $aufg = $this->app->DB->SelectArr("SELECT * FROM aufgabe WHERE adresse = '".$this->app->User->GetAdresse()."' AND id = ".$aufgabeid." LIMIT 1");
        if($aufg)
        {
          $aufg = reset($aufg);
          $this->app->Tpl->Set('PADDNOTE_BODY',$aufg['beschreibung']);
          $this->app->Tpl->Set('PADDNOTE_JS',"
          <script type=\"text/javascript\">
          $(document).ready(function() {
            $('#paddnotecolor').val('".$aufg['note_color']."');
          });
          </script>
          ");
          
        }
        
      }
      
      $this->app->Tpl->Parse('PAGE',"welcome_pinwand_addnote.tpl");
    }

    $this->app->BuildNavigation=false;
  }

  function WelcomeDelNote()
  {
    $id = $this->app->Secure->GetGET("id");

    $pinwand = $this->app->Secure->GetGET("pinwand");

    $tmp = rand(8888,999999999);

    $this->app->DB->Update("DELETE FROM aufgabe WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=welcome&action=pinwand&pinwand=$pinwand");
    exit;
  }

  function WelcomeOkNote()
  {
    $id = $this->app->Secure->GetGET("id");
    $pinwand = $this->app->Secure->GetGET("pinwand");

    $this->app->erp->AbschlussAufgabe($id);
    //$this->app->DB->Update("UPDATE aufgabe SET status='abgeschlossen' WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=welcome&action=pinwand&pinwand=$pinwand");

    exit;
  }

  function WelcomeMoveNote()
  {
    $x = $this->app->Secure->GetGET("x");
    $y = $this->app->Secure->GetGET("y");
    $z = $this->app->Secure->GetGET("z");
    $id = $this->app->Secure->GetGET("id");

    $this->app->DB->Update("UPDATE aufgabe SET note_x='$x',note_y='$y',note_z='$z' WHERE id='$id' LIMIT 1");
    exit;
  }

  function WelcomePinwand()
  {
    $this->app->erp->StartseiteMenu();

    $pinwand = $this->app->Secure->GetGET("pinwand");

    if($pinwand <=0)
    {
      $tmp = $this->app->DB->SelectArr("SELECT * FROM aufgabe WHERE adresse='".$this->app->User->GetAdresse()."' AND pinwand='1' AND pinwand_id='0' AND status='offen'");
    } else {
      $tmp = $this->app->DB->SelectArr("SELECT * FROM aufgabe WHERE pinwand='1' AND pinwand_id='$pinwand' AND status='offen'");
    }  

    for($i=0;$i<count($tmp);$i++)
    {
      $left = $tmp[$i]['note_x'];
      $color = $tmp[$i]['note_color'];
      if($color=="")$color="yellow";
      $top = $tmp[$i]['note_y'];
      $zindex = $tmp[$i]['note_z'];
      $text = nl2br($this->app->erp->ReadyForPDF($tmp[$i]['beschreibung']));
      $id = $tmp[$i]['id'];
      $projekt = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='".$tmp[$i]['projekt']."' LIMIT 1");


      $result = ' <div class="note '.$color.'" style="left:'.$left.'px;top:'.$top.'px;  z-index:'.$zindex.'">
        '.$text.'  
        <div class="author">'.$projekt.'&nbsp;
      <!--<a href="index.php?module=aufgaben&action=edit&id='.$id.'&pinwand='.$pinwand.'&cmd=popup#tabs-3" target="_blank" title="Aufgabe bearbeiten" class="popup"><img src="./themes/[THEME]/images/edit.png"></a>&nbsp;-->
      <a href="index.php?module=welcome&action=addnote&aufgabeid='.$id.'&pinwand='.$pinwand.'&cmd=popup#tabs-3" target="_blank" title="Aufgabe bearbeiten" class="popup"><img src="./themes/[THEME]/images/edit.png"></a>&nbsp;
      <a href="index.php?module=welcome&action=delnote&id='.$id.'&pinwand='.$pinwand.'"><img src="./themes/[THEME]/images/delete.gif"></a>
        <a href="index.php?module=welcome&action=oknote&id='.$id.'&pinwand='.$pinwand.'"><img src="./themes/[THEME]/images/ok.png"></a>
        </div>
        <span class="data">'.$id.'</span>
        </div>';

      $this->app->Tpl->Add('NOTES',$result);
    }

    $this->app->Tpl->Set('POPUPWIDTH',"700");	
    $this->app->Tpl->Set('POPUPHEIGHT',"600");	

    $tmp = $this->app->DB->SelectArr("SELECT DISTINCT p.id,p.name FROM pinwand p 
      LEFT JOIN pinwand_user pu ON pu.pinwand=p.id WHERE (pu.user='".$this->app->User->GetID()."' OR p.user='".$this->app->User->GetID()."') ORDER by p.name");

    for($i=0;$i<count($tmp);$i++)
    {
      if($pinwand==$tmp[$i]['id']) $selected="selected"; else $selected="";
      $this->app->Tpl->Add('PINWAENDE',"<option value=\"".$tmp[$i]['id']."\" $selected>".$tmp[$i]['name']."</option>");
    }

    $this->app->Tpl->Parse('PAGE',"welcome_pinwand.tpl");	
  }


  function Accordion()
  {
    // check if accordion is empty

      //$this->app->DB->Insert("INSERT INTO accordion (name,target,position) VALUES ('Startseite','StartseiteWiki','1')");

      $check_startseite = $this->app->DB->Select("SELECT name FROM wiki WHERE name='StartseiteWiki' LIMIT 1");
      if($check_startseite == "")
      {
        $wikifirstpage='
<p>Herzlich Willkommen in Ihrem waWision,<br><br>wir freuen uns Sie als waWision Benutzer begrüßen zu dürfen. Mit waWision organisieren Sie Ihre Firma schnell und einfach. Sie haben alle wichtigen Zahlen und Vorgänge im Überblick.<br><br>Für Einsteiger sind die folgenden Thema wichtig:<br><br></p>
<ul>
<li> <a href="index.php?module=firmendaten&amp;action=edit" target="_blank"> Firmendaten</a> (dort richten Sie Ihr Briefpapier ein)</li>
<li> <a href="index.php?module=adresse&amp;action=list" target="_blank"> Stammdaten / Adressen</a> (Kunden und Lieferanten angelen)</li>
<li> <a href="index.php?module=artikel&amp;action=list" target="_blank"> Artikel anlegen</a> (Ihr Artikelstamm)</li>
<li> <a href="index.php?module=angebot&amp;action=list" target="_blank"> Angebot</a> / <a href="index.php?module=auftrag&amp;action=list" target="_blank"> Auftrag</a> (Alle Dokumente für Ihr Geschäft)</li>
<li> <a href="index.php?module=rechnung&amp;action=list" target="_blank"> Rechnung</a> / <a href="index.php?module=gutschrift&amp;action=list" target="_blank"> Gutschrift</a></li>
<li> <a href="index.php?module=lieferschein&amp;action=list" target="_blank"> Lieferschein</a></li>
</ul>
<p><br><br>Kennen Sie unsere Zusatzmodule die Struktur und Organisation in das tägliche Geschäft bringen?<br><br></p>
<ul>
<li> <a href="index.php?module=kalender&amp;action=list" target="_blank"> Kalender</a></li>
<li> <a href="index.php?module=wiki&amp;action=list" target="_blank"> Wiki</a></li>
</ul>';

        $this->app->DB->Insert("INSERT INTO wiki (name,content) VALUES ('StartseiteWiki','".$wikifirstpage."')");
      }
      $data = $this->app->DB->SelectArr("SELECT * FROM accordion ORDER BY position");


    $out = '';
    $entry = '';
    $edit = '';

    $edit = "<a id=\"wiki_startseite_edit\" href=\"index.php?module=wiki&action=edit&name=StartseiteWiki\">Seite editieren</a>";

    $wikipage_exists = $this->app->DB->Select("SELECT '1' FROM wiki WHERE name='StartseiteWiki' LIMIT 1");
    if($wikipage_exists!='1')
      $this->app->DB->Insert("INSERT INTO wiki (name) VALUES ('StartseiteWiki')");
    $wikipage_content = $this->app->DB->Select("SELECT content FROM wiki WHERE name='StartseiteWiki' LIMIT 1");

    $wikipage_content = $this->app->erp->ReadyForPDF($wikipage_content);
    $wikiparser = new WikiParser();
    $content = $wikiparser->parse($wikipage_content);

    $this->app->Tpl->Set('ACCORDIONENTRY0', $content);
    $entry = "[ACCORDIONENTRY0]";

    $out .= "<!--<h3><a href=\"#\">Startseite</a></h3>-->
      <div><div class=\"wiki\"><!--$edit<br/>-->$entry<br>$edit</div></div>";
    
    return $out;
  }

  function WelcomeUpgrade()
  {
    $this->app->erp->MenuEintrag("index.php?module=welcome&action=start","zur&uuml;ck zur Startseite");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Update f&uuml;r WaWision");

    $this->app->Tpl->Set('STARTBUTTON',"<!--");
    $this->app->Tpl->Set('ENDEBUTTON',"-->");

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

    $this->app->erp->MenuEintrag("index.php?module=welcome&action=upgrade","Update");
//    $this->app->Tpl->Set(TABTEXT,"Upgrade");
    $this->WaWisionUpgradeFeed(5);

    if($this->app->Secure->GetPOST("upgrade"))
    {
      ob_start();
      // dringend nacheinander, sonst wird das alte upgrade nur ausgefuehrt
 /*   if($this->app->erp->IsWindows())
      {
        system("cd .. && c:\\xampp\\php\\php.exe upgradesystemclient2.php && c:\\xampp\\php\\php.exe upgradedbonly.php");
      } else {
*/
        if(!is_dir(".svn"))
        {
          echo "new update system\r\n";
          include("../upgradesystemclient2_include.php");
        } else {
          echo "Update in Entwicklungsversion\r\n";
        }
          //system("cd ../ && php5 upgradesystemclient2.php && php5 upgradedbonly.php");
    //}	
      $result .= "\r\n>>>>>>Bitte klicken Sie jetzt auf \"Weiter mit Schritt 2\"<<<<<<\r\n\r\n";
      $result .= ob_get_contents();
      $result .= "\r\n>>>>>>Bitte klicken Sie jetzt auf \"Weiter mit Schritt 2\"<<<<<<\r\n\r\n";
      ob_end_clean();

      if(is_dir(".svn"))
      {
        $version_revision = "SVN"; 
      } else {
        include("../version.php");
      }

      $result .="\r\nIhre Version: $version_revision\r\n";

    } else {

      $result .=">>>>>Bitte auf \"Dateien aktualisieren jetzt starten\" klicken<<<<<<\r\n";

    }

    if($this->app->erp->Firmendaten("version")=="")
      $this->app->erp->FirmendatenSet("version",$this->app->erp->RevisionPlain());

    $doc_root  = preg_replace("!{$_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
    $path = preg_replace("!^{$doc_root}!", '', __DIR__); 

$this->app->Tpl->Add('TAB1',"<h2>Schritt 1 von 2: Dateien aktualisieren</h2><table width=\"100%\"><tr valign=\"top\"><td width=\"70%\"><form action=\"\" method=\"post\" class=\"updateForm\"><input type=\"hidden\" name=\"upgrade\" value=\"1\">
        <textarea rows=\"15\" cols=\"90\">$result</textarea>
        <br><input type=\"submit\" value=\"Dateien aktualisieren jetzt starten\" name=\"upgrade\">&nbsp;        
       <input type=\"button\" value=\"Weiter mit Schritt 2\" onclick=\"window.location.href='index.php?module=welcome&action=upgradedb'\">&nbsp;
        </form></td><td>[WELCOMENEWS]</td></tr></table>");

        $this->app->Tpl->Parse(PAGE,"tabview.tpl");
  }

  function WelcomeUpgradeDB()
  {
    $this->app->erp->MenuEintrag("index.php?module=welcome&action=start","zur&uuml;ck zur Startseite");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Update f&uuml;r WaWision");

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
    $this->app->erp->MenuEintrag("index.php?module=welcome&action=upgradedb","Update");
    $this->WaWisionUpgradeFeed(5);

    if($this->app->Secure->GetPOST("upgradedb"))
    {
      ob_start();
      //   include("upgradesystemclient.php");
        $result .="Starte DB Update\r\n";
        $this->app->erp->UpgradeDatabase();
        $result .="Fertig DB Update\r\n";
        $result .="\r\n\r\nDas Datenbank Update wurde durchgef&uuml;hrt\r\n";
        $result .="\r\n>>>>>Sie k&ouml;nnen nun mit WaWision weiterarbeiten.<<<<<<\r\n";
        $result .= ob_get_contents();
      ob_end_clean();
    } else {

      $result .="\r\n>>>>>Bitte auf \"Datenbank Anpassungen jetzt durchf&uuml;hren\" klicken<<<<<<\r\n";

    }


    if($this->app->erp->Firmendaten("version")=="")
      $this->app->erp->FirmendatenSet("version",$this->app->erp->RevisionPlain());

    $doc_root  = preg_replace("!{$_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
    $path = preg_replace("!^{$doc_root}!", '', __DIR__); 

$this->app->Tpl->Add('TAB1',"<h2>Schritt 2 von 2: Datenbank anpassen</h2><table width=\"100%\"><tr valign=\"top\"><td width=\"70%\"><form action=\"\" method=\"post\" class=\"updateForm\"><input type=\"hidden\" name=\"upgrade\" value=\"1\">
        <textarea rows=\"15\" cols=\"90\">$result</textarea>
        <br><input type=\"submit\" value=\"Datenbank Anpassungen jetzt durchf&uuml;hren\" name=\"upgradedb\">&nbsp;
       <input type=\"button\" value=\"Zur&uuml;ck\" onclick=\"window.location.href='index.php?module=welcome&action=upgrade'\">&nbsp;
       <input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php'\">&nbsp;
        </form></td><td>[WELCOMENEWS]</td></tr></table>");

        $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }




  function Termine($date)
  {
    $userid = $this->app->User->GetID();

    if(is_numeric($userid)) {
      $termine = $this->app->DB->SelectArr("SELECT DISTINCT color,von,bis,bezeichnung,allDay FROM kalender_user AS ka
          RIGHT JOIN kalender_event AS ke ON ka.event=ke.id
          WHERE (ka.userid='$userid' OR ke.public='1') AND DATE(von)='$date'
          ORDER BY von");
      $out = '';
      foreach($termine AS $t) {
        $von = date('G:i', strtotime($t['von']));
        $bis = date('G:i', strtotime($t['bis']));

        if($t['allDay']=='1') {
          $von = 'Ganztags';
          $bis = '';
        }else {
          if($von==$bis)
            $bis = '';
          else 
            $bis = '- '.$bis;
        }

        $color = (($t['color']!='') ? "style='background-color: {$t['color']};border-color: {$t['color']};'" : '');

        $out .= "<li $color><span class=\"description\">{$t['bezeichnung']}<br>$von $bis&nbsp;&nbsp;</span></li>";
      }

      if(count($termine)==0) $out = '<center><i>Keine Termine vorhanden</i></center>';

      return $out;
    }
  }



  function Aufgaben($parse)
  {
    $userid = $this->app->User->GetAdresse();

    if(is_numeric($userid))
    {


    }

  }

  function WelcomeHelp()
  {
  }

  function WelcomeSettings()
  {
    $submit_password = $this->app->Secure->GetPOST("submit_password");

    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Pers&ouml;nliche Einstellungen");


    $submit_startseite = $this->app->Secure->GetPOST("submit_startseite");
    $startseite = $this->app->Secure->GetPOST("startseite");

    if($submit_startseite!=""){
      $this->app->DB->Update("UPDATE user SET startseite='$startseite' WHERE id='".$this->app->User->GetID()."' LIMIT 1");
    }

    if($submit_password!="")
    {
      $password = $this->app->Secure->GetPOST("password");
      $repassword = $this->app->Secure->GetPOST("passwordre");

      if($password!="" && $password==$repassword)
      {
        $this->app->Tpl->Set('MESSAGE',"<div class=\"error2\">Passwort wurde ge&auml;ndert!</div>");
        $passwordmd5 = md5($password);
        $this->app->DB->Update("UPDATE user SET passwordmd5='$passwordmd5' WHERE id='".$this->app->User->GetID()."' LIMIT 1");
      } else if($password!=""){
        $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Passworteingabe falsch! Bitte zwei mal das gleiche Passwort eingeben!</div>");
      }
    }		

    $startseite = $this->app->DB->Select("SELECT startseite FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");

    $this->app->Tpl->Set('STARTSEITE',$startseite);

    $this->app->Tpl->Parse('PAGE',"welcome_settings.tpl");

  }



  function WelcomeInfo()
  {

    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Informationen zur Software");

    $this->app->Tpl->Set('TABTEXT',"Informationen zur Software");
    $this->app->Tpl->Set('TAB1','<fieldset><legend>Lizenzinformationen</legend><table><tr><td>');
    if($this->app->erp->Version()!="OSS")
    {
      $this->app->Tpl->Add('TAB1',"Sie benutzen die kommerzielle Version von waWision. Alle Rechte vorbehalten. Beachten Sie die Nutzungsbedinungen.<br><br>&copy; Copyright by embedded projects GmbH Augsburg");
    }
    else {
      $this->app->Tpl->Add('TAB1',"Sie benutzen die Open-Source Version von waWision. Die Software steht unter der EGPLv3.1 (<a href=\"http://www.wawision.de/lizenzhinweis\" target=\"_blank\">Hinweis</a>).<br><br><div class=\"info\">Das Logo und der Link zur Homepage <a href=\"http://www.wawision.de\" target=\"_blank\">http://www.wawision.de</a> d&uuml;rfen
          nicht entfernt werden.</div><br>&copy; Copyright by embedded projects GmbH Augsburg");
    }
    $this->app->Tpl->Add('TAB1','</td></tr>');
    
    if(method_exists($this->app->erp, 'VersionsInfos'))
    {
      $ver = $this->app->erp->VersionsInfos();
      $this->app->Tpl->Add('TAB1','<tr><td>'.$ver['Details'].'</td></tr>');
    }    
    $this->app->Tpl->Add('TAB1','</table></fieldset>');
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");

  }


  function WelcomeMenu()
  {
    $this->app->Tpl->Add('KURZUEBERSCHRIFT',"<h2>Startseite</h2>");

  }


  function WelcomeMain()
  {

    $this->app->Tpl->Set('UEBERSCHRIFT',"Herzlich Willkommen ".$this->app->User->GetDescription()."!");
    $this->WelcomeMenu();

    // muss jeder sehen
    $this->app->erp->LagerAusgehend('ARTIKEL');

    $this->app->Tpl->Parse('PAGE',"welcome_main.tpl");
    //$this->app->BuildNavigation=false;
    //$this->app->Tpl->Parse(PAGE,"welcome_stat.tpl");
  }


  function WelcomeStartseite()
  {
    $this->app->erp->Startseite();
  }

  function WelcomeLogin()
  {
    
    if($this->app->User->GetID()!="")
    {

      // alle cookies SpryMedia loeschen

      // Setzen des Verfalls-Zeitpunktes auf 1 Stunde in der Vergangenheit
      $this->app->erp->ClearCookies();
      $this->app->erp->Startseite();
    }
    else
    {
      $this->app->erp->InitialSetup();
      $this->app->Tpl->Set('UEBERSCHRIFT',"wawision &middot; Enterprise Warehouse Management");
      $this->app->acl->Login();
    }
  }

  function WelcomeLogout()
  {
    $this->app->acl->Logout();
    $this->app->erp->ClearCookies();
    //$this->app->WF->ReBuildPageFrame();
    //$this->WelcomeMain();
  }

  function WelcomeUnlock()
  {
    $gui = $this->app->Secure->GetGET("gui");
    $id =  $this->app->Secure->GetGET("id");

    // sperre entfernen bzw umschreiben
    if($gui=="angebot" || $gui=="auftrag" || $gui=="rechnung" || $gui=="bestellung" || $gui=="gutschrift" || $gui=="lieferschein" || $gui=="adresse" || $gui=="artikel" || $gui=="produktion")
    {
      $this->app->DB->Update("UPDATE $gui SET usereditid='".$this->app->User->GetID()."'  WHERE id='$id' LIMIT 1");
      header("Location: index.php?module=$gui&action=edit&id=$id");
      exit;
    }
  }


  function VorgangAnlegen()
  {
    //print_r($_SERVER['HTTP_REFERER']);
    $titel = $this->app->Secure->GetGET("titel");

    $url = parse_url($_SERVER['HTTP_REFERER']);
    //$url = parse_url("http://dev.eproo.de/~sauterbe/eprooSystem-2009-11-21/webroot/index.php?module=ticket&action=edit&id=1");

    //module=ticket&action=edit&id=1
    //$url['query']
    $params = split("&",$url['query']);
    foreach($params as $value){
      $attribut = split("=",$value);
      $arrPara[$attribut[0]] = $attribut[1];
    }

    $adresse = $this->app->User->GetAdresse();
    if($titel=="")
      $titel = ucfirst($arrPara['module'])." ".$arrPara['id'];
    $href = $url['query'];
    $this->app->erp->AddOffenenVorgang($adresse, $titel, $href);

    header("Location: ".$_SERVER['HTTP_REFERER']);
  }


  function VorgangEdit()
  {
    $vorgang = $this->app->Secure->GetGET("vorgang");
    $titel = $this->app->Secure->GetGET("titel");
    $this->app->erp->RenameOffenenVorgangID($vorgang,$titel);
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
  } 

  function VorgangEntfernen()
  {
    $vorgang = $this->app->Secure->GetGET("vorgang");
    $this->app->erp->RemoveOffenenVorgangID($vorgang);
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
  }
}
?>
