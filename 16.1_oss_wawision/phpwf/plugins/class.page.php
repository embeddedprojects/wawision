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

/// central config board for the engine
class Page 
{
  var $engine;
  function Page(&$app)
  {
    $this->app = &$app;
    //$this->engine = &$engine;
  }

  /// load a themeset set
  function LoadTheme($theme)
  {
    //$this->app->Tpl->ReadTemplatesFromPath("themes/$theme/templates/");
    $this->app->Tpl->ReadTemplatesFromPath("themes/$theme/templates/");
  }

  /// show complete page
  function Show()
  {
    return $this->app->Tpl->FinalParse('page.tpl');
  }

  /// build navigation tree
  function CreateNavigation($menu)
  {
    $i=0;

    //if($this->app->erp->Firmendaten("standardaufloesung")=="1"){
    //StammdatenVerkaufEinkaufWareneingangBuchhaltungMarketingVerwaltungLagerAdministrationMein Bereich 

    if($this->app->erp->Version()=="stock")
    {
      $gesamt = 1001;
      $breite = floor($gesamt/count($menu));

      $navwidth = array('Stammdaten'=>$breite,
                      'Verkauf'=>$breite,
                      'Einkauf'=>$breite,
                      'Wareneingang'=>$breite,
                      'Buchhaltung'=>$breite,
                      'Marketing'=>$breite,                  
                      'Verwaltung'=>$breite,
                      'Lager'=>$breite,
                      'Administration'=>$breite,
                      'Mein Bereich'=>$breite,
                      'Suche'=>$breite);

    //$navwidth = array(75,50,50,85,80,60,70,40,89,80,194); // alt
    $subnavwidth = array('Stammdaten'=>79,
                      'Verkauf'=>54,
                      'Einkauf'=>89,
                      'Wareneingang'=>89,
                      'Buchhaltung'=>174,
                      'Marketing'=>120,                  
                      'Verwaltung'=>120,
                      'Lager'=>130,
                      'Administration'=>93,
                      'Mein Bereich'=>84,
                      'Suche'=>80);

    }
    else {
    $navwidth = array('Stammdaten'=>90,
                      'Verkauf'=>70,
                      'Einkauf'=>70,
                      'Wareneingang'=>105,
                      'Buchhaltung'=>100,
                      'Marketing'=>80,                  
                      'Verwaltung'=>90,
                      'Lager'=>50,
                      'Administration'=>110,
                      'Mein Bereich'=>100,
                      'Suche'=>194);

    //$navwidth = array(75,50,50,85,80,60,70,40,89,80,194); // alt
    $subnavwidth = array('Stammdaten'=>79,
                      'Verkauf'=>54,
                      'Einkauf'=>89,
                      'Wareneingang'=>89,
                      'Buchhaltung'=>180,
                      'Marketing'=>120,                  
                      'Verwaltung'=>125,
                      'Lager'=>130,
                      'Administration'=>93,
                      'Mein Bereich'=>84,
                      'Suche'=>80);
    }
 

    if($this->app->erp->Firmendaten("standardaufloesung")!="1")
    {
      /*
         $menu[][first]  = array('Suche:&nbsp;
         <form action="index.php?module=welcome&action=direktzugriff" method="post">
         <input name="direktzugriff" id="direktzugriff"  type="text" size="20" style="font-size:9pt; margin:0px; padding:0px;"></form>','a','direktzugriff'); 
       */

    }

    if(isset($menu) && count($menu)>0){
      foreach($menu as $key=>$value){
        if($value['first'][2]!="direktzugriff")
        {
          if($value['first'][2]!="")
            $this->app->Tpl->Set('FIRSTNAV',' style="width:'.$navwidth[$value['first'][0]].'px;padding:12px;text-align:center;" >'.$value['first'][0].'</a>');
          else
            $this->app->Tpl->Set('FIRSTNAV',' style="width:'.$navwidth[$value['first'][0]].'px;padding:12px;text-align:center;" href="index.php?module='.$value['first'][1].'&top='.base64_encode($value['first'][0]).'" >'.$value['first'][0].'</a>');
        } else {
          if($value['first'][2]!="")
            $this->app->Tpl->Set('FIRSTNAV',' style="width:'.$navwidth[$value['first'][0]].'px;padding-top:10.5px; padding-bottom:11px;" >'.$value['first'][0].'</a>');
        }

        $this->app->Tpl->Parse('NAV','firstnav.tpl');
        if(isset($value['sec']) && count($value['sec'])>0){
          $this->app->Tpl->Add('NAV','<ul>');
          foreach($value['sec'] as $secnav){
            if($secnav[2]!="")
              $this->app->Tpl->Set('SECNAV',' style="width:'.$subnavwidth[$value['first'][0]].'px" href="index.php?module='.$secnav[1].'&action='.$secnav[2].'&top='.base64_encode($value['first'][0]).'"
                  >'.$secnav[0].'</a>');
            else
              $this->app->Tpl->Set('SECNAV',' style="width:'.$subnavwidth[$value['first'][0]].'px" href="index.php?module='.$secnav[1].'&top='.base64_encode($value['first'][0]).'">'.$secnav[0].'</a>');

            $this->app->Tpl->Parse('NAV','secnav.tpl');
          }
          $this->app->Tpl->Add('NAV',"</ul></li>");
        }

        $i++;
      }
    }
  }

  }
  ?>
