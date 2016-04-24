<script type="text/javascript">

	$(document).ready(function(){

 		document.getElementById('rabattstyle').style.display="none";

    if(document.getElementById('rabatt').checked)
      document.getElementById('rabattstyle').style.display="";

  });


  function rabattevent()
        {
          document.getElementById('rabattstyle').style.display="none";
    if(document.getElementById('rabatt').checked)
      document.getElementById('rabattstyle').style.display="";
        }


	function juststuecklisteevent(cmd)
  {
    		if(document.getElementById('juststueckliste').checked)
				{
					document.getElementById("stueckliste").checked = true;
				}
				else
				{
					document.getElementById("stueckliste").checked = false;
				}
					
   }
      //-->
</script>

[SAVEPAGEREALLY]

<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]

[LEERFELD][MSGLEERFELD]

<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Artikel</a></li>
[DISABLEOPENTEXTE]<li><a href="#tabs-2">Texte und Beschreibungen</a></li>[DISABLECLOSETEXTE]
[DISABLEOPENPARAMETER]<li><a href="#tabs-3">Parameter und Freifelder</a></li>[DISABLECLOSEPARAMETER]
        [DISABLEOPENSHOP]<li><a href="#tabs-4">Online-Shop Optionen</a></li>[DISABLECLOSESHOP]
        <li><a href="#tabs-5">Finanzbuchhaltung</a></li>
    </ul>

<!-- ende gehort zu tabview -->

<div id="tabs-1">


  <table class="tableborder" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>

      <tr valign="top" cellpadding="0" cellspacing="0">
        <td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%">[STATUSICONS]</td>
<td align="center" nowrap><b style="font-size: 14pt">Artikel <font color="blue">[ANZEIGENUMMER]</font></b>[ANZEIGENAMEDE]</td>
<td align="right">[ICONMENU]&nbsp; <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-1';"/> [ABBRECHEN]</td>

</tr>
</table>
<div style="height:10px"></div>
</td></tr>


      <tr valign="top" colspan="3">
        <td>


[MESSAGE]


<fieldset><legend>&nbsp;Name und Nummer des Artikel&nbsp;</legend>
<table cellspacing="5" border="0">
<tr><td width="200">Artikel (DE):</td><td colspan="4">[NAME_DE][MSGNAME_DE]</td></tr>
<tr><td width="">Artikel Nr.:</td><td width="180">[NUMMER][MSGNUMMER]</td><td width="20">&nbsp;</td><td width="150">Projekt:</td><td width="">[PROJEKTSTART][PROJEKT][MSGPROJEKT][PROJEKTENDE]</td></tr>
<tr><td>Artikelkategorie</td><td>[TYP][MSGTYP]
              </td><td></td><td>Standardlieferant:</td><td>[ADRESSE][MSGADRESSE]</td></tr>

 <tr><td nowrap>Artikelbeschreibung (DE):<br><i>f&uuml;r Angebote, Auftr&auml;ge, etc.</i></td><td colspan="4">[ANABREGS_TEXT][MSGANABREGS_TEXT]</td></tr>
 <tr><td nowrap>Kurztext (DE):<br><i>f&uuml;r Suche oder Online-Shops</i></td><td colspan="4">[KURZTEXT_DE][MSGKURZTEXT_DE]</td></tr>

<tr><td>Interner Kommentar:</td><td colspan="4">[INTERNERKOMMENTAR][MSGINTERNERKOMMENTAR]</td><tr>

</table>
</fieldset>

<table width="100%" cellpadding="0" cellspacing="0">
<tr><td width="50%">

<fieldset style="height:200px"><legend>Hersteller</legend>
<table cellspacing="5" border="0">
<tr><td width="200">Hersteller:</td><td>[HERSTELLERSTART][HERSTELLER][MSGHERSTELLER][HERSTELLERENDE]</td></tr>
<tr><td width="">Herstellerlink:</td><td>[HERSTELLERLINKSTART][HERSTELLERLINK][MSGHERSTELLERLINK][HERSTELLERLINKENDE]</td></tr>
<tr><td width="">Hersteller Nr.:</td><td>[HERSTELLERNUMMER][MSGHERSTELLERNUMMER]</td></tr>
<tr><td width="">EAN Nr. / Barcode:</td><td>[EAN][MSGEAN]</td><td width="">&nbsp;</td></tr>
<tr><td width="">Zolltarifnummer:</td><td>[ZOLLTARIFNUMMER][MSGZOLLTARIFNUMMER]</td><td width="">&nbsp;</td></tr>
<tr><td width="">Herkunftsland:</td><td>[HERKUNFTSLAND][MSGHERKUNFTSLAND]</td><td width="">&nbsp;</td></tr>
</table>
</fieldset>
</td><td>

<fieldset style="height:200px"><legend>Lager / Abmessungen</legend>
<table cellspacing="5" border="0">
<tr><td width="120">Min. Lagermenge:</td><td width="170">[MINDESTLAGER][MSGMINDESTLAGER]</td><td width="130">Gewicht (in kg):</td><td>[GEWICHT][MSGGEWICHT]</td></tr>
<tr><td width="120">Min. Bestellmenge:</td><td>[MINDESTBESTELLUNG][MSGMINDESTBESTELLUNG]</td><td width="130">L&auml;nge (in cm):</td><td>[LAENGE][MSGLAENGE]</td></tr>
<tr><td width="120">Standardlager:</td><td>[LAGER_PLATZSTART][LAGER_PLATZ][MSGLAGER_PLATZ][LAGER_PLATZENDE]</td><td width="130">Breite (in cm):</td><td>[BREITE][MSGBREITE]</td></tr>
<tr><td width="120">Einheit:</td><td>[EINHEIT][MSGEINHEIT]</td><td width="130">H&ouml;he (in cm):</td><td>[HOEHE][MSGHOEHE]</td></tr>
</table>
</fieldset>


</td></tr></table>
[DISABLEOPENSTOCK]

<table width="100%" cellpadding="0" cellspacing="0">
<tr><td width="50%">
<fieldset><legend>&nbsp;Artikel Optionen&nbsp;</legend>
<table cellspacing="5" height="90" border="0">
<tr><td width="200"><font color="#961F1C">Lagerartikel:</font></td><td width="">[LAGERARTIKEL][MSGLAGERARTIKEL]</td></tr>
<tr><td width=""><font color="#961F1C">Artikel ist Porto:</font></td><td>[PORTO][MSGPORTO]</td></tr>
<tr><td width=""><font color="#961F1C">Artikel ist Rabatt:</font></td><td width="">[RABATT][MSGRABATT]&nbsp;<span id="rabattstyle">[RABATT_PROZENT][MSGRABATT_PROZENT] in %</span></td></tr>
</table>
</fieldset>
</td><td>

<fieldset><legend>&nbsp;Varianten&nbsp;</legend>
<table align="center" cellspacing="5" height="90" width="100%">
<tr><td>Variante:</td><td>[VARIANTE][MSGVARIANTE]</td><td>von Artikel:&nbsp;[ARTIKELSTART][VARIANTE_VON][MSGVARIANTE_VON][ARTIKELENDE]</td></tr>
<tr><td></td><td><font color="">&nbsp;</font></td></tr>
<tr><td>
<!-- 
Matrixprodukt:
 -->
</td><td>
<!-- 
[MATRIXPRODUKT][MSGMATRIXPRODUKT]
 -->
</td></tr>
</table>
</fieldset>


</td></tr></table>

[DISABLECLOSESTOCK]

[ARTIKELKUNDENSPEZIFISCH]



<fieldset><legend>&nbsp;Sonstige Einstellung&nbsp;</legend>

<table cellspacing="5" border="0">

[DISABLEOPENSTOCK]
<tr>
<td width="200">Erm&auml;&szlig;igte Umsatzsteuer:</td>
<td width="200">[UMSATZSTEUER][MSGUMSATZSTEUER]</td>
  <td width="122">&nbsp;</td>
  <td width="200">St&uuml;ckliste:</td><td>[STUECKLISTE][MSGSTUECKLISTE]</td>
</tr>

<tr>
<td width="">Kein Rabatt erlaubt</td><td width="">[KEINRABATTERLAUBT][MSGKEINRABATTERLAUBT]</td>
<td></td>
<td>Just-In-Time St&uuml;ckliste:</td><td>[JUSTSTUECKLISTE][MSGJUSTSTUECKLISTE]&nbsp;<i>Explodiert im Auftrag</i></td>
</tr>
[DISABLECLOSESTOCK]
<tr>
<td width="200">Chargenverwaltung:</td><td width="">[CHARGENVERWALTUNG][MSGCHARGENVERWALTUNG]</td>
<td width="122"></td>
<td width="200"><!--Auto-Bestellung:--></td><td width="">[DISABLEOPENSTOCK][KEINEEINZELARTIKELANZEIGEN][MSGKEINEEINZELARTIKELANZEIGEN]&nbsp;<i>Einzelpos. ausblenden</i>[DISABLECLOSESTOCK]<!--[AUTOBESTELLUNG][MSGAUTOBESTELLUNG]--></td>
</tr>


<tr><td width="">Seriennummern:</td><td> [SERIENNUMMERN][MSGSERIENNUMMERN] </td>
<td></td>
<td>[DISABLEOPENSTOCK]Produktionsartikel:[DISABLECLOSESTOCK]</td><td>[DISABLEOPENSTOCK][PRODUKTION][MSGPRODUKTION][DISABLECLOSESTOCK]</td>
</tr>
<tr>
<td>Mindesthaltbarkeitsdatum:</td><td>[MINDESTHALTBARKEITSDATUM][MSGMINDESTHALTBARKEITSDATUM]</td>
<td></td>
<td>[DISABLEOPENSTOCK]Ger&auml;t:[DISABLECLOSESTOCK]</td><td>[DISABLEOPENSTOCK][GERAET][MSGGERAET][DISABLECLOSESTOCK]</td>
</tr>


[DISABLEOPENSTOCK]
<tr>
<td>Einkauf bei allen Lieferanten:</td><td>[ALLELIEFERANTEN][MSGALLELIEFERANTEN]</td>
<td></td>
<td>Serviceartikel:</td><td>[SERVICEARTIKEL][MSGSERVICEARTIKEL]</td>
</tr>

<tr>
<td></td><td></td>
<td></td>
<td>Geb&uuml;hr:</td><td>[GEBUEHR][MSGGEBUEHR]</td>
</tr>

[DISABLECLOSESTOCK]





</table>
</fieldset>

[DISABLEOPENSTOCK]
<fieldset><legend>&nbsp;Sperre&nbsp;</legend>
<table cellspacing="5" border="0">
<tr><td width="200">Interner Sperre:</td><td colspan="4">[INTERN_GESPERRTGRUND][MSGINTERN_GESPERRTGRUND]</td><tr>
<tr><td>Sperre aktiv:</td><td colspan="4">[INTERN_GESPERRT][MSGINTERN_GESPERRT]</td><tr>
</table>
</fieldset>


<fieldset><legend>&nbsp;Kundenfreigabe&nbsp;</legend>
<table cellspacing="5" border="0">
<tr><td width="200">Pr&uuml;fung notwendig:</td><td colspan="4">[FREIGABENOTWENDIG][MSGFREIGABENOTWENDIG]&nbsp;<i>z.B. Artikel der nur an Fachleute verkauft werden darf.</i></td><tr>
<tr><td>Freigabe Regel:</td><td colspan="4">[FREIGABEREGEL][MSGFREIGABEREGEL]</td><tr>
</table>
</fieldset>


[DISABLECLOSESTOCK]


        </td>
      </tr>
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="1" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-1';"/> [ABBRECHEN]</td>
    </tr>


    </tbody>
  </table>

 </div>
[DISABLEOPENSTOCK]
<div id="tabs-2">
  <table class="tableborder" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
      <tr valign="top" cellpadding="0" cellspacing="0">
        <td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%">[STATUSICONS]</td>
<td align="center" nowrap><b style="font-size: 14pt">Artikel <font color="blue">[ANZEIGENUMMER]</font></b>[ANZEIGENAMEDE]</td>
<td align="right">[ICONMENU]&nbsp; <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-2';"/> [ABBRECHEN]</td>
</tr>
</table>
<div style="height:10px"></div>
</td></tr>


      <tr valign="top">
        <td>

<fieldset><legend>&nbsp;Beschreibung&nbsp;</legend>
<table cellspacing="5">

				<tr valign="top"><td width="500">Artikel (DE) (Bitte im ersten Tab bearbeiten):<br>[ARTIKEL_DE_ANZEIGE]</td><td width="20"></td>
	      <td width="500">Artikel (EN):<br>[NAME_EN][MSGNAME_EN]</td></tr>


				<tr><td>Kurztext (DE) (Bitte im ersten Tab bearbeiten):<br>[KURZTEXT_DE_ANZEIGE]</td><td width="20"></td>
	      <td>Kurztext (EN):<br>[KURZTEXT_EN][MSGKURZTEXT_EN]</td></tr>

 <tr><td>Artikelbeschreibung (DE) (Bitte im ersten Tab bearbeiten):<br><i>f&uuml;r Angebote, Auftr&auml;ge, etc.</i><br>[ARTIKELBESCHREIBUNG_DE_ANZEIGE]</td><td></td><td nowrap>Artikelbeschreibung (EN):<br><i>f&uuml;r Angebote, Auftr&auml;ge, etc.</i><br>[ANABREGS_TEXT_EN][MSGANABREGS_TEXT_EN]</td></tr>

</table>
</fieldset>
<fieldset><legend>&nbsp;Online-Shop Texte&nbsp;</legend>
<table cellspacing="5">
	    	<tr valign="top"><td width="500">Artikelbeschreibung (DE):<br>[UEBERSICHT_DE][MSGUEBERSICHT_DE]</td><td width="20"></td>
	      <td width="500">Artikelbeschreibung (EN):<br>[UEBERSICHT_EN][MSGUEBERSICHT_EN]</td></tr>
	      <!--<tr><td nowrap>Beschreibung (DE):<br>[BESCHREIBUNG_DE][MSGBESCHREIBUNG_DE]</td><td width="20"></td>
	      <td>Beschreibung (EN):<br>[BESCHREIBUNG_EN][MSGBESCHREIBUNG_EN]</td></tr>-->
	      <!--<tr><td>Links (DE):<br>[LINKS_DE][MSGLINKS_DE]</td><td width="20"></td>
	      <td>Links (EN):<br>[LINKS_EN][MSGLINKS_EN]</td></tr>
	      <tr><td>Startseite (DE):<br>[STARTSEITE_DE][MSGSTARTSEITE_DE]</td><td width="20"></td>
	      <td>Startseite (EN):<br>[STARTSEITE_EN][MSGSTARTSEITE_EN]</td></tr>-->
	      <tr><td>Meta-Description (DE):<br>[METADESCRIPTION_DE][MSGMETADESCRIPTION_DE]</td><td width="20"></td>
	      <td>Meta-Description (EN):<br>[METADESCRIPTION_EN][MSGMETADESCRIPTION_EN]</td></tr>
	      <tr><td>Meta-Keywords (DE):<br>[METAKEYWORDS_DE][MSGMETAKEYWORDS_DE]</td><td width="20"></td>
	      <td>Meta-Keywords (EN):<br>[METAKEYWORDS_EN][MSGMETAKEYWORDS_EN]</td></tr>
</table>
</fieldset>
<fieldset><legend>&nbsp;Katalog&nbsp;</legend>

<table cellspacing="5" border="0">
	     <tr><td width="500" colspan="3">Katalogartikel:&nbsp;[KATALOG][MSGKATALOG]</td></tr>
	     <tr><td width="500">Bezeichnung (DE):<br>[KATALOGBEZEICHNUNG_DE][MSGKATALOGBEZEICHNUNG_DE]</td><td width="20"></td>
	      <td>Bezeichnung (EN):<br>[KATALOGBEZEICHNUNG_EN][MSGKATALOGBEZEICHNUNG_EN]</td></tr>
	     <tr><td>Katalogtext (DE):<br>[KATALOGTEXT_DE][MSGKATALOGTEXT_DE]</td><td width="20"></td>
	     <td>Katalogtext (EN):<br>[KATALOGTEXT_EN][MSGKATALOGTEXT_EN]</td></tr>
</table>
</fieldset>

        </td>
      </tr>
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="1" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-2';"/>  [ABBRECHEN]</td>
    </tr>


    </tbody>
  </table>

 </div>
[DISABLECLOSESTOCK]

[DISABLEOPENPARAMETER]

<div id="tabs-3">
  <table class="tableborder" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>

      <tr valign="top" cellpadding="0" cellspacing="0">
        <td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%">[STATUSICONS]</td>
<td align="center" nowrap><b style="font-size: 14pt">Artikel <font color="blue">[ANZEIGENUMMER]</font></b>[ANZEIGENAMEDE]</td>
<td align="right">[ICONMENU]&nbsp; <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-3';"/> [ABBRECHEN]</td>
</tr>
</table>
<div style="height:10px"></div>
</td></tr>


      <tr valign="top">
        <td>


<fieldset><legend>&nbsp;Parameter und Freifelder</legend>

<table cellspacing="5" border="0">

<tr><td width="200">[FREIFELD1BEZEICHNUNG]:</td><td width="200">[FREIFELD1START][FREIFELD1][MSGFREIFELD1][FREIFELD1ENDE]</td><td width="122">&nbsp;</td><td width="150">[FREIFELD2BEZEICHNUNG]:</td><td>[FREIFELD2START][FREIFELD2][MSGFREIFELD2][FREIFELD2ENDE]</td></tr>
<tr><td width="200">[FREIFELD3BEZEICHNUNG]:</td><td>[FREIFELD3START][FREIFELD3][MSGFREIFELD3][FREIFELD3ENDE]</td><td width="20">&nbsp;</td><td width="150">[FREIFELD4BEZEICHNUNG]:</td><td>[FREIFELD4START][FREIFELD4][MSGFREIFELD4][FREIFELD4ENDE]</td></tr>
<tr><td width="200">[FREIFELD5BEZEICHNUNG]:</td><td>[FREIFELD5START][FREIFELD5][MSGFREIFELD5][FREIFELD5ENDE]</td><td width="20">&nbsp;</td><td width="150">[FREIFELD6BEZEICHNUNG]:</td><td>[FREIFELD6START][FREIFELD6][MSGFREIFELD6][FREIFELD6ENDE]</td></tr>

</table>

 </td>
      </tr>
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-3';"/>  [ABBRECHEN]</td>
    </tr>


    </tbody>
  </table>



</div>
[DISABLECLOSEPARAMETER]

[DISABLEOPENSHOP]
<div id="tabs-4">

   [MESSAGE]
  <table class="tableborder" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
   <tr valign="top">
        <td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%">[STATUSICONS]</td>
<td align="center" nowrap><b style="font-size: 14pt">Artikel <font color="blue">[ANZEIGENUMMER]</font></b>[ANZEIGENAME_DE]</td>
<td align="right">[ICONMENU]&nbsp; <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-4';"/> [ABBRECHEN]</td>
</tr>
</table>
<div style="height:10px"></div>
</td></tr>


      <tr valign="top">
        <td>
<table width="100%" cellpadding="0" cellspacing="0">
<tr><td width="50%">
<fieldset><legend>&nbsp;Online-Shops</legend>
<table cellspacing="5" height="110">
<tr><td width="200"><font color="#961F1C">Shop (1):</font></td><td width="">[SHOPSTART][SHOP][MSGSHOP][SHOPENDE]
</td><td width="20"></td><td width="">[SHOP1BUTTON]</td><td></td></tr>
<tr><td width="200"><font color="#961F1C">Shop (2):</font></td><td width="">[SHOP2START][SHOP2][MSGSHOP2][SHOP2ENDE]
</td><td width="20"></td><td width="">[SHOP2BUTTON]</td><td></td></tr>
<tr><td width="200"><font color="#961F1C">Shop (3):</font></td><td width="">[SHOP3START][SHOP3][MSGSHOP3][SHOP3ENDE]
</td><td width="20"></td><td width="">[SHOP3BUTTON]</td><td></td></tr>

</table>
</fieldset>
</td><td>
<fieldset><legend>&nbsp;Verf&uuml;gbarkeit</legend>
<table cellspacing="5" border="0" height="110">
    <tr><td width="200">Artikel ausverkauft:</td><td width="180">[AUSVERKAUFT][MSGAUSVERKAUFT]&nbsp;</td></tr>
    <tr><td width="">Artikel inaktiv:</td><td>[INAKTIV][MSGINAKTIV]&nbsp;</td></tr>
    <tr><td width=""></td><td></td></tr>
</table>
</fieldset>
</td></tr></table>


<table width="100%" cellpadding="0" cellspacing="0">
<tr><td width="50%">
<fieldset><legend>&nbsp;Lagerbestand</legend>
<table cellspacing="5" height="200">
 <tr><td width="200">Lagerzahlen Sync.:</td><td>[AUTOLAGERLAMPE][MSGAUTOLAGERLAMPE]&nbsp;<i>(automatische &Uuml;bertragung zu Shop)</i></td></tr>
 <tr><td>Restmenge (Abverkauf):</td><td>[RESTMENGE][MSGRESTMENGE]</td></tr>
 <tr><td>Pseudo Lagerzahl:</td><td>[PSEUDOLAGER][MSGPSEUDOLAGER]</td></tr>
 <tr><td>Lieferzeittext manuell:</td><td>[LIEFERZEITMANUELL][MSGLIEFERZEITMANUELL]</td></tr>
 <tr><td></td><td></td></tr>
</table>
</fieldset>
</td>
<td>

<fieldset><legend>&nbsp;Online-Shop Optionen</legend>
<table cellspacing="5" height="200">
<tr><td width="200">Shop-Optionen:</font></td><td width="200">[OPTIONEN]</td></tr>
<tr><td width="200">Partnerprogramm Sperre:</td><td>[PARTNERPROGRAMM_SPERRE][MSGPARTNERPROGRAMM_SPERRE]</td></tr>
<tr><td>Neu:</td><td>[NEU][MSGNEU]</td></tr>
<tr><td>TopSeller:</td><td>[TOPSELLER][MSGTOPSELLER]</td></tr>
<tr><td>Startseite:</td><td>[STARTSEITE][MSGSTARTSEITE]</td></tr>
<tr><td>Downloadartikel:</td><td>[DOWNLOADARTIKEL][MSGDOWNLOADARTIKEL]</td></tr>
<tr><td>Pseudo Preis (Brutto):</td><td>[PSEUDOPREIS][MSGPSEUDOPREIS]</td></tr>
<tr><td>Generiere Artikelnummer bei Optionsartikel:</td><td>[GENERIERENUMMERBEIOPTION][MSGGENERIERENUMMERBEIOPTION]</td></tr>
</table>
</fieldset>
</td>
</tr>
</table>
<fieldset><legend>&nbsp;Auftragsimport Einstellungen&nbsp;</legend>
<table cellspacing="5" width="100%">
 <tr><td width="200">Auto-Abgleich:</td><td colspan="4">[AUTOABGLEICHERLAUBT][MSGAUTOABGLEICHERLAUBT]&nbsp;<i>Preis und Artikelname bei Auftragsimport von Fremdshop verwenden und nicht aus WaWision verwenden z.B. bei Gutschein, Porto etc.</i></td></tr>
</table>

</fieldset>
        </td>
      </tr>
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="speichern" value="Speichern" onclick="this.form.action += '#tabs-4';" />
    [ABBRECHEN]</td>
    </tr>


    </tbody>
  </table>
</div>

[DISABLECLOSESHOP]

<div id="tabs-5">
<div class="info">Eigener Kontenrahmen erst ab Version Enterprise verf&uuml;gbar</div>

</div>


<!-- tab view schließen -->
</div>
<!-- ende tab view schließen -->
</form>
