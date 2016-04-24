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
include ("_gen/etiketten.php");

class Etiketten extends GenEtiketten {
  var $app;

  function Etiketten($app) {
    //parent::GenEtiketten($app);
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","EtikettenCreate");
    $this->app->ActionHandler("edit","EtikettenEdit");
    $this->app->ActionHandler("list","EtikettenList");
    $this->app->ActionHandler("bild","EtikettenBild");
    $this->app->ActionHandler("delete","EtikettenDelete");

    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }


  function EtikettenCreate()
  {
    $this->EtikettenMenu();
    parent::EtikettenCreate();
  }

  function EtikettenDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    if(is_numeric($id))
    {
      $this->app->DB->Delete("DELETE FROM etiketten WHERE id='$id'");
    }

    $this->EtikettenList();
  }


  function EtikettenList()
  {
    $this->EtikettenMenu();
    parent::EtikettenList();
  }

  function EtikettenMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->MenuEintrag("index.php?module=etiketten&action=create","Neues Etikett anlegen");

    if($this->app->Secure->GetGET("action")=="edit" || $this->app->Secure->GetGET("action")=="bild" )
    {
      $this->app->erp->MenuEintrag("index.php?module=etiketten&action=edit&id=$id","Details");
      $this->app->erp->MenuEintrag("index.php?module=etiketten&action=bild&id=$id","Bild Generator");
    }


    if($this->app->Secure->GetGET("action")=="list")
    {
      $this->app->erp->MenuEintrag("index.php?module=etiketten&action=list","&Uuml;bersicht");
      $this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    }
    else
      $this->app->erp->MenuEintrag("index.php?module=etiketten&action=list","Zur&uuml;ck zur &Uuml;bersicht");

  }

  function EtikettenBild()
  {
    $this->EtikettenMenu();
    $submit = $this->app->Secure->GetPOST("submit");

    $pfad = $_FILES["image"]["tmp_name"];
    if($submit!="")
    { 
      if(file_exists($pfad))
      {
        $result = $this->app->erp->PNG2Etikett($pfad);
        if($result['result']=="1")
        {
          $this->app->Tpl->Set(BILD,"<textarea rows=\"10\" cols=\"80\"><image x=\"1\" y=\"1\" width=\"".$result['width']."\" height=\"".$result['height']."\">".$result['stream']."</image></textarea>");
          $this->app->Tpl->Set(BILD2,"<textarea rows=\"10\" cols=\"80\"><label><image x=\"1\" y=\"1\" width=\"".$result['width']."\" height=\"".$result['height']."\">".$result['stream']."</image></label></textarea>");
        } 
        else
          $this->app->Tpl->Set(BILD,"<div class=\"error\">".$result['message']."</div>");
      }
    } 

    $this->app->Tpl->Parse(PAGE,"etiketten_bild.tpl");
  } 

  function EtikettenEdit()
  {
    $this->EtikettenMenu();
    parent::EtikettenEdit();
  }





}

?>
