[MESSAGE]
<fieldset><legend>Artikel Neu</legend>
<form method="post" action="">
<table align="center" cellspacing="5" border="0">
<tr><td width="170">Artikel (Deutsch):</td><td colspan="4"><input type="text" id="name_de"  class="0"
    name="name_de"  value="[NAME_DE]"  size="70" maxlength="50"
    maxlength=""  ></td></tr>

<tr><td width="170">Bestellnummer:</td><td width="180"><input type="text" id="bestellnummer"  class="0"
    name="bestellnummer"  value="[BESTELLNUMMER]"  size="20"
    maxlength=""  ></td><td width="20">&nbsp;</td><td width="150">Bezeichnung</td><td width="170"><input name="bezeichnunglieferant" id="bezeichnungliefeant" value="[BEZEICHNUNGLIEFERANT]" type="text" size="20">
    </td></tr>


<tr><td>Artikelgruppe</td><td><select name="typ" size="0" 
      id=""  class="" onchange="">
[ARTIKELGRUPPE]
    </select>
              </td><td></td><td>Standardlieferant:</td><td>[LIEFERANTSTART]<input name="adresse" value="[ADRESSE]"type="text" id="adresse" size="20">[LIEFERANTENDE]
    </td></tr>

[LIEFERSCHEINIF]
[LIEFERSCHEINELSE]
<tr><td width="170">Preis (Einkauf):</td><td width="180"><input type="text" id="preis"  class="0"
    name="preis"  value="[PREIS]"  size="20"
    maxlength=""  ></td><td width="20">&nbsp;</td><td width="150">Erm&auml;&szlig;igte Umsatzsteuer:</td><td width="170"><input type="checkbox" name="umsatzsteuerklasse" value="1">
    </td></tr>
[LIEFERSCHEINENDIF]


<tr><td width="170">Menge:</td><td width="180"><input type="text" id="menge"  class="0"
    name="menge"  value="[MENGE]"  size="20"
    maxlength=""  ></td><td width="20">&nbsp;</td><td width="150">Projekt</td><td width="170">[PROJEKTSTART]<input name="projekt" id="projekt" value="[PROJEKT]" type="text" size="20">[PROJEKTENDE]
    </td></tr>

 <tr><td>Kurztext (DE):</td><td colspan="4"><textarea rows="2" id="kurztext_de" class=""
       name="kurztext_de" cols="70" 
        >[KURZTEXT_DE]</textarea></td></tr>

<tr><td>Interner Kommentar:</td><td colspan="4"><textarea rows="2" id="internerkommentar" class=""
       name="internerkommentar" cols="70" 
        >[INTERNERKOMMENTAR]</textarea></td><tr>

<tr><td></td><td colspan="4">
        <input type="submit" value="Artikel anlegen" name="anlegen"></td><tr>

</table>
</form>

</fieldset>
<br>
<fieldset><legend>Artikel-/Preistabelle von [KUNDE]</legend>
<table cellpadding="5" width="100%"><tr><td>
[ARTIKEL]</td></tr></table>
</fieldset>
