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

class erpAPI 
{
  var $commonreadonly=0;
  var $menucounter=0;
  var $mail_error=0;
  var $beschriftung_sprache="";
  var $logtime;
  var $firstlogtime;
  public static $lasttime = 0;

  
  function erpAPI(&$app)
  {
    $this->app=$app;
    $this->checkLicense();
    $this->firstlogtime = microtime(true);
    $this->logtime = microtime(true);
    if(defined('SCRIPT_START_TIME'))
    {
      $this->firstlogtime = SCRIPT_START_TIME;
    }
  }
  
  function LogWithTime($message, $json = false)
  {
    if(defined('SCRIPT_START_TIME'))
    {
      $akttime = microtime(true);
      $aktmemory = number_format(memory_get_usage()/1024.0/1024.0,2);
      $peakmemory = number_format(memory_get_peak_usage()/1024.0/1024.0,2);
      $runtime = number_format($akttime - $this->logtime,3);
      $runtimeall = number_format($akttime - $this->firstlogtime,3);
      $this->LogFile('Time all '.$runtimeall."s last: ".$runtime."s Memakt:".$aktmemory."MB peak:".$peakmemory."MB ".mysqli_real_escape_string($this->app->DB->connection, $json?json_encode($message):$message));
      $this->logtime = $akttime;
    }
  }
  

  function getEncModullist()
  {
    if(function_exists('ioncube_file_is_encoded'))
    {
      if(file_exists(dirname(__FILE__).'/modulliste.php'))
      {
        include('modulliste.php');
        return $erg;
      }
      return array();
    }
  }
  
  function checkLicense()
  {
    
    return true;
  }
  
  function getApps()
  {
    $apps = array(
    'appstore_extern'=>array('Bezeichnung'=>'<a href="http://shop.wawision.de" target="_blank">zum AppStore</a>',
                      'Link'=>'http://shop.wawision.de',
                      'Icon'=>'Icons_dunkel_20.gif',
                      'Versionen'=>''),
    'aufgaben'=>array('Bezeichnung'=>'Aufgaben',
                      'Link'=>'index.php?module=aufgaben&action=list',
                      'Icon'=>'Icons_dunkel_2.gif',
                      'Versionen'=>''),
    'chat'=>array('Bezeichnung'=>'Chat',
                      'Link'=>'index.php?module=chat&action=list',
                      'Icon'=>'Icons_dunkel_2.gif',
                      'Versionen'=>''),

    'wiedervorlage'=>array('Bezeichnung'=>'Wiedervorlage',
                      'Link'=>'index.php?module=wiedervorlage&action=list',
                      'Icon'=>'Icons_dunkel_2.gif',
                      'Versionen'=>''),
    'stammdatenbereinigen'=>array('Bezeichnung'=>'Stammdaten Bereinigung',
                      'Link'=>'index.php?module=stammdatenbereinigen&action=list',
                      'Icon'=>'Icons_dunkel_1.gif',
                      'Versionen'=>'ALL'),
    'lagerpruefung'=>array('Bezeichnung'=>'Lagerpr&uuml;fung',
                      'Link'=>'index.php?module=lagerpruefung&action=list',
                      'Icon'=>'Icons_dunkel_2.gif',
                      'Versionen'=>'ALL'),
    'layoutvorlagen'=>array('Bezeichnung'=>'Layoutvorlagen',
                      'Link'=>'index.php?module=layoutvorlagen&action=list',
                      'Icon'=>'Icons_dunkel_2.gif',
                      'Versionen'=>'ALL'),
    'zertifikatgenerator'=>array('Bezeichnung'=>'Zertifikatgenerator',
                      'Link'=>'index.php?module=zertifikatgenerator&action=list',
                      'Icon'=>'Icons_dunkel_2.gif',
                      'Versionen'=>'ALL'),
    'systemlog'=>array('Bezeichnung'=>'Systemlog',
                      'Link'=>'index.php?module=systemlog&action=list',
                      'Icon'=>'Icons_dunkel_1.gif',
                      'Versionen'=>'ALL'),
    'filiallieferung'=>array('Bezeichnung'=>'Filiallieferung',
                      'Link'=>'index.php?module=filiallieferung&action=list',
                      'Icon'=>'Icons_dunkel_1.gif',
                      'Versionen'=>'ALL'),
    'waage'=>array('Bezeichnung'=>'Waage',
                      'Link'=>'index.php?module=waage&action=list',
                      'Icon'=>'Icons_dunkel_1.gif',
                      'Versionen'=>'ALL'),                      
    'waage_artikel'=>array('Bezeichnung'=>'Waage Einstellungen',
                      'Link'=>'index.php?module=waage_artikel&action=list',
                      'Icon'=>'Icons_dunkel_1.gif',
                      'Versionen'=>'ALL'),                          
    'ueberzahlterechnungen'=>array('Bezeichnung'=>'&Uuml;berzahlte Rechnungen',
                      'Link'=>'index.php?module=ueberzahlterechnungen&action=list',
                      'Icon'=>'Icons_dunkel_1.gif',
                      'Versionen'=>'ALL'),    
    'serienbrief'=>array('Bezeichnung'=>'Serienbriefe',
                      'Link'=>'index.php?module=serienbrief&action=list',
                      'Icon'=>'Icons_dunkel_1.gif',
                      'Versionen'=>'ALL'),
    'pos_kassierer'=>array('Bezeichnung'=>'POS (Kassierer)',
                      'Link'=>'index.php?module=pos_kassierer&action=list',
                      'Icon'=>'Icons_dunkel_2.gif',
                      'Versionen'=>'ALL'),
    'reisekostenart'=>array('Bezeichnung'=>'Reisekostenart',
                      'Link'=>'index.php?module=reisekostenart&action=list',
                      'Icon'=>'Icons_dunkel_19.gif',
                      'Versionen'=>'ALL'),
    'aktionscode_liste'=>array('Bezeichnung'=>'Aktionscodes',
                      'Link'=>'index.php?module=aktionscode_liste&action=list',
                      'Icon'=>'Icons_dunkel_14.gif',
                      'Versionen'=>'ALL'),
    'artikeleigenschaften'=>array('Bezeichnung'=>'Artikel Eigenschaften',
                      'Link'=>'index.php?module=artikeleigenschaften&action=list',
                      'Icon'=>'Icons_dunkel_13.gif',
                      'Versionen'=>'ALL')                     
                      );
    $res = false;
    $version = $this->Version();
    $ki = 0;
    $kk = 0;
    foreach($apps as $key => $app)
    {
      if(is_file("pages/".$key.".php"))
      {
        if($app['Versionen'] == '' || $app['Versionen'] == 'ALL')
        {
          $res['installiert'][$ki] = $app;
          $ki++;
        } else {
          $versionen = explode(',',$app['Versionen']);
          if(in_array($version, $versionen))
          {
            $res['installiert'][$ki] = $app;
            $ki++;
          } else {
            $res['kauf'][$kk] = $app;
            $kk++;
          }
        }
      } else {
        $app['Link'] = '';
        $res['kauf'][$kk] = $app;
        $kk++;
      }
    }
    return $res;
  }
  
  
 
  function StartseiteMenu()
  {
    $module = $this->app->Secure->GetGET("module");
    $action = $this->app->Secure->GetGET("action");
    $id = $this->app->Secure->GetGET("id");

    $this->MenuEintrag("index.php?module=welcome&action=start","Startseite");
    $this->MenuEintrag("index.php?module=welcome&action=pinwand","Pinwand");


    $this->MenuEintrag("index.php?module=aufgaben&action=create","Neue Aufgaben");

    $this->MenuEintrag("index.php?module=aufgaben&action=list","Aufgaben");

    $this->MenuEintrag("index.php?module=kalender&action=list","Kalender");
    $this->MenuEintrag("index.php?module=zeiterfassung&action=create","Zeiterfassung buchen");
    $this->MenuEintrag("index.php?module=zeiterfassung&action=listuser","Eigene Zeiterfassung &Uuml;bersicht");
  }



















  function AbgleichBenutzerVorlagen($userid=0)
  {
    // alle vorlagen ind ei Leute kopieren
    if($userid<=0)
      $user = $this->app->DB->SelectArr("SELECT * FROM user");        
    else
      $user = $this->app->DB->SelectArr("SELECT * FROM user WHERE id='$userid'");        
    $startzeit = microtime(true);
    
    for($i=0;$i<count($user);$i++)
    {
      $user[$i]['vorlage'] = strtolower($user[$i]['vorlage']); 
      $id_vorlage = $this->app->DB->Select("SELECT id FROM uservorlage WHERE bezeichnung LIKE '".$user[$i]['vorlage']."' LIMIT 1");

      // neue eintraege
      $this->app->DB->Update("REPLACE INTO userrights (user, module,action,permission) (SELECT '".$user[$i]['id']."',module, action,permission 
        FROM uservorlagerights WHERE vorlage LIKE '".$id_vorlage."')   ");
      $neuesquery = $this->app->DB->Query("Select * from userrights where user = ".$user[$i]['id']." order by module, action, id desc");
      if($neuesquery)
      {
        $aktmodule = false;
        $aktaction = false;
        while($v = $this->app->DB->Fetch_Array($neuesquery))
        {
          if($aktaction != $v['action'] || $aktmodule != $v['module'])
          {
            $aktaction = $v['action'];
            $aktmodule = $v['module'];
          } else {
            $this->app->DB->Delete("DELETE FROM userrights where id = ".$v['id']);
          }
        }
      }
        
      //Doppelte Löschen auch nicht Vorlage älteste ids zuerst falls permission unterschiedlich
      /*$doppelteids = $this->app->DB->SelectArr("SELECT t1.id
        FROM userrights t1
        INNER JOIN userrights t2 ON t1.id < t2.id
        AND (
        t1.user ='".$user[$i]['id']."'
        AND t2.user ='".$user[$i]['id']."'
        AND t1.module = t2.module
        AND t1.action = t2.action
       )");
      */
      
      /*if($doppelteids)
      {
        $where = 'id = 0 ';
          foreach($doppelteids as $key => $value)
          {
            $where .= " or id = ".$value['id'];
          }
        $this->app->DB->Delete("delete from userrights where ".$where);
      }*/
    }       
  }


  function UserEvent()
  {
    $tmp = $this->app->DB->SelectArr("SELECT * FROM interne_events WHERE userid='".$this->app->User->GetID()."' ORDER by type ASC, zeitstempel ASC LIMIT 1");

    //$this->app->erp->LogFile("DEMO ".$this->app->User->GetID());

    if($tmp[0]['id'] > 0)
    {
      $this->app->DB->Delete("DELETE FROM interne_events WHERE id='".$tmp[0]['id']."' LIMIT 1");
      $result['event']=$tmp[0]['type'];
      $result['sound']=$tmp[0]['sound'];
      $result['message']=$tmp[0]['meldung'];
      return $result;
    } 
    return false; 
  }

  function ProzessLock($name)
  {
    $fp = @fopen($this->GetTMP()."/lock_". $name . '.lock', 'w+');

    if($fp)
    {
      if (flock($fp, LOCK_EX)) {
        ftruncate($fp, 0); 
        fwrite($fp, "Write something here\n");
        return $fp;
      }
    }
    return false;
  }

  function ProzessUnlock($fp)
  {
    if(!$fp)return;
    fflush($fp); // leere Ausgabepuffer bevor die Sperre frei gegeben wird
    flock($fp, LOCK_UN); // Gib Sperre frei
    fclose($fp);
  }

  function ConvertToBytes($tmp) 
  {
    $tmp = trim($tmp);
    $last = strtolower($tmp[strlen($tmp)-1]);
    switch($last) 
    {
        case 'g':
        $tmp *= 1024;
        case 'm':
        $tmp *= 1024;
        case 'k':
        $tmp *= 1024;
    }
    return $tmp;
  }

  function MaxUploadFileSize()
  {
    //select maximum upload size
    $max_upload = $this->ConvertToBytes(ini_get('upload_max_filesize'));
    $max_post = $this->ConvertToBytes(ini_get('post_max_size'));
    $memory_limit = $this->ConvertToBytes(ini_get('memory_limit'));
    return min($max_upload, $max_post, $memory_limit);
  }


  function BelegVersand($typ,$id,$versandart,$drucker="")
  {
    if($typ!="rechnung" && $typ!="angebot" && $typ!="auftrag" && $typ!="gutschrift" && $typ!="lieferschein" && $typ!="reisekosten")
      return;

    if($versandart!="email" && $versandart!="brief")
      return;


    $projekt = $this->app->DB->Select("SELECT projekt FROM $typ WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM $typ WHERE id='$id' LIMIT 1");
    $email = $this->app->DB->Select("SELECT email FROM $typ WHERE id='$id' LIMIT 1");
    $adresse = $this->app->DB->Select("SELECT adresse FROM $typ WHERE id='$id' LIMIT 1");

    $emailtext = $this->Geschaeftsbriefvorlage("de",$typ,$projekt,$name,$id);

    switch($typ)
    {
      case "rechnung":
        $Brief = new RechnungPDF($this->app,$projekt);
        $Brief->GetRechnung($id);
        $tmpfile = $Brief->displayTMP();
        break;
      case "angebot":
        $Brief = new AngebotPDF($this->app,$projekt);
        $Brief->GetAngebot($id);
        $tmpfile = $Brief->displayTMP();
        break;
      case "auftrag":
        $Brief = new AuftragPDF($this->app,$projekt);
        $Brief->GetAuftrag($id);
        $tmpfile = $Brief->displayTMP();
        break;
    }

    $this->LogFile("BelegeVersand T $typ I $id V $versandart Email $email Name $name betreff ".$emailtext['betreff']);

    if($drucker<0)
      $drucker = $this->app->DB->Select("SELECT standarddrucker FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
    else
      $drucker = $this->app->DB->Select("SELECT id FROM drucker WHERE id='".$drucker."' LIMIT 1");

    if($drucker <=0)
      $drucker = $this->Firmendaten("standardversanddrucker");

    if($versandart=="email")
      $this->DokumentSend($adresse,$typ, $id, $versandart,$emailtext['betreff'],$emailtext['text'],array($tmpfile),"","",$projekt,$email, $name);
    else
      $this->DokumentSend($adresse,$typ, $id, $versandart,$emailtext['betreff'],$emailtext['text'],array($tmpfile),$drucker,"",$projekt,$email, $name);

    $fileid = $this->CreateDatei($tmpfile,$module,"","",$tmpfile,$this->app->User->GetName());
    $this->AddDateiStichwort($fileid,$typ,$typ,$id,$without_log=false);

    $ansprechpartner = $name." <".$email.">";

    $this->app->DB->Insert("INSERT INTO dokumente_send 
        (id,dokument,zeit,bearbeiter,adresse,parameter,art,betreff,text,projekt,ansprechpartner,versendet,dateiid)           	
        VALUES ('','$typ',NOW(),'".$this->app->User->GetName()."',
          '$adresse','$id','$versandart','".$emailtext['betreff']."','".$emailtext['text']."','$projekt','$ansprechpartner',1,'$fileid')");

    unlink($tmpfile);

    if($typ=="rechnung" || $typ=="angebot" || $typ=="gutschrift")
    {
      $this->app->DB->Update("UPDATE $typ SET status='versendet' WHERE id='$id' LIMIT 1");
    }

    $this->app->DB->Update("UPDATE $typ SET versendet=1, versendet_am=NOW(),
        versendet_per='$versandart',versendet_durch='".$this->app->User->GetName()."',schreibschutz='1' WHERE id='$id' LIMIT 1");



    switch($typ)
    {
      case "angebot": $this->AngebotProtokoll($id,"Angebot versendet"); break;
      case "auftrag": $this->AuftragProtokoll($id,"Auftrag versendet"); break;
      case "rechnung": $this->RechnungProtokoll($id,"Rechnung versendet"); break;
      case "lieferschein": $this->LieferscheinProtokoll($id,"Lieferschein versendet"); break;
      case "gutschrift": $this->GutschriftProtokoll($id,"Gutschrift versendet"); break;
      case "reisekosten": $this->ReisekostenProtokoll($id,"Reisekosten versendet"); break;
    }
  }

  function UrlOrigin($s, $use_forwarded_host=false)
  {
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
  }


  function ZeitInStundenMinuten($number, $format = "%h:%i") {

     $number = str_replace(",",'.',$number);
     $h = floor($number);
     $i = round(($number - $h) * 60);

     $h = str_pad($h, 2, "0", STR_PAD_LEFT);
     $i = str_pad($i, 2, "0", STR_PAD_LEFT);
     $format = preg_replace("/%h/", $h, $format);
     $format = preg_replace("/%i/", $i, $format);
     return $format;
  }

  function UmlauteEntfernen($text)
  {
    $text = $this->ReadyForPDF($text);
    $text = str_replace ("ä", "ae", $text);
    $text = str_replace ("Ä", "Ae", $text);
    $text = str_replace ("ö", "oe", $text);
    $text = str_replace ("Ö", "Oe", $text);
    $text = str_replace ("ü", "ue", $text);
    $text = str_replace ("Ü", "Ue", $text);
    $text = str_replace ("ß", "ss", $text);
    $text = str_replace ("&", "u", $text);
    return $text;
  }

  function Stroke($fieldstroke, $field) {
    return "if(" . $fieldstroke . ",CONCAT('<s>'," . $field . ",'</s>')," . $field . ")";
  }

  function Dateinamen($text) {
    $text = $this->UmlauteEntfernen($text);
    $text = str_replace(' ', '_', $text);
    $text = preg_replace('#[^-_.A-Za-z0-9]#', '', $text);
    return $text;
  }


  function AnzahlOffeneAufgaben()
  {
    $anzahl =  $this->app->DB->Select("SELECT COUNT(a.id) FROM aufgabe a WHERE  (a.adresse='" . $this->app->User->GetAdresse() . "' OR (a.initiator='" . $this->app->User->GetAdresse() . "' AND (a.adresse IS NULL OR a.adresse<=0))) AND a.startdatum='0000-00-00' AND a.status!='abgeschlossen'");
    
    if($anzahl<=0) return 0;
    else return $anzahl;
  }


  function UserDevice()
  {
    if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone'))
      return "smartphone";
    else return "desktop";
  }

  function Startseite()
  {
    if($this->app->User->GetID()!="")
    { 
      $startseite = $this->app->DB->Select("SELECT startseite FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
      $startseite = $this->ReadyForPDF($startseite);

      if($this->UserDevice()=="desktop")
      {
        // wenn die GPS Stechuhr da ist
        if($startseite!="")
          header("Location: $startseite");
        else
          header("Location: index.php?module=welcome&action=start");
        exit;
      } else
      {
        header("Location: index.php?module=welcome&action=start\r\n");
        exit;
      }
    }
  }

  function getFirstDayOfWeek($year, $weeknr)
  {
    $offset = date('w', mktime(0,0,0,1,1,$year));
    $offset = ($offset < 5) ? 1-$offset : 8-$offset;
    $monday = mktime(0,0,0,1,1+$offset,$year);

    return date('Y-m-d',strtotime('+' . ($weeknr - 1) . ' weeks', $monday)); 
  }

  function IsWindows()
  {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
      return true;
    else return false;
  }

  function GetTMP()
  {
    $userdata = $this->app->Conf->WFuserdata;

    if ($this->IsWindows()) {
      $tmp = $userdata."\\tmp\\";
    } else {
      $tmp = $userdata."/tmp/";
    }

    $tmp = str_replace('//','/',$tmp);

    if(!is_dir($tmp))
      mkdir($tmp);

    return $tmp;
  }

  function GetUSERDATA()
  {
    return $this->app->Conf->WFuserdata;
  }

  
  function ArtikelAnzahlLagerPlatzMitSperre($artikel,$lager_platz)
{
  $result =  $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi 
      LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz
      WHERE lpi.artikel='$artikel' AND lpi.lager_platz='$lager_platz'");
  if($result <=0) $result=0;
  return $result;
}



  function LieferscheinAuslagern($lieferschein,$anzeige_lagerplaetze_in_lieferschein=false)
  {
    $artikelarr = $this->app->DB->SelectArr("SELECT * FROM lieferschein_position WHERE lieferschein='$lieferschein'");      

    $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$lieferschein'");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$lieferschein'");

    for($i=0;$i<count($artikelarr);$i++)
    {
      $beschreibung = $artikelarr[$i]['beschreibung'];
      $artikel = $artikelarr[$i]['artikel'];
      $menge = $artikelarr[$i]['menge'];
      $subid = $artikelarr[$i]['id'];
      $lager_string = "";

      $this->LagerArtikelZusammenfassen($artikel);

      $lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='$artikel' LIMIT 1");
      $seriennummernerfassen = $this->app->DB->Select("SELECT seriennummernerfassen FROM projekt WHERE id='$projekt' LIMIT 1");

      $regal = 0;

      if($lagerartikel > 0)
      {
        // lager platz suchen eins abziehen und namen in lieferschein   
        // kleinster lager leer machen
/*
        $regal = $this->app->DB->Select("SELECT lpi.lager_platz FROM lager_platz_inhalt lpi 
            LEFT JOIN lager_platz lp ON lpi.lager_platz=lp.id WHERE lpi.artikel='$artikel' AND lpi.menge >='$menge' 
            AND lp.autolagersperre!='1' AND lp.sperrlager!='1' LIMIT 1");
*/
        $regal = 0;

        if($regal > 0)
        {
          $regal_name = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$regal' LIMIT 1");
          $this->LagerAuslagernRegal($artikel,$regal,$menge,$projekt,"Lieferschein $belegnr");
          $lager_string .= $regal_name."($menge) ";
        } else {
          $timeout=0;
          $restmenge = $menge;    
          $lager_string = "";
          while(1)
          {       
            $timeout++;
            if($timeout > 1000) break;

            // Hole nach und nach bis alles da ist
            $lager_max = $this->app->DB->SelectArr("SELECT lpi.lager_platz, lpi.menge FROM lager_platz_inhalt lpi 
                LEFT JOIN lager_platz lp ON lpi.lager_platz=lp.id WHERE lpi.artikel='$artikel' AND lpi.menge > 0
                AND lp.autolagersperre!='1' AND lp.sperrlager!='1' ORDER by lpi.menge ASC LIMIT 1");

            // kleinster lager leer machen DESC zu ASC

            if(($restmenge > $lager_max[0]['menge']) && ($lager_max[0]['menge'] > 0))
            {
              // es werden mehr gebraucht als im lager sind
              $this->LagerAuslagernRegal($artikel,$lager_max[0]['lager_platz'],$lager_max[0]['menge'],$projekt,"Lieferschein $belegnr");
              $regal_name = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='".$lager_max[0]['lager_platz']."' LIMIT 1");
              $lager_string .= $regal_name."(".$lager_max[0]['menge'].") ";
              $restmenge = $restmenge - $lager_max[0]['menge'];
            } else if( ($lager_max[0]['menge'] >= $restmenge) && ($restmenge > 0)  ) {
              // es sind genuegend lager 
              $this->LagerAuslagernRegal($artikel,$lager_max[0]['lager_platz'],$restmenge,$projekt,"Lieferschein $belegnr");
              $regal_name = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='".$lager_max[0]['lager_platz']."' LIMIT 1");
              $lager_string .= $regal_name."(".$restmenge.") ";
              break;
            }
          }
        }               

        if($lager_string=="") $beschreibung .="\r\nLager: manuell";
        else $beschreibung .="\r\nLager: $lager_string";
      }

      $geliefert = $menge;

      $artikelhatseriennummer = $this->app->DB->Select("SELECT seriennummern FROM artikel WHERE id='".$artikel."' LIMIT 1");
      if($seriennummernerfassen=="1" && ($artikelhatseriennummer=="vomprodukteinlagern" || $artikelhatseriennummer=="vomprodukt" || $artikelhatseriennummer=="eigene"))
      {
        // wenn Seriennummer erfasst werden soll
        if($anzeige_lagerplaetze_in_lieferschein)
          $this->app->DB->Update("UPDATE lieferschein_position SET beschreibung='$beschreibung' WHERE id='$subid' LIMIT 1");
      } else {
        //wenn nicht
        if($anzeige_lagerplaetze_in_lieferschein)
          $this->app->DB->Update("UPDATE lieferschein_position SET geliefert='$geliefert',beschreibung='$beschreibung' WHERE id='$subid' LIMIT 1");
        else
          $this->app->DB->Update("UPDATE lieferschein_position SET geliefert='$geliefert' WHERE id='$subid' LIMIT 1");
      }
    }       
  }       

  function base64_url_encode($input) {
    return strtr(base64_encode($input), '+/=', '-_,');
  }

  function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_,', '+/='));
  }

  function ClearCookies()
  {
    if(count($_COOKIE) > 0)
    {
      foreach($_COOKIE as $key=>$value)
      {
        if($key!=str_replace("SpryMedia","",$key))
          setcookie ($key, time() - 3600);
      }
    }
  }

  function ManuelEcho($text)
  {
    echo $this->ClearDataBeforeOutput($text);
    exit;
  }

  function ClearDataBeforeOutput($text)
  {
    $text = str_replace('form action=""','form action="#"',$text);
    $text = str_replace('NONBLOCKINGZERO','',$text);
    $text = str_replace("&apos;","'",$text);
    return $text;
  }

  function AdresseAnschriftString($adresse)
  {
    $tmp="";
    if($adresse > 0)
    {
      $result = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");

      if($result[0]['name']!="") $tmp .= $result[0]['name']."\\n";
      if($result[0]['ansprechpartner']!="") $tmp .= $result[0]['ansprechpartner']."\\n";
      if($result[0]['abteilung']!="") $tmp .= $result[0]['abteilung']."\\n";
      if($result[0]['unterabteilung']!="") $tmp .= $result[0]['unterabteilung']."\\n";
      if($result[0]['adresszusatz']!="") $tmp .= $result[0]['adresszusatz']."\\n";
      if($result[0]['strasse']!="") $tmp .= $result[0]['strasse']."\\n";
      $tmp .= $result[0]['land']."-".$result[0]['plz']." ".$result[0]['ort'];
    }
    return $this->ReadyForPDF($tmp);
  }

  function AnzeigeEinkaufLager($artikel)
  {

    $einkauf = $this->GetEinkaufspreis($artikel,1);
    if($einkauf <=0) $einkauf = "-"; else $einkauf = $einkauf." &euro;";

    $lager = $this->ArtikelAnzahlLager($artikel);
    $reserviert = $this->ArtikelAnzahlReserviert($artikel);
    $verfuegbar = $lager - $reserviert;

    return "<table>
      <tr><td>Einkaufspreis:</td><td>$einkauf </td></tr>
      <tr><td>Lagerbestand:</td><td>$lager</td></tr>
      <tr><td>Reserviert:</td><td>$reserviert</td></tr>
      <tr><td>Verfügbar:</td><td>$verfuegbar</td></tr>
      </table>
      ";      
  }

  function DokumentAbschickenPopup()
  {
    $module = $this->app->Secure->GetGET("module");
    return "var horizontalPadding = 30;
    var verticalPadding = 30; $('<iframe id=\"externalSite\" class=\"externalSite\" src=\"index.php?module=$module&action=abschicken&id=%value%\" width=\"1000\"/>').dialog({
title: 'Abschicken',
      autoOpen: true,
      width:1000,
      height: 700,
      modal: true,
      resizable: true,
      close: function(ev, ui) {window.location.href='index.php?module=$module&action=edit&id=%value%';}
  }).width(1000 - horizontalPadding).height(700 - verticalPadding);";
  }

  function calledOnceAfterLogin($type)
  {
    $check = $this->app->DB->Select("SELECT settings FROM user WHERE id='1'");

    if($this->app->DB->GetVersion() >= 55)
    {
      $this->FirmendatenSet("mysql55",1); 
    } else {
      $this->FirmendatenSet("mysql55",0); 
    } 

    if($check=="firstinstall")
    {
      $this->UpgradeDatabase();
      $this->app->DB->Update("UPDATE user SET settings='' WHERE id='1'");
    }

    // Drucker spooler loeschen
    $this->app->DB->Delete("DELETE FROM `drucker_spooler` WHERE DATE_SUB(CURDATE(), INTERVAL 10 DAY) >= zeitstempel");

    $this->app->DB->Update("UPDATE adresse SET kundennummer='' WHERE kundennummer='0'");
    $this->app->DB->Update("UPDATE adresse SET lieferantennummer='' WHERE lieferantennummer='0'");
    $this->app->DB->Update("UPDATE adresse SET mitarbeiternummer='' WHERE mitarbeiternummer='0'");

    //TODO Inhalt auf pos.php aus Logout
    $this->app->User->SetParameter("pos_list_projekt",      "0");
    $this->app->User->SetParameter("pos_list_kassierer",    "0");
    $this->app->User->SetParameter("pos_list_kassierername","0");
    $this->app->User->SetParameter("pos_list_lkadresse",    "0");

    /*
    // artikel zusammenfassen
    $artikel = $this->app->DB->SelectArr("SELECT id FROM artikel WHERE lagerartikel='1'");
    for($i=0;$i<count($artikel);$i++)
    {
    $this->LagerArtikelZusammenfassen($artikel[$i]['id']);
    }
     */

    $this->app->DB->Update("UPDATE angebot a JOIN auftrag auf ON a.id=auf.angebotid SET a.auftragid=auf.angebotid");

    $this->app->User->SetParameter("lohnabrechnung_von","");
    $this->app->User->SetParameter("lohnabrechnung_bis","");

    $this->CheckGPSStechuhr();

  }

  function CheckGPSStechuhr()
  {
    $module=$this->app->Secure->GetGET("module");

    if($this->app->DB->Select("SELECT gpsstechuhr FROM user WHERE id='".$this->app->User->GetID()."'")>0)
    {
      $check = $this->app->DB->Select("SELECT id FROM gpsstechuhr 
          WHERE user='".$this->app->User->GetID()."' AND adresse='".$this->app->User->GetAdresse()."' 
          AND DATE_FORMAT(zeit,'%Y-%m-%d')= DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) LIMIT 1");

      if($this->ModulVorhanden("gpsstechuhr") && $check <= 0 && $module!="gpsstechuhr" )
      {
        header("Location: index.php?module=gpsstechuhr&action=create\r\n");
        exit;
      }
    }
  }       

  function ParseFormVars($fields)
  {
    foreach($fields as $key)
    {
      $this->app->Tpl->Set(strtoupper($key),$this->app->Secure->GetPOST($key));
    }
  }

  function ParseUserVars($type,$id,$text)
  {
    $result = $this->app->DB->SelectArr("SELECT * FROM $type WHERE id='$id' LIMIT 1");

    if($type!="auftrag" && $type!="bestellung")
    {
      $result[0]['internet'] = $this->app->DB->Select("SELECT internet FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['abweichendelieferadresse']=$this->app->DB->Select("SELECT abweichendelieferadresse FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['liefername']=$this->app->DB->Select("SELECT liefername FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['lieferabteilung']=$this->app->DB->Select("SELECT lieferabteilung FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['lieferunterabteilung']=$this->app->DB->Select("SELECT lieferunterabteilung FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['lieferadresszusatz']=$this->app->DB->Select("SELECT lieferadresszusatz FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['lieferansprechpartner']=$this->app->DB->Select("SELECT lieferansprechpartner FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['lieferstrasse']=$this->app->DB->Select("SELECT lieferstrasse FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['lieferplz']=$this->app->DB->Select("SELECT lieferplz FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['lieferland']=$this->app->DB->Select("SELECT lieferland FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
      $result[0]['lieferort'] = $this->app->DB->Select("SELECT lieferort FROM auftrag WHERE id='".$result[0]['auftragid']."' LIMIT 1");
    }

    if($type=="angebot")
    {
      $result[0]['abweichendelieferadresse']=$this->app->DB->Select("SELECT abweichendelieferadresse FROM angebot WHERE id='".$id."' LIMIT 1");
      $result[0]['liefername']=$this->app->DB->Select("SELECT liefername FROM angebot WHERE id='".$id."' LIMIT 1");
      $result[0]['lieferabteilung']=$this->app->DB->Select("SELECT lieferabteilung FROM angebot WHERE id='".$id."' LIMIT 1");
      $result[0]['lieferunterabteilung']=$this->app->DB->Select("SELECT lieferunterabteilung FROM angebot WHERE id='".$id."' LIMIT 1");
      $result[0]['lieferadresszusatz']=$this->app->DB->Select("SELECT lieferadresszusatz FROM angebot WHERE id='".$id."' LIMIT 1");
      $result[0]['lieferansprechpartner']=$this->app->DB->Select("SELECT lieferansprechpartner FROM angebot WHERE id='".$id."' LIMIT 1");
      $result[0]['lieferstrasse']=$this->app->DB->Select("SELECT lieferstrasse FROM angebot WHERE id='".$id."' LIMIT 1");
      $result[0]['lieferplz']=$this->app->DB->Select("SELECT lieferplz FROM angebot WHERE id='".$id."' LIMIT 1");
      $result[0]['lieferland']=$this->app->DB->Select("SELECT lieferland FROM angebot WHERE id='".$id."' LIMIT 1");
      $result[0]['lieferort'] = $this->app->DB->Select("SELECT lieferort FROM angebot WHERE id='".$id."' LIMIT 1");
    }

    if($type=="angebot" || $type=="auftrag")
    {
      $soll = $this->app->DB->Select("SELECT gesamtsumme FROM $type WHERE id='".$id."' LIMIT 1");
      $skonto = $this->app->DB->Select("SELECT (gesamtsumme/100)*zahlungszielskonto FROM $type WHERE id='".$id."' LIMIT 1");
      $text = str_replace('{SOLL}',number_format($soll,2,",","."),$text);     
      $text = str_replace('{SOLLMITSKONTO}',number_format($soll-$skonto,2,",","."),$text);     
      $text = str_replace('{SKONTOBETRAG}',number_format($skonto,2,",","."),$text);     
    }
    if($type=="rechnung" || $type=="gutschrift")
    {
      $soll = $this->app->DB->Select("SELECT soll FROM $type WHERE id='".$id."' LIMIT 1");
      $skonto = $this->app->DB->Select("SELECT (soll/100)*zahlungszielskonto FROM $type WHERE id='".$id."' LIMIT 1");
      $text = str_replace('{SOLL}',number_format($soll,2,",","."),$text);     
      $text = str_replace('{SOLLMITSKONTO}',number_format($soll-$skonto,2,",","."),$text);     
      $text = str_replace('{SKONTOBETRAG}',number_format($skonto,2,",","."),$text);     
    } else {
      $text = str_replace('{SOLL}',"",$text);     
      $text = str_replace('{SOLLMITSKONTO}',"",$text);     
      $text = str_replace('{SKONTOBETRAG}',"",$text);     
    }

    //internet
    //transaktionsnummer
    if($type=="auftrag")
    {
      $internet = $this->app->DB->Select("SELECT internet FROM auftrag WHERE id='".$id."' LIMIT 1");
      $text = str_replace('{INTERNET}',$internet,$text);     
      $transaktionsnummer = $this->app->DB->Select("SELECT transaktionsnummer FROM auftrag WHERE id='".$id."' LIMIT 1");
      $text = str_replace('{TRANSAKTIONSNUMMER}',$transaktionsnummer,$text);     
    }

    if($type=="rechnung" || $type=="lieferschein")
    {
      $auftragid = $this->app->DB->Select("SELECT auftragid FROM $type WHERE id='".$id."' LIMIT 1");
      $internet = $this->app->DB->Select("SELECT internet FROM auftrag WHERE id='".$auftragid."' LIMIT 1");
      $text = str_replace('{INTERNET}',$internet,$text);     
      $transaktionsnummer = $this->app->DB->Select("SELECT transaktionsnummer FROM auftrag WHERE id='".$auftragid."' LIMIT 1");
      $text = str_replace('{TRANSAKTIONSNUMMER}',$transaktionsnummer,$text);     
    }  

    if($type=="gutschrift")
    {
      $rechnungid = $this->app->DB->Select("SELECT rechnungid FROM $type WHERE id='".$id."' LIMIT 1");
      $auftragid = $this->app->DB->Select("SELECT auftragid FROM rechnung WHERE id='".$rechnungid."' LIMIT 1");
      $internet = $this->app->DB->Select("SELECT internet FROM auftrag WHERE id='".$auftragid."' LIMIT 1");
      $text = str_replace('{INTERNET}',$internet,$text);     
      $transaktionsnummer = $this->app->DB->Select("SELECT transaktionsnummer FROM auftrag WHERE id='".$auftragid."' LIMIT 1");
      $text = str_replace('{TRANSAKTIONSNUMMER}',$transaktionsnummer,$text);     
    }  



    if($type=="rechnung" || $type=="auftrag" || $type=="angebot")
    {
      $zahlungszieltage = $this->app->DB->Select("SELECT zahlungszieltage FROM $type WHERE id='$id' LIMIT 1");
      $zahlungszieltageskonto = $this->app->DB->Select("SELECT zahlungszieltageskonto FROM $type WHERE id='$id' LIMIT 1");
      $zahlungszielskonto = $this->app->DB->Select("SELECT zahlungszielskonto FROM $type WHERE id='$id' LIMIT 1");
      $zahlungdatum = $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD(datum, INTERVAL $zahlungszieltage DAY),'%d.%m.%Y') FROM $type WHERE id='$id' LIMIT 1");
      $zahlungszielskontodatum = $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD(datum, INTERVAL $zahlungszieltageskonto DAY),'%d.%m.%Y') FROM $type WHERE id='$id' LIMIT 1");
      $text = str_replace("{ZAHLUNGSZIELTAGE}",$zahlungszieltage,$text);
      $text = str_replace("{ZAHLUNGBISDATUM}",$zahlungdatum,$text);
    } else {
      $text = str_replace("{ZAHLUNGSZIELTAGE}","",$text);
      $text = str_replace("{ZAHLUNGBISDATUM}","",$text);
    }


    if ($type=="lieferschein")
    {
      $rechnungsid = $this->app->DB->Select("SELECT id FROM rechnung WHERE lieferschein='$id' LIMIT 1");
      if($rechnungsid > 0)
      {
        $resultrechnung = $this->app->DB->SelectArr("SELECT * FROM rechnung WHERE id='$rechnungsid' LIMIT 1");
        if($resultrechnung[0]['name']!="")
          $rechnungsadresse .= $resultrechnung[0]['name']."\r\n"; 
        if($resultrechnung[0]['abteilung']!="")
          $rechnungsadresse .= $resultrechnung[0]['abteilung']."\r\n";    
        if($resultrechnung[0]['unterabteilung']!="")
          $rechnungsadresse .= $resultrechnung[0]['unterabteilung']."\r\n";       
        if($resultrechnung[0]['strasse']!="")
          $rechnungsadresse .= $resultrechnung[0]['strasse']."\r\n";      
        if($resultrechnung[0]['adresszusatz']!="")
          $rechnungsadresse .= $resultrechnung[0]['adresszusatz']."\r\n"; 
        if($resultrechnung[0]['ansprechpartner']!="")
          $rechnungsadresse .= $resultrechnung[0]['ansprechpartner']."\r\n";      
        if($resultrechnung[0]['plz']!="")
          $rechnungsadresse .= $resultrechnung[0]['land']."-".$resultrechnung[0]['plz']." ".$resultrechnung[0]['ort']."\r\n";     
      }                       

      if($rechnungsid <=0)
        $text = str_replace('{RECHNUNGSADRESSE}',"",$text);     
      else                    
        $text = str_replace('{RECHNUNGSADRESSE}',"Rechnungsadresse: \r\n".$rechnungsadresse,$text);     
    }

    // Netto gewicht
    if($type=="auftrag" || $type=="angebot" || $type=="lieferschein" || $type=="rechnung" || $type=="gutschrift" || $type=="bestellung")
    {
      $nettogewicht = $this->app->DB->Select("SELECT SUM(REPLACE(a.gewicht,',','.')*ap.menge) 
          FROM ".$type."_position ap LEFT JOIN artikel a ON ap.artikel=a.id WHERE ap.$type='$id'");
      $text = str_replace('{NETTOGEWICHT}',number_format($nettogewicht,2,",",""),$text);     

      $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM $type WHERE id='$id' LIMIT 1");
      $text = str_replace("{ZAHLUNGSWEISE}",$zahlungsweise,$text);
    } else {
      $text = str_replace('{NETTOGEWICHT}',"-",$text);     
      $text = str_replace("{ZAHLUNGSWEISE}","-",$text);
    }


    foreach($result[0] as $key=>$value)
      $result[0][$key]=str_replace('NONBLOCKINGZERO','',$result[0][$key]);

    $result[0]['anschreiben'] = $this->app->DB->Select("SELECT anschreiben FROM `$type` WHERE id='".$id."' LIMIT 1");

    $result[0]['kundennummer'] = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='".$result[0]['adresse']."' LIMIT 1");
    $result[0]['verbandsnummer'] = $this->app->DB->Select("SELECT verbandsnummer FROM adresse WHERE id='".$result[0]['adresse']."' LIMIT 1");
    $result[0]['verband'] = $this->GetVerbandName($this->GetVerband($result[0]['adresse']));

    $tmp = $this->app->DB->Select("SELECT freifeld1 FROM adresse WHERE id='".$result[0]['adresse']."' LIMIT 1");
    $text = str_replace('{FREIFELD1}',$tmp,$text);

    $tmp = $this->app->DB->Select("SELECT freifeld2 FROM adresse WHERE id='".$result[0]['adresse']."' LIMIT 1");
    $text = str_replace('{FREIFELD2}',$tmp,$text);

    $tmp = $this->app->DB->Select("SELECT freifeld3 FROM adresse WHERE id='".$result[0]['adresse']."' LIMIT 1");
    $text = str_replace('{FREIFELD3}',$tmp,$text);

    if($result[0]['anschreiben']=="")
      $result[0]['anschreiben'] = $this->app->DB->Select("SELECT anschreiben FROM adresse WHERE id='".$result[0]['adresse']."' LIMIT 1");

    if($result[0]['anschreiben']!="")       
      $text = str_replace('{ANSCHREIBEN}',$result[0]['anschreiben'],$text);   
    else
      $text = str_replace('{ANSCHREIBEN}',"Sehr geehrte Damen und Herren",$text);     

    if($result[0]['belegnr']!="")   
      $text = str_replace('{BELEGNR}',$result[0]['belegnr'],$text);   
    else
      $text = str_replace('{BELEGNR}',"",$text);      

    if($result[0]['belegnr']!="")   
      $text = str_replace('{BELEGNUMMER}',$result[0]['belegnr'],$text);       
    else
      $text = str_replace('{BELEGNUMMER}',"",$text);  

    if($result[0]['kundennummer']!="")      
      $text = str_replace('{KUNDENNUMMER}',$result[0]['kundennummer'],$text); 
    else
      $text = str_replace('{KUNDENNUMMER}',"",$text); 

    if($result[0]['verbandsnummer']!="")
      $text = str_replace('{VERBANDSNUMMER}',$result[0]['verbandsnummer'],$text);
    else
      $text = str_replace('{VERBANDSNUMMER}',"Keine Nummer",$text);

    if($result[0]['verband']!="")
      $text = str_replace('{VERBAND}',$result[0]['verband'],$text);
    else
      $text = str_replace('{VERBAND}',"Kein Verband",$text);


    if($type=="rechnung" || $type=="lieferschein")
    {
      $tmpauftragid = $this->app->DB->Select("SELECT auftragid FROM $type WHERE id='$id' LIMIT 1");
      $result[0]['lieferdatum'] = $this->app->DB->Select("SELECT lieferdatum FROM auftrag WHERE id='$tmpauftragid' LIMIT 1");
    }


    if($result[0]['lieferdatum']!="0000-00-00" && $result[0]['lieferdatum']!="")
    {
      if($type=="angebot" || $type=="auftrag")
      {
        $lieferdatumkw = $this->app->DB->Select("SELECT lieferdatumkw FROM $type WHERE id='$id' LIMIT 1");
      }
      
      $ddate = $result[0]['lieferdatum'];
      $result[0]['lieferdatum'] = $this->app->String->Convert($result[0]['lieferdatum'],"%1-%2-%3","%3.%2.%1");
      $duedt = explode("-", $ddate);
      $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
      $week  = date('W/Y', $date);

      if($lieferdatumkw==1)
      {
        $text = str_replace('{LIEFERTERMIN}',$week,$text);       
        $result[0]['lieferdatum'] = $week;
      }
      else {
        $text = str_replace('{LIEFERTERMIN}',$result[0]['lieferdatum'],$text);  
      }

      $text = str_replace('{LIEFERWOCHE}',$week,$text);       
    }
    else
    {
      $text = str_replace('{LIEFERTERMIN}',"sofort",$text);   
      $text = str_replace('{LIEFERWOCHE}',"sofort",$text);
    }

    if($result[0]['gueltigbis']!="0000-00-00" && $result[0]['gueltigbis']!="")
    {
      $ddate = $result[0]['gueltigbis'];
      $result[0]['gueltigbis'] = $this->app->String->Convert($result[0]['gueltigbis'],"%1-%2-%3","%3.%2.%1");
      $duedt = explode("-", $ddate);
      $date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
      $week  = date('W/Y', $date);
      $text = str_replace('{GUELTIGBIS}',$result[0]['gueltigbis'],$text);     
      $text = str_replace('{GUELTIGBISWOCHE}',$week,$text);   
    }
    else
    {
      $text = str_replace('{GUELTIGBIS}',"",$text);   
      $text = str_replace('{GUELTIGBISWOCHE}',"",$text);
    }


    if($result[0]['abweichendelieferadresse']=="1")
    {
      $liefertext ="";

      if($result[0]['liefername']!="")
      {
        $liefertext .= $result[0]['liefername']."\r\n";
        $liefertextlang .= $result[0]['liefername'].", ";
      }

      if(trim($result[0]['lieferansprechpartner']) !="")
      {
        $liefertext .= $result[0]['lieferansprechpartner']."\r\n";  
        $liefertextlang .= $result[0]['lieferansprechpartner'].", ";  
      }

      if($result[0]['lieferabteilung']!="")
      {
        $liefertext .= $result[0]['lieferabteilung']."\r\n";
        $liefertextlang .= $result[0]['lieferabteilung'].", ";
      }

      if($result[0]['lieferunterabteilung']!="")
      {
        $liefertext .= $result[0]['lieferunterabteilung']."\r\n";
        $liefertextlang .= $result[0]['lieferunterabteilung'].", ";
      }

      if(trim($result[0]['lieferadresszusatz'])!="")
      {
        $liefertext .= $result[0]['lieferadresszusatz']."\r\n";
        $liefertextlang .= $result[0]['lieferadresszusatz'].", ";
      }

      if($result[0]['lieferstrasse']!="")
      {
        $liefertext .= $result[0]['lieferstrasse']."\r\n";  
        $liefertextlang .= $result[0]['lieferstrasse'].", ";  
      }

      if($result[0]['lieferplz']!="")
      {
        $liefertext .= $result[0]['lieferland']."-".$result[0]['lieferplz']." ".$result[0]['lieferort']."\r\n"; 
        $liefertextlang .= $result[0]['lieferland']."-".$result[0]['lieferplz']." ".$result[0]['lieferort']." "; 
      }

      if($liefertext=="")
      {
        $text = str_replace('{LIEFERADRESSE}',"entspricht Rechnungsadresse",$text); 
        $text = str_replace('{LIEFERADRESSELANG}',"entspricht Rechnungsadresse",$text); 
      }
      else
      {
        $text = str_replace('{LIEFERADRESSE}',$liefertext,$text); 
        $text = str_replace('{LIEFERADRESSELANG}',$liefertextlang,$text); 
      }

      $text = str_replace('{LIEFERNAME}',$result[0]['liefername'],$text); 
      $text = str_replace('{LIEFERABTEILUNG}',$result[0]['lieferabteilung'],$text); 
      $text = str_replace('{LIEFERUNTERABTEILUNG}',$result[0]['lieferunterabteilung'],$text); 
      $text = str_replace('{LIEFERLAND}',$result[0]['lieferland'],$text); 
      $text = str_replace('{LIEFERSTRASSE}',$result[0]['lieferstrasse'],$text); 
      $text = str_replace('{LIEFERORT}',$result[0]['lieferort'],$text); 
      $text = str_replace('{LIEFERPLZ}',$result[0]['lieferplz'],$text); 
      $text = str_replace('{LIEFERADRESSZUSATZ}',$result[0]['lieferadresszusatz'],$text); 
      $text = str_replace('{LIEFERANSPRECHPARTNER}',$result[0]['lieferansprechpartner'],$text); 
    } else {
      if($result[0]['name']!="")
      {
        $liefertext .= $result[0]['name']."\r\n";       
        $liefertextlang .= $result[0]['name'].", ";       
      }
      if($result[0]['ansprechpartner']!="")
      {
        $liefertext .= $result[0]['ansprechpartner']."\r\n";    
        $liefertextlang .= $result[0]['ansprechpartner'].", ";    
      }
      if($result[0]['abteilung']!="")
      {
        $liefertext .= $result[0]['abteilung']."\r\n";  
        $liefertextlang .= $result[0]['abteilung'].", ";  
      }
      if($result[0]['unterabteilung']!="")
      {
        $liefertext .= $result[0]['unterabteilung']."\r\n";     
        $liefertextlang .= $result[0]['unterabteilung'].", ";     
      }
      if($result[0]['strasse']!="")
      {
        $liefertext .= $result[0]['strasse']."\r\n";    
        $liefertextlang .= $result[0]['strasse'].", ";    
      }
      if($result[0]['adresszusatz']!="")
      {
        $liefertext .= $result[0]['adresszusatz']."\r\n";       
        $liefertextlang .= $result[0]['adresszusatz'].", ";       
      }

      if($result[0]['plz']!="")
      {
        $liefertext .= $result[0]['land']."-".$result[0]['plz']." ".$result[0]['ort']."\r\n";   
        $liefertextlang .= $result[0]['land']."-".$result[0]['plz']." ".$result[0]['ort'];   
      }

      if(1)//$type=="bestellung")
      {
        $text = str_replace('{LIEFERADRESSE}',"entspricht Rechnungsadresse",$text);     
        $text = str_replace('{LIEFERADRESSELANG}',"entspricht Rechnungsadresse",$text);     
      }
      else                    
      {
        $text = str_replace('{LIEFERADRESSE}',$liefertext,$text);       
        $text = str_replace('{LIEFERADRESSELANG}',$liefertextlang,$text);       
      }


      $text = str_replace('{LIEFERNAME}',$result[0]['name'],$text);   
      $text = str_replace('{LIEFERABTEILUNG}',$result[0]['abteilung'],$text); 
      $text = str_replace('{LIEFERUNTERABTEILUNG}',$result[0]['unterabteilung'],$text);       
      $text = str_replace('{LIEFERLAND}',$result[0]['land'],$text);   
      $text = str_replace('{LIEFERSTRASSE}',$result[0]['strasse'],$text);     
      $text = str_replace('{LIEFERORT}',$result[0]['ort'],$text);     
      $text = str_replace('{LIEFERPLZ}',$result[0]['plz'],$text);     
      $text = str_replace('{LIEFERADRESSZUSATZ}',$result[0]['adresszusatz'],$text);   
      $text = str_replace('{LIEFERANSPRECHPARTNER}',$result[0]['ansprechpartner'],$text);     
    }       

    $result[0]['datum'] = $this->app->String->Convert($result[0]['datum'],"%1-%2-%3","%3.%2.%1");

    foreach($result[0] as $key_i=>$value_i)
      $text = str_replace('{'.strtoupper($key_i).'}',$result[0][$key_i],$text);

    $adresse_arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='".$result[0]['adresse']."'");
    $adresse_arr = reset($adresse_arr);
    foreach($adresse_arr as $key_i=>$value_i)
    {
      $text = str_replace('{ADRESSE_'.strtoupper($key_i).'}',$adresse_arr[$key_i],$text);
    }

    return $text;
  }

  function CheckBearbeiter($id,$module)
  {
    $bearbeiter = $this->app->DB->Select("SELECT bearbeiter FROM $module WHERE id='$id' LIMIT 1");
    if($bearbeiter=="" || $bearbeiter==0)
    {
      // pruefe ob es innendienst verantwortlichen gib
      $adresse = $this->app->DB->Select("SELECT adresse FROM $module WHERE id='$id' LIMIT 1");
      $innendienst = $this->app->DB->Select("SELECT innendienst FROM adresse WHERE id='$adresse' LIMIT 1");
      $innendienst_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$innendienst' LIMIT 1");

      if($innendienst_name!="")
        $this->app->DB->Update("UPDATE $module SET bearbeiter='".$innendienst_name."' WHERE id='$id' LIMIT 1");
      else
      {
        if($this->app->DB->Select("SELECT bearbeiter FROM $module WHERE id='$id' LIMIT 1")=="")
          $this->app->DB->Update("UPDATE $module SET bearbeiter='".$this->app->User->GetName()."' WHERE id='$id' LIMIT 1");
      }
    }
    else if (is_numeric($bearbeiter))
    {
      $bearbeiter = $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$bearbeiter."' LIMIT 1");
      $this->app->DB->Update("UPDATE $module SET bearbeiter='".$bearbeiter."' WHERE id='$id' LIMIT 1");
    }
  }


  function VertriebAendern($table,$id,$cmd="",$sid="")
  {
    if ($cmd=="change")
    {
      if($sid > 0 && $id > 0)
      {
        $name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$sid' LIMIT 1");       
        $this->app->DB->Update("UPDATE $table SET vertriebid = $sid, vertrieb='$name' WHERE id=$id LIMIT 1");
        header("Location: index.php?module=$table&action=edit&id=$id&cmd=");
        exit;
      }
    }
    else if($cmd!="change" && $cmd!="")
    {
      $this->app->erp->MenuEintrag("index.php?module=$table&action=edit&id=$id","Zur&uuml;ck zur &Uuml;bersicht");
      $this->app->Tpl->Set('TAB1',"<div class=\"info\">Bitte den neuen Verteter bzw. Verk&auml;ufer f&uuml;r die Abrechnung der Provision ausw&auml;hlen.</div>");

      $this->app->YUI->TableSearch('TAB1',"adressevertrieb"); 

      $this->app->Tpl->Parse('PAGE',"tabview.tpl"); 
      return 1; 
    }  
    else {
      $schreibschutz= $this->app->DB->Select("SELECT schreibschutz FROM $table WHERE id='$id' LIMIT 1");
      if($schreibschutz!="1")
      {
        $this->app->Tpl->Set('VERTRIEBBUTTON',"<a href=\"index.php?module=$table&action=edit&id=$id&cmd=$table\"><img src=\"./themes/new/images/edit.png\"></a>");
      }
      return 0;
    }
  }


  function EnableTab($tab)
  {
    $this->app->Tpl->Add('ADDITIONALJAVASCRIPT',"<script type=\"text/javascript\">
        $(document).ready(function() { 
          $('a[href=\"#$tab\"]').click(); 
          });</script>");
  }


  function CheckVertrieb($id,$module)
  {

    $vertrieb = $this->app->DB->Select("SELECT vertriebid FROM $module WHERE id='$id' LIMIT 1");
   
    if($vertrieb<=0 || $vertrieb=="")
    {
      // pruefe ob es innendienst verantwortlichen gib
      $adresse = $this->app->DB->Select("SELECT adresse FROM $module WHERE id='$id' LIMIT 1");
      $vertrieb = $this->app->DB->Select("SELECT vertrieb FROM adresse WHERE id='$adresse' LIMIT 1");
      $vertrieb_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$vertrieb' LIMIT 1");

      if($vertrieb_name!="" && $vertrieb_name!="0" && vertrieb_name_beleg=="")
      {
        $this->app->DB->Update("UPDATE $module SET vertriebid='$vertrieb',vertrieb='".$vertrieb_name."' WHERE id='$id' LIMIT 1");
      }
      else
      {
        $checktmp = $this->app->DB->Select("SELECT vertrieb FROM $module WHERE id='$id' LIMIT 1");
        if($checktmp=="" || $checktmp=="0")
        {
          $this->app->DB->Update("UPDATE $module SET vertriebid='$vertrieb', vertrieb='".$this->app->User->GetName()."' WHERE id='$id' LIMIT 1");
        }
      }
    }

    else if (is_numeric($vertrieb))
    {
      $vertrieb_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$vertrieb."' LIMIT 1");
      $this->app->DB->Update("UPDATE $module SET vertrieb='".$vertrieb_name."',vertriebid='$vertrieb' WHERE id='$id' LIMIT 1");
    }

  }


  function CheckBuchhaltung($id,$module)
  {
    $buchhaltung = $this->app->DB->Select("SELECT buchhaltung FROM $module WHERE id='$id' LIMIT 1");
    if($buchhaltung=="")
      $this->app->DB->Update("UPDATE $module SET buchhaltung='".$this->app->User->GetName()."' WHERE id='$id' LIMIT 1");
    else if (is_numeric($buchhaltung))
    {
      $buchhaltung = $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$buchhaltung."' LIMIT 1");
      $this->app->DB->Update("UPDATE $module SET bearbeiter='".$buchhaltung."' WHERE id='$id' LIMIT 1");
    }
  }


  function GetArtikelStandardlager($artikel)
  {
    $standardlager = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='".$artikel."' LIMIT 1");
    if($standardlager <=0)
    {
      //lagerplatz wo am meisten drinnen ist
       $lagerbezeichnung = $this->app->DB->Select("SELECT lp.kurzbezeichnung FROM lager_platz_inhalt lpi LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz
        WHERE lpi.artikel='".$artikel."' AND lp.autolagersperre!=1 AND lp.sperrlager!='1' ORDER by lpi.menge DESC LIMIT 1");
    } else {
      $lagerbezeichnung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='".$standardlager."' LIMIT 1");
    }
    return $lagerbezeichnung;
  }

  function LieferscheinPositionenDrucken($lieferschein,$etiketten_drucker,$etiketten_art)
  {
    /*
       Barcode, Artikelname,
       Lagerplatznummer, 
        Artikelstückzahl
    */
   $pos = $this->app->DB->SelectArr("SELECT * FROM lieferschein_position WHERE lieferschein='$lieferschein' ORDER by sort");

   for($i=0;$i<count($pos);$i++)
   {
    $lagerbezeichnung = $this->GetArtikelStandardlager($pos[$i]['artikel']);

    $tmp['name_de']=$pos[$i]['bezeichnung'];
    $tmp['nummer']=$pos[$i]['nummer'];
    $tmp['menge']=$pos[$i]['menge'];
    $tmp['lager_platz_name']=$lagerbezeichnung;

    $tmp['belegnr']=$this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$lieferschein' LIMIT 1");
    $this->app->erp->EtikettenDrucker($etiketten_art,1,"","",$tmp,"",$etiketten_drucker); 
   }

   $tmp['name_de']="#################";
   $tmp['nummer']="#####";
   $tmp['menge']="####";
   $tmp['belegnr']="####";
   $tmp['lager_platz_name']="####";

   $this->app->erp->EtikettenDrucker($etiketten_art,1,"","",$tmp,"",$etiketten_drucker); 
  }


  function MessageHandlerStandardForm()
  {
    $module = $this->app->Secure->GetGET("module");
    $id = $this->app->Secure->GetGET("id");

    if($this->app->Secure->GetPOST("speichern")!="")
    {
      if($this->app->Secure->GetGET("msg")=="")
      {
        $msg = $this->app->Secure->GetGET("msg");
        $msg = $msg.$this->app->Tpl->Get(MESSAGE);
        $msg = base64_encode($msg);
      } else {
        $msg = $this->app->Secure->GetGET("msg");
      }

      header("Location: index.php?module=$module&action=edit&id=$id&msg=$msg");
      exit;
    }


  }


  function superentities( $str ){
    // get rid of existing entities else double-escape

    $str = html_entity_decode(stripslashes($str),ENT_QUOTES| ENT_HTML5,'UTF-8');
    //              $str = str_replace("'","&apos;",$str);
    //                              return $str; 
    $ar = preg_split('/(?<!^)(?!$)/u', $str );  // return array of every multi-byte character
    foreach ($ar as $c){
      $o = ord($c);
      if ( (strlen($c) > 1) || /* multi-byte [unicode] */
          ($o <32 || $o > 126) || /* <- control / latin weirdos -> */
          ($o >33 && $o < 35) ||/* quotes + ambersand */
          ($o >35 && $o < 40) ||/* quotes + ambersand */
          ($o >59 && $o < 63) /* html */
         ) {
        // convert to numeric entity
        //$c = @mb_encode_numericentity($c,array (0x0, 0xffff, 0, 0xffff), 'UTF-8');
        $c = $this->convertToHtml($c);
      }
      if(!isset($str2))$str2 = '';
      $str2 .= $c;
    }
    return $str2;
  }

  function convertToHtml($str) {
    //                  $str = utf8_decode($str);
    //              $trans_tbl = get_html_translation_table (HTML_ENTITIES,ENT_HTML5);
    if (version_compare(PHP_VERSION, '5.3.4') >= 0) {
      $trans_tbl = array_flip(get_html_translation_table(HTML_ENTITIES, ENT_COMPAT, 'UTF-8'));
    } else {
      $trans_tbl = array_flip(get_html_translation_table(HTML_ENTITIES, ENT_COMPAT));
      if (!empty($trans_tbl)) {
        foreach ($trans_tbl as $key => $entry) {
          $trans_tbl[$key] = utf8_encode($entry);
        } 
      }
    }

    // MS Word strangeness..
    // smart single/ double quotes:
    $trans_tbl[chr(39)] = '&apos;';
    $trans_tbl[chr(145)] = '\'';
    $trans_tbl[chr(146)] = '\'';
    //$trans_tbl[chr(147)] = '&quot;';
    $trans_tbl[chr(148)] = '&quot;';
    $trans_tbl[chr(142)] = '&eacute;';
    //&#65279;
    //$trans_tbl[$this->unicode_chr(65279)] = "BENE";
    //$str = str_replace("\xFF\xFE", "BENE", $str);


    return strtr ($str, $trans_tbl); 
  } 



  function InitialSetup()
  {
    //pruefe ob es bereits daten gibt
    //$this->app->DB->Select("LOCK TABLES adresse WRITE;");
    if($this->app->DB->Select("SELECT COUNT(id) FROM adresse WHERE geloescht!=1")<=0)
    {
      $mitarbeiternummer = $this->GetNextMitarbeiternummer();

      $sql = 'INSERT INTO `adresse` (`id`, `typ`, `marketingsperre`, `trackingsperre`, `rechnungsadresse`, `sprache`, `name`, `abteilung`, `unterabteilung`, `ansprechpartner`, `land`, `strasse`, `ort`, `plz`, `telefon`, `telefax`, `mobil`, `email`, `ustid`, `ust_befreit`, `passwort_gesendet`, `sonstiges`, `adresszusatz`, `kundenfreigabe`, `steuer`, `logdatei`, `kundennummer`, `lieferantennummer`, `mitarbeiternummer`, `konto`, `blz`, `bank`, `inhaber`, `swift`, `iban`, `waehrung`, `paypal`, `paypalinhaber`, `paypalwaehrung`, `projekt`, `partner`, `geloescht`, `firma`) VALUES (NULL, \'\', \'\', \'\', \'\', \'\', \'Administrator\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', NOW(), \'\', \'\', \''.$mitarbeiternummer.'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'1\', \'\', \'\', \'1\');';
      $this->app->DB->InsertWithoutLog($sql);
      $adresse = $this->app->DB->GetInsertID();

      $sql = "INSERT INTO `adresse_rolle` (`id`, `adresse`, `projekt`, `subjekt`, `praedikat`, `objekt`, `parameter`, `von`, `bis`) VALUES
        ('', '$adresse', 0, 'Mitarbeiter', '', '', '', NOW(), '0000-00-00');";
      $this->app->DB->InsertWithoutLog($sql);

      $sql = 'INSERT INTO `firma` (`id`, `name`, `standardprojekt`) VALUES (NULL, \'Musterfirma\', \'1\');';
      $this->app->DB->InsertWithoutLog($sql);

      $sql = 'INSERT INTO `user` (`id`, `username`, `password`, `repassword`, `description`, `settings`, `parentuser`, `activ`, `type`, `adresse`, `standarddrucker`, `firma`, `logdatei`,`externlogin`) VALUES (NULL, \'admin\', ENCRYPT(\'admin\'), \'\', NULL, \'\', NULL, \'1\', \'admin\', \''.$adresse.'\', \'\', \'1\', NOW(),\'1\');';
      $this->app->DB->InsertWithoutLog($sql);


      $sql = 'INSERT INTO `projekt` (`id`, `name`, `abkuerzung`, `verantwortlicher`, `beschreibung`, `sonstiges`, `aktiv`, `farbe`, `autoversand`, `checkok`, `checkname`, `zahlungserinnerung`, `zahlungsmailbedinungen`, `folgebestaetigung`, `kundenfreigabe_loeschen`, `autobestellung`, `firma`, `logdatei`) VALUES (NULL, \'Hauptprojekt\', \'HAUPTPROJEKT\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'1\', \'\');';
      $this->app->DB->InsertWithoutLog($sql);
    }
    //$this->app->DB->Select("UNLOCK TABLES;");
  }

  function ValidLager($lager)
  {
    $result = $this->app->DB->Select("SELECT id FROM lager_platz WHERE id='$lager' LIMIT 1");
    if($result > 0)
      return 1;
    else return 0;

  }

  function ValidArtikelID($artikel)
  {
    if($artikel<=0 || $artikel=="" || !is_numeric($artikel))
      return 0;

    $result = $this->app->DB->Select("SELECT id FROM artikel WHERE id='$artikel' LIMIT 1");
    if($result > 0)
    {
      return 1;
    }

    return 0;
  }

  function ValidArtikelnummer($artikel)
  {
    if($artikel<=0 || $artikel=="")
      return 0;

    $result = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$artikel' LIMIT 1");
    if($result > 0)
      return 1;

    $result = $this->app->DB->Select("SELECT id FROM artikel WHERE id='$artikel' LIMIT 1");
    if($result > 0)
      return 1;

    $result = $this->app->DB->Select("SELECT id FROM artikel WHERE ean='$artikel' LIMIT 1");
    if($result > 0)
      return 1;

    return 0;
  }


  function ProjektleiterRechte()
  {

    // alle projekte Wo Mitarbeiter ist
    $result = $this->app->DB->SelectArr("SELECT parameter FROM adresse_rolle WHERE subject='Projektleiter' AND (bis='0000-00-00' OR bis < NOW()) AND adresse='".$this->app->User->GetAdresse()."'");
    //if($sql!="" && count($result)>0) $sql .= " OR ";

    for($i=0;$i<count($result);$i++)
    {
      $sql .= "p.id='".$result[$i]['parameter']."'";
      if($i < count($result) - 1)
        $sql .= " OR ";
    }

    if($sql!="")    
      return " AND ($sql) ";
    else
      return "";
  }


  function UserProjektRecht($projekt)
  {
    if($this->app->User->GetType()=="admin")return true;
    if(!$projekt)return true;
    if($this->app->DB->Select("SELECT COUNT(parameter) FROM adresse_rolle WHERE (bis='0000-00-00' OR bis < NOW()) AND adresse='".$this->app->User->GetAdresse()."' AND (parameter='' OR parameter='0')"))return true;
    if($this->app->DB->Select("SELECT oeffentlich FROM projekt WHERE id = '$projekt' LIMIT 1"))return true;
    if($this->app->DB->Select("SELECT parameter FROM adresse_rolle WHERE (bis='0000-00-00' OR bis < NOW()) AND adresse='".$this->app->User->GetAdresse()."' AND parameter = '$projekt'"))return true;
    return false;
  }

  function ProjektRechte($prefix="p.id")
  {

    // alle oeffentlichen projekte
    $result = $this->app->DB->SelectArr("SELECT id FROM projekt WHERE oeffentlich='1'");
    for($i=0;$i<count($result);$i++)
    {
      if(!isset($sql))$sql = '';
      $sql .= $prefix."='".$result[$i]['id']."'";
      if($i < count($result) - 1)
        $sql .= " OR ";
    }

    // alle projekte Wo Mitarbeiter ist
    $result = $this->app->DB->SelectArr("SELECT parameter FROM adresse_rolle WHERE (bis='0000-00-00' OR bis < NOW()) AND adresse='".$this->app->User->GetAdresse()."'");
    if(isset($sql) && $sql!="" && count($result)>0) $sql .= " OR ";

    for($i=0;$i<count($result);$i++)
    {
      if(!isset($sql))$sql = '';
      $sql .= $prefix."='".$result[$i]['parameter']."'";
      if($i < count($result) - 1)
        $sql .= " OR ";
    }

    // wenn mitarbeiter projektleiter für alles     dann darf man alles sehen
    $resultalle = $this->app->DB->Select("SELECT COUNT(parameter) FROM adresse_rolle WHERE (bis='0000-00-00' OR bis < NOW()) AND adresse='".$this->app->User->GetAdresse()."' AND (parameter='' OR parameter='0')");


    //if($sql=="") return "";

    if($this->app->User->GetType()=="admin" || $resultalle > 0) 
      return "";
    else
      return " AND ($sql) ";
  }


  function StandardVersandart($projekt="")
  {
    $tmp = $this->Firmendaten("versandart");
    return $tmp;
  }

  function StandardZahlungsweise($projekt="")
  {
    $tmp = $this->Firmendaten("zahlungsweise");
    if($tmp=="") $tmp="rechnung";
    return $tmp;
  }

  function ZahlungsZielSkonto($projekt="")
  {
    $tmp = $this->Firmendaten("zahlungszielskonto");
    if($tmp <= 0)
      return 0;
    else return $tmp;
  }


  function ZahlungsZielTageSkonto($projekt="")
  {
    $tmp = $this->Firmendaten("zahlungszieltageskonto");
    if($tmp <= 0)
      return 0;
    else return $tmp;
  }

  function ZahlungsZielTage($projekt="")
  {
    $tmp = $this->Firmendaten("zahlungszieltage");
    if($tmp <=0)
      return 0;
    else return $tmp;
  }

  function ModulVorhanden($module)
  {
    if($module=="verband")
    {
      if($this->Firmendaten("modul_verband")!="1")
        return false;
    } 
    else if($module=="multilevel")
    {
      if($this->Firmendaten("modul_mlm")!="1")
        return false;
    } 
    else if($module=="verein")
    {
      if($this->Firmendaten("modul_verein")!="1")
        return false;
    } 


    if(is_file("pages/".$module.".php"))
    {
      return true;
    } 
    else return false;
  }

  function TableSearchAllowed($cmd)
  {
    $tmp = $this->app->YUI->TableSearch("",$cmd,"allowed");
    $result= false;
    if(count($tmp)>0)
    {
      foreach($tmp as $module=>$value)
      {
        foreach($tmp[$module] as $action)
        {
          if($this->RechteVorhanden($module,$action)) return true;
        }
      }
    } else {
      // dient nur vorruebergeben bis alle faelle in yui class umgestellt sind
      $result = true;
    }
    return $result;
  }

  function RechteVorhanden($module,$action)
  {
    if($this->app->User->GetType()=="admin") { 
      // wenn das Modul exisitiert
      if(is_file("pages/".$module.".php"))
      {
        return true;
      } 
    }

    if(is_file("pages/".$module.".php"))
      $result = $this->app->DB->Select("SELECT id FROM userrights WHERE module='$module' AND action='$action' AND permission='1' AND user='".$this->app->User->GetID()."' LIMIT 1");

    if($result > 0)
      return true;
    else
      return false;
  }


  function fixeUmlaute($text) {                  
    $umlaute = $this->getUmlauteArray();                  
    foreach ($umlaute as $key => $value){  
      $text = str_replace($key,$value,$text);
    } 
    return $text;
  }


  function getUmlauteArray() { return array( 'Ã¼'=>'ü', 'Ã¤'=>'ä', 'Ã¶'=>'ö', 'Ã–'=>'Ö', 'Ã?'=>'ß','ÃŸ'=>'ß', 'Ã '=>'à', 'Ã¡'=>'á', 'Ã¢'=>'â', 'Ã£'=>'ã', 'Ã¹'=>'ù', 'Ãº'=>'ú', 'Ã»'=>'û', 'Ã™'=>'Ù', 'Ãš'=>'Ú', 'Ã›'=>'Û', 'Ãœ'=>'Ü', 'Ã²'=>'ò', 'Ã³'=>'ó', 'Ã´'=>'ô', 'Ã¨'=>'è', 'Ã©'=>'é', 'Ãª'=>'ê', 'Ã«'=>'ë', 'Ã€'=>'À', 'Ã<81>'=>'Á', 'Ã‚'=>'Â', 'Ãƒ'=>'Ã', 'Ã„'=>'Ä', 'Ã…'=>'Å', 'Ã‡'=>'Ç', 'Ãˆ'=>'È', 'Ã‰'=>'É', 'ÃŠ'=>'Ê', 'Ã‹'=>'Ë', 'ÃŒ'=>'Ì', 'Ã<8d>'=>'Í', 'ÃŽ'=>'Î', 'Ã<8f>'=>'Ï', 'Ã‘'=>'Ñ', 'Ã’'=>'Ò', 'Ã“'=>'Ó', 'Ã”'=>'Ô', 'Ã•'=>'Õ', 'Ã˜'=>'Ø', 'Ã¥'=>'å', 'Ã¦'=>'æ', 'Ã§'=>'ç', 'Ã¬'=>'ì', 'Ã­'=>'í', 'Ã®'=>'î', 'Ã¯'=>'ï', 'Ã°'=>'ð', 'Ã±'=>'ñ', 'Ãµ'=>'õ', 'Ã¸'=>'ø', 'Ã½'=>'ý', 'Ã¿'=>'ÿ', 'â‚¬'=>'€' );
  }


  function ConvertForDBUTF8($string)
  {
    //$string = $this->unicode_decode($string);
    return htmlentities($string,ENT_QUOTES);
    //return htmlentities(utf8_encode($string),ENT_QUOTES);
    //              return html_entity_decode($string, ENT_QUOTES, 'UTF-8'); //uahlungseingang
  }

  function ConvertForDB($string)
  {
    return htmlentities(utf8_decode($string),ENT_QUOTES);
    //return htmlentities(utf8_encode($string),ENT_QUOTES);
    //              return html_entity_decode($string, ENT_QUOTES, 'UTF-8'); //uahlungseingang
  }


  function ConvertForTableSearch($string)
  {
    $string = $this->unicode_decode($string);
    $cmd = $this->app->Secure->GetGET("cmd");
    if($cmd=="kontoauszuege")       
      return trim(html_entity_decode($string, ENT_QUOTES, 'UTF-8')); //uahlungseingang
    else
      return ($string);
  }



  function make_clickable($text)
  {
    return preg_replace('@(?<![.*">])\b(?:(?:https?|ftp|file)://|[a-z]\.)[-A-Z0-9+&#/%=~_|$?!:,.]*[A-Z0-9+&#/%=~_|$]@i', '<a href="\0">\0</a>', $text);
  }

  function unicode_decode($content) {
    $ISO10646XHTMLTrans = array(
        "&"."#34;" => "&quot;",
        "&"."#38;" => "&amp;",
        "&"."#39;" => "&apos;",
        "&"."#60;" => "&lt;",
        "&"."#62;" => "&gt;",
        "&"."#128;" => "&euro;",
        "&"."#160;" => "",
        "&"."#161;" => "&iexcl;",
        "&"."#162;" => "&cent;",
        "&"."#163;" => "&pound;",
        "&"."#164;" => "&curren;",
        "&"."#165;" => "&yen;",
        "&"."#166;" => "&brvbar;",
        "&"."#167;" => "&sect;",
        "&"."#168;" => "&uml;",
        "&"."#169;" => "&copy;",
        "&"."#170;" => "&ordf;",
        "&"."#171;" => "&laquo;",
        "&"."#172;" => "&not;",
        "&"."#173;" => "­",
        "&"."#174;" => "&reg;",
        "&"."#175;" => "&macr;",
        "&"."#176;" => "&deg;",
        "&"."#177;" => "&plusmn;",
        "&"."#178;" => "&sup2;",
        "&"."#179;" => "&sup3;",
        "&"."#180;" => "&acute;",
        "&"."#181;" => "&micro;",
        "&"."#182;" => "&para;",
        "&"."#183;" => "&middot;",
        "&"."#184;" => "&cedil;",
        "&"."#185;" => "&sup1;",
        "&"."#186;" => "&ordm;",
        "&"."#187;" => "&raquo;",
        "&"."#188;" => "&frac14;",
        "&"."#189;" => "&frac12;",
        "&"."#190;" => "&frac34;",
        "&"."#191;" => "&iquest;",
        "&"."#192;" => "&Agrave;",
        "&"."#193;" => "&Aacute;",
        "&"."#194;" => "&Acirc;",
        "&"."#195;" => "&Atilde;",
        "&"."#196;" => "&Auml;",
        "&"."#197;" => "&Aring;",
        "&"."#198;" => "&AElig;",
        "&"."#199;" => "&Ccedil;",
        "&"."#200;" => "&Egrave;",
        "&"."#201;" => "&Eacute;",
        "&"."#202;" => "&Ecirc;",
        "&"."#203;" => "&Euml;",
        "&"."#204;" => "&Igrave;",
        "&"."#205;" => "&Iacute;",
        "&"."#206;" => "&Icirc;",
        "&"."#207;" => "&Iuml;",
        "&"."#208;" => "&ETH;",
        "&"."#209;" => "&Ntilde;",
        "&"."#210;" => "&Ograve;",
        "&"."#211;" => "&Oacute;",
        "&"."#212;" => "&Ocirc;",
        "&"."#213;" => "&Otilde;",
        "&"."#214;" => "&Ouml;",
        "&"."#215;" => "&times;",
        "&"."#216;" => "&Oslash;",
        "&"."#217;" => "&Ugrave;",
        "&"."#218;" => "&Uacute;",
        "&"."#219;" => "&Ucirc;",
        "&"."#220;" => "&Uuml;",
        "&"."#221;" => "&Yacute;",
        "&"."#222;" => "&THORN;",
        "&"."#223;" => "&szlig;",
        "&"."#224;" => "&agrave;",
        "&"."#225;" => "&aacute;",
        "&"."#226;" => "&acirc;",
        "&"."#227;" => "&atilde;",
        "&"."#228;" => "&auml;",
        "&"."#229;" => "&aring;",
        "&"."#230;" => "&aelig;",
        "&"."#231;" => "&ccedil;",
        "&"."#232;" => "&egrave;",
        "&"."#233;" => "&eacute;",
        "&"."#234;" => "&ecirc;",
        "&"."#235;" => "&euml;",
        "&"."#236;" => "&igrave;",
        "&"."#237;" => "&iacute;",
        "&"."#238;" => "&icirc;",
        "&"."#239;" => "&iuml;",
        "&"."#240;" => "&eth;",
        "&"."#241;" => "&ntilde;",
        "&"."#242;" => "&ograve;",
        "&"."#243;" => "&oacute;",
        "&"."#244;" => "&ocirc;",
        "&"."#245;" => "&otilde;",
        "&"."#246;" => "&ouml;",
        "&"."#247;" => "&divide;",
        "&"."#248;" => "&oslash;",
        "&"."#249;" => "&ugrave;",
        "&"."#250;" => "&uacute;",
        "&"."#251;" => "&ucirc;",
        "&"."#252;" => "&uuml;",
        "&"."#253;" => "&yacute;",
        "&"."#254;" => "&thorn;",
        "&"."#255;" => "&yuml;",
        "&"."#338;" => "&OElig;",
        "&"."#339;" => "&oelig;",
        "&"."#352;" => "&Scaron;",
        "&"."#353;" => "&scaron;",
        "&"."#376;" => "&Yuml;",
        "&"."#402;" => "&fnof;",
        "&"."#710;" => "&circ;",
        "&"."#732;" => "&tilde;",
        "&"."#913;" => "&Alpha;",
        "&"."#914;" => "&Beta;",
        "&"."#915;" => "&Gamma;",
        "&"."#916;" => "&Delta;",
        "&"."#917;" => "&Epsilon;",
        "&"."#918;" => "&Zeta;",
        "&"."#919;" => "&Eta;",
        "&"."#920;" => "&Theta;",
        "&"."#921;" => "&Iota;",
        "&"."#922;" => "&Kappa;",
        "&"."#923;" => "&Lambda;",
        "&"."#924;" => "&Mu;",
        "&"."#925;" => "&Nu;",
        "&"."#926;" => "&Xi;",
        "&"."#927;" => "&Omicron;",
        "&"."#928;" => "&Pi;",
        "&"."#929;" => "&Rho;",
        "&"."#931;" => "&Sigma;",
        "&"."#932;" => "&Tau;",
        "&"."#933;" => "&Upsilon;",
        "&"."#934;" => "&Phi;",
        "&"."#935;" => "&Chi;",
        "&"."#936;" => "&Psi;",
        "&"."#937;" => "&Omega;",
        "&"."#945;" => "&alpha;",
        "&"."#946;" => "&beta;",
        "&"."#947;" => "&gamma;",
        "&"."#948;" => "&delta;",
        "&"."#949;" => "&epsilon;",
        "&"."#950;" => "&zeta;",
        "&"."#951;" => "&eta;",
        "&"."#952;" => "&theta;",
        "&"."#953;" => "&iota;",
        "&"."#954;" => "&kappa;",
        "&"."#955;" => "&lambda;",
        "&"."#956;" => "&mu;",
        "&"."#957;" => "&nu;",
        "&"."#958;" => "&xi;",
        "&"."#959;" => "&omicron;",
        "&"."#960;" => "&pi;",
        "&"."#961;" => "&rho;",
        "&"."#962;" => "&sigmaf;",
        "&"."#963;" => "&sigma;",
        "&"."#964;" => "&tau;",
        "&"."#965;" => "&upsilon;",
        "&"."#966;" => "&phi;",
        "&"."#967;" => "&chi;",
        "&"."#968;" => "&psi;",
        "&"."#969;" => "&omega;",
        "&"."#977;" => "&thetasym;",
        "&"."#978;" => "&upsih;",
        "&"."#982;" => "&piv;",
        "&"."#8194;" => "&ensp;",
        "&"."#8195;" => "&emsp;",
        "&"."#8201;" => "&thinsp;",
        "&"."#8204;" => "&zwnj;",
        "&"."#8205;" => "&zwj;",
        "&"."#8206;" => "&lrm;",
        "&"."#8207;" => "&rlm;",
        "&"."#8211;" => "&ndash;",
        "&"."#8212;" => "&mdash;",
        "&"."#8216;" => "&lsquo;",
        "&"."#8217;" => "&rsquo;",
        "&"."#8218;" => "&sbquo;",
        "&"."#8220;" => "&ldquo;",
        "&"."#8221;" => "&rdquo;",
        "&"."#8222;" => "&bdquo;",
        "&"."#8224;" => "&dagger;",
        "&"."#8225;" => "&Dagger;",
        "&"."#8226;" => "&bull;",
        "&"."#8230;" => "&hellip;",
        "&"."#8240;" => "&permil;",
        "&"."#8242;" => "&prime;",
        "&"."#8243;" => "&Prime;",
        "&"."#8249;" => "&lsaquo;",
        "&"."#8250;" => "&rsaquo;",
        "&"."#8254;" => "&oline;",
        "&"."#8260;" => "&frasl;",
        "&"."#8364;" => "&euro;",
        "&"."#8465;" => "&image;",
        "&"."#8472;" => "&weierp;",
        "&"."#8476;" => "&real;",
        "&"."#8482;" => "&trade;",
        "&"."#8501;" => "&alefsym;",
        "&"."#8592;" => "&larr;",
        "&"."#8593;" => "&uarr;",
        "&"."#8594;" => "&rarr;",
        "&"."#8595;" => "&darr;",
        "&"."#8596;" => "&harr;",
        "&"."#8629;" => "&crarr;",
        "&"."#8656;" => "&lArr;",
        "&"."#8657;" => "&uArr;",
        "&"."#8658;" => "&rArr;",
        "&"."#8659;" => "&dArr;",
        "&"."#8660;" => "&hArr;",
        "&"."#8704;" => "&forall;",
        "&"."#8706;" => "&part;",
        "&"."#8707;" => "&exist;",
        "&"."#8709;" => "&empty;",
        "&"."#8711;" => "&nabla;",
        "&"."#8712;" => "&isin;",
        "&"."#8713;" => "&notin;",
        "&"."#8715;" => "&ni;",
        "&"."#8719;" => "&prod;",
        "&"."#8721;" => "&sum;",
        "&"."#8722;" => "&minus;",
        "&"."#8727;" => "&lowast;",
        "&"."#8730;" => "&radic;",
        "&"."#8733;" => "&prop;",
        "&"."#8734;" => "&infin;",
        "&"."#8736;" => "&ang;",
        "&"."#8743;" => "&and;",
        "&"."#8744;" => "&or;",
        "&"."#8745;" => "&cap;",
        "&"."#8746;" => "&cup;",
        "&"."#8747;" => "&int;",
        "&"."#8756;" => "&there4;",
        "&"."#8764;" => "&sim;",
        "&"."#8773;" => "&cong;",
        "&"."#8776;" => "&asymp;",
        "&"."#8800;" => "&ne;",
        "&"."#8801;" => "&equiv;",
        "&"."#8804;" => "&le;",
        "&"."#8805;" => "&ge;",
        "&"."#8834;" => "&sub;",
        "&"."#8835;" => "&sup;",
        "&"."#8836;" => "&nsub;",
        "&"."#8838;" => "&sube;",
        "&"."#8839;" => "&supe;",
        "&"."#8853;" => "&oplus;",
        "&"."#8855;" => "&otimes;",
        "&"."#8869;" => "&perp;",
        "&"."#8901;" => "&sdot;",
        "&"."#8968;" => "&lceil;",
        "&"."#8969;" => "&rceil;",
        "&"."#8970;" => "&lfloor;",
        "&"."#8971;" => "&rfloor;",
        "&"."#9001;" => "&lang;",
        "&"."#9002;" => "&rang;",
        "&"."#9674;" => "&loz;",
        "&"."#9824;" => "&spades;",
        "&"."#9827;" => "&clubs;",
        "&"."#9829;" => "&hearts;",
        "&"."#9830;" => "&diams;"
          );


    reset($ISO10646XHTMLTrans);
    while(list($UnicodeChar, $XHTMLEquiv) = each($ISO10646XHTMLTrans)) {
      $content = str_replace($UnicodeChar, $XHTMLEquiv, $content);
    }

    //      $content = html_entity_decode($content, ENT_COMPAT, 'UTF-8');

    // return translated
    return($content);
  }

  function html_entity_decode_utf8($string)
  {
    static $trans_tbl;
    $string = preg_replace('~&#x([0-9a-f]+);~ei','code2utf(hexdec(“\\1″))', $string);
    $string = preg_replace('~&#([0-9]+);~e', 'code2utf(\\1)',$string);

    if (!isset($trans_tbl))
    {
      $trans_tbl = array();
      foreach (get_html_translation_table(HTML_ENTITIES) as
          $val=>$key)
        $trans_tbl[$key] = utf8_encode($val);
    }
    return strtr($string, $trans_tbl);
  }

  function GetPlainText($string)
  {
    $string = str_replace("NONBLOCKINGZERO","&#65279;",$string);
    return htmlspecialchars(trim(html_entity_decode($string, ENT_QUOTES, 'UTF-8')));
  }

  function MergePDF($files)
  {
    //PDF Dateien erstellen
    $pdffiles = implode(" ",$files);

    $tmpname = tempnam($this->GetTMP(),"");

    //echo("pdftk $pdffiles cat output ".$dir."/".$abrechnung.".pdf");

    system("pdftk $pdffiles cat output ".$tmpname);

    $raw_content = file_get_contents($tmpname);
    unlink($tmpname);
    return $raw_content;
  }

  function ReadyForPDF($string)
  {
    //return $string;
    $string = str_replace("&rsquo;","'",$string);
    $string = str_replace("&apos;","'",$string);
    $string = str_replace("NONBLOCKINGZERO","",$string);
    return trim(html_entity_decode($string, ENT_QUOTES, 'UTF-8'));
  }


  function ColorPicker() {
    $colors = array('#004704','#C40046','#832BA8','#FF8128','#7592A0');

    $out = "<option value=\"\" style=\"background-color: #FFFFFF\" onclick=\"this.parentElement.style.background='#FFFFFF'\">Keine</option>";
    for($i=0;$i<count($colors);$i++)
      $out .= "<option value=\"{$colors[$i]}\" style=\"background-color: {$colors[$i]}\" onclick=\"this.parentElement.style.background='{$colors[$i]}'\">&nbsp;</option>";

    return $out;
  }

  function hex_dump($data, $newline="\n")
  {
    static $from = '';
    static $to = '';

    static $width = 16; # number of bytes per line

      static $pad = '.'; # padding for non-visible characters

      if ($from==='')
      {
        for ($i=0; $i<=0xFF; $i++)
        {
          $from .= chr($i);
          $to .= ($i >= 0x20 && $i <= 0x7E) ? chr($i) : $pad;
        }
      }

    $hex = str_split(bin2hex($data), $width*2);
    $chars = str_split(strtr($data, $from, $to), $width);

    $offset = 0;
    foreach ($hex as $i => $line)
    {
      echo sprintf('%6X',$offset).' : '.implode(' ', str_split($line,2)) . ' [' . $chars[$i] . ']' . $newline;
      $offset += $width;
    }
  }

  function KalenderList($parsetarget)
  {
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Kalender");
    $this->app->Tpl->Set('TABTEXT',"Kalender");

    $submit = $this->app->Secure->GetPOST("submitForm");
    $mode = $this->app->Secure->GetPOST("mode");
    $eventid = $this->app->Secure->GetPOST("eventid");

    $titel = $this->app->Secure->GetPOST("titel");
    $datum = $this->app->Secure->GetPOST("datum");
    $datum_bis = $this->app->Secure->GetPOST("datum_bis");
    $allday = $this->app->Secure->GetPOST("allday");
    $public = $this->app->Secure->GetPOST("public");
    $von = $this->app->Secure->GetPOST("von");
    $bis = $this->app->Secure->GetPOST("bis");
    $beschreibung = $this->app->Secure->GetPOST("beschreibung");
    $ort = $this->app->Secure->GetPOST("ort");

    $personen = $this->app->Secure->GetPOST("personen");
    $color = $this->app->Secure->GetPOST("color");

    if($submit!="") {
      $von_datum =  $this->app->String->Convert("$datum $von", "%1.%2.%3 %4:%5", "%3-%2-%1 %4:%5");
      $bis_datum =  $this->app->String->Convert("$datum_bis $bis", "%1.%2.%3 %4:%5", "%3-%2-%1 %4:%5");

      if($allday=='1') {
        $von_datum = $this->app->String->Convert("$datum 00:00", "%1.%2.%3 %4:%5", "%3-%2-%1 %4:%5");
        $bis_datum = $this->app->String->Convert("$datum_bis 00:00", "%1.%2.%3 %4:%5", "%3-%2-%1 %4:%5");
        //$bis_datum = $datum_bis;
      }


      if($mode=="new") {
        $this->app->DB->Insert("INSERT INTO kalender_event (ort,bezeichnung,beschreibung, von, bis, allDay, color, public) 
            VALUES ('$ort','$titel', '$beschreibung','$von_datum', '$bis_datum', '$allday', '$color', '$public')");
        $event = $this->app->DB->GetInsertID();
      }

      if($mode=="edit" && is_numeric($eventid)) {
        $this->app->DB->Update("UPDATE kalender_event SET ort='$ort',bezeichnung='$titel', beschreibung='$beschreibung',von='$von_datum', bis='$bis_datum', 
            allDay='$allday', color='$color', public='$public' WHERE id='$eventid' LIMIT 1");
        $this->app->DB->Delete("DELETE FROM kalender_user WHERE event='$eventid'");
        $event = $eventid;
      }

      if($mode=="delete" && is_numeric($eventid)) {
        $this->app->DB->Delete("DELETE FROM kalender_event WHERE id='$eventid' LIMIT 1");
        $this->app->DB->Delete("DELETE FROM kalender_user WHERE event='$eventid'");
      }

      if($mode=="copy" && is_numeric($eventid)) {
        $cData = $this->app->DB->SelectArr("SELECT * FROM kalender_event WHERE id='$eventid' LIMIT 1");
        $this->app->DB->Insert("INSERT INTO kalender_event (bezeichnung, von, bis, allDay, color, public) 
            VALUES ('{$cData[0]['bezeichnung']}', '{$cData[0]['von']}', '{$cData[0]['bis']}', 
              '{$cData[0]['allDay']}', '{$cData[0]['color']}', '{$cData[0]['public']}')");
        $event = $this->app->DB->GetInsertID();
      }

      // Schreibe Personen  
      if(is_numeric($event) && is_array($personen) && count($personen) && $mode!="delete") {
        for($p=0;$p<count($personen);$p++)
          $this->app->DB->Insert("INSERT INTO kalender_user (event, userid) VALUES ('$event', '{$personen[$p]}')");
      }
    }

    // Personen Auswahl
    $user = $this->app->User->GetID();
    $users = $this->app->DB->SelectArr("SELECT u.id, a.name as description FROM user u LEFT JOIN adresse a ON a.id=u.adresse WHERE u.activ='1' AND u.kalender_ausblenden!=1 ORDER BY u.username");
    for($i=0; $i<count($users);$i++){
      $select = (($user==$users[$i]['id']) ? "selected" : "");
      $user_out .= "<option value=\"{$users[$i]['id']}\" $select>{$users[$i]['description']}</option>";
    }
    $this->app->Tpl->Set('PERSONEN', $user_out);


    $this->app->Tpl->Set('COLORS', $this->ColorPicker());
    $this->app->Tpl->Parse($parsetarget,"kalender.tpl");

  }


  
 
   
  function NavigationOSS()
  {

    $navarray['menu']['web'][0]['first']  = array('wawision','welcome','main');
    $navarray['menu']['web'][0]['sec'][]  = array('Anmelden','welcome','login');

    // admin menu
    $menu = 0;
    $navarray['menu']['admin'][++$menu]['first']  = array('Stammdaten','adresse','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Adressen','adresse','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Artikel','artikel','list');
    $navarray['menu']['admin'][$menu]['sec'][] = array('Projekte','projekt','list');

    $navarray['menu']['admin'][++$menu]['first']  = array('Verkauf','auftrag','list');
    if($this->ModulVorhanden("anfrage"))
      $navarray['menu']['admin'][$menu]['sec'][]  = array('Anfrage','anfrage','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Angebot','angebot','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Angebot'.($this->Firmendaten("bezeichnungangebotersatz") && $this->Firmendaten("bezeichnungangebotersatz") != 'Angebot'? ' / '.$this->Firmendaten("bezeichnungangebotersatz"):''),'angebot','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Auftrag','auftrag','list');
    //$this->WFconf[menu][admin][$menu]['sec'][]  = array('Auftragsuche','auftrag','search');

    $navarray['menu']['admin'][++$menu]['first']  = array('Einkauf','auftrag','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Preisanfrage','preisanfrage','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Bestellung','bestellung','list');

    // $navarray['menu']['admin'][$menu]['sec'][]  = array('Bestellvorschlag','bestellvorschlag','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Sammelbestellung','bestellung','sammel');

    $navarray['menu']['admin'][++$menu]['first']  = array('Wareneingang','wareneingang','paketannahme');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Paket Annahme','wareneingang','paketannahme');

    //if($this->Firmendaten("wareneingang_gross")=="1")
    //  $navarray['menu']['admin'][$menu]['sec'][]  = array('Paket Distribution','wareneingang','distribution');

    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Retoursendung','wareneingang','rma');

    $navarray['menu']['admin'][++$menu]['first']  = array('Buchhaltung','rechnung','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Rechnungen','rechnung','list');
    //  $navarray['menu']['admin'][$menu]['sec'][]  = array('Zahlungseingang','zahlungseingang','list');
    //   $navarray['menu']['admin'][$menu]['sec'][]  = array('Verbindlichkeiten','verbindlichkeit','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Gutschrift/'.$this->Firmendaten("bezeichnungstornorechnung"),'gutschrift','list');
    //   $navarray['menu']['admin'][$menu]['sec'][]  = array('Abolauf','rechnungslauf','rechnungslauf');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Mahnwesen','mahnwesen','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Vertreterabrechnungen','vertreter','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Kontoblatt','kontoblatt','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Lastschriften','rechnung','lastschrift');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Ausgabe melden','buchhaltung','ausgabemelden');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Lohnabrechnung','lohnabrechnung','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Stornierungen','stornierungen','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Briefe f&uuml;r Post','stornierungen','list');

    $navarray['menu']['admin'][++$menu]['first']  = array('Marketing','marketing','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Verkaufszahlen','verkaufszahlen','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Partner Auszahlungen','partner','list');
    //   $navarray['menu']['admin'][$menu]['sec'][]  = array('Kampangen','marketing','kampangen');
    //   $navarray['menu']['admin'][$menu]['sec'][]  = array('Marketing Plan','marketing','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Quick-Mailing','mailing','list');
    //   $navarray['menu']['admin'][$menu]['sec'][]  = array('Katalog','katalog','list');



    $navarray['menu']['admin'][++$menu]['first']  = array('Verwaltung','rechnung','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Artikel &Uuml;bersetzungen','uebersetzung','main');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Massenartikel','massenartikel','edit');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Import St&uuml;ckliste','rechnung','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Fertigung planen','rechnung','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Pflichtenheft Tool','rechnung','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Shop Import','shopimport','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Shop Export','shopexport','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Import/Export Zentrale','importvorlage','uebersicht');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Service-Tools','appstore','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Dateien','dateien','list'); 
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Scanner','ticket','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Gesetzliches E-Mail Backup','emailbackup','list');


    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Artikel &Uuml;bersetzungen','uebersetzung','main');
    // $navarray['menu']['admin'][$menu]['sec'][]  = array('Massenartikel','massenartikel','edit');
    //  $navarray['menu']['admin'][$menu]['sec'][]  = array('Versand starten','versanderzeugen','offene');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Import St&uuml;ckliste','rechnung','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Fertigung planen','rechnung','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Pflichtenheft Tool','rechnung','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Shop Import','shopimport','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Shop Export','shopexport','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Artikel Reservierung','versanderzeugen','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Dateien','dateien','list'); 
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Scanner','ticket','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Gesetzliches E-Mail Backup','emailbackup','list');
    //  $navarray['menu']['admin'][$menu]['sec'][]  = array('Kassenbuch','kasse','list');
    //   $navarray['menu']['admin'][$menu]['sec'][]  = array('RMA Lieferungen','wareneingang','rmalist');


    $navarray['menu']['admin'][++$menu]['first'] = array('Lager','lager','list');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Lieferschein','lieferschein','list');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Lagerverwaltung','lager','list');
    //  $navarray['menu']['admin'][$menu]['sec'][]   = array('Reservierungen','lager','reservierungen');
    //  $navarray['menu']['admin'][$menu]['sec'][]   = array('Lager Kalkulation','lager','ausgehend');
    //   $navarray['menu']['admin'][$menu]['sec'][]   = array('Produktionslager','lager','produktionslager');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Lagerlampen','artikel','lagerlampe');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Mindesthaltbarkeit','mhdwarning','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Chargenverwaltung','chargen','list');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Ein- und auslagern','lager','bucheneinlagern');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Zwischenlager','lager','buchenzwischenlager');
    //$navarray['menu']['admin'][$menu]['sec'][]   = array('Artikel f&uuml;r Lieferungen','lager','artikelfuerlieferungen');


    $navarray['menu']['admin'][++$menu]['first']  = array('Administration','rechnung','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Einstellungen','einstellungen','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Ger&auml;teverwaltung','geraete','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Backup','backup','list','recover','delete','reset');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('AppStore','appstore','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Updates / Plugins','ticket','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Netzwerk','netzwerk','list');

    $navarray['menu']['admin'][++$menu]['first']  = array('Mein Bereich','welcome','main');
    $startseite = $this->app->DB->Select("SELECT startseite FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
    if($startseite!="")
      $navarray['menu']['admin'][$menu]['sec'][]  = array('Startseite','welcome','startseite');


    $navarray['menu']['admin'][$menu]['sec'][]  = array('Dashboard','welcome','start');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Startseite','welcome','start');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Tickets','ticket','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Kalender','kalender','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Pinwand','welcome','pinwand');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Wiki','wiki','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Aufgaben','aufgaben','list');
    //  $navarray['menu']['admin'][$menu]['sec'][]  = array('E-Mail Archiv','webmail','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Chat','chat','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Zeiterfassung','zeiterfassung','create');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Wiedervorlage','wiedervorlage','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Urlaub','urlaub','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Krankheit / Fehltage','krankheit','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Fahrtenbuch','krankheit','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Einstellungen','welcome','settings');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Abmelden','welcome','logout');

    //return $navarray['menu']['admin'];
    return $this->CalculateNavigation($navarray);

  }


  function CalculateNavigation($navarray)
  {

    $type = $this->app->User->GetType();
    //if($type=="admin") return $navarray['menu']['admin'];

    $permissions_module = $this->app->DB->SelectArr("SELECT module,action FROM userrights WHERE user='".$this->app->User->GetID()."' AND permission='1'");

    $permission_module_new="";

    for($i=0;$i<count($permissions_module);$i++)
    {
      if(is_file("./pages/".$permissions_module[$i]["module"].".php"))
        $permission_module_new[] = $permissions_module[$i]["module"]."_".$permissions_module[$i]["action"];
    }

    // logout ist immer erlaubt
    $permission_module_new[] = "welcome_logout";

    $menu = 0;
    $menu_no=1;
    foreach($navarray['menu']['admin'] as $key=>$value){
      //echo "haupt:".$value['first'][0]."<br>";
      $menu++;
      if(count($value['sec'])>0){
        foreach($value['sec'] as $secnav){
          //echo $secnav[0]." ".$secnav[1]." ".$secnav[2]."<br>";
          $und_pos = stripos ( $secnav[2] , '&');
          if($und_pos>0)
            $secnav_check =  substr ( $secnav[2] , 0,stripos ( $secnav[2] , '&') );
          else
            $secnav_check = $secnav[2];

          // pruefe ob recht vorhanden
          if(@in_array($secnav[1]."_".$secnav_check,$permission_module_new) || ($type=="admin" && is_file("./pages/".$secnav[1].".php")))
          {
            $navarray['menu']['tmp'][$menu]['sec'][]  = array($secnav[0],$secnav[1],$secnav[2]);
            $menu_no=0;
          }
        }
      }
      if($menu_no==0)
        $navarray['menu']['tmp'][$menu]['first'] = array($value['first'][0],$value['first'][1],'main');
      $menu_no=1;

    }

    return $navarray['menu']['tmp'];
  }


  function NavigationENT()
  {
    return $this->Navigation();
  }
  
  function Navigation()
  {
    // admin menu
    $menu = 0;
    $navarray['menu']['admin'][++$menu]['first']  = array('Stammdaten','adresse','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Adressen','adresse','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Artikel','artikel','list');
    $navarray['menu']['admin'][$menu]['sec'][] = array('Projekte','projekt','list');

    $navarray['menu']['admin'][++$menu]['first']  = array('Verkauf','auftrag','list');
    if($this->ModulVorhanden("anfrage"))
      $navarray['menu']['admin'][$menu]['sec'][]  = array('Anfrage','anfrage','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Angebot','angebot','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Angebot'.($this->Firmendaten("bezeichnungangebotersatz") && $this->Firmendaten("bezeichnungangebotersatz") != 'Angebot'? ' / '.$this->Firmendaten("bezeichnungangebotersatz"):''),'angebot','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Auftrag','auftrag','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('POS','pos','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Auftragsuche','auftrag','search');

    $navarray['menu']['admin'][++$menu]['first']  = array('Einkauf','auftrag','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Preisanfrage','preisanfrage','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Bestellung','bestellung','list');
    
    // das ist nur vorruebergehend drinnen ab version 16.4 kann man es auf nur bestellvorschlag anpassen 
    if($this->RechteVorhanden("bestellvorschlag","ausgehend"))
      $navarray['menu']['admin'][$menu]['sec'][]  = array('Bestellvorschlag','bestellvorschlag','ausgehend');
    else
      $navarray['menu']['admin'][$menu]['sec'][]  = array('Bestellvorschlag','lager','ausgehend');


    $navarray['menu']['admin'][$menu]['sec'][]  = array('Produktion','produktion','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Sammelbestellung','bestellung','sammel');

    $navarray['menu']['admin'][++$menu]['first']  = array('Wareneingang','wareneingang','paketannahme');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Paket Annahme','wareneingang','paketannahme');

    if($this->Firmendaten("wareneingang_gross")=="1")
      $navarray['menu']['admin'][$menu]['sec'][]  = array('Paket Distribution','wareneingang','distribution');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Retoursendung','wareneingang','rma');

    $navarray['menu']['admin'][++$menu]['first']  = array('Buchhaltung','rechnung','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Rechnungen','rechnung','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Zahlungseingang','zahlungseingang','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Reisekosten','reisekosten','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Arbeitsnachweis','arbeitsnachweis','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Gutschrift / '.$this->Firmendaten("bezeichnungstornorechnung"),'gutschrift','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Abolauf','rechnungslauf','rechnungslauf');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Mahnwesen','mahnwesen','list');
    if($this->Firmendaten("modul_finanzbuchhaltung")=="1")
      $navarray['menu']['admin'][$menu]['sec'][]  = array('Finanzbuchhaltung','kontoblatt','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Finanzbuchhaltung Export','buchhaltungexport','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('SEPA Zahlungsverkehr','zahlungsverkehr','ueberweisung');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Automatischer Rechnungsdruck','autorechnungsdruck','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Verbandsabrechnungen','verband','offene');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Vertreterabrechnungen','vertreter','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Provisionen','provisionenartikel','list');
    if($this->Firmendaten("modul_mlm")=="1")
      $navarray['menu']['admin'][$menu]['sec'][]  = array('Multilevel','multilevel','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Ausgabe melden','buchhaltung','ausgabemelden');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Lohnabrechnung','lohnabrechnung','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Mitarbeiterzeiterfassung','mitarbeiterzeiterfassung','dashboard');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Verbindlichkeiten','verbindlichkeit','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Stornierungen','stornierungen','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Kassenbuch','kasse','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Briefe f&uuml;r Post','stornierungen','list');

    $navarray['menu']['admin'][++$menu]['first']  = array('Marketing','marketing','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Verkaufszahlen','verkaufszahlen','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Umsatzstatistik','umsatzstatistik','kunde');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Statistiken','statistiken','dashboard');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Aktionscodes','aktionscodes','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Partner Auszahlungen','partner','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Kampangen','marketing','kampangen');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Marketing Plan','marketing','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Quick-Mailing','mailing','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Katalog','katalog','list');



    $navarray['menu']['admin'][++$menu]['first']  = array('Verwaltung','rechnung','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Artikel &Uuml;bersetzungen','uebersetzung','main');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Massenartikel','massenartikel','edit');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Inventur','inventur','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Zeitkonten','zeiterfassung','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Berichte','berichte','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Import St&uuml;ckliste','rechnung','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Fertigung planen','rechnung','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Pflichtenheft Tool','rechnung','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Online-Shop Import','shopimport','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Shop Export','shopexport','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Import/Export Zentrale','importvorlage','uebersicht');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Service-Tools','appstore','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Seriennummern','seriennummern','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Dateien','dateien','list'); 
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Scanner','ticket','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Gesetzliches E-Mail Backup','emailbackup','list');

    $navarray['menu']['admin'][$menu]['sec'][]  = array('RMA Lieferungen','rma','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Service & Support','service','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Linkeditor','linkeditor','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Etikettendrucker','etikettendrucker','list');


    $navarray['menu']['admin'][++$menu]['first'] = array('Lager','lager','list');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Lieferschein','lieferschein','list');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Lagerverwaltung','lager','list');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Reservierungen','lager','reservierungen');

    $navarray['menu']['admin'][$menu]['sec'][]  = array('Versandzentrum','versanderzeugen','offene');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Produktionszentrum','produktionszentrum','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Kommissionieraufkleber','kommissionieraufkleber','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]   = array('Lager Kalkulation','lager','ausgehend');
    //    $navarray['menu']['admin'][$menu]['sec'][]   = array('Produktionslager','lager','produktionslager');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Lagerlampen','artikel','lagerlampe');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Mindesthaltbarkeit','mhdwarning','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Chargenverwaltung','chargen','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Lagermindestmengen','lagermindestmengen','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Artikelkontingente','artikelkontingente','list');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Ein- und auslagern','lager','bucheneinlagern');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Zwischenlager','lager','buchenzwischenlager');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Artikel f&uuml;r Lieferungen','lager','artikelfuerlieferungen');
    $navarray['menu']['admin'][$menu]['sec'][]   = array('Artikel f&uuml;r Produktionen','lager','artikelfuerlieferungen&cmd=produktion');


    $navarray['menu']['admin'][++$menu]['first']  = array('Administration','rechnung','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Einstellungen','einstellungen','list');
    //    $navarray['menu']['admin'][$menu]['sec'][]  = array('Ger&auml;teverwaltung','geraete','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Backup','backup','list','recover','delete','reset');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('AppStore','appstore','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Updates / Plugins','ticket','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Netzwerk','netzwerk','list');

    $navarray['menu']['admin'][++$menu]['first']  = array('Mein Bereich','welcome','main');
    $startseite = $this->app->DB->Select("SELECT startseite FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
    if($startseite!="")
      $navarray['menu']['admin'][$menu]['sec'][]  = array('Startseite','welcome','startseite');


    $navarray['menu']['admin'][$menu]['sec'][]  = array('Dashboard','welcome','start');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Tickets','ticket','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Kalender','kalender','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Pinwand','welcome','pinwand');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Aufgaben','aufgaben','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('E-Mail','webmail','list');

    $navarray['menu']['admin'][$menu]['sec'][]  = array('Chat','chat','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Zeiterfassung','zeiterfassung','create');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Wiedervorlage','wiedervorlage','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Urlaub','urlaub','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Krankheit / Fehltage','krankheit','list');
    //$navarray['menu']['admin'][$menu]['sec'][]  = array('Fahrtenbuch','krankheit','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Wiki','wiki','list');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Einstellungen','welcome','settings');
    $navarray['menu']['admin'][$menu]['sec'][]  = array('Abmelden','welcome','logout');

    return $this->CalculateNavigation($navarray);
  }
  

  /*

     $type = $this->app->User->GetType();
     if($type=="admin") return $navarray['menu']['admin'];

     $permissions_module = $this->app->DB->SelectArr("SELECT module,action FROM userrights WHERE user='".$this->app->User->GetID()."' AND permission='1'");


     for($i=0;$i<count($permissions_module);$i++)
     $permission_module_new[] = $permissions_module[$i]["module"]."_".$permissions_module[$i]["action"];

     $menu = 0;
     $menu_no=1;
     foreach($navarray['menu']['admin'] as $key=>$value){
//echo "haupt:".$value['first'][0]."<br>";

$menu++;
if(count($value['sec'])>0){
foreach($value['sec'] as $secnav){
//echo $secnav[0]." ".$secnav[1]." ".$secnav[2]."<br>";
$und_pos = stripos ( $secnav[2] , '&');
if($und_pos>0)
$secnav_check =  substr ( $secnav[2] , 0,stripos ( $secnav[2] , '&') );
else
$secnav_check = $secnav[2];
if(@in_array($secnav[1]."_".$secnav_check,$permission_module_new))
{
$navarray['menu']['tmp'][$menu]['sec'][]  = array($secnav[0],$secnav[1],$secnav[2]);
$menu_no=0;
}
}
}
if($menu_no==0)
$navarray['menu']['tmp'][$menu]['first'] = array($value['first'][0],$value['first'][1],'main');
$menu_no=1;

}

return $navarray['menu']['tmp'];
}
   */

function Branch()
{
  include("../version.php");

  switch($version)
  {
    case "OSS": return "Open-Source"; break;
    case "PRO": return "Professional"; break;
    case "ENT": return "Enterprise"; break;
    case "PRE": return "Premium"; break;
    case "STOCK": return "Stock"; break;
    default: return "Unknown";
  }
}

function Version()
{
  include("../version.php");

  //$version = split('_',$version);

  return $version;
}


function RevisionPlain()
{
  include("../version.php");
  return $version_revision;
}


function Revision()
{
  include("../version.php");
  return $version_revision;
}


function WikiPage($page)
{
  $content = $this->app->DB->Select("SELECT content FROM wiki WHERE name='$page' LIMIT 1");
  $str = $this->ReadyForPDF($content);
  $wikiparser = new WikiParser();
  if (preg_match('/(<[^>].*?>)/e', $str))
  {
    $str=preg_replace('#(href)="([^:"]*)(?:")#','$1="index.php?module=wiki&action=list&name=$2"',$str);
    $content = $str;
  } else {
    $content = $wikiparser->parse($content);
    //$index = $wikiparser->BuildIndex();
  }
  return $content;
}

function Config2Array($config)
{
  $entries = explode (';', $config);
  // $entries enthält alle key => value paare
  foreach ($entries as $pair) {
    preg_match("/(.+)=>(.+)$/", $pair, $matches);
    $array[$matches[1]] = $matches[2];
  }  

  return array_filter($array);
}


function LiveImport($konto)
{
  $zugangsdaten = $this->app->DB->Select("SELECT liveimport FROM konten WHERE id='$konto' LIMIT 1");
  $zugangsdaten = html_entity_decode($zugangsdaten,ENT_QUOTES,"UTF-8");
  $zugangsdaten = $this->Config2Array($zugangsdaten);

  $kontotyp = $this->app->DB->Select("SELECT type FROM konten WHERE id='$konto' LIMIT 1");

  if(is_file("plugins/liveimport/$kontotyp/$kontotyp.php"))
  {
    include("plugins/liveimport/$kontotyp/$kontotyp.php");
    $tmp = new $kontotyp();
    return $tmp->Import($zugangsdaten);
  } else return "";

}


function AdresseAlsLieferadresseButton($adresse)
{
  $this->app->Tpl->Set('POPUPWIDTH',"1000");
  $this->app->Tpl->Set('ADRESSELIEFERADRESSEPOPUP','
      <script>
      $(function() {
        $("#mehr4").button();
        });
      function closeIframe()
      {
      $(\'.externalSite\').dialog(\'close\');
      return false;
      }
      </script>
      <a id="mehr4" style="font-size: 8pt; " href="index.php?module=adresse&action=adressestammdatenpopup&cmd=alslieferadresse&id='.$adresse.'&iframe=true" class="popup" title="Adresse aus Stammdaten einf&uuml;gen">Adresse aus Stammdaten</a>');
}

function AnsprechpartnerAlsLieferadresseButton($adresse)
{
  $this->app->Tpl->Set('POPUPWIDTH',"1000");
  $this->app->Tpl->Set('ANSPRECHPARTNERLIEFERADRESSEPOPUP','
      <script>
      $(function() {
        $("#mehr3").button();
        });
      function closeIframe()
      {
      $(\'.externalSite\').dialog(\'close\');
      return false;
      }
      </script>
      <a id="mehr3" style="font-size: 8pt; " href="index.php?module=adresse&action=ansprechpartnerpopup&cmd=alslieferadresse&id='.$adresse.'&iframe=true" class="popup" title="Ansprechpartner als Lieferadresse einf&uuml;gen">Ansprechpartner</a>');
}



function LieferadresseButton($adresse)
{
  $this->app->Tpl->Set('POPUPWIDTH',"1000");
  $this->app->Tpl->Set('LIEFERADRESSEPOPUP','
      <script>
      $(function() {
        $("#mehr2").button();
        });

      function closeIframe()
      {
      $(\'.externalSite\').dialog(\'close\');
      return false;
      }

      </script>

      <a id="mehr2" style="font-size: 8pt; " href="index.php?module=adresse&action=lieferadressepopup&id='.$adresse.'&iframe=true" class="popup" title="Lieferadresse einf&uuml;gen">Lieferadresse</a>');

}


function GetNavigationSelect($shop)
{


  $oberpunkte = $this->app->DB->SelectArr("SELECT id, bezeichnung, bezeichnung_en, plugin,pluginparameter FROM shopnavigation WHERE parent=0  AND shop='$shop' ORDER BY position");

  $tmp = array();
  foreach($oberpunkte as $punkt)
  {
    $tmp["{$punkt["id"]}"]=$punkt["bezeichnung"];
    $unterpunkte = $this->app->DB->SelectArr("SELECT id, bezeichnung, bezeichnung_en, plugin,pluginparameter FROM shopnavigation WHERE parent='".$punkt["id"]."' AND shop='$shop' ORDER BY position");

    foreach($unterpunkte as $upunkt)
      $tmp["{$upunkt["id"]}"]="&nbsp;&nbsp;&nbsp;".$upunkt["bezeichnung"];
  }

  return $tmp;
}



function AnsprechpartnerButton($adresse)
{
  $this->app->Tpl->Set('POPUPWIDTH',"1000");
  $this->app->Tpl->Set('ANSPRECHPARTNERPOPUP','
      <script>
      $(function() {
        $("#mehr").button();
        });

      function closeIframe()
      {
      $(\'.externalSite\').dialog(\'close\');
      return false;
      }

      </script>

      <a id="mehr" style="font-size: 8pt; " href="index.php?module=adresse&action=ansprechpartnerpopup&id='.$adresse.'&iframe=true" class="popup" title="Ansprechpartner einf&uuml;gen">Ansprechpartner einf&uuml;gen</a>');
  //"<input type=\"button\" value=\"Ansprechpartner einf&uuml;gen\">");
}

function ArtikelAnzahlLagerPlatz($artikel,$lager_platz)
{
  $result =  $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi 
      LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz
      WHERE lpi.artikel='$artikel' AND lpi.lager_platz='$lager_platz' AND lp.sperrlager!='1'");
  if($result <=0) $result=0;
  return $result;
}

function ArtikelAnzahlLagerOhneNachschublager($artikel)
{
  return $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz
      WHERE lpi.artikel='$artikel' AND lp.autolagersperre!='1' AND lp.sperrlager!='1'");
}


function ArtikelAnzahlLagerNurNachschublager($artikel)
{
  return $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz
      WHERE lpi.artikel='$artikel' AND lp.autolagersperre='1'");
}

function ArtikelAnzahlLagerPOS($artikel,$lager)
{
  return $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz 
        WHERE lpi.artikel='$artikel' AND lp.lager='$lager' AND lp.poslager='1'");
}

function ArtikelAnzahlLager($artikel,$lager=0)
{
  if($lager<=0)
  {
    return $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz 
        WHERE lpi.artikel='$artikel' AND lp.sperrlager!='1'");
  }
  else
  {
    return $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz 
        WHERE lpi.artikel='$artikel' AND lp.lager='$lager' AND lp.sperrlager!='1'");
  }
}


function ArtikelAnzahlOffene($artikel)
{
  return $this->app->DB->Select("SELECT SUM(ap.menge) FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag WHERE ap.artikel='$artikel' AND a.status='freigegeben'");
  //              return $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='$artikel'");
}



function ArtikelAnzahlReserviert($artikel)
{
  return $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='$artikel'");
}


function MaxArtikelbezeichnung($delta=0)
{

  return 50+$delta;
}

function CleanStringUTF8($value)
{
  $value=trim($value);
  $value = $this->app->Secure->stripallslashes($value);
  $value = $this->app->Secure->smartstripslashes($value);
  //$value = htmlspecialchars($value,ENT_QUOTES);
  // $value = str_replace('"','&Prime;',$value);
  // $value = str_replace("'",'&prime;',$value);
  //$value = $this->ConvertForDB($value);
  $value = $this->ConvertForDBUTF8($value);
  return $value;
}


function CleanString($value)
{
  $value=trim($value);
  $value = $this->app->Secure->stripallslashes($value);
  $value = $this->app->Secure->smartstripslashes($value);
  //$value = htmlspecialchars($value,ENT_QUOTES);
  // $value = str_replace('"','&Prime;',$value);
  // $value = str_replace("'",'&prime;',$value);
  //$value = $this->ConvertForDB($value);
  $value = $this->ConvertForDB($value);
  return $value;
}


function CleanDataBeforImportUTF8($data)
{
  if(is_array($data))
  {
    foreach($data as $key=>$value)
    {
      if(!is_array($data[$key]))
        $data[$key] = $this->CleanStringUTF8($value);
    }

    return $data;

  } else {
    $data = $this->CleanStringUTF8($data);
    return $data;   
  }

}


function CleanDataBeforImport($data)
{
  if(is_array($data))
  {
    foreach($data as $key=>$value)
    {
      if(!is_array($data[$key]))
        $data[$key] = $this->CleanString($value);
    }

    return $data;

  } else {
    $data = $this->CleanString($data);
    return $data;   
  }

}

function GetStandardProjekt()
{
  return $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
}

function Standardprojekt($table,$id)
{
  $projekt = $this->app->DB->Select("SELECT projekt FROM `$table` WHERE id='$id' LIMIT 1");
  if($projekt<1)
  {
    $standardprojekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
    $this->app->DB->Update("UPDATE `$table` SET projekt='".$standardprojekt."' WHERE id='".$id."' LIMIT 1");
  }
}

function UpgradeDatabase()
{

  $this->app->DB->Update("ALTER TABLE `adresse` CHANGE `rechnung_vorname` `rechnung_vorname` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_name` `rechnung_name` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_titel` `rechnung_titel` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_typ` `rechnung_typ` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_strasse` `rechnung_strasse` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_ort` `rechnung_ort` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_land` `rechnung_land` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_abteilung` `rechnung_abteilung` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_unterabteilung` `rechnung_unterabteilung` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_adresszusatz` `rechnung_adresszusatz` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_telefon` `rechnung_telefon` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_telefax` `rechnung_telefax` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_anschreiben` `rechnung_anschreiben` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_email` `rechnung_email` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_plz` `rechnung_plz` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `rechnung_ansprechpartner` `rechnung_ansprechpartner` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL");

  $this->CheckColumn("public","int(1)","kalender_event");
  $this->CheckColumn("vorname","varchar(255)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("nachname","varchar(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("kennung","varchar(255)","adresse");
  $this->CheckColumn("sachkonto","varchar(20)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("arbeitszeitprowoche","DECIMAL(10,2)","adresse","DEFAULT 0 NOT NULL");
  $this->CheckColumn("art_filter","varchar(20)","prozessstarter","DEFAULT '' NOT NULL");
  $this->CheckColumn("folgebestaetigungsperre","tinyint(1)","adresse","DEFAULT '0' NOT NULL");
  //$this->CheckColumn("mail_cc","VARCHAR(128)","ticket_nachricht","DEFAULT '' NOT NULL");
  $this->CheckColumn("bitteantworten","TINYINT(1)","ticket","DEFAULT '0' NOT NULL");
  $this->CheckColumn("service","INT(11)","ticket","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kommentar","TEXT","ticket","DEFAULT '' NOT NULL");

  $this->CheckColumn("lieferantennummerbeikunde","varchar(128)","adresse");

  $this->CheckColumn("verein_mitglied_seit","DATE","adresse");
  $this->CheckColumn("verein_mitglied_bis","DATE","adresse");
  $this->CheckColumn("verein_mitglied_aktiv","TINYINT(1)","adresse");
  $this->CheckColumn("verein_spendenbescheinigung","TINYINT(1)","adresse","DEFAULT '0' NOT NULL");

  $this->CheckColumn("posid","int(11)","lager_reserviert","DEFAULT '0' NOT NULL");
  

  
  $this->CheckColumn("reserviertdatum","DATE","lager_reserviert");

  $this->CheckColumn("freifeld1","TEXT","adresse");
  $this->CheckColumn("freifeld2","TEXT","adresse");
  $this->CheckColumn("freifeld3","TEXT","adresse");

  $this->CheckColumn("freifeld4","TEXT","adresse");
  $this->CheckColumn("freifeld5","TEXT","adresse");
  $this->CheckColumn("freifeld6","TEXT","adresse");
  $this->CheckColumn("freifeld7","TEXT","adresse");
  $this->CheckColumn("freifeld8","TEXT","adresse");
  $this->CheckColumn("freifeld9","TEXT","adresse");
  $this->CheckColumn("freifeld10","TEXT","adresse");

  $this->CheckColumn("lead","TINYINT(1)","adresse","DEFAULT '0' NOT NULL");

  $this->CheckColumn("rechnung_papier","TINYINT(1)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("angebot_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("auftrag_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("rechnung_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("gutschrift_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("lieferschein_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("bestellung_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("angebot_fax_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("auftrag_fax_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("rechnung_fax_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("gutschrift_fax_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("lieferschein_fax_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("bestellung_fax_cc","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("abperfax","TINYINT(1)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("abpermail","VARCHAR(128)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("rechnung_permail","TINYINT(1)","adresse","DEFAULT '0' NOT NULL");

  $this->CheckColumn("filiale","TEXT","adresse");


  $this->CheckColumn("rma","INT(1)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("transaktionsnummer","VARCHAR(255)","auftrag","DEFAULT '' NOT NULL");
  $this->CheckColumn("vorabbezahltmarkieren","INT(1)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("auftragseingangper","VARCHAR(64)","auftrag","DEFAULT '' NOT NULL");

  $this->CheckColumn("vertrieb","int(11)","adresse");
  $this->CheckColumn("innendienst","int(11)","adresse");
  $this->CheckColumn("verbandsnummer","VARCHAR(255)","adresse");
  $this->CheckColumn("kassiereraktiv","INT(1)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kassierernummer","VARCHAR(10)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("kassiererprojekt","INT(11)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("abweichendeemailab","varchar(64)","adresse");
  $this->CheckColumn("portofrei_aktiv","DECIMAL(10,2)","adresse");
  $this->CheckColumn("portofreilieferant_aktiv","tinyint(1)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("portofrei_aktiv","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("portofreiab","DECIMAL(10,2)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("portofreiablieferant","DECIMAL(10,2)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("infoauftragserfassung","TEXT","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("mandatsreferenz","varchar(255)","adresse","DEFAULT '' NOT NULL");

  $this->CheckColumn("mandatsreferenzart","varchar(64)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("mandatsreferenzwdhart","varchar(64)","adresse","DEFAULT '' NOT NULL");

  $this->CheckColumn("mandatsreferenzart","varchar(64)","dta","DEFAULT '' NOT NULL");
  $this->CheckColumn("mandatsreferenzwdhart","varchar(64)","dta","DEFAULT '' NOT NULL");

  $this->CheckColumn("mandatsreferenzdatum","DATE","adresse");
  $this->CheckColumn("mandatsreferenzaenderung","TINYINT(1)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("glaeubigeridentnr","varchar(255)","adresse","DEFAULT '' NOT NULL");
  $this->CheckColumn("kreditlimit","DECIMAL(10,2)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("tour","INT(11)","adresse","DEFAULT '0' NOT NULL");

  $this->CheckColumn("zahlungskonditionen_festschreiben","int(1)","adresse");
  $this->CheckColumn("rabatte_festschreiben","int(1)","adresse");

  $this->CheckColumn("autodruck_rz","INT(1)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("explodiert_parent_artikel","INT(11)","lieferschein_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("explodiert_parent_artikel","INT(11)","rechnung_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("explodiert_parent_artikel","INT(11)","gutschrift_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("autodruck_periode","INT(1)","rechnung","DEFAULT '1' NOT NULL");
  $this->CheckColumn("autodruck_done","INT(1)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("autodruck_anzahlverband","INT(11)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("autodruck_anzahlkunde","INT(11)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("autodruck_mailverband","INT(1)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("autodruck_mailkunde","INT(1)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("dta_datei_verband","INT(11)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("dta_datei_verband","INT(11)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("manuell_vorabbezahlt","DATE","gutschrift");
  $this->CheckColumn("manuell_vorabbezahlt_hinweis","VARCHAR(128)","gutschrift","DEFAULT '' NOT NULL");
  $this->CheckColumn("nicht_umsatzmindernd","TINYINT(1)","gutschrift","DEFAULT '0' NOT NULL");

  $this->CheckColumn("dta_datei","INT(11)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("dta_datei","INT(11)","gutschrift","DEFAULT '0' NOT NULL");


  /* Lagermindestmengen */
  $this->CheckTable("lagermindestmengen");
  $this->CheckColumn("id","int(11)","lagermindestmengen","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("artikel","INT(11)","lagermindestmengen","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lager_platz","INT(11)","lagermindestmengen","DEFAULT '0' NOT NULL");
  $this->CheckColumn("menge","INT(11)","lagermindestmengen","DEFAULT '0' NOT NULL");
  $this->CheckColumn("datumvon","DATE","lagermindestmengen");
  $this->CheckColumn("datumbis","DATE","lagermindestmengen");


  /* Permanente Inventur */
  $this->CheckTable("artikel_permanenteinventur");
  $this->CheckColumn("id","int(11)","artikel_permanenteinventur","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("artikel","INT(11)","artikel_permanenteinventur","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lager_platz","INT(11)","artikel_permanenteinventur","DEFAULT '0' NOT NULL");
  $this->CheckColumn("menge","INT(11)","artikel_permanenteinventur","DEFAULT '0' NOT NULL");
  $this->CheckColumn("zeitstempel","DATETIME","artikel_permanenteinventur");
  $this->CheckColumn("bearbeiter","VARCHAR(128)","artikel_permanenteinventur","DEFAULT '' NOT NULL");



  $this->CheckTable("objekt_protokoll");
  $this->CheckColumn("id","int(11)","objekt_protokoll","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("objekt","VARCHAR(64)","objekt_protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("objektid","INT(11)","objekt_protokoll","DEFAULT '0' NOT NULL");
  $this->CheckColumn("action_long","VARCHAR(128)","objekt_protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("meldung","VARCHAR(255)","objekt_protokoll","DEFAULT '0' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(128)","objekt_protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("zeitstempel","DATETIME","objekt_protokoll");


  /* Drucker spooler */
  $this->CheckTable("pdfmirror_md5pool");
  $this->CheckColumn("id","int(11)","pdfmirror_md5pool","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("zeitstempel","DATETIME","pdfmirror_md5pool");
  $this->CheckColumn("checksum","VARCHAR(128)","pdfmirror_md5pool","DEFAULT '' NOT NULL");
  $this->CheckColumn("table_id","int(11)","pdfmirror_md5pool","DEFAULT '0' NOT NULL");
  $this->CheckColumn("table_name","VARCHAR(128)","pdfmirror_md5pool","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(128)","pdfmirror_md5pool","DEFAULT '' NOT NULL");
  $this->CheckColumn("erstesoriginal","int(11)","pdfmirror_md5pool","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiv_id","int(11)","pdfmirror_md5pool","DEFAULT '0' NOT NULL");

  /*Archiv Version */
  $this->CheckTable("pdfarchiv");
  $this->CheckColumn("id","int(11)","pdfarchiv","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("zeitstempel","DATETIME","pdfarchiv");
  $this->CheckColumn("checksum","VARCHAR(128)","pdfarchiv","DEFAULT '' NOT NULL");
  $this->CheckColumn("table_id","int(11)","pdfarchiv","DEFAULT '0' NOT NULL");
  $this->CheckColumn("table_name","VARCHAR(128)","pdfarchiv","DEFAULT '' NOT NULL");
  $this->CheckColumn("doctype","VARCHAR(128)","pdfarchiv","DEFAULT '' NOT NULL");
  $this->CheckColumn("doctypeorig","VARCHAR(128)","pdfarchiv","DEFAULT '' NOT NULL");
  $this->CheckColumn("dateiname","VARCHAR(128)","pdfarchiv","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(128)","pdfarchiv","DEFAULT '' NOT NULL");
  $this->CheckColumn("belegnummer","VARCHAR(128)","pdfarchiv","DEFAULT '' NOT NULL");
  $this->CheckColumn("erstesoriginal","int(11)","pdfarchiv","DEFAULT '0' NOT NULL");
  
  $this->CheckColumn("zuarchivieren", "int(11)", "auftrag", "DEFAULT '0' NOT NULL");
  $this->CheckColumn("zuarchivieren", "int(11)", "anfrage", "DEFAULT '0' NOT NULL");
  $this->CheckColumn("zuarchivieren", "int(11)", "angebot", "DEFAULT '0' NOT NULL");
  $this->CheckColumn("zuarchivieren", "int(11)", "bestellung", "DEFAULT '0' NOT NULL");
  $this->CheckColumn("zuarchivieren", "int(11)", "rechnung", "DEFAULT '0' NOT NULL");
  $this->CheckColumn("zuarchivieren", "int(11)", "gutschrift", "DEFAULT '0' NOT NULL");
  $this->CheckColumn("zuarchivieren", "int(11)", "lieferschein", "DEFAULT '0' NOT NULL");

  /* Drucker spooler */
  $this->CheckTable("drucker_spooler");
  $this->CheckColumn("id","int(11)","drucker_spooler","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("drucker","int(11)","drucker_spooler","DEFAULT '0' NOT NULL");
  $this->CheckColumn("filename","VARCHAR(128)","drucker_spooler","DEFAULT '' NOT NULL");
  $this->CheckColumn("content","LONGBLOB","drucker_spooler","DEFAULT '' NOT NULL");
  $this->CheckColumn("description","VARCHAR(128)","drucker_spooler","DEFAULT '' NOT NULL");
  $this->CheckColumn("anzahl","VARCHAR(128)","drucker_spooler","DEFAULT '' NOT NULL");
  $this->CheckColumn("befehl","VARCHAR(128)","drucker_spooler","DEFAULT '' NOT NULL");
  $this->CheckColumn("anbindung","VARCHAR(128)","drucker_spooler","DEFAULT '' NOT NULL");
  $this->CheckColumn("zeitstempel","DATETIME","drucker_spooler");
  $this->CheckColumn("user","int(11)","drucker_spooler","DEFAULT '0' NOT NULL");



  $this->CheckTable("pinwand");
  $this->CheckColumn("id","int(11)","pinwand","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("name","VARCHAR(128)","pinwand","DEFAULT '' NOT NULL");
  $this->CheckColumn("user","INT(11)","pinwand","DEFAULT '0' NOT NULL");

  $this->CheckTable("adapterbox");
  $this->CheckColumn("id","int(11)","adapterbox","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("bezeichnung","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("verwendenals","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("baudrate","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("model","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("seriennummer","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("ipadresse","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("netmask","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("gateway","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("dns","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("dhcp","TINYINT(1)","adapterbox","DEFAULT '1' NOT NULL");
  $this->CheckColumn("wlan","TINYINT(1)","adapterbox","DEFAULT '0' NOT NULL");
  $this->CheckColumn("ssid","VARCHAR(128)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("passphrase","VARCHAR(256)","adapterbox","DEFAULT '' NOT NULL");
  $this->CheckColumn("letzteverbindung","DATETIME","adapterbox");


  $this->CheckTable("pinwand_user");
  $this->CheckColumn("pinwand","int(11)","pinwand_user","DEFAULT '0' NOT NULL");
  $this->CheckColumn("user","int(11)","pinwand_user","DEFAULT '0' NOT NULL");




  $this->CheckTable("chat");
  $this->CheckColumn("id","int(11)","chat","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("user_from","INT(11)","chat","DEFAULT '0' NOT NULL");
  $this->CheckColumn("user_to","INT(11)","chat","DEFAULT '0' NOT NULL");
  $this->CheckColumn("message","TEXT","chat","DEFAULT '' NOT NULL");
  $this->CheckColumn("gelesen","TINYINT(1)","chat","DEFAULT '0' NOT NULL");
  $this->CheckColumn("zeitstempel","DATETIME","chat");



  $this->CheckTable("device_jobs");
  $this->CheckColumn("id","int(11)","device_jobs","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("deviceidsource","VARCHAR(64)","device_jobs","DEFAULT ''");
  $this->CheckColumn("deviceiddest","VARCHAR(64)","device_jobs","DEFAULT ''");
  $this->CheckColumn("job","LONGTEXT","device_jobs","DEFAULT '' NOT NULL ");
  $this->CheckColumn("zeitstempel","DATETIME","device_jobs");
  $this->CheckColumn("abgeschlossen","tinyint(1)","device_jobs","DEFAULT '0' NOT NULL ");
  $this->CheckColumn("art","VARCHAR(64)","device_jobs","DEFAULT ''");
  $this->CheckColumn("request_id","int(11)","device_jobs","DEFAULT '0' NOT NULL");

  $this->CheckColumn("versendet_am_zeitstempel","DATETIME","versand");

  /*
     $this->CheckTable("artikeleigenschaften");
     $this->CheckColumn("id","int(11)","artikeleigenschaften","DEFAULT '0' NOT NULL AUTO_INCREMENT");
     $this->CheckColumn("bezeichnung","VARCHAR(16)","artikeleigenschaften","DEFAULT '' NOT NULL ");
     $this->CheckColumn("projekt","INT(11)","artikeleigenschaften","DEFAULT '0' NOT NULL");
     $this->CheckColumn("geloescht","tinyint(1)","artikeleigenschaften","DEFAULT '0' NOT NULL");
   */


  $this->CheckTable("uebersetzung");
  $this->CheckColumn("id","int(11)","uebersetzung","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("label","VARCHAR(255)","uebersetzung","DEFAULT '' NOT NULL ");
  $this->CheckColumn("beschriftung","TEXT","uebersetzung","DEFAULT '' NOT NULL ");
  $this->CheckColumn("sprache","VARCHAR(255)","uebersetzung","DEFAULT '' NOT NULL ");
  $this->CheckColumn("original","TEXT","uebersetzung","DEFAULT '' NOT NULL ");




  $this->CheckTable("etiketten");
  $this->CheckColumn("id","int(11)","etiketten","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("name","VARCHAR(64)","etiketten","DEFAULT '' NOT NULL ");
  $this->CheckColumn("xml","TEXT","etiketten","DEFAULT '' NOT NULL ");
  $this->CheckColumn("bemerkung","TEXT","etiketten","DEFAULT '' NOT NULL ");
  $this->CheckColumn("ausblenden","tinyint(1)","etiketten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("verwendenals","VARCHAR(64)","etiketten","DEFAULT '' NOT NULL ");
  $this->CheckColumn("format","VARCHAR(64)","etiketten","DEFAULT '' NOT NULL ");

  $this->CheckColumn("manuell","TINYINT(1)","etiketten","DEFAULT '0' NOT NULL ");
  $this->CheckColumn("labelbreite","INT(11)","etiketten","DEFAULT '50' NOT NULL ");
  $this->CheckColumn("labelhoehe","INT(11)","etiketten","DEFAULT '18' NOT NULL ");
  $this->CheckColumn("labelabstand","INT(11)","etiketten","DEFAULT '3' NOT NULL ");
  $this->CheckColumn("labeloffsetx","INT(11)","etiketten","DEFAULT '0' NOT NULL ");
  $this->CheckColumn("labeloffsety","INT(11)","etiketten","DEFAULT '6' NOT NULL ");


  $this->CheckTable("versandpakete");
  $this->CheckColumn("id","int(11)","versandpakete","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("versand","INT(11)","versandpakete","DEFAULT '0' NOT NULL");
  $this->CheckColumn("nr","INT(11)","versandpakete","DEFAULT '0' NOT NULL");
  $this->CheckColumn("tracking","VARCHAR(255)","versandpakete","DEFAULT '' NOT NULL ");
  $this->CheckColumn("versender","VARCHAR(255)","versandpakete","DEFAULT '' NOT NULL ");
  $this->CheckColumn("gewicht","VARCHAR(10)","versandpakete","DEFAULT '' NOT NULL ");
  $this->CheckColumn("bemerkung","TEXT","versandpakete","DEFAULT '' NOT NULL ");


  $this->CheckColumn("antwortankundenempfaenger","VARCHAR(64)","service","DEFAULT '' NOT NULL ");
  $this->CheckColumn("antwortankundenkopie","VARCHAR(64)","service","DEFAULT '' NOT NULL ");
  $this->CheckColumn("antwortankundenblindkopie","VARCHAR(64)","service","DEFAULT '' NOT NULL ");
  $this->CheckColumn("antwortankundenbetreff","VARCHAR(64)","service","DEFAULT '' NOT NULL ");
  $this->CheckColumn("antwortankunden","TEXT","service","DEFAULT '' NOT NULL ");

  
  

  $this->CheckTable("logfile");
  $this->CheckColumn("id","int(11)","logfile","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("meldung","TEXT","logfile","DEFAULT '' NOT NULL");
  $this->CheckColumn("dump","TEXT","logfile","DEFAULT '' NOT NULL");
  $this->CheckColumn("module","VARCHAR(64)","logfile","DEFAULT '' NOT NULL");
  $this->CheckColumn("action","VARCHAR(64)","logfile","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(64)","logfile","DEFAULT '' NOT NULL");
  $this->CheckColumn("funktionsname","VARCHAR(64)","logfile","DEFAULT '' NOT NULL");
  $this->CheckColumn("datum","DATETIME","logfile");


  $this->CheckTable("protokoll");
  $this->CheckColumn("id","int(11)","protokoll","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("meldung","TEXT","protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("dump","TEXT","protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("module","VARCHAR(64)","protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("action","VARCHAR(64)","protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(64)","protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("funktionsname","VARCHAR(64)","protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("datum","DATETIME","protokoll");
  $this->CheckColumn("parameter","int(11)","protokoll","DEFAULT '0' NOT NULL");
  $this->CheckColumn("argumente","TEXT","protokoll","DEFAULT '' NOT NULL");


  $this->CheckTable("systemlog");
  $this->CheckColumn("id","int(11)","systemlog","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("meldung","TEXT","systemlog","DEFAULT '' NOT NULL");
  $this->CheckColumn("dump","TEXT","systemlog","DEFAULT '' NOT NULL");
  $this->CheckColumn("module","VARCHAR(64)","systemlog","DEFAULT '' NOT NULL");
  $this->CheckColumn("action","VARCHAR(64)","systemlog","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(64)","systemlog","DEFAULT '' NOT NULL");
  $this->CheckColumn("funktionsname","VARCHAR(64)","systemlog","DEFAULT '' NOT NULL");
  $this->CheckColumn("datum","DATETIME","systemlog");
  $this->CheckColumn("parameter","int(11)","systemlog","DEFAULT '0' NOT NULL");
  $this->CheckColumn("argumente","TEXT","systemlog","DEFAULT '' NOT NULL");
  $this->CheckColumn("level","int(11)","systemlog","DEFAULT '0' NOT NULL");


  $this->CheckTable("interne_events");
  $this->CheckColumn("id","int(11)","interne_events","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("meldung","TEXT","interne_events","DEFAULT '' NOT NULL");
  $this->CheckColumn("userid","int(11)","interne_events","DEFAULT '0' NOT NULL");
  $this->CheckColumn("sound","int(11)","interne_events","DEFAULT '0' NOT NULL");
  $this->CheckColumn("type","varchar(64)","interne_events","DEFAULT '' NOT NULL");
  $this->CheckColumn("zeitstempel","DATETIME","interne_events");


  $this->CheckTable("adapterbox_log");
  $this->CheckColumn("id","int(11)","adapterbox_log","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("ip","VARCHAR(64)","adapterbox_log","DEFAULT '' NOT NULL");
  $this->CheckColumn("meldung","VARCHAR(64)","adapterbox_log","DEFAULT '' NOT NULL");
  $this->CheckColumn("seriennummer","VARCHAR(64)","adapterbox_log","DEFAULT '' NOT NULL");
  $this->CheckColumn("device","VARCHAR(64)","adapterbox_log","DEFAULT '' NOT NULL");
  $this->CheckColumn("datum","DATETIME","adapterbox_log");



  $this->CheckTable("stechuhr");
  $this->CheckColumn("id","int(11)","stechuhr","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("datum","DATETIME","stechuhr");
  $this->CheckColumn("adresse","INT(11)","stechuhr","DEFAULT '0' NOT NULL");
  $this->CheckColumn("user","INT(11)","stechuhr","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kommen","tinyint(1)","stechuhr","DEFAULT '0' NOT NULL");
  $this->CheckColumn("status","varchar(20)","stechuhr","DEFAULT '' NOT NULL");
  $this->CheckColumn("uebernommen","tinyint(1)","stechuhr","DEFAULT '0' NOT NULL");
  $this->CheckColumn("mitarbeiterzeiterfassungid","int(15)","stechuhr","DEFAULT '0' NOT NULL");

  $this->CheckColumn("deckungsbeitragcalc","TINYINT(1)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("deckungsbeitrag","DECIMAL(10,2)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("erloes_netto","DECIMAL(10,2)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("umsatz_netto","DECIMAL(10,2)","auftrag","DEFAULT '0' NOT NULL");

  $this->CheckColumn("deckungsbeitragcalc","TINYINT(1)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("deckungsbeitrag","DECIMAL(10,2)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("erloes_netto","DECIMAL(10,2)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("umsatz_netto","DECIMAL(10,2)","angebot","DEFAULT '0' NOT NULL");

  $this->CheckColumn("deckungsbeitragcalc","TINYINT(1)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("deckungsbeitrag","DECIMAL(10,2)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("umsatz_netto","DECIMAL(10,2)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("erloes_netto","DECIMAL(10,2)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("mahnwesenfestsetzen","tinyint(1)","rechnung","DEFAULT '0' NOT NULL");

  $this->CheckColumn("deckungsbeitragcalc","TINYINT(1)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("deckungsbeitrag","DECIMAL(10,2)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("erloes_netto","DECIMAL(10,2)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("umsatz_netto","DECIMAL(10,2)","gutschrift","DEFAULT '0' NOT NULL");

  
  $this->CheckColumn("lieferdatum","DATE","angebot");
  $this->CheckColumn("auftragid","int(11)","angebot","DEFAULT '0' NOT NULL");

  $this->CheckColumn("lieferid","int(11)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("ansprechpartnerid","int(11)","angebot","DEFAULT '0' NOT NULL");

  $this->CheckColumn("lieferid","int(11)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("ansprechpartnerid","int(11)","auftrag","DEFAULT '0' NOT NULL");

  $this->CheckColumn("lieferid","int(11)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("ansprechpartnerid","int(11)","rechnung","DEFAULT '0' NOT NULL");

  $this->CheckColumn("lieferid","int(11)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("ansprechpartnerid","int(11)","gutschrift","DEFAULT '0' NOT NULL");

  $this->CheckColumn("lieferid","int(11)","lieferschein","DEFAULT '0' NOT NULL");
  $this->CheckColumn("ansprechpartnerid","int(11)","lieferschein","DEFAULT '0' NOT NULL");

  $this->CheckColumn("autorechnungsdruck","int(11)","autorechnungsdruck_rechnung");
  $this->CheckColumn("lieferdatum","DATE","auftrag");
  $this->CheckColumn("tatsaechlicheslieferdatum","DATE","auftrag");
  $this->CheckColumn("liefertermin_ok","int(1)","auftrag","DEFAULT '1' NOT NULL");
  $this->CheckColumn("teillieferung_moeglich","int(1)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kreditlimit_ok","int(1)","auftrag","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kreditlimit_freigabe","int(1)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("liefersperre_ok","int(1)","auftrag","DEFAULT '1' NOT NULL");
  $this->CheckColumn("teillieferungvon","int(11)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("teillieferungnummer","int(11)","auftrag","DEFAULT '0' NOT NULL");

  $this->CheckColumn("kopievon","int(11)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kopienummer","int(11)","angebot","DEFAULT '0' NOT NULL");



  $this->CheckColumn("vertriebid","INT(11)","anfrage");
  $this->CheckColumn("vertriebid","INT(11)","angebot");
  $this->CheckColumn("vertriebid","INT(11)","auftrag");
  $this->CheckColumn("vertriebid","INT(11)","rechnung");
  $this->CheckColumn("vertriebid","INT(11)","lieferschein");
  $this->CheckColumn("vertriebid","INT(11)","gutschrift");

  $this->CheckColumn("aktion","varchar(64)","anfrage","DEFAULT '' NOT NULL");
  $this->CheckColumn("aktion","varchar(64)","angebot","DEFAULT '' NOT NULL");
  $this->CheckColumn("aktion","varchar(64)","auftrag","DEFAULT '' NOT NULL");
  $this->CheckColumn("aktion","varchar(64)","rechnung","DEFAULT '' NOT NULL");
  $this->CheckColumn("aktion","varchar(64)","gutschrift","DEFAULT '' NOT NULL");



  $this->CheckColumn("vertrieb","VARCHAR(255)","anfrage","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(255)","anfrage","DEFAULT '' NOT NULL");
  $this->CheckColumn("vertrieb","VARCHAR(255)","angebot","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(255)","angebot","DEFAULT '' NOT NULL");
  $this->CheckColumn("vertrieb","VARCHAR(255)","auftrag","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(255)","auftrag","DEFAULT '' NOT NULL");
  $this->CheckColumn("vertrieb","VARCHAR(255)","rechnung","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(255)","rechnung","DEFAULT '' NOT NULL");
  $this->CheckColumn("vertrieb","VARCHAR(255)","lieferschein","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(255)","lieferschein","DEFAULT '' NOT NULL");
  $this->CheckColumn("vertrieb","VARCHAR(255)","gutschrift","DEFAULT '' NOT NULL");
  $this->CheckColumn("bearbeiter","VARCHAR(255)","gutschrift","DEFAULT '' NOT NULL");

  $this->CheckColumn("provision","DECIMAL(10,2)","angebot");
  $this->CheckColumn("provision_summe","DECIMAL(10,2)","angebot");
  $this->CheckColumn("provision","DECIMAL(10,2)","auftrag");
  $this->CheckColumn("provision_summe","DECIMAL(10,2)","auftrag");
  $this->CheckColumn("provision","DECIMAL(10,2)","rechnung");
  $this->CheckColumn("provision_summe","DECIMAL(10,2)","rechnung");
  $this->CheckColumn("provision","DECIMAL(10,2)","gutschrift");
  $this->CheckColumn("provision_summe","DECIMAL(10,2)","gutschrift");

  $this->CheckColumn("beschreibung","text","kalender_event");
  $this->CheckColumn("ort","text","kalender_event");
  $this->CheckColumn("mlmaktiv","int(1)","adresse");
  $this->CheckColumn("mlmvertragsbeginn","DATE","adresse");
  $this->CheckColumn("mlmlizenzgebuehrbis","DATE","adresse");
  $this->CheckColumn("mlmfestsetzenbis","DATE","adresse");
  //$this->CheckColumn("erfasstam","DATE","adresse");
  
  
  $this->CheckColumn("mlmfestsetzen","int(1)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("mlmmindestpunkte","int(1)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("mlmwartekonto","Decimal(10,2)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("mlmdirektpraemie","DECIMAL(10,2)","artikel");
  $this->CheckColumn("leerfeld","VARCHAR(64)","artikel");
  $this->CheckColumn("zolltarifnummer","VARCHAR(64)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("herkunftsland","VARCHAR(64)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("keineeinzelartikelanzeigen","TINYINT(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("mindesthaltbarkeitsdatum","int(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("letzteseriennummer","VARCHAR(255)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("individualartikel","int(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("keinrabatterlaubt","int(1)","artikel");
  $this->CheckColumn("rabatt","int(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("rabatt_prozent","DECIMAL(10,2)","artikel");
  

  $this->CheckColumn("laenge","DECIMAL(10,2)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("breite","DECIMAL(10,2)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("hoehe","DECIMAL(10,2)","artikel","DEFAULT '0' NOT NULL");

  $this->CheckColumn("geraet","tinyint(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("serviceartikel","tinyint(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("gebuehr","tinyint(1)","artikel","DEFAULT '0' NOT NULL");

  $this->CheckColumn("abweichende_rechnungsadresse","int(1)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("rechnung_vorname","varchar(255)","adresse");
  $this->CheckColumn("rechnung_name","varchar(255)","adresse");
  $this->CheckColumn("rechnung_titel","varchar(255)","adresse");
  $this->CheckColumn("rechnung_typ","varchar(255)","adresse");
  $this->CheckColumn("rechnung_strasse","varchar(255)","adresse");
  $this->CheckColumn("rechnung_ort","varchar(255)","adresse");
  $this->CheckColumn("rechnung_plz","varchar(255)","adresse");
  $this->CheckColumn("rechnung_ansprechpartner","varchar(255)","adresse");
  $this->CheckColumn("rechnung_land","varchar(255)","adresse");
  $this->CheckColumn("rechnung_abteilung","varchar(255)","adresse");
  $this->CheckColumn("rechnung_unterabteilung","varchar(255)","adresse");
  $this->CheckColumn("rechnung_adresszusatz","varchar(255)","adresse");
  $this->CheckColumn("rechnung_telefon","varchar(255)","adresse");
  $this->CheckColumn("rechnung_telefax","varchar(255)","adresse");
  $this->CheckColumn("rechnung_anschreiben","varchar(255)","adresse");
  $this->CheckColumn("rechnung_email","varchar(255)","adresse");

  $this->CheckColumn("geburtstag","DATE","adresse");
  $this->CheckColumn("geburtstagkalender","tinyint(1)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("rolledatum","DATE","adresse");
  $this->CheckColumn("liefersperre","int(1)","adresse");
  $this->CheckColumn("liefersperregrund","text","adresse");
  $this->CheckColumn("mlmpositionierung","varchar(255)","adresse");
  $this->CheckColumn("steuernummer","varchar(255)","adresse");
  $this->CheckColumn("steuerbefreit","int(1)","adresse");
  $this->CheckColumn("mlmmitmwst","int(1)","adresse");
  $this->CheckColumn("mlmabrechnung","varchar(255)","adresse");
  $this->CheckColumn("mlmwaehrungauszahlung","varchar(255)","adresse");
  $this->CheckColumn("mlmauszahlungprojekt","int(11)","adresse","DEFAULT '0' NOT NULL");
  $this->CheckColumn("sponsor","int(11)","adresse");
  $this->CheckColumn("geworbenvon","int(11)","adresse");
  $this->CheckColumn("passwordmd5","varchar(255)","user");
  $this->CheckColumn("projekt_bevorzugen","tinyint(1)","user","DEFAULT '0' NOT NULL");
  $this->CheckColumn("email_bevorzugen","tinyint(1)","user","DEFAULT '1' NOT NULL");
  $this->CheckColumn("projekt","INT(11)","user","DEFAULT '0' NOT NULL");
  $this->CheckColumn("rfidtag","varchar(64)","user","DEFAULT '' NOT NULL");
  $this->CheckColumn("vorlage","varchar(255)","user");
  $this->CheckColumn("kalender_passwort","varchar(255)","user");
  $this->CheckColumn("kalender_ausblenden","int(1)","user","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kalender_aktiv","int(1)","user");
  $this->CheckColumn("gpsstechuhr","int(1)","user");
  $this->CheckColumn("standardetikett","int(11)","user","DEFAULT '0' NOT NULL");
  $this->CheckColumn("standardfax","int(11)","user","DEFAULT '0' NOT NULL");
  $this->CheckColumn("internebezeichnung","varchar(255)","user");
  $this->CheckColumn("logfile","text","adresse");
  $this->CheckColumn("kalender_aufgaben","int(1)","adresse");     
  $this->CheckColumn("adresse","int(11)","arbeitsnachweis_position");     
  $this->CheckColumn("dateiid","int(11)","dokumente_send");       
  $this->CheckColumn("autolagersperre","int(1)","lager_platz","DEFAULT '0' NOT NULL");    
  $this->CheckColumn("verbrauchslager","int(1)","lager_platz","DEFAULT '0' NOT NULL");    

  $this->CheckColumn("laenge","DECIMAL(10,2)","lager_platz","DEFAULT '0' NOT NULL");
  $this->CheckColumn("breite","DECIMAL(10,2)","lager_platz","DEFAULT '0' NOT NULL");
  $this->CheckColumn("hoehe","DECIMAL(10,2)","lager_platz","DEFAULT '0' NOT NULL");


  $this->CheckColumn("sperrlager","int(1)","lager_platz","DEFAULT '0' NOT NULL"); 
  $this->CheckColumn("poslager","int(1)","lager_platz","DEFAULT '0' NOT NULL"); 

  $this->CheckColumn("projekt","int(11)","lager","DEFAULT '0' NOT NULL");    

  $this->CheckColumn("verrechnungskontoreisekosten","int(11)","adresse","DEFAULT '0' NOT NULL");  

  $this->CheckColumn("status","varchar(255)","zeiterfassung");    
  $this->CheckColumn("internerkommentar","TEXT","zeiterfassung");    
  $this->CheckColumn("gps","varchar(1024)","zeiterfassung");      
  $this->CheckColumn("arbeitsnachweispositionid","int(11)","zeiterfassung","DEFAULT '0' NOT NULL");       
  $this->CheckColumn("aufgabe_id","int(11)","zeiterfassung","DEFAULT '0' NOT NULL"); 



  $this->CheckColumn("wert","text","stueckliste","DEFAULT '' NOT NULL");  
  $this->CheckColumn("bauform","text","stueckliste","DEFAULT '' NOT NULL");       

  $this->CheckColumn("artikelporto","int(11)","shopexport","DEFAULT '0' NOT NULL");       
  $this->CheckColumn("artikelnachnahme","int(11)","shopexport","DEFAULT '0' NOT NULL");   
  $this->CheckColumn("artikelnachnahme_extraartikel","tinyint(1)","shopexport","DEFAULT '1' NOT NULL");   
  $this->CheckColumn("artikelimport","int(1)","shopexport","DEFAULT '0' NOT NULL");       
  $this->CheckColumn("artikelimporteinzeln","int(1)","shopexport","DEFAULT '0' NOT NULL");        
  $this->CheckColumn("autoabgleicherlaubt","int(1)","artikel","DEFAULT '0' NOT NULL");    
  $this->CheckColumn("pseudopreis","DECIMAL(10,2)","artikel");    
  $this->CheckColumn("pseudolager","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");    
  $this->CheckColumn("freigabenotwendig","int(1)","artikel","DEFAULT '0' NOT NULL");      
  $this->CheckColumn("freigaberegel","varchar(255)","artikel","DEFAULT '' NOT NULL");     
  $this->CheckColumn("vorabbezahltmarkieren_ohnevorkasse_bar","int(11)","shopexport","DEFAULT '0' NOT NULL");
  $this->CheckColumn("artikelnummernummerkreis","tinyint(1)", "shopexport", "DEFAULT '0' NOT NULL");

  $this->CheckColumn("demomodus","tinyint(1)","shopexport","DEFAULT '0' NOT NULL");       
  $this->CheckColumn("einzelsync","tinyint(1)","shopexport","DEFAULT '0' NOT NULL");       

  $this->CheckColumn("aktiv","int(1)","shopexport","DEFAULT '1' NOT NULL");       
  $this->CheckColumn("lagerexport","int(1)","shopexport","DEFAULT '1' NOT NULL"); 
  $this->CheckColumn("utf8codierung","tinyint(1)","shopexport","DEFAULT '1' NOT NULL"); 
  $this->CheckColumn("artikelexport","int(1)","shopexport","DEFAULT '1' NOT NULL");       

  $this->CheckColumn("tomail","varchar(255)","drucker","DEFAULT '' NOT NULL");    
  $this->CheckColumn("tomailtext","text","drucker","DEFAULT '' NOT NULL");        
  $this->CheckColumn("tomailsubject","text","drucker","DEFAULT '' NOT NULL");     
  $this->CheckColumn("adapterboxip","varchar(255)","drucker","DEFAULT '' NOT NULL");      
  $this->CheckColumn("adapterboxseriennummer","varchar(255)","drucker","DEFAULT '' NOT NULL");    
  $this->CheckColumn("adapterboxpasswort","varchar(255)","drucker","DEFAULT '' NOT NULL");        
  $this->CheckColumn("anbindung","varchar(255)","drucker","DEFAULT '' NOT NULL"); 
  $this->CheckColumn("art","int(1)","drucker","DEFAULT '0' NOT NULL");    
  $this->CheckColumn("faxserver","int(1)","drucker","DEFAULT '0' NOT NULL");      
  $this->CheckColumn("format","varchar(64)","drucker","DEFAULT '' NOT NULL"); 

  $this->CheckColumn("anzeige_verrechnungsart","int(1)","arbeitsnachweis","DEFAULT '0' NOT NULL");

  $this->CheckColumn("ust_befreit","int(1)","arbeitsnachweis","NOT NULL");
  $this->CheckColumn("ust_befreit","int(1)","reisekosten","NOT NULL");
  $this->CheckColumn("ust_befreit","int(1)","lieferschein","NOT NULL");
  $this->CheckColumn("ust_befreit","int(1)","bestellung","NOT NULL");

  $this->CheckColumn("keinsteuersatz","int(1)","angebot");
  $this->CheckColumn("anfrageid","int(11)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("anfrageid","int(11)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("gruppe","int(11)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("gruppe","int(11)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("gruppe","int(11)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("gruppe","int(11)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("shopextid","varchar(1024)","auftrag","DEFAULT '' NOT NULL");
  $this->CheckColumn("shopextstatus","varchar(1024)","auftrag","DEFAULT '' NOT NULL");

  $this->CheckColumn("systemfreitext","TEXT","rechnung","DEFAULT '' NOT NULL");
  $this->CheckColumn("systemfreitext","TEXT","auftrag","DEFAULT '' NOT NULL");

  $this->CheckColumn("nachbestellt","int(1)","artikel");
  $this->CheckColumn("ean","varchar(1024)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("mlmpunkte","int(11)","artikel");
  $this->CheckColumn("mlmbonuspunkte","int(11)","artikel");
  $this->CheckColumn("mlmdirektpraemie","DECIMAL(10,2)","artikel");
  $this->CheckColumn("mlmkeinepunkteeigenkauf","int(1)","artikel");



  $this->CheckColumn("shop2","int(11)","artikel");
  $this->CheckColumn("shop3","int(11)","artikel");

  $this->CheckColumn("zolltarifnummer","VARCHAR(128)","rechnung_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("herkunftsland","VARCHAR(128)","rechnung_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("artikelnummerkunde","VARCHAR(128)","rechnung_position","DEFAULT '' NOT NULL");

  $this->CheckColumn("zolltarifnummer","VARCHAR(128)","gutschrift_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("herkunftsland","VARCHAR(128)","gutschrift_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("artikelnummerkunde","VARCHAR(128)","gutschrift_position","DEFAULT '' NOT NULL");

  $this->CheckColumn("zolltarifnummer","VARCHAR(128)","angebot_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("herkunftsland","VARCHAR(128)","angebot_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("artikelnummerkunde","VARCHAR(128)","angebot_position","DEFAULT '' NOT NULL");

  $this->CheckColumn("zolltarifnummer","VARCHAR(128)","auftrag_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("herkunftsland","VARCHAR(128)","auftrag_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("artikelnummerkunde","VARCHAR(128)","auftrag_position","DEFAULT '' NOT NULL");

  $this->CheckColumn("zolltarifnummer","VARCHAR(128)","lieferschein_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("herkunftsland","VARCHAR(128)","lieferschein_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("artikelnummerkunde","VARCHAR(128)","lieferschein_position","DEFAULT '' NOT NULL");

  $this->CheckColumn("zolltarifnummer","VARCHAR(128)","bestellung_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("herkunftsland","VARCHAR(128)","bestellung_position","DEFAULT '' NOT NULL");






  $this->CheckColumn("punkte","int(11)","rechnung_position");
  $this->CheckColumn("bonuspunkte","int(11)","rechnung_position");
  $this->CheckColumn("mlmdirektpraemie","DECIMAL(10,2)","rechnung_position");
  $this->CheckColumn("mlm_abgerechnet","int(1)","rechnung_position");

  $this->CheckColumn("punkte","int(11)","angebot_position");
  $this->CheckColumn("bonuspunkte","int(11)","angebot_position");
  $this->CheckColumn("mlmdirektpraemie","DECIMAL(10,2)","angebot_position");

  $this->CheckColumn("punkte","int(11)","auftrag_position");
  $this->CheckColumn("bonuspunkte","int(11)","auftrag_position");
  $this->CheckColumn("mlmdirektpraemie","DECIMAL(10,2)","auftrag_position");

  $this->CheckColumn("keinrabatterlaubt","int(1)","angebot_position");
  $this->CheckColumn("keinrabatterlaubt","int(1)","auftrag_position");
  $this->CheckColumn("keinrabatterlaubt","int(1)","rechnung_position");
  $this->CheckColumn("keinrabatterlaubt","int(1)","gutschrift_position");


  $this->CheckColumn("punkte","int(11)","rechnung");
  $this->CheckColumn("bonuspunkte","int(11)","rechnung");
  $this->CheckColumn("provdatum","DATE","rechnung");


  $this->CheckColumn("ihrebestellnummer","varchar(255)","rechnung");
  $this->CheckColumn("ihrebestellnummer","varchar(255)","lieferschein");
  $this->CheckColumn("ihrebestellnummer","varchar(255)","auftrag");
  $this->CheckColumn("ihrebestellnummer","varchar(255)","gutschrift");

  $this->CheckColumn("anschreiben","varchar(255)","anfrage");
  $this->CheckColumn("anschreiben","varchar(255)","angebot");
  $this->CheckColumn("anschreiben","varchar(255)","auftrag");
  $this->CheckColumn("anschreiben","varchar(255)","rechnung");
  $this->CheckColumn("anschreiben","varchar(255)","lieferschein");
  $this->CheckColumn("anschreiben","varchar(255)","gutschrift");
  $this->CheckColumn("anschreiben","varchar(255)","bestellung");
  $this->CheckColumn("anschreiben","varchar(255)","arbeitsnachweis");
  $this->CheckColumn("anschreiben","varchar(255)","anfrage");

  $this->CheckColumn("projektfiliale","int(11)","anfrage","DEFAULT '0' NOT NULL");
  $this->CheckColumn("projektfiliale","int(11)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("projektfiliale","int(11)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("projektfiliale","int(11)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("projektfiliale","int(11)","lieferschein","DEFAULT '0' NOT NULL");
  $this->CheckColumn("projektfiliale","int(11)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("projektfiliale","int(11)","bestellung","DEFAULT '0' NOT NULL");

  $this->CheckColumn("projektfiliale_eingelagert","tinyint(1)","lieferschein","DEFAULT '0' NOT NULL");
  
  $this->CheckColumn("usereditid","int(11)","anfrage");
  $this->CheckColumn("usereditid","int(11)","angebot");
  $this->CheckColumn("usereditid","int(11)","auftrag");
  $this->CheckColumn("usereditid","int(11)","rechnung");
  $this->CheckColumn("usereditid","int(11)","lieferschein");
  $this->CheckColumn("usereditid","int(11)","gutschrift");
  $this->CheckColumn("usereditid","int(11)","bestellung");
  $this->CheckColumn("usereditid","int(11)","arbeitsnachweis");
  $this->CheckColumn("usereditid","int(11)","reisekosten");
  $this->CheckColumn("usereditid","int(11)","inventur");
  $this->CheckColumn("usereditid","int(11)","artikel");
  $this->CheckColumn("usereditid","int(11)","adresse");

  $this->CheckColumn("useredittimestamp","timestamp","anfrage");
  $this->CheckColumn("useredittimestamp","timestamp","angebot");
  $this->CheckColumn("useredittimestamp","timestamp","auftrag");
  $this->CheckColumn("useredittimestamp","timestamp","rechnung");
  $this->CheckColumn("useredittimestamp","timestamp","lieferschein");
  $this->CheckColumn("useredittimestamp","timestamp","gutschrift");
  $this->CheckColumn("useredittimestamp","timestamp","bestellung");
  $this->CheckColumn("useredittimestamp","timestamp","arbeitsnachweis");
  $this->CheckColumn("useredittimestamp","timestamp","reisekosten");
  $this->CheckColumn("useredittimestamp","timestamp","inventur");
  $this->CheckColumn("useredittimestamp","timestamp","artikel");
  $this->CheckColumn("useredittimestamp","timestamp","adresse");

  $this->CheckColumn("realrabatt","DECIMAL(10,2)","anfrage");
  $this->CheckColumn("realrabatt","DECIMAL(10,2)","angebot");
  $this->CheckColumn("realrabatt","DECIMAL(10,2)","auftrag");
  $this->CheckColumn("realrabatt","DECIMAL(10,2)","rechnung");
  $this->CheckColumn("realrabatt","DECIMAL(10,2)","gutschrift");

  $this->CheckColumn("rabatt","DECIMAL(10,2)","anfrage");
  $this->CheckColumn("rabatt","DECIMAL(10,2)","angebot");
  $this->CheckColumn("rabatt","DECIMAL(10,2)","auftrag");
  $this->CheckColumn("rabatt","DECIMAL(10,2)","rechnung");
  $this->CheckColumn("rabatt","DECIMAL(10,2)","gutschrift");
  $this->CheckColumn("rabatt","DECIMAL(10,2)","adresse");
  $this->CheckColumn("provision","DECIMAL(10,2)","adresse");
  $this->CheckColumn("rabattinformation","TEXT","adresse");

  $this->CheckColumn("einzugsdatum","DATE","auftrag");
  $this->CheckColumn("einzugsdatum","DATE","rechnung");

  $this->CheckColumn("grundrabatt","DECIMAL(10,2)","anfrage_position");
  $this->CheckColumn("grundrabatt","DECIMAL(10,2)","angebot_position");
  $this->CheckColumn("grundrabatt","DECIMAL(10,2)","auftrag_position");
  $this->CheckColumn("grundrabatt","DECIMAL(10,2)","rechnung_position");
  $this->CheckColumn("grundrabatt","DECIMAL(10,2)","gutschrift_position");


  $this->CheckColumn("rabattsync","INT(1)","anfrage_position");
  $this->CheckColumn("rabattsync","INT(1)","angebot_position");
  $this->CheckColumn("rabattsync","INT(1)","auftrag_position");
  $this->CheckColumn("rabattsync","INT(1)","rechnung_position");
  $this->CheckColumn("rabattsync","INT(1)","gutschrift_position");


  for($ij=1;$ij<=15;$ij++)
  {
    $this->CheckColumn("bestellung$ij","INT(1)","verbindlichkeit","DEFAULT '0' NOT NULL");
    $this->CheckColumn("bestellung".$ij."betrag","DECIMAL(10,2)","verbindlichkeit","DEFAULT '0' NOT NULL");
    $this->CheckColumn("bestellung".$ij."bemerkung","VARCHAR(255)","verbindlichkeit","DEFAULT '' NOT NULL");
  }


  for($ij=1;$ij<=5;$ij++)
  {
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","anfrage");
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","angebot");
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","auftrag");
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","rechnung");
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","adresse");
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","gutschrift");

    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","anfrage_position");
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","angebot_position");
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","auftrag_position");
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","rechnung_position");
    $this->CheckColumn("rabatt$ij","DECIMAL(10,2)","gutschrift_position");
  }




  $this->CheckColumn("shop","int(11)","auftrag","DEFAULT '0' NOT NULL");

  $this->CheckColumn("forderungsverlust_datum","DATE","rechnung");
  $this->CheckColumn("forderungsverlust_betrag","DECIMAL(10,2)","rechnung");

  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","rechnung","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","rechnung","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","rechnung","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","rechnung","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","rechnung","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(255)","rechnung","DEFAULT 'EUR' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(3)","verbindlichkeit","DEFAULT 'EUR' NOT NULL");
  
  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","angebot","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","angebot","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","angebot","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","angebot","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","angebot","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(255)","angebot","DEFAULT 'EUR' NOT NULL");

  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","auftrag","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","auftrag","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","auftrag","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","auftrag","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","auftrag","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(255)","auftrag","DEFAULT 'EUR' NOT NULL");

  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","gutschrift","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","gutschrift","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","gutschrift","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","gutschrift","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","gutschrift","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(255)","gutschrift","DEFAULT 'EUR' NOT NULL");

  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","bestellung","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","bestellung","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","bestellung","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","bestellung","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","bestellung","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(255)","bestellung","DEFAULT 'EUR' NOT NULL");


  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","inventur","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","inventur","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","inventur","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","inventur","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","inventur","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(255)","inventur","DEFAULT 'EUR' NOT NULL");

  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","anfrage","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","anfrage","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","anfrage","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","anfrage","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","anfrage","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(255)","anfrage","DEFAULT 'EUR' NOT NULL");



  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","reisekosten","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","reisekosten","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","reisekosten","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","reisekosten","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","reisekosten","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(255)","reisekosten","DEFAULT 'EUR' NOT NULL");


  $this->CheckColumn("breite_position","INT(11)","firmendaten","DEFAULT '10' NOT NULL");
  $this->CheckColumn("breite_menge","INT(11)","firmendaten","DEFAULT '10' NOT NULL");
  $this->CheckColumn("breite_nummer","INT(11)","firmendaten","DEFAULT '20' NOT NULL");
  $this->CheckColumn("breite_einheit","INT(11)","firmendaten","DEFAULT '15' NOT NULL");
  $this->CheckColumn("briefhtml","tinyint(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("seite_von_ausrichtung_relativ","tinyint(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("absenderunterstrichen","tinyint(1)","firmendaten","DEFAULT '1' NOT NULL");
  $this->CheckColumn("schriftgroesseabsender","INT(11)","firmendaten","DEFAULT '7' NOT NULL");
  $this->CheckColumn("datatables_export_button_flash","tinyint(1)","firmendaten","DEFAULT '1' NOT NULL");
  $this->CheckColumn("land","VARCHAR(2)","firmendaten","DEFAULT 'DE' NOT NULL");
  $this->CheckColumn("modul_finanzbuchhaltung","TINYINT(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("testmailempfaenger","VARCHAR(128)","firmendaten","DEFAULT '' NOT NULL");

  $this->CheckColumn("geburtstagekalender","tinyint(1)","firmendaten","DEFAULT '1' NOT NULL");

  $this->CheckColumn("skonto_ueberweisung_ueberziehen","INT(11)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","firmendaten","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","firmendaten","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","firmendaten","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","firmendaten","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","firmendaten","DEFAULT '7.0' NOT NULL");

  $this->CheckColumn("steuersatz_normal","DECIMAL(10,2)","projekt","DEFAULT '19.0' NOT NULL");
  $this->CheckColumn("steuersatz_zwischen","DECIMAL(10,2)","projekt","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_ermaessigt","DECIMAL(10,2)","projekt","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_starkermaessigt","DECIMAL(10,2)","projekt","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("steuersatz_dienstleistung","DECIMAL(10,2)","projekt","DEFAULT '7.0' NOT NULL");
  $this->CheckColumn("waehrung","VARCHAR(3)","projekt","DEFAULT 'EUR' NOT NULL");
  $this->CheckColumn("land","VARCHAR(2)","projekt","DEFAULT 'DE' NOT NULL");
  $this->CheckColumn("eigenesteuer","INT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("druckerlogistikstufe1","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("druckerlogistikstufe2","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("etiketten_positionen","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("etiketten_drucker","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("etiketten_art","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("selbstabholermail","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("eanherstellerscan","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("seriennummernerfassen","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("versandzweigeteilt","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("nachnahmecheck","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_lieferschein_anlegen","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_lagerprozess","VARCHAR(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("kasse_belegausgabe","VARCHAR(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("kasse_preisgruppe","INT(11)","projekt","DEFAULT '0' NOT NULL");

  $this->CheckColumn("kasse_text_bemerkung","VARCHAR(64)","projekt","DEFAULT 'Interne Bemerkung' NOT NULL");
  $this->CheckColumn("kasse_text_freitext","VARCHAR(64)","projekt","DEFAULT 'Text auf Beleg' NOT NULL");
  $this->CheckColumn("kasse_drucker","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_lieferschein","INT(11)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_rechnung","INT(11)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_lieferschein_doppel","INT(11)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_lager","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_konto","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_laufkundschaft","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_rabatt_artikel","INT(11)","projekt","DEFAULT '0' NOT NULL");

  $this->CheckColumn("kasse_zahlung_bar","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_zahlung_bar_bezahlt","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_zahlung_ec","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_zahlung_ec_bezahlt","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_zahlung_kreditkarte","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_zahlung_kreditkarte_bezahlt","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_zahlung_ueberweisung","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_zahlung_ueberweisung_bezahlt","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_zahlung_paypal","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_zahlung_paypal_bezahlt","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");

  $this->CheckColumn("kasse_extra_keinbeleg","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_extra_rechnung","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_extra_quittung","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_extra_gutschein","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_extra_rabatt_prozent","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_extra_rabatt_euro","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_adresse_erweitert","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("kasse_zahlungsauswahl_zwang","TINYINT(1)","projekt","DEFAULT '1' NOT NULL");

  $this->CheckColumn("kasse_button_entnahme","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_button_trinkgeld","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kasse_vorauswahl_anrede","varchar(64)","projekt","DEFAULT 'herr' NOT NULL");

  $this->CheckColumn("kasse_erweiterte_lagerabfrage","TINYINT(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("filialadresse","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("versandprojektfiliale","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("differenz_auslieferung_tage","INT(11)","projekt","DEFAULT '2' NOT NULL");
  $this->CheckColumn("autostuecklistenanpassung","INT(11)","projekt","DEFAULT '1' NOT NULL");

  $this->CheckColumn("kleinunternehmer","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("mahnwesenmitkontoabgleich","int(1)","firmendaten","DEFAULT '1' NOT NULL");
  $this->CheckColumn("porto_berechnen","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("immernettorechnungen","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("immerbruttorechnungen","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schnellanlegen","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("bestellvorschlaggroessernull","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("versand_gelesen","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("versandart","varchar(64)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("zahlungsweise","varchar(64)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("zahlung_lastschrift_konditionen","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("breite_artikelbeschreibung","tinyint(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("devicekey","varchar(255)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("deviceserials","TEXT","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("deviceenable","tinyint(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("sepaglaeubigerid","varchar(64)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("viernachkommastellen_belege","tinyint(1)","firmendaten","DEFAULT '0' NOT NULL");

  $this->CheckColumn("etikettendrucker_wareneingang","int(11)","firmendaten","DEFAULT '0' NOT NULL");

  $this->CheckColumn("waehrung","VARCHAR(255)","firmendaten","DEFAULT 'EUR' NOT NULL");
  $this->CheckColumn("footer_breite1","int(11)","firmendaten","DEFAULT '50' NOT NULL");
  $this->CheckColumn("footer_breite2","int(11)","firmendaten","DEFAULT '35' NOT NULL");
  $this->CheckColumn("footer_breite3","int(11)","firmendaten","DEFAULT '60' NOT NULL");
  $this->CheckColumn("footer_breite4","int(11)","firmendaten","DEFAULT '40' NOT NULL");
  $this->CheckColumn("footer_breite4","int(11)","firmendaten","DEFAULT '40' NOT NULL");
  $this->CheckColumn("boxausrichtung","VARCHAR(255)","firmendaten","DEFAULT 'R' NOT NULL");
  $this->CheckColumn("lizenz","TEXT","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("schluessel","TEXT","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("branch","VARCHAR(255)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("version","VARCHAR(255)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("standard_datensaetze_datatables","int(11)","firmendaten","DEFAULT '10' NOT NULL");
  $this->CheckColumn("auftrag_bezeichnung_vertrieb","VARCHAR(64)","firmendaten","DEFAULT 'Vertrieb' NOT NULL");
  $this->CheckColumn("auftrag_bezeichnung_bearbeiter","VARCHAR(64)","firmendaten","DEFAULT 'Bearbeiter' NOT NULL");
  $this->CheckColumn("auftrag_bezeichnung_bestellnummer","VARCHAR(64)","firmendaten","DEFAULT 'Ihre Bestellnummer' NOT NULL");
  $this->CheckColumn("bezeichnungkundennummer","VARCHAR(64)","firmendaten","DEFAULT 'Kundennummer' NOT NULL");
  $this->CheckColumn("bezeichnungstornorechnung","VARCHAR(64)","firmendaten","DEFAULT 'Stornorechnung' NOT NULL");
  $this->CheckColumn("bezeichnungangebotersatz","VARCHAR(64)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("bestellungohnepreis","tinyint(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("mysql55","tinyint(1)","firmendaten","DEFAULT '1' NOT NULL");


  $this->CheckColumn("rechnung_gutschrift_ansprechpartner","int(1)","firmendaten","DEFAULT '1' NOT NULL");
  $this->CheckColumn("stornorechnung_standard","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("angebotersatz_standard","int(1)","firmendaten","DEFAULT '0' NOT NULL");

  $this->CheckColumn("api_initkey","VARCHAR(1024)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("api_remotedomain","VARCHAR(1024)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("api_eventurl","VARCHAR(1024)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("api_enable","INT(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("api_cleanutf8","tinyint(1)","firmendaten","DEFAULT '1' NOT NULL");
  $this->CheckColumn("api_importwarteschlange","INT(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("api_importwarteschlange_name","VARCHAR(255)","firmendaten","DEFAULT '' NOT NULL");
  //$this->CheckColumn("api_webid_url_adresse","VARCHAR(1024)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("wareneingang_zwischenlager","INT(1)","firmendaten","DEFAULT '1' NOT NULL");

  $this->CheckColumn("modul_mlm","INT(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("modul_verband","INT(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("modul_mhd","INT(1)","firmendaten","DEFAULT '0' NOT NULL");

  $this->CheckColumn("modul_verein","INT(1)","firmendaten","DEFAULT '0' NOT NULL");

  $this->CheckColumn("mhd_warnung_tage","int(11)","firmendaten","DEFAULT '3' NOT NULL");

  $this->CheckColumn("mlm_mindestbetrag","DECIMAL(10,2)","firmendaten","DEFAULT '50.0' NOT NULL");
  $this->CheckColumn("mlm_anzahlmonate","int(11)","firmendaten","DEFAULT '11' NOT NULL");
  $this->CheckColumn("mlm_letzter_tag","DATE","firmendaten","");
  $this->CheckColumn("mlm_erster_tag","DATE","firmendaten","");
  $this->CheckColumn("mlm_letzte_berechnung","DATETIME","firmendaten","");
  //              $this->CheckColumn("mlm_zentrale","int(1)","adresse","DEFAULT '0' NOT NULL");

  $this->CheckColumn("mlm_01","DECIMAL(10,2)","firmendaten","DEFAULT '15' NOT NULL");
  $this->CheckColumn("mlm_02","DECIMAL(10,2)","firmendaten","DEFAULT '20' NOT NULL");
  $this->CheckColumn("mlm_03","DECIMAL(10,2)","firmendaten","DEFAULT '28' NOT NULL");
  $this->CheckColumn("mlm_04","DECIMAL(10,2)","firmendaten","DEFAULT '32' NOT NULL");
  $this->CheckColumn("mlm_05","DECIMAL(10,2)","firmendaten","DEFAULT '36' NOT NULL");
  $this->CheckColumn("mlm_06","DECIMAL(10,2)","firmendaten","DEFAULT '40' NOT NULL");
  $this->CheckColumn("mlm_07","DECIMAL(10,2)","firmendaten","DEFAULT '44' NOT NULL");
  $this->CheckColumn("mlm_08","DECIMAL(10,2)","firmendaten","DEFAULT '44' NOT NULL");
  $this->CheckColumn("mlm_09","DECIMAL(10,2)","firmendaten","DEFAULT '44' NOT NULL");
  $this->CheckColumn("mlm_10","DECIMAL(10,2)","firmendaten","DEFAULT '44' NOT NULL");
  $this->CheckColumn("mlm_11","DECIMAL(10,2)","firmendaten","DEFAULT '50' NOT NULL");
  $this->CheckColumn("mlm_12","DECIMAL(10,2)","firmendaten","DEFAULT '54' NOT NULL");
  $this->CheckColumn("mlm_13","DECIMAL(10,2)","firmendaten","DEFAULT '45' NOT NULL");
  $this->CheckColumn("mlm_14","DECIMAL(10,2)","firmendaten","DEFAULT '48' NOT NULL");
  $this->CheckColumn("mlm_15","DECIMAL(10,2)","firmendaten","DEFAULT '60' NOT NULL");

  $this->CheckColumn("mlm_01_punkte","int(11)","firmendaten","DEFAULT '2999' NOT NULL");
  $this->CheckColumn("mlm_02_punkte","int(11)","firmendaten","DEFAULT '3000' NOT NULL");
  $this->CheckColumn("mlm_03_punkte","int(11)","firmendaten","DEFAULT '5000' NOT NULL");
  $this->CheckColumn("mlm_04_punkte","int(11)","firmendaten","DEFAULT '10000' NOT NULL");
  $this->CheckColumn("mlm_05_punkte","int(11)","firmendaten","DEFAULT '15000' NOT NULL");
  $this->CheckColumn("mlm_06_punkte","int(11)","firmendaten","DEFAULT '25000' NOT NULL");
  $this->CheckColumn("mlm_07_punkte","int(11)","firmendaten","DEFAULT '50000' NOT NULL");
  $this->CheckColumn("mlm_08_punkte","int(11)","firmendaten","DEFAULT '100000' NOT NULL");
  $this->CheckColumn("mlm_09_punkte","int(11)","firmendaten","DEFAULT '150000' NOT NULL");
  $this->CheckColumn("mlm_10_punkte","int(11)","firmendaten","DEFAULT '200000' NOT NULL");
  $this->CheckColumn("mlm_11_punkte","int(11)","firmendaten","DEFAULT '250000' NOT NULL");
  $this->CheckColumn("mlm_12_punkte","int(11)","firmendaten","DEFAULT '300000' NOT NULL");
  $this->CheckColumn("mlm_13_punkte","int(11)","firmendaten","DEFAULT '350000' NOT NULL");
  $this->CheckColumn("mlm_14_punkte","int(11)","firmendaten","DEFAULT '400000' NOT NULL");
  $this->CheckColumn("mlm_15_punkte","int(11)","firmendaten","DEFAULT '450000' NOT NULL");

  $this->CheckColumn("mlm_01_mindestumsatz","int(11)","firmendaten","DEFAULT '50' NOT NULL");
  $this->CheckColumn("mlm_02_mindestumsatz","int(11)","firmendaten","DEFAULT '50' NOT NULL");
  $this->CheckColumn("mlm_03_mindestumsatz","int(11)","firmendaten","DEFAULT '50' NOT NULL");
  $this->CheckColumn("mlm_04_mindestumsatz","int(11)","firmendaten","DEFAULT '50' NOT NULL");
  $this->CheckColumn("mlm_05_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_06_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_07_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_08_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_09_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_10_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_11_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_12_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_13_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_14_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");
  $this->CheckColumn("mlm_15_mindestumsatz","int(11)","firmendaten","DEFAULT '100' NOT NULL");



  $this->CheckColumn("standardaufloesung","int(11)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("standardversanddrucker","int(11)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("standardetikettendrucker","int(11)","firmendaten","DEFAULT '0' NOT NULL");
  

  $this->CheckColumn("keinsteuersatz","int(1)","auftrag");
  $this->CheckColumn("keinsteuersatz","int(1)","rechnung");
  $this->CheckColumn("keinsteuersatz","int(1)","gutschrift");

  $this->CheckColumn("freifeld1","text","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld2","text","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld3","text","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld4","text","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld5","text","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld6","text","artikel","DEFAULT '' NOT NULL");

  $this->CheckColumn("einheit","varchar(255)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("einheit","varchar(255)","angebot_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("einheit","varchar(255)","auftrag_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("einheit","varchar(255)","rechnung_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("einheit","varchar(255)","gutschrift_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("einheit","varchar(255)","lieferschein_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("einheit","varchar(255)","bestellung_position","DEFAULT '' NOT NULL");

  $this->CheckColumn("bestellungohnepreis","tinyint(1)","bestellung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lieferantenretoure","tinyint(1)","lieferschein","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lieferantenretoureinfo","TEXT","lieferschein","DEFAULT '' NOT NULL");
  $this->CheckColumn("lieferant","INT(11)","lieferschein","DEFAULT '0' NOT NULL");

  $this->CheckColumn("bestellung_bestaetigt","tinyint(1)","bestellung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("bestaetigteslieferdatum","DATE","bestellung");
  $this->CheckColumn("bestellungbestaetigtper","varchar(64)","bestellung","DEFAULT '' NOT NULL");
  $this->CheckColumn("bestellungbestaetigtabnummer","varchar(64)","bestellung","DEFAULT '' NOT NULL");
  $this->CheckColumn("gewuenschteslieferdatum","DATE","bestellung");

  $this->CheckColumn("optional","int(1)","angebot_position","DEFAULT '0' NOT NULL");

  $this->CheckColumn("adresse","int(11)","lager_bewegung");
  $this->CheckColumn("bestand","int(11)","lager_bewegung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("permanenteinventur","tinyint(1)","lager_bewegung","DEFAULT '0' NOT NULL");

  $this->CheckColumn("geloescht","int(1)","arbeitspaket");
  $this->CheckColumn("vorgaenger","int(11)","arbeitspaket");
  $this->CheckColumn("kosten_geplant","decimal(10,4)","arbeitspaket");
  $this->CheckColumn("artikel_geplant","int(11)","arbeitspaket");

  $this->CheckColumn("adresse_abrechnung","int(11)","zeiterfassung");
  $this->CheckColumn("abrechnen","int(1)","zeiterfassung");
  $this->CheckColumn("ist_abgerechnet","int(1)","zeiterfassung");
  $this->CheckColumn("gebucht_von_user","int(11)","zeiterfassung");
  $this->CheckColumn("ort","varchar(1024)","zeiterfassung");
  $this->CheckColumn("abrechnung_dokument","varchar(1024)","zeiterfassung");
  $this->CheckColumn("dokumentid","int(11)","zeiterfassung");

  $this->CheckColumn("verrechnungsart","varchar(255)","zeiterfassung");

  $this->CheckColumn("reservierung","int(1)","projekt");
  $this->CheckColumn("verkaufszahlendiagram","int(1)","projekt");
  $this->CheckColumn("oeffentlich","int(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("shopzwangsprojekt","int(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("kunde","int(11)","projekt");
  $this->CheckColumn("dpdkundennr","varchar(255)","projekt");
  $this->CheckColumn("dhlkundennr","varchar(255)","projekt");
  $this->CheckColumn("dhlformat","TEXT","projekt");
  $this->CheckColumn("dpdformat","TEXT","projekt");
  $this->CheckColumn("paketmarke_einzeldatei","int(1)","projekt");
  $this->CheckColumn("dpdpfad","varchar(255)","projekt");
  $this->CheckColumn("dpdendung","varchar(64)","projekt","DEFAULT '.csv' NOT NULL");
  $this->CheckColumn("dhlendung","varchar(64)","projekt","DEFAULT '.csv' NOT NULL");
  $this->CheckColumn("dhlpfad","varchar(255)","projekt");
  $this->CheckColumn("upspfad","varchar(255)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("dhlintodb","tinyint(1)","projekt","DEFAULT '0' NOT NULL");

  $this->CheckColumn("tracking_substr_start","INT(11)","projekt","DEFAULT '8' NOT NULL");
  $this->CheckColumn("tracking_remove_kundennummer","tinyint(11)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("tracking_substr_length","tinyint(11)","projekt","DEFAULT '0' NOT NULL");

  $this->CheckColumn("go_drucker","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("go_apiurl_prefix","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_apiurl_postfix","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_apiurl_user","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_username","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_password","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_ax4nr","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_name1","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_name2","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_abteilung","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_strasse1","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_strasse2","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_hausnummer","VARCHAR(10)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_plz","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_ort","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_land","VARCHAR(128)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("go_standardgewicht","DECIMAL(10,2)","projekt");
  $this->CheckColumn("go_format","VARCHAR(64)","projekt");
  $this->CheckColumn("go_ausgabe","VARCHAR(64)","projekt");

  $this->CheckColumn("intraship_enabled","tinyint(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("intraship_drucker","INT(11)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("intraship_testmode","tinyint(1)","projekt","DEFAULT '0' NOT NULL");
  $this->CheckColumn("intraship_user","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_signature","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_ekp","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_api_user","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_api_password","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_company_name","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_street_name","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_street_number","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_zip","varchar(12)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_country","varchar(64)","projekt","DEFAULT 'germany' NOT NULL");
  $this->CheckColumn("intraship_city","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_email","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_phone","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_internet","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_contact_person","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_account_owner","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_account_number","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_bank_code","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_bank_name","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_iban","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_bic","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("intraship_exportgrund","varchar(64)","projekt","DEFAULT '' NOT NULL");

  $this->CheckColumn("intraship_WeightInKG","INT(11)","projekt","DEFAULT '5' NOT NULL");
  $this->CheckColumn("intraship_LengthInCM","INT(11)","projekt","DEFAULT '50' NOT NULL");
  $this->CheckColumn("intraship_WidthInCM","INT(11)","projekt","DEFAULT '50' NOT NULL");
  $this->CheckColumn("intraship_HeightInCM","INT(11)","projekt","DEFAULT '50' NOT NULL");
  $this->CheckColumn("intraship_PackageType","VARCHAR(8)","projekt","DEFAULT 'PL' NOT NULL");

  $this->CheckColumn("billsafe_merchantId","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("billsafe_merchantLicenseSandbox","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("billsafe_merchantLicenseLive","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("billsafe_applicationSignature","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("billsafe_applicationVersion","varchar(64)","projekt","DEFAULT '' NOT NULL");

  $this->CheckColumn("secupay_apikey","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("secupay_url","varchar(64)","projekt","DEFAULT '' NOT NULL");
  $this->CheckColumn("secupay_demo","tinyint(1)","projekt","DEFAULT 0 NOT NULL");
  
  $this->CheckColumn("abrechnungsart","varchar(255)","projekt");
  $this->CheckColumn("kommissionierverfahren","varchar(255)","projekt");
  $this->CheckColumn("wechselaufeinstufig","int(11)","projekt");
  $this->CheckColumn("projektuebergreifendkommisionieren","int(1)","projekt");
  $this->CheckColumn("absendeadresse","varchar(255)","projekt");
  $this->CheckColumn("absendename","varchar(255)","projekt");
  $this->CheckColumn("absendesignatur","varchar(255)","projekt");
  $this->CheckColumn("autodruckrechnung","int(1)","projekt");
  $this->CheckColumn("autodruckversandbestaetigung","int(1)","projekt");
  $this->CheckColumn("automailversandbestaetigung","int(1)","projekt");
  $this->CheckColumn("autodrucklieferschein","int(1)","projekt");
  $this->CheckColumn("automaillieferschein","int(1)","projekt");
  $this->CheckColumn("autodruckstorno","int(1)","projekt");
  $this->CheckColumn("autodruckanhang","int(1)","projekt");
  $this->CheckColumn("automailanhang","int(1)","projekt");

  $this->CheckColumn("autodruckerrechnung","int(11)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("autodruckerlieferschein","int(11)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("autodruckeranhang","int(11)","projekt","DEFAULT '1' NOT NULL");

  $this->CheckColumn("autodruckrechnungmenge","int(11)","projekt","DEFAULT '1' NOT NULL");
  $this->CheckColumn("autodrucklieferscheinmenge","int(11)","projekt","DEFAULT '1' NOT NULL");

  $this->CheckColumn("stornorechnung","int(1)","gutschrift");
  $this->CheckColumn("startseite","int(1)","aufgabe");
  $this->CheckColumn("oeffentlich","int(1)","aufgabe");
  $this->CheckColumn("zeiterfassung_pflicht","tinyint(1)","aufgabe","DEFAULT '0' NOT NULL");
  $this->CheckColumn("zeiterfassung_abrechnung","tinyint(1)","aufgabe","DEFAULT '0' NOT NULL");
  $this->CheckColumn("emailerinnerung","int(1)","aufgabe");
  $this->CheckColumn("emailerinnerung_tage","int(11)","aufgabe");
  $this->CheckColumn("kunde","int(11)","aufgabe");

  $this->CheckColumn("note_x","int(11)","aufgabe");
  $this->CheckColumn("note_y","int(11)","aufgabe");
  $this->CheckColumn("note_z","int(11)","aufgabe");
  $this->CheckColumn("note_color","VARCHAR(255)","aufgabe");
  $this->CheckColumn("pinwand","int(1)","aufgabe");
  $this->CheckColumn("pinwand_id","int(11)","aufgabe","DEFAULT '0' NOT NULL");

  $this->CheckColumn("vorankuendigung","int(11)","aufgabe");
  $this->CheckColumn("status","varchar(255)","aufgabe");

  $this->CheckColumn("sort","int(11)","aufgabe");

  $this->CheckColumn("angebotid","int(11)","auftrag");
  $this->CheckColumn("internetseite","text","adresse");
  $this->CheckColumn("anlass","text","reisekosten");
  $this->CheckColumn("von","DATE","reisekosten");
  $this->CheckColumn("bis","DATE","reisekosten");
  $this->CheckColumn("von_zeit","varchar(255)","reisekosten");
  $this->CheckColumn("bis_zeit","varchar(255)","reisekosten");

  $this->CheckColumn("name","varchar(255)","inventur");
  $this->CheckColumn("name","varchar(255)","anfrage");
  $this->CheckColumn("typ","varchar(16)","anfrage");
  $this->CheckColumn("geliefert","int(11)","anfrage_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("vpe","varchar(255)","anfrage_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("einheit","varchar(255)","anfrage_position","DEFAULT '' NOT NULL");
  $this->CheckColumn("lieferdatum","date","anfrage_position");
  $this->CheckColumn("bearbeiterid","int(1)","anfrage","NOT NULL");

  $this->CheckColumn("lieferdatumkw","tinyint(1)","anfrage_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lieferdatumkw","tinyint(1)","angebot_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lieferdatumkw","tinyint(1)","auftrag_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lieferdatumkw","tinyint(1)","rechnung_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lieferdatumkw","tinyint(1)","gutschrift_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lieferdatumkw","tinyint(1)","lieferschein_position","DEFAULT '0' NOT NULL");

  $this->CheckColumn("lieferdatumkw","tinyint(1)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("lieferdatumkw","tinyint(1)","auftrag","DEFAULT '0' NOT NULL");

  $this->CheckColumn("auftrag_position_id","INT(11)","lieferschein_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("auftrag_position_id","INT(11)","rechnung_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("auftrag_position_id","INT(11)","gutschrift_position","DEFAULT '0' NOT NULL");
 

  $this->CheckColumn("schreibschutz","int(1)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schreibschutz","int(1)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schreibschutz","int(1)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schreibschutz","int(1)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schreibschutz","int(1)","bestellung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schreibschutz","int(1)","lieferschein","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schreibschutz","int(1)","arbeitsnachweis","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schreibschutz","int(1)","reisekosten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schreibschutz","int(1)","inventur","DEFAULT '0' NOT NULL");
  $this->CheckColumn("schreibschutz","int(1)","anfrage","DEFAULT '0' NOT NULL");


  $this->CheckColumn("pdfarchiviert","int(1)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviert","int(1)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviert","int(1)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviert","int(1)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviert","int(1)","bestellung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviert","int(1)","lieferschein","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviert","int(1)","arbeitsnachweis","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviert","int(1)","reisekosten","DEFAULT '0' NOT NULL");

  $this->CheckColumn("pdfarchiviertversion","int(11)","rechnung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviertversion","int(11)","gutschrift","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviertversion","int(11)","angebot","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviertversion","int(11)","auftrag","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviertversion","int(11)","bestellung","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviertversion","int(11)","lieferschein","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviertversion","int(11)","arbeitsnachweis","DEFAULT '0' NOT NULL");
  $this->CheckColumn("pdfarchiviertversion","int(11)","reisekosten","DEFAULT '0' NOT NULL");

  $this->CheckColumn("typ","varchar(255)","rechnung","DEFAULT 'firma' NOT NULL");
  $this->CheckColumn("typ","varchar(255)","gutschrift","DEFAULT 'firma' NOT NULL");
  $this->CheckColumn("typ","varchar(255)","angebot","DEFAULT 'firma' NOT NULL");
  $this->CheckColumn("typ","varchar(255)","auftrag","DEFAULT 'firma' NOT NULL");
  $this->CheckColumn("typ","varchar(255)","bestellung","DEFAULT 'firma' NOT NULL");
  $this->CheckColumn("typ","varchar(255)","lieferschein","DEFAULT 'firma' NOT NULL");
  $this->CheckColumn("typ","varchar(255)","arbeitsnachweis","DEFAULT 'firma' NOT NULL");
  $this->CheckColumn("typ","varchar(255)","reisekosten","DEFAULT 'firma' NOT NULL");

  $this->CheckColumn("verbindlichkeiteninfo","varchar(255)","bestellung","DEFAULT '' NOT NULL");
  $this->CheckColumn("beschreibung","varchar(255)","abrechnungsartikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("dokument","varchar(64)","abrechnungsartikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("preisart","varchar(64)","abrechnungsartikel","DEFAULT '' NOT NULL");


  $this->CheckColumn("beschreibung_de","text","artikelgruppen");
  $this->CheckColumn("beschreibung_en","text","artikelgruppen");

  $this->CheckColumn("internebemerkung","text","gutschrift");
  $this->CheckColumn("internebemerkung","text","rechnung");
  $this->CheckColumn("internebemerkung","text","lieferschein");

  $this->CheckColumn("ohne_briefpapier","int(1)","rechnung");
  $this->CheckColumn("ohne_briefpapier","int(1)","lieferschein");
  $this->CheckColumn("ohne_briefpapier","int(1)","angebot");
  $this->CheckColumn("ohne_briefpapier","int(1)","auftrag");
  $this->CheckColumn("ohne_briefpapier","int(1)","bestellung");
  $this->CheckColumn("ohne_briefpapier","int(1)","gutschrift");


  $this->CheckColumn("projekt","int(11)","firmendaten");
  $this->CheckColumn("externereinkauf","int(1)","firmendaten");
  $this->CheckColumn("schriftart","varchar(255)","firmendaten");
  $this->CheckColumn("knickfalz","int(1)","firmendaten");
  $this->CheckColumn("artikeleinheit","int(1)","firmendaten");
  $this->CheckColumn("artikeleinheit_standard","varchar(255)","firmendaten");

  $this->CheckColumn("abstand_name_beschreibung","int(11)","firmendaten"," DEFAULT '4' NOT NULL");
  $this->CheckColumn("abstand_boxrechtsoben_lr","int(11)","firmendaten"," DEFAULT '0' NOT NULL");
  $this->CheckColumn("abstand_gesamtsumme_lr","int(11)","firmendaten"," DEFAULT '100' NOT NULL");

  $this->CheckColumn("zahlungsweise","varchar(255)","firmendaten","NOT NULL");
  $this->CheckColumn("zahlungszieltage","int(11)","firmendaten","DEFAULT '14' NOT NULL");
  $this->CheckColumn("zahlungszielskonto","int(11)","firmendaten","NOT NULL");
  $this->CheckColumn("zahlungszieltageskonto","int(11)","firmendaten","NOT NULL");

  $this->CheckColumn("zahlung_rechnung","int(1)","firmendaten"," DEFAULT '1' NOT NULL");
  $this->CheckColumn("zahlung_vorkasse","int(1)","firmendaten"," DEFAULT '1' NOT NULL");
  $this->CheckColumn("zahlung_nachnahme","int(1)","firmendaten"," DEFAULT '1' NOT NULL");
  $this->CheckColumn("zahlung_kreditkarte","int(1)","firmendaten","DEFAULT '1' NOT NULL");
  $this->CheckColumn("zahlung_einzugsermaechtigung","int(1)","DEFAULT '1' firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_paypal","int(1)","firmendaten","DEFAULT '1' NOT NULL");
  $this->CheckColumn("zahlung_bar","int(1)","firmendaten","DEFAULT '1' NOT NULL");
  $this->CheckColumn("zahlung_lastschrift","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("zahlung_amazon","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("zahlung_amazon_bestellung","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("zahlung_billsafe","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("zahlung_sofortueberweisung","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("zahlung_ratenzahlung","int(1)","firmendaten"," DEFAULT '1' NOT NULL");
  $this->CheckColumn("zahlung_secupay","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("zahlung_eckarte","int(1)","firmendaten","DEFAULT '0' NOT NULL");

  $this->CheckColumn("zahlung_rechnung_sofort_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_rechnung_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_vorkasse_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_lastschrift_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_nachnahme_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_bar_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_paypal_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_amazon_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_amazon_bestellung_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_billsafe_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_sofortueberweisung_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_kreditkarte_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_ratenzahlung_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_secupay_de","text","firmendaten","NOT NULL");
  $this->CheckColumn("zahlung_eckarte_de","text","firmendaten","NOT NULL");

  $this->CheckColumn("briefpapier2","longblob","firmendaten");
  $this->CheckColumn("briefpapier2vorhanden","int(1)","firmendaten");




  $this->CheckColumn("zahlungsmailcounter","int(1)","auftrag");

  $this->CheckColumn("ansprechpartner","varchar(255)","angebot");
  $this->CheckColumn("mobil","varchar(255)","ansprechpartner");


  $this->CheckTable("event_api");
  $this->CheckColumn("id","int(11)","event_api","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("cachetime","timestamp","event_api");
  $this->CheckColumn("eventname","varchar(255)","event_api");
  $this->CheckColumn("parameter","varchar(255)","event_api");
  $this->CheckColumn("module","varchar(255)","event_api");
  $this->CheckColumn("action","varchar(255)","event_api");
  $this->CheckColumn("retries","int(11)","event_api");
  $this->CheckColumn("kommentar","varchar(255)","event_api");


  $this->CheckTable("gpsstechuhr");
  $this->CheckColumn("id","int(11)","gpsstechuhr","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("adresse","int(11)","gpsstechuhr");
  $this->CheckColumn("user","int(11)","gpsstechuhr");
  $this->CheckColumn("koordinaten","varchar(512)","gpsstechuhr");
  $this->CheckColumn("zeit","datetime","gpsstechuhr");

  $this->CheckTable("kostenstellen");
  $this->CheckColumn("id","int(11)","kostenstellen","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("nummer","varchar(20)","kostenstellen");
  $this->CheckColumn("beschreibung","varchar(512)","kostenstellen");
  $this->CheckColumn("internebemerkung","text","kostenstellen");

  $this->CheckTable("lager_mindesthaltbarkeitsdatum");
  $this->CheckColumn("id","int(11)","lager_mindesthaltbarkeitsdatum","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("datum","DATE","lager_mindesthaltbarkeitsdatum");
  $this->CheckColumn("mhddatum","DATE","lager_mindesthaltbarkeitsdatum");
  $this->CheckColumn("artikel","int(11)","lager_mindesthaltbarkeitsdatum");
  $this->CheckColumn("menge","DECIMAL(10,4)","lager_mindesthaltbarkeitsdatum");
  $this->CheckColumn("lager_platz","int(11)","lager_mindesthaltbarkeitsdatum");
  $this->CheckColumn("zwischenlagerid","int(11)","lager_mindesthaltbarkeitsdatum");
  $this->CheckColumn("charge","varchar(1024)","lager_mindesthaltbarkeitsdatum");
  $this->CheckColumn("internebemerkung","text","lager_mindesthaltbarkeitsdatum");

  $this->CheckTable("lager_charge");
  $this->CheckColumn("id","int(11)","lager_charge","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("charge","varchar(1024)","lager_charge");
  $this->CheckColumn("datum","DATE","lager_charge");
  $this->CheckColumn("artikel","int(11)","lager_charge");
  $this->CheckColumn("menge","DECIMAL(10,4)","lager_charge");
  $this->CheckColumn("lager_platz","int(11)","lager_charge");
  $this->CheckColumn("zwischenlagerid","int(11)","lager_charge");
  $this->CheckColumn("internebemerkung","text","lager_charge");

  $this->CheckTable("lager_differenzen");
  $this->CheckColumn("id","int(11)","lager_differenzen","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("artikel","int(11)","lager_differenzen");
  $this->CheckColumn("eingang","DECIMAL(10,4)","lager_differenzen");
  $this->CheckColumn("ausgang","DECIMAL(10,4)","lager_differenzen");
  $this->CheckColumn("berechnet","DECIMAL(10,4)","lager_differenzen");
  $this->CheckColumn("bestand","DECIMAL(10,4)","lager_differenzen");
  $this->CheckColumn("differenz","DECIMAL(10,4)","lager_differenzen");
  $this->CheckColumn("user","int(11)","lager_differenzen");
  $this->CheckColumn("lager_platz","int(11)","lager_differenzen");



  $this->CheckTable("adresse_import");
  $this->CheckColumn("id","int(11)","adresse_import","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("typ","varchar(20)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("name","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("ansprechpartner","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("abteilung","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("unterabteilung","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("adresszusatz","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("strasse","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("plz","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("ort","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("land","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("telefon","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("telefax","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("email","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("mobil","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("internetseite","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("ustid","varchar(255)","adresse_import","DEFAULT '' NOT NULL");
  $this->CheckColumn("user","INT(11)","adresse_import","DEFAULT '0' NOT NULL");
  $this->CheckColumn("adresse","INT(11)","adresse_import","DEFAULT '0' NOT NULL");
  $this->CheckColumn("angelegt_am","DATETIME","adresse_import");
  $this->CheckColumn("abgeschlossen","tinyint(1)","adresse_import","DEFAULT '0' NOT NULL");

  $this->CheckTable("berichte");
  $this->CheckColumn("id","int(11)","berichte","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("name","varchar(20)","berichte");
  $this->CheckColumn("beschreibung","text","berichte");
  $this->CheckColumn("internebemerkung","text","berichte");
  $this->CheckColumn("struktur","text","berichte");
  $this->CheckColumn("spaltennamen","varchar(1024)","berichte");
  $this->CheckColumn("spaltenbreite","varchar(1024)","berichte");
  $this->CheckColumn("spaltenausrichtung","varchar(1024)","berichte");
  
  
  $this->CheckTable("wiedervorlage");
  $this->CheckColumn("id","int(11)","wiedervorlage","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("adresse","int(11)","wiedervorlage","DEFAULT '0' NOT NULL");
  $this->CheckColumn("bearbeiter","int(11)","wiedervorlage","DEFAULT '0' NOT NULL");
  $this->CheckColumn("projekt","int(11)","wiedervorlage","DEFAULT '0' NOT NULL");
  $this->CheckColumn("adresse_mitarbeiter","int(11)","wiedervorlage","DEFAULT '0' NOT NULL");
  $this->CheckColumn("bezeichnung","varchar(255)","wiedervorlage","DEFAULT '' NOT NULL");
  $this->CheckColumn("beschreibung","text","wiedervorlage","DEFAULT '' NOT NULL");
  $this->CheckColumn("ergebnis","text","wiedervorlage","DEFAULT '' NOT NULL");
  $this->CheckColumn("betrag","DECIMAL(10,2)","wiedervorlage", "NOT NULL DEFAULT '0'");
  $this->CheckColumn("datum_angelegt","DATE", "wiedervorlage");
  $this->CheckColumn("zeit_angelegt","TIME", "wiedervorlage");
  $this->CheckColumn("datum_erinnerung","DATE","wiedervorlage");
  $this->CheckColumn("zeit_erinnerung","TIME","wiedervorlage");
  $this->CheckColumn("erinnerung_per_mail","int(1)","wiedervorlage");
  $this->CheckColumn("erinnerung_empfaenger","TEXT","wiedervorlage");
  $this->CheckColumn("link","TEXT","wiedervorlage");
  $this->CheckColumn("module","varchar(255)","wiedervorlage", "NOT NULL DEFAULT ''");
  $this->CheckColumn("action","varchar(255)","wiedervorlage", "NOT NULL DEFAULT ''");
  $this->CheckColumn("parameter","int(11)","wiedervorlage", "NOT NULL DEFAULT '0'");
  $this->CheckColumn("oeffentlich","tinyint(1)","wiedervorlage", "NOT NULL DEFAULT '0'");
  $this->CheckColumn("status","varchar(255)","wiedervorlage", "NOT NULL DEFAULT ''");
  $this->CheckColumn("abgeschlossen","tinyint(1)","wiedervorlage", "NOT NULL DEFAULT '0'");

  $this->CheckTable("wiedervorlage_protokoll");
  $this->CheckColumn("id","int(11)","wiedervorlage_protokoll","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("vorgaengerid","int(11)","wiedervorlage_protokoll");
  $this->CheckColumn("wiedervorlageid","int(11)","wiedervorlage_protokoll");
  $this->CheckColumn("adresse_mitarbeiter","int(11)","wiedervorlage_protokoll","DEFAULT '0' NOT NULL");
  $this->CheckColumn("erinnerung_alt","DATETIME","wiedervorlage_protokoll");
  $this->CheckColumn("erinnerung_neu","DATETIME","wiedervorlage_protokoll");
  $this->CheckColumn("bezeichnung","varchar(255)","wiedervorlage_protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("beschreibung","text","wiedervorlage_protokoll","DEFAULT '' NOT NULL");
  $this->CheckColumn("ergebnis","text","wiedervorlage_protokoll","DEFAULT '' NOT NULL");


  $this->CheckTable("verrechnungsart");
  $this->CheckColumn("id","int(11)","verrechnungsart","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("nummer","varchar(20)","verrechnungsart");
  $this->CheckColumn("beschreibung","varchar(512)","verrechnungsart");
  $this->CheckColumn("internebemerkung","text","verrechnungsart");

  $this->CheckTable("gruppen");
  $this->CheckColumn("id","int(11)","gruppen","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("name","varchar(512)","gruppen");
  $this->CheckColumn("art","varchar(512)","gruppen");
  $this->CheckColumn("kennziffer","VARCHAR(255)","gruppen");
  $this->CheckColumn("internebemerkung","text","gruppen");
  $this->CheckColumn("grundrabatt","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("rabatt1","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("rabatt2","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("rabatt3","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("rabatt4","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("rabatt5","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("sonderrabatt_skonto","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("provision","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("kundennummer","VARCHAR(255)","gruppen");
  $this->CheckColumn("partnerid","VARCHAR(255)","gruppen");
  $this->CheckColumn("dta_aktiv","TINYINT(1)","gruppen","DEFAULT '0' NOT NULL");
  $this->CheckColumn("dta_periode","TINYINT(2)","gruppen","DEFAULT '0' NOT NULL");
  $this->CheckColumn("dta_dateiname","VARCHAR(255)","gruppen","DEFAULT '' NOT NULL");
  $this->CheckColumn("dta_mail","VARCHAR(255)","gruppen","DEFAULT '' NOT NULL");
  $this->CheckColumn("dta_mail_betreff","VARCHAR(255)","gruppen","DEFAULT '' NOT NULL");
  $this->CheckColumn("dta_mail_text","TEXT","gruppen","DEFAULT '' NOT NULL");
  $this->CheckColumn("dtavariablen","TEXT","gruppen","DEFAULT '' NOT NULL");
  $this->CheckColumn("dta_variante","INT(11)","gruppen","DEFAULT '0' NOT NULL");
  $this->CheckColumn("projekt","INT(11)","gruppen","DEFAULT '0' NOT NULL");

  $this->CheckColumn("bonus1","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus1_ab","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus2","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus2_ab","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus3","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus3_ab","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus4","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus4_ab","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus5","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus5_ab","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus6","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus6_ab","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus7","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus7_ab","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus8","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus8_ab","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus9","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus9_ab","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus10","DECIMAL(10,2)","gruppen");
  $this->CheckColumn("bonus10_ab","DECIMAL(10,2)","gruppen");

  $this->CheckColumn("bonus1","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus1_ab","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus2","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus2_ab","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus3","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus3_ab","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus4","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus4_ab","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus5","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus5_ab","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus6","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus6_ab","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus7","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus7_ab","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus8","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus8_ab","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus9","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus9_ab","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus10","DECIMAL(10,2)","adresse");
  $this->CheckColumn("bonus10_ab","DECIMAL(10,2)","adresse");



  $this->CheckColumn("zahlungszieltage","int(11)","gruppen","DEFAULT '14' NOT NULL");
  $this->CheckColumn("zahlungszielskonto","DECIMAL(10,2)","gruppen","NOT NULL");
  $this->CheckColumn("zahlungszieltageskonto","int(11)","gruppen","NOT NULL");

  $this->CheckColumn("portoartikel","int(11)","gruppen");
  $this->CheckColumn("portofreiab","DECIMAL(10,2)","gruppen","DEFAULT '0' NOT NULL");

  $this->CheckColumn("erweiterteoptionen","INT(1)","gruppen");
  $this->CheckColumn("zentralerechnung","INT(1)","gruppen");
  $this->CheckColumn("zentralregulierung","INT(1)","gruppen");
  $this->CheckColumn("gruppe","INT(1)","gruppen");
  $this->CheckColumn("preisgruppe","INT(1)","gruppen");
  $this->CheckColumn("verbandsgruppe","INT(1)","gruppen");

  $this->CheckColumn("rechnung_name","VARCHAR(255)","gruppen");
  $this->CheckColumn("rechnung_strasse","VARCHAR(255)","gruppen");
  $this->CheckColumn("rechnung_ort","VARCHAR(255)","gruppen");
  $this->CheckColumn("rechnung_plz","VARCHAR(255)","gruppen");
  $this->CheckColumn("rechnung_abteilung","VARCHAR(255)","gruppen");
  $this->CheckColumn("rechnung_land","VARCHAR(255)","gruppen");
  $this->CheckColumn("rechnung_email","VARCHAR(255)","gruppen");

  $this->CheckColumn("rechnung_periode","int(11)","adresse");
  $this->CheckColumn("rechnung_anzahlpapier","int(11)","adresse");
  $this->CheckColumn("rechnung_permail","int(1)","adresse");
  $this->CheckColumn("rechnung_email","varchar(255)","adresse");

  $this->CheckColumn("rechnung_periode","int(11)","gruppen");
  $this->CheckColumn("rechnung_anzahlpapier","int(11)","gruppen");
  $this->CheckColumn("rechnung_permail","int(1)","gruppen");

  $this->CheckColumn("webid","int(11)","gruppen");
  $this->CheckColumn("webid","int(11)","artikel");
  $this->CheckColumn("webid","VARCHAR(1024)","auftrag_position");

  $this->CheckTable("reisekostenart");
  $this->CheckColumn("id","int(11)","reisekostenart","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("nummer","varchar(20)","reisekostenart");
  $this->CheckColumn("beschreibung","varchar(512)","reisekostenart");
  $this->CheckColumn("internebemerkung","text","reisekostenart");


  $this->CheckTable("artikeleinheit");
  $this->CheckColumn("id","int(11)","artikeleinheit","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("einheit_de","varchar(255)","artikeleinheit");
  $this->CheckColumn("internebemerkung","text","artikeleinheit");

  $this->CheckTable("importvorlage_log");
  $this->CheckColumn("id","int(11)","importvorlage_log","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("importvorlage","int(11)","importvorlage_log"); 
  $this->CheckColumn("zeitstempel","TIMESTAMP","importvorlage_log");
  $this->CheckColumn("user","int(11)","importvorlage_log"); 
  $this->CheckColumn("tabelle","varchar(255)","importvorlage_log");
  $this->CheckColumn("datensatz","int(11)","importvorlage_log");
  $this->CheckColumn("ersterdatensatz","tinyint(1)","importvorlage_log","DEFAULT '0' NOT NULL");




  $this->CheckTable("importvorlage");
  $this->CheckColumn("id","int(11)","importvorlage","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("bezeichnung","varchar(255)","importvorlage");
  $this->CheckColumn("ziel","varchar(255)","importvorlage");
  $this->CheckColumn("internebemerkung","text","importvorlage");
  $this->CheckColumn("fields","text","importvorlage");
  $this->CheckColumn("letzterimport","datetime","importvorlage");
  $this->CheckColumn("mitarbeiterletzterimport","varchar(255)","importvorlage");
  $this->CheckColumn("importtrennzeichen","varchar(255)","importvorlage");        
  $this->CheckColumn("importerstezeilenummer","int(11)","importvorlage"); 
  $this->CheckColumn("importdatenmaskierung","varchar(255)","importvorlage");     
  $this->CheckColumn("importzeichensatz","varchar(255)","importvorlage"); 
  $this->CheckColumn("utf8decode","tinyint(1)","importvorlage","DEFAULT '1' NOT NULL"); 
  $this->CheckColumn("charset","varchar(32)","importvorlage","DEFAULT 'UTF8' NOT NULL"); 


  $this->CheckTable("exportvorlage");
  $this->CheckColumn("id","int(11)","exportvorlage","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("bezeichnung","varchar(255)","exportvorlage");
  $this->CheckColumn("ziel","varchar(255)","exportvorlage");
  $this->CheckColumn("internebemerkung","text","exportvorlage");
  $this->CheckColumn("fields","text","exportvorlage");
  $this->CheckColumn("fields_where","text","exportvorlage");
  $this->CheckColumn("letzterexport","datetime","exportvorlage");
  $this->CheckColumn("mitarbeiterletzterexport","varchar(255)","exportvorlage");
  $this->CheckColumn("exporttrennzeichen","varchar(255)","exportvorlage");        
  $this->CheckColumn("exporterstezeilenummer","int(11)","exportvorlage"); 
  $this->CheckColumn("exportdatenmaskierung","varchar(255)","exportvorlage");     
  $this->CheckColumn("exportzeichensatz","varchar(255)","exportvorlage"); 
  $this->CheckColumn("filterdatum","tinyint(1)","exportvorlage","DEFAULT '0' NOT NULL"); 
  $this->CheckColumn("filterprojekt","tinyint(1)","exportvorlage","DEFAULT '0' NOT NULL"); 
  $this->CheckColumn("apifreigabe","tinyint(1)","exportvorlage","DEFAULT '0' NOT NULL"); 


  // accordion
  $this->CheckTable("accordion");
  $this->CheckColumn("id","int(11)","accordion");
  $this->CheckColumn("name","varchar(255)","accordion");
  $this->CheckColumn("target","varchar(255)","accordion");
  $this->CheckColumn("position","int(2)","accordion");

  //inhalt
  $this->CheckColumn("kurztext","text","inhalt");
  $this->CheckColumn("title","varchar(255)","inhalt");
  $this->CheckColumn("description","varchar(512)","inhalt");
  $this->CheckColumn("keywords","varchar(512)","inhalt");
  $this->CheckColumn("inhaltstyp","varchar(255)","inhalt");
  $this->CheckColumn("sichtbarbis","datetime","inhalt");
  $this->CheckColumn("datum","date","inhalt");
  $this->CheckColumn("template","varchar(255)","inhalt");
  $this->CheckColumn("finalparse","varchar(255)","inhalt");
  $this->CheckColumn("navigation","varchar(255)","inhalt");

  $this->CheckColumn("hwtoken","int(1)","user");
  $this->CheckColumn("hwkey","varchar(255)","user");
  $this->CheckColumn("hwcounter","int(11)","user");
  $this->CheckColumn("hwdatablock","varchar(255)","user");
  $this->CheckColumn("motppin","varchar(255)","user");
  $this->CheckColumn("motpsecret","varchar(255)","user");
  $this->CheckColumn("externlogin","int(1)","user");

  //wiki
  $this->CheckTable("wiki");
  $this->CheckColumn("name","varchar(255)","wiki");
  $this->CheckColumn("content","text","wiki");
  $this->CheckColumn("lastcontent","text","wiki");


  //tabelle backup
  $this->CheckTable("backup");
  $this->CheckColumn("adresse","int(11)","backup");
  $this->CheckColumn("name","varchar(255)","backup");
  $this->CheckColumn("dateiname","varchar(255)","backup");
  $this->CheckColumn("datum","datetime","backup");

  //Tabelle artikel_shop
  $this->CheckTable("artikel_shop");
  $this->CheckColumn("artikel","int(11)","artikel_shop");
  $this->CheckColumn("shop","int(11)","artikel_shop");
  $this->CheckColumn("checksum","text","artikel_shop");

  // Tabelle dokumente
  $this->CheckTable("dokumente");
  $this->CheckColumn("id","int(11)","dokumente");
  $this->CheckColumn("adresse_from","int(11)","dokumente");
  $this->CheckColumn("adresse_to","int(11)","dokumente");
  $this->CheckColumn("typ","varchar(24)","dokumente");
  $this->CheckColumn("von","varchar(512)","dokumente");
  $this->CheckColumn("firma","varchar(512)","dokumente");
  $this->CheckColumn("ansprechpartner","varchar(512)","dokumente");
  $this->CheckColumn("an","varchar(512)","dokumente");
  $this->CheckColumn("email_an","varchar(255)","dokumente");
  $this->CheckColumn("email_cc","varchar(255)","dokumente");
  $this->CheckColumn("email_bcc","varchar(255)","dokumente");
  $this->CheckColumn("firma_an","varchar(255)","dokumente");
  $this->CheckColumn("adresse","varchar(255)","dokumente");
  $this->CheckColumn("plz","varchar(16)","dokumente");
  $this->CheckColumn("ort","varchar(255)","dokumente");
  $this->CheckColumn("land","varchar(32)","dokumente");
  $this->CheckColumn("datum","date","dokumente");
  $this->CheckColumn("betreff","varchar(1023)","dokumente");
  $this->CheckColumn("content","text","dokumente");
  $this->CheckColumn("signatur","tinyint(1)","dokumente");
  $this->CheckColumn("send_as","varchar(24)","dokumente");
  $this->CheckColumn("email","varchar(255)","dokumente");
  $this->CheckColumn("printer","int(2)","dokumente");
  $this->CheckColumn("fax","int(2)","dokumente");
  $this->CheckColumn("sent","int(1)","dokumente");
  $this->CheckColumn("deleted","int(1)","dokumente");
  $this->CheckColumn("created","datetime","dokumente");
  $this->CheckColumn("bearbeiter","varchar(128)","dokumente");
  $this->CheckColumn("uhrzeit","time","dokumente");


  // Tabelle linkeditor
  $this->CheckTable("linkeditor");
  $this->CheckColumn("id","int(4)","linkeditor");
  $this->CheckColumn("rule","varchar(1024)","linkeditor");
  $this->CheckColumn("replacewith","varchar(1024)","linkeditor");
  $this->CheckColumn("active","varchar(1)","linkeditor");


  // Tabelle userrights
  $this->CheckTable("userrights");
  $this->CheckColumn("id","int(11)","userrights");
  $this->CheckColumn("user","int(11)","userrights");
  $this->CheckColumn("module","varchar(64)","userrights");
  $this->CheckColumn("action","varchar(64)","userrights");
  $this->CheckColumn("permission","int(1)","userrights");


  // Tabelle userrights
  $this->CheckTable("uservorlagerights");
  $this->CheckColumn("id","int(11)","uservorlagerights","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("vorlage","int(11)","uservorlagerights");
  $this->CheckColumn("module","varchar(64)","uservorlagerights");
  $this->CheckColumn("action","varchar(64)","uservorlagerights");
  $this->CheckColumn("permission","int(1)","uservorlagerights");

  // Tabelle userrights
  $this->CheckTable("uservorlage");
  $this->CheckColumn("id","int(11)","uservorlage","DEFAULT '0' NOT NULL AUTO_INCREMENT");
  $this->CheckColumn("bezeichnung","VARCHAR(255)","uservorlage");
  $this->CheckColumn("beschreibung","TEXT","uservorlage");



  $this->CheckTable("newsletter_blacklist");
  $this->CheckColumn("email","varchar(255)","newsletter_blacklist");

  // Tabelle artikel
  $this->CheckColumn("herstellernummer","varchar(255)","artikel");
  $this->CheckColumn("restmenge","int(1)","artikel");
  $this->CheckColumn("lieferzeitmanuell_en","varchar(255)","artikel");
  $this->CheckColumn("variante","int(1)","artikel");
  $this->CheckColumn("variante_von","int(11)","artikel");
  
  $this->CheckColumn("downloadartikel","tinyint(1)", "artikel","DEFAULT '0' NOT NULL");
  
  $this->CheckColumn("matrixprodukt","tinyint(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("generierenummerbeioption","tinyint(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("allelieferanten","tinyint(1)","artikel","DEFAULT '0' NOT NULL");
  

  //firmendaten
  $this->CheckColumn("email","varchar(255)","firmendaten");
  $this->CheckColumn("absendername","varchar(255)","firmendaten");
  $this->CheckColumn("bcc1","varchar(255)","firmendaten");
  $this->CheckColumn("bcc2","varchar(255)","firmendaten");
  $this->CheckColumn("firmenfarbe","varchar(255)","firmendaten");
  $this->CheckColumn("name","varchar(255)","firmendaten");
  $this->CheckColumn("strasse","varchar(255)","firmendaten");
  $this->CheckColumn("plz","varchar(255)","firmendaten");
  $this->CheckColumn("ort","varchar(255)","firmendaten");
  $this->CheckColumn("steuernummer","varchar(255)","firmendaten");
  $this->CheckColumn("brieftext","varchar(255)","firmendaten");
  $this->CheckColumn("startseite_wiki","varchar(255)","firmendaten");
  $this->CheckColumn("artikel_suche_kurztext","int(1)","firmendaten");
  $this->CheckColumn("artikel_bilder_uebersicht","tinyint(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("adresse_freitext1_suche","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("iconset_dunkel","tinyint(1)","firmendaten","DEFAULT '0' NOT NULL");

  $this->CheckColumn("eigenernummernkreis","int(11)","projekt");
  $this->CheckColumn("next_angebot","varchar(255)","projekt");
  $this->CheckColumn("next_auftrag","varchar(255)","projekt");
  $this->CheckColumn("next_rechnung","varchar(255)","projekt");
  $this->CheckColumn("next_lieferschein","varchar(255)","projekt");
  $this->CheckColumn("next_arbeitsnachweis","varchar(255)","projekt");
  $this->CheckColumn("next_reisekosten","varchar(255)","projekt");
  $this->CheckColumn("next_bestellung","varchar(255)","projekt");
  $this->CheckColumn("next_gutschrift","varchar(255)","projekt");
  $this->CheckColumn("next_kundennummer","varchar(255)","projekt");
  $this->CheckColumn("next_lieferantennummer","varchar(255)","projekt");
  $this->CheckColumn("next_mitarbeiternummer","varchar(255)","projekt");
  $this->CheckColumn("next_waren","varchar(255)","projekt");
  $this->CheckColumn("next_produktion","varchar(255)","projekt");
  $this->CheckColumn("next_sonstiges","varchar(255)","projekt");
  $this->CheckColumn("next_reisekosten","varchar(255)","projekt");
  $this->CheckColumn("next_produktion","varchar(255)","projekt");
  $this->CheckColumn("next_anfrage","varchar(255)","projekt");
  $this->CheckColumn("next_artikelnummer","varchar(255)","projekt");

  $this->CheckColumn("warnung_doppelte_nummern","INT(1)","firmendaten","DEFAULT '1' NOT NULL");

  $this->CheckColumn("next_angebot","varchar(255)","firmendaten");
  $this->CheckColumn("next_auftrag","varchar(255)","firmendaten");
  $this->CheckColumn("next_rechnung","varchar(255)","firmendaten");
  $this->CheckColumn("next_lieferschein","varchar(255)","firmendaten");
  $this->CheckColumn("next_arbeitsnachweis","varchar(255)","firmendaten");
  $this->CheckColumn("next_reisekosten","varchar(255)","firmendaten");
  $this->CheckColumn("next_bestellung","varchar(255)","firmendaten");
  $this->CheckColumn("next_gutschrift","varchar(255)","firmendaten");
  $this->CheckColumn("next_kundennummer","varchar(255)","firmendaten");
  $this->CheckColumn("next_lieferantennummer","varchar(255)","firmendaten");
  $this->CheckColumn("next_mitarbeiternummer","varchar(255)","firmendaten");
  $this->CheckColumn("next_waren","varchar(255)","firmendaten");
  $this->CheckColumn("next_produktion","varchar(255)","firmendaten");
  $this->CheckColumn("next_sonstiges","varchar(255)","firmendaten");
  $this->CheckColumn("next_reisekosten","varchar(255)","firmendaten");
  $this->CheckColumn("next_produktion","varchar(255)","firmendaten");
  $this->CheckColumn("next_anfrage","varchar(255)","firmendaten");
  $this->CheckColumn("next_artikelnummer","varchar(255)","firmendaten","DEFAULT '' NOT NULL");

  $this->CheckColumn("seite_von_ausrichtung","varchar(255)","firmendaten");
  $this->CheckColumn("seite_von_sichtbar","int(1)","firmendaten");

  $this->CheckColumn("parameterundfreifelder","int(1)","firmendaten");
  $this->CheckColumn("freifeld1","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld2","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld3","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld4","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld5","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("freifeld6","text","firmendaten","DEFAULT '' NOT NULL");

  $this->CheckColumn("adressefreifeld1","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("adressefreifeld2","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("adressefreifeld3","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("adressefreifeld4","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("adressefreifeld5","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("adressefreifeld6","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("adressefreifeld7","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("adressefreifeld8","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("adressefreifeld9","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("adressefreifeld10","text","firmendaten","DEFAULT '' NOT NULL");


  $this->CheckColumn("firmenfarbehell","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("firmenfarbedunkel","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("firmenfarbeganzdunkel","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("navigationfarbe","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("navigationfarbeschrift","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("unternavigationfarbe","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("unternavigationfarbeschrift","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("firmenlogo","longblob","firmendaten");
  $this->CheckColumn("firmenlogotype","varchar(255)","firmendaten");
  $this->CheckColumn("firmenlogoaktiv","int(1)","firmendaten");

  $this->CheckColumn("projektnummerimdokument","int(1)","firmendaten");
  $this->CheckColumn("mailanstellesmtp","int(1)","firmendaten");
  $this->CheckColumn("herstellernummerimdokument","int(1)","firmendaten");
  $this->CheckColumn("standardmarge","int(11)","firmendaten");

  $this->CheckColumn("steuer_erloese_inland_normal","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_normal","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_ermaessigt","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_ermaessigt","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_steuerfrei","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_steuerfrei","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_innergemeinschaftlich","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_innergemeinschaftlich","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_eunormal","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_nichtsteuerbar","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");

  $this->CheckColumn("steuer_erloese_inland_euermaessigt","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_nichtsteuerbar","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_eunormal","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_euermaessigt","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_export","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_import","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_anpassung_kundennummer","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");


  $this->CheckColumn("steuer_erloese_inland_normal","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_normal","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_ermaessigt","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_ermaessigt","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_steuerfrei","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_steuerfrei","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_innergemeinschaftlich","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_innergemeinschaftlich","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_eunormal","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_nichtsteuerbar","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");

  $this->CheckColumn("steuer_erloese_inland_euermaessigt","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_nichtsteuerbar","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_eunormal","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_euermaessigt","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_erloese_inland_export","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_aufwendung_inland_import","VARCHAR(10)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("steuer_art_produkt","INT(1)","artikel","DEFAULT '1' NOT NULL");
  $this->CheckColumn("steuer_art_produkt_download","INT(1)","artikel","DEFAULT '1' NOT NULL");
  
  $this->CheckColumn("metadescription_de","VARCHAR(255)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("metadescription_en","VARCHAR(255)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("metakeywords_de","VARCHAR(255)","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("metakeywords_en","VARCHAR(255)","artikel","DEFAULT '' NOT NULL");


  for($ki=1;$ki<=15;$ki++)
  {
    $this->CheckColumn("steuer_art_".$ki,"VARCHAR(30)","firmendaten","DEFAULT '' NOT NULL");
    $this->CheckColumn("steuer_art_".$ki."_normal","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
    $this->CheckColumn("steuer_art_".$ki."_ermaessigt","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
    $this->CheckColumn("steuer_art_".$ki."_steuerfrei","VARCHAR(10)","firmendaten","DEFAULT '' NOT NULL");
  }

  $this->CheckColumn("rechnung_header","text","firmendaten");
  $this->CheckColumn("lieferschein_header","text","firmendaten");
  $this->CheckColumn("angebot_header","text","firmendaten");
  $this->CheckColumn("auftrag_header","text","firmendaten");
  $this->CheckColumn("rechnung_header","text","firmendaten");
  $this->CheckColumn("gutschrift_header","text","firmendaten");
  $this->CheckColumn("bestellung_header","text","firmendaten");
  $this->CheckColumn("arbeitsnachweis_header","text","firmendaten");
  $this->CheckColumn("provisionsgutschrift_header","text","firmendaten");

  $this->CheckColumn("rechnung_footer","text","firmendaten");
  $this->CheckColumn("lieferschein_footer","text","firmendaten");
  $this->CheckColumn("angebot_footer","text","firmendaten");
  $this->CheckColumn("auftrag_footer","text","firmendaten");
  $this->CheckColumn("rechnung_footer","text","firmendaten");
  $this->CheckColumn("gutschrift_footer","text","firmendaten");
  $this->CheckColumn("bestellung_footer","text","firmendaten");
  $this->CheckColumn("arbeitsnachweis_footer","text","firmendaten");
  $this->CheckColumn("provisionsgutschrift_footer","text","firmendaten");

  $this->CheckColumn("rechnung_ohnebriefpapier","int(1)","firmendaten");
  $this->CheckColumn("lieferschein_ohnebriefpapier","int(1)","firmendaten");
  $this->CheckColumn("angebot_ohnebriefpapier","int(1)","firmendaten");
  $this->CheckColumn("auftrag_ohnebriefpapier","int(1)","firmendaten");
  $this->CheckColumn("rechnung_ohnebriefpapier","int(1)","firmendaten");
  $this->CheckColumn("gutschrift_ohnebriefpapier","int(1)","firmendaten");
  $this->CheckColumn("bestellung_ohnebriefpapier","int(1)","firmendaten");
  $this->CheckColumn("arbeitsnachweis_ohnebriefpapier","int(1)","firmendaten");

  $this->CheckColumn("eu_lieferung_vermerk","text","firmendaten","DEFAULT '' NOT NULL");
  $this->CheckColumn("export_lieferung_vermerk","text","firmendaten","DEFAULT '' NOT NULL");

  $this->CheckColumn("abstand_adresszeileoben","int(11)","firmendaten");
  $this->CheckColumn("abstand_seitenrandlinks","int(11)","firmendaten","DEFAULT '15' NOT NULL");
  $this->CheckColumn("abstand_adresszeilelinks","int(11)","firmendaten","DEFAULT '15' NOT NULL");
  $this->CheckColumn("abstand_boxrechtsoben","int(11)","firmendaten");
  $this->CheckColumn("abstand_betreffzeileoben","int(11)","firmendaten");
  $this->CheckColumn("abstand_artikeltabelleoben","int(11)","firmendaten");

  $this->CheckColumn("rabatt","int(11)","angebot_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("rabatt","int(11)","rechnung_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("rabatt","int(11)","auftrag_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("rabatt","int(11)","gutschrift_position","DEFAULT '0' NOT NULL");

  $this->CheckColumn("wareneingang_kamera_waage","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("wareneingang_gross","int(1)","firmendaten","DEFAULT '0' NOT NULL");
  $this->CheckColumn("layout_iconbar","int(1)","firmendaten");

  $this->CheckColumn("artikelnummerninfotext","int(1)","bestellung");
  $this->CheckColumn("abgeschlossen","int(1)","bestellung_position");

  $this->CheckColumn("doppel","int(1)","rechnung");
  

  $this->CheckColumn("ansprechpartner","varchar(255)","bestellung");

  $this->CheckColumn("ansprechpartner","varchar(255)","lieferadressen");
  $this->CheckColumn("standardlieferadresse","tinyint(1)","lieferadressen","DEFAULT '0' NOT NULL");

  $this->CheckColumn("keinetrackingmail","int(1)","auftrag");
  $this->CheckColumn("keinetrackingmail","int(1)","versand");
  $this->CheckColumn("versandzweigeteilt","TINYINT(1)","versand","DEFAULT '0' NOT NULL");
  $this->CheckColumn("weitererlieferschein","int(1)","versand","DEFAULT '0' NOT NULL");
  $this->CheckColumn("anzahlpakete","int(11)","versand","DEFAULT '0' NOT NULL");
  $this->CheckColumn("gelesen","int(1)","versand","DEFAULT '0' NOT NULL");

  $this->CheckColumn("paketmarkegedruckt","int(1)","versand","DEFAULT '0' NOT NULL");
  $this->CheckColumn("papieregedruckt","int(1)","versand","DEFAULT '0' NOT NULL");
  
  
  $this->CheckColumn("permission","int(1)","userrights");


  // Tabelle userrights
  
  $this->CheckColumn("inventur","int(11)","lager_platz_inhalt");

  $this->CheckColumn("startseite","varchar(1024)","user");
  $this->CheckColumn("webid","varchar(1024)","adresse");
  $this->CheckColumn("titel","varchar(1024)","adresse");
  $this->CheckColumn("anschreiben","varchar(1024)","adresse");
  $this->CheckColumn("titel","varchar(1024)","ansprechpartner");
  $this->CheckColumn("anschreiben","varchar(1024)","ansprechpartner");
  $this->CheckColumn("ansprechpartner_land","varchar(255)","ansprechpartner");



  $this->CheckColumn("geloescht","int(1)","shopexport");
  $this->CheckColumn("multiprojekt","int(1)","shopexport","DEFAULT '0' NOT NULL");
  $this->CheckColumn("auftragabgleich","int(1)","shopexport","DEFAULT '0' NOT NULL");

  $this->CheckColumn("produktioninfo","text","artikel");
  $this->CheckColumn("sonderaktion","text","artikel");
  $this->CheckColumn("sonderaktion_en","text","artikel");
  $this->CheckColumn("anabregs_text","text","artikel");
  $this->CheckColumn("anabregs_text_en","text","artikel","DEFAULT '' NOT NULL");
  $this->CheckColumn("restmenge","int(1)","artikel");
  $this->CheckColumn("autobestellung","int(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("autolagerlampe","int(1)","artikel","DEFAULT '0' NOT NULL");
  $this->CheckColumn("mitarbeiter","int(11)","reisekosten_position","DEFAULT '0' NOT NULL");
  $this->CheckColumn("produktion","int(1)","artikel");
  $this->CheckColumn("herstellernummer","varchar(255)","artikel");
  $this->CheckColumn("kundenartikelnummer","varchar(255)","verkaufspreise");
  $this->CheckColumn("art","varchar(255)","verkaufspreise","DEFAULT 'Kunde' NOT NULL");
  $this->CheckColumn("gruppe","int(11)","verkaufspreise");
  $this->CheckColumn("apichange","tinyint(1)","verkaufspreise","DEFAULT '0' NOT NULL");
  $this->CheckColumn("apichange","tinyint(1)","einkaufspreise","DEFAULT '0' NOT NULL");

  $this->CheckColumn("allDay","int(1)","kalender_event");
  $this->CheckColumn("color","varchar(7)","kalender_event");

  $this->CheckColumn("ganztags","int(1)","aufgabe","DEFAULT '1' NOT NULL");
  $this->CheckColumn("abgabe_bis_zeit","TIME","aufgabe");
  $this->CheckColumn("abgabe_bis","DATE","aufgabe");
  $this->CheckColumn("email_gesendet_vorankuendigung","tinyint(1)","aufgabe","DEFAULT '0' NOT NULL");
  $this->CheckColumn("email_gesendet","tinyint(1)","aufgabe","DEFAULT '0' NOT NULL");

  // Tabelle linkeditor
  $this->CheckTable("adresse_kontakte");
  $this->CheckColumn("id","int(11)","adresse_kontakte");
  $this->CheckColumn("adresse","int(11)","adresse_kontakte");
  $this->CheckColumn("bezeichnung","varchar(1024)","adresse_kontakte");
  $this->CheckColumn("kontakt","varchar(1024)","adresse_kontakte");


  // Tabelle linkeditor
  $this->CheckTable("adresse_accounts");
  $this->CheckColumn("id","int(11)","adresse_accounts");
  $this->CheckColumn("aktiv","tinyint(1)","adresse_accounts","DEFAULT '1' NOT NULL");
  $this->CheckColumn("adresse","int(11)","adresse_accounts");
  $this->CheckColumn("bezeichnung","varchar(128)","adresse_accounts");
  $this->CheckColumn("art","varchar(128)","adresse_accounts");
  $this->CheckColumn("url","TEXT","adresse_accounts","DEFAULT '' NOT NULL");
  $this->CheckColumn("benutzername","TEXT","adresse_accounts","DEFAULT '' NOT NULL");
  $this->CheckColumn("passwort","TEXT","adresse_accounts","DEFAULT '' NOT NULL");
  $this->CheckColumn("webid","int(11)","adresse_accounts","DEFAULT '0' NOT NULL");
  $this->CheckColumn("gueltig_ab","DATE","adresse_accounts");
  $this->CheckColumn("gueltig_bis","DATE","adresse_accounts");


  $this->CheckColumn("gesamtstunden_max","int(11)","projekt");
  $this->CheckColumn("auftragid","int(11)","projekt");
  $this->CheckColumn("auftragid","int(11)","arbeitspaket");

  $this->CheckColumn("arbeitsnachweis","int(11)","zeiterfassung");
  $this->CheckColumn("nachbestelltexternereinkauf","int(1)","auftrag_position");

  $this->CheckColumn("dhlzahlungmandant","varchar(3)","projekt","NOT NULL COMMENT 'DHL Zahlungsmandant ID'");
  $this->CheckColumn("dhlretourenschein","int(1)","projekt","NOT NULL COMMENT 'Retourenschein drucken 1=ja;0=nein'");

  // Tabelle textvorlagen
  $this->CheckTable("textvorlagen");
  $this->CheckColumn("name","varchar(255)","textvorlagen");
  $this->CheckColumn("text","text","textvorlagen");
  $this->CheckColumn("stichwoerter","varchar(255)","textvorlagen");
  $this->CheckColumn("projekt","varchar(255)","textvorlagen");
  
  $this->CheckTable("module_lock");
  $this->CheckColumn("module","varchar(255)","module_lock");
  $this->CheckColumn("action","varchar(255)","module_lock");
  $this->CheckColumn("userid","int(15)","module_lock","DEFAULT '0'");
  $this->CheckColumn("salt","varchar(255)","module_lock","DEFAULT ''");
  $this->CheckColumn("zeit","timestamp","module_lock","DEFAULT CURRENT_TIMESTAMP");
 
  $this->CheckColumn("abweichendebezeichnung","tinyint(1)","angebot", "DEFAULT '0' NOT NULL");
  
  $this->CheckColumn("serienbrief","tinyint(1)","adresse","DEFAULT '0' NOT NULL");
  
  $this->CheckTable("shopimport_auftraege");
  $this->CheckColumn("shopid","int(15)","shopimport_auftraege","DEFAULT '0'");
  $this->CheckColumn("bestellnummer","varchar(255)","shopimport_auftraege","DEFAULT NULL");
  
  
  
  
  //RMA ENDE
  
  
  /*
     $this->app->DB->Select("ALTER TABLE `lieferschein_position` ADD INDEX ( `lieferschein` );");
     $this->app->DB->Select("ALTER TABLE `versand` ADD INDEX ( `lieferschein` );");
     $this->app->DB->Select("ALTER TABLE `lieferschein` ADD INDEX ( `land` );");
   */

  
  $this->app->DB->Select("ALTER TABLE `ansprechpartner` CHANGE `adresse` `adresse` INT( 10 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `aufgabe` CHANGE `stunden` `stunden` DECIMAL( 10,2 ) ");


  //$this->app->DB->Select("ALTER TABLE `adresse` ADD INDEX ( `sponsor` ) ");
  $this->app->DB->Select("ALTER TABLE `lieferschein_position` CHANGE `geliefert` `geliefert` FLOAT NOT NULL");

  $this->app->DB->Select("ALTER TABLE `auftrag_position` CHANGE `geliefert_menge` `geliefert_menge` FLOAT NOT NULL");
  $this->app->DB->Select("ALTER TABLE `zwischenlager` CHANGE `menge` `menge` FLOAT NOT NULL; ");

  $this->app->DB->Select("ALTER TABLE user ADD DEFAULT '1' FOR activ");

  $this->app->DB->Select("ALTER TABLE `einkaufspreise` CHANGE `vpe` `vpe` VARCHAR( 64 ) NOT NULL DEFAULT '1'");
  $this->app->DB->Select("ALTER TABLE `verkaufspreise` CHANGE `vpe` `vpe` VARCHAR( 64 ) NOT NULL DEFAULT '1'");

  $this->app->DB->Select("ALTER TABLE `wiki` CHANGE `content` `content` LONGTEXT NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `wiki` CHANGE `lastcontent` `content` LONGTEXT NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `lager_charge` CHANGE `menge` `menge` INT(11) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `lager_mindesthaltbarkeitsdatum` CHANGE `menge` `menge` INT(11) NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `artikel` CHANGE `mlmpunkte` `mlmpunkte` DECIMAL( 10, 2 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `artikel` CHANGE `mlmbonuspunkte` `mlmbonuspunkte` DECIMAL( 10, 2 ) NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `rechnung` CHANGE `auftrag` `auftrag` VARCHAR( 255 ) NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `artikel` CHANGE `punkte` `punkte` DECIMAL( 10, 2 ) NOT NULL ");



  $this->app->DB->Select("ALTER TABLE `artikel` CHANGE `bonuspunkte` `bonuspunkte` DECIMAL( 10, 2 ) NOT NULL ");


  $this->app->DB->Select("ALTER TABLE `angebot_position` CHANGE `rabatt` `rabatt` DECIMAL( 10, 2 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `auftrag_position` CHANGE `rabatt` `rabatt` DECIMAL( 10, 2 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `rechnung_position` CHANGE `rabatt` `rabatt` DECIMAL( 10, 2 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `gutschrift_position` CHANGE `rabatt` `rabatt` DECIMAL( 10, 2 ) NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `angebot_position` CHANGE `punkte` `punkte` DECIMAL( 10, 2 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `angebot_position` CHANGE `bonuspunkte` `bonuspunkte` DECIMAL( 10, 2 ) NOT NULL ");


  $this->app->DB->Select("ALTER TABLE `auftrag_position` CHANGE `punkte` `punkte` DECIMAL( 10, 2 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `auftrag_position` CHANGE `bonuspunkte` `bonuspunkte` DECIMAL( 10, 2 ) NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `rechnung_position` CHANGE `punkte` `punkte` DECIMAL( 10, 2 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `rechnung_position` CHANGE `bonuspunkte` `bonuspunkte` DECIMAL( 10, 2 ) NOT NULL ");


  $this->app->DB->Select("ALTER TABLE `artikel` CHANGE `webid` `webid` VARCHAR(1024) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `gruppen` CHANGE `webid` `webid` VARCHAR(1024) NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `arbeitspaket` CHANGE `zeit_geplant` `zeit_geplant` DECIMAL( 10, 2 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `projekt` CHANGE `gesamtstunden_max` `gesamtstunden_max` DECIMAL( 10, 2 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `zeiterfassung` CHANGE `kostenstelle` `kostenstelle` VARCHAR(255) NOT NULL ");
  //$this->app->DB->Select("ALTER TABLE `lager_platz_inhalt` ADD INDEX ( `artikel` , `menge` ) ;");
  //$this->app->DB->Select("ALTER TABLE `bestellung_position` ADD INDEX ( `artikel` , `menge` , `geliefert` , `status` ) ;");
  $this->app->DB->Select("ALTER TABLE `projekt` CHANGE `sonstiges` `sonstiges` TEXT NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `projekt` CHANGE `absendesignatur` `absendesignatur` TEXT NOT NULL ");


  $this->app->DB->Select("ALTER TABLE `auftrag_position` CHANGE `auftrag` `auftrag` INT( 11 ) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `auftrag_position` CHANGE `artikel` `artikel` INT( 11 ) NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `dokumente_send` CHANGE `ansprechpartner` `ansprechpartner` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `auftrag` DROP COLUMN teillieferung_von_auftrag");

  $this->app->DB->Select("ALTER TABLE `auftrag` CHANGE `zahlungszielskonto` `zahlungszielskonto` DECIMAL(10,2) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `angebot` CHANGE `zahlungszielskonto` `zahlungszielskonto` DECIMAL(10,2) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `rechnung` CHANGE `zahlungszielskonto` `zahlungszielskonto` DECIMAL(10,2) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `gutschrift` CHANGE `zahlungszielskonto` `zahlungszielskonto` DECIMAL(10,2) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `bestellung` CHANGE `zahlungszielskonto` `zahlungszielskonto` DECIMAL(10,2) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `verbindlichkeit` CHANGE `skonto` `skonto` DECIMAL(10,2) NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `auftrag` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `angebot` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `rechnung` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `lieferschein` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `gutschrift` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `bestellung` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `reisekosten` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `arbeitsnachweis` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `inventur` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `anfrage` CHANGE `belegnr` `belegnr` VARCHAR(255) NOT NULL ");

  $this->app->DB->Select("ALTER TABLE `adresse` CHANGE `kundennummer` `kundennummer` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `adresse` CHANGE `lieferantennummer` `lieferantennummer` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `adresse` CHANGE `mitarbeiternummer` `mitarbeiternummer` VARCHAR(255) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `projekt` CHANGE `beschreibung` `beschreibung` TEXT NOT NULL ");

  $this->app->DB->Select("ALTER TABLE kostenstellen DROP PRIMARY KEY, ADD PRIMARY KEY ( `id` )");
  $this->app->DB->Select("ALTER TABLE verrechnungsart DROP PRIMARY KEY, ADD PRIMARY KEY ( `id` )");

  $this->app->DB->Select("ALTER TABLE `angebot_position` CHANGE `angebot` `angebot` INT(11) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `gutschrift_position` CHANGE `gutschrift` `gutschrift` INT(11) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `rechnung_position` CHANGE `rechnung` `rechnung` INT(11) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `reisekosten_position` CHANGE `reisekosten` `reisekosten` INT(11) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `arbeitsnachweis_position` CHANGE `arbeitsnachweis` `arbeitsnachweis` INT(11) NOT NULL ");
  $this->app->DB->Select("ALTER TABLE `lager_reserviert` CHANGE `reserviertdatum` `reserviertdatum` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");



  

  $this->FirmenDatenStandard();

}



function CheckTable($table)
{
  $found = false;
  $tables = mysql_list_tables ($this->app->Conf->WFdbname); 
  while (list ($temp) = mysql_fetch_array ($tables)) {
    if ($temp == $table) {
      $found = true;
    }
  }
  if($found==false)
  {
    $sql = "CREATE TABLE `$table` (`id` INT NOT NULL AUTO_INCREMENT, PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8"; 
    $this->app->DB->Update($sql);
  }       


}

function UpdateColumn($column,$type,$table,$default="NOT NULL")
{
  //ALTER TABLE `aufgabe` CHANGE `abgabe_bis` `abgabe_bis` DATETIME NOT NULL 
  $fields = mysql_list_fields( $this->app->Conf->WFdbname, $table);
  $columns = mysql_num_fields($fields);
  for ($i = 0; $i < $columns; $i++) {$field_array[] = mysql_field_name($fields, $i);}
  if (in_array($column, $field_array))
  {
    //$result = mysqli_query($this->app->DB->connection,('ALTER TABLE '.$table.' ADD '.$column.' '.$type.' '.$default.';');
    $result = mysqli_query($this->app->DB->connection,'ALTER TABLE `'.$table.'` CHANGE `'.$column.'` `'.$column.'` '.$type.' '.$default.';');
  }

}

function CheckColumn($column,$type,$table,$default="")
{
  $fields = mysql_list_fields( $this->app->Conf->WFdbname, $table);
  $columns = mysql_num_fields($fields);
  for ($i = 0; $i < $columns; $i++) {$field_array[] = mysql_field_name($fields, $i);}
  if (!in_array($column, $field_array))
  {
    $result = mysqli_query($this->app->DB->connection,'ALTER TABLE `'.$table.'` ADD `'.$column.'` '.$type.' '.$default.';');
  }
}



function IstWerktag($datum)
{
  if($this->IstFreierTag($datum)) return false;
  else return true;
}

function IstFreierTag($datum) {

  $tmp = explode('-',$datum);
  $jahr = $tmp[0];
  $monat = $tmp[1];
  $tag = $tmp[2];

  // Parameter in richtiges Format bringen
  if(strlen($tag) == 1) {
    $tag = "0$tag";
  }
  if(strlen($monat) == 1) {
    $monat = "0$monat";
  }

  // Wochentag berechnen
  $datum = getdate(mktime(0, 0, 0, $monat, $tag, $jahr));
  $wochentag = $datum['wday'];

  // Prüfen, ob Wochenende
  if($wochentag == 0 || $wochentag == 6) {
    return true;
  }

  // Feste Feiertage werden nach dem Schema ddmm eingetragen
  $feiertage[] = "0101"; // Neujahrstag
  $feiertage[] = "0105"; // Tag der Arbeit
  $feiertage[] = "0310"; // Tag der Deutschen Einheit
  $feiertage[] = "2512"; // Erster Weihnachtstag
  $feiertage[] = "2612"; // Zweiter Weihnachtstag

  // Bewegliche Feiertage berechnen
  $tage = 60 * 60 * 24;
  $ostersonntag = easter_date($jahr);
  $feiertage[] = date("dm", $ostersonntag - 2 * $tage);  // Karfreitag
  $feiertage[] = date("dm", $ostersonntag + 1 * $tage);  // Ostermontag
  $feiertage[] = date("dm", $ostersonntag + 39 * $tage); // Himmelfahrt
  $feiertage[] = date("dm", $ostersonntag + 50 * $tage); // Pfingstmontag
  $feiertage[] = date("dm", $ostersonntag + 60 * $tage); // Frohnleichnahm

  // Prüfen, ob Feiertag
  $code = $tag.$monat;
  if(in_array($code, $feiertage)) {
    return true;
  } else {
    return false;
  }
}

function NeueArtikelNummer($artikelart="",$firma="",$projekt="")
{
  return $this->GetNextArtikelnummer($artikelart,$firma,$projekt);
}

     
    function GetAdapterboxAPIImage($deviceiddest,$width=0,$height=0)
    {
      //480x360
      //800x600
      //960x720
      // hole baudrate aus einstellungen
      $art = "kamera";

      $job = '<image><settings width="'.$width.'" height="'.$height.'"></settings></image>';
      $result = $this->AdapterboxAPI($deviceiddest,$art,$job,true);

      return unserialize(base64_decode($result));
    }

    function GetAdapterboxAPIWaage($deviceiddest)
    {

      $baud = $this->app->DB->Select("SELECT baudrate FROM adapterbox WHERE seriennummer='$deviceiddest' LIMIT 1");
      if($baud=="") $baud=1;
 
      $model = $this->app->DB->Select("SELECT model FROM adapterbox WHERE seriennummer='$deviceiddest' LIMIT 1");
      if($model=="") $model="marel";

      switch($model)
      {
        case "marel":
          $timeout = 2;
          $chars = 100;
        break;
        case "pce":
          $timeout = 2;
          $chars = 100;
        break;
      }

      // hole baudrate aus einstellungen
      //$baud = 2; // 1 = 4800, 2 = 9600
      //$model = "marel"; 
      $art = "waage";

      $job = '<waage><settings baud="'.$baud.'" chars="'.$chars.'" timeout="'.$timeout.'"></settings></waage>';
      $result = $this->AdapterboxAPI($deviceiddest,$art,$job,true);

      // gewicht string entpacken
      //$result =  base64_decode(urldecode($result));

      if($model=="marel")
      {
        $result = explode("kg",$result);
        $last_string =  $result[count($result)-2];
        $result = explode(" ",$last_string);
        return $result[count($result)-2];
      } 
      else if($model=="pce")
      {
        $result = explode("Kg",$result);
        $last_string =  $result[count($result)-2];
        $result = explode(" ",$last_string);
        $tmp =  $result[count($result)-2];

        preg_match_all("/\d+/",$tmp,$result);
        return intval($result[0][count($result[0])-1])/1000;  
      }
      else {
        return $result;
      }
    }

    function AdapterboxAPI($deviceiddest,$art,$job,$with_answer = false)
    {

      $status = $this->app->DB->Select("SELECT if(TIME_TO_SEC(TIMEDIFF(NOW(),letzteverbindung)) > 10 OR letzteverbindung IS NULL,'disconnected','connected') FROM adapterbox
        WHERE seriennummer='$deviceiddest' AND seriennummer!='' LIMIT 1");

      // pruefe ob es ein drucker ist 
      $check_printer = $this->app->DB->Select("SELECT id FROM drucker WHERE adapterboxseriennummer!='' AND adapterboxseriennummer='$deviceiddest' LIMIT 1");

      if($check_printer > 0)
      {
        // drucker auftraege koennen immer angenommen werden
      } else {
        if($status !='connected') {
          return -1;
        }
      }

      $this->app->DB->Insert("INSERT INTO device_jobs (id,zeitstempel,deviceidsource,deviceiddest,job,art) VALUES ('',NOW(),'000000000','$deviceiddest','$job','$art')");
      $request_id = $this->app->DB->GetInsertID();

      if($with_answer!=true) return;

      $nottimeout=0;
      while(1)
      { 
        $nottimeout++;
        usleep(1000); // milliesekunden

        // 10 sekunden
        if($nottimeout > 1000 * 10)
        { 
          return "no answer from device (not timeout)";
          break;
        }

        $check_result = $this->app->DB->Select("SELECT id FROM device_jobs WHERE request_id='$request_id' AND request_id>0 LIMIT 1");

        if($check_result > 0)
        { 
          $job = $this->app->DB->Select("SELECT job FROM device_jobs WHERE id='$check_result' LIMIT 1");
          $this->app->DB->Delete("DELETE FROM device_jobs WHERE id='$check_result' LIMIT 1");
          //$job =  base64_decode($job); // device_job layer
          $job =  base64_decode($job); // device_job layer
          $job =  base64_decode(urldecode($job));
          return $job;
        }
      }
    }


    function PNG2Etikett($pfad)
    {
      $image_string = file_get_contents($pfad);

      if(mime_content_type($pfad)!="image/png") return array('result'=>0,'message'=>"Falsches Dateiformat! Es wird nur monochrom .png unterstuetzt");

      $image = imagecreatefromstring($image_string);
      $width = imagesx($image);
      $height = imagesy($image);
      $colors = array();

      for ($y = 0; $y < $height; $y++)
      {
        for ($x = 0; $x < $width; $x++)
        { 
          $rgb = imagecolorat($image, $x, $y);
          $r = ($rgb >> 16) & 0xFF;
          $g = ($rgb >> 8) & 0xFF;
          $b = $rgb & 0xFF;

          $black = ($r == 0 && $g == 0 && $b == 0); 
          $colors[$x][$y] = $black;

          if($counter <=7)
          {   
            if($black)
              $binary .="0";
            else
              $binary .="1";
          }   
          $counter++;


          if($counter >7) 
          {   
            $gesamt[] = bindec($binary);
            $binary="";
            $counter=0;
          }   
        } 
      }
      $image = $gesamt;
      //echo "height: $height \r\n";
      //echo "width: $width \r\n";

      $stream = "";
      for($i=0;$i<$width*$height;$i = $i + 32)
      { 
        //if(!isset($image[$i]))$image[$i]=0xFF;
        $stream .= pack("C*",$image[$i],$image[$i+1],$image[$i+2],$image[$i+3],$image[$i+4],$image[$i+5],$image[$i+6],$image[$i+7],
            $image[$i+8],$image[$i+9],$image[$i+10],$image[$i+11],$image[$i+12],$image[$i+13],$image[$i+14],$image[$i+15],
            $image[$i+16],$image[$i+17],$image[$i+18],$image[$i+19],$image[$i+20],$image[$i+21],$image[$i+22],$image[$i+23],
            $image[$i+24],$image[$i+25],$image[$i+26],$image[$i+27],$image[$i+28],$image[$i+29],$image[$i+30],$image[$i+31]
            );
      }


      $stream = serialize($stream);
      $stream = gzcompress($stream, 9);
      $stream = base64_encode($stream);
      return array('width'=>$width,'height'=>$height,'stream'=>$stream,'result'=>1);
    }

    function ArtikelStuecklisteDrucken($artikel)
    {
      $artikel = $this->app->DB->SelectArr("SELECT * FROM stueckliste WHERE stuecklistevonartikel='$'");
      for($i=0;$i<count($artikel);$i++)
      { 
        $artikelid = $artikel[$i]['artikel'];
        $this->EtikettenDrucker("artikel_klein",1,"artikel",$artikelid);
      }
    }
          function EtikettenDrucker($kennung,$anzahl,$tabelle,$id,$variables="",$xml="",$druckercode="")
          {
          if($anzahl<=0) $anzahl=1;


          if($druckercode <=0)
          { 
          $druckercode = $this->Firmendaten("standardetikettendrucker");
          if($druckercode <=0)
          {
            $druckercode = $this->app->DB->Select("SELECT id FROM drucker WHERE art=2 LIMIT 1");
          }
          }

          //format
        $format = $this->app->DB->Select("SELECT format FROM drucker WHERE id='$druckercode' LIMIT 1");
        $this->LogFile("Drucker $druckercode format $format");

        switch($kennung)
        {
          case "artikel_klein":
            switch($format)
            {
              case "30x15x3":
                $xml ='
                  <label>
                  <barcode y="1" x="3" size="4" type="1">{NUMMER}</barcode>
                  <line x="3" y="7" size="2">NR {NUMMER}</line>
                  <line x="3" y="10" size="2">{NAME_DE}</line>
                  </label>
                  ';
                break;
              default: //50x18x3
                $xml ='
                  <label>
                  <barcode y="1" x="3" size="8" type="2">{NUMMER}</barcode>
                  <line x="3" y="10" size="4">NR {NUMMER}</line>
                  <line x="3" y="13" size="4">{NAME_DE}</line>
                  </label>
                  ';
            }
            break;

/*
lieferschein_position
$xml ='<label>
<barcode y="1" x="3" size="6" type="2">{NUMMER}</barcode>
<line x="3" y="8" size="3">Artikel-Nr. {NUMMER}</line>
<line x="3" y="11" size="3">{NAME_DE}</line>
<line x="3" y="14" size="3">LS: {BELEGNR} Menge: {MENGE}</line>
</label>';
*/

          case "lieferschein_position":
            switch($format)
            {
              case "30x15x3":
                $xml ='
                  <label>
                    <barcode y="1" x="3" size="6" type="2">{NUMMER}</barcode>
                    <line x="3" y="8" size="3">Artikel-Nr. {NUMMER}</line>
                    <line x="3" y="11" size="3">{NAME_DE} </line>
                    <line x="3" y="14" size="3">LS: {BELEGNR} Menge: {MENGE} {LAGER_PLATZ_NAME}</line>

                  </label>
                  ';
                break;
              default: //50x18x3
                $xml ='
                  <label>
                    <barcode y="1" x="3" size="6" type="2">{NUMMER}</barcode>
                    <line x="3" y="8" size="3">Artikel-Nr. {NUMMER}</line>
                    <line x="3" y="11" size="3">{NAME_DE}</line>
                    <line x="3" y="14" size="3">LS: {BELEGNR} Menge: {MENGE} {LAGER_PLATZ_NAME}</line>
                  </label> 
                  ';
            }
            break;



          case "seriennummer":
            switch($format)
            {
              case "30x15x3":
                $xml ='
                  <label>
                  <barcode y="1" x="3" size="6" type="1">{SERIENNUMMER}</barcode>
                  <line x="3" y="8" size="3">SRN:{SERIENNUMMER}</line>
                  </label>
                  ';
                break;
              default: //50x18x3
                $xml ='
                  <label>
                  <barcode y="1" x="3" size="8" type="2">{SERIENNUMMER}</barcode>
                  <line x="3" y="10" size="3">SRN: {SERIENNUMMER}</line>
                  </label> 
                  ';
            }
            break;


          case "dms":
            switch($format)
            {
              case "30x15x3":
                $xml ='
                  <label>
                  <barcode y="1" x="3" size="6" type="1">{ID}</barcode>
                  <line x="3" y="8" size="3">DMS: {LABEL} {ID}</line>
                  </label>
                  ';
                break;
              default: //50x18x3
                $xml ='
                  <label>
                  <barcode y="1" x="3" size="8" type="2">{ID}</barcode>
                  <line x="3" y="10" size="3">DMS: {LABEL} {ID}</line>
                  </label> 
                  ';
            }
            break;



          case "lagerplatz_klein":
            switch($format)
            {
              case "30x15x3":
                $xml ='
                  <label>
                  <barcode y="1" x="3" size="6" type="1">{ID}</barcode>
                  <line x="3" y="8" size="3">Lager:{KURZBEZEICHNUNG}</line>
                  </label>
                  ';
                break;
              default: //50x18x3
                $xml ='
                  <label>
                  <barcode y="1" x="3" size="8" type="2">{ID}</barcode>
                  <line x="3" y="10" size="4">Lager: {KURZBEZEICHNUNG}</line>
                  </label>
                  ';
            }
            break;

          case "etikettendrucker_einfach":
            switch($format)
            {
              case "30x15x3":
                $xml ='
                  <label>
                  <line x="3" y="1" size="3">{BEZEICHNUNG1}</line>
                  <line x="3" y="3" size="3">{BEZEICHNUNG2}</line>
                  </label>
                  ';
                break;
              default: //50x18x3
                $xml ='
                  <label>
                  <line x="3" y="2" size="4">{BEZEICHNUNG1}</line>
                  <line x="3" y="10" size="4">{BEZEICHNUNG2}</line>
                  </label>
                  ';
            }
            break;

          case "kommissionieraufkleber":
            switch($format)
            {
              case "30x15x3":
                break;
              default: //50x18x3
                $xml = '<label>
                  <barcode x="2" y="0" size="8" type="2">{LIEFERSCHEIN}</barcode>
                  <line x="2" y="8" size="3">---------------------------</line>
                  <line x="2" y="10" size="4">{IHREBESTELLNUMMER}</line>
                  <line x="2" y="15" size="1">{FIRMA}</line>
                  </label>';
            }

            break;
        }


        // pruefe ob es ein ueberladendes etikett gibt
        $tmpxml = $this->ReadyForPDF($this->app->DB->Select("SELECT xml FROM etiketten WHERE verwendenals='".$kennung."' LIMIT 1"));

        if(is_numeric($kennung))
          $tmpxml = $this->ReadyForPDF($this->app->DB->Select("SELECT xml FROM etiketten WHERE id='".$kennung."' LIMIT 1"));
        else
          $kennung = $this->app->DB->Select("SELECT id FROM etiketten WHERE verwendenals='".$kennung."' LIMIT 1");

        $manuell = $this->app->DB->Select("SELECT manuell FROM etiketten WHERE id='".$kennung."' LIMIT 1");

        // wenn es ein ueberladenes etikett gibt
        if($tmpxml!="" && $manuell=="1") {
          // standard etiketten werte laden
          $xml = $tmpxml;

          // wenn manuell dann diese werte
          $labelbreite = $this->app->DB->Select("SELECT labelbreite FROM etiketten WHERE id='".$kennung."' LIMIT 1");
          $labelhoehe = $this->app->DB->Select("SELECT labelhoehe FROM etiketten WHERE id='".$kennung."' LIMIT 1");
          $labelabstand = $this->app->DB->Select("SELECT labelabstand FROM etiketten WHERE id='".$kennung."' LIMIT 1");
          $labeloffsetx = $this->app->DB->Select("SELECT labeloffsetx FROM etiketten WHERE id='".$kennung."' LIMIT 1");
          $labeloffsety = $this->app->DB->Select("SELECT labeloffsety FROM etiketten WHERE id='".$kennung."' LIMIT 1");

        } else {
          $this->LogFile("Format $format");

          if($tmpxml!="")
            $xml = $tmpxml;
          switch($format)
          {
            case "30x15x3":
              $labelbreite = 30;
              $labelhoehe = 15;
              $labelabstand = 3;
              $labeloffsetx=0;
              $labeloffsety=0;
              break;
            case "100x50x5":
              $labelbreite = 100;
              $labelhoehe = 50;
              $labelabstand = 5;
              $labeloffsetx=0;
              $labeloffsety=0;
              break;
            default:
              // standard etiketten werte laden
              $labelbreite = 50;
              $labelhoehe = 18;
              $labelabstand = 3;
              $labeloffsetx=0;
              $labeloffsety=16;
          }
        }

        //$labelbreite = 100;
        //$labelhoehe = 152;

        $xmlconfig = "<settings width=\"$labelbreite\" height=\"$labelhoehe\" distance=\"$labelabstand\" offsetx=\"$labeloffsetx\" offsety=\"$labeloffsety\" />";
        $xml = str_replace("<label>","<label>".$xmlconfig,$xml);


        switch($tabelle)
        {
          case "artikel": 
            $tmp = $this->app->DB->SelectArr("SELECT *,nummer as artikelnummer, name_de as artikel_name_de FROM artikel WHERE id='$id' LIMIT 1");

            $projekt = $tmp[0]['projekt'];
            if($tmp[0]['umsatzsteuer']=="ermaessigt")
              $steuer = ($this->GetStandardSteuersatzErmaessigt($projekt) + 100)/100.0;
            else
              $steuer = ($this->GetStandardSteuersatzNormal($projekt) + 100)/100.0;

            $tmp[0]['verkaufspreisbrutto']=number_format($this->GetVerkaufspreis($id,1)*$steuer,2,',','.');

            //standardlagerplatz 
            $tmp[0]['lager_platz_standard'] = $this->GetArtikelStandardlager($id);

            break;
          case "lager_platz": 
            $tmp = $this->app->DB->SelectArr("SELECT *,id as lager_platz_id, kurzbezeichnung as lager_platz_name FROM lager_platz WHERE id='$id' LIMIT 1");
            $tmp[0]['id'] = str_pad($tmp[0]['id'], 7, '0', STR_PAD_LEFT);
            break;
        }

        if(count($tmp)>0)
        {
          foreach($tmp[0] as $key=>$value)
          {
            $value = $this->UmlauteEntfernen($value);
            $xml = str_replace("{".strtoupper($key)."}",$value,$xml);
          }
        }

        if(count($variables)>0)
        {
          foreach($variables as $key=>$value)
          {
            $value = $this->UmlauteEntfernen($value);
            $xml = str_replace("{".strtoupper($key)."}",$value,$xml);
          }
        }
        $do = true;
        $i = 0;
        while($do && preg_match_all("/(.*)<barcode(.*)>(.*)\-(.*)<\/barcode>(.*)/",$xml,$erg))
        {
            $i++;
            if($i > 10)$do = false;//Endlosschleife bei Fehler verhindern
            $xml = preg_replace("/(.*)<barcode(.*)>(.*)\-(.*)<\/barcode>(.*)/", "$1<barcode$2>$3/$4</barcode>$5", $xml);
        }
        $this->app->printer->Drucken($druckercode,$xml,"",$anzahl);
        }

function ArtikelLagerInfo($artikel)
{

  $summe = $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz
        WHERE lpi.artikel='$artikel' AND lp.sperrlager!=1");

  $reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='$artikel'");// AND datum >= NOW()");

  $auftraege = $this->app->DB->Select("SELECT SUM(ap.menge) as menge,ap.bezeichnung FROM auftrag_position ap 
      LEFT JOIN artikel a ON a.id=ap.artikel LEFT JOIN auftrag auf ON auf.id=ap.auftrag WHERE a.id='$artikel' AND a.lagerartikel=1 AND auf.status='freigegeben'");

  $liefern= $this->app->DB->Select("SELECT SUM(ap.menge) as menge,ap.bezeichnung FROM auftrag_position ap, auftrag aa, artikel a WHERE a.id=ap.artikel AND aa.id = ap.auftrag AND a.id='$artikel' AND a.lagerartikel=1 AND aa.status='freigegeben'");

  $reserviert_im_versand = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='$artikel' AND objekt='lieferschein'");

  $berechnet = $summe -  $auftraege - $reserviert_im_versand;

  $verkaufte = $auftraege + $reserviert_im_versand;

  $rest = $summe - $liefern;
  if($reserviert=="") $reserviert =0;
  if($liefern <=0) $liefern=0;

  if($rest > 0) $verfuegbar = "$rest"; else $verfuegbar = "0";

  $verkaufbare = $this->ArtikelAnzahlVerkaufbar($artikel);

  //return "<br>Lagerbestand: $summe &nbsp;| Verf&uuml;gbar: $verfuegbar &nbsp;| &nbsp;Reserviert: $reserviert &nbsp;|&nbsp;Offene Auftr&auml;ge: $liefern&nbsp;|&nbsp;Restbestand: $rest | Verkaufbare: $verkaufbare<br><br>";
  //return "<br>Lagerbestand: $summe &nbsp;| &nbsp;Reserviert: $reserviert &nbsp;|&nbsp;Offene Auftr&auml;ge: $liefern&nbsp;| Verkaufte: $verkaufte | Berechneter Bestand: $berechnet | Verkaufbare: $verkaufbare<br><br>";
  return "<br>Lagerbestand: $summe &nbsp;| &nbsp;Reserviert: $reserviert &nbsp;|&nbsp;Offene Auftr&auml;ge: $liefern&nbsp;| Verkaufte: $verkaufte | Berechneter Bestand: $berechnet | Verkaufbare: $verkaufbare<br><br>";
}


  //Formatiert eine Dezimal Zahl fuer CSV Ausgabe automatisch
  function ParseDecimalForCSV($value)
  {
    // alle zahlen werte mit punkt zu komma
    $checkvalue = str_replace('.','',$value);
    if(is_numeric($checkvalue) && count(explode('.',$value))<=2)
    { 
      $value = str_replace('.',',',$value);
    }
    return $value;
  }

  function MengeFormat($menge)
  {
    if($menge<=0) return "";
    else if($menge == round($menge)) return round($menge);
    else return number_format($menge,2, '.', '');
  }

  function LimitChar($string,$length,$minword=3)
  {
    if(strlen($string) > $length) {
      $string = substr($string,0,$length)."...";
      $string_ende = strrchr($string, " ");
      $string = str_replace($string_ende," ...", $string);
    }
    return $string;
  }


  function LimitWord($word,$count,$sign="...")
  {
    $length = strlen($word);

    $parts= explode("\n", wordwrap($word, $count, "\n"));
    $word = $parts[0];

    if(strlen($word) < $length)
      $word.=$sign;

    return $word;
  }


  function MenuEintrag($link,$beschreibung,$mark=false)
  {
    $query = parse_url($link);
    $queryParts = explode('&', $query['query']);

    $params = array();
    foreach ($queryParts as $param) {
      $item = explode('=', $param);
      $params[$item[0]] = $item[1];
    }

    //Alle menüs ohne rechte ausblenden
    if(!$this->RechteVorhanden($params['module'],$params['action'])) return false;

    $this->menucounter++;

    if($beschreibung=="Freigabe" || $beschreibung=="Abschlie&szlig;en")
    {
      $this->app->Tpl->Add('TABS',"<a href=\"$link\" style=\"font-weight:bold;font-size:1.2em; margin: 3px; 
          background-color:rgb(255,223,233); color:[TPLFIRMENFARBEGANZDUNKEL];
border: 1px solid [TPLFIRMENFARBEGANZDUNKEL]; padding:4px;\">$beschreibung</a>");
    } else {

      //$this->app->Tpl->Add(TABS,"<img src=\"./themes/new/images/simpleForm_arrow.gif\" width=\"13\" height=\"9\" /> <a  href=\"$link\">$beschreibung</a><br>");
      //              if($beschreibung=="Zur&uuml;ck zur &Uuml;bersicht") return;
      $action = $this->app->Secure->GetGET("action");
      $module = $this->app->Secure->GetGET("module");
      $cmd = $this->app->Secure->GetGET("cmd");
      $id = $this->app->Secure->GetGET("id");

      if("index.php?module=$module&action=$action&cmd=$cmd&id=$id"==$link) $mark=1;
      else if("index.php?module=$module&action=$action&cmd=$cmd"==$link) $mark=1;
      else if("index.php?module=$module&action=$action&id=$id"==$link && $cmd=="") $mark=1;
      else if("index.php?module=$module&action=$action"==$link &&$cmd=="") $mark=1;
      else if("index.php?module=$module&action=$action"==$link) $mark=1; //TODO von Bene damit Aufgaben in Welcome geht 30.05.2015


      if(strpos($beschreibung,"Neu")!==false)
      {
        $this->app->Tpl->Set('TABSADD',"<a style=\"color:white;font-size:9pt\" href=\"$link\"><img src=\"./themes/new/images/neu.png\" height=\"18\"></a>");
        $this->app->Tpl->Set('TABSADDWIDTH',"50");
      }
      else if(strpos($beschreibung,"zur")!==false)
      {
        $this->app->Tpl->Set('TABSBACK',"$link");
      }
      else {
        if($mark){
        if($this->menucounter > 1) $padding=6; else $padding=7;

          $this->app->Tpl->Add('TABS',"<a href=\"$link\" style=\"font-weight:bold;font-size:1.1em;  
              margin: 0px 0px 4px 4px; margin-left: 4px;border-top:1px solid [TPLFIRMENFARBEHELL];
              background-color:[TPLFIRMENFARBEHELL]; color:[TPLFIRMENFARBEGANZDUNKEL]; border-bottom: 0px solid [TPLFIRMENFARBEHELL];
              border-left: 0px solid [TPLFIRMENFARBEGANZDUNKEL]; padding:".$padding."px;\">$beschreibung</a>");
        }
        else {
          $this->app->Tpl->Add('TABS',"<a href=\"$link\" style=\"font-weight:normal;font-size:1.2em; margin: 0px 0px 4px 4px; color:[TPLFIRMENFARBEHELL]; 
              border-top: 1px solid [TPLFIRMENFARBEHELL]; border-left: 1px solid [TPLFIRMENFARBEHELL];border-right: 1px solid [TPLFIRMENFARBEHELL]; padding:5px;\">$beschreibung</a>");
        }
      }
    }


    //if($this->menucounter == 10) $this->app->Tpl->Add(TABS,"<br><br>");
  }


  function HelpIcon()
  {
    $module = $this->app->Secure->GetGET("module");
    $action = $this->app->Secure->GetGET("action");
        $this->app->Tpl->Add('TABSPRINT',"&nbsp;<a style=\"color:white;font-size:9pt\" href=\"http://helpdesk.wawision.de/doku.php?id=wawision:".$module."_".$action."\" onclick=\"\" target=\"_blank\"><img src=\"./themes/new/images/hilfe.png\" height=\"19\"></a>");
  }

  function PrinterIcon()
  {
        $this->app->Tpl->Add('TABSPRINT',"&nbsp;<a style=\"color:white;font-size:9pt\" href=\"#\" onclick=\"wawisionPrint();\"><img src=\"./themes/new/images/icons_druck.png\" height=\"18\"></a>");
  }
  function SaldoAdresseAuftrag($adresse)
  {
    return $this->app->DB->Select("SELECT SUM(gesamtsumme) FROM auftrag WHERE adresse='$adresse' AND status='freigegeben' LIMIT 1");
  }       

  function UmsatzAdresseAuftragJahr($adresse)
  {
    return $this->app->DB->Select("SELECT 
        SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1)))
        FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id WHERE (a.status='freigegeben' OR a.status='abgeschlossen') 
        AND DATE_FORMAT(a.datum,'%Y')=DATE_FORMAT(NOW(),'%Y') AND a.adresse='$adresse'");
    //"SELECT SUM(gesamtsumme) FROM auftrag WHERE adresse='$adresse' AND status='freigegeben' 
    //                      AND DATE_FORMAT(datum,'%Y')=DATE_FORMAT(NOW(),'%Y') LIMIT 1");
  }       


  function UmsatzAdresseRechnungJahr($adresse)
  {
    return $this->app->DB->Select("SELECT 
        SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1)))
        FROM rechnung_position ap LEFT JOIN rechnung a ON ap.rechnung=a.id WHERE (a.status='freigegeben' OR a.status='abgeschlossen') 
        AND DATE_FORMAT(a.datum,'%Y')=DATE_FORMAT(NOW(),'%Y') AND a.adresse='$adresse'");
  }       



  function SaldoAdresse($adresse)
  {
    if(!is_numeric($adresse))
      return 0;

    // summe der rechnungen
    $summe_rechnungen  = $this->app->DB->Select("SELECT SUM(soll) FROM rechnung WHERE adresse='$adresse'");

    // summe skonto rechnungen
    $summe_rechnungen_skonto  = $this->app->DB->Select("SELECT SUM(skonto_gegeben) FROM rechnung WHERE adresse='$adresse'");

    // summe der gutschriften
    $summe_gutschriften  = $this->app->DB->Select("SELECT SUM(soll) FROM gutschrift WHERE adresse='$adresse'");

    return $summe_rechnungen - $summe_zahlungseingaenge - $summe_gutschriften + $summe_zahlungsausgaenge - $summe_rechnungen_skonto; 
  }

  
  function genLvl($id, $typ = "")
  {
    if($typ=="produktion") {
    }
  }
 
 
  function AuftragExplodieren($auftrag,$typ="")
  { 
    if($typ=="produktion") {
    }else {
      $auftraege = $this->app->DB->SelectArr("SELECT * FROM auftrag WHERE (status='freigegeben' OR status='angelegt') AND id='$auftrag'");
    }


    $adresse = $auftraege[0]['adresse'];
    $projekt = $auftraege[0]['projekt'];
    $status= $auftraege[0]['status'];

    /**
      * Die nächsten vier Zeilen zur projektabhängigen Stücklistenanpassung
      */
    if($projekt > 0)
    {
      $autostuecklistenanpassung = $this->app->DB->Select("SELECT autostuecklistenanpassung FROM projekt WHERE id='$projekt' LIMIT 1");
      if ($autostuecklistenanpassung == 0) {
        return;
      }
    }

    if($status!='freigegeben' && $status!='angelegt')
      return;

    if($typ=="produktion")
    {
    }
    else
    {
      $artikelarr= $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$auftrag' AND geliefert_menge < menge AND geliefert=0");
    }

    $treffer=0;
    // Lager Check
    $positionen_vorhanden = 0;
    $artikelzaehlen=0;
    //echo "{$auftraege[0][internet]} Adresse:$adresse Auftrag $auftrag";

    //echo "auftrag $auftrag anzahl:".count($artikelarr)."<br>";

    for($k=0;$k<count($artikelarr); $k++)
    {
      $menge = $artikelarr[$k]['menge'] - $artikelarr[$k]['gelieferte_menge'];
      $artikel = $artikelarr[$k]['artikel'];
      $artikel_position_id = $artikelarr[$k]['id'];
      // pruefe artikel 12 menge 4
      $lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='$artikel' LIMIT 1");
      //if($artikelarr[$k][nummer]!="200000" && $artikelarr[$k][nummer]!="200001"  && $artikelarr[$k][nummer]!="200002" && $lagerartikel==1)
      //if($lagerartikel==1)
      //if($artikelarr[$k][nummer]!="200000" && $artikelarr[$k][nummer]!="200001"  && $artikelarr[$k][nummer]!="200002" )
      {
        //echo "Artikel $artikel Menge $menge";
        // schaue ob es ein JUST Stuecklisten artikel ist der nicht explodiert ist
        $just_stueckliste = $this->app->DB->Select("SELECT juststueckliste FROM artikel WHERE id='$artikel' LIMIT 1");
        if($typ=="produktion")
        {
        } else {
          $explodiert = $this->app->DB->Select("SELECT explodiert FROM auftrag_position WHERE id='$artikel_position_id' LIMIT 1");
          $menge = $this->app->DB->Select("SELECT menge  FROM auftrag_position WHERE id='$artikel_position_id' LIMIT 1");
          $sort = $this->app->DB->Select("SELECT sort FROM auftrag_position WHERE id='$artikel_position_id' LIMIT 1");
        }
        $artikel_von_stueckliste = $this->app->DB->SelectArr("SELECT * FROM stueckliste WHERE stuecklistevonartikel='$artikel'"); 

        // mengen anpassung

        if($just_stueckliste=="1" && $explodiert=="1")// && $max=="9898989")
        {
          foreach($artikel_von_stueckliste as $key=>$value)
          {
            $menge_st =$value['menge']*$menge;
            if($typ=="produktion")
            {
            }
            else
            {
              $this->app->DB->Update("UPDATE auftrag_position SET menge='{$menge_st}' WHERE explodiert_parent='$artikel_position_id' AND artikel='{$value[artikel]}'");
            }
          }
        }
        // darunter war ein else if
        if($just_stueckliste=="1" && $explodiert=="0")
        {
          $treffer++;
          //hole artikel von stueckliste

          // schiebe alle artikel nach hinten
          $erhoehe_sort = count($artikel_von_stueckliste);
          if($typ=="produktion")
          {
          }
          else
          {
            $this->app->DB->Update("UPDATE auftrag_position SET sort=sort+$erhoehe_sort WHERE auftrag='$auftrag' AND sort > $sort");
          }

          foreach($artikel_von_stueckliste as $key=>$value)
          {
            $sort++;
            $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='{$value['artikel']}' LIMIT 1");
            if($typ=="produktion")
            {
            } else {
              $exolpdodiert_id = $this->AddAuftragPositionNummer($auftrag,$nummer,$value['menge']*$menge,$projekt,1);
              $this->app->DB->Update("UPDATE auftrag_position  SET explodiert_parent='$artikel_position_id',sort='$sort' WHERE id='$exolpdodiert_id' LIMIT 1");
            }
          }

          // MLM wenn mlm und der artikel explodiert ist alle punkte platt machen
          if($this->Firmendaten("modul_mlm")=="1")
          {
            $this->app->DB->Update("UPDATE auftrag_position SET mlmdirektpraemie=0, bonuspunkte=0,punkte=0 WHERE explodiert_parent='$artikel_position_id'");
          }

          if($typ=="produktion")
          {
          }
          else
          {
            $this->app->DB->Update("UPDATE auftrag_position SET explodiert='1' WHERE id='$artikel_position_id' LIMIT 1");
          }
        }
        else {



        }
      }
    }

    //achtung wenn selber artikel wieder in stueckliste ist dreht sich das programm dusselig hier!
    //    if($treffer >0)
    //      $this->AuftragExplodieren($auftrag,$typ);
  }



  function AuftragEinzelnBerechnen($auftrag,$festreservieren=false)
  {
    $this->AuftragExplodieren($auftrag);

    //$this->BerechneDeckungsbeitrag($auftrag,"auftrag");

    $this->LoadSteuersaetzeWaehrung($auftrag,"auftrag");

    // reservieren nur wenn es manuell gemacht wurde oder im auftrag fest steht
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $reservierung = $this->app->DB->Select("SELECT reservierung FROM projekt WHERE id='$projekt' LIMIT 1");
    if($reservierung=="1" || $festreservieren)
      $this->AuftragReservieren($auftrag);

    $this->AuftragAutoversandBerechnen($auftrag);
  }

  function AuftragAutoversandBerechnen($auftrag)
  {
    $auftraege = $this->app->DB->SelectArr("SELECT * FROM auftrag WHERE id='$auftrag'");    
    $adresse = $auftraege[0][adresse];
    $artikelarr= $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$auftrag' AND geliefert_menge < menge AND geliefert=0");



    //pruefe ob es mindestens eine reservierung gibt
    $reservierte = $this->app->DB->Select("SELECT COUNT(id) FROM lager_reserviert WHERE adresse='$adresse' AND datum>=NOW() AND objekt!='lieferschein'");
    if($reservierte >0)
    {
      $this->app->DB->Update("UPDATE auftrag SET reserviert_ok='1' WHERE id='$auftrag' LIMIT 1");
    } else 
      $this->app->DB->Update("UPDATE auftrag SET reserviert_ok='0' WHERE id='$auftrag' LIMIT 1");


    // liefertermin
    $liefertermincheck = $this->app->DB->Select("SELECT id FROM auftrag WHERE (tatsaechlicheslieferdatum<=NOW() OR tatsaechlicheslieferdatum IS NULL OR tatsaechlicheslieferdatum='0000-00-00') AND id='$auftrag'");
    if($liefertermincheck >0)
    {
      $this->app->DB->Update("UPDATE auftrag SET liefertermin_ok='1' WHERE id='$auftrag' LIMIT 1");
    } else 
      $this->app->DB->Update("UPDATE auftrag SET liefertermin_ok='0' WHERE id='$auftrag' LIMIT 1");

    //liefersperre 
    $liefersperre = $this->app->DB->Select("SELECT liefersperre FROM adresse WHERE id='$adresse'");
    if($liefersperre >0)
    {
      $this->app->DB->Update("UPDATE auftrag SET liefersperre_ok='0' WHERE id='$auftrag' LIMIT 1");
    } else 
      $this->app->DB->Update("UPDATE auftrag SET liefersperre_ok='1' WHERE id='$auftrag' LIMIT 1");


    //kreditlimit 
    $kreditlimit_freigabe = $this->app->DB->Select("SELECT kreditlimit_freigabe FROM auftrag WHERE id='$auftrag' LIMIT 1");

    if($this->KundeHatZR($adresse) || $this->KreditlimitCheck($adresse)==true || $kreditlimit_freigabe=="1")
    {
      $this->app->DB->Update("UPDATE auftrag SET kreditlimit_ok='1' WHERE id='$auftrag' LIMIT 1");
    } else 
      $this->app->DB->Update("UPDATE auftrag SET kreditlimit_ok='0' WHERE id='$auftrag' LIMIT 1");



    // Lager Check
    $positionen_vorhanden = 0;
    $artikelzaehlen=0;
    //echo "{$auftraege[0][internet]} Adresse:$adresse Auftrag $auftrag";
    for($k=0;$k<count($artikelarr); $k++)
    {
      $menge = $artikelarr[$k][menge] - $artikelarr[$k][gelieferte_menge];
      $artikel = $artikelarr[$k][artikel];
      $artikel_position_id = $artikelarr[$k][id];
      // pruefe artikel 12 menge 4
      // lagerartikel??
      $lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='{$artikelarr[$k][artikel]}' LIMIT 1");
      $stueckliste= $this->app->DB->Select("SELECT stueckliste FROM artikel WHERE id='{$artikelarr[$k][artikel]}' LIMIT 1");
      $juststueckliste= $this->app->DB->Select("SELECT juststueckliste FROM artikel WHERE id='{$artikelarr[$k][artikel]}' LIMIT 1");
      //if($artikelarr[$k][nummer]!="200000" && $artikelarr[$k][nummer]!="200001"  && $artikelarr[$k][nummer]!="200002" && $lagerartikel==1)
      //echo $artikelarr[$k][artikel]." ";
      if($lagerartikel==1)
      {
        //echo "HUHUH";

        // wenn artikel oefters im Auftrag nehme gesamte summe her

        $gesamte_menge_im_auftrag= $this->app->DB->Select("SELECT SUM(menge-geliefert_menge) FROM auftrag_position WHERE auftrag='$auftrag' AND artikel='$artikel'");
        if($gesamte_menge_im_auftrag > $menge) $menge = $gesamte_menge_im_auftrag;

        if($this->LagerCheck($adresse,$artikel,$menge,"auftrag",$auftrag)>0) $positionen_vorhanden++;
        $artikelzaehlen++;
      }
    }


    $this->app->DB->Update("UPDATE auftrag SET teillieferung_moeglich='0' WHERE id='$auftrag' LIMIT 1");
    //echo "$positionen_vorhanden $artikelzaehlen<hr>";
    if($positionen_vorhanden==$artikelzaehlen)
      $this->app->DB->Update("UPDATE auftrag SET lager_ok='1' WHERE id='$auftrag' LIMIT 1");
    else {
      $this->app->DB->Update("UPDATE auftrag SET lager_ok='0' WHERE id='$auftrag' LIMIT 1");
      if($positionen_vorhanden > 0 && $artikelzaehlen > 0)
      {
        $this->app->DB->Update("UPDATE auftrag SET teillieferung_moeglich='1' WHERE id='$auftrag' LIMIT 1");
      }

    }       

    // projekt check start
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $projektcheck = $this->app->DB->Select("SELECT checkok FROM projekt WHERE id='$projekt' LIMIT 1");
    $projektcheckname = $this->app->DB->Select("SELECT checkname FROM projekt WHERE id='$projekt' LIMIT 1");
    $projektportocheck = $this->app->DB->Select("SELECT portocheck FROM projekt WHERE id='$projekt' LIMIT 1");
    $projektnachnahmecheck = $this->app->DB->Select("SELECT nachnahmecheck FROM projekt WHERE id='$projekt' LIMIT 1");


    if($projektcheck=="1")
    {
      //echo "projekt check $projektcheckname notwendig";
      include_once (dirname(__FILE__)."/../plugins/class.".$projektcheckname.".php");         

      $tmp = new unishop($this->app);
      if($tmp->CheckOK($auftrag))
        $this->app->DB->Update("UPDATE auftrag SET check_ok='1' WHERE id='$auftrag' LIMIT 1");
      else
        $this->app->DB->Update("UPDATE auftrag SET check_ok='0' WHERE id='$auftrag' LIMIT 1");

    }
    else
      $this->app->DB->Update("UPDATE auftrag SET check_ok='1' WHERE id='$auftrag' LIMIT 1");


    // autopruefung anstubsen
    //$this->AutoUSTPruefung($adresse);

    // UST Check
    // pruefe adresse 23 ust innerhalb 3 tagen vorhanden? wenn nicht schaue ob selber ordern kann wenn ja ordern und auf gruen

    $ustprf = $this->app->DB->Select("SELECT id FROM ustprf WHERE DATE_FORMAT(datum_online,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d') AND adresse='$adresse' AND status='erfolgreich' LIMIT 1");
    $ustid = $this->app->DB->Select("SELECT ustid FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $ust_befreit = $this->app->DB->Select("SELECT ust_befreit FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $land = $this->app->DB->Select("SELECT land FROM auftrag WHERE id='$auftrag' LIMIT 1");


    if($ust_befreit==0 || ($ust_befreit==1 && $ustid==""))
    {
      $this->app->DB->Update("UPDATE auftrag SET ust_ok='1' WHERE id='$auftrag' LIMIT 1");
    } 

    // Porto Check
    // sind versandkosten im auftrag
    $porto = $this->app->DB->Select("SELECT ap.id FROM auftrag_position ap, artikel a WHERE ap.auftrag='$auftrag' AND ap.artikel=a.id AND a.porto=1 AND ap.preis >= 0
        AND a.id=ap.artikel LIMIT 1");
    $keinporto = $this->app->DB->Select("SELECT keinporto FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $selbstabholer = $this->app->DB->Select("SELECT versandart FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$auftrag' LIMIT 1");


    // portocheck bei projekt



    if($selbstabholer=="selbstabholer" || $selbstabholer=="keinversand") $keinporto=1;

    if($projektportocheck==1)
    {
      if($porto > 0)
        $this->app->DB->Update("UPDATE auftrag SET porto_ok='1' WHERE id='$auftrag' LIMIT 1");
      else
        $this->app->DB->Update("UPDATE auftrag SET porto_ok='0' WHERE id='$auftrag' LIMIT 1");
    } else {
      //projekt hat kein portocheck porto ist immer ok
      $this->app->DB->Update("UPDATE auftrag SET porto_ok='1' WHERE id='$auftrag' LIMIT 1");
    }



    if($keinporto==1 || $selbstabholer=="selbstabholer")
    {
      $this->app->DB->Update("UPDATE auftrag SET porto_ok='1' WHERE id='$auftrag' LIMIT 1");
      //$this->app->DB->Update("UPDATE auftrag_position ap, artikel a SET ap.preis='0' WHERE ap.auftrag='$auftrag' AND a.id=ap.artikel AND a.porto='1'");
    }


    //Vorkasse Check
    //ist genug geld da? zusammenzaehlen der kontoauszuege_zahlungseingang
    $summe_eingang = 0;
    $auftrag_gesamtsumme = $this->app->DB->Select("SELECT gesamtsumme FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $vorabbezahltmarkieren = $this->app->DB->Select("SELECT vorabbezahltmarkieren FROM auftrag WHERE id='$auftrag' LIMIT 1");

    $zahlungsweise = strtolower($zahlungsweise);
    if($summe_eingang>=$auftrag_gesamtsumme || ($zahlungsweise=="rechnung" || $zahlungsweise=="amazon" || $zahlungsweise=="amazon_bestellung" || $zahlungsweise=="billsafe" || $zahlungsweise=="secupay"
          || $zahlungsweise=="nachnahme" || $zahlungsweise=="einzugsermaechtigung" || $zahlungsweise=="lastschrift" || $zahlungsweise=="bar") || $auftrag_gesamtsumme==0 || $vorabbezahltmarkieren=="1")
    {
      //TODO ok bei amazon, amazon_bestellung und billsafe nur wenn transaktionsnummer vorhanden?
      $this->app->DB->Update("UPDATE auftrag SET vorkasse_ok='1' WHERE id='$auftrag' LIMIT 1");
    } 
    else if ($summe_eingang > 0) {
      $this->app->DB->Update("UPDATE auftrag SET vorkasse_ok='2' WHERE id='$auftrag' LIMIT 1");
    }
    else {
      $this->app->DB->Update("UPDATE auftrag SET vorkasse_ok='0' WHERE id='$auftrag' LIMIT 1");
    }

    //nachnahme gebuehr check!!!!
    //$nachnahme = $this->app->DB->Select("SELECT id FROM auftrag_position WHERE auftrag='$auftrag' AND nummer='200001' LIMIT 1");
    $nachnahme = $this->app->DB->Select("SELECT COUNT(ap.id) FROM auftrag_position ap, artikel a WHERE ap.auftrag='$auftrag' AND ap.artikel=a.id AND a.porto=1 AND ap.preis >= 0
        AND a.id=ap.artikel");

    if($zahlungsweise=="nachnahme" && $nachnahme <2 && $projektnachnahmecheck==1)
      $this->app->DB->Update("UPDATE auftrag SET nachnahme_ok='0' WHERE id='$auftrag' LIMIT 1");
    else
      $this->app->DB->Update("UPDATE auftrag SET nachnahme_ok='1' WHERE id='$auftrag' LIMIT 1");
  }




  function EUR($betrag)
  {
    return number_format($betrag,2,",",".");
  }

  function KreditlimitCheck($adresse)
  {
    $kreditlimit = $this->app->DB->Select("SELECT kreditlimit FROM adresse WHERE id='$adresse' LIMIT 1");
    if($kreditlimit <=0) return true;
    // offene Rechnungen
    $rechnungen = $this->SaldoAdresse($adresse)*-1;

    $auftraege = $this->SaldoAdresseAuftrag($adresse);

    if($kreditlimit >= ($rechnungen+$auftraege))
      return true;
    else
      return false;
  }       

  function ReplaceBetrag($db,$value,$fromform)
  { 
    // wenn ziel datenbank
    if($db)
    {
      // wenn . und , vorhanden dann entferne punkt
      $pos_punkt = strpos($value, '.');       
      $pos_komma = strpos($value, ',');       
      if(($pos_punkt !== false) && ($pos_komma !== false))
        $value = str_replace('.','',$value);

      return str_replace(',','.',$value);
    }
    // wenn ziel formular
    else
    {
      //return $abkuerzung;
      return str_replace('.',',',$value);
    }
  }

  function ReplaceAdresse($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT CONCAT(id,' ',name) FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;

      $tmp = trim($value);
      $rest = explode(" ",$tmp);
      $rest = $rest[0];
      $id =  $this->app->DB->Select("SELECT id FROM adresse WHERE id='$rest' AND geloescht=0 LIMIT 1");
      if($id <=0) $id=0;
    }

    // wenn ziel datenbank
    if($db)
    {
      return $id;
    }
    // wenn ziel formular
    else
    {
      return $abkuerzung;
    }
  }

  function ReplaceMitarbeiter($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT CONCAT(mitarbeiternummer,' ',name) FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;

      $tmp = trim($value);
      $rest = explode(" ",$tmp);
      $rest = $rest[0];
      $id =  $this->app->DB->Select("SELECT id FROM adresse WHERE mitarbeiternummer='$rest' AND mitarbeiternummer!='' AND geloescht=0 LIMIT 1");
      if($id <=0) $id=0;

    }

    // wenn ziel datenbank
    if($db)
    {
      return $id;
    }
    // wenn ziel formular
    else
    {
      return $abkuerzung;
    }
  }


  function ReplaceArtikel($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;

      $abkuerzung = $this->app->DB->Select("SELECT CONCAT(nummer,' ',name_de) as name FROM artikel WHERE id='$id' AND geloescht=0 LIMIT 1");
      if($id==0 || $id=="") $abkuerzung ="";
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      // wenn nummer keine DB id ist!
      $tmp = trim($value);
      $rest = explode(" ",$tmp);
      $rest = $rest[0];
      $id =  $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$rest' AND nummer!='' AND geloescht=0 LIMIT 1");
      if($id <=0) $id=0;
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }


  function ReplaceDecimal($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(strpos($value,'.') > 0) $dbformat = 1;

    // wenn ziel datenbank
    if($db)
    { 
      if($dbformat) return $value;
      else { 
        if($value!="")
          return str_replace(',','.',$value);
        else return "";
      }
    }
    // wenn ziel formular
    else
    { 
      if($dbformat) { if($value!="") return $value; else return "";}
      else return $value;
    }
  }



  function ReplaceZeit($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(strlen($value) > 5) $dbformat = 1;

    // wenn ziel datenbank
    if($db)
    {
      if($dbformat) return $value;
      else return $this->app->String->Convert($value,"%1:%2","%1:%2:00");
    }
    // wenn ziel formular
    else
    {
      if($dbformat) return $this->app->String->Convert($value,"%1:%2:%3","%1:%2");
      else return $value;
    }
  }

  function ReplaceDatum($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(strpos($value,'-') > 0) $dbformat = 1;

    // wenn ziel datenbank
    if($db)
    { 
      if($dbformat) return $value;
      else { 
        if($value!="")
          return $this->app->String->Convert($value,"%1.%2.%3","%3-%2-%1");
        else return "";
      }
    }
    // wenn ziel formular
    else
    { 
      if($dbformat) { if($value!="") return $this->app->String->Convert($value,"%1-%2-%3","%3.%2.%1");  else return "";}
      else return $value;
    }
  }



  function ReplaceAngebot($db,$value,$fromform)
  { 
    return $this->ReplaceANABRELSGSBE("angebot",$db,$value,$fromform);
  }

  function ReplaceLieferschein($db,$value,$fromform)
  { 
    return $this->ReplaceANABRELSGSBE("lieferschein",$db,$value,$fromform);
  }

  function ReplaceAuftrag($db,$value,$fromform)
  { 
    return $this->ReplaceANABRELSGSBE("auftrag",$db,$value,$fromform);
  }

  function ReplaceRechnung($db,$value,$fromform)
  { 
    return $this->ReplaceANABRELSGSBE("rechnung",$db,$value,$fromform);
  }

  function ReplaceBestellung($db,$value,$fromform)
  { 
    return $this->ReplaceANABRELSGSBE("bestellung",$db,$value,$fromform);
  }



  function ReplaceANABRELSGSBE($table,$db,$value,$fromform)
  {
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT belegnr as name FROM $table WHERE id='$id' LIMIT 1");
      if($id=="0" || $id=="") $abkuerzung ="";
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $tmp = trim($value);
      //$id =  $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$rest' AND geloescht=0 LIMIT 1");
      $id =  $this->app->DB->Select("SELECT id FROM $table WHERE belegnr='$tmp' AND belegnr!='' LIMIT 1");
      if($id <=0) $id=0;
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }

  }

  function ReplaceKasse($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT bezeichnung FROM konten WHERE id ='$id' LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT id FROM konten WHERE bezeichnung LIKE '$value' AND bezeichnung!='' LIMIT 1");
      if($id <=0) $id=0;
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }


  function ReplaceKostenstelle($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT CONCAT(nummer,' ',beschreibung) FROM kostenstelle WHERE nummer='$id' LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT nummer FROM kostenstelle WHERE CONCAT(nummer,' ',beschreibung)='$value' AND CONCAT(nummer,' ',beschreibung)!='' LIMIT 1");
      if($id <=0) $id=0;
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }


  function ReplaceGruppe($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT CONCAT(name,' ',kennziffer) as name FROM gruppen WHERE id='$id' LIMIT 1");
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT id FROM gruppen WHERE CONCAT(name,' ',kennziffer)='$value' OR (kennziffer='$value' AND kennziffer!='') LIMIT 1");
      if($id <=0) $id=0;
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }


  function ReplaceProjekt($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$id' LIMIT 1");
      if($id<=0) $abkuerzung='';
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $id =  $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$value' AND abkuerzung!='' LIMIT 1");
      if($value=='') $id=0;
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }

  function ReplaceLieferantennummer($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) { // wenn es eine id ist!
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT lieferantennummer as name FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      if($id==0 || $id=="") $abkuerzung ="";
    } else {
      $abkuerzung = $value;
      $tmp = trim($value);
      $rest = explode(" ",$tmp);
      $rest = $rest[0];
      $id =  $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='$rest' AND lieferantennummer!='' AND geloescht=0 LIMIT 1");
      if($id <=0) $id=0;
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }

  // Split 
  function FirstTillSpace($string)
  {
    $tmp = trim($string);
    $rest = explode(" ",$tmp);
    return $rest[0];
  }


  function ReplaceKundennummer($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) { // wenn es eine id ist!
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT kundennummer as name FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      if($id==0 || $id=="") $abkuerzung ="";
    } else {
      $abkuerzung = $value;
      $tmp = trim($value);
      //$rest = substr($tmp, 0, 5);
      $rest = explode(" ",$tmp);
      $rest = $rest[0];
      $id =  $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$rest' AND kundennummer!='' AND geloescht=0 LIMIT 1");
      if($id <=0) $id=0;
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }


  function ReplaceKunde($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT CONCAT(kundennummer,' ',name) as name FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      if($id==0 || $id=="") $abkuerzung ="";
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $tmp = trim($value);
      $rest = explode(" ",$tmp);
      $rest = $rest[0];
      $id =  $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$rest' AND kundennummer!='' AND geloescht=0 LIMIT 1");
      if($id <=0) $id=0;
    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }



  function ReplaceLieferant($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(!$fromform) {
      $dbformat = 1;
      $id = $value;
      $abkuerzung = $this->app->DB->Select("SELECT CONCAT(lieferantennummer,' ',name) as name FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
      if($id==0 || $id=="") $abkuerzung ="";
    } else {
      $dbformat = 0;
      $abkuerzung = $value;
      $tmp = trim($value);
      $rest = explode(" ",$tmp);
      $rest = $rest[0];
      $id =  $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='$rest' AND lieferantennummer!='' AND geloescht=0 LIMIT 1");
      if($id <=0) $id=0;

    }

    // wenn ziel datenbank
    if($db)
    { 
      return $id;
    }
    // wenn ziel formular
    else
    { 
      return $abkuerzung;
    }
  }


  function CheckSamePage()
  {
    $id = $this->app->Secure->GetGET("id");
    $check_id  = strstr($_SERVER['HTTP_REFERER'], 'id=');
    if($check_id!="id=".$id)
      return true;
    else 
      return false;
  }

  function SeitenSperrAuswahl($ueberschrift,$meldung)
  {
    /* $this->app->Tpl->Set(SPERRMELDUNG,  '$("a#inline").fancybox({
       \'modal\': true,
       \'autoDimensions\': false,
       \'width\': 500,
       \'height\': 300
       });
       $(\'#inline\').click();');

       $this->app->Tpl->Set(SPERRMELDUNGNACHRICHT,'<a id="inline" href="#data"></a>
       <div style="display:none"><div id="data"><h2>'.$ueberschrift.'</h2><hr>von Benedikt Sauter<br><br><div class="info">'.$meldung.'</div>
       <br><br><center><a href="'.$_SERVER['HTTP_REFERER'].'">Jetzt Zur&uuml;ck zum letzten Schritt</a>&nbsp;|&nbsp;
       <a href="javascript:;" onclick="$.fancybox.close();">Bitte Fenster dennoch freigeben</a></center></div></div>');
     */

    $this->app->Tpl->Set('SPERRMELDUNG',  '
        // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
        $( "#dialog:ui-dialog" ).dialog( "destroy" );

        $( "#dialog-message" ).dialog({
modal: true,
buttons: {
Ok: function() {
$( this ).dialog( "close" );
}
}
});
        ');


    $this->app->Tpl->Set('SPERRMELDUNGNACHRICHT','
        <div id="dialog-message" title="'.$ueberschrift.'">
        <p style="font-size: 9pt">
        '.$meldung.'
        </p>
        </div>
        ');
    }

function SeitenSperrInfo($meldung)
{
  $this->app->Tpl->Set('SPERRMELDUNG',  '$("a#inline").fancybox({
        \'hideOnContentClick\': true,
        \'autoDimensions\': false,
        \'width\': 500,
        \'height\': 300
        });
      $(\'#inline\').click();');

  $this->app->Tpl->Set('SPERRMELDUNGNACHRICHT','<a id="inline" href="#data"></a>
      <div style="display:none"><div id="data"><h2>Infomeldung</h2><hr><br><br>'.$meldung.'</div></div>');

}

function AddArtikel($felder)
{
  $this->app->DB->Insert("INSERT INTO artikel (id) VALUES ('')");
  $id = $this->app->DB->GetInsertID();
  if($felder['firma']<=0)
    $felder['firma'] = $this->app->DB->Select("SELECT MAX(id) FROM firma LIMIT 1");

  if($felder['projekt']<=0)
    $felder['projekt'] = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$felder['firma']."' LIMIT 1");

  if($felder['firma']<=0) $felder['firma']=1;
  if($felder['projekt']<=0) $felder['projekt']=1;

  // so starten, dass alle uebertragen werden
  if($felder['cache_lagerplatzinhaltmenge']<=0) $felder['cache_lagerplatzinhaltmenge']=-999;

  $this->app->DB->UpdateArr("artikel",$id,"id",$felder);
  return $id;
}


function AddVerkaufspreis($artikel,$abmenge,$adresse,$preis,$waehrung="EUR",$kundenartikelnummer="", $gruppe = null)
{
  if($adresse==="")
    return false;

  if($abmenge<=0)$abmenge=1;

  if($adresse > 0)
  {
    $adresse = $this->app->DB->Select("SELECT id FROM adresse WHERE id='$adresse' LIMIT 1");
    if($adresse <=0)
      return false;
  }

  if($adresse > 0)
    $check = $this->app->DB->Select("SELECT id FROM verkaufspreise WHERE ab_menge=".$abmenge." AND adresse=".$adresse." AND artikel=$artikel AND art='Kunde'
        AND (gueltig_bis='0000-00-00' OR gueltig_bis >= NOW()) AND geloescht!='1' ".($gruppe?" AND gruppe = '$gruppe' ":'')." LIMIT 1");
  else
    $check = $this->app->DB->Select("SELECT id FROM verkaufspreise WHERE ab_menge=".$abmenge." AND (adresse='' OR adresse=0) AND artikel=$artikel AND art='Kunde'
        AND (gueltig_bis='0000-00-00' OR gueltig_bis >= NOW()) AND geloescht!=1 ".($gruppe?" AND gruppe = '$gruppe' ":'')." LIMIT 1");

  // soll man preis als ungueltig markieren?
  if($check > 0)
  {
    // noch nie dagewesen jetzt anlegen
    // ist der preis anders?
    $preis_alt = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE id='$check' LIMIT 1");
    if($preis!=$preis_alt)
    {
      $this->app->DB->Update("UPDATE verkaufspreise SET gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY),apichange=1 WHERE id='$check' LIMIT 1");
      $this->app->DB->Insert("INSERT INTO verkaufspreise (id,adresse,artikel,angelegt_am,
        ab_menge,waehrung,preis,firma,kundenartikelnummer,art,apichange) 
          VALUES ('','$adresse','$artikel',NOW(),'$abmenge','$waehrung','$preis','".$this->app->User->GetFirma()."','".$kundenartikelnummer."','Kunde',1)");
          $insid = $this->app->DB->GetInsertID();
      if($gruppe)
      {
        $this->app->DB->Update("UPDATE verkaufspreise set gruppe = '".$gruppe."' where id = '".$insid."'");
      }
      return $insid;
    } else {
      // nur attribute update 
      if($kundenartikelnummer!="")
      { 
        $this->app->DB->Update("UPDATE verkaufspreise SET kundenartikelnummer='$kundenartikelnummer',apichange=1 WHERE id='$check' LIMIT 1");
      } else {
        $this->app->DB->Update("UPDATE verkaufspreise SET apichange=1 WHERE id='$check' LIMIT 1");
      }
    }
    return $check;
  } else {
    $this->app->DB->Insert("INSERT INTO verkaufspreise (id,adresse,artikel,angelegt_am,
      ab_menge,waehrung,preis,firma,kundenartikelnummer,art,apichange) 
        VALUES ('','$adresse','$artikel',NOW(),'$abmenge','$waehrung','$preis','".$this->app->User->GetFirma()."','".$kundenartikelnummer."','Kunde',1)");
        $insid = $this->app->DB->GetInsertID();
    if($gruppe)
    {
      $this->app->DB->Update("UPDATE verkaufspreise set gruppe = '".$gruppe."' where id = '".$insid."'");
    }
    return $insid;
  }
}


function AddEinkaufspreis($artikel,$abmenge,$adresse,$bestellnummer,$bezeichnunglieferant,$preis,$waehrung="",$vpe="", $testebestellnummer = false)
{
  if($abmenge<=0) $abmenge=1;

  if($waehrung=="") $waehrung="EUR";
  $where = "";
  if($testebestellnummer && $bestellnummer)$where = " AND bestellnummer = '".addslashes($bestellnummer)."' ";
  $check = $this->app->DB->Select("SELECT id FROM einkaufspreise WHERE ab_menge='".$abmenge."' AND adresse='".$adresse."' AND artikel='$artikel' 
      AND (gueltig_bis='0000-00-00' OR gueltig_bis >= NOW()) AND geloescht!='1' ".$where." LIMIT 1");
  // soll man preis als ungueltig markieren?
  if($check > 0)
  {
    // noch nie dagewesen jetzt anlegen
    // ist der preis anders?
    $preis_alt = $this->app->DB->Select("SELECT preis FROM einkaufspreise WHERE id='$check' LIMIT 1");
    if($preis!=$preis_alt)
    {
      $this->app->DB->Update("UPDATE einkaufspreise SET gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY),apichange=1 WHERE id='$check' LIMIT 1");
      //$this->AddEinkaufspreis($artikel,$abmenge,$adresse,$bestellnummer,$bezeichnunglieferant,$preis,$waehrung);
      $this->app->DB->Insert("INSERT INTO einkaufspreise (id,adresse,artikel,bestellnummer,bezeichnunglieferant, preis_anfrage_vom,
        ab_menge,waehrung,preis,firma,vpe,apichange) VALUES 
          ('','$adresse','$artikel','$bestellnummer','$bezeichnunglieferant',NOW(),'$abmenge','$waehrung','$preis','".$this->app->User->GetFirma()."','$vpe',1)");
      return $this->app->DB->GetInsertID();
    } else {
      $this->app->DB->Update("UPDATE einkaufspreise SET bestellnummer='$bestellnummer', bezeichnunglieferant='$bezeichnunglieferant',apichange=1
          WHERE id='$check' LIMIT 1");
      return $check;
    }
  } else {
    //$this->AddEinkaufspreis($artikel,$abmenge,$adresse,$bestellnummer,$bezeichnunglieferant,$preis,$waehrung);
    $this->app->DB->Insert("INSERT INTO einkaufspreise (id,adresse,artikel,bestellnummer,bezeichnunglieferant,      preis_anfrage_vom,
      ab_menge,waehrung,preis,firma,vpe,apichange) VALUES 
        ('','$adresse','$artikel','$bestellnummer','$bezeichnunglieferant',NOW(),'$abmenge','$waehrung','$preis','".$this->app->User->GetFirma()."','$vpe',1)");
    return $this->app->DB->GetInsertID();

  }

}

function EinkaufspreisBetrag($artikel,$menge,$lieferant,$projekt="")
{
  if(!$menge)$menge = 1;
  $id = $artikel;
  $adresse = $lieferant;

  $name = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");
  $nummer = $this->app->DB->Select("SELECT bestellnummer FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') LIMIT 1");
  $projekt = $this->app->DB->Select("SELECT p.abkuerzung FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.id='$id' LIMIT 1");
  $projekt_id = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$id' LIMIT 1");
  $ab_menge = $this->app->DB->Select("SELECT ab_menge FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') LIMIT 1");
  $ek = $this->app->DB->Select("SELECT preis FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND ab_menge <= $menge order by ab_menge desc LIMIT 1");

  return $ek;
}


function Einkaufspreis($artikel,$menge,$lieferant,$projekt="")
{
  $id = $artikel;
  $adresse = $lieferant;

  $name = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");
  $nummer = $this->app->DB->Select("SELECT bestellnummer FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') LIMIT 1");
  $projekt = $this->app->DB->Select("SELECT p.abkuerzung FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.id='$id' LIMIT 1");
  $projekt_id = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$id' LIMIT 1");
  $ab_menge = $this->app->DB->Select("SELECT ab_menge FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') LIMIT 1");
  $ek = $this->app->DB->Select("SELECT id FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') LIMIT 1");

  return $ek;
}


function ArtikelBestellung($artikel)
{

  //$summe_in_bestellung  = $this->app->DB->Select("SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp WHERE bp.artikel='$artikel' AND bp.geliefert < bp.menge AND bp.abgeschlossen!='1'");
  $summe_in_bestellung  = $this->app->DB->Select("SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp LEFT JOIN bestellung b ON b.id=bp.bestellung WHERE bp.artikel='$artikel' AND bp.geliefert < bp.menge AND (bp.abgeschlossen IS NULL OR bp.abgeschlossen!=1) AND b.status!='abgeschlossen' AND b.status!='freigegeben' AND b.status!='angelegt' AND b.status!='storniert'");


  if($summe_in_bestellung <= 0)
    return 0;

  return $summe_in_bestellung;
}

function ArtikelBestellungNichtVersendet($artikel)
{
  //$summe_in_bestellung  = $this->app->DB->Select("SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp WHERE bp.artikel='$artikel' AND bp.geliefert < bp.menge AND bp.abgeschlossen!='1'");
  $summe_in_bestellung  = $this->app->DB->Select("SELECT SUM(bp.menge-bp.geliefert) FROM bestellung_position bp LEFT JOIN bestellung b ON b.id=bp.bestellung WHERE bp.artikel='$artikel' AND bp.geliefert < bp.menge AND (bp.abgeschlossen IS NULL OR bp.abgeschlossen!=1) AND (b.status='freigegeben' OR b.status='angelegt')");

  if($summe_in_bestellung <= 0)
    return 0;

  return $summe_in_bestellung;
}



function ArtikelVerkaufGesamt($artikel)
{

  $summe_im_auftrag  = $this->app->DB->Select("SELECT SUM(menge) FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag WHERE ap.artikel='$artikel' AND a.status='abgeschlossen'");
  if($summe_im_auftrag<=0) $summe_im_auftrag=0;
  return $summe_im_auftrag;
}


function ArtikelImAuftrag($artikel)
{

  $summe_im_auftrag  = $this->app->DB->Select("SELECT SUM(menge) FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag WHERE ap.artikel='$artikel' AND a.status='freigegeben'");

  //$artikel_reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='".$artikel."' AND datum>=NOW() AND objekt!='lieferschein'");
  //$artikel_reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='".$artikel."' AND datum>=NOW()");
  return $summe_im_auftrag;

}


function ArtikelImLagerPlatz($artikel,$lager_platz)
{
  $summe_im_lager = $this->app->DB->Select("SELECT SUM(menge) FROM lager_platz_inhalt WHERE artikel='$artikel' AND lager_platz='$lager_platz'");
  return $summe_im_lager;
}


function ArtikelImLager($artikel)
{
  $summe_im_lager = $this->app->DB->Select("SELECT SUM(menge) FROM lager_platz_inhalt WHERE artikel='$artikel'");
  return $summe_im_lager;
}


function VerbindlichkeitErweiterteBestellung($id)
{
  for($i=1;$i<=15;$i++)
  {
    $alleids[] = $this->app->DB->SelectArr("SELECT bestellung$i as bestellung FROM verbindlichkeit WHERE id='$id' AND bestellung$i > 0");
  }

  for($i=0;$i<count($alleids);$i++)
  {

    for($ij=0;$ij<count($alleids[$i]);$ij++)
    {
      $result[] = $alleids[$i][$ij]['bestellung'];
    }

  }
  return array_unique($result);
}


function BestellungErweiterteVerbindlichkeiten($id)
{
  for($i=1;$i<=15;$i++)
  {
    $alleids[] = $this->app->DB->SelectArr("SELECT id, bestellung{$i}betrag as betrag FROM verbindlichkeit WHERE bestellung$i='$id'");
  }

  for($i=0;$i<count($alleids);$i++)
  {

    for($ij=0;$ij<count($alleids[$i]);$ij++)
    {
      $result[$alleids[$i][$ij]['id']] = $alleids[$i][$ij]['betrag'];
    }

  }
  return $result;
}


function get_emails ($str)
{
  $emails = array();
  $pattern="/([\s]*)([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*([ ]+|)@([ ]+|)([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,}))([\s]*)/i"; 
  //preg_match_all("/\b\w+\@w+[\-\.\w+]+\b/", $str, $output);
  preg_match_all($pattern, $str, $output);
  foreach($output[0] as $email) array_push ($emails, trim(strtolower($email)));
  if (count ($emails) >= 1) return $emails;
  else return false;
}



function MahnwesenBody($id,$als,$_datum=null)
{
  $adresse = $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$id' LIMIT 1");

  // OfferNo, customerId, OfferDate

  $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM rechnung WHERE id='$id' LIMIT 1");
  $auftrag= $this->app->DB->Select("SELECT auftrag FROM rechnung WHERE id='$id' LIMIT 1");
  $buchhaltung= $this->app->DB->Select("SELECT buchhaltung FROM rechnung WHERE id='$id' LIMIT 1");
  $lieferschein = $this->app->DB->Select("SELECT lieferschein FROM rechnung WHERE id='$id' LIMIT 1");
  $lieferscheinid = $lieferschein;
  $lieferschein = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$lieferschein' LIMIT 1");
  $bestellbestaetigung = $this->app->DB->Select("SELECT bestellbestaetigung FROM rechnung WHERE id='$id' LIMIT 1");
  $datum = $this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");
  $datum_sql = $this->app->DB->Select("SELECT datum FROM rechnung WHERE id='$id' LIMIT 1");
  $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
  $doppel = $this->app->DB->Select("SELECT doppel FROM rechnung WHERE id='$id' LIMIT 1");
  $freitext = $this->app->DB->Select("SELECT freitext FROM rechnung WHERE id='$id' LIMIT 1");
  $ustid = $this->app->DB->Select("SELECT ustid FROM rechnung WHERE id='$id' LIMIT 1");
  $soll = $this->app->DB->Select("SELECT soll FROM rechnung WHERE id='$id' LIMIT 1");
  $ist = $this->app->DB->Select("SELECT ist FROM rechnung WHERE id='$id' LIMIT 1");
  $land = $this->app->DB->Select("SELECT land FROM rechnung WHERE id='$id' LIMIT 1");
  $mahnwesen_datum = $this->app->DB->Select("SELECT mahnwesen_datum FROM rechnung WHERE id='$id' LIMIT 1");
  $mahnwesen_datum_deutsch = $this->app->DB->Select("SELECT DATE_FORMAT(mahnwesen_datum,'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");
  $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM rechnung WHERE id='$id' LIMIT 1");
  $zahlungsstatus = $this->app->DB->Select("SELECT zahlungsstatus FROM rechnung WHERE id='$id' LIMIT 1");
  $zahlungszieltage = $this->app->DB->Select("SELECT zahlungszieltage FROM rechnung WHERE id='$id' LIMIT 1");
  $zahlungszieltageskonto = $this->app->DB->Select("SELECT zahlungszieltageskonto FROM rechnung WHERE id='$id' LIMIT 1");
  $zahlungszielskonto = $this->app->DB->Select("SELECT zahlungszielskonto FROM rechnung WHERE id='$id' LIMIT 1");

  $zahlungdatum = $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD(datum, INTERVAL $zahlungszieltage DAY),'%d.%m.%Y') FROM rechnung WHERE id='$id' LIMIT 1");

  if($_datum!=null)
  {
    $mahnwesen_datum = $this->app->String->Convert($_datum,"%1.%2.%3","%3-%2-%1");
    $mahnwesen_datum_deutsch = $_datum;
  }

  $zahlungsweise = strtolower($zahlungsweise);

  if($als=="zahlungserinnerung")
  {
    $body = $this->GetKonfiguration("textz");
    $tage = $this->GetKonfiguration("mahnwesen_m1_tage");
    $footer = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
  }
  else if($als=="mahnung1")
  {
    $body = $this->GetKonfiguration("textm1");
    $mahngebuehr = $this->GetKonfiguration("mahnwesen_m1_gebuehr");
    $tage = $this->GetKonfiguration("mahnwesen_m2_tage");
    $footer = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
  }
  else if($als=="mahnung2")
  {
    $body = $this->GetKonfiguration("textm2");
    $tage = $this->GetKonfiguration("mahnwesen_m3_tage");
    $mahngebuehr = $this->GetKonfiguration("mahnwesen_m2_gebuehr");
    $footer = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
  }
  else if($als=="mahnung3")
  {
    $body = $this->GetKonfiguration("textm3");
    $tage = $this->GetKonfiguration("mahnwesen_ik_tage");
    $mahngebuehr = $this->GetKonfiguration("mahnwesen_m3_gebuehr");
    $footer = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
  }
  else if($als=="inkasso")
  {
    $body = $this->GetKonfiguration("texti");
    //$tage = $this->GetKonfiguration("mahnwesen_ik_tage");
    $tage = 3; //eigentlich vorbei
    $mahngebuehr = $this->GetKonfiguration("mahnwesen_ik_gebuehr");
    $footer = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
  }
  else
  {
    $body = "Sehr geehrte Damen und Herren,\n\nanbei Ihre Rechnung.";
    $footer = "$freitext"."\n\n".$zahlungsweisetext."\n\nDieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.\n$steuer";
  }

  $datummahnung= $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD('$mahnwesen_datum', INTERVAL $tage DAY),'%d.%m.%Y')");
  $datumrechnungzahlungsziel= $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD('$datum_sql', INTERVAL $zahlungszieltage DAY),'%d.%m.%Y')");

  $tage_ze = $zahlungszieltage + $this->GetKonfiguration("mahnwesen_m1_tage");
  $datumzahlungserinnerung= $this->app->DB->Select("SELECT DATE_FORMAT(DATE_ADD('$datum_sql', INTERVAL $tage_ze DAY),'%d.%m.%Y')");

  // checkstamp $this->CheckStamp("jhdskKUHsiusakiakuhsd"); // errechnet aus laufzeit und kundenid // wenn es nicht drinnen ist darf es nicht gehen

  if($mahngebuehr=="" || !is_numeric($mahngebuehr))
    $mahngebuehr = 0;

  //$offen= "11,23";


  $body = str_replace("{RECHNUNG}",$belegnr,$body);
  $body = str_replace("{DATUMRECHNUNG}",$datum,$body);
  $body = str_replace("{TAGE}",$tage,$body);
  $body = str_replace("{OFFEN}",number_format($soll - $ist,2),$body);
  $body = str_replace("{SOLL}",$soll,$body);
  $body = str_replace("{SUMME}",number_format($soll - $ist + $mahngebuehr,2),$body);
  $body = str_replace("{IST}",$ist,$body);
  $body = str_replace("{DATUM}",$datummahnung,$body);
  $body = str_replace("{MAHNGEBUEHR}",$mahngebuehr,$body);
  $body = str_replace("{MAHNDATUM}",$mahnwesen_datum_deutsch,$body);


  // Im Protokoll suchen Datum von Zahlungserinnerung, Mahnung 1, Mahnung 2, Mahnung 3

  $mahnung1 = $this->app->DB->Select("SELECT DATE_FORMAT(zeit,'%d.%m.%Y') FROM rechnung_protokoll WHERE rechnung='$id'
      AND grund LIKE 'Mahnung1 versendet%' ORDER by Zeit DESC LIMIT 1");

  $mahnung2 = $this->app->DB->Select("SELECT DATE_FORMAT(zeit,'%d.%m.%Y') FROM rechnung_protokoll WHERE rechnung='$id'
      AND grund LIKE 'Mahnung2 versendet%' ORDER by Zeit DESC LIMIT 1");

  $mahnung3 = $this->app->DB->Select("SELECT DATE_FORMAT(zeit,'%d.%m.%Y') FROM rechnung_protokoll WHERE rechnung='$id'
      AND grund LIKE 'Mahnung3 versendet%' ORDER by Zeit DESC LIMIT 1");

  /*$datumzahlungerinnerungversendet = 
    $this->app->DB->Select("SELECT DATE_FORMAT(zeit,'%d.%m.%Y') FROM rechnung_protokoll WHERE rechnung='$id'
    AND grund LIKE 'Zahlungserinnerung versendet%' ORDER by Zeit DESC LIMIT 1");
   */


  $body = str_replace("{DATUMMAHNUNG1}",$mahnung1,$body);
  $body = str_replace("{DATUMMAHNUNG2}",$mahnung2,$body);
  $body = str_replace("{DATUMMAHNUNG3}",$mahnung3,$body);

  $body = str_replace("{DATUMZAHLUNGSERINNERUNGFAELLIG}",$datumzahlungserinnerung,$body);
  $body = str_replace("{DATUMZAHLUNGSERINNERUNG}",$datumzahlungserinnerung,$body);
  $body = str_replace("{DATUMRECHNUNGZAHLUNGSZIEL}",$datumrechnungzahlungsziel,$body);

  $body = $this->ParseUserVars("rechnung",$id,$body);

  return $body;
}




function Gegenkonto($ust_befreit,$ustid="")
{
  switch($ust_befreit)
  {
    case 0: $tmp['gegenkonto']=$this->Firmendaten("steuer_erloese_inland_normal"); break;
    case 1:
            if($ustid=="")
            {
              $tmp['gegenkonto']=$this->Firmendaten("steuer_erloese_inland_eunormal");
            } else {
              $tmp['gegenkonto']=$this->Firmendaten("steuer_erloese_inland_innergemeinschaftlich");
            }
            break;
    case 2: $tmp['gegenkonto']=$this->Firmendaten("steuer_erloese_inland_export"); break;
    case 3: $tmp['gegenkonto']=$this->Firmendaten("steuer_erloese_inland_nichtsteuerbar"); break;
    default:
            //TODO
            echo "FEHLER!";
            exit;
  }
  return $tmp['gegenkonto'];
}


  function SetKonfigurationValue($name,$value)
  {
    $this->app->DB->Delete("DELETE FROM konfiguration WHERE name='$name' LIMIT 1");
    $this->app->DB->Insert("INSERT INTO konfiguration (name,wert,firma,adresse) VALUES ('$name','$value','".$this->app->User->GetFirma()."','".$this->app->User->GetAdresse()."')");
  }



  function SetKonfiguration($name,$dezimal=false)
  {

    $this->app->DB->Delete("DELETE FROM konfiguration WHERE name='$name' LIMIT 1");

    if($dezimal)
      $value = str_replace(',','.',$this->app->Secure->GetPOST($name));
    else
      $value = $this->app->Secure->GetPOST($name);

    $this->app->DB->Insert("INSERT INTO konfiguration (name,wert,firma,adresse) VALUES ('$name','$value','".$this->app->User->GetFirma()."','".$this->app->User->GetAdresse()."')");

  }


  function GetKonfiguration($name)
  {

    return $this->app->DB->Select("SELECT wert FROM konfiguration WHERE name='$name' LIMIT 1");// AND firma='".$this->app->User->GetFirma()."' LIMIT 1");
  }


  function Folgebestaetigung($adresse)
  {

    $sperre = $this->app->DB->Select("SELECT folgebestaetigungsperre FROM adresse WHERE id='$adresse' LIMIT 1");
    if($sperre=="1") return 1;

    // hole alle freigebeben auftraege
    $auftragarr = $this->app->DB->SelectArr("SELECT id,belegnr,ihrebestellnummer,DATE_FORMAT(datum,'%d.%m.%Y') as datum2, DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum2,
        liefertermin_ok  
        FROM auftrag WHERE adresse='$adresse' AND status='freigegeben' AND (lager_ok!=1 OR liefertermin_ok!=1) ORDER by lieferdatum");

    $to = $this->app->DB->Select("SELECT email FROM adresse WHERE id='$adresse' LIMIT 1");
    $to_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' LIMIT 1");

    for($iauftrag=0;$iauftrag<count($auftragarr);$iauftrag++)
    {
      $auftrag = $auftragarr[$iauftrag]['id']; 

      $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$auftrag' LIMIT 1");
      $folgebestaetigung = $this->app->DB->Select("SELECT folgebestaetigung FROM projekt WHERE id='$projekt' LIMIT 1");    
      if($folgebestaetigung!=1)
        continue;

      if($auftragarr[$iauftrag]['lieferdatum2']=="00.00.0000") $auftragarr[$iauftrag]['lieferdatum2'] = "sofort";

      if($auftragarr[$iauftrag]['liefertermin_ok']!="1")
      {
        $artikeltabelleliefertermin .= "\r\n-Auftrag ".$auftragarr[$iauftrag]['belegnr']." vom ".$auftragarr[$iauftrag]['datum2']." Bestellung/Kommission: ".$auftragarr[$iauftrag]['ihrebestellnummer']." (geplanter Liefertermin: ".$auftragarr[$iauftrag]['lieferdatum2'].")\n";
      }
      else { 
        $artikeltabelle .= "\r\n-Auftrag ".$auftragarr[$iauftrag]['belegnr']." vom ".$auftragarr[$iauftrag]['datum2']." Bestellung/Kommission: ".$auftragarr[$iauftrag]['ihrebestellnummer']." (geplanter Liefertermin: ".$auftragarr[$iauftrag]['lieferdatum2'].")\n";
      } 
      //$to = $this->app->DB->Select("SELECT email FROM auftrag WHERE id='$auftrag' LIMIT 1");
      //$to_name = $this->app->DB->Select("SELECT name FROM auftrag WHERE id='$auftrag' LIMIT 1");

      $arr = $this->app->DB->SelectArr("SELECT ap.nummer, ap.bezeichnung, ap.menge, (SELECT SUM(lp.menge) FROM lager_platz_inhalt lp WHERE lp.artikel=ap.artikel) as lager, 
          (SELECT SUM(lr.menge) FROM lager_reserviert lr WHERE lr.artikel=ap.artikel AND lr.datum>=NOW() AND lr.objekt!='lieferschein') as reserviert, 
          if(((SELECT SUM(lp.menge) FROM lager_platz_inhalt lp WHERE lp.artikel=ap.artikel) - (SELECT SUM(lr.menge) FROM lager_reserviert lr WHERE lr.artikel=ap.artikel AND lr.datum>=NOW() AND lr.objekt!='lieferschein') - ap.menge)>=0,'',
            ((SELECT SUM(lp.menge) FROM lager_platz_inhalt lp WHERE lp.artikel=ap.artikel) - (SELECT SUM(lr.menge) FROM lager_reserviert lr WHERE lr.artikel=ap.artikel AND lr.datum>=NOW() AND lr.objekt!='lieferschein') - ap.menge)
            ) as fehlend 
          FROM auftrag_position ap LEFT JOIN artikel a ON a.id=ap.artikel WHERE ap.auftrag='$auftrag' AND a.lagerartikel=1");

      foreach($arr as $value)
      {
        $artikel = $value[bezeichnung];
        $nummer = $value[nummer];
        $menge  = $value[menge];
        $lager  = $value[lager];
        $reserviert= $value[reserviert];

        if(($lager-$reserviert < $menge) && $auftragarr[$iauftrag]['liefertermin_ok']=="1")
        {
          $artikeltabelle .= "--Artikel: ".$artikel." (Nummer: $nummer) Menge: ".$menge."\n";
        }
        else 
        {
          $artikeltabelleliefertermin .= "--Artikel: ".$artikel." (Nummer: $nummer) Menge: ".$menge."\n";
        }
      }
    }

    if($artikeltabelle!="") $artikeltabelle ="Rückstand:\r\n".$artikeltabelle."\r\n";
    if($artikeltabelleliefertermin!="") $artikeltabelle .="Offene Aufträge:\r\n".$artikeltabelleliefertermin;

    $artikeltabelle = $this->ReadyForPDF($artikeltabelle); 

    if($artikeltabelle!="")
    {
      $text = 'Lieber Kunde,

        anbei übersenden wir Ihnen eine Liste mit den aktuell offenen Aufträgen (Rückstand und Aufträge mit Liefertermin):

          '.$artikeltabelle.'

            Bei Fragen zu Lieferungen wenden Sie sich gerne an unser Kundensupport-Center.';

      $betreff = "Folgebestätigung für offene Aufträge";
      //$to = "sauter@embedded-projects.net";

      if($to!="" && $to_name!="")
        $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$to,$to_name,$betreff,$text,"",$projekt);
      //echo $text;
    }

  }





  function GetGeschaeftsBriefText($subjekt,$sprache="",$projekt="")
  {

    if($sprache!="deutsch" && $sprache!="englisch")
      $sprache = "deutsch";

    if($projekt > 0)
      $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE subjekt='$subjekt' AND sprache='$sprache' AND projekt='$projekt' LIMIT 1");

    if($text == "")
      $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE subjekt='$subjekt' AND sprache='$sprache' AND (projekt='0' OR projekt='')  LIMIT 1");

    if($text == "")
      $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE subjekt='$subjekt' AND sprache='$sprache' LIMIT 1");

    $text = str_replace('{FIRMA}',$this->Firmendaten("name"),$text);

    return $text;
  }

  function GetGeschaeftsBriefBetreff($subjekt,$sprache="",$projekt="")
  {

    if($sprache!="deutsch" && $sprache!="englisch")
      $sprache = "deutsch";

    if($projekt > 0)
      $text = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE subjekt='$subjekt' AND sprache='$sprache' AND projekt='$projekt' LIMIT 1");

    if($text == "")
      $text = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE subjekt='$subjekt' AND sprache='$sprache' AND (projekt='0' OR projekt='')  LIMIT 1");

    if($text == "")
      $text = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE subjekt='$subjekt' AND sprache='$sprache' LIMIT 1");

    $text = str_replace('{FIRMA}',$this->Firmendaten("name"),$text);
    return $text;
  }

  function Stornomail($auftrag)
  {
    $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $stornomail = $this->app->DB->Select("SELECT stornomail FROM projekt WHERE id='$projekt' LIMIT 1");

    // KEINE STORNOMAIL
    if($stornomail!=1)
      return;


    $to = $this->app->DB->Select("SELECT email FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $to_name = $this->app->DB->Select("SELECT name FROM auftrag WHERE id='$auftrag' LIMIT 1");

    $parameter = $auftrag;

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $keinestornomail = $this->app->DB->Select("SELECT keinestornomail FROM auftrag WHERE id='$auftrag' LIMIT 1");

    if($belegnr>0 && $keinestornomail==0)
    {
      $text = $this->GetGeschaeftsBriefText('Stornierung','deutsch',$projekt);
      $betreff = $this->GetGeschaeftsBriefBetreff('Stornierung','deutsch',$projekt);
      //              $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE subjekt='Stornierung' AND sprache='deutsch' LIMIT 1");
      //              $betreff = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE subjekt='Stornierung' AND sprache='deutsch' LIMIT 1");

      $text= str_replace('{AUFTRAG}',$belegnr,$text);
      $text= str_replace('{GESAMT}',$this->app->DB->Select("SELECT gesamtsumme FROM auftrag WHERE id='$parameter' LIMIT 1"),$text);
      $text= str_replace('{DATUM}',$this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM auftrag WHERE id='$parameter' LIMIT 1"),$text);
      $text = str_replace('{FIRMA}',$this->Firmendaten("name"),$text);

      if($to!="" && $to_name!="")
        $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$to,$to_name,$betreff,$text,"",$projekt);

    } 
  }

  function ExportlinkZahlungsmail()
  {
    $exports = $this->app->DB->SelectArr("SELECT * FROM exportlink_sent WHERE mail='0'");

    for($i=0;$i<count($exports);$i++)
      //for($i=0;$i<5;$i++)
    {
      // mail
      $adresse = $exports[$i][adresse];
      $reg= $exports[$i][reg];
      $artikelid = $exports[$i][objekt];

      $to = $this->app->DB->Select("SELECT email FROM adresse WHERE id='$adresse' LIMIT 1");
      $to_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' LIMIT 1");
      $artikel = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikelid' LIMIT 1");

      $projekt=1;

      //      $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE subjekt='AlternativArtikel' AND sprache='deutsch' AND (projekt='$projekt' OR projekt='0') LIMIT 1");
      //     $betreff = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE subjekt='AlternativArtikel' AND sprache='deutsch' AND (projekt='$projekt' OR projekt='0') LIMIT 1");


      $text = $this->GetGeschaeftsBriefText('AlternativArtikel','deutsch',$projekt);
      $betreff = $this->GetGeschaeftsBriefBetreff('AlternativArtikel','deutsch',$projekt);

      $betreff = str_replace('[ARTIKEL]',$artikel,$betreff);
      $text= str_replace('[ARTIKEL]',$artikel,$text);
      $text = str_replace('[AUFTRAG]',$auftrag,$text);

      $text = str_replace('[REG]',$reg,$text);


      $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$to,$to_name,$betreff,$text,"",$projekt);
      echo $to_name." <".$to.">\r\n";

      $this->app->DB->Update("UPDATE exportlink_sent SET mail=1 WHERE reg='$reg' LIMIT 1");

    }
  }


  function AuftragZahlungsmail($id="",$force=0)
  {
    if(!is_numeric($id))
      $id = $this->app->Secure->GetGET("id");
    else $intern=1;

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $adresse= $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");

    $summeimauftrag = 0;
    $auftragssumme = $this->app->DB->Select("SELECT gesamtsumme FROM auftrag WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
    $zahlungsmail = $this->app->DB->Select("SELECT zahlungserinnerung FROM projekt WHERE id='$projekt' LIMIT 1");

    // sind vorbedingungen erfuellt?
    $vorbedinungen = 0;
    $zahlungsmailbedinungen = $this->app->DB->Select("SELECT zahlungsmailbedinungen FROM projekt WHERE id='$projekt' LIMIT 1");

    if(preg_match("/lager_ok/",$zahlungsmailbedinungen))
    {
      $lager_ok = $this->app->DB->Select("SELECT lager_ok FROM auftrag WHERE id='$id' LIMIT 1");
      if($lager_ok==0)
        $vorbedinungen++;
    }

    // Kundencheck
    if(preg_match("/check_ok/",$zahlungsmailbedinungen))
    {
      $check_ok = $this->app->DB->Select("SELECT check_ok FROM auftrag WHERE id='$id' LIMIT 1");
      if($check_ok==0)
        $vorbedinungen++;
    }

    //echo "zahlungsmail $zahlungsmail $vorbedinungen $auftragssumme $belegnr\r\n ";
    if(($zahlungsmail > 0) && ($vorbedinungen==0) && ($auftragssumme>0) && ($id>0))
    {
      //echo "verschickt";
      $this->Zahlungsmail($adresse,$auftragssumme-$summeimauftrag,$id,$force);
    }

    if($intern!=1)
    {
      header("Location: index.php?module=auftrag&action=edit&id=$id");
      exit;
    }

  }


  function AufgabenMail($aufgabe,$vorabankuendigung=false)
  {
    $arraufgabe = $this->app->DB->SelectArr("SELECT *,DATE_FORMAT(abgabe_bis,'%d.%m.%Y') as datum,
        DATE_FORMAT(abgabe_bis_zeit,'%H:%i') as zeit FROM aufgabe WHERE id='$aufgabe' LIMIT 1");

    $adresse = $arraufgabe[0]["adresse"];
    $adresse_initiator = $arraufgabe[0]["initiator"];

    $this->LogFile("sende an adresse ".$adresse);

    $to = $this->app->DB->Select("SELECT email FROM adresse WHERE id='$adresse' AND geloescht!=1 LIMIT 1");
    $to_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' AND geloescht!=1 LIMIT 1");

    $initiator_to = $this->app->DB->Select("SELECT email FROM adresse WHERE id='$adresse_initiator' AND geloescht!=1 LIMIT 1");
    $initiator_to_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse_initiator' AND geloescht!=1 LIMIT 1");

    $this->LogFile("Sende Aufgabe $aufgabe an Email ".$to." und Initiator ".$initiator_to);

    $aufgabe_name = $arraufgabe[0]["aufgabe"];
    $beschreibung = $arraufgabe[0]["beschreibung"];
    $datum = $arraufgabe[0]["datum"];
    $zeit = $arraufgabe[0]["zeit"];

    $text = "Aufgabe: $aufgabe_name\r\n\r\n";
    $text .= "Mitarbeiter: $to_name\r\n\r\n";
    $text .= "Abgabe bis: $datum $zeit Uhr\r\n";

    if($beschreibung!="")
      $text .= "Beschreibung: \r\n\r\n$beschreibung\r\n";

    if($vorabankuendigung)
    {
      $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$to,$to_name,"VORABERINNERUNG: ".$aufgabe_name,$text,"","",false);
      $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$initiator_to,$initiator_to_name,"INITIATOR VORABERINNERUNG: ".$aufgabe_name,$text,"","",false);
    }
    else
    {
      $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$to,$to_name,"ERINNERUNG: ".$aufgabe_name,$text,"","",false);
      $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$initiator_to,$initiator_to_name,"INITIATOR ERINNERUNG: ".$aufgabe_name,$text,"","",false);
    }
  }


  function Zahlungsmail($adresse,$rest="",$auftragid="",$force=0)
  {
    if(!is_numeric($auftragid))
      return;

    $to = $this->app->DB->Select("SELECT email FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
    $to_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

    //$to = ""; //DEBUG
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$auftragid' LIMIT 1");
    $internetnummer = $this->app->DB->Select("SELECT internet FROM auftrag WHERE id='$auftragid' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$auftragid' LIMIT 1");
    $zahlungsmail = $this->app->DB->Select("SELECT zahlungserinnerung FROM projekt WHERE id='$projekt' LIMIT 1");
    $zahlungsmailcounter = $this->app->DB->Select("SELECT zahlungsmailcounter FROM auftrag WHERE id='$auftragid' LIMIT 1");
    $check_adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$auftragid' LIMIT 1");


    // wenn der auftrag dem Kunden nicht gehört
    if($adresse!=$check_adresse) return;

    $gesamt = $this->app->DB->Select("SELECT gesamtsumme FROM auftrag WHERE id='$auftragid' LIMIT 1");

    if($rest!="")
    {

      //Falls projekt mail vorhanden sonst globalen firmen standard
      if($gesamt-$rest==0)
      {
        $text = $this->GetGeschaeftsBriefText('ZahlungMiss','deutsch',$projekt);
        $betreff = $this->GetGeschaeftsBriefBetreff('ZahlungMiss','deutsch',$projekt);
      } else {
        $text = $this->GetGeschaeftsBriefText('ZahlungDiff','deutsch',$projekt);
        $betreff = $this->GetGeschaeftsBriefBetreff('ZahlungDiff','deutsch',$projekt);
      }

      $rest = number_format($rest, 2, ',', '.');

      $text= str_replace('{REST}',$rest,$text);
      $betreff = str_replace('{FIRMA}',$this->Firmendaten("name"),$betreff);
      $text = str_replace('{FIRMA}',$this->Firmendaten("name"),$text);

      

      if($internetnummer>0)
        $text= str_replace('{AUFTRAG}',$internetnummer,$text);
      else
        $text= str_replace('{AUFTRAG}',$belegnr,$text);

      $text= str_replace('{GESAMT}',$this->app->DB->Select("SELECT gesamtsumme FROM auftrag WHERE id='$auftragid' LIMIT 1"),$text);
      $gesamtsummecheck = $rest;
      $text= str_replace('{DATUM}',$this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM auftrag WHERE id='$auftragid' LIMIT 1"),$text);

    } else 
    {
      //TODO nette mail wenn kunde keine vorkasse macht, warum er das nicht macht etc.
      $text = $this->GetGeschaeftsBriefText('ZahlungOK','deutsch',$projekt);
      $betreff = $this->GetGeschaeftsBriefBetreff('ZahlungOK','deutsch',$projekt);

      $gesamtsumme = $this->app->DB->Select("SELECT gesamtsumme FROM auftrag WHERE id='$auftragid' LIMIT 1");

      $text= str_replace('{AUFTRAG}',$belegnr,$text);
      $text= str_replace('{GESAMT}',$gesamtsumme,$text);
      $gesamtsummecheck = $gesamtsumme;
      $text= str_replace('{DATUM}',$this->app->DB->Select("SELECT DATE_FORMAT(datum,'%d.%m.%Y') FROM kontoauszuege_zahlungseingang WHERE objekt='auftrag' AND parameter='$auftragid' LIMIT 1"),$text);
    }

    $zahlungsmailauftrag = $this->app->DB->Select("SELECT zahlungsmail FROM auftrag WHERE id='$auftragid' LIMIT 1");

    //$tage = ceil((mktime($zahlungsmailauftrag) - time())/60/60/24);
    $tage = $this->app->DB->Select("SELECT DATEDIFF(NOW(),'$zahlungsmailauftrag')");

    //echo "Tage $tage $to_name mail $zahlungsmail datum $zahlungsmailauftrag<br>";

    if($to!="" && $to_name!="" && $zahlungsmail=="1" && ($tage > 6 || $zahlungsmailauftrag=="0000-00-00" || $force==1))
    {
      $zahlungsmailcounter++;
      $this->app->DB->Update("UPDATE auftrag SET zahlungsmail=NOW(),zahlungsmailcounter='$zahlungsmailcounter' WHERE id='$auftragid' LIMIT 1");
      // wenn differenz groesser als ein EUR
      if($gesamtsummecheck>1)
      {
        if($zahlungsmailcounter<2)
          $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$to,$to_name,$betreff,$text,"",$projekt);
        // automatisch Reservierungen entfernen
        else {
          if($tage > 11) {
            $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),
                $this->GetFirmaMail(),"Buchhaltung","Meldung fuer Buchhaltung: Offenen Auftrag $belegnr kl&auml;ren oder stornieren",$text,"",$projekt);
          }
        }
      }
      else { 
        $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$this->GetFirmaMail(),"Buchhaltung","Meldung fuer Buchhaltung: Bitte Skonto geben",$text,"",$projekt);
      }
    }

  }


  function Rechnungsmail($id)
  {
    // $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE subjekt='Versand' AND sprache='deutsch' LIMIT 1");
    // $betreff = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE subjekt='Versand' AND sprache='deutsch' LIMIT 1");
    $adresse = $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$id' LIMIT 1");
    $to = $this->app->DB->Select("SELECT email FROM rechnung WHERE id='$id'  LIMIT 1");
    $to_name = $this->app->DB->Select("SELECT name FROM rechnung WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM rechnung WHERE id='$id' LIMIT 1");

    $text = $this->GetGeschaeftsBriefText('Rechnung','deutsch',$projekt);
    $betreff = $this->GetGeschaeftsBriefBetreff('Rechnung','deutsch',$projekt);


    //   $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE subjekt='Rechnung' AND sprache='deutsch' LIMIT 1");
    //    $betreff = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE subjekt='Rechnung' AND sprache='deutsch' LIMIT 1");
    $text = str_replace('{NAME}',$to_name,$text);
    $text = str_replace('{BELEGNR}',$belegnr,$text);

    $betreff = str_replace('{NAME}',$to_name,$betreff);
    $betreff = str_replace('{BELEGNR}',$belegnr,$betreff);



    if($to!="" && $to_name!="")
    {
      $Brief = new RechnungPDF($this->app,$projekt);
      $Brief->GetRechnung($id);
      $tmpfile = $Brief->displayTMP();

      //$this->DokumentSendShow(TAB1,"rechnung",$rechnung,$adresse);
      // temp datei wieder loeschen

      $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$to,$to_name,$betreff,$text,array($tmpfile),$projekt);
      $this->RechnungProtokoll($id,"Rechnung versendet");

      unlink($tmpfile);

      // als versendet markieren
      $this->app->DB->Update("UPDATE rechnung SET status='versendet', versendet='1',schreibschutz='1' WHERE id='$id' LIMIT 1");
    }
  }

  function DokumentAbschicken()
  {
    $id = $this->app->Secure->GetGET("id");
    $frame = $this->app->Secure->GetGET("frame");

    $typ = $this->app->Secure->GetGET("module");

    if($frame=="")
    {
      $this->app->BuildNavigation=false;
      $this->app->Tpl->Set('TABTEXT',"Abschicken");

      $status = $this->app->DB->Select("SELECT status FROM $typ WHERE id='$id' LIMIT 1");
      $adresse = $this->app->DB->Select("SELECT adresse FROM $typ WHERE id='$id' LIMIT 1");
      $projekt = $this->app->DB->Select("SELECT projekt FROM $typ WHERE id='$id' LIMIT 1");

      if($projekt=="" || $projekt==0)
        $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");

      if($status !='angelegt')
      {
        //$this->app->Tpl->Set('TAB1',"<div class=\"warning\">Die Rechnung ist freigegeben und wurde noch nicht versendet!</div>");  
        $this->DokumentMask('TAB1',$typ,$id,$adresse,$projekt);
        //$this->RechnungProtokoll($id,"Rechnung per Mail versendet");
      } else
      {
        switch($typ)
        {
          case "rechnung": $this->app->Tpl->Set('TAB1',"<div class=\"error\">Die Rechnung wurde noch nicht freigegeben!</div>"); break;
          case "angebot": $this->app->Tpl->Set('TAB1',"<div class=\"error\">Das Angebot wurde noch nicht freigegeben!</div>"); break;
          case "auftrag": $this->app->Tpl->Set('TAB1',"<div class=\"error\">Der Auftrag wurde noch nicht freigegeben!</div>"); break;
          case "lieferschein": $this->app->Tpl->Set('TAB1',"<div class=\"error\">Der Lieferschein wurde noch nicht freigegeben!</div>"); break;
          case "bestellung": $this->app->Tpl->Set('TAB1',"<div class=\"error\">Die Bestellung wurde noch nicht freigegeben!</div>"); break;
          case "gutschrift": $this->app->Tpl->Set('TAB1',"<div class=\"error\">Die Gutschrift wurde noch nicht freigegeben!</div>"); break;
          case "arbeitsnachweis": $this->app->Tpl->Set('TAB1',"<div class=\"error\">Der Arbeitsnachweis wurde noch nicht freigegeben!</div>"); break;
        }
      }

      $id = $this->app->Tpl->Set('ID',$id);

      $this->app->Tpl->Parse('PAGE',"emptytab.tpl");

    } else {
      echo "<iframe width=\"100%\" height=\"600\" src=\"index.php?module=$typ&action=abschicken&id=$id\" frameborder=\"0\"></iframe>";
      exit;
    }

  }

  function VersandAbschluss($id)
  {
    $adresse = $this->app->DB->Select("SELECT adresse FROM versand WHERE id='$id' LIMIT 1");
    $lieferscheinid = $this->app->DB->Select("SELECT lieferschein FROM versand WHERE id='$id' LIMIT 1");
    $rechnung = $this->app->DB->Select("SELECT rechnung FROM versand WHERE id='$id' LIMIT 1");
    $rechnung_zahlweise = $this->app->DB->Select("SELECT zahlungsweise FROM rechnung WHERE id='$rechnung' LIMIT 1");
    $rechnung_projekt = $this->app->DB->Select("SELECT projekt FROM rechnung WHERE id='$rechnung' LIMIT 1");
    $auftrag = $this->app->DB->Select("SELECT auftragid FROM lieferschein WHERE id='$lieferscheinid' LIMIT 1");
    $auftragbelegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $auftraginternet = $this->app->DB->Select("SELECT internet FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $ihrebestellnummer = $this->app->DB->Select("SELECT ihrebestellnummer FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$lieferscheinid' LIMIT 1");

    // wenn shop dann rueckmelden
    $shop=$this->app->DB->Select("SELECT shop FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $auftragabgleich=$this->app->DB->Select("SELECT auftragabgleich FROM shopexport WHERE id='$shop' LIMIT 1");

    //$this->LogFile("Tracking Auftrag $auftrag Shop $shop");

    if($shop > 0 && $auftragabgleich=="1")
    {
      $this->LogFile("Tracking gescannt");
      $this->app->remote->RemoteUpdateAuftrag($shop,$auftrag);
    }

    if($rechnung_zahlweise=="billsafe")
    {
    } elseif($rechnung_zahlweise=="secupay")
    {
    }
  }

  function Versandmail($id)
  {
    //    $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE subjekt='Versand' AND sprache='deutsch' LIMIT 1");
    //    $betreff = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE subjekt='Versand' AND sprache='deutsch' LIMIT 1");

    $adresse = $this->app->DB->Select("SELECT adresse FROM versand WHERE id='$id' LIMIT 1");
    $lieferscheinid = $this->app->DB->Select("SELECT lieferschein FROM versand WHERE id='$id' LIMIT 1");
    $auftrag = $this->app->DB->Select("SELECT auftragid FROM lieferschein WHERE id='$lieferscheinid' LIMIT 1");
    $auftragbelegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $auftraginternet = $this->app->DB->Select("SELECT internet FROM auftrag WHERE id='$auftrag' LIMIT 1");
    $ihrebestellnummer = $this->app->DB->Select("SELECT ihrebestellnummer FROM auftrag WHERE id='$auftrag' LIMIT 1");

    $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$lieferscheinid' LIMIT 1");
    $to = $this->app->DB->Select("SELECT email FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
    $to_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

    $text = $this->GetGeschaeftsBriefText('Versand','deutsch',$projekt);
    $betreff = $this->GetGeschaeftsBriefBetreff('Versand','deutsch',$projekt);


    // wenn Ansprechpartner 
    $to_lieferschein_name = $this->app->DB->Select("SELECT ansprechpartner FROM lieferschein WHERE id='$lieferscheinid' LIMIT 1");
    $to_lieferschein_email = $this->app->DB->Select("SELECT email FROM lieferschein WHERE id='$lieferscheinid' LIMIT 1");

    if($to_lieferschein_email!=""){
      $to = $to_lieferschein_email;

      if($to_lieferschein_name!="")
        $to_name = $to_lieferschein_name;
    }

    $trackingsperre = $this->app->DB->Select("SELECT trackingsperre FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");


    $tracking = $this->app->DB->Select("SELECT tracking FROM versand WHERE id='$id' LIMIT 1");
    $keinetrackingmail = $this->app->DB->Select("SELECT keinetrackingmail FROM versand WHERE id='$id' LIMIT 1");
    $versandunternehmen = $this->app->DB->Select("SELECT versandunternehmen FROM versand WHERE id='$id' LIMIT 1");

    // FIX fuer selbstabholer Mail
    $versandart = $this->app->DB->Select("SELECT versandart FROM versand WHERE id='$id' LIMIT 1");
    if($versandart=="selbstabholer") $versandunternehmen="selbstabholer";

    $text = str_replace('{BELEGNR}',$auftragbelegnr,$text);
    $betreff = str_replace('{BELEGNR}',$auftragbelegnr,$betreff);

    $text = str_replace('{INTERNET}',$auftraginternet,$text);
    $betreff = str_replace('{INTERNET}',$auftraginternet,$betreff);

    $text = str_replace('{IHREBESTELLNUMMER}',$ihrebestellnummer,$text);
    $betreff = str_replace('{IHREBESTELLNUMMER}',$ihrebestellnummer,$betreff);

    if($versandunternehmen=="dhl" || $versandunternehmen=="dhlpremium" || $versandunternehmen=="intraship")
    {
      $text = str_replace('{VERSAND}','DHL Versand: '.$tracking.' (http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc='.$tracking.')',$text);
          $notsend = 0;
    }
          else if ($versandunternehmen=="dpd")
          {
          $text = str_replace('{VERSAND}','DPD Versand: '.$tracking.' (https://tracking.dpd.de/parcelstatus/?locale=de_DE&query='.$tracking.')',$text);
            $notsend = 0;
            }       
            else if ($versandunternehmen=="rma")
            {
            $notsend = 1;
            }
            else if($versandunternehmen=="selbstabholer")
            {
            $notsend = 0;
            // selbstabholer

            $text = $this->GetGeschaeftsBriefText('Selbstabholer','deutsch',$projekt);
            $betreff = $this->GetGeschaeftsBriefBetreff('Selbstabholer','deutsch',$projekt);

            //$text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE subjekt='Selbstabholer' AND sprache='deutsch' LIMIT 1");
            $text = str_replace('{VERSAND}','',$text);

            // nur wenn option gesetzt ist
            $selbstabholermail = $this->app->DB->Select("SELECT selbstabholermail FROM projekt WHERE id='$projekt' LIMIT 1");
            if($selbstabholermail!="1") $notsend = 1;
            } else {
              // bei allen anderen lieferarten keine mail
              $notsend = 1;
            }

          if($this->Projektdaten($projekt,"automailversandbestaetigung")!="1")
            $notsend = 1;

          $text = str_replace('{NAME}',$to_name,$text);

          if($to!="" && $to_name!="" && $trackingsperre!=1 && $notsend==0 && $keinetrackingmail!=1)
          {
            $this->MailSend($this->GetFirmaMail(),$this->GetFirmaName(),$to,$to_name,$betreff,$text,"",$projekt);
          }
  }

  function Projektdaten($projekt,$feld)
  {
    return $this->app->DB->Select("SELECT $feld FROM projekt WHERE id='$projekt' LIMIT 1");
  }

  function DumpVar($variable)
  {
    ob_start();
    var_dump($variable);
    $result = ob_get_clean();
    file_put_contents($this->GetTMP()."/log", "$result\r\n", FILE_APPEND | LOCK_EX);
  }

  function VarAsString($variable)
  {
    ob_start();
    var_dump($variable);
    $result = ob_get_clean();
    return $result;
  }

  function ImportvorlageLog($importvorlage,$zeitstempel,$tabelle,$datensatz,$ersterdatensatz="0")
  {
    $this->app->DB->Insert("INSERT INTO importvorlage_log (id,importvorlage,zeitstempel,user,tabelle,datensatz,ersterdatensatz) 
        VALUES ('','$importvorlage',FROM_UNIXTIME($zeitstempel),'".$this->app->User->GetID()."',
          '$tabelle','$datensatz','$ersterdatensatz')");
  }

  function ImportvorlageLogDelete($zeitstempel)
  {
    $tmp = $this->app->DB->SelectArr("SELECT * FROM importvorlage_log WHERE zeitstempel='$zeitstempel' AND user='".$this->app->User->GetID()."'");
    for($i=0;$i<count($tmp);$i++)
    {
      $datensatz = $tmp[$i]['datensatz'];
      switch($tmp[$i]['tabelle'])
      {
        case "adresse":
          if($tmp[$i]['ersterdatensatz']=="1")
          {
            //naechste zu vergebene nummer richtig setzten
            $tmp_adresse = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$datensatz' LIMIT 1");
            $eigenernummernkreis = $this->app->DB->Select("SELECT eigenernummernkreis FROM projekt WHERE id='".$tmp_adresse[0]['projekt']."' LIMIT 1");

            if($eigenernummernkreis=="1")
            {
              if($tmp_adresse[0]['kundennummer']!="" && $tmp_adresse[0]['kundennummer']!="0")
              { 
                $this->app->DB->Update("UPDATE projekt SET next_kundennummer='".$tmp_adresse[0]['kundennummer']."' 
                    WHERE id='".$tmp_adresse[0]['projekt']."' LIMIT 1");
              }
              if($tmp_adresse[0]['lieferantennummer']!="" && $tmp_adresse[0]['lieferantennummer']!="0")
              {
                $this->app->DB->Update("UPDATE projekt SET next_lieferantennummer='".$tmp_adresse[0]['lieferantennummer']."' 
                    WHERE id='".$tmp_adresse[0]['projekt']."' LIMIT 1");
              }
              if($tmp_adresse[0]['mitarbeiternummer']!="" && $tmp_adresse[0]['mitarbeiternummer']!="0")
              {
                $this->app->DB->Update("UPDATE projekt SET next_mitarbeiternummer='".$tmp_adresse[0]['mitarbeiternummer']."' 
                    WHERE id='".$tmp_adresse[0]['projekt']."' LIMIT 1");
              }
            } else {
              if($tmp_adresse[0]['kundennummer']!="" && $tmp_adresse[0]['kundennummer']!="0")
              { 
                $this->FirmendatenSet("next_kundennummer",$tmp_adresse[0]['kundennummer']);
              }
              if($tmp_adresse[0]['lieferantennummer']!="" && $tmp_adresse[0]['lieferantennummer']!="0")
              {
                $this->FirmendatenSet("next_lieferantennummer",$tmp_adresse[0]['lieferantennummer']);
              }
              if($tmp_adresse[0]['mitarbeiternummer']!="" && $tmp_adresse[0]['mitarbeiternummer']!="0")
              {
                $this->FirmendatenSet("next_mitarbeiternummer",$tmp_adresse[0]['mitarbeiternummer']);
              }
            }
          }
          $this->app->DB->Delete("DELETE FROM adresse WHERE id='$datensatz'");
          $this->app->DB->Delete("DELETE FROM ansprechpartner WHERE adresse='$datensatz'");
          $this->app->DB->Delete("DELETE FROM lieferadressen WHERE adresse='$datensatz'");
          $this->app->DB->Delete("DELETE FROM adresse_rolle WHERE adresse='$datensatz'");
          break;

        case "artikel":

          break;

        case "einkaufspreise":

          break;



      }
      $this->app->DB->Delete("DELETE FROM importvorlage_log WHERE id='".$tmp[$i]['id']."'");
    }

  }


  function CreatePath($path) {
    if (file_exists($path))
    {
      return true;
    }
    $nextDirectoryPath = substr($path, 0, strrpos($path, '/', -2) + 1 );

    if($this->CreatePath($nextDirectoryPath) && is_writable($nextDirectoryPath))
    {
      return mkdir($path);
    }
    return false;
  }

  function ObjektProtokoll($objekt,$id,$action_long,$meldung="")
  {
    $bearbeiter = $this->app->User->GetName();

    $this->app->DB->Insert("INSERT INTO objekt_protokoll (id,objekt,objektid,meldung,zeitstempel,bearbeiter,action_long)
        VALUES ('','$objekt','$id','$meldung',NOW(),'$bearbeiter','$action_long')");

  }


  function InternesEvent($userid,$meldung,$type="",$sound=0)
  {
    $userid = $this->app->DB->Select("SELECT id FROM user WHERE id='$userid' AND activ=1");
    if($userid > 0)
    { 
      $this->app->DB->Insert("INSERT INTO interne_events (id,meldung,userid,sound,zeitstempel,type)
        VALUES ('','$meldung','$userid','$sound',NOW(),'$type')");
    }

    return $this->app->DB->GetInsertID();
  }

  function EventMitSystemLog($userid, $meldung, $level=-1,$dump="", $type = "", $sound=0, $module="", $action="",$functionname="")
  {
    $this->SystemLog($meldung, $level, $dump, $module, $action, $functionname);
    $this->InternesEvent($userid, $meldung, $type, $sound);
    
  }
  
  function SystemLog($meldung="",$level=0,$dump="",$module="",$action="",$functionname="")
  {
    if($module=="") $module = $this->app->Secure->GetGET("module");
    if($action=="") $action = $this->app->Secure->GetGET("action");
    if(!isset($id) || $id=="") $id = $this->app->Secure->GetGET("id");
    $argumente = "";
    if($functionname=="")
    {
      if (strnatcmp(phpversion(),'5.0.0') >= 0)
      {
        $backtrace = debug_backtrace();
        $functionname = $backtrace[1]['function'];
        if($functionname!="Run")
          $argumente = base64_encode(print_r($backtrace[1]['args'],true));
      }
    }

    $this->app->DB->Insert("INSERT INTO systemlog (id,module,action,meldung,dump,datum,bearbeiter,funktionsname,parameter,argumente,level) 
        VALUES ('','$module','$action','$meldung','$dump',NOW(),'".$this->app->User->GetName()."','$functionname','$id','$argumente','$level')");

    return $this->app->DB->GetInsertID();
  }


  function Protokoll($meldung="",$dump="",$module="",$action="",$functionname="")
  {
    if($module=="") $module = $this->app->Secure->GetGET("module");
    if($action=="") $action = $this->app->Secure->GetGET("action");
    if(!isset($id) ||$id=="") $id = $this->app->Secure->GetGET("id");
    if($functionname=="")
    {
      if (strnatcmp(phpversion(),'5.0.0') >= 0)
      {
        $backtrace = debug_backtrace();
        $functionname = $backtrace[1]['function'];
        if($functionname!="Run")
          $argumente = base64_encode(print_r($backtrace[1]['args'],true));
      }
    }
    if(!isset($argumente))$argumente = '';
    $this->app->DB->Insert("INSERT INTO protokoll (id,module,action,meldung,dump,datum,bearbeiter,funktionsname,parameter,argumente) 
        VALUES ('','$module','$action','$meldung','$dump',NOW(),'".$this->app->User->GetName()."','$functionname','$id','$argumente')");

    return $this->app->DB->GetInsertID();
  }
  
  function LogRamAndTime($meldung)
  {
    if(self::$lasttime == 0)self::$lasttime = microtime(true);
    $akttime = microtime(true);
    $this->LogFile( addslashes((memory_get_peak_usage(true) >> 20).  " MB ".(round($akttime - self::$lasttime ,3)  )." sek ".$meldung));
    
  }

  function LogFile($meldung,$dump="",$module="",$action="",$functionname="")
  {
    //if($module=="") $module = $this->app->Secure->GetGET("module");
    //if($action=="") $action = $this->app->Secure->GetGET("action");

    if($functionname=="")
    {
      if (strnatcmp(phpversion(),'5.0.0') >= 0)
      {
        $backtrace = debug_backtrace();
        $functionname = $backtrace[1]['function'];
      }
    }

    $this->app->DB->Insert("INSERT INTO logfile (id,module,action,meldung,dump,datum,bearbeiter,funktionsname) 
        VALUES ('','$module','$action','$meldung','$dump',NOW(),'','$functionname')");

    return $this->app->DB->GetInsertID();
  }


  function KundeUpdate($adresse,$typ,$name,$abteilung,$unterabteilung,$ansprechpartner,$adresszusatz,$strasse,$land,$plz,$ort,$email,$telefon,$telefax,$ustid,$partner,$projekt)
  {
    //echo "Upate";
    $fields = array('typ','name','abteilung','unterabteilung','ansprechpartner','adresszusatz','strasse','land','plz',
        'ort','email','telefon','telefax','ustid','partner','projekt');

    foreach($fields as $key)
    {
      $check = $this->app->DB->Select("SELECT $key FROM adresse WHERE id='$adresse' LIMI 1");
      if($check!=${$key})
      {
        //                              echo "UPDATE adresse SET $key='".${$key}."' WHERE id='$adresse' LIMIT 1";
        $this->app->DB->Update("UPDATE adresse SET $key='".${$key}."' WHERE id='$adresse' LIMIT 1");
        // Protokoll    

        //echo "UPDATE adresse SET logfile=CONCAT(logfile,'Update Feld $key: $check (alt) ".${$key}." (neu)') WHERE id='$adresse' LIMIT 1";
        $logfile = $this->app->DB->Select("SELECT `logfile` FROM adresse WHERE id='$adresse' LIMIT 1");
        $this->app->DB->Update("UPDATE adresse SET `logfile`='".$logfile." Update Feld $key alt:$check neu:".${$key}.";' WHERE id='$adresse' LIMIT 1");
      }

    }
    return $adresse;
  }

  function KundeAnlegen($typ,$name,$abteilung,$unterabteilung,$ansprechpartner,$adresszusatz,$strasse,$land,$plz,$ort,$email,$telefon,$telefax,$ustid,$partner,$projekt)
  {
    $this->app->DB->Insert("INSERT INTO adresse (id,typ,name,abteilung,unterabteilung,ansprechpartner,adresszusatz,strasse,land,plz,ort,email,telefon,telefax,ustid,partner,projekt,firma)
        VALUES('','$typ','$name','$abteilung','$unterabteilung','$ansprechpartner','$adresszusatz','$strasse','$land','$plz','$ort','$email','$telefon','$telefax','$ustid','$partner','$projekt','".$this->app->User->GetFirma()."')");
    $adresse = $this->app->DB->GetInsertID();


    //adresse Kundennummer verpassen
    $this->KundennummerVergeben($adresse);

    $this->AddRolleZuAdresse($adresse, "Kunde", "von", "Projekt", $projekt);
    return $adresse;
  }

  function Steuerbefreit($land,$ustid)
  {
    if($land==$this->Firmendaten("land"))
      return false;

    foreach($this->GetUSTEU() as $euland)
    { 
      if($land==$euland && $ustid!="")
        return true;
      else if ($land==$euland && $ustid=="")
        return false;
    }

    // alle anderen laender sind export!
    return true;
  }


  function ImportAuftrag($adresse,$warenkorb,$projekt,$shop="")
  {
    //abweichende lieferadresse gibt es diese schon? wenn nicht zusätzlich in DB anlegen
    //$warenkorb[abweichendelieferadresse];

    // geldformat sollte sein 1000000.99

    //CreateAuftrag
    $auftrag = $this->CreateAuftrag();
    $this->AuftragProtokoll($auftrag,"Auftrag importiert vom Shop");



    $this->LoadAuftragStandardwerte($auftrag,$adresse);
    /*
    //wenn komma und punkt vorhanden
    if(strpos($string,',')!==false && strpos($string,'.')!==false)
    {
    $warenkorb[gesamtsumme] = str_replace(".","",$warenkorb[gesamtsumme]);
    $warenkorb[gesamtsumme] = str_replace(",",".",$warenkorb[gesamtsumme]);
    } 

     */
    if(strpos($warenkorb['gesamtsumme'],',')!==false)
    {
      $warenkorb['gesamtsumme'] = str_replace(",",".",$warenkorb['gesamtsumme']);
    } 

    if(!$this->CheckDateValidate($warenkorb['lieferdatum'])) $warenkorb['lieferdatum']="";


    $vertrieb = "Online-Shop"; 
    /*
       foreach($warenkorb as $key=>$value)
       {
       if($key!="articlelist")
       $warenkorb[$key] = $this->ConvertForDB($warenkorb[$key]);
       }
     */

    if($warenkorb['lieferung']=="" || $warenkorb['lieferung']=="versandunternehmen")
      $versand = $this->Firmendaten("versandart");
    else 
      $versand = $warenkorb['lieferung'];

    if($warenkorb['lieferadresse_name']!="")
      $warenkorb['abweichendelieferadresse']="1";
    else
      $warenkorb['abweichendelieferadresse']="0";


    //belegnummer fuer auftrag erzeugen
    //    $belegnr = $this->app->DB->Select("SELECT MAX(belegnr) FROM auftrag WHERE firma='".$this->app->User->GetFirma()."'");
    //    if($belegnr <= 0) $belegnr = 200000; else $belegnr = $belegnr + 1;

    $belegnr = $this->GetNextNummer("auftrag",$projekt);

    if($warenkorb['bestellnummer']!="") $warenkorb['bestellnummer'] = "Ihre Bestellnummer: ".$warenkorb['bestellnummer'];

    if($this->Steuerbefreit($warenkorb['land'],$warenkorb['ustid']))
      $ust_befreit=1;
    else
      $ust_befreit=0;

    if($this->Export($warenkorb['land']))
      $ust_befreit=2;

    //TODO LAND Firma
    if($warenkorb['abweichendelieferadresse']=="1" && $warenkorb['lieferadresse_land']==$this->Firmendaten("land"))
    {
      $ust_befreit=0;
    }

    // E-Mail Adresse auf aktuellesten Stand bringen
    if($warenkorb['email']!="")
      $this->app->DB->Update("UPDATE adresse SET email='".$warenkorb['email']."' WHERE id='".$adresse."' LIMIT 1");

    if($warenkorb['zahlungsweise']=="Amazoncba") $warenkorb['zahlungsweise']="amazon";

    $vorabbezahltmarkieren_ohnevorkasse_bar = $this->app->DB->Select("SELECT vorabbezahltmarkieren_ohnevorkasse_bar FROM shopexport WHERE id='$shop' LIMIT 1");

    if($vorabbezahltmarkieren_ohnevorkasse_bar=="1" && ($warenkorb['zahlungsweise']!="rechnung" && $warenkorb['zahlungsweise']!="nachnahme" 
          && $warenkorb['zahlungsweise']!="bar" && $warenkorb['zahlungsweise']!="vorkasse" && $warenkorb['zahlungsweise']!="paypal"))
    {
      $warenkorb['vorabbezahltmarkieren']="1"; 
    }

    if($warenkorb['vorabbezahltmarkieren']!="1") $warenkorb['vorabbezahltmarkieren']="0";

    if($warenkorb['bestellnummer']!="")
      $warenkorb['freitext'] .= "\r\n".$warenkorb['bestellnummer'];

    $this->app->DB->Update("UPDATE auftrag SET
        belegnr='$belegnr',
        datum='{$warenkorb['bestelldatum']}',
        lieferdatum='{$warenkorb['lieferdatum']}',
        ustid='{$warenkorb['ustid']}',
        ust_befreit='{$ust_befreit}',
        internet='{$warenkorb['onlinebestellnummer']}',
        transaktionsnummer='{$warenkorb['transaktionsnummer']}',
        versandart='{$versand}',                               
        vertrieb='{$vertrieb}',
        zahlungsweise='{$warenkorb['zahlungsweise']}',
        freitext='{$warenkorb['freitext']}',
        bank_inhaber='{$warenkorb['kontoinhaber']}',
        bank_institut='{$warenkorb['bank']}',
        bank_blz='{$warenkorb['blz']}',
        bank_konto='{$warenkorb['kontonummer']}',
        vorabbezahltmarkieren='{$warenkorb['vorabbezahltmarkieren']}',
        autoversand='1',
        abweichendelieferadresse='{$warenkorb['abweichendelieferadresse']}',
        ansprechpartner='{$warenkorb['ansprechpartner']}',
        liefername='{$warenkorb['lieferadresse_name']}',
        lieferland='{$warenkorb['lieferadresse_land']}',
        lieferstrasse='{$warenkorb['lieferadresse_strasse']}',
        lieferabteilung='{$warenkorb['lieferadresse_abteilung']}',
        lieferunterabteilung='{$warenkorb['lieferadresse_unterabteilung']}',
        lieferansprechpartner='{$warenkorb['lieferadresse_ansprechpartner']}',
        lieferort='{$warenkorb['lieferadresse_ort']}',
        lieferplz='{$warenkorb['lieferadresse_plz']}',
        lieferadresszusatz='{$warenkorb['lieferadresse_adresszusatz']}',
        packstation_inhaber='{$warenkorb['packstation_inhaber']}',
        packstation_station='{$warenkorb['packstation_nummer']}',
        packstation_ident='{$warenkorb['packstation_postidentnummer']}',
        packstation_plz='{$warenkorb['packstation_plz']}',
        packstation_ort='{$warenkorb['packstation_ort']}',
        partnerid='{$warenkorb['affiliate_ref']}',
        kennen='{$warenkorb['kennen']}',
        status='freigegeben',
        projekt='$projekt',
        shop='$shop',
        gesamtsumme='{$warenkorb['gesamtsumme']}' WHERE id='$auftrag'");

    if(is_numeric($shop)){
      $shoptyp = $this->app->DB->Select("SELECT typ FROM shopexport WHERE id='$shop' LIMIT 1");
      $artikelimport = $this->app->DB->Select("SELECT artikelimport FROM shopexport WHERE id='$shop' LIMIT 1");
      $artikelimporteinzeln = $this->app->DB->Select("SELECT artikelimporteinzeln FROM shopexport WHERE id='$shop' LIMIT 1");
      $projekt = $this->app->DB->Select("SELECT projekt FROM shopexport WHERE id='$shop' LIMIT 1");
      $multiprojekt = $this->app->DB->Select("SELECT multiprojekt FROM shopexport WHERE id='$shop' LIMIT 1");
      $artikelnummernummerkreis = $this->app->DB->Select("SELECT artikelnummernummerkreis FROM shopexport WHERE id='$shop' LIMIT 1");
      $shopbezeichnung = $this->app->DB->Select("SELECT bezeichnung FROM shopexport WHERE id='$shop' LIMIT 1");
    }       

    //artikelpositionen buchen
    foreach($warenkorb['articlelist'] as $key=>$value)
    {
      // wenn es das produkt in dem projekt gibt
      $artikelimporteinzelngesetzt = $this->app->DB->Select("SELECT autoabgleicherlaubt FROM artikel WHERE nummer='{$value['articleid']}' AND projekt='$projekt' LIMIT 1");

      // pruefe ob auftrag auf anderes projekt gestellt werden muss
      if($multiprojekt=="1")
      {
        $artikelprojekt = $this->app->DB->Select("SELECT projekt FROM artikel WHERE nummer='{$value['articleid']}' LIMIT 1");// AND //TODO BENE
        if($artikelprojekt > 0)
        {
          $projekt = $artikelprojekt;
        }
      }
      else
        $artikelprojekt = $this->app->DB->Select("SELECT projekt FROM artikel WHERE nummer='{$value['articleid']}' AND projekt='$projekt' LIMIT 1");// AND //TODO BENE

      $zwangsprojekt = $this->app->DB->Select("SELECT shopzwangsprojekt FROM projekt WHERE id='$artikelprojekt' LIMIT 1");

      if($zwangsprojekt==1)
      {
        $this->app->DB->Update("UPDATE auftrag SET projekt='$artikelprojekt' WHERE id='$auftrag'");
      }
      
      
      $extart = $this->app->DB->Select("SELECT artikelnummernummerkreis FROM shopexport WHERE id = '$shop'");
      if($extart)
      
    
      
      $eigenernummernkreis = $this->app->DB->Select("SELECT eigenernummernkreis FROM projekt WHERE id='$projekt' LIMIT 1");
      if($multiprojekt=="1" || !$eigenernummernkreis)
        $j_id = $this->app->DB->Select("SELECT a.id FROM artikelnummer_fremdnummern af INNER JOIN artikel a on af.artikel = a.id WHERE af.nummer='{$value['articleid']}' AND af.aktiv = 1 LIMIT 1");  //TODO BENE
      else
        $j_id = $this->app->DB->Select("SELECT a.id FROM artikelnummer_fremdnummern af INNER JOIN artikel a on af.artikel = a.id WHERE af.nummer='{$value['articleid']}' AND af.aktiv = 1 AND a.projekt='$projekt' LIMIT 1");
      
      if(!$j_id)
      {
        //$j_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='{$value[articleid]}' AND (shop='$shop' OR shop2='$shop' OR shop3='$shop') LIMIT 1"); 
        if($multiprojekt=="1" || !$eigenernummernkreis)
          $j_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='{$value['articleid']}' LIMIT 1");  //TODO BENE
        else
          $j_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='{$value['articleid']}' AND projekt='$projekt' LIMIT 1");  //TODO BENE
      }
      
      $check = false;
      if($j_id)
      {
        $check = $this->app->DB->Select("SELECT id FROM verkaufspreise WHERE artikel='$j_id' 
            AND (gueltig_bis='0000-00-00' OR gueltig_bis >=NOW()) AND ab_menge=1 
            AND ((objekt='Standard' AND adresse=0) OR (objekt='' AND adresse=0)) AND geloescht=0 LIMIT 1");
      }

      
      if($eigenernummernkreis)
      {
        $j_umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id = '$j_id' LIMIT 1");
      } else {
        $j_umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id = '$j_id' LIMIT 1");
      }
  
      if($artikelimport || ($artikelimporteinzeln && $artikelimporteinzelngesetzt))
      {
        if(isset($value['umsatzsteuer']))
        {
          $j_umsatzsteuer = $value['umsatzsteuer'];
        }elseif(isset($value['steuersatz']))
        {

          if(round((float)str_replace(',','.',$value['steuersatz']),2) == 7 || round(1+round((float)str_replace(',','.',$value['steuersatz']),2)/100,2) == round($this->GetSteuersatzErmaessigt(true,$auftrag,"auftrag"),2))
          {
            $j_umsatzsteuer="ermaessigt";
          }
        }
        if(isset($value['variante_von']) && $value['variante_von'])
        {
          if($multiprojekt=="1" || !$eigenernummernkreis)
            $varj_id = $this->app->DB->Select("SELECT a.id FROM artikelnummer_fremdnummern af INNER JOIN artikel a on af.artikel = a.id WHERE af.nummer='{$value['variante_von']}' AND af.aktiv = 1 LIMIT 1");  
          else
            $varj_id = $this->app->DB->Select("SELECT a.id FROM artikelnummer_fremdnummern af INNER JOIN artikel a on af.artikel = a.id WHERE af.nummer='{$value['variante_von']}' AND af.aktiv = 1 AND a.projekt='$projekt' LIMIT 1");           
          if(!$varj_id)
          {
            if($multiprojekt=="1" || !$eigenernummernkreis)
              $varj_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='{$value['variante_von']}' LIMIT 1");  
            else
              $varj_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='{$value['variante_von']}' AND projekt='$projekt' LIMIT 1"); 
          }
          
          if(!$varj_id)
          {
            if(isset($dataart))unset($dataart);
            if($artikelnummernummerkreis)
            {
              $variante_von = $value['variante_von'];
              $value['variante_von'] = $this->GetNextArtikelnummer("produkt", 1, $projekt);
            }
            $dataart['nummer'] = $value['variante_von'];
            $dataart['generierenummerbeioption'] = 1;
            $dataart['variante'] = 1;
            $dataart['projekt'] = $projekt;
            $dataart['art'] = "produkt";
            if($j_umsatzsteuer=="ermaessigt")$dataart['umsatzsteuer'] = "ermaessigt";
            $dataart['name_de'] = $value['variantename'];
            $dataart['kurztext_de'] = $value['variantekurztext_de'];
            $dataart['anabregs_text'] = $value['varianteanabregs_text'];
            $dataart['metakeywords_de'] = $value['variantemetakeywords_de'];
            $dataart['metadescription_de'] = $value['variantemetadescription_de'];
            $varj_id = $this->AddArtikel($dataart);
            if($varj_id && $artikelnummernummerkreis)
            {
              $this->app->DB->Insert("INSERT INTO artikelnummer_fremdnummern (artikel, aktiv, nummer, bearbeiter,bezeichnung,shopid) VALUES ('".$varj_id."','1','".$this->app->DB->real_escape_string($variante_von)."','".$this->app->DB->real_escape_string($this->app->User->GetName())."','".$this->app->DB->real_escape_string($shopbezeichnung)."','$shop')");
            }
            $this->AddVerkaufspreis($varj_id, 1, 0, $value['varianteprice']);
            $value['articleid'] = $this->GetNextArtikelnummer("produkt", 1, $projekt);
          } else {
            $generierenummerbeioption = $this->app->DB->Select("SELECT generierenummerbeioption from artikel where id = '$varj_id' LIMIT 1");
            $generierenummerbeioption = 1;
            if($generierenummerbeioption)$value['articleid'] = $this->GetNextArtikelnummer("produkt", 1, $projekt);
          }
        }
        
        if((!isset($value['name']) || empty($value['name'])) && isset($value['name_de']) && !empty($value['name_de']))$value['name'] = $value['name_de'];
        
        if($warenkorb['steuerfrei']==1)
        {
          if($j_umsatzsteuer=="ermaessigt")
          {
            
            $ap = $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt, $value['articleid'],$value['quantity'],$value['name'],
                $value['price'],"ermaessigt",0,$shop,'EUR', $warenkorb['articlelist'][$key]);
          } else {
            
            $ap = $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt, $value['articleid'],$value['quantity'],$value['name'],
                $value['price'],"normal",0,$shop,'EUR', $warenkorb['articlelist'][$key]);
          }
        } else {
          if($j_umsatzsteuer=="ermaessigt")
          {
            
            $ap = $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt, $value['articleid'],$value['quantity'],$value['name'],
                $value['price']/$this->GetSteuersatzErmaessigt(true,$auftrag,"auftrag"),"ermaessigt",0,$shop,'EUR', $warenkorb['articlelist'][$key]);
          } else {
            
            $ap = $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt, $value['articleid'],$value['quantity'],$value['name'],
                $value['price']/$this->GetSteuersatzNormal(true,$auftrag,"auftrag"),"normal",0,$shop,'EUR', $warenkorb['articlelist'][$key]);
          }
        }
        if(!$ap)$this->LogFile("Fehler ".$value['articleid']);
        if(isset($value['variante_von']) && $value['variante_von'] && isset($varj_id) && $varj_id)
        {
          if($multiprojekt=="1")
            $neuj_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='{$value['articleid']}' LIMIT 1");  
          else
            $neuj_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='{$value['articleid']}' AND projekt='$projekt' LIMIT 1");  
          
          if($neuj_id)
          {
            $lieferant = $this->app->DB->Select("SELECT adresse FROM artikel WHERE id = '$varj_id' LIMIT 1");
            if($lieferant)
            {
              $this->app->DB->Update("UPDATE artikel set adresse = '$lieferant' WHERE id = '$neuj_id' LIMIT 1");
              $this->AddEinkaufspreis($neuj_id,1,$lieferant, $value['articleid'], $value['name'],0);
            }
            
            $this->app->DB->Update("UPDATE artikel set variante = 1, variante_von = '$varj_id' WHERE id = '$neuj_id' LIMIT 1");
          }
        }
        
        $ueberspringe = true;
        foreach($warenkorb['articlelist'] as $key2=>$value2)
        {
          if($ueberspringe)
          {
            if($key == $key2)$ueberspringe = false;
          }else{
            if(isset($value['posid']))
            {
              if(isset($value2['parentid']) && $value2['parentid'] == $value['posid'])
              {
                $warenkorb['articlelist'][$key2]['parentap'] = $ap;
              }
            }
          }
        }
      } else if ($check > 0)
      {
        // standardpreis aus wawision verwenden
        $anummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id = '$j_id' LIMIT 1");
        if($anummer)$value['articleid'] = $anummer;
        $this->LogFile("5 ". $value['articleid']);
        $ap = $this->AddAuftragPositionNummer($auftrag,$value['articleid'],$value['quantity'],$projekt,"",true, "", $warenkorb['articlelist'][$key]);
        $ueberspringe = true;
        foreach($warenkorb['articlelist'] as $key2=>$value2)
        {
          if($ueberspringe)
          {
            if($key == $key2)$ueberspringe = false;
          }else{
            if(isset($value['posid']))
            {
              if(isset($value2['parentid']) && $value2['parentid'] == $value['posid'])
              {
                $warenkorb[$key2]['parentap'] = $ap;
              }
            }            
          }
        }
      }
      else {
        // fehler
          $this->AuftragProtokoll($auftrag,"Artikel nach Import nicht in interner Datenbank gefunden (Artikel: $j_nummer $j_name  Menge: $j_menge Preis: $j_preis) bzw. kein Verkaufspreis vorhanden.");

      }

/*
      // wenn es einen Preis gibt
      if($check > 0)
      {
        if($this->Steuerbefreit($warenkorb['land'],$warenkorb['ustid']))
        {
          if($artikelimport || ($artikelimporteinzeln && $artikelimporteinzelngesetzt))
          {
            //$this->DumpVar("FallAB");
            //TODO normal oder ermaessigt
            $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt,$value[articleid],$value[quantity],$value[name],
                $value[price],"normal",0,$shop);
          }
          else {
            //$this->DumpVar("FallCD");
            //pruefen ob es versandkosten sind $warenkorb[land] // $preis
            $this->AddAuftragPositionNummer($auftrag,$value[articleid],$value[quantity],$projekt,"",true);
          }
        }
        else
        {
          //pruefen ob es versandkosten sind $warenkorb[land] // $preis
          if($artikelimport || ($artikelimporteinzeln && $artikelimporteinzelngesetzt))
          {
            //TODO normal oder ermaessigt
            //$this->DumpVar("FallEF");
            $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt, $value[articleid],$value[quantity],$value[name],
                $value[price]/$this->GetSteuersatzNormal(true,$auftrag,"auftrag"),"normal",0,$shop);
          } else {
            //pruefen ob es versandkosten sind $warenkorb[land] // $preis
            //$this->DumpVar("FallGH");
            $this->AddAuftragPositionNummer($auftrag,$value[articleid],$value[quantity],$projekt,"");
          }
        }

        $this->AddAuftragPositionNummerPartnerprogramm($auftrag,$value[articleid],$value[quantity],$projekt,$warenkorb[affiliate_ref]);
      }
*/
/*
      else // keinen Verkaufspreis fuer den artikel gefunden
      {
          
        $j_nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE nummer='{$value[articleid]}' AND nummer!='' LIMIT 1");
        $j_name = $this->app->DB->Select("SELECT name_de FROM artikel WHERE nummer='{$value[articleid]}' AND nummer!='' LIMIT 1");
        $j_projekt = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='{$projekt}' LIMIT 1");
        $j_menge = $value[quantity];
        $j_preis = $value[price];

        // neue logik immer netto machen
         
        if($artikelimport || ($artikelimporteinzeln && $artikelimporteinzelngesetzt))
        {
          //$this->DumpVar("Fall6");
          //TODO normal oder ermaessigt
          if($j_umsatzsteuer=="ermaessigt")
          {
            $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt, $value[articleid],$value[quantity],$value[name],
              $value[price]/$this->GetSteuersatzErmaessigt(true,$auftrag,"auftrag"),"normal",0,$shop);
          } else {
            $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt, $value[articleid],$value[quantity],$value[name],
              $value[price]/$this->GetSteuersatzNormal(true,$auftrag,"auftrag"),"normal",0,$shop);
          }
        }
*/ 
/*
        if($this->Steuerbefreit($warenkorb['land'],$warenkorb['ustid']))
        {
          //pruefen ob es versandkosten sind $warenkorb[land] // $preis
          if($artikelimport || ($artikelimporteinzeln && $artikelimporteinzelngesetzt))
          {
            //$this->DumpVar("Fall5");
            //TODO normal oder ermaessigt
            $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt,$value[articleid],$value[quantity],$value[name],
                $value[price],"normal",0,$shop);
          }
        }
        else
        {
          //pruefen ob es versandkosten sind $warenkorb[land] // $preis
          if($artikelimport || ($artikelimporteinzeln && $artikelimporteinzelngesetzt))
          {
            //$this->DumpVar("Fall6");
            //TODO normal oder ermaessigt
            $this->AddPositionManuellPreisNummer("auftrag",$auftrag, $projekt, $value[articleid],$value[quantity],$value[name],
                $value[price]/$this->GetSteuersatzNormal(true,$auftrag,"auftrag"),"normal",0,$shop);
          }
        }
*/
/*
        $this->AddAuftragPositionNummerPartnerprogramm($auftrag,$value[articleid],$value[quantity],$projekt,$warenkorb[affiliate_ref]);

        $this->AuftragProtokoll($auftrag,"Artikel nach Import nicht in interner Datenbank gefunden (Artikel: $j_nummer $j_name  Menge: $j_menge Preis: $j_preis) bzw. kein Verkaufspreis vorhanden.");
      }
*/
    }

    if($shoptyp!="wawision")
    {
      if($warenkorb['zahlungsweise']=="nachnahme")
      {
        $artikelnachnahme = $this->app->DB->Select("SELECT artikelnachnahme FROM shopexport WHERE id='$shop' LIMIT 1");
        $artikelnachnahme_extraartikel = $this->app->DB->Select("SELECT artikelnachnahme_extraartikel FROM shopexport WHERE id='$shop' LIMIT 1");
        $nachnahme = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikelnachnahme' LIMIT 1");
        $umsatzsteuer_nachnahme = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id='$artikelnachnahme' LIMIT 1");
        $nachnahmepreis = $this->GetVerkaufspreis($artikelnachnahme,1); 

        if($umsatzsteuer_nachnahme!="ermaessigt") $umsatzsteuer_nachnahme="normal";

        //$warenkorb['zahlungsgebuehr'] //TODO

        if($artikelnachnahme_extraartikel==1)
        {
          $tmpposid = $this->AddPositionManuellPreis("auftrag",$auftrag, $artikelnachnahme,1,$nachnahme,$nachnahmepreis,$umsatzsteuer_nachnahme);
          if($tmpposid>0)
            $this->app->DB->Update("UPDATE auftrag_position SET keinrabatterlaubt=1 WHERE id='$tmpposid' LIMIT 1");
        }
      } else {
        $nachnahmepreis=0;
      }

      //porto und nachnahme
      $artikelporto = $this->app->DB->Select("SELECT artikelporto FROM shopexport WHERE id='$shop' LIMIT 1");
      $versandname = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikelporto' LIMIT 1");
      $umsatzsteuer_porto = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id='$artikelporto' LIMIT 1");
      //$this->DumpVar("Fall Porto Preis ".$warenkorb[versandkostennetto]);

      if($umsatzsteuer_porto!="ermaessigt") $umsatzsteuer_porto="normal";

      //if($this->Steuerbefreit($warenkorb['land'],$warenkorb['ustid']))
      if($warenkorb['steuerfrei']=="1")
      {
        if($artikelnachnahme_extraartikel=="1")
                $tmpposid = $this->AddPositionManuellPreis("auftrag",$auftrag, $artikelporto,1,$versandname,$warenkorb['versandkostennetto']-$nachnahmepreis,$umsatzsteuer_porto);
        else
                $tmpposid = $this->AddPositionManuellPreis("auftrag",$auftrag, $artikelporto,1,$versandname,$warenkorb['versandkostennetto'],$umsatzsteuer_porto);
      }
      else
      {
        if($umsatzsteuer_porto=="ermaessigt")
        { 
        if($artikelnachnahme_extraartikel=="1")
        {
                $tmpposid = $this->AddPositionManuellPreis("auftrag",$auftrag, $artikelporto,1,$versandname,                
                        ($warenkorb['versandkostenbrutto']/$this->GetSteuersatzErmaessigt(true,$auftrag,"auftrag"))- $nachnahmepreis,$umsatzsteuer_porto);
        } else {
                $tmpposid = $this->AddPositionManuellPreis("auftrag",$auftrag, $artikelporto,1,$versandname,
                        ($warenkorb['versandkostenbrutto']/$this->GetSteuersatzErmaessigt(true,$auftrag,"auftrag")),$umsatzsteuer_porto);
        }
        } else {
          //normal
        if($artikelnachnahme_extraartikel=="1")
        {
                $tmpposid = $this->AddPositionManuellPreis("auftrag",$auftrag, $artikelporto,1,$versandname,                
                        ($warenkorb['versandkostenbrutto']/$this->GetSteuersatzNormal(true,$auftrag,"auftrag"))- $nachnahmepreis,$umsatzsteuer_porto);
        } else {
                $tmpposid = $this->AddPositionManuellPreis("auftrag",$auftrag, $artikelporto,1,$versandname,
                        ($warenkorb['versandkostenbrutto']/$this->GetSteuersatzNormal(true,$auftrag,"auftrag")),$umsatzsteuer_porto);
        }
        }

      }

      // wenn versandkostennbrutto = 0 und versandkostennetto > 0 TODO neu ausrechnen

      if($tmpposid>0)
        $this->app->DB->Update("UPDATE auftrag_position SET keinrabatterlaubt=1 WHERE id='$tmpposid' LIMIT 1");
    }
    $shoptyp="";



    // wenn reservierung aktiviert ist
    $reservierung = $this->app->DB->Select("SELECT reservierung FROM projekt WHERE id='$projekt' LIMIT 1");
    if($reservierung>=1)
      $this->AuftragReservieren($auftrag);

    $this->AuftragNeuberechnen($auftrag);
    $this->AuftragEinzelnBerechnen($auftrag);

    return $auftrag;
  }


  function KundennummerVergeben($adresse,$projekt="")
  {
    $id = $adresse;
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    $tmp_data_adresse = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    $tmp_data_adresse = reset($tmp_data_adresse);

    if($projekt=="")
      $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");

    if($kundennummer==0 || $kundennummer==""){
      // pruefe ob rolle kunden vorhanden
      $check = $this->app->DB->Select("SELECT adresse FROM adresse_rolle WHERE adresse='$id' AND subjekt='Kunde' LIMIT 1");
      if($check!="")
      {
        $kundennummer = $this->GetNextKundennummer($projekt,$tmp_data_adresse);
        $this->ObjektProtokoll("adresse",$id,"adresse_next_kundennummer","Kundennummer erhalten: $kundennummer");
        $this->app->DB->Update("UPDATE adresse SET kundennummer='$kundennummer' WHERE id='$id' AND (kundennummer='0' OR kundennummer='') LIMIT 1");
        return $kundennummer;
      } 
    }
  }

  
  function CheckDateValidate($input="0000-00-00")
  {
    $date_format = 'Y-m-d';

    $input = trim($input);
    $time = strtotime($input);

    $is_valid = date($date_format, $time) == $input;

    return $is_valid;
  }

  function AdresseUSTCheck($adresse)
  {
    //wenn land DE

    $land = $this->app->DB->Select("SELECT land FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
    if($land ==$this->Firmendaten("land") || $land=="")
      return 0;

    foreach($this->GetUSTEU() as $euland)
    { 
      if($land==$euland)
        return 1;
    }

    // alle anderen laender sind export!
    return 2;


    //wenn land EU
    /*

       $ustid = $this->app->DB->Select("SELECT ustid FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
       if($ustid!="" && $land!="DE")
       return $this->AutoUSTPruefung($adresse);
     */

    return 1;
    // 0 wenn keine erfolgreiche pruefung heute da ist
  }


  function AutoUSTPruefung($adresse)
  {

    // schaue obs heute bereits eine pruefung gegeben hat die erfolgreich war
    $ustcheck = $this->app->DB->Select("SELECT id FROM ustprf WHERE DATE_FORMAT(datum_online,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d') AND status='erfolgreich' AND adresse='$adresse' LIMIT 1");
    if($ustcheck>0 && is_numeric($ustcheck))
      return 1;


    $name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1"); 
    $ustid = $this->app->DB->Select("SELECT ustid FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1"); 
    $land = $this->app->DB->Select("SELECT land FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1"); 
    $ort = $this->app->DB->Select("SELECT ort FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1"); 
    $plz = $this->app->DB->Select("SELECT plz FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1"); 
    $strasse  = $this->app->DB->Select("SELECT strasse FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1"); 

    if($land==$this->Firmendaten("land") || $ustid=="") return 0;


    $ustcheck = $this->app->DB->Select("SELECT id FROM ustprf WHERE status='' AND adresse='$adresse' LIMIT 1");
    if(!($ustcheck>0 && is_numeric($ustcheck))) 
    {
      $this->app->DB->Insert("INSERT INTO ustprf (id,adresse,name,ustid,land,ort,plz,rechtsform,strasse,datum_online,bearbeiter)
          VALUES('','$adresse','$name','$ustid','$land','$ort','$plz','$rechtsform','$strasse',NOW(),'".$this->app->User->GetName()."')");
      $ustprf_id = $this->app->DB->GetInsertID();
    }
    else
      $ustprf_id = $ustcheck;


    //$this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$ustprf_id.',"'.date("Y-m-d H:i:s").'","AUTO Pr&uuml;fung gestartet", "'.$this->app->User->GetName().'")');

    $ustid = str_replace(" ","",$ustid);
    $ust = $ustid;
    $result = 0;

    if(!$this->CheckUSTFormat($ust)){
      //$this->app->Tpl->Set(MESSAGE,"<div class=\"error\">UST-Nr. bzw. Format fuer Land ist nicht korrekt</div>");
      $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$ustprf_id.',"'.date("Y-m-d H:i:s").'","UST-Nr. bzw. Format fuer Land ist nicht korrekt", "'.$this->app->User->GetName().'")');
    }else{
      //$UstStatus = $this->CheckUst("DE263136143","SE556459933901","Wind River AB","Kista","Finlandsgatan 52","16493","nein");        

      $UstStatus = $this->CheckUst("DE263136143", $ust, $name, $ort, $strasse, $plz, $druck="nein");
      if(is_array($UstStatus))
      {
        $tmp = new USTID();
        $msg = $tmp->errormessages($UstStatus['ERROR_CODE']);

        if($UstStatus['ERROR_CODE']==200)
        {
          $this->app->DB->Delete("DELETE FROM ustprf_protokoll WHERE ustprf_id='$ustprf_id' AND bemerkung='UST g&uuml;ltig aber Name, Ort oder PLZ wird anders geschrieben'");
          $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$ustprf_id.',"'.date("Y-m-d H:i:s").'","UST g&uuml;ltig aber Name, Ort oder PLZ wird anders geschrieben", "'.$this->app->User->GetName().'")');
        }
        else
          $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$ustprf_id.',"'.date("Y-m-d H:i:s").'","'.$UstStatus['ERROR_CODE'].'('.$msg.')", "'.$this->app->User->GetName().'")');

      } else if($UstStatus==1){

        //$this->app->Tpl->Set(STATUS,"<div style=\"background-color: green;\">Vollst&auml;ndig</div>");
        $result = 1;

        // jetzt brief bestellen! 
        $UstStatus = $this->CheckUst("DE263136143", $ust, $firmenname, $ort, $strasse, $plz, $druck="ja");
        $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$ustprf_id.',"'.date("Y-m-d H:i:s").'","Online-Abfrage OK + Brief bestellt", "'.$this->app->User->GetName().'")');
        $this->app->DB->Update('UPDATE ustprf SET datum_online=NOW(), status="erfolgreich" WHERE id='.$ustprf_id.'');
      } else {
        $this->app->DB->Insert('INSERT INTO ustprf_protokoll (ustprf_id, zeit, bemerkung, bearbeiter)  VALUES ('.$ustprf_id.',"'.date("Y-m-d H:i:s").'","'.$UstStatus.'", "'.$this->app->User->GetName().'")');
        $this->app->DB->Update('UPDATE ustprf SET datum_online=NOW(), status="allgemeiner fehler" WHERE id='.$ustprf_id.'');
      }
    }


    return $result;
  }

  function ArtikelMindestlager($artikel)
  {
    // Fall ein 100R in vielen Listen dann muss man alle listen mit mindestmengen nehmen
    // Fall das ist eine 
    $mindestlager =  $this->app->DB->Select("SELECT mindestlager FROM artikel WHERE id='$artikel' LIMIT 1");
    if($mindestlager > 0)
    {
      return $mindestlager;
    } else {
      return 0;
    }
  }

  function AddChargeLagerOhneBewegung($artikel,$menge,$lagerplatz,$datum,$charge="",$internebemerkung="",$zid="")
  {
    for($i=0;$i<$menge;$i++)
    {
      $this->app->DB->Insert("INSERT INTO lager_charge (id,artikel,menge,lager_platz,datum,internebemerkung,charge,zwischenlagerid) VALUES ('','$artikel','1','$lagerplatz','$datum','$internebemerkung','$charge','$zid')");
    }

    //return $this->app->DB->GetInsertID();
  }


  function AddMindesthaltbarkeitsdatumLagerOhneBewegung($artikel,$menge,$lagerplatz,$mhd,$charge="",$zid="")
  {
    if ($mhd == '' || $mhd==0 || $mhd=='0000-00-00') {
      return false;
    }
    for($i=0;$i<$menge;$i++)
    {
      $this->app->DB->Insert("INSERT INTO lager_mindesthaltbarkeitsdatum (id,artikel,menge,lager_platz,datum,internebemerkung,charge,zwischenlagerid,mhddatum) VALUES ('','$artikel','1','$lagerplatz',NOW(),'$internebemerkung','$charge','$zid','$mhd')");
    }

    //return $this->app->DB->GetInsertID();
  }


  function AddChargeLager($artikel,$menge,$lagerplatz,$datum,$charge="",$internebemerkung="",$zid="")
  {
    $this->LagerArtikelZusammenfassen($artikel);
    for($i=0;$i<$menge;$i++)
    {
      $this->app->DB->Insert("INSERT INTO lager_charge (id,artikel,menge,lager_platz,datum,internebemerkung,charge,zwischenlagerid) VALUES ('','$artikel','1','$lagerplatz','$datum','$internebemerkung','$charge','$zid')");
    }
    $this->app->DB->Insert("INSERT INTO lager_platz_inhalt (id,artikel,menge,lager_platz) VALUES ('','$artikel','$menge','$lagerplatz')");

    $bestand = $this->ArtikelImLagerPlatz($artikel,$lagerplatz);
    $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz, artikel, menge,vpe, eingang,zeit,referenz, bearbeiter,projekt,firma,logdatei,bestand)
        VALUES('','$lagerplatz','$artikel','$menge','$vpe','1',NOW(),'Charge $charge eingelagert','".$this->app->User->GetName()."','$projekt',
          '".$this->app->User->GetFirma()."',NOW(),'$bestand')");

    $this->LagerArtikelZusammenfassen($artikel);
    //return $this->app->DB->GetInsertID();
  }


  function AddMindesthaltbarkeitsdatumLager($artikel,$menge,$lagerplatz,$mhd,$charge="",$zid="")
  {
    $this->LagerArtikelZusammenfassen($artikel);
    if ($mhd == '' || $mhd==0 || $mhd=='0000-00-00') {
      return false;
    }
    for($i=0;$i<$menge;$i++)
    {
      $this->app->DB->Insert("INSERT INTO lager_mindesthaltbarkeitsdatum (id,artikel,menge,lager_platz,datum,internebemerkung,charge,zwischenlagerid,mhddatum) VALUES ('','$artikel','1','$lagerplatz',NOW(),'$internebemerkung','$charge','$zid','$mhd')");
    }
    if($menge > 0)
    {
      $this->app->DB->Insert("INSERT INTO lager_platz_inhalt (id,artikel,menge,lager_platz) VALUES ('','$artikel','$menge','$lagerplatz')");
    }

    if($charge!="") $charge = " Charge: $charge";
    $bestand = $this->ArtikelImLagerPlatz($artikel,$lagerplatz);
    $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz, artikel, menge,vpe, eingang,zeit,referenz, bearbeiter,projekt,firma,logdatei,bestand)
        VALUES('','$lagerplatz','$artikel','$menge','$vpe','1',NOW(),'MHD eingelagert $charge','".$this->app->User->GetName()."',
          '$projekt','".$this->app->User->GetFirma()."',NOW(),'$bestand')");


    $this->LagerArtikelZusammenfassen($artikel);
    //return $this->app->DB->GetInsertID();
  }


  function LagerEinlagerVomZwischenlager($zwischenlagerid,$menge,$regal,$projekt,$grund="")
  {
    $this->LagerArtikelZusammenfassen($artikel);
    $artikel = $this->app->DB->Select("SELECT artikel FROM zwischenlager WHERE id='$zwischenlagerid' LIMIT 1");
    $referenz  = $this->app->DB->Select("SELECT grund FROM zwischenlager WHERE id='$zwischenlagerid' LIMIT 1");
    $vpe = $this->app->DB->Select("SELECT vpe FROM zwischenlager WHERE id='$zwischenlagerid' LIMIT 1");
    $bestellung = $this->app->DB->Select("SELECT parameter FROM zwischenlager WHERE id='$zwischenlagerid' LIMIT 1");

    if($menge > 0)
    {
      //if($zwischenlager=="" || $zwischenlagerid==0)
      //  return;

      // inhalt buchen
      $this->app->DB->Insert("INSERT INTO lager_platz_inhalt (id,lager_platz,artikel,menge,vpe,bearbeiter,bestellung,projekt,firma,logdatei)
          VALUES ('','$regal','$artikel','$menge','$vpe','".$this->app->User->GetName()."','$bestellung','$projekt','".$this->app->User->GetFirma()."',NOW())");

      $bestand = $this->ArtikelImLagerPlatz($artikel,$regal);
      // Bewegung
      $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz, artikel, menge,vpe, eingang,zeit,referenz, bearbeiter,projekt,firma,logdatei,bestand)
          VALUES('','$regal','$artikel','$menge','$vpe','1',NOW(),'$referenz:$grund','".$this->app->User->GetName()."','$projekt','".$this->app->User->GetFirma()."',NOW(),'$bestand')");

      $this->app->DB->Update("UPDATE lager_seriennummern SET lager_platz='$regal',zwischenlagerid='0' WHERE zwischenlagerid='$zwischenlagerid'");
      $this->app->DB->Update("UPDATE lager_mindesthaltbarkeitsdatum SET lager_platz='$regal',zwischenlagerid='0' WHERE zwischenlagerid='$zwischenlagerid'");
      $this->app->DB->Update("UPDATE lager_charge SET lager_platz='$regal',zwischenlagerid='0' WHERE zwischenlagerid='$zwischenlagerid'");

      //zwischen lager entfernen
      // menge abziehen
      $menge_db = $this->app->DB->Select("SELECT menge FROM zwischenlager WHERE id='$zwischenlagerid' LIMIT 1");
      if($menge_db - $menge > 0)
      {
        $tmp = $menge_db - $menge;
        $this->app->DB->Update("UPDATE zwischenlager SET menge='$tmp' WHERE id='$zwischenlagerid' LIMIT 1");
      } else {
        $this->app->DB->Update("DELETE FROM zwischenlager WHERE id='$zwischenlagerid' LIMIT 1");
      } 
    } 
    $this->LagerArtikelZusammenfassen($artikel);
  }
  

  function LagerAutoAuslagernArtikel($artikel,$menge,$grund)
  {
    $this->LagerArtikelZusammenfassen($artikel);

    $lager_platz = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='$artikel' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='".$artikel."' LIMIT 1");     

    if($lager_platz > 0)
      $tmparr[] = $this->app->DB->SelectArr("SELECT lager_platz,menge FROM lager_platz_inhalt WHERE artikel='$artikel' AND lager_platz='$lager_platz' ORDER by menge DESC");          

    // alle anderen regale  
    if($lager_platz > 0)
      $tmparr[] = $this->app->DB->SelectArr("SELECT lager_platz,menge FROM lager_platz_inhalt WHERE artikel='$artikel' AND lager_platz!='$lager_platz' ORDER by menge DESC");         
    else
      $tmparr[] = $this->app->DB->SelectArr("SELECT lager_platz,menge FROM lager_platz_inhalt WHERE artikel='$artikel' ORDER by menge DESC");         

    // build common array
    for($i=0;$i<count($tmparr);$i++)
    {
      for($j=0;$j<count($tmparr[$i][$j]);$j++)
      {
        $lager_platz_id[] = array('lager_platz'=>$tmparr[$i][$j]['lager_platz'],'menge'=>$tmparr[$i][$j]['menge']);
      }       
    }       

    // auslagern solange notwendige
    for($i=0;count($lager_platz_id);$i++)
    {
      $regal = $this->app->DB->Select("SELECT lager_platz FROM lager_platz_inhalt WHERE id='".$lager_platz_id[$i]['id']."' LIMIT 1"); 
      if($lager_platz_id[$i]['menge']>=$menge)
      {
        // in dem regal ist genug restmenge nehmen
        $this->LagerAuslagernRegal($artikel,$lager_platz_id[$i]['lager_platz'],$menge,$projekt,$grund);
        $this->LagerAuslagernRegalMHDCHARGESRN($artikel,$lager_platz_id[$i]['lager_platz'],$menge,$projekt,$grund);
        break;
      } else {
        // komplettes regal und menge abziegen
        $this->LagerAuslagernRegal($artikel,$lager_platz_id[$i]['lager_platz'],$lager_platz_id[$i]['menge'],$projekt,$grund);
        $this->LagerAuslagernRegalMHDCHARGESRN($artikel,$lager_platz_id[$i]['lager_platz'],$lager_platz_id[$i]['menge'],$projekt,$grund);
        $menge = $menge - $lager_platz_id[$i]['menge'];
      }       
    }       
    $this->LagerArtikelZusammenfassen($artikel);
  }       

  function LagerAuslagernRegal($artikel,$regal,$menge,$projekt,$grund,$importer="")
  {
    $this->LagerArtikelZusammenfassen($artikel);

    if($importer==1)
      $username = "Import";
    else
      $username = $this->app->User->GetName();

    // abbrechen wenn es nicht so ist!
    $bestand = $this->ArtikelImLagerPlatz($artikel,$regal);

    if($menge > $bestand || $bestand <=0) return -1;

    if($menge > 0)  
    {
      // lager in diesem Regal anpassen
      $this->app->DB->Update("UPDATE lager_platz_inhalt SET menge=menge-$menge WHERE artikel='$artikel' AND lager_platz='$regal' LIMIT 1");
      // Bewegung buchen
      $bestand = $this->ArtikelImLagerPlatz($artikel,$regal);
      $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz,artikel,menge,vpe,eingang,zeit,referenz,bearbeiter,projekt,firma,bestand) VALUES 
          ('','$regal','$artikel','$menge','','0',NOW(),'$grund','" . $username. "','$projekt','','$bestand')");
    }
    else
    {
      $this->Protokoll("Menge $menge fuer Artikel $artikel und lager_platz $regal konnte nicht entnommen werden");
    }

    $this->LagerArtikelZusammenfassen($artikel);
    return 1;
  }


  function LagerAuslagernRegalMHDCHARGESRN($artikel,$regal,$menge,$projekt,$grund,$importer="")
  {
    $this->LagerArtikelZusammenfassen($artikel);

    $mhd = $this->app->DB->Select("SELECT mindesthaltbarkeitsdatum FROM artikel WHERE id='$artikel' LIMIT 1");
    $mhd_menge = $menge;

    if($mhd=="1")
    {
      $timeout=0;
      while($mhd_menge > 0)
      {
        $check = $this->app->DB->SelectArr("SELECT id,menge FROM lager_mindesthaltbarkeitsdatum WHERE artikel='$artikel' AND lager_platz='$regal' ORDER by datum LIMIT 1");
        if($check[0]['menge']<=$mhd_menge)
        {
          // kann komplett geloescht werden       
          $mhd_menge = $mhd_menge - $check[0]['menge'];
          $this->app->DB->Delete("DELETE FROM lager_mindesthaltbarkeitsdatum WHERE id='".$check[0]['id']."' AND id > 0 LIMIT 1");
        } else {
          //sonst update mit menge
          $this->app->DB->Update("UPDATE lager_mindesthaltbarkeitsdatum SET menge='".($check[0]['menge'] - $mhd_menge)."' WHERE id='".$check[0]['id']."'");
        }
        $timeout++;
        if($timeout > $menge) break;
      }
    }

    $chargenverwaltung = $this->app->DB->Select("SELECT chargenverwaltung FROM artikel WHERE id='$artikel' LIMIT 1");
    $charge_menge = $menge;
    if($chargenverwaltung=="2")
    {
      $timeout=0;
      while($charge_menge > 0)
      {
        $check = $this->app->DB->SelectArr("SELECT id,menge FROM lager_charge WHERE artikel='$artikel' AND lager_platz='$regal' ORDER by id LIMIT 1");
        if($check[0]['menge']<=$charge_menge)
        {
          // kann komplett geloescht werden       
          $charge_menge = $charge_menge - $check[0]['menge'];
          $this->app->DB->Delete("DELETE FROM lager_charge WHERE id='".$check[0]['id']."' AND id > 0 LIMIT 1");
        } else {
          //sonst update mit menge
          $this->app->DB->Update("UPDATE lager_charge SET menge='".($check[0]['menge'] - $mhd_menge)."' WHERE id='".$check[0]['id']."'");
        }
        $timeout++;
        if($timeout > $menge) break;
      }
    }       


    $this->LagerArtikelZusammenfassen($artikel);
  }


  function CreateLagerplatz($lager,$lagerplatz_name,$firma="1")
  {
    $lagerplatz_name = trim($lagerplatz_name);
    // pruefe ob es Lagerplatz bereits gibt
    $check_id = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$lagerplatz_name' AND lager='$lager' LIMIT 1");

    if($check_id <= 0)
    {
      if($firma <= 0) $firma=1;
      $this->app->DB->Insert("INSERT INTO lager_platz (id,lager,kurzbezeichnung,firma) VALUES ('','$lager','$lagerplatz_name',$firma)");    
      $check_id = $this->app->DB->GetInsertID();
    }       
    return $check_id;
  }


  function LagerID($lager)
  {

    if(is_numeric($lager) && $lager > 0)
    {
      $lager = $lager + 0;
      $lager = $this->app->DB->Select("SELECT id FROM lager_platz WHERE id='$lager' LIMIT 1");
      if($lager > 0)
        return $lager;
    }

    if($lager !="")
    {
      $id = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$lager' LIMIT 1");
      return $id;
    } else return "";
  }

  function IsArtikelInZwischenlager($artikel)
  {
    $check = $this->app->DB->Select("SELECT id FROM zwischenlager WHERE richtung='Eingang' AND artikel='$artikel' LIMIT 1");
    if($check > 0)
      return true;
    else 
      return false; 
  }

  function ArtikelIDWennEAN($artikelnummer)
  {
    if($artikelnummer!="")
    {

      // artikelnummer hat hoechste Prio
      $nummer = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$artikelnummer' LIMIT 1");
      if($nummer > 0)
        return $nummer;

      // dann ean nummer
      $ean = $this->app->DB->Select("SELECT id FROM artikel WHERE ean='$artikelnummer' LIMIT 1");
      if($ean > 0)
        return $ean;

      // und zum Schluss Hersteller
      $herstellernummer = $this->app->DB->Select("SELECT id FROM artikel WHERE herstellernummer='$artikelnummer' LIMIT 1");
      if($herstellernummer > 0)
        return $herstellernummer;
/*
      $id = $this->app->DB->Select("SELECT id FROM artikel WHERE id='$artikelnummer' LIMIT 1");
      if($id > 0)
        return $id;
      else 
        return 0;
*/
    }
    return 0;
  }


  function LagerEinlagern($artikel,$menge,$regal,$projekt,$grund="",$importer="")
  {
    $this->LagerArtikelZusammenfassen($artikel);
    $vpe = 'einzeln'; //TODO

    if($importer==1)
      $username = "Import";
    else
      $username = $this->app->User->GetName();

    if($menge > 0 && is_numeric($menge))
    {

      // inhalt buchen
      $this->app->DB->Insert("INSERT INTO lager_platz_inhalt (id,lager_platz,artikel,menge,vpe,bearbeiter,bestellung,projekt,firma,logdatei)
          VALUES ('','$regal','$artikel','$menge','$vpe','".$username."','','$projekt','',NOW())");

      $bestand = $this->ArtikelImLagerPlatz($artikel,$regal);
      // Bewegung
      $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz, artikel, menge,vpe, eingang,zeit,referenz, bearbeiter,projekt,firma,logdatei,bestand)
          VALUES('','$regal','$artikel','$menge','$vpe','1',NOW(),'$grund','".$username."','$projekt','',NOW(),'$bestand')");
    }
    $this->LagerArtikelZusammenfassen($artikel);
  }

  function LagerEinlagernDifferenz($artikel,$menge,$regal,$projekt,$grund="",$importer="")
  {
    $grund = "Differenz: ".$grund;
    $this->LagerEinlagern($artikel,$menge,$regal,$projekt,$grund,$importer);
  }


  function LagerArtikelZusammenfassen($artikel)
  {
    $fp = $this->app->erp->ProzessLock("lager_artikelzusammenfassen");
    //$this->LagerSync($artikel);
    // all einzeln buchungen in einem Baum zusammenfassen           

    if($artikel > 0) {
      $result = $this->app->DB->SelectArr("SELECT lager_platz,SUM(menge) as gesamt,projekt,firma,max(inventur) as inventur, min(id) as minid FROM lager_platz_inhalt WHERE artikel='$artikel' GROUP by lager_platz  having count(id) > 1");
      //echo "DELETE FROM lager_platz_inhalt WHERE artikel='".$artikel."';";
      for($i=0;$i<count($result);$i++)
      {
        $this->app->DB->Delete("DELETE FROM lager_platz_inhalt WHERE  artikel='$artikel' AND lager_platz = '".$result[$i]['lager_platz']."'");
        $this->app->DB->Insert("INSERT INTO lager_platz_inhalt (id,lager_platz,artikel,menge,projekt,firma,inventur) VALUES ('".$result[$i]['minid']."','".$result[$i]['lager_platz']."','$artikel',
          '".$result[$i]['gesamt']."','".$result[$i]['projekt']."','".$result[$i]['firma']."',".(is_null($result[$i]['inventur'])?"NULL":"'".$result[$i]['inventur']."'").");");
      }
    }
    $this->app->DB->Delete("DELETE lager_platz_inhalt FROM lager_platz_inhalt WHERE (menge<='0' and (isnull(inventur) or inventur <= 0)) or menge < 0");

    // loesche verbrauchslager
    // aber ebenfalls chargen, seriennummern und mhd        
    $this->app->DB->Delete("DELETE lager_platz_inhalt FROM lager_platz_inhalt LEFT JOIN lager_platz ON lager_platz.id=lager_platz_inhalt.lager_platz 
        WHERE lager_platz.verbrauchslager='1'");
    //WHERE lager_platz_inhalt.artikel='".$artikel."' AND lager_platz.verbrauchslager='1'");

    $this->app->DB->Delete("DELETE lager_charge FROM lager_charge LEFT JOIN lager_platz ON lager_platz.id=lager_charge.lager_platz
        WHERE lager_platz.verbrauchslager='1'");

    $this->app->DB->Delete("DELETE lager_seriennummer FROM lager_seriennummer 
        LEFT JOIN lager_platz ON lager_platz.id=lager_seriennummer.lager_platz
        WHERE lager_platz.verbrauchslager='1'");

    $this->app->DB->Delete("DELETE lager_mindesthaltbarkeitsdatum FROM lager_mindesthaltbarkeitsdatum 
        LEFT JOIN lager_platz ON lager_platz.id=lager_mindesthaltbarkeitsdatum.lager_platz
        WHERE lager_platz.verbrauchslager='1'");
    $this->app->erp->ProzessUnlock($fp);
  }


  // pruefe ob es artikel noch im lager gibt bzw. ob es eine reservierung gibt
  function LagerFreieMenge($artikel)
  {
    $summe_im_lager = $this->app->DB->Select("SELECT SUM(li.menge) FROM lager_platz_inhalt li LEFT JOIN lager_platz lp ON lp.id=li.lager_platz WHERE li.artikel='$artikel'
    AND lp.sperrlager!='1'");
    //AND lp.autolagersperre!='1' AND lp.sperrlager!='1'");

    //$artikel_reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='".$artikel."' AND datum>=NOW() AND objekt!='lieferschein'");
    $artikel_reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='".$artikel."' AND (datum>=NOW() OR datum='0000-00-00')");

    $restmenge = $summe_im_lager - $artikel_reserviert;
    if($restmenge > 0)
      return $restmenge;
    else return 0;

  }

  function ArtikelAnzahlLagerStueckliste($id)
  {
    // gehe stueckliste durch und schaue ob es maximal artikel ist 
    $artikel = $this->app->DB->SelectArr("SELECT * FROM stueckliste WHERE stuecklistevonartikel='$id'");
    $stueck = 0;
    $kleinste_max_menge = 0;
    for($i=0;$i<count($artikel);$i++)
    {
      $artikelid = $artikel[$i]['artikel'];
      $mengeimlage = $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi LEFT JOIN lager_platz lp ON lp.id=lpi.lager_platz 
        WHERE lpi.artikel='$artikelid' AND lp.sperrlager!=1");

      $mengereserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='$artikelid'");

      $mengefrei = $mengeimlage - $mengereserviert;

      $max_menge = floor($mengefrei/$artikel[$i]['menge']);
      $collect[] = $max_menge;

    } 
    if(is_array($collect))
    {
      sort($collect);
      $stueck = $collect[0];
    } else
      $stueck = 0;

    if($stueck <= 0) $stueck=0;

    return $stueck;
  }

  function ArtikelAnzahlVerkaufbar($artikelid)
  {
    $ij=0;
    $lagerartikel[$ij]['id'] = $artikelid;

    $lagerartikel[$ij]['juststueckliste'] = $this->app->DB->Select("SELECT juststueckliste FROM artikel WHERE id='$artikelid' LIMIT 1");
    $lagerartikel[$ij]['name_de'] = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikelid' LIMIT 1");
    $lagerartikel[$ij]['nummer'] = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikelid' LIMIT 1");
    $lagerartikel[$ij]['cache_lagerplatzinhaltmenge'] = $this->app->DB->Select("SELECT cache_lagerplatzinhaltmenge FROM artikel WHERE id='$artikelid' LIMIT 1");

    if($lagerartikel[$ij]['juststueckliste'])
      $lagernd = $this->ArtikelAnzahlLagerStueckliste($lagerartikel[$ij]['id']);
    else
      $lagernd = $this->ArtikelAnzahlLager($lagerartikel[$ij]['id']);

    $reserviert = $this->ArtikelAnzahlReserviert($lagerartikel[$ij]['id']);

    $offen = $this->ArtikelAnzahlOffene($lagerartikel[$ij]['id']);

    if($offen > $reserviert) {
      $blockierte_menge = $offen;
    } else {
      $blockierte_menge = $reserviert;
    }

    if(($lagernd-$blockierte_menge) > 0) 
      { return ($lagernd-$blockierte_menge); }
    else { return 0; }
  }

  function LagerSync($artikelid, $print_echo=false)
  {
    $ij=0;
    $lagerartikel[$ij]['id'] = $artikelid;

    $lagerartikel[$ij]['juststueckliste'] = $this->app->DB->Select("SELECT juststueckliste FROM artikel WHERE id='$artikelid' LIMIT 1");
    $lagerartikel[$ij]['name_de'] = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikelid' LIMIT 1");
    $lagerartikel[$ij]['nummer'] = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikelid' LIMIT 1");
    $lagerartikel[$ij]['cache_lagerplatzinhaltmenge'] = $this->app->DB->Select("SELECT cache_lagerplatzinhaltmenge FROM artikel WHERE id='$artikelid' LIMIT 1");

    $pseudolager = $this->app->DB->Select("SELECT pseudolager FROM artikel WHERE id='$artikelid' LIMIT 1");

    if($pseudolager > 0) $pseudolager = " (verkaufbar) ".$pseudolager." (Pseudo Menge)"; else $pseudolager="";

    $verkaufbare_menge = $this->ArtikelAnzahlVerkaufbar($artikelid);
    $alter_status = $lagerartikel[$ij]['cache_lagerplatzinhaltmenge'];

    if ($verkaufbare_menge > 0)
      $neuer_status = "gruen (Menge ".($verkaufbare_menge.$pseudolager).")";
    else $neuer_status = "red";

    //echo $lagerartikel[$ij]['name_de']." Lagernd: ".($lagernd-$reserviert)." Cache: ".$lagerartikel[$ij]['cache_lagerplatzinhaltmenge']."\r\n";

    if($lagerartikel[$ij]['cache_lagerplatzinhaltmenge'] != ($verkaufbare_menge))//$alter_status!=$neuer_status)
    {
      $this->LogFile("*** UPDATE ".$lagerartikel[$ij]['nummer']." ".$lagerartikel[$ij]['name_de']." Lagernd: ".($verkaufbare_menge));

      $this->app->DB->Update("UPDATE artikel SET cache_lagerplatzinhaltmenge='".($verkaufbare_menge)."'
          WHERE id='".$lagerartikel[$ij]['id']."' LIMIT 1");

      $shop = $this->app->DB->Select("SELECT a.shop FROM artikel a inner join shopexport s on a.shop = s.id WHERE s.geloescht = 0 AND s.aktiv=1 AND s.lagerexport = 1 and s.demomodus = 0 AND a.id='".$lagerartikel[$ij]['id']."' LIMIT 1");

      if($shop > 0){
        $extnummer = $this->app->DB->Select("SELECT nummer FROM artikelnummer_fremdnummern WHERE artikel = '$artikelid' AND shopid = '$shop' AND aktiv = 1 LIMIT 1");
        $this->app->remote->RemoteSendArticleList($shop,array($lagerartikel[$ij]['id']),$extnummer? array($extnummer):'');
      }

      $shop2 = $this->app->DB->Select("SELECT a.shop2 FROM artikel a inner join shopexport s on a.shop2 = s.id  WHERE s.geloescht = 0 AND s.aktiv=1 AND s.lagerexport = 1 and s.demomodus = 0 AND  a.id='".$lagerartikel[$ij]['id']."' LIMIT 1");
      if($shop2 > 0)
      {
        $extnummer = $this->app->DB->Select("SELECT nummer FROM artikelnummer_fremdnummern WHERE artikel = '$artikelid' AND shopid = '$shop2' AND aktiv = 1 LIMIT 1");
        $this->app->remote->RemoteSendArticleList($shop2,array($lagerartikel[$ij]['id']),$extnummer? array($extnummer):'');
      }

      $shop3 = $this->app->DB->Select("SELECT a.shop3 FROM artikel a inner join shopexport s on a.shop3 = s.id  WHERE s.geloescht = 0 AND s.aktiv=1 AND s.lagerexport = 1 and s.demomodus = 0 AND  a.id='".$lagerartikel[$ij]['id']."' LIMIT 1");
      if($shop3 > 0)
      {
        $extnummer = $this->app->DB->Select("SELECT nummer FROM artikelnummer_fremdnummern WHERE artikel = '$artikelid' AND shopid = '$shop3' AND aktiv = 1 LIMIT 1");
        $this->app->remote->RemoteSendArticleList($shop3,array($lagerartikel[$ij]['id']),$extnummer? array($extnummer):'');
      }

      $message .= "Artikel: ".$lagerartikel[$ij]['name_de']." (".$lagerartikel[$ij]['nummer'].") Neuer Status: ".$neuer_status."\r\n";


      if($print_echo)
        echo "*** UPDATE ".$lagerartikel[$ij]['nummer']." ".$lagerartikel[$ij]['name_de']." Lagernd: ".($verkaufbare_menge)."\r\n";

    } else {
      //if($print_echo)
      //          echo $lagerartikel[$ij]['name_de']." Lagernd: ".($lagernd-$reserviert)."\r\n";
    }
    return $message;
  }


  // pruefe ob es artikel noch im lager gibt bzw. ob es eine reservierung gibt
  function LagerCheck($adresse,$artikel,$menge,$objekt="",$parameter="")
  {

    $this->app->erp->LogFile("BENE 888 $objekt $parameter");

    $summe_im_lager = $this->app->DB->Select("SELECT SUM(li.menge) FROM lager_platz_inhalt li LEFT JOIN lager_platz lp ON lp.id=li.lager_platz WHERE li.artikel='$artikel'
        AND lp.autolagersperre!=1 AND lp.sperrlager!='1'");

    //$artikel_reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='".$artikel."' AND datum>=NOW() AND objekt!='lieferschein'");
    $artikel_reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='".$artikel."' AND (datum>=NOW() OR datum='0000-00-00')");

    // wenn es reservierungen fuer den Auftrag  gibt
    if($objekt!="")
    {
      // auftrag reservierungen
      $artikel_fuer_adresse_reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert 
          WHERE artikel='".$artikel."' AND adresse='$adresse' AND objekt='$objekt' AND parameter='$parameter' AND (datum>=NOW() OR datum='0000-00-00')");
    } else { 
      $artikel_fuer_adresse_reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert 
          WHERE artikel='".$artikel."' AND adresse='$adresse' AND (datum>=NOW() OR datum='0000-00-00') AND objekt!='lieferschein'");
    }

    if(($summe_im_lager - ($artikel_reserviert -$artikel_fuer_adresse_reserviert)) >= $menge)
    {
      return 1;
    }

    return 0;
  }

  function AngebotSuche($parsetarget)
  {
    $treffer = $this->app->Secure->GetPOST("treffer");
    if($treffer > 0 ) {
      $_SESSION['angebottreffer'] = $treffer;
      $_SESSION['page'] = 1;
    }
    else
      if(!isset($_SESSION['angebottreffer']) || $_SESSION['angebottreffer'] <= 0)
        $_SESSION['angebottreffer'] = 10;

    $this->app->Tpl->Set('TREFFER',$_SESSION['angebottreffer']);


    $suchwort= $this->app->Secure->GetPOST("suchwort");
    $name= $this->app->Secure->GetPOST("name");
    $plz= $this->app->Secure->GetPOST("plz");
    $angebot= $this->app->Secure->GetPOST("angebot");
    $kundennummer= $this->app->Secure->GetPOST("kundennummer");

    $_SESSION['angebotsuchwort']=$suchwort; //$this->app->Tpl->Set(SUCHWORT,$_SESSION[angebotsuchwort]);
    $_SESSION['angebotname']=$name; $this->app->Tpl->Set('NAME',$_SESSION['angebotname']);
    $_SESSION['angebotplz']=$plz; $this->app->Tpl->Set('PLZ',$_SESSION['angebotplz']); 
    $_SESSION['angebotangebot']=$angebot; $this->app->Tpl->Set('ANGEBOT',$_SESSION['angebotangebot']);
    $_SESSION['angebotkundennummer']=$kundennummer; $this->app->Tpl->Set('KUNDENNUMMER',$_SESSION['angebotkundennummer']);

    $suche = $this->app->Secure->GetPOST("suche");

    //$this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");

    if(($_SESSION[angebotsuchwort]!="" || $_SESSION[angebotname]!="" || $_SESSION[angebotplz]!="" || $_SESSION[angebotangebot]!="" || $_SESSION[angebotkundennummer]!="") && $suche!=""){

      //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");
      if($suchwort!="")
      {
        return "SELECT DATE_FORMAT(a.datum,'%d.%m.%y') as vom, if(a.belegnr,a.belegnr,'ohne Nummer') as Angebot, ad.kundennummer as kunde, a.name, p.abkuerzung as projekt, a.status, a.id
          FROM angebot a, projekt p, adresse ad WHERE
          (a.plz LIKE '%$suchwort%' OR a.name LIKE '%$suchwort%' OR a.belegnr LIKE '%$suchwort%') 
          AND p.id=a.projekt AND a.adresse=ad.id
          order by a.datum DESC, a.id DESC";
      } else {
        return "SELECT DATE_FORMAT(a.datum,'%d.%m.%y') as vom, if(a.belegnr,a.belegnr,'ohne Nummer') as Angebot, ad.kundennummer as kunde, a.name, p.abkuerzung as projekt, a.status, a.id
          FROM angebot a, projekt p, adresse ad WHERE 
          (ad.kundennummer LIKE '%{$_SESSION[angebotkundennummer]}%' AND a.plz LIKE '%{$_SESSION[angebotplz]}%' 
           AND a.name LIKE '%{$_SESSION[angebotname]}%' AND a.belegnr LIKE '%{$_SESSION[angebotangebot]}%' ) 
          AND p.id=a.projekt AND a.adresse=ad.id
          order by a.datum DESC, a.id DESC";

      }

      /*
         return ("SELECT DISTINCT a.nummer, a.name_de as Artikel, p.abkuerzung, a.id FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE 
         a.name_de LIKE '%$name%' AND
         a.nummer LIKE '$nummer%'AND
         p.abkuerzung LIKE '%$projekt%'
         AND geloescht='0'
         ORDER by a.id DESC");
       */
      //      SELECT DISTINCT a.name, a.ort, a.telefon, a.email, a.id
      //      FROM adresse a LEFT JOIN adresse_rolle r ON a.id=r.adresse WHERE r.subjekt='Kunde' ORDER by a.id DESC

    } else {

      return "SELECT DATE_FORMAT(a.datum,'%d.%m.%y') as vom, if(a.belegnr,a.belegnr,'ohne Nummer') as Angebot, ad.kundennummer as kunde, a.name, p.abkuerzung as projekt, a.status, a.id
        FROM angebot a, projekt p, adresse ad WHERE p.id=a.projekt AND a.adresse=ad.id order by a.datum DESC, a.id DESC";

    }
    //$this->app->Tpl->Set(INHALT,"");
  }



  function WebmailSuche($parsetarget,$rolle)
  {
    $suche = $this->app->Secure->GetPOST("suche");

    $name = $this->app->Secure->GetPOST("name"); $this->app->Tpl->Set('SUCHENAME',$name);
    $nummer = $this->app->Secure->GetPOST("nummer"); $this->app->Tpl->Set('SUCHENUMMER',$nummer);
    $typ = $this->app->Secure->GetPOST("typ");

    $this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");

    $projekt = $this->app->Secure->GetPOST("projekt");  $this->app->Tpl->Set('SUCHEPROJEKT',$projekt);
    $limit = $this->app->Secure->GetPOST("limit"); if($limit=="" || $limit ==0) $limit=10; $this->app->Tpl->Set('SUCHELIMIT',$limit);

    if($name!="" && $suche!="")
    {
      $_SESSION['name_webmailsuche'] = $name;
    } elseif ($suche!="" && $name=="")
    $_SESSION['name_webmailsuche'] = "";

    if($name=="" && $suche!="")
    {
      $_SESSION['name_artikel'] = $name;
    } 

    $_SESSION['nummer'] = $nummer;
    $_SESSION['projekt'] = $projekt;

    $adresse = $this->app->User->getAdresse();

    if($name==""){ $name = $_SESSION['name_webmailsuche'];  $this->app->Tpl->Set('SUCHENAME',$name);}
    if($nummer==""){$nummer= $_SESSION['nummer']; $this->app->Tpl->Set('SUCHENUMMER',$nummer);}
    if($projekt==""){$projekt= $_SESSION['projekt']; $this->app->Tpl->Set('SUCHEPROJEKT',$projekt);}

    if($name!="" || $nummer!="" || $projekt!="") $suche ="suche";


    $this->app->Tpl->Parse($parsetarget,"webmailsuche.tpl");
    if(($name!="" || $nummer!="" || $projekt!="") && $suche!=""){


      return("SELECT DATE_FORMAT(e.empfang,'%d.%m.%Y %H:%i') as zeit,CONCAT(LEFT(e.subject,30),'...') as betreff, e.sender,e.id
          FROM     emailbackup_mails e
          WHERE    e.webmail IN (SELECT id FROM emailbackup WHERE emailbackup.adresse = '$adresse') 
          AND e.sender LIKE '%$name%' AND
          e.subject LIKE '$nummer%'
          ORDER BY e.empfang DESC");

      //p.abkuerzung LIKE '%$projekt%'

      //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");
      /*
         return("SELECT DATE_FORMAT(tn.zeit,'%d.%m.%Y %H:%i') as zeit,CONCAT(LEFT(tn.betreff,30),'...') as betreff, t.kunde, p.abkuerzung,
         tn.id FROM ticket_nachricht tn LEFT JOIN ticket t ON t.schluessel=tn.ticket LEFT JOIN projekt p ON p.id=t.projekt WHERE 
         t.kunde LIKE '%$name%' AND
         tn.betreff LIKE '$nummer%'AND
         p.abkuerzung LIKE '%$projekt%'
         ORDER by tn.zeit DESC");
       */
      //      SELECT DISTINCT a.name, a.ort, a.telefon, a.email, a.id
      //      FROM adresse a LEFT JOIN adresse_rolle r ON a.id=r.adresse WHERE r.subjekt='Kunde' ORDER by a.id DESC
      //       $table->Display(INHALT,"auftrag","kundeuebernehmen","In Auftrag einf&uuml;gen");
    } else {
      return "SELECT DATE_FORMAT(e.empfang,'%d.%m.%Y %H:%i') as zeit,CONCAT(LEFT(e.subject,30),'...') as betreff, e.sender,e.id
        FROM     emailbackup_mails e
        WHERE    webmail IN (SELECT id FROM emailbackup WHERE emailbackup.adresse = '$adresse')
        ORDER BY e.empfang DESC";

      //      return "SELECT DATE_FORMAT(e.empfang,'%d.%m.%Y %H:%i') as zeit,CONCAT(LEFT(e.subject,30),'...') as betreff, e.sender, 
      //      e.id FROM emailbackup_mails e WHERE 
      //     ORDER by e.empfang DESC";
    }



    //$this->app->Tpl->Set(INHALT,"");
  }


  function TicketArchivSuche($parsetarget,$rolle)
  {
    $suche = $this->app->Secure->GetPOST("suche");

    $name = $this->app->Secure->GetPOST("name"); $this->app->Tpl->Set('SUCHENAME',$name);
    $nummer = $this->app->Secure->GetPOST("nummer"); $this->app->Tpl->Set('SUCHENUMMER',$nummer);
    $typ = $this->app->Secure->GetPOST("typ");

    $this->app->YUI->AutoComplete('PROJEKTAUTO',"projekt",array('name','abkuerzung'),"abkuerzung");

    $projekt = $this->app->Secure->GetPOST("projekt");  $this->app->Tpl->Set('SUCHEPROJEKT',$projekt);
    $limit = $this->app->Secure->GetPOST("limit"); if($limit=="" || $limit ==0) $limit=10; $this->app->Tpl->Set('SUCHELIMIT',$limit);

    if($name!="" && $suche!="")
    {
      $_SESSION['name_ticketarchiv'] = $name;
    } elseif ($suche!="" && $name=="")
    $_SESSION['name_ticketarchiv'] = "";


    if($name=="" && $suche!="")
    {
      $_SESSION['name_artikel'] = $name;
    } 

    $_SESSION['nummer'] = $nummer;
    $_SESSION['projekt'] = $projekt;


    if($name==""){ $name = $_SESSION['name_ticketarchiv'];  $this->app->Tpl->Set('SUCHENAME',$name);}
    if($nummer==""){$nummer= $_SESSION['nummer']; $this->app->Tpl->Set('SUCHENUMMER',$nummer);}
    if($projekt==""){$projekt= $_SESSION['projekt']; $this->app->Tpl->Set('SUCHEPROJEKT',$projekt);}

    if($name!="" || $nummer!="" || $projekt!="") $suche ="suche";


    $this->app->Tpl->Parse($parsetarget,"ticketsuchearchiv.tpl");
    if(($name!="" || $nummer!="" || $projekt!="") && $suche!=""){


      //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");
      return("SELECT DATE_FORMAT(tn.zeit,'%d.%m.%Y %H:%i') as zeit,CONCAT(LEFT(tn.betreff,30),'...') as betreff, t.kunde, p.abkuerzung,
          tn.id FROM ticket_nachricht tn LEFT JOIN ticket t ON t.schluessel=tn.ticket LEFT JOIN projekt p ON p.id=t.projekt WHERE 
          t.kunde LIKE '%$name%' AND
          tn.betreff LIKE '$nummer%'AND
          p.abkuerzung LIKE '%$projekt%'
          ORDER by tn.zeit DESC");

      //      SELECT DISTINCT a.name, a.ort, a.telefon, a.email, a.id
      //      FROM adresse a LEFT JOIN adresse_rolle r ON a.id=r.adresse WHERE r.subjekt='Kunde' ORDER by a.id DESC
      //       $table->Display(INHALT,"auftrag","kundeuebernehmen","In Auftrag einf&uuml;gen");
    } else {
      return "SELECT DATE_FORMAT(tn.zeit,'%d.%m.%Y %H:%i') as zeit,CONCAT(LEFT(tn.betreff,30),'...') as betreff, t.kunde, 
        tn.id FROM ticket as t, ticket_nachricht as tn WHERE t.schluessel=tn.ticket AND tn.status='beantwortet' AND t.zugewiesen=1 
        AND inbearbeitung!='1'
        ORDER by tn.zeitausgang DESC";
    }



    //$this->app->Tpl->Set(INHALT,"");
  }

  function ArtikelSuche($parsetarget,$rolle)
  {
    $suche = $this->app->Secure->GetPOST("suche");
    $suchwort= $this->app->Secure->GetPOST("suchwort");
    /* Auftrage fuer manuelle freigabe */

    $name = $this->app->Secure->GetPOST("name"); $this->app->Tpl->Set('SUCHENAME',$name);
    $nummer = $this->app->Secure->GetPOST("nummer"); $this->app->Tpl->Set('SUCHENUMMER',$nummer);
    $typ = $this->app->Secure->GetPOST("typ");

    $this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");

    $projekt = $this->app->Secure->GetPOST("projekt");  $this->app->Tpl->Set('SUCHEPROJEKT',$projekt);
    $limit = $this->app->Secure->GetPOST("limit"); if($limit=="" || $limit ==0) $limit=10; $this->app->Tpl->Set('SUCHELIMIT',$limit);

    if($name!="" && $suche!="")
    {
      $_SESSION['name_artikel'] = $name;
    } elseif ($suche!="" && $name=="")
    $_SESSION['name_artikel'] = "";


    if($name=="" && $suche!="")
    {
      $_SESSION['name_artikel'] = $name;
    } 

    $_SESSION['nummer'] = $nummer;
    $_SESSION['projekt'] = $projekt;


    if($name==""){ $name = $_SESSION['name_artikel'];  $this->app->Tpl->Set('SUCHENAME',$name);}
    if($nummer==""){$nummer= $_SESSION['nummer']; $this->app->Tpl->Set('SUCHENUMMER',$nummer);}
    if($projekt==""){$projekt= $_SESSION['projekt']; $this->app->Tpl->Set('SUCHEPROJEKT',$projekt);}

    if($name!="" || $nummer!="" || $projekt!="") $suche ="suche";


    $this->app->Tpl->Parse($parsetarget,"artikelsuche.tpl");
    if(($name!="" || $nummer!="" || $projekt!="" || $suchwort!="") && $suche!=""){
      if($suchwort!="")
      {

        return ("SELECT DISTINCT a.nummer, a.name_de as Artikel, p.abkuerzung, a.id FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE 
            (a.name_de LIKE '%$suchwort%' OR
             a.nummer LIKE '%$suchwort%') 
            AND geloescht='0'
            ORDER by a.id DESC");

      } else {
        return ("SELECT DISTINCT a.nummer, a.name_de as Artikel, p.abkuerzung, a.id FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE 
            a.name_de LIKE '%$name%' AND
            a.nummer LIKE '%$nummer%' AND
            p.abkuerzung LIKE '%$projekt%'
            AND a.geloescht='0'
            ORDER by a.id DESC");
      }

      //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");

      //      SELECT DISTINCT a.name, a.ort, a.telefon, a.email, a.id
      //      FROM adresse a LEFT JOIN adresse_rolle r ON a.id=r.adresse WHERE r.subjekt='Kunde' ORDER by a.id DESC
      //       $table->Display(INHALT,"auftrag","kundeuebernehmen","In Auftrag einf&uuml;gen");
    } else {

      return "SELECT DISTINCT a.nummer, a.name_de as Artikel, p.abkuerzung, a.id FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.geloescht='0'
        ORDER by a.id DESC";

    }
    //$this->app->Tpl->Set(INHALT,"");
  }

  function AdressSuche($parsetarget,$rolle)
  {
    $suche = $this->app->Secure->GetPOST("suche");
    /* Auftrage fuer manuelle freigabe */
    if($rolle!="")
      $this->app->Tpl->Set('SUBHEADING',"$rolle suchen");
    else
      $this->app->Tpl->Set('SUBHEADING',"Adresse suchen");

    $name = $this->app->Secure->GetPOST("name"); $this->app->Tpl->Set('SUCHENAME',$name);
    $typ = $this->app->Secure->GetPOST("typ");
    $ansprechpartner = $this->app->Secure->GetPOST("ansprechpartner");  $this->app->Tpl->Set('SUCHEANSPRECHPARTNER',$ansprechpartner);
    $abteilung= $this->app->Secure->GetPOST("abteilung");
    $unterabteilung= $this->app->Secure->GetPOST("unterabteilung");
    $adresszusatz= $this->app->Secure->GetPOST("adresszusatz");
    $email= $this->app->Secure->GetPOST("email");
    $telefon= $this->app->Secure->GetPOST("telefon");
    $telefax= $this->app->Secure->GetPOST("telefax");
    $ustid= $this->app->Secure->GetPOST("ustid");
    $land= $this->app->Secure->GetPOST("land");
    $plz= $this->app->Secure->GetPOST("plz");  $this->app->Tpl->Set('SUCHEPLZ',$plz);
    $ort= $this->app->Secure->GetPOST("ort");  $this->app->Tpl->Set('SUCHEORT',$ort);
    $strasse= $this->app->Secure->GetPOST("strasse");  $this->app->Tpl->Set('SUCHESTRASSE',$strasse);
    $kundennummer= $this->app->Secure->GetPOST("kundennummer");  $this->app->Tpl->Set('KUNDENNUMMER',$kundennummer);

    if($name!="" && $suche!="")
    {
      $_SESSION['name'] = $name;
    } elseif ($suche!="" && $name=="")
    $_SESSION['name'] = "";


    if($name=="" && $suche!="")
    {
      $_SESSION['name'] = $name;
    } 

    $_SESSION['ort'] = $ort;
    $_SESSION['plz'] = $plz;


    if($name==""){ $name = $_SESSION['name'];  $this->app->Tpl->Set('SUCHENAME',$name);}
    if($ort==""){$ort= $_SESSION['ort']; $this->app->Tpl->Set('SUCHEORT',$ort);}
    if($plz==""){$plz= $_SESSION['plz']; $this->app->Tpl->Set('SUCHEPLZ',$plz);}

    if($name!="" || $ort!="" || $plz!="") $suche ="suche";

    $this->app->Tpl->Parse($parsetarget,"kundensuche.tpl");

    if(($name!="" || $kundennummer!="" || $strasse!="" || $ort!="" || $plz!="") && $suche!=""){
      //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");
      return ("SELECT DISTINCT a.kundennummer, a.name, a.ort, a.telefon, a.email, a.id FROM adresse a LEFT JOIN adresse_rolle r ON a.id=r.adresse WHERE 
          a.name LIKE '%$name%' AND 
          a.ansprechpartner LIKE '%$ansprechpartner%' AND 
          a.ort LIKE '%$ort%' AND 
          a.strasse LIKE '%$strasse%' AND 
          a.kundennummer LIKE '%$kundennummer%' AND 
          a.plz LIKE '%$plz%' AND a.geloescht=0 ORDER by a.id DESC");
      //a.plz LIKE '%$plz%' AND r.subjekt='$rolle' ORDER by a.id DESC");

      //      SELECT DISTINCT a.name, a.ort, a.telefon, a.email, a.id
      //      FROM adresse a LEFT JOIN adresse_rolle r ON a.id=r.adresse WHERE r.subjekt='Kunde' ORDER by a.id DESC
      //       $table->Display(INHALT,"auftrag","kundeuebernehmen","In Auftrag einf&uuml;gen");
    } else {

      return "SELECT DISTINCT a.name, a.ort, a.telefon, a.email, a.id
        FROM adresse a WHERE a.geloescht=0 ORDER by a.name ASC";
      //FROM adresse a LEFT JOIN adresse_rolle r ON a.id=r.adresse WHERE r.subjekt='$rolle' ORDER by a.id DESC";

    }
    //$this->app->Tpl->Set(INHALT,"");
  }

  function string2array ($string, $template){
#search defined dividers
    preg_match_all ("|%(.+)%|U", $template, $template_matches);
#replace dividers with "real dividers"
    $template = preg_replace ("|%(.+)%|U", "(.+)", $template);
#search matches
    preg_match ("|" . $template . "|", $string, $string_matches);
#[template_match] => $string_match
    foreach ($template_matches[1] as $key => $value){
      $output[$value] = $string_matches[($key + 1)];
    }
    return $output;
  }

  
  function SelectLaenderliste($selected="")
  {
    if($selected=="") $selected=$this->Firmendaten("land");

    $laender = $this->GetSelectLaenderliste(true);

    foreach ($laender as $land => $kuerzel) {
      $options = $options."<option value=\"$kuerzel\"";
      if ($selected == $kuerzel) $options = $options." selected";
      $options = $options.">$land</option>\n";
    }
    return $options;
  }

  function GetSelectLaenderliste($laenderliste=false)
  {
    $laender = array(
        'Deutschland'  => 'DE',
        'Afghanistan'  => 'AF',
        '&Auml;gypten'  => 'EG',
        'Albanien'  => 'AL',
        'Algerien'  => 'DZ',
        'Andorra'  => 'AD',
        'Angola'  => 'AO',
        'Anguilla'  => 'AI',
        'Antarktis'  => 'AQ',
        'Antigua und Barbuda'  => 'AG',
        '&Auml;quatorial Guinea'  => 'GQ',
        'Argentinien'  => 'AR',
        'Armenien'  => 'AM',
        'Aruba'  => 'AW',
        'Aserbaidschan'  => 'AZ',
        '&Auml;thiopien'  => 'ET',
        'Australien'  => 'AU',
        'Bahamas'  => 'BS',
        'Bahrain'  => 'BH',
        'Bangladesh'  => 'BD',
        'Barbados'  => 'BB',
        'Belgien'  => 'BE',
        'Belize'  => 'BZ',
        'Benin'  => 'BJ',
        'Bermudas'  => 'BM',
        'Bhutan'  => 'BT',
        'Birma'  => 'MM',
        'Bolivien'  => 'BO',
        'Bosnien-Herzegowina'  => 'BA',
        'Botswana'  => 'BW',
        'Bouvet Inseln'  => 'BV',
        'Brasilien'  => 'BR',
        'Britisch-Indischer Ozean'  => 'IO',
        'Brunei'  => 'BN',
        'Bulgarien'  => 'BG',
        'Burkina Faso'  => 'BF',
        'Burundi'  => 'BI',
        'Chile'  => 'CL',
        'China'  => 'CN',
        'Christmas Island'  => 'CX',
        'Cook Inseln'  => 'CK',
        'Costa Rica'  => 'CR',
        'D&auml;nemark'  => 'DK',
        'Deutschland'  => 'DE',
        'Djibuti'  => 'DJ',
        'Dominika'  => 'DM',
        'Dominikanische Republik'  => 'DO',
        'Ecuador'  => 'EC',
        'El Salvador'  => 'SV',
        'Elfenbeink&uuml;ste'  => 'CI',
        'Eritrea'  => 'ER',
        'Estland'  => 'EE',
        'Falkland Inseln'  => 'FK',
        'F&auml;r&ouml;er Inseln'  => 'FO',
        'Fidschi'  => 'FJ',
        'Finnland'  => 'FI',
        'Frankreich'  => 'FR',
        'Franz&ouml;sisch Guyana'  => 'GF',
        'Franz&ouml;sisch Polynesien'  => 'PF',
        'Franz&ouml;sisches S&uuml;d-Territorium'  => 'TF',
        'Gabun'  => 'GA',
        'Gambia'  => 'GM',
        'Georgien'  => 'GE',
        'Ghana'  => 'GH',
        'Gibraltar'  => 'GI',
        'Grenada'  => 'GD',
        'Griechenland'  => 'GR',
        'Gr&ouml;nland'  => 'GL',
        'Großbritannien (UK)'  => 'UK',
        'Großbritannien'  => 'GB',
        'Guadeloupe'  => 'GP',
        'Guam'  => 'GU',
        'Guatemala'  => 'GT',
        'Guinea'  => 'GN',
        'Guinea Bissau'  => 'GW',
        'Guyana'  => 'GY',
        'Haiti'  => 'HT',
        'Heard und McDonald Islands'  => 'HM',
        'Honduras'  => 'HN',
        'Hong Kong'  => 'HK',
        'Indien'  => 'IN',
        'Indonesien'  => 'ID',
        'Irak'  => 'IQ',
        'Iran'  => 'IR',
        'Irland'  => 'IE',
        'Island'  => 'IS',
        'Israel'  => 'IL',
        'Italien'  => 'IT',
        'Jamaika'  => 'JM',
        'Japan'  => 'JP',
        'Jemen'  => 'YE',
        'Jordanien'  => 'JO',
        'Jugoslawien'  => 'YU',
        'Kaiman Inseln'  => 'KY',
        'Kambodscha'  => 'KH',
        'Kamerun'  => 'CM',
        'Kanada'  => 'CA',
        'Kap Verde'  => 'CV',
        'Kasachstan'  => 'KZ',
        'Kenia'  => 'KE',
        'Kirgisistan'  => 'KG',
        'Kiribati'  => 'KI',
        'Kokosinseln'  => 'CC',
        'Kolumbien'  => 'CO',
        'Komoren'  => 'KM',
        'Kongo'  => 'CG',
        'Kongo, Demokratische Republik'  => 'CD',
        'Kroatien'  => 'HR',
        'Kuba'  => 'CU',
        'Kuwait'  => 'KW',
        'Laos'  => 'LA',
        'Lesotho'  => 'LS',
        'Lettland'  => 'LV',
        'Libanon'  => 'LB',
        'Liberia'  => 'LR',
        'Libyen'  => 'LY',
        'Liechtenstein'  => 'LI',
        'Litauen'  => 'LT',
        'Luxemburg'  => 'LU',
        'Macao'  => 'MO',
        'Madagaskar'  => 'MG',
        'Malawi'  => 'MW',
        'Malaysia'  => 'MY',
        'Malediven'  => 'MV',
        'Mali'  => 'ML',
        'Malta'  => 'MT',
        'Marianen'  => 'MP',
        'Marokko'  => 'MA',
        'Marshall Inseln'  => 'MH',
        'Martinique'  => 'MQ',
        'Mauretanien'  => 'MR',
        'Mauritius'  => 'MU',
        'Mayotte'  => 'YT',
        'Mazedonien'  => 'MK',
        'Mexiko'  => 'MX',
        'Mikronesien'  => 'FM',
        'Mocambique'  => 'MZ',
        'Moldavien'  => 'MD',
        'Monaco'  => 'MC',
        'Mongolei'  => 'MN',
        'Montserrat'  => 'MS',
        'Namibia'  => 'NA',
        'Nauru'  => 'NR',
        'Nepal'  => 'NP',
        'Neukaledonien'  => 'NC',
        'Neuseeland'  => 'NZ',
        'Nicaragua'  => 'NI',
        'Niederlande'  => 'NL',
        'Niederl&auml;ndische Antillen'  => 'AN',
        'Niger'  => 'NE',
        'Nigeria'  => 'NG',
        'Niue'  => 'NU',
        'Nord Korea'  => 'KP',
        'Norfolk Inseln'  => 'NF',
        'Norwegen'  => 'NO',
        'Oman'  => 'OM',
        '&Ouml;sterreich'  => 'AT',
        'Pakistan'  => 'PK',
        'Pal&auml;stina'  => 'PS',
        'Palau'  => 'PW',
        'Panama'  => 'PA',
        'Papua Neuguinea'  => 'PG',
        'Paraguay'  => 'PY',
        'Peru'  => 'PE',
        'Philippinen'  => 'PH',
        'Pitcairn'  => 'PN',
        'Polen'  => 'PL',
        'Portugal'  => 'PT',
        'Puerto Rico'  => 'PR',
        'Qatar'  => 'QA',
        'Reunion'  => 'RE',
        'Ruanda'  => 'RW',
        'Rum&auml;nien'  => 'RO',
        'Ru&szlig;land'  => 'RU',
        'Saint Lucia'  => 'LC',
        'Sambia'  => 'ZM',
        'Samoa'  => 'AS',
        'Samoa'  => 'WS',
        'San Marino'  => 'SM',
        'Sao Tome'  => 'ST',
        'Saudi Arabien'  => 'SA',
        'Schweden'  => 'SE',
        'Schweiz'  => 'CH',
        'Senegal'  => 'SN',
        'Seychellen'  => 'SC',
        'Sierra Leone'  => 'SL',
        'Singapur'  => 'SG',
        'Slowakei -slowakische Republik-'  => 'SK',
        'Slowenien'  => 'SI',
        'Solomon Inseln'  => 'SB',
        'Somalia'  => 'SO',
        'South Georgia, South Sandwich Isl.'  => 'GS',
        'Spanien'  => 'ES',
        'Sri Lanka'  => 'LK',
        'St. Helena'  => 'SH',
        'St. Kitts Nevis Anguilla'  => 'KN',
        'St. Pierre und Miquelon'  => 'PM',
        'St. Vincent'  => 'VC',
        'S&uuml;d Korea'  => 'KR',
        'S&uuml;dafrika'  => 'ZA',
        'Sudan'  => 'SD',
        'Surinam'  => 'SR',
        'Svalbard und Jan Mayen Islands'  => 'SJ',
        'Swasiland'  => 'SZ',
        'Syrien'  => 'SY',
        'Tadschikistan'  => 'TJ',
        'Taiwan'  => 'TW',
        'Tansania'  => 'TZ',
        'Thailand'  => 'TH',
        'Timor'  => 'TP',
        'Togo'  => 'TG',
        'Tokelau'  => 'TK',
        'Tonga'  => 'TO',
        'Trinidad Tobago'  => 'TT',
        'Tschad'  => 'TD',
        'Tschechische Republik'  => 'CZ',
        'Tunesien'  => 'TN',
        'T&uuml;rkei'  => 'TR',
        'Turkmenistan'  => 'TM',
        'Turks und Kaikos Inseln'  => 'TC',
        'Tuvalu'  => 'TV',
        'Uganda'  => 'UG',
        'Ukraine'  => 'UA',
        'Ungarn'  => 'HU',
        'Uruguay'  => 'UY',
        'Usbekistan'  => 'UZ',
        'Vanuatu'  => 'VU',
        'Vatikan'  => 'VA',
        'Venezuela'  => 'VE',
        'Vereinigte Arabische Emirate'  => 'AE',
        'Vereinigte Staaten von Amerika'  => 'US',
        'Vietnam'  => 'VN',
        'Virgin Island (Brit.)'  => 'VG',
        'Virgin Island (USA)'  => 'VI',
        'Wallis et Futuna'  => 'WF',
        'Wei&szlig;ru&szlig;land'  => 'BY',
        'Westsahara'  => 'EH',
        'Zentralafrikanische Republik'  => 'CF',
        'Zimbabwe'  => 'ZW',
        'Zypern'  => 'CY'
          );

    $Values = array();
    while(list($Key,$Val) = each($laender))
      $Values[$Val] = $Key;

    if($laenderliste) 
      return $laender;
    else
      return $Values;
  }


  function GetFirmaBCC1()
  {
    $email = $this->app->DB->Select("SELECT bcc1 FROM firmendaten LIMIT 1");
    return $email;
  }

  function GetFirmaBCC2()
  {
    $email = $this->app->DB->Select("SELECT bcc2 FROM firmendaten LIMIT 1");
    return $email;
  }

  function GetFirmaMail()
  {
    $email = $this->app->DB->Select("SELECT email FROM firmendaten LIMIT 1");
    return $email;
  }

  function GetFirmaName()
  {
    $name = $this->app->DB->Select("SELECT name FROM firma WHERE id='1' LIMIT 1");
    return $name;
  }


  function GetSelectEmailMitName($selected="")
  {
    $own = $this->app->User->GetEmail();
    $name = $this->app->User->GetName();

    $firmendatenid = $this->app->DB->Select("SELECT MAX(id) FROM firmendaten LIMIT 1");

    $email_addr = $this->app->DB->SelectArr("SELECT email FROM firmendaten ORDER by email");
    $absendernamefirma = $this->app->DB->SelectArr("SELECT absendername FROM firmendaten ORDER by email");
    $firmenname = $this->app->DB->Select("SELECT name FROM firmendaten WHERE id=$firmendatenid");
    
    if($absendernamefirma[0]['absendername']=="") $absendernamefirma[0]['absendername']= $firmenname;


    $emails = array();

    if($this->app->User->GetField("email_bevorzugen")=="1")
    {
      if($own!='' && $name!='')
        $emails[] = $name." &lt;".$own."&gt;";
    }

    $i=0;
    foreach($email_addr AS $mail)
    {
      if($absendernamefirma[$i]['absendername']!="" && $mail['email']!="")
        $emails[] = $absendernamefirma[$i]['absendername']." &lt;".$mail['email']."&gt;";
    }

    if($this->app->User->GetField("email_bevorzugen")!="1")
    {
      if($own!='' && $name!='')
        $emails[] = $name." &lt;".$own."&gt;";
    }

    for($i=0;$i<count($emails);$i++)
    {
      if($emails[$i]==$selected) $mark="selected"; else $mark="";
      $tpl .="<option value=\"{$emails[$i]}\" $mark>{$emails[$i]}</option>";
    }
    return $tpl;
  }


  function GetSelectEmail($selected="")
  {
    $own = $this->app->User->GetEmail();
    $email_addr = $this->app->DB->SelectArr('SELECT email FROM firmendaten ORDER BY email');

    $emails = array();

    if($this->app->User->GetField("email_bevorzugen")=="1")
    {
      if($own!='')
        $emails[] = $own;
    }

    foreach($email_addr AS $mail)
      $emails[] = $mail['email'];


    if($this->app->User->GetField("email_bevorzugen")!="1")
    {
      if($own!='')
        $emails[] = $own;
    }

    for($i=0;$i<count($emails);$i++)
    {
      if($emails[$i]==$selected) $mark="selected"; else $mark="";
      $tpl .="<option value=\"{$emails[$i]}\" $mark>{$emails[$i]}</option>";
    }
    return $tpl;
  }

  function GetSelectDokumentKunde($typ,$adresse,$select)
  {

    $typ_bezeichnung = ucfirst($typ);
    $result = $this->app->DB->SelectArr("SELECT CONCAT('$typ_bezeichnung ',if(status='angelegt','ENTWURF',belegnr),' (Status: ',status,') vom ',DATE_FORMAT(datum,'%d.%m.%Y')) as 
        result,id  FROM $typ WHERE adresse='$adresse' ORDER by datum DESC");
    for($i=0;$i<count($result);$i++)
    {
      $tmp .= "<option value=\"".$result[$i]['id']."\">".$result[$i]['result']."</option>";
    }

    return $tmp;

  }


  function GetSelectAuftragKunde($adresse,$select="")
  {
    return $this->GetSelectDokumentKunde("auftrag",$adresse,$select);
  }

  function GetSelectRechnungKunde($adresse,$select="")
  {

    return $this->GetSelectDokumentKunde("rechnung",$adresse,$select);
  }

  function GetSelectArbeitsnachweisKunde($adresse,$select="")
  {
    return $this->GetSelectDokumentKunde("arbeitsnachweis",$adresse,$select);
  }




  function GetSelectAnsprechpartner($adresse, $selected="")
  {
    $first = $this->app->DB->Select("SELECT CONCAT(ansprechpartner,' &lt;',email,'&gt;') FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
    $firstname = $this->app->DB->Select("SELECT ansprechpartner FROM adresse WHERE id='$adresse' LIMIT 1");
    if($firstname=="") $first = $this->app->DB->Select("SELECT CONCAT(name,' &lt;',email,'&gt;') FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

    $others = $this->app->DB->SelectArr("SELECT id, CONCAT(name,' (',bereich,')',' &lt;',email,'&gt;') as name FROM ansprechpartner WHERE adresse='$adresse'");

    $tpl ="<option value=\"0\">$first</option>";

    for($i=0;$i<count($others);$i++)
    {
      if($others[$i][id]==$selected) $mark="selected"; else $mark="";
      $tpl .="<option value=\"{$others[$i][id]}\" $mark>{$others[$i][name]}</option>";
    }
    return $tpl;
  }

  function GetVorgaenger($projekt,$disableid="")
  {
    $user = $this->app->DB->SelectArr("SELECT * FROM arbeitspaket WHERE projekt='".$projekt."' AND id!='$disableid' AND art!='material'");
    //    $user = $this->app->DB->SelectArr("SELECT * FROM arbeitspaket WHERE projekt='".$projekt."'");
    $tpl[0]="keinen";
    for($i=0;$i<count($user);$i++)
    {
      //if($user[$i][id]==$selected) $mark="selected"; else $mark="";
      //$tpl .="<option value=\"{$user[$i][id]}\" $mark>{$user[$i][aufgabe]}</option>";
      $tpl[$user[$i][id]]=$user[$i][aufgabe];
    }
    return $tpl;
  }


  function GetMitarbeiter()
  {
    $user = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE mitarbeiternummer!='' AND mitarbeiternummer!=0 AND geloescht!=1 ORDER by name");
    for($i=0;$i<count($user);$i++)
    {
      //$tmp[(string)$user[$i][id]] = "{$user[$i][nummer]}- {$user[$i][beschreibung]}";
      $tmp[$i]['id'] = $user[$i]['id'];
      $tmp[$i]['name'] = $user[$i]['name'];
    }
    return $tmp;
  }


  function GetReisekostenartAssoc()
  {
    $user = $this->app->DB->SelectArr("SELECT * FROM reisekostenart ORDER by nummer");
    for($i=0;$i<count($user);$i++)
    {
      //$tmp[(string)$user[$i][id]] = "{$user[$i][nummer]}- {$user[$i][beschreibung]}";
      $tmp[(string)$user[$i][id]] = "{$user[$i][nummer]}- {$user[$i][beschreibung]}";
    }
    return $tmp;
  }

  function GetSelectBezahltWie()
  {
    $tmp = $this->GetBezahltWieAssoc();

    foreach($tmp as $key=>$value)
      $result .= "<option value=\"$key\">$value</option>";
    return $result;
  }


  function GetSelectEtiketten($art,$selected="")
  {
    $user = $this->app->DB->SelectArr("SELECT * FROM etiketten WHERE verwendenals='$art' ORDER by name");
    for($i=0;$i<count($user);$i++)
    {
      if($user[$i][id]==$selected) $mark="selected"; else $mark="";
      $tpl .="<option value=\"{$user[$i][id]}\" $mark>{$user[$i][name]}</option>";
    }
    return $tpl;
  }


  function GetSelectReisekostenart($selected="")
  {
    $user = $this->app->DB->SelectArr("SELECT * FROM reisekostenart ORDER by nummer");
    for($i=0;$i<count($user);$i++)
    {
      if($user[$i][id]==$selected) $mark="selected"; else $mark="";
      $tpl .="<option value=\"{$user[$i][id]}\" $mark>{$user[$i][nummer]}- {$user[$i][beschreibung]}</option>";
    }
    return $tpl;
  }

  function GetSelectUserVorlage($selected="",$disableid="")
  {
    $user = $this->app->DB->SelectArr("SELECT * FROM uservorlage WHERE id!='$disableid' ORDER by bezeichnung");
    for($i=0;$i<count($user);$i++)
    {
      if($user[$i][id]==$selected) $mark=" selected"; else $mark="";
      $tpl .="<option value=\"{$user[$i][id]}\"$mark>{$user[$i][bezeichnung]}</option>";
    }
    return $tpl;
  }

  function GetSelectUser($selected="",$disableid="")
  {
    $user = $this->app->DB->SelectArr("SELECT * FROM user WHERE id!='$disableid'");
    for($i=0;$i<count($user);$i++)
    {
      $user[$i][description] = $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$user[$i][adresse]."' LIMIT 1");
      if($user[$i][id]==$selected) $mark="selected"; else $mark="";
      $tpl .="<option value=\"{$user[$i][id]}\" $mark>{$user[$i][description]}</option>";
    }
    return $tpl;
  }


  function GetIPAdapterbox($id)
  {
    return $this->app->DB->Select("SELECT adapterboxip FROM drucker WHERE id='$id' LIMIT 1");
  }

  function GetSelectEtikettenDrucker($selected="")
  {
    //if($selected=="")
    //  $selected = $this->app->DB->Select("SELECT standardetikett FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");

    //$check = $this->app->DB->Select("SELECT id FROM drucker WHERE id='$selected' AND aktiv='1' LIMIT 1"); 
    //if($check!=$selected) $selected="";

    //if($selected=="")
    //  $selected = $this->Firmendaten("standardetikettendrucker");

    if($selected=="0" || $selected=="")
      $tpl .="<option value=\"0\" selected>-- kein --</option>";
    else
      $tpl .="<option value=\"0\">-- kein --</option>";

    $drucker = $this->app->DB->SelectArr("SELECT id, name FROM  drucker WHERE aktiv='1' AND art='2'");
    for($i=0;$i<count($drucker);$i++)
    {
      if($drucker[$i][id]==$selected) $mark="selected"; else $mark="";
      $tpl .="<option value=\"{$drucker[$i][id]}\" $mark>{$drucker[$i][name]}</option>";
    }
    return $tpl;
  }

  function GetSelectFax($selected="")
  {
    if($selected=="")
      $selected = $this->app->DB->Select("SELECT standardfax FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");

    $check = $this->app->DB->Select("SELECT id FROM drucker WHERE id='$selected' AND aktiv='1' LIMIT 1"); 
    if($check!=$selected) $selected="";

    if($selected=="")
      $selected = $this->Firmendaten("standardfax");

    //$tpl .="<option value=\"0\">-- kein --</option>";
    $drucker = $this->app->DB->SelectArr("SELECT id, name FROM  drucker WHERE aktiv='1' AND art='1'");
    for($i=0;$i<count($drucker);$i++)
    {
      if($drucker[$i][id]==$selected) $mark="selected"; else $mark="";
      $tpl .="<option value=\"{$drucker[$i][id]}\" $mark>{$drucker[$i][name]}</option>";
    }
    return $tpl;
  }


  function GetEtiketten()
  {
    //$tpl .="<option value=\"0\">-- kein --</option>";
    $drucker = $this->app->DB->SelectArr("SELECT id, name FROM etiketten");
    for($i=0;$i<count($drucker);$i++)
    {
      $result[$drucker[$i][id]]=$drucker[$i][name];
    }
    return $result;
  }


  function GetWaage()
  {
    //$tpl .="<option value=\"0\">-- kein --</option>";
    $drucker = $this->app->DB->SelectArr("SELECT id, bezeichnung FROM adapterbox WHERE verwendenals='waage'");
    for($i=0;$i<count($drucker);$i++)
    {
      $result[$drucker[$i][id]]=$drucker[$i][bezeichnung];
    }
    return $result;
  }


  function GetEtikettendrucker()
  {
    //$tpl .="<option value=\"0\">-- kein --</option>";
    $drucker = $this->app->DB->SelectArr("SELECT id, name FROM  drucker WHERE aktiv='1' AND art='2'");
    for($i=0;$i<count($drucker);$i++)
    {
      //if($drucker[$i][id]==$selected) $mark="selected"; else $mark="";
      //$tpl .="<option value=\"{$drucker[$i][id]}\" $mark>{$drucker[$i][name]}</option>";
      $result[$drucker[$i][id]]=$drucker[$i][name];
    }
    return $result;
  }


  function GetDrucker()
  {
    //$tpl .="<option value=\"0\">-- kein --</option>";
    $drucker = $this->app->DB->SelectArr("SELECT id, name FROM  drucker WHERE aktiv='1' AND art='0'");
    for($i=0;$i<count($drucker);$i++)
    {
      //if($drucker[$i][id]==$selected) $mark="selected"; else $mark="";
      //$tpl .="<option value=\"{$drucker[$i][id]}\" $mark>{$drucker[$i][name]}</option>";
      $result[$drucker[$i][id]]=$drucker[$i][name];
    }
    return $result;
  }

  function GetSelectDrucker($selected="")
  {
    if($selected=="")
      $selected = $this->app->DB->Select("SELECT standarddrucker FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");

    $check = $this->app->DB->Select("SELECT id FROM  drucker WHERE id='$selected' AND aktiv='1' LIMIT 1"); 
    if($check!=$selected) $selected="";

    if($selected=="")
      $selected = $this->Firmendaten("standardversanddrucker");

    //$tpl .="<option value=\"0\">-- kein --</option>";
    $drucker = $this->app->DB->SelectArr("SELECT id, name FROM  drucker WHERE aktiv='1' AND art='0'");
    for($i=0;$i<count($drucker);$i++)
    {
      if($drucker[$i][id]==$selected) $mark="selected"; else $mark="";
      $tpl .="<option value=\"{$drucker[$i][id]}\" $mark>{$drucker[$i][name]}</option>";
    }
    return $tpl;
  }

  function Grusswort($sprache)
  {

    //abhaenig von Zeit usw.. passende Grußformel
    /*
       return "Grüße aus dem sonnigen Ausgburg.";
       return "Grüße aus Ausgburg.";
       return "Frohe Ostern.";
       return "Schöne Feierabend.";
       return "Frohe Weihnachten.";
       return "Schönes Wochenende.";
     */
    if($sprache=="englisch") return "\nKind regards,";
    return "\nMit freundlichen Grüßen";

  }

  function DokumentSendVorlage($id)
  {
    $betreff = $this->app->DB->Select("SELECT betreff FROM dokumente_send WHERE id='$id' LIMIT 1");
    $text  = $this->app->DB->Select("SELECT text FROM dokumente_send WHERE id='$id' LIMIT 1");

    $this->app->Tpl->Set('BETREFF',$betreff);
    $this->app->Tpl->Set('TEXT',$text);
  }

  function Geschaeftsbriefvorlage($sprache,$subjekt,$projekt="",$name="",$id="")
  {
    $lowersubjekt = strtolower($subjekt);   
    if($lowersubjekt=="angebot" || $lowersubjekt=="auftrag" ||$lowersubjekt=="bestellung" ||
        $lowersubjekt=="lieferschein" ||$lowersubjekt=="rechnung" ||$lowersubjekt=="gutschrift" || $lowersubjekt=="arbeitsnachweis"){
      if($id > 0) {
        $belegnr = $this->app->DB->Select("SELECT belegnr FROM $lowersubjekt WHERE id='$id' LIMIT 1");
        $adresse = $this->app->DB->Select("SELECT adresse FROM $lowersubjekt WHERE id='$id' LIMIT 1");
        $anschreiben = $this->app->DB->Select("SELECT anschreiben FROM adresse WHERE id='$adresse' LIMIT 1");
      }
    }
    /*
       if($projekt > 0)
       {
       $betreff = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE sprache = '$sprache' AND subjekt='$subjekt' AND projekt='$projekt' LIMIT 1");
       $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE sprache = '$sprache' AND subjekt='$subjekt' AND projekt='$projekt' LIMIT 1");
       } else {
       $betreff = $this->app->DB->Select("SELECT betreff FROM geschaeftsbrief_vorlagen WHERE sprache = '$sprache' AND subjekt='$subjekt' AND (projekt='0' OR projekt='') LIMIT 1");
       $text = $this->app->DB->Select("SELECT text FROM geschaeftsbrief_vorlagen WHERE sprache = '$sprache' AND subjekt='$subjekt' AND (projekt='0' OR projekt='') LIMIT 1");
       }
     */      

    $text = $this->GetGeschaeftsBriefText($subjekt,$sprache,$projekt);
    $betreff = $this->GetGeschaeftsBriefBetreff($subjekt,$sprache,$projekt);

    $text = str_replace('{NAME}',$name,$text);
    $text = str_replace('{BELEGNR}',$belegnr,$text);
    $text = str_replace('{ANSCHREIBEN}',$anschreiben,$text);

    $betreff = str_replace('{NAME}',$name,$betreff);
    $betreff = str_replace('{BELEGNR}',$belegnr,$betreff);
    $betreff = str_replace('{ANSCHREIBEN}',$anschreiben,$betreff);

    $this->app->Tpl->Set('BETREFF',$betreff);
    $this->app->Tpl->Set('TEXT',$text);
    return array("betreff"=>$betreff,"text"=>$text);
  }

  function GetAnsprechpartner($data)
  {
    // $data: 'Admin <admin@test.de>'
    // return id, name, email

    $first = strpos($data, '<');
    $last = strpos($data, '>');

    $name = trim(substr($data, 0, $first));
    $email = trim(substr($data, $first+1, $last-($first+1)));

    $id = $this->app->DB->Select("SELECT id FROM adresse WHERE email='$mail' LIMIT 1"); 
    if(!(is_numeric($id) && $id<1))
      $id = $this->app->DB->Select("SELECT id FROM adresse WHERE name='$name' LIMIT 1");

    if(!is_numeric($id)) $id = 0;

    return array('id'=>$id, 'name'=>$name, 'email'=>$email);
  }


  function RemoveReadonly($feld)
  {
    $this->app->Tpl->Add('JQUERY','$("#'.$feld.'").removeAttr("disabled","disabled");');
    $this->app->Tpl->Add('JQUERY','$("#'.$feld.'").removeAttr("readonly","readonly");');
    $this->app->Tpl->Add('JQUERY','$("#'.$feld.'").css("background-color", "white");');
  }


  function CommonReadonly()
  {
    $this->commonreadonly=1;
    //$this->app->Tpl->Set(COMMONREADONLYINPUT,"readonly disabled style=\"background-color:rgb(255, 230, 213);\"");
    //$this->app->Tpl->Set(COMMONREADONLYSELECT,"disabled=\"disabled\" style=\"background-color:rgb(255, 230, 213);\"");
    $this->app->Tpl->Set('COMMONREADONLYINPUT',"readonly disabled style=\"background-color:#eee; border-color:#ddd;\"");
    $this->app->Tpl->Set('COMMONREADONLYSELECT',"disabled=\"disabled\" style=\"background-color:#eee;\"");

  }

  function DokumentMask($parsetarget,$typ,$id,$adresse,$projekt="",$popup=false)
  {

    $this->app->Tpl->Set('SID',$id);
    $this->app->Tpl->Set('TYP',$typ);


    //echo "typ $typ<br>id $id adresse $adresse<br><br>";

    $betreff = $this->app->Secure->GetPOST("betreff");
    $projekt_submit = $this->app->Secure->GetPOST("projekt");
    $ansprechpartner = $this->app->Secure->POST["ansprechpartner"];
    $text = $this->app->Secure->GetPOST("text");
    $art = $this->app->Secure->GetPOST("senden");


    list($name, $email) = explode('<', trim($ansprechpartner,'>'));

    $partnerinfo['email'] = $email;
    $partnerinfo['name'] = $name;

    //$partnerinfo = $this->GetAnsprechpartner($ansprechpartner);
    //$ansprechpartner = $partnerinfo['id'];

    if($projekt=="" && $projekt_submit!="")
      $projekt = $projekt_submit;

    // hole standard projekt von adresse
    if($projekt=="")
      $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");


    if($typ!="brieffax")
      $projektbriefpapier = $this->app->DB->Select("SELECT projekt FROM $typ WHERE id='$id' LIMIT 1");

    // anschreiben
    //if($typ=="bestellung" || $typ=="lieferschein" || $typ=="rechnung" || $typ=="angebot" || ($typ=="brieffax" && $art!="email") )
    if($typ=="bestellung" || $typ=="angebot" || $typ=="arbeitsnachweis" ||$typ=="reisekosten" || $typ=="lieferschein" || $typ=="auftrag" || ($typ=="brieffax" && $art!="email") )
    {
      /*
      // update status freigegebn auf versendet
      $Brief = new BriefPDF(&$this->app);

      if($art == "fax")
      $Brief->GetBriefTMP($adresse,$betreff,$text,1);
      else
      $Brief->GetBriefTMP($adresse,$betreff,$text);

      if($art !="email")
      $tmpbrief= $Brief->displayTMP();
       */
    }

    // eigentliches dokument
    if($typ=="bestellung")
    {
      // sende 
      $Brief = new BestellungPDF($this->app,$projektbriefpapier);
      $Brief->GetBestellung($id);
      $tmpfile = $Brief->displayTMP();
      $Brief->ArchiviereDocument();
    }
    // eigentliches dokument
    if($typ=="angebot")
    {
      // sende 
      $Brief = new AngebotPDF($this->app,$projektbriefpapier);
      $Brief->GetAngebot($id);
      $tmpfile = $Brief->displayTMP();
      $Brief->ArchiviereDocument();
    }
    // eigentliches dokument
    if($typ=="lieferschein")
    {
      // sende 
      $Brief = new LieferscheinPDF($this->app,$projektbriefpapier);
      $Brief->GetLieferschein($id);
      $tmpfile = $Brief->displayTMP();
      $Brief->ArchiviereDocument();
    }
    // eigentliches dokument
    if($typ=="arbeitsnachweis")
    {
      // sende 
      $Brief = new ArbeitsnachweisPDF($this->app,$projektbriefpapier);
      $Brief->GetArbeitsnachweis($id);
      $tmpfile = $Brief->displayTMP();
      $Brief->ArchiviereDocument();
    }
    // eigentliches dokument
    if($typ=="reisekosten")
    {
      // sende 
      $Brief = new ReisekostenPDF($this->app,$projektbriefpapier);
      $Brief->GetReisekosten($id);
      $tmpfile = $Brief->displayTMP();
      $Brief->ArchiviereDocument();
    }

    // eigentliches dokument
    if($typ=="auftrag")
    {
      // sende 
      $Brief = new AuftragPDF($this->app,$projektbriefpapier);
      $Brief->GetAuftrag($id);
      $tmpfile = $Brief->displayTMP();
      $Brief->ArchiviereDocument();
    }
    // eigentliches dokument
    if($typ=="rechnung")
    {
      // sende 
      $Brief = new RechnungPDF($this->app,$projektbriefpapier);
      $Brief->GetRechnung($id);
      //$Brief->ArchiviereDocument();
      $tmpfile = $Brief->displayTMP();
      $Brief->ArchiviereDocument();
    }

    // eigentliches dokument
    if($typ=="gutschrift")
    {
      // sende 
      $Brief = new GutschriftPDF($this->app,$projektbriefpapier);
      $Brief->GetGutschrift($id);
      $tmpfile = $Brief->displayTMP();
      $Brief->ArchiviereDocument();
    }


    if($art == "email")
    {
      $dateien = array($tmpfile);
      foreach($_POST as $pk => $pv)
      {
        $pka = explode('_',$pk);
        if($pka[0] == 'datei' && isset($pka[1]) && $pka[1] && is_numeric($pka[1])){
          $dateiname = $this->app->erp->GetDateiName($pka[1]);
          if($dateiname)
          {
            $dateiinhalt = $this->app->erp->GetDatei($pka[1]);
            
            if($handle = fopen ($this->app->erp->GetTMP()."/".$dateiname, "wb"))
            {
              fwrite($handle, $dateiinhalt);
              fclose($handle);
              $dateien[] = $this->app->erp->GetTMP()."/".$dateiname;
              $zuloeschen[]  = $this->app->erp->GetTMP()."/".$dateiname;
            }                   
          }
          
        }
        
      }
      
      
      
      
    }
    else
    {
      if($typ=="brieffax")
        $dateien = array($tmpbrief);
      else
        $dateien = array($tmpbrief,$tmpfile);
    }
    if($art == "brief") $drucker = $this->app->Secure->GetPOST("drucker_brief");
    else if($art == "fax") $drucker = $this->app->Secure->GetPOST("drucker_fax");
    else if ($art == "email") $drucker = $this->app->Secure->GetPOST("email_from");

    if($this->app->Secure->GetPOST("submit")!="")
    {

      //echo "SENDEN";
      if($art=="fax")
        $ret = $this->DokumentSend($adresse,$typ,$id,$art,$betreff,$text,$dateien,$drucker,$ansprechpartner,$projekt, $this->app->Secure->GetPOST("faxnummer"),"");
      else
        $ret = $this->DokumentSend($adresse,$typ,$id,$art,$betreff,$text,$dateien,$drucker,$ansprechpartner,$projekt, $partnerinfo['email'], $partnerinfo['name']);

      if(isset($zuloeschen) && is_array($zuloeschen))
      {
        foreach($zuloeschen as $zl)unlink($zl);
        unset($zuloeschen);
      }
      
      /*
      // NEU ANLEGEN ODER UPDATE
      if($typ=="brieffax")
      {
      $check = $this->app->DB->Select("SELECT id FROM dokumente_send WHERE text='$text' AND betreff='$betreff' AND geloescht=0 AND versendet=0 ORDER by id DESC LIMIT 1");
      } else {
      $check = $this->app->DB->Select("SELECT id FROM dokumente_send WHERE dokument='$typ' AND parameter='$id' AND geloescht=0 AND versendet=0 ORDER by id DESC LIMIT 1"); // GEHT bei BE RE LS
      }
       */

      //Datei anlegen
      $fileid = $this->CreateDatei($Brief->filename,$module,"","",$tmpfile,$this->app->User->GetName());

      $this->AddDateiStichwort($fileid,$typ,$typ,$id,$without_log=false);


      if(is_numeric($check) && $check >0)
      {
        /*
           if($typ=="brieffax")
           {        
        // das dokument gibt es so bereits 1:1 hier braucht man nichts machen
        //echo "DAS DOKUMENT GIBT ES UNVERSENDET SO";
        $this->app->DB->Update("UPDATE dokumente_send SET versendet=1 WHERE id='$check' LIMIT 1");
        }
        else
        {
        $this->app->DB->Update("UPDATE dokumente_send SET betreff='$betreff', text='$text',versendet=1 WHERE dokument='$typ' AND parameter='$id' AND geloescht=0 AND versendet=0 LIMIT 1");  // GEHT bei RE, LS ..
        }
         */
      } else {
        if($typ=="brieffax")
        {
          $this->app->DB->Insert("INSERT INTO dokumente_send 
              (id,dokument,zeit,bearbeiter,adresse,parameter,art,betreff,text,projekt,ansprechpartner,versendet,dateiid) VALUES ('','$typ',NOW(),'".$this->app->User->GetName()."',
                '$adresse','$parameter','$art','$betreff','$text','$projekt','$ansprechpartner',1,'$fileid')");
          $tmpid = $this->app->DB->GetInsertID();
          $this->app->DB->Update("UPDATE dokumente_send SET parameter='$tmpid' WHERE id='$tmpid' LIMIT 1");
          //echo "INSERT brieffax dokument";
        } else {
          //echo "anlegen begleitschreiben RE, LS";
          //TODO ANSPRECHPARTNER
          $this->app->DB->Insert("INSERT INTO dokumente_send 
              (id,dokument,zeit,bearbeiter,adresse,parameter,art,betreff,text,projekt,ansprechpartner,versendet,dateiid) VALUES ('','$typ',NOW(),'".$this->app->User->GetName()."',
                '$adresse','$id','$art','$betreff','$text','$projekt','$ansprechpartner',1,'$fileid')");
          $tmpid = $this->app->DB->GetInsertID();
        }

      }

      if($ret == "")
      {
        $this->app->Tpl->Set($parsetarget,"<div class=\"info\">Dokument wurde erfolgreich versendet</div>");

        /* Status gezielt von Dokument aendern */
        if($typ=="bestellung")
        {
          $this->app->DB->Update("UPDATE bestellung SET versendet=1, versendet_am=NOW(),
              versendet_per='$art',versendet_durch='".$this->app->User->GetName()."',status='versendet',schreibschutz='1' WHERE id='$id' LIMIT 1");
          $this->BestellungProtokoll($id,"Bestellung versendet");
          //TODO ARCHIVIEREN
        } 
        else if($typ=="angebot")
        {
          $this->app->DB->Update("UPDATE angebot SET versendet=1, versendet_am=NOW(),
              versendet_per='$art',versendet_durch='".$this->app->User->GetName()."',status='versendet',schreibschutz='1' WHERE id='$id' LIMIT 1");
          $this->AngebotProtokoll($id,"Angebot versendet");
          //TODO ARCHIVIEREN
        } 
        else if($typ=="lieferschein")
        {
          $this->app->DB->Update("UPDATE lieferschein SET versendet=1, versendet_am=NOW(),
              versendet_per='$art',versendet_durch='".$this->app->User->GetName()."',status='versendet',schreibschutz='1' WHERE id='$id' LIMIT 1");
          $this->LieferscheinProtokoll($id,"Lieferschein versendet");
          //TODO ARCHIVIEREN
        } 
        else if($typ=="arbeitsnachweis")
        {
          $this->app->DB->Update("UPDATE arbeitsnachweis SET versendet=1, versendet_am=NOW(),
              versendet_per='$art',versendet_durch='".$this->app->User->GetName()."',status='versendet',schreibschutz='1' WHERE id='$id' LIMIT 1");
          $this->ArbeitsnachweisProtokoll($id,"Arbeitsnachweis versendet");
          //TODO ARCHIVIEREN
        } 
        else if($typ=="reisekosten")
        {
          $this->app->DB->Update("UPDATE reisekosten SET versendet=1, versendet_am=NOW(),
              versendet_per='$art',versendet_durch='".$this->app->User->GetName()."',status='versendet',schreibschutz='1' WHERE id='$id' LIMIT 1");
          $this->ReisekostenProtokoll($id,"Reisekosten versendet");
          //TODO ARCHIVIEREN
        } 

        else if($typ=="auftrag")
        {
          $this->app->DB->Update("UPDATE auftrag SET versendet=1, versendet_am=NOW(),
              versendet_per='$art',versendet_durch='".$this->app->User->GetName()."',schreibschutz='1' WHERE id='$id' LIMIT 1");
          $this->AuftragProtokoll($id,"Auftrag versendet");
          //TODO ARCHIVIEREN
        } 
        else if ($typ=="rechnung")
        {
          $this->app->DB->Update("UPDATE rechnung SET versendet=1, versendet_am=NOW(),
              versendet_per='$art',versendet_durch='".$this->app->User->GetName()."',status='versendet',schreibschutz='1' WHERE id='$id' LIMIT 1");
          $this->RechnungProtokoll($id,"Rechnung versendet");
          //TODO ARCHIVIEREN
        }
        else if ($typ=="gutschrift")
        {
          $this->app->DB->Update("UPDATE gutschrift SET versendet=1, versendet_am=NOW(),
              versendet_per='$art',versendet_durch='".$this->app->User->GetName()."',status='versendet',schreibschutz='1' WHERE id='$id' LIMIT 1");
          $this->GutschriftProtokoll($id,"Gutschrift versendet");
          //TODO ARCHIVIEREN
        }

      }
      else
        $this->app->Tpl->Set($parsetarget,"<div class=\"error\">$ret</div>");
    } elseif ($this->app->Secure->GetPOST("speichern")!="") {
      //echo "SPEICHERN";
      // Nur speichern
      $action =  $this->app->Secure->GetGET("action");
      $module =  $this->app->Secure->GetGET("module");

      if($module=="adresse")
      {
        $check = $this->app->DB->Select("SELECT id FROM dokumente_send WHERE dokument='brieffax' AND geloescht=0 AND versendet=0 ORDER by id DESC LIMIT 1");
      } else {
        $check = $this->app->DB->Select("SELECT id FROM dokumente_send WHERE dokument='$typ' AND parameter='$id' AND geloescht=0 AND versendet=0 ORDER by id DESC LIMIT 1"); // GEHT bei BE RE LS
      } 

      if($module=="adresse")
      {
        $typ="brieffax";
        if(is_numeric($check))
        {
          $this->app->DB->Insert("UPDATE  dokumente_send  SET betreff='$betreff',text='$text',bearbeiter='".$this->app->User->GetName()."' WHERE id='$check' LIMIT 1");
          $this->app->Tpl->Set('MESSAGE',"<div class=\"info\">Die &Auml;nderungen wurden gespeichert.</div>");
        } else {
          $this->app->DB->Insert("INSERT INTO dokumente_send 
              (id,dokument,zeit,bearbeiter,adresse,parameter,art,betreff,text,projekt,ansprechpartner,versendet) VALUES ('','$typ',NOW(),'".$this->app->User->GetName()."',
                '$adresse','$parameter','$art','$betreff','$text','$projekt','$ansprechpartner',0)");
          $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Es wurde ein neues Dokument wurde angelegt, da das alte Dokument bereits versendet worden ist.</div>");
        }
      } else {

        if(is_numeric($check))
        {
          $this->app->DB->Update("UPDATE  dokumente_send  SET betreff='$betreff',text='$text',bearbeiter='".$this->app->User->GetName()."' WHERE id='$check' LIMIT 1");
          $this->app->Tpl->Set('MESSAGE',"<div class=\"info\">Die &Auml;nderungen wurden gespeichert.</div>");
        } else {
          $parameter = $this->app->Secure->GetGET("id");
          $this->app->DB->Insert("INSERT INTO dokumente_send 
              (id,dokument,zeit,bearbeiter,adresse,parameter,art,betreff,text,projekt,ansprechpartner,versendet) VALUES ('','$typ',NOW(),'".$this->app->User->GetName()."',
                '$adresse','$parameter','$art','$betreff','$text','$projekt','$ansprechpartner',0)");
          $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Es wurde ein neues Dokument wurde angelegt, da das alte Dokument bereits versendet worden ist.</div>");
        }
      }

    }elseif($this->app->Secure->GetPOST("download")!="") {
      header("Location: index.php?module=adresse&action=briefpdf&sid=$id&id=$adresse");
      exit;
    }

    $tmp_fax = $this->app->DB->Select("SELECT telefax FROM $typ WHERE id='$id' LIMIT 1");
    $tmp_fax = str_replace('+','00',$tmp_fax);
    $n = preg_match_all("/[0-9]/", $tmp_fax, $treffer);
    for($i=0;$i<$n;$i++){
      $nummer = $nummer . $treffer[0][$i];
      if($n%2 == 1 && $i%2 == 0 && $i < $n-1){
        $nummer = $nummer . "";
      }elseif($n%2 == 0 && $i%2 == 1 && $i < $n-1){
        $nummer = $nummer . "";
      }
    }

    $this->app->Tpl->Set('FAXNUMMER',$nummer);


    $this->app->Tpl->Set('DRUCKER',$this->GetSelectDrucker());
    $this->app->Tpl->Set('FAX',$this->GetSelectFax());
    $this->app->Tpl->Set('EMAILEMPFAENGER',$this->GetSelectEmail());
    $projektabkuerzung = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$projekt'");
    $this->app->Tpl->Set('PROJEKT',$projektabkuerzung);
    //$this->app->Tpl->Set(PROJEKT,$this->GetProjektSelect($projekt));
    //        $this->app->Tpl->Set(ANSPRECHPARTNER,$this->GetSelectAnsprechpartner($adresse,$projekt));
    $tmp_mail = $this->app->DB->Select("SELECT email FROM $typ WHERE id='$id' LIMIT 1");
    $tmp_name = $this->app->DB->Select("SELECT ansprechpartner FROM $typ WHERE id='$id' LIMIT 1");
    if($tmp_name=="")
      $tmp_name = $this->app->DB->Select("SELECT name FROM $typ WHERE id='$id' LIMIT 1");

    //$this->app->Tpl->Set(ANSPRECHPARTNER,$tmp_name." <".$tmp_mail.">");
    $this->app->Tpl->Set('ANSPRECHPARTNER',$this->GetAdresseMail($adresse,$id,$typ));
    //$this->app->YUI->AutoComplete('ansprechpartner', 'emailname');        
    $this->app->YUI->AutoComplete('projekt', 'projektname',1);      

    $projekt = $this->app->DB->Select("SELECT projekt FROM $typ WHERE id='$id' LIMIT 1");
    $this->DokumentSendShow($parsetarget,$typ,$id,$adresse,$tmpfile,$popup,$projekt);

    // temp datei wieder loeschen
    unlink($tmpfile);
    unlink($tmpbrief);
  }

  function GetAdresseMail($adresse,$id="",$tabelle="") {
    // hole adresse aus feld ansprechpartner

    $tmp_mail = $this->app->DB->Select("SELECT email FROM $tabelle WHERE id='$id' LIMIT 1");
    $tmp_name = $this->app->DB->Select("SELECT ansprechpartner FROM $tabelle WHERE id='$id' LIMIT 1");        

    if($tmp_name=="")
      $tmp_name = $this->app->DB->Select("SELECT name FROM $tabelle WHERE id='$id' LIMIT 1");

    $data[0]['name']=$tmp_name;
    $data[0]['email']=$tmp_mail;

    // doppelte eintraege loeschen  

    if($data[0]['email']==$tmp_mail)
    {
      $result = "<option value=\"{$data[0]['name']} <{$data[0]['email']}>\" selected>{$data[0]['name']} &lt;{$data[0]['email']}&gt;</option>";
    }       
    else
      $result = "<option value=\"{$data[0]['name']} <{$data[0]['email']}>\">{$data[0]['name']} &lt;{$data[0]['email']}&gt;</option>";

    //              $data = $this->app->DB->SelectArr("SELECT name, email FROM adresse WHERE id='$adresse' LIMIT 1");


    $data = $this->app->DB->SelectArr("SELECT name, email FROM ansprechpartner WHERE adresse='$adresse' ORDER by name");

    for($i=0;$i<count($data);$i++)
    {
      if($data[$i]['email']==$selected_mail)
        $result .= "<option value=\"{$data[$i]['name']} <{$data[$i]['email']}\" selected>{$data[$i]['name']} &lt;{$data[$i]['email']}&gt;</option>";
      else
        $result .= "<option value=\"{$data[$i]['name']} <{$data[$i]['email']}>\">{$data[$i]['name']} &lt;{$data[$i]['email']}&gt;</option>";
    }

    return $result;
  }


  function DokumentSendShow($parsetarget,$dokument,$id,$adresse,$attachments="",$popup=false,$projekt="")
  {
    $sprache = $this->app->DB->Select("SELECT sprache FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
    $name2 = $this->app->DB->Select("SELECT name FROM $dokument WHERE id='$id' LIMIT 1");


    $abperfax = $this->app->DB->Select("SELECT abperfax FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
    if($abperfax=="1") $this->app->Tpl->Set('ABPERFAX',"checked");

    $testdata = $this->app->DB->SelectArr("SELECT betreff WHERE dokument='".$dokument."' AND parameter='$id' AND parameter!=0 ORDER BY zeit DESC LIMIT 1");

    if($sprache=="") $sprache="deutsch";

    switch($dokument)
    {
      case "bestellung":
        if($tmp_data[0]['betreff']!="")
          $this->DokumentSendVorlage($id);
        else
        {
          $this->Geschaeftsbriefvorlage($sprache,"Bestellung",$projekt,$name2,$id); 
          $this->app->Tpl->Add('TEXT',"\n\n".$this->Grusswort($sprache));
          $this->app->Tpl->Add('TEXT',"\n\n".$this->app->User->GetName());
        }
        break;
      case "angebot":
        $this->Geschaeftsbriefvorlage($sprache,"Angebot",$projekt,$name2,$id); 
        $this->app->Tpl->Add('TEXT',"\n\n".$this->Grusswort($sprache));
        $this->app->Tpl->Add('TEXT',"\n\n".$this->app->User->GetName());
        break;
      case "lieferschein":
        $this->Geschaeftsbriefvorlage($sprache,"Lieferschein",$projekt,$name2,$id); 
        $this->app->Tpl->Add('TEXT',"\n\n".$this->Grusswort($sprache));
        $this->app->Tpl->Add('TEXT',"\n\n".$this->app->User->GetName());
        break;
      case "rechnung":
        $this->Geschaeftsbriefvorlage($sprache,"Rechnung",$projekt,$name2,$id); 
        $this->app->Tpl->Add('TEXT',"\n\n".$this->Grusswort($sprache));
        $this->app->Tpl->Add('TEXT',"\n\n".$this->app->User->GetName());
        break;
      case "gutschrift":
        $this->Geschaeftsbriefvorlage($sprache,"Gutschrift",$projekt,$name2,$id); 
        $this->app->Tpl->Add('TEXT',"\n\n".$this->Grusswort($sprache));
        $this->app->Tpl->Add('TEXT',"\n\n".$this->app->User->GetName());
        break;

      case "auftrag":
        $this->Geschaeftsbriefvorlage($sprache,"Auftrag",$projekt,$name2,$id); 
        $this->app->Tpl->Add('TEXT',"\n\n".$this->Grusswort($sprache));
        $this->app->Tpl->Add('TEXT',"\n\n".$this->app->User->GetName());
        break;
      case "arbeitsnachweis":
        $this->Geschaeftsbriefvorlage($sprache,"Auftrag",$projekt,$name2,$id); 
        $this->app->Tpl->Add('TEXT',"\n\n".$this->Grusswort($sprache));
        $this->app->Tpl->Add('TEXT',"\n\n".$this->app->User->GetName());
        break;

      case "brieffax":
        if($testdata!="")
          $this->DokumentSendVorlage($id);
        else
        {
          $this->Geschaeftsbriefvorlage($sprache,"Korrespondenz",$projekt,$name2); 
          $this->app->Tpl->Add('TEXT',"\n\n".$this->Grusswort($sprache));
          $this->app->Tpl->Add('TEXT',"\n\n".$this->app->User->GetName());
        }
        break;

      default: ;
    }

    $dateianhaenge = $this->app->DB->SelectArr("SELECT ds.id, ds.datei, d.titel FROM datei_stichwoerter ds INNER JOIN datei d on ds.datei = d.id where d.geloescht <> 1 AND parameter = '$id' AND subjekt like 'anhang' AND objekt like '$dokument' ");
    if($dateianhaenge)
    {
      foreach($dateianhaenge as $dk => $dv)
      {
        $dateiname = $this->GetDateiName($dv['datei']);
        $this->app->Tpl->Set('DATEIANHAENGE','<tr><td width=20><input type="checkbox" value="1" name="datei_'.$dv['datei'].'" checked></td><td><a target="_blank" style="font-weight:normal;color:black;" href="index.php?module=dateien&action=download&typ='.$dokument.'&id='.$dv['datei'].'">'.$dateiname.'</a></td></tr>');
        
      }
    } else {
      $this->app->Tpl->Set('DATEIANHAENGE','<tr><td colspan="2" align="center"><i>Keine Anh&auml;nge vorhanden. Dateien k&ouml;nnen unter "Dateien" als Anhang dem Dokument angeh&auml;ngt werden.</i></td></tr>');
    }
    
    $module = $this->app->Secure->GetGET("module");
    $id = $this->app->Secure->GetGET("id");

    if($module=="adresse")
    {
      //echo "Fall 1";
      // genau das eine dokument
      $tmp = $this->app->DB->SelectArr("SELECT DATE_FORMAT(zeit,'%d.%m.%Y %H:%i') as datum, dateiid, text, betreff, ansprechpartner, id, adresse, bearbeiter,art, dokument, parameter, versendet FROM dokumente_send WHERE dokument='".$dokument."' 
          AND id='$id' AND parameter!=0  AND versendet=1 ORDER by zeit DESC");
      //echo ("SELECT DATE_FORMAT(zeit,'%d.%m.%Y %H:%i') as zeit, text, betreff, id, adresse, bearbeiter,art, dokument, parameter, versendet FROM dokumente_send WHERE dokument='".$dokument."' 
      //       AND id='$id' parameter!=0  AND versendet=1 ORDER by zeit");

    }
    else
    {
      // alle passenden dokumente
      $tmp = $this->app->DB->SelectArr("SELECT DATE_FORMAT(zeit,'%d.%m.%Y %H:%i') as datum, text, dateiid, ansprechpartner, betreff, id, adresse, versendet, parameter, dokument, bearbeiter,art FROM dokumente_send WHERE dokument='".$dokument."' AND parameter='$id'  AND parameter!=0 ORDER by zeit DESC");
      //echo "Fall 2";

    } 

    if(count($tmp)>0)
    {
      $this->app->Tpl->Set('HISTORIE',"<table align=\"left\" width=780>");
      $this->app->Tpl->Add('HISTORIE',"<tr valign=\"top\"><td style=\"font-size: 8pt\"><b>Zeit</b></td><td style=\"font-size: 8pt\"><b>An</b></td><td style=\"font-size: 8pt\"><b>Von</b></td>
          <td style=\"font-size: 8pt\"><b>Art</b></td>
          <td style=\"font-size: 8pt\"><b>Anschreiben</b></td><td style=\"font-size: 8pt\"><b>Dokument</b></td></tr>");
      for($i=0;$i<count($tmp);$i++)
      {

        if($tmp[$i]['versendet']==0) $tmp[$i]['versendet'] = "nein"; else $tmp[$i]['versendet'] = "ja";
        //$tmp_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='{$tmp[$i]['adresse']}' AND geloescht=0 LIMIT 1");
        if(is_numeric($tmp[$i]['ansprechpartner']))
          $tmp_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$tmp[$i]['ansprechpartner']."'");
        else
          $tmp_name = htmlentities($tmp[$i]['ansprechpartner'],ENT_QUOTES, "UTF-8");

        //$tmp_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='{$tmp[$i]['adresse']}' AND geloescht=0 LIMIT 1");

        if($tmp[$i]['dateiid'] > 0) $tmppdf = '<a href="index.php?module=dateien&action=send&id='.$tmp[$i]['dateiid'].'"><img src="./themes/[THEME]/images/pdf.png" border="0"></a>';
        else $tmppdf="";

        $this->app->Tpl->Add('HISTORIE','<tr valign="top"><td style="font-size: 8pt">'.$tmp[$i]['datum'].'</td>
            <td style="font-size: 8pt">'.$tmp_name.'</td><td style="font-size: 8pt">'.$tmp[$i]['bearbeiter'].'</td>
            <td style="font-size: 8pt">'.ucfirst($tmp[$i]['art']).'</td>
            <td style="font-size: 8pt" align="center"><a href="index.php?module=adresse&action=briefpdf&type='.$module.'&typeid='.$id.'&sid='.$tmp[$i]['id'].'"><img src="./themes/[THEME]/images/pdf.png" border="0"></a></td>
            <td style="font-size: 8pt" align="center">'.$tmppdf.'</td>
            </tr>');
      }
      $this->app->Tpl->Add('HISTORIE',"</table>");

    } else { $this->app->Tpl->Set('HISTORIE',"<div class=\"info\">Dieses Dokument wurde noch nicht versendet!</div>"); }


    for($i=0;$i<count($attachments);$i++)
    {
      $this->app->Tpl->Add('ANHAENGE',"<a href=\"\">".basename($attachments)."</a>&nbsp;");
    }
    if(count($attachments)==0) $this->app->Tpl->Add('ANHAENGE',"keine Ah&auml;nge vorhanden");

    if(count($tmp)>0)
    {
      $tmp[0]['betreff'] = str_replace('{FIRMA}',$this->Firmendaten("name"),$tmp[0]['betreff']);
      $tmp[0]['text'] = str_replace('{FIRMA}',$this->Firmendaten("name"),$tmp[0]['text']);
      $this->app->Tpl->Set('BETREFF',$tmp[0]['betreff']);
      $this->app->Tpl->Set('TEXT',$tmp[0]['text']);
    }


    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM ".$dokument."_protokoll WHERE $dokument='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('PROTOKOLL',"Protokoll","noAction");



    $this->app->Tpl->Set('EMPFAENGER',$name);
    $pTemplate = (($popup==true) ? 'dokument_absenden_popup.tpl' : 'dokument_absenden.tpl');
    $this->app->Tpl->Parse($parsetarget, $pTemplate);
  }

  //art=email,betreff,text,dateien, email_to, email_name_to
  function DokumentSend($adresse,$dokument, $parameter, $art,$betreff,$text,$dateien,$drucker="",$ansprechpartner="",$projekt="",$email_to="", $email_name_to="")
  {

    // $ret muss geleert werden wenn Dokument erfolgreich versendet wurde!!
    $ret = "Versandart $art noch nicht implementiert!";

    switch($art)
    {
      case "email": // signatur + dokument als anhang
        $ret = "";
        if($email_to!='') {
          $to = $email_to;
          $to_name = $email_name_to;
        }else{
          if($ansprechpartner!=0)
          {
            $to = $this->app->DB->Select("SELECT email FROM ansprechpartner WHERE id='$ansprechpartner' LIMIT 1");
            $to_name = $this->app->DB->Select("SELECT name FROM ansprechpartner WHERE id='$ansprechpartner' LIMIT 1");
          } else 
          {
            $to = $this->app->DB->Select("SELECT email FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
            $to_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
          }
        }
        // wenn emailadresse from email from user name von benutzer sonst firmenname
        if($drucker==$this->app->User->GetEmail())
          $from_name = $this->app->User->GetName();
        else
          $from_name = $this->app->User->GetFirmaName();

        if($from_name=="")
          $from_name=$this->GetFirmaName();

        if($drucker=="")
          $drucker=$this->GetFirmaMail(); 


        if($dokument=="auftrag")
        {
          $abweichendeemailab = $this->app->DB->Select("SELECT abweichendeemailab FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
          if($abweichendeemailab!="") $to = $abweichendeemailab;
        }
        $cc_empfaenger_tmp = $this->app->DB->Select("SELECT ".$dokument."_cc FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1"); 

        if($cc_empfaenger_tmp!="") 
        { $cc_empfaenger[]=$cc_empfaenger_tmp; }
        else { $cc_empfaenger = array(); }
        
        $text = str_replace('\"','"',$text);

        if($this->MailSend($drucker,$from_name,$to,$to_name,$betreff,$text,$dateien,$projekt,true,$cc_empfaenger))
          $ret = "";
        else
          $ret = "Die E-Mail konnte nicht versendet werden! (".$this->mail_error.")";

        break;

      case "brief":
        foreach($dateien as $key=>$value)
          $this->app->printer->Drucken($drucker,$value);
        $ret = "";  
        break;

      case "fax":
        foreach($dateien as $key=>$value)
          $this->app->printer->Drucken($drucker,$value,$email_to);
        $ret = "";  
        break;

      case "telefon":
        $ret = "";
        break;
      case "sonstiges":
        $ret = "";
        break;

    }

    /*
       $module = $this->app->Secure->GetGET("module");
    // UPDATE auf versendet
    if($ret =="")
    {
    echo "insert 3";
    if($module=="adresse") {
    $dokument="brieffax";
    echo "if 1";
    $check = $this->app->DB->Select("SELECT id FROM dokumente_send WHERE id='$parameter' AND dokument='$dokument' AND geloescht=0 AND versendet=0 ORDER by id DESC LIMIT 1");
    } else 
    {
    echo "if 2";
    // nur wenn es das dokument noch nicht gibt mit versendet=0
    $check = $this->app->DB->Select("SELECT id FROM dokumente_send WHERE parameter='$parameter' AND dokument='$dokument' AND geloescht=0 AND versendet=0 ORDER by id DESC LIMIT 1");
    }
    if($check<=0 || $check=="")
    {
    echo "insert 3 new";

    $this->app->DB->Insert("INSERT INTO dokumente_send 
    (id,dokument,zeit,bearbeiter,adresse,parameter,art,betreff,text,projekt,ansprechpartner,versendet) VALUES ('','$dokument',NOW(),'".$this->app->User->GetName()."',
    '$adresse','$parameter','$art','$betreff','$text','$projekt','$ansprechpartner',1)");

    $tmpid = $this->app->DB->GetInsertID();
    if($parameter==0 || $parameter=="")
    $this->app->DB->Update("UPDATE dokumente_send SET parameter='$tmpid' WHERE id='$tmpid' LIMIT 1");

    } else {
    echo "insert 3 update";
    if($module=="adresse")
    {
    $this->app->DB->Update("UPDATE dokumente_send SET versendet=1 WHERE id='$parameter' AND dokument='$dokument' AND geloescht=0 AND versendet=0 ORDER by id DESC LIMIT 1");
    }
    else
    {
    $this->app->DB->Update("UPDATE dokumente_send SET versendet=1 WHERE parameter='$parameter' AND dokument='$dokument' AND geloescht=0 AND versendet=0 ORDER by id DESC LIMIT 1");
    }

    //echo ("UPDATE dokumente_send SET versendet=1 WHERE parameter='$parameter' AND dokument='$dokument' AND geloescht=0 AND versendet=0 ORDER by id DESC LIMIT 1");
    }
    }
     */
    return $ret;
  }


  function NewEvent($beschreibung, $kategorie, $obejekt="",$parameter="")
  {

    $bearbeiter = $this->app->User->GetName();

    $this->app->DB->Insert("INSERT INTO event (id,beschreibung,kategorie,zeit,objekt,parameter,bearbeiter)
        VALUES('','$beschreibung','$kategorie',NOW(),'$objekt','$parameter','$bearbeiter')");

  }

  function UpdateChecksumShopartikel($projekt)
  {
    $tmp = $this->app->DB->SelectArr("SELECT id FROM artikel WHERE shop > 0");
    for($i=0;$i<count($tmp);$i++)
      $this->UpdateArtikelChecksum($tmp[$i][id],$projekt);
  }

  function UpdateArtikelChecksum($artikel,$projekt)
  {
    $tmp = $this->app->DB->SelectArr("SELECT typ,
        nummer, projekt, inaktiv, warengruppe, name_de, name_en, kurztext_de, ausverkauft,
        kurztext_en , beschreibung_de, beschreibung_en,standardbild, herstellerlink, hersteller, uebersicht_de,uebersicht_en,links_de,links_en, startseite_de, startseite_en,
        lieferzeit , lieferzeitmanuell, wichtig,  gewicht, gesperrt,    sperrgrund,  gueltigbis,umsatzsteuer,  klasse,  adresse, shop, firma, neu,topseller,startseite,
        (SELECT MAX(preis) FROM verkaufspreise WHERE 
         artikel='$artikel' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND ab_menge = 1 AND (adresse='0' OR adresse='')) as preis
        FROM artikel WHERE id='$artikel' LIMIT 1");

    //        artikel='$artikel' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND ab_menge = 1 AND (objekt='Standard' OR objekt='')) as preis
    serialize($tmp);

    $checksum = md5(serialize($tmp));

    $this->app->DB->Update("UPDATE artikel SET checksum='$checksum' WHERE id='$artikel' LIMIT 1");
  }

  function GetStandardMarge()
  {
    return $this->Firmendaten("standardmarge");
  }


  function GetStandardStundensatz()
  {
    return 57.62;
  }

  function GetProjektSelectMitarbeiter($adresse)
  {
    // Adresse ist Mitglied von Projekt xx
    // gibt man kein parameter an soll alles zurueck
    // entsprechen weitere parameter filtern die ausgabe
    $arr = $this->app->DB->SelectArr("SELECT adresse FROM bla bla where rolle=mitarbeiter von projekt xxx");
    foreach($arr as $value)
    {
      if($selected==$value) $tmp = "selected"; else $tmp="";
      $ret .= "<option value=\"$value\" $tmp>$value</option>";
    }
    return $ret;


  }

  function GetArtikelPreisvorlageProjekt($kunde,$projekt,$artikel,$menge)
  {
    //HACK!
    return $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE projekt='$projekt' AND artikel='$artikel'"); 
  }

  // do not use this function!
  function GetAuftragSteuersatz($auftrag)
  {
    //ermitteln aus Land und UST-ID Prüfung
    return 1.19;
  }

  function GetSteuersatzAssoc($id,$typ)
  {

    $tmp[0] = "0 %";
    $tmp[$this->GetSteuersatzErmaessigt(false,$id,$typ)] = $this->GetSteuersatzErmaessigt(false,$id,$typ)." %";
    $tmp[$this->GetSteuersatzNormal(false,$id,$typ)] = $this->GetSteuersatzNormal(false,$id,$typ)." %";

    return $tmp;
  }

  function GetSteuersatz($id,$typ)
  {

    $tmp[] = 0;
    $tmp[] = $this->GetSteuersatzErmaessigt(false,$id,$typ);
    $tmp[] = $this->GetSteuersatzNormal(false,$id,$typ);

    return $tmp;
  }

  function GetSelectSteuersatz($selected,$id,$typ)
  {
    $tmp = $this->GetSteuersatz($id,$typ);
    //if($value==
    foreach($tmp as $key=>$value)
    {
      if($selected==$value) $tmp = "selected"; else $tmp="";
      $ret .= "<option value=\"$value\" $tmp>$value %</option>";
    }
    return $ret;
  }


  function GetSteuersatzNormal($komma,$id,$typ)
  {
    if($typ=="provisionsgutschrift")
      $steuersatz = $this->app->DB->Select("SELECT steuersatz FROM mlm_abrechnung_adresse WHERE id='$id' LIMIT 1");
    else
      $steuersatz = $this->app->DB->Select("SELECT steuersatz_normal FROM $typ WHERE id='$id' LIMIT 1");

    if($komma)
      return ($steuersatz/100.0)+1.0; //1.19
    else
      return $steuersatz;
  }

  function GetSteuersatzErmaessigt($komma="",$id,$typ)
  {
    $steuersatz = $this->app->DB->Select("SELECT steuersatz_ermaessigt FROM $typ WHERE id='$id' LIMIT 1");

    if($komma)
      return ($steuersatz/100.0)+1.0; //1.19
    else
      return $steuersatz;
  }

  function GetSteuersatzBefreit($komma="",$id,$typ)
  {
    $steuersatz = 0.00;//$this->app->DB->Select("SELECT steuersatz_ermaessigt FROM $typ WHERE id='$id' LIMIT 1");

    if($komma)
      return ($steuersatz/100.0)+1.0; //1.19
    else
      return $steuersatz;
  }


  function GetKreditkarten()
  {

    return array('MasterCard','Visa','American Express');
  }

  function GetKreditkartenSelect($selected)
  {
    foreach($this->GetKreditkarten() as $value)
    {
      if($selected==$value) $tmp = "selected"; else $tmp="";
      $ret .= "<option value=\"$value\" $tmp>$value</option>";
    }
    return $ret;
  }


  function GetKundeSteuersatz($kunde)
  {


  }

  function AddUSTIDPruefungKunde($kunde)
  {
    //gebunden an eine adresse


  }

  function GetVersandkosten($projekt)
  {

    return 3.32;
  }



  function AuftraegeBerechnen()
  {
    $auftraege = $this->app->DB->SelectArr("SELECT id FROM auftrag WHERE status='freigegeben' AND inbearbeitung=0 ORDER By datum");
    for($i=0;$i<count($auftraege); $i++)
    {
      //$this->app->erp->AuftragNeuberechnen($auftraege[$i][id]);
      $this->AuftragEinzelnBerechnen($auftraege[$i][id]);
    }
  }


  function AddArtikelAuftrag($artikel,$auftrag)
  {
    $name = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1");
    $beschreibung = $this->app->DB->Select("SELECT anabregs_text FROM artikel WHERE id='$artikel' LIMIT 1");

    $this->AddPositionManuell("auftrag",$auftrag, $artikel,1,$name,$beschreibung);
  }

  function DelArtikelAuftrag($id)
  {
    //loesche artikel von auftrag und schiebe positionen nach


  }


  function GetAuftragStatus($auftrag)
  {



  }


  function Export($land)
  {
    if($land==$this->Firmendaten("land") || $land=="")
      return false;


    foreach($this->GetUSTEU() as $euland)
    {
      if($land==$euland)
        return false;
    }

    // alle anderen laender sind export!
    return true;
  }


  function GetEU()
  {
    return $this->GetUSTEU();
  }

  function GetUSTEU()
  {
    return
      array('BE','IT','RO',
          'BG','LV','SE',
          'DK','LT','SK',
          'DE','LU','SI',
          'EE','MT','ES',
          'FI','NL','CZ',
          'FR','AT','HU',
          'GR','PL','GB',
          'IE','PT','CY','HR');
  }


  function CheckUSTFormat($ust)
  {
    $land = substr($ust,0,2);
    $nummer = substr($ust,2);

    switch($land)
    {
      case "BE":
        //zehn, nur Ziffern; (alte neunstellige USt-IdNrn. werden durch Voranstellen der Ziffer Ø ergänzt)
        if(is_numeric($nummer) && strlen($nummer)==9)
          return $land."0".$nummer;
        else if(is_numeric($nummer) && strlen($nummer)==10)
          return $land.$nummer;
        else
          return 0;
        break;

      case "BG":
        //   neun oder zehn, nur Ziffern
        if(is_numeric($nummer) && strlen($nummer)==9)
          return $land.$nummer;
        else if(is_numeric($nummer) && strlen($nummer)==10)
          return $land.$nummer;
        else
          return 0;
        break;

      case "DK":
        //acht, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==8)
          return $land.$nummer;
        else return 0;
        break;

      case "DE":
        //neun, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==9)
          return $land.$nummer;
        else return 0;
        break;

      case "EE":
        //neun, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==9)
          return $land.$nummer;
        else return 0;
        break;

      case "FI":
        //acht, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==8)
          return $land.$nummer;
        else return 0;
        break;

      case "FR":
        //elf, nur Ziffern bzw. die erste und / oder die zweite Stelle kann ein Buchstabe sein
        if(is_numeric($nummer) && strlen($nummer)==11)
          return $land.$nummer;
        else if(ctype_digit(substr($nummer,0,1)) &&  is_numeric(substr($nummer,1)) && strlen($nummer)==11)
          return $land.$nummer;
        else if(ctype_digit(substr($nummer,0,2)) &&  is_numeric(substr($nummer,2)) && strlen($nummer)==11)
          return $land.$nummer;
        else return 0;
        break;

      case "EL":
        //neun, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==9)
          return $land.$nummer;
        else return 0;
        break;


      case "IE":
        //acht, die zweite Stelle kann und die letzte Stelle muss ein Buchstabe sein
        if(ctype_digit(substr($nummer,7,1)) &&  is_numeric(substr($nummer,0,7)) && strlen($nummer)==8)
          return $land.$nummer;
        else if(ctype_digit(substr($nummer,7,1)) && ctype_digit(substr($nummer,1,1)) && is_numeric(substr($nummer,0,7)) && strlen($nummer)==8)
          return $land.$nummer;
        else return 0;
        break;

      case "IT":
        //elf, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==11)
          return $land.$nummer;
        else return 0;
        break;


      case "LV":
        //elf, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==11)
          return $land.$nummer;
        else return 0;
        break;

      case "LT":
        //neu oder zwoelf, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==9)
          return $land.$nummer;
        else if(is_numeric($nummer) && strlen($nummer)==12)
          return $land.$nummer;
        else return 0;
        break;

      case "LU":
        //acht, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==8)
          return $land.$nummer;
        else return 0;
        break;

      case "MT":
        //acht, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==8)
          return $land.$nummer;
        else return 0;
        break;

      case "AT":
        //neun, nur ziffern die erste Stelle muss U sein
        if(is_numeric(substr($nummer,1,8)) && $nummer[0]=="U" && strlen($nummer)==9)
          return $land.$nummer;
        else return 0;
        break;

      case "NL":
        //neun, nur ziffern die erste Stelle muss U sein
        if(is_numeric(substr($nummer,0,9)) && $nummer[9]=="B" && strlen($nummer)==12)
          return $land.$nummer;
        else return 0;
        break;



      case "PL":
        //zehn, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==10)
          return $land.$nummer;
        else return 0;
        break;

      case "PT":
        //neun, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==9)
          return $land.$nummer;
        else return 0;
        break;


      case "RO":
        //maximal zehn, nur ziffern, erste stelle !=0
        if(is_numeric($nummer) && strlen($nummer)>=10 && $nummer[0]!=0)
          return $land.$nummer;
        else return 0;
        break;

      case "SE":
        //zwölf, nur Ziffern, die beiden letzten Stellen bestehen immer aus der Ziffernkombination „Ø1“
        if(is_numeric($nummer) && strlen($nummer)==12 && $nummer[10] == 0 && $nummer[11]==1)
          return $land.$nummer;
        else return 0;
        break;


      case "SK":
        //zehn, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==10)
          return $land.$nummer;
        else return 0;
        break;

      case "SI":
        //acht, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==8)
          return $land.$nummer;
        else return 0;
        break;

      case "ES":
        //neun, die erste und die letzte Stelle bzw. die erste oder die letzte Stelle kann ein Buchstabe sein
        if(is_numeric($nummer) && strlen($nummer)==9)
          return $land.$nummer;
        else if(is_numeric(substr($nummer,1,7)) && strlen($nummer)==9 && ctype_digit(substr($nummer,0,1)) && ctype_digit(substr($nummer,8,1)) )
          return $land.$nummer;
        else if(is_numeric(substr($nummer,1,8)) && strlen($nummer)==9 && ctype_digit(substr($nummer,0,1)))
          return $land.$nummer;
        else if(is_numeric(substr($nummer,0,8)) && strlen($nummer)==9 && ctype_digit(substr($nummer,8,1)))
          return $land.$nummer;
        else return 0;
        break;

      case "CZ":
        //   acht, neun oder zehn, nur Ziffern
        if(is_numeric($nummer) && strlen($nummer)>=8 && strlen($nummer)<=10)
          return $land.$nummer;
        else return 0;
        break;

      case "HU":
        //acht, nur ziffern
        if(is_numeric($nummer) && strlen($nummer)==8)
          return $land.$nummer;
        else return 0;
        break;

      case "GB":
        //neu oder zwoelf, nur ziffern, für Verwaltungen und Gesundheitswesen: fünf, die ersten zwei Stellen GD oder HA

        if(is_numeric($nummer) && strlen($nummer)==9)
          return $land.$nummer;
        else if(is_numeric($nummer) && strlen($nummer)==12)
          return $land.$nummer;
        else if(is_numeric(substr($nummer,2,3)) && $nummer[0]=="G" && $nummer[1]=="D")
          return $land.$nummer;
        else if(is_numeric(substr($nummer,2,3)) && $nummer[0]=="H" && $nummer[1]=="A")
          return $land.$nummer;
        else return 0;
        break;


      case "CY":
        //neun, die letzte Stelle muss ein Buchstaben sein
        if(is_numeric(substr($nummer,0,8)) && strlen($nummer)==9 && ctype_digit(substr($nummer,8,1)))
          return $land.$nummer;
        else return 0;
        break;


    }

  }


  function CheckUst($ust1,$ust2, $firmenname, $ort, $strasse, $plz, $druck="nein")
  {
    $tmp = new USTID();
    //$status = $tmp->check("DE263136143","SE556459933901","Wind River AB","Kista","Finlandsgatan 52","16493","ja");
    $status = $tmp->check($ust1, $ust2, $firmenname, $ort, $strasse, $plz, $druck,$onlinefehler);
    if($tmp->answer['Erg_Name'] == 'A')$tmp->answer['Erg_Name'] = '';     
    if($tmp->answer['Erg_Ort'] == 'A')$tmp->answer['Erg_Ort'] = '';     
    if($tmp->answer['Erg_Str'] == 'A')$tmp->answer['Erg_Str'] = '';     
    if($tmp->answer['Erg_PLZ'] == 'A')$tmp->answer['Erg_PLZ'] = '';     

    $erg = array(
        'ERG_NAME' => $tmp->answer['Erg_Name'],
        'ERG_ORT' => $tmp->answer['Erg_Ort'],
        'ERG_STR' => $tmp->answer['Erg_Str'],
        'ERG_PLZ' => $tmp->answer['Erg_PLZ'],
        'ERROR_CODE' => $tmp->answer['ErrorCode']);

    $error = 0;
    //1 wenn UST-ID. korrekt
    if($status == 1){
      if($tmp->answer['Erg_Name'] == 'B')$error++;
      if($tmp->answer['Erg_Ort'] == 'B')$error++;
      if($tmp->answer['Erg_Str'] == 'B')$error++;
      if($tmp->answer['Erg_PLZ'] == 'B')$error++;

      if($error > 0)
        return $erg;
      else{
        //Brief bestellen 
        //$status = $tmp->check($ust1, $ust2, $firmenname, $ort, $strasse, $plz, "ja"); 
        return 1;
      }

    } else{
      //return "<h1>Meldung dringend melden: Status $status ($onlinefehler)</h1>";
      if(is_array($tmp->answer))
      {
        return $tmp->answer;
      }
      else return $onlinefehler;
    }
    //echo $tmp->check("DE2631361d3","SE556459933901","Wind River AB","Kista","Finlandsgatan 52","16493","ja");

  }
  


  function MailSendNoBCCHTML($from,$from_name,$to,$to_name,$betreff,$text,$files="",$cc="",$bcc="")
  { 
    $from_name = $this->ClearDataBeforeOutput($from_name); 
    $to_name = $this->ClearDataBeforeOutput($to_name); 
    //$to = ""; // testmail
    $betreff  =  $this->ReadyForPDF($betreff);
    $text =  $this->ReadyForPDF($text);

    $this->app->mail->ClearData();

    for($i=0;$i<count($cc);$i++)
    {
      if($cc[$i]!="" && $cc[$i]!=$to)
        $this->app->mail->AddCC($cc[$i]);
    }

    for($i=0;$i<count($bcc);$i++)
    {
      if($bcc[$i]!="" && $bcc[$i]!=$to)
        $this->app->mail->AddBCC($bcc[$i]);
    }

    $this->app->mail->From       = $from;
    $this->app->mail->FromName   = utf8_decode($from_name);

    $this->app->mail->Subject    = utf8_decode($betreff);

    if($this->app->Conf->WFtestmode==true)
      $this->app->mail->AddAddress($from, utf8_decode($to_name));
    else
      $this->app->mail->AddAddress($to, utf8_decode($to_name));

    $this->app->mail->Body = utf8_decode(str_replace('\r\n',"\n",$text).nl2br($this->Signatur()));

    $this->app->mail->IsHTML(true);

    for($i=0;$i<count($files);$i++)
      $this->app->mail->AddAttachment($files[$i]);

    if(!$this->app->mail->Send()) {
      $error =  "Mailer Error: " . $this->app->mail->ErrorInfo;
      return 0;
    } else {
      $error = "Message sent!";
      return 1;
    }


  }



  function MailSendNoBCC($from,$from_name,$to,$to_name,$betreff,$text,$files="")
  { 
    $from_name = $this->ClearDataBeforeOutput($from_name); 
    $to_name = $this->ClearDataBeforeOutput($to_name); 
    //$to = ""; // testmail
    $betreff  =  $this->ReadyForPDF($betreff);
    $text =  $this->ReadyForPDF($text);


    $this->app->mail->ClearData();

    $this->app->mail->From       = $from;
    $this->app->mail->FromName   = utf8_decode($from_name);

    $this->app->mail->Subject    = utf8_decode($betreff);
    if($this->app->Conf->WFtestmode==true)
      $this->app->mail->AddAddress($from, utf8_decode($to_name));
    else
      $this->app->mail->AddAddress($to, utf8_decode($to_name));



    $this->app->mail->Body = utf8_decode(str_replace('\r\n',"\n",$text).$this->Signatur());


    for($i=0;$i<count($files);$i++)
      $this->app->mail->AddAttachment($files[$i]);

    if(!$this->app->mail->Send()) {
      $error =  "Mailer Error: " . $this->app->mail->ErrorInfo;
      return 0;
    } else {
      $error = "Message sent!";
      return 1;
    }
  }

  function MailSend($from,$from_name,$to,$to_name,$betreff,$text,$files="",$projekt="",$signature=true,$cc="",$bcc="")
  {
    // keine leeren email versenden
    if($text=="" && $betreff=="") return;

    $from_name = $this->ClearDataBeforeOutput($from_name);
    $to_name = $this->ClearDataBeforeOutput($to_name);
    $to_name = $this->ReadyForPDF($to_name);
    $from_name = $this->ReadyForPDF($from_name);
    $this->app->mail->ClearData();

    for($i=0;$i<count($cc);$i++)
    {
      if($cc[$i]!="" && $cc[$i]!=$to)
        $this->app->mail->AddCC($cc[$i]);
    }

    for($i=0;$i<count($bcc);$i++)
    {
      if($bcc[$i]!="" && $bcc[$i]!=$to)
      {
        $this->app->mail->AddBCC($bcc[$i]);
      }
    }


    if($projekt > 0 && $this->Projektdaten($projekt,"absendeadresse")!="")
      $this->app->mail->From       = $this->Projektdaten($projekt,"absendeadresse");
    else
      $this->app->mail->From       = $from;

    if($projekt > 0 && $this->Projektdaten($projekt,"absendename")!="")
      $this->app->mail->FromName   = utf8_decode($this->ReadyForPDF($this->Projektdaten($projekt,"absendename")));
    else
      $this->app->mail->FromName   = utf8_decode($from_name);

    $betreff  =  $this->ReadyForPDF($betreff);
    $text =  $this->ReadyForPDF($text);

    $this->app->mail->Subject    = utf8_decode($betreff);
    if($this->app->Conf->WFtestmode==true)
      $this->app->mail->AddAddress($from, utf8_decode($to_name));
    else
      $this->app->mail->AddAddress($to, utf8_decode($to_name));


    if($signature)
    {
      if($projekt > 0 && $this->Projektdaten($projekt,"absendesignatur")!="")
        $this->app->mail->Body = utf8_decode(str_replace('\r\n',"\n",$text)."\r\n\r\n".$this->ReadyForPDF($this->Projektdaten($projekt,"absendesignatur")));
      else
        $this->app->mail->Body = utf8_decode(str_replace('\r\n',"\n",$text).$this->Signatur($this->app->mail->From));

    } else {
      $this->app->mail->Body = utf8_decode(str_replace('\r\n',"\n",$text));
    }




    $bcc1 = $this->app->DB->Select("SELECT bcc1 FROM firmendaten LIMIT 1");
    $bcc2 = $this->app->DB->Select("SELECT bcc2 FROM firmendaten LIMIT 1");

    if($bcc1!="") $this->app->mail->AddBCC($bcc1);
    if($bcc2!="") $this->app->mail->AddBCC($bcc2);

    for($i=0;$i<count($files);$i++)
      $this->app->mail->AddAttachment($files[$i]);

    if(!$this->app->mail->Send()) {
      $this->app->erp->LogFile("Mailer Error: " . $this->app->mail->ErrorInfo);
      $this->mail_error =  "Mailer Error: " . $this->app->mail->ErrorInfo;
      return 0;
    } else {
      $this->mail_error = "";
      return 1;
    }


  }


  function isMailAdr($mailadr){
    if(!eregi("^[_a-z0-9!#$%&\\'*+-\/=?^_`.{|}~]+(\.[_a-z0-9!#$%&\'*+-\\/=?^_`.{|}~]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $mailadr))
      return 0;
    else
      return 1;
  }


  function BeschriftungSprache($sprache="")
  {
    $this->beschriftung_sprache="deutsch";
  }

  function BeschriftungStandardwerte($field,$sprache="deutsch")
  {
    $uebersetzung['dokument_rechnung_titel']['deutsch'] = "Rechnung";
    $uebersetzung['dokument_position']['deutsch'] = "Pos";
    $uebersetzung['dokument_artikelnummer']['deutsch'] =  "Artikelnr";
    $uebersetzung['dokument_artikel']['deutsch'] = "Artikel";
    $uebersetzung['dokument_lieferdatum']['deutsch'] = "Liefertermin";
    $uebersetzung['dokument_artikelnummerkunde']['deutsch'] = "Ihre Artikelnummer";
    $uebersetzung['dokument_menge']['deutsch'] = "Menge";
    $uebersetzung['dokument_gesamt']['deutsch'] = "Gesamt";
    $uebersetzung['dokument_mwst']['deutsch'] = "MwSt.";
    $uebersetzung['dokument_zzglmwst']['deutsch'] = "zzgl. MwSt.";
    $uebersetzung['dokument_inklmwst']['deutsch'] = "inkl. MwSt.";
    $uebersetzung['dokument_rabatt']['deutsch'] = "Rabatt";
    $uebersetzung['dokument_stueck']['deutsch'] = "Stck";
    $uebersetzung['dokument_einzel']['deutsch'] = "Einzel";
    $uebersetzung['dokument_einheit']['deutsch'] = "Einheit";
    $uebersetzung['dokument_gesamtnetto']['deutsch'] = "Gesamt netto";
    $uebersetzung['dokument_seite']['deutsch'] = "Seite";
    $uebersetzung['dokument_seitevon']['deutsch'] = "von";
    $uebersetzung['dokument_datum']['deutsch'] = "Datum";
    $uebersetzung['dokument_angebot_anfrage']['deutsch'] = "Ihre Anfrage";
    $uebersetzung['dokument_angebot']['deutsch'] = "Angebot";
    $uebersetzung['dokument_bestellung']['deutsch'] = "Bestellung";
    $uebersetzung['dokument_bestellung_angebotnummer']['deutsch'] = "Ihr Angebot";
    $uebersetzung['dokument_bestellung_unserekundennummer']['deutsch'] = "Unsere Kunden-Nr.";
    $uebersetzung['dokument_bestelldatum']['deutsch'] = "Bestelldatum";
    $uebersetzung['dokument_bestellung_einkauf']['deutsch'] = "Einkauf";
    $uebersetzung['dokument_bestellung_keineartikelnummer']['deutsch'] = "siehe Artikel-Nr.";
    $uebersetzung['dokument_lieferdatum_sofort']['deutsch'] = "sofort";
    $uebersetzung['dokument_bestellung_unsereartikelnummer']['deutsch'] = "Unsere Artikel-Nr.";
    $uebersetzung['dokument_bestellung_bestellnummer']['deutsch'] = "Best-Nr.";
    $uebersetzung['dokument_bestellung_mengeinvpe']['deutsch'] = "Menge in VPE";
    $uebersetzung['dokument_auftrag']['deutsch'] = "Auftrag";
    $uebersetzung['dokument_auftrag_auftragsbestaetigung']['deutsch'] = "Auftragsbestätigung";
    $uebersetzung['dokument_lieferdatum']['deutsch'] = "Lieferdatum";
    $uebersetzung['dokument_lieferschein']['deutsch'] = "Lieferschein";
    $uebersetzung['dokument_ansprechpartner']['deutsch'] = "Ansprechpartner";
    $uebersetzung['dokument_rechnungsdatum']['deutsch'] = "Rechnungsdatum";
    $uebersetzung['dokument_auftragsdatum']['deutsch'] = "Auftragsdatum";
    $uebersetzung['dokument_rechnung']['deutsch'] = "Rechnung";
    $uebersetzung['dokument_gutschrift']['deutsch'] = "Gutschrift";
    $uebersetzung['dokument_stueckliste']['deutsch'] = "Stückliste";
    $uebersetzung['dokument_proformarechnung']['deutsch'] = "Proformarechnung";
    $uebersetzung['dokument_entwurf']['deutsch'] = "Entwurf";
    $uebersetzung['dokument_rechnung_kopie']['deutsch'] = "doppel";
    $uebersetzung['dokument_skonto']['deutsch'] = "Skonto";
    $uebersetzung['dokument_innerhalb']['deutsch'] = "innerhalb";
    $uebersetzung['dokument_tagen']['deutsch'] = "Tagen";
    $uebersetzung['dokument_tagebiszum']['deutsch'] = "Tage bis zum";
    $uebersetzung['dokument_offene_lastschriften']['deutsch'] = "Der Betrag wird mit offenen Lastschriften verrechnet.";
    $uebersetzung['dokument_auszahlungskonditionen']['deutsch'] = "aus Zahlungskonditionen";
    $uebersetzung['dokument_zahlung_rechnung_anab']['deutsch'] = "Rechnung zahlbar innerhalb von {ZAHLUNGSZIELTAGE} Tagen.";

    $uebersetzung['dokument_zolltarifnummer']['deutsch'] = "Zolltarifnummer";
    $uebersetzung['dokument_herkunftsland']['deutsch'] = "Herkunftsland";





    if(isset($uebersetzung[$field][$sprache]))
      return $uebersetzung[$field][$sprache];
    else
      return "";
  }

  function Beschriftung($field,$sprache="")
  {
    if($sprache!="") $this->BeschriftungSprache($sprache);

    if($this->beschriftung_sprache!="deutsch" && $this->beschriftung_sprache!="englisch")
      $this->beschriftung_sprache="deutsch";  

    // schaue ob es das wort in uebesetzungen gibt
    $uebersetzung = $this->app->DB->Select("SELECT beschriftung FROM uebersetzung WHERE label='$field' AND sprache='".$this->beschriftung_sprache."' LIMIT 1");

    if($uebersetzung!="")
    {
      // eintrag eindeutig gefunden
      return $uebersetzung;
    } else {
      // schaueb ob es das wort in firmendaten gibt achtung hier gibtes nur deutsche woerter!
      if($this->beschriftung_sprache=="deutsch")
      {
        $firmendatenid = $this->app->DB->Select("SELECT MAX(id) FROM firmendaten LIMIT 1"); 
        $wert = $this->app->DB->Select("SELECT ".$field." FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");      
        if($wert!="") return $wert;
        else {
          // Gibt es eine Konstante?
          return $this->BeschriftungStandardwerte($field,$this->beschriftung_sprache);
        }
      } else {
        //gibt es eine Vorlage?
        $wert = $this->BeschriftungStandardwerte($field,$this->beschriftung_sprache);
        if($wert!="")
        {
          return $wert;
        } else {
          //1. deutsches wort als standard
          $wert = $this->BeschriftungDeutschesWort($field);
          return $wert;
        } 
      }
    }
    return $wert;
  }



  function FirmendatenSet($field,$value)
  {
    $firmendatenid = $this->app->DB->Select("SELECT MAX(id) FROM firmendaten LIMIT 1"); 
    $this->app->DB->Update("UPDATE firmendaten SET ".$field."='$value' WHERE id='".$firmendatenid."'");      
  }


  function Firmendaten($field,$projekt="")
  {
    $firmendatenid = $this->app->DB->Select("SELECT MAX(id) FROM firmendaten LIMIT 1"); 
    $value = $this->app->DB->Select("SELECT ".$field." FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");      

    // Umstellung 08.01.2015 von DE auf land zursicherheit wenn jemand der Wert DE fehlen sollte.
    if($field=="land" && $value=="") $value="DE";

    return $value;
  }

  function Signatur($from="")
  {
    $signatur = $this->app->DB->Select("SELECT signatur FROM emailbackup WHERE email='$from' AND email!='' AND eigenesignatur=1 LIMIT 1");

    if($signatur=="")
    {
      $firmendatenid = $this->app->DB->Select("SELECT MAX(id) FROM firmendaten LIMIT 1"); 
      $signatur = base64_decode($this->app->DB->Select("SELECT signatur FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1"));      
    }

    return "\r\n\r\n".$this->ReadyForPDF($signatur);
  }


  function GetQuelleTicket()
  {
    return array('Telefon','Fax','Brief','Selbstabholer');
  }


  function GetStatusTicketSelect($status)
  {
    $stati = array('neu'=>'neu','offen'=>'offen','warten_e'=>'warten auf Intern','warten_kd'=>'warten auf Kunde','klaeren'=>'kl&auml;ren','abgeschlossen'=>'abgeschlossen','spam'=>'Papierkorb');

    foreach($stati as $key=>$value)
    {
      if($status==$key) $selected="selected"; else $selected="";
      $ret .="<option value=\"$key\" $selected>$value</option>";
    }
    return $ret;
  }


  function GetPrioTicketSelect($prio)
  {
    $prios = array('4'=>'niedrig','3'=>'normal','2'=>'hoch');

    foreach($prios as $key=>$value)
    {
      if($prio==$key) $selected="selected"; else $selected="";
      $ret .="<option value=\"$key\" $selected>$value</option>";
    }
    return $ret;
  }


  function GetZeiterfassungArt()
  {
    return array('arbeit'=>'Arbeit','pause'=>'Pause','urlaub'=>'Urlaub','krankheit'=>'Krankheit','ueberstunden'=>'Freizeitausleich','feiertag'=>'Feiertag');
  }

  function GetVPE()
  {
    return array('einzeln'=>'Einzeln','tray'=>'Tray','rolle'=>'Rolle','stueckgut'=>'St&uuml;ckgut','stange'=>'Stange','palette'=>'Palette');
  }

  function GetUmsatzsteuerklasse()
  {
    return array('normal'=>'normal','ermaessigt'=>'erm&auml;&szlig;gt');
  }

  function GetEtikett()
  {
    return array('artikel_klein'=>'Artikel klein');
  }


  function GetWaehrung()
  {
    return array('EUR'=>'EUR','USD'=>'USD','CAD'=>'CAD');
  }


  function GetLager($mitstandardlager=false)
  {
    if($this->Firmendaten("wareneingang_zwischenlager")=="1")
    {
      $tmp['zwischenlager'] = "Zwischenlager";
      if($mitstandardlager)
        $tmp['standardlager'] = "Standardlager";
    }
    else {
      if($mitstandardlager)
        $tmp['standardlager'] = "Standardlager";

      $tmp['zwischenlager'] = "Zwischenlager";
    }
    $result = $this->app->DB->SelectArr("SELECT lp.id, CONCAT(l.bezeichnung,'->',lp.kurzbezeichnung) as kurzbezeichnung FROM lager_platz lp LEFT JOIN lager l ON lp.lager=l.id WHERE lp.kurzbezeichnung!='' ORDER by l.bezeichnung,lp.kurzbezeichnung");

    for($i=0;$i<count($result);$i++)
      $tmp[$result[$i][id]]=$result[$i][kurzbezeichnung];

    return $tmp;
  }

  function GetArtikelart()
  {
    return array('produkt'=>'Produkt','material'=>'Material','dienstleistung'=>'Dienstleistung','muster'=>'Muster',
        'gebuehr'=>'Geb&uuml;hr','betriebsstoff'=>'Betriebsstoff','buerobedarf'=>'B&uuml;robedarf',
        'inventar'=>'Inventar','porto'=>'Porto','literatur'=>'Literatur');
  }


  function StartMessung()
  {
    $this->start_messung = $this->uniqueTimeStamp();
  }

  function EndeMessung()
  {
    $this->ende_messung = $this->uniqueTimeStamp();
  }

  function ErgebnisMessung()
  {
    $differenz = $this->ende_messung-$this->start_messung;
    $differenz = $differenz/10; // warum auch immer
    $differenz = (int)$differenz;

    echo "Die Ausführung dauerte $differenz ms"; 
  }

  function uniqueTimeStamp() {
    $milliseconds = microtime();
    $timestring = explode(" ", $milliseconds);
    $sg = $timestring[1];
    $mlsg = substr($timestring[0], 2, 4);
    $timestamp = $sg.$mlsg;
    return $timestamp; 
  } 

  function GetWartezeitTicket($zeit)
  {
    $timestamp = strToTime($zeit, null);


    $td = $this->makeDifferenz($timestamp,time());
    return $td['day'][0] . ' ' . $td['day'][1] . ', ' . $td['std'][0] . ' ' . $td['std'][1] . 
      ', ' . $td['min'][0] . ' ' . $td['min'][1];// . ', ' . $td['sec'][0] . ' ' . $td['sec'][1];
  }

  function makeDifferenz($first, $second){

    if($first > $second)
      $td['dif'][0] = $first - $second;
    else
      $td['dif'][0] = $second - $first;

    $td['sec'][0] = $td['dif'][0] % 60; // 67 = 7

    $td['min'][0] = (($td['dif'][0] - $td['sec'][0]) / 60) % 60; 

    $td['std'][0] = (((($td['dif'][0] - $td['sec'][0]) /60)- 
          $td['min'][0]) / 60) % 24;

    $td['day'][0] = floor( ((((($td['dif'][0] - $td['sec'][0]) /60)- 
              $td['min'][0]) / 60) / 24) );

    $td = $this->makeString($td);

    return $td;

  }


  function makeString($td){

    if ($td['sec'][0] == 1)
      $td['sec'][1] = 'Sekunde';
    else 
      $td['sec'][1] = 'Sekunden';

    if ($td['min'][0] == 1)
      $td['min'][1] = 'Minute';
    else 
      $td['min'][1] = 'Minuten';

    if ($td['std'][0] == 1)
      $td['std'][1] = 'Stunde';
    else 
      $td['std'][1] = 'Stunden';

    if ($td['day'][0] == 1)
      $td['day'][1] = 'Tag';
    else 
      $td['day'][1] = 'Tage';

    return $td;

  }


  function GetProjektSelect($projekt,$color_selected="")
  {

    $sql = "SELECT id,name,farbe FROM projekt order by id";
    $tmp = $this->app->DB->SelectArr($sql);
    for($i=0;$i<count($tmp);$i++)
    {
      if($tmp[$i]['farbe']=="") $tmp[$i]['farbe']="white";
      if($projekt==$tmp[$i]['id']){
        $options = (isset($options)?$options:'')."<option value=\"{$tmp[$i]['id']}\" selected 
          style=\"background-color:{$tmp[$i]['farbe']};\">{$tmp[$i]['name']}</option>";
        $color_selected = $tmp[$i]['farbe'];
      }
      else
        $options = (isset($options)?$options:'')."<option value=\"{$tmp[$i]['id']}\" 
          style=\"background-color:{$tmp[$i]['farbe']};\">{$tmp[$i]['name']}</option>";
    }
    return isset($options)?$options:'';

  }

  function GetAdressName($id)
  {
    if($this->app->Conf->WFdbType=="postgre") {
      if(is_numeric($id))
        $result = $this->app->DB->SelectArr("SELECT name FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    } else {
      $result = $this->app->DB->SelectArr("SELECT name FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    }

    //return $result[0][vorname]." ".$result[0][name];
    return $result[0][name];
  }

  function GetAdressSubject()
  {
    return array('Kunde','Lieferant','Mitarbeiter','Externer Mitarbeiter','Projektleiter','Mitglied');
  }

  function GetAdressPraedikat()
  {
    return array('','von','fuer','ist');
  }

  function GetAdressObjekt()
  {
    return array('','Projekt');
  }


  function GetVersandartAuftrag()
  {
    return array(
           'DHL'=>'DHL','DPD'=>'DPD',
           'express_dpd'=>'Express DPD',
           'export_dpd'=>'Export DPD',
           'gls'=>'GLS',
           'keinversand'=>'Kein Versand',
           'selbstabholer'=>'Selbstabholer',
           'versandunternehmen'=>'Sonstige',
           'spedition'=>'Spedition',
           'post'=>'Post'
            );
        }


        function GetVersandartLieferant()
        {
        return array('DHL','DPD','Hermes','UPS','GLS','Post','Spedition','Selbstabholer','Packstation');
        }


    function GetArtikelgruppe($projekt="")
    {
      if($projekt > 0)
      {  
        $result = $this->app->DB->SelectArr("SELECT id,bezeichnung FROM artikelkategorien WHERE projekt='$projekt' AND geloescht!=1 ORDER by bezeichnung");
        // gibt es keine projekt gruppen dann die ohne projekt verwenden
        if(count($result)<=0)
          $result = $this->app->DB->SelectArr("SELECT id,bezeichnung FROM artikelkategorien WHERE geloescht!=1 AND projekt <=0 ORDER by bezeichnung");
      } else
      {  
        $result = $this->app->DB->SelectArr("SELECT id,bezeichnung FROM artikelkategorien WHERE geloescht!=1 AND projekt <=0 ORDER by bezeichnung");
      }

      if(count($result) > 0)
      {

        for($i=0;$i<count($result);$i++)
        {
          $tmp[$result[$i]['id']."_kat"]=$result[$i]['bezeichnung'];
        }

        return $tmp;

      } else {
        return array("produkt"=>"Ware f&uuml;r Verkauf (700000)",
            "module"=>"Module / Hardware (600000)",
            "produktion"=>"Produktionsmaterial (400000)",
            "material"=>"Sonstiges (100000)",
            "fremdleistung"=>"Fremdleistung (100000)",
            "gebuehr"=>"Geb&uuml;hr / Miete (100000)");
      }
    }


          function GetZahlungsstatus()
          {
          return array('offen','bezahlt');
          }

          function GetZahlungsweiseGutschrift()
          {
          //    return array('ueberweisung'=>'&Uuml;berweisung','bar'=>'Bar','paypal'=>'PayPal');

            $tmp['ueberweisung']="&Uuml;berweisung";

            if($this->Firmendaten("zahlung_kreditkarte"))
              $tmp['kreditkarte']="Kreditkarte";

            if($this->Firmendaten("zahlung_lastschrift"))
              $tmp['lastschrift']="Verrechnen mit Lastschriften";


            if($this->Firmendaten("zahlung_bar"))
              $tmp['bar']="Bar";

            if($this->Firmendaten("zahlung_paypal"))
              $tmp['paypal']="Paypal";

            if($this->Firmendaten("zahlung_amazon"))
              $tmp['amazon']="Amazon Payments";

            if($this->Firmendaten("zahlung_amazon_bestellung"))
              $tmp['amazon_bestellung']="Amazon Bestellung";

            if($this->Firmendaten("zahlung_billsafe"))
              $tmp['billsafe']="Billsafe";

            if($this->Firmendaten("zahlung_secupay"))
              $tmp['secupay']="Secupay";

            if($this->Firmendaten("zahlung_sofortueberweisung"))
              $tmp['sofortueberweisung']="Sofort&uuml;berweisung";


            if($this->Firmendaten("zahlung_eckarte"))
              $tmp['eckarte']="EC-Karte";



            return $tmp;

          }

      function GetZahlungsweise()
      {

        if($this->Firmendaten("zahlung_rechnung"))
          $tmp['rechnung']="Rechnung";

        if($this->Firmendaten("zahlung_vorkasse"))
          $tmp['vorkasse']="Vorkasse";

        if($this->Firmendaten("zahlung_nachnahme"))
          $tmp['nachnahme']="Nachnahme";

        if($this->Firmendaten("zahlung_kreditkarte"))
          $tmp['kreditkarte']="Kreditkarte";


        if($this->Firmendaten("zahlung_eckarte"))
          $tmp['eckarte']="EC-Karte";


        if($this->Firmendaten("zahlung_bar"))
          $tmp['bar']="Bar";

        if($this->Firmendaten("zahlung_paypal"))
          $tmp['paypal']="Paypal";

        if($this->Firmendaten("zahlung_amazon"))
          $tmp['amazon']="Amazon Payments";

        if($this->Firmendaten("zahlung_amazon_bestellung"))
          $tmp['amazon_bestellung']="Amazon Bestellung";

        if($this->Firmendaten("zahlung_billsafe"))
          $tmp['billsafe']="Billsafe";

        if($this->Firmendaten("zahlung_secupay"))
          $tmp['secupay']="Secupay";

        if($this->Firmendaten("zahlung_sofortueberweisung"))
          $tmp['sofortueberweisung']="Sofort&uuml;berweisung";

        if($this->Firmendaten("zahlung_lastschrift"))
          $tmp['lastschrift']="Lastschrift";

        if($this->Firmendaten("zahlung_ratenzahlung"))
          $tmp['ratenzahlung']="Ratenzahlung";

        return $tmp;
        //              return array('rechnung'=>'Rechnung','vorkasse'=>'Vorkasse','nachnahme'=>'Nachnahme','kreditkarte'=>'Kreditkarte','einzugsermaechtigung'=>'Einzugsermaechtigung','bar'=>'Bar','paypal'=>'PayPal','lastschrift'=>'Lastschrift');
      }

      function GetTypSelect()
      {
        return array('firma'=>'Firma','herr'=>'Herr','frau'=>'Frau');
      }

      function GetArtikelWarengruppe()
      {
        //return array('SMD','THT','EBG','BGP');
        $tmp = array('','Bauteil','Eval-Board','Adapter','Progammer','Ger&auml;t','Kabel','Software','Dienstleistung','Spezifikation');
        sort($tmp);
        return $tmp;
      }

      function GetBezahltWieAssoc()
      {
        return array('privat'=>"Privat",'firma_bar'=>"Firma (Kasse/Bar)",'firma_ecr'=>"Firma (EC-Karte)",'firma_cc'=>"Firma (Kreditkarte)",'firma_sonst'=>"Firma (Sonstige)");
      }

      function GetStatusArbeitsnachweis()
      {
        return array('offen','freigegeben','versendet');
      }


      function GetStatusAnfrage()
      {
        return array('offen','abgeschlossen');
      }

      function GetStatusInventur()
      {
        return array('offen','abgeschlossen');
      }

      function GetStatusReisekosten()
      {
        return array('offen','freigegeben','versendet','buchhaltung');
      }


      function GetStatusLieferschein()
      {
        return array('offen','freigegeben','versendet');
      }


      function GetStatusAuftrag()
      {
        return array('offen','freigegeben','abgeschlossen');
      }


      function GetStatusAngebot()
      {
        return array('offen','freigegeben','bestellt','angemahnt','empfangen');
      }


      function GetStatusGutschrift()
      {
        return array('offen','freigegeben','bezahlt');
      }

      function GetStatusRechnung()
      {
        return array('offen','freigegeben','gestellt','zahlungserinnerung','mahnung');
      }

      function GetFirmaFieldsCheckbox()
      {
        return array('versand_gelesen','zahlung_rechnung','zahlung_vorkasse','zahlung_bar','zahlung_lastschrift','zahlung_paypal','zahlung_amazon','artikel_bilder_uebersicht',
            'zahlung_amazon_bestellung','zahlung_billsafe','zahlung_sofortueberweisung','zahlung_secupay','zahlung_eckarte',
            'zahlung_kreditkarte','zahlung_nachnahme','zahlung_ratenzahlung','knickfalz','firmenlogoaktiv','modul_finanzbuchhaltung',
            'standardaufloesung','immerbruttorechnungen','immernettorechnungen','bestellvorschlaggroessernull','schnellanlegen','kleinunternehmer','api_enable','api_importwarteschlange','warnung_doppelte_nummern','wareneingang_zwischenlager','bestellungohnepreis','zahlung_lastschrift_konditionen','mysql55','porto_berechnen','breite_artikelbeschreibung','deviceenable',
            'iconset_dunkel','api_cleanutf8','mahnwesenmitkontoabgleich','briefhtml','absenderunterstrichen','seite_von_ausrichtung_relativ','wareneingang_gross','datatables_export_button_flash','modul_verein','viernachkommastellen_belege','stornorechnung_standard','angebotersatz_standard','geburtstagekalender');
      }


      function GetFirmaFields()
      {
        $fields =  array('zahlung_rechnung_de','zahlung_kreditkarte_de','breite_position','breite_menge','breite_nummer','breite_einheit','land',
            'zahlung_vorkasse_de','zahlung_nachnahme_de','zahlung_lastschrift_de','zahlung_bar_de','zahlung_paypal_de','zahlung_amazon_de','zahlung_amazon_bestellung_de','zahlung_ratenzahlung_de',
            'zahlung_sofortueberweisung_de','zahlung_billsafe_de','testmailempfaenger','zahlung_secupay_de','zahlung_eckarte_de',
            'zahlung_rechnung_sofort_de','firmenfarbehell','firmenfarbeganzdunkel','firmenfarbedunkel','navigationfarbe','navigationfarbeschrift','unternavigationfarbe','unternavigationfarbeschrift','api_importwarteschlange_name',
            'zahlungszieltage','zahlungszieltageskonto','zahlungszielskonto','api_initkey','api_remotedomain','api_eventurl','steuer_erloese_inland_normal','devicekey','deviceserials',
            'steuer_aufwendung_inland_normal',
            'steuer_erloese_inland_ermaessigt',
            'steuer_aufwendung_inland_ermaessigt',
            'steuer_erloese_inland_steuerfrei',
            'steuer_aufwendung_inland_steuerfrei',
            'steuer_erloese_inland_innergemeinschaftlich',
            'steuer_aufwendung_inland_innergemeinschaftlich',
            'steuer_erloese_inland_eunormal',
            'steuer_erloese_inland_euermaessigt',
            'steuer_erloese_inland_nichtsteuerbar',
            'steuer_aufwendung_inland_nichtsteuerbar',
            'steuer_aufwendung_inland_eunormal',
            'steuer_aufwendung_inland_euermaessigt',
            'steuer_erloese_inland_export',
            'etikettendrucker_wareneingang','schriftgroesseabsender',
            'steuer_aufwendung_inland_import','versandart','zahlungsweise','bezeichnungstornorechnung','steuer_anpassung_kundennummer','abstand_seitenrandlinks','abstand_adresszeilelinks','sepaglaeubigerid','abstand_gesamtsumme_lr',
            'adressefreifeld1',
            'adressefreifeld2',
            'adressefreifeld3',
            'adressefreifeld4',
            'adressefreifeld5',
            'adressefreifeld6',
            'adressefreifeld7',
            'adressefreifeld8',
            'adressefreifeld9',
            'adressefreifeld10',
            'bezeichnungangebotersatz'
              );

        for($ki=1;$ki<=15;$ki++)
        {
          $fields[]='steuer_art_'.$ki;
          $fields[]='steuer_art_'.$ki.'_normal';
          $fields[]='steuer_art_'.$ki.'_ermaessigt';
          $fields[]='steuer_art_'.$ki.'_steuerfrei';
        }
        return $fields;
      }

      function GetMLMAuszahlungWaehrung()
      {
        return array('EUR','CHF');
      }

      function GetWaehrungUmrechnungskurs($von,$nach)
      {
        if ($von == 'EUR' && $nach == 'USD') {
          return 1.20;
        } else if ($von=="EUR" && $nach=="CHF") {
          return 1.06; 
        } else {
          return 1;
        }
      }

      function GetSchriftarten()
      {
        return array(
          'arial' => 'Arial'
        );
      }
      
      function GetFonts()
      {
        $ret['times'] = array('b' => true,'bi' => true,'i' => true, 'name' => 'Times');
        $ret['arial'] = array('b' => true,'bi' => true,'i' => true, 'name' => 'Arial');
        if(file_exists(dirname(__FILE__).'/pdf/font') && is_dir(dirname(__FILE__).'/pdf/font'))
        {
          if($handle = opendir(dirname(__FILE__).'/pdf/font'))
          {
            while (false !== ($entry = readdir($handle))) {
              $b = false;
              $bi = false;
              $i = false;
              $pathinfo = pathinfo($entry);
              if(isset($pathinfo['extension']) && strtolower($pathinfo['extension']) == 'php')
              {
                if(strpos($entry,'helvetica') !== 0 && strpos($entry,'times') !== 0)
                {
                  $basis = $pathinfo['filename'];
                  if(substr($pathinfo['filename'],-2) == 'bi')
                  {
                    if(file_exists(dirname(__FILE__).'/pdf/font/'.substr($pathinfo['filename'],0,strlen($pathinfo['filename'])-2).'.php'))
                    {
                      $bi = true;
                      $basispathinfo = pathinfo(dirname(__FILE__).'/pdf/font/'.substr($pathinfo['filename'],0,strlen($pathinfo['filename'])-2));
                      $basis = $basispathinfo['basename'];
                    }
                  }elseif(substr($pathinfo['filename'],-1) == 'i')
                  {
                    if(file_exists(dirname(__FILE__).'/pdf/font/'.substr($pathinfo['filename'],0,strlen($pathinfo['filename'])-1).'.php'))
                    {
                      $i = true;
                      $basispathinfo = pathinfo(dirname(__FILE__).'/pdf/font/'.substr($pathinfo['filename'],0,strlen($pathinfo['filename'])-1));
                      $basis = $basispathinfo['basename'];
                    }
                  }elseif(substr($pathinfo['filename'],-1) == 'b')
                  {
                    if(file_exists(dirname(__FILE__).'/pdf/font/'.substr($pathinfo['filename'],0,strlen($pathinfo['filename'])-1).'.php'))
                    {
                      $b = true;
                      $basispathinfo = pathinfo(dirname(__FILE__).'/pdf/font/'.substr($pathinfo['filename'],0,strlen($pathinfo['filename'])-1));
                      $basis = $basispathinfo['basename'];
                    }
                  
                  }
                  if(isset($file))unset($file);
                  if(isset($name))unset($name);
                  include_once(dirname(__FILE__).'/pdf/font/'.$entry);
                  if(isset($file)&& file_exists(dirname(__FILE__).'/pdf/font/'.$file) && isset($name))
                  {
                    if(!isset($ret[$basis]))$ret[$basis]['name'] = $name;
                    if(!$bi && !$i && !$b)$ret[$basis]['name'] = $name;
                    if($bi)$ret[$basis]['bi'] = true;
                    if($i)$ret[$basis]['i'] = true;
                    if($b)$ret[$basis]['b'] = true;
                  }
                }
                
              }
            }
          }
          
        }
        
        return $ret;
      }

      function GetMLMAbrechnung()
      {
        return array('sammelueberweisung'=>'Sammel&uuml;berweisung','manuell'=>'Manuelle Auszahlung');
      }

      function GetMLMPositionierung()
      {
        return array('1'=>'1. Junior Consultant',
            '2'=>'2. Consultant',
            '3'=>'3. Associate',
            '4'=>'4. Manager',
            '5'=>'5. Senior Manager',
            '6'=>'6. General Director',
            '7'=>'7. General Manager',
            '8'=>'8. Chief Manager',
            '9'=>'9. Vice President',
            '10'=>'10. President',
            '11'=>'11. ',
            '12'=>'12. ',
            '13'=>'13. ',
            '14'=>'14. ',
            '15'=>'15. '
            );
      }

      function GetStatusBestellung()
      {
        return array('offen','freigegeben','bestellt','angemahnt','empfangen');
      }

      function GetSelectAsso($array, $selected)
      {
        foreach($array as $key=>$value)
        {
          if($selected==$key) $tmp = "selected"; else $tmp="";
          $ret .= "<option value=\"$key\" $tmp>$value</option>";
        }
        return $ret;
      }

      function GetSelect($array, $selected)
      {
        foreach($array as $value)
        {
          if($selected==$value) $tmp = "selected"; else $tmp="";
          $ret .= "<option value=\"$value\" $tmp>$value</option>";
        }
        return $ret;
      }
      function CreateAdresse($name,$firma="1")
      { 
        $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");

        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        { 
          $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        }
  
        $zahlungsweise = $this->StandardZahlungsweise($projekt);
        $versandart = $this->StandardVersandart($projekt);



        $this->app->DB->Insert("INSERT INTO adresse (id,name,firma,zahlungsweise,projekt,versandart) VALUES ('','$name','$firma','$zahlungsweise','$projekt','$versandart')");
        return $this->app->DB->GetInsertID();
      }

      function CreateLieferadresse($adresse,$data)
      {
        $this->app->DB->Insert("INSERT INTO lieferadressen (id,adresse) VALUES ('','$adresse')");      
        $id = $this->app->DB->GetInsertID();      
        if($data['land']=="") $data['land']='DE';

        foreach ($data as $key => $value) {
          $this->app->DB->Update("UPDATE lieferadressen SET $key='".$value."' WHERE id='$id' LIMIT 1");
        }
        return $id;
      }

      function CreateAnsprechpartner($adresse,$data)
      {
        $this->app->DB->Insert("INSERT INTO ansprechpartner (id,adresse) VALUES ('','$adresse')");      
        $id = $this->app->DB->GetInsertID();      
        if($data['land']=="") $data['land']='DE';

        foreach ($data as $key => $value) {
          $this->app->DB->Update("UPDATE ansprechpartner SET $key='".$value."' WHERE id='$id' LIMIT 1");
        }
        return $id;
      }

      function AddRolleZuAdresse($adresse, $subjekt, $praedikat="", $objekt="", $parameter="")
      {
        $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");
        if(strtoupper($objekt)=="PROJEKT")
        {
          $parameter = $this->app->DB->Select("SELECT id FROM projekt WHERE id='$parameter' LIMIT 1");
          if($parameter<=0) $parameter=0;
          if($parameter > 0 ) $projekt=$parameter;
          else {
            $parameter ="";
            $projekt = 0;
          }
        }

        $check = $this->app->DB->Select("SELECT id FROM adresse_rolle WHERE 
            subjekt='$subjekt' AND objekt='$objekt' AND praedikat='$praedikat' AND parameter='$parameter' AND adresse='$adresse'  
            AND (bis >= NOW() OR bis='0000-00-00')  LIMIT 1");

        if($check > 0)
          return $check;

        // Insert ....  
        $sql ="INSERT INTO adresse_rolle (id, adresse, subjekt, praedikat, objekt, parameter,von,projekt)
          VALUES ('','$adresse','$subjekt','$praedikat','$objekt','$parameter',NOW(),'$projekt')";

        $this->app->DB->Insert($sql);
        $id =  $this->app->DB->GetInsertID();


        $kundennummer = trim($this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1"));
        $tmp_data_adresse = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");
        $tmp_data_adresse = reset($tmp_data_adresse);
        // wenn adresse zum erstenmal die rolle erhält wird kundennummer bzw. lieferantennummer vergeben
        if($subjekt=="Kunde" && ($kundennummer=="" || is_array($kundennummer)))
        {
          $kundennummer = $this->GetNextKundennummer($projekt,$tmp_data_adresse);
          $this->ObjektProtokoll("adresse",$adresse,"adresse_next_kundennummer","Kundennummer erhalten: $kundennummer");
          $this->app->DB->Update("UPDATE adresse SET kundennummer='$kundennummer' WHERE id='$adresse' AND (kundennummer='0' OR kundennummer='') LIMIT 1");
        }

        $lieferantennummer = trim($this->app->DB->Select("SELECT lieferantennummer FROM adresse WHERE id='$adresse' LIMIT 1"));
        $data = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");
        //$this->LogFile("DEBUG subjekt = $subjekt, projekt=$projekt,adresse=$adresse,lieferantennummer=$lieferantennummer");
        if($subjekt=="Lieferant" && ($lieferantennummer=="" || is_array($lieferantennummer)))
        {
          $lieferantennummer = $this->GetNextLieferantennummer($projekt,$tmp_data_adresse);
          $this->ObjektProtokoll("adresse",$adresse,"adresse_next_lieferantennummer","Lieferantennummer erhalten: $lieferantennummer");

          $this->app->DB->Update("UPDATE adresse SET lieferantennummer='$lieferantennummer' WHERE id='$adresse' AND (lieferantennummer='0' OR lieferantennummer='') LIMIT 1");
        }

        $this->app->DB->Delete("DELETE FROM adresse_rolle WHERE von > bis AND bis!='0000-00-00'");
        return $id;
      }


      function UpdateArbeitszeit($id,$adr_id, $vonZeit, $bisZeit, $aufgabe, $beschreibung,$ort, $projekt, $paketauswahl,$art,$kunde="",$abrechnen="0",$verrechnungsart="",$kostenstelle="",$abgerechnet="0",$gps="",$internerkommentar="")
      {
        //Update 

        $tmp = $this->app->DB->SelectArr("SELECT aufgabe, beschreibung, projekt, kostenstelle FROM arbeitspaket WHERE id = $paketauswahl");
        $myArr = $tmp[0];

        if($paketauswahl!=0)
        {
          $kunde = $this->app->DB->Select("SELECT kunde FROM projekt WHERE id='".$myArr["projekt"]."'");
          $projekt = $myArr["projekt"];
        }
        else if($kunde=="NULL")
          $kunde = 0;
        else if($kunde=="")
          $kunde = $this->app->DB->Select("SELECT adresse_abrechnung FROM zeiterfassung WHERE  id='$id'");

        //              if($abrechnen=="")
        //                      $abrechnen = $this->app->DB->Select("SELECT abrechnen FROM zeiterfassung WHERE id='$id'");

        $this->app->DB->Update("UPDATE zeiterfassung SET aufgabe='$aufgabe',adresse='$adr_id',arbeitspaket='$paketauswahl',ort='$ort',beschreibung='$beschreibung', projekt='$projekt',
            von='$vonZeit',bis='$bisZeit',adresse_abrechnung='$kunde',abrechnen='$abrechnen',kostenstelle='$kostenstelle', verrechnungsart='$verrechnungsart', abgerechnet='$abgerechnet', ist_abgerechnet='$abgerechnet',gps='$gps',internerkommentar='$internerkommentar' WHERE id='$id'");      

          // wenn arbeitszeit in arbeistnachweis verwendet wurden ist dann dort auch updaten

          $arbeitsnachweisposid = $this->app->DB->Select("SELECT arbeitsnachweispositionid FROM zeiterfassung WHERE id='$id'");
        if($arbeitsnachweisposid > 0){
          $von = $this->app->DB->Select("SELECT DATE_FORMAT(von,'%H:%i') FROM zeiterfassung WHERE id='$id'");
          $bis = $this->app->DB->Select("SELECT DATE_FORMAT(bis,'%H:%i') FROM zeiterfassung WHERE id='$id'");
          $this->app->DB->Update("UPDATE arbeitsnachweis_position SET bezeichnung='$aufgabe',beschreibung='$beschreibung',ort='$ort', von='$von',bis='$bis',
              adresse='$adr_id' WHERE id='$arbeitsnachweisposid' LIMIT 1");
        }
      }

      function AddArbeitszeit($adr_id, $vonZeit, $bisZeit, $aufgabe, $beschreibung,$ort, $projekt, $paketauswahl,$art,$kunde="",$abrechnen="",$verrechnungsart="",$kostenstelle="",$abgerechnet="0",$gps="",$aufgabeid=0,$internerkommentar="")
      {
        $insert = "";
        if($paketauswahl==0){
          if($abrechnen!="1") $abrechnen=0;
          if($projekt<=0) $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$kunde' LIMIT 1");
          if($projekt=="") $projekt=0;
          $insert = 'INSERT INTO zeiterfassung (adresse, von, bis, aufgabe, beschreibung, projekt, buchungsart,art,adresse_abrechnung,abrechnen,gebucht_von_user,ort,kostenstelle,verrechnungsart,abgerechnet,ist_abgerechnet,gps,aufgabe_id,internerkommentar) 
            VALUES ('.$adr_id.',"'.$vonZeit.'","'.$bisZeit.'","'.$aufgabe.'", "'.$beschreibung.'",'.$projekt.', "manuell","'.$art.'","'.$kunde.'","'.$abrechnen.'","'.$this->app->User->GetID().'","'.$ort.'","'.$kostenstelle.'","'.$verrechnungsart.'","'.$abgerechnet.'","'.$abgerechnet.'","'.$gps.'","'.$aufgabeid.'","'.$internerkommentar.'")';
        }else{

          $projekt = $this->app->DB->SelectArr("SELECT aufgabe, beschreibung, projekt, kostenstelle FROM arbeitspaket WHERE id = $paketauswahl");
          $myArr = $projekt[0];

          //if($kunde=="")
          $kunde = $this->app->DB->Select("SELECT kunde FROM projekt WHERE id='".$myArr["projekt"]."'");

          $insert = 'INSERT INTO zeiterfassung (adresse, von, bis, arbeitspaket, aufgabe, beschreibung, projekt, buchungsart,art,gebucht_von_user,ort,adresse_abrechnung,abrechnen,abgerechnet,ist_abgerechnet,gps,aufgabe_id,internerkommentar) VALUES 
            ('.$adr_id.',"'.$vonZeit.'","'.$bisZeit.'",'.$paketauswahl.' , "'.$aufgabe.'", "'.$beschreibung.'",'.$myArr["projekt"].', "AP","'.$art.'","'.$this->app->User->GetID().'","'.$ort.'","'.$kunde.'","'.$abrechnen.'","'.$abgerechnet.'","'.$abgerechnet.'","'.$gps.'","'.$aufgabeid.'","'.$internerkommentar.'")';


        }
        $this->app->DB->Insert($insert);
        return $this->app->DB->GetInsertID();

        // wenn art=="AP" hole projekt und kostenstelle aus arbeitspaket beschreibung
        // und update zuvor angelegten datensatz
      }


      /**
       * \brief   Anlegen eines Arbeitspakets
       *
       *         Diese Funktion legt ein Arbeitspaket an.
       *
       * \param   aufgabe      Kurzbeschreibung (ein paar Woerter)  
       * \param   beschreibung  Textuelle Beschreibung 
       * \param   projekt      Projekt ID 
       * \param   zeit_geplant  Stundenanzahl Integer Wert
       * \param   kostenstelle  Kostenstelle 
       * \param   initiator            user id des Initiators
       * \param   abgabedatum   Datum fuer Abgabe 
       * \return                Status-Code
       *
       */
      function CreateArbeitspaket($adressse, $aufgabe,$beschreibung,$projekt,$zeit_geplant,$kostenstelle,$initiator,$abgabedatum="")
      {
        if(($abgabe != "") && ($beschreibung != "") && ($projekt != "") && ($zeit_geplant != "") && ($kostenstelle != "") && ($initiator != "")){
          $this->app->DB->Insert('INSERT INTO arbeitspakete                                                                                                                                   (adresse, aufgabe, beschreibung, projekt, zeit_geplant, kostenstelle, initiator, abgabedatum)                                                                VALUES (                                                                                                                                                      '.$adresse.',"'.$aufgabe.'", "'.$beschreibung.'", '.$projekt.', '.$zeit_geplant.','.$kostenstelle.', '.$initiator.',"'.$abgabedatum.'")');
          return 1;
        }else
          return 0;
      }

      function CreateBenutzerVorlage($felder)
      {
        $settings = base64_encode(serialize($felder['settings']));
        $firma = $this->app->User->GetFirma();

        $this->app->DB->Insert("INSERT INTO uservorlage (id,bezeichnung,beschreibung)
            VALUES ('','{$felder['bezeichnung']}', '{$felder['beschreibung']}')");

        $id = $this->app->DB->GetInsertID();

        //standard rechte damit man sich anmelden kann
        $this->app->DB->Update("INSERT INTO uservorlagerights (vorlage, module,action,permission) VALUES ('$id','welcome','login',1)");
        $this->app->DB->Update("INSERT INTO uservorlagerights (vorlage, module,action,permission) VALUES ('$id','welcome','logout',1)");
        $this->app->DB->Update("INSERT INTO uservorlagerights (vorlage, module,action,permission) VALUES ('$id','welcome','start',1)");
        $this->app->DB->Update("INSERT INTO uservorlagerights (vorlage, module,action,permission) VALUES ('$id','welcome','startseite',1)");
        $this->app->DB->Update("INSERT INTO uservorlagerights (vorlage, module,action,permission) VALUES ('$id','welcome','settings',1)");
        return $id;
      }


      function CreateBenutzer($felder)
      {
        $settings = base64_encode(serialize($felder['settings']));
        $firma = $this->app->User->GetFirma();


        $this->app->DB->Insert("INSERT INTO user (username, passwordmd5,password, description, settings, parentuser,activ, type, adresse, fehllogins, standarddrucker, 
          startseite, hwtoken, hwkey, hwcounter, hwdatablock, motppin, motpsecret, externlogin, gpsstechuhr, firma,kalender_passwort,kalender_aktiv,vorlage,projekt_bevorzugen,projekt)
            VALUES ('{$felder['username']}', MD5('{$felder['password']}'), ENCRYPT('{$felder['password']}'), '{$felder['description']}', '{$settings}', '0','{$felder['activ']}', 
              '{$felder['type']}', '{$felder['adresse']}', '{$felder['fehllogins']}', '{$felder['standarddrucker']}', '{$felder['startseite']}',
              '{$felder['hwtoken']}', '{$felder['hwkey']}', '{$felder['hwcounter']}','{$felder['hwdatablock']}', '{$felder['motppin']}', '{$felder['motpsecret']}', 
              '{$felder['externlogin']}','{$felder['gpsstechuhr']}', '$firma','{$felder['kalender_passwort']}','{$felder['kalender_aktiv']}','{$felder['vorlage']}',
              '{$felder['projekt_bevorzugen']}','{$felder['projekt']}')");

        $id = $this->app->DB->GetInsertID();

        //standard rechte damit man sich anmelden kann
        $this->app->DB->Update("INSERT INTO userrights (user, module,action,permission) VALUES ('$id','welcome','login',1)");
        $this->app->DB->Update("INSERT INTO userrights (user, module,action,permission) VALUES ('$id','welcome','logout',1)");
        $this->app->DB->Update("INSERT INTO userrights (user, module,action,permission) VALUES ('$id','welcome','start',1)");
        $this->app->DB->Update("INSERT INTO userrights (user, module,action,permission) VALUES ('$id','welcome','startseite',1)");
        $this->app->DB->Update("INSERT INTO userrights (user, module,action,permission) VALUES ('$id','welcome','settings',1)");


        $this->AbgleichBenutzerVorlagen($id);

        return $id;
      }


      function IsAdresseInGruppe($adresse,$gruppe)
      {

        $check = $this->app->DB->Select("SELECT a.parameter FROM adresse_rolle a WHERE 
            (a.bis='0000-00-00' OR a.bis <=NOW()) AND a.adresse='$adresse' AND a.parameter='$gruppe' AND a.objekt='Gruppe' LIMIT 1");

        if(($check == $gruppe) && $gruppe > 0)
          return true;
        else 
          return false;
      }

      function IsAdresseSubjekt($adresse,$subjekt)
      {
        $id = $this->app->DB->Select("SELECT id FROM adresse_rolle WHERE adresse='$adresse' AND subjekt='$subjekt' LIMIT 1");  
        if($id > 0)
          return 1;
        else return 0;
      }

      function AddOffenenVorgang($adresse, $titel, $href, $beschriftung="", $linkremove="")
      {
        $sql = "INSERT INTO offenevorgaenge (id,adresse,titel,href,beschriftung,linkremove) VALUES
          ('','$adresse','$titel','$href','$beschriftung','$linkremove')";
        $this->app->DB->Insert($sql);
      }


      function RenameOffenenVorgangID($id,$titel)
      {
        $sql = "UPDATE offenevorgaenge SET titel='$titel' WHERE id='$id' LIMIT 1";
        $this->app->DB->Update($sql);
      }

      function RemoveOffenenVorgangID($id)
      {
        $sql = "DELETE FROM offenevorgaenge WHERE id='$id' LIMIT 1";
        $this->app->DB->Delete($sql);
      }

      function CalcNextNummer($nummer)
      { 
        $nummer = trim($nummer);
        //Nummer von rechts abknabbern
        for($i=strlen($nummer)-1; $i >= 0; $i--)
        { 
          $checkvalue = $nummer[$i];
          if(is_numeric($checkvalue))
            $nummer_anteil[] = $checkvalue;
          else break;
        }
        // nummer string erstellen
        if(isset($nummer_anteil))
        {
          $nummer_anteil_string = implode("",$nummer_anteil);
          $nummer_anteil_string = strrev($nummer_anteil_string);
          $laenge_nummer_anteil_string = strlen($nummer_anteil_string);
        } else {
          $nummer_anteil_string = 0;
          $laenge_nummer_anteil_string = 0;
        }

        

        // buchstaben teil extrahieren
        $buchstaben_anteil_string = substr($nummer,0,strlen($nummer) - $laenge_nummer_anteil_string);
        if($laenge_nummer_anteil_string == 0)$laenge_nummer_anteil_string = 1;
        // nummer erhoehen
        $neue_nummer = $nummer_anteil_string+1;

        // nummer von links auffuellen mit nullern
        $neue_nummer = str_pad($neue_nummer, $laenge_nummer_anteil_string, "0", STR_PAD_LEFT);

        //zusammensetzen
        //echo $nummer. "  ".$buchstaben_anteil_string.$neue_nummer."\r\n";
        return $buchstaben_anteil_string.$neue_nummer;
      }

      function GetNextNummer($type,$projekt="",$data="")
      {
        $checkprojekt = $this->app->DB->Select("SELECT id FROM projekt WHERE id='$projekt' LIMIT 1");

        $process_lock = $this->app->erp->ProzessLock("erpapi_getnextnummer");

        
        $eigenernummernkreis = 0;
        if($eigenernummernkreis=="1")
        {

        } else {
          // patch fuer uebergangszeit kann ca. im Oktober 2014 entfernt werden
          /*
             switch($type) {
             case "kundennummer":
             case "mitarbeiternummer":
             case "lieferantennummer":
             $belegnr = $this->app->DB->Select("SELECT MAX($type) FROM adresse");
             break;
             default:
             $belegnr = $this->app->DB->Select("SELECT MAX(belegnr) FROM $type WHERE firma='".$this->app->User->GetFirma()."'");
             }
             if($this->Firmendaten("next_$type")=="" && $belegnr!="" && $eigenernummernkreis!="1")
             $this->FirmendatenSet("next_$type",$this->CalcNextNummer($belegnr));
           */
          // ende patch

          // naechste     
          switch($type)
          {
            case "angebot":
              $belegnr = $this->Firmendaten("next_angebot");
              if($belegnr == "0" || $belegnr == "") $belegnr = 100000;
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "auftrag":
              $belegnr = $this->Firmendaten("next_auftrag");
              if($belegnr == "0" || $belegnr=="") $belegnr = 200000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "rechnung":
              $belegnr = $this->Firmendaten("next_rechnung");
              if($belegnr == "0" || $belegnr=="") $belegnr = 400000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "gutschrift":
              $belegnr = $this->Firmendaten("next_gutschrift");
              if($belegnr == "0" || $belegnr=="") $belegnr = 900000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "lieferschein":
              $belegnr = $this->Firmendaten("next_lieferschein");
              if($belegnr == "0" || $belegnr=="") $belegnr = 300000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "bestellung":
              $belegnr = $this->Firmendaten("next_bestellung");
              if($belegnr == "0" || $belegnr=="") $belegnr = 100000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "arbeitsnachweis":
              $belegnr = $this->Firmendaten("next_arbeitsnachweis");
              if($belegnr == "0" || $belegnr=="") $belegnr = 300000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "anfrage":
              $belegnr = $this->Firmendaten("next_anfrage");
              if($belegnr == "0" || $belegnr=="") $belegnr = 300000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "reisekosten":
              $belegnr = $this->Firmendaten("next_reisekosten");
              if($belegnr == "0" || $belegnr=="") $belegnr = 300000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "produktion":
              $belegnr = $this->Firmendaten("next_produktion");
              if($belegnr == "0" || $belegnr=="") $belegnr = 300000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "kundennummer":
              $belegnr = $this->Firmendaten("next_kundennummer");
              if($belegnr == "0" || $belegnr=="") $belegnr = 10000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "lieferantennummer":
              $belegnr = $this->Firmendaten("next_lieferantennummer");
              if($belegnr == "0" || $belegnr=="") $belegnr = 70000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;
            case "mitarbeiternummer":
              $belegnr = $this->Firmendaten("next_mitarbeiternummer");
              if($belegnr == "0" || $belegnr=="") $belegnr = 90000; 
              $newbelegnr = $this->CalcNextNummer($belegnr);
              break;

            default: $begelnr="Fehler";
          }

          $this->FirmendatenSet("next_$type",$newbelegnr);
        }
        $this->app->erp->ProzessUnlock($process_lock);
        return $belegnr;
      }

      function InsertUpdateAdresse($data)
      {
        if(!is_array($data))return false;
        $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
        if(isset($data['projekt'])){
          $projekt = $data['projekt'];
        } else {
          $data['projekt'] = $projekt;
        }
        if(isset($data['id']))
        {
          $adresse = $this->app->DB->SelectArr("select * from adresse where id = ".$data['id']." limit 1");
          if($adresse)$adresse = reset($adresse);
        }
        if(!isset($adresse) || !$adresse)
        {
          $where = "";
          if(isset($data['lieferantennummer']) && $data['lieferantennummer'] !== '')
          {
            if($where != "")$where .= " and ";
            $where .= " lieferantennummer like '".addslashes($data['lieferantennummer'])."' ";
          }
          if(isset($data['kundennummer']) && $data['kundennummer'] !== '')
          {
            if($where != "")$where .= " and ";
            $where .= " kundennummer like '".addslashes($data['kundennummer'])."' ";
          }
          if(isset($data['mitarbeiternummer']) && $data['mitarbeiternummer'] !== '')
          {
            if($where != "")$where .= " and ";
            $where .= " mitarbeiternummer like '".addslashes($data['mitarbeiternummer'])."' ";
          }
          if($where != "")$adresse = $this->app->DB->SelectArr("select * from adresse where ".$where." limit 1");
          if($adresse)$adresse = reset($adresse);
        }
        if(!isset($adresse) || !$adresse)
        {
          $this->app->DB->Insert("insert into adresse (id) values ('')");
          $id = $this->app->DB->GetInsertID();
          if($id)
          {
            $adresse = $this->app->DB->SelectArr("select * from adresse where id = ".$id. " limit 1");
            if($adresse)$adresse = reset($adresse);
          } else return false;
          if(isset($data['lieferantennummer']) && $data['lieferantennummer'] !== '')
          {
            $this->AddRolleZuAdresse($id, "Lieferant", "von", "Projekt", $projekt);
          }
          if(isset($data['kundennummer']) && $data['kundennummer'] !== '')
          {
            $this->AddRolleZuAdresse($id, "Kunde", "von", "Projekt", $projekt);
          }
          if(isset($data['mitarbeiternummer']) && $data['mitarbeiternummer'] !== '')
          {
            $this->AddRolleZuAdresse($id, "Mitarbeiter", "von", "Projekt", $projekt);
          }
        }
        if(!$adresse)return false;
        if(isset($adresse['id']))$id = $adresse['id'];
        if(isset($data['lieferantennummer']) && $data['lieferantennummer'] !== '')
        {
          $this->AddRolleZuAdresse($id, "Lieferant", "von", "Projekt", $projekt);
        }
        if(isset($data['kundennummer']) && $data['kundennummer'] !== '')
        {
          $this->AddRolleZuAdresse($id, "Kunde", "von", "Projekt", $projekt);
        }
        if(isset($data['mitarbeiternummer']) && $data['mitarbeiternummer'] !== '')
        {
          $this->AddRolleZuAdresse($id, "Mitarbeiter", "von", "Projekt", $projekt);
        }
        
        foreach($data as $k => $v)
        {
          $k = trim($k);
          if($k !== '' && $adresse[$k] != $v)
          {
            $this->app->DB->Update("update adresse set ".addslashes($k)." = ".(!is_null($v)?"'".addslashes($v)."'":"NULL")." where id = ".$adresse['id']);
          }
        }
        return $adresse['id'];
      }
      
      function InsertUpdateArtikel($data) {
        if(!is_array($data))return false;
        $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
        if(isset($data['projekt'])){
          $projekt = $data['projekt'];
        } else {
          $data['projekt'] = $projekt;
        }
        if(isset($data['id']) && $data['id'])
        {
          $artikel = $this->app->DB->SelectArr("select * from artikel where id = ".$data['id']." limit 1");
          if($artikel)$artikel = reset($artikel);
        }
        if(!$artikel && isset($data['nummer']) && $data['nummer'] != '')
        {
          $where = "nummer = '".stripslashes($data['nummer'])."'";
          if(isset($data['projekt']) && $data['projekt'])
          {
            $where .= " and projekt = ".(int)$data['projekt'];
          }
          $artikel = $this->app->DB->SelectArr("select * from artikel where ".$where." limit 1");
          if($artikel)$artikel = reset($artikel);
        }
        if(!$artikel)
        {
          $this->app->DB->Insert("insert into artikel (id) values ('')");
          $id = $this->app->DB->GetInsertID();
          $artikel = $this->app->DB->SelectArr("select * from artikel where id = ".$id." limit 1");
          if($artikel)$artikel = reset($artikel);
        }
        if($artikel)
        {
          $id = $artikel['id'];
          
          foreach($data as $k => $v)
          {
            $k = trim($k);
            if($k !== '' &&  $artikel[$k] != $v)
            {
              $this->app->DB->Update("update artikel set ".addslashes($k)." = ".(!is_null($v)?"'".addslashes($v)."'":"NULL")." where id = ".$id);
            }
          }
          return $id;
        } else {
          return false;
        }
      }

      function GetNextArtikelnummer($artikelart="",$firma="1",$projekt="")
      {
        // neue artikel nummer holen
        //if($firma=="") $firma = $this->app->User->GetFirma();
        $process_lock = $this->app->erp->ProzessLock("erpapi_getnextartikelnummer");

        $check = str_replace("_kat","",$artikelart);
        $check = $this->app->DB->Select("SELECT id FROM artikelkategorien WHERE id='$check' AND geloescht!=1 LIMIT 1");

        if($check > 0)
        {
          $next_nummer_alt = $this->app->DB->Select("SELECT next_nummer FROM artikelkategorien WHERE id='$check' AND geloescht!=1");
          $externenummer = $this->app->DB->Select("SELECT externenummer FROM artikelkategorien WHERE id='$check' AND geloescht!=1");

          if($externenummer!="1")
          {
            if($next_nummer_alt=="") 
            { 
              $next_nummer_alt = 100000;
              $neue_nummer = $next_nummer_alt;
            } else {
              $nurbuchstaben = preg_replace("/[^a-zA-Z]/","",$next_nummer_alt);
              $nurzahlen = preg_replace("/[^0-9]/","",$next_nummer_alt);
              $laenge = strlen($nurzahlen);

              $next_nummer = $this->CalcNextNummer($next_nummer_alt);
              //$nurbuchstaben.str_pad($nurzahlen+1, $laenge  ,'0', STR_PAD_LEFT); 
              $neue_nummer = $next_nummer;

              $this->app->DB->Update("UPDATE artikelkategorien SET next_nummer='$next_nummer' WHERE id='$check' AND geloescht!=1");
            }
          } else {
            // externe nummer holen
            // TODO pruefen ob es im Projekt ueberladen gehoert
            $eigenernummernkreis = $this->app->DB->Select("SELECT eigenernummernkreis FROM projekt WHERE id='$projekt' LIMIT 1");
            if($eigenernummernkreis=="1")
            {
              $next_nummer = $this->app->DB->Select("SELECT next_artikelnummer FROM projekt WHERE id='$projekt' LIMIT 1");          
              $this->app->DB->Update("UPDATE projekt SET next_artikelnummer=next_artikelnummer+1 WHERE id='$projekt' LIMIT 1");
              $neue_nummer = $this->app->DB->Select("SELECT next_artikelnummer FROM projekt WHERE id='$projekt' LIMIT 1");          
            } else {
              //zentraler nummernkreis mit prefix
              $next_nummer = $this->CalcNextNummer($this->Firmendaten("next_artikelnummer"));
              $this->FirmendatenSet("next_artikelnummer",$next_nummer);
              if($next_nummer_alt!="") $neue_nummer=$next_nummer_alt.$next_nummer;
              else $neue_nummer = $next_nummer;
            }

            //$nurbuchstaben = preg_replace("/[^a-zA-Z]/","",$next_nummer_alt);
            //$neue_nummer = $nurbuchstaben.$next_nummer;
            //$neue_nummer = $this->CalcNextNummer($next_nummer_alt);
          }
        } else {
          $eigenernummernkreis = $this->app->DB->Select("SELECT eigenernummernkreis FROM projekt WHERE id='$projekt' LIMIT 1");
          if($eigenernummernkreis)
          {
            $next_nummer = $this->app->DB->Select("SELECT next_artikelnummer FROM projekt WHERE id='$projekt' LIMIT 1");          
            $this->app->DB->Update("UPDATE projekt SET next_artikelnummer=next_artikelnummer+1 WHERE id='$projekt' LIMIT 1");
            $neue_nummer = $this->app->DB->Select("SELECT next_artikelnummer FROM projekt WHERE id='$projekt' LIMIT 1"); 
          }else{

            switch($artikelart)
            {
              case "produkt":
                //$neue_nummer = $this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE firma='".$firma."' AND nummer LIKE '7%'");
                $neue_nummer = $this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE nummer LIKE '7%'");
                if($neue_nummer=="" || $neue_nummer==0) $neue_nummer = "700000";
                break;
              case "produktion":
                //$neue_nummer = $this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE firma='".$firma."' AND nummer LIKE '4%'");
                $neue_nummer = $this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE nummer LIKE '4%'");
                if($neue_nummer=="" || $neue_nummer==0) $neue_nummer = "400000";
                break;
              case "module":
                //$neue_nummer = $this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE firma='".$firma."' AND nummer LIKE '6%'");
                $neue_nummer = $this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE nummer LIKE '6%'");
                if($neue_nummer=="" || $neue_nummer==0) $neue_nummer = "600000";
                break;
              default:
                //$neue_nummer = $this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE firma='".$firma."' AND nummer LIKE '1%'");
                if($this->app->Conf->WFdbType=="postgre"){
                  $neue_nummer = $this->app->DB->Select("SELECT MAX(nummer) FROM artikel WHERE nummer LIKE '1%'");
                } else {              
                  $neue_nummer = $this->app->DB->Select("SELECT MAX(CAST(nummer AS UNSIGNED)) FROM artikel WHERE nummer LIKE '1%'");
                }
                if(($neue_nummer=="" || $neue_nummer==0)) $neue_nummer = "100000";
            }
            $neue_nummer = $this->CalcNextNummer($neue_nummer);//$neue_nummer + 1;
          }
        }
        $this->app->erp->ProzessUnlock($process_lock);
        return $neue_nummer;
      }

      function GetNextMitarbeiternummer($projekt="",$data="")
      {
        return $this->GetNextNummer("mitarbeiternummer",$projekt,$data);
        /*
           $sql = "SELECT MAX(mitarbeiternummer) FROM adresse WHERE geloescht=0";
           $nummer = $this->app->DB->Select($sql) + 1;
           if($nummer==1)
           $nummer = 90000;
           return $nummer;
         */
      }


      function GetNextKundennummer($projekt="",$data="")
      {
        return $this->GetNextNummer("kundennummer",$projekt,$data);
        /*
           $sql = "SELECT MAX(kundennummer) FROM adresse WHERE geloescht=0";
           $nummer = $this->app->DB->Select($sql) + 1;
           if($nummer==1)
           $nummer = 10000;
           return $nummer;
         */
      }

      function GetNextLieferantennummer($projekt="",$data="")
      {
        return $this->GetNextNummer("lieferantennummer",$projekt,$data);
        /*
           $sql = "SELECT MAX(lieferantennummer) FROM adresse WHERE geloescht=0";
           $nummer = $this->app->DB->Select($sql) + 1;
           if($nummer==1)
           $nummer = 70000;
           return $nummer;
         */
      }



      function ArbeitsnachweisProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO arbeitsnachweis_protokoll (id,arbeitsnachweis,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }


      function ReisekostenProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO reisekosten_protokoll (id,reisekosten,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }


      function AnfrageProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO anfrage_protokoll (id,anfrage,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }


      function InventurProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO inventur_protokoll (id,inventur,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }

      function LieferscheinProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO lieferschein_protokoll (id,lieferschein,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }


      function AuftragProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO auftrag_protokoll (id,auftrag,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }

      function AngebotProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO angebot_protokoll (id,angebot,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }

      function BestellungProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO bestellung_protokoll (id,bestellung,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }

      function RechnungProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO rechnung_protokoll (id,rechnung,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }

      function GutschriftProtokoll($id,$text)
      {
        $this->app->DB->Insert("INSERT INTO gutschrift_protokoll (id,gutschrift,zeit,bearbeiter,grund) VALUES
            ('','$id',NOW(),'".$this->app->User->GetName()."','$text')"); 
      }


      function LoadArbeitsnachweisStandardwerte($id,$adresse,$projekt="")
      {
        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        $field = array('anschreiben','name','abteilung','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax','kundennummer','projekt','ust_befreit','typ');
        foreach($field as $key=>$value)
        {

          if($value=="projekt" && $this->app->Secure->POST[$value]!="")
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }

          //$this->app->Secure->POST[$value] = $arr[0][$value];
          //$uparr[$value] = $arr[0][$value];
        }

        if($projekt!="") {
          $this->app->Secure->POST[projekt] = $projekt;
          $uparr[projekt] = $this->app->Secure->POST[projekt];
        } 

        $uparr[adresse]=$adresse;
        $this->app->DB->UpdateArr("arbeitsnachweis",$id,"id",$uparr);
        $uparr="";

        //liefernantenvorlage
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");
        $field = array('zahlungsweise','zahlungszieltage','zahlungszieltageskonto','zahlungszielskonto','versandart');
        foreach($field as $key=>$value)
        {
          //$uparr[$value] = $arr[0][$value];
          $this->app->Secure->POST[$value] = $arr[0][$value];
        }

        $this->app->DB->UpdateArr("arbeitsnachweis",$id,"id",$uparr);

        //standardprojekt
        //$projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        //$this->app->Secure->POST[projekt] = $projekt;


      }


      function LoadInventurStandardwerte($id,$adresse,$projekt="")
      {
        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        $field = array('name','abteilung','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax','kundennummer','projekt','ust_befreit');
        foreach($field as $key=>$value)
        {

          if($value=="projekt" && $this->app->Secure->POST[$value]!="")
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }

          //$this->app->Secure->POST[$value] = $arr[0][$value];
          //$uparr[$value] = $arr[0][$value];
        }

        if($projekt!="") {
          $this->app->Secure->POST[projekt] = $projekt;
          $uparr[projekt] = $this->app->Secure->POST[projekt];
        } 

        $uparr[adresse]=$adresse;
        $this->app->DB->UpdateArr("inventur",$id,"id",$uparr);
        $uparr="";


      }

      function KundeHatZR($adresse)
      {
        $verband = $this->GetVerband($adresse);
        $zr = $this->app->DB->Select("SELECT zentralregulierung FROM gruppen WHERE id='$verband' LIMIT 1");

        if($zr=="1")
          return true;
        else                    
          return false;   
      }       

      function GetVerbandName($gruppe)
      {
        return $this->app->DB->Select("SELECT CONCAT(kennziffer,' ',name) FROM gruppen WHERE id='$gruppe' LIMIT 1");
      }

      function GetVerband($adresse)
      {
        $verband = $this->app->DB->Select("SELECT g.id FROM adresse_rolle a LEFT JOIN gruppen g ON g.id=a.parameter WHERE 
            (a.bis='0000-00-00' OR a.bis >=NOW()) AND a.adresse='$adresse' AND a.objekt='Gruppe' AND g.art='verband' LIMIT 1");
        return $verband;
      }

      function LoadAnfrageStandardwerte($id,$adresse,$projekt="")
      {
        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT *,vertrieb as vertriebid FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

        $arr[0]['gruppe'] = $this->GetVerband($adresse);
        $field = array('anschreiben','name','abteilung','typ','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax',
            'kundennummer','projekt','gruppe','vertriebid');

        foreach($field as $key=>$value)
        {

          if($value=="projekt" && $this->app->Secure->POST[$value]!="")
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }
        }

        if($projekt!="") {
          $this->app->Secure->POST[projekt] = $projekt;
          $uparr[projekt] = $this->app->Secure->POST[projekt];
        } 

        $uparr[adresse]=$adresse;
        $this->app->DB->UpdateArr("anfrage",$id,"id",$uparr);
        $uparr="";
        $this->LoadAdresseStandard("anfrage",$id,$adresse);
      }


      function LoadReisekostenStandardwerte($id,$adresse,$projekt="")
      {
        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        $field = array('name','abteilung','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax','kundennummer','projekt','ust_befreit','typ');
        foreach($field as $key=>$value)
        {

          if($value=="projekt" && $this->app->Secure->POST[$value]!="")
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }

          //$this->app->Secure->POST[$value] = $arr[0][$value];
          //$uparr[$value] = $arr[0][$value];
        }

        if($projekt!="") {
          $this->app->Secure->POST[projekt] = $projekt;
          $uparr[projekt] = $this->app->Secure->POST[projekt];
        } 

        $uparr[adresse]=$adresse;
        $this->app->DB->UpdateArr("reisekosten",$id,"id",$uparr);
        $uparr="";


      }



      function LoadLieferscheinStandardwerte($id,$adresse,$lieferantenretoure=false)
      {
        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        $field = array('anschreiben','name','abteilung','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax','kundennummer','projekt','ust_befreit','typ');


        foreach($field as $key=>$value)
        {
          if($value=="projekt" && $this->app->Secure->POST[$value]!="")
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }

          //$this->app->Secure->POST[$value] = $arr[0][$value];
          //$uparr[$value] = $arr[0][$value];
        }
        $uparr[adresse]=$adresse;

        if($lieferantenretoure) $uparr['lieferant']=$adresse;

        $this->app->DB->UpdateArr("lieferschein",$id,"id",$uparr);
        $uparr="";

        //liefernantenvorlage
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");

        // falls von Benutzer projekt ueberladen werden soll
        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        {      
          $uparr['projekt'] = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
          $arr[0]['projekt'] = $uparr['projekt'];
          $this->app->Secure->POST['projekt']=$this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='".$arr[0]['projekt']."' AND id > 0 LIMIT 1");
        }

        $field = array('zahlungsweise','zahlungszieltage','zahlungszieltageskonto','zahlungszielskonto','versandart');
        foreach($field as $key=>$value)
        {
          //$uparr[$value] = $arr[0][$value];
          $this->app->Secure->POST[$value] = $arr[0][$value];
        }
        $this->app->DB->UpdateArr("lieferschein",$id,"id",$uparr);

        $this->LoadStandardLieferadresse($adresse,$id,"lieferschein");
        $this->LoadAdresseStandard("lieferschein",$id,$adresse);
      }


      function InfoAuftragsErfassung($modul,$id)
      {
        $status = $this->app->DB->Select("SELECT status FROM $modul WHERE id='$id' LIMIT 1");
        $adresse = $this->app->DB->Select("SELECT adresse FROM $modul WHERE id='$id' LIMIT 1");
        if($status=="angelegt" || $status=="freigegeben")
        {
          $infoauftragserfassung = $this->app->DB->Select("SELECT infoauftragserfassung FROM adresse WHERE id='$adresse' LIMIT 1");
          if($infoauftragserfassung!="")
          {
            $this->app->Tpl->Set('INFOFUERAUFTRAGSERFASSUNG',"<table width=100% height=100%><tr><td><fieldset><legend>Info f&uuml;r Angebots- und Auftragserfassung</legend>
                <textarea id=\"readonlybox\" rows=12>$infoauftragserfassung</textarea></fieldset></td></tr></table>");
          } else {

            $this->app->Tpl->Set('INFOFUERAUFTRAGSERFASSUNG',"");
          }
        }


      }

      function MarkerUseredit($feld1,$useredittimestamp)
      {
        //    return "CONCAT($feld1,' ',if(TIME_TO_SEC(TIMEDIFF(NOW(), $useredittimestamp)) < 6,'<br><font color=red><b>(in Bearbeitung ',
        //(SELECT a2.name FROM user u2 LEFT JOIN adresse a2 ON a2.id=u2.adresse WHERE u2.id='$usereditid'),')</b></font>',''))";
        $usereditid = str_replace("useredittimestamp","usereditid",$useredittimestamp);
        return "CONCAT($feld1,' ',if(TIME_TO_SEC(TIMEDIFF(NOW(), $useredittimestamp)) < 45,CONCAT('<br><font color=red><b>(in Bearbeitung von ',      (SELECT a2.name FROM user u2 LEFT JOIN adresse a2 ON a2.id=u2.adresse WHERE u2.id=$usereditid LIMIT 1),')</b></font>'),''))";
      }

      function TimeoutUseredit($smodule,$sid,$user)
      {
        $smodulea = explode(' ',$smodule);
        $smodule = $smodulea[0];
        if(!preg_match('/^[a-zA-Z0-9\_]*$/',$smodule,$trefer))
        {
          $smodule = '';
        }
        
        
        $useredittimestamp = $this->app->DB->Select("SELECT useredittimestamp FROM $smodule WHERE id='$sid' LIMIT 1");
        if($useredittimestamp=="0000-00-00 00:00:00" || $useredittimestamp=="")
        {
          $this->app->DB->Select("UPDATE $smodule SET useredittimestamp=NOW(),usereditid='".$user."' WHERE id='$sid' LIMIT 1");
        }

        // nur wenn timediff > 10 

        $timediff = $this->app->DB->Select("SELECT TIME_TO_SEC(TIMEDIFF(NOW(), useredittimestamp)) FROM $smodule WHERE id='$sid' LIMIT 1");
        $timeuser = $this->app->DB->Select("SELECT usereditid FROM $smodule WHERE id='$sid' LIMIT 1");
        if($timeuser == $user)
        {
          $this->app->DB->Select("UPDATE $smodule SET useredittimestamp=NOW() WHERE id='$sid' LIMIT 1");
        } else
        {
          if($timediff>30)
            $this->app->DB->Select("UPDATE $smodule SET useredittimestamp=NOW(),usereditid='$user' WHERE id='$sid' LIMIT 1");
        }
      }

      function DisableModul($modul,$id)
      {

        $user = $this->app->DB->Select("SELECT usereditid FROM $modul WHERE id='$id' LIMIT 1");
        $user_adresse = $this->app->DB->Select("SELECT adresse FROM user WHERE id='$user' LIMIT 1");
        $user_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$user_adresse' LIMIT 1");

        $this->TimeoutUseredit($modul,$id,$this->app->User->GetID());

        $timeuser = $this->app->DB->Select("SELECT usereditid FROM $modul WHERE id='$id' LIMIT 1");

        if($timeuser==$this->app->User->GetID())// || $timeuser=="")
        {
          return false;
        } else {

          if($this->RechteVorhanden("welcome","unlock"))
          {
            $id = $this->app->Secure->GetGET("id");
            $open = "<input type=\"button\" value=\"Dokument &uuml;bernehmen\" onclick=\"if(!confirm('Soll diese Oberfl&auml;che wirklich &uuml;bernommen werden? Alle Aktionen werden bei dem angemeldeten Mitarbeiter abgebrochen.')) return false;else window.location.href='index.php?module=welcome&action=unlock&id=$id&gui=$modul';\">";
          } else {
            $this->SystemLog("Fehlendes Recht",1,"","welcome","unlock");
          }

          $this->app->Tpl->Set('TAB1',"<div class=\"error\">Achtung dieses Dokument wird aktuell durch Mitarbeiter: <b>$user_name</b> bearbeitet! $open</div>");  
          $this->app->Tpl->Parse('PAGE',"tabview.tpl");
          return true;
        }

      }
      
      function LockModule($modul = null, $action = null)
      {
        if(is_null($modul))$modul = $this->app->Secure->GetGET("module");
        if(is_null($action))$action = $this->app->Secure->GetGET("action");
        //in Modul
        //if($this->app->erp->LockModul())return;
        //benutzen
        $time = microtime(true);
        $salt = md5(microtime(true));
        $saltjs = '

        var lockalert = false;
        var lockstarttime = '.$time.';
        setInterval(function(){
            lockstarttime = lockstarttime + 1;
        },1000
        );
        $(document).ready(function() {
          $( window ).unload(function() {
             $.ajax({
                url: "index.php?module=ajax&action=moduleunlock&salt='.$salt.'"
              });
          });
          window.addEventListener("beforeunload", function(event) {
             $.ajax({
                url: "index.php?module=ajax&action=moduleunlock&salt='.$salt.'"
              });
          });
          
          if(typeof(Storage) !== "undefined") {
              // Code for localStorage/sessionStorage.
              setInterval(function(){
                
                
               
                if(!localStorage.getItem("lockedmodule"))
                {
                  var data = new Object();
                  localStorage.setItem("lockedmodule",JSON.stringify(data));
                  
                  
                } 
                
                


                //if(localStorage.getItem("lockedmodule")){

                var lockstr = localStorage.getItem("lockedmodule");
                if(lockstr.indexOf("[") > -1)
                {
                  var data = new Object();
                  localStorage.setItem("lockedmodule",JSON.stringify(data));
                  lockstr = localStorage.getItem("lockedmodule");
                }
                var lockedmodule = JSON.parse(lockstr);
                if(typeof(lockedmodule["'.$modul.'"]) === "undefined")
                {
                  lockedmodule.'.$modul.' = new Object();
                }
                if(typeof(lockedmodule.'.$modul.'.'.$action.') === "undefined")
                {
                  lockedmodule.'.$modul.'.'.$action.' = new Object();
                }                  
                lockedmodule.'.$modul.'.'.$action.'.x'.$salt.' = lockstarttime;
                
                var ar = lockedmodule.'.$modul.'.'.$action.';
                var k;
                for (k in ar) {
                  var v = ar[k];
                  if(k === "x'.$salt.'")
                  {
                    lockedmodule.'.$modul.'.'.$action.'.x'.$salt.' = lockstarttime;
                    
                  }else{
                    if(v > lockstarttime - 1)
                    {
                      if(!lockalert){
                        lockalert = true;
                        alert("Sie haben noch ein Tab mit diesem Modul offen!");
                      }
                    } 
                    if(v < lockstarttime - 10)
                    {
                      
                    }
                  }
                  
                }
                var lstr = JSON.stringify(lockedmodule);
                localStorage.setItem("lockedmodule", JSON.stringify(lockedmodule));
                
                
              },1000);
              
              
          } else {
              // Sorry! No Web Storage support..
          }
          
        });
        ';

        if($this->app->Secure->GetPOST("unlock"))
        {
          if($this->app->erp->RechteVorhanden("welcome","unlock")){
            $this->app->DB->Delete("DELETE FROM module_lock where module like '".addslashes($modul)."' and action like '".addslashes($action)."'");
          }
        }

        if($locked = $this->app->DB->SelectArr("SELECT *, now() as aktzeit from module_lock where module like '".addslashes($modul)."' and action like '".addslashes($action)."' limit 1"))
        {
          $locked = reset($locked);
          if($locked['userid'] && $locked['userid'] != $this->app->User->GetID() && strtotime($locked['aktzeit']) - strtotime($locked['zeit']) < 300)
          {
            $user_adresse = $this->app->DB->Select("SELECT adresse FROM user WHERE id='",$locked['userid']."' LIMIT 1");
            $user_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$user_adresse' LIMIT 1");
            if($this->RechteVorhanden("welcome","unlock"))
            {
              $id = $this->app->Secure->GetGET("id");
              //$open = "<input type=\"button\" value=\"Modul &uuml;bernehmen\" onclick=\"if(!confirm('Soll diese Oberfl&auml;che wirklich &uuml;bernommen werden? Alle Aktionen werden bei dem angemeldeten Mitarbeiter abgebrochen.')) return false;else window.location.href='index.php?module=welcome&action=unlockmodul&smodule=$modul&saction=$action';\">";
              $open = '<form method="POST" id="frmLockModul"><input type="hidden" name="unlock" value="1" /><input type="button" onclick="if(!confirm(\'Soll diese Oberfl&auml;che wirklich &uuml;bernommen werden? Alle Aktionen werden bei dem angemeldeten Mitarbeiter abgebrochen.\')) return false;else document.getElementById(\'frmLockModul\').submit();" value="Modul &uuml;bernehmen" /></form>';
            } else {
              $this->SystemLog("Fehlendes Recht",1,"","welcome","unlock");
            }

            $this->app->Tpl->Set('TAB1',"<div class=\"error\">Achtung dieses Modul wird aktuell durch Mitarbeiter: <b>$user_name</b> bearbeitet! $open</div>");  
            $this->app->Tpl->Parse('PAGE',"tabview.tpl");
            return true;
            
          } else {
            
            $this->app->DB->Update("UPDATE module_lock set zeit = now(), userid = ".$this->app->User->GetID().", salt = '".$salt."' where module like '".addslashes($modul)."' and action like '".addslashes($action)."'");
            $this->app->Tpl->Add('JAVASCRIPT',$saltjs);
            
          }
          
        } else {
          
          $this->app->DB->Insert("INSERT INTO module_lock (module, action, userid, salt,  zeit) values ('".addslashes($modul)."','".addslashes($action)."','".$this->app->User->GetID()."','".$salt."', now())");
          $this->app->Tpl->Add('JAVASCRIPT',$saltjs);
        }
        return false;
        
      }
      
      function LoadStandardLieferadresse($adresse,$id,$type)
      {
        $standardlieferadresse = $this->app->DB->SelectArr("SELECT * FROM lieferadressen WHERE adresse='$adresse' AND standardlieferadresse='1' LIMIT 1");

        if($standardlieferadresse[0][id] > 0)
        {
          switch($type)
          {
            case "angebot":
            case "auftrag":
              $this->app->DB->Update("UPDATE $type SET abweichendelieferadresse='1', 
                  liefername='".$standardlieferadresse[0]['name']."', 
                  lieferabteilung='".$standardlieferadresse[0]['abteilung']."', 
                  lieferunterabteilung='".$standardlieferadresse[0]['unterabteilung']."',
                  lieferland='".$standardlieferadresse[0]['land']."',
                  lieferstrasse='".$standardlieferadresse[0]['strasse']."',
                  lieferort='".$standardlieferadresse[0]['ort']."',
                  lieferplz='".$standardlieferadresse[0]['plz']."',
                  lieferadresszusatz='".$standardlieferadresse[0]['adresszusatz']."',
                  lieferansprechpartner='".$standardlieferadresse[0]['ansprechpartner']."' 
                  WHERE id='$id' LIMIT 1");
              break;
            case "lieferschein":
              $this->app->DB->Update("UPDATE lieferschein SET 
                  name='".$standardlieferadresse[0]['name']."', 
                  abteilung='".$standardlieferadresse[0]['abteilung']."', 
                  unterabteilung='".$standardlieferadresse[0]['unterabteilung']."',
                  land='".$standardlieferadresse[0]['land']."',
                  strasse='".$standardlieferadresse[0]['strasse']."',
                  ort='".$standardlieferadresse[0]['ort']."',
                  plz='".$standardlieferadresse[0]['plz']."',
                  adresszusatz='".$standardlieferadresse[0]['adresszusatz']."',
                  ansprechpartner='".$standardlieferadresse[0]['ansprechpartner']."' 
                  WHERE id='$id' LIMIT 1");
              break;

          }
        }
      }

      function DisableVerband()
      {
        $module = $this->app->Secure->GetGET("module");
        $id = $this->app->Secure->GetGET("id");
        if($module=="angebot" || $module=="auftrag" || $module=="rechnung" || $module=="gutschrift")
        {
          /*
             $rabatt = $this->app->DB->Select("SELECT rabatt FROM $module WHERE id='$id' LIMIT 1");
             $this->app->Tpl->Set(RABATT,"<input type=\"text\" value=\"$rabatt\" size=\"4\" readonly>");
             for($i=1;$i<=5;$i++)
             {
             $rabatt = $this->app->DB->Select("SELECT rabatt$i FROM $module WHERE id='$id' LIMIT 1");
             $this->app->Tpl->Set("RABATT".$i,"<input type=\"text\" value=\"$rabatt\" size=\"4\" readonly>");
             }
           */
          $rabatt = $this->app->DB->Select("SELECT realrabatt FROM $module b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
          $gruppe = $this->app->DB->Select("SELECT gruppe FROM $module b WHERE b.id='$id' LIMIT 1");

          $adresse = $this->app->DB->Select("SELECT adresse FROM $module WHERE id='$id' LIMIT 1");
          $rabatte_festschreiben = $this->app->DB->Select("SELECT rabatte_festschreiben FROM adresse WHERE id='".$adresse."' LIMIT 1");


          if(($rabatt > 0 || $gruppe > 0) && $this->Firmendaten("modul_verband")=="1")
          {
            if($rabatte_festschreiben=="1" || $gruppe<=0)
              $this->app->Tpl->Set('RABATTANZEIGE'," <br><font color=red>Kundenrabatt: $rabatt%</font>");
            else
              $this->app->Tpl->Set('RABATTANZEIGE'," <br><font color=red>Verbandsrabatt: $rabatt%</font>");
          } else {
            $this->app->Tpl->Set('STARTDISABLEVERBAND',"<!--");
            $this->app->Tpl->Set('ENDEDISABLEVERBAND',"-->");
          }       

          if(($rabatte_festschreiben!="1" && $gruppe > 0) || $gruppe > 0) // ANZEIGE VERBAND wenn definiert
          {
            $gruppe = $this->app->DB->Select("SELECT gruppe FROM $module WHERE id='$id' LIMIT 1");
            $gruppe_name = $this->app->DB->Select("SELECT CONCAT(name,' ',kennziffer) FROM gruppen WHERE id='$gruppe' LIMIT 1");
            $gruppeinternebemerkung = $this->app->DB->Select("SELECT internebemerkung FROM gruppen WHERE id='$gruppe' LIMIT 1");
            //$gruppeinternebemerkung = strip_tags(html_entity_decode($gruppeinternebemerkung));    
            $this->app->Tpl->Set('VERBANDINFO',"<textarea cols=\"80\" rows=\"15\" id=\"readonlybox2\">$gruppeinternebemerkung</textarea>");
          }  else {
            $rabattinformation = $this->app->DB->Select("SELECT rabattinformation FROM adresse WHERE id='$adresse' LIMIT 1");
            //$rabattinformation = strip_tags(html_entity_decode($rabattinformation));      
            $this->app->Tpl->Set('VERBANDINFO',"<textarea cols=\"80\" rows=\"15\" id=\"readonlybox2\">$rabattinformation</textarea>");
          }

          if($this->RechteVorhanden($module,"deleterabatte"))
          {
            $this->app->Tpl->Set('VERBAND',"<input type=\"text\" value=\"$gruppe_name\" size=\"38\" readonly>&nbsp;<input type=\"button\" 
                onclick=\"if(!confirm('Wirklich die Verbandsinformation neu laden?')) return false; else window.location.href='index.php?module=".$module."&action=updateverband&id=".$id."';\" 
                value=\"Verband neu laden\">");
          } else {
            $this->app->Tpl->Set('VERBAND',"<input type=\"text\" value=\"$gruppe_name\" size=\"38\" readonly>");
          }
        }
      }


      // prueft ob adresse eine filiale ist wenn wird der beleg gekennzeichnet
      function LoadAdresseProjektfiliale($table,$id,$adresse)
      {
        $check = $this->app->DB->Select("SELECT id FROM projekt WHERE filialadresse='$adresse' LIMIT 1");
        if($check > 0)
        {
          $this->app->DB->Update("UPDATE $table SET projektfiliale=1 WHERE id='$id'");
        } else {
          $this->app->DB->Update("UPDATE $table SET projektfiliale=0 WHERE id='$id'");
        }
      }

      function LoadAdresseStandard($table,$id,$adresse)
      {
        if($table=="auftrag" || $table=="rechnung" || $table=="gutschrift" || $table=="lieferschein" || $table=="anfrage" || $table=="produktion" || $table=="bestellung")
        {
          $firma = $this->app->DB->Select("SELECT firma FROM $table WHERE id='$id' LIMIT 1");
          if($firma<=0)
          {
            $firma = $this->app->DB->Select("SELECT MAX(id) FROM firma LIMIT 1");
            $this->app->DB->Update("UPDATE $table SET firma='$firma' WHERE id='$id' LIMIT 1");
          }

          $this->LoadAdresseProjektfiliale($table,$id,$adresse); 
        }
        // firma check

      }

      function LoadAuftragStandardwerte($id,$adresse)
      {

        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT *,vertrieb as vertriebid,'' as bearbeiter FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

        $arr[0]['gruppe'] = $this->GetVerband($adresse);
        $field = array('anschreiben','name','vorname','abteilung','ansprechpartner','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax','kundennummer','projekt','ust_befreit','gruppe','typ','vertriebid','bearbeiter');


        $rolle_projekt = $this->app->DB->Select("SELECT parameter FROM adresse_rolle WHERE adresse='$adresse'   AND subjekt='Kunde' AND objekt='Projekt' AND (bis ='0000-00-00' OR bis <= NOW()) LIMIT 1");

        if($rolle_projekt > 0)
        {
          $arr[0]['projekt'] = $rolle_projekt;
        }


        foreach($field as $key=>$value)
        {
          if($value=="projekt" && $this->app->Secure->POST[$value]!="" && 0) // immer projekt von adresse
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }

          //$this->app->Secure->POST[$value] = $arr[0][$value];
          //$uparr[$value] = $arr[0][$value];
        }


        $uparr[adresse]=$adresse;
        $this->app->DB->UpdateArr("auftrag",$id,"id",$uparr);
        $uparr="";

        //liefernantenvorlage
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");

        // falls von Benutzer projekt ueberladen werden soll
        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");      
        if($projekt_bevorzugt=="1")
        {
          $uparr['projekt'] = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");        
          $arr[0]['projekt'] = $uparr['projekt'];
          $this->app->Secure->POST['projekt']=$this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='".$arr[0]['projekt']."' AND id > 0 LIMIT 1");
        }

        $field = array('zahlungsweise','zahlungszieltage','zahlungszieltageskonto','zahlungszielskonto','versandart');

        if($arr[0]['zahlungsweise']=="")
          $arr[0]['zahlungsweise']="vorkasse";

        if($arr[0]['zahlungszieltage']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszieltage']=$this->ZahlungsZielTage();
        if($arr[0]['zahlungszieltageskonto']<=0  && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszieltageskonto']=$this->ZahlungsZielTageSkonto();
        if($arr[0]['zahlungszielskonto']<=0  && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszielskonto']=$this->ZahlungsZielSkonto();

        if($arr[0]['versandart']=="")
          $arr[0]['versandart']="versandunternehmen";

        $this->app->Secure->POST['zahlungsweise'] = strtolower($arr[0]['zahlungsweise']);
        $this->app->Secure->POST['zahlungszieltage'] = strtolower($arr[0]['zahlungszieltage']);
        $this->app->Secure->POST['zahlungszieltageskonto'] = strtolower($arr[0]['zahlungszieltageskonto']);
        $this->app->Secure->POST['zahlungszielskonto'] = strtolower($arr[0]['zahlungszielskonto']);
        $this->app->Secure->POST['versandart'] = strtolower($arr[0]['versandart']);

        $this->LoadStandardLieferadresse($adresse,$id,"auftrag");

        $this->app->DB->UpdateArr("auftrag",$id,"id",$arr[0]);
        $this->LoadSteuersaetzeWaehrung($id,"auftrag");

        $this->LoadAdresseStandard("auftrag",$id,$adresse);
      }



      function LoadAngebotStandardwerte($id,$adresse)
      {
        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT *,vertrieb as vertriebid,'' as bearbeiter FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        $arr[0]['gruppe'] = $this->GetVerband($adresse);

        $rolle_projekt = $this->app->DB->Select("SELECT parameter FROM adresse_rolle WHERE adresse='$adresse' AND subjekt='Kunde' AND objekt='Projekt' AND (bis ='0000-00-00' OR bis <= NOW()) LIMIT 1");

        if($rolle_projekt > 0)
        {
          $arr[0]['projekt'] = $rolle_projekt;
        }

        $field = array('anschreiben','name','abteilung','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','ust_befreit','email','telefon','telefax','projekt','ansprechpartner','gruppe','typ','vertriebid','bearbeiter');
        foreach($field as $key=>$value)
        {
          if($value=="projekt" && $this->app->Secure->POST[$value]!="" && 0)
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }
        }
        $uparr['adresse'] = $adresse;
        $this->app->DB->UpdateArr("angebot",$id,"id",$uparr);
        $uparr="";

        //liefernantenvorlage
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");
        $field = array('zahlungsweise','zahlungszieltage','zahlungszieltageskonto','zahlungszielskonto','versandart');


        if($arr[0]['zahlungsweise']=="")
          $arr[0]['zahlungsweise']="rechnung";

        if($arr[0]['zahlungszieltage']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszieltage']=$this->ZahlungsZielTage();

        if($arr[0]['zahlungszieltageskonto']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszieltageskonto']=$this->ZahlungsZielTageSkonto();

        if($arr[0]['zahlungszielskonto']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszielskonto']=$this->ZahlungsZielSkonto();



        // falls von Benutzer projekt ueberladen werden soll
        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");      
        if($projekt_bevorzugt=="1")
        {
          $uparr['projekt'] = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");        
          $arr[0]['projekt'] = $uparr['projekt'];
          $this->app->Secure->POST['projekt']=$this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='".$arr[0]['projekt']."' AND id > 0 LIMIT 1");
        }



        $this->app->Secure->POST['zahlungsweise'] = strtolower($arr[0]['zahlungsweise']);
        $this->app->Secure->POST['zahlungszieltage'] = strtolower($arr[0]['zahlungszieltage']);
        $this->app->Secure->POST['zahlungszieltageskonto'] = strtolower($arr[0]['zahlungszieltageskonto']);
        $this->app->Secure->POST['zahlungszielskonto'] = strtolower($arr[0]['zahlungszielskonto']);
        $this->app->Secure->POST['versandart'] = strtolower($arr[0]['versandart']);
        /*
           foreach($field as $key=>$value)
           {
           $uparr[$value] = $arr[0][$value];
           $this->app->Secure->POST[$value] = $arr[0][$value];
           }
         */
        $this->app->DB->UpdateArr("angebot",$id,"id",$arr[0]);
        $this->LoadStandardLieferadresse($adresse,$id,"angebot");

        $this->LoadSteuersaetzeWaehrung($id,"angebot");
        //standardprojekt
        //$projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        //$this->app->Secure->POST[projekt] = $projekt;

        $this->LoadAdresseStandard("angebot",$id,$adresse);
      }

      function LoadGutschriftStandardwerte($id,$adresse)
      {
        if($id==0 || $id=="" || $adresse=="" || $adresse=="0") return;

        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT *,vertrieb as vertriebid,'' as bearbeiter FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

        $arr[0]['gruppe'] = $this->GetVerband($adresse);

        $rolle_projekt = $this->app->DB->Select("SELECT parameter FROM adresse_rolle WHERE adresse='$adresse' 
            AND subjekt='Kunde' AND objekt='Projekt' AND (bis ='0000-00-00' OR bis <= NOW()) LIMIT 1");

        if($rolle_projekt > 0)
        {
          $arr[0]['projekt'] = $rolle_projekt;
        }

        $field = array('anschreiben','name','abteilung','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax','kundennummer','projekt','ust_befreit','gruppe','typ','vertriebid','bearbeiter');
        foreach($field as $key=>$value)
        {
          if($value=="projekt" && $this->app->Secure->POST[$value]!="" && 0)
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }


          //$this->app->Secure->POST[$value] = $arr[0][$value];
          //$uparr[$value] = $arr[0][$value];
        }

        $uparr[adresse] = $adresse;
        $uparr[ust_befreit] = $this->AdresseUSTCheck($adresse);
        $uparr[zahlungsstatusstatus]="offen";

        $this->app->DB->UpdateArr("gutschrift",$id,"id",$uparr);
        $uparr="";

        //liefernantenvorlage
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");
        $field = array('zahlungsweise','zahlungszieltage','zahlungszieltageskonto','zahlungszielskonto','versandart');

        // falls von Benutzer projekt ueberladen werden soll
        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        { 
          $uparr['projekt'] = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
          $arr[0]['projekt'] = $uparr['projekt'];
          $this->app->Secure->POST['projekt']=$this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='".$arr[0]['projekt']."' AND id > 0 LIMIT 1");
        }

        if($arr[0]['zahlungsweise']=="")
          $arr[0]['zahlungsweise']="rechnung";

        if($arr[0]['zahlungszieltage']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszieltage']=$this->ZahlungsZielTage();

        if($arr[0]['zahlungszieltageskonto']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszieltageskonto']=$this->ZahlungsZielTageSkonto();

        if($arr[0]['zahlungszielskonto']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszielskonto']=$this->ZahlungsZielSkonto();

        $this->app->Secure->POST['zahlungsweise'] = strtolower($arr[0]['zahlungsweise']);
        $this->app->Secure->POST['zahlungszieltage'] = strtolower($arr[0]['zahlungszieltage']);
        $this->app->Secure->POST['zahlungszieltageskonto'] = strtolower($arr[0]['zahlungszieltageskonto']);
        $this->app->Secure->POST['zahlungszielskonto'] = strtolower($arr[0]['zahlungszielskonto']);
        $this->app->Secure->POST['versandart'] = strtolower($arr[0]['versandart']);
        /*
           foreach($field as $key=>$value)
           {
           $uparr[$value] = $arr[0][$value];
           $this->app->Secure->POST[$value] = $arr[0][$value];
           }
         */
        $this->app->DB->UpdateArr("gutschrift",$id,"id",$arr[0]);
        $this->LoadSteuersaetzeWaehrung($id,"gutschrift");
        $this->LoadAdresseStandard("gutschrift",$id,$adresse);
      }




      function LoadRechnungStandardwerte($id,$adresse)
      {
        if($id==0 || $id=="" || $adresse=="" || $adresse=="0") return;

        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT *,vertrieb as vertriebid,'' as bearbeiter FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

        $arr[0]['gruppe'] = $this->GetVerband($adresse);

        $rolle_projekt = $this->app->DB->Select("SELECT parameter FROM adresse_rolle WHERE adresse='$adresse' AND subjekt='Kunde' AND objekt='Projekt' AND (bis ='0000-00-00' OR bis <= NOW()) LIMIT 1");

        if($arr[0]['abweichende_rechnungsadresse']=="1")
        {
          $arr = $this->app->DB->SelectArr("SELECT projekt, rechnung_name as name,
              rechnung_abteilung as abteilung,
              rechnung_ansprechpartner as ansprechpartner,
              rechnung_unterabteilung as unterabteilung,
              rechnung_strasse as strasse,
              rechnung_adresszusatz as adresszusatz,
              rechnung_plz as plz,
              rechnung_ort as ort,
              rechnung_land as land,
              rechnung_telefon as telefon,
              rechnung_titel as titel,
              rechnung_email as email,
              rechnung_telefax as telefax,
              rechnung_vorname as vorname,
              rechnung_typ as typ,
              ustid,
              kundennummer,
              vertrieb as vertriebid,
              '' as bearbeiter,
              rechnung_anschreiben as anschreiben
              FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

            $arr[0]['gruppe'] = $this->GetVerband($adresse);
        } 
        $field = array('anschreiben','name','abteilung','typ','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax','kundennummer','projekt','ust_befreit','gruppe','vertriebid','bearbeiter','ansprechpartner','titel');

        if($rolle_projekt > 0)
        {
          $arr[0]['projekt'] = $rolle_projekt;
        }

        foreach($field as $key=>$value)
        {
          if($value=="projekt" && $this->app->Secure->POST[$value]!=""&&0)
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }

          //$this->app->Secure->POST[$value] = $arr[0][$value];
          //$uparr[$value] = $arr[0][$value];
        }

        $uparr[adresse] = $adresse;
        $uparr[ust_befreit] = $this->AdresseUSTCheck($adresse);
        $uparr[zahlungsstatusstatus]="offen";

        if($this->Firmendaten("rechnung_ohnebriefpapier")=="1")
          $uparr[ohne_briefpapier] = "1";

        $this->app->DB->UpdateArr("rechnung",$id,"id",$uparr);
        $uparr="";

        //liefernantenvorlage
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' LIMIT 1");

        if($arr[0]['abweichende_rechnungsadresse']=="1")
        {
          $arr = $this->app->DB->SelectArr("SELECT projekt, rechnung_name as name,
              rechnung_abteilung as abteilung,
              rechnung_unterabteilung as unterabteilung,
              rechnung_strasse as strasse,
              rechnung_adresszusatz as adresszusatz,
              rechnung_plz as plz,
              rechnung_ort as ort,
              rechnung_land as land,
              rechnung_telefon as telefon,
              rechnung_telefax as telefax,
              rechnung_vorname as vorname,
              rechnung_typ as typ,
              zahlungsweise,zahlungszieltage,zahlungszieltageskonto,zahlungszielskonto,versandart,
              rechnung_anschreiben as anschreiben
              FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        }

        $field = array('zahlungsweise','zahlungszieltage','zahlungszieltageskonto','zahlungszielskonto','versandart');

        if($arr[0]['zahlungsweise']=="")
          $arr[0]['zahlungsweise']="rechnung";

        if($arr[0]['zahlungszieltage']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszieltage']=$this->ZahlungsZielTage();

        if($arr[0]['zahlungszieltageskonto']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszieltageskonto']=$this->ZahlungsZielTageSkonto();

        if($arr[0]['zahlungszielskonto']<=0 && $arr[0]['zahlungsweise']=="rechnung")
          $arr[0]['zahlungszielskonto']=$this->ZahlungsZielSkonto();

        // falls von Benutzer projekt ueberladen werden soll
        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");      
        if($projekt_bevorzugt=="1")
        {
          $uparr['projekt'] = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");        
          $arr[0]['projekt'] = $uparr['projekt'];
          $this->app->Secure->POST['projekt']=$this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='".$arr[0]['projekt']."' AND id > 0 LIMIT 1");
        }

        $this->app->Secure->POST['zahlungsweise'] = strtolower($arr[0]['zahlungsweise']);
        $this->app->Secure->POST['zahlungszieltage'] = strtolower($arr[0]['zahlungszieltage']);
        $this->app->Secure->POST['zahlungszieltageskonto'] = strtolower($arr[0]['zahlungszieltageskonto']);
        $this->app->Secure->POST['zahlungszielskonto'] = strtolower($arr[0]['zahlungszielskonto']);
        $this->app->Secure->POST['versandart'] = strtolower($arr[0]['versandart']);
        /*
           foreach($field as $key=>$value)
           {
           $uparr[$value] = $arr[0][$value];
           $this->app->Secure->POST[$value] = $arr[0][$value];
           }
         */
        $this->app->DB->UpdateArr("rechnung",$id,"id",$arr[0]);

        $this->LoadSteuersaetzeWaehrung($id,"rechnung");
        $this->LoadAdresseStandard("rechnung",$id,$adresse);
      }



      function LoadBestellungStandardwerte($id,$adresse)
      {
        // standard adresse von lieferant       
        $arr = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        $rolle_projekt = $this->app->DB->Select("SELECT parameter FROM adresse_rolle WHERE adresse='$adresse' AND subjekt='Lieferant' AND objekt='Projekt' AND (bis ='0000-00-00' OR bis <= NOW()) LIMIT 1");

        if($rolle_projekt > 0)
        {
          $arr[0]['projekt'] = $rolle_projekt;
        }
        $field = array('anschreiben','name','abteilung','unterabteilung','strasse','adresszusatz','plz','ort','land','ustid','email','telefon','telefax','lieferantennummer','projekt','ust_befreit');
        foreach($field as $key=>$value)
        {
          if($value=="projekt" && $this->app->Secure->POST[$value]!=""&&0)
          {
            $uparr[$value] = $this->app->Secure->POST[$value];
          } else {
            $this->app->Secure->POST[$value] = $arr[0][$value];
            $uparr[$value] = $arr[0][$value];
          }
          //$this->app->Secure->POST[$value] = $arr[0][$value];
          //$uparr[$value] = $arr[0][$value];
        }
        $uparr[adresse] = $adresse;
        $this->app->DB->UpdateArr("bestellung",$id,"id",$uparr);
        $uparr="";

        //liefernantenvorlage
        $arr = $this->app->DB->SelectArr("SELECT 
            kundennummerlieferant as kundennummer,
            zahlungsweiselieferant as zahlungsweise,
            zahlungszieltagelieferant as zahlungszieltage,
            zahlungszieltageskontolieferant as zahlungszieltageskonto,
            zahlungszielskontolieferant as zahlungszielskonto,
            versandartlieferant as versandart
            FROM adresse WHERE id='$adresse' LIMIT 1");

        // falls von Benutzer projekt ueberladen werden soll
        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        { 
          $uparr['projekt'] = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
          $arr[0]['projekt'] = $uparr['projekt'];
          $this->app->Secure->POST['projekt']=$this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='".$arr[0]['projekt']."' AND id > 0 LIMIT 1");
        }

        $field = array('kundennummer','zahlungsweise','zahlungszieltage','zahlungszieltageskonto','zahlungszielskonto','versandart');
        foreach($field as $key=>$value)
        {
          $uparr[$value] = $arr[0][$value];
          $this->app->Secure->POST[$value] = $arr[0][$value];
        }


        $this->app->DB->UpdateArr("bestellung",$id,"id",$uparr);

        //standardprojekt
        //$projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        //$this->app->Secure->POST[projekt] = $projekt;
        $this->LoadAdresseStandard("bestellung",$id,$adresse);
      }


      function CreateArbeitsnachweis($adresse="",$projekt="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM angebot WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;

        if($projekt<=0)
        {
          if($adresse>0)
            $tmp_projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");

          if($tmp_projekt <= 0)
            $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
          else
            $projekt = $tmp_projekt;

          $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
          if($projekt_bevorzugt=="1")
          { 
            $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
          }
        }

        $belegmax = $this->GetNextNummer("arbeitsnachweis",$projekt);

        $ohnebriefpapier = $this->Firmendaten("arbeitsnachweis_ohnebriefpapier");

        $this->app->DB->Insert("INSERT INTO arbeitsnachweis (id,datum,bearbeiter,firma,belegnr,adresse,ohne_briefpapier,status,anzeige_verrechnungsart,projekt) 
            VALUES ('',NOW(),'".$this->app->User->GetName()."','".$this->app->User->GetFirma()."','$belegmax','$adresse','".$ohnebriefpapier."','freigegeben',0,'$projekt')");

        $id = $this->app->DB->GetInsertID();
        return $id;
      }


      function CreateInventur($adresse="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM angebot WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;

        $belegmax = "";
        //              $ohnebriefpapier = $this->Firmendaten("reisekosten_ohnebriefpapier");
        $ohnebriefpapier = 1;
        $this->app->DB->Insert("INSERT INTO inventur (id,datum,bearbeiter,firma,belegnr,adresse,ohne_briefpapier) 
            VALUES ('',NOW(),'".$this->app->User->GetName()."','".$this->app->User->GetFirma()."','$belegmax','$adresse','".$ohnebriefpapier."')");

        $id = $this->app->DB->GetInsertID();
        $this->LoadSteuersaetzeWaehrung($id,"inventur");
        return $id;
      }



      function CreateAnfrage($adresse="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM angebot WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;

        $belegmax = "";
        //              $ohnebriefpapier = $this->Firmendaten("reisekosten_ohnebriefpapier");
        $ohnebriefpapier = 1;
        $this->app->DB->Insert("INSERT INTO anfrage (id,datum,bearbeiter,firma,belegnr,adresse,ohne_briefpapier,bearbeiterid) 
            VALUES ('',NOW(),'".$this->app->User->GetName()."','".$this->app->User->GetFirma()."','$belegmax','$adresse','".$ohnebriefpapier."',
              '".$this->app->User->GetAdresse()."')");

        $id = $this->app->DB->GetInsertID();
        $this->LoadSteuersaetzeWaehrung($id,"anfrage");
        return $id;
      }



      function CreateReisekosten($adresse="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM angebot WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;

        if($adresse>0)
          $tmp_projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");

        if($tmp_projekt <= 0)
          $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
        else
          $projekt = $tmp_projekt;

        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        { 
          $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        }


        $belegmax = "";
        //              $ohnebriefpapier = $this->Firmendaten("reisekosten_ohnebriefpapier");
        $ohnebriefpapier = 1;
        $this->app->DB->Insert("INSERT INTO reisekosten (id,datum,bearbeiter,firma,belegnr,adresse,ohne_briefpapier,projekt) 
            VALUES ('',NOW(),'".$this->app->User->GetName()."','".$this->app->User->GetFirma()."','$belegmax','$adresse','".$ohnebriefpapier."','$projekt')");

        $id = $this->app->DB->GetInsertID();
        $this->LoadSteuersaetzeWaehrung($id,"reisekosten");
        return $id;
      }

      function ZeitSollDatumArbeit($adresse,$datum)
      {
        $erg = $this->app->DB->Select('SELECT stunden FROM mitarbeiterzeiterfassung_sollstunden WHERE datum = "' . $datum . '"
          AND adresse = "' . $adresse . '" LIMIT 1');
        if($erg<=0) $erg=0;
        return $erg;
      }

      function ZeitGesamtDatumArbeitAbrechnen($adresse,$datum)
      {
        $sql = "SELECT SUM((TIMESTAMPDIFF(SECOND,z.von, z.bis))/3600) FROM `zeiterfassung` z WHERE z.art LIKE 'Arbeit' 
          AND DATE_FORMAT(z.von,'%Y-%m-%d')='$datum' AND z.adresse='$adresse' AND z.abrechnen=1";

        $erg=$this->app->DB->Select($sql);
        if($erg<=0) $erg=0;
        return $erg;
      }
      function ZeitGesamtAufgabe($id,$adresse=0)
      {

        if($adresse<=0)
        {
          $sql = "SELECT SUM((TIMESTAMPDIFF(SECOND,z.von, z.bis))/3600) FROM `zeiterfassung` z WHERE z.art LIKE 'Arbeit' AND z.aufgabe_id='$id'";
        } else {
          $sql = "SELECT SUM((TIMESTAMPDIFF(SECOND,z.von, z.bis))/3600) FROM `zeiterfassung` z WHERE z.art LIKE 'Arbeit' AND z.aufgabe_id='$id' AND z.adresse='$adresse'";
        }

        $erg=$this->app->DB->Select($sql);
        if($erg<=0) $erg=0;
        return $erg;
      }




      function ZeitGesamtDatumArbeit($adresse,$datum)
      {
        $sql = "SELECT SUM((TIMESTAMPDIFF(SECOND,z.von, z.bis))/3600) FROM `zeiterfassung` z WHERE z.art LIKE 'Arbeit' 
          AND DATE_FORMAT(z.von,'%Y-%m-%d')='$datum' AND z.adresse='$adresse'";

        $erg=$this->app->DB->Select($sql);
        if($erg<=0) $erg=0;
        return $erg;
      }

      function ZeitGesamtHeuteArbeit($adresse)
      {
        $sql = "SELECT SUM((TIMESTAMPDIFF(SECOND,z.von, z.bis))/3600) FROM `zeiterfassung` z WHERE z.art LIKE 'Arbeit' 
          AND DATE_FORMAT(z.von,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d') AND z.adresse='$adresse'";

        $erg=$this->app->DB->Select($sql);
        if($erg<=0) $erg=0;
        return $erg;
      }


      function ZeitGesamtDatumPause($adresse,$datum)
      {
        $sql = "SELECT SUM((TIMESTAMPDIFF(SECOND,z.von, z.bis))/3600) FROM `zeiterfassung` z WHERE z.art LIKE 'Pause' 
          AND DATE_FORMAT(z.von,'%Y-%m-%d')='$datum' AND z.adresse='$adresse'";

        $erg=$this->app->DB->Select($sql);
        if($erg <=0) $erg=0;
        return $erg;
      }


      function ZeitGesamtHeutePause($adresse)
      {
        $sql = "SELECT SUM((TIMESTAMPDIFF(SECOND,z.von, z.bis))/3600) FROM `zeiterfassung` z WHERE z.art LIKE 'Pause' 
          AND DATE_FORMAT(z.von,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d') AND z.adresse='$adresse'";

        $erg=$this->app->DB->Select($sql);
        if($erg <=0) $erg=0;
        return $erg;
      }

      function ZeitGesamtWocheIst($adresse,$jahr="",$kw="")
      {
        if($jahr=="") $jahr=date('Y');
        if($kw=="") $kw=date('W');

        $kw = str_pad($kw, 2, "0", STR_PAD_LEFT);

        $sql = "SELECT SUM((TIMESTAMPDIFF(SECOND,z.von, z.bis))/3600) FROM `zeiterfassung` z WHERE z.art LIKE 'Arbeit' 
          AND DATE_FORMAT(z.von,'%Y-%v')='".$jahr."-".$kw."' AND z.adresse='$adresse'";

        $erg=$this->app->DB->Select($sql);
        if($erg <=0) $erg=0;
        return $erg;
      }

      function ZeitGesamtWocheSoll($adresse,$jahr="",$kw="")
      {
        $out=$this->GetArbeitszeitWoche($adresse,$jahr,$kw);
        return $out;
      }

      function ZeitGesamtWocheOffen($adresse,$jahr="",$kw="")
      {
        $ist=$this->ZeitGesamtWocheIst($adresse,$jahr,$kw);
        $soll=$this->ZeitGesamtWocheSoll($adresse,$jahr,$kw);
        $out=$soll-$ist;
        return $out;
      }

      function GetArbeitszeitWoche($adresse,$jahr,$kw)
      {
        $arbeitszeitprowoche = $this->app->DB->Select("SELECT arbeitszeitprowoche FROM adresse WHERE id='$adresse' LIMIT 1");
        if($arbeitszeitprowoche<=0 || !is_numeric($arbeitszeitprowoche)) return 0;
        else return $arbeitszeitprowoche;
      }   



      function AddArbeitsnachweisPositionZeiterfassung($arbeitsnachweis,$zid)
      {
        /*
           $artikel = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
           $bezeichnunglieferant = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1"); 
           $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1"); 
           $projekt = $this->app->DB->Select("SELECT projekt FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        //$waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        //$vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
         */


        $tmp = $this->app->DB->SelectArr("SELECT *,DATE_FORMAT(von,'%Y-%m-%d') as datum,DATE_FORMAT(von,'%H:%i') as von,DATE_FORMAT(bis,'%H:%i') as bis FROM zeiterfassung WHERE id='$zid'");
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM arbeitsnachweis_position WHERE arbeitsnachweis='$arbeitsnachweis' LIMIT 1");
        $sort = $sort + 1;

        $adresse = $tmp[0][adresse]; //mitarbeiter
        $bezeichnung = $tmp[0][aufgabe];
        $beschreibung = $tmp[0][beschreibung];
        $ort = $tmp[0][ort];
        $arbeitspaket =$tmp[0][arbeitspaket];
        $datum = $tmp[0][datum];
        $von=$tmp[0][von];
        $bis=$tmp[0][bis];

        $this->app->DB->Insert("INSERT INTO arbeitsnachweis_position (id,arbeitsnachweis,artikel,bezeichnung,beschreibung,ort,arbeitspaket,datum,von,bis,sort,status,projekt,adresse) 
            VALUES ('','$arbeitsnachweis','$artikel','$bezeichnung','$beschreibung','$ort','$arbeitspaket','$datum','$von','$bis','$sort','angelegt','$projekt','$adresse')");
        $tmpid = $this->app->DB->GetInsertID();
        //markieren als erledigt
        $this->app->DB->Update("UPDATE zeiterfassung SET arbeitsnachweis='$arbeitsnachweis',arbeitsnachweispositionid='$tmpid' WHERE id='$zid'");

        //echo ("INSERT INTO lieferschein_position (id,lieferschein,artikel,bezeichnung,nummer,menge,sort,lieferdatum,status,projekt,vpe) 
        //      VALUES ('','$lieferschein','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$sort','$datum','angelegt','$projekt','$vpe')");
      }

      
      function CreateAufgabe($adresse,$aufgabe)
      {
        $this->app->DB->Insert("INSERT INTO aufgabe (id,adresse,initiator,aufgabe,status) VALUES ('','$adresse','".$this->app->User->GetAdresse()."','$aufgabe','offen')");
        return $this->app->DB->GetInsertID();
      }

      function AbschlussAufgabe($id)
      {

        // einmalig immer weg
        $intervall_tage = $this->app->DB->Select("SELECT intervall_tage FROM aufgabe WHERE id='$id'");
        $startdatum = $this->app->DB->Select("SELECT abgabe_bis FROM aufgabe WHERE id='$id'");
        $check = $this->app->DB->Select("SELECT id FROM aufgabe WHERE id='$id' AND ((abgabe_bis <= NOW() AND intervall_tage > 0) OR intervall_tage=0)");

        if($check<=0) return -1;

        switch($intervall_tage)
        {
          case 1: //taeglich
            $newaufgabe = $this->CopyAufgabe($id);
            $newstartdatum =date('Y-m-d H:i:s', strtotime("$startdatum +1 days"));
            $this->app->DB->Update("UPDATE aufgabe SET abgabe_bis='$newstartdatum' WHERE id='$newaufgabe'");
          break;

          case 2: //wochen
            $newaufgabe = $this->CopyAufgabe($id);
            $newstartdatum =date('Y-m-d H:i:s', strtotime("$startdatum +7 days"));
            $this->app->DB->Update("UPDATE aufgabe SET abgabe_bis='$newstartdatum' WHERE id='$newaufgabe'");
          break;
          case 3: //monatlich
            $newaufgabe = $this->CopyAufgabe($id);
            $newstartdatum =date('Y-m-d H:i:s', strtotime("$startdatum +1 month"));
            $this->app->DB->Update("UPDATE aufgabe SET abgabe_bis='$newstartdatum' WHERE id='$newaufgabe'");
          break;
          case 4: // jaehrlich
            $newaufgabe = $this->CopyAufgabe($id);
            $newstartdatum =date('Y-m-d H:i:s', strtotime("$startdatum +1 year"));
            $this->app->DB->Update("UPDATE aufgabe SET abgabe_bis='$newstartdatum' WHERE id='$newaufgabe'");
          break;
        }
        // aufgaben kopieren und dann wenn intervall_tage 2 = woechen 3 monatlich 4 jaehrlich
        // alles kopieren 1:1 neue hat mit dem datum von turnus +1 tag + 7 Tage oder monatlich immer wieder dann rein

        // ab taeglich kann man nur abschliessen abgabe_bis <= heute ist 
        $this->app->DB->Update("UPDATE aufgabe SET status='abgeschlossen',abgeschlossen_am=NOW() WHERE id='$id' LIMIT 1");
        return 1;
      }

      function CopyAufgabe($id)
      {
        return $this->app->DB->MysqlCopyRow("aufgabe","id",$id);
      }


      function CreateLieferschein($adresse="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM angebot WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;
        if($adresse>0)
          $tmp_projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");

        if($tmp_projekt <= 0)
          $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
        else
          $projekt = $tmp_projekt;

        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        {
          $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        }





        $belegmax = "";
        $ohnebriefpapier = $this->Firmendaten("lieferschein_ohnebriefpapier");
        $this->app->DB->Insert("INSERT INTO lieferschein (id,datum,bearbeiter,firma,belegnr,adresse,ohne_briefpapier,projekt) 
            VALUES ('',NOW(),'".$this->app->User->GetName()."','".$this->app->User->GetFirma()."','$belegmax','$adresse','".$ohnebriefpapier."','".$projekt."')");


        $id = $this->app->DB->GetInsertID();
        return $id;
      }

      function AddLieferscheinPositionArtikelID($lieferschein, $artikelid,$menge,$bezeichnung,$beschreibung,$datum)
      {
        $artikel = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1"); 

        if($bezeichnung=="")
          $bezeichnung = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1"); 

        $projekt = $this->app->DB->Select("SELECT projekt FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        //$waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        //$vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM lieferschein_position WHERE lieferschein='$lieferschein' LIMIT 1");
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO lieferschein_position (id,lieferschein,artikel,bezeichnung,beschreibung,nummer,menge,sort,lieferdatum,status,projekt,vpe) 
            VALUES ('','$lieferschein','$artikel','$bezeichnung','$beschreibung','$bestellnummer','$menge','$sort','$datum','angelegt','$projekt','$vpe')");
      }


      function AddLieferscheinPosition($lieferschein, $verkauf,$menge,$datum)
      {
        $artikel = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $bezeichnunglieferant = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $projekt = $this->app->DB->Select("SELECT projekt FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        //$waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        //$vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM lieferschein_position WHERE lieferschein='$lieferschein' LIMIT 1");
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO lieferschein_position (id,lieferschein,artikel,bezeichnung,nummer,menge,sort,lieferdatum,status,projekt,vpe) 
            VALUES ('','$lieferschein','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$sort','$datum','angelegt','$projekt','$vpe')");


        //echo ("INSERT INTO lieferschein_position (id,lieferschein,artikel,bezeichnung,nummer,menge,sort,lieferdatum,status,projekt,vpe) 
        //      VALUES ('','$lieferschein','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$sort','$datum','angelegt','$projekt','$vpe')");
      }


      function DeleteAnfrage($id)
      {
        $this->app->DB->Delete("DELETE FROM anfrage_position WHERE anfrage='$id'");
        $this->app->DB->Delete("DELETE FROM anfrage_protokoll WHERE anfrage='$id'");
        $this->app->DB->Delete("DELETE FROM anfrage WHERE id='$id' LIMIT 1");
      }


      function DeleteInventur($id)
      {
        $this->app->DB->Delete("DELETE FROM inventur_position WHERE inventur='$id'");
        $this->app->DB->Delete("DELETE FROM inventur_protokoll WHERE inventur='$id'");
        $this->app->DB->Delete("DELETE FROM inventur WHERE id='$id' LIMIT 1");
      }


      function DeleteReisekosten($id)
      {
        $this->app->DB->Delete("DELETE FROM reisekosten_position WHERE reisekosten='$id'");
        $this->app->DB->Delete("DELETE FROM reisekosten_protokoll WHERE reisekosten='$id'");
        $this->app->DB->Delete("DELETE FROM reisekosten WHERE id='$id' LIMIT 1");
      }

      function DeleteArbeitsnachweis($id)
      {
        $belegnr = $this->app->DB->Select("SELECT belegnr FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
        $this->app->DB->Delete("DELETE FROM arbeitsnachweis_position WHERE arbeitsnachweis='$id'");
        $this->app->DB->Delete("DELETE FROM arbeitsnachweis_protokoll WHERE arbeitsnachweis='$id'");
        $this->app->DB->Delete("DELETE FROM arbeitsnachweis WHERE id='$id' LIMIT 1");

        // freigeben aller Zeiterrfassungen
        $this->app->DB->Update("UPDATE zeiterfassung SET arbeitsnachweis='0',arbeitsnachweispositionid='0',
            abgerechnet='0', ist_abgerechnet='0' WHERE arbeitsnachweis='$id'");
      }

      function DeleteLieferschein($id)
      {
        $this->app->DB->Delete("DELETE FROM lieferschein_position WHERE lieferschein='$id'");
        $this->app->DB->Delete("DELETE FROM lieferschein_protokoll WHERE lieferschein='$id'");
        $this->app->DB->Delete("DELETE FROM lieferschein WHERE id='$id' LIMIT 1");
      }



      function CreateAuftrag($adresse="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM angebot WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;
        $ohnebriefpapier = $this->Firmendaten("auftrag_ohnebriefpapier");
        $belegmax = "";

        if($adresse>0)
          $tmp_projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");

        if($tmp_projekt <= 0)
          $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
        else
          $projekt = $tmp_projekt;

        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        {
          $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        }


        $firma = $this->app->DB->Select("SELECT MAX(id) FROM firma LIMIT 1");
        //    $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$firma."' LIMIT 1");

        if($this->StandardZahlungsweise($projekt)=="rechnung")
        {
          $this->app->DB->Insert("INSERT INTO auftrag (id,datum,bearbeiter,firma,belegnr,autoversand,zahlungsweise,zahlungszieltage,
          zahlungszieltageskonto,zahlungszielskonto,status,projekt,adresse,ohne_briefpapier) 
            VALUES ('',NOW(),'','','$belegmax',1,'".$this->StandardZahlungsweise($projekt)."',
              '".$this->ZahlungsZielTage($projekt)."',
              '".$this->ZahlungsZielTageSkonto($projekt)."',
              '".$this->ZahlungsZielSkonto($projekt)."',
              'angelegt','$projekt','$adresse','".$ohnebriefpapier."')");
        } else {
          $this->app->DB->Insert("INSERT INTO auftrag (id,datum,bearbeiter,firma,belegnr,autoversand,zahlungsweise,zahlungszieltage,
          zahlungszieltageskonto,zahlungszielskonto,status,projekt,adresse,ohne_briefpapier) 
            VALUES ('',NOW(),'','','$belegmax',1,'".$this->StandardZahlungsweise($projekt)."',
              '0',
              '0',
              '0',
              'angelegt','$projekt','$adresse','".$ohnebriefpapier."')");
        }

        $id = $this->app->DB->GetInsertID();

        $this->CheckVertrieb($id,"auftrag");
        $this->CheckBearbeiter($id,"auftrag");

        $this->LoadSteuersaetzeWaehrung($id,"auftrag",$projekt);
        return $id;
      }


      function ArtikelIDProjekt($artikelnummer,$projekt=0)
      {
        $eigenernummernkreis = $this->app->DB->Select("SELECT eigenernummernkreis FROM projekt WHERE id='$projekt' LIMIT 1");
        if($eigenernummernkreis=="1")
        {
          $artikel = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$artikelnummer' AND projekt='$projekt' AND nummer!='' LIMIT 1"); 
        }
        else {
          $artikel = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$artikelnummer' AND nummer!='' LIMIT 1"); 
        }
        return $artikel;
      }

      function AddAuftragPositionNummer($auftrag,$nummer,$menge,$projekt,$nullpreis="",$taxfree=false,$typ="", $data = null)
      {
        $artikel = $this->ArtikelIDProjekt($nummer,$projekt);
        $bezeichnunglieferant = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1"); 

        // $verkaufsid = $this->app->DB->Select("SELECT id FROM verkaufspreise WHERE artikel='$artikel' 
        //AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND ab_menge=1 AND geloescht=0 AND (adresse='0' OR adresse='') AND objekt='Standard' LIMIT 1"); 

        $verkaufsid = $this->app->DB->Select("SELECT id FROM verkaufspreise WHERE artikel='$artikel'                                             
            AND (gueltig_bis='0000-00-00' OR gueltig_bis >=NOW()) AND ab_menge=1                                           
            AND ((objekt='Standard' AND adresse=0) OR (objekt='' AND adresse=0)) AND geloescht=0 LIMIT 1");                   

          $preis = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE id='$verkaufsid' LIMIT 1"); 

        if($nullpreis=="1")
          $preis = 0;

        // wenn mehr rein kam als geplant
        //if($taxfree==false)
        //{
        //$preis = $vkpreis;
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id='$artikel' LIMIT 1");

        $mlmpunkte = $this->app->DB->Select("SELECT mlmpunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmbonuspunkte = $this->app->DB->Select("SELECT mlmbonuspunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmdirektpraemie = $this->app->DB->Select("SELECT mlmdirektpraemie FROM artikel WHERE id='$artikel' LIMIT 1");

        //} else {
        //  $umsatzsteuer = 0;
        //}

        $vpe  = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkaufsid' LIMIT 1"); 

        if($typ=="produktion")
        {
        } else {
          $sort = $this->app->DB->Select("SELECT MAX(sort) FROM auftrag_position WHERE auftrag='$auftrag' LIMIT 1");
          $sort = $sort + 1;
          $this->app->DB->Insert("INSERT INTO auftrag_position (id,auftrag,artikel,bezeichnung,nummer,menge,preis, sort,lieferdatum, umsatzsteuer, status,projekt,vpe,punkte,bonuspunkte,mlmdirektpraemie) 
              VALUES ('','$auftrag','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$preis','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe','$mlmpunkte','$mlmbonuspunkte','$mlmdirektpraemie')");
          $insid = $this->app->DB->GetInsertID();
          if(!is_null($data))
          {
            $this->LogFile('data ex');
            if(isset($data['parentap']))
            {
              $this->LogFile("parentap ".$data['parentap']. " insid ".$insid);
              $this->app->DB->Update("UPDATE auftrag_position set explodiert = 1 where id = '".$data['parentap']."'");
              $this->app->DB->Update("UPDATE auftrag_position set explodiert_parent = '".$data['parentap']."' where id = '$insid'");
            }
          }
        }
        return $insid;
      }

      function AddPositionManuellPreisNummer($typ,$id,$projekt, $artikelnummer,$menge,$name,$preis,$umsatzsteuer,$rabatt=0,$shop=0,$waehrung='EUR',$data = null)
      {
        // wenn es Artikel nicht gibt anlegen! bzw. immer updaten wenn name anders ist
//        $artikel = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$artikelnummer' AND nummer!='' LIMIT 1"); 
        $artikel = 0;
        $artikelnummernummerkreis = false;
        $externeartikelnummer = "";
        if(!$projekt)$projekt = $this->app->DB->Select("SELECT projekt FROM shopexport WHERE id='".$shop."' LIMIT 1");
        if($shop)
        {
          if($projekt)$eigenernummernkreis = $this->app->DB->Select("SELECT eigenernummernkreis FROM projekt WHERE id = '$projekt' LIMTI 1");
          $artikelnummernummerkreis = $this->app->DB->Select("SELECT artikelnummernummerkreis FROM shopexport WHERE id = '$shop' LIMIT 1");
          $artikel = $this->app->DB->Select("SELECT a.id FROM artikelnummer_fremdnummern af INNER JOIN artikel a on af.artikel = a.id WHERE af.nummer ='".$this->app->DB->real_escape_string($artikelnummer)."' AND" .($eigenernummernkreis?" a.projekt = '$projekt' AND ":''). " shopid = '$shop' AND aktiv = 1 LIMIT 1");
          if($artikel)$artikelnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id = '$artikel' LIMIT 1");
        }

        if(!$artikel)$artikel = $this->ArtikelIDProjekt($artikelnummer,$projekt);
        if($artikel <=0)
        {
          if($artikelnummernummerkreis)
          {
            $externeartikelnummer = $artikelnummer;
            $artikelnummer = $this->GetNextArtikelnummer("produkt", 1, $projekt);
          }
          
          //Artikel anlegen
          $artdata = array('name_de'=>$name,'nummer'=>$artikelnummer,'projekt'=>$projekt,'umsatzsteuer'=>$umsatzsteuer,'lagerartikel'=>1,'shop'=>$shop);
          if(!is_null($data) && is_array($data))
          {
            foreach($data as $k => $v)
            {
              switch($k)
              {
                case 'anabregs_text':
                case 'anabregs_text_en':
                case 'kurztext_de':
                case 'kurztext_en':
                case 'uebersicht_de':
                case 'uebersicht_en':
                case 'metadescription_de':
                case 'metadescription_en':
                case 'metakeywords_de':
                case 'metakeywords_en':                
                  $artdata[$k] = $v;
                break;
                case 'anabregs_text_de':
                  $artdata['anabregs_text'] = $v;
                break;
              }
              switch($k)
              {
                case 'anabregs_text':
                case 'anabregs_text_de':
                  $beschreibung = $v;
                break;
              }
            }
            
          }
          $artikel = $this->AddArtikel($artdata);
          if($externeartikelnummer)
          {
            $shopbezeichnung = "";
            if($shop)$shopbezeichnung = $this->app->DB->Select("SELECT bezeichnung FROM shopexport WHERE id = '$shop' LIMIT 1");
            $this->app->DB->Insert("INSERT INTO artikelnummer_fremdnummern (artikel, aktiv, nummer, bearbeiter,bezeichnung,shopid) VALUES ('".$artikel."','1','".$this->app->DB->real_escape_string($externeartikelnummer)."','".$this->app->DB->real_escape_string($this->app->User->GetName())."','".$this->app->DB->real_escape_string($shopbezeichnung)."','$shop')");
          }
          $this->AddVerkaufspreis($artikel,1,0,$preis,$waehrung);
        } else {
          // update name
          //if($name!="")
          //  $this->app->DB->Update("UPDATE artikel SET name_de='$name' WHERE id='$artikel' LIMIT 1");
        }

        //$waehrung = 'EUR';
        $datum ="";

        //$vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM ".$typ."_position WHERE $typ='$id' LIMIT 1");
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO ".$typ."_position (id,$typ,artikel,bezeichnung,beschreibung,nummer,menge,preis, waehrung, 
          sort,lieferdatum, umsatzsteuer, status,projekt,vpe,rabatt,grundrabatt,rabattsync) 
            VALUES ('','$id','$artikel','$name','$beschreibung','$artikelnummer','$menge',
              '$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe','$rabatt','$rabatt',1)");
        $insid = $this->app->DB->GetInsertID();
        if($typ == 'auftrag' && is_array($data) && isset($data['parentap']))
        {
          $this->app->DB->Update("UPDATE auftrag_position set explodiert_parent = '".$data['parentap']."' where id = '$insid'");
          $this->app->DB->Update("UPDATE auftrag_position set explodiert = 1 where id = '".$data['parentap']."'");
        }
        return $insid;
      }


      function AddPositionManuellPreis($typ,$id, $artikel,$menge,$name,$preis,$umsatzsteuer,$rabatt=0,$waehrung='EUR')
      {

        // wenn es Artikel nicht gibt anlegen! bzw. immer updaten wenn name anders ist

        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1"); 

        //$vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM ".$typ."_position WHERE $typ='$id' LIMIT 1");
        $sort = $sort + 1;

        $mlmpunkte = $this->app->DB->Select("SELECT mlmpunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmbonuspunkte = $this->app->DB->Select("SELECT mlmbonuspunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmdirektpraemie = $this->app->DB->Select("SELECT mlmdirektpraemie FROM artikel WHERE id='$artikel' LIMIT 1");


        if($typ=="auftrag" || $typ=="angebot" || $typ=="rechnung")
        {
          $this->app->DB->Insert("INSERT INTO ".$typ."_position (id,$typ,artikel,bezeichnung,
            beschreibung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe,rabatt,punkte,bonuspunkte,mlmdirektpraemie) 
              VALUES ('','$id','$artikel','$name','$beschreibung','$bestellnummer','$menge',
                '$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe','$rabatt','$mlmpunkte','$mlmbonuspunkte','$mlmdirektpraemie')");
        } else {
          $this->app->DB->Insert("INSERT INTO ".$typ."_position (id,$typ,artikel,bezeichnung,
            beschreibung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe,rabatt) 
              VALUES ('','$id','$artikel','$name','$beschreibung','$bestellnummer','$menge','$preis',
                '$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe','$rabatt')");
        }
        return $this->app->DB->GetInsertID();
      }


      function AddPositionManuell($typ,$id, $artikel,$menge,$name,$beschreibung,$waehrung='EUR')
      {
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $projekt = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$artikel' LIMIT 1"); 

        $adresse = $this->app->DB->Select("SELECT adresse FROM $typ WHERE id='$id' LIMIT 1"); 

        if($menge<1)
          $preis = $this->GetVerkaufspreis($artikel,1,$adresse,$waehrung);
        else
          $preis = $this->GetVerkaufspreis($artikel,$menge,$adresse,$waehrung);

        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id='$artikel' LIMIT 1");
        //$vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM ".$typ."_position WHERE $typ='$id' LIMIT 1");
        $sort = $sort + 1;

        $mlmpunkte = $this->app->DB->Select("SELECT mlmpunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmbonuspunkte = $this->app->DB->Select("SELECT mlmbonuspunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmdirektpraemie = $this->app->DB->Select("SELECT mlmdirektpraemie FROM artikel WHERE id='$artikel' LIMIT 1");


        if($typ=="auftrag" || $typ=="angebot" || $typ=="rechnung")
        {
          $this->app->DB->Insert("INSERT INTO ".$typ."_position (id,$typ,artikel,bezeichnung,
            beschreibung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe,punkte,bonuspunkte,mlmdirektpraemie) 
              VALUES ('','$id','$artikel','$name','$beschreibung','$bestellnummer','$menge','$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt',
                '$vpe','$mlmpunkte','$mlmbonuspunkte','$mlmdirektpraemie')");
        } else {
          $this->app->DB->Insert("INSERT INTO ".$typ."_position (id,$typ,artikel,bezeichnung,
            beschreibung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
              VALUES ('','$id','$artikel','$name','$beschreibung','$bestellnummer','$menge','$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe')");
        }
        return $this->app->DB->GetInsertID();
      }



      function AddAuftragPosition($auftrag, $verkauf,$menge,$datum)
      {
        $artikel = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $bezeichnunglieferant = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $preis = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $projekt = $this->app->DB->Select("SELECT projekt FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        //$waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id='$artikel' LIMIT 1");
        //$vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM auftrag_position WHERE auftrag='$auftrag' LIMIT 1");
        $sort = $sort + 1;

        $mlmpunkte = $this->app->DB->Select("SELECT mlmpunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmbonuspunkte = $this->app->DB->Select("SELECT mlmbonuspunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmdirektpraemie = $this->app->DB->Select("SELECT mlmdirektpraemie FROM artikel WHERE id='$artikel' LIMIT 1");

        $this->app->DB->Insert("INSERT INTO auftrag_position (id,auftrag,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, 
          status,projekt,vpe,punkte,bonuspunkte,mlmdirektpraemie) 
            VALUES ('','$auftrag','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe',
              '$mlmpunkte','$mlmbonuspunkte','$mlmdirektpraemie')");
      }


      function DeleteAuftrag($id)
      {
        $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
        if($belegnr=="" || $belegnr=="0")
        {
          $this->app->DB->Delete("DELETE FROM auftrag_position WHERE auftrag='$id'");
          $this->app->DB->Delete("DELETE FROM auftrag_protokoll WHERE auftrag='$id'");
          $this->app->DB->Delete("DELETE FROM auftrag WHERE id='$id' LIMIT 1");
          $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE objekt='auftrag' AND parameter='$id'");
        }
      }


      function CreateAngebot($adresse="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM angebot WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;

        if($adresse>0)
          $tmp_projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");

        if($tmp_projekt <= 0)
          $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
        else
          $projekt = $tmp_projekt;

        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        {
          $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        }


        $ohnebriefpapier = $this->Firmendaten("angebot_ohnebriefpapier");
        $belegmax = "";

        $angebotersatz_standard = $this->Firmendaten("angebotersatz_standard");
        if($this->StandardZahlungsweise($projekt)=="rechnung")
        {
        $this->app->DB->Insert("INSERT INTO angebot (id,datum,gueltigbis,bearbeiter,vertrieb,firma,belegnr,autoversand,zahlungsweise,
          zahlungszieltage,
          zahlungszieltageskonto,
          zahlungszielskonto,
          status,projekt,adresse,ohne_briefpapier,abweichendebezeichnung ) 
            VALUES ('',NOW(), DATE_ADD(curdate(), INTERVAL 28 DAY),'','','".$this->app->User->GetFirma()."','$belegmax',1,'".$this->StandardZahlungsweise($projekt)."',
              '".$this->ZahlungsZielTage($projekt)."',
              '".$this->ZahlungsZielTageSkonto($projekt)."',
              '".$this->ZahlungsZielSkonto($projekt)."',
              'angelegt','$projekt','$adresse','".$ohnebriefpapier."','$angebotersatz_standard')");

        } else {
          $this->app->DB->Insert("INSERT INTO angebot (id,datum,gueltigbis,bearbeiter,vertrieb,firma,belegnr,autoversand,zahlungsweise,
          zahlungszieltage,
          zahlungszieltageskonto,
          zahlungszielskonto,
          status,projekt,adresse,ohne_briefpapier,abweichendebezeichnung ) 
            VALUES ('',NOW(), DATE_ADD(curdate(), INTERVAL 28 DAY),'','','".$this->app->User->GetFirma()."','$belegmax',1,'".$this->StandardZahlungsweise($projekt)."',
              '0',
              '0',
              '0',
              'angelegt','$projekt','$adresse','".$ohnebriefpapier."','$angebotersatz_standard')");
        }

        $id = $this->app->DB->GetInsertID();

        $this->CheckVertrieb($id,"angebot");
        $this->CheckBearbeiter($id,"angebot");

        $this->LoadSteuersaetzeWaehrung($id,"angebot",$projekt);
        return $id;
      }


      function AddAdressePosition($adresse, $verkauf,$menge,$startdatum, $wiederholend = 1, $zahlzyklus = 1)
      {
        $adresse = (int)$adresse;
        $verkauf = (int)$verkauf;
        $menge = (float)$menge;
        $lieferdatum = $this->app->String->Convert($startdatum,"%1.%2.%3","%3-%2-%1");

        $artikel = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $bezeichnung= $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $preis = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $projekt = $this->app->DB->Select("SELECT projekt FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer  FROM artikel WHERE id='$artikel' LIMIT 1");
        $vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        //$sort = $this->app->DB->Select("SELECT MAX(sort) FROM angebot_position WHERE angebot='$angebot' LIMIT 1");
        $sort = (int)$this->app->DB->Select("SELECT MAX(sort) FROM abrechnungsartikel where adresse = ".$adresse);
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO abrechnungsartikel (id,artikel,bezeichnung,nummer,menge,preis, sort,
          lieferdatum, steuerklasse, status,projekt,wiederholend,zahlzyklus,adresse,startdatum) 
            VALUES ('','$artikel','$bezeichnung','$bestellnummer','$menge','$preis','$sort','$lieferdatum',
              '$umsatzsteuer','angelegt','$projekt','$wiederholend','$zahlzyklus','$adresse','$startdatum')");

        return $this->app->DB->GetInsertID();
      }


      function AddAngebotPosition($angebot, $verkauf,$menge,$datum)
      {
        $artikel = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $bezeichnunglieferant = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $beschreibung = $this->app->DB->Select("SELECT anabregs_text FROM artikel WHERE id='$artikel' LIMIT 1"); 
        $preis = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $projekt = $this->app->DB->Select("SELECT projekt FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer  FROM artikel WHERE id='$artikel' LIMIT 1");
        $vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM angebot_position WHERE angebot='$angebot' LIMIT 1");
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO angebot_position (id,angebot,artikel,beschreibung,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
            VALUES ('','$angebot','$artikel','$beschreibung','$bezeichnunglieferant','$bestellnummer','$menge','$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe')");
      }



      function CopyBestellung($id)
      {
        // kopiere eintraege aus auftrag_position
        $this->app->DB->Insert("INSERT INTO bestellung (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,freitext,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,versandart,einkaeufer,zahlungsweise,zahlungszieltage,'angelegt' as status,typ,
            zahlungszieltageskonto,zahlungszielskonto,firma,'angelegt' as status,abweichendelieferadresse,liefername,lieferabteilung,lieferunterabteilung,ust_befreit,
            lieferland,lieferstrasse,lieferort,lieferplz,lieferadresszusatz,lieferansprechpartner FROM bestellung WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("bestellung",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM bestellung_position WHERE bestellung='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO bestellung_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][bestellung]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("bestellung_position",$newposid,$pos[$i]);

          // vorraussichtliches lieferdatum anpassen TODO
        }
        $this->app->DB->Update("UPDATE bestellung_position SET geliefert=0, mengemanuellgeliefertaktiviert=0,abgeschlossen='0',abgerechnet='0' WHERE bestellung='$newid'");
        $this->LoadSteuersaetzeWaehrung($newid,"bestellung");
        return $newid;
      }


      function CopyAuftrag($id)
      {
        // kopiere eintraege aus auftrag_position
        $this->app->DB->Insert("INSERT INTO auftrag (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,freitext,adresse,name,shopextid,
            abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,ihrebestellnummer,typ,
            versandart,vertrieb,zahlungsweise,zahlungszieltage,lieferdatum,'angelegt' as status,rabatt,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,gruppe,vertriebid,provision,provision_summe,
            zahlungszieltageskonto,zahlungszielskonto,firma,'angelegt' as status,abweichendelieferadresse,liefername,lieferabteilung,lieferunterabteilung,ust_befreit,angebotid,
            lieferland,lieferstrasse,lieferort,lieferplz,lieferadresszusatz,lieferansprechpartner,autoversand FROM auftrag WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("auftrag",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$id' AND explodiert_parent='0'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO auftrag_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][auftrag]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("auftrag_position",$newposid,$pos[$i]);


          // vorraussichtliches lieferdatum anpassen TODO
        }
        $this->app->DB->Update("UPDATE auftrag_position SET geliefert=0, geliefert_menge=0,explodiert='0',explodiert_parent='0' WHERE auftrag='$newid'");
        $this->LoadSteuersaetzeWaehrung($newid,"auftrag");
        return $newid;
      }



      function CopyGutschrift($id)
      {

        // kopiere eintraege aus gutschrift_position
        $this->app->DB->Insert("INSERT INTO gutschrift (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,rechnung,rechnungid,freitext,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer, bearbeiter,zahlungszieltage,zahlungszieltageskonto,zahlungsweise,ohne_briefpapier,'angelegt' as status,typ,
            zahlungszielskonto,ust_befreit,rabatt,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,gruppe,vertriebid,provision,provision_summe,
            firma FROM gutschrift WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("gutschrift",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM gutschrift_position WHERE gutschrift='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO gutschrift_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][gutschrift]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("gutschrift_position",$newposid,$pos[$i]);

          // vorraussichtliches lieferdatum anpassen TODO
        }
        $this->LoadSteuersaetzeWaehrung($newid,"gutschrift");
        return $newid;
      }





      function CopyRechnung($id)
      {

        // kopiere eintraege aus rechnung_position
        $this->app->DB->Insert("INSERT INTO rechnung (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,auftrag,auftragid,freitext,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,versandart,bearbeiter,zahlungszieltage,zahlungszieltageskonto,zahlungsweise,ohne_briefpapier,'angelegt' as status,
            zahlungszielskonto,ust_befreit,rabatt,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,gruppe,vertriebid,provision,provision_summe,typ,
            firma FROM rechnung WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("rechnung",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM rechnung_position WHERE rechnung='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO rechnung_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][rechnung]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("rechnung_position",$newposid,$pos[$i]);

          // vorraussichtliches lieferdatum anpassen TODO
        }
        $this->LoadSteuersaetzeWaehrung($newid,"rechnung");
        return $newid;
      }



      function CopyAnfrage($id)
      {
        // kopiere eintraege aus lieferschein_position
        $this->app->DB->Insert("INSERT INTO anfrage (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,freitext,adresse,CONCAT(name,' (Kopie)') as name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,bearbeiter,'angelegt' as status,typ,
            firma FROM anfrage WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("anfrage",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM anfrage_position WHERE anfrage='$id'");

        for($i=0;$i<count($pos);$i++)
        {
          $this->app->DB->Insert("INSERT INTO anfrage_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][anfrage]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("anfrage_position",$newposid,$pos[$i]);
          // vorraussichtliches lieferdatum anpassen TODO
        }
        $this->LoadSteuersaetzeWaehrung($newid,"anfrage");
        return $newid;
      }


      function CopyInventur($id)
      {
        // kopiere eintraege aus lieferschein_position
        $this->app->DB->Insert("INSERT INTO inventur (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,freitext,adresse,CONCAT(name,' (Kopie)') as name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,bearbeiter,'angelegt' as status,
            firma FROM inventur WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("inventur",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM inventur_position WHERE inventur='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO inventur_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][inventur]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("inventur_position",$newposid,$pos[$i]);

          // vorraussichtliches lieferdatum anpassen TODO
        }

        return $newid;
      }


      function CopyReisekosten($id)
      {

        // kopiere eintraege aus lieferschein_position
        $this->app->DB->Insert("INSERT INTO reisekosten (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,reisekosten,reisekostenid,freitext,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,mitarbeiternummer,reisekostenart,bearbeiter,'angelegt' as status,
            firma FROM reisekosten WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("reisekosten",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM reisekosten_position WHERE reisekosten='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO reisekosten_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][arbeitsnachweis]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("reisekosten_position",$newposid,$pos[$i]);

          // vorraussichtliches lieferdatum anpassen TODO
        }
        $this->app->DB->Update("UPDATE reisekosten_position SET abgerechnet=0,exportiert=0,exportiert_am='0000-00-00' WHERE reisekosten='$id'");

        return $newid;
      }



      function CopyArbeitsnachweis($id)
      {

        // kopiere eintraege aus lieferschein_position
        $this->app->DB->Insert("INSERT INTO arbeitsnachweis (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,auftrag,auftragid,freitext,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,prefix,arbeitsnachweisart,bearbeiter,versandart,'angelegt' as status,
            firma FROM arbeitsnachweis WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("arbeitsnachweis",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM arbeitsnachweis_position WHERE arbeitsnachweis='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO arbeitsnachweis_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][arbeitsnachweis]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("arbeitsnachweis_position",$newposid,$pos[$i]);

          // vorraussichtliches lieferdatum anpassen TODO
        }
        $this->app->DB->Update("UPDATE arbeitsnachweis_position SET abgerechnet=0 WHERE arbeitsnachweis='$id'");

        return $newid;
      }


      function CopyLieferschein($id)
      {

        // kopiere eintraege aus lieferschein_position
        $this->app->DB->Insert("INSERT INTO lieferschein (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,auftrag,auftragid,freitext,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,versandart,bearbeiter,'angelegt' as status,typ,
            firma FROM lieferschein WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("lieferschein",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM lieferschein_position WHERE lieferschein='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO lieferschein_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][lieferschein]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("lieferschein_position",$newposid,$pos[$i]);
        }
        $this->app->DB->Update("UPDATE lieferschein_position SET geliefert=0, abgerechnet=0 WHERE lieferschein='$newid'");

        return $newid;
      }


      function CopyAngebot($id)
      {

        // kopiere eintraege aus angebot_position
        $this->app->DB->Insert("INSERT INTO angebot (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,anfrage,freitext,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,versandart,vertrieb,zahlungsweise,zahlungszieltage,ust_befreit,lieferdatum,gueltigbis,'angelegt' as status,rabatt,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,gruppe,vertriebid,provision,provision_summe,typ,
            zahlungszieltageskonto,zahlungszielskonto,firma FROM angebot WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("angebot",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM angebot_position WHERE angebot='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO angebot_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][angebot]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("angebot_position",$newposid,$pos[$i]);

          // vorraussichtliches lieferdatum anpassen TODO

        }
        //$this->app->DB->Update("UPDATE angebot_position SET geliefert=0 WHERE angebot='$newid'");

        $this->LoadSteuersaetzeWaehrung($newid,"angebot");
        return $newid;
      }





      function WeiterfuehrenAuftragZuLieferschein($id)
      {
        // pruefe ob auftrag status=angelegt, dann vergebe belegnr
        $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
        $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");
        $checkbelegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
        if($status=="angelegt" && $checkbelegnr=="")
        {
          $belegnr = $this->GetNextNummer("auftrag",$projekt);

          $this->app->DB->Update("UPDATE auftrag SET belegnr='$belegnr', status='freigegeben'  WHERE id='$id' LIMIT 1");
          $this->AuftragProtokoll($id,"Auftrag freigegeben");

          // auftrag abschliessen und event senden
        }

        //angebot aus offene Angebote entfernen 
        $this->app->DB->Insert("INSERT INTO lieferschein (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT datum,ihrebestellnummer,projekt,belegnr as auftrag,freitext,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,ansprechpartner,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,versandart,vertrieb,zahlungsweise,zahlungszieltage,anschreiben, id as auftragid,vertriebid, bearbeiter,internebemerkung,projektfiliale,typ,
            zahlungszieltageskonto,zahlungszielskonto,firma,'angelegt' as status FROM auftrag WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("lieferschein",$newid,$arr[0]);

        $this->app->DB->Update("UPDATE lieferschein SET datum=NOW() WHERE id='$newid' LIMIT 1");

        $abweichendelieferadresse = $this->app->DB->Select("SELECT abweichendelieferadresse FROM auftrag WHERE id='$id' LIMIT 1");
        $tmparrliefer = $this->app->DB->SelectArr("SELECT * FROM auftrag WHERE id='$id' LIMIT 1");
        $versandart = $this->app->DB->Select("SELECT versandart FROM auftrag WHERE id='$id' LIMIT 1");

        //lieferadresse wenn abweichend!!!!
        if($abweichendelieferadresse && $versandart!="packstation")
        {
          //liefername  lieferland  lieferstrasse   lieferort   lieferplz   lieferadresszusatz 
          $this->app->DB->Update("UPDATE lieferschein SET name='{$tmparrliefer[0][liefername]}', abteilung='{$tmparrliefer[0][lieferabteilung]}',
              unterabteilung='{$tmparrliefer[0][lieferunterabteilung]}',strasse='{$tmparrliefer[0][lieferstrasse]}', 
              adresszusatz='{$tmparrliefer[0][lieferadresszusatz]}', plz='{$tmparrliefer[0][lieferplz]}',ort='{$tmparrliefer[0][lieferort]}',land='{$tmparrliefer[0][lieferland]}',ansprechpartner='{$tmparrliefer[0][lieferansprechpartner]}' WHERE id='$newid' LIMIT 1");
        }

        //lieferadresse wenn packstation
        if($versandart=="packstation")
        {
          //packstation_inhaber   packstation_station         packstation_ident   packstation_plz   packstation_ort   
          $this->app->DB->Update("UPDATE lieferschein SET name='{$tmparrliefer[0][packstation_inhaber]}', unterabteilung='',strasse='Packstation Nr. {$tmparrliefer[0][packstation_station]}', adresszusatz='{$tmparrliefer[0][packstation_ident]}', 
              plz='{$tmparrliefer[0][packstation_plz]}',ort='{$tmparrliefer[0][packstation_ort]}' WHERE id='$newid' LIMIT 1");
        }


        $pos = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$id'");
        for($i=0;$i<count($pos);$i++){

          /* nur lager artikel in den Lieferschein */
          $portoartikel = $this->app->DB->Select("SELECT porto FROM artikel WHERE id='{$pos[$i][artikel]}' LIMIT 1");

          if($portoartikel==0)
          {
            $this->app->DB->Insert("INSERT INTO lieferschein_position (id) VALUES('')");
            $newposid = $this->app->DB->GetInsertID();
            $pos[$i][lieferschein]=$newid;
            $pos[$i][auftrag_position_id]=$pos[$i][id];
            if($pos[$i][explodiert]) $pos[$i][bezeichnung] = $pos[$i][bezeichnung]." (Stückliste)";
            if($pos[$i][explodiert_parent] > 0) {
              $pos[$i][bezeichnung] = "*** ".$pos[$i][bezeichnung];
              $pos[$i][explodiert_parent_artikel] = $this->app->DB->Select("SELECT artikel FROM auftrag_position WHERE id='".$pos[$i][explodiert_parent]."' LIMIT 1");
            }

            $this->app->FormHandler->ArrayUpdateDatabase("lieferschein_position",$newposid,$pos[$i]);
          }

        }
        $this->app->DB->Update("UPDATE auftrag SET status='abgeschlossen',schreibschutz='1' WHERE id='$id' LIMIT 1");

        // auftrag freigeben!!!

        return $newid;
      }

      function WeiterfuehrenRechnungZuGutschrift($id)
      {
        //angebot aus offene Angebote entfernen 
        $this->app->DB->Insert("INSERT INTO gutschrift (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,ihrebestellnummer,projekt, belegnr as rechnung,anschreiben,aktion,
            freitext,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,versandart,zahlungsweise,zahlungszieltage,ust_befreit, keinsteuersatz, id as rechnungid,rabatt,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,gruppe,vertriebid,provision,provision_summe,bearbeiter,projektfiliale,typ,
            zahlungszieltageskonto,zahlungszielskonto,firma,waehrung,steuersatz_normal,steuersatz_zwischen,steuersatz_ermaessigt,steuersatz_starkermaessigt,steuersatz_dienstleistung,'angelegt' as status FROM rechnung WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("gutschrift",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM rechnung_position WHERE rechnung='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO gutschrift_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][gutschrift]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("gutschrift_position",$newposid,$pos[$i]);
        }

        // wenn auftrag vorkasse rechnung als bezahlt markieren wenn genug geld vorhanden
        //   $this->GutschriftNeuberechnen($newid);

        /*
        //summe zahlungseingaenge
        $summe_zahlungseingaenge = $this->app->DB->Select("SELECT SUM(betrag) FROM kontoauszuege_zahlungseingang WHERE objekt='auftrag' AND parameter='$id' AND firma='".$this->app->User->GetFirma()."'");
        $rechnungssumme = $this->app->DB->Select("SELECT soll FROM rechnung WHERE id='$newid' LIMIT 1");

        //if(($arr[0][zahlungsweise]=="vorkasse" || $arr[0][zahlungsweise]=="paypal" || $arr[0][zahlungsweise]=="kreditkarte") &&  $summe_zahlungseingaenge >= $rechnungssumme)
        if($summe_zahlungseingaenge >= $rechnungssumme)
        {

        if($summe_zahlungseingaenge >= $rechnungssumme) 
        $this->app->DB->Update("UPDATE rechnung SET ist=soll, zahlungsstatus='bezahlt' WHERE id='$newid' AND firma='".$this->app->User->GetFirma()."'");
        else
        $this->app->DB->Update("UPDATE rechnung SET ist='$summe_zahlungseingaenge', zahlungsstatus='' WHERE id='$newid' AND firma='".$this->app->User->GetFirma()."'");
        }  // was ist denn bei rechnung bar oder nachnahme wenn ein auftragsguthaben vorhanden ist

        $this->app->DB->Update("UPDATE auftrag SET status='abgeschlossen' WHERE id='$id' LIMIT 1");

        // auftrag freigeben!!!
         */
        $this->app->DB->Update("UPDATE rechnung SET schreibschutz='1' WHERE id='$id' LIMIT 1");
        return $newid;
      }


      function WeiterfuehrenAuftragZuAnfrage($auftrag)
      {

        $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$auftrag' LIMIT 1");
        $anfrageid = $this->app->DB->Select("SELECT anfrageid FROM auftrag WHERE id='$auftrag' LIMIT 1");
        //angebot aus offene Angebote entfernen 

        $arr = $this->app->DB->SelectArr("SELECT projekt,aktion, 
            freitext,anschreiben,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,email,telefon,telefax,projektfiliale,typ,
            firma,'angelegt' as status FROM auftrag WHERE id='$auftrag' LIMIT 1");

        $this->app->FormHandler->ArrayUpdateDatabase("anfrage",$anfrageid,$arr[0]);

        $this->app->DB->Delete("DELETE FROM anfrage_position WHERE anfrage='$anfrageid'");

        $pos = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$auftrag'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO anfrage_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();

          $pos[$i][anfrage]=$anfrageid;

          // Hole Verkaufspeis ab menge
          $this->app->FormHandler->ArrayUpdateDatabase("anfrage_position",$newposid,$pos[$i]);
        }
        $this->app->DB->Update("UPDATE auftrag SET schreibschutz='1' WHERE id='$id' LIMIT 1");
        return $newid;
      }

      function WeiterfuehrenAnfrageZuAngebot($id)
      {

        $adresse = $this->app->DB->Select("SELECT adresse FROM anfrage WHERE id='$id' LIMIT 1");
        //angebot aus offene Angebote entfernen 
        $this->app->DB->Insert("INSERT INTO angebot (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum,projekt,aktion,
            freitext,anschreiben,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,projektfiliale,typ,
            versandart, id as anfrageid,
            firma,'angelegt' as status FROM anfrage WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("angebot",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM anfrage_position WHERE anfrage='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO angebot_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][angebot]=$newid;

          // Hole Verkaufspeis ab menge
          $pos[$i][preis]=$this->GetVerkaufspreis($pos[$i][artikel],$pos[$i][menge],$adresse);
          $this->app->FormHandler->ArrayUpdateDatabase("angebot_position",$newposid,$pos[$i]);
        }
        $this->app->DB->Update("UPDATE anfrage SET schreibschutz='1' WHERE id='$id' LIMIT 1");
        return $newid;
      }



      function WeiterfuehrenAuftragZuRechnung($id)
      {
        // wenn anfrage vorhanden diese markieren als abgerechnet status='abgerechnet'
        $anfrageid = $this->app->DB->Select("SELECT anfrageid FROM auftrag WHERE id='$id' LIMIT 1");
        $adresseid = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");
        $abweichende_rechnungsadresse = $this->app->DB->Select("SELECT abweichende_rechnungsadresse 
            FROM adresse WHERE id='$adresseid' LIMIT 1");
        if($anfrageid > 0)
          $this->app->DB->Update("UPDATE anfrage SET status='abgerechnet',schreibschutz='0' WHERE id='$anfrageid'");

        // pruefe ob auftrag status=angelegt, dann vergebe belegnr
        $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");
        $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
        $checkbelegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
        if($status=="angelegt" && $checkbelegnr=="")
        {
          $belegnr = $this->GetNextNummer("auftrag",$projekt);

          $this->app->DB->Update("UPDATE auftrag SET belegnr='$belegnr', status='freigegeben'  WHERE id='$id' LIMIT 1");
          $this->AuftragProtokoll($id,"Auftrag freigegeben");

          // auftrag abschliessen und event senden
        }


        //angebot aus offene Angebote entfernen 
        $this->app->DB->Insert("INSERT INTO rechnung (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();
        $arr = $this->app->DB->SelectArr("SELECT datum,ihrebestellnummer,projekt,gesamtsumme as soll, belegnr as auftrag, id as auftragid,aktion,typ,
            freitext,anschreiben,adresse,name,abteilung,unterabteilung,ansprechpartner,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,versandart,vertrieb,zahlungsweise,zahlungszieltage,ust_befreit,keinsteuersatz,rabatt,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,gruppe,vertriebid,provision,provision_summe,bearbeiter,internebemerkung,typ,
            projektfiliale,zahlungszieltageskonto,zahlungszielskonto,firma,einzugsdatum,waehrung,steuersatz_normal,steuersatz_zwischen,steuersatz_ermaessigt,steuersatz_starkermaessigt,steuersatz_dienstleistung,'angelegt' as status FROM auftrag WHERE id='$id' LIMIT 1");

        $arr_zahlung = $this->app->DB->SelectArr("SELECT zahlungsweise,zahlungszieltage,zahlungszieltageskonto,zahlungszielskonto,versandart FROM auftrag WHERE id='$id' LIMIT 1"); 



        $this->app->FormHandler->ArrayUpdateDatabase("rechnung",$newid,$arr[0]);


        $lieferscheinid = $this->app->DB->Select("SELECT id FROM lieferschein WHERE auftragid='$id' LIMIT 1");

        if($lieferscheinid>0)
          $this->app->DB->Update("UPDATE rechnung SET lieferschein='$lieferscheinid' WHERE id='$newid' LIMIT 1");

        $this->app->DB->Update("UPDATE rechnung SET datum=NOW() WHERE id='$newid' LIMIT 1");

        $pos = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO rechnung_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][rechnung]=$newid;
          $pos[$i][auftrag_position_id]=$pos[$i][id];


          if($pos[$i][explodiert]) $pos[$i][bezeichnung] = $pos[$i][bezeichnung]." (Stückliste)";
          if($pos[$i][explodiert_parent] > 0) {
            $pos[$i][bezeichnung] = "*** ".$pos[$i][bezeichnung];
            if($pos[$i][explodiert_parent] > 0)
              $pos[$i][explodiert_parent_artikel] = $this->app->DB->Select("SELECT artikel FROM auftrag_position WHERE id='".$pos[$i][explodiert_parent]."'  LIMIT 1");
            else $pos[$i][explodiert_parent_artikel] = 0;

            //if($pos[$i][explodiert_parent_artikel] > 0) 
            //{ echo "huhuh ".$this->app->DB->Select("SELECT artikel FROM auftrag_position WHERE id='".$pos[$i][explodiert_parent]."'  LIMIT 1"); exit; }
          }

          $this->app->FormHandler->ArrayUpdateDatabase("rechnung_position",$newposid,$pos[$i]);
        }

        // wenn adresse abweichende rechnungsadresse hat diese nehmen!
        if($abweichende_rechnungsadresse=="1")
        {
          $this->LoadRechnungStandardwerte($newid,$adresseid);
          $this->app->FormHandler->ArrayUpdateDatabase("rechnung",$newid,$arr_zahlung[0]);
        }


        // wenn auftrag vorkasse rechnung als bezahlt markieren wenn genug geld vorhanden
        $this->RechnungNeuberechnen($newid);
        //summe zahlungseingaenge
        $summe_zahlungseingaenge = 0;
        $rechnungssumme = $this->app->DB->Select("SELECT soll FROM rechnung WHERE id='$newid' LIMIT 1");

        //if(($arr[0][zahlungsweise]=="vorkasse" || $arr[0][zahlungsweise]=="paypal" || $arr[0][zahlungsweise]=="kreditkarte") &&  $summe_zahlungseingaenge >= $rechnungssumme)
        if($summe_zahlungseingaenge >= $rechnungssumme)
        {

          if($summe_zahlungseingaenge >= $rechnungssumme) 
            $this->app->DB->Update("UPDATE rechnung SET ist=soll, zahlungsstatus='bezahlt' WHERE id='$newid' ");
          else
            $this->app->DB->Update("UPDATE rechnung SET ist='$summe_zahlungseingaenge', zahlungsstatus='' WHERE id='$newid' ");
        }  // was ist denn bei rechnung bar oder nachnahme wenn ein auftragsguthaben vorhanden ist

        $this->app->DB->Update("UPDATE auftrag SET status='abgeschlossen',schreibschutz='1' WHERE id='$id' LIMIT 1");

        // auftrag freigeben!!!

        return $newid;
      }

      function WeiterfuehrenAngebotZuAuftrag($id)
      {
        $anfrageid = $this->app->DB->Select("SELECT anfrageid FROM angebot WHERE id='$id' LIMIT 1");
        if($anfrageid > 0)
          $this->app->DB->Update("UPDATE anfrage SET status='beauftrag',schreibschutz='0' WHERE id='$anfrageid' AND status!='abgeschlossen' AND status!='abgerechnet'");

        //angebot aus offene Angebote entfernen 
        $this->app->DB->Insert("INSERT INTO auftrag (id) VALUES ('')");
        $newid = $this->app->DB->GetInsertID();

        $arr = $this->app->DB->SelectArr("SELECT NOW() as datum, projekt,belegnr as angebot,lieferdatum,aktion,
            freitext,anschreiben,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,versandart,vertrieb,
            zahlungsweise, zahlungszieltage, id as angebotid, anfrage as ihrebestellnummer, anfrageid,rabatt,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,gruppe,vertriebid,provision,provision_summe,bearbeiter,projektfiliale,typ,
            zahlungszieltageskonto,zahlungszielskonto,firma,abweichendelieferadresse,liefername,lieferabteilung,lieferunterabteilung,lieferland,lieferstrasse,lieferort,ust_befreit,
            lieferplz,lieferadresszusatz,lieferansprechpartner,ust_befreit,keinsteuersatz,autoversand,keinporto,'angelegt' as status,waehrung,steuersatz_normal,steuersatz_zwischen,steuersatz_ermaessigt,steuersatz_starkermaessigt,steuersatz_dienstleistung FROM angebot WHERE id='$id' LIMIT 1");
        $this->app->FormHandler->ArrayUpdateDatabase("auftrag",$newid,$arr[0]);

        $pos = $this->app->DB->SelectArr("SELECT * FROM angebot_position WHERE angebot='$id'");
        for($i=0;$i<count($pos);$i++){
          $this->app->DB->Insert("INSERT INTO auftrag_position (id) VALUES('')");
          $newposid = $this->app->DB->GetInsertID();
          $pos[$i][auftrag]=$newid;
          $this->app->FormHandler->ArrayUpdateDatabase("auftrag_position",$newposid,$pos[$i]);
        }

        $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$newid' LIMIT 1");
        $this->app->DB->Update("UPDATE angebot SET status='beauftragt', schreibschutz='1', auftrag='$belegnr' WHERE id='$id' LIMIT 1");

        // auftrag freigeben!!!

        return $newid;
      }

      function DeleteAngebot($id)
      {
        $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
        if($belegnr=="" || $belegnr=="0")
        {
          $this->app->DB->Delete("DELETE FROM angebot_position WHERE angebot='$id'");
          $this->app->DB->Delete("DELETE FROM angebot_protokoll WHERE angebot='$id'");
          $this->app->DB->Delete("DELETE FROM angebot WHERE id='$id' LIMIT 1");
        }
      }


      function PaketannahmenAbschliessen()
      {
        $arr = $this->app->DB->SelectArr("SELECT id FROM paketannahme WHERE status!='abgeschlossen'"); 
        for($i=0;$i<count($arr);$i++)
        {


        }
      }

      function CreateBestellung($adresse="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM bestellung WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;

        if($adresse>0)
          $tmp_projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");

        if($tmp_projekt <= 0)
          $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
        else
          $projekt = $tmp_projekt;

        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        {
          $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        }

        $belegmax = "";
        $ohnebriefpapier = $this->Firmendaten("bestellung_ohnebriefpapier");
        $bestellungohnepreis = $this->Firmendaten("bestellungohnepreis");

        $this->app->DB->Insert("INSERT INTO bestellung (id,datum,bearbeiter,firma,belegnr,adresse,status,artikelnummerninfotext,ohne_briefpapier,bestellungohnepreis,projekt) 
            VALUES ('',NOW(),'".$this->app->User->GetName()."','".$this->app->User->GetFirma()."','$belegmax','$adresse','angelegt',1,'".$ohnebriefpapier."','".$bestellungohnepreis."','".$projekt."')");
        $id = $this->app->DB->GetInsertID();
        $this->LoadSteuersaetzeWaehrung($id,"bestellung");
        return $id;
      }

      function AddBestellungPosition($bestellung, $einkauf,$menge,$datum, $beschreibung = '')
      {
        $beschreibung = $this->app->DB->real_escape_string($beschreibung);
        $artikel = $this->app->DB->Select("SELECT artikel FROM einkaufspreise WHERE id='$einkauf' LIMIT 1"); 
        $bezeichnunglieferant = $this->app->DB->real_escape_string($this->app->DB->Select("SELECT bezeichnunglieferant FROM einkaufspreise WHERE id='$einkauf' LIMIT 1")); 
        $bestellnummer = $this->app->DB->real_escape_string($this->app->DB->Select("SELECT bestellnummer FROM einkaufspreise WHERE id='$einkauf' LIMIT 1")); 
        $preis = $this->app->DB->Select("SELECT preis FROM einkaufspreise WHERE id='$einkauf' LIMIT 1"); 
        $projekt = $this->app->DB->Select("SELECT projekt FROM einkaufspreise WHERE id='$einkauf' LIMIT 1"); 
        $waehrung = $this->app->DB->Select("SELECT waehrung FROM einkaufspreise WHERE id='$einkauf' LIMIT 1"); 
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id='$artikel' LIMIT 1");
        if($umsatzsteuer=="") $umsatzsteuer="normal";
        $vpe = $this->app->DB->Select("SELECT vpe FROM einkaufspreise WHERE id='$einkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM bestellung_position WHERE bestellung='$bestellung' LIMIT 1");
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO bestellung_position (id,bestellung,artikel,bezeichnunglieferant,bestellnummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe, beschreibung) 
            VALUES ('','$bestellung','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe','$beschreibung')");
      }


      function DeleteBestellung($id)
      {
        $belegnr = $this->app->DB->Select("SELECT belegnr FROM bestellung WHERE id='$id' LIMIT 1");
        if($belegnr=="" || $belegnr=="0")
        {
          $this->app->DB->Delete("DELETE FROM bestellung_position WHERE bestellung='$id'");
          $this->app->DB->Delete("DELETE FROM bestellung_protokoll WHERE bestellung='$id'");
          $this->app->DB->Delete("DELETE FROM bestellung WHERE id='$id' LIMIT 1");
        }
      }


      function CreateRechnung($adresse="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM bestellung WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;

        if($adresse>0)
          $tmp_projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");

        if($tmp_projekt <= 0)
          $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
        else
          $projekt = $tmp_projekt;

        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        {
          $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        }

        $belegmax = "";
        $ohnebriefpapier = $this->Firmendaten("rechnung_ohnebriefpapier");

      if($this->StandardZahlungsweise($projekt)=="rechnung")
      {
        $this->app->DB->Insert("INSERT INTO rechnung (id,datum,bearbeiter,firma,belegnr,zahlungsweise,
          zahlungszieltage,
          zahlungszieltageskonto,
          zahlungszielskonto,
          lieferdatum,
          status,projekt,adresse,auftragid,ohne_briefpapier) 
            VALUES ('',NOW(),'','".$this->app->User->GetFirma()."','$belegmax','".$this->StandardZahlungsweise($projekt)."',
              '".$this->ZahlungsZielTage($projekt)."',
              '".$this->ZahlungsZielTageSkonto($projekt)."',
              '".$this->ZahlungsZielSkonto($projekt)."',NOW(),
              'angelegt','$projekt','$adresse',0,'".$ohnebriefpapier."')");
        } else {
        $this->app->DB->Insert("INSERT INTO rechnung (id,datum,bearbeiter,firma,belegnr,zahlungsweise,
          zahlungszieltage,
          zahlungszieltageskonto,
          zahlungszielskonto,
          lieferdatum,
          status,projekt,adresse,auftragid,ohne_briefpapier)
            VALUES ('',NOW(),'','".$this->app->User->GetFirma()."','$belegmax','".$this->StandardZahlungsweise($projekt)."',
              '0',
              '0',
              '0',NOW(),
              'angelegt','$projekt','$adresse',0,'".$ohnebriefpapier."')");
        }

        $id = $this->app->DB->GetInsertID();
        $this->CheckVertrieb($id,"rechnung");
        $this->CheckBearbeiter($id,"rechnung");

        $this->LoadSteuersaetzeWaehrung($id,"rechnung",$projekt);
        return $id;
      }


      function GetStandardWaehrung($projekt=0)
      {
        if($projekt  > 0)
          $projekt_arr = $this->app->DB->SelectArr("SELECT * FROM projekt WHERE id='$projekt' LIMIT 1");

        if($projekt_arr[0]['eigenesteuer']=="1")
        {
          $waehrung = $projekt_arr[0]['waehrung'];
        } else {
          $waehrung = $this->Firmendaten("waehrung");
        }
        return $waehrung;
      }

      function GetStandardSteuersatzErmaessigt($projekt=0)
      {
        if($projekt > 0)
          $projekt_arr = $this->app->DB->SelectArr("SELECT * FROM projekt WHERE id='$projekt' LIMIT 1");

        if($projekt_arr[0]['eigenesteuer']=="1")
        {
          $steuersatz_ermaessigt = $projekt_arr[0]['steuersatz_ermaessigt'];
        } else {
          $steuersatz_ermaessigt = $this->Firmendaten("steuersatz_ermaessigt");
        }
        return $steuersatz_ermaessigt;
      }

      function GetStandardSteuersatzNormal($projekt=0)
      {
        if($projekt  >0)
          $projekt_arr = $this->app->DB->SelectArr("SELECT * FROM projekt WHERE id='$projekt' LIMIT 1");

        if($projekt_arr[0]['eigenesteuer']=="1")
        {
          $steuersatz_normal = $projekt_arr[0]['steuersatz_normal'];
          $steuersatz_ermaessigt = $projekt_arr[0]['steuersatz_ermaessigt'];
        } else {
          $steuersatz_normal = $this->Firmendaten("steuersatz_normal");
          $steuersatz_ermaessigt = $this->Firmendaten("steuersatz_ermaessigt");
        }
        return $steuersatz_normal;
      }

      function GetStandardSteuersatzBefreit($projekt=0)
      {
        return 0.00;
      }


      function LoadSteuersaetzeWaehrung($id,$typ,$projekt="")
      {

        if($projekt <=0)
          $projekt = $this->app->DB->Select("SELECT projekt FROM $typ WHERE id='$id' LIMIT 1");


        $projekt_arr = $this->app->DB->SelectArr("SELECT * FROM projekt WHERE id='$projekt' LIMIT 1");

        if($projekt_arr[0]['eigenesteuer']=="1")
        {
          $steuersatz_normal = $projekt_arr[0]['steuersatz_normal'];
          $steuersatz_ermaessigt = $projekt_arr[0]['steuersatz_ermaessigt'];
          $waehrung = $projekt_arr[0]['waehrung'];
        } else {
          $steuersatz_normal = $this->Firmendaten("steuersatz_normal");
          $steuersatz_ermaessigt = $this->Firmendaten("steuersatz_ermaessigt");
          $waehrung = $this->Firmendaten("waehrung");
        }

        if($waehrung=="") $waehrung="EUR";

        $this->app->DB->Update("UPDATE $typ SET waehrung='$waehrung',
            steuersatz_normal='$steuersatz_normal',steuersatz_ermaessigt='$steuersatz_ermaessigt' WHERE id='$id' LIMIT 1");
      }


      function CreateGutschrift($adresse="")
      {
        //$belegmax = $this->app->DB->Select("SELECT MAX(belegnr) FROM bestellung WHERE firma='".$this->app->User->GetFirma()."'");
        //if($belegmax==0) $belegmax = 10000;  else $belegmax++;
        if($adresse>0)
          $tmp_projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$adresse' LIMIT 1");

        if($tmp_projekt <= 0)
          $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");
        else
          $projekt = $tmp_projekt;

        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        {
          $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        }


        $belegmax = "";
        $ohnebriefpapier = $this->Firmendaten("gutschrift_ohnebriefpapier");
        $stornorechnung = $this->Firmendaten("stornorechnung_standard");

        if($this->StandardZahlungsweise($projekt)=="rechnung")
        {
        $this->app->DB->Insert("INSERT INTO gutschrift (id,datum,bearbeiter,firma,belegnr,zahlungsweise,zahlungszieltage,status,projekt,adresse,ohne_briefpapier,stornorechnung) 
            VALUES ('',NOW(),'".$this->app->User->GetName()."','".$this->app->User->GetFirma()."','$belegmax','".$this->StandardZahlungsweise($projekt)."','".$this->ZahlungsZielTage($projekt)."','angelegt','$projekt','$adresse','".$ohnebriefpapier."','$stornorechnung')");
        } else {
    $this->app->DB->Insert("INSERT INTO gutschrift (id,datum,bearbeiter,firma,belegnr,zahlungsweise,zahlungszieltage,status,projekt,adresse,ohne_briefpapier,stornorechnung)
            VALUES ('',NOW(),'".$this->app->User->GetName()."','".$this->app->User->GetFirma()."','$belegmax','".$this->StandardZahlungsweise($projekt)."','0','angelegt','$projekt','$adresse','".$ohnebriefpapier."','$stornorechnung')");
        }
        $id = $this->app->DB->GetInsertID();
        $this->CheckVertrieb($id,"gutschrift");
        $this->CheckBearbeiter($id,"gutschrift");


        $this->LoadSteuersaetzeWaehrung($id,"gutschrift");
        return $id;
      }


      function AddGutschritPosition($gutschrift, $verkauf,$menge,$datum)
      {
        $artikel = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$verkauf' LIMIT 1");
        $bezeichnunglieferant = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1");
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1");
        $preis = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE id='$verkauf' LIMIT 1");
        $projekt = $this->app->DB->Select("SELECT projekt FROM verkaufspreise WHERE id='$verkauf' LIMIT 1");
        $waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer  FROM artikel WHERE id='$artikel' LIMIT 1");
        $vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM gutschrift_position WHERE rechnung='$gutschrift' LIMIT 1");
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO gutschrift_position (id,gutschrift,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
            VALUES ('','$gutschrift','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe')");
      }


      function AddAuftragPositionManuell($auftrag, $artikel,$preis, $menge,$bezeichnung,$beschreibung="")
      {
        $bezeichnunglieferant = $bezeichnung;
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1");
        $projekt = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$artikel' LIMIT 1");
        //$waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $waehrung='EUR';
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer  FROM artikel WHERE id='$artikel' LIMIT 1");

        $mlmpunkte = $this->app->DB->Select("SELECT mlmpunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmbonuspunkte = $this->app->DB->Select("SELECT mlmbonuspunkte FROM artikel WHERE id='$artikel' LIMIT 1");
        $mlmdirektpraemie = $this->app->DB->Select("SELECT mlmdirektpraemie FROM artikel WHERE id='$artikel' LIMIT 1");


        //$vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM auftrag_position WHERE auftrag='$auftrag' LIMIT 1");
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO auftrag_position (id,auftrag,artikel,bezeichnung,nummer,menge,preis, waehrung, sort, umsatzsteuer, status,projekt,vpe,beschreibung,punkte,bonuspunkte,mlmdirektpraemie) 
            VALUES ('','$auftrag','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$preis','$waehrung','$sort','$umsatzsteuer','angelegt','$projekt','$vpe','$beschreibung','$mlmpunkte','$mlmbonuspunkte','$mlmdirektpraemie')");
      }


      function AddRechnungPositionManuell($rechnung, $artikel,$preis, $menge,$bezeichnung,$beschreibung="")
      {
        $bezeichnunglieferant = $bezeichnung;
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1");
        $projekt = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$artikel' LIMIT 1");
        //$waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $waehrung='EUR';
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer  FROM artikel WHERE id='$artikel' LIMIT 1");
        //$vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM rechnung_position WHERE rechnung='$rechnung' LIMIT 1");
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO rechnung_position (id,rechnung,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe,beschreibung) 
            VALUES ('','$rechnung','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe','$beschreibung')");
      }



      function AddRechnungPosition($rechnung, $verkauf,$menge,$datum)
      {
        $artikel = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$verkauf' LIMIT 1");
        $bezeichnunglieferant = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1");
        $bestellnummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1");
        $preis = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE id='$verkauf' LIMIT 1");
        $projekt = $this->app->DB->Select("SELECT projekt FROM verkaufspreise WHERE id='$verkauf' LIMIT 1");
        $waehrung = $this->app->DB->Select("SELECT waehrung FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $umsatzsteuer = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id='$artikel' LIMIT 1");
        $vpe = $this->app->DB->Select("SELECT vpe FROM verkaufspreise WHERE id='$verkauf' LIMIT 1"); 
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM rechnung_position WHERE rechnung='$rechnung' LIMIT 1");
        $sort = $sort + 1;
        $this->app->DB->Insert("INSERT INTO rechnung_position (id,rechnung,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
            VALUES ('','$rechnung','$artikel','$bezeichnunglieferant','$bestellnummer','$menge','$preis','$waehrung','$sort','$datum','$umsatzsteuer','angelegt','$projekt','$vpe')");
      }

      // Produktion und Auftrag reservieren
      function AuftragReservieren($id,$typ="auftrag")
      {
        if($typ=="auftrag" && $id > 0)
          $id_check = $this->app->DB->Select("SELECT id FROM auftrag WHERE status='freigegeben' AND id='$id' LIMIT 1");
        if($typ=="produktion"){
        }

        // nicht reservieren wenn auftrag nicht offen ist
        if($id_check!=$id)
          return 0;


        if($typ=="auftrag")
        {
          $artikelarr= $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$id' AND geliefert!=1");
          $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE parameter='$id' AND objekt='auftrag'");  
          $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");
          $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
          $belegnr= $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
        }
        
        
        //schaue artikel fuer artikel an wieviel geliefert wurde und ob bereits reservierungen vorliegen, wenn welche vorliegen auch reservieren auf 9999-01-01
        // Lager Check
        //echo "{$auftraege[0][internet]} Adresse:$adresse Auftrag $auftrag";
        for($k=0;$k<count($artikelarr); $k++)
        { 
          $menge = $artikelarr[$k]['menge'] - $artikelarr[$k]['gelieferte_menge'];
          $artikel = $artikelarr[$k]['artikel'];
          // pruefe artikel 12 menge 4
          $lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='{$artikelarr[$k]['artikel']}' LIMIT 1");
          $stueckliste = $this->app->DB->Select("SELECT stueckliste FROM artikel WHERE id='{$artikelarr[$k]['artikel']}' LIMIT 1");
          //if($artikelarr[$k][nummer]!="200000" && $artikelarr[$k][nummer]!="200001")
          if($lagerartikel>=1)
          {

            if($typ=="auftrag")
            {   
              $anzahl_reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert 
                  WHERE artikel='".$artikel."' AND objekt='auftrag' AND parameter='$id'");
            }

            // menge = notwendige menge - bereits reserviert        
            $zu_reservieren = $menge;// - $anzahl_reserviert;  

            if($zu_reservieren>0)
            {
              if($typ=="auftrag"){

                //if($this->LagerFreieMenge($artikel) <  $zu_reservieren) continue;
                if($this->LagerFreieMenge($artikel) <=0) continue;

                // die restliche menge auf den Auftrag reservieren
                if($this->LagerFreieMenge($artikel) < $zu_reservieren)
                  $zu_reservieren = $this->LagerFreieMenge($artikel);

                // schaue ob es artikel in reserivierungen fuer diesen auftrag schon gibt dann erhoehe
//                $check = $this->app->DB->Select("SELECT menge FROM lager_reserviert WHERE artikel='$artikel'
//                    AND objekt='auftrag' AND parameter='$id' LIMIT 1");
                $check=0;

                if($check > 0)
                {
                  // wenn schon etwas reserviert ist
                  $this->app->DB->Update("UPDATE lager_reserviert SET menge = menge + '$zu_reservieren' WHERE
                      artikel='$artikel'
                      AND objekt='auftrag' AND parameter='$id'");
                } else {
                  $this->app->DB->Insert("INSERT INTO lager_reserviert 
                      (id,adresse,artikel,menge,grund,projekt,firma,bearbeiter,datum,objekt,parameter,posid)
                      VALUES('','$adresse','$artikel','$zu_reservieren','Reservierung f&uuml;r Auftrag $belegnr','$projekt',
                        '".$this->app->User->GetFirma()."','".$this->app->User->GetName()."','999-99-99','auftrag','$id','".$artikelarr[$k][id]."')");
                }

              }
            }
          }
        }
      }



      function AuftragNeuberechnenAllen()
      {
        $arrAuftrag = $this->app->DB->SelectArr("SELECT id FROM auftrag WHERE status!='abgeschlossen' AND status!='storniert' order by datum");

        for($i=0;$i < count($arrAuftrag); $i++)
        {
          $this->AuftragNeuberechnen($arrAuftrag[$i][id]);
        }   
      }

      function BestellungNeuberechnen($id)
      {

        $belegnr = $this->app->DB->Select("SELECT belegnr FROM bestellung  WHERE id='$id' LIMIT 1");
        //if(!is_numeric($belegnr) || $belegnr==0)
        {
          $summeV = $this->app->DB->Select("SELECT SUM(menge*preis) FROM bestellung_position WHERE umsatzsteuer!='ermaessigt' AND bestellung='$id'");
          $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM bestellung_position WHERE umsatzsteuer='ermaessigt' AND bestellung='$id'");

          $summeNetto = $this->app->DB->Select("SELECT SUM(menge*preis) FROM bestellung_position WHERE bestellung='$id'");

          $ust_befreit = $this->app->DB->Select("SELECT ust_befreit FROM bestellung WHERE id='$id' LIMIT 1");

          if($ust_befreit>0)
          {
            $rechnungsbetrag = $summeNetto;
          } else {
            $rechnungsbetrag = $summeNetto + ($summeV*$this->GetSteuersatzNormal(true,$id,"bestellung")-$summeV)+ ($summeR*$this->GetSteuersatzErmaessigt(true,$id,"bestellung")-$summeR);
          }
          $this->app->DB->Update("UPDATE bestellung SET gesamtsumme='$rechnungsbetrag' WHERE id='$id' LIMIT 1");
        }

      }


      function AngebotNeuberechnen($id)
      {
        $this->ANABREGSNeuberechnen($id,"angebot");
        /*
           $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
        //if(!is_numeric($belegnr) || $belegnr==0)
        {
        $summeV = $this->app->DB->Select("SELECT SUM(menge*preis) FROM angebot_position WHERE umsatzsteuer!='ermaessigt' AND angebot='$id'");
        $summeR = $this->app->DB->Select("SELECT SUM(menge*preis) FROM angebot_position WHERE umsatzsteuer='ermaessigt' AND angebot='$id'");

        $summeNetto = $this->app->DB->Select("SELECT SUM(menge*preis) FROM angebot_position WHERE angebot='$id'");

        $ust_befreit = $this->app->DB->Select("SELECT ust_befreit FROM angebot WHERE id='$id' LIMIT 1");

        if($ust_befreit>0)
        {
        $rechnungsbetrag = $summeNetto;
        } else {
        $rechnungsbetrag = $summeNetto + ($summeV*1.19-$summeV)+ ($summeR*1.07-$summeR);
        }
        $this->app->DB->Update("UPDATE angebot SET gesamtsumme='$rechnungsbetrag' WHERE id='$id' LIMIT 1");
        }
         */
      }



      function AuftragNeuberechnen($id)
      {
        $this->ANABREGSNeuberechnen($id,"auftrag");
      }



      function GutschriftNeuberechnen($id)
      {
        $this->ANABREGSNeuberechnen($id,"gutschrift");
      }


      function DeleteGutschrift($id)
      {
        $belegnr = $this->app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='$id' LIMIT 1");
        if($belegnr=="" || $belegnr=="0")
        {
          $this->app->DB->Delete("DELETE FROM gutschrift_position WHERE gutschrift='$id'");
          $this->app->DB->Delete("DELETE FROM gutschrift_protokoll WHERE gutschrift='$id'");
          $this->app->DB->Delete("DELETE FROM gutschrift WHERE id='$id' LIMIT 1");
        }
      }

      function ANABREGSNeuberechnen($id,$art)
      {
        $belegnr = $this->app->DB->Select("SELECT belegnr FROM $art WHERE id='$id' LIMIT 1");
        $adresse =  $this->app->DB->Select("SELECT adresse FROM $art WHERE id='$id' LIMIT 1");
        $status =  $this->app->DB->Select("SELECT status FROM $art WHERE id='$id' LIMIT 1");

        if($art=="auftrag")
        {
          // abweichende lieferadresse name loeschen wenn es keine gibt
          $abweichendelieferadresse = $this->app->DB->Select("SELECT abweichendelieferadresse FROM auftrag WHERE id='$id' LIMIT 1");
          $liefername = $this->app->DB->Select("SELECT liefername FROM auftrag WHERE id='$id' LIMIT 1");
          if($liefername=="" && $abweichendelieferadresse=="1")
            $this->app->DB->Update("UPDATE auftrag SET abweichendelieferadresse=0 WHERE id='$id' LIMIT 1");
        }

        $artikelarr = $this->app->DB->SelectArr("SELECT * FROM ".$art."_position WHERE ".$art."='$id'");        

        if($this->Firmendaten("modul_verband")=="1")
        {
          if($art=="angebot" || $art=="auftrag" || $art=="rechnung" || $art=="gutschrift")
          {
            $grundrabatt = $this->app->DB->Select("SELECT rabatt FROM $art WHERE id='$id' LIMIT 1");
            $rabatt1 = $this->app->DB->Select("SELECT rabatt1 FROM $art WHERE id='$id' LIMIT 1");
            $rabatt2 = $this->app->DB->Select("SELECT rabatt2 FROM $art WHERE id='$id' LIMIT 1");
            $rabatt3 = $this->app->DB->Select("SELECT rabatt3 FROM $art WHERE id='$id' LIMIT 1");
            $rabatt4 = $this->app->DB->Select("SELECT rabatt4 FROM $art WHERE id='$id' LIMIT 1");
            $rabatt5 = $this->app->DB->Select("SELECT rabatt5 FROM $art WHERE id='$id' LIMIT 1");


            if($grundrabatt>0) $rabattarr[] =  ((100-$grundrabatt)/100.0);
            if($rabatt1>0) $rabattarr[] = ((100-$rabatt1)/100.0);
            if($rabatt2>0) $rabattarr[] = ((100-$rabatt2)/100.0);
            if($rabatt3>0) $rabattarr[] = ((100-$rabatt3)/100.0);
            if($rabatt4>0) $rabattarr[] = ((100-$rabatt4)/100.0);
            if($rabatt5>0) $rabattarr[]=  ((100-$rabatt5)/100.0);

            $rabatt=1;
            for($i=0;$i<count($rabattarr);$i++)
            {
              if($rabattarr[$i] > 0 && $rabattarr[$i] < 1) $rabatt = $rabatt * $rabattarr[$i];
            }

            $rabatt=(1-$rabatt)*100;

            $this->app->DB->Update("UPDATE $art SET realrabatt='$rabatt' WHERE id='$id' LIMIT 1");
          }


          // Rabatt Sync starten
          $adresse = $this->app->DB->Select("SELECT adresse FROM ".$art." WHERE id='$id'");       

          for($i=0;$i<count($artikelarr);$i++)
          {
            // kopiere rabatte zum ersten mal
            if($artikelarr[$i]['rabattsync']!="1")
            {
              // pruefe ob artikel rabatt bekommen darf
              $check_keinrabatterlaubt = $this->app->DB->Select("SELECT keinrabatterlaubt FROM artikel WHERE id='".$artikelarr[$i]['artikel']."' LIMIT 1");
              $check_porto = $this->app->DB->Select("SELECT porto FROM artikel WHERE id='".$artikelarr[$i]['artikel']."' LIMIT 1");
              $check_rabatt = $this->app->DB->Select("SELECT rabatt FROM artikel WHERE id='".$artikelarr[$i]['artikel']."' LIMIT 1");

              // Keine Rabatte auf Spezialpreise
              if($this->IsSpezialVerkaufspreis($artikelarr[$i]['artikel'],$artikelarr[$i]['menge'],$adresse))
              {
                $check_keinrabatterlaubt="1";
              }

              if($check_keinrabatterlaubt!="1" && $check_porto!="1" && $check_rabatt!="1")
              {
                $this->app->DB->Update("UPDATE ".$art."_position SET rabattsync='1',
                    grundrabatt='$grundrabatt', rabatt1='$rabatt1', rabatt2='$rabatt2', rabatt3='$rabatt3', rabatt4='$rabatt4', rabatt4='$rabatt5',
                    keinrabatterlaubt='0' WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
              } else {
                if($check_porto=="1")
                  $this->app->DB->Update("UPDATE ".$art."_position SET rabattsync='1',keinrabatterlaubt='0',rabatt='0' WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
                else
                  $this->app->DB->Update("UPDATE ".$art."_position SET rabattsync='1',keinrabatterlaubt='1',rabatt='0' WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
              }
            }

            // rechne rabatt fuer position aus
            $grundrabatt_sub = $this->app->DB->Select("SELECT grundrabatt FROM ".$art."_position WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
            $rabatt1_sub = $this->app->DB->Select("SELECT rabatt1 FROM ".$art."_position WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
            $rabatt2_sub = $this->app->DB->Select("SELECT rabatt2 FROM ".$art."_position WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
            $rabatt3_sub = $this->app->DB->Select("SELECT rabatt3 FROM ".$art."_position WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
            $rabatt4_sub = $this->app->DB->Select("SELECT rabatt4 FROM ".$art."_position WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
            $rabatt5_sub = $this->app->DB->Select("SELECT rabatt5 FROM ".$art."_position WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
            $keinrabatterlaubt_sub = $this->app->DB->Select("SELECT keinrabatterlaubt FROM ".$art."_position WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");

            $rabattarr = array();

            if($grundrabatt_sub>0) $rabattarr[] =  ((100-$grundrabatt_sub)/100.0);
            if($rabatt1_sub>0) $rabattarr[] = ((100-$rabatt1_sub)/100.0);
            if($rabatt2_sub>0) $rabattarr[] = ((100-$rabatt2_sub)/100.0);
            if($rabatt3_sub>0) $rabattarr[] = ((100-$rabatt3_sub)/100.0);
            if($rabatt4_sub>0) $rabattarr[] = ((100-$rabatt4_sub)/100.0);
            if($rabatt5_sub>0) $rabattarr[]=  ((100-$rabatt5_sub)/100.0);

            $rabatt=1;
            for($ij=0;$ij<count($rabattarr);$ij++)
            {
              if($rabattarr[$ij] > 0 && $rabattarr[$ij] < 1) $rabatt = $rabatt * $rabattarr[$ij];
            }

            $rabatt=(1-$rabatt)*100;

            // wenn kein rabatt fuer die Position erlaubt ist                       
            if($keinrabatterlaubt_sub=="1") $rabatt=0;
            $this->app->DB->Update("UPDATE ".$art."_position SET rabatt='$rabatt' WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");


          }
        }

        // rabatt positionen berechnen also die, die auf den gesamten auftrag gehen
        $betrag = $this->ANABREGSNeuberechnenGesamtsummeOhnePortoUndKeinRabatt($id,$art);
        for($i=0;$i<count($artikelarr);$i++)
        {
          $check_rabatt_artikel = $this->app->DB->Select("SELECT rabatt FROM artikel WHERE id='".$artikelarr[$i]['artikel']."' LIMIT 1");
          if($check_rabatt_artikel=="1")
          {
            $check_rabatt_artikel_prozente = $this->app->DB->Select("SELECT rabatt_prozent FROM artikel WHERE id='".$artikelarr[$i]['artikel']."' LIMIT 1");

            if($check_rabatt_artikel_prozente>0)
            {
              $this->app->DB->Update("UPDATE ".$art."_position SET menge='1', preis='".((($betrag/100)*$check_rabatt_artikel_prozente)*-1)."' WHERE id='".$artikelarr[$i]['id']."' LIMIT 1");
            }
          }
        }       

        // porto berechnen
        $portoid = $this->app->DB->Select("SELECT tp.id FROM ".$art."_position tp LEFT JOIN artikel a ON a.id=tp.artikel
            WHERE a.porto='1' AND a.geloescht!='1' AND tp.".$art."='$id' LIMIT 1");
        $portoartikel = $this->app->DB->Select("SELECT artikel FROM ".$art."_position WHERE id='".$portoid."' LIMIT 1");
        $keinrabatterlaubt_sub = $this->app->DB->Select("SELECT keinrabatterlaubt FROM ".$art."_position WHERE id='".$portoid."' LIMIT 1");

        $betrag = $this->ANABREGSNeuberechnenGesamtsummeOhnePorto($id,$art);
        if($portoid > 0 && $keinrabatterlaubt_sub!="1" && $this->Firmendaten("porto_berechnen"))
        {
          $this->app->DB->Update("UPDATE ".$art."_position SET menge='1',preis='".$this->PortoBerechnen($adresse,$betrag,$portoartikel)."' WHERE id='".$portoid ."' LIMIT 1");
        }


        $this->ANABREGSNeuberechnenGesamtsumme($id,$art);

        if($art=="auftrag")
        {
          //tatsaechlicheslieferdatum

          $tatsaechlicheslieferdatum = $this->app->DB->Select("SELECT tatsaechlicheslieferdatum FROM auftrag WHERE id='$id' LIMIT 1");
          $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
          $differenztage = $this->Projektdaten($projekt,"differenz_auslieferung_tage");
          if($differenztage<0) $differenztage=2;
          $lieferdatum = $this->app->DB->Select("SELECT lieferdatum FROM auftrag WHERE id='$id' LIMIT 1");
          if(($tatsaechlicheslieferdatum=="0000-00-00" || $tatsaechlicheslieferdatum=="") && $lieferdatum!="0000-00-00")
          {
            $this->app->DB->Update("UPDATE auftrag SET tatsaechlicheslieferdatum=DATE_SUB(lieferdatum, INTERVAL $differenztage DAY) WHERE id='$id' LIMIT 1");
          }

        }
        if($art=="rechnung" || $art=="auftrag")
        {

          if($art=="auftrag")
            $tmprechnung = $this->app->DB->SelectArr("SELECT projekt, id as auftragid, zahlungsweise,transaktionsnummer FROM $art WHERE id='$id' LIMIT 1");
          else
            $tmprechnung = $this->app->DB->SelectArr("SELECT projekt, auftragid, zahlungsweise FROM $art WHERE id='$id' LIMIT 1");

          if($tmprechnung[0]['transaktionsnummer']=="")
            $tmprechnung[0]['transaktionsnummer'] = $this->app->DB->Select("SELECT transaktionsnummer FROM auftrag WHERE id='".$tmprechnung[0]['auftragid']."' LIMIT 1");

        }
      }     

      function PortoBerechnen($adresse,$gesamtsumme,$portoartikel)
      {
        // schaue ob Kunde eine Regel hat       
        $checkportofrei = $this->app->DB->Select("SELECT portofrei_aktiv FROM adresse WHERE id='".$adresse."' LIMIT 1");
        if($checkportofrei=="1")
        {
          $checkportofreiab = $this->app->DB->Select("SELECT portofreiab FROM adresse WHERE id='".$adresse."' LIMIT 1");
          if($gesamtsumme >= $checkportofreiab)
          {
            return 0;
          } else {
            // wenn kundenpreis vorhanden dann den holen sonst verband      
            $tmppreis = $this->GetVerkaufspreisKunde($portoartikel,1,$adresse);
            if($tmppreis > 0)
              return $tmppreis;
            else    
              return $this->GetVerkaufspreis($portoartikel,1,$adresse);
          }
        } else {
          $gruppenarray = $this->GetGruppen($adresse);

          for($gi=0;$gi<count($gruppenarray);$gi++)
          {
            $sql_erweiterung .= " id='".$gruppenarray[$gi]."' ";

            if($gi<count($gruppenarray)-1)
              $sql_erweiterung .= " OR ";
          } 
          $checkgruppeportofrei = $this->app->DB->Select("SELECT id FROM gruppen WHERE ($sql_erweiterung) AND portofrei_aktiv='1' ORDER BY portofreiab LIMIT 1");
          if($checkgruppeportofrei>0)
          {
            $checkgruppeportofreiab = $this->app->DB->Select("SELECT portofreiab FROM gruppen WHERE id='".$checkgruppeportofrei."' LIMIT 1");
            if($gesamtsumme >= $checkgruppeportofreiab)
            {
              return 0;
            } else {
              // hole kunden preis
              // wenn nicht vorhanden dann Standardpreis
              $tmppreis = $this->GetVerkaufspreisKunde($portoartikel,1,$adresse);
              if($tmppreis > 0)
                return $tmppreis;
              else    
                return $this->GetVerkaufspreis($portoartikel,1,$adresse);

              //return $this->GetVerkaufspreis($portoartikel,1,$adresse);
            }       
          }       
          // oder gruppe hat einen versandpreis?
          // billigsten versandpreis bei dem betrag
        }

        // sollte nicht passieren
        return $this->GetVerkaufspreis($portoartikel,1,$adresse);
      }

      function ANABREGSNeuberechnenGesamtsummeOhnePortoUndKeinRabatt($id,$art)
      {
        //inkl. kein rabatt erlaubt
        $summeNetto = $this->app->DB->Select("SELECT SUM(tp.menge*(tp.preis-(tp.preis/100*tp.rabatt))) FROM ".$art."_position tp
            LEFT JOIN artikel a ON a.id=tp.artikel WHERE a.porto!='1' AND (a.rabatt!='1' OR a.rabatt IS NULL) AND a.keinrabatterlaubt!='1' AND tp.".$art."='$id'");
        return $summeNetto;
      }


      function BEGesamtsummeOhnePorto($id,$art)
      {
        //inkl. kein rabatt erlaubt
        $summeNetto = $this->app->DB->Select("SELECT SUM(tp.menge*tp.preis) FROM ".$art."_position tp
            LEFT JOIN artikel a ON a.id=tp.artikel WHERE a.porto!='1' AND tp.".$art."='$id'");
        return $summeNetto;
      }

      function ANABREGSNeuberechnenGesamtsummeOhnePorto($id,$art)
      {
        //inkl. kein rabatt erlaubt
        $summeNetto = $this->app->DB->Select("SELECT SUM(tp.menge*(tp.preis-(tp.preis/100*tp.rabatt))) FROM ".$art."_position tp
            LEFT JOIN artikel a ON a.id=tp.artikel WHERE a.porto!='1' AND (a.rabatt!='1' OR a.rabatt IS NULL) AND tp.".$art."='$id'");
        return $summeNetto;
      }


      function ANABREGSNeuberechnenGesamtsumme($id,$art,$return_netto=false)
      {
        //if(!is_numeric($belegnr) || $belegnr==0)
/*
        // korrekt gerundet Formeln von CS 20150702
        if($art=="angebot")
        { 
          $summeV = $this->app->DB->Select("SELECT SUM(menge*ROUND((ROUND(preis,2)-(ROUND(preis,2)/100*rabatt)),2) ) FROM ".$art."_position WHERE umsatzsteuer!='ermaessigt' AND ".$art."='$id' AND optional!=1");
          $summeR = $this->app->DB->Select("SELECT SUM(menge*ROUND((ROUND(preis,2)-(ROUND(preis,2)/100*rabatt)),2) ) FROM ".$art."_position WHERE umsatzsteuer='ermaessigt' AND ".$art."='$id' AND optional!=1");
          $summeNetto = $this->app->DB->Select("SELECT SUM(menge*ROUND((ROUND(preis,2)-(ROUND(preis,2)/100*rabatt)),2) ) FROM ".$art."_position WHERE ".$art."='$id' AND optional!=1");
        } else {
          $summeV = $this->app->DB->Select("SELECT SUM(menge*ROUND((ROUND(preis,2)-(ROUND(preis,2)/100*rabatt)),2) ) FROM ".$art."_position WHERE umsatzsteuer!='ermaessigt' AND ".$art."='$id'");
          $summeR = $this->app->DB->Select("SELECT SUM(menge*ROUND((ROUND(preis,2)-(ROUND(preis,2)/100*rabatt)),2) ) FROM ".$art."_position WHERE umsatzsteuer='ermaessigt' AND ".$art."='$id'");
          $summeNetto = $this->app->DB->Select("SELECT SUM(menge*ROUND((ROUND(preis,2)-(ROUND(preis,2)/100*rabatt)),2) ) FROM ".$art."_position WHERE ".$art."='$id'");
        }
*/


        if($art=="angebot")
        { 
          $summeV = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM ".$art."_position WHERE umsatzsteuer!='ermaessigt' AND ".$art."='$id' AND optional!=1");
          $summeR = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM ".$art."_position WHERE umsatzsteuer='ermaessigt' AND ".$art."='$id' AND optional!=1");
          $summeNetto = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM ".$art."_position WHERE ".$art."='$id' AND optional!=1");
        } else {
          $summeV = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM ".$art."_position WHERE umsatzsteuer!='ermaessigt' AND ".$art."='$id'");
          $summeR = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM ".$art."_position WHERE umsatzsteuer='ermaessigt' AND ".$art."='$id'");
          $summeNetto = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM ".$art."_position WHERE ".$art."='$id'");
        }


        $ust_befreit = $this->app->DB->Select("SELECT ust_befreit FROM $art WHERE id='$id' LIMIT 1");
        $ustid = $this->app->DB->Select("SELECT ustid FROM $art WHERE id='$id' LIMIT 1");

        //UST ID CHECK
        if($ust_befreit==0 || ($ust_befreit==1 && $ustid==""))
        {
          $betrag = $summeNetto + ($summeV*$this->GetSteuersatzNormal(true,$id,$art)-$summeV)+ ($summeR*$this->GetSteuersatzErmaessigt(true,$id,$art)-$summeR);
        } else {
          $betrag = $summeNetto;
        }

        if($return_netto) return $betrag;

        if($art=="rechnung" || $art=="gutschrift")
          $this->app->DB->Update("UPDATE $art SET soll='$betrag' WHERE id='$id' LIMIT 1");
        else
          $this->app->DB->Update("UPDATE $art SET gesamtsumme='$betrag' WHERE id='$id' LIMIT 1");

      }


      function RechnungZwischensummeSteuersaetzeBrutto2($id,$art="ermaessigt")
      {
        if($art!="ermaessigt")
          $summe = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM rechnung_position WHERE (umsatzsteuer='normal' OR umsatzsteuer='') AND rechnung='$id'");
        else
          $summe = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM rechnung_position WHERE umsatzsteuer='$art' AND rechnung='$id'");
        if($art=="ermaessigt")
          $ermaessigt_summe = $summe*$this->GetSteuersatzErmaessigt(true,$id,"rechnung");
        else
          $ermaessigt_summe = $summe*$this->GetSteuersatzNormal(true,$id,"rechnung");
        return $ermaessigt_summe;
      }


      function RechnungZwischensummeSteuersaetzeBrutto($id,$art="ermaessigt")
      {
        return number_format($this->RechnungZwischensummeSteuersaetzeBrutto2($id,$art),",");
      }

      function GutschriftZwischensummeSteuersaetzeBrutto2($id,$art="ermaessigt")
      {
        //$summeV = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM rechnung_position WHERE umsatzsteuer!='ermaessigt' AND rechnung='$id'");
        if($art!="ermaessigt")
          $summe = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM gutschrift_position WHERE (umsatzsteuer='normal' OR umsatzsteuer='') AND gutschrift='$id'");
        else
          $summe = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM gutschrift_position WHERE umsatzsteuer='$art' AND gutschrift='$id'");
        if($art=="ermaessigt")
          $ermaessigt_summe = $summe*$this->GetSteuersatzErmaessigt(true,$id,"gutschrift");
        else
          $ermaessigt_summe = $summe*$this->GetSteuersatzNormal(true,$id,"gutschrift");

        return $ermaessigt_summe;
      }


      function GutschriftZwischensummeSteuersaetzeBrutto($id,$art="ermaessigt")
      {
        return number_format($this->GutschriftZwischensummeSteuersaetzeBrutto2($id,$art),",");
      }



      function RechnungNeuberechnen($id)
      {
        $this->ANABREGSNeuberechnen($id,"rechnung");
        /*
           $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
           $adresse =  $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$id' LIMIT 1");
        //$ust_befreit = $this->AdresseUSTCheck($adresse);
        //$this->app->DB->Update("UPDATE rechnung SET ust_befreit='$ust_befreit' WHERE id='$id' LIMIT 1");


        //if(!is_numeric($belegnr) || $belegnr==0)
        {
        $summeV = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM rechnung_position WHERE umsatzsteuer!='ermaessigt' AND rechnung='$id'");
        $summeR = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM rechnung_position WHERE umsatzsteuer='ermaessigt' AND rechnung='$id'");

        $summeNetto = $this->app->DB->Select("SELECT SUM(menge*(preis-(preis/100*rabatt))) FROM rechnung_position WHERE rechnung='$id'");

        $ust_befreit = $this->app->DB->Select("SELECT ust_befreit FROM rechnung WHERE id='$id' LIMIT 1");

        if($ust_befreit>0)
        {
        $rechnungsbetrag = $summeNetto;
        } else {
        $rechnungsbetrag = $summeNetto + ($summeV*1.19-$summeV)+ ($summeR*1.07-$summeR);
        }

        $this->app->DB->Update("UPDATE rechnung SET soll='$rechnungsbetrag' WHERE id='$id' LIMIT 1");
        }
         */
      }


      function DeleteRechnung($id)
      {
        $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
        if($belegnr=="" || $belegnr=="0")
        {
          $this->app->DB->Delete("DELETE FROM rechnung_position WHERE rechnung='$id'");
          $this->app->DB->Delete("DELETE FROM rechnung_protokoll WHERE rechnung='$id'");
          $this->app->DB->Delete("DELETE FROM rechnung WHERE id='$id' LIMIT 1");
        }
      }


      function GetUserKalender($adresse)
      {
        return $this->app->DB->SelectArr("SELECT id, name, farbe FROM kalender WHERE id IN (SELECT kalender FROM kalender_user WHERE adresse = $adresse);");
      }

      function GetAllKalender($adresse="")
      {
        return $this->app->DB->SelectArr("SELECT id, name, farbe".($adresse!=""?", IFNULL((SELECT 1 FROM kalender_user WHERE adresse=$adresse AND kalender_user.kalender=kalender.id),0) zugriff":"")." FROM kalender;");
      }

      function GetUserKalenderIds($adresse)
      {
        $arr = array();
        foreach ($this->GetUserKalender($adresse) as $value)
          array_push($arr,$value["id"]);
        return $arr;
      }

      function GetAllKalenderIds($adresse="")
      {
        $arr = array();
        foreach ($this->GetAllKalender($adresse) as $value)
          array_push($arr,$value["id"]);
        return $arr;
      }

      function GetKalenderSelect($adresse,$selectedKalender=array())
      {
        $arr = $this->GetUserKalender($adresse);
        foreach($arr as $value)
        { 
          $tmp = (in_array($value["id"],$selectedKalender))?" selected=\"selected\"":"";
          $ret .= "<option value=\"".$value["id"]."\"$tmp>".$value["name"]."</option>";
        }
        return $ret;
      }

      function GetKwSelect($selectedKW="")
      {
        foreach(range(1,52) as $kw)
        { 
          $tmp = ($selectedKW==$kw)?" selected=\"selected\"":"";
          $ret .= "<option value=\"$kw\"$tmp>$kw</option>";
        }
        return $ret;
      }

      function GetYearSelect($selectedYear="", $yearsBefore=2, $yearsAfter=10)
      {
        foreach(range(date("Y")-$yearsBefore, date("Y")+$yearsAfter) as $year)
        { 
          $tmp = ($selectedYear==$year)?" selected=\"selected\"":"";
          $ret .= "<option value=\"$year\"$tmp>$year</option>";
        }
        return $ret;
      }

      function DownloadFile($url,$label="tmp",$ending="")
      {
        if($ending!="") $ending = '.'.$ending;

        $tmpname = tempnam($this->GetTMP(),$label).$ending;
        file_put_contents($tmpname, fopen($url, 'r'));
        return $tmpname;
      }

      function CreateDateiOhneInitialeVersion($titel,$beschreibung,$nummer,$ersteller,$without_log=false)
      {
        if(!$without_log)
        {
          $this->app->DB->Insert("INSERT INTO datei (id,titel,beschreibung,nummer,firma) VALUES
              ('','$titel','$beschreibung','$nummer','".$this->app->User->GetFirma()."')");
        } else {
          $this->app->DB->InsertWithoutLog("INSERT INTO datei (id,titel,beschreibung,nummer,firma) VALUES
              ('','$titel','$beschreibung','$nummer',1)");
        }

        $fileid = $this->app->DB->GetInsertID();
        //$this->AddDateiVersion($fileid,$ersteller,$name,"Initiale Version",$datei,$without_log);

        return  $fileid;
      }


      function CreateDatei($name,$titel,$beschreibung,$nummer,$datei,$ersteller,$without_log=false,$path="")
      {
        if(!$without_log)
        {
          $this->app->DB->Insert("INSERT INTO datei (id,titel,beschreibung,nummer,firma) VALUES
              ('','$titel','$beschreibung','$nummer','".$this->app->User->GetFirma()."')");
        } else {
          $this->app->DB->InsertWithoutLog("INSERT INTO datei (id,titel,beschreibung,nummer,firma) VALUES
              ('','$titel','$beschreibung','$nummer',1)");
        }

        $fileid = $this->app->DB->GetInsertID();
        $this->AddDateiVersion($fileid,$ersteller,$name,"Initiale Version",$datei,$without_log,$path);

        return  $fileid;
      }

      function AddDateiVersion($id,$ersteller,$dateiname, $bemerkung,$datei,$without_log=false,$path="")
      {
        // ermittle neue Version
        $version = $this->app->DB->Select("SELECT COUNT(id) FROM datei_version WHERE datei='$id'") + 1;

        // speichere werte ab 
        if(!$without_log)
        {
          $this->app->DB->Insert("INSERT INTO datei_version (id,datei,ersteller,datum,version,dateiname,bemerkung)
              VALUES ('','$id','$ersteller',NOW(),'$version','$dateiname','$bemerkung')");
        } else {
          $this->app->DB->InsertWithoutLog("INSERT INTO datei_version (id,datei,ersteller,datum,version,dateiname,bemerkung)
              VALUES ('','$id','$ersteller',NOW(),'$version','$dateiname','$bemerkung')");
        }
        $versionid = $this->app->DB->GetInsertID();

        //TODO Das ist keine lösung!
        //    if($this->app->Conf->WFdbname=="")
        //      $this->app->Conf->WFdbname="wawision";

        // Pfad anpassen
        if($path=="")
        {
          $path = str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']);
          $path = $path."../userdata/dms/";
          $path_only = $path;
          $path = $path.$this->app->Conf->WFdbname;
        }  else { $path_only = $path;  }

        if(!is_dir($path))
        {

          $path_b = $path;
          if (substr(trim($path), -1) == DIRECTORY_SEPARATOR) {
            $path = substr(trim($path), 0, -1);
          }

          system("chmod 777 ".$path);
          $path = $path_b;
          //system("mkdir ".$path);
          mkdir($path);
          system("chmod 777 ".$path);
        }

        if(is_file($datei))
        {
          if(copy($datei,$path."/".$versionid))return $versionid;
          return false;
        }
        else if(is_uploaded_file($datei))
        {  
          if(move_uploaded_file($datei,$path."/".$versionid))return $versionid;
          return false;
        } 
        else {
          // ACHTUNG !!!! ANGRIFFSGEFAHR!!!!!
          if($handle = fopen ($path."/".$versionid, "wb"))
          {
            fwrite($handle, $datei);
            fclose($handle);
            return $versionid;
          } 
          return false;
        }
      }


      function AddDateiStichwort($id,$subjekt,$objekt,$parameter,$without_log=false)
      {
        if(!$without_log)
        {
          $this->app->DB->Insert("INSERT INTO datei_stichwoerter (id,datei,subjekt,objekt,parameter)
              VALUES ('','$id','$subjekt','$objekt','$parameter')");
        } else {
          $this->app->DB->InsertWithoutLog("INSERT INTO datei_stichwoerter (id,datei,subjekt,objekt,parameter)
              VALUES ('','$id','$subjekt','$objekt','$parameter')");
        }
      }

      function DeleteDateiAll($subjekt,$objekt,$parameter)
      {
        //TODO
      }

      function GetDateiName($id)
      {
        $version = $this->app->DB->Select("SELECT MAX(version) FROM datei_version WHERE datei='$id'");
        $newid = $this->app->DB->Select("SELECT dateiname FROM datei_version WHERE datei='$id' AND version='$version' LIMIT 1");

        return $newid;
      }


      function GetDateiSubjektObjektDateiname($subjekt,$objekt,$parameter,$prefix="")
      {
        $dateien = $this->app->DB->SelectArr("SELECT datei FROM datei_stichwoerter WHERE subjekt='$subjekt' AND objekt='$objekt' AND parameter='$parameter' GROUP by datei");

        for($i=0;$i<count($dateien);$i++)
        {
          $tmpname = tempnam($this->GetTMP(), $prefix);
          $newname = $tmpname."_".$this->GetDateiName($dateien[$i]['datei']);

          copy($this->GetDateiPfad($dateien[$i]['datei']),$newname);

          $tmp[] = $newname;
        }
        return $tmp;
      }

      function GetDateiSubjektObjekt($subjekt,$objekt,$parameter)
      {
        $dateien = $this->app->DB->SelectArr("SELECT datei FROM datei_stichwoerter WHERE subjekt='$subjekt' AND objekt='$objekt' AND parameter='$parameter' GROUP by datei");

        for($i=0;$i<count($dateien);$i++)
        {
          $tmp[] = $this->GetDateiPfad($dateien[$i]['datei']);
        }
        return $tmp;
      }

      function GetDateiPfad($id)
      {
        $version = $this->app->DB->Select("SELECT MAX(version) FROM datei_version WHERE datei='$id'");
        $newid = $this->app->DB->Select("SELECT id FROM datei_version WHERE datei='$id' AND version='$version' LIMIT 1");

        $path = "../userdata/dms/".$this->app->Conf->WFdbname."/".$newid;
        return $path;
      }


      function GetDatei($id)
      {
        $version = $this->app->DB->Select("SELECT MAX(version) FROM datei_version WHERE datei='$id'");
        $newid = $this->app->DB->Select("SELECT id FROM datei_version WHERE datei='$id' AND version='$version' LIMIT 1");

        $path = "../userdata/dms/".$this->app->Conf->WFdbname."/".$newid;

        return file_get_contents($path); 
      }

      function GetDateiSize($id) {
        $version = $this->app->DB->Select("SELECT MAX(version) FROM datei_version WHERE datei='$id'");
        $newid = $this->app->DB->Select("SELECT id FROM datei_version WHERE datei='$id' AND version='$version' LIMIT 1");
        $name = $this->app->DB->Select("SELECT dateiname FROM datei_version WHERE id='$newid' LIMIT 1");

        $path = "../userdata/dms/".$this->app->Conf->WFdbname."/".$newid;

        $size = filesize($path);

        if($size <= 1024)
          return $size." Byte";
        else if($size <= 1024*1024)
          return number_format(($size/1024),2)." KB"; 
        else
          return number_format(($size/1024/1024),2)." MB"; 

      }



      function SendDatei($id,$versionid="") {
        session_write_close();
        ob_end_clean();


        set_time_limit(0);
        $version = $this->app->DB->Select("SELECT MAX(version) FROM datei_version WHERE datei='$id'");
        $newid = $this->app->DB->Select("SELECT id FROM datei_version WHERE datei='$id' AND version='$version' LIMIT 1");

        if($versionid>0)
          $newid = $versionid;

        $name = $this->app->DB->Select("SELECT dateiname FROM datei_version WHERE id='$newid' LIMIT 1");



        $path = "../userdata/dms/".$this->app->Conf->WFdbname."/".$newid;
        //$name=basename($path);

        //filenames in IE containing dots will screw up the
        //filename unless we add this

        if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE"))
          $name = preg_replace('/\./', '%2e', $name, substr_count($name, '.') - 1);

        $contenttype= $this->content_type($name);

        //required, or it might try to send the serving     //document instead of the file
        header("Content-Type: $contenttype");
        header("Content-Length: " .(string)(filesize($path)) );
        //header('Content-Disposition: inline; filename="'.$name.'"');
        header('Content-Disposition: attachment; filename="'.$name.'"');

        if($file = fopen($path, 'rb')){
          while( (!feof($file)) && (connection_status()==0) ){
            print(fread($file, 1024*8));
            flush();
          }
          fclose($file);
        }
        return((connection_status()==0) and !connection_aborted());
      }


      function content_type($name) {
        // Defines the content type based upon the extension of the file
        $contenttype  = 'application/octet-stream';
        $contenttypes = array( 'html' => 'text/html',
            'htm'  => 'text/html',
            'txt'  => 'text/plain',
            'gif'  => 'image/gif',
            'jpg'  => 'image/jpeg',
            'png'  => 'image/png',
            'sxw'  => 'application/vnd.sun.xml.writer',
            'sxg'  => 'application/vnd.sun.xml.writer.global',
            'sxd'  => 'application/vnd.sun.xml.draw',
            'sxc'  => 'application/vnd.sun.xml.calc',
            'sxi'  => 'application/vnd.sun.xml.impress',
            'xls'  => 'application/vnd.ms-excel',
            'ppt'  => 'application/vnd.ms-powerpoint',
            'doc'  => 'application/msword',
            'rtf'  => 'text/rtf',
            'zip'  => 'application/zip',
            'mp3'  => 'audio/mpeg',
            'pdf'  => 'application/pdf',
            'tgz'  => 'application/x-gzip',
            'gz'   => 'application/x-gzip',
            'vcf'  => 'text/vcf' );

        $name = ereg_replace("§", " ", $name);
        foreach ($contenttypes as $type_ext => $type_name) {
          if (preg_match ("/$type_ext$/i",  $name)) $contenttype = $type_name;
        }
        return $contenttype;
      } 


     function GetArtikelStandardbild($artikel,$return_dateiid=false)
     {
          $dateiid = $this->app->DB->Select("select datei from datei_stichwoerter where objekt like 'Artikel' and parameter = '".$artikel."' and (subjekt like 'Druckbild') LIMIT 1");
          if(!$dateiid)$dateiid = $this->app->DB->Select("select datei from datei_stichwoerter where objekt like 'Artikel' and parameter = '".$artikel."' and (subjekt like 'Bild') LIMIT 1");
          if(!$dateiid)$dateiid = $this->app->DB->Select("select datei from datei_stichwoerter where objekt like 'Artikel' and parameter = '".$artikel."' and (subjekt like 'Shopbild') LIMIT 1");


          if($return_dateiid) return $dateiid;

          if($dateiid > 0 && $artikel > 0)
          { 
            $filename = $this->GetDateiName($dateiid);
            $path_info = pathinfo($filename);
            return array('image'=>$this->GetDatei($dateiid),'filename'=>$filename,'extension'=>$path_info['extension']);
          } else {
            return false;
          }
      }

      function Wochenplan($adr_id,$parsetarget){
        $this->app->Tpl->Set('SUBSUBHEADING', "Wochenplan");
        $this->app->Tpl->Set('INHALT',"");

        $anzWochentage = 5;
        $startStunde = 6;
        $endStunde = 22;

        $wochentage = $this->getDates($anzWochentage);

        $inhalt = "";
        for($i=$startStunde;$i<=$endStunde;$i++){ // fuelle Zeilen 06:00 bis 22:00
          $zeile = array();
          $zeileCount = 0;
          foreach($wochentage as $tag){ // hole Daten fuer Uhrzeit $i und Datum $tage
            $result = $this->checkCell($tag, $i, $adr_id);
            if($result[0]['aufgabe'] != "")
            {
              if($result[0]['adresse']==0) $color = '#ccc'; else $color='#BCEE68';
              if($result[0]['prio']==1) $color = 'red';

              $zeile[$zeileCount] = '<div style="background-color: '.$color.'">'.$result[0]['aufgabe'].'</div>';
            }
            else
              $zeile[$zeileCount] = "&nbsp;";
            $zeileCount++;
          }
          //print_r($zeile);
          $inhalt = $inhalt.$this->makeRow($zeile, $anzWochentage,$i.":00");
        }
        $this->app->Tpl->Set('WOCHENDATUM', $this->makeRow($wochentage, $anzWochentage));
        $this->app->Tpl->Set('INHALT',$inhalt);

        $this->app->Tpl->Parse($parsetarget,"zeiterfassung_wochenplan.tpl");

        $this->app->Tpl->Add($parsetarget,"<table><tr><td style=\"background-color:#BCEE68\">".$this->app->User->GetName()."</td>
            <td style=\"background-color:red\">Prio: Sehr Hoch (".$this->app->User->GetName().")</td>
            <td style=\"background-color:#ccc\">Allgemein</td></tr></table>");
      }

      function getDates($anzWochentage){
        // hole Datum der Wochentage von Mo bis $anzWochentage
        $montag = $this->app->DB->Select("SELECT DATE_SUB(CURDATE(),INTERVAL WEEKDAY(CURDATE()) day)");
        $week = array();
        for($i=0;$i<$anzWochentage;$i++)
          $week[$i] = $this->app->DB->Select("SELECT DATE_ADD('$montag',INTERVAL $i day)");
        return $week;
      }

      function makeRow($data, $spalten, $erstefrei="frei"){
        // erzeuge eine Zeile in der Tabelle
        // $erstefrei = 1 -> erste Spalte ist leer

        $row = '<tr>';
        if($erstefrei=="frei")
          $row = $row.'<td class="wochenplan">&nbsp;</td>';
        else
          $row = $row.'<td class="wochenplan">'.$erstefrei.'</td>';
        for($i=0;$i<$spalten; $i++)
          $row = $row.'<td class="wochenplan">'.$data[$i].'</td>';
        $row = $row.'</tr>';
        return $row;
      }


      function KundeMitUmsatzsteuer($adresse)
      {
        $land = $this->app->DB->Select("SELECT land FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        $ustid = $this->app->DB->Select("SELECT ustid FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
        if($land ==$this->Firmendaten("land"))
          return true;

        // wenn kunde EU
        foreach($this->GetUSTEU() as $value)
        {
          //echo $value;
          if($value==$land && $ustid!="") return false;
        }

        // alle anderen laender = export
        return false;
      }

      function AuftragMitUmsatzeuer($auftrag)
      {

        if($this->app->DB->Select("SELECT ust_befreit FROM auftrag WHERE id='$auftrag' LIMIT 1") == 0 
            || ($this->app->DB->Select("SELECT ust_befreit FROM auftrag WHERE id='$auftrag' LIMIT 1") == 1 &&               
              $this->app->DB->Select("SELECT ustid FROM auftrag WHERE id='$auftrag' LIMIT 1") ==""))
          return true;
        else return false;

        //$adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$auftrag' LIMIT 1");
        //return $this->KundeMitUmsatzsteuer($adresse);
      }

      function GutschriftMitUmsatzeuer($gutschrift)
      {
        if($this->app->DB->Select("SELECT ust_befreit FROM gutschrift WHERE id='$gutschrift' LIMIT 1") == 0
            || ($this->app->DB->Select("SELECT ust_befreit FROM gutschrift WHERE id='$gutschrift' LIMIT 1") == 1 &&                               
              $this->app->DB->Select("SELECT ustid FROM gutschrift WHERE id='$gutschrift' LIMIT 1") ==""))
          return true;
        else return false;

        // if($this->CheckLieferantEU($adresse))
        //  return false;

        // wenn lieferant DE dann mit 19% oder 7% einkaufen
        // wenn lieferant in der EU kann man mit 0% bezahlen 

        // wenn lieferant in der welt sowieso keine steuer sondern zoll

        // wenn wir von privat EU kaufen dann muss mit steuer gekauft werden! (SPAETER KANN ES SEIN)
        return false;
      }


      function RechnungMitUmsatzeuer($rechnung)
      {
        if($this->app->DB->Select("SELECT ust_befreit FROM rechnung WHERE id='$rechnung' LIMIT 1") == 0 
            || ($this->app->DB->Select("SELECT ust_befreit FROM rechnung WHERE id='$rechnung' LIMIT 1") == 1 && 
              $this->app->DB->Select("SELECT ustid FROM rechnung WHERE id='$rechnung' LIMIT 1") ==""))
          return true;
        else 
          return false;

        // if($this->CheckLieferantEU($adresse))
        //  return false;

        // wenn lieferant DE dann mit 19% oder 7% einkaufen
        // wenn lieferant in der EU kann man mit 0% bezahlen 

        // wenn lieferant in der welt sowieso keine steuer sondern zoll

        // wenn wir von privat EU kaufen dann muss mit steuer gekauft werden! (SPAETER KANN ES SEIN)
        return false;
      }


      function AngebotMitUmsatzeuer($angebot)
      {
        if($this->app->DB->Select("SELECT ust_befreit FROM angebot WHERE id='$angebot' LIMIT 1") == 0
            || ($this->app->DB->Select("SELECT ust_befreit FROM angebot WHERE id='$angebot' LIMIT 1") == 1 &&                               
              $this->app->DB->Select("SELECT ustid FROM angebot WHERE id='$angebot' LIMIT 1") ==""))
          return true;
        else return false;

        // if($this->CheckLieferantEU($adresse))
        //  return false;

        // wenn lieferant DE dann mit 19% oder 7% einkaufen
        // wenn lieferant in der EU kann man mit 0% bezahlen 
        // wenn lieferant in der welt sowieso keine steuer sondern zoll

        // wenn wir von privat EU kaufen dann muss mit steuer gekauft werden! (SPAETER KANN ES SEIN)
      }


      function BestellungMitUmsatzeuer($bestellung)
      {
        if($this->app->DB->Select("SELECT ust_befreit FROM bestellung WHERE id='$bestellung' LIMIT 1") == 0 )
          return true;
        else return false;
        /*
           $adresse = $this->app->DB->Select("SELECT adresse FROM bestellung WHERE id='$bestellung' LIMIT 1");
           $land = $this->app->DB->Select("SELECT land FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
           if($land =="DE")
           return true;
         */
        // if($this->CheckLieferantEU($adresse))
        //  return false;

        // wenn lieferant DE dann mit 19% oder 7% einkaufen
        // wenn lieferant in der EU kann man mit 0% bezahlen 

        // wenn lieferant in der welt sowieso keine steuer sondern zoll

        // wenn wir von privat EU kaufen dann muss mit steuer gekauft werden! (SPAETER KANN ES SEIN)
        return false;
      }


      function BesteuerungKunde($adresse)
      {
        if($this->AdresseUSTCheck($adresse)==0)
          return "steuer";
        else
          return "";

        // steuer muss gezahlt werden! steuer, euexport, exporr

        // wenn kunde im export muss keine steuer bezahlt werden!

        // wenn kunde  gepruefte ust id hat && lieferung nach EU geht (aber das land verlaesst!)

      }



      function CheckLieferantEU($adresse)
      {
        // lieferant aus der EU
        $land = $this->app->DB->Select("SELECT land FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

      }


      function CheckKundeEU($adresse)
      {

      }

      function checkCell($datum, $stunde, $adr_id){
        // ueberprueft ob in der Stunde eine Aufgabe zu erledigen ist
        //echo $datum." ".$stunde."<br>";
        return  $this->app->DB->SelectArr("SELECT aufgabe,adresse,prio
            FROM aufgabe
            WHERE DATE(startdatum) = '$datum'
            AND HOUR(TIME(startzeit)) <= $stunde 
            AND HOUR(TIME(startzeit)) + stunden >= $stunde
            AND (adresse = $adr_id OR adresse = 0)
            OR 
            ((DATE_SUB('$datum', INTERVAL MOD(DATEDIFF('$datum',DATE_FORMAT(startdatum, '%Y:%m:%d')),intervall_tage) day)='$datum'
              AND DATE_SUB('$datum', INTERVAL MOD(DATEDIFF('$datum',DATE_FORMAT(startdatum, '%Y:%m:%d')),intervall_tage) day)
              > abgeschlossen_am
              AND intervall_tage>0 AND (adresse=$adr_id OR adresse=0))
             AND HOUR(TIME(startzeit)) <= $stunde AND HOUR(TIME(startzeit)) + stunden >= $stunde) 
            OR ( DATE (abgabe_bis) = '$datum' AND  abgeschlossen=0 AND adresse = $adr_id AND HOUR(TIME(startzeit)) = $stunde)
            LIMIT 1"); // letztes OR von Bene!
      }

      function WebmailSetReadStatus($mailid,$boolean)
      {
        $this->app->DB->Update("UPDATE emailbackup_mails SET gelesen = ".($boolean?1:0)." WHERE id = $mailid");
      }

      function checkPDF($file,$maxSize=0,$x=0,$y=0)
      {

        return "";  
      }
      function checkFile($file,$filetype,$maxSize=0)
      {
        if($file!="")
        { 
          if(is_array($file))
            $pfad = $file[tmp_name];
          else $pfad = $file;
        }

        $dbtype = mime_content_type($pfad);

        if($dbtype!=$filetype)
          return "Falscher Dateityp! Es wird $filetype erwartet aber $dbtype wurde &uuml;bergeben!";

        else return "";
      }



      function checkImage($file,$maxSize=0,$x=0,$y=0,$typcheck=2)
      {
        // Prueft ein Bild auf Dateigroesse, Hoehe und Breite
        if($file!="")
        { 
          if(is_array($file))
            $pfad = $file[tmp_name];
          else $pfad = $file;
        }
        $typ = GetImageSize($pfad);
        $size = $file[size];


        if($maxSize==0)
          $fileSizeLimit =  16777216; // 16MB in BYTE, 100MB stehen in der upload_max_size
        else
          $fileSizeLimit = $maxSize;

        //if(0 < $typ[2] && $typ[2] < 4)
        if($typ[2]==$typcheck)
        { 
          if($size<$fileSizeLimit)
          { 
            if($typ[0]>$x && $x!=0)
              $error = "Das Bild ist zu breit.";
            if($typ[1]>$y && $y!=0)
              $error = "Das Bild ist zu hoch.";
          }else
            $error = "Die Datei darf eine Gr&ouml;&szlig;e von ".($fileSizeLimit/8388608)." MB nicht &uuml;berschreiten.";
        }else
          $error = "Die Datei muss vom korrekten Typ sein";
        return $error;
      }

      function uploadImageIntoDB($file)
      {
        // Wandelt ein Bild fuer einen LONGBLOB um
        $pfad = $file[tmp_name];
        $typ = GetImageSize($pfad);

        // Bild hochladen
        $filehandle = fopen($pfad,'r');
        $filedata = base64_encode(fread($filehandle, filesize($pfad)));
        $dbtype = $typ['mime'];
        return array("image"=>$filedata,"type"=>$dbtype);
      }


      

      function GetEinkaufspreis($id,$menge,$adresse="")
      {

        // wenn produktionsartikel
        $produktion = $this->app->DB->Select("SELECT produktion FROM artikel WHERE id='$id' LIMIT 1");
        $stueckliste = $this->app->DB->Select("SELECT stueckliste FROM artikel WHERE id='$id' LIMIT 1");
        $juststueckliste = $this->app->DB->Select("SELECT juststueckliste FROM artikel WHERE id='$id' LIMIT 1");

        if($produktion) {
        } 
        else if($stueckliste==1 && $juststueckliste!=1)
        {
          $ek = $this->GetEinkaufspreisStueckliste($id);
        }
        else {  
          $ek = $this->app->DB->Select("SELECT preis FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND ab_menge<='$menge' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 ORDER by ab_menge DESC LIMIT 1");
          if($ek <=0)
          {
            $ek = $this->app->DB->Select("SELECT preis FROM einkaufspreise WHERE artikel='$id' AND ab_menge<='$menge' 
                AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 ORDER by preis LIMIT 1");

            if($ek <=0)
            {
              $ek = $this->app->DB->Select("SELECT MIN(preis) FROM einkaufspreise WHERE artikel='$id'  
                  AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 ");
            }
          }
        }
        return $ek;
      }

      function Wechselkurs($von,$zu,$datum)
      {
        return 1.3;
      }


      function Rabatt($betrag,$rabatt)
      {
        $result = $betrag*(100-$rabatt)/100;
        return number_format($result, 4, '.', '');
      }

      function GetGruppen($adresse)
      {
        $tmp = $this->app->DB->SelectArr("SELECT * FROM adresse_rolle WHERE adresse='$adresse' AND (bis > NOW() OR bis='0000-00-00') AND parameter > 0 AND objekt='Gruppe'");
        for($i=0;$i<count($tmp);$i++)
          $result[]=$tmp[$i]['parameter'];

        return $result;
      }

      function MonatsListe($sprache = 'deutsch') {

        $monatsListe[1] = 'Januar';
        $monatsListe[2] = 'Februar';
        $monatsListe[3] = 'März';
        $monatsListe[4] = 'April';
        $monatsListe[5] = 'Mai';
        $monatsListe[6] = 'Juni';
        $monatsListe[7] = 'Juli';
        $monatsListe[8] = 'August';
        $monatsListe[9] = 'September';
        $monatsListe[10] = 'Oktober';
        $monatsListe[11] = 'November';
        $monatsListe[12] = 'Dezember';

        return $monatsListe;

      }

      function IsSpezialVerkaufspreis($artikel,$menge,$adresse=0,$waehrung='EUR')
      {
        $gruppenarr = $this->GetGruppen($adresse);
        for($i=0;$i<count($gruppenarr);$i++)
        {
          if($gruppenarr[$i]>0)
            $sql_erweiterung .= " OR v.gruppe='".$gruppenarr[$i]."' ";
        }

        $vkarr = $this->app->DB->SelectArr("SELECT * FROM verkaufspreise v WHERE v.ab_menge <= '$menge' AND
            (v.gueltig_bis > NOW() OR v.gueltig_bis='0000-00-00') AND v.artikel='".$artikel."' AND (v.adresse='$adresse' $sql_erweiterung) 
            ORDER by ab_menge ASC, preis DESC LIMIT 1");

        $letzte_menge = 0;//$vkarr[0][ab_menge];
        for($vi=0;$vi<count($vkarr);$vi++)
        {
          if($vkarr[$vi][adresse]==$adresse && $vkarr[$vi][adresse]>0 && $vkarr[$vi][art]=="Kunde")
          {
            return true;
          }
          if($vkarr[$vi][gruppe] > 0 && $vkarr[$vi][art]=="Gruppe")
          {
            return true;
          }
        }

        return false;
      }

      var $preisliste;

      function GeneratePreisliste($artikel,$adresse,$rabatt=0)
      {

        $keinrabatterlaubt = $this->app->DB->Select("SELECT keinrabatterlaubt FROM artikel WHERE id='".$artikel."' LIMIT 1");

        $gruppenarray = $this->GetGruppen($adresse);

        if(count($gruppenarray)>0) $sql_erweiterung = " OR ";
        for($gi=0;$gi<count($gruppenarray);$gi++)
        {
          $sql_erweiterung .= " gruppe='".$gruppenarray[$gi]."' ";

          if($gi<count($gruppenarray)-1)
            $sql_erweiterung .= " OR ";
        }
        // reinsortieren
        //$vkarr = $this->app->DB->SelectArr("SELECT if((v.adresse > 0 OR v.gruppe >0),v.preis,(v.preis*(1-$rabatt))/100.0) as preis,v.* FROM verkaufspreise v WHERE 
        $vkarr = $this->app->DB->SelectArr("SELECT v.*,if((v.adresse > 0 OR v.gruppe > 0),v.preis,(v.preis*(100-$rabatt))/100.0) as rabattpreis FROM verkaufspreise v WHERE 
            (v.gueltig_bis > NOW() OR v.gueltig_bis='0000-00-00') AND v.artikel='".$artikel."' AND (v.adresse='$adresse' $sql_erweiterung OR 
              ((v.adresse='' OR v.adresse='0') AND v.art='Kunde')) ORDER by rabattpreis ASC");

        $letzter_preis = 0;

        // einmal rueckwaerts aufraeumen
        for($vi=0;$vi<count($vkarr);$vi++)
        {
          // rabatt rausrechnen
          if($keinrabatterlaubt!="1") 
            $vkarr[$vi][preis] = $vkarr[$vi][rabattpreis];

          if($vkarr[$vi][preis] > $letzter_preis && (($vkarr[$vi][ab_menge] < $letzte_menge) || $vi==0))
          {
            // preis behalten
            $letzte_menge = $vkarr[$vi][ab_menge];
            $letzter_preis = $vkarr[$vi][preis];
          } else {
            // preis loeschen
            $vkarr[$vi][ab_menge]=0;
            $vkarr[$vi][preis]=0;
          }
        }

        for($vi=0;$vi<count($vkarr);$vi++)
        {
          if($vkarr[$vi][ab_menge] > 0)
            $vkarr2[] = $vkarr[$vi];
        }
        $vkarr = array_reverse($vkarr2);

        // an schluss pruefen und unnötige rausschmeissen
        return $vkarr;
      } 

      function GetVerkaufspreisKunde($artikel,$menge,$adresse=0,$waehrung='EUR')
      {
        $vkarr = $this->app->DB->SelectArr("SELECT * FROM verkaufspreise v WHERE v.ab_menge <='$menge' AND 
            (v.gueltig_bis > NOW() OR v.gueltig_bis='0000-00-00') AND v.artikel='".$artikel."' AND v.adresse='$adresse' AND v.art='Kunde'
            ORDER by ab_menge DESC, preis ASC");

        $letzte_menge = 0;  //$vkarr[0][ab_menge];
        $letzter_preis = 99999999999;

        for($vi=0;$vi<count($vkarr);$vi++)
        {
          if($vkarr[$vi][ab_menge] > $letzte_menge && $vkarr[$vi][preis]<$letzter_preis && $menge >= $vkarr[$vi][ab_menge])
          {
            $letzte_menge = $vkarr[$vi][ab_menge];
            $letzter_preis = $vkarr[$vi][preis];
          }
        }

        if($letzter_preis==99999999999)
          $letzter_preis=0;

        return $letzter_preis;
      }

      function GetVerkaufspreis($artikel,$menge,$adresse=0,$waehrung='EUR')
      {
        $gruppenarr = $this->GetGruppen($adresse);
        for($i=0;$i<count($gruppenarr);$i++)
        {
          if($gruppenarr[$i]>0)
            $sql_erweiterung .= " OR gruppe='".$gruppenarr[$i]."' ";
        }

          $vkarr = $this->app->DB->SelectArr("SELECT * FROM verkaufspreise v WHERE v.ab_menge <='$menge' AND
            (v.gueltig_bis > NOW() OR v.gueltig_bis='0000-00-00') AND v.artikel='".$artikel."' AND (v.adresse='$adresse' $sql_erweiterung  OR
              ((v.adresse='' OR v.adresse='0') AND v.art='Kunde')) ORDER by ab_menge DESC, preis ASC");



        $letzte_menge = 0;  //$vkarr[0][ab_menge];
        $letzter_preis = 99999999999;

        for($vi=0;$vi<count($vkarr);$vi++)
        {
          if($vkarr[$vi][ab_menge] > $letzte_menge && $vkarr[$vi][preis]<$letzter_preis && $menge >= $vkarr[$vi][ab_menge])
          {
            $letzte_menge = $vkarr[$vi][ab_menge];
            $letzter_preis = $vkarr[$vi][preis];
          }
        }

        if($letzter_preis==99999999999)
          $letzter_preis=0;

        return $letzter_preis;
      }


      function GetEinkaufspreisStatistik($id,$max=false, $lvl = 0)
      {
        if($lvl > 5)return 0; 
        //Falls Einkaufspreis definiert
        if($max)
        {
          $ep = $this->app->DB->Select("SELECT FORMAT(MAX(e.preis),2) FROM einkaufspreise e where e.artikel = $id AND (e.objekt='Standard' OR e.objekt='')");
          if($ep)return $ep;
        } else {
          $ep = $this->app->DB->Select("SELECT FORMAT(MIN(e.preis),2) FROM einkaufspreise e where e.artikel = $id AND (e.objekt='Standard' OR e.objekt='')");
          if($ep)return $ep;
        }
        //Kein Einkaufspreis definiert => Stückliste
        if($max) {
          
          $sql = "
           
              SELECT format( SUM(if (ep>0,ep,vp)),2) 
                from (SELECT MAX(e.preis) as ep, MAX(v.preis) vp FROM artikel a left join einkaufspreise e on a.id = e.artikel left join verkaufspreise v on a.id = v.artikel 
              WHERE a.id in ( SELECT s.artikel from stueckliste s LEFT JOIN artikel a ON a.id=s.artikel WHERE s.stuecklistevonartikel='$id' and a.stueckliste != '1') ) q
          
          ";
          $preis_max = $this->app->DB->Select($sql);
          
          $sql = "SELECT s.artikel
                FROM stueckliste s
                LEFT JOIN artikel a ON a.id=s.artikel
                WHERE s.stuecklistevonartikel='$id' and a.stueckliste = '1'
          ";
          $startikel = $this->app->DB->SelectArr($sql);
          if($startikel)
          {
            foreach($startikel as $art)
            $preis_max += $this->GetEinkaufspreisStatistik($art['artikel'],$max, $lvl + 1);
          }
          return $preis_max;
        } else {
          $sql = "              SELECT format( SUM(if (ep>0,ep,vp)),2) 
                from (SELECT MIN(e.preis) as ep, MIN(v.preis) vp FROM artikel a left join einkaufspreise e on a.id = e.artikel left join verkaufspreise v on a.id = v.artikel 
              WHERE a.id in ( SELECT s.artikel from stueckliste s LEFT JOIN artikel a ON a.id=s.artikel WHERE s.stuecklistevonartikel='$id' and a.stueckliste != '1') ) q";
          $preis = $this->app->DB->Select($sql);
          $sql = "SELECT s.artikel
                FROM stueckliste s
                LEFT JOIN artikel a ON a.id=s.artikel
                WHERE s.stuecklistevonartikel='$id' and a.stueckliste = '1'
          ";
          $startikel = $this->app->DB->SelectArr($sql);
          if($startikel)
          {
            foreach($startikel as $art)
            $preis += $this->GetEinkaufspreisStatistik($art['artikel'],$max, $lvl + 1);
          }
          
          return $preis;
        }
      }
      
      function GetEinkaufspreisStueckliste($id,$max=false)
      {
        $sql = "SELECT FORMAT(SUM( 
              (SELECT MAX(e.preis) FROM einkaufspreise e WHERE e.artikel=s.artikel AND (e.objekt='Standard' OR e.objekt=''))*s.menge)
              ,2)
              FROM stueckliste s
              LEFT JOIN artikel a ON a.id=s.artikel 
              WHERE s.stuecklistevonartikel='$id'";


        $preis_max = $this->app->DB->Select($sql);

        $sql = "SELECT FORMAT(SUM(
            (SELECT MAX(v.preis) FROM verkaufspreise v WHERE v.artikel=s.artikel AND a.stueckliste=1 AND (v.objekt='Standard' OR v.objekt=''))*s.menge)
            ,2)
            FROM stueckliste s
            LEFT JOIN artikel a ON a.id=s.artikel
            WHERE s.stuecklistevonartikel='$id'";

        $preis_max = $preis_max + $this->app->DB->Select($sql);

        $sql = "SELECT FORMAT(SUM( 
            (SELECT MIN(e.preis) FROM einkaufspreise e WHERE e.artikel=s.artikel AND (e.objekt='Standard' OR e.objekt=''))*s.menge)
            ,2)
            FROM stueckliste s
            LEFT JOIN artikel a ON a.id=s.artikel 
            WHERE s.stuecklistevonartikel='$id'";

        $preis = $this->app->DB->Select($sql);
          $sql = "SELECT FORMAT(SUM(
            (SELECT MIN(v.preis) FROM verkaufspreise v WHERE v.artikel=s.artikel AND a.stueckliste=1 AND (v.objekt='Standard' OR v.objekt=''))*s.menge)
            ,2)
            FROM stueckliste s
            LEFT JOIN artikel a ON a.id=s.artikel
            WHERE s.stuecklistevonartikel='$id'";

        $preis = $preis + $this->app->DB->Select($sql);

        if($max) return $preis_max;
        else return $preis;
      }


      function uploadFileIntoDB($file)
      {
        // Wandelt ein Bild fuer einen LONGBLOB um
        $pfad = $file[tmp_name];

        $dbtype = mime_content_type($pfad);
        // Bild hochladen
        $filehandle = fopen($pfad,'r');
        $filedata = base64_encode(fread($filehandle, filesize($pfad)));
        return array("file"=>$filedata,"type"=>$dbtype);
      }

      // im format hh:mm
      function ZeitinMenge($zeit)
      {
        $zeit = explode(":", $zeit);

        $komma = round(100/(60/$zeit[1]),0);

        $komma = str_pad($komma, 2 ,'0', STR_PAD_LEFT);

        return $zeit[0].",".$komma;
      }       

      function get_time_difference($start_time_o, $end_time_o){
        $start_time = explode(":", $start_time_o);
        $end_time = explode(":", $end_time_o);

        $start_time_stamp = mktime($start_time[0], $start_time[1], 0, 0, 0, 0);
        $end_time_stamp = mktime($end_time[0], $end_time[1], 0, 0, 0, 0);

        $time_difference = $end_time_stamp - $start_time_stamp;

        return gmdate("H:i", $time_difference);  
      }

      function is_html($str){
        $html = array('A','ABBR','ACRONYM','ADDRESS','APPLET','AREA','B','BASE','BASEFONT','BDO','BIG','BLOCKQUOTE','BODY','BR','BUTTON','CAPTION','CENTER','CITE','CODE','COL','COLGROUP','DD','DEL','DFN','DIR','DIV','DL','DT','EM','FIELDSET','FONT','FORM','FRAME','FRAMESET','H1','H2','H3','H4','H5','H6','HEAD','HR','HTML','I','IFRAME','IMG','INPUT','INS','ISINDEX','KBD','LABEL','LEGEND','LI','LINK','MAP','MENU','META','NOFRAMES','NOSCRIPT','OBJECT','OL','OPTGROUP','OPTION','P','PARAM','PRE','Q','S','SAMP','SCRIPT','SELECT','SMALL','SPAN','STRIKE','STRONG','STYLE','SUB','SUP','TABLE','TBODY','TD','TEXTAREA','TFOOT','TH','THEAD','TITLE','TR','TT','U','UL','VAR');
        if(preg_match_all("~(<\/?)\b(".implode('|',$html).")\b([^>]*>)~i",$str,$c)){
          return TRUE;
        }else{
          return FALSE;
        }
      } 

      function ImportCreateLieferadresse($adresse,$data)
      {
        $this->app->DB->Insert("INSERT INTO lieferadressen (id,adresse) VALUES ('','$adresse')");
        $id = $this->app->DB->GetInsertID();

        if($data['land']=="") $data['land']='DE';

        foreach ($data as $key => $value) {
          $this->app->DB->Update("UPDATE lieferadressen SET $key='".$this->ConvertForDBUTF8($value)."' WHERE id='$id' LIMIT 1");
        }
        return $id;
      }

      function ImportCreateAnsprechpartner($adresse,$data)
      {
        $this->app->DB->Insert("INSERT INTO ansprechpartner (id,adresse) VALUES ('','$adresse')");
        $id = $this->app->DB->GetInsertID();

        if($data['land']=="") $data['land']='DE';

        foreach ($data as $key => $value) {
          $this->app->DB->Update("UPDATE ansprechpartner SET $key='".$this->ConvertForDBUTF8($value)."' WHERE id='$id' LIMIT 1");
        }
        return $id;
      }

      function ImportCreateAdresse($data, $uf8 = true)
      {
        $this->app->DB->Insert("INSERT INTO adresse (id) VALUES ('')");
        $id = $this->app->DB->GetInsertID();

        if($data['firma']=="") $data['firma']=1;
        if($data['projekt']=="") $data['projekt']=1;

        $columns = $this->app->DB->GetColArray("adresse"); 
        foreach ($columns as $keyi => $columnname) 
          $arr_columns[] = $columnname;


        foreach ($data as $key => $value) {
          if(in_array($key, $arr_columns))
          {
            if($tmp_fields!="") $tmp_fields .=",";
            if($uf8)
            {
              $tmp_fields .= " $key='".$this->ConvertForDBUTF8($value)."' ";
            } else {
              $tmp_fields .= " $key='".$value."' ";
            }
          }
        }
        $this->app->DB->Update("UPDATE adresse SET $tmp_fields WHERE id='$id'");
        return $id;
      }


      function ImportCreateArtikel($data, $utf8 = true)
      {
        $this->app->DB->Insert("INSERT INTO artikel (id) VALUES ('')");
        $id = $this->app->DB->GetInsertID();

        if($data['firma']=="") $data['firma']=1;
        if($data['projekt']=="") $data['projekt']=1;

        foreach ($data as $key => $value) {
          if($utf8)
          {
            $this->app->DB->Update("UPDATE artikel SET $key='".$this->ConvertForDBUTF8($value)."' WHERE id='$id' LIMIT 1");
          }else{
            $this->app->DB->Update("UPDATE artikel SET $key='".mysqli_real_escape_string($this->app->DB->connection, $value)."' WHERE id='$id' LIMIT 1");
          }
        }
        return $id;
      }

      // nicht mehr verwenden
      function ImportCreateEinkaufspreis($data) {
        $this->app->DB->Insert("INSERT INTO einkaufspreise (id) VALUES ('')");
        $id = $this->app->DB->GetInsertID();

        if($data['firma']=="") $data['firma']=1;
        if($data['projekt']=="") $data['projekt']=1;


        foreach ($data as $key => $value) {
          $this->app->DB->Update("UPDATE einkaufspreise SET $key='".$this->ConvertForDBUFT8($value)."' WHERE id='$id' LIMIT 1");
        }
        return $id;
      }

      // nicht mehr verwenden
      function ImportCreateVerkaufspreis($data) {
        $this->app->DB->Insert("INSERT INTO verkaufspreise (id) VALUES ('')");
        $id = $this->app->DB->GetInsertID();

        if($data['firma']=="") $data['firma']=1;
        if($data['projekt']=="") $data['projekt']=1;

        foreach ($data as $key => $value) {
          $this->app->DB->Update("UPDATE verkaufspreise SET $key='".$this->ConvertForDBUTF8($value)."' WHERE id='$id' LIMIT 1");
        }
        return $id;
      }

      function ImportCreateUser($data) {
        $this->app->DB->Insert("INSERT INTO user (id) VALUES ('')");
        $id = $this->app->DB->GetInsertID();

        if($data['firma']=="") $data['firma']=1;
        if($data['projekt']=="") $data['projekt']=1;

        foreach ($data as $key => $value) {
          $this->app->DB->Update("UPDATE user SET $key='".$this->ConvertForDBUTF8($value)."' WHERE id='$id' LIMIT 1");
        }
        return $id;
      }

      function ImportCreateRechnung($data) {
        $this->app->DB->Insert("INSERT INTO rechnung (id) VALUES ('')");
        $id = $this->app->DB->GetInsertID();

        if($data['firma']=="") $data['firma']=1;
        if($data['projekt']=="") $data['projekt']=1;

        foreach ($data as $key => $value) {
          $this->app->DB->Update("UPDATE rechnung SET $key='".$this->ConvertForDBUTF8($value)."' WHERE id='$id' LIMIT 1");
        }
        return $id;
      }


      function CheckArtikel($id)
      {
        $standardlieferant = $this->app->DB->Select("SELECT adresse FROM artikel WHERE id='$id' LIMIT 1");
        $standardlieferant_ek = $this->app->DB->Select("SELECT adresse FROM einkaufspreise WHERE artikel='$id' AND geloescht!=1 AND standard=1 LIMIT 1");
        if($standardlieferant <= 0 || ($standardlieferant_ek!=$standardlieferant && $standardlieferant > 0 && $standardlieferant_ek > 0))
        {
          $standardlieferant = $this->app->DB->Select("SELECT adresse FROM einkaufspreise WHERE artikel='$id' AND geloescht!=1 
              AND (gueltig_bis='0000-00-00' OR gueltig_bis >= NOW()) ORDER by standard DESC LIMIT 1");

          if($standardlieferant > 0)
          {
            $this->app->DB->Update("UPDATE artikel SET adresse='$standardlieferant' WHERE id='$id' LIMIT 1");
          }
        }
      }


      function FirmenDatenStandard()
      {

        if($this->app->DB->Select("SELECT COUNT(id) FROM firmendaten") > 0) return;

        $this->app->DB->Insert("INSERT INTO `firmendaten` (`id`, `firma`, `absender`, `sichtbar`, `barcode`, `schriftgroesse`, `betreffszeile`, `dokumententext`, `tabellenbeschriftung`, `tabelleninhalt`, `zeilenuntertext`, `freitext`, `infobox`, `spaltenbreite`, `footer_0_0`, `footer_0_1`, `footer_0_2`, `footer_0_3`, `footer_0_4`, `footer_0_5`, `footer_1_0`, `footer_1_1`, `footer_1_2`, `footer_1_3`, `footer_1_4`, `footer_1_5`, `footer_2_0`, `footer_2_1`, `footer_2_2`, `footer_2_3`, `footer_2_4`, `footer_2_5`, `footer_3_0`, `footer_3_1`, `footer_3_2`, `footer_3_3`, `footer_3_4`, `footer_3_5`, `footersichtbar`, `hintergrund`, `logo`, `logo_type`, `briefpapier`, `briefpapier_type`, `benutzername`, `passwort`, `host`, `port`, `mailssl`, `signatur`, `email`, `absendername`, `bcc1`, `bcc2`, `firmenfarbe`, `name`, `strasse`, `plz`, `ort`, `steuernummer`, `startseite_wiki`, `datum`, `projekt`, `brieftext`, `next_angebot`, `next_auftrag`, `next_gutschrift`, `next_lieferschein`, `next_bestellung`, `next_rechnung`, `next_kundennummer`, `next_lieferantennummer`, `next_mitarbeiternummer`, `next_waren`, `next_sonstiges`, `next_produktion`, `breite_position`, `breite_menge`, `breite_nummer`, `breite_einheit`, `skonto_ueberweisung_ueberziehen`, `steuersatz_normal`, `steuersatz_zwischen`, `steuersatz_ermaessigt`, `steuersatz_starkermaessigt`, `steuersatz_dienstleistung`, `kleinunternehmer`, `porto_berechnen`, `immernettorechnungen`, `schnellanlegen`, `bestellvorschlaggroessernull`, `versand_gelesen`, `versandart`, `zahlungsweise`, `zahlung_lastschrift_konditionen`, `breite_artikelbeschreibung`, `waehrung`, `footer_breite1`, `footer_breite2`, `footer_breite3`, `footer_breite4`, `boxausrichtung`, `lizenz`, `schluessel`, `branch`, `version`, `standard_datensaetze_datatables`, `auftrag_bezeichnung_vertrieb`, `auftrag_bezeichnung_bearbeiter`, `auftrag_bezeichnung_bestellnummer`, `bezeichnungkundennummer`, `bezeichnungstornorechnung`, `bestellungohnepreis`, `mysql55`, `rechnung_gutschrift_ansprechpartner`, `api_initkey`, `api_remotedomain`, `api_eventurl`, `api_enable`, `api_importwarteschlange`, `api_importwarteschlange_name`, `wareneingang_zwischenlager`, `modul_mlm`, `modul_verband`, `modul_mhd`, `mhd_warnung_tage`, `mlm_mindestbetrag`, `mlm_anzahlmonate`, `mlm_letzter_tag`, `mlm_erster_tag`, `mlm_letzte_berechnung`, `mlm_01`, `mlm_02`, `mlm_03`, `mlm_04`, `mlm_05`, `mlm_06`, `mlm_07`, `mlm_08`, `mlm_09`, `mlm_10`, `mlm_11`, `mlm_12`, `mlm_13`, `mlm_14`, `mlm_15`, `mlm_01_punkte`, `mlm_02_punkte`, `mlm_03_punkte`, `mlm_04_punkte`, `mlm_05_punkte`, `mlm_06_punkte`, `mlm_07_punkte`, `mlm_08_punkte`, `mlm_09_punkte`, `mlm_10_punkte`, `mlm_11_punkte`, `mlm_12_punkte`, `mlm_13_punkte`, `mlm_14_punkte`, `mlm_15_punkte`, `mlm_01_mindestumsatz`, `mlm_02_mindestumsatz`, `mlm_03_mindestumsatz`, `mlm_04_mindestumsatz`, `mlm_05_mindestumsatz`, `mlm_06_mindestumsatz`, `mlm_07_mindestumsatz`, `mlm_08_mindestumsatz`, `mlm_09_mindestumsatz`, `mlm_10_mindestumsatz`, `mlm_11_mindestumsatz`, `mlm_12_mindestumsatz`, `mlm_13_mindestumsatz`, `mlm_14_mindestumsatz`, `mlm_15_mindestumsatz`, `standardaufloesung`, `standardversanddrucker`, `standardetikettendrucker`, `externereinkauf`, `schriftart`, `knickfalz`, `artikeleinheit`, `artikeleinheit_standard`, `abstand_name_beschreibung`, `abstand_boxrechtsoben_lr`, `zahlungszieltage`, `zahlungszielskonto`, `zahlungszieltageskonto`, `zahlung_rechnung`, `zahlung_vorkasse`, `zahlung_nachnahme`, `zahlung_kreditkarte`, `zahlung_paypal`, `zahlung_bar`, `zahlung_lastschrift`, `zahlung_amazon`, `zahlung_ratenzahlung`, `zahlung_rechnung_sofort_de`, `zahlung_rechnung_de`, `zahlung_vorkasse_de`, `zahlung_lastschrift_de`, `zahlung_nachnahme_de`, `zahlung_bar_de`, `zahlung_paypal_de`, `zahlung_amazon_de`, `zahlung_kreditkarte_de`, `zahlung_ratenzahlung_de`, `briefpapier2`, `briefpapier2vorhanden`, `artikel_suche_kurztext`, `adresse_freitext1_suche`, `warnung_doppelte_nummern`, `next_arbeitsnachweis`, `next_reisekosten`, `next_anfrage`, `seite_von_ausrichtung`, `seite_von_sichtbar`, `parameterundfreifelder`, `freifeld1`, `freifeld2`, `freifeld3`, `freifeld4`, `freifeld5`, `freifeld6`, `firmenfarbehell`, `firmenfarbedunkel`, `firmenfarbeganzdunkel`, `navigationfarbe`, `navigationfarbeschrift`, `unternavigationfarbe`, `unternavigationfarbeschrift`, `firmenlogo`, `firmenlogotype`, `firmenlogoaktiv`, `projektnummerimdokument`, `mailanstellesmtp`, `herstellernummerimdokument`, `standardmarge`, `steuer_erloese_inland_normal`, `steuer_aufwendung_inland_normal`, `steuer_erloese_inland_ermaessigt`, `steuer_aufwendung_inland_ermaessigt`, `steuer_erloese_inland_steuerfrei`, `steuer_aufwendung_inland_steuerfrei`, `steuer_erloese_inland_innergemeinschaftlich`, `steuer_aufwendung_inland_innergemeinschaftlich`, `steuer_erloese_inland_eunormal`, `steuer_aufwendung_inland_eunormal`, `steuer_erloese_inland_export`, `steuer_aufwendung_inland_import`, `steuer_anpassung_kundennummer`, `steuer_art_1`, `steuer_art_1_normal`, `steuer_art_1_ermaessigt`, `steuer_art_1_steuerfrei`, `steuer_art_2`, `steuer_art_2_normal`, `steuer_art_2_ermaessigt`, `steuer_art_2_steuerfrei`, `steuer_art_3`, `steuer_art_3_normal`, `steuer_art_3_ermaessigt`, `steuer_art_3_steuerfrei`, `steuer_art_4`, `steuer_art_4_normal`, `steuer_art_4_ermaessigt`, `steuer_art_4_steuerfrei`, `steuer_art_5`, `steuer_art_5_normal`, `steuer_art_5_ermaessigt`, `steuer_art_5_steuerfrei`, `steuer_art_6`, `steuer_art_6_normal`, `steuer_art_6_ermaessigt`, `steuer_art_6_steuerfrei`, `steuer_art_7`, `steuer_art_7_normal`, `steuer_art_7_ermaessigt`, `steuer_art_7_steuerfrei`, `steuer_art_8`, `steuer_art_8_normal`, `steuer_art_8_ermaessigt`, `steuer_art_8_steuerfrei`, `steuer_art_9`, `steuer_art_9_normal`, `steuer_art_9_ermaessigt`, `steuer_art_9_steuerfrei`, `steuer_art_10`, `steuer_art_10_normal`, `steuer_art_10_ermaessigt`, `steuer_art_10_steuerfrei`, `steuer_art_11`, `steuer_art_11_normal`, `steuer_art_11_ermaessigt`, `steuer_art_11_steuerfrei`, `steuer_art_12`, `steuer_art_12_normal`, `steuer_art_12_ermaessigt`, `steuer_art_12_steuerfrei`, `steuer_art_13`, `steuer_art_13_normal`, `steuer_art_13_ermaessigt`, `steuer_art_13_steuerfrei`, `steuer_art_14`, `steuer_art_14_normal`, `steuer_art_14_ermaessigt`, `steuer_art_14_steuerfrei`, `steuer_art_15`, `steuer_art_15_normal`, `steuer_art_15_ermaessigt`, `steuer_art_15_steuerfrei`, `rechnung_header`, `lieferschein_header`, `angebot_header`, `auftrag_header`, `gutschrift_header`, `bestellung_header`, `arbeitsnachweis_header`, `provisionsgutschrift_header`, `rechnung_footer`, `lieferschein_footer`, `angebot_footer`, `auftrag_footer`, `gutschrift_footer`, `bestellung_footer`, `arbeitsnachweis_footer`, `provisionsgutschrift_footer`, `rechnung_ohnebriefpapier`, `lieferschein_ohnebriefpapier`, `angebot_ohnebriefpapier`, `auftrag_ohnebriefpapier`, `gutschrift_ohnebriefpapier`, `bestellung_ohnebriefpapier`, `arbeitsnachweis_ohnebriefpapier`, `eu_lieferung_vermerk`, `export_lieferung_vermerk`, `abstand_adresszeileoben`, `abstand_boxrechtsoben`, `abstand_betreffzeileoben`, `abstand_artikeltabelleoben`, `wareneingang_kamera_waage`, `layout_iconbar`) VALUES
            (1, 1, 'Musterfirma GmbH | Musterweg 5 | 12345 Musterstadt', 1, 1, 7, 9, 9, 9, 9, 7, 9, 8, 0, 'Sitz der Gesellschaft / Lieferanschrift', 'Musterfirma GmbH', 'Musterweg 5', 'D-12345 Musterstadt', 'Telefon +49 123 12 34 56 7', 'Telefax +49 123 12 34 56 78', 'Bankverbindung', 'Musterbank', 'Konto 123456789', 'BLZ 72012345', '', '', 'IBAN DE1234567891234567891', 'BIC/SWIFT DETSGDBWEMN', 'Ust-IDNr. DE123456789', 'E-Mail: info@musterfirma-gmbh.de', 'Internet: http://www.musterfirma.de', '', 'Geschäftsführer', 'Max Musterman', 'Handelsregister: HRB 12345', 'Amtsgericht: Musterstadt', '', '', 0, 'kein', '', '', '', '', 'musterman', 'passwort', 'smtp.server.de', '25', 1, 'LS0NCk11c3RlcmZpcm1hIEdtYkgNCk11c3RlcndlZyA1DQpELTEyMzQ1IE11c3RlcnN0YWR0DQoNClRlbCArNDkgMTIzIDEyIDM0IDU2IDcNCkZheCArNDkgMTIzIDEyIDM0IDU2IDc4DQoNCk5hbWUgZGVyIEdlc2VsbHNjaGFmdDogTXVzdGVyZmlybWEgR21iSA0KU2l0eiBkZXIgR2VzZWxsc2NoYWZ0OiBNdXN0ZXJzdGFkdA0KDQpIYW5kZWxzcmVnaXN0ZXI6IE11c3RlcnN0YWR0LCBIUkIgMTIzNDUNCkdlc2Now6RmdHNmw7xocnVuZzogTWF4IE11c3Rlcm1hbg0KVVN0LUlkTnIuOiBERTEyMzQ1Njc4OQ0KDQpBR0I6IGh0dHA6Ly93d3cubXVzdGVyZmlybWEuZGUvDQo=', 'info@server.de', 'Meine Firma', '', '', '', 'Musterfirma GmbH', 'Musterweg 5', '12345', 'Musterstadt', '111/11111/11111', '', '0000-00-00 00:00:00', 0, '11', '', '', '', '', '', '', '', '', '', '', '', '', 10, 10, 20, 15, 0, 19.00, 7.00, 7.00, 7.00, 7.00, 0, 0, 0, 1, 0, 0, 'versandunternehmen', 'rechnung', 0, 1, 'EUR', 0, 0, 0, 0, '', '', '', '', '', 0, 'Vertrieb', 'Bearbeiter', 'Ihre Bestellnummer', 'Kundennummer', 'Stornorechnung', 0, 1, 0, '', '', '', 0, 0, '', 0, 0, 0, 0, 3, 50.00, 11, NULL, NULL, NULL, 15.00, 20.00, 28.00, 32.00, 36.00, 40.00, 44.00, 44.00, 44.00, 44.00, 50.00, 54.00, 45.00, 48.00, 60.00, 2999, 3000, 5000, 10000, 15000, 25000, 50000, 100000, 150000, 200000, 250000, 300000, 350000, 400000, 450000, 50, 50, 50, 50, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 14, 2, 10, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Rechnung zahlbar sofort.', 'Rechnung zahlbar innerhalb {ZAHLUNGSZIELTAGE} Tage bis zum {ZAHLUNGBISDATUM}.', '', '', '', '', '', '', '', '', NULL, 0, 0, 0, 0, NULL, NULL, NULL, 'R', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 30, '4400', '5400', '4300', '', '', '', '4125', '5425', '4315', '', '4120', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Sehr geehrte Damen und Herren,\r\n\r\nanbei Ihre Rechnung.', 'Sehr geehrte Damen und Herren,\r\n\r\nwir liefern Ihnen:', 'Sehr geehrte Damen und Herren,\r\n\r\nhiermit bieten wir Ihnen an:', 'Sehr geehrte Damen und Herren,\r\n\r\nvielen Dank für Ihren Auftrag.', 'Sehr geehrte Damen und Herren,\r\n\r\nanbei Ihre {ART}:', 'Sehr geehrte Damen und Herren,\r\n\r\nwir bestellen hiermit:', 'Sehr geehrte Damen und Herren,\r\n\r\nwir liefern Ihnen:', '', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', '', 0, 0, 0, 0, 0, 0, 0, 'Steuerfrei nach § 4 Nr. 1b i.V.m. § 6 a UStG. Ihre USt-IdNr. {USTID} Land: {LAND}', '', 0, 0, 0, 0, 0, 0);");
      }       
  
  function pruefeDBgen($echo = false)
  {
    $dir = dirname(__FILE__).'/../objectapi/mysql/_gen';
    if(file_exists($dir)) 
    {
      if ($handle = opendir($dir)) {
        while (false !== ($entry = readdir($handle)))
        {
          if(strpos($entry, 'object.gen.') !== false)
          {
            $table = str_replace('.php','',str_replace('object.gen.','',$entry));
            $Felder = $this->app->DB->SelectArr("Describe ".addslashes($table));
            if(true)
            {
              if(isset($class_methods))unset($class_methods);
              if($fh = fopen($dir.'/'.$entry, 'r'))
              {
                $classfound = false;
                $fertig = false;
          
                while(!$fertig && $line = fgets($fh))
                {
                  
                  if($classfound)
                  {
               
                    if(strpos($line, '=') !== false)
                    {
                   
                      $funktion = trim(substr($line, 0,strpos($line, '=')));
                      $class_methods[] = str_replace(';','',$funktion);
                    }
                    elseif(strpos($line, '$this->app->DB->Update') !== false)
                    {
                      
                      $fertig = true;
                    }                
                  } else {
                    if(strpos($line,'$sql = "UPDATE') !== false)
                    {
                      
                      $classfound = true;
                    }
                  }
                  
                  
                  
                }
                fclose($fh);
                
              }
              
              
              $class = 'ObjGen'.ucfirst($table);
            }
            if($Felder) {
              //if(!class_exists($class)) include_once($dir.'/'.$entry);
              
              //$tmp = ;
              //if(class_exists($class)){
              if($classfound && isset($class_methods))
              {
                //$class_methods = get_class_methods(new $class($this->app));
                //$class_methods = get_class_methods($class);
                //echo "Class: ".$class."\r\n";
                foreach($class_methods as $key => $val)
                {
                  if(strpos($val,'Get') !== false)
                  {
                    $found = false;
                    foreach($Felder as $k => $v)
                    {
                      if('get'.strtolower($v['Field']) == strtolower($val))$found = true;
                    }
                    if(!$found)$Feldnichtgefunden[$table][] = $val;
                      //echo "Feld ".substr($val,3)." nicht gefunden\r\n";
                    
                  }
                  
                }
                foreach($Felder as $k => $v)
                {
                  if($v['Field'] != 'id'){
                    $found = false;
                    foreach($class_methods as $key => $val)
                    {
                      if(strtolower($v['Field']) == strtolower($val))$found = true;
                    }
                    if(!$found)$keineFunktion[$table][] = $v['Field'];
                  }
                }                
              }
              
            } else {
              if($classfound && isset($class_methods))
                $tablenotfound[] = $table;
              
            }
            
            $ret = false;
            if(isset($tablenotfound))$ret['tablenotfound'] = $tablenotfound;
            if(isset($Feldnichtgefunden))$ret['FeldernichtinDatenbank'] = $Feldnichtgefunden;
            if(isset($keineFunktion))$ret['FeldernichtinGen'] = $keineFunktion;
            if($echo)
            {
              if($ret){
                print_r($ret);
              }else{
                echo "Alles OK";
              }
            }
            return $ret;
            
          }
          
          
          
        }
        return false;
      }
    }
  }
  
  function pdfmirrorZuArchiv($id)
  {
    $checkmirror = $this->app->DB->SelectArr("SELECT p.* FROM pdfmirror_md5pool p WHERE id = '$id' LIMIT 1");
    if($checkmirror)
    {
      $filegroup = @filegroup($this->app->Conf->WFuserdata);
      $fileowner = @fileowner($this->app->Conf->WFuserdata);
      $checkmirror = reset($checkmirror);
      $dir = $this->app->Conf->WFuserdata."/pdfmirror/".$this->app->Conf->WFdbname."/".$checkmirror['table_name'];
      $dir_archiv = $this->app->Conf->WFuserdata."/pdfarchiv/".$this->app->Conf->WFdbname."/".$checkmirror['table_name'];
      if(!is_dir($dir))
      {
        //echo "Ordner ".$dir." nicht gefunden\r\n";
        return false;
      }
      
      $vars = glob($dir."/".($checkmirror['checksum']?$checkmirror['checksum'].'_':'').$checkmirror['table_id'].'_*.pdf');
      if(!$vars)
      {
        //echo "Datei ".$dir."/".($checkmirror['checksum']?$checkmirror['checksum'].'_':'').$checkmirror['table_id'].'_*.pdf'." nicht gefunden\r\n";
        return false;
      }
      
      $path_parts = pathinfo($vars[0]);

      $datei = $path_parts['basename'];
      $dateia = explode('_', $path_parts['filename'],($checkmirror['checksum']?4:3));
      $belegnummer = $dateia[($checkmirror['checksum']?3:2)];
      if(strlen($belegnummer) < 3 && !is_numeric($belegnummer))
      {
        $belegnr = $this->app->DB->Select("SELECT belegnr FROM ".$this->app->DB->real_escape_string(strtolower($checkmirror['table_name']))." WHERE id = '".$checkmirror['table_id']."' LIMIT 1");
        if($belegnr)$belegnummer.=$belegnr;
        
      }
      
      $datum = $dateia[($checkmirror['checksum']?2:1)];
      if(strlen($datum) == 8) 
      {
        $datum = $datum[6].$datum[7].'.'.$datum[4].$datum[5].'.'.$datum[0].$datum[1].$datum[2].$datum[3];
      }else{
        $datum = '';
      }
      $doctyporig = $belegnummer.($datum?' von '.$datum:'');
      
      if(!file_exists($dir."/".$checkmirror['checksum'].'_'.$checkmirror['table_id']))
      if(!is_dir($this->app->Conf->WFuserdata."/pdfarchiv"))
      {
        mkdir($this->app->Conf->WFuserdata."/pdfarchiv",0700);
        if($fileowner && $fileowner != fileowner($this->app->Conf->WFuserdata."/pdfarchiv"))chown($this->app->Conf->WFuserdata."/pdfarchiv", $fileowner);
        if($filegroup && $filegroup != filegroup($this->app->Conf->WFuserdata."/pdfarchiv"))chgrp($this->app->Conf->WFuserdata."/pdfarchiv", $filegroup);
        
      }
      if(!is_dir($dir_archiv))
      {
        if(!mkdir($dir_archiv, 0700))
        {
          //echo "Konnte ".$dir_archiv." nicht erstellen\r\n";
          return false;
        } else {
          if($fileowner && $fileowner != fileowner($dir_archiv))chown($dir_archiv, $fileowner);
          if($filegroup && $filegroup != filegroup($dir_archiv))chgrp($dir_archiv, $filegroup);
        }
      }
      if(!copy($dir."/".$datei, $dir_archiv."/".$datei))
      {
        //echo "Kopieren von ".$dir."/".$datei." nach ".$dir_archiv."/".$datei." fehlgeschlagen\r\n";
        return false;
      } else {
        /*
        if($fileowner && $fileowner != fileowner($dir_archiv."/".$datei))chown($dir_archiv."/".$datei, $fileowner);
        if($filegroup && $filegroup != filegroup($dir_archiv."/".$datei))chgrp($dir_archiv."/".$datei, $filegroup);        */
      }
          
      $this->app->DB->Insert("INSERT INTO pdfarchiv (zeitstempel,checksum, table_id, table_name, bearbeiter, erstesoriginal, dateiname,doctypeorig, belegnummer)
      values ('".$checkmirror['zeitstempel']."','".$this->app->DB->real_escape_string($checkmirror['checksum'])."','".$this->app->DB->real_escape_string($checkmirror['table_id'])."','".$this->app->DB->real_escape_string($checkmirror['table_name'])."','".$this->app->DB->real_escape_string($checkmirror['bearbeiter'])."','".$checkmirror['erstesoriginal']."',
      
      '".$datei."','".$this->app->DB->real_escape_string($doctyporig)."','".$this->app->DB->real_escape_string($belegnummer)."')
      
      ");
      if(mysqli_error($this->app->DB->connection))die("INSERT INTO pdfarchiv (zeitstempel,checksum, table_id, table_name, bearbeiter, erstesoriginal, dateiname,doctypeorig, belegnummer)
      values ('".$checkmirror['zeitstempel']."','".$this->app->DB->real_escape_string($checkmirror['checksum'])."','".$this->app->DB->real_escape_string($checkmirror['table_id'])."','".$this->app->DB->real_escape_string($checkmirror['table_name'])."','".$this->app->DB->real_escape_string($checkmirror['bearbeiter'])."','".$checkmirror['erstesoriginal']."',
      
      '".$datei."','".$this->app->DB->real_escape_string($doctyporig)."','".$this->app->DB->real_escape_string($belegnummer)."')
      
      ");
      $newid = $this->app->DB->GetInsertID();
      if($newid)$this->app->DB->Update("UPDATE pdfmirror_md5pool set pdfarchiv_id = '$newid' WHERE id = '$id' LIMIT 1");
      return $newid;
    } else {
      //echo $id." nicht gefunden\r\n";
    }
    return false;
  }
  
  
}


function parse_csv($str,$parse_split_parameter="")
{
  global $parse_split;
  if($parse_split_parameter!="") $parse_split=$parse_split_parameter;
  //match all the non-quoted text and one series of quoted text (or the end of the string)
  //each group of matches will be parsed with the callback, with $matches[1] containing all the non-quoted text,
  //and $matches[3] containing everything inside the quotes
  $str = preg_replace_callback('/([^"]*)("((""|[^"])*)"|$)/s', 'parse_csv_quotes', $str);

        //remove the very last newline to prevent a 0-field array for the last line
        $str = preg_replace('/\n$/', '', $str);

        //split on LF and parse each line with a callback
        return array_map('parse_csv_line', explode("\n", $str));
        }

        //replace all the csv-special characters inside double quotes with markers using an escape sequence
        function parse_csv_quotes($matches)
        {
        global $parse_split;
        if($parse_split=="") $parse_split=";";
        //anything inside the quotes that might be used to split the string into lines and fields later,
        //needs to be quoted. The only character we can guarantee as safe to use, because it will never appear in the unquoted text, is a CR
        //So we're going to use CR as a marker to make escape sequences for CR, LF, Quotes, and Commas.
        $str = str_replace("\r", "\rR", $matches[3]);
        $str = str_replace("\n", "\rN", $str);
        $str = str_replace('""', "\rQ", $str);
        $str = str_replace($parse_split, "\rC", $str);

        //The unquoted text is where commas and newlines are allowed, and where the splits will happen
        //We're going to remove all CRs from the unquoted text, by normalizing all line endings to just LF
        //This ensures us that the only place CR is used, is as the escape sequences for quoted text
        return preg_replace('/\r\n?/', "\n", $matches[1]) . $str;
        }

//split on comma and parse each field with a callback
function parse_csv_line($line)
{
  global $parse_split;
  if($parse_split=="") $parse_split=";";
  return array_map('parse_csv_field', explode($parse_split, $line));
}

//restore any csv-special characters that are part of the data
function parse_csv_field($field) {
  global $parse_split;
  if($parse_split=="") $parse_split=";";
  $field = str_replace("\rC", $parse_split, $field);
  $field = str_replace("\rQ", '"', $field);
  $field = str_replace("\rN", "\n", $field);
  $field = str_replace("\rR", "\r", $field);
  return $field;
}


function code2utf($num)
{
  if ($num < 128) return chr($num);
  if ($num < 2048) return chr(($num >> 6) + 192) . chr(($num &
        63) + 128);
  if ($num < 65536) return chr(($num >> 12) + 224) .
    chr((($num >> 6) & 63) + 128) . chr(($num & 63) + 128);
  if ($num < 2097152) return chr(($num >> 18) + 240) .
    chr((($num >> 12) & 63) + 128) . chr((($num >> 6) & 63) + 128) . chr(($num
          & 63) + 128);
  return '';
}



?>
