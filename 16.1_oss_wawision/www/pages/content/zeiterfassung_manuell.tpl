
 <script>
var location2;
function successHandler(location) {
		//.push("<p>Longitude: ", location.coords.longitude, "</p>");
		//.push("<p>Latitude: ", location.coords.latitude, "</p>");
		//.push("<p>Accuracy: ", location.coords.accuracy, " meters</p>");

   var message = document.getElementById("message"), html = [];
    html.push("<img width='180' height='180' src='http://maps.google.com/maps/api/staticmap?center=", location.coords.latitude, ",", location.coords.longitude, "&markers=size:small|color:blue|", location.coords.latitude, ",", location.coords.longitude, "&zoom=14&size=180x180&sensor=false' />");
    message.innerHTML = html.join("");

		document.getElementById("gps").value = location.coords.latitude + ";" + location.coords.longitude;// + ";"+location.coords.accuracy;
}
function errorHandler(error) {
    alert('Attempt to get location failed: ' + error.message);
}

function Standpunkt()
{
	navigator.geolocation.getCurrentPosition(successHandler,errorHandler);
}

$(document).ready(function() {
 $( "#datum" ).datepicker({ dateFormat: "dd.mm.yy" });
});

$(document).ready(function () {
    $('#c1').on('change', function(){
        if ($(this).prop('checked')) {
            $('#mitarbeiterrow').show();
        }
        else {
            $('#mitarbeiterrow').hide();
            $('#mitarbeiter').val('');
        }
    });
});

$(document).ready(function () {
    $('#c2').on('change', function(){
        if ($(this).prop('checked')) {
            $('#teilprojektrow').show();
            $('#projektrow').hide();
						$('input[name=c3]').attr('checked', false);
        }
        else {
            $('#teilprojektrow').hide();
        }
    });
});


$(document).ready(function () {
    $('#c3').on('change', function(){
        if ($(this).prop('checked')) {
            $('#projektrow').show();
            $('#teilprojektrow').hide();
						$('input[name=c2]').attr('checked', false);
        }
        else {
            $('#projektrow').hide();
        }
    });
});

// Methode zum addieren/subtrahieren einer Menge an Minuten auf eine Uhrzeit
// time = Uhrzeit im Format HH:MM
// offset = Zeit in Minuten
function addMinutes(time, offset){
	// Uhrzeit wird in Stunden und Minuten geteilt
	var elements = time.split(":");
	var hours = elements[0];	
	var minutes = elements[1];
	// Aufrunden des Offsets fuer den Fall, dass eine Fliesskommazahl uebergeben wird
	var roundOffset = Math.ceil(offset);
	
	// Umrechnen der Uhrzeit in Minuten seit Tagesbeginn
	var timeSince24 = (hours * 60) + parseInt(minutes);
	// Addieren des uebergebenen Offsets
        timeSince24 = timeSince24 + parseInt(roundOffset);

	// Ueberlaufbehandlung
	if(timeSince24 < 0)
		timeSince24 = timeSince24 + 1440;
	else if(timeSince24 > 1440)
		timeSince24 = timeSince24 - 1440;
	
	// Errechnen von Stunden und Minuten aus dem Gesamtzeit seit Tagesbeginn
	var resMinutes = timeSince24 % 60;
	var resHours = (timeSince24 - resMinutes)/60;
	
	// Sicherstellen, dass der Wert fuer Minuten immer zweistellig ist
	if(resMinutes < 10)
		resMinutes = "0" + resMinutes;
		
	// Ausgabe des formatierten Ergebnisses
	return resHours + ":" + resMinutes;
}


function BerechneEndzeit(minuten)
{

	var vonzeit = document.getElementById("vonZeit").value;

	document.getElementById("bisZeit").value = addMinutes(vonzeit,minuten);
}


</script>

<form action="" method="post" name="eprooform">
<!--<br><div class="info">Bitte geben Sie max. Einheiten von 1-3 Stunden an.</div><br>-->
<input type="hidden" name="art" value="arbeit">
<fieldset><legend>Zeit erfassen</legend>
<table>
 <tr><td>Am:</td>
	<td colspan="3">
 <input type="text" name="datum" id="datum" size="9" value="[DATUM]" class="pflicht" maxlength="">&nbsp;von&nbsp;
<input type="text" name="vonZeit" id="vonZeit" size="4" value="[VONZEIT]" class="pflicht">&nbsp;Uhr (HH:MM)&nbsp;Bis:&nbsp;
 <input type="text" name="bisZeit" id="bisZeit" size="4"  value="[BISZEIT]" class="pflicht">&nbsp;Uhr (HH:MM)
&nbsp;<input type="button" value="15 Min" onclick="BerechneEndzeit(15);">&nbsp;
	<input type="button" value="30 Min" onclick="BerechneEndzeit(30);">&nbsp;
	<input type="button" value="45 Min" onclick="BerechneEndzeit(45);">&nbsp;
<input type="button" value="1 Std" onclick="BerechneEndzeit(60);">&nbsp;
<input type="button" value="2 Std" onclick="BerechneEndzeit(120);">
</td></tr>
 <tr><td width="250"></td><td colspan="3"><i>Bitte die Pausen gesondert als Pausen (nicht Arbeit) buchen.</i></td></tr>

 <tr><td width="250">Kurze Beschreibung:</td><td colspan="3"><select name="art">[ART]</select>&nbsp;<input type="text" name="aufgabe" size="53" value="[AUFGABE]" class="pflicht"></td></tr>
 <tr><td width="250"></td><td colspan="3">
<input type="checkbox" id="c1" [ANDERERMITARBEITER]>&nbsp;f&uuml;r anderen Mitarbeiter Zeit buchen
</td></tr>
<tr id="mitarbeiterrow" style="display:[DISPLAYANDERERMITARBEITER]"><td width="250">Zeit f&uuml;r anderen Mitarbeiter buchen:</td><td>[MITARBEITERSTART]<input type="text" id="mitarbeiter" size="82" name="mitarbeiter" value="[MITARBEITER]">[MITARBEITER_END]</td></tr>
 <tr><td>Details:</td><td colspan="2" nowrap><textarea type="text" name="beschreibung" cols="72" rows="5" class="pflicht">[BESCHREIBUNG]</textarea></td><td><div id="message">[GPSIMAGE]</div></td></tr>
 <tr><td>Interner Kommentar:</td><td colspan="2" nowrap><textarea type="text" name="internerkommentar" cols="72" rows="3">[INTERNERKOMMENTAR]</textarea></td><td><div id="message">[GPSIMAGE]</div></td></tr>
 <tr><td width="250">Ort (wenn extern):</td><td colspan="2"><input type="text" id="ort" name="ort" size="72" value="[ORT]"><input type="hidden" id="gps" name="gps"  value="[GPS]">&nbsp;</td><td align="center">[GPSBUTTON]</td></tr>

</table>
</fieldset>

<fieldset><legend>Erweiterte Erfassung</legend>
<table>
<tr id="teilprojektrow" style="display:"><td width="250">Teilprojekt:</td><td><select name="arbeitspakete" onchange="if(this.value==0)$('#projektrow').show(); else $('#projektrow').hide();">[PAKETAUSWAHL]</select></td></tr>
</table>

<table id="projektrow" style="display:[PROJEKTROW]">
	<tr><td width="250">Projekt:</td><td>[PROJEKT_MANUELLAUTOSTART]<input type="text" id="projekt_manuell" size="72" name="projekt_manuell" value="[PROJEKT_MANUELL]">[PROJEKT_MANUELLAUTOEND]</td></tr>

</table>
</fieldset>
<br>
<fieldset><legend>Erweiterte Erfassung</legend>
<table>
	<tr><td width="250">Verrechnungsart:</td><td>[VERRECHNUNGSARTSTART]<input type="text" id="verrechnungsart" size="72" name="verrechnungsart" value="[VERRECHNUNGSART]">[VERRECHNUNGSART_END]</td></tr>
	<tr><td width="250">Kostenstelle:</td><td>[KOSTENSTELLLESTART]<input type="text" id="kostenstelle" size="72" name="kostenstelle" value="[KOSTENSTELLE]">[KOSTENSTELLE_END]</td></tr>
</table>
</fieldset>
<!--
<fieldset><legend>Abrechnung</legend>
<table>
<tr><td width="250">Abgerechnet:</td><td><input type="checkbox" name="abgerechnet" value="1" [ABGERECHNET]>&nbsp;<i>Markierung wenn Zeit Kunde in Rechnung gestellt wurde</i></td></tr>
</table>
</fieldset>
-->


<br><br>
<center>&nbsp;[BUTTON]</center>
<br><br>

<br>
<br>
<br>

</form>
<!--
<fieldset><legend>Heute gebuchten Zeiten</legend>
[TABELLE]
</fieldset>-->
<!--
<hr>
z.B.:<br><br>
<table>
 <tr><td width="250">T&auml;tigkeit:</td><td colspan="3"><input readonly type="text" value="Online-Shop verpacken" name="" size="63"></td></tr>
 <tr><td>Von:</td><td colspan="3"><input type="text" name="" size="4" readonly value="09:00">&nbsp;Uhr (HH:MM)&nbsp;Bis:&nbsp;
 <input type="text" name="" size="4" value="11:00" readonly >&nbsp;Uhr (HH:MM)&nbsp;am&nbsp;&nbsp;
 <input type="text" name="" size="9" value="[DATUM]" readonly maxlength="">
 <input type="button" value="Datum"></td></tr>
 <tr><td>Beschreibung:</td><td colspan="3"><textarea readonly type="text" name="" cols="72" rows="5">Shop verpacken und Versand</textarea></td></tr>
</table> 
-->
<br>
