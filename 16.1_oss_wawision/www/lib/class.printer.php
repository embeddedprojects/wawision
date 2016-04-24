<?php


class Printer
{

  function Printer(&$app)
  {
    $this->app=$app;
  }


  function Drucken($drucker,$dokument,$parameter="",$anzahl="1")
  {
    if($dokument=="") return 0; 

    $befehl = $this->app->DB->Select("SELECT befehl FROM drucker WHERE id='$drucker' 
        AND firma='".$this->app->User->GetFirma()."' LIMIT 1");

    $anbindung = $this->app->DB->Select("SELECT anbindung FROM drucker WHERE id='$drucker' 
        AND firma='".$this->app->User->GetFirma()."' LIMIT 1");

    $format = $this->app->DB->Select("SELECT format FROM drucker WHERE id='$drucker' 
        AND firma='".$this->app->User->GetFirma()."' LIMIT 1");



    if($anbindung=="") $anbindung=="cups";

    //sicherung in spooler
    if(is_file($dokument))
    {
      $spooler_content = base64_encode(file_get_contents($dokument));
      $spooler_filename = basename($dokument);
      $spooler_description = $description;
    } else {
      $spooler_content = base64_encode($dokument);
    }
    $spooler_anzahl = $anzahl;
    $spooler_befehl = $befehl;
    $spooler_anbindung = $anbindung;

    $this->app->DB->Insert("INSERT INTO drucker_spooler (id,drucker,filename,content,description,anzahl,befehl,anbindung,zeitstempel,user) VALUES 
      ('','$drucker','$spooler_filename','$spooler_content','$spooler_description','$spooler_anzahl','$spooler_befehl','$spooler_anbindung',NOW(),'".$this->app->User->GetID()."')");


    switch($anbindung)
    {
      case "cups":
        exec("$befehl $dokument");
        break;
      case "pdf":
        $this->app->erp->CreatePath($befehl);
        copy($dokument,$befehl."/".basename($dokument).".pdf");
        break;

      case "adapterbox":
        // wenn intern
        $deviceiddest = $this->app->DB->Select("SELECT adapterboxseriennummer FROM drucker WHERE id='".$drucker."' LIMIT 1");
        $ip = $this->app->DB->Select("SELECT adapterboxip FROM drucker WHERE id='".$drucker."' LIMIT 1");
        $art = $this->app->DB->Select("SELECT art FROM drucker WHERE id='".$drucker."' LIMIT 1");
        $description = $this->app->DB->Select("SELECT bezeichnung FROM drucker WHERE id='".$drucker."' LIMIT 1");

        switch($art)
        {
          case 0: $art = "printer"; break;
          case 1: $art = "fax"; break;
          case 2: $art = "labelprinter"; break;
          default: $art = "unknown"; break;
        }

        if(is_file($dokument))
        {
          $job = base64_encode(json_encode(
              array('label'=>base64_encode(file_get_contents($dokument)),
                  'filename'=>basename($dokument),
                  'amount'=>$anzahl,'filetype'=>filetype($dokument),'description'=>$description,'format'=>$format)));//."<amount>".$anzahl."</amount>");
        }
        else {
          $job = base64_encode(json_encode(array('label'=>base64_encode($dokument),'amount'=>$anzahl,'format'=>$format)));//."<amount>".$anzahl."</amount>");
        }


        if($this->app->erp->Firmendaten("deviceenable")=="1")
        {
          if($deviceiddest!="")
          {
            $this->app->erp->AdapterboxAPI($deviceiddest,$art,$job,false);
            //$this->app->DB->Insert("INSERT INTO device_jobs (id,zeitstempel,deviceidsource,deviceiddest,job,art) VALUES ('',NOW(),'000000000','$deviceiddest','$job','$art')");
          }
        } else {
          $xml = $dokument;
          if($ip!="")
            HttpClient::quickPost("http://".$this->app->erp->GetIPAdapterbox($drucker)."/labelprinter.php",array('label'=>$xml,'amount'=>$anzahl));
        }
        break;

      case "email":
        $tomail = $this->app->DB->Select("SELECT tomail FROM drucker WHERE id='$drucker' 
            AND firma='".$this->app->User->GetFirma()."' LIMIT 1");

        $tomailsubject = $this->app->DB->Select("SELECT tomailsubject FROM drucker WHERE id='$drucker' 
            AND firma='".$this->app->User->GetFirma()."' LIMIT 1");

        $tomailsubject = str_replace('{FAX}',$parameter,$tomailsubject);

        $tomailtext = $this->app->DB->Select("SELECT tomailtext FROM drucker WHERE id='$drucker' 
            AND firma='".$this->app->User->GetFirma()."' LIMIT 1");

        if($dokument!="")
        {
          $this->app->erp->MailSend($this->app->erp->GetFirmaMail(),$this->app->erp->GetFirmaName(),
              $tomail,"",$tomailsubject,$tomailtext,array($dokument),"",true);
        }
        break;
    }
  }

}


?>
