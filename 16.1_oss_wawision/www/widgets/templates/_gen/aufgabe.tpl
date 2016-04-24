<div id="tabs">
    <ul>
        <li><a href="#tabs-1"></a></li>
    </ul>

<div id="tabs-1">

<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]
<table border="0"><tr valign="top"><td>
<fieldset><legend>Allgemein</legend>
          <table border="0" width="760">
	    [MESSAGE]
            <tbody>
	      <tr><td width="200">Aufgabe:</td><td>[AUFGABE][MSGAUFGABE]</td></tr>
	      <tr><td>Mitarbeiter:</td><td>[MITARBEITERAUTOSTART][ADRESSE][MSGADRESSE][MITARBEITERAUTOEND]</td></tr>
	      <tr><td>f&uuml;r Kunde:</td><td>[KUNDE][MSGKUNDE]</td></tr>
	      <tr><td>Beschreibung:<br><i>(Optional Text auf Pinwand)</i></td><td>[BESCHREIBUNG][MSGBESCHREIBUNG]</td></tr>
	      <tr><td>Projekt:</td><td>[PROJEKTAUTOSTART][PROJEKT][MSGPROJEKT][PROJEKTAUTOEND]</td></tr>
	      <tr><td>Prio:</td><td>
		  <table cellspacing="0" cellpadding="0" width="504" border="0"><tr><td>[PRIO][MSGPRIO]
                  </td><td align="right">Geplante Dauer in Stunden (optional):&nbsp;[STUNDEN][MSGSTUNDEN]</td></tr></table>
	      </td></tr>
    
            <tr><td width="200">Datum / Abgabe bis (optional):</td><td><table cellspacing="0" cellpadding="0" width="504" border="0"><tr><td>
                    [ABGABE_BIS][MSGABGABE_BIS]</td><td align="right">Uhrzeit:&nbsp;[ABGABE_BIS_ZEIT][MSGABGABE_BIS_ZEIT]</td></tr></table>

</td></tr>

	      <tr><td>Regelm&auml;&szlig;ig (Intervall):</td><td>
<table cellspacing="0" cellpadding="0" width="504" border="0"><tr><td>
		  [INTERVALL_TAGE][MSGINTERVALL_TAGE]
</td><td align="right">
Zeiterfassung Pflicht:&nbsp;
[ZEITERFASSUNG_PFLICHT][MSGZEITERFASSUNG_PFLICHT]
Zeit wird abgerechnet:&nbsp;
[ZEITERFASSUNG_ABRECHNUNG][MSGZEITERFASSUNG_ABRECHNUNG]

</td></tr></table>
</td></tr></table>
</fieldset>
</td><td>

<fieldset><legend>Einstellungen</legend>

          <table border="0" width="100%">
        <tr><td width="200">E-Mail Errinnerung:</td><td>[EMAILERINNERUNG][MSGEMAILERINNERUNG]&nbsp;</td></tr>
        <tr><td>E-Mail Anzahl Tage zuvor:</td><td>[EMAILERINNERUNG_TAGE][MSGEMAILERINNERUNG_TAGE]&nbsp;<i>(in Tagen)</i></td></tr>

	    <tr><td>Countdown auf Startseite:</td><td>[VORANKUENDIGUNG][MSGVORANKUENDIGUNG]&nbsp;<i>(in Tagen)</i></td></tr>
	      <tr><td>Status:</td><td>[STATUS][MSGSTATUS]</td></tr>
 
	      <tr><td>&Ouml;ffentlich:</td><td>[OEFFENTLICH][MSGOEFFENTLICH]</td></tr>
	      <tr><td>Auf Startseite:</td><td>[STARTSEITE][MSGSTARTSEITE]</td></tr>

	      <tr><td>Auf Pinwand:</td><td>[PINWAND][MSGPINWAND]&nbsp;Farbe:&nbsp;[NOTE_COLOR][MSGNOTE_COLOR]
</td></tr>
</table>
</fieldset>
<fieldset><legend>Notizen</legend>

          <table border="0" width="100%">
	      <tr valign="top"><td colspan="2">[SONSTIGES][MSGSONSTIGES]</td></tr>
	</table>
</fieldset>
</td></tr></table>

<center>
     <table border="0" width="100%">
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
[AUFGABEABSCHLIESSEN]
    <input type="submit"
    value="Speichern" />[ABBRECHEN]</td>
    </tr>
  
    </tbody>
  </table>
</center>

</form>
</div>
</div>

