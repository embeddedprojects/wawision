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

class Paketmarke {
  var $app;
  
  function Paketmarke($app) {
    //parent::GenPaketmarke($app);
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","PaketmarkeCreatePopup");
    $this->app->ActionHandler("tracking","PaketmarkeTracking");

    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }



  function PaketmarkeTracking()
  {
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Paketmarken Drucker");

    $this->app->Tpl->Set(PAGE,"Tracking-Nummer: <input type=\"text\" id=\"tracking\"><script type=\"text/javascript\">document.getElementById(\"tracking\").focus(); </script>");
    //$this->app->BuildNavigation=false;
  }



  function PaketmarkeCreatePopup()
  {
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Paketmarken Drucker");
   //$frame = $this->app->Secure->GetGET("frame");
  
   // if($frame=="false")
   // {
      // hier nur fenster größe anpassen
   //   $this->app->YUI->IframeDialog(665,670);
   // } else {
      // nach page inhalt des dialogs ausgeben
      $this->app->erp->PaketmarkeDHLEmbedded(PAGE,"lieferschein");   
     // $this->app->BuildNavigation=false;
    //}
  }





}

?>
