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

class Etikettendrucker {
  var $app;

  function Etikettendrucker($app) {
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","EtikettendruckerList");
    $this->app->DefaultActionHandler("list");
    $this->app->ActionHandlerListen($app);
  }

  function EtikettendruckerList()
  {
    $drucken = $this->app->Secure->GetPOST("drucken");
    $xmltest = $this->app->Secure->GetPOST("xmltest");
    $menge = $this->app->Secure->GetPOST("menge");

    $bezeichnung1 = $this->app->Secure->GetPOST("bezeichnung1");
    $bezeichnung2 = $this->app->Secure->GetPOST("bezeichnung2");
    $this->app->Tpl->Set(BEZEICHNUNG1,$bezeichnung1);
    $this->app->Tpl->Set(BEZEICHNUNG2,$bezeichnung2);

    $xml = $this->app->Secure->GetPOSTForForms("xml");
//		echo $xml;

    //$xml = $_POST['xml'];//$this->app->Secure->GetPOST("xml");

		if($menge <=0) $menge=1;

    $this->app->Tpl->Set(XML,$xml);
    $this->app->Tpl->Set(MENGE,$menge);

    if($drucken!="")
    {
      $this->app->erp->EtikettenDrucker("etikettendrucker_einfach",$menge,"","",array('bezeichnung1'=>$bezeichnung1,'bezeichnung2'=>$bezeichnung2));
    }

    if($xmltest!="")
    {
      $this->app->erp->EtikettenDrucker("xml",$menge,"","","",$xml);
    }	

    $this->app->Tpl->Set(TABTEXT,"Etikettendrucker");
    $this->app->Tpl->Parse(PAGE,"etikettendrucker_list.tpl");
  }

  function EtikettendruckerMenu()
  {
    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Etikettendrucker");
    $this->app->erp->MenuEintrag("index.php?module=artikel&action=list","Zur&uuml;ck zur &Uuml;bersicht");
  }



}

?>
