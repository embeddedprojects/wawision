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
if(!class_exists('Artikelkategorien'))
{
  class Artikelkategorien
  {
    function __construct(&$app)
    {
      $this->app=&$app; 

      $this->app->ActionHandlerInit($this);

      $this->app->ActionHandler("list","ArtikelkategorienList");
      $this->app->DefaultActionHandler("list");

      $this->app->ActionHandlerListen($app);
    }    
    function ArtikelkategorienList()
    {
      $this->app->Tpl->Set(VERS,'Enterprise');
      $this->app->Tpl->Set(MODUL,'Enterprise');
      $this->app->Tpl->Parse(PAGE, "only_version.tpl");
    }
  }
}
?>
