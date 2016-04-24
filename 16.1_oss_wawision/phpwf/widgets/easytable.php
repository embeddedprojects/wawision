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


class EasyTable {
  
  var $app;

  var $rows;
  var $dataset;
  var $headings;

  function EasyTable($app) 
  {
    $this->app = $app;
    $this->sql ="";
    $this->limit ="";
  }


  function AddRow($rows)
  {
    $this->datasets[] = $rows;
  }

  function Query($sql,$limit="",$newevent="")
  { 
    $this->sql = $sql; 
    $this->limit= $limit; 
    $this->headings="";
    
    if($limit!=0){
      $page = $this->app->Secure->GetGET("page");
      if(!is_numeric($page)) $page = 1;

      $this->page = $page;
      $this->start= ($page-1) * $this->limit; 

      $sql.= " LIMIT {$this->start},{$this->limit}";
    }
    $this->searchrow="";
    $this->datasets = $this->app->DB->SelectArr($sql);
    if(count($this->datasets)>0){
      foreach($this->datasets[0] as $colkey=>$value)
      {
	$this->headings[]=ucfirst($colkey);
	//$this->searchrow[0][$colkey]="<form action=\"\" method=\"post\"><input type=\"text\" style=\"width:100%; background-color:#fff;\"></form>";
      }
    }
    //$this->searchrow[0][id]="";
   
    //if(count($this->datasets)>=$limit)
    //  $this->datasets = $this->array_insert($this->datasets,0,$this->searchrow); 

    $this->searchrow="";
    if($newevent!="noAction")
      $this->headings[count($this->headings)-1] = 'Aktion';
  }
    // Fügt $value in $array ein, an der Stelle $index
    function array_insert($array, $index, $value)
    {
      return array_merge(array_slice($array, 0, $index), $value, array_slice($array, $index));
    }  


  function DisplayWithSort($parsetarget)
  {
    
    $htmltable = new HTMLTable(0,"100%","",3,1);
    $htmltable->width_headings = $this->width_headings;
    $htmltable->AddRowAsHeading($this->headings);

    $htmltable->ChangingRowColors('#e0e0e0','#fff');

    if(count($this->datasets)>0){
      foreach($this->datasets as $row){
	$htmltable->NewRow();
	foreach($row as $field)
	  $htmltable->AddCol($field);
      }
    } 
    $module = $this->app->Secure->GetGET("module");
    $htmltable->ReplaceCol(count($this->headings),
      "<a href=\"index.php?module=$module&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/edit.png\"></a>
      &nbsp;<a href=\"index.php?module=$module&action=delete&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/new.png\"></a>
      &nbsp;<a href=\"index.php?module=$module&action=delete&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/delete.png\"></a>
      &nbsp;<a href=\"index.php?module=$module&action=delete&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/up.png\"></a>
      &nbsp;<a href=\"index.php?module=$module&action=delete&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/down.png\"></a>
      ");
    
    $this->app->Tpl->Set($parsetarget,$htmltable->Get());
  }
  
  function DisplayWithDelivery($parsetarget)
  {
    
    $htmltable = new HTMLTable(0,"100%","",3,1);
    $htmltable->width_headings = $this->width_headings;
    $htmltable->AddRowAsHeading(array('Suchen','','',''));

    $htmltable->ChangingRowColors('#e0e0e0','#fff');

    if(count($this->datasets)>0){
      foreach($this->datasets as $row){
	$htmltable->NewRow();
	$link="";
	$cols=0;
	foreach($row as $key=>$field){
	  if($cols<3){
	    $htmltable->AddCol($field);
	    $cols++;
	  }
	  if($key!="id")
	    $link = $link."window.opener.document.getElementsByName('$key')[0].value='$field';";
	}
	$htmltable->AddCol("<input type=\"button\" onclick=\"
	      $link
	            window.close();
		          \" value=\"OK\">
			        ");

      }
    } 
    $module = $this->app->Secure->GetGET("module");
    /*
    $htmltable->ReplaceCol(4,
      "<input type=\"button\" onclick=\"
      $link
      window.close();
      \" value=\"OK\">
      ");
   */ 
    $this->app->Tpl->Set($parsetarget,$htmltable->Get());
  }


  function DisplayOwn($parsetarget,$click,$limit=30,$idlabel="id",$tmpid="")
  {
    $pages = round(count($this->app->DB->SelectArr($this->sql)) / $this->limit);
    if($pages==0)$pages=1;

    $module = $this->app->Secure->GetGET("module");
    $action = $this->app->Secure->GetGET("action");
    
    if($tmpid>0)
      $id = $tmpid;
    else
      $id = $this->app->Secure->GetGET($idlabel);


    if($this->page ==0 || $this->page=="") $this->page = 1;
    if($this->page <=1) $before = $this->page; else $before=$this->page-1;
    if($this->page >=$pages) $next = $this->page; else $next=$this->page+1;

    $colmenu = "<table width=\"100%\"><tr><td><a href=\"index.php?module=$module&action={$action}&$idlabel=$id&page=1\"><img border=\"0\" src=\"./themes/[THEME]/images/first.png\"></a>&nbsp;
    <a href=\"index.php?module=$module&action={$action}&$idlabel=$id&page=".$before."\"><img border=\"0\" src=\"./themes/[THEME]/images/before.png\"></a></td>";

    for($i=0;($i<$pages && $i< 10);$i++)
    {
      /*
      if($this->page==($i+1))
      {
	$colmenu .= "<td><a href=\"index.php?module=$module&action={$action}&$idlabel=$id&page=".($i+1)."\"><b>".
	  ($i+1)."</b></a></td>";
      } else {
	$colmenu .= "<td><a href=\"index.php?module=$module&action={$action}&$idlabel=$id&page=".($i+1)."\">".
	  ($i+1)."</a></td>";
      }
      */
    }
      $colmenu .= "<td align=center>Seite {$this->page} von $pages</td>";

    $colmenu .= "<td align=right><a href=\"index.php?module=$module&action={$action}&$idlabel=$id&page=".($next)."\"><img border=\"0\" src=\"./themes/[THEME]/images/next.png\"></a>&nbsp;
    <a href=\"index.php?module=$module&action={$action}&$idlabel=$id&page=$pages\"><img border=\"0\" src=\"./themes/[THEME]/images/last.png\"></a></td></tr></table>";

    $this->app->Tpl->Set($parsetarget,$colmenu);

    $htmltable = new HTMLTable(0,"100%","",3,1);
    $htmltable->width_headings = $this->width_headings;
    $htmltable->AddRowAsHeading($this->headings);

    $htmltable->ChangingRowColors('#e0e0e0','#fff');


    if(count($this->datasets)>0){
      foreach($this->datasets as $row){
        $htmltable->NewRow();
        foreach($row as $field)
          $htmltable->AddCol($field);
      }
      $module = $this->app->Secure->GetGET("module");
      if($newevent!="noAction"){
        $htmltable->ReplaceCol(count($this->headings),$click);
      }
      $this->app->Tpl->Add($parsetarget,$htmltable->Get());
    }
    else {
      if($newevent=="noAction") $newevent="";
      $this->app->Tpl->Set($parsetarget,"<div class=\"info\">Keine Daten vorhanden! $newevent</div>");
    }
/*
    if(count($this->datasets)>0){
      foreach($this->datasets as $row){
	$htmltable->NewRow();
	foreach($row as $field)
	  $htmltable->AddCol($field);
      }

      for($i=0;$i<count($menu);$i++)
      {
	$menustring .= "<a href=\"index.php?module=$module&action={$menu[$i]}&$idlabel=%value%&id=$id\">{$menu[$i]}</a>&nbsp;";
      }

      $htmltable->ReplaceCol(count($this->headings),$menustring);
      $this->app->Tpl->Add($parsetarget,$htmltable->Get());
    }
    else {
      $this->app->Tpl->Add($parsetarget,"Keine Daten vorhanden!");
    }
*/
    $this->app->Tpl->Add($parsetarget,$colmenu);
  }


  function DisplayWidthInlineEdit($parsetarget,$click="",$newevent="",$nomenu="false")
  {
    $htmltable = new HTMLTable(0,"100%","",3,1);
    $htmltable->width_headings = $this->width_headings;
    $htmltable->AddRowAsHeading($this->headings);

    $htmltable->ChangingRowColors('#e0e0e0','#fff');

    if(count($this->datasets)>0){
      foreach($this->datasets as $row){
	$htmltable->NewRow();
	foreach($row as $field)
	  $htmltable->AddCol($field);

	$htmltable->NewRow();

	$start = "<form>";	
	foreach($row as $key=>$field){
	  if($key!="id")
	    $htmltable->AddCol($start."<input type=\"text\" size=\"10\" value=\"$field\">");
	  else
	    $htmltable->AddCol($field."</form>");

	  $start="";
	}
      }
      $module = $this->app->Secure->GetGET("module");
      if($newevent!="noAction"){
	$htmltable->ReplaceCol(count($this->headings),$click);
      }
      $this->app->Tpl->Add($parsetarget,$htmltable->Get(1));
    }
    else {
      $this->app->Tpl->Add($parsetarget,"Keine Daten vorhanden! $newevent");
    }
  }

  function DisplayEditable($parsetarget,$click="",$newevent="",$nomenu="false",$arrayEditable="",$editlastrow=false)
  {
    $htmltable = new HTMLTable(0,"100%","",3,1);

    // Letzte Spalte aendern
    if($newevent == "noAction")
      $this->headings[count($this->headings)-1] = $click;

    $htmltable->width_headings = $this->width_headings;
    $htmltable->AddRowAsHeading($this->headings);
    $htmltable->ChangingRowColors('#e0e0e0','#fff');

    if(count($this->datasets)>0){
      foreach($this->datasets as $row){
	$htmltable->NewRow();
	foreach($row as $field)
	  $htmltable->AddCol($field);
      }
      $module = $this->app->Secure->GetGET("module");
      if($newevent!="noAction"){
	$htmltable->ReplaceCol(count($this->headings),$click);
      } 
      if($parsetarget=="return")
	$result .= $htmltable->GetSpecialCSSClasses($arrayEditable,$editlastrow);
      else
      {
      if(is_array($arrayEditable))
      {
	$this->app->Tpl->Add($parsetarget,$htmltable->GetSpecialCSSClasses($arrayEditable,$editlastrow));
      }
      else {
	$module = $this->app->Secure->GetGET("module");
	if($module=="lieferschein" || $module=="anfrage")
	$this->app->Tpl->Add($parsetarget,$htmltable->GetSpecialCSSClasses(array(4,5),$editlastrow));
	else if($module=="produktion")
	$this->app->Tpl->Add($parsetarget,$htmltable->GetSpecialCSSClasses(array(4),$editlastrow));
	else if($module=="arbeitsnachweis")
	$this->app->Tpl->Add($parsetarget,$htmltable->GetSpecialCSSClasses(array(2,3,4,5,6),$editlastrow));
	else if($module=="reisekosten")
	$this->app->Tpl->Add($parsetarget,$htmltable->GetSpecialCSSClasses(array(1,3),$editlastrow));
	else if($module=="inventur")
	$this->app->Tpl->Add($parsetarget,$htmltable->GetSpecialCSSClasses(array(1,4,5),$editlastrow));


	else
	$this->app->Tpl->Add($parsetarget,$htmltable->GetSpecialCSSClasses(array(4,5,6),$editlastrow));
      }
      }
    }
    else {
      if($newevent=="noAction") $newevent="";
      
      if($parsetarget=="return")
	$result .= "<div class=\"info\">Keine Daten vorhanden! $newevent</div>";
      else
	$this->app->Tpl->Set($parsetarget,"<div class=\"info\">Keine Daten vorhanden! $newevent</div>");
    }

    if($parsetarget=="return") return $result;
  }

  function DisplayNew($parsetarget,$click="",$newevent="",$nomenu="false")
  {
    $htmltable = new HTMLTable(0,"100%","",3,1,"font-size: 90%; ");

    // Letzte Spalte aendern
    if($newevent == "noAction")
      $this->headings[count($this->headings)-1] = $click;

    $htmltable->width_headings = $this->width_headings;
    $htmltable->AddRowAsHeading($this->headings);
    $htmltable->ChangingRowColors('#e0e0e0','#fff');

    if(count($this->datasets)>0){
      foreach($this->datasets as $row){
	$htmltable->NewRow();
	foreach($row as $field)
	  $htmltable->AddCol($field);
      }
      $module = $this->app->Secure->GetGET("module");
      if($newevent!="noAction"){
	$htmltable->ReplaceCol(count($this->headings),$click);
      } 
      if($parsetarget=="return")
	$result .= $htmltable->Get();
      else
	$this->app->Tpl->Add($parsetarget,$htmltable->Get());
    }
    else {
      if($newevent=="noAction") $newevent="";
      
      if($parsetarget=="return")
	$result .= "<div class=\"info\">Keine Daten vorhanden! $newevent</div>";
      else
	$this->app->Tpl->Set($parsetarget,"<div class=\"info\">Keine Daten  vorhanden! $newevent</div>");
    }

    if($parsetarget=="return") return $result;
  }

  function Display($parsetarget,$clickmodule="",$clickaction="",$clicklabel="",$newevent="")
  {
    
    $htmltable = new HTMLTable(0,"100%","",3,1);
    $htmltable->width_headings = $this->width_headings;
    $htmltable->AddRowAsHeading($this->headings);

    $htmltable->ChangingRowColors('#e0e0e0','#fff');

    if(count($this->datasets)>0){
      foreach($this->datasets as $row){
	$htmltable->NewRow();
	foreach($row as $field)
	  $htmltable->AddCol($field);
      }
      $module = $this->app->Secure->GetGET("module");
      if($clickaction=="") {
	$htmltable->ReplaceCol(count($this->headings),
	  "<a href=\"index.php?module=$module&action=edit&id=%value%\" alt=\"edit\"><img border=\"0\" src=\"./themes/[THEME]/images/edit.png\"></a>
	  <!--<a href=\"index.php?module=$module&action=copy&id=%value%\">copy</a>-->
	  &nbsp;<a href=\"index.php?module=$module&action=delete&id=%value%\" alt=\"del\"><img border=\"0\" src=\"./themes/[THEME]/images/delete.gif\"></a>");
      } else {
	$htmltable->ReplaceCol(count($this->headings),
	  "<a href=\"index.php?module=$clickmodule&action=$clickaction&id=%value%\">$clicklabel</a>");

      }
      $this->app->Tpl->Add($parsetarget,$htmltable->Get());
    }
    else {
      $this->app->Tpl->Add($parsetarget,"Keine Daten vorhanden! $newevent");
    }
  }

}


?>
