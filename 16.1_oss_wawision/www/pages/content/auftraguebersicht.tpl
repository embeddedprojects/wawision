
<script type="text/javascript">

document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) {
        alert("Escape");
    }
};
</script>

<div id="tabs">
<ul>
        <li><a href="#tabs-1">Auftr&auml;ge</a></li>
<!--        <li><a href="#tabs-3">Offene Auftr&auml;ge</a></li>-->
[STARTDISABLEIMPORT]<li><a href="#tabs-4">Import [IMPORTWARTESCHLANGENAME]</a></li>[ENDEDISABLEIMPORT]
        <li><a href="#tabs-5">in Bearbeitung</a></li>
 </ul>
<div id="tabs-1">
<table height="80" width="100%"><tr><td>
<fieldset><legend>&nbsp;Status</legend>
<table width="100%" cellspacing="5">
<tr>
  <td><input type="checkbox" id="auftragoffene"><br>Offene</td>
  <td><input type="checkbox" id="auftragstornierte"><br>Stornierte</td>
  <td><input type="checkbox" id="auftragabgeschlossene"><br>Abgeschlossene</td>
</tr></table>
</fieldset>

</td><td>
<fieldset><legend>&nbsp;Filter</legend>
<table width="100%" cellspacing="5">
<tr>
  <td nowrap><input type="checkbox" name="artikellager" id="artikellager" value="A"><br>Artikel fehlt</td>
  <td><input type="checkbox" name="teillieferung" id="teillieferung"><br>Teillieferung m&ouml;gl.</td>
  <td><input type="checkbox" id="ustpruefung"><br>UST-Pr&uuml;f. fehlt</td>
  <td><input type="checkbox" id="zahlungseingang"><br>Zahlung ok</td>
  <td><input type="checkbox" id="zahlungseingangfehlt"><br>Zahlung fehlt</td>
  <td><input type="checkbox" id="portofehlt"><br>Porto fehlt</td>
  <td><input type="checkbox" id="manuellepruefung"><br>Manuelle Pr&uuml;f.</td>
  <td><input type="checkbox" id="teilzahlung"><br>Teilzahlung</td>
  <td><input type="checkbox" id="ohnerechnung"><br>ohne Rechnung</td>
  <td><input type="checkbox" id="auftragheute"><br>Heute</td>
</tr>
</table>
</fieldset>

</td></tr></table>

[MESSAGE]
[TAB1]
</div>
<!--
<div id="tabs-3">
<table height="80" width="100%"><tr><td></td></tr></table>
[TAB33]
<table width="100%"><tr><td><input type="submit" value="Auto-Versand starten" name="submit">
</td><td align="right"><input type="submit" value="andere Option w&auml;hlen" name="submit"></td></tr></table>
</div>
-->
<div id="tabs-4">
[TAB4]
</div>
<div id="tabs-5">
[TAB5]
</div>




</div>

