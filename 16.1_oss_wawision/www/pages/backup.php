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

class Backup  {
  var $app;

  function Backup($app) 
  {
    $this->app=&$app;

    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
      $this->app->Tpl->Set(SUBHEADING,": ".$this->app->DB->Select("SELECT nummer FROM artikel WHERE id=$id LIMIT 1"));

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","BackupList");
    $this->app->ActionHandler("create","BackupCreate");
    $this->app->ActionHandler("download","BackupDownload");
    $this->app->ActionHandler("downloadsnapshot","BackupDownloadSnapshot");
    $this->app->ActionHandler("full","BackupFull");
    $this->app->ActionHandler("makefull","BackupMakeFull");
    $this->app->ActionHandler("delete","BackupDelete");
    $this->app->ActionHandler("recover","BackupRecover");
    $this->app->ActionHandler("reset","BackupReset");
    $this->app->ActionHandler("import","BackupImport");

    $this->host = $this->app->Conf->WFdbhost;
    $this->database = $this->app->Conf->WFdbname;
    $this->user = $this->app->Conf->WFdbuser;
    $this->password = $this->app->Conf->WFdbpass;
    $this->pfad = "../backup/snapshots/";

    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }

  function BackupMenu()
  {
    $this->app->erp->MenuEintrag("index.php?module=backup&action=create", "DB-Snapshot anlegen");
    $this->app->erp->MenuEintrag("index.php?module=backup&action=download", "DB-Backup herunterladen");
    $this->app->erp->MenuEintrag("index.php?module=backup&action=full", "System-Backup herunterladen");
    //$this->app->erp->MenuEintrag("index.php?module=backup&action=reset", "Datenbank zur&uuml;cksetzen");
    $this->app->erp->MenuEintrag("index.php?module=backup&action=list", "Zur&uuml;ck zur &Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=backup&action=import", "Datenbank Importieren");
  }

  function BackupList()
  {
    $this->BackupMenu();
    $this->app->Tpl->Set(UEBERSCHRIFT,"Backup");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Backup");

    $msg = base64_decode($this->app->Secure->GET["msg"]);
    $this->app->Tpl->Set(MESSAGE, $msg);

    $this->app->YUI->TableSearch(TAB1,"backuplist");

    $this->app->Tpl->Set(TABTEXT,"Backup");
    $this->app->Tpl->Parse(PAGE,"tabview.tpl");

  }

  function BackupCreate()
  {
    $this->BackupMenu();
    $this->app->Tpl->Set(UEBERSCHRIFT,"DB-Backup anlegen");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"DB-Backup anlegen");

    $this->app->erp->MenuEintrag("index.php?module=backup&action=list", "Zur&uuml;ck zur &Uuml;bersicht");

    $name = $this->app->Secure->GetPOST("name");
    $submit = $this->app->Secure->GetPOST("submit");

    if($submit!="")
    {
      if($name!="")
      {
        $adresse = $this->app->User->GetAdresse();
        $name = preg_replace("/[^a-zA-Z0-9_]/" , "" , $name);
        $dateiname = date("Y-m-d_").$name.".sql";
        $pfad = $this->pfad.$dateiname;

        $exists = $this->app->DB->Select("SELECT '1' FROM backup WHERE dateiname='$dateiname' LIMIT 1");

        // puefe ob es pad gibt
        if(!is_dir($this->pfad)) mkdir($this->pfad,0777,true);

        if($exists=='1')
          $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Ein Backup mit diesem Namen existiert bereits.</div>");
        else if (!is_dir($this->pfad))
          $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Der Snapshot Ordner kann nicht anleget werden.</div>");
        else
        {
          $this->app->DB->Insert("INSERT INTO backup (adresse, name, dateiname, datum) VALUES ('$adresse','$name','$dateiname',NOW())");

          //Erstelle Backup
          system("mysqldump {$this->database} --no-create-db -h{$this->host} -u{$this->user} -p{$this->password} > $pfad");

          $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Das Datenbank-Backup wurde erfolgreich erstellt.</div>");
          header("Location: ./index.php?module=backup&action=list&msg=$msg");
          exit;
        }
      }else
        $this->app->Tpl->Set(MESSAGE, "<div class=\"error\">Sie m&uuml;ssen einen Namen f&uuml;r das Datenbank-Backup eingeben.</div>");				
    } 

    $this->app->Tpl->Parse(TAB1,"backup_create.tpl");
    $this->app->Tpl->Set(TABTEXT,"DB-Backup anlegen");
    $this->app->Tpl->Parse(PAGE,"tabview.tpl");
  }

  function BackupDownload()
  {
    $name = date("Y-m-d_")."DB-Backup.sql";
    $pfad = $this->pfad.$name;

    // Pfad anlegen falls er nicht existiert
    if(!is_dir($this->pfad)) {
      mkdir($this->pfad,0777,true);
    }

    //Erstelle Backup
    system("mysqldump {$this->database} --no-create-db -h{$this->host} -u{$this->user} -p{$this->password} > $pfad");

    // Daten als download raushauen
    header("Content-Disposition: attachment; filename=$name");
    readfile($pfad); //readfile will stream the file.
    system("rm $pfad");
    exit;

  }

  function BackupFull()
  {
    $this->BackupMenu();
    $this->app->erp->MenuEintrag("index.php?module=backup&action=list", "Zur&uuml;ck zur &Uuml;bersicht");

    $this->app->Tpl->Parse(PAGE,"backup_full.tpl");
  }

  function BackupMakeFull()
  {
    $this->BackupMenu();
    $name = date("Ymd")."_WAWISION_SYSTEMBACKUP";
    $pfad = $this->pfad.$name;

    //BENE WFBackupTMP
    if($this->app->Conf->WFBackupTMP!="")
    
      $pfad = rtrim($this->app->Conf->WFBackupTMP,"/")."/".$name;

    // Pfad anlegen falls er nicht existiert
    if(!is_dir($pfad)) mkdir($pfad,0777,true);

    //Erstelle Backup
    system("mysqldump {$this->database} --no-create-db -h{$this->host} -u{$this->user} -p{$this->password} > $pfad/".date("Y-m-d_")."Datenbank.sql");

    // Kopiere userdata
    system("cp -R ../userdata $pfad");

    // erzeuge tar
    system("tar cfz ".$pfad.".tar.gz $pfad/ $1>/dev/null");

    // Backup-Datei wieder loeschen
    system("rm -R $pfad");

    
    $size = filesize("$pfad.tar.gz");
    $name = rawurldecode($name.".tar.gz");
    $mime_type="application/force-download";



    //@ob_end_clean(); //turn off output buffering to decrease cpu usage

    // required for IE, otherwise Content-Disposition may be ignored
    if(ini_get('zlib.output_compression'))
    ini_set('zlib.output_compression', 'Off');

    header('Content-Type: ' . $mime_type);
    header('Content-Disposition: attachment; filename="'.$name.'"');
    header("Content-Transfer-Encoding: binary");
    header('Accept-Ranges: bytes');


    header("Cache-control: private");
    header('Pragma: private');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

    // multipart-download and download resuming support
    if(isset($_SERVER['HTTP_RANGE']))
    {
      list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
      list($range) = explode(",",$range,2);
      list($range, $range_end) = explode("-", $range);
      $range=intval($range);
      if(!$range_end) {
        $range_end=$size-1;
      } else {
        $range_end=intval($range_end);
      }

      $new_length = $range_end-$range+1;
      header("HTTP/1.1 206 Partial Content");
      header("Content-Length: $new_length");
      header("Content-Range: bytes $range-$range_end/$size");
    } else {
      $new_length=$size;
      header("Content-Length: ".$size);
    }


    $chunksize = 1*(1024*1024); //you may want to change this
    $bytes_send = 0;
    if ($file = fopen("$pfad.tar.gz", 'r'))
    {
      if(isset($_SERVER['HTTP_RANGE']))
        fseek($file, $range);

      while(!feof($file) && 
      (!connection_aborted()) && 
      ($bytes_send<$new_length)
      )
      {
        $buffer = fread($file, $chunksize);
        print($buffer); //echo($buffer); // is also possible
        flush();
        $bytes_send += strlen($buffer);
      }
      fclose($file);
    }
    system("rm $pfad.tar.gz");
    exit;
    
    
    
    /*
       header("Content-Description: File Transfer");
       header("Content-Type: application/otrkey");    
       header("Content-Length: " . filesize("$pfad.tar")); 
       header("Content-Disposition: attachment; filename=$name.tar;");
       header("Content-Transfer-Encoding: binary"); 
       readfile("$pfad.tar");
     */

    /*define('MP_BOUNDARY', '--'.sha1(microtime(true)));
    header('Content-Type: multipart/x-mixed-replace; boundary="'.MP_BOUNDARY.'"');
    flush();

    echo "Content-Type: application/otrkey\r\n";
    echo "Content-Length: ".filesize("$pfad.tar.gz")."\r\n"; 
    echo "Content-Disposition: attachment; filename=$name.tar.gz\r\n";
    echo "\r\n";
    readfile("$pfad.tar.gz");
    echo MP_BOUNDARY;
    flush();

    //system("rm $pfad.tar.gz");

    echo "Content-Type: text/html\r\n";
    echo "\r\n";
    echo '<html><script type="text/javascript">parent.location.href="./index.php?module=backup&action=list";</script></html>';
    echo MP_BOUNDARY.'--';
    flush();*/
  }	

  function BackupDelete()
  {
    $id = $this->app->Secure->GetGET("id");

    $error = false;

    if(is_numeric($id))
    {	
      $dateiname = $this->app->DB->Select("SELECT dateiname FROM backup WHERE id='$id' LIMIT 1");

      if($dateiname!="")
      {
        $pfad = $this->pfad.$dateiname;
        system("rm $pfad");

        $this->app->DB->Delete("DELETE FROM backup WHERE id='$id' LIMIT 1");
        $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Das Backup wurde erfolgreich gel&ouml;scht.</div>");
      }else
        $error = true;

    }else
      $error = true;

    if($error)
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Das Backup konnte nicht gel&ouml;scht werden.</div>");

    header("Location: ./index.php?module=backup&action=list&msg=$msg");
    exit;
  }

  function BackupDownloadSnapshot()
  {
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    {
      $dateiname = $this->app->DB->Select("SELECT dateiname FROM backup WHERE id='$id' LIMIT 1");
      $pfad = $this->pfad.$dateiname;			
      if(file_exists($pfad))
      {
        header("Content-Disposition: attachment; filename=$dateiname");
        readfile($pfad); //readfile will stream the file.
        exit;
      } else {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Die passende Snapshot Datei konnte nicht gefunden werden!</div>");
        header("Location: ./index.php?module=backup&action=list&msg=$msg");
      }
    }
  }

  function BackupRecover()
  {
    $id = $this->app->Secure->GetGET("id");

    if(is_numeric($id))
    {
      $dateiname = $this->app->DB->Select("SELECT dateiname FROM backup WHERE id='$id' LIMIT 1");
      $pfad = $this->pfad.$dateiname;			

      if(file_exists($pfad))
      {
        // Backup-Tabelle extra sichern
        system("mysqldump --no-create-db -h{$this->host} -u{$this->user} -p{$this->password} {$this->database} backup > {$this->pfad}backup_temp.sql");

        //Backup einspielen
        system("mysql -h{$this->host} -u{$this->user} -p{$this->password} -D{$this->database} < $pfad");

        // gesicherte Backup-Tabelle einspielen
        system("mysql -h{$this->host} -u{$this->user} -p{$this->password} -D{$this->database} < {$this->pfad}backup_temp.sql");

        // Backup-Tabelle loeschen
        system("rm {$this->pfad}backup_temp.sql");

        // Benutzer soll angemeldet bleiben
        $session = session_id();
        $user_id = $this->app->User->GetID();
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->app->DB->Update("UPDATE useronline SET login='0' WHERE user_id='$user_id'");
        $this->app->DB->Insert("INSERT INTO useronline (user_id, login, sessionid, ip, time)
            VALUES ('$user_id', '1', '$session', '$ip', NOW())");

        $this->app->erp->UpgradeDatabase();

        $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Das Backup wurde erfolgreich wiederhergestellt</div>");
      }else
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">'$dateiname' konnte nicht gefunden werden.</div>");
    }else
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Backup-ID konnte nicht gefunden werden.</div>");

    header("Location: ./index.php?module=backup&action=list&msg=$msg");
    exit;
  }

  function BackupImport()
  {
    $submit = $this->app->Secure->GetPOST("submit");


    $this->BackupMenu();
    $pfad = $_FILES["import"]["tmp_name"];
    if($submit!="")
    {    
      if(file_exists($pfad))
      {
        // Backup-Tabelle extra sichern
        system("mysqldump --no-create-db -h{$this->host} -u{$this->user} -p{$this->password} {$this->database} backup > {$this->pfad}backup_temp.sql");

        //Backup einspielen
        system("mysql -h{$this->host} -u{$this->user} -p{$this->password} -D{$this->database} < $pfad");

        // gesicherte Backup-Tabelle einspielen
        system("mysql -h{$this->host} -u{$this->user} -p{$this->password} -D{$this->database} < {$this->pfad}backup_temp.sql");

        // Backup-Tabelle loeschen
        system("rm {$this->pfad}backup_temp.sql");

        // Benutzer soll angemeldet bleiben
        $session = session_id();
        $user_id = $this->app->User->GetID();
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->app->DB->Update("UPDATE useronline SET login='0' WHERE user_id='$user_id'");
        $this->app->DB->Insert("INSERT INTO useronline (user_id, login, sessionid, ip, time)
            VALUES ('$user_id', '1', '$session', '$ip', NOW())");

        $this->app->erp->UpgradeDatabase();

        $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Das Backup wurde erfolgreich importiert.</div>");
      } else
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">'$pfad' konnte nicht gefunden werden.</div>");

      header("Location: ./index.php?module=backup&action=list&msg=$msg");
    }

    $this->app->Tpl->Set(MAXSIZE,$this->app->erp->MaxUploadFileSize()/(1024*1024));
    $this->app->Tpl->Parse(PAGE,"backup_import.tpl");
  }

  function BackupReset()
  {
    $this->BackupMenu();
    $this->app->Tpl->Set(UEBERSCHRIFT,"Datenbank zur&uuml;cksetzen");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Datenbank zur&uuml;cksetzen");

    $this->app->erp->MenuEintrag("index.php?module=backup&action=list", "Zur&uuml;ck zur &Uuml;bersicht");

    $submit = $this->app->Secure->GetPOST("submit");

    if($submit!="")
    {
      $adresse = $this->app->User->GetAdresse();
      $dateiname = date("Y-m-d_His_")."AutomaticResetBackup.sql";
      $pfad = $this->pfad.$dateiname;

      $this->app->DB->Insert("INSERT INTO backup (adresse, name, dateiname, datum) VALUES ('$adresse','Automatic Reset-Backup','$dateiname',NOW())");

      //Erstelle Backup
      system("mysqldump {$this->database} --no-create-db -h{$this->host} -u{$this->user} -p{$this->password} > $pfad");

      // Backup-Tabelle extra sichern
      system("mysqldump --no-create-db -h{$this->host} -u{$this->user} -p{$this->password} {$this->database} backup > {$this->pfad}backup_temp.sql");


      // Leere alle Tabellen
      $tables = $this->app->DB->SelectArr("SHOW TABLES");

      for($i=0;$i<count($tables);$i++)
        $this->app->DB->Select("TRUNCATE ".$tables[$i][key($tables[$i])]);

      // gesicherte Backup-Tabelle einspielen
      system("mysql -h{$this->host} -u{$this->user} -p{$this->password} -D{$this->database} < {$this->pfad}backup_temp.sql");

      // Backup-Tabelle loeschen
      system("rm {$this->pfad}backup_temp.sql");

      $sql = 'INSERT INTO `adresse` (`id`, `typ`, `marketingsperre`, `trackingsperre`, `rechnungsadresse`, `sprache`, `name`, `abteilung`, `unterabteilung`, `ansprechpartner`, `land`, `strasse`, `ort`, 
          `plz`, `telefon`, `telefax`, `mobil`, `email`, `ustid`, `ust_befreit`, `passwort_gesendet`, `sonstiges`, `adresszusatz`, `kundenfreigabe`, `steuer`, `logdatei`, `kundennummer`, 
          `lieferantennummer`, `mitarbeiternummer`, `konto`, `blz`, `bank`, `inhaber`, `swift`, `iban`, `waehrung`, `paypal`, `paypalinhaber`, `paypalwaehrung`, `projekt`, `partner`, `geloescht`, 
          `firma`) VALUES (NULL, \'\', \'\', \'\', \'\', \'\', \'Administrator\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', NOW(), 
            \'\', \'\',	\'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'1\', \'\', \'\', \'1\');';	

      $this->app->DB->Insert($sql);

      $sql = 'INSERT INTO `firma` (`id`, `name`, `standardprojekt`) VALUES (NULL, \'Musterfirma\', \'1\');';

      $this->app->DB->Insert($sql);

      $sql = 'INSERT INTO `user` (`id`, `username`, `password`, `repassword`, `description`, `settings`, `parentuser`, `activ`, `type`, `adresse`, `standarddrucker`, `firma`, `logdatei`) 
        VALUES (NULL, \'admin\', ENCRYPT(\'admin\'), \'\', NULL, \'\', NULL, \'1\', \'admin\', \'1\', \'\', \'1\', NOW());';

      $this->app->DB->Insert($sql);

      $sql = 'INSERT INTO `projekt` (`id`, `name`, `abkuerzung`, `verantwortlicher`, `beschreibung`, `sonstiges`, `aktiv`, `farbe`, `autoversand`, `checkok`, `checkname`, `zahlungserinnerung`, 
          `zahlungsmailbedinungen`, `folgebestaetigung`, `kundenfreigabe_loeschen`, `autobestellung`, `firma`, `logdatei`) VALUES (NULL, \'Hauptprojekt\', \'HAUPTPROJEKT\', \'\', \'\', \'\', \'\', \'\'								 , \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'1\', \'\');';

      $this->app->DB->Insert($sql);

      $sql = "INSERT INTO `firmendaten` (`id`, `firma`, `absender`, `sichtbar`, `barcode`, `schriftgroesse`, `betreffszeile`, `dokumententext`, `tabellenbeschriftung`, `tabelleninhalt`, `zeilenuntertext`, 
        `freitext`, `infobox`, `spaltenbreite`, `footer_0_0`, `footer_0_1`, `footer_0_2`, `footer_0_3`, `footer_0_4`, `footer_0_5`, `footer_1_0`, `footer_1_1`, `footer_1_2`, `footer_1_3`, `footer_1_4`,							 `footer_1_5`, `footer_2_0`, `footer_2_1`, `footer_2_2`, `footer_2_3`, `footer_2_4`, `footer_2_5`, `footer_3_0`, `footer_3_1`, `footer_3_2`, `footer_3_3`, `footer_3_4`, `footer_3_5`, 
        `footersichtbar`, `hintergrund`, `logo`, `logo_type`, `briefpapier`, `briefpapier_type`, `benutzername`, `passwort`, `host`, `port`, `mailssl`, `signatur`, `email`, `absendername`,
        `bcc1`, `bcc2`, `firmenfarbe`, `name`, `strasse`, `plz`, `ort`, `steuernummer`, `datum`, `projekt`) VALUES
          (1, 1, 'Musterfirma GmbH | Musterweg 5 | 12345 Musterstadt', 1, 0, 7, 9, 9, 9, 9, 7, 9, 8, 0, 'Sitz der Gesellschaft / Lieferanschrift', 'Musterfirma GmbH', 'Musterweg 5', 
           'D-12345 Musterstadt', 'Telefon +49 123 12 34 56 7', 'Telefax +49 123 12 34 56 78', 'Bankverbindung', 'Musterbank', 'Konto 123456789', 'BLZ 72012345', '', '', 'IBAN DE1234567891234567891', 
           'BIC/SWIFT DETSGDBWEMN', 'Ust-IDNr. DE123456789', 'E-Mail: info@musterfirma-gmbh.de', 'Internet: http://www.musterfirma.de', '', 'Gesch&auml;ftsf&uuml;hrer', 'Max Musterman', 
           'Handelsregister: HRB 12345', 'Amtsgericht: Musterstadt', '', '', 0, 'kein', '', '', '', '', 'musterman', 'passwort', 'smtp.server.de', '25', 1, 
           'LS0NCk11c3RlcmZpcm1hIEdtYkgNCk11c3RlcndlZyA1DQpELTEyMzQ1IE11c3RlcnN0YWR0DQoNClRlbCArNDkgMTIzIDEyIDM0IDU2IDcNCkZheCArNDkgMTIzIDEyIDM0IDU2IDc4DQoNCk5hbWUgZGVyIEdlc2VsbHNjaGFmdDogTXVzdGVyZmlybWEgR21iSA0KU2l0eiBkZXIgR2VzZWxsc2NoYWZ0OiBNdXN0ZXJzdGFkdA0KDQpIYW5kZWxzcmVnaXN0ZXI6IE11c3RlcnN0YWR0LCBIUkIgMTIzNDUNCkdlc2Now6RmdHNmw7xocnVuZzogTWF4IE11c3Rlcm1hbg0KVVN0LUlkTnIuOiBERTEyMzQ1Njc4OQ0KDQpBR0I6IGh0dHA6Ly93d3cubXVzdGVyZmlybWEuZGUvDQo=', 'info@server.de', 'Meine Firma', '', '', '', 'Musterfirma GmbH', 'Musterweg 5', '12345', 'Musterstadt', '111/11111/11111', '0000-00-00 00:00:00', 1);";

      $this->app->DB->Insert($sql);




      $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Datenbank wurde erfolgreich zur&uuml;ckgesetzt.</div>");
      header("Location: ./index.php?module=backup&action=list&msg=$msg");
      exit;
    }


    $this->app->Tpl->Parse(TAB1,"backup_reset.tpl");
    $this->app->Tpl->Set(TABTEXT,"Datenbank zur&uuml;cksetzen");
    $this->app->Tpl->Parse(PAGE,"tabview.tpl");

  }

}

?>
