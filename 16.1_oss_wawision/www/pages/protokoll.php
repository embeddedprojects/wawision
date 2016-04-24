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

class Protokoll {
  var $app;
  
  function Protokoll($app) {
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","ProtokollList");
    $this->app->ActionHandler("minidetail","ProtokollMiniDetail");
    //$this->app->ActionHandler("delete","ProtokollDelete");
    //$this->app->ActionHandler("deleteall","ProtokollDeleteAll");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen($app);
  }
/*
	function ProtokollDelete()
	{
		$id = $this->app->Secure->GetGET("id");
		$this->app->DB->Delete("DELETE FROM protokoll WHERE id='$id' LIMIT 1");
	  $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Der Logeintrag wurde gel&ouml;scht!</div>  ");
    header("Location: index.php?module=protokoll&action=list&msg=$msg");
    exit;	
	}	
*/
/*
	function ProtokollDeleteAll()
	{
		$id = $this->app->Secure->GetGET("id");
		$this->app->DB->Delete("DELETE FROM protokoll WHERE id > 0");
	  $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Alle Logeintr&auml;ge wurden wurden gel&ouml;scht!</div>  ");
    header("Location: index.php?module=protokoll&action=list&msg=$msg");
    exit;	
	}	
*/

  function ProtokollMiniDetail()
  {
		$id = $this->app->Secure->GetGET("id");
		$dump = $this->app->DB->SelectArr("SELECT argumente,funktionsname,dump FROM protokoll WHERE id='$id' LIMIT 1");
		echo "<pre>Argumente der Funktion ".$dump[0]['funktionsname'].":<br><br>".base64_decode($dump[0]['argumente'])."</pre>";
		echo "<br><br><pre>Dump:".$dump[0]['dump']."</pre>";
		exit;
  }

  function ProtokollList()
  {
    $this->ProtokollMenu();
    $this->app->YUI->TableSearch(TAB1,"protokoll");
		$this->app->Tpl->Parse(PAGE,"protokoll_list.tpl");
  }

  function ProtokollMenu()
  {
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Protokoll");
    $this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=protokoll&action=list","Aktualisieren");
    //$this->app->erp->MenuEintrag("index.php?module=protokoll&action=deleteall","Alle Eintr&auml;ge l&ouml;schen");
  }


}

?>
