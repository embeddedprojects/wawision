INSERT INTO `artikelgruppen` (`id`, `bezeichnung`, `bezeichnung_en`, `shop`, `aktiv`) VALUES
(1, 'Zwiebeln', 'Onions', 1, 1),
(2, 'Bananen', 'Bananas', 1, 1),
(3, 'Tomaten', 'Tomatos', 1, 1);

INSERT INTO `artikel` (`id`, `typ`, `nummer`, `checksum`, `projekt`, `inaktiv`, `ausverkauft`, `warengruppe`, `name_de`, `name_en`, `kurztext_de`, `kurztext_en`, `beschreibung_de`, `beschreibung_en`, `uebersicht_de`, `uebersicht_en`, `links_de`, `links_en`, `startseite_de`, `startseite_en`, `standardbild`, `herstellerlink`, `hersteller`, `teilbar`, `nteile`, `seriennummern`, `lager_platz`, `lieferzeit`, `lieferzeitmanuell`, `sonstiges`, `gewicht`, `endmontage`, `funktionstest`, `artikelcheckliste`, `stueckliste`, `juststueckliste`, `barcode`, `hinzugefuegt`, `pcbdecal`, `lagerartikel`, `porto`, `chargenverwaltung`, `provisionsartikel`, `gesperrt`, `sperrgrund`, `geloescht`, `gueltigbis`, `umsatzsteuer`, `klasse`, `adresse`, `shopartikel`, `unishopartikel`, `journalshopartikel`, `shop`, `katalog`, `katalogtext_de`, `katalogtext_en`, `katalogbezeichnung_de`, `katalogbezeichnung_en`, `neu`, `topseller`, `startseite`, `wichtig`, `mindestlager`, `mindestbestellung`, `partnerprogramm_sperre`, `internerkommentar`, `intern_gesperrt`, `intern_gesperrtuser`, `intern_gesperrtgrund`, `inbearbeitung`, `inbearbeitunguser`, `cache_lagerplatzinhaltmenge`, `internkommentar`, `firma`, `logdatei`, `anabregs_text`, `autobestellung`, `produktion`, `herstellernummer`, `restmenge`) VALUES
(1, 'produkt', '700001', '57d77df8056675ff94d73d2320a44034', 2, '', 0, '', 'Rote Tomaten', 'Red Tomatos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'lager', '', '', '', '', '', '', 0, 0, '', '', '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 1, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2012-10-30 16:40:24', '', 0, 0, '', 0),
(2, 'produkt', '700002', '142239180bd5a6cfbddfb24136a069ab', 2, '', 0, '', 'Rote Zwiebeln', 'Red Onion', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'lager', '', '', '', '', '', '', 0, 0, '', '', '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 1, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2012-10-30 16:41:45', '', 0, 0, '', 0),
(3, 'produkt', '700003', 'f57f023e695f074e257639dcc97029ac', 2, '', 0, '', 'Weiße Zwiebeln', 'White Onions', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'lager', '', '', '', '', '', '', 0, 0, '', '', '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 1, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2012-10-30 16:40:24', '', 0, 0, '', 0),
(4, 'produkt', '700004', 'c2fa7659242dafb1931c2320c829a6b8', 2, '', 0, '', 'Junge Tomaten', 'Young Tomatos', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'lager', '', '', '', '', '', '', 0, 0, '', '', '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 1, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2012-10-30 16:40:24', '', 0, 0, '', 0),
(5, 'produkt', '700005', '94f5f73147766d6e04e8919a91f383f9', 2, '', 0, '', 'Ungespritzte Bananen', 'Unsprayed bananas', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'keine', '', 'lager', '', '', '', '', '', '', 0, 0, '', '', '', 0, 0, 0, 0, 0, '', 0, '0000-00-00', '', '', 0, 0, 0, 0, 1, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, '', 0, 0, '', 0, 0, 0, '', 1, '2012-10-30 16:40:24', '', 0, 0, '', 0);

INSERT INTO `verkaufspreise` (`id`, `artikel`, `objekt`, `projekt`, `adresse`, `preis`, `waehrung`, `ab_menge`, `vpe`, `vpe_menge`, `angelegt_am`, `gueltig_bis`, `bemerkung`, `bearbeiter`, `logdatei`, `firma`, `geloescht`) VALUES
(1, 2, '', '', '0', 2.5100, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0),
(2, 3, '', '', '0', 2.9900, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0),
(3, 1, '', '', '0', 1.5500, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0),
(4, 4, '', '', '0', 1.3400, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0),
(5, 5, '', '', '0', 2.3300, 'EUR', 1, '', 0, '0000-00-00', '0000-00-00', '', '', '0000-00-00 00:00:00', 1, 0);

INSERT INTO `artikel_artikelgruppe` (`id`, `artikel`, `artikelgruppe`, `position`, `geloescht`) VALUES
(1, 2, 1, 0, 0),
(2, 1, 2, 0, 0),
(3, 3, 1, 0, 0),
(4, 4, 2, 0, 0),
(5, 5, 3, 0, 0);




