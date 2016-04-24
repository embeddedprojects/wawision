<style>


.auftraginfo_cell {
  color: #636363;border: 1px solid #ccc;padding: 5px;
}

.auftrag_cell {
  color: #636363;border: 1px solid #fff;padding: 0px; margin:0px;
}

</style>


<table width="100%" border="0" cellpadding="10" cellspacing="5">
<tr valign="top"><td width="50%">
<h3>Artikel: [NUMMER] [NAME_DE]</h3>
<table height="250" width="100%">
<tr valign="top"><td>

<table><tr><td>[ARTIKELBILD][KURZTEXT]</td></tr></table>

<br>
<br>

<h2 class="greyh2">Verkaufspreise</h2>
<div style="padding:10px;">[VERKAUFSPREISE]</div>
<table width="100%">
  <tr><td align="right"><a href="index.php?module=artikel&action=verkauf&id=[ID]" target="_blank"><img src="./themes/new/images/edit.png"></a>
</td></tr></table>
<br>

<h2 class="greyh2">Einkaufspreise</h2>
<div style="padding:10px;">[EINKAUFSPREISE]</div>

<table width="100%">
  <tr><td align="right"><a href="index.php?module=artikel&action=einkauf&id=[ID]" target="_blank"><img src="./themes/new/images/edit.png"></a>
</td></tr></table>
<br>




<h2 class="greyh2">Eigenschaften</h2>
<div style="padding:10px;">[EIGENSCHAFTEN]</div>
<table width="100%">
  <tr><td align="right"><a href="index.php?module=artikel&action=eigenschaften&id=[ID]" target="_blank"><img src="./themes/new/images/edit.png"></a>
</td></tr></table>
<br>
<br>

<h2 class="greyh2">St&uuml;ckliste</h2>
<div style="padding:10px;">[STUECKLISTE]</div>
<table width="100%">
  <tr><td align="right"><a href="index.php?module=artikel&action=stueckliste&id=[ID]" target="_blank"><img src="./themes/new/images/edit.png"></a>
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

<div style="overflow:scroll; height:550px; width:500px;">

<div style="background-color:white">
<h2 class="greyh2">Lager [LAGERLINK]</h2>

<div style="padding:10px">[ARTIKEL]</div>

<h2 class="greyh2">Reservierungen</h2>
<div style="padding:10px;">[RESERVIERT]</div>


<h2 class="greyh2">Offene Auftr&auml;ge</h2>
<div style="padding:10px;">[AUFTRAG]</div>

<h2 class="greyh2">Offene Bestellungen</h2>
<div style="padding:10px;">[BESTELLUNG]</div>




<br><br>

</div>
</div>

</td></tr>

</table>

