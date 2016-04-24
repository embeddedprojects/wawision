
  [MESSAGE]

<table width="100%">
<tr valign="top"><td width="300">
<fieldset><legend>Kunde</legend>
<table border="0">
  <tr><td>Name/Firma:</td><td>[NAME]</td></tr>
  <tr><td>KD-Nr:</td><td>[ID]</td></tr>
  <tr><td>Land:</td><td>[LAND]</td></tr>
  <tr><td>USt-ID:</td><td><input type="text" name="ustid" size="20"  value="[USTID]"></td></tr>
  <tr><td>Status:</td><td>[STATUS]</td></tr>
</table>
</fieldset>

<fieldset><legend>Adresse</legend>
<table border="0">
  <tr><td>Name:</td><td><input type="text" name="name" size="30" rule="notempty" msg="Pflichtfeld!" value="[NAME]"></td><td><font color="red"><b>[ERG_NAME]</b></font></td></tr>
  <tr><td>Ort:</td><td><input type="text" name="ort" size="30" value="[ORT]"></td><td><font color="red"><b>[ERG_ORT]</b></font></td></tr>
  <tr><td>PLZ:</td><td><input type="text" name="plz" size="30" value="[PLZ]"></td><td><font color="red"><b>[ERG_PLZ]</b></font></td></tr>
  <tr><td>Stra&szlig;e:</td><td><input type="text" name="strasse" size="30" value="[STRASSE]"></td><td><font color="red"><b>[ERG_STR]</b></font></td></tr>
  <tr><td>Google:</td><td><a href="http://www.google.de/search?q=[SUCHE]&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:de:official&client=firefox-a" target="_blank">Adresse bei Google suchen</a>
</td></tr>
  <tr><td colspan="2"><br><br><input type="submit" name="aendern" value="Adresse und USTID bei Kunden und offene Auftr&auml;ge &auml;ndern"></td></tr>
</table>
</fieldset>
<fieldset><legend>Status</legend>
<table width="100%">
          <!--<tr valign="top"><td>Brief:</td><td style="background-color: white"><a href="">Empfang melden</a> Download</td></tr>-->
	  <tr><td nowrap>Online:</td><td>[DATUM_ONLINE]</td><td>&nbsp;</td>
	  <tr><td>Brief bestellt:</td><td>[BESTELLT]</td></tr>
	  <tr><td>Brief Eingang:</td><td>[EINGANG]</td></tr>

</table>
</fieldset>

</td><td>

<table width="100%">

	  <tr><td align="center">[PROTOKOLL]</td></tr>
</table>
<table width="100%" border="0"><tr><td>
          [STATUSMELDUNG]
</td></tr></table>

<table width="100%">

	  <tr><td align="center" nowrap>
	    <input type="submit" name="online"  value="Online Pr&uuml;fung" style="background-color:red">
	    <input type="submit" name="brief"  value="Brief bestellen" style="background-color:red"><br><br>
	    <input type="submit" name="fehlgeschlagen" value="Abfrage als fehlgeschlagen markieren">
	    <input type="submit" name="manuellok" value="Manuell auf OK setzten">
	   <!-- <input type="button" name="" value="neue Pr&uuml;fung starten" onclick="window.location.href='index.php?module=adresse&action=ustprf&id=[ID]'">-->

	  </td></tr>
          <tr><td align="center" nowrap>
<br><br>
<fieldset><legend>Anschreiben</legend>
Mail an Kunden:<br>
<textarea rows="10" cols="40" name="mailtext"></textarea><br>
<input type="submit" name="benachrichtigen" value="Kunden benachrichtigen"><br>(Signatur wird automatisch angehaengt)<br>

</fieldset>
	  </td></tr>

</table>



</td></tr></table>
