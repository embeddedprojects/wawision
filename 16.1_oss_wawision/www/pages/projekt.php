<?php
/*
**** COPYRIGHT & LICENSE NOTICE *** DO NOT REMOVE ****
* 
* WaWision (c) embedded projects GmbH, Holzbachstrasse 4, D-86154 Augsburg, * Germany 2015 
*
* This file is licensed under the Embedded Projects General Public License *Version 3.1. 
*
* You should have received a copy of this license from your vendor and/or *along with this file; If not, please visit www.wawision.de/Lizenzhinweis 
* to obtain the text of the corresponding license version.  
*
**** END OF COPYRIGHT & LICENSE NOTICE *** DO NOT REMOVE ****
*/
?>
<?php
include ("_gen/projekt.php");

class Projekt extends GenProjekt {
  var $app;

  function Projekt($app) {
    //parent::GenProjekt($app);
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","ProjektCreate");
    $this->app->ActionHandler("edit","ProjektEdit");
    $this->app->ActionHandler("list","ProjektList");
    $this->app->ActionHandler("pdf","ProjektPDF");
    $this->app->ActionHandler("delete","ProjektDelete");
    $this->app->ActionHandler("dateien","ProjektDateien");
    $this->app->ActionHandler("zeit","ProjektZeit");
    $this->app->ActionHandler("material","ProjektMaterial");
    $this->app->ActionHandler("arbeitsnachweise","ProjektArbeitsnachweise");
    $this->app->ActionHandler("arbeitsnachweispdf","ProjektArbeitsnachweisPDF");
    $this->app->ActionHandler("arbeitspaket","ProjektArbeitspaket");
    $this->app->ActionHandler("arbeitspaketeditpopup","ProjektArbeitspaketEditPopup");
    $this->app->ActionHandler("arbeitspaketdelete","ProjektArbeitspaketDelete");
    $this->app->ActionHandler("arbeitspaketdisable","ProjektArbeitspaketDisable");
    $this->app->ActionHandler("arbeitspaketcopy","ProjektArbeitspaketCopy");
    $this->app->ActionHandler("nextnumber","ProjektNextnumber");
    $this->app->ActionHandler("getnextnumber","ProjektGetNextNumber");

    $this->app->ActionHandler("minidetail","ProjektMiniDetail");
    $this->app->ActionHandler("plan","ProjektPlan");

    $this->app->ActionHandler("kostenstellen","ProjektKostenstellen");
    $this->app->ActionHandler("schaltung","ProjektSchaltung");


    $this->app->ActionHandlerListen($app);


    $this->app = $app;
  }
  
  function ProjektNextnumber()
  {
    $id = $this->app->Secure->GetGET("id");
    $nummer = (int)$this->app->Secure->GetGET("nummer");
    $cmd = $this->app->Secure->GetGET("cmd");
    $projekt = $this->app->DB->SelectArr("SELECT * from projekt where id = '$id' LIMIT 1");
    if($projekt && $nummer)
    {
      $projekt = reset($projekt);
      if(isset($projekt['next_'.$cmd]))$this->app->DB->Update("UPDATE projekt set ".'next_'.$cmd."='".mysqli_real_escape_string($this->app->DB->connection,$nummer)."' where id = '$id'");
      
    }
    header('location: index.php?module=projekt&action=edit&id='.$id.'#tabs-4');
    exit;
  }
  
  function ProjektGetNextNumber()
  {
    $id = $this->app->Secure->GetGET("id");
    $projekt = $this->app->DB->SelectArr("SELECT * from projekt where id = '$id' LIMIT 1");
    if($projekt)
    {
      echo json_encode($projekt[0]);
    }
    exit;
  }

  function ProjektArbeitsnachweisPDF()
  {
    $date = $this->app->Secure->GetGET("date");

    $Brief = new ArbeitsnachweisPDF($this->app);
    $Brief->GetArbeitsnachweis($date);
    $Brief->displayDocument();
    exit;

  }

  function ProjektPlan()
  {
    $id = $this->app->Secure->GetGET("id");


    $this->ProjektMenu();

    $startarbeitspaket = 0;

    $baumtiefe = $this->ProjektPlanRekrusiv($id,$startarbeitspaket);

    $arbeitspakete = $this->ProjektPlanArbeitspaketeinReihenfolge($id,$baumtiefe);

    asort($arbeitspakete);

    $beschreibung = $this->app->DB->Select("SELECT beschreibung FROM projekt WHERE id='".$id."'");	
    $this->app->Tpl->Add('TAB1',"<h1>&Uuml;bersicht</h1><br><style>.border
        {
border: 1px solid black;
}</style>");

$this->app->Tpl->Add('TAB1',"<table width=700><tr><td>".nl2br($beschreibung)."</td></tr></table><br>");

$this->app->Tpl->Add('TAB1',"<h1>Umfang</h1><br>");
$this->app->Tpl->Add('TAB1',"<table border=0 class=border cellspacing=0 cellpadding=3 width=\"65%\">");

$pos = 1;

foreach($arbeitspakete as $key=>$value)
{
  $aufgabe = $this->app->DB->Select("SELECT aufgabe FROM arbeitspaket WHERE id='".$key."'");	
  $vorgaenger = $this->app->DB->Select("SELECT vorgaenger FROM arbeitspaket WHERE id='".$key."'");	
  $art = $this->app->DB->Select("SELECT art FROM arbeitspaket WHERE id='".$key."'");	

  if($art=="meilenstein")	
    $this->app->Tpl->Add('TAB1',"<tr><td width=20 class=border>$pos</td><td width=300 class=border><b>".$aufgabe."</b></td>");
  else
    $this->app->Tpl->Add('TAB1',"<tr><td width=20 class=border>$pos</td><td width=300 class=border>".$aufgabe."</td>");

  $painted=false;
  for($j=0;$j<$baumtiefe;$j++)
  {
    if($vorgaenger==$this->voraengerbaum[$j] && $painted==false){
      $this->app->Tpl->Add('TAB1',"<td width=20 class=border><b>X</b></td>");
      $painted=true;
    }
    else
      $this->app->Tpl->Add('TAB1',"<td width=20 class=border>&nbsp;</td>");

  }
  $this->app->Tpl->Add('TAB1',"</tr>");
  $pos++;
}
$this->app->Tpl->Add('TAB1',"</table><br><br>");


$this->app->Tpl->Add('TAB1',"<h1>Details</h1><br>");

$pos = 1;
foreach($arbeitspakete as $key=>$value)
{
  $aufgabe = $this->app->DB->Select("SELECT aufgabe FROM arbeitspaket WHERE id='".$key."'");	
  $vorgaenger = $this->app->DB->Select("SELECT vorgaenger FROM arbeitspaket WHERE id='".$key."'");	
  $art = $this->app->DB->Select("SELECT UPPER(art) FROM arbeitspaket WHERE id='".$key."'");	
  $beschreibung = $this->app->DB->Select("SELECT beschreibung FROM arbeitspaket WHERE id='".$key."'");	
  $vorgaenger_aufgabe = $this->app->DB->Select("SELECT aufgabe FROM arbeitspaket WHERE id='".$vorgaenger."'");	
  $abgabe_bis = $this->app->DB->Select("SELECT DATE_FORMAT(abgabedatum,'%d.%m.%Y') FROM arbeitspaket WHERE id='".$key."'");	

  if($abgabe_bis!="00.00.0000" && $abgabe_bis!="")
    $abgabe_bis = "<br>Abgabe bis $abgabe_bis";



  $zeit_geplant = $this->app->DB->Select("SELECT zeit_geplant FROM arbeitspaket WHERE id='".$key."'");	
  $kosten_geplant = $this->app->DB->Select("SELECT kosten_geplant FROM arbeitspaket WHERE id='".$key."'");	

  $gesamt_zeit = $gesamt_zeit + $zeit_geplant;
  $gesamt_kosten = $gesamt_kosten + $kosten_geplant;

  if($zeit_geplant=="0.00") $zeit_geplant="-"; else $zeit_geplant=$zeit_geplant." h";
  if($kosten_geplant=="0.00") $kosten_geplant="-"; else $kosten_geplant = $kosten_geplant." EUR";


  if($art=="MEILENSTEIN")
  {
    $kostentabelle = "Meilenstein (keine Kosten)";
  } else {

    $kostentabelle = "<table border=0 width=200>
      <tr><td>Stunden:</td><td>$zeit_geplant</td></tr>
      <tr><td>oder Fixkosten:</td><td>$kosten_geplant</td></tr>
      </table>";

  }
  $this->app->Tpl->Add(TAB1,"<br><h2>".$pos.". $aufgabe ($art)</h2><br>
      <table border=0 cellpadding=5 width=700 class=border>
      <tr><td><b>Beschreibung:</b></td><td><b>Aufwand:</b></td></tr>
      <tr valign=top><td width=420>".nl2br($beschreibung)."</td><td>
      $kostentabelle

      $abgabe_bis
      </td></tr></table>");
  $pos++;
}	


//Material
$this->app->Tpl->Add('TAB1',"<h1>Material</h1>");

$material = $this->app->DB->SelectArr("SELECT * FROM arbeitspaket 
    WHERE projekt='$id' AND art='material'");
for($m=0;$m < count($material);$m++)
{
  $aufgabe = $material[$m]['aufgabe'];
  $beschreibung = $material[$m]['beschreibung'];
  $kosten_geplant = $material[$m]['kosten_geplant'];
  $this->app->Tpl->Add('TAB1',"
      <table border=0 cellpadding=5 width=700 class=border>
      <tr><td><b>Material:</b>$aufgabe</td><td><b>Kosten:</b></td></tr>
      <tr valign=top><td width=420>".nl2br($beschreibung)."</td><td>
      <table border=0 width=200>
      <tr><td>Komplett:</td><td>$kosten_geplant EUR</td></tr>
      </table>
      </td></tr></table><br>");

  $gesamt_kosten = $gesamt_kosten + $kosten_geplant;
}


$stundensatz = "65";	

$gesamt = $gesamt_kosten + $gesamt_zeit*$stundensatz;

$this->app->Tpl->Add('TAB1',"<h1>Kosten</h1>

    <table border=0 cellpadding=5 width=700 class=border>
    <tr><td>Gesamt:</td></tr>
    <tr valign=top><td>
    <table border=0 width=100%>
    <tr><td width=430>Stunden:</td><td>$gesamt_zeit h (&#225; $stundensatz EUR)</td></tr>
    <tr><td>externe Kosten:</td><td>$gesamt_kosten EUR</td></tr>
    <tr><td>Gesamt:</td><td><b>$gesamt EUR</b>&nbsp;(zzgl. gesetzl. MwSt.)</td></tr>
    </table>
    </td></tr></table>
    ");

$this->app->Tpl->Set('TABTEXT',"Projektplan");
$this->app->Tpl->Parse('PAGE',"tabview.tpl");

}

var $ebene=0;
var $voraengerbaum;

function ProjektPlanArbeitspaketeinReihenfolge($id,$baumtiefe)
{
  $arbeitspakete = $this->app->DB->SelectArr("SELECT * FROM arbeitspaket WHERE projekt='$id' AND art!='material'");

  $reihenfolge = array();

  for($i=0;$i<count($arbeitspakete);$i++)
  {
    for($j=0;$j<$baumtiefe;$j++)
    {
      if($arbeitspakete[$i]['vorgaenger']==$this->voraengerbaum[$j]){
        $reihenfolge[$arbeitspakete[$i]['id']]=$j;
        $j=$baumtiefe;
      }
    }
  }
  return $reihenfolge;
}


function ProjektPlanRekrusiv($projekt,$id)
{
  $arbeitspakete = $this->app->DB->SelectArr("SELECT * FROM arbeitspaket 
      WHERE projekt='$projekt' AND vorgaenger='".$id."' AND art!='material'");

  if(count($arbeitspakete) <= 0) return 0;

  for($i=0;$i<count($arbeitspakete);$i++)
  {
    $this->voraengerbaum[]=$arbeitspakete[$i]['vorgaenger'];
    $anzahl++;
    $anzahl = $anzahl + $this->ProjektPlanRekrusiv($projekt,$arbeitspakete[$i]['id']);
  }
  return $anzahl;
}



function ProjektPDF()
{
  $id = $this->app->Secure->GetGET("id");

  //    $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");

  //    if(is_numeric($belegnr) && $belegnr!=0)
  {
    $Brief = new ProjektPDF($this->app);
    $Brief->GetProjekt($id);
    $Brief->displayDocument();
  } //else
  //     $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Noch nicht freigegebene Angeboten k&ouml;nnen nicht als PDF betrachtet werden.!</div>");

  $this->ProjektList();
}



function ProjektDelete()
{
  $ref = $_SERVER['HTTP_REFERER'];
  $id = $this->app->Secure->GetGET('id');
  if(is_numeric($id)) {
    $this->app->DB->Delete("DELETE FROM projekt WHERE id='$id' LIMIT 1");
    $this->app->DB->Delete("DELETE FROM geschaeftsbrief_vorlagen WHERE projekt='$id'");
  }
  header("Location: $ref");
  exit;
}

function ProjektMiniDetail()
{
  $id = $this->app->Secure->GetGET("id");
  $projekt = $this->app->DB->Select("SELECT projekt FROM arbeitspaket WHERE id='$id'");
  $beschreibung = $this->app->DB->Select("SELECT beschreibung FROM arbeitspaket WHERE id='$id'");
  $vorgaenger = $this->app->DB->Select("SELECT vorgaenger FROM arbeitspaket WHERE id='$id'");
  $vorgaenger_aufgabe = $this->app->DB->Select("SELECT aufgabe FROM arbeitspaket WHERE id='$vorgaenger'");

  $this->app->Tpl->Set('VORGAENGER',$vorgaenger_aufgabe);
  $this->app->Tpl->Set('BESCHREIBUNG',nl2br($beschreibung));
  $this->app->Tpl->Set('PROJEKT',$projekt);
  $this->app->Tpl->Set('ID',$id);

  $table = new EasyTable($this->app);

  $table->Query("
      SELECT 
      CONCAT('<input type=\"checkbox\" name=\"z_id[]\" value=\"',z.id,'\">') as '',
      DATE_FORMAT(z.bis, GET_FORMAT(DATE,'EUR')) AS Datum, 
      DATE_FORMAT(z.von,'%H:%i') as von, DATE_FORMAT(z.bis,'%H:%i') as bis,
      FORMAT(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600,2) AS Dauer,
      a.name as Mitarbeiter,
      IF(LENGTH(z.aufgabe) > 40, CONCAT('<a title=\"',z.aufgabe,'\" style=\"font-weight:normal\">',LEFT(z.aufgabe, 37), '...</a>'), 
        CONCAT('<a title=\"',z.aufgabe,'\" style=\"font-weight:normal\">',z.aufgabe,'</a>')) as Taetigkeit, 
      CONCAT(v.nummer,' ',v.beschreibung) as verrechnungsart,

      if(z.arbeitsnachweis > 0,CONCAT('<a href=\"index.php?module=arbeitsnachweis&action=edit&id=',z.arbeitsnachweis,'\" target=\"_blank\">gebucht</a>'),'-')  as arbeitsnachweis,

      CONCAT('<a href=\"#\" onclick=\"if(!confirm(\'Wirklich stornieren?\')) return false; else window.location.href=\'index.php?module=zeiterfassung&action=list&do=stornieren&lid=', z.id, '&back=projekt&back_id=$projekt\'\"><img src=\"./themes/new/images/delete.gif\"></a>&nbsp;<a href=\"index.php?module=zeiterfassung&action=create&id=', z.id, '&back=projekt&back_id=$projekt\" ><img src=\"./themes/new/images/edit.png\"></a>')

      FROM zeiterfassung z 
      LEFT JOIN adresse a ON a.id=z.adresse 
      LEFT JOIN adresse b ON b.id=z.adresse_abrechnung
      LEFT JOIN projekt p ON p.id=z.projekt 
      LEFT JOIN arbeitspaket ap ON z.arbeitspaket=ap.id
      LEFT JOIN verrechnungsart v ON v.nummer=z.verrechnungsart
      WHERE z.arbeitspaket='$id' AND (z.arbeitsnachweis IS NULL OR z.arbeitsnachweis=0) ORDER by z.von
      ");
  $table->DisplayNew('GEBUCHTEZEIT', "Menü","Action");

  $this->app->Tpl->Set(ID,$id);
  $this->app->Tpl->Output("projekt_minidetail.tpl");
  exit;
}

function ProjektDateien()
{
  $id = $this->app->Secure->GetGET("id");
  $this->ProjektMenu();
  $this->app->Tpl->Add('UEBERSCHRIFT'," (Dateien)");
  $this->app->YUI->DateiUpload('PAGE',"Projekt",$id);
}


function ProjektZeit()
{
  $id = $this->app->Secure->GetGET("id");
  $sid = $this->app->Secure->GetGET("sid");
  $this->ProjektMenu();
  $this->app->YUI->TableSearch(TAB1,"projektzeiterfassung");

  $this->app->Tpl->Add(TAB1,"<br><table width=\"100%\"><tr><td align=\"center\">
      <input type=\"submit\" value=\"Auftrag erzeugen\" name=\"auftragsubmit\">
      <input type=\"submit\" value=\"Status: Archiv / Freigabe\" name=\"auftragsubmit\">
      <!--			<input type=\"submit\" value=\"Rechnung erzeugen\" name=\"rechnungsubmit\">-->
      </td></tr></table><br></form>");

  $this->app->Tpl->Parse('PAGE',"zeiterfassunguebersicht.tpl");


  /*

  //    $auftragsubmit = $this->app->Secure->GetPOST("auftragsubmit");
  $lieferscheinsubmit = $this->app->Secure->GetPOST("lieferscheinsubmit");
  $z_id = $this->app->Secure->GetPOST("z_id");
  if($lieferscheinsubmit !="") {
  //				print_r($z_id);
  $adresse = $this->app->DB->Select("SELECT kunde FROM projekt WHERE id='$id' LIMIT 1");

  //			$lieferschein = $this-app->erp->CreateLieferschein($adresse);
  for($i=0;$i<count($z_id);$i++)
  {
  $single_z_id = $z_id[$i];
  //$dauer = $this->app->DB->Select("SELECT TIME_TO_SEC(TIMEDIFF(z.bis, z.von))/3600 AS Dauer FROM zeiterfassung z WHERE z.id='".$single_z_id."'");
  //echo $dauer."<br>";
  $this->app->DB->Select("UPDATE zeiterfassung SET ist_abgerechnet='1', abgerechnet='1' WHERE id='".$single_z_id."'");
  }

  }
  //   $rechnungsubmit = $this->app->Secure->GetPOST("rechnungsubmit");

  $this->app->Tpl->Set(TABTEXT,"Zeiterfassung");

  $tmp = $this->app->DB->SelectArr("SELECT * FROM arbeitspaket WHERE projekt='$id'");

  $options="<option>Alle</option>";

  if($sid=="ohne")	
  $options.="<option value=\"ohne\">Ohne</option>";
  else
  $options.="<option value=\"ohne\">Ohne</option>";

  for($i=0;$i<count($tmp);$i++)
  {

  if($sid==$tmp[$i][id])$checked="selected"; else $checked="";
  $options .="<option value=\"".$tmp[$i][id]."\" $checked>".$tmp[$i][aufgabe]."</option>";

  }

  $this->app->Tpl->Add(INHALT,"
  <script>
  $(function(){
  // bind change event to select
  $('#dynamic_select').bind('change', function () {
  var url = $(this).val(); // get selected value
  if (url) { // require a URL
  window.location = 'index.php?module=projekt&action=zeit&id=$id&sid='+url; // redirect
  }
  return false;
  });
  });
  </script>

  <table width=\"100%\"><tr><td align=\"center\">Auswahl Unterprojekt/Arbeitspaket: <select id=\"dynamic_select\">$options</select></td></tr></table><br>
  <form action=\"\" method=\"post\">[EASYTABLE]");


  if($sid >0)
  $subwhere = " AND ap.id='$sid'";

  $table = new EasyTable($this->app);

  $table->Query("SELECT 
  if(z.abgerechnet,'&nbsp;&nbsp;-',CONCAT('<input type=\"checkbox\" value=\"',z.id,'\" name=\"z_id[]\" checked>')) as 'übernehmen', 
  DATE_FORMAT(z.bis, GET_FORMAT(DATE,'EUR')) AS Datum, 
  a.name as mitarbeiter,
  DATE_FORMAT(z.von,'%H:%i') as start, DATE_FORMAT(z.bis,'%H:%i') as ende,
  TIMEDIFF(z.bis, z.von) AS Dauer,
  ap.aufgabe as 'unterprojekt/Aufgabe', 
  z.aufgabe as Taetigkeit, 
  if(abgerechnet,'ja','nein') as abgrechnet,
    CONCAT('<a href=\"index.php?module=zeiterfassung&action=create&id=',z.id,'&back=projekt&back_id=$id&back_sid=$sid\"><img src=\"themes/new/images/edit.png\"></a>&nbsp;
        <a href=\"#\" onclick=\"if(!confirm(\'Wirklich stornieren?\')) return false; else window.location.href=\'index.php?module=zeiterfassung&action=list&do=stornieren&back=projekt&back_id=$id&back_sid=$sid&lid=',z.id,'\'\"><img src=\"themes/new/images/delete.gif\"></a>&nbsp;') as Menü
      FROM zeiterfassung z LEFT JOIN adresse a ON a.id=z.adresse LEFT JOIN arbeitspaket ap ON z.arbeitspaket=ap.id
      WHERE z.projekt=$id $subwhere
      ORDER BY 7,Datum, bis DESC
      ");
  $table->DisplayNew(EASYTABLE, "Menü","noAction");

  $summe = $this->app->DB->Select("SELECT
      SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(z.bis, z.von))))
      FROM zeiterfassung z LEFT JOIN adresse a ON a.id=z.adresse LEFT JOIN arbeitspaket ap ON z.arbeitspaket=ap.id
      WHERE z.projekt=$id $subwhere");

  //$this->app->Tpl->Add(INHALT,"<br>Summe offen: $summe Summe gesamt: $summegesamt<br>");
  //$this->app->Tpl->Add(INHALT,"Summe offen: $summeeur EUR");
  //$this->app->Tpl->Add(INHALT,"Summe offen: $summeeur EUR");
  $this->app->Tpl->Add(EXTEND,"Summe: $summe");

  $this->app->Tpl->Add(INHALT,"<br><table width=\"100%\"><tr><td align=\"center\">
      <!--<input type=\"submit\" value=\"Auftrag erzeugen\" name=\"auftragsubmit\">-->
      <input type=\"submit\" value=\"Arbeitszeiten freigeben\" name=\"lieferscheinsubmit\">
      <!--			<input type=\"submit\" value=\"Rechnung erzeugen\" name=\"rechnungsubmit\">-->
      </td></tr></table><br></form>");

  $this->app->Tpl->Parse(TAB1,"projekt_zeiterfassung.tpl");

  $this->app->Tpl->Parse(PAGE,"tabview.tpl");
  */
}


function ProjektMaterial()
{
  $id = $this->app->Secure->GetGET("id");
  $this->app->Tpl->Set('TABTEXT',"Materialeinsatz");
  $this->app->Tpl->Set('SUBSUBHEADING',"Positionen aus Bestellungen");
  $table = new EasyTable($this->app);
  $table->Query("SELECT  bp.bezeichnunglieferant as artikel, a.name as lieferant,b.belegnr as bestellung, bp.menge, bp.preis,menge*preis as gesamt, if(bp.abgerechnet,'ja','nein') as rechung FROM bestellung_position bp 
      LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN adresse a ON b.adresse=a.id WHERE bp.projekt='$id' ORDER By bp.bestellung");

  $table->DisplayNew('MATERIAL', "abgerechnet","noAction");

  $summe = $this->app->DB->Select("SELECT  SUM(menge*preis) FROM bestellung_position WHERE projekt='$id' AND abgerechnet!='1' ORDER By bestellung");
  $summevk= $this->ProjektOffenesMaterial($id);
  $summegesamt = $summe;

  $this->app->Tpl->Add('MATERIAL',"<br>Summe offen: $summe ");
  $this->app->Tpl->Add('MATERIAL',"<br>Summe offen: $summevk ");
  $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");


  $this->app->Tpl->Set('SUBSUBHEADING',"Positionen aus Lieferungen");
  $table = new EasyTable($this->app);
  $table->Query("SELECT  bp.menge, bp.bezeichnung as artikel, bp.seriennummer, b.belegnr as lieferschein, if(bp.abgerechnet,'ja','nein') as rechnung FROM lieferschein_position bp 
      LEFT JOIN lieferschein b ON bp.lieferschein=b.id LEFT JOIN adresse a ON b.adresse=a.id WHERE b.projekt='$id' ORDER By bp.lieferschein");

  $table->DisplayNew('MATERIAL', "abgerechnet","noAction");

  $summe = $this->app->DB->Select("SELECT  SUM(menge*preis) FROM bestellung_position WHERE projekt='$id' AND abgerechnet!='1' ORDER By bestellung");
  $summegesamt = $summe;

  //$this->app->Tpl->Add(INHALT,"<br>Summe offen: $summe Summe gesamt: $summegesamt<br>");



  $this->app->Tpl->Set('SUBSUBHEADING',"Material im Lager");
  $table = new EasyTable($this->app);
  $table->Query("SELECT  DISTINCT a.name_de as artikel, a.nummer, lp.kurzbezeichnung as regal, lpi.menge, a.hersteller FROM lager_platz_inhalt lpi
      LEFT JOIN artikel a ON a.id=lpi.artikel LEFT JOIN lager_platz lp ON lpi.lager_platz=lp.id WHERE a.projekt='$id' GROUP BY a.id");

  $table->DisplayNew('MATERIAL', "abgerechnet","noAction");

  $summe = $this->app->DB->Select("SELECT  SUM(menge*preis) FROM bestellung_position WHERE projekt='$id' AND abgerechnet!='1' ORDER By bestellung");
  $summegesamt = $summe;

  //$this->app->Tpl->Add(INHALT,"<br>Summe offen: $summe Summe gesamt: $summegesamt<br>");
}

function ProjektOffenesMaterial($id)
{
  $summe = $this->app->DB->Select("SELECT  SUM(menge*preis) FROM bestellung_position WHERE projekt='$id' AND abgerechnet!='1' ORDER By bestellung");
  $summevk= $summe*((100 + $this->app->erp->GetStandardMarge())/100);
  $summegesamt = $summe;
  return $summevk;
}

function ProjektOffeneZeit($id)
{
  $summe = $this->app->DB->Select("SELECT FORMAT(SUM(TIMEDIFF(bis, von))/10000,2) FROM zeiterfassung WHERE (art='' OR art='Arbeit') AND projekt='$id' AND abgerechnet!='1'");
  $summeeur = $summe*$this->app->erp->GetStandardStundensatz();

  return $summeeur;
}


function ProjektSchaltung()
{
  $id = $this->app->Secure->GetGET("id");
  $this->ProjektMenu();
  $this->app->Tpl->Add('UEBERSCHRIFT'," (Schaltung)");
  $this->app->Tpl->Set('PAGE',"
      <br>Neues Teilprojekt anlegen: <br>
      Name:<input type=text value=\"KUBUS 3B\"><br>Budget: <input type=text><br>Liefertermin: <input type=text value=>
      <br><br>
      <br><br>
      <table border=1><tr><td>Teilprojekt</td><td>Aktion</td></tr>
      <tr><td>Prototyp 1 KUBUS 3B</td><td><a>BOM</a>&nbsp;<a>Lagerbestand</a>&nbsp;<a>Bestellung</a>&nbsp;<a>Datenblaetter</a>&nbsp;<a>Schaltplan u. Layout</a>&nbsp;<a>Projekt Charter</a></td>
      <tr><td>SNOM Stick</td><td><a>BOM</a>&nbsp;<a>Lagerbestand</a>&nbsp;<a>Bestellung</a>&nbsp;<a>Datenblaetter</a>&nbsp;<a>Schaltplan u. Layout</a>&nbsp;<a>Projekt Charter</a></td>
      </table>
      <br><br>
      Prototyp 1 (inkl. eagle, stuecklisten, fertigungsauftrag fuer prototype, prueflisten, lagerbestand, bestellungsauftrag usw..)<br>Budget<br>Kostenstellen (ende mit 1)");
}


function ProjektKostenstellen()
{
  $id = $this->app->Secure->GetGET("id");
  $this->ProjektMenu();
  $this->app->Tpl->Add('UEBERSCHRIFT'," (Kostenstellen)");


  $summezeit = $this->ProjektOffeneZeit($id);
  $summevk = $this->ProjektOffenesMaterial($id);

  $kosten = $summezeit + $summevk;

  $this->app->Tpl->Set('KOSTEN',money_format('€ %!n',$kosten));
  $this->app->Tpl->Set('SUMMEZEIT',money_format('€ %!n',$summezeit));
  $this->app->Tpl->Set('SUMMEVK',money_format('€ %!n',$summevk));

  $this->ProjektMaterial();


  $this->app->Tpl->Parse('PAGE',"projekt_kostenstellen.tpl");

}



function ProjektCreate()
{
  //$this->app->Tpl->Add(TABS,
  //  "<a class=\"tab\" href=\"index.php?module=projekt&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a>");
  $this->app->erp->MenuEintrag("index.php?module=projekt&action=list","Zur&uuml;ck zur &Uuml;bersicht");
  parent::ProjektCreate();
}

function ProjektList()
{

  //$this->app->Tpl->Add(TABS,"<li><h2 class=\"allgemein\">Allgemein</h2></li>");
  $this->app->erp->MenuEintrag("index.php?module=projekt&action=list","&Uuml;bersicht");
  $this->app->erp->MenuEintrag("index.php?module=projekt&action=create","Neues Projekt anlegen");
  //$this->app->Tpl->Add(TABS,"<li><a  href=\"index.php\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");

  //    $this->app->Tpl->Set(UEBERSCHRIFT,"Projekte");
  //    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Projekte");

  $this->app->YUI->TableSearch('TAB1',"projekttabelle");
  $this->app->Tpl->Parse('PAGE',"projektuebersicht.tpl");
  /*

     $this->app->Tpl->Add(TABS,"<li><h2 class=\"allgemein\">Allgemein</h2></li>");
     $this->app->Tpl->Add(TABS,"<li><a  href=\"index.php?module=projekt&action=create\">Neues Projekt anlegen</a></li>");
     $this->app->Tpl->Add(TABS,"<li><a  href=\"index.php?module=projekt&action=search\">Projekt suchen</a></li>");
     $this->app->Tpl->Add(TABS,"<li><a  href=\"index.php?module=projekt&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");
     $this->app->Tpl->Add(TABS,"<li><br><br></li>");
     parent::ProjektList();
   */
}


function ProjektMenu($id="")
{
  if($id=="")
    $id = $this->app->Secure->GetGET("id");

  //$nummer = $this->app->Secure->GetPOST("nummer");

  if($this->app->Conf->WFdbType=="postgre") {
    if(is_numeric($id)) {
      $abk= $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$id' LIMIT 1");
      $name= $this->app->DB->Select("SELECT name FROM projekt WHERE id='$id' LIMIT 1");
    }
  }else {
    $abk= $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$id' LIMIT 1");
    $name= $this->app->DB->Select("SELECT name FROM projekt WHERE id='$id' LIMIT 1");
  }


  //    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Projekt $abk");
  //$this->app->Tpl->Add(KURZUEBERSCHRIFT2,$abk." ".$name);
  $this->app->Tpl->Add('KURZUEBERSCHRIFT2',$abk);

  $this->app->erp->MenuEintrag("index.php?module=projekt&action=edit&id=$id","Details");
  if($this->app->erp->Version()!="stock")
    $this->app->erp->MenuEintrag("index.php?module=projekt&action=dateien&id=$id","Dateien");
  if($this->app->erp->Version()!="stock")
    $this->app->erp->MenuEintrag("index.php?module=projekt&action=arbeitspaket&id=$id","Teilprojekte");
  //    $this->app->Tpl->Add(TABS,"<li><a href=\"index.php?module=projekt&action=edit&id=$id\">Adressen</a></li>");
  //$this->app->Tpl->Add(TABS,"<li><a href=\"index.php?module=projekt&action=schaltung&id=$id\">Schaltungen</a></li>");
  //$this->app->Tpl->Add(TABS,"<li><a href=\"index.php?module=projekt&action=edit&id=$id\">Kosten</a></li>");
  //$this->app->Tpl->Add(TABS,"<li><a href=\"index.php?module=projekt&action=edit&id=$id\">Wareneingang</a></li>");
  //    $this->app->erp->MenuEintrag("index.php?module=projekt&action=zeit&id=$id","Zeiterfassung");
  //    $this->app->erp->MenuEintrag("index.php?module=projekt&action=arbeitsnachweise&id=$id","Arbeitsnachweise");
  //$this->app->erp->MenuEintrag("index.php?module=projekt&action=kostenstellen&id=$id","Kostenstellen");
  if($this->app->erp->Version()!="stock")
    $this->app->erp->MenuEintrag("index.php?module=projekt&action=kostenstellen&id=$id","Auswertung");
  //$this->app->Tpl->Add(TABS,"<a href=\"index.php?module=projekt&action=kosten&id=$id\">idGesamtkalkulation</a>&nbsp;");
  // $this->app->erp->MenuEintrag("index.php?module=projekt&action=pdf&id=$id","PDF");
  if($this->app->erp->Version()!="stock")
    $this->app->erp->MenuEintrag("index.php?module=projekt&action=plan&id=$id","Projektplan");
    $this->app->erp->MenuEintrag("index.php?module=projekt&action=list","Zur&uuml;ck zur &Uuml;bersicht");

    //$this->app->erp->MenuEintrag("index.php?module=projekt&action=statistik&id=$id","Statistik");

}

function ProjektArbeitsnachweise()
{

  $this->ProjektMenu();

  $this->app->YUI->TableSearch('TAB1',"arbeitsnachweiseprojekt");
  $this->app->Tpl->Set('TABTEXT',"Arbeitsnachweise");
  $this->app->Tpl->Parse('PAGE',"tabview.tpl");
}

function ArbeitspaketReadDetails($index,&$ref)
{

}

function ProjektArbeitspaket()
{
  $this->ProjektMenu();

  $id = $this->app->Secure->GetGET("id");
  // neues arbeitspaket
  $widget = new WidgetArbeitspaket($this->app,'TAB2');
  $widget->form->SpecialActionAfterExecute("none",
      "index.php?module=projekt&action=arbeitspaket&id=$id#tabs-1");
  $this->app->Tpl->Set('TMPSCRIPT',"<script type=\"text/javascript\">$(document).ready(function(){ $('#tabs').tabs('select', 1); });</script>");

  $widget->Create();


  // easy table mit arbeitspaketen YUI als template 
  $this->app->YUI->TableSearch('TAB1',"projektzeiterfassung");

  $tmp = $this->app->DB->Select("SELECT SUM(zeit_geplant) FROM arbeitspaket WHERE projekt='$id'");

  $this->app->Tpl->Add('TAB1',"<div class=\"info\">Kontigent Projekt (mit abgeschlossenen) geplant: $tmp</div>");

  $this->app->Tpl->Parse('PAGE',"arbeitspaketeuebersicht.tpl");
}

function ProjektArbeitspaketEditPopup()
{
  //$frame = $this->app->Secure->GetGET("frame");
  $id = $this->app->Secure->GetGET("id");
  $sid = $this->app->Secure->GetGET("sid");
  $this->app->Tpl->Set('OPENDISABLE',"<!--");
  $this->app->Tpl->Set('CLOSEDISABLE',"-->");


  $sid = $this->app->DB->Select("SELECT projekt FROM arbeitspaket WHERE id='$id' LIMIT 1");
  //    $this->ProjektMenu($sid);

  if($this->app->Conf->WFdbType=="postgre") {
    if(is_numeric($sid)) {
      $abk= $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$sid' LIMIT 1");
      $name= $this->app->DB->Select("SELECT name FROM projekt WHERE id='$sid' LIMIT 1");
    }
  }else {
    $abk= $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$sid' LIMIT 1");
    $name= $this->app->DB->Select("SELECT name FROM projekt WHERE id='$sid' LIMIT 1");
  }


  $this->app->Tpl->Add('KURZUEBERSCHRIFT',"Projekt $abk");
  $this->app->Tpl->Add('KURZUEBERSCHRIFT2',$name);



  $this->app->erp->MenuEintrag("index.php?module=projekt&action=arbeitspaket&id=$sid","Zur&uuml;ck zur &Uuml;bersicht");
  $this->app->Tpl->Set('ABBRECHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=projekt&action=arbeitspaket&id=$sid';\">");

  $widget = new WidgetArbeitspaket($this->app,'TAB1');
  $widget->form->SpecialActionAfterExecute("close_refresh",
      "index.php?module=projekt&action=arbeitspaket&id=$sid#tabs-1");
  $widget->Edit();


  $this->app->Tpl->Add('TAB2',"Sie bearbeiten gerade ein Arbeitspaket. Erst nach dem Speichern k&ouml;nnen neue Arbeitspakete angelegt werden.");

  $this->app->Tpl->Parse('PAGE',"arbeitspaketeuebersicht.tpl");
}


function ProjektArbeitspaketDisable()
{
  //   $this->ArtikelMenu();
  $id = $this->app->Secure->GetGET("id");

  $sid = $this->app->DB->Select("SELECT projekt FROM arbeitspaket WHERE id='$id' LIMIT 1");
  $this->app->DB->Update("UPDATE arbeitspaket SET abgenommen=1,abgenommen_von='".$this->app->User->GetID()."' WHERE id='$id' LIMIT 1");
  header("Location: index.php?module=projekt&action=arbeitspaket&id=".$sid);
  exit;

}

function ProjektArbeitspaketDelete()
{
  //    $this->ArtikelMenu();
  $id = $this->app->Secure->GetGET("id");

  $sid = $this->app->DB->Select("SELECT projekt FROM arbeitspaket WHERE id='$id' LIMIT 1");
  $this->app->DB->Update("DELETE FROM arbeitspaket WHERE id='$id' LIMIT 1");
  header("Location: index.php?module=projekt&action=arbeitspaket&id=".$sid);
  exit;
}


function ProjektArbeitspaketCopy()
{
  $id = $this->app->Secure->GetGET("id");

  $id = $this->app->DB->MysqlCopyRow("arbeitspaket","id",$id);
  $this->app->DB->Update("UPDATE arbeitspaket SET geloescht='0', abgenommen='0', abgenommen_von='0', abgenommen_bemerkung='' WHERE id='$id' LIMIT 1");

  //$this->app->DB->Update("UPDATE einkaufspreise SET geloescht='1' WHERE id='$id' LIMIT 1");
  $sid = $this->app->DB->Select("SELECT projekt FROM arbeitspaket WHERE id='$id' LIMIT 1");
  header("Location: index.php?module=projekt&action=arbeitspaket&id=".$sid);
  exit;


}


function ProjektEdit()
{
  $this->ProjektMenu();
  $id = $this->app->Secure->GetGET("id");

  $msg = $this->app->Secure->GetGET("msg");
  $msg = base64_decode($msg);

  $this->app->Tpl->Set('MESSAGE',$msg);
  $this->app->Tpl->Set('TMPSCRIPT',"");



  $allowed = "/[^a-z0-9]/i";      
  $this->app->Secure->POST["abkuerzung"] = preg_replace($allowed,"",$this->app->Secure->POST["abkuerzung"]); 
  $this->app->Secure->POST["abkuerzung"]=substr(strtoupper($this->app->Secure->POST["abkuerzung"]),0,20);




  parent::ProjektEdit();

  if($this->app->Secure->GetPOST("speichern")!="")
  {
    if($this->app->Secure->GetGET("msg")=="")
    {
      $msg = $msg.$this->app->Tpl->Get('MESSAGE');
      $msg = base64_encode($msg);
    } else {
      $msg = base64_encode($msg);
    }

    header("Location: index.php?module=projekt&action=edit&id=$id&msg=$msg");
    exit;
  }


}


}
?>
