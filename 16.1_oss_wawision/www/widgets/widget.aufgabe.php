<?php
include ("_gen/widget.gen.aufgabe.php");

class WidgetAufgabe extends WidgetGenAufgabe 
{
  private $app;
  function WidgetAufgabe($app,$parsetarget)
  {
    $this->app = $app;
    $this->parsetarget = $parsetarget;
    parent::WidgetGenAufgabe($app,$parsetarget);
    $this->ExtendsForm();
  }

  function ExtendsForm()
  {
    $action = $this->app->Secure->GetGET("action");
    if($action=="create")
    {
      $this->app->Secure->POST["initiator"]=$this->app->User->GetAdresse();
      $field = new HTMLInput("initiator","hidden",$this->app->User->GetAdresse());
      $this->form->NewField($field);
      // liste zuweisen
      $this->app->Secure->POST["angelegt_am"]=date('Y-m-d');
      $field = new HTMLInput("angelegt_am","hidden",date('Y-m-d'));
      $this->form->NewField($field);
    }

    $this->app->YUI->AutoComplete("adresse","mitarbeiter");
    $this->app->YUI->AutoComplete("projekt","projektname",1);
    $this->app->YUI->TimePicker("abgabe_bis_zeit");

    $this->app->YUI->AutoComplete("kunde","kunde");


    $this->form->ReplaceFunction("projekt",$this,"ReplaceProjekt");
    $this->form->ReplaceFunction("adresse",$this,"ReplaceMitarbeiter");
    $this->form->ReplaceFunction("kunde",$this,"ReplaceKunde");
    $this->form->ReplaceFunction("stunden",$this,"ReplaceDecimal");

    $this->app->YUI->DatePicker("abgabe_bis");
    $this->app->YUI->DatePicker("startdatum");

    $this->form->ReplaceFunction("abgabe_bis",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("abgabe_bis_zeit",$this,"ReplaceZeit");
    $this->form->ReplaceFunction("startdatum",$this,"ReplaceDatum");
    $this->form->ReplaceFunction("startzeit",$this,"ReplaceZeit");
  }


  function ReplaceProjekt($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceProjekt($db,$value,$fromform);
  }

  function ReplaceDecimal($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceDecimal($db,$value,$fromform);
  }

  function ReplaceKunde($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceKunde($db,$value,$fromform);
  }


  function ReplaceMitarbeiter($db,$value,$fromform)
  {
    return $this->app->erp->ReplaceMitarbeiter($db,$value,$fromform);
  }

  function ReplaceZeit($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(strlen($value) > 5) $dbformat = 1;

    // wenn ziel datenbank
    if($db)
    { 
      if($dbformat) return $value;
      else return $this->app->String->Convert($value,"%1:%2","%1:%2:00");
    }
    // wenn ziel formular
    else
    { 
      if($dbformat) return $this->app->String->Convert($value,"%1:%2:%3","%1:%2");
      else return $value;
    }
  }


  function ReplaceDatum($db,$value,$fromform)
  { 
    //value muss hier vom format ueberprueft werden
    $dbformat = 0;
    if(strpos($value,'-') > 0) $dbformat = 1;

    // wenn ziel datenbank
    if($db)
    { 
      if($dbformat) return $value;
      else return $this->app->String->Convert($value,"%1.%2.%3","%3-%2-%1");
    }
    // wenn ziel formular
    else
    { 
      if($dbformat) return $this->app->String->Convert($value,"%1-%2-%3","%3.%2.%1");
      else return $value;
    }
  }


  public function Table()
  {
    $table = new EasyTable($this->app);  
    $table->Query("SELECT nummer, name_de as name,barcode, id FROM aufgabe order by nummer");
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
