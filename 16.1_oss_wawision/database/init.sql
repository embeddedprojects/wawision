--
-- Daten für Tabelle `projekt`
--

INSERT INTO `projekt` (`id`, `name`, `abkuerzung`, `verantwortlicher`, `beschreibung`, `sonstiges`, `aktiv`, `farbe`, `autoversand`, `checkok`, `portocheck`, `automailrechnung`, `checkname`, `zahlungserinnerung`, `zahlungsmailbedinungen`, `folgebestaetigung`, `stornomail`, `kundenfreigabe_loeschen`, `autobestellung`, `speziallieferschein`, `lieferscheinbriefpapier`, `speziallieferscheinbeschriftung`, `firma`, `geloescht`, `logdatei`, `steuersatz_normal`, `steuersatz_zwischen`, `steuersatz_ermaessigt`, `steuersatz_starkermaessigt`, `steuersatz_dienstleistung`, `waehrung`, `eigenesteuer`, `druckerlogistikstufe1`, `druckerlogistikstufe2`, `selbstabholermail`, `eanherstellerscan`, `reservierung`, `verkaufszahlendiagram`, `oeffentlich`, `shopzwangsprojekt`, `kunde`, `dpdkundennr`, `dhlkundennr`, `dhlformat`, `dpdformat`, `paketmarke_einzeldatei`, `dpdpfad`, `dhlpfad`, `upspfad`, `dhlintodb`, `intraship_enabled`, `intraship_drucker`, `intraship_testmode`, `intraship_user`, `intraship_signature`, `intraship_ekp`, `intraship_api_user`, `intraship_api_password`, `intraship_company_name`, `intraship_street_name`, `intraship_street_number`, `intraship_zip`, `intraship_country`, `intraship_city`, `intraship_email`, `intraship_phone`, `intraship_internet`, `intraship_contact_person`, `intraship_account_owner`, `intraship_account_number`, `intraship_bank_code`, `intraship_bank_name`, `intraship_iban`, `intraship_bic`, `intraship_WeightInKG`, `intraship_LengthInCM`, `intraship_WidthInCM`, `intraship_HeightInCM`, `intraship_PackageType`, `abrechnungsart`, `kommissionierverfahren`, `wechselaufeinstufig`, `projektuebergreifendkommisionieren`, `absendeadresse`, `absendename`, `absendesignatur`, `autodruckrechnung`, `autodruckversandbestaetigung`, `automailversandbestaetigung`, `autodrucklieferschein`, `automaillieferschein`, `autodruckstorno`, `autodruckanhang`, `automailanhang`, `autodruckerrechnung`, `autodruckerlieferschein`, `autodruckeranhang`, `autodruckrechnungmenge`, `autodrucklieferscheinmenge`, `eigenernummernkreis`, `next_angebot`, `next_auftrag`, `next_rechnung`, `next_lieferschein`, `next_arbeitsnachweis`, `next_reisekosten`, `next_bestellung`, `next_gutschrift`, `next_kundennummer`, `next_lieferantennummer`, `next_mitarbeiternummer`, `next_waren`, `next_produktion`, `next_sonstiges`, `next_anfrage`, `next_artikelnummer`, `gesamtstunden_max`, `auftragid`, `dhlzahlungmandant`, `dhlretourenschein`, `land`, `etiketten_positionen`, `etiketten_drucker`, `etiketten_art`, `seriennummernerfassen`, `versandzweigeteilt`, `nachnahmecheck`, `kasse_lieferschein_anlegen`, `kasse_lagerprozess`, `kasse_belegausgabe`, `kasse_preisgruppe`, `kasse_text_bemerkung`, `kasse_text_freitext`, `kasse_drucker`, `kasse_lieferschein`, `kasse_rechnung`, `kasse_lieferschein_doppel`, `kasse_lager`, `kasse_konto`, `kasse_laufkundschaft`, `kasse_rabatt_artikel`, `kasse_zahlung_bar`, `kasse_zahlung_ec`, `kasse_zahlung_kreditkarte`, `kasse_zahlung_ueberweisung`, `kasse_zahlung_paypal`, `kasse_extra_keinbeleg`, `kasse_extra_rechnung`, `kasse_extra_quittung`, `kasse_extra_gutschein`, `kasse_extra_rabatt_prozent`, `kasse_extra_rabatt_euro`, `kasse_adresse_erweitert`, `kasse_zahlungsauswahl_zwang`, `kasse_button_entnahme`, `kasse_button_trinkgeld`, `kasse_vorauswahl_anrede`, `kasse_erweiterte_lagerabfrage`, `filialadresse`, `versandprojektfiliale`, `differenz_auslieferung_tage`, `autostuecklistenanpassung`, `dpdendung`, `dhlendung`, `tracking_substr_start`, `tracking_remove_kundennummer`, `tracking_substr_length`, `go_drucker`, `go_apiurl_prefix`, `go_apiurl_postfix`, `go_apiurl_user`, `go_username`, `go_password`, `go_ax4nr`, `go_name1`, `go_name2`, `go_abteilung`, `go_strasse1`, `go_strasse2`, `go_hausnummer`, `go_plz`, `go_ort`, `go_land`, `go_standardgewicht`, `go_format`, `go_ausgabe`, `intraship_exportgrund`, `billsafe_merchantId`, `billsafe_merchantLicenseSandbox`, `billsafe_merchantLicenseLive`, `billsafe_applicationSignature`, `billsafe_applicationVersion`, `secupay_apikey`, `secupay_url`, `secupay_demo`) VALUES
(1, 'Standard Projekt', 'STANDARD', '', 'Standard Projekt', '', '', '#FFFFFF', 0, 0, 0, 0, '', 0, '', 0, 0, 0, 0, 0, 0, 0, 1, 0, '', 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, '', '', '', '', 0, '', '', '0', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, '', 'keine', 'lieferscheinlager', 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0.00, 0, '', 0, 'DE', 0, 0, 0, 1, 0, 1, 0, 'kein', 'kein', 0, 'Interne Bemerkung', 'Text auf Beleg', 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 1, 1, 0, 0, 'herr', 0, 0, 0, 2, 1, '.csv', '.csv', 8, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0.00, '', '', '', '', '', '', '', '', '', '', 0);



INSERT INTO `adresse` (`id`, `typ`, `marketingsperre`, `trackingsperre`, `rechnungsadresse`, `sprache`, `name`, `abteilung`, `unterabteilung`, `ansprechpartner`, `land`, `strasse`, `ort`, `plz`, `telefon`, `telefax`, `mobil`, `email`, `ustid`, `ust_befreit`, `passwort_gesendet`, `sonstiges`, `adresszusatz`, `kundenfreigabe`, `steuer`, `logdatei`, `kundennummer`, `lieferantennummer`, `mitarbeiternummer`, `konto`, `blz`, `bank`, `inhaber`, `swift`, `iban`, `waehrung`, `paypal`, `paypalinhaber`, `paypalwaehrung`, `projekt`, `partner`, `zahlungsweise`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `versandart`, `kundennummerlieferant`, `zahlungsweiselieferant`, `zahlungszieltagelieferant`, `zahlungszieltageskontolieferant`, `zahlungszielskontolieferant`, `versandartlieferant`, `geloescht`, `firma`, `webid`, `vorname`, `kennung`, `sachkonto`, `freifeld1`, `freifeld2`, `freifeld3`, `filiale`, `vertrieb`, `innendienst`, `verbandsnummer`, `abweichendeemailab`, `portofrei_aktiv`, `portofreiab`, `infoauftragserfassung`, `mandatsreferenz`, `mandatsreferenzdatum`, `mandatsreferenzaenderung`, `glaeubigeridentnr`, `kreditlimit`, `tour`, `zahlungskonditionen_festschreiben`, `rabatte_festschreiben`, `mlmaktiv`, `mlmvertragsbeginn`, `mlmlizenzgebuehrbis`, `mlmfestsetzenbis`, `mlmfestsetzen`, `mlmmindestpunkte`, `mlmwartekonto`, `abweichende_rechnungsadresse`, `rechnung_vorname`, `rechnung_name`, `rechnung_titel`, `rechnung_typ`, `rechnung_strasse`, `rechnung_ort`, `rechnung_plz`, `rechnung_ansprechpartner`, `rechnung_land`, `rechnung_abteilung`, `rechnung_unterabteilung`, `rechnung_adresszusatz`, `rechnung_telefon`, `rechnung_telefax`, `rechnung_anschreiben`, `rechnung_email`, `geburtstag`, `rolledatum`, `liefersperre`, `liefersperregrund`, `mlmpositionierung`, `steuernummer`, `steuerbefreit`, `mlmmitmwst`, `mlmabrechnung`, `mlmwaehrungauszahlung`, `mlmauszahlungprojekt`, `sponsor`, `geworbenvon`, `logfile`, `kalender_aufgaben`, `verrechnungskontoreisekosten`, `usereditid`, `useredittimestamp`, `rabatt`, `provision`, `rabattinformation`, `rabatt1`, `rabatt2`, `rabatt3`, `rabatt4`, `rabatt5`, `internetseite`, `bonus1`, `bonus1_ab`, `bonus2`, `bonus2_ab`, `bonus3`, `bonus3_ab`, `bonus4`, `bonus4_ab`, `bonus5`, `bonus5_ab`, `bonus6`, `bonus6_ab`, `bonus7`, `bonus7_ab`, `bonus8`, `bonus8_ab`, `bonus9`, `bonus9_ab`, `bonus10`, `bonus10_ab`, `rechnung_periode`, `rechnung_anzahlpapier`, `rechnung_permail`, `titel`, `anschreiben`, `nachname`, `arbeitszeitprowoche`, `folgebestaetigungsperre`, `lieferantennummerbeikunde`, `verein_mitglied_seit`, `verein_mitglied_bis`, `verein_mitglied_aktiv`, `verein_spendenbescheinigung`, `freifeld4`, `freifeld5`, `freifeld6`, `freifeld7`, `freifeld8`, `freifeld9`, `freifeld10`, `rechnung_papier`, `angebot_cc`, `auftrag_cc`, `rechnung_cc`, `gutschrift_cc`, `lieferschein_cc`, `bestellung_cc`, `angebot_fax_cc`, `auftrag_fax_cc`, `rechnung_fax_cc`, `gutschrift_fax_cc`, `lieferschein_fax_cc`, `bestellung_fax_cc`, `abperfax`, `abpermail`, `kassiereraktiv`, `kassierernummer`, `kassiererprojekt`, `portofreilieferant_aktiv`, `portofreiablieferant`, `mandatsreferenzart`, `mandatsreferenzwdhart`, `serienbrief`) VALUES
(1, '', '', 0, 0, '', 'Administrator', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', '2015-10-26 14:19:35', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, '', '', '', '', '', '', '', '', '', '', '', 0, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '', '', NULL, 0, '', 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0.00, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, 0, 0.00, '', '', 0);

INSERT INTO `user` (`id`, `username`, `password`, `repassword`, `description`, `settings`, `parentuser`, `activ`, `type`, `adresse`, `fehllogins`, `standarddrucker`, `firma`, `logdatei`, `startseite`, `hwtoken`, `hwkey`, `hwcounter`, `motppin`, `motpsecret`, `passwordmd5`, `externlogin`, `projekt_bevorzugen`, `email_bevorzugen`, `projekt`, `rfidtag`, `vorlage`, `kalender_passwort`, `kalender_ausblenden`, `kalender_aktiv`, `gpsstechuhr`, `standardetikett`, `standardfax`, `internebezeichnung`, `hwdatablock`) VALUES
(1, 'admin', 'qnvEQ1sFWNdIg', 0, 'Administrator', 'a:6:{s:16:"pos_list_projekt";s:1:"0";s:18:"pos_list_kassierer";s:1:"0";s:22:"pos_list_kassierername";s:1:"0";s:18:"pos_list_lkadresse";s:1:"0";s:18:"lohnabrechnung_von";s:0:"";s:18:"lohnabrechnung_bis";s:0:"";}', 0, 1, 'admin', 1, 0, 0, 1, '2015-10-26 14:21:04', NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', 1, 0, 1, 0, '', NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL);


--
-- Daten für Tabelle `firma`
--

INSERT INTO `firma` (`id`, `name`, `standardprojekt`) VALUES
(1, 'Musterfirma GmbH', 1);

--
-- Daten für Tabelle `geschaeftsbrief_vorlagen`
--

INSERT INTO `geschaeftsbrief_vorlagen` (`id`, `sprache`, `betreff`, `text`, `subjekt`, `projekt`, `firma`) VALUES
(1, 'deutsch', 'Bestellung von {FIRMA}', 'Sehr geehrter Lieferant,\r\n\r\nanbei übersenden wir Ihnen unsere Bestellung zu. Bitte senden Sie uns als Bestätigung für den Empfang eine Auftragsbestätigung per Fax an: +49 821 27 95 99 20.', 'Bestellung', 1, 1),
(2, 'englisch', 'Order {FIRMA}', 'Dear Sir or Madam,\r\n\r\nenclosed we send our order. \r\nPlease send as acknowledgment a fax to the following number: +49 12345678 send us an e-mail.', 'Bestellung', 1, 1),
(3, 'deutsch', 'Betreff: {BETREFF}', 'Sehr geehrter {NAME}', 'Korrespondenz', 1, 1),
(5, 'deutsch', 'Lieferschein von {FIRMA}', 'Sehr geehrter Kunde,\r\n\r\nanbei übersenden wir Ihnen unseren Lieferschein zu.', 'Lieferschein', 1, 1),
(6, 'deutsch', 'Ihr Angebot von {FIRMA}', 'Sehr geehrter Herr \r\n\r\n\r\nanbei das gewünschte Angebot. Wir hoffen Ihnen die passenden Artikel anbieten zu können.', 'Angebot', 1, 1),
(7, 'deutsch', 'Auftragsbestätigung von {FIRMA}', 'Sehr geehrter Kunde,\r\n\r\nanbei übersenden wir Ihnen Ihre Auftragsbestätigung. ', 'Auftrag', 1, 1),
(8, 'deutsch', 'Ihre Rechnung von {FIRMA}', 'Sehr geehrter Herr/Frau {NAME},\r\n\r\n\r\nanbei finden Sie Ihre Rechnung. Gerne stehen wir Ihnen weiterhin zur Verfügung.\r\n\r\nIhre Rechnung ist im PDF-Format erstellt worden. Um sich die Rechnung ansehen zu können, klicken Sie auf den Anhang und es öffnet sich automatisch der Acrobat Reader. Sollten Sie keinen Acrobat Reader besitzen, haben wir für Sie den Link zum kostenlosen Download von Adobe Acrobat Reader mit angegeben. Er führt Sie automatisch auf die Downloadseite von Adobe. So können Sie sich Ihre Rechnung auch für Ihre Unterlagen ausdrucken.\r\n\r\nhttp://www.adobe.com/products/acrobat/readstep2.html', 'Rechnung', 1, 1),
(9, 'deutsch', 'Versand Ihrer Bestellung von {FIRMA}', 'Sehr geehrter Kunde,\r\n\r\nsoeben wurde Ihr Bestellung zusammengestellt und wird in Kürze unserem Versandunternehmen übergeben.\r\n\r\n{VERSAND}\r\n\r\nIhr {FIRMA} Team\r\n', 'Versand', 1, 1),
(10, 'deutsch', 'Eingang Ihrer Zahlung', 'Sehr geehrter Kunde,\r\n\r\n\r\nIhre Zahlung zum Auftrag Nr. {AUFTRAG} vom {DATUM} in Höhe von {GESAMT} EUR konnte zugeordnet werden.\r\n\r\n\r\nVielen Dank.\r\n\r\nIhr {FIRMA} Team\r\n', 'ZahlungOK', 1, 1),
(11, 'deutsch', 'Fehlbetrag bei Eingang Ihrer Zahlung', 'Sehr geehrter Kunde,\r\n\r\nbezüglich Ihrer Zahlung zum Auftrag Nr. {AUFTRAG} vom {DATUM} in Höhe von {GESAMT} EUR gab es bei der Zuordnung eine Zahlungsdifferenz von {REST} EUR.\r\n\r\n\r\nBitte überweisen Sie noch den Fehlbetrag in Höhe von {REST} EUR mit dem angegebenen Verwendungszweck auf unser Konto:\r\n\r\nVerwendungszweck: {AUFTRAG}\r\n\r\n{FIRMA}\r\nBLZ: 123456\r\nKonto Nr.: 987654321\r\n\r\nFür Ausland:\r\n\r\nIBAN: DE123456\r\nBIC: DEUTDEMM720\r\n\r\nBitte beachten Sie bei der Zahlung: eventuelle Gebühren dürfen nicht zu unseren Lasten gehen.\r\n\r\n\r\nIhr {FIRMA} Team\r\n', 'ZahlungDiff', 1, 1),
(12, 'deutsch', 'Stornierung Ihres Auftrags', 'Sehr geehrter Kunde,\r\n\r\n\r\nIhr Auftrag Nr. {AUFTRAG} vom {DATUM} wurde soeben aus unserem System storniert.\r\n\r\nBereits bezahltes Auftragsguthaben erstatten wir Ihnen in den nächsten Tagen auf dem gleichen Weg (Bank, Paypal, Kreditkarte, etc.) Ihrer Zahlung zurück. \r\n\r\nSollten Daten für die Zahlung fehlen, wird ein Sachbearbeiter mit Ihnen Kontakt aufnehmen.\r\n\r\nVielen Dank.\r\n\r\nIhr {FIRMA} Team\r\n', 'Stornierung', 1, 1),
(14, 'deutsch', 'Vorkasse Ihrer Bestellung', 'Sehr geehrter Kunde,\r\n\r\nvielen Dank nochmals für Ihre Bestellung.\r\n\r\nBezüglich Ihres Auftrags Nr. {AUFTRAG} vom {DATUM} in Höhe von {GESAMT} EUR senden wir Ihnen die Zahlungsinformationen zu. Sollten Sie \r\nzwischenzeitlich den Betrag bereits überwiesen haben, sehen Sie diese E-Mail bitte als gegenstandslos an.\r\n\r\nBitte überweisen Sie den Betrag in Höhe von {REST} EUR mit dem angegebenen Verwendungszweck auf unser Konto:\r\n\r\nVerwendungszweck: {AUFTRAG}\r\nBetrag: {REST}\r\n\r\n{FIRMA}\r\nBank:Deutsche Bank\r\nBLZ: 1234567\r\nKonto Nr.: 987654321\r\n\r\nFür Ausland:\r\n\r\nIBAN: DE1234567\r\nBIC: DEUTDEMM720\r\n\r\nBitte beachten Sie bei der Zahlung: eventuelle Gebühren dürfen nicht zu unseren Lasten gehen.\r\n\r\n\r\nIhr {FIRMA} Team\r\n', 'ZahlungMiss', 1, 1),
(15, 'deutsch', 'Betriebsurlaub vom 09.08 bis 24.08.2010', 'Liebe Kunden,\r\n\r\nwir sind vom 09.08.2010 bis zum 24.08.2010 im Betriebsurlaub.\r\nIhre Anfragen werden deshalb erst wieder nach diesem Zeitraum bearbeitet.\r\n\r\nIhre Bestellungen werden in dieser Zeit statt täglich wöchentlich versendet.*\r\n\r\nWir wünschen Ihnen eine schöne Ferienzeit und bedanken uns für Ihr Verständnis.\r\n\r\nDas {FIRMA} Team\r\n\r\n\r\n\r\n*sofern sich die Ware bei uns im Lager befindet.', 'Betriebsurlaub', 0, 1),
(16, 'deutsch', 'Ihre Bestellung: Informationen Artikel {ARTIKEL}', 'Sehr geehrter {FIRMA} Kunde,\r\n\r\nvielen Dank für Ihre Bestellung. Auf Grund der großen\r\nNachfrage konnten wir nicht sofort alle Bestellungen \r\naufnehmen und beantworten.\r\n\r\nLeider gibt es bei dem Artikel {ARTIKEL} einen Lieferengpass. \r\nDie vorhandenen Artikel aus dem Lager sind an die schnellsten \r\nKäufer versendet worden.\r\n\r\n\r\nDa wir ein kleines Unternehmen sind und unser Lager nicht \r\nstündlich aktualisieren, wurde der Artikel leider nicht \r\nrechtzeitig gesperrt. \r\n\r\n\r\nBitte teilen Sie uns über folgenden Link mit, wie wir mit Ihrer \r\nBestellung verfahren sollen (es gibt einen kompatiblen \r\nErsatzartikel welcher im Lager vorhanden ist).\r\n\r\n\r\n===== LINK ZUR AUSWAHL ======\r\n\r\nhttp://www.eproo.de/index.php?module=exportlink&regkey={REG}\r\n\r\n===== LINK ZUR AUSWAHL ======\r\n\r\nInfo zu Alternativen bei uns im Shop:\r\nDer Prozessor der Familie XXX (kompatibel zu YYY \r\nmit ausreichend Flash) befindet sich noch auf folgenden Produkt:\r\n\r\n\r\nZZZ (aus unserem Online-Shop), welcher einen \r\nkompatiblen Prozessor zum YYY bietet. (Im Lager vorhanden).\r\n\r\n\r\n\r\nBitte informieren Sie sich im Internet bzw. über bekannte \r\nForen, ob das Produkt eine  passende Wahl für Sie ist.\r\n\r\n\r\n\r\nVielen Dank für das Vertrauen und die Geduld. Wir halten Sie per E-Mail auf dem Laufenden.\r\n\r\nIhr {FIRMA} Team\r\n', 'AlternativArtikel', 0, 1),
(17, 'deutsch', 'Zusammenstellung Ihrer Bestellung', 'Sehr geehrter Kunde,\r\n\r\nsoeben wurde Ihr Bestellung zusammengestellt. Sie können Ihre Ware jetzt abholen. Sind Sie bereits bei uns gewesen, so sehen Sie diese E-Mail bitte als gegenstandslos an.\r\n\r\n{VERSAND}\r\n\r\nIhr {FIRMA} Team\r\n', 'Selbstabholer', 0, 1);


--
-- Daten für Tabelle `firmendaten`
--

INSERT INTO `firmendaten` (`id`, `firma`, `absender`, `sichtbar`, `barcode`, `schriftgroesse`, `betreffszeile`, `dokumententext`, `tabellenbeschriftung`, `tabelleninhalt`, `zeilenuntertext`, `freitext`, `infobox`, `spaltenbreite`, `footer_0_0`, `footer_0_1`, `footer_0_2`, `footer_0_3`, `footer_0_4`, `footer_0_5`, `footer_1_0`, `footer_1_1`, `footer_1_2`, `footer_1_3`, `footer_1_4`, `footer_1_5`, `footer_2_0`, `footer_2_1`, `footer_2_2`, `footer_2_3`, `footer_2_4`, `footer_2_5`, `footer_3_0`, `footer_3_1`, `footer_3_2`, `footer_3_3`, `footer_3_4`, `footer_3_5`, `footersichtbar`, `hintergrund`, `logo`, `logo_type`, `briefpapier`, `briefpapier_type`, `benutzername`, `passwort`, `host`, `port`, `mailssl`, `signatur`, `email`, `absendername`, `bcc1`, `bcc2`, `firmenfarbe`, `name`, `strasse`, `plz`, `ort`, `steuernummer`, `startseite_wiki`, `datum`, `projekt`, `brieftext`, `next_angebot`, `next_auftrag`, `next_gutschrift`, `next_lieferschein`, `next_bestellung`, `next_rechnung`, `next_kundennummer`, `next_lieferantennummer`, `next_mitarbeiternummer`, `next_waren`, `next_sonstiges`, `next_produktion`, `breite_position`, `breite_menge`, `breite_nummer`, `breite_einheit`, `skonto_ueberweisung_ueberziehen`, `steuersatz_normal`, `steuersatz_zwischen`, `steuersatz_ermaessigt`, `steuersatz_starkermaessigt`, `steuersatz_dienstleistung`, `kleinunternehmer`, `mahnwesenmitkontoabgleich`, `porto_berechnen`, `immernettorechnungen`, `schnellanlegen`, `bestellvorschlaggroessernull`, `versand_gelesen`, `versandart`, `zahlungsweise`, `zahlung_lastschrift_konditionen`, `breite_artikelbeschreibung`, `devicekey`, `deviceserials`, `deviceenable`, `etikettendrucker_wareneingang`, `waehrung`, `footer_breite1`, `footer_breite2`, `footer_breite3`, `footer_breite4`, `boxausrichtung`, `lizenz`, `schluessel`, `branch`, `version`, `standard_datensaetze_datatables`, `auftrag_bezeichnung_vertrieb`, `auftrag_bezeichnung_bearbeiter`, `auftrag_bezeichnung_bestellnummer`, `bezeichnungkundennummer`, `bezeichnungstornorechnung`, `bestellungohnepreis`, `mysql55`, `rechnung_gutschrift_ansprechpartner`, `api_initkey`, `api_remotedomain`, `api_eventurl`, `api_enable`, `api_cleanutf8`, `api_importwarteschlange`, `api_importwarteschlange_name`, `wareneingang_zwischenlager`, `modul_mlm`, `modul_verband`, `modul_mhd`, `mhd_warnung_tage`, `mlm_mindestbetrag`, `mlm_anzahlmonate`, `mlm_letzter_tag`, `mlm_erster_tag`, `mlm_letzte_berechnung`, `mlm_01`, `mlm_02`, `mlm_03`, `mlm_04`, `mlm_05`, `mlm_06`, `mlm_07`, `mlm_08`, `mlm_09`, `mlm_10`, `mlm_11`, `mlm_12`, `mlm_13`, `mlm_14`, `mlm_15`, `mlm_01_punkte`, `mlm_02_punkte`, `mlm_03_punkte`, `mlm_04_punkte`, `mlm_05_punkte`, `mlm_06_punkte`, `mlm_07_punkte`, `mlm_08_punkte`, `mlm_09_punkte`, `mlm_10_punkte`, `mlm_11_punkte`, `mlm_12_punkte`, `mlm_13_punkte`, `mlm_14_punkte`, `mlm_15_punkte`, `mlm_01_mindestumsatz`, `mlm_02_mindestumsatz`, `mlm_03_mindestumsatz`, `mlm_04_mindestumsatz`, `mlm_05_mindestumsatz`, `mlm_06_mindestumsatz`, `mlm_07_mindestumsatz`, `mlm_08_mindestumsatz`, `mlm_09_mindestumsatz`, `mlm_10_mindestumsatz`, `mlm_11_mindestumsatz`, `mlm_12_mindestumsatz`, `mlm_13_mindestumsatz`, `mlm_14_mindestumsatz`, `mlm_15_mindestumsatz`, `standardaufloesung`, `standardversanddrucker`, `standardetikettendrucker`, `externereinkauf`, `schriftart`, `knickfalz`, `artikeleinheit`, `artikeleinheit_standard`, `abstand_name_beschreibung`, `abstand_boxrechtsoben_lr`, `zahlungszieltage`, `zahlungszielskonto`, `zahlungszieltageskonto`, `zahlung_rechnung`, `zahlung_vorkasse`, `zahlung_nachnahme`, `zahlung_kreditkarte`, `zahlung_paypal`, `zahlung_bar`, `zahlung_lastschrift`, `zahlung_amazon`, `zahlung_ratenzahlung`, `zahlung_rechnung_sofort_de`, `zahlung_rechnung_de`, `zahlung_vorkasse_de`, `zahlung_lastschrift_de`, `zahlung_nachnahme_de`, `zahlung_bar_de`, `zahlung_paypal_de`, `zahlung_amazon_de`, `zahlung_kreditkarte_de`, `zahlung_ratenzahlung_de`, `briefpapier2`, `briefpapier2vorhanden`, `artikel_suche_kurztext`, `adresse_freitext1_suche`, `iconset_dunkel`, `warnung_doppelte_nummern`, `next_arbeitsnachweis`, `next_reisekosten`, `next_anfrage`, `next_artikelnummer`, `seite_von_ausrichtung`, `seite_von_sichtbar`, `parameterundfreifelder`, `freifeld1`, `freifeld2`, `freifeld3`, `freifeld4`, `freifeld5`, `freifeld6`, `firmenfarbehell`, `firmenfarbedunkel`, `firmenfarbeganzdunkel`, `navigationfarbe`, `navigationfarbeschrift`, `unternavigationfarbe`, `unternavigationfarbeschrift`, `firmenlogo`, `firmenlogotype`, `firmenlogoaktiv`, `projektnummerimdokument`, `mailanstellesmtp`, `herstellernummerimdokument`, `standardmarge`, `steuer_erloese_inland_normal`, `steuer_aufwendung_inland_normal`, `steuer_erloese_inland_ermaessigt`, `steuer_aufwendung_inland_ermaessigt`, `steuer_erloese_inland_steuerfrei`, `steuer_aufwendung_inland_steuerfrei`, `steuer_erloese_inland_innergemeinschaftlich`, `steuer_aufwendung_inland_innergemeinschaftlich`, `steuer_erloese_inland_eunormal`, `steuer_aufwendung_inland_eunormal`, `steuer_erloese_inland_export`, `steuer_aufwendung_inland_import`, `steuer_anpassung_kundennummer`, `steuer_art_1`, `steuer_art_1_normal`, `steuer_art_1_ermaessigt`, `steuer_art_1_steuerfrei`, `steuer_art_2`, `steuer_art_2_normal`, `steuer_art_2_ermaessigt`, `steuer_art_2_steuerfrei`, `steuer_art_3`, `steuer_art_3_normal`, `steuer_art_3_ermaessigt`, `steuer_art_3_steuerfrei`, `steuer_art_4`, `steuer_art_4_normal`, `steuer_art_4_ermaessigt`, `steuer_art_4_steuerfrei`, `steuer_art_5`, `steuer_art_5_normal`, `steuer_art_5_ermaessigt`, `steuer_art_5_steuerfrei`, `steuer_art_6`, `steuer_art_6_normal`, `steuer_art_6_ermaessigt`, `steuer_art_6_steuerfrei`, `steuer_art_7`, `steuer_art_7_normal`, `steuer_art_7_ermaessigt`, `steuer_art_7_steuerfrei`, `steuer_art_8`, `steuer_art_8_normal`, `steuer_art_8_ermaessigt`, `steuer_art_8_steuerfrei`, `steuer_art_9`, `steuer_art_9_normal`, `steuer_art_9_ermaessigt`, `steuer_art_9_steuerfrei`, `steuer_art_10`, `steuer_art_10_normal`, `steuer_art_10_ermaessigt`, `steuer_art_10_steuerfrei`, `steuer_art_11`, `steuer_art_11_normal`, `steuer_art_11_ermaessigt`, `steuer_art_11_steuerfrei`, `steuer_art_12`, `steuer_art_12_normal`, `steuer_art_12_ermaessigt`, `steuer_art_12_steuerfrei`, `steuer_art_13`, `steuer_art_13_normal`, `steuer_art_13_ermaessigt`, `steuer_art_13_steuerfrei`, `steuer_art_14`, `steuer_art_14_normal`, `steuer_art_14_ermaessigt`, `steuer_art_14_steuerfrei`, `steuer_art_15`, `steuer_art_15_normal`, `steuer_art_15_ermaessigt`, `steuer_art_15_steuerfrei`, `rechnung_header`, `lieferschein_header`, `angebot_header`, `auftrag_header`, `gutschrift_header`, `bestellung_header`, `arbeitsnachweis_header`, `provisionsgutschrift_header`, `rechnung_footer`, `lieferschein_footer`, `angebot_footer`, `auftrag_footer`, `gutschrift_footer`, `bestellung_footer`, `arbeitsnachweis_footer`, `provisionsgutschrift_footer`, `rechnung_ohnebriefpapier`, `lieferschein_ohnebriefpapier`, `angebot_ohnebriefpapier`, `auftrag_ohnebriefpapier`, `gutschrift_ohnebriefpapier`, `bestellung_ohnebriefpapier`, `arbeitsnachweis_ohnebriefpapier`, `eu_lieferung_vermerk`, `export_lieferung_vermerk`, `abstand_adresszeileoben`, `abstand_boxrechtsoben`, `abstand_betreffzeileoben`, `abstand_artikeltabelleoben`, `wareneingang_kamera_waage`, `layout_iconbar`, `briefhtml`, `seite_von_ausrichtung_relativ`, `absenderunterstrichen`, `schriftgroesseabsender`, `datatables_export_button_flash`, `land`, `modul_finanzbuchhaltung`, `testmailempfaenger`, `immerbruttorechnungen`, `sepaglaeubigerid`, `viernachkommastellen_belege`, `bezeichnungangebotersatz`, `stornorechnung_standard`, `angebotersatz_standard`, `modul_verein`, `abstand_gesamtsumme_lr`, `zahlung_amazon_bestellung`, `zahlung_billsafe`, `zahlung_sofortueberweisung`, `zahlung_secupay`, `zahlung_amazon_bestellung_de`, `zahlung_billsafe_de`, `zahlung_sofortueberweisung_de`, `zahlung_secupay_de`, `artikel_bilder_uebersicht`, `adressefreifeld1`, `adressefreifeld2`, `adressefreifeld3`, `adressefreifeld4`, `adressefreifeld5`, `adressefreifeld6`, `adressefreifeld7`, `adressefreifeld8`, `adressefreifeld9`, `adressefreifeld10`, `steuer_erloese_inland_nichtsteuerbar`, `steuer_erloese_inland_euermaessigt`, `steuer_aufwendung_inland_nichtsteuerbar`, `steuer_aufwendung_inland_euermaessigt`, `abstand_seitenrandlinks`, `abstand_adresszeilelinks`, `wareneingang_gross`) VALUES
(1, 1, 'Musterfirma GmbH | Musterweg 5 | 12345 Musterstadt', 1, 1, 7, 9, 9, 9, 9, 7, 9, 8, 0, 'Sitz der Gesellschaft / Lieferanschrift', 'Musterfirma GmbH', 'Musterweg 5', 'D-12345 Musterstadt', 'Telefon +49 123 12 34 56 7', 'Telefax +49 123 12 34 56 78', 'Bankverbindung', 'Musterbank', 'Konto 123456789', 'BLZ 72012345', '', '', 'IBAN DE1234567891234567891', 'BIC/SWIFT DETSGDBWEMN', 'Ust-IDNr. DE123456789', 'E-Mail: info@musterfirma-gmbh.de', 'Internet: http://www.musterfirma.de', '', 'Geschäftsführer', 'Max Musterman', 'Handelsregister: HRB 12345', 'Amtsgericht: Musterstadt', '', '', 0, 'kein', '', '', '', '', 'musterman', 'passwort', 'smtp.ihr_mail_server.de', '25', 1, 'LS0NCk11c3RlcmZpcm1hIEdtYkgNCk11c3RlcndlZyA1DQpELTEyMzQ1IE11c3RlcnN0YWR0DQoNClRlbCArNDkgMTIzIDEyIDM0IDU2IDcNCkZheCArNDkgMTIzIDEyIDM0IDU2IDc4DQoNCk5hbWUgZGVyIEdlc2VsbHNjaGFmdDogTXVzdGVyZmlybWEgR21iSA0KU2l0eiBkZXIgR2VzZWxsc2NoYWZ0OiBNdXN0ZXJzdGFkdA0KDQpIYW5kZWxzcmVnaXN0ZXI6IE11c3RlcnN0YWR0LCBIUkIgMTIzNDUNCkdlc2Now6RmdHNmw7xocnVuZzogTWF4IE11c3Rlcm1hbg0KVVN0LUlkTnIuOiBERTEyMzQ1Njc4OQ0KDQpBR0I6IGh0dHA6Ly93d3cubXVzdGVyZmlybWEuZGUvDQo=', 'mail@ihr_mail_server.de', 'Meine Firma', '', '', '', 'Musterfirma GmbH', 'Musterweg 5', '12345', 'Musterstadt', '111/11111/11111', '', '0000-00-00 00:00:00', 1, '11', '100003', '200005', '900000', '300001', '100002', '400001', '10003', '70002', '90001', '', '', '400000', 10, 10, 20, 15, 0, 19.00, 7.00, 7.00, 7.00, 7.00, 0, 1, 0, 0, 1, 0, 0, 'versandunternehmen', 'rechnung', 0, 1, '', '', 0, 0, 'EUR', 50, 35, 60, 40, 'L', '', '', '', '15.4.f7412d4', 0, 'Vertrieb', 'Bearbeiter', 'Ihre Bestellnummer', 'Kundennummer', 'Stornorechnung', 0, 1, 0, '', '', '', 0, 1, 0, '', 0, 0, 0, 0, 3, 50.00, 11, NULL, NULL, NULL, 15.00, 20.00, 28.00, 32.00, 36.00, 40.00, 44.00, 44.00, 44.00, 44.00, 50.00, 54.00, 45.00, 48.00, 60.00, 2999, 3000, 5000, 10000, 15000, 25000, 50000, 100000, 150000, 200000, 250000, 300000, 350000, 400000, 450000, 50, 50, 50, 50, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 14, 2, 10, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Rechnung zahlbar sofort.', 'Rechnung zahlbar innerhalb {ZAHLUNGSZIELTAGE} Tage bis zum {ZAHLUNGBISDATUM}.', '', '', '', '', '', '', '', '', NULL, 0, 1, 0, 0, 1, '300000', '31000', '50000', '1000000', 'R', 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 0, 0, 0, 0, 30, '4400', '5400', '4300', '', '', '', '4125', '5425', '4315', '', '4120', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Sehr geehrte Damen und Herren,\r\n\r\nanbei Ihre Rechnung.', 'Sehr geehrte Damen und Herren,\r\n\r\nwir liefern Ihnen:', 'Sehr geehrte Damen und Herren,\r\n\r\nhiermit bieten wir Ihnen an:', 'Sehr geehrte Damen und Herren,\r\n\r\nvielen Dank für Ihren Auftrag.', 'Sehr geehrte Damen und Herren,\r\n\r\nanbei Ihre {ART}:', 'Sehr geehrte Damen und Herren,\r\n\r\nwir bestellen hiermit:', 'Sehr geehrte Damen und Herren,\r\n\r\nwir liefern Ihnen:', 'Sehr geehrte Damen und Herren,\r\n\r\nwir liefern Ihnen:', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 'Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.', 0, 0, 0, 0, 0, 0, 0, 'Steuerfrei nach § 4 Nr. 1b i.V.m. § 6 a UStG. Ihre USt-IdNr. {USTID} Land: {LAND}', 'Steuerfrei (Drittland) gem. §4 Nr. 1a UStG', 0, 0, 0, 0, 0, 0, 0, 0, 1, 7, 1, 'DE', 0, '', 0, '', 0, '', 0, 0, 0, 100, 0, 0, 0, 0, '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 15, 15, 0);

