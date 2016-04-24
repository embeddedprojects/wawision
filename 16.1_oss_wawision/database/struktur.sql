-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 26. Okt 2015 um 16:16
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

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `abrechnungsartikel`
--

CREATE TABLE IF NOT EXISTS `abrechnungsartikel` (
`id` int(10) NOT NULL,
  `sort` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `menge` float NOT NULL,
  `preis` decimal(10,4) NOT NULL,
  `steuerklasse` varchar(255) NOT NULL,
  `rabatt` varchar(255) NOT NULL,
  `abgerechnet` int(1) NOT NULL,
  `startdatum` date NOT NULL,
  `lieferdatum` date NOT NULL,
  `abgerechnetbis` date NOT NULL,
  `wiederholend` int(1) NOT NULL,
  `zahlzyklus` int(10) NOT NULL,
  `abgrechnetam` date NOT NULL,
  `rechnung` int(10) NOT NULL,
  `projekt` int(10) NOT NULL,
  `adresse` int(10) NOT NULL,
  `status` varchar(64) NOT NULL,
  `bemerkung` text NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `beschreibung` varchar(255) NOT NULL DEFAULT '',
  `dokument` varchar(64) NOT NULL DEFAULT '',
  `preisart` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accordion`
--

CREATE TABLE IF NOT EXISTS `accordion` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `position` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adapterbox`
--

CREATE TABLE IF NOT EXISTS `adapterbox` (
`id` int(11) NOT NULL,
  `bezeichnung` varchar(128) NOT NULL DEFAULT '',
  `verwendenals` varchar(128) NOT NULL DEFAULT '',
  `baudrate` varchar(128) NOT NULL DEFAULT '',
  `model` varchar(128) NOT NULL DEFAULT '',
  `seriennummer` varchar(128) NOT NULL DEFAULT '',
  `ipadresse` varchar(128) NOT NULL DEFAULT '',
  `netmask` varchar(128) NOT NULL DEFAULT '',
  `gateway` varchar(128) NOT NULL DEFAULT '',
  `dns` varchar(128) NOT NULL DEFAULT '',
  `dhcp` tinyint(1) NOT NULL DEFAULT '1',
  `wlan` tinyint(1) NOT NULL DEFAULT '0',
  `ssid` varchar(128) NOT NULL DEFAULT '',
  `passphrase` varchar(256) NOT NULL DEFAULT '',
  `letzteverbindung` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adapterbox_log`
--

CREATE TABLE IF NOT EXISTS `adapterbox_log` (
`id` int(11) NOT NULL,
  `ip` varchar(64) NOT NULL DEFAULT '',
  `meldung` varchar(64) NOT NULL DEFAULT '',
  `seriennummer` varchar(64) NOT NULL DEFAULT '',
  `device` varchar(64) NOT NULL DEFAULT '',
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
`id` int(10) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `marketingsperre` varchar(64) NOT NULL,
  `trackingsperre` int(1) NOT NULL,
  `rechnungsadresse` int(1) NOT NULL,
  `sprache` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `ansprechpartner` varchar(255) NOT NULL,
  `land` varchar(64) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `ort` varchar(64) NOT NULL,
  `plz` varchar(64) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `mobil` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `ust_befreit` int(1) NOT NULL,
  `passwort_gesendet` int(1) NOT NULL,
  `sonstiges` text NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `kundenfreigabe` int(1) NOT NULL,
  `steuer` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kundennummer` varchar(255) NOT NULL,
  `lieferantennummer` varchar(255) NOT NULL,
  `mitarbeiternummer` varchar(255) NOT NULL,
  `konto` varchar(255) NOT NULL,
  `blz` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `inhaber` varchar(255) NOT NULL,
  `swift` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `waehrung` varchar(255) NOT NULL,
  `paypal` varchar(255) NOT NULL,
  `paypalinhaber` varchar(255) NOT NULL,
  `paypalwaehrung` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `partner` int(11) NOT NULL,
  `zahlungsweise` varchar(64) NOT NULL,
  `zahlungszieltage` varchar(64) NOT NULL,
  `zahlungszieltageskonto` varchar(64) NOT NULL,
  `zahlungszielskonto` varchar(64) NOT NULL,
  `versandart` varchar(64) NOT NULL,
  `kundennummerlieferant` varchar(64) NOT NULL,
  `zahlungsweiselieferant` varchar(64) NOT NULL,
  `zahlungszieltagelieferant` varchar(64) NOT NULL,
  `zahlungszieltageskontolieferant` varchar(64) NOT NULL,
  `zahlungszielskontolieferant` varchar(64) NOT NULL,
  `versandartlieferant` varchar(64) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  `webid` varchar(1024) DEFAULT NULL,
  `vorname` varchar(255) DEFAULT NULL,
  `kennung` varchar(255) DEFAULT NULL,
  `sachkonto` varchar(20) NOT NULL DEFAULT '',
  `freifeld1` text,
  `freifeld2` text,
  `freifeld3` text,
  `filiale` text,
  `vertrieb` int(11) DEFAULT NULL,
  `innendienst` int(11) DEFAULT NULL,
  `verbandsnummer` varchar(255) DEFAULT NULL,
  `abweichendeemailab` varchar(64) DEFAULT NULL,
  `portofrei_aktiv` decimal(10,2) DEFAULT NULL,
  `portofreiab` decimal(10,2) NOT NULL DEFAULT '0.00',
  `infoauftragserfassung` text NOT NULL,
  `mandatsreferenz` varchar(255) NOT NULL DEFAULT '',
  `mandatsreferenzdatum` date DEFAULT NULL,
  `mandatsreferenzaenderung` tinyint(1) NOT NULL DEFAULT '0',
  `glaeubigeridentnr` varchar(255) NOT NULL DEFAULT '',
  `kreditlimit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tour` int(11) NOT NULL DEFAULT '0',
  `zahlungskonditionen_festschreiben` int(1) DEFAULT NULL,
  `rabatte_festschreiben` int(1) DEFAULT NULL,
  `mlmaktiv` int(1) DEFAULT NULL,
  `mlmvertragsbeginn` date DEFAULT NULL,
  `mlmlizenzgebuehrbis` date DEFAULT NULL,
  `mlmfestsetzenbis` date DEFAULT NULL,
  `mlmfestsetzen` int(1) NOT NULL DEFAULT '0',
  `mlmmindestpunkte` int(1) NOT NULL DEFAULT '0',
  `mlmwartekonto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `abweichende_rechnungsadresse` int(1) NOT NULL DEFAULT '0',
  `rechnung_vorname` varchar(64) DEFAULT NULL,
  `rechnung_name` varchar(64) DEFAULT NULL,
  `rechnung_titel` varchar(64) DEFAULT NULL,
  `rechnung_typ` varchar(64) DEFAULT NULL,
  `rechnung_strasse` varchar(64) DEFAULT NULL,
  `rechnung_ort` varchar(64) DEFAULT NULL,
  `rechnung_plz` varchar(64) DEFAULT NULL,
  `rechnung_ansprechpartner` varchar(64) DEFAULT NULL,
  `rechnung_land` varchar(64) DEFAULT NULL,
  `rechnung_abteilung` varchar(64) DEFAULT NULL,
  `rechnung_unterabteilung` varchar(64) DEFAULT NULL,
  `rechnung_adresszusatz` varchar(64) DEFAULT NULL,
  `rechnung_telefon` varchar(64) DEFAULT NULL,
  `rechnung_telefax` varchar(64) DEFAULT NULL,
  `rechnung_anschreiben` varchar(64) DEFAULT NULL,
  `rechnung_email` varchar(64) DEFAULT NULL,
  `geburtstag` date DEFAULT NULL,
  `rolledatum` date DEFAULT NULL,
  `liefersperre` int(1) DEFAULT NULL,
  `liefersperregrund` text,
  `mlmpositionierung` varchar(255) DEFAULT NULL,
  `steuernummer` varchar(255) DEFAULT NULL,
  `steuerbefreit` int(1) DEFAULT NULL,
  `mlmmitmwst` int(1) DEFAULT NULL,
  `mlmabrechnung` varchar(64) DEFAULT NULL,
  `mlmwaehrungauszahlung` varchar(64) DEFAULT NULL,
  `mlmauszahlungprojekt` int(11) NOT NULL DEFAULT '0',
  `sponsor` int(11) DEFAULT NULL,
  `geworbenvon` int(11) DEFAULT NULL,
  `logfile` text,
  `kalender_aufgaben` int(1) DEFAULT NULL,
  `verrechnungskontoreisekosten` int(11) NOT NULL DEFAULT '0',
  `usereditid` int(11) DEFAULT NULL,
  `useredittimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rabatt` decimal(10,2) DEFAULT NULL,
  `provision` decimal(10,2) DEFAULT NULL,
  `rabattinformation` text,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `internetseite` text,
  `bonus1` decimal(10,2) DEFAULT NULL,
  `bonus1_ab` decimal(10,2) DEFAULT NULL,
  `bonus2` decimal(10,2) DEFAULT NULL,
  `bonus2_ab` decimal(10,2) DEFAULT NULL,
  `bonus3` decimal(10,2) DEFAULT NULL,
  `bonus3_ab` decimal(10,2) DEFAULT NULL,
  `bonus4` decimal(10,2) DEFAULT NULL,
  `bonus4_ab` decimal(10,2) DEFAULT NULL,
  `bonus5` decimal(10,2) DEFAULT NULL,
  `bonus5_ab` decimal(10,2) DEFAULT NULL,
  `bonus6` decimal(10,2) DEFAULT NULL,
  `bonus6_ab` decimal(10,2) DEFAULT NULL,
  `bonus7` decimal(10,2) DEFAULT NULL,
  `bonus7_ab` decimal(10,2) DEFAULT NULL,
  `bonus8` decimal(10,2) DEFAULT NULL,
  `bonus8_ab` decimal(10,2) DEFAULT NULL,
  `bonus9` decimal(10,2) DEFAULT NULL,
  `bonus9_ab` decimal(10,2) DEFAULT NULL,
  `bonus10` decimal(10,2) DEFAULT NULL,
  `bonus10_ab` decimal(10,2) DEFAULT NULL,
  `rechnung_periode` int(11) DEFAULT NULL,
  `rechnung_anzahlpapier` int(11) DEFAULT NULL,
  `rechnung_permail` int(1) DEFAULT NULL,
  `titel` varchar(64) DEFAULT NULL,
  `anschreiben` varchar(64) DEFAULT NULL,
  `nachname` varchar(128) NOT NULL DEFAULT '',
  `arbeitszeitprowoche` decimal(10,2) NOT NULL DEFAULT '0.00',
  `folgebestaetigungsperre` tinyint(1) NOT NULL DEFAULT '0',
  `lieferantennummerbeikunde` varchar(128) DEFAULT NULL,
  `verein_mitglied_seit` date DEFAULT NULL,
  `verein_mitglied_bis` date DEFAULT NULL,
  `verein_mitglied_aktiv` tinyint(1) DEFAULT NULL,
  `verein_spendenbescheinigung` tinyint(1) NOT NULL DEFAULT '0',
  `freifeld4` text,
  `freifeld5` text,
  `freifeld6` text,
  `freifeld7` text,
  `freifeld8` text,
  `freifeld9` text,
  `freifeld10` text,
  `rechnung_papier` tinyint(1) NOT NULL DEFAULT '0',
  `angebot_cc` varchar(128) NOT NULL DEFAULT '',
  `auftrag_cc` varchar(128) NOT NULL DEFAULT '',
  `rechnung_cc` varchar(128) NOT NULL DEFAULT '',
  `gutschrift_cc` varchar(128) NOT NULL DEFAULT '',
  `lieferschein_cc` varchar(128) NOT NULL DEFAULT '',
  `bestellung_cc` varchar(128) NOT NULL DEFAULT '',
  `angebot_fax_cc` varchar(128) NOT NULL DEFAULT '',
  `auftrag_fax_cc` varchar(128) NOT NULL DEFAULT '',
  `rechnung_fax_cc` varchar(128) NOT NULL DEFAULT '',
  `gutschrift_fax_cc` varchar(128) NOT NULL DEFAULT '',
  `lieferschein_fax_cc` varchar(128) NOT NULL DEFAULT '',
  `bestellung_fax_cc` varchar(128) NOT NULL DEFAULT '',
  `abperfax` tinyint(1) NOT NULL DEFAULT '0',
  `abpermail` varchar(128) NOT NULL DEFAULT '',
  `kassiereraktiv` int(1) NOT NULL DEFAULT '0',
  `kassierernummer` varchar(10) NOT NULL DEFAULT '',
  `kassiererprojekt` int(11) NOT NULL DEFAULT '0',
  `portofreilieferant_aktiv` tinyint(1) NOT NULL DEFAULT '0',
  `portofreiablieferant` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mandatsreferenzart` varchar(64) NOT NULL DEFAULT '',
  `mandatsreferenzwdhart` varchar(64) NOT NULL DEFAULT '',
  `serienbrief` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_accounts`
--

CREATE TABLE IF NOT EXISTS `adresse_accounts` (
`id` int(11) NOT NULL,
  `aktiv` tinyint(1) NOT NULL DEFAULT '1',
  `adresse` int(11) DEFAULT NULL,
  `bezeichnung` varchar(128) DEFAULT NULL,
  `art` varchar(128) DEFAULT NULL,
  `url` text NOT NULL,
  `benutzername` text NOT NULL,
  `passwort` text NOT NULL,
  `webid` int(11) NOT NULL DEFAULT '0',
  `gueltig_ab` date DEFAULT NULL,
  `gueltig_bis` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_import`
--

CREATE TABLE IF NOT EXISTS `adresse_import` (
`id` int(11) NOT NULL,
  `typ` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `ansprechpartner` varchar(255) NOT NULL DEFAULT '',
  `abteilung` varchar(255) NOT NULL DEFAULT '',
  `unterabteilung` varchar(255) NOT NULL DEFAULT '',
  `adresszusatz` varchar(255) NOT NULL DEFAULT '',
  `strasse` varchar(255) NOT NULL DEFAULT '',
  `plz` varchar(255) NOT NULL DEFAULT '',
  `ort` varchar(255) NOT NULL DEFAULT '',
  `land` varchar(255) NOT NULL DEFAULT '',
  `telefon` varchar(255) NOT NULL DEFAULT '',
  `telefax` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `mobil` varchar(255) NOT NULL DEFAULT '',
  `internetseite` varchar(255) NOT NULL DEFAULT '',
  `ustid` varchar(255) NOT NULL DEFAULT '',
  `user` int(11) NOT NULL DEFAULT '0',
  `adresse` int(11) NOT NULL DEFAULT '0',
  `angelegt_am` datetime DEFAULT NULL,
  `abgeschlossen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_kontakhistorie`
--

CREATE TABLE IF NOT EXISTS `adresse_kontakhistorie` (
`id` int(10) NOT NULL,
  `adresse` int(10) NOT NULL,
  `grund` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `datum` datetime NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_kontakte`
--

CREATE TABLE IF NOT EXISTS `adresse_kontakte` (
`id` int(11) NOT NULL,
  `adresse` int(11) DEFAULT NULL,
  `bezeichnung` varchar(1024) DEFAULT NULL,
  `kontakt` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_rolle`
--

CREATE TABLE IF NOT EXISTS `adresse_rolle` (
`id` int(10) NOT NULL,
  `adresse` int(10) NOT NULL,
  `projekt` int(11) NOT NULL,
  `subjekt` varchar(255) NOT NULL,
  `praedikat` varchar(255) NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `von` date NOT NULL,
  `bis` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebot`
--

CREATE TABLE IF NOT EXISTS `angebot` (
`id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `gueltigbis` date NOT NULL,
  `projekt` varchar(222) NOT NULL,
  `belegnr` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `anfrage` varchar(255) NOT NULL,
  `auftrag` varchar(255) NOT NULL,
  `freitext` text NOT NULL,
  `internebemerkung` text NOT NULL,
  `status` varchar(64) NOT NULL,
  `adresse` int(11) NOT NULL,
  `retyp` varchar(255) NOT NULL,
  `rechnungname` varchar(255) NOT NULL,
  `retelefon` varchar(255) NOT NULL,
  `reansprechpartner` varchar(255) NOT NULL,
  `retelefax` varchar(255) NOT NULL,
  `reabteilung` varchar(255) NOT NULL,
  `reemail` varchar(255) NOT NULL,
  `reunterabteilung` varchar(255) NOT NULL,
  `readresszusatz` varchar(255) NOT NULL,
  `restrasse` varchar(255) NOT NULL,
  `replz` varchar(255) NOT NULL,
  `reort` varchar(255) NOT NULL,
  `reland` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `vertrieb` varchar(255) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlungszielskonto` decimal(10,2) NOT NULL,
  `gesamtsumme` decimal(10,4) NOT NULL,
  `bank_inhaber` varchar(255) NOT NULL,
  `bank_institut` varchar(255) NOT NULL,
  `bank_blz` int(11) NOT NULL,
  `bank_konto` int(11) NOT NULL,
  `kreditkarte_typ` varchar(255) NOT NULL,
  `kreditkarte_inhaber` varchar(255) NOT NULL,
  `kreditkarte_nummer` varchar(255) NOT NULL,
  `kreditkarte_pruefnummer` varchar(255) NOT NULL,
  `kreditkarte_monat` int(11) NOT NULL,
  `kreditkarte_jahr` int(11) NOT NULL,
  `abweichendelieferadresse` int(1) NOT NULL,
  `abweichenderechnungsadresse` int(1) NOT NULL,
  `liefername` varchar(255) NOT NULL,
  `lieferabteilung` varchar(255) NOT NULL,
  `lieferunterabteilung` varchar(255) NOT NULL,
  `lieferland` varchar(255) NOT NULL,
  `lieferstrasse` varchar(255) NOT NULL,
  `lieferort` varchar(255) NOT NULL,
  `lieferplz` varchar(255) NOT NULL,
  `lieferadresszusatz` varchar(255) NOT NULL,
  `lieferansprechpartner` varchar(255) NOT NULL,
  `liefertelefon` varchar(255) NOT NULL,
  `liefertelefax` varchar(255) NOT NULL,
  `liefermail` varchar(255) NOT NULL,
  `autoversand` int(1) NOT NULL,
  `keinporto` int(1) NOT NULL,
  `ust_befreit` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  `versendet` int(1) NOT NULL,
  `versendet_am` datetime NOT NULL,
  `versendet_per` varchar(255) NOT NULL,
  `versendet_durch` varchar(255) NOT NULL,
  `inbearbeitung` int(1) NOT NULL,
  `vermerk` text NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ansprechpartner` varchar(255) DEFAULT NULL,
  `deckungsbeitragcalc` tinyint(1) NOT NULL DEFAULT '0',
  `deckungsbeitrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `erloes_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `umsatz_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `lieferdatum` date DEFAULT NULL,
  `vertriebid` int(11) DEFAULT NULL,
  `aktion` varchar(64) NOT NULL DEFAULT '',
  `provision` decimal(10,2) DEFAULT NULL,
  `provision_summe` decimal(10,2) DEFAULT NULL,
  `keinsteuersatz` int(1) DEFAULT NULL,
  `anfrageid` int(11) NOT NULL DEFAULT '0',
  `gruppe` int(11) NOT NULL DEFAULT '0',
  `anschreiben` varchar(255) DEFAULT NULL,
  `usereditid` int(11) DEFAULT NULL,
  `useredittimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `realrabatt` decimal(10,2) DEFAULT NULL,
  `rabatt` decimal(10,2) DEFAULT NULL,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `steuersatz_normal` decimal(10,2) NOT NULL DEFAULT '19.00',
  `steuersatz_zwischen` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_ermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_starkermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_dienstleistung` decimal(10,2) NOT NULL DEFAULT '7.00',
  `waehrung` varchar(255) NOT NULL DEFAULT 'EUR',
  `schreibschutz` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviert` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviertversion` int(11) NOT NULL DEFAULT '0',
  `typ` varchar(255) NOT NULL DEFAULT 'firma',
  `ohne_briefpapier` int(1) DEFAULT NULL,
  `auftragid` int(11) NOT NULL DEFAULT '0',
  `lieferid` int(11) NOT NULL DEFAULT '0',
  `ansprechpartnerid` int(11) NOT NULL DEFAULT '0',
  `projektfiliale` int(11) NOT NULL DEFAULT '0',
  `abweichendebezeichnung` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebot_position`
--

CREATE TABLE IF NOT EXISTS `angebot_position` (
`id` int(10) NOT NULL,
  `angebot` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `internerkommentar` text NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `menge` float NOT NULL,
  `preis` decimal(10,4) NOT NULL,
  `waehrung` varchar(255) NOT NULL,
  `lieferdatum` date NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `status` varchar(64) NOT NULL,
  `umsatzsteuer` varchar(255) NOT NULL,
  `bemerkung` text NOT NULL,
  `geliefert` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `punkte` decimal(10,2) NOT NULL,
  `bonuspunkte` decimal(10,2) NOT NULL,
  `mlmdirektpraemie` decimal(10,2) DEFAULT NULL,
  `keinrabatterlaubt` int(1) DEFAULT NULL,
  `grundrabatt` decimal(10,2) DEFAULT NULL,
  `rabattsync` int(1) DEFAULT NULL,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `einheit` varchar(255) NOT NULL DEFAULT '',
  `optional` int(1) NOT NULL DEFAULT '0',
  `rabatt` decimal(10,2) NOT NULL,
  `zolltarifnummer` varchar(128) NOT NULL DEFAULT '0',
  `herkunftsland` varchar(128) NOT NULL DEFAULT '0',
  `artikelnummerkunde` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebot_protokoll`
--

CREATE TABLE IF NOT EXISTS `angebot_protokoll` (
`id` int(11) NOT NULL,
  `angebot` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ansprechpartner`
--

CREATE TABLE IF NOT EXISTS `ansprechpartner` (
`id` int(10) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `sprache` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bereich` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sonstiges` text NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `steuer` varchar(255) NOT NULL,
  `adresse` int(10) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mobil` varchar(255) DEFAULT NULL,
  `titel` varchar(1024) DEFAULT NULL,
  `anschreiben` varchar(1024) DEFAULT NULL,
  `ansprechpartner_land` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arbeitspaket`
--

CREATE TABLE IF NOT EXISTS `arbeitspaket` (
`id` int(10) NOT NULL,
  `adresse` int(10) NOT NULL,
  `aufgabe` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `beschreibung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `projekt` int(10) NOT NULL,
  `zeit_geplant` decimal(10,2) NOT NULL,
  `kostenstelle` int(11) NOT NULL,
  `status` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `abgabe` varchar(255) NOT NULL,
  `abgenommen` varchar(255) NOT NULL,
  `abgenommen_von` int(10) NOT NULL,
  `abgenommen_bemerkung` text NOT NULL,
  `initiator` int(10) NOT NULL,
  `art` varchar(255) NOT NULL,
  `abgabedatum` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `geloescht` int(1) DEFAULT NULL,
  `vorgaenger` int(11) DEFAULT NULL,
  `kosten_geplant` decimal(10,4) DEFAULT NULL,
  `artikel_geplant` int(11) DEFAULT NULL,
  `auftragid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
`id` int(10) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `checksum` text NOT NULL,
  `projekt` int(11) NOT NULL,
  `inaktiv` varchar(255) NOT NULL,
  `ausverkauft` int(1) NOT NULL,
  `warengruppe` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `kurztext_de` text NOT NULL,
  `kurztext_en` text NOT NULL,
  `beschreibung_de` text NOT NULL,
  `beschreibung_en` text NOT NULL,
  `uebersicht_de` text NOT NULL,
  `uebersicht_en` text NOT NULL,
  `links_de` text NOT NULL,
  `links_en` text NOT NULL,
  `startseite_de` text NOT NULL,
  `startseite_en` text NOT NULL,
  `standardbild` varchar(255) NOT NULL,
  `herstellerlink` varchar(255) NOT NULL,
  `hersteller` varchar(255) NOT NULL,
  `teilbar` varchar(255) NOT NULL,
  `nteile` varchar(255) NOT NULL,
  `seriennummern` varchar(255) NOT NULL,
  `lager_platz` varchar(255) NOT NULL,
  `lieferzeit` varchar(255) NOT NULL,
  `lieferzeitmanuell` varchar(255) NOT NULL,
  `sonstiges` text NOT NULL,
  `gewicht` varchar(255) NOT NULL,
  `endmontage` varchar(255) NOT NULL,
  `funktionstest` varchar(255) NOT NULL,
  `artikelcheckliste` varchar(255) NOT NULL,
  `stueckliste` int(1) NOT NULL,
  `juststueckliste` int(1) NOT NULL,
  `barcode` varchar(7) NOT NULL,
  `hinzugefuegt` varchar(255) NOT NULL,
  `pcbdecal` varchar(255) NOT NULL,
  `lagerartikel` int(1) NOT NULL,
  `porto` int(1) NOT NULL,
  `chargenverwaltung` int(1) NOT NULL,
  `provisionsartikel` int(1) NOT NULL,
  `gesperrt` int(1) NOT NULL,
  `sperrgrund` varchar(255) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `gueltigbis` date NOT NULL,
  `umsatzsteuer` varchar(255) NOT NULL,
  `klasse` varchar(255) NOT NULL,
  `adresse` int(11) NOT NULL,
  `shopartikel` int(1) NOT NULL,
  `unishopartikel` int(1) NOT NULL,
  `journalshopartikel` int(11) NOT NULL,
  `shop` int(11) NOT NULL,
  `katalog` int(1) NOT NULL,
  `katalogtext_de` text NOT NULL,
  `katalogtext_en` text NOT NULL,
  `katalogbezeichnung_de` varchar(255) NOT NULL,
  `katalogbezeichnung_en` varchar(255) NOT NULL,
  `neu` int(1) NOT NULL,
  `topseller` int(1) NOT NULL,
  `startseite` int(1) NOT NULL,
  `wichtig` int(1) NOT NULL,
  `mindestlager` int(11) NOT NULL,
  `mindestbestellung` int(11) NOT NULL,
  `partnerprogramm_sperre` int(1) NOT NULL,
  `internerkommentar` text NOT NULL,
  `intern_gesperrt` int(11) NOT NULL,
  `intern_gesperrtuser` int(11) NOT NULL,
  `intern_gesperrtgrund` text NOT NULL,
  `inbearbeitung` int(11) NOT NULL,
  `inbearbeitunguser` int(11) NOT NULL,
  `cache_lagerplatzinhaltmenge` int(11) NOT NULL,
  `internkommentar` text NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `anabregs_text` text,
  `autobestellung` int(1) NOT NULL DEFAULT '0',
  `produktion` int(1) DEFAULT NULL,
  `herstellernummer` varchar(255) DEFAULT NULL,
  `restmenge` int(1) DEFAULT NULL,
  `mlmdirektpraemie` decimal(10,2) DEFAULT NULL,
  `keineeinzelartikelanzeigen` tinyint(1) NOT NULL DEFAULT '0',
  `mindesthaltbarkeitsdatum` int(1) NOT NULL DEFAULT '0',
  `letzteseriennummer` varchar(255) NOT NULL DEFAULT '',
  `individualartikel` int(1) NOT NULL DEFAULT '0',
  `keinrabatterlaubt` int(1) DEFAULT NULL,
  `rabatt` int(1) NOT NULL DEFAULT '0',
  `rabatt_prozent` decimal(10,2) DEFAULT NULL,
  `geraet` tinyint(1) NOT NULL DEFAULT '0',
  `serviceartikel` tinyint(1) NOT NULL DEFAULT '0',
  `autoabgleicherlaubt` int(1) NOT NULL DEFAULT '0',
  `pseudopreis` decimal(10,2) DEFAULT NULL,
  `freigabenotwendig` int(1) NOT NULL DEFAULT '0',
  `freigaberegel` varchar(255) NOT NULL DEFAULT '',
  `nachbestellt` int(1) DEFAULT NULL,
  `ean` varchar(1024) NOT NULL DEFAULT '',
  `mlmpunkte` decimal(10,2) NOT NULL,
  `mlmbonuspunkte` decimal(10,2) NOT NULL,
  `mlmkeinepunkteeigenkauf` int(1) DEFAULT NULL,
  `shop2` int(11) DEFAULT NULL,
  `shop3` int(11) DEFAULT NULL,
  `usereditid` int(11) DEFAULT NULL,
  `useredittimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `freifeld1` text NOT NULL,
  `freifeld2` text NOT NULL,
  `freifeld3` text NOT NULL,
  `freifeld4` text NOT NULL,
  `freifeld5` text NOT NULL,
  `freifeld6` text NOT NULL,
  `einheit` varchar(255) NOT NULL DEFAULT '',
  `webid` varchar(1024) NOT NULL,
  `lieferzeitmanuell_en` varchar(255) DEFAULT NULL,
  `variante` int(1) DEFAULT NULL,
  `variante_von` int(11) DEFAULT NULL,
  `produktioninfo` text,
  `sonderaktion` text,
  `sonderaktion_en` text,
  `autolagerlampe` int(1) NOT NULL DEFAULT '0',
  `leerfeld` varchar(64) DEFAULT NULL,
  `zolltarifnummer` varchar(64) NOT NULL DEFAULT '',
  `herkunftsland` varchar(64) NOT NULL DEFAULT '',
  `laenge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `breite` decimal(10,2) NOT NULL DEFAULT '0.00',
  `hoehe` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gebuehr` tinyint(1) NOT NULL DEFAULT '0',
  `pseudolager` varchar(10) NOT NULL DEFAULT '',
  `downloadartikel` tinyint(1) NOT NULL DEFAULT '0',
  `matrixprodukt` tinyint(1) NOT NULL DEFAULT '0',
  `steuer_erloese_inland_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_innergemeinschaftlich` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_innergemeinschaftlich` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_eunormal` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_nichtsteuerbar` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_euermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_nichtsteuerbar` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_eunormal` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_euermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_export` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_import` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_produkt` int(1) NOT NULL DEFAULT '1',
  `steuer_art_produkt_download` int(1) NOT NULL DEFAULT '1',
  `metadescription_de` varchar(255) NOT NULL DEFAULT '',
  `metadescription_en` varchar(255) NOT NULL DEFAULT '',
  `metakeywords_de` varchar(255) NOT NULL DEFAULT '',
  `metakeywords_en` varchar(255) NOT NULL DEFAULT '',
  `anabregs_text_en` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikeleinheit`
--

CREATE TABLE IF NOT EXISTS `artikeleinheit` (
`id` int(11) NOT NULL,
  `einheit_de` varchar(255) DEFAULT NULL,
  `internebemerkung` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikelgruppen`
--

CREATE TABLE IF NOT EXISTS `artikelgruppen` (
`id` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `bezeichnung_en` varchar(255) NOT NULL,
  `shop` int(11) NOT NULL,
  `aktiv` int(1) NOT NULL,
  `beschreibung_de` text,
  `beschreibung_en` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel_artikelgruppe`
--

CREATE TABLE IF NOT EXISTS `artikel_artikelgruppe` (
`id` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `artikelgruppe` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `geloescht` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel_permanenteinventur`
--

CREATE TABLE IF NOT EXISTS `artikel_permanenteinventur` (
`id` int(11) NOT NULL,
  `artikel` int(11) NOT NULL DEFAULT '0',
  `lager_platz` int(11) NOT NULL DEFAULT '0',
  `menge` int(11) NOT NULL DEFAULT '0',
  `zeitstempel` datetime DEFAULT NULL,
  `bearbeiter` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel_shop`
--

CREATE TABLE IF NOT EXISTS `artikel_shop` (
`id` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `shop` int(11) NOT NULL,
  `checksum` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aufgabe`
--

CREATE TABLE IF NOT EXISTS `aufgabe` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `aufgabe` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `prio` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `kostenstelle` int(11) NOT NULL,
  `initiator` int(11) NOT NULL,
  `angelegt_am` date NOT NULL,
  `startdatum` date NOT NULL,
  `startzeit` time NOT NULL,
  `intervall_tage` int(11) NOT NULL,
  `stunden` decimal(10,2) DEFAULT NULL,
  `abgabe_bis` date NOT NULL,
  `abgeschlossen` int(1) NOT NULL,
  `abgeschlossen_am` date NOT NULL,
  `sonstiges` text NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `startseite` int(1) DEFAULT NULL,
  `oeffentlich` int(1) DEFAULT NULL,
  `emailerinnerung` int(1) DEFAULT NULL,
  `emailerinnerung_tage` int(11) DEFAULT NULL,
  `note_x` int(11) DEFAULT NULL,
  `note_y` int(11) DEFAULT NULL,
  `note_z` int(11) DEFAULT NULL,
  `note_color` varchar(255) DEFAULT NULL,
  `pinwand` int(1) DEFAULT NULL,
  `vorankuendigung` int(11) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL,
  `ganztags` int(1) NOT NULL DEFAULT '1',
  `zeiterfassung_pflicht` tinyint(1) NOT NULL DEFAULT '0',
  `zeiterfassung_abrechnung` tinyint(1) NOT NULL DEFAULT '0',
  `kunde` int(11) DEFAULT NULL,
  `pinwand_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) DEFAULT NULL,
  `abgabe_bis_zeit` time DEFAULT NULL,
  `email_gesendet_vorankuendigung` tinyint(1) NOT NULL DEFAULT '0',
  `email_gesendet` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aufgabe_erledigt`
--

CREATE TABLE IF NOT EXISTS `aufgabe_erledigt` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `aufgabe` int(11) NOT NULL,
  `abgeschlossen_am` date NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag`
--

CREATE TABLE IF NOT EXISTS `auftrag` (
`id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `art` varchar(255) NOT NULL,
  `projekt` varchar(222) NOT NULL,
  `belegnr` varchar(255) NOT NULL,
  `internet` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `angebot` varchar(255) NOT NULL,
  `freitext` text NOT NULL,
  `internebemerkung` text NOT NULL,
  `status` varchar(64) NOT NULL,
  `adresse` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `ansprechpartner` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `ust_befreit` int(1) NOT NULL,
  `ust_inner` int(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `vertrieb` varchar(255) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlungszielskonto` decimal(10,2) NOT NULL,
  `bank_inhaber` varchar(255) NOT NULL,
  `bank_institut` varchar(255) NOT NULL,
  `bank_blz` varchar(255) NOT NULL,
  `bank_konto` varchar(255) NOT NULL,
  `kreditkarte_typ` varchar(255) NOT NULL,
  `kreditkarte_inhaber` varchar(255) NOT NULL,
  `kreditkarte_nummer` varchar(255) NOT NULL,
  `kreditkarte_pruefnummer` varchar(255) NOT NULL,
  `kreditkarte_monat` varchar(255) NOT NULL,
  `kreditkarte_jahr` varchar(255) NOT NULL,
  `firma` int(11) NOT NULL,
  `versendet` int(1) NOT NULL,
  `versendet_am` datetime NOT NULL,
  `versendet_per` varchar(255) NOT NULL,
  `versendet_durch` varchar(255) NOT NULL,
  `autoversand` int(1) NOT NULL,
  `keinporto` int(1) NOT NULL,
  `keinestornomail` int(1) NOT NULL,
  `abweichendelieferadresse` int(1) NOT NULL,
  `liefername` varchar(255) NOT NULL,
  `lieferabteilung` varchar(255) NOT NULL,
  `lieferunterabteilung` varchar(255) NOT NULL,
  `lieferland` varchar(255) NOT NULL,
  `lieferstrasse` varchar(255) NOT NULL,
  `lieferort` varchar(255) NOT NULL,
  `lieferplz` varchar(255) NOT NULL,
  `lieferadresszusatz` varchar(255) NOT NULL,
  `lieferansprechpartner` varchar(255) NOT NULL,
  `packstation_inhaber` varchar(255) NOT NULL,
  `packstation_station` varchar(255) NOT NULL,
  `packstation_ident` varchar(255) NOT NULL,
  `packstation_plz` varchar(255) NOT NULL,
  `packstation_ort` varchar(255) NOT NULL,
  `autofreigabe` int(1) NOT NULL,
  `freigabe` int(1) NOT NULL,
  `nachbesserung` int(1) NOT NULL,
  `gesamtsumme` decimal(10,2) NOT NULL,
  `inbearbeitung` int(1) NOT NULL,
  `abgeschlossen` int(1) NOT NULL,
  `nachlieferung` int(1) NOT NULL,
  `lager_ok` int(1) NOT NULL,
  `porto_ok` int(1) NOT NULL,
  `ust_ok` int(1) NOT NULL,
  `check_ok` int(1) NOT NULL,
  `vorkasse_ok` int(1) NOT NULL,
  `nachnahme_ok` int(1) NOT NULL,
  `reserviert_ok` int(1) NOT NULL,
  `partnerid` int(11) NOT NULL,
  `folgebestaetigung` date NOT NULL,
  `zahlungsmail` date NOT NULL,
  `stornogrund` varchar(255) NOT NULL,
  `stornosonstiges` varchar(255) NOT NULL,
  `stornorueckzahlung` varchar(255) NOT NULL,
  `stornobetrag` decimal(10,2) NOT NULL,
  `stornobankinhaber` varchar(255) NOT NULL,
  `stornobankkonto` varchar(255) NOT NULL,
  `stornobankblz` varchar(255) NOT NULL,
  `stornobankbank` varchar(255) NOT NULL,
  `stornogutschrift` int(1) NOT NULL,
  `stornogutschriftbeleg` varchar(255) NOT NULL,
  `stornowareerhalten` int(1) NOT NULL,
  `stornomanuellebearbeitung` varchar(255) NOT NULL,
  `stornokommentar` text NOT NULL,
  `stornobezahlt` varchar(255) NOT NULL,
  `stornobezahltam` date NOT NULL,
  `stornobezahltvon` varchar(255) NOT NULL,
  `stornoabgeschlossen` int(1) NOT NULL,
  `stornorueckzahlungper` varchar(255) NOT NULL,
  `stornowareerhaltenretour` int(1) NOT NULL,
  `partnerausgezahlt` int(1) NOT NULL,
  `partnerausgezahltam` date NOT NULL,
  `kennen` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keinetrackingmail` int(1) DEFAULT NULL,
  `zahlungsmailcounter` int(1) DEFAULT NULL,
  `rma` int(1) NOT NULL DEFAULT '0',
  `transaktionsnummer` varchar(255) NOT NULL DEFAULT '',
  `vorabbezahltmarkieren` int(1) NOT NULL DEFAULT '0',
  `deckungsbeitragcalc` tinyint(1) NOT NULL DEFAULT '0',
  `deckungsbeitrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `erloes_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `umsatz_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `lieferdatum` date DEFAULT NULL,
  `tatsaechlicheslieferdatum` date DEFAULT NULL,
  `liefertermin_ok` int(1) NOT NULL DEFAULT '1',
  `teillieferung_moeglich` int(1) NOT NULL DEFAULT '0',
  `kreditlimit_ok` int(1) NOT NULL DEFAULT '1',
  `kreditlimit_freigabe` int(1) NOT NULL DEFAULT '0',
  `liefersperre_ok` int(1) NOT NULL DEFAULT '1',
  `teillieferungvon` int(11) NOT NULL DEFAULT '0',
  `teillieferungnummer` int(11) NOT NULL DEFAULT '0',
  `vertriebid` int(11) DEFAULT NULL,
  `aktion` varchar(64) NOT NULL DEFAULT '',
  `provision` decimal(10,2) DEFAULT NULL,
  `provision_summe` decimal(10,2) DEFAULT NULL,
  `anfrageid` int(11) NOT NULL DEFAULT '0',
  `gruppe` int(11) NOT NULL DEFAULT '0',
  `shopextid` varchar(1024) NOT NULL DEFAULT '',
  `shopextstatus` varchar(1024) NOT NULL DEFAULT '',
  `ihrebestellnummer` varchar(255) DEFAULT NULL,
  `anschreiben` varchar(255) DEFAULT NULL,
  `usereditid` int(11) DEFAULT NULL,
  `useredittimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `realrabatt` decimal(10,2) DEFAULT NULL,
  `rabatt` decimal(10,2) DEFAULT NULL,
  `einzugsdatum` date DEFAULT NULL,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `shop` int(11) NOT NULL DEFAULT '0',
  `steuersatz_normal` decimal(10,2) NOT NULL DEFAULT '19.00',
  `steuersatz_zwischen` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_ermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_starkermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_dienstleistung` decimal(10,2) NOT NULL DEFAULT '7.00',
  `waehrung` varchar(255) NOT NULL DEFAULT 'EUR',
  `keinsteuersatz` int(1) DEFAULT NULL,
  `angebotid` int(11) DEFAULT NULL,
  `schreibschutz` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviert` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviertversion` int(11) NOT NULL DEFAULT '0',
  `typ` varchar(255) NOT NULL DEFAULT 'firma',
  `ohne_briefpapier` int(1) DEFAULT NULL,
  `auftragseingangper` varchar(64) NOT NULL DEFAULT '',
  `lieferid` int(11) NOT NULL DEFAULT '0',
  `ansprechpartnerid` int(11) NOT NULL DEFAULT '0',
  `systemfreitext` text NOT NULL,
  `projektfiliale` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag_position`
--

CREATE TABLE IF NOT EXISTS `auftrag_position` (
`id` int(10) NOT NULL,
  `auftrag` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `internerkommentar` text NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `menge` float NOT NULL,
  `preis` decimal(10,4) NOT NULL,
  `waehrung` varchar(255) NOT NULL,
  `lieferdatum` date NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `status` varchar(64) NOT NULL,
  `umsatzsteuer` varchar(255) NOT NULL,
  `bemerkung` text NOT NULL,
  `geliefert` int(11) NOT NULL,
  `geliefert_menge` float NOT NULL,
  `explodiert` int(1) NOT NULL,
  `explodiert_parent` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `punkte` decimal(10,2) NOT NULL,
  `bonuspunkte` decimal(10,2) NOT NULL,
  `mlmdirektpraemie` decimal(10,2) DEFAULT NULL,
  `keinrabatterlaubt` int(1) DEFAULT NULL,
  `grundrabatt` decimal(10,2) DEFAULT NULL,
  `rabattsync` int(1) DEFAULT NULL,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `einheit` varchar(255) NOT NULL DEFAULT '',
  `webid` varchar(1024) DEFAULT NULL,
  `rabatt` decimal(10,2) NOT NULL,
  `nachbestelltexternereinkauf` int(1) DEFAULT NULL,
  `zolltarifnummer` varchar(128) NOT NULL DEFAULT '0',
  `herkunftsland` varchar(128) NOT NULL DEFAULT '0',
  `artikelnummerkunde` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag_protokoll`
--

CREATE TABLE IF NOT EXISTS `auftrag_protokoll` (
`id` int(11) NOT NULL,
  `auftrag` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `dateiname` varchar(2048) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `belege`
--
CREATE TABLE IF NOT EXISTS `belege` (
`id` int(11)
,`adresse` int(11)
,`datum` date
,`belegnr` varchar(255)
,`status` varchar(64)
,`land` varchar(255)
,`typ` varchar(10)
,`umsatz_netto` decimal(11,2)
,`erloes_netto` decimal(11,2)
,`deckungsbeitrag` decimal(11,2)
,`provision_summe` decimal(11,2)
,`vertriebid` int(11)
,`gruppe` int(11)
);
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bene`
--

CREATE TABLE IF NOT EXISTS `bene` (
`id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `berichte`
--

CREATE TABLE IF NOT EXISTS `berichte` (
`id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `beschreibung` text,
  `internebemerkung` text,
  `struktur` text,
  `spaltennamen` varchar(1024) DEFAULT NULL,
  `spaltenbreite` varchar(1024) DEFAULT NULL,
  `spaltenausrichtung` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE IF NOT EXISTS `bestellung` (
`id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `projekt` varchar(222) NOT NULL,
  `bestellungsart` varchar(255) NOT NULL,
  `belegnr` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `angebot` varchar(255) NOT NULL,
  `freitext` text NOT NULL,
  `internebemerkung` text NOT NULL,
  `status` varchar(64) NOT NULL,
  `adresse` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `abweichendelieferadresse` int(1) NOT NULL,
  `liefername` varchar(255) NOT NULL,
  `lieferabteilung` varchar(255) NOT NULL,
  `lieferunterabteilung` varchar(255) NOT NULL,
  `lieferland` varchar(255) NOT NULL,
  `lieferstrasse` varchar(255) NOT NULL,
  `lieferort` varchar(255) NOT NULL,
  `lieferplz` varchar(255) NOT NULL,
  `lieferadresszusatz` varchar(255) NOT NULL,
  `lieferansprechpartner` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `ust_befreit` int(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `lieferantennummer` varchar(255) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `lieferdatum` date NOT NULL,
  `einkaeufer` varchar(255) NOT NULL,
  `keineartikelnummern` int(1) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungsstatus` varchar(255) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlungszielskonto` decimal(10,2) NOT NULL,
  `gesamtsumme` decimal(10,4) NOT NULL,
  `bank_inhaber` varchar(255) NOT NULL,
  `bank_institut` varchar(255) NOT NULL,
  `bank_blz` int(11) NOT NULL,
  `bank_konto` int(11) NOT NULL,
  `paypalaccount` varchar(255) NOT NULL,
  `bestellbestaetigung` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  `versendet` int(1) NOT NULL,
  `versendet_am` datetime NOT NULL,
  `versendet_per` varchar(255) NOT NULL,
  `versendet_durch` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `artikelnummerninfotext` int(1) DEFAULT NULL,
  `ansprechpartner` varchar(255) DEFAULT NULL,
  `anschreiben` varchar(255) DEFAULT NULL,
  `usereditid` int(11) DEFAULT NULL,
  `useredittimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `steuersatz_normal` decimal(10,2) NOT NULL DEFAULT '19.00',
  `steuersatz_zwischen` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_ermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_starkermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_dienstleistung` decimal(10,2) NOT NULL DEFAULT '7.00',
  `waehrung` varchar(255) NOT NULL DEFAULT 'EUR',
  `bestellungohnepreis` tinyint(1) NOT NULL DEFAULT '0',
  `schreibschutz` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviert` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviertversion` int(11) NOT NULL DEFAULT '0',
  `typ` varchar(255) NOT NULL DEFAULT 'firma',
  `verbindlichkeiteninfo` varchar(255) NOT NULL DEFAULT '',
  `ohne_briefpapier` int(1) DEFAULT NULL,
  `projektfiliale` int(11) NOT NULL DEFAULT '0',
  `bestellung_bestaetigt` tinyint(1) NOT NULL DEFAULT '0',
  `bestaetigteslieferdatum` date DEFAULT NULL,
  `bestellungbestaetigtper` varchar(64) NOT NULL DEFAULT '',
  `bestellungbestaetigtabnummer` varchar(64) NOT NULL DEFAULT '',
  `gewuenschteslieferdatum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung_position`
--

CREATE TABLE IF NOT EXISTS `bestellung_position` (
`id` int(10) NOT NULL,
  `bestellung` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bezeichnunglieferant` varchar(255) NOT NULL,
  `bestellnummer` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `menge` float NOT NULL,
  `preis` decimal(10,4) NOT NULL,
  `waehrung` varchar(255) NOT NULL,
  `lieferdatum` date NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `status` varchar(64) NOT NULL,
  `umsatzsteuer` varchar(255) NOT NULL,
  `bemerkung` text NOT NULL,
  `geliefert` int(11) NOT NULL,
  `mengemanuellgeliefertaktiviert` int(11) NOT NULL,
  `manuellgeliefertbearbeiter` varchar(255) NOT NULL,
  `abgerechnet` int(1) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `abgeschlossen` int(1) DEFAULT NULL,
  `einheit` varchar(255) NOT NULL DEFAULT '',
  `zolltarifnummer` varchar(128) NOT NULL DEFAULT '0',
  `herkunftsland` varchar(128) NOT NULL DEFAULT '0',
  `artikelnummerkunde` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung_protokoll`
--

CREATE TABLE IF NOT EXISTS `bestellung_protokoll` (
`id` int(11) NOT NULL,
  `bestellung` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
`id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `chargenverwaltung`
--

CREATE TABLE IF NOT EXISTS `chargenverwaltung` (
`id` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `bestellung` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
`id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL DEFAULT '0',
  `user_to` int(11) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `gelesen` tinyint(1) NOT NULL DEFAULT '0',
  `zeitstempel` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datei`
--

CREATE TABLE IF NOT EXISTS `datei` (
`id` int(10) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `geloescht` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firma` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datei_stichwoerter`
--

CREATE TABLE IF NOT EXISTS `datei_stichwoerter` (
`id` int(11) NOT NULL,
  `datei` int(10) NOT NULL,
  `subjekt` varchar(255) NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datei_version`
--

CREATE TABLE IF NOT EXISTS `datei_version` (
`id` int(10) NOT NULL,
  `datei` int(10) NOT NULL,
  `ersteller` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `version` int(5) NOT NULL,
  `dateiname` varchar(255) NOT NULL,
  `bemerkung` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `device_jobs`
--

CREATE TABLE IF NOT EXISTS `device_jobs` (
`id` int(11) NOT NULL,
  `deviceidsource` varchar(64) DEFAULT '',
  `deviceiddest` varchar(64) DEFAULT '',
  `job` longtext NOT NULL,
  `zeitstempel` datetime DEFAULT NULL,
  `abgeschlossen` tinyint(1) NOT NULL DEFAULT '0',
  `art` varchar(64) DEFAULT '',
  `request_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dokumente`
--

CREATE TABLE IF NOT EXISTS `dokumente` (
`id` int(11) unsigned NOT NULL,
  `adresse_from` int(11) NOT NULL,
  `adresse_to` int(11) NOT NULL,
  `typ` varchar(24) NOT NULL,
  `von` varchar(512) NOT NULL,
  `firma` varchar(512) NOT NULL,
  `an` varchar(512) NOT NULL,
  `email_an` varchar(255) NOT NULL,
  `firma_an` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `plz` varchar(16) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `land` varchar(32) NOT NULL,
  `datum` date NOT NULL,
  `betreff` varchar(1023) NOT NULL,
  `content` text NOT NULL,
  `signatur` tinyint(1) NOT NULL,
  `send_as` varchar(24) NOT NULL,
  `email` varchar(255) NOT NULL,
  `printer` int(2) NOT NULL,
  `fax` tinyint(2) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `ansprechpartner` varchar(512) DEFAULT NULL,
  `email_cc` varchar(255) DEFAULT NULL,
  `email_bcc` varchar(255) DEFAULT NULL,
  `bearbeiter` varchar(128) DEFAULT NULL,
  `uhrzeit` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dokumente_send`
--

CREATE TABLE IF NOT EXISTS `dokumente_send` (
`id` int(11) NOT NULL,
  `dokument` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `adresse` int(11) NOT NULL,
  `ansprechpartner` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `parameter` int(11) NOT NULL,
  `art` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `geloescht` int(1) NOT NULL,
  `versendet` int(1) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dateiid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `drucker`
--

CREATE TABLE IF NOT EXISTS `drucker` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `befehl` varchar(255) NOT NULL,
  `aktiv` int(1) NOT NULL,
  `firma` int(1) NOT NULL,
  `tomail` varchar(255) NOT NULL DEFAULT '',
  `tomailtext` text NOT NULL,
  `tomailsubject` text NOT NULL,
  `adapterboxip` varchar(255) NOT NULL DEFAULT '',
  `adapterboxseriennummer` varchar(255) NOT NULL DEFAULT '',
  `adapterboxpasswort` varchar(255) NOT NULL DEFAULT '',
  `anbindung` varchar(255) NOT NULL DEFAULT '',
  `art` int(1) NOT NULL DEFAULT '0',
  `faxserver` int(1) NOT NULL DEFAULT '0',
  `format` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `drucker_spooler`
--

CREATE TABLE IF NOT EXISTS `drucker_spooler` (
`id` int(11) NOT NULL,
  `drucker` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(128) NOT NULL DEFAULT '',
  `content` longblob NOT NULL,
  `description` varchar(128) NOT NULL DEFAULT '',
  `anzahl` varchar(128) NOT NULL DEFAULT '',
  `befehl` varchar(128) NOT NULL DEFAULT '',
  `anbindung` varchar(128) NOT NULL DEFAULT '',
  `zeitstempel` datetime DEFAULT NULL,
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `einkaufspreise`
--

CREATE TABLE IF NOT EXISTS `einkaufspreise` (
`id` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `projekt` varchar(255) NOT NULL,
  `preis` decimal(10,4) NOT NULL,
  `waehrung` varchar(255) NOT NULL,
  `ab_menge` int(11) NOT NULL,
  `vpe` varchar(64) NOT NULL DEFAULT '1',
  `preis_anfrage_vom` date NOT NULL,
  `gueltig_bis` date NOT NULL,
  `lieferzeit_standard` int(11) NOT NULL,
  `lieferzeit_aktuell` int(11) NOT NULL,
  `lager_lieferant` int(11) NOT NULL,
  `datum_lagerlieferant` date NOT NULL,
  `bestellnummer` varchar(255) NOT NULL,
  `bezeichnunglieferant` varchar(255) NOT NULL,
  `sicherheitslager` int(11) NOT NULL,
  `bemerkung` text NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `standard` int(1) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  `apichange` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `etiketten`
--

CREATE TABLE IF NOT EXISTS `etiketten` (
`id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '',
  `xml` text NOT NULL,
  `bemerkung` text NOT NULL,
  `ausblenden` tinyint(1) NOT NULL DEFAULT '0',
  `verwendenals` varchar(64) NOT NULL DEFAULT '',
  `labelbreite` int(11) NOT NULL DEFAULT '50',
  `labelhoehe` int(11) NOT NULL DEFAULT '18',
  `labelabstand` int(11) NOT NULL DEFAULT '3',
  `labeloffsetx` int(11) NOT NULL DEFAULT '0',
  `labeloffsety` int(11) NOT NULL DEFAULT '6',
  `format` varchar(64) NOT NULL DEFAULT '',
  `manuell` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`id` int(11) NOT NULL,
  `beschreibung` varchar(255) NOT NULL,
  `kategorie` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_api`
--

CREATE TABLE IF NOT EXISTS `event_api` (
`id` int(11) NOT NULL,
  `cachetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `eventname` varchar(255) DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `retries` int(11) DEFAULT NULL,
  `kommentar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exportlink_sent`
--

CREATE TABLE IF NOT EXISTS `exportlink_sent` (
  `id` int(11) NOT NULL,
  `reg` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL,
  `objekt` int(11) NOT NULL,
  `mail` int(11) NOT NULL,
  `ident` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exportvorlage`
--

CREATE TABLE IF NOT EXISTS `exportvorlage` (
`id` int(11) NOT NULL,
  `bezeichnung` varchar(255) DEFAULT NULL,
  `ziel` varchar(255) DEFAULT NULL,
  `internebemerkung` text,
  `fields` text,
  `fields_where` text,
  `letzterexport` datetime DEFAULT NULL,
  `mitarbeiterletzterexport` varchar(255) DEFAULT NULL,
  `exporttrennzeichen` varchar(255) DEFAULT NULL,
  `exporterstezeilenummer` int(11) DEFAULT NULL,
  `exportdatenmaskierung` varchar(255) DEFAULT NULL,
  `exportzeichensatz` varchar(255) DEFAULT NULL,
  `filterdatum` tinyint(1) NOT NULL DEFAULT '0',
  `filterprojekt` tinyint(1) NOT NULL DEFAULT '0',
  `apifreigabe` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `firma`
--

CREATE TABLE IF NOT EXISTS `firma` (
`id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `standardprojekt` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `firmendaten`
--

CREATE TABLE IF NOT EXISTS `firmendaten` (
`id` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `absender` varchar(1024) NOT NULL,
  `sichtbar` int(1) NOT NULL DEFAULT '1',
  `barcode` int(1) NOT NULL DEFAULT '0',
  `schriftgroesse` int(1) NOT NULL DEFAULT '0',
  `betreffszeile` int(1) NOT NULL DEFAULT '0',
  `dokumententext` int(1) NOT NULL DEFAULT '0',
  `tabellenbeschriftung` int(1) NOT NULL DEFAULT '0',
  `tabelleninhalt` int(1) NOT NULL DEFAULT '0',
  `zeilenuntertext` int(1) NOT NULL DEFAULT '0',
  `freitext` int(1) NOT NULL DEFAULT '0',
  `infobox` int(1) NOT NULL DEFAULT '0',
  `spaltenbreite` int(1) NOT NULL DEFAULT '0',
  `footer_0_0` varchar(64) NOT NULL,
  `footer_0_1` varchar(64) NOT NULL,
  `footer_0_2` varchar(64) NOT NULL,
  `footer_0_3` varchar(64) NOT NULL,
  `footer_0_4` varchar(64) NOT NULL,
  `footer_0_5` varchar(64) NOT NULL,
  `footer_1_0` varchar(64) NOT NULL,
  `footer_1_1` varchar(64) NOT NULL,
  `footer_1_2` varchar(64) NOT NULL,
  `footer_1_3` varchar(64) NOT NULL,
  `footer_1_4` varchar(64) NOT NULL,
  `footer_1_5` varchar(64) NOT NULL,
  `footer_2_0` varchar(64) NOT NULL,
  `footer_2_1` varchar(64) NOT NULL,
  `footer_2_2` varchar(64) NOT NULL,
  `footer_2_3` varchar(64) NOT NULL,
  `footer_2_4` varchar(64) NOT NULL,
  `footer_2_5` varchar(64) NOT NULL,
  `footer_3_0` varchar(64) NOT NULL,
  `footer_3_1` varchar(64) NOT NULL,
  `footer_3_2` varchar(64) NOT NULL,
  `footer_3_3` varchar(64) NOT NULL,
  `footer_3_4` varchar(64) NOT NULL,
  `footer_3_5` varchar(64) NOT NULL,
  `footersichtbar` int(1) NOT NULL DEFAULT '0',
  `hintergrund` varchar(64) NOT NULL,
  `logo` longblob NOT NULL,
  `logo_type` varchar(64) NOT NULL,
  `briefpapier` longblob NOT NULL,
  `briefpapier_type` varchar(64) NOT NULL,
  `benutzername` varchar(64) NOT NULL,
  `passwort` varchar(64) NOT NULL,
  `host` varchar(64) NOT NULL,
  `port` varchar(64) NOT NULL,
  `mailssl` int(1) NOT NULL DEFAULT '0',
  `signatur` text NOT NULL,
  `email` varchar(64) NOT NULL,
  `absendername` varchar(64) NOT NULL,
  `bcc1` varchar(64) NOT NULL,
  `bcc2` varchar(64) NOT NULL,
  `firmenfarbe` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `strasse` varchar(64) NOT NULL,
  `plz` varchar(64) NOT NULL,
  `ort` varchar(64) NOT NULL,
  `steuernummer` varchar(64) NOT NULL,
  `startseite_wiki` varchar(64) NOT NULL,
  `datum` datetime NOT NULL,
  `projekt` int(11) DEFAULT NULL,
  `brieftext` varchar(64) DEFAULT NULL,
  `next_angebot` varchar(64) NOT NULL,
  `next_auftrag` varchar(64) NOT NULL,
  `next_gutschrift` varchar(64) NOT NULL,
  `next_lieferschein` varchar(64) NOT NULL,
  `next_bestellung` varchar(64) NOT NULL,
  `next_rechnung` varchar(64) NOT NULL,
  `next_kundennummer` varchar(64) NOT NULL,
  `next_lieferantennummer` varchar(64) NOT NULL,
  `next_mitarbeiternummer` varchar(64) NOT NULL,
  `next_waren` varchar(64) NOT NULL,
  `next_sonstiges` varchar(64) NOT NULL,
  `next_produktion` varchar(64) NOT NULL,
  `breite_position` int(11) NOT NULL DEFAULT '10',
  `breite_menge` int(11) NOT NULL DEFAULT '10',
  `breite_nummer` int(11) NOT NULL DEFAULT '20',
  `breite_einheit` int(11) NOT NULL DEFAULT '15',
  `skonto_ueberweisung_ueberziehen` int(11) NOT NULL DEFAULT '0',
  `steuersatz_normal` decimal(10,2) NOT NULL DEFAULT '19.00',
  `steuersatz_zwischen` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_ermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_starkermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_dienstleistung` decimal(10,2) NOT NULL DEFAULT '7.00',
  `kleinunternehmer` int(1) NOT NULL DEFAULT '0',
  `mahnwesenmitkontoabgleich` int(1) NOT NULL DEFAULT '1',
  `porto_berechnen` int(1) NOT NULL DEFAULT '0',
  `immernettorechnungen` int(1) NOT NULL DEFAULT '0',
  `schnellanlegen` int(1) NOT NULL DEFAULT '0',
  `bestellvorschlaggroessernull` int(1) NOT NULL DEFAULT '0',
  `versand_gelesen` int(1) NOT NULL DEFAULT '0',
  `versandart` varchar(64) NOT NULL DEFAULT '',
  `zahlungsweise` varchar(64) NOT NULL DEFAULT '',
  `zahlung_lastschrift_konditionen` int(1) NOT NULL DEFAULT '0',
  `breite_artikelbeschreibung` tinyint(1) NOT NULL DEFAULT '0',
  `devicekey` varchar(64) NOT NULL DEFAULT '',
  `deviceserials` text NOT NULL,
  `deviceenable` tinyint(1) NOT NULL DEFAULT '0',
  `etikettendrucker_wareneingang` int(11) NOT NULL DEFAULT '0',
  `waehrung` varchar(64) NOT NULL DEFAULT 'EUR',
  `footer_breite1` int(11) NOT NULL DEFAULT '50',
  `footer_breite2` int(11) NOT NULL DEFAULT '35',
  `footer_breite3` int(11) NOT NULL DEFAULT '60',
  `footer_breite4` int(11) NOT NULL DEFAULT '40',
  `boxausrichtung` varchar(64) NOT NULL DEFAULT 'R',
  `lizenz` text NOT NULL,
  `schluessel` text NOT NULL,
  `branch` varchar(64) NOT NULL DEFAULT '',
  `version` varchar(64) NOT NULL DEFAULT '',
  `standard_datensaetze_datatables` int(11) NOT NULL DEFAULT '10',
  `auftrag_bezeichnung_vertrieb` varchar(64) NOT NULL DEFAULT 'Vertrieb',
  `auftrag_bezeichnung_bearbeiter` varchar(64) NOT NULL DEFAULT 'Bearbeiter',
  `auftrag_bezeichnung_bestellnummer` varchar(64) NOT NULL DEFAULT 'Ihre Bestellnummer',
  `bezeichnungkundennummer` varchar(64) NOT NULL DEFAULT 'Kundennummer',
  `bezeichnungstornorechnung` varchar(64) NOT NULL DEFAULT 'Stornorechnung',
  `bestellungohnepreis` tinyint(1) NOT NULL DEFAULT '0',
  `mysql55` tinyint(1) NOT NULL DEFAULT '1',
  `rechnung_gutschrift_ansprechpartner` int(1) NOT NULL DEFAULT '1',
  `api_initkey` varchar(1024) NOT NULL DEFAULT '',
  `api_remotedomain` varchar(1024) NOT NULL DEFAULT '',
  `api_eventurl` varchar(1024) NOT NULL DEFAULT '',
  `api_enable` int(1) NOT NULL DEFAULT '0',
  `api_cleanutf8` tinyint(1) NOT NULL DEFAULT '1',
  `api_importwarteschlange` int(1) NOT NULL DEFAULT '0',
  `api_importwarteschlange_name` varchar(64) NOT NULL DEFAULT '',
  `wareneingang_zwischenlager` int(1) NOT NULL DEFAULT '1',
  `modul_mlm` int(1) NOT NULL DEFAULT '0',
  `modul_verband` int(1) NOT NULL DEFAULT '0',
  `modul_mhd` int(1) NOT NULL DEFAULT '0',
  `mhd_warnung_tage` int(11) NOT NULL DEFAULT '3',
  `mlm_mindestbetrag` decimal(10,2) NOT NULL DEFAULT '50.00',
  `mlm_anzahlmonate` int(11) NOT NULL DEFAULT '11',
  `mlm_letzter_tag` date DEFAULT NULL,
  `mlm_erster_tag` date DEFAULT NULL,
  `mlm_letzte_berechnung` datetime DEFAULT NULL,
  `mlm_01` decimal(10,2) NOT NULL DEFAULT '15.00',
  `mlm_02` decimal(10,2) NOT NULL DEFAULT '20.00',
  `mlm_03` decimal(10,2) NOT NULL DEFAULT '28.00',
  `mlm_04` decimal(10,2) NOT NULL DEFAULT '32.00',
  `mlm_05` decimal(10,2) NOT NULL DEFAULT '36.00',
  `mlm_06` decimal(10,2) NOT NULL DEFAULT '40.00',
  `mlm_07` decimal(10,2) NOT NULL DEFAULT '44.00',
  `mlm_08` decimal(10,2) NOT NULL DEFAULT '44.00',
  `mlm_09` decimal(10,2) NOT NULL DEFAULT '44.00',
  `mlm_10` decimal(10,2) NOT NULL DEFAULT '44.00',
  `mlm_11` decimal(10,2) NOT NULL DEFAULT '50.00',
  `mlm_12` decimal(10,2) NOT NULL DEFAULT '54.00',
  `mlm_13` decimal(10,2) NOT NULL DEFAULT '45.00',
  `mlm_14` decimal(10,2) NOT NULL DEFAULT '48.00',
  `mlm_15` decimal(10,2) NOT NULL DEFAULT '60.00',
  `mlm_01_punkte` int(11) NOT NULL DEFAULT '2999',
  `mlm_02_punkte` int(11) NOT NULL DEFAULT '3000',
  `mlm_03_punkte` int(11) NOT NULL DEFAULT '5000',
  `mlm_04_punkte` int(11) NOT NULL DEFAULT '10000',
  `mlm_05_punkte` int(11) NOT NULL DEFAULT '15000',
  `mlm_06_punkte` int(11) NOT NULL DEFAULT '25000',
  `mlm_07_punkte` int(11) NOT NULL DEFAULT '50000',
  `mlm_08_punkte` int(11) NOT NULL DEFAULT '100000',
  `mlm_09_punkte` int(11) NOT NULL DEFAULT '150000',
  `mlm_10_punkte` int(11) NOT NULL DEFAULT '200000',
  `mlm_11_punkte` int(11) NOT NULL DEFAULT '250000',
  `mlm_12_punkte` int(11) NOT NULL DEFAULT '300000',
  `mlm_13_punkte` int(11) NOT NULL DEFAULT '350000',
  `mlm_14_punkte` int(11) NOT NULL DEFAULT '400000',
  `mlm_15_punkte` int(11) NOT NULL DEFAULT '450000',
  `mlm_01_mindestumsatz` int(11) NOT NULL DEFAULT '50',
  `mlm_02_mindestumsatz` int(11) NOT NULL DEFAULT '50',
  `mlm_03_mindestumsatz` int(11) NOT NULL DEFAULT '50',
  `mlm_04_mindestumsatz` int(11) NOT NULL DEFAULT '50',
  `mlm_05_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_06_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_07_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_08_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_09_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_10_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_11_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_12_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_13_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_14_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `mlm_15_mindestumsatz` int(11) NOT NULL DEFAULT '100',
  `standardaufloesung` int(11) NOT NULL DEFAULT '0',
  `standardversanddrucker` int(11) NOT NULL DEFAULT '0',
  `standardetikettendrucker` int(11) NOT NULL DEFAULT '0',
  `externereinkauf` int(1) DEFAULT NULL,
  `schriftart` varchar(64) DEFAULT NULL,
  `knickfalz` int(1) DEFAULT NULL,
  `artikeleinheit` int(1) DEFAULT NULL,
  `artikeleinheit_standard` varchar(64) DEFAULT NULL,
  `abstand_name_beschreibung` int(11) NOT NULL DEFAULT '4',
  `abstand_boxrechtsoben_lr` int(11) NOT NULL DEFAULT '0',
  `zahlungszieltage` int(11) NOT NULL DEFAULT '14',
  `zahlungszielskonto` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlung_rechnung` int(1) NOT NULL DEFAULT '1',
  `zahlung_vorkasse` int(1) NOT NULL DEFAULT '1',
  `zahlung_nachnahme` int(1) NOT NULL DEFAULT '1',
  `zahlung_kreditkarte` int(1) NOT NULL DEFAULT '1',
  `zahlung_paypal` int(1) NOT NULL DEFAULT '1',
  `zahlung_bar` int(1) NOT NULL DEFAULT '1',
  `zahlung_lastschrift` int(1) NOT NULL DEFAULT '0',
  `zahlung_amazon` int(1) NOT NULL DEFAULT '0',
  `zahlung_ratenzahlung` int(1) NOT NULL DEFAULT '1',
  `zahlung_rechnung_sofort_de` text NOT NULL,
  `zahlung_rechnung_de` text NOT NULL,
  `zahlung_vorkasse_de` text NOT NULL,
  `zahlung_lastschrift_de` text NOT NULL,
  `zahlung_nachnahme_de` text NOT NULL,
  `zahlung_bar_de` text NOT NULL,
  `zahlung_paypal_de` text NOT NULL,
  `zahlung_amazon_de` text NOT NULL,
  `zahlung_kreditkarte_de` text NOT NULL,
  `zahlung_ratenzahlung_de` text NOT NULL,
  `briefpapier2` longblob,
  `briefpapier2vorhanden` int(1) DEFAULT NULL,
  `artikel_suche_kurztext` int(1) DEFAULT NULL,
  `adresse_freitext1_suche` int(1) NOT NULL DEFAULT '0',
  `iconset_dunkel` tinyint(1) NOT NULL DEFAULT '0',
  `warnung_doppelte_nummern` int(1) NOT NULL DEFAULT '1',
  `next_arbeitsnachweis` varchar(64) DEFAULT NULL,
  `next_reisekosten` varchar(64) DEFAULT NULL,
  `next_anfrage` varchar(64) DEFAULT NULL,
  `next_artikelnummer` varchar(64) NOT NULL DEFAULT '',
  `seite_von_ausrichtung` varchar(64) DEFAULT NULL,
  `seite_von_sichtbar` int(1) DEFAULT NULL,
  `parameterundfreifelder` int(1) DEFAULT NULL,
  `freifeld1` text NOT NULL,
  `freifeld2` text NOT NULL,
  `freifeld3` text NOT NULL,
  `freifeld4` text NOT NULL,
  `freifeld5` text NOT NULL,
  `freifeld6` text NOT NULL,
  `firmenfarbehell` text NOT NULL,
  `firmenfarbedunkel` text NOT NULL,
  `firmenfarbeganzdunkel` text NOT NULL,
  `navigationfarbe` text NOT NULL,
  `navigationfarbeschrift` text NOT NULL,
  `unternavigationfarbe` text NOT NULL,
  `unternavigationfarbeschrift` text NOT NULL,
  `firmenlogo` longblob,
  `firmenlogotype` varchar(64) DEFAULT NULL,
  `firmenlogoaktiv` int(1) DEFAULT NULL,
  `projektnummerimdokument` int(1) DEFAULT NULL,
  `mailanstellesmtp` int(1) DEFAULT NULL,
  `herstellernummerimdokument` int(1) DEFAULT NULL,
  `standardmarge` int(11) DEFAULT NULL,
  `steuer_erloese_inland_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_innergemeinschaftlich` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_innergemeinschaftlich` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_eunormal` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_eunormal` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_export` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_import` varchar(10) NOT NULL DEFAULT '',
  `steuer_anpassung_kundennummer` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_1` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_1_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_1_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_1_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_2` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_2_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_2_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_2_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_3` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_3_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_3_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_3_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_4` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_4_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_4_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_4_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_5` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_5_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_5_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_5_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_6` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_6_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_6_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_6_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_7` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_7_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_7_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_7_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_8` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_8_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_8_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_8_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_9` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_9_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_9_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_9_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_10` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_10_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_10_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_10_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_11` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_11_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_11_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_11_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_12` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_12_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_12_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_12_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_13` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_13_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_13_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_13_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_14` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_14_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_14_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_14_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_15` varchar(30) NOT NULL DEFAULT '',
  `steuer_art_15_normal` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_15_ermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_art_15_steuerfrei` varchar(10) NOT NULL DEFAULT '',
  `rechnung_header` text,
  `lieferschein_header` text,
  `angebot_header` text,
  `auftrag_header` text,
  `gutschrift_header` text,
  `bestellung_header` text,
  `arbeitsnachweis_header` text,
  `provisionsgutschrift_header` text,
  `rechnung_footer` text,
  `lieferschein_footer` text,
  `angebot_footer` text,
  `auftrag_footer` text,
  `gutschrift_footer` text,
  `bestellung_footer` text,
  `arbeitsnachweis_footer` text,
  `provisionsgutschrift_footer` text,
  `rechnung_ohnebriefpapier` int(1) DEFAULT NULL,
  `lieferschein_ohnebriefpapier` int(1) DEFAULT NULL,
  `angebot_ohnebriefpapier` int(1) DEFAULT NULL,
  `auftrag_ohnebriefpapier` int(1) DEFAULT NULL,
  `gutschrift_ohnebriefpapier` int(1) DEFAULT NULL,
  `bestellung_ohnebriefpapier` int(1) DEFAULT NULL,
  `arbeitsnachweis_ohnebriefpapier` int(1) DEFAULT NULL,
  `eu_lieferung_vermerk` text NOT NULL,
  `export_lieferung_vermerk` text NOT NULL,
  `abstand_adresszeileoben` int(11) DEFAULT NULL,
  `abstand_boxrechtsoben` int(11) DEFAULT NULL,
  `abstand_betreffzeileoben` int(11) DEFAULT NULL,
  `abstand_artikeltabelleoben` int(11) DEFAULT NULL,
  `wareneingang_kamera_waage` int(1) DEFAULT NULL,
  `layout_iconbar` int(1) DEFAULT NULL,
  `briefhtml` tinyint(1) NOT NULL DEFAULT '0',
  `seite_von_ausrichtung_relativ` tinyint(1) NOT NULL DEFAULT '0',
  `absenderunterstrichen` tinyint(1) NOT NULL DEFAULT '1',
  `schriftgroesseabsender` int(11) NOT NULL DEFAULT '7',
  `datatables_export_button_flash` tinyint(1) NOT NULL DEFAULT '1',
  `land` varchar(2) NOT NULL DEFAULT 'DE',
  `modul_finanzbuchhaltung` tinyint(1) NOT NULL DEFAULT '0',
  `testmailempfaenger` varchar(128) NOT NULL DEFAULT '',
  `immerbruttorechnungen` int(1) NOT NULL DEFAULT '0',
  `sepaglaeubigerid` varchar(64) NOT NULL DEFAULT '',
  `viernachkommastellen_belege` tinyint(1) NOT NULL DEFAULT '0',
  `bezeichnungangebotersatz` varchar(64) NOT NULL DEFAULT '',
  `stornorechnung_standard` int(1) NOT NULL DEFAULT '0',
  `angebotersatz_standard` int(1) NOT NULL DEFAULT '0',
  `modul_verein` int(1) NOT NULL DEFAULT '0',
  `abstand_gesamtsumme_lr` int(11) NOT NULL DEFAULT '100',
  `zahlung_amazon_bestellung` int(1) NOT NULL DEFAULT '0',
  `zahlung_billsafe` int(1) NOT NULL DEFAULT '0',
  `zahlung_sofortueberweisung` int(1) NOT NULL DEFAULT '0',
  `zahlung_secupay` int(1) NOT NULL DEFAULT '0',
  `zahlung_amazon_bestellung_de` text NOT NULL,
  `zahlung_billsafe_de` text NOT NULL,
  `zahlung_sofortueberweisung_de` text NOT NULL,
  `zahlung_secupay_de` text NOT NULL,
  `artikel_bilder_uebersicht` tinyint(1) NOT NULL DEFAULT '0',
  `adressefreifeld1` text NOT NULL,
  `adressefreifeld2` text NOT NULL,
  `adressefreifeld3` text NOT NULL,
  `adressefreifeld4` text NOT NULL,
  `adressefreifeld5` text NOT NULL,
  `adressefreifeld6` text NOT NULL,
  `adressefreifeld7` text NOT NULL,
  `adressefreifeld8` text NOT NULL,
  `adressefreifeld9` text NOT NULL,
  `adressefreifeld10` text NOT NULL,
  `steuer_erloese_inland_nichtsteuerbar` varchar(10) NOT NULL DEFAULT '',
  `steuer_erloese_inland_euermaessigt` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_nichtsteuerbar` varchar(10) NOT NULL DEFAULT '',
  `steuer_aufwendung_inland_euermaessigt` varchar(10) NOT NULL DEFAULT '',
  `abstand_seitenrandlinks` int(11) NOT NULL DEFAULT '15',
  `abstand_adresszeilelinks` int(11) NOT NULL DEFAULT '15',
  `wareneingang_gross` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `geschaeftsbrief_vorlagen`
--

CREATE TABLE IF NOT EXISTS `geschaeftsbrief_vorlagen` (
`id` int(11) NOT NULL,
  `sprache` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `subjekt` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `firma` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gpsstechuhr`
--

CREATE TABLE IF NOT EXISTS `gpsstechuhr` (
`id` int(11) NOT NULL,
  `adresse` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `koordinaten` varchar(512) DEFAULT NULL,
  `zeit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gruppen`
--

CREATE TABLE IF NOT EXISTS `gruppen` (
`id` int(11) NOT NULL,
  `name` varchar(512) DEFAULT NULL,
  `art` varchar(512) DEFAULT NULL,
  `kennziffer` varchar(255) DEFAULT NULL,
  `internebemerkung` text,
  `grundrabatt` decimal(10,2) DEFAULT NULL,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `sonderrabatt_skonto` decimal(10,2) DEFAULT NULL,
  `provision` decimal(10,2) DEFAULT NULL,
  `kundennummer` varchar(255) DEFAULT NULL,
  `partnerid` varchar(255) DEFAULT NULL,
  `dta_aktiv` tinyint(1) NOT NULL DEFAULT '0',
  `dta_periode` tinyint(2) NOT NULL DEFAULT '0',
  `dta_dateiname` varchar(255) NOT NULL DEFAULT '',
  `dta_mail` varchar(255) NOT NULL DEFAULT '',
  `dta_mail_betreff` varchar(255) NOT NULL DEFAULT '',
  `dta_mail_text` text NOT NULL,
  `dtavariablen` text NOT NULL,
  `dta_variante` int(11) NOT NULL DEFAULT '0',
  `bonus1` decimal(10,2) DEFAULT NULL,
  `bonus1_ab` decimal(10,2) DEFAULT NULL,
  `bonus2` decimal(10,2) DEFAULT NULL,
  `bonus2_ab` decimal(10,2) DEFAULT NULL,
  `bonus3` decimal(10,2) DEFAULT NULL,
  `bonus3_ab` decimal(10,2) DEFAULT NULL,
  `bonus4` decimal(10,2) DEFAULT NULL,
  `bonus4_ab` decimal(10,2) DEFAULT NULL,
  `bonus5` decimal(10,2) DEFAULT NULL,
  `bonus5_ab` decimal(10,2) DEFAULT NULL,
  `bonus6` decimal(10,2) DEFAULT NULL,
  `bonus6_ab` decimal(10,2) DEFAULT NULL,
  `bonus7` decimal(10,2) DEFAULT NULL,
  `bonus7_ab` decimal(10,2) DEFAULT NULL,
  `bonus8` decimal(10,2) DEFAULT NULL,
  `bonus8_ab` decimal(10,2) DEFAULT NULL,
  `bonus9` decimal(10,2) DEFAULT NULL,
  `bonus9_ab` decimal(10,2) DEFAULT NULL,
  `bonus10` decimal(10,2) DEFAULT NULL,
  `bonus10_ab` decimal(10,2) DEFAULT NULL,
  `zahlungszieltage` int(11) NOT NULL DEFAULT '14',
  `zahlungszielskonto` decimal(10,2) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `portoartikel` int(11) DEFAULT NULL,
  `portofreiab` decimal(10,2) NOT NULL DEFAULT '0.00',
  `erweiterteoptionen` int(1) DEFAULT NULL,
  `zentralerechnung` int(1) DEFAULT NULL,
  `zentralregulierung` int(1) DEFAULT NULL,
  `gruppe` int(1) DEFAULT NULL,
  `preisgruppe` int(1) DEFAULT NULL,
  `verbandsgruppe` int(1) DEFAULT NULL,
  `rechnung_name` varchar(255) DEFAULT NULL,
  `rechnung_strasse` varchar(255) DEFAULT NULL,
  `rechnung_ort` varchar(255) DEFAULT NULL,
  `rechnung_plz` varchar(255) DEFAULT NULL,
  `rechnung_abteilung` varchar(255) DEFAULT NULL,
  `rechnung_land` varchar(255) DEFAULT NULL,
  `rechnung_email` varchar(255) DEFAULT NULL,
  `rechnung_periode` int(11) DEFAULT NULL,
  `rechnung_anzahlpapier` int(11) DEFAULT NULL,
  `rechnung_permail` int(1) DEFAULT NULL,
  `webid` varchar(1024) NOT NULL,
  `portofrei_aktiv` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gutschrift`
--

CREATE TABLE IF NOT EXISTS `gutschrift` (
`id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `projekt` varchar(222) NOT NULL,
  `anlegeart` varchar(255) NOT NULL,
  `belegnr` varchar(255) NOT NULL,
  `rechnung` int(11) NOT NULL,
  `rechnungid` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `freitext` text NOT NULL,
  `internebemerkung` text NOT NULL,
  `status` varchar(64) NOT NULL,
  `adresse` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `ustbrief` int(11) NOT NULL,
  `ustbrief_eingang` int(11) NOT NULL,
  `ustbrief_eingang_am` date NOT NULL,
  `ust_befreit` int(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `lieferschein` int(11) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `lieferdatum` date NOT NULL,
  `buchhaltung` varchar(255) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungsstatus` varchar(255) NOT NULL,
  `ist` decimal(10,2) NOT NULL,
  `soll` decimal(10,2) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlungszielskonto` decimal(10,2) NOT NULL,
  `gesamtsumme` decimal(10,4) NOT NULL,
  `bank_inhaber` varchar(255) NOT NULL,
  `bank_institut` varchar(255) NOT NULL,
  `bank_blz` int(11) NOT NULL,
  `bank_konto` int(11) NOT NULL,
  `kreditkarte_typ` varchar(255) NOT NULL,
  `kreditkarte_inhaber` varchar(255) NOT NULL,
  `kreditkarte_nummer` varchar(255) NOT NULL,
  `kreditkarte_pruefnummer` varchar(255) NOT NULL,
  `kreditkarte_monat` int(11) NOT NULL,
  `kreditkarte_jahr` int(11) NOT NULL,
  `paypalaccount` varchar(255) NOT NULL,
  `firma` int(11) NOT NULL,
  `versendet` int(1) NOT NULL,
  `versendet_am` datetime NOT NULL,
  `versendet_per` varchar(255) NOT NULL,
  `versendet_durch` varchar(255) NOT NULL,
  `inbearbeitung` int(1) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dta_datei_verband` int(11) NOT NULL DEFAULT '0',
  `manuell_vorabbezahlt` date DEFAULT NULL,
  `manuell_vorabbezahlt_hinweis` varchar(128) NOT NULL DEFAULT '',
  `nicht_umsatzmindernd` tinyint(1) NOT NULL DEFAULT '0',
  `dta_datei` int(11) NOT NULL DEFAULT '0',
  `deckungsbeitragcalc` tinyint(1) NOT NULL DEFAULT '0',
  `deckungsbeitrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `erloes_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `umsatz_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `vertriebid` int(11) DEFAULT NULL,
  `aktion` varchar(64) NOT NULL DEFAULT '',
  `vertrieb` varchar(255) NOT NULL DEFAULT '',
  `provision` decimal(10,2) DEFAULT NULL,
  `provision_summe` decimal(10,2) DEFAULT NULL,
  `gruppe` int(11) NOT NULL DEFAULT '0',
  `ihrebestellnummer` varchar(255) DEFAULT NULL,
  `anschreiben` varchar(255) DEFAULT NULL,
  `usereditid` int(11) DEFAULT NULL,
  `useredittimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `realrabatt` decimal(10,2) DEFAULT NULL,
  `rabatt` decimal(10,2) DEFAULT NULL,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `steuersatz_normal` decimal(10,2) NOT NULL DEFAULT '19.00',
  `steuersatz_zwischen` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_ermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_starkermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_dienstleistung` decimal(10,2) NOT NULL DEFAULT '7.00',
  `waehrung` varchar(255) NOT NULL DEFAULT 'EUR',
  `keinsteuersatz` int(1) DEFAULT NULL,
  `stornorechnung` int(1) DEFAULT NULL,
  `schreibschutz` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviert` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviertversion` int(11) NOT NULL DEFAULT '0',
  `typ` varchar(255) NOT NULL DEFAULT 'firma',
  `ohne_briefpapier` int(1) DEFAULT NULL,
  `lieferid` int(11) NOT NULL DEFAULT '0',
  `ansprechpartnerid` int(11) NOT NULL DEFAULT '0',
  `projektfiliale` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gutschrift_position`
--

CREATE TABLE IF NOT EXISTS `gutschrift_position` (
`id` int(10) NOT NULL,
  `gutschrift` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `internerkommentar` text NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `menge` float NOT NULL,
  `preis` decimal(10,4) NOT NULL,
  `waehrung` varchar(255) NOT NULL,
  `lieferdatum` date NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `status` varchar(64) NOT NULL,
  `umsatzsteuer` varchar(255) NOT NULL,
  `bemerkung` text NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `explodiert_parent_artikel` int(11) NOT NULL DEFAULT '0',
  `keinrabatterlaubt` int(1) DEFAULT NULL,
  `grundrabatt` decimal(10,2) DEFAULT NULL,
  `rabattsync` int(1) DEFAULT NULL,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `einheit` varchar(255) NOT NULL DEFAULT '',
  `rabatt` decimal(10,2) NOT NULL,
  `zolltarifnummer` varchar(128) NOT NULL DEFAULT '0',
  `herkunftsland` varchar(128) NOT NULL DEFAULT '0',
  `artikelnummerkunde` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gutschrift_protokoll`
--

CREATE TABLE IF NOT EXISTS `gutschrift_protokoll` (
`id` int(11) NOT NULL,
  `gutschrift` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `importvorlage`
--

CREATE TABLE IF NOT EXISTS `importvorlage` (
`id` int(11) NOT NULL,
  `bezeichnung` varchar(255) DEFAULT NULL,
  `ziel` varchar(255) DEFAULT NULL,
  `internebemerkung` text,
  `fields` text,
  `letzterimport` datetime DEFAULT NULL,
  `mitarbeiterletzterimport` varchar(255) DEFAULT NULL,
  `importtrennzeichen` varchar(255) DEFAULT NULL,
  `importerstezeilenummer` int(11) DEFAULT NULL,
  `importdatenmaskierung` varchar(255) DEFAULT NULL,
  `importzeichensatz` varchar(255) DEFAULT NULL,
  `utf8decode` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `importvorlage_log`
--

CREATE TABLE IF NOT EXISTS `importvorlage_log` (
`id` int(11) NOT NULL,
  `importvorlage` int(11) DEFAULT NULL,
  `zeitstempel` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) DEFAULT NULL,
  `tabelle` varchar(255) DEFAULT NULL,
  `datensatz` int(11) DEFAULT NULL,
  `ersterdatensatz` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `inhalt`
--

CREATE TABLE IF NOT EXISTS `inhalt` (
`id` int(11) NOT NULL,
  `sprache` varchar(255) NOT NULL,
  `inhalt` varchar(255) NOT NULL,
  `kurztext` text NOT NULL,
  `html` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(512) NOT NULL,
  `keywords` varchar(512) NOT NULL,
  `inhaltstyp` varchar(255) NOT NULL,
  `sichtbarbis` datetime NOT NULL,
  `datum` date NOT NULL,
  `aktiv` int(1) NOT NULL,
  `shop` int(11) NOT NULL,
  `template` varchar(255) DEFAULT NULL,
  `finalparse` varchar(255) NOT NULL,
  `navigation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `interne_events`
--

CREATE TABLE IF NOT EXISTS `interne_events` (
`id` int(11) NOT NULL,
  `meldung` text NOT NULL,
  `userid` int(11) NOT NULL DEFAULT '0',
  `sound` int(11) NOT NULL DEFAULT '0',
  `type` varchar(64) NOT NULL DEFAULT '',
  `zeitstempel` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jqcalendar`
--

CREATE TABLE IF NOT EXISTS `jqcalendar` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `ort` varchar(255) NOT NULL,
  `von` datetime NOT NULL,
  `bis` datetime NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kalender`
--

CREATE TABLE IF NOT EXISTS `kalender` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'default',
  `farbe` varchar(15) NOT NULL DEFAULT '3300ff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kalender_event`
--

CREATE TABLE IF NOT EXISTS `kalender_event` (
`id` int(11) NOT NULL,
  `kalender` int(11) NOT NULL DEFAULT '0',
  `bezeichnung` varchar(255) NOT NULL,
  `beschreibung` longtext,
  `von` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bis` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `allDay` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(7) NOT NULL DEFAULT '#6F93DB',
  `public` int(1) NOT NULL DEFAULT '0',
  `ort` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kalender_temp`
--

CREATE TABLE IF NOT EXISTS `kalender_temp` (
  `tId` int(11) NOT NULL,
  `eId` int(11) NOT NULL,
  `szelle` varchar(15) NOT NULL,
  `nanzbelegt` int(11) NOT NULL,
  `ndatum` varchar(8) NOT NULL,
  `nbelegt` float NOT NULL,
  `nanzspalten` int(11) NOT NULL DEFAULT '0',
  `nposbelegt` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kalender_user`
--

CREATE TABLE IF NOT EXISTS `kalender_user` (
`id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `userid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `konfiguration`
--

CREATE TABLE IF NOT EXISTS `konfiguration` (
  `name` varchar(255) NOT NULL,
  `wert` text NOT NULL,
  `adresse` int(11) NOT NULL,
  `firma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kostenstelle`
--

CREATE TABLE IF NOT EXISTS `kostenstelle` (
`id` int(10) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `projekt` varchar(255) NOT NULL,
  `verantwortlicher` varchar(255) NOT NULL,
  `logdatei` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kostenstellen`
--

CREATE TABLE IF NOT EXISTS `kostenstellen` (
`id` int(11) NOT NULL,
  `nummer` varchar(20) DEFAULT NULL,
  `beschreibung` varchar(512) DEFAULT NULL,
  `internebemerkung` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kostenstelle_buchung`
--

CREATE TABLE IF NOT EXISTS `kostenstelle_buchung` (
`id` int(10) NOT NULL,
  `kostenstelle` int(10) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `datum` varchar(255) NOT NULL,
  `buchungstext` varchar(255) NOT NULL,
  `sonstiges` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kundevorlage`
--

CREATE TABLE IF NOT EXISTS `kundevorlage` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlungszielskonto` int(11) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager`
--

CREATE TABLE IF NOT EXISTS `lager` (
`id` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `manuell` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projekt` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lagermindestmengen`
--

CREATE TABLE IF NOT EXISTS `lagermindestmengen` (
`id` int(11) NOT NULL,
  `artikel` int(11) NOT NULL DEFAULT '0',
  `lager_platz` int(11) NOT NULL DEFAULT '0',
  `menge` int(11) NOT NULL DEFAULT '0',
  `datumvon` date DEFAULT NULL,
  `datumbis` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_bewegung`
--

CREATE TABLE IF NOT EXISTS `lager_bewegung` (
`id` int(11) NOT NULL,
  `lager_platz` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `eingang` int(1) NOT NULL,
  `zeit` datetime NOT NULL,
  `referenz` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `adresse` int(11) DEFAULT NULL,
  `bestand` int(11) NOT NULL DEFAULT '0',
  `permanenteinventur` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_charge`
--

CREATE TABLE IF NOT EXISTS `lager_charge` (
`id` int(11) NOT NULL,
  `charge` varchar(1024) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `artikel` int(11) DEFAULT NULL,
  `menge` int(11) NOT NULL,
  `lager_platz` int(11) DEFAULT NULL,
  `zwischenlagerid` int(11) DEFAULT NULL,
  `internebemerkung` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_differenzen`
--

CREATE TABLE IF NOT EXISTS `lager_differenzen` (
`id` int(11) NOT NULL,
  `artikel` int(11) DEFAULT NULL,
  `eingang` decimal(10,4) DEFAULT NULL,
  `ausgang` decimal(10,4) DEFAULT NULL,
  `berechnet` decimal(10,4) DEFAULT NULL,
  `bestand` decimal(10,4) DEFAULT NULL,
  `differenz` decimal(10,4) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `lager_platz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_mindesthaltbarkeitsdatum`
--

CREATE TABLE IF NOT EXISTS `lager_mindesthaltbarkeitsdatum` (
`id` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `mhddatum` date DEFAULT NULL,
  `artikel` int(11) DEFAULT NULL,
  `menge` int(11) NOT NULL,
  `lager_platz` int(11) DEFAULT NULL,
  `zwischenlagerid` int(11) DEFAULT NULL,
  `charge` varchar(1024) DEFAULT NULL,
  `internebemerkung` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_platz`
--

CREATE TABLE IF NOT EXISTS `lager_platz` (
`id` int(11) NOT NULL,
  `lager` int(11) NOT NULL,
  `kurzbezeichnung` varchar(255) NOT NULL,
  `bemerkung` text NOT NULL,
  `projekt` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `autolagersperre` int(1) NOT NULL DEFAULT '0',
  `verbrauchslager` int(1) NOT NULL DEFAULT '0',
  `sperrlager` int(1) NOT NULL DEFAULT '0',
  `laenge` decimal(10,2) NOT NULL DEFAULT '0.00',
  `breite` decimal(10,2) NOT NULL DEFAULT '0.00',
  `hoehe` decimal(10,2) NOT NULL DEFAULT '0.00',
  `poslager` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_platz_inhalt`
--

CREATE TABLE IF NOT EXISTS `lager_platz_inhalt` (
`id` int(11) NOT NULL,
  `lager_platz` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `bestellung` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `inventur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_reserviert`
--

CREATE TABLE IF NOT EXISTS `lager_reserviert` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `grund` varchar(255) NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `reserviertdatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `posid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferadressen`
--

CREATE TABLE IF NOT EXISTS `lieferadressen` (
`id` int(10) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `sprache` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sonstiges` text NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `steuer` varchar(255) NOT NULL,
  `adresse` varchar(10) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ansprechpartner` varchar(255) DEFAULT NULL,
  `standardlieferadresse` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferantvorlage`
--

CREATE TABLE IF NOT EXISTS `lieferantvorlage` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlungszielskonto` int(11) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferschein`
--

CREATE TABLE IF NOT EXISTS `lieferschein` (
`id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `projekt` varchar(222) NOT NULL,
  `lieferscheinart` varchar(255) NOT NULL,
  `belegnr` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `auftrag` varchar(255) NOT NULL,
  `auftragid` int(11) NOT NULL,
  `freitext` text NOT NULL,
  `status` varchar(64) NOT NULL,
  `adresse` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `ansprechpartner` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `versand` varchar(255) NOT NULL,
  `firma` int(11) NOT NULL,
  `versendet` int(1) NOT NULL,
  `versendet_am` datetime NOT NULL,
  `versendet_per` varchar(255) NOT NULL,
  `versendet_durch` varchar(255) NOT NULL,
  `inbearbeitung_user` int(1) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `vertriebid` int(11) DEFAULT NULL,
  `vertrieb` varchar(255) NOT NULL DEFAULT '',
  `ust_befreit` int(1) NOT NULL,
  `ihrebestellnummer` varchar(255) DEFAULT NULL,
  `anschreiben` varchar(255) DEFAULT NULL,
  `usereditid` int(11) DEFAULT NULL,
  `useredittimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lieferantenretoure` tinyint(1) NOT NULL DEFAULT '0',
  `lieferantenretoureinfo` text NOT NULL,
  `lieferant` int(11) NOT NULL DEFAULT '0',
  `schreibschutz` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviert` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviertversion` int(11) NOT NULL DEFAULT '0',
  `typ` varchar(255) NOT NULL DEFAULT 'firma',
  `internebemerkung` text,
  `ohne_briefpapier` int(1) DEFAULT NULL,
  `lieferid` int(11) NOT NULL DEFAULT '0',
  `ansprechpartnerid` int(11) NOT NULL DEFAULT '0',
  `projektfiliale` int(11) NOT NULL DEFAULT '0',
  `projektfiliale_eingelagert` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferschein_position`
--

CREATE TABLE IF NOT EXISTS `lieferschein_position` (
`id` int(10) NOT NULL,
  `lieferschein` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `internerkommentar` text NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `seriennummer` varchar(255) NOT NULL,
  `menge` float NOT NULL,
  `lieferdatum` date NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `status` varchar(64) NOT NULL,
  `bemerkung` text NOT NULL,
  `geliefert` float NOT NULL,
  `abgerechnet` int(1) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `explodiert_parent_artikel` int(11) NOT NULL DEFAULT '0',
  `einheit` varchar(255) NOT NULL DEFAULT '',
  `zolltarifnummer` varchar(128) NOT NULL DEFAULT '0',
  `herkunftsland` varchar(128) NOT NULL DEFAULT '0',
  `artikelnummerkunde` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferschein_protokoll`
--

CREATE TABLE IF NOT EXISTS `lieferschein_protokoll` (
`id` int(11) NOT NULL,
  `lieferschein` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `linkeditor`
--

CREATE TABLE IF NOT EXISTS `linkeditor` (
`id` int(4) NOT NULL,
  `rule` varchar(1024) NOT NULL,
  `replacewith` varchar(1024) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `logdatei`
--

CREATE TABLE IF NOT EXISTS `logdatei` (
`id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `befehl` varchar(255) NOT NULL,
  `statement` varchar(255) NOT NULL,
  `app` blob NOT NULL,
  `zeit` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `logfile`
--

CREATE TABLE IF NOT EXISTS `logfile` (
`id` int(11) NOT NULL,
  `meldung` text NOT NULL,
  `dump` text NOT NULL,
  `module` varchar(64) NOT NULL DEFAULT '',
  `action` varchar(64) NOT NULL DEFAULT '',
  `bearbeiter` varchar(64) NOT NULL DEFAULT '',
  `funktionsname` varchar(64) NOT NULL DEFAULT '',
  `datum` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `module_lock`
--

CREATE TABLE IF NOT EXISTS `module_lock` (
`id` int(11) NOT NULL,
  `module` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `userid` int(15) DEFAULT '0',
  `salt` varchar(255) DEFAULT '',
  `zeit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `newslettercache`
--

CREATE TABLE IF NOT EXISTS `newslettercache` (
  `checksum` text NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `newsletter_blacklist`
--

CREATE TABLE IF NOT EXISTS `newsletter_blacklist` (
`id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `objekt_protokoll`
--

CREATE TABLE IF NOT EXISTS `objekt_protokoll` (
`id` int(11) NOT NULL,
  `objekt` varchar(64) NOT NULL DEFAULT '',
  `objektid` int(11) NOT NULL DEFAULT '0',
  `action_long` varchar(128) NOT NULL DEFAULT '',
  `meldung` varchar(255) NOT NULL DEFAULT '0',
  `bearbeiter` varchar(128) NOT NULL DEFAULT '',
  `zeitstempel` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `offenevorgaenge`
--

CREATE TABLE IF NOT EXISTS `offenevorgaenge` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL,
  `beschriftung` text NOT NULL,
  `linkremove` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `paketannahme`
--

CREATE TABLE IF NOT EXISTS `paketannahme` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `verpackungszustand` int(11) NOT NULL,
  `bemerkung` text NOT NULL,
  `foto` int(11) NOT NULL,
  `gewicht` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `vorlage` varchar(255) NOT NULL,
  `vorlageid` varchar(255) NOT NULL,
  `zahlung` varchar(255) NOT NULL,
  `betrag` decimal(10,4) NOT NULL,
  `status` varchar(64) NOT NULL,
  `beipack_rechnung` int(1) NOT NULL,
  `beipack_lieferschein` int(1) NOT NULL,
  `beipack_anschreiben` int(1) NOT NULL,
  `beipack_gesamt` int(10) NOT NULL,
  `bearbeiter_distribution` varchar(255) NOT NULL,
  `postgrund` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `paketdistribution`
--

CREATE TABLE IF NOT EXISTS `paketdistribution` (
`id` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `paketannahme` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `etiketten` int(11) NOT NULL,
  `bemerkung` text NOT NULL,
  `bestellung_position` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pdfmirror_md5pool`
--

CREATE TABLE IF NOT EXISTS `pdfmirror_md5pool` (
`id` int(11) NOT NULL,
  `zeitstempel` datetime DEFAULT NULL,
  `checksum` varchar(128) NOT NULL DEFAULT '',
  `table_id` int(11) NOT NULL DEFAULT '0',
  `table_name` varchar(128) NOT NULL DEFAULT '',
  `bearbeiter` varchar(128) NOT NULL DEFAULT '',
  `erstesoriginal` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pinwand`
--

CREATE TABLE IF NOT EXISTS `pinwand` (
`id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL DEFAULT '',
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pinwand_user`
--

CREATE TABLE IF NOT EXISTS `pinwand_user` (
`id` int(11) NOT NULL,
  `pinwand` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projekt`
--

CREATE TABLE IF NOT EXISTS `projekt` (
`id` int(10) NOT NULL,
  `name` varchar(128) NOT NULL,
  `abkuerzung` varchar(64) NOT NULL,
  `verantwortlicher` text NOT NULL,
  `beschreibung` text NOT NULL,
  `sonstiges` text NOT NULL,
  `aktiv` varchar(255) NOT NULL,
  `farbe` varchar(255) NOT NULL,
  `autoversand` int(1) NOT NULL,
  `checkok` int(1) NOT NULL,
  `portocheck` int(1) NOT NULL,
  `automailrechnung` int(1) NOT NULL,
  `checkname` varchar(255) NOT NULL,
  `zahlungserinnerung` int(1) NOT NULL,
  `zahlungsmailbedinungen` varchar(255) NOT NULL,
  `folgebestaetigung` int(1) NOT NULL,
  `stornomail` int(1) NOT NULL,
  `kundenfreigabe_loeschen` int(1) NOT NULL,
  `autobestellung` int(1) NOT NULL,
  `speziallieferschein` int(1) NOT NULL,
  `lieferscheinbriefpapier` int(11) NOT NULL,
  `speziallieferscheinbeschriftung` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `logdatei` text NOT NULL,
  `steuersatz_normal` decimal(10,2) NOT NULL DEFAULT '19.00',
  `steuersatz_zwischen` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_ermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_starkermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_dienstleistung` decimal(10,2) NOT NULL DEFAULT '7.00',
  `waehrung` varchar(3) NOT NULL DEFAULT 'EUR',
  `eigenesteuer` int(1) NOT NULL DEFAULT '0',
  `druckerlogistikstufe1` int(11) NOT NULL DEFAULT '0',
  `druckerlogistikstufe2` int(11) NOT NULL DEFAULT '0',
  `selbstabholermail` tinyint(1) NOT NULL DEFAULT '0',
  `eanherstellerscan` tinyint(1) NOT NULL DEFAULT '0',
  `reservierung` int(1) DEFAULT NULL,
  `verkaufszahlendiagram` int(1) DEFAULT NULL,
  `oeffentlich` int(1) NOT NULL DEFAULT '0',
  `shopzwangsprojekt` int(1) NOT NULL DEFAULT '0',
  `kunde` int(11) DEFAULT NULL,
  `dpdkundennr` varchar(255) DEFAULT NULL,
  `dhlkundennr` varchar(255) DEFAULT NULL,
  `dhlformat` text,
  `dpdformat` text,
  `paketmarke_einzeldatei` int(1) DEFAULT NULL,
  `dpdpfad` varchar(255) DEFAULT NULL,
  `dhlpfad` varchar(255) DEFAULT NULL,
  `upspfad` varchar(255) NOT NULL DEFAULT '0',
  `dhlintodb` tinyint(1) NOT NULL DEFAULT '0',
  `intraship_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `intraship_drucker` int(11) NOT NULL DEFAULT '0',
  `intraship_testmode` tinyint(1) NOT NULL DEFAULT '0',
  `intraship_user` varchar(64) NOT NULL DEFAULT '',
  `intraship_signature` varchar(64) NOT NULL DEFAULT '',
  `intraship_ekp` varchar(64) NOT NULL DEFAULT '',
  `intraship_api_user` varchar(64) NOT NULL DEFAULT '',
  `intraship_api_password` varchar(64) NOT NULL DEFAULT '',
  `intraship_company_name` varchar(64) NOT NULL DEFAULT '',
  `intraship_street_name` varchar(64) NOT NULL DEFAULT '',
  `intraship_street_number` varchar(64) NOT NULL DEFAULT '',
  `intraship_zip` varchar(12) NOT NULL DEFAULT '',
  `intraship_country` varchar(64) NOT NULL DEFAULT 'germany',
  `intraship_city` varchar(64) NOT NULL DEFAULT '',
  `intraship_email` varchar(64) NOT NULL DEFAULT '',
  `intraship_phone` varchar(64) NOT NULL DEFAULT '',
  `intraship_internet` varchar(64) NOT NULL DEFAULT '',
  `intraship_contact_person` varchar(64) NOT NULL DEFAULT '',
  `intraship_account_owner` varchar(64) NOT NULL DEFAULT '',
  `intraship_account_number` varchar(64) NOT NULL DEFAULT '',
  `intraship_bank_code` varchar(64) NOT NULL DEFAULT '',
  `intraship_bank_name` varchar(64) NOT NULL DEFAULT '',
  `intraship_iban` varchar(64) NOT NULL DEFAULT '',
  `intraship_bic` varchar(64) NOT NULL DEFAULT '',
  `intraship_WeightInKG` int(11) NOT NULL DEFAULT '5',
  `intraship_LengthInCM` int(11) NOT NULL DEFAULT '50',
  `intraship_WidthInCM` int(11) NOT NULL DEFAULT '50',
  `intraship_HeightInCM` int(11) NOT NULL DEFAULT '50',
  `intraship_PackageType` varchar(8) NOT NULL DEFAULT 'PL',
  `abrechnungsart` varchar(255) DEFAULT NULL,
  `kommissionierverfahren` varchar(255) DEFAULT 'lieferschein',
  `wechselaufeinstufig` int(11) DEFAULT NULL,
  `projektuebergreifendkommisionieren` int(1) DEFAULT NULL,
  `absendeadresse` varchar(255) DEFAULT NULL,
  `absendename` varchar(255) DEFAULT NULL,
  `absendesignatur` text NOT NULL,
  `autodruckrechnung` int(1) DEFAULT NULL,
  `autodruckversandbestaetigung` int(1) DEFAULT NULL,
  `automailversandbestaetigung` int(1) DEFAULT NULL,
  `autodrucklieferschein` int(1) DEFAULT NULL,
  `automaillieferschein` int(1) DEFAULT NULL,
  `autodruckstorno` int(1) DEFAULT NULL,
  `autodruckanhang` int(1) DEFAULT NULL,
  `automailanhang` int(1) DEFAULT NULL,
  `autodruckerrechnung` int(11) NOT NULL DEFAULT '1',
  `autodruckerlieferschein` int(11) NOT NULL DEFAULT '1',
  `autodruckeranhang` int(11) NOT NULL DEFAULT '1',
  `autodruckrechnungmenge` int(11) NOT NULL DEFAULT '1',
  `autodrucklieferscheinmenge` int(11) NOT NULL DEFAULT '1',
  `eigenernummernkreis` int(11) DEFAULT NULL,
  `next_angebot` varchar(64) DEFAULT NULL,
  `next_auftrag` varchar(64) DEFAULT NULL,
  `next_rechnung` varchar(64) DEFAULT NULL,
  `next_lieferschein` varchar(64) DEFAULT NULL,
  `next_arbeitsnachweis` varchar(64) DEFAULT NULL,
  `next_reisekosten` varchar(64) DEFAULT NULL,
  `next_bestellung` varchar(64) DEFAULT NULL,
  `next_gutschrift` varchar(64) DEFAULT NULL,
  `next_kundennummer` varchar(64) DEFAULT NULL,
  `next_lieferantennummer` varchar(64) DEFAULT NULL,
  `next_mitarbeiternummer` varchar(64) DEFAULT NULL,
  `next_waren` varchar(64) DEFAULT NULL,
  `next_produktion` varchar(64) DEFAULT NULL,
  `next_sonstiges` varchar(64) DEFAULT NULL,
  `next_anfrage` varchar(64) DEFAULT NULL,
  `next_artikelnummer` varchar(64) DEFAULT NULL,
  `gesamtstunden_max` decimal(10,2) NOT NULL,
  `auftragid` int(11) DEFAULT NULL,
  `dhlzahlungmandant` varchar(3) NOT NULL,
  `dhlretourenschein` int(1) NOT NULL,
  `land` varchar(2) NOT NULL DEFAULT 'DE',
  `etiketten_positionen` tinyint(1) NOT NULL DEFAULT '0',
  `etiketten_drucker` int(11) NOT NULL DEFAULT '0',
  `etiketten_art` int(11) NOT NULL DEFAULT '0',
  `seriennummernerfassen` tinyint(1) NOT NULL DEFAULT '1',
  `versandzweigeteilt` tinyint(1) NOT NULL DEFAULT '0',
  `nachnahmecheck` tinyint(1) NOT NULL DEFAULT '1',
  `kasse_lieferschein_anlegen` tinyint(1) NOT NULL DEFAULT '0',
  `kasse_lagerprozess` varchar(64) NOT NULL DEFAULT '',
  `kasse_belegausgabe` varchar(64) NOT NULL DEFAULT '',
  `kasse_preisgruppe` int(11) NOT NULL DEFAULT '0',
  `kasse_text_bemerkung` varchar(64) NOT NULL DEFAULT 'Interne Bemerkung',
  `kasse_text_freitext` varchar(64) NOT NULL DEFAULT 'Text auf Beleg',
  `kasse_drucker` int(11) NOT NULL DEFAULT '0',
  `kasse_lieferschein` int(11) NOT NULL DEFAULT '1',
  `kasse_rechnung` int(11) NOT NULL DEFAULT '1',
  `kasse_lieferschein_doppel` int(11) NOT NULL DEFAULT '1',
  `kasse_lager` int(11) NOT NULL DEFAULT '0',
  `kasse_konto` int(11) NOT NULL DEFAULT '0',
  `kasse_laufkundschaft` int(11) NOT NULL DEFAULT '0',
  `kasse_rabatt_artikel` int(11) NOT NULL DEFAULT '0',
  `kasse_zahlung_bar` tinyint(1) NOT NULL DEFAULT '1',
  `kasse_zahlung_ec` tinyint(1) NOT NULL DEFAULT '1',
  `kasse_zahlung_kreditkarte` tinyint(1) NOT NULL DEFAULT '1',
  `kasse_zahlung_ueberweisung` tinyint(1) NOT NULL DEFAULT '1',
  `kasse_zahlung_paypal` tinyint(1) NOT NULL DEFAULT '0',
  `kasse_extra_keinbeleg` tinyint(1) NOT NULL DEFAULT '0',
  `kasse_extra_rechnung` tinyint(1) NOT NULL DEFAULT '1',
  `kasse_extra_quittung` tinyint(1) NOT NULL DEFAULT '0',
  `kasse_extra_gutschein` tinyint(1) NOT NULL DEFAULT '0',
  `kasse_extra_rabatt_prozent` tinyint(1) NOT NULL DEFAULT '1',
  `kasse_extra_rabatt_euro` tinyint(1) NOT NULL DEFAULT '0',
  `kasse_adresse_erweitert` tinyint(1) NOT NULL DEFAULT '1',
  `kasse_zahlungsauswahl_zwang` tinyint(1) NOT NULL DEFAULT '1',
  `kasse_button_entnahme` tinyint(1) NOT NULL DEFAULT '0',
  `kasse_button_trinkgeld` tinyint(1) NOT NULL DEFAULT '0',
  `kasse_vorauswahl_anrede` varchar(64) NOT NULL DEFAULT 'herr',
  `kasse_erweiterte_lagerabfrage` tinyint(1) NOT NULL DEFAULT '0',
  `filialadresse` int(11) NOT NULL DEFAULT '0',
  `versandprojektfiliale` int(11) NOT NULL DEFAULT '0',
  `differenz_auslieferung_tage` int(11) NOT NULL DEFAULT '2',
  `autostuecklistenanpassung` int(11) NOT NULL DEFAULT '1',
  `dpdendung` varchar(64) NOT NULL DEFAULT '.csv',
  `dhlendung` varchar(64) NOT NULL DEFAULT '.csv',
  `tracking_substr_start` int(11) NOT NULL DEFAULT '8',
  `tracking_remove_kundennummer` tinyint(11) NOT NULL DEFAULT '1',
  `tracking_substr_length` tinyint(11) NOT NULL DEFAULT '0',
  `go_drucker` int(11) NOT NULL DEFAULT '0',
  `go_apiurl_prefix` varchar(128) NOT NULL DEFAULT '',
  `go_apiurl_postfix` varchar(128) NOT NULL DEFAULT '',
  `go_apiurl_user` varchar(128) NOT NULL DEFAULT '',
  `go_username` varchar(128) NOT NULL DEFAULT '',
  `go_password` varchar(128) NOT NULL DEFAULT '',
  `go_ax4nr` varchar(128) NOT NULL DEFAULT '',
  `go_name1` varchar(128) NOT NULL DEFAULT '',
  `go_name2` varchar(128) NOT NULL DEFAULT '',
  `go_abteilung` varchar(128) NOT NULL DEFAULT '',
  `go_strasse1` varchar(128) NOT NULL DEFAULT '',
  `go_strasse2` varchar(128) NOT NULL DEFAULT '',
  `go_hausnummer` varchar(10) NOT NULL DEFAULT '',
  `go_plz` varchar(128) NOT NULL DEFAULT '',
  `go_ort` varchar(128) NOT NULL DEFAULT '',
  `go_land` varchar(128) NOT NULL DEFAULT '',
  `go_standardgewicht` decimal(10,2) DEFAULT NULL,
  `go_format` varchar(64) DEFAULT NULL,
  `go_ausgabe` varchar(64) DEFAULT NULL,
  `intraship_exportgrund` varchar(64) NOT NULL DEFAULT '',
  `billsafe_merchantId` varchar(64) NOT NULL DEFAULT '',
  `billsafe_merchantLicenseSandbox` varchar(64) NOT NULL DEFAULT '',
  `billsafe_merchantLicenseLive` varchar(64) NOT NULL DEFAULT '',
  `billsafe_applicationSignature` varchar(64) NOT NULL DEFAULT '',
  `billsafe_applicationVersion` varchar(64) NOT NULL DEFAULT '',
  `secupay_apikey` varchar(64) NOT NULL DEFAULT '',
  `secupay_url` varchar(64) NOT NULL DEFAULT '',
  `secupay_demo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projekt_inventar`
--

CREATE TABLE IF NOT EXISTS `projekt_inventar` (
`id` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `bestellung` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `mitarbeiter` varchar(255) NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `protokoll`
--

CREATE TABLE IF NOT EXISTS `protokoll` (
`id` int(11) NOT NULL,
  `meldung` text NOT NULL,
  `dump` text NOT NULL,
  `module` varchar(64) NOT NULL DEFAULT '',
  `action` varchar(64) NOT NULL DEFAULT '',
  `bearbeiter` varchar(64) NOT NULL DEFAULT '',
  `funktionsname` varchar(64) NOT NULL DEFAULT '',
  `datum` datetime DEFAULT NULL,
  `parameter` int(11) NOT NULL DEFAULT '0',
  `argumente` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `prozessstarter`
--

CREATE TABLE IF NOT EXISTS `prozessstarter` (
`id` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `bedingung` varchar(255) NOT NULL,
  `art` varchar(255) NOT NULL,
  `startzeit` datetime NOT NULL,
  `letzteausfuerhung` datetime NOT NULL,
  `periode` varchar(255) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `aktiv` int(1) NOT NULL,
  `mutex` int(1) NOT NULL,
  `mutexcounter` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `art_filter` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung`
--

CREATE TABLE IF NOT EXISTS `rechnung` (
`id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `aborechnung` int(1) NOT NULL,
  `projekt` varchar(222) NOT NULL,
  `anlegeart` varchar(255) NOT NULL,
  `belegnr` varchar(255) NOT NULL,
  `auftrag` varchar(255) NOT NULL,
  `auftragid` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `freitext` text NOT NULL,
  `internebemerkung` text NOT NULL,
  `status` varchar(64) NOT NULL,
  `adresse` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `ansprechpartner` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `ust_befreit` int(1) NOT NULL,
  `ustbrief` int(11) NOT NULL,
  `ustbrief_eingang` int(11) NOT NULL,
  `ustbrief_eingang_am` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `lieferschein` int(11) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `lieferdatum` date NOT NULL,
  `buchhaltung` varchar(255) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungsstatus` varchar(255) NOT NULL,
  `ist` decimal(10,2) NOT NULL,
  `soll` decimal(10,2) NOT NULL,
  `skonto_gegeben` decimal(10,2) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlungszielskonto` decimal(10,2) NOT NULL,
  `firma` int(11) NOT NULL,
  `versendet` int(1) NOT NULL,
  `versendet_am` datetime NOT NULL,
  `versendet_per` varchar(255) NOT NULL,
  `versendet_durch` varchar(255) NOT NULL,
  `versendet_mahnwesen` int(1) NOT NULL,
  `mahnwesen` varchar(255) NOT NULL,
  `mahnwesen_datum` date NOT NULL,
  `mahnwesen_gesperrt` int(1) NOT NULL,
  `mahnwesen_internebemerkung` text NOT NULL,
  `inbearbeitung` int(1) NOT NULL,
  `datev_abgeschlossen` int(1) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `doppel` int(1) DEFAULT NULL,
  `autodruck_rz` int(1) NOT NULL DEFAULT '0',
  `autodruck_periode` int(1) NOT NULL DEFAULT '1',
  `autodruck_done` int(1) NOT NULL DEFAULT '0',
  `autodruck_anzahlverband` int(11) NOT NULL DEFAULT '0',
  `autodruck_anzahlkunde` int(11) NOT NULL DEFAULT '0',
  `autodruck_mailverband` int(1) NOT NULL DEFAULT '0',
  `autodruck_mailkunde` int(1) NOT NULL DEFAULT '0',
  `dta_datei_verband` int(11) NOT NULL DEFAULT '0',
  `dta_datei` int(11) NOT NULL DEFAULT '0',
  `deckungsbeitragcalc` tinyint(1) NOT NULL DEFAULT '0',
  `deckungsbeitrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `umsatz_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `erloes_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mahnwesenfestsetzen` tinyint(1) NOT NULL DEFAULT '0',
  `vertriebid` int(11) DEFAULT NULL,
  `aktion` varchar(64) NOT NULL DEFAULT '',
  `vertrieb` varchar(255) NOT NULL DEFAULT '',
  `provision` decimal(10,2) DEFAULT NULL,
  `provision_summe` decimal(10,2) DEFAULT NULL,
  `gruppe` int(11) NOT NULL DEFAULT '0',
  `punkte` int(11) DEFAULT NULL,
  `bonuspunkte` int(11) DEFAULT NULL,
  `provdatum` date DEFAULT NULL,
  `ihrebestellnummer` varchar(255) DEFAULT NULL,
  `anschreiben` varchar(255) DEFAULT NULL,
  `usereditid` int(11) DEFAULT NULL,
  `useredittimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `realrabatt` decimal(10,2) DEFAULT NULL,
  `rabatt` decimal(10,2) DEFAULT NULL,
  `einzugsdatum` date DEFAULT NULL,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `forderungsverlust_datum` date DEFAULT NULL,
  `forderungsverlust_betrag` decimal(10,2) DEFAULT NULL,
  `steuersatz_normal` decimal(10,2) NOT NULL DEFAULT '19.00',
  `steuersatz_zwischen` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_ermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_starkermaessigt` decimal(10,2) NOT NULL DEFAULT '7.00',
  `steuersatz_dienstleistung` decimal(10,2) NOT NULL DEFAULT '7.00',
  `waehrung` varchar(255) NOT NULL DEFAULT 'EUR',
  `keinsteuersatz` int(1) DEFAULT NULL,
  `schreibschutz` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviert` int(1) NOT NULL DEFAULT '0',
  `pdfarchiviertversion` int(11) NOT NULL DEFAULT '0',
  `typ` varchar(255) NOT NULL DEFAULT 'firma',
  `ohne_briefpapier` int(1) DEFAULT NULL,
  `lieferid` int(11) NOT NULL DEFAULT '0',
  `ansprechpartnerid` int(11) NOT NULL DEFAULT '0',
  `systemfreitext` text NOT NULL,
  `projektfiliale` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung_position`
--

CREATE TABLE IF NOT EXISTS `rechnung_position` (
`id` int(10) NOT NULL,
  `rechnung` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `internerkommentar` text NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `menge` float NOT NULL,
  `preis` decimal(10,4) NOT NULL,
  `waehrung` varchar(255) NOT NULL,
  `lieferdatum` date NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `status` varchar(64) NOT NULL,
  `umsatzsteuer` varchar(255) NOT NULL,
  `bemerkung` text NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `explodiert_parent_artikel` int(11) NOT NULL DEFAULT '0',
  `punkte` decimal(10,2) NOT NULL,
  `bonuspunkte` decimal(10,2) NOT NULL,
  `mlmdirektpraemie` decimal(10,2) DEFAULT NULL,
  `mlm_abgerechnet` int(1) DEFAULT NULL,
  `keinrabatterlaubt` int(1) DEFAULT NULL,
  `grundrabatt` decimal(10,2) DEFAULT NULL,
  `rabattsync` int(1) DEFAULT NULL,
  `rabatt1` decimal(10,2) DEFAULT NULL,
  `rabatt2` decimal(10,2) DEFAULT NULL,
  `rabatt3` decimal(10,2) DEFAULT NULL,
  `rabatt4` decimal(10,2) DEFAULT NULL,
  `rabatt5` decimal(10,2) DEFAULT NULL,
  `einheit` varchar(255) NOT NULL DEFAULT '',
  `rabatt` decimal(10,2) NOT NULL,
  `zolltarifnummer` varchar(128) NOT NULL DEFAULT '0',
  `herkunftsland` varchar(128) NOT NULL DEFAULT '0',
  `artikelnummerkunde` varchar(128) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung_protokoll`
--

CREATE TABLE IF NOT EXISTS `rechnung_protokoll` (
`id` int(11) NOT NULL,
  `rechnung` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reisekostenart`
--

CREATE TABLE IF NOT EXISTS `reisekostenart` (
`id` int(11) NOT NULL,
  `nummer` varchar(20) DEFAULT NULL,
  `beschreibung` varchar(512) DEFAULT NULL,
  `internebemerkung` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopexport`
--

CREATE TABLE IF NOT EXISTS `shopexport` (
`id` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `challenge` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `cms` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `geloescht` int(1) NOT NULL DEFAULT '0',
  `artikelporto` int(11) NOT NULL DEFAULT '0',
  `artikelnachnahme` int(11) NOT NULL DEFAULT '0',
  `artikelimport` int(1) NOT NULL DEFAULT '0',
  `artikelimporteinzeln` int(1) NOT NULL DEFAULT '0',
  `demomodus` tinyint(1) NOT NULL DEFAULT '0',
  `aktiv` int(1) NOT NULL DEFAULT '1',
  `lagerexport` int(1) NOT NULL DEFAULT '1',
  `artikelexport` int(1) NOT NULL DEFAULT '1',
  `multiprojekt` int(1) NOT NULL DEFAULT '0',
  `artikelnachnahme_extraartikel` tinyint(1) NOT NULL DEFAULT '1',
  `vorabbezahltmarkieren_ohnevorkasse_bar` int(11) NOT NULL DEFAULT '0',
  `einzelsync` tinyint(1) NOT NULL DEFAULT '0',
  `utf8codierung` tinyint(1) NOT NULL DEFAULT '1',
  `auftragabgleich` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopexport_kampange`
--

CREATE TABLE IF NOT EXISTS `shopexport_kampange` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `banner` int(11) NOT NULL,
  `unterbanner` int(11) NOT NULL,
  `von` date NOT NULL,
  `bis` date NOT NULL,
  `link` text NOT NULL,
  `firma` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `aktiv` int(1) NOT NULL,
  `shop` int(11) NOT NULL,
  `artikel` varchar(255) NOT NULL,
  `aktion` varchar(255) NOT NULL,
  `geloescht` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopexport_status`
--

CREATE TABLE IF NOT EXISTS `shopexport_status` (
`id` int(11) NOT NULL,
  `artikelexport` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `bemerkung` text NOT NULL,
  `befehl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopimport_auftraege`
--

CREATE TABLE IF NOT EXISTS `shopimport_auftraege` (
`id` int(11) NOT NULL,
`shopid` int(11) NOT NULL DEFAULT '0',
  `extid` int(11) NOT NULL,
  `sessionid` varchar(255) NOT NULL,
  `warenkorb` text NOT NULL,
  `imported` int(1) NOT NULL,
  `trash` int(1) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopnavigation`
--

CREATE TABLE IF NOT EXISTS `shopnavigation` (
`id` int(11) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `bezeichnung_en` varchar(255) NOT NULL,
  `plugin` varchar(255) NOT NULL,
  `pluginparameter` varchar(255) NOT NULL,
  `shop` int(11) NOT NULL,
  `target` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stechuhr`
--

CREATE TABLE IF NOT EXISTS `stechuhr` (
`id` int(11) NOT NULL,
  `datum` datetime DEFAULT NULL,
  `adresse` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `kommen` tinyint(1) NOT NULL DEFAULT '0',
  `uebernommen` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stueckliste`
--

CREATE TABLE IF NOT EXISTS `stueckliste` (
`id` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `referenz` text NOT NULL,
  `place` varchar(255) NOT NULL,
  `layer` varchar(255) NOT NULL,
  `stuecklistevonartikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `wert` text NOT NULL,
  `bauform` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stundensatz`
--

CREATE TABLE IF NOT EXISTS `stundensatz` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `satz` float NOT NULL,
  `typ` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `systemlog`
--

CREATE TABLE IF NOT EXISTS `systemlog` (
`id` int(11) NOT NULL,
  `meldung` text NOT NULL,
  `dump` text NOT NULL,
  `module` varchar(64) NOT NULL DEFAULT '',
  `action` varchar(64) NOT NULL DEFAULT '',
  `bearbeiter` varchar(64) NOT NULL DEFAULT '',
  `funktionsname` varchar(64) NOT NULL DEFAULT '',
  `datum` datetime DEFAULT NULL,
  `parameter` int(11) NOT NULL DEFAULT '0',
  `argumente` text NOT NULL,
  `level` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `textvorlagen`
--

CREATE TABLE IF NOT EXISTS `textvorlagen` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `text` text,
  `stichwoerter` varchar(255) DEFAULT NULL,
  `projekt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `uebersetzung`
--

CREATE TABLE IF NOT EXISTS `uebersetzung` (
`id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL DEFAULT '',
  `beschriftung` text NOT NULL,
  `sprache` varchar(255) NOT NULL DEFAULT '',
  `original` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `unterprojekt`
--

CREATE TABLE IF NOT EXISTS `unterprojekt` (
`id` int(10) NOT NULL,
  `projekt` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `verantwortlicher` varchar(255) NOT NULL,
  `aktiv` varchar(255) NOT NULL,
  `position` int(10) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `repassword` int(1) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `settings` text NOT NULL,
  `parentuser` int(11) DEFAULT NULL,
  `activ` int(11) DEFAULT '0',
  `type` varchar(100) DEFAULT '',
  `adresse` int(10) NOT NULL,
  `fehllogins` int(11) NOT NULL,
  `standarddrucker` int(1) NOT NULL,
  `firma` int(10) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `startseite` varchar(1024) DEFAULT NULL,
  `hwtoken` int(1) DEFAULT NULL,
  `hwkey` varchar(255) DEFAULT NULL,
  `hwcounter` int(11) DEFAULT NULL,
  `motppin` varchar(255) DEFAULT NULL,
  `motpsecret` varchar(255) DEFAULT NULL,
  `passwordmd5` varchar(255) DEFAULT NULL,
  `externlogin` int(1) DEFAULT NULL,
  `projekt_bevorzugen` tinyint(1) NOT NULL DEFAULT '0',
  `email_bevorzugen` tinyint(1) NOT NULL DEFAULT '1',
  `projekt` int(11) NOT NULL DEFAULT '0',
  `rfidtag` varchar(64) NOT NULL DEFAULT '',
  `vorlage` varchar(255) DEFAULT NULL,
  `kalender_passwort` varchar(255) DEFAULT NULL,
  `kalender_ausblenden` int(1) NOT NULL DEFAULT '0',
  `kalender_aktiv` int(1) DEFAULT NULL,
  `gpsstechuhr` int(1) DEFAULT NULL,
  `standardetikett` int(11) NOT NULL DEFAULT '0',
  `standardfax` int(11) NOT NULL DEFAULT '0',
  `internebezeichnung` varchar(255) DEFAULT NULL,
  `hwdatablock` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `useronline`
--

CREATE TABLE IF NOT EXISTS `useronline` (
  `user_id` int(5) NOT NULL DEFAULT '0',
  `login` int(1) NOT NULL DEFAULT '0',
  `sessionid` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(200) NOT NULL DEFAULT '',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userrights`
--

CREATE TABLE IF NOT EXISTS `userrights` (
`id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `module` varchar(64) NOT NULL,
  `action` varchar(64) NOT NULL,
  `permission` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `uservorlage`
--

CREATE TABLE IF NOT EXISTS `uservorlage` (
`id` int(11) NOT NULL,
  `bezeichnung` varchar(255) DEFAULT NULL,
  `beschreibung` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `uservorlagerights`
--

CREATE TABLE IF NOT EXISTS `uservorlagerights` (
`id` int(11) NOT NULL,
  `vorlage` int(11) DEFAULT NULL,
  `module` varchar(64) DEFAULT NULL,
  `action` varchar(64) DEFAULT NULL,
  `permission` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ustprf`
--

CREATE TABLE IF NOT EXISTS `ustprf` (
`id` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `rechtsform` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `status` varchar(64) NOT NULL,
  `datum_online` datetime NOT NULL,
  `datum_brief` date NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `briefbestellt` date NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ustprf_protokoll`
--

CREATE TABLE IF NOT EXISTS `ustprf_protokoll` (
`id` int(11) NOT NULL,
  `ustprf_id` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bemerkung` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verkaufspreise`
--

CREATE TABLE IF NOT EXISTS `verkaufspreise` (
`id` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `projekt` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `preis` decimal(10,4) NOT NULL,
  `waehrung` varchar(255) NOT NULL,
  `ab_menge` int(11) NOT NULL,
  `vpe` varchar(64) NOT NULL DEFAULT '1',
  `vpe_menge` int(11) NOT NULL,
  `angelegt_am` date NOT NULL,
  `gueltig_bis` date NOT NULL,
  `bemerkung` text NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `firma` int(11) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `kundenartikelnummer` varchar(255) DEFAULT NULL,
  `art` varchar(255) NOT NULL DEFAULT 'Kunde',
  `gruppe` int(11) DEFAULT NULL,
  `apichange` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verrechnungsart`
--

CREATE TABLE IF NOT EXISTS `verrechnungsart` (
`id` int(11) NOT NULL,
  `nummer` varchar(20) DEFAULT NULL,
  `beschreibung` varchar(512) DEFAULT NULL,
  `internebemerkung` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `versand`
--

CREATE TABLE IF NOT EXISTS `versand` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `rechnung` int(11) NOT NULL,
  `lieferschein` int(11) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `gewicht` varchar(255) NOT NULL,
  `freigegeben` int(1) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `versender` varchar(255) NOT NULL,
  `abgeschlossen` int(1) NOT NULL,
  `versendet_am` date NOT NULL,
  `versandunternehmen` varchar(255) NOT NULL,
  `tracking` varchar(255) NOT NULL,
  `download` int(11) NOT NULL,
  `firma` int(1) NOT NULL,
  `logdatei` datetime NOT NULL,
  `keinetrackingmail` int(1) DEFAULT NULL,
  `versendet_am_zeitstempel` datetime DEFAULT NULL,
  `weitererlieferschein` int(1) NOT NULL DEFAULT '0',
  `anzahlpakete` int(11) NOT NULL DEFAULT '0',
  `gelesen` int(1) NOT NULL DEFAULT '0',
  `paketmarkegedruckt` int(1) NOT NULL DEFAULT '0',
  `papieregedruckt` int(1) NOT NULL DEFAULT '0',
  `versandzweigeteilt` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `versandpakete`
--

CREATE TABLE IF NOT EXISTS `versandpakete` (
`id` int(11) NOT NULL,
  `versand` int(11) NOT NULL DEFAULT '0',
  `nr` int(11) NOT NULL DEFAULT '0',
  `tracking` varchar(255) NOT NULL DEFAULT '',
  `versender` varchar(255) NOT NULL DEFAULT '',
  `gewicht` varchar(10) NOT NULL DEFAULT '',
  `bemerkung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webmail`
--

CREATE TABLE IF NOT EXISTS `webmail` (
`id` int(10) NOT NULL,
  `adresse` int(11) NOT NULL,
  `benutzername` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webmail_mails`
--

CREATE TABLE IF NOT EXISTS `webmail_mails` (
`id` int(15) NOT NULL,
  `webmail` int(10) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sender` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bcc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `replyto` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `plaintext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `htmltext` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empfang` datetime NOT NULL,
  `anhang` int(1) NOT NULL,
  `gelesen` int(1) NOT NULL,
  `checksum` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webmail_zuordnungen`
--

CREATE TABLE IF NOT EXISTS `webmail_zuordnungen` (
`id` int(11) NOT NULL,
  `mail` int(11) NOT NULL,
  `zuordnung` varchar(255) NOT NULL,
  `parameter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wiedervorlage`
--

CREATE TABLE IF NOT EXISTS `wiedervorlage` (
`id` int(11) NOT NULL,
  `adresse` int(11) NOT NULL DEFAULT '0',
  `projekt` int(11) NOT NULL DEFAULT '0',
  `adresse_mitarbeier` int(11) NOT NULL DEFAULT '0',
  `bezeichnung` varchar(255) NOT NULL DEFAULT '',
  `beschreibung` text NOT NULL,
  `ergebnis` text NOT NULL,
  `betrag` decimal(10,2) DEFAULT NULL,
  `erinnerung` datetime DEFAULT NULL,
  `erinnerung_per_mail` int(1) DEFAULT NULL,
  `erinnerung_empfaenger` text,
  `link` text,
  `module` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `status` varchar(64) DEFAULT NULL,
  `bearbeiter` int(11) NOT NULL DEFAULT '0',
  `adresse_mitarbeiter` int(11) NOT NULL DEFAULT '0',
  `datum_angelegt` date DEFAULT NULL,
  `zeit_angelegt` time DEFAULT NULL,
  `datum_erinnerung` date DEFAULT NULL,
  `zeit_erinnerung` time DEFAULT NULL,
  `parameter` int(11) NOT NULL DEFAULT '0',
  `oeffentlich` tinyint(1) NOT NULL DEFAULT '0',
  `abgeschlossen` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wiedervorlage_protokoll`
--

CREATE TABLE IF NOT EXISTS `wiedervorlage_protokoll` (
`id` int(11) NOT NULL,
  `vorgaengerid` int(11) DEFAULT NULL,
  `wiedervorlageid` int(11) DEFAULT NULL,
  `adresse_mitarbeier` int(11) NOT NULL DEFAULT '0',
  `erinnerung_alt` datetime DEFAULT NULL,
  `erinnerung_neu` datetime DEFAULT NULL,
  `bezeichnung` varchar(255) NOT NULL DEFAULT '',
  `beschreibung` text NOT NULL,
  `ergebnis` text NOT NULL,
  `adresse_mitarbeiter` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wiki`
--

CREATE TABLE IF NOT EXISTS `wiki` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `lastcontent` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeiterfassung`
--

CREATE TABLE IF NOT EXISTS `zeiterfassung` (
`id` int(10) NOT NULL,
  `art` varchar(64) NOT NULL,
  `adresse` int(10) NOT NULL,
  `von` datetime NOT NULL,
  `bis` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `aufgabe` varchar(255) NOT NULL,
  `beschreibung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `arbeitspaket` int(10) NOT NULL,
  `buchungsart` varchar(255) NOT NULL,
  `kostenstelle` varchar(255) NOT NULL,
  `projekt` int(10) DEFAULT '0',
  `abgerechnet` int(10) NOT NULL,
  `logdatei` datetime NOT NULL,
  `status` varchar(64) DEFAULT NULL,
  `gps` varchar(1024) DEFAULT NULL,
  `arbeitsnachweispositionid` int(11) NOT NULL DEFAULT '0',
  `adresse_abrechnung` int(11) DEFAULT NULL,
  `abrechnen` int(1) DEFAULT NULL,
  `ist_abgerechnet` int(1) DEFAULT NULL,
  `gebucht_von_user` int(11) DEFAULT NULL,
  `ort` varchar(1024) DEFAULT NULL,
  `abrechnung_dokument` varchar(1024) DEFAULT NULL,
  `dokumentid` int(11) DEFAULT NULL,
  `verrechnungsart` varchar(255) DEFAULT NULL,
  `arbeitsnachweis` int(11) DEFAULT NULL,
  `internerkommentar` text,
  `aufgabe_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zwischenlager`
--

CREATE TABLE IF NOT EXISTS `zwischenlager` (
`id` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `menge` float NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL,
  `lager_von` varchar(255) NOT NULL,
  `lager_nach` varchar(255) NOT NULL,
  `richtung` varchar(255) NOT NULL,
  `erledigt` int(1) NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur des Views `belege`
--
DROP TABLE IF EXISTS `belege`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `belege` AS select `rechnung`.`id` AS `id`,`rechnung`.`adresse` AS `adresse`,`rechnung`.`datum` AS `datum`,`rechnung`.`belegnr` AS `belegnr`,`rechnung`.`status` AS `status`,`rechnung`.`land` AS `land`,'rechnung' AS `typ`,`rechnung`.`umsatz_netto` AS `umsatz_netto`,`rechnung`.`erloes_netto` AS `erloes_netto`,`rechnung`.`deckungsbeitrag` AS `deckungsbeitrag`,`rechnung`.`provision_summe` AS `provision_summe`,`rechnung`.`vertriebid` AS `vertriebid`,`rechnung`.`gruppe` AS `gruppe` from `rechnung` where (`rechnung`.`status` <> 'angelegt') union all select `gutschrift`.`id` AS `id`,`gutschrift`.`adresse` AS `adresse`,`gutschrift`.`datum` AS `datum`,`gutschrift`.`belegnr` AS `belegnr`,`gutschrift`.`status` AS `status`,`gutschrift`.`land` AS `land`,'gutschrift' AS `typ`,(`gutschrift`.`umsatz_netto` * -(1)) AS `umsatz_netto*-1`,(`gutschrift`.`erloes_netto` * -(1)) AS `erloes_netto*-1`,(`gutschrift`.`deckungsbeitrag` * -(1)) AS `deckungsbeitrag*-1`,(`gutschrift`.`provision_summe` * -(1)) AS `provision_summe*-1`,`gutschrift`.`vertriebid` AS `vertriebid`,`gutschrift`.`gruppe` AS `gruppe` from `gutschrift` where (`gutschrift`.`status` <> 'angelegt');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `abrechnungsartikel`
--
ALTER TABLE `abrechnungsartikel`
 ADD PRIMARY KEY (`id`), ADD KEY `adresse` (`adresse`);

--
-- Indizes für die Tabelle `accordion`
--
ALTER TABLE `accordion`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adapterbox`
--
ALTER TABLE `adapterbox`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adapterbox_log`
--
ALTER TABLE `adapterbox_log`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adresse`
--
ALTER TABLE `adresse`
 ADD PRIMARY KEY (`id`), ADD KEY `name` (`name`), ADD KEY `vertrieb` (`vertrieb`), ADD KEY `innendienst` (`innendienst`), ADD KEY `sponsor` (`sponsor`), ADD KEY `projekt` (`projekt`), ADD KEY `kundennummer` (`kundennummer`), ADD KEY `lieferantennummer` (`lieferantennummer`), ADD KEY `usereditid` (`usereditid`), ADD KEY `plz` (`plz`), ADD KEY `email` (`email`);

--
-- Indizes für die Tabelle `adresse_accounts`
--
ALTER TABLE `adresse_accounts`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adresse_import`
--
ALTER TABLE `adresse_import`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adresse_kontakhistorie`
--
ALTER TABLE `adresse_kontakhistorie`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adresse_kontakte`
--
ALTER TABLE `adresse_kontakte`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adresse_rolle`
--
ALTER TABLE `adresse_rolle`
 ADD PRIMARY KEY (`id`), ADD KEY `adresse` (`adresse`), ADD KEY `projekt` (`projekt`);


--
-- Indizes für die Tabelle `angebot`
--
ALTER TABLE `angebot`
 ADD PRIMARY KEY (`id`), ADD KEY `projekt` (`projekt`), ADD KEY `adresse` (`adresse`), ADD KEY `vertriebid` (`vertriebid`), ADD KEY `gruppe` (`gruppe`), ADD KEY `usereditid` (`usereditid`), ADD KEY `status` (`status`), ADD KEY `datum` (`datum`), ADD KEY `belegnr` (`belegnr`);

--
-- Indizes für die Tabelle `angebot_position`
--
ALTER TABLE `angebot_position`
 ADD PRIMARY KEY (`id`), ADD KEY `angebot` (`angebot`), ADD KEY `artikel` (`artikel`);

--
-- Indizes für die Tabelle `angebot_protokoll`
--
ALTER TABLE `angebot_protokoll`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ansprechpartner`
--
ALTER TABLE `ansprechpartner`
 ADD PRIMARY KEY (`id`), ADD KEY `adresse` (`adresse`);


--
-- Indizes für die Tabelle `arbeitspaket`
--
ALTER TABLE `arbeitspaket`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `artikel`
--
ALTER TABLE `artikel`
 ADD PRIMARY KEY (`id`), ADD KEY `projekt` (`projekt`), ADD KEY `usereditid` (`usereditid`), ADD KEY `nummer` (`nummer`), ADD KEY `adresse` (`adresse`);




--
-- Indizes für die Tabelle `artikeleinheit`
--
ALTER TABLE `artikeleinheit`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `artikelgruppen`
--
ALTER TABLE `artikelgruppen`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);


--
-- Indizes für die Tabelle `artikel_artikelgruppe`
--
ALTER TABLE `artikel_artikelgruppe`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `artikel_permanenteinventur`
--
ALTER TABLE `artikel_permanenteinventur`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `artikel_shop`
--
ALTER TABLE `artikel_shop`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `aufgabe`
--
ALTER TABLE `aufgabe`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `aufgabe_erledigt`
--
ALTER TABLE `aufgabe_erledigt`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `auftrag`
--
ALTER TABLE `auftrag`
 ADD PRIMARY KEY (`id`), ADD KEY `projekt` (`projekt`), ADD KEY `adresse` (`adresse`), ADD KEY `vertriebid` (`vertriebid`), ADD KEY `gruppe` (`gruppe`), ADD KEY `usereditid` (`usereditid`), ADD KEY `status` (`status`), ADD KEY `datum` (`datum`), ADD KEY `belegnr` (`belegnr`), ADD KEY `gesamtsumme` (`gesamtsumme`), ADD KEY `transaktionsnummer` (`transaktionsnummer`), ADD KEY `internet` (`internet`);

--
-- Indizes für die Tabelle `auftrag_position`
--
ALTER TABLE `auftrag_position`
 ADD PRIMARY KEY (`id`), ADD KEY `auftrag` (`auftrag`,`artikel`), ADD KEY `artikel` (`artikel`);

--
-- Indizes für die Tabelle `auftrag_protokoll`
--
ALTER TABLE `auftrag_protokoll`
 ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `backup`
--
ALTER TABLE `backup`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `bene`
--
ALTER TABLE `bene`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `berichte`
--
ALTER TABLE `berichte`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
 ADD PRIMARY KEY (`id`), ADD KEY `projekt` (`projekt`), ADD KEY `adresse` (`adresse`), ADD KEY `usereditid` (`usereditid`), ADD KEY `status` (`status`), ADD KEY `datum` (`datum`), ADD KEY `belegnr` (`belegnr`);

--
-- Indizes für die Tabelle `bestellung_position`
--
ALTER TABLE `bestellung_position`
 ADD PRIMARY KEY (`id`), ADD KEY `bestellung` (`bestellung`,`artikel`), ADD KEY `artikel` (`artikel`);

--
-- Indizes für die Tabelle `bestellung_protokoll`
--
ALTER TABLE `bestellung_protokoll`
 ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `calendar`
--
ALTER TABLE `calendar`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `chargenverwaltung`
--
ALTER TABLE `chargenverwaltung`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `chat`
--
ALTER TABLE `chat`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `datei`
--
ALTER TABLE `datei`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `datei_stichwoerter`
--
ALTER TABLE `datei_stichwoerter`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `datei_version`
--
ALTER TABLE `datei_version`
 ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `device_jobs`
--
ALTER TABLE `device_jobs`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `dokumente`
--
ALTER TABLE `dokumente`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `dokumente_send`
--
ALTER TABLE `dokumente_send`
 ADD PRIMARY KEY (`id`), ADD KEY `adresse` (`adresse`);

--
-- Indizes für die Tabelle `drucker`
--
ALTER TABLE `drucker`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `drucker_spooler`
--
ALTER TABLE `drucker_spooler`
 ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `einkaufspreise`
--
ALTER TABLE `einkaufspreise`
 ADD PRIMARY KEY (`id`), ADD KEY `artikel` (`artikel`), ADD KEY `adresse` (`adresse`), ADD KEY `projekt` (`projekt`);



--
-- Indizes für die Tabelle `etiketten`
--
ALTER TABLE `etiketten`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `event_api`
--
ALTER TABLE `event_api`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `exportvorlage`
--
ALTER TABLE `exportvorlage`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `firma`
--
ALTER TABLE `firma`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `firmendaten`
--
ALTER TABLE `firmendaten`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `geschaeftsbrief_vorlagen`
--
ALTER TABLE `geschaeftsbrief_vorlagen`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gpsstechuhr`
--
ALTER TABLE `gpsstechuhr`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gruppen`
--
ALTER TABLE `gruppen`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gutschrift`
--
ALTER TABLE `gutschrift`
 ADD PRIMARY KEY (`id`), ADD KEY `projekt` (`projekt`), ADD KEY `adresse` (`adresse`), ADD KEY `vertriebid` (`vertriebid`), ADD KEY `gruppe` (`gruppe`), ADD KEY `usereditid` (`usereditid`), ADD KEY `status` (`status`), ADD KEY `datum` (`datum`), ADD KEY `belegnr` (`belegnr`);

--
-- Indizes für die Tabelle `gutschrift_position`
--
ALTER TABLE `gutschrift_position`
 ADD PRIMARY KEY (`id`), ADD KEY `gutschrift` (`gutschrift`), ADD KEY `artikel` (`artikel`);

--
-- Indizes für die Tabelle `gutschrift_protokoll`
--
ALTER TABLE `gutschrift_protokoll`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `importvorlage`
--
ALTER TABLE `importvorlage`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `importvorlage_log`
--
ALTER TABLE `importvorlage_log`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `inhalt`
--
ALTER TABLE `inhalt`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `interne_events`
--
ALTER TABLE `interne_events`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `jqcalendar`
--
ALTER TABLE `jqcalendar`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kalender`
--
ALTER TABLE `kalender`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kalender_event`
--
ALTER TABLE `kalender_event`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kalender_user`
--
ALTER TABLE `kalender_user`
 ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `konfiguration`
--
ALTER TABLE `konfiguration`
 ADD PRIMARY KEY (`name`);





--
-- Indizes für die Tabelle `kostenstelle`
--
ALTER TABLE `kostenstelle`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kostenstellen`
--
ALTER TABLE `kostenstellen`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kostenstelle_buchung`
--
ALTER TABLE `kostenstelle_buchung`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kundevorlage`
--
ALTER TABLE `kundevorlage`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lager`
--
ALTER TABLE `lager`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lagermindestmengen`
--
ALTER TABLE `lagermindestmengen`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lager_bewegung`
--
ALTER TABLE `lager_bewegung`
 ADD PRIMARY KEY (`id`), ADD KEY `artikel` (`artikel`), ADD KEY `adresse` (`adresse`);

--
-- Indizes für die Tabelle `lager_charge`
--
ALTER TABLE `lager_charge`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lager_differenzen`
--
ALTER TABLE `lager_differenzen`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lager_mindesthaltbarkeitsdatum`
--
ALTER TABLE `lager_mindesthaltbarkeitsdatum`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lager_platz`
--
ALTER TABLE `lager_platz`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lager_platz_inhalt`
--
ALTER TABLE `lager_platz_inhalt`
 ADD PRIMARY KEY (`id`), ADD KEY `artikel` (`artikel`), ADD KEY `lager_platz` (`lager_platz`);

--
-- Indizes für die Tabelle `lager_reserviert`
--
ALTER TABLE `lager_reserviert`
 ADD PRIMARY KEY (`id`), ADD KEY `adresse` (`adresse`,`artikel`);


--
-- Indizes für die Tabelle `lieferadressen`
--
ALTER TABLE `lieferadressen`
 ADD PRIMARY KEY (`id`), ADD KEY `adresse` (`adresse`);

--
-- Indizes für die Tabelle `lieferantvorlage`
--
ALTER TABLE `lieferantvorlage`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lieferschein`
--
ALTER TABLE `lieferschein`
 ADD PRIMARY KEY (`id`), ADD KEY `projekt` (`projekt`), ADD KEY `adresse` (`adresse`), ADD KEY `vertriebid` (`vertriebid`), ADD KEY `auftragid` (`auftragid`), ADD KEY `land` (`land`), ADD KEY `usereditid` (`usereditid`), ADD KEY `status` (`status`), ADD KEY `datum` (`datum`), ADD KEY `belegnr` (`belegnr`);

--
-- Indizes für die Tabelle `lieferschein_position`
--
ALTER TABLE `lieferschein_position`
 ADD PRIMARY KEY (`id`), ADD KEY `lieferschein` (`lieferschein`), ADD KEY `artikel` (`artikel`);

--
-- Indizes für die Tabelle `lieferschein_protokoll`
--
ALTER TABLE `lieferschein_protokoll`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `linkeditor`
--
ALTER TABLE `linkeditor`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `logdatei`
--
ALTER TABLE `logdatei`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `logfile`
--
ALTER TABLE `logfile`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `module_lock`
--
ALTER TABLE `module_lock`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `newsletter_blacklist`
--
ALTER TABLE `newsletter_blacklist`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `objekt_protokoll`
--
ALTER TABLE `objekt_protokoll`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `offenevorgaenge`
--
ALTER TABLE `offenevorgaenge`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `paketannahme`
--
ALTER TABLE `paketannahme`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `paketdistribution`
--
ALTER TABLE `paketdistribution`
 ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `pdfmirror_md5pool`
--
ALTER TABLE `pdfmirror_md5pool`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pinwand`
--
ALTER TABLE `pinwand`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pinwand_user`
--
ALTER TABLE `pinwand_user`
 ADD PRIMARY KEY (`id`);



--
-- Indizes für die Tabelle `projekt`
--
ALTER TABLE `projekt`
 ADD PRIMARY KEY (`id`), ADD KEY `abkuerzung` (`abkuerzung`);

--
-- Indizes für die Tabelle `projekt_inventar`
--
ALTER TABLE `projekt_inventar`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `protokoll`
--
ALTER TABLE `protokoll`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `prozessstarter`
--
ALTER TABLE `prozessstarter`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `rechnung`
--
ALTER TABLE `rechnung`
 ADD PRIMARY KEY (`id`), ADD KEY `projekt` (`projekt`), ADD KEY `adresse` (`adresse`), ADD KEY `vertriebid` (`vertriebid`), ADD KEY `gruppe` (`gruppe`), ADD KEY `usereditid` (`usereditid`), ADD KEY `auftragid` (`auftragid`), ADD KEY `status` (`status`), ADD KEY `datum` (`datum`), ADD KEY `belegnr` (`belegnr`), ADD KEY `soll` (`soll`), ADD KEY `zahlungsstatus` (`zahlungsstatus`), ADD KEY `provdatum` (`provdatum`);

--
-- Indizes für die Tabelle `rechnung_position`
--
ALTER TABLE `rechnung_position`
 ADD PRIMARY KEY (`id`), ADD KEY `rechnung` (`rechnung`), ADD KEY `artikel` (`artikel`);

--
-- Indizes für die Tabelle `rechnung_protokoll`
--
ALTER TABLE `rechnung_protokoll`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `reisekostenart`
--
ALTER TABLE `reisekostenart`
 ADD PRIMARY KEY (`id`);




--
-- Indizes für die Tabelle `shopexport`
--
ALTER TABLE `shopexport`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `shopexport_kampange`
--
ALTER TABLE `shopexport_kampange`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `shopexport_status`
--
ALTER TABLE `shopexport_status`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `shopimport_auftraege`
--
ALTER TABLE `shopimport_auftraege`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `shopnavigation`
--
ALTER TABLE `shopnavigation`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `stechuhr`
--
ALTER TABLE `stechuhr`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `stueckliste`
--
ALTER TABLE `stueckliste`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `stundensatz`
--
ALTER TABLE `stundensatz`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `systemlog`
--
ALTER TABLE `systemlog`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `textvorlagen`
--
ALTER TABLE `textvorlagen`
 ADD PRIMARY KEY (`id`);




--
-- Indizes für die Tabelle `uebersetzung`
--
ALTER TABLE `uebersetzung`
 ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `unterprojekt`
--
ALTER TABLE `unterprojekt`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `userrights`
--
ALTER TABLE `userrights`
 ADD PRIMARY KEY (`id`), ADD KEY `user` (`user`);

--
-- Indizes für die Tabelle `uservorlage`
--
ALTER TABLE `uservorlage`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `uservorlagerights`
--
ALTER TABLE `uservorlagerights`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ustprf`
--
ALTER TABLE `ustprf`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ustprf_protokoll`
--
ALTER TABLE `ustprf_protokoll`
 ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `verkaufspreise`
--
ALTER TABLE `verkaufspreise`
 ADD PRIMARY KEY (`id`), ADD KEY `artikel` (`artikel`), ADD KEY `adresse` (`adresse`), ADD KEY `projekt` (`projekt`);

--
-- Indizes für die Tabelle `verrechnungsart`
--
ALTER TABLE `verrechnungsart`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `versand`
--
ALTER TABLE `versand`
 ADD PRIMARY KEY (`id`), ADD KEY `lieferschein` (`lieferschein`), ADD KEY `projekt` (`projekt`), ADD KEY `adresse` (`adresse`);

--
-- Indizes für die Tabelle `versandpakete`
--
ALTER TABLE `versandpakete`
 ADD PRIMARY KEY (`id`);



--
-- Indizes für die Tabelle `webmail`
--
ALTER TABLE `webmail`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webmail_mails`
--
ALTER TABLE `webmail_mails`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webmail_zuordnungen`
--
ALTER TABLE `webmail_zuordnungen`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `wiedervorlage`
--
ALTER TABLE `wiedervorlage`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `wiedervorlage_protokoll`
--
ALTER TABLE `wiedervorlage_protokoll`
 ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `wiki`
--
ALTER TABLE `wiki`
 ADD PRIMARY KEY (`id`);


--
-- Indizes für die Tabelle `zeiterfassung`
--
ALTER TABLE `zeiterfassung`
 ADD PRIMARY KEY (`id`), ADD KEY `adresse_abrechnung` (`adresse_abrechnung`), ADD KEY `abgerechnet` (`abgerechnet`), ADD KEY `abrechnen` (`abrechnen`), ADD KEY `adresse` (`adresse`);


--
-- Indizes für die Tabelle `zwischenlager`
--
ALTER TABLE `zwischenlager`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `abrechnungsartikel`
--
ALTER TABLE `abrechnungsartikel`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `accordion`
--
ALTER TABLE `accordion`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `adapterbox`
--
ALTER TABLE `adapterbox`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `adapterbox_log`
--
ALTER TABLE `adapterbox_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `adresse`
--
ALTER TABLE `adresse`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `adresse_accounts`
--
ALTER TABLE `adresse_accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `adresse_import`
--
ALTER TABLE `adresse_import`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `adresse_kontakhistorie`
--
ALTER TABLE `adresse_kontakhistorie`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `adresse_kontakte`
--
ALTER TABLE `adresse_kontakte`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `adresse_rolle`
--
ALTER TABLE `adresse_rolle`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `angebot`
--
ALTER TABLE `angebot`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `angebot_position`
--
ALTER TABLE `angebot_position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `angebot_protokoll`
--
ALTER TABLE `angebot_protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `ansprechpartner`
--
ALTER TABLE `ansprechpartner`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `arbeitspaket`
--
ALTER TABLE `arbeitspaket`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `artikel`
--
ALTER TABLE `artikel`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT für Tabelle `artikeleinheit`
--
ALTER TABLE `artikeleinheit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `artikelgruppen`
--
ALTER TABLE `artikelgruppen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `artikel_artikelgruppe`
--
ALTER TABLE `artikel_artikelgruppe`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `artikel_permanenteinventur`
--
ALTER TABLE `artikel_permanenteinventur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `artikel_shop`
--
ALTER TABLE `artikel_shop`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `aufgabe`
--
ALTER TABLE `aufgabe`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `aufgabe_erledigt`
--
ALTER TABLE `aufgabe_erledigt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `auftrag`
--
ALTER TABLE `auftrag`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `auftrag_position`
--
ALTER TABLE `auftrag_position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `auftrag_protokoll`
--
ALTER TABLE `auftrag_protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `backup`
--
ALTER TABLE `backup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `bene`
--
ALTER TABLE `bene`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `berichte`
--
ALTER TABLE `berichte`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `bestellung`
--
ALTER TABLE `bestellung`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `bestellung_position`
--
ALTER TABLE `bestellung_position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `bestellung_protokoll`
--
ALTER TABLE `bestellung_protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `calendar`
--
ALTER TABLE `calendar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `chargenverwaltung`
--
ALTER TABLE `chargenverwaltung`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `chat`
--
ALTER TABLE `chat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `datei`
--
ALTER TABLE `datei`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `datei_stichwoerter`
--
ALTER TABLE `datei_stichwoerter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `datei_version`
--
ALTER TABLE `datei_version`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `device_jobs`
--
ALTER TABLE `device_jobs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `dokumente`
--
ALTER TABLE `dokumente`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `dokumente_send`
--
ALTER TABLE `dokumente_send`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `drucker`
--
ALTER TABLE `drucker`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `drucker_spooler`
--
ALTER TABLE `drucker_spooler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `einkaufspreise`
--
ALTER TABLE `einkaufspreise`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `etiketten`
--
ALTER TABLE `etiketten`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `event`
--
ALTER TABLE `event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `event_api`
--
ALTER TABLE `event_api`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `exportvorlage`
--
ALTER TABLE `exportvorlage`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `firma`
--
ALTER TABLE `firma`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `firmendaten`
--
ALTER TABLE `firmendaten`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `geschaeftsbrief_vorlagen`
--
ALTER TABLE `geschaeftsbrief_vorlagen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `gpsstechuhr`
--
ALTER TABLE `gpsstechuhr`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `gruppen`
--
ALTER TABLE `gruppen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `gutschrift`
--
ALTER TABLE `gutschrift`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `gutschrift_position`
--
ALTER TABLE `gutschrift_position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `gutschrift_protokoll`
--
ALTER TABLE `gutschrift_protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `importvorlage`
--
ALTER TABLE `importvorlage`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `importvorlage_log`
--
ALTER TABLE `importvorlage_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `inhalt`
--
ALTER TABLE `inhalt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `interne_events`
--
ALTER TABLE `interne_events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `jqcalendar`
--
ALTER TABLE `jqcalendar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `kalender`
--
ALTER TABLE `kalender`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `kalender_event`
--
ALTER TABLE `kalender_event`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `kalender_user`
--
ALTER TABLE `kalender_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `kostenstelle`
--
ALTER TABLE `kostenstelle`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `kostenstellen`
--
ALTER TABLE `kostenstellen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `kostenstelle_buchung`
--
ALTER TABLE `kostenstelle_buchung`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `kundevorlage`
--
ALTER TABLE `kundevorlage`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lager`
--
ALTER TABLE `lager`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lagermindestmengen`
--
ALTER TABLE `lagermindestmengen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lager_bewegung`
--
ALTER TABLE `lager_bewegung`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lager_charge`
--
ALTER TABLE `lager_charge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lager_differenzen`
--
ALTER TABLE `lager_differenzen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lager_mindesthaltbarkeitsdatum`
--
ALTER TABLE `lager_mindesthaltbarkeitsdatum`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lager_platz`
--
ALTER TABLE `lager_platz`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lager_platz_inhalt`
--
ALTER TABLE `lager_platz_inhalt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lager_reserviert`
--
ALTER TABLE `lager_reserviert`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `lieferadressen`
--
ALTER TABLE `lieferadressen`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lieferantvorlage`
--
ALTER TABLE `lieferantvorlage`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lieferschein`
--
ALTER TABLE `lieferschein`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lieferschein_position`
--
ALTER TABLE `lieferschein_position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `lieferschein_protokoll`
--
ALTER TABLE `lieferschein_protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `linkeditor`
--
ALTER TABLE `linkeditor`
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `logdatei`
--
ALTER TABLE `logdatei`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `logfile`
--
ALTER TABLE `logfile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `module_lock`
--
ALTER TABLE `module_lock`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `newsletter_blacklist`
--
ALTER TABLE `newsletter_blacklist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `objekt_protokoll`
--
ALTER TABLE `objekt_protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `offenevorgaenge`
--
ALTER TABLE `offenevorgaenge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `paketannahme`
--
ALTER TABLE `paketannahme`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `paketdistribution`
--
ALTER TABLE `paketdistribution`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `pdfmirror_md5pool`
--
ALTER TABLE `pdfmirror_md5pool`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `pinwand`
--
ALTER TABLE `pinwand`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `pinwand_user`
--
ALTER TABLE `pinwand_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT für Tabelle `projekt`
--
ALTER TABLE `projekt`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `projekt_inventar`
--
ALTER TABLE `projekt_inventar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `protokoll`
--
ALTER TABLE `protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `prozessstarter`
--
ALTER TABLE `prozessstarter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `rechnung`
--
ALTER TABLE `rechnung`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `rechnung_position`
--
ALTER TABLE `rechnung_position`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `rechnung_protokoll`
--
ALTER TABLE `rechnung_protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `reisekostenart`
--
ALTER TABLE `reisekostenart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT für Tabelle `shopexport`
--
ALTER TABLE `shopexport`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `shopexport_kampange`
--
ALTER TABLE `shopexport_kampange`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `shopexport_status`
--
ALTER TABLE `shopexport_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `shopimport_auftraege`
--
ALTER TABLE `shopimport_auftraege`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `shopnavigation`
--
ALTER TABLE `shopnavigation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `stechuhr`
--
ALTER TABLE `stechuhr`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `stueckliste`
--
ALTER TABLE `stueckliste`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `stundensatz`
--
ALTER TABLE `stundensatz`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `systemlog`
--
ALTER TABLE `systemlog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `textvorlagen`
--
ALTER TABLE `textvorlagen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `uebersetzung`
--
ALTER TABLE `uebersetzung`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `unterprojekt`
--
ALTER TABLE `unterprojekt`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `userrights`
--
ALTER TABLE `userrights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `uservorlage`
--
ALTER TABLE `uservorlage`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `uservorlagerights`
--
ALTER TABLE `uservorlagerights`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `ustprf`
--
ALTER TABLE `ustprf`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `ustprf_protokoll`
--
ALTER TABLE `ustprf_protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `verkaufspreise`
--
ALTER TABLE `verkaufspreise`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `verrechnungsart`
--
ALTER TABLE `verrechnungsart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `versand`
--
ALTER TABLE `versand`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `versandpakete`
--
ALTER TABLE `versandpakete`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT für Tabelle `webmail`
--
ALTER TABLE `webmail`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `webmail_mails`
--
ALTER TABLE `webmail_mails`
MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `webmail_zuordnungen`
--
ALTER TABLE `webmail_zuordnungen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `wiedervorlage`
--
ALTER TABLE `wiedervorlage`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `wiedervorlage_protokoll`
--
ALTER TABLE `wiedervorlage_protokoll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `wiki`
--
ALTER TABLE `wiki`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `zeiterfassung`
--
ALTER TABLE `zeiterfassung`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `zwischenlager`
--
ALTER TABLE `zwischenlager`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Daten für Tabelle `projekt`
--

INSERT INTO `projekt` (`id`, `name`, `abkuerzung`, `verantwortlicher`, `beschreibung`, `sonstiges`, `aktiv`, `farbe`, `autoversand`, `checkok`, `portocheck`, `automailrechnung`, `checkname`, `zahlungserinnerung`, `zahlungsmailbedinungen`, `folgebestaetigung`, `stornomail`, `kundenfreigabe_loeschen`, `autobestellung`, `speziallieferschein`, `lieferscheinbriefpapier`, `speziallieferscheinbeschriftung`, `firma`, `geloescht`, `logdatei`, `steuersatz_normal`, `steuersatz_zwischen`, `steuersatz_ermaessigt`, `steuersatz_starkermaessigt`, `steuersatz_dienstleistung`, `waehrung`, `eigenesteuer`, `druckerlogistikstufe1`, `druckerlogistikstufe2`, `selbstabholermail`, `eanherstellerscan`, `reservierung`, `verkaufszahlendiagram`, `oeffentlich`, `shopzwangsprojekt`, `kunde`, `dpdkundennr`, `dhlkundennr`, `dhlformat`, `dpdformat`, `paketmarke_einzeldatei`, `dpdpfad`, `dhlpfad`, `upspfad`, `dhlintodb`, `intraship_enabled`, `intraship_drucker`, `intraship_testmode`, `intraship_user`, `intraship_signature`, `intraship_ekp`, `intraship_api_user`, `intraship_api_password`, `intraship_company_name`, `intraship_street_name`, `intraship_street_number`, `intraship_zip`, `intraship_country`, `intraship_city`, `intraship_email`, `intraship_phone`, `intraship_internet`, `intraship_contact_person`, `intraship_account_owner`, `intraship_account_number`, `intraship_bank_code`, `intraship_bank_name`, `intraship_iban`, `intraship_bic`, `intraship_WeightInKG`, `intraship_LengthInCM`, `intraship_WidthInCM`, `intraship_HeightInCM`, `intraship_PackageType`, `abrechnungsart`, `kommissionierverfahren`, `wechselaufeinstufig`, `projektuebergreifendkommisionieren`, `absendeadresse`, `absendename`, `absendesignatur`, `autodruckrechnung`, `autodruckversandbestaetigung`, `automailversandbestaetigung`, `autodrucklieferschein`, `automaillieferschein`, `autodruckstorno`, `autodruckanhang`, `automailanhang`, `autodruckerrechnung`, `autodruckerlieferschein`, `autodruckeranhang`, `autodruckrechnungmenge`, `autodrucklieferscheinmenge`, `eigenernummernkreis`, `next_angebot`, `next_auftrag`, `next_rechnung`, `next_lieferschein`, `next_arbeitsnachweis`, `next_reisekosten`, `next_bestellung`, `next_gutschrift`, `next_kundennummer`, `next_lieferantennummer`, `next_mitarbeiternummer`, `next_waren`, `next_produktion`, `next_sonstiges`, `next_anfrage`, `next_artikelnummer`, `gesamtstunden_max`, `auftragid`, `dhlzahlungmandant`, `dhlretourenschein`, `land`, `etiketten_positionen`, `etiketten_drucker`, `etiketten_art`, `seriennummernerfassen`, `versandzweigeteilt`, `nachnahmecheck`, `kasse_lieferschein_anlegen`, `kasse_lagerprozess`, `kasse_belegausgabe`, `kasse_preisgruppe`, `kasse_text_bemerkung`, `kasse_text_freitext`, `kasse_drucker`, `kasse_lieferschein`, `kasse_rechnung`, `kasse_lieferschein_doppel`, `kasse_lager`, `kasse_konto`, `kasse_laufkundschaft`, `kasse_rabatt_artikel`, `kasse_zahlung_bar`, `kasse_zahlung_ec`, `kasse_zahlung_kreditkarte`, `kasse_zahlung_ueberweisung`, `kasse_zahlung_paypal`, `kasse_extra_keinbeleg`, `kasse_extra_rechnung`, `kasse_extra_quittung`, `kasse_extra_gutschein`, `kasse_extra_rabatt_prozent`, `kasse_extra_rabatt_euro`, `kasse_adresse_erweitert`, `kasse_zahlungsauswahl_zwang`, `kasse_button_entnahme`, `kasse_button_trinkgeld`, `kasse_vorauswahl_anrede`, `kasse_erweiterte_lagerabfrage`, `filialadresse`, `versandprojektfiliale`, `differenz_auslieferung_tage`, `autostuecklistenanpassung`, `dpdendung`, `dhlendung`, `tracking_substr_start`, `tracking_remove_kundennummer`, `tracking_substr_length`, `go_drucker`, `go_apiurl_prefix`, `go_apiurl_postfix`, `go_apiurl_user`, `go_username`, `go_password`, `go_ax4nr`, `go_name1`, `go_name2`, `go_abteilung`, `go_strasse1`, `go_strasse2`, `go_hausnummer`, `go_plz`, `go_ort`, `go_land`, `go_standardgewicht`, `go_format`, `go_ausgabe`, `intraship_exportgrund`, `billsafe_merchantId`, `billsafe_merchantLicenseSandbox`, `billsafe_merchantLicenseLive`, `billsafe_applicationSignature`, `billsafe_applicationVersion`, `secupay_apikey`, `secupay_url`, `secupay_demo`) VALUES
(1, 'Standard Projekt', 'STANDARD', '', 'Standard Projekt', '', '', '#92b73c', 0, 0, 0, 0, '', 0, '', 0, 0, 0, 0, 0, 0, 0, 1, 0, '', 19.00, 7.00, 7.00, 7.00, 7.00, 'EUR', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, '', '', '', '', 0, '', '', '0', 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, '', 'keine', 'lieferscheinlager', 0, 0, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0.00, 0, '', 0, 'DE', 0, 0, 0, 1, 0, 1, 0, 'kein', 'kein', 0, 'Interne Bemerkung', 'Text auf Beleg', 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 1, 1, 0, 0, 'herr', 0, 0, 0, 2, 1, '.csv', '.csv', 8, 1, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0.00, '', '', '', '', '', '', '', '', '', '', 0);

UPDATE `projekt` SET `kommissionierverfahren` = 'lieferschein' where `id` = 1;

INSERT INTO `adresse` (`id`, `typ`, `marketingsperre`, `trackingsperre`, `rechnungsadresse`, `sprache`, `name`, `abteilung`, `unterabteilung`, `ansprechpartner`, `land`, `strasse`, `ort`, `plz`, `telefon`, `telefax`, `mobil`, `email`, `ustid`, `ust_befreit`, `passwort_gesendet`, `sonstiges`, `adresszusatz`, `kundenfreigabe`, `steuer`, `logdatei`, `kundennummer`, `lieferantennummer`, `mitarbeiternummer`, `konto`, `blz`, `bank`, `inhaber`, `swift`, `iban`, `waehrung`, `paypal`, `paypalinhaber`, `paypalwaehrung`, `projekt`, `partner`, `zahlungsweise`, `zahlungszieltage`, `zahlungszieltageskonto`, `zahlungszielskonto`, `versandart`, `kundennummerlieferant`, `zahlungsweiselieferant`, `zahlungszieltagelieferant`, `zahlungszieltageskontolieferant`, `zahlungszielskontolieferant`, `versandartlieferant`, `geloescht`, `firma`, `webid`, `vorname`, `kennung`, `sachkonto`, `freifeld1`, `freifeld2`, `freifeld3`, `filiale`, `vertrieb`, `innendienst`, `verbandsnummer`, `abweichendeemailab`, `portofrei_aktiv`, `portofreiab`, `infoauftragserfassung`, `mandatsreferenz`, `mandatsreferenzdatum`, `mandatsreferenzaenderung`, `glaeubigeridentnr`, `kreditlimit`, `tour`, `zahlungskonditionen_festschreiben`, `rabatte_festschreiben`, `mlmaktiv`, `mlmvertragsbeginn`, `mlmlizenzgebuehrbis`, `mlmfestsetzenbis`, `mlmfestsetzen`, `mlmmindestpunkte`, `mlmwartekonto`, `abweichende_rechnungsadresse`, `rechnung_vorname`, `rechnung_name`, `rechnung_titel`, `rechnung_typ`, `rechnung_strasse`, `rechnung_ort`, `rechnung_plz`, `rechnung_ansprechpartner`, `rechnung_land`, `rechnung_abteilung`, `rechnung_unterabteilung`, `rechnung_adresszusatz`, `rechnung_telefon`, `rechnung_telefax`, `rechnung_anschreiben`, `rechnung_email`, `geburtstag`, `rolledatum`, `liefersperre`, `liefersperregrund`, `mlmpositionierung`, `steuernummer`, `steuerbefreit`, `mlmmitmwst`, `mlmabrechnung`, `mlmwaehrungauszahlung`, `mlmauszahlungprojekt`, `sponsor`, `geworbenvon`, `logfile`, `kalender_aufgaben`, `verrechnungskontoreisekosten`, `usereditid`, `useredittimestamp`, `rabatt`, `provision`, `rabattinformation`, `rabatt1`, `rabatt2`, `rabatt3`, `rabatt4`, `rabatt5`, `internetseite`, `bonus1`, `bonus1_ab`, `bonus2`, `bonus2_ab`, `bonus3`, `bonus3_ab`, `bonus4`, `bonus4_ab`, `bonus5`, `bonus5_ab`, `bonus6`, `bonus6_ab`, `bonus7`, `bonus7_ab`, `bonus8`, `bonus8_ab`, `bonus9`, `bonus9_ab`, `bonus10`, `bonus10_ab`, `rechnung_periode`, `rechnung_anzahlpapier`, `rechnung_permail`, `titel`, `anschreiben`, `nachname`, `arbeitszeitprowoche`, `folgebestaetigungsperre`, `lieferantennummerbeikunde`, `verein_mitglied_seit`, `verein_mitglied_bis`, `verein_mitglied_aktiv`, `verein_spendenbescheinigung`, `freifeld4`, `freifeld5`, `freifeld6`, `freifeld7`, `freifeld8`, `freifeld9`, `freifeld10`, `rechnung_papier`, `angebot_cc`, `auftrag_cc`, `rechnung_cc`, `gutschrift_cc`, `lieferschein_cc`, `bestellung_cc`, `angebot_fax_cc`, `auftrag_fax_cc`, `rechnung_fax_cc`, `gutschrift_fax_cc`, `lieferschein_fax_cc`, `bestellung_fax_cc`, `abperfax`, `abpermail`, `kassiereraktiv`, `kassierernummer`, `kassiererprojekt`, `portofreilieferant_aktiv`, `portofreiablieferant`, `mandatsreferenzart`, `mandatsreferenzwdhart`, `serienbrief`) VALUES
(1, '', '', 0, 0, '', 'Administrator', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, '', '', 0, '', '2015-10-26 14:19:35', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 0, '', '', '', '', '', '', '', '', '', '', '', 0, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, '', '', NULL, 0, '', 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0.00, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0.00, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', 0, '', 0, 0, 0.00, '', '', 0);

INSERT INTO `user` (`id`, `username`, `password`, `repassword`, `description`, `settings`, `parentuser`, `activ`, `type`, `adresse`, `fehllogins`, `standarddrucker`, `firma`, `logdatei`, `startseite`, `hwtoken`, `hwkey`, `hwcounter`, `motppin`, `motpsecret`, `passwordmd5`, `externlogin`, `projekt_bevorzugen`, `email_bevorzugen`, `projekt`, `rfidtag`, `vorlage`, `kalender_passwort`, `kalender_ausblenden`, `kalender_aktiv`, `gpsstechuhr`, `standardetikett`, `standardfax`, `internebezeichnung`, `hwdatablock`) VALUES
(1, 'admin', 'qnvEQ1sFWNdIg', 0, 'Administrator', 'firstinstall', 0, 1, 'admin', 1, 0, 0, 1, '2015-10-26 14:21:04', NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', 1, 0, 1, 0, '', NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL);


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


--
-- Daten für Tabelle `prozessstarter`
--

INSERT INTO `prozessstarter` (`id`, `bezeichnung`, `bedingung`, `art`, `startzeit`, `letzteausfuerhung`, `periode`, `typ`, `parameter`, `aktiv`, `mutex`, `mutexcounter`, `firma`, `art_filter`) VALUES
(1, 'Tickets', '', 'periodisch', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'cronjob', 'tickets', 0, 0, 0, 1, ''),
(2, 'E-Mails ', '', 'periodisch', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', 'cronjob', 'emailbackup', 0, 0, 0, 1, ''),
(3, 'Aufgaben Erinnerung', '', 'periodisch', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', 'cronjob', 'aufgabenmails', 0, 0, 0, 1, ''),
(4, 'Lagerzahlen (Shops)', '', 'periodisch', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5', 'cronjob', 'lagerzahlen', 0, 0, 0, 1, ''),
(5, 'Zahlungsmail', '', 'uhrzeit', '2015-10-25 13:00:00', '0000-00-00 00:00:00', '', 'cronjob', 'zahlungsmail', 0, 0, 0, 1, ''),
(6, 'Überzahlte Rechnungen', '', 'uhrzeit', '2015-10-25 23:00:00', '0000-00-00 00:00:00', '', 'cronjob', 'ueberzahlterechnungen', 0, 0, 0, 1, ''),
(7, 'Umsatzstatistik', '', 'uhrzeit', '2015-10-25 23:30:00', '0000-00-00 00:00:00', '', 'cronjob', 'umsatzstatistik', 0, 0, 0, 1, ''),
(8, 'Paketmarken Tracking Download', '', 'uhrzeit', '2015-10-25 14:00:00', '0000-00-00 00:00:00', '', 'cronjob', 'wgettracking', 0, 0, 0, 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

