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

class ObjGenProjekt
{

  private  $id;
  private  $name;
  private  $abkuerzung;
  private  $verantwortlicher;
  private  $beschreibung;
  private  $sonstiges;
  private  $aktiv;
  private  $farbe;
  private  $autoversand;
  private  $checkok;
  private  $portocheck;
  private  $automailrechnung;
  private  $checkname;
  private  $zahlungserinnerung;
  private  $zahlungsmailbedinungen;
  private  $folgebestaetigung;
  private  $stornomail;
  private  $kundenfreigabe_loeschen;
  private  $autobestellung;
  private  $speziallieferschein;
  private  $lieferscheinbriefpapier;
  private  $speziallieferscheinbeschriftung;
  private  $firma;
  private  $geloescht;
  private  $logdatei;
  private  $steuersatz_normal;
  private  $steuersatz_zwischen;
  private  $steuersatz_ermaessigt;
  private  $steuersatz_starkermaessigt;
  private  $steuersatz_dienstleistung;
  private  $waehrung;
  private  $eigenesteuer;
  private  $druckerlogistikstufe1;
  private  $druckerlogistikstufe2;
  private  $selbstabholermail;
  private  $eanherstellerscan;
  private  $reservierung;
  private  $verkaufszahlendiagram;
  private  $oeffentlich;
  private  $shopzwangsprojekt;
  private  $kunde;
  private  $dpdkundennr;
  private  $dhlkundennr;
  private  $dhlformat;
  private  $dpdformat;
  private  $paketmarke_einzeldatei;
  private  $dpdpfad;
  private  $dhlpfad;
  private  $upspfad;
  private  $dhlintodb;
  private  $intraship_enabled;
  private  $intraship_drucker;
  private  $intraship_testmode;
  private  $intraship_user;
  private  $intraship_signature;
  private  $intraship_ekp;
  private  $intraship_api_user;
  private  $intraship_api_password;
  private  $intraship_company_name;
  private  $intraship_street_name;
  private  $intraship_street_number;
  private  $intraship_zip;
  private  $intraship_country;
  private  $intraship_city;
  private  $intraship_email;
  private  $intraship_phone;
  private  $intraship_internet;
  private  $intraship_contact_person;
  private  $intraship_account_owner;
  private  $intraship_account_number;
  private  $intraship_bank_code;
  private  $intraship_bank_name;
  private  $intraship_iban;
  private  $intraship_bic;
  private  $intraship_WeightInKG;
  private  $intraship_LengthInCM;
  private  $intraship_WidthInCM;
  private  $intraship_HeightInCM;
  private  $intraship_PackageType;
  private  $abrechnungsart;
  private  $kommissionierverfahren;
  private  $wechselaufeinstufig;
  private  $projektuebergreifendkommisionieren;
  private  $absendeadresse;
  private  $absendename;
  private  $absendesignatur;
  private  $autodruckrechnung;
  private  $autodruckversandbestaetigung;
  private  $automailversandbestaetigung;
  private  $autodrucklieferschein;
  private  $automaillieferschein;
  private  $autodruckstorno;
  private  $autodruckanhang;
  private  $automailanhang;
  private  $autodruckerrechnung;
  private  $autodruckerlieferschein;
  private  $autodruckeranhang;
  private  $autodruckrechnungmenge;
  private  $autodrucklieferscheinmenge;
  private  $eigenernummernkreis;
  private  $next_angebot;
  private  $next_auftrag;
  private  $next_rechnung;
  private  $next_lieferschein;
  private  $next_arbeitsnachweis;
  private  $next_reisekosten;
  private  $next_bestellung;
  private  $next_gutschrift;
  private  $next_kundennummer;
  private  $next_lieferantennummer;
  private  $next_mitarbeiternummer;
  private  $next_waren;
  private  $next_produktion;
  private  $next_sonstiges;
  private  $next_anfrage;
  private  $next_artikelnummer;
  private  $gesamtstunden_max;
  private  $auftragid;
  private  $dhlzahlungmandant;
  private  $dhlretourenschein;
  private  $land;
  private  $etiketten_positionen;
  private  $etiketten_drucker;
  private  $etiketten_art;
  private  $seriennummernerfassen;
  private  $versandzweigeteilt;
  private  $nachnahmecheck;
  private  $kasse_lieferschein_anlegen;
  private  $kasse_lagerprozess;
  private  $kasse_belegausgabe;
  private  $kasse_preisgruppe;
  private  $kasse_text_bemerkung;
  private  $kasse_text_freitext;
  private  $kasse_drucker;
  private  $kasse_lieferschein;
  private  $kasse_rechnung;
  private  $kasse_lieferschein_doppel;
  private  $kasse_lager;
  private  $kasse_konto;
  private  $kasse_laufkundschaft;
  private  $kasse_rabatt_artikel;
  private  $kasse_zahlung_bar;
  private  $kasse_zahlung_ec;
  private  $kasse_zahlung_kreditkarte;
  private  $kasse_zahlung_ueberweisung;
  private  $kasse_zahlung_paypal;
  private  $kasse_extra_keinbeleg;
  private  $kasse_extra_rechnung;
  private  $kasse_extra_quittung;
  private  $kasse_extra_gutschein;
  private  $kasse_extra_rabatt_prozent;
  private  $kasse_extra_rabatt_euro;
  private  $kasse_adresse_erweitert;
  private  $kasse_zahlungsauswahl_zwang;
  private  $kasse_button_entnahme;
  private  $kasse_button_trinkgeld;
  private  $kasse_vorauswahl_anrede;
  private  $kasse_erweiterte_lagerabfrage;
  private  $filialadresse;
  private  $versandprojektfiliale;
  private  $differenz_auslieferung_tage;
  private  $autostuecklistenanpassung;
  private  $dpdendung;
  private  $dhlendung;
  private  $tracking_substr_start;
  private  $tracking_remove_kundennummer;
  private  $tracking_substr_length;
  private  $go_drucker;
  private  $go_apiurl_prefix;
  private  $go_apiurl_postfix;
  private  $go_apiurl_user;
  private  $go_username;
  private  $go_password;
  private  $go_ax4nr;
  private  $go_name1;
  private  $go_name2;
  private  $go_abteilung;
  private  $go_strasse1;
  private  $go_strasse2;
  private  $go_hausnummer;
  private  $go_plz;
  private  $go_ort;
  private  $go_land;
  private  $go_standardgewicht;
  private  $go_format;
  private  $go_ausgabe;
  private  $intraship_exportgrund;
  private  $billsafe_merchantId;
  private  $billsafe_merchantLicenseSandbox;
  private  $billsafe_merchantLicenseLive;
  private  $billsafe_applicationSignature;
  private  $billsafe_applicationVersion;
  private  $secupay_apikey;
  private  $secupay_url;
  private  $secupay_demo;
  private  $kasse_zahlung_bar_bezahlt;
  private  $kasse_zahlung_ec_bezahlt;
  private  $kasse_zahlung_kreditkarte_bezahlt;
  private  $kasse_zahlung_ueberweisung_bezahlt;
  private  $kasse_zahlung_paypal_bezahlt;

  public $app;            //application object 

  public function ObjGenProjekt($app)
  {
    $this->app = $app;
  }

  public function Select($id)
  {
    if(is_numeric($id))
      $result = $this->app->DB->SelectArr("SELECT * FROM projekt WHERE (id = '$id')");
    else
      return -1;

$result = $result[0];

    $this->id=$result['id'];
    $this->name=$result['name'];
    $this->abkuerzung=$result['abkuerzung'];
    $this->verantwortlicher=$result['verantwortlicher'];
    $this->beschreibung=$result['beschreibung'];
    $this->sonstiges=$result['sonstiges'];
    $this->aktiv=$result['aktiv'];
    $this->farbe=$result['farbe'];
    $this->autoversand=$result['autoversand'];
    $this->checkok=$result['checkok'];
    $this->portocheck=$result['portocheck'];
    $this->automailrechnung=$result['automailrechnung'];
    $this->checkname=$result['checkname'];
    $this->zahlungserinnerung=$result['zahlungserinnerung'];
    $this->zahlungsmailbedinungen=$result['zahlungsmailbedinungen'];
    $this->folgebestaetigung=$result['folgebestaetigung'];
    $this->stornomail=$result['stornomail'];
    $this->kundenfreigabe_loeschen=$result['kundenfreigabe_loeschen'];
    $this->autobestellung=$result['autobestellung'];
    $this->speziallieferschein=$result['speziallieferschein'];
    $this->lieferscheinbriefpapier=$result['lieferscheinbriefpapier'];
    $this->speziallieferscheinbeschriftung=$result['speziallieferscheinbeschriftung'];
    $this->firma=$result['firma'];
    $this->geloescht=$result['geloescht'];
    $this->logdatei=$result['logdatei'];
    $this->steuersatz_normal=$result['steuersatz_normal'];
    $this->steuersatz_zwischen=$result['steuersatz_zwischen'];
    $this->steuersatz_ermaessigt=$result['steuersatz_ermaessigt'];
    $this->steuersatz_starkermaessigt=$result['steuersatz_starkermaessigt'];
    $this->steuersatz_dienstleistung=$result['steuersatz_dienstleistung'];
    $this->waehrung=$result['waehrung'];
    $this->eigenesteuer=$result['eigenesteuer'];
    $this->druckerlogistikstufe1=$result['druckerlogistikstufe1'];
    $this->druckerlogistikstufe2=$result['druckerlogistikstufe2'];
    $this->selbstabholermail=$result['selbstabholermail'];
    $this->eanherstellerscan=$result['eanherstellerscan'];
    $this->reservierung=$result['reservierung'];
    $this->verkaufszahlendiagram=$result['verkaufszahlendiagram'];
    $this->oeffentlich=$result['oeffentlich'];
    $this->shopzwangsprojekt=$result['shopzwangsprojekt'];
    $this->kunde=$result['kunde'];
    $this->dpdkundennr=$result['dpdkundennr'];
    $this->dhlkundennr=$result['dhlkundennr'];
    $this->dhlformat=$result['dhlformat'];
    $this->dpdformat=$result['dpdformat'];
    $this->paketmarke_einzeldatei=$result['paketmarke_einzeldatei'];
    $this->dpdpfad=$result['dpdpfad'];
    $this->dhlpfad=$result['dhlpfad'];
    $this->upspfad=$result['upspfad'];
    $this->dhlintodb=$result['dhlintodb'];
    $this->intraship_enabled=$result['intraship_enabled'];
    $this->intraship_drucker=$result['intraship_drucker'];
    $this->intraship_testmode=$result['intraship_testmode'];
    $this->intraship_user=$result['intraship_user'];
    $this->intraship_signature=$result['intraship_signature'];
    $this->intraship_ekp=$result['intraship_ekp'];
    $this->intraship_api_user=$result['intraship_api_user'];
    $this->intraship_api_password=$result['intraship_api_password'];
    $this->intraship_company_name=$result['intraship_company_name'];
    $this->intraship_street_name=$result['intraship_street_name'];
    $this->intraship_street_number=$result['intraship_street_number'];
    $this->intraship_zip=$result['intraship_zip'];
    $this->intraship_country=$result['intraship_country'];
    $this->intraship_city=$result['intraship_city'];
    $this->intraship_email=$result['intraship_email'];
    $this->intraship_phone=$result['intraship_phone'];
    $this->intraship_internet=$result['intraship_internet'];
    $this->intraship_contact_person=$result['intraship_contact_person'];
    $this->intraship_account_owner=$result['intraship_account_owner'];
    $this->intraship_account_number=$result['intraship_account_number'];
    $this->intraship_bank_code=$result['intraship_bank_code'];
    $this->intraship_bank_name=$result['intraship_bank_name'];
    $this->intraship_iban=$result['intraship_iban'];
    $this->intraship_bic=$result['intraship_bic'];
    $this->intraship_WeightInKG=$result['intraship_WeightInKG'];
    $this->intraship_LengthInCM=$result['intraship_LengthInCM'];
    $this->intraship_WidthInCM=$result['intraship_WidthInCM'];
    $this->intraship_HeightInCM=$result['intraship_HeightInCM'];
    $this->intraship_PackageType=$result['intraship_PackageType'];
    $this->abrechnungsart=$result['abrechnungsart'];
    $this->kommissionierverfahren=$result['kommissionierverfahren'];
    $this->wechselaufeinstufig=$result['wechselaufeinstufig'];
    $this->projektuebergreifendkommisionieren=$result['projektuebergreifendkommisionieren'];
    $this->absendeadresse=$result['absendeadresse'];
    $this->absendename=$result['absendename'];
    $this->absendesignatur=$result['absendesignatur'];
    $this->autodruckrechnung=$result['autodruckrechnung'];
    $this->autodruckversandbestaetigung=$result['autodruckversandbestaetigung'];
    $this->automailversandbestaetigung=$result['automailversandbestaetigung'];
    $this->autodrucklieferschein=$result['autodrucklieferschein'];
    $this->automaillieferschein=$result['automaillieferschein'];
    $this->autodruckstorno=$result['autodruckstorno'];
    $this->autodruckanhang=$result['autodruckanhang'];
    $this->automailanhang=$result['automailanhang'];
    $this->autodruckerrechnung=$result['autodruckerrechnung'];
    $this->autodruckerlieferschein=$result['autodruckerlieferschein'];
    $this->autodruckeranhang=$result['autodruckeranhang'];
    $this->autodruckrechnungmenge=$result['autodruckrechnungmenge'];
    $this->autodrucklieferscheinmenge=$result['autodrucklieferscheinmenge'];
    $this->eigenernummernkreis=$result['eigenernummernkreis'];
    $this->next_angebot=$result['next_angebot'];
    $this->next_auftrag=$result['next_auftrag'];
    $this->next_rechnung=$result['next_rechnung'];
    $this->next_lieferschein=$result['next_lieferschein'];
    $this->next_arbeitsnachweis=$result['next_arbeitsnachweis'];
    $this->next_reisekosten=$result['next_reisekosten'];
    $this->next_bestellung=$result['next_bestellung'];
    $this->next_gutschrift=$result['next_gutschrift'];
    $this->next_kundennummer=$result['next_kundennummer'];
    $this->next_lieferantennummer=$result['next_lieferantennummer'];
    $this->next_mitarbeiternummer=$result['next_mitarbeiternummer'];
    $this->next_waren=$result['next_waren'];
    $this->next_produktion=$result['next_produktion'];
    $this->next_sonstiges=$result['next_sonstiges'];
    $this->next_anfrage=$result['next_anfrage'];
    $this->next_artikelnummer=$result['next_artikelnummer'];
    $this->gesamtstunden_max=$result['gesamtstunden_max'];
    $this->auftragid=$result['auftragid'];
    $this->dhlzahlungmandant=$result['dhlzahlungmandant'];
    $this->dhlretourenschein=$result['dhlretourenschein'];
    $this->land=$result['land'];
    $this->etiketten_positionen=$result['etiketten_positionen'];
    $this->etiketten_drucker=$result['etiketten_drucker'];
    $this->etiketten_art=$result['etiketten_art'];
    $this->seriennummernerfassen=$result['seriennummernerfassen'];
    $this->versandzweigeteilt=$result['versandzweigeteilt'];
    $this->nachnahmecheck=$result['nachnahmecheck'];
    $this->kasse_lieferschein_anlegen=$result['kasse_lieferschein_anlegen'];
    $this->kasse_lagerprozess=$result['kasse_lagerprozess'];
    $this->kasse_belegausgabe=$result['kasse_belegausgabe'];
    $this->kasse_preisgruppe=$result['kasse_preisgruppe'];
    $this->kasse_text_bemerkung=$result['kasse_text_bemerkung'];
    $this->kasse_text_freitext=$result['kasse_text_freitext'];
    $this->kasse_drucker=$result['kasse_drucker'];
    $this->kasse_lieferschein=$result['kasse_lieferschein'];
    $this->kasse_rechnung=$result['kasse_rechnung'];
    $this->kasse_lieferschein_doppel=$result['kasse_lieferschein_doppel'];
    $this->kasse_lager=$result['kasse_lager'];
    $this->kasse_konto=$result['kasse_konto'];
    $this->kasse_laufkundschaft=$result['kasse_laufkundschaft'];
    $this->kasse_rabatt_artikel=$result['kasse_rabatt_artikel'];
    $this->kasse_zahlung_bar=$result['kasse_zahlung_bar'];
    $this->kasse_zahlung_ec=$result['kasse_zahlung_ec'];
    $this->kasse_zahlung_kreditkarte=$result['kasse_zahlung_kreditkarte'];
    $this->kasse_zahlung_ueberweisung=$result['kasse_zahlung_ueberweisung'];
    $this->kasse_zahlung_paypal=$result['kasse_zahlung_paypal'];
    $this->kasse_extra_keinbeleg=$result['kasse_extra_keinbeleg'];
    $this->kasse_extra_rechnung=$result['kasse_extra_rechnung'];
    $this->kasse_extra_quittung=$result['kasse_extra_quittung'];
    $this->kasse_extra_gutschein=$result['kasse_extra_gutschein'];
    $this->kasse_extra_rabatt_prozent=$result['kasse_extra_rabatt_prozent'];
    $this->kasse_extra_rabatt_euro=$result['kasse_extra_rabatt_euro'];
    $this->kasse_adresse_erweitert=$result['kasse_adresse_erweitert'];
    $this->kasse_zahlungsauswahl_zwang=$result['kasse_zahlungsauswahl_zwang'];
    $this->kasse_button_entnahme=$result['kasse_button_entnahme'];
    $this->kasse_button_trinkgeld=$result['kasse_button_trinkgeld'];
    $this->kasse_vorauswahl_anrede=$result['kasse_vorauswahl_anrede'];
    $this->kasse_erweiterte_lagerabfrage=$result['kasse_erweiterte_lagerabfrage'];
    $this->filialadresse=$result['filialadresse'];
    $this->versandprojektfiliale=$result['versandprojektfiliale'];
    $this->differenz_auslieferung_tage=$result['differenz_auslieferung_tage'];
    $this->autostuecklistenanpassung=$result['autostuecklistenanpassung'];
    $this->dpdendung=$result['dpdendung'];
    $this->dhlendung=$result['dhlendung'];
    $this->tracking_substr_start=$result['tracking_substr_start'];
    $this->tracking_remove_kundennummer=$result['tracking_remove_kundennummer'];
    $this->tracking_substr_length=$result['tracking_substr_length'];
    $this->go_drucker=$result['go_drucker'];
    $this->go_apiurl_prefix=$result['go_apiurl_prefix'];
    $this->go_apiurl_postfix=$result['go_apiurl_postfix'];
    $this->go_apiurl_user=$result['go_apiurl_user'];
    $this->go_username=$result['go_username'];
    $this->go_password=$result['go_password'];
    $this->go_ax4nr=$result['go_ax4nr'];
    $this->go_name1=$result['go_name1'];
    $this->go_name2=$result['go_name2'];
    $this->go_abteilung=$result['go_abteilung'];
    $this->go_strasse1=$result['go_strasse1'];
    $this->go_strasse2=$result['go_strasse2'];
    $this->go_hausnummer=$result['go_hausnummer'];
    $this->go_plz=$result['go_plz'];
    $this->go_ort=$result['go_ort'];
    $this->go_land=$result['go_land'];
    $this->go_standardgewicht=$result['go_standardgewicht'];
    $this->go_format=$result['go_format'];
    $this->go_ausgabe=$result['go_ausgabe'];
    $this->intraship_exportgrund=$result['intraship_exportgrund'];
    $this->billsafe_merchantId=$result['billsafe_merchantId'];
    $this->billsafe_merchantLicenseSandbox=$result['billsafe_merchantLicenseSandbox'];
    $this->billsafe_merchantLicenseLive=$result['billsafe_merchantLicenseLive'];
    $this->billsafe_applicationSignature=$result['billsafe_applicationSignature'];
    $this->billsafe_applicationVersion=$result['billsafe_applicationVersion'];
    $this->secupay_apikey=$result['secupay_apikey'];
    $this->secupay_url=$result['secupay_url'];
    $this->secupay_demo=$result['secupay_demo'];
    $this->kasse_zahlung_bar_bezahlt=$result['kasse_zahlung_bar_bezahlt'];
    $this->kasse_zahlung_ec_bezahlt=$result['kasse_zahlung_ec_bezahlt'];
    $this->kasse_zahlung_kreditkarte_bezahlt=$result['kasse_zahlung_kreditkarte_bezahlt'];
    $this->kasse_zahlung_ueberweisung_bezahlt=$result['kasse_zahlung_ueberweisung_bezahlt'];
    $this->kasse_zahlung_paypal_bezahlt=$result['kasse_zahlung_paypal_bezahlt'];
  }

  public function Create()
  {
    $sql = "INSERT INTO projekt (id,name,abkuerzung,verantwortlicher,beschreibung,sonstiges,aktiv,farbe,autoversand,checkok,portocheck,automailrechnung,checkname,zahlungserinnerung,zahlungsmailbedinungen,folgebestaetigung,stornomail,kundenfreigabe_loeschen,autobestellung,speziallieferschein,lieferscheinbriefpapier,speziallieferscheinbeschriftung,firma,geloescht,logdatei,steuersatz_normal,steuersatz_zwischen,steuersatz_ermaessigt,steuersatz_starkermaessigt,steuersatz_dienstleistung,waehrung,eigenesteuer,druckerlogistikstufe1,druckerlogistikstufe2,selbstabholermail,eanherstellerscan,reservierung,verkaufszahlendiagram,oeffentlich,shopzwangsprojekt,kunde,dpdkundennr,dhlkundennr,dhlformat,dpdformat,paketmarke_einzeldatei,dpdpfad,dhlpfad,upspfad,dhlintodb,intraship_enabled,intraship_drucker,intraship_testmode,intraship_user,intraship_signature,intraship_ekp,intraship_api_user,intraship_api_password,intraship_company_name,intraship_street_name,intraship_street_number,intraship_zip,intraship_country,intraship_city,intraship_email,intraship_phone,intraship_internet,intraship_contact_person,intraship_account_owner,intraship_account_number,intraship_bank_code,intraship_bank_name,intraship_iban,intraship_bic,intraship_WeightInKG,intraship_LengthInCM,intraship_WidthInCM,intraship_HeightInCM,intraship_PackageType,abrechnungsart,kommissionierverfahren,wechselaufeinstufig,projektuebergreifendkommisionieren,absendeadresse,absendename,absendesignatur,autodruckrechnung,autodruckversandbestaetigung,automailversandbestaetigung,autodrucklieferschein,automaillieferschein,autodruckstorno,autodruckanhang,automailanhang,autodruckerrechnung,autodruckerlieferschein,autodruckeranhang,autodruckrechnungmenge,autodrucklieferscheinmenge,eigenernummernkreis,next_angebot,next_auftrag,next_rechnung,next_lieferschein,next_arbeitsnachweis,next_reisekosten,next_bestellung,next_gutschrift,next_kundennummer,next_lieferantennummer,next_mitarbeiternummer,next_waren,next_produktion,next_sonstiges,next_anfrage,next_artikelnummer,gesamtstunden_max,auftragid,dhlzahlungmandant,dhlretourenschein,land,etiketten_positionen,etiketten_drucker,etiketten_art,seriennummernerfassen,versandzweigeteilt,nachnahmecheck,kasse_lieferschein_anlegen,kasse_lagerprozess,kasse_belegausgabe,kasse_preisgruppe,kasse_text_bemerkung,kasse_text_freitext,kasse_drucker,kasse_lieferschein,kasse_rechnung,kasse_lieferschein_doppel,kasse_lager,kasse_konto,kasse_laufkundschaft,kasse_rabatt_artikel,kasse_zahlung_bar,kasse_zahlung_ec,kasse_zahlung_kreditkarte,kasse_zahlung_ueberweisung,kasse_zahlung_paypal,kasse_extra_keinbeleg,kasse_extra_rechnung,kasse_extra_quittung,kasse_extra_gutschein,kasse_extra_rabatt_prozent,kasse_extra_rabatt_euro,kasse_adresse_erweitert,kasse_zahlungsauswahl_zwang,kasse_button_entnahme,kasse_button_trinkgeld,kasse_vorauswahl_anrede,kasse_erweiterte_lagerabfrage,filialadresse,versandprojektfiliale,differenz_auslieferung_tage,autostuecklistenanpassung,dpdendung,dhlendung,tracking_substr_start,tracking_remove_kundennummer,tracking_substr_length,go_drucker,go_apiurl_prefix,go_apiurl_postfix,go_apiurl_user,go_username,go_password,go_ax4nr,go_name1,go_name2,go_abteilung,go_strasse1,go_strasse2,go_hausnummer,go_plz,go_ort,go_land,go_standardgewicht,go_format,go_ausgabe,intraship_exportgrund,billsafe_merchantId,billsafe_merchantLicenseSandbox,billsafe_merchantLicenseLive,billsafe_applicationSignature,billsafe_applicationVersion,secupay_apikey,secupay_url,secupay_demo,kasse_zahlung_bar_bezahlt,kasse_zahlung_ec_bezahlt,kasse_zahlung_kreditkarte_bezahlt,kasse_zahlung_ueberweisung_bezahlt,kasse_zahlung_paypal_bezahlt)
      VALUES('','{$this->name}','{$this->abkuerzung}','{$this->verantwortlicher}','{$this->beschreibung}','{$this->sonstiges}','{$this->aktiv}','{$this->farbe}','{$this->autoversand}','{$this->checkok}','{$this->portocheck}','{$this->automailrechnung}','{$this->checkname}','{$this->zahlungserinnerung}','{$this->zahlungsmailbedinungen}','{$this->folgebestaetigung}','{$this->stornomail}','{$this->kundenfreigabe_loeschen}','{$this->autobestellung}','{$this->speziallieferschein}','{$this->lieferscheinbriefpapier}','{$this->speziallieferscheinbeschriftung}','{$this->firma}','{$this->geloescht}','{$this->logdatei}','{$this->steuersatz_normal}','{$this->steuersatz_zwischen}','{$this->steuersatz_ermaessigt}','{$this->steuersatz_starkermaessigt}','{$this->steuersatz_dienstleistung}','{$this->waehrung}','{$this->eigenesteuer}','{$this->druckerlogistikstufe1}','{$this->druckerlogistikstufe2}','{$this->selbstabholermail}','{$this->eanherstellerscan}','{$this->reservierung}','{$this->verkaufszahlendiagram}','{$this->oeffentlich}','{$this->shopzwangsprojekt}','{$this->kunde}','{$this->dpdkundennr}','{$this->dhlkundennr}','{$this->dhlformat}','{$this->dpdformat}','{$this->paketmarke_einzeldatei}','{$this->dpdpfad}','{$this->dhlpfad}','{$this->upspfad}','{$this->dhlintodb}','{$this->intraship_enabled}','{$this->intraship_drucker}','{$this->intraship_testmode}','{$this->intraship_user}','{$this->intraship_signature}','{$this->intraship_ekp}','{$this->intraship_api_user}','{$this->intraship_api_password}','{$this->intraship_company_name}','{$this->intraship_street_name}','{$this->intraship_street_number}','{$this->intraship_zip}','{$this->intraship_country}','{$this->intraship_city}','{$this->intraship_email}','{$this->intraship_phone}','{$this->intraship_internet}','{$this->intraship_contact_person}','{$this->intraship_account_owner}','{$this->intraship_account_number}','{$this->intraship_bank_code}','{$this->intraship_bank_name}','{$this->intraship_iban}','{$this->intraship_bic}','{$this->intraship_WeightInKG}','{$this->intraship_LengthInCM}','{$this->intraship_WidthInCM}','{$this->intraship_HeightInCM}','{$this->intraship_PackageType}','{$this->abrechnungsart}','{$this->kommissionierverfahren}','{$this->wechselaufeinstufig}','{$this->projektuebergreifendkommisionieren}','{$this->absendeadresse}','{$this->absendename}','{$this->absendesignatur}','{$this->autodruckrechnung}','{$this->autodruckversandbestaetigung}','{$this->automailversandbestaetigung}','{$this->autodrucklieferschein}','{$this->automaillieferschein}','{$this->autodruckstorno}','{$this->autodruckanhang}','{$this->automailanhang}','{$this->autodruckerrechnung}','{$this->autodruckerlieferschein}','{$this->autodruckeranhang}','{$this->autodruckrechnungmenge}','{$this->autodrucklieferscheinmenge}','{$this->eigenernummernkreis}','{$this->next_angebot}','{$this->next_auftrag}','{$this->next_rechnung}','{$this->next_lieferschein}','{$this->next_arbeitsnachweis}','{$this->next_reisekosten}','{$this->next_bestellung}','{$this->next_gutschrift}','{$this->next_kundennummer}','{$this->next_lieferantennummer}','{$this->next_mitarbeiternummer}','{$this->next_waren}','{$this->next_produktion}','{$this->next_sonstiges}','{$this->next_anfrage}','{$this->next_artikelnummer}','{$this->gesamtstunden_max}','{$this->auftragid}','{$this->dhlzahlungmandant}','{$this->dhlretourenschein}','{$this->land}','{$this->etiketten_positionen}','{$this->etiketten_drucker}','{$this->etiketten_art}','{$this->seriennummernerfassen}','{$this->versandzweigeteilt}','{$this->nachnahmecheck}','{$this->kasse_lieferschein_anlegen}','{$this->kasse_lagerprozess}','{$this->kasse_belegausgabe}','{$this->kasse_preisgruppe}','{$this->kasse_text_bemerkung}','{$this->kasse_text_freitext}','{$this->kasse_drucker}','{$this->kasse_lieferschein}','{$this->kasse_rechnung}','{$this->kasse_lieferschein_doppel}','{$this->kasse_lager}','{$this->kasse_konto}','{$this->kasse_laufkundschaft}','{$this->kasse_rabatt_artikel}','{$this->kasse_zahlung_bar}','{$this->kasse_zahlung_ec}','{$this->kasse_zahlung_kreditkarte}','{$this->kasse_zahlung_ueberweisung}','{$this->kasse_zahlung_paypal}','{$this->kasse_extra_keinbeleg}','{$this->kasse_extra_rechnung}','{$this->kasse_extra_quittung}','{$this->kasse_extra_gutschein}','{$this->kasse_extra_rabatt_prozent}','{$this->kasse_extra_rabatt_euro}','{$this->kasse_adresse_erweitert}','{$this->kasse_zahlungsauswahl_zwang}','{$this->kasse_button_entnahme}','{$this->kasse_button_trinkgeld}','{$this->kasse_vorauswahl_anrede}','{$this->kasse_erweiterte_lagerabfrage}','{$this->filialadresse}','{$this->versandprojektfiliale}','{$this->differenz_auslieferung_tage}','{$this->autostuecklistenanpassung}','{$this->dpdendung}','{$this->dhlendung}','{$this->tracking_substr_start}','{$this->tracking_remove_kundennummer}','{$this->tracking_substr_length}','{$this->go_drucker}','{$this->go_apiurl_prefix}','{$this->go_apiurl_postfix}','{$this->go_apiurl_user}','{$this->go_username}','{$this->go_password}','{$this->go_ax4nr}','{$this->go_name1}','{$this->go_name2}','{$this->go_abteilung}','{$this->go_strasse1}','{$this->go_strasse2}','{$this->go_hausnummer}','{$this->go_plz}','{$this->go_ort}','{$this->go_land}','{$this->go_standardgewicht}','{$this->go_format}','{$this->go_ausgabe}','{$this->intraship_exportgrund}','{$this->billsafe_merchantId}','{$this->billsafe_merchantLicenseSandbox}','{$this->billsafe_merchantLicenseLive}','{$this->billsafe_applicationSignature}','{$this->billsafe_applicationVersion}','{$this->secupay_apikey}','{$this->secupay_url}','{$this->secupay_demo}','{$this->kasse_zahlung_bar_bezahlt}','{$this->kasse_zahlung_ec_bezahlt}','{$this->kasse_zahlung_kreditkarte_bezahlt}','{$this->kasse_zahlung_ueberweisung_bezahlt}','{$this->kasse_zahlung_paypal_bezahlt}')"; 

    $this->app->DB->Insert($sql);
    $this->id = $this->app->DB->GetInsertID();
  }

  public function Update()
  {
    if(!is_numeric($this->id))
      return -1;

    $sql = "UPDATE projekt SET
      name='{$this->name}',
      abkuerzung='{$this->abkuerzung}',
      verantwortlicher='{$this->verantwortlicher}',
      beschreibung='{$this->beschreibung}',
      sonstiges='{$this->sonstiges}',
      aktiv='{$this->aktiv}',
      farbe='{$this->farbe}',
      autoversand='{$this->autoversand}',
      checkok='{$this->checkok}',
      portocheck='{$this->portocheck}',
      automailrechnung='{$this->automailrechnung}',
      checkname='{$this->checkname}',
      zahlungserinnerung='{$this->zahlungserinnerung}',
      zahlungsmailbedinungen='{$this->zahlungsmailbedinungen}',
      folgebestaetigung='{$this->folgebestaetigung}',
      stornomail='{$this->stornomail}',
      kundenfreigabe_loeschen='{$this->kundenfreigabe_loeschen}',
      autobestellung='{$this->autobestellung}',
      speziallieferschein='{$this->speziallieferschein}',
      lieferscheinbriefpapier='{$this->lieferscheinbriefpapier}',
      speziallieferscheinbeschriftung='{$this->speziallieferscheinbeschriftung}',
      firma='{$this->firma}',
      geloescht='{$this->geloescht}',
      logdatei='{$this->logdatei}',
      steuersatz_normal='{$this->steuersatz_normal}',
      steuersatz_zwischen='{$this->steuersatz_zwischen}',
      steuersatz_ermaessigt='{$this->steuersatz_ermaessigt}',
      steuersatz_starkermaessigt='{$this->steuersatz_starkermaessigt}',
      steuersatz_dienstleistung='{$this->steuersatz_dienstleistung}',
      waehrung='{$this->waehrung}',
      eigenesteuer='{$this->eigenesteuer}',
      druckerlogistikstufe1='{$this->druckerlogistikstufe1}',
      druckerlogistikstufe2='{$this->druckerlogistikstufe2}',
      selbstabholermail='{$this->selbstabholermail}',
      eanherstellerscan='{$this->eanherstellerscan}',
      reservierung='{$this->reservierung}',
      verkaufszahlendiagram='{$this->verkaufszahlendiagram}',
      oeffentlich='{$this->oeffentlich}',
      shopzwangsprojekt='{$this->shopzwangsprojekt}',
      kunde='{$this->kunde}',
      dpdkundennr='{$this->dpdkundennr}',
      dhlkundennr='{$this->dhlkundennr}',
      dhlformat='{$this->dhlformat}',
      dpdformat='{$this->dpdformat}',
      paketmarke_einzeldatei='{$this->paketmarke_einzeldatei}',
      dpdpfad='{$this->dpdpfad}',
      dhlpfad='{$this->dhlpfad}',
      upspfad='{$this->upspfad}',
      dhlintodb='{$this->dhlintodb}',
      intraship_enabled='{$this->intraship_enabled}',
      intraship_drucker='{$this->intraship_drucker}',
      intraship_testmode='{$this->intraship_testmode}',
      intraship_user='{$this->intraship_user}',
      intraship_signature='{$this->intraship_signature}',
      intraship_ekp='{$this->intraship_ekp}',
      intraship_api_user='{$this->intraship_api_user}',
      intraship_api_password='{$this->intraship_api_password}',
      intraship_company_name='{$this->intraship_company_name}',
      intraship_street_name='{$this->intraship_street_name}',
      intraship_street_number='{$this->intraship_street_number}',
      intraship_zip='{$this->intraship_zip}',
      intraship_country='{$this->intraship_country}',
      intraship_city='{$this->intraship_city}',
      intraship_email='{$this->intraship_email}',
      intraship_phone='{$this->intraship_phone}',
      intraship_internet='{$this->intraship_internet}',
      intraship_contact_person='{$this->intraship_contact_person}',
      intraship_account_owner='{$this->intraship_account_owner}',
      intraship_account_number='{$this->intraship_account_number}',
      intraship_bank_code='{$this->intraship_bank_code}',
      intraship_bank_name='{$this->intraship_bank_name}',
      intraship_iban='{$this->intraship_iban}',
      intraship_bic='{$this->intraship_bic}',
      intraship_WeightInKG='{$this->intraship_WeightInKG}',
      intraship_LengthInCM='{$this->intraship_LengthInCM}',
      intraship_WidthInCM='{$this->intraship_WidthInCM}',
      intraship_HeightInCM='{$this->intraship_HeightInCM}',
      intraship_PackageType='{$this->intraship_PackageType}',
      abrechnungsart='{$this->abrechnungsart}',
      kommissionierverfahren='{$this->kommissionierverfahren}',
      wechselaufeinstufig='{$this->wechselaufeinstufig}',
      projektuebergreifendkommisionieren='{$this->projektuebergreifendkommisionieren}',
      absendeadresse='{$this->absendeadresse}',
      absendename='{$this->absendename}',
      absendesignatur='{$this->absendesignatur}',
      autodruckrechnung='{$this->autodruckrechnung}',
      autodruckversandbestaetigung='{$this->autodruckversandbestaetigung}',
      automailversandbestaetigung='{$this->automailversandbestaetigung}',
      autodrucklieferschein='{$this->autodrucklieferschein}',
      automaillieferschein='{$this->automaillieferschein}',
      autodruckstorno='{$this->autodruckstorno}',
      autodruckanhang='{$this->autodruckanhang}',
      automailanhang='{$this->automailanhang}',
      autodruckerrechnung='{$this->autodruckerrechnung}',
      autodruckerlieferschein='{$this->autodruckerlieferschein}',
      autodruckeranhang='{$this->autodruckeranhang}',
      autodruckrechnungmenge='{$this->autodruckrechnungmenge}',
      autodrucklieferscheinmenge='{$this->autodrucklieferscheinmenge}',
      eigenernummernkreis='{$this->eigenernummernkreis}',
      next_angebot='{$this->next_angebot}',
      next_auftrag='{$this->next_auftrag}',
      next_rechnung='{$this->next_rechnung}',
      next_lieferschein='{$this->next_lieferschein}',
      next_arbeitsnachweis='{$this->next_arbeitsnachweis}',
      next_reisekosten='{$this->next_reisekosten}',
      next_bestellung='{$this->next_bestellung}',
      next_gutschrift='{$this->next_gutschrift}',
      next_kundennummer='{$this->next_kundennummer}',
      next_lieferantennummer='{$this->next_lieferantennummer}',
      next_mitarbeiternummer='{$this->next_mitarbeiternummer}',
      next_waren='{$this->next_waren}',
      next_produktion='{$this->next_produktion}',
      next_sonstiges='{$this->next_sonstiges}',
      next_anfrage='{$this->next_anfrage}',
      next_artikelnummer='{$this->next_artikelnummer}',
      gesamtstunden_max='{$this->gesamtstunden_max}',
      auftragid='{$this->auftragid}',
      dhlzahlungmandant='{$this->dhlzahlungmandant}',
      dhlretourenschein='{$this->dhlretourenschein}',
      land='{$this->land}',
      etiketten_positionen='{$this->etiketten_positionen}',
      etiketten_drucker='{$this->etiketten_drucker}',
      etiketten_art='{$this->etiketten_art}',
      seriennummernerfassen='{$this->seriennummernerfassen}',
      versandzweigeteilt='{$this->versandzweigeteilt}',
      nachnahmecheck='{$this->nachnahmecheck}',
      kasse_lieferschein_anlegen='{$this->kasse_lieferschein_anlegen}',
      kasse_lagerprozess='{$this->kasse_lagerprozess}',
      kasse_belegausgabe='{$this->kasse_belegausgabe}',
      kasse_preisgruppe='{$this->kasse_preisgruppe}',
      kasse_text_bemerkung='{$this->kasse_text_bemerkung}',
      kasse_text_freitext='{$this->kasse_text_freitext}',
      kasse_drucker='{$this->kasse_drucker}',
      kasse_lieferschein='{$this->kasse_lieferschein}',
      kasse_rechnung='{$this->kasse_rechnung}',
      kasse_lieferschein_doppel='{$this->kasse_lieferschein_doppel}',
      kasse_lager='{$this->kasse_lager}',
      kasse_konto='{$this->kasse_konto}',
      kasse_laufkundschaft='{$this->kasse_laufkundschaft}',
      kasse_rabatt_artikel='{$this->kasse_rabatt_artikel}',
      kasse_zahlung_bar='{$this->kasse_zahlung_bar}',
      kasse_zahlung_ec='{$this->kasse_zahlung_ec}',
      kasse_zahlung_kreditkarte='{$this->kasse_zahlung_kreditkarte}',
      kasse_zahlung_ueberweisung='{$this->kasse_zahlung_ueberweisung}',
      kasse_zahlung_paypal='{$this->kasse_zahlung_paypal}',
      kasse_extra_keinbeleg='{$this->kasse_extra_keinbeleg}',
      kasse_extra_rechnung='{$this->kasse_extra_rechnung}',
      kasse_extra_quittung='{$this->kasse_extra_quittung}',
      kasse_extra_gutschein='{$this->kasse_extra_gutschein}',
      kasse_extra_rabatt_prozent='{$this->kasse_extra_rabatt_prozent}',
      kasse_extra_rabatt_euro='{$this->kasse_extra_rabatt_euro}',
      kasse_adresse_erweitert='{$this->kasse_adresse_erweitert}',
      kasse_zahlungsauswahl_zwang='{$this->kasse_zahlungsauswahl_zwang}',
      kasse_button_entnahme='{$this->kasse_button_entnahme}',
      kasse_button_trinkgeld='{$this->kasse_button_trinkgeld}',
      kasse_vorauswahl_anrede='{$this->kasse_vorauswahl_anrede}',
      kasse_erweiterte_lagerabfrage='{$this->kasse_erweiterte_lagerabfrage}',
      filialadresse='{$this->filialadresse}',
      versandprojektfiliale='{$this->versandprojektfiliale}',
      differenz_auslieferung_tage='{$this->differenz_auslieferung_tage}',
      autostuecklistenanpassung='{$this->autostuecklistenanpassung}',
      dpdendung='{$this->dpdendung}',
      dhlendung='{$this->dhlendung}',
      tracking_substr_start='{$this->tracking_substr_start}',
      tracking_remove_kundennummer='{$this->tracking_remove_kundennummer}',
      tracking_substr_length='{$this->tracking_substr_length}',
      go_drucker='{$this->go_drucker}',
      go_apiurl_prefix='{$this->go_apiurl_prefix}',
      go_apiurl_postfix='{$this->go_apiurl_postfix}',
      go_apiurl_user='{$this->go_apiurl_user}',
      go_username='{$this->go_username}',
      go_password='{$this->go_password}',
      go_ax4nr='{$this->go_ax4nr}',
      go_name1='{$this->go_name1}',
      go_name2='{$this->go_name2}',
      go_abteilung='{$this->go_abteilung}',
      go_strasse1='{$this->go_strasse1}',
      go_strasse2='{$this->go_strasse2}',
      go_hausnummer='{$this->go_hausnummer}',
      go_plz='{$this->go_plz}',
      go_ort='{$this->go_ort}',
      go_land='{$this->go_land}',
      go_standardgewicht='{$this->go_standardgewicht}',
      go_format='{$this->go_format}',
      go_ausgabe='{$this->go_ausgabe}',
      intraship_exportgrund='{$this->intraship_exportgrund}',
      billsafe_merchantId='{$this->billsafe_merchantId}',
      billsafe_merchantLicenseSandbox='{$this->billsafe_merchantLicenseSandbox}',
      billsafe_merchantLicenseLive='{$this->billsafe_merchantLicenseLive}',
      billsafe_applicationSignature='{$this->billsafe_applicationSignature}',
      billsafe_applicationVersion='{$this->billsafe_applicationVersion}',
      secupay_apikey='{$this->secupay_apikey}',
      secupay_url='{$this->secupay_url}',
      secupay_demo='{$this->secupay_demo}',
      kasse_zahlung_bar_bezahlt='{$this->kasse_zahlung_bar_bezahlt}',
      kasse_zahlung_ec_bezahlt='{$this->kasse_zahlung_ec_bezahlt}',
      kasse_zahlung_kreditkarte_bezahlt='{$this->kasse_zahlung_kreditkarte_bezahlt}',
      kasse_zahlung_ueberweisung_bezahlt='{$this->kasse_zahlung_ueberweisung_bezahlt}',
      kasse_zahlung_paypal_bezahlt='{$this->kasse_zahlung_paypal_bezahlt}'
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

    $sql = "DELETE FROM projekt WHERE (id='{$this->id}')";
    $this->app->DB->Delete($sql);

    $this->id="";
    $this->name="";
    $this->abkuerzung="";
    $this->verantwortlicher="";
    $this->beschreibung="";
    $this->sonstiges="";
    $this->aktiv="";
    $this->farbe="";
    $this->autoversand="";
    $this->checkok="";
    $this->portocheck="";
    $this->automailrechnung="";
    $this->checkname="";
    $this->zahlungserinnerung="";
    $this->zahlungsmailbedinungen="";
    $this->folgebestaetigung="";
    $this->stornomail="";
    $this->kundenfreigabe_loeschen="";
    $this->autobestellung="";
    $this->speziallieferschein="";
    $this->lieferscheinbriefpapier="";
    $this->speziallieferscheinbeschriftung="";
    $this->firma="";
    $this->geloescht="";
    $this->logdatei="";
    $this->steuersatz_normal="";
    $this->steuersatz_zwischen="";
    $this->steuersatz_ermaessigt="";
    $this->steuersatz_starkermaessigt="";
    $this->steuersatz_dienstleistung="";
    $this->waehrung="";
    $this->eigenesteuer="";
    $this->druckerlogistikstufe1="";
    $this->druckerlogistikstufe2="";
    $this->selbstabholermail="";
    $this->eanherstellerscan="";
    $this->reservierung="";
    $this->verkaufszahlendiagram="";
    $this->oeffentlich="";
    $this->shopzwangsprojekt="";
    $this->kunde="";
    $this->dpdkundennr="";
    $this->dhlkundennr="";
    $this->dhlformat="";
    $this->dpdformat="";
    $this->paketmarke_einzeldatei="";
    $this->dpdpfad="";
    $this->dhlpfad="";
    $this->upspfad="";
    $this->dhlintodb="";
    $this->intraship_enabled="";
    $this->intraship_drucker="";
    $this->intraship_testmode="";
    $this->intraship_user="";
    $this->intraship_signature="";
    $this->intraship_ekp="";
    $this->intraship_api_user="";
    $this->intraship_api_password="";
    $this->intraship_company_name="";
    $this->intraship_street_name="";
    $this->intraship_street_number="";
    $this->intraship_zip="";
    $this->intraship_country="";
    $this->intraship_city="";
    $this->intraship_email="";
    $this->intraship_phone="";
    $this->intraship_internet="";
    $this->intraship_contact_person="";
    $this->intraship_account_owner="";
    $this->intraship_account_number="";
    $this->intraship_bank_code="";
    $this->intraship_bank_name="";
    $this->intraship_iban="";
    $this->intraship_bic="";
    $this->intraship_WeightInKG="";
    $this->intraship_LengthInCM="";
    $this->intraship_WidthInCM="";
    $this->intraship_HeightInCM="";
    $this->intraship_PackageType="";
    $this->abrechnungsart="";
    $this->kommissionierverfahren="";
    $this->wechselaufeinstufig="";
    $this->projektuebergreifendkommisionieren="";
    $this->absendeadresse="";
    $this->absendename="";
    $this->absendesignatur="";
    $this->autodruckrechnung="";
    $this->autodruckversandbestaetigung="";
    $this->automailversandbestaetigung="";
    $this->autodrucklieferschein="";
    $this->automaillieferschein="";
    $this->autodruckstorno="";
    $this->autodruckanhang="";
    $this->automailanhang="";
    $this->autodruckerrechnung="";
    $this->autodruckerlieferschein="";
    $this->autodruckeranhang="";
    $this->autodruckrechnungmenge="";
    $this->autodrucklieferscheinmenge="";
    $this->eigenernummernkreis="";
    $this->next_angebot="";
    $this->next_auftrag="";
    $this->next_rechnung="";
    $this->next_lieferschein="";
    $this->next_arbeitsnachweis="";
    $this->next_reisekosten="";
    $this->next_bestellung="";
    $this->next_gutschrift="";
    $this->next_kundennummer="";
    $this->next_lieferantennummer="";
    $this->next_mitarbeiternummer="";
    $this->next_waren="";
    $this->next_produktion="";
    $this->next_sonstiges="";
    $this->next_anfrage="";
    $this->next_artikelnummer="";
    $this->gesamtstunden_max="";
    $this->auftragid="";
    $this->dhlzahlungmandant="";
    $this->dhlretourenschein="";
    $this->land="";
    $this->etiketten_positionen="";
    $this->etiketten_drucker="";
    $this->etiketten_art="";
    $this->seriennummernerfassen="";
    $this->versandzweigeteilt="";
    $this->nachnahmecheck="";
    $this->kasse_lieferschein_anlegen="";
    $this->kasse_lagerprozess="";
    $this->kasse_belegausgabe="";
    $this->kasse_preisgruppe="";
    $this->kasse_text_bemerkung="";
    $this->kasse_text_freitext="";
    $this->kasse_drucker="";
    $this->kasse_lieferschein="";
    $this->kasse_rechnung="";
    $this->kasse_lieferschein_doppel="";
    $this->kasse_lager="";
    $this->kasse_konto="";
    $this->kasse_laufkundschaft="";
    $this->kasse_rabatt_artikel="";
    $this->kasse_zahlung_bar="";
    $this->kasse_zahlung_ec="";
    $this->kasse_zahlung_kreditkarte="";
    $this->kasse_zahlung_ueberweisung="";
    $this->kasse_zahlung_paypal="";
    $this->kasse_extra_keinbeleg="";
    $this->kasse_extra_rechnung="";
    $this->kasse_extra_quittung="";
    $this->kasse_extra_gutschein="";
    $this->kasse_extra_rabatt_prozent="";
    $this->kasse_extra_rabatt_euro="";
    $this->kasse_adresse_erweitert="";
    $this->kasse_zahlungsauswahl_zwang="";
    $this->kasse_button_entnahme="";
    $this->kasse_button_trinkgeld="";
    $this->kasse_vorauswahl_anrede="";
    $this->kasse_erweiterte_lagerabfrage="";
    $this->filialadresse="";
    $this->versandprojektfiliale="";
    $this->differenz_auslieferung_tage="";
    $this->autostuecklistenanpassung="";
    $this->dpdendung="";
    $this->dhlendung="";
    $this->tracking_substr_start="";
    $this->tracking_remove_kundennummer="";
    $this->tracking_substr_length="";
    $this->go_drucker="";
    $this->go_apiurl_prefix="";
    $this->go_apiurl_postfix="";
    $this->go_apiurl_user="";
    $this->go_username="";
    $this->go_password="";
    $this->go_ax4nr="";
    $this->go_name1="";
    $this->go_name2="";
    $this->go_abteilung="";
    $this->go_strasse1="";
    $this->go_strasse2="";
    $this->go_hausnummer="";
    $this->go_plz="";
    $this->go_ort="";
    $this->go_land="";
    $this->go_standardgewicht="";
    $this->go_format="";
    $this->go_ausgabe="";
    $this->intraship_exportgrund="";
    $this->billsafe_merchantId="";
    $this->billsafe_merchantLicenseSandbox="";
    $this->billsafe_merchantLicenseLive="";
    $this->billsafe_applicationSignature="";
    $this->billsafe_applicationVersion="";
    $this->secupay_apikey="";
    $this->secupay_url="";
    $this->secupay_demo="";
    $this->kasse_zahlung_bar_bezahlt="";
    $this->kasse_zahlung_ec_bezahlt="";
    $this->kasse_zahlung_kreditkarte_bezahlt="";
    $this->kasse_zahlung_ueberweisung_bezahlt="";
    $this->kasse_zahlung_paypal_bezahlt="";
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
  function SetName($value) { $this->name=$value; }
  function GetName() { return $this->name; }
  function SetAbkuerzung($value) { $this->abkuerzung=$value; }
  function GetAbkuerzung() { return $this->abkuerzung; }
  function SetVerantwortlicher($value) { $this->verantwortlicher=$value; }
  function GetVerantwortlicher() { return $this->verantwortlicher; }
  function SetBeschreibung($value) { $this->beschreibung=$value; }
  function GetBeschreibung() { return $this->beschreibung; }
  function SetSonstiges($value) { $this->sonstiges=$value; }
  function GetSonstiges() { return $this->sonstiges; }
  function SetAktiv($value) { $this->aktiv=$value; }
  function GetAktiv() { return $this->aktiv; }
  function SetFarbe($value) { $this->farbe=$value; }
  function GetFarbe() { return $this->farbe; }
  function SetAutoversand($value) { $this->autoversand=$value; }
  function GetAutoversand() { return $this->autoversand; }
  function SetCheckok($value) { $this->checkok=$value; }
  function GetCheckok() { return $this->checkok; }
  function SetPortocheck($value) { $this->portocheck=$value; }
  function GetPortocheck() { return $this->portocheck; }
  function SetAutomailrechnung($value) { $this->automailrechnung=$value; }
  function GetAutomailrechnung() { return $this->automailrechnung; }
  function SetCheckname($value) { $this->checkname=$value; }
  function GetCheckname() { return $this->checkname; }
  function SetZahlungserinnerung($value) { $this->zahlungserinnerung=$value; }
  function GetZahlungserinnerung() { return $this->zahlungserinnerung; }
  function SetZahlungsmailbedinungen($value) { $this->zahlungsmailbedinungen=$value; }
  function GetZahlungsmailbedinungen() { return $this->zahlungsmailbedinungen; }
  function SetFolgebestaetigung($value) { $this->folgebestaetigung=$value; }
  function GetFolgebestaetigung() { return $this->folgebestaetigung; }
  function SetStornomail($value) { $this->stornomail=$value; }
  function GetStornomail() { return $this->stornomail; }
  function SetKundenfreigabe_Loeschen($value) { $this->kundenfreigabe_loeschen=$value; }
  function GetKundenfreigabe_Loeschen() { return $this->kundenfreigabe_loeschen; }
  function SetAutobestellung($value) { $this->autobestellung=$value; }
  function GetAutobestellung() { return $this->autobestellung; }
  function SetSpeziallieferschein($value) { $this->speziallieferschein=$value; }
  function GetSpeziallieferschein() { return $this->speziallieferschein; }
  function SetLieferscheinbriefpapier($value) { $this->lieferscheinbriefpapier=$value; }
  function GetLieferscheinbriefpapier() { return $this->lieferscheinbriefpapier; }
  function SetSpeziallieferscheinbeschriftung($value) { $this->speziallieferscheinbeschriftung=$value; }
  function GetSpeziallieferscheinbeschriftung() { return $this->speziallieferscheinbeschriftung; }
  function SetFirma($value) { $this->firma=$value; }
  function GetFirma() { return $this->firma; }
  function SetGeloescht($value) { $this->geloescht=$value; }
  function GetGeloescht() { return $this->geloescht; }
  function SetLogdatei($value) { $this->logdatei=$value; }
  function GetLogdatei() { return $this->logdatei; }
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
  function SetEigenesteuer($value) { $this->eigenesteuer=$value; }
  function GetEigenesteuer() { return $this->eigenesteuer; }
  function SetDruckerlogistikstufe1($value) { $this->druckerlogistikstufe1=$value; }
  function GetDruckerlogistikstufe1() { return $this->druckerlogistikstufe1; }
  function SetDruckerlogistikstufe2($value) { $this->druckerlogistikstufe2=$value; }
  function GetDruckerlogistikstufe2() { return $this->druckerlogistikstufe2; }
  function SetSelbstabholermail($value) { $this->selbstabholermail=$value; }
  function GetSelbstabholermail() { return $this->selbstabholermail; }
  function SetEanherstellerscan($value) { $this->eanherstellerscan=$value; }
  function GetEanherstellerscan() { return $this->eanherstellerscan; }
  function SetReservierung($value) { $this->reservierung=$value; }
  function GetReservierung() { return $this->reservierung; }
  function SetVerkaufszahlendiagram($value) { $this->verkaufszahlendiagram=$value; }
  function GetVerkaufszahlendiagram() { return $this->verkaufszahlendiagram; }
  function SetOeffentlich($value) { $this->oeffentlich=$value; }
  function GetOeffentlich() { return $this->oeffentlich; }
  function SetShopzwangsprojekt($value) { $this->shopzwangsprojekt=$value; }
  function GetShopzwangsprojekt() { return $this->shopzwangsprojekt; }
  function SetKunde($value) { $this->kunde=$value; }
  function GetKunde() { return $this->kunde; }
  function SetDpdkundennr($value) { $this->dpdkundennr=$value; }
  function GetDpdkundennr() { return $this->dpdkundennr; }
  function SetDhlkundennr($value) { $this->dhlkundennr=$value; }
  function GetDhlkundennr() { return $this->dhlkundennr; }
  function SetDhlformat($value) { $this->dhlformat=$value; }
  function GetDhlformat() { return $this->dhlformat; }
  function SetDpdformat($value) { $this->dpdformat=$value; }
  function GetDpdformat() { return $this->dpdformat; }
  function SetPaketmarke_Einzeldatei($value) { $this->paketmarke_einzeldatei=$value; }
  function GetPaketmarke_Einzeldatei() { return $this->paketmarke_einzeldatei; }
  function SetDpdpfad($value) { $this->dpdpfad=$value; }
  function GetDpdpfad() { return $this->dpdpfad; }
  function SetDhlpfad($value) { $this->dhlpfad=$value; }
  function GetDhlpfad() { return $this->dhlpfad; }
  function SetUpspfad($value) { $this->upspfad=$value; }
  function GetUpspfad() { return $this->upspfad; }
  function SetDhlintodb($value) { $this->dhlintodb=$value; }
  function GetDhlintodb() { return $this->dhlintodb; }
  function SetIntraship_Enabled($value) { $this->intraship_enabled=$value; }
  function GetIntraship_Enabled() { return $this->intraship_enabled; }
  function SetIntraship_Drucker($value) { $this->intraship_drucker=$value; }
  function GetIntraship_Drucker() { return $this->intraship_drucker; }
  function SetIntraship_Testmode($value) { $this->intraship_testmode=$value; }
  function GetIntraship_Testmode() { return $this->intraship_testmode; }
  function SetIntraship_User($value) { $this->intraship_user=$value; }
  function GetIntraship_User() { return $this->intraship_user; }
  function SetIntraship_Signature($value) { $this->intraship_signature=$value; }
  function GetIntraship_Signature() { return $this->intraship_signature; }
  function SetIntraship_Ekp($value) { $this->intraship_ekp=$value; }
  function GetIntraship_Ekp() { return $this->intraship_ekp; }
  function SetIntraship_Api_User($value) { $this->intraship_api_user=$value; }
  function GetIntraship_Api_User() { return $this->intraship_api_user; }
  function SetIntraship_Api_Password($value) { $this->intraship_api_password=$value; }
  function GetIntraship_Api_Password() { return $this->intraship_api_password; }
  function SetIntraship_Company_Name($value) { $this->intraship_company_name=$value; }
  function GetIntraship_Company_Name() { return $this->intraship_company_name; }
  function SetIntraship_Street_Name($value) { $this->intraship_street_name=$value; }
  function GetIntraship_Street_Name() { return $this->intraship_street_name; }
  function SetIntraship_Street_Number($value) { $this->intraship_street_number=$value; }
  function GetIntraship_Street_Number() { return $this->intraship_street_number; }
  function SetIntraship_Zip($value) { $this->intraship_zip=$value; }
  function GetIntraship_Zip() { return $this->intraship_zip; }
  function SetIntraship_Country($value) { $this->intraship_country=$value; }
  function GetIntraship_Country() { return $this->intraship_country; }
  function SetIntraship_City($value) { $this->intraship_city=$value; }
  function GetIntraship_City() { return $this->intraship_city; }
  function SetIntraship_Email($value) { $this->intraship_email=$value; }
  function GetIntraship_Email() { return $this->intraship_email; }
  function SetIntraship_Phone($value) { $this->intraship_phone=$value; }
  function GetIntraship_Phone() { return $this->intraship_phone; }
  function SetIntraship_Internet($value) { $this->intraship_internet=$value; }
  function GetIntraship_Internet() { return $this->intraship_internet; }
  function SetIntraship_Contact_Person($value) { $this->intraship_contact_person=$value; }
  function GetIntraship_Contact_Person() { return $this->intraship_contact_person; }
  function SetIntraship_Account_Owner($value) { $this->intraship_account_owner=$value; }
  function GetIntraship_Account_Owner() { return $this->intraship_account_owner; }
  function SetIntraship_Account_Number($value) { $this->intraship_account_number=$value; }
  function GetIntraship_Account_Number() { return $this->intraship_account_number; }
  function SetIntraship_Bank_Code($value) { $this->intraship_bank_code=$value; }
  function GetIntraship_Bank_Code() { return $this->intraship_bank_code; }
  function SetIntraship_Bank_Name($value) { $this->intraship_bank_name=$value; }
  function GetIntraship_Bank_Name() { return $this->intraship_bank_name; }
  function SetIntraship_Iban($value) { $this->intraship_iban=$value; }
  function GetIntraship_Iban() { return $this->intraship_iban; }
  function SetIntraship_Bic($value) { $this->intraship_bic=$value; }
  function GetIntraship_Bic() { return $this->intraship_bic; }
  function SetIntraship_Weightinkg($value) { $this->intraship_WeightInKG=$value; }
  function GetIntraship_Weightinkg() { return $this->intraship_WeightInKG; }
  function SetIntraship_Lengthincm($value) { $this->intraship_LengthInCM=$value; }
  function GetIntraship_Lengthincm() { return $this->intraship_LengthInCM; }
  function SetIntraship_Widthincm($value) { $this->intraship_WidthInCM=$value; }
  function GetIntraship_Widthincm() { return $this->intraship_WidthInCM; }
  function SetIntraship_Heightincm($value) { $this->intraship_HeightInCM=$value; }
  function GetIntraship_Heightincm() { return $this->intraship_HeightInCM; }
  function SetIntraship_Packagetype($value) { $this->intraship_PackageType=$value; }
  function GetIntraship_Packagetype() { return $this->intraship_PackageType; }
  function SetAbrechnungsart($value) { $this->abrechnungsart=$value; }
  function GetAbrechnungsart() { return $this->abrechnungsart; }
  function SetKommissionierverfahren($value) { $this->kommissionierverfahren=$value; }
  function GetKommissionierverfahren() { return $this->kommissionierverfahren; }
  function SetWechselaufeinstufig($value) { $this->wechselaufeinstufig=$value; }
  function GetWechselaufeinstufig() { return $this->wechselaufeinstufig; }
  function SetProjektuebergreifendkommisionieren($value) { $this->projektuebergreifendkommisionieren=$value; }
  function GetProjektuebergreifendkommisionieren() { return $this->projektuebergreifendkommisionieren; }
  function SetAbsendeadresse($value) { $this->absendeadresse=$value; }
  function GetAbsendeadresse() { return $this->absendeadresse; }
  function SetAbsendename($value) { $this->absendename=$value; }
  function GetAbsendename() { return $this->absendename; }
  function SetAbsendesignatur($value) { $this->absendesignatur=$value; }
  function GetAbsendesignatur() { return $this->absendesignatur; }
  function SetAutodruckrechnung($value) { $this->autodruckrechnung=$value; }
  function GetAutodruckrechnung() { return $this->autodruckrechnung; }
  function SetAutodruckversandbestaetigung($value) { $this->autodruckversandbestaetigung=$value; }
  function GetAutodruckversandbestaetigung() { return $this->autodruckversandbestaetigung; }
  function SetAutomailversandbestaetigung($value) { $this->automailversandbestaetigung=$value; }
  function GetAutomailversandbestaetigung() { return $this->automailversandbestaetigung; }
  function SetAutodrucklieferschein($value) { $this->autodrucklieferschein=$value; }
  function GetAutodrucklieferschein() { return $this->autodrucklieferschein; }
  function SetAutomaillieferschein($value) { $this->automaillieferschein=$value; }
  function GetAutomaillieferschein() { return $this->automaillieferschein; }
  function SetAutodruckstorno($value) { $this->autodruckstorno=$value; }
  function GetAutodruckstorno() { return $this->autodruckstorno; }
  function SetAutodruckanhang($value) { $this->autodruckanhang=$value; }
  function GetAutodruckanhang() { return $this->autodruckanhang; }
  function SetAutomailanhang($value) { $this->automailanhang=$value; }
  function GetAutomailanhang() { return $this->automailanhang; }
  function SetAutodruckerrechnung($value) { $this->autodruckerrechnung=$value; }
  function GetAutodruckerrechnung() { return $this->autodruckerrechnung; }
  function SetAutodruckerlieferschein($value) { $this->autodruckerlieferschein=$value; }
  function GetAutodruckerlieferschein() { return $this->autodruckerlieferschein; }
  function SetAutodruckeranhang($value) { $this->autodruckeranhang=$value; }
  function GetAutodruckeranhang() { return $this->autodruckeranhang; }
  function SetAutodruckrechnungmenge($value) { $this->autodruckrechnungmenge=$value; }
  function GetAutodruckrechnungmenge() { return $this->autodruckrechnungmenge; }
  function SetAutodrucklieferscheinmenge($value) { $this->autodrucklieferscheinmenge=$value; }
  function GetAutodrucklieferscheinmenge() { return $this->autodrucklieferscheinmenge; }
  function SetEigenernummernkreis($value) { $this->eigenernummernkreis=$value; }
  function GetEigenernummernkreis() { return $this->eigenernummernkreis; }
  function SetNext_Angebot($value) { $this->next_angebot=$value; }
  function GetNext_Angebot() { return $this->next_angebot; }
  function SetNext_Auftrag($value) { $this->next_auftrag=$value; }
  function GetNext_Auftrag() { return $this->next_auftrag; }
  function SetNext_Rechnung($value) { $this->next_rechnung=$value; }
  function GetNext_Rechnung() { return $this->next_rechnung; }
  function SetNext_Lieferschein($value) { $this->next_lieferschein=$value; }
  function GetNext_Lieferschein() { return $this->next_lieferschein; }
  function SetNext_Arbeitsnachweis($value) { $this->next_arbeitsnachweis=$value; }
  function GetNext_Arbeitsnachweis() { return $this->next_arbeitsnachweis; }
  function SetNext_Reisekosten($value) { $this->next_reisekosten=$value; }
  function GetNext_Reisekosten() { return $this->next_reisekosten; }
  function SetNext_Bestellung($value) { $this->next_bestellung=$value; }
  function GetNext_Bestellung() { return $this->next_bestellung; }
  function SetNext_Gutschrift($value) { $this->next_gutschrift=$value; }
  function GetNext_Gutschrift() { return $this->next_gutschrift; }
  function SetNext_Kundennummer($value) { $this->next_kundennummer=$value; }
  function GetNext_Kundennummer() { return $this->next_kundennummer; }
  function SetNext_Lieferantennummer($value) { $this->next_lieferantennummer=$value; }
  function GetNext_Lieferantennummer() { return $this->next_lieferantennummer; }
  function SetNext_Mitarbeiternummer($value) { $this->next_mitarbeiternummer=$value; }
  function GetNext_Mitarbeiternummer() { return $this->next_mitarbeiternummer; }
  function SetNext_Waren($value) { $this->next_waren=$value; }
  function GetNext_Waren() { return $this->next_waren; }
  function SetNext_Produktion($value) { $this->next_produktion=$value; }
  function GetNext_Produktion() { return $this->next_produktion; }
  function SetNext_Sonstiges($value) { $this->next_sonstiges=$value; }
  function GetNext_Sonstiges() { return $this->next_sonstiges; }
  function SetNext_Anfrage($value) { $this->next_anfrage=$value; }
  function GetNext_Anfrage() { return $this->next_anfrage; }
  function SetNext_Artikelnummer($value) { $this->next_artikelnummer=$value; }
  function GetNext_Artikelnummer() { return $this->next_artikelnummer; }
  function SetGesamtstunden_Max($value) { $this->gesamtstunden_max=$value; }
  function GetGesamtstunden_Max() { return $this->gesamtstunden_max; }
  function SetAuftragid($value) { $this->auftragid=$value; }
  function GetAuftragid() { return $this->auftragid; }
  function SetDhlzahlungmandant($value) { $this->dhlzahlungmandant=$value; }
  function GetDhlzahlungmandant() { return $this->dhlzahlungmandant; }
  function SetDhlretourenschein($value) { $this->dhlretourenschein=$value; }
  function GetDhlretourenschein() { return $this->dhlretourenschein; }
  function SetLand($value) { $this->land=$value; }
  function GetLand() { return $this->land; }
  function SetEtiketten_Positionen($value) { $this->etiketten_positionen=$value; }
  function GetEtiketten_Positionen() { return $this->etiketten_positionen; }
  function SetEtiketten_Drucker($value) { $this->etiketten_drucker=$value; }
  function GetEtiketten_Drucker() { return $this->etiketten_drucker; }
  function SetEtiketten_Art($value) { $this->etiketten_art=$value; }
  function GetEtiketten_Art() { return $this->etiketten_art; }
  function SetSeriennummernerfassen($value) { $this->seriennummernerfassen=$value; }
  function GetSeriennummernerfassen() { return $this->seriennummernerfassen; }
  function SetVersandzweigeteilt($value) { $this->versandzweigeteilt=$value; }
  function GetVersandzweigeteilt() { return $this->versandzweigeteilt; }
  function SetNachnahmecheck($value) { $this->nachnahmecheck=$value; }
  function GetNachnahmecheck() { return $this->nachnahmecheck; }
  function SetKasse_Lieferschein_Anlegen($value) { $this->kasse_lieferschein_anlegen=$value; }
  function GetKasse_Lieferschein_Anlegen() { return $this->kasse_lieferschein_anlegen; }
  function SetKasse_Lagerprozess($value) { $this->kasse_lagerprozess=$value; }
  function GetKasse_Lagerprozess() { return $this->kasse_lagerprozess; }
  function SetKasse_Belegausgabe($value) { $this->kasse_belegausgabe=$value; }
  function GetKasse_Belegausgabe() { return $this->kasse_belegausgabe; }
  function SetKasse_Preisgruppe($value) { $this->kasse_preisgruppe=$value; }
  function GetKasse_Preisgruppe() { return $this->kasse_preisgruppe; }
  function SetKasse_Text_Bemerkung($value) { $this->kasse_text_bemerkung=$value; }
  function GetKasse_Text_Bemerkung() { return $this->kasse_text_bemerkung; }
  function SetKasse_Text_Freitext($value) { $this->kasse_text_freitext=$value; }
  function GetKasse_Text_Freitext() { return $this->kasse_text_freitext; }
  function SetKasse_Drucker($value) { $this->kasse_drucker=$value; }
  function GetKasse_Drucker() { return $this->kasse_drucker; }
  function SetKasse_Lieferschein($value) { $this->kasse_lieferschein=$value; }
  function GetKasse_Lieferschein() { return $this->kasse_lieferschein; }
  function SetKasse_Rechnung($value) { $this->kasse_rechnung=$value; }
  function GetKasse_Rechnung() { return $this->kasse_rechnung; }
  function SetKasse_Lieferschein_Doppel($value) { $this->kasse_lieferschein_doppel=$value; }
  function GetKasse_Lieferschein_Doppel() { return $this->kasse_lieferschein_doppel; }
  function SetKasse_Lager($value) { $this->kasse_lager=$value; }
  function GetKasse_Lager() { return $this->kasse_lager; }
  function SetKasse_Konto($value) { $this->kasse_konto=$value; }
  function GetKasse_Konto() { return $this->kasse_konto; }
  function SetKasse_Laufkundschaft($value) { $this->kasse_laufkundschaft=$value; }
  function GetKasse_Laufkundschaft() { return $this->kasse_laufkundschaft; }
  function SetKasse_Rabatt_Artikel($value) { $this->kasse_rabatt_artikel=$value; }
  function GetKasse_Rabatt_Artikel() { return $this->kasse_rabatt_artikel; }
  function SetKasse_Zahlung_Bar($value) { $this->kasse_zahlung_bar=$value; }
  function GetKasse_Zahlung_Bar() { return $this->kasse_zahlung_bar; }
  function SetKasse_Zahlung_Ec($value) { $this->kasse_zahlung_ec=$value; }
  function GetKasse_Zahlung_Ec() { return $this->kasse_zahlung_ec; }
  function SetKasse_Zahlung_Kreditkarte($value) { $this->kasse_zahlung_kreditkarte=$value; }
  function GetKasse_Zahlung_Kreditkarte() { return $this->kasse_zahlung_kreditkarte; }
  function SetKasse_Zahlung_Ueberweisung($value) { $this->kasse_zahlung_ueberweisung=$value; }
  function GetKasse_Zahlung_Ueberweisung() { return $this->kasse_zahlung_ueberweisung; }
  function SetKasse_Zahlung_Paypal($value) { $this->kasse_zahlung_paypal=$value; }
  function GetKasse_Zahlung_Paypal() { return $this->kasse_zahlung_paypal; }
  function SetKasse_Extra_Keinbeleg($value) { $this->kasse_extra_keinbeleg=$value; }
  function GetKasse_Extra_Keinbeleg() { return $this->kasse_extra_keinbeleg; }
  function SetKasse_Extra_Rechnung($value) { $this->kasse_extra_rechnung=$value; }
  function GetKasse_Extra_Rechnung() { return $this->kasse_extra_rechnung; }
  function SetKasse_Extra_Quittung($value) { $this->kasse_extra_quittung=$value; }
  function GetKasse_Extra_Quittung() { return $this->kasse_extra_quittung; }
  function SetKasse_Extra_Gutschein($value) { $this->kasse_extra_gutschein=$value; }
  function GetKasse_Extra_Gutschein() { return $this->kasse_extra_gutschein; }
  function SetKasse_Extra_Rabatt_Prozent($value) { $this->kasse_extra_rabatt_prozent=$value; }
  function GetKasse_Extra_Rabatt_Prozent() { return $this->kasse_extra_rabatt_prozent; }
  function SetKasse_Extra_Rabatt_Euro($value) { $this->kasse_extra_rabatt_euro=$value; }
  function GetKasse_Extra_Rabatt_Euro() { return $this->kasse_extra_rabatt_euro; }
  function SetKasse_Adresse_Erweitert($value) { $this->kasse_adresse_erweitert=$value; }
  function GetKasse_Adresse_Erweitert() { return $this->kasse_adresse_erweitert; }
  function SetKasse_Zahlungsauswahl_Zwang($value) { $this->kasse_zahlungsauswahl_zwang=$value; }
  function GetKasse_Zahlungsauswahl_Zwang() { return $this->kasse_zahlungsauswahl_zwang; }
  function SetKasse_Button_Entnahme($value) { $this->kasse_button_entnahme=$value; }
  function GetKasse_Button_Entnahme() { return $this->kasse_button_entnahme; }
  function SetKasse_Button_Trinkgeld($value) { $this->kasse_button_trinkgeld=$value; }
  function GetKasse_Button_Trinkgeld() { return $this->kasse_button_trinkgeld; }
  function SetKasse_Vorauswahl_Anrede($value) { $this->kasse_vorauswahl_anrede=$value; }
  function GetKasse_Vorauswahl_Anrede() { return $this->kasse_vorauswahl_anrede; }
  function SetKasse_Erweiterte_Lagerabfrage($value) { $this->kasse_erweiterte_lagerabfrage=$value; }
  function GetKasse_Erweiterte_Lagerabfrage() { return $this->kasse_erweiterte_lagerabfrage; }
  function SetFilialadresse($value) { $this->filialadresse=$value; }
  function GetFilialadresse() { return $this->filialadresse; }
  function SetVersandprojektfiliale($value) { $this->versandprojektfiliale=$value; }
  function GetVersandprojektfiliale() { return $this->versandprojektfiliale; }
  function SetDifferenz_Auslieferung_Tage($value) { $this->differenz_auslieferung_tage=$value; }
  function GetDifferenz_Auslieferung_Tage() { return $this->differenz_auslieferung_tage; }
  function SetAutostuecklistenanpassung($value) { $this->autostuecklistenanpassung=$value; }
  function GetAutostuecklistenanpassung() { return $this->autostuecklistenanpassung; }
  function SetDpdendung($value) { $this->dpdendung=$value; }
  function GetDpdendung() { return $this->dpdendung; }
  function SetDhlendung($value) { $this->dhlendung=$value; }
  function GetDhlendung() { return $this->dhlendung; }
  function SetTracking_Substr_Start($value) { $this->tracking_substr_start=$value; }
  function GetTracking_Substr_Start() { return $this->tracking_substr_start; }
  function SetTracking_Remove_Kundennummer($value) { $this->tracking_remove_kundennummer=$value; }
  function GetTracking_Remove_Kundennummer() { return $this->tracking_remove_kundennummer; }
  function SetTracking_Substr_Length($value) { $this->tracking_substr_length=$value; }
  function GetTracking_Substr_Length() { return $this->tracking_substr_length; }
  function SetGo_Drucker($value) { $this->go_drucker=$value; }
  function GetGo_Drucker() { return $this->go_drucker; }
  function SetGo_Apiurl_Prefix($value) { $this->go_apiurl_prefix=$value; }
  function GetGo_Apiurl_Prefix() { return $this->go_apiurl_prefix; }
  function SetGo_Apiurl_Postfix($value) { $this->go_apiurl_postfix=$value; }
  function GetGo_Apiurl_Postfix() { return $this->go_apiurl_postfix; }
  function SetGo_Apiurl_User($value) { $this->go_apiurl_user=$value; }
  function GetGo_Apiurl_User() { return $this->go_apiurl_user; }
  function SetGo_Username($value) { $this->go_username=$value; }
  function GetGo_Username() { return $this->go_username; }
  function SetGo_Password($value) { $this->go_password=$value; }
  function GetGo_Password() { return $this->go_password; }
  function SetGo_Ax4Nr($value) { $this->go_ax4nr=$value; }
  function GetGo_Ax4Nr() { return $this->go_ax4nr; }
  function SetGo_Name1($value) { $this->go_name1=$value; }
  function GetGo_Name1() { return $this->go_name1; }
  function SetGo_Name2($value) { $this->go_name2=$value; }
  function GetGo_Name2() { return $this->go_name2; }
  function SetGo_Abteilung($value) { $this->go_abteilung=$value; }
  function GetGo_Abteilung() { return $this->go_abteilung; }
  function SetGo_Strasse1($value) { $this->go_strasse1=$value; }
  function GetGo_Strasse1() { return $this->go_strasse1; }
  function SetGo_Strasse2($value) { $this->go_strasse2=$value; }
  function GetGo_Strasse2() { return $this->go_strasse2; }
  function SetGo_Hausnummer($value) { $this->go_hausnummer=$value; }
  function GetGo_Hausnummer() { return $this->go_hausnummer; }
  function SetGo_Plz($value) { $this->go_plz=$value; }
  function GetGo_Plz() { return $this->go_plz; }
  function SetGo_Ort($value) { $this->go_ort=$value; }
  function GetGo_Ort() { return $this->go_ort; }
  function SetGo_Land($value) { $this->go_land=$value; }
  function GetGo_Land() { return $this->go_land; }
  function SetGo_Standardgewicht($value) { $this->go_standardgewicht=$value; }
  function GetGo_Standardgewicht() { return $this->go_standardgewicht; }
  function SetGo_Format($value) { $this->go_format=$value; }
  function GetGo_Format() { return $this->go_format; }
  function SetGo_Ausgabe($value) { $this->go_ausgabe=$value; }
  function GetGo_Ausgabe() { return $this->go_ausgabe; }
  function SetIntraship_Exportgrund($value) { $this->intraship_exportgrund=$value; }
  function GetIntraship_Exportgrund() { return $this->intraship_exportgrund; }
  function SetBillsafe_Merchantid($value) { $this->billsafe_merchantId=$value; }
  function GetBillsafe_Merchantid() { return $this->billsafe_merchantId; }
  function SetBillsafe_Merchantlicensesandbox($value) { $this->billsafe_merchantLicenseSandbox=$value; }
  function GetBillsafe_Merchantlicensesandbox() { return $this->billsafe_merchantLicenseSandbox; }
  function SetBillsafe_Merchantlicenselive($value) { $this->billsafe_merchantLicenseLive=$value; }
  function GetBillsafe_Merchantlicenselive() { return $this->billsafe_merchantLicenseLive; }
  function SetBillsafe_Applicationsignature($value) { $this->billsafe_applicationSignature=$value; }
  function GetBillsafe_Applicationsignature() { return $this->billsafe_applicationSignature; }
  function SetBillsafe_Applicationversion($value) { $this->billsafe_applicationVersion=$value; }
  function GetBillsafe_Applicationversion() { return $this->billsafe_applicationVersion; }
  function SetSecupay_Apikey($value) { $this->secupay_apikey=$value; }
  function GetSecupay_Apikey() { return $this->secupay_apikey; }
  function SetSecupay_Url($value) { $this->secupay_url=$value; }
  function GetSecupay_Url() { return $this->secupay_url; }
  function SetSecupay_Demo($value) { $this->secupay_demo=$value; }
  function GetSecupay_Demo() { return $this->secupay_demo; }
  function SetKasse_Zahlung_Bar_Bezahlt($value) { $this->kasse_zahlung_bar_bezahlt=$value; }
  function GetKasse_Zahlung_Bar_Bezahlt() { return $this->kasse_zahlung_bar_bezahlt; }
  function SetKasse_Zahlung_Ec_Bezahlt($value) { $this->kasse_zahlung_ec_bezahlt=$value; }
  function GetKasse_Zahlung_Ec_Bezahlt() { return $this->kasse_zahlung_ec_bezahlt; }
  function SetKasse_Zahlung_Kreditkarte_Bezahlt($value) { $this->kasse_zahlung_kreditkarte_bezahlt=$value; }
  function GetKasse_Zahlung_Kreditkarte_Bezahlt() { return $this->kasse_zahlung_kreditkarte_bezahlt; }
  function SetKasse_Zahlung_Ueberweisung_Bezahlt($value) { $this->kasse_zahlung_ueberweisung_bezahlt=$value; }
  function GetKasse_Zahlung_Ueberweisung_Bezahlt() { return $this->kasse_zahlung_ueberweisung_bezahlt; }
  function SetKasse_Zahlung_Paypal_Bezahlt($value) { $this->kasse_zahlung_paypal_bezahlt=$value; }
  function GetKasse_Zahlung_Paypal_Bezahlt() { return $this->kasse_zahlung_paypal_bezahlt; }

}

?>