<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]
 <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr valign="top" colspan="3">
        <td>

<table border="0" width="100%">
            <tbody>
              <tr><td nowrap>Artikel-Nr:</td><td>[NUMMER][MSGNUMMER]</td></tr>
	      <tr><td nowrap>Bezeichnung:</td><td>[BEZEICHNUNG][MSGBEZEICHNUNG]</td></tr>
              <tr><td>Beschreibung:</td><td>[BESCHREIBUNG][MSGBESCHREIBUNG]</td></tr>
	      <tr><td>Menge:</td><td>[MENGE][MSGMENGE]</td></tr>
	      <tr><td>Preis:</td><td>[PREIS][MSGPREIS]</td></tr>
        <tr><td>Steuersatz:</td><td>[UMSATZSTEUER][MSGUMSATZSTEUER]</td></tr>
[STARTDISABLEVERBAND]<tr><td>Grundrabatt:</td><td>[GRUNDRABATT][MSGGRUNDRABATT]</td></tr>
        <tr><td>Rabatt 1 - 5:</td><td>[RABATT1][MSGRABATT1]&nbsp;[RABATT2][MSGRABATT2]
        &nbsp;[RABATT3][MSGRABATT3]&nbsp;[RABATT4][MSGRABATT4]&nbsp;[RABATT5][MSGRABATT5]</td></tr>
        <tr><td>Kein Rabatt anwenden:</td><td>[KEINRABATTERLAUBT][MSGKEINRABATTERLAUBT]&nbsp;<i>(keine eingestellten Rabatte anwenden)</i></td></tr> 
        [ENDEDISABLEVERBAND]
        <tr><td>Rabatt[STARTDISABLEVERBAND] (wird berechnet aus Grund- und Rabatt 1 - 5)[ENDEDISABLEVERBAND]:</td><td>[RABATT][MSGRABATT]&nbsp;<i>(in Prozent z.B. 10 = 10%)</i></td></tr>

	      <tr><td>Optional:</td><td>[OPTIONAL][MSGOPTIONAL]&nbsp;<i>(nicht in Gesamtsumme)</i></td></tr>
	      <tr><td>Einheit:</td><td>[EINHEIT][MSGEINHEIT]</td></tr>
	      <tr><td>VPE:</td><td>[VPE][MSGVPE]</td></tr>
	      <tr><td>Lieferdatum:</td><td>[LIEFERDATUM][MSGLIEFERDATUM][DATUM_LIEFERDATUM]&nbsp;[LIEFERDATUMKW][MSGLIEFERDATUMKW]&nbsp;KW</td></tr>
              <tr><td>Artikelnr. bei Kunde:</td><td>[ARTIKELNUMMERKUNDE][MSGARTIKELNUMMERKUNDE]</td></tr>
              <tr><td>Zolltarifnummer:</td><td>[ZOLLTARIFNUMMER][MSGZOLLTARIFNUMMER]</td></tr>
              <tr><td>Herkunftsland:</td><td>[HERKUNFTSLAND][MSGHERKUNFTSLAND]</td></tr>
 <tr><td>Bemerkung:</td><td>



          <table width="100%"><tr valign="bottom"><td>[BEMERKUNG][MSGBEMERKUNG]</td><td align="right"><input type="submit" value="Speichern" ></td></tr></table>
            </td></tr>
        [STARTDISABLEMLM]<tr><td>MLM Punkte:</td><td>[PUNKTE][MSGPUNKTE]</td></tr>
        <tr><td>MLM Bonuspunkte:</td><td>[BONUSPUNKTE][MSGBONUSPUNKTE]</td></tr>
        <tr><td>MLM Direktpr&auml;ie:</td><td>[MLMDIREKTPRAEMIE][MSGMLMDIREKTPRAEMIE]</td></tr>
        [ENDEDISABLEMLM]


</tbody></table>
</td>
<td width="30%">[ANZEIGEEINKAUFLAGER]</td>
      </tr>


    </tbody>
  </table>
</form>
