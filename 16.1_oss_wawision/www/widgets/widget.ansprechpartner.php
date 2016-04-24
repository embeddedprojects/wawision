<?php
include ("_gen/widget.gen.ansprechpartner.php");

class WidgetAnsprechpartner extends WidgetGenAnsprechpartner 
{
  private $app;
  function WidgetAnsprechpartner($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;

    $id= $this->app->Secure->GetGET("id");
    $this->id = $id;
    $lid= $this->app->Secure->GetGET("lid");

   if($lid > 0)
    {
      $this->app->Secure->GET["id"]=$lid;
      $this->app->Secure->POST["id"]=$lid;
    }


    parent::WidgetGenAnsprechpartner($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $action = $this->app->Secure->GetGET("action");

    if($action=="ansprechpartner")
    { 
      // liste zuweisen
      $pid = $this->id;//$this->app->Secure->GetGET("id");
      $this->app->Secure->POST["adresse"]=$pid;
      $field = new HTMLInput("adresse","hidden",$pid);
      $this->form->NewField($field);
    }

    if($action=="ansprechpartnerpopup")
    { 
      // liste zuweisen
      $pid = $this->id;//$this->app->Secure->GetGET("id");
      $this->app->Secure->POST["adresse"]=$pid;
      $field = new HTMLInput("adresse","hidden",$pid);
      $this->form->NewField($field);
    }


    $field = new HTMLInput("ansprechpartner_land","hidden","");
    $this->form->NewField($field);



  }

  function DatumErsetzen($wert)
  {
    return "neuerwerert";
  }


  public function Search()
  {
    $this->app->Tpl->Set($this->parsetarget,"suchmaske");
    //$this->app->Table(
    //$table = new OrderTable("veranstalter");
    //$table->Heading(array('Name','Homepage','Telefon'));
  }

   function __destruct() {
    $id = $this->id;
    $this->app->Secure->GET["id"]=$id;
    $this->app->Secure->POST["id"]=$id;
   }


}
?>
