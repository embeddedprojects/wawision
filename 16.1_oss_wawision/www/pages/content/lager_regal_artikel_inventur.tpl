<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Inventur [LAGERPLATZ]</a></li>
        <li><a href="#tabs-2">Abschluss</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
[MESSAGE]
<div id="ajaxmessage"></div>
<form action="" method="post">
<table width="100%"><tr><td align="center">Artikel:&nbsp;[ARTIKELSTART]<input type="text" name="artikel" id="artikel" value="" style="background-color: red">[ARTIKELENDE]&nbsp;Artikel scannen!
&nbsp;<input type="submit" name="artikelbuchen" value="erfassen">
</td><td align="right">
&nbsp;<input type="button" onclick="window.location.href='index.php?module=lagerinventur&action=bestand&id=[ID]'" value="Zur&uuml;ck zum Lager" name="back">

<input type="hidden" name="regal" value="[REGAL]">
</td></tr>
</table>

<script type="text/javascript">document.getElementById("artikel").focus();</script>

<!--<table width="100%"><tr><td align="right"><input type="submit" value="Speichern" name="inventurspeichern"></td></tr></table>-->
[TAB1]
<!--<table width="100%"><tr><td align="right"><input type="submit" value="Speichern" name="inventurspeichern"></td></tr></table>-->
</form>
</div>

<!-- erstes tab -->
<div id="tabs-2">
[MESSAGE]
<form action="" method="post">
<table width="100%"><tr>
<td align="center">
[PERMISSIONINVENTURSTART]
&nbsp;<input type="button" onclick="if(!confirm('Soll die Inventur jetzt zur&uuml;ckgesetz werden? Alle Anpassungen werden gel&ouml;scht.')) return false; else window.location.href='index.php?module=lagerinventur&action=inventur&cmd=resetlagerplatz&lager_platz=[LAGERPLATZID]&id=[ID]';" value="Inventur f&uuml;r Regalplatz [LAGERPLATZ] zur&uuml;cksetzten.">
[PERMISSIONINVENTURENDE]

<input type="hidden" name="regal" value="[REGAL]">
</td></tr>
</table>

</form>
</div>

</div>
