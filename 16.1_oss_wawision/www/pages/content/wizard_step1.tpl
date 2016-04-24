<form action="" method="POST" name="wizardform">
<table align="center" width="550">
<tr valign="top"><td><b>Artikelbezeichnung (Pflichtfeld):</b></td><td><input type="text" name="name" value="[NAME]" size="40"><br><i>Ihre Bezeichnung f&uuml;r den Artikel.</i></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<!--<tr valign="top"><td>Ihre Artikelnummer:</td><td><input type="text" name="nummer" value="[NUMMER]" size="40"><br><i>Gerne k&ouml;nnen Sie hier eine eigene Nummer eintragen, bzw. wird eine
Nummer automatisch vergeben, falls Sie das Feld leer lassen.</i></td></tr>-->
<tr valign="top"><td>Projekt (optional):</td><td>[PROJEKTSTART]<input type="text" name="projekt" id="projekt" value="[PROJEKT]" size="40">[PROJEKTENDE]<i>Hier k&ouml;nnen Sie den Artikel einem speziellen Projekt zuordnen.</i></td></tr>
<tr valign="top"><td>Standardlieferant (optional):</td><td>[LIEFERANTSTART]<input type="text" name="standardlieferant" id="lieferant" value="[STANDARDLIEFERANT]" size="40">[LIEFERANTENDE]
<i>Hier kann ein Standardlieferant hinterlegt werden.</i></td></tr>
</table>
<br><br>
<center>
<input style="width: 15em; height: 4em;" type="submit" name="ware" value="Ware f&uuml;r Verkauf">&nbsp;
<input style="width: 15em; height: 4em;" type="submit" name="produktion" value="Produktionsmaterial">&nbsp;
<input style="width: 15em; height: 4em;" type="submit" name="dienst" value="Dienst-/Fremdleistung">
</center>
<br>
<center>
<input style="width: 15em; height: 4em;" type="submit" name="miete" value="Geb&uuml;hr / Miete">&nbsp;
<input style="width: 15em; height: 4em;" type="submit" name="porto" value="Porto">&nbsp;
<input style="width: 15em; height: 4em;" type="submit" name="sonstiges" value="Sonstiges">
</center>
</form>
