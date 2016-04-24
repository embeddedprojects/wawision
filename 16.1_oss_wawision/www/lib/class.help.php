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

class Help
{

  function Help(&$app)
  {
    $this->app=$app;
  }



	function Run()
	{
    $module = ucfirst($this->app->Secure->GetGET("module"));
    $action = ucfirst($this->app->Secure->GetGET("action"));

		$methodname = $module.$action;

    if(method_exists($this,$methodname))
    {
      $this->app->Tpl->Add('HELP',call_user_func( array( &$this, $methodname ), $this, null ));
    } else {
      $this->app->Tpl->Set('HELPDISABLEOPEN',"<!--");
      $this->app->Tpl->Set('HELPDISABLECLOSE',"-->");
    }
	}

/*
	function AngebotCreate()
	{
		return "angebot anlegen";
	}

	function AngebotList()
	{
		return "angebot list";
	}
*/


}

?>
