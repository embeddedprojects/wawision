<?php
include ("_gen/widget.gen.gutschrift.php");

class WidgetGutschrift extends WidgetGenGutschrift 
{
  private $app;
  function WidgetGutschrift(&$app,$parsetarget)
  {
    $this->app = &$app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenGutschrift($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $this->app->YUI->AutoComplete("adresse","kunde",1);
    $this->app->YUI->AutoComplete("projekt","projektname",1);
    $this->app->YUI->AutoComplete("rechnungid","rechnung",1);
    $this->app->YUI->AutoComplete("aktion","aktionscode",1);

    //$this->app->YUI->DatePicker("datum");
    $this->app->YUI->DatePicker("ustbrief_eingang_am");
    $this->app->YUI->DatePicker("lieferdatum");
    $this->app->YUI->DatePicker("datum");
    $this->app->YUI->DatePicker("manuell_vorabbezahlt");

    if($this->app->Secure->GetGET("action")=="edit")
    { 
      $this->app->Tpl->Add(FURTHERTABS,'<li><a href="index.php?module=gutschrift&action=minidetail&id=[ID]&frame=true#tabs-4">Protokoll</a></li>');
      $this->app->Tpl->Add(FURTHERTABSDIV,'<div id="tabs-4"></div>');                
    }

    $id = $this->app->Secure->GetGET("id");
    $stornorechnung = $this->app->DB->Select("SELECT stornorechnung FROM gutschrift WHERE id='$id' LIMIT 1");
    if($stornorechnung)
      $this->app->Tpl->Set(BEZEICHNUNGTITEL,$this->app->erp->Firmendaten("bezeichnungstornorechnung"));
    else
      $this->app->Tpl->Set(BEZEICHNUNGTITEL,'Gutschrift');

    $this->app->Tpl->Set(BEZEICHNUNGSTORNORECHNUNG,$this->app->erp->Firmendaten("bezeichnungstornorechnung"));


    $this->form->ReplaceFunction("datum",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("manuell_vorabbezahlt",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("ustbrief_eingang_am",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("projekt",$this,"ReplaceProjekt");
    $this->form->ReplaceFunction("adresse",$this,"ReplaceKunde");
    $this->form->ReplaceFunction("rechnungid",$this,"ReplaceRechnung");
    //    $this->form->ReplaceFunction("rechnung",&$this,"ReplaceRechnung");


    $zahlungsweise = $this->app->erp->GetZahlungsweiseGutschrift();

    $zahlungsstatus= $this->app->erp->GetZahlungsstatus();

    $zahlungsstatus= $this->app->DB->Select("SELECT zahlungsstatus FROM gutschrift WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set(ZAHLUNGSSTATUS,$zahlungsstatus);

    $status = $this->app->erp->GetStatusGutschrift();

    //$this->app->erp->GetSelect($versandart,$this->app->

    $field = new HTMLSelect("zahlungsweise",0);
    $field->onchange="aktion_buchen(this.form.zahlungsweise.options[this.form.zahlungsweise.selectedIndex].value);";
    $field->AddOptionsSimpleArray($zahlungsweise);
    $this->form->NewField($field);


    $field = new HTMLInput("land","hidden","");
    $this->form->NewField($field);


    $field = new HTMLInput("datum","text","",10);
    $field->readonly="readonly";
    $this->form->NewField($field);

    $id = $this->app->Secure->GetGET("id");
    $rechnung = $this->app->DB->Select("SELECT rechnung FROM gutschrift WHERE id='$id' LIMIT 1");
    $adresse_gut = $this->app->DB->Select("SELECT adresse FROM gutschrift WHERE id='$id' LIMIT 1");
    /*
       $rechnungid = $this->app->DB->Select("SELECT id FROM rechnung WHERE belegnr='$rechnung' AND adresse='$adresse_gut' LIMIT 1");
       if($rechnungid > 0)
       $this->app->DB->Update("UPDATE gutschrift SET rechnungid='$rechnungid' WHERE id='$id' LIMIT 1");
       else
       $this->app->DB->Update("UPDATE gutschrift SET rechnungid='' WHERE id='$id' LIMIT 1");
     */
  }

  function ReplaceProjekt($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceProjekt($db,$value,$fromform);
  }


  function ReplaceRechnung($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceRechnung($db,$value,$fromform);
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
