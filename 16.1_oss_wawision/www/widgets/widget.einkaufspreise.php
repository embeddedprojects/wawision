<?php
include ("_gen/widget.gen.einkaufspreise.php");

class WidgetEinkaufspreise extends WidgetGenEinkaufspreise 
{
  private $app;
  function WidgetEinkaufspreise($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenEinkaufspreise($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $this->form->ReplaceFunction("adresse",$this,"ReplaceLieferant");
    $this->form->ReplaceFunction("vpe",$this,"ReplaceVPE");
    $this->form->ReplaceFunction("projekt",$this,"ReplaceProjekt");
    $this->form->ReplaceFunction("gueltig_bis",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("preis_anfrage_vom",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("datum_lagerlieferant",$this,"ReplaceDatum");

    $this->form->ReplaceFunction("preis",$this,"ReplaceBetrag");

    $this->app->YUI->AutoComplete("projekt","projektname",1);
    $this->app->YUI->AutoComplete("adresse","lieferant");


   
    $this->app->YUI->DatePicker("preis_anfrage_vom"); 
    $this->app->YUI->DatePicker("gueltig_bis"); 
    $this->app->YUI->DatePicker("datum_lagerlieferant"); 

    $action = $this->app->Secure->GetGET("action");
    if($action=="einkauf")
    { 
      // liste zuweisen
      $pid = $this->app->Secure->GetGET("id");
      $this->app->Secure->POST["artikel"]=$pid;
      $field = new HTMLInput("artikel","hidden",$pid);
      $this->form->NewField($field);
    }

    $this->app->Secure->POST["firma"]=$this->app->User->GetFirma();
    $field = new HTMLInput("firma","hidden",$this->app->User->GetFirma());
    $this->form->NewField($field);

		$this->app->Tpl->Set(VPEPREIS,"<input type=\"button\" value=\"Einzelstückpreis berechnen\" onclick=\"var wert = prompt('Gesamtpreis VPE:');
				wert = wert.replace(',', '.'); document.getElementById('preis').value=parseFloat(wert/document.getElementById('vpe').value).toFixed(4); document.getElementById('ab_menge').value=1\">");
  }

  function ReplaceVPE($db,$value,$fromform)
  {
		if($fromform && $value<1)
		return 1;
		else return $value;
  }

  function ReplaceProjekt($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceProjekt($db,$value,$fromform);
  }

  function ReplaceDatum($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceDatum($db,$value,$fromform);
  }

  function ReplaceBetrag($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceBetrag($db,$value,$fromform);
  }

  function ReplaceLieferant($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceLieferant($db,$value,$fromform);
  }

  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT nummer, name_de as name,barcode, id FROM einkaufspreise order by nummer");
    $table->Display($this->parsetarget);
  }



  public function Search()
  {
    $this->app->Tpl->Set($this->parsetarget,"suchmaske");
    //$this->app->Table(
    //$table = new OrderTable("veranstalter");
    //$table->Heading(array('Name','Homepage','Telefon'));
  }


}
?>
