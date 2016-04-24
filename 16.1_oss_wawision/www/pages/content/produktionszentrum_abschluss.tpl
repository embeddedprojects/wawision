<style>


.auftraginfo_cell {
  color: #636363;border: 1px solid #ccc;padding: 5px;
}

.auftrag_cell {
  color: #636363;border: 1px solid #fff;padding: 0px; margin:0px;
}

</style>
<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">[TABTEXT]</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
<form method="POST">
[PRODMESSAGE]
<table width="100%">
<tr valign="top"><td width="50%">
<fieldset style="height:400px"><legend>Produktion abschliessen</legend>

<table>
<tr><td width="200">Menge Ausschuss:</td><td><input type="text" name="mengeausschuss" value="[MENGEAUSSCHUSS]" size="30">&nbsp;<i>(Menge fehlerhafte Produktionen)</i></td></tr>
<tr><td>Menge Erfolgreich: </td><td><input type="text" name="mengeerfolgreich" value="[MENGEERFOLGREICH]" size="30">&nbsp;<i>(Menge erfolgreicher Produktionen)</i></td></tr>
<tr><td>Automatisch einlager: </td><td><input type="radio" value="nein" name="same" checked> Nein</td></tr>
<tr><td></td><td><input type="radio" value="ja" name="same"> Ja</td></tr>
<tr><td>Lagerplatz: </td><td><input type="text" name="lagerplatz" id="lagerplatz" size="30"></td></tr>
<tr><td>Als Artikel-Nr.: </td><td><input type="text" name="artikel" value="[VORSCHLAGARTIKEL]" id="artikel" size="30"></td></tr>
<tr><td>Bemerkung:</td><td><textarea rows="8" name="bemerkung" cols="70">[BEMERKUNG]</textarea></td></tr>
</table>
</fieldset>

</td><td>

<fieldset style="height:400px"><legend>Gebuchte Zeiten</legend>


Live Tabelle mit checkbox mit allen offenen Zeiten die auf Kunden gebucht sind

</fieldset>

</td></tr></table>
<br>
<center><input type="submit" name="submitabschliessen" value="Produktion abschliessen"></center>
</form>

</div>
</div>
