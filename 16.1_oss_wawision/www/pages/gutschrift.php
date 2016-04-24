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
include ("_gen/gutschrift.php");

class Gutschrift extends GenGutschrift
{

  function Gutschrift(&$app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","GutschriftList");
    $this->app->ActionHandler("create","GutschriftCreate");
    $this->app->ActionHandler("positionen","GutschriftPositionen");
    $this->app->ActionHandler("addposition","GutschriftAddPosition");
    $this->app->ActionHandler("upgutschriftposition","UpGutschriftPosition");
    $this->app->ActionHandler("delgutschriftposition","DelGutschriftPosition");
    $this->app->ActionHandler("downgutschriftposition","DownGutschriftPosition");
    $this->app->ActionHandler("positioneneditpopup","GutschriftPositionenEditPopup");
    $this->app->ActionHandler("edit","GutschriftEdit");
    $this->app->ActionHandler("copy","GutschriftCopy");
    $this->app->ActionHandler("delete","GutschriftDelete");
    $this->app->ActionHandler("storno","GutschriftStorno");
    $this->app->ActionHandler("freigabe","GutschriftFreigabe");
    $this->app->ActionHandler("abschicken","GutschriftAbschicken");
    $this->app->ActionHandler("pdf","GutschriftPDF");
    $this->app->ActionHandler("inlinepdf","GutschriftInlinePDF");
    $this->app->ActionHandler("protokoll","GutschriftProtokoll");
    $this->app->ActionHandler("zahlungseingang","GutschriftZahlungseingang");
    $this->app->ActionHandler("minidetail","GutschriftMiniDetail");
    $this->app->ActionHandler("editable","GutschriftEditable");
    $this->app->ActionHandler("livetabelle","GutschriftLiveTabelle");
    $this->app->ActionHandler("schreibschutz","GutschriftSchreibschutz");
    $this->app->ActionHandler("zahlungsmahnungswesen","GutschriftZahlungMahnungswesen");
    $this->app->ActionHandler("deleterabatte","GutschriftDeleteRabatte");
    $this->app->ActionHandler("dateien","GutschriftDateien");
    $this->app->ActionHandler("pdffromarchive","GutschriftPDFFromArchiv");
    $this->app->ActionHandler("archivierepdf","GutschriftArchivierePDF");

    $this->app->DefaultActionHandler("list");


    $id = $this->app->Secure->GetGET("id");

    $stornorechnung = $this->app->DB->Select("SELECT stornorechnung FROM gutschrift WHERE id='$id' LIMIT 1");
    if($stornorechnung)
      $this->app->Tpl->Set('BEZEICHNUNGTITEL',$this->app->erp->Firmendaten("bezeichnungstornorechnung"));
    else
      $this->app->Tpl->Set('BEZEICHNUNGTITEL','Gutschrift');
    $nummer = $this->app->Secure->GetPOST("adresse");

    if($nummer=="")
      $adresse= $this->app->DB->Select("SELECT a.name FROM gutschrift b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    else
      $adresse = $nummer;

    $nummer = $this->app->DB->Select("SELECT b.belegnr FROM gutschrift b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    if($nummer=="" || $nummer==0) $nummer="ohne Nummer";

    $this->app->Tpl->Set('UEBERSCHRIFT',"Auftrag:&nbsp;".$adresse." (".$nummer.")");

    $this->app->ActionHandlerListen($app);
  }

  function GutschriftArchivierePDF()
  {
    $id = (int)$this->app->Secure->GetGET('id');
    $projektbriefpapier = $this->app->DB->Select("SELECT projekt FROM gutschrift WHERE id = '$id' LIMIT 1");
    $Brief = new GutschriftPDF($this->app,$projektbriefpapier);
    $Brief->GetGutschrift($id);
    $tmpfile = $Brief->displayTMP();
    $Brief->ArchiviereDocument();
    $this->app->DB->Update("UPDATE gutschrift SET schreibschutz='1' WHERE id='$id'");
    header('Location: index.php?module=gutschrift&action=edit&id='.$id);
    exit;
  }

  function GutschriftPDFFromArchiv() 
  {
    $id = $this->app->Secure->GetGET("id");
    $archiv = $this->app->DB->Select("SELECT table_id from pdfarchiv where id = '$id' LIMIT 1");
    if($archiv)
    {
      $projekt = $this->app->DB->Select("SELECT projekt from gutschrift where id = '".(int)$archiv."'");
    }
    if($archiv)$Brief = new GutschriftPDF($this->app,$projekt);
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

  function GutschriftCopy()
  {
    $id = $this->app->Secure->GetGET("id");

    $newid = $this->app->erp->CopyGutschrift($id);

    header("Location: index.php?module=gutschrift&action=edit&id=$newid");
    exit;
  }


  function GutschriftDeleteRabatte()
  {

    $id=$this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE gutschrift SET rabatt='',rabatt1='',rabatt2='',rabatt3='',rabatt4='',rabatt5='',realrabatt='' WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Rabatte wurden entfernt!</div>  ");
    header("Location: index.php?module=gutschrift&action=edit&id=$id&msg=$msg");
    exit;
  }

  function GutschriftSchreibschutz()
  {

    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE gutschrift SET zuarchivieren='1' WHERE id='$id'");
    $this->app->DB->Update("UPDATE gutschrift SET schreibschutz='0' WHERE id='$id'");
    header("Location: index.php?module=gutschrift&action=edit&id=$id");
    exit;

  }

  function GutschriftDateien()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->GutschriftMenu();
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Dateien)");
    $this->app->YUI->DateiUpload('PAGE',"Gutschrift",$id);
  }


  function GutschriftZahlungMahnungswesen()
  {

    $this->GutschriftMenu();
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Set('TABTEXT',"Zahlung-/Mahnwesen");
    $this->GutschriftMiniDetail('TAB1',true);

    $this->app->Tpl->Parse('PAGE',"tabview.tpl");

  }


  function GutschriftEditable()
  { 
    $this->app->YUI->AARLGEditable();
  }

  function GutschriftIconMenu($id,$prefix="")
  {
    $status = $this->app->DB->Select("SELECT status FROM gutschrift WHERE id='$id' LIMIT 1");

    if($status=="angelegt" || $status=="")
      $freigabe = "<option value=\"freigabe\">Gutschrift freigeben</option>";

    $menu ="

      <script type=\"text/javascript\">
      function onchangegutschrift(cmd)
      {
        switch(cmd)
        {
          case 'storno': if(!confirm('Wirklich stornieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=gutschrift&action=delete&id=%value%'; break;
          case 'copy': if(!confirm('Wirklich kopieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=gutschrift&action=copy&id=%value%'; break;
          case 'pdf': window.location.href='index.php?module=gutschrift&action=pdf&id=%value%'; document.getElementById('aktion$prefix').selectedIndex = 0; break;
          case 'abschicken':  ".$this->app->erp->DokumentAbschickenPopup()." break;
          case 'freigabe': window.location.href='index.php?module=gutschrift&action=freigabe&id=%value%';  break;
        }

      }
    </script>

      &nbsp;Aktion:&nbsp;<select id=\"aktion$prefix\" onchange=\"onchangegutschrift(this.value);\">
      <option>bitte w&auml;hlen ...</option>
      <option value=\"storno\">Gutschrift stornieren</option>
      <option value=\"copy\">Gutschrift kopieren</option>
      $freigabe
      <option value=\"abschicken\">Gutschrift abschicken</option>
      <option value=\"pdf\">PDF &ouml;ffnen</option>
      </select>&nbsp;

    <a href=\"index.php?module=gutschrift&action=pdf&id=%value%\" title=\"PDF\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
      ";

    //$tracking = $this->AuftragTrackingTabelle($id);

    $menu = str_replace('%value%',$id,$menu);
    return $menu;
  }



  function GutschriftLiveTabelle()
  { 
    $id = $this->app->Secure->GetGET("id");
    $status = $this->app->DB->Select("SELECT status FROM gutschrift WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);

    if($status=="freigegeben")
    {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, ap.menge as M,ap.preis as P
          FROM gutschrift_position ap, artikel a WHERE ap.gutschrift='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","A","noAction");
    } else {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, ap.menge as M,ap.preis as P
          FROM gutschrift_position ap, artikel a WHERE ap.gutschrift='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","Menge","noAction");
    }
    echo $artikel;
    exit;
  }


  function GutschriftMiniDetail($parsetarget="",$menu=true)
  { 
    $id = $this->app->Secure->GetGET("id");
    $auftragArr = $this->app->DB->SelectArr("SELECT * FROM gutschrift WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='{$auftragArr[0]['projekt']}' LIMIT 1");
    $kundenname = $this->app->DB->Select("SELECT name FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");
    $this->app->Tpl->Set('DECKUNGSBEITRAG',0);
    $this->app->Tpl->Set('DBPROZENT',0);    
    $this->app->Tpl->Set('KUNDE',"<a href=\"index.php?module=adresse&action=edit&id=".$auftragArr[0]['adresse']."\">".$kundennummer."</a> ".$kundenname);
    $this->app->Tpl->Set('PROJEKT',$projekt);
    $this->app->Tpl->Set('ZAHLWEISE',$auftragArr[0]['zahlungsweise']);
    $this->app->Tpl->Set('STATUS',$auftragArr[0]['status']);

   $rechnung = $this->app->DB->SelectArr("SELECT
        CONCAT('<a href=\"index.php?module=rechnung&action=edit&id=',r.id,'\">',if(r.belegnr='0' OR r.belegnr='','ENTWURF',r.belegnr),'&nbsp;<a href=\"index.php?module=rechnung&action=pdf&id=',r.id,'\"><img src=\"./themes/new/images/pdf.png\" title=\"Rechnung PDF\" border=\"0\"></a>&nbsp;
          <a href=\"index.php?module=rechnung&action=edit&id=',r.id,'\"><img src=\"./themes/new/images/edit.png\" title=\"Rechnung bearbeiten\" border=\"0\"></a>') as rechnung
        FROM gutschrift g LEFT JOIN rechnung r ON r.id=g.rechnungid WHERE g.id='$id'");


    if(count($rechnung)>0)
    { 
      for($li=0;$li<count($rechnung);$li++)
      { 
        $this->app->Tpl->Add('RECHNUNG',$rechnung[$li]['rechnung']);
        if($li<count($rechnung))
          $this->app->Tpl->Add('RECHNUNG',"<br>");
      }
    }
    else
      $this->app->Tpl->Set('RECHNUNG',"-");

/*
    $rechnung = $this->app->DB->Select("SELECT CONCAT(rechnung,'&nbsp;<a href=\"index.php?module=rechnung&action=pdf&id=',rechnungid,'\">
      <img src=\"./themes/new/images/pdf.png\" title=\"Rechnung PDF\" border=\"0\"></a>&nbsp;
    <a href=\"index.php?module=rechnung&action=edit&id=',rechnungid,'\"><img src=\"./themes/new/images/edit.png\" title=\"Rechnung bearbeiten\" border=\"0\"></a>') 
        FROM gutschrift WHERE id='$id' LIMIT 1");

    if($rechnung=="" || $rechnung <=0 ) $rechnung = "-";
    $this->app->Tpl->Set(RECHNUNG,$rechnung);
*/
    /*
       $lieferschein = $this->app->DB->Select("SELECT CONCAT(belegnr,'&nbsp;<a href=\"index.php?module=lieferschein&action=pdf&id=',id,'\">
       <img src=\"./themes/small/images/pdf.png\" title=\"Lieferschein PDF\" border=\"0\"></a>&nbsp;
       <a href=\"index.php?module=lieferschein&action=edit&id=',id,'\"><img src=\"./themes/small/images/edit.png\" title=\"Lieferschein bearbeiten\" border=\"0\"></a>') 
       FROM lieferschein WHERE id='{$auftragArr[0]['lieferschein']}' LIMIT 1");
       if($lieferschein=="") $lieferschein = "-";
     */
    //    $this->app->Tpl->Set(LIEFERSCHEIN,$lieferschein);

    if($auftragArr[0]['ust_befreit']==0)
      $this->app->Tpl->Set('STEUER',"Deutschland");
    else if($auftragArr[0]['ust_befreit']==1)
      $this->app->Tpl->Set('STEUER',"EU-Lieferung");
    else
      $this->app->Tpl->Set('STEUER',"Export");


    if($menu)
    {
      $menu = $this->GutschriftIconMenu($id);
      $this->app->Tpl->Set('MENU',$menu);
    }
    // ARTIKEL

    $status = $this->app->DB->Select("SELECT status FROM gutschrift WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);

    if($status=="freigegeben")
    {
      $table->Query("SELECT if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung) as artikel, 
					CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\"  target=\"_blank\">', ap.nummer,'</a>') as Nummer, ap.menge as M,ap.preis as P
          FROM gutschrift_position ap, artikel a WHERE ap.gutschrift='$id' AND a.id=ap.artikel ORDER by ap.sort");
      $artikel = $table->DisplayNew("return","A","noAction");

      $this->app->Tpl->Add('JAVASCRIPT',"
          var auto_refresh = setInterval(
            function ()
            {
            $('#artikeltabellelive$id').load('index.php?module=gutschrift&action=livetabelle&id=$id').fadeIn('slow');
            }, 3000); // refresh every 10000 milliseconds
          ");
    } else {
      $table->Query("SELECT if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung) as artikel, 
					CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\"  target=\"_blank\">', ap.nummer,'</a>') as Nummer, ap.menge as M
          FROM gutschrift_position ap, artikel a WHERE ap.gutschrift='$id' AND a.id=ap.artikel ORDER by ap.sort");

      $artikel = $table->DisplayNew("return","Menge","noAction");
    }
    $this->app->Tpl->Set('ARTIKEL','<div id="artikeltabellelive'.$id.'">'.$artikel.'</div>');

    if($auftragArr[0]['belegnr']=="0" || $auftragArr[0]['belegnr']=="") $auftragArr[0]['belegnr'] = "ENTWURF";
    $this->app->Tpl->Set('BELEGNR',$auftragArr[0]['belegnr']);
    $this->app->Tpl->Set('GUTSCHRIFTID',$auftragArr[0]['id']);


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


    $this->app->Tpl->Set('GUTSCHRIFTADRESSE',$this->Gutschriftadresse($auftragArr[0]['id']));

    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM gutschrift_protokoll WHERE gutschrift='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('PROTOKOLL',"Protokoll","noAction");

    $Brief = new GutschriftPDF($this->app,$projekt);
    
    $Dokumentenliste = $Brief->getArchivedFiles($id, 'gutschrift');
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
          $tmpr['menu'] = '<a href="index.php?module=gutschrift&action=pdffromarchive&id='.$v['id'].'"><img src="themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/pdf.png" /></a>';
          $tmp3->datasets[] = $tmpr;
        }
      }
      $tmp3->DisplayNew('PDFARCHIV','Men&uuml;',"noAction");
    }

    if($parsetarget=="")
    {
      $this->app->Tpl->Output("gutschrift_minidetail.tpl");
      exit;
    }  else {
      $this->app->Tpl->Parse($parsetarget,"gutschrift_minidetail.tpl");
    }
  }

  function Gutschriftadresse($id)
  {
    $data = $this->app->DB->SelectArr("SELECT * FROM gutschrift WHERE id='$id' LIMIT 1");

    foreach($data[0] as $key=>$value)
    {
      if($data[0][$key]!="" && $key!="abweichendelieferadresse" && $key!="land" && $key!="plz" && $key!="lieferland" && $key!="lieferplz") $data[0][$key] = $data[0][$key]."<br>";
    }


    $rechnungsadresse = $data[0]['name']."".$data[0]['ansprechpartner']."".$data[0]['abteilung']."".$data[0]['unterabteilung'].
      "".$data[0]['strasse']."".$data[0]['adresszusatz']."".$data[0]['land']."-".$data[0]['plz']." ".$data[0]['ort'];
    return "<table width=\"100%\">
      <tr valign=\"top\"><td width=\"50%\"><b>Gutschrift:</b><br><br>$rechnungsadresse</td></tr>";
  }

  function GutschriftZahlung($return=false)
  {
    $id = $this->app->Secure->GetGET("id");

    $gutschriftArr = $this->app->DB->SelectArr("SELECT DATE_FORMAT(datum,'%d.%m.%Y') as datum, belegnr, soll FROM gutschrift WHERE id='$id' LIMIT 1");


    $rechnungid = $this->app->DB->Select("SELECT rechnungid FROM gutschrift WHERE id='$id' LIMIT 1");

    $auftragid = $this->app->DB->Select("SELECT auftragid FROM rechnung WHERE id='$rechnungid' LIMIT 1");
    $eingang ="<tr><td colspan=\"3\"><b>Zahlungen</b></td></tr>";


    $eingang .="<tr><td class=auftrag_cell>".$gutschriftArr[0]['datum']."</td><td class=auftrag_cell>GS ".$gutschriftArr[0]['belegnr']."</td><td class=auftrag_cell align=right>".$this->app->erp->EUR($gutschriftArr[0]['soll'])." EUR</td></tr>";

    $eingangArr = $this->app->DB->SelectArr("SELECT ko.bezeichnung as konto, DATE_FORMAT(ke.datum,'%d.%m.%Y') as datum, k.id as kontoauszuege, ke.betrag as betrag, k.id as zeile FROM kontoauszuege_zahlungseingang ke 
        LEFT JOIN kontoauszuege k ON ke.kontoauszuege=k.id LEFT JOIN konten ko ON k.konto=ko.id WHERE (ke.objekt='gutschrift' AND ke.parameter='$id') OR (ke.objekt='auftrag' AND ke.parameter='$auftragid' AND ke.parameter>0)
        OR (ke.objekt='rechnung' AND ke.parameter='$rechnungid'  AND ke.parameter>0)");

    for($i=0;$i<count($eingangArr);$i++)
      $eingang .="<tr><td class=auftrag_cell>".$eingangArr[$i]['datum']."</td><td class=auftrag_cell>".$eingangArr[$i]['konto']."&nbsp;(<a href=\"index.php?module=zahlungseingang&action=editzeile&id=".$eingangArr[$i]['zeile']."\">zur Buchung</a>)</td><td class=auftrag_cell align=right>".$this->app->erp->EUR($eingangArr[$i]['betrag'])." EUR</td></tr>";

    // gutschriften zu dieser rechnung anzeigen

    $gutschriften = $this->app->DB->SelectArr("SELECT belegnr, DATE_FORMAT(datum,'%d.%m.%Y') as datum,soll FROM gutschrift WHERE rechnungid='$id'");

    for($i=0;$i<count($gutschriften);$i++)
      $eingang .="<tr><td class=auftrag_cell>".$gutschriften[$i]['datum']."</td><td class=auftrag_cell>GS ".$gutschriften[$i]['belegnr']."</td><td class=auftrag_cell align=right>".$this->app->erp->EUR($gutschriften[$i]['soll'])." EUR</td></tr>";




    $ausgangArr = $this->app->DB->SelectArr("SELECT ko.bezeichnung as konto, DATE_FORMAT(ke.datum,'%d.%m.%Y') as datum, ke.betrag as betrag, k.id as zeile FROM kontoauszuege_zahlungsausgang ke 
        LEFT JOIN kontoauszuege k ON ke.kontoauszuege=k.id LEFT JOIN konten ko ON k.konto=ko.id WHERE (ke.objekt='gutschrift' AND ke.parameter='$id') OR (ke.objekt='rechnung' AND ke.parameter='$rechnungid'  AND ke.parameter>0) 
        OR (ke.objekt='auftrag' AND ke.parameter='$auftragid'  AND ke.parameter>0)");

    for($i=0;$i<count($ausgangArr);$i++)
      $ausgang .="<tr><td class=auftrag_cell>".$ausgangArr[$i]['datum']."</td><td class=auftrag_cell>".$ausgangArr[$i]['konto']."&nbsp;(<a href=\"index.php?module=zahlungseingang&action=editzeile&id=".$ausgangArr[$i]['zeile']."\">zur Buchung</a>)</td><td class=auftrag_cell align=right>".$this->app->erp->EUR($ausgangArr[$i]['betrag'])." EUR</td></tr>";

    $saldo = $this->app->erp->EUR($this->app->erp->GutschriftSaldo($id));

    if($saldo < 0) $saldo = "<b style=\"color:red\">$saldo</b>";

    $ausgang .="<tr><td class=auftrag_cell></td><td class=auftrag_cell align=right>Saldo</td><td class=auftrag_cell align=right>$saldo EUR</td></tr>";

    if($return)return "<table width=100% border=0 class=auftrag_cell cellpadding=0 cellspacing=0>".$eingang." ".$ausgang."</table>";

  }



  function GutschriftFreigabe()
  {
    $id = $this->app->Secure->GetGET("id");
    $freigabe= $this->app->Secure->GetGET("freigabe");
    $this->app->Tpl->Set('TABTEXT',"Freigabe");
    $this->app->erp->GutschriftNeuberechnen($id);

    $this->app->erp->CheckVertrieb($id,"gutschrift");
    $this->app->erp->CheckBearbeiter($id,"gutschrift");

    if($freigabe==$id)
    {
      $projekt = $this->app->DB->Select("SELECT projekt FROM gutschrift WHERE id='$id' LIMIT 1");
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='$id' LIMIT 1");
      if($belegnr=="")
      {
        $belegnr = $this->app->erp->GetNextNummer("gutschrift",$projekt);
        $this->app->DB->Update("UPDATE gutschrift SET belegnr='$belegnr', status='freigegeben' WHERE id='$id' LIMIT 1");
        $this->app->erp->GutschriftProtokoll($id,"Gutschrift freigegeben");
        //$this->app->Tpl->Set(TAB1,"<div class=\"warning\">Die Gutschrift wurde freigegeben und kann jetzt versendet werden!</div>");  
        $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Gutschrift wurde freigegeben und kann jetzt versendet werden!</div>");
        header("Location: index.php?module=gutschrift&action=edit&id=$id&msg=$msg");
        exit;
      } else {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Die Gutschrift war bereits freigegeben!</div>");
        header("Location: index.php?module=gutschrift&action=edit&id=$id&msg=$msg");
        exit;
      }

    } else { 

      $name = $this->app->DB->Select("SELECT a.name FROM gutschrift b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
      $summe = $this->app->DB->Select("SELECT soll FROM gutschrift WHERE id='$id' LIMIT 1");
      $waehrung = $this->app->DB->Select("SELECT waehrung FROM gutschrift_position
          WHERE gutschrift='$id' LIMIT 1");

      $this->app->Tpl->Set('TAB1',"<div class=\"info\">Soll die Gutschrift an <b>$name</b> im Wert von <b>$summe $waehrung</b> 
          jetzt freigegeben werden? <input type=\"button\" value=\"Freigabe\" onclick=\"window.location.href='index.php?module=gutschrift&action=freigabe&id=$id&freigabe=$id'\">
          </div>");
    }
    $this->GutschriftMenu();
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }


  function GutschriftAbschicken()
  {
    $this->GutschriftMenu();
    $this->app->erp->DokumentAbschicken();
  }

  function GutschriftDelete()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM gutschrift WHERE id='$id' LIMIT 1");
    $status = $this->app->DB->Select("SELECT status FROM gutschrift WHERE id='$id' LIMIT 1");

    if($belegnr=="0" || $belegnr=="")
    {

      $this->app->erp->DeleteGutschrift($id);
      $belegnr="ENTWURF";
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Die Gutschrift \"$name\" ($belegnr) wurde gel&ouml;scht!</div>");
      //header("Location: ".$_SERVER['HTTP_REFERER']."&msg=$msg");
      header("Location: index.php?module=gutschrift&action=list&msg=$msg");
      exit;
    } else
    {
      if(0)//$status=="versendet")
      {
        // KUNDE muss RMA starten                                                                                                                             
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Gutschrift \"$name\" ($belegnr) kann nicht storniert werden sie bereits versendet ist.</div>");
      }
      else
      {
        $maxbelegnr = $this->app->DB->Select("SELECT MAX(belegnr) FROM gutschrift");
        if(0)//$maxbelegnr == $belegnr)
        {
          $this->app->DB->Delete("DELETE FROM gutschrift_position WHERE gutschrift='$id'");
          $this->app->DB->Delete("DELETE FROM gutschrift_protokoll WHERE gutschrift='$id'");
          $this->app->DB->Delete("DELETE FROM gutschrift WHERE id='$id'");
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Gutschrift \"$name\" ($belegnr) wurde ge&ouml;scht !</div>");
        } else
        {
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Gutschrift \"$name\" ($belegnr) kann nicht storniert werden das sie bereits versendet oder storniert ist!</div>");
        }
        header("Location: index.php?module=gutschrift&action=list&msg=$msg");
        exit;
      }

      //$msg = $this->app->erp->base64_url_encode("<div class=\"error\">Gutschrift \"$name\" ($belegnr) kann nicht storniert werden, da es bereits versendet wurde!</div>");
      header("Location: index.php?module=gutschrift&action=list&msg=$msg#tabs-1");
      exit;
    }

  }


  function GutschriftDelete2()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='$id' LIMIT 1");

    if($belegnr=="" || $belegnr=="0")
    {
      $this->app->erp->DeleteGutschrift($id);
      $this->app->Tpl->Set('MESSAGE',"<div class=\"info\">Gutschrift wurde gel&ouml;scht!</div>");
    } else 
    {
      $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Die Gutschrift kann nicht mehr gel&ouml;scht werden, da diese bereits versendet wurde!</div>");
    }
    $this->GutschriftList();

  }

  function GutschriftProtokoll()
  {
    $this->GutschriftMenu();
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Set('TABTEXT',"Protokoll");
    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM gutschrift_protokoll WHERE gutschrift='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('TAB1',"Protokoll","noAction");

    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function GutschriftAddPosition()
  {
    $sid = $this->app->Secure->GetGET("sid");
    $id = $this->app->Secure->GetGET("id");
    $menge = $this->app->Secure->GetGET("menge");
    $datum  = $this->app->Secure->GetGET("datum");
    $datum  = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1");
    $this->app->erp->AddGutschriftPosition($id, $sid,$menge,$datum);
    $this->app->erp->GutschriftNeuberechnen($id);
    header("Location: index.php?module=gutschrift&action=positionen&id=$id");
    exit;

  }

  function GutschriftInlinePDF()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->GutschriftNeuberechnen($id);
    $projekt = $this->app->DB->Select("SELECT projekt FROM gutschrift WHERE id='$id' LIMIT 1");

    $frame = $this->app->Secure->GetGET("frame");

    if($frame=="")
    {
      $Brief = new GutschriftPDF($this->app,$projekt);
      $Brief->GetGutschrift($id);
      $Brief->inlineDocument();
    } else {
      $file = urlencode("../../../../index.php?module=gutschrift&action=inlinepdf&id=$id");
      echo "<iframe width=\"100%\" height=\"600\" src=\"./js/production/generic/web/viewer.html?file=$file\" frameborder=\"0\"></iframe>";
      exit;
    }
  }


  function GutschriftPDF()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->GutschriftNeuberechnen($id);

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM gutschrift WHERE id='$id' LIMIT 1");

    //    if(is_numeric($belegnr) && $belegnr!=0)
    {
      $Brief = new GutschriftPDF($this->app,$projekt);
      $Brief->GetGutschrift($id);
      $Brief->displayDocument(); 
    }// else
    // $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Noch nicht freigegebene Gutschriften k&ouml;nnen nicht als PDF betrachtet werden.!</div>");


    $this->GutschriftList();
  }


  function GutschriftMenu()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM gutschrift WHERE id='$id' LIMIT 1");

    if($belegnr=="0" || $belegnr=="") $belegnr ="(Entwurf)";

    //    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Gutschrift $belegnr");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT2',"$name Gutschrift $belegnr");

    $this->app->erp->GutschriftNeuberechnen($id);

    // status bestell
    $status = $this->app->DB->Select("SELECT status FROM gutschrift WHERE id='$id' LIMIT 1");


    if ($status=="angelegt")
    {
      $this->app->erp->MenuEintrag("index.php?module=gutschrift&action=freigabe&id=$id","Freigabe");
    }

    $this->app->erp->MenuEintrag("index.php?module=gutschrift&action=edit&id=$id","Details");
    $this->app->erp->MenuEintrag("index.php?module=gutschrift&action=dateien&id=$id","Dateien");
    $this->app->erp->MenuEintrag("index.php?module=gutschrift&action=zahlungsmahnungswesen&id=$id","Zahlung-/Mahnwesen");
    //$this->app->Tpl->Add('TABS',"<li><a href=\"index.php?module=gutschrift&action=positionen&id=$id\">Positionen</a></li>");


    if($status=='bestellt')
    { 
      //$this->app->Tpl->Add('TABS',"<li><a href=\"index.php?module=gutschrift&action=wareneingang&id=$id\">Wareneingang<br>R&uuml;ckst&auml;nde</a></li>");
      //$this->app->Tpl->Add('TABS',"<li><a class=\"tab\" href=\"index.php?module=gutschrift&action=wareneingang&id=$id\">Mahnstufen</a></li>");
    } 
    //    $this->app->erp->MenuEintrag("index.php?module=gutschrift&action=abschicken&id=$id","Abschicken / Protokoll");
    //$this->app->Tpl->Add('TABS',"<li><a href=\"index.php?module=gutschrift&action=protokoll&id=$id\">Protokoll</a></li>");


    $this->app->erp->MenuEintrag("index.php?module=gutschrift&action=list","Zur&uuml;ck zur &Uuml;bersicht");

  }


  function GutschriftPositionen()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->GutschriftNeuberechnen($id);
    $this->app->YUI->AARLGPositionen(false);
    return;

    $this->GutschriftMenu();

    $this->app->erp->GutschriftNeuberechnen($id);

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


    $gutschriftsart = $this->app->DB->Select("SELECT gutschriftsart FROM gutschrift WHERE id='$id' LIMIT 1");
    $lieferant  = $this->app->DB->Select("SELECT adresse FROM gutschrift WHERE id='$id' LIMIT 1");

    $anlegen_artikelneu = $this->app->Secure->GetPOST("anlegen_artikelneu");

    if($anlegen_artikelneu!="")
    {

      if($bezeichnung!="" && $menge!="" && $preis!="")
      {
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM gutschrift_position WHERE gutschrift='$id' LIMIT 1");
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

        $this->app->DB->Insert("INSERT INTO gutschrift_position (id,gutschrift,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
            VALUES ('','$id','$artikel_id','$bezeichnung','$bestellnummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuerklasse','angelegt','$projekt','$vpe')");

        header("Location: index.php?module=gutschrift&action=positionen&id=$id");
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
      $sort = $this->app->DB->Select("SELECT MAX(sort) FROM gutschrift_position WHERE gutschrift='$id' LIMIT 1");
      $sort = $sort + 1;
      $artikel_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' LIMIT 1");
      $bezeichnung = $artikel;
      $neue_nummer = $nummer;
      $waehrung = 'EUR';
      $umsatzsteuerklasse = $this->app->DB->Select("SELECT umsatzsteuerklasse FROM artikel WHERE nummer='$nummer' LIMIT 1");
      $vpe = 'einzeln';

      $this->app->DB->Insert("INSERT INTO gutschrift_position (id,gutschrift,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
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
      $this->app->Tpl->Parse('INHALT',"gutschrift_artikelneu.tpl");
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
          onclick=\"document.location.href='index.php?module=gutschrift&action=addposition&id=$id&sid=%value%&menge=' + document.getElementById('menge%value%').value;\" value=\"anlegen\">");
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
          onclick=\"document.location.href='index.php?module=gutschrift&action=addposition&id=$id&sid=%value%&menge=' + document.getElementById('menge%value%').value;\" value=\"anlegen\">");
      $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
      $this->app->Tpl->Set('INHALT',"");


      // child table einfuegen

      $this->app->Tpl->Set('SUBSUBHEADING',"Positionen");
      $menu = array("up"=>"upgutschriftposition",
          "down"=>"downgutschriftposition",
          //"add"=>"addstueckliste",
          "edit"=>"positioneneditpopup",
          "del"=>"delgutschriftposition");

      $sql = "SELECT a.name_de as Artikel, p.abkuerzung as projekt, a.nummer as nummer, 
        DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, b.preis as preis, b.id as id
        FROM gutschrift_position b
        LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
        WHERE b.gutschrift='$id'";

      $this->app->Tpl->Add('EXTEND',"<input type=\"submit\" value=\"Gleiche Positionen zusammenf&uuml;gen\">");

      $this->app->YUI->SortListAdd('INHALT',$this,$menu,$sql);
      $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

      if($anlegen_artikelneu!="")
        $this->app->Tpl->Set('AKTIV_TAB2',"selected");
      else
        $this->app->Tpl->Set('AKTIV_TAB1',"selected");
      $this->app->Tpl->Parse('PAGE',"gutschrift_positionuebersicht.tpl");
    } 
  }

  function DelGutschriftPosition()
  {
    $this->app->YUI->SortListEvent("del","gutschrift_position","gutschrift");
    $this->GutschriftPositionen();
  }

  function UpGutschriftPosition()
  {
    $this->app->YUI->SortListEvent("up","gutschrift_position","gutschrift");
    $this->GutschriftPositionen();
  }

  function DownGutschriftPosition()
  {
    $this->app->YUI->SortListEvent("down","gutschrift_position","gutschrift");
    $this->GutschriftPositionen();
  }


  function GutschriftPositionenEditPopup()
  {
    $id = $this->app->Secure->GetGET("id");

    // nach page inhalt des dialogs ausgeben
    $widget = new WidgetGutschrift_position($this->app,'PAGE');
    $sid= $this->app->DB->Select("SELECT gutschrift FROM gutschrift_position WHERE id='$id' LIMIT 1");
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=gutschrift&action=positionen&id=$sid");
    $widget->Edit();
    $this->app->BuildNavigation=false;
  }


  function GutschriftEdit()
  {
    $action = $this->app->Secure->GetGET("action");
    $id = $this->app->Secure->GetGET("id");

    // zum aendern vom Vertrieb
    $sid = $this->app->Secure->GetGET("sid");
    $cmd = $this->app->Secure->GetGET("cmd");
    if($this->app->erp->VertriebAendern("gutschrift",$id,$cmd,$sid))
      return;

    if($this->app->erp->Firmendaten("modul_verband")!="1")
    {
      $this->app->Tpl->Set('VERBANDSTART',"<!--");
      $this->app->Tpl->Set('VERBANDENDE',"-->");
    }


    if($this->app->erp->DisableModul("gutschrift",$id))
    {
      //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","Zur&uuml;ck zur &Uuml;bersicht");
      $this->GutschriftMenu();
      return;
    }

    $adresse = $this->app->DB->Select("SELECT adresse FROM gutschrift WHERE id='$id' LIMIT 1");
    if($adresse <=0)
    {
      $this->app->Tpl->Add('JAVASCRIPT','$(document).ready(function() { if(document.getElementById("adresse"))document.getElementById("adresse").focus(); });');
      $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Achtung! Dieses Dokument ist mit keiner Kunden-Nr. verlinkt. Bitte geben Sie die Kundennummer an und klicken Sie &uuml;bernehmen oder Speichern!</div>");
    }

    $this->app->YUI->AARLGPositionen();

    $this->app->erp->CheckBearbeiter($id,"gutschrift");
    $this->app->erp->CheckBuchhaltung($id,"gutschrift");


    $this->app->erp->GutschriftNeuberechnen($id);

    $this->app->erp->DisableVerband();

    //$this->GutschriftMiniDetail(MINIDETAIL,false);
    $this->app->Tpl->Set('ICONMENU',$this->GutschriftIconMenu($id));
    $this->app->Tpl->Set('ICONMENU2',$this->GutschriftIconMenu($id,2));


    $belegnr = $this->app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='$id' LIMIT 1");
    $nummer = $this->app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM gutschrift WHERE id='$id' LIMIT 1");
    $adresse = $this->app->DB->Select("SELECT adresse FROM gutschrift WHERE id='$id' LIMIT 1");
    


    $status= $this->app->DB->Select("SELECT status FROM gutschrift WHERE id='$id' LIMIT 1");
    $schreibschutz= $this->app->DB->Select("SELECT schreibschutz FROM gutschrift WHERE id='$id' LIMIT 1");

    if($status != "angelegt" && $status != "angelegta" && $status != "a")
    {
      $Brief = new Briefpapier($this->app);
      if($Brief->zuArchivieren($id, "gutschrift"))$this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Die Gutschrift ist noch nicht archiviert! Bitte versenden oder manuell archivieren. <input type=\"button\" onclick=\"if(!confirm('Soll das Dokument archiviert werden?')) return false;else window.location.href='index.php?module=gutschrift&action=archivierepdf&id=$id';\" value=\"Manuell archivieren\" /></div>");
    }
    
    if($schreibschutz!="1" && $this->app->erp->RechteVorhanden("gutschrift","schreibschutz"))
      $this->app->erp->AnsprechpartnerButton($adresse);


    if($nummer!="")
    {
      $this->app->Tpl->Set('NUMMER',$nummer);
      $this->app->Tpl->Set('KUNDE',"&nbsp;&nbsp;&nbsp;Kd-Nr.".$kundennummer);
    }

    $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM gutschrift WHERE id='$id' LIMIT 1");
    if($this->app->Secure->GetPOST("zahlungsweise")!="") $zahlungsweise = $this->app->Secure->GetPOST("zahlungsweise");
    $zahlungsweise = strtolower($zahlungsweise);
    $this->app->Tpl->Set('RECHNUNG',"none");
    $this->app->Tpl->Set('UEBERWEISUNG',"none");
    $this->app->Tpl->Set('KREDITKARTE',"none");
    $this->app->Tpl->Set('VORKASSE',"none");
    $this->app->Tpl->Set('PAYPAL',"none");
    $this->app->Tpl->Set('EINZUGSERMAECHTIGUNG',"none");
    if($zahlungsweise=="rechnung") $this->app->Tpl->Set('RECHNUNG',"");
    if($zahlungsweise=="paypal") $this->app->Tpl->Set('PAYPAL',"");
    if($zahlungsweise=="ueberweisung") $this->app->Tpl->Set('UEBERWEISUNG',"");
    if($zahlungsweise=="kreditkarte") $this->app->Tpl->Set('KREDITKARTE',"");
    if($zahlungsweise=="einzugsermaechtigung" || $zahlungsweise=="lastschrift") $this->app->Tpl->Set('EINZUGSERMAECHTIGUNG',"");
    if($zahlungsweise=="vorkasse" || $zahlungsweise=="kreditkarte" || $zahlungsweise=="paypal" || $zahlungsweise=="bar") $this->app->Tpl->Set('VORKASSE',"");



    if($schreibschutz=="1" && $this->app->erp->RechteVorhanden("gutschrift","schreibschutz"))
    {
      $this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">Diese Gutschrift wurde bereits versendet und darf daher nicht mehr bearbeitet werden!&nbsp;<input type=\"button\" value=\"Schreibschutz entfernen\" onclick=\"if(!confirm('Soll der Schreibschutz f&uuml;r diese Gutschrift wirklich entfernt werden?')) return false;else window.location.href='index.php?module=gutschrift&action=schreibschutz&id=$id';\"></div>");
      //      $this->app->erp->CommonReadonly();
    }

    if($schreibschutz=="1")
      $this->app->erp->CommonReadonly();

    $rechnungid = $this->app->DB->Select("SELECT rechnungid FROM gutschrift WHERE id='$id' LIMIT 1");
    $rechnungid = $this->app->DB->Select("SELECT id FROM rechnung WHERE id='$rechnungid' AND belegnr!='' LIMIT 1");
    $alle_gutschriften = $this->app->DB->SelectArr("SELECT id,belegnr FROM gutschrift WHERE rechnungid='$rechnungid' AND rechnungid>0");

    if(count($alle_gutschriften) > 1)
    {
      for($agi=0;$agi<count($alle_gutschriften);$agi++)
        $gutschriften .= "<a href=\"index.php?module=gutschrift&action=edit&id=".$alle_gutschriften[$agi][id]."\" target=\"_blank\">".$alle_gutschriften[$agi][belegnr]."</a> ";
      $this->app->Tpl->Add('MESSAGE',"<div class=\"error\">F&uuml;r die angebene Rechnung gibt es schon folgende Gutschriften: $gutschriften</div>");
    }


    //    if($status=="versendet")
    //      $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Diese Gutschrift wurde bereits versendet und darf daher nicht mehr bearbeitet werden!</div>");

    if($status=="")
      $this->app->DB->Update("UPDATE gutschrift SET status='angelegt' WHERE id='$id' LIMIT 1");

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
        $this->app->erp->LoadGutschriftStandardwerte($id,$adresse);
        $this->app->erp->GutschriftNeuberechnen($id);
        header("Location: index.php?module=gutschrift&action=edit&id=$id");
        exit;
      }
    }

    // optional rechnungen als bezahlt markieren wenn es jetzt gutschriften gibt

    $land = $this->app->DB->Select("SELECT land FROM gutschrift WHERE id='$id' LIMIT 1");
    $ustid = $this->app->DB->Select("SELECT ustid FROM gutschrift WHERE id='$id' LIMIT 1");
    $ust_befreit = $this->app->DB->Select("SELECT ust_befreit FROM gutschrift WHERE id='$id' LIMIT 1");
    if($ust_befreit)$this->app->Tpl->Set('USTBEFREIT',"<div class=\"info\">EU-Lieferung <br>(bereits gepr&uuml;ft!)</div>");
    else if($land!="DE" && $ustid!="") $this->app->Tpl->Set('USTBEFREIT',"<div class=\"error\">EU-Lieferung <br>(Fehler bei Pr&uuml;fung!)</div>");


    // easy table mit arbeitspaketen YUI als template 
    $table = new EasyTable($this->app);
    $table->Query("SELECT bezeichnung as artikel, nummer as Nummer, menge, vpe as VPE, FORMAT(preis,4) as preis
        FROM gutschrift_position
        WHERE gutschrift='$id'");
    $table->DisplayNew('POSITIONEN',"Preis","noAction");
    /*
       $table->Query("SELECT nummer as Nummer, menge,vpe as VPE, FORMAT(preis,4) as preis, FORMAT(menge*preis,4) as gesamt
       FROM gutschrift_position
       WHERE gutschrift='$id'");
       $table->DisplayNew(POSITIONEN,"Preis","noAction");
     */
    $summe = $this->app->DB->Select("SELECT FORMAT(SUM(menge*preis),2) FROM gutschrift_position
        WHERE gutschrift='$id'");
    $waehrung = $this->app->DB->Select("SELECT waehrung FROM gutschrift_position
        WHERE gutschrift='$id' LIMIT 1");

    if($summe > 0)
      $this->app->Tpl->Add('POSITIONEN', "<br><center>Gesamtsumme: <b>$summe $waehrung</b>&nbsp;&nbsp;
          <a href=\"index.php?module=buchhaltung&action=preview&frame=false\" onclick=\"makeRequest(this);return false\"><img src=\"./themes/new/images/money_preview.png\" border=\"0\"></a></center>");

    $status= $this->app->DB->Select("SELECT status FROM gutschrift WHERE id='$id' LIMIT 1");
    //    $this->app->Tpl->Set(STATUS,"<input type=\"text\" size=\"30\" value=\"".$status."\" readonly>");
    $this->app->Tpl->Set('STATUS',"<input type=\"text\" size=\"30\" value=\"".$status."\" readonly [COMMONREADONLYINPUT]>");


    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    parent::GutschriftEdit();

    $this->app->erp->MessageHandlerStandardForm();


    if($this->app->Secure->GetPOST("weiter")!="")
    {
      header("Location: index.php?module=gutschrift&action=positionen&id=$id");
      exit;
    }
    $this->GutschriftMenu();

  }

  function GutschriftCreate()
  {
    //    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Gutschrift");
    $this->app->erp->MenuEintrag("index.php?module=gutschrift&action=list","Zur&uuml;ck zur &Uuml;bersicht");

    $anlegen = $this->app->Secure->GetGET("anlegen");

    if($this->app->erp->Firmendaten("schnellanlegen")=="1" && $anlegen!="1")
    {
      header("Location: index.php?module=gutschrift&action=create&anlegen=1");
      exit;
    }

    if($anlegen != "")
    {
      $id = $this->app->erp->CreateGutschrift();
      $this->app->erp->GutschriftProtokoll($id,"Gutschrift angelegt");
      header("Location: index.php?module=gutschrift&action=edit&id=$id");
      exit;
    }
    $this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">M&ouml;chten Sie eine Gutschrift jetzt anlegen? &nbsp;
        <input type=\"button\" onclick=\"window.location.href='index.php?module=gutschrift&action=create&anlegen=1'\" value=\"Ja - Gutschrift jetzt anlegen\"></div><br>");
    $this->app->Tpl->Set('TAB1',"
        <table width=\"100%\" style=\"background-color: #fff; border: solid 1px #000;\" align=\"center\">
        <tr>
        <td align=\"center\">
        <br><b style=\"font-size: 14pt\">Gutschriften in Bearbeitung</b>
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
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(datum,'%d.%m.%y') as vom, if(belegnr!='',belegnr,'ohne Nummer') as beleg, name, status, id
        FROM gutschrift WHERE status='angelegt' order by datum DESC, id DESC");
    $table->DisplayNew('AUFTRAGE', "<a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=gutschrift&action=delete&id=%value%';\">
        <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=gutschrift&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        ");


    $this->app->Tpl->Set('TABTEXT',"Gutschrift anlegen");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");

    //parent::GutschriftCreate();
  }


  function GutschriftList()
  {
    $this->app->Tpl->Set('UEBERSCHRIFT',"Gutschriften");


    $backurl = $this->app->Secure->GetGET("backurl");
    $backurl = $this->app->erp->base64_url_decode($backurl);


    //    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Gutschriften");
    $this->app->erp->MenuEintrag("index.php?module=gutschrift&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=gutschrift&action=create","Neue Gutschrift anlegen");

    if(strlen($backurl)>5)
      $this->app->erp->MenuEintrag("$backurl","Zur&uuml;ck zur &Uuml;bersicht");
    else
      $this->app->erp->MenuEintrag("index.php","Zur&uuml;ck zur &Uuml;bersicht");

    $zahlungsweisen = $this->app->DB->SelectArr('
      SELECT
        zahlungsweise
      FROM
        gutschrift
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
        gutschrift
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
        gutschrift
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

    $this->app->YUI->DatePicker("datumVon");
    $this->app->YUI->DatePicker("datumBis");
    $this->app->YUI->AutoComplete("projekt", "projektname", 1);
    $this->app->YUI->AutoComplete("kundennummer", "kunde", 1);
    $this->app->YUI->AutoComplete("gutschriftnummer", "gutschrift", 1);
    // $this->app->YUI->AutoComplete("name", "adressename", 1);

    $this->app->Tpl->Add('ZAHLUNGSWEISEN',$zahlungsweiseStr);
    $this->app->Tpl->Add('STATUS',$statusStr);
    $this->app->Tpl->Add('VERSANDARTEN',$versandartenStr);
    $this->app->Tpl->Add('LAENDER',$laenderStr);
    $this->app->Tpl->Parse('TAB1',"gutschrift_table_filter.tpl");




    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->Tpl->Set('INHALT',"");

    $this->app->YUI->TableSearch('TAB2',"gutschriftenoffene");
    $this->app->YUI->TableSearch('TAB1',"gutschriften");
    $this->app->YUI->TableSearch('TAB3',"gutschrifteninbearbeitung");


    $this->app->Tpl->Parse('PAGE',"gutschriftuebersicht.tpl");

    return;

    $this->app->Tpl->Add('TABS',"<li><h2 class=\"allgemein\">Allgemein</h2></li>");
    $this->app->Tpl->Add('TABS',"<li><a  href=\"index.php?module=gutschrift&action=create\">Neue Gutschrift anlegen</a></li>");
    $this->app->Tpl->Add('TABS',"<li><a  href=\"index.php?module=gutschrift&action=search\">Gutschrift Suchen</a></li>");
    $this->app->Tpl->Add('TABS',"<li><a  href=\"index.php?module=gutschrift&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");
    $this->app->Tpl->Add('TABS',"<li><br><br></li>");



    // nicht versendete Gutschriften
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.soll as betrag,if(r.zahlungsstatus='bezahlt',r.zahlungsstatus,'offen') as status ,r.id
        FROM gutschrift r, projekt p WHERE r.versendet=0 AND status='freigegeben' AND p.id=r.projekt order by r.datum DESC, r.id DESC");

    $table->DisplayNew('INHALT',"<a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich stornieren?')) return false; else window.location.href='index.php?module=gutschrift&action=storno&id=%value%';\">
        <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>

        ");
    $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
    $this->app->Tpl->Set('INHALT',"");

    // offene Gutschriften
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.soll as betrag, r.ist as ist, r.zahlungsstatus, r.id
        FROM gutschrift r, projekt p WHERE r.zahlungsstatus!='bezahlt' AND r.belegnr!='' AND p.id=r.projekt order by r.datum DESC, r.id DESC");
    $table->DisplayNew('INHALT',"<a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich stornieren?')) return false; else window.location.href='index.php?module=gutschrift&action=storno&id=%value%';\">
        <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>

        ");
    /*
       $table->DisplayOwn(INHALT, "<a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
       <a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
       <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=gutschrift&action=copy&id=%value%';\">
       <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
       ",30,"mid");
     */
    $this->app->Tpl->Parse('TAB2',"rahmen70.tpl");

    $this->app->Tpl->Set('INHALT',"");

    // Archiv 
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.soll as betrag, status, r.id
        FROM gutschrift r, projekt p WHERE zahlungsstatus='bezahlt' AND r.belegnr!='' AND p.id=r.projekt order by r.datum DESC, r.id DESC");
    $table->DisplayNew('INHALT',"<a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=gutschrift&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        ");
    $this->app->Tpl->Parse('TAB3',"rahmen70.tpl");
    $this->app->Tpl->Set('INHALT',"");

    // Stornierte
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.soll as betrag, status, r.id
        FROM gutschrift r, projekt p WHERE r.status='storniert' AND p.id=r.projekt order by r.datum DESC, r.id DESC");
    $table->DisplayNew('INHALT',"<a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=gutschrift&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        ");
    $this->app->Tpl->Parse('TAB4',"rahmen70.tpl");
    $this->app->Tpl->Set('INHALT',"");

    // In Bearbeitung
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(r.datum,'%d.%m.%Y') as vom, if(r.belegnr!='',r.belegnr,'ohne Nummer') as beleg, r.name, p.abkuerzung as projekt, r.soll as betrag, r.id
        FROM gutschrift r, projekt p WHERE r.versendet=0 AND status='angelegt' AND p.id=r.projekt order by r.datum DESC, r.id DESC");

    $table->DisplayNew('INHALT', "<a href=\"index.php?module=gutschrift&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=gutschrift&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=gutschrift&action=delete&id=%value%';\">
        <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=gutschrift&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        ");
    $this->app->Tpl->Parse('TAB5',"rahmen70.tpl");

    //    if($this->app->DB->Select("SELECT SUM(id) FROM gutschrift WHERE versendet=0")==0)
    //      $this->app->Tpl->Set(TAB1,"<div class=\"info\">Es sind keine nicht versendeten Gutschriften in Arbeit!</div>");


    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->Tpl->Parse('PAGE',"gutschriftuebersicht.tpl");

    /*
       $this->app->Tpl->Set(TAB2,"lieferant, gutschrift, waehrung, sprache, liefertermin, steuersatz, einkäufer, freigabe<br>
       <br>Gutschrift (NR),Bestellart (NB), Bestelldatum
       <br>Projekt
       <br>Kostenstelle pro Position
       <br>Termingutschrift (am xx.xx.xxxx raus damit)
       <br>vorschlagsdaten für positionen
       <br>proposition reinklicken zum ändern und reihenfolge tabelle 
       <br>Gutschrift muss werden wie gutschrift (gutschrift beschreibung = allgemein)
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
