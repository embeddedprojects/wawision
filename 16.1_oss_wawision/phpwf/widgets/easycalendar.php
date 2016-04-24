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


class EasyCalendar {
  
  var $app;
  var $year;
  var $rows;
  var $dataset;
  var $headings;
  var $cells;
  var $js;
  var $title;
  var $monatheading;
  var $maxcellcount;
  var $customcellcolor;
  function __construct(&$app, $jahr = null) 
  {
    $this->app = $app;
    $this->year = date('Y');
    if($jahr)$this->year = $jahr;
    $this->sql ="";
    $this->maxcellcount = 1;
    $this->customcellcolor = '#0B8092';
    $this->limit ="";
    $this->headings[] = 'Monat';
    for($i = 1; $i <= 31; $i++)$this->headings[] = $i;
    $this->monatheading = array(1=>'Januar',2=>'Februar',3=>'M&auml;rz',4=>'April',5=>'Mai',6=>'Juni',7=>'Juli',8=>'August',9=>'September',10=>'Oktober',11=>'November',12=>'Dezember');
  }


  function AddCell($datum, $el)
  {
    $datumu = strtotime($datum);
    
    $jahr = (int)date('Y',$datumu);
    $tag = (int)date('d',$datumu);
    $monat = (int)date('m',$datumu);
    $this->cells[$jahr][$monat][$tag][] = $el;
  }
  
  function AddOnCellClick($datum, $js)
  {
    $datumu = strtotime($datum);
    
    $jahr = (int)date('Y',$datumu);
    $tag = (int)date('d',$datumu);
    $monat = (int)date('m',$datumu);
    $this->js[$jahr][$monat][$tag] = $js;
  }

  function AddCellTitle($datum, $title)
  {
    $datumu = strtotime($datum);
    
    $jahr = (int)date('Y',$datumu);
    $tag = (int)date('d',$datumu);
    $monat = (int)date('m',$datumu);
    $this->title[$jahr][$monat][$tag] = $title;
  }
  
  function Display($parsetarget,$clickmodule="",$clickaction="",$clicklabel="",$newevent="")
  {
    
    $htmltable = new HTMLTable(0,"100%","",3,1);
    $htmltable->width_headings = $this->width_headings;
    $htmltable->AddRowAsHeading($this->headings);

    $htmltable->ChangingRowColors('#eee','#eee');

    for($monat = 1; $monat <= 12 ; $monat++)
    {
      $htmltable->NewRow();
      if(isset($row))unset($row);
      $field = $this->monatheading[$monat];
      $htmltable->AddCellClass('monat');
      $htmltable->AddCol($field);
      for($tag = 1; $tag <= 31; $tag++)
      {
        $css = 'standard';
        if(checkdate($monat ,  $tag ,  $this->year ))
        {
          $kalenderTag = date('w', mktime(0,0,0,$monat,$tag,$this->year));
          if ($kalenderTag == 0 || $kalenderTag == 6) {
            $css = 'wochenende';
          }
        } else {
          $css = 'keintag';
        }
        
        
        if(is_array($this->cells) && isset($this->cells[$this->year]) && isset($this->cells[$this->year][$monat]) && isset($this->cells[$this->year][$monat][$tag]) && is_array($this->cells[$this->year][$monat][$tag]))
        {
          $anz = count($this->cells[$this->year][$monat][$tag]);
          
          if($this->maxcellcount > 0)
          {          
            if($anz < 1)
            {
              $field = '';
            }elseif($anz == 1){
              $field = $this->cells[$this->year][$monat][$tag][0];
            }elseif($anz <= $this->maxcellcount) {
              $zelle = '<table>';
              foreach($this->cells[$this->year][$monat][$tag] as $value)
              {
                $zelle .= '<tr><td>'.$value.'</td></tr>';
              }
              $zelle .= '</table>';
              $field = $zelle;
            } else {
              $zelle = '<table>';
              for($i = 0; $i < $this->maxcellcount; $i++)
              {
                $zelle .= '<tr><td>'.$this->cells[$this->year][$monat][$tag][$i].'</td></tr>';
              }
              $zelle .= '</table>';
              $field = $zelle;
            }
          } else {
            if($anz)
            {
              $field = '<span style="width:100%;display:inline-block;" title="';
              for($i = 0; $i < $anz; $i++)
              {
                if($i > 0)$field .= ', ';
                $field .= $this->cells[$this->year][$monat][$tag][$i];
              }
              
              $field .= '">'.$anz.'</span>';
              $css = 'custom';
            }
          }
          
        } else 
        {
          $field = '';
        }
        
        if($css)$htmltable->AddCellClass($css);
        if(isset($this->js[$this->year][$monat][$tag]) && $this->js[$this->year][$monat][$tag])$htmltable->AddCellonclick($this->js[$this->year][$monat][$tag]);
        if(isset($this->title[$this->year][$monat][$tag]) && $this->title[$this->year][$monat][$tag])$htmltable->AddCellTitle($this->title[$this->year][$monat][$tag]);
        $htmltable->AddCol($field);
        
        

        
        
      }
    }
    $this->app->Tpl->Add('YUICSS','
    .easycalendar td
    {
      width:3%;
    }
    .easycalendar td.standard
    {
      background-color:#f0f0f0;
      
    }
    
    .easycalendar td.wochenende
    {
      background-color:#ddd;
    }
    .easycalendar td.keintag 
    {
      background-color:#fff;
    }
    .easycalendar td.monat 
    {
      background-color:#ddd;
      width:7%;
    }
    .easycalendar td.custom 
    {
      background-color:'.(isset($this->customcellcolor)?$this->customcellcolor:'#f0f0f0').';
    }    
    ');
    $this->app->Tpl->Add($parsetarget,'<div class="easycalendar">');
    $this->app->Tpl->Add($parsetarget,$htmltable->Get());
    $this->app->Tpl->Add($parsetarget,'</div>');
  }

}


?>
