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

class Wareneingang 
{

  function Wareneingang($app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("main","WareneingangMain");
    $this->app->ActionHandler("list","WareneingangList");
    $this->app->ActionHandler("help","WareneingangHelp");
    $this->app->ActionHandler("vorgang","VorgangAnlegen");
    $this->app->ActionHandler("removevorgang","VorgangEntfernen");
    $this->app->ActionHandler("create","WareneingangCreate");
    $this->app->ActionHandler("paketannahme","WareneingangPaketannahme");
    $this->app->ActionHandler("paketzustand","WareneingangPaketZustand");
    $this->app->ActionHandler("paketetikett","WareneingangPaketEtikett");
    $this->app->ActionHandler("paketabschliessen","WareneingangPaketAbschliessen");
    $this->app->ActionHandler("distriinhalt","WareneingangPaketDistriInhalt");
    $this->app->ActionHandler("distrietiketten","WareneingangPaketDistriEtiketten");
    $this->app->ActionHandler("distriabschluss","WareneingangPaketDistriAbschluss");
    $this->app->ActionHandler("manuellerfassen","WareneingangManuellErfassen");
    $this->app->ActionHandler("minidetail","WareneingangMiniDetail");
    $this->app->ActionHandler("stornieren","WareneingangStornieren");

    $this->app->DefaultActionHandler("login");

    $this->app->Tpl->Set('UEBERSCHRIFT'," Wareneingang");

    $this->app->ActionHandlerListen($app);
  }



  function WareneingangPaketMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set('ID',$id);
    $this->app->Tpl->Add('KURZUEBERSCHRIFT'," Paketannahme");
    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=paketannahme","Paketannahme");
  }

  function WareneingangPaketDistriMenu()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->app->Tpl->Set('ID',$id);
    $this->app->Tpl->Add('KURZUEBERSCHRIFT'," Paketdistribution");
    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=paketannahme","zur Paketannahme");
    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=distriinhalt","Paketannahme");
  }

  function WareneingangStornieren()
  {
    $id = $this->app->Secure->GetGET("id");

    if($id > 0 && is_numeric($id))
    {
      $this->app->DB->Delete("DELETE FROM paketannahme WHERE id='$id' LIMIT 1");
      header("Location: index.php?module=wareneingang&action=distribution");
      exit;
    }
  }


  function WareneingangMenu()
  {
    $this->app->Tpl->Add('KURZUEBERSCHRIFT'," Wareneingang");
    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=create","Paketannahme");
    //$this->app->erp->MenuEintrag("index.php?module=wareneingang&action=create\">Inhalt erfassen</a></li>");
    //$this->app->Tpl->Add(TABS,"<li><a href=\"index.php?module=wareneingang&action=create\">weitere Artikel erfassen</a></li>");
    //$this->app->Tpl->Add(TABS,"<li><a href=\"index.php?module=wareneingang&action=search\">Lieferung suchen</a></li>");
  }


  function WareneingangPaketDistriInhalt()
  {
    $id = $this->app->Secure->GetGET("id");
    $submit = $this->app->Secure->GetPOST("submit");
    $submitkunde = $this->app->Secure->GetPOST("submitkunde");

    $this->WareneingangPaketDistriMenu(); 

    if($submit!="")
    {
      $tmp = $this->app->Secure->GetPOST("pos"); 

      $pos = key($tmp);
      $menge = $tmp[$pos];

      if($menge<=0)
      {
        $this->app->Tpl->Set('TAB1',"<div class=\"error\">Bitte geben Sie eine Menge an!</div>");
      } else {
        header("Location: index.php?module=wareneingang&action=distrietiketten&id=$id&pos=$pos&menge=$menge");
        exit;
      }
    }


    $adresse= $this->app->DB->Select("SELECT adresse FROM paketannahme WHERE id='$id' LIMIT 1");

    // pruefe ob 
    $lieferant = $this->app->DB->Select("SELECT lieferantennummer FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
    $kunde= $this->app->DB->Select("SELECT kundennummer FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

    $name= $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");

    if($lieferant!="" && $lieferant!="0")
    {
      $this->app->Tpl->Set('TAB1TEXT','<li><a href="#tabs-1">Bestellungen</a></li>');
      $this->app->Tpl->Set('TAB1START',"<div id=\"tabs-1\">");
      $this->app->Tpl->Set('TAB1ENDE',"</div>");

      $this->app->Tpl->Add('TAB1',"<br><h1>Offene Artikel von Bestellungen an $name:</h1><br>");
      $this->app->YUI->TableSearch('TAB1',"wareneingang_lieferant");

      /*
         $table = new EasyTable($this->app);
         $table->Query("SELECT bp.bestellnummer, art.nummer, b.belegnr as `Bestellung`, CONCAT(LEFT(art.name_de,40),'<br>Bei Lieferant: ',LEFT(bp.bezeichnunglieferant,40)) as beschreibung, if(bp.lieferdatum,DATE_FORMAT(bp.lieferdatum,'%d.%m.%Y'),'sofort') as lieferdatum, p.abkuerzung as projekt, 
         bp.menge, bp.geliefert, bp.menge -  bp.geliefert as offen, bp.id FROM bestellung_position bp
         LEFT JOIN bestellung b ON bp.bestellung=b.id LEFT JOIN artikel art ON art.id=bp.artikel LEFT JOIN projekt p ON bp.projekt=p.id WHERE b.adresse='$adresse' AND b.belegnr > 0 
         AND bp.geliefert < bp.menge AND (bp.abgeschlossen IS NULL OR bp.abgeschlossen=0)  AND (b.status='versendet' OR b.status='freigegeben')");

         $table->DisplayNew(TAB1,"<form style=\"padding: 0px; margin: 0px;\" action=\"\" method=\"post\" name=\"eprooform\">Menge:&nbsp;<input type=\"text\" size=\"1\" name=\"pos[%value%]\">&nbsp;<input type=\"submit\" value=\"zuordnen\" name=\"submit\"></form>");
      //$this->app->Tpl->Add(TAB1,"<div class=\"info\">Es kann immer nur ein Artikel zugwiesen werden!</h1><br>");
       */
    } 



    if(!($kunde!="" && $kunde!="0") && !($lieferant!="" && $lieferant!="0"))
    {
      $this->app->Tpl->Set('TAB1',"<div class=\"error\">Die ausgew&auml;hlte Adresse hat noch keine Rolle Kunde oder Lieferant. Bitte vergeben Sie diese, dann sehen Sie Bestellungen oder versendete Waren.</div>");
    }



    $this->app->Tpl->Set('AKTIV_TAB2',"tabs-1");



    $this->app->Tpl->Parse('PAGE',"wareneingangpaketdistribution.tpl");

    $abschliessen = $this->app->Secure->GetPOST("abschliessen"); 
    if($abschliessen!="")
    {
      // paketannahme auf abgeschlossen setzten
      $this->app->DB->Update("UPDATE paketannahme SET status='abgeschlossen' WHERE id='$id' LIMIT 1");
      //      $typ = $this->app->DB->Update("SELECT typ FROM paketannahme WHERE id='$id' LIMIT 1");
      if($typ=="rma")
      {
        //RMA bericht drucken mit allen artikeln des Kunden


      }
      header("Location: index.php?module=wareneingang&action=paketannahme");
      exit;
    }

    $manuellerfassen = $this->app->Secure->GetPOST("manuellerfassen"); 
    if($manuellerfassen!="")
    {
      header("Location: index.php?module=wareneingang&action=manuellerfassen&id=$id");
      exit;
    }

    $this->app->Tpl->Add('PAGE',"<form action=\"\" method=\"post\"><br><br><center>
        <input type=\"submit\" name=\"manuellerfassen\" value=\"Artikel manuell erfassen\">&nbsp;
        <input type=\"submit\" name=\"abschliessen\" value=\"Paketinhalt ist jetzt komplett erfasst!\"></center></form><br><br>");

  }

  function WareneingangMiniDetail()
  {
    $id = $this->app->Secure->GetGET("id");
    header("Location: index.php?module=artikel&action=minidetail&id=$id");
    exit;
  }

  function WareneingangManuellErfassen()
  {
    $id = $this->app->Secure->GetGET("id");
    $paket = $this->app->Secure->GetGET("paket");
    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=distriinhalt&id=$id","Zur&uuml;ck zur &Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=manuellerfassen&id=$id","Artikel");

    $cmd = $this->app->Secure->GetGET("cmd");

    if($cmd=="add")
    {
      echo "huhuh";
    } else {
      $this->app->YUI->TableSearch('TAB1',"wareneingangartikelmanuellerfassen");
    }

    //$this->WareneingangPaketMenu();
    $this->app->Tpl->Parse('PAGE',"wareneingangpaketdistribution.tpl");
  }

  function WareneingangPaketDistriEtiketten()
  {
    $id = $this->app->Secure->GetGET("id");  
    $pos = $this->app->Secure->GetGET("pos");  
    $artikelnummer = $this->app->Secure->GetGET("artikelnummer");  
    $menge = $this->app->Secure->GetGET("menge");  
    $rma = $this->app->Secure->GetGET("rma");  

    $submit = $this->app->Secure->GetPOST("submit");  
    $lager = $this->app->Secure->GetPOST("lager");  
    $etiketten = $this->app->Secure->GetPOST("etiketten");  
    $anzahlauswahl = $this->app->Secure->GetPOST("anzahlauswahl");  
    $anzahl_fix = $this->app->Secure->GetPOST("anzahl_fix");  
    $anzahl_dyn = $this->app->Secure->GetPOST("anzahl_dyn");  
    $anzahl = $this->app->Secure->GetPOST("anzahl");  
    $bemerkung = $this->app->Secure->GetPOST("bemerkung");  
    $wunsch= $this->app->Secure->GetPOST("wunsch");  
    $cmd= $this->app->Secure->GetGET("cmd");  

    $this->app->Tpl->Set(ID,$id);

    if($cmd=="manuell"){
      $this->app->DB->Update("UPDATE artikel SET lagerartikel='1' WHERE id='$pos' AND juststueckliste!=1 LIMIT 1");
      $artikel = $pos;
      $this->app->Tpl->Set('ANZAHLAENDERN',"<input type=\"button\" value=\"&auml;ndern\" onclick=\"var menge =  prompt('Neue Menge:',$menge); if(menge > 0) window.location.href=document.URL + '&menge=' + menge;\">");
      $this->app->Tpl->Set('SHOWANZAHLSTART',"<!--"); //BENE war auskommentiert
      $this->app->Tpl->Set('SHOWANZAHLENDE',"-->"); //BENE war auskommentiert
    }
    else if($cmd=="manuell")
    {
      $artikel = $pos;
      $mitarbeiter = $this->app->User->GetName();
      $projekt = $this->app->DB->Select("SELECT projekt FROM artikel WHERE id='$artikel' LIMIT 1");
    }
    else 
    {
      //bestellung
      // bestellung findet man raus ueber pos (bestellung) 
      $artikel = $this->app->DB->Select("SELECT artikel FROM bestellung_position WHERE id='$pos' LIMIT 1");
      $projekt = $this->app->DB->Select("SELECT projekt FROM bestellung_position WHERE id='$pos' LIMIT 1");
      $bestellung = $this->app->DB->Select("SELECT bestellung FROM bestellung_position WHERE id='$pos' LIMIT 1");
      $vpe= $this->app->DB->Select("SELECT vpe FROM bestellung_position WHERE id='$pos' LIMIT 1");
      $menge_bestellung = $this->app->DB->Select("SELECT menge FROM bestellung_position WHERE id='$pos' LIMIT 1");
      $adresse = $this->app->DB->Select("SELECT adresse FROM paketannahme WHERE id='$id' LIMIT 1");
      $name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$adresse' AND geloescht=0 LIMIT 1");
      $mitarbeiter = $this->app->DB->Select("SELECT bearbeiter FROM bestellung WHERE id='$bestellung' LIMIT 1");
      $bestellung_belegnr = $this->app->DB->Select("SELECT belegnr FROM bestellung WHERE id='$bestellung' LIMIT 1");
    }
    $lagerartikel = $this->app->DB->Select("SELECT lagerartikel FROM artikel WHERE id='$artikel' LIMIT 1");
    $mindesthaltbarkeitsdatum = $this->app->DB->Select("SELECT mindesthaltbarkeitsdatum FROM artikel WHERE id='$artikel' LIMIT 1");
    $seriennummern = $this->app->DB->Select("SELECT seriennummern FROM artikel WHERE id='$artikel' LIMIT 1");
    $mitarbeiter_name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$mitarbeiter' AND geloescht=0 LIMIT 1");
    $artikelcheckliste = $this->app->DB->Select("SELECT artikelcheckliste FROM artikel WHERE id='$artikel' LIMIT 1");
    $funktionstest = $this->app->DB->Select("SELECT funktionstest FROM artikel WHERE id='$artikel' LIMIT 1");
    $endmontage = $this->app->DB->Select("SELECT endmontage FROM artikel WHERE id='$artikel' LIMIT 1");
    $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1");
    $nummer = $this->app->DB->Select("SELECT nummer FROM artikel WHERE id='$artikel' LIMIT 1");
    $chargenverwaltung= $this->app->DB->Select("SELECT chargenverwaltung FROM artikel WHERE id='$artikel' LIMIT 1");
    $standardbild = $this->app->DB->Select("SELECT standardbild FROM artikel WHERE id='$artikel' LIMIT 1");
    $shopartikel = $this->app->DB->Select("SELECT shop FROM artikel WHERE id='$artikel' LIMIT 1");

    if($standardbild=="")
      $standardbild = $this->app->DB->Select("SELECT datei FROM datei_stichwoerter WHERE subjekt='Shopbild' AND objekt='Artikel' AND parameter='$artikel' LIMIT 1");


    if(($menge > $menge_bestellung)&&$cmd!="manuell")
      $this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Achtung! Es wurden mehr geliefert als in der aktuellen Position bestellt worden sind!
          &nbsp;<input type=\"button\" onclick=\"window.location.href='index.php?module=wareneingang&action=distriinhalt&id=$id'\"
          value=\"Anzahl anpassen\" /></div>");

    if(!$shopartikel > 0)
    {
      $this->app->Tpl->Set('SHOWIMGSTART',"<!--");
      $this->app->Tpl->Set('SHOWIMGEND',"-->");
    }

    if($chargenverwaltung !="2")
    {
      $this->app->Tpl->Set('SHOWCHRSTART',"<!--");
      $this->app->Tpl->Set('SHOWCHREND',"-->");
    } else {
      //				$this->app->YUI->DatePicker("mhd");
    }


    if($mindesthaltbarkeitsdatum !="1")
    {
      $this->app->Tpl->Set('SHOWMHDSTART',"<!--");
      $this->app->Tpl->Set('SHOWMHDEND',"-->");
    } else {
      $this->app->YUI->DatePicker("mhd");
    }

      $this->app->Tpl->Set('SHOWSRNSTART',"<!--");
      $this->app->Tpl->Set('SHOWSRNEND',"-->");
    
    $standardlager = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='".$artikel."' LIMIT 1");
    if($standardlager <=0) 
    {
      $this->app->Tpl->Set('STANDARDLAGER',"nicht definiert");
      $this->app->Tpl->Set('LAGER',$this->app->erp->GetSelectAsso($this->app->erp->GetLager(),$lager));
    }
    else
    {
      $this->app->Tpl->Set('STANDARDLAGER',$this->app->DB->Select("SELECT kurzbezeichnung FROM lager_platz WHERE id='".$standardlager."' LIMIT 1"));
      $this->app->Tpl->Set('LAGER',$this->app->erp->GetSelectAsso($this->app->erp->GetLager(true),$lager));
    }

    $this->app->Tpl->Set('ETIKETTEN',$this->app->erp->GetSelect($this->app->erp->GetEtikett(),$etiketten));

    $this->app->Tpl->Set('MENGE',$menge);

    if($this->app->erp->Firmendaten("standardetikettendrucker")>0)
    {
      $this->app->Tpl->Set('ETIKETTENDRUCKEN',"Etiketten drucken.");
      $this->app->Tpl->Set('ANZAHL',0);
      $this->app->Tpl->Set('TEXTBUTTON',"Etiketten drucken und Artikel einlagern");
    }
    else {
      $this->app->Tpl->Set('SHOWANZAHLSTART',"<!--");
      $this->app->Tpl->Set('SHOWANZAHLENDE',"-->");

      $this->app->Tpl->Set('ETIKETTENDRUCKENSTART',"<!--");
      $this->app->Tpl->Set('ETIKETTENDRUCKENENDE',"-->");
      $this->app->Tpl->Set('TEXTBUTTON',"Artikel einlagern");
      $this->app->Tpl->Set('ANZAHL',0);
      $this->app->Tpl->Set('ANZAHLCHECKED',"checked");
    }

    $this->app->Tpl->Set('LIEFERANT',$name);
    $this->app->Tpl->Set('MITARBEITER',$mitarbeiter_name);
    $this->app->Tpl->Set('VPE',$vpe);
    $this->app->Tpl->Set('NAME',$name_de);
    $this->app->Tpl->Set('NUMMER',$nummer);
    $this->app->Tpl->Set('DATEI',$standardbild);

    $error = 0;
    // Pflichfelder pruefen
    if($mindesthaltbarkeitsdatum=="1" && $this->app->Secure->GetPOST("mhd")=="")
    {
      $error++;
    }

    if($chargenverwaltung=="2" && $this->app->Secure->GetPOST("charge")=="")
    {
      $error++;
    }

    if($seriennummern !="keine" && $seriennummern !="vomprodukt" && $seriennummern !="eigene" && $seriennummern !="")
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
      $this->app->Tpl->Add('MESSAGE',"<div class=\"error\">Achtung! Bitte alle Pflichtfelder ausf&uuml;llen!</div>");
    }
    // ende pflichtfelder pruefung

    //    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=distriinhalt&id=$id","zum Paketinhalt");
    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=manuellerfassen&id=$id","Zur&uuml;ck zur &Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=wareneingang&action=distrietiketten&id=$id","Artikel",true);

    $typ = "";
    //weiter mit paket bis fertig
    if($rma=="rma")
    {
    } else {
      if($lagerartikel && !$artikelcheckliste && !$funktionstest && !$endmontage)
      {
        $typ = "lager";
        //$this->app->Tpl->Add(TAB1TEXT,"<li><a>Lagerartikel</a></li>");
        $this->app->Tpl->Parse('TAB1',"wareneingangpaketdistribution_tab3_lager.tpl");
      } else if($artikelcheckliste || $funktionstest || $endmontage)
      {
      } else if (!$lagerartikel && !$artikelcheckliste && !$funktionstest && !$endmontage)
      {
        $typ = "mitarbeiter";
        $this->app->Tpl->Add('TAB1TEXT',"<li><a>Artikel f&uuml;r Mitarbeiter</a></li>");
        $this->app->Tpl->Parse('TAB1',"wareneingangpaketdistribution_tab3_mitarbeiter.tpl");
      } else {echo "Diesen Fall gibt es nicht. WaWision Entwicklung kontaktieren!";}
    }


    //befehl ab ins lager, produktion oder mitarbeiter
    if($submit!="" && $error==0)
    {
      switch($typ)
      {
        case "lager":

          if($anzahlauswahl=="fix") $druckanzahl = $anzahl_fix;
          else $druckanzahl = $anzahl_dyn;
          $name_de = $this->app->DB->Select("SELECT name_de FROM artikel WHERE id='$artikel' LIMIT 1");                     
          $name_de = base64_encode($name_de);  

          $this->app->erp->LagerArtikelZusammenfassen($artikel);

          //$etiketten AUSWAHL etiketten ob gross oder klein
          if($this->app->erp->Firmendaten("standardetikettendrucker")>0) {
            if($etiketten=="gross")
            {
              //HttpClient::quickGet("http://".$this->app->erp->GetIPAdapterbox($this->app->erp->Firmendaten("standardetikettendrucker"))."/druck.php?nr=$nummer&ch=$ch&anzahl=$druckanzahl&etikett=$etiketten&beschriftung=$name_de");
            }
            else
            { 
              if($druckanzahl>0)
              {
                $this->app->erp->EtikettenDrucker("artikel_klein",$druckanzahl,"artikel",$artikel);
              }
              //$etiketten ="klein";   
              //HttpClient::quickGet("http://".$this->app->erp->GetIPAdapterbox($this->app->erp->Firmendaten("standardetikettendrucker"))."/druck.php?nr=$nummer&ch=$ch&anzahl=$druckanzahl&etikett=$etiketten&beschriftung=$name_de");
            }
          }
          $zid = "";
          // entweder ins zwischenlager 
          if($lager=="zwischenlager")
          {
            $this->app->DB->Insert("INSERT INTO zwischenlager (id,bearbeiter,projekt,artikel,menge,vpe,grund,lager_von,richtung,objekt,parameter,firma)
                VALUES ('','".$this->app->User->GetName()."','$projekt','$artikel','$menge','$vpe','Wareneingang von Bestellung $bestellung_belegnr','Wareneingang','Eingang',
                  'Bestellung','$bestellung','".$this->app->User->GetFirma()."')");
            $typ = "zwischenlager";
            $zid = $this->app->DB->GetInsertID();
          }
          // oder direkt ins manuelle (lagerplatz + lager_bewegung)
          else 
          {
            if($lager=="standardlager")
              $lager = $this->app->DB->Select("SELECT lager_platz FROM artikel WHERE id='".$artikel."' LIMIT 1");

            if($lager<=0)
              $lager = $this->app->DB->Select("SELECT id FROM lager_platz WHERE autolagersperre!=1 AND verbrauchslager!=1 AND geloescht!=1 LIMIT 1");

            if($lager=="zwischenlager")
              $lagerplatz = 0;
            else 
              $lagerplatz = $lager;


            //$charge = $this->app->Secure->GetPOST("charge");
            if($chargenverwaltung=="1")
            {
              // wenn chargenverwaltung dann chargen id holen!!!! und mit bei lagerung und etikett speichern!
              $this->app->DB->Insert("INSERT INTO chargenverwaltung (id,artikel,bestellung,menge,vpe,zeit,bearbeiter) 
                  VALUES ('','$artikel','$bestellung','$menge','$vpe',NOW(),'".$this->app->User->GetName()."')");
              // drucken (inkl. chargennummer)
              $ch = $this->app->DB->GetInsertID();
              $chargemindest = $ch;
            } else if($chargenverwaltung=="2")
            {
              $charge = $this->app->Secure->GetPOST("charge");
              $chargemindest = $charge;	
            }
            else $ch = 0;
            //START
            // Mindesthaltbarkeitsdatum buchen
            $mhd = $this->app->String->Convert($this->app->Secure->GetPOST("mhd"),"%1.%2.%3","%3-%2-%1");
            $this->app->erp->AddMindesthaltbarkeitsdatumLagerOhneBewegung($artikel,$menge,$lagerplatz,$mhd,$chargemindest,$zid);

            if($chargenverwaltung > 0)
            {
              $datum = date('Y-m-d');
              $this->app->erp->AddChargeLagerOhneBewegung($artikel,$menge,$lagerplatz,$datum,$chargemindest,"",$zid);
            }

            //ENDE			
            $this->app->DB->Insert("INSERT INTO lager_bewegung (id,lager_platz,artikel,menge,eingang,zeit,referenz,vpe,bearbeiter) VALUES  
                ('','$lager','$artikel','$menge','1',NOW(),'Wareneingang von Bestellung $bestellung_belegnr','$vpe','".$this->app->User->GetName()."')");	    

            $this->app->DB->Insert("INSERT INTO lager_platz_inhalt (id,lager_platz,artikel,menge,vpe,bearbeiter,bestellung) VALUES  
                  ('','$lager','$artikel','$menge','$vpe','".$this->app->User->GetName()."','$bestellung')");	    


             $this->app->erp->LagerArtikelZusammenfassen($artikel);

              // die id von lager_platz_inhalt ist die chargenid UND JETZT ERST DRUCKEN!!!!!!!!!!

          }




          break;
        case "mitarbeiter":
          // buchen als mitarbeiter inventar auf das projekt was angegeben ist
          // wenn mitarbeiterartikel muss artikel als inventar dem mitarbeiter gebucht werden fuer projekt bla bla
          $this->app->DB->Insert("INSERT INTO projekt_inventar (id,artikel,menge,projekt,mitarbeiter,bestellung,zeit,vpe)
              VALUES('','$artikel','$menge','$projekt','$mitarbeiter','$bestellung',NOW(),'$vpe')");
          break;


        default:
          echo "ACHTUNG DAS DARF NICHT PASSIEREN!! WAWISION ENTWICKLUNG HOLEN! FEHLER IM PROGRAMM?";  
      }

      if($typ!="rma")
      {
        // Distribution speichern!
        $this->app->DB->Insert("INSERT INTO paketdistribution (id,bearbeiter,zeit,paketannahme,adresse,artikel,menge,vpe,etiketten,bemerkung,bestellung_position)
            VALUES ('','".$this->app->User->GetName()."',NOW(),'$id','$adresse','$artikel','$menge','$vpe','$etiketten','$bemerkung','$pos')");

        // anzahl gelieferte erhoehen bestellung_position !!!
        $geliefert = $this->app->DB->Select("SELECT geliefert FROM bestellung_position WHERE id='$pos' LIMIT 1");
        $gesamt_erwartet = $this->app->DB->Select("SELECT menge FROM bestellung_position WHERE id='$pos' LIMIT 1");
        $geliefert = $geliefert + $menge;
        $this->app->DB->Update("UPDATE bestellung_position SET geliefert='$geliefert' WHERE id='$pos' LIMIT 1");
      }

      // alles passt weiter im abschluss
      header("Location: index.php?module=wareneingang&action=distriabschluss&id=$id&pos=$pos&typ=$typ&rma=$rma");
      exit;
    }

    $this->app->Tpl->Set(AKTIV_TAB2,"tabs-1");
    $this->app->Tpl->Parse(PAGE,"wareneingangpaketdistribution.tpl");
  }


  function WareneingangPaketDistriAbschluss()
  {
    $id = $this->app->Secure->GetGET("id");
    $typ  = $this->app->Secure->GetGET("typ");
    $submit = $this->app->Secure->GetGET("submit");
    $abschliessen = $this->app->Secure->GetPOST("abschliessen");
    $weiter = $this->app->Secure->GetPOST("weiter");

    $this->WareneingangPaketDistriMenu(); 


    //if($weiter!="")
    //{
    header("Location: index.php?module=wareneingang&action=distriinhalt&id=$id");
    exit;
    //}

    if($abschliessen!="")
    {
      // paketannahme auf abgeschlossen setzten
      $this->app->DB->Update("UPDATE paketannahme SET status='abgeschlossen' WHERE id='$id' LIMIT 1");

      if($typ=="rma")
      {
        //RMA bericht drucken mit allen artikeln des Kunden



      }

      header("Location: index.php?module=wareneingang&action=paketannahme");
      exit;
    }

    if($typ=="rma")
    {
      $this->app->Tpl->Set(PAGE,"<form action=\"\" method=\"post\"><br><br><center>
          <input type=\"submit\" name=\"weiter\" value=\"weitere Artikel aus dem Paket zurordnen\">&nbsp;
          <input type=\"submit\" name=\"abschliessen\" value=\"Paket ist komplett erfasst!\"></center></form>");

    } else {

      $this->app->Tpl->Set(PAGE,"<form action=\"\" method=\"post\"><br><br><center>
          <input type=\"submit\" name=\"weiter\" value=\"weitere Artikel aus dem Paket zurordnen\">&nbsp;
          <input type=\"submit\" name=\"abschliessen\" value=\"Paketinhalt ist jetzt komplett erfasst!\"></center></form>");
    }
  }



  
  function WareneingangPaketZustand()
  {
    $this->WareneingangPaketMenu();
    $id = $this->app->Secure->GetGET("id");
    $submit = $this->app->Secure->GetPOST("submit");
    if($submit!="")
    {
      $this->app->FormHandler->FormUpdateDatabase("paketannahme",$id);

      header("Location: index.php?module=wareneingang&action=paketetikett&id=$id");
      exit;
    }
    //$client = new HttpClient("192.168.0.171");
    $wareneingang_kamera_waage = $this->app->DB->Select("SELECT wareneingang_kamera_waage FROM firmendaten LIMIT 1");

    if($wareneingang_kamera_waage == "1")
    {
      $seriennummer = $this->app->DB->Select("SELECT seriennummer FROM adapterbox WHERE verwendenals='kamera' OR verwendenals='waage' LIMIT 1");
      $pageContent = $this->app->erp->GetAdapterboxAPIWaage($seriennummer);
    }

    $gewicht = $pageContent;

    //$gewicht = intval($gewicht)-2;

    if($wareneingang_kamera_waage =="1")
      $this->app->Tpl->Set('GEWICHT',$gewicht);
    else
      $this->app->Tpl->Set('GEWICHT',"none");


    if($wareneingang_kamera_waage == "1"){
      //$datei = HttpClient::quickGet("http://192.168.0.53/snap.jpg");
      $seriennummer = $this->app->DB->Select("SELECT seriennummer FROM adapterbox WHERE verwendenals='kamera' LIMIT 1");
      $datei = $this->app->erp->GetAdapterboxAPIImage($seriennummer,"800","600");

      $tmpname = tempnam($this->app->erp->GetTMP(),"wareneingang").".jpg";
      file_put_contents($tmpname, $datei);
  
      $ersteller = $this->app->User->GetName();
      $file = $this->app->erp->CreateDatei(date('Ymd')."_paketannahme_$id.jpg","Paketannahme $id","","",$tmpname,$ersteller);

      unlink($tmpname);

      $this->app->Tpl->Set('FOTO',$file);

      $this->app->erp->AddDateiStichwort($file,"Bild","Paketannahme",$id);

      $this->app->Tpl->Set('LIVEFOTO','<img src="index.php?module=dateien&action=send&id='.$file.'" width="400">');
  }

  if($gewicht <= 0 && $wareneingang_kamera_waage==1)
    $this->app->Tpl->Set('MELDUNG',"<div class=\"error\">Bitte legen Sie das Paket auf die Waage und schie&szlig;en Sie nochmal ein Foto!</div>");
  else if ($gewicht <= 0 && $wareneingang_kamera_waage !=1)
    $this->app->Tpl->Set('MELDUNG',"<div class=\"info\">Status: Ohne Waage und Kamera Funktion</div>");


  $this->app->Tpl->Parse('TAB1',"wareneingangpaketannahme_tab3.tpl");
  $this->app->Tpl->Set('AKTIV_TAB3',"tabs-1");
  $this->app->Tpl->Parse('PAGE',"wareneingangpaketannahme.tpl");
}


function WareneingangPaketEtikett()
{
  $this->WareneingangPaketMenu();
  $id = $this->app->Secure->GetGET("id");
  $submit = $this->app->Secure->GetPOST("submit");
  if($submit!="")
    header("Location: index.php?module=wareneingang&action=paketabschliessen&id=$id");


  $this->app->Tpl->Parse('TAB1',"wareneingangpaketannahme_tab4.tpl");
  $this->app->Tpl->Set('AKTIV_TAB4',"tabs-1");
  $this->app->Tpl->Parse('PAGE',"wareneingangpaketannahme.tpl");
}

function WareneingangPaketAbschliessen()
{
  $this->WareneingangPaketMenu();
  $id = $this->app->Secure->GetGET("id");
  $weiteres= $this->app->Secure->GetPOST("weiteres");
  $abschluss= $this->app->Secure->GetPOST("abschluss");
  
  if($weiteres!="")
    header("Location: index.php?module=wareneingang&action=paketannahme");
  if($abschluss!="")
  {
    header("Location: index.php?module=wareneingang&action=paketannahme");
    
  }


  $this->app->Tpl->Parse('TAB1',"wareneingangpaketannahme_tab5.tpl");
  $this->app->Tpl->Set('AKTIV_TAB5',"tabs-1");
  $this->app->Tpl->Parse('PAGE',"wareneingangpaketannahme.tpl");
}




function WareneingangList()
{
  $this->WareneingangMenu();

  $this->app->Tpl->Set('SUBHEADING',"Lieferungen");
  //Jeder der in Nachbesserung war egal ob auto oder manuell wandert anschliessend in Manuelle-Freigabe");
  $table = new EasyTable($this->app);
  $table->Query("SELECT '23.11.2009' as datum, 'Olimex' as lieferant,id FROM aufgabe LIMIT 3");
  $table->DisplayNew('INHALT',"<a href=\"index.php?module=ticket&action=assistent&id=%value%\">Lesen</a>");
  $this->app->Tpl->Parse('TAB1',"rahmen.tpl");
  $this->app->Tpl->Set('INHALT',"");


  $this->app->Tpl->Set('AKTIV_TAB1',"tabs-1");
  $this->app->Tpl->Parse('PAGE',"wareneinganguebersicht.tpl");
}

function WareneingangPaketannahme()
{
  $this->WareneingangPaketMenu();

  $vorlage= $this->app->Secure->GetGET("vorlage");
  $suche= $this->app->Secure->GetPOST("suche");
  $id = $this->app->Secure->GetGET("id");

  if($vorlage!="")
  {
    if($vorlage=="bestellung")
    {
      $vorlageid = $id;
      $adresse = $this->app->DB->Select("SELECT adresse FROM bestellung WHERE id='$id' LIMIT 1");
      $projekt = $this->app->DB->Select("SELECT projekt FROM bestellung WHERE id='$id' LIMIT 1");
    }
    else if ($vorlage=="adresse")
    {
      $adresse = $id;
      $vorlageid = $adresse;
      // standardprojekt von kunde
      $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='$id' AND geloescht=0 LIMIT 1");
    } else exit;

    $bearbeiter = $this->app->User->GetName(); 

    $sql = "INSERT INTO paketannahme (id,datum,adresse,vorlage,vorlageid,projekt,bearbeiter,status) VALUES
      ('',NOW(),'$adresse','$vorlage','$vorlageid','$projekt','$bearbeiter','angenommen')";
    $this->app->DB->Insert($sql);
    $id = $this->app->DB->GetInsertID();

    header("Location: index.php?module=wareneingang&action=distriinhalt&id=$id");
    exit;
  }

  $this->app->YUI->TableSearch('SUCHE',"paketannahme");
  /*
     if($suche!="")  
     {
     $table = new EasyTable($this->app);
     $this->app->Tpl->Set(SUCHE,"<h2>Trefferliste:</h2><br>");
     $table->Query("SELECT name, plz, ort, strasse, id FROM adresse WHERE (name LIKE '%$suche%' or plz='$suche') AND geloescht=0");
     $table->DisplayNew(SUCHE,"<a href=\"index.php?module=wareneingang&action=paketannahme&id=%value%&vorlage=adresse\">Adresse ausw&auml;hlen</a>");
     } else {
     $letzte_adresse = $this->app->DB->Select("SELECT adresse FROM paketannahme Order by datum DESC LIMIT 1");
     $this->app->Tpl->Set(SUCHE,"<h2>Letzte Paketannahme:</h2><br>");
     $table = new EasyTable($this->app);
     $table->Query("SELECT name, plz, ort, strasse, id FROM adresse WHERE id='$letzte_adresse' AND geloescht=0");
     $table->DisplayNew(SUCHE,"<a href=\"index.php?module=wareneingang&action=paketannahme&id=%value%&vorlage=adresse\">Adresse nochmal ausw&auml;hlen</a>");
     }
   */
  $table = new EasyTable($this->app);
  $table->Query("SELECT DATE_FORMAT(datum,'%d.%m.%Y') as datum, name, belegnr as bestellung, id FROM bestellung WHERE status!='geliefert'");
  $table->DisplayNew('BESTELLUNGEN',"<a href=\"index.php?module=wareneingang&action=paketannahme&id=%value%&vorlage=bestellung\">weiter</a>");

  $this->app->YUI->AutoComplete("suche","adressename");
  $this->app->Tpl->Parse('TAB1',"wareneingangpaketannahme_tab1.tpl");

  $this->app->Tpl->Set('AKTIV_TAB1',"tabs-1");
  $this->app->Tpl->Parse('PAGE',"wareneingangpaketannahme.tpl");
}




}
?>
