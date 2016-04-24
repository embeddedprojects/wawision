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

class ObjGenBestellung
{

  private  $id;
  private  $datum;
  private  $projekt;
  private  $bestellungsart;
  private  $belegnr;
  private  $bearbeiter;
  private  $angebot;
  private  $freitext;
  private  $internebemerkung;
  private  $status;
  private  $adresse;
  private  $name;
  private  $vorname;
  private  $abteilung;
  private  $unterabteilung;
  private  $strasse;
  private  $adresszusatz;
  private  $plz;
  private  $ort;
  private  $land;
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
  private  $ustid;
  private  $ust_befreit;
  private  $email;
  private  $telefon;
  private  $telefax;
  private  $betreff;
  private  $kundennummer;
  private  $lieferantennummer;
  private  $versandart;
  private  $lieferdatum;
  private  $einkaeufer;
  private  $keineartikelnummern;
  private  $zahlungsweise;
  private  $zahlungsstatus;
  private  $zahlungszieltage;
  private  $zahlungszieltageskonto;
  private  $zahlungszielskonto;
  private  $gesamtsumme;
  private  $bank_inhaber;
  private  $bank_institut;
  private  $bank_blz;
  private  $bank_konto;
  private  $paypalaccount;
  private  $bestellbestaetigung;
  private  $firma;
  private  $versendet;
  private  $versendet_am;
  private  $versendet_per;
  private  $versendet_durch;
  private  $logdatei;
  private  $artikelnummerninfotext;
  private  $ansprechpartner;
  private  $anschreiben;
  private  $usereditid;
  private  $useredittimestamp;
  private  $steuersatz_normal;
  private  $steuersatz_zwischen;
  private  $steuersatz_ermaessigt;
  private  $steuersatz_starkermaessigt;
  private  $steuersatz_dienstleistung;
  private  $waehrung;
  private  $bestellungohnepreis;
  private  $schreibschutz;
  private  $pdfarchiviert;
  private  $pdfarchiviertversion;
  private  $typ;
  private  $verbindlichkeiteninfo;
  private  $ohne_briefpapier;
  private  $projektfiliale;
  private  $bestellung_bestaetigt;
  private  $bestaetigteslieferdatum;
  private  $bestellungbestaetigtper;
  private  $bestellungbestaetigtabnummer;
  private  $gewuenschteslieferdatum;

  public $app;            //application object 

  public function ObjGenBestellung($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM bestellung WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->datum=$result['datum'];
    $this->projekt=$result['projekt'];
    $this->bestellungsart=$result['bestellungsart'];
    $this->belegnr=$result['belegnr'];
    $this->bearbeiter=$result['bearbeiter'];
    $this->angebot=$result['angebot'];
    $this->freitext=$result['freitext'];
    $this->internebemerkung=$result['internebemerkung'];
    $this->status=$result['status'];
    $this->adresse=$result['adresse'];
    $this->name=$result['name'];
    $this->vorname=$result['vorname'];
    $this->abteilung=$result['abteilung'];
    $this->unterabteilung=$result['unterabteilung'];
    $this->strasse=$result['strasse'];
    $this->adresszusatz=$result['adresszusatz'];
    $this->plz=$result['plz'];
    $this->ort=$result['ort'];
    $this->land=$result['land'];
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
    $this->ustid=$result['ustid'];
    $this->ust_befreit=$result['ust_befreit'];
    $this->email=$result['email'];
    $this->telefon=$result['telefon'];
    $this->telefax=$result['telefax'];
    $this->betreff=$result['betreff'];
    $this->kundennummer=$result['kundennummer'];
    $this->lieferantennummer=$result['lieferantennummer'];
    $this->versandart=$result['versandart'];
    $this->lieferdatum=$result['lieferdatum'];
    $this->einkaeufer=$result['einkaeufer'];
    $this->keineartikelnummern=$result['keineartikelnummern'];
    $this->zahlungsweise=$result['zahlungsweise'];
    $this->zahlungsstatus=$result['zahlungsstatus'];
    $this->zahlungszieltage=$result['zahlungszieltage'];
    $this->zahlungszieltageskonto=$result['zahlungszieltageskonto'];
    $this->zahlungszielskonto=$result['zahlungszielskonto'];
    $this->gesamtsumme=$result['gesamtsumme'];
    $this->bank_inhaber=$result['bank_inhaber'];
    $this->bank_institut=$result['bank_institut'];
    $this->bank_blz=$result['bank_blz'];
    $this->bank_konto=$result['bank_konto'];
    $this->paypalaccount=$result['paypalaccount'];
    $this->bestellbestaetigung=$result['bestellbestaetigung'];
    $this->firma=$result['firma'];
    $this->versendet=$result['versendet'];
    $this->versendet_am=$result['versendet_am'];
    $this->versendet_per=$result['versendet_per'];
    $this->versendet_durch=$result['versendet_durch'];
    $this->logdatei=$result['logdatei'];
    $this->artikelnummerninfotext=$result['artikelnummerninfotext'];
    $this->ansprechpartner=$result['ansprechpartner'];
    $this->anschreiben=$result['anschreiben'];
    $this->usereditid=$result['usereditid'];
    $this->useredittimestamp=$result['useredittimestamp'];
    $this->steuersatz_normal=$result['steuersatz_normal'];
    $this->steuersatz_zwischen=$result['steuersatz_zwischen'];
    $this->steuersatz_ermaessigt=$result['steuersatz_ermaessigt'];
    $this->steuersatz_starkermaessigt=$result['steuersatz_starkermaessigt'];
    $this->steuersatz_dienstleistung=$result['steuersatz_dienstleistung'];
    $this->waehrung=$result['waehrung'];
    $this->bestellungohnepreis=$result['bestellungohnepreis'];
    $this->schreibschutz=$result['schreibschutz'];
    $this->pdfarchiviert=$result['pdfarchiviert'];
    $this->pdfarchiviertversion=$result['pdfarchiviertversion'];
    $this->typ=$result['typ'];
    $this->verbindlichkeiteninfo=$result['verbindlichkeiteninfo'];
    $this->ohne_briefpapier=$result['ohne_briefpapier'];
    $this->projektfiliale=$result['projektfiliale'];
    $this->bestellung_bestaetigt=$result['bestellung_bestaetigt'];
    $this->bestaetigteslieferdatum=$result['bestaetigteslieferdatum'];
    $this->bestellungbestaetigtper=$result['bestellungbestaetigtper'];
    $this->bestellungbestaetigtabnummer=$result['bestellungbestaetigtabnummer'];
    $this->gewuenschteslieferdatum=$result['gewuenschteslieferdatum'];
  }

  public function Create()
  {
    $sql = "INSERT INTO bestellung (id,datum,projekt,bestellungsart,belegnr,bearbeiter,angebot,freitext,internebemerkung,status,adresse,name,vorname,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,abweichendelieferadresse,liefername,lieferabteilung,lieferunterabteilung,lieferland,lieferstrasse,lieferort,lieferplz,lieferadresszusatz,lieferansprechpartner,ustid,ust_befreit,email,telefon,telefax,betreff,kundennummer,lieferantennummer,versandart,lieferdatum,einkaeufer,keineartikelnummern,zahlungsweise,zahlungsstatus,zahlungszieltage,zahlungszieltageskonto,zahlungszielskonto,gesamtsumme,bank_inhaber,bank_institut,bank_blz,bank_konto,paypalaccount,bestellbestaetigung,firma,versendet,versendet_am,versendet_per,versendet_durch,logdatei,artikelnummerninfotext,ansprechpartner,anschreiben,usereditid,useredittimestamp,steuersatz_normal,steuersatz_zwischen,steuersatz_ermaessigt,steuersatz_starkermaessigt,steuersatz_dienstleistung,waehrung,bestellungohnepreis,schreibschutz,pdfarchiviert,pdfarchiviertversion,typ,verbindlichkeiteninfo,ohne_briefpapier,projektfiliale,bestellung_bestaetigt,bestaetigteslieferdatum,bestellungbestaetigtper,bestellungbestaetigtabnummer,gewuenschteslieferdatum)
      VALUES('','{$this->datum}','{$this->projekt}','{$this->bestellungsart}','{$this->belegnr}','{$this->bearbeiter}','{$this->angebot}','{$this->freitext}','{$this->internebemerkung}','{$this->status}','{$this->adresse}','{$this->name}','{$this->vorname}','{$this->abteilung}','{$this->unterabteilung}','{$this->strasse}','{$this->adresszusatz}','{$this->plz}','{$this->ort}','{$this->land}','{$this->abweichendelieferadresse}','{$this->liefername}','{$this->lieferabteilung}','{$this->lieferunterabteilung}','{$this->lieferland}','{$this->lieferstrasse}','{$this->lieferort}','{$this->lieferplz}','{$this->lieferadresszusatz}','{$this->lieferansprechpartner}','{$this->ustid}','{$this->ust_befreit}','{$this->email}','{$this->telefon}','{$this->telefax}','{$this->betreff}','{$this->kundennummer}','{$this->lieferantennummer}','{$this->versandart}','{$this->lieferdatum}','{$this->einkaeufer}','{$this->keineartikelnummern}','{$this->zahlungsweise}','{$this->zahlungsstatus}','{$this->zahlungszieltage}','{$this->zahlungszieltageskonto}','{$this->zahlungszielskonto}','{$this->gesamtsumme}','{$this->bank_inhaber}','{$this->bank_institut}','{$this->bank_blz}','{$this->bank_konto}','{$this->paypalaccount}','{$this->bestellbestaetigung}','{$this->firma}','{$this->versendet}','{$this->versendet_am}','{$this->versendet_per}','{$this->versendet_durch}','{$this->logdatei}','{$this->artikelnummerninfotext}','{$this->ansprechpartner}','{$this->anschreiben}','{$this->usereditid}','{$this->useredittimestamp}','{$this->steuersatz_normal}','{$this->steuersatz_zwischen}','{$this->steuersatz_ermaessigt}','{$this->steuersatz_starkermaessigt}','{$this->steuersatz_dienstleistung}','{$this->waehrung}','{$this->bestellungohnepreis}','{$this->schreibschutz}','{$this->pdfarchiviert}','{$this->pdfarchiviertversion}','{$this->typ}','{$this->verbindlichkeiteninfo}','{$this->ohne_briefpapier}','{$this->projektfiliale}','{$this->bestellung_bestaetigt}','{$this->bestaetigteslieferdatum}','{$this->bestellungbestaetigtper}','{$this->bestellungbestaetigtabnummer}','{$this->gewuenschteslieferdatum}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE bestellung SET
      datum='{$this->datum}',
      projekt='{$this->projekt}',
      bestellungsart='{$this->bestellungsart}',
      belegnr='{$this->belegnr}',
      bearbeiter='{$this->bearbeiter}',
      angebot='{$this->angebot}',
      freitext='{$this->freitext}',
      internebemerkung='{$this->internebemerkung}',
      status='{$this->status}',
      adresse='{$this->adresse}',
      name='{$this->name}',
      vorname='{$this->vorname}',
      abteilung='{$this->abteilung}',
      unterabteilung='{$this->unterabteilung}',
      strasse='{$this->strasse}',
      adresszusatz='{$this->adresszusatz}',
      plz='{$this->plz}',
      ort='{$this->ort}',
      land='{$this->land}',
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
      ustid='{$this->ustid}',
      ust_befreit='{$this->ust_befreit}',
      email='{$this->email}',
      telefon='{$this->telefon}',
      telefax='{$this->telefax}',
      betreff='{$this->betreff}',
      kundennummer='{$this->kundennummer}',
      lieferantennummer='{$this->lieferantennummer}',
      versandart='{$this->versandart}',
      lieferdatum='{$this->lieferdatum}',
      einkaeufer='{$this->einkaeufer}',
      keineartikelnummern='{$this->keineartikelnummern}',
      zahlungsweise='{$this->zahlungsweise}',
      zahlungsstatus='{$this->zahlungsstatus}',
      zahlungszieltage='{$this->zahlungszieltage}',
      zahlungszieltageskonto='{$this->zahlungszieltageskonto}',
      zahlungszielskonto='{$this->zahlungszielskonto}',
      gesamtsumme='{$this->gesamtsumme}',
      bank_inhaber='{$this->bank_inhaber}',
      bank_institut='{$this->bank_institut}',
      bank_blz='{$this->bank_blz}',
      bank_konto='{$this->bank_konto}',
      paypalaccount='{$this->paypalaccount}',
      bestellbestaetigung='{$this->bestellbestaetigung}',
      firma='{$this->firma}',
      versendet='{$this->versendet}',
      versendet_am='{$this->versendet_am}',
      versendet_per='{$this->versendet_per}',
      versendet_durch='{$this->versendet_durch}',
      logdatei='{$this->logdatei}',
      artikelnummerninfotext='{$this->artikelnummerninfotext}',
      ansprechpartner='{$this->ansprechpartner}',
      anschreiben='{$this->anschreiben}',
      usereditid='{$this->usereditid}',
      useredittimestamp='{$this->useredittimestamp}',
      steuersatz_normal='{$this->steuersatz_normal}',
      steuersatz_zwischen='{$this->steuersatz_zwischen}',
      steuersatz_ermaessigt='{$this->steuersatz_ermaessigt}',
      steuersatz_starkermaessigt='{$this->steuersatz_starkermaessigt}',
      steuersatz_dienstleistung='{$this->steuersatz_dienstleistung}',
      waehrung='{$this->waehrung}',
      bestellungohnepreis='{$this->bestellungohnepreis}',
      schreibschutz='{$this->schreibschutz}',
      pdfarchiviert='{$this->pdfarchiviert}',
      pdfarchiviertversion='{$this->pdfarchiviertversion}',
      typ='{$this->typ}',
      verbindlichkeiteninfo='{$this->verbindlichkeiteninfo}',
      ohne_briefpapier='{$this->ohne_briefpapier}',
      projektfiliale='{$this->projektfiliale}',
      bestellung_bestaetigt='{$this->bestellung_bestaetigt}',
      bestaetigteslieferdatum='{$this->bestaetigteslieferdatum}',
      bestellungbestaetigtper='{$this->bestellungbestaetigtper}',
      bestellungbestaetigtabnummer='{$this->bestellungbestaetigtabnummer}',
      gewuenschteslieferdatum='{$this->gewuenschteslieferdatum}'
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

    $sql = "DELETE FROM bestellung WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->datum="";
    $this->projekt="";
    $this->bestellungsart="";
    $this->belegnr="";
    $this->bearbeiter="";
    $this->angebot="";
    $this->freitext="";
    $this->internebemerkung="";
    $this->status="";
    $this->adresse="";
    $this->name="";
    $this->vorname="";
    $this->abteilung="";
    $this->unterabteilung="";
    $this->strasse="";
    $this->adresszusatz="";
    $this->plz="";
    $this->ort="";
    $this->land="";
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
    $this->ustid="";
    $this->ust_befreit="";
    $this->email="";
    $this->telefon="";
    $this->telefax="";
    $this->betreff="";
    $this->kundennummer="";
    $this->lieferantennummer="";
    $this->versandart="";
    $this->lieferdatum="";
    $this->einkaeufer="";
    $this->keineartikelnummern="";
    $this->zahlungsweise="";
    $this->zahlungsstatus="";
    $this->zahlungszieltage="";
    $this->zahlungszieltageskonto="";
    $this->zahlungszielskonto="";
    $this->gesamtsumme="";
    $this->bank_inhaber="";
    $this->bank_institut="";
    $this->bank_blz="";
    $this->bank_konto="";
    $this->paypalaccount="";
    $this->bestellbestaetigung="";
    $this->firma="";
    $this->versendet="";
    $this->versendet_am="";
    $this->versendet_per="";
    $this->versendet_durch="";
    $this->logdatei="";
    $this->artikelnummerninfotext="";
    $this->ansprechpartner="";
    $this->anschreiben="";
    $this->usereditid="";
    $this->useredittimestamp="";
    $this->steuersatz_normal="";
    $this->steuersatz_zwischen="";
    $this->steuersatz_ermaessigt="";
    $this->steuersatz_starkermaessigt="";
    $this->steuersatz_dienstleistung="";
    $this->waehrung="";
    $this->bestellungohnepreis="";
    $this->schreibschutz="";
    $this->pdfarchiviert="";
    $this->pdfarchiviertversion="";
    $this->typ="";
    $this->verbindlichkeiteninfo="";
    $this->ohne_briefpapier="";
    $this->projektfiliale="";
    $this->bestellung_bestaetigt="";
    $this->bestaetigteslieferdatum="";
    $this->bestellungbestaetigtper="";
    $this->bestellungbestaetigtabnummer="";
    $this->gewuenschteslieferdatum="";
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
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetBestellungsart($value) { $this->bestellungsart=$value; }
  function GetBestellungsart() { return $this->bestellungsart; }
  function SetBelegnr($value) { $this->belegnr=$value; }
  function GetBelegnr() { return $this->belegnr; }
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
  function SetVorname($value) { $this->vorname=$value; }
  function GetVorname() { return $this->vorname; }
  function SetAbteilung($value) { $this->abteilung=$value; }
  function GetAbteilung() { return $this->abteilung; }
  function SetUnterabteilung($value) { $this->unterabteilung=$value; }
  function GetUnterabteilung() { return $this->unterabteilung; }
  function SetStrasse($value) { $this->strasse=$value; }
  function GetStrasse() { return $this->strasse; }
  function SetAdresszusatz($value) { $this->adresszusatz=$value; }
  function GetAdresszusatz() { return $this->adresszusatz; }
  function SetPlz($value) { $this->plz=$value; }
  function GetPlz() { return $this->plz; }
  function SetOrt($value) { $this->ort=$value; }
  function GetOrt() { return $this->ort; }
  function SetLand($value) { $this->land=$value; }
  function GetLand() { return $this->land; }
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
  function SetUstid($value) { $this->ustid=$value; }
  function GetUstid() { return $this->ustid; }
  function SetUst_Befreit($value) { $this->ust_befreit=$value; }
  function GetUst_Befreit() { return $this->ust_befreit; }
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
  function SetLieferantennummer($value) { $this->lieferantennummer=$value; }
  function GetLieferantennummer() { return $this->lieferantennummer; }
  function SetVersandart($value) { $this->versandart=$value; }
  function GetVersandart() { return $this->versandart; }
  function SetLieferdatum($value) { $this->lieferdatum=$value; }
  function GetLieferdatum() { return $this->lieferdatum; }
  function SetEinkaeufer($value) { $this->einkaeufer=$value; }
  function GetEinkaeufer() { return $this->einkaeufer; }
  function SetKeineartikelnummern($value) { $this->keineartikelnummern=$value; }
  function GetKeineartikelnummern() { return $this->keineartikelnummern; }
  function SetZahlungsweise($value) { $this->zahlungsweise=$value; }
  function GetZahlungsweise() { return $this->zahlungsweise; }
  function SetZahlungsstatus($value) { $this->zahlungsstatus=$value; }
  function GetZahlungsstatus() { return $this->zahlungsstatus; }
  function SetZahlungszieltage($value) { $this->zahlungszieltage=$value; }
  function GetZahlungszieltage() { return $this->zahlungszieltage; }
  function SetZahlungszieltageskonto($value) { $this->zahlungszieltageskonto=$value; }
  function GetZahlungszieltageskonto() { return $this->zahlungszieltageskonto; }
  function SetZahlungszielskonto($value) { $this->zahlungszielskonto=$value; }
  function GetZahlungszielskonto() { return $this->zahlungszielskonto; }
  function SetGesamtsumme($value) { $this->gesamtsumme=$value; }
  function GetGesamtsumme() { return $this->gesamtsumme; }
  function SetBank_Inhaber($value) { $this->bank_inhaber=$value; }
  function GetBank_Inhaber() { return $this->bank_inhaber; }
  function SetBank_Institut($value) { $this->bank_institut=$value; }
  function GetBank_Institut() { return $this->bank_institut; }
  function SetBank_Blz($value) { $this->bank_blz=$value; }
  function GetBank_Blz() { return $this->bank_blz; }
  function SetBank_Konto($value) { $this->bank_konto=$value; }
  function GetBank_Konto() { return $this->bank_konto; }
  function SetPaypalaccount($value) { $this->paypalaccount=$value; }
  function GetPaypalaccount() { return $this->paypalaccount; }
  function SetBestellbestaetigung($value) { $this->bestellbestaetigung=$value; }
  function GetBestellbestaetigung() { return $this->bestellbestaetigung; }
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
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetArtikelnummerninfotext($value) { $this->artikelnummerninfotext=$value; }
  function GetArtikelnummerninfotext() { return $this->artikelnummerninfotext; }
  function SetAnsprechpartner($value) { $this->ansprechpartner=$value; }
  function GetAnsprechpartner() { return $this->ansprechpartner; }
  function SetAnschreiben($value) { $this->anschreiben=$value; }
  function GetAnschreiben() { return $this->anschreiben; }
  function SetUsereditid($value) { $this->usereditid=$value; }
  function GetUsereditid() { return $this->usereditid; }
  function SetUseredittimestamp($value) { $this->useredittimestamp=$value; }
  function GetUseredittimestamp() { return $this->useredittimestamp; }
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
  function SetBestellungohnepreis($value) { $this->bestellungohnepreis=$value; }
  function GetBestellungohnepreis() { return $this->bestellungohnepreis; }
  function SetSchreibschutz($value) { $this->schreibschutz=$value; }
  function GetSchreibschutz() { return $this->schreibschutz; }
  function SetPdfarchiviert($value) { $this->pdfarchiviert=$value; }
  function GetPdfarchiviert() { return $this->pdfarchiviert; }
  function SetPdfarchiviertversion($value) { $this->pdfarchiviertversion=$value; }
  function GetPdfarchiviertversion() { return $this->pdfarchiviertversion; }
  function SetTyp($value) { $this->typ=$value; }
  function GetTyp() { return $this->typ; }
  function SetVerbindlichkeiteninfo($value) { $this->verbindlichkeiteninfo=$value; }
  function GetVerbindlichkeiteninfo() { return $this->verbindlichkeiteninfo; }
  function SetOhne_Briefpapier($value) { $this->ohne_briefpapier=$value; }
  function GetOhne_Briefpapier() { return $this->ohne_briefpapier; }
  function SetProjektfiliale($value) { $this->projektfiliale=$value; }
  function GetProjektfiliale() { return $this->projektfiliale; }
  function SetBestellung_Bestaetigt($value) { $this->bestellung_bestaetigt=$value; }
  function GetBestellung_Bestaetigt() { return $this->bestellung_bestaetigt; }
  function SetBestaetigteslieferdatum($value) { $this->bestaetigteslieferdatum=$value; }
  function GetBestaetigteslieferdatum() { return $this->bestaetigteslieferdatum; }
  function SetBestellungbestaetigtper($value) { $this->bestellungbestaetigtper=$value; }
  function GetBestellungbestaetigtper() { return $this->bestellungbestaetigtper; }
  function SetBestellungbestaetigtabnummer($value) { $this->bestellungbestaetigtabnummer=$value; }
  function GetBestellungbestaetigtabnummer() { return $this->bestellungbestaetigtabnummer; }
  function SetGewuenschteslieferdatum($value) { $this->gewuenschteslieferdatum=$value; }
  function GetGewuenschteslieferdatum() { return $this->gewuenschteslieferdatum; }

}

?>