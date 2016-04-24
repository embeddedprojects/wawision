<!-- gehort zu tabview -->
<div id="tabs">
<ul>
        <li><a href="#tabs-1">Online-Shops</a></li>
    </ul>

<!-- erstes tab -->
<div id="tabs-1">
[MESSAGE]
<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr valign="top" colspan="3">
        <td >
<fieldset><legend>Einstellungen</legend>
    <table width="100%">
	  <tr><td>Aktiv:</td><td>[AKTIV][MSGAKTIV]</td><td></tr>
          <tr><td width="300">Bezeichnung:</td><td>[BEZEICHNUNG][MSGBEZEICHNUNG]</td></tr>
<!--          <tr><td>Typ:</td><td>[TYP][MSGTYP]</td></tr>-->
	  <tr><td>Projekt:</td><td>[PROJEKTAUTOSTART][PROJEKT][MSGPROJEKT][PROJEKTAUTOEND]</td></tr>

	  <tr><td>UTF8 Codierung:</td><td>[UTF8CODIERUNG][MSGUTF8CODIERUNG]</td><td></tr>
	 </table></fieldset>
<fieldset><legend>Optionen</legend>
    <table width="100%">
	  <tr><td>Multiprojekt Shop:</td><td>[MULTIPROJEKT][MSGMULTIPROJEKT]&nbsp;<i>In diesem Shop werden Artikel aus verschiedenen Projekten angeboten</i></td><td></tr>
	  <tr><td>Vorab als bezahlt markieren:</td><td>[VORABBEZAHLTMARKIEREN_OHNEVORKASSE_BAR][MSGVORABBEZAHLTMARKIEREN_OHNEVORKASSE_BAR]&nbsp;<i>(Ohne Vorkasse, Bar, Nachnahme und Rechnung)</td><td></tr>
	  <tr><td>Artikel &Uuml;bertragung erlauben:</td><td>[ARTIKELEXPORT][MSGARTIKELEXPORT]&nbsp;<i>(Von WaWision zu Shop)</td><td></tr>
	<tr><td>Lagerzahlen &Uuml;bertragung erlauben:</td><td>[LAGEREXPORT][MSGLAGEREXPORT]&nbsp;<i>(Von WaWision zu Shop)</i></td><td></tr>
	  <tr><td>Auftragsstatus r&uuml;ckmelden:</td><td>[AUFTRAGABGLEICH][MSGAUFTRAGABGLEICH]&nbsp;<i>(Von WaWision zu Shop)</td><td></tr>
	  <tr><td>Automatischer Abgleich:</td><td>[ARTIKELIMPORT][MSGARTIKELIMPORT]&nbsp;immer&nbsp;<i>(Automatisch Preis aus Shop &uuml;bernehmen + fehlende Artikel neu anlegen)</i></td><td></tr>
	  <tr><td></td><td>[ARTIKELNUMMERNUMMERKREIS][MSGARTIKELNUMMERNUMMERKREIS]&nbsp;Artikelnummern aus Nummernkreis &uuml;bernehmen&nbsp;</td><td></tr>
    <tr><td></td><td>[ARTIKELIMPORTEINZELN][MSGARTIKELIMPORTEINZELN]&nbsp;einzeln&nbsp;<i>(Nur bei Artikeln mit Option: Artikel->Online-Shop Optionen->Online Shop Abgleich)</i></td><td></tr>

</table></fieldset>
<fieldset><legend>Artikel f&uuml;r Porto und Nachnahmegeb&uuml;hr</legend>
    <table width="100%">
	  <tr><td width="300">Porto:</td><td>[ARTIKELPORTOAUTOSTART][ARTIKELPORTO][MSGARTIKELPORTO][ARTIKELPORTOAUTOEND]&nbsp;<i>Artikel-Nr. auf die das Porto gebucht wird.</i></td></tr>
	  <tr><td>Nachnahmegeb&uuml;hr als extra Position:</td><td>[ARTIKELNACHNAHME_EXTRAARTIKEL][MSGARTIKELNACHNAHME_EXTRAARTIKEL]</td></tr>
	  <tr><td>Nachnahmegeb&uuml;hr:</td><td>[ARTIKELNACHNAHMEAUTOSTART][ARTIKELNACHNAHME][MSGARTIKELNACHNAHME][ARTIKELNACHNAHMEAUTOEND]&nbsp;<i>Artikel-Nr. f&uuml;r die Nachnahme Geb&uuml;hr.</i></td></tr>
	 </table></fieldset>
<fieldset><legend>Zugangsdaten f&uuml;r WaWision Import Plugin</legend>
    <table width="100%">
	  <tr><td>URL:</td><td>[URL][MSGURL]&nbsp;<i>URL zur Importer (<a href="http://shop.wawision.de/online-shop" target="_blank">Schnittstelle f&uuml;r WaWision</a>)</i></td><td></tr>
	  <tr><td width="300">ImportKey:</td><td>[PASSWORT][MSGPASSWORT]&nbsp;<i>32 Zeichen langes Sicherheitspasswort</i></td><td></tr>
	  <tr><td>ImportToken:</td><td>[TOKEN][MSGTOKEN]&nbsp;<i>6 Zeichen langes Sicherheitstoken</i></td><td></tr>
<!--	  <tr><td>Challenge:</td><td>[CHALLENGE][MSGCHALLENGE]</td><td></tr>-->
	  <tr><td>Demo Modus:</td><td>[DEMOMODUS][MSGDEMOMODUS]&nbsp;<i>Es wird der letzte Auftrag aus dem Shop geladen - der Status aber nicht umgestellt.</i></td><td></tr>
	  <tr><td>Einzel Sync:</td><td>[EINZELSYNC][MSGEINZELSYNC]&nbsp;<i>Es wird immer nur max 1 Auftrag &uuml;bertragen. Hilfsfunktion f&uuml;r Umstellung von Shop auf WaWision.</i></td><td></tr>


 	<!--	  <tr><td>Internes CMS:</td><td>[CMS][MSGCMS]</td><td></tr>-->
</table></fieldset>



</td></tr>

    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" value="Speichern" />
    </tr>
  
    </tbody>
  </table>
</form>

</div>

<!-- tab view schließen -->
</div>


