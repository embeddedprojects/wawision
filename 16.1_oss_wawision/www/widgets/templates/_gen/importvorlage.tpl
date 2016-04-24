<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs1"></a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs1">
[MESSAGE]
<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr valign="top" colspan="3">
        <td>
<fieldset><legend>Einstellung</legend>
    <table width="100%" border="0">
   <tr><td width="130">Bezeichnung:</td><td>[BEZEICHNUNG][MSGBEZEICHNUNG]</td><td></td></tr>

   <tr><td width="130">Ziel:</td><td colspan="2">
		[ZIEL][MSGZIEL]&nbsp;<i>(Auswahl Zieltabelle f&uuml;r die Daten)</i></td></tr>
   <tr><td width="130">CSV Daten ab Zeile:</td><td>[IMPORTERSTEZEILENUMMER][MSGIMPORTERSTEZEILENUMMER]&nbsp;<i>Erste Zeile = 1 (Falls Daten in CSV nicht ab Zeile 1 starten, da Feldbezeichnungen o.&auml;. in Dokument vorhanden sind.)</i></td><td></td></tr>
    <tr><td width="130">CSV Trennzeichen:</td><td>[IMPORTTRENNZEICHEN][MSGIMPORTTRENNZEICHEN]</td><td></td></tr>
    <tr><td width="130">CSV Maskierung:</td><td>[IMPORTDATENMASKIERUNG][MSGIMPORTDATENMASKIERUNG]</td><td></td></tr>
      <tr><td width="130">Auswahl Charset:</td><td>[SELCHARSET]</td><td></td></tr>
      <tr><td width="130">Charset:</td><td>[CHARSET][MSGCHARSET]</td><td></td></tr>
    <!--<tr><td width="130">UTF8 Decode:</td><td>[UTF8DECODE][MSGUTF8DECODE]</td><td></td></tr>-->
<tr valign="top"><td width="130">CSV Felder:</td><td><table><tr valign="top"><td>[FIELDS][MSGFIELDS]</td><td><i>Spaltennummer:Feldname;<br>Spaltennummer:Feldname;<br><br>z.B.<br><br>1:lieferantennummer;<br>2:name;<br><br>Spalte 1 aus der CSV Datei soll das Feld lieferantennummer werden. Spalte 2 aus der CSV Datei soll das Feld name werden.</i></td></tr></table></td><td align="center">
</td></tr>
<tr valign="top"><td>Verfügbaren Felder:</td><td colspan="2">
<table width="100%"><tr valign="top"><td><b>Artikel/Einkauf</b>
<ul>
<li><u>nummer</u></li>
<!--<li><u>bestellnummer</u>(vom Hersteller)</li>-->
<!--<li>ekpreis</li>
<li>vkpreis</li>
<li>ab_menge</li>-->
<li>name_de</li>
<li>name_en</li>
<li>kurztext_de</li>
<li>kurztext_en</li>
<li>artikelbeschreibung_de</li>
<li>artikelbeschreibung_en</li>
<li>beschreibung_de</li>
<li>beschreibung_en</li>
<li>anabregs_text</li>
<li>artikelkategorie (id)</li>
<li>internerkommentar</li>
<li>hersteller</li>
<li>typ</li>
<li>herstellerlink</li>
<li>herstellernummer</li>
<li>ean</li>
<li>mindestlager</li>
<li>umsatztsteuer</li>
<li>lieferantname</li>
<li>lieferantbestellnummer</li>
<li>lieferanteinkaufnetto</li>
<li>lieferanteinkaufwaehrung (EUR,CHF,USD,...)</li>
<li>lieferanteinkaufmenge</li>
<li>lieferanteinkaufvpemenge</li>
<li>lieferantennummer</li>
<li>kundennummer</li>
<li>gewicht</li>
<li>einheit</li>
<li>lagerartikel</li>
<li>lager_platz</li>
<li>lager_menge</li>
<li>verkaufspreis1netto</li>
<li>verkaufspreis1menge</li>
<li>verkaufspreis1waehrung (EUR,CHF,USD,...)</li>
<li>verkaufspreis2netto</li>
<li>verkaufspreis2menge</li>
<li>verkaufspreis2waehrung (EUR,CHF,USD,...)</li>
<li>verkaufspreis3netto</li>
<li>verkaufspreis3menge</li>
<li>verkaufspreis3waehrung (EUR,CHF,USD,...)</li>
<li>variante_von <i>(id des Artikels)</i></li>
<li>variante_von_nummer <i>(Nummer des Artikels)</i></li>
<li>projekt</li>
</ul>

</td><td><b>Adressen</b>
<ul>
<li>typ (herr,frau,firma)</li>
<li>marketingsperre</li>
<li>trackingsperre</li>
<li>rechnungsadresse</li>
<li>sprache</li>
<li>name</li>
<li>vorname (falls nicht bei name)</li>
<li>abteilung</li>
<li>unterabteilung</li>
<li>ansprechpartner</li>
<li>land (DE,AT,...)</li>
<li>strasse</li>
<li>strasse_hausnummer</li>
<li>hausnummer</li>
<li>ort</li>
<li>plz</li>
<li>plz_ort</li>
<li>telefon</li>
<li>telefax</li>
<li>mobil</li>
<li>email</li>
<li>ustid</li>
<li>ust_befreit</li>
<li>sonstiges</li>
<li>adresszusatz</li>
<li>kundenfreigabe</li>
<li>steuer</li>
<li>logdatei</li>
<li><u>kundennummer</u></li>
<li><u>lieferantennummer</u></li>
<li>mitarbeiternummer</li>
<li>konto</li>
<li>blz</li>
<li>bank</li>
<li>inhaber</li>
<li>swift</li>
<li>iban</li>
<li>waehrung</li>
<li>paypal</li>
<li>paypalinhaber</li>
<li>paypalwaehrung</li>
<li>projekt</li>
<li>zahlungsweise</li>
<li>zahlungszieltage</li>
<li>zahlungszieltageskonto</li>
<li>zahlungszielskonto</li>
<li>versandart</li>
<li>kundennummerlieferant</li>
<li>zahlungsweiselieferant</li>
<li>zahlungszieltagelieferant</li>
<li>zahlungszieltageskontolieferant</li>
<li>zahlungszielskontolieferant</li>
<li>versandartlieferant</li>
<li>geloescht</li>
<li>firma</li>
<li>webid</li>
<li>internetseite</li>
<li>titel</li>
<li>anschreiben</li>
<li>geburtstag</li>
<li>liefersperre</li>
<li>steuernummer</li>
<li>steuerbefreit</li>
<li>liefersperregrund</li>
<li>verrechnungskontoreisekosten</li>
<li>abweichende_rechnungsadresse</li>
<li>rechnung_vorname</li>
<li>rechnung_name</li>
<li>rechnung_titel</li>
<li>rechnung_typ</li>
<li>rechnung_strasse</li>
<li>rechnung_ort</li>
<li>rechnung_land</li>
<li>rechnung_abteilung</li>
<li>rechnung_unterabteilung</li>
<li>rechnung_adresszusatz</li>
<li>rechnung_telefon</li>
<li>rechnung_telefax</li>
<li>rechnung_anschreiben</li>
<li>rechnung_email</li>
<li>rechnung_plz</li>
<li>rechnung_ansprechpartner</li>
<li>lieferfirma</li>
<li>liefername</li>
<li>lieferstrasse</li>
<li>lieferort</li>
<li>lieferland</li>
<li>lieferabteilung</li>
<li>lieferunterabteilung</li>
<li>lieferadresszusatz</li>
<li>liefertelefon</li>
<li>liefertelefax</li>
<li>lieferansprechpartner</li>
<li>lieferemail</li>
<li>lieferplz</li>
<li>kennung</li>
<li>vertrieb</li>
<li>innendienst</li>
<li>rabatt</li>
<li>rabatt1</li>
<li>rabatt2</li>
<li>rabatt3</li>
<li>rabatt4</li>
<li>rabatt5</li>
<li>bonus1</li>
<li>bonus1_ab</li>
<li>bonus2</li>
<li>bonus2_ab</li>
<li>bonus3</li>
<li>bonus3_ab</li>
<li>bonus4</li>
<li>bonus4_ab</li>
<li>bonus5</li>
<li>bonus5_ab</li>
<li>bonus6</li>
<li>bonus6_ab</li>
<li>bonus7</li>
<li>bonus7_ab</li>
<li>bonus8</li>
<li>bonus8_ab</li>
<li>bonus9</li>
<li>bonus9_ab</li>
<li>bonus10</li>
<li>bonus10_ab</li>
<li>verbandsnummer</li>
<li>portofreiab</li>
<li>zahlungskonditionen_festschreiben</li>
<li>rabatte_festschreiben</li>
<li>provision</li>
<li>portofrei_aktiv</li>
<li>rabattinformation</li>
<li>freifeld1</li>
<li>rechnung_periode</li>
<li>rechnung_anzahlpapier</li>
<li>rechnung_permail</li>
<li>usereditid</li>
<li>useredittimestamp</li>
<li>infoauftragserfassung</li>
<li>mandatsreferenz</li>
<li>glaeubigeridentnr</li>
<li>kreditlimit</li>
<li>tour</li>
<li>freifeld2</li>
<li>freifeld3</li>
<li>abweichendeemailab</li>
<li>filiale</li>
<li>mandatsreferenzdatum</li>
<li>mandatsreferenzaenderung</li>
<li>sachkonto</li>
<li>ansprechpartner1name (1-3 m&ouml;glich)</li>
<li>ansprechpartner1strasse</li>
<li>ansprechpartner1sprache</li>
<li>ansprechpartner1bereich</li>
<li>ansprechpartner1abteilung</li>
<li>ansprechpartner1unterabteilung</li>
<li>ansprechpartner1land</li>
<li>ansprechpartner1ort</li>
<li>ansprechpartner1plz</li>
<li>ansprechpartner1telefon</li>                
<li>ansprechpartner1telefax</li>
<li>ansprechpartner1mobil</li>
<li>ansprechpartner1email</li>
<li>ansprechpartner1sonstiges</li>
<li>ansprechpartner1adresszusatz</li>
<li>ansprechpartner1ansprechpartner_land</li>
<li>ansprechpartner1anschreiben</li>
<li>ansprechpartner1titel</li>
<li>lieferadresse1name (1-3 m&ouml;glich)</li>
<li>lieferadresse1strasse</li>
<li>lieferadresse1abteilung</li>
<li>lieferadresse1unterabteilung</li>
<li>lieferadresse1land</li>
<li>lieferadresse1ort</li>
<li>lieferadresse1plz</li>
<li>lieferadresse1telefon</li>
<li>lieferadresse1telefax</li>
<li>lieferadresse1email</li>
<li>lieferadresse1sonstiges</li>
<li>lieferadresse1adresszusatz</li>
<li>lieferadresse1ansprechpartner</li>
<li>lieferadresse1standardlieferadresse</li>
</ul>

</td><td><b>Zeiterfassung</b>
<ul>
<li>datum_von</li>
<li>zeit_von</li>
<li>datum_bis</li>
<li>zeit_bis</li>
<li>kennung</li>
<li>taetigkeit</li>
<li>details</li>
</ul>

</td></tr></table><br><u>Pflichtfelder</u>&nbsp;(um bestehende Datens&auml;tze zu &auml;ndern muss mindestens dieser Wert angebenen werden)
</td></tr>
          <tr><td width="130">Interne Bemerkung:</td><td>[INTERNEBEMERKUNG][MSGINTERNEBEMERKUNG]</td><td></td></tr>
<!--   <tr><td width="130">Letzter Import:</td><td><input type="text" name="letzterimport" size="40"</td></tr>
   <tr><td width="130">Von Mitarbeiter:</td><td><input type="text" name="mitarbeiterletzterimport" size="40"</td></tr>-->

</table></fieldset>

</td></tr>

    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" value="Speichern" name="submit"/>
    </tr>
  
    </tbody>
  </table>
</form>

</div>

<!-- tab view schließen -->
</div>


