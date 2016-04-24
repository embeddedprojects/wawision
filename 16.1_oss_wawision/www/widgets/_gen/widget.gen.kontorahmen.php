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

class WidgetGenkontorahmen
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenkontorahmen($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function kontorahmenDelete()
  {
    
    $this->form->Execute("kontorahmen","delete");

    $this->kontorahmenList();
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
    $this->form = $this->app->FormHandler->CreateNew("kontorahmen");
    $this->form->UseTable("kontorahmen");
    $this->form->UseTemplate("kontorahmen.tpl",$this->parsetarget);

    $field = new HTMLInput("sachkonto","text","","40","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("sachkonto","notempty","Pflichfeld!",MSGSACHKONTO);

    $field = new HTMLInput("beschriftung","text","","40","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("beschriftung","notempty","Pflichfeld!",MSGBESCHRIFTUNG);

    $field = new HTMLCheckbox("ausblenden","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("bemerkung",5,50);   
    $this->form->NewField($field);


  }

}

?>