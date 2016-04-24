<form action="" method="POST">
<fieldset><legend>Buchhaltung Rechnungen / Gutschriften</legend>

<table >
<tr><td>Sortiert nach</td><td><select name="sort"><option value="datum">Datum</option><option value="belegnr">Rechnungsnummer</option></select></td></tr>
<tr><td>Projekt:</td><td><input type="name" value="[PROJEKT]" name="projekt" id="projekt">&nbsp;<i>(Optional / Standardm&auml;&szlig;ig leer lassen)</i></td></tr>
<tr><td width="100">von:</td><td><input type="text" size="12" id="von" name="von" value="[VON]">&nbsp;[DATUMVON]</td></tr>
<tr><td>bis:</td><td><input type="text" size="12" name="bis" id="bis" value="[BIS]">&nbsp;[DATUMBIS]&nbsp;<input type="submit" name="export" value="Export"></td></tr>
<tr><td>Format:</td><td>[SCHLUESSEL]</td></tr>
</table>

</fieldset>
</form>

<form action="" method="POST">
<fieldset><legend>Buchhaltung Verbindlichkeiten</legend>
<div class="info">Diese Funktion ist aber der Version Enterprise verf&uuml;gbar</div>
</fieldset>
</form>

<form action="" method="POST">
<fieldset><legend>Buchhaltung Konten</legend>
<div class="info">Diese Funktion ist aber der Version Enterprise verf&uuml;gbar</div>
</fieldset>
</form>





<form action="" method="POST">
<fieldset><legend>Buchhaltung Kunden/Lieferanten</legend>
<table>
<tr valign="top"><td width="100">Auswahl:</td><td>

<table>
<tr><td><input type="button" value="Kunden" onclick="window.location.href='index.php?module=buchhaltungexport&action=exportadressen&cmd=kunden&info='+document.getElementById('kunde').value"></td>
<td><input type="text" size="40" name="kunde" value="" id="kunde">&nbsp;<i>Export ab Kd.-Nr.</i></td></tr>
<tr><td><input type="button" value="Lieferanten" onclick="window.location.href='index.php?module=buchhaltungexport&action=exportadressen&cmd=lieferanten&info='+document.getElementById('lieferant').value"></td>
<td><input type="text" size="40" name="lieferant" value="" id="lieferant">&nbsp;<i>Export ab Lf.-Nr.</i></td></tr>
<tr><td>[BUTTONVERBAND]</td>
<td><input type="text" size="40" name="kundeverband" value="" id="kundeverband">&nbsp;<i>Export ab Kd.-Nr.</i></td></tr>
</table>

</td></tr>
<tr><td>Format:</td><td>"Kundennummer bzw. Lieferantennummer";"Kundenname";"Strasse";"PLZ","Ort";"USTID";"Zahlungsziel in Tage";"Konto";"BLZ";"IBAN";"BIC";"Bank"</td></tr>
</table>
</fieldset>
</form>


