-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 17. August 2009 um 21:35
-- Server Version: 5.0.51
-- PHP-Version: 5.2.4-2ubuntu5.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `eprooSystem`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
  `id` int(10) NOT NULL auto_increment,
  `typ` varchar(255) NOT NULL,
  `marketingsperre` varchar(255) NOT NULL,
  `sprache` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `sonstiges` text NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `steuer` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL default CURRENT_TIMESTAMP on update 
CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adresse_kontakhistorie`
--

CREATE TABLE IF NOT EXISTS `adresse_kontakhistorie` (
  `id` int(10) NOT NULL auto_increment,
  `adresse_id` int(10) NOT NULL,
  `grund` varchar(255) NOT NULL,
  `beschreibung` text NOT NULL,
  `mitarbeiter` int(10) NOT NULL,
  `datum` datetime NOT NULL,
  `logdatei` timestamp NOT NULL default CURRENT_TIMESTAMP on update 
CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id` int(10) NOT NULL auto_increment,
  `typ` varchar(255) NOT NULL,
  `nummer` varchar(255) NOT NULL,
  `aktiv` varchar(255) NOT NULL,
  `warengruppe` varchar(255) NOT NULL,
  `name_de` varchar(255) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `kurztext_de` text NOT NULL,
  `kurztext_en` text NOT NULL,
  `beschreibung_de` text NOT NULL,
  `beschreibung_en` text NOT NULL,
  `herstellerlink` varchar(255) NOT NULL,
  `teilbar` varchar(255) NOT NULL,
  `nteile` varchar(255) NOT NULL,
  `seriennummern` varchar(255) NOT NULL,
  `standardlager` varchar(255) NOT NULL,
  `lieferzeit` varchar(255) NOT NULL,
  `sonstiges` text NOT NULL,
  `gewicht` varchar(255) NOT NULL,
  `endmontage` varchar(255) NOT NULL,
  `funktionstest` varchar(255) NOT NULL,
  `artikelcheckliste` varchar(255) NOT NULL,
  `chargenverwaltung` varchar(255) NOT NULL,
  `provisionsartikel` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL default CURRENT_TIMESTAMP on update 
CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag`
--

CREATE TABLE IF NOT EXISTS `auftrag` (
  `id` int(10) NOT NULL auto_increment,
  `bearbeiter` varchar(255) NOT NULL,
  `autoversand` varchar(255) NOT NULL,
  `datum` varchar(255) NOT NULL,
  `abweichendelieferadresse` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `versandart` varchar(255) NOT NULL,
  `projekt` varchar(255) NOT NULL,
  `kostenstelle` varchar(255) NOT NULL,
  `zahlungsweise` varchar(255) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `sprache` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `abteilung` varchar(255) NOT NULL,
  `unterabteilung` varchar(255) NOT NULL,
  `land` varchar(255) NOT NULL,
  `strasse` varchar(255) NOT NULL,
  `ort` varchar(255) NOT NULL,
  `plz` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `telefax` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ustid` varchar(255) NOT NULL,
  `sonstiges` text NOT NULL,
  `adresszusatz` varchar(255) NOT NULL,
  `steuer` varchar(255) NOT NULL,
  `liefertyp` varchar(255) NOT NULL,
  `liefername` varchar(255) NOT NULL,
  `liefervorname` varchar(255) NOT NULL,
  `lieferabteilung` varchar(255) NOT NULL,
  `lieferunterabteilung` varchar(255) NOT NULL,
  `lieferland` varchar(255) NOT NULL,
  `lieferstrasse` varchar(255) NOT NULL,
  `lieferort` varchar(255) NOT NULL,
  `lieferplz` varchar(255) NOT NULL,
  `lieferadresszuatz` varchar(255) NOT NULL,
  `logdatei` timestamp NOT NULL default CURRENT_TIMESTAMP on update 
CURRENT_TIMESTAMP,
  `autofreigabe` int(1) NOT NULL default '0',
  `freigabe` int(1) NOT NULL default '0',
  `vollstaendig` int(1) NOT NULL,
  `nachbesserung` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=100008 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag_artikel`
--

CREATE TABLE IF NOT EXISTS `auftrag_artikel` (
  `id` int(10) NOT NULL auto_increment,
  `auftrag` varchar(255) NOT NULL,
  `artikel` varchar(255) NOT NULL,
  `menge` varchar(255) NOT NULL,
  `preis` varchar(255) NOT NULL,
  `rabatt` varchar(255) NOT NULL,
  `versendet` varchar(255) NOT NULL,
  `seriennummer` varchar(255) NOT NULL,
  `endmontage` varchar(255) NOT NULL,
  `artikelcheckliste` varchar(255) NOT NULL,
  `funktionstest` varchar(255) NOT NULL,
  `chargenverwaltung` varchar(255) NOT NULL,
  `lager` varchar(255) NOT NULL,
  `position` int(10) NOT NULL,
  `logdatei` timestamp NOT NULL default CURRENT_TIMESTAMP on update 
CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `emailbackup`
--

CREATE TABLE IF NOT EXISTS `emailbackup` (
  `id` int(10) NOT NULL auto_increment,
  `benutzername` varchar(255) NOT NULL,
  `passwort` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `loeschtage` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `emailbackup_mails`
--

CREATE TABLE IF NOT EXISTS `emailbackup_mails` (
  `id` int(15) NOT NULL auto_increment,
  `emailbackup` int(10) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `action` text NOT NULL,
  `action_html` text NOT NULL,
  `empfang` datetime NOT NULL,
  `anhang` varchar(255) NOT NULL,
  `checksum` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1289 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kostenstelle`
--

CREATE TABLE IF NOT EXISTS `kostenstelle` (
  `id` int(10) NOT NULL auto_increment,
  `bezeichnung` varchar(255) NOT NULL,
  `projekt` varchar(255) NOT NULL,
  `verantwortlicher` varchar(255) NOT NULL,
  `logdatei` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kostenstelle_buchung`
--

CREATE TABLE IF NOT EXISTS `kostenstelle_buchung` (
  `id` int(10) NOT NULL auto_increment,
  `kostenstelle` int(10) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `datum` varchar(255) NOT NULL,
  `buchungstext` varchar(255) NOT NULL,
  `sonstiges` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `logdatei`
--

CREATE TABLE IF NOT EXISTS `logdatei` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `befehl` varchar(255) NOT NULL,
  `statement` varchar(255) NOT NULL,
  `app` blob NOT NULL,
  `zeit` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=951 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projekt`
--

CREATE TABLE IF NOT EXISTS `projekt` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `abkuerzung` varchar(255) NOT NULL,
  `verantwortlicher` text NOT NULL,
  `beschreibung` varchar(255) NOT NULL,
  `sonstiges` varchar(255) NOT NULL,
  `aktiv` varchar(255) NOT NULL,
  `logdatei` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(10) NOT NULL auto_increment,
  `schluessel` varchar(255) NOT NULL,
  `zeit` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `sprache` varchar(255) NOT NULL,
  `projekt` varchar(255) NOT NULL,
  `bearbeiter` varchar(255) NOT NULL,
  `betreff` varchar(255) NOT NULL,
  `tickettext` text NOT NULL,
  `quelle` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `zugewiesen` varchar(255) NOT NULL,
  `adresse` int(10) NOT NULL,
  `mailadresse` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket_nachricht`
--

CREATE TABLE IF NOT EXISTS `ticket_nachricht` (
  `id` int(11) NOT NULL auto_increment,
  `ticket` int(10) NOT NULL,
  `mitarbeiter` varchar(255) NOT NULL,
  `zeit` timestamp NOT NULL default CURRENT_TIMESTAMP on update 
CURRENT_TIMESTAMP,
  `antwort` text NOT NULL,
  `bemerkung` text NOT NULL,
  `versendet` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `unterprojekt`
--

CREATE TABLE IF NOT EXISTS `unterprojekt` (
  `id` int(10) NOT NULL auto_increment,
  `projekt` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `verantwortlicher` varchar(255) NOT NULL,
  `aktiv` varchar(255) NOT NULL,
  `position` int(10) NOT NULL,
  `logdatei` timestamp NOT NULL default CURRENT_TIMESTAMP on update 
CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(100) default NULL,
  `password` varchar(255) default NULL,
  `description` varchar(255) default NULL,
  `settings` text NOT NULL,
  `parentuser` int(11) default NULL,
  `activ` int(11) default '0',
  `type` varchar(100) default '',
  `person` int(20) NOT NULL,
  `logdatei` timestamp NOT NULL default CURRENT_TIMESTAMP on update 
CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1009 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `useronline`
--

CREATE TABLE IF NOT EXISTS `useronline` (
  `user_id` int(5) NOT NULL default '0',
  `login` int(1) NOT NULL default '0',
  `sessionid` varchar(255) NOT NULL default '',
  `ip` varchar(200) NOT NULL default '',
  `time` datetime NOT NULL default '0000-00-00 00:00:00',
  `logdatei` timestamp NOT NULL default CURRENT_TIMESTAMP on update 
CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

