<fieldset><legend>Versand</legend>
<form action="" method="post" name="eprooform">
<table width="100%">
	<tr valign="top"><td colspan="2"></td><td></td></tr>
	<tr><td width="70">An:</td><td><select name="ansprechpartner">[ANSPRECHPARTNER]</select></td></tr>
<!--	<tr valign="top"><td width="70">Projekt:</td><td>[PROJEKTSTART]<input type="text" name="projekt" id="projekt" value="[PROJEKT]">[PROJEKTENDE]</select></td></tr>-->
	<tr><td>Betreff:</td><td><input type="text" name="betreff" value="[BETREFF]" size="61"></td></tr>
	<tr valign="toP"><td>Text:</td><td>
<table width="100%">
<tr><td>
<textarea name="text" cols="60" rows="16">[TEXT]</textarea><br><i>(Signatur f&uuml;r E-Mail wird automatisch angeh&auml;ngt</i>)</td>
<td>

			<table>
				<tr valign="toP"><td><input type="radio" name="senden" value="brief" checked> per Drucker</td><td><select name="drucker_brief">[DRUCKER]</select></td></tr>
				<tr valign="toP"><td><input type="radio" name="senden" value="fax" [ABPERFAX]> per Fax</td><td><select name="drucker_fax">[FAX]</select></td></tr>
        <tr valign="toP"><td>Faxnummer:</td><td><input type="text" name="faxnummer" value="[FAXNUMMER]"></td></tr>
				<tr valign="toP"><td><input type="radio" name="senden" value="email"> per E-Mail</td><td><select name="email_from">[EMAILEMPFAENGER]</select></td></tr>
				<!--<tr valign="toP"><td><input type="radio" name="senden" value="autofax"> Auto-Fax</td><td></td></tr>
				<tr valign="toP"><td><input type="radio" name="senden" value="autobrief"> Auto-Brief</td><td></td></tr>-->
				<tr valign="toP"><td><input type="radio" name="senden" value="telefon"> Telefongespr&auml;ch</td><td></td></tr>
				<tr valign="toP"><td><input type="radio" name="senden" value="sonstiges"> Sonstiges</td><td><i>(markieren als versendet)</i></td></tr>
			</table>
<br><br>
<input type="submit" value="[KURZUEBERSCHRIFTFIRSTUPPER] abschicken und versenden oder als versendet markieren" name="submit">
<!--&nbsp;<input type="submit" value="Anschreiben nur speichern" name="speichern">-->

</td></tr></table>
		<!--<br><br>Anh&auml;nge:&nbsp;[ANHAENGE]<br><br>--></td></tr>
        <tr valign="top"><td colspan="2"></td><td><br></td></tr>
        <tr valign="top"><td>Anhang:</td><td><table width="100%" class="mkTable" cellpadding=0 cellspacing=0><tr><th width="20"></th><th>Dateiname</th></tr>[DATEIANHAENGE]</table></td></tr>


	<tr><td></td><td align="center">
&nbsp;<!--<input type="submit" value="Anschreiben herunterladen" name="download">--><br><br></td></tr>


	<tr valign="top"><td>Versand:</td><td>[HISTORIE]</td><td></td></tr>


	<tr valign="top"><td>Protokoll:</td><td>[PROTOKOLL]</td><td></td></tr>
<!--<tr><td>Status:</td><td>TABELLE</td><td></td></tr>-->
</table>
<br><br>
<input type="hidden" name="sid" value="[SID]">
<input type="hidden" name="typ" value="[TYP]">
</form>
</fieldset>
