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
include ("_gen/drucker.php");

class Drucker extends GenDrucker {
  var $app;
  
  function Drucker($app) {
    //parent::GenDrucker($app);
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","DruckerCreate");
    $this->app->ActionHandler("edit","DruckerEdit");
    $this->app->ActionHandler("delete","DruckerDelete");
    $this->app->ActionHandler("spoolerdelete","DruckerSpoolerDelete");
    $this->app->ActionHandler("spoolerdownload","DruckerSpoolerDownload");
    $this->app->ActionHandler("spoolerdownloadall","DruckerSpoolerDownloadAll");
    $this->app->ActionHandler("spooler","DruckerSpooler");
    $this->app->ActionHandler("list","DruckerList");

    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }

  function DruckerSpoolerDownloadAll()
  {
    $id = $this->app->Secure->GetGET("id"); 
 
    $data = $this->app->DB->SelectArr("SELECT * FROM drucker_spooler WHERE drucker='$id' AND DATE_FORMAT(zeitstempel,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d')");


    for($i=0;$i<count($data);$i++)
    {
      $temp = tempnam($this->app->erp->GetTMP(),"");
      file_put_contents($temp,base64_decode($data[$i]['content']));
      $files[] = $temp;
    }
    $raw_data =  $this->app->erp->MergePDF($files);


    for($i=0;$i<count($files);$i++)
      unlink($files[$i]);

    $filename = urlencode("DOWNLOAD_SPOOLER.pdf");

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Type: application/force-download");
    header('Content-Disposition: attachment; filename=' . $filename);
    // header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . strlen($raw_data));
    echo $raw_data;
    exit;


  }

  function DruckerSpoolerDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    $drucker = $this->app->DB->Select("SELECT drucker FROM drucker_spooler WHERE id='$id'");

    $this->app->DB->Delete("DELETE FROM drucker_spooler WHERE id='$id'");
    $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Der Eintrag wurde aus dem Spooler entfernt!</div>  ");
    header("Location: index.php?module=drucker&action=spooler&id=$drucker&msg=$msg");
    exit;
  }

  function DruckerSpoolerDownload()
  {
    $id = $this->app->Secure->GetGET("id");
    $data = $this->app->DB->SelectArr("SELECT * FROM drucker_spooler WHERE id='$id'");

    $raw_data = base64_decode($data[0]['content']);

    if($data[0]['filename']!="")
      $filename = urlencode($data[0]['zeitstempel'].$data[0]['filename']);
    else
      $filename = urlencode($data[0]['zeitstempel']);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Type: application/force-download");
    header('Content-Disposition: attachment; filename=' . $filename);
    // header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . strlen($raw_data));
    echo $raw_data;
    exit;
  }


  function DruckerCreate()
  {
    $this->DruckerMenu();
    parent::DruckerCreate();
  }

  function DruckerList()
  {
    $this->DruckerMenu();
    parent::DruckerList();
  }

  function DruckerDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    {
      $this->app->DB->Delete("DELETE FROM drucker WHERE id='$id'");
    }

    //$this->DruckerList();
		header("Location: index.php?module=drucker&action=list");
		exit;
  }

  function DruckerSpooler()
  {
    $this->DruckerMenu();
    $id = $this->app->Secure->GetGET("id");

    $this->app->YUI->TableSearch(TAB1,"drucker_spooler");
    $this->app->Tpl->Add(TAB1,"<center><input type=\"button\" onclick=\"window.location.href='index.php?module=drucker&action=spoolerdownloadall&id=$id'\" 
      value=\"Sammel PDF (Heute)\"></center>");
    $this->app->Tpl->Parse(PAGE,"tabview.tpl");
  }

  function DruckerMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $name = $this->app->DB->Select("SELECT CONCAT(name,' ',bezeichnung) FROM drucker WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT2,"$name");

    if($this->app->Secure->GetGET("action")=="edit" || $this->app->Secure->GetGET("action")=="spooler")
		{
      $this->app->erp->MenuEintrag("index.php?module=drucker&action=edit&id=$id","Details");
    	$this->app->erp->MenuEintrag("index.php?module=drucker&action=spooler&id=$id","Spooler");
		}

    if($this->app->Secure->GetGET("action")=="create")
      $this->app->erp->MenuEintrag("index.php?module=drucker&action=create","Details");

    if($this->app->Secure->GetGET("action")=="list")
    $this->app->erp->MenuEintrag("index.php?module=drucker&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=drucker&action=create","Neu");
    if($this->app->Secure->GetGET("action")=="list")
    $this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    else
    $this->app->erp->MenuEintrag("index.php?module=drucker&action=list","Zur&uuml;ck zur &Uuml;bersicht");
  }


  function DruckerEdit()
  {
    $this->DruckerMenu();

    parent::DruckerEdit();
  }





}

?>
