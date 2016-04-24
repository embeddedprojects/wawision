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

class GenWebmail_Mails { 

  function GenWebmail_Mails(&$app) { 

    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","Webmail_MailsCreate");
    $this->app->ActionHandler("edit","Webmail_MailsEdit");
    $this->app->ActionHandler("copy","Webmail_MailsCopy");
    $this->app->ActionHandler("list","Webmail_MailsList");
    $this->app->ActionHandler("delete","Webmail_MailsDelete");

    $this->app->Tpl->Set(HEADING,"Webmail_Mails");    $this->app->ActionHandlerListen($app);
  }

  function Webmail_MailsCreate(){
    $this->app->Tpl->Set(HEADING,"Webmail_Mails (Anlegen)");
      $this->app->PageBuilder->CreateGen("webmail_mails_create.tpl");
  }

  function Webmail_MailsEdit(){
    $this->app->Tpl->Set(HEADING,"Webmail_Mails (Bearbeiten)");
      $this->app->PageBuilder->CreateGen("webmail_mails_edit.tpl");
  }

  function Webmail_MailsCopy(){
    $this->app->Tpl->Set(HEADING,"Webmail_Mails (Kopieren)");
      $this->app->PageBuilder->CreateGen("webmail_mails_copy.tpl");
  }

  function Webmail_MailsDelete(){
    $this->app->Tpl->Set(HEADING,"Webmail_Mails (L&ouml;schen)");
      $this->app->PageBuilder->CreateGen("webmail_mails_delete.tpl");
  }

  function Webmail_MailsList(){
    $this->app->Tpl->Set(HEADING,"Webmail_Mails (&Uuml;bersicht)");
      $this->app->PageBuilder->CreateGen("webmail_mails_list.tpl");
  }

} 
?>