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
include ("_gen/rechnung.php");
//require_once("Payment/DTA.php"); //PEAR

class Rechnung extends GenRechnung
{

  function Rechnung(&$app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);
    $this->app->ActionHandler("list","RechnungList");
    $this->app->ActionHandler("create","RechnungCreate");
    $this->app->ActionHandler("positionen","RechnungPositionen");
    $this->app->ActionHandler("addposition","RechnungAddPosition");
    $this->app->ActionHandler("uprechnungposition","UpRechnungPosition");
    $this->app->ActionHandler("delrechnungposition","DelRechnungPosition");
    $this->app->ActionHandler("downrechnungposition","DownRechnungPosition");
    $this->app->ActionHandler("positioneneditpopup","RechnungPositionenEditPopup");
    $this->app->ActionHandler("search","RechnungSuche");
    $this->app->ActionHandler("mahnwesen","RechnungMahnwesen");
    $this->app->ActionHandler("edit","RechnungEdit");
    $this->app->ActionHandler("delete","RechnungDelete");
    $this->app->ActionHandler("gutschrift","RechnungGutschrift");
    $this->app->ActionHandler("copy","RechnungCopy");
    $this->app->ActionHandler("freigabe","RechnungFreigabe");
    $this->app->ActionHandler("abschicken","RechnungAbschicken");
    $this->app->ActionHandler("pdf","RechnungPDF");
    $this->app->ActionHandler("inlinepdf","RechnungInlinePDF");
    $this->app->ActionHandler("lastschrift","RechnungLastschrift");
    $this->app->ActionHandler("protokoll","RechnungProtokoll");
    $this->app->ActionHandler("zahlungseingang","RechnungZahlungseingang");
    $this->app->ActionHandler("minidetail","RechnungMiniDetail");
    $this->app->ActionHandler("editable","RechnungEditable");
    $this->app->ActionHandler("livetabelle","RechnungLiveTabelle");
    $this->app->ActionHandler("schreibschutz","RechnungSchreibschutz");
    $this->app->ActionHandler("manuellbezahltmarkiert","RechnungManuellBezahltMarkiert");
    $this->app->ActionHandler("manuellbezahltentfernen","RechnungManuellBezahltEntfernen");
    $this->app->ActionHandler("zahlungsmahnungswesen","RechnungZahlungMahnungswesen");
    $this->app->ActionHandler("deleterabatte","RechnungDeleteRabatte");
    $this->app->ActionHandler("updateverband","RechnungUpdateVerband");
    $this->app->ActionHandler("lastschriftwdh","RechnungLastschriftWdh");
    $this->app->ActionHandler("dateien","RechnungDateien");
    $this->app->ActionHandler("pdffromarchive","RechnungPDFfromArchiv");
    $this->app->ActionHandler("archivierepdf","RechnungArchivierePDF");

    $this->app->DefaultActionHandler("list");

    $id = $this->app->Secure->GetGET("id");
    $nummer = $this->app->Secure->GetPOST("adresse");

    if($nummer=="")
      $adresse= $this->app->DB->Select("SELECT a.name FROM rechnung b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    else
      $adresse = $nummer;

    $nummer = $this->app->DB->Select("SELECT b.belegnr FROM rechnung b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    if($nummer=="" || $nummer==0) $nummer="ohne Nummer";

    $this->app->Tpl->Set('UEBERSCHRIFT',"Rechnung:&nbsp;".$adresse." (".$nummer.")");
    $this->app->Tpl->Set('FARBE',"[FARBE4]");


    $this->app->ActionHandlerListen($app);
  }
  
  function RechnungArchivierePDF()
  {
    $id = (int)$this->app->Secure->GetGET('id');
    $projekt = $this->app->DB->Select("SELECT projekt FROM rechnung WHERE id = '$id' LIMIT 1");
    $Brief = new RechnungPDF($this->app,$projekt);
    $Brief->GetRechnung($id);
    $tmpfile = $Brief->displayTMP();
    $Brief->ArchiviereDocument();
    $this->app->DB->Update("UPDATE rechnung SET schreibschutz='1' WHERE id='$id'");
    header('Location: index.php?module=rechnung&action=edit&id='.$id);
    exit;
  }

  function RechnungUpdateVerband()
  {
    $id=$this->app->Secure->GetGET("id");
    $adresse = $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Verbandsinformation wurde neu geladen!</div>  ");
    header("Location: index.php?module=rechnung&action=edit&id=$id&msg=$msg");
    exit;
  }

  function RechnungMahnwesen()
  {


  }


  function RechnungLastschriftWdh()
  {

    $id=$this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE rechnung SET zahlungsstatus='offen',dta_datei=0 WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Rechnung kann nochmal eingezogen werden!</div>  ");
    header("Location: index.php?module=rechnung&action=edit&id=$id&msg=$msg");
    exit;
  }

  function RechnungDateien()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->RechnungMenu();
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Dateien)");
    $this->app->YUI->DateiUpload('PAGE',"Rechnung",$id);
  }

  function RechnungDeleteRabatte()
  {

    $id=$this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE rechnung SET rabatt='',rabatt1='',rabatt2='',rabatt3='',rabatt4='',rabatt5='',realrabatt='' WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Rabatte wurden entfernt!</div>  ");
    header("Location: index.php?module=rechnung&action=edit&id=$id&msg=$msg");
    exit;
  }



  function RechnungManuellBezahltEntfernen()
  {

    $id = $this->app->Secure->GetGET("id");

    $this->app->DB->Update("UPDATE rechnung SET zahlungsstatus='offen', ist='0',mahnwesen_internebemerkung=CONCAT(mahnwesen_internebemerkung,'\r\n','Manuell als bezahlt entfernt am ".date('d.m.Y')."') WHERE id='$id'");

    header("Location: index.php?module=rechnung&action=edit&id=$id");
    exit;
  }

  function RechnungManuellBezahltMarkiert()
  {

    $id = $this->app->Secure->GetGET("id");

    $this->app->DB->Update("UPDATE rechnung SET zahlungsstatus='bezahlt', ist=soll,mahnwesenfestsetzen=1,mahnwesen_internebemerkung=CONCAT(mahnwesen_internebemerkung,'\r\n','Manuell als bezahlt markiert am ".date('d.m.Y')."') WHERE id='$id'");

    header("Location: index.php?module=rechnung&action=edit&id=$id");
    exit;

  }


  function RechnungSchreibschutz()
  {

    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE rechnung SET zuarchivieren='1' WHERE id='$id'");
    $this->app->DB->Update("UPDATE rechnung SET schreibschutz='0' WHERE id='$id'");
    header("Location: index.php?module=rechnung&action=edit&id=$id");
    exit;

  }


  function RechnungCopy()
  {
    $id = $this->app->Secure->GetGET("id");

    $newid = $this->app->erp->CopyRechnung($id);

    header("Location: index.php?module=rechnung&action=edit&id=$newid");
    exit;
  }



  function RechnungIconMenu($id)
  {
    $status = $this->app->DB->Select("SELECT status FROM rechnung WHERE id='$id' LIMIT 1");
    $zahlungsstatus = $this->app->DB->Select("SELECT zahlungsstatus FROM rechnung WHERE id='$id' LIMIT 1");

    if($status=="angelegt" || $status=="")
      $freigabe = "<option value=\"freigabe\">Rechnung freigeben</option>";

    if($this->app->erp->RechteVorhanden("rechnung","manuellbezahltmarkiert") && $zahlungsstatus=="offen")
      $bezahlt = "<option value=\"manuellbezahltmarkiert\">manuell als bezahlt markieren</option>";

    if($this->app->erp->RechteVorhanden("rechnung","manuellbezahltentfernen") && $zahlungsstatus=="bezahlt")
      $bezahlt = "<option value=\"manuellbezahltentfernen\">manuell bezahlt entfernen</option>";


    $menu ="
      <script type=\"text/javascript\">
      function onchangerechnung(cmd)
      {
        switch(cmd)
        {
          case 'storno': if(!confirm('Wirklich stornieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=rechnung&action=delete&id=%value%'; break;
          case 'copy': if(!confirm('Wirklich kopieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=rechnung&action=copy&id=%value%'; break;
          case 'gutschrift': if(!confirm('Wirklich als Gutschrift / ".$this->app->erp->Firmendaten("bezeichnungstornorechnung")." weiterführen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=rechnung&action=gutschrift&id=%value%'; break;
          case 'pdf': window.location.href='index.php?module=rechnung&action=pdf&id=%value%'; document.getElementById('aktion$prefix').selectedIndex = 0; break;
          case 'abschicken':  ".$this->app->erp->DokumentAbschickenPopup()." break;
          case 'manuellbezahltmarkiert': window.location.href='index.php?module=rechnung&action=manuellbezahltmarkiert&id=%value%'; break;
          case 'manuellbezahltentfernen': window.location.href='index.php?module=rechnung&action=manuellbezahltentfernen&id=%value%'; break;
          case 'freigabe': window.location.href='index.php?module=rechnung&action=freigabe&id=%value%'; break;
        }

      }
    </script>


      &nbsp;Aktion:&nbsp;<select id=\"aktion$prefix\" onchange=\"onchangerechnung(this.value)\"> 
      <option>bitte w&auml;hlen ...</option>
      <option value=\"storno\">Rechnung stornieren</option>
      <option value=\"copy\">Rechnung kopieren</option>
      $freigabe
      <option value=\"abschicken\">Rechnung abschicken</option>
      <option value=\"gutschrift\">als Gutschrift / ".$this->app->erp->Firmendaten("bezeichnungstornorechnung")."</option>
      <option value=\"pdf\">PDF &ouml;ffnen</option>
      $bezahlt

      </select>&nbsp;

    <a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\" title=\"PDF\"></a>
      <!--  <a href=\"index.php?module=rechnung&action=edit&id=%value%\" title=\"Bearbeiten\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
      <a onclick=\"if(!confirm('Wirklich stornieren?')) return false; else window.location.href='index.php?module=rechnung&action=delete&id=%value%';\" title=\"Stornieren\">
      <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
      <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=rechnung&action=copy&id=%value%';\" title=\"Kopieren\">
      <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
      <a onclick=\"if(!confirm('Wirklich als Gutschrift weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=rechnung&action=gutschrift&id=%value%';\" title=\"als Gutschrift weiterf&uuml;hren\">
      <img src=\"./themes/new/images/lieferung.png\" border=\"0\" alt=\"weiterf&uuml;hren als Gutschrift\"></a>-->";

    //$tracking = $this->AuftragTrackingTabelle($id);

    $menu = str_replace('%value%',$id,$menu);
    return $menu;
  }


  function RechnungLiveTabelle()
  {
    $id = $this->app->Secure->GetGET("id");
    $status = $this->app->DB->Select("SELECT status FROM rechnung WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);

    if($status=="freigegeben")
    {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, ap.menge as Menge,ap.preis as Preis
          FROM rechnung_position ap, artikel a WHERE ap.rechnung='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","Preis","noAction");
    } else {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, ap.menge as M,ap.preis as Preis
          FROM rechnung_position ap, artikel a WHERE ap.rechnung='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","Preis","noAction");
    }
    echo $artikel;
    exit;
  }



  function RechnungEditable()
  {
    $this->app->YUI->AARLGEditable();
  }

  function RechnungPDFfromArchiv()
  {
    $id = $this->app->Secure->GetGET("id");
    $archiv = $this->app->DB->Select("SELECT table_id from pdfarchiv where id = '$id' LIMIT 1");
    if($archiv)
    {
      $projekt = $this->app->DB->Select("SELECT projekt from rechnung where id = '".(int)$archiv."'");
    }
    if($archiv)$Brief = new RechnungPDF($this->app,$projekt);
    if($archiv && $content = $Brief->getArchivByID($id))
    {
      
      header('Content-type: application/pdf');
      header('Content-Disposition: attachment; filename="'.$content['belegnr'].'.pdf"');
      echo $content['file'];
      exit;      
    } else {
      header('Content-type: application/pdf');
      header('Content-Disposition: attachment; filename="Fehler.pdf"');
      exit;
    }
  }

  function RechnungMiniDetail($parsetarget="",$menu=true)
  {
    $id = $this->app->Secure->GetGET("id");
    $auftragArr = $this->app->DB->SelectArr("SELECT * FROM rechnung WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='{$auftragArr[0]['projekt']}' LIMIT 1");
    $kundenname = $this->app->DB->Select("SELECT name FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");

    $this->app->Tpl->Set('DECKUNGSBEITRAG',0);
    $this->app->Tpl->Set('DBPROZENT',0);    
    $this->app->Tpl->Set('KUNDE',"<a href=\"index.php?module=adresse&action=edit&id=".$auftragArr[0]['adresse']."\">".$kundennummer."</a> ".$kundenname);
    $this->app->Tpl->Set('PROJEKT',$projekt);
    $this->app->Tpl->Set('ZAHLWEISE',$auftragArr[0]['zahlungsweise']);
    $this->app->Tpl->Set('STATUS',$auftragArr[0]['status']);
    $this->app->Tpl->Set('IHREBESTELLNUMMER',$auftragArr[0]['ihrebestellnummer']);


    if($auftragArr[0]['mahnwesen']=="")$auftragArr[0]['mahnwesen']="-";
    $this->app->Tpl->Set('MAHNWESEN',$auftragArr[0]['mahnwesen']);
    if($auftragArr[0]['mahnwesen_datum']=="0000-00-00")$auftragArr[0]['mahnwesen_datum']="-";
    $this->app->Tpl->Set('MAHNWESENDATUM',$auftragArr[0]['mahnwesen_datum']);


    if($auftragArr[0]['auftragid']==0) $auftragArr[0]['auftrag']="kein Auftrag";
    $this->app->Tpl->Set('AUFTRAG',"<a href=\"index.php?module=auftrag&action=edit&id=".$auftragArr[0]['auftragid']."\" target=\"_blank\">".$auftragArr[0]['auftrag']."</a>");



    $gutschrift = $this->app->DB->SelectArr("SELECT
        CONCAT('<a href=\"index.php?module=gutschrift&action=edit&id=',g.id,'\">',if(g.belegnr='0' OR g.belegnr='','ENTWURF',g.belegnr),'&nbsp;<a href=\"index.php?module=gutschrift&action=pdf&id=',g.id,'\"><img src=\"./themes/new/images/pdf.png\" title=\"Gutschrift PDF\" border=\"0\"></a>&nbsp;
          <a href=\"index.php?module=gutschrift&action=edit&id=',g.id,'\"><img src=\"./themes/new/images/edit.png\" title=\"Gutschrift bearbeiten\" border=\"0\"></a>') as gutschrift
        FROM gutschrift g WHERE g.rechnungid='$id'");

    if(count($gutschrift)>0)
    {
      for($li=0;$li<count($gutschrift);$li++)
      {
        $this->app->Tpl->Add('GUTSCHRIFT',$gutschrift[$li]['gutschrift']);
        if($li<count($gutschrift))
          $this->app->Tpl->Add('GUTSCHRIFT',"<br>");
      }
    }
    else
      $this->app->Tpl->Set('GUTSCHRIFT',"-");

    $lieferschein = $this->app->DB->Select("SELECT CONCAT(belegnr,'&nbsp;<a href=\"index.php?module=lieferschein&action=pdf&id=',id,'\">
      <img src=\"./themes/new/images/pdf.png\" title=\"Lieferschein PDF\" border=\"0\"></a>&nbsp;
    <a href=\"index.php?module=lieferschein&action=edit&id=',id,'\"><img src=\"./themes/new/images/edit.png\" title=\"Lieferschein bearbeiten\" border=\"0\"></a>') 
        FROM lieferschein WHERE id='{$auftragArr[0]['lieferschein']}' LIMIT 1");
    if($lieferschein=="") $lieferschein = "-";
    $this->app->Tpl->Set('LIEFERSCHEIN',$lieferschein);


    if($auftragArr[0]['ust_befreit']==0)
      $this->app->Tpl->Set('STEUER',"Deutschland");
    else if($auftragArr[0]['ust_befreit']==1)
      $this->app->Tpl->Set('STEUER',"EU-Lieferung");
    else
      $this->app->Tpl->Set('STEUER',"Export");


    if($menu)
    {
      $menu = $this->RechnungIconMenu($id);
      $this->app->Tpl->Set('MENU',$menu);
    }
    // ARTIKEL

    $status = $this->app->DB->Select("SELECT status FROM rechnung WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);

    if($status=="freigegeben")
    {
      $table->Query("SELECT if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung) as artikel, CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\" target=\"_blank\">', ap.nummer,'</a>') as Nummer, ap.menge as Menge,ap.preis as Preis
          FROM rechnung_position ap, artikel a WHERE ap.rechnung='$id' AND a.id=ap.artikel ORDER by ap.sort");
      $artikel = $table->DisplayNew("return","Preis","noAction");

      $this->app->Tpl->Add('JAVASCRIPT',"
          var auto_refresh = setInterval(
            function ()
            {
            $('#artikeltabellelive$id').load('index.php?module=rechnung&action=livetabelle&id=$id').fadeIn('slow');
            }, 3000); // refresh every 10000 milliseconds
          ");
    } else {
      $table->Query("SELECT if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung) as artikel, CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\"  target=\"_blank\">', ap.nummer,'</a>') as Nummer, ap.menge as Menge
          FROM rechnung_position ap, artikel a WHERE ap.rechnung='$id' AND a.id=ap.artikel ORDER by ap.sort");
      $artikel = $table->DisplayNew("return","Menge","noAction");
    }

    $this->app->Tpl->Set('ARTIKEL','<div id="artikeltabellelive'.$id.'">'.$artikel.'</div>');

    if($auftragArr[0]['belegnr'] =="0" || $auftragArr[0]['belegnr']=="") $auftragArr[0]['belegnr'] = "ENTWURF";
    $this->app->Tpl->Set('BELEGNR',"<a href=\"index.php?module=rechnung&action=edit&id=".$auftragArr[0]['id']."\">".$auftragArr[0]['belegnr']."</a>");
    $this->app->Tpl->Set('RECHNUNGID',$auftragArr[0]['id']);


    if($auftragArr[0]['status']=="freigegeben")
    {
      $this->app->Tpl->Set('ANGEBOTFARBE',"orange");
      $this->app->Tpl->Set('ANGEBOTTEXT',"Das Angebot wurde noch nicht als Auftrag weitergef&uuml;hrt!");
    }
    else if($auftragArr[0]['status']=="versendet")
    {
      $this->app->Tpl->Set('ANGEBOTFARBE',"red");
      $this->app->Tpl->Set('ANGEBOTTEXT',"Das Angebot versendet aber noch kein Auftrag vom Kunden erhalten!");
    }
    else if($auftragArr[0]['status']=="beauftragt")
    {
      $this->app->Tpl->Set('ANGEBOTFARBE',"green");
      $this->app->Tpl->Set('ANGEBOTTEXT',"Das Angebot wurde beauftragt und abgeschlossen!");
    }
    else if($auftragArr[0]['status']=="angelegt")
    {
      $this->app->Tpl->Set('ANGEBOTFARBE',"grey");
      $this->app->Tpl->Set('ANGEBOTTEXT',"Das Angebot wird bearbeitet und wurde noch nicht freigegeben und abgesendet!");
    }

    
    $this->app->Tpl->Set('ZAHLUNGEN',"<table width=100% border=0 class=auftrag_cell cellpadding=0 cellspacing=0>Erst ab Version Enterprise verf&uuml;gbar</table>");
    if(count($gutschrift) > 0)
      $this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"info\">Zu dieser Rechnung existiert eine Gutschrift!</div>");
    else {

      if($auftragArr[0]['zahlungsstatus']!="bezahlt")
        $this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"error\">Diese Rechnung ist noch nicht komplett bezahlt!</div>");
      else
        $this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"success\">Diese Rechnung ist bezahlt.</div>");
    }

    $this->app->Tpl->Set('RECHNUNGADRESSE',$this->Rechnungsadresse($auftragArr[0]['id']));

    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM rechnung_protokoll WHERE rechnung='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('PROTOKOLL',"Protokoll","noAction");


    $query = $this->app->DB->SelectArr("SELECT zeit,bearbeiter,grund FROM rechnung_protokoll WHERE rechnung='$id' ORDER by zeit");
    if($query)
    {
      $zeit = 0;
      foreach($query as $k => $row)
      {
        if(strpos($row['grund'], 'Zahlungserinnerung') === 0 || strpos($row['grund'], 'Mahnung') === 0 )
        {
          if(!$zeit)$zeit = $row['zeit'];
        }
      }
      if($zeit)
      {
        
        $tmp2 = new EasyTable($this->app);
        $tmp2->Query("SELECT concat('<a href=\"index.php?module=mahnwesen&action=mahnpdf&id=',rechnung,'&datum=',DATE_FORMAT(zeit,'%d.%m.%Y'),'&mahnwesen=',LOWER(LEFT(grund,LOCATE(' ',grund))),'\"><img src=\"themes/{$this->app->Conf->WFconf[defaulttheme]}/images/pdf.png\" border=\"0\"></a>') as PDF, Date(zeit) as Datum, bearbeiter,grund FROM rechnung_protokoll WHERE rechnung='$id' AND zeit >= '".$zeit."' ORDER by zeit DESC");
        $tmp2->DisplayNew('MAHNPROTOKOLL',"Protokoll","noAction");        
      }
      

    }

    $Brief = new RechnungPDF($this->app,$auftragArr[0]['projekt']);
    $Dokumentenliste = $Brief->getArchivedFiles($id, 'rechnung');
    if($Dokumentenliste)
    {
      $tmp3 = new EasyTable($this->app);
      $tmp3->headings = array('Datum','Belegnr','Bearbeiter','Men&uuml;');
      foreach($Dokumentenliste as $k => $v)
      {
        if(!$v['erstesoriginal'])
        {
          $tmpr['datum'] = date('d.m.Y H:i:s',strtotime($v['zeitstempel']));
          $tmpr['belegnr'] = str_replace('.pdf','',$v['file']);
          $tmpr['belegnr'] = substr($tmpr['belegnr'],strrpos($tmpr['belegnr'],'_')+1);
          if(isset($v['belegnummer']) && $v['belegnummer'])$tmpr['belegnr'] = $v['belegnummer'];
          $tmpr['bearbeiter'] = $v['bearbeiter'];
          $tmpr['menu'] = '<a href="index.php?module=rechnung&action=pdffromarchive&id='.$v['id'].'"><img src="themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/pdf.png" /></a>';
          $tmp3->datasets[] = $tmpr;
        }
      }
      
      $tmp3->DisplayNew('PDFARCHIV','Men&uuml;',"noAction");
    }


    if($parsetarget=="")
    {
      $this->app->Tpl->Output("rechnung_minidetail.tpl");
      exit;
    }  else {
      $this->app->Tpl->Parse($parsetarget,"rechnung_minidetail.tpl");
    }
  }

  function Rechnungsadresse($id)
  {
    $data = $this->app->DB->SelectArr("SELECT * FROM rechnung WHERE id='$id' LIMIT 1");

    foreach($data[0] as $key=>$value)
    {
      if($data[0][$key]!="" && $key!="abweichendelieferadresse" && $key!="land" && $key!="plz" && $key!="lieferland" && $key!="lieferplz") $data[0][$key] = $data[0][$key]."<br>";
    }


    $rechnungsadresse = $data[0]['name']."".$data[0]['ansprechpartner']."".$data[0]['abteilung']."".$data[0]['unterabteilung'].
      "".$data[0]['strasse']."".$data[0]['adresszusatz']."".$data[0]['land']."-".$data[0]['plz']." ".$data[0]['ort'];
    return "<table width=\"100%\">
      <tr valign=\"top\"><td width=\"50%\"><b>Rechnungsadresse:</b><br><br>$rechnungsadresse</td></tr>";
  }


  function RechnungLastschrift()
  {
    $this->app->Tpl->Set('UEBERSCHRIFT',"Lastschrift&nbsp;/&nbsp;Sammel&uuml;berweisung");
    $erzeugen = $this->app->Secure->GetPOST("erzeugen"); 
    $lastschrift= $this->app->Secure->GetPOST("lastschrift"); 
    $kontointern=$this->app->Secure->GetPOST("konto");

    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Lastschriften");
    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=list","Zur Rechnungs&uuml;bersicht");

    if($erzeugen!="")
    {
      //erzeugen
      $rechnung= $this->app->Secure->GetPOST("rechnung"); 

      for($i=0;$i<count($rechnung);$i++)
      {

        //rechnung auf bezahlt markieren + soll auf ist
        $this->app->DB->Update("UPDATE rechnung SET zahlungsstatus='abgebucht' WHERE id='{$rechnung[$i]}' AND firma='".$this->app->User->GetFirma()."' LIMIT 1");
      }
    }



    // offene Rechnungen
    $this->app->Tpl->Set('SUB1TABTEXT',"Offene Rechnungen");
    $table = new EasyTable($this->app);
    $table->Query("SELECT CONCAT('<input type=checkbox name=rechnung[] value=\"',r.id,'\" checked>') as auswahl, DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.soll as betrag, r.ist as ist, r.zahlungsweise, a.bank_inhaber, a.bank_institut, a.bank_blz, a.bank_konto, r.id
        FROM rechnung r LEFT JOIN projekt p ON p.id=r.projekt LEFT JOIN auftrag a ON a.id=r.auftragid WHERE (r.zahlungsstatus!='bezahlt' AND r.zahlungsstatus!='abgebucht') AND (r.zahlungsweise='lastschrift' OR r.zahlungsweise='einzugsermaechtigung') AND (r.belegnr!='') order by r.datum DESC, r.id DESC");
    $table->DisplayNew('SUB1TAB',"
        <!--<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>-->
        <a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        ");


    $summe = $this->app->DB->Select("SELECT SUM(r.soll)
        FROM rechnung r, projekt p WHERE (r.zahlungsstatus!='bezahlt' AND r.zahlungsstatus!='abgebucht')  AND (r.zahlungsweise='lastschrift' OR r.zahlungsweise='einzug') AND r.belegnr!='' AND p.id=r.projekt");

    if($summe <=0) $summe = "0,00";
    $this->app->Tpl->Set('TAB1',"<center>Gesamt offen: $summe EUR</center>");


    $this->app->YUI->TableSearch('TAB1',"lastschriften");
    $this->app->Tpl->Add('TAB1',"<br><center>
        <input type=\"submit\" name=\"submit\" value=\"Lastschriften an Zahlungstransfer &uuml;bergeben\"></center></form>");

    $this->app->YUI->TableSearch('TAB2',"lastschriftenarchiv");

    $this->app->Tpl->Parse('PAGE',"rechnung_lastschrift.tpl");


  }


  function RechnungGutschrift()
  {
    $id = $this->app->Secure->GetGET("id");

    $newid = $this->app->erp->WeiterfuehrenRechnungZuGutschrift($id);

    // pruefe obes schon eine gutschrift fuer diese rechnung gibt
    $anzahlgutschriften = $this->app->DB->Select("SELECT COUNT(id) FROM gutschrift WHERE rechnungid='$id' 
        AND rechnungid!=0 AND rechnungid!=''");

    if($anzahlgutschriften>1){
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Achtung es gibt bereits eine oder mehrer Gutschriften f&uuml;r diese Rechnung!</div>");
    }

    header("Location: index.php?module=gutschrift&action=edit&id=$newid&msg=$msg");
    exit;
  }


  function RechnungFreigabe()
  {
    $id = $this->app->Secure->GetGET("id");
    $freigabe= $this->app->Secure->GetGET("freigabe");
    $this->app->Tpl->Set('TABTEXT',"Freigabe");
    $this->app->erp->RechnungNeuberechnen($id);

    $this->app->erp->CheckVertrieb($id,"rechnung");
    $this->app->erp->CheckBearbeiter($id,"rechnung");

    if($freigabe==$id)
    {
      //$belegnr = $this->app->DB->Select("SELECT MAX(belegnr) FROM rechnung WHERE firma='".$this->app->User->GetFirma()."'");
      //if($belegnr <= 0) $belegnr = 400000; else $belegnr = $belegnr + 1;
      $projekt = $this->app->DB->Select("SELECT projekt FROM rechnung WHERE id='$id' LIMIT 1");
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");

      if($belegnr=="")
      {	
        $belegnr = $this->app->erp->GetNextNummer("rechnung",$projekt);
        $this->app->DB->Update("UPDATE rechnung SET belegnr='$belegnr', status='freigegeben' WHERE id='$id' LIMIT 1");
        $this->app->erp->RechnungProtokoll($id,"Rechnung freigegeben");
        $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Rechnung wurde freigegeben und kann jetzt versendet werden!</div>");
        header("Location: index.php?module=rechnung&action=edit&id=$id&msg=$msg");
        exit;
      } else {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Die Rechnung wurde bereits freigegeben!</div>");
        header("Location: index.php?module=rechnung&action=edit&id=$id&msg=$msg");
        exit;
      }

    } else { 

      $name = $this->app->DB->Select("SELECT a.name FROM rechnung b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
      $summe = $this->app->DB->Select("SELECT soll FROM rechnung WHERE id='$id' LIMIT 1");
      $waehrung = $this->app->DB->Select("SELECT waehrung FROM rechnung_position
          WHERE rechnung='$id' LIMIT 1");

      $this->app->Tpl->Set('TAB1',"<div class=\"info\">Soll die Rechnung an <b>$name</b> im Wert von <b>$summe $waehrung</b> 
          jetzt freigegeben werden? <input type=\"button\" value=\"Jetzt freigeben\" onclick=\"window.location.href='index.php?module=rechnung&action=freigabe&id=$id&freigabe=$id'\">
          </div>");
    }
    $this->RechnungMenu();
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }



  function RechnungAbschicken()
  {
    $this->RechnungMenu();
    $this->app->erp->DokumentAbschicken();
  }




  function RechnungDelete()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM rechnung WHERE id='$id' LIMIT 1");
    $status = $this->app->DB->Select("SELECT status FROM rechnung WHERE id='$id' LIMIT 1");

    if($belegnr=="0" || $belegnr=="")
    {

      $this->app->erp->DeleteRechnung($id);
      if($belegnr=="0" || $belegnr=="") $belegnr="ENTWURF";
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Das Rechnung \"$belegnr\" von \"$name\" wurde storniert!</div>");
      //header("Location: ".$_SERVER['HTTP_REFERER']."&msg=$msg");
      header("Location: index.php?module=rechnung&action=list&msg=$msg");
      exit;
    } else
    {
      if(0)//$status=="versendet")
      {
        // KUNDE muss RMA starten                                                                                                                             
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Rechnung \"$belegnr\" von \"$name\" kann nicht storniert werden sie bereits versendet ist. <br>Um die Rechnung zu stornieren muss eine Gutschrift angelegt werden.</div>");
      }
      else
      {
        $maxbelegnr = $this->app->DB->Select("SELECT MAX(belegnr) FROM rechnung");
        if(0)//$maxbelegnr == $belegnr)
        {
          $this->app->DB->Delete("DELETE FROM rechnung_position WHERE rechnung='$id'");
          $this->app->DB->Delete("DELETE FROM rechnung_protokoll WHERE rechnung='$id'");
          $this->app->DB->Delete("DELETE FROM rechnung WHERE id='$id'");
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Rechnung \"$belegnr\" von \"$name\" wurde storniert!</div>");
        } else
        {
          $this->app->DB->Update("UPDATE rechnung SET status='storniert',zahlungsstatus='bezahlt' WHERE id='$id'");
          $this->RechnungGutschrift();
          //$msg = $this->app->erp->base64_url_encode("<div class=\"error\">Rechnung \"$belegnr\" von \"$name\" kann nicht storniert werden das sie bereits versendet wurde, es neuere Nummern im Rechnungskreis gibt oder sie schon storniert wurde! Um die Rechnung zu stornieren muss eine Gutschrift angelegt werden (weiterf&uuml;hren als Gutschrift / Stornorechnung).</div>");
          
        }
        header("Location: index.php?module=rechnung&action=list&msg=$msg");
        exit;
      }

      //$msg = $this->app->erp->base64_url_encode("<div class=\"error\">Rechnung \"$name\" ($belegnr) kann nicht storniert werden, da es bereits versendet wurde!</div>");
      header("Location: index.php?module=rechnung&action=list&msg=$msg#tabs-1");
      exit;
    }

  }

  function RechnungProtokoll()
  {
    $this->RechnungMenu();
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Set('TABTEXT',"Protokoll");
    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM rechnung_protokoll WHERE rechnung='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('TAB1',"Protokoll","noAction");

    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function RechnungAddPosition()
  {
    $sid = $this->app->Secure->GetGET("sid");
    $id = $this->app->Secure->GetGET("id");
    $menge = $this->app->Secure->GetGET("menge");
    $datum  = $this->app->Secure->GetGET("datum");
    $datum  = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1");
    $this->app->erp->AddRechnungPosition($id, $sid,$menge,$datum);
    $this->app->erp->RechnungNeuberechnen($id);
    header("Location: index.php?module=rechnung&action=positionen&id=$id");
    exit;

  }

  function RechnungMahnPDF()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
    $mahnwesen = $this->app->DB->Select("SELECT mahnwesen FROM rechnung WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM rechnung WHERE id='$id' LIMIT 1");
    

    if($belegnr!="" && $belegnr!="0")
    {
      $Brief = new RechnungPDF($this->app,$projekt);
      $Brief->GetRechnung($id,$mahnwesen);
      $Brief->displayDocument(); 
    } //else
    //$this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Noch nicht freigegebene Rechnungen k&ouml;nnen nicht als PDF betrachtet werden.!</div>");

    //$this->RechnungList();
    exit;
  }

  function RechnungInlinePDF()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->RechnungNeuberechnen($id);
    $schreibschutz = $this->app->DB->Select("SELECT schreibschutz from rechnung where id='$id' LIMIT 1 ");

    $frame = $this->app->Secure->GetGET("frame");
    $projekt = $this->app->DB->Select("SELECT projekt FROM rechnung WHERE id='$id' LIMIT 1");

    if($frame=="")
    {
      $Brief = new RechnungPDF($this->app,$projekt);
      $Brief->GetRechnung($id);
      $Brief->inlineDocument($schreibschutz); 
    } else {
      $file = urlencode("../../../../index.php?module=rechnung&action=inlinepdf&id=$id");
      echo "<iframe width=\"100%\" height=\"600\" src=\"./js/production/generic/web/viewer.html?file=$file\" frameborder=\"0\"></iframe>";
      exit;
    }
  }

  function RechnungPDF()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->RechnungNeuberechnen($id);
    $doppel = $this->app->Secure->GetGET("doppel");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM rechnung WHERE id='$id' LIMIT 1");
    $schreibschutz = $this->app->DB->Select("SELECT schreibschutz from rechnung where id='$id' LIMIT 1 ");
    //    if(is_numeric($belegnr) && $belegnr!=0)
    //  {
    $Brief = new RechnungPDF($this->app,$projekt);
    if($doppel=="1")
      $Brief->GetRechnung($id,"doppel");
    else
      $Brief->GetRechnung($id);
    $Brief->displayDocument($schreibschutz); 
    //   } else
    //   $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Noch nicht freigegebene Rechnungen k&ouml;nnen nicht als PDF betrachtet werden.!</div>");


    $this->RechnungList();
  }

  function RechnungSuche()
  {
    $this->app->Tpl->Set('UEBERSCHRIFT',"Rechnungen");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Rechnungen");

    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=create","Neue Rechnung anlegen");
    //$this->app->Tpl->Add('TABS',"<li><a  href=\"index.php?module=rechnung&action=search\">Rechnung suchen</a></li>");


    $this->app->Tpl->Set('TABTEXT',"Rechnungen");

    $name = $this->app->Secure->GetPOST("name");
    $plz = $this->app->Secure->GetPOST("plz");
    $auftrag = $this->app->Secure->GetPOST("auftrag");
    $kundennummer = $this->app->Secure->GetPOST("kundennummer");

    if($name!="" || $plz!="" || $proforma!="" || $kundennummer!="" || $auftrag!="")
    {
      $table = new EasyTable($this->app);
      $this->app->Tpl->Add('ERGEBNISSE',"<h2>Trefferliste:</h2><br>");
      if($name!="")
        $table->Query("SELECT a.name, a.belegnr as rechung, adr.kundennummer, a.plz, a.ort, a.strasse, a.status, a.id FROM rechnung a 
            LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.name LIKE '%$name%')");
      else if($plz!="")
        $table->Query("SELECT a.name, a.belegnr as rechnung, adr.kundennummer, a.plz, a.ort, a.strasse, a.status, a.id FROM rechnung a 
            LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.plz LIKE '$plz%')");
      else if($kundennummer!="")
        $table->Query("SELECT a.name, a.belegnr as rechnung, adr.kundennummer, a.plz, a.ort, a.strasse, a.status, a.id FROM rechnung a 
            LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (adr.kundennummer='$kundennummer')");
      else if($auftrag!="")
        $table->Query("SELECT a.name, a.belegnr as rechnung , adr.kundennummer,a.plz, a.ort, a.strasse, a.status, a.id FROM rechnung a 
            LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.belegnr='$auftrag')");

      //     $table->DisplayNew('ERGEBNISSE',"<a href=\"index.php?module=rechnung&action=edit&id=%value%\">Lesen</a>");
      $table->DisplayNew('ERGEBNISSE',"<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
          <a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
          <a onclick=\"if(!confirm('Wirklich als Gutschrift/Stornorechnung weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=rechnung&action=gutschrift&id=%value%';\">
          <img src=\"./themes/new/images/lieferung.png\" border=\"0\" alt=\"weiterf&uuml;hren als Gutschrift/Stornorechnung\"></a>


          <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=rechnung&action=copy&id=%value%';\">
          <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
          ");

    } else {
      $this->app->Tpl->Add('ERGEBNISSE',"<div class=\"info\">Rechnungssuche (bitte entsprechende Suchparameter eingeben)</div>");
    }

    $this->app->Tpl->Parse('INHALT',"rechnungssuche.tpl");

    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->Tpl->Parse('TAB1',"rahmen77.tpl");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }


  function RechnungMenu()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM rechnung WHERE id='$id' LIMIT 1");

    if($belegnr=="0" || $belegnr=="") $belegnr ="(Entwurf)";

    //    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Rechnung $belegnr");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT2',"$name Rechnung $belegnr");

    $this->app->erp->RechnungNeuberechnen($id);

    //$this->app->Tpl->Add('TABS',"<li><h2 class=\"allgemein\" style=\"background-color: [FARBE4]\">Rechnung</h2></li>");
    //this->app->erp->MenuEintrag("index.php?module=rechnung&action=edit&id=$id","Rechnungsdaten");

    //$this->app->Tpl->Add(FURTHERTABS,'<li><a href="index.php?module=rechnung&action=zahlungsmahnungswesen&id=[ID]&frame=true#tabs-4">Zahlung-/ Mahnwesen</a></li>');
    //this->app->Tpl->Add(FURTHERTABSDIV,'<div id="tabs-4"></div>');

    //if($this->app->Secure->GetGET("action")!="abschicken")
    //this->app->erp->MenuEintrag("index.php?module=rechnung&action=zahlungsmahnungswesen&id=$id","Zahlung-/ Mahnwesen");
    //$this->app->Tpl->Add('TABS',"<li><a href=\"index.php?module=rechnung&action=positionen&id=$id\">Positionen</a></li>");

    // status bestell
    $status = $this->app->DB->Select("SELECT status FROM rechnung WHERE id='$id' LIMIT 1");

    if ($status=="angelegt")
    {
      $this->app->erp->MenuEintrag("index.php?module=rechnung&action=freigabe&id=$id","Freigabe");
    }
    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=edit&id=$id","Details");
    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=dateien&id=$id","Dateien");

    if($status=='bestellt')
    { 
      // $this->app->Tpl->Add('TABS',"<li><a href=\"index.php?module=rechnung&action=wareneingang&id=$id\">Wareneingang<br>R&uuml;ckst&auml;nde</a></li>");
      // $this->app->Tpl->Add('TABS',"<li><a class=\"tab\" href=\"index.php?module=rechnung&action=wareneingang&id=$id\">Mahnstufen</a></li>");
    } 


    //    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=abschicken&id=$id","Abschicken / Protokoll");
    //    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=protokoll&id=$id","Protokoll");



    //		if($this->app->Secure->GetGET("action")=="abschicken" || $this->app->Secure->GetGET("action")=="multilevel" || $this->app->Secure->GetGET("action")=="zahlungsmahnungswesen")
    //    	$this->app->erp->MenuEintrag("index.php?module=rechnung&action=edit&id=$id","Rechnung");

    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=list","Zur&uuml;ck zur &Uuml;bersicht");
  }

  function RechnungPositionen()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->RechnungNeuberechnen($id);
    $this->app->YUI->AARLGPositionen(false);
    return;


    $this->RechnungMenu();


    /* neu anlegen formular */
    $artikelart = $this->app->Secure->GetPOST("artikelart");
    $bestellnummer = $this->app->Secure->GetPOST("bestellnummer");
    $bezeichnung = $this->app->Secure->GetPOST("bezeichnung");
    $vpe = $this->app->Secure->GetPOST("vpe");
    $umsatzsteuerklasse = $this->app->Secure->GetPOST("umsatzsteuerklasse");
    $waehrung = $this->app->Secure->GetPOST("waehrung");
    $projekt= $this->app->Secure->GetPOST("projekt");
    $preis = $this->app->Secure->GetPOST("preis");
    $preis = str_replace(',','.',$preis);
    $menge = $this->app->Secure->GetPOST("menge");
    $lieferdatum = $this->app->Secure->GetPOST("lieferdatum");

    if($lieferdatum=="") $lieferdatum="00.00.0000";


    $rechnungsart = $this->app->DB->Select("SELECT rechnungsart FROM rechnung WHERE id='$id' LIMIT 1");
    $lieferant  = $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$id' LIMIT 1");

    $anlegen_artikelneu = $this->app->Secure->GetPOST("anlegen_artikelneu");

    if($anlegen_artikelneu!="")
    {

      if($bezeichnung!="" && $menge!="" && $preis!="")
      {
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM rechnung_position WHERE rechnung='$id' LIMIT 1");
        $sort = $sort + 1;

        $neue_nummer = $this->app->erp->NeueArtikelNummer($artikelart,$this->app->User->GetFirma(),$projekt);

        // anlegen als artikel
        $this->app->DB->InserT("INSERT INTO artikel (id,typ,nummer,projekt,name_de,umsatzsteuer,adresse,firma) 	
            VALUES ('','$artikelart','$neue_nummer','$projekt','$bezeichnung','$umsatzsteuerklasse','$lieferant','".$this->app->User->GetFirma()."')"); 	

          $artikel_id = $this->app->DB->GetInsertID();
        // einkaufspreis anlegen
        $this->app->DB->Insert("INSERT INTO verkaufspreise (id,artikel,adresse,objekt,projekt,preis,ab_menge,angelegt_am,bearbeiter)
            VALUES ('','$artikel_id','$lieferant','Standard','$projekt','$preis','$menge',NOW(),'".$this->app->User->GetName()."')");

        $lieferdatum = $this->app->String->Convert($lieferdatum,"%1.%2.%3","%3-%2-%1");

        $this->app->DB->Insert("INSERT INTO rechnung_position (id,rechnung,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
            VALUES ('','$id','$artikel_id','$bezeichnung','$bestellnummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuerklasse','angelegt','$projekt','$vpe')");

        header("Location: index.php?module=rechnung&action=positionen&id=$id");
        exit;
      } else
        $this->app->Tpl->Set('NEUMESSAGE',"<div class=\"error\">Bezeichnung, Menge und Preis sind Pflichtfelder!</div>");

    }
    $ajaxbuchen = $this->app->Secure->GetPOST("ajaxbuchen");
    if($ajaxbuchen!="")
    {
      $artikel = $this->app->Secure->GetPOST("artikel");
      $nummer = $this->app->Secure->GetPOST("nummer");
      $projekt = $this->app->Secure->GetPOST("projekt");
      $projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
      $sort = $this->app->DB->Select("SELECT MAX(sort) FROM rechnung_position WHERE rechnung='$id' LIMIT 1");
      $sort = $sort + 1;
      $artikel_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' LIMIT 1");
      $bezeichnung = $artikel;
      $neue_nummer = $nummer;
      $waehrung = 'EUR';
      $umsatzsteuerklasse = $this->app->DB->Select("SELECT umsatzsteuerklasse FROM artikel WHERE nummer='$nummer' LIMIT 1");
      $vpe = 'einzeln';

      $this->app->DB->Insert("INSERT INTO rechnung_position (id,rechnung,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
          VALUES ('','$id','$artikel_id','$bezeichnung','$neue_nummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuerklasse','angelegt','$projekt','$vpe')");
    }


    if(1)
    {
      $this->app->Tpl->Set('ARTIKELART',$this->app->erp->GetSelect($this->app->erp->GetArtikelart(),$artikelart));
      $this->app->Tpl->Set('VPE',$this->app->erp->GetSelect($this->app->erp->GetVPE(),$vpe));
      $this->app->Tpl->Set('WAEHRUNG',$this->app->erp->GetSelect($this->app->erp->GetWaehrung(),$vpe));
      $this->app->Tpl->Set('UMSATZSTEUERKLASSE',$this->app->erp->GetSelect($this->app->erp->GetUmsatzsteuerklasse(),$umsatzsteuerklasse));
      $this->app->Tpl->Set('PROJEKT',$this->app->erp->GetProjektSelect($projekt));
      $this->app->Tpl->Set('PREIS',$preis);
      $this->app->Tpl->Set('MENGE',$menge);
      $this->app->Tpl->Set('LIEFERDATUM',$lieferdatum);
      $this->app->Tpl->Set('BEZEICHNUNG',$bezeichung);
      $this->app->Tpl->Set('BESTELLNUMMER',$bestellnummer);


      $this->app->Tpl->Set('SUBSUBHEADING',"Externe Artikel anlegen (kein Stammartikel, kein Lagerartikel, etc.)");
      $this->app->Tpl->Parse('INHALT',"rechnung_artikelneu.tpl");
      $this->app->Tpl->Set('EXTEND',"<input type=\"submit\" value=\"Artikel unter Stammdaten anlegen\" name=\"anlegen_artikelneu\">");
      $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
      $this->app->Tpl->Set('EXTEND',"");
      $this->app->Tpl->Set('INHALT',"");


      /* ende neu anlegen formular */


      $this->app->Tpl->Set('SUBSUBHEADING',"Artikel aus Datenstamm (keine Lagerware)");

      $table = new EasyTable($this->app);
      $table->Query("SELECT CONCAT(LEFT(a.name_de,80),'...') as artikel, a.nummer, 
          p.abkuerzung as projekt,
          CONCAT('<input type=\"text\" size=\"3\" value=\"\" id=\"menge',a.id,'\">') as menge, a.id as id
          FROM artikel a LEFT JOIN projekt p ON a.projekt=p.id WHERE a.lagerartikel=0",5);
      $table->DisplayNew('INHALT', "<input type=\"button\" 
          onclick=\"document.location.href='index.php?module=rechnung&action=addposition&id=$id&sid=%value%&menge=' + document.getElementById('menge%value%').value;\" value=\"anlegen\">");
      $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
      $this->app->Tpl->Set('INHALT',"");


      /* artikel aus lager */
      $this->app->Tpl->Set('SUBSUBHEADING',"Artikel aus Auftrag");

      $table = new EasyTable($this->app);
      $table->Query("SELECT CONCAT(LEFT(a.name_de,80),'...') as artikel, a.nummer, 
          p.abkuerzung as projekt, '223223' as auftrag, 'im LS 2332' as lieferschein,
          CONCAT('<input type=\"text\" size=\"3\" value=\"\" id=\"menge',a.id,'\">') as menge, a.id as id
          FROM artikel a LEFT JOIN projekt p ON a.projekt=p.id WHERE a.lagerartikel=1",5);

      $table->DisplayNew('INHALT', "<input type=\"button\" 
          onclick=\"document.location.href='index.php?module=rechnung&action=addposition&id=$id&sid=%value%&menge=' + document.getElementById('menge%value%').value;\" value=\"anlegen\">");
      $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
      $this->app->Tpl->Set('INHALT',"");


      // child table einfuegen

      $this->app->Tpl->Set('SUBSUBHEADING',"Positionen");
      $menu = array("up"=>"uprechnungposition",
          "down"=>"downrechnungposition",
          //"add"=>"addstueckliste",
          "edit"=>"positioneneditpopup",
          "del"=>"delrechnungposition");

      $sql = "SELECT a.name_de as Artikel, p.abkuerzung as projekt, a.nummer as nummer, 
        DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, b.preis as preis, b.id as id
        FROM rechnung_position b
        LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
        WHERE b.rechnung='$id'";

      $this->app->Tpl->Add('EXTEND',"<input type=\"submit\" value=\"Gleiche Positionen zusammenf&uuml;gen\">");

      $this->app->YUI->SortListAdd('INHALT',$this,$menu,$sql);
      $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

      if($anlegen_artikelneu!="")
        $this->app->Tpl->Set('AKTIV_TAB2',"selected");
      else
        $this->app->Tpl->Set('AKTIV_TAB1',"selected");
      $this->app->Tpl->Parse('PAGE',"rechnung_positionuebersicht.tpl");
    } 
  }

  function DelRechnungPosition()
  {
    $this->app->YUI->SortListEvent("del","rechnung_position","rechnung");
    $this->RechnungPositionen();
  }

  function UpRechnungPosition()
  {
    $this->app->YUI->SortListEvent("up","rechnung_position","rechnung");
    $this->RechnungPositionen();
  }

  function DownRechnungPosition()
  {
    $this->app->YUI->SortListEvent("down","rechnung_position","rechnung");
    $this->RechnungPositionen();
  }


  function RechnungPositionenEditPopup()
  {
    $id = $this->app->Secure->GetGET("id");

    // nach page inhalt des dialogs ausgeben
    $widget = new WidgetRechnung_position($this->app,'PAGE');
    $sid= $this->app->DB->Select("SELECT rechnung FROM rechnung_position WHERE id='$id' LIMIT 1");
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=rechnung&action=positionen&id=$sid");
    $widget->Edit();
    $this->app->BuildNavigation=false;
  }



  //		       <li><a href="index.php?module=rechnung&action=inlinepdf&id=[ID]&frame=true#tabs-3">Vorschau</a></li>


  function RechnungEdit()
  {
    $action = $this->app->Secure->GetGET("action");
    $id = $this->app->Secure->GetGET("id");
    $msg = $this->app->Secure->GetGET("msg");

    // zum aendern vom Vertrieb
    $sid = $this->app->Secure->GetGET("sid");
    $cmd = $this->app->Secure->GetGET("cmd");
    if($this->app->erp->VertriebAendern("rechnung",$id,$cmd,$sid))
      return;

    if($this->app->erp->DisableModul("rechnung",$id))
    {
      //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","Zur&uuml;ck zur &Uuml;bersicht");
      $this->RechnungMenu();
      return;
    }
    $adresse = $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$id' LIMIT 1");
    if($adresse <=0)
    {
      $this->app->Tpl->Add('JAVASCRIPT','$(document).ready(function() { if(document.getElementById("adresse"))document.getElementById("adresse").focus(); });');
      $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Achtung! Dieses Dokument ist mit keinem Kunden-Nr. verlinkt. Bitte geben Sie die Kundennummer an und klicken Sie &uuml;bernehmen oder Speichern!</div>");
    }
    $this->app->YUI->AARLGPositionen();

    $this->app->erp->DisableVerband();
    $this->app->erp->CheckBearbeiter($id,"rechnung");
    $this->app->erp->CheckBuchhaltung($id,"rechnung");

    $zahlungsweise= $this->app->DB->Select("SELECT zahlungsweise FROM rechnung WHERE id='$id' LIMIT 1");
    $zahlungszieltage= $this->app->DB->Select("SELECT zahlungszieltage FROM rechnung WHERE id='$id' LIMIT 1");
    if($zahlungsweise=="rechnung" && $zahlungszieltage<1)
    {
      $this->app->Tpl->Add('MESSAGE',"<div class=\"info\">Hinweis: F&auml;lligkeit auf \"sofort\", da Zahlungsziel in Tagen auf 0 Tage gesetzt ist!</div>");
    }


    $status= $this->app->DB->Select("SELECT status FROM rechnung WHERE id='$id' LIMIT 1");
    $schreibschutz= $this->app->DB->Select("SELECT schreibschutz FROM rechnung WHERE id='$id' LIMIT 1");
    if($status != "angelegt" && $status != "angelegta" && $status != "a")
    {
      $Brief = new Briefpapier($this->app);
      if($Brief->zuArchivieren($id, "rechnung"))$this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Die Rechnung ist noch nicht archiviert! Bitte versenden oder manuell archivieren. <input type=\"button\" onclick=\"if(!confirm('Soll das Dokument archiviert werden?')) return false;else window.location.href='index.php?module=rechnung&action=archivierepdf&id=$id';\" value=\"Manuell archivieren\" /></div>");
    }

    $this->app->erp->RechnungNeuberechnen($id);

    $this->RechnungMiniDetail('MINIDETAIL',false);
    $this->app->Tpl->Set('ICONMENU',$this->RechnungIconMenu($id));
    $this->app->Tpl->Set('ICONMENU2',$this->RechnungIconMenu($id,2));

    $nummer = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM rechnung WHERE id='$id' LIMIT 1");
    $adresse = $this->app->DB->Select("SELECT adresse FROM rechnung WHERE id='$id' LIMIT 1");
    $punkte = $this->app->DB->Select("SELECT punkte FROM rechnung WHERE id='$id' LIMIT 1");
    $bonuspunkte = $this->app->DB->Select("SELECT bonuspunkte FROM rechnung WHERE id='$id' LIMIT 1");
    $soll = $this->app->DB->Select("SELECT soll FROM rechnung WHERE id='$id' LIMIT 1");

    $this->app->Tpl->Set('PUNKTE',"<input type=\"text\" name=\"punkte\" value=\"$punkte\" size=\"10\" readonly>");
    $this->app->Tpl->Set('BONUSPUNKTE',"<input type=\"text\" name=\"punkte\" value=\"$bonuspunkte\" size=\"10\" readonly>");

    $this->app->Tpl->Set('SOLL',"<input type=\"text\" name=\"punkte\" value=\"$soll\" size=\"10\" style=\"background-color:#eee; border-color:#ddd;\" readonly>");

    if($schreibschutz!="1" && $this->app->erp->RechteVorhanden("rechnung","schreibschutz"))
      $this->app->erp->AnsprechpartnerButton($adresse);

    if($nummer!="")
    {
      $this->app->Tpl->Set('NUMMER',$nummer);
      $this->app->Tpl->Set('KUNDE',"&nbsp;&nbsp;&nbsp;Kd-Nr.".$kundennummer);
    }

    $lieferdatum= $this->app->DB->Select("SELECT lieferdatum FROM rechnung WHERE id='$id' LIMIT 1");
    $rechnungsdatum= $this->app->DB->Select("SELECT datum FROM rechnung WHERE id='$id' LIMIT 1");
    $lieferscheinid= $this->app->DB->Select("SELECT lieferschein FROM rechnung WHERE id='$id' LIMIT 1");
    $lieferscheiniddatum = $this->app->DB->Select("SELECT datum FROM lieferschein WHERE id='$lieferscheinid' LIMIT 1");
    if($lieferdatum=="0000-00-00" && $schreibschutz!="1")
    {   
      if($lieferscheiniddatum!="0000-00-00")
        $this->app->DB->Update("UPDATE rechnung SET lieferdatum='$lieferscheiniddatum' WHERE id='$id' LIMIT 1");
      else
        $this->app->DB->Update("UPDATE rechnung SET lieferdatum='$rechnungsdatum' WHERE id='$id' LIMIT 1");
    } 


    $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM rechnung WHERE id='$id' LIMIT 1");
    if($this->app->Secure->GetPOST("zahlungsweise")!="") $zahlungsweise = $this->app->Secure->GetPOST("zahlungsweise");
    $zahlungsweise = strtolower($zahlungsweise);
    $this->app->Tpl->Set('RECHNUNG',"none");
    $this->app->Tpl->Set('KREDITKARTE',"none");
    $this->app->Tpl->Set('VORKASSE',"none");
    $this->app->Tpl->Set('PAYPAL',"none");
    $this->app->Tpl->Set('EINZUGSERMAECHTIGUNG',"none");
    if($zahlungsweise=="rechnung") $this->app->Tpl->Set('RECHNUNG',"");
    if($zahlungsweise=="paypal") $this->app->Tpl->Set('PAYPAL',"");
    if($zahlungsweise=="kreditkarte") $this->app->Tpl->Set('KREDITKARTE',"");
    if($zahlungsweise=="einzugsermaechtigung" || $zahlungsweise=="lastschrift") $this->app->Tpl->Set('EINZUGSERMAECHTIGUNG',"");
    if($zahlungsweise=="vorkasse" || $zahlungsweise=="kreditkarte" || $zahlungsweise=="paypal" || $zahlungsweise=="bar") $this->app->Tpl->Set('VORKASSE',"");


    $saldo=$this->app->DB->Select("SELECT ist-skonto_gegeben FROM rechnung WHERE id='$id'");
    $this->app->Tpl->Set('LIVEIST',"<input type=\"text\" value=\"$saldo\" readonly style=\"background-color:#eee; border-color:#ddd;\" size=\"10\">");

    if($schreibschutz=="1" && $this->app->erp->RechteVorhanden("rechnung","schreibschutz"))
    {
      $this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">Diese Rechnung wurde bereits versendet und darf daher nicht mehr bearbeitet werden!&nbsp;<input type=\"button\" value=\"Schreibschutz entfernen\" onclick=\"if(!confirm('Soll der Schreibschutz f&uuml;r diese Rechnung wirklich entfernt werden? Die gespeicherte Rechnung wird &uuml;berschrieben!')) return false;else window.location.href='index.php?module=rechnung&action=schreibschutz&id=$id';\"></div>");
    }
    if($schreibschutz=="1")
      $this->app->erp->CommonReadonly();
    if($schreibschutz=="1" && $this->app->erp->RechteVorhanden("rechnung","mahnwesen"))
    {
      $this->app->erp->RemoveReadonly("mahnwesen_datum");
      $this->app->erp->RemoveReadonly("mahnwesen_gesperrt");
      $this->app->erp->RemoveReadonly("mahnwesen_internebemerkung");
      $this->app->erp->RemoveReadonly("zahlungsstatus");
      $this->app->erp->RemoveReadonly("mahnwesenfestsetzen");
      $this->app->erp->RemoveReadonly("mahnwesen");

      if($this->app->erp->Firmendaten("mahnwesenmitkontoabgleich")!="1" || $this->app->DB->Select("SELECT mahnwesenfestsetzen FROM rechnung WHERE id='$id' LIMIT 1")==1)  
        $this->app->erp->RemoveReadonly("ist");

       $auftrag= $this->app->DB->Select("SELECT auftrag FROM rechnung WHERE id='$id' LIMIT 1");

      $this->app->erp->RemoveReadonly("skonto_gegeben");
      $this->app->erp->RemoveReadonly("internebemerkung");

      $speichern = $this->app->Secure->GetPOST("speichern");
      if($speichern!="")
      {
        $mahnwesen_datum = $this->app->Secure->GetPOST("mahnwesen_datum");
        $mahnwesen_gesperrt = $this->app->Secure->GetPOST("mahnwesen_gesperrt");
        $mahnwesen_internebemerkung = $this->app->Secure->GetPOST("mahnwesen_internebemerkung");
        $zahlungsstatus = $this->app->Secure->GetPOST("zahlungsstatus");
        $mahnwesenfestsetzen = $this->app->Secure->GetPOST("mahnwesenfestsetzen");
        $mahnwesen = $this->app->Secure->GetPOST("mahnwesen");
        $internebemerkung = $this->app->Secure->GetPOST("internebemerkung");
        $ist = str_replace(',','.',$this->app->Secure->GetPOST("ist"));
        $skonto_gegeben = str_replace(',','.',$this->app->Secure->GetPOST("skonto_gegeben"));

        if($mahnwesen_gesperrt!="1") $mahnwesen_gesperrt="0";
        if($mahnwesenfestsetzen!="1") $mahnwesenfestsetzen="0";
  
        $mahnwesen_datum = $this->app->String->Convert($mahnwesen_datum,"%1.%2.%3","%3-%2-%1");

        $this->app->DB->Update("UPDATE rechnung SET mahnwesen_internebemerkung='$mahnwesen_internebemerkung',zahlungsstatus='$zahlungsstatus',
          mahnwesen_gesperrt='$mahnwesen_gesperrt',mahnwesen_datum='$mahnwesen_datum', mahnwesenfestsetzen='$mahnwesenfestsetzen',internebemerkung='$internebemerkung',
          mahnwesen='$mahnwesen',ist='$ist',skonto_gegeben='$skonto_gegeben' WHERE id='$id' LIMIT 1");
      }

    $alle_gutschriften = $this->app->DB->SelectArr("SELECT id,belegnr FROM gutschrift WHERE rechnungid='$id' AND rechnungid>0");

    if(count($alle_gutschriften) > 1)
    {
      for($agi=0;$agi<count($alle_gutschriften);$agi++)
        $gutschriften .= "<a href=\"index.php?module=gutschrift&action=edit&id=".$alle_gutschriften[$agi][id]."\" target=\"_blank\">".$alle_gutschriften[$agi][belegnr]."</a> ";
      $this->app->Tpl->Add('MESSAGE',"<div class=\"error\">F&uuml;r die angebene Rechnung gibt es schon folgende Gutschriften: $gutschriften</div>");
    }


      $this->app->erp->CommonReadonly();
    }


    if($status=="")
      $this->app->DB->Update("UPDATE rechnung SET status='angelegt' WHERE id='$id' LIMIT 1");

    if($this->app->erp->Firmendaten("schnellanlegen")=="1")
    {
      $this->app->Tpl->Set('BUTTON_UEBERNEHMEN','      <input type="button" value="&uuml;bernehmen" onclick="document.getElementById(\'uebernehmen\').value=1; document.getElementById(\'eprooform\').submit();"/><input type="hidden" id="uebernehmen" name="uebernehmen" value="0">
          ');
    } else {
      $this->app->Tpl->Set('BUTTON_UEBERNEHMEN','
          <input type="button" value="&uuml;bernehmen" onclick="if(!confirm(\'Soll der neue Kunde wirklich &uuml;bernommen werden? Es werden alle Felder &uuml;berladen.\')) return false;else document.getElementById(\'uebernehmen\').value=1; document.getElementById(\'eprooform\').submit();"/><input type="hidden" id="uebernehmen" name="uebernehmen" value="0">
          ');
    }


    // immer wenn sich der lieferant genändert hat standartwerte setzen
    if($this->app->Secure->GetPOST("adresse")!="")
    {
      $tmp = $this->app->Secure->GetPOST("adresse");
      $kundennummer = $this->app->erp->FirstTillSpace($tmp);

      $name = substr($tmp,6);
      $adresse =  $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$kundennummer'  AND geloescht=0 LIMIT 1");

      $uebernehmen =$this->app->Secure->GetPOST("uebernehmen");
      if($uebernehmen=="1") // nur neuladen bei tastendruck auf uebernehmen // FRAGEN!!!!
      {
        $this->app->erp->LoadRechnungStandardwerte($id,$adresse);
        $this->app->erp->RechnungNeuberechnen($id);
        header("Location: index.php?module=rechnung&action=edit&id=$id");
        exit;
      }
    } 


    $land = $this->app->DB->Select("SELECT land FROM rechnung WHERE id='$id' LIMIT 1");
    $ustid = $this->app->DB->Select("SELECT ustid FROM rechnung WHERE id='$id' LIMIT 1");
    $ust_befreit = $this->app->DB->Select("SELECT ust_befreit FROM rechnung WHERE id='$id' LIMIT 1");
    if($ust_befreit)$this->app->Tpl->Set('USTBEFREIT',"<div class=\"info\">EU-Lieferung <br>(bereits gepr&uuml;ft!)</div>");
    else if($land!="DE" && $ustid!="") $this->app->Tpl->Set('USTBEFREIT',"<div class=\"error\">EU-Lieferung <br>(Fehler bei Pr&uuml;fung!)</div>");


    // easy table mit arbeitspaketen YUI als template 
    $table = new EasyTable($this->app);
    $table->Query("SELECT bezeichnung as artikel, nummer as Nummer, menge, vpe as VPE, FORMAT(preis,4) as preis
        FROM rechnung_position
        WHERE rechnung='$id'");
    $table->DisplayNew('POSITIONEN',"Preis","noAction");
    /*
       $table->Query("SELECT nummer as Nummer, menge,vpe as VPE, FORMAT(preis,4) as preis, FORMAT(menge*preis,4) as gesamt
       FROM rechnung_position
       WHERE rechnung='$id'");
       $table->DisplayNew(POSITIONEN,"Preis","noAction");
     */
    $summe = $this->app->DB->Select("SELECT FORMAT(SUM(menge*preis),2) FROM rechnung_position
        WHERE rechnung='$id'");
    $waehrung = $this->app->DB->Select("SELECT waehrung FROM rechnung_position
        WHERE rechnung='$id' LIMIT 1");

    $summebrutto = $this->app->DB->Select("SELECT soll FROM rechnung WHERE id='$id' LIMIT 1");
    $ust_befreit_check = $this->app->DB->Select("SELECT ust_befreit FROM rechnung WHERE id='$id' LIMIT 1");

    if($ust_befreit_check==1)
      $tmp = "Kunde ist UST befreit";
    else
      $tmp = "Kunde zahlt mit UST";


    if($summe > 0)
      $this->app->Tpl->Add('POSITIONEN', "<br><center>Zu zahlen: <b>$summe (netto) $summebrutto (brutto) $waehrung</b> ($tmp)&nbsp;&nbsp;");

    $status= $this->app->DB->Select("SELECT status FROM rechnung WHERE id='$id' LIMIT 1");
    //    $this->app->Tpl->Set(STATUS,"<input type=\"text\" size=\"35\" value=\"".$status."\" readonly>");
    $this->app->Tpl->Set('STATUS',"<input type=\"text\" size=\"30\" value=\"".$status."\" readonly [COMMONREADONLYINPUT]>");


    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    parent::RechnungEdit();

    $this->app->erp->MessageHandlerStandardForm();


    if($this->app->Secure->GetPOST("weiter")!="")
    {
      header("Location: index.php?module=rechnung&action=positionen&id=$id");
      exit;
    }
    $this->RechnungMenu();

  }

  function RechnungCreate()
  {


    $this->app->Tpl->Add('KURZUEBERSCHRIFT',"Rechnung");
    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=list","Zur&uuml;ck zur &Uuml;bersicht");


    $anlegen = $this->app->Secure->GetGET("anlegen");

    $anlegen = $this->app->Secure->GetGET("anlegen");

    if($this->app->erp->Firmendaten("schnellanlegen")=="1" && $anlegen!="1")
    {
      header("Location: index.php?module=rechnung&action=create&anlegen=1");
      exit;
    }

    if($anlegen != "")
    {
      $id = $this->app->erp->CreateRechnung();
      $this->app->erp->RechnungProtokoll($id,"Rechnung angelegt");
      header("Location: index.php?module=rechnung&action=edit&id=$id");
      exit;
    }
    $this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">M&ouml;chten Sie eine Rechnung jetzt anlegen? &nbsp;
        <input type=\"button\" onclick=\"window.location.href='index.php?module=rechnung&action=create&anlegen=1'\" value=\"Ja - Rechnung jetzt anlegen\"></div><br>");
    $this->app->Tpl->Set('TAB1',"
        <table width=\"100%\" style=\"background-color: #fff; border: solid 1px #000;\" align=\"center\">
        <tr>
        <td align=\"center\">
        <br><b style=\"font-size: 14pt\">Rechnungen in Bearbeitung</b>
        <br>
        <br>
        Offene Auftr&auml;ge, die durch andere Mitarbeiter in Bearbeitung sind.
        <br>
        </td>
        </tr>  
        </table>
        <br> 
        [AUFTRAGE]");


    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->YUI->TableSearch('AUFTRAGE',"rechnungeninbearbeitung");
    /*
       $table = new EasyTable($this->app);
       $table->Query("SELECT DATE_FORMAT(datum,'%d.%m.%y') as vom, if(belegnr,belegnr,'ohne Nummer') as beleg, name, status, id
       FROM rechnung WHERE status='angelegt' order by datum DESC, id DESC");
       $table->DisplayNew(AUFTRAGE, "<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
       <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=rechnung&action=delete&id=%value%';\">
       <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
       <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=rechnung&action=copy&id=%value%';\">
       <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
       ");
     */

    $this->app->Tpl->Set('TABTEXT',"Rechnung anlegen");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");

    //parent::RechnungCreate();
  }

  function RechnungList()
  {

    //$this->app->erp->MahnwesenBezahltcheck(); //TODO LANGSAM

    $this->app->DB->Update("UPDATE rechnung SET zahlungsstatus='offen' WHERE zahlungsstatus=''");

    $this->app->Tpl->Set('UEBERSCHRIFT',"Rechnungen");


    $backurl = $this->app->Secure->GetGET("backurl");
    $backurl = $this->app->erp->base64_url_decode($backurl);

    //    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Rechnungen");
    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=rechnung&action=create","Neue Rechnung anlegen");


    if(strlen($backurl)>5)
      $this->app->erp->MenuEintrag("$backurl","Zur&uuml;ck");
    //else
    //  $this->app->erp->MenuEintrag("index.php","Zur&uuml;ck zur &Uuml;bersicht");

    $zahlungsweisen = $this->app->DB->SelectArr('
      SELECT
        zahlungsweise
      FROM
        rechnung
      GROUP BY
        zahlungsweise
    ');

    $zahlungsweiseStr = '';
    if ($zahlungsweisen) {
      foreach ($zahlungsweisen as $zahlungsweise) {
        if (empty($zahlungsweise['zahlungsweise'])) {
          continue;
        }
        $zahlungsweiseStr .= '<option name="' . $zahlungsweise['zahlungsweise'] . '">' . ucfirst($zahlungsweise['zahlungsweise']) . '</option>';
      }
    }

    $status = $this->app->DB->SelectArr('
      SELECT
        status
      FROM
        rechnung
      GROUP BY
        status
    ');

    $statusStr = '';
    if ($status) {
      foreach ($status as $statusE) {
        if (empty($statusE['status'])) {
          continue;
        }
        $statusStr .= '<option name="' . $statusE['status'] . '">' . ucfirst($statusE['status']) . '</option>';
      }
    }

    $versandarten = $this->app->DB->SelectArr('
      SELECT
        versandart
      FROM
        rechnung
      GROUP BY
        versandart
    ');

    $versandartenStr = '';
    if ($versandarten) {
      foreach ($versandarten as $versandart) {
        if (empty($versandart['versandart'])) {
          continue;
        }
        $versandartenStr .= '<option name="' . $versandart['versandart'] . '">' . ucfirst($versandart['versandart']) . '</option>';
      }
    }

    $laender = $this->app->erp->GetSelectLaenderliste();
    $laenderStr = '';
    foreach ($laender as $landKey => $land) {
      $laenderStr .= '<option value="' . $landKey . '">' . $land . '</option>';
    }


    $this->app->Tpl->Add('ZAHLUNGSWEISEN',$zahlungsweiseStr);
    $this->app->Tpl->Add('STATUS',$statusStr);
    $this->app->Tpl->Add('VERSANDARTEN',$versandartenStr);
    $this->app->Tpl->Add('LAENDER',$laenderStr);

    $this->app->YUI->DatePicker("datumVon");
    $this->app->YUI->DatePicker("datumBis");
    $this->app->YUI->AutoComplete("projekt", "projektname", 1);
    $this->app->YUI->AutoComplete("kundennummer", "kunde", 1);
    $this->app->YUI->AutoComplete("rechnungsnummer", "rechnung", 1);
    $this->app->Tpl->Parse('TAB1',"rechnung_table_filter.tpl");

    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->Tpl->Set('INHALT',"");

    $this->app->YUI->TableSearch('TAB2',"rechnungenoffene");
    $this->app->YUI->TableSearch('TAB1',"rechnungen");
    $this->app->YUI->TableSearch('TAB3',"rechnungeninbearbeitung");

    $this->app->Tpl->Parse('PAGE',"rechnunguebersicht.tpl");

    return;




    $this->app->Tpl->Add('TABS',"<li><h2 class=\"allgemein\">Allgemein</h2></li>");
    $this->app->Tpl->Add('TABS',"<li><a  href=\"index.php?module=rechnung&action=create\">Neue Rechnung anlegen</a></li>");
    $this->app->Tpl->Add('TABS',"<li><a  href=\"index.php?module=rechnung&action=search\">Rechnung Suchen</a></li>");
    $this->app->Tpl->Add('TABS',"<li><a  href=\"index.php?module=rechnung&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");
    $this->app->Tpl->Add('TABS',"<li><br><br></li>");


    // nicht versendete Rechnungen
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.soll as betrag,if(r.zahlungsstatus='bezahlt',r.zahlungsstatus,'offen') as status, aborechnung as RL, r.id
        FROM rechnung r, projekt p WHERE r.versendet=0 AND r.status='freigegeben' AND p.id=r.projekt order by r.datum DESC, r.id DESC");

    $table->DisplayNew('INHALT',"<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich als Gutschrift/Stornorechnung weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=rechnung&action=gutschrift&id=%value%';\">
        <img src=\"./themes/new/images/lieferung.png\" border=\"0\" alt=\"weiterf&uuml;hren als Gutschrift/Stornorechnung\"></a>


        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=rechnung&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        ");
    $this->app->Tpl->Set('EXTEND',"<input type=\"button\" value=\"Sammelmailversand Rechnungslauf Rechnungen\">");
    $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
    $this->app->Tpl->Set('INHALT',"");

    // offene Rechnungen
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.soll as betrag, r.ist as ist, r.zahlungsweise, r.mahnwesen, r.id
        FROM rechnung r, projekt p WHERE r.zahlungsstatus!='bezahlt' AND r.belegnr!='' AND p.id=r.projekt order by r.datum DESC, r.id DESC");
    $table->DisplayNew('INHALT',"<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich als Gutschrift/Stornorechnung weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=rechnung&action=gutschrift&id=%value%';\">
        <img src=\"./themes/new/images/lieferung.png\" border=\"0\" alt=\"weiterf&uuml;hren als Gutschrift/Stornorechnung\"></a>

        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=rechnung&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        ");

    $summe = $this->app->DB->Select("SELECT SUM(r.soll)
        FROM rechnung r, projekt p WHERE r.zahlungsstatus!='bezahlt' AND r.belegnr!='' AND p.id=r.projekt");
    $this->app->Tpl->Set('EXTEND',"Gesamt offen: $summe EUR");
    /*
       $table->DisplayOwn('INHALT', "<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
       <a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
       <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=rechnung&action=copy&id=%value%';\">
       <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
       ",30,"mid");
     */
    $this->app->Tpl->Parse('TAB2',"rahmen70.tpl");

    $this->app->Tpl->Set('INHALT',"");

    // Archiv 
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.zahlungsweise, r.soll as betrag, status, r.id
        FROM rechnung r, projekt p WHERE zahlungsstatus='bezahlt' AND r.belegnr!='' AND p.id=r.projekt order by r.datum DESC, r.id DESC");
    $table->DisplayNew('INHALT',"<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich als Gutschrift/Stornorechnung weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=rechnung&action=gutschrift&id=%value%';\">
        <img src=\"./themes/new/images/lieferung.png\" border=\"0\" alt=\"weiterf&uuml;hren als Gutschrift/Stornorechnung\"></a>
        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=rechnung&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>

        ");

    /*
       $table->DisplayOwn('INHALT', "<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
       <a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
       <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=rechnung&action=copy&id=%value%';\">
       <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
       ",30,"mid");
     */
    $this->app->Tpl->Parse('TAB3',"rahmen70.tpl");

    $this->app->Tpl->Set('INHALT',"");

    // In Bearbeitung
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.soll as betrag, r.id
        FROM rechnung r, projekt p WHERE r.versendet=0 AND status='angelegt' AND p.id=r.projekt order by r.datum DESC, r.id DESC");

    $table->DisplayNew('INHALT', "<a href=\"index.php?module=rechnung&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=rechnung&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=rechnung&action=delete&id=%value%';\">
        <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=rechnung&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        ");
    $this->app->Tpl->Parse('TAB4',"rahmen70.tpl");

    //    if($this->app->DB->Select("SELECT SUM(id) FROM rechnung WHERE versendet=0")==0)
    //      $this->app->Tpl->Set('TAB1',"<div class=\"info\">Es sind keine nicht versendeten Rechnungen in Arbeit!</div>");


    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->Tpl->Parse('PAGE',"rechnunguebersicht.tpl");

    /*
       $this->app->Tpl->Set('TAB2',"lieferant, rechnung, waehrung, sprache, liefertermin, steuersatz, einkäufer, freigabe<br>
       <br>Rechnung (NR),Bestellart (NB), Bestelldatum
       <br>Projekt
       <br>Kostenstelle pro Position
       <br>Terminrechnung (am xx.xx.xxxx raus damit)
       <br>vorschlagsdaten für positionen
       <br>proposition reinklicken zum ändern und reihenfolge tabelle 
       <br>Rechnung muss werden wie rechnung (rechnung beschreibung = allgemein)
       <br>Positionen (wie stueckliste)
       <br>Wareneingang / Rückstand
       <br>Etiketten
       <br>Freigabe
       <br>Dokument direkt faxen
       ");
     */
  }

}
?>
