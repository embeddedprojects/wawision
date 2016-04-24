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

class ObjGenArtikel
{

  private  $id;
  private  $typ;
  private  $nummer;
  private  $checksum;
  private  $projekt;
  private  $inaktiv;
  private  $ausverkauft;
  private  $warengruppe;
  private  $name_de;
  private  $name_en;
  private  $kurztext_de;
  private  $kurztext_en;
  private  $beschreibung_de;
  private  $beschreibung_en;
  private  $uebersicht_de;
  private  $uebersicht_en;
  private  $links_de;
  private  $links_en;
  private  $startseite_de;
  private  $startseite_en;
  private  $standardbild;
  private  $herstellerlink;
  private  $hersteller;
  private  $teilbar;
  private  $nteile;
  private  $seriennummern;
  private  $lager_platz;
  private  $lieferzeit;
  private  $lieferzeitmanuell;
  private  $sonstiges;
  private  $gewicht;
  private  $endmontage;
  private  $funktionstest;
  private  $artikelcheckliste;
  private  $stueckliste;
  private  $juststueckliste;
  private  $barcode;
  private  $hinzugefuegt;
  private  $pcbdecal;
  private  $lagerartikel;
  private  $porto;
  private  $chargenverwaltung;
  private  $provisionsartikel;
  private  $gesperrt;
  private  $sperrgrund;
  private  $geloescht;
  private  $gueltigbis;
  private  $umsatzsteuer;
  private  $klasse;
  private  $adresse;
  private  $shopartikel;
  private  $unishopartikel;
  private  $journalshopartikel;
  private  $shop;
  private  $katalog;
  private  $katalogtext_de;
  private  $katalogtext_en;
  private  $katalogbezeichnung_de;
  private  $katalogbezeichnung_en;
  private  $neu;
  private  $topseller;
  private  $startseite;
  private  $wichtig;
  private  $mindestlager;
  private  $mindestbestellung;
  private  $partnerprogramm_sperre;
  private  $internerkommentar;
  private  $intern_gesperrt;
  private  $intern_gesperrtuser;
  private  $intern_gesperrtgrund;
  private  $inbearbeitung;
  private  $inbearbeitunguser;
  private  $cache_lagerplatzinhaltmenge;
  private  $internkommentar;
  private  $firma;
  private  $logdatei;
  private  $anabregs_text;
  private  $autobestellung;
  private  $produktion;
  private  $herstellernummer;
  private  $restmenge;
  private  $mlmdirektpraemie;
  private  $keineeinzelartikelanzeigen;
  private  $mindesthaltbarkeitsdatum;
  private  $letzteseriennummer;
  private  $individualartikel;
  private  $keinrabatterlaubt;
  private  $rabatt;
  private  $rabatt_prozent;
  private  $geraet;
  private  $serviceartikel;
  private  $autoabgleicherlaubt;
  private  $pseudopreis;
  private  $freigabenotwendig;
  private  $freigaberegel;
  private  $nachbestellt;
  private  $ean;
  private  $mlmpunkte;
  private  $mlmbonuspunkte;
  private  $mlmkeinepunkteeigenkauf;
  private  $shop2;
  private  $shop3;
  private  $usereditid;
  private  $useredittimestamp;
  private  $freifeld1;
  private  $freifeld2;
  private  $freifeld3;
  private  $freifeld4;
  private  $freifeld5;
  private  $freifeld6;
  private  $einheit;
  private  $webid;
  private  $lieferzeitmanuell_en;
  private  $variante;
  private  $variante_von;
  private  $produktioninfo;
  private  $sonderaktion;
  private  $sonderaktion_en;
  private  $autolagerlampe;
  private  $leerfeld;
  private  $zolltarifnummer;
  private  $herkunftsland;
  private  $laenge;
  private  $breite;
  private  $hoehe;
  private  $gebuehr;
  private  $pseudolager;
  private  $downloadartikel;
  private  $matrixprodukt;
  private  $steuer_erloese_inland_normal;
  private  $steuer_aufwendung_inland_normal;
  private  $steuer_erloese_inland_ermaessigt;
  private  $steuer_aufwendung_inland_ermaessigt;
  private  $steuer_erloese_inland_steuerfrei;
  private  $steuer_aufwendung_inland_steuerfrei;
  private  $steuer_erloese_inland_innergemeinschaftlich;
  private  $steuer_aufwendung_inland_innergemeinschaftlich;
  private  $steuer_erloese_inland_eunormal;
  private  $steuer_erloese_inland_nichtsteuerbar;
  private  $steuer_erloese_inland_euermaessigt;
  private  $steuer_aufwendung_inland_nichtsteuerbar;
  private  $steuer_aufwendung_inland_eunormal;
  private  $steuer_aufwendung_inland_euermaessigt;
  private  $steuer_erloese_inland_export;
  private  $steuer_aufwendung_inland_import;
  private  $steuer_art_produkt;
  private  $steuer_art_produkt_download;
  private  $metadescription_de;
  private  $metadescription_en;
  private  $metakeywords_de;
  private  $metakeywords_en;
  private  $anabregs_text_en;
  private  $generierenummerbeioption;
  private  $allelieferanten;

  public $app;            //application object 

  public function ObjGenArtikel($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM artikel WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->typ=$result['typ'];
    $this->nummer=$result['nummer'];
    $this->checksum=$result['checksum'];
    $this->projekt=$result['projekt'];
    $this->inaktiv=$result['inaktiv'];
    $this->ausverkauft=$result['ausverkauft'];
    $this->warengruppe=$result['warengruppe'];
    $this->name_de=$result['name_de'];
    $this->name_en=$result['name_en'];
    $this->kurztext_de=$result['kurztext_de'];
    $this->kurztext_en=$result['kurztext_en'];
    $this->beschreibung_de=$result['beschreibung_de'];
    $this->beschreibung_en=$result['beschreibung_en'];
    $this->uebersicht_de=$result['uebersicht_de'];
    $this->uebersicht_en=$result['uebersicht_en'];
    $this->links_de=$result['links_de'];
    $this->links_en=$result['links_en'];
    $this->startseite_de=$result['startseite_de'];
    $this->startseite_en=$result['startseite_en'];
    $this->standardbild=$result['standardbild'];
    $this->herstellerlink=$result['herstellerlink'];
    $this->hersteller=$result['hersteller'];
    $this->teilbar=$result['teilbar'];
    $this->nteile=$result['nteile'];
    $this->seriennummern=$result['seriennummern'];
    $this->lager_platz=$result['lager_platz'];
    $this->lieferzeit=$result['lieferzeit'];
    $this->lieferzeitmanuell=$result['lieferzeitmanuell'];
    $this->sonstiges=$result['sonstiges'];
    $this->gewicht=$result['gewicht'];
    $this->endmontage=$result['endmontage'];
    $this->funktionstest=$result['funktionstest'];
    $this->artikelcheckliste=$result['artikelcheckliste'];
    $this->stueckliste=$result['stueckliste'];
    $this->juststueckliste=$result['juststueckliste'];
    $this->barcode=$result['barcode'];
    $this->hinzugefuegt=$result['hinzugefuegt'];
    $this->pcbdecal=$result['pcbdecal'];
    $this->lagerartikel=$result['lagerartikel'];
    $this->porto=$result['porto'];
    $this->chargenverwaltung=$result['chargenverwaltung'];
    $this->provisionsartikel=$result['provisionsartikel'];
    $this->gesperrt=$result['gesperrt'];
    $this->sperrgrund=$result['sperrgrund'];
    $this->geloescht=$result['geloescht'];
    $this->gueltigbis=$result['gueltigbis'];
    $this->umsatzsteuer=$result['umsatzsteuer'];
    $this->klasse=$result['klasse'];
    $this->adresse=$result['adresse'];
    $this->shopartikel=$result['shopartikel'];
    $this->unishopartikel=$result['unishopartikel'];
    $this->journalshopartikel=$result['journalshopartikel'];
    $this->shop=$result['shop'];
    $this->katalog=$result['katalog'];
    $this->katalogtext_de=$result['katalogtext_de'];
    $this->katalogtext_en=$result['katalogtext_en'];
    $this->katalogbezeichnung_de=$result['katalogbezeichnung_de'];
    $this->katalogbezeichnung_en=$result['katalogbezeichnung_en'];
    $this->neu=$result['neu'];
    $this->topseller=$result['topseller'];
    $this->startseite=$result['startseite'];
    $this->wichtig=$result['wichtig'];
    $this->mindestlager=$result['mindestlager'];
    $this->mindestbestellung=$result['mindestbestellung'];
    $this->partnerprogramm_sperre=$result['partnerprogramm_sperre'];
    $this->internerkommentar=$result['internerkommentar'];
    $this->intern_gesperrt=$result['intern_gesperrt'];
    $this->intern_gesperrtuser=$result['intern_gesperrtuser'];
    $this->intern_gesperrtgrund=$result['intern_gesperrtgrund'];
    $this->inbearbeitung=$result['inbearbeitung'];
    $this->inbearbeitunguser=$result['inbearbeitunguser'];
    $this->cache_lagerplatzinhaltmenge=$result['cache_lagerplatzinhaltmenge'];
    $this->internkommentar=$result['internkommentar'];
    $this->firma=$result['firma'];
    $this->logdatei=$result['logdatei'];
    $this->anabregs_text=$result['anabregs_text'];
    $this->autobestellung=$result['autobestellung'];
    $this->produktion=$result['produktion'];
    $this->herstellernummer=$result['herstellernummer'];
    $this->restmenge=$result['restmenge'];
    $this->mlmdirektpraemie=$result['mlmdirektpraemie'];
    $this->keineeinzelartikelanzeigen=$result['keineeinzelartikelanzeigen'];
    $this->mindesthaltbarkeitsdatum=$result['mindesthaltbarkeitsdatum'];
    $this->letzteseriennummer=$result['letzteseriennummer'];
    $this->individualartikel=$result['individualartikel'];
    $this->keinrabatterlaubt=$result['keinrabatterlaubt'];
    $this->rabatt=$result['rabatt'];
    $this->rabatt_prozent=$result['rabatt_prozent'];
    $this->geraet=$result['geraet'];
    $this->serviceartikel=$result['serviceartikel'];
    $this->autoabgleicherlaubt=$result['autoabgleicherlaubt'];
    $this->pseudopreis=$result['pseudopreis'];
    $this->freigabenotwendig=$result['freigabenotwendig'];
    $this->freigaberegel=$result['freigaberegel'];
    $this->nachbestellt=$result['nachbestellt'];
    $this->ean=$result['ean'];
    $this->mlmpunkte=$result['mlmpunkte'];
    $this->mlmbonuspunkte=$result['mlmbonuspunkte'];
    $this->mlmkeinepunkteeigenkauf=$result['mlmkeinepunkteeigenkauf'];
    $this->shop2=$result['shop2'];
    $this->shop3=$result['shop3'];
    $this->usereditid=$result['usereditid'];
    $this->useredittimestamp=$result['useredittimestamp'];
    $this->freifeld1=$result['freifeld1'];
    $this->freifeld2=$result['freifeld2'];
    $this->freifeld3=$result['freifeld3'];
    $this->freifeld4=$result['freifeld4'];
    $this->freifeld5=$result['freifeld5'];
    $this->freifeld6=$result['freifeld6'];
    $this->einheit=$result['einheit'];
    $this->webid=$result['webid'];
    $this->lieferzeitmanuell_en=$result['lieferzeitmanuell_en'];
    $this->variante=$result['variante'];
    $this->variante_von=$result['variante_von'];
    $this->produktioninfo=$result['produktioninfo'];
    $this->sonderaktion=$result['sonderaktion'];
    $this->sonderaktion_en=$result['sonderaktion_en'];
    $this->autolagerlampe=$result['autolagerlampe'];
    $this->leerfeld=$result['leerfeld'];
    $this->zolltarifnummer=$result['zolltarifnummer'];
    $this->herkunftsland=$result['herkunftsland'];
    $this->laenge=$result['laenge'];
    $this->breite=$result['breite'];
    $this->hoehe=$result['hoehe'];
    $this->gebuehr=$result['gebuehr'];
    $this->pseudolager=$result['pseudolager'];
    $this->downloadartikel=$result['downloadartikel'];
    $this->matrixprodukt=$result['matrixprodukt'];
    $this->steuer_erloese_inland_normal=$result['steuer_erloese_inland_normal'];
    $this->steuer_aufwendung_inland_normal=$result['steuer_aufwendung_inland_normal'];
    $this->steuer_erloese_inland_ermaessigt=$result['steuer_erloese_inland_ermaessigt'];
    $this->steuer_aufwendung_inland_ermaessigt=$result['steuer_aufwendung_inland_ermaessigt'];
    $this->steuer_erloese_inland_steuerfrei=$result['steuer_erloese_inland_steuerfrei'];
    $this->steuer_aufwendung_inland_steuerfrei=$result['steuer_aufwendung_inland_steuerfrei'];
    $this->steuer_erloese_inland_innergemeinschaftlich=$result['steuer_erloese_inland_innergemeinschaftlich'];
    $this->steuer_aufwendung_inland_innergemeinschaftlich=$result['steuer_aufwendung_inland_innergemeinschaftlich'];
    $this->steuer_erloese_inland_eunormal=$result['steuer_erloese_inland_eunormal'];
    $this->steuer_erloese_inland_nichtsteuerbar=$result['steuer_erloese_inland_nichtsteuerbar'];
    $this->steuer_erloese_inland_euermaessigt=$result['steuer_erloese_inland_euermaessigt'];
    $this->steuer_aufwendung_inland_nichtsteuerbar=$result['steuer_aufwendung_inland_nichtsteuerbar'];
    $this->steuer_aufwendung_inland_eunormal=$result['steuer_aufwendung_inland_eunormal'];
    $this->steuer_aufwendung_inland_euermaessigt=$result['steuer_aufwendung_inland_euermaessigt'];
    $this->steuer_erloese_inland_export=$result['steuer_erloese_inland_export'];
    $this->steuer_aufwendung_inland_import=$result['steuer_aufwendung_inland_import'];
    $this->steuer_art_produkt=$result['steuer_art_produkt'];
    $this->steuer_art_produkt_download=$result['steuer_art_produkt_download'];
    $this->metadescription_de=$result['metadescription_de'];
    $this->metadescription_en=$result['metadescription_en'];
    $this->metakeywords_de=$result['metakeywords_de'];
    $this->metakeywords_en=$result['metakeywords_en'];
    $this->anabregs_text_en=$result['anabregs_text_en'];
    $this->generierenummerbeioption=$result['generierenummerbeioption'];
    $this->allelieferanten=$result['allelieferanten'];
  }

  public function Create()
  {
    $sql = "INSERT INTO artikel (id,typ,nummer,checksum,projekt,inaktiv,ausverkauft,warengruppe,name_de,name_en,kurztext_de,kurztext_en,beschreibung_de,beschreibung_en,uebersicht_de,uebersicht_en,links_de,links_en,startseite_de,startseite_en,standardbild,herstellerlink,hersteller,teilbar,nteile,seriennummern,lager_platz,lieferzeit,lieferzeitmanuell,sonstiges,gewicht,endmontage,funktionstest,artikelcheckliste,stueckliste,juststueckliste,barcode,hinzugefuegt,pcbdecal,lagerartikel,porto,chargenverwaltung,provisionsartikel,gesperrt,sperrgrund,geloescht,gueltigbis,umsatzsteuer,klasse,adresse,shopartikel,unishopartikel,journalshopartikel,shop,katalog,katalogtext_de,katalogtext_en,katalogbezeichnung_de,katalogbezeichnung_en,neu,topseller,startseite,wichtig,mindestlager,mindestbestellung,partnerprogramm_sperre,internerkommentar,intern_gesperrt,intern_gesperrtuser,intern_gesperrtgrund,inbearbeitung,inbearbeitunguser,cache_lagerplatzinhaltmenge,internkommentar,firma,logdatei,anabregs_text,autobestellung,produktion,herstellernummer,restmenge,mlmdirektpraemie,keineeinzelartikelanzeigen,mindesthaltbarkeitsdatum,letzteseriennummer,individualartikel,keinrabatterlaubt,rabatt,rabatt_prozent,geraet,serviceartikel,autoabgleicherlaubt,pseudopreis,freigabenotwendig,freigaberegel,nachbestellt,ean,mlmpunkte,mlmbonuspunkte,mlmkeinepunkteeigenkauf,shop2,shop3,usereditid,useredittimestamp,freifeld1,freifeld2,freifeld3,freifeld4,freifeld5,freifeld6,einheit,webid,lieferzeitmanuell_en,variante,variante_von,produktioninfo,sonderaktion,sonderaktion_en,autolagerlampe,leerfeld,zolltarifnummer,herkunftsland,laenge,breite,hoehe,gebuehr,pseudolager,downloadartikel,matrixprodukt,steuer_erloese_inland_normal,steuer_aufwendung_inland_normal,steuer_erloese_inland_ermaessigt,steuer_aufwendung_inland_ermaessigt,steuer_erloese_inland_steuerfrei,steuer_aufwendung_inland_steuerfrei,steuer_erloese_inland_innergemeinschaftlich,steuer_aufwendung_inland_innergemeinschaftlich,steuer_erloese_inland_eunormal,steuer_erloese_inland_nichtsteuerbar,steuer_erloese_inland_euermaessigt,steuer_aufwendung_inland_nichtsteuerbar,steuer_aufwendung_inland_eunormal,steuer_aufwendung_inland_euermaessigt,steuer_erloese_inland_export,steuer_aufwendung_inland_import,steuer_art_produkt,steuer_art_produkt_download,metadescription_de,metadescription_en,metakeywords_de,metakeywords_en,anabregs_text_en,generierenummerbeioption,allelieferanten)
      VALUES('','{$this->typ}','{$this->nummer}','{$this->checksum}','{$this->projekt}','{$this->inaktiv}','{$this->ausverkauft}','{$this->warengruppe}','{$this->name_de}','{$this->name_en}','{$this->kurztext_de}','{$this->kurztext_en}','{$this->beschreibung_de}','{$this->beschreibung_en}','{$this->uebersicht_de}','{$this->uebersicht_en}','{$this->links_de}','{$this->links_en}','{$this->startseite_de}','{$this->startseite_en}','{$this->standardbild}','{$this->herstellerlink}','{$this->hersteller}','{$this->teilbar}','{$this->nteile}','{$this->seriennummern}','{$this->lager_platz}','{$this->lieferzeit}','{$this->lieferzeitmanuell}','{$this->sonstiges}','{$this->gewicht}','{$this->endmontage}','{$this->funktionstest}','{$this->artikelcheckliste}','{$this->stueckliste}','{$this->juststueckliste}','{$this->barcode}','{$this->hinzugefuegt}','{$this->pcbdecal}','{$this->lagerartikel}','{$this->porto}','{$this->chargenverwaltung}','{$this->provisionsartikel}','{$this->gesperrt}','{$this->sperrgrund}','{$this->geloescht}','{$this->gueltigbis}','{$this->umsatzsteuer}','{$this->klasse}','{$this->adresse}','{$this->shopartikel}','{$this->unishopartikel}','{$this->journalshopartikel}','{$this->shop}','{$this->katalog}','{$this->katalogtext_de}','{$this->katalogtext_en}','{$this->katalogbezeichnung_de}','{$this->katalogbezeichnung_en}','{$this->neu}','{$this->topseller}','{$this->startseite}','{$this->wichtig}','{$this->mindestlager}','{$this->mindestbestellung}','{$this->partnerprogramm_sperre}','{$this->internerkommentar}','{$this->intern_gesperrt}','{$this->intern_gesperrtuser}','{$this->intern_gesperrtgrund}','{$this->inbearbeitung}','{$this->inbearbeitunguser}','{$this->cache_lagerplatzinhaltmenge}','{$this->internkommentar}','{$this->firma}','{$this->logdatei}','{$this->anabregs_text}','{$this->autobestellung}','{$this->produktion}','{$this->herstellernummer}','{$this->restmenge}','{$this->mlmdirektpraemie}','{$this->keineeinzelartikelanzeigen}','{$this->mindesthaltbarkeitsdatum}','{$this->letzteseriennummer}','{$this->individualartikel}','{$this->keinrabatterlaubt}','{$this->rabatt}','{$this->rabatt_prozent}','{$this->geraet}','{$this->serviceartikel}','{$this->autoabgleicherlaubt}','{$this->pseudopreis}','{$this->freigabenotwendig}','{$this->freigaberegel}','{$this->nachbestellt}','{$this->ean}','{$this->mlmpunkte}','{$this->mlmbonuspunkte}','{$this->mlmkeinepunkteeigenkauf}','{$this->shop2}','{$this->shop3}','{$this->usereditid}','{$this->useredittimestamp}','{$this->freifeld1}','{$this->freifeld2}','{$this->freifeld3}','{$this->freifeld4}','{$this->freifeld5}','{$this->freifeld6}','{$this->einheit}','{$this->webid}','{$this->lieferzeitmanuell_en}','{$this->variante}','{$this->variante_von}','{$this->produktioninfo}','{$this->sonderaktion}','{$this->sonderaktion_en}','{$this->autolagerlampe}','{$this->leerfeld}','{$this->zolltarifnummer}','{$this->herkunftsland}','{$this->laenge}','{$this->breite}','{$this->hoehe}','{$this->gebuehr}','{$this->pseudolager}','{$this->downloadartikel}','{$this->matrixprodukt}','{$this->steuer_erloese_inland_normal}','{$this->steuer_aufwendung_inland_normal}','{$this->steuer_erloese_inland_ermaessigt}','{$this->steuer_aufwendung_inland_ermaessigt}','{$this->steuer_erloese_inland_steuerfrei}','{$this->steuer_aufwendung_inland_steuerfrei}','{$this->steuer_erloese_inland_innergemeinschaftlich}','{$this->steuer_aufwendung_inland_innergemeinschaftlich}','{$this->steuer_erloese_inland_eunormal}','{$this->steuer_erloese_inland_nichtsteuerbar}','{$this->steuer_erloese_inland_euermaessigt}','{$this->steuer_aufwendung_inland_nichtsteuerbar}','{$this->steuer_aufwendung_inland_eunormal}','{$this->steuer_aufwendung_inland_euermaessigt}','{$this->steuer_erloese_inland_export}','{$this->steuer_aufwendung_inland_import}','{$this->steuer_art_produkt}','{$this->steuer_art_produkt_download}','{$this->metadescription_de}','{$this->metadescription_en}','{$this->metakeywords_de}','{$this->metakeywords_en}','{$this->anabregs_text_en}','{$this->generierenummerbeioption}','{$this->allelieferanten}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE artikel SET
      typ='{$this->typ}',
      nummer='{$this->nummer}',
      checksum='{$this->checksum}',
      projekt='{$this->projekt}',
      inaktiv='{$this->inaktiv}',
      ausverkauft='{$this->ausverkauft}',
      warengruppe='{$this->warengruppe}',
      name_de='{$this->name_de}',
      name_en='{$this->name_en}',
      kurztext_de='{$this->kurztext_de}',
      kurztext_en='{$this->kurztext_en}',
      beschreibung_de='{$this->beschreibung_de}',
      beschreibung_en='{$this->beschreibung_en}',
      uebersicht_de='{$this->uebersicht_de}',
      uebersicht_en='{$this->uebersicht_en}',
      links_de='{$this->links_de}',
      links_en='{$this->links_en}',
      startseite_de='{$this->startseite_de}',
      startseite_en='{$this->startseite_en}',
      standardbild='{$this->standardbild}',
      herstellerlink='{$this->herstellerlink}',
      hersteller='{$this->hersteller}',
      teilbar='{$this->teilbar}',
      nteile='{$this->nteile}',
      seriennummern='{$this->seriennummern}',
      lager_platz='{$this->lager_platz}',
      lieferzeit='{$this->lieferzeit}',
      lieferzeitmanuell='{$this->lieferzeitmanuell}',
      sonstiges='{$this->sonstiges}',
      gewicht='{$this->gewicht}',
      endmontage='{$this->endmontage}',
      funktionstest='{$this->funktionstest}',
      artikelcheckliste='{$this->artikelcheckliste}',
      stueckliste='{$this->stueckliste}',
      juststueckliste='{$this->juststueckliste}',
      barcode='{$this->barcode}',
      hinzugefuegt='{$this->hinzugefuegt}',
      pcbdecal='{$this->pcbdecal}',
      lagerartikel='{$this->lagerartikel}',
      porto='{$this->porto}',
      chargenverwaltung='{$this->chargenverwaltung}',
      provisionsartikel='{$this->provisionsartikel}',
      gesperrt='{$this->gesperrt}',
      sperrgrund='{$this->sperrgrund}',
      geloescht='{$this->geloescht}',
      gueltigbis='{$this->gueltigbis}',
      umsatzsteuer='{$this->umsatzsteuer}',
      klasse='{$this->klasse}',
      adresse='{$this->adresse}',
      shopartikel='{$this->shopartikel}',
      unishopartikel='{$this->unishopartikel}',
      journalshopartikel='{$this->journalshopartikel}',
      shop='{$this->shop}',
      katalog='{$this->katalog}',
      katalogtext_de='{$this->katalogtext_de}',
      katalogtext_en='{$this->katalogtext_en}',
      katalogbezeichnung_de='{$this->katalogbezeichnung_de}',
      katalogbezeichnung_en='{$this->katalogbezeichnung_en}',
      neu='{$this->neu}',
      topseller='{$this->topseller}',
      startseite='{$this->startseite}',
      wichtig='{$this->wichtig}',
      mindestlager='{$this->mindestlager}',
      mindestbestellung='{$this->mindestbestellung}',
      partnerprogramm_sperre='{$this->partnerprogramm_sperre}',
      internerkommentar='{$this->internerkommentar}',
      intern_gesperrt='{$this->intern_gesperrt}',
      intern_gesperrtuser='{$this->intern_gesperrtuser}',
      intern_gesperrtgrund='{$this->intern_gesperrtgrund}',
      inbearbeitung='{$this->inbearbeitung}',
      inbearbeitunguser='{$this->inbearbeitunguser}',
      cache_lagerplatzinhaltmenge='{$this->cache_lagerplatzinhaltmenge}',
      internkommentar='{$this->internkommentar}',
      firma='{$this->firma}',
      logdatei='{$this->logdatei}',
      anabregs_text='{$this->anabregs_text}',
      autobestellung='{$this->autobestellung}',
      produktion='{$this->produktion}',
      herstellernummer='{$this->herstellernummer}',
      restmenge='{$this->restmenge}',
      mlmdirektpraemie='{$this->mlmdirektpraemie}',
      keineeinzelartikelanzeigen='{$this->keineeinzelartikelanzeigen}',
      mindesthaltbarkeitsdatum='{$this->mindesthaltbarkeitsdatum}',
      letzteseriennummer='{$this->letzteseriennummer}',
      individualartikel='{$this->individualartikel}',
      keinrabatterlaubt='{$this->keinrabatterlaubt}',
      rabatt='{$this->rabatt}',
      rabatt_prozent='{$this->rabatt_prozent}',
      geraet='{$this->geraet}',
      serviceartikel='{$this->serviceartikel}',
      autoabgleicherlaubt='{$this->autoabgleicherlaubt}',
      pseudopreis='{$this->pseudopreis}',
      freigabenotwendig='{$this->freigabenotwendig}',
      freigaberegel='{$this->freigaberegel}',
      nachbestellt='{$this->nachbestellt}',
      ean='{$this->ean}',
      mlmpunkte='{$this->mlmpunkte}',
      mlmbonuspunkte='{$this->mlmbonuspunkte}',
      mlmkeinepunkteeigenkauf='{$this->mlmkeinepunkteeigenkauf}',
      shop2='{$this->shop2}',
      shop3='{$this->shop3}',
      usereditid='{$this->usereditid}',
      useredittimestamp='{$this->useredittimestamp}',
      freifeld1='{$this->freifeld1}',
      freifeld2='{$this->freifeld2}',
      freifeld3='{$this->freifeld3}',
      freifeld4='{$this->freifeld4}',
      freifeld5='{$this->freifeld5}',
      freifeld6='{$this->freifeld6}',
      einheit='{$this->einheit}',
      webid='{$this->webid}',
      lieferzeitmanuell_en='{$this->lieferzeitmanuell_en}',
      variante='{$this->variante}',
      variante_von='{$this->variante_von}',
      produktioninfo='{$this->produktioninfo}',
      sonderaktion='{$this->sonderaktion}',
      sonderaktion_en='{$this->sonderaktion_en}',
      autolagerlampe='{$this->autolagerlampe}',
      leerfeld='{$this->leerfeld}',
      zolltarifnummer='{$this->zolltarifnummer}',
      herkunftsland='{$this->herkunftsland}',
      laenge='{$this->laenge}',
      breite='{$this->breite}',
      hoehe='{$this->hoehe}',
      gebuehr='{$this->gebuehr}',
      pseudolager='{$this->pseudolager}',
      downloadartikel='{$this->downloadartikel}',
      matrixprodukt='{$this->matrixprodukt}',
      steuer_erloese_inland_normal='{$this->steuer_erloese_inland_normal}',
      steuer_aufwendung_inland_normal='{$this->steuer_aufwendung_inland_normal}',
      steuer_erloese_inland_ermaessigt='{$this->steuer_erloese_inland_ermaessigt}',
      steuer_aufwendung_inland_ermaessigt='{$this->steuer_aufwendung_inland_ermaessigt}',
      steuer_erloese_inland_steuerfrei='{$this->steuer_erloese_inland_steuerfrei}',
      steuer_aufwendung_inland_steuerfrei='{$this->steuer_aufwendung_inland_steuerfrei}',
      steuer_erloese_inland_innergemeinschaftlich='{$this->steuer_erloese_inland_innergemeinschaftlich}',
      steuer_aufwendung_inland_innergemeinschaftlich='{$this->steuer_aufwendung_inland_innergemeinschaftlich}',
      steuer_erloese_inland_eunormal='{$this->steuer_erloese_inland_eunormal}',
      steuer_erloese_inland_nichtsteuerbar='{$this->steuer_erloese_inland_nichtsteuerbar}',
      steuer_erloese_inland_euermaessigt='{$this->steuer_erloese_inland_euermaessigt}',
      steuer_aufwendung_inland_nichtsteuerbar='{$this->steuer_aufwendung_inland_nichtsteuerbar}',
      steuer_aufwendung_inland_eunormal='{$this->steuer_aufwendung_inland_eunormal}',
      steuer_aufwendung_inland_euermaessigt='{$this->steuer_aufwendung_inland_euermaessigt}',
      steuer_erloese_inland_export='{$this->steuer_erloese_inland_export}',
      steuer_aufwendung_inland_import='{$this->steuer_aufwendung_inland_import}',
      steuer_art_produkt='{$this->steuer_art_produkt}',
      steuer_art_produkt_download='{$this->steuer_art_produkt_download}',
      metadescription_de='{$this->metadescription_de}',
      metadescription_en='{$this->metadescription_en}',
      metakeywords_de='{$this->metakeywords_de}',
      metakeywords_en='{$this->metakeywords_en}',
      anabregs_text_en='{$this->anabregs_text_en}',
      generierenummerbeioption='{$this->generierenummerbeioption}',
      allelieferanten='{$this->allelieferanten}'
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

    $sql = "DELETE FROM artikel WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->typ="";
    $this->nummer="";
    $this->checksum="";
    $this->projekt="";
    $this->inaktiv="";
    $this->ausverkauft="";
    $this->warengruppe="";
    $this->name_de="";
    $this->name_en="";
    $this->kurztext_de="";
    $this->kurztext_en="";
    $this->beschreibung_de="";
    $this->beschreibung_en="";
    $this->uebersicht_de="";
    $this->uebersicht_en="";
    $this->links_de="";
    $this->links_en="";
    $this->startseite_de="";
    $this->startseite_en="";
    $this->standardbild="";
    $this->herstellerlink="";
    $this->hersteller="";
    $this->teilbar="";
    $this->nteile="";
    $this->seriennummern="";
    $this->lager_platz="";
    $this->lieferzeit="";
    $this->lieferzeitmanuell="";
    $this->sonstiges="";
    $this->gewicht="";
    $this->endmontage="";
    $this->funktionstest="";
    $this->artikelcheckliste="";
    $this->stueckliste="";
    $this->juststueckliste="";
    $this->barcode="";
    $this->hinzugefuegt="";
    $this->pcbdecal="";
    $this->lagerartikel="";
    $this->porto="";
    $this->chargenverwaltung="";
    $this->provisionsartikel="";
    $this->gesperrt="";
    $this->sperrgrund="";
    $this->geloescht="";
    $this->gueltigbis="";
    $this->umsatzsteuer="";
    $this->klasse="";
    $this->adresse="";
    $this->shopartikel="";
    $this->unishopartikel="";
    $this->journalshopartikel="";
    $this->shop="";
    $this->katalog="";
    $this->katalogtext_de="";
    $this->katalogtext_en="";
    $this->katalogbezeichnung_de="";
    $this->katalogbezeichnung_en="";
    $this->neu="";
    $this->topseller="";
    $this->startseite="";
    $this->wichtig="";
    $this->mindestlager="";
    $this->mindestbestellung="";
    $this->partnerprogramm_sperre="";
    $this->internerkommentar="";
    $this->intern_gesperrt="";
    $this->intern_gesperrtuser="";
    $this->intern_gesperrtgrund="";
    $this->inbearbeitung="";
    $this->inbearbeitunguser="";
    $this->cache_lagerplatzinhaltmenge="";
    $this->internkommentar="";
    $this->firma="";
    $this->logdatei="";
    $this->anabregs_text="";
    $this->autobestellung="";
    $this->produktion="";
    $this->herstellernummer="";
    $this->restmenge="";
    $this->mlmdirektpraemie="";
    $this->keineeinzelartikelanzeigen="";
    $this->mindesthaltbarkeitsdatum="";
    $this->letzteseriennummer="";
    $this->individualartikel="";
    $this->keinrabatterlaubt="";
    $this->rabatt="";
    $this->rabatt_prozent="";
    $this->geraet="";
    $this->serviceartikel="";
    $this->autoabgleicherlaubt="";
    $this->pseudopreis="";
    $this->freigabenotwendig="";
    $this->freigaberegel="";
    $this->nachbestellt="";
    $this->ean="";
    $this->mlmpunkte="";
    $this->mlmbonuspunkte="";
    $this->mlmkeinepunkteeigenkauf="";
    $this->shop2="";
    $this->shop3="";
    $this->usereditid="";
    $this->useredittimestamp="";
    $this->freifeld1="";
    $this->freifeld2="";
    $this->freifeld3="";
    $this->freifeld4="";
    $this->freifeld5="";
    $this->freifeld6="";
    $this->einheit="";
    $this->webid="";
    $this->lieferzeitmanuell_en="";
    $this->variante="";
    $this->variante_von="";
    $this->produktioninfo="";
    $this->sonderaktion="";
    $this->sonderaktion_en="";
    $this->autolagerlampe="";
    $this->leerfeld="";
    $this->zolltarifnummer="";
    $this->herkunftsland="";
    $this->laenge="";
    $this->breite="";
    $this->hoehe="";
    $this->gebuehr="";
    $this->pseudolager="";
    $this->downloadartikel="";
    $this->matrixprodukt="";
    $this->steuer_erloese_inland_normal="";
    $this->steuer_aufwendung_inland_normal="";
    $this->steuer_erloese_inland_ermaessigt="";
    $this->steuer_aufwendung_inland_ermaessigt="";
    $this->steuer_erloese_inland_steuerfrei="";
    $this->steuer_aufwendung_inland_steuerfrei="";
    $this->steuer_erloese_inland_innergemeinschaftlich="";
    $this->steuer_aufwendung_inland_innergemeinschaftlich="";
    $this->steuer_erloese_inland_eunormal="";
    $this->steuer_erloese_inland_nichtsteuerbar="";
    $this->steuer_erloese_inland_euermaessigt="";
    $this->steuer_aufwendung_inland_nichtsteuerbar="";
    $this->steuer_aufwendung_inland_eunormal="";
    $this->steuer_aufwendung_inland_euermaessigt="";
    $this->steuer_erloese_inland_export="";
    $this->steuer_aufwendung_inland_import="";
    $this->steuer_art_produkt="";
    $this->steuer_art_produkt_download="";
    $this->metadescription_de="";
    $this->metadescription_en="";
    $this->metakeywords_de="";
    $this->metakeywords_en="";
    $this->anabregs_text_en="";
    $this->generierenummerbeioption="";
    $this->allelieferanten="";
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
  function SetNummer($value) { $this->nummer=$value; }
  function GetNummer() { return $this->nummer; }
  function SetChecksum($value) { $this->checksum=$value; }
  function GetChecksum() { return $this->checksum; }
  function SetProjekt($value) { $this->projekt=$value; }
  function GetProjekt() { return $this->projekt; }
  function SetInaktiv($value) { $this->inaktiv=$value; }
  function GetInaktiv() { return $this->inaktiv; }
  function SetAusverkauft($value) { $this->ausverkauft=$value; }
  function GetAusverkauft() { return $this->ausverkauft; }
  function SetWarengruppe($value) { $this->warengruppe=$value; }
  function GetWarengruppe() { return $this->warengruppe; }
  function SetName_De($value) { $this->name_de=$value; }
  function GetName_De() { return $this->name_de; }
  function SetName_En($value) { $this->name_en=$value; }
  function GetName_En() { return $this->name_en; }
  function SetKurztext_De($value) { $this->kurztext_de=$value; }
  function GetKurztext_De() { return $this->kurztext_de; }
  function SetKurztext_En($value) { $this->kurztext_en=$value; }
  function GetKurztext_En() { return $this->kurztext_en; }
  function SetBeschreibung_De($value) { $this->beschreibung_de=$value; }
  function GetBeschreibung_De() { return $this->beschreibung_de; }
  function SetBeschreibung_En($value) { $this->beschreibung_en=$value; }
  function GetBeschreibung_En() { return $this->beschreibung_en; }
  function SetUebersicht_De($value) { $this->uebersicht_de=$value; }
  function GetUebersicht_De() { return $this->uebersicht_de; }
  function SetUebersicht_En($value) { $this->uebersicht_en=$value; }
  function GetUebersicht_En() { return $this->uebersicht_en; }
  function SetLinks_De($value) { $this->links_de=$value; }
  function GetLinks_De() { return $this->links_de; }
  function SetLinks_En($value) { $this->links_en=$value; }
  function GetLinks_En() { return $this->links_en; }
  function SetStartseite_De($value) { $this->startseite_de=$value; }
  function GetStartseite_De() { return $this->startseite_de; }
  function SetStartseite_En($value) { $this->startseite_en=$value; }
  function GetStartseite_En() { return $this->startseite_en; }
  function SetStandardbild($value) { $this->standardbild=$value; }
  function GetStandardbild() { return $this->standardbild; }
  function SetHerstellerlink($value) { $this->herstellerlink=$value; }
  function GetHerstellerlink() { return $this->herstellerlink; }
  function SetHersteller($value) { $this->hersteller=$value; }
  function GetHersteller() { return $this->hersteller; }
  function SetTeilbar($value) { $this->teilbar=$value; }
  function GetTeilbar() { return $this->teilbar; }
  function SetNteile($value) { $this->nteile=$value; }
  function GetNteile() { return $this->nteile; }
  function SetSeriennummern($value) { $this->seriennummern=$value; }
  function GetSeriennummern() { return $this->seriennummern; }
  function SetLager_Platz($value) { $this->lager_platz=$value; }
  function GetLager_Platz() { return $this->lager_platz; }
  function SetLieferzeit($value) { $this->lieferzeit=$value; }
  function GetLieferzeit() { return $this->lieferzeit; }
  function SetLieferzeitmanuell($value) { $this->lieferzeitmanuell=$value; }
  function GetLieferzeitmanuell() { return $this->lieferzeitmanuell; }
  function SetSonstiges($value) { $this->sonstiges=$value; }
  function GetSonstiges() { return $this->sonstiges; }
  function SetGewicht($value) { $this->gewicht=$value; }
  function GetGewicht() { return $this->gewicht; }
  function SetEndmontage($value) { $this->endmontage=$value; }
  function GetEndmontage() { return $this->endmontage; }
  function SetFunktionstest($value) { $this->funktionstest=$value; }
  function GetFunktionstest() { return $this->funktionstest; }
  function SetArtikelcheckliste($value) { $this->artikelcheckliste=$value; }
  function GetArtikelcheckliste() { return $this->artikelcheckliste; }
  function SetStueckliste($value) { $this->stueckliste=$value; }
  function GetStueckliste() { return $this->stueckliste; }
  function SetJuststueckliste($value) { $this->juststueckliste=$value; }
  function GetJuststueckliste() { return $this->juststueckliste; }
  function SetBarcode($value) { $this->barcode=$value; }
  function GetBarcode() { return $this->barcode; }
  function SetHinzugefuegt($value) { $this->hinzugefuegt=$value; }
  function GetHinzugefuegt() { return $this->hinzugefuegt; }
  function SetPcbdecal($value) { $this->pcbdecal=$value; }
  function GetPcbdecal() { return $this->pcbdecal; }
  function SetLagerartikel($value) { $this->lagerartikel=$value; }
  function GetLagerartikel() { return $this->lagerartikel; }
  function SetPorto($value) { $this->porto=$value; }
  function GetPorto() { return $this->porto; }
  function SetChargenverwaltung($value) { $this->chargenverwaltung=$value; }
  function GetChargenverwaltung() { return $this->chargenverwaltung; }
  function SetProvisionsartikel($value) { $this->provisionsartikel=$value; }
  function GetProvisionsartikel() { return $this->provisionsartikel; }
  function SetGesperrt($value) { $this->gesperrt=$value; }
  function GetGesperrt() { return $this->gesperrt; }
  function SetSperrgrund($value) { $this->sperrgrund=$value; }
  function GetSperrgrund() { return $this->sperrgrund; }
  function SetGeloescht($value) { $this->geloescht=$value; }
  function GetGeloescht() { return $this->geloescht; }
  function SetGueltigbis($value) { $this->gueltigbis=$value; }
  function GetGueltigbis() { return $this->gueltigbis; }
  function SetUmsatzsteuer($value) { $this->umsatzsteuer=$value; }
  function GetUmsatzsteuer() { return $this->umsatzsteuer; }
  function SetKlasse($value) { $this->klasse=$value; }
  function GetKlasse() { return $this->klasse; }
  function SetAdresse($value) { $this->adresse=$value; }
  function GetAdresse() { return $this->adresse; }
  function SetShopartikel($value) { $this->shopartikel=$value; }
  function GetShopartikel() { return $this->shopartikel; }
  function SetUnishopartikel($value) { $this->unishopartikel=$value; }
  function GetUnishopartikel() { return $this->unishopartikel; }
  function SetJournalshopartikel($value) { $this->journalshopartikel=$value; }
  function GetJournalshopartikel() { return $this->journalshopartikel; }
  function SetShop($value) { $this->shop=$value; }
  function GetShop() { return $this->shop; }
  function SetKatalog($value) { $this->katalog=$value; }
  function GetKatalog() { return $this->katalog; }
  function SetKatalogtext_De($value) { $this->katalogtext_de=$value; }
  function GetKatalogtext_De() { return $this->katalogtext_de; }
  function SetKatalogtext_En($value) { $this->katalogtext_en=$value; }
  function GetKatalogtext_En() { return $this->katalogtext_en; }
  function SetKatalogbezeichnung_De($value) { $this->katalogbezeichnung_de=$value; }
  function GetKatalogbezeichnung_De() { return $this->katalogbezeichnung_de; }
  function SetKatalogbezeichnung_En($value) { $this->katalogbezeichnung_en=$value; }
  function GetKatalogbezeichnung_En() { return $this->katalogbezeichnung_en; }
  function SetNeu($value) { $this->neu=$value; }
  function GetNeu() { return $this->neu; }
  function SetTopseller($value) { $this->topseller=$value; }
  function GetTopseller() { return $this->topseller; }
  function SetStartseite($value) { $this->startseite=$value; }
  function GetStartseite() { return $this->startseite; }
  function SetWichtig($value) { $this->wichtig=$value; }
  function GetWichtig() { return $this->wichtig; }
  function SetMindestlager($value) { $this->mindestlager=$value; }
  function GetMindestlager() { return $this->mindestlager; }
  function SetMindestbestellung($value) { $this->mindestbestellung=$value; }
  function GetMindestbestellung() { return $this->mindestbestellung; }
  function SetPartnerprogramm_Sperre($value) { $this->partnerprogramm_sperre=$value; }
  function GetPartnerprogramm_Sperre() { return $this->partnerprogramm_sperre; }
  function SetInternerkommentar($value) { $this->internerkommentar=$value; }
  function GetInternerkommentar() { return $this->internerkommentar; }
  function SetIntern_Gesperrt($value) { $this->intern_gesperrt=$value; }
  function GetIntern_Gesperrt() { return $this->intern_gesperrt; }
  function SetIntern_Gesperrtuser($value) { $this->intern_gesperrtuser=$value; }
  function GetIntern_Gesperrtuser() { return $this->intern_gesperrtuser; }
  function SetIntern_Gesperrtgrund($value) { $this->intern_gesperrtgrund=$value; }
  function GetIntern_Gesperrtgrund() { return $this->intern_gesperrtgrund; }
  function SetInbearbeitung($value) { $this->inbearbeitung=$value; }
  function GetInbearbeitung() { return $this->inbearbeitung; }
  function SetInbearbeitunguser($value) { $this->inbearbeitunguser=$value; }
  function GetInbearbeitunguser() { return $this->inbearbeitunguser; }
  function SetCache_Lagerplatzinhaltmenge($value) { $this->cache_lagerplatzinhaltmenge=$value; }
  function GetCache_Lagerplatzinhaltmenge() { return $this->cache_lagerplatzinhaltmenge; }
  function SetInternkommentar($value) { $this->internkommentar=$value; }
  function GetInternkommentar() { return $this->internkommentar; }
  function SetFirma($value) { $this->firma=$value; }
  function GetFirma() { return $this->firma; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
  function SetAnabregs_Text($value) { $this->anabregs_text=$value; }
  function GetAnabregs_Text() { return $this->anabregs_text; }
  function SetAutobestellung($value) { $this->autobestellung=$value; }
  function GetAutobestellung() { return $this->autobestellung; }
  function SetProduktion($value) { $this->produktion=$value; }
  function GetProduktion() { return $this->produktion; }
  function SetHerstellernummer($value) { $this->herstellernummer=$value; }
  function GetHerstellernummer() { return $this->herstellernummer; }
  function SetRestmenge($value) { $this->restmenge=$value; }
  function GetRestmenge() { return $this->restmenge; }
  function SetMlmdirektpraemie($value) { $this->mlmdirektpraemie=$value; }
  function GetMlmdirektpraemie() { return $this->mlmdirektpraemie; }
  function SetKeineeinzelartikelanzeigen($value) { $this->keineeinzelartikelanzeigen=$value; }
  function GetKeineeinzelartikelanzeigen() { return $this->keineeinzelartikelanzeigen; }
  function SetMindesthaltbarkeitsdatum($value) { $this->mindesthaltbarkeitsdatum=$value; }
  function GetMindesthaltbarkeitsdatum() { return $this->mindesthaltbarkeitsdatum; }
  function SetLetzteseriennummer($value) { $this->letzteseriennummer=$value; }
  function GetLetzteseriennummer() { return $this->letzteseriennummer; }
  function SetIndividualartikel($value) { $this->individualartikel=$value; }
  function GetIndividualartikel() { return $this->individualartikel; }
  function SetKeinrabatterlaubt($value) { $this->keinrabatterlaubt=$value; }
  function GetKeinrabatterlaubt() { return $this->keinrabatterlaubt; }
  function SetRabatt($value) { $this->rabatt=$value; }
  function GetRabatt() { return $this->rabatt; }
  function SetRabatt_Prozent($value) { $this->rabatt_prozent=$value; }
  function GetRabatt_Prozent() { return $this->rabatt_prozent; }
  function SetGeraet($value) { $this->geraet=$value; }
  function GetGeraet() { return $this->geraet; }
  function SetServiceartikel($value) { $this->serviceartikel=$value; }
  function GetServiceartikel() { return $this->serviceartikel; }
  function SetAutoabgleicherlaubt($value) { $this->autoabgleicherlaubt=$value; }
  function GetAutoabgleicherlaubt() { return $this->autoabgleicherlaubt; }
  function SetPseudopreis($value) { $this->pseudopreis=$value; }
  function GetPseudopreis() { return $this->pseudopreis; }
  function SetFreigabenotwendig($value) { $this->freigabenotwendig=$value; }
  function GetFreigabenotwendig() { return $this->freigabenotwendig; }
  function SetFreigaberegel($value) { $this->freigaberegel=$value; }
  function GetFreigaberegel() { return $this->freigaberegel; }
  function SetNachbestellt($value) { $this->nachbestellt=$value; }
  function GetNachbestellt() { return $this->nachbestellt; }
  function SetEan($value) { $this->ean=$value; }
  function GetEan() { return $this->ean; }
  function SetMlmpunkte($value) { $this->mlmpunkte=$value; }
  function GetMlmpunkte() { return $this->mlmpunkte; }
  function SetMlmbonuspunkte($value) { $this->mlmbonuspunkte=$value; }
  function GetMlmbonuspunkte() { return $this->mlmbonuspunkte; }
  function SetMlmkeinepunkteeigenkauf($value) { $this->mlmkeinepunkteeigenkauf=$value; }
  function GetMlmkeinepunkteeigenkauf() { return $this->mlmkeinepunkteeigenkauf; }
  function SetShop2($value) { $this->shop2=$value; }
  function GetShop2() { return $this->shop2; }
  function SetShop3($value) { $this->shop3=$value; }
  function GetShop3() { return $this->shop3; }
  function SetUsereditid($value) { $this->usereditid=$value; }
  function GetUsereditid() { return $this->usereditid; }
  function SetUseredittimestamp($value) { $this->useredittimestamp=$value; }
  function GetUseredittimestamp() { return $this->useredittimestamp; }
  function SetFreifeld1($value) { $this->freifeld1=$value; }
  function GetFreifeld1() { return $this->freifeld1; }
  function SetFreifeld2($value) { $this->freifeld2=$value; }
  function GetFreifeld2() { return $this->freifeld2; }
  function SetFreifeld3($value) { $this->freifeld3=$value; }
  function GetFreifeld3() { return $this->freifeld3; }
  function SetFreifeld4($value) { $this->freifeld4=$value; }
  function GetFreifeld4() { return $this->freifeld4; }
  function SetFreifeld5($value) { $this->freifeld5=$value; }
  function GetFreifeld5() { return $this->freifeld5; }
  function SetFreifeld6($value) { $this->freifeld6=$value; }
  function GetFreifeld6() { return $this->freifeld6; }
  function SetEinheit($value) { $this->einheit=$value; }
  function GetEinheit() { return $this->einheit; }
  function SetWebid($value) { $this->webid=$value; }
  function GetWebid() { return $this->webid; }
  function SetLieferzeitmanuell_En($value) { $this->lieferzeitmanuell_en=$value; }
  function GetLieferzeitmanuell_En() { return $this->lieferzeitmanuell_en; }
  function SetVariante($value) { $this->variante=$value; }
  function GetVariante() { return $this->variante; }
  function SetVariante_Von($value) { $this->variante_von=$value; }
  function GetVariante_Von() { return $this->variante_von; }
  function SetProduktioninfo($value) { $this->produktioninfo=$value; }
  function GetProduktioninfo() { return $this->produktioninfo; }
  function SetSonderaktion($value) { $this->sonderaktion=$value; }
  function GetSonderaktion() { return $this->sonderaktion; }
  function SetSonderaktion_En($value) { $this->sonderaktion_en=$value; }
  function GetSonderaktion_En() { return $this->sonderaktion_en; }
  function SetAutolagerlampe($value) { $this->autolagerlampe=$value; }
  function GetAutolagerlampe() { return $this->autolagerlampe; }
  function SetLeerfeld($value) { $this->leerfeld=$value; }
  function GetLeerfeld() { return $this->leerfeld; }
  function SetZolltarifnummer($value) { $this->zolltarifnummer=$value; }
  function GetZolltarifnummer() { return $this->zolltarifnummer; }
  function SetHerkunftsland($value) { $this->herkunftsland=$value; }
  function GetHerkunftsland() { return $this->herkunftsland; }
  function SetLaenge($value) { $this->laenge=$value; }
  function GetLaenge() { return $this->laenge; }
  function SetBreite($value) { $this->breite=$value; }
  function GetBreite() { return $this->breite; }
  function SetHoehe($value) { $this->hoehe=$value; }
  function GetHoehe() { return $this->hoehe; }
  function SetGebuehr($value) { $this->gebuehr=$value; }
  function GetGebuehr() { return $this->gebuehr; }
  function SetPseudolager($value) { $this->pseudolager=$value; }
  function GetPseudolager() { return $this->pseudolager; }
  function SetDownloadartikel($value) { $this->downloadartikel=$value; }
  function GetDownloadartikel() { return $this->downloadartikel; }
  function SetMatrixprodukt($value) { $this->matrixprodukt=$value; }
  function GetMatrixprodukt() { return $this->matrixprodukt; }
  function SetSteuer_Erloese_Inland_Normal($value) { $this->steuer_erloese_inland_normal=$value; }
  function GetSteuer_Erloese_Inland_Normal() { return $this->steuer_erloese_inland_normal; }
  function SetSteuer_Aufwendung_Inland_Normal($value) { $this->steuer_aufwendung_inland_normal=$value; }
  function GetSteuer_Aufwendung_Inland_Normal() { return $this->steuer_aufwendung_inland_normal; }
  function SetSteuer_Erloese_Inland_Ermaessigt($value) { $this->steuer_erloese_inland_ermaessigt=$value; }
  function GetSteuer_Erloese_Inland_Ermaessigt() { return $this->steuer_erloese_inland_ermaessigt; }
  function SetSteuer_Aufwendung_Inland_Ermaessigt($value) { $this->steuer_aufwendung_inland_ermaessigt=$value; }
  function GetSteuer_Aufwendung_Inland_Ermaessigt() { return $this->steuer_aufwendung_inland_ermaessigt; }
  function SetSteuer_Erloese_Inland_Steuerfrei($value) { $this->steuer_erloese_inland_steuerfrei=$value; }
  function GetSteuer_Erloese_Inland_Steuerfrei() { return $this->steuer_erloese_inland_steuerfrei; }
  function SetSteuer_Aufwendung_Inland_Steuerfrei($value) { $this->steuer_aufwendung_inland_steuerfrei=$value; }
  function GetSteuer_Aufwendung_Inland_Steuerfrei() { return $this->steuer_aufwendung_inland_steuerfrei; }
  function SetSteuer_Erloese_Inland_Innergemeinschaftlich($value) { $this->steuer_erloese_inland_innergemeinschaftlich=$value; }
  function GetSteuer_Erloese_Inland_Innergemeinschaftlich() { return $this->steuer_erloese_inland_innergemeinschaftlich; }
  function SetSteuer_Aufwendung_Inland_Innergemeinschaftlich($value) { $this->steuer_aufwendung_inland_innergemeinschaftlich=$value; }
  function GetSteuer_Aufwendung_Inland_Innergemeinschaftlich() { return $this->steuer_aufwendung_inland_innergemeinschaftlich; }
  function SetSteuer_Erloese_Inland_Eunormal($value) { $this->steuer_erloese_inland_eunormal=$value; }
  function GetSteuer_Erloese_Inland_Eunormal() { return $this->steuer_erloese_inland_eunormal; }
  function SetSteuer_Erloese_Inland_Nichtsteuerbar($value) { $this->steuer_erloese_inland_nichtsteuerbar=$value; }
  function GetSteuer_Erloese_Inland_Nichtsteuerbar() { return $this->steuer_erloese_inland_nichtsteuerbar; }
  function SetSteuer_Erloese_Inland_Euermaessigt($value) { $this->steuer_erloese_inland_euermaessigt=$value; }
  function GetSteuer_Erloese_Inland_Euermaessigt() { return $this->steuer_erloese_inland_euermaessigt; }
  function SetSteuer_Aufwendung_Inland_Nichtsteuerbar($value) { $this->steuer_aufwendung_inland_nichtsteuerbar=$value; }
  function GetSteuer_Aufwendung_Inland_Nichtsteuerbar() { return $this->steuer_aufwendung_inland_nichtsteuerbar; }
  function SetSteuer_Aufwendung_Inland_Eunormal($value) { $this->steuer_aufwendung_inland_eunormal=$value; }
  function GetSteuer_Aufwendung_Inland_Eunormal() { return $this->steuer_aufwendung_inland_eunormal; }
  function SetSteuer_Aufwendung_Inland_Euermaessigt($value) { $this->steuer_aufwendung_inland_euermaessigt=$value; }
  function GetSteuer_Aufwendung_Inland_Euermaessigt() { return $this->steuer_aufwendung_inland_euermaessigt; }
  function SetSteuer_Erloese_Inland_Export($value) { $this->steuer_erloese_inland_export=$value; }
  function GetSteuer_Erloese_Inland_Export() { return $this->steuer_erloese_inland_export; }
  function SetSteuer_Aufwendung_Inland_Import($value) { $this->steuer_aufwendung_inland_import=$value; }
  function GetSteuer_Aufwendung_Inland_Import() { return $this->steuer_aufwendung_inland_import; }
  function SetSteuer_Art_Produkt($value) { $this->steuer_art_produkt=$value; }
  function GetSteuer_Art_Produkt() { return $this->steuer_art_produkt; }
  function SetSteuer_Art_Produkt_Download($value) { $this->steuer_art_produkt_download=$value; }
  function GetSteuer_Art_Produkt_Download() { return $this->steuer_art_produkt_download; }
  function SetMetadescription_De($value) { $this->metadescription_de=$value; }
  function GetMetadescription_De() { return $this->metadescription_de; }
  function SetMetadescription_En($value) { $this->metadescription_en=$value; }
  function GetMetadescription_En() { return $this->metadescription_en; }
  function SetMetakeywords_De($value) { $this->metakeywords_de=$value; }
  function GetMetakeywords_De() { return $this->metakeywords_de; }
  function SetMetakeywords_En($value) { $this->metakeywords_en=$value; }
  function GetMetakeywords_En() { return $this->metakeywords_en; }
  function SetAnabregs_Text_En($value) { $this->anabregs_text_en=$value; }
  function GetAnabregs_Text_En() { return $this->anabregs_text_en; }
  function SetGenerierenummerbeioption($value) { $this->generierenummerbeioption=$value; }
  function GetGenerierenummerbeioption() { return $this->generierenummerbeioption; }
  function SetAllelieferanten($value) { $this->allelieferanten=$value; }
  function GetAllelieferanten() { return $this->allelieferanten; }

}

?>