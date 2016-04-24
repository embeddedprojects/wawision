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

class ObjGenAngebot
{

  private  $id;
  private  $datum;
  private  $gueltigbis;
  private  $projekt;
  private  $belegnr;
  private  $bearbeiter;
  private  $anfrage;
  private  $auftrag;
  private  $freitext;
  private  $internebemerkung;
  private  $status;
  private  $adresse;
  private  $retyp;
  private  $rechnungname;
  private  $retelefon;
  private  $reansprechpartner;
  private  $retelefax;
  private  $reabteilung;
  private  $reemail;
  private  $reunterabteilung;
  private  $readresszusatz;
  private  $restrasse;
  private  $replz;
  private  $reort;
  private  $reland;
  private  $name;
  private  $abteilung;
  private  $unterabteilung;
  private  $strasse;
  private  $adresszusatz;
  private  $plz;
  private  $ort;
  private  $land;
  private  $ustid;
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
  private  $abweichendelieferadresse;
  private  $abweichenderechnungsadresse;
  private  $liefername;
  private  $lieferabteilung;
  private  $lieferunterabteilung;
  private  $lieferland;
  private  $lieferstrasse;
  private  $lieferort;
  private  $lieferplz;
  private  $lieferadresszusatz;
  private  $lieferansprechpartner;
  private  $liefertelefon;
  private  $liefertelefax;
  private  $liefermail;
  private  $autoversand;
  private  $keinporto;
  private  $ust_befreit;
  private  $firma;
  private  $versendet;
  private  $versendet_am;
  private  $versendet_per;
  private  $versendet_durch;
  private  $inbearbeitung;
  private  $vermerk;
  private  $logdatei;
  private  $ansprechpartner;
  private  $deckungsbeitragcalc;
  private  $deckungsbeitrag;
  private  $erloes_netto;
  private  $umsatz_netto;
  private  $lieferdatum;
  private  $vertriebid;
  private  $aktion;
  private  $provision;
  private  $provision_summe;
  private  $keinsteuersatz;
  private  $anfrageid;
  private  $gruppe;
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
  private  $schreibschutz;
  private  $pdfarchiviert;
  private  $pdfarchiviertversion;
  private  $typ;
  private  $ohne_briefpapier;
  private  $auftragid;
  private  $lieferid;
  private  $ansprechpartnerid;
  private  $projektfiliale;
  private  $abweichendebezeichnung;
  private  $lieferdatumkw;

  public $app;            //application object 

  public function ObjGenAngebot($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM angebot WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->datum=$result['datum'];
    $this->gueltigbis=$result['gueltigbis'];
    $this->projekt=$result['projekt'];
    $this->belegnr=$result['belegnr'];
    $this->bearbeiter=$result['bearbeiter'];
    $this->anfrage=$result['anfrage'];
    $this->auftrag=$result['auftrag'];
    $this->freitext=$result['freitext'];
    $this->internebemerkung=$result['internebemerkung'];
    $this->status=$result['status'];
    $this->adresse=$result['adresse'];
    $this->retyp=$result['retyp'];
    $this->rechnungname=$result['rechnungname'];
    $this->retelefon=$result['retelefon'];
    $this->reansprechpartner=$result['reansprechpartner'];
    $this->retelefax=$result['retelefax'];
    $this->reabteilung=$result['reabteilung'];
    $this->reemail=$result['reemail'];
    $this->reunterabteilung=$result['reunterabteilung'];
    $this->readresszusatz=$result['readresszusatz'];
    $this->restrasse=$result['restrasse'];
    $this->replz=$result['replz'];
    $this->reort=$result['reort'];
    $this->reland=$result['reland'];
    $this->name=$result['name'];
    $this->abteilung=$result['abteilung'];
    $this->unterabteilung=$result['unterabteilung'];
    $this->strasse=$result['strasse'];
    $this->adresszusatz=$result['adresszusatz'];
    $this->plz=$result['plz'];
    $this->ort=$result['ort'];
    $this->land=$result['land'];
    $this->ustid=$result['ustid'];
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
    $this->abweichendelieferadresse=$result['abweichendelieferadresse'];
    $this->abweichenderechnungsadresse=$result['abweichenderechnungsadresse'];
    $this->liefername=$result['liefername'];
    $this->lieferabteilung=$result['lieferabteilung'];
    $this->lieferunterabteilung=$result['lieferunterabteilung'];
    $this->lieferland=$result['lieferland'];
    $this->lieferstrasse=$result['lieferstrasse'];
    $this->lieferort=$result['lieferort'];
    $this->lieferplz=$result['lieferplz'];
    $this->lieferadresszusatz=$result['lieferadresszusatz'];
    $this->lieferansprechpartner=$result['lieferansprechpartner'];
    $this->liefertelefon=$result['liefertelefon'];
    $this->liefertelefax=$result['liefertelefax'];
    $this->liefermail=$result['liefermail'];
    $this->autoversand=$result['autoversand'];
    $this->keinporto=$result['keinporto'];
    $this->ust_befreit=$result['ust_befreit'];
    $this->firma=$result['firma'];
    $this->versendet=$result['versendet'];
    $this->versendet_am=$result['versendet_am'];
    $this->versendet_per=$result['versendet_per'];
    $this->versendet_durch=$result['versendet_durch'];
    $this->inbearbeitung=$result['inbearbeitung'];
    $this->vermerk=$result['vermerk'];
    $this->logdatei=$result['logdatei'];
    $this->ansprechpartner=$result['ansprechpartner'];
    $this->deckungsbeitragcalc=$result['deckungsbeitragcalc'];
    $this->deckungsbeitrag=$result['deckungsbeitrag'];
    $this->erloes_netto=$result['erloes_netto'];
    $this->umsatz_netto=$result['umsatz_netto'];
    $this->lieferdatum=$result['lieferdatum'];
    $this->vertriebid=$result['vertriebid'];
    $this->aktion=$result['aktion'];
    $this->provision=$result['provision'];
    $this->provision_summe=$result['provision_summe'];
    $this->keinsteuersatz=$result['keinsteuersatz'];
    $this->anfrageid=$result['anfrageid'];
    $this->gruppe=$result['gruppe'];
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
    $this->schreibschutz=$result['schreibschutz'];
    $this->pdfarchiviert=$result['pdfarchiviert'];
    $this->pdfarchiviertversion=$result['pdfarchiviertversion'];
    $this->typ=$result['typ'];
    $this->ohne_briefpapier=$result['ohne_briefpapier'];
    $this->auftragid=$result['auftragid'];
    $this->lieferid=$result['lieferid'];
    $this->ansprechpartnerid=$result['ansprechpartnerid'];
    $this->projektfiliale=$result['projektfiliale'];
    $this->abweichendebezeichnung=$result['abweichendebezeichnung'];
    $this->lieferdatumkw=$result['lieferdatumkw'];
  }

  public function Create()
  {
    $sql = "INSERT INTO angebot (id,datum,gueltigbis,projekt,belegnr,bearbeiter,anfrage,auftrag,freitext,internebemerkung,status,adresse,retyp,rechnungname,retelefon,reansprechpartner,retelefax,reabteilung,reemail,reunterabteilung,readresszusatz,restrasse,replz,reort,reland,name,abteilung,unterabteilung,strasse,adresszusatz,plz,ort,land,ustid,email,telefon,telefax,betreff,kundennummer,versandart,vertrieb,zahlungsweise,zahlungszieltage,zahlungszieltageskonto,zahlungszielskonto,gesamtsumme,bank_inhaber,bank_institut,bank_blz,bank_konto,kreditkarte_typ,kreditkarte_inhaber,kreditkarte_nummer,kreditkarte_pruefnummer,kreditkarte_monat,kreditkarte_jahr,abweichendelieferadresse,abweichenderechnungsadresse,liefername,lieferabteilung,lieferunterabteilung,lieferland,lieferstrasse,lieferort,lieferplz,lieferadresszusatz,lieferansprechpartner,liefertelefon,liefertelefax,liefermail,autoversand,keinporto,ust_befreit,firma,versendet,versendet_am,versendet_per,versendet_durch,inbearbeitung,vermerk,logdatei,ansprechpartner,deckungsbeitragcalc,deckungsbeitrag,erloes_netto,umsatz_netto,lieferdatum,vertriebid,aktion,provision,provision_summe,keinsteuersatz,anfrageid,gruppe,anschreiben,usereditid,useredittimestamp,realrabatt,rabatt,rabatt1,rabatt2,rabatt3,rabatt4,rabatt5,steuersatz_normal,steuersatz_zwischen,steuersatz_ermaessigt,steuersatz_starkermaessigt,steuersatz_dienstleistung,waehrung,schreibschutz,pdfarchiviert,pdfarchiviertversion,typ,ohne_briefpapier,auftragid,lieferid,ansprechpartnerid,projektfiliale,abweichendebezeichnung,lieferdatumkw)
      VALUES('','{$this->datum}','{$this->gueltigbis}','{$this->projekt}','{$this->belegnr}','{$this->bearbeiter}','{$this->anfrage}','{$this->auftrag}','{$this->freitext}','{$this->internebemerkung}','{$this->status}','{$this->adresse}','{$this->retyp}','{$this->rechnungname}','{$this->retelefon}','{$this->reansprechpartner}','{$this->retelefax}','{$this->reabteilung}','{$this->reemail}','{$this->reunterabteilung}','{$this->readresszusatz}','{$this->restrasse}','{$this->replz}','{$this->reort}','{$this->reland}','{$this->name}','{$this->abteilung}','{$this->unterabteilung}','{$this->strasse}','{$this->adresszusatz}','{$this->plz}','{$this->ort}','{$this->land}','{$this->ustid}','{$this->email}','{$this->telefon}','{$this->telefax}','{$this->betreff}','{$this->kundennummer}','{$this->versandart}','{$this->vertrieb}','{$this->zahlungsweise}','{$this->zahlungszieltage}','{$this->zahlungszieltageskonto}','{$this->zahlungszielskonto}','{$this->gesamtsumme}','{$this->bank_inhaber}','{$this->bank_institut}','{$this->bank_blz}','{$this->bank_konto}','{$this->kreditkarte_typ}','{$this->kreditkarte_inhaber}','{$this->kreditkarte_nummer}','{$this->kreditkarte_pruefnummer}','{$this->kreditkarte_monat}','{$this->kreditkarte_jahr}','{$this->abweichendelieferadresse}','{$this->abweichenderechnungsadresse}','{$this->liefername}','{$this->lieferabteilung}','{$this->lieferunterabteilung}','{$this->lieferland}','{$this->lieferstrasse}','{$this->lieferort}','{$this->lieferplz}','{$this->lieferadresszusatz}','{$this->lieferansprechpartner}','{$this->liefertelefon}','{$this->liefertelefax}','{$this->liefermail}','{$this->autoversand}','{$this->keinporto}','{$this->ust_befreit}','{$this->firma}','{$this->versendet}','{$this->versendet_am}','{$this->versendet_per}','{$this->versendet_durch}','{$this->inbearbeitung}','{$this->vermerk}','{$this->logdatei}','{$this->ansprechpartner}','{$this->deckungsbeitragcalc}','{$this->deckungsbeitrag}','{$this->erloes_netto}','{$this->umsatz_netto}','{$this->lieferdatum}','{$this->vertriebid}','{$this->aktion}','{$this->provision}','{$this->provision_summe}','{$this->keinsteuersatz}','{$this->anfrageid}','{$this->gruppe}','{$this->anschreiben}','{$this->usereditid}','{$this->useredittimestamp}','{$this->realrabatt}','{$this->rabatt}','{$this->rabatt1}','{$this->rabatt2}','{$this->rabatt3}','{$this->rabatt4}','{$this->rabatt5}','{$this->steuersatz_normal}','{$this->steuersatz_zwischen}','{$this->steuersatz_ermaessigt}','{$this->steuersatz_starkermaessigt}','{$this->steuersatz_dienstleistung}','{$this->waehrung}','{$this->schreibschutz}','{$this->pdfarchiviert}','{$this->pdfarchiviertversion}','{$this->typ}','{$this->ohne_briefpapier}','{$this->auftragid}','{$this->lieferid}','{$this->ansprechpartnerid}','{$this->projektfiliale}','{$this->abweichendebezeichnung}','{$this->lieferdatumkw}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE angebot SET
      datum='{$this->datum}',
      gueltigbis='{$this->gueltigbis}',
      projekt='{$this->projekt}',
      belegnr='{$this->belegnr}',
      bearbeiter='{$this->bearbeiter}',
      anfrage='{$this->anfrage}',
      auftrag='{$this->auftrag}',
      freitext='{$this->freitext}',
      internebemerkung='{$this->internebemerkung}',
      status='{$this->status}',
      adresse='{$this->adresse}',
      retyp='{$this->retyp}',
      rechnungname='{$this->rechnungname}',
      retelefon='{$this->retelefon}',
      reansprechpartner='{$this->reansprechpartner}',
      retelefax='{$this->retelefax}',
      reabteilung='{$this->reabteilung}',
      reemail='{$this->reemail}',
      reunterabteilung='{$this->reunterabteilung}',
      readresszusatz='{$this->readresszusatz}',
      restrasse='{$this->restrasse}',
      replz='{$this->replz}',
      reort='{$this->reort}',
      reland='{$this->reland}',
      name='{$this->name}',
      abteilung='{$this->abteilung}',
      unterabteilung='{$this->unterabteilung}',
      strasse='{$this->strasse}',
      adresszusatz='{$this->adresszusatz}',
      plz='{$this->plz}',
      ort='{$this->ort}',
      land='{$this->land}',
      ustid='{$this->ustid}',
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
      abweichendelieferadresse='{$this->abweichendelieferadresse}',
      abweichenderechnungsadresse='{$this->abweichenderechnungsadresse}',
      liefername='{$this->liefername}',
      lieferabteilung='{$this->lieferabteilung}',
      lieferunterabteilung='{$this->lieferunterabteilung}',
      lieferland='{$this->lieferland}',
      lieferstrasse='{$this->lieferstrasse}',
      lieferort='{$this->lieferort}',
      lieferplz='{$this->lieferplz}',
      lieferadresszusatz='{$this->lieferadresszusatz}',
      lieferansprechpartner='{$this->lieferansprechpartner}',
      liefertelefon='{$this->liefertelefon}',
      liefertelefax='{$this->liefertelefax}',
      liefermail='{$this->liefermail}',
      autoversand='{$this->autoversand}',
      keinporto='{$this->keinporto}',
      ust_befreit='{$this->ust_befreit}',
      firma='{$this->firma}',
      versendet='{$this->versendet}',
      versendet_am='{$this->versendet_am}',
      versendet_per='{$this->versendet_per}',
      versendet_durch='{$this->versendet_durch}',
      inbearbeitung='{$this->inbearbeitung}',
      vermerk='{$this->vermerk}',
      logdatei='{$this->logdatei}',
      ansprechpartner='{$this->ansprechpartner}',
      deckungsbeitragcalc='{$this->deckungsbeitragcalc}',
      deckungsbeitrag='{$this->deckungsbeitrag}',
      erloes_netto='{$this->erloes_netto}',
      umsatz_netto='{$this->umsatz_netto}',
      lieferdatum='{$this->lieferdatum}',
      vertriebid='{$this->vertriebid}',
      aktion='{$this->aktion}',
      provision='{$this->provision}',
      provision_summe='{$this->provision_summe}',
      keinsteuersatz='{$this->keinsteuersatz}',
      anfrageid='{$this->anfrageid}',
      gruppe='{$this->gruppe}',
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
      schreibschutz='{$this->schreibschutz}',
      pdfarchiviert='{$this->pdfarchiviert}',
      pdfarchiviertversion='{$this->pdfarchiviertversion}',
      typ='{$this->typ}',
      ohne_briefpapier='{$this->ohne_briefpapier}',
      auftragid='{$this->auftragid}',
      lieferid='{$this->lieferid}',
      ansprechpartnerid='{$this->ansprechpartnerid}',
      projektfiliale='{$this->projektfiliale}',
      abweichendebezeichnung='{$this->abweichendebezeichnung}',
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

    $sql = "DELETE FROM angebot WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->datum="";
    $this->gueltigbis="";
    $this->projekt="";
    $this->belegnr="";
    $this->bearbeiter="";
    $this->anfrage="";
    $this->auftrag="";
    $this->freitext="";
    $this->internebemerkung="";
    $this->status="";
    $this->adresse="";
    $this->retyp="";
    $this->rechnungname="";
    $this->retelefon="";
    $this->reansprechpartner="";
    $this->retelefax="";
    $this->reabteilung="";
    $this->reemail="";
    $this->reunterabteilung="";
    $this->readresszusatz="";
    $this->restrasse="";
    $this->replz="";
    $this->reort="";
    $this->reland="";
    $this->name="";
    $this->abteilung="";
    $this->unterabteilung="";
    $this->strasse="";
    $this->adresszusatz="";
    $this->plz="";
    $this->ort="";
    $this->land="";
    $this->ustid="";
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
    $this->abweichendelieferadresse="";
    $this->abweichenderechnungsadresse="";
    $this->liefername="";
    $this->lieferabteilung="";
    $this->lieferunterabteilung="";
    $this->lieferland="";
    $this->lieferstrasse="";
    $this->lieferort="";
    $this->lieferplz="";
    $this->lieferadresszusatz="";
    $this->lieferansprechpartner="";
    $this->liefertelefon="";
    $this->liefertelefax="";
    $this->liefermail="";
    $this->autoversand="";
    $this->keinporto="";
    $this->ust_befreit="";
    $this->firma="";
    $this->versendet="";
    $this->versendet_am="";
    $this->versendet_per="";
    $this->versendet_durch="";
    $this->inbearbeitung="";
    $this->vermerk="";
    $this->logdatei="";
    $this->ansprechpartner="";
    $this->deckungsbeitragcalc="";
    $this->deckungsbeitrag="";
    $this->erloes_netto="";
    $this->umsatz_netto="";
    $this->lieferdatum="";
    $this->vertriebid="";
    $this->aktion="";
    $this->provision="";
    $this->provision_summe="";
    $this->keinsteuersatz="";
    $this->anfrageid="";
    $this->gruppe="";
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
    $this->schreibschutz="";
    $this->pdfarchiviert="";
    $this->pdfarchiviertversion="";
    $this->typ="";
    $this->ohne_briefpapier="";
    $this->auftragid="";
    $this->lieferid="";
    $this->ansprechpartnerid="";
    $this->projektfiliale="";
    $this->abweichendebezeichnung="";
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
  function SetGueltigbis($value) { $this->gueltigbis=$value; }
  function GetGueltigbis() { return $this->gueltigbis; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetBelegnr($value) { $this->belegnr=$value; }
  function GetBelegnr() { return $this->belegnr; }
  function SetBearbeiter($value) { $this->bearbeiter=$value; }
  function GetBearbeiter() { return $this->bearbeiter; }
  function SetAnfrage($value) { $this->anfrage=$value; }
  function GetAnfrage() { return $this->anfrage; }
  function SetAuftrag($value) { $this->auftrag=$value; }
  function GetAuftrag() { return $this->auftrag; }
  function SetFreitext($value) { $this->freitext=$value; }
  function GetFreitext() { return $this->freitext; }
  function SetInternebemerkung($value) { $this->internebemerkung=$value; }
  function GetInternebemerkung() { return $this->internebemerkung; }
  function SetStatus($value) { $this->status=$value; }
  function GetStatus() { return $this->status; }
  function SetAdresse($value) { $this->adresse=$value; }
  function GetAdresse() { return $this->adresse; }
  function SetRetyp($value) { $this->retyp=$value; }
  function GetRetyp() { return $this->retyp; }
  function SetRechnungname($value) { $this->rechnungname=$value; }
  function GetRechnungname() { return $this->rechnungname; }
  function SetRetelefon($value) { $this->retelefon=$value; }
  function GetRetelefon() { return $this->retelefon; }
  function SetReansprechpartner($value) { $this->reansprechpartner=$value; }
  function GetReansprechpartner() { return $this->reansprechpartner; }
  function SetRetelefax($value) { $this->retelefax=$value; }
  function GetRetelefax() { return $this->retelefax; }
  function SetReabteilung($value) { $this->reabteilung=$value; }
  function GetReabteilung() { return $this->reabteilung; }
  function SetReemail($value) { $this->reemail=$value; }
  function GetReemail() { return $this->reemail; }
  function SetReunterabteilung($value) { $this->reunterabteilung=$value; }
  function GetReunterabteilung() { return $this->reunterabteilung; }
  function SetReadresszusatz($value) { $this->readresszusatz=$value; }
  function GetReadresszusatz() { return $this->readresszusatz; }
  function SetRestrasse($value) { $this->restrasse=$value; }
  function GetRestrasse() { return $this->restrasse; }
  function SetReplz($value) { $this->replz=$value; }
  function GetReplz() { return $this->replz; }
  function SetReort($value) { $this->reort=$value; }
  function GetReort() { return $this->reort; }
  function SetReland($value) { $this->reland=$value; }
  function GetReland() { return $this->reland; }
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
  function SetAbweichendelieferadresse($value) { $this->abweichendelieferadresse=$value; }
  function GetAbweichendelieferadresse() { return $this->abweichendelieferadresse; }
  function SetAbweichenderechnungsadresse($value) { $this->abweichenderechnungsadresse=$value; }
  function GetAbweichenderechnungsadresse() { return $this->abweichenderechnungsadresse; }
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
  function SetLiefertelefon($value) { $this->liefertelefon=$value; }
  function GetLiefertelefon() { return $this->liefertelefon; }
  function SetLiefertelefax($value) { $this->liefertelefax=$value; }
  function GetLiefertelefax() { return $this->liefertelefax; }
  function SetLiefermail($value) { $this->liefermail=$value; }
  function GetLiefermail() { return $this->liefermail; }
  function SetAutoversand($value) { $this->autoversand=$value; }
  function GetAutoversand() { return $this->autoversand; }
  function SetKeinporto($value) { $this->keinporto=$value; }
  function GetKeinporto() { return $this->keinporto; }
  function SetUst_Befreit($value) { $this->ust_befreit=$value; }
  function GetUst_Befreit() { return $this->ust_befreit; }
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
  function SetVermerk($value) { $this->vermerk=$value; }
  function GetVermerk() { return $this->vermerk; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetAnsprechpartner($value) { $this->ansprechpartner=$value; }
  function GetAnsprechpartner() { return $this->ansprechpartner; }
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
  function SetVertriebid($value) { $this->vertriebid=$value; }
  function GetVertriebid() { return $this->vertriebid; }
  function SetAktion($value) { $this->aktion=$value; }
  function GetAktion() { return $this->aktion; }
  function SetProvision($value) { $this->provision=$value; }
  function GetProvision() { return $this->provision; }
  function SetProvision_Summe($value) { $this->provision_summe=$value; }
  function GetProvision_Summe() { return $this->provision_summe; }
  function SetKeinsteuersatz($value) { $this->keinsteuersatz=$value; }
  function GetKeinsteuersatz() { return $this->keinsteuersatz; }
  function SetAnfrageid($value) { $this->anfrageid=$value; }
  function GetAnfrageid() { return $this->anfrageid; }
  function SetGruppe($value) { $this->gruppe=$value; }
  function GetGruppe() { return $this->gruppe; }
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
  function SetAuftragid($value) { $this->auftragid=$value; }
  function GetAuftragid() { return $this->auftragid; }
  function SetLieferid($value) { $this->lieferid=$value; }
  function GetLieferid() { return $this->lieferid; }
  function SetAnsprechpartnerid($value) { $this->ansprechpartnerid=$value; }
  function GetAnsprechpartnerid() { return $this->ansprechpartnerid; }
  function SetProjektfiliale($value) { $this->projektfiliale=$value; }
  function GetProjektfiliale() { return $this->projektfiliale; }
  function SetAbweichendebezeichnung($value) { $this->abweichendebezeichnung=$value; }
  function GetAbweichendebezeichnung() { return $this->abweichendebezeichnung; }
  function SetLieferdatumkw($value) { $this->lieferdatumkw=$value; }
  function GetLieferdatumkw() { return $this->lieferdatumkw; }

}

?>