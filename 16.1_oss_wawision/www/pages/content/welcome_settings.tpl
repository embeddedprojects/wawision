<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Passwort</a></li>
        <li><a href="#tabs-2">Einstellungen</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
[MESSAGE]
<form action="#tabs-1" method="post">
<table><tr>
	<td>Passwort:</td><td><input type="password" name="password" value="[PASSWORD]" size="20"></td>
	<td>Passwort wdh.:</td><td><input type="password" name="passwordre" size="20" value="[PASSWORD]"></td>
	<td><input type="submit" value="Passwort &auml;ndern" name="submit_password"></td>
</tr></table>
</form>
</div>


<!-- erstes tab -->
<div id="tabs-2">
[MESSAGE]
<form action="#tabs-2" method="post">
<table><tr>
	<td>Startseite:</td><td><input type="text" name="startseite" value="[STARTSEITE]" size="80"></td>
	<td><input type="submit" value="Startseite &auml;ndern" name="submit_startseite"></td></tr>
	<tr><td></td><td>Beispiel: <i>index.php?module=welcome&action=pinwand</i> (f&uuml;r Pinwand)</td>
	<td></td>

</tr></table>
</form>
</div>

<!-- tab view schließen -->
</div>

