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

class WidgetGenabrechnungsartikel
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenabrechnungsartikel($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function abrechnungsartikelDelete()
  {
    
    $this->form->Execute("abrechnungsartikel","delete");

    $this->abrechnungsartikelList();
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
    $this->form = $this->app->FormHandler->CreateNew("abrechnungsartikel");
    $this->form->UseTable("abrechnungsartikel");
    $this->form->UseTemplate("abrechnungsartikel.tpl",$this->parsetarget);

    $field = new HTMLInput("artikel","text","","50","50","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("artikel","notempty","Pflichtfeld!","MSGARTIKEL");

    $field = new HTMLInput("bezeichnung","text","","50","50","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("beschreibung",5,50);   
    $this->form->NewField($field);

    $field = new HTMLInput("menge","text","","50","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("menge","notempty","Pflichtfeld!","MSGMENGE");

    $field = new HTMLInput("preis","text","","30","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("preis","notempty","Pflichtfeld!","MSGPREIS");

    $field = new HTMLSelect("preisart",0,"preisart");
    $field->AddOption('Monatspreis','monat');
    $field->AddOption('Preis f&uuml;r x Monate','monatx');
    $field->AddOption('Jahrespreis','jahr');
    $field->AddOption('Einmalig','einmalig');
    $this->form->NewField($field);

    $field = new HTMLSelect("dokument",0,"dokument");
    $field->AddOption('Rechnung','rechnung');
    $field->AddOption('Auftrag','auftrag');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("wiederholend","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("startdatum","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zahlzyklus","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("abgerechnetbis","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("bemerkung",5,50);   
    $this->form->NewField($field);


  }

}

?>