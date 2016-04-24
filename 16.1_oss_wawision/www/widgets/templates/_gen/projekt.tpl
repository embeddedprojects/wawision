<form action="" method="post" name="eprooform">
      [FORMHANDLEREVENT]

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Grundeinstellungen</a></li>
        <li><a href="#tabs-2">Zeitkonto</a></li>
        <li><a href="#tabs-3">Logistik / Versand</a></li>
        <li><a href="#tabs-4">Eigene Nummernkreise</a></li>
        <li><a href="#tabs-5">Steuer / W&auml;hrung</a></li>
        <li><a href="#tabs-6">POS Einstellungen</a></li>
        <li><a href="#tabs-7">Filiale</a></li>
    </ul>

<div id="tabs-1">
<table cellspacing="5" width="100%">
<tr><td>
[MESSAGE]


	  <fieldset><legend>Allgemein</legend>
          <table border="0" width="100%">
	      <tr><td width="300">Bezeichnung:</td><td>[NAME][MSGNAME]</td></tr>
	      <tr><td>Abk&uuml;rzung (in GROSSBUCHSTABEN):</td><td>[ABKUERZUNGSTART][ABKUERZUNG][MSGABKUERZUNG][ABKUERZUNGENDE]&nbsp;<i>(Ohne Leer- und Sonderzeichen!)</i></td></tr>
	      <tr><td>Beschreibung:</td><td>[BESCHREIBUNG][MSGBESCHREIBUNG]</td></tr>
	      <tr><td>Sonstiges:</td><td>[SONSTIGES][MSGSONSTIGES]</td></tr>
	      <tr><td width="300">Farbe:</td><td>[FARBE][MSGFARBE]</td></tr>
        <tr><td>Verkaufszahlen:</td><td>[VERKAUFSZAHLENDIAGRAM][MSGVERKAUFSZAHLENDIAGRAM]&nbsp; <i>Anzeige in Verkaufszahlendiagramm</i></td></tr>
              <tr><td width="300">Rechte: </td><td>[OEFFENTLICH][MSGOEFFENTLICH]&nbsp;&Ouml;ffentlich f&uuml;r alle Mitarbeiter</td></tr>
          </table>
	  </fieldset>

	  <fieldset><legend>Buchhaltung</legend>
          <table border="0" width="100%">
              <tr><td width="300">Zahlungsmail:</td><td>[ZAHLUNGSERINNERUNG][MSGZAHLUNGSERINNERUNG]&nbsp;Optional Bedingungen:&nbsp;[ZAHLUNGSMAILBEDINUNGEN][MSGZAHLUNGSMAILBEDINUNGEN]</td></tr>
              <tr><td>Stornomail:</td><td>[STORNOMAIL][MSGSTORNOMAIL]&nbsp; bei Stornierung E-Mail <b>Stornierung</b> an Kunden</td></tr>
          </table>
	  </fieldset>



</td></tr>
<!-- speichern -->
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern"
    value="Speichern" /> <input type="button" value="Abbrechen" /></td>
    </tr>
  </table>
</div>

<div id="tabs-2">

<table cellspacing="5" width="100%">
<tr><td>
[MESSAGE]


	  <fieldset><legend>Projekt Management</legend>
          <table border="0" width="100%">
	      <tr><td>Verantwortlicher:</td><td>[VERANTWORTLICHERSTART][VERANTWORTLICHER][MSGVERANTWORTLICHER][VERANTWORTLICHERENDE]
	      </td></tr>

			  <tr><td>Abrechnungsart:</td><td>[ABRECHNUNGSART][MSGABRECHNUNGSART]</td></tr>
			  <tr><td>Kunde:</td><td>[KUNDEAUTOSTART][KUNDE][MSGKUNDE][KUNDEAUTOEND]</td></tr>
        <tr><td>Auftrag:</td><td>[AUFTRAGAUTOSTART][AUFTRAGID][MSGAUFTRAGID][AUFTRAGAUTOEND]</td></tr>

	      <!--<tr><td width="300">Gesamtstunden (max.):</td><td>[GESAMTSTUNDEN_MAX][MSGGESAMTSTUNDEN_MAX]</td></tr>-->
        <tr><td>Abgeschlossen:</td><td>[AKTIV][MSGAKTIV]</td></tr>
				</table>
		</fieldset>

</td></tr>
<!-- speichern -->
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-2';"/> <input type="button" value="Abbrechen" /></td>
    </tr>
  </table>
</div>




<div id="tabs-3">

<table cellspacing="5" width="100%">
<tr><td>
[MESSAGE]

	  <fieldset><legend>Versandprozess und Kommissionierung</legend>
          
          
      
      <table border="0" width="100%">
  					<tr><td width="300">Kommissionierverfahren:</td><td>[KOMMISSIONIERVERFAHREN][MSGKOMMISSIONIERVERFAHREN]</td></tr>
            <tr><td colspan="2"><div class="info">
            Ab der Version Enterprise stehen Ihnen zus&auml;tzlich folgende Kommisionierverfahren zur Verf&uuml;gung:<br />
            <ul>
              <li>Einfache Lagerbuchung + scannen im Verandzentrum</li>
              <li>Lieferschein mit Lagerplatz + automatische Lagerausbuchung + sofort drucken</li>
              <li>Lieferschein mit Lagerplatz + automatische Lagerausbuchung + sofort drucken + scannen im Versandzentrum</li>
              <li>WaWision Logistikzentrum (2-stufige Kommissionierung)</li>
              <li>Filiale mit POS</li>
            </ul>
            </div>

      <div class="info">Folgende Optionen sind ab der Version Enterprise verf&uuml;gbar</div>
            </td></tr>
            
<!--           <tr><td width="300">Automatisch Versand anlegen:</td><td>[AUTOVERSAND][MSGAUTOVERSAND]&nbsp;<i>Bei Auftr&auml;gen ist die Option "per Versandzentrum versenden" automatisch gesetzt.</i></td></tr>-->
						
            <tr><td>Drucker Stufe (Komissionierung)</td><td>[DRUCKERLOGISTIKSTUFE1][MSGDRUCKERLOGISTIKSTUFE1]&nbsp;<i>z.B. Lieferschein drucken</i>
            </td></tr>
		<tr><td>Drucker Stufe (Versand)</td><td>[DRUCKERLOGISTIKSTUFE2][MSGDRUCKERLOGISTIKSTUFE2]&nbsp;<i>Belege bei Versandstation</i>
            </td></tr>
						
            <tr><td>Lieferscheinposition: Etiketten</td><td>[ETIKETTEN_POSITIONEN][MSGETIKETTEN_POSITIONEN]&nbsp;<i></i></td></tr>
						<tr><td>Lieferscheinposition: Etiketten-Drucker</td><td>[ETIKETTEN_DRUCKER][MSGETIKETTEN_DRUCKER]&nbsp;<i></i></td></tr>
						<tr><td>Lieferscheinposition: Etiketten-Art</td><td>[ETIKETTEN_ART][MSGETIKETTEN_ART]&nbsp;<i></i></td></tr>
      </table>      
      <i>Erst ab Version Enterprise verf&uuml;gbar</i>
			
		</fieldset>
	 	  <fieldset><legend>Stufe (Versand) an Versandstation</legend>
      <div class="info">Folgende Optionen sind ab der Version Enterprise verf&uuml;gbar</div>
          <table border="0" width="100%">
           <tr><td width="300"></td><td>Drucker</td><td width="30%">Anzahl Exemplare</td><td width="30%">E-Mail</td></tr>
           <tr><td width="300">Versandbest&auml;tigung/Tracking:</td><td></td><td></td><td>[AUTOMAILVERSANDBESTAETIGUNG][MSGAUTOMAILVERSANDBESTAETIGUNG]</td></tr>
           <tr><td width="300">Rechnung:</td><td>[AUTODRUCKRECHNUNG][MSGAUTODRUCKRECHNUNG]</td><td>[AUTODRUCKRECHNUNGMENGE][MSGAUTODRUCKRECHNUNGMENGE]</td><td>[AUTOMAILRECHNUNG][MSGAUTOMAILRECHNUNG]</td></tr>
           <tr><td width="300">Lieferschein:</td><td>[AUTODRUCKLIEFERSCHEIN][MSGAUTODRUCKLIEFERSCHEIN]</td><td>[AUTODRUCKLIEFERSCHEINMENGE][MSGAUTODRUCKLIEFERSCHEINMENGE]</td><td>[AUTOMAILLIEFERSCHEIN][MSGAUTOMAILLIEFERSCHEIN]</td></tr>
           <tr><td width="300">PDF Anhang bei Auftrag:</td><td>[AUTODRUCKANHANG][MSGAUTODRUCKANHANG]</td><td></td><td>[AUTOMAILANHANG][MSGAUTOMAILANHANG]</td></tr>
           <tr><td width="300">Stornobenachrichtigung:</td><td></td><td></td><td>[STORNOMAIL][MSGSTORNOMAIL]</td></tr>
 					<tr><td>Zahlungsmail:</td><td></td><td></td><td>[ZAHLUNGSERINNERUNG][MSGZAHLUNGSERINNERUNG]</td></tr>
          </table>
      
      
      
	  </fieldset>
  <fieldset><legend>Optionen</legend>
      <div class="info">Folgende Optionen sind ab der Version Enterprise verf&uuml;gbar</div>
    <table border="0" width="100%">
          <!--<tr><td width="300">Wechsel auf einstufige Kommissionierung:</td><td>[WECHSELAUFEINSTUFIG][MSGWECHSELAUFEINSTUFIG]&nbsp; <i>Wenn mehr als x Artikel in einem Auftrag sind.</i></td></tr>-->
          <tr><td>Auto-Reservierung im Lager:</td><td>[RESERVIERUNG][MSGRESERVIERUNG]&nbsp;<i>(f&uuml;r alle bereits <b>freigegebenen</b> Auftr&auml;ge)</i></td></tr>
          <tr><td>Seriennummern erfassen:</td><td>[SERIENNUMMERNERFASSEN][MSGSERIENNUMMERNERFASSEN]&nbsp;<i>(beim Artikel scannen)</i></td></tr>
          <tr><td>EAN, Hersteller- oder Artikel-Nr. scanbar:</td><td>[EANHERSTELLERSCAN][MSGEANHERSTELLERSCAN]&nbsp;<i>(Wenn Artikelnummer gescannt wird andere erlauben.)</i></td></tr>
          <tr><td>Selbstabholer Mail:</td><td>[SELBSTABHOLERMAIL][MSGSELBSTABHOLERMAIL]&nbsp;<i>(Automatische Mail bei Auftragsversand.)</i></td></tr>
          <!--<tr><td>Projekt&uuml;bergreifende Kommissionierung:</td><td>[PROJEKTUEBERGREIFENDKOMMISIONIEREN][MSGPROJEKTUEBERGREIFENDKOMMISIONIEREN]</td></tr>-->
 					<tr><td width="300">Folgebest&auml;tigung:</td><td>[FOLGEBESTAETIGUNG][MSGFOLGEBESTAETIGUNG]&nbsp;<i>(Regelm&auml;&szlig;ige E-Mail an Kunden wenn Ware noch nicht versendet.)</i></td></tr>
          <tr><td>Porto-Check:</td><td>[PORTOCHECK][MSGPORTOCHECK]&nbsp;(<i>Auftrag wird nur gr&uuml;n wenn Porto als Artikel vorhanden ist.)</i></td></tr>
          <tr><td>Nachnahme-Check:</td><td>[NACHNAHMECHECK][MSGNACHNAHMECHECK]&nbsp;(<i>Auftrag wird nur gr&uuml;n wenn 2 x Porto als Artikel vorhanden ist. Porto und Nachnahmegeb&uuml;hr)</i></td></tr>
          <tr><td>Auftrags-Check installiert:</td><td>[CHECKOK][MSGCHECKOK]&nbsp;Funktion:&nbsp;[CHECKNAME][MSGCHECKNAME]</td></tr>
           <tr><td width="300">Online-Shop Projekt: </td><td>[SHOPZWANGSPROJEKT][MSGSHOPZWANGSPROJEKT]&nbsp;<i>Auftrag wird sobald ein Artikel aus diesem Projekt verwendet wird bei Import auf dieses Projekt gebucht</i></td></tr>
          <tr><td>Kundenfreigabe l&ouml;schen:</td><td>[KUNDENFREIGABE_LOESCHEN][MSGKUNDENFREIGABE_LOESCHEN]&nbsp;<i>Kundenfreigabe nach Auftragsabschluss l&ouml;schen.</i></td></tr>
          <tr><td>Versandzentrum 2-Schritte:</td><td>[VERSANDZWEIGETEILT][MSGVERSANDZWEIGETEILT]&nbsp;<i>(Schritt 1: Artikel packen, Schritt 2: Paketmarke)</i></td></tr>
          <tr><td>Anzahl Differenz Tage Auslieferung:</td><td>[DIFFERENZ_AUSLIEFERUNG_TAGE][MSGDIFFERENZ_AUSLIEFERUNG_TAGE]&nbsp;<i>Anzahl zwischen Wunsch und ab Lager</i></td></tr>

          </table>

	  </fieldset>



  	  <fieldset><legend>Paketdienstleister Einstellungen</legend>
      <i>Erst ab Version Enterprise verf&uuml;gbar</i>
	  	</fieldset>


  	  <fieldset><legend>GO! Einstellungen</legend>
          <i>Erst ab Version Enterprise verf&uuml;gbar</i>
	  	</fieldset>




  	  <fieldset><legend>Intraship Einstellungen</legend>
  <i>Erst ab Version Enterprise verf&uuml;gbar</i>
	  	</fieldset>



  <fieldset><legend>Billsafe Einstellungen</legend>
<i>Erst ab Version Enterprise verf&uuml;gbar</i>
                </fieldset>
                

  	  <fieldset><legend>E-Mail Versand Einstellungen (falls abweichend von Daten aus Firmeneinstellungen)</legend>
        <i>Erst ab Version Enterprise verf&uuml;gbar</i>
	  	</fieldset>

   
</td></tr>
<!-- speichern -->
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-3';" /> <input type="button" value="Abbrechen" /></td>
    </tr>
  </table>

</div>

<div id="tabs-4">
<table cellspacing="5" width="100%">
<tr><td>
[MESSAGE]
 <fieldset><legend>Nummernkreis</legend>
 <div class="info">Folgende Optionen sind ab der Version Enterprise verf&uuml;gbar</div>
 
  <table border="0" width="100%">
 	<tr><td width="300">Eigene Nummernkreise:</td><td>[EIGENERNUMMERNKREIS][MSGEIGENERNUMMERNKREIS]</td></tr>
			  [STARTNUMMER]<tr><td width="200">N&auml;chste Angebotsnummer</td><td>[NEXT_ANGEBOT][MSGNEXT_ANGEBOT]&nbsp;</td></tr>
  <tr><td>N&auml;chste Auftragsnummer</td><td>[NEXT_AUFTRAG][MSGNEXT_AUFTRAG]&nbsp;</td></tr>
  <tr><td>N&auml;chste Lieferscheinnummer</td><td>[NEXT_LIEFERSCHEIN][MSGNEXT_LIEFERSCHEIN]&nbsp;</td></tr>
  <tr><td>N&auml;chste Rechnungsnummer</td><td>[NEXT_RECHNUNG][MSGNEXT_RECHNUNG]&nbsp;</td></tr>
  <tr><td>N&auml;chste Gutschriftnummer</td><td>[NEXT_GUTSCHRIFT][MSGNEXT_GUTSCHRIFT]&nbsp;</td></tr>
  <tr><td>N&auml;chste Bestellungsnummer</td><td>[NEXT_BESTELLUNG][MSGNEXT_BESTELLUNG]&nbsp;</td></tr>
  <tr><td>N&auml;chste Arbeitsnachweisnummer</td><td>[NEXT_ARBEITSNACHWEIS][MSGNEXT_ARBEITSNACHWEIS]&nbsp;</td></tr>
  <tr><td>N&auml;chste Reisekostennummer</td><td>[NEXT_REISEKOSTEN][MSGNEXT_REISEKOSTEN]&nbsp;</td></tr>
  <tr><td>N&auml;chste Produktionnummer</td><td>[NEXT_PRODUKTION][MSGNEXT_PRODUKTION]&nbsp;</td></tr>
  <tr><td>N&auml;chste Anfragenummer</td><td>[NEXT_ANFRAGE][MSGNEXT_ANFRAGE]&nbsp;</td></tr>
  <tr><td>N&auml;chste Kundennummer</td><td>[NEXT_KUNDENNUMMER][MSGNEXT_KUNDENNUMMER]&nbsp;</td></tr>
  <tr><td>N&auml;chste Lieferantenummer</td><td>[NEXT_LIEFERANTENNUMMER][MSGNEXT_LIEFERANTENNUMMER]&nbsp;</td></tr>
  <tr><td>N&auml;chste Mitarbeiternummer</td><td>[NEXT_MITARBEITERNUMMER][MSGNEXT_MITARBEITERNUMMER]&nbsp;</td></tr>	
  <tr><td>N&auml;chste Artikelnummer</td><td>[NEXT_ARTIKELNUMMER][MSGNEXT_ARTIKELNUMMER]&nbsp;</td></tr>	
[ENDENUMMER]
           </table>
	  </fieldset>
   
</td></tr>
<!-- speichern -->
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-4';"/> <input type="button" value="Abbrechen" /></td>
    </tr>
  </table>
</div>

<div id="tabs-5">
<table cellspacing="5" width="100%">
<tr><td>
 <fieldset><legend>Steuer / Standardw&auml;hrung</legend>
  <table border="0" width="100%">
 	<tr><td width="300">Eigene Steuers&auml;tze verwenden:</td><td>[EIGENESTEUER][MSGEIGENESTEUER]</td></tr>
  <tr><td>Steuersatz Normal</td><td>[STEUERSATZ_NORMAL][MSGSTEUERSATZ_NORMAL]&nbsp;</td></tr>
  <tr><td>Steuersatz Erm&auml;ssigt</td><td>[STEUERSATZ_ERMAESSIGT][MSGSTEUERSATZ_ERMAESSIGT]&nbsp;</td></tr>
  <tr><td>W&auml;hrung</td><td>[WAEHRUNG][MSGWAEHRUNG]&nbsp;</td></tr>
   </table>
	  </fieldset>
   
</td></tr>
<!-- speichern -->
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-5';"/> <input type="button" value="Abbrechen" /></td>
    </tr>
  </table>
</div>


<div id="tabs-6">
<table cellspacing="5" width="100%">
<tr><td>
[POSINFOBOX]
 <fieldset><legend>POS Einstellungen</legend>
  <table border="0" width="100%">
  <tr><td>Lagerprozess:</td><td>[KASSE_LAGERPROZESS][MSGKASSE_LAGERPROZESS]&nbsp;<i>Automatisches abbuchen aus Lager</i></td></tr>

  <tr><td>POS Lager f&uuml;r den Verkauf:</td><td>[KASSE_LAGER][MSGKASSE_LAGER]&nbsp;<i>wenn "Aus eingestelltem POS Lager entnehmen" ausgew&auml;hlt ist</i></td></tr>
  <tr><td>Preisgruppe bevorzugt:</td><td>[KASSE_PREISGRUPPE][MSGKASSE_PREISGRUPPE]</td></tr>
  <tr><td>Kasse f&uuml;r Bar:</td><td>[KASSE_KONTO][MSGKASSE_KONTO]</td></tr>
  <tr><td>Laufkundschaft:</td><td>[KASSE_LAUFKUNDSCHAFT][MSGKASSE_LAUFKUNDSCHAFT]</td></tr>
  <tr><td>Artikel f&uuml;r Rabatt:</td><td>[KASSE_RABATT_ARTIKEL][MSGKASSE_RABATT_ARTIKEL]</td></tr>
  <tr><td width="300">Lieferschein erstellen:</td><td>[KASSE_LIEFERSCHEIN_ANLEGEN][MSGKASSE_LIEFERSCHEIN_ANLEGEN]</td></tr>
  <tr><td>Kasse Beschriftung 1:</td><td>[KASSE_TEXT_BEMERKUNG][MSGKASSE_TEXT_BEMERKUNG]&nbsp;<i>z.B. Interne Bemerkung (Feld "Interne Bemerkung" im Auftrag und Rechnung)</i></td></tr>
  <tr><td>Kasse Beschriftung 2:</td><td>[KASSE_TEXT_FREITEXT][MSGKASSE_TEXT_FREITEXT]&nbsp;<i>z.B. Text auf Beleg (Feld "Freitext" im Auftrag und Rechnung)</i></td></tr>
   </table>
	  </fieldset>
 <fieldset><legend>Buttons</legend>
  <table border="0" width="100%">
  <tr><td width="300">Zahlweise Bar:</td><td>[KASSE_ZAHLUNG_BAR][MSGKASSE_ZAHLUNG_BAR]</td><td>[KASSE_ZAHLUNG_BAR_BEZAHLT][MSGKASSE_ZAHLUNG_BAR_BEZAHLT]&nbsp;Rechnung als bezahlt markieren</td></tr>
  <tr><td>Zahlweise EC:</td><td>[KASSE_ZAHLUNG_EC][MSGKASSE_ZAHLUNG_EC]</td><td>[KASSE_ZAHLUNG_EC_BEZAHLT][MSGKASSE_ZAHLUNG_EC_BEZAHLT]&nbsp;Rechnung als bezahlt markieren</td></tr>
  <tr><td>Zahlweise Kreditkarte:</td><td>[KASSE_ZAHLUNG_KREDITKARTE][MSGKASSE_ZAHLUNG_KREDITKARTE]</td><td>[KASSE_ZAHLUNG_KREDITKARTE_BEZAHLT][MSGKASSE_ZAHLUNG_KREDITKARTE_BEZAHLT]&nbsp;Rechnung als bezahlt markieren</td></tr>
  <tr><td>Zahlweise &Uuml;berweisung:</td><td>[KASSE_ZAHLUNG_UEBERWEISUNG][MSGKASSE_ZAHLUNG_UEBERWEISUNG]</td><td>[KASSE_ZAHLUNG_UEBERWEISUNG_BEZAHLT][MSGKASSE_ZAHLUNG_UEBERWEISUNG_BEZAHLT]&nbsp;Rechnung als bezahlt markieren</td></tr>
  <tr><td>Beleg Rechnung:</td><td>[KASSE_EXTRA_RECHNUNG][MSGKASSE_EXTRA_RECHNUNG]</td></tr>
  <tr><td>Kein Beleg:</td><td>[KASSE_EXTRA_KEINBELEG][MSGKASSE_EXTRA_KEINBELEG]</td></tr>
  <tr><td>Rabatt in %:</td><td>[KASSE_EXTRA_RABATT_PROZENT][MSGKASSE_EXTRA_RABATT_PROZENT]</td></tr>
  <tr><td>Rabatt in EUR:</td><td>[KASSE_EXTRA_RABATT_EURO][MSGKASSE_EXTRA_RABATT_EURO]</td></tr>
  <tr><td>Entnahme:</td><td>[KASSE_BUTTON_ENTNAHME][MSGKASSE_BUTTON_ENTNAHME]</td></tr>
  <tr><td>Trinkgeld:</td><td>[KASSE_BUTTON_TRINKGELD][MSGKASSE_BUTTON_TRINKGELD]</td></tr>
   </table>
	  </fieldset>
 <fieldset><legend>Weitere Einstellungen</legend>
  <table border="0" width="100%">
  <tr><td width="300">Erweiterte Adressfelder:</td><td>[KASSE_ADRESSE_ERWEITERT][MSGKASSE_ADRESSE_ERWEITERT]</td></tr>
  <tr><td>Zwangsauswahl Zahlweise:</td><td>[KASSE_ZAHLUNGSAUSWAHL_ZWANG][MSGKASSE_ZAHLUNGSAUSWAHL_ZWANG]</td></tr>
  <tr><td>Vorauswahl Anrede:</td><td>[KASSE_VORAUSWAHL_ANREDE][MSGKASSE_VORAUSWAHL_ANREDE]</td></tr>
  <tr><td>Erweiterte Lagerabfrage:</td><td>[KASSE_ERWEITERTE_LAGERABFRAGE][MSGKASSE_ERWEITERTE_LAGERABFRAGE]</td></tr>
   </table>
	  </fieldset>
 
 
 <fieldset><legend>Drucker Einstellungen</legend>
  <table border="0" width="100%">
  <tr><td width="300">Belege ausgeben nach Abschluss:</td><td>[KASSE_BELEGAUSGABE][MSGKASSE_BELEGAUSGABE]</td></tr>
  <tr><td>Drucker</td><td>[KASSE_DRUCKER][MSGKASSE_DRUCKER]&nbsp;</td></tr>
  <tr><td>Anzahl Lieferschein:</td><td>[KASSE_LIEFERSCHEIN][MSGKASSE_LIEFERSCHEIN]</td></tr>
  <tr><td>Anzahl Rechnung:</td><td>[KASSE_RECHNUNG][MSGKASSE_RECHNUNG]</td></tr>
  <tr><td>Anzahl Lieferschein-Doppel:</td><td>[KASSE_LIEFERSCHEIN_DOPPEL][MSGKASSE_LIEFERSCHEIN_DOPPEL]</td></tr>
  <!--<tr><td>Rechnung per Mail:</td><td>[KASSE_RECHNUNGPERMAIL][MSGKASSE_RECHNUNGPERMAIL]</td></tr>-->
   </table>
	  </fieldset>
   
</td></tr>
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-6';"/> <input type="button" value="Abbrechen" /></td>
    </tr>
  </table>
</div>


<div id="tabs-7">
  <table cellspacing="5" width="100%">
    <tr>
      <td>
        <fieldset><legend>Adresse der Filiale</legend>
        <i>Erst ab Version Enterprise verf&uuml;gbar</i>
      </td>
    </tr>
  </table>
</div>





</div>

  </form>
