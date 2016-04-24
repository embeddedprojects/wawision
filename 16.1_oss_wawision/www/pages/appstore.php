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

class Appstore {
  var $app;
  
  function Appstore($app) {
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","AppstoreList");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen($app);
  }

  function AppstoreList()
  {

    $this->app->erp->MenuEintrag("index.php?module=appstore&action=list","&Uuml;bersicht");

    $module = $this->app->erp->getApps();
    //print_r($module);
    if($module)
    {
      if(isset($module['installiert']))
      {
        /*$i = 0;
        foreach($module['installiert'] as $k => $modul)
        {
          if($i > 0 && $i % 4 == 0)
          {
            $this->app->Tpl->Add('MODULEINSTALLIERT','</tr>'."\r\n");
          }
          if($i % 4 == 0)
          {
            $this->app->Tpl->Add('MODULEINSTALLIERT','<tr align="center">'."\r\n");
          }
          $this->app->Tpl->Add('MODULEINSTALLIERT','<td width="25%"><a href="'.$modul['Link'].'"><img src="./themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/einstellungen/'.$modul['Icon'].'" border="0" width="30%"></a></td>');
          $i++;
        }
        if($i % 4 != 3)
        {
          for($j = $i % 4; $j < 3; $j++)$this->app->Tpl->Add('MODULEINSTALLIERT','<td width="25%"></td>');
          $this->app->Tpl->Add('MODULEINSTALLIERT','</tr>');
        }
        $i = 0;
        foreach($module['installiert'] as $k => $modul)
        {
          if($i > 0 && $i % 4 == 0)
          {
            $this->app->Tpl->Add('MODULEINSTALLIERT','</tr>'."\r\n");
          }
          if($i % 4 == 0)
          {
            $this->app->Tpl->Add('MODULEINSTALLIERT','<tr align="center">'."\r\n");
          }
          $this->app->Tpl->Add('MODULEINSTALLIERT','<td width="25%"><a href="'.$modul['Link'].'">'.$modul['Bezeichnung'].'</a></td>');
          $i++;
        }
        if($i % 4 != 3)
        {
          for($j = $i % 4; $j < 3; $j++)$this->app->Tpl->Add('MODULEINSTALLIERT','<td width="25%"></td>');
          $this->app->Tpl->Add('MODULEINSTALLIERT','</tr>');
        }*/
        
        for ($l = 0; $l < ceil( count($module['installiert'])/4); $l++)
        {
          
          $this->app->Tpl->Add('MODULEINSTALLIERT','<tr align="center">');
          for($r = 0; $r < 4; $r++)
          {
            $i = $l * 4 + $r;
            if($i < count($module['installiert']))
            {
              $modul = $module['installiert'][$i];
              $this->app->Tpl->Add('MODULEINSTALLIERT','<td width="25%"><a href="'.$modul['Link'].'"><img src="./themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/einstellungen/'.$modul['Icon'].'" border="0" width="30%"></a></td>');
              
            } else {
              $this->app->Tpl->Add('MODULEINSTALLIERT','<td width="25%"></td>');
            }
            
          }
          $this->app->Tpl->Add('MODULEINSTALLIERT','</tr>');
          $this->app->Tpl->Add('MODULEINSTALLIERT','<tr align="center">');
          for($r = 0; $r < 4; $r++)
          {
            $i = $l * 4 + $r;
            if($i < count($module['installiert']))
            {
              $modul = $module['installiert'][$i];
              $this->app->Tpl->Add('MODULEINSTALLIERT','<td width="25%"><a href="'.$modul['Link'].'">'.$modul['Bezeichnung'].'</a></td>');
            } else {
              $this->app->Tpl->Add('MODULEINSTALLIERT','<td width="25%"></td>');
              
            }
          }
          $this->app->Tpl->Add('MODULEINSTALLIERT','</tr>');
          
        }
        
      }
      if(isset($module['kauf']))
      {
        for ($l = 0; $l < ceil( count($module['kauf'])/4); $l++)
        {
          
          $this->app->Tpl->Add('MODULEVERFUEGBAR','<tr align="center">');
          for($r = 0; $r < 4; $r++)
          {
            $i = $l * 4 + $r;
            if($i < count($module['kauf']))
            {
              $modul = $module['kauf'][$i];
              $this->app->Tpl->Add('MODULEVERFUEGBAR','<td width="25%">'.($modul['Link']?'<a href="'.$modul['Link'].'">':'').'<img src="./themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/einstellungen/'.$modul['Icon'].'" border="0" width="30%">'.($modul['Link']?'</a>':'').'</td>');
              
            } else {
              $this->app->Tpl->Add('MODULEVERFUEGBAR','<td width="25%"></td>');
            }
            
          }
          $this->app->Tpl->Add('MODULEVERFUEGBAR','</tr>');
          $this->app->Tpl->Add('MODULEVERFUEGBAR','<tr align="center">');
          for($r = 0; $r < 4; $r++)
          {
            $i = $l * 4 + $r;
            if($i < count($module['kauf']))
            {
              $modul = $module['kauf'][$i];
              $this->app->Tpl->Add('MODULEVERFUEGBAR','<td width="25%">'.($modul['Link']?'<a href="'.$modul['Link'].'">':'').$modul['Bezeichnung'].($modul['Link']?'</a>':'').'</td>');
            } else {
              $this->app->Tpl->Add('MODULEVERFUEGBAR','<td width="25%"></td>');
              
            }
          }
          $this->app->Tpl->Add('MODULEVERFUEGBAR','</tr>');
        }
        
      } else {
        
        $this->app->Tpl->Add('VERFUEGBARVOR','<!--');
        $this->app->Tpl->Add('VERFUEGBARNACH','--!>');
      }
      
      
    }
    
    $this->app->Tpl->Parse('TAB1',"appstore.tpl");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }
}

?>
