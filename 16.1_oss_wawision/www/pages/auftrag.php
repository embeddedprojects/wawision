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
include ("_gen/auftrag.php");

class Auftrag extends GenAuftrag
{

  function Auftrag(&$app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","AuftragList");
    $this->app->ActionHandler("create","AuftragCreate");
    $this->app->ActionHandler("positionen","AuftragPositionen");
    $this->app->ActionHandler("addposition","AuftragAddPosition");
    $this->app->ActionHandler("upauftragposition","UpAuftragPosition");
    $this->app->ActionHandler("delauftragposition","DelAuftragPosition");
    $this->app->ActionHandler("downauftragposition","DownAuftragPosition");
    $this->app->ActionHandler("positioneneditpopup","AuftragPositionenEditPopup");
    $this->app->ActionHandler("checkdisplay","AuftragCheckDisplayPopup");
    $this->app->ActionHandler("edit","AuftragEdit");
    $this->app->ActionHandler("tracking","AuftragTracking");
    $this->app->ActionHandler("ausversand","AuftragDeleteAusVersand");
    $this->app->ActionHandler("search","AuftragSuche");
    $this->app->ActionHandler("ean","AuftragEAN");
    $this->app->ActionHandler("uststart","AuftragUstStart");
    $this->app->ActionHandler("delete","AuftragDelete");
    $this->app->ActionHandler("anfrage","AuftragAnfrage");
    $this->app->ActionHandler("abschluss","AuftragAbschluss");
    $this->app->ActionHandler("copy","AuftragCopy");
    $this->app->ActionHandler("verfuegbar","AuftragVerfuegbar");
    $this->app->ActionHandler("rechnung","AuftragRechnung");
    $this->app->ActionHandler("lieferschein","AuftragLieferschein");
    $this->app->ActionHandler("lieferscheinrechnung","AuftragLieferscheinRechnung");

    $this->app->ActionHandler("nachlieferung","AuftragNachlieferung");
    //    $this->app->ActionHandler("versand","AuftragVersand");
    $this->app->ActionHandler("freigabe","AuftragFreigabe");
    $this->app->ActionHandler("abschicken","AuftragAbschicken");
    $this->app->ActionHandler("pdf","AuftragPDF");
    $this->app->ActionHandler("inlinepdf","AuftragInlinePDF");
    $this->app->ActionHandler("proforma","AuftragProforma");
    $this->app->ActionHandler("versand","AuftragVersand");
    $this->app->ActionHandler("zahlungsmail","AuftragZahlungsmail");
    $this->app->ActionHandler("reservieren","AuftragReservieren");
    $this->app->ActionHandler("nachlieferung","AuftragNachlieferung");
    $this->app->ActionHandler("protokoll","AuftragProtokoll");
    $this->app->ActionHandler("minidetail","AuftragMiniDetail");
    $this->app->ActionHandler("editable","AuftragEditable");
    $this->app->ActionHandler("dateien","AuftragDateien");
    $this->app->ActionHandler("livetabelle","AuftragLiveTabelle");
    $this->app->ActionHandler("zahlungsmahnungswesen","AuftragZahlungMahnungswesen");
    $this->app->ActionHandler("schreibschutz","AuftragSchreibschutz");
    $this->app->ActionHandler("shopexport","AuftragShopexport");
    $this->app->ActionHandler("deleterabatte","AuftragDeleteRabatte");
    $this->app->ActionHandler("kreditlimit","AuftragKreditlimit");
    $this->app->ActionHandler("updateverband","AuftragUpdateVerband");
    $this->app->ActionHandler("pdffromarchive","AuftragPDFfromArchiv");

    $this->app->ActionHandler("archivierepdf", "AuftragArchivierePDF");
    
    $this->app->DefaultActionHandler("list");

    $id = $this->app->Secure->GetGET("id");
    $nummer = $this->app->Secure->GetPOST("adresse");

    if($nummer=="")
      $adresse= $this->app->DB->Select("SELECT a.name FROM auftrag b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    else
      $adresse = $nummer;

    $nummer = $this->app->DB->Select("SELECT b.belegnr FROM auftrag b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
    if($nummer=="" || $nummer=="0") $nummer="ohne Nummer";

    $this->app->Tpl->Set('UEBERSCHRIFT',"Auftrag:&nbsp;".$adresse." (".$nummer.")");
    $this->app->Tpl->Set('FARBE',"[FARBE2]");


    $this->app->ActionHandlerListen($app);
  }

  function AuftragArchivierePDF()
  {
    $id = (int)$this->app->Secure->GetGET('id');
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id = '$id' LIMIT 1");
    $Brief = new AuftragPDF($this->app, $projekt);
    $Brief->GetAuftrag($id);
    $tmpfile = $Brief->displayTMP();
    $Brief->ArchiviereDocument();
    $this->app->DB->Update("UPDATE auftrag SET schreibschutz='1' WHERE id='$id'");
    header('Location: index.php?module=auftrag&action=edit&id='.$id);
    exit;
  }

  function AuftragEAN()
  {
    $id=$this->app->Secure->GetGET("id");
    $scanner=$this->app->Secure->GetPOST("scanner");

    $this->AuftragMenu();

    if($scanner!="")
    {
      $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$scanner' OR ean='$scanner' OR herstellernummer='$scanner'");
      if($artikelid > 0)
      {
        $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikelid'");
        $this->app->erp->AddArtikelAuftrag($artikelid,$id);
        // einfuegen von artikel mit standard preis
        $this->app->Tpl->Set('MESSAGE',"<div class=\"info\">Artikel <b>$name_de</b> 1 x eingef&uuml;gt.</div>");
      }
    }

    $this->app->Tpl->Parse('TAB1',"auftrag_ean.tpl");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function AuftragUpdateVerband()
  {
    $id=$this->app->Secure->GetGET("id");
    $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Verbandsinformation wurde neu geladen!</div>  ");
    header("Location: index.php?module=auftrag&action=edit&id=$id&msg=$msg");
    exit;
  }       

  function AuftragDeleteRabatte()
  {

    $id=$this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE auftrag SET rabatt='',rabatt1='',rabatt2='',rabatt3='',rabatt4='',rabatt5='',realrabatt='' WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Die Rabatte wurden entfernt!</div>  ");
    header("Location: index.php?module=auftrag&action=edit&id=$id&msg=$msg");
    exit;
  }       

  function AuftragShopexport()
  {
    $id=$this->app->Secure->GetGET("id");
    $shop=$this->app->DB->Select("SELECT shop FROM auftrag WHERE id='$id' LIMIT 1");
    $this->app->remote->RemoteUpdateAuftrag($shop,$id);
    //getPaymentInstruction
    //setOrderNumber
    //setInvoiceNumber
    //reportShipment
    //updateArticleList

  }

  function AuftragDateien()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->AuftragMenu();
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Dateien)");
    $this->app->YUI->DateiUpload('PAGE',"Auftrag",$id);
  }




  function AuftragSchreibschutz()
  {

    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE auftrag SET zuarchivieren='1' WHERE id='$id'");
    $this->app->DB->Update("UPDATE auftrag SET schreibschutz='0' WHERE id='$id'");
    header("Location: index.php?module=auftrag&action=edit&id=$id");
    exit;
  }


  function AuftragTracking()
  {
    $tracking = $this->app->Secure->GetGET("tracking");
    // Wir werden eine PDF Datei ausgeben
    header('Content-type: application/html');

    // Es wird downloaded.pdf benannt
    header('Content-Disposition: attachment; filename="'.$tracking.'.html"');

    // Die originale PDF Datei heißt original.pdf
    if(is_file('/var/data/userdata/tracking/'.$tracking.'.html'))
      readfile('/var/data/userdata/tracking/'.$tracking.'.html');
    exit;

  }


  function AuftragZahlungMahnungswesen()
  {

    $this->AuftragMenu();
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Set('TABTEXT',"Zahlung-/Mahnungswesen");
    $this->AuftragMiniDetail('TAB1',true);

    $this->app->Tpl->Parse('PAGE',"tabview.tpl");

  }



  function AuftragLiveTabelle()
  {
    $id = $this->app->Secure->GetGET("id");
    $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);

    if($status=="freigegeben")
    {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, ap.menge as Menge,
          if(a.lagerartikel,if(a.porto,'-',if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel) > ap.menge,(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),
                if((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel)>0,CONCAT('<font color=red><b>',(SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel),'</b></font>'),
                  '<font color=red><b>aus</b></font>'))),'-') as Lager
          FROM auftrag_position ap, artikel a WHERE ap.auftrag='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","Lager","noAction");
    } else {
      $table->Query("SELECT SUBSTRING(ap.bezeichnung,1,20) as artikel, ap.nummer as Nummer, if(a.lagerartikel,ap.menge,'-') as M
          FROM auftrag_position ap, artikel a WHERE ap.auftrag='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","Menge","noAction");
    }
    echo $artikel;
    exit;
  }




  function AuftragEditable()
  {
    $this->app->YUI->AARLGEditable();
  }


  function AuftragIconMenu($id,$prefix="")
  {
    $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
    $anfrageid = $this->app->DB->Select("SELECT anfrageid FROM auftrag WHERE id='$id' LIMIT 1");
    $kreditlimit_ok = $this->app->DB->Select("SELECT kreditlimit_ok FROM auftrag WHERE id='$id' LIMIT 1");

    if($status=="angelegt" || $status=="")
    {
      $freigabe = "<option value=\"freigabe\">Auftrag freigeben</option>";
      $freigabe .= "<option value=\"freigabemail\">Auftrag freigeben + AB per Mail</option>";
    }

    if($anfrageid > 0)
      $freigabe .= "<option value=\"anfrage\">in Anfrage r&uuml;ckf&uuml;hren</option>";

    if($this->app->erp->RechteVorhanden("auftrag","kreditlimit") && $kreditlimit_ok==0)
      $kreditlimit .= "<option value=\"kreditlimit\">Kreditlimit f&uuml;r diesen Auftrag freigeben</option>";


    $kommissionierart = $this->app->DB->Select("SELECT kommissionierverfahren FROM projekt WHERE id='$projekt' LIMIT 1");   
    $art = $this->app->DB->Select("SELECT art FROM auftrag WHERE id='$id' LIMIT 1");   

    if($status=="freigegeben")
    {
      $alleartikelreservieren = "<option value=\"reservieren\">alle Artikel reservieren</option>";


      if($kommissionierart == "zweistufig" || $kommissionierart == "lieferscheinlagerscan" || $kommissionierart=="lieferscheinscan")
      {
        if($art=="rechnung")
          $auswahlentsprechendkommissionierung = "<option value=\"versand\">Auftrag abschlie&szlig;en (ohne Lager)</option>";
	else
          $auswahlentsprechendkommissionierung = "<option value=\"versand\">an Versandzentrum &uuml;bergeben</option>";
      }
      else if($kommissionierart == "lieferschein" || $kommissionierart == "lieferscheinlager")
        $auswahlentsprechendkommissionierung = "<option value=\"versand\">Auftrag abschlie&szlig;en + auslagern</option>";
      else
        $auswahlentsprechendkommissionierung = "<option value=\"versand\">Auftrag abschlie&szlig;en (ohne Lager)</option>";
    }

    $menu ="

      <script type=\"text/javascript\">
      function onchangeauftrag(cmd)
      {
        switch(cmd)
        {
          case 'storno':    if(!confirm('Wirklich stornieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=delete&id=%value%'; break;
          case 'teillieferung':     window.location.href='index.php?module=auftrag&action=teillieferung&id=%value%'; break;
          case 'anfrage':   if(!confirm('Wirklich rückführen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=anfrage&id=%value%'; break;
          case 'kreditlimit':       if(!confirm('Wirklich Kreditlimit für diesen Auftrag freigeben?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=kreditlimit&id=%value%'; break;
          case 'copy': if(!confirm('Wirklich kopieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=copy&id=%value%'; break;
          case 'delivery': if(!confirm('Wirklich als Lieferschein weiterführen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=lieferschein&id=%value%'; break;
          case 'deliveryinvoice': if(!confirm('Wirklich als Lieferschein und Rechnung weiterführen und Artikel automatisch aus Lager abziehen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=lieferscheinrechnung&id=%value%'; break;
          case 'invoice': if(!confirm('Wirklich als Rechnung weiterführen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=rechnung&id=%value%'; break;
          case 'produktion': if(!confirm('Wirklich als Produktion weiterführen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=produktion&id=%value%'; break;
          case 'reservieren': if(!confirm('Sollen alle Artikel für diesen Auftrag reserviert werden?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=reservieren&id=%value%'; break;
          case 'pdf':  window.location.href='index.php?module=auftrag&action=pdf&id=%value%'; document.getElementById('aktion$prefix').selectedIndex = 0; break;
          case 'proforma': window.location.href='index.php?module=auftrag&action=proforma&id=%value%'; document.getElementById('aktion$prefix').selectedIndex = 0; break;
          case 'versand': if(!confirm('Wirklich als Versand weiterführen oder Auftrag abschliessen?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=versand&id=%value%'; break;
          case 'abschicken':  ".$this->app->erp->DokumentAbschickenPopup()." break;

          case 'freigabe':  window.location.href='index.php?module=auftrag&action=freigabe&id=%value%'; break;
          case 'abschluss': if(!confirm('Wirklich manuell ohne erstellen von Lieferschein und/oder Rechnung als abgeschlossen markieren?')) return document.getElementById('aktion$prefix').selectedIndex = 0; else window.location.href='index.php?module=auftrag&action=abschluss&id=%value%&abschluss=%value%'; break;
          case 'freigabemail':  window.location.href='index.php?module=auftrag&action=freigabe&id=%value%&freigabe=%value%&cmd=mail'; break;

        }
      }
    </script>


      Aktion:&nbsp;<select id=\"aktion$prefix\" onchange=\"onchangeauftrag(this.value);\">
      <option>bitte w&auml;hlen ...</option>
      <option value=\"storno\">Auftrag stornieren</option>
      <option value=\"copy\">Auftrag kopieren</option>
      $freigabe
      <option value=\"abschicken\">Auftrag abschicken</option>
      <option value=\"pdf\">PDF &ouml;ffnen</option>
      <option value=\"proforma\">Proforma Rechnung &ouml;ffnen</option>
      $alsproduktion
      <option value=\"delivery\">als Lieferschein weiterf&uuml;hren</option>
      <option value=\"invoice\">als Rechnung weiterf&uuml;hren</option>
      <option value=\"abschluss\">als abgeschlossen markieren</option>
      <!--<option value=\"deliveryinvoice\">manuell weiterf&uuml;hren + ausbuchen</option>-->
      $alleartikelreservieren
      $kreditlimit
      $teillieferungen
      $auswahlentsprechendkommissionierung
      </select>&nbsp;

    <a href=\"index.php?module=auftrag&action=pdf&id=%value%\" title=\"PDF\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
      <!--<a href=\"index.php?module=auftrag&action=proforma&id=%value%\" title=\"Proforma Rechnung\"><img border=\"0\" src=\"./themes/new/images/proforma.gif\"></a>-->
      <!--
      <a href=\"index.php?module=auftrag&action=edit&id=%value%\" title=\"Bearbeiten\"><img border=\"0\" src=\"./themes/new/images/edit.png\"></a>
      <a onclick=\"if(!confirm('Wirklich stornieren?')) return false; else window.location.href='index.php?module=auftrag&action=delete&id=%value%';\" title=\"Stornieren\">
      <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
      <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=auftrag&action=copy&id=%value%';\" title=\"Kopieren\">
      <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
      <a onclick=\"if(!confirm('Wirklich als Lieferschein weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=auftrag&action=lieferschein&id=%value%';\" title=\"weiterf&uuml;hren als Lieferschein\">
      <img src=\"./themes/new/images/lieferung.png\" border=\"0\"></a>
      <a onclick=\"if(!confirm('Wirklich als Rechnung weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=auftrag&action=rechnung&id=%value%';\" title=\"weiterf&uuml;hren als Rechnung\">
      <img src=\"./themes/new/images/rechnung.png\" border=\"0\"></a>

      <a onclick=\"if(!confirm('Sollen alle Artikel f&uuml;r diesen Auftrag reserviert werden?')) return false; else window.location.href='index.php?module=auftrag&action=reservieren&id=%value%';\" title=\"Reservieren\">
      <img src=\"./themes/new/images/reservieren.png\" border=\"0\"></a>

      <a onclick=\"if(!confirm('Wirklich als Versand weiterf&uuml;hren oder Auftrag abschlie&szlig;en?')) return false; else window.location.href='index.php?module=auftrag&action=versand&id=%value%';\" title=\"weiterf&uuml;hren als Versand\">
      <img src=\"./themes/new/images/versand.png\" border=\"0\" alt=\"weiterf&uuml;hren als Versand\"></a>-->";

    //$tracking = $this->AuftragTrackingTabelle($id);

    $menu = str_replace('%value%',$id,$menu);
    return $menu;
  }
  

  function AuftragTrackingTabelle($id)
  {
    $table = new EasyTable($this->app);

    $table->Query("SELECT if(v.versendet_am!='0000-00-00', DATE_FORMAT(v.versendet_am,'%d.%m.%Y'),CONCAT('Heute im Versand<br><a href=\"#\" onclick=\"if(!confirm(\'Auftrag wirklich aus dem Versand nehmen?\')) return false; else window.location.href=\'index.php?module=auftrag&action=ausversand&id=',v.id,'\'\">Aktuell im Versand <br>-> als RMA markieren</a>')) as datum, v.versandunternehmen as versand, v.tracking as L,
        CONCAT('<a href=\"index.php?module=lieferschein&action=pdf&id=',v.lieferschein,'\">',l.belegnr,'</a><br><a href=\"index.php?module=lieferschein&action=edit&id=',v.lieferschein,'\">zum LS</a>') as LS,
        CONCAT('<a href=\"index.php?module=rechnung&action=pdf&id=',v.rechnung,'\">',r.belegnr,'</a><br><a href=\"index.php?module=rechnung&action=edit&id=',v.rechnung,'\">zur RE</a>') as RE,
        if(tracking!='',CONCAT('<a href=\"http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc=',tracking,'\" target=\"_blank\">Online-Status</a>'),'') FROM versand v 
        LEFT JOIN lieferschein l ON v.lieferschein=l.id 
        LEFT JOIN rechnung r ON v.rechnung=r.id 
        WHERE l.auftragid='$id' AND l.auftrag!=''");

    $result = $table->DisplayNew("return","Tracking","noAction");

    $heuteimversand = $this->app->DB->Select("SELECT if(v.versendet_am!='0000-00-00', DATE_FORMAT(v.versendet_am,'%d.%m.%Y'),'Heute im Versand') as datum
        FROM versand v LEFT JOIN lieferschein l ON v.lieferschein=l.id WHERE l.auftragid='$id' AND l.auftrag!=''");

    if($heuteimversand=="Heute im Versand")
      $result .="<center><a href=\"\" onclick=\"if(!confirm('Wirklich RMA starten?')) return false; else window.location.href='index.php';\">RMA jetzt starten</a></center>";

    $count = $this->app->DB->Select("SELECT COUNT(v.id) FROM versand v
        LEFT JOIN lieferschein l ON v.lieferschein=l.id
        LEFT JOIN rechnung r ON v.rechnung=r.id
        WHERE l.auftragid='$id' AND l.auftrag!=''");

    if($count>0)
      return $result;
    else return  "Keine Versandinformationen vorhanden";
  }
  
  function AuftragPDFfromArchiv()
  {
    $id = $this->app->Secure->GetGET("id");
    $archiv = $this->app->DB->Select("SELECT table_id from pdfarchiv where id = '$id' LIMIT 1");
    if($archiv)
    {
      $projekt = $this->app->DB->Select("SELECT projekt from auftrag where id = '".(int)$archiv."'");
    }
    if($archiv)$Brief = new AuftragPDF($this->app,$projekt);
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

  function AuftragMiniDetail($parsetarget="",$menu=true)
  {
    $id=$this->app->Secure->GetGET("id");
    $startzeit = microtime(true);
    $auftragArr = $this->app->DB->SelectArr("SELECT * FROM auftrag WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='{$auftragArr[0]['projekt']}' LIMIT 1");
    $kundenname = $this->app->DB->Select("SELECT name FROM adresse WHERE id='{$auftragArr[0]['adresse']}' LIMIT 1");
    $this->app->Tpl->Set('KUNDE',"<a href=\"index.php?module=adresse&action=edit&id=".$auftragArr[0]['adresse']."\">".$kundennummer."</a> ".$kundenname);
    $this->app->Tpl->Set('PROJEKT',$projekt);
    $this->app->Tpl->Set('IHREBESTELLNUMMER',$auftragArr[0]['ihrebestellnummer']);
    $this->app->Tpl->Set('ZAHLWEISE',$auftragArr[0]['zahlungsweise']);
    $summebrutto = $this->app->DB->Select("SELECT gesamtsumme FROM auftrag WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('DECKUNGSBEITRAG',0);
    $this->app->Tpl->Set('DBPROZENT',0);    

    if($auftragArr[0]['ust_befreit']==0)
      $this->app->Tpl->Set('STEUER',"Deutschland");
    else if($auftragArr[0]['ust_befreit']==1)
      $this->app->Tpl->Set('STEUER',"EU-Lieferung");
    else
      $this->app->Tpl->Set('STEUER',"Export");

    $this->app->Tpl->Set('GESAMTSUMME',number_format($summebrutto,2,",",""));

    //ENDE ZUSTANDSAUTOMAT FARBEN



    $lieferschein = $this->app->DB->SelectArr("SELECT 
        CONCAT('<a href=\"index.php?module=lieferschein&action=edit&id=',l.id,'\">',if(l.belegnr='0' OR l.belegnr='','ENTWURF',l.belegnr),'</a>&nbsp;<a href=\"index.php?module=lieferschein&action=pdf&id=',l.id,'\"><img src=\"./themes/new/images/pdf.png\" title=\"Lieferschein PDF\" border=\"0\"></a>&nbsp;
          <a href=\"index.php?module=lieferschein&action=edit&id=',l.id,'\"><img src=\"./themes/new/images/edit.png\" title=\"Lieferschein bearbeiten\" border=\"0\"></a>') as lieferschein
        FROM lieferschein l WHERE l.auftragid='$id'");


    $lieferscheinid = $this->app->DB->Select("SELECT l.id
        FROM lieferschein l WHERE l.auftragid='$id' AND l.auftrag!='' LIMIT 1");

    $lieferscheinbelegnr = $this->app->DB->Select("SELECT l.belegnr
        FROM lieferschein l WHERE l.id='$id' LIMIT 1");


    if(count($lieferschein)>0)
    {
      for($li=0;$li<count($lieferschein);$li++)
      {
        $this->app->Tpl->Add('LIEFERSCHEIN',$lieferschein[$li]['lieferschein']);
        if($li<count($lieferschein))
          $this->app->Tpl->Add('LIEFERSCHEIN',"<br>");
      }
    }
    else
      $this->app->Tpl->Set('LIEFERSCHEIN',"-");

    /* rechnungen */
  
    $rechnung = $this->app->DB->SelectArr("SELECT 
        CONCAT('<a href=\"index.php?module=rechnung&action=edit&id=',r.id,'\">',if(r.belegnr='0' OR r.belegnr='','ENTWURF',r.belegnr),'&nbsp;<a href=\"index.php?module=rechnung&action=pdf&id=',r.id,'\"><img src=\"./themes/new/images/pdf.png\" title=\"Rechnung PDF\" border=\"0\"></a>&nbsp;
          <a href=\"index.php?module=rechnung&action=edit&id=',r.id,'\"><img src=\"./themes/new/images/edit.png\" title=\"Rechnung bearbeiten\" border=\"0\"></a>') as rechnung
        FROM rechnung r WHERE r.auftragid='$id'");

    $rechnungids = $this->app->DB->SelectArr("SELECT r.id FROM rechnung r WHERE r.auftragid='$id' AND r.auftrag!='' ");

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

    /* ende rechnungen */


    $tmpVersand = $this->app->DB->Select("SELECT if(v.versendet_am!='0000-00-00', CONCAT(v.versendet_am,' ',v.versandunternehmen),CONCAT('Heute im Versand<br><a href=\"#\" onclick=\"if(!confirm(\'Auftrag wirklich aus dem Versand nehmen?\')) return false; else window.location.href=\'index.php?module=auftrag&action=ausversand&id=',v.id,'\'\">Aktuell im Versand <br>-> als RMA markieren</a>')) as datum
        FROM versand v 
        LEFT JOIN lieferschein l ON v.lieferschein=l.id 
        LEFT JOIN rechnung r ON v.rechnung=r.id 
        WHERE l.auftragid='$id' AND l.auftrag!=''");

    $tracking = $this->app->DB->SelectArr("SELECT 
        if(versandunternehmen='dhl' OR versandunternehmen='intraship',if(tracking!='',CONCAT(UPPER(versandunternehmen),':<a href=\"http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc=',tracking,'\" target=\"_blank\">',tracking,'</a>
              <a href=\"index.php?module=auftrag&action=tracking&tracking=',l.id,'_',tracking,'\"><img src=\"./themes/new/images/pdf.png\" title=\"Tracking PDF\" border=\"0\"></a>
              '),'nicht vorhanden'),CONCAT(versandunternehmen,' ',tracking)) versand2, tracking as tracking2
        FROM versand v LEFT JOIN lieferschein l ON v.lieferschein=l.id WHERE l.auftragid='$id' AND l.auftrag!=''");


    for($counti=0;$counti < count($tracking); $counti++)
      if($tracking[$counti]['tracking2']!="")
        $tmp[]=$tracking[$counti]['versand2'];

    $tracking = implode(',',$tmp);

    if($tracking!="" && $tracking!=" ")
      $this->app->Tpl->Set('TRACKING',$tracking);
    else
    {
      $this->app->Tpl->Set('TRACKING',$tmpVersand);
      //$this->app->Tpl->Set(TRACKING,'-');
    }


    $icons = $this->app->YUI->IconsSQL();
    $icons = $this->app->DB->Select("SELECT $icons FROM auftrag a WHERE a.id='$id' LIMIT 1");
    $this->app->Tpl->Set('STATUSICONS',$icons);

    $this->app->Tpl->Set('STATUS',$auftragArr[0]['status']);
    $this->app->Tpl->Set('INTERNET',$auftragArr[0]['internet']);
    $this->app->Tpl->Set('TRANSAKTIONSNUMMER',$auftragArr[0]['transaktionsnummer']);

    if($menu)
    {
      $menu = $this->AuftragIconMenu($id);
      $this->app->Tpl->Set('MENU',$menu);
    }

    // ARTIKEL
    $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");

    $table = new EasyTable($this->app);

    if($status=="freigegeben" || $status=="angelegt")
    {
      $table->Query("SELECT 

          if(ap.explodiert_parent > 1,CONCAT('***',LEFT(if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung),40)),LEFT(if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung),40)) as artikel, 

          CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\">', ap.nummer,'</a>') as Nummer, ap.menge as Menge,

          if(a.lagerartikel,if(a.porto,'Porto',if(((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel)-IFNULL((SELECT SUM(r.menge) FROM lager_reserviert r WHERE r.artikel=ap.artikel AND r.objekt='auftrag' AND r.parameter!='$id'),0)) >= ap.menge,

           CONCAT(ifnull((SELECT SUM(l.menge) FROM lager_platz_inhalt l LEFT JOIN lager_platz lp ON lp.id=l.lager_platz WHERE l.artikel=ap.artikel AND lp.autolagersperre!=1 AND lp.sperrlager!=1),0),
                  if((SELECT SUM(l.menge) FROM lager_platz_inhalt l LEFT JOIN lager_platz lp ON lp.id=l.lager_platz WHERE l.artikel=ap.artikel AND lp.autolagersperre=1 AND lp.sperrlager!=1)>0,CONCAT(' + <a href=\"index.php?module=artikel&action=lager&id=',ap.artikel,'\" title=\"Nachschublager\"><font color=red><b>',(SELECT SUM(l.menge) FROM lager_platz_inhalt l LEFT JOIN lager_platz lp ON lp.id=l.lager_platz WHERE l.artikel=ap.artikel AND lp.autolagersperre=1 AND lp.sperrlager!=1),'(N)<b></font></a>'),'')
                  )


                ,
                if(((SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel) - IFNULL((SELECT SUM(r.menge) FROM lager_reserviert r WHERE r.artikel=ap.artikel AND r.objekt='auftrag' AND r.parameter!='$id'),0))>=0,CONCAT('<font color=red><b>',

                    (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel)

                    ,'</b></font>'),
                  '<font color=red><b>aus</b></font>'))),if(a.porto,'Porto',if(a.stueckliste,'Set','kein Lagerartikel'))) as Lager, 

            CONCAT(
                IFNULL((SELECT SUM(r.menge) FROM lager_reserviert r WHERE r.artikel=ap.artikel AND r.objekt='auftrag' AND r.parameter='$id' AND (r.posid=ap.id OR (r.artikel=ap.artikel AND r.posid=0))),'0')

                ,
                '&nbsp;von ',(SELECT SUM(r.menge) FROM lager_reserviert r WHERE r.artikel=ap.artikel )
                ,' (Gesamtres.)') as 'Resv. f&uuml;r Kunde'

              FROM auftrag_position ap, artikel a WHERE ap.auftrag='$id' AND a.id=ap.artikel  ORDER by ap.sort");

      $artikel = $table->DisplayNew("return","Res. f&uuml;r Kunde","noAction");
      /*
         $this->app->Tpl->Add(JAVASCRIPT,"
         var auto_refresh = setInterval(
         function ()
         {
         $('#artikeltabellelive$id').load('index.php?module=auftrag&action=livetabelle&id=$id').fadeIn('slow');
         }, 3000); // refresh every 10000 milliseconds
         ");
       */



    } else {
      //$table->Query("SELECT ap.bezeichnung as artikel, ap.nummer as Nummer, if(a.lagerartikel,ap.menge,'-') as Menge
      $table->Query("SELECT if(ap.explodiert_parent > 1,CONCAT('***',LEFT(if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung),40)),LEFT(if(CHAR_LENGTH(ap.beschreibung) > 0,CONCAT(ap.bezeichnung,' *'),ap.bezeichnung),40)) as artikel, CONCAT('<a href=\"index.php?module=artikel&action=edit&id=',ap.artikel,'\">', ap.nummer,'</a>') as Nummer, ap.menge as Menge
          FROM auftrag_position ap, artikel a WHERE ap.auftrag='$id' AND a.id=ap.artikel");
      $artikel = $table->DisplayNew("return","Menge","noAction");
    }

    $this->app->Tpl->Set('ARTIKEL','<div id="artikeltabellelive'.$id.'">'.$artikel.'</div>');


    //START ZUSTANDSAUTOMAT FARBEN
    if($auftragArr[0]['status']=="freigegeben")
    {
      $this->app->Tpl->Set('VERSANDFARBE',"red");
      $this->app->Tpl->Set('VERSANDTEXT',"Noch nicht versendet!");
    } else if ($auftragArr[0]['status']=="abgeschlossen")
    {
      $this->app->Tpl->Set('VERSANDFARBE',"green");
      $this->app->Tpl->Set('VERSANDTEXT',"versendet!");
    }  else {
      $this->app->Tpl->Set('VERSANDFARBE',"grey");
      $this->app->Tpl->Set('VERSANDTEXT',"-");
    }


    $vorkasse_ok = $this->app->DB->Select("SELECT vorkasse_ok FROM auftrag WHERE id='$id' LIMIT 1");
    $zahlungsweise = $auftragArr[0]['zahlungsweise'];
    if($vorkasse_ok==1){
      if($zahlungsweise=="vorkasse" || $zahlungsweise=="paypal" || $zahlungsweise=="kreditkarte") {$this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"info\">Der Auftrag wurde bezahlt.</div>");}
      else if ($zahlungsweise=="rechnung") { $this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"info\">Der Auftrag wird per Rechnung bezahlt.</div>"); }
      else if ($zahlungsweise=="amazon") { $this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"info\">Der Auftrag wird per Amazon bezahlt.</div>"); }
      else if ($zahlungsweise=="lastschrift"||$zahlungsweise=="einzugsermaechtigung") { $this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"info\">Der Auftrag wird per Lastschrift bezahlt.</div>"); }
      else if ($zahlungsweise=="bar" || $zahlungsweise=="nachnahme" ) { $this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"success\">Der Auftrag wird bei &Uuml;bergabe bezahlt.</div>"); }
      else { $this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"error\">Fehler (Zahlungsweise fehlt)!</div>"); }
    }
    else if($vorkasse_ok==2){
			$this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"warning\">Es liegt eine Teilzahlung vor!</div>");
		}

    else  {
      if($zahlungsweise=="vorkasse" || $zahlungsweise=="paypal" || $zahlungsweise=="kreditkarte" || $zahlungsweise=="bar") $this->app->Tpl->Add('ZAHLUNGEN',"<div class=\"error\">Vorkasse noch nicht abgeschlossen!</div>");
    }

    // schaue ob es eine GS zu diesem Auftrag gibt
    // schaue ob es eine GS zu diesem Auftrag gibt
    //$gutschriftid = $this->app->DB->Select("SELECT id FROM gutschrift WHERE rechnungid='$rechnungid' LIMIT 1");
    if (count($rechnungids) > 0)
    {
      for($gcounter=0;$gcounter < count($rechnungids); $gcounter++)
      {
        $gutschriftid = $this->app->DB->Select("SELECT id FROM gutschrift WHERE rechnungid='".$rechnungids[$gcounter]['id']."' LIMIT 1");
        $gutschriftbelegnr = $this->app->DB->Select("SELECT belegnr FROM gutschrift WHERE id='".$gutschriftid."' LIMIT 1");
        $rechnungbelegnr = $this->app->DB->Select("SELECT belegnr FROM rechnung WHERE id='".$rechnungids[$gcounter]['id']."' LIMIT 1");
        if($gutschriftid > 0)
        {
          $tmp = $this->app->DB->Select("SELECT 
              CONCAT('<a href=\"index.php?module=gutschrift&action=edit&id=',r.id,'\">',if(r.belegnr='0' OR r.belegnr='','ENTWURF',r.belegnr),'&nbsp;<a href=\"index.php?module=gutschrift&action=pdf&id=',r.id,'\"><img src=\"./themes/new/images/pdf.png\" title=\"Gutschrift PDF\" border=\"0\"></a>&nbsp;
                <a href=\"index.php?module=gutschrift&action=edit&id=',r.id,'\"><img src=\"./themes/new/images/edit.png\" title=\"Rechnung bearbeiten\" border=\"0\"></a>') as rechnung
              FROM gutschrift r WHERE r.id='".$gutschriftid."'");
          $this->app->Tpl->Add('GUTSCHRIFT',$tmp);
        }
      }
    }




    if($auftragArr[0]['rma']==1)
      $this->app->YUI->ParserVarIf('RMA',1);
    else
      $this->app->YUI->ParserVarIf('RMA',0);

    $this->app->Tpl->Set('RMAFARBE',"red");
    $this->app->Tpl->Set('RMATEXT',"RMA zu diesem Auftrag vorhanden!");


    if($auftragArr[0]['belegnr']=="0" || $auftragArr[0]['belegnr']=="") $auftragArr[0]['belegnr'] = "ENTWURF";    
    $this->app->Tpl->Set('BELEGNR',$auftragArr[0]['belegnr']);
    $this->app->Tpl->Set('AUFTRAGID',$auftragArr[0]['id']);


    $this->app->Tpl->Set('RECHNUNGLIEFERADRESSE',$this->AuftragRechnungsLieferadresse($auftragArr[0]['id']));


    $this->app->Tpl->Set('RMA',"Es ist kein RMA-Prozess zu diesem Auftrag vorhanden.");


    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM auftrag_protokoll WHERE auftrag='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('PROTOKOLL',"Protokoll","noAction");
    
    $Brief = new AuftragPDF($this->app,$auftragArr[0]['projekt']);
    $Dokumentenliste = $Brief->getArchivedFiles($id, 'auftrag');
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
          $tmpr['menu'] = '<a href="index.php?module=auftrag&action=pdffromarchive&id='.$v['id'].'"><img src="themes/'.$this->app->Conf->WFconf['defaulttheme'].'/images/pdf.png" /></a>';
          $tmp3->datasets[] = $tmpr;
        }
      }
      
      $tmp3->DisplayNew('PDFARCHIV','Men&uuml;',"noAction");
    }
    if($parsetarget=="")
    {
      $this->app->Tpl->Output("auftrag_minidetail.tpl");
      exit;
    }  else {
      $this->app->Tpl->Parse($parsetarget,"auftrag_minidetail.tpl");
    }
  }

  function AuftragRechnungsLieferadresse($auftragid)
  {
    $data = $this->app->DB->SelectArr("SELECT * FROM auftrag WHERE id='$auftragid' LIMIT 1");

    foreach($data[0] as $key=>$value)
    {
      if($data[0][$key]!="" && $key!="abweichendelieferadresse" && $key!="land" && $key!="plz" && $key!="lieferland" && $key!="lieferplz") $data[0][$key] = $data[0][$key]."<br>";
    }


    $rechnungsadresse = $data[0]['name']."".$data[0]['ansprechpartner']."".$data[0]['abteilung']."".$data[0]['unterabteilung'].
      "".$data[0]['strasse']."".$data[0]['adresszusatz']."".$data[0]['land']."-".$data[0]['plz']." ".$data[0]['ort'];

    // wenn abweichende rechnungsadresse bei kunden aktiv ist dann diese verwenden

    $abweichende = $this->app->DB->Select("SELECT abweichende_rechnungsadresse FROM adresse WHERE id='".$data[0]['adresse']."' LIMIT 1");
    if($abweichende=="1") 
    {
      $adresse_data = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE id='".$data[0]['adresse']."' LIMIT 1");

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



  function AuftragZahlungsmail()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->AuftragZahlungsmail($id,1);
    header("Location: index.php?module=auftrag&action=edit&id=$id");
    exit;
  }

  function AuftragSuche()
  {
    //$this->app->Tpl->Set(UEBERSCHRIFT,"Auftr&auml;ge");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Auftr&auml;ge");
    //$this->app->Tpl->Add(TABS,"<li><h2 class=\"allgemein\">Allgemein</h2></li>");
    $this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=auftrag&action=create","Neuen Auftrag anlegen");
    $this->app->erp->MenuEintrag("index.php?module=auftrag&action=search","Auftrag Suchen");
    $this->app->erp->MenuEintrag("index.php","Zur&uuml;ck zur &Uuml;bersicht");
    // $this->app->Tpl->Add(TABS,"<li><br><br></li>");

    $this->app->Tpl->Set('TABTEXT',"Auftr&auml;ge");

    $name = trim($this->app->Secure->GetPOST("name"));
    $suchwort = trim($this->app->Secure->GetPOST("suchwort"));
    $email = trim($this->app->Secure->GetPOST("email"));
    $plz = trim($this->app->Secure->GetPOST("plz"));
    $auftrag = trim($this->app->Secure->GetPOST("auftrag"));
    $proforma = trim($this->app->Secure->GetPOST("proforma"));
    $kundennummer = trim($this->app->Secure->GetPOST("kundennummer"));
    $betrag= trim($this->app->Secure->GetPOST("betrag"));

    $betrag = str_replace(',','.',$betrag);

    if($name!="" || $plz!="" || $proforma!="" || $kundennummer!="" || $auftrag!="" || $email!="" || $betrag!="" || $suchwort!="")
    {
      $table = new EasyTable($this->app);
      $this->app->Tpl->Add('ERGEBNISSE',"<h2>Trefferliste:</h2><br>");
      if($suchwort!="")
      {
        $table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.name, a.belegnr as auftrag, adr.kundennummer, a.internet, a.plz, a.ort, a.strasse, a.zahlungsweise, a.status, a.id FROM auftrag a 
            LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.name LIKE '%$suchwort%' OR a.email LIKE '%$suchwort%' OR a.plz LIKE '$suchwort%' OR a.internet LIKE '%$suchwort%' OR (adr.kundennummer='$suchwort' AND adr.kundennummer!=0)
              OR (a.gesamtsumme='$suchwort' AND a.gesamtsumme!=0) OR (a.belegnr='$suchwort' AND a.belegnr!='' ))");
      } else {
        if($name!="")
          $table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.name, a.belegnr as auftrag, adr.kundennummer, a.internet, a.plz, a.ort, a.strasse,  a.zahlungsweise, a.status, a.id FROM auftrag a 
              LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.name LIKE '%$name%')");
        else if($email!="")
          $table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.name, a.belegnr as auftrag, adr.kundennummer, a.internet, a.plz, a.ort, a.strasse, a.zahlungsweise, a.status, a.id FROM auftrag a 
              LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.email LIKE '%$email%')");
        else if($plz!="")
          $table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.name, a.belegnr as auftrag, adr.kundennummer, a.internet, a.plz, a.ort, a.strasse, a.zahlungsweise, a.status, a.id FROM auftrag a 
              LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.plz LIKE '$plz%')");
        else if($proforma!="")
          $table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.name, a.belegnr as auftrag, adr.kundennummer, a.internet, a.plz, a.ort, a.strasse, a.zahlungsweise, a.status, a.id FROM auftrag a 
              LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.internet LIKE '%$proforma%')");
        else if($kundennummer!="")
          $table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.name, a.belegnr as auftrag, adr.kundennummer, a.internet, a.plz, a.ort, a.strasse,  a.zahlungsweise, a.status, a.id FROM auftrag a 
              LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (adr.kundennummer='$kundennummer')");
        else if($betrag!="")
          $table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.name, a.belegnr as auftrag, adr.kundennummer, a.internet, a.plz, a.ort, a.strasse,  a.zahlungsweise, a.status, a.id FROM auftrag a 
              LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.gesamtsumme='$betrag')");
        else if($auftrag!="")
          $table->Query("SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.name, a.belegnr as auftrag, adr.kundennummer, a.internet, a.plz, a.ort, a.strasse, a.zahlungsweise, a.status, a.id FROM auftrag a 
              LEFT JOIN adresse adr ON adr.id = a.adresse WHERE (a.belegnr='$auftrag')");

      }
      $table->DisplayNew('ERGEBNISSE',"<a href=\"index.php?module=auftrag&action=edit&id=%value%\">Lesen</a>");
    } else {
      $this->app->Tpl->Add('ERGEBNISSE',"<div class=\"info\">Auftragssuche (bitte entsprechende Suchparameter eingeben)</div>");
    }

    $this->app->Tpl->Parse('INHALT',"auftragssuche.tpl");

    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    $this->app->Tpl->Parse('TAB1',"rahmen77.tpl");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }



  function AuftragRechnung()
  {
    $id = $this->app->Secure->GetGET("id");

    $anzahl_artikel = $this->app->DB->Select("SELECT COUNT(id) FROM auftrag_position WHERE auftrag=$id");
    if($anzahl_artikel <= 0)
    {
      $meldung = "Auftrag $belegnr kann nicht weitergefuehrt werden da keine Artikel gebucht sind!";
      $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Auftrag $belegnr kann nicht weitergefuehrt werden, da keine Artikel gebucht sind!</div>  ");
      header("Location: index.php?module=auftrag&action=edit&id=$id&msg=$msg");
      exit;
    } else {
      $newid = $this->app->erp->WeiterfuehrenAuftragZuRechnung($id);
      header("Location: index.php?module=rechnung&action=edit&id=$newid");
      exit;
    }
  }


  function AuftragLieferschein()
  {
    $id = $this->app->Secure->GetGET("id");

    $newid = $this->app->erp->WeiterfuehrenAuftragZuLieferschein($id);

    header("Location: index.php?module=lieferschein&action=edit&id=$newid");
    exit;
  }

  function AuftragLieferscheinRechnung()
  {
    $id = $this->app->Secure->GetGET("id");

    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
    $art = $this->app->DB->Select("SELECT art FROM auftrag WHERE id='$id' LIMIT 1");

    $druckercode = $this->app->erp->Firmendaten("standardversanddrucker");

    if($art!="rechnung")
    {
      // automatisch drucken bzw. freigeben
      $newid = $this->app->erp->WeiterfuehrenAuftragZuLieferschein($id);
      $belegnr = $this->app->erp->GetNextNummer("lieferschein",$projekt);
      $this->app->DB->Update("UPDATE lieferschein SET belegnr='$belegnr', status='freigegeben' WHERE id='$newid' LIMIT 1");
      $this->app->erp->LieferscheinProtokoll($newid,"Lieferschein freigegeben");

      $this->app->erp->LieferscheinAuslagern($newid,true);                    


      $Brief = new LieferscheinPDF($this->app,$projekt);
      $Brief->GetLieferschein($newid);
      $tmpfile = $Brief->displayTMP();
      $this->app->printer->Drucken($druckercode,$tmpfile);

      $fileid_lieferschein = $this->app->erp->CreateDatei($Brief->filename,"lieferschein","","",$tmpfile,$this->app->User->GetName());
      $this->app->erp->AddDateiStichwort($fileid_lieferschein,"lieferschein","lieferschein",$newid,$without_log=false);
      unlink($tmpfile);
    }

    if($art!="lieferung")
    {
      $newid = $this->app->erp->WeiterfuehrenAuftragZuRechnung($id);
      $belegnr = $this->app->erp->GetNextNummer("rechnung",$projekt);
      $this->app->DB->Update("UPDATE rechnung SET belegnr='$belegnr', status='freigegeben' WHERE id='$newid' LIMIT 1");
      $this->app->erp->RechnungProtokoll($newid,"Rechnung freigegeben");

      $Brief = new RechnungPDF($this->app,$projekt);
      $Brief->GetRechnung($newid);
      $tmpfile = $Brief->displayTMP();
      $this->app->printer->Drucken($druckercode,$tmpfile);

      $fileid_rechnung = $this->app->erp->CreateDatei($Brief->filename,"rechnung","","",$tmpfile,$this->app->User->GetName());
      $this->app->erp->AddDateiStichwort($fileid_rechnung,"rechnung","rechnung",$newid,$without_log=false);
      unlink($tmpfile);
    }


    header("Location: index.php?module=auftrag&action=edit&id=$id");
    exit;
  }




  function AuftragCopy()
  {
    $id = $this->app->Secure->GetGET("id");

    $newid = $this->app->erp->CopyAuftrag($id);

    header("Location: index.php?module=auftrag&action=edit&id=$newid");
    exit;
  }

  function AuftragKreditlimit()
  {
    $id = $this->app->Secure->GetGET("id");

    $this->app->DB->Update("UPDATE auftrag SET kreditlimit_freigabe='1' WHERE id='$id' LIMIT 1");

    $this->app->erp->AuftragAutoversandBerechnen($id);
    $this->app->erp->AuftragNeuberechnen($id);
    header("Location: index.php?module=auftrag&action=edit&id=$id");
  }

  function AuftragFreigabe()
  {
    $id = $this->app->Secure->GetGET("id");
    $freigabe= $this->app->Secure->GetGET("freigabe");
    $this->app->Tpl->Set('TABTEXT',"Freigabe");
    $module = $this->app->Secure->GetGET("module");

    $this->app->erp->CheckVertrieb($id,"auftrag");
    $this->app->erp->CheckBearbeiter($id,"auftrag");

    if($freigabe==$id)
    {
      $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
      $checkbelegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
      //if($belegnr <= 0) $belegnr = 200000; else $belegnr = $belegnr + 1;

      if($checkbelegnr=="")
        $belegnr = $this->app->erp->GetNextNummer("auftrag",$projekt);
      else $belegnr = $checkbelegnr;

      $this->app->DB->Update("UPDATE auftrag SET belegnr='$belegnr', status='freigegeben'  WHERE id='$id' LIMIT 1");
      $this->app->erp->AuftragProtokoll($id,"Auftrag freigegeben");

      // auftrag abschliessen und event senden

      $cmd = $this->app->Secure->GetGET("cmd");
      if($cmd=="mail")
      {
				$this->app->erp->BelegVersand("auftrag",$id,"email");
/*
        $name = $this->app->DB->Select("SELECT name FROM auftrag WHERE id='$id' LIMIT 1");
        $email = $this->app->DB->Select("SELECT email FROM auftrag WHERE id='$id' LIMIT 1");
        $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");

        $emailtext = $this->app->erp->Geschaeftsbriefvorlage("de","auftrag",$projekt,$name,$id);
        //art=email,betreff,text,dateien, email_to, email_name_to
        // sende 
        $Brief = new AuftragPDF($this->app,$projekt);
        $Brief->GetAuftrag($id);
        $tmpfile = $Brief->displayTMP();
        $this->app->erp->DokumentSend($adresse,"auftrag", $id, "email",$emailtext['betreff'],$emailtext['text'],array($tmpfile),"","",$projekt,$email, $name);

        $fileid = $this->app->erp->CreateDatei($tmpfile,$module,"","",$tmpfile,$this->app->User->GetName());

        $this->app->erp->AddDateiStichwort($fileid,"auftrag","auftrag",$id,$without_log=false);

        $ansprechpartner = $name." <".$email.">";

        $this->app->DB->Insert("INSERT INTO dokumente_send 
            (id,dokument,zeit,bearbeiter,adresse,parameter,art,betreff,text,projekt,ansprechpartner,versendet,dateiid)           VALUES ('','auftrag',NOW(),'".$this->app->User->GetName()."',
              '$adresse','$id','email','".$emailtext['betreff']."','".$emailtext['text']."','$projekt','$ansprechpartner',1,'$fileid')");

        unlink($tmpfile);
        $this->app->DB->Update("UPDATE auftrag SET versendet=1, versendet_am=NOW(),
            versendet_per='email',versendet_durch='".$this->app->User->GetName()."',schreibschutz='1' WHERE id='$id' LIMIT 1");
        $this->app->erp->AuftragProtokoll($id,"Auftrag versendet");
			*/

        $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Der Auftrag wurde freigegeben und die AB an den Kunden per Mail gesendet!</div>  ");
      }
      else 
        $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Der Auftrag wurde freigegeben und kann jetzt versendet werden!</div>  ");
      header("Location: index.php?module=auftrag&action=edit&id=$id&msg=$msg");
      exit;

    } else { 

      $name = $this->app->DB->Select("SELECT a.name FROM auftrag b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
      $email = $this->app->DB->Select("SELECT email FROM auftrag WHERE id='$id' LIMIT 1");
      //$summe = $this->app->DB->Select("SELECT FORMAT(SUM(menge*preis),2) FROM auftrag_position
      //WHERE auftrag='$id'");
      $summe = $this->app->DB->Select("SELECT gesamtsumme FROM auftrag WHERE id='$id' LIMIT 1");

      $waehrung = $this->app->DB->Select("SELECT waehrung FROM auftrag_position
          WHERE auftrag='$id' LIMIT 1");

      if($email!="")
      {
        $this->app->Tpl->Set('TAB1',"<div class=\"info\">Soll der Auftrag an <b>$name</b> im Wert von <b>$summe $waehrung</b> 
            jetzt freigegeben werden?<table cellspacing=5><tr><td width=100></td><td>
            <input type=\"button\" value=\"Jetzt freigeben +  Mail ($email)\" onclick=\"window.location.href='index.php?module=auftrag&action=freigabe&id=$id&freigabe=$id&cmd=mail'\">
            &nbsp;oder&nbsp;ohne automatische Mail:&nbsp;
            <input type=\"button\" value=\"Jetzt freigeben\" onclick=\"window.location.href='index.php?module=auftrag&action=freigabe&id=$id&freigabe=$id'\"></td></tr></table>
            </div>");
      } else {
        $this->app->Tpl->Set('TAB1',"<div class=\"info\">Soll der Auftrag an <b>$name</b> im Wert von <b>$summe $waehrung</b> 
            jetzt freigegeben werden? 
            <input type=\"button\" value=\"Jetzt freigeben\" onclick=\"window.location.href='index.php?module=auftrag&action=freigabe&id=$id&freigabe=$id'\">
            </div>");


      }
    }
    $this->AuftragMenu();
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function AuftragAbschicken()
  {
    $this->AuftragMenu();
    $this->app->erp->DokumentAbschicken();
  }



  function AuftragAnfrage()
  {
    $id = $this->app->Secure->GetGET("id");

    $anfrageid = $this->app->DB->Select("SELECT anfrageid FROM auftrag WHERE id='$id' LIMIT 1");
    // loesche alle positionen im Auftrag
    if($anfrageid > 0)
      $this->app->erp->WeiterfuehrenAuftragZuAnfrage($id);

    header("Location: index.php?module=anfrage&action=edit&id=$anfrageid");
    exit;
  }

  function AuftragAbschluss()
  {
    $id = $this->app->Secure->GetGET("id");
    $abschluss= $this->app->Secure->GetGET("abschluss");

    $name = $this->app->DB->Select("SELECT name FROM auftrag WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");

    $this->app->Tpl->Set('TABTEXT',"Abschluss");


    if($abschluss==$id)
    {
      if($status=="angelegt")
      {
        // KUNDE muss RMA starten
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Auftrag \"$name\" ($belegnr) kann nicht abgeschlossen werden da er noch nicht freigeben wurde! Bitte Auftrag erst freigeben!</div>  ");
      } 
      else if($status=="storniert")
      {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Auftrag \"$name\" ($belegnr) kann nicht abgeschlossen werden da er bereits storniert ist!</div>  ");
      } 
      else if($status=="abgeschlossen")
      {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Auftrag \"$name\" ($belegnr) kann nicht abgeschlossen werden da er bereits abgeschlossen ist!</div>  ");
      } 
      else if($status=="freigegeben")
      {
        $this->app->DB->Update("UPDATE auftrag SET status='abgeschlossen' WHERE id='$id' LIMIT 1"); 
        $this->app->erp->AuftragProtokoll($id,"Auftrag trotzdem manuell abschlie&zlig;en");

        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Auftrag wurde abgeschlossen!</div>  ");
      }
      header("Location: index.php?module=auftrag&action=edit&id=$id&msg=$msg");
      exit;
    }
    else {
      $name = $this->app->DB->Select("SELECT a.name FROM auftrag b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
      $this->app->Tpl->Set('TAB1',"<div class=\"info\">Soll der Auftrag an <b>$name</b> jetzt abgeschlossen werden?
          <input type=\"button\" value=\"Abschluss\" onclick=\"window.location.href='index.php?module=auftrag&action=abschluss&id=$id&abschluss=$id&msg=$msg'\">
          </div>");
    }
    $this->AuftragMenu();
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }


  function AuftragDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    $mail = $this->app->Secure->GetGET("mail");
    $abschluss = $this->app->Secure->GetGET("abschluss");

    $name = $this->app->DB->Select("SELECT name FROM auftrag WHERE id='$id' LIMIT 1");
    $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");

    $this->app->Tpl->Set('TABTEXT',"Stornierung");

    if($abschluss==$id)
    {
      if($belegnr=="0" || $belegnr=="")
      {
        $this->app->erp->DeleteAuftrag($id);
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Auftrag \"$name\" ($belegnr) wurde gel&ouml;scht!</div>  ");
        //header("Location: ".$_SERVER['HTTP_REFERER']."&msg=$msg");
        header("Location: index.php?module=auftrag&action=list&msg=$msg");
        exit;
      } else 
      {

        if($status=="storniert")
        {
          // KUNDE muss RMA starten
          // KUNDE muss RMA starten
          // pruefe ob auftrag groesste nummer hat
          $maxbelegnr = $this->app->DB->Select("SELECT MAX(belegnr) FROM auftrag");
          if(0)//$maxbelegnr == $belegnr)
          {
            $this->app->DB->Delete("DELETE FROM auftrag_position WHERE auftrag='$id'");
            $this->app->DB->Delete("DELETE FROM auftrag_protokoll WHERE auftrag='$id'");
            $this->app->DB->Delete("DELETE FROM auftrag WHERE id='$id'");

            $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Auftrag \"$name\" ($belegnr) wurde ge&ouml;scht !</div>  ");
          } else 
          {
            $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Auftrag \"$name\" ($belegnr) kann nicht storniert werden da er bereits storniert ist!</div>  ");
          }
          header("Location: index.php?module=auftrag&action=list&msg=$msg");
          exit;
        } 
        else {

          $this->app->DB->Update("UPDATE auftrag SET status='storniert' WHERE id='$id' LIMIT 1"); 
          $this->app->erp->AuftragProtokoll($id,"Auftrag storniert");

          // stornierungen loeschen
          $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE objekt='auftrag' AND parameter='$id'"); 

          // ausfuellen automatisch stornofelder
          //stornobetrag // summe des zahlungseingangs!!!!
          //stornogutschrift
          //stornowareerhalten
          //stornorueckzahlung
          // zureuckzahlen per



          // email senden?
          if($mail==1)
            $this->app->erp->Stornomail($id);

          $recheck = $this->app->DB->Select("SELECT id FROM rechnung WHERE auftrag='$belegnr' LIMIT 1");

          if($recheck <= 0)
          {
            // Fall 1 keine RE und LS
            // -> stornieren und Geld zurueckueberweisen (Paypal, Kredit oder Bank)
            // geld wird ueber ipayment oder paypal zurueckgebucht!!!
            // negatives auftragssguthaben loescht auftragsguthaben
            $this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Achtung dem Kunden sofort das Geld &uuml;berweisen!</div>");

          } else {
            //Fall 2 es gibt eine RE und ein LS
            // GS und liegt Ware wieder in Lager dann Zahlung freigeben immer per Scheck?
          }
          //$this->app->erp->($id);
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Auftrag wurde storniert!</div>  ");
        }
      }
      //$this->AuftragSuche();

      header("Location: index.php?module=auftrag&action=list&msg=$msg");
      exit;
    } else {
      $name = $this->app->DB->Select("SELECT a.name FROM auftrag b LEFT JOIN adresse a ON a.id=b.adresse WHERE b.id='$id' LIMIT 1");
      $this->app->Tpl->Set('TAB1',"<div class=\"info\">Soll der Auftrag an <b>$name</b> jetzt storniert werden?
          <input type=\"button\" value=\"Stornierung MIT E-Mail an den Kunden\" onclick=\"window.location.href='index.php?module=auftrag&action=delete&id=$id&abschluss=$id&msg=$msg&mail=1'\">&nbsp;
          <input type=\"button\" value=\"Stornierung OHNE E-Mail an den Kunden\" onclick=\"window.location.href='index.php?module=auftrag&action=delete&id=$id&abschluss=$id&msg=$msg&mail=0'\">&nbsp;
          </div>");
    }
    $this->AuftragMenu();
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");

  }

  function AuftragDeleteAusVersand()
  {

    $id = $this->app->Secure->GetGET("id");

    $rechnung = $this->app->DB->Select("SELECT rechnung FROM versand WHERE id='$id' LIMIT 1");
    $lieferschein  = $this->app->DB->Select("SELECT lieferschein  FROM versand WHERE id='$id' LIMIT 1");
    $auftragid  = $this->app->DB->Select("SELECT auftragid FROM lieferschein WHERE id='$lieferschein' LIMIT 1");

    $this->app->DB->Update("UPDATE auftrag SET rma=1,status='storniert' WHERE id='$auftragid' LIMIT 1");

    if($lieferschein > 0)
      $auftrag  = $this->app->DB->Select("SELECT auftragid FROM lieferschein WHERE id='$lieferschein' LIMIT 1");

    // status aendern
    if($lieferschein > 0)
    {
      $this->app->DB->Update("UPDATE lieferschein SET versandart='rma',status='storniert' WHERE id='$lieferschein' LIMIT 1");
      $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE objekt='lieferschein' AND parameter='$lieferschein'");
      $this->app->erp->LieferscheinProtokoll($lieferschein,"Lieferschein durch Auftrag aus Versand storniert");
    }

    $this->app->erp->AuftragProtokoll($auftrag,"Auftrag aus Versand storniert");

    // RMA anlegen 

    $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Auftrag wurde als RMA im Versand markiert!</div>  ");

    header("Location: index.php?module=auftrag&action=edit&id=$auftrag&msg=$msg");
    exit;


  }



  function AuftragProtokoll()
  {
    $this->AuftragMenu();
    $id = $this->app->Secure->GetGET("id");

    $this->app->Tpl->Set('TABTEXT',"Protokoll");


    //$this->AuftragMiniDetail(TAB1);


    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT zeit,bearbeiter,grund FROM auftrag_protokoll WHERE auftrag='$id' ORDER by zeit DESC");
    $tmp->DisplayNew('TAB1',"Protokoll","noAction");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function AuftragAddPosition()
  {

    $sid = $this->app->Secure->GetGET("sid");
    $id = $this->app->Secure->GetGET("id");
    $menge = $this->app->Secure->GetGET("menge");
    $datum  = $this->app->Secure->GetGET("datum");
    $datum  = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1");
    $this->app->erp->AddAuftragPosition($id, $sid,$menge,$datum);
    $this->app->erp->AuftragNeuberechnen($id);
    header("Location: index.php?module=auftrag&action=positionen&id=$id");
    exit;

  }

  function AuftragProforma()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->AuftragNeuberechnen($id);

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");

    //if(is_numeric($belegnr) && $belegnr!=0)
    //{
    $Brief = new AuftragPDF($this->app,$projekt,"proforma");
    $Brief->GetAuftrag($id);
    $Brief->displayDocument(); 
    //} else
    //  $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Noch nicht freigegebene Auftragen k&ouml;nnen nicht als PDF betrachtet werden.!</div>");


    $this->AuftragList();
  }

  function AuftragInlinePDF()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->AuftragNeuberechnen($id);
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
    $schreibschutz = $this->app->DB->Select("SELECT schreibschutz FROM auftrag WHERE id='$id' LIMIT 1");
    $frame = $this->app->Secure->GetGET("frame");

    if($frame=="")
    {
      $Brief = new AuftragPDF($this->app,$projekt);
      $Brief->GetAuftrag($id);
      $Brief->inlineDocument($schreibschutz);
    } else {
      $file = urlencode("../../../../index.php?module=auftrag&action=inlinepdf&id=$id");
      echo "<iframe width=\"100%\" height=\"600\" src=\"./js/production/generic/web/viewer.html?file=$file\" frameborder=\"0\"></iframe>"; 
      exit;
    }
  }


  function AuftragPDF()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->AuftragNeuberechnen($id);

    $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
    $schreibschutz = $this->app->DB->Select("SELECT schreibschutz FROM auftrag WHERE id='$id' LIMIT 1");

    //if(is_numeric($belegnr) && $belegnr!=0)
    //{
    $Brief = new AuftragPDF($this->app,$projekt);
    $Brief->GetAuftrag($id);
    $Brief->displayDocument($schreibschutz); 
    //} else
    //  $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Noch nicht freigegebene Auftragen k&ouml;nnen nicht als PDF betrachtet werden.!</div>");


    $this->AuftragList();
  }


  function AuftragMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->erp->AuftragNeuberechnen($id);
    $backurl = $this->app->Secure->GetGET("backurl");
    $backurl = $this->app->erp->base64_url_decode($backurl);


    $belegnr = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM auftrag WHERE id='$id' LIMIT 1");


    if($belegnr=="0" || $belegnr=="") $belegnr ="(Entwurf)";
    //    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Auftrag $belegnr");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT2',"$name Auftrag $belegnr");
    // status bestell
    $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");

    if ($status=="angelegt")
    {
      $this->app->erp->MenuEintrag("index.php?module=auftrag&action=freigabe&id=$id","Freigabe");
    }


    //$this->app->Tpl->Add(TABS,"<li><h2 style=\"background-color: [FARBE2]\">Auftrag</h2></li>");
    $this->app->erp->MenuEintrag("index.php?module=auftrag&action=edit&id=$id","Details");
    //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=edit&id=$id","Auftrag pr&uuml;fen");
    //if($this->app->Secure->GetGET("action")!="abschicken")
    //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=zahlungsmahnungswesen&id=$id","Zahlung-/ Versandstatus");



    if($status=='bestellt')
    { 
      $this->app->Tpl->Add('TABS',"<li><a href=\"index.php?module=auftrag&action=wareneingang&id=$id\">Wareneingang<br>R&uuml;ckst&auml;nde</a></li>");
      $this->app->Tpl->Add('TABS',"<li><a class=\"tab\" href=\"index.php?module=auftrag&action=wareneingang&id=$id\">Mahnstufen</a></li>");
    } 
    $this->app->erp->MenuEintrag("index.php?module=auftrag&action=dateien&id=$id","Dateien");
    //  $this->app->erp->MenuEintrag("index.php?module=auftrag&action=protokoll&id=$id","Protokoll");

    //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=ean&id=$id","Barcodescanner");

    if($this->app->Secure->GetGET("action")=="abschicken" || $this->app->Secure->GetGET("action")=="zahlungsmahnungswesen")
      $this->app->erp->MenuEintrag("index.php?module=auftrag&action=edit&id=$id","Zur&uuml;ck zum Auftrag");
    else if($backurl=="")
      $this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    else
      $this->app->erp->MenuEintrag("$backurl","Zur&uuml;ck zur &Uuml;bersicht");

  }

  function AuftragPositionstabelle($parsetarget)
  {
    $this->app->YUI->TableSearch($parsetarget,"auftraegeoffene");
  }


  function AuftragPositionen()
  {
    $id = $this->app->Secure->GetGET("id");

    $this->app->erp->AuftragNeuberechnen($id);
    $this->app->YUI->AARLGPositionen(false);
    //    $this->app->erp->AuftragEinzelnBerechnen($id);


  }

  function DelAuftragPosition()
  {
    $sid = $this->app->Secure->GetGET("sid");
    $id = $this->app->Secure->GetGET("id");
    $this->app->YUI->SortListEvent("del","auftrag_position","auftrag");
    if(is_numeric($sid))
    {
      $unterartikel = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE explodiert_parent='$sid'");

      if(count($unterartikel)>0 && $sid >0 && $id >0)
      {
        for($i=0;$i<count($unterartikel);$i++)
        {
          $sidexplodiert = $unterartikel[$i]['id'];
          if($sidexplodiert>0)
          {
            $sort = $this->app->DB->Select("SELECT sort FROM auftrag_position WHERE id='$sidexplodiert' LIMIT 1");
            if($sort>0)
            {
              $this->app->DB->Delete("DELETE FROM auftrag_position WHERE sort='$sort' AND auftrag='$id' LIMIT 1");
              $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE parameter='$id' AND objekt='auftrag'
                  AND artikel='".$unterartikel[$i]['artikel']."'");
              $this->app->DB->Update("UPDATE auftrag_position SET sort=sort-1 WHERE auftrag='$id' AND sort > $sort LIMIT 1");
              $this->app->erp->AuftragNeuberechnen($id);
            }
          }
        }
				// alle wirklich loeschen
        $this->app->DB->Delete("DELETE FROM auftrag_position WHERE explodiert_parent='$sid' AND auftrag='$id'");
        $this->app->erp->AuftragNeuberechnen($id);
      }
    }
    $this->AuftragPositionen();
  }

  function UpAuftragPosition()
  {
    $this->app->YUI->SortListEvent("up","auftrag_position","auftrag");
    $this->AuftragPositionen();
  }

  function DownAuftragPosition()
  {
    $this->app->YUI->SortListEvent("down","auftrag_position","auftrag");
    $this->AuftragPositionen();
  }

  function AuftragCheckDisplayPopup()
  { 
    $frame = $this->app->Secure->GetGET("frame");
    $id = $this->app->Secure->GetGET("id");

    if($frame=="false")
    { 
      // hier nur fenster größe anpassen
      $this->app->YUI->IframeDialog(700,700);
    } else {
      // nach page      

      $projekt = $this->app->DB->Select("SELECT projekt FROM auftrag WHERE id='$id' LIMIT 1");
      $projektcheckname = $this->app->DB->Select("SELECT checkname FROM projekt WHERE id='$projekt' LIMIT 1");

      include_once ("./plugins/class.".$projektcheckname.".php");             
      $tmp = new $projektcheckname($this->app);
      $tmp->CheckDisplay('PAGE',$id);

      $this->app->BuildNavigation=false;
    }
  }


  function AuftragPositionenEditPopup()
  {
    $id = $this->app->Secure->GetGET("id");

    $artikel= $this->app->DB->Select("SELECT artikel FROM auftrag_position WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('ANZEIGEEINKAUFLAGER',$this->app->erp->AnzeigeEinkaufLager($artikel));

    // nach page inhalt des dialogs ausgeben
    $widget = new WidgetAuftrag_position($this->app,'PAGE');
    $sid= $this->app->DB->Select("SELECT auftrag FROM auftrag_position WHERE id='$id' LIMIT 1");
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=auftrag&action=positionen&id=$sid");
    $widget->Edit();
    $this->app->BuildNavigation=false;
  }


  function AuftragEdit()
  {
    $action = $this->app->Secure->GetGET("action");
    $id = $this->app->Secure->GetGET("id");
    $storno = $this->app->Secure->GetGET("storno");

    // zum aendern vom Vertrieb
    $sid = $this->app->Secure->GetGET("sid");
    $cmd = $this->app->Secure->GetGET("cmd");
    if($this->app->erp->VertriebAendern("auftrag",$id,$cmd,$sid))
      return;
    


    if($this->app->erp->DisableModul("auftrag",$id))
    {
      //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","Zur&uuml;ck zur &Uuml;bersicht");
      $this->AuftragMenu();
      return;
    }       
    
    $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");
    if($adresse <=0)
    {
      $this->app->Tpl->Add('JAVASCRIPT','$(document).ready(function() { if(document.getElementById("adresse"))document.getElementById("adresse").focus(); });');
      $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Achtung! Dieses Dokument ist mit keinem Kunden-Nr. verlinkt. Bitte geben Sie die Kundennummer an und klicken Sie &uuml;bernehmen oder Speichern!</div>");
    }
    $this->app->erp->InfoAuftragsErfassung("auftrag",$id);
    $teillieferungvon= $this->app->DB->Select("SELECT teillieferungvon FROM auftrag WHERE id='$id' LIMIT 1");
    $teillieferungnummer= $this->app->DB->Select("SELECT teillieferungnummer FROM auftrag WHERE id='$id' LIMIT 1");

    $hauptid = $id;
    while(1)
    {
      $checkteillieferungvon = $this->app->DB->Select("SELECT teillieferungvon FROM auftrag WHERE id='$hauptid' LIMIT 1");
      if($checkteillieferungvon > 0)
        $hauptid = $checkteillieferungvon;
      else break;
      $timeout++;
      if($timeout > 100) break;
    }
    $teillieferungnummermax= $this->app->DB->Select("SELECT MAX(teillieferungnummer)+1 FROM auftrag WHERE id='$hauptid' LIMIT 1");
    $teillieferung_von_auftrag_nummer= $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$hauptid' LIMIT 1");


    if($teillieferungvon>0)
    {
      $this->app->Tpl->Add('MESSAGE',"<div class=\"warning\">Dies ist Teilauftrag Nr. $teillieferungnummer (Aktuell gesplittet in $teillieferungnummermax Auftr&auml;ge). Der urspr&uuml;ngliche Auftrag war: <a href=\"index.php?module=auftrag&action=edit&id=$hauptid\" target=\"_blank\">$teillieferung_von_auftrag_nummer</a></div>");
    }       

    $anzahlteillieferungen = $this->app->DB->SelectArr("SELECT id,belegnr FROM auftrag WHERE teillieferungvon='$id' ORDER by belegnr");
    if(count($anzahlteillieferungen) > 0)
    {
      for($ati=0;$ati<count($anzahlteillieferungen);$ati++)
      {       
        $this->app->Tpl->Add('MESSAGE',"<div class=\"info\">Zu diesem Auftrag geh&ouml;rt Teilauftrag Nr. <a href=\"index.php?module=auftrag&action=edit&id=".$anzahlteillieferungen[$ati]['id']."\" target=\"_blank\">".$anzahlteillieferungen[$ati]['belegnr']."</a></div>");
      }
    }




    $zahlungsweise= $this->app->DB->Select("SELECT zahlungsweise FROM auftrag WHERE id='$id' LIMIT 1");
    $zahlungszieltage= $this->app->DB->Select("SELECT zahlungszieltage FROM auftrag WHERE id='$id' LIMIT 1");

    if($zahlungsweise=="rechnung" && $zahlungszieltage<1)
    {
      //                      $this->app->Tpl->Add('MESSAGE',"<div class=\"info\">Hinweis: F&auml;lligkeit auf \"sofort\", da Zahlungsziel in Tagen auf 0 Tage gesetzt ist!</div>");
    }


    $status= $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");
    $schreibschutz= $this->app->DB->Select("SELECT schreibschutz FROM auftrag WHERE id='$id' LIMIT 1");


    $adresse= $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");
    $liefersperre= $this->app->DB->Select("SELECT liefersperre FROM adresse WHERE id='$adresse' LIMIT 1");
    
    if($status != "angelegt" && $status != "angelegta" && $status != "a")
    {
      $Brief = new Briefpapier($this->app);
      if($Brief->zuArchivieren($id, "auftrag"))$this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Der Auftrag ist noch nicht archiviert! Bitte versenden oder manuell archivieren. <input type=\"button\" onclick=\"if(!confirm('Soll das Dokument archiviert werden?')) return false;else window.location.href='index.php?module=auftrag&action=archivierepdf&id=$id';\" value=\"Manuell archivieren\" /></div>");
    }
    
    if($liefersperre=="1" && ($status=="freigegeben" || $status=="angelegt"))
    {
      $this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Achtung: Der Kunde hat eine Liefersperre!</div>");
    }

    $this->app->erp->AuftragEinzelnBerechnen($id);
    //$this->app->erp->AuftragAutoversandBerechnen($id);
    $this->app->erp->AuftragNeuberechnen($id);

    $this->app->erp->DisableVerband();

    $this->AuftragMiniDetail('MINIDETAIL',true);

    $icons = $this->app->YUI->IconsSQL();
    $icons = $this->app->DB->Select("SELECT $icons FROM auftrag a WHERE a.id='$id' LIMIT 1");
    $this->app->Tpl->Set('STATUSICONS',$icons);
    $this->app->YUI->AARLGPositionen();



    $status= $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");
    if($status=="")
      $this->app->DB->Update("UPDATE auftrag SET status='angelegt' WHERE id='$id' LIMIT 1");


    $tmpcheckversand = $this->app->DB->Select("SELECT versandart FROM auftrag WHERE id='$id' LIMIT 1");
    if($tmpcheckversand=="packstation")
      $this->app->DB->Update("UPDATE auftrag SET abweichendelieferadresse='0' WHERE id='$id' LIMIT 1");


    $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");
    $nummer = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");
    $kundennummer = $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' LIMIT 1");

    if($schreibschutz!="1" && $this->app->erp->RechteVorhanden("auftrag","schreibschutz"))
    {
      $this->app->erp->AnsprechpartnerButton($adresse);
      $this->app->erp->LieferadresseButton($adresse);
      $this->app->erp->AnsprechpartnerAlsLieferadresseButton($adresse);
      $this->app->erp->AdresseAlsLieferadresseButton($adresse);
    }


    if($nummer!="")
    {
      $this->app->Tpl->Set('NUMMER',$nummer);
      $this->app->Tpl->Set('KUNDE',"&nbsp;&nbsp;&nbsp;Kd-Nr.".$kundennummer);
    }
    $this->app->Tpl->Set('ICONMENU',$this->AuftragIconMenu($id));
    $this->app->Tpl->Set('ICONMENU2',$this->AuftragIconMenu($id,2));

    if($status=="angelegt")
    {
      $this->app->Tpl->Set('ABGESCHLOSSENENABLE',"<!--"); //TODO
      $this->app->Tpl->Set('ABGESCHLOSSENDISABLE',"-->"); //TODO
    }

    if($status!="storniert")
    {
      $this->app->Tpl->Set('STORNOENABLE',"<!--");
      $this->app->Tpl->Set('STORNODISABLE',"-->");
    }

    $stornobezahlt = $this->app->DB->Select("SELECT stornobezahlt FROM auftrag WHERE id='$id' LIMIT 1");

    if($storno!="abschluss" && $stornobezahlt==0)
    {
      $this->app->Tpl->Set('STORNORETOUREENABLE',"<!--");
      $this->app->Tpl->Set('STORNORETOUREDISABLE',"-->");
    } else {
      $this->app->Tpl->Set('HIDDENFIELD',"<input type=\"hidden\" name=\"storno_abschluss\" value=\"1\">");
      // bearbeiter 
      $stornobezahltvon = $this->app->DB->Select("SELECT stornobezahltvon FROM auftrag WHERE id='$id' LIMIT 1");
      $stornobezahltam = $this->app->DB->Select("SELECT stornobezahltam FROM auftrag WHERE id='$id' LIMIT 1");
      if($stornobezahltvon=="")
        $this->app->DB->Update("UPDATE auftrag SET stornobezahltvon='".$this->app->User->GetName()."' WHERE id='$id' LIMIT 1");
      if($stornobezahltam=="0000-00-00")
        $this->app->DB->Update("UPDATE auftrag SET stornobezahltam=NOW() WHERE id='$id' LIMIT 1");
    }

    $this->AuftragAmpel($id,AMPEL);


    $adressse= $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");

    if($schreibschutz=="1" && $this->app->erp->RechteVorhanden("auftrag","schreibschutz"))
    {
      $lieferscheine = $this->app->DB->SelectArr("SELECT id,belegnr FROM lieferschein WHERE auftragid='$id'");        
      for($lieferscheinei=0;$lieferscheinei< count($lieferscheine); $lieferscheinei++)
      {
        $optional .= "&nbsp;<input type=\"button\" value=\"LS ".$lieferscheine[$lieferscheinei]['belegnr']."\" onclick=\"window.location.href='index.php?module=lieferschein&action=pdf&id=".$lieferscheine[$lieferscheinei]['id']."'\">";
      }

      $rechnungen = $this->app->DB->SelectArr("SELECT id,belegnr FROM rechnung WHERE auftragid='$id'");       
      for($rechnungi=0;$rechnungi< count($rechnungen); $rechnungi++)
      {
        $optional .= "&nbsp;<input type=\"button\" value=\"RE ".$rechnungen[$rechnungi]['belegnr']."\" onclick=\"window.location.href='index.php?module=rechnung&action=pdf&id=".$rechnungen[$rechnungi]['id']."'\">";
      }

      if($optional!="") $optional = "Schnelldruck: ".$optional;


      
      $projekt = $this->app->DB->Select("SELECT projekt from auftrag where id = '$id' LIMIT 1");

      $this->app->Tpl->Add('MESSAGE',"<div class=\"warning\">Dieser Auftrag wurde bereits versendet und darf daher nicht bearbeitet werden!&nbsp;<input type=\"button\" value=\"Schreibschutz entfernen\" onclick=\"if(!confirm('Soll der Schreibschutz f&uuml;r diesen Auftrag wirklich entfernt werden?')) return false;else window.location.href='index.php?module=auftrag&action=schreibschutz&id=$id';\">&nbsp;$optional</div>");
      //      $this->app->erp->CommonReadonly();
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


    $webid = $this->app->DB->Select("SELECT adr.webid FROM auftrag auf LEFT JOIN adresse adr ON adr.id=auf.adresse WHERE auf.id='$id' LIMIT 1");
/*
    if($webid !="" || $webid > 0) {
      $this->app->Tpl->Add('BUTTON_UEBERNEHMEN','
          <a href="url userEdit?action=edit&userID='.$webid.'" onclick="window.open(this.href, \'_blank\', \'\'); return false;">zu '.$this->app->erp->Firmendaten("api_importwarteschlange_name").'</a>
          ');
    }
*/

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
        $this->app->erp->LoadAuftragStandardwerte($id,$adresse);
        header("Location: index.php?module=auftrag&action=edit&id=$id");
        exit;
      }
    }

    // easy table mit arbeitspaketen YUI als template 
    $table = new EasyTable($this->app);
    $table->Query("SELECT ap.bezeichnung as artikel, ap.nummer as Nummer, ap.menge, (SELECT SUM(l.menge) FROM lager_platz_inhalt l WHERE l.artikel=ap.artikel) as Lagerbestand, ap.geliefert ausgeliefert,ap.vpe as VPE, FORMAT(ap.preis,4) as preis
        FROM auftrag_position ap
        WHERE ap.auftrag='$id'");
    $table->DisplayNew(POSITIONEN,"Preis","noAction");

    $summe = $this->app->DB->Select("SELECT FORMAT(SUM(menge*preis),2) FROM auftrag_position
        WHERE auftrag='$id'");
    $waehrung = $this->app->DB->Select("SELECT waehrung FROM auftrag_position
        WHERE auftrag='$id' LIMIT 1");

    $summebrutto = $this->app->DB->Select("SELECT gesamtsumme FROM auftrag WHERE id='$id' LIMIT 1");
    $ust_befreit_check = $this->app->DB->Select("SELECT ust_befreit FROM auftrag WHERE id='$id' LIMIT 1");

    if($ust_befreit_check==1)
      $tmp = "Kunde ist UST befreit";
    else
      $tmp = "Kunde zahlt mit UST";

    if($summe > 0)
      $this->app->Tpl->Add('POSITIONEN', "<br><center>Zu zahlen: <b>$summe (netto) $summebrutto (brutto) $waehrung</b> ($tmp)&nbsp;&nbsp;");

    //$bearbeiter = $this->app->DB->Select("SELECT bearbeiter FROM auftrag WHERE id='$id' LIMIT 1");
    //$this->app->Tpl->Set(BEARBEITER,"<input type=\"text\" value=\"".$this->app->erp->GetAdressName($bearbeiter)."\" readonly size=\"30\">");

    $vertrieb = $this->app->DB->Select("SELECT vertrieb FROM auftrag WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('VERTRIEB',"<input type=\"text\" value=\"".$vertrieb."\" size=\"30\" readonly>");

    //$status= $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");
    //$this->app->Tpl->Set(STATUS,"<input type=\"text\" value=\"".$status."\" readonly>");

    $belegnr= $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('BELEGNR',"<input type=\"text\" value=\"".$belegnr."\" readonly size=\"30\">");


    //$internet = $this->app->DB->Select("SELECT internet FROM auftrag WHERE id='$id' LIMIT 1");
    //$this->app->Tpl->Set(INTERNET,"<input type=\"text\" value=\"".$internet."\" readonly size=\"30\">");

    $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('STATUS',"<input type=\"text\" size=\"30\" value=\"".$status."\" readonly [COMMONREADONLYINPUT]>");




    // ENDE
    

    //alle RE und LS zu diesem Auftrag
    $anzahl =   $this->app->DB->Select("SELECT COUNT(r.belegnr as rechnung) FROM rechnung r LEFT JOIN lieferschein l ON r.lieferschein=l.id WHERE r.adresse='$adresse' AND r.auftrag='$auftragsnummer' AND r.auftrag!=''");

    if($anzahl >0)
    {
      $this->app->Tpl->Set('AUFTRAGSDOKUMENTE',"<fieldset><legend>Rechnungen und Lieferscheine</legend>");

      $table = new EasyTable($this->app);
      $auftragsnummer  = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");
      $table->Query("SELECT r.belegnr as rechnung, DATE_FORMAT(r.datum,'%d.%m.%Y') as ausgang, l.belegnr as lieferschein, r.soll as betrag FROM rechnung r LEFT JOIN lieferschein l ON r.lieferschein=l.id WHERE r.adresse='$adresse' AND r.auftrag='$auftragsnummer' AND r.auftrag!=''");
      $table->DisplayNew('AUFTRAGSDOKUMENTE',"Betrag","noAction");

      $this->app->Tpl->Add('AUFTRAGSDOKUMENTE',"</fieldset>");

    }


    //suche alle LS zu diesem Auftrag

    $auftragsnummer  = $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='$id' LIMIT 1");

    if($auftragsnummer>0)
    {
      $this->app->Tpl->Set('VERSAND',$this->AuftragTrackingTabelle($id));
      /*
         $table->Query("SELECT if(v.versendet_am!='0000-00-00', DATE_FORMAT(v.versendet_am,'%d.%m.%Y'),CONCAT('Heute im Versand<br><a href=\"#\" onclick=\"if(!confirm(\'Auftrag wirklich aus dem Versand nehmen?\')) return false; else window.location.href=\'index.php?module=auftrag&action=ausversand&id=',v.id,'\'\">Aus Versandprozess nehmen</a>')) as datum, v.versandunternehmen as versand, v.tracking, 
         CONCAT('<a href=\"index.php?module=lieferschein&action=pdf&id=',v.lieferschein,'\">PDF</a>') as LS,
         CONCAT('<a href=\"index.php?module=rechnung&action=pdf&id=',v.rechnung,'\">PDF</a>') as RE,
         if(tracking!='',CONCAT('<a href=\"http://nolp.dhl.de/nextt-online-public/set_identcodes.do?lang=de&idc=',tracking,'\" target=\"_blank\">Online-Status</a>'),'') FROM versand v LEFT JOIN lieferschein l ON v.lieferschein=l.id WHERE l.auftrag='$auftragsnummer' AND l.auftrag!=''");
         $table->DisplayNew(VERSAND,"Tracking","noAction");

         $heuteimversand = $this->app->DB->Select("SELECT if(v.versendet_am!='0000-00-00', DATE_FORMAT(v.versendet_am,'%d.%m.%Y'),'Heute im Versand') as datum
         FROM versand v LEFT JOIN lieferschein l ON v.lieferschein=l.id WHERE l.auftrag='$auftragsnummer' AND l.auftrag!=''");

         if($heuteimversand=="Heute im Versand")
         $this->app->Tpl->Add(VERSAND,"<center><a href=\"\" onclick=\"if(!confirm('Wirklich RMA starten?')) return false; else window.location.href='index.php';\">RMA jetzt starten</a></center>");
       */
    } 

    // UST
    $ust_ok = $this->app->DB->Select("SELECT ust_ok FROM auftrag WHERE id='$id' LIMIT 1");
    $ust_befreit = $this->app->DB->Select("SELECT ust_befreit FROM auftrag WHERE id='$id' LIMIT 1");
    $ustid = $this->app->DB->Select("SELECT ustid FROM auftrag WHERE id='$id' LIMIT 1");
    $land = $this->app->DB->Select("SELECT land FROM auftrag WHERE id='$id' LIMIT 1");

    $ustprfid = $this->app->DB->Select("SELECT id FROM ustprf WHERE DATE_FORMAT(datum_online,'%Y-%m-%d')=DATE_FORMAT(NOW(),'%Y-%m-%d') AND adresse='$adresse' AND status='erfolgreich' LIMIT 1");

    if($ust_befreit==0)
    {
      $this->app->Tpl->Set('USTPRUEFUNG',"Abgabe in Deutschland");
    } else if ($ust_befreit==1)
    {

      if($ust_ok == 1)
      {
        $datum = $this->app->DB->Select("SELECT briefbestellt FROM ustprf WHERE id='$ustprfid' LIMIT 1");
        $datum = $this->app->String->Convert($datum,"%1-%2-%3","%3.%2.%1");
        $this->app->Tpl->Set('USTPRUEFUNG',"EU-Lieferung mit Pruefung<br>Brief bestellt: $datum");
      }
      else
        $this->app->Tpl->Set('USTPRUEFUNG',"Pruefung notwendig! (<a href=\"index.php?module=adresse&action=ustprf&id=$adresse\">Starten</a>)");

    } else {
      if($ust_ok == 1)
        $this->app->Tpl->Set('USTPRUEFUNG',"Freigabe Export (Drittland)");
      else
        $this->app->Tpl->Set('USTPRUEFUNG',"Fehlende Freigabe Export!");

    }


    /*
       if($land=="DE")
       $this->app->Tpl->Set('USTPRUEFUNG',"Lieferung nach Deutschland");
       else {

       if($this->app->erp->Export($land)==true)
       {
       $this->app->Tpl->Set('USTPRUEFUNG',"Export Drittland");
       } else {
       if($ustprfid!="" && $ust_befreit==1)
       {
       $datum = $this->app->DB->Select("SELECT briefbestellt FROM ustprf WHERE id='$ustprfid' LIMIT 1");
       $datum = $this->app->String->Convert($datum,"%1-%2-%3","%3.%2.%1");
       $this->app->Tpl->Set('USTPRUEFUNG',"EU-Lieferung mit Pruefung<br>Brief bestellt: $datum");
       }
       else
       {
       if($ustid!="")
       {
       $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");
       $this->app->Tpl->Set('USTPRUEFUNG',"Pruefung notwendig! (<a href=\"index.php?module=adresse&action=ustprf&id=$adresse\">Starten</a>)");
       }
       else
       $this->app->Tpl->Set('USTPRUEFUNG',"Steuer in Deutschland");
       }       

       }

       }
     */

    $versandart = $this->app->DB->Select("SELECT versandart FROM auftrag WHERE id='$id' LIMIT 1");
    if($this->app->Secure->GetPOST("versandart")!="") $versandart = $this->app->Secure->GetPOST("versandart");
    $this->app->Tpl->Set('PACKSTATION',"none");
    if($versandart=="packstation") $this->app->Tpl->Set('PACKSTATION',"");

    $abweichendelieferadresse= $this->app->DB->Select("SELECT abweichendelieferadresse FROM auftrag WHERE id='$id' LIMIT 1");
    if($this->app->Secure->GetPOST("abweichendelieferadresse")!="") $versandart = $this->app->Secure->GetPOST("abweichendelieferadresse");
    $this->app->Tpl->Set('ABWEICHENDELIEFERADRESSESTYLE',"none");
    if($abweichendelieferadresse=="1") $this->app->Tpl->Set('ABWEICHENDELIEFERADRESSESTYLE',"");


    $this->app->Tpl->Set('AKTIV_TAB1',"selected");
    parent::AuftragEdit();
    $this->app->erp->CheckBearbeiter($id,"auftrag");
    $this->app->erp->CheckVertrieb($id,"auftrag");



    // alle zahlungen umbuchen!!!
    /*
       $adressse= $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='$id' LIMIT 1");

       if($adresse > 0 && $id > 0)
       {
       $this->app->DB->Update("UPDATE kontoauszuege_zahlungsausgang SET adresse='$adresse' WHERE objekt='auftrag' AND parameter='$id'")
       $this->app->DB->Update("UPDATE kontoauszuege_zahlungseingang SET adresse='$adresse' WHERE objekt='auftrag' AND parameter='$id'")
       }
     */
    if($this->app->Secure->GetPOST("storno_abschluss")=="1")
      header("Location: index.php?module=stornierungen&action=list");


    if($this->app->Secure->GetPOST("speichern")!="" && $storno=="")
    {
      if($this->app->Secure->GetGET("msg")=="")
      {
        $msg = $this->app->Secure->GetGET("msg");
        $msg = $msg.$this->app->Tpl->Get('MESSAGE')." ";
        $msg = $this->app->erp->base64_url_encode($msg);
      } else {
        $msg = $this->app->Secure->GetGET("msg");
      }

      header("Location: index.php?module=auftrag&action=edit&id=$id&msg=$msg");
      exit;
    } else if ($this->app->Secure->GetPOST("speichern")!="" && $storno=="abschluss")
    {
      header("Location: index.php?module=stornierungen&action=list");
      exit;
    }


    if($this->app->Secure->GetPOST("weiter")!="")
    {
      header("Location: index.php?module=auftrag&action=positionen&id=$id");
      exit;
    }

    $this->AuftragMenu();

  }

  function AuftragUstStart()
  {
    $id = $this->app->Secure->GetGET("id");

    $name= $this->app->DB->Select("SELECT name FROM auftrag WHERE id='$id' LIMIT 1");
    $ustid= $this->app->DB->Select("SELECT ustid FROM auftrag WHERE id='$id' LIMIT 1");
    $land = $this->app->DB->Select("SELECT land FROM auftrag WHERE id='$id' LIMIT 1");
    $ort = $this->app->DB->Select("SELECT ort FROM auftrag WHERE id='$id' LIMIT 1");
    $plz = $this->app->DB->Select("SELECT plz FROM auftrag WHERE id='$id' LIMIT 1");
    $strasse = $this->app->DB->Select("SELECT strasse FROM auftrag WHERE id='$id' LIMIT 1");

    //$this->app->DB->Insert("INSERT INTO ustprf (id,adresse,name,ustid,land,plz,ort,strasse) VALUES ('','$adresse','$name','$ustid','$land','$plz','$ort','$strasse')");
    //$lid = $this->app->DB->GetInsertID();

    $frame = $this->app->Secure->GetGET("frame");
    $id = $this->app->Secure->GetGET("id");

    if($frame=="false")
    {
      // hier nur fenster größe anpassen
      $this->app->YUI->IframeDialog(600,320);
    } else {
      // nach page inhalt des dialogs ausgeben
      //header("Location: index.php?module=adresse&action=ustedit&id=$id&lid=233");
      // WIDGET UST PRUEFUNG!!!!




      $this->app->BuildNavigation=false;
    }


  }


  function AuftragCreate()
  {
    //$this->app->Tpl->Add(KURZUEBERSCHRIFT,"Auftrag");
    $this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","Zur&uuml;ck zur &Uuml;bersicht");

    $anlegen = $this->app->Secure->GetGET("anlegen");

    if($this->app->erp->Firmendaten("schnellanlegen")=="1" && $anlegen!="1")
    {
      header("Location: index.php?module=auftrag&action=create&anlegen=1");
      exit;
    }



    if($anlegen != "")
    {
      $id = $this->app->erp->CreateAuftrag();
      $this->app->erp->AuftragProtokoll($id,"Auftrag angelegt");
      header("Location: index.php?module=auftrag&action=edit&id=$id");
      exit;
    }
    $this->app->Tpl->Set('MESSAGE',"<div class=\"warning\">M&ouml;chten Sie ein Auftrag jetzt anlegen? &nbsp;
        <input type=\"button\" onclick=\"window.location.href='index.php?module=auftrag&action=create&anlegen=1'\" value=\"Ja - Auftrag jetzt anlegen\"></div><br>");
    $this->app->Tpl->Set('TAB1',"
        <table width=\"100%\" style=\"background-color: #fff; border: solid 1px #000;\" align=\"center\">
        <tr>
        <td align=\"center\">
        <br><b style=\"font-size: 14pt\">Auftr&auml;ge in Bearbeitung</b>
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

    $this->app->YUI->TableSearch('AUFTRAGE',"auftraegeinbearbeitung");


    $this->app->Tpl->Set('TABTEXT',"Auftrag anlegen");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");

    /*
       $this->app->Tpl->Add(TABS,"<li><h2>Auftrag</h2></li>");
       $this->app->Tpl->Add(TABS,
       "<li><a href=\"index.php?module=auftrag&action=list\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");

       $anlegen = $this->app->Secure->GetGET("anlegen");

       if($anlegen != "")
       {
       $id = $this->app->erp->CreateAuftrag();
       $this->app->erp->AuftragProtokoll($id,"Auftrag angelegt");
       header("Location: index.php?module=auftrag&action=edit&id=$id");
       exit;
       }

       $this->app->Tpl->Set(AKTIV_TAB1,"selected");
       $this->app->Tpl->Set(PAGE,"<div class=\"info\">M&ouml;chten Sie eine Auftrag jetzt anlegen? 
       <input type=\"button\" onclick=\"window.location.href='index.php?module=auftrag&action=create&anlegen=1'\" value=\"Anlegen\"></div>");
    //parent::AuftragCreate();
     */
  }




  function AuftragReservieren()
  {
    $id = $this->app->Secure->GetGET("id");

    //$this->app->erp->AuftragReservieren($id);
    $this->app->erp->AuftragEinzelnBerechnen($id,true);
    //$this->AuftragList();
    $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Artilel f&uuml;r diesen Auftrag reserviert!</div>  ");

    header("Location: index.php?module=auftrag&action=edit&id=$id&msg=$msg");
    exit;
  }

  function AuftragVersand($id="")
  {
    // mit der funktionen koennen nur erstauftraege abgewickelt koennen!!!
    if($id!="")$internmodus=1;
    if($id=="") $id = $this->app->Secure->GetGET("id");


    // Prozess haengt so lange bis der nächste frei ist
    $fp = $this->app->erp->ProzessLock("auftrag_autoversand");

    // artikel reservieren
    $auftrag = $this->app->DB->SelectArr("SELECT * FROM auftrag WHERE id='$id' LIMIT 1");
    $adresse = $auftrag[0]['adresse'];
    $versandart= $auftrag[0]['versandart'];
    $projekt= $auftrag[0]['projekt'];
    $belegnr = $auftrag[0]['belegnr'];
    $tmpname = $auftrag[0]['name'];
    $keinetrackingmail = $auftrag[0]['keinetrackingmail'];

    $this->app->erp->AuftragEinzelnBerechnen($id);

    $useredittimestamp = $this->app->DB->Select("SELECT TIME_TO_SEC(TIMEDIFF(NOW(), useredittimestamp)) FROM auftrag WHERE id='$id' LIMIT 1");

    $usereditid = $this->app->DB->Select("SELECT usereditid FROM auftrag WHERE id='$id' LIMIT 1");

    if($usereditid == $this->app->User->GetID())
    {
      $useredittimestamp = 1000;
    }

    $anzahl_artikel = $this->app->DB->Select("SELECT COUNT(id) FROM auftrag_position WHERE auftrag=$id");
    if($anzahl_artikel <= 0)
    {
        $meldung = "Auftrag $belegnr kann nicht weitergefuehrt werden, da keine Artikel gebucht sind!";
        $this->app->erp->EventMitSystemLog($this->app->User->GetID(), $meldung, -1,"", "alert", 1);
    }

    if($auftrag[0]['status']=="freigegeben" && $auftrag[0]['nachlieferung']=="0" 
        && $auftrag[0]['lager_ok']=="1"&&$auftrag[0]['porto_ok']=="1"&&$auftrag[0]['ust_ok']=="1"
        && $auftrag[0]['vorkasse_ok']=="1"&&$auftrag[0]['nachnahme_ok']=="1" &&$auftrag[0]['liefertermin_ok']=="1"
        && $auftrag[0]['check_ok']=="1" && $auftrag[0]['autoversand']=="1"
        && $auftrag[0]['kreditlimit_ok']=="1" && $auftrag[0]['liefersperre_ok']=="1" && ($useredittimestamp > 45 || $useredittimestamp <= 0)
        && $anzahl_artikel >=1 )
    {
      // Start
      $this->app->erp->Protokoll("WeiterfuehrenAuftrag AB $belegnr Art: ".$auftrag[0]['art']);
      // pruefe ob es lagerartikel gibt
      $summe_lagerartikel = $this->app->DB->Select("SELECT SUM(ap.id) FROM auftrag_position ap, 
          artikel a WHERE ap.auftrag='$id'  AND a.id=ap.artikel AND a.lagerartikel='1'");

      //if($summe_lagerartikel >0 || $auftrag[0][art]=="rma")
      //TODO wenn nur dienstleistung keinen lieferschein
      if($auftrag[0]['art']=="lieferung" || $auftrag[0]['art']=="standardauftrag" || $auftrag[0]['art']=="")
      {
        $lieferschein = $this->app->erp->WeiterfuehrenAuftragZuLieferschein($id); 
        $this->app->erp->Protokoll("WeiterfuehrenAuftragZuLieferschein AB $belegnr");

        $ls_belegnr = $this->app->erp->GetNextNummer("lieferschein",$projekt);

        $this->app->DB->Update("UPDATE lieferschein SET 
            belegnr='$ls_belegnr', status='freigegeben', versand='".$this->app->User->GetDescription()."' 
            WHERE id='$lieferschein' LIMIT 1");

        $etiketten_positionen = $this->app->DB->Select("SELECT etiketten_positionen FROM projekt WHERE id='$projekt' LIMIT 1");
        $etiketten_art = $this->app->DB->Select("SELECT etiketten_art FROM projekt WHERE id='$projekt' LIMIT 1");
        $etiketten_drucker = $this->app->DB->Select("SELECT etiketten_drucker FROM projekt WHERE id='$projekt' LIMIT 1");
        if($etiketten_positionen > 0)
        {
          $this->app->erp->LieferscheinPositionenDrucken($lieferschein,$etiketten_drucker,$etiketten_art);
        }

      } else {
        // sonst ist lieferschein = 0
        $lieferschein = 0;
      }

      // rechnung  immer außer es ist beistellung bzw. kostenlose lieferung
      if($auftrag[0]['art']=="rechnung" || $auftrag[0]['art']=="standardauftrag" || $auftrag[0]['art']=="")
      {
        // nur erzeugen wenn positionen betrag hpoch genug ist
        $artikelarrsumme = $this->app->DB->Select("SELECT SUM(preis*menge) FROM auftrag_position WHERE auftrag='$id' AND auftrag > 0");
        $this->app->erp->Protokoll("WeiterfuehrenAuftragZuRechnung AB $belegnr Preis ".$artikelarrsumme);

        if($artikelarrsumme>=0.01)
        {
          // versand erzeugen (RE + LS) und verlinken und wenn vorkasse auftrag geld als bezahlt markieren in rechnung
          $rechnung = $this->app->erp->WeiterfuehrenAuftragZuRechnung($id);
          $this->app->DB->Update("UPDATE rechnung SET lieferschein='$lieferschein' WHERE id='$rechnung' LIMIT 1");

          $re_belegnr = $this->app->erp->GetNextNummer("rechnung",$projekt);

          $this->app->erp->Protokoll("WeiterfuehrenAuftragZuRechnung AB $belegnr (id $id) RE $re_belegnr (id $rechnung)");

          $this->app->DB->Update("UPDATE rechnung SET belegnr='$re_belegnr', 
              status='freigegeben', buchhaltung='".$this->app->User->GetDescription()."' WHERE id='$rechnung' LIMIT 1");
        }
      }
      // auftrag_position geliefert_menge und geliefert anpassen
      $artikelarr = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$id' AND auftrag > 0");

      for($i=0;$i<count($artikelarr); $i++)
      {
        $lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='{$artikelarr[$i]['artikel']}' LIMIT 1");
        //if($artikelarr[$i][nummer]!="200000" && $artikelarr[$i][nummer]!="200001" && $artikelarr[$i][nummer]!="200002")
        if($lagerartikel=="1")
        {
          $auftragspositionsid = $artikelarr[$i]['id'];
          $artikel = $artikelarr[$i]['artikel'];
          $menge= $artikelarr[$i]['menge'];
          // lager teile reservieren

          $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE objekt='auftrag' 
              AND parameter='$id' AND artikel='$artikel' ");  

            $this->app->DB->Update("UPDATE auftrag_position SET geliefert_menge='$menge', 
                geliefert='1' WHERE id='$auftragspositionsid' LIMIT 1");
        }
      }
      // nur wenn autoversand projekt
      $autoversand_pruefung = $this->app->DB->Select("SELECT autoversand FROM projekt WHERE id='$projekt' LIMIT 1");
      $automailrechnung =     $this->app->DB->Select("SELECT automailrechnung FROM projekt WHERE id='$projekt' LIMIT 1");

      if($automailrechnung=="1" && $rechnung > 0)
      {
        $this->app->erp->Rechnungsmail($rechnung); 
      }

      $druckercode = $this->app->erp->Firmendaten("standardversanddrucker");

      $kommissionierverfahren = $this->app->DB->Select("SELECT kommissionierverfahren FROM projekt WHERE id='$projekt' LIMIT 1");

      $this->app->erp->Protokoll("WeiterfuehrenAuftragZuRechnung AB $belegnr Kommissionierverfahren: $kommissionierverfahren Projekt $projekt");

      switch($kommissionierverfahren)
      {
        case "rechnungsmail": 
          // rechnung per mail versenden????
          if($automailrechnung && $rechnung > 0)
          {
            // rechnung per mail versenden
            // sende 
            // $this->app->erp->Rechnungsmail($rechnung);
          }
          break;
        default:

          if($kommissionierverfahren=="lieferschein")
          {
            //FALL 1 Lieferschein mit Lagerplatz
            $this->app->erp->LieferscheinAuslagern($lieferschein,false);
            
            // Prozesse ohne Versandzentrum


            $Brief = new LieferscheinPDF($this->app,$projekt);
            $Brief->GetLieferschein($lieferschein);
            $tmpfile = $Brief->displayTMP();
            $tmpfile->ArchiviereDocument();
            //                                                              $this->app->printer->Drucken($druckercode,$tmpfile);

            $fileid_lieferschein = $this->app->erp->CreateDatei($Brief->filename,"lieferschein","","",$tmpfile,$this->app->User->GetName());
            $this->app->erp->AddDateiStichwort($fileid_lieferschein,"lieferschein","lieferschein",$lieferschein,$without_log=false);

            $this->app->DB->Update("UPDATE lieferschein SET status='versendet',versendet='1',schreibschutz='1' WHERE id='$lieferschein' LIMIT 1");
            $this->app->DB->Insert("INSERT INTO dokumente_send 
                (id,dokument,zeit,bearbeiter,adresse,parameter,art,betreff,text,projekt,ansprechpartner,dateiid) VALUES ('','lieferschein',NOW(),'".$this->app->User->GetName()."',
                  '$adresse','$lieferschein','versand','Mitgesendet bei Lieferung','','$projekt','','$fileid_lieferschein')");
            $this->app->erp->LieferscheinProtokoll($lieferschein,"Lieferschein versendet (Auto-Versand)");

            unlink($tmpfile);
            // Druck Auftrag Anhang wenn aktiv
            if(1)//if($this->app->erp->Projektdaten($projekt,"autodruckanhang")=="1")
            {
              // alle anhaenge drucken! wo auftrag datei anhang
              $tmpanhang = $this->app->erp->GetDateiSubjektObjekt("anhang","Auftrag",$id);
              //                                                                     for($i=0;$i<count($tmpanhang);$i++)
              //                                                                     $this->app->printer->Drucken($druckercode,$tmpanhang[$i]);
              $tmpanhang ="";
            }
          }


          //FALL 2 // logistikzentrum

          // auftrag_position geliefert_menge und geliefert anpassen
          $artikelarr = $this->app->DB->SelectArr("SELECT * FROM auftrag_position WHERE auftrag='$id'");

          for($i=0;$i<count($artikelarr); $i++)
          {
            $lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='{$artikelarr[$i]['artikel']}' LIMIT 1");
            //if($artikelarr[$i][nummer]!="200000" && $artikelarr[$i][nummer]!="200001" && $artikelarr[$i][nummer]!="200002")
            if($lagerartikel=="1")
            {
              $auftragspositionsid = $artikelarr[$i]['id'];
              $artikel = $artikelarr[$i]['artikel'];
              $menge= $artikelarr[$i]['menge'];
              // lager teile reservieren

              $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE objekt='auftrag' 
                  AND parameter='$id' AND artikel='$artikel' ");  

                if($kommissionierverfahren=="zweistufig")
                {
                  $this->app->DB->Insert("INSERT INTO lager_reserviert (id,adresse,artikel,menge,grund,projekt,
                    firma,bearbeiter,datum,objekt,parameter)
                      VALUES('','$adresse','$artikel','$menge','Versand f&uuml;r Auftrag $belegnr','$projekt',
                        '".$this->app->User->GetFirma()."','".$this->app->User->GetName()."','9999-01-01','lieferschein','$lieferschein')");
                }

                $this->app->DB->Update("UPDATE auftrag_position SET geliefert_menge='$menge', 
                  geliefert='1' WHERE id='$auftragspositionsid' LIMIT 1");
            }
          }
          //ende 
      }

      // auftrag abschliessen
      $this->app->DB->Update("UPDATE auftrag SET status='abgeschlossen' WHERE id='$id' LIMIT 1");

      // auftrag abschliessen und event senden

      $this->app->erp->Protokoll("MESSAGE BEENDET UNLOCK");
      $this->app->erp->ProzessUnlock($fp);

      // kundenfreigabe loeschen wenn das im projekt eingestellt ist
      $checkok = $this->app->DB->Select("SELECT kundenfreigabe_loeschen FROM projekt WHERE id='$projekt' LIMIT 1");
      if($checkok==1)
        $this->app->DB->Update("UPDATE adresse SET kundenfreigabe='0' WHERE id='$adresse' LIMIT 1");


      // wenn per URL aufgerufen      
      if($internmodus!="1")
      {
        header("Location: index.php?module=auftrag&action=edit&id=$id&msg=$msg");
        exit;
      }
    }

    $this->app->erp->Protokoll("MESSAGE BEENDET UNLOCK 2");
    //$this->app->erp->ProzessUnlock("auftrag_autoversand");
    $this->app->erp->ProzessUnlock($fp);

    // wenn per URL aufgerufen
    if($internmodus!="1")
    {
      //      $this->AuftragList();

      //header("Location: index.php?module=auftrag&action=search");
      header("Location: index.php?module=auftrag&action=edit&id=$id");
      exit;
    }

  }


  function AuftragSelbstabholerNachricht()
  {
    // kann man immer wieder aufrufen wenn ein teilchen gekommen ist bis auftrag voll erfuellt ist

  }

  function AuftragSelbstabholerAbgeholt()
  {
    // kann man immer wieder aufrufen wenn ein teilchen gekommen ist bis auftrag voll erfuellt ist

  }


  function AuftragNachlieferungCheck()
  {

    //echo "pruefe ob eine Nachlieferung gemacht werden kann";

  }


  function AuftragNachlieferung()
  {
    // kann man immer wieder aufrufen wenn ein teilchen gekommen ist bis auftrag voll erfuellt ist

  }




  function AuftragVerfuegbar()
  {
    $frame = $this->app->Secure->GetGET("frame");
    $id = $this->app->Secure->GetGET("id");
    if($frame=="false")
    {
      // hier nur fenster größe anpassen
      $this->app->YUI->IframeDialog(600,400);
    } else {
      // nach page inhalt des dialogs ausgeben
      $table = new EasyTable($this->app); 
      $table->Query("SELECT ap.nummer, ap.bezeichnung, ap.menge, (SELECT SUM(lp.menge) FROM lager_platz_inhalt lp WHERE lp.artikel=ap.artikel) as lager, 
          (SELECT SUM(lr.menge) FROM lager_reserviert lr WHERE lr.artikel=ap.artikel AND lr.datum>=NOW() AND lr.objekt!='lieferschein') as reserviert, 
          if(((SELECT SUM(lp.menge) FROM lager_platz_inhalt lp WHERE lp.artikel=ap.artikel) - (SELECT SUM(lr.menge) FROM lager_reserviert lr WHERE lr.artikel=ap.artikel AND lr.datum>=NOW() AND lr.objekt!='lieferschein') - ap.menge)>=0,'',
            ((SELECT SUM(lp.menge) FROM lager_platz_inhalt lp WHERE lp.artikel=ap.artikel) - (SELECT SUM(lr.menge) FROM lager_reserviert lr WHERE lr.artikel=ap.artikel AND lr.datum>=NOW() AND lr.objekt!='lieferschein') - ap.menge)
            ) as fehlend 
          FROM auftrag_position ap LEFT JOIN artikel a ON a.id=ap.artikel WHERE ap.auftrag='$id' AND a.lagerartikel=1");

      $table->DisplayNEW('PAGE',"Fehlende","noAction");



      $this->app->BuildNavigation=false;
    }
  }

  function AuftragAmpel($id,$parsetarget)
  {

    $status = $this->app->DB->Select("SELECT status FROM auftrag WHERE id='$id' LIMIT 1");

    if($status=="abgeschlossen" || $status=="storniert")
    {
      $go = "<img src=\"./themes/new/images/grey.png\" width=\"17\" border=\"0\">";
      $stop = "<img src=\"./themes/new/images/grey.png\" width=\"17\" border=\"0\">";
      $reserviert = "<img src=\"./themes/new/images/grey.png\" width=\"17\" border=\"0\">";
      $check = "<img src=\"./themes/new/images/grey.png\" width=\"17\" border=\"0\">";
    } else {

      $go = "<img src=\"./themes/new/images/go.png\" width=\"17\" border=\"0\">";
      $stop = "<img src=\"./themes/new/images/stop.png\" width=\"17\" border=\"0\">";
      $reserviert = "<img src=\"./themes/new/images/reserviert.png\" width=\"17\" border=\"0\">";
      $check = "<img src=\"./themes/new/images/mail-mark-important.png\" width=\"17\" border=\"0\">";

    }

    // offene Auftraege
    $table = new EasyTable($this->app);
    $sql = "SELECT DATE_FORMAT(a.datum,'%d.%m.%Y') as vom, if(a.belegnr!='',a.belegnr,'ohne Nummer') as auftrag, a.internet, CONCAT('<a href=\"index.php?module=adresse&action=edit&id=',a.adresse,'\">',a.name,'</a>') as name, a.land, p.abkuerzung as projekt, a.zahlungsweise as per, a.gesamtsumme as soll,"; 
    $subsql = "'0' as ist,";
    $sql .= $subsql. "if(a.check_ok,'','<a href=\"index.php?module=auftrag&action=checkdisplay&id=1031&frame=false\" onclick=\"makeRequest(this); return false;\">$check</a>') as AC, 

        if(a.reserviert_ok,'$reserviert','') as AR, 
        if(a.lager_ok,'$go','$stop') as LA, 
        if(a.porto_ok,'$go','$stop') as PO, 
        if(a.ust_ok,'$go',CONCAT('<a href=\"/index.php?module=adresse&action=ustprf&id=',a.adresse,'\">','$stop','</a>')) as ST, 
        if(a.vorkasse_ok,'$go','$stop') as ZE, 
        if(a.nachnahme_ok,'$go','$stop') as N, 
        if(a.autoversand,'$go','$stop') as A, 
        if(a.liefertermin_ok,'$go','$stop') as LT, 
        a.id
        FROM auftrag a, projekt p WHERE a.inbearbeitung=0 AND p.id=a.projekt AND a.id=$id LIMIT 1";
        
    $table->Query($sql);

    /*
       $table->DisplayNew($parsetarget, "
       <a href=\"index.php?module=auftrag&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
       <a onclick=\"if(!confirm('Wirklich stornieren?')) return false; else window.location.href='index.php?module=auftrag&action=delete&id=%value%';\">
       <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
       <a onclick=\"if(!confirm('Wirklich kopieren?')) return false; else window.location.href='index.php?module=auftrag&action=copy&id=%value%';\">
       <img src=\"./themes/new/images/copy.png\" border=\"0\"></a>
       <a onclick=\"if(!confirm('Wirklich als Lieferschein weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=auftrag&action=lieferschein&id=%value%';\">
       <img src=\"./themes/new/images/lieferung.png\" border=\"0\" alt=\"weiterf&uuml;hren als Lieferschein\"></a>
       <a onclick=\"if(!confirm('Wirklich als Rechnung weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=auftrag&action=rechnung&id=%value%';\">
       <img src=\"./themes/new/images/rechnung.png\" border=\"0\" alt=\"weiterf&uuml;hren als Rechnung\"></a>
       <a onclick=\"if(!confirm('Wirklich als Versand weiterf&uuml;hren?')) return false; else window.location.href='index.php?module=auftrag&action=versand&id=%value%';\">
       <img src=\"./themes/new/images/versand.png\" width=\"18\" border=\"0\" alt=\"weiterf&uuml;hren als Versand\"></a>
       ");

     */
    $table->DisplayNew($parsetarget, "
        <a href=\"index.php?module=auftrag&action=pdf&id=%value%\"><img border=\"0\" src=\"./themes/new/images/pdf.png\"></a>
        <a onclick=\"if(!confirm('Wirklich stornieren?')) return false; else window.location.href='index.php?module=auftrag&action=delete&id=%value%';\">
        <img src=\"./themes/new/images/delete.gif\" border=\"0\"></a>
        ");


  }


  function AuftragList()
  {
    //   $this->app->Tpl->Set(UEBERSCHRIFT,"Auftr&auml;ge");
    //    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Auftr&auml;ge");

    $backurl = $this->app->Secure->GetGET("backurl");
    $backurl = $this->app->erp->base64_url_decode($backurl);


    $this->app->Tpl->Set('WIDGETCONTENT',"<h2>Lagerlampen</h2><br><div class=\"tabsbutton\"><a href=\"index.php?module=artikel&action=lagerlampe\">Einstellungen</a></div>");
    $this->app->Tpl->Parse('WIDGET',"widget.tpl");


    $this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=auftrag&action=create","Neuen Auftrag anlegen");
    $this->app->erp->MenuEintrag("index.php?module=auftragoffenepositionen&action=list","Offene Positionen");


    if(strlen($backurl)>5)
      $this->app->erp->MenuEintrag("$backurl","Zur&uuml;ck zur &Uuml;bersicht");
    else
      $this->app->erp->MenuEintrag("index.php","Zur&uuml;ck zur &Uuml;bersicht");


    // ZAHLUNGSMAIL 
    $zahlungsmail= $this->app->Secure->GetPOST("zahlungsmail");

    if($zahlungsmail!="")
    {
      $meineauftraege = $this->app->DB->SelectArr("SELECT id FROM auftrag WHERE status='freigegeben' 
          AND vorkasse_ok!='1' AND zahlungsweise!='rechnung' AND zahlungsweise!='nachnahme' AND zahlungsweise!='bar' AND zahlungsweise!='lastschrift'");
      for($i=0;$i<count($meineauftraege);$i++)
      {
        $this->app->erp->AuftragNeuberechnen($meineauftraege[$i][id]);

        $this->app->erp->AuftragEinzelnBerechnen($meineauftraege[$i][id]);
        $adresse = $this->app->DB->Select("SELECT adresse FROM auftrag WHERE id='{$meineauftraege[$i][id]}' LIMIT 1");
        $belegnr= $this->app->DB->Select("SELECT belegnr FROM auftrag WHERE id='{$meineauftraege[$i][id]}' LIMIT 1");
        /*        
                  $tage = $this->app->DB->Select("SELECT DATEDIFF(NOW(),zahlungsmail) FROM auftrag WHERE id='{$meineauftraege[$i][id]}' LIMIT 1");
                  if(!is_numeric($tage))
                  {
                  $tage = $this->app->DB->Select("SELECT DATEDIFF(NOW(),datum) FROM auftrag WHERE id='{$meineauftraege[$i][id]}' LIMIT 1");
                  } 
                  if($tage > 7)
                  {
         */
        $this->app->erp->AuftragZahlungsmail($meineauftraege[$i][id]);
        //      }
        //$this->app->erp->Zahlungsmail($adresse,$auftragssumme-$summeimauftrag,$belegnr);
        //$this->AuftragVersand($meineauftraege[$i][id]);
      }
    }

    //   $checkarr = $this->app->DB->Select("SELECT count(a.id) FROM auftrag a WHERE a.status='angelegt'");

    //    if($checkarr >0 && $this->app->Secure->GetGET("msg")=="") 
    //      $this->app->Tpl->Add('MESSAGE',"<div class=\"warning\">Achtung es gibt Auftr&auml;ge in \"in Bearbeitung\"!</div>");



    // AUFTAEGE ABSCHLIESSEN!
    $submit = $this->app->Secure->GetPOST("submit");
    $auftraegemarkiert = $this->app->Secure->GetPOST("auftraegemarkiert");
    if($submit!="")
    {

      // aufsteigend sortieren erst die alten IDs
      sort($auftraegemarkiert);

      for($i=0;$i<count($auftraegemarkiert);$i++)
      {
        $this->app->erp->AuftragEinzelnBerechnen($auftraegemarkiert[$i]);
        $this->AuftragVersand($auftraegemarkiert[$i]);
      }

      //$meineauftraege = $this->app->DB->SelectArr("SELECT id FROM auftrag WHERE status='freigegeben' AND nachlieferung!='1' ORDER by datum");
      /*
         for($i=0;$i<count($meineauftraege);$i++)
         {
         $this->app->erp->AuftragEinzelnBerechnen($meineauftraege[$i][id]);
         $this->AuftragVersand($meineauftraege[$i][id]);
         }
       */
    }

    // auftraege berechnen
    //$this->AuftraegeBerechnen(); // lager waren und summen und status  //TODO dauert viel zu lange!!

    $zahlungsweisen = $this->app->DB->SelectArr('
      SELECT
        zahlungsweise
      FROM
        auftrag
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
        auftrag
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
        auftrag
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
    $this->app->YUI->AutoComplete("auftragsnummer", "auftrag", 1);
    // $this->app->YUI->AutoComplete("name", "adressename", 1);

    $this->app->Tpl->Add('ZAHLUNGSWEISEN',$zahlungsweiseStr);
    $this->app->Tpl->Add('STATUS',$statusStr);
    $this->app->Tpl->Add('VERSANDARTEN',$versandartenStr);
    $this->app->Tpl->Add('LAENDER',$laenderStr);
    $this->app->Tpl->Parse('TAB1',"auftrag_table_filter.tpl");

    $this->app->YUI->TableSearch('TAB2',"auftraegeoffeneauto");
    $this->app->YUI->TableSearch('TAB1',"auftraege");
    $this->app->YUI->TableSearch('TAB3',"auftraegeoffene");

    if($this->app->erp->Firmendaten("api_importwarteschlange")=="1")
    {
      $this->app->Tpl->Set('IMPORTWARTESCHLANGENAME',$this->app->erp->Firmendaten("api_importwarteschlange_name"));
      $this->app->YUI->TableSearch('TAB4',"auftraegeinbearbeitungimport");
    }
    else {
      $this->app->Tpl->Set('STARTDISABLEIMPORT',"<!--");
      $this->app->Tpl->Set('ENDEDISABLEIMPORT',"-->");

    }       

    $this->app->YUI->TableSearch('TAB5',"auftraegeinbearbeitung");

    $this->app->Tpl->Parse('PAGE',"auftraguebersicht.tpl");
  }
  
}
?>
