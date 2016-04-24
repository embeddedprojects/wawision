<?php
include ("_gen/widget.gen.artikeleinheit.php");

class WidgetArtikeleinheit extends WidgetGenArtikeleinheit 
{
  private $app;
  function WidgetArtikeleinheit($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenArtikeleinheit($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {

  }
  
  public function Table()
  {
    //$table->Query("SELECT nummer,beschreibung, id FROM artikeleinheit");
		$this->app->YUI->TableSearch($this->parsetarget,"artikeleinheitlist");
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
