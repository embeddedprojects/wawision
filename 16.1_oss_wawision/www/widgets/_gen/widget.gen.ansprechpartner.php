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

class WidgetGenansprechpartner
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenansprechpartner($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function ansprechpartnerDelete()
  {
    
    $this->form->Execute("ansprechpartner","delete");

    $this->ansprechpartnerList();
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
    $this->form = $this->app->FormHandler->CreateNew("ansprechpartner");
    $this->form->UseTable("ansprechpartner");
    $this->form->UseTemplate("ansprechpartner.tpl",$this->parsetarget);

    $field = new HTMLSelect("typ",0,"typ");
    $field->AddOption('Herr','herr');
    $field->AddOption('Frau','frau');
    $field->AddOption('Firma / Filiale','firma');
    $this->form->NewField($field);

    $field = new HTMLInput("name","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("telefon","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bereich","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("telefax","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("titel","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("anschreiben","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("abteilung","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("email","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("unterabteilung","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("mobil","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("adresszusatz","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("strasse","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("plz","text","","4","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("ort","text","","23","","","","","","","0");
    $this->form->NewField($field);


  }

}

?>