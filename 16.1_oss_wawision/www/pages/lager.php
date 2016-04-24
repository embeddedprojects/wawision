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
include ("_gen/lager.php");
class Lager extends GenLager {
  var $app;
  function Lager($app) {
    //parent::GenLager($app);
    $this->app = & $app;
    $this->app->ActionHandlerInit($this);
    $this->app->ActionHandler("create", "LagerCreate");
    $this->app->ActionHandler("edit", "LagerEdit");
    $this->app->ActionHandler("list", "LagerList");
    $this->app->ActionHandler("platz", "LagerPlatz");
    $this->app->ActionHandler("bewegung", "LagerBewegung");
    $this->app->ActionHandler("bewegungpopup", "LagerBewegungPopup");
    $this->app->ActionHandler("inhalt", "LagerInhalt");
    $this->app->ActionHandler("wert", "LagerWert");
    $this->app->ActionHandler("platzeditpopup", "LagerPlatzEditPopup");
    $this->app->ActionHandler("delete", "LagerDelete");
    $this->app->ActionHandler("deleteplatz", "LagerPlatzDelete");
    $this->app->ActionHandler("etiketten", "LagerEtiketten");
    $this->app->ActionHandler("zwischenlager", "LagerZwischenlager");
    $this->app->ActionHandler("regaletiketten", "LagerRegalEtiketten");
    $this->app->ActionHandler("reservierungen", "LagerReservierungen");
    $this->app->ActionHandler("buchen", "LagerBuchen");
    $this->app->ActionHandler("buchenzwischenlager", "LagerBuchenZwischenlager");
    $this->app->ActionHandler("buchenzwischenlagerdelete", "LagerBuchenZwischenlagerDelete");
    $this->app->ActionHandler("bucheneinlagern", "LagerBuchenEinlagern");
    $this->app->ActionHandler("buchenauslagern", "LagerBuchenAuslagern");
    $this->app->ActionHandler("artikelentfernenreserviert", "LagerArtikelEntfernenReserviert");
    $this->app->ActionHandler("letztebewegungen", "LagerLetzteBewegungen");
    $this->app->ActionHandler("schnelleinlagern", "LagerSchnellEinlagern");
    $this->app->ActionHandler("schnellumlagern", "LagerSchnellUmlagern");
    $this->app->ActionHandler("schnellauslagern", "LagerSchnellAuslagern");
    $this->app->ActionHandler("differenzen", "LagerDifferenzen");
    $this->app->ActionHandler("differenzenlagerplatz", "LagerDifferenzenLagerplatz");

    $this->erstes=0;

    $id = $this->app->Secure->GetGET("id");
    $nummer = $this->app->Secure->GetPOST("nummer");
    if ($nummer == "") $lager = $this->app->DB->Select("SELECT bezeichnung FROM lager WHERE id='$id' LIMIT 1");
    else $lager = $nummer;
    $woher = $this->app->Secure->GetPOST("woher");
    $action = $this->app->Secure->GetGET("action");
    $cmd = $this->app->Secure->GetGET("cmd");
    if ($action == "bucheneinlagern") if ($cmd == "zwischenlager") $lager = "Zwischenlager";
    else $lager = "Manuelle Lageranpassung";
    $this->app->Tpl->Set('UEBERSCHRIFT', "Lager: " . $lager);
    $this->app->ActionHandlerListen($app);
    $this->app = $app;
  }



  function LagerSchnellEinlagern()
  {
    $this->LagerBuchenMenu();
    $submit = $this->app->Secure->GetPOST("submit");
    $nummer = $this->app->Secure->GetPOST("nummer");
    $menge = $this->app->Secure->GetPOST("menge");
    $grundreferenz = $this->app->Secure->GetPOST("grundreferenz");

    if($submit!="")
    {


    }



    $this->app->YUI->AutoComplete('nummer','lagerartikelnummer');
    $this->app->YUI->AutoComplete('grundreferenz','lagergrund');
    $this->app->Tpl->Parse('TAB1',"lager_schnelleinlagern.tpl");
    $this->app->Tpl->Parse('PAGE',"tabview.tpl");
  }	


  function LagerAbsolutInventur($artikel,$lager_platz = false)
  {

    if ($lager_platz) {
      $query = "
      SELECT 
      menge,
      referenz
        FROM
        lager_bewegung
        WHERE 
        artikel='".$artikel."' 
        AND 
        eingang=1 
        AND
        permanenteinventur<=0
        AND 
        referenz LIKE 'Inventur%'
        ";

      $query .= " AND lager_platz = '" . $lager_platz . "' ";
    } else {
      $query = "
      SELECT 
      lb.menge,
      lb.referenz
        FROM
        lager_bewegung lb
        LEFT JOIN lager_platz l ON l.id=lb.lager_platz
        WHERE 
        lb.artikel='".$artikel."' 
        AND 
        lb.eingang=1 
        AND
        lb.permanenteinventur<=0
        AND 
        lb.referenz LIKE 'Inventur%'
        AND l.verbrauchslager!=1
        ";
    }

    $this->app->DB->SelectArr($query);

    for($i=0;$i<count($result);$i++)
    {
      $tmp_eingang = trim(str_replace('neu:','',strstr ( $result[$i]['referenz'] , "neu:", false)));
      if($tmp_eingang != $result[$i]['menge'])
      {
        // TODO alte Menge auf korrekte neue setzten!
        $eingang += $tmp_eingang;
      } else {
        $eingang += $result[$i]['menge'];
      }

      $pattern = '/alt:(.*?)neu:/';
      preg_match($pattern, $result[$i]['referenz'], $matches);
      $tmp_ausgang = trim($matches[1]);

      if(is_numeric($tmp_ausgang))
      {
        $ausgang += $tmp_ausgang;
      }
    }
    return $eingang - $ausgang;//$this->app->DB->Select("SELECT SUM(menge) FROM lager_bewegung WHERE artikel='".$artikelarr[$i]."' AND eingang=1");
  }

  function LagerAbsolutEingang($artikel, $lager_platz = false)
  {

   if ($lager_platz) {
    $query = "
      SELECT 
      SUM(menge) 
      FROM 
      lager_bewegung 
      WHERE 
      artikel='".$artikel."' 
      AND 
      eingang=1 
      AND
      permanenteinventur<=0
      AND 
      referenz 
      NOT LIKE 'Inventur%'
      ";
      $query .= " AND lager_platz = '" . $lager_platz . "' ";
    } else {
      $query = "
      SELECT 
      SUM(lb.menge) 
      FROM 
      lager_bewegung lb
      LEFT JOIN lager_platz l ON l.id=lb.lager_platz
      WHERE 
      lb.artikel='".$artikel."' 
      AND 
      lb.eingang=1 
      AND
      lb.permanenteinventur<=0
      AND 
      lb.referenz 
      NOT LIKE 'Inventur%'
      AND 
      l.verbrauchslager!=1
      ";
    }

    return $this->app->DB->Select($query);
  }

  function LagerAbsolutAusgang($artikel, $lager_platz = false)
  {
    if ($lager_platz) {
      $query = "
      SELECT 
      SUM(menge) 
      FROM 
      lager_bewegung 
      WHERE 
      artikel='".$artikel."' 
      AND 
      eingang=0 
      AND
      permanenteinventur<=0
      AND 
      referenz 
      NOT LIKE 'Inventur%'
      ";


      $query .= " AND lager_platz = '" . $lager_platz . "' ";
    } else {

  $query = "
      SELECT 
      SUM(lb.menge) 
      FROM 
      lager_bewegung lb
      LEFT JOIN lager_platz l ON l.id=lb.lager_platz
      WHERE 
      lb.artikel='".$artikel."' 
      AND 
      lb.eingang=0
      AND
      lb.permanenteinventur<=0
      AND 
      lb.referenz 
      NOT LIKE 'Inventur%'
      AND 
      l.verbrauchslager!=1
      ";


      }

    return $this->app->DB->Select($query);
  }

  function LagerDifferenzen()
  {
    $this->LagerHauptmenu();
      $this->app->Tpl->Set('VERS','Enterprise');
      $this->app->Tpl->Set('MODUL','Enterprise');
      $this->app->Tpl->Parse('PAGE', "only_version.tpl");
  } 

  function LagerDifferenzenLagerplatz() {

    $this->LagerHauptmenu();
      $this->app->Tpl->Set('VERS','Enterprise');
      $this->app->Tpl->Set('MODUL','Enterprise');
      $this->app->Tpl->Parse('PAGE', "only_version.tpl");

  }

  function LagerSchnellUmlagern()
  {
    $this->LagerBuchenMenu();
    $submit = $this->app->Secure->GetPOST("submit");
    $nummer = $this->app->Secure->GetPOST("nummer");
    $get_nummer = $this->app->Secure->GetGET("nummer");
    $menge = $this->app->Secure->GetPOST("menge");
    $grundreferenz = $this->app->Secure->GetPOST("grundreferenz");
    $ziellager = $this->app->Secure->GetPOST("ziellager");

    if($get_nummer!="")
      $this->app->Tpl->Set(FOCUS,"ziellager");
    else
      $this->app->Tpl->Set(FOCUS,"nummer");


    $lager_platz = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$ziellager' AND kurzbezeichnung!='' LIMIT 1");			
    if($lager_platz<=0 && $ziellager > 0)
    {
      $lager_platz = $this->app->DB->Select("SELECT id FROM lager_platz WHERE id='$ziellager' LIMIT 1");			
      $ziellager = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$lager_platz' LIMIT 1");			
    }

    if($grundreferenz!="") $this->app->User->SetParameter("lager_schnellumlagern_grund",$grundreferenz);
    if($ziellager!="") $this->app->User->SetParameter("lager_schnellumlagern_ziellager",$ziellager);

    if($submit!="")
    {
      $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' AND nummer!='' LIMIT 1");			
      if($artikelid <=0)
        $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE ean='$nummer' AND ean!='' LIMIT 1");			
      if($artikelid <=0)
        $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE herstellernummer='$nummer' herstellernummer!='' LIMIT 1");			

      $name_de = $this->app->DB->Select("SELECT CONCAT(nummer,' ',name_de) FROM artikel WHERE id='$artikelid' LIMIT 1");
      //$projekt = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$artikelid' LIMIT 1");

      if($artikelid > 0 && $lager_platz > 0)
      {
        $anzahl_artikel = $this->app->DB->Select("SELECT SUM(menge) FROM lager_platz_inhalt WHERE artikel='$artikelid'");
        if($anzahl_artikel >= $menge)
        {
          // auslagern bevorzugt aus lager_platz ansonsten von den anderen
          $this->app->erp->LagerAutoAuslagernArtikel($artikelid,$menge,$grundreferenz);

          // einlagern lager_platz
          $this->app->erp->LagerEinlagern($artikelid,$menge,$lager_platz,$projekt,$grundreferenz);

          $msg = $this->app->erp->base64_url_encode("<div class=\"warning\">Der Artikel $name_de wurde $menge mal umgelagert!</div>");
          header("Location: index.php?module=lager&action=schnellumlagern&msg=$msg");
          exit;
        } else {
          if($anzahl_artikel > 0)
            $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Artikel ist nur maximal $anzahl_artikel im Lager vorhanden! Bitte korrekte Menge angeben!</div>");
          else
            $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Artikel hat keinen Bestand im Lager!</div>");
          header("Location: index.php?module=lager&action=schnellumlagern&msg=$msg");
          exit;
        }	

      } else {
        if($artikelid<=0)
        {
          $msg = "<div class=\"error\">Der Artikel mit der Nummer $nummer wurde nicht gefunden!</div>";
          $get_nummer = "";
        }
        else
          $get_nummer = $nummer;

        if($lager_platz<=0)
        {
          $msg .= "<div class=\"error\">Das Ziellager $ziellager wurde nicht gefunden!</div>";
          $this->app->User->SetParameter("lager_schnellumlagern_ziellager","");
        }
        $msg = $this->app->erp->base64_url_encode($msg);
        header("Location: index.php?module=lager&action=schnellumlagern&msg=$msg&nummer=$get_nummer");
        exit;
      }
    } else {
      $msg = $this->app->Secure->GetGET("msg");
      if($msg=="")
        $this->app->Tpl->Set('MESSAGE','<div class="info">Der Artikel wird wenn vorhanden aus dem Standardlager ausgelagert.</div>');
    }

    if($grundreferenz=="") $grundreferenz=$this->app->User->GetParameter("lager_schnellumlagern_grund");
    if($ziellager=="") $ziellager=$this->app->User->GetParameter("lager_schnellumlagern_ziellager");
    $this->app->Tpl->Set('GRUNDREFERENZ',$grundreferenz);
    $this->app->Tpl->Set('ZIELLAGER',$ziellager);

    $this->app->Tpl->Set('NUMMER',$get_nummer);
    $this->app->YUI->AutoComplete('nummer','lagerartikelnummer',1);
    $this->app->YUI->AutoComplete('ziellager','lagerplatz');
    $this->app->YUI->AutoComplete('grundreferenz','lagergrund');
    $this->app->Tpl->Parse('PAGE',"lager_schnellumlagern.tpl");
  }	



  function LagerSchnellAuslagern()
  {
    $this->LagerBuchenMenu();
    $submit = $this->app->Secure->GetPOST("submit");
    $nummer = $this->app->Secure->GetPOST("nummer");
    $menge = $this->app->Secure->GetPOST("menge");
    $grundreferenz = $this->app->Secure->GetPOST("grundreferenz");

    if($grundreferenz!="") $this->app->User->SetParameter("lager_schnellauslagern_grund",$grundreferenz);

    if($submit!="")
    {
      $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' AND nummer!='' LIMIT 1");			
      if($artikelid <=0)
        $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE ean='$nummer' AND ean!='' LIMIT 1");			
      if($artikelid <=0)
        $artikelid = $this->app->DB->Select("SELECT id FROM artikel WHERE herstellernummer='$nummer' herstellernummer!='' LIMIT 1");			

      $name_de = $this->app->DB->Select("SELECT CONCAT(nummer,' ',name_de) FROM artikel WHERE id='$artikelid' LIMIT 1");

      if($artikelid > 0)
      {
        $anzahl_artikel = $this->app->DB->Select("SELECT SUM(menge) FROM lager_platz_inhalt WHERE artikel='$artikelid'");
        if($anzahl_artikel >= $menge )
        {
          // auslagern bevorzugt aus lager_platz ansonsten von den anderen
          $this->app->erp->LagerAutoAuslagernArtikel($artikelid,$menge,$grundreferenz);
          $msg = $this->app->erp->base64_url_encode("<div class=\"warning\">Der Artikel $name_de wurde $menge mal ausgelagert!</div>");
          header("Location: index.php?module=lager&action=schnellauslagern&msg=$msg");
          exit;
        } else {
          $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Artikel ist nur maximal $anzahl_artikel im Lager vorhanden! Bitte korrekte Menge angeben!</div>");
          header("Location: index.php?module=lager&action=schnellauslagern&msg=$msg");
          exit;
        }	

      } else {
        $msg = $this->app->erp->base64_url_encode("<div class=\"error\">Der Artikel mit der Nummer $nummer wurde nicht gefunden!</div>");
        header("Location: index.php?module=lager&action=schnellauslagern&msg=$msg");
        exit;
      }
    } else {
      $msg = $this->app->Secure->GetGET("msg");
      if($msg=="")
        $this->app->Tpl->Set('MESSAGE','<div class="info">Der Artikel wird wenn vorhanden aus dem Standardlager ausgelagert.</div>');
    }

    if($grundreferenz=="") $grundreferenz=$this->app->User->GetParameter("lager_schnellauslagern_grund");
    $this->app->Tpl->Set('GRUNDREFERENZ',$grundreferenz);

    $this->app->YUI->AutoComplete('nummer','lagerartikelnummer',1);
    $this->app->YUI->AutoComplete('grundreferenz','lagergrund');
    $this->app->Tpl->Parse('PAGE',"lager_schnellauslagern.tpl");
  }	



  function LagerWert()
  {
      $this->LagerHauptmenu();
      $this->app->Tpl->Set('VERS','Professional');
      $this->app->Tpl->Set('MODUL','Professional');
      $this->app->Tpl->Parse('PAGE', "only_version.tpl");
  }

  function LagerBuchenZwischenlagerDelete()
  {
    $id = $this->app->Secure->GetGET('id');

    $this->app->DB->Delete("DELETE FROM zwischenlager WHERE id='$id' LIMIT 1");
    header("Location: index.php?module=lager&action=buchenzwischenlager&top=TGFnZXI=");
    exit;
  }


  function LagerPlatzDelete()
  {
    $id = $this->app->Secure->GetGET('id');
    //if(is_numeric($id))
    //  $this->app->DB->Delete("DELETE FROM lager WHERE id='$id' LIMIT 1");

    $numberofarticles = $this->app->DB->Select("SELECT COUNT(id) FROM lager_platz_inhalt WHERE lager_platz='$id' LIMIT 1");

    if($numberofarticles > 0)
    {
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">In diesem Lager existieren Artikel. Es k&ouml;nnen nur leere Lagerpl&auml;tze gel&ouml;scht werden!</div>");
    }
    else {
      $this->app->DB->Select("DELETE FROM lager_platz WHERE id='$id' LIMIT 1");
      $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Das Regal wurde gel&ouml;scht!</div>");
    }

    $ref = $_SERVER['HTTP_REFERER'];
    header("Location: $ref&msg=$msg");
    exit;
  }


  function LagerDelete()
  {
    $id = $this->app->Secure->GetGET('id');
    //if(is_numeric($id))
    //  $this->app->DB->Delete("DELETE FROM lager WHERE id='$id' LIMIT 1");

    $numberofarticles = $this->app->DB->Select("SELECT COUNT(id) FROM lager_platz WHERE lager='$id' LIMIT 1");

    if($numberofarticles > 0)
    {
      $msg = $this->app->erp->base64_url_encode("<div class=\"error\">In diesem Lager existieren noch Lagerpl&auml;tze. Es k&ouml;nnen nur leere Lager gel&ouml;scht werden!</div>");
    }
    else {
      $this->app->DB->Select("DELETE FROM lager WHERE id='$id' LIMIT 1");
      $msg = $this->app->erp->base64_url_encode("<div class=\"error2\">Das Lager wurde gel&ouml;scht!</div>");
    }

    $ref = $_SERVER['HTTP_REFERER'];
    header("Location: $ref&msg=$msg");
    exit;
  }


  function LagerArtikelEntfernenReserviert() {
    $reservierung = $this->app->Secure->GetGET("reservierung");
    if (is_numeric($reservierung)) $this->app->DB->Delete("DELETE FROM lager_reserviert WHERE id='$reservierung'");
    header("Location: index.php?module=lager&action=reservierungen");
    exit;
  }
  
  function LagerBuchen() {
    //$this->LagerBuchenMenu();
    //$this->app->Tpl->Set(TABTEXT,"&Uuml;bersicht");
    //$this->app->Tpl->Parse('PAGE',"tabview.tpl");
    $this->LagerBuchenZwischenlager();
  }
  function LagerKalkMenu() {
    $id = $this->app->Secure->GetGET("id");
    //    $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Lagerkalkulation");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Bestellvorschlag");

  }


  function LagerBuchenZwischenlager() {
    $this->LagerBuchenMenu();
    //$this->app->Tpl->Set(TABTEXT, "Zwischenlager");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Zwischenlager");
    $this->app->Tpl->Set('SUBSUBHEADING', "EINGANG Zwischenlager Stand " . date('d.m.Y'));
    // easy table mit arbeitspaketen YUI als template
    if($this->app->User->GetType()=="admin")
      $delete = "<a href=\"#\" onclick=\"if(!confirm('Artikelwirklich aus dem Zwischenlager nehmen?')) return false; else window.location.href='index.php?module=lager&action=buchenzwischenlagerdelete&id=%value%';\"><img src=\"./themes/[THEME]/images/delete.gif\" border=\"0\"></a>";

    $table = new EasyTable($this->app);
    $table->Query("SELECT a.name_de as artikel,a.nummer as nummer,z.menge,z.vpe,z.grund, p.abkuerzung as projekt, z.id FROM zwischenlager z LEFT JOIN artikel a ON a.id=z.artikel LEFT JOIN projekt p ON 
        p.id=z.projekt WHERE z.firma='{$this->app->User->GetFirma() }' AND z.richtung='eingang'");
    $table->DisplayNew('INHALT', "<a href=\"index.php?module=lager&action=bucheneinlagern&cmd=zwischenlager&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/forward.png\"></a>$delete");
    $this->app->Tpl->Parse('TAB1', "rahmen70.tpl");
    $this->app->Tpl->Set('INHALT', "");
    $this->app->Tpl->Set('SUBSUBHEADING', "AUSGANG Zwischenlager Stand " . date('d.m.Y'));
    // easy table mit arbeitspaketen YUI als template
    $table = new EasyTable($this->app);
    $table->Query("SELECT a.name_de as artikel,z.menge,z.vpe,z.grund, p.abkuerzung as projekt, z.id FROM zwischenlager z LEFT JOIN artikel a ON a.id=z.artikel LEFT JOIN projekt p ON 
        p.id=z.projekt WHERE z.firma='{$this->app->User->GetFirma() }' AND z.richtung='ausgang' ORDER by z.id DESC");
    $table->DisplayNew('INHALT', "<a href=\"index.php?module=lager&action=bucheneinlagern&cmd=zwischenlager&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/forward.png\"></a>$delete");
    $this->app->Tpl->Parse('TAB1', "rahmen70.tpl");
    $this->app->Tpl->Set('AKTIV_TAB1', "selected");
    $this->app->Tpl->Parse('PAGE', "tabview.tpl");
  }

  function LagerBuchenEinlagern() {
    session_start();
    $this->LagerBuchenMenu();
    $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Einlagern");
    $id = $this->app->Secure->GetGET("id");
    $cmd = $this->app->Secure->GetGET("cmd"); // vom zwischen lager!
    $menge = $this->app->Secure->GetPOST("menge");
    $submit = $this->app->Secure->GetPOST("submit");

    $grund = $this->app->Secure->GetPOST("grund");
    $artikelid = $this->app->Secure->GetGET("artikelid");

    $this->app->YUI->AutoComplete('projekt','projektname');
    $this->app->YUI->AutoComplete('nummer','lagerartikelnummer');
    $this->app->YUI->AutoComplete('regal','lagerplatz');
    $this->app->YUI->AutoComplete('grundreferenz','lagergrund');

    if($cmd=="zwischenlager")
    {

      $this->app->Tpl->Set('MENGEREADONLY',"readonly");
      $this->app->Tpl->Set('WOHERREADONLYSTART',"<!--");
      $this->app->Tpl->Set('WOHERREADONLYENDE',"-->");

      $this->app->erp->LogFile("test 7776");

      $mhd = $this->app->DB->SelectArr("SELECT * FROM lager_mindesthaltbarkeitsdatum WHERE zwischenlagerid='$id'");
      for($i=1;$i<=count($mhd);$i++)
      {
        $this->app->Tpl->Add('SRNINFO',"<tr><td></td><td>MHD: ".$mhd[$i-1][mhddatum]."</td></tr>");
      }
      $charge = $this->app->DB->SelectArr("SELECT * FROM lager_charge WHERE zwischenlagerid='$id'");
      for($i=1;$i<=count($charge);$i++)
      {
        $this->app->Tpl->Add('SRNINFO',"<tr><td></td><td>Charge: ".$charge[$i-1][charge]."</td></tr>");
      }
      $srn = $this->app->DB->SelectArr("SELECT * FROM lager_seriennummern WHERE zwischenlagerid='$id'");
      for($i=1;$i<=count($srn);$i++)
      {
        $this->app->Tpl->Add('SRNINFO',"<tr><td></td><td>Seriennummer: ".$srn[$i-1][seriennummer]."</td></tr>");
      }

      $this->app->Tpl->Set('SHOWCHRSTART',"<!--");
      $this->app->Tpl->Set('SHOWCHREND',"-->");
      $this->app->Tpl->Set('SHOWMHDSTART',"<!--");
      $this->app->Tpl->Set('SHOWMHDEND',"-->");
      $this->app->Tpl->Set('SHOWSRNSTART',"<!--");
      $this->app->Tpl->Set('SHOWSRNEND',"-->");
    } else {
      $this->app->Tpl->Set('WOHERREADONLYSTART2',"<!--");
      $this->app->Tpl->Set('WOHERREADONLYENDE2',"-->");
    }

    // wenn projekt angeben
    if ($this->app->Secure->GetPOST("projekt") != "") 
    {
      $projekt = $this->app->Secure->GetPOST("projekt");
      $projekt = explode(' ', $projekt);
      $projekt = $projekt[0];
      if(!is_numeric($projekt))
        $projekt = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");

      $_SESSION['projekt'] = $projekt;
    }

    $projekt = $_SESSION['projekt'];
    $regal = $this->app->Secure->GetPOST("regal");

    if($regal!=""){
      $regal_id = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$regal' LIMIT 1");
    }


    if(is_numeric($regal_id))
      $regal = $regal_id;

    $nummer = $this->app->Secure->GetPOST("nummer");
    $nummer = explode(' ', $nummer);
    $nummer = $nummer[0];

    if ($nummer == "" && $cmd != "zwischenlager" && $artikelid=="") {
      $this->app->Tpl->Set(MSGARTIKEL, "<br>Jetzt Artikel abscannen!");
      $this->app->Tpl->Set(ARTIKELSTYLE, "style=\"border: 2px solid red;width:200px;\"");
    }

    $woher = $this->app->Secure->GetPOST("woher");
    $zwischenlagerid = $this->app->Secure->GetPOST("zwischenlager");
    $menge = $this->app->Secure->GetPOST("menge");
    $grundreferenz = $this->app->Secure->GetPOST("grundreferenz");
    // hier nur rein wenn artikel lager und projekt sinn machen sonst 	
    //message ausgeben und artikel wirklich aus zwischenlager
    $alles_komplett = 0;
    if ($woher == "Zwischenlager" && $zwischenlagerid <= 0) {
      $grund.= "<li>Artikel kommt nicht aus Zwischenlager!</li>";
      $alles_komplett++;
    }



    $artikel_tmp = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' AND geloescht!=1 LIMIT 1");
    $ean = $this->app->DB->Select("SELECT id FROM artikel WHERE ean='$nummer' AND ean!='' AND geloescht!=1 LIMIT 1");
    if($artikel_tmp <=0 && $ean > 0) 
    { 
      $artikel_tmp = $ean;
      $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$ean' LIMIT 1");
    }
    $artikelcheck = $this->app->DB->Select("SELECT id FROM artikel WHERE id='$artikel_tmp' LIMIT 1");

    $artikel_quickcheck = 0;
    if ($submit !="" && ($artikelcheck != $artikel_tmp || $artikel_tmp == "" || $artikel_tmp == 0)) {
      $grund.= "<li>Artikel-Nummer gibt es nicht!</li>";
      $alles_komplett++;
      $artikel_quickcheck = 1;
    }

    // gibts regal
    $regalcheck = $this->app->DB->Select("SELECT id FROM lager_platz WHERE id='$regal' LIMIT 1");
    if ($regalcheck != $regal || $regal == "" || $regal == 0) {
      $grund.= "<li>Regal gibt es nicht!</li>";
      $alles_komplett++;
    }

    if ($alles_komplett > 0 && $regal != "") {
      $this->app->Tpl->Set('MESSAGELAGER', "<div class=\"error\">Artikel wurde nicht gebucht! Grund:<ul>$grund</ul> </div>");
    } else {
      if ($artikel_quickcheck == 1 && $nummer != "") {
        $this->app->Tpl->Set('MESSAGELAGER', "<div class=\"error\">Achtung! Artikelnummer  
            gibt es nicht! </div>");
        $nummer =""; 
      }
    }
    if ($nummer == "" && $cmd == "" && $woher == "") $_SESSION[woher] = 'Manuelle Lageranpassung';

    $chargenverwaltung= $this->app->DB->Select("SELECT chargenverwaltung FROM artikel WHERE id='$artikel_tmp' LIMIT 1");
    $mindesthaltbarkeitsdatum = $this->app->DB->Select("SELECT mindesthaltbarkeitsdatum FROM artikel WHERE id='$artikel_tmp' LIMIT 1");
    $seriennummern = $this->app->DB->Select("SELECT seriennummern FROM artikel WHERE id='$artikel_tmp' LIMIT 1");

    // pruefen einlagern

    $error = 0;
    // Pflichtfelder pruefen
    if($mindesthaltbarkeitsdatum=="1" && $this->app->Secure->GetPOST("mhd")=="")
    {
      $error++;
    }

    if($chargenverwaltung=="2" && $this->app->Secure->GetPOST("charge")=="")
    {
      $error++;
    }
    if( ($seriennummern !="keine" && $seriennummern !="vomprodukt" && $seriennummern !="eigene" && $seriennummern!="") && $cmd!="zwischenlager")
    {
      $tmpcheck = $this->app->Secure->GetPOST("seriennummern");
      for($checkser=0;$checkser < $menge; $checkser++)
      {
        if($tmpcheck[$checkser]=="")
          $error++;
      }
    }

    if($submit!="" && $error > 0)
    {
      $alles_komplett++;
      //$this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Achtung! Bitte alle Pflichtfelder (Regal, MHD, Charge, Seriennummer) ausf&uuml;llen!</div>");
    }

    if ($alles_komplett == 0 && $regal != "") {
      $artikel = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' AND geloescht!=1 LIMIT 1");
      // pruefe ob es einen ek fuers projekt gibt sonst meckern!!!
      //echo "buchen entweder aus zwischenlager, prpoduktion oder so";
      if ($woher == "Zwischenlager") {
        $this->app->erp->LagerEinlagerVomZwischenlager($zwischenlagerid, $menge, $regal, $projekt,$grundreferenz);
        header("Location: index.php?module=lager&action=buchenzwischenlager");
        exit;
      }
      if ($woher == "Manuelle Lageranpassung"){
        $_SESSION[projekt] = $projekt;
        $this->app->erp->LagerEinlagernDifferenz($artikel, $menge, $regal, $projekt,$grundreferenz);

        // Mindesthaltbarkeitsdatum buchen
        $chargemindest = $this->app->Secure->GetPOST("charge");
        $mhd = $this->app->String->Convert($this->app->Secure->GetPOST("mhd"),"%1.%2.%3","%3-%2-%1");
        $this->app->erp->AddMindesthaltbarkeitsdatumLagerOhneBewegung($artikel,$menge,$regal,$mhd,$chargemindest,"");

        if($chargenverwaltung > 0)
        {  
          $datum = date('Y-m-d');
          $this->app->erp->AddChargeLagerOhneBewegung($artikel,$menge,$regal,$datum,$chargemindest,"");
        }

        //Seriennummern buchen
        $tmpcheck = $this->app->Secure->GetPOST("seriennummern");


        if($artikelid!="")
          header("Location: index.php?module=artikel&action=lager&id=$artikelid");
        else
          header("Location: index.php?module=lager&action=bucheneinlagern");
        exit;
      }
      // wenn von zwischenlager dann header location nach zwischenlager
      // sonst einlagern
    }

    // kommt direkt vom zwischenlager
    if ($cmd == "zwischenlager") {
      $_SESSION[woher] = "Zwischenlager";
      $projekt = $this->app->DB->Select("SELECT projekt FROM zwischenlager WHERE id='$id' LIMIT 1");
      $menge = $this->app->DB->Select("SELECT menge FROM zwischenlager WHERE id='$id' LIMIT 1");
      $artikel = $this->app->DB->Select("SELECT artikel FROM zwischenlager WHERE id='$id' LIMIT 1");
      $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1");
      $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1");
      $lagerplatz = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='$artikel' LIMIT 1");
      $lagerbezeichnung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$lagerplatz' LIMIT 1");
      $vpe = $this->app->DB->Select("SELECT vpe FROM zwischenlager WHERE id='$id' LIMIT 1");
      $projekt = $this->app->DB->Select("SELECT projekt FROM zwischenlager WHERE id='$id' LIMIT 1");
      if ($projekt == "" || $projekt == 0) $projekt = 1; // default projekt
      $standardbild = $this->app->DB->Select("SELECT standardbild FROM artikel WHERE id='$artikel' LIMIT 1");
      if ($standardbild == "") $standardbild = $this->app->DB->Select("SELECT datei FROM datei_stichwoerter WHERE subjekt='Shopbild' AND objekt='Artikel' AND parameter='$artikel' LIMIT 1");
      $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr valign=\"top\"><td>Bezeichnung:</td><td>$name_de</td></tr>");
      if ($standardbild > 0) $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr valign=\"top\"><td>Bild:</td><td align=\"center\"><img src=\"index.php?module=dateien&action=send&id=$standardbild\" width=\"110\"></td></tr>");

      if($lagerbezeichnung!="")
      {
        $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr valign=\"top\"><td></td><td><br></td></tr><tr ><td>Regalvorschlag:</td><td><font size=\"5\"><b onclick=\"document.getElementById('regal').value='$lagerbezeichnung'\";>$lagerbezeichnung</b></font></td></tr>");
      } else {
        $lagermeist = $this->app->DB->SelectArr("SELECT lager_platz, SUM(menge) FROM lager_platz_inhalt WHERE artikel='$artikel' GROUP BY lager_platz ORDER by 1 DESC LIMIT 1");
        $lagerplatz = $lagermeist[0]['lager_platz'];
        $lagerbezeichnung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='{$lagermeist[0]['lager_platz']}' LIMIT 1");
        //$lagerplatz = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='$artikel' LIMIT 1");
        //$lagerbezeichnung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$lagerplatz' LIMIT 1");

        if ($lagerplatz == "" || $lagerplatz == 0) $lagerbezeichnung = "Regal frei w&auml;hlen";

        $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr valign=\"top\"><td></td><td><br></td></tr><tr ><td>Regalvorschlag:</td><td><font size=\"5\"><b onclick=\"document.getElementById('regal').value='$lagerbezeichnung'\";>$lagerbezeichnung</b></font></td></tr>");

      }
      $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr valign=\"top\"><td><br><br><b>Regal:</b></td><td><br><br><input type=\"text\" name=\"regal\" id=\"regal\" style=\"border: 2px solid;width:200px;\"><br>Jetzt Regal abscannen!</td></tr>
          <input type=\"hidden\" name=\"zwischenlager\" value=\"$id\">");
      $this->app->Tpl->Add('ZWISCHENLAGERINFO', '<script type="text/javascript">
          document.getElementById("regal").focus();
          </script>');



    } else {

      if (($menge == "" || $menge == 0) && $cmd!="umlagern") $menge = 1;

      if ($this->app->Secure->GetPOST("woher") != "") {
        $_SESSION[woher] = $this->app->Secure->GetPOST("woher");
      }

      if ($this->app->Secure->GetPOST("nummer") != "" || $artikelid > 0) {
        $nummer = $this->app->Secure->GetPOST("nummer");
        $nummer = explode(' ', $nummer);
        $nummer = $nummer[0];

        if($artikelid > 0){
          $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikelid' LIMIT 1");
          $this->app->Tpl->Set('NUMMER', $nummer);
        }

        $artikel = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' AND geloescht!=1 LIMIT 1");

        $ean = $this->app->DB->Select("SELECT id FROM artikel WHERE ean='$nummer' AND ean!='' AND geloescht!=1 LIMIT 1");
        if($artikel <=0 && $ean > 0) 
        { 
          $artikel = $ean;
          $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$ean' LIMIT 1");
        }

        if($artikel > 0)
        {

          $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1");
          $lagermeist = $this->app->DB->SelectArr("SELECT lager_platz, SUM(menge) FROM lager_platz_inhalt WHERE artikel='$artikel' GROUP BY lager_platz ORDER by 1 DESC LIMIT 1");
          $lagermeist = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='{$lagermeist[0]['lager_platz']}' LIMIT 1");
          $lagerplatz = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='$artikel' LIMIT 1");
          $lagerbezeichnung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$lagerplatz' LIMIT 1");
          if ($lagerplatz == "" || $lagerplatz == 0) $lagerbezeichnung = "Regal frei w&auml;hlen";
          //$vpe  = $this->app->DB->Select("SELECT vpe FROM artikel WHERE id='$id' LIMIT 1");
          $vpe = 'einzeln';
          //$projekt = $this->app->DB->Select("SELECT projekt FROM zwischenlager WHERE id='$id' LIMIT 1");
          if ($projekt == "" || $projekt == 0) $projekt = 1; // default projekt


          if($chargenverwaltung !="2")
          {
            $this->app->Tpl->Set('SHOWCHRSTART',"<!--");
            $this->app->Tpl->Set('SHOWCHREND',"-->");
          } else {
            //        $this->app->YUI->DatePicker("mhd");
            $this->app->Tpl->Set('CHARGEVALUE',$this->app->Secure->GetPOST("charge"));
          }


          if($mindesthaltbarkeitsdatum !="1")
          {
            $this->app->Tpl->Set('SHOWMHDSTART',"<!--");
            $this->app->Tpl->Set('SHOWMHDEND',"-->");
          } else {
            $this->app->YUI->DatePicker("mhd");
            $this->app->Tpl->Set('MHDVALUE',$this->app->Secure->GetPOST("mhd"));
          }


          if($seriennummern == "keine" || $seriennummern =="vomprodukt" || $seriennummern =="eigene" || $menge <= 0 ||  $seriennummern=="")
          {
            $this->app->Tpl->Set('SHOWSRNSTART',"<!--");
            $this->app->Tpl->Set('SHOWSRNEND',"-->");
          } else {
            // Generator felder fuer seriennummern
            $this->app->Tpl->Add('SERIENNUMMERN',"<table><tr><td>Nr.</td><td>Seriennummer</td></tr>");
            $tmp = $this->app->Secure->GetPOST("seriennummern");
            for($ij=1;$ij<=$menge;$ij++)
            {
              $value = $tmp[$ij-1];
              $this->app->Tpl->Add('SERIENNUMMERN',"<tr><td>$ij</td><td><input type=\"text\" name=\"seriennummern[]\" size=\"30\" value=\"$value\"></td></tr>");
            }
            $this->app->Tpl->Add('SERIENNUMMERN',"</table>");
          }

          $standardbild = $this->app->erp->GetArtikelStandardbild($artikel,true);

          if ($standardbild > 0)
            $this->app->Tpl->Set('STANDARDBILD', "<tr valign=\"top\"><td>Bild:</td><td align=\"center\"><img src=\"index.php?module=dateien&action=send&id=$standardbild\" width=\"110\"></td></tr>");

          $this->app->Tpl->Set('NAMEDE',$name_de);
          if($lagermeist!="" || $lagermeist!=0){
            $this->app->Tpl->Set('LAGERMEIST',"<b onclick=\"document.getElementById('regal').value='$lagermeist'\";>$lagermeist</b> (aktuell am meisten im Lager)");
            if($lagerbezeichnung!="" && $lagerbezeichnung!="Regal frei w&auml;hlen")
              $this->app->Tpl->Add('LAGERMEIST',"<br><b onclick=\"document.getElementById('regal').value='$lagerbezeichnung'\";>$lagerbezeichnung</b> (Standardlager)");
          } else {
            $this->app->Tpl->Set('LAGERBEZEICHNUNG',"<b onclick=\"document.getElementById('regal').value='$lagerbezeichnung'\";>$lagerbezeichnung</b>");

          }

          $this->app->Tpl->Set('REGALVALUE',$this->app->Secure->GetPOST("regal"));

          $this->app->Tpl->Parse('ZWISCHENLAGERINFO', 'lager_regal.tpl');
        } else {

          //falsche artikelnummer	
          $nummer = "";
          $this->app->Tpl->Set('MSGARTIKEL', "<br>Jetzt Artikel abscannen!");
          $this->app->Tpl->Set('ARTIKELSTYLE', "style=\"border: 2px solid red\"");
          $this->app->Tpl->Set('ZWISCHENLAGERINFO', '<script type="text/javascript">document.getElementById("nummer").focus();</script>');

        }

      } else {
        $this->app->Tpl->Set('ZWISCHENLAGERINFO', '<script type="text/javascript">document.getElementById("nummer").focus();</script>');
        if($artikel <=0)
        {
          $this->app->Tpl->Set('SHOWCHRSTART',"<!--");
          $this->app->Tpl->Set('SHOWCHREND',"-->");
          $this->app->Tpl->Set('SHOWMHDSTART',"<!--");
          $this->app->Tpl->Set('SHOWMHDEND',"-->");
          $this->app->Tpl->Set('SHOWSRNSTART',"<!--");
          $this->app->Tpl->Set('SHOWSRNEND',"-->");
        }


      }
    }
    $this->app->Tpl->Set('NAME', $name_de);
    if (!isset($_SESSION['woher']) || $_SESSION['woher'] == "") $_SESSION['woher'] = "Manuelle Lageranpassung";
    if ($_SESSION['woher'] == "Zwischenlager") $this->app->Tpl->Set('ZWISCHENLAGER', "selected");
    if ($_SESSION['woher'] == "Produktion") $this->app->Tpl->Set('PRODUKTION', "selected");
    if ($_SESSION['woher'] == "Manuelle Lageranpassung") $this->app->Tpl->Set('DIFFERENZ', "selected");
    if ($_SESSION['woher'] == "Umlagern") $this->app->Tpl->Set('UMLAGERN', "selected");
    $projekt = $_SESSION[projekt];

    if($cmd=="umlagern" && $this->app->Secure->GetPOST("menge")=="")
      $menge = $this->app->Secure->GetGET("menge");

    if($cmd=="umlagern" && $this->app->Secure->GetPOST("grund")=="")
      $grundreferenz = $this->app->erp->base64_url_decode($this->app->Secure->GetGET("grund"));

    $this->app->Tpl->Set('MENGE', $menge);
    $this->app->Tpl->Set('GRUNDREFERENZ', $grundreferenz);
    $this->app->Tpl->Set('NUMMER', $nummer);

    $this->app->Tpl->Set('VPE', $vpe);
    $pr_name = $this->app->DB->Select("SELECT CONCAT(abkuerzung) FROM projekt WHERE id='$projekt' LIMIT 1");
    $this->app->Tpl->Set('PROJEKT', $pr_name);//$this->app->erp->GetProjektSelect($projekt, &$color_selected));
    //$this->app->Tpl->Set(TABTEXT, "Einlagern");

    $this->app->Tpl->Parse('TAB1', "einlagern.tpl");
    $this->app->Tpl->Parse('PAGE', "tabview.tpl");
  }

  function LagerBuchenAuslagern() {
    $this->LagerBuchenMenu();
    $cmd = $this->app->Secure->GetGET("cmd");
    $action = $this->app->Secure->GetGET("action");


    $this->app->Tpl->Set('CMD',$cmd);
    $this->app->Tpl->Set('ACTION',$action);


    if($this->app->erp->Version()=="stock")
    {
      $this->app->Tpl->Set('STARTDISABLESTOCK', "<!--");
      $this->app->Tpl->Set('ENDEDISABLESTOCK', "-->");
    }


    session_start();
    if($cmd=="umlagern") {
      //$this->app->Tpl->Set(TABTEXT, "Auslagern");

      $this->app->Tpl->Set('STARTNICHTUMLAGERN', "<!--");
      $this->app->Tpl->Set('ENDENICHTUMLAGERN', "-->");

    }
    else {
      //$this->app->Tpl->Set(TABTEXT, "Auslagern");
      $this->app->Tpl->Set('STARTUMLAGERN', "<!--");
      $this->app->Tpl->Set('ENDEUMLAGERN', "-->");
    }

    $this->app->Tpl->Set('FOCUSFIELD','document.getElementById("nummer").focus();');
    $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Auslagern");
    // checken ob die daten passen
    $nummer = $this->app->Secure->GetPOST("nummer");
    $grund = $this->app->Secure->GetPOST("grund");
    $grundreferenz = $this->app->Secure->GetPOST("grundreferenz");
    $adresse = $this->app->Secure->GetPOST("adresse");
    $projekt = $this->app->Secure->GetPOST("projekt");
    $menge = $this->app->Secure->GetPOST("menge");
    $submit = $this->app->Secure->GetPOST("submit");
    $artikelid = $this->app->Secure->GetGET("artikelid");
    $regal = $this->app->Secure->GetPOST("regal");
    $regalneu = $this->app->Secure->GetPOST("regalneu");
    if ($menge == "" || $menge == "0") $menge = 1;
    //session_close();


    if($projekt!="")
      $_SESSION[projekt] = $projekt;

    $projekt= $_SESSION[projekt];

    //	$nummer = explode(' ', $nummer);
    //		$nummer = $nummer[0];

    if ($this->app->Secure->GetPOST("nummer") != "" || $artikelid > 0) {
      $nummer = $this->app->Secure->GetPOST("nummer");
      $nummer = explode(' ', $nummer);
      $nummer = $nummer[0];

      if($artikelid > 0){
        $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikelid' LIMIT 1");
        $checkartikel = $this->app->DB->Select("SELECT id FROM artikel WHERE id='$artikelid' LIMIT 1");
        $artikel = $artikelid;
        $submit="1";
        $this->app->Tpl->Set('NUMMER', $nummer);
      }
    }

    $projekt = explode(' ', $projekt);
    $projekt = $projekt[0];

    $regal_id = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$regal' AND kurzbezeichnung!='' LIMIT 1");
    if(is_numeric($regal_id))
      $regal = $regal_id;

    $regalneu_id = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$regalneu' AND kurzbezeichnung!='' LIMIT 1");
    if(is_numeric($regalneu_id))
      $regalneu = $regalneu_id;


    if ($submit != "") {
      //projekt pruefen

      $checkprojekt = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
      $projektid = $this->app->DB->Select("SELECT id FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
      if ($projekt == "" || $checkprojekt != $projekt) {
        //$error++;
        //$this->app->Tpl->Set(MSGPROJEKT,"<font color=\"red\">Projekt gibt es nicht!</font>");
        $projektid = $this->app->DB->Select("SELECT standardprojekt  FROM firma WHERE id='" . $this->app->User->GetFirma() . "' LIMIT 1");
      }

      //adresse pruefen
      $adressearray = split(' ', $adresse);
      $checkadresse = $this->app->DB->Select("SELECT id FROM adresse WHERE id='{$adressearray[0]}' LIMIT 1");
      $checkname = $this->app->DB->Select("SELECT name FROM adresse WHERE id='{$adressearray[0]}' LIMIT 1");

      /*
         if (!is_numeric($adressearray[0]) || $adressearray[0] != $checkadresse) {
         $error++;
         $this->app->Tpl->Set('MESSAGE', "<div class=\"error\">Bitte eine g&uuml;ltige Adresse angeben!</div>");
         }
       */

      if (!is_numeric($menge) || $menge == 0) {
        $error++;
        $this->app->Tpl->Set(MSGMENGE, "<font color=\"red\">Wert ist keine Zahl oder Null.</font>");
      }
      $ean = $this->app->DB->Select("SELECT id FROM artikel WHERE ean='$nummer' AND ean!='' AND geloescht!=1 LIMIT 1");
      $artikel_tmp = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='$nummer' AND geloescht!=1 LIMIT 1");
      if($artikel_tmp <=0 && $ean > 0)
      {
        $artikel_tmp = $ean;
        $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$ean' LIMIT 1");
      }

      $checkartikel = $this->app->DB->Select("SELECT nummer FROM artikel WHERE nummer='{$nummer}' AND geloescht!=1 LIMIT 1");
      $artikel = $this->app->DB->Select("SELECT id FROM artikel WHERE nummer='{$nummer}' AND geloescht!=1 LIMIT 1");
      $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE nummer='{$nummer}' AND geloescht!=1 LIMIT 1");
      $seriennummer = $this->app->DB->Select("SELECT seriennummer FROM artikel WHERE nummer='{$nummer}' AND geloescht!=1 LIMIT 1");

      if ($nummer != $checkartikel && ($nummer!=""||$nummer!=0)) {
        $error++;
        $this->app->Tpl->Set('MESSAGE', "<div class=\"error\">Diese Artikelnummer gibt es nicht!</div>");
        $nummer = "";

      }
      //z.B. es liegen 1 1 5 und man will 6 haben
      $checkregal = $this->app->DB->Select("SELECT id FROM lager_platz WHERE id='$regal' LIMIT 1");
      $checkregalneu = $this->app->DB->Select("SELECT id FROM lager_platz WHERE id='$regalneu' LIMIT 1");
      if (($regal != "" && $checkregal == $regal) && $error == 0) {
        //regal gibt schon mal liegt jetzt der artikel noch in diesem regal?
        $summe = $this->app->DB->Select("SELECT SUM(menge) FROM lager_platz_inhalt WHERE lager_platz='$regal' AND artikel='$artikel'");
        if ($summe <= 0) {
          $this->app->Tpl->Set('MESSAGELAGER', "<div class=\"error\">Artikel gibt es in diesem Regal nicht!</div>");
        } else if ($summe < $menge) {
          $this->app->Tpl->Set('MESSAGELAGER', "<div class=\"error\">Zu wenig Artikel im Regal! Bitte kleinere Menge w&auml;hlen! (Summe: $summe)</div>");
        } else {
          // zeige alle in dem Lager an sortiert nach MHD
          $tmpsrn = false;
          $tmpsrn = $this->app->DB->SelectArr("SELECT * FROM lager_seriennummern WHERE 
              lager_platz='$regal' AND artikel='$artikel' ORDER by mhddatum");
          $tmpmhd = $this->app->DB->SelectArr("SELECT * FROM lager_mindesthaltbarkeitsdatum WHERE 
              lager_platz='$regal' AND artikel='$artikel' ORDER by mhddatum");

          $tmpcharge = $this->app->DB->SelectArr("SELECT * FROM lager_charge WHERE 
              lager_platz='$regal' AND artikel='$artikel' ORDER by id");

          if(count($tmpsrn) > 0)  { 
            $this->app->Tpl->Add('SRNINFO',"<tr><td></td><td>MHD</td><td>Seriennummer</td><td>Charge</td></tr>");
          } else if (count($tmpmhd) > 0) {
            $this->app->Tpl->Add('SRNINFO',"<tr><td></td><td>Mindesthalt.</td><td width=30></td><td>Charge</td></tr>");
          } else if (count($tmpcharge) > 0) {
            $this->app->Tpl->Add('SRNINFO',"<tr><td></td><td>Charge</td></tr>");
          }

          $check_seriennummer = $this->app->DB->Select("SELECT seriennummern FROM artikel WHERE id='$artikel' LIMIT 1");
          $check_charge = $this->app->DB->Select("SELECT chargenverwaltung FROM artikel WHERE id='$artikel' LIMIT 1");
          $check_mhd = $this->app->DB->Select("SELECT mindesthaltbarkeitsdatum FROM artikel WHERE id='$artikel' LIMIT 1");
          $regaltreffer="1";

          if($check_seriennummer=="vomprodukteinlagern")
          {
            for($y=0;$y<count($tmpsrn);$y++)
            {
              $regaltreffer="1";
              if($y < $menge) $checked="checked"; else $checked="";

              if($tmpsrn[$y]['mhddatum']=="") $tmpsrn[$y]['mhddatum'] = " - "; else $tmpsrn[$y]['mhddatum'] = $this->app->String->Convert($tmpsrn[$y]['mhddatum'],"%1-%2-%3","%3.%2.%1");
              if($tmpsrn[$y]['seriennummer']=="") $tmpsrn[$y]['seriennummer'] = " - ";
              if($tmpsrn[$y]['charge']=="") $tmpsrn[$y]['charge'] = " - ";

              $this->app->Tpl->Add('SRNINFO',"<tr>
                  <td><input type=\"checkbox\" onclick=\"countChecks(this)\" name=\"lager_srn_id[]\" value=\"".$tmpsrn[$y]['id']."\" $checked>&nbsp;$out</td>
                  <td>".$tmpsrn[$y]['mhddatum']."</td>
                  <td>".$tmpsrn[$y]['seriennummer']."</td>
                  <td>".$tmpsrn[$y]['charge']."</td></tr>");
            }
          } else if ($check_mhd=="1")
          {
            for($y=0;$y<count($tmpmhd);$y++)
            {
              $regaltreffer="1";
              if($y < $menge) $checked="checked"; else $checked="";

              if($tmpmhd[$y]['mhddatum']=="") $tmpmhd[$y]['mhddatum'] = " - "; else $tmpmhd[$y]['mhddatum'] = $this->app->String->Convert($tmpmhd[$y]['mhddatum'],"%1-%2-%3","%3.%2.%1");
              if($tmpmhd[$y]['charge']=="") $tmpmhd[$y]['charge'] = " - ";

              $this->app->Tpl->Add('SRNINFO',"<tr>
                  <td><input type=\"checkbox\" onclick=\"countChecks(this)\" name=\"lager_mhd_id[]\" value=\"".$tmpmhd[$y]['id']."\" $checked>&nbsp;$out</td>
                  <td>".$tmpmhd[$y]['mhddatum']."</td><td></td>
                  <td>".$tmpmhd[$y]['charge']."</td></tr>");
            }


          } else if ($check_charge=="2")
          {
            for($y=0;$y<count($tmpcharge);$y++)
            {
              $regaltreffer="1";
              if($y < $menge) $checked="checked"; else $checked="";

              if($tmpcharge[$y]['charge']=="") $tmpcharge[$y]['charge'] = " - ";

              $this->app->Tpl->Add('SRNINFO',"<tr>
                  <td><input type=\"checkbox\" onclick=\"countChecks(this)\" name=\"lager_charge_id[]\" value=\"".$tmpcharge[$y]['id']."\" $checked>&nbsp;$out</td>
                  <td>".$tmpmhd[$y]['charge']."</td></tr>");
            }
          }

          //$regaltreffer="1";

          $this->app->Tpl->Add('ZWISCHENLAGERINFO',"<input type=\"hidden\" name=\"abschluss_auslagern\" value=\"1\">");

          $allow = 0;

          if($check_seriennummer!="keine" || $check_charge=="2" || $check_mhd=="1")
          {
            if($this->app->Secure->GetPOST("abschluss_auslagern")=="1")
              $allow=1;
          } else $allow=1;

          if($cmd=="umlagern" && $regal  > 0 && $checkregalneu!=$regalneu) { $allow=0; }
          if($cmd=="umlagern" && $regalneu =="" ) { $allow=0; }


          if($allow){
            $lager_srn_id = $this->app->Secure->GetPOST("lager_srn_id");

            $lager_mhd_id = $this->app->Secure->GetPOST("lager_mhd_id");
            for($q=0;$q<count($lager_mhd_id);$q++){
              $passende_charge = $this->app->DB->Select("SELECT charge FROM lager_mindesthaltbarkeitsdatum WHERE id='".$lager_mhd_id[$q]."' LIMIT 1");
              $passende_mhd = $this->app->DB->Select("SELECT mhddatum FROM lager_mindesthaltbarkeitsdatum WHERE id='".$lager_mhd_id[$q]."' LIMIT 1");
              $passende_lager_platz = $this->app->DB->Select("SELECT lager_platz FROM lager_mindesthaltbarkeitsdatum WHERE id='".$lager_mhd_id[$q]."' LIMIT 1");
              $passende_artikel = $this->app->DB->Select("SELECT artikel FROM lager_mindesthaltbarkeitsdatum WHERE id='".$lager_mhd_id[$q]."' LIMIT 1");
              $this->app->DB->Delete("DELETE FROM lager_mindesthaltbarkeitsdatum WHERE id='".$lager_mhd_id[$q]."' LIMIT 1");
              $this->app->DB->Delete("DELETE FROM lager_charge WHERE charge='".$passende_charge."' 
                  AND lager_platz='$passende_lager_platz' AND artikel='$passende_artikel' LIMIT 1");
              // umlagern3
              if($cmd=="umlagern")
                $this->app->erp->AddMindesthaltbarkeitsdatumLagerOhneBewegung($passende_artikel,1,$regalneu,$passende_mhd,$passende_charge);
            }

            $lager_charge_id = $this->app->Secure->GetPOST("lager_charge_id");
            for($q=0;$q<count($lager_charge_id);$q++){
              $passende_artikel = $this->app->DB->Select("SELECT artikel FROM lager_charge WHERE id='".$lager_charge_id[$q]."' LIMIT 1");
              $passende_datum = $this->app->DB->Select("SELECT datum FROM lager_charge WHERE id='".$lager_charge_id[$q]."' LIMIT 1");
              $passende_charge = $this->app->DB->Select("SELECT charge FROM lager_charge WHERE id='".$lager_charge_id[$q]."' LIMIT 1");
              $this->app->DB->Delete("DELETE FROM lager_charge WHERE id='".$lager_charge_id[$q]."' LIMIT 1");
              //umlagern3
              if($cmd=="umlagern")
                $this->app->erp->AddChargeLagerOhneBewegung($passende_artikel,1,$regalneu,$passende_datum,$passende_charge);
            }

            if($seriennummer!="") $tmp_sn = " SN:".$seriennummer; else $tmp_sn = "";

            $bestand = $this->app->erp->ArtikelImLager($artikel);

            if($grundreferenz!=""){
              $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz,artikel,menge,vpe,eingang,zeit,referenz,bearbeiter,projekt,firma,adresse,bestand)
                  VALUES('','$regal','$artikel','$menge','einzeln','0',NOW(),'$grund f&uuml; $checkname: $grundreferenz $tmp_sn',
                    '" . $this->app->User->GetName() . "','$projektid','" . $this->app->User->GetFirma() . "','$checkadresse','$bestand')");
            } else {
              $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz,artikel,menge,vpe,eingang,zeit,referenz,bearbeiter,projekt,firma,adresse,bestand)
                  VALUES('','$regal','$artikel','$menge','einzeln','0',NOW(),'$grund $checkname $tmp_sn',
                    '" . $this->app->User->GetName() . "','$projektid','" . $this->app->User->GetFirma() . "','$checkadresse','$bestand')");
            }


            // umlagern3 lager_bewegung buchen

            // wenn enticklung auf mitarbeiter buchen
            if ($grund == "Entwicklungsmuster") {
              $this->app->DB->Insert("INSERT INTO projekt_inventar (id,artikel,menge,bestellung, projekt,   
                adresse,	mitarbeiter,   vpe,zeit) VALUES ('','$artikel','$menge','','$projekt','$adresse','" . $this->app->User->GetName() . "', 'einzeln',NOW())");
            }
            //ziehe menge ab von lager_platz_inhalt
            $tmpcheck = $this->app->DB->Select("SELECT id FROM lager_platz_inhalt WHERE lager_platz='$regal' AND artikel='$artikel' AND menge >='$menge' LIMIT 1");
            // wenn es ein lager mit genug gibt nimm dieses
            if ($tmpcheck > 0) {
              $summezumchecken = $this->app->DB->Select("SELECT menge FROM lager_platz_inhalt WHERE id='$tmpcheck' LIMIT 1");
              $summezumcheckenneu = $summezumchecken - $menge;
              if ($summezumcheckenneu <= 0) $this->app->DB->Delete("DELETE FROM lager_platz_inhalt WHERE id='$tmpcheck' LIMIT 1");
              else $this->app->DB->Update("UPDATE lager_platz_inhalt SET menge='$summezumcheckenneu' WHERE id='$tmpcheck' LIMIT 1");
            } else {
              // lager solange aus bis genug ausgelagert sind
              $nochoffen = $menge;
              while ($nochoffen > 0) {
                $tmpcheck = $this->app->DB->Select("SELECT id FROM lager_platz_inhalt WHERE lager_platz='$regal' AND artikel='$artikel' LIMIT 1");
                $tmpcheckmenge = $this->app->DB->Select("SELECT menge FROM lager_platz_inhalt WHERE id='$tmpcheck' LIMIT 1");
                if ($tmpcheckmenge <= $nochoffen) {
                  $this->app->DB->Delete("DELETE FROM lager_platz_inhalt WHERE id='$tmpcheck' LIMIT 1");
                  $nochoffen = $nochoffen - $tmpcheckmenge;
                } else {
                  $summezumcheckenneu = $tempcheckmenge - $nochoffen;
                  if($summezumcheckenneu > 0)
                  {
                    $this->app->DB->Update("UPDATE lager_platz_inhalt SET menge='$summezumcheckenneu' WHERE id='$tmpcheck' LIMIT 1");
                  }
                  $nochoffen = 0;
                }
              }
            }
            // umlagern3 in lager_platz_inhalt buchen
            if($cmd=="umlagern")
              $this->app->erp->LagerEinlagernDifferenz($artikel,$menge,$regalneu,$projekt,"Umlagern");

            if($artikelid > 0)
            {
              header("Location: index.php?module=artikel&action=lager&id=$artikelid");
            } else {
              $name = $this->app->DB->Select("SELECT CONCAT(nummer,' ',name_de) FROM artikel WHERE id='$artikel' LIMIT 1");
              $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Der Artikel $name wurde umgelagert. Der n&auml;chste Artikel kann jetzt umgelagert werden.</div>");
              if($cmd=="umlagern")
                header("Location: index.php?module=lager&action=buchenauslagern&cmd=umlagern&msg=$msg");
              else
                header("Location: index.php?module=lager&action=buchenauslagern");
            }
            exit;
          } // ende allow
          if ($regalneu != "" && $regal > 0 && $cmd=="umlagern") {
            $msgregal = "Dieses Regal gibt es nicht!";
            $this->app->Tpl->Set('MESSAGELAGER', "<div class=\"error\">$msgregal</div>");
            $regalcheck = 0;
          }

          // ende auslagern
        }
      } else {
        //$error++;
        if ($regal != "") {
          $msgregal = "Dieses Regal gibt es nicht!";
          $this->app->Tpl->Set('MESSAGELAGER', "<div class=\"error\">$msgregal</div>");
          $regalcheck = 0;
        }





      }
      if ($error == 0 && $regalcheck == 0) {
        $standardbild = $this->app->DB->Select("SELECT standardbild FROM artikel WHERE id='$artikel' LIMIT 1");
        if ($standardbild == "") $standardbild = $this->app->DB->Select("SELECT datei FROM datei_stichwoerter WHERE subjekt='Shopbild' AND objekt='Artikel' AND parameter='$artikel' LIMIT 1");

        $this->app->Tpl->Add('BEZEICHNUNG', "<tr valign=\"top\"><td>Aktueller Artikel:</td><td>$name_de</td></tr>"); //BENE
        if ($standardbild > 0) $this->app->Tpl->Add('BEZEICHNUNG', "<tr valign=\"top\"><td>Bild:</td><td align=\"center\"><img src=\"index.php?module=dateien&action=send&id=$standardbild\" width=\"110\"></td></tr>");

        $lagermeist = $this->app->DB->SelectArr("SELECT lager_platz, SUM(menge) FROM lager_platz_inhalt WHERE artikel='$artikel' GROUP BY lager_platz ORDER by 2 DESC LIMIT 1");
        $lagerbezeichnung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='{$lagermeist[0]['lager_platz']}' LIMIT 1");

        $standard_lagerplatz = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='$artikel' LIMIT 1");
        $standard_lagerbezeichnung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$standard_lagerplatz' LIMIT 1");

        if($lagerbezeichnung!=$standard_lagerbezeichnung && $standard_lagerbezeichnung!="")
          $standardlageranzeigen = "<b onclick=\"document.getElementById('regal').value='$standard_lagerbezeichnung'\";>$standard_lagerbezeichnung</b> (Standardlager)";

        //echo "huhuh $cmd regal $regal regalvalue $regalvalue checkregal $checkregal regaltreffer $regaltreffer";
        if($regaltreffer=="1") $regalvalue=$this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$regal' LIMIT 1"); else $regalvalue="";
        //if($regal !="" && $regalvalue=="") $regalvalue=$regal;
        if($regalvalue!="" && $cmd=="umlagern" && $regal > 0 && $regal==$checkregal)
        {
          if($this->app->erp->Version()!="stock")
          {
            $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr ><td>Regalvorschlag:</td><td align=\"left\"><input type=\"button\"  onclick=\"document.getElementById('regal').value='$regalvalue'\"; value=\"$regalvalue\"></td></tr>");
          }
          $this->app->Tpl->Set('FOCUSFIELD','document.getElementById("regal").focus();');
          $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr valign=\"top\"><td><b>Zielregal:</b></td><td align=\"left\"><input type=\"text\" style=\"width:200px;border: 2px solid red\" name=\"regalneu\" id=\"regal\" value=\"\"><br>Jetzt Regal abscannen!<script type=\"text/javascript\">document.getElementById('menge').style.backgroundColor='#ececec'; document.getElementById('nummer').style.backgroundColor='#ececec'; document.getElementById('grundreferenz').style.backgroundColor='#ececec';
              document.getElementById('grundreferenz').readOnly=true;
              document.getElementById('menge').readOnly=true;
              document.getElementById('nummer').readOnly=true;
              </script>
              <input type=\"hidden\" name=\"regal\" value=\"$regalvalue\"></td></tr>");
        } else {
          if($this->app->erp->Version()=="stock")
          {
            if($this->app->Secure->GetPOST("regal")=="" && $this->app->Secure->GetGET("regal")=="") //TODO
              $regalvalue = $lagerbezeichnung; //TODO
            $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr ><td>Regalvorschlag:</td><td align=\"left\"><input type=\"button\" onclick=\"document.getElementById('regal').value='$lagerbezeichnung'\" value=\"$lagerbezeichnung\" > (Standardlager)<br>$standardlageranzeigen</td></tr>");
          }
          else {

            $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr ><td>Regalvorschlag:</td><td align=\"left\"><input type=\"button\" onclick=\"document.getElementById('regal').value='$lagerbezeichnung'\" value=\"$lagerbezeichnung\" > (aktuell am meisten im Lager)<br>$standardlageranzeigen</td></tr>");
          }

          if($lagerbezeichnung!="" && $regalvaluestock=="" && $regal!="")$regalvaluestock=$lagerbezeichnung;
          $this->app->Tpl->Add('ZWISCHENLAGERINFO', "<tr valign=\"top\"><td><b>Entnahmeregal:</b></td><td align=\"left\"><input type=\"text\" style=\"width:200px;border: 2px solid red;\" name=\"regal\" id=\"regal\" value=\"$regalvaluestock\"><br>Jetzt Regal abscannen!</td></tr>");
          $this->app->Tpl->Set('FOCUSFIELD','document.getElementById("regal").focus();');
        }
        // letzt einstellung von grad
        $this->app->Tpl->Add('ZWISCHENLAGERINFO', '<script type="text/javascript">
            document.getElementById("regal").focus();
            </script>');
      } else if ($error == 0) {
        echo "speichern adresse $checkadresse projekt $projekt menge $menge";
      }
    }
    if ($nummer == "") $this->app->Tpl->Set('ARTIKELSTYLE', "style=\"border: 2px solid red\"");

    $this->app->Tpl->Set('MENGE', $menge);
    $this->app->Tpl->Set('GRUNDREFERENZ', $grundreferenz);

    $art_name = $this->app->DB->Select("SELECT CONCAT(nummer) FROM artikel WHERE nummer='$nummer' AND geloescht!=1 LIMIT 1");
    $this->app->Tpl->Set('NUMMER', $art_name);

    $pr_name = $this->app->DB->Select("SELECT CONCAT(abkuerzung) FROM projekt WHERE abkuerzung='$projekt' LIMIT 1");
    $this->app->Tpl->Set('ADRESSE', $adresse);
    if ($_SESSION['grund'] == "Interner Entwicklungsbedarf") $this->app->Tpl->Set('MUSTER', "selected");
    if ($_SESSION['grund'] == "RMA / Reparatur / Reklamation") $this->app->Tpl->Set('RMA', "selected");
    if ($_SESSION['grund'] == "Alte Bestellung") $this->app->Tpl->Set('ALTE', "selected");
    if ($_SESSION['grund'] == "Kundenauftrag / Produktion") $this->app->Tpl->Set('PRODUKTION', "selected");
    if ($_SESSION['grund'] == "Manuelle Lageranpassung") $this->app->Tpl->Set('DIFFERENZ', "selected");
    if ($_SESSION['grund'] == "Umlagern") $this->app->Tpl->Set('UMLAGERN', "selected");
    //$this->app->YUI->AutoComplete(PROJEKTAUTO,"projekt",array('name','abkuerzung'),"abkuerzung");
    $this->app->YUI->AutoComplete("projekt", "projektname", 1);
    $this->app->YUI->AutoComplete("adresse", "adresse");
    $this->app->YUI->AutoComplete('nummer','lagerartikelnummer');
    $this->app->YUI->AutoComplete('regal','lagerplatz');
    $this->app->YUI->AutoComplete('grundreferenz','lagergrund');
    //$this->app->YUI->AutoComplete(ADRESSEAUTO,"adresse",array('id','name','kundennummer'),"CONCAT(id,' ',name)");
    $this->app->Tpl->Set('PROJEKT', $pr_name);
    $this->app->Tpl->Parse('TAB1', "auslagern.tpl");
    $this->app->Tpl->Parse('PAGE', "tabview.tpl");
  }

  function LagerLetzteBewegungen()
  {
    $this->LagerBuchenMenu();

    $this->app->YUI->TableSearch('TAB1', "lagerletztebewegungen");	

    $this->app->Tpl->Parse('PAGE', "tabview.tpl");
  }	


  function LagerBuchenMenu() {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Lager");
    //$this->app->erp->MenuEintrag("index.php?module=lager&action=artikelfuerlieferungen&id=$id","Artikel f&uuml;r Lieferungen");
    if($this->app->erp->Version()=="stock")
    {
      //$this->app->erp->MenuEintrag("index.php?module=lager&action=buchenauslagern&cmd=umlagern&id=$id", "Lagerentnahme");
    }
    else
    {
      $this->app->erp->MenuEintrag("index.php?module=lager&action=buchenauslagern&cmd=umlagern&id=$id", "Umlagern");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=buchenauslagern&id=$id", "Auslagern");

      $this->app->erp->MenuEintrag("index.php?module=lager&action=bucheneinlagern&id=$id", "Einlagern");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=buchenzwischenlager&id=$id", "Zwischenlager");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=buchen", "Zur&uuml;ck zur &Uuml;bersicht");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=schnellauslagern", "Schnell-Auslagern");
    }
    $this->app->erp->MenuEintrag("index.php?module=lager&action=schnellumlagern", "Schnell-Umlagern");
    //    $this->app->erp->MenuEintrag("index.php?module=lager&action=schnelleinlagern", "Schnell-Einlagern");
    $this->app->erp->MenuEintrag("index.php?module=lager&action=letztebewegungen", "Letzte Bewegungen");
  }
  function LagerReservierungen() {
    $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Reservierungen");
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set('TABNAME', "Inhalt");
    $this->app->Tpl->Set('SUBSUBHEADING', "Reservierungen Stand " . date('d.m.Y'));
    // easy table mit arbeitspaketen YUI als template
    $table = new EasyTable($this->app);
    $table->Query("SELECT adr.name as kunde, a.name_de as Artikel,r.menge,p.abkuerzung as projekt,r.grund, r.id FROM lager_reserviert r LEFT JOIN artikel a ON a.id=r.artikel LEFT JOIN projekt p ON 
        p.id=r.projekt LEFT JOIN adresse adr ON r.adresse=adr.id WHERE r.firma='{$this->app->User->GetFirma() }'");
    $table->DisplayNew('INHALT', "<a href=\"#\" onclick=\"if(!confirm('Artikel aus Reservierungen nehmen?')) return false; else window.location.href='index.php?module=lager&action=artikelentfernenreserviert&reservierung=%value%';\"><img src=\"./themes/[THEME]/images/delete.gif\"></a>");
    $this->app->Tpl->Parse('TAB1', "rahmen70.tpl");
    $this->app->Tpl->Set('AKTIV_TAB1', "selected");
    $this->app->Tpl->Parse('PAGE', "tabeinzeln.tpl");
  }
  

  function LagerRegalEtiketten() {
    $id = $this->app->Secure->GetGET("id");
    $platz = $this->app->Secure->GetGET("platz");
    $cmd = $this->app->Secure->GetGET("cmd");

    if ($cmd=="all") $arr = $this->app->DB->SelectArr("SELECT id,kurzbezeichnung FROM lager_platz WHERE lager='$id'");
    else $arr = $this->app->DB->SelectArr("SELECT id,kurzbezeichnung FROM lager_platz WHERE id='$id' LIMIT 1");

    for ($i = 0;$i < count($arr);$i++) {
      //$arr[$i][kurzbezeichnung] = trim($arr[$i][kurzbezeichnung]);
      //$arr[$i][id] = str_pad($arr[$i][id], 7, '0', STR_PAD_LEFT);
      $this->app->erp->EtikettenDrucker("lagerplatz_klein",1,"lager_platz",$arr[$i]['id']);
    }
    $ref = $_SERVER['HTTP_REFERER'];
    header("Location: $ref");
    exit;

  }



  function LagerAuslagernProduktionbasiert()
  {
    $this->app->Tpl->Set('TABTEXT',"");
    $this->app->erp->MenuEintrag("index.php?module=lager&action=artikelfuerlieferungen&cmd=produktion","&Uuml;bersicht");
    // offene auslagerungen
    $result = $this->app->DB->SelectArr("SELECT r.parameter FROM lager_reserviert r LEFT JOIN produktion p ON p.id=r.parameter
        WHERE r.objekt='produktion' AND (p.status='abgeschlossen' OR p.status='gestartet') GROUP BY r.parameter");

    $gesamtanzahlartikel = 0;

    //TODO YUI Start  
 
    $this->app->Tpl->Set('TAB1', "<table border=0 width=100% class=\"display\">
        <tr><td><b>Produktion</b></td><td><b>Bezeichnung</b></td><td align=center><b>Auslagern</b></td></tr>");
    for ($w = 0;$w < count($result);$w++) {
      $produktion = $result[$w]['parameter'];

      $bezeichnung = $this->app->DB->Select("SELECT CONCAT(ar.name_de,' (',ar.nummer,')') FROM 
        produktion_position pos LEFT JOIN artikel ar ON ar.id=pos.artikel WHERE pos.produktion='$produktion' AND pos.explodiert=1 LIMIT 1");

          $nummer = $this->app->DB->Select("SELECT belegnr FROM produktion WHERE id='$produktion' LIMIT 1");
          $this->app->Tpl->Add('TAB1', "<tr><td>Produktion $nummer</td><td>$bezeichnung</td><td align=center><a href=\"index.php?module=lager&action=auslagernproduktion&id=$produktion&cmd=produktion\"><img src=\"./themes/[THEME]/images/forward.png\"></a></td></tr>");
          $artikellistesumm = $this->app->DB->SelectArr("SELECT DISTINCT artikel FROM lager_reserviert WHERE objekt='produktion' AND parameter='$produktion'");
          if (count($artikellistesumm) == 0) continue;
          $artikelliste = $this->app->DB->SelectArr("SELECT DISTINCT artikel FROM lager_reserviert WHERE objekt='produktion' AND parameter='$produktion'");

          $gesamtanzahlartikel  = $gesamtanzahlartikel + count($artikelliste);
     }
     $this->app->Tpl->Add('TAB1', "</table>");

    //TODO YUI Ende

          if ($gesamtanzahlartikel <= 0) {
          $this->app->Tpl->Set('MESSAGE', "<div class=\"info\">Aktuell gibt es keine Artikel f&uuml;r Produktionen, da keine offenen Produktionen vorhanden sind.</div>");
          $this->app->Tpl->Set('TAB1',"");
          }

          $this->app->Tpl->Parse('PAGE', "tabview.tpl");
  }


  function LagerAuslagernProjektbasiert()
  {
    $projekt = 1;
    $projektearr = $this->app->DB->SelectArr("SELECT id FROM projekt WHERE geloescht!=1");
    $projektearr[] = 0;
    $gesamtanzahlartikel = 0;
    // start projekt schleife
    for ($w = 0;$w < count($projektearr);$w++) {
      $this->app->Tpl->Set('INHALT', "");
      $projekt = $projektearr[$w]['id'];
      $projektName = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$projekt' LIMIT 1");
      if ($projekt == 0 || $projekt == "") $projektName = "Ohne Projekt";
      $artikellistesumm = $this->app->DB->SelectArr("SELECT DISTINCT artikel FROM lager_reserviert WHERE objekt='lieferschein' AND projekt='$projekt' AND firma='" . $this->app->User->GetFirma() . "'");

      if (count($artikellistesumm) == 0) continue;
      $this->app->Tpl->Add('INHALT', "<h2>$projektName Lieferungen Stand " . date('d.m.Y') . "</h2>");
      $artikelliste = $this->app->DB->SelectArr("SELECT DISTINCT artikel FROM lager_reserviert WHERE objekt='lieferschein' AND projekt='$projekt' AND firma='" . $this->app->User->GetFirma() . "'");
      $orderarray = $this->LagerAuslagernArtikelliste($artikelliste,$projekt,true);
      $gesamtanzahlartikel = count($orderarray);
      $this->LagerAuslagernArtikellisteRender($orderarray);
    } // ende projekt schleife
    if ($gesamtanzahlartikel <= 0) $this->app->Tpl->Set('MESSAGE', "<div class=\"info\">Aktuell gibt es keine Artikel f&uuml;r Lieferungen, da keine offenen Auftr&auml;ge im Autoversand sind.</div>");
    $this->app->Tpl->Parse('PAGE', "tabview.tpl");
  }



        function LagerReihenfolgeArtikelliste($artikelliste,$projekt="")
        {
        //$orderarray = $this->LagerAuslagernArtikelliste($artikelliste,$projekt,true);
        print_r($orderarray);
        for ($i = 0;$i < count($artikelliste);$i++) {
          $artikel = $artikelliste[$i]['artikel'];
          echo $artikel."<br>";
        }

        }

    function LagerAuslagernReihenfolge($artikelliste,$projekt="")
    { 
      return $artikelliste;
      // Reihenfolge abholen
      $orderarray = $this->LagerAuslagernArtikelliste($artikelliste,$projekt,true);
      for($i=0;$i<count($orderarray);$i++)
      { 
        $artikel = $orderarray[$i]["artikel"];
        $kurzbezeichnung = $orderarray[$i]["kurzbezeichnung"];
        $tmparray[$artikel]=$kurzbezeichnung;
      }
      echo "schritt 1<br>";
      print_r($orderarray);
      echo "<br>";
      echo "schritt 2<br>";
      print_r($tmparray);
      echo "<br>";
      echo "schritt 3<br>";

      // neu sortieren
      asort($tmparray);
      if(count($tmparray)>0)
      { 
        foreach($tmparray as $key=>$value)
        {
          $newartikelliste[]=array("artikel"=>$key);
        }
      }
      print_r($newartikelliste);
      return $newartikelliste;
    }
    //function LagerAuslagernList($artikelliste,$projekt="",$getorder=false)
    function LagerAuslagernArtikelliste($artikelliste,$projekt="",$getorder=false)
    {
      $cmd = $this->app->Secure->GetGET("cmd");

      $tmpanzahl = 0;

      for ($i = 0;$i < count($artikelliste);$i++) {
        $gesamtanzahlartikel++;
        $artikel = $artikelliste[$i]['artikel'];
        $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1");
        $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1");
        //wieviel stueck braucht man denn von dem artikel?

        if(is_numeric($projekt))
          $gesamtbedarf = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE objekt='lieferschein' AND projekt='$projekt' AND artikel='$artikel' AND firma='" . $this->app->User->GetFirma() . "'");
        else
          $gesamtbedarf = $this->app->DB->Select("SELECT SUM(menge) FROM lager_reserviert WHERE objekt='lieferschein' AND projekt='0' AND artikel='$artikel' AND firma='" . $this->app->User->GetFirma() . "'");

        //$artikel_in_regalen = $this->app->DB->SelectArr("SELECT * FROM lager_platz_inhalt WHERE artikel='$artikel' AND projekt='$projekt'");

        // standardlager artikel 
        $standardlagerartikel = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='$artikel'");
        // Zeige nur Artikel an die im Lager sind!

        $tmp_check_standardlager = $this->app->DB->Select("SELECT SUM(lpi.menge) FROM lager_platz_inhalt lpi LEFT JOIN lager_platz l ON l.id=lpi.lager_platz WHERE 
            lpi.artikel='$artikel' AND lpi.lager_platz='$standardlagerartikel' AND l.autolagersperre!='1' AND l.sperrlager!='1'");

        // erst standarlager ausraeumen bis zu wenig drin ist
        // und dann die lager an denene am wenigsten ist
        if($tmp_check_standardlager>=$gesamtbedarf)
          $artikel_in_regalen = $this->app->DB->SelectArr("SELECT * FROM lager_platz_inhalt lpi LEFT JOIN lager_platz l ON l.id=lpi.lager_platz WHERE 
              lpi.artikel='$artikel' AND lager_platz='$standardlagerartikel' AND l.autolagersperre!='1' AND l.sperrlager!='1' ORDER by lpi.menge ASC");
        else
          $artikel_in_regalen = $this->app->DB->SelectArr("SELECT * FROM lager_platz_inhalt lpi LEFT JOIN lager_platz l ON l.id=lpi.lager_platz WHERE 
              lpi.artikel='$artikel' AND l.autolagersperre!='1' AND l.sperrlager!='1' ORDER by lpi.menge ASC");

        for ($j = 0;$j < count($artikel_in_regalen);$j++) {
          $tmpanzahl++;
          $menge_im_platz = $artikel_in_regalen[$j]['menge'];
          $kurzbezeichnung = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='{$artikel_in_regalen[$j]['lager_platz']}' LIMIT 1");
          $lagerplatzid = $artikel_in_regalen[$j]['lager_platz'];

          if ($menge_im_platz <= $gesamtbedarf) {
            $tmpmenge = $menge_im_platz;
          } else {
            $tmpmenge = $gesamtbedarf;
          }
          $rest = $menge_im_platz - $tmpmenge; //$this->app->DB->Select("SELECT SUM(menge) FROM lager_platz_inhalt WHERE artikel='$artikel' AND firma='".$this->app->User->GetFirma()."'") - $tmpmenge;
          if ($rest == 0) $rest = "-";

          $orderarray[]=array("tmpmenge"=>$tmpmenge,"artikel"=>$artikel,"nummer"=>$nummer,"lager_platz"=>$lagerplatzid,"kurzbezeichnung"=>$kurzbezeichnung,"link_lagerplatzid"=>$artikel_in_regalen[$j][id],"link_lager"=>$lagerplatzid,"projekt"=>$projekt,"cmd"=>$cmd,"abkuerzung"=>$this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='$projekt' LIMIT 1"),'name_de'=>$name_de,"produktion"=>$produktion);

          $gesamtbedarf = $gesamtbedarf - $tmpmenge;
          if ($gesamtbedarf == 0) break;
        }
      }
      return $orderarray;
    }
    function LagerAuslagernArtikellisteRender($orderarray)
    {

      $array = $orderarray;
      $cols = array('kurzbezeichnung'=>SORT_ASC, 'nummer'=>SORT_ASC);

      $colarr = array();
      foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
      }
      $eval = 'array_multisort(';
          foreach ($cols as $col => $order) {
          $eval .= '$colarr[\''.$col.'\'],'.$order.',';
          }
          $eval = substr($eval,0,-1).');';
      eval($eval);
      $ret = array();
      foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
          $k = substr($k,1);
          if (!isset($ret[$k])) $ret[$k] = $array[$k];
          $ret[$k][$col] = $array[$k][$col];
        }
      }
      $orderarray = $ret;

      $htmltable = new HTMLTable(0, "100%", "", 3, 1);
      if ($this->app->User->GetType() == "admin") $htmltable->AddRowAsHeading(array('Menge', 'Nummer', 'Artikel', 'Projekt', 'Regal', 'Regal', 'Aktion'));//, 'Entfernen'));
      else $htmltable->AddRowAsHeading(array('Menge', 'Nummer', 'Artikel', 'Projekt', 'Regal', 'Regal', 'Aktion'));
      $htmltable->ChangingRowColors('#e0e0e0', '#fff');

      $tmpanzahl=1;
      foreach($orderarray as $row)
      {
        if ($tmpanzahl == 1 && $this->erstes!=1) { $this->erstes=1; $erstes = "erstes";}
        else $erstes = "";

        $tmpanzahl++;

        $htmltable->NewRow();

        $htmltable->AddCol($row['tmpmenge']);
        $htmltable->AddCol($row['nummer']);
        $htmltable->AddCol($row['name_de']);
        $htmltable->AddCol($row['abkuerzung']);
        $htmltable->AddCol($row['kurzbezeichnung']);

        $htmltable->AddCol("Regal: <input type=\"text\" size=\"10\" id=\"$erstes\"                 onchange=\"if(!confirm('Artikelnummer ".$row['nummer']." wurde ".$row['tmpmenge']." mal entnommen?')) return false; else window.location.href='index.php?module=lager&action=artikelfuerlieferungen&cmd=".$row['cmd']."&artikel=".$row['artikel']."&menge=".$row['tmpmenge']."&projekt=".$row['projekt']."&produktion=".$row['produktion']."&lagerplatzid=".$row['link_lagerplatzid']."&lager='+this.value;\">");            

        $htmltable->AddCol("<a href=\"#\" onclick=\"if(!confirm('Artikelnummer ".$row['nummer']." wurde ".$row['tmpmenge']." mal entnommen?')) return false; else window.location.href='index.php?module=lager&action=artikelfuerlieferungen&cmd=".$row['cmd']."&artikel=".$row['artikel']."&menge=".$row['tmpmenge']."&projekt=".$row['projekt']."&produktion=".$row['produktion']."&lagerplatzid=".$row['link_lagerplatzid']."&lager=".$row['link_lager']."';\"><img src=\"./themes/[THEME]/images/forward.png\"></a>");            

        //        if ($this->app->User->GetType() == "admin") $htmltable->AddCol("<a href=\"#\" onclick=\"if(!confirm('Artikel aus Lieferungen und Reservierungen nehmen?')) return false; else window.location.href='index.php?module=lager&action=artikelentfernen&produktion=".$row['produktion']."&projekt=".$row['projekt']."&artikel=".$row['artikel']."&cmd=".$row['cmd']."';\"><img src=\"./themes/[THEME]/images/delete.gif\"></a>");

      }
      //bestimme regalplaetze fuer artikel
      $this->app->Tpl->Add('INHALT', $htmltable->Get());
      // und enter abfangen!!!
      $this->app->Tpl->Add('INHALT', "<script type=\"text/javascript\">document.getElementById(\"erstes\").focus(); </script>");
      //$table->DisplayNew('INHALT', "<a href=\"index.php?module=lager&action=bucheneinlagern&cmd=zwischenlager&id=%value%\"><img border=\"0\" src=\"./themes/[THEME]/images/einlagern.png\"></a>");
      $this->app->Tpl->Parse('TAB1', "rahmen70_ohneform.tpl");

    }

    function LagerZwischenlager() {
      $this->app->Tpl->Add('TABS', "<li><h2>Zwischenlager</h2></li>");
      $id = $this->app->Secure->GetGET("id");
      $this->app->Tpl->Set('TABNAME', "Inhalt");
      $this->app->Tpl->Set('SUBSUBHEADING', "Zwischenlager Stand " . date('d.m.Y'));
      // easy table mit arbeitspaketen YUI als template
      $table = new EasyTable($this->app);
      $table->Query("SELECT a.name_de,z.menge,z.vpe,z.grund,z.richtung, p.abkuerzung, z.id FROM zwischenlager z LEFT JOIN artikel a ON a.id=z.artikel LEFT JOIN projekt p ON 
          p.id=z.projekt WHERE z.firma='{$this->app->User->GetFirma() }'");
      $table->DisplayNew('INHALT', "<a href=\"index.php?module=lager&action=bewegungpopup&frame=false&id=%value%\" 
          onclick=\"makeRequest(this);return false\">Info</a>");
      $this->app->Tpl->Parse('TAB1', "rahmen70.tpl");
      $this->app->Tpl->Set('AKTIV_TAB1', "selected");
      $this->app->Tpl->Parse('PAGE', "tabeinzeln.tpl");
    }
    function LagerBewegung() {
      $this->LagerMenu();
      $id = $this->app->Secure->GetGET("id");
      $this->app->Tpl->Set('TABNAME', "Lager Bewegungen");
      $lager = $this->app->DB->Select("SELECT bezeichnung FROM lager WHERE id='$id' ");
      $this->app->Tpl->Set('SUBSUBHEADING', "Bewegungen Lager: $lager bis zum " . date('d.m.Y'));
      // easy table mit arbeitspaketen YUI als template
      $table = new EasyTable($this->app);
      $table->Query("SELECT p.kurzbezeichnung as Regal, 
          p.id FROM lager_platz p 
          WHERE lager='$id' ORDER by 1");
      $table->DisplayNew('INHALT', "<a href=\"index.php?module=lager&action=bewegungpopup&frame=false&id=%value%\" 
          onclick=\"makeRequest(this);return false\">Info</a>");
      $this->app->Tpl->Parse('TAB1', "rahmen70.tpl");
      $this->app->Tpl->Set('AKTIV_TAB1', "selected");
      $this->app->Tpl->Parse('PAGE', "tabeinzeln.tpl");
    }
    function LagerBewegungPopup() {
      $id = $this->app->Secure->GetGET("id");

      $lager = $this->app->DB->Select("SELECT lager FROM lager_platz WHERE id='$id'");

      $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Lager Bewegungen");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=bewegung&id=$lager", "Zur&uuml;ck zur &Uuml;bersicht");

      $id = $this->app->Secure->GetGET("id");
      $this->app->Tpl->Set('TABNAME', "Lager Bewegungen");
      $lager = $this->app->DB->Select("SELECT l.bezeichnung FROM lager_platz p LEFT JOIN lager l ON p.lager=l.id WHERE p.id='$id'");
      $platz = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz p WHERE id='$id'");
      $this->app->Tpl->Set('SUBSUBHEADING', "Bewegungen Lager: $lager, Platz: $platz bis zum " . date('d.m.Y'));
      // easy table mit arbeitspaketen YUI als template
      $table = new EasyTable($this->app);
      $table->Query("SELECT p.kurzbezeichnung as Regal, a.nummer, a.name_de, i.menge, if(i.eingang,'Eingang','Ausgang') as Richtung, DATE_FORMAT(i.zeit,'%d.%m.%Y') as datum, i.referenz,
          i.id FROM lager_bewegung i LEFT JOIN lager_platz p ON p.id=i.lager_platz LEFT JOIN artikel a ON i.artikel=a.id
          WHERE p.id='$id' Order by i.zeit DESC");
      $table->DisplayNew('TAB1', "");/*"<a href=\"index.php?module=lager&action=platzeditpopup&frame=false&id=%value%\" 
                                     onclick=\"makeRequest(this);return false\">Info</a>");*/
      //$this->app->Tpl->Parse('PAGE', "rahmen70.tpl");
      $this->app->Tpl->Parse('PAGE', "tabeinzeln.tpl");
    }

    function LagerInhalt() {

      $this->LagerMenu();

      $id = $this->app->Secure->GetGET("id");
      $msg = $this->app->Secure->GetGET("msg");


      $this->app->Tpl->Set('TABNAME', "Lager Inventur-Liste");
      $lager = $this->app->DB->Select("SELECT bezeichnung FROM lager WHERE id='$id' ");

      $this->app->Tpl->Set('LAGERNAME', $lager);
      $this->app->Tpl->Set('ID', $id);
      $this->app->Tpl->Set('KURZUEBERSCHRIFT2', "$lager (Stand " . date('d.m.Y').")");
      $this->app->Tpl->Set('STAND', date('d.m.Y'));

      $this->app->YUI->AutoComplete('regal','lagerplatz');

      $regal = $this->app->Secure->GetPOST("regal");

      $table = new EasyTable($this->app);

      // wenn regal angeben dies als lager_platz nutzen
      if(is_numeric($regal))
      {
        // wenn lager kein buchstabe mit in der abkuerzung hat muss man gesondert pruefen ob die id eine abkuerzung ist, wenn das der fall ist dann diese verwenden
        $checklagerplatz = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$regal' ");
        if($checklagerplatz > 0)
          $lager_platz = $checklagerplatz;
        else
          $lager_platz = $regal;
      }
      else {
        if($regal!="")
          $lager_platz = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$regal' ");
      }

      //Hauptlager platz id
      $lager_platz_get = $this->app->Secure->GetGET("lager_platz");
      if($lager_platz_get!="")
      {
        $regal = $this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='$lager_platz_get'");
        $lager_platz = $lager_platz_get;
      }

      $this->app->Tpl->Set('LAGERPLATZID', $lager_platz);

      $this->app->Tpl->Set('REGAL', $regal);


      $lager_platz_inhalt = $this->app->Secure->GetPOST("lager_platz_inhalt");


      if($lager_platz > 0)
      {
        $this->app->Tpl->Set('LAGERPLATZ',$regal);
        $table->Query("SELECT p.kurzbezeichnung as regal, 
            LEFT(a.name_de,50) as artikel,
            a.nummer as nummer, pro.abkuerzung as projekt,
            i.menge as menge, SUM(r.menge) as reserviert
            FROM lager_platz p LEFT JOIN lager_platz_inhalt i ON p.id=i.lager_platz LEFT JOIN artikel a ON i.artikel=a.id
            LEFT JOIN lager_reserviert r ON r.artikel=a.id LEFT JOIN projekt pro ON pro.id=a.projekt
            WHERE p.id='$lager_platz' GROUP by p.kurzbezeichnung,a.nummer");
      } else {
        $table->Query("SELECT p.kurzbezeichnung as regal, 

            LEFT(a.name_de,50) as artikel,
            a.nummer as nummer, pro.abkuerzung as projekt,
            i.menge as menge, SUM(r.menge) as reserviert
            FROM lager_platz p LEFT JOIN lager_platz_inhalt i ON p.id=i.lager_platz LEFT JOIN artikel a ON i.artikel=a.id
            LEFT JOIN lager_reserviert r ON r.artikel=a.id LEFT JOIN projekt pro ON pro.id=a.projekt
            WHERE lager='$id' GROUP by p.kurzbezeichnung,a.nummer");
      }

      $table->DisplayNew('TAB1', "Reserviert","noAction");//<a href=\"index.php?module=artikel&action=lager&id=%value%\" target=\"_blank\">Lagerbestand</a>");
      // $this->app->Tpl->Parse('TAB1', "rahmen70.tpl");
      // $this->app->Tpl->Set('AKTIV_TAB1', "selected");
      // $this->app->Tpl->Parse('PAGE', "tabeinzeln.tpl");

      if($regal=="")
        $this->app->Tpl->Parse('PAGE', "lager_inhalt.tpl");
      else {
        $this->app->Tpl->Parse('PAGE', "lager_inhalt_regal.tpl");
      }


    }
    
    function LagerPlatz() {
      $this->LagerMenu();
      $id = $this->app->Secure->GetGET("id");
      // neues arbeitspaket


      $import = $this->app->Secure->GetPOST("import");
      if($import!="")
      {
        $lagerimport = $this->app->Secure->GetPOST("lagerimport");

        $lagerimport  = str_replace('\\r\\n',"\r\n",$lagerimport);
        $lagerimport = str_replace('"','',$lagerimport);
        $lagerimport = str_replace(' ','',$lagerimport);
        $tmp = split(',',$lagerimport);
        $neue=0;
        for($i=0;$i<count($tmp);$i++)
        {
          $lagerabkuerzung = $tmp[$i];
          // new line + spaces entfernen
          $lagerabkuerzung = trim(preg_replace('/\s+/', ' ', $lagerabkuerzung));

          $check = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$lagerabkuerzung' LIMIT 1");
          if($check <= 0)
          {
            // Anlegen
            $this->app->erp->CreateLagerplatz($id,$lagerabkuerzung);
            $neue++;
          }
        }

        $this->app->Tpl->Set('IMPORT',$lagerimport);

        if(count($tmp) > 0)
        {
          if($neue == 1)
            $this->app->Tpl->Set('MESSAGE3',"<div class=\"error2\">$neue Regal wurde neu angelegt!</div>");
          else if($neue > 1)
            $this->app->Tpl->Set('MESSAGE3',"<div class=\"error2\">$neue Lagerpl&auml;tze wurden neu angelegt!</div>");
          else
            $this->app->Tpl->Set('MESSAGE3',"<div class=\"error2\">Keine neuen Lagerpl&auml;tze angelegt! Alle bereits gefunden.</div>");
        }
        else
          $this->app->Tpl->Set('MESSAGE3',"<div class=\"error\">Es wurden keine Lagerpl&auml;tze angegeben!</div>");
      } 

      $speichern = $this->app->Secure->GetPOST("speichern");

      if($speichern!="")
      {

        $kurzbezeichnung = $this->app->Secure->GetPOST("kurzbezeichnung");
        $autolagersperre=$this->app->Secure->GetPOST("autolagersperre");
        $verbrauchslager=$this->app->Secure->GetPOST("verbrauchslager");
        $breite=$this->app->Secure->GetPOST("breite");
        $laenge=$this->app->Secure->GetPOST("laenge");
        $hoehe=$this->app->Secure->GetPOST("hoehe");
        $sperrlager=$this->app->Secure->GetPOST("sperrlager");
        $poslager=$this->app->Secure->GetPOST("poslager");

        $allowed = "/[^a-z0-9A-Z]/i";
        $kurzbezeichnung = preg_replace($allowed,"",$kurzbezeichnung);
        $kurzbezeichnung =  substr($kurzbezeichnung,0,15);



        $check = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$kurzbezeichnung' AND kurzbezeichnung!='' LIMIT 1");
        if($check<=0 && $kurzbezeichnung!="")
        {
          $breite = str_replace(",",".",$breite);
          $hoehe = str_replace(",",".",$hoehe);
          $laenge = str_replace(",",".",$laenge);


          $this->app->DB->Insert("INSERT INTO lager_platz (id,lager,kurzbezeichnung,autolagersperre,verbrauchslager,sperrlager,breite,laenge,hoehe,poslager)
              VALUES ('','$id','$kurzbezeichnung','$autolagersperre','$verbrauchslager','$sperrlager','$breite','$laenge','$hoehe','$poslager')");

          $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Das Regal wurde angelegt!</div>");
          header("Location: index.php?module=lager&action=platz&id=$id&msg=$msg");
          exit;
        } else {
          if($kurzbezeichnung=="")
            $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Das Regal wurde nicht angelegt! Bitte geben Sie einen Namen an!</div>");
          else
            $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Das Regal wurde nicht angelegt! Der Name existiert bereits in diesem oder einem anderem Lager. 
                Bitte einen anderen w&auml;hlen!</div>");
        }
      }

      $this->app->Tpl->Set('KURZBEZEICHNUNG',$kurzbezeichnung);
      if($autolagersperre=="1") $this->app->Tpl->Set('AUTOLAGERSPERRE',"checked");
      if($poslager=="1") $this->app->Tpl->Set('POSLAGER',"checked");
      if($verbrauchslager=="1") $this->app->Tpl->Set('VERBRAUCHSLAGER',"checked");
      if($sperrlager=="1") $this->app->Tpl->Set('SPERRLAGER',"checked");
      $this->app->Tpl->Parse('TAB2', "lager_platz.tpl");


      $this->app->Tpl->Set('SUBSUBHEADING', "Lagerpl&auml;tze");

      $this->app->YUI->TableSearch('TAB1', "lagerplatztabelle");

      $this->app->Tpl->Parse('PAGE', "lagerplatzuebersicht.tpl");
    }
    function LagerPlatzEditPopup() {
      $frame = $this->app->Secure->GetGET("frame");
      $id = $this->app->Secure->GetGET("id");
      // nach page inhalt des dialogs ausgeben
      //      $widget = new WidgetLager_platz($this->app,TAB1);
      $sid = $this->app->DB->Select("SELECT lager FROM lager_platz WHERE id='$id' LIMIT 1");

      //      $this->app->Tpl->Set('KURZUEBERSCHRIFT',"Lagerplatz bearbeiten");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=platz&id=$sid","zur&uuml;ck zur &Uuml;bersicht");

      $this->app->Tpl->Set('ABBRECHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=lager&action=platz&id=$sid';\">");
      //      $widget->form->SpecialActionAfterExecute("close_refresh", "index.php?module=lager&action=platz&id=$sid");
      //      $widget->Edit();

      $speichern = $this->app->Secure->GetPOST("speichern");

      if($speichern!="")
      {

        $kurzbezeichnung = $this->app->Secure->GetPOST("kurzbezeichnung");
        $autolagersperre=$this->app->Secure->GetPOST("autolagersperre");
        $verbrauchslager=$this->app->Secure->GetPOST("verbrauchslager");
        $sperrlager=$this->app->Secure->GetPOST("sperrlager");
        $poslager=$this->app->Secure->GetPOST("poslager");
        $breite=$this->app->Secure->GetPOST("breite");
        $laenge=$this->app->Secure->GetPOST("laenge");
        $hoehe=$this->app->Secure->GetPOST("hoehe");


        $allowed = "/[^a-z0-9A-Z\-]/i";
        $kurzbezeichnung = preg_replace($allowed,"",$kurzbezeichnung);
        $kurzbezeichnung =  substr($kurzbezeichnung,0,15);

        $check = $this->app->DB->Select("SELECT id FROM lager_platz WHERE kurzbezeichnung='$kurzbezeichnung' AND kurzbezeichnung!='' AND id!='$id' LIMIT 1");
        if($check<=0 && $kurzbezeichnung!="")
        {
          $breite = str_replace(",",".",$breite);
          $hoehe = str_replace(",",".",$hoehe);
          $laenge = str_replace(",",".",$laenge);

          $this->app->DB->Insert("UPDATE lager_platz 
              SET kurzbezeichnung='$kurzbezeichnung',autolagersperre='$autolagersperre',verbrauchslager='$verbrauchslager',sperrlager='$sperrlager',poslager='$poslager',
              breite='$breite',laenge='$laenge',hoehe='$hoehe' WHERE id='$id' LIMIT 1");

          $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Das Regal wurde ge&auml;ndert!</div>");
          header("Location: index.php?module=lager&action=platz&id=$sid&msg=$msg");
          exit;
        } else {
          if($kurzbezeichnung=="")
            $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Das Regal wurde nicht ge&auml;ndert! Bitte geben Sie einen Namen an!</div>");
          else
            $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Das Regal wurde nicht ge&auml;ndert! Der Name existiert in diesem oder einen anderem Lager bereits. Bitte einen anderen w&auml;hlen!</div>");
        }
        $this->app->Tpl->Set('KURZBEZEICHNUNG',$kurzbezeichnung);
        if($autolagersperre=="1") $this->app->Tpl->Set(AUTOLAGERSPERRE,"checked");
        if($verbrauchslager=="1") $this->app->Tpl->Set(VERBRAUCHSLAGER,"checked");
        if($sperrlager=="1") $this->app->Tpl->Set(SPERRLAGER,"checked");
        if($poslager=="1") $this->app->Tpl->Set(POSLAGER,"checked");

      } else {

        $tmp = $this->app->DB->SelectArr("SELECT * FROM lager_platz WHERE id='$id' LIMIT 1");
        $kurzbezeichnung = $tmp[0]['kurzbezeichnung'];
        $autolagersperre = $tmp[0]['autolagersperre'];
        $verbrauchslager = $tmp[0]['verbrauchslager'];

        $breite = $tmp[0]['breite'];
        $laenge = $tmp[0]['laenge'];
        $hoehe = $tmp[0]['hoehe'];

        $sperrlager = $tmp[0]['sperrlager'];
        $poslager = $tmp[0]['poslager'];

        $this->app->Tpl->Set('KURZBEZEICHNUNG',$kurzbezeichnung);

        $this->app->Tpl->Set('LAENGE',$laenge);
        $this->app->Tpl->Set('BREITE',$breite);
        $this->app->Tpl->Set('HOEHE',$hoehe);

        if($autolagersperre=="1") $this->app->Tpl->Set('AUTOLAGERSPERRE',"checked");
        if($verbrauchslager=="1") $this->app->Tpl->Set('VERBRAUCHSLAGER',"checked");
        if($sperrlager=="1") $this->app->Tpl->Set('SPERRLAGER',"checked");
        if($poslager=="1") $this->app->Tpl->Set('POSLAGER',"checked");
      }

      $this->app->Tpl->Parse('TAB1', "lager_platz.tpl");

      $this->app->Tpl->Set('TABNAME', "Regal");
      $this->app->Tpl->Parse('PAGE', "tabview.tpl");
    }

    function LagerCreate() {

      $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Lager anlegen");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=list", "Zur&uuml;ck zur &Uuml;bersicht");
      parent::LagerCreate();
    }

    function LagerHauptmenu() {
      //    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Lager&uuml;bersicht");
      //    $this->app->erp->MenuEintrag("index.php?module=lager&action=create","Neues Lager anlegen");
      //parent::LagerList();
      //$this->app->Tpl->Add(TABS,"<li><h2 class=\"allgemein\">Allgemein</h2></li>");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=list", "&Uuml;bersicht");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=create", "Neues Lager anlegen");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=wert", "Lagerbestandsberechnung");

      if($this->app->erp->Version()!="stock")
      {
        $this->app->erp->MenuEintrag("index.php?module=lager&action=differenzen", "Lager Differenzen");
        $this->app->erp->MenuEintrag("index.php?module=lager&action=differenzenlagerplatz", "Lagerplatz Differenzen");
        //$this->app->erp->MenuEintrag("index.php?module=artikel&action=lagerlampe", "Lagerlampen");
      }
      $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Lagerverwaltung");
    }


    function LagerDoppelteWarnung()
    {
      $check_double_lager = $this->app->DB->SelectArr("SELECT bezeichnung, COUNT(bezeichnung) AS NumOccurrences FROM lager WHERE geloescht!=1 GROUP BY bezeichnung HAVING ( COUNT(bezeichnung) > 1 )");    
      if(count($check_double_lager)>0)        
      {          
        for($icheck=0;$icheck<count($check_double_lager);$icheck++)            
          $bezeichnung .=" ".$check_double_lager[$icheck]['bezeichnung'];          
        if(trim($bezeichnung)=="") $belege="ohne Bezeichnung";          

        $gesamt_lager= count($check_double_lager);          
        $this->app->Tpl->Set('MESSAGE','<div class="error">Achtung! Doppelte Bezeichnungen: '.$bezeichnung.'</div>');      
        //$this->app->erp->InternesEvent($this->app->User->GetID(),'Achtung! Doppelte Bezeichnungen: '.$bezeichnung,"warning",0);
      }
    }

    function LagerList() {
      //    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Lager&uuml;bersicht");
      //    $this->app->erp->MenuEintrag("index.php?module=lager&action=create","Neues Lager anlegen");
      //parent::LagerList();
      //$this->app->Tpl->Add(TABS,"<li><h2 class=\"allgemein\">Allgemein</h2></li>");
      //doppelte namen suchen!
      $this->LagerHauptmenu();
      $this->LagerDoppelteWarnung();

      $this->app->YUI->TableSearch('TAB1', "lagertabelle");
      $this->app->Tpl->Parse('PAGE', "lageruebersicht.tpl");
    }


    function LagerMenu() {
      $id = $this->app->Secure->GetGET("id");
      $this->app->Tpl->Set('KURZUEBERSCHRIFT', "Lager");

      $bezeichnung = $this->app->DB->Select("SELECT bezeichnung FROM lager WHERE id='$id' LIMIT 1");

      $this->app->Tpl->Set('KURZUEBERSCHRIFT2', $bezeichnung);

      $this->app->erp->MenuEintrag("index.php?module=lager&action=edit&id=$id", "Details");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=platz&id=$id", "Regale");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=inhalt&id=$id", "Bestand");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=bewegung&id=$id", "Bewegungen");

     if($this->app->erp->RechteVorhanden("lagerinventur","bestand"))  
      $this->app->erp->MenuEintrag("index.php?module=lagerinventur&action=bestand&id=$id", "Inventur");

      //    $this->app->erp->MenuEintrag("index.php?module=lager&action=inventur&id=$id", "Inventur");
      $this->app->erp->MenuEintrag("index.php?module=lager&action=list", "Zur&uuml;ck zur &Uuml;bersicht");
    }
    function LagerEdit() {
      //$this->app->Tpl->Set(STEUERSATZOPTIONS,$this->app->erp->GetSelect($this->app->erp->GetSteuersatz(),$steuersatz);
      // aktiviere tab 1
      $this->app->Tpl->Set('AKTIV_TAB1', "selected");
      $this->app->Tpl->Set('ABBRECHEN',"<input type=\"button\" value=\"Abbrechen\" onclick=\"window.location.href='index.php?module=lager&action=list';\">");
      parent::LagerEdit();
      $this->LagerDoppelteWarnung();
      $this->LagerMenu();
    }
    function LagerEtiketten() {
      $id = $this->app->Secure->GetGET("id");
      $this->LagerMenu();
      $this->app->Tpl->Set('PAGE', "<br><br><br>Etiketten");
      /*
         $barcode = $this->app->DB->Select("SELECT barcode FROM lager WHERE id='{$id}' LIMIT 1");
         $nummer = $this->app->DB->Select("SELECT nummer FROM lager WHERE id='{$id}' LIMIT 1");

         $tmp = new etiketten(&$app);
         $tmp->Lager($barcode,$nummer,65);
         $tmp->Druck();
         exit;
       */
    }
}
?>
