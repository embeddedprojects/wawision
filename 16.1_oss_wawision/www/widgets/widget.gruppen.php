<?php
include ("_gen/widget.gen.gruppen.php");

class Widgetgruppen extends WidgetGengruppen 
{
  private $app;
  function Widgetgruppen($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGengruppen($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
   	$this->app->YUI->AutoComplete("portoartikel","artikelnummer",1);
    $this->form->ReplaceFunction("portoartikel",$this,"ReplaceArtikel");
    $this->app->YUI->AutoComplete("projekt","projektname",1);
    $this->form->ReplaceFunction("projekt",$this,"ReplaceProjekt");

  if($action=="create")
    { 
      // liste zuweisen
      if($this->app->Secure->POST["projekt"]=="")
      { 
        $this->app->erp->LogFile("Standard Projekt laden");
        $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");

        $projekt_bevorzugt=$this->app->DB->Select("SELECT projekt_bevorzugen FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        if($projekt_bevorzugt=="1")
        { 
          $projekt = $this->app->DB->Select("SELECT projekt FROM user WHERE id='".$this->app->User->GetID()."' LIMIT 1");
        }
        $field = new HTMLInput("projekt","text",$projekt);
        $field->value=$projekt;
        $this->form->NewField($field);
      }
    }
 
  }
  
  public function Table()
  {
    //$table->Query("SELECT nummer,beschreibung, id FROM gruppen");
		$this->app->YUI->TableSearch($this->parsetarget,"gruppenlist");
  }

  function ReplaceProjekt($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceProjekt($db,$value,$fromform);
  }



  public function Search()
  {
//    $this->app->Tpl->Set($this->parsetarget,"suchmaske");
    //$this->app->Table(
    //$table = new OrderTable("veranstalter");
    //$table->Heading(array('Name','Homepage','Telefon'));
  }
 function ReplaceArtikel($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceArtikel($db,$value,$fromform);
  }




}
?>
