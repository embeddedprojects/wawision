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

class ObjGenAuftrag
{

  private  $id;
  private  $datum;
  private  $art;
  private  $projekt;
  private  $belegnr;
  private  $internet;
  private  $bearbeiter;
  private  $angebot;
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
  private  $ust_inner;
  private  $email;
  private  $telefon;
  private  $telefax;
  private  $betreff;
  private  $kundennummer;
  private  $versandart;
  private  $vertrieb;
  private  $zahlungsweise;
  private  $zahlungszieltage;
  private  $zahlungszieltageskonto;
  private  $zahlungszielskonto;
  private  $bank_inhaber;
  private  $bank_institut;
  private  $bank_blz;
  private  $bank_konto;
  private  $kreditkarte_typ;
  private  $kreditkarte_inhaber;
  private  $kreditkarte_nummer;
  private  $kreditkarte_pruefnummer;
  private  $kreditkarte_monat;
  private  $kreditkarte_jahr;
  private  $firma;
  private  $versendet;
  private  $versendet_am;
  private  $versendet_per;
  private  $versendet_durch;
  private  $autoversand;
  private  $keinporto;
  private  $keinestornomail;
  private  $abweichendelieferadresse;
  private  $liefername;
  private  $lieferabteilung;
  private  $lieferunterabteilung;
  private  $lieferland;
  private  $lieferstrasse;
  private  $lieferort;
  private  $lieferplz;
  private  $lieferadresszusatz;
  private  $lieferansprechpartner;
  private  $packstation_inhaber;
  private  $packstation_station;
  private  $packstation_ident;
  private  $packstation_plz;
  private  $packstation_ort;
  private  $autofreigabe;
  private  $freigabe;
  private  $nachbesserung;
  private  $gesamtsumme;
  private  $inbearbeitung;
  private  $abgeschlossen;
  private  $nachlieferung;
  private  $lager_ok;
  private  $porto_ok;
  private  $ust_ok;
  private  $check_ok;
  private  $vorkasse_ok;
  private  $nachnahme_ok;
  private  $reserviert_ok;
  private  $partnerid;
  private  $folgebestaetigung;
  private  $zahlungsmail;
  private  $stornogrund;
  private  $stornosonstiges;
  private  $stornorueckzahlung;
  private  $stornobetrag;
  private  $stornobankinhaber;
  private  $stornobankkonto;
  private  $stornobankblz;
  private  $stornobankbank;
  private  $stornogutschrift;
  private  $stornogutschriftbeleg;
  private  $stornowareerhalten;
  private  $stornomanuellebearbeitung;
  private  $stornokommentar;
  private  $stornobezahlt;
  private  $stornobezahltam;
  private  $stornobezahltvon;
  private  $stornoabgeschlossen;
  private  $stornorueckzahlungper;
  private  $stornowareerhaltenretour;
  private  $partnerausgezahlt;
  private  $partnerausgezahltam;
  private  $kennen;
  private  $logdatei;
  private  $keinetrackingmail;
  private  $zahlungsmailcounter;
  private  $rma;
  private  $transaktionsnummer;
  private  $vorabbezahltmarkieren;
  private  $deckungsbeitragcalc;
  private  $deckungsbeitrag;
  private  $erloes_netto;
  private  $umsatz_netto;
  private  $lieferdatum;
  private  $tatsaechlicheslieferdatum;
  private  $liefertermin_ok;
  private  $teillieferung_moeglich;
  private  $kreditlimit_ok;
  private  $kreditlimit_freigabe;
  private  $liefersperre_ok;
  private  $teillieferungvon;
  private  $teillieferungnummer;
  private  $vertriebid;
  private  $aktion;
  private  $provision;
  private  $provision_summe;
  private  $anfrageid;
  private  $gruppe;
  private  $shopextid;
  private  $shopextstatus;
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
  private  $shop;
  private  $steuersatz_normal;
  private  $steuersatz_zwischen;
  private  $steuersatz_ermaessigt;
  private  $steuersatz_starkermaessigt;
  private  $steuersatz_dienstleistung;
  private  $waehrung;
  private  $keinsteuersatz;
  private  $angebotid;
  private  $schreibschutz;
  private  $pdfarchiviert;
  private  $pdfarchiviertversion;
  private  $typ;
  private  $ohne_briefpapier;
  private  $auftragseingangper;
  private  $lieferid;
  private  $ansprechpartnerid;
  private  $systemfreitext;
  private  $projektfiliale;
  private  $lieferdatumkw;

  public $app;            //application object 

  public function ObjGenAuftrag($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM auftrag WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->datum=$result['datum'];
    $this->art=$result['art'];
    $this->projekt=$result['projekt'];
    $this->belegnr=$result['belegnr'];
    $this->internet=$result['internet'];
    $this->bearbeiter=$result['bearbeiter'];
    $this->angebot=$result['angebot'];
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
    $this->ust_inner=$result['ust_inner'];
    $this->email=$result['email'];
    $this->telefon=$result['telefon'];
    $this->telefax=$result['telefax'];
    $this->betreff=$result['betreff'];
    $this->kundennummer=$result['kundennummer'];
    $this->versandart=$result['versandart'];
    $this->vertrieb=$result['vertrieb'];
    $this->zahlungsweise=$result['zahlungsweise'];
    $this->zahlungszieltage=$result['zahlungszieltage'];
    $this->zahlungszieltageskonto=$result['zahlungszieltageskonto'];
    $this->zahlungszielskonto=$result['zahlungszielskonto'];
    $this->bank_inhaber=$result['bank_inhaber'];
    $this->bank_institut=$result['bank_institut'];
    $this->bank_blz=$result['bank_blz'];
    $this->bank_konto=$result['bank_konto'];
    $this->kreditkarte_typ=$result['kreditkarte_typ'];
    $this->kreditkarte_inhaber=$result['kreditkarte_inhaber'];
    $this->kreditkarte_nummer=$result['kreditkarte_nummer'];
    $this->kreditkarte_pruefnummer=$result['kreditkarte_pruefnummer'];
    $this->kreditkarte_monat=$result['kreditkarte_monat'];
    $this->kreditkarte_jahr=$result['kreditkarte_jahr'];
    $this->firma=$result['firma'];
    $this->versendet=$result['versendet'];
    $this->versendet_am=$result['versendet_am'];
    $this->versendet_per=$result['versendet_per'];
    $this->versendet_durch=$result['versendet_durch'];
    $this->autoversand=$result['autoversand'];
    $this->keinporto=$result['keinporto'];
    $this->keinestornomail=$result['keinestornomail'];
    $this->abweichendelieferadresse=$result['abweichendelieferadresse'];
    $this->liefername=$result['liefername'];
    $this->lieferabteilung=$result['lieferabteilung'];
    $this->lieferunterabteilung=$result['lieferunterabteilung'];
    $this->lieferland=$result['lieferland'];
    $this->lieferstrasse=$result['lieferstrasse'];
    $this->lieferort=$result['lieferort'];
    $this->lieferplz=$result['lieferplz'];
    $this->lieferadresszusatz=$result['lieferadresszusatz'];
    $this->lieferansprechpartner=$result['lieferansprechpartner'];
    $this->packstation_inhaber=$result['packstation_inhaber'];
    $this->packstation_station=$result['packstation_station'];
    $this->packstation_ident=$result['packstation_ident'];
    $this->packstation_plz=$result['packstation_plz'];
    $this->packstation_ort=$result['packstation_ort'];
    $this->autofreigabe=$result['autofreigabe'];
    $this->freigabe=$result['freigabe'];
    $this->nachbesserung=$result['nachbesserung'];
    $this->gesamtsumme=$result['gesamtsumme'];
    $this->inbearbeitung=$result['inbearbeitung'];
    $this->abgeschlossen=$result['abgeschlossen'];
    $this->nachlieferung=$result['nachlieferung'];
    $this->lager_ok=$result['lager_ok'];
    $this->porto_ok=$result['porto_ok'];
    $this->ust_ok=$result['ust_ok'];
    $this->check_ok=$result['check_ok'];
    $this->vorkasse_ok=$result['vorkasse_ok'];
    $this->nachnahme_ok=$result['nachnahme_ok'];
    $this->reserviert_ok=$result['reserviert_ok'];
    $this->partnerid=$result['partnerid'];
    $this->folgebestaetigung=$result['folgebestaetigung'];
    $this->zahlungsmail=$result['zahlungsmail'];
    $this->stornogrund=$result['stornogrund'];
    $this->stornosonstiges=$result['stornosonstiges'];
    $this->stornorueckzahlung=$result['stornorueckzahlung'];
    $this->stornobetrag=$result['stornobetrag'];
    $this->stornobankinhaber=$result['stornobankinhaber'];
    $this->stornobankkonto=$result['stornobankkonto'];
    $this->stornobankblz=$result['stornobankblz'];
    $this->stornobankbank=$result['stornobankbank'];
    $this->stornogutschrift=$result['stornogutschrift'];
    $this->stornogutschriftbeleg=$result['stornogutschriftbeleg'];
    $this->stornowareerhalten=$result['stornowareerhalten'];
    $this->stornomanuellebearbeitung=$result['stornomanuellebearbeitung'];
    $this->stornokommentar=$result['stornokommentar'];
    $this->stornobezahlt=$result['stornobezahlt'];
    $this->stornobezahltam=$result['stornobezahltam'];
    $this->stornobezahltvon=$result['stornobezahltvon'];
    $this->stornoabgeschlossen=$result['stornoabgeschlossen'];
    $this->stornorueckzahlungper=$result['stornorueckzahlungper'];
    $this->stornowareerhaltenretour=$result['stornowareerhaltenretour'];
    $this->partnerausgezahlt=$result['partnerausgezahlt'];
    $this->partnerausgezahltam=$result['partnerausgezahltam'];
    $this->kennen=$result['kennen'];
    $this->logdatei=$result['logdatei'];
    $this->keinetrackingmail=$result['keinetrackingmail'];
    $this->zahlungsmailcounter=$result['zahlungsmailcounter'];
    $this->rma=$result['rma'];
    $this->transaktionsnummer=$result['transaktionsnummer'];
    $this->vorabbezahltmarkieren=$result['vorabbezahltmarkieren'];
    $this->deckungsbeitragcalc=$result['deckungsbeitragcalc'];
    $this->deckungsbeitrag=$result['deckungsbeitrag'];
    $this->erloes_netto=$result['erloes_netto'];
    $this->umsatz_netto=$result['umsatz_netto'];
    $this->lieferdatum=$result['lieferdatum'];
    $this->tatsaechlicheslieferdatum=$result['tatsaechlicheslieferdatum'];
    $this->liefertermin_ok=$result['liefertermin_ok'];
    $this->teillieferung_moeglich=$result['teillieferung_moeglich'];
    $this->kreditlimit_ok=$result['kreditlimit_ok'];
    $this->kreditlimit_freigabe=$result['kreditlimit_freigabe'];
    $this->liefersperre_ok=$result['liefersperre_ok'];
    $this->teillieferungvon=$result['teillieferungvon'];
    $this->teillieferungnummer=$result['teillieferungnummer'];
    $this->vertriebid=$result['vertriebid'];
    $this->aktion=$result['aktion'];
    $this->provision=$result['provision'];
    $this->provision_summe=$result['provision_summe'];
    $this->anfrageid=$result['anfrageid'];
    $this->gruppe=$result['gruppe'];
    $this->shopextid=$result['shopextid'];
    $this->shopextstatus=$result['shopextstatus'];
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
    $this->shop=$result['shop'];
    $this->steuersatz_normal=$result['steuersatz_normal'];
    $this->steuersatz_zwischen=$result['steuersatz_zwischen'];
    $this->steuersatz_ermaessigt=$result['steuersatz_ermaessigt'];
    $this->steuersatz_starkermaessigt=$result['steuersatz_starkermaessigt'];
    $this->steuersatz_dienstleistung=$result['steuersatz_dienstleistung'];
    $this->waehrung=$result['waehrung'];
    $this->keinsteuersatz=$result['keinsteuersatz'];
    $this->angebotid=$result['angebotid'];
    $this->schreibschutz=$result['schreibschutz'];
    $this->pdfarchiviert=$result['pdfarchiviert'];
    $this->pdfarchiviertversion=$result['pdfarchiviertversion'];
    $this->typ=$result['typ'];
    $this->ohne_briefpapier=$result['ohne_briefpapier'];
    $this->auftragseingangper=$result['auftragseingangper'];
    $this->lieferid=$result['lieferid'];
    $this->ansprechpartnerid=$result['ansprechpartnerid'];
    $this->systemfreitext=$result['systemfreitext'];
    $this->projektfiliale=$result['projektfiliale'];
    $this->lieferdatumkw=$result['lieferdatumkw'];
  }

  public function Create()
  {
    $sql = "INSERT INTO auftrag (id,datum,art,projekt,belegnr,internet,bearbeiter,angebot,freitext,internebemerkung,status,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,ansprechpartner,plz,ort,land,ustid,ust_befreit,ust_inner,email,telefon,telefax,betreff,kundennummer,versandart,vertrieb,zahlungsweise,zahlungszieltage,zahlungszieltageskonto,zahlungszielskonto,bank_inhaber,bank_institut,bank_blz,bank_konto,kreditkarte_typ,kreditkarte_inhaber,kreditkarte_nummer,kreditkarte_pruefnummer,kreditkarte_monat,kreditkarte_jahr,firma,versendet,versendet_am,versendet_per,versendet_durch,autoversand,keinporto,keinestornomail,abweichendelieferadresse,liefername,lieferabteilung,lieferunterabteilung,lieferland,lieferstrasse,lieferort,lieferplz,lieferadresszusatz,lieferansprechpartner,packstation_inhaber,packstation_station,packstation_ident,packstation_plz,packstation_ort,autofreigabe,freigabe,nachbesserung,gesamtsumme,inbearbeitung,abgeschlossen,nachlieferung,lager_ok,porto_ok,ust_ok,check_ok,vorkasse_ok,nachnahme_ok,reserviert_ok,partnerid,folgebestaetigung,zahlungsmail,stornogrund,stornosonstiges,stornorueckzahlung,stornobetrag,stornobankinhaber,stornobankkonto,stornobankblz,stornobankbank,stornogutschrift,stornogutschriftbeleg,stornowareerhalten,stornomanuellebearbeitung,stornokommentar,stornobezahlt,stornobezahltam,stornobezahltvon,stornoabgeschlossen,stornorueckzahlungper,stornowareerhaltenretour,partnerausgezahlt,partnerausgezahltam,kennen,logdatei,keinetrackingmail,zahlungsmailcounter,rma,transaktionsnummer,vorabbezahltmarkieren,deckungsbeitragcalc,deckungsbeitrag,erloes_netto,umsatz_netto,lieferdatum,tatsaechlicheslieferdatum,liefertermin_ok,teillieferung_moeglich,kreditlimit_ok,kreditlimit_freigabe,liefersperre_ok,teillieferungvon,teillieferungnummer,vertriebid,aktion,provision,provision_summe,anfrageid,gruppe,shopextid,shopextstatus,ihrebestellnummer,anschreiben,usereditid,useredittimestamp,realrabatt,rabatt,einzugsdatum,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,shop,steuersatz_normal,steuersatz_zwischen,steuersatz_ermaessigt,steuersatz_starkermaessigt,steuersatz_dienstleistung,waehrung,keinsteuersatz,angebotid,schreibschutz,pdfarchiviert,pdfarchiviertversion,typ,ohne_briefpapier,auftragseingangper,lieferid,ansprechpartnerid,systemfreitext,projektfiliale,lieferdatumkw)
      VALUES('','{$this->datum}','{$this->art}','{$this->projekt}','{$this->belegnr}','{$this->internet}','{$this->bearbeiter}','{$this->angebot}','{$this->freitext}','{$this->internebemerkung}','{$this->status}','{$this->adresse}','{$this->name}','{$this->abteilung}','{$this->unterabteilung}','{$this->strasse}','{$this->adresszusatz}','{$this->ansprechpartner}','{$this->plz}','{$this->ort}','{$this->land}','{$this->ustid}','{$this->ust_befreit}','{$this->ust_inner}','{$this->email}','{$this->telefon}','{$this->telefax}','{$this->betreff}','{$this->kundennummer}','{$this->versandart}','{$this->vertrieb}','{$this->zahlungsweise}','{$this->zahlungszieltage}','{$this->zahlungszieltageskonto}','{$this->zahlungszielskonto}','{$this->bank_inhaber}','{$this->bank_institut}','{$this->bank_blz}','{$this->bank_konto}','{$this->kreditkarte_typ}','{$this->kreditkarte_inhaber}','{$this->kreditkarte_nummer}','{$this->kreditkarte_pruefnummer}','{$this->kreditkarte_monat}','{$this->kreditkarte_jahr}','{$this->firma}','{$this->versendet}','{$this->versendet_am}','{$this->versendet_per}','{$this->versendet_durch}','{$this->autoversand}','{$this->keinporto}','{$this->keinestornomail}','{$this->abweichendelieferadresse}','{$this->liefername}','{$this->lieferabteilung}','{$this->lieferunterabteilung}','{$this->lieferland}','{$this->lieferstrasse}','{$this->lieferort}','{$this->lieferplz}','{$this->lieferadresszusatz}','{$this->lieferansprechpartner}','{$this->packstation_inhaber}','{$this->packstation_station}','{$this->packstation_ident}','{$this->packstation_plz}','{$this->packstation_ort}','{$this->autofreigabe}','{$this->freigabe}','{$this->nachbesserung}','{$this->gesamtsumme}','{$this->inbearbeitung}','{$this->abgeschlossen}','{$this->nachlieferung}','{$this->lager_ok}','{$this->porto_ok}','{$this->ust_ok}','{$this->check_ok}','{$this->vorkasse_ok}','{$this->nachnahme_ok}','{$this->reserviert_ok}','{$this->partnerid}','{$this->folgebestaetigung}','{$this->zahlungsmail}','{$this->stornogrund}','{$this->stornosonstiges}','{$this->stornorueckzahlung}','{$this->stornobetrag}','{$this->stornobankinhaber}','{$this->stornobankkonto}','{$this->stornobankblz}','{$this->stornobankbank}','{$this->stornogutschrift}','{$this->stornogutschriftbeleg}','{$this->stornowareerhalten}','{$this->stornomanuellebearbeitung}','{$this->stornokommentar}','{$this->stornobezahlt}','{$this->stornobezahltam}','{$this->stornobezahltvon}','{$this->stornoabgeschlossen}','{$this->stornorueckzahlungper}','{$this->stornowareerhaltenretour}','{$this->partnerausgezahlt}','{$this->partnerausgezahltam}','{$this->kennen}','{$this->logdatei}','{$this->keinetrackingmail}','{$this->zahlungsmailcounter}','{$this->rma}','{$this->transaktionsnummer}','{$this->vorabbezahltmarkieren}','{$this->deckungsbeitragcalc}','{$this->deckungsbeitrag}','{$this->erloes_netto}','{$this->umsatz_netto}','{$this->lieferdatum}','{$this->tatsaechlicheslieferdatum}','{$this->liefertermin_ok}','{$this->teillieferung_moeglich}','{$this->kreditlimit_ok}','{$this->kreditlimit_freigabe}','{$this->liefersperre_ok}','{$this->teillieferungvon}','{$this->teillieferungnummer}','{$this->vertriebid}','{$this->aktion}','{$this->provision}','{$this->provision_summe}','{$this->anfrageid}','{$this->gruppe}','{$this->shopextid}','{$this->shopextstatus}','{$this->ihrebestellnummer}','{$this->anschreiben}','{$this->usereditid}','{$this->useredittimestamp}','{$this->realrabatt}','{$this->rabatt}','{$this->einzugsdatum}','{$this->rabatt1}','{$this->rabatt2}','{$this->rabatt3}','{$this->rabatt4}','{$this->rabatt5}','{$this->shop}','{$this->steuersatz_normal}','{$this->steuersatz_zwischen}','{$this->steuersatz_ermaessigt}','{$this->steuersatz_starkermaessigt}','{$this->steuersatz_dienstleistung}','{$this->waehrung}','{$this->keinsteuersatz}','{$this->angebotid}','{$this->schreibschutz}','{$this->pdfarchiviert}','{$this->pdfarchiviertversion}','{$this->typ}','{$this->ohne_briefpapier}','{$this->auftragseingangper}','{$this->lieferid}','{$this->ansprechpartnerid}','{$this->systemfreitext}','{$this->projektfiliale}','{$this->lieferdatumkw}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE auftrag SET
      datum='{$this->datum}',
      art='{$this->art}',
      projekt='{$this->projekt}',
      belegnr='{$this->belegnr}',
      internet='{$this->internet}',
      bearbeiter='{$this->bearbeiter}',
      angebot='{$this->angebot}',
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
      ust_inner='{$this->ust_inner}',
      email='{$this->email}',
      telefon='{$this->telefon}',
      telefax='{$this->telefax}',
      betreff='{$this->betreff}',
      kundennummer='{$this->kundennummer}',
      versandart='{$this->versandart}',
      vertrieb='{$this->vertrieb}',
      zahlungsweise='{$this->zahlungsweise}',
      zahlungszieltage='{$this->zahlungszieltage}',
      zahlungszieltageskonto='{$this->zahlungszieltageskonto}',
      zahlungszielskonto='{$this->zahlungszielskonto}',
      bank_inhaber='{$this->bank_inhaber}',
      bank_institut='{$this->bank_institut}',
      bank_blz='{$this->bank_blz}',
      bank_konto='{$this->bank_konto}',
      kreditkarte_typ='{$this->kreditkarte_typ}',
      kreditkarte_inhaber='{$this->kreditkarte_inhaber}',
      kreditkarte_nummer='{$this->kreditkarte_nummer}',
      kreditkarte_pruefnummer='{$this->kreditkarte_pruefnummer}',
      kreditkarte_monat='{$this->kreditkarte_monat}',
      kreditkarte_jahr='{$this->kreditkarte_jahr}',
      firma='{$this->firma}',
      versendet='{$this->versendet}',
      versendet_am='{$this->versendet_am}',
      versendet_per='{$this->versendet_per}',
      versendet_durch='{$this->versendet_durch}',
      autoversand='{$this->autoversand}',
      keinporto='{$this->keinporto}',
      keinestornomail='{$this->keinestornomail}',
      abweichendelieferadresse='{$this->abweichendelieferadresse}',
      liefername='{$this->liefername}',
      lieferabteilung='{$this->lieferabteilung}',
      lieferunterabteilung='{$this->lieferunterabteilung}',
      lieferland='{$this->lieferland}',
      lieferstrasse='{$this->lieferstrasse}',
      lieferort='{$this->lieferort}',
      lieferplz='{$this->lieferplz}',
      lieferadresszusatz='{$this->lieferadresszusatz}',
      lieferansprechpartner='{$this->lieferansprechpartner}',
      packstation_inhaber='{$this->packstation_inhaber}',
      packstation_station='{$this->packstation_station}',
      packstation_ident='{$this->packstation_ident}',
      packstation_plz='{$this->packstation_plz}',
      packstation_ort='{$this->packstation_ort}',
      autofreigabe='{$this->autofreigabe}',
      freigabe='{$this->freigabe}',
      nachbesserung='{$this->nachbesserung}',
      gesamtsumme='{$this->gesamtsumme}',
      inbearbeitung='{$this->inbearbeitung}',
      abgeschlossen='{$this->abgeschlossen}',
      nachlieferung='{$this->nachlieferung}',
      lager_ok='{$this->lager_ok}',
      porto_ok='{$this->porto_ok}',
      ust_ok='{$this->ust_ok}',
      check_ok='{$this->check_ok}',
      vorkasse_ok='{$this->vorkasse_ok}',
      nachnahme_ok='{$this->nachnahme_ok}',
      reserviert_ok='{$this->reserviert_ok}',
      partnerid='{$this->partnerid}',
      folgebestaetigung='{$this->folgebestaetigung}',
      zahlungsmail='{$this->zahlungsmail}',
      stornogrund='{$this->stornogrund}',
      stornosonstiges='{$this->stornosonstiges}',
      stornorueckzahlung='{$this->stornorueckzahlung}',
      stornobetrag='{$this->stornobetrag}',
      stornobankinhaber='{$this->stornobankinhaber}',
      stornobankkonto='{$this->stornobankkonto}',
      stornobankblz='{$this->stornobankblz}',
      stornobankbank='{$this->stornobankbank}',
      stornogutschrift='{$this->stornogutschrift}',
      stornogutschriftbeleg='{$this->stornogutschriftbeleg}',
      stornowareerhalten='{$this->stornowareerhalten}',
      stornomanuellebearbeitung='{$this->stornomanuellebearbeitung}',
      stornokommentar='{$this->stornokommentar}',
      stornobezahlt='{$this->stornobezahlt}',
      stornobezahltam='{$this->stornobezahltam}',
      stornobezahltvon='{$this->stornobezahltvon}',
      stornoabgeschlossen='{$this->stornoabgeschlossen}',
      stornorueckzahlungper='{$this->stornorueckzahlungper}',
      stornowareerhaltenretour='{$this->stornowareerhaltenretour}',
      partnerausgezahlt='{$this->partnerausgezahlt}',
      partnerausgezahltam='{$this->partnerausgezahltam}',
      kennen='{$this->kennen}',
      logdatei='{$this->logdatei}',
      keinetrackingmail='{$this->keinetrackingmail}',
      zahlungsmailcounter='{$this->zahlungsmailcounter}',
      rma='{$this->rma}',
      transaktionsnummer='{$this->transaktionsnummer}',
      vorabbezahltmarkieren='{$this->vorabbezahltmarkieren}',
      deckungsbeitragcalc='{$this->deckungsbeitragcalc}',
      deckungsbeitrag='{$this->deckungsbeitrag}',
      erloes_netto='{$this->erloes_netto}',
      umsatz_netto='{$this->umsatz_netto}',
      lieferdatum='{$this->lieferdatum}',
      tatsaechlicheslieferdatum='{$this->tatsaechlicheslieferdatum}',
      liefertermin_ok='{$this->liefertermin_ok}',
      teillieferung_moeglich='{$this->teillieferung_moeglich}',
      kreditlimit_ok='{$this->kreditlimit_ok}',
      kreditlimit_freigabe='{$this->kreditlimit_freigabe}',
      liefersperre_ok='{$this->liefersperre_ok}',
      teillieferungvon='{$this->teillieferungvon}',
      teillieferungnummer='{$this->teillieferungnummer}',
      vertriebid='{$this->vertriebid}',
      aktion='{$this->aktion}',
      provision='{$this->provision}',
      provision_summe='{$this->provision_summe}',
      anfrageid='{$this->anfrageid}',
      gruppe='{$this->gruppe}',
      shopextid='{$this->shopextid}',
      shopextstatus='{$this->shopextstatus}',
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
      shop='{$this->shop}',
      steuersatz_normal='{$this->steuersatz_normal}',
      steuersatz_zwischen='{$this->steuersatz_zwischen}',
      steuersatz_ermaessigt='{$this->steuersatz_ermaessigt}',
      steuersatz_starkermaessigt='{$this->steuersatz_starkermaessigt}',
      steuersatz_dienstleistung='{$this->steuersatz_dienstleistung}',
      waehrung='{$this->waehrung}',
      keinsteuersatz='{$this->keinsteuersatz}',
      angebotid='{$this->angebotid}',
      schreibschutz='{$this->schreibschutz}',
      pdfarchiviert='{$this->pdfarchiviert}',
      pdfarchiviertversion='{$this->pdfarchiviertversion}',
      typ='{$this->typ}',
      ohne_briefpapier='{$this->ohne_briefpapier}',
      auftragseingangper='{$this->auftragseingangper}',
      lieferid='{$this->lieferid}',
      ansprechpartnerid='{$this->ansprechpartnerid}',
      systemfreitext='{$this->systemfreitext}',
      projektfiliale='{$this->projektfiliale}',
      lieferdatumkw='{$this->lieferdatumkw}'
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

    $sql = "DELETE FROM auftrag WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->datum="";
    $this->art="";
    $this->projekt="";
    $this->belegnr="";
    $this->internet="";
    $this->bearbeiter="";
    $this->angebot="";
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
    $this->ust_inner="";
    $this->email="";
    $this->telefon="";
    $this->telefax="";
    $this->betreff="";
    $this->kundennummer="";
    $this->versandart="";
    $this->vertrieb="";
    $this->zahlungsweise="";
    $this->zahlungszieltage="";
    $this->zahlungszieltageskonto="";
    $this->zahlungszielskonto="";
    $this->bank_inhaber="";
    $this->bank_institut="";
    $this->bank_blz="";
    $this->bank_konto="";
    $this->kreditkarte_typ="";
    $this->kreditkarte_inhaber="";
    $this->kreditkarte_nummer="";
    $this->kreditkarte_pruefnummer="";
    $this->kreditkarte_monat="";
    $this->kreditkarte_jahr="";
    $this->firma="";
    $this->versendet="";
    $this->versendet_am="";
    $this->versendet_per="";
    $this->versendet_durch="";
    $this->autoversand="";
    $this->keinporto="";
    $this->keinestornomail="";
    $this->abweichendelieferadresse="";
    $this->liefername="";
    $this->lieferabteilung="";
    $this->lieferunterabteilung="";
    $this->lieferland="";
    $this->lieferstrasse="";
    $this->lieferort="";
    $this->lieferplz="";
    $this->lieferadresszusatz="";
    $this->lieferansprechpartner="";
    $this->packstation_inhaber="";
    $this->packstation_station="";
    $this->packstation_ident="";
    $this->packstation_plz="";
    $this->packstation_ort="";
    $this->autofreigabe="";
    $this->freigabe="";
    $this->nachbesserung="";
    $this->gesamtsumme="";
    $this->inbearbeitung="";
    $this->abgeschlossen="";
    $this->nachlieferung="";
    $this->lager_ok="";
    $this->porto_ok="";
    $this->ust_ok="";
    $this->check_ok="";
    $this->vorkasse_ok="";
    $this->nachnahme_ok="";
    $this->reserviert_ok="";
    $this->partnerid="";
    $this->folgebestaetigung="";
    $this->zahlungsmail="";
    $this->stornogrund="";
    $this->stornosonstiges="";
    $this->stornorueckzahlung="";
    $this->stornobetrag="";
    $this->stornobankinhaber="";
    $this->stornobankkonto="";
    $this->stornobankblz="";
    $this->stornobankbank="";
    $this->stornogutschrift="";
    $this->stornogutschriftbeleg="";
    $this->stornowareerhalten="";
    $this->stornomanuellebearbeitung="";
    $this->stornokommentar="";
    $this->stornobezahlt="";
    $this->stornobezahltam="";
    $this->stornobezahltvon="";
    $this->stornoabgeschlossen="";
    $this->stornorueckzahlungper="";
    $this->stornowareerhaltenretour="";
    $this->partnerausgezahlt="";
    $this->partnerausgezahltam="";
    $this->kennen="";
    $this->logdatei="";
    $this->keinetrackingmail="";
    $this->zahlungsmailcounter="";
    $this->rma="";
    $this->transaktionsnummer="";
    $this->vorabbezahltmarkieren="";
    $this->deckungsbeitragcalc="";
    $this->deckungsbeitrag="";
    $this->erloes_netto="";
    $this->umsatz_netto="";
    $this->lieferdatum="";
    $this->tatsaechlicheslieferdatum="";
    $this->liefertermin_ok="";
    $this->teillieferung_moeglich="";
    $this->kreditlimit_ok="";
    $this->kreditlimit_freigabe="";
    $this->liefersperre_ok="";
    $this->teillieferungvon="";
    $this->teillieferungnummer="";
    $this->vertriebid="";
    $this->aktion="";
    $this->provision="";
    $this->provision_summe="";
    $this->anfrageid="";
    $this->gruppe="";
    $this->shopextid="";
    $this->shopextstatus="";
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
    $this->shop="";
    $this->steuersatz_normal="";
    $this->steuersatz_zwischen="";
    $this->steuersatz_ermaessigt="";
    $this->steuersatz_starkermaessigt="";
    $this->steuersatz_dienstleistung="";
    $this->waehrung="";
    $this->keinsteuersatz="";
    $this->angebotid="";
    $this->schreibschutz="";
    $this->pdfarchiviert="";
    $this->pdfarchiviertversion="";
    $this->typ="";
    $this->ohne_briefpapier="";
    $this->auftragseingangper="";
    $this->lieferid="";
    $this->ansprechpartnerid="";
    $this->systemfreitext="";
    $this->projektfiliale="";
    $this->lieferdatumkw="";
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
  function SetArt($value) { $this->art=$value; }
  function GetArt() { return $this->art; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetBelegnr($value) { $this->belegnr=$value; }
  function GetBelegnr() { return $this->belegnr; }
  function SetInternet($value) { $this->internet=$value; }
  function GetInternet() { return $this->internet; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetAngebot($value) { $this->angebot=$value; }
  function GetAngebot() { return $this->angebot; }
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
  function SetUst_Inner($value) { $this->ust_inner=$value; }
  function GetUst_Inner() { return $this->ust_inner; }
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
  function SetVersandart($value) { $this->versandart=$value; }
  function GetVersandart() { return $this->versandart; }
  function SetVertrieb($value) { $this->vertrieb=$value; }
  function GetVertrieb() { return $this->vertrieb; }
  function SetZahlungsweise($value) { $this->zahlungsweise=$value; }
  function GetZahlungsweise() { return $this->zahlungsweise; }
  function SetZahlungszieltage($value) { $this->zahlungszieltage=$value; }
  function GetZahlungszieltage() { return $this->zahlungszieltage; }
  function SetZahlungszieltageskonto($value) { $this->zahlungszieltageskonto=$value; }
  function GetZahlungszieltageskonto() { return $this->zahlungszieltageskonto; }
  function SetZahlungszielskonto($value) { $this->zahlungszielskonto=$value; }
  function GetZahlungszielskonto() { return $this->zahlungszielskonto; }
  function SetBank_Inhaber($value) { $this->bank_inhaber=$value; }
  function GetBank_Inhaber() { return $this->bank_inhaber; }
  function SetBank_Institut($value) { $this->bank_institut=$value; }
  function GetBank_Institut() { return $this->bank_institut; }
  function SetBank_Blz($value) { $this->bank_blz=$value; }
  function GetBank_Blz() { return $this->bank_blz; }
  function SetBank_Konto($value) { $this->bank_konto=$value; }
  function GetBank_Konto() { return $this->bank_konto; }
  function SetKreditkarte_Typ($value) { $this->kreditkarte_typ=$value; }
  function GetKreditkarte_Typ() { return $this->kreditkarte_typ; }
  function SetKreditkarte_Inhaber($value) { $this->kreditkarte_inhaber=$value; }
  function GetKreditkarte_Inhaber() { return $this->kreditkarte_inhaber; }
  function SetKreditkarte_Nummer($value) { $this->kreditkarte_nummer=$value; }
  function GetKreditkarte_Nummer() { return $this->kreditkarte_nummer; }
  function SetKreditkarte_Pruefnummer($value) { $this->kreditkarte_pruefnummer=$value; }
  function GetKreditkarte_Pruefnummer() { return $this->kreditkarte_pruefnummer; }
  function SetKreditkarte_Monat($value) { $this->kreditkarte_monat=$value; }
  function GetKreditkarte_Monat() { return $this->kreditkarte_monat; }
  function SetKreditkarte_Jahr($value) { $this->kreditkarte_jahr=$value; }
  function GetKreditkarte_Jahr() { return $this->kreditkarte_jahr; }
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
  function SetAutoversand($value) { $this->autoversand=$value; }
  function GetAutoversand() { return $this->autoversand; }
  function SetKeinporto($value) { $this->keinporto=$value; }
  function GetKeinporto() { return $this->keinporto; }
  function SetKeinestornomail($value) { $this->keinestornomail=$value; }
  function GetKeinestornomail() { return $this->keinestornomail; }
  function SetAbweichendelieferadresse($value) { $this->abweichendelieferadresse=$value; }
  function GetAbweichendelieferadresse() { return $this->abweichendelieferadresse; }
  function SetLiefername($value) { $this->liefername=$value; }
  function GetLiefername() { return $this->liefername; }
  function SetLieferabteilung($value) { $this->lieferabteilung=$value; }
  function GetLieferabteilung() { return $this->lieferabteilung; }
  function SetLieferunterabteilung($value) { $this->lieferunterabteilung=$value; }
  function GetLieferunterabteilung() { return $this->lieferunterabteilung; }
  function SetLieferland($value) { $this->lieferland=$value; }
  function GetLieferland() { return $this->lieferland; }
  function SetLieferstrasse($value) { $this->lieferstrasse=$value; }
  function GetLieferstrasse() { return $this->lieferstrasse; }
  function SetLieferort($value) { $this->lieferort=$value; }
  function GetLieferort() { return $this->lieferort; }
  function SetLieferplz($value) { $this->lieferplz=$value; }
  function GetLieferplz() { return $this->lieferplz; }
  function SetLieferadresszusatz($value) { $this->lieferadresszusatz=$value; }
  function GetLieferadresszusatz() { return $this->lieferadresszusatz; }
  function SetLieferansprechpartner($value) { $this->lieferansprechpartner=$value; }
  function GetLieferansprechpartner() { return $this->lieferansprechpartner; }
  function SetPackstation_Inhaber($value) { $this->packstation_inhaber=$value; }
  function GetPackstation_Inhaber() { return $this->packstation_inhaber; }
  function SetPackstation_Station($value) { $this->packstation_station=$value; }
  function GetPackstation_Station() { return $this->packstation_station; }
  function SetPackstation_Ident($value) { $this->packstation_ident=$value; }
  function GetPackstation_Ident() { return $this->packstation_ident; }
  function SetPackstation_Plz($value) { $this->packstation_plz=$value; }
  function GetPackstation_Plz() { return $this->packstation_plz; }
  function SetPackstation_Ort($value) { $this->packstation_ort=$value; }
  function GetPackstation_Ort() { return $this->packstation_ort; }
  function SetAutofreigabe($value) { $this->autofreigabe=$value; }
  function GetAutofreigabe() { return $this->autofreigabe; }
  function SetFreigabe($value) { $this->freigabe=$value; }
  function GetFreigabe() { return $this->freigabe; }
  function SetNachbesserung($value) { $this->nachbesserung=$value; }
  function GetNachbesserung() { return $this->nachbesserung; }
  function SetGesamtsumme($value) { $this->gesamtsumme=$value; }
  function GetGesamtsumme() { return $this->gesamtsumme; }
  function SetInbearbeitung($value) { $this->inbearbeitung=$value; }
  function GetInbearbeitung() { return $this->inbearbeitung; }
  function SetAbgeschlossen($value) { $this->abgeschlossen=$value; }
  function GetAbgeschlossen() { return $this->abgeschlossen; }
  function SetNachlieferung($value) { $this->nachlieferung=$value; }
  function GetNachlieferung() { return $this->nachlieferung; }
  function SetLager_Ok($value) { $this->lager_ok=$value; }
  function GetLager_Ok() { return $this->lager_ok; }
  function SetPorto_Ok($value) { $this->porto_ok=$value; }
  function GetPorto_Ok() { return $this->porto_ok; }
  function SetUst_Ok($value) { $this->ust_ok=$value; }
  function GetUst_Ok() { return $this->ust_ok; }
  function SetCheck_Ok($value) { $this->check_ok=$value; }
  function GetCheck_Ok() { return $this->check_ok; }
  function SetVorkasse_Ok($value) { $this->vorkasse_ok=$value; }
  function GetVorkasse_Ok() { return $this->vorkasse_ok; }
  function SetNachnahme_Ok($value) { $this->nachnahme_ok=$value; }
  function GetNachnahme_Ok() { return $this->nachnahme_ok; }
  function SetReserviert_Ok($value) { $this->reserviert_ok=$value; }
  function GetReserviert_Ok() { return $this->reserviert_ok; }
  function SetPartnerid($value) { $this->partnerid=$value; }
  function GetPartnerid() { return $this->partnerid; }
  function SetFolgebestaetigung($value) { $this->folgebestaetigung=$value; }
  function GetFolgebestaetigung() { return $this->folgebestaetigung; }
  function SetZahlungsmail($value) { $this->zahlungsmail=$value; }
  function GetZahlungsmail() { return $this->zahlungsmail; }
  function SetStornogrund($value) { $this->stornogrund=$value; }
  function GetStornogrund() { return $this->stornogrund; }
  function SetStornosonstiges($value) { $this->stornosonstiges=$value; }
  function GetStornosonstiges() { return $this->stornosonstiges; }
  function SetStornorueckzahlung($value) { $this->stornorueckzahlung=$value; }
  function GetStornorueckzahlung() { return $this->stornorueckzahlung; }
  function SetStornobetrag($value) { $this->stornobetrag=$value; }
  function GetStornobetrag() { return $this->stornobetrag; }
  function SetStornobankinhaber($value) { $this->stornobankinhaber=$value; }
  function GetStornobankinhaber() { return $this->stornobankinhaber; }
  function SetStornobankkonto($value) { $this->stornobankkonto=$value; }
  function GetStornobankkonto() { return $this->stornobankkonto; }
  function SetStornobankblz($value) { $this->stornobankblz=$value; }
  function GetStornobankblz() { return $this->stornobankblz; }
  function SetStornobankbank($value) { $this->stornobankbank=$value; }
  function GetStornobankbank() { return $this->stornobankbank; }
  function SetStornogutschrift($value) { $this->stornogutschrift=$value; }
  function GetStornogutschrift() { return $this->stornogutschrift; }
  function SetStornogutschriftbeleg($value) { $this->stornogutschriftbeleg=$value; }
  function GetStornogutschriftbeleg() { return $this->stornogutschriftbeleg; }
  function SetStornowareerhalten($value) { $this->stornowareerhalten=$value; }
  function GetStornowareerhalten() { return $this->stornowareerhalten; }
  function SetStornomanuellebearbeitung($value) { $this->stornomanuellebearbeitung=$value; }
  function GetStornomanuellebearbeitung() { return $this->stornomanuellebearbeitung; }
  function SetStornokommentar($value) { $this->stornokommentar=$value; }
  function GetStornokommentar() { return $this->stornokommentar; }
  function SetStornobezahlt($value) { $this->stornobezahlt=$value; }
  function GetStornobezahlt() { return $this->stornobezahlt; }
  function SetStornobezahltam($value) { $this->stornobezahltam=$value; }
  function GetStornobezahltam() { return $this->stornobezahltam; }
  function SetStornobezahltvon($value) { $this->stornobezahltvon=$value; }
  function GetStornobezahltvon() { return $this->stornobezahltvon; }
  function SetStornoabgeschlossen($value) { $this->stornoabgeschlossen=$value; }
  function GetStornoabgeschlossen() { return $this->stornoabgeschlossen; }
  function SetStornorueckzahlungper($value) { $this->stornorueckzahlungper=$value; }
  function GetStornorueckzahlungper() { return $this->stornorueckzahlungper; }
  function SetStornowareerhaltenretour($value) { $this->stornowareerhaltenretour=$value; }
  function GetStornowareerhaltenretour() { return $this->stornowareerhaltenretour; }
  function SetPartnerausgezahlt($value) { $this->partnerausgezahlt=$value; }
  function GetPartnerausgezahlt() { return $this->partnerausgezahlt; }
  function SetPartnerausgezahltam($value) { $this->partnerausgezahltam=$value; }
  function GetPartnerausgezahltam() { return $this->partnerausgezahltam; }
  function SetKennen($value) { $this->kennen=$value; }
  function GetKennen() { return $this->kennen; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetKeinetrackingmail($value) { $this->keinetrackingmail=$value; }
  function GetKeinetrackingmail() { return $this->keinetrackingmail; }
  function SetZahlungsmailcounter($value) { $this->zahlungsmailcounter=$value; }
  function GetZahlungsmailcounter() { return $this->zahlungsmailcounter; }
  function SetRma($value) { $this->rma=$value; }
  function GetRma() { return $this->rma; }
  function SetTransaktionsnummer($value) { $this->transaktionsnummer=$value; }
  function GetTransaktionsnummer() { return $this->transaktionsnummer; }
  function SetVorabbezahltmarkieren($value) { $this->vorabbezahltmarkieren=$value; }
  function GetVorabbezahltmarkieren() { return $this->vorabbezahltmarkieren; }
  function SetDeckungsbeitragcalc($value) { $this->deckungsbeitragcalc=$value; }
  function GetDeckungsbeitragcalc() { return $this->deckungsbeitragcalc; }
  function SetDeckungsbeitrag($value) { $this->deckungsbeitrag=$value; }
  function GetDeckungsbeitrag() { return $this->deckungsbeitrag; }
  function SetErloes_Netto($value) { $this->erloes_netto=$value; }
  function GetErloes_Netto() { return $this->erloes_netto; }
  function SetUmsatz_Netto($value) { $this->umsatz_netto=$value; }
  function GetUmsatz_Netto() { return $this->umsatz_netto; }
  function SetLieferdatum($value) { $this->lieferdatum=$value; }
  function GetLieferdatum() { return $this->lieferdatum; }
  function SetTatsaechlicheslieferdatum($value) { $this->tatsaechlicheslieferdatum=$value; }
  function GetTatsaechlicheslieferdatum() { return $this->tatsaechlicheslieferdatum; }
  function SetLiefertermin_Ok($value) { $this->liefertermin_ok=$value; }
  function GetLiefertermin_Ok() { return $this->liefertermin_ok; }
  function SetTeillieferung_Moeglich($value) { $this->teillieferung_moeglich=$value; }
  function GetTeillieferung_Moeglich() { return $this->teillieferung_moeglich; }
  function SetKreditlimit_Ok($value) { $this->kreditlimit_ok=$value; }
  function GetKreditlimit_Ok() { return $this->kreditlimit_ok; }
  function SetKreditlimit_Freigabe($value) { $this->kreditlimit_freigabe=$value; }
  function GetKreditlimit_Freigabe() { return $this->kreditlimit_freigabe; }
  function SetLiefersperre_Ok($value) { $this->liefersperre_ok=$value; }
  function GetLiefersperre_Ok() { return $this->liefersperre_ok; }
  function SetTeillieferungvon($value) { $this->teillieferungvon=$value; }
  function GetTeillieferungvon() { return $this->teillieferungvon; }
  function SetTeillieferungnummer($value) { $this->teillieferungnummer=$value; }
  function GetTeillieferungnummer() { return $this->teillieferungnummer; }
  function SetVertriebid($value) { $this->vertriebid=$value; }
  function GetVertriebid() { return $this->vertriebid; }
  function SetAktion($value) { $this->aktion=$value; }
  function GetAktion() { return $this->aktion; }
  function SetProvision($value) { $this->provision=$value; }
  function GetProvision() { return $this->provision; }
  function SetProvision_Summe($value) { $this->provision_summe=$value; }
  function GetProvision_Summe() { return $this->provision_summe; }
  function SetAnfrageid($value) { $this->anfrageid=$value; }
  function GetAnfrageid() { return $this->anfrageid; }
  function SetGruppe($value) { $this->gruppe=$value; }
  function GetGruppe() { return $this->gruppe; }
  function SetShopextid($value) { $this->shopextid=$value; }
  function GetShopextid() { return $this->shopextid; }
  function SetShopextstatus($value) { $this->shopextstatus=$value; }
  function GetShopextstatus() { return $this->shopextstatus; }
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
  function SetShop($value) { $this->shop=$value; }
  function GetShop() { return $this->shop; }
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
  function SetAngebotid($value) { $this->angebotid=$value; }
  function GetAngebotid() { return $this->angebotid; }
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
  function SetAuftragseingangper($value) { $this->auftragseingangper=$value; }
  function GetAuftragseingangper() { return $this->auftragseingangper; }
  function SetLieferid($value) { $this->lieferid=$value; }
  function GetLieferid() { return $this->lieferid; }
  function SetAnsprechpartnerid($value) { $this->ansprechpartnerid=$value; }
  function GetAnsprechpartnerid() { return $this->ansprechpartnerid; }
  function SetSystemfreitext($value) { $this->systemfreitext=$value; }
  function GetSystemfreitext() { return $this->systemfreitext; }
  function SetProjektfiliale($value) { $this->projektfiliale=$value; }
  function GetProjektfiliale() { return $this->projektfiliale; }
  function SetLieferdatumkw($value) { $this->lieferdatumkw=$value; }
  function GetLieferdatumkw() { return $this->lieferdatumkw; }

}

?>