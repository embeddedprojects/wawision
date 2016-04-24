<?php
include ("_gen/widget.gen.rechnung.php");

class WidgetRechnung extends WidgetGenRechnung 
{
  private $app;
  function WidgetRechnung(&$app,$parsetarget)
  {
    $this->app = &$app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenRechnung($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {

    $this->app->YUI->AutoComplete("adresse","kunde",1);
    $this->app->YUI->AutoComplete("projekt","projektname",1);
    $this->app->YUI->AutoComplete("lieferschein","lieferschein",1);
    $this->app->YUI->AutoComplete("auftragid","auftrag",1);
    $this->app->YUI->AutoComplete("gruppe","verband");
    $this->app->YUI->AutoComplete("aktion","aktionscode",1);

    if($this->app->Secure->GetGET("action")=="edit")
    {
      $this->app->Tpl->Add(FURTHERTABS,'<li><a href="index.php?module=rechnung&action=minidetail&id=[ID]&frame=true#tabs-4">Protokoll</a></li>');
      $this->app->Tpl->Add(FURTHERTABSDIV,'<div id="tabs-4"></div>');
    }




    //$this->app->YUI->DatePicker("datum");
    $this->app->YUI->DatePicker("ustbrief_eingang_am");
    $this->app->YUI->DatePicker("lieferdatum");
    $this->app->YUI->DatePicker("datum");
    $this->app->YUI->DatePicker("einzugsdatum");
    $this->app->YUI->DatePicker("mahnwesen_datum");


    if($auftragArr[0]['rma']==1)
      $this->app->YUI->ParserVarIf(RMA,1);
    else
      $this->app->YUI->ParserVarIf(RMA,0);

    $this->form->ReplaceFunction("adresse",$this,"ReplaceKundennummer");
    $this->form->ReplaceFunction("projekt",$this,"ReplaceProjekt");

    $this->form->ReplaceFunction("datum",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("einzugsdatum",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("mahnwesen_datum",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("lieferdatum",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("ustbrief_eingang_am",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("lieferschein",$this,"ReplaceLieferschein");
    $this->form->ReplaceFunction("gruppe",$this,"ReplaceGruppe");
    $this->form->ReplaceFunction("auftragid",$this,"ReplaceAuftrag");
    $this->form->ReplaceFunction("datum",$this,"ReplaceDatum");

    $zahlungsweise = $this->app->erp->GetZahlungsweise();
    $zahlungsstatus= $this->app->erp->GetZahlungsstatus();

    $id = $this->app->Secure->GetGET("id");
    $zahlungsstatus= $this->app->DB->Select("SELECT zahlungsstatus FROM rechnung WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set(ZAHLUNGSSTATUS,$zahlungsstatus);

    $status = $this->app->erp->GetStatusRechnung();

    $field = new HTMLSelect("zahlungsweise",0);
    $field->onchange="aktion_buchen(this.form.zahlungsweise.options[this.form.zahlungsweise.selectedIndex].value);";
    $field->AddOptionsSimpleArray($zahlungsweise);
    $this->form->NewField($field);

    $field = new HTMLInput("land","hidden","");
    $this->form->NewField($field);


    for($i=date('Y');$i<date('Y')+20;$i++)
    {
      $jahr[] = $i;
    }

    for($i=1;$i<13;$i++)
    {
      $monat[] = $i;
    }


    $field = new HTMLSelect("kreditkarte_typ",0);
    $field->AddOptionsSimpleArray($typ);
    $this->form->NewField($field);

    $field = new HTMLSelect("kreditkarte_monat",0);
    $field->AddOptionsSimpleArray($monat);
    $this->form->NewField($field);

    $field = new HTMLSelect("kreditkarte_jahr",0);
    $field->AddOptionsSimpleArray($jahr);
    $this->form->NewField($field);

    $field = new HTMLInput("datum","text","",10);
    $field->readonly="readonly";
    $this->form->NewField($field);
  }

  function ReplaceGruppe($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceGruppe($db,$value,$fromform);
  }

  function ReplaceProjekt($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceProjekt($db,$value,$fromform);
  }

  function ReplaceKundennummer($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceKundennummer($db,$value,$fromform);
  }

  function ReplaceDatum($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceDatum($db,$value,$fromform);
  }

  function ReplaceLieferschein($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceLieferschein($db,$value,$fromform);
  }

  function ReplaceAuftrag($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceAuftrag($db,$value,$fromform);
  }




}
?>
