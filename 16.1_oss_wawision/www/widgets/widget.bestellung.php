<?php
include ("_gen/widget.gen.bestellung.php");

class WidgetBestellung extends WidgetGenBestellung 
{
  private $app;
  function WidgetBestellung(&$app,$parsetarget)
  {
    $this->app = &$app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenBestellung($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {

    $this->app->YUI->AutoComplete("adresse","lieferant",1);
    $this->app->YUI->AutoComplete("projekt","projektname",1);

    if($this->app->Secure->GetGET("action")=="edit"){
      $this->app->Tpl->Add(FURTHERTABS,'<li><a href="index.php?module=bestellung&action=minidetail&id=[ID]&frame=true#tabs-4">Protokoll</a></li>');
      $this->app->Tpl->Add(FURTHERTABSDIV,'<div id="tabs-4"></div>');
    }

    $this->app->YUI->DatePicker("datum");


    $this->app->YUI->DatePicker("bestaetigteslieferdatum");
    $this->app->YUI->DatePicker("gewuenschteslieferdatum");

    $this->form->ReplaceFunction("datum",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("gewuenschteslieferdatum",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("bestaetigteslieferdatum",$this,"ReplaceDatum");
    //$this->form->ReplaceFunction("lieferdatum",&$this,"ReplaceDatum");
    $this->form->ReplaceFunction("projekt",$this,"ReplaceProjekt");
    $this->form->ReplaceFunction("adresse",$this,"ReplaceLieferant");

  
    $versandart = $this->app->erp->GetVersandartAuftrag();
    $zahlungsweise = $this->app->erp->GetZahlungsweise();
    $zahlungsstatus= $this->app->erp->GetZahlungsstatus();
    $typ = $this->app->erp->GetKreditkarten();
    $status = $this->app->erp->GetStatusAuftrag();

        for($i=2009;$i<2020;$i++)
        {
          $jahr[] = $i;
        }

        for($i=1;$i<13;$i++)
        {
          $monat[] = $i;
        }

    //$this->app->erp->GetSelect($versandart,$this->app->
    $field = new HTMLSelect("versandart",0);
    $field->onchange="versand(this.form.versandart.options[this.form.versandart.selectedIndex].value);";
    $field->AddOptionsSimpleArray($versandart);
    $this->form->NewField($field);

    $field = new HTMLSelect("kreditkarte_typ",0);
    $field->AddOptionsSimpleArray($typ);
    $this->form->NewField($field);

    $field = new HTMLSelect("kreditkarte_monat",0);
    $field->AddOptionsSimpleArray($monat);
    $this->form->NewField($field);

    $field = new HTMLSelect("kreditkarte_jahr",0);
    $field->AddOptionsSimpleArray($jahr);
    $this->form->NewField($field);

//    $this->app->Tpl->Set(ONCHANGE_ZAHLUNGSART,"onchange=\"aktion_buchen(this.form.zahlungsweise.options[this.form.zahlungsweise.selectedIndex].value);\"");


    $field = new HTMLSelect("zahlungsweise",0);
    $field->onchange="aktion_buchen(this.form.zahlungsweise.options[this.form.zahlungsweise.selectedIndex].value);";
    $field->AddOptionsSimpleArray($zahlungsweise);
    $this->form->NewField($field);


    $field = new HTMLSelect("zahlungsstatus",0);
    $field->AddOptionsSimpleArray($zahlungsstatus);
    $this->form->NewField($field);

    $field = new HTMLCheckbox("abweichendelieferadresse","","","1");
    $field->onclick="abweichend(this.form.abweichendelieferadresse.value);";
    $this->form->NewField($field);

    $field = new HTMLInput("land","hidden","");
    $this->form->NewField($field);

    $field = new HTMLInput("lieferland","hidden","");
    $this->form->NewField($field);

 		$field = new HTMLInput("datum","text","",10);
    //$field->readonly="readonly";
    $this->form->NewField($field);
 
  }

  function ReplaceProjekt($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceProjekt($db,$value,$fromform);
  }

  function ReplaceLieferant($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceLieferantennummer($db,$value,$fromform);
  }

  function ReplaceDatum($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceDatum($db,$value,$fromform);
  }

  function ReplaceDecimal($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceDecimal($db,$value,$fromform);
  }




}
?>
