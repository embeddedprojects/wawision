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

class WidgetGenlieferschein_position
{

  private $app;            //application object  
  public $form;            //store form object  
  private $parsetarget;    //target for content

  public function WidgetGenlieferschein_position($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    $this->Form();
  }

  public function lieferschein_positionDelete()
  {
    
    $this->form->Execute("lieferschein_position","delete");

    $this->lieferschein_positionList();
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
    $this->form = $this->app->FormHandler->CreateNew("lieferschein_position");
    $this->form->UseTable("lieferschein_position");
    $this->form->UseTemplate("lieferschein_position.tpl",$this->parsetarget);

    $field = new HTMLInput("nummer","text","","50","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("bezeichnung","text","","50","50","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("bezeichnung","notempty","Pflichtfeld!","MSGBEZEICHNUNG");

    $field = new HTMLTextarea("beschreibung",8,48);   
    $this->form->NewField($field);

    $field = new HTMLInput("menge","text","","10","","","","","","","0");
    $this->form->NewField($field);
    $this->form->AddMandatory("menge","notempty","Pflichtfeld!","MSGMENGE");

    $field = new HTMLInput("einheit","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("vpe","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferdatum","text","","10","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("lieferdatumkw","","","1","0");
    $this->form->NewField($field);

    $field = new HTMLInput("artikelnummerkunde","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("zolltarifnummer","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("herkunftsland","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLInput("seriennummer","text","","30","","","","","","","0");
    $this->form->NewField($field);

    $field = new HTMLTextarea("bemerkung",3,30);   
    $this->form->NewField($field);


  }

}

?>