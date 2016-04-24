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

class ObjGenAdresse
{

  private  $id;
  private  $typ;
  private  $marketingsperre;
  private  $trackingsperre;
  private  $rechnungsadresse;
  private  $sprache;
  private  $name;
  private  $abteilung;
  private  $unterabteilung;
  private  $ansprechpartner;
  private  $land;
  private  $strasse;
  private  $ort;
  private  $plz;
  private  $telefon;
  private  $telefax;
  private  $mobil;
  private  $email;
  private  $ustid;
  private  $ust_befreit;
  private  $passwort_gesendet;
  private  $sonstiges;
  private  $adresszusatz;
  private  $kundenfreigabe;
  private  $steuer;
  private  $logdatei;
  private  $kundennummer;
  private  $lieferantennummer;
  private  $mitarbeiternummer;
  private  $konto;
  private  $blz;
  private  $bank;
  private  $inhaber;
  private  $swift;
  private  $iban;
  private  $waehrung;
  private  $paypal;
  private  $paypalinhaber;
  private  $paypalwaehrung;
  private  $projekt;
  private  $partner;
  private  $zahlungsweise;
  private  $zahlungszieltage;
  private  $zahlungszieltageskonto;
  private  $zahlungszielskonto;
  private  $versandart;
  private  $kundennummerlieferant;
  private  $zahlungsweiselieferant;
  private  $zahlungszieltagelieferant;
  private  $zahlungszieltageskontolieferant;
  private  $zahlungszielskontolieferant;
  private  $versandartlieferant;
  private  $geloescht;
  private  $firma;
  private  $webid;
  private  $vorname;
  private  $kennung;
  private  $sachkonto;
  private  $freifeld1;
  private  $freifeld2;
  private  $freifeld3;
  private  $filiale;
  private  $vertrieb;
  private  $innendienst;
  private  $verbandsnummer;
  private  $abweichendeemailab;
  private  $portofrei_aktiv;
  private  $portofreiab;
  private  $infoauftragserfassung;
  private  $mandatsreferenz;
  private  $mandatsreferenzdatum;
  private  $mandatsreferenzaenderung;
  private  $glaeubigeridentnr;
  private  $kreditlimit;
  private  $tour;
  private  $zahlungskonditionen_festschreiben;
  private  $rabatte_festschreiben;
  private  $mlmaktiv;
  private  $mlmvertragsbeginn;
  private  $mlmlizenzgebuehrbis;
  private  $mlmfestsetzenbis;
  private  $mlmfestsetzen;
  private  $mlmmindestpunkte;
  private  $mlmwartekonto;
  private  $abweichende_rechnungsadresse;
  private  $rechnung_vorname;
  private  $rechnung_name;
  private  $rechnung_titel;
  private  $rechnung_typ;
  private  $rechnung_strasse;
  private  $rechnung_ort;
  private  $rechnung_plz;
  private  $rechnung_ansprechpartner;
  private  $rechnung_land;
  private  $rechnung_abteilung;
  private  $rechnung_unterabteilung;
  private  $rechnung_adresszusatz;
  private  $rechnung_telefon;
  private  $rechnung_telefax;
  private  $rechnung_anschreiben;
  private  $rechnung_email;
  private  $geburtstag;
  private  $rolledatum;
  private  $liefersperre;
  private  $liefersperregrund;
  private  $mlmpositionierung;
  private  $steuernummer;
  private  $steuerbefreit;
  private  $mlmmitmwst;
  private  $mlmabrechnung;
  private  $mlmwaehrungauszahlung;
  private  $mlmauszahlungprojekt;
  private  $sponsor;
  private  $geworbenvon;
  private  $logfile;
  private  $kalender_aufgaben;
  private  $verrechnungskontoreisekosten;
  private  $usereditid;
  private  $useredittimestamp;
  private  $rabatt;
  private  $provision;
  private  $rabattinformation;
  private  $rabatt1;
  private  $rabatt2;
  private  $rabatt3;
  private  $rabatt4;
  private  $rabatt5;
  private  $internetseite;
  private  $bonus1;
  private  $bonus1_ab;
  private  $bonus2;
  private  $bonus2_ab;
  private  $bonus3;
  private  $bonus3_ab;
  private  $bonus4;
  private  $bonus4_ab;
  private  $bonus5;
  private  $bonus5_ab;
  private  $bonus6;
  private  $bonus6_ab;
  private  $bonus7;
  private  $bonus7_ab;
  private  $bonus8;
  private  $bonus8_ab;
  private  $bonus9;
  private  $bonus9_ab;
  private  $bonus10;
  private  $bonus10_ab;
  private  $rechnung_periode;
  private  $rechnung_anzahlpapier;
  private  $rechnung_permail;
  private  $titel;
  private  $anschreiben;
  private  $nachname;
  private  $arbeitszeitprowoche;
  private  $folgebestaetigungsperre;
  private  $lieferantennummerbeikunde;
  private  $verein_mitglied_seit;
  private  $verein_mitglied_bis;
  private  $verein_mitglied_aktiv;
  private  $verein_spendenbescheinigung;
  private  $freifeld4;
  private  $freifeld5;
  private  $freifeld6;
  private  $freifeld7;
  private  $freifeld8;
  private  $freifeld9;
  private  $freifeld10;
  private  $rechnung_papier;
  private  $angebot_cc;
  private  $auftrag_cc;
  private  $rechnung_cc;
  private  $gutschrift_cc;
  private  $lieferschein_cc;
  private  $bestellung_cc;
  private  $angebot_fax_cc;
  private  $auftrag_fax_cc;
  private  $rechnung_fax_cc;
  private  $gutschrift_fax_cc;
  private  $lieferschein_fax_cc;
  private  $bestellung_fax_cc;
  private  $abperfax;
  private  $abpermail;
  private  $kassiereraktiv;
  private  $kassierernummer;
  private  $kassiererprojekt;
  private  $portofreilieferant_aktiv;
  private  $portofreiablieferant;
  private  $mandatsreferenzart;
  private  $mandatsreferenzwdhart;
  private  $serienbrief;
  private  $lead;
  private  $geburtstagkalender;

  public $app;            //application object 

  public function ObjGenAdresse($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM adresse WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->typ=$result['typ'];
    $this->marketingsperre=$result['marketingsperre'];
    $this->trackingsperre=$result['trackingsperre'];
    $this->rechnungsadresse=$result['rechnungsadresse'];
    $this->sprache=$result['sprache'];
    $this->name=$result['name'];
    $this->abteilung=$result['abteilung'];
    $this->unterabteilung=$result['unterabteilung'];
    $this->ansprechpartner=$result['ansprechpartner'];
    $this->land=$result['land'];
    $this->strasse=$result['strasse'];
    $this->ort=$result['ort'];
    $this->plz=$result['plz'];
    $this->telefon=$result['telefon'];
    $this->telefax=$result['telefax'];
    $this->mobil=$result['mobil'];
    $this->email=$result['email'];
    $this->ustid=$result['ustid'];
    $this->ust_befreit=$result['ust_befreit'];
    $this->passwort_gesendet=$result['passwort_gesendet'];
    $this->sonstiges=$result['sonstiges'];
    $this->adresszusatz=$result['adresszusatz'];
    $this->kundenfreigabe=$result['kundenfreigabe'];
    $this->steuer=$result['steuer'];
    $this->logdatei=$result['logdatei'];
    $this->kundennummer=$result['kundennummer'];
    $this->lieferantennummer=$result['lieferantennummer'];
    $this->mitarbeiternummer=$result['mitarbeiternummer'];
    $this->konto=$result['konto'];
    $this->blz=$result['blz'];
    $this->bank=$result['bank'];
    $this->inhaber=$result['inhaber'];
    $this->swift=$result['swift'];
    $this->iban=$result['iban'];
    $this->waehrung=$result['waehrung'];
    $this->paypal=$result['paypal'];
    $this->paypalinhaber=$result['paypalinhaber'];
    $this->paypalwaehrung=$result['paypalwaehrung'];
    $this->projekt=$result['projekt'];
    $this->partner=$result['partner'];
    $this->zahlungsweise=$result['zahlungsweise'];
    $this->zahlungszieltage=$result['zahlungszieltage'];
    $this->zahlungszieltageskonto=$result['zahlungszieltageskonto'];
    $this->zahlungszielskonto=$result['zahlungszielskonto'];
    $this->versandart=$result['versandart'];
    $this->kundennummerlieferant=$result['kundennummerlieferant'];
    $this->zahlungsweiselieferant=$result['zahlungsweiselieferant'];
    $this->zahlungszieltagelieferant=$result['zahlungszieltagelieferant'];
    $this->zahlungszieltageskontolieferant=$result['zahlungszieltageskontolieferant'];
    $this->zahlungszielskontolieferant=$result['zahlungszielskontolieferant'];
    $this->versandartlieferant=$result['versandartlieferant'];
    $this->geloescht=$result['geloescht'];
    $this->firma=$result['firma'];
    $this->webid=$result['webid'];
    $this->vorname=$result['vorname'];
    $this->kennung=$result['kennung'];
    $this->sachkonto=$result['sachkonto'];
    $this->freifeld1=$result['freifeld1'];
    $this->freifeld2=$result['freifeld2'];
    $this->freifeld3=$result['freifeld3'];
    $this->filiale=$result['filiale'];
    $this->vertrieb=$result['vertrieb'];
    $this->innendienst=$result['innendienst'];
    $this->verbandsnummer=$result['verbandsnummer'];
    $this->abweichendeemailab=$result['abweichendeemailab'];
    $this->portofrei_aktiv=$result['portofrei_aktiv'];
    $this->portofreiab=$result['portofreiab'];
    $this->infoauftragserfassung=$result['infoauftragserfassung'];
    $this->mandatsreferenz=$result['mandatsreferenz'];
    $this->mandatsreferenzdatum=$result['mandatsreferenzdatum'];
    $this->mandatsreferenzaenderung=$result['mandatsreferenzaenderung'];
    $this->glaeubigeridentnr=$result['glaeubigeridentnr'];
    $this->kreditlimit=$result['kreditlimit'];
    $this->tour=$result['tour'];
    $this->zahlungskonditionen_festschreiben=$result['zahlungskonditionen_festschreiben'];
    $this->rabatte_festschreiben=$result['rabatte_festschreiben'];
    $this->mlmaktiv=$result['mlmaktiv'];
    $this->mlmvertragsbeginn=$result['mlmvertragsbeginn'];
    $this->mlmlizenzgebuehrbis=$result['mlmlizenzgebuehrbis'];
    $this->mlmfestsetzenbis=$result['mlmfestsetzenbis'];
    $this->mlmfestsetzen=$result['mlmfestsetzen'];
    $this->mlmmindestpunkte=$result['mlmmindestpunkte'];
    $this->mlmwartekonto=$result['mlmwartekonto'];
    $this->abweichende_rechnungsadresse=$result['abweichende_rechnungsadresse'];
    $this->rechnung_vorname=$result['rechnung_vorname'];
    $this->rechnung_name=$result['rechnung_name'];
    $this->rechnung_titel=$result['rechnung_titel'];
    $this->rechnung_typ=$result['rechnung_typ'];
    $this->rechnung_strasse=$result['rechnung_strasse'];
    $this->rechnung_ort=$result['rechnung_ort'];
    $this->rechnung_plz=$result['rechnung_plz'];
    $this->rechnung_ansprechpartner=$result['rechnung_ansprechpartner'];
    $this->rechnung_land=$result['rechnung_land'];
    $this->rechnung_abteilung=$result['rechnung_abteilung'];
    $this->rechnung_unterabteilung=$result['rechnung_unterabteilung'];
    $this->rechnung_adresszusatz=$result['rechnung_adresszusatz'];
    $this->rechnung_telefon=$result['rechnung_telefon'];
    $this->rechnung_telefax=$result['rechnung_telefax'];
    $this->rechnung_anschreiben=$result['rechnung_anschreiben'];
    $this->rechnung_email=$result['rechnung_email'];
    $this->geburtstag=$result['geburtstag'];
    $this->rolledatum=$result['rolledatum'];
    $this->liefersperre=$result['liefersperre'];
    $this->liefersperregrund=$result['liefersperregrund'];
    $this->mlmpositionierung=$result['mlmpositionierung'];
    $this->steuernummer=$result['steuernummer'];
    $this->steuerbefreit=$result['steuerbefreit'];
    $this->mlmmitmwst=$result['mlmmitmwst'];
    $this->mlmabrechnung=$result['mlmabrechnung'];
    $this->mlmwaehrungauszahlung=$result['mlmwaehrungauszahlung'];
    $this->mlmauszahlungprojekt=$result['mlmauszahlungprojekt'];
    $this->sponsor=$result['sponsor'];
    $this->geworbenvon=$result['geworbenvon'];
    $this->logfile=$result['logfile'];
    $this->kalender_aufgaben=$result['kalender_aufgaben'];
    $this->verrechnungskontoreisekosten=$result['verrechnungskontoreisekosten'];
    $this->usereditid=$result['usereditid'];
    $this->useredittimestamp=$result['useredittimestamp'];
    $this->rabatt=$result['rabatt'];
    $this->provision=$result['provision'];
    $this->rabattinformation=$result['rabattinformation'];
    $this->rabatt1=$result['rabatt1'];
    $this->rabatt2=$result['rabatt2'];
    $this->rabatt3=$result['rabatt3'];
    $this->rabatt4=$result['rabatt4'];
    $this->rabatt5=$result['rabatt5'];
    $this->internetseite=$result['internetseite'];
    $this->bonus1=$result['bonus1'];
    $this->bonus1_ab=$result['bonus1_ab'];
    $this->bonus2=$result['bonus2'];
    $this->bonus2_ab=$result['bonus2_ab'];
    $this->bonus3=$result['bonus3'];
    $this->bonus3_ab=$result['bonus3_ab'];
    $this->bonus4=$result['bonus4'];
    $this->bonus4_ab=$result['bonus4_ab'];
    $this->bonus5=$result['bonus5'];
    $this->bonus5_ab=$result['bonus5_ab'];
    $this->bonus6=$result['bonus6'];
    $this->bonus6_ab=$result['bonus6_ab'];
    $this->bonus7=$result['bonus7'];
    $this->bonus7_ab=$result['bonus7_ab'];
    $this->bonus8=$result['bonus8'];
    $this->bonus8_ab=$result['bonus8_ab'];
    $this->bonus9=$result['bonus9'];
    $this->bonus9_ab=$result['bonus9_ab'];
    $this->bonus10=$result['bonus10'];
    $this->bonus10_ab=$result['bonus10_ab'];
    $this->rechnung_periode=$result['rechnung_periode'];
    $this->rechnung_anzahlpapier=$result['rechnung_anzahlpapier'];
    $this->rechnung_permail=$result['rechnung_permail'];
    $this->titel=$result['titel'];
    $this->anschreiben=$result['anschreiben'];
    $this->nachname=$result['nachname'];
    $this->arbeitszeitprowoche=$result['arbeitszeitprowoche'];
    $this->folgebestaetigungsperre=$result['folgebestaetigungsperre'];
    $this->lieferantennummerbeikunde=$result['lieferantennummerbeikunde'];
    $this->verein_mitglied_seit=$result['verein_mitglied_seit'];
    $this->verein_mitglied_bis=$result['verein_mitglied_bis'];
    $this->verein_mitglied_aktiv=$result['verein_mitglied_aktiv'];
    $this->verein_spendenbescheinigung=$result['verein_spendenbescheinigung'];
    $this->freifeld4=$result['freifeld4'];
    $this->freifeld5=$result['freifeld5'];
    $this->freifeld6=$result['freifeld6'];
    $this->freifeld7=$result['freifeld7'];
    $this->freifeld8=$result['freifeld8'];
    $this->freifeld9=$result['freifeld9'];
    $this->freifeld10=$result['freifeld10'];
    $this->rechnung_papier=$result['rechnung_papier'];
    $this->angebot_cc=$result['angebot_cc'];
    $this->auftrag_cc=$result['auftrag_cc'];
    $this->rechnung_cc=$result['rechnung_cc'];
    $this->gutschrift_cc=$result['gutschrift_cc'];
    $this->lieferschein_cc=$result['lieferschein_cc'];
    $this->bestellung_cc=$result['bestellung_cc'];
    $this->angebot_fax_cc=$result['angebot_fax_cc'];
    $this->auftrag_fax_cc=$result['auftrag_fax_cc'];
    $this->rechnung_fax_cc=$result['rechnung_fax_cc'];
    $this->gutschrift_fax_cc=$result['gutschrift_fax_cc'];
    $this->lieferschein_fax_cc=$result['lieferschein_fax_cc'];
    $this->bestellung_fax_cc=$result['bestellung_fax_cc'];
    $this->abperfax=$result['abperfax'];
    $this->abpermail=$result['abpermail'];
    $this->kassiereraktiv=$result['kassiereraktiv'];
    $this->kassierernummer=$result['kassierernummer'];
    $this->kassiererprojekt=$result['kassiererprojekt'];
    $this->portofreilieferant_aktiv=$result['portofreilieferant_aktiv'];
    $this->portofreiablieferant=$result['portofreiablieferant'];
    $this->mandatsreferenzart=$result['mandatsreferenzart'];
    $this->mandatsreferenzwdhart=$result['mandatsreferenzwdhart'];
    $this->serienbrief=$result['serienbrief'];
    $this->lead=$result['lead'];
    $this->geburtstagkalender=$result['geburtstagkalender'];
  }

  public function Create()
  {
    $sql = "INSERT INTO adresse (id,typ,marketingsperre,trackingsperre,rechnungsadresse,sprache,name,abteilung,unterabteilung,ansprechpartner,land,strasse,ort,plz,telefon,telefax,mobil,email,ustid,ust_befreit,passwort_gesendet,sonstiges,adresszusatz,kundenfreigabe,steuer,logdatei,kundennummer,lieferantennummer,mitarbeiternummer,konto,blz,bank,inhaber,swift,iban,waehrung,paypal,paypalinhaber,paypalwaehrung,projekt,partner,zahlungsweise,zahlungszieltage,zahlungszieltageskonto,zahlungszielskonto,versandart,kundennummerlieferant,zahlungsweiselieferant,zahlungszieltagelieferant,zahlungszieltageskontolieferant,zahlungszielskontolieferant,versandartlieferant,geloescht,firma,webid,vorname,kennung,sachkonto,freifeld1,freifeld2,freifeld3,filiale,vertrieb,innendienst,verbandsnummer,abweichendeemailab,portofrei_aktiv,portofreiab,infoauftragserfassung,mandatsreferenz,mandatsreferenzdatum,mandatsreferenzaenderung,glaeubigeridentnr,kreditlimit,tour,zahlungskonditionen_festschreiben,rabatte_festschreiben,mlmaktiv,mlmvertragsbeginn,mlmlizenzgebuehrbis,mlmfestsetzenbis,mlmfestsetzen,mlmmindestpunkte,mlmwartekonto,abweichende_rechnungsadresse,rechnung_vorname,rechnung_name,rechnung_titel,rechnung_typ,rechnung_strasse,rechnung_ort,rechnung_plz,rechnung_ansprechpartner,rechnung_land,rechnung_abteilung,rechnung_unterabteilung,rechnung_adresszusatz,rechnung_telefon,rechnung_telefax,rechnung_anschreiben,rechnung_email,geburtstag,rolledatum,liefersperre,liefersperregrund,mlmpositionierung,steuernummer,steuerbefreit,mlmmitmwst,mlmabrechnung,mlmwaehrungauszahlung,mlmauszahlungprojekt,sponsor,geworbenvon,logfile,kalender_aufgaben,verrechnungskontoreisekosten,usereditid,useredittimestamp,rabatt,provision,rabattinformation,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,internetseite,bonus1,bonus1_ab,bonus2,bonus2_ab,bonus3,bonus3_ab,bonus4,bonus4_ab,bonus5,bonus5_ab,bonus6,bonus6_ab,bonus7,bonus7_ab,bonus8,bonus8_ab,bonus9,bonus9_ab,bonus10,bonus10_ab,rechnung_periode,rechnung_anzahlpapier,rechnung_permail,titel,anschreiben,nachname,arbeitszeitprowoche,folgebestaetigungsperre,lieferantennummerbeikunde,verein_mitglied_seit,verein_mitglied_bis,verein_mitglied_aktiv,verein_spendenbescheinigung,freifeld4,freifeld5,freifeld6,freifeld7,freifeld8,freifeld9,freifeld10,rechnung_papier,angebot_cc,auftrag_cc,rechnung_cc,gutschrift_cc,lieferschein_cc,bestellung_cc,angebot_fax_cc,auftrag_fax_cc,rechnung_fax_cc,gutschrift_fax_cc,lieferschein_fax_cc,bestellung_fax_cc,abperfax,abpermail,kassiereraktiv,kassierernummer,kassiererprojekt,portofreilieferant_aktiv,portofreiablieferant,mandatsreferenzart,mandatsreferenzwdhart,serienbrief,lead,geburtstagkalender)
      VALUES('','{$this->typ}','{$this->marketingsperre}','{$this->trackingsperre}','{$this->rechnungsadresse}','{$this->sprache}','{$this->name}','{$this->abteilung}','{$this->unterabteilung}','{$this->ansprechpartner}','{$this->land}','{$this->strasse}','{$this->ort}','{$this->plz}','{$this->telefon}','{$this->telefax}','{$this->mobil}','{$this->email}','{$this->ustid}','{$this->ust_befreit}','{$this->passwort_gesendet}','{$this->sonstiges}','{$this->adresszusatz}','{$this->kundenfreigabe}','{$this->steuer}','{$this->logdatei}','{$this->kundennummer}','{$this->lieferantennummer}','{$this->mitarbeiternummer}','{$this->konto}','{$this->blz}','{$this->bank}','{$this->inhaber}','{$this->swift}','{$this->iban}','{$this->waehrung}','{$this->paypal}','{$this->paypalinhaber}','{$this->paypalwaehrung}','{$this->projekt}','{$this->partner}','{$this->zahlungsweise}','{$this->zahlungszieltage}','{$this->zahlungszieltageskonto}','{$this->zahlungszielskonto}','{$this->versandart}','{$this->kundennummerlieferant}','{$this->zahlungsweiselieferant}','{$this->zahlungszieltagelieferant}','{$this->zahlungszieltageskontolieferant}','{$this->zahlungszielskontolieferant}','{$this->versandartlieferant}','{$this->geloescht}','{$this->firma}','{$this->webid}','{$this->vorname}','{$this->kennung}','{$this->sachkonto}','{$this->freifeld1}','{$this->freifeld2}','{$this->freifeld3}','{$this->filiale}','{$this->vertrieb}','{$this->innendienst}','{$this->verbandsnummer}','{$this->abweichendeemailab}','{$this->portofrei_aktiv}','{$this->portofreiab}','{$this->infoauftragserfassung}','{$this->mandatsreferenz}','{$this->mandatsreferenzdatum}','{$this->mandatsreferenzaenderung}','{$this->glaeubigeridentnr}','{$this->kreditlimit}','{$this->tour}','{$this->zahlungskonditionen_festschreiben}','{$this->rabatte_festschreiben}','{$this->mlmaktiv}','{$this->mlmvertragsbeginn}','{$this->mlmlizenzgebuehrbis}','{$this->mlmfestsetzenbis}','{$this->mlmfestsetzen}','{$this->mlmmindestpunkte}','{$this->mlmwartekonto}','{$this->abweichende_rechnungsadresse}','{$this->rechnung_vorname}','{$this->rechnung_name}','{$this->rechnung_titel}','{$this->rechnung_typ}','{$this->rechnung_strasse}','{$this->rechnung_ort}','{$this->rechnung_plz}','{$this->rechnung_ansprechpartner}','{$this->rechnung_land}','{$this->rechnung_abteilung}','{$this->rechnung_unterabteilung}','{$this->rechnung_adresszusatz}','{$this->rechnung_telefon}','{$this->rechnung_telefax}','{$this->rechnung_anschreiben}','{$this->rechnung_email}','{$this->geburtstag}','{$this->rolledatum}','{$this->liefersperre}','{$this->liefersperregrund}','{$this->mlmpositionierung}','{$this->steuernummer}','{$this->steuerbefreit}','{$this->mlmmitmwst}','{$this->mlmabrechnung}','{$this->mlmwaehrungauszahlung}','{$this->mlmauszahlungprojekt}','{$this->sponsor}','{$this->geworbenvon}','{$this->logfile}','{$this->kalender_aufgaben}','{$this->verrechnungskontoreisekosten}','{$this->usereditid}','{$this->useredittimestamp}','{$this->rabatt}','{$this->provision}','{$this->rabattinformation}','{$this->rabatt1}','{$this->rabatt2}','{$this->rabatt3}','{$this->rabatt4}','{$this->rabatt5}','{$this->internetseite}','{$this->bonus1}','{$this->bonus1_ab}','{$this->bonus2}','{$this->bonus2_ab}','{$this->bonus3}','{$this->bonus3_ab}','{$this->bonus4}','{$this->bonus4_ab}','{$this->bonus5}','{$this->bonus5_ab}','{$this->bonus6}','{$this->bonus6_ab}','{$this->bonus7}','{$this->bonus7_ab}','{$this->bonus8}','{$this->bonus8_ab}','{$this->bonus9}','{$this->bonus9_ab}','{$this->bonus10}','{$this->bonus10_ab}','{$this->rechnung_periode}','{$this->rechnung_anzahlpapier}','{$this->rechnung_permail}','{$this->titel}','{$this->anschreiben}','{$this->nachname}','{$this->arbeitszeitprowoche}','{$this->folgebestaetigungsperre}','{$this->lieferantennummerbeikunde}','{$this->verein_mitglied_seit}','{$this->verein_mitglied_bis}','{$this->verein_mitglied_aktiv}','{$this->verein_spendenbescheinigung}','{$this->freifeld4}','{$this->freifeld5}','{$this->freifeld6}','{$this->freifeld7}','{$this->freifeld8}','{$this->freifeld9}','{$this->freifeld10}','{$this->rechnung_papier}','{$this->angebot_cc}','{$this->auftrag_cc}','{$this->rechnung_cc}','{$this->gutschrift_cc}','{$this->lieferschein_cc}','{$this->bestellung_cc}','{$this->angebot_fax_cc}','{$this->auftrag_fax_cc}','{$this->rechnung_fax_cc}','{$this->gutschrift_fax_cc}','{$this->lieferschein_fax_cc}','{$this->bestellung_fax_cc}','{$this->abperfax}','{$this->abpermail}','{$this->kassiereraktiv}','{$this->kassierernummer}','{$this->kassiererprojekt}','{$this->portofreilieferant_aktiv}','{$this->portofreiablieferant}','{$this->mandatsreferenzart}','{$this->mandatsreferenzwdhart}','{$this->serienbrief}','{$this->lead}','{$this->geburtstagkalender}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE adresse SET
      typ='{$this->typ}',
      marketingsperre='{$this->marketingsperre}',
      trackingsperre='{$this->trackingsperre}',
      rechnungsadresse='{$this->rechnungsadresse}',
      sprache='{$this->sprache}',
      name='{$this->name}',
      abteilung='{$this->abteilung}',
      unterabteilung='{$this->unterabteilung}',
      ansprechpartner='{$this->ansprechpartner}',
      land='{$this->land}',
      strasse='{$this->strasse}',
      ort='{$this->ort}',
      plz='{$this->plz}',
      telefon='{$this->telefon}',
      telefax='{$this->telefax}',
      mobil='{$this->mobil}',
      email='{$this->email}',
      ustid='{$this->ustid}',
      ust_befreit='{$this->ust_befreit}',
      passwort_gesendet='{$this->passwort_gesendet}',
      sonstiges='{$this->sonstiges}',
      adresszusatz='{$this->adresszusatz}',
      kundenfreigabe='{$this->kundenfreigabe}',
      steuer='{$this->steuer}',
      logdatei='{$this->logdatei}',
      kundennummer='{$this->kundennummer}',
      lieferantennummer='{$this->lieferantennummer}',
      mitarbeiternummer='{$this->mitarbeiternummer}',
      konto='{$this->konto}',
      blz='{$this->blz}',
      bank='{$this->bank}',
      inhaber='{$this->inhaber}',
      swift='{$this->swift}',
      iban='{$this->iban}',
      waehrung='{$this->waehrung}',
      paypal='{$this->paypal}',
      paypalinhaber='{$this->paypalinhaber}',
      paypalwaehrung='{$this->paypalwaehrung}',
      projekt='{$this->projekt}',
      partner='{$this->partner}',
      zahlungsweise='{$this->zahlungsweise}',
      zahlungszieltage='{$this->zahlungszieltage}',
      zahlungszieltageskonto='{$this->zahlungszieltageskonto}',
      zahlungszielskonto='{$this->zahlungszielskonto}',
      versandart='{$this->versandart}',
      kundennummerlieferant='{$this->kundennummerlieferant}',
      zahlungsweiselieferant='{$this->zahlungsweiselieferant}',
      zahlungszieltagelieferant='{$this->zahlungszieltagelieferant}',
      zahlungszieltageskontolieferant='{$this->zahlungszieltageskontolieferant}',
      zahlungszielskontolieferant='{$this->zahlungszielskontolieferant}',
      versandartlieferant='{$this->versandartlieferant}',
      geloescht='{$this->geloescht}',
      firma='{$this->firma}',
      webid='{$this->webid}',
      vorname='{$this->vorname}',
      kennung='{$this->kennung}',
      sachkonto='{$this->sachkonto}',
      freifeld1='{$this->freifeld1}',
      freifeld2='{$this->freifeld2}',
      freifeld3='{$this->freifeld3}',
      filiale='{$this->filiale}',
      vertrieb='{$this->vertrieb}',
      innendienst='{$this->innendienst}',
      verbandsnummer='{$this->verbandsnummer}',
      abweichendeemailab='{$this->abweichendeemailab}',
      portofrei_aktiv='{$this->portofrei_aktiv}',
      portofreiab='{$this->portofreiab}',
      infoauftragserfassung='{$this->infoauftragserfassung}',
      mandatsreferenz='{$this->mandatsreferenz}',
      mandatsreferenzdatum='{$this->mandatsreferenzdatum}',
      mandatsreferenzaenderung='{$this->mandatsreferenzaenderung}',
      glaeubigeridentnr='{$this->glaeubigeridentnr}',
      kreditlimit='{$this->kreditlimit}',
      tour='{$this->tour}',
      zahlungskonditionen_festschreiben='{$this->zahlungskonditionen_festschreiben}',
      rabatte_festschreiben='{$this->rabatte_festschreiben}',
      mlmaktiv='{$this->mlmaktiv}',
      mlmvertragsbeginn='{$this->mlmvertragsbeginn}',
      mlmlizenzgebuehrbis='{$this->mlmlizenzgebuehrbis}',
      mlmfestsetzenbis='{$this->mlmfestsetzenbis}',
      mlmfestsetzen='{$this->mlmfestsetzen}',
      mlmmindestpunkte='{$this->mlmmindestpunkte}',
      mlmwartekonto='{$this->mlmwartekonto}',
      abweichende_rechnungsadresse='{$this->abweichende_rechnungsadresse}',
      rechnung_vorname='{$this->rechnung_vorname}',
      rechnung_name='{$this->rechnung_name}',
      rechnung_titel='{$this->rechnung_titel}',
      rechnung_typ='{$this->rechnung_typ}',
      rechnung_strasse='{$this->rechnung_strasse}',
      rechnung_ort='{$this->rechnung_ort}',
      rechnung_plz='{$this->rechnung_plz}',
      rechnung_ansprechpartner='{$this->rechnung_ansprechpartner}',
      rechnung_land='{$this->rechnung_land}',
      rechnung_abteilung='{$this->rechnung_abteilung}',
      rechnung_unterabteilung='{$this->rechnung_unterabteilung}',
      rechnung_adresszusatz='{$this->rechnung_adresszusatz}',
      rechnung_telefon='{$this->rechnung_telefon}',
      rechnung_telefax='{$this->rechnung_telefax}',
      rechnung_anschreiben='{$this->rechnung_anschreiben}',
      rechnung_email='{$this->rechnung_email}',
      geburtstag='{$this->geburtstag}',
      rolledatum='{$this->rolledatum}',
      liefersperre='{$this->liefersperre}',
      liefersperregrund='{$this->liefersperregrund}',
      mlmpositionierung='{$this->mlmpositionierung}',
      steuernummer='{$this->steuernummer}',
      steuerbefreit='{$this->steuerbefreit}',
      mlmmitmwst='{$this->mlmmitmwst}',
      mlmabrechnung='{$this->mlmabrechnung}',
      mlmwaehrungauszahlung='{$this->mlmwaehrungauszahlung}',
      mlmauszahlungprojekt='{$this->mlmauszahlungprojekt}',
      sponsor='{$this->sponsor}',
      geworbenvon='{$this->geworbenvon}',
      logfile='{$this->logfile}',
      kalender_aufgaben='{$this->kalender_aufgaben}',
      verrechnungskontoreisekosten='{$this->verrechnungskontoreisekosten}',
      usereditid='{$this->usereditid}',
      useredittimestamp='{$this->useredittimestamp}',
      rabatt='{$this->rabatt}',
      provision='{$this->provision}',
      rabattinformation='{$this->rabattinformation}',
      rabatt1='{$this->rabatt1}',
      rabatt2='{$this->rabatt2}',
      rabatt3='{$this->rabatt3}',
      rabatt4='{$this->rabatt4}',
      rabatt5='{$this->rabatt5}',
      internetseite='{$this->internetseite}',
      bonus1='{$this->bonus1}',
      bonus1_ab='{$this->bonus1_ab}',
      bonus2='{$this->bonus2}',
      bonus2_ab='{$this->bonus2_ab}',
      bonus3='{$this->bonus3}',
      bonus3_ab='{$this->bonus3_ab}',
      bonus4='{$this->bonus4}',
      bonus4_ab='{$this->bonus4_ab}',
      bonus5='{$this->bonus5}',
      bonus5_ab='{$this->bonus5_ab}',
      bonus6='{$this->bonus6}',
      bonus6_ab='{$this->bonus6_ab}',
      bonus7='{$this->bonus7}',
      bonus7_ab='{$this->bonus7_ab}',
      bonus8='{$this->bonus8}',
      bonus8_ab='{$this->bonus8_ab}',
      bonus9='{$this->bonus9}',
      bonus9_ab='{$this->bonus9_ab}',
      bonus10='{$this->bonus10}',
      bonus10_ab='{$this->bonus10_ab}',
      rechnung_periode='{$this->rechnung_periode}',
      rechnung_anzahlpapier='{$this->rechnung_anzahlpapier}',
      rechnung_permail='{$this->rechnung_permail}',
      titel='{$this->titel}',
      anschreiben='{$this->anschreiben}',
      nachname='{$this->nachname}',
      arbeitszeitprowoche='{$this->arbeitszeitprowoche}',
      folgebestaetigungsperre='{$this->folgebestaetigungsperre}',
      lieferantennummerbeikunde='{$this->lieferantennummerbeikunde}',
      verein_mitglied_seit='{$this->verein_mitglied_seit}',
      verein_mitglied_bis='{$this->verein_mitglied_bis}',
      verein_mitglied_aktiv='{$this->verein_mitglied_aktiv}',
      verein_spendenbescheinigung='{$this->verein_spendenbescheinigung}',
      freifeld4='{$this->freifeld4}',
      freifeld5='{$this->freifeld5}',
      freifeld6='{$this->freifeld6}',
      freifeld7='{$this->freifeld7}',
      freifeld8='{$this->freifeld8}',
      freifeld9='{$this->freifeld9}',
      freifeld10='{$this->freifeld10}',
      rechnung_papier='{$this->rechnung_papier}',
      angebot_cc='{$this->angebot_cc}',
      auftrag_cc='{$this->auftrag_cc}',
      rechnung_cc='{$this->rechnung_cc}',
      gutschrift_cc='{$this->gutschrift_cc}',
      lieferschein_cc='{$this->lieferschein_cc}',
      bestellung_cc='{$this->bestellung_cc}',
      angebot_fax_cc='{$this->angebot_fax_cc}',
      auftrag_fax_cc='{$this->auftrag_fax_cc}',
      rechnung_fax_cc='{$this->rechnung_fax_cc}',
      gutschrift_fax_cc='{$this->gutschrift_fax_cc}',
      lieferschein_fax_cc='{$this->lieferschein_fax_cc}',
      bestellung_fax_cc='{$this->bestellung_fax_cc}',
      abperfax='{$this->abperfax}',
      abpermail='{$this->abpermail}',
      kassiereraktiv='{$this->kassiereraktiv}',
      kassierernummer='{$this->kassierernummer}',
      kassiererprojekt='{$this->kassiererprojekt}',
      portofreilieferant_aktiv='{$this->portofreilieferant_aktiv}',
      portofreiablieferant='{$this->portofreiablieferant}',
      mandatsreferenzart='{$this->mandatsreferenzart}',
      mandatsreferenzwdhart='{$this->mandatsreferenzwdhart}',
      serienbrief='{$this->serienbrief}',
      lead='{$this->lead}',
      geburtstagkalender='{$this->geburtstagkalender}'
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

    $sql = "DELETE FROM adresse WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->typ="";
    $this->marketingsperre="";
    $this->trackingsperre="";
    $this->rechnungsadresse="";
    $this->sprache="";
    $this->name="";
    $this->abteilung="";
    $this->unterabteilung="";
    $this->ansprechpartner="";
    $this->land="";
    $this->strasse="";
    $this->ort="";
    $this->plz="";
    $this->telefon="";
    $this->telefax="";
    $this->mobil="";
    $this->email="";
    $this->ustid="";
    $this->ust_befreit="";
    $this->passwort_gesendet="";
    $this->sonstiges="";
    $this->adresszusatz="";
    $this->kundenfreigabe="";
    $this->steuer="";
    $this->logdatei="";
    $this->kundennummer="";
    $this->lieferantennummer="";
    $this->mitarbeiternummer="";
    $this->konto="";
    $this->blz="";
    $this->bank="";
    $this->inhaber="";
    $this->swift="";
    $this->iban="";
    $this->waehrung="";
    $this->paypal="";
    $this->paypalinhaber="";
    $this->paypalwaehrung="";
    $this->projekt="";
    $this->partner="";
    $this->zahlungsweise="";
    $this->zahlungszieltage="";
    $this->zahlungszieltageskonto="";
    $this->zahlungszielskonto="";
    $this->versandart="";
    $this->kundennummerlieferant="";
    $this->zahlungsweiselieferant="";
    $this->zahlungszieltagelieferant="";
    $this->zahlungszieltageskontolieferant="";
    $this->zahlungszielskontolieferant="";
    $this->versandartlieferant="";
    $this->geloescht="";
    $this->firma="";
    $this->webid="";
    $this->vorname="";
    $this->kennung="";
    $this->sachkonto="";
    $this->freifeld1="";
    $this->freifeld2="";
    $this->freifeld3="";
    $this->filiale="";
    $this->vertrieb="";
    $this->innendienst="";
    $this->verbandsnummer="";
    $this->abweichendeemailab="";
    $this->portofrei_aktiv="";
    $this->portofreiab="";
    $this->infoauftragserfassung="";
    $this->mandatsreferenz="";
    $this->mandatsreferenzdatum="";
    $this->mandatsreferenzaenderung="";
    $this->glaeubigeridentnr="";
    $this->kreditlimit="";
    $this->tour="";
    $this->zahlungskonditionen_festschreiben="";
    $this->rabatte_festschreiben="";
    $this->mlmaktiv="";
    $this->mlmvertragsbeginn="";
    $this->mlmlizenzgebuehrbis="";
    $this->mlmfestsetzenbis="";
    $this->mlmfestsetzen="";
    $this->mlmmindestpunkte="";
    $this->mlmwartekonto="";
    $this->abweichende_rechnungsadresse="";
    $this->rechnung_vorname="";
    $this->rechnung_name="";
    $this->rechnung_titel="";
    $this->rechnung_typ="";
    $this->rechnung_strasse="";
    $this->rechnung_ort="";
    $this->rechnung_plz="";
    $this->rechnung_ansprechpartner="";
    $this->rechnung_land="";
    $this->rechnung_abteilung="";
    $this->rechnung_unterabteilung="";
    $this->rechnung_adresszusatz="";
    $this->rechnung_telefon="";
    $this->rechnung_telefax="";
    $this->rechnung_anschreiben="";
    $this->rechnung_email="";
    $this->geburtstag="";
    $this->rolledatum="";
    $this->liefersperre="";
    $this->liefersperregrund="";
    $this->mlmpositionierung="";
    $this->steuernummer="";
    $this->steuerbefreit="";
    $this->mlmmitmwst="";
    $this->mlmabrechnung="";
    $this->mlmwaehrungauszahlung="";
    $this->mlmauszahlungprojekt="";
    $this->sponsor="";
    $this->geworbenvon="";
    $this->logfile="";
    $this->kalender_aufgaben="";
    $this->verrechnungskontoreisekosten="";
    $this->usereditid="";
    $this->useredittimestamp="";
    $this->rabatt="";
    $this->provision="";
    $this->rabattinformation="";
    $this->rabatt1="";
    $this->rabatt2="";
    $this->rabatt3="";
    $this->rabatt4="";
    $this->rabatt5="";
    $this->internetseite="";
    $this->bonus1="";
    $this->bonus1_ab="";
    $this->bonus2="";
    $this->bonus2_ab="";
    $this->bonus3="";
    $this->bonus3_ab="";
    $this->bonus4="";
    $this->bonus4_ab="";
    $this->bonus5="";
    $this->bonus5_ab="";
    $this->bonus6="";
    $this->bonus6_ab="";
    $this->bonus7="";
    $this->bonus7_ab="";
    $this->bonus8="";
    $this->bonus8_ab="";
    $this->bonus9="";
    $this->bonus9_ab="";
    $this->bonus10="";
    $this->bonus10_ab="";
    $this->rechnung_periode="";
    $this->rechnung_anzahlpapier="";
    $this->rechnung_permail="";
    $this->titel="";
    $this->anschreiben="";
    $this->nachname="";
    $this->arbeitszeitprowoche="";
    $this->folgebestaetigungsperre="";
    $this->lieferantennummerbeikunde="";
    $this->verein_mitglied_seit="";
    $this->verein_mitglied_bis="";
    $this->verein_mitglied_aktiv="";
    $this->verein_spendenbescheinigung="";
    $this->freifeld4="";
    $this->freifeld5="";
    $this->freifeld6="";
    $this->freifeld7="";
    $this->freifeld8="";
    $this->freifeld9="";
    $this->freifeld10="";
    $this->rechnung_papier="";
    $this->angebot_cc="";
    $this->auftrag_cc="";
    $this->rechnung_cc="";
    $this->gutschrift_cc="";
    $this->lieferschein_cc="";
    $this->bestellung_cc="";
    $this->angebot_fax_cc="";
    $this->auftrag_fax_cc="";
    $this->rechnung_fax_cc="";
    $this->gutschrift_fax_cc="";
    $this->lieferschein_fax_cc="";
    $this->bestellung_fax_cc="";
    $this->abperfax="";
    $this->abpermail="";
    $this->kassiereraktiv="";
    $this->kassierernummer="";
    $this->kassiererprojekt="";
    $this->portofreilieferant_aktiv="";
    $this->portofreiablieferant="";
    $this->mandatsreferenzart="";
    $this->mandatsreferenzwdhart="";
    $this->serienbrief="";
    $this->lead="";
    $this->geburtstagkalender="";
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
  function SetTyp($value) { $this->typ=$value; }
  function GetTyp() { return $this->typ; }
  function SetMarketingsperre($value) { $this->marketingsperre=$value; }
  function GetMarketingsperre() { return $this->marketingsperre; }
  function SetTrackingsperre($value) { $this->trackingsperre=$value; }
  function GetTrackingsperre() { return $this->trackingsperre; }
  function SetRechnungsadresse($value) { $this->rechnungsadresse=$value; }
  function GetRechnungsadresse() { return $this->rechnungsadresse; }
  function SetSprache($value) { $this->sprache=$value; }
  function GetSprache() { return $this->sprache; }
  function SetName($value) { $this->name=$value; }
  function GetName() { return $this->name; }
  function SetAbteilung($value) { $this->abteilung=$value; }
  function GetAbteilung() { return $this->abteilung; }
  function SetUnterabteilung($value) { $this->unterabteilung=$value; }
  function GetUnterabteilung() { return $this->unterabteilung; }
  function SetAnsprechpartner($value) { $this->ansprechpartner=$value; }
  function GetAnsprechpartner() { return $this->ansprechpartner; }
  function SetLand($value) { $this->land=$value; }
  function GetLand() { return $this->land; }
  function SetStrasse($value) { $this->strasse=$value; }
  function GetStrasse() { return $this->strasse; }
  function SetOrt($value) { $this->ort=$value; }
  function GetOrt() { return $this->ort; }
  function SetPlz($value) { $this->plz=$value; }
  function GetPlz() { return $this->plz; }
  function SetTelefon($value) { $this->telefon=$value; }
  function GetTelefon() { return $this->telefon; }
  function SetTelefax($value) { $this->telefax=$value; }
  function GetTelefax() { return $this->telefax; }
  function SetMobil($value) { $this->mobil=$value; }
  function GetMobil() { return $this->mobil; }
  function SetEmail($value) { $this->email=$value; }
  function GetEmail() { return $this->email; }
  function SetUstid($value) { $this->ustid=$value; }
  function GetUstid() { return $this->ustid; }
  function SetUst_Befreit($value) { $this->ust_befreit=$value; }
  function GetUst_Befreit() { return $this->ust_befreit; }
  function SetPasswort_Gesendet($value) { $this->passwort_gesendet=$value; }
  function GetPasswort_Gesendet() { return $this->passwort_gesendet; }
  function SetSonstiges($value) { $this->sonstiges=$value; }
  function GetSonstiges() { return $this->sonstiges; }
  function SetAdresszusatz($value) { $this->adresszusatz=$value; }
  function GetAdresszusatz() { return $this->adresszusatz; }
  function SetKundenfreigabe($value) { $this->kundenfreigabe=$value; }
  function GetKundenfreigabe() { return $this->kundenfreigabe; }
  function SetSteuer($value) { $this->steuer=$value; }
  function GetSteuer() { return $this->steuer; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetKundennummer($value) { $this->kundennummer=$value; }
  function GetKundennummer() { return $this->kundennummer; }
  function SetLieferantennummer($value) { $this->lieferantennummer=$value; }
  function GetLieferantennummer() { return $this->lieferantennummer; }
  function SetMitarbeiternummer($value) { $this->mitarbeiternummer=$value; }
  function GetMitarbeiternummer() { return $this->mitarbeiternummer; }
  function SetKonto($value) { $this->konto=$value; }
  function GetKonto() { return $this->konto; }
  function SetBlz($value) { $this->blz=$value; }
  function GetBlz() { return $this->blz; }
  function SetBank($value) { $this->bank=$value; }
  function GetBank() { return $this->bank; }
  function SetInhaber($value) { $this->inhaber=$value; }
  function GetInhaber() { return $this->inhaber; }
  function SetSwift($value) { $this->swift=$value; }
  function GetSwift() { return $this->swift; }
  function SetIban($value) { $this->iban=$value; }
  function GetIban() { return $this->iban; }
  function SetWaehrung($value) { $this->waehrung=$value; }
  function GetWaehrung() { return $this->waehrung; }
  function SetPaypal($value) { $this->paypal=$value; }
  function GetPaypal() { return $this->paypal; }
  function SetPaypalinhaber($value) { $this->paypalinhaber=$value; }
  function GetPaypalinhaber() { return $this->paypalinhaber; }
  function SetPaypalwaehrung($value) { $this->paypalwaehrung=$value; }
  function GetPaypalwaehrung() { return $this->paypalwaehrung; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetPartner($value) { $this->partner=$value; }
  function GetPartner() { return $this->partner; }
  function SetZahlungsweise($value) { $this->zahlungsweise=$value; }
  function GetZahlungsweise() { return $this->zahlungsweise; }
  function SetZahlungszieltage($value) { $this->zahlungszieltage=$value; }
  function GetZahlungszieltage() { return $this->zahlungszieltage; }
  function SetZahlungszieltageskonto($value) { $this->zahlungszieltageskonto=$value; }
  function GetZahlungszieltageskonto() { return $this->zahlungszieltageskonto; }
  function SetZahlungszielskonto($value) { $this->zahlungszielskonto=$value; }
  function GetZahlungszielskonto() { return $this->zahlungszielskonto; }
  function SetVersandart($value) { $this->versandart=$value; }
  function GetVersandart() { return $this->versandart; }
  function SetKundennummerlieferant($value) { $this->kundennummerlieferant=$value; }
  function GetKundennummerlieferant() { return $this->kundennummerlieferant; }
  function SetZahlungsweiselieferant($value) { $this->zahlungsweiselieferant=$value; }
  function GetZahlungsweiselieferant() { return $this->zahlungsweiselieferant; }
  function SetZahlungszieltagelieferant($value) { $this->zahlungszieltagelieferant=$value; }
  function GetZahlungszieltagelieferant() { return $this->zahlungszieltagelieferant; }
  function SetZahlungszieltageskontolieferant($value) { $this->zahlungszieltageskontolieferant=$value; }
  function GetZahlungszieltageskontolieferant() { return $this->zahlungszieltageskontolieferant; }
  function SetZahlungszielskontolieferant($value) { $this->zahlungszielskontolieferant=$value; }
  function GetZahlungszielskontolieferant() { return $this->zahlungszielskontolieferant; }
  function SetVersandartlieferant($value) { $this->versandartlieferant=$value; }
  function GetVersandartlieferant() { return $this->versandartlieferant; }
  function SetGeloescht($value) { $this->geloescht=$value; }
  function GetGeloescht() { return $this->geloescht; }
  function SetFirma($value) { $this->firma=$value; }
  function GetFirma() { return $this->firma; }
  function SetWebid($value) { $this->webid=$value; }
  function GetWebid() { return $this->webid; }
  function SetVorname($value) { $this->vorname=$value; }
  function GetVorname() { return $this->vorname; }
  function SetKennung($value) { $this->kennung=$value; }
  function GetKennung() { return $this->kennung; }
  function SetSachkonto($value) { $this->sachkonto=$value; }
  function GetSachkonto() { return $this->sachkonto; }
  function SetFreifeld1($value) { $this->freifeld1=$value; }
  function GetFreifeld1() { return $this->freifeld1; }
  function SetFreifeld2($value) { $this->freifeld2=$value; }
  function GetFreifeld2() { return $this->freifeld2; }
  function SetFreifeld3($value) { $this->freifeld3=$value; }
  function GetFreifeld3() { return $this->freifeld3; }
  function SetFiliale($value) { $this->filiale=$value; }
  function GetFiliale() { return $this->filiale; }
  function SetVertrieb($value) { $this->vertrieb=$value; }
  function GetVertrieb() { return $this->vertrieb; }
  function SetInnendienst($value) { $this->innendienst=$value; }
  function GetInnendienst() { return $this->innendienst; }
  function SetVerbandsnummer($value) { $this->verbandsnummer=$value; }
  function GetVerbandsnummer() { return $this->verbandsnummer; }
  function SetAbweichendeemailab($value) { $this->abweichendeemailab=$value; }
  function GetAbweichendeemailab() { return $this->abweichendeemailab; }
  function SetPortofrei_Aktiv($value) { $this->portofrei_aktiv=$value; }
  function GetPortofrei_Aktiv() { return $this->portofrei_aktiv; }
  function SetPortofreiab($value) { $this->portofreiab=$value; }
  function GetPortofreiab() { return $this->portofreiab; }
  function SetInfoauftragserfassung($value) { $this->infoauftragserfassung=$value; }
  function GetInfoauftragserfassung() { return $this->infoauftragserfassung; }
  function SetMandatsreferenz($value) { $this->mandatsreferenz=$value; }
  function GetMandatsreferenz() { return $this->mandatsreferenz; }
  function SetMandatsreferenzdatum($value) { $this->mandatsreferenzdatum=$value; }
  function GetMandatsreferenzdatum() { return $this->mandatsreferenzdatum; }
  function SetMandatsreferenzaenderung($value) { $this->mandatsreferenzaenderung=$value; }
  function GetMandatsreferenzaenderung() { return $this->mandatsreferenzaenderung; }
  function SetGlaeubigeridentnr($value) { $this->glaeubigeridentnr=$value; }
  function GetGlaeubigeridentnr() { return $this->glaeubigeridentnr; }
  function SetKreditlimit($value) { $this->kreditlimit=$value; }
  function GetKreditlimit() { return $this->kreditlimit; }
  function SetTour($value) { $this->tour=$value; }
  function GetTour() { return $this->tour; }
  function SetZahlungskonditionen_Festschreiben($value) { $this->zahlungskonditionen_festschreiben=$value; }
  function GetZahlungskonditionen_Festschreiben() { return $this->zahlungskonditionen_festschreiben; }
  function SetRabatte_Festschreiben($value) { $this->rabatte_festschreiben=$value; }
  function GetRabatte_Festschreiben() { return $this->rabatte_festschreiben; }
  function SetMlmaktiv($value) { $this->mlmaktiv=$value; }
  function GetMlmaktiv() { return $this->mlmaktiv; }
  function SetMlmvertragsbeginn($value) { $this->mlmvertragsbeginn=$value; }
  function GetMlmvertragsbeginn() { return $this->mlmvertragsbeginn; }
  function SetMlmlizenzgebuehrbis($value) { $this->mlmlizenzgebuehrbis=$value; }
  function GetMlmlizenzgebuehrbis() { return $this->mlmlizenzgebuehrbis; }
  function SetMlmfestsetzenbis($value) { $this->mlmfestsetzenbis=$value; }
  function GetMlmfestsetzenbis() { return $this->mlmfestsetzenbis; }
  function SetMlmfestsetzen($value) { $this->mlmfestsetzen=$value; }
  function GetMlmfestsetzen() { return $this->mlmfestsetzen; }
  function SetMlmmindestpunkte($value) { $this->mlmmindestpunkte=$value; }
  function GetMlmmindestpunkte() { return $this->mlmmindestpunkte; }
  function SetMlmwartekonto($value) { $this->mlmwartekonto=$value; }
  function GetMlmwartekonto() { return $this->mlmwartekonto; }
  function SetAbweichende_Rechnungsadresse($value) { $this->abweichende_rechnungsadresse=$value; }
  function GetAbweichende_Rechnungsadresse() { return $this->abweichende_rechnungsadresse; }
  function SetRechnung_Vorname($value) { $this->rechnung_vorname=$value; }
  function GetRechnung_Vorname() { return $this->rechnung_vorname; }
  function SetRechnung_Name($value) { $this->rechnung_name=$value; }
  function GetRechnung_Name() { return $this->rechnung_name; }
  function SetRechnung_Titel($value) { $this->rechnung_titel=$value; }
  function GetRechnung_Titel() { return $this->rechnung_titel; }
  function SetRechnung_Typ($value) { $this->rechnung_typ=$value; }
  function GetRechnung_Typ() { return $this->rechnung_typ; }
  function SetRechnung_Strasse($value) { $this->rechnung_strasse=$value; }
  function GetRechnung_Strasse() { return $this->rechnung_strasse; }
  function SetRechnung_Ort($value) { $this->rechnung_ort=$value; }
  function GetRechnung_Ort() { return $this->rechnung_ort; }
  function SetRechnung_Plz($value) { $this->rechnung_plz=$value; }
  function GetRechnung_Plz() { return $this->rechnung_plz; }
  function SetRechnung_Ansprechpartner($value) { $this->rechnung_ansprechpartner=$value; }
  function GetRechnung_Ansprechpartner() { return $this->rechnung_ansprechpartner; }
  function SetRechnung_Land($value) { $this->rechnung_land=$value; }
  function GetRechnung_Land() { return $this->rechnung_land; }
  function SetRechnung_Abteilung($value) { $this->rechnung_abteilung=$value; }
  function GetRechnung_Abteilung() { return $this->rechnung_abteilung; }
  function SetRechnung_Unterabteilung($value) { $this->rechnung_unterabteilung=$value; }
  function GetRechnung_Unterabteilung() { return $this->rechnung_unterabteilung; }
  function SetRechnung_Adresszusatz($value) { $this->rechnung_adresszusatz=$value; }
  function GetRechnung_Adresszusatz() { return $this->rechnung_adresszusatz; }
  function SetRechnung_Telefon($value) { $this->rechnung_telefon=$value; }
  function GetRechnung_Telefon() { return $this->rechnung_telefon; }
  function SetRechnung_Telefax($value) { $this->rechnung_telefax=$value; }
  function GetRechnung_Telefax() { return $this->rechnung_telefax; }
  function SetRechnung_Anschreiben($value) { $this->rechnung_anschreiben=$value; }
  function GetRechnung_Anschreiben() { return $this->rechnung_anschreiben; }
  function SetRechnung_Email($value) { $this->rechnung_email=$value; }
  function GetRechnung_Email() { return $this->rechnung_email; }
  function SetGeburtstag($value) { $this->geburtstag=$value; }
  function GetGeburtstag() { return $this->geburtstag; }
  function SetRolledatum($value) { $this->rolledatum=$value; }
  function GetRolledatum() { return $this->rolledatum; }
  function SetLiefersperre($value) { $this->liefersperre=$value; }
  function GetLiefersperre() { return $this->liefersperre; }
  function SetLiefersperregrund($value) { $this->liefersperregrund=$value; }
  function GetLiefersperregrund() { return $this->liefersperregrund; }
  function SetMlmpositionierung($value) { $this->mlmpositionierung=$value; }
  function GetMlmpositionierung() { return $this->mlmpositionierung; }
  function SetSteuernummer($value) { $this->steuernummer=$value; }
  function GetSteuernummer() { return $this->steuernummer; }
  function SetSteuerbefreit($value) { $this->steuerbefreit=$value; }
  function GetSteuerbefreit() { return $this->steuerbefreit; }
  function SetMlmmitmwst($value) { $this->mlmmitmwst=$value; }
  function GetMlmmitmwst() { return $this->mlmmitmwst; }
  function SetMlmabrechnung($value) { $this->mlmabrechnung=$value; }
  function GetMlmabrechnung() { return $this->mlmabrechnung; }
  function SetMlmwaehrungauszahlung($value) { $this->mlmwaehrungauszahlung=$value; }
  function GetMlmwaehrungauszahlung() { return $this->mlmwaehrungauszahlung; }
  function SetMlmauszahlungprojekt($value) { $this->mlmauszahlungprojekt=$value; }
  function GetMlmauszahlungprojekt() { return $this->mlmauszahlungprojekt; }
  function SetSponsor($value) { $this->sponsor=$value; }
  function GetSponsor() { return $this->sponsor; }
  function SetGeworbenvon($value) { $this->geworbenvon=$value; }
  function GetGeworbenvon() { return $this->geworbenvon; }
  function SetLogfile($value) { $this->logfile=$value; }
  function GetLogfile() { return $this->logfile; }
  function SetKalender_Aufgaben($value) { $this->kalender_aufgaben=$value; }
  function GetKalender_Aufgaben() { return $this->kalender_aufgaben; }
  function SetVerrechnungskontoreisekosten($value) { $this->verrechnungskontoreisekosten=$value; }
  function GetVerrechnungskontoreisekosten() { return $this->verrechnungskontoreisekosten; }
  function SetUsereditid($value) { $this->usereditid=$value; }
  function GetUsereditid() { return $this->usereditid; }
  function SetUseredittimestamp($value) { $this->useredittimestamp=$value; }
  function GetUseredittimestamp() { return $this->useredittimestamp; }
  function SetRabatt($value) { $this->rabatt=$value; }
  function GetRabatt() { return $this->rabatt; }
  function SetProvision($value) { $this->provision=$value; }
  function GetProvision() { return $this->provision; }
  function SetRabattinformation($value) { $this->rabattinformation=$value; }
  function GetRabattinformation() { return $this->rabattinformation; }
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
  function SetInternetseite($value) { $this->internetseite=$value; }
  function GetInternetseite() { return $this->internetseite; }
  function SetBonus1($value) { $this->bonus1=$value; }
  function GetBonus1() { return $this->bonus1; }
  function SetBonus1_Ab($value) { $this->bonus1_ab=$value; }
  function GetBonus1_Ab() { return $this->bonus1_ab; }
  function SetBonus2($value) { $this->bonus2=$value; }
  function GetBonus2() { return $this->bonus2; }
  function SetBonus2_Ab($value) { $this->bonus2_ab=$value; }
  function GetBonus2_Ab() { return $this->bonus2_ab; }
  function SetBonus3($value) { $this->bonus3=$value; }
  function GetBonus3() { return $this->bonus3; }
  function SetBonus3_Ab($value) { $this->bonus3_ab=$value; }
  function GetBonus3_Ab() { return $this->bonus3_ab; }
  function SetBonus4($value) { $this->bonus4=$value; }
  function GetBonus4() { return $this->bonus4; }
  function SetBonus4_Ab($value) { $this->bonus4_ab=$value; }
  function GetBonus4_Ab() { return $this->bonus4_ab; }
  function SetBonus5($value) { $this->bonus5=$value; }
  function GetBonus5() { return $this->bonus5; }
  function SetBonus5_Ab($value) { $this->bonus5_ab=$value; }
  function GetBonus5_Ab() { return $this->bonus5_ab; }
  function SetBonus6($value) { $this->bonus6=$value; }
  function GetBonus6() { return $this->bonus6; }
  function SetBonus6_Ab($value) { $this->bonus6_ab=$value; }
  function GetBonus6_Ab() { return $this->bonus6_ab; }
  function SetBonus7($value) { $this->bonus7=$value; }
  function GetBonus7() { return $this->bonus7; }
  function SetBonus7_Ab($value) { $this->bonus7_ab=$value; }
  function GetBonus7_Ab() { return $this->bonus7_ab; }
  function SetBonus8($value) { $this->bonus8=$value; }
  function GetBonus8() { return $this->bonus8; }
  function SetBonus8_Ab($value) { $this->bonus8_ab=$value; }
  function GetBonus8_Ab() { return $this->bonus8_ab; }
  function SetBonus9($value) { $this->bonus9=$value; }
  function GetBonus9() { return $this->bonus9; }
  function SetBonus9_Ab($value) { $this->bonus9_ab=$value; }
  function GetBonus9_Ab() { return $this->bonus9_ab; }
  function SetBonus10($value) { $this->bonus10=$value; }
  function GetBonus10() { return $this->bonus10; }
  function SetBonus10_Ab($value) { $this->bonus10_ab=$value; }
  function GetBonus10_Ab() { return $this->bonus10_ab; }
  function SetRechnung_Periode($value) { $this->rechnung_periode=$value; }
  function GetRechnung_Periode() { return $this->rechnung_periode; }
  function SetRechnung_Anzahlpapier($value) { $this->rechnung_anzahlpapier=$value; }
  function GetRechnung_Anzahlpapier() { return $this->rechnung_anzahlpapier; }
  function SetRechnung_Permail($value) { $this->rechnung_permail=$value; }
  function GetRechnung_Permail() { return $this->rechnung_permail; }
  function SetTitel($value) { $this->titel=$value; }
  function GetTitel() { return $this->titel; }
  function SetAnschreiben($value) { $this->anschreiben=$value; }
  function GetAnschreiben() { return $this->anschreiben; }
  function SetNachname($value) { $this->nachname=$value; }
  function GetNachname() { return $this->nachname; }
  function SetArbeitszeitprowoche($value) { $this->arbeitszeitprowoche=$value; }
  function GetArbeitszeitprowoche() { return $this->arbeitszeitprowoche; }
  function SetFolgebestaetigungsperre($value) { $this->folgebestaetigungsperre=$value; }
  function GetFolgebestaetigungsperre() { return $this->folgebestaetigungsperre; }
  function SetLieferantennummerbeikunde($value) { $this->lieferantennummerbeikunde=$value; }
  function GetLieferantennummerbeikunde() { return $this->lieferantennummerbeikunde; }
  function SetVerein_Mitglied_Seit($value) { $this->verein_mitglied_seit=$value; }
  function GetVerein_Mitglied_Seit() { return $this->verein_mitglied_seit; }
  function SetVerein_Mitglied_Bis($value) { $this->verein_mitglied_bis=$value; }
  function GetVerein_Mitglied_Bis() { return $this->verein_mitglied_bis; }
  function SetVerein_Mitglied_Aktiv($value) { $this->verein_mitglied_aktiv=$value; }
  function GetVerein_Mitglied_Aktiv() { return $this->verein_mitglied_aktiv; }
  function SetVerein_Spendenbescheinigung($value) { $this->verein_spendenbescheinigung=$value; }
  function GetVerein_Spendenbescheinigung() { return $this->verein_spendenbescheinigung; }
  function SetFreifeld4($value) { $this->freifeld4=$value; }
  function GetFreifeld4() { return $this->freifeld4; }
  function SetFreifeld5($value) { $this->freifeld5=$value; }
  function GetFreifeld5() { return $this->freifeld5; }
  function SetFreifeld6($value) { $this->freifeld6=$value; }
  function GetFreifeld6() { return $this->freifeld6; }
  function SetFreifeld7($value) { $this->freifeld7=$value; }
  function GetFreifeld7() { return $this->freifeld7; }
  function SetFreifeld8($value) { $this->freifeld8=$value; }
  function GetFreifeld8() { return $this->freifeld8; }
  function SetFreifeld9($value) { $this->freifeld9=$value; }
  function GetFreifeld9() { return $this->freifeld9; }
  function SetFreifeld10($value) { $this->freifeld10=$value; }
  function GetFreifeld10() { return $this->freifeld10; }
  function SetRechnung_Papier($value) { $this->rechnung_papier=$value; }
  function GetRechnung_Papier() { return $this->rechnung_papier; }
  function SetAngebot_Cc($value) { $this->angebot_cc=$value; }
  function GetAngebot_Cc() { return $this->angebot_cc; }
  function SetAuftrag_Cc($value) { $this->auftrag_cc=$value; }
  function GetAuftrag_Cc() { return $this->auftrag_cc; }
  function SetRechnung_Cc($value) { $this->rechnung_cc=$value; }
  function GetRechnung_Cc() { return $this->rechnung_cc; }
  function SetGutschrift_Cc($value) { $this->gutschrift_cc=$value; }
  function GetGutschrift_Cc() { return $this->gutschrift_cc; }
  function SetLieferschein_Cc($value) { $this->lieferschein_cc=$value; }
  function GetLieferschein_Cc() { return $this->lieferschein_cc; }
  function SetBestellung_Cc($value) { $this->bestellung_cc=$value; }
  function GetBestellung_Cc() { return $this->bestellung_cc; }
  function SetAngebot_Fax_Cc($value) { $this->angebot_fax_cc=$value; }
  function GetAngebot_Fax_Cc() { return $this->angebot_fax_cc; }
  function SetAuftrag_Fax_Cc($value) { $this->auftrag_fax_cc=$value; }
  function GetAuftrag_Fax_Cc() { return $this->auftrag_fax_cc; }
  function SetRechnung_Fax_Cc($value) { $this->rechnung_fax_cc=$value; }
  function GetRechnung_Fax_Cc() { return $this->rechnung_fax_cc; }
  function SetGutschrift_Fax_Cc($value) { $this->gutschrift_fax_cc=$value; }
  function GetGutschrift_Fax_Cc() { return $this->gutschrift_fax_cc; }
  function SetLieferschein_Fax_Cc($value) { $this->lieferschein_fax_cc=$value; }
  function GetLieferschein_Fax_Cc() { return $this->lieferschein_fax_cc; }
  function SetBestellung_Fax_Cc($value) { $this->bestellung_fax_cc=$value; }
  function GetBestellung_Fax_Cc() { return $this->bestellung_fax_cc; }
  function SetAbperfax($value) { $this->abperfax=$value; }
  function GetAbperfax() { return $this->abperfax; }
  function SetAbpermail($value) { $this->abpermail=$value; }
  function GetAbpermail() { return $this->abpermail; }
  function SetKassiereraktiv($value) { $this->kassiereraktiv=$value; }
  function GetKassiereraktiv() { return $this->kassiereraktiv; }
  function SetKassierernummer($value) { $this->kassierernummer=$value; }
  function GetKassierernummer() { return $this->kassierernummer; }
  function SetKassiererprojekt($value) { $this->kassiererprojekt=$value; }
  function GetKassiererprojekt() { return $this->kassiererprojekt; }
  function SetPortofreilieferant_Aktiv($value) { $this->portofreilieferant_aktiv=$value; }
  function GetPortofreilieferant_Aktiv() { return $this->portofreilieferant_aktiv; }
  function SetPortofreiablieferant($value) { $this->portofreiablieferant=$value; }
  function GetPortofreiablieferant() { return $this->portofreiablieferant; }
  function SetMandatsreferenzart($value) { $this->mandatsreferenzart=$value; }
  function GetMandatsreferenzart() { return $this->mandatsreferenzart; }
  function SetMandatsreferenzwdhart($value) { $this->mandatsreferenzwdhart=$value; }
  function GetMandatsreferenzwdhart() { return $this->mandatsreferenzwdhart; }
  function SetSerienbrief($value) { $this->serienbrief=$value; }
  function GetSerienbrief() { return $this->serienbrief; }
  function SetLead($value) { $this->lead=$value; }
  function GetLead() { return $this->lead; }
  function SetGeburtstagkalender($value) { $this->geburtstagkalender=$value; }
  function GetGeburtstagkalender() { return $this->geburtstagkalender; }

}

?>