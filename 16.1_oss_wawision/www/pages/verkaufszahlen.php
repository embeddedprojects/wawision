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

class Verkaufszahlen {
  var $app;

  function Verkaufszahlen(&$app) {
    $this->app=&$app;

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","VerkaufszahlenList");
    $this->app->ActionHandler("details","VerkaufszahlenDetails");


    $this->app->Tpl->Set('UEBERSCHRIFT',"Verkaufszahlen");
    $this->app->ActionHandlerListen($app);
  }

  function VerkaufszahlenList()
  {
    $this->VerkaufszahlenMenu();

    $this->app->Tpl->Set(TABTEXT,"Verkaufszahlen");

    $projekte_arr = $this->app->DB->SelectArr("SELECT id as projekt FROM projekt WHERE verkaufszahlendiagram='1' AND geloescht!='1' order by abkuerzung");
    for($i=0;$i<count($projekte_arr);$i++){
      $projekte[] = $projekte_arr[$i]['projekt'];

      $abkuerzung = $this->app->DB->Select("SELECT abkuerzung FROM projekt WHERE id='".$projekte_arr[$i]['projekt']."' LIMIT 1");
      $farbe = $this->app->DB->Select("SELECT farbe FROM projekt WHERE id='".$projekte_arr[$i]['projekt']."' LIMIT 1");

      if($farbe=="") $farbe="#eee";

      if($i<count($projekte_arr)-1)
        $this->app->Tpl->Add(PLOTLEGENDS,'{ label: "'.$abkuerzung.'",  data: d'.($i+1).', color: "'.$farbe.'"},');
      else
        $this->app->Tpl->Add(PLOTLEGENDS,'{ label: "'.$abkuerzung.'",  data: d'.($i+1).', color: "'.$farbe.'"}');

    }

    /*
    $spalte = 0;
    for ($zaehler = -12; $zaehler <= 0; $zaehler++) {
      $daten .=  "[$spalte,'".date("D", strtotime("+" . $zaehler . " day"))."<br>".date("d.m", strtotime("+" . $zaehler . " day"))."']";

      $tagdatum =  date("Y-m-d", strtotime("+" . $zaehler . " day"));


      foreach($projekte as $value)
      {
        //$betrag = rand(10,100);
        $betrag = $this->app->DB->Select("SELECT CEILING(SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))))
            FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id 
            LEFT JOIN projekt p ON p.id=a.projekt WHERE a.status!='storniert' AND a.belegnr!='0'  AND p.id='$value' AND a.datum='$tagdatum' ");

        if($betrag!="")$betrag = "'".$betrag."'";
        else $betrag="0.1";

        $projekte_daten[$value] .= "[$spalte,$betrag]";
      }
      if($zaehler<0)
      {
        $daten .= ",";
        foreach($projekte as $value)
          $projekte_daten[$value] .= ",";
      }
      $spalte++;
    } 
    */
    
      $betraege = $this->app->DB->SelectArr("SELECT date_format(a.datum,'%Y-%m-%d') as datum,p.id, CEILING(SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1)))) as betrag
            FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id 
            LEFT JOIN projekt p ON p.id=a.projekt WHERE a.status!='storniert' AND a.belegnr!='0' AND a.datum > date_sub(now(),INTERVAL 13 DAY)  group by p.id,a.datum order by a.datum ,p.id");
            
      
    $spalte = 0;
    for ($zaehler = -12; $zaehler <= 0; $zaehler++) {
      $daten .=  "[$spalte,'".date("D", strtotime("+" . $zaehler . " day"))."<br>".date("d.m", strtotime("+" . $zaehler . " day"))."']";

      $tagdatum =  date("Y-m-d", strtotime("+" . $zaehler . " day"));


      foreach($projekte as $value)
      {
        $betrag = "";
        if($betraege){
          foreach($betraege as $betr)
          {
            
            if($betr['id'] == $value && $betr['datum'] == $tagdatum)$betrag = $betr['betrag'];           
          }
        }
        
        
        if($betrag!="")$betrag = "'".$betrag."'";
        else $betrag="0.1";

        $projekte_daten[$value] .= "[$spalte,$betrag]";
      }
      if($zaehler<0)
      {
        $daten .= ",";
        foreach($projekte as $value)
          $projekte_daten[$value] .= ",";
      }
      $spalte++;
    } 
    
    

    $this->app->Tpl->Set(DATUM,"[$daten]");

    $nummer = 1;	
    foreach($projekte as $value)
    {
      $var .= "var d$nummer = [".$projekte_daten[$value]."];";
      $nummer++;
    }
    $this->app->Tpl->Set(VARIABLEN,$var);




    //Auftragseingang leztzten 2 Wochen

    $table = new EasyTable($this->app);
/*    $table->Query("SELECT 
        DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, FORMAT(SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))),2) as Umsatz , 
        (SELECT COUNT(v.id) FROM versand v WHERE v.versendet_am=a.datum) as pakete
        FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id WHERE (a.status='freigegeben' OR a.status='abgeschlossen') AND (a.belegnr!='0' OR a.belegnr!='')  GROUP by a.datum DESC LIMIT 30");*/
    $table->Query("SELECT 
        DATE_FORMAT(a.datum,'%d.%m.%Y') as datum, FORMAT(SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))),2) as Umsatz , 
        '' as pakete
        FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id WHERE (a.status='freigegeben' OR a.status='abgeschlossen') AND (a.belegnr!='0' OR a.belegnr!='')  GROUP by a.datum DESC LIMIT 30");
    if(isset($table->datasets) && $table->datasets && count($table->datasets) > 0)
    {
      $pakete = $this->app->DB->SelectArr("SELECT DATE_FORMAT(versendet_am,'%d.%m.%Y') as datum,count(*) as pakete from versand group by datum");
      if($pakete)
      {
        foreach($pakete as $paket)
        {
          if($paket['pakete'])
          {
            foreach($table->datasets as $k => $d)
            {
              if($d['datum'] == $paket['datum'])
              {
                $table->datasets[$k]['pakete'] = $paket['pakete'];
              }
            }
          }
        }
      }
    }   
    $table->DisplayNew(TAGESUEBERSICHT,"Pakete","noAction");
    /* extend */

    $summe = $this->app->DB->Select("SELECT SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))) FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id WHERE (a.status!='storniert' and a.status!='angelegt')");
    $summe_gs = $this->app->DB->Select("SELECT SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))) FROM gutschrift_position ap LEFT JOIN gutschrift a ON ap.gutschrift=a.id WHERE (a.status!='storniert' and a.status!='angelegt')"); 

    //LEFT JOIN projekt p ON p.id=a.projekt WHERE DATE_FORMAT(a.datum,'%Y-%m')=DATE_FORMAT(NOW(),'%Y-%m')");
    $summe30 = $this->app->DB->Select("SELECT SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))) FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id 
        WHERE a.datum > date_add(NOW(), interval -30 day) AND (a.status!='storniert' and a.status!='angelegt')");
    $summe30_gs = $this->app->DB->Select("SELECT SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))) FROM gutschrift_position ap LEFT JOIN gutschrift a ON ap.gutschrift=a.id 
        WHERE a.datum > date_add(NOW(), interval -30 day) AND (a.status!='storniert' and a.status!='angelegt')");
    //LEFT JOIN projekt p ON p.id=a.projekt WHERE DATE_FORMAT(a.datum,'%Y-%m')=DATE_FORMAT(NOW(),'%Y-%m')");


    $summemenge = count($this->app->DB->SelectArr("SELECT 
          COUNT(a.datum) FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id WHERE (a.status!='storniert' and a.status!='angelegt')
          GROUP by a.datum, a.projekt "));

    if($summemenge < 30)
    {
      $summe_gutschriften = $summe_gs;
      $summe_auftrag = $summe;
      $durchschnitt = ($summe-$summe_gs) / $summemenge; 
      $summe= number_format(($summe-$summe_gs),2);
      $tage = $summemenge;
    } else {
      $summe_gutschriften = $summe30_gs;
      $summe_auftrag = $summe30;
      $durchschnitt = ($summe30-$summe30_gs) / 30;  // wenn mehr als 30 tage
      $summe= number_format(($summe30-$summe30_gs),2);
      $tage = 30;
    }

    $summe_gutschriften = number_format($summe_gutschriften,2);
    $summe_auftrag = number_format($summe_auftrag,2);

    $durchschnitt = number_format($durchschnitt,2);
    $this->app->Tpl->Set(EXTEND,"Summe: $summe_auftrag &euro; (abzgl. Gutschriften $summe_gutschriften &euro; = pro Tag $durchschnitt seit $tage Tagen)");


    /* tages uebersicht detail */

    $table = new EasyTable($this->app);
    $table->Query("SELECT 
        DATE_FORMAT(a.datum,'%d.%m.%Y') as datum,p.abkuerzung as projekt, FORMAT(SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))),2) as Umsatz, COUNT(ap.id) as positionen, 
        CONCAT('<a href=\"index.php?module=verkaufszahlen&action=details&frame=false&id=',DATE_FORMAT(a.datum,'%Y-%m-%d'),'-',a.projekt,'\" onclick=\"makeRequest(this); return false;\">Details</a>') as id FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id 
        LEFT JOIN projekt p ON p.id=a.projekt WHERE a.status!='storniert' GROUP by a.datum DESC, a.projekt LIMIT 14");
    $table->DisplayNew(TAGESUEBERSICHTDETAIL,"");

    // top artikel

    $table = new EasyTable($this->app);
    $table->Query("SELECT SUM(ap.menge) menge,ap.nummer, ap.bezeichnung FROM auftrag_position ap LEFT JOIN artikel a ON a.id=ap.artikel LEFT JOIN
        auftrag auf ON ap.auftrag=auf.id WHERE auf.datum >= DATE_SUB(NOW(),INTERVAL 90 day) AND a.lagerartikel=1 GROUP BY ap.artikel ORDER by 1 DESC LIMIT 30");
    $table->DisplayNew(TOPARTIKEL,"Bezeichnung","noAction");

    //heute

    $this->app->Tpl->Set(PAKETE,$this->app->DB->Select("SELECT COUNT(id) FROM versand WHERE versendet_am=DATE_FORMAT(NOW(),'%Y-%m-%d')"));	
    /*
       $umsatz = $this->app->DB->Select("SELECT SUM(gesamtsumme) FROM auftrag WHERE datum=DATE_FORMAT(NOW(),'%Y-%m-%d') AND (status='abgeschlossen' OR status='freigegeben' OR shopextid !='')");
       $einnahmen_auftrag = $this->app->DB->Select("SELECT SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))) FROM auftrag auf LEFT JOIN auftrag_position ap ON ap.auftrag=auf.id LEFT JOIN artikel a ON ap.artikel=a.id WHERE auf.datum=DATE_FORMAT(NOW(),'%Y-%m-%d') AND (auf.status='abgeschlossen' OR auf.status='freigegeben' OR auf.shopextid !='')");

       $ausgaben_auftrag = $this->app->DB->Select("SELECT SUM(ap.menge*IFNULL((SELECT e.preis FROM einkaufspreise e WHERE e.artikel=ap.artikel AND (e.gueltig_bis > NOW() OR e.gueltig_bis='0000-00-00') AND e.geloescht!=1 ORDER by e.id DESC LIMIT 1),0)) FROM auftrag auf LEFT JOIN auftrag_position ap ON ap.auftrag=auf.id LEFT JOIN artikel a ON ap.artikel=a.id WHERE auf.datum=DATE_FORMAT(NOW(),'%Y-%m-%d') AND (auf.status='abgeschlossen' OR auf.status='freigegeben' OR auf.shopextid !='') ");
     */
    $data = $this->app->DB->SelectArr("SELECT SUM(umsatz_netto) as umsatz_netto2,SUM(erloes_netto) as erloes_netto2 FROM `auftrag` WHERE datum=DATE_FORMAT(NOW(),'%Y-%m-%d') AND ( status='abgeschlossen' OR status='freigegeben' OR shopextid !='')");

    $einnahmen_auftrag = $data[0]['umsatz_netto2'];
    $ausgaben_auftrag = $data[0]['umsatz_netto2'] - $data[0]['erloes_netto2'];

    $deckungsbeitrag = $einnahmen_auftrag - $ausgaben_auftrag;
    $deckungsbeitragprozent = ($deckungsbeitrag / $einnahmen_auftrag)*100;

    if($einnahmen_auftrag <=0) $einnahmen_auftrag="0.00";
    $this->app->Tpl->Set(UMSATZ,number_format($einnahmen_auftrag,2,',','.')." &euro;");

    //SELECT e.preis,ap.menge,ap.bezeichnung,ap.artikel FROM auftrag auf LEFT JOIN auftrag_position ap ON ap.auftrag=auf.id  RIGHT JOIN einkaufspreise e ON e.artikel=ap.artikel WHERE auf.datum=DATE_FORMAT(NOW(),'%Y-%m-%d') AND (auf.status='abgeschlossen' OR auf.status='freigegeben') AND (e.gueltig_bis > NOW() OR e.gueltig_bis!='0000-00-00') AND e.geloescht!=1 GROUP by e.artikel
    $this->app->Tpl->Set(DECKUNGSBEITRAG,number_format($deckungsbeitrag,2,',','.') );	
    $this->app->Tpl->Set(DECKUNGSBEITRAGPROZENT,number_format($deckungsbeitragprozent,2,',','.'));	
    $this->app->Tpl->Parse(STATISTIKHEUTE,"verkaufszahlen_statistik.tpl");

    //gestern

    $this->app->Tpl->Set(PAKETE,$this->app->DB->Select("SELECT COUNT(id) FROM versand WHERE versendet_am=DATE_FORMAT(DATE_SUB(NOW(),INTERVAL 1 day),'%Y-%m-%d')"));	
    /*
       $umsatz = $this->app->DB->Select("SELECT SUM(gesamtsumme) FROM auftrag WHERE datum=DATE_FORMAT(DATE_SUB(NOW(),INTERVAL 1 day),'%Y-%m-%d') AND (status='abgeschlossen' OR status='freigegeben' OR shopextid !='')");
       $einnahmen_auftrag = $this->app->DB->Select("SELECT SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))) FROM auftrag auf LEFT JOIN auftrag_position ap ON ap.auftrag=auf.id LEFT JOIN artikel a ON ap.artikel=a.id WHERE auf.datum=DATE_FORMAT(DATE_SUB(NOW(),INTERVAL 1 day),'%Y-%m-%d') AND (auf.status='abgeschlossen' OR auf.status='freigegeben' OR auf.shopextid !='') ");
       $ausgaben_auftrag = $this->app->DB->Select("SELECT SUM(ap.menge*IFNULL((SELECT e.preis FROM einkaufspreise e WHERE e.artikel=ap.artikel AND (e.gueltig_bis > DATE_SUB(NOW(),INTERVAL 1 day) OR e.gueltig_bis='0000-00-00') AND e.geloescht!=1 ORDER by e.id DESC LIMIT 1),0)) FROM auftrag auf LEFT JOIN auftrag_position ap ON ap.auftrag=auf.id LEFT JOIN artikel a ON ap.artikel=a.id WHERE auf.datum=DATE_FORMAT(DATE_SUB(NOW(),INTERVAL 1 day),'%Y-%m-%d') AND (auf.status='abgeschlossen' OR auf.status='freigegeben' OR auf.shopextid !='')");

     */

    $data = $this->app->DB->SelectArr("SELECT 
        SUM(umsatz_netto) as umsatz_netto2,SUM(erloes_netto) as erloes_netto2 FROM `auftrag` WHERE datum=DATE_FORMAT(DATE_SUB(NOW(),INTERVAL 1 day),'%Y-%m-%d') AND ( status='abgeschlossen' OR status='freigegeben' OR shopextid !='')");

    // $umsatz = $data[0]['gesamtsumme2'];
    $einnahmen_auftrag = $data[0]['umsatz_netto2'];
    $ausgaben_auftrag = $data[0]['umsatz_netto2'] - $data[0]['erloes_netto2'];

    $deckungsbeitrag = $einnahmen_auftrag - $ausgaben_auftrag;
    $deckungsbeitragprozent = ($deckungsbeitrag / $einnahmen_auftrag)*100;

    if($einnahmen_auftrag <=0) $einnahmen_auftrag="0.00";
    $this->app->Tpl->Set(UMSATZ,number_format($einnahmen_auftrag,2,',','.')." &euro;");

    //SELECT e.preis,ap.menge,ap.bezeichnung,ap.artikel FROM auftrag auf LEFT JOIN auftrag_position ap ON ap.auftrag=auf.id  RIGHT JOIN einkaufspreise e ON e.artikel=ap.artikel WHERE auf.datum=DATE_FORMAT(NOW(),'%Y-%m-%d') AND (auf.status='abgeschlossen' OR auf.status='freigegeben') AND (e.gueltig_bis > NOW() OR e.gueltig_bis!='0000-00-00') AND e.geloescht!=1 GROUP by e.artikel
    $this->app->Tpl->Set(DECKUNGSBEITRAG,number_format($deckungsbeitrag,2,',','.') );
    $this->app->Tpl->Set(DECKUNGSBEITRAGPROZENT,number_format($deckungsbeitragprozent,2,',','.'));
    $this->app->Tpl->Parse(STATISTIKGESTERN,"verkaufszahlen_statistik.tpl");


    $this->app->Tpl->Parse(JAVASCRIPT,"verkaufszahlengraph.tpl");
    //$this->app->Tpl->Add(JQUERY,"plotgraph();");

    if($this->app->erp->Firmendaten("api_enable")=="1")
    {
      $this->app->Tpl->Set(APIHINWEIS,"(Vorschau Import auf Aufträge unabh&auml;ngig von Freigabe)");
    }

    $this->app->Tpl->Parse(TAB1,"verkaufszahlen_list.tpl");
    $this->app->Tpl->Parse(PAGE,"tabview.tpl");

    return;
  }


  function VerkaufszahlenDetails()
  {
    $this->VerkaufszahlenMenu();

    $this->app->Tpl->Set(TABTEXT,"Verkaufszahlen");



    /* tages uebersicht detail */

    $table = new EasyTable($this->app);
    $table->Query("SELECT 
        DATE_FORMAT(a.datum,'%d.%m.%Y') as datum,p.abkuerzung as projekt, FORMAT(SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))),2) as Umsatz, COUNT(ap.id) as positionen, 
        CONCAT('<a href=\"index.php?module=verkaufszahlen&action=details&frame=false&id=',DATE_FORMAT(a.datum,'%Y-%m-%d'),'-',a.projekt,'\" onclick=\"makeRequest(this); return false;\">Details</a>') as id FROM auftrag_position ap LEFT JOIN auftrag a ON ap.auftrag=a.id 
        LEFT JOIN projekt p ON p.id=a.projekt WHERE a.status!='storniert' GROUP by a.datum DESC, a.projekt LIMIT 14");
    $table->DisplayNew(TAGESUEBERSICHTDETAIL,"");



    /* tages uebersicht detail */                                                                                                                             

    $table = new EasyTable($this->app);                                                                                                                       
    $table->Query("SELECT                                                                                                                                     
        DATE_FORMAT(a.datum,'%d.%m.%Y') as datum,p.abkuerzung as projekt, FORMAT(SUM(ap.preis*ap.menge*(IF(ap.rabatt > 0, (100-ap.rabatt)/100, 1))),2) as Umsatz, COUNT(ap.id) as positionen,                         
        CONCAT('<a href=\"index.php?module=verkaufszahlen&action=details&frame=false&id=',DATE_FORMAT(a.datum,'%Y-%m-%d'),'-',a.projekt,'\" onclick=\"makeReques
          LEFT JOIN projekt p ON p.id=a.projekt WHERE a.status!='storniert' GROUP by a.datum DESC, a.projekt LIMIT 14");                                          
        $table->DisplayNew(TAGESUEBERSICHTDETAILGESTERN,"");                                                                                                             
        $table = new EasyTable($this->app);
        $table->Query("SELECT SUM(ap.menge) menge,ap.bezeichnung FROM auftrag_position ap LEFT JOIN artikel a ON a.id=ap.artikel GROUP BY ap.artikel ORDER by 1 DESC LIMIT 14");
        //$table->Query("SELECT SUM(ap.menge) menge,ap.bezeichnung FROM auftrag_position ap LEFT JOIN artikel a ON a.id=ap.artikel WHERE a.lagerartikel=1 GROUP BY ap.artikel ORDER by 1 DESC LIMIT 14");
        $table->DisplayNew(TOPARTIKEL,"Umsatz","noAction");




        /* umsatz gesamt */
        $table = new EasyTable($this->app);
        /*
           $table->Query("
           SELECT EXTRACT(MONTH FROM a.datum) as month, EXTRACT(YEAR FROM a.datum) as year, SUM(a.soll) 
           FROM rechnung a WHERE a.status!='angelegt' 
           AND a.status!='storniert'
           GROUP By month,year ORDER by year DESC, month DESC");*/

        $table->Query("
            SELECT EXTRACT(MONTH FROM a.datum) as monat, EXTRACT(YEAR FROM a.datum) as jahr, 
            (SELECT SUM(auf.gesamtsumme) FROM auftrag auf
             WHERE EXTRACT(MONTH FROM auf.datum)=monat AND EXTRACT(YEAR FROM auf.datum)=jahr AND auf.status!='storniert' AND auf.status!='angelegt') as auftraege, 

            SUM(a.soll) as rechnungen, 
            (SELECT SUM(g.soll) FROM gutschrift g
             WHERE EXTRACT(MONTH FROM g.datum)=monat AND EXTRACT(YEAR FROM g.datum)=jahr AND g.status!='storniert' AND g.status!='angelegt') as gutschriften, 

            (SUM(a.soll) - IFNULL((SELECT SUM(g.soll) FROM gutschrift g
                                   WHERE EXTRACT(MONTH FROM g.datum)=monat AND EXTRACT(YEAR FROM g.datum)=jahr AND g.status!='storniert' AND g.status!='angelegt'),0) ) as umsatz

            FROM rechnung a WHERE a.status!='angelegt' 
            AND a.status!='storniert' 
            GROUP By monat,jahr ORDER by jahr DESC, monat DESC LIMIT 12");


        $table->DisplayNew(JAHR,"Umsatz","noAction");

        $projektesummen = $this->app->DB->SelectArr("
            SELECT SUM(r.soll)-IFNULL((SELECT SUM(g.soll) FROM gutschrift g WHERE g.status!='storniert' AND g.status!='angelegt' AND EXTRACT(YEAR FROM g.datum)=EXTRACT(YEAR FROM NOW()) AND g.projekt=p.id),0) as summe,p.abkuerzung as projekt, 
            p.farbe as farbe FROM rechnung r LEFT JOIN projekt p ON p.id=r.projekt 
            WHERE r.status!='storniert' AND r.status!='angelegt' AND EXTRACT(YEAR FROM r.datum)=EXTRACT(YEAR FROM NOW()) 
            GROUP By r.projekt");

        $nochmal = false;
        foreach($projektesummen as $key=>$value)
        {
          if($nochmal) $projektesummenwerte .=',';
          if($value['projekt'] =="")$value['projekt']="ohne Projekt";
          if($value['farbe']=="") $value['farbe']="#eee";

          $projektesummenwerte .='{ label: "'.$value['projekt'].'",  data: [[1,'.$value['summe'].']], color: "'.$value['farbe'].'"}';
          $nochmal = true;
        }
        $this->app->Tpl->Set(UMSATZPIE,$projektesummenwerte);

        // jahres uebersicht projekte
        $table = new EasyTable($this->app);   
        $table->Query("       

            SELECT SUM(a.soll) as rechnungen,

            IFNULL((SELECT SUM(g.soll) FROM gutschrift g WHERE g.status!='storniert' AND g.status!='angelegt' AND EXTRACT(YEAR FROM g.datum)=EXTRACT(YEAR FROM NOW()) AND g.projekt=p.id),0) as gutschriften,

            SUM(a.soll)-IFNULL((SELECT SUM(g.soll) FROM gutschrift g WHERE g.status!='storniert' AND g.status!='angelegt' AND EXTRACT(YEAR FROM g.datum)=EXTRACT(YEAR FROM NOW()) AND g.projekt=p.id),0) as umsatz,

            p.abkuerzung as projekt,COUNT(a.id) as anzahl_rechnungen FROM rechnung a LEFT JOIN projekt p ON p.id=a.projekt  
            WHERE a.status!='angelegt' AND a.status!='storniert' AND EXTRACT(YEAR FROM a.datum)=EXTRACT(YEAR FROM NOW()) 
            GROUP By projekt ORDER by umsatz");                                                                                                        
          $table->DisplayNew(JAHRESUEBERSICHTPROJEKTE,"Anzahl Rechnungen","noAction");                                                                                                                                                   
        // gutschriften  
        $table = new EasyTable($this->app);
        $table->Query("
            SELECT EXTRACT(MONTH FROM a.datum) as month, EXTRACT(YEAR FROM a.datum) as year, FORMAT(SUM(a.soll),2) FROM gutschrift a WHERE (a.status!='storniert'  AND
              a.status!='angelegt')
            GROUP By month,year ORDER by year DESC, month DESC");
        $table->DisplayNew(GUTSCHRIFTJAHR,"Jahr","noAction");

        // angebot  
        $table = new EasyTable($this->app);
        $table->Query("
            SELECT EXTRACT(MONTH FROM a.datum) as month, EXTRACT(YEAR FROM a.datum) as year, FORMAT(SUM(ap.preis*ap.menge),2) FROM angebot a 
            LEFT JOIN angebot_position ap ON a.id=ap.angebot WHERE (a.status!='storniert'  AND
              a.status!='angelegt')
            GROUP By month,year ORDER by year DESC, month DESC");
        $table->DisplayNew(ANGEBOTJAHR,"Jahr","noAction");




        $this->app->Tpl->Parse(JAVASCRIPT,"verkaufszahlengraph2.tpl");
        //$this->app->Tpl->Add(JQUERY,"plotgraph();");
        $this->app->Tpl->Parse(TAB1,"verkaufszahlen_details.tpl");
        $this->app->Tpl->Parse(PAGE,"tabview.tpl");

        return;
  }

  function VerkaufszahlenMenu()
  {
    $id = $this->app->Secure->GetGET("id");


    $this->app->Tpl->Set(KURZUEBERSCHRIFT,"Verkaufszahlen");
    $this->app->erp->MenuEintrag("index.php?module=verkaufszahlen&action=list","&Uuml;bersicht");	
    $this->app->erp->MenuEintrag("index.php?module=verkaufszahlen&action=details","Details");	
    //    $this->app->erp->MenuEintrag("index.php?module=shopimport&action=list","Shopimport");
    //$this->app->Tpl->Add(TABS,"<li><a  href=\"index.php?module=verkaufszahlen&action=list\">&Uuml;bersicht</a></li>");
    //$this->app->Tpl->Add(TABS,"<li><a  href=\"index.php?module=verkaufszahlen&action=partner&id=$id\">Partner</a></li>");
    //$this->app->Tpl->Add(TABS,"<li><a  href=\"index.php\">Zur&uuml;ck zur &Uuml;bersicht</a></li>");
  }




}

?>
