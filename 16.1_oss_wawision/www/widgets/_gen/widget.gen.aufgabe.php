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

class WidgetGenaufgabe
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenaufgabe($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function aufgabeDelete()
  {
    
    $this->form->Execute("aufgabe","delete");

    $this->aufgabeList();
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
    $this->form = $this->app->FormHandler->CreateNew("aufgabe");
    $this->form->UseTable("aufgabe");
    $this->form->UseTemplate("aufgabe.tpl",$this->parsetarget);

    $field = new HTMLInput("aufgabe","text","","80","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("aufgabe","notempty","Pflichtfeld!","MSGAUFGABE");

    $field = new HTMLInput("adresse","text","","80","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("kunde","text","","80","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung",5,80);   
    $this->form->NewField($field);

    $field = new HTMLInput("projekt","text","","80","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("prio",0,"prio");
    $field->AddOption('Normal (Standard)','0');
    $field->AddOption('Prio','1');
    $field->AddOption('Keine Prio','-1');
    $this->form->NewField($field);

    $field = new HTMLInput("stunden","text","","15","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("abgabe_bis","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("abgabe_bis_zeit","text","","15","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("intervall_tage",0,"intervall_tage");
    $field->AddOption('einmalig','0');
    $field->AddOption('Täglich','1');
    $field->AddOption('Wöchentlich','2');
    $field->AddOption('Monatlich','3');
    $field->AddOption('Jährlich','4');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("zeiterfassung_pflicht","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("zeiterfassung_abrechnung","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("emailerinnerung","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("emailerinnerung_tage","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("vorankuendigung","text","","20","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("status",0,"status");
    $field->AddOption('offen','offen');
    $field->AddOption('abgeschlossen','abgeschlossen');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("oeffentlich","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("startseite","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("pinwand","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLSelect("note_color",0,"note_color");
    $field->AddOption('Gelb','yellow');
    $field->AddOption('Blau','blue');
    $field->AddOption('Gr&uuml;n','green');
    $field->AddOption('Rosa','coral');
    $this->form->NewField($field);

    $field = new HTMLTextarea("sonstiges",5,50);   
    $this->form->NewField($field);


  }

}

?>