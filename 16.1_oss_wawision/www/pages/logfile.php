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

class Logfile {
  var $app;

  function Logfile($app) {
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","LogfileList");
    $this->app->ActionHandler("delete","LogfileDelete");
    $this->app->ActionHandler("deleteall","LogfileDeleteAll");
    $this->app->ActionHandler("minidetail","LogfileMiniDetail");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen($app);
  }

  function LogFileMiniDetail()
  {
    $id = $this->app->Secure->GetGET("id");
    $dump = $this->app->DB->SelectArr("SELECT funktionsname,dump FROM logfile WHERE id='$id' LIMIT 1");
    echo "<pre>Funktion ".$dump[0]['funktionsname'].":<br></pre>";
    echo "<br><br><pre>Dump:".$dump[0]['dump']."</pre><br>";
    if(is_array(unserialize($dump[0]['dump'])))
    {
      echo "<pre>";
      print_r(unserialize($dump[0]['dump']));
      echo "</pre>";
    }
    exit;
  }

  function LogfileDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Delete("DELETE FROM logfile WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Der Logeintrag wurde gel&ouml;scht!</div>  ");
    header("Location: index.php?module=logfile&action=list&msg=$msg");
    exit;	
  }	


  function LogfileDeleteAll()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Delete("DELETE FROM logfile WHERE id > 0");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Alle Logeintr&auml;ge wurden wurden gel&ouml;scht!</div>  ");
    header("Location: index.php?module=logfile&action=list&msg=$msg");
    exit;	
  }	

  function LogfileList()
  {
    $this->LogfileMenu();

    //$this->app->erp->InternesEvent($this->app->User->GetID(),"Hallo","alarm",1);

    $this->app->YUI->TableSearch(TAB1,"logfile");
    $this->app->Tpl->Parse(PAGE,"logfile_list.tpl");
  }

  function LogfileMenu()
  {
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Logdatei");
    $this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=logfile&action=list","Aktualisieren");
    $this->app->erp->MenuEintrag("index.php?module=logfile&action=deleteall","Alle Eintr&auml;ge l&ouml;schen");
  }


}

?>
