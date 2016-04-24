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

class ObjGenGutschrift
{

  private  $id;
  private  $datum;
  private  $projekt;
  private  $anlegeart;
  private  $belegnr;
  private  $rechnung;
  private  $rechnungid;
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
  private  $plz;
  private  $ort;
  private  $land;
  private  $ustid;
  private  $ustbrief;
  private  $ustbrief_eingang;
  private  $ustbrief_eingang_am;
  private  $ust_befreit;
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
  private  $zahlungszieltage;
  private  $zahlungszieltageskonto;
  private  $zahlungszielskonto;
  private  $gesamtsumme;
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
  private  $paypalaccount;
  private  $firma;
  private  $versendet;
  private  $versendet_am;
  private  $versendet_per;
  private  $versendet_durch;
  private  $inbearbeitung;
  private  $logdatei;
  private  $dta_datei_verband;
  private  $manuell_vorabbezahlt;
  private  $manuell_vorabbezahlt_hinweis;
  private  $nicht_umsatzmindernd;
  private  $dta_datei;
  private  $deckungsbeitragcalc;
  private  $deckungsbeitrag;
  private  $erloes_netto;
  private  $umsatz_netto;
  private  $vertriebid;
  private  $aktion;
  private  $vertrieb;
  private  $provision;
  private  $provision_summe;
  private  $gruppe;
  private  $ihrebestellnummer;
  private  $anschreiben;
  private  $usereditid;
  private  $useredittimestamp;
  private  $realrabatt;
  private  $rabatt;
  private  $rabatt1;
  private  $rabatt2;
  private  $rabatt3;
  private  $rabatt4;
  private  $rabatt5;
  private  $steuersatz_normal;
  private  $steuersatz_zwischen;
  private  $steuersatz_ermaessigt;
  private  $steuersatz_starkermaessigt;
  private  $steuersatz_dienstleistung;
  private  $waehrung;
  private  $keinsteuersatz;
  private  $stornorechnung;
  private  $schreibschutz;
  private  $pdfarchiviert;
  private  $pdfarchiviertversion;
  private  $typ;
  private  $ohne_briefpapier;
  private  $lieferid;
  private  $ansprechpartnerid;
  private  $projektfiliale;

  public $app;            //application object 

  public function ObjGenGutschrift($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM gutschrift WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->datum=$result['datum'];
    $this->projekt=$result['projekt'];
    $this->anlegeart=$result['anlegeart'];
    $this->belegnr=$result['belegnr'];
    $this->rechnung=$result['rechnung'];
    $this->rechnungid=$result['rechnungid'];
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
    $this->plz=$result['plz'];
    $this->ort=$result['ort'];
    $this->land=$result['land'];
    $this->ustid=$result['ustid'];
    $this->ustbrief=$result['ustbrief'];
    $this->ustbrief_eingang=$result['ustbrief_eingang'];
    $this->ustbrief_eingang_am=$result['ustbrief_eingang_am'];
    $this->ust_befreit=$result['ust_befreit'];
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
    $this->zahlungszieltage=$result['zahlungszieltage'];
    $this->zahlungszieltageskonto=$result['zahlungszieltageskonto'];
    $this->zahlungszielskonto=$result['zahlungszielskonto'];
    $this->gesamtsumme=$result['gesamtsumme'];
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
    $this->paypalaccount=$result['paypalaccount'];
    $this->firma=$result['firma'];
    $this->versendet=$result['versendet'];
    $this->versendet_am=$result['versendet_am'];
    $this->versendet_per=$result['versendet_per'];
    $this->versendet_durch=$result['versendet_durch'];
    $this->inbearbeitung=$result['inbearbeitung'];
    $this->logdatei=$result['logdatei'];
    $this->dta_datei_verband=$result['dta_datei_verband'];
    $this->manuell_vorabbezahlt=$result['manuell_vorabbezahlt'];
    $this->manuell_vorabbezahlt_hinweis=$result['manuell_vorabbezahlt_hinweis'];
    $this->nicht_umsatzmindernd=$result['nicht_umsatzmindernd'];
    $this->dta_datei=$result['dta_datei'];
    $this->deckungsbeitragcalc=$result['deckungsbeitragcalc'];
    $this->deckungsbeitrag=$result['deckungsbeitrag'];
    $this->erloes_netto=$result['erloes_netto'];
    $this->umsatz_netto=$result['umsatz_netto'];
    $this->vertriebid=$result['vertriebid'];
    $this->aktion=$result['aktion'];
    $this->vertrieb=$result['vertrieb'];
    $this->provision=$result['provision'];
    $this->provision_summe=$result['provision_summe'];
    $this->gruppe=$result['gruppe'];
    $this->ihrebestellnummer=$result['ihrebestellnummer'];
    $this->anschreiben=$result['anschreiben'];
    $this->usereditid=$result['usereditid'];
    $this->useredittimestamp=$result['useredittimestamp'];
    $this->realrabatt=$result['realrabatt'];
    $this->rabatt=$result['rabatt'];
    $this->rabatt1=$result['rabatt1'];
    $this->rabatt2=$result['rabatt2'];
    $this->rabatt3=$result['rabatt3'];
    $this->rabatt4=$result['rabatt4'];
    $this->rabatt5=$result['rabatt5'];
    $this->steuersatz_normal=$result['steuersatz_normal'];
    $this->steuersatz_zwischen=$result['steuersatz_zwischen'];
    $this->steuersatz_ermaessigt=$result['steuersatz_ermaessigt'];
    $this->steuersatz_starkermaessigt=$result['steuersatz_starkermaessigt'];
    $this->steuersatz_dienstleistung=$result['steuersatz_dienstleistung'];
    $this->waehrung=$result['waehrung'];
    $this->keinsteuersatz=$result['keinsteuersatz'];
    $this->stornorechnung=$result['stornorechnung'];
    $this->schreibschutz=$result['schreibschutz'];
    $this->pdfarchiviert=$result['pdfarchiviert'];
    $this->pdfarchiviertversion=$result['pdfarchiviertversion'];
    $this->typ=$result['typ'];
    $this->ohne_briefpapier=$result['ohne_briefpapier'];
    $this->lieferid=$result['lieferid'];
    $this->ansprechpartnerid=$result['ansprechpartnerid'];
    $this->projektfiliale=$result['projektfiliale'];
  }

  public function Create()
  {
    $sql = "INSERT INTO gutschrift (id,datum,projekt,anlegeart,belegnr,rechnung,rechnungid,bearbeiter,freitext,internebemerkung,status,adresse,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,ustbrief,ustbrief_eingang,ustbrief_eingang_am,ust_befreit,email,telefon,telefax,betreff,kundennummer,lieferschein,versandart,lieferdatum,buchhaltung,zahlungsweise,zahlungsstatus,ist,soll,zahlungszieltage,zahlungszieltageskonto,zahlungszielskonto,gesamtsumme,bank_inhaber,bank_institut,bank_blz,bank_konto,kreditkarte_typ,kreditkarte_inhaber,kreditkarte_nummer,kreditkarte_pruefnummer,kreditkarte_monat,kreditkarte_jahr,paypalaccount,firma,versendet,versendet_am,versendet_per,versendet_durch,inbearbeitung,logdatei,dta_datei_verband,manuell_vorabbezahlt,manuell_vorabbezahlt_hinweis,nicht_umsatzmindernd,dta_datei,deckungsbeitragcalc,deckungsbeitrag,erloes_netto,umsatz_netto,vertriebid,aktion,vertrieb,provision,provision_summe,gruppe,ihrebestellnummer,anschreiben,usereditid,useredittimestamp,realrabatt,rabatt,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,steuersatz_normal,steuersatz_zwischen,steuersatz_ermaessigt,steuersatz_starkermaessigt,steuersatz_dienstleistung,waehrung,keinsteuersatz,stornorechnung,schreibschutz,pdfarchiviert,pdfarchiviertversion,typ,ohne_briefpapier,lieferid,ansprechpartnerid,projektfiliale)
      VALUES('','{$this->datum}','{$this->projekt}','{$this->anlegeart}','{$this->belegnr}','{$this->rechnung}','{$this->rechnungid}','{$this->bearbeiter}','{$this->freitext}','{$this->internebemerkung}','{$this->status}','{$this->adresse}','{$this->name}','{$this->abteilung}','{$this->unterabteilung}','{$this->strasse}','{$this->adresszusatz}','{$this->plz}','{$this->ort}','{$this->land}','{$this->ustid}','{$this->ustbrief}','{$this->ustbrief_eingang}','{$this->ustbrief_eingang_am}','{$this->ust_befreit}','{$this->email}','{$this->telefon}','{$this->telefax}','{$this->betreff}','{$this->kundennummer}','{$this->lieferschein}','{$this->versandart}','{$this->lieferdatum}','{$this->buchhaltung}','{$this->zahlungsweise}','{$this->zahlungsstatus}','{$this->ist}','{$this->soll}','{$this->zahlungszieltage}','{$this->zahlungszieltageskonto}','{$this->zahlungszielskonto}','{$this->gesamtsumme}','{$this->bank_inhaber}','{$this->bank_institut}','{$this->bank_blz}','{$this->bank_konto}','{$this->kreditkarte_typ}','{$this->kreditkarte_inhaber}','{$this->kreditkarte_nummer}','{$this->kreditkarte_pruefnummer}','{$this->kreditkarte_monat}','{$this->kreditkarte_jahr}','{$this->paypalaccount}','{$this->firma}','{$this->versendet}','{$this->versendet_am}','{$this->versendet_per}','{$this->versendet_durch}','{$this->inbearbeitung}','{$this->logdatei}','{$this->dta_datei_verband}','{$this->manuell_vorabbezahlt}','{$this->manuell_vorabbezahlt_hinweis}','{$this->nicht_umsatzmindernd}','{$this->dta_datei}','{$this->deckungsbeitragcalc}','{$this->deckungsbeitrag}','{$this->erloes_netto}','{$this->umsatz_netto}','{$this->vertriebid}','{$this->aktion}','{$this->vertrieb}','{$this->provision}','{$this->provision_summe}','{$this->gruppe}','{$this->ihrebestellnummer}','{$this->anschreiben}','{$this->usereditid}','{$this->useredittimestamp}','{$this->realrabatt}','{$this->rabatt}','{$this->rabatt1}','{$this->rabatt2}','{$this->rabatt3}','{$this->rabatt4}','{$this->rabatt5}','{$this->steuersatz_normal}','{$this->steuersatz_zwischen}','{$this->steuersatz_ermaessigt}','{$this->steuersatz_starkermaessigt}','{$this->steuersatz_dienstleistung}','{$this->waehrung}','{$this->keinsteuersatz}','{$this->stornorechnung}','{$this->schreibschutz}','{$this->pdfarchiviert}','{$this->pdfarchiviertversion}','{$this->typ}','{$this->ohne_briefpapier}','{$this->lieferid}','{$this->ansprechpartnerid}','{$this->projektfiliale}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE gutschrift SET
      datum='{$this->datum}',
      projekt='{$this->projekt}',
      anlegeart='{$this->anlegeart}',
      belegnr='{$this->belegnr}',
      rechnung='{$this->rechnung}',
      rechnungid='{$this->rechnungid}',
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
      plz='{$this->plz}',
      ort='{$this->ort}',
      land='{$this->land}',
      ustid='{$this->ustid}',
      ustbrief='{$this->ustbrief}',
      ustbrief_eingang='{$this->ustbrief_eingang}',
      ustbrief_eingang_am='{$this->ustbrief_eingang_am}',
      ust_befreit='{$this->ust_befreit}',
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
      zahlungszieltage='{$this->zahlungszieltage}',
      zahlungszieltageskonto='{$this->zahlungszieltageskonto}',
      zahlungszielskonto='{$this->zahlungszielskonto}',
      gesamtsumme='{$this->gesamtsumme}',
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
      paypalaccount='{$this->paypalaccount}',
      firma='{$this->firma}',
      versendet='{$this->versendet}',
      versendet_am='{$this->versendet_am}',
      versendet_per='{$this->versendet_per}',
      versendet_durch='{$this->versendet_durch}',
      inbearbeitung='{$this->inbearbeitung}',
      logdatei='{$this->logdatei}',
      dta_datei_verband='{$this->dta_datei_verband}',
      manuell_vorabbezahlt='{$this->manuell_vorabbezahlt}',
      manuell_vorabbezahlt_hinweis='{$this->manuell_vorabbezahlt_hinweis}',
      nicht_umsatzmindernd='{$this->nicht_umsatzmindernd}',
      dta_datei='{$this->dta_datei}',
      deckungsbeitragcalc='{$this->deckungsbeitragcalc}',
      deckungsbeitrag='{$this->deckungsbeitrag}',
      erloes_netto='{$this->erloes_netto}',
      umsatz_netto='{$this->umsatz_netto}',
      vertriebid='{$this->vertriebid}',
      aktion='{$this->aktion}',
      vertrieb='{$this->vertrieb}',
      provision='{$this->provision}',
      provision_summe='{$this->provision_summe}',
      gruppe='{$this->gruppe}',
      ihrebestellnummer='{$this->ihrebestellnummer}',
      anschreiben='{$this->anschreiben}',
      usereditid='{$this->usereditid}',
      useredittimestamp='{$this->useredittimestamp}',
      realrabatt='{$this->realrabatt}',
      rabatt='{$this->rabatt}',
      rabatt1='{$this->rabatt1}',
      rabatt2='{$this->rabatt2}',
      rabatt3='{$this->rabatt3}',
      rabatt4='{$this->rabatt4}',
      rabatt5='{$this->rabatt5}',
      steuersatz_normal='{$this->steuersatz_normal}',
      steuersatz_zwischen='{$this->steuersatz_zwischen}',
      steuersatz_ermaessigt='{$this->steuersatz_ermaessigt}',
      steuersatz_starkermaessigt='{$this->steuersatz_starkermaessigt}',
      steuersatz_dienstleistung='{$this->steuersatz_dienstleistung}',
      waehrung='{$this->waehrung}',
      keinsteuersatz='{$this->keinsteuersatz}',
      stornorechnung='{$this->stornorechnung}',
      schreibschutz='{$this->schreibschutz}',
      pdfarchiviert='{$this->pdfarchiviert}',
      pdfarchiviertversion='{$this->pdfarchiviertversion}',
      typ='{$this->typ}',
      ohne_briefpapier='{$this->ohne_briefpapier}',
      lieferid='{$this->lieferid}',
      ansprechpartnerid='{$this->ansprechpartnerid}',
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

    $sql = "DELETE FROM gutschrift WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->datum="";
    $this->projekt="";
    $this->anlegeart="";
    $this->belegnr="";
    $this->rechnung="";
    $this->rechnungid="";
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
    $this->plz="";
    $this->ort="";
    $this->land="";
    $this->ustid="";
    $this->ustbrief="";
    $this->ustbrief_eingang="";
    $this->ustbrief_eingang_am="";
    $this->ust_befreit="";
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
    $this->zahlungszieltage="";
    $this->zahlungszieltageskonto="";
    $this->zahlungszielskonto="";
    $this->gesamtsumme="";
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
    $this->paypalaccount="";
    $this->firma="";
    $this->versendet="";
    $this->versendet_am="";
    $this->versendet_per="";
    $this->versendet_durch="";
    $this->inbearbeitung="";
    $this->logdatei="";
    $this->dta_datei_verband="";
    $this->manuell_vorabbezahlt="";
    $this->manuell_vorabbezahlt_hinweis="";
    $this->nicht_umsatzmindernd="";
    $this->dta_datei="";
    $this->deckungsbeitragcalc="";
    $this->deckungsbeitrag="";
    $this->erloes_netto="";
    $this->umsatz_netto="";
    $this->vertriebid="";
    $this->aktion="";
    $this->vertrieb="";
    $this->provision="";
    $this->provision_summe="";
    $this->gruppe="";
    $this->ihrebestellnummer="";
    $this->anschreiben="";
    $this->usereditid="";
    $this->useredittimestamp="";
    $this->realrabatt="";
    $this->rabatt="";
    $this->rabatt1="";
    $this->rabatt2="";
    $this->rabatt3="";
    $this->rabatt4="";
    $this->rabatt5="";
    $this->steuersatz_normal="";
    $this->steuersatz_zwischen="";
    $this->steuersatz_ermaessigt="";
    $this->steuersatz_starkermaessigt="";
    $this->steuersatz_dienstleistung="";
    $this->waehrung="";
    $this->keinsteuersatz="";
    $this->stornorechnung="";
    $this->schreibschutz="";
    $this->pdfarchiviert="";
    $this->pdfarchiviertversion="";
    $this->typ="";
    $this->ohne_briefpapier="";
    $this->lieferid="";
    $this->ansprechpartnerid="";
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
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetAnlegeart($value) { $this->anlegeart=$value; }
  function GetAnlegeart() { return $this->anlegeart; }
  function SetBelegnr($value) { $this->belegnr=$value; }
  function GetBelegnr() { return $this->belegnr; }
  function SetRechnung($value) { $this->rechnung=$value; }
  function GetRechnung() { return $this->rechnung; }
  function SetRechnungid($value) { $this->rechnungid=$value; }
  function GetRechnungid() { return $this->rechnungid; }
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
  function SetPlz($value) { $this->plz=$value; }
  function GetPlz() { return $this->plz; }
  function SetOrt($value) { $this->ort=$value; }
  function GetOrt() { return $this->ort; }
  function SetLand($value) { $this->land=$value; }
  function GetLand() { return $this->land; }
  function SetUstid($value) { $this->ustid=$value; }
  function GetUstid() { return $this->ustid; }
  function SetUstbrief($value) { $this->ustbrief=$value; }
  function GetUstbrief() { return $this->ustbrief; }
  function SetUstbrief_Eingang($value) { $this->ustbrief_eingang=$value; }
  function GetUstbrief_Eingang() { return $this->ustbrief_eingang; }
  function SetUstbrief_Eingang_Am($value) { $this->ustbrief_eingang_am=$value; }
  function GetUstbrief_Eingang_Am() { return $this->ustbrief_eingang_am; }
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
  function SetPaypalaccount($value) { $this->paypalaccount=$value; }
  function GetPaypalaccount() { return $this->paypalaccount; }
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
  function SetInbearbeitung($value) { $this->inbearbeitung=$value; }
  function GetInbearbeitung() { return $this->inbearbeitung; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetDta_Datei_Verband($value) { $this->dta_datei_verband=$value; }
  function GetDta_Datei_Verband() { return $this->dta_datei_verband; }
  function SetManuell_Vorabbezahlt($value) { $this->manuell_vorabbezahlt=$value; }
  function GetManuell_Vorabbezahlt() { return $this->manuell_vorabbezahlt; }
  function SetManuell_Vorabbezahlt_Hinweis($value) { $this->manuell_vorabbezahlt_hinweis=$value; }
  function GetManuell_Vorabbezahlt_Hinweis() { return $this->manuell_vorabbezahlt_hinweis; }
  function SetNicht_Umsatzmindernd($value) { $this->nicht_umsatzmindernd=$value; }
  function GetNicht_Umsatzmindernd() { return $this->nicht_umsatzmindernd; }
  function SetDta_Datei($value) { $this->dta_datei=$value; }
  function GetDta_Datei() { return $this->dta_datei; }
  function SetDeckungsbeitragcalc($value) { $this->deckungsbeitragcalc=$value; }
  function GetDeckungsbeitragcalc() { return $this->deckungsbeitragcalc; }
  function SetDeckungsbeitrag($value) { $this->deckungsbeitrag=$value; }
  function GetDeckungsbeitrag() { return $this->deckungsbeitrag; }
  function SetErloes_Netto($value) { $this->erloes_netto=$value; }
  function GetErloes_Netto() { return $this->erloes_netto; }
  function SetUmsatz_Netto($value) { $this->umsatz_netto=$value; }
  function GetUmsatz_Netto() { return $this->umsatz_netto; }
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
  function SetStornorechnung($value) { $this->stornorechnung=$value; }
  function GetStornorechnung() { return $this->stornorechnung; }
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
  function SetProjektfiliale($value) { $this->projektfiliale=$value; }
  function GetProjektfiliale() { return $this->projektfiliale; }

}

?>