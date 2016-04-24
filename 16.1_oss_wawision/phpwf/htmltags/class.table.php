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

class HTMLTable
{
  var $border;
  var $cellpadding;
  var $cellspacing;
  var $width;
  var $height;
  
  var $color1;
  var $color2;

  var $nextcolor=0;

  var $xpointer; // start at 0
  var $ypointer; // start at 0

  var $Table;

  var $hidecols;
  var $headings;
  var $width_headings;
  var $widths;

	var $CompleteRow;
  
  var $cellclass;
  var $cellonclick;
  var $celltitle;

  /// Representiert eine HTML Tabelle
  function HTMLTable($border="1",$width="",$height="",$cellpadding="3",$cellspacing="3",$style="")
  {
    $this->border=$border;
    $this->cellpadding=$cellpadding;
    $this->cellspacing=$cellspacing;
    $this->width=$width;
    $this->height=$height;
    $this->style=$style;
	}

  /// komplette spalte einer tabelle mit neuem inhalt ersetzten, der alte ist in %value%
  function ReplaceCol($colnumber,$newtext)
  {
    reset($this->Table);
    $first =1;
    $rowcounter=0;
    while (list($coln, $row) = @each($this->Table))
    { 
      if($first==1)
      {
	$first=0;
	continue 1;
      }
      while (list($col, $val) = @each($row))
      {
	if( ($col+1)==$colnumber )
	{
	  $old =  $this->Table[$coln][$col]; 
	  $new=str_replace('%value%',$old,$newtext); 
		if(count($this->Table[$coln])>1)
	  	$new=str_replace('%field1%',$this->Table[$coln][1],$new); 
	  
	  for($i=1; $i <= count($this->Table[$coln]); $i++)
	    $new=str_replace("%$i%",$this->Table[$coln][$i-1],$new); 
	  
	  $new=str_replace('%pos%',$coln,$new); 
	  $new=str_replace('%togl%',$coln%2,$new); 
	  if(is_numeric($this->Table[$coln][$col]))
	  $this->Table[$coln][$col]=$new; 
	}
      }
    }

  }

  function HideCol($number)
  {
    $this->hidecols[$number]=$number;
  }

  /// erzwingt den Cursor in eine neue Zeile
  function NewRow()
  {
    if(count($this->Table)==0)
    {
      $this->xpointer=0;
      $this->ypointer=0;
    }
    else 
    {
      $this->xpointer=0;
      $this->ypointer++;
    }
  }
  /// fuegt eine komplette Zeile an der aktuellen Zeigerpostion ein
  function AddRowAsHeading($cols)
  {
    $this->NewRow();
    $cell=0;
    foreach($cols as $value)
    {
      if(isset($this->width_headings[$cell]))
        $this->AddCol("<div style=\"font-weight:bold;width:".$this->width_headings[$cell]."px;\">".ucfirst($value)."</div>");
      else
        $this->AddCol("<b>".ucfirst($value)."</b>");

      $cell++;
    }
  }


  /// fuegt eine komplette Zeile an der aktuellen Zeigerpostion ein
  function AddRow($cols)
  {
    $this->NewRow();
    foreach($cols as $value)
      $this->AddCol($value);
  }

  
  function AddField($field)
  {
    $rows = count($field);
    for($i=0;$i<$rows;$i++)
    {
      $this->NewRow();
      if(count($field[$i])>0)
      {
	foreach($field[$i] as $key=>$value)
	{
	  $this->AddCol(nl2br($value));
	}
      }
    }

  }

  /// fuegt neue eine neue Tabellenzelle an aktuellen Zeiger ein
  function AddCol($value)
  {
      $this->Table[$this->ypointer][$this->xpointer]=$value;
      $this->xpointer++;
  }
  
  function AddCellClass($class, $y = null, $x = null)
  {
    if(is_null($y))
    {
      $y = $this->ypointer;
    } else $y = (int)$y;
    if(is_null($x))
    {
      $x = $this->xpointer;
    } else $x = (int)$x;
    $this->cellclass[$y][$x][] = $class;
  }
  
  function AddCellonclick($js, $y = null, $x = null)
  {
    if(is_null($y))
    {
      $y = $this->ypointer;
    } else $y = (int)$y;
    if(is_null($x))
    {
      $x = $this->xpointer;
    } else $x = (int)$x;
    $this->cellonclick[$y][$x] = $js;
  }
  
  function AddCellTitle($title, $y = null, $x = null)
  {
    if(is_null($y))
    {
      $y = $this->ypointer;
    } else $y = (int)$y;
    if(is_null($x))
    {
      $x = $this->xpointer;
    } else $x = (int)$x;
    $this->celltitle[$y][$x] = $title;
  }

  // fuegt eine komplette spalte am schluss dazu
  function AddCompleteCol($colnumber,$string,$value="")
  {
    $this->CompleteCol[]=array($colnumber,$string,$value);
  }

  function ActualCompleteRow($actualrow)
  {

    if($actualrow==0)
      return "";

    $cols = count($this->CompleteCol);

    for($i=0;$i < $cols;$i++)
    {
      $ret .="<td>";
      $newvalue = $this->Table[$actualrow][$this->CompleteCol[$i][0]];
      $value = $this->Table[$actualrow][$this->CompleteCol[$i][2]];
      $text = str_replace('%col%',$newvalue,$this->CompleteCol[$i][1]);
      $ret .= str_replace('%value%',$value,$text);
      $ret .="</td>";
    }
    return $ret; 
  }

  function GetMaxCols()
  {
    
    $max = 0;
    $count = count($this->Table);
    
    for($i=0;$i<$count;$i++)
    {
      if(count($this->Table[$i]) > $max )
	$max = count($this->Table[$i]);
    }
    return $max;
  }


  function ChangingRowColors($color1,$color2)
  {
    $this->color1=$color1; 
    $this->color2=$color2; 
  } 

  function GetNextColor()
  {
    $this->nextcolor++;
    if($this->nextcolor % 2==0)
      return $this->color2;
    else return $this->color1;
  }


  function GetSpecialCSSClasses($columns,$editlastrow=false)
  {
    //hidden jede zweite zeile ist versteckt
    $rows = count($this->Table);
    if($rows>0)
    {
      $html = "<table border=\"{$this->border}\" cellpadding=\"{$this->cellpadding}\" id=\"tableone\"
	cellspacing=\"{$this->cellspacing}\" width=\"{$this->width}\" height=\"{$this->height}\">";

      $cols = $this->GetMaxCols();

      for($i=0;$i<$rows;$i++)
      {
	if(($i % 2)==0 && $i > 1 && $hidden==1) $none="none"; else $none="";

	// zwei zeilen kriegen die gleiche nummer nur eins edit hinten dran
	//echo $i." $none<br>";
	$html .="<tr style=\"background-color:".$this->GetNextColor().";display:$none;\" id=\"{$i}\">\n";


	for($j=0;$j<$cols;$j++)
	{
	  if($this->hidecols[$j+1]=="")
	  {
	    $last = count($this->Table[$i]);

	    //$id="1233";
	    // suche nach erste id

            $pattern = '/&sid=[0-9]+/i';
	    $subject = $this->Table[$i][$last-1];

            preg_match_all($pattern, $subject, $matches);
            $id = str_replace("&sid=","",$matches[0][0]);

	    if($editlastrow)$limi = $rows; else $limi = $rows -1;

	    if(in_array($j,$columns) && $i > 0 && $i < $limi)
	    $html .="<td class=\"editable\" nowrap id=\"{$id}split{$j}\">";
	    else
	    $html .="<td class=\"gentable\" nowrap>";
	    $html .= $this->Table[$i][$j]?$this->Table[$i][$j]:"";
	    $html .="</td>";
	  }
	}
	// get complete cols
	$html .=$this->ActualCompleteRow($i);
	$html .="</tr>";
      }
      $html .="</table>";
    }
    return $html; 
  }


  function Get($hidden="")
  {
    //hidden jede zweite zeile ist versteckt
    $rows = count($this->Table);
    if($rows>0)
    {
//      $html = "<table border=\"{$this->border}\" cellpadding=\"{$this->cellpadding}\" id=\"tableone\" class=\"mkTable\"
//	cellspacing=\"{$this->cellspacing}\" width=\"{$this->width}\" height=\"{$this->height}\" style=\"{$this->style}\">";

      if($this->cellpadding==3 && $this->cellspacing==1) {

        $this->cellpadding=0;
        $this->cellspacing=0;
      }

      $html = "<table cellpadding=\"{$this->cellpadding}\" cellspacing=\"{$this->cellspacing}\" class=\"mkTable\" width=\"{$this->width}\" height=\"{$this->height}\">";

      $cols = $this->GetMaxCols();

      for($i=0;$i<$rows;$i++)
      {
	if(($i % 2)==0 && $i > 1 && $hidden==1) $none="none"; else $none="";

	// zwei zeilen kriegen die gleiche nummer nur eins edit hinten dran
	//echo $i." $none<br>";
	//$html .="<tr style=\"background-color:".$this->GetNextColor().";display:$none;\" id=\"{$i}\">\n";
	$html .="<tr style=\"display:$none;\">\n";
	for($j=0;$j<$cols;$j++)
	{
	  if($this->hidecols[$j+1]=="")
	  {
	    $html .="<td ".(isset($this->cellonclick[$i]) && isset($this->cellonclick[$i][$j]) && ($this->cellonclick[$i][$j])?' onclick="'.$this->cellonclick[$i][$j].'" ':'').(isset($this->celltitle[$i]) && isset($this->celltitle[$i][$j]) && ($this->celltitle[$i][$j])?' title="'.$this->celltitle[$i][$j].'" ':'');
      if(isset($this->cellclass[$i]) && isset($this->cellclass[$i][$j]) && is_array($this->cellclass[$i][$j]))
      {
        foreach($this->cellclass[$i][$j] as $class)
        {
          $html .=" ";
        }
      }
      $html .="\" nowrap>";
	    $html .= $this->Table[$i][$j]?$this->Table[$i][$j]:"&nbsp;";
	    $html .="</td>";
	  }
	}
	// get complete cols
	$html .=$this->ActualCompleteRow($i);
	$html .="</tr>";
      }
      $html .="</table>";
    }
    return $html; 
  }

  function GetClose(){}
}
?>
