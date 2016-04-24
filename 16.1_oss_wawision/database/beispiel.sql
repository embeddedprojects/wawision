-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 26. Okt 2015 um 17:47
-- Server Version: 5.5.44-0+deb8u1
-- PHP-Version: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `osstest`
--


--
-- Daten für Tabelle `adresse`
--

INSERT INTO `adresse` (`id`, `typ`, `marketingsperre`, `trackingsperre`, `rechnungsadresse`, `sprache`, `name`, `abteilung`, `unterabteilung`, `ansprechpartner`, `land`, `strasse`, `ort`, `plz`, `telefon`, `telefax`, `mobil`, `email`, `ustid`, `ust_befreit`, `passwort_gesendet`, `sonstiges`, `adresszusatz`, `kundenfreigabe`, `steuer`, `logdatei`, `kundennummer`, `lieferantennummer`, `mitarbeiternummer`, `konto`, `blz`, `bank`, `inhaber`, `swift`, `iban`, `waehrung`, `paypal`, `paypalinhaber`, `paypalwaehrung`, `projekt`, `partner`, `zahlungsweise`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `versandart`, `kundennummerlieferant`, `zahlungsweiselieferant`, `zahlungszieltagelieferant`, `zahlungszieltageskontolieferant`, `zahlungszielskontolieferant`, `versandartlieferant`, `geloescht`, `firma`, `webid`, `vorname`, `kennung`, `sachkonto`, `freifeld1`, `freifeld2`, `freifeld3`, `filiale`, `vertrieb`, `innendienst`, `verbandsnummer`, `abweichendeemailab`, `portofrei_aktiv`, `portofreiab`, `infoauftragserfassung`, `mandatsreferenz`, `mandatsreferenzdatum`, `mandatsreferenzaenderung`, `glaeubigeridentnr`, `kreditlimit`, `tour`, `zahlungskonditionen_festschreiben`, `rabatte_festschreiben`, `mlmaktiv`, `mlmvertragsbeginn`, `mlmlizenzgebuehrbis`, `mlmfestsetzenbis`, `mlmfestsetzen`, `mlmmindestpunkte`, `mlmwartekonto`, `abweichende_rechnungsadresse`, `rechnung_vorname`, `rechnung_name`, `rechnung_titel`, `rechnung_typ`, `rechnung_strasse`, `rechnung_ort`, `rechnung_plz`, `rechnung_ansprechpartner`, `rechnung_land`, `rechnung_abteilung`, `rechnung_unterabteilung`, `rechnung_adresszusatz`, `rechnung_telefon`, `rechnung_telefax`, `rechnung_anschreiben`, `rechnung_email`, `geburtstag`, `rolledatum`, `liefersperre`, `liefersperregrund`, `mlmpositionierung`, `steuernummer`, `steuerbefreit`, `mlmmitmwst`, `mlmabrechnung`, `mlmwaehrungauszahlung`, `mlmauszahlungprojekt`, `sponsor`, `geworbenvon`, `logfile`, `kalender_aufgaben`, `verrechnungskontoreisekosten`, `usereditid`, `useredittimestamp`, `rabatt`, `provision`, `rabattinformation`, `rabatt1`, `rabatt2`, `rabatt3`, `rabatt4`, `rabatt5`, `internetseite`, `bonus1`, `bonus1_ab`, `bonus2`, `bonus2_ab`, `bonus3`, `bonus3_ab`, `bonus4`, `bonus4_ab`, `bonus5`, `bonus5_ab`, `bonus6`, `bonus6_ab`, `bonus7`, `bonus7_ab`, `bonus8`, `bonus8_ab`, `bonus9`, `bonus9_ab`, `bonus10`, `bonus10_ab`, `rechnung_periode`, `rechnung_anzahlpapier`, `rechnung_permail`, `titel`, `anschreiben`, `nachname`, `arbeitszeitprowoche`, `folgebestaetigungsperre`, `lieferantennummerbeikunde`, `verein_mitglied_seit`, `verein_mitglied_bis`, `verein_mitglied_aktiv`, `verein_spendenbescheinigung`, `freifeld4`, `freifeld5`, `freifeld6`, `freifeld7`, `freifeld8`, `freifeld9`, `freifeld10`, `rechnung_papier`, `angebot_cc`, `auftrag_cc`, `rechnung_cc`, `gutschrift_cc`, `lieferschein_cc`, `bestellung_cc`, `angebot_fax_cc`, `auftrag_fax_cc`, `rechnung_fax_cc`, `gutschrift_fax_cc`, `lieferschein_fax_cc`, `bestellung_fax_cc`, `abperfax`, `abpermail`, `kassiereraktiv`, `kassierernummer`, `kassiererprojekt`, `portofreilieferant_aktiv`, `portofreiablieferant`, `mandatsreferenzart`, `mandatsreferenzwdhart`, `serienbrief`) VALUES
(3, 'firma', '', 0, 0, 'deutsch', 'Max Muster', '', '', '', 'DE', 'Musterstrasse 6', 'Musterdorf', '12345', '0821123456789', '0821123456790', '', 'info@maxmuellermuster.de', '', 0, 0, '', '', 0, '', '2015-10-26 15:58:21', '10000', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', '', '', '', '', '', '', 0, 0, '', '', 0.00, 0.00, '', '', '0000-00-00', 0, '', 0.00, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0.00, 0, '', '', '', 'firma', '', '', '', '', 'DE', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 2, '2015-10-26 15:58:21', 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', '', '', 0.00, 0, '', '0000-00-00', '0000-00-00', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, 0, 0.00, 'einmalig', 'erste', 0),
(4, 'frau', '', 0, 0, 'deutsch', 'Eva Müller', '', '', '', 'DE', 'Musterweg 12a', 'Musterdorf', '12345', '089123456789', '089123456790', '', '', '', 0, 0, '', '', 0, '', '2015-10-26 15:58:01', '10001', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', '', '', '', '', '', '', 0, 0, '', '', 0.00, 0.00, '', '', '0000-00-00', 0, '', 0.00, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0.00, 0, '', '', '', 'firma', '', '', '', '', 'DE', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 2, '2015-10-26 15:58:01', 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', '', '', 0.00, 0, '', '0000-00-00', '0000-00-00', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, 0, 0.00, 'einmalig', 'erste', 0),
(5, 'firma', '', 0, 0, 'deutsch', 'Hans Huber', '', '', '', 'DE', 'Musterstrasse 6', 'Musterstadt', '12345', '017123456745', '', '', 'hans@huberhausen.de', '', 0, 0, '', '', 0, '', '2015-10-26 15:59:11', '10002', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', '', '', '', '', '', '', 0, 0, '', '', 0.00, 0.00, '', '', '0000-00-00', 0, '', 0.00, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0.00, 0, '', '', '', 'firma', '', '', '', '', 'DE', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 2, '2015-10-26 15:59:11', 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', '', '', 0.00, 0, '', '0000-00-00', '0000-00-00', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, 0, 0.00, 'einmalig', 'erste', 0),
(6, 'herr', '', 0, 0, 'deutsch', 'Anton Lechner', '', '', '', 'DE', 'Musterstrasse 6', '', '12345', '', '', '', '', '', 0, 0, '', '', 0, '', '2015-10-26 16:00:29', '', '', '90000', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', '', '', '', '', '', '', 0, 0, '', '', 0.00, 0.00, '', '', '0000-00-00', 0, '', 0.00, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0.00, 0, '', '', '', 'firma', '', '', '', '', 'DE', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 2, '2015-10-26 16:00:29', 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', '', '', 0.00, 0, '', '0000-00-00', '0000-00-00', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, 0, 0.00, 'einmalig', 'erste', 0),
(7, 'firma', '', 0, 0, 'deutsch', 'Schrauben Meier', '', '', '', 'DE', 'Musterstrasse 6', 'Musterdorf', '12345', '12345678', '', '', 'schrauben@meiermusterdorf.de', '', 0, 0, '', '', 0, '', '2015-10-26 16:04:50', '', '70000', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', '', '', '', '', '', '', 0, 0, '', '', 0.00, 0.00, '', '', '0000-00-00', 0, '', 0.00, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0.00, 0, '', '', '', 'firma', '', '', '', '', 'DE', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 2, '2015-10-26 16:04:50', 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', '', '', 0.00, 0, '', '0000-00-00', '0000-00-00', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, 0, 0.00, 'einmalig', 'erste', 0),
(8, 'firma', '', 0, 0, 'deutsch', 'Elektronik Großhandel', '', '', '', 'DE', 'Musterweg 12a', 'Musterdorf', '12345', '12345678', '', '', 'elektronik@grosshandel.de', '', 0, 0, '', '', 0, '', '2015-10-26 16:05:42', '', '70001', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 'rechnung', '', '', '', 'versandunternehmen', '', 'rechnung', '', '', '', '', 0, 1, '', '', '', '', '', '', '', '', 0, 0, '', '', 0.00, 0.00, '', '', '0000-00-00', 0, '', 0.00, 0, 0, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, 0.00, 0, '', '', '', 'firma', '', '', '', '', 'DE', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0, '', '', '', 0, 0, '', '', 0, 0, 0, '', 0, 0, 2, '2015-10-26 16:05:42', 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, '', '', '', 0.00, 0, '', '0000-00-00', '0000-00-00', 0, 0, '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, 0, 0.00, 'einmalig', 'erste', 0);

--
-- Daten für Tabelle `adresse_rolle`
--

INSERT INTO `adresse_rolle` (`id`, `adresse`, `projekt`, `subjekt`, `praedikat`, `objekt`, `parameter`, `von`, `bis`) VALUES
(1, 3, 1, 'Kunde', 'von', 'Projekt', '1', '2015-10-26', '0000-00-00'),
(2, 4, 1, 'Kunde', 'von', 'Projekt', '1', '2015-10-26', '0000-00-00'),
(3, 5, 1, 'Kunde', 'von', 'Projekt', '1', '2015-10-26', '0000-00-00'),
(4, 6, 1, 'Mitarbeiter', 'von', 'Projekt', '1', '2015-10-26', '0000-00-00'),
(5, 7, 1, 'Lieferant', 'von', 'Projekt', '1', '2015-10-26', '0000-00-00'),
(6, 8, 1, 'Lieferant', 'von', 'Projekt', '1', '2015-10-26', '0000-00-00');

--
-- Daten für Tabelle `angebot`
--

INSERT INTO `angebot` (`id`, `datum`, `gueltigbis`, `projekt`, `belegnr`, `bearbeiter`, `anfrage`, `auftrag`, `freitext`, `internebemerkung`, `status`, `adresse`, `retyp`, `rechnungname`, `retelefon`, `reansprechpartner`, `retelefax`, `reabteilung`, `reemail`, `reunterabteilung`, `readresszusatz`, `restrasse`, `replz`, `reort`, `reland`, `name`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `plz`, `ort`, `land`, `ustid`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `versandart`, `vertrieb`, `zahlungsweise`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `gesamtsumme`, `bank_inhaber`, `bank_institut`, `bank_blz`, `bank_konto`, `kreditkarte_typ`, `kreditkarte_inhaber`, `kreditkarte_nummer`, `kreditkarte_pruefnummer`, `kreditkarte_monat`, `kreditkarte_jahr`, `abweichendelieferadresse`, `abweichenderechnungsadresse`, `liefername`, `lieferabteilung`, `lieferunterabteilung`, `lieferland`, `lieferstrasse`, `lieferort`, `lieferplz`, `lieferadresszusatz`, `lieferansprechpartner`, `liefertelefon`, `liefertelefax`, `liefermail`, `autoversand`, `keinporto`, `ust_befreit`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `inbearbeitung`, `vermerk`, `logdatei`, `ansprechpartner`, `deckungsbeitragcalc`, `deckungsbeitrag`, `erloes_netto`, `umsatz_netto`, `lieferdatum`, `vertriebid`, `aktion`, `provision`, `provision_summe`, `keinsteuersatz`, `anfrageid`, `gruppe`, `anschreiben`, `usereditid`, `useredittimestamp`, `realrabatt`, `rabatt`, `rabatt1`, `rabatt2`, `rabatt3`, `rabatt4`, `rabatt5`, `steuersatz_normal`, `steuersatz_zwischen`, `steuersatz_ermaessigt`, `steuersatz_starkermaessigt`, `steuersatz_dienstleistung`, `waehrung`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `typ`, `ohne_briefpapier`, `auftragid`, `lieferid`, `ansprechpartnerid`, `projektfiliale`, `abweichendebezeichnung`) VALUES
(1, '2015-10-26', '2015-11-23', '1', '100000', 'Administrator2', '', '', '', '', 'beauftragt', 3, '', '', '', '', '', '', '', '', '', '', '', '', '', 'Max Muster', '', '', 'Musterstrasse 6', '', '12345', 'Musterdorf', 'DE', '', 'info@maxmuellermuster.de', '0821123456789', '0821123456790', '', '10000', 'versandunternehmen', 'Administrator2', 'rechnung', 14, 10, 2.00, 737.8000, '', '', 0, 0, '', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 1, 1, '2015-10-26 17:17:26', 'sonstiges', 'Administrator2', 0, '', '2015-10-26 16:42:04', '', 1, 68.98, 427.70, 620.00, NULL, 0, '', 0.00, NULL, NULL, 0, 0, '', 2, '2015-10-26 16:17:28', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 1, 0, 0, 'firma', 0, 1, 0, 0, 0, 0),
(2, '2015-10-26', '2015-11-23', '1', '100001', 'Administrator2', '', '', '', '', 'freigegeben', 4, '', '', '', '', '', '', '', '', '', '', '', '', '', 'Eva Müller', '', '', 'Musterweg 12a', '', '12345', 'Musterdorf', 'DE', '', '', '089123456789', '089123456790', '', '10001', 'versandunternehmen', 'Administrator2', 'rechnung', 14, 10, 2.00, 73.7800, '', '', 0, 0, '', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 1, 0, '0000-00-00 00:00:00', '', '', 0, '', '2015-10-26 16:17:58', '', 1, 68.98, 42.77, 62.00, NULL, 0, '', 0.00, NULL, NULL, 0, 0, '', 2, '2015-10-26 16:17:58', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 0, 0, 0, 'frau', 0, 0, 0, 0, 0, 0),
(3, '2015-10-26', '2015-11-23', '1', '100002', 'Administrator2', '', '', '', '', 'freigegeben', 5, '', '', '', '', '', '', '', '', '', '', '', '', '', 'Hans Huber', '', '', 'Musterstrasse 6', '', '12345', 'Musterstadt', 'DE', '', 'hans@huberhausen.de', '017123456745', '', '', '10002', 'versandunternehmen', 'Administrator', 'rechnung', 14, 10, 2.00, 1106.7000, '', '', 0, 0, '', '', '', '', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, 0, 1, 0, '0000-00-00 00:00:00', '', '', 0, '', '2015-10-26 16:39:52', '', 1, 100.00, 930.00, 930.00, NULL, 0, '', 0.00, NULL, NULL, 0, 0, '', 1, '2015-10-26 16:39:52', NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 0, 0, 0, 'firma', 0, 0, 0, 0, 0, 0);

--
-- Daten für Tabelle `angebot_position`
--

INSERT INTO `angebot_position` (`id`, `angebot`, `artikel`, `projekt`, `bezeichnung`, `beschreibung`, `internerkommentar`, `nummer`, `menge`, `preis`, `waehrung`, `lieferdatum`, `vpe`, `sort`, `status`, `umsatzsteuer`, `bemerkung`, `geliefert`, `logdatei`, `punkte`, `bonuspunkte`, `mlmdirektpraemie`, `keinrabatterlaubt`, `grundrabatt`, `rabattsync`, `rabatt1`, `rabatt2`, `rabatt3`, `rabatt4`, `rabatt5`, `einheit`, `optional`, `rabatt`, `zolltarifnummer`, `herkunftsland`) VALUES
(1, 1, 12, 1, 'Handsteuergerät', 'Kabelgebundenes Steuergerät mit Ein-/Ausschalter und 2 Tastern (Vorwärts/Rückwärts)', '', '700012', 10, 62.0000, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 0, '2015-10-26 16:17:16', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0.00, '0', '0'),
(2, 2, 12, 1, 'Handsteuergerät', 'Kabelgebundenes Steuergerät mit Ein-/Ausschalter und 2 Tastern (Vorwärts/Rückwärts)', '', '700012', 1, 62.0000, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 0, '2015-10-26 16:17:42', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0.00, '0', '0'),
(3, 3, 12, 1, 'Handsteuergerät', 'Kabelgebundenes Steuergerät mit Ein-/Ausschalter und 2 Tastern (Vorwärts/Rückwärts)', '', '700012', 15, 62.0000, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 0, '2015-10-26 16:18:14', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0.00, '0', '0');

--
-- Daten für Tabelle `angebot_protokoll`
--

INSERT INTO `angebot_protokoll` (`id`, `angebot`, `zeit`, `bearbeiter`, `grund`) VALUES
(1, 1, '2015-10-26 17:16:05', 'Administrator2', 'Angebot angelegt'),
(2, 1, '2015-10-26 17:17:19', 'Administrator2', 'Angebot freigegeben'),
(3, 1, '2015-10-26 17:17:26', 'Administrator2', 'Angebot versendet'),
(4, 2, '2015-10-26 17:17:32', 'Administrator2', 'Angebot angelegt'),
(5, 2, '2015-10-26 17:17:46', 'Administrator2', 'Angebot freigegeben'),
(6, 3, '2015-10-26 17:18:02', 'Administrator2', 'Angebot angelegt'),
(7, 3, '2015-10-26 17:18:17', 'Administrator2', 'Angebot freigegeben');

--
-- Daten für Tabelle `artikel`
--

INSERT INTO `artikel` (`id`, `typ`, `nummer`, `checksum`, `projekt`, `inaktiv`, `ausverkauft`, `warengruppe`, `name_de`, `name_en`, `kurztext_de`, `kurztext_en`, `beschreibung_de`, `beschreibung_en`, `uebersicht_de`, `uebersicht_en`, `links_de`, `links_en`, `startseite_de`, `startseite_en`, `standardbild`, `herstellerlink`, `hersteller`, `teilbar`, `nteile`, `seriennummern`, `lager_platz`, `lieferzeit`, `lieferzeitmanuell`, `sonstiges`, `gewicht`, `endmontage`, `funktionstest`, `artikelcheckliste`, `stueckliste`, `juststueckliste`, `barcode`, `hinzugefuegt`, `pcbdecal`, `lagerartikel`, `porto`, `chargenverwaltung`, `provisionsartikel`, `gesperrt`, `sperrgrund`, `geloescht`, `gueltigbis`, `umsatzsteuer`, `klasse`, `adresse`, `shopartikel`, `unishopartikel`, `journalshopartikel`, `shop`, `katalog`, `katalogtext_de`, `katalogtext_en`, `katalogbezeichnung_de`, `katalogbezeichnung_en`, `neu`, `topseller`, `startseite`, `wichtig`, `mindestlager`, `mindestbestellung`, `partnerprogramm_sperre`, `internerkommentar`, `intern_gesperrt`, `intern_gesperrtuser`, `intern_gesperrtgrund`, `inbearbeitung`, `inbearbeitunguser`, `cache_lagerplatzinhaltmenge`, `internkommentar`, `firma`, `logdatei`, `anabregs_text`, `autobestellung`, `produktion`, `herstellernummer`, `restmenge`, `mlmdirektpraemie`, `keineeinzelartikelanzeigen`, `mindesthaltbarkeitsdatum`, `letzteseriennummer`, `individualartikel`, `keinrabatterlaubt`, `rabatt`, `rabatt_prozent`, `geraet`, `serviceartikel`, `autoabgleicherlaubt`, `pseudopreis`, `freigabenotwendig`, `freigaberegel`, `nachbestellt`, `ean`, `mlmpunkte`, `mlmbonuspunkte`, `mlmkeinepunkteeigenkauf`, `shop2`, `shop3`, `usereditid`, `useredittimestamp`, `freifeld1`, `freifeld2`, `freifeld3`, `freifeld4`, `freifeld5`, `freifeld6`, `einheit`, `webid`, `lieferzeitmanuell_en`, `variante`, `variante_von`, `produktioninfo`, `sonderaktion`, `sonderaktion_en`, `autolagerlampe`, `leerfeld`, `zolltarifnummer`, `herkunftsland`, `laenge`, `breite`, `hoehe`, `gebuehr`, `pseudolager`, `downloadartikel`, `matrixprodukt`, `steuer_erloese_inland_normal`, `steuer_aufwendung_inland_normal`, `steuer_erloese_inland_ermaessigt`, `steuer_aufwendung_inland_ermaessigt`, `steuer_erloese_inland_steuerfrei`, `steuer_aufwendung_inland_steuerfrei`, `steuer_erloese_inland_innergemeinschaftlich`, `steuer_aufwendung_inland_innergemeinschaftlich`, `steuer_erloese_inland_eunormal`, `steuer_erloese_inland_nichtsteuerbar`, `steuer_erloese_inland_euermaessigt`, `steuer_aufwendung_inland_nichtsteuerbar`, `steuer_aufwendung_inland_eunormal`, `steuer_aufwendung_inland_euermaessigt`, `steuer_erloese_inland_export`, `steuer_aufwendung_inland_import`, `steuer_art_produkt`, `steuer_art_produkt_download`, `metadescription_de`, `metadescription_en`, `metakeywords_de`, `metakeywords_en`, `anabregs_text_en`) VALUES
(1, 'produkt', '700001', '', 1, '', 0, '', 'Schraube M10x20', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 7, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:36:43', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:36:43', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(2, 'produkt', '700002', '', 1, '', 0, '', 'Sechskant-Mutter M10', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 7, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:25:35', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:25:35', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(3, 'produkt', '700003', '', 1, '', 0, '', 'Schalthebel 20x10', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 8, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:25:49', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:25:49', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(4, 'produkt', '700004', '', 1, '', 0, '', 'Halter L55', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 7, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:26:02', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:26:02', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(5, 'produkt', '700005', '', 1, '', 0, '', 'Rahmen R12 komplett', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 7, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:26:13', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:26:13', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(6, 'produkt', '700006', '', 1, '', 0, '', 'LED Anzeige RLED 24-8', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 8, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:26:27', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:26:27', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(7, 'produkt', '700007', '', 1, '', 0, '', 'Schalter S3 24V 5A', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 8, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:26:59', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:26:59', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(8, 'produkt', '700008', '', 1, '', 0, '', 'Gehäuse GHK5 20x30x10', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 8, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:27:10', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:27:10', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(9, 'produkt', '700009', '', 1, '', 0, '', 'Gehäusedeckel GHK5 20x30 fertig bearbeitet', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:27:46', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:27:46', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(10, 'produkt', '700010', '', 1, '', 0, '', 'Taster TS1 24V 5A', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 8, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:28:33', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:28:33', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(11, 'produkt', '700011', '', 1, '', 0, '', 'Verschlußklammer VSK 10', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 8, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:28:43', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:28:43', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(12, 'produkt', '700012', '', 1, '', 0, '', 'Handsteuergerät Bausatz', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 1, 1, '', '', '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:47:03', 'Kabelgebundenes Steuergerät mit Ein-/Ausschalter und 2 Tastern (Vorwärts/Rückwärts)', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:47:03', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(13, 'produkt', '700013', '', 1, '', 0, '', 'Kabel 3 Adern x 0,2qmm 5m konfektioniert', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 1, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:29:21', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:29:21', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', ''),
(14, 'gebuehr', '100001', '', 1, '', 0, '', 'Versandkosten', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2015-10-26 16:47:05', '', 0, 0, '', 0, 0.00, 0, 0, '', 0, 0, 0, 0.00, 0, 0, 0, 0.00, 0, '', 0, '', 0.00, 0.00, 0, 0, 0, 2, '2015-10-26 16:47:05', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', 0, '', '', 'DE', 0.00, 0.00, 0.00, 0, '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', '', '', '');

--
-- Daten für Tabelle `aufgabe`
--

INSERT INTO `aufgabe` (`id`, `adresse`, `aufgabe`, `beschreibung`, `prio`, `projekt`, `kostenstelle`, `initiator`, `angelegt_am`, `startdatum`, `startzeit`, `intervall_tage`, `stunden`, `abgabe_bis`, `abgeschlossen`, `abgeschlossen_am`, `sonstiges`, `bearbeiter`, `logdatei`, `startseite`, `oeffentlich`, `emailerinnerung`, `emailerinnerung_tage`, `note_x`, `note_y`, `note_z`, `note_color`, `pinwand`, `vorankuendigung`, `status`, `ganztags`, `zeiterfassung_pflicht`, `zeiterfassung_abrechnung`, `kunde`, `pinwand_id`, `sort`, `abgabe_bis_zeit`, `email_gesendet_vorankuendigung`, `email_gesendet`) VALUES
(1, 1, 'Vorbereitung der Umsatzsteuervoranmeldung', 'Vorbereitung der Umsatzsteuervoranmeldung', '', 0, 0, 1, '0000-00-00', '0000-00-00', '00:00:00', 0, NULL, '0000-00-00', 0, '0000-00-00', '', '', '2015-10-26 16:26:22', 1, NULL, NULL, NULL, 21, 162, 2, 'yellow', 1, NULL, 'offen', 1, 0, 0, NULL, 0, NULL, NULL, 0, 0),
(2, 1, 'Neuen Mitarbeiter in Versand einweisen', 'Neuen Mitarbeiter in Versand einweisen', '', 0, 0, 1, '0000-00-00', '0000-00-00', '00:00:00', 0, NULL, '0000-00-00', 0, '2015-10-26', '', '', '2015-10-26 16:28:09', 1, NULL, NULL, NULL, 248, 61, 4, 'blue', 1, NULL, 'abgeschlossen', 1, 0, 0, NULL, 0, NULL, NULL, 0, 0),
(3, 1, 'Blumen im Büro gießen', 'Blumen im Büro gießen', '', 0, 0, 1, '0000-00-00', '0000-00-00', '00:00:00', 0, NULL, '0000-00-00', 0, '0000-00-00', '', '', '2015-10-26 16:28:27', 1, 1, NULL, NULL, 448, 242, 4, 'green', 1, NULL, 'offen', 1, 0, 0, NULL, 0, NULL, NULL, 0, 0),
(4, 1, 'Vorbereiten auf Bewerbungsgespräch', 'Vorbereiten auf Bewerbungsgespräch', '', 0, 0, 1, '0000-00-00', '0000-00-00', '00:00:00', 0, NULL, '0000-00-00', 0, '0000-00-00', '', '', '2015-10-26 16:29:18', NULL, NULL, NULL, NULL, 243, 72, 6, 'blue', 1, NULL, 'offen', 1, 0, 0, NULL, 0, NULL, NULL, 0, 0);

--
-- Daten für Tabelle `auftrag`
--

INSERT INTO `auftrag` (`id`, `datum`, `art`, `projekt`, `belegnr`, `internet`, `bearbeiter`, `angebot`, `freitext`, `internebemerkung`, `status`, `adresse`, `name`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `ansprechpartner`, `plz`, `ort`, `land`, `ustid`, `ust_befreit`, `ust_inner`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `versandart`, `vertrieb`, `zahlungsweise`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `bank_inhaber`, `bank_institut`, `bank_blz`, `bank_konto`, `kreditkarte_typ`, `kreditkarte_inhaber`, `kreditkarte_nummer`, `kreditkarte_pruefnummer`, `kreditkarte_monat`, `kreditkarte_jahr`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `autoversand`, `keinporto`, `keinestornomail`, `abweichendelieferadresse`, `liefername`, `lieferabteilung`, `lieferunterabteilung`, `lieferland`, `lieferstrasse`, `lieferort`, `lieferplz`, `lieferadresszusatz`, `lieferansprechpartner`, `packstation_inhaber`, `packstation_station`, `packstation_ident`, `packstation_plz`, `packstation_ort`, `autofreigabe`, `freigabe`, `nachbesserung`, `gesamtsumme`, `inbearbeitung`, `abgeschlossen`, `nachlieferung`, `lager_ok`, `porto_ok`, `ust_ok`, `check_ok`, `vorkasse_ok`, `nachnahme_ok`, `reserviert_ok`, `partnerid`, `folgebestaetigung`, `zahlungsmail`, `stornogrund`, `stornosonstiges`, `stornorueckzahlung`, `stornobetrag`, `stornobankinhaber`, `stornobankkonto`, `stornobankblz`, `stornobankbank`, `stornogutschrift`, `stornogutschriftbeleg`, `stornowareerhalten`, `stornomanuellebearbeitung`, `stornokommentar`, `stornobezahlt`, `stornobezahltam`, `stornobezahltvon`, `stornoabgeschlossen`, `stornorueckzahlungper`, `stornowareerhaltenretour`, `partnerausgezahlt`, `partnerausgezahltam`, `kennen`, `logdatei`, `keinetrackingmail`, `zahlungsmailcounter`, `rma`, `transaktionsnummer`, `vorabbezahltmarkieren`, `deckungsbeitragcalc`, `deckungsbeitrag`, `erloes_netto`, `umsatz_netto`, `lieferdatum`, `tatsaechlicheslieferdatum`, `liefertermin_ok`, `teillieferung_moeglich`, `kreditlimit_ok`, `kreditlimit_freigabe`, `liefersperre_ok`, `teillieferungvon`, `teillieferungnummer`, `vertriebid`, `aktion`, `provision`, `provision_summe`, `anfrageid`, `gruppe`, `shopextid`, `shopextstatus`, `ihrebestellnummer`, `anschreiben`, `usereditid`, `useredittimestamp`, `realrabatt`, `rabatt`, `einzugsdatum`, `rabatt1`, `rabatt2`, `rabatt3`, `rabatt4`, `rabatt5`, `shop`, `steuersatz_normal`, `steuersatz_zwischen`, `steuersatz_ermaessigt`, `steuersatz_starkermaessigt`, `steuersatz_dienstleistung`, `waehrung`, `keinsteuersatz`, `angebotid`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `typ`, `ohne_briefpapier`, `auftragseingangper`, `lieferid`, `ansprechpartnerid`, `systemfreitext`, `projektfiliale`) VALUES
(1, '2015-10-26', '', '1', '200000', '', 'Administrator2', '100000', '', '', 'freigegeben', 3, 'Max Muster', '', '', 'Musterstrasse 6', '', '', '12345', 'Musterdorf', 'DE', '', 0, 0, 'info@maxmuellermuster.de', '0821123456789', '0821123456790', '', '10000', 'versandunternehmen', 'Administrator2', 'rechnung', 14, 10, 2.00, '', '', '', '', '', '', '', '', '', '', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 737.80, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2015-10-26 16:23:45', NULL, NULL, 0, '', 0, 1, 63.50, 393.70, 620.00, '0000-00-00', NULL, 1, 0, 1, 0, 1, 0, 0, 0, '', 0.00, 0.00, 0, 0, '', '', '', '', 2, '2015-10-26 16:23:45', NULL, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 0, 1, 0, 0, 0, 'firma', NULL, '', 0, 0, '', 0),
(2, '2015-10-26', 'standardauftrag', '1', '200001', '', 'Administrator2', '', '', '', 'freigegeben', 4, 'Eva Müller', '', '', 'Musterweg 12a', '', '', '12345', 'Musterdorf', 'DE', '', 0, 0, '', '089123456789', '089123456790', '', '10001', 'versandunternehmen', 'Administrator2', 'vorkasse', 14, 10, 2.00, '', '', '', '', 'MasterCard', '', '', '', '1', '2009', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', 'DE', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 73.78, 0, 0, 0, 0, 1, 1, 1, 0, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2015-10-26 16:40:29', 0, 0, 0, '', 0, 1, 63.50, 39.37, 62.00, '0000-00-00', '0000-00-00', 1, 1, 1, 0, 1, 0, 0, 0, '', 0.00, 0.00, 0, 0, '', '', '', '', 2, '2015-10-26 16:23:37', 0.00, 0.00, '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 0, 0, 0, 0, 0, 'frau', 0, 'internet', 0, 0, '', 0),
(3, '2015-10-26', '', '1', '200002', '', 'Administrator2', '', '', '', 'freigegeben', 5, 'Hans Huber', '', '', 'Musterstrasse 6', '', '', '12345', 'Musterstadt', 'DE', '', 0, 0, 'hans@huberhausen.de', '017123456745', '', '', '10002', 'versandunternehmen', 'Administrator2', 'rechnung', 14, 10, 2.00, '', '', '', '', '', '', '', '', '', '', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 368.90, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2015-10-26 16:40:29', NULL, NULL, 0, '', 0, 1, 32.77, 101.60, 310.00, NULL, NULL, 1, 1, 1, 0, 1, 0, 0, 0, '', 0.00, NULL, 0, 0, '', '', NULL, '', 2, '2015-10-26 16:23:28', NULL, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', NULL, NULL, 0, 0, 0, 'firma', 0, '', 0, 0, '', 0),
(4, '2015-10-26', '', '1', '200003', '', 'Administrator2', '', '', '', 'freigegeben', 5, 'Hans Huber', '', '', 'Musterstrasse 6', '', '', '12345', 'Musterstadt', 'DE', '', 0, 0, 'hans@huberhausen.de', '017123456745', '', '', '10002', 'versandunternehmen', 'Administrator2', 'rechnung', 14, 10, 2.00, '', '', '', '', '', '', '', '', '', '', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 10.17, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2015-10-26 16:30:20', NULL, NULL, 0, '', 0, 1, 85.96, 7.35, 8.55, NULL, NULL, 1, 0, 1, 0, 1, 0, 0, 0, '', 0.00, NULL, 0, 0, '', '', NULL, '', 2, '2015-10-26 16:30:20', NULL, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', NULL, NULL, 0, 0, 0, 'firma', 0, '', 0, 0, '', 0),
(5, '2015-10-26', '', '1', '200004', '', 'Administrator2', '', '', '', 'abgeschlossen', 5, 'Hans Huber', '', '', 'Musterstrasse 6', '', '', '12345', 'Musterstadt', 'DE', '', 0, 0, 'hans@huberhausen.de', '017123456745', '', '', '10002', 'versandunternehmen', 'Administrator', 'rechnung', 14, 10, 2.00, '', '', '', '', '', '', '', '', '', '', 1, 0, '0000-00-00 00:00:00', '', '', 1, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 10.17, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, '0000-00-00', '0000-00-00', '', '', '', 0.00, '', '', '', '', 0, '', 0, '', '', '', '0000-00-00', '', 0, '', 0, 0, '0000-00-00', '', '2015-10-26 16:40:09', NULL, NULL, 0, '', 0, 1, 85.96, 7.35, 8.55, '0000-00-00', NULL, 1, 0, 1, 0, 1, 0, 0, 0, '', 0.00, 0.00, 0, 0, '', '', '', NULL, 1, '2015-10-26 16:40:09', NULL, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', NULL, 0, 1, 0, 0, 'firma', NULL, '', 0, 0, '', 0);

--
-- Daten für Tabelle `auftrag_position`
--

INSERT INTO `auftrag_position` (`id`, `auftrag`, `artikel`, `projekt`, `bezeichnung`, `beschreibung`, `internerkommentar`, `nummer`, `menge`, `preis`, `waehrung`, `lieferdatum`, `vpe`, `sort`, `status`, `umsatzsteuer`, `bemerkung`, `geliefert`, `geliefert_menge`, `explodiert`, `explodiert_parent`, `logdatei`, `punkte`, `bonuspunkte`, `mlmdirektpraemie`, `keinrabatterlaubt`, `grundrabatt`, `rabattsync`, `rabatt1`, `rabatt2`, `rabatt3`, `rabatt4`, `rabatt5`, `einheit`, `webid`, `rabatt`, `nachbestelltexternereinkauf`, `zolltarifnummer`, `herkunftsland`) VALUES
(1, 1, 12, 1, 'Handsteuergerät', 'Kabelgebundenes Steuergerät mit Ein-/Ausschalter und 2 Tastern (Vorwärts/Rückwärts)', '', '700012', 10, 62.0000, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 0, 0, 1, 0, '2015-10-26 16:23:43', 0.00, 0.00, 0.00, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, '', NULL, 0.00, NULL, '0', '0'),
(2, 2, 12, 1, 'Handsteuergerät', 'Kabelgebundenes Steuergerät mit Ein-/Ausschalter und 2 Tastern (Vorwärts/Rückwärts)', '', '700012', 1, 62.0000, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 0, 0, 1, 0, '2015-10-26 16:23:35', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(3, 3, 12, 1, 'Handsteuergerät', 'Kabelgebundenes Steuergerät mit Ein-/Ausschalter und 2 Tastern (Vorwärts/Rückwärts)', '', '700012', 5, 62.0000, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 0, 0, 1, 0, '2015-10-26 16:23:07', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(4, 3, 1, 1, 'Schraube M10x20', '', '', '700001', 20, 0.0000, '', '0000-00-00', '', 2, 'angelegt', '', '', 0, 0, 0, 3, '2015-10-26 16:23:06', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(5, 3, 8, 1, 'Gehäuse GHK5 20x30x10', '', '', '700008', 5, 0.0000, '', '0000-00-00', '', 3, 'angelegt', '', '', 0, 0, 0, 3, '2015-10-26 16:23:06', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(6, 3, 9, 1, 'Gehäusedeckel GHK5 20x30 fertig bearbeitet', '', '', '700009', 5, 0.0000, '', '0000-00-00', '', 4, 'angelegt', '', '', 0, 0, 0, 3, '2015-10-26 16:23:06', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(7, 3, 13, 1, 'Kabel 3 Adern x 0,2qmm 5m konfektioniert', '', '', '700013', 5, 0.0000, '', '0000-00-00', '', 5, 'angelegt', '', '', 0, 0, 0, 3, '2015-10-26 16:23:06', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(8, 3, 10, 1, 'Taster TS1 24V 5A', '', '', '700010', 10, 0.0000, '', '0000-00-00', '', 6, 'angelegt', '', '', 0, 0, 0, 3, '2015-10-26 16:23:06', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(9, 3, 11, 1, 'Verschlußklammer VSK 10', '', '', '700011', 10, 0.0000, '', '0000-00-00', '', 7, 'angelegt', '', '', 0, 0, 0, 3, '2015-10-26 16:23:07', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(10, 2, 1, 1, 'Schraube M10x20', '', '', '700001', 4, 0.0000, '', '0000-00-00', '', 2, 'angelegt', '', '', 0, 0, 0, 2, '2015-10-26 16:23:35', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(11, 2, 8, 1, 'Gehäuse GHK5 20x30x10', '', '', '700008', 1, 0.0000, '', '0000-00-00', '', 3, 'angelegt', '', '', 0, 0, 0, 2, '2015-10-26 16:23:35', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(12, 2, 9, 1, 'Gehäusedeckel GHK5 20x30 fertig bearbeitet', '', '', '700009', 1, 0.0000, '', '0000-00-00', '', 4, 'angelegt', '', '', 0, 0, 0, 2, '2015-10-26 16:23:35', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(13, 2, 13, 1, 'Kabel 3 Adern x 0,2qmm 5m konfektioniert', '', '', '700013', 1, 0.0000, '', '0000-00-00', '', 5, 'angelegt', '', '', 0, 0, 0, 2, '2015-10-26 16:23:35', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(14, 2, 10, 1, 'Taster TS1 24V 5A', '', '', '700010', 2, 0.0000, '', '0000-00-00', '', 6, 'angelegt', '', '', 0, 0, 0, 2, '2015-10-26 16:23:35', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(15, 2, 11, 1, 'Verschlußklammer VSK 10', '', '', '700011', 2, 0.0000, '', '0000-00-00', '', 7, 'angelegt', '', '', 0, 0, 0, 2, '2015-10-26 16:23:35', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(16, 1, 1, 1, 'Schraube M10x20', '', '', '700001', 40, 0.0000, '', '0000-00-00', '', 2, 'angelegt', '', '', 0, 0, 0, 1, '2015-10-26 16:23:43', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(17, 1, 8, 1, 'Gehäuse GHK5 20x30x10', '', '', '700008', 10, 0.0000, '', '0000-00-00', '', 3, 'angelegt', '', '', 0, 0, 0, 1, '2015-10-26 16:23:43', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(18, 1, 9, 1, 'Gehäusedeckel GHK5 20x30 fertig bearbeitet', '', '', '700009', 10, 0.0000, '', '0000-00-00', '', 4, 'angelegt', '', '', 0, 0, 0, 1, '2015-10-26 16:23:43', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(19, 1, 13, 1, 'Kabel 3 Adern x 0,2qmm 5m konfektioniert', '', '', '700013', 10, 0.0000, '', '0000-00-00', '', 5, 'angelegt', '', '', 0, 0, 0, 1, '2015-10-26 16:23:43', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(20, 1, 10, 1, 'Taster TS1 24V 5A', '', '', '700010', 20, 0.0000, '', '0000-00-00', '', 6, 'angelegt', '', '', 0, 0, 0, 1, '2015-10-26 16:23:43', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(21, 1, 11, 1, 'Verschlußklammer VSK 10', '', '', '700011', 20, 0.0000, '', '0000-00-00', '', 7, 'angelegt', '', '', 0, 0, 0, 1, '2015-10-26 16:23:43', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(22, 4, 1, 1, 'Schraube M10x20', '', '', '700001', 10, 0.1600, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 0, 0, 0, 0, '2015-10-26 16:29:33', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(23, 4, 14, 1, 'Versandkosten', '', '', '100001', 1, 6.9500, 'EUR', '0000-00-00', '1', 2, 'angelegt', '', '', 0, 0, 0, 0, '2015-10-26 16:30:19', 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 0.00, NULL, '0', '0'),
(24, 5, 1, 1, 'Schraube M10x20', '', '', '700001', 10, 0.1600, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 1, 10, 0, 0, '2015-10-26 16:36:23', 0.00, 0.00, 0.00, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', 0.00, 0, '0', '0'),
(25, 5, 14, 1, 'Versandkosten', '', '', '100001', 1, 6.9500, 'EUR', '0000-00-00', '1', 2, 'angelegt', '', '', 0, 0, 0, 0, '2015-10-26 16:36:01', 0.00, 0.00, 0.00, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, '', '', 0.00, 0, '0', '0');

--
-- Daten für Tabelle `auftrag_protokoll`
--

INSERT INTO `auftrag_protokoll` (`id`, `auftrag`, `zeit`, `bearbeiter`, `grund`) VALUES
(1, 1, '2015-10-26 17:18:32', 'Administrator2', 'Auftrag freigegeben'),
(2, 2, '2015-10-26 17:18:36', 'Administrator2', 'Auftrag angelegt'),
(3, 2, '2015-10-26 17:19:08', 'Administrator2', 'Auftrag freigegeben'),
(4, 3, '2015-10-26 17:19:23', 'Administrator2', 'Auftrag angelegt'),
(5, 3, '2015-10-26 17:19:56', 'Administrator2', 'Auftrag freigegeben'),
(6, 4, '2015-10-26 17:24:02', 'Administrator2', 'Auftrag angelegt'),
(7, 4, '2015-10-26 17:29:36', 'Administrator2', 'Auftrag freigegeben'),
(8, 5, '2015-10-26 17:36:07', 'Administrator2', 'Auftrag freigegeben');

--
-- Daten für Tabelle `bestellung`
--

INSERT INTO `bestellung` (`id`, `datum`, `projekt`, `bestellungsart`, `belegnr`, `bearbeiter`, `angebot`, `freitext`, `internebemerkung`, `status`, `adresse`, `name`, `vorname`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `plz`, `ort`, `land`, `abweichendelieferadresse`, `liefername`, `lieferabteilung`, `lieferunterabteilung`, `lieferland`, `lieferstrasse`, `lieferort`, `lieferplz`, `lieferadresszusatz`, `lieferansprechpartner`, `ustid`, `ust_befreit`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `lieferantennummer`, `versandart`, `lieferdatum`, `einkaeufer`, `keineartikelnummern`, `zahlungsweise`, `zahlungsstatus`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `gesamtsumme`, `bank_inhaber`, `bank_institut`, `bank_blz`, `bank_konto`, `paypalaccount`, `bestellbestaetigung`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `logdatei`, `artikelnummerninfotext`, `ansprechpartner`, `anschreiben`, `usereditid`, `useredittimestamp`, `steuersatz_normal`, `steuersatz_zwischen`, `steuersatz_ermaessigt`, `steuersatz_starkermaessigt`, `steuersatz_dienstleistung`, `waehrung`, `bestellungohnepreis`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `typ`, `verbindlichkeiteninfo`, `ohne_briefpapier`, `projektfiliale`, `bestellung_bestaetigt`, `bestaetigteslieferdatum`, `bestellungbestaetigtper`, `bestellungbestaetigtabnummer`, `gewuenschteslieferdatum`) VALUES
(1, '2015-10-26', '1', '', '100000', 'Administrator2', '', '', '', 'freigegeben', 8, 'Elektronik Großhandel', '', '', '', 'Musterweg 12a', '', '12345', 'Musterdorf', 'DE', 0, '', '', '', '', '', '', '', '', '', '', 0, 'elektronik@grosshandel.de', '12345678', '', '', '', '70001', '', '0000-00-00', 'Administrator2', 0, '', '', 0, 0, 0.00, 22.9551, '', '', 0, 0, '', 0, 1, 0, '0000-00-00 00:00:00', '', '', '2015-10-26 16:15:22', 1, NULL, '', 2, '2015-10-26 16:15:22', 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 0, 0, 0, 0, 'firma', '', 0, 0, 0, NULL, '', '', NULL),
(2, '2015-10-26', '1', '', '100001', 'Administrator2', '', '', '', 'freigegeben', 7, 'Schrauben Meier', '', '', '', 'Musterstrasse 6', '', '12345', 'Musterdorf', 'DE', 0, '', '', '', '', '', '', '', '', '', '', 0, 'schrauben@meiermusterdorf.de', '12345678', '', '', '', '70000', '', '0000-00-00', 'Administrator2', 0, '', '', 0, 0, 0.00, 29.7500, '', '', 0, 0, '', 0, 1, 0, '0000-00-00 00:00:00', '', '', '2015-10-26 16:15:50', 1, NULL, '', 2, '2015-10-26 16:15:50', 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 0, 0, 0, 0, 'firma', '', 0, 0, 0, NULL, '', '', NULL);

--
-- Daten für Tabelle `bestellung_position`
--

INSERT INTO `bestellung_position` (`id`, `bestellung`, `artikel`, `projekt`, `bezeichnunglieferant`, `bestellnummer`, `beschreibung`, `menge`, `preis`, `waehrung`, `lieferdatum`, `vpe`, `sort`, `status`, `umsatzsteuer`, `bemerkung`, `geliefert`, `mengemanuellgeliefertaktiviert`, `manuellgeliefertbearbeiter`, `abgerechnet`, `logdatei`, `abgeschlossen`, `einheit`, `zolltarifnummer`, `herkunftsland`) VALUES
(1, 1, 3, 1, 'SCHALT001', '', '', 1, 2.3900, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 0, 0, '', 0, '2015-10-26 16:14:46', NULL, '', '0', '0'),
(3, 1, 11, 1, 'KLAMMER001', '', '', 20, 0.2300, 'EUR', '0000-00-00', '1', 2, 'angelegt', '', '', 0, 0, '', 0, '2015-10-26 16:15:12', NULL, '', '0', '0'),
(4, 1, 10, 1, 'TASTER001', '', '', 10, 1.2300, 'EUR', '0000-00-00', '1', 3, 'angelegt', '', '', 0, 0, '', 0, '2015-10-26 16:15:10', NULL, '', '0', '0'),
(5, 2, 1, 1, 'Schraube M10x20', '', '', 100, 0.1200, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', 0, 0, '', 0, '2015-10-26 16:15:43', NULL, '', '0', '0'),
(6, 2, 2, 1, 'Mutter M10', '124345', '', 100, 0.1300, 'EUR', '0000-00-00', '1', 2, 'angelegt', '', '', 0, 0, '', 0, '2015-10-26 16:15:46', NULL, '', '0', '0');

--
-- Daten für Tabelle `bestellung_protokoll`
--

INSERT INTO `bestellung_protokoll` (`id`, `bestellung`, `zeit`, `bearbeiter`, `grund`) VALUES
(1, 1, '2015-10-26 17:14:34', 'Administrator2', 'Bestellung angelegt'),
(2, 1, '2015-10-26 17:15:15', 'Administrator2', 'Bestellung freigegeben'),
(3, 2, '2015-10-26 17:15:29', 'Administrator2', 'Bestellung angelegt'),
(4, 2, '2015-10-26 17:15:49', 'Administrator2', 'Bestellung freigegeben');

--
-- Daten für Tabelle `datei`
--

INSERT INTO `datei` (`id`, `titel`, `beschreibung`, `nummer`, `geloescht`, `logdatei`, `firma`) VALUES
(1, '', '', '', 0, '2015-10-26 16:17:26', 1),
(2, 'lieferschein', '', '', 0, '2015-10-26 16:36:23', 1);

--
-- Daten für Tabelle `datei_stichwoerter`
--

INSERT INTO `datei_stichwoerter` (`id`, `datei`, `subjekt`, `objekt`, `parameter`, `logdatei`) VALUES
(1, 1, 'angebot', 'angebot', '1', '2015-10-26 16:17:26'),
(2, 2, 'lieferschein', 'lieferschein', '1', '2015-10-26 16:36:24');

--
-- Daten für Tabelle `datei_version`
--

INSERT INTO `datei_version` (`id`, `datei`, `ersteller`, `datum`, `version`, `dateiname`, `bemerkung`, `logdatei`) VALUES
(1, 1, 'Administrator2', '2015-10-26', 1, '20151026_AN100000.pdf', 'Initiale Version', '2015-10-26 16:17:26'),
(2, 2, 'Administrator2', '2015-10-26', 1, '20151026_LS300000.pdf', 'Initiale Version', '2015-10-26 16:36:23');

--
-- Daten für Tabelle `dokumente_send`
--

INSERT INTO `dokumente_send` (`id`, `dokument`, `zeit`, `bearbeiter`, `adresse`, `ansprechpartner`, `projekt`, `parameter`, `art`, `betreff`, `text`, `geloescht`, `versendet`, `logdatei`, `dateiid`) VALUES
(1, 'angebot', '2015-10-26 17:17:26', 'Administrator2', 3, 'Max Muster <info@maxmuellermuster.de>', 1, 1, 'sonstiges', 'Ihr Angebot von Musterfirma GmbH', 'Sehr geehrter Herr \r\n\r\n\r\nanbei das gewünschte Angebot. Wir hoffen Ihnen die passenden Artikel anbieten zu können.\r\n\r\n\r\nMit freundlichen Grüßen\r\n\r\nAdministrator2', 0, 1, '2015-10-26 16:17:26', 1),
(2, 'lieferschein', '2015-10-26 17:36:24', 'Administrator2', 5, '', 1, 1, 'versand', 'Mitgesendet bei Lieferung', '', 0, 0, '2015-10-26 16:36:24', 2);

--
-- Daten für Tabelle `einkaufspreise`
--

INSERT INTO `einkaufspreise` (`id`, `artikel`, `adresse`, `objekt`, `projekt`, `preis`, `waehrung`, `ab_menge`, `vpe`, `preis_anfrage_vom`, `gueltig_bis`, `lieferzeit_standard`, `lieferzeit_aktuell`, `lager_lieferant`, `datum_lagerlieferant`, `bestellnummer`, `bezeichnunglieferant`, `sicherheitslager`, `bemerkung`, `bearbeiter`, `logdatei`, `standard`, `geloescht`, `firma`, `apichange`) VALUES
(1, 5, 7, '', '', 12.9200, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', '123456', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(2, 5, 7, '', '', 10.4500, 'EUR', 10, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', '123456', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(3, 4, 7, '', '', 47.2000, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', '838232', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(4, 3, 8, '', '', 2.3900, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'SCHALT001', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(5, 3, 8, '', '', 1.9200, 'EUR', 100, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'SCHALT001', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(6, 2, 7, '', '', 0.1300, 'EUR', 100, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '124345', 'Mutter M10', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(7, 1, 7, '', '', 0.1200, 'EUR', 100, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'Schraube M10x20', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(8, 11, 8, '', '', 0.2300, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'KLAMMER001', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(9, 10, 8, '', '', 1.2300, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'TASTER001', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(10, 8, 8, '', '', 19.2300, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'GEHK100', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(11, 7, 8, '', '', 3.5400, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'SCHALT002', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(12, 6, 8, '', '', 7.3200, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'LED001', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(13, 9, 8, '', '', 5.8200, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'DECKEL001', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0),
(14, 13, 8, '', '', 13.2300, 'EUR', 1, '1', '0000-00-00', '0000-00-00', 0, 0, 0, '0000-00-00', '', 'SPEZIALKABEL001', 0, '', '', '0000-00-00 00:00:00', 0, 0, 1, 0);




--
-- Daten für Tabelle `kalender_event`
--

INSERT INTO `kalender_event` (`id`, `kalender`, `bezeichnung`, `beschreibung`, `von`, `bis`, `allDay`, `color`, `public`, `ort`) VALUES
(1, 0, 'Telefontermin Fa. Klinger', 'Erstgespräch zu möglicher Kooperation', concat(YEAR(now()),'-',MONTH(now()),'-27 13:00:00'), concat(YEAR(now()),'-',MONTH(now()),'-27 13:30:00'), 0, '#7592A0', 0, 'Büro'),
(2, 0, 'Besuch durch Herrn Bäumlinger', '', concat(YEAR(now()),'-',MONTH(now()),'-22 09:30:00'), concat(YEAR(now()),'-',MONTH(now()),'-22 10:00:00'), 0, '', 1, 'Büro'),
(3, 0, 'Gemeinsames Mittagessen', '', concat(YEAR(now()),'-',MONTH(now()),'-07 10:30:00'), concat(YEAR(now()),'-',MONTH(now()),'-07 11:30:00'), 0, '#004704', 1, 'Zum goldenen Ochsen, Hauptstraße'),
(4, 0, 'Besprechung Vertrieb', '', concat(YEAR(now()),'-',MONTH(now()),'-17 14:00:00'), concat(YEAR(now()),'-',MONTH(now()),'-17 16:00:00'), 0, '#FF8128', 1, 'Besprechungsraum Erdgeschoß'),
(5, 0, 'ISO 9001 Audit', 'Reguläres Audit durch Herrn Richard vom TÜV Süd', concat(YEAR(now()),'-',MONTH(now()),'-28 23:00:00'), concat(YEAR(now()),'-',MONTH(now()),'-30 23:00:00'), 1, '#C40046', 1, 'Gesamte Firma');

--
-- Daten für Tabelle `kalender_user`
--

INSERT INTO `kalender_user` (`id`, `event`, `userid`) VALUES
(2, 2, 1),
(3, 3, 1),
(5, 4, 1),
(7, 5, 1),
(9, 1, 1);

--
-- Daten für Tabelle `lager`
--

INSERT INTO `lager` (`id`, `bezeichnung`, `beschreibung`, `manuell`, `firma`, `geloescht`, `logdatei`, `projekt`) VALUES
(1, 'Hauptlager', '', 0, 1, 0, '0000-00-00 00:00:00', 0);

--
-- Daten für Tabelle `lager_bewegung`
--

INSERT INTO `lager_bewegung` (`id`, `lager_platz`, `artikel`, `menge`, `vpe`, `eingang`, `zeit`, `referenz`, `bearbeiter`, `projekt`, `firma`, `logdatei`, `adresse`, `bestand`, `permanenteinventur`) VALUES
(1, 1, 1, 32, 'einzeln', 1, '2015-10-26 17:12:17', 'Differenz: ', 'Administrator2', 0, 0, '2015-10-26 16:12:17', NULL, 32, 0),
(2, 1, 2, 93, 'einzeln', 1, '2015-10-26 17:12:31', 'Differenz: ', 'Administrator2', 0, 0, '2015-10-26 16:12:31', NULL, 93, 0),
(3, 2, 3, 12, 'einzeln', 1, '2015-10-26 17:12:49', 'Differenz: ', 'Administrator2', 0, 0, '2015-10-26 16:12:49', NULL, 12, 0),
(4, 2, 4, 12, 'einzeln', 1, '2015-10-26 17:13:01', 'Differenz: ', 'Administrator2', 0, 0, '2015-10-26 16:13:01', NULL, 12, 0),
(5, 3, 5, 2, 'einzeln', 1, '2015-10-26 17:13:13', 'Differenz: ', 'Administrator2', 0, 0, '2015-10-26 16:13:13', NULL, 2, 0),
(6, 3, 7, 12, 'einzeln', 1, '2015-10-26 17:13:26', 'Differenz: ', 'Administrator2', 0, 0, '2015-10-26 16:13:26', NULL, 12, 0),
(7, 3, 8, 2, 'einzeln', 1, '2015-10-26 17:13:37', 'Differenz: ', 'Administrator2', 0, 0, '2015-10-26 16:13:37', NULL, 2, 0),
(8, 1, 9, 1, 'einzeln', 1, '2015-10-26 17:13:46', 'Differenz: ', 'Administrator2', 0, 0, '2015-10-26 16:13:46', NULL, 1, 0),
(9, 1, 10, 14, 'einzeln', 1, '2015-10-26 17:13:56', 'Differenz: ', 'Administrator2', 0, 0, '2015-10-26 16:13:56', NULL, 14, 0),
(10, 1, 1, 10, '', 0, '2015-10-26 17:36:23', 'Lieferschein 300000', 'Administrator2', 1, 0, '0000-00-00 00:00:00', NULL, 22, 0);

--
-- Daten für Tabelle `lager_platz`
--

INSERT INTO `lager_platz` (`id`, `lager`, `kurzbezeichnung`, `bemerkung`, `projekt`, `firma`, `geloescht`, `logdatei`, `autolagersperre`, `verbrauchslager`, `sperrlager`, `laenge`, `breite`, `hoehe`, `poslager`) VALUES
(1, 1, 'HL001A', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 10.00, 30.00, 20.00, 0),
(2, 1, 'HL001B', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 10.00, 30.00, 20.00, 0),
(3, 1, 'HL001C', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 10.00, 30.00, 20.00, 0),
(4, 1, 'HL002', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 10.00, 30.00, 20.00, 0),
(5, 1, 'HL003', '', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 100.00, 100.00, 100.00, 0);

--
-- Daten für Tabelle `lager_platz_inhalt`
--

INSERT INTO `lager_platz_inhalt` (`id`, `lager_platz`, `artikel`, `menge`, `vpe`, `bearbeiter`, `bestellung`, `projekt`, `firma`, `logdatei`, `inventur`) VALUES
(20, 1, 2, 93, '', '', 0, 0, 0, '0000-00-00 00:00:00', NULL),
(21, 2, 3, 12, '', '', 0, 0, 0, '0000-00-00 00:00:00', NULL),
(22, 2, 4, 12, '', '', 0, 0, 0, '0000-00-00 00:00:00', NULL),
(23, 3, 5, 2, '', '', 0, 0, 0, '0000-00-00 00:00:00', NULL),
(26, 3, 7, 12, '', '', 0, 0, 0, '0000-00-00 00:00:00', NULL),
(27, 3, 8, 2, '', '', 0, 0, 0, '0000-00-00 00:00:00', NULL),
(28, 1, 9, 1, '', '', 0, 0, 0, '0000-00-00 00:00:00', NULL),
(29, 1, 10, 14, '', '', 0, 0, 0, '0000-00-00 00:00:00', NULL),
(34, 1, 1, 22, '', '', 0, 0, 0, '0000-00-00 00:00:00', NULL);

--
-- Daten für Tabelle `lieferschein`
--

INSERT INTO `lieferschein` (`id`, `datum`, `projekt`, `lieferscheinart`, `belegnr`, `bearbeiter`, `auftrag`, `auftragid`, `freitext`, `status`, `adresse`, `name`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `ansprechpartner`, `plz`, `ort`, `land`, `ustid`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `versandart`, `versand`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `inbearbeitung_user`, `logdatei`, `vertriebid`, `vertrieb`, `ust_befreit`, `ihrebestellnummer`, `anschreiben`, `usereditid`, `useredittimestamp`, `lieferantenretoure`, `lieferantenretoureinfo`, `lieferant`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `typ`, `internebemerkung`, `ohne_briefpapier`, `lieferid`, `ansprechpartnerid`, `projektfiliale`, `projektfiliale_eingelagert`) VALUES
(1, '2015-10-26', '1', '', '300000', 'Administrator2', '200004', 5, '', 'versendet', 5, 'Hans Huber', '', '', 'Musterstrasse 6', '', '', '12345', 'Musterstadt', 'DE', '', 'hans@huberhausen.de', '017123456745', '', '', '10002', 'versandunternehmen', 'Administrator2', 1, 1, '0000-00-00 00:00:00', '', '', 0, '2015-10-26 16:39:31', 0, 'Administrator', 0, '', '', 1, '2015-10-26 16:39:31', 0, '', 0, 1, 0, 0, 'firma', '', NULL, 0, 0, 0, 0);

--
-- Daten für Tabelle `lieferschein_position`
--

INSERT INTO `lieferschein_position` (`id`, `lieferschein`, `artikel`, `projekt`, `bezeichnung`, `beschreibung`, `internerkommentar`, `nummer`, `seriennummer`, `menge`, `lieferdatum`, `vpe`, `sort`, `status`, `bemerkung`, `geliefert`, `abgerechnet`, `logdatei`, `explodiert_parent_artikel`, `einheit`, `zolltarifnummer`, `herkunftsland`) VALUES
(1, 1, 1, 1, 'Schraube M10x20', '', '', '700001', '', 10, '0000-00-00', '1', 1, 'angelegt', '', 10, 0, '2015-10-26 16:36:23', 0, '', '0', '0'),
(2, 1, 14, 1, 'Versandkosten', '', '', '100001', '', 1, '0000-00-00', '1', 2, 'angelegt', '', 1, 0, '2015-10-26 16:36:23', 0, '', '0', '0');

--
-- Daten für Tabelle `lieferschein_protokoll`
--

INSERT INTO `lieferschein_protokoll` (`id`, `lieferschein`, `zeit`, `bearbeiter`, `grund`) VALUES
(1, 1, '2015-10-26 17:36:24', 'Administrator2', 'Lieferschein versendet (Auto-Versand)');

--
-- Daten für Tabelle `objekt_protokoll`
--

INSERT INTO `objekt_protokoll` (`id`, `objekt`, `objektid`, `action_long`, `meldung`, `bearbeiter`, `zeitstempel`) VALUES
(1, 'lager', 1, 'lager_create', 'Lager angelegt', 'Administrator', '2015-10-26 16:34:09'),
(2, 'artikel', 1, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:37:47'),
(3, 'artikel', 2, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:38:17'),
(4, 'artikel', 3, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:38:53'),
(5, 'artikel', 4, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:51:03'),
(6, 'artikel', 5, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:51:37'),
(7, 'artikel', 6, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:53:19'),
(8, 'artikel', 7, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:53:55'),
(9, 'artikel', 8, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:55:01'),
(10, 'artikel', 9, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:55:36'),
(11, 'artikel', 10, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:56:29'),
(12, 'adresse', 3, 'adresse_create', 'Adresse angelegt', 'Administrator2', '2015-10-26 16:56:48'),
(13, 'artikel', 11, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 16:56:50'),
(14, 'adresse', 3, 'adresse_next_kundennummer', 'Kundennummer erhalten: 10000', 'Administrator2', '2015-10-26 16:56:52'),
(15, 'adresse', 4, 'adresse_create', 'Adresse angelegt', 'Administrator2', '2015-10-26 16:57:45'),
(16, 'adresse', 4, 'adresse_next_kundennummer', 'Kundennummer erhalten: 10001', 'Administrator2', '2015-10-26 16:57:49'),
(17, 'adresse', 5, 'adresse_create', 'Adresse angelegt', 'Administrator2', '2015-10-26 16:59:07'),
(18, 'adresse', 5, 'adresse_next_kundennummer', 'Kundennummer erhalten: 10002', 'Administrator2', '2015-10-26 16:59:10'),
(19, 'adresse', 6, 'adresse_create', 'Adresse angelegt', 'Administrator2', '2015-10-26 17:00:23'),
(20, 'adresse', 6, 'adresse_next_mitarbeiternummer', 'Mitarbeiternummer erhalten: 90000', 'Administrator2', '2015-10-26 17:00:28'),
(21, 'artikel', 12, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 17:04:40'),
(22, 'adresse', 7, 'adresse_create', 'Adresse angelegt', 'Administrator2', '2015-10-26 17:04:44'),
(23, 'adresse', 7, 'adresse_next_lieferantennummer', 'Lieferantennummer erhalten: 70000', 'Administrator2', '2015-10-26 17:04:49'),
(24, 'adresse', 8, 'adresse_create', 'Adresse angelegt', 'Administrator2', '2015-10-26 17:05:26'),
(25, 'adresse', 8, 'adresse_next_lieferantennummer', 'Lieferantennummer erhalten: 70001', 'Administrator2', '2015-10-26 17:05:42'),
(26, 'artikel', 13, 'artikel_create', 'Artikel angelegt', 'Administrator', '2015-10-26 17:06:32'),
(27, 'stueckliste', 1, 'stueckliste_create', 'Stueckliste angelegt', 'Administrator', '2015-10-26 17:07:23'),
(28, 'stueckliste', 2, 'stueckliste_create', 'Stueckliste angelegt', 'Administrator', '2015-10-26 17:07:34'),
(29, 'einkaufspreise', 1, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:07:43'),
(30, 'stueckliste', 3, 'stueckliste_create', 'Stueckliste angelegt', 'Administrator', '2015-10-26 17:07:48'),
(31, 'stueckliste', 4, 'stueckliste_create', 'Stueckliste angelegt', 'Administrator', '2015-10-26 17:08:04'),
(32, 'stueckliste', 5, 'stueckliste_create', 'Stueckliste angelegt', 'Administrator', '2015-10-26 17:08:17'),
(33, 'einkaufspreise', 3, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:08:25'),
(34, 'einkaufspreise', 4, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:08:48'),
(35, 'stueckliste', 6, 'stueckliste_create', 'Stueckliste angelegt', 'Administrator', '2015-10-26 17:09:14'),
(36, 'einkaufspreise', 6, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:09:34'),
(37, 'stueckliste', 7, 'stueckliste_create', 'Stueckliste angelegt', 'Administrator', '2015-10-26 17:09:53'),
(38, 'einkaufspreise', 7, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:09:58'),
(39, 'einkaufspreise', 8, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:10:17'),
(40, 'einkaufspreise', 9, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:10:40'),
(41, 'einkaufspreise', 10, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:11:04'),
(42, 'einkaufspreise', 11, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:11:23'),
(43, 'einkaufspreise', 12, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:11:46'),
(44, 'verkaufspreise', 1, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:17:06'),
(45, 'verkaufspreise', 2, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:25:20'),
(46, 'verkaufspreise', 3, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:25:35'),
(47, 'verkaufspreise', 4, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:25:48'),
(48, 'verkaufspreise', 5, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:26:02'),
(49, 'verkaufspreise', 6, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:26:12'),
(50, 'verkaufspreise', 7, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:26:26'),
(51, 'verkaufspreise', 8, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:26:36'),
(52, 'verkaufspreise', 9, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:26:47'),
(53, 'verkaufspreise', 10, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:27:09'),
(54, 'einkaufspreise', 13, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:27:37'),
(55, 'verkaufspreise', 11, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:27:46'),
(56, 'verkaufspreise', 12, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:28:33'),
(57, 'verkaufspreise', 13, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:28:42'),
(58, 'einkaufspreise', 14, 'einkaufspreise_create', 'Einkaufspreise angelegt', 'Administrator2', '2015-10-26 17:29:13'),
(59, 'verkaufspreise', 14, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:29:21'),
(60, 'artikel', 14, 'artikel_create', 'Artikel angelegt', 'Administrator2', '2015-10-26 17:29:47'),
(61, 'verkaufspreise', 15, 'verkaufspreise_create', 'Verkaufspreise angelegt', 'Administrator2', '2015-10-26 17:30:04');

--
-- Daten für Tabelle `paketannahme`
--

INSERT INTO `paketannahme` (`id`, `adresse`, `datum`, `verpackungszustand`, `bemerkung`, `foto`, `gewicht`, `bearbeiter`, `projekt`, `vorlage`, `vorlageid`, `zahlung`, `betrag`, `status`, `beipack_rechnung`, `beipack_lieferschein`, `beipack_anschreiben`, `beipack_gesamt`, `bearbeiter_distribution`, `postgrund`, `logdatei`) VALUES
(1, 8, '2015-10-26 17:37:51', 0, '', 0, '', 'Administrator', 1, 'adresse', '8', '', 0.0000, 'angenommen', 0, 0, 0, 0, '', '', '2015-10-26 16:37:51');

--
-- Daten für Tabelle `pdfmirror_md5pool`
--

INSERT INTO `pdfmirror_md5pool` (`id`, `zeitstempel`, `checksum`, `table_id`, `table_name`, `bearbeiter`, `erstesoriginal`) VALUES
(1, '2015-10-26 17:17:23', '', 1, 'angebot', 'Administrator2', 1),
(2, '2015-10-26 17:17:23', 'a4dc135088a29be6491585eaf49af797', 1, 'angebot', 'Administrator2', 0),
(3, '2015-10-26 17:36:23', '', 1, 'lieferschein', 'Administrator2', 1),
(4, '2015-10-26 17:36:23', 'aa57f0d5ca21d5d11a6d5755593b4fa5', 1, 'lieferschein', 'Administrator2', 0),
(5, '2015-10-26 17:39:58', '', 3, 'angebot', 'Administrator', 1),
(6, '2015-10-26 17:39:58', '98113d469e4c218cf22173626a1df7d6', 3, 'angebot', 'Administrator', 0),
(7, '2015-10-26 17:40:13', '', 3, 'auftrag', 'Administrator', 1),
(8, '2015-10-26 17:40:13', '714589efc1ad89880f8caf08df8dee96', 3, 'auftrag', 'Administrator', 0);

--
-- Daten für Tabelle `pinwand`
--

INSERT INTO `pinwand` (`id`, `name`, `user`) VALUES
(1, 'Erforschen von WaWision', 1);

--
-- Daten für Tabelle `pinwand_user`
--

INSERT INTO `pinwand_user` (`id`, `pinwand`, `user`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);


--
-- Daten für Tabelle `protokoll`
--

INSERT INTO `protokoll` (`id`, `meldung`, `dump`, `module`, `action`, `bearbeiter`, `funktionsname`, `datum`, `parameter`, `argumente`) VALUES
(1, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 15:19:42', 0, ''),
(2, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 15:19:49', 0, ''),
(3, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 15:21:04', 0, ''),
(4, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 15:21:07', 0, ''),
(5, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 15:28:57', 0, ''),
(6, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 15:33:02', 0, ''),
(7, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 15:33:10', 0, ''),
(8, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 15:33:10', 0, ''),
(9, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 15:33:11', 0, ''),
(10, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:33:49', 0, ''),
(11, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:36:36', 0, ''),
(12, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:36:51', 0, ''),
(13, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:37:29', 0, ''),
(14, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:37:46', 0, ''),
(15, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:38:51', 0, ''),
(16, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:40:51', 0, ''),
(17, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:41:08', 0, ''),
(18, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:41:50', 0, ''),
(19, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:02', 0, ''),
(20, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:02', 0, ''),
(21, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:06', 0, ''),
(22, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:06', 0, ''),
(23, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:10', 0, ''),
(24, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:10', 0, ''),
(25, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:13', 0, ''),
(26, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:13', 0, ''),
(27, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:17', 0, ''),
(28, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:17', 0, ''),
(29, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:23', 0, ''),
(30, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:23', 0, ''),
(31, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:34', 0, ''),
(32, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:34', 0, ''),
(33, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:42', 0, ''),
(34, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:42', 0, ''),
(35, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:50', 0, ''),
(36, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:50', 0, ''),
(37, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:42:56', 0, ''),
(38, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:42:56', 0, ''),
(39, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:43:01', 0, ''),
(40, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:43:01', 0, ''),
(41, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:43:05', 0, ''),
(42, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:43:05', 0, ''),
(43, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:43:11', 0, ''),
(44, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:43:11', 0, ''),
(45, '', '', 'firmendaten', 'nextnumber', 'Administrator', 'Run', '2015-10-26 15:43:20', 0, ''),
(46, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:43:20', 0, ''),
(47, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:43:23', 0, ''),
(48, '', '', 'firmendaten', 'edit', 'Administrator', 'Run', '2015-10-26 15:46:58', 0, ''),
(49, '', '', 'geschaeftsbrief_vorlagen', 'edit', 'Administrator', 'Run', '2015-10-26 15:47:34', 2, ''),
(50, '', '', 'geschaeftsbrief_vorlagen', 'edit', 'Administrator', 'Run', '2015-10-26 15:47:59', 2, ''),
(51, '', '', 'geschaeftsbrief_vorlagen', 'edit', 'Administrator', 'Run', '2015-10-26 15:47:59', 2, ''),
(52, '', '', 'geschaeftsbrief_vorlagen', 'edit', 'Administrator', 'Run', '2015-10-26 15:48:13', 2, ''),
(53, '', '', 'geschaeftsbrief_vorlagen', 'edit', 'Administrator', 'Run', '2015-10-26 15:48:13', 2, ''),
(54, '', '', 'geschaeftsbrief_vorlagen', 'edit', 'Administrator', 'Run', '2015-10-26 15:48:34', 3, ''),
(55, '', '', 'geschaeftsbrief_vorlagen', 'edit', 'Administrator', 'Run', '2015-10-26 15:48:42', 14, ''),
(56, '', '', 'geschaeftsbrief_vorlagen', 'edit', 'Administrator', 'Run', '2015-10-26 15:49:01', 14, ''),
(57, '', '', 'geschaeftsbrief_vorlagen', 'edit', 'Administrator', 'Run', '2015-10-26 15:49:09', 13, ''),
(58, '', '', 'geschaeftsbrief_vorlagen', 'delete', 'Administrator', 'Run', '2015-10-26 15:49:22', 13, ''),
(59, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 16:28:10', 0, ''),
(60, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 16:28:16', 0, ''),
(61, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 16:28:16', 0, ''),
(62, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 16:28:17', 0, ''),
(63, '', '', 'prozessstarter', 'edit', 'Administrator', 'Run', '2015-10-26 16:28:33', 6, ''),
(64, '', '', 'prozessstarter', 'edit', 'Administrator', 'Run', '2015-10-26 16:28:40', 3, ''),
(65, '', '', 'prozessstarter', 'edit', 'Administrator', 'Run', '2015-10-26 16:30:04', 8, ''),
(66, '', '', 'prozessstarter', 'edit', 'Administrator', 'Run', '2015-10-26 16:30:11', 8, ''),
(67, '', '', 'prozessstarter', 'edit', 'Administrator', 'Run', '2015-10-26 16:30:12', 8, ''),
(68, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:33:09', 0, ''),
(69, '', '', 'lager', 'create', 'Administrator', 'Run', '2015-10-26 16:33:56', 0, ''),
(70, '', '', 'lager', 'create', 'Administrator', 'Run', '2015-10-26 16:34:09', 0, ''),
(71, '', '', 'lager', 'edit', 'Administrator', 'Run', '2015-10-26 16:34:09', 1, ''),
(72, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:34:12', 1, ''),
(73, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:35:16', 1, ''),
(74, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:35:16', 1, ''),
(75, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:35:36', 1, ''),
(76, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:35:36', 1, ''),
(77, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:35:56', 1, ''),
(78, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:35:56', 1, ''),
(79, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:36:08', 1, ''),
(80, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:36:08', 1, ''),
(81, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:36:29', 1, ''),
(82, '', '', 'lager', 'platz', 'Administrator', 'Run', '2015-10-26 16:36:29', 1, ''),
(83, '', '', 'lager', 'wert', 'Administrator', 'Run', '2015-10-26 16:36:54', 0, ''),
(84, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 16:36:55', 0, ''),
(85, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 16:37:02', 0, ''),
(86, '', '', 'welcome', 'start', 'Administrator2', 'Run', '2015-10-26 16:37:02', 0, ''),
(87, '', '', 'kalender', 'data', 'Administrator2', 'Run', '2015-10-26 16:37:05', 0, ''),
(88, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:37:15', 0, ''),
(89, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:37:47', 0, ''),
(90, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:37:47', 1, ''),
(91, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:37:50', 0, ''),
(92, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:38:17', 0, ''),
(93, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:38:17', 2, ''),
(94, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:38:20', 0, ''),
(95, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:38:53', 0, ''),
(96, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:39:02', 0, ''),
(97, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:39:05', 2, ''),
(98, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:40:18', 2, ''),
(99, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:40:41', 2, ''),
(100, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:41:52', 2, ''),
(101, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:42:03', 2, ''),
(102, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:42:11', 2, ''),
(103, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:44:59', 2, ''),
(104, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:45:02', 2, ''),
(105, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:45:05', 2, ''),
(106, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:45:45', 2, ''),
(107, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:45:47', 2, ''),
(108, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:50:11', 2, ''),
(109, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:50:35', 2, ''),
(110, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:50:38', 2, ''),
(111, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:50:41', 0, ''),
(112, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:51:03', 0, ''),
(113, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:51:03', 4, ''),
(114, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:51:07', 0, ''),
(115, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:51:37', 0, ''),
(116, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:51:37', 5, ''),
(117, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:51:56', 0, ''),
(118, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:53:19', 0, ''),
(119, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:53:20', 6, ''),
(120, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:53:23', 0, ''),
(121, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:53:55', 0, ''),
(122, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:53:55', 7, ''),
(123, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:53:58', 0, ''),
(124, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:55:01', 0, ''),
(125, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:55:01', 8, ''),
(126, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:55:05', 0, ''),
(127, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:55:35', 0, ''),
(128, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:55:36', 9, ''),
(129, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:55:40', 0, ''),
(130, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 16:55:42', 0, ''),
(131, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 16:55:45', 0, ''),
(132, '', '', 'welcome', 'start', 'Administrator2', 'Run', '2015-10-26 16:55:45', 0, ''),
(133, '', '', 'kalender', 'data', 'Administrator2', 'Run', '2015-10-26 16:55:46', 0, ''),
(134, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 16:55:54', 0, ''),
(135, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:56:29', 0, ''),
(136, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:56:29', 10, ''),
(137, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:56:35', 0, ''),
(138, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 16:56:48', 0, ''),
(139, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:56:48', 3, ''),
(140, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 16:56:49', 0, ''),
(141, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:56:50', 11, ''),
(142, '', '', 'adresse', 'rollen', 'Administrator2', 'Run', '2015-10-26 16:56:52', 3, ''),
(143, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:56:52', 3, ''),
(144, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 16:56:56', 0, ''),
(145, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:57:14', 11, ''),
(146, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 16:57:17', 11, ''),
(147, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 16:57:45', 0, ''),
(148, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:57:45', 4, ''),
(149, '', '', 'adresse', 'rollen', 'Administrator2', 'Run', '2015-10-26 16:57:49', 4, ''),
(150, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:57:49', 4, ''),
(151, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:58:00', 4, ''),
(152, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:58:11', 3, ''),
(153, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:58:17', 3, ''),
(154, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:58:21', 3, ''),
(155, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 16:58:29', 0, ''),
(156, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 16:59:07', 0, ''),
(157, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:59:07', 5, ''),
(158, '', '', 'adresse', 'rollen', 'Administrator2', 'Run', '2015-10-26 16:59:10', 5, ''),
(159, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 16:59:10', 5, ''),
(160, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 16:59:19', 0, ''),
(161, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 17:00:23', 0, ''),
(162, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 17:00:23', 6, ''),
(163, '', '', 'adresse', 'rollen', 'Administrator2', 'Run', '2015-10-26 17:00:28', 6, ''),
(164, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 17:00:28', 6, ''),
(165, '', '', 'benutzer', 'create', 'Administrator2', 'Run', '2015-10-26 17:00:34', 0, ''),
(166, '', '', 'benutzer', 'create', 'Administrator2', 'Run', '2015-10-26 17:00:53', 0, ''),
(167, '', '', 'benutzer', 'edit', 'Administrator2', 'Run', '2015-10-26 17:00:53', 3, ''),
(168, '', '', 'benutzer', 'edit', 'Administrator2', 'Run', '2015-10-26 17:01:01', 3, ''),
(169, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(170, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(171, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(172, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(173, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(174, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(175, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(176, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(177, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(178, '', '', 'benutzer', 'chrights', 'Administrator2', 'Run', '2015-10-26 17:01:14', 0, ''),
(179, '', '', 'welcome', 'logout', 'Administrator2', 'Run', '2015-10-26 17:01:17', 0, ''),
(180, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 17:01:17', 0, ''),
(181, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:01:19', 11, ''),
(182, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:01:22', 11, ''),
(183, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 17:01:23', 0, ''),
(184, '', '', 'welcome', 'start', 'Anton Lechner', 'Run', '2015-10-26 17:01:24', 0, ''),
(185, '', '', 'welcome', 'logout', 'Anton Lechner', 'Run', '2015-10-26 17:01:28', 0, ''),
(186, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 17:01:28', 0, ''),
(187, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 17:01:31', 0, ''),
(188, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 17:01:36', 0, ''),
(189, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 17:02:32', 0, ''),
(190, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:02:32', 3, ''),
(191, '', '', 'welcome', 'start', 'Administrator2', 'Run', '2015-10-26 17:02:33', 0, ''),
(192, '', '', 'kalender', 'data', 'Administrator2', 'Run', '2015-10-26 17:02:33', 0, ''),
(193, '', '', 'artikel', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:02:38', 11, ''),
(194, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:02:41', 3, ''),
(195, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:02:43', 3, ''),
(196, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:02:46', 3, ''),
(197, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:02:49', 3, ''),
(198, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:02:50', 3, ''),
(199, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:02:55', 3, ''),
(200, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 17:03:04', 0, ''),
(201, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 17:04:10', 0, ''),
(202, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 17:04:40', 0, ''),
(203, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:04:40', 12, ''),
(204, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 17:04:44', 0, ''),
(205, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 17:04:44', 7, ''),
(206, '', '', 'adresse', 'rollen', 'Administrator2', 'Run', '2015-10-26 17:04:49', 7, ''),
(207, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 17:04:49', 7, ''),
(208, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 17:04:51', 0, ''),
(209, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 17:04:52', 0, ''),
(210, '', '', 'adresse', 'create', 'Administrator2', 'Run', '2015-10-26 17:05:26', 0, ''),
(211, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 17:05:26', 8, ''),
(212, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 17:05:30', 8, ''),
(213, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 17:05:35', 8, ''),
(214, '', '', 'adresse', 'rollen', 'Administrator2', 'Run', '2015-10-26 17:05:42', 8, ''),
(215, '', '', 'adresse', 'edit', 'Administrator2', 'Run', '2015-10-26 17:05:42', 8, ''),
(216, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 17:06:32', 0, ''),
(217, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:06:32', 13, ''),
(218, '', '', 'artikel', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:06:35', 12, ''),
(219, '', '', 'artikel', 'create', 'Administrator', 'Run', '2015-10-26 17:06:36', 0, ''),
(220, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:06:39', 13, ''),
(221, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:06:42', 11, ''),
(222, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:06:44', 10, ''),
(223, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:06:46', 12, ''),
(224, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:06:47', 8, ''),
(225, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:06:50', 7, ''),
(226, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:06:54', 6, ''),
(227, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:06:56', 12, ''),
(228, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:06:59', 12, ''),
(229, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:07:05', 12, ''),
(230, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:07:05', 5, ''),
(231, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:07:08', 4, ''),
(232, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:07:12', 3, ''),
(233, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:07:15', 2, ''),
(234, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:07:18', 1, ''),
(235, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:07:22', 12, ''),
(236, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:07:23', 12, ''),
(237, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:07:23', 5, ''),
(238, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:07:34', 12, ''),
(239, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:07:35', 12, ''),
(240, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:07:43', 5, ''),
(241, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:07:43', 5, ''),
(242, '', '', 'artikel', 'einkaufcopy', 'Administrator2', 'Run', '2015-10-26 17:07:47', 1, ''),
(243, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:07:47', 5, ''),
(244, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:07:48', 12, ''),
(245, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:07:48', 12, ''),
(246, '', '', 'artikel', 'einkaufeditpopup', 'Administrator2', 'Run', '2015-10-26 17:07:49', 2, ''),
(247, '', '', 'artikel', 'einkaufeditpopup', 'Administrator2', 'Run', '2015-10-26 17:07:58', 2, ''),
(248, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:07:59', 5, ''),
(249, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:08:04', 12, ''),
(250, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:08:04', 12, ''),
(251, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:08:06', 4, ''),
(252, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:08:17', 12, ''),
(253, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:08:18', 12, ''),
(254, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:08:25', 4, ''),
(255, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:08:25', 4, ''),
(256, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:08:31', 7, ''),
(257, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:08:32', 3, ''),
(258, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:08:48', 12, ''),
(259, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:08:48', 3, ''),
(260, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:08:48', 3, ''),
(261, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:08:52', 12, ''),
(262, '', '', 'artikel', 'einkaufcopy', 'Administrator2', 'Run', '2015-10-26 17:08:53', 4, ''),
(263, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:08:53', 3, ''),
(264, '', '', 'artikel', 'einkaufeditpopup', 'Administrator2', 'Run', '2015-10-26 17:08:56', 5, ''),
(265, '', '', 'artikel', 'delstueckliste', 'Administrator', 'Run', '2015-10-26 17:08:58', 5, ''),
(266, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:08:58', 12, ''),
(267, '', '', 'artikel', 'einkaufeditpopup', 'Administrator2', 'Run', '2015-10-26 17:09:05', 5, ''),
(268, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:09:06', 3, ''),
(269, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:09:09', 2, ''),
(270, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:09:14', 12, ''),
(271, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:09:14', 12, ''),
(272, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:09:34', 2, ''),
(273, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:09:34', 2, ''),
(274, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:09:38', 1, ''),
(275, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:09:53', 12, ''),
(276, '', '', 'artikel', 'stueckliste', 'Administrator', 'Run', '2015-10-26 17:09:53', 12, ''),
(277, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:09:58', 1, ''),
(278, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:09:59', 1, ''),
(279, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:10:03', 12, ''),
(280, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:10:04', 11, ''),
(281, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:10:17', 11, ''),
(282, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:10:17', 11, ''),
(283, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:10:20', 10, ''),
(284, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:10:30', 12, ''),
(285, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:10:31', 10, ''),
(286, '', '', 'artikel', 'edit', 'Administrator', 'Run', '2015-10-26 17:10:33', 12, ''),
(287, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:10:40', 10, ''),
(288, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:10:40', 10, ''),
(289, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:10:43', 8, ''),
(290, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:11:00', 0, ''),
(291, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:11:04', 8, ''),
(292, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:11:04', 8, ''),
(293, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:11:05', 0, ''),
(294, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:11:07', 7, ''),
(295, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:11:23', 7, ''),
(296, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:11:24', 7, ''),
(297, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:11:28', 6, ''),
(298, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:11:46', 6, ''),
(299, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:11:46', 6, ''),
(300, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:01', 0, ''),
(301, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:11', 0, ''),
(302, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:17', 0, ''),
(303, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:17', 0, ''),
(304, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:25', 0, ''),
(305, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:31', 0, ''),
(306, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:31', 0, ''),
(307, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:43', 0, ''),
(308, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:49', 0, ''),
(309, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:50', 0, ''),
(310, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:12:57', 0, ''),
(311, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:01', 0, ''),
(312, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:01', 0, ''),
(313, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:13:04', 0, ''),
(314, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:09', 0, ''),
(315, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:13', 0, ''),
(316, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:14', 0, ''),
(317, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:20', 0, ''),
(318, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:26', 0, ''),
(319, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:26', 0, ''),
(320, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:33', 0, ''),
(321, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:37', 0, ''),
(322, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:37', 0, ''),
(323, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:42', 0, ''),
(324, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:46', 0, ''),
(325, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:46', 0, ''),
(326, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:53', 0, ''),
(327, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:13:54', 0, ''),
(328, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:56', 0, ''),
(329, '', '', 'lager', 'bucheneinlagern', 'Administrator2', 'Run', '2015-10-26 17:13:57', 0, ''),
(330, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:14:14', 12, ''),
(331, '', '', 'welcome', 'unlock', 'Administrator2', 'Run', '2015-10-26 17:14:18', 12, ''),
(332, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:14:18', 12, ''),
(333, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:14:25', 12, ''),
(334, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:14:28', 12, ''),
(335, '', '', 'bestellung', 'create', 'Administrator2', 'Run', '2015-10-26 17:14:34', 0, ''),
(336, '', '', 'bestellung', 'create', 'Administrator2', 'Run', '2015-10-26 17:14:34', 0, ''),
(337, '', '', 'bestellung', 'edit', 'Administrator2', 'Run', '2015-10-26 17:14:35', 1, ''),
(338, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:14:35', 1, ''),
(339, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:14:35', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(340, '', '', 'bestellung', 'edit', 'Administrator2', 'Run', '2015-10-26 17:14:39', 1, ''),
(341, '', '', 'bestellung', 'edit', 'Administrator2', 'Run', '2015-10-26 17:14:39', 1, ''),
(342, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:14:39', 1, ''),
(343, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:14:40', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(344, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:14:45', 700003, ''),
(345, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:14:45', 700003, ''),
(346, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:14:46', 1, ''),
(347, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:14:46', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(348, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:14:49', 700003, ''),
(349, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:14:49', 700003, ''),
(350, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:14:50', 1, ''),
(351, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:14:50', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(352, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:14:56', 700011, ''),
(353, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:14:56', 700011, ''),
(354, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:14:57', 1, ''),
(355, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:14:57', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(356, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:02', 0, ''),
(357, '', '', 'bestellung', 'delbestellungposition', 'Administrator2', 'Run', '2015-10-26 17:15:02', 1, ''),
(358, 'AUFTRAG BELEG ', '', 'bestellung', 'delbestellungposition', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:15:02', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(359, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:05', 700010, ''),
(360, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:05', 700010, ''),
(361, '', '', 'bestellung', 'delbestellungposition', 'Administrator2', 'Run', '2015-10-26 17:15:06', 1, ''),
(362, 'AUFTRAG BELEG ', '', 'bestellung', 'delbestellungposition', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:15:06', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(363, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:09', 0, ''),
(364, '', '', 'bestellung', 'editable', 'Administrator2', 'Run', '2015-10-26 17:15:10', 0, ''),
(365, '', '', 'bestellung', 'editable', 'Administrator2', 'Run', '2015-10-26 17:15:12', 0, ''),
(366, '', '', 'bestellung', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:15:14', 1, ''),
(367, '', '', 'bestellung', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:15:15', 1, ''),
(368, '', '', 'bestellung', 'edit', 'Administrator2', 'Run', '2015-10-26 17:15:15', 1, ''),
(369, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:15:16', 1, ''),
(370, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:15:16', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(371, '', '', 'bestellung', 'edit', 'Administrator2', 'Run', '2015-10-26 17:15:21', 1, ''),
(372, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:15:22', 1, ''),
(373, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:15:22', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(374, '', '', 'bestellung', 'inlinepdf', 'Administrator2', 'Run', '2015-10-26 17:15:23', 1, ''),
(375, '', '', 'bestellung', 'inlinepdf', 'Administrator2', 'Run', '2015-10-26 17:15:24', 1, ''),
(376, '', '', 'bestellung', 'create', 'Administrator2', 'Run', '2015-10-26 17:15:29', 0, ''),
(377, '', '', 'bestellung', 'create', 'Administrator2', 'Run', '2015-10-26 17:15:29', 0, ''),
(378, '', '', 'bestellung', 'edit', 'Administrator2', 'Run', '2015-10-26 17:15:29', 2, ''),
(379, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:15:29', 2, ''),
(380, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:15:29', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(381, '', '', 'bestellung', 'edit', 'Administrator2', 'Run', '2015-10-26 17:15:33', 2, ''),
(382, '', '', 'bestellung', 'edit', 'Administrator2', 'Run', '2015-10-26 17:15:33', 2, ''),
(383, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:15:34', 2, ''),
(384, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:15:34', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(385, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:38', 0, ''),
(386, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:38', 0, ''),
(387, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:39', 0, ''),
(388, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:41', 700001, ''),
(389, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:41', 700001, ''),
(390, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:15:43', 2, ''),
(391, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:15:43', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(392, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:45', 700002, ''),
(393, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:45', 700002, ''),
(394, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:15:46', 2, ''),
(395, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:15:46', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(396, '', '', 'bestellung', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:15:47', 2, ''),
(397, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:15:47', 0, ''),
(398, '', '', 'bestellung', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:15:49', 2, ''),
(399, '', '', 'bestellung', 'edit', 'Administrator2', 'Run', '2015-10-26 17:15:49', 2, ''),
(400, '', '', 'bestellung', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:15:49', 2, ''),
(401, 'AUFTRAG BELEG ', '', 'bestellung', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:15:49', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(402, '', '', 'bestellung', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:15:54', 2, ''),
(403, '', '', 'bestellung', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:15:57', 1, ''),
(404, '', '', 'angebot', 'create', 'Administrator2', 'Run', '2015-10-26 17:16:05', 0, ''),
(405, '', '', 'angebot', 'create', 'Administrator2', 'Run', '2015-10-26 17:16:05', 0, ''),
(406, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:16:05', 1, ''),
(407, 'ANGEBOT BELEG ', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:16:05', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(408, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:16:06', 1, ''),
(409, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:16:06', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(410, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:16:08', 1, ''),
(411, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:16:09', 1, ''),
(412, 'ANGEBOT BELEG ', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:16:09', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(413, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:16:10', 1, ''),
(414, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:16:10', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(415, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:16:16', 700008, ''),
(416, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:16:16', 700008, ''),
(417, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:16:19', 0, ''),
(418, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:16:22', 1, ''),
(419, 'ANGEBOT BELEG ', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:16:22', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(420, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:16:23', 1, ''),
(421, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:16:23', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(422, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:16:28', 700012, ''),
(423, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:16:28', 700012, ''),
(424, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:16:35', 12, ''),
(425, '', '', 'welcome', 'unlock', 'Administrator2', 'Run', '2015-10-26 17:16:39', 12, ''),
(426, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:16:39', 12, ''),
(427, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:16:47', 12, ''),
(428, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:16:49', 12, ''),
(429, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:16:52', 12, ''),
(430, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:16:57', 12, ''),
(431, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:17:00', 12, ''),
(432, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:17:06', 12, ''),
(433, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:17:06', 12, ''),
(434, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:17:12', 700012, ''),
(435, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:17:12', 700012, ''),
(436, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:17:16', 700012, ''),
(437, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:17:16', 1, ''),
(438, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:16', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(439, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:16', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(440, '', '', 'angebot', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:17:17', 1, ''),
(441, 'ANGEBOT BELEG ', '', 'angebot', 'freigabe', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:17', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(442, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:17:17', 0, ''),
(443, '', '', 'angebot', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:17:19', 1, ''),
(444, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:17:19', 1, ''),
(445, 'ANGEBOT BELEG 100000', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:19', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(446, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:17:19', 1, ''),
(447, 'ANGEBOT BELEG 100000', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:19', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(448, '', '', 'angebot', 'abschicken', 'Administrator2', 'Run', '2015-10-26 17:17:23', 1, ''),
(449, 'ANGEBOT BELEG 100000', '', 'angebot', 'abschicken', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:23', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(450, '', '', 'angebot', 'abschicken', 'Administrator2', 'Run', '2015-10-26 17:17:26', 1, ''),
(451, 'ANGEBOT BELEG 100000', '', 'angebot', 'abschicken', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:26', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(452, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:17:27', 0, ''),
(453, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:17:27', 1, ''),
(454, 'ANGEBOT BELEG 100000', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:27', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(455, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:17:28', 1, ''),
(456, 'ANGEBOT BELEG 100000', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:28', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(457, '', '', 'kalender', 'eventdata', 'Administrator', 'Run', '2015-10-26 17:17:30', 4, ''),
(458, '', '', 'angebot', 'create', 'Administrator2', 'Run', '2015-10-26 17:17:32', 0, ''),
(459, '', '', 'angebot', 'create', 'Administrator2', 'Run', '2015-10-26 17:17:32', 0, ''),
(460, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:17:32', 2, ''),
(461, 'ANGEBOT BELEG ', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:32', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(462, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:17:33', 2, ''),
(463, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:33', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(464, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:17:35', 2, ''),
(465, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:17:36', 0, ''),
(466, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:17:36', 2, ''),
(467, 'ANGEBOT BELEG ', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:36', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(468, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:17:37', 2, ''),
(469, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:37', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(470, '', '', 'kalender', 'eventdata', 'Administrator', 'Run', '2015-10-26 17:17:39', 1, ''),
(471, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:17:41', 700012, ''),
(472, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:17:41', 700012, ''),
(473, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:17:42', 700012, ''),
(474, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:17:42', 2, ''),
(475, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:42', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(476, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:42', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(477, '', '', 'angebot', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:17:44', 2, ''),
(478, 'ANGEBOT BELEG ', '', 'angebot', 'freigabe', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:44', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(479, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:17:44', 0, ''),
(480, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:17:44', 0, ''),
(481, '', '', 'angebot', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:17:46', 2, ''),
(482, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:17:46', 2, ''),
(483, 'ANGEBOT BELEG 100001', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:46', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(484, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:17:46', 2, ''),
(485, 'ANGEBOT BELEG 100001', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:46', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(486, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:17:53', 2, ''),
(487, 'ANGEBOT BELEG 100001', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:53', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(488, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:17:54', 2, ''),
(489, 'ANGEBOT BELEG 100001', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:54', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(490, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:17:57', 2, ''),
(491, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:17:57', 2, ''),
(492, 'ANGEBOT BELEG 100001', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:57', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(493, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:17:58', 2, ''),
(494, 'ANGEBOT BELEG 100001', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:17:58', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(495, '', '', 'angebot', 'create', 'Administrator2', 'Run', '2015-10-26 17:18:01', 0, ''),
(496, '', '', 'angebot', 'create', 'Administrator2', 'Run', '2015-10-26 17:18:01', 0, ''),
(497, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:02', 3, ''),
(498, 'ANGEBOT BELEG ', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:02', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(499, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:02', 3, ''),
(500, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:02', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(501, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:06', 3, ''),
(502, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:07', 3, ''),
(503, 'ANGEBOT BELEG ', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:07', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(504, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:07', 3, ''),
(505, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:07', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK');
INSERT INTO `protokoll` (`id`, `meldung`, `dump`, `module`, `action`, `bearbeiter`, `funktionsname`, `datum`, `parameter`, `argumente`) VALUES
(506, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:18:11', 700012, ''),
(507, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:18:11', 700012, ''),
(508, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:18:13', 700012, ''),
(509, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:13', 3, ''),
(510, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:13', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(511, 'ANGEBOT BELEG ', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:14', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(512, '', '', 'angebot', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:18:15', 3, ''),
(513, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:18:15', 0, ''),
(514, 'ANGEBOT BELEG ', '', 'angebot', 'freigabe', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:15', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(515, '', '', 'angebot', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:18:16', 3, ''),
(516, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:17', 3, ''),
(517, 'ANGEBOT BELEG 100002', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:17', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(518, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:17', 3, ''),
(519, 'ANGEBOT BELEG 100002', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:17', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(520, '', '', 'angebot', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:18:21', 1, ''),
(521, 'ANGEBOT BELEG 100000', '', 'angebot', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:21', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(522, '', '', 'angebot', 'auftrag', 'Administrator2', 'Run', '2015-10-26 17:18:26', 1, ''),
(523, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:27', 1, ''),
(524, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:27', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(525, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:28', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(526, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:28', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(527, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:28', 1, ''),
(528, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:28', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(529, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:18:30', 1, ''),
(530, 'AUFTRAG BELEG ', '', 'auftrag', 'freigabe', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:30', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(531, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:18:32', 1, ''),
(532, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:32', 1, ''),
(533, 'AUFTRAG BELEG 200000', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:32', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(534, 'AUFTRAG BELEG 200000', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:32', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(535, 'AUFTRAG BELEG 200000', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:32', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(536, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:33', 1, ''),
(537, 'AUFTRAG BELEG 200000', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:33', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(538, '', '', 'auftrag', 'create', 'Administrator2', 'Run', '2015-10-26 17:18:36', 0, ''),
(539, '', '', 'auftrag', 'create', 'Administrator2', 'Run', '2015-10-26 17:18:36', 0, ''),
(540, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:36', 2, ''),
(541, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:36', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(542, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:36', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(543, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:36', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(544, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:37', 2, ''),
(545, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:37', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(546, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:40', 2, ''),
(547, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:40', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(548, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:40', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(549, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:41', 2, ''),
(550, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:41', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(551, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:41', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(552, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:41', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(553, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:41', 2, ''),
(554, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:41', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(555, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:45', 2, ''),
(556, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:45', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(557, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:45', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(558, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:45', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(559, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:46', 2, ''),
(560, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:46', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(561, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:49', 2, ''),
(562, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:49', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(563, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:49', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(564, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:18:50', 2, ''),
(565, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:50', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(566, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:50', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(567, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:50', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(568, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:51', 2, ''),
(569, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:51', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(570, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:18:56', 700012, ''),
(571, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:18:56', 700012, ''),
(572, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:18:57', 700012, ''),
(573, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:18:57', 2, ''),
(574, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:57', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(575, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:18:57', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(576, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:19:00', 0, ''),
(577, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:19:06', 2, ''),
(578, 'AUFTRAG BELEG ', '', 'auftrag', 'freigabe', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:06', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(579, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:19:06', 0, ''),
(580, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:19:08', 2, ''),
(581, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:19:08', 0, ''),
(582, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:19:08', 2, ''),
(583, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:08', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(584, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:08', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(585, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:08', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(586, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:19:09', 2, ''),
(587, 'AUFTRAG BELEG 200001', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:09', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(588, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:19:15', 2, ''),
(589, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:15', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(590, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:15', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(591, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:19:18', 2, ''),
(592, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:18', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(593, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:18', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(594, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:18', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(595, '', '', 'kalender', 'eventdata', 'Administrator', 'Run', '2015-10-26 17:19:19', 1, ''),
(596, '', '', 'auftrag', 'create', 'Administrator2', 'Run', '2015-10-26 17:19:23', 0, ''),
(597, '', '', 'auftrag', 'create', 'Administrator2', 'Run', '2015-10-26 17:19:23', 0, ''),
(598, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:19:24', 3, ''),
(599, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:24', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(600, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:24', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(601, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:24', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(602, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:19:25', 3, ''),
(603, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:25', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(604, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:19:31', 3, ''),
(605, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:31', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(606, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:31', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(607, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:19:32', 3, ''),
(608, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:32', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(609, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:32', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(610, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:32', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(611, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:19:32', 3, ''),
(612, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:32', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(613, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:19:35', 0, ''),
(614, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:19:41', 0, ''),
(615, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:19:42', 0, ''),
(616, '', '', 'welcome', 'addpinwand', 'Administrator', 'Run', '2015-10-26 17:19:44', 0, ''),
(617, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:19:45', 3, ''),
(618, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:45', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(619, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:45', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(620, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:45', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(621, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:19:46', 3, ''),
(622, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:46', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(623, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:19:50', 700012, ''),
(624, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:19:50', 700012, ''),
(625, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:19:53', 700012, ''),
(626, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:19:53', 3, ''),
(627, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:53', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(628, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:53', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(629, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:19:54', 3, ''),
(630, 'AUFTRAG BELEG ', '', 'auftrag', 'freigabe', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:54', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(631, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:19:54', 0, ''),
(632, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:19:56', 3, ''),
(633, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:19:56', 3, ''),
(634, 'AUFTRAG BELEG 200002', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:56', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(635, 'AUFTRAG BELEG 200002', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:56', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(636, 'AUFTRAG BELEG 200002', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:56', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(637, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:19:57', 3, ''),
(638, 'AUFTRAG BELEG 200002', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:19:57', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(639, '', '', 'auftrag', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:20:02', 3, ''),
(640, 'AUFTRAG BELEG 200002', '', 'auftrag', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:20:02', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(641, '', '', 'welcome', 'addpinwand', 'Administrator', 'Run', '2015-10-26 17:20:06', 0, ''),
(642, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:20:06', 0, ''),
(643, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:20:14', 12, ''),
(644, '', '', 'artikel', 'stueckliste', 'Administrator2', 'Run', '2015-10-26 17:20:17', 12, ''),
(645, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:20:20', 12, ''),
(646, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:20:21', 0, ''),
(647, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:20:31', 0, ''),
(648, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:20:38', 12, ''),
(649, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:20:41', 12, ''),
(650, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:20:47', 12, ''),
(651, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:20:50', 12, ''),
(652, '', '', 'angebot', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:21:15', 3, ''),
(653, 'ANGEBOT BELEG 100002', '', 'angebot', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:21:15', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(654, '', '', 'angebot', 'edit', 'Administrator2', 'Run', '2015-10-26 17:21:18', 3, ''),
(655, 'ANGEBOT BELEG 100002', '', 'angebot', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:21:18', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(656, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:21:18', 3, ''),
(657, 'ANGEBOT BELEG 100002', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:21:18', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(658, '', '', 'angebot', 'inlinepdf', 'Administrator2', 'Run', '2015-10-26 17:21:20', 3, ''),
(659, 'ANGEBOT BELEG 100002', '', 'angebot', 'inlinepdf', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:21:20', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(660, '', '', 'angebot', 'inlinepdf', 'Administrator2', 'Run', '2015-10-26 17:21:21', 3, ''),
(661, 'ANGEBOT BELEG 100002', '', 'angebot', 'inlinepdf', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:21:21', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(662, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:21:25', 700012, ''),
(663, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:21:25', 700012, ''),
(664, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:21:27', 700012, ''),
(665, '', '', 'angebot', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:21:27', 3, ''),
(666, 'ANGEBOT BELEG 100002', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:21:27', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(667, 'ANGEBOT BELEG 100002', '', 'angebot', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:21:28', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(668, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:21:30', 0, ''),
(669, '', '', 'angebot', 'delangebotposition', 'Administrator2', 'Run', '2015-10-26 17:21:30', 3, ''),
(670, 'ANGEBOT BELEG 100002', '', 'angebot', 'delangebotposition', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:21:31', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(671, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:21:32', 0, ''),
(672, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:21:39', 0, ''),
(673, '', '', 'welcome', 'addpinwand', 'Administrator', 'Run', '2015-10-26 17:22:10', 0, ''),
(674, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 17:22:48', 0, ''),
(675, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:22:48', 0, ''),
(676, '', '', 'projekt', 'edit', 'Administrator2', 'Run', '2015-10-26 17:22:51', 1, ''),
(677, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:22:57', 1, ''),
(678, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:23:02', 1, ''),
(679, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:23:06', 3, ''),
(680, 'AUFTRAG BELEG 200002', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:07', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(681, 'AUFTRAG BELEG 200002', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:07', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(682, 'AUFTRAG BELEG 200002', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:07', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(683, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:23:08', 3, ''),
(684, 'AUFTRAG BELEG 200002', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:08', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(685, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:23:12', 12, ''),
(686, '', '', 'welcome', 'unlock', 'Administrator2', 'Run', '2015-10-26 17:23:16', 12, ''),
(687, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:23:16', 12, ''),
(688, '', '', 'artikel', 'stueckliste', 'Administrator2', 'Run', '2015-10-26 17:23:22', 12, ''),
(689, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:23:29', 0, ''),
(690, '', '', 'auftrag', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:23:31', 3, ''),
(691, 'AUFTRAG BELEG 200002', '', 'auftrag', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:31', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(692, '', '', 'auftrag', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:23:33', 2, ''),
(693, 'AUFTRAG BELEG 200001', '', 'auftrag', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:33', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(694, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:23:35', 2, ''),
(695, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:35', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(696, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:35', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(697, 'AUFTRAG BELEG 200001', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:35', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(698, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:23:36', 2, ''),
(699, 'AUFTRAG BELEG 200001', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:36', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(700, '', '', '', '', 'Administrator', 'Run', '2015-10-26 17:23:39', 0, ''),
(701, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 17:23:39', 0, ''),
(702, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:23:39', 0, ''),
(703, '', '', 'auftrag', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:23:41', 1, ''),
(704, 'AUFTRAG BELEG 200000', '', 'auftrag', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:41', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(705, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:23:43', 1, ''),
(706, 'AUFTRAG BELEG 200000', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:43', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(707, 'AUFTRAG BELEG 200000', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:43', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(708, 'AUFTRAG BELEG 200000', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:43', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(709, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:23:44', 1, ''),
(710, 'AUFTRAG BELEG 200000', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:44', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(711, '', '', 'auftrag', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:23:46', 1, ''),
(712, 'AUFTRAG BELEG 200000', '', 'auftrag', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:23:46', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(713, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 17:23:52', 0, ''),
(714, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:23:53', 0, ''),
(715, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:23:58', 0, ''),
(716, '', '', 'welcome', 'addnote', 'Administrator', 'Run', '2015-10-26 17:24:01', 0, ''),
(717, '', '', 'auftrag', 'create', 'Administrator2', 'Run', '2015-10-26 17:24:02', 0, ''),
(718, '', '', 'auftrag', 'create', 'Administrator2', 'Run', '2015-10-26 17:24:02', 0, ''),
(719, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:03', 4, ''),
(720, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:03', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(721, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:03', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(722, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:03', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(723, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:24:04', 4, ''),
(724, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:04', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(725, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:07', 4, ''),
(726, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:07', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(727, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:07', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(728, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:08', 4, ''),
(729, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:08', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(730, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:08', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(731, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:08', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(732, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:24:09', 4, ''),
(733, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:24:09', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(734, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:24:13', 700001, ''),
(735, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:24:13', 700001, ''),
(736, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:24', 1, ''),
(737, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:29', 2, ''),
(738, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:32', 3, ''),
(739, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:35', 4, ''),
(740, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:39', 5, ''),
(741, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:42', 6, ''),
(742, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:46', 7, ''),
(743, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:49', 7, ''),
(744, '', '', 'welcome', 'addnote', 'Administrator', 'Run', '2015-10-26 17:24:52', 0, ''),
(745, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:53', 7, ''),
(746, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:24:53', 0, ''),
(747, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:24:57', 8, ''),
(748, '', '', 'welcome', 'addnote', 'Administrator', 'Run', '2015-10-26 17:24:58', 0, ''),
(749, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:25:00', 9, ''),
(750, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:25:02', 10, ''),
(751, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:25:04', 11, ''),
(752, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:25:07', 13, ''),
(753, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:09', 1, ''),
(754, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:20', 1, ''),
(755, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:20', 1, ''),
(756, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:26', 2, ''),
(757, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:35', 2, ''),
(758, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:35', 2, ''),
(759, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:41', 3, ''),
(760, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:48', 3, ''),
(761, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:48', 3, ''),
(762, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:25:52', 4, ''),
(763, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:02', 4, ''),
(764, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:02', 4, ''),
(765, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:05', 5, ''),
(766, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:12', 5, ''),
(767, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:12', 5, ''),
(768, '', '', 'welcome', 'addnote', 'Administrator', 'Run', '2015-10-26 17:26:15', 0, ''),
(769, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:26:15', 0, ''),
(770, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:16', 6, ''),
(771, '', '', 'welcome', 'movenote', 'Administrator', 'Run', '2015-10-26 17:26:20', 2, ''),
(772, '', '', 'welcome', 'movenote', 'Administrator', 'Run', '2015-10-26 17:26:22', 1, ''),
(773, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:26', 6, ''),
(774, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:26', 6, ''),
(775, '', '', 'welcome', 'addnote', 'Administrator', 'Run', '2015-10-26 17:26:27', 0, ''),
(776, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:30', 7, ''),
(777, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:36', 7, ''),
(778, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:36', 7, ''),
(779, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:40', 7, ''),
(780, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:47', 7, ''),
(781, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:47', 7, ''),
(782, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:54', 7, ''),
(783, '', '', 'artikel', 'verkaufdelete', 'Administrator2', 'Run', '2015-10-26 17:26:58', 9, ''),
(784, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:26:59', 7, ''),
(785, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:27:03', 8, ''),
(786, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:27:09', 8, ''),
(787, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:27:10', 8, ''),
(788, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:27:16', 9, ''),
(789, '', '', 'welcome', 'addnote', 'Administrator', 'Run', '2015-10-26 17:27:17', 0, ''),
(790, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:27:17', 0, ''),
(791, '', '', 'welcome', 'movenote', 'Administrator', 'Run', '2015-10-26 17:27:22', 3, ''),
(792, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:27:23', 9, ''),
(793, '', '', 'welcome', 'movenote', 'Administrator', 'Run', '2015-10-26 17:27:25', 2, ''),
(794, '', '', 'aufgaben', 'edit', 'Administrator', 'Run', '2015-10-26 17:27:36', 2, ''),
(795, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:27:37', 9, ''),
(796, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:27:37', 9, ''),
(797, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:27:39', 9, ''),
(798, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:27:45', 9, ''),
(799, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:27:46', 9, ''),
(800, '', '', 'aufgaben', 'edit', 'Administrator', 'Run', '2015-10-26 17:27:52', 2, ''),
(801, '', '', 'welcome', 'oknote', 'Administrator', 'Run', '2015-10-26 17:28:09', 2, ''),
(802, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:28:09', 0, ''),
(803, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:28:25', 10, ''),
(804, '', '', 'welcome', 'movenote', 'Administrator', 'Run', '2015-10-26 17:28:27', 3, ''),
(805, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:28:27', 10, ''),
(806, '', '', 'welcome', 'addnote', 'Administrator', 'Run', '2015-10-26 17:28:29', 0, ''),
(807, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:28:33', 10, ''),
(808, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:28:33', 10, ''),
(809, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:28:36', 11, ''),
(810, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:28:38', 11, ''),
(811, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:28:42', 11, ''),
(812, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:28:43', 11, ''),
(813, '', '', 'welcome', 'addnote', 'Administrator', 'Run', '2015-10-26 17:28:44', 0, ''),
(814, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:28:45', 0, ''),
(815, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:28:45', 13, ''),
(816, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:28:49', 13, ''),
(817, '', '', 'welcome', 'movenote', 'Administrator', 'Run', '2015-10-26 17:28:49', 4, ''),
(818, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:28:53', 0, ''),
(819, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:29:05', 13, ''),
(820, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:29:13', 13, ''),
(821, '', '', 'artikel', 'einkauf', 'Administrator2', 'Run', '2015-10-26 17:29:13', 13, ''),
(822, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:29:14', 0, ''),
(823, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:29:15', 13, ''),
(824, '', '', 'welcome', 'movenote', 'Administrator', 'Run', '2015-10-26 17:29:18', 4, ''),
(825, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:29:20', 0, ''),
(826, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:29:21', 13, ''),
(827, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:29:21', 13, ''),
(828, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:29:22', 0, ''),
(829, '', '', 'zeiterfassung', 'listuser', 'Administrator', 'Run', '2015-10-26 17:29:25', 0, ''),
(830, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:29:26', 0, ''),
(831, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:29:30', 700001, ''),
(832, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:29:30', 700001, ''),
(833, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:29:33', 700001, ''),
(834, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:29:33', 4, ''),
(835, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:29:33', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(836, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:29:33', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(837, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:29:35', 4, ''),
(838, 'AUFTRAG BELEG ', '', 'auftrag', 'freigabe', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:29:35', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(839, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:29:35', 0, ''),
(840, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:29:36', 4, ''),
(841, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:29:36', 4, ''),
(842, 'AUFTRAG BELEG 200003', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:29:36', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(843, 'AUFTRAG BELEG 200003', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:29:36', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(844, 'AUFTRAG BELEG 200003', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:29:37', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(845, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:29:37', 4, ''),
(846, 'AUFTRAG BELEG 200003', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:29:37', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(847, '', '', 'artikel', 'create', 'Administrator2', 'Run', '2015-10-26 17:29:41', 0, ''),
(848, '', '', 'artikel', 'create', 'Administrator2', 'Run', '2015-10-26 17:29:47', 0, ''),
(849, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:29:47', 14, ''),
(850, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:29:52', 14, ''),
(851, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:29:56', 14, ''),
(852, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:29:59', 14, ''),
(853, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:30:04', 14, ''),
(854, '', '', 'artikel', 'verkauf', 'Administrator2', 'Run', '2015-10-26 17:30:05', 14, ''),
(855, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:30:13', 4, ''),
(856, 'AUFTRAG BELEG 200003', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:30:13', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(857, 'AUFTRAG BELEG 200003', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:30:13', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(858, 'AUFTRAG BELEG 200003', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:30:13', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(859, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:30:13', 4, ''),
(860, 'AUFTRAG BELEG 200003', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:30:13', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(861, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:30:18', 100001, ''),
(862, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:30:18', 100001, ''),
(863, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:30:19', 100001, ''),
(864, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:30:19', 4, ''),
(865, 'AUFTRAG BELEG 200003', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:30:19', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(866, 'AUFTRAG BELEG 200003', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:30:19', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(867, '', '', 'artikel', 'ajaxwerte', 'Administrator2', 'Run', '2015-10-26 17:30:21', 0, ''),
(868, '', '', 'auftrag', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:30:25', 4, ''),
(869, 'AUFTRAG BELEG 200003', '', 'auftrag', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:30:25', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(870, '', '', 'projekt', 'edit', 'Administrator2', 'Run', '2015-10-26 17:30:34', 1, ''),
(871, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:30:40', 1, ''),
(872, '', '', 'projekt', 'edit', 'Administrator2', 'Run', '2015-10-26 17:30:42', 1, ''),
(873, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:30:45', 1, ''),
(874, '', '', 'projekt', 'edit', 'Administrator2', 'Run', '2015-10-26 17:30:47', 1, ''),
(875, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:30:53', 1, ''),
(876, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:30:55', 0, ''),
(877, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:30:55', 0, ''),
(878, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:30:58', 1, ''),
(879, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:03', 1, ''),
(880, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:08', 1, ''),
(881, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:13', 1, ''),
(882, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:18', 1, ''),
(883, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:23', 1, ''),
(884, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:28', 1, ''),
(885, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:33', 1, ''),
(886, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:38', 1, ''),
(887, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:43', 1, ''),
(888, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:48', 1, ''),
(889, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:53', 1, ''),
(890, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:31:58', 1, ''),
(891, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:03', 1, ''),
(892, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:08', 1, ''),
(893, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:13', 1, ''),
(894, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:18', 1, ''),
(895, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:23', 1, ''),
(896, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:32:28', 0, ''),
(897, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:32:28', 0, ''),
(898, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:28', 1, ''),
(899, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:33', 1, ''),
(900, '', '', 'zeiterfassung', 'listuser', 'Administrator', 'Run', '2015-10-26 17:32:35', 0, ''),
(901, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:38', 1, ''),
(902, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:32:39', 1, ''),
(903, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:43', 1, ''),
(904, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:32:46', 1, ''),
(905, '', '', 'zeiterfassung', 'listuser', 'Administrator', 'Run', '2015-10-26 17:32:46', 0, ''),
(906, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:48', 1, ''),
(907, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:53', 1, ''),
(908, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:32:53', 0, ''),
(909, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:32:58', 1, ''),
(910, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:03', 1, ''),
(911, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:08', 1, ''),
(912, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:13', 1, ''),
(913, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:18', 1, ''),
(914, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:23', 1, ''),
(915, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:33:27', 0, ''),
(916, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:33:28', 0, ''),
(917, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:28', 1, ''),
(918, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:33', 1, ''),
(919, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:38', 1, ''),
(920, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:43', 1, ''),
(921, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:48', 1, ''),
(922, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:33:51', 0, ''),
(923, '', '', 'zeiterfassung', 'create', 'Administrator', 'Run', '2015-10-26 17:33:52', 0, ''),
(924, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:53', 1, ''),
(925, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:33:58', 1, ''),
(926, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:03', 1, ''),
(927, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:08', 1, ''),
(928, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:13', 1, ''),
(929, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:18', 1, ''),
(930, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:23', 1, ''),
(931, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:28', 1, ''),
(932, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:33', 1, ''),
(933, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:38', 1, '');
INSERT INTO `protokoll` (`id`, `meldung`, `dump`, `module`, `action`, `bearbeiter`, `funktionsname`, `datum`, `parameter`, `argumente`) VALUES
(934, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:43', 1, ''),
(935, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:48', 1, ''),
(936, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:53', 1, ''),
(937, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:34:58', 1, ''),
(938, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 17:35:00', 0, ''),
(939, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:35:00', 0, ''),
(940, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:03', 1, ''),
(941, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:08', 1, ''),
(942, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:35:12', 0, ''),
(943, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:13', 1, ''),
(944, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 17:35:13', 0, ''),
(945, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:35:14', 0, ''),
(946, '', '', 'kalender', 'eventdata', 'Administrator', 'Run', '2015-10-26 17:35:15', 1, ''),
(947, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:18', 1, ''),
(948, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 17:35:22', 0, ''),
(949, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:35:23', 0, ''),
(950, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:23', 1, ''),
(951, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:28', 1, ''),
(952, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:33', 1, ''),
(953, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:38', 1, ''),
(954, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:43', 1, ''),
(955, '', '', 'projekt', 'getnextnumber', 'Administrator2', 'Run', '2015-10-26 17:35:48', 1, ''),
(956, '', '', 'auftrag', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:35:54', 4, ''),
(957, 'AUFTRAG BELEG 200003', '', 'auftrag', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:35:54', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(958, '', '', 'auftrag', 'copy', 'Administrator2', 'Run', '2015-10-26 17:35:59', 4, ''),
(959, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:36:02', 5, ''),
(960, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:02', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(961, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:02', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(962, 'AUFTRAG BELEG ', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:02', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(963, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:36:03', 5, ''),
(964, 'AUFTRAG BELEG ', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:03', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(965, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:36:05', 5, ''),
(966, 'AUFTRAG BELEG ', '', 'auftrag', 'freigabe', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:05', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(967, '', '', 'auftrag', 'freigabe', 'Administrator2', 'Run', '2015-10-26 17:36:07', 5, ''),
(968, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:36:07', 5, ''),
(969, 'AUFTRAG BELEG 200004', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:07', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(970, 'AUFTRAG BELEG 200004', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:07', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(971, 'AUFTRAG BELEG 200004', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:07', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(972, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:36:08', 5, ''),
(973, 'AUFTRAG BELEG 200004', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:08', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(974, '', '', 'auftrag', 'versand', 'Administrator2', 'Run', '2015-10-26 17:36:17', 5, ''),
(975, 'MESSAGE VOR LOCK', '', 'auftrag', 'versand', 'Administrator2', 'AuftragVersand', '2015-10-26 17:36:17', 5, 'QXJyYXkKKAopCg=='),
(976, 'MESSAGE NACH LOCK', '', 'auftrag', 'versand', 'Administrator2', 'AuftragVersand', '2015-10-26 17:36:17', 5, 'QXJyYXkKKAopCg=='),
(977, 'MESSAGE START', '', 'auftrag', 'versand', 'Administrator2', 'AuftragVersand', '2015-10-26 17:36:17', 5, 'QXJyYXkKKAopCg=='),
(978, 'WeiterfuehrenAuftrag AB 200004 Art: ', '', 'auftrag', 'versand', 'Administrator2', 'AuftragVersand', '2015-10-26 17:36:18', 5, 'QXJyYXkKKAopCg=='),
(979, 'WeiterfuehrenAuftragZuLieferschein AB 200004', '', 'auftrag', 'versand', 'Administrator2', 'AuftragVersand', '2015-10-26 17:36:20', 5, 'QXJyYXkKKAopCg=='),
(980, 'WeiterfuehrenAuftragZuRechnung AB 200004 Preis 8.55', '', 'auftrag', 'versand', 'Administrator2', 'AuftragVersand', '2015-10-26 17:36:20', 5, 'QXJyYXkKKAopCg=='),
(981, 'RECHNUNG BELEG ', '', 'auftrag', 'versand', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:23', 5, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiByZWNobnVuZwopCg=='),
(982, 'WeiterfuehrenAuftragZuRechnung AB 200004 (id 5) RE 400000 (id 1)', '', 'auftrag', 'versand', 'Administrator2', 'AuftragVersand', '2015-10-26 17:36:23', 5, 'QXJyYXkKKAopCg=='),
(983, 'WeiterfuehrenAuftragZuRechnung AB 200004 Kommissionierverfahren: lieferschein Projekt 1', '', 'auftrag', 'versand', 'Administrator2', 'AuftragVersand', '2015-10-26 17:36:23', 5, 'QXJyYXkKKAopCg=='),
(984, 'MESSAGE BEENDET UNLOCK', '', 'auftrag', 'versand', 'Administrator2', 'AuftragVersand', '2015-10-26 17:36:24', 5, 'QXJyYXkKKAopCg=='),
(985, '', '', 'auftrag', 'edit', 'Administrator2', 'Run', '2015-10-26 17:36:24', 5, ''),
(986, 'AUFTRAG BELEG 200004', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:24', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(987, 'AUFTRAG BELEG 200004', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:24', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(988, 'AUFTRAG BELEG 200004', '', 'auftrag', 'edit', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:24', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(989, '', '', 'auftrag', 'positionen', 'Administrator2', 'Run', '2015-10-26 17:36:24', 5, ''),
(990, 'AUFTRAG BELEG 200004', '', 'auftrag', 'positionen', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:24', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(991, '', '', 'rechnung', 'minidetail', 'Administrator2', 'Run', '2015-10-26 17:36:31', 1, ''),
(992, 'RECHNUNG BELEG 400000', '', 'rechnung', 'minidetail', 'Administrator2', 'BerechneDeckungsbeitrag', '2015-10-26 17:36:31', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiByZWNobnVuZwopCg=='),
(993, '', '', 'artikel', 'edit', 'Administrator2', 'Run', '2015-10-26 17:36:40', 1, ''),
(994, '', '', 'artikel', 'lager', 'Administrator2', 'Run', '2015-10-26 17:36:43', 1, ''),
(995, '', '', 'wareneingang', 'paketannahme', 'Administrator', 'Run', '2015-10-26 17:37:38', 0, ''),
(996, '', '', 'wareneingang', 'paketannahme', 'Administrator', 'Run', '2015-10-26 17:37:51', 8, ''),
(997, '', '', 'wareneingang', 'distriinhalt', 'Administrator', 'Run', '2015-10-26 17:37:51', 1, ''),
(998, '', '', 'wareneingang', 'paketannahme', 'Administrator', 'Run', '2015-10-26 17:38:01', 0, ''),
(999, '', '', '', '', 'Administrator', 'Run', '2015-10-26 17:38:10', 0, ''),
(1000, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 17:38:10', 0, ''),
(1001, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:38:10', 0, ''),
(1002, '', '', 'rechnung', 'edit', 'Administrator', 'Run', '2015-10-26 17:38:28', 1, ''),
(1003, '', '', 'rechnung', 'pdf', 'Administrator', 'Run', '2015-10-26 17:38:47', 1, ''),
(1004, '', '', 'rechnung', 'copy', 'Administrator', 'Run', '2015-10-26 17:38:59', 1, ''),
(1005, '', '', 'rechnung', 'edit', 'Administrator', 'Run', '2015-10-26 17:39:02', 2, ''),
(1006, 'RECHNUNG BELEG ', '', 'rechnung', 'edit', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:39:02', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiByZWNobnVuZwopCg=='),
(1007, 'RECHNUNG BELEG ', '', 'rechnung', 'edit', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:39:02', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiByZWNobnVuZwopCg=='),
(1008, 'RECHNUNG BELEG ', '', 'rechnung', 'edit', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:39:02', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiByZWNobnVuZwopCg=='),
(1009, '', '', 'rechnung', 'positionen', 'Administrator', 'Run', '2015-10-26 17:39:02', 2, ''),
(1010, 'RECHNUNG BELEG ', '', 'rechnung', 'positionen', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:39:02', 2, 'QXJyYXkKKAogICAgWzBdID0+IDIKICAgIFsxXSA9PiByZWNobnVuZwopCg=='),
(1011, '', '', 'rechnung', 'minidetail', 'Administrator', 'Run', '2015-10-26 17:39:18', 1, ''),
(1012, 'RECHNUNG BELEG 400000', '', 'rechnung', 'minidetail', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:39:18', 1, 'QXJyYXkKKAogICAgWzBdID0+IDEKICAgIFsxXSA9PiByZWNobnVuZwopCg=='),
(1013, '', '', 'lieferschein', 'edit', 'Administrator', 'Run', '2015-10-26 17:39:30', 1, ''),
(1014, '', '', 'lieferschein', 'positionen', 'Administrator', 'Run', '2015-10-26 17:39:30', 1, ''),
(1015, '', '', 'lieferschein', 'pdf', 'Administrator', 'Run', '2015-10-26 17:39:36', 1, ''),
(1016, '', '', 'angebot', 'edit', 'Administrator', 'Run', '2015-10-26 17:39:51', 3, ''),
(1017, 'ANGEBOT BELEG 100002', '', 'angebot', 'edit', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:39:51', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(1018, '', '', 'angebot', 'positionen', 'Administrator', 'Run', '2015-10-26 17:39:52', 3, ''),
(1019, 'ANGEBOT BELEG 100002', '', 'angebot', 'positionen', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:39:52', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(1020, '', '', 'angebot', 'pdf', 'Administrator', 'Run', '2015-10-26 17:39:58', 3, ''),
(1021, 'ANGEBOT BELEG 100002', '', 'angebot', 'pdf', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:39:58', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhbmdlYm90CikK'),
(1022, '', '', 'auftrag', 'edit', 'Administrator', 'Run', '2015-10-26 17:40:08', 5, ''),
(1023, 'AUFTRAG BELEG 200004', '', 'auftrag', 'edit', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:40:08', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(1024, 'AUFTRAG BELEG 200004', '', 'auftrag', 'edit', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:40:08', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(1025, 'AUFTRAG BELEG 200004', '', 'auftrag', 'edit', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:40:08', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(1026, '', '', 'auftrag', 'positionen', 'Administrator', 'Run', '2015-10-26 17:40:09', 5, ''),
(1027, 'AUFTRAG BELEG 200004', '', 'auftrag', 'positionen', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:40:09', 5, 'QXJyYXkKKAogICAgWzBdID0+IDUKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(1028, '', '', 'auftrag', 'pdf', 'Administrator', 'Run', '2015-10-26 17:40:12', 3, ''),
(1029, 'AUFTRAG BELEG 200002', '', 'auftrag', 'pdf', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:40:12', 3, 'QXJyYXkKKAogICAgWzBdID0+IDMKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(1030, '', '', 'auftrag', 'minidetail', 'Administrator', 'Run', '2015-10-26 17:40:18', 4, ''),
(1031, 'AUFTRAG BELEG 200003', '', 'auftrag', 'minidetail', 'Administrator', 'BerechneDeckungsbeitrag', '2015-10-26 17:40:18', 4, 'QXJyYXkKKAogICAgWzBdID0+IDQKICAgIFsxXSA9PiBhdWZ0cmFnCikK'),
(1032, '', '', 'auftrag', 'berechnen', 'Administrator', 'Run', '2015-10-26 17:40:26', 0, ''),
(1033, '', '', 'auftrag', 'berechnen', 'Administrator', 'Run', '2015-10-26 17:40:29', 0, ''),
(1034, '', '', 'lager', 'buchenzwischenlager', 'Administrator2', 'Run', '2015-10-26 17:40:43', 0, ''),
(1035, '', '', 'welcome', 'start', 'Administrator2', 'Run', '2015-10-26 17:40:48', 0, ''),
(1036, '', '', 'kalender', 'data', 'Administrator2', 'Run', '2015-10-26 17:40:48', 0, ''),
(1037, '', '', 'importvorlage', 'uebersicht', 'Administrator2', 'Run', '2015-10-26 17:40:50', 0, ''),
(1038, '', '', 'lager', 'edit', 'Administrator2', 'Run', '2015-10-26 17:40:56', 1, ''),
(1039, '', '', 'lager', 'platz', 'Administrator2', 'Run', '2015-10-26 17:40:59', 1, ''),
(1040, '', '', 'lager', 'platzeditpopup', 'Administrator2', 'Run', '2015-10-26 17:41:02', 1, ''),
(1041, '', '', 'lager', 'platz', 'Administrator2', 'Run', '2015-10-26 17:41:06', 1, ''),
(1042, '', '', 'welcome', 'logout', 'Administrator', 'Run', '2015-10-26 17:41:30', 0, ''),
(1043, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 17:41:30', 0, ''),
(1044, '', '', 'welcome', 'logout', '', 'Run', '2015-10-26 17:41:59', 0, ''),
(1045, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 17:42:00', 0, ''),
(1046, '', '', 'welcome', 'login', '', 'Run', '2015-10-26 17:42:04', 0, ''),
(1047, '', '', 'welcome', 'start', 'Administrator', 'Run', '2015-10-26 17:42:04', 0, ''),
(1048, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:42:06', 0, ''),
(1049, '', '', 'welcome', 'pinwand', 'Administrator', 'Run', '2015-10-26 17:42:10', 0, ''),
(1050, '', '', 'aufgaben', 'edit', 'Administrator', 'Run', '2015-10-26 17:42:17', 1, ''),
(1051, '', '', 'rechnung', 'edit', 'Administrator', 'Run', '2015-10-26 17:43:18', 1, ''),
(1052, '', '', 'kalender', 'data', 'Administrator', 'Run', '2015-10-26 17:44:14', 0, '');



--
-- Daten für Tabelle `rechnung`
--

INSERT INTO `rechnung` (`id`, `datum`, `aborechnung`, `projekt`, `anlegeart`, `belegnr`, `auftrag`, `auftragid`, `bearbeiter`, `freitext`, `internebemerkung`, `status`, `adresse`, `name`, `abteilung`, `unterabteilung`, `strasse`, `adresszusatz`, `ansprechpartner`, `plz`, `ort`, `land`, `ustid`, `ust_befreit`, `ustbrief`, `ustbrief_eingang`, `ustbrief_eingang_am`, `email`, `telefon`, `telefax`, `betreff`, `kundennummer`, `lieferschein`, `versandart`, `lieferdatum`, `buchhaltung`, `zahlungsweise`, `zahlungsstatus`, `ist`, `soll`, `skonto_gegeben`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `firma`, `versendet`, `versendet_am`, `versendet_per`, `versendet_durch`, `versendet_mahnwesen`, `mahnwesen`, `mahnwesen_datum`, `mahnwesen_gesperrt`, `mahnwesen_internebemerkung`, `inbearbeitung`, `datev_abgeschlossen`, `logdatei`, `doppel`, `autodruck_rz`, `autodruck_periode`, `autodruck_done`, `autodruck_anzahlverband`, `autodruck_anzahlkunde`, `autodruck_mailverband`, `autodruck_mailkunde`, `dta_datei_verband`, `dta_datei`, `deckungsbeitragcalc`, `deckungsbeitrag`, `umsatz_netto`, `erloes_netto`, `mahnwesenfestsetzen`, `vertriebid`, `aktion`, `vertrieb`, `provision`, `provision_summe`, `gruppe`, `punkte`, `bonuspunkte`, `provdatum`, `ihrebestellnummer`, `anschreiben`, `usereditid`, `useredittimestamp`, `realrabatt`, `rabatt`, `einzugsdatum`, `rabatt1`, `rabatt2`, `rabatt3`, `rabatt4`, `rabatt5`, `forderungsverlust_datum`, `forderungsverlust_betrag`, `steuersatz_normal`, `steuersatz_zwischen`, `steuersatz_ermaessigt`, `steuersatz_starkermaessigt`, `steuersatz_dienstleistung`, `waehrung`, `keinsteuersatz`, `schreibschutz`, `pdfarchiviert`, `pdfarchiviertversion`, `typ`, `ohne_briefpapier`, `lieferid`, `ansprechpartnerid`, `systemfreitext`, `projektfiliale`) VALUES
(1, '2015-10-26', 0, '1', '', '400000', '200004', 5, 'Administrator2', '', '', 'freigegeben', 5, 'Hans Huber', '', '', 'Musterstrasse 6', '', '', '12345', 'Musterstadt', 'DE', '', 0, 0, 0, '0000-00-00', 'hans@huberhausen.de', '017123456745', '', '', '10002', 1, 'versandunternehmen', '0000-00-00', 'Administrator2', 'rechnung', 'offen', 0.00, 10.17, 0.00, 14, 10, 2.00, 1, 0, '0000-00-00 00:00:00', '', '', 0, '', '0000-00-00', 0, '', 0, 0, '2015-10-26 16:43:18', NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 85.96, 8.55, 7.35, 0, 0, '', 'Administrator2', 0.00, 0.00, 0, NULL, NULL, NULL, '', '', 1, '2015-10-26 16:43:18', NULL, 0.00, '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 0, 0, 0, 0, 'firma', NULL, 0, 0, '', 0),
(2, '2015-10-26', 0, '1', '', '', '200004', 5, 'Administrator2', '', '', 'angelegt', 5, 'Hans Huber', '', '', 'Musterstrasse 6', '', '', '12345', 'Musterstadt', 'DE', '', 0, 0, 0, '0000-00-00', 'hans@huberhausen.de', '017123456745', '', '', '10002', 0, 'versandunternehmen', '0000-00-00', 'Administrator', 'rechnung', 'offen', 0.00, 10.17, 0.00, 14, 10, 2.00, 1, 0, '0000-00-00 00:00:00', '', '', 0, '', '0000-00-00', 0, '', 0, 0, '2015-10-26 16:39:06', NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 85.96, 8.55, 7.35, 0, 0, '', '', 0.00, 0.00, 0, NULL, NULL, NULL, NULL, NULL, 1, '2015-10-26 16:39:03', NULL, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', NULL, 0, 0, 0, 'firma', 0, 0, 0, '', 0);

--
-- Daten für Tabelle `rechnung_position`
--

INSERT INTO `rechnung_position` (`id`, `rechnung`, `artikel`, `projekt`, `bezeichnung`, `beschreibung`, `internerkommentar`, `nummer`, `menge`, `preis`, `waehrung`, `lieferdatum`, `vpe`, `sort`, `status`, `umsatzsteuer`, `bemerkung`, `logdatei`, `explodiert_parent_artikel`, `punkte`, `bonuspunkte`, `mlmdirektpraemie`, `mlm_abgerechnet`, `keinrabatterlaubt`, `grundrabatt`, `rabattsync`, `rabatt1`, `rabatt2`, `rabatt3`, `rabatt4`, `rabatt5`, `einheit`, `rabatt`, `zolltarifnummer`, `herkunftsland`) VALUES
(1, 1, 1, 1, 'Schraube M10x20', '', '', '700001', 10, 0.1600, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', '2015-10-26 16:36:22', 0, 0.00, 0.00, 0.00, NULL, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, '0', '0'),
(2, 1, 14, 1, 'Versandkosten', '', '', '100001', 1, 6.9500, 'EUR', '0000-00-00', '1', 2, 'angelegt', '', '', '2015-10-26 16:36:23', 0, 0.00, 0.00, 0.00, NULL, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, '0', '0'),
(3, 2, 1, 1, 'Schraube M10x20', '', '', '700001', 10, 0.1600, 'EUR', '0000-00-00', '1', 1, 'angelegt', '', '', '2015-10-26 16:39:01', 0, 0.00, 0.00, 0.00, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, '0', '0'),
(4, 2, 14, 1, 'Versandkosten', '', '', '100001', 1, 6.9500, 'EUR', '0000-00-00', '1', 2, 'angelegt', '', '', '2015-10-26 16:39:02', 0, 0.00, 0.00, 0.00, 0, 0, 0.00, 0, 0.00, 0.00, 0.00, 0.00, 0.00, '', 0.00, '0', '0');

--
-- Daten für Tabelle `stueckliste`
--

INSERT INTO `stueckliste` (`id`, `sort`, `artikel`, `referenz`, `place`, `layer`, `stuecklistevonartikel`, `menge`, `firma`, `wert`, `bauform`) VALUES
(1, 1, 1, '', 'DP', 'Top', 12, 4, 1, '', ''),
(2, 2, 8, '', 'DP', 'Top', 12, 1, 1, '', ''),
(3, 3, 9, '', 'DP', 'Top', 12, 1, 1, '', ''),
(4, 4, 13, '', 'DP', 'Top', 12, 1, 1, '', ''),
(6, 5, 10, '', 'DP', 'Top', 12, 2, 1, '', ''),
(7, 6, 11, '', 'DP', 'Top', 12, 2, 1, '', '');

--
-- Daten für Tabelle `systemlog`
--

INSERT INTO `systemlog` (`id`, `meldung`, `dump`, `module`, `action`, `bearbeiter`, `funktionsname`, `datum`, `parameter`, `argumente`, `level`) VALUES
(1, 'Fehlendes Recht', '', 'kalender', 'data', 'Anton Lechner', 'Check', '2015-10-26 17:01:24', 0, 'QXJyYXkKKAogICAgWzBdID0+IHN0YW5kYXJkCiAgICBbMV0gPT4ga2FsZW5kZXIKICAgIFsyXSA9PiBkYXRhCiAgICBbM10gPT4gMwopCg==', 1),
(2, 'Keine gueltige Benutzer ID erhalten', '', 'welcome', 'start', '', 'Check', '2015-10-26 17:41:57', 0, 'QXJyYXkKKAogICAgWzBdID0+IHdlYgogICAgWzFdID0+IHdlbGNvbWUKICAgIFsyXSA9PiBzdGFydAogICAgWzNdID0+IAopCg==', 1);

--
-- Daten für Tabelle `user`
--


--
-- Daten für Tabelle `userrights`
--

INSERT INTO `userrights` (`id`, `user`, `module`, `action`, `permission`) VALUES
(1, 3, 'welcome', 'login', 1),
(2, 3, 'welcome', 'logout', 1),
(3, 3, 'welcome', 'start', 1),
(4, 3, 'welcome', 'startseite', 1),
(5, 3, 'welcome', 'settings', 1),
(6, 3, 'zeiterfassung', 'abrechnenpdf', 1),
(7, 3, 'zeiterfassung', 'details', 1),
(8, 3, 'zeiterfassung', 'delete', 1),
(9, 3, 'zeiterfassung', 'create', 1),
(10, 3, 'zeiterfassung', 'arbeitspaket', 1),
(11, 3, 'zeiterfassung', 'dokuarbeitszeitpdf', 1),
(12, 3, 'zeiterfassung', 'edit', 1),
(13, 3, 'zeiterfassung', 'list', 1),
(14, 3, 'zeiterfassung', 'listuser', 1),
(15, 3, 'zeiterfassung', 'minidetail', 1);

--
-- Daten für Tabelle `verkaufspreise`
--

INSERT INTO `verkaufspreise` (`id`, `artikel`, `objekt`, `projekt`, `adresse`, `preis`, `waehrung`, `ab_menge`, `vpe`, `vpe_menge`, `angelegt_am`, `gueltig_bis`, `bemerkung`, `bearbeiter`, `logdatei`, `firma`, `geloescht`, `kundenartikelnummer`, `art`, `gruppe`, `apichange`) VALUES
(1, 12, '', '', '0', 62.0000, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(2, 1, '', '', '0', 0.1600, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(3, 2, '', '', '0', 0.1700, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(4, 3, '', '', '0', 3.1100, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(5, 4, '', '', '0', 61.3600, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(6, 5, '', '', '0', 16.8000, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(7, 6, '', '', '0', 9.5200, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(8, 7, '', '', '0', 4.6000, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(9, 7, '', '', '0', 4.6000, 'EUR', 1, '', 0, '0000-00-00', '2015-10-25', '', '', '2015-10-26 16:26:58', 1, 1, '', 'Kunde', 0, 0),
(10, 8, '', '', '0', 24.0000, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(11, 9, '', '', '0', 23.0000, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(12, 10, '', '', '0', 1.6000, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(13, 11, '', '', '0', 0.3000, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(14, 13, '', '', '0', 17.2000, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0),
(15, 14, '', '', '0', 6.9500, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0, '', 'Kunde', 0, 0);

--
-- Daten für Tabelle `zeiterfassung`
--

INSERT INTO `zeiterfassung` (`id`, `art`, `adresse`, `von`, `bis`, `aufgabe`, `beschreibung`, `arbeitspaket`, `buchungsart`, `kostenstelle`, `projekt`, `abgerechnet`, `logdatei`, `status`, `gps`, `arbeitsnachweispositionid`, `adresse_abrechnung`, `abrechnen`, `ist_abgerechnet`, `gebucht_von_user`, `ort`, `abrechnung_dokument`, `dokumentid`, `verrechnungsart`, `arbeitsnachweis`, `internerkommentar`, `aufgabe_id`) VALUES
(1, 'Arbeit', 1, '2015-10-26 09:00:00', '2015-10-26 17:00:00', 'Einrichtung WaWision', '', 0, 'manuell', '', 0, 0, '0000-00-00 00:00:00', NULL, '', 0, 0, 0, 0, 1, '', NULL, NULL, '', NULL, '', 0),
(2, 'Pause', 1, '2015-10-26 12:00:00', '2015-10-26 11:30:00', 'Mittagspause', '', 0, 'manuell', '', 0, 0, '0000-00-00 00:00:00', NULL, '', 0, 0, 0, 0, 1, '', NULL, NULL, '', NULL, '', 0),
(3, 'Arbeit', 1, '2015-10-27 09:00:00', '2015-10-27 16:00:00', 'Vertrieb', '', 0, 'manuell', '', 0, 0, '0000-00-00 00:00:00', NULL, '', 0, 0, 0, 0, 1, '', NULL, NULL, '', NULL, '', 0),
(4, 'Pause', 1, '2015-10-26 12:00:00', '2015-10-26 11:45:00', 'Mittagspause', '', 0, 'manuell', '', 0, 0, '0000-00-00 00:00:00', NULL, '', 0, 0, 0, 0, 1, '', NULL, NULL, '', NULL, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
