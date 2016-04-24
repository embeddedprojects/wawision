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

class WidgetGenemailbackup
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenemailbackup($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function emailbackupDelete()
  {
    
    $this->form->Execute("emailbackup","delete");

    $this->emailbackupList();
  }

  function Edit()
  {
    $this->form->Edit();
  }

  function Copy()
  {
    $this->form->Copy();
  }

  public function Create()
  {
    $this->form->Create();
  }

  public function Search()
  {
    $this->app->Tpl->Set($this->parsetarget,"SUUUCHEEE");
  }

  public function Summary()
  {
    $this->app->Tpl->Set($this->parsetarget,"grosse Tabelle");
  }

  function Form()
  {
    $this->form = $this->app->FormHandler->CreateNew("emailbackup");
    $this->form->UseTable("emailbackup");
    $this->form->UseTemplate("emailbackup.tpl",$this->parsetarget);

    $field = new HTMLInput("email","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("benutzername","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("passwort","password","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("server","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("smtp_extra","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("smtp","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("smtp_port","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("smtp_ssl",0,"smtp_ssl");
    $field->AddOption('Keine Verschl&uuml;sselung','0');
    $field->AddOption('TLS','1');
    $field->AddOption('SSL','2');
    $this->form->NewField($field);

    $field = new HTMLInput("smtp_frommail","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("smtp_fromname","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("adresse","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("ticket",0,"ticket");
    $field->AddOption('aus','0');
    $field->AddOption('Im Ticket-System nutzen','1');
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("ticketqueue","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("emailbackup",0,"emailbackup");
    $field->AddOption('aus','0');
    $field->AddOption('Ins Backup einbeziehen','1');
    $this->form->NewField($field);

    $field = new HTMLInput("loeschtage","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("autoresponder",0,"autoresponder");
    $field->AddOption('aus','0');
    $field->AddOption('aktiv','1');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("autosresponder_blacklist","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("geschaeftsbriefvorlage","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("autoresponderbetreff","text","","80","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("autorespondertext",10,80);   
    $this->form->NewField($field);

    $field = new HTMLCheckbox("eigenesignatur","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("signatur",10,80);   
    $this->form->NewField($field);


  }

}

?>