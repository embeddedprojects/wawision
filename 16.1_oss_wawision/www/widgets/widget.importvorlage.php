<?php
include ("_gen/widget.gen.importvorlage.php");

class WidgetImportvorlage extends WidgetGenImportvorlage 
{
  private $app;
  function WidgetImportvorlage($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenImportvorlage($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $selcharsets = array('UTF8'=>'UTF-8','ISO-8859-1'=>'ISO-8859-1','CP850'=>'CP850');
    $sel = '<select id="selcharset">';
    $charset = '';
    $id = $this->app->Secure->GetGET('id');
    if($id)$charset = $this->app->DB->Select("SELECT charset from importvorlage where id = '$id'");
    foreach($selcharsets as $k => $v)
    {
      $sel .= '<option value="'.$k.'"'.($charset == $k?' selected="selected" ':'').'>'.$v.'</option>';
      
    }
    $sel .= '</select>';
    $this->app->Tpl->Set('SELCHARSET',$sel);
    $this->app->Tpl->Add('JAVASCRIPT','
    $(document).ready(function() {
      $("#selcharset").on("change",function(){
        $("#charset").val($("#selcharset").val());
      });
    });
   
    ');
  }
  
  public function Table()
  {
    //$table->Query("SELECT nummer,beschreibung, id FROM importvorlage");
 		$table = new EasyTable($this->app);
    $this->app->Tpl->Set('INHALT',"");
		$this->app->YUI->TableSearch($this->parsetarget,"importvorlage");
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
