-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 29. Dez 2014 um 21:51
-- Server Version: 5.5.29
-- PHP-Version: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `wawision_oss_3_0`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `abrechnungsartikel`
--

CREATE TABLE IF NOT EXISTS `abrechnungsartikel` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `accordion`
--

CREATE TABLE IF NOT EXISTS `accordion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `position` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adapterbox_log`
--

CREATE TABLE IF NOT EXISTS `adapterbox_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(64) NOT NULL DEFAULT '',
  `meldung` varchar(64) NOT NULL DEFAULT '',
  `seriennummer` varchar(64) NOT NULL DEFAULT '',
  `device` varchar(64) NOT NULL DEFAULT '',
  `datum` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `kundennummer` varchar(64) NOT NULL,
  `lieferantennummer` varchar(64) NOT NULL,
  `mitarbeiternummer` varchar(64) NOT NULL,
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
  `rechnung_vorname` varchar(255) DEFAULT NULL,
  `rechnung_name` varchar(255) DEFAULT NULL,
  `rechnung_titel` varchar(255) DEFAULT NULL,
  `rechnung_typ` varchar(255) DEFAULT NULL,
  `rechnung_strasse` varchar(255) DEFAULT NULL,
  `rechnung_ort` varchar(255) DEFAULT NULL,
  `rechnung_plz` varchar(64) DEFAULT NULL,
  `rechnung_ansprechpartner` varchar(255) DEFAULT NULL,
  `rechnung_land` varchar(255) DEFAULT NULL,
  `rechnung_abteilung` varchar(255) DEFAULT NULL,
  `rechnung_unterabteilung` varchar(255) DEFAULT NULL,
  `rechnung_adresszusatz` varchar(255) DEFAULT NULL,
  `rechnung_telefon` varchar(255) DEFAULT NULL,
  `rechnung_telefax` varchar(255) DEFAULT NULL,
  `rechnung_anschreiben` varchar(255) DEFAULT NULL,
  `rechnung_email` varchar(255) DEFAULT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_import`
--

CREATE TABLE IF NOT EXISTS `adresse_import` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `abgeschlossen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_kontakhistorie`
--

CREATE TABLE IF NOT EXISTS `adresse_kontakhistorie` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `adresse` int(10) NOT NULL,
  `grund` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `datum` datetime NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_kontakte`
--

CREATE TABLE IF NOT EXISTS `adresse_kontakte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) DEFAULT NULL,
  `bezeichnung` varchar(1024) DEFAULT NULL,
  `kontakt` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_rolle`
--

CREATE TABLE IF NOT EXISTS `adresse_rolle` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `adresse` int(10) NOT NULL,
  `projekt` int(11) NOT NULL,
  `subjekt` varchar(255) NOT NULL,
  `praedikat` varchar(255) NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `von` date NOT NULL,
  `bis` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebot`
--

CREATE TABLE IF NOT EXISTS `angebot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebot_position`
--

CREATE TABLE IF NOT EXISTS `angebot_position` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `angebot_protokoll`
--

CREATE TABLE IF NOT EXISTS `angebot_protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `angebot` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ansprechpartner`
--

CREATE TABLE IF NOT EXISTS `ansprechpartner` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `adresse` varchar(10) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mobil` varchar(255) DEFAULT NULL,
  `titel` varchar(1024) DEFAULT NULL,
  `anschreiben` varchar(1024) DEFAULT NULL,
  `ansprechpartner_land` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arbeitspaket`
--

CREATE TABLE IF NOT EXISTS `arbeitspaket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `auftragid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikeleigenschaften`
--

CREATE TABLE IF NOT EXISTS `artikeleigenschaften` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(16) NOT NULL DEFAULT '',
  `projekt` int(11) NOT NULL DEFAULT '0',
  `geloescht` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikeleinheit`
--

CREATE TABLE IF NOT EXISTS `artikeleinheit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `einheit_de` varchar(255) DEFAULT NULL,
  `internebemerkung` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikelgruppen`
--

CREATE TABLE IF NOT EXISTS `artikelgruppen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(255) NOT NULL,
  `bezeichnung_en` varchar(255) NOT NULL,
  `shop` int(11) NOT NULL,
  `aktiv` int(1) NOT NULL,
  `beschreibung_de` text,
  `beschreibung_en` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikelkategorien`
--

CREATE TABLE IF NOT EXISTS `artikelkategorien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(64) NOT NULL DEFAULT '',
  `next_nummer` varchar(128) NOT NULL DEFAULT '',
  `projekt` int(11) NOT NULL DEFAULT '0',
  `geloescht` tinyint(1) NOT NULL DEFAULT '0',
  `externenummer` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel_artikelgruppe`
--

CREATE TABLE IF NOT EXISTS `artikel_artikelgruppe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) NOT NULL,
  `artikelgruppe` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `geloescht` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel_shop`
--

CREATE TABLE IF NOT EXISTS `artikel_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) NOT NULL,
  `shop` int(11) NOT NULL,
  `checksum` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aufgabe`
--

CREATE TABLE IF NOT EXISTS `aufgabe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `stunden` int(11) NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aufgabe_erledigt`
--

CREATE TABLE IF NOT EXISTS `aufgabe_erledigt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `aufgabe` int(11) NOT NULL,
  `abgeschlossen_am` date NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag`
--

CREATE TABLE IF NOT EXISTS `auftrag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  KEY `kennen` (`kennen`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag_position`
--

CREATE TABLE IF NOT EXISTS `auftrag_position` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  KEY `menge` (`menge`,`geliefert`),
  KEY `auftrag` (`auftrag`,`artikel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag_protokoll`
--

CREATE TABLE IF NOT EXISTS `auftrag_protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auftrag` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `autorechnungsdruck`
--

CREATE TABLE IF NOT EXISTS `autorechnungsdruck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date DEFAULT NULL,
  `erstellt_von` varchar(255) NOT NULL DEFAULT '',
  `art` int(1) NOT NULL DEFAULT '0',
  `gruppe` int(11) NOT NULL DEFAULT '0',
  `gesperrt` int(1) NOT NULL DEFAULT '0',
  `gemailt` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `autorechnungsdruck_rechnung`
--

CREATE TABLE IF NOT EXISTS `autorechnungsdruck_rechnung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autorechnungsdruck` int(11) DEFAULT NULL,
  `rechnung` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `autoresponder_blacklist`
--

CREATE TABLE IF NOT EXISTS `autoresponder_blacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cachetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mailaddress` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `dateiname` varchar(2048) NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
,`projekt` varchar(255)
,`typ` varchar(12)
);
-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bene`
--

CREATE TABLE IF NOT EXISTS `bene` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `berichte`
--

CREATE TABLE IF NOT EXISTS `berichte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `beschreibung` text,
  `internebemerkung` text,
  `struktur` text,
  `spaltennamen` varchar(1024) DEFAULT NULL,
  `spaltenbreite` varchar(1024) DEFAULT NULL,
  `spaltenausrichtung` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE IF NOT EXISTS `bestellung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung_position`
--

CREATE TABLE IF NOT EXISTS `bestellung_position` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  KEY `bestellung` (`bestellung`,`artikel`),
  KEY `abgeschlossen` (`abgeschlossen`),
  KEY `status` (`status`),
  KEY `geliefert` (`geliefert`),
  KEY `menge` (`menge`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung_protokoll`
--

CREATE TABLE IF NOT EXISTS `bestellung_protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bestellung` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `chargenverwaltung`
--

CREATE TABLE IF NOT EXISTS `chargenverwaltung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) NOT NULL,
  `bestellung` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datei`
--

CREATE TABLE IF NOT EXISTS `datei` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titel` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `geloescht` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `firma` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datei_stichwoerter`
--

CREATE TABLE IF NOT EXISTS `datei_stichwoerter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datei` int(10) NOT NULL,
  `subjekt` varchar(255) NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datei_version`
--

CREATE TABLE IF NOT EXISTS `datei_version` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `datei` int(10) NOT NULL,
  `ersteller` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `version` int(5) NOT NULL,
  `dateiname` varchar(255) NOT NULL,
  `bemerkung` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datev_buchungen`
--

CREATE TABLE IF NOT EXISTS `datev_buchungen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wkz` varchar(255) NOT NULL,
  `umsatz` decimal(10,2) NOT NULL,
  `gegenkonto` int(255) NOT NULL,
  `belegfeld1` varchar(255) NOT NULL,
  `belegfeld2` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `konto` varchar(255) NOT NULL,
  `haben` int(1) NOT NULL,
  `kost1` varchar(255) NOT NULL,
  `kost2` varchar(255) NOT NULL,
  `kostmenge` varchar(255) NOT NULL,
  `skonto` decimal(10,2) NOT NULL,
  `buchungstext` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `exportiert` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `kontoauszug` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `device_jobs`
--

CREATE TABLE IF NOT EXISTS `device_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deviceidsource` varchar(64) DEFAULT '',
  `deviceiddest` varchar(64) DEFAULT '',
  `job` longtext NOT NULL,
  `zeitstempel` datetime DEFAULT NULL,
  `abgeschlossen` tinyint(1) NOT NULL DEFAULT '0',
  `art` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dokumente`
--

CREATE TABLE IF NOT EXISTS `dokumente` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dokumente_send`
--

CREATE TABLE IF NOT EXISTS `dokumente_send` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `dateiid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `drucker`
--

CREATE TABLE IF NOT EXISTS `drucker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dta`
--

CREATE TABLE IF NOT EXISTS `dta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `datum` date NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `konto` varchar(64) NOT NULL,
  `blz` varchar(64) NOT NULL,
  `betrag` decimal(10,2) NOT NULL,
  `vz1` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vz2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `vz3` varchar(255) CHARACTER SET utf8 NOT NULL,
  `lastschrift` int(1) NOT NULL,
  `gutschrift` int(1) NOT NULL,
  `kontointern` int(10) NOT NULL,
  `datei` int(11) NOT NULL,
  `status` varchar(64) CHARACTER SET utf8 NOT NULL,
  `firma` int(11) NOT NULL,
  `waehrung` varchar(3) CHARACTER SET utf8 NOT NULL DEFAULT 'EUR',
  `verbindlichkeit` int(11) NOT NULL DEFAULT '0',
  `rechnung` int(11) NOT NULL DEFAULT '0',
  `mandatsreferenzaenderung` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dta_datei`
--

CREATE TABLE IF NOT EXISTS `dta_datei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `inhalt` text NOT NULL,
  `datum` datetime NOT NULL,
  `status` varchar(64) NOT NULL,
  `art` varchar(255) NOT NULL,
  `firma` int(11) NOT NULL,
  `konto` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dta_datei_verband`
--

CREATE TABLE IF NOT EXISTS `dta_datei_verband` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date DEFAULT NULL,
  `bemerkung` text NOT NULL,
  `dateiname` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `betreff` varchar(255) NOT NULL DEFAULT '',
  `nachricht` text NOT NULL,
  `datum_versendet` date DEFAULT NULL,
  `status` varchar(64) NOT NULL DEFAULT '',
  `verband` int(11) NOT NULL DEFAULT '0',
  `projekt` int(11) NOT NULL DEFAULT '0',
  `variante` int(11) NOT NULL DEFAULT '0',
  `partnerid` varchar(255) NOT NULL DEFAULT '',
  `kundennummer` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eigenschaften`
--

CREATE TABLE IF NOT EXISTS `eigenschaften` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) NOT NULL DEFAULT '0',
  `art` int(11) NOT NULL DEFAULT '0',
  `bezeichnung` varchar(64) DEFAULT '',
  `beschreibung` text,
  `menge` decimal(10,4) DEFAULT '0.0000',
  `einheit` varchar(64) DEFAULT '',
  `menge2` decimal(10,4) DEFAULT '0.0000',
  `einheit2` varchar(64) DEFAULT '',
  `menge3` decimal(10,4) DEFAULT '0.0000',
  `einheit3` varchar(64) DEFAULT '',
  `wert` varchar(64) DEFAULT '',
  `wert2` varchar(64) DEFAULT '',
  `wert3` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `einkaufspreise`
--

CREATE TABLE IF NOT EXISTS `einkaufspreise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `emailbackup`
--

CREATE TABLE IF NOT EXISTS `emailbackup` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `benutzername` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `smtp` varchar(255) NOT NULL,
  `ticket` int(1) NOT NULL,
  `autoresponder` int(1) NOT NULL,
  `geschaeftsbriefvorlage` int(11) NOT NULL,
  `autoresponderbetreff` varchar(255) NOT NULL,
  `autorespondertext` text NOT NULL,
  `projekt` int(11) NOT NULL,
  `emailbackup` int(1) NOT NULL,
  `adresse` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `loeschtage` varchar(255) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `ticketqueue` varchar(255) DEFAULT NULL,
  `ticketprojekt` varchar(255) DEFAULT NULL,
  `email` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `emailbackup_mails`
--

CREATE TABLE IF NOT EXISTS `emailbackup_mails` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `webmail` int(10) NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sender` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `action` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `action_html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `empfang` datetime NOT NULL,
  `anhang` varchar(255) NOT NULL,
  `gelesen` int(1) NOT NULL,
  `checksum` varchar(255) NOT NULL,
  `adresse` int(11) NOT NULL,
  `spam` int(1) NOT NULL,
  `antworten` int(1) NOT NULL,
  `phpobj` text NOT NULL,
  `flattenedparts` longblob,
  `attachment` longblob,
  `geloescht` int(1) NOT NULL DEFAULT '0',
  `warteschlange` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `etiketten`
--

CREATE TABLE IF NOT EXISTS `etiketten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beschreibung` varchar(255) NOT NULL,
  `kategorie` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event_api`
--

CREATE TABLE IF NOT EXISTS `event_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cachetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `eventname` varchar(255) DEFAULT NULL,
  `parameter` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `retries` int(11) DEFAULT NULL,
  `kommentar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exportvorlage`
--

CREATE TABLE IF NOT EXISTS `exportvorlage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `firma`
--

CREATE TABLE IF NOT EXISTS `firma` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `standardprojekt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `firmendaten`
--

CREATE TABLE IF NOT EXISTS `firmendaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `geschaeftsbrief_vorlagen`
--

CREATE TABLE IF NOT EXISTS `geschaeftsbrief_vorlagen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sprache` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `subjekt` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gpsstechuhr`
--

CREATE TABLE IF NOT EXISTS `gpsstechuhr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `koordinaten` varchar(512) DEFAULT NULL,
  `zeit` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gruppen`
--

CREATE TABLE IF NOT EXISTS `gruppen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gutschrift`
--

CREATE TABLE IF NOT EXISTS `gutschrift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gutschrift_position`
--

CREATE TABLE IF NOT EXISTS `gutschrift_position` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gutschrift_protokoll`
--

CREATE TABLE IF NOT EXISTS `gutschrift_protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gutschrift` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `importvorlage`
--

CREATE TABLE IF NOT EXISTS `importvorlage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `inhalt`
--

CREATE TABLE IF NOT EXISTS `inhalt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `navigation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `jqcalendar`
--

CREATE TABLE IF NOT EXISTS `jqcalendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `ort` varchar(255) NOT NULL,
  `von` datetime NOT NULL,
  `bis` datetime NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kalender`
--

CREATE TABLE IF NOT EXISTS `kalender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT 'default',
  `farbe` varchar(15) NOT NULL DEFAULT '3300ff',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kalender_event`
--

CREATE TABLE IF NOT EXISTS `kalender_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kalender` int(11) NOT NULL DEFAULT '0',
  `bezeichnung` varchar(255) NOT NULL,
  `beschreibung` longtext,
  `von` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bis` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `allDay` tinyint(1) NOT NULL DEFAULT '0',
  `color` varchar(7) NOT NULL DEFAULT '#6F93DB',
  `public` int(1) NOT NULL DEFAULT '0',
  `ort` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kalender_user`
--

CREATE TABLE IF NOT EXISTS `kalender_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event` int(11) NOT NULL,
  `userid` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kasse`
--

CREATE TABLE IF NOT EXISTS `kasse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `auswahl` varchar(255) NOT NULL,
  `betrag` decimal(10,2) NOT NULL,
  `adresse` int(11) NOT NULL,
  `grund` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `steuergruppe` int(1) NOT NULL,
  `exportiert` int(1) NOT NULL,
  `exportiert_datum` date NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `konto` int(11) NOT NULL DEFAULT '1',
  `nummer` int(11) NOT NULL DEFAULT '0',
  `wert` decimal(10,2) NOT NULL DEFAULT '0.00',
  `steuersatz` decimal(10,2) NOT NULL DEFAULT '0.00',
  `betrag_brutto_normal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `betrag_steuer_normal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `betrag_brutto_ermaessigt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `betrag_steuer_ermaessigt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `betrag_brutto_befreit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `betrag_steuer_befreit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tagesabschluss` tinyint(1) NOT NULL DEFAULT '0',
  `storniert` tinyint(1) NOT NULL DEFAULT '0',
  `storniert_grund` varchar(255) NOT NULL DEFAULT '',
  `storniert_bearbeiter` varchar(64) NOT NULL DEFAULT '',
  `sachkonto` varchar(64) NOT NULL DEFAULT '',
  `bemerkung` text NOT NULL,
  `belegdatum` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kasse_log`
--

CREATE TABLE IF NOT EXISTS `kasse_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kasseid` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `beschreibung` varchar(255) NOT NULL DEFAULT '',
  `betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `wert` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `konfiguration`
--

CREATE TABLE IF NOT EXISTS `konfiguration` (
  `name` varchar(255) NOT NULL,
  `wert` text NOT NULL,
  `adresse` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `konten`
--

CREATE TABLE IF NOT EXISTS `konten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(255) NOT NULL,
  `kurzbezeichnung` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `erstezeile` text NOT NULL,
  `datevkonto` int(10) NOT NULL,
  `blz` varchar(255) NOT NULL,
  `konto` varchar(255) NOT NULL,
  `swift` varchar(255) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `lastschrift` int(1) NOT NULL,
  `hbci` int(1) NOT NULL,
  `hbcikennung` text NOT NULL,
  `inhaber` varchar(255) NOT NULL,
  `aktiv` int(1) NOT NULL,
  `keineemail` int(1) NOT NULL,
  `firma` int(1) NOT NULL,
  `schreibbar` int(1) NOT NULL DEFAULT '1',
  `importtrennzeichen` varchar(255) DEFAULT NULL,
  `codierung` varchar(255) DEFAULT NULL,
  `importerstezeilenummer` int(11) DEFAULT NULL,
  `importdatenmaskierung` varchar(255) DEFAULT NULL,
  `glaeubiger` varchar(64) DEFAULT NULL,
  `importfelddatum` varchar(255) DEFAULT NULL,
  `importfelddatumformat` varchar(255) DEFAULT NULL,
  `importfelddatumformatausgabe` varchar(255) DEFAULT NULL,
  `importfeldbetrag` varchar(255) DEFAULT NULL,
  `importfeldbetragformat` varchar(255) DEFAULT NULL,
  `importfeldbuchungstext` varchar(255) DEFAULT NULL,
  `importfeldbuchungstextformat` varchar(255) DEFAULT NULL,
  `importfeldwaehrung` varchar(255) DEFAULT NULL,
  `importfeldwaehrungformat` varchar(255) DEFAULT NULL,
  `importfeldhabensollkennung` varchar(10) NOT NULL DEFAULT '',
  `importfeldkennunghaben` varchar(10) NOT NULL DEFAULT '',
  `importfeldkennungsoll` varchar(10) NOT NULL DEFAULT '',
  `importextrahabensoll` tinyint(1) NOT NULL DEFAULT '0',
  `importfeldhaben` varchar(10) NOT NULL DEFAULT '',
  `importfeldsoll` varchar(10) NOT NULL DEFAULT '',
  `importletztenzeilenignorieren` int(11) NOT NULL DEFAULT '0',
  `liveimport` text,
  `liveimport_online` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kontoauszuege`
--

CREATE TABLE IF NOT EXISTS `kontoauszuege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `konto` int(11) NOT NULL,
  `buchung` date NOT NULL,
  `vorgang` text NOT NULL,
  `soll` decimal(10,2) NOT NULL,
  `haben` decimal(10,2) NOT NULL,
  `gebuehr` decimal(10,2) NOT NULL,
  `waehrung` varchar(255) NOT NULL,
  `fertig` int(1) NOT NULL,
  `datev_abgeschlossen` int(1) NOT NULL,
  `buchungstext` varchar(255) NOT NULL,
  `gegenkonto` varchar(255) NOT NULL,
  `belegfeld1` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `mailbenachrichtigung` int(11) NOT NULL,
  `pruefsumme` text NOT NULL,
  `internebemerkung` text,
  `importfehler` int(1) DEFAULT NULL,
  `importgroup` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kontoauszuege_zahlungsausgang`
--

CREATE TABLE IF NOT EXISTS `kontoauszuege_zahlungsausgang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `betrag` decimal(10,2) NOT NULL,
  `datum` date NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` int(11) NOT NULL,
  `kontoauszuege` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `abgeschlossen` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kontoauszuege_zahlungseingang`
--

CREATE TABLE IF NOT EXISTS `kontoauszuege_zahlungseingang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `betrag` decimal(10,2) NOT NULL,
  `datum` date NOT NULL,
  `objekt` varchar(255) NOT NULL,
  `parameter` int(11) NOT NULL,
  `kontoauszuege` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `abgeschlossen` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kontorahmen`
--

CREATE TABLE IF NOT EXISTS `kontorahmen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sachkonto` varchar(16) NOT NULL DEFAULT '',
  `beschriftung` varchar(64) NOT NULL DEFAULT '',
  `bemerkung` text NOT NULL,
  `ausblenden` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kostenstelle`
--

CREATE TABLE IF NOT EXISTS `kostenstelle` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(255) NOT NULL,
  `projekt` varchar(255) NOT NULL,
  `verantwortlicher` varchar(255) NOT NULL,
  `logdatei` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kostenstellen`
--

CREATE TABLE IF NOT EXISTS `kostenstellen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nummer` varchar(20) DEFAULT NULL,
  `beschreibung` varchar(512) DEFAULT NULL,
  `internebemerkung` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kostenstelle_buchung`
--

CREATE TABLE IF NOT EXISTS `kostenstelle_buchung` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kostenstelle` int(10) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `datum` varchar(255) NOT NULL,
  `buchungstext` varchar(255) NOT NULL,
  `sonstiges` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kundevorlage`
--

CREATE TABLE IF NOT EXISTS `kundevorlage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlungszielskonto` int(11) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager`
--

CREATE TABLE IF NOT EXISTS `lager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `manuell` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_bewegung`
--

CREATE TABLE IF NOT EXISTS `lager_bewegung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_charge`
--

CREATE TABLE IF NOT EXISTS `lager_charge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charge` varchar(1024) DEFAULT NULL,
  `datum` date DEFAULT NULL,
  `artikel` int(11) DEFAULT NULL,
  `menge` int(11) NOT NULL,
  `lager_platz` int(11) DEFAULT NULL,
  `zwischenlagerid` int(11) DEFAULT NULL,
  `internebemerkung` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_differenzen`
--

CREATE TABLE IF NOT EXISTS `lager_differenzen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) DEFAULT NULL,
  `eingang` decimal(10,4) DEFAULT NULL,
  `ausgang` decimal(10,4) DEFAULT NULL,
  `berechnet` decimal(10,4) DEFAULT NULL,
  `bestand` decimal(10,4) DEFAULT NULL,
  `differenz` decimal(10,4) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_mindesthaltbarkeitsdatum`
--

CREATE TABLE IF NOT EXISTS `lager_mindesthaltbarkeitsdatum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date DEFAULT NULL,
  `mhddatum` date DEFAULT NULL,
  `artikel` int(11) DEFAULT NULL,
  `menge` int(11) NOT NULL,
  `lager_platz` int(11) DEFAULT NULL,
  `zwischenlagerid` int(11) DEFAULT NULL,
  `charge` varchar(1024) DEFAULT NULL,
  `internebemerkung` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_platz`
--

CREATE TABLE IF NOT EXISTS `lager_platz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_platz_inhalt`
--

CREATE TABLE IF NOT EXISTS `lager_platz_inhalt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lager_platz` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `bestellung` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `inventur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artikel` (`artikel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_reserviert`
--

CREATE TABLE IF NOT EXISTS `lager_reserviert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `reserviertdatum` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `adresse` (`adresse`,`artikel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lager_seriennummern`
--

CREATE TABLE IF NOT EXISTS `lager_seriennummern` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) DEFAULT NULL,
  `lager_platz` int(11) DEFAULT NULL,
  `zwischenlagerid` int(11) DEFAULT NULL,
  `seriennummer` text,
  `charge` varchar(1024) DEFAULT NULL,
  `mhddatum` date DEFAULT NULL,
  `internebemerkung` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferadressen`
--

CREATE TABLE IF NOT EXISTS `lieferadressen` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `standardlieferadresse` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferantvorlage`
--

CREATE TABLE IF NOT EXISTS `lieferantvorlage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `zahlungszielskonto` int(11) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferschein`
--

CREATE TABLE IF NOT EXISTS `lieferschein` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferschein_position`
--

CREATE TABLE IF NOT EXISTS `lieferschein_position` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lieferschein_protokoll`
--

CREATE TABLE IF NOT EXISTS `lieferschein_protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lieferschein` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `linkeditor`
--

CREATE TABLE IF NOT EXISTS `linkeditor` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `rule` varchar(1024) NOT NULL,
  `replacewith` varchar(1024) NOT NULL,
  `active` varchar(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `logdatei`
--

CREATE TABLE IF NOT EXISTS `logdatei` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `befehl` varchar(255) NOT NULL,
  `statement` varchar(255) NOT NULL,
  `app` blob NOT NULL,
  `zeit` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `logfile`
--

CREATE TABLE IF NOT EXISTS `logfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meldung` text NOT NULL,
  `dump` text NOT NULL,
  `module` varchar(64) NOT NULL DEFAULT '',
  `action` varchar(64) NOT NULL DEFAULT '',
  `bearbeiter` varchar(64) NOT NULL DEFAULT '',
  `funktionsname` varchar(64) NOT NULL DEFAULT '',
  `datum` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mlm_abrechnung`
--

CREATE TABLE IF NOT EXISTS `mlm_abrechnung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `von` date DEFAULT NULL,
  `bis` date DEFAULT NULL,
  `betrag_netto` decimal(10,2) DEFAULT NULL,
  `punkte` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bonuspunkte` decimal(10,2) NOT NULL DEFAULT '0.00',
  `anzahl` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mlm_abrechnung_adresse`
--

CREATE TABLE IF NOT EXISTS `mlm_abrechnung_adresse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL DEFAULT '0',
  `belegnr` int(11) NOT NULL DEFAULT '0',
  `betrag_netto` decimal(10,2) DEFAULT NULL,
  `mitsteuer` int(1) DEFAULT NULL,
  `mlmabrechnung` varchar(64) DEFAULT NULL,
  `alteposition` varchar(64) DEFAULT NULL,
  `neueposition` varchar(64) DEFAULT NULL,
  `abrechnung` int(11) NOT NULL DEFAULT '0',
  `waehrung` varchar(3) NOT NULL DEFAULT 'EUR',
  `punkte` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bonuspunkte` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rechnung_name` varchar(64) DEFAULT NULL,
  `rechnung_strasse` varchar(64) DEFAULT NULL,
  `rechnung_ort` varchar(64) DEFAULT NULL,
  `rechnung_plz` varchar(64) DEFAULT NULL,
  `rechnung_land` varchar(64) DEFAULT NULL,
  `steuernummer` varchar(64) DEFAULT NULL,
  `steuersatz` decimal(10,2) NOT NULL DEFAULT '0.00',
  `projekt` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mlm_abrechnung_log`
--

CREATE TABLE IF NOT EXISTS `mlm_abrechnung_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL DEFAULT '0',
  `abrechnung` int(11) NOT NULL DEFAULT '0',
  `meldung` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mlm_positionierung`
--

CREATE TABLE IF NOT EXISTS `mlm_positionierung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL DEFAULT '0',
  `positionierung` varchar(255) NOT NULL DEFAULT '',
  `datum` date DEFAULT NULL,
  `erneuert` date DEFAULT NULL,
  `temporaer` tinyint(1) NOT NULL DEFAULT '0',
  `rueckgaengig` tinyint(1) NOT NULL DEFAULT '0',
  `mlm_abrechnung` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mlm_wartekonto`
--

CREATE TABLE IF NOT EXISTS `mlm_wartekonto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL DEFAULT '0',
  `artikel` int(11) NOT NULL DEFAULT '0',
  `bezeichnung` varchar(255) NOT NULL DEFAULT '',
  `beschreibung` text NOT NULL,
  `betrag` decimal(10,2) DEFAULT NULL,
  `abrechnung` int(11) NOT NULL DEFAULT '0',
  `autoabrechnung` tinyint(1) NOT NULL DEFAULT '0',
  `abgerechnet` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `newslettercache`
--

CREATE TABLE IF NOT EXISTS `newslettercache` (
  `checksum` text NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `newsletter_blacklist`
--

CREATE TABLE IF NOT EXISTS `newsletter_blacklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `offenevorgaenge`
--

CREATE TABLE IF NOT EXISTS `offenevorgaenge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL,
  `beschriftung` text NOT NULL,
  `linkremove` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `paketannahme`
--

CREATE TABLE IF NOT EXISTS `paketannahme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `paketdistribution`
--

CREATE TABLE IF NOT EXISTS `paketdistribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `partner`
--

CREATE TABLE IF NOT EXISTS `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `bezeichnung` varchar(255) NOT NULL,
  `netto` decimal(10,2) NOT NULL,
  `tage` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `geloescht` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `partner_verkauf`
--

CREATE TABLE IF NOT EXISTS `partner_verkauf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auftrag` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `partner` int(11) NOT NULL,
  `freigabe` int(1) NOT NULL,
  `abgerechnet` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produktion`
--

CREATE TABLE IF NOT EXISTS `produktion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `zahlungszielskonto` int(11) NOT NULL,
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
  `bezeichnung` varchar(255) DEFAULT NULL,
  `datumproduktion` date DEFAULT NULL,
  `anschreiben` varchar(255) DEFAULT NULL,
  `usereditid` int(11) DEFAULT NULL,
  `useredittimestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `reservierart` varchar(255) DEFAULT NULL,
  `auslagerart` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produktionslager`
--

CREATE TABLE IF NOT EXISTS `produktionslager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `bemerkung` varchar(255) NOT NULL,
  `status` varchar(64) NOT NULL,
  `bestellung_pos` int(11) NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `produzent` varchar(255) NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produktion_position`
--

CREATE TABLE IF NOT EXISTS `produktion_position` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `produktion` int(11) NOT NULL,
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
  `geliefert_menge` int(11) NOT NULL,
  `explodiert` int(1) NOT NULL,
  `explodiert_parent` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nachbestelltexternereinkauf` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `artikel` (`artikel`),
  KEY `produktion` (`produktion`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produktion_protokoll`
--

CREATE TABLE IF NOT EXISTS `produktion_protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produktion` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projekt`
--

CREATE TABLE IF NOT EXISTS `projekt` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `kommissionierverfahren` varchar(255) DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  KEY `abkuerzung` (`abkuerzung`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projekt_inventar`
--

CREATE TABLE IF NOT EXISTS `projekt_inventar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `bestellung` int(11) NOT NULL,
  `projekt` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `mitarbeiter` varchar(255) NOT NULL,
  `vpe` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `protokoll`
--

CREATE TABLE IF NOT EXISTS `protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meldung` text NOT NULL,
  `dump` text NOT NULL,
  `module` varchar(64) NOT NULL DEFAULT '',
  `action` varchar(64) NOT NULL DEFAULT '',
  `bearbeiter` varchar(64) NOT NULL DEFAULT '',
  `funktionsname` varchar(64) NOT NULL DEFAULT '',
  `datum` datetime DEFAULT NULL,
  `parameter` int(11) NOT NULL DEFAULT '0',
  `argumente` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `prozessstarter`
--

CREATE TABLE IF NOT EXISTS `prozessstarter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung`
--

CREATE TABLE IF NOT EXISTS `rechnung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung_position`
--

CREATE TABLE IF NOT EXISTS `rechnung_position` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung_protokoll`
--

CREATE TABLE IF NOT EXISTS `rechnung_protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rechnung` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `grund` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reisekostenart`
--

CREATE TABLE IF NOT EXISTS `reisekostenart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nummer` varchar(20) DEFAULT NULL,
  `beschreibung` varchar(512) DEFAULT NULL,
  `internebemerkung` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rma`
--

CREATE TABLE IF NOT EXISTS `rma` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `projekt` varchar(222) NOT NULL,
  `belegnr` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `freigabe` int(1) NOT NULL,
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
  `ustid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `kundennummer` varchar(255) NOT NULL,
  `lieferantennummer` varchar(255) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `zahlungszieltage` int(11) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `bestellbestaetigung` int(1) NOT NULL,
  `freitext` varchar(255) NOT NULL,
  `zahlungszielskonto` int(11) NOT NULL,
  `zahlungszieltageskonto` int(11) NOT NULL,
  `bestellbestaetigungsdatum` date NOT NULL,
  `lieferdatum` date NOT NULL,
  `einkaeufer` varchar(255) NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rma_artikel`
--

CREATE TABLE IF NOT EXISTS `rma_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `wareneingang` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `lieferschein` int(11) NOT NULL,
  `pos` int(11) NOT NULL,
  `wunsch` varchar(255) NOT NULL,
  `bemerkung` text NOT NULL,
  `artikel` int(11) NOT NULL,
  `status` varchar(64) NOT NULL,
  `angelegtam` date NOT NULL,
  `menge` int(11) NOT NULL,
  `techniker` text NOT NULL,
  `buchhaltung` text NOT NULL,
  `abgeschlossen` int(1) NOT NULL,
  `firma` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `seriennummern`
--

CREATE TABLE IF NOT EXISTS `seriennummern` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seriennummer` varchar(255) NOT NULL,
  `adresse` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `beschreibung` varchar(255) NOT NULL,
  `lieferung` date NOT NULL,
  `lieferschein` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL DEFAULT '0',
  `zuweisen` int(11) NOT NULL DEFAULT '0',
  `ansprechpartner` varchar(255) NOT NULL DEFAULT '',
  `nummer` varchar(64) DEFAULT NULL,
  `prio` varchar(10) NOT NULL DEFAULT 'niedrig',
  `eingangart` varchar(10) NOT NULL DEFAULT '',
  `datum` datetime DEFAULT NULL,
  `erledigenbis` date DEFAULT NULL,
  `betreff` varchar(255) NOT NULL DEFAULT '',
  `beschreibung_html` longtext NOT NULL,
  `internebemerkung` longtext NOT NULL,
  `antwortankunden` longtext NOT NULL,
  `angelegtvonuser` int(11) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'angelegt',
  `artikel` int(11) NOT NULL DEFAULT '0',
  `seriennummer` varchar(255) NOT NULL DEFAULT '',
  `antwortpermail` tinyint(1) NOT NULL DEFAULT '0',
  `antwortankundenempfaenger` varchar(64) NOT NULL DEFAULT '',
  `antwortankundenkopie` varchar(64) NOT NULL DEFAULT '',
  `antwortankundenblindkopie` varchar(64) NOT NULL DEFAULT '',
  `antwortankundenbetreff` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nummer` (`nummer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopexport`
--

CREATE TABLE IF NOT EXISTS `shopexport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopexport_kampange`
--

CREATE TABLE IF NOT EXISTS `shopexport_kampange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `geloescht` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopexport_status`
--

CREATE TABLE IF NOT EXISTS `shopexport_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artikelexport` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `bemerkung` text NOT NULL,
  `befehl` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopimport_auftraege`
--

CREATE TABLE IF NOT EXISTS `shopimport_auftraege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `extid` int(11) NOT NULL,
  `sessionid` varchar(255) NOT NULL,
  `warenkorb` text NOT NULL,
  `imported` int(1) NOT NULL,
  `trash` int(1) NOT NULL,
  `projekt` int(11) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `shopnavigation`
--

CREATE TABLE IF NOT EXISTS `shopnavigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(255) NOT NULL,
  `position` int(11) NOT NULL,
  `parent` int(11) NOT NULL,
  `bezeichnung_en` varchar(255) NOT NULL,
  `plugin` varchar(255) NOT NULL,
  `pluginparameter` varchar(255) NOT NULL,
  `shop` int(11) NOT NULL,
  `target` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stechuhr`
--

CREATE TABLE IF NOT EXISTS `stechuhr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` datetime DEFAULT NULL,
  `adresse` int(11) NOT NULL DEFAULT '0',
  `user` int(11) NOT NULL DEFAULT '0',
  `kommen` tinyint(1) NOT NULL DEFAULT '0',
  `uebernommen` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stueckliste`
--

CREATE TABLE IF NOT EXISTS `stueckliste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL,
  `artikel` int(11) NOT NULL,
  `referenz` text NOT NULL,
  `place` varchar(255) NOT NULL,
  `layer` varchar(255) NOT NULL,
  `stuecklistevonartikel` int(11) NOT NULL,
  `menge` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `wert` text NOT NULL,
  `bauform` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stundensatz`
--

CREATE TABLE IF NOT EXISTS `stundensatz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `satz` float NOT NULL,
  `typ` varchar(255) NOT NULL,
  `projekt` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `schluessel` varchar(255) NOT NULL,
  `zeit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `projekt` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `quelle` varchar(255) NOT NULL,
  `status` varchar(64) NOT NULL,
  `adresse` int(11) NOT NULL,
  `kunde` varchar(255) NOT NULL,
  `warteschlange` varchar(255) NOT NULL,
  `mailadresse` varchar(255) NOT NULL,
  `prio` int(1) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `zugewiesen` int(1) NOT NULL,
  `inbearbeitung` int(1) NOT NULL,
  `inbearbeitung_user` varchar(255) NOT NULL,
  `firma` int(11) NOT NULL,
  `notiz` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `schluessel` (`schluessel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket_nachricht`
--

CREATE TABLE IF NOT EXISTS `ticket_nachricht` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket` varchar(255) NOT NULL,
  `verfasser` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `zeit` datetime NOT NULL,
  `zeitausgang` datetime NOT NULL,
  `text` text NOT NULL,
  `textausgang` text NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `bemerkung` text NOT NULL,
  `medium` varchar(255) NOT NULL,
  `versendet` varchar(255) NOT NULL,
  `status` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket` (`ticket`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket_vorlage`
--

CREATE TABLE IF NOT EXISTS `ticket_vorlage` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `projekt` int(10) NOT NULL,
  `vorlagenname` varchar(255) NOT NULL,
  `vorlage` text NOT NULL,
  `firma` int(11) NOT NULL,
  `sichtbar` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `umsatzstatistik`
--

CREATE TABLE IF NOT EXISTS `umsatzstatistik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL DEFAULT '0',
  `adresse` int(11) NOT NULL DEFAULT '0',
  `objekt` varchar(64) NOT NULL DEFAULT '',
  `belegnr` varchar(64) NOT NULL DEFAULT '',
  `kundennummer` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(64) NOT NULL DEFAULT '',
  `parameter` int(11) NOT NULL DEFAULT '0',
  `betrag_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `betrag_brutto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `erloes_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deckungsbeitrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `datum` date DEFAULT NULL,
  `waehrung` varchar(3) NOT NULL DEFAULT 'EUR',
  `gruppe` int(11) NOT NULL DEFAULT '0',
  `projekt` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `unterprojekt`
--

CREATE TABLE IF NOT EXISTS `unterprojekt` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `projekt` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `verantwortlicher` varchar(255) NOT NULL,
  `aktiv` varchar(255) NOT NULL,
  `position` int(10) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `hwdatablock` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userrights`
--

CREATE TABLE IF NOT EXISTS `userrights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `module` varchar(64) NOT NULL,
  `action` varchar(64) NOT NULL,
  `permission` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_2` (`user`,`module`,`action`,`permission`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `uservorlage`
--

CREATE TABLE IF NOT EXISTS `uservorlage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bezeichnung` varchar(255) DEFAULT NULL,
  `beschreibung` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `uservorlagerights`
--

CREATE TABLE IF NOT EXISTS `uservorlagerights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vorlage` int(11) DEFAULT NULL,
  `module` varchar(64) DEFAULT NULL,
  `action` varchar(64) DEFAULT NULL,
  `permission` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ustprf`
--

CREATE TABLE IF NOT EXISTS `ustprf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `logdatei` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ustprf_protokoll`
--

CREATE TABLE IF NOT EXISTS `ustprf_protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ustprf_id` int(11) NOT NULL,
  `zeit` datetime NOT NULL,
  `bemerkung` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `logdatei` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verbindlichkeit`
--

CREATE TABLE IF NOT EXISTS `verbindlichkeit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rechnung` varchar(255) NOT NULL,
  `zahlbarbis` date NOT NULL,
  `betrag` decimal(10,2) NOT NULL,
  `umsatzsteuer` varchar(255) NOT NULL,
  `summenormal` decimal(10,4) NOT NULL,
  `summeermaessigt` decimal(10,4) NOT NULL,
  `skonto` decimal(10,2) NOT NULL,
  `skontobis` date NOT NULL,
  `freigabe` int(1) NOT NULL,
  `freigabemitarbeiter` varchar(255) NOT NULL,
  `bestellung` int(11) NOT NULL,
  `adresse` int(11) NOT NULL,
  `status` varchar(64) NOT NULL,
  `bezahlt` int(1) NOT NULL,
  `kontoauszuege` int(11) NOT NULL,
  `firma` int(11) NOT NULL,
  `logdatei` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `rechnungsdatum` date DEFAULT NULL,
  `rechnungsfreigabe` tinyint(1) NOT NULL DEFAULT '0',
  `kostenstelle` varchar(255) DEFAULT NULL,
  `beschreibung` varchar(255) DEFAULT NULL,
  `sachkonto` varchar(64) DEFAULT NULL,
  `art` varchar(64) NOT NULL DEFAULT '',
  `verwendungszweck` varchar(255) DEFAULT NULL,
  `dta_datei` int(11) NOT NULL DEFAULT '0',
  `frachtkosten` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung1` int(1) NOT NULL DEFAULT '0',
  `bestellung1betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung1bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung2` int(1) NOT NULL DEFAULT '0',
  `bestellung2betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung2bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung3` int(1) NOT NULL DEFAULT '0',
  `bestellung3betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung3bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung4` int(1) NOT NULL DEFAULT '0',
  `bestellung4betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung4bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung5` int(1) NOT NULL DEFAULT '0',
  `bestellung5betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung5bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung6` int(1) NOT NULL DEFAULT '0',
  `bestellung6betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung6bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung7` int(1) NOT NULL DEFAULT '0',
  `bestellung7betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung7bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung8` int(1) NOT NULL DEFAULT '0',
  `bestellung8betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung8bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung9` int(1) NOT NULL DEFAULT '0',
  `bestellung9betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung9bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung10` int(1) NOT NULL DEFAULT '0',
  `bestellung10betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung10bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung11` int(1) NOT NULL DEFAULT '0',
  `bestellung11betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung11bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung12` int(1) NOT NULL DEFAULT '0',
  `bestellung12betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung12bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung13` int(1) NOT NULL DEFAULT '0',
  `bestellung13betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung13bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung14` int(1) NOT NULL DEFAULT '0',
  `bestellung14betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung14bemerkung` varchar(255) NOT NULL DEFAULT '',
  `bestellung15` int(1) NOT NULL DEFAULT '0',
  `bestellung15betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bestellung15bemerkung` varchar(255) NOT NULL DEFAULT '',
  `waehrung` varchar(3) NOT NULL DEFAULT 'EUR',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verkaufspreise`
--

CREATE TABLE IF NOT EXISTS `verkaufspreise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `verrechnungsart`
--

CREATE TABLE IF NOT EXISTS `verrechnungsart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nummer` varchar(20) DEFAULT NULL,
  `beschreibung` varchar(512) DEFAULT NULL,
  `internebemerkung` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `versand`
--

CREATE TABLE IF NOT EXISTS `versand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `versandpakete`
--

CREATE TABLE IF NOT EXISTS `versandpakete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `versand` int(11) NOT NULL DEFAULT '0',
  `nr` int(11) NOT NULL DEFAULT '0',
  `tracking` varchar(255) NOT NULL DEFAULT '',
  `versender` varchar(255) NOT NULL DEFAULT '',
  `gewicht` varchar(10) NOT NULL DEFAULT '',
  `bemerkung` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vertreterumsatz`
--

CREATE TABLE IF NOT EXISTS `vertreterumsatz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vertriebid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `adresse` int(11) NOT NULL DEFAULT '0',
  `objekt` varchar(64) NOT NULL DEFAULT '',
  `belegnr` varchar(64) NOT NULL DEFAULT '',
  `name` varchar(64) NOT NULL DEFAULT '',
  `parameter` int(11) NOT NULL DEFAULT '0',
  `betrag_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `betrag_brutto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `erloes_netto` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deckungsbeitrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `datum` date DEFAULT NULL,
  `waehrung` varchar(3) NOT NULL DEFAULT 'EUR',
  `gruppe` int(11) NOT NULL DEFAULT '0',
  `projekt` int(11) NOT NULL DEFAULT '0',
  `provision` decimal(10,2) NOT NULL DEFAULT '0.00',
  `provision_summe` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `warteschlangen`
--

CREATE TABLE IF NOT EXISTS `warteschlangen` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `warteschlange` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `wiedervorlage` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webmail`
--

CREATE TABLE IF NOT EXISTS `webmail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `adresse` int(11) NOT NULL,
  `benutzername` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webmail_mails`
--

CREATE TABLE IF NOT EXISTS `webmail_mails` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
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
  `checksum` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webmail_zuordnungen`
--

CREATE TABLE IF NOT EXISTS `webmail_zuordnungen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` int(11) NOT NULL,
  `zuordnung` varchar(255) NOT NULL,
  `parameter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wiedervorlage`
--

CREATE TABLE IF NOT EXISTS `wiedervorlage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wiedervorlage_protokoll`
--

CREATE TABLE IF NOT EXISTS `wiedervorlage_protokoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vorgaengerid` int(11) DEFAULT NULL,
  `wiedervorlageid` int(11) DEFAULT NULL,
  `adresse_mitarbeier` int(11) NOT NULL DEFAULT '0',
  `erinnerung_alt` datetime DEFAULT NULL,
  `erinnerung_neu` datetime DEFAULT NULL,
  `bezeichnung` varchar(255) NOT NULL DEFAULT '',
  `beschreibung` text NOT NULL,
  `ergebnis` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wiki`
--

CREATE TABLE IF NOT EXISTS `wiki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `content` longtext NOT NULL,
  `lastcontent` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungsavis`
--

CREATE TABLE IF NOT EXISTS `zahlungsavis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date DEFAULT NULL,
  `adresse` int(11) NOT NULL DEFAULT '0',
  `versendet` tinyint(1) NOT NULL DEFAULT '0',
  `versendet_am` date DEFAULT NULL,
  `versendet_per` varchar(64) NOT NULL DEFAULT '',
  `ersteller` varchar(64) NOT NULL DEFAULT '',
  `bic` varchar(64) NOT NULL DEFAULT '',
  `iban` varchar(64) NOT NULL DEFAULT '',
  `projekt` int(11) NOT NULL DEFAULT '0',
  `bemerkung` varchar(255) NOT NULL DEFAULT '',
  `dta_datei` int(11) NOT NULL DEFAULT '0',
  `betrag` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungsavis_gutschrift`
--

CREATE TABLE IF NOT EXISTS `zahlungsavis_gutschrift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zahlungsavis` int(11) NOT NULL DEFAULT '0',
  `gutschrift` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zahlungsavis_rechnung`
--

CREATE TABLE IF NOT EXISTS `zahlungsavis_rechnung` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zahlungsavis` int(11) NOT NULL DEFAULT '0',
  `rechnung` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeiterfassung`
--

CREATE TABLE IF NOT EXISTS `zeiterfassung` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zwischenlager`
--

CREATE TABLE IF NOT EXISTS `zwischenlager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `logdatei` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur des Views `belege`
--
DROP TABLE IF EXISTS `belege`;

CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `belege` AS
select `rechnung`.`id` AS `id`,`rechnung`.`adresse` AS `adresse`,`rechnung`.`datum` AS `datum`,`rechnung`.`belegnr` AS `belegnr`,
`rechnung`.`status` AS `status`,`rechnung`.`land` AS `land`,'rechnung' AS `typ`,umsatz_netto, erloes_netto, deckungsbeitrag, provision_summe, vertriebid,gruppe
 from `rechnung` WHERE `rechnung`.`status`!='angelegt'
union all
select `gutschrift`.`id` AS `id`,`gutschrift`.`adresse` AS `adresse`,`gutschrift`.`datum` AS `datum`,`gutschrift`.`belegnr` AS `belegnr`,
`gutschrift`.`status` AS `status`,`gutschrift`.`land` AS `land`,'gutschrift' AS `typ` ,umsatz_netto*-1,erloes_netto*-1, deckungsbeitrag*-1, provision_summe*-1,vertriebid,gruppe
from `gutschrift` WHERE `gutschrift`.`status`!='angelegt';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
