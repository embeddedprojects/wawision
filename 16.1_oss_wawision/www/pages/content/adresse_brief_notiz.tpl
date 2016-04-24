<form action="" method="POST" name="brief_erstellen_form" class="brief_erstellen_form">

	<input type="hidden" name="type" value="notiz">
	<input type="hidden" name="eintragId" value="[EINTRAGID]">

	<table width="495">
		<tr>
			<td width="100">Datum:</td>
			<td><input type="text" name="datum" value="[DATUM]" style="width: 100px;" id="datum"></td>
		</tr>
   <tr>
      <td width="100">Uhrzeit:</td>
      <td><input type="text" name="uhrzeit" value="[UHRZEIT]" style="width: 100px;" id="uhrzeit"></td>
    </tr>
		<tr>
			<td width="100">Bearbeiter:</td>
			<td><input type="text" name="bearbeiter" value="[BEARBEITER]" style="width: 370px;"></td>
		</tr>
		<tr>
			<td width="100">Betreff:</td>
			<td><input type="text" name="betreff" value="[BETREFF]" style="width: 370px;"></td>
		</tr>
		<tr>
			<td>Text:</td>
			<td><textarea name="content" style="width: 370px; min-height: 180px;">[CONTENT]</textarea></td>
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
</script>
