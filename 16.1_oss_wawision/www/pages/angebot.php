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
include ("_gen/angebot.php");

class Angebot extends GenAngebot
{

  function Angebot(&$app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","AngebotList");
    $this->app->ActionHandler("create","AngebotCreate");
    $this->app->ActionHandler("positionen","AngebotPositionen");
    $this->app->ActionHandler("addposition","AngebotAddPosition");
    $this->app->ActionHandler("upangebotposition","UpAngebotPosition");
    $this->app->ActionHandler("delangebotposition","DelAngebotPosition");
    $this->app->ActionHandler("downangebotposition","DownAngebotPosition");
    $this->app->ActionHandler("positioneneditpopup","AngebotPositionenEditPopup");
    $this->app->ActionHandler("edit","AngebotEdit");
    $this->app->ActionHandler("copy","AngebotCopy");
    $this->app->ActionHandler("auftrag","AngebotAuftrag");
    $this->app->ActionHandler("delete","AngebotDelete");
    $this->app->ActionHandler("freigabe","AngebotFreigabe");
    $this->app->ActionHandler("abschicken","AngebotAbschicken");
    $this->app->ActionHandler("pdf","AngebotPDF");
    $this->app->ActionHandler("inlinepdf","AngebotInlinePDF");
    $this->app->ActionHandler("protokoll","AngebotProtokoll");
    $this->app->ActionHandler("minidetail","AngebotMiniDetail");
    $this->app->ActionHandler("editable","AngebotEditable");
    $this->app->ActionHandler("livetabelle","AngebotLiveTabelle");
    $this->app->ActionHandler("schreibschutz","AngebotSchreibschutz");
    $this->app->ActionHandler("deleterabatte","AngebotDeleteRabatte");
    $this->app->ActionHandler("dateien","AngebotDateien");
    $this->app->ActionHandler("wiedervorlage","AngebotWiedervorlage");
    $this->app->ActionHandler("pdffromarchive","AngebotPDFfromArchiv");
    $this->app->ActionHandler("archivierepdf","AngebotArchivierePDF");
    $this->app->ActionHandler("kopievon","AngebotKopievon");
    $this->app->DefaultActionHandler("list");

    $id = $this->app->Secure->GetGET("id");
    $nummer = $this->app->Secure->GetPOST("adresse");

    if($nummer=="")
      $adresse= $this->app->DB->Select("SELECT a.name FROM angebot b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    else
      $adresse = $nummer;

    $nummer = $this->app->DB->Select("SELECT b.belegnr FROM angebot b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    if($nummer=="" || $nummer=="0") $nummer="ohne Nummer";

    $this->app->Tpl->Set('UEBERSCHRIFT',"Angebot:&nbsp;".$adresse." (".$nummer.")");
    $this->app->Tpl->Set('FARBE',"[FARBE2]");

    $angebotersatz = $this->app->DB->Select("SELECT abweichendebezeichnung FROM angebot WHERE id='$id' LIMIT 1");
    if($angebotersatz)
      $this->app->Tpl->Set('BEZEICHNUNGTITEL',($this->app->erp->Beschriftung("bezeichnungangebotersatz")?$this->app->erp->Beschriftung("bezeichnungangebotersatz"):$this->app->erp->Beschriftung("dokument_angebot")));
    else
      $this->app->Tpl->Set('BEZEICHNUNGTITEL','Angebot');

    $this->app->ActionHandlerListen($app);
  }


  function AngebotKopievon()
  {
    $id = (int)$this->app->Secure->GetGET('id');

    $hauptid = $id;
    while(1)
    { 
      $checkkopievon = $this->app->DB->Select("SELECT kopievon FROM angebot WHERE id='$hauptid' LIMIT 1");
      if($checkkopievon > 0)
        $hauptid = $checkkopievon;
      else break;
      $timeout++;
      if($timeout > 100) break;
    }

    $neuesangebot = $this->app->erp->CopyAngebot($id);
    $altebelegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$hauptid' LIMIT 1");
    $anzahl_kopievon = $this->app->DB->Select("SELECT COUNT(id)+1 FROM angebot WHERE kopievon='$hauptid' AND kopievon > 0");

    $this->app->DB->Update("UPDATE angebot SET belegnr='{$altebelegnr}-$anzahl_kopievon', status='freigegeben',
        kopievon='$hauptid',kopienummer='$anzahl_kopievon' WHERE id='$neuesangebot' LIMIT 1");

    $this->app->erp->AngebotNeuberechnen($id);
    header("Location: index.php?module=angebot&action=edit&id=$neuesangebot");
    exit;
  }

  function AngebotArchivierePDF()
  {
    $id = (int)$this->app->Secure->GetGET('id');
    $projektbriefpapier = $this->app->DB->Select("SELECT projekt FROM angebot WHERE id = '$id' LIMIT 1");
    $Brief = new AngebotPDF($this->app,$projektbriefpapier);
    $Brief->GetAngebot($id);
    $tmpfile = $Brief->displayTMP();
    $Brief->ArchiviereDocument();
    $this->app->DB->Update("UPDATE angebot SET schreibschutz='1' WHERE id='$id'");
    header('Location: index.php?module=angebot&action=edit&id='.$id);
    exit;
  }

  function AngebotDateien()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->AngebotMenu();
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Dateien)");
    $this->app->YUI->DateiUpload('PAGE',"Angebot",$id);
  }



  function AngebotDeleteRabatte()
  {

    $id=$this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE angebot SET rabatt='',rabatt1='',rabatt2='',rabatt3='',rabatt4='',rabatt5='',realrabatt='' WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Rabatte wurden entfernt!</div>  ");
    header("Location: index.php?module=angebot&action=edit&id=$id&msg=$msg");
    exit;
  } 

  function AngebotEditable()
  {
    $this->app->YUI->AARLGEditable();
  }

  function AngebotSchreibschutz()
  {

    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE angebot SET zuarchivieren='1' WHERE id='$id'");
    $this->app->DB->Update("UPDATE angebot SET schreibschutz='0' WHERE id='$id'");
    header("Location: index.php?module=angebot&action=edit&id=$id");
    exit;

  }

  function AngebotPDFfromArchiv()
  {
    $id = $this->app->Secure->GetGET("id");
    $archiv = $this->app->DB->Select("SELECT table_id from pdfarchiv where id = '$id' LIMIT 1");
    if($archiv)
    {
      $projekt = $this->app->DB->Select("SELECT projekt from angebot where id = '".(int)$archiv."'");
    }
    if($archiv)$Brief = new AngebotPDF($this->app,$projekt);
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

  function AngebotMiniDetail($parsetarget="",$menu=true)
  {
    $id = $this->app->Secure->GetGET("id");
    $auftragArr = $this->app->DB->SelectArr("SELECT * FROM angebot WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='{$auftragArr[0]['projekt']}' LIMIT 1");
    $kundenname = $this->app->DB->Select("SELECT name FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");


    $this->app->Tpl->Set('KUNDE',"<a href=\"index.php?module=adresse&action=edit&id=".$auftragArr[0]['adresse']."\">".$kundennummer."</a> ".$kundenname);
    //$this->app->Tpl->Set('KUNDE',$kundennummer." ".$kundenname);
    $this->app->Tpl->Set('DECKUNGSBEITRAG',0);
    $this->app->Tpl->Set('DBPROZENT',0);    
    $this->app->Tpl->Set('PROJEKT',$projekt);
    $this->app->Tpl->Set('ZAHLWEISE',$auftragArr[0]['zahlungsweise']);
    $this->app->Tpl->Set('STATUS',$auftragArr[0]['status']);
    $this->app->Tpl->Set('ANFRAGE',$auftragArr[0]['anfrage']);

    if($auftragArr[0]['ust_befreit']==0)
      $this->app->Tpl->Set('STEUER',"Deutschland");
    else if($auftragArr[0]['ust_befreit']==1)
      $this->app->Tpl->Set('STEUER',"EU-Lieferung");
    else
      $this->app->Tpl->Set('STEUER',"Export");

    $auftrag = $this->app->DB->SelectArr("SELECT 
        CONCAT('<a href=\"index.php?module=auftrag&action=edit&id=',l.id,'\">',if(l.belegnr='0' OR l.belegnr='','ENTWURF',l.belegnr),'</a>&nbsp;<a href=\"index.php?module=auftrag&action=pdf&id=',l.id,'\"><img src=\"./themes/new/images/pdf.png\" title=\"Lieferschein PDF\" border=\"0\"></a>&nbsp;
          <a href=\"index.php?module=auftrag&action=edit&id=',l.id,'\"><img src=\"./themes/new/images/edit.png\" title=\"Lieferschein bearbeiten\" border=\"0\"></a>') as auftrag
        FROM auftrag l WHERE l.angebotid='$id'");

    $auftragid = $this->app->DB->Select("SELECT l.id
        FROM auftrag l WHERE l.auftragid='$id' AND l.auftrag!='' LIMIT 1");

    $auftragbelegnr = $this->app->DB->Select("SELECT l.belegnr
        FROM auftrag l WHERE l.id='$id' LIMIT 1");

    if(count($auftrag)>0)
    {
      for($li=0;$li<count($auftrag);$li++)
      {
        $this->app->Tpl->Add('AUFTRAG',$auftrag[$li]['auftrag']);
        if($li<count($auftrag))
          $this->app->Tpl->Add('AUFTRAG',"<br>");
      }
    }
    else
      $this->app->Tpl->Set('AUFTRAG',"-");


    if($menu)
    {
      $menu = $this->AngebotIconMenu($id);
      $this->app->Tpl->Set('MENU',$menu);
    }
    // ARTIKEL

    $status = $this->app->DB->Select("SELECT status FROM angebot WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);

    if($status=="freigegeben")
    {
      $table->Query("SELECT if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung) as artikel, CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\" target=\"_blank\">', ap.nummer,'</a>') as Nummer, ap.menge as M,
          if(a.porto,'-',if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel) > ap.menge,(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),
              if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel)>0,CONCAT('<font color=red><b>',(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),'</b></font>'),
                '<font color=red><b>aus</b></font>'))) as L
          FROM angebot_position ap, artikel a 
          WHERE ap.angebot='$id' AND a.id=ap.artikel ORDER by ap.sort");
      $artikel = $table->DisplayNew("return","A","noAction");

      $this->app->Tpl->Add('JAVASCRIPT',"
          var auto_refresh = setInterval(
            function ()
            {
            $('#artikeltabellelive$id').load('index.php?module=angebot&action=livetabelle&id=$id').fadeIn('slow');
            }, 3000); // refresh every 10000 milliseconds
          ");
    } else {
      $table->Query("SELECT if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung)  as artikel, CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\" target=\"_blank\">', ap.nummer,'</a>') as Nummer, ap.menge as M
          FROM angebot_position ap, artikel a WHERE ap.angebot='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","Menge","noAction");
    }

    $this->app->Tpl->Set('ARTIKEL','<div id="artikeltabellelive'.$id.'">'.$artikel.'</div>');

    if($auftragArr[0]['belegnr']=="0" || $auftragArr[0]['belegnr']=="") $auftragArr[0]['belegnr'] = "ENTWURF";
    $this->app->Tpl->Set('BELEGNR',$auftragArr[0]['belegnr']);
    $this->app->Tpl->Set('ANGEBOTID',$auftragArr[0]['id']);


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

    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM angebot_protokoll WHERE angebot='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('PROTOKOLL',"Protokoll","noAction");

    $this->app->Tpl->Set('RECHNUNGLIEFERADRESSE',$this->AngebotRechnungsLieferadresse($auftragArr[0]['id']));

    $Brief = new AngebotPDF($this->app,$auftragArr[0]['projekt']);

    $Dokumentenliste = $Brief->getArchivedFiles($id, 'angebot');
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
          $tmpr['menu'] = '<a href="index.php?module=angebot&action=pdffromarchive&id='.$v['id'].'"><img src="themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/pdf.png" /></a>';
          $tmp3->datasets[] = $tmpr;
        }
      }

      $tmp3->DisplayNew('PDFARCHIV','Men&uuml;',"noAction");
    }

    if($parsetarget=="")
    {
      $this->app->Tpl->Output("angebot_minidetail.tpl");
      exit;
    }  else {
      $this->app->Tpl->Parse($parsetarget,"angebot_minidetail.tpl");
    }
  }

  function AngebotRechnungsLieferadresse($angebotid)
  { 
    $data = $this->app->DB->SelectArr("SELECT * FROM angebot WHERE id='$angebotid' LIMIT 1");

    foreach($data[0] as $key=>$value)
    {
      if($data[0][$key]!="" && $key!="abweichendelieferadresse" && $key!="land" && $key!="plz" && $key!="lieferland" && $key!="lieferplz") $data[0][$key] = $data[0][$key]."<br>";
    }


    $rechnungsadresse = $data[0]['name']."".$data[0]['ansprechpartner']."".$data[0]['abteilung']."".$data[0]['unterabteilung'].
      "".$data[0]['strasse']."".$data[0]['adresszusatz']."".$data[0]['land']."-".$data[0]['plz']." ".$data[0]['ort'];

    // wenn abweichende rechnungsadresse bei kunden aktiv ist dann diese verwenden

    $abweichende = $this->app->DB->Select("SELECT abweichende_rechnungsadresse FROM adresse WHERE id='".$data[0][adresse]."' LIMIT 1");
    if($abweichende=="1")
    {
      $adresse_data = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='".$data[0][adresse]."' LIMIT 1");

      foreach($adresse_data[0] as $key=>$value)
      {
        if($adresse_data[0][$key]!="" && $key!="abweichendelieferadresse" && $key!="rechnung_land" && $key!="rechnung_plz")
        {
          $adresse_data[0][$key] = $adresse_data[0][$key]."<br>";
        }
      }

      $rechnungsadresse = $adresse_data[0]['rechnung_name']."".$adresse_data[0]['rechnung_ansprechpartner']."".$adresse_data[0]['rechnung_abteilung']."".$adresse_data[0]['rechnung_unterabteilung'].
        "".$adresse_data[0]['rechnung_strasse']."".$adresse_data[0]['rechnung_adresszusatz']."".$adresse_data[0]['rechnung_land']."-".$adresse_data[0]['rechnung_plz']." ".$adresse_data[0]['rechnung_ort'];
    }

    if($data[0]['abweichendelieferadresse']!=0){

      $lieferadresse = $data[0]['liefername']."".$data[0]['lieferansprechpartner']."".$data[0]['lieferabteilung']."".$data[0]['lieferunterabteilung'].
        "".$data[0]['lieferstrasse']."".$data[0]['lieferadresszusatz']."".$data[0]['lieferland']."-".$data[0]['lieferplz']." ".$data[0]['lieferort'];


    } else {
      $lieferadresse = "entspricht Rechnungsadresse";
    }

    return "<table width=\"100%\">
      <tr valign=\"top\"><td width=\"50%\"><b>Rechnungsadresse:</b><br><br>$rechnungsadresse<br></td></tr>
      <tr><td><b>Lieferadresse:</b><br><br>$lieferadresse</td></tr></table>";
  }



  function AngebotFreigabe()
  {
    $id = $this->app->Secure->GetGET("id");
    $freigabe= $this->app->Secure->GetGET("freigabe");
    $weiter= $this->app->Secure->GetPOST("weiter");
    $this->app->Tpl->Set('TABTEXT',"Freigabe");

    $this->app->erp->CheckVertrieb($id,"angebot");
    $this->app->erp->CheckBearbeiter($id,"angebot");

    if($weiter!="")
    {
      header("Location: index.php?module=angebot&action=abschicken&id=$id");
      exit;
    }


    $check = $this->app->DB->Select("SELECT b.belegnr FROM angebot b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");


    if($freigabe==$id)
    {
      $projekt = $this->app->DB->Select("SELECT projekt FROM angebot WHERE id='$id' LIMIT 1");
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
      if($belegnr=="" || $belegnr=="0")
      {
        $belegnr = $this->app->erp->GetNextNummer("angebot",$projekt);

        $this->app->DB->Update("UPDATE angebot SET belegnr='$belegnr', status='freigegeben' WHERE id='$id' LIMIT 1");
        $this->app->erp->AngebotProtokoll($id,"Angebot freigegeben");
        $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Das Angebot wurde freigegeben und kann jetzt versendet werden!</div>  ");
        header("Location: index.php?module=angebot&action=edit&id=$id&msg=$msg");
        exit;
      } else {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Das Angebot wurde bereits freigegeben!</div>  ");
        header("Location: index.php?module=angebot&action=edit&id=$id&msg=$msg");
        exit;
      }
    } else { 

      $name = $this->app->DB->Select("SELECT a.name FROM angebot b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
      $summe = $this->app->DB->Select("SELECT gesamtsumme FROM angebot WHERE id='$id' LIMIT 1");
      $waehrung = $this->app->DB->Select("SELECT waehrung FROM angebot_position
          WHERE angebot='$id' LIMIT 1");

      $summe = $this->app->erp->EUR($summe);

      $this->app->Tpl->Set('TAB1',"<div class=\"info\">Soll das Angebot  
          jetzt freigegeben werden? <input type=\"button\" value=\"Jetzt freigeben\" onclick=\"window.location.href='index.php?module=angebot&action=freigabe&id=$id&freigabe=$id'\">
          </div>");
    }
    $this->AngebotMenu();
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }


  function AngebotCopy()
  {
    $id = $this->app->Secure->GetGET("id");

    $newid = $this->app->erp->CopyAngebot($id);

    header("Location: index.php?module=angebot&action=edit&id=$newid");
    exit;
  }


  function AngebotLiveTabelle()
  {
    $id = $this->app->Secure->GetGET("id");
    $status = $this->app->DB->Select("SELECT status FROM angebot WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);

    if($status=="freigegeben")
    {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, ap.menge as M,
          if(a.porto,'-',if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel) > ap.menge,(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),
              if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel)>0,CONCAT('<font color=red><b>',(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),'</b></font>'),
                '<font color=red><b>aus</b></font>'))) as L
          FROM angebot_position ap, artikel a WHERE ap.angebot='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","A","noAction");
    } else {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, ap.menge as M
          FROM angebot_position ap, artikel a WHERE ap.angebot='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","Menge","noAction");
    }
    echo $artikel;
    exit;
  }


  function AngebotAuftrag()
  {
    $id = $this->app->Secure->GetGET("id");

    $newid = $this->app->erp->WeiterfuehrenAngebotZuAuftrag($id);

    header("Location: index.php?module=auftrag&action=edit&id=$newid");
    exit;
  }

  function AngebotAbschicken()
  {
    $this->AngebotMenu();
    $this->app->erp->DokumentAbschicken();
  }


  function AngebotDelete()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM angebot WHERE id='$id' LIMIT 1");
    $status = $this->app->DB->Select("SELECT status FROM angebot WHERE id='$id' LIMIT 1");

    if($belegnr=="0" || $belegnr=="")
    {

      $this->app->erp->DeleteAngebot($id);
      $belegnr="ENTWURF";
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Das Angebot \"$name\" ($belegnr) wurde gel&ouml;scht!</div>  ");
      //header("Location: ".$_SERVER['HTTP_REFERER']."&msg=$msg");
      header("Location: index.php?module=angebot&action=list&msg=$msg");
      exit;
    } else 
    {
      if($status=="abgeschlossen")                                                                                                                            
      {                                                                                                                                                       
        // KUNDE muss RMA starten                                                                                                                             
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Angebot \"$name\" ($belegnr) kann nicht storniert werden da Angebot als Auftrag bereits weitergef&uuml;hrt worden ist!</div>  ");
      }                                                                                                                                                                   
      else if($status=="storniert")                                                                                                                                       
      {                                                                                                                                                                   
        $maxbelegnr = $this->app->DB->Select("SELECT MAX(belegnr) FROM angebot");
        if(0)//$maxbelegnr == $belegnr)
        {
          $this->app->DB->Delete("DELETE FROM angebot_position WHERE angebot='$id'");
          $this->app->DB->Delete("DELETE FROM angebot_protokoll WHERE angebot='$id'");
          $this->app->DB->Delete("DELETE FROM angebot WHERE id='$id'");
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Angebot \"$name\" ($belegnr) wurde ge&ouml;scht !</div>  ");
        } else
        {
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Angebot \"$name\" ($belegnr) kann nicht storniert werden das sie er bereits storniert ist!</div>  ");
        }
        header("Location: index.php?module=angebot&action=list&msg=$msg");
        exit;
      }                                                                                                                                                                   

      else {                                                                                                                                                              
        $this->app->DB->Update("UPDATE angebot SET status='storniert' WHERE id='$id' LIMIT 1");                                                                             
        $this->app->erp->AngebotProtokoll($id,"Angebot storniert");                                                                                                         
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Das Angebot \"$name\" ($belegnr) wurde storniert!</div>");                                                                                                 
      }
      //$msg = $this->app->erp->base64_url_encode("<div class=\"error\">Angebot \"$name\" ($belegnr) kann nicht storniert werden, da es bereits versendet wurde!</div>");
      header("Location: index.php?module=angebot&action=list&msg=$msg#tabs-1");
      exit;
    }
  }

  function AngebotProtokoll()
  {
    $this->AngebotMenu();
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Set('TABTEXT',"Protokoll");
    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM angebot_protokoll WHERE angebot='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('TAB1',"Protokoll","noAction");

    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function AngebotAddPosition()
  {
    $sid = $this->app->Secure->GetGET("sid");
    $id = $this->app->Secure->GetGET("id");
    $menge = $this->app->Secure->GetGET("menge");
    $datum  = $this->app->Secure->GetGET("datum");
    $datum  = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1");
    $this->app->erp->AddAngebotPosition($id, $sid,$menge,$datum);
    $this->app->erp->AngebotNeuberechnen($id);

    header("Location: index.php?module=angebot&action=positionen&id=$id");
    exit;

  }

  function AngebotInlinePDF()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->AngebotNeuberechnen($id);

    $projekt = $this->app->DB->Select("SELECT projekt FROM angebot WHERE id='$id' LIMIT 1");
    $schreibschutz = $this->app->DB->Select("SELECT schreibschutz FROM angebot WHERE id='$id' LIMIT 1");
    $frame = $this->app->Secure->GetGET("frame");

    if($frame=="")
    {
      $Brief = new AngebotPDF($this->app,$projekt);
      $Brief->GetAngebot($id);
      $Brief->inlineDocument($schreibschutz);
    } else {

      $file = urlencode("../../../../index.php?module=angebot&action=inlinepdf&id=$id");
      echo "<iframe width=\"100%\" height=\"600\" src=\"./js/production/generic/web/viewer.html?file=$file\"></iframe>";
      exit;
    }
  }


  function AngebotPDF()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->AngebotNeuberechnen($id);

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM angebot WHERE id='$id' LIMIT 1");
    $schreibschutz = $this->app->DB->Select("SELECT schreibschutz FROM angebot WHERE id='$id' LIMIT 1");
    //    if(is_numeric($belegnr) && $belegnr!=0)
    {
      $Brief = new AngebotPDF($this->app,$projekt);
      $Brief->GetAngebot($id);
      $Brief->displayDocument($schreibschutz); 
    } //else
    //     $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Noch nicht freigegebene Angeboten k&ouml;nnen nicht als PDF betrachtet werden.!</div>");


    $this->AngebotList();
  }




  function AngebotMenu()
  {
    $id = $this->app->Secure->GetGET("id");

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM angebot WHERE id='$id' LIMIT 1");


    if($belegnr=="0" || $belegnr=="") $belegnr ="(Entwurf)";
    //    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Angebot $belegnr");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT2',"$name Angebot $belegnr");
    $this->app->erp->AngebotNeuberechnen($id);

    // status bestell
    $status = $this->app->DB->Select("SELECT status FROM angebot WHERE id='$id' LIMIT 1");
    if ($status=="angelegt")
    {
      $this->app->erp->MenuEintrag("index.php?module=angebot&action=freigabe&id=$id","Freigabe");
    }


    $this->app->erp->MenuEintrag("index.php?module=angebot&action=edit&id=$id","Details");
    $this->app->erp->MenuEintrag("index.php?module=angebot&action=dateien&id=$id","Dateien");

    if($status=='bestellt')
    { 
      $this->app->erp->MenuEintrag("index.php?module=angebot&action=wareneingang&id=$id","Wareneingang<br>R&uuml;ckst&auml;nde");
      $this->app->erp->MenuEintrag("index.php?module=angebot&action=wareneingang&id=$id","Mahnstufen");
    } 

    //   $this->app->erp->MenuEintrag("index.php?module=angebot&action=abschicken&id=$id","Abschicken / Protokoll");
    //    $this->app->erp->MenuEintrag("index.php?module=angebot&action=protokoll&id=$id","Protokoll");
    if($this->app->Secure->GetGET("action")!="abschicken")
      $this->app->erp->MenuEintrag("index.php?module=angebot&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    else
      $this->app->erp->MenuEintrag("index.php?module=angebot&action=edit&id=$id","Zur&uuml;ck zum Angebot");

    if($id && $this->app->erp->RechteVorhanden('wiedervorlage','list'))
      $this->app->erp->MenuEintrag("index.php?module=angebot&action=wiedervorlage&id=$id","Wiedervorlage");
    $this->app->Tpl->Parse('MENU',"angebot_menu.tpl");

  }

  function AngebotWiedervorlage()
  {
    /*
       $data['adresse'] = (int)$this->app->DB->Select("SELECT id from adresse where mitarbeiternummer = '" .(int)$this->app->Secure->GetPOST('bearbeiter')."'");
       $data['adresse_mitarbeiter'] = (int)$this->app->DB->Select("SELECT id from adresse where mitarbeiternummer = '" .(int)$this->app->Secure->GetPOST('mitarbeiter')."'");
       $data['datum_angelegt'] = $this->app->String->Convert($data['datum_angelegt'],"%1.%2.%3","%3-%2-%1");
       $data['datum_erinnerung'] = $this->app->String->Convert($data['datum_erinnerung'],"%1.%2.%3","%3-%2-%1");
       $mitarbeiternummer = $this->app->DB->Select("SELECT mitarbeiternummer from adresse where id = ".$dokument['adresse_mitarbeiter']." limit 1");
       $bearbeiternummer = $this->app->DB->Select("SELECT mitarbeiternummer from adresse where id = ".$dokument['adresse']." limit 1");
       $dokument['datum_angelegt'] = $this->app->String->Convert($dokument['datum_angelegt'],"%1-%2-%3","%3.%2.%1");
       $dokument['datum_erinnerung'] = $this->app->String->Convert($dokument['datum_erinnerung'],"%1-%2-%3","%3.%2.%1");
       $this->app->Tpl->Add(DATUM,$dokument['datum_angelegt']);
       $this->app->Tpl->Add(UHRZEIT,$dokument['zeit_angelegt']);
       $this->app->Tpl->Add(BEARBEITER,$bearbeiternummer?$bearbeiternummer.' '.$this->app->DB->Select("SELECT name from adresse where id = ".$dokument['adresse']." limit 1"):'');
       $this->app->Tpl->Add(BETREFF,$dokument['bezeichnung']);
       $this->app->Tpl->Add(MITARBEITER,$mitarbeiternummer?$mitarbeiternummer.' '.$this->app->DB->Select("SELECT name from adresse where id = ".$dokument['adresse_mitarbeiter']." limit 1"):'');

     */
    $id = (int)$this->app->Secure->GetGET("id");
    $this->AngebotMenu();
    if($id)
    {

      $wiedervorlage = $this->app->DB->SelectArr("SELECT * from wiedervorlage WHERE module = 'angebot' AND parameter = '$id'");
      if($wiedervorlage)
      {
        $wiedervorlage = reset($wiedervorlage);
      }
      if($_POST['save'])
      {
        $datum_angelegt = $_POST['datum_angelegt'];
        $zeit_angelegt = $_POST['zeit_angelegt'];
        $datum_erinnerung = $_POST['datum_erinnerung'];
        $zeit_erinnerung = $_POST['zeit_erinnerung'];
        $bezeichnung = $_POST['bezeichnung'];
        $beschreibung = $_POST['beschreibung'];
        $adresse_mitarbeiter = (int)$this->app->DB->Select("SELECT id from adresse where mitarbeiternummer = '" .(int)$_POST['adresse_mitarbeiter']."'");
        $adresse = (int)$this->app->DB->Select("SELECT id from adresse where kundennummer = '" .(int)$_POST['adresse']."'");
        $bearbeiter = (int)$this->app->DB->Select("SELECT id from adresse where mitarbeiternummer = '" .(int)$_POST['bearbeiter']."'");
        $abgeschlossen = $_POST['abgeschlossen'];

        if($datum_erinnerung && $datum_erinnerung != '..')
        {
          $datum_angelegt = $this->app->String->Convert($datum_angelegt,"%1.%2.%3","%3-%2-%1");
          $datum_erinnerung = $this->app->String->Convert($datum_erinnerung,"%1.%2.%3","%3-%2-%1");
          if($wiedervorlage)
          {


            if($this->app->DB->Update("UPDATE wiedervorlage
                  set
                  datum_angelegt = '$datum_angelegt',
                  zeit_angelegt = '$zeit_angelegt',
                  datum_erinnerung = '$datum_erinnerung',
                  zeit_erinnerung = '$zeit_erinnerung',
                  bezeichnung = '".mysqli_real_escape_string($this->app->DB->connection, $bezeichnung)."',
                  beschreibung = '".mysqli_real_escape_string($this->app->DB->connection, $beschreibung)."',
                  abgeschlossen = '".($abgeschlossen?1:0)."',
                  bearbeiter = '$bearbeiter',
                  adresse = '$adresse',
                  adresse_mitarbeiter = '$adresse_mitarbeiter'
                  where  module = 'angebot' AND parameter = '$id'
                  "))
            {
              $this->app->Tpl->Set('NEUMESSAGE','<div class="info">Erfolgreich gespeichert!</div>');
            }else{
              $this->app->Tpl->Set('NEUMESSAGE',mysqli_error($this->app->DB->connection));
            }

          }else{
            if($this->app->DB->Insert("INSERT INTO wiedervorlage (
              datum_angelegt, zeit_angelegt,datum_erinnerung, zeit_erinnerung, bezeichnung,beschreibung,abgeschlossen,bearbeiter,adresse_mitarbeiter,module,parameter,adresse) values (
                '$datum_angelegt','$zeit_angelegt','$datum_erinnerung','$zeit_erinnerung','".mysqli_real_escape_string($this->app->DB->connection, $bezeichnung)."',
                '".mysqli_real_escape_string($this->app->DB->connection, $beschreibung)."','".($abgeschlossen?1:0)."','$adresse','$adresse_mitarbeiter','angebot','$id','$adresse')"
                  ))
            {
              $this->app->Tpl->Set('NEUMESSAGE','<div class="info">Erfolgreich gespeichert!</div>');
            }else{
              $this->app->Tpl->Set('NEUMESSAGE',mysqli_error($this->app->DB->connection));
            }

          }

        }else{
          $datum_erinnerung = '';
          $this->app->Tpl->Set('NEUMESSAGE','<div class="error">Bitte geben Sie ein Datum ein!</div>');
        }
      } else {
        $datum_angelegt = date("Y-m-d");
        $zeit_angelegt = date("H:i");
        $datum_erinnerung = date("Y-m-d",strtotime ("+1 day"));
        $zeit_erinnerung = '0:00';
        $bezeichnung = 'Angebot '.$this->app->DB->Select("SELECT a.name from angebot an left join adresse a on an.adresse = a.id where an.id = $id limit 1")." vom ".$this->app->String->Convert($this->app->DB->Select("SELECT an.datum from angebot an where an.id = $id limit 1"),"%1-%2-%3","%3.%2.%1");
        $beschreibung = '';
        $adresse_mitarbeiter = $this->app->User->GetAdresse();//$_POST['adresse_mitarbeiter'];
        $bearbeiter = $this->app->User->GetAdresse();
        $adresse = $this->app->DB->Select("SELECT adresse from angebot where id = ".(int)$id);
        $abgeschlossen = $_POST['abgeschlossen'];

      }
      $wiedervorlage = $this->app->DB->SelectArr("SELECT * from wiedervorlage WHERE module = 'angebot' AND parameter = '$id'");
      if($wiedervorlage)
      {
        $wiedervorlage = reset($wiedervorlage);
        $datum_angelegt = $wiedervorlage['datum_angelegt'];
        $zeit_angelegt = $wiedervorlage['zeit_angelegt'];
        $datum_erinnerung = $wiedervorlage['datum_erinnerung'];
        $zeit_erinnerung = $wiedervorlage['zeit_erinnerung'];
        $bezeichnung = $wiedervorlage['bezeichnung'];
        $beschreibung = $wiedervorlage['beschreibung'];
        $adresse_mitarbeiter = (int)$wiedervorlage['adresse_mitarbeiter'];
        $bearbeiter = (int)$wiedervorlage['bearbeiter'];
        $adresse = (int)$wiedervorlage['adresse'];
        $abgeschlossen = $wiedervorlage['abgeschlossen'];


      }



      $mitarbeiternummer = "".$this->app->DB->Select("SELECT mitarbeiternummer from adresse where id = ".(int)$adresse_mitarbeiter." limit 1");
      $bearbeiternummer = "".$this->app->DB->Select("SELECT mitarbeiternummer from adresse where id = ".(int)$bearbeiter." limit 1");
      $kundennummer = "".$this->app->DB->Select("SELECT kundennummer from adresse where id = ".(int)$adresse." limit 1");
      $mitarbeitername = "".$this->app->DB->Select("SELECT name from adresse where id = ".(int)$adresse_mitarbeiter." limit 1");
      $bearbeitername = "".$this->app->DB->Select("SELECT name from adresse where id = ".(int)$bearbeiter." limit 1");
      $kundenname = "".$this->app->DB->Select("SELECT name from adresse where id = ".(int)$adresse." limit 1");      
      $this->app->Tpl->Set('DATUM_ANGELEGT',$this->app->String->Convert($datum_angelegt,"%1-%2-%3","%3.%2.%1"));
      $this->app->Tpl->Set('ZEIT_ANGELEGT',$zeit_angelegt);
      $this->app->Tpl->Set('DATUM_ERINNERUNG',$this->app->String->Convert($datum_erinnerung,"%1-%2-%3","%3.%2.%1"));
      $this->app->Tpl->Set('ZEIT_ERINNERUNG',$zeit_erinnerung);
      $this->app->Tpl->Set('BEZEICHNUNG',$bezeichnung);
      $this->app->Tpl->Set('BESCHREIBUNG',$beschreibung);
      $this->app->Tpl->Set('ADRESSE_MITARBEITER',$mitarbeiternummer.' '.$mitarbeitername);
      $this->app->Tpl->Set('ADRESSE',$kundennummer.' '.$kundenname);
      $this->app->Tpl->Set('BEARBEITER',$bearbeiternummer.' '.$bearbeitername);
      $this->app->Tpl->Set('ABGESCHLOSSEN',$abgeschlossen?' checked="checked" ':'');



      /*
         <tr><td width="">Datum:</td><td><input type="text" name="datum_angelegt" size="5" value="[DATUM_ANGELEGT]" /> [MSGDATUM_ANGELEGT]</td><td width="">Zeit:</td><td><input type="text" name="zeit_angelegt" size="5" value="[ZEIT_ANGELEGT]" /> [MSGZEIT_ANGELEGT]</td></tr>
         <tr><td width="">Bezeichnung:</td><td colspan="3"><input type="text" name="bezeichnung" value="[BEZEICHNUNG]" /> [MSGBEZEICHNUNG]</td></tr>
         <tr><td width="">Bearbeiter:</td><td colspan="3"><input type="text" name="adresse" value="[ADRESSE]" /> [MSGADRESSE]</td></tr>
         <tr><td>Beschreibung:</td><td colspan="3"><textarea name="beschreibung" >[BESCHREIBUNG]</textarea>[MSGBESCHREIBUNG]</td></tr>
         <tr><td colspan="4">Wiedervorlage:</td></tr>
         <tr><td width="">Datum:</td><td><input type="text" name="datum_erinnerung" size="5" value="[DATUM_ERINNERUNG]"/> [MSGDATUM_ERINNERUNG]</td><td width="">Zeit:</td><td><input type="text" name="zeit_erinnerung" size="5" value="[ZEIT_ERINNERUNG]" /> [MSGZEIT_ERINNERUNG]</td></tr>
         <tr><td width="">Mitarbeiter:</td><td colspan="3"><input type="text" name="adresse_mitarbeiter" value="[ADRESSE_MITARBEITER]" /> [MSGADRESSE_MITARBEITER]</td></tr>
         <tr><td width="200">abgeschlossen:</td><td colspan="3"><input type="checkbox" name="abgeschlossen" value="1" [ABGESCHLOSSEN] />[MSGABGESCHLOSSEN]</td></tr>

       */

    }

    $this->app->Tpl->Parse('PAGE',"angebot_wiedervorlage.tpl");
  }

  function AngebotPositionen()
  {

    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->AngebotNeuberechnen($id);
    $this->app->YUI->AARLGPositionen(false);

    return;


    $this->AngebotMenu();
    $id = $this->app->Secure->GetGET("id");

    /* neu anlegen formular */
    $artikelart = $this->app->Secure->GetPOST("artikelart");
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


    $angebotsart = $this->app->DB->Select("SELECT angebotsart FROM angebot WHERE id='$id' LIMIT 1");
    $lieferant  = $this->app->DB->Select("SELECT adresse FROM angebot WHERE id='$id' LIMIT 1");

    $anlegen_artikelneu = $this->app->Secure->GetPOST("anlegen_artikelneu");

    if($anlegen_artikelneu!="")
    {

      if($bezeichnung!="" && $menge!="" && $preis!="")
      {
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM angebot_position WHERE angebot='$id' LIMIT 1");
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

        $this->app->DB->Insert("INSERT INTO angebot_position (id,angebot,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
            VALUES ('','$id','$artikel_id','$bezeichnung','$neue_nummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuerklasse','angelegt','$projekt','$vpe')");

        header("Location: index.php?module=angebot&action=positionen&id=$id");
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
      $sort = $this->app->DB->Select("SELECT MAX(sort) FROM angebot_position WHERE auftrag='$id' LIMIT 1");
      $sort = $sort + 1;
      $artikel_id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' LIMIT 1");
      $bezeichnung = $artikel;
      $neue_nummer = $nummer;
      $waehrung = 'EUR';
      $umsatzsteuerklasse = $this->app->DB->Select("SELECT umsatzsteuerklasse FROM artikel WHERE nummer='$nummer' LIMIT 1");
      $vpe = 'einzeln';

      $this->app->DB->Insert("INSERT INTO angebot_position (id,angebot,artikel,bezeichnung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe) 
          VALUES ('','$id','$artikel_id','$bezeichnung','$neue_nummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuerklasse','angelegt','$projekt','$vpe')");
    }
    $weiter = $this->app->Secure->GetPOST("weiter");
    if($weiter!="")
    {
      header("Location: index.php?module=angebot&action=freigabe&id=$id");
      exit;
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

      $this->app->Tpl->Set('SUBSUBHEADING',"Neuen Artikel anlegen");
      $this->app->Tpl->Parse('INHALT',"angebot_artikelneu.tpl");
      $this->app->Tpl->Set('EXTEND',"<input type=\"submit\" value=\"Artikel unter Stammdaten anlegen\" name=\"anlegen_artikelneu\">");
      $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
      $this->app->Tpl->Set('EXTEND',"");
      $this->app->Tpl->Set('INHALT',"");

      /* ende neu anlegen formular */


      $this->app->Tpl->Set('SUBSUBHEADING',"Artikelstamm");

      $lieferant = $this->app->DB->Select("SELECT adresse FROM angebot WHERE id='$id' LIMIT 1");

      $table = new EasyTable($this->app);
      $table->Query("SELECT CONCAT(LEFT(a.name_de,80),'...') as artikel, a.nummer, 
          v.ab_menge as ab, v.preis, p.abkuerzung as projekt,
          CONCAT('<input type=\"text\" size=\"8\" value=\"00.00.0000\" id=\"datum',v.id,'\">
            <img src=\"./themes/new/images/kalender.png\" height=\"12\" onclick=\"displayCalendar(document.forms[1].datum',v.id,',\'dd.mm.yyyy\',this)\" border=0 align=right>') as Lieferdatum, 
          CONCAT('<input type=\"text\" size=\"3\" value=\"\" id=\"menge',v.id,'\">') as menge, v.id as id
          FROM artikel a LEFT JOIN verkaufspreise v ON a.id=v.artikel LEFT JOIN projekt p ON v.projekt=p.id WHERE v.ab_menge>=1");
      $table->DisplayNew('INHALT', "<input type=\"button\" 
          onclick=\"document.location.href='index.php?module=angebot&action=addposition&id=$id&sid=%value%&menge=' + document.getElementById('menge%value%').value + '&datum=' + document.getElementById('datum%value%').value;\" value=\"anlegen\">");
      $this->app->Tpl->Parse('UEBERSICHT',"rahmen70.tpl");
      $this->app->Tpl->Set('INHALT',"");

      // child table einfuegen

      $this->app->Tpl->Set('SUBSUBHEADING',"Positionen");
      $menu = array("up"=>"upangebotposition",
          "down"=>"downangebotposition",
          //"add"=>"addstueckliste",
          "edit"=>"positioneneditpopup",
          "del"=>"delangebotposition");

      $sql = "SELECT a.name_de as Artikel, p.abkuerzung as projekt, a.nummer as nummer, b.nummer as nummer, DATE_FORMAT(lieferdatum,'%d.%m.%Y') as lieferdatum, b.menge as menge, b.preis as preis, b.id as id
        FROM angebot_position b
        LEFT JOIN artikel a ON a.id=b.artikel LEFT JOIN projekt p ON b.projekt=p.id 
        WHERE b.angebot='$id'";

      //      $this->app->Tpl->Add(EXTEND,"<input type=\"submit\" value=\"Gleiche Positionen zusammenf&uuml;gen\">");

      $this->app->YUI->SortListAdd('INHALT',$this,$menu,$sql);
      $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

      if($anlegen_artikelneu!="")
        $this->app->Tpl->Set('AKTIV_TAB2',"selected");
      else
        $this->app->Tpl->Set('AKTIV_TAB1',"selected");
      $this->app->Tpl->Parse('PAGE',"angebot_positionuebersicht.tpl");
    } 
  }

  function DelAngebotPosition()
  {
    $this->app->YUI->SortListEvent("del","angebot_position","angebot");
    $this->AngebotPositionen();
  }

  function UpAngebotPosition()
  {
    $this->app->YUI->SortListEvent("up","angebot_position","angebot");
    $this->AngebotPositionen();
  }

  function DownAngebotPosition()
  {
    $this->app->YUI->SortListEvent("down","angebot_position","angebot");
    $this->AngebotPositionen();
  }


  function AngebotPositionenEditPopup()
  {
    $id = $this->app->Secure->GetGET("id");

    $artikel= $this->app->DB->Select("SELECT artikel FROM angebot_position WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('ANZEIGEEINKAUFLAGER',$this->app->erp->AnzeigeEinkaufLager($artikel));

    // nach page inhalt des dialogs ausgeben
    $widget = new WidgetAngebot_position($this->app,'PAGE');
    $sid= $this->app->DB->Select("SELECT angebot FROM angebot_position WHERE id='$id' LIMIT 1");
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=angebot&action=positionen&id=$sid");
    $widget->Edit();
    $this->app->BuildNavigation=false;
  }



  function AngebotIconMenu($id,$prefix="")
  { 

    $status = $this->app->DB->Select("SELECT status FROM angebot WHERE id='$id' LIMIT 1");

    if($status=="angelegt")
      $freigabe = "<option value=\"freigabe\">Angebot freigeben</option>";

    $menu ="

      <script type=\"text/javascript\">
      function onchangeangebot(cmd)
      {
        switch(cmd)
        {
          case 'storno': if(!confirm('Wirklich stornieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=angebot&action=delete&id=%value%'; break;
          case 'kopievon': if(!confirm('Wirklich neue Version anlegen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=angebot&action=kopievon&id=%value%'; break;
          case 'pdf': window.location.href='index.php?module=angebot&action=pdf&id=%value%'; document.getElementById('aktion$prefix').selectedIndex = 0; break;
          case 'copy': if(!confirm('Wirklich kopieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=angebot&action=copy&id=%value%'; break;
          case 'auftrag': if(!confirm('Wirklich als Auftrag weiterführen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=angebot&action=auftrag&id=%value%'; break;
          case 'abschicken':  ".$this->app->erp->DokumentAbschickenPopup()." break;

          case 'freigabe':  window.location.href='index.php?module=angebot&action=freigabe&id=%value%'; break;
        }
      }
    </script>
      Aktion:&nbsp;<select onchange=\"onchangeangebot(this.value)\" id=\"aktion$prefix\"><option>bitte w&auml;hlen ...</option>
      <option value=\"storno\">Angebot stornieren</option>
      <option value=\"copy\">Angebot kopieren</option>
      <option value=\"kopievon\">Angebot anpassen</option>
      $freigabe
      <option value=\"abschicken\">Angebot abschicken</option>
      <option value=\"auftrag\">als Auftrag weiterf&uuml;hren</option>
      <option value=\"pdf\">PDF &ouml;ffnen</option>
      </select>&nbsp;


    <a href=\"index.php?module=angebot&action=pdf&id=%value%\" title=\"PDF\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
      <!--
      <a href=\"index.php?module=angebot&action=edit&id=%value%\" title=\"Bearbeiten\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
      <a onclick=\"if(!confirm('Wirklich stornieren?')) return false; else window.location.href='index.php?module=angebot&action=delete&id=%value%';\">
      <img src=\"./themes/new/images/delete.gif\" title=\"Stornieren\" border=\"0\"></a>
      <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=angebot&action=copy&id=%value%';\" title=\"Kopieren\">
      <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
      <a onclick=\"if(!confirm('Wirklich als Auftrag weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=angebot&action=auftrag&id=%value%';\" title=\"Als Auftrag weiterf&uuml;hren\">
      <img src=\"./themes/new/images/lieferung.png\" border=\"0\" alt=\"weiterf&uuml;hren als Lieferschein\"></a>-->";

    //$tracking = $this->AuftragTrackingTabelle($id);

    $menu = str_replace('%value%',$id,$menu);
    return $menu;
  }


  function AngebotEdit()
  {
    $action = $this->app->Secure->GetGET("action");
    $id = $this->app->Secure->GetGET("id");
    //   $this->app->erp->AngebotNeuberechnen($id);

    if($this->app->erp->DisableModul("angebot",$id))
    {
      //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","Zur&uuml;ck zur &Uuml;bersicht");
      $this->AngebotMenu();
      return;
    }


    $adresse = $this->app->DB->Select("SELECT adresse FROM angebot WHERE id='$id' LIMIT 1");
    if($adresse <=0)
    {
      $this->app->Tpl->Add('JAVASCRIPT','$(document).ready(function() { if(document.getElementById("adresse"))document.getElementById("adresse").focus(); });');
      $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Achtung! Dieses Dokument ist mit keinem Kunden-Nr. verlinkt. Bitte geben Sie die Kundennummer an und klicken Sie &uuml;bernehmen oder Speichern!</div>");
    }

    $kopievon= $this->app->DB->Select("SELECT kopievon FROM angebot WHERE id='$id' LIMIT 1");
    $kopienummer= $this->app->DB->Select("SELECT kopienummer FROM angebot WHERE id='$id' LIMIT 1");

    $hauptid = $id;
    while(1)
    { 
      $checkkopievon = $this->app->DB->Select("SELECT kopievon FROM angebot WHERE id='$hauptid' LIMIT 1");
      if($checkkopievon > 0)
        $hauptid = $checkkopievon;
      else break;
      $timeout++;
      if($timeout > 100) break;
    }
    $kopienummermax= $this->app->DB->Select("SELECT MAX(kopienummer)+1 FROM angebot WHERE id='$hauptid' LIMIT 1");
    $kopie_von_angebot_nummer= $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$hauptid' LIMIT 1");


    if($kopievon>0)
    { 
      $this->app->Tpl->Add('MESSAGE',"<div class=\"warning\">Dies ist Version $kopienummer des Angebots: <a href=\"index.php?module=angebot&action=edit&id=$hauptid\" target=\"_blank\">$kopie_von_angebot_nummer</a></div>");
    }

    $anzahlkopieen = $this->app->DB->SelectArr("SELECT id,belegnr FROM angebot WHERE kopievon='$id' ORDER by belegnr");
    if(count($anzahlkopieen) > 0)
    { 
      for($ati=0;$ati<count($anzahlkopieen);$ati++)
      {               $this->app->Tpl->Add('MESSAGE',"<div class=\"info\">Zu diesem Angebot geh&ouml;ren das weitere Angebot Nr. <a href=\"index.php?module=angebot&action=edit&id=".$anzahlkopieen[$ati]['id']."\" target=\"_blank\">".$anzahlkopieen[$ati]['belegnr']."</a></div>");
      }
    } 



    $this->app->erp->InfoAuftragsErfassung("angebot",$id);

    $this->app->erp->DisableVerband();
    $this->app->erp->CheckBearbeiter($id,"angebot");
    $this->app->erp->CheckVertrieb($id,"angebot");


    $this->app->YUI->AARLGPositionen();

    $icons = $this->app->YUI->IconsSQLAll();
    $icons = $this->app->DB->Select("SELECT $icons FROM angebot a WHERE a.id='$id' LIMIT 1");

    $this->app->Tpl->Set('STATUSICONS',$icons);


    //$this->AngebotMiniDetail(MINIDETAIL,false);


    $belegnr = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
    $nummer = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
    $adresse = $this->app->DB->Select("SELECT adresse FROM angebot WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1");

    $status= $this->app->DB->Select("SELECT status FROM angebot WHERE id='$id' LIMIT 1");
    $schreibschutz= $this->app->DB->Select("SELECT schreibschutz FROM angebot WHERE id='$id' LIMIT 1");

    if($status != "angelegt" && $status != "angelegta" && $status != "a")
    {
      $Brief = new Briefpapier($this->app);
      if($Brief->zuArchivieren($id, "angebot"))$this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Das Angebot ist noch nicht archiviert! Bitte versenden oder manuell archivieren.<input type=\"button\" onclick=\"if(!confirm('Soll das Dokument archiviert werden?')) return false;else window.location.href='index.php?module=angebot&action=archivierepdf&id=$id';\" value=\"Manuell archivieren\" /></div>");
    }

    $liefersperre= $this->app->DB->Select("SELECT liefersperre FROM adresse WHERE id='$adresse' LIMIT 1");
    if($liefersperre=="1" && ($status=="freigegeben" || $status=="angelegt"))
    {
      $this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Achtung: Der Kunde hat eine Liefersperre!</div>");
    }



    $this->app->Tpl->Set('ICONMENU',$this->AngebotIconMenu($id));
    $this->app->Tpl->Set('ICONMENU2',$this->AngebotIconMenu($id,2));

    if($schreibschutz!="1" && $this->app->erp->RechteVorhanden("angebot","schreibschutz"))
    {
      $this->app->erp->AnsprechpartnerButton($adresse);
      $this->app->erp->LieferadresseButton($adresse);
      $this->app->erp->AnsprechpartnerAlsLieferadresseButton($adresse);
    }

    if($nummer!="")
    {
      $this->app->Tpl->Set('NUMMER',$nummer);
      $this->app->Tpl->Set('KUNDE',"&nbsp;&nbsp;&nbsp;Kd-Nr.".$kundennummer);
    }


    if($this->app->Secure->GetPOST("speichern")!="")
    {
      $abweichenderechnungsadresse = $this->app->Secure->GetPOST("abweichenderechnungsadresse");
      $abweichendelieferdresse = $this->app->Secure->GetPOST("abweichendelieferadresse");
    } else {
      $abweichenderechnungsadresse = $this->app->DB->Select("SELECT abweichenderechnungsadresse FROM angebot WHERE id='$id' LIMIT 1");
      $abweichendelieferadresse = $this->app->DB->Select("SELECT abweichendelieferadresse FROM angebot WHERE id='$id' LIMIT 1");
    }
    if($abweichenderechnungsadresse) $this->app->Tpl->Set('RECHNUNGSADRESSE',"visible"); else $this->app->Tpl->Set('RECHNUNGSADRESSE',"none");
    if($abweichendelieferadresse) $this->app->Tpl->Set('LIEFERADRESSE',"visible"); else $this->app->Tpl->Set('LIEFERADRESSE',"none");

    if($belegnr=="" || $belegnr=="0")
    {
      $this->app->Tpl->Set('LOESCHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=angebot&action=delete&id=$id';\">");
    }
    $status= $this->app->DB->Select("SELECT status FROM angebot WHERE id='$id' LIMIT 1");
    if($status=="")
      $this->app->DB->Update("UPDATE angebot SET status='angelegt' WHERE id='$id' LIMIT 1");


    if($schreibschutz=="1" && $this->app->erp->RechteVorhanden("angebot","schreibschutz"))
    {
      $auftrag = $this->app->DB->SelectArr("SELECT id,belegnr FROM auftrag WHERE angebotid='$id'");
      for($auftragi=0;$auftragi< count($auftrag); $auftragi++)
      {
        $optional .= "&nbsp;<input type=\"button\" value=\"AB ".$auftrag[$auftragi]['belegnr']."\" onclick=\"window.location.href='index.php?module=auftrag&action=edit&id=".$auftrag[$auftragi]['id']."'\">";
      }

      if($optional!="") { 
        $optional = "Zum Auftrag: ".$optional;
      } else {
        $hinweis = "<div class=\"info\">Zu diesem Angebot gibt es noch keinen Auftrag.</div>";
      }

      $this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">Dieses Angebot wurde bereits versendet und darf daher nicht mehr bearbeitet werden!&nbsp;<input type=\"button\" value=\"Schreibschutz entfernen\" onclick=\"if(!confirm('Soll der Schreibschutz f&uuml;r dieses Angebot wirklich entfernt werden?')) return false;else window.location.href='index.php?module=angebot&action=schreibschutz&id=$id';\">&nbsp;$optional</div>$hinweis");
      $this->app->erp->CommonReadonly();
    }

    if($schreibschutz=="1") 
      $this->app->erp->CommonReadonly();


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
      $tmp = trim($tmp);
      $rest = explode(" ",$tmp);
      $kundennummer = $rest[0];

      $adresse =  $this->app->DB->Select("SELECT id FROM adresse WHERE kundennummer='$kundennummer'  AND geloescht=0 LIMIT 1");

      $uebernehmen =$this->app->Secure->GetPOST("uebernehmen");
      if($uebernehmen=="1") // nur neuladen bei tastendruck auf uebernehmen // FRAGEN!!!!
      {
        $this->app->erp->LoadAngebotStandardwerte($id,$adresse);
        header("Location: index.php?module=angebot&action=edit&id=$id");
        exit;
      }
    }

    $table = new EasyTable($this->app);
    $table->Query("SELECT bezeichnung as artikel, nummer as Nummer, menge, vpe as VPE, FORMAT(preis,4) as preis
        FROM angebot_position 
        WHERE angebot='$id'");
    $table->DisplayNew('POSITIONEN',"Preis","noAction");

    // $bearbeiter = $this->app->DB->Select("SELECT bearbeiter FROM angebot WHERE id='$id' LIMIT 1");
    // $this->app->Tpl->Set(BEARBEITER,"<input type=\"text\" value=\"".$this->app->erp->GetAdressName($bearbeiter)."\" readonly>");


    $status= $this->app->DB->Select("SELECT status FROM angebot WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('STATUS',"<input type=\"text\" size=\"30\" value=\"".$status."\" readonly [COMMONREADONLYINPUT]>");

    $angebot = $this->app->DB->Select("SELECT belegnr FROM angebot WHERE id='$id' LIMIT 1");
    if($angebot=="0" || $angebot=="") $angebot="keine Nummer";
    $this->app->Tpl->Set('ANGEBOT',"<input type=\"text\" value=\"".$angebot."\" readonly>");



    $zahlungsweise = $this->app->DB->Select("SELECT zahlungsweise FROM angebot WHERE id='$id' LIMIT 1");
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


    $abweichendelieferadresse= $this->app->DB->Select("SELECT abweichendelieferadresse FROM angebot WHERE id='$id' LIMIT 1");
    if($this->app->Secure->GetPOST("abweichendelieferadresse")!="") $versandart = $this->app->Secure->GetPOST("abweichendelieferadresse");
    $this->app->Tpl->Set('ABWEICHENDELIEFERADRESSESTYLE',"none");
    if($abweichendelieferadresse=="1") $this->app->Tpl->Set('ABWEICHENDELIEFERADRESSESTYLE',"");


    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    parent::AngebotEdit();


    /*
       if($this->app->Secure->GetPOST("speichern")!="" && $storno=="")
       {

       if($this->app->Secure->GetGET("msg")=="")
       {
       $msg = $this->app->Tpl->Get(MESSAGE)." ";
       $msg = $this->app->erp->base64_url_encode($msg);
       } else {
       $msg = $this->app->Secure->GetGET("msg");
    //$msg = $this->app->erp->base64_url_encode($msg);
    }
    header("Location: index.php?module=angebot&action=edit&id=$id&msg=$msg");
    exit;
    } 
     */
    $this->app->erp->MessageHandlerStandardForm();

    /*
       $summe = $this->app->DB->Select("SELECT SUM(menge*preis) FROM angebot_position
       WHERE angebot='$id'");

       $waehrung = $this->app->DB->Select("SELECT waehrung FROM angebot_position
       WHERE angebot='$id' LIMIT 1");

       $ust_befreit_check = $this->app->DB->Select("SELECT ust_befreit FROM angebot WHERE id='$id' LIMIT 1");
       $summebrutto  = $summe *1.19;

       if($ust_befreit_check==0)
       $tmp = "Kunde zahlt mit UST";
       else if($ust_befreit_check==1)
       $tmp = "Kunde ist UST befreit";
       else
       $tmp = "Kunde zahlt keine UST";


       if($summe > 0)
       $this->app->Tpl->Add(POSITIONEN, "<br><center>Zu zahlen: <b>$summe (netto) $summebrutto (brutto) $waehrung</b> ($tmp)&nbsp;&nbsp;");

     */
    if($this->app->Secure->GetPOST("weiter")!="")
    {
      header("Location: index.php?module=angebot&action=positionen&id=$id");
      exit;
    }
    $this->AngebotMenu();

  }

  function AngebotCreate()
  {
    //$this->app->Tpl->Add(TABS,"<li><h2>Angebot</h2></li>");

    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Angebot anlegen");
    $this->app->erp->MenuEintrag("index.php?module=angebot&action=list","Zur&uuml;ck zur &Uuml;bersicht");


    $anlegen = $this->app->Secure->GetGET("anlegen");

    if($this->app->erp->Firmendaten("schnellanlegen")=="1" && $anlegen!="1")
    {
      header("Location: index.php?module=angebot&action=create&anlegen=1");
      exit;
    }


    if($anlegen != "")
    {
      $id = $this->app->erp->CreateAngebot();
      $this->app->erp->AngebotProtokoll($id,"Angebot angelegt");
      header("Location: index.php?module=angebot&action=edit&id=$id");
      exit;
    }
    $this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">M&ouml;chten Sie eine Angebot jetzt anlegen? &nbsp;
        <input type=\"button\" onclick=\"window.location.href='index.php?module=angebot&action=create&anlegen=1'\" value=\"Ja - Angebot jetzt anlegen\"></div><br>");
    $this->app->Tpl->Set('TAB1',"
        <table width=\"100%\" style=\"background-color: #fff; border: solid 1px #000;\" align=\"center\">
        <tr>
        <td align=\"center\">
        <br><b style=\"font-size: 14pt\">Angebote in Bearbeitung</b>
        <br>
        <br>
        Offene Angebote, die durch andere Mitarbeiter in Bearbeitung sind.
        <br>
        </td>
        </tr>
        </table>
        <br>
        [ANGEBOTE]");


    $this->app->Tpl->Set('AKTIV_TAB1',"selected");

    $this->app->YUI->TableSearch('ANGEBOTE',"angeboteinbearbeitung");
    /*
       $table = new EasyTable($this->app);
       $table->Query("SELECT DATE_FORMAT(datum,'%d.%m.%y') as vom, if(belegnr,belegnr,'ohne Nummer') as beleg, name, vertrieb, status, id
       FROM angebot WHERE status='angelegt' order by datum DESC, id DESC");
       $table->DisplayNew(ANGEBOTE, "<a href=\"index.php?module=angebot&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
       <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=angebot&action=delete&id=%value%';\">
       <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
       <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=angebot&action=copy&id=%value%';\">
       <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
       ");
     */

    $this->app->Tpl->Set('TABTEXT',"Angebot anlegen");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
    //parent::AngebotCreate();
  }


  function AngebotList()
  {

    //    $this->app->Tpl->Set('UEBERSCHRIFT',"Angebote");
    //    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Angebote");



    $backurl = $this->app->Secure->GetGET("backurl");
    $msg = $this->app->Secure->GetGET("msg");
    $backurl = $this->app->erp->base64_url_decode($backurl);

    //$this->app->Tpl->Add(TABS,"<li><h2 class=\"allgemein\" style=\"background-color: [FARBE2]\">Allgemein</h2></li>");
    $this->app->erp->MenuEintrag("index.php?module=angebot&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=angebot&action=create","Neues Angebot anlegen");

    if(strlen($backurl)>5)
      $this->app->erp->MenuEintrag("$backurl","Zur&uuml;ck zur &Uuml;bersicht");
    else
      $this->app->erp->MenuEintrag("index.php","Zur&uuml;ck zur &Uuml;bersicht");


    $zahlungsweisen = $this->app->DB->SelectArr('
        SELECT
        zahlungsweise
        FROM
        angebot
        GROUP BY
        zahlungsweise
        ');

    $zahlungsweiseStr = '';
    if ($zahlungsweisen) {
      foreach ($zahlungsweisen as $zahlungsweise) {
        $zahlungsweiseStr .= '<option name="' . $zahlungsweise['zahlungsweise'] . '">' . ucfirst($zahlungsweise['zahlungsweise']) . '</option>';
      }
    }

    $status = $this->app->DB->SelectArr('
        SELECT
        status
        FROM
        angebot
        GROUP BY
        status
        ');

    $statusStr = '';
    if ($status) {
      foreach ($status as $statusE) {
        $statusStr .= '<option name="' . $statusE['status'] . '">' . ucfirst($statusE['status']) . '</option>';
      }
    }

    $versandarten = $this->app->DB->SelectArr('
        SELECT
        versandart
        FROM
        angebot
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
    $this->app->YUI->AutoComplete("angebotsnummer", "angebot", 1);

    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->Tpl->Set('INHALT',"");


    //$this->AngebotFilter();

    $this->app->YUI->TableSearch('TAB2',"angeboteoffene");

    $this->app->Tpl->Add('ZAHLUNGSWEISEN',$zahlungsweiseStr);
    $this->app->Tpl->Add('STATUS',$statusStr);
    $this->app->Tpl->Add('VERSANDARTEN',$versandartenStr);
    $this->app->Tpl->Add('LAENDER',$laenderStr);

    $this->app->Tpl->Parse('TAB1',"angebot_table_filter.tpl");

    $this->app->YUI->TableSearch('TAB1',"angebote");
    $this->app->YUI->TableSearch('TAB3',"angeboteinbearbeitung");

    $this->app->Tpl->Parse('PAGE',"angebotuebersicht.tpl");

    return;

    /*
    // suche
    $sql = $this->app->erp->AngebotSuche();

    // offene Angeboten
    $this->app->Tpl->Set('SUBSUBHEADING',"Offene Angebote");

    $table = new EasyTable($this->app);
    $table->Query($sql,$_SESSION[angebottreffer]);

    //$table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as vom, if(a.belegnr,a.belegnr,'ohne Nummer') as Angebot, a.name, p.abkuerzung as projekt, a.id
    //  FROM angebot a, projekt p WHERE (a.status='freigegeben' OR a.status='versendet') AND p.id=a.projekt order by a.datum DESC, a.id DESC",10);


    $table->DisplayOwn(INHALT, "<a href=\"index.php?module=angebot&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
    <a href=\"index.php?module=angebot&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
    <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=angebot&action=copy&id=%value%';\">
    <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
    <a onclick=\"if(!confirm('Weiterf&uuml;fhren als Auftrag?')) return false; else window.location.href='index.php?module=angebot&action=auftrag&id=%value%';\">
    <img src=\"./themes/new/images/right.png\" border=\"0\"></a>

    ");
    $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

    $this->app->Tpl->Set('INHALT',"");
    // wartende Angeboten

    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%y') as vom, if(a.belegnr,a.belegnr,'ohne Nummer') as Angebot, ad.kundennummer as kunde, a.name, p.abkuerzung as projekt, a.id
    FROM angebot a, projekt p, adresse ad WHERE (a.status='freigegeben' OR a.status='versendet') AND p.id=a.projekt AND a.adresse=ad.id order by a.datum DESC, a.id DESC");
    $table->DisplayNew('INHALT', "<a href=\"index.php?module=angebot&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
    <a href=\"index.php?module=angebot&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
    <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=angebot&action=copy&id=%value%';\">
    <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
    ");
    $this->app->Tpl->Parse(TAB2,"rahmen70.tpl");


    $this->app->Tpl->Set('INHALT',"");
    // In Bearbeitung
    $this->app->Tpl->Set('SUBSUBHEADING',"In Bearbeitung");
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(datum,'%d.%m.%y') as vom, if(belegnr,belegnr,'ohne Nummer') as auftrag, name, vertrieb, status, id
    FROM angebot WHERE status='angelegt' order by datum DESC, id DESC");
    $table->DisplayNew('INHALT', "<a href=\"index.php?module=angebot&action=edit&id=%value%\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
    <a onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=angebot&action=delete&id=%value%';\">
    <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
    <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=angebot&action=copy&id=%value%';\">
    <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
    ");

    $this->app->Tpl->Parse(TAB3,"rahmen70.tpl");
     */


    /*
       $this->app->Tpl->Set(TAB2,"lieferant, angebot, waehrung, sprache, liefertermin, steuersatz, einkäufer, freigabe<br>
       <br>Angebot (NR),Bestellart (NB), Bestelldatum
       <br>Projekt
       <br>Kostenstelle pro Position
       <br>Terminangebot (am xx.xx.xxxx raus damit)
       <br>vorschlagsdaten für positionen
       <br>proposition reinklicken zum ändern und reihenfolge tabelle 
       <br>Angebot muss werden wie angebot (angebot beschreibung = allgemein)
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
