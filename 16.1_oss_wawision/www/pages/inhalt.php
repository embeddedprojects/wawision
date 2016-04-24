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

class Inhalt{
  var $app;
  
  function Inhalt($app) {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","InhaltCreate");
    $this->app->ActionHandler("edit","InhaltEdit");
    $this->app->ActionHandler("list","InhaltList");
    $this->app->ActionHandler("delete","InhaltDelete");
    $this->app->ActionHandler("listshop","InhaltListShop");

    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }


  function InhaltCreate()
  {
		$this->app->Tpl->Set(UEBERSCHRIFT,"Inhalt anlegen");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Inhalt anlegen");
    $this->app->erp->MenuEintrag("index.php?module=inhalt&action=list","Zur&uuml;ck zur &Uuml;bersicht");

		$inhaltstyp = $this->app->Secure->GetPOST('inhaltstyp');
		$shop = $this->app->Secure->GetPOST('shop');
		$inhalt = $this->app->Secure->GetPOST('inhalt');
		$sprache = $this->app->Secure->GetPOST('sprache');
		$aktiv = $this->app->Secure->GetPOST('aktiv');

		$template = $this->app->Secure->GetPOST('template');
		$finalparse = $this->app->Secure->GetPOST('finalparse');
		$navigation = $this->app->Secure->GetPOST('navigation');
		$datum = $this->app->Secure->GetPOST('datum');
		$sichtbarbis = $this->app->Secure->GetPOST('sichtbarbis');

		$title = $this->app->Secure->GetPOST('title');
		$kurztext = $this->app->Secure->GetPOST('kurztext');
		$html = $this->app->Secure->GetPOST('html');

		$description = $this->app->Secure->GetPOST('description');
		$keywords = $this->app->Secure->GetPOST('keywords');

		$saveform = $this->app->Secure->GetPOST('saveform');
		$submit = $this->app->Secure->GetPOST('inhalt_submit');


		if($submit!='' && $saveform=='1') {
			$shopid = $this->app->DB->Select("SELECT id FROM shopexport WHERE bezeichnung='$shop' LIMIT 1");
			$error = "";

			if(trim($shop)=='') $error .= "W&auml;hlen sie bitte einen Online-Shop aus<br>";
	
			if(trim($inhalt)=='') $error.= 'Geben Sie bitte einen internen Bezeichner ein';
			else {
				$exists = $this->app->DB->Select("SELECT '1' FROm inhalt WHERE inhalt='$inhalt' AND sprache='$sprache' AND shop='$shopid' LIMIT 2");
				if($exists=='2') $error .= 'Der eingegebene Bezeichner wird bereits verwendet<br>';
			}

			
			if($error=='') {
				$datum_new = $this->app->erp->ReplaceDatum(true, $datum);
				$sichtbarbis_new = $this->app->erp->ReplaceDatum(true, $sichtbarbis);
				$html_new = htmlentities($html);
				$this->app->DB->Insert("INSERT INTO inhalt (sprache, inhalt, kurztext, html, title, description, keywords, inhaltstyp, sichtbarbis, datum, aktiv, shop, template, finalparse, navigation)
																 VALUES ('$sprache','$inhalt','$kurztext','$html_new','$title','$description','$keywords','$inhaltstyp','$sichtbarbis_new','$datum_new','$aktiv',#
																				 '$shopid','$template','$finalparse','$navigation')");
				$this->app->Tpl->Set('MESSAGE', "<div class=\"success\">Der Shop-Inhalt konnte erfolgreich erstellt werden.</div>");	
			}else
				$this->app->Tpl->Set('MESSAGE', "<div class=\"error\">$error</div>");	
		}



		$this->SetForm($inhaltstyp, $shop, $inhalt, $sprache, $aktiv, $template, $finalparse, 
									 $navigation, $datum, $sichtbarbis, $title, $kurztext, $html, $description, $keywords);


		switch($inhaltstyp) {
			case 'email': $template = 'inhalt_create_email.tpl'; break;
			case 'group': $template = 'inhalt_create_group.tpl'; break;
			case 'teaser': $template = 'inhalt_create_teaser_news.tpl'; break;
			case 'news': $template = 'inhalt_create_teaser_news.tpl'; break;
			default: $template = 'inhalt_create_page.tpl';
		}

    $this->app->Tpl->Parse('INHALTJAVASCRIPT', 'inhalt_javascript.tpl');
    $this->app->Tpl->Parse('PAGE', $template);
  }

	function InhaltEdit()
	{
    $this->app->Tpl->Set(UEBERSCHRIFT,"Inhalt editieren");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Inhalt editieren");
    $this->app->erp->MenuEintrag("index.php?module=inhalt&action=list","Zur&uuml;ck zur &Uuml;bersicht");
	
		$id = $this->app->Secure->GetGET('id');
	
		$inhaltstyp = $this->app->Secure->GetPOST('inhaltstyp');
    $shop = $this->app->Secure->GetPOST('shop');
    $inhalt = $this->app->Secure->GetPOST('inhalt');
    $sprache = $this->app->Secure->GetPOST('sprache');
    $aktiv = $this->app->Secure->GetPOST('aktiv');

    $template = $this->app->Secure->GetPOST('template');
    $finalparse = $this->app->Secure->GetPOST('finalparse');
    $navigation = $this->app->Secure->GetPOST('navigation');
    $datum = $this->app->Secure->GetPOST('datum');
    $sichtbarbis = $this->app->Secure->GetPOST('sichtbarbis');

    $title = $this->app->Secure->GetPOST('title');
    $kurztext = $this->app->Secure->GetPOST('kurztext');
    $html = $this->app->Secure->GetPOST('html');

    $description = $this->app->Secure->GetPOST('description');
    $keywords = $this->app->Secure->GetPOST('keywords');

    $saveform = $this->app->Secure->GetPOST('saveform');
    $submit = $this->app->Secure->GetPOST('inhalt_submit');


		if($submit!='' && $saveform=='1') {
			if(trim($shop)=='') $error .= "W&auml;hlen sie bitte einen Online-Shop aus<br>";
      if(trim($inhalt)=='') $error.= 'Geben Sie bitte einen internen Bezeichner ein';	

			if($error=='') {
					$shopid = $this->app->DB->Select("SELECT id FROM shopexport WHERE bezeichnung='$shop' LIMIT 1");
					$datum_new = $this->app->erp->ReplaceDatum(true, $datum);
					$sichtbarbis_new = $this->app->erp->ReplaceDatum(true, $sichtbarbis);
					$html_new = $html;
					$this->app->DB->Update("UPDATE inhalt SET sprache='$sprache', inhalt='$inhalt', kurztext='$kurztext', html='$html_new', title='$title', description='$description', keywords='$keywords',
																	inhaltstyp='$inhaltstyp', sichtbarbis='$sichtbarbis_new', datum='$datum_new', aktiv='$aktiv', shop='$shopid', template='$template', finalparse='$finalparse', 
																	navigation='$navigation' WHERE id='$id' LIMIT 1");								

				$this->app->Tpl->Set('MESSAGE', "<div class=\"success\">Der Shop-Inhalt wurde erfolgreich aktualisiert.</div>");
      }else
        $this->app->Tpl->Set('MESSAGE', "<div class=\"error\">$error</div>");

		}	

		$data = $this->app->DB->SelectArr("SELECT * FROM inhalt WHERE id='$id' LIMIT 1");
		$shopname = $this->app->DB->Select("SELECT bezeichnung FROM shopexport WHERE id='{$data[0]['shop']}' LIMIT 1");
		$typ = (($inhaltstyp=='')?$data[0]['inhaltstyp']:$inhaltstyp);
		$this->SetForm($typ, $shopname, $data[0]['inhalt'], $data[0]['sprache'], $data[0]['aktiv'], $data[0]['template'], $data[0]['finalparse'], $data[0]['navigation'],
									 $this->app->erp->ReplaceDatum(false, $data[0]['datum']), $this->app->erp->ReplaceDatum(false, $data[0]['sichtbarbis']), $data[0]['title'], $data[0]['kurztext'], 
									 htmlspecialchars_decode($data[0]['html']), $data[0]['description'], $data[0]['keywords']);	


		switch($typ) {
      case 'email': $template = 'inhalt_create_email.tpl'; break;
      case 'group': $template = 'inhalt_create_group.tpl'; break;
      case 'teaser': $template = 'inhalt_create_teaser_news.tpl'; break;
      case 'news': $template = 'inhalt_create_teaser_news.tpl'; break;
      default: $template = 'inhalt_create_page.tpl';
    }
		$this->app->Tpl->Parse('INHALTJAVASCRIPT', 'inhalt_javascript.tpl');
    $this->app->Tpl->Parse('PAGE', $template);
	}

	function SetForm($inhaltstyp, $shop, $inhalt, $sprache, $aktiv, $template, $finalparse, $navigation, $datum, $sichtbarbis, $title, $kurztext, $html, $description, $keywords)
	{
		$this->app->YUI->DatePicker("datum");
    $this->app->YUI->DatePicker("sichtbarbis");
		$this->app->erp->GetNavigationSelect($shop);
		$this->app->YUI->AutoComplete("shop","shopname");

		$this->app->Tpl->Set('INHALTSTYPSELECT', $this->InhaltstypSelect($inhaltstyp));
		$this->app->Tpl->Set('SHOP', $shop);
		$this->app->Tpl->Set('INHALT', $inhalt);
		$this->app->Tpl->Set('SPRACHESELECT', $this->SpracheSelect($sprache));
		$this->app->Tpl->Set('AKTIVCHECKED', (($aktiv=='1')?'checked':''));
		$this->app->Tpl->Set('TEMPLATE', $template);
		$this->app->Tpl->Set('FINALPARSE', $finalparse);
		$this->app->Tpl->Set('NAVIGATIONSELECT', $this->NavigationSelect($shop, $navigation));
		$this->app->Tpl->Set('DATUM', $datum);
		$this->app->Tpl->Set('SICHTBARBIS', $sichtbarbis);
		$this->app->Tpl->Set('TITLE', $title);
		$this->app->Tpl->Set('KURZTEXT', $kurztext);
		$this->app->Tpl->Set('LANGTEXT', $html);
		$this->app->Tpl->Set('DESCRIPTION', $description);
		$this->app->Tpl->Set('KEYWORDS', $keywords);
	}


	function InhaltDelete()
	{
		$id = $this->app->Secure->GetGET('id');
		if(is_numeric($id))
			$this->app->DB->Delete("DELETE FROM inhalt WHERE id='$id' LIMIT 1");
		$ref = $_SERVER['HTTP_REFERER'];
		header("Location: $ref");
		exit;
	}

  function InhaltList()
  {
		$this->app->Tpl->Set(UEBERSCHRIFT,"Inhalte");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Inhalte");
		$this->app->erp->MenuEintrag("index.php?module=inhalt&action=create","Neuen Inhalt anlegen");
		$this->app->erp->MenuEintrag("index.php","Zur&uuml;ck zur &Uuml;bersicht");

		$this->app->YUI->TableSearch(TAB1,'inhaltsseiten'); 
		$this->app->Tpl->Parse('PAGE','inhalt_list.tpl');
	}

	function InhaltListShop()
	{
		$shop = $this->app->Secure->GetGET('id');

		$this->app->Tpl->Set(UEBERSCHRIFT,"Shopexport");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Shopexport");
		$this->app->erp->MenuEintrag("index.php?module=shopexport&action=export&id=$shop","Export");
		$this->app->erp->MenuEintrag("index.php?module=shopexport&action=navigationtab&id=$shop","Navigation");
		$this->app->erp->MenuEintrag("index.php?module=shopexport&action=artikelgruppen&id=$shop","Artikelgruppen");
		$this->app->erp->MenuEintrag("index.php?module=shopexport&action=dateien&id=$shop","Dateien");
		$this->app->erp->MenuEintrag("index.php?module=shopexport&action=live&id=$shop","Live-Status");
		$this->app->erp->MenuEintrag("index.php?module=inhalt&action=listshop&id=$shop","Inhalte / E-Mailvorlagen");
		$this->app->erp->MenuEintrag("index.php?module=onlineshops&action=edit&id=$shop&menu=1","Einstellungen");
		$this->app->erp->MenuEintrag("index.php?module=shopexport&action=list","Zurück zur Übersicht");

		$this->app->YUI->TableSearch(TAB1,'inhaltsseitenshop');
    $this->app->Tpl->Parse('PAGE','inhalt_list.tpl');	
	}


  function InhaltMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Inhalte");

    $this->app->erp->MenuEintrag("index.php?module=inhalt&action=create","Inhalt anlegen");

    if($this->app->Secure->GetGET("action")=="list")
    $this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    else
    $this->app->erp->MenuEintrag("index.php?module=inhalt&action=list","Zur&uuml;ck zur &Uuml;bersicht");
  }

	function InhaltstypSelect($select='') 
	{
		$options = array('page'=>'HTML-Seite', 'email'=>'E-Mail Vorlage', 'group'=>'Artikelgruppe', 'teaser'=>'Teaser', 'news'=>'Newsmeldung');

		foreach($options as $key=>$value) {
			$selected = (($select==$key)?'selected':'');
			$out .= "<option value=\"$key\" $selected>$value</option>";
		}
		return $out;	
	}

	function SpracheSelect($select='') 
	{
		$options = array('de'=>'Deutsch','en'=>'Englisch');
		foreach($options as $key=>$value) {
      $selected = (($select==$key)?'selected':'');
      $out .= "<option value=\"$key\" $selected>$value</option>";
    }
    return $out;
	}

	function NavigationSelect($shop, $select='')
	{
		if($shop=='') {
			return '<option value=""> -- Bitte Shop ausw&auml;hlen --</option>';
		}
			
		$shopid = $this->app->DB->Select("SELECT id FROM shopexport WHERE bezeichnung='$shop' LIMIT 1");
		
		if(is_numeric($shopid) && $shopid>0)
		{
			$oberpunkte = $this->app->DB->SelectArr("SELECT id, bezeichnung, bezeichnung_en, plugin,pluginparameter FROM shopnavigation WHERE parent=0  AND shop='$shopid' ORDER BY position");
      $tmp = array();
      foreach($oberpunkte as $punkt)
      {
        $tmp["{$punkt["id"]}"]=$punkt["bezeichnung"];
        $unterpunkte = $this->app->DB->SelectArr("SELECT id, bezeichnung, bezeichnung_en, plugin,pluginparameter FROM shopnavigation WHERE parent='".$punkt["id"]."' AND shop='$shopid' ORDER BY position");

        foreach($unterpunkte as $upunkt)
          $tmp["{$upunkt["id"]}"]="&nbsp;&nbsp;&nbsp;".$upunkt["bezeichnung"];
      }
			if(count($tmp) < 1) return '<option value=""> -- Keine Navigation vorhanden --</option>';
		
			foreach($tmp as $key=>$value) {
				$selected = (($select==$key)?'selected':'');
				$out .= "<option value=\"$key\" $selected>$value</option>";
			}
			return $out;
	
		}else
			return '<option value=""> -- Bitte Shop ausw&auml;hlen --</option>';


	}
	
}

?>
