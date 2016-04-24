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

class WidgetGenetiketten
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenetiketten($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function etikettenDelete()
  {
    
    $this->form->Execute("etiketten","delete");

    $this->etikettenList();
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
    $this->form = $this->app->FormHandler->CreateNew("etiketten");
    $this->form->UseTable("etiketten");
    $this->form->UseTemplate("etiketten.tpl",$this->parsetarget);

    $field = new HTMLInput("name","text","","80","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("name","notempty","Pflichfeld!",MSGNAME);

    $field = new HTMLTextarea("xml",10,80);   
    $this->form->NewField($field);

    $field = new HTMLTextarea("bemerkung",5,80);   
    $this->form->NewField($field);

    $field = new HTMLSelect("verwendenals",0,"verwendenals");
    $field->AddOption('','');
    $field->AddOption('Artikel klein','artikel_klein');
    $field->AddOption('Lager klein','lager_klein');
    $field->AddOption('Etikettendrucker 2-zeilig','etikettendrucker_einfach');
    $field->AddOption('Kommissionieraufkleber','kommissionieraufkleber');
    $field->AddOption('Seriennummer','seriennummer');
    $field->AddOption('Lieferschein Position','lieferschein_position');
    $this->form->NewField($field);

    $field = new HTMLSelect("format",0,"format");
    $field->AddOption('30x15 mm','30x15x3');
    $field->AddOption('50x18 mm','50x18x3');
    $field->AddOption('100x50 mm','100x50x5');
    $this->form->NewField($field);

    $field = new HTMLCheckbox("manuell","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("labelbreite","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("labelhoehe","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("labelabstand","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("labeloffsetx","text","","5","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("labeloffsety","text","","5","","","","","","","0");
    $this->form->NewField($field);


  }

}

?>