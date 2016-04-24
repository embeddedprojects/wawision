<?php
include ("_gen/widget.gen.lieferschein.php");

class WidgetLieferschein extends WidgetGenlieferschein 
{
  private $app;
  function WidgetLieferschein(&$app,$parsetarget)
  {
    $this->app = &$app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenlieferschein($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {

    if($this->app->Secure->GetGET("action")=="edit")
    {
      $this->app->Tpl->Add('FURTHERTABS','<li><a href="index.php?module=lieferschein&action=minidetail&id=[ID]&frame=true#tabs-4">Protokoll</a></li>');
      $this->app->Tpl->Add('FURTHERTABSDIV','<div id="tabs-4"></div>');
    }

    $this->app->YUI->AutoComplete("adresse","kunde",1);
    $this->app->YUI->AutoComplete("lieferant","lieferant",1);
    $this->app->YUI->AutoComplete("projekt","projektname",1);
    $this->app->YUI->AutoComplete("auftragid","auftrag",1);
    $this->app->YUI->AutoComplete("aktion","aktionscode",1);

    $this->form->ReplaceFunction("datum",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("projekt",$this,"ReplaceProjekt");
    $this->form->ReplaceFunction("adresse",$this,"ReplaceKunde");
    $this->form->ReplaceFunction("lieferant",$this,"ReplaceLieferant");
    $this->form->ReplaceFunction("auftragid",$this,"ReplaceAuftrag");

    $versandart = $this->app->erp->GetVersandartAuftrag();
    $field = new HTMLSelect("versandart",0);
    $field->onchange="versand(this.form.versandart.options[this.form.versandart.selectedIndex].value);";
    $field->AddOptionsSimpleArray($versandart);
    $this->form->NewField($field);

    $status = $this->app->erp->GetStatusLieferschein();

    $field = new HTMLInput("land","hidden","");
    $this->form->NewField($field);

    $field = new HTMLCheckbox("lieferantenretoure","","","1");
    $field->onclick="lieferantenretoureanzeige(this.form.lieferantenretoure.value);";
    $this->form->NewField($field);

 		$field = new HTMLInput("datum","text","",10);
    $field->readonly="readonly";
    $this->form->NewField($field);
  }

  function ReplaceProjekt($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceProjekt($db,$value,$fromform);
  }


  function ReplaceAuftrag($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceAuftrag($db,$value,$fromform);
  }


  function ReplaceLieferant($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceLieferantennummer($db,$value,$fromform);
  }


  function ReplaceKunde($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceKundennummer($db,$value,$fromform);
  }

  function ReplaceDatum($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceDatum($db,$value,$fromform);
  }

}
?>
