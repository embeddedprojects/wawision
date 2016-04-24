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
include ("_gen/lieferschein.php");

class Lieferschein extends GenLieferschein
{

  function Lieferschein(&$app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","LieferscheinList");
    $this->app->ActionHandler("create","LieferscheinCreate");
    $this->app->ActionHandler("positionen","LieferscheinPositionen");
    $this->app->ActionHandler("addposition","LieferscheinAddPosition");
    $this->app->ActionHandler("uplieferscheinposition","UpLieferscheinPosition");
    $this->app->ActionHandler("dellieferscheinposition","DelLieferscheinPosition");
    $this->app->ActionHandler("downlieferscheinposition","DownLieferscheinPosition");
    $this->app->ActionHandler("positioneneditpopup","LieferscheinPositionenEditPopup");
    $this->app->ActionHandler("edit","LieferscheinEdit");
    $this->app->ActionHandler("copy","LieferscheinCopy");
    $this->app->ActionHandler("delete","LieferscheinDelete");
    $this->app->ActionHandler("freigabe","LieferscheinFreigabe");
    $this->app->ActionHandler("abschicken","LieferscheinAbschicken");
    $this->app->ActionHandler("abschliessen","LieferscheinAbschliessen");
    $this->app->ActionHandler("auslagern","LieferscheinAuslagern");
    $this->app->ActionHandler("pdf","LieferscheinPDF");
    $this->app->ActionHandler("inlinepdf","LieferscheinInlinePDF");
    $this->app->ActionHandler("protokoll","LieferscheinProtokoll");
    $this->app->ActionHandler("minidetail","LieferscheinMiniDetail");
    $this->app->ActionHandler("editable","LieferscheinEditable");
    $this->app->ActionHandler("livetabelle","LieferscheinLiveTabelle");
    $this->app->ActionHandler("schreibschutz","LieferscheinSchreibschutz");
    $this->app->ActionHandler("positionenetiketten","LieferscheinPositionenEtiketten");
    $this->app->ActionHandler("pdffromarchive","LieferscheinPDFfromArchiv");
    $this->app->ActionHandler("archivierepdf","LieferscheinArchivierePDF");

    $this->app->DefaultActionHandler("list");

    $id = $this->app->Secure->GetGET("id");
    $nummer = $this->app->Secure->GetPOST("adresse");

    if($nummer=="")
      $adresse= $this->app->DB->Select("SELECT a.name FROM lieferschein b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    else
      $adresse = $nummer;

    $nummer = $this->app->DB->Select("SELECT b.belegnr FROM lieferschein b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    if($nummer=="" || $nummer==0) $nummer="ohne Nummer";

    $this->app->Tpl->Set('UEBERSCHRIFT',"Lieferschein:&nbsp;".$adresse." (".$nummer.")");
    $this->app->Tpl->Set('FARBE',"[FARBE3]");


    $this->app->ActionHandlerListen($app);
  }

  function LieferscheinArchivierePDF()
  {
    $id = (int)$this->app->Secure->GetGET('id');
    $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id = '$id' LIMIT 1");
    $Brief = new LieferscheinPDF($this->app, $projekt);
    $Brief->GetLieferschein($id);
    $tmpfile = $Brief->displayTMP();
    $Brief->ArchiviereDocument();
    $this->app->DB->Update("UPDATE lieferschein SET schreibschutz='1' WHERE id='$id'");
    header('Location: index.php?module=lieferschein&action=edit&id='.$id);
    exit;
  }
  
  
  function LieferscheinAbschliessen()  {    

    $id = $this->app->Secure->GetGET("id");

    if($id > 0)
    {
      $this->app->DB->Update("UPDATE lieferschein SET status='abgeschlossen' WHERE id='$id' LIMIT 1");
      $this->app->erp->LieferscheinProtokoll($id,"Lieferschein abgeschlossen");
    }
    $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Der Lieferschein wurde als abgeschlossen markiert!</div>");
    header("Location: index.php?module=lieferschein&action=list&msg=$msg");
    exit;
  }
  
  function LieferscheinAuslagern()
  {
    $id = (int)$this->app->Secure->GetGET("id");

    if($id > 0)
    {
      $this->app->erp->LieferscheinAuslagern($id);
      $this->app->erp->LieferscheinProtokoll($id,"Lieferschein ausgelagert");
    }
    $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Der Lieferschein wurde ausgelagert!</div>");
    header("Location: index.php?module=lieferschein&action=edit&id=$id&msg=$msg");
    exit;
  }

  
  function LieferscheinEditable()
  { 
    $this->app->YUI->AARLGEditable();
  }

  function LieferscheinSchreibschutz()
  {

    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE lieferschein SET zuarchivieren='1' WHERE id='$id'");
    $this->app->DB->Update("UPDATE lieferschein SET schreibschutz='0' WHERE id='$id'");
    header("Location: index.php?module=lieferschein&action=edit&id=$id");
    exit;

  }


  function LieferscheinLiveTabelle()
  { 
    $id = $this->app->Secure->GetGET("id");
    $status = $this->app->DB->Select("SELECT status FROM lieferschein WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);

    if($status=="freigegeben")
    {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, ap.menge as M,
          if(a.porto,'-',if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel) > ap.menge,(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),
              if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel)>0,CONCAT('<font color=red><b>',(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),'</b></font>'),
                if(a.lagerartikel=1,'<font color=red><b>aus</b></font>','kein Lagerartikel' ))) as L
          FROM lieferschein_position ap, artikel a WHERE ap.lieferschein='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","A","noAction");
    } else {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, ap.menge as M
          FROM lieferschein_position ap, artikel a WHERE ap.lieferschein='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","Menge","noAction");
    }
    echo $artikel;
    exit;
  }

  function LieferscheinCopy()
  {
    $id = $this->app->Secure->GetGET("id");

    $newid = $this->app->erp->CopyLieferschein($id);

    header("Location: index.php?module=lieferschein&action=edit&id=$newid");
    exit;
  }

  function LieferscheinIconMenu($id,$prefix="")
  {
    $status = $this->app->DB->Select("SELECT status FROM lieferschein WHERE id='$id' LIMIT 1");
    $lieferantenretoure = $this->app->DB->Select("SELECT lieferantenretoure FROM lieferschein WHERE id='$id' LIMIT 1");

    if($status=="angelegt" || $status=="")
      $freigabe = "<option value=\"freigabe\">Lieferschein freigeben</option>";


    if(($status=="versendet" || $status=="freigegeben") && $lieferantenretoure=="1")
      $abschliessen = "<option value=\"abschliessen\">Lieferschein abschliessen</option>";

    $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$id' LIMIT 1");
    $auslagern = '';
    $erneut = '';
    $projektkommissionierverfahren = $this->app->DB->Select("SELECT kommissionierverfahren FROM projekt where id = '$projekt'");
    if($projekt && ($projektkommissionierverfahren = "" || $projektkommissionierverfahren = "rechnungsmail" || $projektkommissionierverfahren == "lieferschein" || $projektkommissionierverfahren == "lieferscheinscan"))
    {
      $auslagern = '<option value="auslagern">Lieferschein auslagern</option>';
      $mengegeliefert = $this->app->DB->Select("SELECT sum(geliefert) from lieferschein_position where lieferschein = '$id'");
      if($mengegeliefert)$erneut = " erneut";
    }
    
    $etiketten_positionen = $this->app->DB->Select("SELECT etiketten_positionen FROM projekt WHERE id='$projekt' LIMIT 1");
    if($etiketten_positionen  > 0)
      $etiketten = "<option value=\"positionenetiketten\">Positionen als Etiketten</option>";

    $menu ="
      <script type=\"text/javascript\">
      function onchangelieferschein(cmd)
      {
        switch(cmd)
        {
          case 'storno': if(!confirm('Wirklich stornieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=lieferschein&action=delete&id=%value%'; break;
          case 'copy': if(!confirm('Wirklich kopieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=lieferschein&action=copy&id=%value%'; break;
          case 'pdf': window.location.href='index.php?module=lieferschein&action=pdf&id=%value%'; document.getElementById('aktion$prefix').selectedIndex = 0; break;
          case 'positionenetiketten': window.location.href='index.php?module=lieferschein&action=positionenetiketten&id=%value%'; document.getElementById('aktion$prefix').selectedIndex = 0; break;
          case 'abschicken':  ".$this->app->erp->DokumentAbschickenPopup()." break;
          case 'freigabe': window.location.href='index.php?module=lieferschein&action=freigabe&id=%value%';  break;
          case 'abschliessen': if(!confirm('Wirklich abschliessen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=lieferschein&action=abschliessen&id=%value%'; break;
          case 'auslagern': if(!confirm('Wirklich$erneut auslagern?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=lieferschein&action=auslagern&id=%value%'; break;
        }

      }
    </script>

      &nbsp;Aktion:&nbsp;<select id=\"aktion$prefix\" onchange=\"onchangelieferschein(this.value)\"> 
      <option>bitte w&auml;hlen ...</option>
      <option value=\"storno\">Lieferschein stornieren</option>
      <option value=\"copy\">Lieferschein kopieren</option>
      $freigabe
      <option value=\"abschicken\">Lieferschein abschicken</option>
      $abschliessen
      $auslagern
      <option value=\"pdf\">PDF &ouml;ffnen</option>
      $etiketten
      
      </select>&nbsp;

    <a href=\"index.php?module=lieferschein&action=pdf&id=%value%\" title=\"PDF\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
      <!--        <a href=\"index.php?module=lieferschein&action=edit&id=%value%\" title=\"Bearbeiten\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
      <a onclick=\"if(!confirm('Wirklich stornieren?')) return false; else window.location.href='index.php?module=lieferschein&action=delete&id=%value%';\" title=\"Stornieren\">
      <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
      <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=lieferschein&action=copy&id=%value%';\" title=\"Kopieren\">
      <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>-->";

    //$tracking = $this->AuftragTrackingTabelle($id);

    $menu = str_replace('%value%',$id,$menu);
    return $menu;
  }
  
  function LieferscheinPDFfromArchiv()
  {
    $id = $this->app->Secure->GetGET("id");
    $archiv = $this->app->DB->Select("SELECT table_id from pdfarchiv where id = '$id' LIMIT 1");
    if($archiv)
    {
      $projekt = $this->app->DB->Select("SELECT projekt from lieferschein where id = '".(int)$archiv."'");
    }
    if($archiv)$Brief = new LieferscheinPDF($this->app,$projekt);
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

  function LieferscheinMiniDetail($parsetarget="",$menu=true)
  {
    $id = $this->app->Secure->GetGET("id");
    $auftragArr = $this->app->DB->SelectArr("SELECT * FROM lieferschein WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='{$auftragArr[0]['projekt']}' LIMIT 1");
    $kundenname = $this->app->DB->Select("SELECT name FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");

    $lieferantenretoure = $this->app->DB->Select("SELECT lieferantenretoure FROM lieferschein WHERE id='$id' LIMIT 1");
    $lieferantenretoureinfo = $this->app->DB->Select("SELECT lieferantenretoureinfo FROM lieferschein WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('LIEFERANTENRETOUREINFO',$lieferantenretoureinfo);

    if($lieferantenretoure!="1")
    {
      $this->app->Tpl->Set('LIEFERANTENRETOUREINFOSTART',"<!--");
      $this->app->Tpl->Set('LIEFERANTENRETOUREINFOENDE',"<!--");

    }	


    $this->app->Tpl->Set('LIEFERSCHEINID',$id);

    $this->app->Tpl->Set('KUNDE',"<a href=\"index.php?module=adresse&action=edit&id=".$auftragArr[0]['adresse']."\">".$kundennummer."</a> ".$kundenname);
    $this->app->Tpl->Set('PROJEKT',$projekt);
    $this->app->Tpl->Set('ZAHLWEISE',$auftragArr[0]['zahlungsweise']);
    $this->app->Tpl->Set('STATUS',$auftragArr[0]['status']);

    $belegnr_auftrag = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='".$auftragArr[0]['auftragid']."' LIMIT 1");
    $this->app->Tpl->Set(AUFTRAG,"<a href=\"index.php?module=auftrag&action=edit&id=".$auftragArr[0]['auftragid']."\" target=\"_blank\">$belegnr_auftrag</a>");

    if($auftragArr[0]['ust_befreit']==0)
      $this->app->Tpl->Set('STEUER',"Deutschland");
    else if($auftragArr[0]['ust_befreit']==1)
      $this->app->Tpl->Set('STEUER',"EU-Lieferung");
    else
      $this->app->Tpl->Set('STEUER',"Export");


    if($menu)
    {
      $menu = $this->LieferscheinIconMenu($id);
      $this->app->Tpl->Set('MENU',$menu);
    }
    // ARTIKEL

    $status = $this->app->DB->Select("SELECT status FROM lieferschein WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);


    if($status=="freigegeben")
    {
      $table->Query("SELECT if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung) as artikel, CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\">', ap.nummer,'</a>') as Nummer, ap.menge as Menge,
          if(a.porto,'-',if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel) > ap.menge AND a.lagerartikel=1,(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),
              if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel)>0 AND a.lagerartikel=1,CONCAT('<font color=red><b>',(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),'</b></font>'),
                if(a.lagerartikel=1,'<font color=red><b>aus</b></font>','kein Lagerartikel')))) as Lager
          FROM lieferschein_position ap, artikel a WHERE ap.lieferschein='$id' AND a.id=ap.artikel ORDER by ap.sort");
      $artikel = $table->DisplayNew("return","Lager","noAction");

      $this->app->Tpl->Add('JAVASCRIPT',"
          var auto_refresh = setInterval(
            function ()
            {
            $('#artikeltabellelive$id').load('index.php?module=lieferschein&action=livetabelle&id=$id').fadeIn('slow');
            }, 3000); // refresh every 10000 milliseconds
          ");
    } else {
      $table->Query("SELECT if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung) as artikel, CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\">', ap.nummer,'</a>') as Nummer, ap.menge as M
          FROM lieferschein_position ap, artikel a WHERE ap.lieferschein='$id' AND a.id=ap.artikel ORDER by ap.sort");
      $artikel = $table->DisplayNew("return","Menge","noAction");
    }

    $this->app->Tpl->Set('ARTIKEL','<div id="artikeltabellelive'.$id.'">'.$artikel.'</div>');

    if($auftragArr[0]['lieferantenretoure']=="1" && ($auftragArr[0]['status']=="versendet" || $auftragArr[0]['status']=="freigegeben"))
      $this->app->Tpl->Add('ARTIKEL',"<br><center><input type=\"button\" value=\"Lieferschein abschliessen\" onclick=\"window.open('index.php?module=lieferschein&action=abschliessen&id=$id')\"></center>");

    if($auftragArr[0]['belegnr']=="0" || $auftragArr[0]['belegnr']=="") $auftragArr[0]['belegnr'] = "ENTWURF";
    $this->app->Tpl->Set('BELEGNR',$auftragArr[0]['belegnr']);
    $this->app->Tpl->Set('LIEFERSCHEIN',$auftragArr[0]['id']);


    $tracking = $this->app->DB->SelectArr("SELECT 
        if(versandunternehmen='dhl' OR versandunternehmen='intraship',if(tracking!='',CONCAT(UPPER(versandunternehmen),':<a href=\"http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc=',tracking,'\" target=\"_blank\">',tracking,'</a>      <a href=\"index.php?module=auftrag&action=tracking&tracking=',l.id,'_',tracking,'\"><img src=\"./themes/new/images/pdf.png\" title=\"Tracking PDF\" border=\"0\"></a>
              '),'nicht vorhanden'),CONCAT(versandunternehmen,' ',tracking)) as versand2,tracking as tracking2  FROM versand v LEFT JOIN lieferschein l ON v.lieferschein=l.id WHERE l.id='$id'");

    for($counti=0;$counti < count($tracking); $counti++)
      if($tracking[$counti]['tracking2']!="")
        $tmp[]=$tracking[$counti]['versand2'];

    $this->app->Tpl->Set('TRACKING',implode(',',$tmp));

    /*
       if($auftragArr[0]['status']=="freigegeben")
       { 
       $this->app->Tpl->Set(ANGEBOTFARBE,"orange");
       $this->app->Tpl->Set(ANGEBOTTEXT,"Das Angebot wurde noch nicht als Auftrag weitergef&uuml;hrt!");
       }
       else if($auftragArr[0]['status']=="versendet")
       { 
       $this->app->Tpl->Set(ANGEBOTFARBE,"red");
       $this->app->Tpl->Set(ANGEBOTTEXT,"Das Angebot versendet aber noch kein Auftrag vom Kunden erhalten!");
       }
       else if($auftragArr[0]['status']=="beauftragt")
       { 
       $this->app->Tpl->Set(ANGEBOTFARBE,"green");
       $this->app->Tpl->Set(ANGEBOTTEXT,"Das Angebot wurde beauftragt und abgeschlossen!");
       }
       else if($auftragArr[0]['status']=="angelegt")
       { 
       $this->app->Tpl->Set(ANGEBOTFARBE,"grey");
       $this->app->Tpl->Set(ANGEBOTTEXT,"Das Angebot wird bearbeitet und wurde noch nicht freigegeben und abgesendet!");
       }

     */
    $this->app->Tpl->Set('LIEFERADRESSE',$this->Lieferadresse($auftragArr[0]['id']));
    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM lieferschein_protokoll WHERE lieferschein='$id' ORDER by zeit DESC");
    $tmp->DisplayNew(PROTOKOLL,"Protokoll","noAction");

    $Brief = new LieferscheinPDF($this->app,$auftragArr[0]['projekt']);
    
    $Dokumentenliste = $Brief->getArchivedFiles($id, 'lieferschein');
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
          $tmpr['menu'] = '<a href="index.php?module=lieferschein&action=pdffromarchive&id='.$v['id'].'"><img src="themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/pdf.png" /></a>';
          $tmp3->datasets[] = $tmpr;
        }
      }
      
      $tmp3->DisplayNew('PDFARCHIV','Men&uuml;',"noAction");
    }

    if($parsetarget=="")
    { 
      $this->app->Tpl->Output("lieferschein_minidetail.tpl");
      exit;
    }  else {
      $this->app->Tpl->Parse($parsetarget,"lieferschein_minidetail.tpl");
    }
  }



  function LieferscheinFreigabe()
  {
    $id = $this->app->Secure->GetGET("id");
    $freigabe= $this->app->Secure->GetGET("freigabe");
    $this->app->Tpl->Set('TABTEXT',"Freigabe");

    $this->app->erp->CheckVertrieb($id,"lieferschein");
    $this->app->erp->CheckBearbeiter($id,"lieferschein");

    if($freigabe==$id)
    {
      $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$id' LIMIT 1");
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$id' LIMIT 1");
      if($belegnr=="")
      {
        $belegnr = $this->app->erp->GetNextNummer("lieferschein",$projekt);

        $this->app->DB->Update("UPDATE lieferschein SET belegnr='$belegnr', status='freigegeben' WHERE id='$id' LIMIT 1");
        $this->app->erp->LieferscheinProtokoll($id,"Lieferschein freigegeben");
        $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Der Lieferschein wurde freigegeben und kann jetzt versendet werden!</div>");
        header("Location: index.php?module=lieferschein&action=edit&id=$id&msg=$msg");
        exit;
      } else {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Lieferschein wurde bereits freigegeben!</div>");
        header("Location: index.php?module=lieferschein&action=edit&id=$id&msg=$msg");
        exit;
      }
    } else { 

      $name = $this->app->DB->Select("SELECT a.name FROM lieferschein b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
      $summe = $this->app->DB->Select("SELECT FORMAT(SUM(menge*preis),2) FROM lieferschein_position
          WHERE lieferschein='$id'");
      $waehrung = $this->app->DB->Select("SELECT waehrung FROM lieferschein_position
          WHERE lieferschein='$id' LIMIT 1");

      $this->app->Tpl->Set('TAB1',"<div class=\"info\">Soll die Lieferschein an <b>$name</b> im Wert von <b>$summe $waehrung</b> 
          jetzt freigegeben werden? <input type=\"button\" value=\"Jetzt freigeben\" onclick=\"window.location.href='index.php?module=lieferschein&action=freigabe&id=$id&freigabe=$id'\">
          </div>");
    }
    $this->LieferscheinMenu();
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }


  function LieferscheinAbschicken()
  {
    $this->LieferscheinMenu();
    $this->app->erp->DokumentAbschicken();
  }



  function LieferscheinDelete()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM lieferschein WHERE id='$id' LIMIT 1");
    $status = $this->app->DB->Select("SELECT status FROM lieferschein WHERE id='$id' LIMIT 1");

    if($belegnr=="0" || $belegnr=="")
    {
      $this->app->erp->DeleteLieferschein($id);
      $belegnr="ENTWURF";
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Das Lieferschein \"$name\" ($belegnr) wurde gel&ouml;scht!</div>");
      //header("Location: ".$_SERVER['HTTP_REFERER']."&msg=$msg");
      header("Location: index.php?module=lieferschein&action=list&msg=$msg");
      exit;
    } else
    {
      if(0)//$status=="abgeschlossen")
      {
        // KUNDE muss RMA starten                                                                                                                             
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Lieferschein \"$name\" ($belegnr) kann nicht storniert werden da Lieferschein als Auftrag bereits weitergef&uuml;hrt worden ist!</div>");
      }
      else if($status=="storniert")
      {
        $maxbelegnr = $this->app->DB->Select("SELECT MAX(belegnr) FROM lieferschein");
        if(0)//$maxbelegnr == $belegnr)
        {
          $this->app->DB->Delete("DELETE FROM lieferschein_position WHERE lieferschein='$id'");
          $this->app->DB->Delete("DELETE FROM lieferschein_protokoll WHERE lieferschein='$id'");
          $this->app->DB->Delete("DELETE FROM lieferschein WHERE id='$id'");
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Lieferschein \"$name\" ($belegnr) wurde ge&ouml;scht !</div>");
        } else
        {
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Lieferschein \"$name\" ($belegnr) kann nicht storniert werden das sie er bereits storniert ist!</div>");
        }
        header("Location: index.php?module=lieferschein&action=list&msg=$msg");
        exit;
      }
      else {
        $this->app->DB->Update("UPDATE lieferschein SET status='storniert' WHERE id='$id' LIMIT 1");
        $this->app->erp->LieferscheinProtokoll($id,"Lieferschein storniert");
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Das Lieferschein \"$name\" ($belegnr) wurde storniert!</div>"); 
      }
      header("Location: index.php?module=lieferschein&action=list&msg=$msg#tabs-1");
      exit;
    }
  }

  function LieferscheinProtokoll()
  {
    $this->LieferscheinMenu();
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Set('TABTEXT',"Protokoll");
    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM lieferschein_protokoll WHERE lieferschein='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('TAB1',"Protokoll","noAction");

    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function LieferscheinAddPosition()
  {
    $sid = $this->app->Secure->GetGET("sid");
    $id = $this->app->Secure->GetGET("id");
    $menge = $this->app->Secure->GetGET("menge");
    $datum  = $this->app->Secure->GetGET("datum");
    $datum  = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1");
    $this->app->erp->AddLieferscheinPosition($id, $sid,$menge,$datum);
    header("Location: index.php?module=lieferschein&action=positionen&id=$id");
    exit;

  }

  function LieferscheinInlinePDF()
  {
    $id = $this->app->Secure->GetGET("id");
    $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$id' LIMIT 1");
    $schreibschutz = $this->app->DB->Select("SELECT schreibschutz FROM lieferschein WHERE id='$id' LIMIT 1");
    $frame = $this->app->Secure->GetGET("frame");

    if($frame=="")
    {
      $Brief = new LieferscheinPDF($this->app,$projekt);
      $Brief->GetLieferschein($id);
      $Brief->inlineDocument($schreibschutz);
    } else {
      $file = urlencode("../../../../index.php?module=lieferschein&action=inlinepdf&id=$id");
      echo "<iframe width=\"100%\" height=\"600\" src=\"./js/production/generic/web/viewer.html?file=$file\"></iframe>";
      exit;
    }
  }


  function LieferscheinPDF()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$id' LIMIT 1");
    $schreibschutz = $this->app->DB->Select("SELECT schreibschutz FROM lieferschein WHERE id='$id' LIMIT 1");
    //    if(is_numeric($belegnr) && $belegnr!=0)
    {
      $Brief = new LieferscheinPDF($this->app,$projekt);
      $Brief->GetLieferschein($id);
      $Brief->displayDocument($schreibschutz); 
    }// else
    // $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Noch nicht freigegebene Lieferscheinen k&ouml;nnen nicht als PDF betrachtet werden.!</div>");


    $this->LieferscheinList();
  }


  function LieferscheinMenu()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM lieferschein WHERE id='$id' LIMIT 1");

    if($belegnr=="0" || $belegnr=="") $belegnr ="(Entwurf)";
    // $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Lieferschein $belegnr");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT2',"$name Lieferschein $belegnr");




    //    $this->app->erp->MenuEintrag("index.php?module=lieferschein&action=edit&id=$id","Lieferscheindaten");
    //$this->app->Tpl->Add(TABS,"<li><a href=\"index.php?module=lieferschein&action=positionen&id=$id\">Positionen</a></li>");

    // status bestell
    $status = $this->app->DB->Select("SELECT status FROM lieferschein WHERE id='$id' LIMIT 1");

    if ($status=="angelegt")
    {
      $this->app->erp->MenuEintrag("index.php?module=lieferschein&action=freigabe&id=$id","Freigabe");
    }

    $this->app->erp->MenuEintrag("index.php?module=lieferschein&action=edit&id=$id","Details");
    //    $this->app->erp->MenuEintrag("index.php?module=lieferschein&action=abschicken&id=$id","Abschicken / Protokoll");
    //    $this->app->erp->MenuEintrag("index.php?module=lieferschein&action=protokoll&id=$id","Protokoll");
    $this->app->erp->MenuEintrag("index.php?module=lieferschein&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    
  }

  function LieferscheinPositionen()
  {
    $this->app->YUI->AARLGPositionen(false);
    return;

    $this->LieferscheinMenu();
    $id = $this->app->Secure->GetGET("id");


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


    $lieferscheinsart = $this->app->DB->Select("SELECT lieferscheinsart FROM lieferschein WHERE id='$id' LIMIT 1");
    $lieferant  = $this->app->DB->Select("SELECT adresse FROM lieferschein WHERE id='$id' LIMIT 1");

    $anlegen_artikelneu = $this->app->Secure->GetPOST("anlegen_artikelneu");

    if($anlegen_artikelneu!="")
    {

      if($bezeichnung!="" && $menge!="")
      {
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM lieferschein_position WHERE lieferschein='$id' LIMIT 1");
        $sort = $sort + 1;

        $neue_nummer = $this->app->erp->NeueArtikelNummer($artikelart,$this->app->User->GetFirma(),$projekt);

        // anlegen als artikel
        $this->app->DB->InserT("INSERT INTO artikel (id,typ,nummer,projekt,name_de,umsatzsteuer,adresse,firma) 	
            VALUES ('','$artikelart','$neue_nummer','$projekt','$bezeichnung','$umsatzsteuerklasse','$lieferant','".$this->app->User->GetFirma()."')"); 	

          $artikel_id = $this->app->DB->GetInsertID();
        // einkaufspreis anlegen
        //$this->app->DB->Insert("INSERT INTO einkaufspreise (id,artikel,adresse,objekt,projekt,preis,waehrung,ab_menge,vpe,preis_anfrage_vom,bestellnummer,bezeichnunglieferant,bearbeiter)
        //  VALUES ('','$artikel_id','$lieferant','Standard','$projekt','$preis','$waehrung','$menge','$vpe',NOW(),'$bestellnummer','$bezeichnung','".$this->app->User->GetName()."')");

        $lieferdatum = $this->app->String->Convert($lieferdatum,"%1.%2.%3","%3-%2-%1");

        $this->app->DB->Insert("INSERT INTO lieferschein_position (id,lieferschein,artikel,bezeichnung,nummer,menge, sort,lieferdatum, status,projekt,vpe) 
            VALUES ('','$id','$artikel_id','$bezeichnung','$bestellnummer','$menge','$sort','$lieferdatum','angelegt','$projekt','$vpe')");

        header("Location: index.php?module=lieferschein&action=positionen&id=$id");
        exit;
      } else
        $this->app->Tpl->Set('NEUMESSAGE',"<div class=\"error\">Bestellnummer, bezeichnung, Menge und Preis sind Pflichtfelder!</div>");

    }
    $ajaxbuchen = $this->app->Secure->GetPOST("ajaxbuchen");
    if($ajaxbuchen!="")
    {
      $artikel = $this->app->Secure->GetPOST("artikel");
      $nummer = $this->app->Secure->GetPOST("nummer");
      $projekt = $this->app->Secure->GetPOST("projekt");
      $projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
      $sort = $this->app->DB->Select("SELECT MAX(sort) FROM lieferschein_position WHERE lieferschein='$id' LIMIT 1");
      $sort = $sort + 1;
      $artikel_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' LIMIT 1");
      $bezeichnung = $artikel;
      $neue_nummer = $nummer;
      $umsatzsteuerklasse = $this->app->DB->Select("SELECT umsatzsteuerklasse FROM artikel WHERE nummer='$nummer' LIMIT 1");
      $vpe = 'einzeln';

      $this->app->DB->Insert("INSERT INTO lieferschein_position (id,lieferschein,artikel,bezeichnung,nummer,menge, sort,lieferdatum, status,projekt,vpe) 
          VALUES ('','$id','$artikel_id','$bezeichnung','$neue_nummer','$menge','$sort','$lieferdatum','angelegt','$projekt','$vpe')");
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
      $this->app->Tpl->Parse('INHALT',"lieferschein_artikelneu.tpl");
      $this->app->Tpl->Set('EXTEND',"<input type=\"submit\" value=\"Artikel unter Stammdaten anlegen\" name=\"anlegen_artikelneu\">");
      $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
      $this->app->Tpl->Set('EXTEND',"");
      $this->app->Tpl->Set('INHALT',"");


      /* ende neu anlegen formular */


      $this->app->Tpl->Set('SUBSUBHEADING',"Artikel im Zwischenlager");

      $table = new EasyTable($this->app);
      $table->Query("SELECT CONCAT(LEFT(a.name_de,30),'...') as artikel, a.nummer, 
          z.menge as menge, z.vpe, p.abkuerzung as projekt, z.grund as bemerkung,
          CONCAT('<input type=\"text\" size=\"3\" value=\"\" id=\"menge',z.artikel,'\">') as versenden, z.artikel as id
          FROM zwischenlager z LEFT JOIN artikel a ON a.id=z.artikel LEFT JOIN projekt p ON z.projekt=p.id",5);
      $table->DisplayNew('INHALT', "<input type=\"button\" 
          onclick=\"document.location.href='index.php?module=lieferschein&action=addposition&id=$id&sid=%value%&menge=' + document.getElementById('menge%value%').value;\" value=\"anlegen\">");
      $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
      $this->app->Tpl->Set('INHALT',"");


      /* artikel aus lager */
      $this->app->Tpl->Set('SUBSUBHEADING',"Artikel aus Lager");

      $table = new EasyTable($this->app);
      $table->Query("SELECT CONCAT(LEFT(a.name_de,80),'...') as artikel, a.nummer, 
          p.abkuerzung as projekt,
          CONCAT('<input type=\"text\" size=\"3\" value=\"\" id=\"menge',a.id,'\">') as menge, a.id as id
          FROM artikel a LEFT JOIN projekt p ON a.projekt=p.id WHERE a.lagerartikel=1",5);

      $table->DisplayNew('INHALT', "<input type=\"button\" 
          onclick=\"document.location.href='index.php?module=lieferschein&action=addposition&id=$id&sid=%value%&menge=' + document.getElementById('menge%value%').value;\" value=\"anlegen\">");
      $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
      $this->app->Tpl->Set('INHALT',"");


      // child table einfuegen

      $this->app->Tpl->Set('SUBSUBHEADING',"Positionen");
      $menu = array("up"=>"uplieferscheinposition",
          "down"=>"downlieferscheinposition",
          //"add"=>"addstueckliste",
          "edit"=>"positioneneditpopup",
          "del"=>"dellieferscheinposition");

      $sql = "SELECT a.name_de as Artikel, p.abkuerzung as projekt, a.nummer as nummer, 
        DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, '-' as preis, b.id as id
        FROM lieferschein_position b
        LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id
        WHERE b.lieferschein='$id'";

      $this->app->Tpl->Add('EXTEND',"<input type=\"submit\" value=\"Gleiche Positionen zusammenf&uuml;gen\">");

      $this->app->YUI->SortListAdd('INHALT',$this,$menu,$sql);
      $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

      if($anlegen_artikelneu!="")
        $this->app->Tpl->Set('AKTIV_TAB2',"selected");
      else
        $this->app->Tpl->Set('AKTIV_TAB1',"selected");
      $this->app->Tpl->Parse('PAGE',"lieferschein_positionuebersicht.tpl");
    } 
  }

  function DelLieferscheinPosition()
  {
    $this->app->YUI->SortListEvent("del","lieferschein_position","lieferschein");
    $this->LieferscheinPositionen();
  }

  function UpLieferscheinPosition()
  {
    $this->app->YUI->SortListEvent("up","lieferschein_position","lieferschein");
    $this->LieferscheinPositionen();
  }

  function DownLieferscheinPosition()
  {
    $this->app->YUI->SortListEvent("down","lieferschein_position","lieferschein");
    $this->LieferscheinPositionen();
  }


  function LieferscheinPositionenEditPopup()
  {
    $id = $this->app->Secure->GetGET("id");

    // nach page inhalt des dialogs ausgeben
    $widget = new WidgetLieferschein_position($this->app,'PAGE');
    $sid= $this->app->DB->Select("SELECT lieferschein FROM lieferschein_position WHERE id='$id' LIMIT 1");
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=lieferschein&action=positionen&id=$sid");
    $widget->Edit();
    $this->app->BuildNavigation=false;
  }


  function LieferscheinEdit()
  {
    $action = $this->app->Secure->GetGET("action");
    $id = $this->app->Secure->GetGET("id");

    if($this->app->erp->DisableModul("lieferschein",$id))
    {
      //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","Zur&uuml;ck zur &Uuml;bersicht");
      $this->LieferscheinMenu();
      return;
    }



    $this->app->YUI->AARLGPositionen();

    $this->app->erp->CheckVertrieb($id,"lieferschein");
    $this->app->erp->CheckBearbeiter($id,"lieferschein");

    $nummer = $this->app->DB->Select("SELECT belegnr FROM lieferschein WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$id' LIMIT 1");
    $adresse = $this->app->DB->Select("SELECT adresse FROM lieferschein WHERE id='$id' LIMIT 1");
    $lieferant = $this->app->DB->Select("SELECT lieferant FROM lieferschein WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1");
    $lieferantenretoure = $this->app->DB->Select("SELECT lieferantenretoure FROM lieferschein WHERE id='$id' LIMIT 1");
    if($lieferantenretoure=="1" && $lieferant<=0)
    {
      $this->app->Tpl->Add('JAVASCRIPT','$(document).ready(function() { if(document.getElementById("adresse"))document.getElementById("adresse").focus(); });');
      $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Pflichtfeld! Bitte geben Sie eine Lieferanten-Nr. an!</div>");
    } else if ($adresse <=0 && $lieferantenretoure!="1")
    {
      $this->app->Tpl->Add('JAVASCRIPT','$(document).ready(function() { if(document.getElementById("adresse"))document.getElementById("adresse").focus(); });');
      $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Pflichtfeld! Bitte geben Sie eine Kunden-Nr. an!</div>");
    }	


    $status= $this->app->DB->Select("SELECT status FROM lieferschein WHERE id='$id' LIMIT 1");
    $schreibschutz= $this->app->DB->Select("SELECT schreibschutz FROM lieferschein WHERE id='$id' LIMIT 1");

    if($status != "angelegt" && $status != "angelegta" && $status != "a")
    {
      $Brief = new Briefpapier($this->app);
      if($Brief->zuArchivieren($id, "lieferschein"))$this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Der Lieferschein ist noch nicht archiviert! Bitte versenden oder manuell archivieren. <input type=\"button\" onclick=\"if(!confirm('Soll das Dokument archiviert werden?')) return false;else window.location.href='index.php?module=lieferschein&action=archivierepdf&id=$id';\" value=\"Manuell archivieren\" /></div>");
    }
    
    if($schreibschutz!="1" && $this->app->erp->RechteVorhanden("lieferschein","schreibschutz"))
    {
      $this->app->erp->AnsprechpartnerButton($adresse);
      $this->app->erp->LieferadresseButton($adresse);
    }


    //$this->LieferscheinMiniDetail(MINIDETAIL,false);
    $this->app->Tpl->Set('ICONMENU',$this->LieferscheinIconMenu($id));
    $this->app->Tpl->Set('ICONMENU2',$this->LieferscheinIconMenu($id,2));


    if($nummer!="")
    {
      $this->app->Tpl->Set('NUMMER',$nummer);
      $this->app->Tpl->Set('KUNDE',"&nbsp;&nbsp;&nbsp;Kd-Nr.".$kundennummer);
    } else 
    {
      $this->app->Tpl->Set('NUMMER',"ENTWURF");
      $this->app->Tpl->Set('KUNDE',"&nbsp;&nbsp;&nbsp;Kd-Nr.".$kundennummer);
    }

    if($schreibschutz=="1" && $this->app->erp->RechteVorhanden("lieferschein","schreibschutz"))
    {
      $this->app->Tpl->Add('MESSAGE',"<div class=\"warning\">Dieser Lieferschein wurde bereits versendet und darf daher nicht mehr bearbeitet werden!&nbsp;<input type=\"button\" value=\"Schreibschutz entfernen\" onclick=\"if(!confirm('Soll der Schreibschutz f&uuml;r diesen Lieferschein wirklich entfernt werden?')) return false;else window.location.href='index.php?module=lieferschein&action=schreibschutz&id=$id';\"></div>");
      //      $this->app->erp->CommonReadonly();
    }
    if($schreibschutz=="1")
      $this->app->erp->CommonReadonly();

    $status= $this->app->DB->Select("SELECT status FROM lieferschein WHERE id='$id' LIMIT 1");
    if($status=="")
      $this->app->DB->Update("UPDATE lieferschein SET status='angelegt' WHERE id='$id' LIMIT 1");

    $this->app->Tpl->Set('BUTTON_UEBERNEHMEN','
        <input type="button" value="&uuml;bernehmen" onclick="if(!confirm(\'Soll der neue Kunde wirklich &uuml;bernommen werden? Es werden alle Felder &uuml;berladen.\')) return false;else document.getElementById(\'uebernehmen\').value=1; document.getElementById(\'eprooform\').submit();"/><input type="hidden" id="uebernehmen" name="uebernehmen" value="0">
        ');


    $this->app->Tpl->Set('BUTTON_UEBERNEHMEN2','
        <input type="button" value="&uuml;bernehmen" onclick="if(!confirm(\'Soll der neue Lieferant wirklich &uuml;bernommen werden? Es werden alle Felder &uuml;berladen.\')) return false;else document.getElementById(\'uebernehmen2\').value=1; document.getElementById(\'eprooform\').submit();"/><input type="hidden" id="uebernehmen2" name="uebernehmen2" value="0">
        ');



    // immer wenn sich der lieferant genändert hat standartwerte setzen
    if($this->app->Secure->GetPOST("adresse")!="")
    {
      $tmp = $this->app->Secure->GetPOST("adresse");
      $kundennummer = $this->app->erp->FirstTillSpace($tmp);
      $adresse =  $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$kundennummer'  AND kundennummer!='' AND geloescht=0 LIMIT 1");

      $uebernehmen =$this->app->Secure->GetPOST("uebernehmen");
      if($uebernehmen=="1") // nur neuladen bei tastendruck auf uebernehmen // FRAGEN!!!!
      {
        $this->app->DB->Update("UPDATE lieferschein SET lieferantenretoure=0,lieferant=0 WHERE id='$id'");
        $this->app->erp->LoadLieferscheinStandardwerte($id,$adresse);
        header("Location: index.php?module=lieferschein&action=edit&id=$id");
        exit;
      }
    }

    if($this->app->Secure->GetPOST("lieferant")!="")
    {
      $tmplieferant = $this->app->Secure->GetPOST("lieferant");
      $lieferantennummer = $this->app->erp->FirstTillSpace($tmplieferant);

      $adresselieferant =  $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='$lieferantennummer' AND lieferantennummer!=''  AND geloescht=0 LIMIT 1");

      $uebernehmen2 =$this->app->Secure->GetPOST("uebernehmen2");
      if($uebernehmen2=="1") // nur neuladen bei tastendruck auf uebernehmen // FRAGEN!!!!
      {
        $this->app->DB->Update("UPDATE lieferschein SET lieferantenretoure=1 WHERE id='$id'");
        $this->app->erp->LoadLieferscheinStandardwerte($id,$adresselieferant,true);
        header("Location: index.php?module=lieferschein&action=edit&id=$id");
        exit;
      }

    }


    // easy table mit arbeitspaketen YUI als template 
    $table = new EasyTable($this->app);
    $table->Query("SELECT nummer as Nummer, bezeichnung, menge,vpe as VPE
        FROM lieferschein_position
        WHERE lieferschein='$id'");
    $table->DisplayNew('POSITIONEN',"VPE","noAction");

    $summe = $this->app->DB->Select("SELECT FORMAT(SUM(menge*preis),2) FROM lieferschein_position
        WHERE lieferschein='$id'");
    $waehrung = $this->app->DB->Select("SELECT waehrung FROM lieferschein_position
        WHERE lieferschein='$id' LIMIT 1");


    $status= $this->app->DB->Select("SELECT status FROM lieferschein WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('STATUS',"<input type=\"text\" size=\"30\" value=\"".$status."\" readonly [COMMONREADONLYINPUT]>");


    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    parent::LieferscheinEdit();

    $this->app->erp->MessageHandlerStandardForm();

    if($this->app->Secure->GetPOST("weiter")!="")
    {
      header("Location: index.php?module=lieferschein&action=positionen&id=$id");
      exit;
    }
    $this->LieferscheinMenu();

  }


  function LieferscheinPositionenEtiketten()
  {
    $id = $this->app->Secure->GetGET("id");
    $projekt = $this->app->DB->Select("SELECT projekt FROM lieferschein WHERE id='$id' LIMIT 1");
    $etiketten_positionen = $this->app->DB->Select("SELECT etiketten_positionen FROM projekt WHERE id='$projekt' LIMIT 1");
    $etiketten_art = $this->app->DB->Select("SELECT etiketten_art FROM projekt WHERE id='$projekt' LIMIT 1");
    $etiketten_drucker = $this->app->DB->Select("SELECT etiketten_drucker FROM projekt WHERE id='$projekt' LIMIT 1");
    if($etiketten_positionen > 0)
    { 
      $this->app->erp->LieferscheinPositionenDrucken($id,$etiketten_drucker,$etiketten_art);
    }
    header("Location: index.php?module=lieferschein&action=edit&id=$id");
    exit;

  }

  function Lieferadresse($id)
  {
    $data = $this->app->DB->SelectArr("SELECT * FROM lieferschein WHERE id='$id' LIMIT 1");

    foreach($data[0] as $key=>$value)
    {
      if($data[0][$key]!="" && $key!="abweichendelieferadresse" && $key!="land" && $key!="plz" && $key!="lieferland" && $key!="lieferplz") $data[0][$key] = $data[0][$key]."<br>";
    }


    $rechnungsadresse = $data[0]['name']."".$data[0]['ansprechpartner']."".$data[0]['abteilung']."".$data[0]['unterabteilung'].
      "".$data[0]['strasse']."".$data[0]['adresszusatz']."".$data[0]['land']."-".$data[0]['plz']." ".$data[0]['ort'];
    return "<table width=\"100%\">
      <tr valign=\"top\"><td width=\"50%\"><b>Lieferschein:</b><br><br>$rechnungsadresse</td></tr>";
  }

  function LieferscheinCreate()
  {
    //    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Lieferschein");
    $this->app->erp->MenuEintrag("index.php?module=lieferschein&action=list","Zur&uuml;ck zur &Uuml;bersicht");

    $anlegen = $this->app->Secure->GetGET("anlegen");

    if($this->app->erp->Firmendaten("schnellanlegen")=="1" && $anlegen!="1")
    {
      header("Location: index.php?module=lieferschein&action=create&anlegen=1");
      exit;
    }


    if($anlegen != "")
    {
      $id = $this->app->erp->CreateLieferschein();
      $this->app->erp->LieferscheinProtokoll($id,"Lieferschein angelegt");
      header("Location: index.php?module=lieferschein&action=edit&id=$id");

      exit;
    }
    $this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">M&ouml;chten Sie eine Lieferschein jetzt anlegen? &nbsp;
        <input type=\"button\" onclick=\"window.location.href='index.php?module=lieferschein&action=create&anlegen=1'\" value=\"Ja - Lieferschein jetzt anlegen\"></div><br>");
    $this->app->Tpl->Set('TAB1',"
        <table width=\"100%\" style=\"background-color: #fff; border: solid 1px #000;\" align=\"center\">
        <tr>
        <td align=\"center\">
        <br><b style=\"font-size: 14pt\">Lieferscheine in Bearbeitung</b>
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

    $this->app->YUI->TableSearch('AUFTRAGE',"lieferscheineinbearbeitung");
    /*
       $table = new EasyTable($this->app);
       $table->Query("SELECT DATE_FORMAT(datum,'%d.%m.%y') as vom, if(belegnr,belegnr,'ohne Nummer') as beleg, name, status, id
       FROM lieferschein WHERE status='angelegt' order by datum DESC, id DESC");
       $table->DisplayNew(AUFTRAGE, "<a href=\"index.php?module=lieferschein&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
       <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=lieferschein&action=delete&id=%value%';\">
       <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
       <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=lieferschein&action=copy&id=%value%';\">
       <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
       ");
     */

    $this->app->Tpl->Set('TABTEXT',"Lieferschein anlegen");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");



    //parent::LieferscheinCreate();
  }


  function LieferscheinList()
  {

    $speichern = $this->app->Secure->GetPOST("speichern");
    $lieferantenretoureinfo = $this->app->Secure->GetPOST("lieferantenretoureinfo");
    $lieferscheinid = $this->app->Secure->GetPOST("lieferscheinid");

    if($lieferantenretoureinfo!="" && $speichern!="" && $lieferscheinid > 0)
      $this->app->DB->Update("UPDATE lieferschein SET lieferantenretoureinfo='$lieferantenretoureinfo' WHERE id='$lieferscheinid' LIMIT 1");



    $this->app->Tpl->Set('UEBERSCHRIFT',"Lieferscheine");

    $backurl = $this->app->Secure->GetGET("backurl");
    $backurl = $this->app->erp->base64_url_decode($backurl);

    //     $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Lieferscheine");
    $this->app->erp->MenuEintrag("index.php?module=lieferschein&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=lieferschein&action=create","Neuen Lieferschein anlegen");

    if(strlen($backurl)>5)
      $this->app->erp->MenuEintrag("$backurl","Zur&uuml;ck zur &Uuml;bersicht");
    else
      $this->app->erp->MenuEintrag("index.php","Zur&uuml;ck zur &Uuml;bersicht");

    $status = $this->app->DB->SelectArr('
      SELECT
        status
      FROM
        lieferschein
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
        lieferschein
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
    $this->app->YUI->AutoComplete("lieferscheinnummer", "lieferschein", 1);

    $this->app->Tpl->Add('STATUS',$statusStr);
    $this->app->Tpl->Add('VERSANDARTEN',$versandartenStr);
    $this->app->Tpl->Add('LAENDER',$laenderStr);

    $this->app->Tpl->Parse('TAB1',"lieferschein_table_filter.tpl");

    $this->app->YUI->TableSearch('TAB2',"lieferscheineoffene");
    $this->app->YUI->TableSearch('TAB1',"lieferscheine");
    $this->app->YUI->TableSearch('TAB3',"lieferscheineinbearbeitung");

    $this->app->Tpl->Parse('PAGE',"lieferscheinuebersicht.tpl");

    return;


    $this->app->Tpl->Add('TABS',"<li><h2>Lieferscheinen</h2></li>");
    $this->app->Tpl->Add('TABS',"<li><a href=\"index.php?module=lieferschein&action=create\">Neuen Lieferschein</a></li>");
    //$this->app->Tpl->Add('TABS',"<li><a href=\"index.php?module=lieferschein&action=search\">Lieferschein suchen</a></li>");
    $this->app->Tpl->Add('TABS',"<li><a href=\"index.php?module=lieferschein&action=list\">Lieferschein &Uuml;bersicht</a></li>");

    $this->app->Tpl->Set('SUBSUBHEADING',"Lieferscheine");


    // nicht versendete Lieferscheine
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(l.datum,'%d.%m.%Y') as vom, if(l.belegnr!='',l.belegnr,'ohne Nummer') as lieferschein, l.name, p.abkuerzung, l.id
        FROM lieferschein l LEFT JOIN projekt p ON p.id=l.projekt WHERE l.status='freigegeben' order by l.datum DESC, id DESC");
    $table->DisplayNew('INHALT', "<a href=\"index.php?module=lieferschein&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=lieferschein&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=lieferschein&action=delete&id=%value%';\">
        <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=lieferschein&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        <a  href=\"index.php?module=paketmarke&action=create&frame=false&sid=lieferschein&id=%value%\" onclick=\"makeRequest(this);return false\"><img border=\"0\" src=\"./themes/new/images/stamp.png\" width=\"16\"></a>
        ");
    $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
    $this->app->Tpl->Set('INHALT',"");

    //    if($this->app->DB->Select("SELECT SUM(id) FROM lieferschein WHERE versendet=0")==0)
    //      $this->app->Tpl->Set('TAB1',"<div class=\"info\">Es sind keine nicht versendeten Lieferscheinen in Arbeit!</div>");


    // versendete Lieferscheinen

    // nicht versendete Lieferscheine
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(l.datum,'%d.%m.%Y') as vom, if(l.belegnr!='',l.belegnr,'ohne Nummer') as lieferschein, l.name, p.abkuerzung, l.id
        FROM lieferschein l LEFT JOIN projekt p ON p.id=l.projekt WHERE l.status='versendet' order by l.datum DESC, id DESC");
    $table->DisplayNew('INHALT', "<a href=\"index.php?module=lieferschein&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=lieferschein&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=lieferschein&action=delete&id=%value%';\">
        <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=lieferschein&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        <a  href=\"index.php?module=paketmarke&action=create&frame=false&sid=lieferschein&id=%value%\" onclick=\"makeRequest(this);return false\"><img border=\"0\" src=\"./themes/new/images/stamp.png\" width=\"16\"></a>
        ");
    $this->app->Tpl->Parse('TAB2',"rahmen70.tpl");
    $this->app->Tpl->Set('INHALT',"");

    // in Bearbeitung 

    // nicht versendete Lieferscheine
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(l.datum,'%d.%m.%Y') as vom, if(l.belegnr!='',l.belegnr,'ohne Nummer') as lieferschein, l.name, p.abkuerzung, l.id
        FROM lieferschein l LEFT JOIN projekt p ON p.id=l.projekt WHERE l.status='angelegt' order by l.datum DESC, id DESC");
    $table->DisplayNew('INHALT', "<a href=\"index.php?module=lieferschein&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
        <a href=\"index.php?module=lieferschein&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=lieferschein&action=delete&id=%value%';\">
        <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
        <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=lieferschein&action=copy&id=%value%';\">
        <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
        ");

    $this->app->Tpl->Parse('TAB3',"rahmen70.tpl");

    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->Tpl->Parse('PAGE',"lieferscheinuebersicht.tpl");

    /*
       $this->app->Tpl->Set(TAB2,"lieferant, lieferschein, waehrung, sprache, liefertermin, steuersatz, einkäufer, freigabe<br>
       <br>Lieferschein (NR),Bestellart (NB), Bestelldatum
       <br>Projekt
       <br>Kostenstelle pro Position
       <br>Terminlieferschein (am xx.xx.xxxx raus damit)
       <br>vorschlagsdaten für positionen
       <br>proposition reinklicken zum ändern und reihenfolge tabelle 
       <br>Lieferschein muss werden wie lieferschein (lieferschein beschreibung = allgemein)
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
