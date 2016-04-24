<div id="box1" style="display:[BOX1];">
<fieldset><legend><a href="./index.php?module=wizard&action=create&step=1">Allgemeine Informationen</a></legend>
	<table width="100%">
		<tr><td width="20%">Name:</td><td>[NAME]</td></tr>
		<tr><td>Art:</td><td>[ART]</td></tr>
		<tr><td>Artikel-Nummer:</td><td>[NUMMER]</td></tr>
		<tr><td>Projekt:</td><td>[PROJEKT]</td></tr>
		<tr><td>Standardlieferant:</td><td>[LIEFERANT]</td></tr>
	</table>
</fieldset>
</div>

<div id="box2" style="display:[BOX2];">
<fieldset><legend><a href="./index.php?module=wizard&action=create&step=text">Artikelbeschreibung</a></legend>
	<table width="100%">
		<tr><td valign="top" width="20%">Kurztext:</td><td>[KURZTEXT]</td></tr>
		<tr><td valign="top">&Uuml;bersichtstext:</td><td>[UEBERSICHTSTEXT]</td></tr>
	</table>
</fieldset>
</div>

<div id="box3" style="display:[BOX3];">
<fieldset><legend><a href="./index.php?module=wizard&action=create&step=2">Lageroptionen</a></legend>
	<table width="100%">
		<tr><td width="20%">St&uuml;ckliste:</td><td>[STUECKLISTE]</td></tr>
		<tr><td>Just-In-Time-St&uuml;ckliste:</td><td>[JITLISTE]</td></tr>
		<tr><td>Lagerartikel:</td><td>[LAGERARTIKEL]</td></tr>
		<tr><td>Chargenerwaltung:</td><td>[CHARGE]</td></tr>
		<tr><td>Endmontage:</td><td>[ENDMONTAGE]</td></tr>
		<tr><td>Seriennummer:</td><td>[SERIENNUMMER]</td></tr>
		<tr><td>Erm&auml;&szlig;igte Umsatzsteuer:</td><td>[UST]</td></tr>
	</table>
</fieldset>
</div>

<div id="box4" style="display:[BOX4];">
<fieldset><legend><a href="./index.php?module=wizard&action=create&step=preise">EK/VK Preise</a></legend>
	<table width="100%">
		<tr><td width="20%" valign="top">Einkaufspreise:</td>
				<td><table width="100%" border="0" cellspacing="1" cellpadding="0">
							<tr>
								<td><b>Lieferant</b></td>
								<td><b>Bezeichnung</b></td>
								<td><b>Artikelnummer</b></td>
								<td><b>Menge</b></td>
								<td><b>Preis</b></td>
								<td><b>Standardlieferant</b></td>
							</tr>
							[EKPREISE]
						</table>
				</td>
		</tr>
		<tr><td width="20%" valign="top">Verkaufspreise:</td>
				<td><table width="100%" border="0" cellspacing="1" cellpadding="0">
							<tr>
								<td><b>Kunde</b></td>
								<td><b>Menge</b></td>
								<td><b>Preis</b></td>
							</tr>
							[VKPREISE]
						</table>
				</td>
		</tr>
	</table>
</fieldset>
</div>

<div id="box5" style="display:[BOX5];">
<fieldset><legend><a href="./index.php?module=wizard&action=create&step=onlineshop">Shopoptionen</a></legend>
	<table width="100%">
		<tr><td width="20%">Onlineshop:</td><td>[ONLINESHOP]</td></tr>
		<tr><td>Neu:</td><td>[NEU]</td></tr>
		<tr><td>Top-Seller:</td><td>[TOPSELLER]</td></tr>
		<tr><td>Startseite</td><td>[STARTSEITE]</td></tr>
		<tr><td>Wichtig:</td><td>[WICHTIG]</td></tr>
		<tr><td>Partnerprogramm-Sperre:</td><td>[SPERRE]</td></tr>
		<tr><td valign="top">Kategorien:</td><td>[KATEGORIEN]</td></tr>
	</table>
</fieldset>
</div>

<div id="box6" style="display:[BOX6];">
<fieldset><legend><a href="./index.php?module=wizard&action=create&step=bilder">Bilder</a></legend>
	<table width="100%">
		<tr><td><b>Dateiname</b></td><td><b>Titel</b></td><td><b>Typ</b></td><td><b>Standard</b></td></tr>
    [BILDER]
  </table>
</fieldset>
</div>
<br>
