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

class Shopexport 
{

  function Shopexport(&$app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("login","ShopexportLogin");
    $this->app->ActionHandler("main","ShopexportMain");
    $this->app->ActionHandler("list","ShopexportList");
    $this->app->ActionHandler("export","ShopexportExport");
    $this->app->ActionHandler("besuchen","ShopexportBesuchen");
    $this->app->ActionHandler("navigation","ShopexportNavigation");
    $this->app->ActionHandler("logout","ShopexportLogout");
    $this->app->ActionHandler("navigationtab","ShopexportNavigationUebersicht");
    $this->app->ActionHandler("artikelgruppen","ShopexportArtikelgruppen");
    $this->app->ActionHandler("dateien","ShopexportDateien");
    $this->app->ActionHandler("live","ShopexportLive");

    $this->app->DefaultActionHandler("list");


    //    $this->app->Tpl->Set(UEBERSCHRIFT,"Shop Export");
    $this->app->ActionHandlerListen($app);
  }



  function ShopexportList()
  {
    // $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Shopexport");
    //$this->app->Tpl->Set(SUBHEADING,"Exports");
    //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");
    $this->app->erp->MenuEintrag("index.php?module=importvorlage&action=uebersicht","Zur&uuml;ck zur &Uuml;bersicht");
    $table = new EasyTable($this->app);
    $table->Query("SELECT ae.bezeichnung,p.abkuerzung, 
        ae.id FROM shopexport ae LEFT JOIN projekt p ON p.id=ae.projekt");
    $table->DisplayNew('INHALT',"<a href=\"index.php?module=shopexport&action=export&id=%value%\">Export</a>&nbsp;<a href=\"index.php?module=shopexport&action=besuchen&id=%value%\" target=\"_blank\">Besuchen</a>");
    $this->app->Tpl->Parse('TAB1',"rahmen.tpl");
    $this->app->Tpl->Set('INHALT',"");

    $this->app->Tpl->Set('SUBHEADING',"");
    $this->app->Tpl->Parse('PAGE',"shopexportuebersicht.tpl");
  }

  function ShopexportLive()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Navigation");
    $this->ShopexportMenu();


    $url = $this->app->DB->Select("SELECT url FROM shopexport WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('ID',$id);
    $this->app->Tpl->Set('URL',$url);


    $this->app->Tpl->Parse('PAGE',"shopexport_live.tpl");
  } 


  function ShopexportNavigationUebersicht()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Navigation");
    $this->ShopexportMenu();


    $this->app->Tpl->Set('ID',$id);
    $this->app->Tpl->Set('NAVEXPORT',"<div class=\"info\"> Navigation vom Shop &auml;ndern (interne Shop! kein XT & Co.).</div>");
    if($this->app->Secure->GetPOST("navexport")!=""){
      $anzahl = $this->app->remote->RemoteSendArtikelgruppen($id);
      $anzahl = $this->app->remote->RemoteSendNavigation($id);
      $this->app->erp->NewEvent("Navigations-Export Online-Shop Nr. $id","onlineshop");
      $this->app->Tpl->Set('NAVEXPORT',"<div class=\"error\">Es wurden ".$anzahl." Navigationen heraufgeladen.</div>");
    }


    $this->app->Tpl->Parse('PAGE',"shopexport_navigation.tpl");
  } 

  function ShopexportArtikelgruppen()
  {
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Artikelgruppen");
    $this->ShopexportMenu();

    $shop = $this->app->Secure->GetGET('id');
    $edit = $this->app->Secure->GetGET('edit');
    $delete = $this->app->Secure->GetGET('delete');

    $bezeichnung = $this->app->Secure->GetPOST('bezeichnung');
    $bezeichnung_en = $this->app->Secure->GetPOST('bezeichnung_en');
    $beschreibung_de = $this->app->Secure->GetPOST('beschreibung_de');
    $beschreibung_en = $this->app->Secure->GetPOST('beschreibung_en');


    $aktiv = $this->app->Secure->GetPOST('aktiv');
    $submit = $this->app->Secure->GetPOST('anlegen');

    // Edit
    if(is_numeric($edit)) {
      if($submit!='' && is_numeric($shop)) {
        $this->app->DB->Update("UPDATE artikelgruppen SET bezeichnung='$bezeichnung', 
            bezeichnung_en='$bezeichnung_en', 
            beschreibung_de='$beschreibung_de', 
            beschreibung_en='$beschreibung_en', 
            shop='$shop', aktiv='$aktiv' WHERE id='$edit' LIMIT 1");
        header("Location: ./index.php?module=shopexport&action=artikelgruppen&id=$shop#tabs-1");
        exit;
      }

      $data = $this->app->DB->SelectArr("SELECT bezeichnung, bezeichnung_en, beschreibung_de, beschreibung_en, aktiv
          FROM artikelgruppen WHERE id='$edit' LIMIT 1");		
      if(is_array($data))
      {
        $this->app->Tpl->Set('BEZEICHNUNG', $data[0]['bezeichnung']);
        $this->app->Tpl->Set('BESCHREIBUNG_DE', $data[0]['beschreibung_de']);
        $this->app->Tpl->Set('BESCHREIBUNG_EN', $data[0]['beschreibung_en']);
        $this->app->Tpl->Set('BEZEICHNUNGEN', $data[0]['bezeichnung_en']);
        $this->app->Tpl->Set('AKTIVCHECKED', (($data[0]['aktiv']=='1') ? 'checked' : ''));
      }
    }else{
      if($submit!='' && is_numeric($shop)) {
        $this->app->DB->Insert("INSERT INTO artikelgruppen (bezeichnung, bezeichnung_en, beschreibung_de,beschreibung_en, shop, aktiv) VALUES ('$bezeichnung', '$bezeichnung_en','$beschreibung_de','$beschreibung_en','$shop', '$aktiv')");	
        header("Location: ./index.php?module=shopexport&action=artikelgruppen&id=$shop#tabs-1");
        exit;
      }
    }

    // Delete
    if(is_numeric($delete)) {
      $this->app->DB->Delete("DELETE FROM artikelgruppen WHERE id='$delete' LIMIT 1");
      header("Location: index.php?module=shopexport&action=artikelgruppen&id=$shop");
      exit;
    }


    // Table
    $table = new EasyTable($this->app);
    $this->app->Tpl->Set('INHALT',"");
    $this->app->Tpl->Set('SUBSUBHEADING',"Artikelgruppen");
    $table->Query("SELECT g.bezeichnung as artikelgruppe, g.id as gruppe, s.bezeichnung, if(g.aktiv,'online','') as aktiv, g.id FROM artikelgruppen g, 
        shopexport s WHERE s.firma='".$this->app->User->GetFirma()."' AND s.id=g.shop AND s.id=$shop");
    $table->DisplayNew('INHALT', "<a href=\"index.php?module=shopexport&action=artikelgruppen&edit=%value%&id=$shop#tabs-2\"><img border=\"0\" src=\"./themes/[THEME]/images/edit.png\"></a>
        <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=shopexport&action=artikelgruppen&delete=%value%&id=$shop';\">
        <img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a>");
    $this->app->Tpl->Set('EXTEND',"");
    $this->app->Tpl->Parse('TABLE', "rahmen70.tpl");


    $this->app->Tpl->Parse('PAGE',"shopexport_artikelgruppen.tpl");
  }

  function ShopexportDateien()
  {
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Dateien");
    $this->ShopexportMenu();

    $id = $this->app->Secure->GetGET("id");
    $this->app->YUI->DateiUpload('PAGE',"Banner",$id);
  }

  function ShopexportMenu()
  {
    $id = $this->app->Secure->GetGET("id");

    $name = $this->app->DB->Select("SELECT bezeichnung FROM shopexport WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Add('KURZUEBERSCHRIFT2',$name);

    $typ = $this->app->DB->Select("SELECT typ FROM shopexport WHERE id='$id' LIMIT 1");

    $this->app->erp->MenuEintrag("index.php?module=onlineshops&action=edit&id=$id","Einstellungen");
    $this->app->erp->MenuEintrag("index.php?module=shopexport&action=export&id=$id","Export");

    if($typ=="wawision")
    {
      $this->app->erp->MenuEintrag("index.php?module=shopexport&action=navigationtab&id=$id","Navigation");
      $this->app->erp->MenuEintrag("index.php?module=shopexport&action=artikelgruppen&id=$id","Artikelgruppen");
      $this->app->erp->MenuEintrag("index.php?module=shopexport&action=dateien&id=$id","Dateien");
      $this->app->erp->MenuEintrag("index.php?module=shopexport&action=live&id=$id","Live-Status");
      $this->app->erp->MenuEintrag("index.php?module=inhalt&action=listshop&id=$id","Inhalte / E-Mailvorlagen");
    }
    $this->app->erp->MenuEintrag("index.php?module=shopexport&action=list","Zur&uuml;ck zur &Uuml;bersicht");
  }


  function ShopexportBesuchen()
  {
    $id = $this->app->Secure->GetGET("id");

    $url = $this->app->DB->Select("SELECT url FROM shopexport WHERE id='$id' LIMIT 1");
    $typ = $this->app->DB->Select("SELECT typ FROM shopexport WHERE id='$id' LIMIT 1");


    if($typ=="wawision")
    {
      header("Location: $url");
      exit;
    }	
  }


  function ShopexportExport()
  {
    $id = $this->app->Secure->GetGET("id");


    //		$this->app->Tpl->Set(KURZUEBERSCHRIFT,"Shopexport");
    $this->ShopexportMenu();


    $this->app->Tpl->Set('SCHRITT2',"disabled");
    $this->app->Tpl->Set('SCHRITT3',"disabled");

    $this->app->Tpl->Set('STATUS',"<div class=\"info\">Artikel Export: Bitte Verbindung pr&uuml;fen.</div>");


    $this->app->Tpl->Set('ID',$id);
    $this->app->Tpl->Set('COMMONEXPORT',"<div class=\"info\">Abgleich zu Kundencenter.</div>");


    if($this->app->Secure->GetPOST("commonexport")!=""){
      $anzahl = $this->app->remote->RemoteSendExportlink($id);
      //$anzahl = $this->app->remote->RemoteSendNavigation($id);
      //$this->app->erp->NewEvent("Navigations-Export Online-Shop Nr. $id","onlineshop");
      $this->app->Tpl->Set('COMMONEXPORT',"<div class=\"error\">Es wurden ".$anzahl." Datens&auml;tze heraufgeladen.</div>");
    }



    if($this->app->Secure->GetPOST("schritt1")!=""){
      $pageContents = $this->app->remote->RemoteConnection($id);
      if($pageContents=="success")
      {
        $this->app->Tpl->Set('SCHRITT2',"");
        $this->app->Tpl->Set('HIDDENSCHRITT2',"<input type=\"hidden\" name=\"schritt1_check\" value=\"1\">");
        $this->app->Tpl->Set('STATUS',"<div class=\"info\">Verbindung: $pageContents</div>");
      }
      else {
        $this->app->Tpl->Set('STATUS',"<div class=\"error\">Verbindungsproblem: Eventuell falsche Schl&uuml;ssel! ($pageContents)</div>");
      }
    }

    if($this->app->Secure->GetPOST("schritt2")!="" && $this->app->Secure->GetPOST("schritt1_check")=="1")
    {
      $projekt = $this->app->DB->Select("SELECT projekt FROM shopexport WHERE id='$id' LIMIT 1");

      $this->app->erp->UpdateChecksumShopartikel($projekt);

      $tmp  = $this->app->remote->RemoteGetUpdateArticleList($id);

      $this->app->Tpl->Set('SCHRITT2',"");
      $this->app->Tpl->Set('SCHRITT3',"");
      $this->app->Tpl->Set('HIDDENSCHRITT2',"<input type=\"hidden\" name=\"schritt1_check\" value=\"1\">");
      $this->app->Tpl->Set('HIDDENSCHRITT3',"<input type=\"hidden\" name=\"schritt2_check\" value=\"1\">");

      $html = "<table align=center>"; 
      $html = $html."<tr><td>Pos.</td><td></td><td>Artikel</td><td>Nummer</td><td>Letzte &Auml;nderung</td></tr>";

      if(is_array($tmp)){
        foreach($tmp as $row)
          $checkarray[$row['artikel']] = $row['checksum'];
      }
      /*
         if($projekt=="1") $checkmasterarray = $this->app->DB->SelectArr("SELECT id,checksum FROM artikel WHERE shop='1' AND projekt='$projekt' AND geloescht='0'");
         else if ($projekt=="2") $checkmasterarray = $this->app->DB->SelectArr("SELECT id,checksum FROM artikel WHERE shop='2' AND projekt='$projekt' AND geloescht='0'");
         else if ($projekt=="4") $checkmasterarray = $this->app->DB->SelectArr("SELECT id,checksum FROM artikel WHERE shop='3' AND projekt='$projekt' AND geloescht='0'");
       */
      $checkmasterarray = $this->app->DB->SelectArr("SELECT id,checksum FROM artikel WHERE shop='$id' AND geloescht='0'");
      $html = $html."<tr><td>CMS</td><td><input type=\"checkbox\" name=\"cms\" value=\"1\" checked></td><td>Inhaltsseiten (keine Shop-Artikeltexte)</td>                              
        <td></td><td>(falls vorhanden)</td></tr>";                                                                                                                 

        $html = $html."<tr><td>Artikelgruppen</td><td><input type=\"checkbox\" name=\"artikelgruppen\" value=\"1\" checked></td><td>Artikelgruppen</td>       
        <td></td><td>(falls vorhanden)</td></tr>";                                     

        $html = $html."<tr><td>Dateien/Bilder</td><td><input type=\"checkbox\" name=\"dateienupdate\" value=\"1\" checked></td><td>Shopbilder (dauert bei vielen Bildern)</td>                                                        
        <td></td><td>(falls vorhanden)</td></tr>";
      $aenderungen = 0;
      for($i=0; $i<count($checkmasterarray);$i++)
      {
        $artikel = $checkmasterarray[$i]['id'];
        $checksum= $checkmasterarray[$i]['checksum'];

        if(isset($checkarray) && isset($checkarray[$artikel]) && ($checkarray[$artikel]!=$checksum || $checkarray[$artikel]==""))
        {
          $aenderungen++;
          $tmp = $this->app->DB->SelectArr("SELECT a.name_de, a.nummer FROM artikel a WHERE a. id='$artikel' LIMIT 1");
          if($tmp)
          {
            $tmp[0]['logdatei'] = $this->app->DB->Select("SELECT logdatei FROM shopexport_artikel WHERE artikel='$artikel' AND shopexport='$id' LIMIT 1");

            if($tmp[0]['logdatei']=="") $tmp[0]['logdatei']="noch nicht vorhanden";


            $html = $html."<tr><td>$aenderungen</td><td><input type=\"checkbox\" name=\"artikel[]\" value=\"$artikel\" checked></td><td>{$tmp[0]['name_de']}</td>
              <td>{$tmp[0]['nummer']}</td><td>{$tmp[0]['logdatei']}</td></tr>";
          }
        } 
        if(isset($checkarray) && isset($checkarray[$artikel]))unset($checkarray[$artikel]);
      }

      // loesche alle artikel im shop die nicht mehr im ERP als shop artikel vorhanden sind!
      for($j=0;$j < count($checkarray); $j++)
        if(count($checkarray) > 0)
        {
          foreach($checkarray as $key_artikel=>$value_checksum)
            $pageContents = $this->app->remote->RemoteDeleteArticle($id,$key_artikel);

          $this->app->Tpl->Set('STATUS',"<div class=\"error\">Es wurden ".count($checkarray)." Artikel im Shop gel&ouml;scht (fehlende Attribute).</div>");
        }


      $this->app->Tpl->Add('STATUS',"<div class=\"info\">&Auml;nderungen an $aenderungen Artikel gefunden.</div>");

      $html = $html ."</table>"; 

      $this->app->Tpl->Set('UPDATES',$html);

    }
    if($this->app->Secure->GetPOST("schritt3")!="" && $this->app->Secure->GetPOST("schritt1_check")=="1" && 
        $this->app->Secure->GetPOST("schritt2_check")=="1")
    {
      $artikel = $this->app->Secure->GetPOST("artikel");
      $this->app->erp->NewEvent("Artikel-Export Online-Shop Nr. $id","onlineshop");

      // artikelgruppen update

      if($this->app->Secure->GetPOST("cms")=="1")
      {
        $cms = $this->app->DB->Select("SELECT cms FROM shopexport WHERE id='$id' LIMIT 1");
        if($cms=="1")
          $this->app->remote->RemoteSendInhalt($id);
      }

      if($this->app->Secure->GetPOST("artikelgruppen")=="1")
      {
        $this->app->remote->RemoteSendArtikelgruppen($id);
        $this->app->remote->RemoteSendArtikelArtikelgruppen($id);
      } 


      // sende artikel liste      
      $tmp_anzahl  = $this->app->remote->RemoteSendArticleList($id,$artikel);

      // dateien update
      //$dateien = $this->app->DB->SelectArr("SELECT DISTINCT ds.datei FROM datei_stichwoerter ds, datei d WHERE d.id=ds.datei AND (ds.subjekt!='Druckbild') AND (ds.objekt='Artikel' OR ds.objekt='Kampangen') AND d.geloescht=0 AND d.firma='".$this->app->User->GetFirma()."'");

      // das sind zuviele bilder!!!! nur die bilder vom shop! TODO

      //$dateien = $this->app->DB->SelectArr("SELECT DISTINCT ds.datei FROM datei_stichwoerter ds, datei d WHERE d.id=ds.datei AND (ds.subjekt!='Druckbild') AND (ds.objekt='Artikel'  OR ds.objekt='Kampangen') AND d.firma='".$this->app->User->GetFirma()."'");

      if($this->app->Secure->GetPOST("dateienupdate")==1)
      {      
        $dateien = $this->app->DB->SelectArr("SELECT DISTINCT ds.datei FROM datei_stichwoerter ds, datei d, artikel a WHERE d.id=ds.datei AND (ds.subjekt='Shopbild' OR ds.subjekt='Gruppenbild') AND ((ds.objekt='Artikel' AND ds.parameter=a.id)  OR (ds.objekt='Kampangen' AND ds.parameter='$id')) AND d.firma='".$this->app->User->GetFirma()."' AND a.shop='$id'");

        $tmp = $this->app->remote->RemoteGetFileList($id);

        if(is_array($tmp))
        {
          foreach($tmp as $row)
            $checkarray[$row[datei]] = $row[checksum];
        }
        $datei_updates = 0;
        for($i=0;$i<count($dateien);$i++)
        { 
          $fid = $dateien[$i][datei];
          $geloescht = $this->app->DB->Select("SELECT geloescht FROM datei WHERE id='$fid' LIMIT 1");

          if(isset($checkarray) && ($checkarray[$fid]!=md5($this->app->erp->GetDatei($fid))) && $geloescht==0)
          {
            $datei_updates++;
            $this->app->remote->RemoteSendFile($id,$fid);
            $this->app->remote->RemoteAddFileSubject($id,$fid);
            $checkarray[$fid]="update";
          } else 
          {
            if($geloescht)
            {
              $this->app->remote->RemoteDeleteFile($id,$fid);
              $checkarray[$fid]="delete";
            } 
          }
          $checkarray[$fid]="mark";
          // wenn datei lokal geloescht loesche diese auch auf dem server
          //	if($geloescht)
        }
      }
      //print_r($checkarray);
      if(is_array($checkarray) && count($checkarray)>0)
      {
        $delete=0;
        foreach($checkarray as $key=>$value)
        {
          if($checkarray[$key]!="mark" && $checkarray[$key]!="delete" && $checkarray[$key]!="update")
          {
            //echo "loesche $key<br>";
            $this->app->remote->RemoteDeleteFile($id,$key);
            $delete++;
          }
        }
      }
      //ENDE DATEIEN 
      // loesche nicht gebrauchte dateien


      if($datei_updates>0) $this->app->Tpl->Set('STATUS',"<div class=\"info\">Datei-Updates: ".$datei_updates.".</div>");
      if($delete>0) $this->app->Tpl->Add('STATUS',"<div class=\"info\">Datei(en) gel&ouml;scht: ".$delete.".</div>");
      // ende dateien update

      $this->app->DB->Insert("INSERT INTO shopexport_status (id, shopexport, bearbeiter,zeit, bemerkung,befehl)
          VALUES('','$id','".$this->app->User->GetName()."',NOW(),'','".serialize($artikel)."')");

      $this->app->Tpl->Add('STATUS',"<div class=\"info\">Erfolgreiche Updates an ".$tmp_anzahl." Artikeln durchgef&uuml;hrt.</div>");
    }

    $this->app->Tpl->Set('SUBHEADING',"Starte Artikel Export");
    $this->app->Tpl->Parse('PAGE',"shopexport_export.tpl");
  }



  function ShopexportNavigation()
  {
    $id = $this->app->Secure->GetGET("id");
    $tmp = new Navigation($this->app,$id);
    $this->app->Tpl->Set('ID',$id);
    $this->app->Tpl->Set('INHALT',$tmp->Get());

    $this->app->Tpl->Set('SUBSUBHEADING',"Navigationsstruktur Online-Shop");
    $this->app->Tpl->Parse('PAGE',"rahmen_ohne_form.tpl");
    $this->app->BuildNavigation=false;
  }


}
?>
