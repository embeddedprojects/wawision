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
include ("_gen/adapterbox.php");

class Adapterbox extends GenAdapterbox {
  var $app;

  function Adapterbox($app) {
    //parent::GenAdapterbox($app);
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","AdapterboxCreate");
    $this->app->ActionHandler("edit","AdapterboxEdit");
    $this->app->ActionHandler("delete","AdapterboxDelete");
    $this->app->ActionHandler("deletelog","AdapterboxDeleteLog");
    $this->app->ActionHandler("list","AdapterboxList");
    $this->app->ActionHandler("log","AdapterboxLog");
    $this->app->ActionHandler("schritt2","AdapterboxSchritt2");
    $this->app->ActionHandler("download","AdapterboxDownload");
    $this->app->ActionHandler("endgeraet","AdapterboxEndgeraet");
    $this->app->ActionHandler("testdruck","AdapterboxTestdruck");
    $this->app->ActionHandler("testbild","AdapterboxTestbild");
    $this->app->ActionHandler("demo","AdapterboxDemo");

    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }

  function AdapterboxSchritt2()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->AdapterboxMenuSchritte();

    $this->app->Tpl->Add(MESSAGE,"<div class=\"warning\">Konfiguration &Uuml;bertragen. <br>Anschlie&szlig;end <a href=\"index.php?module=adapterbox&action=endgeraet&id=$id\">weiter mit Schritt 3</a>.</div>");

    $this->app->Tpl->Set(ID,$id);
    $this->app->Tpl->Parse(PAGE,"adapterbox_schritt2.tpl");
  }

  function AdapterboxEndgeraet()
  {
    $id = $this->app->Secure->GetGET("id");
    $submit = $this->app->Secure->GetPOST("submit");
    $seriennummer = $this->app->Secure->GetPOST("seriennummer");
    $bezeichnung = $this->app->Secure->GetPOST("bezeichnung");
    $verwendenals = $this->app->Secure->GetPOST("verwendenals");
    $model = $this->app->Secure->GetPOST("model");
    $baudrate = $this->app->Secure->GetPOST("baudrate");
    $this->AdapterboxMenuSchritte();



    if($submit)
    {
      $this->app->DB->Update("UPDATE adapterbox SET seriennummer='$seriennummer',verwendenals='$verwendenals',bezeichnung='$bezeichnung',model='$model',baudrate='$baudrate' WHERE id='$id' LIMIT 1");

      $iddrucker = $this->app->DB->Select("SELECT id FROM drucker WHERE adapterboxseriennummer='$seriennummer' AND adapterboxseriennummer!='' AND art=2 LIMIT 1");
      $idseriennummer = $this->app->DB->Select("SELECT COUNT(id) FROM adapterbox WHERE seriennummer='$seriennummer' AND seriennummer!='' LIMIT 1");

      //$this->app->Tpl->Set(MESSAGE,"<div class=\"info\">Die Einstellung wurde gespeichert!</div>");
      if($idseriennummer>=2) $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Achtung, es gibt bereits eine Adapterboxen mit der Seriennummer $seriennummer.</div>");

      if($verwendenals=="" || $verwendenals=="etikettendrucker")
      {
        if($iddrucker<=0)
        {
          // pruefe ob es namen schon gibt 
          $checkname = $this->app->DB->Select("SELECT id FROM drucker WHERE name LIKE '$bezeichnung' LIMIT 1");

          if($checkname <= 0 && $bezeichnung!="" && $seriennummer!="" && $idseriennummer<2)
          {
            //drucker anlegen  
            $this->app->DB->Insert("INSERT INTO drucker (id,name,art,adapterboxseriennummer,aktiv,anbindung,firma) VALUES ('','$bezeichnung','2','$seriennummer',1,'adapterbox',1)");
            $iddrucker = $this->app->DB->GetInsertID();
            $this->app->DB->Update("UPDATE adapterbox SET bezeichnung='$bezeichnung' WHERE id='$id' LIMIT 1");
          }  else {
            if($checkname > 0)
              $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Es gibt bereits einen Drucker mit dem gleichen Namen! Bitte w&auml;hlen Sie einen anderen Namen.</div>");
            else
              $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Bitte f&uuml;llen Sie alle Felder aus!</div>");
          }
        } else {
          if($idseriennummer<2)
          {
            $this->app->DB->Update("UPDATE drucker SET name='$bezeichnung' WHERE adapterboxseriennummer='$seriennummer' AND adapterboxseriennummer!='' LIMIT 1");
            $this->app->DB->Update("UPDATE adapterbox SET bezeichnung='$bezeichnung' WHERE id='$id' LIMIT 1");
          }
        }
        $standarddrucker = $this->app->erp->Firmendaten("standardetikettendrucker");
        $checkstandarddrucker = $this->app->DB->Select("SELECT id FROM drucker WHERE id='$standarddrucker' LIMIT 1");
        if($standarddrucker <= 0 || $checkstandarddrucker <=0)
        {
          $this->app->erp->FirmendatenSet("standardetikettendrucker",$iddrucker);
        }
        $standarddrucker = $this->app->erp->Firmendaten("etikettendrucker_wareneingang");
        $checkstandarddrucker = $this->app->DB->Select("SELECT id FROM drucker WHERE id='$standarddrucker' LIMIT 1");
        if($standarddrucker <= 0 || $checkstandarddrucker <=0)
        {
          $this->app->erp->FirmendatenSet("etikettendrucker_wareneingang",$iddrucker);
        }

      }


      // pruefe ob es einen standard etikettendrucker gibt wenn nicht lege ihn an
    }

    $verwendenals = $this->app->DB->Select("SELECT verwendenals FROM adapterbox WHERE id='$id' LIMIT 1");
    $baudrate = $this->app->DB->Select("SELECT baudrate FROM adapterbox WHERE id='$id' LIMIT 1");
    $model = $this->app->DB->Select("SELECT model FROM adapterbox WHERE id='$id' LIMIT 1");

    if($idseriennummer<2)
    {
      $seriennummer = $this->app->DB->Select("SELECT seriennummer FROM adapterbox WHERE id='$id' LIMIT 1");
    }
    else { 
      $seriennummer="";
    }


    $this->app->Tpl->Add(MESSAGE,"<div class=\"warning\">Druckerbezeichnung frei vergeben und Seriennummer der Adapterbox eintragen. Speichern</div>");
    $iddrucker = $this->app->DB->Select("SELECT id FROM drucker WHERE adapterboxseriennummer='$seriennummer' AND adapterboxseriennummer!='' AND art=2 LIMIT 1");
    if($iddrucker > 0 && ($verwendenals=="" || $verwendenals=="etikettendrucker"))
    {
      $name_drucker = $this->app->DB->Select("SELECT name FROM drucker WHERE adapterboxseriennummer='$seriennummer' AND art=2 LIMIT 1");
      //$this->app->Tpl->Add(MESSAGE,"<div class=\"warning\">Nach dem Anstecken kann es ca. 1-2 Minuten dauern bis die ersten Testetiketten aus dem Drucker kommen.</div>");
      $this->app->Tpl->Add(MESSAGE,"<div class=\"info\">Einen <a href=\"index.php?module=adapterbox&action=testdruck&id=$id\">Testdruck</a> (kann das erste Mal einige Sekunden dauern) durchf&uuml;hren oder das <a href=\"index.php?module=drucker&action=edit&id=$iddrucker\" target=\"_blank\">Etikettenformat</a> (Men&uuml;punkt Drucker) einstellen.</div>");
    } else {
      $name_drucker = $this->app->DB->Select("SELECT bezeichnung FROM adapterbox WHERE id='$id' LIMIT 1");
    }

    $options = "";
    $tmp = array('marel'=>'Marel','pce'=>'PCE');
    foreach($tmp as $key=>$value)
    {
      if($key==$model)
        $options .= "<option value=\"$key\" selected>".$value."</option>";
      else
        $options .= "<option value=\"$key\">".$value."</option>";
    }
    $this->app->Tpl->Set(MODEL,$options);



    $options = "";
    $tmp = array('1'=>'4800','2'=>'9600');
    foreach($tmp as $key=>$value)
    {
      if($key==$baudrate)
        $options .= "<option value=\"$key\" selected>".$value."</option>";
      else
        $options .= "<option value=\"$key\">".$value."</option>";
    }
    $this->app->Tpl->Set(BAUDRATE,$options);


    $options = "";
    $tmp = array('etikettendrucker'=>'Etikettendrucker','waage'=>'Waage','kamera'=>'Kamera');
    foreach($tmp as $key=>$value)
    {
      if($key==$verwendenals)
        $options .= "<option value=\"$key\" selected>".$value."</option>";
      else
        $options .= "<option value=\"$key\">".$value."</option>";
    }
    $this->app->Tpl->Set(VERWENDENALS,$options);

    $this->app->Tpl->Set(SERIENNUMMER,$seriennummer);
    $this->app->Tpl->Set(BEZEICHNUNG,$name_drucker);

    $this->app->Tpl->Set(ID,$id);
    $this->app->Tpl->Parse(PAGE,"adapterbox_endgeraet.tpl");
  }


  function AdapterboxDownload()
  {
    $id = $this->app->Secure->GetGET("id");

    $tmp = $this->app->DB->SelectArr("SELECT * FROM adapterbox WHERE id='$id' LIMIT 1");

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $url_parts = parse_url($url);

    if(isset($_SERVER['HTTPS'])) {
      if ($_SERVER['HTTPS'] == "on") {
        $secure_connection = true;
        $url_parts['scheme'] = "https";
      }
    }

    if($url_parts['hostname']=="") {
      if($url_parts['port']!="")
        $url_parts['hostname'] = $url_parts['host'].":".$url_parts['port'];
      else
        $url_parts['hostname'] = $url_parts['host'];
    }

    $url_parts['path'] = str_replace("index.php","",$url_parts['path']);

    $constructed_url = $url_parts['scheme'] . '://' . $url_parts['hostname'] . rtrim($url_parts['path'],'/');

    $devicekey = $this->app->erp->Firmendaten("devicekey");

    header('Content-type: text/plain');
    header("Content-Disposition: attachment; filename=wawision.php");
    echo '<?php'."\r\n";
    echo '$settings["ip"]="'.$tmp[0]['ipadresse'].'";'."\r\n";
    echo '$settings["subnetmask"]="'.$tmp[0]['netmask'].'";'."\r\n";
    echo '$settings["gateway"]="'.$tmp[0]['gateway'].'";'."\r\n";
    echo '$settings["dns"]="'.$tmp[0]['dns'].'";'."\r\n";

    if($tmp[0]['wlan']=="1")
      echo '$settings["wlan"]=true;'."\r\n";
    else
      echo '$settings["wlan"]=false;'."\r\n";

    if($tmp[0]['dhcp']=="1")
      echo '$settings["dhcp"]=true;'."\r\n";
    else
      echo '$settings["dhcp"]=false;'."\r\n";

    echo '$settings["ssid"]="'.$tmp[0]['ssid'].'";'."\r\n";
    echo '$settings["passphrase"]="'.$tmp[0]['passphrase'].'";'."\r\n";
    echo '$settings["url"]="'.$constructed_url.'";'."\r\n";
    echo '$settings["devicekey"]="'.$devicekey.'";'."\r\n";

    echo '?>';
    exit;
  }

  function AdapterboxCreate()
  {
    $this->app->DB->Insert("INSERT INTO adapterbox (id) VALUES ('')");
    $id = $this->app->DB->GetInsertID();

    header("Location: index.php?module=adapterbox&action=edit&id=$id");
    exit;
    //$this->AdapterboxMenu();
    //parent::AdapterboxCreate();
  }

  function AdapterboxList()
  {
    $this->AdapterboxMenu();



    $devicekey = $this->app->erp->Firmendaten("devicekey");
    if($devicekey=="")
    {
      $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Aktuell ist kein API Schl&uuml;ssel hinterlegt! F&uuml;r die Adapterboxen ben&ouml;tigen Sie diesen! <a href=\"index.php?module=firmendaten&action=edit#tabs-11\">aktivieren</a></div>");
    }

    $deviceenable = $this->app->erp->Firmendaten("deviceenable");
    if($deviceenable!="1")
    {
      $this->app->Tpl->Add(MESSAGE,"<div class=\"error\">Aktuell ist die API nicht aktiviert! Bitte aktivieren Sie diese! <a href=\"index.php?module=firmendaten&action=edit#tabs-11\">aktivieren</a></div>");
    }

    $this->app->YUI->TableSearch(TAB1,"adapterbox_list");
    $this->app->Tpl->Parse(PAGE,"tabview.tpl");
  }

  function AdapterboxDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    {
      $this->app->DB->Delete("DELETE FROM adapterbox WHERE id='$id'");
    }
    //$this->AdapterboxList();
    header("Location: index.php?module=adapterbox&action=list");
    exit;
  }


  function AdapterboxMenuSchritte()
  {
    $id = $this->app->Secure->GetGET("id");
    $data = $this->app->DB->SelectArr("SELECT * FROM adapterbox WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT1,$data[0]['verwendenals']);
    $this->app->Tpl->Add(KURZUEBERSCHRIFT2,"SN: ".$data[0]['seriennummer']);
    $this->app->erp->MenuEintrag("index.php?module=adapterbox&action=edit&id=$id","Schritt 1 - Netzwerkkonfiguration");
    $this->app->erp->MenuEintrag("index.php?module=adapterbox&action=schritt2&id=$id","Schritt 2 - Konfiguration &uuml;bertragen");
    $this->app->erp->MenuEintrag("index.php?module=adapterbox&action=endgeraet&id=$id","Schritt 3 - Endger&auml;t einstellen");
    $this->app->erp->MenuEintrag("index.php?module=adapterbox&action=demo&id=$id","Schritt 4 - Demo");
    // $this->app->erp->MenuEintrag("index.php?module=adapterbox&action=list","Zur&uuml;ck zur &Uuml;bersicht");
  }

  function AdapterboxDemo()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->AdapterboxMenuSchritte();

    $data = $this->app->DB->SelectArr("SELECT * FROM adapterbox WHERE id='$id' LIMIT 1");
    $data = reset($data);

    switch($data['verwendenals'])
    {
      case "waage": 
        $gewicht = $this->app->erp->GetAdapterboxAPIWaage($data['seriennummer']);  

        if($gewicht!="")$gewicht="Ergebnis: <br><br><textarea rows=10 cols=40>$gewicht</textarea>";
        $this->app->Tpl->Set(TAB1,"<div class=\"info\">Zum Testen bitte klicken: <input type=\"button\" value=\"Gewicht abholen\" 
          onclick=\"window.location.href='index.php?module=adapterbox&action=demo&id=$id'\"></div><br>$gewicht");  
      break;
      case "kamera":
        $this->app->Tpl->Set(TAB1,"<div class=\"info\">Zum Testen bitte klicken: <input type=\"button\" value=\"Bild abholen\" 
          onclick=\"window.location.href='index.php?module=adapterbox&action=demo&id=$id'\"></div><img src=\"index.php?module=adapterbox&action=testbild&id=$id\">");  
      break;

      case "etikettendrucker":
      $seriennummer = $data['seriennummer'];
      $druckercode = $this->app->DB->Select("SELECT id FROM drucker WHERE adapterboxseriennummer='$seriennummer' AND adapterboxseriennummer!='' AND art=2 LIMIT 1");
      $this->app->erp->EtikettenDrucker("etikettendrucker_einfach",1,"","",array('bezeichnung1'=>'WaWision','bezeichnung2'=>'www.wawision.de'),"",$druckercode);
        $this->app->Tpl->Set(TAB1,"<div class=\"info\">Zum Testen bitte klicken: <input type=\"button\" value=\"Testdruck starten\"
          onclick=\"window.location.href='index.php?module=adapterbox&action=demo&id=$id'\"></div>");  
      break;
    }

    $this->app->Tpl->Parse(PAGE,"tabview.tpl");
  }


  function AdapterboxMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    //$this->app->Tpl->Add(KURZUEBERSCHRIFT,"Adapterbox");
    $this->app->erp->MenuEintrag("index.php?module=adapterbox&action=list","&Uuml;bersicht");
    //$this->app->erp->MenuEintrag("index.php?module=adapterbox&action=log","Log");
    $this->app->erp->MenuEintrag("index.php?module=adapterbox&action=create","Neu");
    if($this->app->Secure->GetGET("action")=="list")
      $this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    else
      $this->app->erp->MenuEintrag("index.php?module=adapterbox&action=list","Zur&uuml;ck zur &Uuml;bersicht");
  }

  function AdapterboxEdit()
  {
    $this->AdapterboxMenuSchritte();
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Add(MESSAGE,"<div class=\"warning\">Netzwerkeinstellungen vornehmen, speichern. <br>Anschlie&szlig;end <a href=\"index.php?module=adapterbox&action=schritt2&id=$id\">weiter mit Schritt 2</a>.</div>");

    parent::AdapterboxEdit();
  }


  function AdapterboxLog()
  {
    $this->AdapterboxMenu();

    $this->app->DB->Delete("DELETE FROM `adapterbox_log` WHERE id < SELECT MIN(id) FROM `adapterbox_log` ORDER BY id DESC LIMIT 0,100"); 
    $this->app->YUI->TableSearch(TAB1,"adapterbox_log");
    $this->app->Tpl->Parse(PAGE,"tabview.tpl");  
  }

  function AdapterboxDeleteLog()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Delete("DELETE FROM adapterbox_log WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Der Logeintrag wurde gel&ouml;scht!</div>  ");
    header("Location: index.php?module=adapterbox&action=log&msg=$msg");
    exit;
  }


  function AdapterboxTestbild()
  {
    $id = $this->app->Secure->GetGET("id");

    $seriennummer = $this->app->DB->Select("SELECT seriennummer FROM adapterbox WHERE id='$id' LIMIT 1");
    //$image = $this->app->erp->GetAdapterboxAPIImage($seriennummer,"480","360");
    $image = $this->app->erp->GetAdapterboxAPIImage($seriennummer,"800","600");
    //$image = $this->app->erp->GetAdapterboxAPIImage("999999999","960","720");
    header("Content-Type: image/jpeg");
    header("Content-Length: " .(string)(strlen($image)) );
    echo ($image);
    exit;
  }

  function AdapterboxTestdruck()
  {
    $id = $this->app->Secure->GetGET("id");

    $seriennummer = $this->app->DB->Select("SELECT seriennummer FROM adapterbox WHERE id='$id' LIMIT 1");

    $druckercode = $this->app->DB->Select("SELECT id FROM drucker WHERE adapterboxseriennummer='$seriennummer' AND adapterboxseriennummer!='' AND art=2 LIMIT 1");

    $this->app->erp->EtikettenDrucker("etikettendrucker_einfach",1,"","",array('bezeichnung1'=>'WaWision','bezeichnung2'=>'www.wawision.de'),"",$druckercode);
    header("Location: index.php?module=adapterbox&action=endgeraet&id=$id");
    exit;
  }

}

?>
