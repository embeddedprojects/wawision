-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 09. Dez 2013 um 11:24
-- Server Version: 5.5.32
-- PHP-Version: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `wawision`
--

--
-- Daten für Tabelle `abrechnungsartikel`
--

INSERT INTO `abrechnungsartikel` (`id`, `sort`, `artikel`, `bezeichnung`, `nummer`, `menge`, `preis`, `steuerklasse`, `rabatt`, `abgerechnet`, `startdatum`, `lieferdatum`, `abgerechnetbis`, `wiederholend`, `zahlzyklus`, `abgrechnetam`, `rechnung`, `projekt`, `adresse`, `status`, `bemerkung`, `logdatei`) VALUES
(1, 1, 2, 'Rote Zwiebeln', '700002', 1, 2.5100, '', '', 0, '2013-06-01', '0000-00-00', '2013-12-31', 1, 1, '0000-00-00', 0, 0, 9, 'angelegt', '', '2013-11-15 15:28:51');

--
-- Daten für Tabelle `accordion`
--

INSERT INTO `accordion` (`id`, `name`, `target`, `position`) VALUES
(1, 'Startseite', 'StartseiteWiki', 1);

--
-- Daten für Tabelle `adresse`
--

INSERT INTO `adresse` (`id`, `typ`, `marketingsperre`, `trackingsperre`, `rechnungsadresse`, `sprache`, `name`, `abteilung`, `unterabteilung`, `ansprechpartner`, `land`, `strasse`, `ort`, `plz`, `telefon`, `telefax`, `mobil`, `email`, `ustid`, `ust_befreit`, `passwort_gesendet`, `sonstiges`, `adresszusatz`, `kundenfreigabe`, `steuer`, `logdatei`, `kundennummer`, `lieferantennummer`, `mitarbeiternummer`, `konto`, `blz`, `bank`, `inhaber`, `swift`, `iban`, `waehrung`, `paypal`, `paypalinhaber`, `paypalwaehrung`, `projekt`, `partner`, `zahlungsweise`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `versandart`, `kundennummerlieferant`, `zahlungsweiselieferant`, `zahlungszieltagelieferant`, `zahlungszieltageskontolieferant`, `zahlungszielskontolieferant`, `versandartlieferant`, `geloescht`, `firma`, `webid`, `vorname`, `logfile`, `kalender_aufgaben`, `internetseite`, `titel`, `anschreiben`) VALUES
(1, '', '', 0, 0, '', 'Administrator', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', '2013-10-24 13:01:10', '0', '0', '90001', '', '', '', '', '', '', '', '', '', '', 1, 0, '', '', '', '', '', '', '', '', '', '', '', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'firma', '', 0, 0, 'deutsch', 'Lieferant Bürobedarf', '', 'Logistik', '', 'DE', 'Lieferantenstraße 1', 'Musterstadt', '11111', '', '', '', '', '', 0, 0, '', '', 0, '', '2013-10-24 12:06:44', '0', '70000', '0', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', NULL, 0, '', '', ''),
(3, 'firma', '', 0, 0, 'deutsch', 'Lieferant Printwerbung', '', '', '', 'DE', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', '2013-10-24 12:07:20', '0', '70001', '0', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', NULL, 0, '', '', ''),
(4, 'firma', '', 0, 0, 'deutsch', 'Kunde Shop 1', '', '', 'Peter Kunde', 'DE', 'Straße 3', 'Vorstadt', '22222', '', '', '', 'kunde@wawision.de', '', 0, 0, '', '', 0, '', '2013-10-24 12:09:42', '10000', '0', '0', '', '', '', '', '', '', '', '', '', '', 2, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', NULL, 0, '', '', ''),
(5, 'firma', '', 0, 0, 'deutsch', 'Mitarbeiter 1', '', '', '', 'DE', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', '2013-10-24 12:10:05', '0', '0', '90000', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', NULL, 0, '', '', ''),
(6, 'firma', '', 0, 0, 'deutsch', 'Lieferant Catering', '', '', '', 'DE', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', '2013-10-24 12:11:54', '10001', '70002', '0', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', NULL, 0, '', '', ''),
(7, 'firma', '', 0, 0, 'deutsch', 'Prototypenbau', '', '', '', 'DE', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', '2013-10-24 12:18:27', '10002', '70003', '0', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', NULL, 0, '', '', ''),
(8, 'firma', '', 0, 0, 'deutsch', 'Bester Kunde 1', '', '', '', 'DE', 'Uferweg 5', 'Augsburg', '86152', '', '', '', 'kunde@wawision.de', '', 0, 0, '', '', 0, '', '2013-10-24 12:43:31', '10003', '0', '0', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', NULL, 0, '', '', ''),
(9, 'herr', '', 0, 0, 'deutsch', 'Kunde 2', '', '', '', 'DE', 'Hauptstraße 24', 'Augsburg', '86150', '', '', '', 'kunde@wawision.de', '', 0, 0, '', '', 0, '', '2013-10-24 12:52:27', '10004', '0', '0', '', '', '', '', '', '', '', '', '', '', 2, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', NULL, 0, '', '', ''),
(10, 'herr', '', 0, 0, 'deutsch', 'Jörn Heller', '', '', '', 'DE', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', '2013-10-24 16:42:23', '0', '0', '90002', '', '', '', '', '', '', '', '', '', '', 2, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', NULL, 0, '', '', '');

--
-- Daten für Tabelle `adresse_kontakte`
--

INSERT INTO `adresse_kontakte` (`id`, `adresse`, `bezeichnung`, `kontakt`) VALUES
(1, 10, 'Telefon Privat', '0821 / 123456');

--
-- Daten für Tabelle `adresse_rolle`
--

INSERT INTO `adresse_rolle` (`id`, `adresse`, `projekt`, `subjekt`, `praedikat`, `objekt`, `parameter`, `von`, `bis`) VALUES
(1, 2, 0, 'Lieferant', '', '', '', '2013-10-24', '0000-00-00'),
(2, 3, 0, 'Lieferant', '', '', '', '2013-10-24', '0000-00-00'),
(3, 4, 0, 'Kunde', '', '', '', '2013-10-24', '0000-00-00'),
(4, 5, 0, 'Mitarbeiter', '', '', '', '2013-10-24', '0000-00-00'),
(5, 6, 0, 'Lieferant', '', '', '', '2013-10-24', '0000-00-00'),
(6, 6, 0, 'Kunde', '', '', '', '2013-10-24', '0000-00-00'),
(7, 7, 0, 'Lieferant', '', '', '', '2013-10-24', '0000-00-00'),
(8, 7, 0, 'Kunde', '', '', '', '2013-10-24', '0000-00-00'),
(9, 8, 0, 'Kunde', '', 'Projekt', '2', '2013-10-24', '0000-00-00'),
(10, 8, 0, 'Kunde', '', 'Projekt', '3', '2013-10-24', '0000-00-00'),
(11, 9, 0, 'Kunde', '', '', '', '2013-10-24', '0000-00-00'),
(12, 1, 0, 'Mitarbeiter', '', '', '', '2013-10-24', '0000-00-00'),
(13, 10, 0, 'Mitarbeiter', '', 'Projekt', '2', '2013-10-24', '0000-00-00');

--
-- Daten für Tabelle `angebot`
--

INSERT INTO `angebot` (`id`, `datum`, `gueltigbis`, `projekt`, `belegnr`, `bearbeiter`, `anfrage`, `auftrag`, `freitext`, `internebemerkung`, `status`, `adresse`, `retyp`, `rechnungname`, `retelefon`, `reansprechpartner`, `retelefax`, `reabteilung`, `reemail`, `reunterabteilung`, `readresszusatz`, `restrasse`, `replz`, `reort`, `reland`, `name`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `plz`, `ort`, `land`, `ustid`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `versandart`, `vertrieb`, `zahlungsweise`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `gesamtsumme`, `bank_inhaber`, `bank_institut`, `bank_blz`, `bank_konto`, `kreditkarte_typ`, `kreditkarte_inhaber`, `kreditkarte_nummer`, `kreditkarte_pruefnummer`, `kreditkarte_monat`, `kreditkarte_jahr`, `abweichendelieferadresse`, `abweichenderechnungsadresse`, `liefername`, `lieferabteilung`, `lieferunterabteilung`, `lieferland`, `lieferstrasse`, `lieferort`, `lieferplz`, `lieferadresszusatz`, `lieferansprechpartner`, `liefertelefon`, `liefertelefax`, `liefermail`, `autoversand`, `keinporto`, `ust_befreit`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `inbearbeitung`, `vermerk`, `logdatei`, `ansprechpartner`, `keinsteuersatz`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `ohne_briefpapier`) VALUES
(1, '2013-10-24', '2013-11-21', '2', 100000, '1', '', '', '', '', 'freigegeben', 4, '', '', '', '', '', '', '', '', '', '', '', '', '', 'Kunde Shop 1', '', '', 'Straße 3', '', '22222', 'Vorstadt', 'DE', '', 'kunde@wawision.de', '', '', '', '', '', 'Administrator', 'rechnung', 14, 0, 0, 22.1340, '', '', 0, 0, '', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 1, 0, '0000-00-00 00:00:00', '', '', 0, '', '2013-10-24 12:58:00', 'Peter Kunde', NULL, 0, 0, 0, 0);

--
-- Daten für Tabelle `angebot_position`
--

INSERT INTO `angebot_position` (`id`, `angebot`, `artikel`, `projekt`, `bezeichnung`, `beschreibung`, `internerkommentar`, `nummer`, `menge`, `preis`, `waehrung`, `lieferdatum`, `vpe`, `sort`, `status`, `umsatzsteuer`, `bemerkung`, `geliefert`, `logdatei`, `rabatt`) VALUES
(1, 1, 1, 2, 'Rote Tomaten', '', '', '700001', 12, 1.5500, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 0, '2013-10-24 12:57:54', 0);

--
-- Daten für Tabelle `angebot_protokoll`
--

INSERT INTO `angebot_protokoll` (`id`, `angebot`, `zeit`, `bearbeiter`, `grund`) VALUES
(1, 1, '2013-10-24 14:57:39', 'Administrator', 'Angebot angelegt'),
(2, 1, '2013-10-24 14:58:00', 'Administrator', 'Angebot freigegeben');

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`id`, `typ`, `nummer`, `checksum`, `projekt`, `inaktiv`, `ausverkauft`, `warengruppe`, `name_de`, `name_en`, `kurztext_de`, `kurztext_en`, `beschreibung_de`, `beschreibung_en`, `uebersicht_de`, `uebersicht_en`, `links_de`, `links_en`, `startseite_de`, `startseite_en`, `standardbild`, `herstellerlink`, `hersteller`, `teilbar`, `nteile`, `seriennummern`, `lager_platz`, `lieferzeit`, `lieferzeitmanuell`, `sonstiges`, `gewicht`, `endmontage`, `funktionstest`, `artikelcheckliste`, `stueckliste`, `juststueckliste`, `barcode`, `hinzugefuegt`, `pcbdecal`, `lagerartikel`, `porto`, `chargenverwaltung`, `provisionsartikel`, `gesperrt`, `sperrgrund`, `geloescht`, `gueltigbis`, `umsatzsteuer`, `klasse`, `adresse`, `shopartikel`, `unishopartikel`, `journalshopartikel`, `shop`, `katalog`, `katalogtext_de`, `katalogtext_en`, `katalogbezeichnung_de`, `katalogbezeichnung_en`, `neu`, `topseller`, `startseite`, `wichtig`, `mindestlager`, `mindestbestellung`, `partnerprogramm_sperre`, `internerkommentar`, `intern_gesperrt`, `intern_gesperrtuser`, `intern_gesperrtgrund`, `inbearbeitung`, `inbearbeitunguser`, `cache_lagerplatzinhaltmenge`, `internkommentar`, `firma`, `logdatei`, `anabregs_text`, `autobestellung`, `produktion`, `herstellernummer`, `restmenge`, `lieferzeitmanuell_en`, `variante`, `variante_von`, `produktioninfo`, `sonderaktion`, `sonderaktion_en`, `autolagerlampe`, `freifeld1`, `freifeld2`, `freifeld3`, `freifeld4`, `freifeld5`, `freifeld6`) VALUES
(1, 'produkt', '700001', '57d77df8056675ff94d73d2320a44034', 2, '', 0, '', 'Rote Tomaten', 'Red Tomatos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '2', 'green', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 1, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2013-10-24 12:56:22', '', 0, 0, '', 0, '', 0, 0, '', '', '', 0, '', '', '', '', '', ''),
(2, 'produkt', '700002', '142239180bd5a6cfbddfb24136a069ab', 2, '', 0, '', 'Rote Zwiebeln', 'Red Onion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'lager', '', '', '', '', '', '', 0, 0, '', '', '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 1, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2012-10-30 15:41:45', '', 0, 0, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', ''),
(3, 'produkt', '700003', 'f57f023e695f074e257639dcc97029ac', 2, '', 0, '', 'Weiße Zwiebeln', 'White Onions', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'green', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 1, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2012-10-30 15:40:24', '', 0, 0, '', 0, '', 0, 0, '', '', '', 0, '', '', '', '', '', ''),
(4, 'produkt', '700004', 'c2fa7659242dafb1931c2320c829a6b8', 2, '', 0, '', 'Junge Tomaten', 'Young Tomatos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'green', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 1, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2012-10-30 15:40:24', '', 0, 0, '', 0, '', 0, 0, '', '', '', 0, '', '', '', '', '', ''),
(5, 'produkt', '700005', '94f5f73147766d6e04e8919a91f383f9', 2, '', 0, '', 'Ungespritzte Bananen', 'Unsprayed bananas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '2', 'green', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 6, 0, 0, 0, 1, 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2013-10-24 12:40:48', '', 0, 0, '', 0, '', 0, 0, '', '', '', 0, '', '', '', '', '', ''),
(6, 'produktion', '400001', '', 3, '', 0, '', 'Gehäuse Oberschale', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'green', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 1, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 2, 0, '', '', '', '', 0, 1, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2013-10-24 12:19:18', '', 0, 0, '', 0, '', 0, 0, '', '', '', 0, '', '', '', '', '', ''),
(7, 'produktion', '400002', '', 3, '', 0, '', 'Gehäuse Unterschale', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'green', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 1, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 2, 0, '', '', '', '', 1, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2013-10-24 12:19:32', '', 0, 0, '', 0, '', 0, 0, '', '', '', 0, '', '', '', '', '', ''),
(8, 'produkt', '700006', '', 2, '', 0, '', 'Unser innovatives Produkt 1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '1', 'green', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 1, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2013-10-24 12:35:43', '', 0, 0, '', 0, '', 0, 0, '', '', '', 0, '', '', '', '', '', ''),
(9, 'fremdleistung', '100001', '', 2, '', 0, '', 'Versandkosten Shop', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'green', '', '', '', '', '', '', 0, 0, '', '', '', 0, 1, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2013-10-24 12:28:01', '', 0, 0, '', 0, '', 0, 0, '', '', '', 0, '', '', '', '', '', '');

--
-- Daten für Tabelle `artikelgruppen`
--

INSERT INTO `artikelgruppen` (`id`, `bezeichnung`, `bezeichnung_en`, `shop`, `aktiv`, `beschreibung_de`, `beschreibung_en`) VALUES
(1, 'Zwiebeln', 'Onions', 1, 1, NULL, NULL),
(2, 'Bananen', 'Bananas', 1, 1, NULL, NULL),
(3, 'Tomaten', 'Tomatos', 1, 1, NULL, NULL);

--
-- Daten für Tabelle `artikel_artikelgruppe`
--

INSERT INTO `artikel_artikelgruppe` (`id`, `artikel`, `artikelgruppe`, `position`, `geloescht`) VALUES
(1, 2, 1, 0, 0),
(2, 1, 2, 0, 0),
(3, 3, 1, 0, 0),
(4, 4, 2, 0, 0),
(5, 5, 3, 0, 0);

--
-- Daten für Tabelle `aufgabe`
--

INSERT INTO `aufgabe` (`id`, `adresse`, `aufgabe`, `beschreibung`, `prio`, `projekt`, `kostenstelle`, `initiator`, `angelegt_am`, `startdatum`, `startzeit`, `intervall_tage`, `stunden`, `abgabe_bis`, `abgeschlossen`, `abgeschlossen_am`, `sonstiges`, `bearbeiter`, `logdatei`, `startseite`, `emailerinnerung`, `emailerinnerung_tage`, `vorankuendigung`, `status`, `ganztags`) VALUES
(1, 5, 'Bananen kaufen oder leasen', '', '1', 0, 0, 1, '2013-10-24', '0000-00-00', '00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, 0, 0, 'offen', 0),
(2, 10, 'zur Startup-Night gehen', '', '1', 0, 0, 1, '2013-10-24', '0000-00-00', '00:00:00', 0, 0, '0000-00-00 00:00:00', 0, '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, 0, 0, 'offen', 0);

--
-- Daten für Tabelle `auftrag`
--

INSERT INTO `auftrag` (`id`, `datum`, `art`, `projekt`, `belegnr`, `internet`, `bearbeiter`, `angebot`, `freitext`, `internebemerkung`, `status`, `adresse`, `name`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `ansprechpartner`, `plz`, `ort`, `land`, `ustid`, `ust_befreit`, `ust_inner`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `versandart`, `vertrieb`, `zahlungsweise`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `bank_inhaber`, `bank_institut`, `bank_blz`, `bank_konto`, `kreditkarte_typ`, `kreditkarte_inhaber`, `kreditkarte_nummer`, `kreditkarte_pruefnummer`, `kreditkarte_monat`, `kreditkarte_jahr`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `autoversand`, `keinporto`, `keinestornomail`, `abweichendelieferadresse`, `liefername`, `lieferabteilung`, `lieferunterabteilung`, `lieferland`, `lieferstrasse`, `lieferort`, `lieferplz`, `lieferadresszusatz`, `lieferansprechpartner`, `packstation_inhaber`, `packstation_station`, `packstation_ident`, `packstation_plz`, `packstation_ort`, `autofreigabe`, `freigabe`, `nachbesserung`, `gesamtsumme`, `inbearbeitung`, `abgeschlossen`, `nachlieferung`, `lager_ok`, `porto_ok`, `ust_ok`, `check_ok`, `vorkasse_ok`, `nachnahme_ok`, `reserviert_ok`, `partnerid`, `folgebestaetigung`, `zahlungsmail`, `stornogrund`, `stornosonstiges`, `stornorueckzahlung`, `stornobetrag`, `stornobankinhaber`, `stornobankkonto`, `stornobankblz`, `stornobankbank`, `stornogutschrift`, `stornogutschriftbeleg`, `stornowareerhalten`, `stornomanuellebearbeitung`, `stornokommentar`, `stornobezahlt`, `stornobezahltam`, `stornobezahltvon`, `stornoabgeschlossen`, `stornorueckzahlungper`, `stornowareerhaltenretour`, `partnerausgezahlt`, `partnerausgezahltam`, `kennen`, `logdatei`, `keinetrackingmail`, `zahlungsmailcounter`, `keinsteuersatz`, `angebotid`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `ohne_briefpapier`) VALUES
(1, '2013-09-01', 'standardauftrag', '2', 200000, '', 'Administrator', '', '', '', 'abgeschlossen', 4, 'Kunde Shop 1', '', '', 'Straße 3', '', 'Peter Kunde', '22222', 'Vorstadt', 'DE', '', 0, 0, 'kunde@wawision.de', '', '', '', '10000', 'versandunternehmen', 'Administrator', 'rechnung', 14, 0, 0, '', '', '', '', 'MasterCard', '', '', '', '1', '2009', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', 'DE', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 399.85, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2013-10-24 12:45:55', 0, 0, 0, 0, 0, 0, 0, 0),
(2, '2013-09-01', 'standardauftrag', '2', 200001, '', 'Administrator', '', '', '', 'freigegeben', 4, 'Kunde Shop 1', '', '', 'Straße 3', '', 'Peter Kunde', '22222', 'Vorstadt', 'DE', '', 0, 0, 'kunde@wawision.de', '', '', '', '10000', 'versandunternehmen', 'Administrator', 'rechnung', 14, 0, 0, '', '', '', '', 'MasterCard', '', '', '', '1', '2009', 1, 0, '0000-00-00 00:00:00', '', '', 1, 1, 0, 0, '', '', '', 'DE', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 8.32, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2013-10-24 12:45:34', 0, 0, 0, 0, 0, 0, 0, 0),
(3, '2013-09-03', 'standardauftrag', '2', 200002, '', 'Administrator', '', 'Ihre Bestellnummer: 34543617', '', 'abgeschlossen', 8, 'Bester Kunde 1', '', '', 'Uferweg 5', '', '', '86152', 'Augsburg', 'DE', '', 0, 0, 'kunde@wawision.de', '', '', '', '10003', 'versandunternehmen', 'Administrator', 'rechnung', 30, 10, 2, '', '', '', '', 'MasterCard', '', '', '', '1', '2009', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', 'DE', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 3171.15, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2013-11-15 15:39:04', 0, 0, 0, 0, 0, 0, 0, 0),
(4, '2013-10-24', 'standardauftrag', '2', 200003, '', 'Administrator', '', '', '', 'freigegeben', 4, 'Kunde Shop 1', '', '', 'Straße 3', '', 'Peter Kunde', '22222', 'Vorstadt', 'DE', '', 0, 0, 'kunde@wawision.de', '', '', '', '10000', 'versandunternehmen', 'Administrator', 'paypal', 14, 0, 0, '', '', '', '', 'MasterCard', '', '', '', '1', '2009', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', 'DE', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 2.77, 0, 0, 0, 1, 0, 1, 1, 0, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2013-10-24 12:54:57', 0, 0, 0, 0, 0, 0, 0, 0),
(5, '2013-10-24', '', '2', 200004, '', 'Administrator', '', '', '', 'freigegeben', 8, 'Bester Kunde 1', '', '', 'Uferweg 5', '', '', '86152', 'Augsburg', 'DE', '', 0, 0, 'kunde@wawision.de', '', '', '', '10003', 'versandunternehmen', 'Administrator', 'rechnung', 14, 0, 0, '', '', '', '', '', '', '', '', '', '', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 29.71, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2013-10-24 18:39:11', NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(7, '2013-10-24', '', '1', 200005, '', 'Administrator', '', '', '', 'abgeschlossen', 6, 'Lieferant Catering', '', '', '', '', '', '', '', 'DE', '', 0, 0, '', '', '', '', '10001', 'versandunternehmen', 'Administrator', 'rechnung', 14, 0, 0, '', '', '', '', '', '', '', '', '', '', 1, 1, '2013-10-24 15:06:15', 'telefon', 'Administrator', 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 11880.95, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2013-11-15 15:39:04', NULL, NULL, NULL, NULL, 1, 0, 0, 0),
(8, '2013-10-24', '', '2', 200006, '', 'Administrator', '', '', '', 'freigegeben', 9, 'Kunde 2', '', '', 'Hauptstraße 24', '', '', '86150', 'Augsburg', 'DE', '', 0, 0, 'kunde@wawision.de', '', '', '', '10004', 'versandunternehmen', 'Administrator', 'rechnung', 14, 0, 0, '', '', '', '', '', '', '', '', '', '', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 598.95, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2013-11-15 15:40:03', NULL, NULL, NULL, NULL, 0, 0, 0, 0);

--
-- Daten für Tabelle `auftrag_position`
--

INSERT INTO `auftrag_position` (`id`, `auftrag`, `artikel`, `projekt`, `bezeichnung`, `beschreibung`, `internerkommentar`, `nummer`, `menge`, `preis`, `waehrung`, `lieferdatum`, `vpe`, `sort`, `status`, `umsatzsteuer`, `bemerkung`, `geliefert`, `geliefert_menge`, `explodiert`, `explodiert_parent`, `logdatei`, `rabatt`) VALUES
(1, 1, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', 1, 332.6891, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 1, 1, 0, 0, '2013-10-24 12:45:55', 0),
(2, 1, 9, 1, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 12:29:13', 0),
(3, 2, 5, 2, 'Ungespritzte Bananen', '', '', '700005', 3, 2.3300, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 12:41:28', 0),
(4, 3, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', 8, 332.6891, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 1, 8, 0, 0, '2013-11-15 15:39:04', 0),
(5, 3, 9, 1, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 12:44:24', 0),
(6, 4, 5, 2, 'Ungespritzte Bananen', '', '', '700005', 1, 2.3300, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 12:54:32', 0),
(7, 5, 1, 2, 'Rote Tomaten', '', '', '700001', 1, 1.5500, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 12:56:57', 0),
(8, 5, 4, 2, 'Junge Tomaten', '', '', '700004', 15, 1.3400, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 12:57:09', 0),
(9, 5, 9, 1, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 3, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 12:57:16', 0),
(12, 7, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', 30, 332.6891, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 1, 30, 0, 0, '2013-11-15 15:39:04', 0),
(13, 7, 9, 2, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 13:05:55', 0),
(14, 8, 7, 3, 'Gehäuse Unterschale', '', '', '400002', 100, 5.0000, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 13:08:27', 0),
(15, 8, 9, 2, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', 0, 0, 0, 0, '2013-10-24 13:08:32', 0);

--
-- Daten für Tabelle `auftrag_protokoll`
--

INSERT INTO `auftrag_protokoll` (`id`, `auftrag`, `zeit`, `bearbeiter`, `grund`) VALUES
(1, 1, '2013-10-24 14:25:02', 'Administrator', 'Auftrag angelegt'),
(2, 1, '2013-10-24 14:27:36', 'Administrator', 'Auftrag freigegeben'),
(3, 2, '2013-10-24 14:41:12', 'Administrator', 'Auftrag angelegt'),
(4, 2, '2013-10-24 14:41:39', 'Administrator', 'Auftrag freigegeben'),
(5, 3, '2013-10-24 14:43:42', 'Administrator', 'Auftrag angelegt'),
(6, 3, '2013-10-24 14:44:55', 'Administrator', 'Auftrag freigegeben'),
(7, 4, '2013-10-24 14:54:25', 'Administrator', 'Auftrag angelegt'),
(8, 4, '2013-10-24 14:54:57', 'Administrator', 'Auftrag freigegeben'),
(9, 5, '2013-10-24 14:56:38', 'Administrator', 'Auftrag angelegt'),
(10, 5, '2013-10-24 14:57:18', 'Administrator', 'Auftrag freigegeben'),
(12, 7, '2013-10-24 15:05:31', 'Administrator', 'Auftrag angelegt'),
(13, 7, '2013-10-24 15:05:59', 'Administrator', 'Auftrag freigegeben'),
(14, 7, '2013-10-24 15:06:15', 'Administrator', 'Auftrag versendet'),
(15, 8, '2013-10-24 15:07:49', 'Administrator', 'Auftrag angelegt'),
(16, 8, '2013-10-24 15:08:34', 'Administrator', 'Auftrag freigegeben');

--
-- Daten für Tabelle `backup`
--

INSERT INTO `backup` (`id`, `adresse`, `name`, `dateiname`, `datum`) VALUES
(1, 1, 'Messedemo', '2013-10-24_Messedemo.sql', '2013-10-24 14:31:19'),
(2, 1, 'Demoshop', '2013-10-24_Demoshop.sql', '2013-10-24 15:19:00');

--
-- Daten für Tabelle `bestellung`
--

INSERT INTO `bestellung` (`id`, `datum`, `projekt`, `bestellungsart`, `belegnr`, `bearbeiter`, `angebot`, `freitext`, `internebemerkung`, `status`, `adresse`, `name`, `vorname`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `plz`, `ort`, `land`, `abweichendelieferadresse`, `liefername`, `lieferabteilung`, `lieferunterabteilung`, `lieferland`, `lieferstrasse`, `lieferort`, `lieferplz`, `lieferadresszusatz`, `lieferansprechpartner`, `ustid`, `ust_befreit`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `lieferantennummer`, `versandart`, `lieferdatum`, `einkaeufer`, `keineartikelnummern`, `zahlungsweise`, `zahlungsstatus`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `gesamtsumme`, `bank_inhaber`, `bank_institut`, `bank_blz`, `bank_konto`, `paypalaccount`, `bestellbestaetigung`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `logdatei`, `artikelnummerninfotext`, `ansprechpartner`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `ohne_briefpapier`) VALUES
(1, '2013-10-24', '1', '', 100000, '1', '', '', '', 'versendet', 7, 'Prototypenbau', '', '', '', '', '', '', '', 'DE', 0, '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '70003', '', '0000-00-00', 'Administrator', 0, '', '', 0, 0, 0, 4199.9985, '', '', 0, 0, '', 0, 1, 1, '2013-10-24 15:05:21', 'telefon', 'Administrator', '2013-10-24 13:05:21', 1, NULL, 1, 0, 0, 0),
(2, '2013-10-24', '1', '', 100001, '1', '', '', '', 'storniert', 7, 'Prototypenbau', '', '', '', '', '', '', '', 'DE', 0, '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '70003', '', '0000-00-00', 'Administrator', 0, '', '', 0, 0, 0, 115.0016, '', '', 0, 0, '', 0, 1, 1, '2013-10-24 15:10:32', 'brief', 'Administrator', '2013-10-24 13:11:13', 1, NULL, 0, 0, 0, 0);

--
-- Daten für Tabelle `bestellung_position`
--

INSERT INTO `bestellung_position` (`id`, `bestellung`, `artikel`, `projekt`, `bezeichnunglieferant`, `bestellnummer`, `beschreibung`, `menge`, `preis`, `waehrung`, `lieferdatum`, `vpe`, `sort`, `status`, `umsatzsteuer`, `bemerkung`, `geliefert`, `mengemanuellgeliefertaktiviert`, `manuellgeliefertbearbeiter`, `abgerechnet`, `logdatei`, `abgeschlossen`) VALUES
(1, 1, 8, 2, 'Prototyp 1', 'Prototyp45668719', '', 35, 100.8403, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 0, 0, '', 0, '2013-10-24 13:05:05', NULL),
(2, 2, 7, 3, 'Gehäuse Unterschale ', 'Artikel 1562', '', 50, 1.9328, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', 0, 0, '', 0, '2013-10-24 13:10:24', NULL);

--
-- Daten für Tabelle `bestellung_protokoll`
--

INSERT INTO `bestellung_protokoll` (`id`, `bestellung`, `zeit`, `bearbeiter`, `grund`) VALUES
(1, 1, '2013-10-24 15:04:48', 'Administrator', 'Bestellung angelegt'),
(2, 1, '2013-10-24 15:05:10', 'Administrator', 'Bestellung freigegeben'),
(3, 1, '2013-10-24 15:05:21', 'Administrator', 'Bestellung versendet'),
(4, 2, '2013-10-24 15:08:53', 'Administrator', 'Bestellung angelegt'),
(5, 2, '2013-10-24 15:10:28', 'Administrator', 'Bestellung freigegeben'),
(6, 2, '2013-10-24 15:10:32', 'Administrator', 'Bestellung versendet');

--
-- Daten für Tabelle `datei`
--

INSERT INTO `datei` (`id`, `titel`, `beschreibung`, `nummer`, `geloescht`, `logdatei`, `firma`) VALUES
(1, 'Bananen', '', '', 0, '2013-10-24 12:37:08', 1),
(2, 'Bananen_Gruppenbild', '', '', 0, '2013-10-24 12:37:24', 1),
(3, '', '', '', 0, '2013-10-24 12:46:45', 1),
(4, '', '', '', 0, '2013-10-24 12:53:10', 1),
(5, '', '', '', 0, '2013-10-24 13:05:21', 1),
(6, '', '', '', 0, '2013-10-24 13:06:15', 1),
(7, '', '', '', 0, '2013-10-24 13:10:32', 1),
(8, 'Rechnung von Paketannahme 1', 'Dokument aus Paket', '', 0, '2013-10-24 18:54:41', 1),
(9, 'Lieferschein von Paketannahme 1', 'Dokument aus Paket', '', 0, '2013-10-24 18:55:01', 1);

--
-- Daten für Tabelle `datei_stichwoerter`
--

INSERT INTO `datei_stichwoerter` (`id`, `datei`, `subjekt`, `objekt`, `parameter`, `logdatei`) VALUES
(1, 1, 'Shopbild', 'Artikel', '5', '2013-10-24 12:37:08'),
(2, 2, 'Gruppenbild', 'Artikel', '5', '2013-10-24 12:37:24'),
(3, 3, 'rechnung', 'rechnung', '2', '2013-10-24 12:46:45'),
(4, 4, 'rechnung', 'rechnung', '4', '2013-10-24 12:53:10'),
(5, 5, 'bestellung', 'bestellung', '1', '2013-10-24 13:05:21'),
(6, 6, 'auftrag', 'auftrag', '7', '2013-10-24 13:06:15'),
(7, 7, 'bestellung', 'bestellung', '2', '2013-10-24 13:10:32'),
(8, 8, 'Rechnung', 'Paketannahme', '1', '2013-10-24 18:54:41'),
(9, 9, 'Lieferschein', 'Paketannahme', '1', '2013-10-24 18:55:01');

--
-- Daten für Tabelle `datei_version`
--

INSERT INTO `datei_version` (`id`, `datei`, `ersteller`, `datum`, `version`, `dateiname`, `bemerkung`, `logdatei`) VALUES
(1, 1, 'Administrator', '2013-10-24', 1, 'bananen.jpg', 'Initiale Version', '2013-10-24 12:37:08'),
(2, 2, 'Administrator', '2013-10-24', 1, 'bananen.jpg', 'Initiale Version', '2013-10-24 12:37:24'),
(3, 3, 'Administrator', '2013-10-24', 1, '20130904_RE400001.pdf', 'Initiale Version', '2013-10-24 12:46:45'),
(4, 4, 'Administrator', '2013-10-24', 1, '20131024_RE400003.pdf', 'Initiale Version', '2013-10-24 12:53:10'),
(5, 5, 'Administrator', '2013-10-24', 1, '20131024_BE100000.pdf', 'Initiale Version', '2013-10-24 13:05:21'),
(6, 6, 'Administrator', '2013-10-24', 1, '20131024_AB200005.pdf', 'Initiale Version', '2013-10-24 13:06:15'),
(7, 7, 'Administrator', '2013-10-24', 1, '20131024_BE100001.pdf', 'Initiale Version', '2013-10-24 13:10:32');

--
-- Daten für Tabelle `dokumente_send`
--

--
-- Daten für Tabelle `einkaufspreise`
--

INSERT INTO `einkaufspreise` (`id`, `artikel`, `adresse`, `objekt`, `projekt`, `preis`, `waehrung`, `ab_menge`, `vpe`, `preis_anfrage_vom`, `gueltig_bis`, `lieferzeit_standard`, `lieferzeit_aktuell`, `lager_lieferant`, `datum_lagerlieferant`, `bestellnummer`, `bezeichnunglieferant`, `sicherheitslager`, `bemerkung`, `bearbeiter`, `logdatei`, `standard`, `geloescht`, `firma`) VALUES
(1, 5, 6, 'Standard', '', 2.4369, 'EUR', 1, '1', '2013-10-08', '0000-00-00', 1, 1, 0, '0000-00-00', '80471890', 'Bananen_ungespritzt', 0, '', '', '0000-00-00 00:00:00', 1, 0, 1),
(2, 8, 7, 'Standard', '', 100.8403, 'EUR', 1, '1', '2013-10-01', '0000-00-00', 4, 4, 0, '0000-00-00', 'Prototyp45668719', 'Prototyp 1', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1),
(3, 7, 7, 'Standard', '', 1.9328, 'EUR', 1, '1', '2013-09-03', '0000-00-00', 2, 2, 0, '0000-00-00', 'Artikel 1562', 'Gehäuse Unterschale ', 0, '', '', '0000-00-00 00:00:00', 1, 0, 1);

--
-- Daten für Tabelle `firma`
--

INSERT INTO `firma` (`id`, `name`, `standardprojekt`) VALUES
(1, 'Musterfirma', 1);

--
-- Daten für Tabelle `firmendaten`
--

INSERT INTO `firmendaten` (`id`, `firma`, `absender`, `sichtbar`, `barcode`, `schriftgroesse`, `betreffszeile`, `dokumententext`, `tabellenbeschriftung`, `tabelleninhalt`, `zeilenuntertext`, `freitext`, `infobox`, `spaltenbreite`, `footer_0_0`, `footer_0_1`, `footer_0_2`, `footer_0_3`, `footer_0_4`, `footer_0_5`, `footer_1_0`, `footer_1_1`, `footer_1_2`, `footer_1_3`, `footer_1_4`, `footer_1_5`, `footer_2_0`, `footer_2_1`, `footer_2_2`, `footer_2_3`, `footer_2_4`, `footer_2_5`, `footer_3_0`, `footer_3_1`, `footer_3_2`, `footer_3_3`, `footer_3_4`, `footer_3_5`, `footersichtbar`, `hintergrund`, `logo`, `logo_type`, `briefpapier`, `briefpapier_type`, `benutzername`, `passwort`, `host`, `port`, `mailssl`, `signatur`, `email`, `absendername`, `bcc1`, `bcc2`, `firmenfarbe`, `name`, `strasse`, `plz`, `ort`, `steuernummer`, `startseite_wiki`, `datum`, `projekt`, `brieftext`, `next_angebot`, `next_auftrag`, `next_gutschrift`, `next_lieferschein`, `next_bestellung`, `next_rechnung`, `next_kundennummer`, `next_lieferantennummer`, `next_mitarbeiternummer`, `next_waren`, `next_sonstiges`, `next_produktion`, `next_arbeitsnachweis`, `next_produktionen`, `seite_von_ausrichtung`, `seite_von_sichtbar`, `rechnung_header`, `lieferschein_header`, `angebot_header`, `auftrag_header`, `gutschrift_header`, `bestellung_header`, `arbeitsnachweis_header`, `rechnung_footer`, `lieferschein_footer`, `angebot_footer`, `auftrag_footer`, `gutschrift_footer`, `bestellung_footer`, `arbeitsnachweis_footer`, `rechnung_ohnebriefpapier`, `lieferschein_ohnebriefpapier`, `angebot_ohnebriefpapier`, `auftrag_ohnebriefpapier`, `gutschrift_ohnebriefpapier`, `bestellung_ohnebriefpapier`, `arbeitsnachweis_ohnebriefpapier`, `eu_lieferung_vermerk`, `abstand_adresszeileoben`, `abstand_boxrechtsoben`, `abstand_betreffzeileoben`, `abstand_artikeltabelleoben`, `wareneingang_kamera_waage`, `layout_iconbar`, `artikel_suche_kurztext`, `parameterundfreifelder`, `freifeld1`, `freifeld2`, `freifeld3`, `freifeld4`, `freifeld5`, `freifeld6`) VALUES
(1, 1, 'Musterfirma GmbH | Musterweg 5 | 12345 Musterstadt', 1, 0, 7, 9, 9, 9, 9, 7, 9, 8, 0, 'Sitz der Gesellschaft / Lieferanschrift', 'Musterfirma GmbH', 'Musterweg 5', 'D-12345 Musterstadt', 'Telefon +49 123 12 34 56 7', 'Telefax +49 123 12 34 56 78', 'Bankverbindung', 'Musterbank', 'Konto 123456789', 'BLZ 72012345', '', '', 'IBAN DE1234567891234567891', 'BIC/SWIFT DETSGDBWEMN', 'Ust-IDNr. DE123456789', 'E-Mail: info@musterfirma-gmbh.de', 'Internet: http://www.musterfirma.de', '', 'GeschÃ¤ftsfÃ¼hrer', 'Max Musterman', 'Handelsregister: HRB 12345', 'Amtsgericht: Musterstadt', '', '', 0, 'kein', '', '', '', '', '', '', '', '25', 0, 'LS0NCk11c3RlcmZpcm1hIEdtYkgNCk11c3RlcndlZyA1DQpELTEyMzQ1IE11c3RlcnN0YWR0DQoNClRlbCArNDkgMTIzIDEyIDM0IDU2IDcNCkZheCArNDkgMTIzIDEyIDM0IDU2IDc4DQoNCk5hbWUgZGVyIEdlc2VsbHNjaGFmdDogTXVzdGVyZmlybWEgR21iSA0KU2l0eiBkZXIgR2VzZWxsc2NoYWZ0OiBNdXN0ZXJzdGFkdA0KDQpIYW5kZWxzcmVnaXN0ZXI6IE11c3RlcnN0YWR0LCBIUkIgMTIzNDUNCkdlc2Now6RmdHNmw7xocnVuZzogTWF4IE11c3Rlcm1hbg0KVVN0LUlkTnIuOiBERTEyMzQ1Njc4OQ0KDQpBR0I6IGh0dHA6Ly93d3cubXVzdGVyZmlybWEuZGUvDQo=', '', 'Meine Firma', '', '', '', 'Musterfirma GmbH', 'Musterweg 5', '12345', 'Musterstadt', '111/11111/11111', '', '0000-00-00 00:00:00', 0, '11', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '');

--
-- Daten für Tabelle `geschaeftsbrief_vorlagen`
--

INSERT INTO `geschaeftsbrief_vorlagen` (`id`, `sprache`, `betreff`, `text`, `subjekt`, `projekt`, `firma`) VALUES
(1, 'deutsch', 'Bestellung von {FIRMA}', 'Sehr geehrter Lieferant,\r\n\r\nanbei übersenden wir Ihnen unsere Bestellung zu. Bitte senden Sie uns als Bestätigung für den Empfang eine Auftragsbestätigung per Fax an: +49 821 27 95 99 20.', 'Bestellung', 1, 1),
(2, 'englisch', 'Order {FIRMA}', 'Dear Sir or Madam,\r\n\r\nenclosed we send our order. \r\nPlease send as acknowledgment a fax to the following number: +49 821 27 95 99 20 or send us an e-mail.', 'Bestellung', 1, 1),
(3, 'deutsch', 'Betreff: {BETREFF}', 'Sehr geehrter {NAME}', 'Korrespondenz', 1, 1),
(7, 'deutsch', 'Auftragsbestätigung von {FIRMA}', 'Sehr geehrter Kunde,\r\n\r\nanbei übersenden wir Ihnen Ihre Auftragsbestätigung. ', 'Auftrag', 1, 1),
(5, 'deutsch', 'Lieferschein von {FIRMA}', 'Sehr geehrter Kunde,\r\n\r\nanbei übersenden wir Ihnen unseren Lieferschein zu.', 'Lieferschein', 1, 1),
(6, 'deutsch', 'Ihr Angebot von {FIRMA}', 'Sehr geehrter Herr \r\n\r\n\r\nanbei das gewünschte Angebot. Wir hoffen Ihnen die passenden Artikel anbieten zu können.', 'Angebot', 1, 1),
(8, 'deutsch', 'Ihre Rechnung von {FIRMA}', 'Sehr geehrter Herr/Frau {NAME},\r\n\r\n\r\nanbei finden Sie Ihre Rechnung. Gerne stehen wir Ihnen weiterhin zur Verfügung.\r\n\r\nIhre Rechnung ist im PDF-Format erstellt worden. Um sich die Rechnung ansehen zu können, klicken Sie auf den Anhang und es öffnet sich automatisch der Acrobat Reader. Sollten Sie keinen Acrobat Reader besitzen, haben wir für Sie den Link zum kostenlosen Download von Adobe Acrobat Reader mit angegeben. Er führt Sie automatisch auf die Downloadseite von Adobe. So können Sie sich Ihre Rechnung auch für Ihre Unterlagen ausdrucken.\r\n\r\nhttp://www.adobe.com/products/acrobat/readstep2.html', 'Rechnung', 1, 1),
(9, 'deutsch', 'Versand Ihrer Bestellung von {FIRMA}', 'Sehr geehrter Kunde,\r\n\r\nsoeben wurde Ihr Bestellung zusammengestellt und wird in Kürze unserem Versandunternehmen übergeben.\r\n\r\n{VERSAND}\r\n\r\nIhr {FIRMA} Team\r\n', 'Versand', 1, 1),
(10, 'deutsch', 'Eingang Ihrer Zahlung', 'Sehr geehrter Kunde,\r\n\r\n\r\nIhre Zahlung zum Auftrag Nr. {AUFTRAG} vom {DATUM} in Höhe von {GESAMT} EUR konnte zugeordnet werden.\r\n\r\n\r\nVielen Dank.\r\n\r\nIhr {FIRMA} Team\r\n', 'ZahlungOK', 1, 1),
(11, 'deutsch', 'Fehlbetrag bei Eingang Ihrer Zahlung', 'Sehr geehrter Kunde,\r\n\r\nbezüglich Ihrer Zahlung zum Auftrag Nr. {AUFTRAG} vom {DATUM} in Höhe von {GESAMT} EUR gab es bei der Zuordnung eine Zahlungsdifferenz von {REST} EUR.\r\n\r\n\r\nBitte überweisen Sie noch den Fehlbetrag in Höhe von {REST} EUR mit dem angegebenen Verwendungszweck auf unser Konto:\r\n\r\nVerwendungszweck: {AUFTRAG}\r\n\r\n{FIRMA}\r\nBLZ: 123456\r\nKonto Nr.: 987654321\r\n\r\nFür Ausland:\r\n\r\nIBAN: DE123456\r\nBIC: DEUTDEMM720\r\n\r\nBitte beachten Sie bei der Zahlung: eventuelle Gebühren dürfen nicht zu unseren Lasten gehen.\r\n\r\n\r\nIhr {FIRMA} Team\r\n', 'ZahlungDiff', 1, 1),
(12, 'deutsch', 'Stornierung Ihres Auftrags', 'Sehr geehrter Kunde,\r\n\r\n\r\nIhr Auftrag Nr. {AUFTRAG} vom {DATUM} wurde soeben aus unserem System storniert.\r\n\r\nBereits bezahltes Auftragsguthaben erstatten wir Ihnen in den nächsten Tagen auf dem gleichen Weg (Bank, Paypal, Kreditkarte, etc.) Ihrer Zahlung zurück. \r\n\r\nSollten Daten für die Zahlung fehlen, wird ein Sachbearbeiter mit Ihnen Kontakt aufnehmen.\r\n\r\nVielen Dank.\r\n\r\nIhr {FIRMA} Team\r\n', 'Stornierung', 1, 1),
(13, 'deutsch', 'Vorkasse Ihrer Bestellung', 'Sehr geehrter Kunde,\r\n\r\nbezüglich Ihres Auftrags Nr. {AUFTRAG} vom {DATUM} in Höhe von {GESAMT} EUR senden wir Ihnen die Zahlungsinformationen zu. \r\nSollten Sie zwischenzeitlich den Betrag überwiesen haben, sehen Sie diese E-Mail bitte als gegenstandslos an.\r\n\r\nBitte überweisen Sie den Betrag in Höhe von {REST} EUR mit dem angegebenen Verwendungszweck auf unser Konto:\r\n\r\nVerwendungszweck: {AUFTRAG}\r\nBetrag: {REST}\r\n\r\n{FIRMA}\r\nBank: Postbank Nürnberg\r\nBLZ: 76010085\r\nKonto Nr.: 900975857\r\n\r\n\r\nBitte beachten Sie bei der Zahlung: eventuelle Gebühren dürfen nicht zu unseren Lasten gehen.\r\n\r\nZwischenverkauf vorbehalten - sollte ein Artikel ausverkauft sein, werden wir Sie so schnell wie möglich mit der neuen Ware beliefern.\r\n\r\n\r\n\r\nIhr {FIRMA} Team\r\n', 'ZahlungMiss', 1, 1),
(14, 'deutsch', 'Vorkasse Ihrer Bestellung', 'Sehr geehrter Kunde,\r\n\r\nvielen Dank nochmals für Ihre Bestellung.\r\n\r\nBezüglich Ihres Auftrags Nr. {AUFTRAG} vom {DATUM} in Höhe von {GESAMT} EUR senden wir Ihnen die Zahlungsinformationen zu. Sollten Sie \r\nzwischenzeitlich den Betrag bereits überwiesen haben, sehen Sie diese E-Mail bitte als gegenstandslos an.\r\n\r\nBitte überweisen Sie den Betrag in Höhe von {REST} EUR mit dem angegebenen Verwendungszweck auf unser Konto:\r\n\r\nVerwendungszweck: {AUFTRAG}\r\nBetrag: {REST}\r\n\r\n{FIRMA}\r\nBank:Deutsche Bank\r\nBLZ: 1234567\r\nKonto Nr.: 987654321\r\n\r\nFür Ausland:\r\n\r\nIBAN: DE1234567\r\nBIC: DEUTDEMM720\r\n\r\nBitte beachten Sie bei der Zahlung: eventuelle Gebühren dürfen nicht zu unseren Lasten gehen.\r\n\r\n\r\nIhr {FIRMA} Team\r\n', 'ZahlungMiss', 1, 1),
(15, 'deutsch', 'Betriebsurlaub vom 09.08 bis 24.08.2010', 'Liebe Kunden,\r\n\r\nwir sind vom 09.08.2010 bis zum 24.08.2010 im Betriebsurlaub.\r\nIhre Anfragen werden deshalb erst wieder nach diesem Zeitraum bearbeitet.\r\n\r\nIhre Bestellungen werden in dieser Zeit statt täglich wöchentlich versendet.*\r\n\r\nWir wünschen Ihnen eine schöne Ferienzeit und bedanken uns für Ihr Verständnis.\r\n\r\nDas {FIRMA} Team\r\n\r\n\r\n\r\n*sofern sich die Ware bei uns im Lager befindet.', 'Betriebsurlaub', 0, 1),
(16, 'deutsch', 'Ihre Bestellung: Informationen Artikel {ARTIKEL}', 'Sehr geehrter {FIRMA} Kunde,\r\n\r\nvielen Dank für Ihre Bestellung. Auf Grund der großen\r\nNachfrage konnten wir nicht sofort alle Bestellungen \r\naufnehmen und beantworten.\r\n\r\nLeider gibt es bei dem Artikel {ARTIKEL} einen Lieferengpass. \r\nDie vorhandenen Artikel aus dem Lager sind an die schnellsten \r\nKäufer versendet worden.\r\n\r\n\r\nDa wir ein kleines Unternehmen sind und unser Lager nicht \r\nstündlich aktualisieren, wurde der Artikel leider nicht \r\nrechtzeitig gesperrt. \r\n\r\n\r\nBitte teilen Sie uns über folgenden Link mit, wie wir mit Ihrer \r\nBestellung verfahren sollen (es gibt einen kompatiblen \r\nErsatzartikel welcher im Lager vorhanden ist).\r\n\r\n\r\n===== LINK ZUR AUSWAHL ======\r\n\r\nhttp://www.eproo.de/index.php?module=exportlink&regkey={REG}\r\n\r\n===== LINK ZUR AUSWAHL ======\r\n\r\nInfo zu Alternativen bei uns im Shop:\r\nDer Prozessor der Familie XXX (kompatibel zu YYY \r\nmit ausreichend Flash) befindet sich noch auf folgenden Produkt:\r\n\r\n\r\nZZZ (aus unserem Online-Shop), welcher einen \r\nkompatiblen Prozessor zum YYY bietet. (Im Lager vorhanden).\r\n\r\n\r\n\r\nBitte informieren Sie sich im Internet bzw. über bekannte \r\nForen, ob das Produkt eine  passende Wahl für Sie ist.\r\n\r\n\r\n\r\nVielen Dank für das Vertrauen und die Geduld. Wir halten Sie per E-Mail auf dem Laufenden.\r\n\r\nIhr {FIRMA} Team\r\n', 'AlternativArtikel', 0, 1),
(17, 'deutsch', 'Zusammenstellung Ihrer Bestellung', 'Sehr geehrter Kunde,\r\n\r\nsoeben wurde Ihr Bestellung zusammengestellt. Sie können Ihre Ware jetzt abholen. Sind Sie bereits bei uns gewesen, so sehen Sie diese E-Mail bitte als gegenstandslos an.\r\n\r\n{VERSAND}\r\n\r\nIhr {FIRMA} Team\r\n', 'Selbstabholer', 0, 1);

--
-- Daten für Tabelle `inhalt`
--

INSERT INTO `inhalt` (`id`, `sprache`, `inhalt`, `kurztext`, `html`, `title`, `description`, `keywords`, `inhaltstyp`, `sichtbarbis`, `datum`, `aktiv`, `shop`, `template`, `finalparse`, `navigation`) VALUES
(2, 'de', 'signatur', '', '&lt;p&gt;Musterfirma GmbH&lt;br /&gt;Maxstr. 1&lt;br /&gt;01099 Musterstadt&lt;br /&gt;Deutschland&lt;br /&gt;&lt;br /&gt;Tel.:+ 49 180 - 45 46 210&lt;br /&gt;E-Mail: office(at)musterfirma.de&lt;br /&gt;&lt;br /&gt;Gesch&amp;auml;ftsf&amp;uuml;hrer&lt;br /&gt;Max Musterman&lt;br /&gt;&lt;br /&gt;Handelsregister&lt;br /&gt;HRB 54353, Amtsgericht Musterstadt&lt;br /&gt;&lt;br /&gt;Umsatzsteueridentifikationsnummer&lt;br /&gt;DE 443236056&lt;br /&gt;&lt;br /&gt;WEEE-Reg.-Nr. DE 643999303&lt;/p&gt;', '', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 1, '', '', ''),
(3, 'de', 'bestellung', '', '&lt;p&gt;Sehr geehrte(r) [ANREDE] [NAME],&lt;br /&gt;&lt;br /&gt;vielen Dank f&amp;uuml;r Ihre Bestellung.&lt;br /&gt;Wir werden Ihre Bestellung schnellstm&amp;ouml;glich bearbeiten.&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;Innerhalb Deutschlands dauert der Versand in der Regel 1-2 Werktage (Zwischenverkauf vorbehalten).&lt;br /&gt;Bei Sendungen ins Ausland beachten Sie bitte die Informationen bei &lt;br /&gt;der von Ihnen gew&amp;auml;hlten Versandoption.&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;***************************************************************&lt;br /&gt;Ihre Bestellnummer: [BESTELLNUMMER]&lt;br /&gt;***************************************************************&lt;br /&gt;Ihre Versandanschrift/Lieferadresse:&lt;br /&gt;&lt;br /&gt;[LIEFERADRESSE]&lt;br /&gt;***************************************************************&lt;br /&gt;Ihre Rechnungsadresse:&lt;br /&gt;&lt;br /&gt;[ANSCHRIFT]&lt;br /&gt;***************************************************************&lt;br /&gt;Ihre Zahlungsweise: [ZAHLUNGSWEISE]&lt;br /&gt;&lt;br /&gt;[ZAHLUNGSWEISETEXT]&lt;br /&gt;&lt;br /&gt;***************************************************************&lt;br /&gt;Ihre Versandart: [VERSANDART]&lt;br /&gt;***************************************************************&lt;br /&gt;Ihre bestellten Artikel:&lt;br /&gt;&lt;br /&gt;[ARTIKEL]&lt;br /&gt;&lt;br /&gt;Gesamtpreis inkl. Porto: [GESAMT]&lt;br /&gt;***************************************************************&lt;br /&gt;&lt;br /&gt;Bitte &amp;Uuml;berpr&amp;uuml;fen Sie Ihre Bestelldaten nochmals und teilen Sie uns dringende &lt;br /&gt;&amp;Auml;nderungen in Bezug auf Ihre Bestellung unter Angabe Ihrer Bestellnummer an &lt;br /&gt;folgende E-Mail Adresse mit: shop@in-circuit.de&lt;br /&gt;&lt;br /&gt;Wir w&amp;uuml;nschen Ihnen einen sch&amp;ouml;nen Tag,&lt;/p&gt;', 'Ihre Bestellung bei der Musterfirma GmbH', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 1, '', '', ''),
(4, 'de', 'vorkasse', '', '&lt;p&gt;Bitte &amp;uuml;berweisen Sie den Betrag von [BETRAG] EUR in den n&amp;auml;chsten 14 Tagen auf unser Konto.&amp;nbsp;&lt;br /&gt;Die bestellten Artikel sind so lange f&amp;uuml;r Sie bei uns im Lager reserviert. &lt;br /&gt;&lt;br /&gt;Kontonummer: 4682139&lt;br /&gt;Bankleitzahl: 72050000&lt;br /&gt;Kreditinstitut: Musterbank Musterstadt&lt;br /&gt;&lt;br /&gt;Verwendungszweck: [ORDERNUMBER], [CUSTOMER]&lt;br /&gt;&lt;br /&gt;Bei Auslandszahlungen bitte darauf achten, dass Geb&amp;uuml;hren nicht zu unseren Lasten gehen d&amp;uuml;rfen.&lt;br /&gt;&lt;br /&gt;IBAN: DE93 8545 0000 4524 1633 00&lt;br /&gt;BIC/SWIFT: COBAGDSASD0&lt;/p&gt;', '', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 1, '', '', ''),
(6, 'en', 'signatur', '', '&lt;p&gt;Musterfirma GmbH&lt;br /&gt;Maxstr. 1&lt;br /&gt;01099 Musterstadt&lt;br /&gt;Germany&lt;br /&gt;&lt;br /&gt;Phone.:+ 49 180 - 45 46 210&lt;br /&gt;E-Mail: office(at)musterfirma.de&lt;br /&gt;&lt;br /&gt;Executive Director&lt;br /&gt;Max Musterman&lt;br /&gt;&lt;br /&gt;Trade Register&lt;br /&gt;HRB 54353, Amtsgericht Musterstadt&lt;br /&gt;&lt;br /&gt;Sales tax identification number&lt;br /&gt;DE 443236056&lt;br /&gt;&lt;br /&gt;WEEE-Reg.-Nr. DE 643999303&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 1, '', '', ''),
(7, 'en', 'bestellung', '', '&lt;p&gt;Dear [ANREDE] [NAME],&lt;br /&gt;&lt;br /&gt;thank you for your order.&lt;br /&gt;We will process your order as soon as possible.&lt;/p&gt;\r\n&lt;p&gt;&lt;br /&gt;&lt;br /&gt;Shipping and handling inside Germany normally takes 3-5 working days.&lt;br /&gt;For shipments abroad please note the information for the chosen shipping option&lt;/p&gt;\r\n&lt;p&gt;&lt;br /&gt;***************************************************************&lt;br /&gt;Your ordernumber: [BESTELLNUMMER]&lt;br /&gt;***************************************************************&lt;br /&gt;Your shipping adress:&lt;/p&gt;\r\n&lt;p&gt;&lt;br /&gt;[LIEFERADRESSE]&lt;br /&gt;***************************************************************&lt;br /&gt;Your billing address:&lt;/p&gt;\r\n&lt;p&gt;&lt;br /&gt;[ANSCHRIFT]&lt;br /&gt;***************************************************************&lt;br /&gt;Your payment: [ZAHLUNGSWEISE]&lt;br /&gt;&lt;br /&gt;[ZAHLUNGSWEISETEXT]&lt;br /&gt;&lt;br /&gt;***************************************************************&lt;br /&gt;Your shipment: [VERSANDART]&lt;br /&gt;***************************************************************&lt;br /&gt;Items you ordered:&lt;br /&gt;&lt;br /&gt;[ARTIKEL]&lt;br /&gt;&lt;br /&gt;Price-Total incl. Shipping: [GESAMT]&lt;br /&gt;***************************************************************&lt;/p&gt;\r\n&lt;p&gt;&lt;br /&gt;Please check your order details again and tell us urgent&lt;br /&gt;Changes to your order with your order number to&lt;br /&gt;following e-mail address: shop@in-circuit.de&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;We wish you a nice day&lt;/p&gt;', 'Your Musterfirma order', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 1, '', '', ''),
(8, 'en', 'vorkasse', '', '&lt;p&gt;Please transfer the amount of EUR [BETRAG] in the next 14 days on our account.&lt;br /&gt;The ordered items are reserved for so long for you in our warehouse.&lt;br /&gt;&lt;br /&gt;Account number: 1451699&lt;br /&gt;Bank code number: 85040000&lt;br /&gt;Bank: Commerzbank Dresden&lt;br /&gt;&lt;br /&gt;Purpose: [BESTELLNUMMER], [BESTELLNAME]&lt;br /&gt;&lt;br /&gt;For international payments, please make sure that fees must not be at our expense.&lt;br /&gt;&lt;br /&gt;IBAN: DE93 8504 0000 0145 1699 00&lt;br /&gt;BIC/SWIFT: COBADEFF850&lt;/p&gt;', '', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 1, '', '', '1'),
(28, 'de', 'registeruser', '', '&lt;p&gt;Hallo,&lt;/p&gt;\r\n&lt;p&gt;vielen Dank f&amp;uuml;r Ihre Registrierung.&lt;/p&gt;\r\n&lt;p&gt;Mit den unten stehenden Zugangsdaten k&amp;ouml;nnen Sie sich in unserem Shopsystem einloggen.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Benutzername: [USERNAME]&lt;/p&gt;\r\n&lt;p&gt;Passwort: [PASSWORD]&lt;/p&gt;\r\n&lt;p&gt;&lt;br /&gt;Klicken Sie bitte auf den nachfolgenden Link um Ihr Konto zu aktivieren: [TICKETURL]&lt;/p&gt;', 'Noch ein Klick zur Fertigstellung Ihrer Registrierung', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 1, '', '', ''),
(29, 'en', 'registeruser', '', '&lt;p&gt;Hi,&lt;/p&gt;\r\n&lt;p&gt;thank you for your registration.&lt;/p&gt;\r\n&lt;p&gt;With the below credentials you can log in our online shop.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Username: [USERNAME]&lt;/p&gt;\r\n&lt;p&gt;Password: [PASSWORD]&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;Click the link to activate your Account: [TICKETURL]&lt;/p&gt;', 'One more click to complete your registration', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 11, '', '', ''),
(30, 'de', 'resetpassword', '', '&lt;p&gt;Hallo,&lt;/p&gt;\r\n&lt;p&gt;sie k&amp;ouml;nnen Ihr Passwort nun unter der folgenden Adresse &amp;auml;ndern.&lt;/p&gt;\r\n&lt;p&gt;[TICKETURL]&lt;/p&gt;', 'Passwort zurÃ¼cksetzen', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 11, '', '', ''),
(31, 'en', 'resetpassword', '', '&lt;p&gt;Hello,&lt;/p&gt;\r\n&lt;p&gt;you can now change your password at the following address.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;[TICKETURL]&lt;/p&gt;', 'Reset Password', '', '', 'email', '0000-00-00 00:00:00', '0000-00-00', 1, 1, '', '', '');

--
-- Daten für Tabelle `kalender_event`
--

INSERT INTO `kalender_event` (`id`, `kalender`, `bezeichnung`, `beschreibung`, `von`, `bis`, `allDay`, `color`, `public`) VALUES
(1, 0, 'Start-up Demo Night München', NULL, '2013-10-23 22:00:00', '2013-10-23 22:00:00', 1, '#C40046', 1),
(2, 0, 'Bester Kunde Termin 10:00 Uhr', NULL, '2013-10-24 22:00:00', '2013-10-24 22:00:00', 1, '#C40046', 0),
(3, 0, 'Feierabend', NULL, '2013-10-24 22:00:00', '2013-10-24 22:00:00', 1, '#004704', 0);

--
-- Daten für Tabelle `kalender_user`
--

INSERT INTO `kalender_user` (`id`, `event`, `userid`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

--
-- Daten für Tabelle `lager`
--

INSERT INTO `lager` (`id`, `bezeichnung`, `beschreibung`, `manuell`, `firma`, `geloescht`, `logdatei`) VALUES
(1, 'Raum_1', 'R_1', 0, 1, 0, '0000-00-00 00:00:00');

--
-- Daten für Tabelle `lager_bewegung`
--

INSERT INTO `lager_bewegung` (`id`, `lager_platz`, `artikel`, `menge`, `vpe`, `eingang`, `zeit`, `referenz`, `bearbeiter`, `projekt`, `firma`, `logdatei`, `adresse`) VALUES
(1, 1, 8, 56, 'einzeln', 1, '2013-10-24 14:35:43', 'Differenz:', 'Administrator', 2, 1, '2013-10-24 12:35:43', NULL),
(2, 2, 5, 2, 'einzeln', 1, '2013-10-24 14:40:48', 'Differenz:', 'Administrator', 0, 1, '2013-10-24 12:40:48', NULL),
(3, 2, 1, 25, 'einzeln', 1, '2013-10-24 14:56:22', 'Differenz:', 'Administrator', 0, 1, '2013-10-24 12:56:22', NULL);

--
-- Daten für Tabelle `lager_platz`
--

INSERT INTO `lager_platz` (`id`, `lager`, `kurzbezeichnung`, `bemerkung`, `projekt`, `firma`, `geloescht`, `logdatei`, `autolagersperre`) VALUES
(1, 1, 'Regal_001', '', 0, 1, 0, '0000-00-00 00:00:00', 0),
(2, 1, 'Regal_002', '', 0, 1, 0, '0000-00-00 00:00:00', 0),
(3, 1, 'Regal_003', '', 0, 1, 0, '0000-00-00 00:00:00', 0);

--
-- Daten für Tabelle `lager_platz_inhalt`
--

INSERT INTO `lager_platz_inhalt` (`id`, `lager_platz`, `artikel`, `menge`, `vpe`, `bearbeiter`, `bestellung`, `projekt`, `firma`, `logdatei`) VALUES
(32, 1, 8, 56, '', '', 0, 2, 1, '0000-00-00 00:00:00'),
(31, 2, 5, 2, '', '', 0, 0, 1, '0000-00-00 00:00:00'),
(30, 2, 1, 25, '', '', 0, 0, 1, '0000-00-00 00:00:00');

--
-- Daten für Tabelle `lager_reserviert`
--

INSERT INTO `lager_reserviert` (`id`, `adresse`, `artikel`, `menge`, `grund`, `objekt`, `parameter`, `projekt`, `firma`, `bearbeiter`, `datum`) VALUES
(4, 4, 8, 1, 'Versand f&uuml;r Auftrag 200000', 'lieferschein', '1', 2, 1, 'Administrator', '9999-01-01'),
(2, 4, 5, 3, 'Reservierung f&uuml;r Auftrag 0', 'auftrag', '2', 2, 1, 'Administrator', '0000-00-00'),
(13, 8, 8, 8, 'Versand f&uuml;r Auftrag 200002', 'lieferschein', '3', 2, 1, 'Administrator', '9999-01-01'),
(5, 0, 5, 1, 'Reservierung f&uuml;r Auftrag 0', 'auftrag', '4', 1, 1, 'Administrator', '0000-00-00'),
(6, 8, 1, 1, 'Reservierung f&uuml;r Auftrag 0', 'auftrag', '5', 2, 1, 'Administrator', '0000-00-00'),
(12, 6, 8, 30, 'Versand f&uuml;r Auftrag 200005', 'lieferschein', '2', 1, 1, 'Administrator', '9999-01-01'),
(10, 9, 7, 100, 'Reservierung f&uuml;r Auftrag 0', 'auftrag', '8', 2, 1, 'Administrator', '0000-00-00'),
(11, 8, 4, 15, 'Reservierung f&uuml;r Auftrag 200004', 'auftrag', '5', 2, 1, 'Administrator', '0000-00-00');

--
-- Daten für Tabelle `lieferschein`
--

INSERT INTO `lieferschein` (`id`, `datum`, `projekt`, `lieferscheinart`, `belegnr`, `bearbeiter`, `auftrag`, `auftragid`, `freitext`, `status`, `adresse`, `name`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `ansprechpartner`, `plz`, `ort`, `land`, `ustid`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `versandart`, `versand`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `inbearbeitung_user`, `logdatei`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `ohne_briefpapier`) VALUES
(1, '2013-10-24', '2', '', 300000, '', '200000', 1, '', 'freigegeben', 4, 'Kunde Shop 1', '', '', 'Straße 3', '', 'Peter Kunde', '22222', 'Vorstadt', 'DE', '', 'kunde@wawision.de', '', '', '', '10000', 'versandunternehmen', 'Administrator', 1, 0, '0000-00-00 00:00:00', '', '', 0, '2013-10-24 12:45:55', 0, 0, 0, NULL),
(2, '2013-11-15', '1', '', 300001, '', '200005', 7, '', 'freigegeben', 6, 'Lieferant Catering', '', '', '', '', '', '', '', 'DE', '', '', '', '', '', '10001', 'versandunternehmen', 'Administrator', 1, 0, '0000-00-00 00:00:00', '', '', 0, '2013-11-15 15:39:04', 0, 0, 0, NULL),
(3, '2013-11-15', '2', '', 300002, '', '200002', 3, 'Ihre Bestellnummer: 34543617', 'freigegeben', 8, 'Bester Kunde 1', '', '', 'Uferweg 5', '', '', '86152', 'Augsburg', 'DE', '', 'kunde@wawision.de', '', '', '', '10003', 'versandunternehmen', 'Administrator', 1, 0, '0000-00-00 00:00:00', '', '', 0, '2013-11-15 15:39:04', 0, 0, 0, NULL);

--
-- Daten für Tabelle `lieferschein_position`
--

INSERT INTO `lieferschein_position` (`id`, `lieferschein`, `artikel`, `projekt`, `bezeichnung`, `beschreibung`, `internerkommentar`, `nummer`, `seriennummer`, `menge`, `lieferdatum`, `vpe`, `sort`, `status`, `bemerkung`, `geliefert`, `abgerechnet`, `logdatei`) VALUES
(1, 1, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', '', 1, '0000-00-00', 'einzeln', 1, 'angelegt', '', 0, 0, '2013-10-24 12:45:55'),
(2, 2, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', '', 30, '0000-00-00', 'einzeln', 1, 'angelegt', '', 0, 0, '2013-11-15 15:39:04'),
(3, 3, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', '', 8, '0000-00-00', 'einzeln', 1, 'angelegt', '', 0, 0, '2013-11-15 15:39:04');

--
-- Daten für Tabelle `paketannahme`
--

INSERT INTO `paketannahme` (`id`, `adresse`, `datum`, `verpackungszustand`, `bemerkung`, `foto`, `gewicht`, `bearbeiter`, `projekt`, `vorlage`, `vorlageid`, `zahlung`, `betrag`, `status`, `beipack_rechnung`, `beipack_lieferschein`, `beipack_anschreiben`, `beipack_gesamt`, `bearbeiter_distribution`, `postgrund`, `logdatei`) VALUES
(1, 4, '2013-10-24 20:53:39', 0, '', 0, 'none', 'Administrator', 2, 'adresse', '4', 'keine', 0.0000, 'distribution', 1, 1, 0, 0, 'Administrator', 'verweigert', '2013-10-24 18:54:41'),
(2, 4, '2013-10-24 21:24:29', 0, '', 0, '', 'Administrator', 2, 'adresse', '4', '', 0.0000, 'angenommen', 0, 0, 0, 0, '', '', '2013-10-24 19:24:29');

--
-- Daten für Tabelle `projekt`
--

INSERT INTO `projekt` (`id`, `name`, `abkuerzung`, `verantwortlicher`, `beschreibung`, `sonstiges`, `aktiv`, `farbe`, `autoversand`, `checkok`, `portocheck`, `automailrechnung`, `checkname`, `zahlungserinnerung`, `zahlungsmailbedinungen`, `folgebestaetigung`, `stornomail`, `kundenfreigabe_loeschen`, `autobestellung`, `speziallieferschein`, `lieferscheinbriefpapier`, `speziallieferscheinbeschriftung`, `firma`, `geloescht`, `logdatei`, `reservierung`, `kunde`, `gesamtstunden_max`, `auftragid`, `oeffentlich`) VALUES
(1, 'Kein Projekt', 'KEINPROJEKT', '', 'Kein Projekt', '', '', '', 0, 0, 0, 0, '', 0, '', 0, 0, 0, 0, 0, 0, 0, 1, 0, '', NULL, NULL, 0.00, NULL, 0),
(2, 'OnlineShop', 'ONLINESHOP', '', '', '', '', '', 1, 0, 1, 1, '', 1, '', 0, 1, 0, 1, 0, 0, 0, 1, 0, '', 1, 0, 0.00, 0, 0),
(3, 'Entwicklung', 'ENTWICKLUNG', '', 'Entwicklung von Prototypen und eingenen Produkten', '', '', '', 1, 1, 1, 1, '', 1, '', 1, 1, 0, 1, 0, 0, 0, 1, 0, '', 1, 0, 0.00, 0, 0);

--
-- Daten für Tabelle `rechnung`
--

INSERT INTO `rechnung` (`id`, `datum`, `aborechnung`, `projekt`, `anlegeart`, `belegnr`, `auftrag`, `auftragid`, `bearbeiter`, `freitext`, `internebemerkung`, `status`, `adresse`, `name`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `ansprechpartner`, `plz`, `ort`, `land`, `ustid`, `ust_befreit`, `ustbrief`, `ustbrief_eingang`, `ustbrief_eingang_am`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `lieferschein`, `versandart`, `lieferdatum`, `buchhaltung`, `zahlungsweise`, `zahlungsstatus`, `ist`, `soll`, `skonto_gegeben`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `versendet_mahnwesen`, `mahnwesen`, `mahnwesen_datum`, `mahnwesen_gesperrt`, `mahnwesen_internebemerkung`, `inbearbeitung`, `datev_abgeschlossen`, `logdatei`, `doppel`, `keinsteuersatz`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `ohne_briefpapier`) VALUES
(1, '2013-10-24', 0, '2', '', 400000, 200000, 1, '', '', '', 'freigegeben', 4, 'Kunde Shop 1', '', '', 'Straße 3', '', 'Peter Kunde', '22222', 'Vorstadt', 'DE', '', 0, 0, 0, '0000-00-00', 'kunde@wawision.de', '', '', '', '10000', 1, 'versandunternehmen', '0000-00-00', 'Administrator', 'rechnung', 'offen', 0.00, 399.85, 0.00, 14, 0, 0, 1, 0, '0000-00-00 00:00:00', '', '', 0, 'mahnung3', '2013-11-15', 0, '', 0, 0, '2013-11-15 15:24:50', NULL, 0, 0, 0, 0, NULL),
(2, '2013-09-04', 0, '1', '', 400001, 0, 0, '1', '', '', 'versendet', 8, 'Bester Kunde 1', '', '', 'Uferweg 5', '', '', '86152', 'Augsburg', 'DE', '', 0, 0, 0, '0000-00-00', 'kunde@wawision.de', '', '', '', '10003', 0, 'versandunternehmen', '0000-00-00', 'Administrator', 'rechnung', 'offen', 0.00, 795.75, 0.00, 14, 0, 0, 1, 1, '2013-10-24 14:46:45', 'telefon', 'Administrator', 0, 'inkasso', '2013-11-15', 0, '', 0, 0, '2013-11-15 15:23:07', 0, 0, 0, 0, 0, 0),
(3, '2013-10-09', 0, '2', '', 400002, 0, 0, '1', '', '', 'freigegeben', 4, 'Kunde Shop 1', '', '', 'Straße 3', '', 'Peter Kunde', '22222', 'Vorstadt', 'DE', '', 0, 0, 0, '0000-00-00', 'kunde@wawision.de', '', '', '', '10000', 0, 'versandunternehmen', '0000-00-00', 'Administrator', 'rechnung', 'offen', 0.00, 182.45, 0.00, 14, 0, 0, 1, 0, '0000-00-00 00:00:00', '', '', 0, 'inkasso', '2013-11-15', 0, '', 0, 0, '2013-11-15 15:23:30', 0, 0, 0, 0, 0, 0),
(4, '2013-09-18', 0, '2', '', 400003, 0, 0, '1', '', '', 'versendet', 9, 'Kunde 2', '', '', 'Hauptstraße 24', '', '', '86150', 'Augsburg', 'DE', '', 0, 0, 0, '0000-00-00', 'kunde@wawision.de', '', '', '', '10004', 0, 'versandunternehmen', '0000-00-00', 'Administrator', 'rechnung', 'offen', 0.00, 2.77, 0.00, 14, 0, 0, 1, 1, '2013-10-24 14:53:10', 'sonstiges', 'Administrator', 0, 'inkasso', '2013-11-15', 0, '', 0, 0, '2013-11-15 15:23:07', 1, 0, 1, 0, 0, 0),
(5, '2013-11-15', 0, '2', '', 400004, 0, 0, '1', '', '', 'freigegeben', 9, 'Kunde 2', '', '', 'Hauptstraße 24', '', '', '86150', 'Augsburg', 'DE', '', 0, 0, 0, '0000-00-00', 'kunde@wawision.de', '', '', '', '10004', 0, 'versandunternehmen', '0000-00-00', 'Administrator', 'rechnung', 'offen', 0.00, 17.92, 0.00, 14, 0, 0, 1, 0, '0000-00-00 00:00:00', '', '', 0, '', '0000-00-00', 0, '', 0, 0, '2013-11-15 15:29:04', NULL, NULL, 0, 0, 0, 0),
(6, '2013-11-15', 0, '2', '', 400005, 0, 0, '1', '', '', 'freigegeben', 9, 'Kunde 2', '', '', 'Hauptstraße 24', '', '', '86150', 'Augsburg', 'DE', '', 0, 0, 0, '0000-00-00', 'kunde@wawision.de', '', '', '', '10004', 0, 'versandunternehmen', '0000-00-00', 'Administrator', 'rechnung', 'offen', 0.00, 2.99, 0.00, 14, 0, 0, 1, 0, '0000-00-00 00:00:00', '', '', 0, '', '0000-00-00', 0, '', 0, 0, '2013-11-15 15:29:04', NULL, NULL, 0, 0, 0, 0),
(7, '2013-11-15', 0, '1', '', 400006, 200005, 7, '', '', '', 'freigegeben', 6, 'Lieferant Catering', '', '', '', '', '', '', '', 'DE', '', 0, 0, 0, '0000-00-00', '', '', '', '', '10001', 2, 'versandunternehmen', '0000-00-00', 'Administrator', 'rechnung', 'offen', 0.00, 11880.95, 0.00, 14, 0, 0, 1, 0, '0000-00-00 00:00:00', '', '', 0, '', '0000-00-00', 0, '', 0, 0, '2013-12-09 10:19:53', NULL, 0, 0, 0, 0, NULL),
(8, '2013-11-15', 0, '2', '', 400007, 200002, 3, '', 'Ihre Bestellnummer: 34543617', '', 'freigegeben', 8, 'Bester Kunde 1', '', '', 'Uferweg 5', '', '', '86152', 'Augsburg', 'DE', '', 0, 0, 0, '0000-00-00', 'kunde@wawision.de', '', '', '', '10003', 3, 'versandunternehmen', '0000-00-00', 'Administrator', 'rechnung', 'offen', 0.00, 3171.15, 0.00, 30, 10, 2, 1, 0, '0000-00-00 00:00:00', '', '', 0, '', '0000-00-00', 0, '', 0, 0, '2013-12-09 10:19:53', NULL, 0, 0, 0, 0, NULL);

--
-- Daten für Tabelle `rechnung_position`
--

INSERT INTO `rechnung_position` (`id`, `rechnung`, `artikel`, `projekt`, `bezeichnung`, `beschreibung`, `internerkommentar`, `nummer`, `menge`, `preis`, `waehrung`, `lieferdatum`, `vpe`, `sort`, `status`, `umsatzsteuer`, `bemerkung`, `logdatei`, `rabatt`) VALUES
(1, 1, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', 1, 332.6891, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', '2013-10-24 12:45:55', 0),
(2, 1, 9, 1, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', '2013-10-24 12:45:55', 0),
(3, 2, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', 2, 332.6891, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', '2013-10-24 12:47:59', 0),
(4, 2, 9, 1, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', '2013-10-24 12:47:21', 0),
(5, 3, 6, 1, 'Gehäuse Oberschale', '', '', '400001', 30, 5.0000, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', '2013-10-24 12:50:10', 0),
(6, 3, 9, 1, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', '2013-10-24 12:50:16', 0),
(7, 4, 5, 2, 'Ungespritzte Bananen', '', '', '700005', 1, 2.3300, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', '2013-10-24 12:52:54', 0),
(8, 5, 2, 2, 'Rote Zwiebeln\r\n(01.06.2013 - 30.11.2013)', '', '', '700002', 6, 2.5100, 'EUR', '0000-00-00', '', 1, 'angelegt', '', '', '2013-11-15 15:28:48', 0),
(9, 6, 2, 2, 'Rote Zwiebeln\r\n(30.11.2013 - 31.12.2013)', '', '', '700002', 1, 2.5100, 'EUR', '0000-00-00', '', 1, 'angelegt', '', '', '2013-11-15 15:28:51', 0),
(10, 7, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', 30, 332.6891, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', '2013-11-15 15:39:04', 0),
(11, 7, 9, 2, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', '2013-11-15 15:39:04', 0),
(12, 8, 8, 2, 'Unser innovatives Produkt 1', '', '', '700006', 8, 332.6891, 'EUR', '0000-00-00', 'einzeln', 1, 'angelegt', '', '', '2013-11-15 15:39:04', 0),
(13, 8, 9, 1, 'Versandkosten Shop', '', '', '100001', 1, 3.3193, 'EUR', '0000-00-00', 'einzeln', 2, 'angelegt', '', '', '2013-11-15 15:39:04', 0);

--
-- Daten für Tabelle `rechnung_protokoll`
--

INSERT INTO `rechnung_protokoll` (`id`, `rechnung`, `zeit`, `bearbeiter`, `grund`) VALUES
(1, 1, '2013-10-24 14:45:55', 'Administrator', 'Rechnung versendet'),
(2, 2, '2013-10-24 14:46:11', 'Administrator', 'Rechnung angelegt'),
(3, 2, '2013-10-24 14:46:34', 'Administrator', 'Rechnung freigegeben'),
(4, 2, '2013-10-24 14:46:45', 'Administrator', 'Rechnung versendet'),
(5, 3, '2013-10-24 14:49:44', 'Administrator', 'Rechnung angelegt'),
(6, 3, '2013-10-24 14:50:19', 'Administrator', 'Rechnung freigegeben'),
(7, 4, '2013-10-24 14:52:35', 'Administrator', 'Rechnung angelegt'),
(8, 4, '2013-10-24 14:53:04', 'Administrator', 'Rechnung freigegeben'),
(9, 4, '2013-10-24 14:53:10', 'Administrator', 'Rechnung versendet'),
(10, 5, '2013-11-15 16:28:48', 'Administrator', 'Rechnung freigegeben'),
(11, 6, '2013-11-15 16:28:51', 'Administrator', 'Rechnung freigegeben'),
(12, 8, '2013-11-15 16:39:04', 'Administrator', 'Rechnung versendet');

--
-- Daten für Tabelle `shopexport`
--

INSERT INTO `shopexport` (`id`, `bezeichnung`, `typ`, `url`, `passwort`, `token`, `challenge`, `projekt`, `cms`, `firma`, `logdatei`, `geloescht`) VALUES
(1, 'MusterShop', 'wawision', 'http://127.0.0.1/mustershop/', 'abcdefghijuklmno0123456789012345', '12345', '54321', 2, 1, 2, '0000-00-00 00:00:00', 0),
(2, 'Online Shop', 'wawision', '', '', '', '', 2, 1, 1, '0000-00-00 00:00:00', 0);

--
-- Daten für Tabelle `shopnavigation`
--

INSERT INTO `shopnavigation` (`id`, `bezeichnung`, `position`, `parent`, `bezeichnung_en`, `plugin`, `pluginparameter`, `shop`, `target`) VALUES
(1, 'Willkommen', 1, 0, 'Welcome', 'PageID', 'welcome', 1, ''),
(2, 'Mein Shop', 2, 0, 'My Shop', 'PageID', 'shop', 1, ''),
(3, 'Zwiebeln', 1, 1, '', 'gruppe', '1', 1, ''),
(4, 'Tomaten', 2, 1, '', 'gruppe', '3', 1, ''),
(5, 'Bananen', 3, 1, '', 'gruppe', '2', 1, ''),
(6, 'Innovative Produkte', 1, 0, '', '', '', 2, ''),
(7, 'Produkt 1', 1, 6, '', '', '', 2, ''),
(8, 'Neue Produkte', 2, 0, 'New Products', 'gruppe', '', 2, ''),
(9, 'Produkt 2', 2, 6, 'Produkt 2', 'artikel', '', 2, ''),
(10, 'Topseller', 1, 8, '', '', '', 2, '');

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `repassword`, `description`, `settings`, `parentuser`, `activ`, `type`, `adresse`, `fehllogins`, `standarddrucker`, `firma`, `logdatei`, `startseite`, `hwtoken`, `hwkey`, `hwcounter`, `motppin`, `motpsecret`, `externlogin`, `hwdatablock`) VALUES
(1, 'admin', 'FUS0ibOgSORbk', 0, 'Administrator', 'a:1:{s:3:"top";s:12:"VmVya2F1Zg==";}', 0, 1, 'admin', 1, 0, 0, 1, '2013-10-24 20:22:08', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

--
-- Daten für Tabelle `useronline`
--

INSERT INTO `useronline` (`user_id`, `login`, `sessionid`, `ip`, `time`, `logdatei`) VALUES
(1, 0, 'b3okcol294a3hf3vr00lidt986', '127.0.0.1', '2013-10-24 15:19:30', '2013-11-15 12:39:48'),
(1, 0, 'cngoaedtndflv6h5di2tc8m836', '192.168.0.4', '2013-10-24 15:19:10', '2013-11-15 12:39:48'),
(1, 0, 'ko27275uhs57emhl78jgcggfl1', '192.168.0.152', '2013-10-24 15:17:11', '2013-11-15 12:39:48'),
(1, 0, '6r70drnp4cdruk8q5f8olqk3f5', '127.0.0.1', '2013-10-24 22:22:09', '2013-11-15 12:39:48'),
(1, 0, 'ccrtj3j60dgvnchsbgskjdq4a3', '127.0.0.1', '2013-11-15 13:39:48', '2013-11-15 12:39:48'),
(1, 1, 'mee6im43m2f0rsg445nbnjbl05', '127.0.0.1', '2013-11-15 17:21:08', '2013-11-15 16:21:08'),
(1, 1, '4mp8t3qeskujr20qs7ui92s9n6', '192.168.0.152', '2013-12-09 11:20:00', '2013-12-09 10:20:00');

--
-- Daten für Tabelle `verkaufspreise`
--

INSERT INTO `verkaufspreise` (`id`, `artikel`, `objekt`, `projekt`, `adresse`, `preis`, `waehrung`, `ab_menge`, `vpe`, `vpe_menge`, `angelegt_am`, `gueltig_bis`, `bemerkung`, `bearbeiter`, `logdatei`, `firma`, `geloescht`, `kundenartikelnummer`) VALUES
(1, 2, '', '', '0', 2.5100, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, NULL),
(2, 3, '', '', '0', 2.9900, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, NULL),
(3, 1, '', '', '0', 1.5500, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, NULL),
(4, 4, '', '', '0', 1.3400, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, NULL),
(5, 5, '', '', '0', 2.3300, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, NULL),
(6, 8, '', '', '0', 332.6891, 'EUR', 1, '1', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, ''),
(7, 9, '', '', '0', 3.3193, 'EUR', 1, '1', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, ''),
(8, 6, '', '', '0', 5.0000, 'EUR', 1, '1', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '46163');

--
-- Daten für Tabelle `versand`
--

INSERT INTO `versand` (`id`, `adresse`, `rechnung`, `lieferschein`, `versandart`, `projekt`, `gewicht`, `freigegeben`, `bearbeiter`, `versender`, `abgeschlossen`, `versendet_am`, `versandunternehmen`, `tracking`, `download`, `firma`, `logdatei`, `keinetrackingmail`) VALUES
(1, 4, 1, 1, 'versandunternehmen', 2, '', 1, 'Administrator', '', 0, '0000-00-00', '', '', 0, 1, '2013-10-24 14:45:55', 0),
(2, 6, 7, 2, 'versandunternehmen', 1, '', 1, 'Administrator', '', 0, '0000-00-00', '', '', 0, 1, '2013-11-15 16:39:04', 0),
(3, 8, 8, 3, 'versandunternehmen', 2, '', 1, 'Administrator', '', 0, '0000-00-00', '', '', 0, 1, '2013-11-15 16:39:04', 0);

--
-- Daten für Tabelle `warteschlangen`
--

INSERT INTO `warteschlangen` (`id`, `warteschlange`, `label`) VALUES
(1, 'Technik-Support', 'Technik-Support'),
(2, 'Buchhaltung/Mahnwesen', 'Buchhaltung/Mahnwesen'),
(3, 'Verwaltung', 'Verwaltung');

--
-- Daten für Tabelle `wiki`
--

INSERT INTO `wiki` (`id`, `name`, `content`, `lastcontent`) VALUES
(1, 'StartseiteWiki', '<h1>waWision</h1>
<p>Herzlich Willkommen in Ihrem waWision,<br><br>wir freuen uns Sie als waWision Benutzer begrüßen zu dürfen. Mit waWision organisieren Sie Ihre Firma schnell und einfach. Sie haben alle wichtigen Zahlen und Vorgänge im Überblick.<br><br>Für Einsteiger sind die folgenden Thema wichtig:<br><br></p>
<ul>
<li> <a href="index.php?module=firmendaten&amp;action=edit" target="_blank"> Firmendaten</a> (dort richten Sie Ihr Briefpapier ein)</li>
<li> <a href="index.php?module=adresse&amp;action=list" target="_blank"> Stammdaten / Adressen</a> (Kunden und Lieferanten angelen)</li>
<li> <a href="index.php?module=artikel&amp;action=list" target="_blank"> Artikel anlegen</a> (Ihr Artikelstamm)</li>
<li> <a href="index.php?module=angebot&amp;action=list" target="_blank"> Angebot</a> / <a href="index.php?module=auftrag&amp;action=list" target="_blank"> Auftrag</a> (Alle Dokumente für Ihr Geschäft)</li>
<li> <a href="index.php?module=rechnung&amp;action=list" target="_blank"> Rechnung</a> / <a href="index.php?module=gutschrift&amp;action=list" target="_blank"> Gutschrift</a></li>
<li> <a href="index.php?module=lieferschein&amp;action=list" target="_blank"> Lieferschein</a></li>
</ul>
<p><br><br>Kennen Sie unsere Zusatzmodule die Struktur und Organisation in das tägliche Geschäft bringen?<br><br></p>
<ul>
<li> <a href="index.php?module=kalender&amp;action=list" target="_blank"> Kalender</a></li>
<li> <a href="index.php?module=wiki&amp;action=list" target="_blank"> Wiki</a></li>
</ul>
', NULL);
--
-- Daten für Tabelle `zeiterfassung`
--

INSERT INTO `zeiterfassung` (`id`, `art`, `adresse`, `von`, `bis`, `aufgabe`, `beschreibung`, `arbeitspaket`, `buchungsart`, `kostenstelle`, `projekt`, `abgerechnet`, `logdatei`, `status`, `adresse_abrechnung`, `abrechnen`, `ist_abgerechnet`, `gebucht_von_user`, `ort`, `abrechnung_dokument`, `dokumentid`, `verrechnungsart`, `arbeitsnachweis`) VALUES
(1, 'arbeit', 1, '2013-10-24 09:00:00', '2013-10-24 09:31:00', 'DB Design', 'Fleißig am DB Design gefeilt - leider nicht sehr erfolgreich. Morgen wieder.', 0, 'manuell', '', 3, 0, '0000-00-00 00:00:00', NULL, 9, 1, 0, 1, 'Schreibtisch', NULL, NULL, '', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
