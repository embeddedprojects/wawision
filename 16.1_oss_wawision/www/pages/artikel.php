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
include ("_gen/artikel.php");

class Artikel extends GenArtikel {
  var $app;

  function Artikel($app) {
    //parent::GenArtikel($app);
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","ArtikelCreate");
    $this->app->ActionHandler("edit","ArtikelEdit");
    $this->app->ActionHandler("list","ArtikelList");
    $this->app->ActionHandler("newlist","ArtikelNewList");
    $this->app->ActionHandler("stueckliste","ArtikelStueckliste");
    $this->app->ActionHandler("stuecklisteimport","ArtikelStuecklisteImport");
    $this->app->ActionHandler("stuecklisteupload","ArtikelStuecklisteUpload");
    $this->app->ActionHandler("instueckliste","ArtikelInStueckliste");
    $this->app->ActionHandler("delstueckliste","DelStueckliste");
    $this->app->ActionHandler("stuecklisteempty","ArtikelStuecklisteEmpty");
    $this->app->ActionHandler("upstueckliste","UpStueckliste");
    $this->app->ActionHandler("downstueckliste","DownStueckliste");
    $this->app->ActionHandler("editstueckliste","ArtikelStuecklisteEditPopup");
    $this->app->ActionHandler("verkauf","ArtikelVerkauf");
    $this->app->ActionHandler("copy","ArtikelCopy");
    $this->app->ActionHandler("schliessen","ArtikelSchliessen");
    $this->app->ActionHandler("verkaufeditpopup","ArtikelVerkaufEditPopup");
    $this->app->ActionHandler("verkaufcopy","ArtikelVerkaufCopy");
    $this->app->ActionHandler("verkaufdelete","ArtikelVerkaufDelete");
    $this->app->ActionHandler("verkaufdisable","ArtikelVerkaufDisable");
    $this->app->ActionHandler("einkauf","ArtikelEinkauf");
    $this->app->ActionHandler("einkaufdelete","ArtikelEinkaufDelete");
    $this->app->ActionHandler("einkaufdisable","ArtikelEinkaufDisable");
    $this->app->ActionHandler("einkaufcopy","ArtikelEinkaufCopy");
    $this->app->ActionHandler("einkaufeditpopup","ArtikelEinkaufEditPopup");
    $this->app->ActionHandler("projekte","ArtikelProjekte");
    $this->app->ActionHandler("lager","ArtikelLager");
    $this->app->ActionHandler("mindesthaltbarkeitsdatum","ArtikelMHD");
    $this->app->ActionHandler("mhddelete","ArtikelMHDDelete");
    $this->app->ActionHandler("chargedelete","ArtikelChargeDelete");
    $this->app->ActionHandler("chargen","ArtikelChargen");
    $this->app->ActionHandler("wareneingang","ArtikelWareneingang");
    $this->app->ActionHandler("offenebestellungen","ArtikelOffeneBestellungen");
    $this->app->ActionHandler("statistik","ArtikelStatistik");
    $this->app->ActionHandler("offeneauftraege","ArtikelOffeneAuftraege");
    $this->app->ActionHandler("dateien","ArtikelDateien");
    $this->app->ActionHandler("provision","Artikelprovision");
    $this->app->ActionHandler("delete","ArtikelDelete");
    $this->app->ActionHandler("auslagern","ArtikelAuslagern");
    $this->app->ActionHandler("einlagern","ArtikelEinlagern");
    $this->app->ActionHandler("umlagern","ArtikelUmlagern");
    $this->app->ActionHandler("ausreservieren","ArtikelAusreservieren");
    $this->app->ActionHandler("etiketten","ArtikelEtiketten");
    $this->app->ActionHandler("reservierung","ArtikelReservierung");
    $this->app->ActionHandler("onlineshop","ArtikelOnlineShop");
    $this->app->ActionHandler("ajaxwerte","ArtikelAjaxWerte");
    $this->app->ActionHandler("profisuche","ArtikelProfisuche");
    $this->app->ActionHandler("lagerlampe","ArtikelLagerlampe");
    $this->app->ActionHandler("shopexport","ArtikelShopexport");
    $this->app->ActionHandler("shopimport","ArtikelShopimport");
    $this->app->ActionHandler("shopexportfiles","ArtikelShopexportFiles");
    $this->app->ActionHandler("stuecklisteetiketten","ArtikelStuecklisteEtiketten");
    $this->app->ActionHandler("minidetail","ArtikelMiniDetail");
    $this->app->ActionHandler("lagersync","ArtikelLagerSync");
    $this->app->ActionHandler("thumbnail", "ArtikelThumbnail");
    $this->app->ActionHandler("schnellanlegen", "ArtikelSchnellanlegen");

    $id = $this->app->Secure->GetGET("id");
    $nummer = $this->app->Secure->GetPOST("nummer");

    if(is_numeric($id)) 
    {
      $artikel = $this->app->DB->Select("SELECT CONCAT(name_de,' (',nummer,')') FROM artikel WHERE id='$id' LIMIT 1");
      $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
      $namede = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");
    } 
    else
      $artikel = $nummer; 


    if($artikel!="")
      $this->app->Tpl->Set('UEBERSCHRIFT',"Artikel: ".$artikel);
    else $this->app->Tpl->Set('UEBERSCHRIFT',"Artikel");

    $this->app->Tpl->Set('ANZEIGENUMMER',$nummer);
    if(isset($namede))$this->app->Tpl->Set('ANZEIGENAMEDE'," ".$this->app->erp->LimitChar($namede,65));
    $this->app->Tpl->Set('FARBE',"[FARBE1]");


    $this->app->ActionHandlerListen($app);

    $this->app = $app;
  }



  function ArtikelLagerSync()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE artikel SET cache_lagerplatzinhaltmenge='-100' WHERE id='$id'");
    $sync =  $this->app->erp->LagerSync($id,true);
    if($sync==1) echo "gruen";
    else echo "gelb";
    exit;
  }

  function Preisrechner()
  {

    $steuer_normal_komma = ($this->app->erp->GetStandardSteuersatzNormal() + 100)/100.0;
    $steuer_ermaessigt_komma = ($this->app->erp->GetStandardSteuersatzErmaessigt() + 100)/100.0;

    $this->app->Tpl->Set('PREISRECHNER',"<input type=\"button\" value=\"+".$this->app->erp->GetStandardSteuersatzNormal()."\" onclick=\"this.form.preis.value=parseFloat(this.form.preis.value.split(',').join('.'))*$steuer_normal_komma;\">");
    $this->app->Tpl->Add('PREISRECHNER',"<input type=\"button\" value=\"-".$this->app->erp->GetStandardSteuersatzNormal()."\" onclick=\"this.form.preis.value=parseFloat(this.form.preis.value.split(',').join('.'))/$steuer_normal_komma;\">");
    if($this->app->erp->Version()!="stock")
    {
      $this->app->Tpl->Add('PREISRECHNER',"<br><input type=\"button\" value=\"+".$this->app->erp->GetStandardSteuersatzErmaessigt()."\" onclick=\"this.form.preis.value=parseFloat(this.form.preis.value.split(',').join('.'))*$steuer_ermaessigt_komma;\">");
      $this->app->Tpl->Add('PREISRECHNER',"<input type=\"button\" value=\"-".$this->app->erp->GetStandardSteuersatzErmaessigt()."\" onclick=\"this.form.preis.value=parseFloat(this.form.preis.value.split(',').join('.'))/$steuer_ermaessigt_komma;\">");
    }
  }


  function ArtikelMiniDetail($parsetarget="",$menu=true)
  {
    $id=$this->app->Secure->GetGET("id");

    $this->app->Tpl->Set(ID,$id);

    $kurztext_de = $this->app->DB->Select("SELECT kurztext_de FROM artikel WHERE id='$id' LIMIT 1");
    if($kurztext_de=="")
      $kurztext_de = $this->app->DB->Select("SELECT anabregs_text FROM artikel WHERE id='$id' LIMIT 1");

    $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");
    $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('NAME_DE',$name_de);
    $this->app->Tpl->Set('NUMMER',$nummer);

    $standardbild = $this->app->erp->GetArtikelStandardbild($id,true);

    if($standardbild > 0)
      $this->app->Tpl->Set('ARTIKELBILD',"<img src=\"index.php?module=dateien&action=send&id=$standardbild\" width=\"200\" align=\"left\" style=\"margin-right:10px; margin-bottom:10px;\">");

    $lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='$id' LIMIT 1");
    $lager_platz = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='$id' LIMIT 1");

    if($lagerartikel>0)
      $this->app->Tpl->Set('LAGERLINK',"&nbsp;<a href=\"index.php?module=artikel&action=lager&id=$id\">&rArr;</a>");
    else
      $this->app->Tpl->Set('LAGERLINK',"");

    $this->app->Tpl->Set('KURZTEXT',$kurztext_de);



    // easy table mit arbeitspaketen YUI als template 
    $table = new EasyTable($this->app);
    $table->Query("SELECT CONCAT(l.bezeichnung,' / ',lp.kurzbezeichnung, if(lp.sperrlager,' (Kein Auto-Versand Lager)',''),
        if(lp.poslager,' (POS Lager)',''),if(lp.verbrauchslager,' (Verbrauchslager)',''),if(lp.autolagersperre,' (Nachschublager)','')) as lager, lpi.menge as menge
        FROM lager_platz_inhalt lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id  
        LEFT JOIN lager l ON l.id=lp.lager WHERE lpi.artikel='$id' ");

    $table->DisplayNew('ARTIKEL',"Menge","noAction");

    if($lager_platz > 0)
    {
      $lager = $this->app->DB->Select("SELECT lager FROM lager_platz WHERE id='$lager_platz' LIMIT 1");
      $lagerhauptbezeichung = $this->app->DB->Select("SELECT bezeichnung FROM lager WHERE id='$lager' LIMIT 1");
      $lagerbezeichnung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$lager_platz' LIMIT 1");
      if($lagerbezeichnung=="") $lagerbezeichnung="kein Standardlager eingestellt";
      $this->app->Tpl->Add('ARTIKEL',"<br>Standardlager: $lagerhauptbezeichung / $lagerbezeichnung<br><br>");
    }

    $this->app->Tpl->Add('ARTIKEL',$this->app->erp->ArtikelLagerInfo($id));

    $table = new EasyTable($this->app);
    $table->Query("SELECT adr.name as kunde, adr.kundennummer as kdnr, r.menge,p.abkuerzung as projekt,r.grund  FROM lager_reserviert r LEFT JOIN artikel a ON a.id=r.artikel LEFT JOIN projekt p ON 
        p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id WHERE r.firma='{$this->app->User->GetFirma()}' AND a.id='$id'");

    $table->DisplayNew('RESERVIERT',"Grund","noAction");


    $table = new EasyTable($this->app);
    $table->Query("SELECT p.belegnr,a.name, a.kundennummer as kdnr, p.status,po.menge FROM auftrag_position po LEFT JOIN auftrag p ON p.id=po.auftrag LEFT JOIN adresse a ON a.id=p.adresse  WHERE po.artikel='$id' AND (p.status!='abgeschlossen' AND p.status!='storniert')");


    $table->DisplayNew('AUFTRAG',"Menge","noAction");

    $table = new EasyTable($this->app);
    /* $table->Query("SELECT DATE_FORMAT(b.datum,'%d.%m.%Y') as datum, CONCAT('<a href=\"index.php?module=bestellung&action=edit&id=',b.id,'\" target=\"_blank\">',b.belegnr,'</a>') as 'bestellung Nr.', bp.bestellnummer as Nummer, bp.menge, bp.geliefert, bp.vpe as VPE, a.lieferantennummer as lieferant, a.name as name, if(bp.lieferdatum!='0000-00-00', DATE_FORMAT(bp.lieferdatum,'%d.%m.%Y'),'sofort') as lieferdatum, b.status as status
       FROM bestellung_position bp LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN adresse a ON b.adresse=a.id
       WHERE artikel='$id' AND b.status!='storniert' AND b.status!='abgeschlossen' AND bp.geliefert<bp.menge ORDER by bp.lieferdatum DESC");
     */

    $table->Query("SELECT DATE_FORMAT(b.datum,'%d.%m.%Y') as datum, CONCAT('<a href=\"index.php?module=bestellung&action=edit&id=',b.id,'\" target=\"_blank\">',b.belegnr,'</a>') as 'bestellung', bp.menge, bp.geliefert, LEFT(a.name,20) as name, if(bp.lieferdatum!='0000-00-00', DATE_FORMAT(bp.lieferdatum,'%d.%m.%Y'),'sofort') as lieferdatum
        FROM bestellung_position bp LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN adresse a ON b.adresse=a.id
        WHERE artikel='$id' AND b.status!='storniert' AND b.status!='abgeschlossen' AND bp.geliefert<bp.menge ORDER by bp.lieferdatum DESC");

    $table->DisplayNew('BESTELLUNG',"Lieferdatum","noAction");

    $table = new EasyTable($this->app);
    $table->Query("SELECT a.name as lieferant, e.ab_menge ab, e.preis, e.waehrung FROM einkaufspreise e LEFT JOIN adresse a ON a.id=e.adresse
        WHERE e.artikel='$id' AND e.geloescht!=1 AND (e.gueltig_bis >= NOW() OR e.gueltig_bis='0000-00-00')");

    $table->DisplayNew('EINKAUFSPREISE',"Waehrung","noAction");


    $table = new EasyTable($this->app);
    $table->Query("SELECT if(a.name='' OR a.id IS NULL,if(v.gruppe > 0,(SELECT CONCAT(g.name,' ',g.kennziffer) FROM gruppen g WHERE g.id=v.gruppe ),'Alle'),a.name) as kunde, v.ab_menge ab, v.preis, v.waehrung FROM verkaufspreise v LEFT JOIN adresse a ON a.id=v.adresse
        WHERE v.artikel='$id' AND v.geloescht!=1 AND (v.gueltig_bis >= NOW() OR v.gueltig_bis='0000-00-00')");

    $table->DisplayNew('VERKAUFSPREISE',"Waehrung","noAction");


    $table = new EasyTable($this->app);
    $table->Query("SELECT e.hauptkategorie, e.unterkategorie, e.wert, e.einheit
        FROM eigenschaften e LEFT JOIN artikel a ON a.id=e.artikel 
        WHERE a.id='$id' ORDER by e.bezeichnung");
    $table->DisplayNew('EIGENSCHAFTEN',"Einheit","noAction");

    $table = new EasyTable($this->app);
    $table->Query("SELECT a.nummer, LEFT(a.name_de,30) as artikel, s.menge FROM stueckliste s 
        LEFT JOIN artikel a ON s.artikel=a.id 
        WHERE s.stuecklistevonartikel='$id' ORDER by a.nummer");
    $table->DisplayNew('STUECKLISTE',"Menge","noAction");






    $this->app->Tpl->Output("artikel_minidetail.tpl");
    exit;
  }

  function ArtikelFremdnummern()
  {
    $this->ArtikelMenu();
    $id = (int)$this->app->Secure->GetGET("id");
    
    $this->app->YUI->TableSearch('TAB1',"artikel_fremdnummern");
    
    $this->app->Tpl->Parse('PAGE', 'artikel_fremdnummern.tpl');
  }
  

  function ArtikelShopimport()
  {
    $id = $this->app->Secure->GetGET("id"); 
    $shop = $this->app->Secure->GetGET("shop"); 
    $artikel = array($id);

    if($shop=="1")
      $shop = $this->app->DB->Select("SELECT shop FROM artikel WHERE id='$id' LIMIT 1");
    elseif($shop=="2")
      $shop = $this->app->DB->Select("SELECT shop2 FROM artikel WHERE id='$id' LIMIT 1");
    elseif($shop=="3")
      $shop = $this->app->DB->Select("SELECT shop3 FROM artikel WHERE id='$id' LIMIT 1");

    $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
    $extnummer = $this->app->DB->Select("SELECT nummer FROM artikelnummer_fremdnummern WHERE artikel = '$id' AND shopid='$shop' AND aktiv = 1 LIMIT 1");
    if($extnummer)$nummer = $extnummer;
    $result = $this->app->remote->RemoteGetArticle($shop,$nummer);

    if(is_array($result))
    {
      $result['uebersicht_de'] = htmlentities($result['uebersicht_de'],ENT_QUOTES, "UTF-8");
      $result['uebersicht_en'] = htmlentities($result['uebersicht_en'],ENT_QUOTES, "UTF-8");
      
      if($result['name_de']=="" && $result['name']!="") $result['name_de']=$result['name'];
    }

      


    

    if(is_array($result) && $result['name_de']!="" && !is_array($result['name_de']) && !empty($result['name_de']))
    {
      //$result['name_de'] = $result['name'];
      if($result['aktiv'] !="1")  $result['inaktiv']=1; else $result['inaktiv']=0;


      $fields = array('name_de','kurztext_de','uebersicht_de','name_en','kurztext_en','uebersicht_en','beschreibung_de','beschreibung_en','metakeywords_de','metakeywords_en','metadescription_de','metadescription_en',
        'inaktiv','pseudopreis','lieferzeitmanuell','pseudolager','autolagerlampe','restmenge','gewicht','downloadartikel');

      if($result['restmenge']!="1") $result['restmenge']=0;

      // pseudolager
      $result['autolagerlampe']=1;
      
      //name
      foreach($fields as $nameofcolumn)
      {
        if(isset($result[$nameofcolumn]))
        {
          if(($result[$nameofcolumn]!="" && !is_array($result[$nameofcolumn])) || $nameofcolumn=="lieferzeitmanuell" || $nameofcolumn=="pseudopreis")
            $this->app->DB->Update("UPDATE artikel SET ".$nameofcolumn."='".$result[$nameofcolumn]."' WHERE id='$id' LIMIT 1");
        }
      }

      //preis_netto
      if($result['preis_netto'] > 0)
      {
        $this->app->erp->AddVerkaufspreis($id,1,0,$result['preis_netto']);
      }
      $msg = $this->app->erp->base64_url_encode("<div class=info>Der Artikel wurde aus dem Shop geladen und nach WaWision importiert!</div>"); 
    } else {
      $check = strpos($result ,"error:");

      if($check===0)
      {
        $result = str_replace("error:","",$result);
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Fehlermeldung vom Shop: $result</div>");
      } else {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Es gab keine R&uuml;ckmeldung vom Shop! $result</div>");
      }
    }
    header("Location: index.php?module=artikel&action=edit&id=$id&msg=$msg#tabs-4");
    exit;
  }

  function ArtikelShopexport()
  {
    $id = $this->app->Secure->GetGET("id"); 
    $shop = $this->app->Secure->GetGET("shop"); 
    $artikel = array($id);

    if($shop=="1")
      $shop = $this->app->DB->Select("SELECT shop FROM artikel WHERE id='$id' LIMIT 1");
    elseif($shop=="2")
      $shop = $this->app->DB->Select("SELECT shop2 FROM artikel WHERE id='$id' LIMIT 1");
    elseif($shop=="3")
      $shop = $this->app->DB->Select("SELECT shop3 FROM artikel WHERE id='$id' LIMIT 1");


    $artikelexport = $this->app->DB->Select("SELECT artikelexport FROM shopexport WHERE id='$shop' LIMIT 1");
    $lagerexport = $this->app->DB->Select("SELECT lagerexport FROM shopexport WHERE id='$shop' LIMIT 1");
   
    $externenummer = $this->app->DB->Select("SELECT nummer FROM artikelnummer_fremdnummern WHERE artikel = '$id' AND aktiv = 1 AND shopid = '$shop' LIMIT 1");
    
    if($externenummer)
    {
      $extartikelnummer = array($externenummer);
    }else{
      $extartikelnummer = "";
    }
    
    $pageContents = $this->app->remote->RemoteSendArticleList($shop,$artikel,$extartikelnummer);
    $check = strpos($pageContents ,"error:");

    if($pageContents=="1") $pageContents="success";

    if($pageContents!="") $pageContents = " ($pageContents)";

    // keine fehlermeldung vom shop
    if($check===0)
    {
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Es gab einen Fehler beim Aktualisieren des Artikels im Shop!$pageContents</div>");                         
    } else if ($pageContents=="")
    {
      if($artikelexport!=1 && $lagerexport!=1)
      {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Es gab einen Fehler beim Aktualisieren des Artikels im Shop! Es ist in den Shopeinstellungen eingestellt, dass die Artikelinformation- und Lagerbestands&uuml;bertragung nicht erlaubt ist!$pageContents</div>");
      } 
      else {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Es gab einen Fehler beim Aktualisieren des Artikels im Shop! Stellen Sie sicher, dass die Zugangsdaten und URL's korrekt sind!$pageContents</div>");
      }
    }
    else {
      if($artikelexport!=1 && $lagerexport==1)
        $msg = $this->app->erp->base64_url_encode("<div class=info>Es wurde nur der Lagerbestand (nicht die Artikelinfos entsprechend der Einstellungen) im Shop aktualisiert!$pageContents</div>"); 
      else if ($lagerexport!=1 && $artikelexport==1)
        $msg = $this->app->erp->base64_url_encode("<div class=info>Es wurde nur Der Artikel (nicht der Lagerbestand entsprechend der Einstellungen) im Shop aktualisiert!$pageContents</div>"); 
      else
        $msg = $this->app->erp->base64_url_encode("<div class=info>Der Artikel wurde im Shop aktualisiert!$pageContents</div>"); 
    }

    $this->app->erp->LagerSync($artikel);

    header("Location: index.php?module=artikel&action=edit&id=$id&msg=$msg#tabs-4");
    exit;
  }

  function ArtikelShopexportFiles()
  {
    $id = $this->app->Secure->GetGET("id"); 
    $shop = $this->app->Secure->GetGET("shop"); 

    if($shop=="1")
      $shop = $this->app->DB->Select("SELECT shop FROM artikel WHERE id='$id' LIMIT 1");
    elseif($shop=="2")
      $shop = $this->app->DB->Select("SELECT shop2 FROM artikel WHERE id='$id' LIMIT 1");
    elseif($shop=="3")
      $shop = $this->app->DB->Select("SELECT shop3 FROM artikel WHERE id='$id' LIMIT 1");

    if($this->app->remote->RemoteUpdateFilesArtikel($id,$shop))
      $msg = $this->app->erp->base64_url_encode("<div class=info>Der Artikel wurde im Shop aktualisiert!</div>"); 
    else 
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Es gab einen Fehler beim Aktualisieren des Artikels im Shop!</div>"); 

    header("Location: index.php?module=artikel&action=edit&id=$id&msg=$msg#tabs-5");
    exit;
  }


  function ArtikelStuecklisteEtiketten()
  {
    $id = $this->app->Secure->GetGET("id"); 
    $this->app->erp->ArtikelStuecklisteDrucken($id);
    header("Location: index.php?module=artikel&action=stueckliste&id=$id");
    exit;
  }

  function ArtikelSchliessen()                                                                       
  {
    $id = $this->app->Secure->GetGET("id");                                                              
    if($id > 0 && is_numeric($id))
      $this->app->DB->Update("UPDATE bestellung_position SET abgeschlossen='1' WHERE artikel='$id'");

    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit;
  }

  function ArtikelLagerlampe()
  {
    $aktivieren = $this->app->Secure->GetPOST("aktivieren");
    $deaktivieren = $this->app->Secure->GetPOST("deaktivieren");
    //$jetztnichtlagerndrot = $this->app->Secure->GetPOST("jetztnichtlagerndrot");
    $jetztgruen = $this->app->Secure->GetPOST("jetztgruen");
    $jetztgelb = $this->app->Secure->GetPOST("jetztgelb");
    $jetztrot = $this->app->Secure->GetPOST("jetztrot");
    $tab3gruen = $this->app->Secure->GetPOST("tab3gruen");
    $neuweg = $this->app->Secure->GetPOST("neuweg");
    $artikelmarkiert = $this->app->Secure->GetPOST("artikelmarkiert");
    $artikelmarkierthidden = $this->app->Secure->GetPOST("artikelmarkierthidden");

    if($jetztgruen!="") 
    {
      for($i=0;$i < count($artikelmarkiert); $i++)
        $this->app->DB->Update("UPDATE artikel SET lieferzeit='green',ausverkauft='0' WHERE id='".$artikelmarkiert[$i]."'  LIMIT 1");
    }

    else if($jetztgelb!="") 
    {
      for($i=0;$i < count($artikelmarkiert); $i++)
        $this->app->DB->Update("UPDATE artikel SET lieferzeit='yellow',ausverkauft='0' WHERE id='".$artikelmarkiert[$i]."'  LIMIT 1");
    }

    else if($jetztrot!="") 
    {
      for($i=0;$i < count($artikelmarkiert); $i++)
        $this->app->DB->Update("UPDATE artikel SET lieferzeit='red' WHERE id='".$artikelmarkiert[$i]."'  LIMIT 1");
    }

    else if($aktivieren!="") 
    {
      foreach($artikelmarkierthidden as $key=>$value)
      {
        if($artikelmarkiert[$key]=="1")
        {
          $this->app->DB->Update("UPDATE artikel SET autolagerlampe='1' WHERE id='".$key."'  LIMIT 1");
        }
        else {
          $this->app->DB->Update("UPDATE artikel SET autolagerlampe='0' WHERE id='".$key."'  LIMIT 1");
        }
      }
    }


    else if($neuweg!="")
    {
      for($i=0;$i < count($artikelmarkiert); $i++)
        $this->app->DB->Update("UPDATE artikel SET neu='0' WHERE id='".$artikelmarkiert[$i]."' LIMIT 1");
    } 

    else if($jetztnichtlagernd!="")
    {
      for($i=0;$i < count($artikelmarkiert); $i++)
        $this->app->DB->Update("UPDATE artikel SET lieferzeit='bestellt' WHERE id='".$artikelmarkiert[$i]."' LIMIT 1");
    } 
    else if($jetztnichtlagerndrot!="")
    {
      for($i=0;$i < count($artikelmarkiert); $i++)
        $this->app->DB->Update("UPDATE artikel SET lieferzeit='nichtlieferbar' WHERE id='".$artikelmarkiert[$i]."' LIMIT 1");
    } 

    //    $this->app->erp->MenuEintrag("index.php?module=artikel&action=create","Neuen Artikel anlegen");
    $this->app->erp->MenuEintrag("index.php?module=lager&action=list","zur&uuml;ck zur &Uuml;bersicht");

    $this->app->Tpl->Set('TAB1',"<div class=\"info\">Hier werden alle Artikel die als nicht lagernd Online-Shop markierten Artikel angezeigt.</div>");
    $this->app->Tpl->Set('TAB2',"<div class=\"info\">Hier werden alle Artikel die als lagernd im Online-Shop markiert sind jedoch nicht im Lager liegen.</div>");
    $this->app->Tpl->Set('TAB3',"<div class=\"info\">Hier werden alle Artikel die als ausverkauf im Online-Shop markierten sind jedoch im Lager liegen.</div>");

    $this->app->YUI->TableSearch('TAB1',"manuellagerlampe");                                             
    $this->app->YUI->TableSearch('TAB2',"autolagerlampe");                                                  
    //    $this->app->YUI->TableSearch('TAB2',"artikeltabellelagerndabernichtlagernd");                                                  
    //   $this->app->YUI->TableSearch('TAB3',"artikeltabellehinweisausverkauft");                                                  
    $this->app->YUI->TableSearch('TAB3',"artikeltabelleneu");                                                  

    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Lagerlampen berechnen");
    $this->app->Tpl->Set('TABTEXT',"Lagerlampen berechnen");

    $this->app->Tpl->Parse('MANUELLCHECKBOX',"checkbox.tpl");
    $this->app->Tpl->Parse('AUTOCHECKBOX',"checkbox2.tpl");
    $this->app->Tpl->Parse('PAGE',"lagerlampen.tpl");
  }


  function ArtikelProfisuche()
  {
    $id = $this->app->Secure->GetGET("id"); // abhaengig von cmd
    $cmd = $this->app->Secure->GetGET("cmd");
    $anlegen = $this->app->Secure->GetPOST("anlegen");

    $projekt = $this->app->Secure->GetPOST("projekt");
    $adresse = $this->app->Secure->GetPOST("adresse");
    $menge = $this->app->Secure->GetPOST("menge");
    $preis = $this->app->Secure->GetPOST("preis");
    $bestellnummer = $this->app->Secure->GetPOST("bestellnummer");
    $bezeichnunglieferant = $this->app->Secure->GetPOST("bezeichnunglieferant");
    $typ = $this->app->Secure->GetPOST("typ");
    $name_de = $this->app->Secure->GetPOST("name_de");
    $kurztext_de = $this->app->Secure->GetPOST("kurztext_de");
    $umsatzsteuerklasse = $this->app->Secure->GetPOST("umsatzsteuerklasse");
    $internerkommentar = $this->app->Secure->GetPOST("internerkommentar");
    $lagerartikel = $this->app->Secure->GetPOST("lagerartikel");


    if($umsatzsteuerklasse=="1")
      $umsatzsteuer="ermaessigt";
    else
      $umsatzsteuer="normal";


    $insert = $this->app->Secure->GetGET("insert");

    if($insert=="true")
    {
      // hole alles anhand der verkaufspreis id

      $id = $this->app->Secure->GetGET("sid");
      $vid = $this->app->Secure->GetGET("id");
      $cmd = $this->app->Secure->GetGET("cmd");

      if($cmd!="bestellung" && $cmd!="anfrage")
      {
        $artikel_id = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$vid' LIMIT 1");
        $menge = $this->app->DB->Select("SELECT ab_menge FROM verkaufspreise WHERE id='$vid' LIMIT 1");
        $preis = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE id='$vid' LIMIT 1");
        $projekt = $this->app->DB->Select("SELECT projekt FROM verkaufspreise WHERE id='$vid' LIMIT 1");
      } else {
        $artikel_id = $this->app->DB->Select("SELECT artikel FROM einkaufspreise WHERE id='$vid' LIMIT 1");
        $menge = $this->app->DB->Select("SELECT ab_menge FROM einkaufspreise WHERE id='$vid' LIMIT 1");
        $preis = $this->app->DB->Select("SELECT preis FROM einkaufspreise WHERE id='$vid' LIMIT 1");
        $projekt = $this->app->DB->Select("SELECT projekt FROM einkaufspreise WHERE id='$vid' LIMIT 1");
      }
      $lieferdatum = "0000-00-00";
      $waehrung = "EUR";
      $vpe = "";
      $bezeichnung = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel_id' LIMIT 1");
      $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel_id' LIMIT 1");
      $umsatzsteuerklasse = $this->app->DB->Select("SELECT umsatzsteuer FROM artikel WHERE id='$artikel_id' LIMIT 1");

      $sort = $this->app->DB->Select("SELECT MAX(sort) FROM {$cmd}_position WHERE {$cmd}='$id' LIMIT 1");
      $sort = $sort + 1;

      $mlmpunkte = $this->app->DB->Select("SELECT mlmpunkte FROM artikel WHERE id='$artikel_id' LIMIT 1");
      $mlmbonuspunkte = $this->app->DB->Select("SELECT mlmbonuspunkte FROM artikel WHERE id='$artikel_id' LIMIT 1");
      $mlmdirektpraemie = $this->app->DB->Select("SELECT mlmdirektpraemie FROM artikel WHERE id='$artikel_id' LIMIT 1");

      if($cmd=="lieferschein")
      {
        $this->app->DB->Insert("INSERT INTO lieferschein_position (id,{$cmd},artikel,bezeichnung,beschreibung,nummer,menge,sort,lieferdatum, status,projekt,vpe)
            VALUES ('','$id','$artikel_id','$bezeichnung','$kurztext_de','$nummer','$menge','$sort','$lieferdatum','angelegt','$projekt','$vpe')");
      } 
      else if($cmd=="anfrage")
      {
        $this->app->DB->Insert("INSERT INTO anfrage_position (id,{$cmd},artikel,bezeichnung,beschreibung,nummer,menge,sort,lieferdatum, status,projekt,vpe)
            VALUES ('','$id','$artikel_id','$bezeichnunglieferant','$kurztext_de','$nummer','$menge','$sort','$lieferdatum','angelegt','$projekt','$vpe')");
      } 
      else if($cmd=="bestellung")
      {
        $bestellnummer = $this->app->DB->Select("SELECT bestellnummer FROM einkaufspreise WHERE id='$vid' LIMIT 1");
        $bezeichnunglieferant = $this->app->DB->Select("SELECT bezeichnunglieferant FROM einkaufspreise WHERE id='$vid' LIMIT 1");

        $this->app->DB->Insert("INSERT INTO bestellung_position (id,{$cmd},artikel,beschreibung,menge,sort,lieferdatum, status,projekt,vpe,bestellnummer,bezeichnunglieferant,preis,waehrung,umsatzsteuer)
            VALUES ('','$id','$artikel_id','$kurztext_de','$menge','$sort','$lieferdatum','angelegt','$projekt','$vpe','$bestellnummer','$bezeichnunglieferant','$preis','$waehrung','$umsatzsteuer')");


      }
      else if ($cmd=="auftrag" || $cmd=="angebot" || $cmd=="rechnung")
      {
        $this->app->DB->Insert("INSERT INTO {$cmd}_position (id,{$cmd},artikel,bezeichnung,beschreibung,
          nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe,punkte,bonuspunkte,mlmdirektpraemie)
            VALUES ('','$id','$artikel_id','$bezeichnung','$kurztext_de','$nummer','$menge','$preis','$waehrung','$sort',
              '$lieferdatum','$umsatzsteuerklasse','angelegt','$projekt','$vpe','$mlmpunkte','$mlmbonuspunkte','$mlmdirektpraemie')");
      } 
      else {
        $this->app->DB->Insert("INSERT INTO {$cmd}_position (id,{$cmd},artikel,bezeichnung,beschreibung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe)
            VALUES ('','$id','$artikel_id','$bezeichnung','$kurztext_de','$nummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuer','angelegt','$projekt','$vpe')");
      }


      header("Location: index.php?module={$cmd}&action=positionen&id=$id");
      exit;
    }

    if($anlegen!="")
    {
      // speichern ??
      //echo "speichern";

      if($cmd=="lieferschein")
      {
        if($name_de=="" || $menge=="")
        {
          $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Artikel (Deutsch) und Menge sind Pflichtfelder!</div>");
          $error = 1;
        }
      } else {
        if($name_de=="" || $menge=="" || $preis=="")
        {
          $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Artikel (Deutsch), Preis und Menge sind Pflichtfelder!</div>");
          $error = 1;
        }
      }
      if($error!=1)
      {
        $sort = $this->app->DB->Select("SELECT MAX(sort) FROM {$cmd}_position WHERE {$cmd}='$id' LIMIT 1");
        $sort = $sort + 1;


        $tmp = trim($adresse);
        $rest = $this->app->erp->FirstTillSpace($tmp);

        if($rest > 0)
          $adresse =  $this->app->DB->Select("SELECT id FROM adresse WHERE lieferantennummer='$rest' AND geloescht=0 AND firma='".$this->app->User->GetFirma()."' LIMIT 1");
        else $adresse="";

        $artikelart = $typ;
        $lieferant = $adresse;
        $bezeichnung = $name_de;
        $waehrung = "EUR";
        $lieferdatum = "00.00.0000";
        $vpe = "";
        $preis = str_replace(",",".",$preis);

        if($projekt!="") 
          $projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' AND firma='".$this->app->User->GetFirma()."' LIMIT 1");
        else $projekt="";

        $neue_nummer = $this->app->erp->GetNextArtikelnummer($artikelart,$this->app->User->GetFirma(),$projekt);

        // anlegen als artikel
        $this->app->DB->Insert("INSERT INTO artikel (id,typ,nummer,projekt,name_de,anabregs_text,umsatzsteuer,adresse,firma,internerkommentar,lagerartikel)
            VALUES ('','$artikelart','$neue_nummer','$projekt','$bezeichnung','$kurztext_de','$umsatzsteuer','$lieferant','".$this->app->User->GetFirma()."','$internerkommentar','$lagerartikel')");

        $artikel_id = $this->app->DB->GetInsertID();
        // einkaufspreis anlegen

        $lieferdatum = $this->app->String->Convert($lieferdatum,"%1.%2.%3","%3-%2-%1");

        if($cmd=="lieferschein")
        {
          $this->app->DB->Insert("INSERT INTO lieferschein_position (id,{$cmd},artikel,bezeichnung,beschreibung,nummer,menge,sort,lieferdatum, status,projekt,vpe)
              VALUES ('','$id','$artikel_id','$bezeichnung','$kurztext_de','$neue_nummer','$menge','$sort','$lieferdatum','angelegt','$projekt','$vpe')");
        }
        else if($cmd=="anfrage")
        {
          $this->app->DB->Insert("INSERT INTO anfrage_position (id,{$cmd},artikel,bezeichnung,beschreibung,nummer,menge,sort,lieferdatum, projekt,vpe)
              VALUES ('','$id','$artikel_id','$bezeichnung','$kurztext_de','$neue_nummer','$menge','$sort','$lieferdatum','$projekt','$vpe')");

          $this->app->erp->AddEinkaufspreis($artikel_id,$menge,$lieferant,$bestellnummer,$bezeichnunglieferant,$preis,$waehrung);
        }

        else if($cmd=="bestellung")
        {
          if($bezeichnunglieferant=="") $bezeichnunglieferant=$bezeichnung;
          $this->app->DB->Insert("INSERT INTO bestellung_position (id,{$cmd},artikel,beschreibung,menge,sort,lieferdatum, status,projekt,vpe,bestellnummer,bezeichnunglieferant,preis,waehrung,umsatzsteuer)
              VALUES ('','$id','$artikel_id','$kurztext_de','$menge','$sort','$lieferdatum','angelegt','$projekt','$vpe','$bestellnummer','$bezeichnunglieferant','$preis','$waehrung','$umsatzsteuer')");

          //      $this->app->DB->Insert("INSERT INTO einkaufspreise (id,artikel,adresse,objekt,projekt,preis,ab_menge,angelegt_am,bearbeiter,bestellnummer,bezeichnunglieferant)
          //          VALUES ('','$artikel_id','$lieferant','Standard','$projekt','$preis','$menge',NOW(),'".$this->app->User->GetName()."','$bestellnummer','$bezeichnunglieferant')");

          $this->app->erp->AddEinkaufspreis($artikel_id,$menge,$lieferant,$bestellnummer,$bezeichnunglieferant,$preis,$waehrung);

        } else { // angebot auftrag rechnung gutschrift
          $this->app->DB->Insert("INSERT INTO verkaufspreise (id,artikel,adresse,objekt,projekt,preis,ab_menge,angelegt_am,bearbeiter)
              VALUES ('','$artikel_id','$lieferant','Standard','$projekt','$preis','$menge',NOW(),'".$this->app->User->GetName()."')");

          $this->app->DB->Insert("INSERT INTO {$cmd}_position (id,{$cmd},artikel,bezeichnung,beschreibung,nummer,menge,preis, waehrung, sort,lieferdatum, umsatzsteuer, status,projekt,vpe)
              VALUES ('','$id','$artikel_id','$bezeichnung','$kurztext_de','$neue_nummer','$menge','$preis','$waehrung','$sort','$lieferdatum','$umsatzsteuer','angelegt','$projekt','$vpe')");
        }

        header("Location: index.php?module={$cmd}&action=positionen&id=$id");
        exit;
      } 
    }

    $this->app->Tpl->Set('PROJEKT',$projekt);
    $this->app->Tpl->Set('ADRESSE',$adresse);
    $this->app->Tpl->Set('MENGE',$menge);
    $this->app->Tpl->Set('PREIS',$preis);
    $this->app->Tpl->Set('BESTELLNUMMER',$bestellnummer);
    $this->app->Tpl->Set('BEZEICHNUNGLIEFERANT',$bezeichnunglieferant);
    $this->app->Tpl->Set('NAME_DE',$name_de);
    $this->app->Tpl->Set('KURZTEXT_DE',$kurztext_de);
    $this->app->Tpl->Set('INTERNERKOMMENTAR',$internerkommentar);

    if($lagerartikel=="1")
      $this->app->Tpl->Set('LAGERARTIKEL',"checked");

    if($lagerartikel=="1")
      $this->app->Tpl->Set('LAGERARTIKEL',"checked");

    if($umsatzsteuerklasse=="1")
      $this->app->Tpl->Set('UMSATZSTEUERKLASSE',"checked");
      

    $this->app->YUI->AutoComplete("projekt","projektname",1);
    $this->app->YUI->AutoComplete("adresse","lieferant");




    if($cmd=="auftrag" || $cmd=="rechnung" || $cmd=="lieferschein" || $cmd=="angebot" || $cmd=="gutschrift")
    {
      $adresse = $this->app->DB->Select("SELECT adresse FROM {$cmd} WHERE id='$id' LIMIT 1");
      $kunde = $this->app->DB->Select("SELECT CONCAT(name,' ',kundennummer,'') FROM adresse WHERE id='$adresse' LIMIT 1");
    } else if ($cmd=="bestellung" || $cmd=="anfrage") {
      $adresse = $this->app->DB->Select("SELECT adresse FROM {$cmd} WHERE id='$id' LIMIT 1");
      $kunde = $this->app->DB->Select("SELECT CONCAT(name,' ',lieferantennummer,'') FROM adresse WHERE id='$adresse' LIMIT 1");
    }


    if($cmd=="lieferschein")
      $this->app->YUI->ParserVarIf('LIEFERSCHEIN',1);
    else
      $this->app->YUI->ParserVarIf('LIEFERSCHEIN',0);


    $this->app->Tpl->Set('KUNDE',$kunde);

    if($cmd=="bestellung" || $cmd=="anfrage")
      $this->app->YUI->TableSearch('ARTIKEL',"lieferantartikelpreise");
    else
      $this->app->YUI->TableSearch('ARTIKEL',"kundeartikelpreise");


    $this->app->Tpl->Set('PAGE',"<br><center><a href=\"index.php?module=$cmd&action=positionen&id=$id\"><img src=\"./themes/{$this->app->Conf->WFconf[defaulttheme]}/images/back.png\" border=\"0\"></a></center>");


    $artikelart = $this->app->erp->GetArtikelgruppe($projekt);
    $typ = $this->app->Secure->GetPOST("typ");
    $this->app->Tpl->Set(ARTIKELGRUPPE,$this->app->erp->GetSelectAsso($artikelart, $typ));


    if ($cmd=="bestellung" || $cmd=="anfrage") 
      $this->app->Tpl->Parse('PAGE',"aarlg_artikelbestellungneu.tpl");
    else
      $this->app->Tpl->Parse('PAGE',"aarlg_artikelneu.tpl");

    $this->app->BuildNavigation=false;

  }





  function ArtikelAjaxWerte()
  {
    $id = $this->app->Secure->GetGET("id");
    $name = $this->app->Secure->GetGET("name");
    $sid = $this->app->Secure->GetGET("sid");
    $smodule = $this->app->Secure->GetGET("smodule");
    $menge = $this->app->Secure->GetGET("menge");

    $cmd = $this->app->Secure->GetGET("cmd");
    $adresse = $this->app->Secure->GetGET("adresse");

    //          if($id=="") exit;

    if($smodule=="bestellung")
    { 
      if($name!=""){
        $id = $this->app->DB->Select("SELECT id FROM artikel WHERE name_de='$name' AND geloescht!=1 LIMIT 1");
        if($id<=0)
          $id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$name' AND geloescht!=1 LIMIT 1");
      } else {
        $commandline = $id;
        $tmp_id = explode(" ",$commandline);
        $tmp_id = $tmp_id[0];
        //     $id = substr($id,0,6);
        if($tmp_id!="")
        {
          $id = $tmp_id;
          $tmp_id = $commandline;
          // hole ab menge aus

          $n = strpos($tmp_id, $id." ");
          if ( false!==$n ) {
            $tmp_id = substr($tmp_id, 0, $n);
          } 
          $start_pos = strpos ($commandline, "ab Menge ");
          $commandline = substr($commandline,$start_pos + strlen("ab Menge "));
          $end_pos = strpos ($commandline, " ");
          if(trim(substr($commandline,0,$end_pos)) > 0)
            $menge = trim(substr($commandline,0,$end_pos));

        } else exit;
        $id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$id' AND geloescht!=1 LIMIT 1");
      }
      if(!is_numeric($id))
      {
        echo "#*##*##*##*##*##*##*#";
        exit;
      }

      $adresse = $this->app->DB->Select("SELECT adresse FROM $smodule WHERE id='$sid' LIMIT 1");
      //      $id = substr($id,0,6);

      $name = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");

      $sprache = $this->app->DB->Select("SELECT sprache FROM adresse WHERE id='$adresse' LIMIT 1");

      $name_en = $this->app->DB->Select("SELECT name_en FROM artikel WHERE id='$id' LIMIT 1");

      if($sprache=="englisch" && $name_en!="")
        $name = $name_en;

      $bestellnummer = $this->app->DB->Select("SELECT bestellnummer FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 LIMIT 1");
      $bezeichnunglieferant = $this->app->DB->Select("SELECT bezeichnunglieferant FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 LIMIT 1");
      $nummer = $this->app->DB->Select("SELECT bestellnummer FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 LIMIT 1");
      $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
      $projekt = $this->app->DB->Select("SELECT p.abkuerzung FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.id='$id' LIMIT 1");
      $projekt_id = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$id' LIMIT 1");
      $ab_menge = $this->app->DB->Select("SELECT ab_menge FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 LIMIT 1");
      $vpe = $this->app->DB->Select("SELECT vpe FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 LIMIT 1");
      $ek = $this->app->DB->Select("SELECT preis FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND ab_menge<='$menge' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 ORDER by ab_menge DESC LIMIT 1");
      $waehrung = $this->app->DB->Select("SELECT waehrung FROM einkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND ab_menge<='$menge' AND (gueltig_bis>=NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 ORDER by ab_menge DESC LIMIT 1");

      if($bezeichnunglieferant=="") $bezeichnunglieferant=$name; 

      $name = html_entity_decode($name, ENT_QUOTES, 'UTF-8');
      if($vpe > 1)
      {
        if($menge < $vpe) $menge = $vpe;        
        else {
          $menge_vpe = $menge / $vpe;
          $menge = ceil($menge_vpe)*$vpe;       
        }
        //$ek = $menge*$ek;
      }

      // bei Bestellung
      echo "$name#*#$nummer#*#$projekt#*#$ek#*#$menge#*#$bestellnummer#*#$bezeichnunglieferant#*#$vpe#*#$waehrung";
    } else {
      //Pinguio fehler
      if($id=="")
      {
        $name = $this->app->Secure->GetGET("name");
        if(trim($name)!="")
        {
          $id = $this->app->DB->Select("SELECT nummer FROM artikel WHERE nummer LIKE '$name' LIMIT 1");
          if($id =="")
          {
            $id = $this->app->DB->Select("SELECT nummer FROM artikel WHERE name_de LIKE '$name' LIMIT 1");

            if($id=="")
            {
              $name = str_replace(' ','&nbsp;',$name);
              $id = $this->app->DB->Select("SELECT nummer FROM artikel WHERE name_de LIKE '$name' LIMIT 1");
              //naechster fall
            }   
          }
        } else {
          if(trim($name)!="")
          {
            // wenn name leer ist hole max position id
            $id = $this->app->DB->Select("SELECT MAX(id) FROM ".$smodule."_position WHERE $smodule='$sid'");
            $id = $this->app->DB->Select("SELECT artikel FROM ".$smodule."_position WHERE id='$id' LIMIT 1");
            $id = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
          }

        }
        if($id =="")
          exit;

      }
      //      $id = substr($id,0,6);
      //echo $id;
      //      if(!is_numeric($id))
      //        exit;
      $tmp_id = explode(" ",$id);
      $id = $tmp_id[0];

      $id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$id' LIMIT 1");

      $adresse = $this->app->DB->Select("SELECT adresse FROM $smodule WHERE id='$sid' LIMIT 1");
      $sprache = $this->app->DB->Select("SELECT sprache FROM adresse WHERE id='$adresse' LIMIT 1");

      $name = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");

      $name_en = $this->app->DB->Select("SELECT name_en FROM artikel WHERE id='$id' LIMIT 1");

      if($sprache=="englisch" && $name_en!="")
        $name = $name_en;

      $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
      $projekt = $this->app->DB->Select("SELECT p.abkuerzung FROM artikel a LEFT JOIN projekt p ON p.id=a.projekt WHERE a.id='$id' LIMIT 1");

      $projekt_id = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$id' LIMIT 1");

      //      $ab_menge = $this->app->DB->Select("SELECT ab_menge FROM verkaufspreise WHERE artikel='$id' AND ab_menge=1  AND geloescht=0 LIMIT 1");
      $ab_menge = $menge;

      if($smodule=="inventur")
        $preis = $this->app->erp->GetEinkaufspreis($id,$menge,$adresse);
      else {
        $preis = $this->app->erp->GetVerkaufspreis($id,$menge,$adresse);
			}
      /*
      // gibt es spezial preis?
      $vk = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE artikel='$id' AND adresse='$adresse' AND ab_menge<=$menge AND (gueltig_bis>NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 ORDER by ab_menge DESC LIMIT 1");

      if($vk <= 0)
      {
      $vk = $this->app->DB->Select("SELECT preis FROM verkaufspreise WHERE artikel='$id' AND ab_menge<=$menge AND (adresse='0' OR adresse='') AND (gueltig_bis>NOW() OR gueltig_bis='0000-00-00') AND geloescht=0 ORDER by ab_menge DESC LIMIT 1");
      }
       */

      //                        if($ab_menge<=0) $ab_menge=1;

      $name = html_entity_decode($name, ENT_QUOTES, 'UTF-8');
      echo "$name#*#$nummer#*#$projekt#*#$preis#*#$ab_menge";
    }
    exit;
  }

  function ArtikelWareneingang()
  {
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Wareneingang)");
    $this->ArtikelMenu();
    $this->app->Tpl->Set('PAGE',"wareneingang");
  }

  function ArtikelReservierung()
  {
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Reservierungen)");
    $this->ArtikelMenu();
    $this->app->Tpl->Set('PAGE',"reservierung");
  }


  function ArtikelOffeneAuftraege()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Add('TABTEXT',"Auftr&auml;ge");
    $this->ArtikelMenu();

    // easy table mit arbeitspaketen YUI als template 

    $this->app->YUI->TableSearch('TAB1',"artikel_auftraege_offen");
    /*
       $table = new EasyTable($this->app);
       $table->Query("SELECT CONCAT('<a href=\"index.php?module=auftrag&action=edit&id=',a.id,'\">',a.belegnr,'</a>') as belegnr, DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, a.status, a.zahlungsweise, adr.kundenfreigabe as freigabe, CONCAT(a.name,'<br>', a.email) as Kunde, 
       a.zahlungsweise, ap.menge, ap.geliefert_menge as gelieferte, FORMAT(ap.preis*(100-ap.rabatt)/100,2) as preis  
       FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag, adresse adr WHERE adr.id=a.adresse 
       AND ap.artikel='$id' AND ap.geliefert_menge < ap.menge AND a.status='freigegeben'");
    //$table->DisplayNew('INHALT',"<a href=\"index.php?module=bestellung&action=edit&id=%value%\">Bestellung</a>");
    $table->DisplayNew('TAB1',"Preis","noAction");
     */
    $summe = $this->app->DB->Select("SELECT SUM(ap.menge)-SUM(ap.geliefert_menge) FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag WHERE ap.artikel='$id' AND ap.geliefert_menge < ap.menge AND a.status='freigegeben'");
    $euro= $this->app->DB->Select("SELECT SUM(ap.preis*(100-ap.rabatt)/100*ap.menge) FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag WHERE ap.artikel='$id' AND ap.geliefert_menge < ap.menge AND a.status='freigegeben'");

    $this->app->Tpl->Add('TAB1',"<table width=\"100%\"><tr><td align=\"right\">Summe offen: $summe St&uuml;ck (Summe EUR: $euro EUR)</td></tr></table>");

    $this->app->YUI->TableSearch('TAB2',"artikel_auftraege_versendet");
    /*
       $table = new EasyTable($this->app);
       $table->Query("SELECT a.belegnr, DATE_FORMAT(a.datum,'%d.%m.%Y') as datum2, a.status, a.zahlungsweise, CONCAT(a.name,'<br>', a.email) as Kunde, a.zahlungsweise, DATE_FORMAT(l.datum,'%d.%m.%Y') as lieferung, ap.menge, ap.geliefert_menge as gelieferte, FORMAT(ap.preis*(100-ap.rabatt)/100,2) as preis  FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag, adresse adr, lieferschein l WHERE l.auftragid=a.id AND adr.id=a.adresse AND ap.artikel='$id' AND a.status='abgeschlossen' ORDER by l.datum DESC LIMIT 10");
       $table->DisplayNew(TAB2,"Preis","noAction");
     */

    $this->app->Tpl->Parse('PAGE',"artikel_auftraege.tpl");

  }

  function ArtikelDateien()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->ArtikelMenu();
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Dateien)");
    $this->app->YUI->DateiUpload(PAGE,"Artikel",$id);
  }

  function ArtikelVerkauf()
  {
    // rechne gueltig_bis gestern aus
    // erstelle array objekt, adressse, ab_menge,preis
    // wenn es doppelte gibt rote meldung!!!
    //$this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Achtung es gibt f&uuml;r eine Kundengruppe bei einer gleichen Menge den Preis &ouml;fters! Deaktvieren oder l&ouml;schen Sie doppelte Preise!</div>");



    $this->app->Tpl->Add('UEBERSCHRIFT'," (Verkauf)");
    $this->app->Tpl->Set('SUBSUBHEADING',"Verkaufspreise");
    $this->ArtikelMenu();
    $this->Preisrechner();
    $id = $this->app->Secure->GetGET("id");
    // neues arbeitspaket
    $widget = new WidgetVerkaufspreise($this->app,TAB2);
    $widget->form->SpecialActionAfterExecute("none",
        "index.php?module=artikel&action=verkauf&id=$id");

    if($this->app->Secure->GetPOST("submit")!="")
      $this->app->erp->EnableTab("tabs-2");

    $widget->Create();


    $this->app->YUI->TableSearch('TAB1',"verkaufspreise");


    $max_preis = $this->app->DB->Select("SELECT MAX(preis) FROM einkaufspreise WHERE artikel='$id' AND gueltig_bis='0000-00-00' 
        OR gueltig_bis >= NOW() LIMIT 1");

    $min_preis = $this->app->DB->Select("SELECT MIN(preis) FROM einkaufspreise WHERE artikel='$id' AND gueltig_bis='0000-00-00' 
        OR gueltig_bis >= NOW() LIMIT 1");

    $min_preis = $this->app->erp->EUR($min_preis*(($this->app->erp->GetStandardMarge()/100.0)+1.0)*1.0);
    $max_preis = $this->app->erp->EUR($max_preis*(($this->app->erp->GetStandardMarge()/100.0)+1.0)*1.0);


    $porto = $this->app->DB->Select("SELECT porto FROM artikel WHERE id='$id' LIMIT 1");
    if($porto=="1")
    {
      $this->app->Tpl->Add('TAB1',"<div class=\"warning\">Kundenspezifische Preise werden immer priorisiert!</div>");
    } else {

      if($this->app->erp->GetStandardMarge() > 0)
      {
        $this->app->Tpl->Add('TAB1',"<div class=\"warning\">Empfohlener Verkaufspreis netto (f&uuml;r teuersten VK Preis): <b>$max_preis EUR</b>!</div>");
        $this->app->Tpl->Add('TAB1',"<div class=\"warning\">Empfohlener Verkaufspreis netto (f&uuml;r billigsten VK Preis): <b>$min_preis EUR</b>!</div>");

        $this->app->Tpl->Add('TAB2',"<div class=\"warning\">Empfohlener Verkaufspreis netto (f&uuml;r teuersten VK Preis): <b>$max_preis EUR</b>!</div>");
        $this->app->Tpl->Add('TAB2',"<div class=\"warning\">Empfohlener Verkaufspreis netto (f&uuml;r billigsten VK Preis): <b>$min_preis EUR</b>!</div>");
      }
    }


    $this->app->Tpl->Parse('PAGE',"verkaufspreiseuebersicht.tpl");
  }


  function ArtikelVerkaufDisable()
  {

    $id = $this->app->Secure->GetGET("id");

    $this->app->DB->Update("UPDATE verkaufspreise SET gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY) WHERE id='$id' LIMIT 1");
    $sid = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=artikel&action=verkauf&id=".$sid);
    exit;
  }


  function ArtikelVerkaufDelete()
  {

    $id = $this->app->Secure->GetGET("id");

    $this->app->DB->Update("UPDATE verkaufspreise SET geloescht='1', gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY) WHERE id='$id' LIMIT 1");
    $sid = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=artikel&action=verkauf&id=".$sid);
    exit;
  }


  function ArtikelVerkaufCopy()
  {
    $id = $this->app->Secure->GetGET("id");

    $id = $this->app->DB->MysqlCopyRow("verkaufspreise","id",$id);
    $this->app->DB->Update("UPDATE verkaufspreise SET geloescht='0', gueltig_bis='0000-00-00' WHERE id='$id' LIMIT 1");

    $sid = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=artikel&action=verkauf&id=".$sid);
    exit;
  }



  function ArtikelVerkaufEditPopup()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set('OPENDISABLE',"<!--");
    $this->app->Tpl->Set('CLOSEDISABLE',"-->");


    $this->Preisrechner();
    $sid = $this->app->DB->Select("SELECT artikel FROM verkaufspreise WHERE id='$id' LIMIT 1");
    $this->ArtikelMenu($sid);
    $artikel = $this->app->DB->Select("SELECT CONCAT(name_de,' (',nummer,')') FROM artikel WHERE id='$sid' LIMIT 1");
    $this->app->Tpl->Set('UEBERSCHRIFT',"Artikel: ".$artikel);
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Verkauf)");

    $this->app->Tpl->Set('ABBRECHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=artikel&action=verkauf&id=$sid';\">");

    $widget = new WidgetVerkaufspreise($this->app,'TAB1');
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=artikel&action=verkauf&id=$sid&&22#tabs-1");
    $widget->Edit();

    $this->app->Tpl->Add('TAB2',"Sie bearbeiten gerade einen Verkaufspreis. Erst nach dem Speichern k&ouml;nnen neue Preise angelegt werden.");
    $this->app->Tpl->Add('TAB3',"Sie bearbeiten gerade einen Verkaufspreis. Erst nach dem Speichern k&ouml;nnen Statistiken betrachtet werden.");
    $this->app->Tpl->Parse('PAGE',"verkaufspreiseuebersicht.tpl");
  }

  function ArtikelEinkauf()
  {
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Einkauf)");
    //    $this->app->Tpl->Set('SUBSUBHEADING',"Einkaufspreise");

    $this->Preisrechner();
    $this->ArtikelMenu();
    $id = $this->app->Secure->GetGET("id");

    $standardlieferant = $this->app->DB->Select("SELECT CONCAT(adr.lieferantennummer,' ',adr.name) FROM artikel a LEFT
        JOIN adresse adr ON adr.id=a.adresse WHERE a.id='$id'");

    $herstellernummer = $this->app->DB->Select("SELECT herstellernummer FROM artikel WHERE id='$id' LIMIT 1");
    $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");


    $this->app->Tpl->Set('BUTTONLADEN',"<input type=\"button\" value=\"Standard laden\" 
        onclick=\"document.getElementById('adresse').value='$standardlieferant';
        document.getElementById('standard').checked=true;
        document.getElementById('bezeichnunglieferant').value='$name_de';
        document.getElementById('ab_menge').value='1';
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = dd+'.'+mm+'.'+yyyy;
        document.getElementById('preis_anfrage_vom').value=today;
        document.getElementById('bestellnummer').value='$herstellernummer';
        \">");


    $stueckliste = $this->app->DB->Select("SELECT stueckliste FROM artikel WHERE id='$id' LIMIT 1");
    // neues arbeitspaket
    $widget = new WidgetEinkaufspreise($this->app,'TAB2');
    $widget->form->SpecialActionAfterExecute("none",
        "index.php?module=artikel&action=einkauf&id=$id");

    if($this->app->Secure->GetPOST("submit")!="")
      $this->app->erp->EnableTab("tabs-2");             

    $widget->Create();

    if($this->app->Secure->GetPOST("objekt")!="")
      $this->app->Tpl->Set('AKTIV_TAB2',"selected");
    else
      $this->app->Tpl->Set('AKTIV_TAB1',"selected");

    
    if ($stueckliste=="1") { 

      $table = new EasyTable($this->app);


//a.hersteller,
//l.name as standardlieferant,

//(SELECT l2.name FROM einkaufspreise e LEFT JOIN adresse l2 ON l2.id=e.adresse WHERE e.artikel=a.id AND e.bestellnummer!='' ORDER by e.preis ASC LIMIT 1) as '2. Lieferant',
//(SELECT e.bestellnummer FROM einkaufspreise e WHERE e.artikel=a.id AND e.bestellnummer!='' ORDER by e.preis ASC LIMIT 1) as '2. Bestellnummer',

      $table->Query("SELECT a.name_de as Artikel, a.nummer, s.menge, 
(SELECT l2.name FROM einkaufspreise e LEFT JOIN adresse l2 ON l2.id=e.adresse WHERE e.artikel=a.id AND e.bestellnummer!='' ORDER by e.preis DESC LIMIT 1) as lieferant,
(SELECT e.bestellnummer FROM einkaufspreise e WHERE e.artikel=a.id AND e.bestellnummer!='' ORDER by e.preis DESC LIMIT 1) as bestellnummer,

          REPLACE(
            if(a.stueckliste,
              (SELECT MIN(v.preis) FROM verkaufspreise v WHERE v.artikel=s.artikel AND (v.objekt='Standard' OR v.objekt='')),
              (SELECT MIN(e.preis) FROM einkaufspreise e WHERE e.artikel=s.artikel AND (e.objekt='Standard' OR e.objekt='') )),'.',',') as 'Preis pro Stk. (Min)', 

          REPLACE(
            if(a.stueckliste,(SELECT MIN(v.preis) FROM verkaufspreise v WHERE v.artikel=s.artikel AND (v.objekt='Standard' OR v.objekt='')),
              (SELECT MAX(e.preis) FROM einkaufspreise e WHERE e.artikel=s.artikel AND (e.objekt='Standard' OR e.objekt=''))),'.',',') as 'Preis Max'

          FROM stueckliste s
          LEFT JOIN artikel a ON a.id=s.artikel 
          LEFT JOIN adresse l ON l.id=a.adresse
          WHERE s.stuecklistevonartikel='$id' ORDER by s.sort");

      $table->DisplayNew('INHALT',"Preis pro Stk. (Max)","noAction"); 

      $sql = "SELECT SUM( 
        (SELECT MAX(e.preis) FROM einkaufspreise e WHERE e.artikel=s.artikel AND (e.objekt='Standard' OR e.objekt=''))*s.menge)
        FROM stueckliste s
        LEFT JOIN artikel a ON a.id=s.artikel 
        WHERE s.stuecklistevonartikel='$id'";

      $preis_max = $this->app->DB->Select($sql);

      $sql = "SELECT SUM( 
        (SELECT MIN(e.preis) FROM einkaufspreise e WHERE e.artikel=s.artikel AND (e.objekt='Standard' OR e.objekt=''))*s.menge)
        FROM stueckliste s
        LEFT JOIN artikel a ON a.id=s.artikel 
        WHERE s.stuecklistevonartikel='$id'";

      $preis = $this->app->DB->Select($sql);


        $sql = "SELECT COUNT(s.id)
          FROM stueckliste s
          LEFT JOIN artikel a ON a.id=s.artikel 
          WHERE s.stuecklistevonartikel='$id'";
        $pos = $this->app->DB->Select($sql);


        $sql = "SELECT SUM(s.menge)
          FROM stueckliste s
          LEFT JOIN artikel a ON a.id=s.artikel 
          WHERE s.stuecklistevonartikel='$id'";
        $teile = $this->app->DB->Select($sql);

      $this->app->Tpl->Add('INHALT',"<div class=\"info\">St&uuml;cklisten Grundpreis bei Menge 1: <b>$preis EUR - $preis_max EUR (Anzahl Positionen $pos / Teile $teile)</b></div>");
      $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

      $sql = "SELECT s.artikel, s.menge FROM stueckliste s LEFT JOIN artikel a ON a.id=s.artikel WHERE s.stuecklistevonartikel='$id'";
			$array_artikel = $this->app->DB->SelectArr($sql);

			$array_mindestmengen = array();
		
			for($i_stk=0;$i_stk < count($array_artikel);$i_stk++)
			{
				$artikel = $array_artikel[$i_stk]['artikel'];
				$menge = $array_artikel[$i_stk]['menge'];
				
				// gehe einkaufspreis fuer einkaufspreis durch
				$einkaufspreise = $this->app->DB->SelectArr("SELECT ab_menge FROM einkaufspreise WHERE artikel='$artikel' AND 
					(gueltig_bis='0000-00-00' OR gueltig_bis <= NOW()) AND geloescht!=1 AND ab_menge >='$menge' ORDER by ab_menge");		

				// liste mit artikel wo e keinen 1er Preis gibt
				$check_ek_eins = $this->app->DB->Select("SELECT id FROM einkaufspreise WHERE artikel='$artikel' AND           
						(gueltig_bis='0000-00-00' OR gueltig_bis <= NOW()) AND geloescht!=1 AND ab_menge =1 LIMIT 1");

				if($check_ek_eins <=0)
				{
					$arikel_ohne_ek_eins[]=$artikel;
				}

				for($i_ek = 0;$i_ek < count($einkaufspreise); $i_ek++)
				{
					if(!in_array($einkaufspreise[$i_ek]['ab_menge'],$array_mindestmengen))
					{
						$array_mindestmengen[] = $einkaufspreise[$i_ek]['ab_menge'];
					}
				}
			}
			sort($array_mindestmengen);
      for($j_am=0;$j_am<count($array_mindestmengen);$j_am++)
			{
  			$sql = "SELECT SUM( 
        	(SELECT e.preis FROM einkaufspreise e WHERE e.artikel=s.artikel AND (e.objekt='Standard' OR e.objekt='') 
							AND e.ab_menge <= ".$array_mindestmengen[$j_am]." ORDER by ab_menge DESC LIMIT 1)*s.menge)
        	FROM stueckliste s
        	LEFT JOIN artikel a ON a.id=s.artikel 
        	WHERE s.stuecklistevonartikel='$id'";

				$preis = $this->app->DB->Select($sql);

  			$sql = "SELECT s.artikel
          FROM stueckliste s
          LEFT JOIN artikel a ON a.id=s.artikel 
          WHERE s.stuecklistevonartikel='$id' AND (SELECT e.preis FROM einkaufspreise e WHERE e.artikel=s.artikel AND (e.objekt='Standard' OR e.objekt='') 
              AND e.ab_menge <= ".$array_mindestmengen[$j_am]." ORDER by ab_menge DESC LIMIT 1) IS NULL GROUP by s.artikel ORDER by s.artikel";

				$fehlende_preise = $this->app->DB->SelectArr($sql);
	
				$tpl .= "<td class=\"gentable\">".$array_mindestmengen[$j_am]."</td>";		
				$tpl2 .= "<td class=\"gentable\">".number_format($preis,2,",","")."</td>";		
				$tpl3 .= "<td class=\"gentable\">".count($fehlende_preise)."</td>";		

				$fehlende_artikel_links="";
				$summe_fehlende_preise_max = 0;
  			$summe_fehlende_preise_min = 0;

				for($jj=0;$jj<count($fehlende_preise);$jj++)
				{
					$nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='".$fehlende_preise[$jj]['artikel']."' LIMIT 1");
					$preis_min = $this->app->DB->Select("SELECT MIN(preis) FROM einkaufspreise WHERE artikel='".$fehlende_preise[$jj]['artikel']."' AND geloescht!=1 
						AND gueltig_bis='0000-00-00' AND gueltig_bis <= NOW() LIMIT 1");

					$preis_max = $this->app->DB->Select("SELECT MAX(preis) FROM einkaufspreise WHERE artikel='".$fehlende_preise[$jj]['artikel']."' AND geloescht!=1 
						AND gueltig_bis='0000-00-00' AND gueltig_bis <= NOW() LIMIT 1");

					$fehlende_artikel_links .="<a style=\"font-weight:normal;font-size:6pt;\" href=\"index.php?module=artikel&action=einkauf&id=".$fehlende_preise[$jj]['artikel']."\" 
						target=\"_blink\">$nummer/$preis_min/$preis_max</a><br>";

					$summe_fehlende_preise_max = $summe_fehlende_preise_max + $preis_max;
					$summe_fehlende_preise_min = $summe_fehlende_preise_min + $preis_min;
				}

				$teile_tpl .="<td nowrap>$fehlende_artikel_links</td>";
				$tpl21 .="<td>".number_format($summe_fehlende_preise_min+$preis,2,",","")."</td>";
				$tpl22 .="<td>".number_format($summe_fehlende_preise_max+$preis,2,",","")."</td>";
				$tpl4 .="<td>".number_format($summe_fehlende_preise_min,2,",","")."</td>";
				$tpl5 .="<td>".number_format($summe_fehlende_preise_max,2,",","")."</td>";
			}

			$this->app->Tpl->Add('TABELLE',"<tr style=\"background-color:#e0e0e0;display:;\"><td>Anzahl</td>".$tpl."</tr>");
			$this->app->Tpl->Add('TABELLE',"<tr><td>Gesamtpreis</td>".$tpl2."</tr>");
			$this->app->Tpl->Add('TABELLE',"<tr style=\"background-color:#e0e0e0;display:;\"><td nowrap>Anzahl fehlende Preise&nbsp;</td>".$tpl3."</tr>");
			$this->app->Tpl->Add('TABELLE',"<tr style=\"background-color:#e0e0e0;display:;\"><td nowrap>Summe fehlende Preise Min&nbsp;</td>".$tpl4."</tr>");
			$this->app->Tpl->Add('TABELLE',"<tr style=\"background-color:#e0e0e0;display:;\"><td nowrap>Summe fehlende Preise Max&nbsp;</td>".$tpl5."</tr>");
			$this->app->Tpl->Add('TABELLE',"<tr><td><b>Gesamtpreis Min</b></td>".$tpl21."</tr>");
			$this->app->Tpl->Add('TABELLE',"<tr><td><b>Gesamtpreis Max</b></td>".$tpl22."</tr>");
			$this->app->Tpl->Add('TABELLE',"<tr valign=\"top\"><td>Fehlende Preise f&uuml;r Preisstaffel bei Artikel</td>".$teile_tpl."</tr>");
			
		  $this->app->Tpl->Set(TAB5,"<fieldset><legend>Fehlende Einzelpreise f&uuml;r Kalkulation</legend>
				<table><tr><td width=\"100\"><b>Artikel-Nr.</b></td><td width=\"300\"><b>Name</b></td><td><b>Aktion</b></td></tr>");
			sort($arikel_ohne_ek_eins);
			for($j_am=0;$j_am<count($arikel_ohne_ek_eins);$j_am++)
			{
				if($j_am % 2) $color="#e0e0e0"; else $color="#fff";
				$artikel_arr = $this->app->DB->SelectArr("SELECT id,name_de, nummer FROM artikel WHERE id='".$arikel_ohne_ek_eins[$j_am]."' LIMIT 1");
				$this->app->Tpl->Add('TAB5',"<tr style=\"background-color:$color;\"><td>".$artikel_arr[0]['nummer']."</td><td>".$artikel_arr[0]['name_de']."</td><td><a href=\"index.php?module=artikel&action=einkauf&id=".$artikel_arr[0]['id']."\" target=\"_blank\"><img src=\"./themes/new/images/edit.png\"></a></td></tr>");
			}

			$this->app->Tpl->Add('TAB5',"</table></fieldset>");
			if(!$this->app->erp->ModulVorhanden("produktion"))
			{
      	//$this->app->Tpl->Parse(TAB5,"rahmen70.tpl");
				$this->app->Tpl->Set('TABELLE',"<div class=\"info\">Die Preismatrix (Kosten Stueckzahl ab&auml;ngig von Einkaufspreisen ist nur mit dem Modul Produktion verf&uuml;gbar");
			} 
			
      $this->app->Tpl->Parse('PAGE',"einkaufspreiseuebersicht_stueckliste.tpl");
    }

    else 
    {
      // easy table mit arbeitspaketen YUI als template 
      $this->app->YUI->TableSearch('TAB1',"einkaufspreise");

      if($this->app->Conf->WFdbType=="postgre") {
        if(is_numeric($id)) {           
          $adresse = $this->app->DB->Select("SELECT adresse FROM artikel WHERE id='$id' LIMIT 1"); 
          $hauptlieferant = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' LIMIT 1");

          if($this->app->Conf->WFdbType=="postgre") {
            if(is_numeric($id))
              $min_preis = $this->app->DB->Select("SELECT ROUND(MIN(preis),2) FROM verkaufspreise WHERE artikel='$id' AND objekt='Standard' AND adresse='' LIMIT 1");
          } else {
            $min_preis = $this->app->DB->Select("SELECT FORMAT(MIN(preis),2) FROM verkaufspreise WHERE artikel='$id' AND objekt='Standard' AND adresse='' LIMIT 1");
          }
        }} else {
          $adresse = $this->app->DB->Select("SELECT adresse FROM artikel WHERE id='$id' LIMIT 1");
          $hauptlieferant = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' LIMIT 1");
          $min_preis = $this->app->DB->Select("SELECT FORMAT(MIN(preis),2) FROM verkaufspreise WHERE artikel='$id' AND gueltig_bis='0000-00-00' 
              OR gueltig_bis >= NOW() LIMIT 1");
          $max_preis = $this->app->DB->Select("SELECT FORMAT(MAX(preis),2) FROM verkaufspreise WHERE artikel='$id' AND gueltig_bis='0000-00-00' 
              OR gueltig_bis >= NOW() LIMIT 1");

        }
      $this->app->Tpl->Add('TAB1',"<div class=\"info\">Der Hauptlieferant ist <b>$hauptlieferant</b></div>");

      $min_preis = $this->app->erp->EUR($min_preis/(($this->app->erp->GetStandardMarge()/100.0)+1.0)*1.0);
      $max_preis = $this->app->erp->EUR($max_preis/(($this->app->erp->GetStandardMarge()/100.0)+1.0)*1.0);

      /*      $this->app->Tpl->Add('TAB1',"<div class=\"warning\">Empfohlener Einkaufspreis (f&uuml;r geringsten VK Preis): <b>$min_preis EUR</b>!</div>");
              $this->app->Tpl->Add('TAB2',"<div class=\"warning\">Empfohlener Einkaufspreis (f&uuml;r geringsten VK Preis): <b>$min_preis EUR</b>!</div>");
              $this->app->Tpl->Add('TAB1',"<div class=\"warning\">Empfohlener Einkaufspreis (f&uuml;r max VK Preis): <b>$max_preis EUR</b>!</div>");
              $this->app->Tpl->Add('TAB2',"<div class=\"warning\">Empfohlener Einkaufspreis (f&uuml;r max VK Preis): <b>$max_preis EUR</b>!</div>");
       */
      $this->app->erp->CheckArtikel($id);
      $this->app->Tpl->Parse(PAGE,"einkaufspreiseuebersicht.tpl");
    }


  }


  function ArtikelEinkaufEditPopup()
  {
    //$frame = $this->app->Secure->GetGET("frame");
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set('OPENDISABLE',"<!--");
    $this->app->Tpl->Set('CLOSEDISABLE',"-->");
    $this->Preisrechner();


    $sid = $this->app->DB->Select("SELECT artikel FROM einkaufspreise WHERE id='$id' LIMIT 1");
    $this->ArtikelMenu($sid);
    $artikel = $this->app->DB->Select("SELECT CONCAT(name_de,' (',nummer,')') FROM artikel WHERE id='$sid' LIMIT 1");
    $this->app->Tpl->Set('UEBERSCHRIFT',"Artikel: ".$artikel);
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Einkauf)");

    $this->app->Tpl->Set('ABBRECHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=artikel&action=einkauf&id=$sid';\">");

    $widget = new WidgetEinkaufspreise($this->app,'TAB1');
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=artikel&action=einkauf&id=$sid#tabs-1");
    $widget->Edit();



    $this->app->Tpl->Add('TAB2',"Sie bearbeiten gerade einen Einkaufspreis. Erst nach dem Speichern k&ouml;nnen neue Preise angelegt werden.");
    $this->app->Tpl->Add('TAB3',"Sie bearbeiten gerade einen Einkaufspreis. Erst nach dem Speichern k&ouml;nnen Statistiken betrachtet werden.");
    /*
       $widget = new WidgetEinkaufspreise(&$this->app,TAB2);
       $widget->form->SpecialActionAfterExecute("none",
       "index.php?module=artikel&action=einkauf&id=$id");
       $widget->Create();
     */
    $this->app->Tpl->Parse('PAGE',"einkaufspreiseuebersicht.tpl");
  }

  function ArtikelEinkaufDisable()
  {
    //   $this->ArtikelMenu();
    $id = $this->app->Secure->GetGET("id");


    $this->app->DB->Update("UPDATE einkaufspreise SET gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY) WHERE id='$id' LIMIT 1");
    $sid = $this->app->DB->Select("SELECT artikel FROM einkaufspreise WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=artikel&action=einkauf&id=".$sid);
    exit;


  }

  function ArtikelEinkaufDelete()
  {
    //    $this->ArtikelMenu();
    $id = $this->app->Secure->GetGET("id");


    $this->app->DB->Update("UPDATE einkaufspreise SET geloescht='1',gueltig_bis=DATE_SUB(NOW(),INTERVAL 1 DAY) WHERE id='$id' LIMIT 1");
    $sid = $this->app->DB->Select("SELECT artikel FROM einkaufspreise WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=artikel&action=einkauf&id=".$sid);
    exit;


  }



  function ArtikelEigenschaftenCopy()
  {
    $id = $this->app->Secure->GetGET("id");

    $id = $this->app->DB->MysqlCopyRow("eigenschaften","id",$id);

    //$this->app->DB->Update("UPDATE einkaufspreise SET geloescht='1' WHERE id='$id' LIMIT 1");
    //$sid = $this->app->DB->Select("SELECT artikel FROM eigenschaften WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=artikel&action=eigenschafteneditpopup&id=".$id);
    exit;


  }


  function ArtikelEinkaufCopy()
  {
    $id = $this->app->Secure->GetGET("id");

    $id = $this->app->DB->MysqlCopyRow("einkaufspreise","id",$id);
    $this->app->DB->Update("UPDATE einkaufspreise SET geloescht='0', gueltig_bis='0000-00-00' WHERE id='$id' LIMIT 1");


    //$this->app->DB->Update("UPDATE einkaufspreise SET geloescht='1' WHERE id='$id' LIMIT 1");
    $sid = $this->app->DB->Select("SELECT artikel FROM einkaufspreise WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=artikel&action=einkauf&id=".$sid);
    exit;


  }


  function ArtikelCopy()
  {
    $id = $this->app->Secure->GetGET("id");

    $this->app->DB->MysqlCopyRow("artikel","id",$id);

    $idnew = $this->app->DB->GetInsertID();
    $this->app->DB->Update("UPDATE artikel SET nummer='' WHERE id='$idnew' LIMIT 1");

    // wenn stueckliste
    $stueckliste = $this->app->DB->Select("SELECT stueckliste FROM artikel WHERE id='$id' LIMIT 1");
    if($stueckliste==1)
    {

      $artikelarr = $this->app->DB->SelectArr("SELECT * FROM stueckliste WHERE stuecklistevonartikel='$id'");
      for($i=0;$i<count($artikelarr);$i++)
      {
        $sort = $artikelarr[$i]['sort'];        
        $artikel = $artikelarr[$i]['artikel'];  
        $referenz = $artikelarr[$i]['referenz'];        
        $place = $artikelarr[$i]['place'];      
        $layer = $artikelarr[$i]['layer'];        
        $stuecklistevonartikel = $idnew;        
        $menge = $artikelarr[$i]['menge'];
        $firma = $artikelarr[$i]['firma'];

        $this->app->DB->Insert("INSERT INTO stueckliste (id,sort,artikel,referenz,place,layer,stuecklistevonartikel,menge,firma) VALUES
            ('','$sort','$artikel','$referenz','$place','$layer','$stuecklistevonartikel','$menge','$firma')"); 
      }
    }


    //TODO hinweis es wuren keine Preise kopiert


    // artikelbilder kopieren



    // eventuell einkaufspreise verkaufspreise und stueckliste kopieren?
    $msg = $this->app->erp->base64_url_encode("<div class=error>Sie befinden sich in der neuen Kopie des Artikel. Bitte legen Sie Verkaufs- und Einkaufspreise und Bilder bzw. Dateien an! Dies wurden nicht kopiert!</div>"); 
    header("Location: index.php?module=artikel&action=edit&msg=$msg&id=".$idnew);
    exit;

  }





  function ArtikelProjekte()
  {
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Projekte)");
    $this->ArtikelMenu();
    $this->app->Tpl->Set('PAGE',"hier sieht man in welchen projekten es verwendet wird");
  }

  function ArtikelLager()
  {
    $id = $this->app->Secure->GetGET("id");
    $msg = $this->app->Secure->GetGET("msg");

    if(!is_numeric($id))
    {
      $tmp = explode('_',$id);
      $id = $tmp[0];
      if(is_numeric($id))
      {
        header("Location: index.php?module=artikel&action=lager&id=$id");
        exit;
      }
    }

    $this->app->erp->LagerArtikelZusammenfassen($id);

    $msg = $this->app->erp->base64_url_decode($msg);
    $this->app->Tpl->Set('MESSAGE',$msg);

    $this->ArtikelMenu();
    $this->app->Tpl->Add('TAB1',"<h2>Lagerbestand</h2>");

    // easy table mit arbeitspaketen YUI als template 
    $table = new EasyTable($this->app);

    $mindesthaltbarkeitsdatum = $this->app->DB->Select("SELECT mindesthaltbarkeitsdatum FROM artikel WHERE id='$id' LIMIT 1");
    $seriennummern = $this->app->DB->Select("SELECT seriennummern FROM artikel WHERE id='$id' LIMIT 1");
    $chargenverwaltung= $this->app->DB->Select("SELECT chargenverwaltung FROM artikel WHERE id='$id' LIMIT 1");


    if($seriennummern!="vomprodukteinlagern" && $chargenverwaltung <2 && $mindesthaltbarkeitsdatum!="1")
    {
      $table->Query("SELECT CONCAT(l.bezeichnung,' / ',lp.kurzbezeichnung, if(lp.sperrlager,' (Kein Auto-Versand Lager)',''),
        if(lp.poslager,' (POS Lager)',''),if(lp.verbrauchslager,' (Verbrauchslager)',''),if(lp.autolagersperre,' (Nachschublager)','')) as lager , lpi.menge as menge, lpi.vpe as VPE,p.abkuerzung as projekt, 
          lpi.id FROM lager_platz_inhalt lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id  
          LEFT JOIN lager l ON l.id=lp.lager WHERE lpi.artikel='$id' ");

      if($this->app->erp->RechteVorhanden("artikel","auslagern") || $this->app->erp->RechteVorhanden("artikel","einlagern") 
          || $this->app->erp->RechteVorhanden("artikel","umlagern"))
        {
        $table->DisplayNew('INHALT',"<a onclick=\"var menge =  prompt('St&uuml;ckzahl der Artikel die aus diesem Regal genommen werden sollen:',1); var grund =  prompt('Auslagerungsgrund:','Muster'); if(menge > 0 && (grund!=null && grund!='')) { window.location.href='index.php?module=artikel&action=auslagern&id=$id&lid=%value%&menge='+menge+'&grund='+grund;}\" href=\"#\"><img src=\"./themes/[THEME]/images/loeschen.png\" border=\"0\"></a>
            <a onclick=\"var menge =  prompt('St&uuml;ckzahl der Artikel in dieses Regal legen:',1); var grund =  prompt('Einlagerungsgrund:','Anpassung im Artikel'); if(menge > 0 && (grund!=null && grund!='')) { window.location.href='index.php?module=artikel&action=einlagern&id=$id&lid=%value%&menge='+menge+'&grund='+grund;}\" href=\"#\"><img src=\"./themes/[THEME]/images/einlagern.png\" border=\"0\"></a>
            <a onclick=\"var menge =  prompt('St&uuml;ckzahl der Artikel in dieses Regal umlagern:',%field1%); var grund =  prompt('Grund:','Anpassung im Artikel'); if(menge > 0 && (grund!=null && grund!='')) { window.location.href='index.php?module=artikel&action=umlagern&id=$id&lid=%value%&menge='+menge+'&grund='+grund;}\" href=\"#\"><img src=\"./themes/[THEME]/images/forward.png\" border=\"0\"></a>
            ");
      }
      else {
        $table->DisplayNew('INHALT',"");
      }
    } else {
      $table->Query("SELECT CONCAT(l.bezeichnung,' / ',lp.kurzbezeichnung, if(lp.sperrlager,' (Kein Auto-Versand Lager)',''),
        if(lp.poslager,' (POS Lager)',''),if(lp.verbrauchslager,' (Verbrauchslager)',''),if(lp.autolagersperre,' (Nachschublager)','')) as lager , lpi.menge as menge, lpi.vpe as VPE,p.abkuerzung as projekt, 
          lpi.id FROM lager_platz_inhalt lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id  
          LEFT JOIN lager l ON l.id=lp.lager WHERE lpi.artikel='$id' 
       ");

      if($this->app->erp->RechteVorhanden("artikel","auslagern") || $this->app->erp->RechteVorhanden("artikel","einlagern") 
          || $this->app->erp->RechteVorhanden("artikel","umlagern"))
        $table->DisplayNew('INHALT',"Projekt","noAction");
      else
        $table->DisplayNew('INHALT',"");


    }


    $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

    $this->app->Tpl->Set('INHALT',"");

    $mindesthaltbarkeitsdatum = $this->app->DB->Select("SELECT mindesthaltbarkeitsdatum FROM artikel WHERE id='$id' LIMIT 1");  
    $chargenverwaltung = $this->app->DB->Select("SELECT chargenverwaltung FROM artikel WHERE id='$id' LIMIT 1");        
    $seriennummern = $this->app->DB->Select("SELECT seriennummern FROM artikel WHERE id='$id' LIMIT 1");        

    if($seriennummern=="vomproduktlagereinlager" || $mindesthaltbarkeitsdatum=="1" || $chargenverwaltung=="2")
    {
      $this->app->Tpl->Add('TAB1',"<center>
          <input type=\"button\" value=\"Einlagern\" onclick=\"window.location.href='index.php?module=lager&action=bucheneinlagern&artikelid=$id&back=artikel'\">
          <input type=\"button\" value=\"Auslagern\" onclick=\"window.location.href='index.php?module=lager&action=buchenauslagern&artikelid=$id&back=artikel'\">
          <input type=\"button\" value=\"Umlagern\" onclick=\"window.location.href='index.php?module=lager&action=buchenauslagern&cmd=umlagern&artikelid=$id&back=artikel'\">
          </center>");
    } else {
      $this->app->Tpl->Add('TAB1',"<center><input type=\"button\" value=\"Artikel in neuen Lagerplatz einlagern\" onclick=\"window.location.href='index.php?module=lager&action=bucheneinlagern&artikelid=$id&back=artikel'\"></center>");
    }
    //    $this->app->Tpl->Set('SUBSUBHEADING',"Reservierungen Stand ".date('d.m.Y'));
    $this->app->Tpl->Add('TAB1',$this->app->erp->ArtikelLagerInfo($id));

    if($this->app->erp->Version()!="stock")     
    {
      $this->app->Tpl->Add('TAB1',"<h2>Reservierungen</h2>");

      // easy table mit arbeitspaketen YUI als template 
      $table = new EasyTable($this->app);
      $table->Query("SELECT adr.name as kunde, r.menge, if(r.datum='0000-00-00','Kein Datum hinterlegt',r.datum) as bis,
          p.abkuerzung as projekt,r.grund, r.id FROM lager_reserviert r LEFT JOIN artikel a ON a.id=r.artikel LEFT JOIN projekt p ON 
          p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id WHERE  r.artikel='$id'");

      $summe = $this->app->DB->Select("SELECT SUM(menge) FROM lager_platz_inhalt WHERE artikel='$id'");
      $reserviert = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE artikel='$id'");// AND datum >= NOW()");
      //    if($this->app->User->GetType()=="admin")
      if($this->app->erp->RechteVorhanden("artikel","ausreservieren"))
        $table->DisplayNew('INHALT',"<a onclick=\"var menge =  prompt('Anzahl Artikel aus Reservierung entfernen:',1); if(menge > 0) window.location.href='index.php?module=artikel&action=ausreservieren&id=$id&lid=%value%&menge='+menge;\" href=\"#\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a>");
      else
        $table->DisplayNew('INHALT', "");
      $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

      $this->app->Tpl->Set('INHALT',"");

      $this->app->Tpl->Add('TAB1',"<h2>Offene Auftr&auml;ge</h2>");
      // easy table mit arbeitspaketen YUI als template 
      $table = new EasyTable($this->app);
      $table->Query("SELECT 

          CONCAT('<a href=\"index.php?module=auftrag&action=edit&id=',a.id,'\">',a.belegnr,'</a>') as belegnr, DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, 
        DATE_FORMAT(a.tatsaechlicheslieferdatum,'%d.%m.%Y') as 'Auslieferung Lager',
          SUM(ap.menge) as menge,
          CONCAT((SELECT SUM(li.menge) FROM lager_reserviert li WHERE li.objekt='auftrag' AND li.parameter=a.id AND li.artikel='$id'),'&nbsp;
            <!--<a onclick=\"var menge =  prompt(\'Anzahl Artikel aus Reservierung entfernen:\',1); if(menge > 0) window.location.href=\'index.php?module=artikel&action=ausreservieren&id=$id&lid=',
            (SELECT li.id FROM lager_reserviert li WHERE li.objekt='auftrag' AND li.parameter=a.id AND li.artikel='$id' LIMIT 1)
            ,'&menge=\'+menge;\" href=\"#\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a>-->
            ') as reserviert,
          a.zahlungsweise, adr.kundenfreigabe as freigabe, CONCAT(a.name, 
      if(a.ansprechpartnerid > 0,CONCAT(', ',(SELECT ap.name FROM ansprechpartner ap WHERE ap.id=a.ansprechpartnerid)),''),'<br>', a.email) as Kunde, a.zahlungsweise, 
          ap.geliefert_menge as gelieferte, 
          FORMAT(ap.preis,2) as preis  FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag, adresse adr WHERE adr.id=a.adresse AND ap.artikel='$id' AND ap.geliefert_menge < ap.menge AND a.status='freigegeben' GROUP by a.belegnr
ORDER by a.tatsaechlicheslieferdatum, a.id
          ");
      //$table->DisplayNew('INHALT',"<a href=\"index.php?module=bestellung&action=edit&id=%value%\">Bestellung</a>");
      $table->DisplayNew('INHALT',"Preis","noAction");

      $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");

      $this->app->Tpl->Set('INHALT',"");

      $this->app->Tpl->Set('INHALT',"");
      $this->app->Tpl->Add('TAB1',"<h2>Offene Bestellungen</h2>");

      $table = new EasyTable($this->app);
      $table->Query("SELECT DATE_FORMAT(b.datum,'%d.%m.%Y') as datum, CONCAT('<a href=\"index.php?module=bestellung&action=edit&id=',b.id,'\" target=\"_blank\">',b.belegnr,'</a>') as 'bestellung Nr.', bp.bestellnummer as Nummer, bp.menge, bp.geliefert, bp.vpe as VPE, a.lieferantennummer as lieferant, a.name as name, if(bp.lieferdatum!='0000-00-00', DATE_FORMAT(bp.lieferdatum,'%d.%m.%Y'),'sofort') as lieferdatum, b.status as status_Bestellung, bp.bestellung
          FROM bestellung_position bp LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN adresse a ON b.adresse=a.id
          WHERE artikel='$id' AND b.status!='storniert' AND b.status!='abgeschlossen' AND bp.geliefert<bp.menge ORDER by bp.lieferdatum DESC");
      $table->DisplayNew('INHALT',"<a href=\"index.php?module=bestellung&action=pdf&id=%value%\"><img src=\"./themes/new/images/pdf.png\" border=\"0\"></a>&nbsp;      <a href=\"index.php?module=bestellung&action=edit&id=%value%\" target=\"_blank\"><img src=\"./themes/new/images/edit.png\" border=\"0\"></a>");
      $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");


    }   
    $this->app->Tpl->Set('INHALT',"");
    $this->app->Tpl->Add('TAB1',"<h2>Lagerplatz Bewegungen</h2>");
    // easy table mit arbeitspaketen YUI als template 
    /*
       $table = new EasyTable($this->app);
       if($this->app->Conf->WFdbType=="postgre") {
       if(is_numeric($id))
       $table->Query("SELECT to_char(lpi.zeit,'DD.MM.YYYY') as datum, lp.kurzbezeichnung as lager, lpi.menge as menge, lpi.vpe as VPE, 
       CASE WHEN lpi.eingang='1' THEN 'Eingang' ELSE 'Ausgang'
       END as Richtung, substring(lpi.referenz,1,60) as referenz, lpi.bearbeiter as bearbeiter, p.abkuerzung as projekt, lpi.id FROM lager_bewegung lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id WHERE lpi.artikel='1' order by lpi.zeit DESC");
       } else {
       $table->Query("SELECT DATE_FORMAT(lpi.zeit,'%d.%m.%Y') as datum, lp.kurzbezeichnung as lager, lpi.menge as menge, lpi.vpe as VPE, if(lpi.eingang,'Eingang','Ausgang') as Richtung, substring(lpi.referenz,1,60) as referenz, lpi.bearbeiter as bearbeiter, p.abkuerzung as projekt, 
       lpi.id FROM lager_bewegung lpi LEFT JOIN lager_platz as lp ON lpi.lager_platz=lp.id LEFT JOIN projekt p ON lpi.projekt=p.id  WHERE lpi.artikel='$id' order by lpi.zeit DESC");
       }
    //$table->DisplayNew('INHALT',"<a href=\"index.php?module=bestellung&action=edit&id=%value%\">Bestellung</a>");
    $table->DisplayNew('INHALT',"");
    $this->app->Tpl->Parse('TAB1',"rahmen70.tpl");
     */
    $this->app->YUI->TableSearch('TAB1',"lagerbewegungartikel");


    $this->app->Tpl->Set('INHALT',"");

    //$this->app->Tpl->Set('TABTEXT',"Lagerbestand");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");

  }


  function ArtikelChargeDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    $sid = $this->app->Secure->GetGET("sid");

    $data = $this->app->DB->SelectArr("SELECT * FROM lager_charge WHERE id='$sid' LIMIT 1");
    $lager_platz = $data[0]['lager_platz'];
    $artikel = $data[0]['artikel'];
    $menge = $data[0]['menge'];

    //$lager_platz_inhalt_id = $this->app->DB->Select("UPDATE lager_platz_inhalt SET menge=menge-$menge WHERE lager_platz='$lager_platz' AND artikel='$artikel'
    //                  AND menge >= '$menge' LIMIT 1");

    $this->app->erp->LagerAuslagernRegal($artikel,$lager_platz,$menge,$projekt,"Auslagern bzw Lageranpassung");

    $this->app->DB->Delete("DELETE FROM lager_charge WHERE id='$sid' LIMIT 1");
    header("Location: index.php?module=artikel&action=chargen&id=$id");
    exit;
  }     


  function ArtikelMHDDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    $sid = $this->app->Secure->GetGET("sid");
    $tmp = rand();


    $data = $this->app->DB->SelectArr("SELECT * FROM lager_mindesthaltbarkeitsdatum WHERE id='$sid' LIMIT 1");
    $lager_platz = $data[0]['lager_platz'];
    $artikel = $data[0]['artikel'];
    $menge = $data[0]['menge'];

    /*
       $lager_platz_inhalt_menge = $this->app->DB->Select("SELECT menge FROM lager_platz_inhalt WHERE lager_platz='$lager_platz' 
       AND artikel='$artikel' AND menge >= '$menge' LIMIT 1");

       $this->app->erp->DumpVar("test $tmp menge $menge artikel $artikel lager_platz $lager_platz alte menge $lager_platz_inhalt_menge");
     */

    //          $lager_platz_inhalt_id = $this->app->DB->Update("UPDATE lager_platz_inhalt SET menge=menge-$menge WHERE lager_platz='$lager_platz' AND artikel='$artikel'
    //                          AND menge >= '$menge' LIMIT 1");

    $this->app->erp->LagerAuslagernRegal($artikel,$lager_platz,$menge,$projekt,"Auslagern bzw Lageranpassung");

    $this->app->DB->Delete("DELETE FROM lager_mindesthaltbarkeitsdatum WHERE id='$sid' LIMIT 1");

    header("Location: index.php?module=artikel&action=mindesthaltbarkeitsdatum&id=$id");
    exit;
  }     

  function ArtikelChargen()
  {
    $this->ArtikelMenu();
    $this->app->Tpl->Set('TABTEXT',"Chargen im Lager");

    $this->app->YUI->AutoComplete("lagerplatz","lagerplatz");

    $id = $this->app->Secure->GetGET("id");

    if($this->app->Secure->GetPOST("anlegen")!="")
    {
      $menge = $this->app->Secure->GetPOST("menge");
      $charge = $this->app->Secure->GetPOST("charge");
      $lagerplatz = $this->app->Secure->GetPOST("lagerplatz");
      $lagerplatz = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$lagerplatz' LIMIT 1");

      if(is_numeric($menge) && is_numeric($lagerplatz) && $charge!="")
      {
        $this->app->erp->AddChargeLager($id,$menge,$lagerplatz,date('Y-m-d'),$charge);
      } else {
        $this->app->Tpl->Add('TAB1',"<div class=error>Fehler: Bitte Menge, Charge und Lager angeben!</div>");     
      }
    }

    $menge = $this->app->erp->ArtikelImLager($id);
    $charge = $this->app->DB->Select("SELECT SUM(menge) FROM lager_charge WHERE artikel='$id'");
    if($menge > $charge)
      $this->app->Tpl->Add('TAB1',"<div class=error>Achtung: Es sind ".($menge-$charge)." Eintr&auml;ge zu wenig vorhanden!</div>");      
    else if ($menge < $charge)
      $this->app->Tpl->Add('TAB1',"<div class=error>Achtung: Es sind ".($charge-$menge)." Eintr&auml;ge zu viel vorhanden!</div>");       

    $this->app->Tpl->Add('TAB1',"<br><center><form method=\"post\" action=\"\">Menge:&nbsp;<input name=\"menge\" type=\"text\" size=\"5\" value=\"1\">&nbsp;Lager:&nbsp;<input type=\"text\" size=\"20\" id=\"lagerplatz\" name=\"lagerplatz\">&nbsp;Charge:&nbsp;<input type=text size=\"15\" id=\"charge\" name=\"charge\">&nbsp;<input type=\"submit\" value=\"anlegen\" name=\"anlegen\"></form></center>");


    $this->app->YUI->TableSearch('TAB1',"chargen");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }


  function ArtikelMHD()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->ArtikelMenu();
    $this->app->Tpl->Set('TABTEXT',"Mindesthaltbarkeitsdatum");

    $this->app->YUI->DatePicker("datum");
    $this->app->YUI->AutoComplete("lagerplatz","lagerplatz");

    if($this->app->Secure->GetPOST("anlegen")!="")
    {
      $menge = $this->app->Secure->GetPOST("menge");
      $datum = $this->app->Secure->GetPOST("datum");
      $charge = $this->app->Secure->GetPOST("charge");
      $lagerplatz = $this->app->Secure->GetPOST("lagerplatz");
      $datum = $this->app->String->Convert($datum,"%1.%2.%3","%3-%2-%1");
      $lagerplatz = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$lagerplatz' LIMIT 1");

      if(is_numeric($menge) && is_numeric($lagerplatz) && $datum!="--")
      {
        $this->app->erp->AddMindesthaltbarkeitsdatumLager($id,$menge,$lagerplatz,$datum,$charge);
      } else {
        $this->app->Tpl->Add('TAB1',"<div class=error>Fehler: Bitte Menge, MHD und Lager angeben!</div>");        
      }
    }

    $menge = $this->app->erp->ArtikelImLager($id);
    $mhd = $this->app->DB->Select("SELECT SUM(menge) FROM lager_mindesthaltbarkeitsdatum WHERE artikel='$id'");
    if($menge > $mhd)
      $this->app->Tpl->Add('TAB1',"<div class=error>Achtung: Es sind ".($menge-$mhd)." Eintr&auml;ge zu wenig vorhanden!</div>"); 
    else if ($menge < $mhd)
      $this->app->Tpl->Add('TAB1',"<div class=error>Achtung: Es sind ".($mhd-$menge)." Eintr&auml;ge zu viel vorhanden!</div>");  

    $this->app->Tpl->Add('TAB1',"<br><center><form method=\"post\" action=\"\">Menge:&nbsp;<input name=\"menge\" type=\"text\" size=\"5\" value=\"1\">&nbsp;MHD:&nbsp;<input type=text size=\"15\" id=\"datum\" name=\"datum\">&nbsp;Lager:&nbsp;<input type=\"text\" size=\"20\" id=\"lagerplatz\" name=\"lagerplatz\">&nbsp;Charge (optional):&nbsp;<input type=text size=\"15\" id=\"charge\" name=\"charge\">&nbsp;<input type=\"submit\" value=\"anlegen\" name=\"anlegen\"></form></center>");


    $this->app->YUI->TableSearch('TAB1',"mindesthaltbarkeitsdatum");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }


  function ArtikelStueckliste()
  {
    $this->app->Tpl->Add('UEBERSCHRIFT'," (St&uuml;ckliste)");
    $this->ArtikelMenu();
    $id = $this->app->Secure->GetGET("id");

    if($this->app->Secure->GetPOST("artikel")!="")
      $this->app->Tpl->Set('AKTIV_TAB2',"selected");
    else
      $this->app->Tpl->Set('AKTIV_TAB1',"selected");

    // neues arbeitspaket
    $widget = new WidgetStueckliste($this->app,'TAB2');
    $widget->form->SpecialActionAfterExecute("none",
        "index.php?module=artikel&action=stueckliste&id=$id");
    $this->app->Tpl->Set('TMPSCRIPT',"<script type=\"text/javascript\">$(document).ready(function(){ $('#tabs').tabs('select', 1); });</script>");
    $widget->form->SpecialActionAfterExecute("none",
        "index.php?module=artikel&action=stueckliste&id=$id#tabs-1");



    $widget->Create();


    $this->app->YUI->TableSearch('TAB1',"stueckliste");

    $stueck = $this->app->erp->ArtikelAnzahlLagerStueckliste($id);

    $this->ArtikelStuecklisteImport('TAB3');

    $this->app->Tpl->Add('TAB1',"<center><button onclick=\"if(!confirm('Wirklich St&uuml;ckliste leeren?')) return false; else window.location.href='index.php?module=artikel&action=stuecklisteempty&id=$id';\">St&uuml;ckliste leeren</button></center><br><br>");

    $this->app->Tpl->Add('TAB1',"<div class=\"info\">Aktuell k&ouml;nnen $stueck St&uuml;ck produziert werden (<a href=\"index.php?module=artikel&action=stuecklisteetiketten&id=".$id."\">Etiketten f&uuml;r St&uuml;ckliste drucken</a>)</div>");

    $this->app->Tpl->Parse('PAGE',"stuecklisteuebersicht.tpl");
  }

  function ArtikelStuecklisteEmpty()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Delete("DELETE FROM stueckliste WHERE stuecklistevonartikel='$id'");
    $this->ArtikelStueckliste();
  }


  function UpStueckliste()
  {
    $this->app->YUI->SortListEvent("up","stueckliste","stuecklistevonartikel");
    $this->ArtikelStueckliste();
  }

  function DownStueckliste()
  {
    $this->app->YUI->SortListEvent("down","stueckliste","stuecklistevonartikel");
    $this->ArtikelStueckliste();
  }


  function DelStueckliste()
  {
    $id = $this->app->Secure->GetGET("id");
    $sort = $this->app->DB->Select("SELECT sort FROM stueckliste WHERE id='$id' LIMIT 1");
    $sid = $this->app->DB->Select("SELECT stuecklistevonartikel FROM stueckliste WHERE id='$id' LIMIT 1");

    $this->app->DB->Delete("DELETE FROM stueckliste WHERE id='$id'");

    $this->app->DB->Delete("UPDATE stueckliste SET sort=sort-1 WHERE stuecklistevonartikel='$sid' AND sort > $sort LIMIT 1");

    header("Location: index.php?module=artikel&action=stueckliste&id=".$sid);
    exit;
  }


  function ArtikelInStueckliste()
  {
    $this->ArtikelMenu();
    $this->app->Tpl->Set('TABTEXT',"In St&uuml;ckliste von folgenden Artikel vorhanden");
    $this->app->YUI->TableSearch('TAB1',"instueckliste");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function ArtikelStuecklisteEditPopup()
  {
    $id = $this->app->Secure->GetGET("id");

    $sid = $this->app->DB->Select("SELECT stuecklistevonartikel FROM stueckliste WHERE id='$id' LIMIT 1");
    $this->ArtikelMenu($sid);
    $artikel = $this->app->DB->Select("SELECT CONCAT(name_de,' (',nummer,')') FROM artikel WHERE id='$sid' LIMIT 1");
    $this->app->Tpl->Set('UEBERSCHRIFT',"Artikel: ".$artikel);
    $this->app->Tpl->Add('UEBERSCHRIFT'," (St&uuml;ckliste)");

    $this->app->Tpl->Set('ABBRECHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=artikel&action=stueckliste&id=$sid';\">");

    $widget = new WidgetStueckliste($this->app,'TAB1');
    $widget->form->SpecialActionAfterExecute("close_refresh",
        "index.php?module=artikel&action=stueckliste&id=$sid#tabs-1");
    $widget->Edit();

    $this->app->Tpl->Add('TAB2',"Sie bearbeiten gerade einen Position der St&uuml;ckliste. Erst nach dem Speichern k&ouml;nnen neue Positionen angelegt werden.");
    //$this->app->Tpl->Add('TAB3',"Sie bearbeiten gerade einen Verkaufspreis. Erst nach dem Speichern k&ouml;nnen Statistiken betrachtet werden.");
    $this->app->Tpl->Parse('PAGE',"stuecklisteuebersicht.tpl");
  }



  function ArtikelStatistik()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->ArtikelMenu();

    //$this->app->Tpl->Set('TABTEXT',"Statistik");
    $this->app->Tpl->Set('TAB1',"<h2>Statistik Mengen</h2><br>");

    $summe['jahr']="";
    $summe['monat']="";
    
    $auftraege = $this->app->DB->Select("SELECT  EXTRACT(YEAR FROM a.datum) as jahr,  EXTRACT(MONTH FROM a.datum) as monat, sum(ap.menge) as menge
     FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag 
     WHERE ap.artikel='$id'  AND (a.status<>'stoniert' and a.status <> 'angelegt')  GROUP By monat,jahr ORDER by jahr DESC, monat DESC"
    );
    $mengeauftraege = 0;
    $mengeanfragen = 0;
    $mengeangebote = 0;
    $mengelieferscheine = 0;
    $mengebestellungen = 0;
    
    if($auftraege)
    {
      foreach($auftraege as $el)
      {
        $tab[$el['jahr']][$el['monat']]['auftraege'] = $el['menge'];
        $summe['auftrag'] += $el['menge'];
      }
    }
    
    
    $lieferscheine = $this->app->DB->Select(
    "SELECT  EXTRACT(YEAR FROM l.datum) as jahr,  EXTRACT(MONTH FROM l.datum) as monat, sum(lp.menge) as menge
     from lieferschein l 
     LEFT JOIN lieferschein_position lp on l.id = lp.lieferschein
     WHERE lp.artikel='$id' AND (l.status='versendet')  GROUP By monat,jahr ORDER by jahr DESC, monat DESC"
    );
    
    if($lieferscheine)
    {
      foreach($lieferscheine as $el)
      {
        $tab[$el['jahr']][$el['monat']]['lieferscheine'] = $el['menge'];
        $summe['lieferscheine'] += $el['menge'];
      }
    }
     $rechnungen = $this->app->DB->Select(
    "SELECT  EXTRACT(YEAR FROM r.datum) as jahr,  EXTRACT(MONTH FROM r.datum) as monat, sum(rp.menge) as menge
     from rechnung r 
     LEFT JOIN rechnung_position rp on r.id = rp.rechnung
     WHERE rp.artikel='$id' AND (r.status!='angelegt' AND r.status!='storniert')  GROUP By monat,jahr ORDER by jahr DESC, monat DESC"
    );
    
    if($rechnungen)
    {
      foreach($rechnungen as $el)
      {
        $tab[$el['jahr']][$el['monat']]['rechnungen'] = $el['menge'];
        $summe['rechnungen'] += $el['menge'];
      }
    }
    $angebote = $this->app->DB->Select("SELECT  EXTRACT(YEAR FROM a.datum) as jahr,  EXTRACT(MONTH FROM a.datum) as monat, sum(ap.menge) as menge
     FROM angebot_position ap LEFT JOIN angebot a ON a.id=ap.angebot 
     WHERE ap.artikel='$id'  AND (a.status<>'stoniert' and a.status <> 'angelegt')  GROUP By monat,jahr ORDER by jahr DESC, monat DESC"
    );
    
    if($angebote)
    {
      foreach($angebote as $el)
      {
        $tab[$el['jahr']][$el['monat']]['angebote'] = $el['menge'];
        $summe['angebote'] += $el['menge'];
      }
    }
    

   
    $bestellungen = $this->app->DB->Select("SELECT  EXTRACT(YEAR FROM a.datum) as jahr,  EXTRACT(MONTH FROM a.datum) as monat, sum(ap.menge) as menge
     FROM bestellung_position ap LEFT JOIN bestellung a ON a.id=ap.bestellung 
     WHERE ap.artikel='$id'  AND (a.status<>'stoniert' and a.status <> 'angelegt')  GROUP By monat,jahr ORDER by jahr DESC, monat DESC"
    );
    
    if($bestellungen)
    {
      foreach($bestellungen as $el)
      {
        $tab[$el['jahr']][$el['monat']]['bestellungen'] = $el['menge'];
        $summe['bestellungen'] += $el['menge'];
      }
    }
    

    if($tab)
    {
      $table = new EasyTable($this->app);
      $table->headings = array('Jahr','Monat','Auftr&auml;ge','Lieferscheine','Rechnungen','Angebote','Bestellungen');
      //$html = "<table><tr><th>Jahr</th><th>Monat</th><th>Menge Auftr&auml;ge</th><th>Menge Anfragen</th><th>Menge Angebote</th><th>Menge Bestellungen</th><th>Menge geliefert</th></tr>";
      krsort($tab);
      foreach($tab as $jahr => $monate)
      {
        krsort($monate);
        foreach($monate as $monat => $row)
        {
        /*$html .= "<tr>
        <td>".$jahr."</td>
        <td>".$monat."</td>
        <td>".(isset($row['auftraege'])?$row['auftraege']:'')."</td>
        <td>".(isset($row['anfragen'])?$row['anfragen']:'')."</td>
        <td>".(isset($row['angebote'])?$row['angebote']:'')."</td>
        <td>".(isset($row['bestellungen'])?$row['bestellungen']:'')."</td>
        <td>".(isset($row['lieferscheine'])?$row['lieferscheine']:'-')."</td>
        </tr>
        ";*/
          $displayrow[0] = $jahr;
          $displayrow[1] = $monat;
          $displayrow[2] = isset($row['auftraege'])?$row['auftraege']:'';
          $displayrow[6] = isset($row['lieferscheine'])?$row['lieferscheine']:'';
          $displayrow[3] = isset($row['rechnungen'])?$row['rechnungen']:'';
          $displayrow[4] = isset($row['angebote'])?$row['angebote']:'';
          $displayrow[5] = isset($row['bestellungen'])?$row['bestellungen']:'';
          $table->AddRow($displayrow);
        }
      }
      $table->AddRow($summe);
      //$html .= "</table>";
      $table->DisplayNew('TAB1',"Bestellungen","noAction");
    }
    
    // easy table mit arbeitspaketen YUI als template 
    /*
    $table->Query("SELECT  EXTRACT(YEAR FROM a.datum) as jahr,  EXTRACT(MONTH FROM a.datum) as monat,count(Distinct a.id) as 'Abgeschlossene Auftr&auml;ge', sum(if(l.versendet = 1,lp.geliefert,0)) as menge
     FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag 
     LEFT JOIN lieferschein l on a.id = l.auftragid
     LEFT JOIN lieferschein_position lp on l.id = lp.lieferschein
     WHERE ap.artikel='$id' and (lp.artikel='$id' or isnull(lp.artikel))  AND (a.status='abgeschlossen' or a.versendet = 1)  GROUP By monat,jahr ORDER by jahr DESC, monat DESC");
    //$table->DisplayNew('INHALT',"<a href=\"index.php?module=bestellung&action=edit&id=%value%\">Bestellung</a>");*/

    

/*
    $gesamtauftraege = $this->app->DB->Select("SELECT count(distinct a.id) as menge
        FROM auftrag_position ap INNER JOIN auftrag a ON a.id=ap.auftrag WHERE ap.artikel='$id' AND (a.status='abgeschlossen' or (a.versendet = 1 and a.status='freigegeben')) ");

    $gesamt = $this->app->DB->Select("SELECT sum(if(l.versendet = 1,lp.geliefert,0)) as menge
     FROM auftrag_position ap LEFT JOIN auftrag a ON a.id=ap.auftrag 
     LEFT JOIN lieferschein l on a.id = l.auftragid
     LEFT JOIN lieferschein_position lp on l.id = lp.lieferschein
     WHERE ap.artikel='$id' and (lp.artikel='$id' or isnull(lp.artikel))  AND (a.status='abgeschlossen'  or a.versendet = 1)   ");*/

    //$this->app->Tpl->Add('TAB1',(isset($html)?$html:'')."Menge Auftr&auml;ge: $mengeauftraege Anfragen: $mengeanfragen Angebote: $mengeangebote Bestellungen: $mengebestellungen geliefert: $mengelieferscheine");


    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }



  function ArtikelOffeneBestellungen()
  {
    $id = $this->app->Secure->GetGET("id");
    //$this->app->Tpl->Set('TABTEXT',"Bestellungen");
    $this->ArtikelMenu();

    // easy table mit arbeitspaketen YUI als template 
    $table = new EasyTable($this->app);
    $table->Query("SELECT DATE_FORMAT(b.datum,'%d.%m.%Y') as datum, CONCAT('<a href=\"index.php?module=bestellung&action=edit&id=',b.id,'\" target=\"_blank\">',b.belegnr,'</a>') as 'bestellung Nr.', bp.bestellnummer as Nummer, bp.menge, bp.geliefert, bp.vpe as VPE, a.lieferantennummer as lieferant, a.name as name, if(bp.lieferdatum!='0000-00-00', DATE_FORMAT(bp.lieferdatum,'%d.%m.%Y'),'sofort') as lieferdatum, b.status as status_Bestellung, bp.bestellung
        FROM bestellung_position bp LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN adresse a ON b.adresse=a.id
        WHERE artikel='$id' AND b.status!='storniert' ORDER by b.datum DESC");
    $table->DisplayNew('TAB1',"<a href=\"index.php?module=bestellung&action=pdf&id=%value%\"><img src=\"./themes/new/images/pdf.png\" border=\"0\"></a>&nbsp;
        <a href=\"index.php?module=bestellung&action=edit&id=%value%\"><img src=\"./themes/new/images/edit.png\" border=\"0\"></a>");

    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }


  function ArtikelEinlagern()
  {
    $id = $this->app->Secure->GetGET("id");
    $lid = $this->app->Secure->GetGET("lid");
    $menge = $this->app->Secure->GetGET("menge");
    $grund = $this->app->Secure->GetGET("grund");

    // menge holen in lagerregaplplatz
    $menge_lager = $this->app->DB->Select("SELECT menge FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");
    $lager_platz = $this->app->DB->Select("SELECT lager_platz FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");

    $neuemenge = $menge_lager + $menge;

    //echo "menge_lager = $menge_lager; menge raus = $menge; neuemenge = $neuemenge; lid=$lid";

    $this->app->erp->LagerEinlagern($id,$menge,$lager_platz,$projekt,"Manuell Bestand angepasst (".$grund.")");
/*
    $this->app->DB->Update("UPDATE lager_platz_inhalt SET menge='$neuemenge' WHERE id='$lid' LIMIT 1");
    $bestand = $this->app->erp->ArtikelImLagerPlatz($id,$lager_platz);
    // protokoll eintrag in bewegung
    $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz,artikel,menge,eingang,zeit,referenz,bearbeiter,firma,projekt,bestand) 
        VALUES ('','$lager_platz','$id','$menge','1',NOW(),'Manuell Bestand angepasst (".$grund.")','".$this->app->User->GetName()."',
        '".$this->app->User->GetFirma()."','$projekt','$bestand')");
*/
    //  if($menge_lager < $menge) $menge = $menge_lager;

    $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");
    $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Artikel \"$name_de\" wurde $menge mal eingelagert.</div>");

    header("Location: index.php?module=artikel&action=lager&id=$id&msg=$msg");
    exit;
  }

  function ArtikelUmlagern()
  {
    $id = $this->app->Secure->GetGET("id");
    $lid = $this->app->Secure->GetGET("lid");
    $menge = $this->app->Secure->GetGET("menge");
    $grund = $this->app->Secure->GetGET("grund");

    // menge holen in lagerregaplplatz
    $menge_lager = $this->app->DB->Select("SELECT menge FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");
    $lager_platz = $this->app->DB->Select("SELECT lager_platz FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");

    $neuemenge = $menge_lager - $menge;

    //echo "menge_lager = $menge_lager; menge raus = $menge; neuemenge = $neuemenge; lid=$lid";

    $bestand = $this->app->erp->ArtikelImLager($id);

    if($menge_lager <= $menge)
    {
      $this->app->DB->Delete("DELETE FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");
      $menge = $menge_lager;
    }
    else {
      $this->app->DB->Update("UPDATE lager_platz_inhalt SET menge='$neuemenge' WHERE id='$lid' LIMIT 1");
    }

    // protokoll eintrag in bewegung
    $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz,artikel,menge,eingang,zeit,referenz,bearbeiter,firma,projekt,bestand) 
        VALUES ('','$lager_platz','$id','$menge','0',NOW(),'Manuell Bestand angepasst (".$grund.")','".$this->app->User->GetName()."','".$this->app->User->GetFirma()."',
        '$projekt','$bestand')");

    if($menge_lager < $menge) $menge = $menge_lager;


    //   $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");
    $grund = $this->app->erp->base64_url_encode($grund);
    header("Location: index.php?module=lager&action=bucheneinlagern&artikelid=$id&menge=$menge&cmd=umlagern&back=artikel&grund=$grund");

    //    header("Location: index.php?module=artikel&action=lager&id=$id&msg=$msg");
    exit;
  }



  function ArtikelAuslagern()
  {
    $id = $this->app->Secure->GetGET("id");
    $lid = $this->app->Secure->GetGET("lid");
    $menge = $this->app->Secure->GetGET("menge");
    $grund = $this->app->Secure->GetGET("grund");

    // menge holen in lagerregaplplatz
    $menge_lager = $this->app->DB->Select("SELECT menge FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");
    $lager_platz = $this->app->DB->Select("SELECT lager_platz FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");
    $projekt = $this->app->DB->Select("SELECT projekt FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");

 //   $neuemenge = $menge_lager - $menge;

    //echo "menge_lager = $menge_lager; menge raus = $menge; neuemenge = $neuemenge; lid=$lid";

    $result = $this->app->erp->LagerAuslagernRegal($id,$lager_platz,$menge,$projekt,"Manuell Bestand angepasst (".$grund.")");
/*
    if($menge_lager <= $menge)
    {
      $this->app->DB->Delete("DELETE FROM lager_platz_inhalt WHERE id='$lid' LIMIT 1");
      $menge = $menge_lager;
    }
    else 
      $this->app->DB->Update("UPDATE lager_platz_inhalt SET menge='$neuemenge' WHERE id='$lid' LIMIT 1");
    $bestand = $this->app->erp->ArtikelImLager($id,$lager_platz);
    // protokoll eintrag in bewegung
    $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz,artikel,menge,eingang,zeit,referenz,bearbeiter,firma,projekt,bestand) 
        VALUES ('','$lager_platz','$id','$menge','0',NOW(),'Manuell Bestand angepasst (".$grund.")','".$this->app->User->GetName()."',
        '".$this->app->User->GetFirma()."','$projekt','$bestand')");
    if($menge_lager < $menge) $menge = $menge_lager;
*/

    $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");
    if($result < 0)
    {
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Artikel \"$name_de\" wurde nicht ausgelagert! Er ist nicht so oft im Lager!</div>");
    } else {
      $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Der Artikel \"$name_de\" wurde $menge mal ausgelagert.</div>");
    }

    header("Location: index.php?module=artikel&action=lager&id=$id&msg=$msg");
    exit;
  }

  function ArtikelAusreservieren()                                                                                                                                                                                   
  {                                                                                                                                                                   
    $id = $this->app->Secure->GetGET("id");                                                                                                                           
    $lid = $this->app->Secure->GetGET("lid");                                                                                                                         
    $menge = $this->app->Secure->GetGET("menge");                                                                                                                                                               
    // menge holen in lagerregaplplatz                                                                                                                                                                          
    $menge_lager = $this->app->DB->Select("SELECT menge FROM lager_reserviert WHERE id='$lid' LIMIT 1");                                                                                                      
    $neuemenge = $menge_lager - $menge;                                                                                                                           
    //echo "menge_lager = $menge_lager; menge raus = $menge; neuemenge = $neuemenge; lid=$lid";                                                                                                                     
    if($menge_lager <= $menge)                                                                                                                                                                                  
      $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE id='$lid' LIMIT 1");                                                                                                                         
    else                                                                                                                                                                                                        
      $this->app->DB->Update("UPDATE lager_reserviert SET menge='$neuemenge' WHERE id='$lid' LIMIT 1");                                                                                                       
    if($menge_lager < $menge) $menge = $menge_lager;                                                                                                                                                            

    $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");                                                                                                                    
    $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Die Reservierung \"$name_de\" wurde $menge mal entfernt.</div>");                                                                                                  
    header("Location: index.php?module=artikel&action=lager&id=$id&msg=$msg");                                                                                                                                  
    exit;                                                                                                                                                                                                       
  }

  function ArtikelDelete()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->DB->Update("UPDATE artikel SET geloescht='1', nummer='DEL' WHERE id='$id'");
    $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");

    // Lager reseten
    $this->app->DB->Delete("DELETE FROM lager_platz_inhalt WHERE artikel='$id'");
    $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE artikel='$id'");
    $this->app->DB->Delete("DELETE FROM lager_charge WHERE artikel='$id'");
    $this->app->DB->Delete("DELETE FROM lager_mindesthaltbarkeitsdatum WHERE artikel='$id'");

    //TODO vielleicht besser machen? mit Hinweis oder so
    $this->app->DB->Update("UPDATE artikel SET variante=0,variante_von=0 WHERE variante_von='$id' AND variante_von > 0");

    $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Der Artikel \"$name_de\" und der Lagerbestand wurde gel&ouml;scht</div>");

    $this->ArtikelList();
  }

  function ArtikelCreate()
  {
    $this->app->Tpl->Set('UEBERSCHRIFT',"Artikel (Neu anlegen)");
/*
    if($this->app->Secure->GetPOST("name_de")=="")
      $this->app->Tpl->Set('MESSAGE',"<div class=\"info\">M&ouml;chten Sie den <a href=\"index.php?module=wizard&action=create\">Artikel-Assistent</a> zum Anlegen verwenden?</div>");
*/
    $this->app->Tpl->Set('ABBRECHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=artikel&action=list';\">");
    //    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Artikel anlegen");
    $this->app->erp->MenuEintrag("index.php?module=artikel&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    parent::ArtikelCreate();
  }

  function ArtikelListMenu()
  {
    //$this->app->Tpl->Add(TABS,"<li><h2 class=\"allgemein\">Allgemein</h2></li>");
    $this->app->erp->MenuEintrag("index.php?module=artikel&action=list","&Uuml;bersicht");
//    $this->app->erp->MenuEintrag("index.php?module=artikel&action=eigenschaftensuche","Eigenschaften");

//    if($this->app->erp->Version()!="stock")     
//      $this->app->erp->MenuEintrag("index.php?module=wizard&action=create","Artikel-Assistent");

    $this->app->erp->MenuEintrag("index.php?module=artikel&action=create","Neuen Artikel anlegen");
    //    $this->app->erp->MenuEintrag("index.php?module=artikel&action=lagerlampe","Lagerlampen berechnen");
    //$this->app->Tpl->Add(TABS,"<li><a  href=\"index.php\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");
  }

  function ArtikelList()
  {
    $this->ArtikelListMenu();
    $this->app->YUI->AutoComplete("projekt", "projektname", 1);
    $this->app->YUI->AutoComplete("lieferantname", "lieferant", 1);
    $this->app->YUI->AutoComplete("hersteller", "hersteller", 1);

    $this->app->Tpl->Parse('TAB1',"artikel_table_filter.tpl");

    if($this->app->erp->Firmendaten("artikel_bilder_uebersicht")=="1")
    {
      $this->app->YUI->TableSearch('TAB1',"artikeltabellebilder");
    } else {
      $this->app->YUI->TableSearch('TAB1',"artikeltabelle");
    }
    $this->app->Tpl->Parse('PAGE',"artikeluebersicht.tpl");
  }

  function ArtikelgenEigenschaften(&$hw, &$produkte, $found = null, $lvl = 0)
  {
    if($produkte)
    {
      if($found === null)
      {
        foreach($produkte as $kp => $produkt)
        {
          $found[$produkt['id']] = true;
        }
      }
    }
    $keys = array_keys($hw);
    $html = '';
    $html .= "<table class=\"mkTable\">";
      
    foreach($hw[$keys[$lvl]] as $k => $v)
    {
      $html .= "<tr><td>".$k."</td><td>";
      
      if(!is_null($found))
      {
        $where = "and (0 ";
        foreach($found as $kf => $el)
        {
          if($el)$where .= " or artikel = ".$kf;
        }
        if($where !== "and (0 ")
        {
          $where .= ')';
          $artikel = $this->app->DB->SelectArr("select artikel from eigenschaften where hauptkategorie = '".$keys[$lvl]."' and wert = '".$k."' ".$where);
          //echo "<br>"."select artikel from eigenschaften where hauptkategorie = '".$keys[$lvl]."' and wert = '".$k."' ".$where;
          foreach($found as $kf => $el)
          {
            $foundnew[$kf] = false;
          }
          if($artikel)
          {
            
            foreach($artikel as $ka => $art)
            {
              $foundnew[$art['artikel']] = true;
              //echo " ".$art['artikel'];
            }
          }
        }
        
      }
      if($lvl == count($hw) -1)
      {
        if(!is_null($found))
        {
          //print_r($found);
          foreach($foundnew as $kf => $gef)
          {
            if($gef)
            {
             
              foreach($produkte as $kp => $produkt)
              {
                if($kf == $produkt['id'])
                {
                   
                  $html .= $produkt['nummer'];
                  break;
                } 
                
              }
              
            }
            
          }
        } else {
          
        }
        
      } elseif($lvl < count($hw) -1) {
        
        $html .= $this->ArtikelgenEigenschaften($hw, $produkte, $foundnew , $lvl +1);
      }
      $html .= "</td></tr>";
    }
    
    $html .= "</table>";
    return $html;
  }
  
  function ArtikelMenu($id="")
  {
    if(!is_numeric($id))
      $id = $this->app->Secure->GetGET("id");

    $action = $this->app->Secure->GetGET("action");

    if($this->app->Conf->WFdbType=="postgre") {
      if(is_numeric($id)) {
        $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1"); 
        $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1"); 
      }} else {
        $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
        $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");
      }


    //$this->app->Tpl->Set(KURZUEBERSCHRIFT,"Artikel $nummer");
    $this->app->Tpl->Set(KURZUEBERSCHRIFT2,$this->app->erp->LimitChar($name_de,100)." (Artikel $nummer)");

    if($this->app->Conf->WFdbType=="postgre") {
      if(is_numeric($id)) 
        $tmp = $this->app->DB->SelectArr("SELECT * FROM artikel WHERE id='$id' LIMIT 1");
    } else {
      $tmp = $this->app->DB->SelectArr("SELECT * FROM artikel WHERE id='$id' LIMIT 1");
    }

    $this->app->erp->MenuEintrag("index.php?module=artikel&action=edit&id=$id","Details");

    if($tmp[0][stueckliste]==1)
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=stueckliste&id=$id","St&uuml;ckliste");

    $rabatt = $this->app->DB->Select("SELECT rabatt FROM artikel WHERE id='$id' LIMIT 1");



    if($this->app->erp->Version()!="stock" && $rabatt!="1")     
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=dateien&id=$id","Dateien");
    if($rabatt!="1")    
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=einkauf&id=$id","Einkauf");

    if($this->app->erp->Version()!="stock" && $rabatt!="1")     
    {
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=verkauf&id=$id","Verkauf");
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=statistik&id=$id","Statistik");
    }



    if($tmp[0]['lagerartikel']=="1")
    {
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=lager&id=$id","Lager");
    }


    if($tmp[0]['mindesthaltbarkeitsdatum']=="1" && $tmp[0]['chargenverwaltung']<=0)
    {
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=mindesthaltbarkeitsdatum&id=$id","Mindesthalt.");
    }

    if($tmp[0]['mindesthaltbarkeitsdatum']=="1" && $tmp[0]['chargenverwaltung']>0)
    {
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=mindesthaltbarkeitsdatum&id=$id","Mindesthalt. + Charge");
    }


    if($tmp[0]['chargenverwaltung']>0 && $tmp[0]['mindesthaltbarkeitsdatum']!="1")
    {
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=chargen&id=$id","Chargen");
    }



    if($this->app->DB->Select("SELECT COUNT(id) FROM stueckliste WHERE artikel='$id' AND stuecklistevonartikel!='$id'") > 0){
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=instueckliste&id=$id","In St&uuml;ckliste");
    }


    //  if($tmp[0][provisionsartikel]=="1")
    //  $this->app->erp->MenuEintrag("index.php?module=artikel&action=provisionen&id=$id","Provisionen");

    //    if($tmp[0][lagerartikel]=="1")
    $this->app->erp->MenuEintrag("index.php?module=artikel&action=etiketten&id=$id","Etikett");

    $this->app->erp->MenuEintrag("index.php?module=artikel&action=offenebestellungen&id=$id","Bestellungen");

    if($this->app->erp->Version()!="stock")     
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=offeneauftraege&id=$id","Auftr&auml;ge");

    //  if($tmp[0][lagerartikel]=="1")
    //    $this->app->erp->MenuEintrag("index.php?module=artikel&action=reservierung&id=$id","Reservierungen");

    //   if($tmp[0][stueckliste]!="1")
    //     $this->app->erp->MenuEintrag("index.php?module=artikel&action=wareneingang&id=$id","Wareneingang");


    //   $this->app->erp->MenuEintrag("index.php?module=artikel&action=projekte&id=$id","Projekte");
        $this->app->erp->MenuEintrag("index.php?module=artikel&action=create","Neuen Artikel anlegen");


    $this->app->erp->MenuEintrag("index.php?module=artikel&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    if($id){
      $this->app->erp->MenuEintrag("index.php?module=artikel&action=fremdnummern&id=$id","Fremdnummern");
    }
  }


  function ArtikelEdit()
  {
    $id = $this->app->Secure->GetGET("id"); 


    $shop1export =$this->app->Secure->GetPOST("shop1export");
    $shop2export =$this->app->Secure->GetPOST("shop2export");
    $shop3export =$this->app->Secure->GetPOST("shop3export");

    if($this->app->erp->Version()=="stock")
    {
      $this->app->DB->Update("UPDATE artikel SET lagerartikel=1 WHERE id='$id' LIMIT 1");
    }


    $this->app->erp->CheckArtikel($id);

    if($shop1export!="")
      $this->app->User->SetParameter("artikel_shopexport_shop1",1);

    if($shop2export!="")
      $this->app->User->SetParameter("artikel_shopexport_shop2",1);

    if($shop3export!="")
      $this->app->User->SetParameter("artikel_shopexport_shop3",1);

    $shop1import =$this->app->Secure->GetPOST("shop1import");
    if($shop1import!="")
    {
      header("Location: index.php?module=artikel&action=shopimport&id=$id&shop=1");
      exit;
    }
    $shop2import =$this->app->Secure->GetPOST("shop2import");
    if($shop2import!="")
    {
      header("Location: index.php?module=artikel&action=shopimport&id=$id&shop=2");
      exit;
    }
    $shop3import =$this->app->Secure->GetPOST("shop3import");
    if($shop3import!="")
    {
      header("Location: index.php?module=artikel&action=shopimport&id=$id&shop=3");
      exit;
    }

    if($this->app->erp->Version()=="stock")     
    {
      $this->app->Tpl->Set('DISABLEOPENTEXTE',"<!--");
      $this->app->Tpl->Set('DISABLECLOSETEXTE',"-->");
      $this->app->Tpl->Set('DISABLEOPENSHOP',"<!--");
      $this->app->Tpl->Set('DISABLECLOSESHOP',"-->");
      $this->app->Tpl->Set('DISABLEOPENSTOCK',"<!--");
      $this->app->Tpl->Set('DISABLECLOSESTOCK',"-->");
    }


    if($this->app->erp->DisableModul("artikel",$id))
    {
      //$this->app->erp->MenuEintrag("index.php?module=auftrag&action=list","Zur&uuml;ck zur &Uuml;bersicht");
      $this->ArtikelMenu();
      return;
    }   // Einzelposten im gleichen LagerRegal zusammenführen
    $this->app->erp->LagerArtikelZusammenfassen($id);

    $nummer = $this->app->Secure->GetGET("nummer"); 
    if(!is_numeric($id) && $nummer!="")
    {
      $id = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='".$nummer."' LIMIT 1");
      header("Location: index.php?module=artikel&action=edit&id=$id");
    }
    /*
       $msg = $this->app->Secure->GetGET("msg"); 
       $msg = $this->app->erp->base64_url_decode($msg);

       $this->app->Tpl->Set('MESSAGE',$msg);
     */
    $mark = $this->app->Secure->GetPOST('bookmark');
    if($mark!='' && !in_array($id, $_SESSION['bookmarked'])) {
      $_SESSION['bookmarked'][] = $id; 
    }




    $juststueckliste = $this->app->DB->Select("SELECT juststueckliste FROM artikel WHERE id='$id' LIMIT 1");
    $lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='$id' LIMIT 1");
    $shop= $this->app->DB->Select("SELECT shop FROM artikel WHERE id='$id' LIMIT 1");

    if($shop > 0)
    {
      $this->app->Tpl->Set('SHOP1BUTTON','
          <input type="submit" value="Export" name="shop1export" onclick="this.form.action += \'#tabs-4\';">
          <input type="submit" value="Import" name="shop1import" onclick="this.form.action += \'#tabs-4\';">
          ');
      /*
         $this->app->Tpl->Add(SHOPEXPORBUTTON,'
         <script>
         $(function() {
         $( "#aktualisierenfiles").button();
         });
         </script>

         <a id="aktualisierenfiles" style="font-size: 8pt; " href="index.php?module=artikel&action=shopexportfiles&shop=1&id='.$id.'#tabs-5" title="Bilder zum Artikel im Shop aktualisieren">Bilder im Shop (1) aktualisieren</a>');
       */
    }
    $shop2= $this->app->DB->Select("SELECT shop2 FROM artikel WHERE id='$id' LIMIT 1");

    if($shop2 > 0)
    {
      $this->app->Tpl->Set('SHOP2BUTTON','
          <input type="submit" value="Export" name="shop2export" onclick="this.form.action += \'#tabs-4\';">
          <input type="submit" value="Import" name="shop2import" onclick="this.form.action += \'#tabs-4\';">
          ');
    }

    $shop3= $this->app->DB->Select("SELECT shop3 FROM artikel WHERE id='$id' LIMIT 1");

    if($shop3 > 0)
    {
      $this->app->Tpl->Set('SHOP3BUTTON','
          <input type="submit" value="Export" name="shop3export" onclick="this.form.action += \'#tabs-4\';">
          <input type="submit" value="Import" name="shop3import" onclick="this.form.action += \'#tabs-4\';">
          ');
    }



    $this->app->Tpl->Set('ABBRECHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=artikel&action=list';\">");


    /*
       if($this->app->Conf->WFdbType=="postgre")
       $anzahl_verkaufspreise = $this->app->DB->Select("SELECT SUM(id) FROM verkaufspreise WHERE artikel='$id' AND geloescht='0' AND (gueltig_bis IS NOT NULL OR gueltig_bis >=NOW())");
       else
       $anzahl_verkaufspreise = $this->app->DB->Select("SELECT SUM(id) FROM verkaufspreise WHERE artikel='$id' AND geloescht='0' AND (gueltig_bis='0000-00-00' OR gueltig_bis >=NOW())");
       if($anzahl_verkaufspreise<1)
       $this->app->Tpl->Add('MESSAGE',"<div class=\"success\">Achtung: Der Artikel hat noch keinen Verkaufspreis!</div>");
     */
    if($lagerartikel=="1" && $juststueckliste=="1")
    {
      $this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Dieser Artikel ist als Lagerartikel und <i>Explodiert im Auftrag</i> markiert. Bitte nur eine Option w&auml;hlen!</div>");
    }

    //          $this->app->erp->Standardprojekt("artikel",$id);

    //$this->app->erp->SeitenSperrInfo("Diese Seite wird soeben von Benedikt Sauter bearbeitet.<br><br>Bitte sprechen Sie sich vor &Auml;nderungen an dieser Seite entsprechend ab.");
/*
    $this->app->Tpl->Set(OPTIONEN,'

        <script>
        $(function() {
          $( "#mehr").button();
          });
        </script>

        <a id="mehr" style="font-size: 8pt; " href="index.php?module=artikel&action=onlineshop&id='.$id.'" class="popup" title="Warengruppen / Bildauswahl">Warengruppen/Bildauswahl</a>');
*/
    $artikel_de_anzeige = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='".$id."' LIMIT 1");
    $kurztext_de_anzeige = $this->app->DB->Select("SELECT kurztext_de FROM artikel WHERE id='".$id."' LIMIT 1");
    $artikelbeschreibung_de_anzeige = $this->app->DB->Select("SELECT anabregs_text FROM artikel WHERE id='".$id."' LIMIT 1");

    $this->app->Tpl->Set('ARTIKEL_DE_ANZEIGE','<input type="text" name="" readonly style="background-color:#eee; border-color:#ddd;" size="70" maxlength="60" value="'.$artikel_de_anzeige.'">');
    $this->app->Tpl->Set('KURZTEXT_DE_ANZEIGE','<textarea readonly rows="2" cols="70" readonly style="background-color:#eee; border-color:#ddd;">'.$kurztext_de_anzeige.'</textarea>');
    $this->app->Tpl->Set('ARTIKELBESCHREIBUNG_DE_ANZEIGE','<textarea style="background-color:#eee; border-color:#ddd;" readonly rows="5" cols="70" style="color:grey" name="">'.$artikelbeschreibung_de_anzeige.'</textarea>');


    parent::ArtikelEdit();

    /* anzeige formular */ 
    $this->ArtikelMenu();
    $artikel = $this->app->DB->Select("SELECT CONCAT(name_de,' (',nummer,')') FROM artikel WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('UEBERSCHRIFT',"Artikel: ".$artikel);

    $shop1export = $this->app->User->GetParameter("artikel_shopexport_shop1");
    $shop2export = $this->app->User->GetParameter("artikel_shopexport_shop2");
    $shop3export = $this->app->User->GetParameter("artikel_shopexport_shop3");

    if($shop1export!="")
    {
      $this->app->erp->LogFile("BENE shopexport 1");
      $this->app->User->SetParameter("artikel_shopexport_shop1","");
      header("Location: index.php?module=artikel&action=shopexport&id=$id&shop=1");
      exit;
    }

    if($shop2export!="")
    {
      $this->app->erp->LogFile("BENE shopexport 2");
      $this->app->User->SetParameter("artikel_shopexport_shop2","");
      header("Location: index.php?module=artikel&action=shopexport&id=$id&shop=2");
      exit;
    }

    if($shop3export!="")
    {
      $this->app->erp->LogFile("BENE shopexport 3");
      $this->app->User->SetParameter("artikel_shopexport_shop3","");
      header("Location: index.php?module=artikel&action=shopexport&id=$id&shop=3");
      exit;
    }	



    $this->app->erp->MessageHandlerStandardForm();
    /*

       if($this->app->Secure->GetPOST("speichern")!="")
       {
       if($this->app->Secure->GetGET("msg")=="")
       {
       $msg = $this->app->Secure->GetGET("msg");
       $msg = $msg.$this->app->Tpl->Get(MESSAGE)." ";
       $msg = $this->app->erp->base64_url_encode($msg);
       } else {
       $msg = $this->app->Secure->GetGET("msg");
       }

       header("Location: index.php?module=artikel&action=edit&id=$id&msg=$msg");
       exit;
       } 
     */

    /* sperrmeldung */
    $intern_gesperrt = $this->app->DB->Select("SELECT intern_gesperrt FROM artikel WHERE id='$id' LIMIT 1");
    if($intern_gesperrt)
    {
      if($this->app->erp->CheckSamePage())
      {
        $intern_gesperrtgrund = $this->app->DB->Select("SELECT intern_gesperrtgrund FROM artikel WHERE id='$id' LIMIT 1");
        $this->app->erp->SeitenSperrAuswahl("Wichtiger Hinweis",$intern_gesperrtgrund);
      }
    }
  }



  function ArtikelEtiketten()
  {
    $this->app->Tpl->Add('UEBERSCHRIFT'," (Etiketten)");
    $id = $this->app->Secure->GetGET("id");
    $external= $this->app->Secure->GetGET("external");
    $menge = $this->app->Secure->GetPOST("menge");
    $this->ArtikelMenu();
    $this->app->Tpl->Set('TAB1',"<form action=\"\" method=\"post\">Menge:&nbsp;<input type=\"text\" name=\"menge\" value=\"1\">&nbsp;&nbsp;&nbsp;<input type=\"submit\" value=\"Drucken\"></form><br>");

    $standardbild = $this->app->DB->Select("SELECT standardbild FROM artikel WHERE id='$id' LIMIT 1");

    $standardbild = $this->app->DB->Select("SELECT id FROM datei WHERE id='$standardbild' AND geloescht!=1 LIMIT 1");

    if($standardbild=="")
      $standardbild = $this->app->DB->Select("SELECT datei FROM datei_stichwoerter WHERE subjekt='Shopbild' AND objekt='Artikel' AND parameter='$id' LIMIT 1");

    if($standardbild > 0)
      $this->app->Tpl->Add('TAB1',"<img src=\"index.php?module=dateien&action=send&id=$standardbild\" width=\"200\">");

    if($external=="1")
    {
      $menge = $this->app->Secure->GetGET("menge");
    }    


    if($menge!="")
    {
      $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
      $projekt = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$id' LIMIT 1");
      $name_de = $this->app->erp->UmlauteEntfernen($this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1"));
      $name_de_base64 = $this->app->erp->base64_url_encode($name_de);

      if(is_numeric($menge))$druckanzahl=$menge;

      $this->app->erp->EtikettenDrucker("artikel_klein",$druckanzahl,"artikel",$id);
    }

    if($external=="1")
    { 
      header("Location: ".$_SERVER['HTTP_REFERER']); 
      exit;
    }
    

    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function ArtikelOnlineShop()
  {
    $frame = $this->app->Secure->GetGET("frame");
    $id = $this->app->Secure->GetGET("id");
    //if($frame=="false")
    //{
    // hier nur fenster größe anpassen
    //  $this->app->YUI->IframeDialog(500,400);
    //} else {
    // nach page inhalt des dialogs ausgeben
    //      $sid = $this->app->DB->Select("SELECT artikel FROM artikel_artikelgruppe WHERE id='$id' LIMIT 1");
    //$widget = new WidgetVerkaufspreise(&$this->app,PAGE);
    //$widget->form->SpecialActionAfterExecute("close_refresh",
    //  "index.php?module=artikel&action=verkauf&id=$sid");


    // neue warengruppe hinzugefuegt
    $artikelgruppe = $this->app->Secure->GetPOST("artikelgruppe");
    $ok= $this->app->Secure->GetPOST("ok");
    if($artikelgruppe!="" && $ok=="") $this->app->DB->Insert("INSERT INTO artikel_artikelgruppe (id,artikel,artikelgruppe) VALUES ('','$id','$artikelgruppe')");


    //warengruppe geloescht
    $sid= $this->app->Secure->GetGET("sid");
    $cmd= $this->app->Secure->GetGET("cmd");
    if($sid!="" && $cmd=="del") $this->app->DB->DELETE("DELETE FROM artikel_artikelgruppe WHERE id='$sid' LIMIT 1");
    if($sid!="" && $cmd=="image") $this->app->DB->DELETE("UPDATE artikel SET standardbild='$sid' WHERE id='$id' LIMIT 1");

    $name = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$id' LIMIT 1");
    $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$id' LIMIT 1");
    $this->app->Tpl->Set('SUBSUBHEADING',"Online-Shop Attribute: $name ($nummer)");
    $this->app->Tpl->Set('AKTIV_TAB1',"selected");

    //Warengruppen
    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT a.bezeichnung, aa.id FROM artikel_artikelgruppe aa LEFT JOIN artikelgruppen a ON a.id=aa.artikelgruppe WHERE artikel='$id'");
    $tmp->DisplayNew('WARENGRUPPEN',"<a href=\"#\" onclick=\"if(!confirm('Wirklich löschen?')) return false; else window.location.href='index.php?module=artikel&cmd=del&action=onlineshop&id=$id&sid=%value%';\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a>");

    $shop = $this->app->DB->Select("SELECT shop FROM artikel WHERE id='$id' LIMIT 1");

    $arr = $this->app->DB->SelectArr("SELECT bezeichnung,id FROM artikelgruppen WHERE shop='$shop'");

    foreach($arr as $key=>$value)
      $html.="<option value=\"{$value[id]}\">{$value[bezeichnung]}</option>";

    $this->app->Tpl->Add('WARENGRUPPEN',"<center><select name=\"artikelgruppe\">$html</select>");
    $this->app->Tpl->Add('WARENGRUPPEN',"<input type=submit value=\"hinzuf&uuml;gen\"></center>");

    // standard bild
    $standardbild = $this->app->DB->Select("SELECT standardbild FROM artikel WHERE id='$id'");
    $tmp = new EasyTable($this->app);
    $tmp->Query("SELECT d.titel, d.id FROM datei d LEFT JOIN datei_stichwoerter s ON d.id=s.datei  
        LEFT JOIN datei_version v ON v.datei=d.id
        WHERE s.objekt='Artikel' AND s.parameter='$id' AND s.subjekt='Shopbild' AND d.geloescht=0");

    $tmp->DisplayNew('HAUPTBILD',
        "<a href=\"#\" onclick=\"if(!confirm('Als Standard definieren?')) return false; else window.location.href='index.php?module=artikel&action=onlineshop&cmd=image&id=$id&sid=%value%';\"><img src=\"./themes/[THEME]/images/ack.png\" border=\"0\"></a>");

    $standardbild_name = $this->app->DB->Select("SELECT titel FROM datei WHERE id='$standardbild'");
    $this->app->Tpl->Add('HAUPTBILD',"<br>Standardbild: <b>$standardbild_name</b>");





    $this->app->Tpl->Parse('PAGE',"onlineshop.tpl");

    $this->app->BuildNavigation=false;
    //}
  }

  function ArtikelNewList()
  {

    $this->app->Tpl->Parse('PAGE',"datatable.tpl");

  }

  function ArtikelStuecklisteUpload()
  {

    $this->app->Tpl->Set('TAB1',"

        <table><tr><td>Datei:</td><td><input type=\"file\"></td></tr></table>");        
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }

  function ArtikelStuecklisteImport($parsetarget="")
  {
    $id = $this->app->Secure->GetGET("id");
    //$this->app->BuildNavigation=false;

    $vorlage = $this->app->Secure->GetPOST("vorlage");
    if($vorlage=="altium"){
      $result = $this->StuecklisteImport(
          array('menge'=>'Menge','nummer'=>'Artikelnummer','wert'=>'Wert','bauform'=>'Package','referenz'=>'Referenz'),
          array('menge'=>2,'nummer'=>13,'bauform'=>5,'wert'=>6,'referenz'=>3),
          ";",$parsetarget);

    } 
    else if($vorlage=="minimal"){
      $result = $this->StuecklisteImport(
          array('nummer'=>'Artikelnummer','menge'=>'Menge'),
          array('nummer'=>1,'menge'=>2),
          ";",$parsetarget);
    } 
    else {
      $result = $this->StuecklisteImport(
          array('nummer'=>'Artikelnummer','menge'=>'Menge'),
          array('nummer'=>1,'menge'=>2),
          ";",$parsetarget);
      /*
         $result = $this->StuecklisteImport(
         array('menge'=>'Menge','nummer'=>'Artikelnummer','wert'=>'Wert','bauform'=>'Package','referenz'=>'Referenz'),
         array(),
         ";",$parsetarget);
       */
    }

    if(is_array($result))
    {
      //echo "import";
      //print_r($result);
      foreach($result as $key=>$value)
      {
        //echo $value[menge];
        $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='".$value[nummer]."' AND nummer!='' LIMIT 1");
        $maxsort = $this->app->DB->Select("SELECT MAX(sort) FROM stueckliste WHERE stuecklistevonartikel='".$id."'") + 1;
        if($artikelid > 0)
          $this->app->DB->Insert("INSERT INTO stueckliste 
              (id,sort,artikel,menge,wert,bauform,referenz,stuecklistevonartikel,firma) VALUE ('','$maxsort','$artikelid','".$value[menge]."',
                '".$value[wert]."','".$value[bauform]."','".$value[referenz]."','$id','".$this->app->User->GetFirma()."')");
        else
          $fehlerhaftes_bauteil .= "Unbekannte Artikelnummer: ".$value[nummer]." (Menge ".$value[menge]." St&uuml;ck)<br>";
      }
      if($fehlerhaftes_bauteil!="")
      {
        $this->app->Tpl->Set($parsetarget,"<div class=\"error\">$fehlerhaftes_bauteil</div>");
      }

    }

  }

  function StuecklisteImport($fields, $preselected="",$startdelimititer=";",$parsetarget)
  {
    session_start();

    $stueckliste_csv = $this->app->erp->GetTMP()."stueckliste".$this->app->User->GetID();

    $quote = htmlentities($this->app->Secure->GetPOST("quote"));
    $delimiter = htmlentities($this->app->Secure->GetPOST("delimiter"));
    $cancel = $this->app->Secure->GetPOST("cancel");
    if($cancel!="")
    {
      unlink($stueckliste_csv);
      $_SESSION["importfilename"]="";
    }

    $import = $this->app->Secure->GetPOST("import");
    if($import!="")
    {
      $row_post = $this->app->Secure->GetPOST("row");
      $cols = $this->app->Secure->GetPOST("cols");

      $importerror=0;
      if($row_post=="")
      {
        $findcols .= "<div class=\"error\">Zeile wählen</div>";
        $importerror++;
      } 

      for($i=0;$i<count($cols);$i++)
      {
        if($cols[$i]!="") $colcounter++;
      }
      if($colcounter<count($fields))
      {
        $findcols .= "<div class=\"error\">Alle Spalten müssen auswählt werden</div>";
        $importerror++;
      }

      if($importerror==0)
      {
        $findcols .= "<div class=\"info\">Erfolgreich importiert</div>";
        if (($handle = fopen($stueckliste_csv, "r")) !== FALSE) {
          $rowcounter = 1;
          while (($data = fgetcsv($handle, 1000, $_SESSION["delimiter"])) !== FALSE) {
            $rowcounter++;
            $num = count($data);

            if($rowcounter > $row_post){        
              for ($c=0; $c < $num; $c++) {
                // wenn schluessel vorhanden feld uebernehmen
                if($cols[$c]!="")
                  $singlerow[$cols[$c]]=$data[$c];
              }
              $result[] = $singlerow;
              $singlerow="";
            }   
          }
        }
        fclose($handle);
        unlink($stueckliste_csv);
        $_SESSION["importfilename"]="";
        //      $this->app->Tpl->Set('PAGE',$findcols);
      }
    }


    $_SESSION["quote"]=$quote;
    $_SESSION["delimiter"]=$delimiter;


    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $stueckliste_csv)) {
      $_SESSION["importfilename"] = $_FILES['userfile']['name'];
    }

    $row = 1;
    if (($handle = fopen($stueckliste_csv, "r")) !== FALSE) {
      $findcols .= "
        <table width=\"1070\"><tr><td>
        <h2>Datei: ".$_SESSION["importfilename"]."</h2> (Die Anzeige ist limitiert auf max 10 Zeilen)</td><td>

        <form action=\"#tabs-3\" method=\"post\" enctype=\"multipart/form-data\">
        <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"30000\" />
        <input name=\"userfile\" type=\"file\" />

        </td><td align=\"right\">
        Trennzeichen: &nbsp;<input type=\"text\" size=\"3\" value=\"".html_entity_decode($_SESSION["delimiter"])."\" name=\"delimiter\">&nbsp;
      <!--Daten: &nbsp;<input type=\"text\" size=\"3\" value=\"".html_entity_decode($_SESSION["quote"])."\" name=\"quote\">&nbsp;-->
        <input type=\"submit\" value=\"aktualisieren\">
        </td></tr></table>
        ";


      $findcols .= "
        <div style=\"background: #eeeeee;
height: 350px;
overflow: scroll;
          font-size:7pt;
width: 1050px;
border: 1px solid #000;
padding: 10px;\">
           <table border=0 cellpadding=0 cellspacing=0>";       
           while (($data = fgetcsv($handle, 1000, $_SESSION["delimiter"])) !== FALSE) {
             $num = count($data);

             if($row==1)
             {
               $findcols .= "<tr><td></td><td colspan=\"".($num)."\" 
                 style=\"border: 1px solid black; background-color:#ffcc00;font-size:10pt;\">&nbsp;Spalten ausw&auml;hlen</td></tr>";
               $findcols .= "<tr><td style=\"border: 1px solid black; background-color:#ff6666; font-size:10pt;\" nowrap>&nbsp;Erste Zeile mit Daten&nbsp;<br>&nbsp;ausw&auml;hlen</td>";
               for ($c=0; $c < $num; $c++) {
                 $findcols .= "<td style=\"border: 1px solid black; background-color:#FFCC00; padding:5px;\">
                   &nbsp;&nbsp;<select name=\"cols[$c]\"><option></option>";

                 foreach($fields as $key=>$value){
                   if(count($cols)==0) { 
                     if($preselected[$key]==($c+1)) $selected="selected"; else $selected="";
                   } else {
                     if($cols[$c]==$key) $selected="selected"; else $selected="";
                   }    
                   $findcols .="<option value=\"$key\" $selected>$value</option>";
                 }

                 $findcols .="</select>&nbsp;</td>";
               }
               $findcols .= "</tr>";
             }
             if($row_post==$row) $checked="checked"; else $checked="";
             $findcols .= "<tr><td style=\"border: 1px solid black; background-color:#ff6666; padding:5px;\" align=\"center\">
               <input type=\"radio\" value=\"$row\" name=\"row\" $checked></td>";
             $row++;
             for ($c=0; $c < $num; $c++) {
               $findcols .= "<td style=\"border: 1px solid black;\">".$data[$c] . "&nbsp;</td>";
             }
             $findcols .= "</tr>";
             if($row > 10) break;
           }
         fclose($handle);
         $findcols .= "</table></div>
           <table width=\"1080\"><tr><td>
           <br><br>
           Bitte w&auml;hlen Sie aus:
           <ul><li>Die erste Zeile die Daten Ihrer Stueckliste enthält</li>
           <li>Die Spalten: Menge und Artikelnummer</li>
           </ul></td><td align=\"right\">
           <input type=\"submit\" value=\"Import abbrechen\" name=\"cancel\">
           <input type=\"submit\" value=\"Jetzt importieren\" name=\"import\">
           </td></tr></table>
           </form>
           ";
    } else {
      $findcols .= "
        <form action=\"#tabs-3\" method=\"post\" enctype=\"multipart/form-data\">
        <table width=\"1070\"><tr><td>
        Datei:&nbsp;
      <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"30000\" />
        <input name=\"userfile\" type=\"file\" />
        Vorlage: <select name=\"vorlage\">
        <!--<option></option>-->
        <option value=\"minimal\">Artikelnummer; Menge</option>
        <option value=\"altium\">Altium Designer</option>
        <!--<option value=\"eagle\">Eagle (Cadsoft) </option>-->
        </select> 
        </td><td align=\"right\">
        Trennzeichen: &nbsp;<input type=\"text\" size=\"3\" name=\"delimiter\" value=\";\">&nbsp;
      <!--Daten: &nbsp;<input type=\"text\" size=\"3\" value=\"&quot;\" name=\"quote\">&nbsp;-->
        <input type=\"submit\" value=\"St&uuml;ckliste laden\">
        </td></tr></table>
        </form>";



    }
    $this->app->Tpl->Set($parsetarget,$findcols);
    if(is_array($result)) return $result;
  }

  function ArtikelThumbnail() {

    $id = $this->app->Secure->GetGET("id");

    $datei = $this->app->DB->SelectArr('
      SELECT 
        datei_version.*
      FROM
        datei_stichwoerter
        LEFT JOIN datei_version ON datei_version.datei = datei_stichwoerter.datei
      WHERE
        datei_stichwoerter.objekt LIKE "artikel"
      AND
        datei_stichwoerter.parameter = "' . $id . '"
      AND
        (datei_stichwoerter.subjekt = "Shopbild" OR datei_stichwoerter.subjekt = "Bild")
      ORDER BY datei_version.version DESC
    ');

    if ($datei) {

      $datei = reset($datei);
      $img = new image($this->app);
      $str = $img->scaledPicByFileId($datei['id'], 100, 100);

    } else {

      if ($this->app->erp->Firmendaten('iconset_dunkel')) {
        $str = file_get_contents(dirname(__FILE__) . '/../themes/new/images/keinbild_dunkel.png');
      } else {
        $str = file_get_contents(dirname(__FILE__) . '/../themes/new/images/keinbild_hell.png');
      }

    }


    header('Content-type: image/jpg');
    echo $str;

    exit;


  }

  function ArtikelSchnellanlegen()
  {
    $submit_barcode = $this->app->Secure->GetPOST("submit_barcode");
    $submit_anlegen = $this->app->Secure->GetPOST("submit_anlegen");
    $barcode = $this->app->Secure->GetPOST("barcode");

    $this->app->erp->MenuEintrag("index.php?module=artikel&action=list","zur&uuml;ck zur &Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=artikel&action=schnellanlegen","Schnell anlegen");


    if($submit_barcode!="" && $barcode!="")
    {
      $checkbarcode = $this->app->DB->Select("SELECT id FROM artikel WHERE ean='$barcode' OR herstellernummer='$barcode' OR nummer='$barcode' LIMIT 1");

      if($checkbarcode > 0)
      {
        $name_nummer = $this->app->DB->Select("SELECT CONCAT(nummer,' ',name_de) FROM artikel WHERE id='$checkbarcode' LIMIT 1");
        $msg = $this->app->erp->base64_url_encode("<div class=info>Es gibt bereits einen Artikel mit dieser Nummer ($name_nummer).</div>");
        header("Location: index.php?module=artikel&action=schnellanlegen&msg=$msg");        
        exit;
      } else {

        // Default einträge laden wenn vorhanden
        $mhd = $this->app->User->GetParameter("artikel_schnellanlegen_mhd");
        $chargen = $this->app->User->GetParameter("artikel_schnellanlegen_chargen");

        if($mhd=="1") $this->app->Tpl->Set('MHD',"checked");
        if($chargen=="1") $this->app->Tpl->Set('CHARGEN',"checked");
  
        $this->app->Tpl->Parse('PAGE',"artikel_schnellanlegen_formular.tpl");
      }
    } 
    else if ($submit_anlegen!="")
    {
      $mhd = $this->app->Secure->GetPOST("mhd");
      $chargen = $this->app->Secure->GetPOST("chargen");
      $kategorie = $this->app->Secure->GetPOST("chargen");
      $name = $this->app->Secure->GetPOST("name");

      
    }
    else {
      $this->app->Tpl->Parse('PAGE',"artikel_schnellanlegen.tpl");
    }
  }

  // Zum Uberladen in Custom
  function ArtikelEigenschaftenSuche()
  {
  }


}

?>
