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

class WidgetGenartikeleinheit
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenartikeleinheit($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function artikeleinheitDelete()
  {
    
    $this->form->Execute("artikeleinheit","delete");

    $this->artikeleinheitList();
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
    $this->form = $this->app->FormHandler->CreateNew("artikeleinheit");
    $this->form->UseTable("artikeleinheit");
    $this->form->UseTemplate("artikeleinheit.tpl",$this->parsetarget);

    $field = new HTMLInput("einheit_de","text","","40","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("einheit_de","notempty","Pflichfeld!",MSGEINHEIT_DE);

    $field = new HTMLTextarea("internebemerkung",5,50);   
    $this->form->NewField($field);


  }

}

?>