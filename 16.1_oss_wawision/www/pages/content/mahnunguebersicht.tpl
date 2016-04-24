<form action="" method="post">
<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">f&auml;llige</a></li>
        <li><a href="#tabs-2">Zahlungserinnerungen</a></li>
        <li><a href="#tabs-3">Mahnungen</a></li>
        <li><a href="#tabs-4">Inkasso</a></li>
        <li><a href="#tabs-5">Gesperrt</a></li>
        <li><a href="#tabs-6">Forderungsverluste</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
[SUB1MESSAGE]
<table width="100%" style="background-color: #CFCFD1;" align="center">
<tr>
<td align="center">
<br><b style="font-size: 14pt">Mahnlauf starten:</b>
<br>
<br><!--<button id="opener">Zeitraum einstellen</button>-->&nbsp;Drucker:&nbsp;<select name="drucker">[DRUCKER]</select>
&nbsp;<input type="submit" value="Mahnwesen starten" name="starten">&nbsp;
<br>
<br>
</td>
</tr>
</table>
<fieldset><legend>Filter</legend>
<table width="1000"><tr><td align="left">[MANUELLCHECKBOX]&nbsp;alle markieren</td>

  <td><input type="checkbox" id="rechnung">&nbsp;Rechnung</td>
  <td><input type="checkbox" id="lastschrift">&nbsp;Lastschrift</td>
  <td><input type="checkbox" id="nachnahme">&nbsp;Nachnahme</td>
  <td><input type="checkbox" id="bar">&nbsp;Bar</td>
</tr></table>
</fieldset>
<table width="100%"><tr><td width="100%">
[TAB1]
</td></tr></table>
<br>
</div>

<div id="tabs-2">
[SUB2MESSAGE]
<table width="100%" style="background-color: #CFCFD1;" align="center">
<tr>
<td align="center">
<br><b style="font-size: 14pt">Zahlungserinnerungen</b>
<br>
<br>
</td>
</tr>
</table>

[TAB2]
</div>
<div id="tabs-3">
[SUB3MESSAGE]
<table width="100%" style="background-color: #CFCFD1;" align="center">
<tr>
<td align="center">
<br><b style="font-size: 14pt">Mahnungen</b>
<br>
<br>
</td>
</tr>
</table>

[TAB3]
</div>

<div id="tabs-4">
[SUB4MESSAGE]
<table width="100%" style="background-color: #CFCFD1;" align="center">
<tr>
<td align="center">
<br><b style="font-size: 14pt">Inkasso</b>
<br>
<br>
</td>
</tr>
</table>
[TAB4]
</div>
<div id="tabs-5">
[SUB5MESSAGE]
<table width="100%" style="background-color: #CFCFD1;" align="center">
<tr>
<td align="center">
<br><b style="font-size: 14pt">Gesperrt (nicht im Mahnungslauf)</b>
<br>
<br>
</td>
</tr>
</table>
[TAB5]
</div>

<div id="tabs-6">
[SUB6MESSAGE]
<table width="100%" style="background-color: #CFCFD1;" align="center">
<tr>
<td align="center">
<br><b style="font-size: 14pt">Forderungsverluste</b>
<br>
<br>
</td>
</tr>
</table>

[TAB6]
</div>





<!-- tab view schließen -->
</div>
<!-- ende tab view schließen -->
</form>
