<form action="" method="POST" name="brief_erstellen_form" class="brief_erstellen_form">

	<input type="hidden" name="type" value="wiedervorlage">
	<input type="hidden" name="eintragId" value="[EINTRAGID]">

	<table width="495">
		<tr>
			<td width="100">Datum:</td>
			<td><input type="hidden" name="datum" value="[DATUM]" style="width: 100px;" id="datum">[DATUM]</td>
		</tr>
   <tr>
      <td width="100">Uhrzeit:</td>
      <td><input type="hidden" name="uhrzeit" value="[UHRZEIT]" style="width: 100px;" id="uhrzeit">[UHRZEIT]</td>
    </tr>
		<tr>
			<td width="100">Bearbeiter:</td>
			<td><input type="text" name="bearbeiter" id="bearbeiter" value="[BEARBEITER]" style="width: 370px;"></td>
		</tr>
		<tr>
			<td width="100">f&uuml;r Kunde:</td>
			<td><input type="hidden" name="adresse" id="adresse" value="[ADRESSE]">[ADRESSE]</td>
		</tr>
		<tr>
			<td width="100">Betreff:</td>
			<td><input type="text" name="betreff" value="[BETREFF]" style="width: 370px;"></td>
		</tr>
		<tr>
			<td>Text:</td>
			<td><textarea name="content" style="width: 370px; min-height: 180px;">[CONTENT]</textarea></td>
		</tr>
    <tr>
      <td>Datum:</td>
      <td><input type="text" name="datumerinnerung" value="[DATUM_ERINNERUNG]" style="width: 100px;" id="datum_erinnerung">&nbsp;<i>(Wiedervorlage)</i></td>
		</tr>
   <tr>
      <td width="100">Uhrzeit:</td>
      <td><input type="text" name="uhrzeiterinnerung" value="[UHRZEIT_ERINNERUNG]" style="width: 100px;" id="uhrzeit_erinnerung">&nbsp;<i>(Wiedervorlage)</i></td>
    </tr>
		<tr>
			<td width="100">Mitarbeiter:</td>
			<td><input type="text" name="adresse_mitarbeiter" id="adresse_mitarbeiter" value="[MITARBEITER]" style="width: 370px;"></td>
		</tr>
		<tr>
			<td width="100">Abgeschlossen:</td>
			<td><input type="checkbox" name="abgeschlossen" id="abgeschlossen" value="1" [ABGESCHLOSSEN]></td>
		</tr>

  </table>
	<table width="550">
		<tr>
			<td colspan="2">
				<input type="submit" name="save" value="Speichern" class="brief_save">
				&nbsp;
				<input type="submit" name="save" value="Speichern / Schließen" class="brief_save_close">

				<input type="button" onclick="briefDrucken([EINTRAGID]);" value="Vorschau-Druck">

				<input type="button" name="close" value="Schließen" class="anlegen_close">
			</td>
		</tr>
	</table>

</form>

<script type="text/javascript">
$( "#datum" ).datepicker({ dateFormat: "dd.mm.yy" });
$( "#uhrzeit" ).timepicker();
$( "#datum_erinnerung" ).datepicker({ dateFormat: "dd.mm.yy" });
$( "#uhrzeit_erinnerung" ).timepicker();
    $( "#adresse_mitarbeiter" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=mitarbeiter"
});
    $( "#bearbeiter" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=mitarbeiter"
});
    $( "#adresse" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=kunde"
});
</script>
