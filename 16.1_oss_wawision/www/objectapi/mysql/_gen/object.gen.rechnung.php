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

class ObjGenRechnung
{

  private  $id;
  private  $datum;
  private  $aborechnung;
  private  $projekt;
  private  $anlegeart;
  private  $belegnr;
  private  $auftrag;
  private  $auftragid;
  private  $bearbeiter;
  private  $freitext;
  private  $internebemerkung;
  private  $status;
  private  $adresse;
  private  $name;
  private  $abteilung;
  private  $unterabteilung;
  private  $strasse;
  private  $adresszusatz;
  private  $ansprechpartner;
  private  $plz;
  private  $ort;
  private  $land;
  private  $ustid;
  private  $ust_befreit;
  private  $ustbrief;
  private  $ustbrief_eingang;
  private  $ustbrief_eingang_am;
  private  $email;
  private  $telefon;
  private  $telefax;
  private  $betreff;
  private  $kundennummer;
  private  $lieferschein;
  private  $versandart;
  private  $lieferdatum;
  private  $buchhaltung;
  private  $zahlungsweise;
  private  $zahlungsstatus;
  private  $ist;
  private  $soll;
  private  $skonto_gegeben;
  private  $zahlungszieltage;
  private  $zahlungszieltageskonto;
  private  $zahlungszielskonto;
  private  $firma;
  private  $versendet;
  private  $versendet_am;
  private  $versendet_per;
  private  $versendet_durch;
  private  $versendet_mahnwesen;
  private  $mahnwesen;
  private  $mahnwesen_datum;
  private  $mahnwesen_gesperrt;
  private  $mahnwesen_internebemerkung;
  private  $inbearbeitung;
  private  $datev_abgeschlossen;
  private  $logdatei;
  private  $doppel;
  private  $autodruck_rz;
  private  $autodruck_periode;
  private  $autodruck_done;
  private  $autodruck_anzahlverband;
  private  $autodruck_anzahlkunde;
  private  $autodruck_mailverband;
  private  $autodruck_mailkunde;
  private  $dta_datei_verband;
  private  $dta_datei;
  private  $deckungsbeitragcalc;
  private  $deckungsbeitrag;
  private  $umsatz_netto;
  private  $erloes_netto;
  private  $mahnwesenfestsetzen;
  private  $vertriebid;
  private  $aktion;
  private  $vertrieb;
  private  $provision;
  private  $provision_summe;
  private  $gruppe;
  private  $punkte;
  private  $bonuspunkte;
  private  $provdatum;
  private  $ihrebestellnummer;
  private  $anschreiben;
  private  $usereditid;
  private  $useredittimestamp;
  private  $realrabatt;
  private  $rabatt;
  private  $einzugsdatum;
  private  $rabatt1;
  private  $rabatt2;
  private  $rabatt3;
  private  $rabatt4;
  private  $rabatt5;
  private  $forderungsverlust_datum;
  private  $forderungsverlust_betrag;
  private  $steuersatz_normal;
  private  $steuersatz_zwischen;
  private  $steuersatz_ermaessigt;
  private  $steuersatz_starkermaessigt;
  private  $steuersatz_dienstleistung;
  private  $waehrung;
  private  $keinsteuersatz;
  private  $schreibschutz;
  private  $pdfarchiviert;
  private  $pdfarchiviertversion;
  private  $typ;
  private  $ohne_briefpapier;
  private  $lieferid;
  private  $ansprechpartnerid;
  private  $systemfreitext;
  private  $projektfiliale;

  public $app;            //application object 

  public function ObjGenRechnung($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM rechnung WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->datum=$result['datum'];
    $this->aborechnung=$result['aborechnung'];
    $this->projekt=$result['projekt'];
    $this->anlegeart=$result['anlegeart'];
    $this->belegnr=$result['belegnr'];
    $this->auftrag=$result['auftrag'];
    $this->auftragid=$result['auftragid'];
    $this->bearbeiter=$result['bearbeiter'];
    $this->freitext=$result['freitext'];
    $this->internebemerkung=$result['internebemerkung'];
    $this->status=$result['status'];
    $this->adresse=$result['adresse'];
    $this->name=$result['name'];
    $this->abteilung=$result['abteilung'];
    $this->unterabteilung=$result['unterabteilung'];
    $this->strasse=$result['strasse'];
    $this->adresszusatz=$result['adresszusatz'];
    $this->ansprechpartner=$result['ansprechpartner'];
    $this->plz=$result['plz'];
    $this->ort=$result['ort'];
    $this->land=$result['land'];
    $this->ustid=$result['ustid'];
    $this->ust_befreit=$result['ust_befreit'];
    $this->ustbrief=$result['ustbrief'];
    $this->ustbrief_eingang=$result['ustbrief_eingang'];
    $this->ustbrief_eingang_am=$result['ustbrief_eingang_am'];
    $this->email=$result['email'];
    $this->telefon=$result['telefon'];
    $this->telefax=$result['telefax'];
    $this->betreff=$result['betreff'];
    $this->kundennummer=$result['kundennummer'];
    $this->lieferschein=$result['lieferschein'];
    $this->versandart=$result['versandart'];
    $this->lieferdatum=$result['lieferdatum'];
    $this->buchhaltung=$result['buchhaltung'];
    $this->zahlungsweise=$result['zahlungsweise'];
    $this->zahlungsstatus=$result['zahlungsstatus'];
    $this->ist=$result['ist'];
    $this->soll=$result['soll'];
    $this->skonto_gegeben=$result['skonto_gegeben'];
    $this->zahlungszieltage=$result['zahlungszieltage'];
    $this->zahlungszieltageskonto=$result['zahlungszieltageskonto'];
    $this->zahlungszielskonto=$result['zahlungszielskonto'];
    $this->firma=$result['firma'];
    $this->versendet=$result['versendet'];
    $this->versendet_am=$result['versendet_am'];
    $this->versendet_per=$result['versendet_per'];
    $this->versendet_durch=$result['versendet_durch'];
    $this->versendet_mahnwesen=$result['versendet_mahnwesen'];
    $this->mahnwesen=$result['mahnwesen'];
    $this->mahnwesen_datum=$result['mahnwesen_datum'];
    $this->mahnwesen_gesperrt=$result['mahnwesen_gesperrt'];
    $this->mahnwesen_internebemerkung=$result['mahnwesen_internebemerkung'];
    $this->inbearbeitung=$result['inbearbeitung'];
    $this->datev_abgeschlossen=$result['datev_abgeschlossen'];
    $this->logdatei=$result['logdatei'];
    $this->doppel=$result['doppel'];
    $this->autodruck_rz=$result['autodruck_rz'];
    $this->autodruck_periode=$result['autodruck_periode'];
    $this->autodruck_done=$result['autodruck_done'];
    $this->autodruck_anzahlverband=$result['autodruck_anzahlverband'];
    $this->autodruck_anzahlkunde=$result['autodruck_anzahlkunde'];
    $this->autodruck_mailverband=$result['autodruck_mailverband'];
    $this->autodruck_mailkunde=$result['autodruck_mailkunde'];
    $this->dta_datei_verband=$result['dta_datei_verband'];
    $this->dta_datei=$result['dta_datei'];
    $this->deckungsbeitragcalc=$result['deckungsbeitragcalc'];
    $this->deckungsbeitrag=$result['deckungsbeitrag'];
    $this->umsatz_netto=$result['umsatz_netto'];
    $this->erloes_netto=$result['erloes_netto'];
    $this->mahnwesenfestsetzen=$result['mahnwesenfestsetzen'];
    $this->vertriebid=$result['vertriebid'];
    $this->aktion=$result['aktion'];
    $this->vertrieb=$result['vertrieb'];
    $this->provision=$result['provision'];
    $this->provision_summe=$result['provision_summe'];
    $this->gruppe=$result['gruppe'];
    $this->punkte=$result['punkte'];
    $this->bonuspunkte=$result['bonuspunkte'];
    $this->provdatum=$result['provdatum'];
    $this->ihrebestellnummer=$result['ihrebestellnummer'];
    $this->anschreiben=$result['anschreiben'];
    $this->usereditid=$result['usereditid'];
    $this->useredittimestamp=$result['useredittimestamp'];
    $this->realrabatt=$result['realrabatt'];
    $this->rabatt=$result['rabatt'];
    $this->einzugsdatum=$result['einzugsdatum'];
    $this->rabatt1=$result['rabatt1'];
    $this->rabatt2=$result['rabatt2'];
    $this->rabatt3=$result['rabatt3'];
    $this->rabatt4=$result['rabatt4'];
    $this->rabatt5=$result['rabatt5'];
    $this->forderungsverlust_datum=$result['forderungsverlust_datum'];
    $this->forderungsverlust_betrag=$result['forderungsverlust_betrag'];
    $this->steuersatz_normal=$result['steuersatz_normal'];
    $this->steuersatz_zwischen=$result['steuersatz_zwischen'];
    $this->steuersatz_ermaessigt=$result['steuersatz_ermaessigt'];
    $this->steuersatz_starkermaessigt=$result['steuersatz_starkermaessigt'];
    $this->steuersatz_dienstleistung=$result['steuersatz_dienstleistung'];
    $this->waehrung=$result['waehrung'];
    $this->keinsteuersatz=$result['keinsteuersatz'];
    $this->schreibschutz=$result['schreibschutz'];
    $this->pdfarchiviert=$result['pdfarchiviert'];
    $this->pdfarchiviertversion=$result['pdfarchiviertversion'];
    $this->typ=$result['typ'];
    $this->ohne_briefpapier=$result['ohne_briefpapier'];
    $this->lieferid=$result['lieferid'];
    $this->ansprechpartnerid=$result['ansprechpartnerid'];
    $this->systemfreitext=$result['systemfreitext'];
    $this->projektfiliale=$result['projektfiliale'];
  }

  public function Create()
  {
    $sql = "INSERT INTO rechnung (id,datum,aborechnung,projekt,anlegeart,belegnr,auftrag,auftragid,bearbeiter,freitext,internebemerkung,status,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,ansprechpartner,plz,ort,land,ustid,ust_befreit,ustbrief,ustbrief_eingang,ustbrief_eingang_am,email,telefon,telefax,betreff,kundennummer,lieferschein,versandart,lieferdatum,buchhaltung,zahlungsweise,zahlungsstatus,ist,soll,skonto_gegeben,zahlungszieltage,zahlungszieltageskonto,zahlungszielskonto,firma,versendet,versendet_am,versendet_per,versendet_durch,versendet_mahnwesen,mahnwesen,mahnwesen_datum,mahnwesen_gesperrt,mahnwesen_internebemerkung,inbearbeitung,datev_abgeschlossen,logdatei,doppel,autodruck_rz,autodruck_periode,autodruck_done,autodruck_anzahlverband,autodruck_anzahlkunde,autodruck_mailverband,autodruck_mailkunde,dta_datei_verband,dta_datei,deckungsbeitragcalc,deckungsbeitrag,umsatz_netto,erloes_netto,mahnwesenfestsetzen,vertriebid,aktion,vertrieb,provision,provision_summe,gruppe,punkte,bonuspunkte,provdatum,ihrebestellnummer,anschreiben,usereditid,useredittimestamp,realrabatt,rabatt,einzugsdatum,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,forderungsverlust_datum,forderungsverlust_betrag,steuersatz_normal,steuersatz_zwischen,steuersatz_ermaessigt,steuersatz_starkermaessigt,steuersatz_dienstleistung,waehrung,keinsteuersatz,schreibschutz,pdfarchiviert,pdfarchiviertversion,typ,ohne_briefpapier,lieferid,ansprechpartnerid,systemfreitext,projektfiliale)
      VALUES('','{$this->datum}','{$this->aborechnung}','{$this->projekt}','{$this->anlegeart}','{$this->belegnr}','{$this->auftrag}','{$this->auftragid}','{$this->bearbeiter}','{$this->freitext}','{$this->internebemerkung}','{$this->status}','{$this->adresse}','{$this->name}','{$this->abteilung}','{$this->unterabteilung}','{$this->strasse}','{$this->adresszusatz}','{$this->ansprechpartner}','{$this->plz}','{$this->ort}','{$this->land}','{$this->ustid}','{$this->ust_befreit}','{$this->ustbrief}','{$this->ustbrief_eingang}','{$this->ustbrief_eingang_am}','{$this->email}','{$this->telefon}','{$this->telefax}','{$this->betreff}','{$this->kundennummer}','{$this->lieferschein}','{$this->versandart}','{$this->lieferdatum}','{$this->buchhaltung}','{$this->zahlungsweise}','{$this->zahlungsstatus}','{$this->ist}','{$this->soll}','{$this->skonto_gegeben}','{$this->zahlungszieltage}','{$this->zahlungszieltageskonto}','{$this->zahlungszielskonto}','{$this->firma}','{$this->versendet}','{$this->versendet_am}','{$this->versendet_per}','{$this->versendet_durch}','{$this->versendet_mahnwesen}','{$this->mahnwesen}','{$this->mahnwesen_datum}','{$this->mahnwesen_gesperrt}','{$this->mahnwesen_internebemerkung}','{$this->inbearbeitung}','{$this->datev_abgeschlossen}','{$this->logdatei}','{$this->doppel}','{$this->autodruck_rz}','{$this->autodruck_periode}','{$this->autodruck_done}','{$this->autodruck_anzahlverband}','{$this->autodruck_anzahlkunde}','{$this->autodruck_mailverband}','{$this->autodruck_mailkunde}','{$this->dta_datei_verband}','{$this->dta_datei}','{$this->deckungsbeitragcalc}','{$this->deckungsbeitrag}','{$this->umsatz_netto}','{$this->erloes_netto}','{$this->mahnwesenfestsetzen}','{$this->vertriebid}','{$this->aktion}','{$this->vertrieb}','{$this->provision}','{$this->provision_summe}','{$this->gruppe}','{$this->punkte}','{$this->bonuspunkte}','{$this->provdatum}','{$this->ihrebestellnummer}','{$this->anschreiben}','{$this->usereditid}','{$this->useredittimestamp}','{$this->realrabatt}','{$this->rabatt}','{$this->einzugsdatum}','{$this->rabatt1}','{$this->rabatt2}','{$this->rabatt3}','{$this->rabatt4}','{$this->rabatt5}','{$this->forderungsverlust_datum}','{$this->forderungsverlust_betrag}','{$this->steuersatz_normal}','{$this->steuersatz_zwischen}','{$this->steuersatz_ermaessigt}','{$this->steuersatz_starkermaessigt}','{$this->steuersatz_dienstleistung}','{$this->waehrung}','{$this->keinsteuersatz}','{$this->schreibschutz}','{$this->pdfarchiviert}','{$this->pdfarchiviertversion}','{$this->typ}','{$this->ohne_briefpapier}','{$this->lieferid}','{$this->ansprechpartnerid}','{$this->systemfreitext}','{$this->projektfiliale}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE rechnung SET
      datum='{$this->datum}',
      aborechnung='{$this->aborechnung}',
      projekt='{$this->projekt}',
      anlegeart='{$this->anlegeart}',
      belegnr='{$this->belegnr}',
      auftrag='{$this->auftrag}',
      auftragid='{$this->auftragid}',
      bearbeiter='{$this->bearbeiter}',
      freitext='{$this->freitext}',
      internebemerkung='{$this->internebemerkung}',
      status='{$this->status}',
      adresse='{$this->adresse}',
      name='{$this->name}',
      abteilung='{$this->abteilung}',
      unterabteilung='{$this->unterabteilung}',
      strasse='{$this->strasse}',
      adresszusatz='{$this->adresszusatz}',
      ansprechpartner='{$this->ansprechpartner}',
      plz='{$this->plz}',
      ort='{$this->ort}',
      land='{$this->land}',
      ustid='{$this->ustid}',
      ust_befreit='{$this->ust_befreit}',
      ustbrief='{$this->ustbrief}',
      ustbrief_eingang='{$this->ustbrief_eingang}',
      ustbrief_eingang_am='{$this->ustbrief_eingang_am}',
      email='{$this->email}',
      telefon='{$this->telefon}',
      telefax='{$this->telefax}',
      betreff='{$this->betreff}',
      kundennummer='{$this->kundennummer}',
      lieferschein='{$this->lieferschein}',
      versandart='{$this->versandart}',
      lieferdatum='{$this->lieferdatum}',
      buchhaltung='{$this->buchhaltung}',
      zahlungsweise='{$this->zahlungsweise}',
      zahlungsstatus='{$this->zahlungsstatus}',
      ist='{$this->ist}',
      soll='{$this->soll}',
      skonto_gegeben='{$this->skonto_gegeben}',
      zahlungszieltage='{$this->zahlungszieltage}',
      zahlungszieltageskonto='{$this->zahlungszieltageskonto}',
      zahlungszielskonto='{$this->zahlungszielskonto}',
      firma='{$this->firma}',
      versendet='{$this->versendet}',
      versendet_am='{$this->versendet_am}',
      versendet_per='{$this->versendet_per}',
      versendet_durch='{$this->versendet_durch}',
      versendet_mahnwesen='{$this->versendet_mahnwesen}',
      mahnwesen='{$this->mahnwesen}',
      mahnwesen_datum='{$this->mahnwesen_datum}',
      mahnwesen_gesperrt='{$this->mahnwesen_gesperrt}',
      mahnwesen_internebemerkung='{$this->mahnwesen_internebemerkung}',
      inbearbeitung='{$this->inbearbeitung}',
      datev_abgeschlossen='{$this->datev_abgeschlossen}',
      logdatei='{$this->logdatei}',
      doppel='{$this->doppel}',
      autodruck_rz='{$this->autodruck_rz}',
      autodruck_periode='{$this->autodruck_periode}',
      autodruck_done='{$this->autodruck_done}',
      autodruck_anzahlverband='{$this->autodruck_anzahlverband}',
      autodruck_anzahlkunde='{$this->autodruck_anzahlkunde}',
      autodruck_mailverband='{$this->autodruck_mailverband}',
      autodruck_mailkunde='{$this->autodruck_mailkunde}',
      dta_datei_verband='{$this->dta_datei_verband}',
      dta_datei='{$this->dta_datei}',
      deckungsbeitragcalc='{$this->deckungsbeitragcalc}',
      deckungsbeitrag='{$this->deckungsbeitrag}',
      umsatz_netto='{$this->umsatz_netto}',
      erloes_netto='{$this->erloes_netto}',
      mahnwesenfestsetzen='{$this->mahnwesenfestsetzen}',
      vertriebid='{$this->vertriebid}',
      aktion='{$this->aktion}',
      vertrieb='{$this->vertrieb}',
      provision='{$this->provision}',
      provision_summe='{$this->provision_summe}',
      gruppe='{$this->gruppe}',
      punkte='{$this->punkte}',
      bonuspunkte='{$this->bonuspunkte}',
      provdatum='{$this->provdatum}',
      ihrebestellnummer='{$this->ihrebestellnummer}',
      anschreiben='{$this->anschreiben}',
      usereditid='{$this->usereditid}',
      useredittimestamp='{$this->useredittimestamp}',
      realrabatt='{$this->realrabatt}',
      rabatt='{$this->rabatt}',
      einzugsdatum='{$this->einzugsdatum}',
      rabatt1='{$this->rabatt1}',
      rabatt2='{$this->rabatt2}',
      rabatt3='{$this->rabatt3}',
      rabatt4='{$this->rabatt4}',
      rabatt5='{$this->rabatt5}',
      forderungsverlust_datum='{$this->forderungsverlust_datum}',
      forderungsverlust_betrag='{$this->forderungsverlust_betrag}',
      steuersatz_normal='{$this->steuersatz_normal}',
      steuersatz_zwischen='{$this->steuersatz_zwischen}',
      steuersatz_ermaessigt='{$this->steuersatz_ermaessigt}',
      steuersatz_starkermaessigt='{$this->steuersatz_starkermaessigt}',
      steuersatz_dienstleistung='{$this->steuersatz_dienstleistung}',
      waehrung='{$this->waehrung}',
      keinsteuersatz='{$this->keinsteuersatz}',
      schreibschutz='{$this->schreibschutz}',
      pdfarchiviert='{$this->pdfarchiviert}',
      pdfarchiviertversion='{$this->pdfarchiviertversion}',
      typ='{$this->typ}',
      ohne_briefpapier='{$this->ohne_briefpapier}',
      lieferid='{$this->lieferid}',
      ansprechpartnerid='{$this->ansprechpartnerid}',
      systemfreitext='{$this->systemfreitext}',
      projektfiliale='{$this->projektfiliale}'
      WHERE (id='{$this->id}')";

    $this->app->DB->Update($sql);
  }

  public function Delete($id="")
  {
    if(is_numeric($id))
    {
      $this->id=$id;
    }
    else
      return -1;

    $sql = "DELETE FROM rechnung WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->datum="";
    $this->aborechnung="";
    $this->projekt="";
    $this->anlegeart="";
    $this->belegnr="";
    $this->auftrag="";
    $this->auftragid="";
    $this->bearbeiter="";
    $this->freitext="";
    $this->internebemerkung="";
    $this->status="";
    $this->adresse="";
    $this->name="";
    $this->abteilung="";
    $this->unterabteilung="";
    $this->strasse="";
    $this->adresszusatz="";
    $this->ansprechpartner="";
    $this->plz="";
    $this->ort="";
    $this->land="";
    $this->ustid="";
    $this->ust_befreit="";
    $this->ustbrief="";
    $this->ustbrief_eingang="";
    $this->ustbrief_eingang_am="";
    $this->email="";
    $this->telefon="";
    $this->telefax="";
    $this->betreff="";
    $this->kundennummer="";
    $this->lieferschein="";
    $this->versandart="";
    $this->lieferdatum="";
    $this->buchhaltung="";
    $this->zahlungsweise="";
    $this->zahlungsstatus="";
    $this->ist="";
    $this->soll="";
    $this->skonto_gegeben="";
    $this->zahlungszieltage="";
    $this->zahlungszieltageskonto="";
    $this->zahlungszielskonto="";
    $this->firma="";
    $this->versendet="";
    $this->versendet_am="";
    $this->versendet_per="";
    $this->versendet_durch="";
    $this->versendet_mahnwesen="";
    $this->mahnwesen="";
    $this->mahnwesen_datum="";
    $this->mahnwesen_gesperrt="";
    $this->mahnwesen_internebemerkung="";
    $this->inbearbeitung="";
    $this->datev_abgeschlossen="";
    $this->logdatei="";
    $this->doppel="";
    $this->autodruck_rz="";
    $this->autodruck_periode="";
    $this->autodruck_done="";
    $this->autodruck_anzahlverband="";
    $this->autodruck_anzahlkunde="";
    $this->autodruck_mailverband="";
    $this->autodruck_mailkunde="";
    $this->dta_datei_verband="";
    $this->dta_datei="";
    $this->deckungsbeitragcalc="";
    $this->deckungsbeitrag="";
    $this->umsatz_netto="";
    $this->erloes_netto="";
    $this->mahnwesenfestsetzen="";
    $this->vertriebid="";
    $this->aktion="";
    $this->vertrieb="";
    $this->provision="";
    $this->provision_summe="";
    $this->gruppe="";
    $this->punkte="";
    $this->bonuspunkte="";
    $this->provdatum="";
    $this->ihrebestellnummer="";
    $this->anschreiben="";
    $this->usereditid="";
    $this->useredittimestamp="";
    $this->realrabatt="";
    $this->rabatt="";
    $this->einzugsdatum="";
    $this->rabatt1="";
    $this->rabatt2="";
    $this->rabatt3="";
    $this->rabatt4="";
    $this->rabatt5="";
    $this->forderungsverlust_datum="";
    $this->forderungsverlust_betrag="";
    $this->steuersatz_normal="";
    $this->steuersatz_zwischen="";
    $this->steuersatz_ermaessigt="";
    $this->steuersatz_starkermaessigt="";
    $this->steuersatz_dienstleistung="";
    $this->waehrung="";
    $this->keinsteuersatz="";
    $this->schreibschutz="";
    $this->pdfarchiviert="";
    $this->pdfarchiviertversion="";
    $this->typ="";
    $this->ohne_briefpapier="";
    $this->lieferid="";
    $this->ansprechpartnerid="";
    $this->systemfreitext="";
    $this->projektfiliale="";
  }

  public function Copy()
  {
    $this->id = "";
    $this->Create();
  }

 /** 
   Mit dieser Funktion kann man einen Datensatz suchen 
   dafuer muss man die Attribute setzen nach denen gesucht werden soll
   dann kriegt man als ergebnis den ersten Datensatz der auf die Suche uebereinstimmt
   zurueck. Mit Next() kann man sich alle weiteren Ergebnisse abholen
   **/ 

  public function Find()
  {
    //TODO Suche mit den werten machen
  }

  public function FindNext()
  {
    //TODO Suche mit den alten werten fortsetzen machen
  }

 /** Funktionen um durch die Tabelle iterieren zu koennen */ 

  public function Next()
  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer
  }

  public function First()
  {
    //TODO: SQL Statement passt nach meiner Meinung nach noch nicht immer
  }

 /** dank dieser funktionen kann man die tatsaechlichen werte einfach 
  ueberladen (in einem Objekt das mit seiner klasse ueber dieser steht)**/ 

  function SetId($value) { $this->id=$value; }
  function GetId() { return $this->id; }
  function SetDatum($value) { $this->datum=$value; }
  function GetDatum() { return $this->datum; }
  function SetAborechnung($value) { $this->aborechnung=$value; }
  function GetAborechnung() { return $this->aborechnung; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetAnlegeart($value) { $this->anlegeart=$value; }
  function GetAnlegeart() { return $this->anlegeart; }
  function SetBelegnr($value) { $this->belegnr=$value; }
  function GetBelegnr() { return $this->belegnr; }
  function SetAuftrag($value) { $this->auftrag=$value; }
  function GetAuftrag() { return $this->auftrag; }
  function SetAuftragid($value) { $this->auftragid=$value; }
  function GetAuftragid() { return $this->auftragid; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetFreitext($value) { $this->freitext=$value; }
  function GetFreitext() { return $this->freitext; }
  function SetInternebemerkung($value) { $this->internebemerkung=$value; }
  function GetInternebemerkung() { return $this->internebemerkung; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetAdresse($value) { $this->adresse=$value; }
  function GetAdresse() { return $this->adresse; }
  function SetName($value) { $this->name=$value; }
  function GetName() { return $this->name; }
  function SetAbteilung($value) { $this->abteilung=$value; }
  function GetAbteilung() { return $this->abteilung; }
  function SetUnterabteilung($value) { $this->unterabteilung=$value; }
  function GetUnterabteilung() { return $this->unterabteilung; }
  function SetStrasse($value) { $this->strasse=$value; }
  function GetStrasse() { return $this->strasse; }
  function SetAdresszusatz($value) { $this->adresszusatz=$value; }
  function GetAdresszusatz() { return $this->adresszusatz; }
  function SetAnsprechpartner($value) { $this->ansprechpartner=$value; }
  function GetAnsprechpartner() { return $this->ansprechpartner; }
  function SetPlz($value) { $this->plz=$value; }
  function GetPlz() { return $this->plz; }
  function SetOrt($value) { $this->ort=$value; }
  function GetOrt() { return $this->ort; }
  function SetLand($value) { $this->land=$value; }
  function GetLand() { return $this->land; }
  function SetUstid($value) { $this->ustid=$value; }
  function GetUstid() { return $this->ustid; }
  function SetUst_Befreit($value) { $this->ust_befreit=$value; }
  function GetUst_Befreit() { return $this->ust_befreit; }
  function SetUstbrief($value) { $this->ustbrief=$value; }
  function GetUstbrief() { return $this->ustbrief; }
  function SetUstbrief_Eingang($value) { $this->ustbrief_eingang=$value; }
  function GetUstbrief_Eingang() { return $this->ustbrief_eingang; }
  function SetUstbrief_Eingang_Am($value) { $this->ustbrief_eingang_am=$value; }
  function GetUstbrief_Eingang_Am() { return $this->ustbrief_eingang_am; }
  function SetEmail($value) { $this->email=$value; }
  function GetEmail() { return $this->email; }
  function SetTelefon($value) { $this->telefon=$value; }
  function GetTelefon() { return $this->telefon; }
  function SetTelefax($value) { $this->telefax=$value; }
  function GetTelefax() { return $this->telefax; }
  function SetBetreff($value) { $this->betreff=$value; }
  function GetBetreff() { return $this->betreff; }
  function SetKundennummer($value) { $this->kundennummer=$value; }
  function GetKundennummer() { return $this->kundennummer; }
  function SetLieferschein($value) { $this->lieferschein=$value; }
  function GetLieferschein() { return $this->lieferschein; }
  function SetVersandart($value) { $this->versandart=$value; }
  function GetVersandart() { return $this->versandart; }
  function SetLieferdatum($value) { $this->lieferdatum=$value; }
  function GetLieferdatum() { return $this->lieferdatum; }
  function SetBuchhaltung($value) { $this->buchhaltung=$value; }
  function GetBuchhaltung() { return $this->buchhaltung; }
  function SetZahlungsweise($value) { $this->zahlungsweise=$value; }
  function GetZahlungsweise() { return $this->zahlungsweise; }
  function SetZahlungsstatus($value) { $this->zahlungsstatus=$value; }
  function GetZahlungsstatus() { return $this->zahlungsstatus; }
  function SetIst($value) { $this->ist=$value; }
  function GetIst() { return $this->ist; }
  function SetSoll($value) { $this->soll=$value; }
  function GetSoll() { return $this->soll; }
  function SetSkonto_Gegeben($value) { $this->skonto_gegeben=$value; }
  function GetSkonto_Gegeben() { return $this->skonto_gegeben; }
  function SetZahlungszieltage($value) { $this->zahlungszieltage=$value; }
  function GetZahlungszieltage() { return $this->zahlungszieltage; }
  function SetZahlungszieltageskonto($value) { $this->zahlungszieltageskonto=$value; }
  function GetZahlungszieltageskonto() { return $this->zahlungszieltageskonto; }
  function SetZahlungszielskonto($value) { $this->zahlungszielskonto=$value; }
  function GetZahlungszielskonto() { return $this->zahlungszielskonto; }
  function SetFirma($value) { $this->firma=$value; }
  function GetFirma() { return $this->firma; }
  function SetVersendet($value) { $this->versendet=$value; }
  function GetVersendet() { return $this->versendet; }
  function SetVersendet_Am($value) { $this->versendet_am=$value; }
  function GetVersendet_Am() { return $this->versendet_am; }
  function SetVersendet_Per($value) { $this->versendet_per=$value; }
  function GetVersendet_Per() { return $this->versendet_per; }
  function SetVersendet_Durch($value) { $this->versendet_durch=$value; }
  function GetVersendet_Durch() { return $this->versendet_durch; }
  function SetVersendet_Mahnwesen($value) { $this->versendet_mahnwesen=$value; }
  function GetVersendet_Mahnwesen() { return $this->versendet_mahnwesen; }
  function SetMahnwesen($value) { $this->mahnwesen=$value; }
  function GetMahnwesen() { return $this->mahnwesen; }
  function SetMahnwesen_Datum($value) { $this->mahnwesen_datum=$value; }
  function GetMahnwesen_Datum() { return $this->mahnwesen_datum; }
  function SetMahnwesen_Gesperrt($value) { $this->mahnwesen_gesperrt=$value; }
  function GetMahnwesen_Gesperrt() { return $this->mahnwesen_gesperrt; }
  function SetMahnwesen_Internebemerkung($value) { $this->mahnwesen_internebemerkung=$value; }
  function GetMahnwesen_Internebemerkung() { return $this->mahnwesen_internebemerkung; }
  function SetInbearbeitung($value) { $this->inbearbeitung=$value; }
  function GetInbearbeitung() { return $this->inbearbeitung; }
  function SetDatev_Abgeschlossen($value) { $this->datev_abgeschlossen=$value; }
  function GetDatev_Abgeschlossen() { return $this->datev_abgeschlossen; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetDoppel($value) { $this->doppel=$value; }
  function GetDoppel() { return $this->doppel; }
  function SetAutodruck_Rz($value) { $this->autodruck_rz=$value; }
  function GetAutodruck_Rz() { return $this->autodruck_rz; }
  function SetAutodruck_Periode($value) { $this->autodruck_periode=$value; }
  function GetAutodruck_Periode() { return $this->autodruck_periode; }
  function SetAutodruck_Done($value) { $this->autodruck_done=$value; }
  function GetAutodruck_Done() { return $this->autodruck_done; }
  function SetAutodruck_Anzahlverband($value) { $this->autodruck_anzahlverband=$value; }
  function GetAutodruck_Anzahlverband() { return $this->autodruck_anzahlverband; }
  function SetAutodruck_Anzahlkunde($value) { $this->autodruck_anzahlkunde=$value; }
  function GetAutodruck_Anzahlkunde() { return $this->autodruck_anzahlkunde; }
  function SetAutodruck_Mailverband($value) { $this->autodruck_mailverband=$value; }
  function GetAutodruck_Mailverband() { return $this->autodruck_mailverband; }
  function SetAutodruck_Mailkunde($value) { $this->autodruck_mailkunde=$value; }
  function GetAutodruck_Mailkunde() { return $this->autodruck_mailkunde; }
  function SetDta_Datei_Verband($value) { $this->dta_datei_verband=$value; }
  function GetDta_Datei_Verband() { return $this->dta_datei_verband; }
  function SetDta_Datei($value) { $this->dta_datei=$value; }
  function GetDta_Datei() { return $this->dta_datei; }
  function SetDeckungsbeitragcalc($value) { $this->deckungsbeitragcalc=$value; }
  function GetDeckungsbeitragcalc() { return $this->deckungsbeitragcalc; }
  function SetDeckungsbeitrag($value) { $this->deckungsbeitrag=$value; }
  function GetDeckungsbeitrag() { return $this->deckungsbeitrag; }
  function SetUmsatz_Netto($value) { $this->umsatz_netto=$value; }
  function GetUmsatz_Netto() { return $this->umsatz_netto; }
  function SetErloes_Netto($value) { $this->erloes_netto=$value; }
  function GetErloes_Netto() { return $this->erloes_netto; }
  function SetMahnwesenfestsetzen($value) { $this->mahnwesenfestsetzen=$value; }
  function GetMahnwesenfestsetzen() { return $this->mahnwesenfestsetzen; }
  function SetVertriebid($value) { $this->vertriebid=$value; }
  function GetVertriebid() { return $this->vertriebid; }
  function SetAktion($value) { $this->aktion=$value; }
  function GetAktion() { return $this->aktion; }
  function SetVertrieb($value) { $this->vertrieb=$value; }
  function GetVertrieb() { return $this->vertrieb; }
  function SetProvision($value) { $this->provision=$value; }
  function GetProvision() { return $this->provision; }
  function SetProvision_Summe($value) { $this->provision_summe=$value; }
  function GetProvision_Summe() { return $this->provision_summe; }
  function SetGruppe($value) { $this->gruppe=$value; }
  function GetGruppe() { return $this->gruppe; }
  function SetPunkte($value) { $this->punkte=$value; }
  function GetPunkte() { return $this->punkte; }
  function SetBonuspunkte($value) { $this->bonuspunkte=$value; }
  function GetBonuspunkte() { return $this->bonuspunkte; }
  function SetProvdatum($value) { $this->provdatum=$value; }
  function GetProvdatum() { return $this->provdatum; }
  function SetIhrebestellnummer($value) { $this->ihrebestellnummer=$value; }
  function GetIhrebestellnummer() { return $this->ihrebestellnummer; }
  function SetAnschreiben($value) { $this->anschreiben=$value; }
  function GetAnschreiben() { return $this->anschreiben; }
  function SetUsereditid($value) { $this->usereditid=$value; }
  function GetUsereditid() { return $this->usereditid; }
  function SetUseredittimestamp($value) { $this->useredittimestamp=$value; }
  function GetUseredittimestamp() { return $this->useredittimestamp; }
  function SetRealrabatt($value) { $this->realrabatt=$value; }
  function GetRealrabatt() { return $this->realrabatt; }
  function SetRabatt($value) { $this->rabatt=$value; }
  function GetRabatt() { return $this->rabatt; }
  function SetEinzugsdatum($value) { $this->einzugsdatum=$value; }
  function GetEinzugsdatum() { return $this->einzugsdatum; }
  function SetRabatt1($value) { $this->rabatt1=$value; }
  function GetRabatt1() { return $this->rabatt1; }
  function SetRabatt2($value) { $this->rabatt2=$value; }
  function GetRabatt2() { return $this->rabatt2; }
  function SetRabatt3($value) { $this->rabatt3=$value; }
  function GetRabatt3() { return $this->rabatt3; }
  function SetRabatt4($value) { $this->rabatt4=$value; }
  function GetRabatt4() { return $this->rabatt4; }
  function SetRabatt5($value) { $this->rabatt5=$value; }
  function GetRabatt5() { return $this->rabatt5; }
  function SetForderungsverlust_Datum($value) { $this->forderungsverlust_datum=$value; }
  function GetForderungsverlust_Datum() { return $this->forderungsverlust_datum; }
  function SetForderungsverlust_Betrag($value) { $this->forderungsverlust_betrag=$value; }
  function GetForderungsverlust_Betrag() { return $this->forderungsverlust_betrag; }
  function SetSteuersatz_Normal($value) { $this->steuersatz_normal=$value; }
  function GetSteuersatz_Normal() { return $this->steuersatz_normal; }
  function SetSteuersatz_Zwischen($value) { $this->steuersatz_zwischen=$value; }
  function GetSteuersatz_Zwischen() { return $this->steuersatz_zwischen; }
  function SetSteuersatz_Ermaessigt($value) { $this->steuersatz_ermaessigt=$value; }
  function GetSteuersatz_Ermaessigt() { return $this->steuersatz_ermaessigt; }
  function SetSteuersatz_Starkermaessigt($value) { $this->steuersatz_starkermaessigt=$value; }
  function GetSteuersatz_Starkermaessigt() { return $this->steuersatz_starkermaessigt; }
  function SetSteuersatz_Dienstleistung($value) { $this->steuersatz_dienstleistung=$value; }
  function GetSteuersatz_Dienstleistung() { return $this->steuersatz_dienstleistung; }
  function SetWaehrung($value) { $this->waehrung=$value; }
  function GetWaehrung() { return $this->waehrung; }
  function SetKeinsteuersatz($value) { $this->keinsteuersatz=$value; }
  function GetKeinsteuersatz() { return $this->keinsteuersatz; }
  function SetSchreibschutz($value) { $this->schreibschutz=$value; }
  function GetSchreibschutz() { return $this->schreibschutz; }
  function SetPdfarchiviert($value) { $this->pdfarchiviert=$value; }
  function GetPdfarchiviert() { return $this->pdfarchiviert; }
  function SetPdfarchiviertversion($value) { $this->pdfarchiviertversion=$value; }
  function GetPdfarchiviertversion() { return $this->pdfarchiviertversion; }
  function SetTyp($value) { $this->typ=$value; }
  function GetTyp() { return $this->typ; }
  function SetOhne_Briefpapier($value) { $this->ohne_briefpapier=$value; }
  function GetOhne_Briefpapier() { return $this->ohne_briefpapier; }
  function SetLieferid($value) { $this->lieferid=$value; }
  function GetLieferid() { return $this->lieferid; }
  function SetAnsprechpartnerid($value) { $this->ansprechpartnerid=$value; }
  function GetAnsprechpartnerid() { return $this->ansprechpartnerid; }
  function SetSystemfreitext($value) { $this->systemfreitext=$value; }
  function GetSystemfreitext() { return $this->systemfreitext; }
  function SetProjektfiliale($value) { $this->projektfiliale=$value; }
  function GetProjektfiliale() { return $this->projektfiliale; }

}

?>