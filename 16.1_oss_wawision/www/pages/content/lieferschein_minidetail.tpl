<style>


.auftraginfo_cell {
  color: #636363;border: 1px solid #ccc;padding: 5px;
}

.auftrag_cell {
  color: #636363;border: 1px solid #fff;padding: 0px; margin:0px;
}

</style>


<table width="100%" border="0" cellpadding="10" cellspacing="5">
<tr valign="top"><td>
<br><center>[MENU]</center>
<br>
<table height="250" width="100%">
<tr valign="top"><td>
<table cellspacing="0" cellpadding="0" style="font-size: 8pt; background: white; color: #333333; border-collapse: collapse; border: 2px solid #cccccc;" width="100%">
<tr><td class="auftraginfo_cell">Kunde:</td><td colspan="4" class="auftraginfo_cell">[KUNDE]</td></tr>
<tr><td class="auftraginfo_cell" colspan="2" width="50%"><b>Allgemein</b></td><td width="10" class="auftraginfo_cell"></td><td class="auftraginfo_cell" colspan="2"><b>Zahlung</b></td></tr>
<tr><td class="auftraginfo_cell">Status:</td><td class="auftraginfo_cell">[STATUS]</td><td class="auftraginfo_cell" width="25%">Zahlweise:</td><td class="auftraginfo_cell">[ZAHLWEISE]</td></tr>
<tr><td class="auftraginfo_cell">Projekt:</td><td class="auftraginfo_cell">[PROJEKT]</td><td class="auftraginfo_cell">Angebotssumme:</td><td class="auftraginfo_cell">[GESAMTSUMME]</td></tr>
<tr><td class="auftraginfo_cell">Auftrag:</td><td class="auftraginfo_cell">[AUFTRAG]</td><td class="auftraginfo_cell">Versteuerung:</td><td class="auftraginfo_cell">[STEUER]</td></tr>
<tr><td class="auftraginfo_cell">Tracking:</td><td class="auftraginfo_cell">[TRACKING]</td><td class="auftraginfo_cell"></td><td class="auftraginfo_cell"></td></tr>
</table>

<table width="100%" cellpadding="5">
<tr><td>
<div style="background-color:white">
<h2 class="greyh2">Lieferadresse</h2>
<div style="padding:10px">
  [LIEFERADRESSE]
</div>
</div>
</td></tr></table>
<!--
<table width="100%">
<tr>
  <td style="background:[ANGEBOTFARBE]; color: white; font-weight: bold;">Angebot:<br>[ANGEBOTTEXT]</td>
</tr>
</table>
-->

</td></tr>
</table>

</td><td width="550">  

 <div style="overflow:scroll; height:550px">
<div style="background-color:white">
<div width="100%" style="background-color:#999;"><h2 class="greyh2">Artikel</h2></div>

<div style="padding:10px">
 [ARTIKEL]</div>
<h2 class="greyh2">Protokoll</h2>
<div style="padding:10px;overflow:auto; width:500px;">
  [PROTOKOLL]</div>
<div style="background-color:white">
<h2 class="greyh2">PDF-Archiv</h2>
<div style="padding:10px;overflow:auto; width:500px;">
  [PDFARCHIV]
</div>
</div>
<br><br>
[LIEFERANTENRETOUREINFOSTART]
<form action="" method="post">
<input type="hidden" name="lieferscheinid" value="[LIEFERSCHEINID]">
<table><tr><td>
Hinweise f&uuml;r Lieferanten Lieferungen:<br>
<textarea rows="5" cols="100" name="lieferantenretoureinfo">[LIEFERANTENRETOUREINFO]</textarea>
</td></tr><tr><td align="right"><input type="submit" value="Speichern" name="speichern"></td></tr></table>
</form>
[LIEFERANTENRETOUREINFOENDE]

</div>
</div>

</td></tr>

</table>

