<?php
include ("_gen/widget.gen.etiketten.php");

class WidgetEtiketten extends WidgetGenEtiketten 
{
  private $app;
  function WidgetEtiketten($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenEtiketten($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {

  }
  
  public function Table()
  {
		$this->app->YUI->TableSearch($this->parsetarget,"etikettenlist");
  }



  public function Search()
  {
//    $this->app->Tpl->Set($this->parsetarget,"suchmaske");
    //$this->app->Table(
    //$table = new OrderTable("veranstalter");
    //$table->Heading(array('Name','Homepage','Telefon'));
  }


}
?>
