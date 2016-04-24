<script type="text/javascript">
	function next_number(art,alterwert)
	{
  	var nummer =  prompt('Neue Nummer:',alterwert); 
		if(nummer!=null && nummer!='') { window.location.href='index.php?module=firmendaten&action=nextnumber&cmd='+art+'&nummer='+nummer;}
	}

  function testdaten()
  {
    document.forms[0].absender.value = "Musterfirma GmbH | Musterweg 5 | 12345 Musterstadt";
    document.forms[0].sichtbar.checked = true;

    document.forms[0].barcode.checked= false;
    document.forms[0].schriftgroesse.value = "7";
    document.forms[0].betreffszeile.value="9";
    document.forms[0].dokumententext.value = "9";
    document.forms[0].tabellenbeschriftung.value = "9";
    document.forms[0].tabelleninhalt.value = "9";
    document.forms[0].zeilenuntertext.value="7";
    document.forms[0].freitext.value="9";
    document.forms[0].brieftext.value="11";
    document.forms[0].infobox.value = "8";

    document.forms[0].zahlung_rechnung_sofort_de.value = "Rechnung zahlbar sofort.";
    document.forms[0].zahlung_rechnung_de.value = "Rechnung zahlbar innerhalb {ZAHLUNGSZIELTAGE} Tage bis zum {ZAHLUNGBISDATUM}.";
    document.forms[0].zahlungszieltage.value = "14";
    document.forms[0].zahlungszieltageskonto.value = "10";
    document.forms[0].zahlungszielskonto.value = "2";

    document.forms[0].next_angebot.value = "100000";
    document.forms[0].next_auftrag.value = "200000";
    document.forms[0].next_rechnung.value = "400000";
    document.forms[0].next_gutschrift.value = "900000";
    document.forms[0].next_lieferschein.value = "300000";
    document.forms[0].next_arbeitsnachweis.value = "300000";
    document.forms[0].next_bestellung.value = "100000";
    document.forms[0].next_kundennummer.value = "10000";
    document.forms[0].next_lieferantennummer.value = "70000";
    document.forms[0].next_mitarbeiternummer.value = "90000";
    document.forms[0].next_artikelnummer.value = "1000000";
//    document.forms[0].next_waren.value = "700000";
//    document.forms[0].next_sonstiges.value = "100000";
    document.forms[0].next_produktion.value = "400000";

    document.forms[0].elements['footer[0][0]'].value = "Sitz der Gesellschaft / Lieferanschrift";
    document.forms[0].elements['footer[0][1]'].value = "Musterfirma GmbH";
    document.forms[0].elements['footer[0][2]'].value = "Musterweg 5";
    document.forms[0].elements['footer[0][3]'].value = "D-12345 Musterstadt";
    document.forms[0].elements['footer[0][4]'].value = "Telefon +49 123 12 34 56 7";
    document.forms[0].elements['footer[0][5]'].value = "Telefax +49 123 12 34 56 78";

    document.forms[0].elements['footer[1][0]'].value = "Bankverbindung";
    document.forms[0].elements['footer[1][1]'].value = "Musterbank";
    document.forms[0].elements['footer[1][2]'].value = "Konto 123456789";
    document.forms[0].elements['footer[1][3]'].value = "BLZ 72012345";
    document.forms[0].elements['footer[1][4]'].value = "";
    document.forms[0].elements['footer[1][5]'].value = "";

    document.forms[0].elements['footer[2][0]'].value = "IBAN DE1234567891234567891";
    document.forms[0].elements['footer[2][1]'].value = "BIC/SWIFT DETSGDBWEMN";
    document.forms[0].elements['footer[2][2]'].value = "Ust-IDNr. DE123456789";
    document.forms[0].elements['footer[2][3]'].value = "E-Mail: info@musterfirma-gmbh.de";
    document.forms[0].elements['footer[2][4]'].value = "Internet: http://www.musterfirma.de";
    document.forms[0].elements['footer[2][5]'].value = "";

    document.forms[0].elements['footer[3][0]'].value = "Gesch&auml;ftsf&uuml;hrer";
    document.forms[0].elements['footer[3][1]'].value = "Max Musterman";
    document.forms[0].elements['footer[3][2]'].value = "Handelsregister: HRB 12345";
    document.forms[0].elements['footer[3][3]'].value = "Amtsgericht: Musterstadt";
    document.forms[0].elements['footer[3][4]'].value = "";
    document.forms[0].elements['footer[3][5]'].value = "";


    document.forms[0].benutzername.value = "musterman";
    document.forms[0].passwort.value = "passwort";
    document.forms[0].host.value = "smtp.server.de";
    document.forms[0].port.value = "25";
    document.forms[0].ssl.checked = true;

    document.forms[0].email.value = "info@server.de";
    document.forms[0].absendername.value = "Meine Firma";
    document.forms[0].signatur.value = "--\n"
				     + "Musterfirma GmbH\n"
				     + "Musterweg 5\n"
				     + "D-12345 Musterstadt\n\n"
				     + "Tel +49 123 12 34 56 7\n"
				     + "Fax +49 123 12 34 56 78\n\n"
				     + "Name der Gesellschaft: Musterfirma GmbH\n"
				     + "Sitz der Gesellschaft: Musterstadt\n\n"
				     + "Handelsregister: Musterstadt, HRB 12345\n"
				     + "Geschäftsführung: Max Musterman\n"
				     + "USt-IdNr.: DE123456789\n\n"
				     + "AGB: http://www.musterfirma.de/\n";

    document.forms[0].name.value = "Musterfirma GmbH";
    document.forms[0].strasse.value = "Musterweg 5";
    document.forms[0].plz.value = "12345";
    document.forms[0].ort.value = "Musterstadt";
    document.forms[0].steuernummer.value = "111/11111/11111";
    document.forms[0].firmenfarbe.value = "";

	}

	function testdaten_textvorlagen()
  {
  
    document.forms[0].angebot_header.value = "Sehr geehrte Damen und Herren,\n\nhiermit bieten wir Ihnen an:";
    document.forms[0].auftrag_header.value = "Sehr geehrte Damen und Herren,\n\nvielen Dank für Ihren Auftrag.";
    document.forms[0].rechnung_header.value = "Sehr geehrte Damen und Herren,\n\nanbei Ihre Rechnung.";
    document.forms[0].lieferschein_header.value = "Sehr geehrte Damen und Herren,\n\nwir liefern Ihnen:";
    document.forms[0].arbeitsnachweis_header.value = "Sehr geehrte Damen und Herren,\n\nwir liefern Ihnen:";
    document.forms[0].gutschrift_header.value = "Sehr geehrte Damen und Herren,\n\nanbei Ihre {ART}:";
    document.forms[0].bestellung_header.value = "Sehr geehrte Damen und Herren,\n\nwir bestellen hiermit:";

 		document.forms[0].angebot_footer.value = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
    document.forms[0].auftrag_footer.value = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
    document.forms[0].rechnung_footer.value = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
    document.forms[0].lieferschein_footer.value = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
    document.forms[0].arbeitsnachweis_footer.value = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
    document.forms[0].gutschrift_footer.value = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
    document.forms[0].bestellung_footer.value = "Dieses Formular wurde maschinell erstellt und ist ohne Unterschrift gültig.";
		
    document.forms[0].eu_lieferung_vermerk.value = "Steuerfrei nach § 4 Nr. 1b i.V.m. § 6 a UStG. Ihre USt-IdNr. {USTID} Land: {LAND}";

   }


</script>

<form name="firmendatenform" id="firmendatenform" action="" method="POST"  enctype="multipart/form-data">
<div id="tabs">
<ul>
<li><a href="#tabs-1">Firmenanschrift</a></li>
<li><a href="#tabs-2">Briefkopf</a></li>
<li><a href="#tabs-3">Textvorlagen</a></li>
<li><a href="#tabs-4">E-Mail</a></li>
<li><a href="#tabs-6">Nummernkreise</a></li>
<li><a href="#tabs-7">Zahlungsweisen</a></li>
<li><a href="#tabs-8">Steuer / W&auml;hrung</a></li>
<li><a href="#tabs-9">System</a></li>
<li><a href="#tabs-10">Lizenz</a></li>
<li><a href="#tabs-11">API's</a></li>
<li><a href="#tabs-12">Module</a></li>
</ul>

<div id="tabs-1">
<fieldset><legend>Installation</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300"></td><td><input type="button" onclick="testdaten()" value="Musterdaten einf&uuml;gen">&nbsp;<br><i>Daten werden
erst nach Speichern &uuml;bernommen.</i></td></tr>
</table>
</fieldset>
<fieldset><legend>Anschrift</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">Name</td><td><input type="text" name="name" value="[NAME]" size="40"></td></tr>
  <tr><td>Strasse</td><td><input type="text" name="strasse" value="[STRASSE]" size="40"></td></tr>
  <tr><td>PLZ</td><td><input type="text" name="plz" value="[PLZ]" size="40"></td></tr>
  <tr><td>Ort</td><td><input type="text" name="ort" value="[ORT]" size="40"></td></tr>
  <tr><td>Land</td><td><input type="text" name="land" value="[LAND]" size="40" maxlength="2">&nbsp;<i>2-stelliger ISO Code z.B. DE, AT</i></td></tr>
  <tr><td>Steuernummer bzw. USTID</td><td><input type="text" name="steuernummer" value="[STEUERNUMMER]" size="40"></td></tr>
  <tr><td>SEPA Gl&auml;ubiger ID</td><td><input type="text" name="sepaglaeubigerid" value="[SEPAGLAEUBIGERID]" size="40"></td></tr>
</table></fieldset>
<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-1');" value="Speichern"></center>
</div>
<div id="tabs-2">
<fieldset><legend>Absender</legend>
    <table cellspacing="5">
          <tr><td width="300"><input type="checkbox" name="sichtbar" [SICHTBAR]>&nbsp;Absender einblenden</td><td><input type="text" name="absender" size="100" value="[ABSENDER]"></td></tr>
          <tr><td></td><td>z.B. embedded projects GmbH | Holzbachstrasse 4 | D-86152 Augsburg</td></tr>
          <tr><td></td><td><input type="checkbox" name="absenderunterstrichen" [ABSENDERUNTERSTRICHEN]>&nbsp;unterstrichen</td></tr>
</table></fieldset>

<fieldset><legend>PDF Grundeinstellungen</legend>
    <table cellspacing="5">

          <tr><td>HTML in Briefkopf und Text erlauben</td><td><input type="checkbox" name="briefhtml" [BRIEFHTML]><i>HTML Tags wie &lt;i&gt;,&lt;b&gt;,&lt;u&gt;,&lt;font&gt;,&lt;a&gt;</i></td></tr>
          <tr><td width="300">Schriftart:</td><td><input type="text" name="schriftart" size="20" value="[SCHRIFTART]">
<i>Courier, Helvetica, Times, Arial oder Schriftarten aus Ordner www/lib/pdf/font</i>
				</td></tr>
          <tr><td><input type="checkbox" name="knickfalz" [KNICKFALZ]>&nbsp;Knickfalz ausblenden</td><td><input type="checkbox" name="barcode" [BARCODE]>&nbsp;Barcode einblenden</td></tr>
          
<tr><td colspan="2"><input type="checkbox" name="seite_von_sichtbar" [SEITEVONSICHTBAR]>&nbsp;Seitennummerierung und Belegnr Ausrichtung&nbsp; <input type="text" name="seite_von_ausrichtung" value="[SEITEVONAUSRICHTUNG]" size="2">&nbsp;<i>(Werte: L=links, R=rechts oder C=zentriert)</i>&nbsp;<input type="checkbox" name="seite_von_ausrichtung_relativ" [SEITE_VON_AUSRICHTUNG_RELATIV]>&nbsp;Ausrichtung an Tabelle</td></tr>
<tr><td colspan="2"><input type="checkbox" name="breite_artikelbeschreibung" [BREITE_ARTIKELBESCHREIBUNG]>&nbsp;Artikelbeschreibung geht &uuml;ber die komplette Breite. <i>(Auch unterhalb von Steuer, Einheit, Rabatt und Gesamtsumme.)</td></tr>


<tr><td width="300">Breite Position:</td><td><input type="text" name="breite_position" size="20" value="[BREITE_POSITION]">&nbsp;<i>in mm</i></td></tr>
<tr><td width="300">Breite Nummer:</td><td><input type="text" name="breite_nummer" size="20" value="[BREITE_NUMMER]">&nbsp;<i>in mm</i></td></tr>
<tr><td width="300">Breite Menge:</td><td><input type="text" name="breite_menge" size="20" value="[BREITE_MENGE]">&nbsp;<i>in mm</i></td></tr>
<tr><td width="300">Breite Einheit:</td><td><input type="text" name="breite_einheit" size="20" value="[BREITE_EINHEIT]">&nbsp;<i>in mm</i></td></tr>

</table></fieldset>
<fieldset><legend>Formatierung</legend>
  <table width="100%" cellspacing="5" border="0">
  <tr><td>Schriftgr&ouml;&szlig;e Betreffzeile</td>
	<td><input type="text" size="3" name="betreffszeile" value="[BETREFFSZEILE]"></td>
	<td>Schriftgr&ouml;&szlig;e Dokumententext</td>
	<td><input type="text" size="3" name="dokumententext" value="[DOKUMENTENTEXT]"></td></tr>
    <tr><td>Schriftgr&ouml;&szlig;e Tabellenbeschriftung</td>
	<td><input type="text" size="3" name="tabellenbeschriftung" value="[TABELLENBESCHRIFTUNG]"></td>
	<td>Schriftgr&ouml;&szlig;e Tabelleninhalt</td>
	<td><input type="text" size="3" name="tabelleninhalt" value="[TABELLENINHALT]"></td></tr>
    <tr><td>Schriftgr&ouml;&szlig;e Artikel Beschreibung</td>
	<td><input type="text" size="3" name="zeilenuntertext" value="[ZEILENUNTERTEXT]"></td>
	<td>Schriftgr&ouml;&szlig;e Freitext</td>
	<td><input type="text" size="3" name="freitext" value="[FREITEXT]"></td></tr>
    <tr><td>Schriftgr&ouml;&szlig;e Infobox</td>
	<td><input type="text" size="3" name="infobox" value="[INFOBOX]"></td>
	<td>Schriftgr&ouml;&szlig;e Brieftext</td>
	<td><input type="text" size="3" name="brieftext" value="[BRIEFTEXT]"></td></tr>
 
  <tr><td>Schriftgr&ouml;&szlig;e Empf&auml;nger</td>
	<td><input type="text" size="3" name="schriftgroesse" value="[SCHRIFTGROESSE]"></td>
	<td>Schriftgr&ouml;&szlig;e Absender</td>
	<td><input type="text" size="3" name="schriftgroesseabsender" value="[SCHRIFTGROESSEABSENDER]"></td></tr>
  <tr><td><br></td>
	<td></td>
	<td></td>
	<td></td></tr>


	<tr><td>Abstand Empf&auml;nger oben/unten (verschieben +- in mm)</td>
	<td><input type="text" size="3" name="abstand_adresszeileoben" value="[ABSTANDADRESSZEILEOBEN]"></td>
	<td>Abstand Infobox oben/unten (verschieben +- in mm)</td>
	<td><input type="text" size="3" name="abstand_boxrechtsoben" value="[ABSTANDBOXRECHTSOBEN]"></td></tr>

	<tr><td>Abstand Empf&auml;nger links (absolut in mm)</td>
	<td><input type="text" size="3" name="abstand_adresszeilelinks" value="[ABSTAND_ADRESSZEILELINKS]"></td>
	<td></td>
	<td></td>
        </tr>

	<tr><td>Abstand Betreffzeile oben/unten (verschieben +- in mm)</td>
	<td><input type="text" size="3" name="abstand_betreffzeileoben" value="[ABSTANDBETREFFZEILEOBEN]"></td>
	<td>Abstand Infobox rechts/links (verschieben +- in mm)</td>
	<td><input type="text" size="3" name="abstand_boxrechtsoben_lr" value="[ABSTANDBOXRECHTSOBENLR]"></td>
        </tr>

	<tr>
	<td>Abstand Artikelname zu Beschreibung (in mm)</td>
	<td><input type="text" size="3" name="abstand_name_beschreibung" value="[ABSTANDNAMEBESCHREIBUNG]"></td>
	<td>Ausrichtung Infobox Text (L oder R und optional Spaltenbreite L;30;40 oder R;30;40)</td>
	<td><input type="text" size="6" name="boxausrichtung" value="[BOXAUSRICHTUNG]"></td>

	</tr>

	<tr>
	<td>Abstand Seitenrand Links</td>
	<td><input type="text" size="3" name="abstand_seitenrandlinks" value="[ABSTAND_SEITENRANDLINKS]"></td>
	<td>Abstand Artikeltabelle oben/unten (verschieben +- in mm)</td>
	<td><input type="text" size="3" name="abstand_artikeltabelleoben" value="[ABSTANDARTIKELTABELLEOBEN]"></td>

	</tr>

	<tr>
	<td>Abstand Gesamtsumme Links</td>
	<td><input type="text" size="3" name="abstand_gesamtsumme_lr" value="[ABSTAND_GESAMTSUMME_LR]"></td>
	<td></td>
	<td></td>

	</tr>



  </table>
</fieldset>
<fieldset><legend>Fu&szlig;zeile</legend>
    <table cellspacing="5" align="left">
    	<tr>
			<td colspan="2"><input type="checkbox" name="footersichtbar" [FOOTERSICHTBAR]>&nbsp;Footer einblenden</td>
    	<td colspan="2"></td>
    	<td colspan="2"></td>
			</tr>

      <tr><td></td><td>Spalte 1</td><td>Spalte 2</td>
          <td>&nbsp;</td><td>Spalte 3</td><td>Spalte 4</td></tr>

      <tr><td>1</td>
	  <td><input type="text" name="footer[0][0]" size="30" value="[FOOTER00]"></td><td><input type="text" name="footer[1][0]" size="30" value="[FOOTER10]"></td>
          <td>&nbsp;</td><td><input type="text" name="footer[2][0]" size="30" value="[FOOTER20]"></td><td><input type="text" name="footer[3][0]" size="30" value="[FOOTER30]"></td></tr>
      <tr><td>2</td>
          <td><input type="text" name="footer[0][1]" size="30" value="[FOOTER01]"></td><td><input type="text" name="footer[1][1]" size="30" value="[FOOTER11]"></td>
          <td>&nbsp;</td><td><input type="text" name="footer[2][1]" size="30" value="[FOOTER21]"></td><td><input type="text" name="footer[3][1]" size="30" value="[FOOTER31]"></td></tr>
      <tr><td>3</td>
          <td><input type="text" name="footer[0][2]" size="30" value="[FOOTER02]"></td><td><input type="text" name="footer[1][2]" size="30" value="[FOOTER12]"></td>
          <td>&nbsp;</td><td><input type="text" name="footer[2][2]" size="30" value="[FOOTER22]"></td><td><input type="text" name="footer[3][2]" size="30" value="[FOOTER32]"></td></tr>
      <tr><td>4</td>
          <td><input type="text" name="footer[0][3]" size="30" value="[FOOTER03]"></td><td><input type="text" name="footer[1][3]" size="30" value="[FOOTER13]"></td>
          <td>&nbsp;</td><td><input type="text" name="footer[2][3]" size="30" value="[FOOTER23]"></td><td><input type="text" name="footer[3][3]" size="30" value="[FOOTER33]"></td></tr>
      <tr><td>5</td>
          <td><input type="text" name="footer[0][4]" size="30" value="[FOOTER04]"></td><td><input type="text" name="footer[1][4]" size="30" value="[FOOTER14]"></td>
          <td>&nbsp;</td><td><input type="text" name="footer[2][4]" size="30" value="[FOOTER24]"></td><td><input type="text" name="footer[3][4]" size="30" value="[FOOTER34]"></td></tr>
      <tr><td>6</td>
          <td><input type="text" name="footer[0][5]" size="30" value="[FOOTER05]"></td><td><input type="text" name="footer[1][5]" size="30" value="[FOOTER15]"></td>
          <td>&nbsp;</td><td><input type="text" name="footer[2][5]" size="30" value="[FOOTER25]"></td><td><input type="text" name="footer[3][5]" size="30" value="[FOOTER35]"></td></tr>

      <tr><td></td>
					<td>Breite (in mm): <input type="text" name="footer_breite1" size="8" value="[FOOTERBREITE1]"></td>
					<td>Breite (in mm): <input type="text" name="footer_breite2" size="8" value="[FOOTERBREITE2]"></td>
          <td>&nbsp;</td>
					<td>Breite (in mm): <input type="text" name="footer_breite3" size="8" value="[FOOTERBREITE3]"></td>
					<td>Breite (in mm): <input type="text" name="footer_breite4" size="8" value="[FOOTERBREITE4]"></td>
							</tr>


    </table>
</fieldset>

<fieldset><legend>Hintergrund</legend>

<table width="100%">
<tr><td colspan="6">Aktuell wird verwendet: [HINTERGRUNDTEXT]<br><br></td></tr>
</table>

<table width="100%">
<tr valign="top"><td><input type="radio" name="hintergrund" value="logo" [HINTERGRUNDLOGO]>&nbsp;Logo</td><td><input type="file" name="logo">[LOGOVORHANDEN] (<b style="color:red">Achtung aktuell wird nur JPG unterst&uuml;tzt!</b>)</td></tr>
<tr><td><br></td></tr>
<tr valign="top"><td><input type="radio" name="hintergrund" value="briefpapier" [HINTERGRUNDBRIEFPAPIER]>&nbsp;PDF als Hintergrund</td><td><input type="file" name="briefpapier">[BRIEFPAPIERVORHANDEN] (Seite 1)<br><br>
<input type="checkbox" name="briefpapier2vorhanden" [BRIEFPAPIER2VORHANDEN]> anderes Briefpapier ab Seite 2
<br>
<input type="file" name="briefpapier2">[BRIEFPAPIERVORHANDEN2]&nbsp;(Seite 2 und Folgende)<br></td></tr>
<tr><td><br></td></tr>
<tr valign="top"><td><input type="radio" name="hintergrund" value="kein" [HINTERGRUNDKEIN]>&nbsp;Kein Hintergrund</td></tr>
</table>
</fieldset>
<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-2');" value="Speichern"></center>
</div>


<div id="tabs-3">
<fieldset><legend>Textvorlagen</legend>
<table width="100%">
  <tr><td width="300"></td><td>&nbsp;<input type="button" onclick="testdaten_textvorlagen()" value="Standardtexte laden"></td></tr>
  <tr><td>Angebot Text vor Artikeltabelle</td><td><textarea rows="5" cols="100" name="angebot_header">[ANGEBOT_HEADER]</textarea></td></tr>
  <tr><td>Angebot Text am Ende (nach Freitext)</td><td><textarea rows="5" cols="100" name="angebot_footer">[ANGEBOT_FOOTER]</textarea></td></tr>
  <tr><td>Angebot ohne Briefpapier</td><td><input type="checkbox" name="angebot_ohnebriefpapier" [ANGEBOT_OHNEBRIEFPAPIER]></td></tr>

  <tr><td>Auftrag Text vor Artikeltabelle</td><td><textarea rows="5" cols="100" name="auftrag_header">[AUFTRAG_HEADER]</textarea></td></tr>
  <tr><td>Auftrag Text am Ende (nach Freitext)</td><td><textarea rows="5" cols="100" name="auftrag_footer">[AUFTRAG_FOOTER]</textarea></td></tr>
  <tr><td>Auftrag ohne Briefpapier</td><td><input type="checkbox" name="auftrag_ohnebriefpapier" [AUFTRAG_OHNEBRIEFPAPIER]></td></tr>

  <tr><td>Rechnung Text vor Artikeltabelle</td><td><textarea rows="5" cols="100" name="rechnung_header">[RECHNUNG_HEADER]</textarea></td></tr>
  <tr><td>Rechnung Text am Ende (nach Freitext)</td><td><textarea rows="5" cols="100" name="rechnung_footer">[RECHNUNG_FOOTER]</textarea></td></tr>
  <tr><td>Rechnung ohne Briefpapier</td><td><input type="checkbox" name="rechnung_ohnebriefpapier" [RECHNUNG_OHNEBRIEFPAPIER]></td></tr>

  <tr><td>Lieferschein Text vor Artikeltabelle</td><td><textarea rows="5" cols="100" name="lieferschein_header">[LIEFERSCHEIN_HEADER]</textarea></td></tr>
  <tr><td>Lieferschein Text am Ende (nach Freitext)</td><td><textarea rows="5" cols="100" name="lieferschein_footer">[LIEFERSCHEIN_FOOTER]</textarea></td></tr>
  <tr><td>Lieferschein ohne Briefpapier</td><td><input type="checkbox" name="lieferschein_ohnebriefpapier" [LIEFERSCHEIN_OHNEBRIEFPAPIER]></td></tr>

  <tr><td>Gutschrift Text vor Artikeltabelle</td><td><textarea rows="5" cols="100" name="gutschrift_header">[GUTSCHRIFT_HEADER]</textarea><br><i>Variablen: {ART} (Gutschrift oder Stornorechnung)</i></td></tr>
  <tr><td>Gutschrift Text am Ende (nach Freitext)</td><td><textarea rows="5" cols="100" name="gutschrift_footer">[GUTSCHRIFT_FOOTER]</textarea></td></tr>
  <tr><td>Gutschrift ohne Briefpapier</td><td><input type="checkbox" name="gutschrift_ohnebriefpapier" [GUTSCHRIFT_OHNEBRIEFPAPIER]></td></tr>

  <tr><td>Bestellung Text vor Artikeltabelle</td><td><textarea rows="5" cols="100" name="bestellung_header">[BESTELLUNG_HEADER]</textarea></td></tr>
  <tr><td>Bestellung Text am Ende (nach Freitext)</td><td><textarea rows="5" cols="100" name="bestellung_footer">[BESTELLUNG_FOOTER]</textarea></td></tr>
  <tr><td>Bestellung ohne Briefpapier</td><td><input type="checkbox" name="bestellung_ohnebriefpapier" [BESTELLUNG_OHNEBRIEFPAPIER]></td></tr>

  <tr><td>Arbeitsnachweis Text vor Artikeltabelle</td><td><textarea rows="5" cols="100" name="arbeitsnachweis_header">[ARBEITSNACHWEIS_HEADER]</textarea></td></tr>
  <tr><td>Arbeitsnachweis Text am Ende (nach Freitext)</td><td><textarea rows="5" cols="100" name="arbeitsnachweis_footer">[ARBEITSNACHWEIS_FOOTER]</textarea></td></tr>
  <tr><td>Arbeitsnachweis ohne Briefpapier</td><td><input type="checkbox" name="arbeitsnachweis_ohnebriefpapier" [ARBEITSNACHWEIS_OHNEBRIEFPAPIER]></td></tr>

  <tr><td>Provisionsgutschrift Text vor Artikeltabelle</td><td><textarea rows="5" cols="100" name="provisionsgutschrift_header">[PROVISIONSGUTSCHRIFT_HEADER]</textarea></td></tr>
  <tr><td>Provisionsgutschrift Text am Ende (nach Freitext)</td><td><textarea rows="5" cols="100" name="provisionsgutschrift_footer">[PROVISIONSGUTSCHRIFT_FOOTER]</textarea></td></tr>

  <tr><td>EU-Lieferung Vermerk</td><td><textarea rows="5" cols="100" name="eu_lieferung_vermerk">[EU_LIEFERUNG_VERMERK]</textarea><br><i>Variablen: {USTID} {LAND}</i></td></tr>
  <tr><td>Export-Lieferung Vermerk</td><td><textarea rows="5" cols="100" name="export_lieferung_vermerk">[EXPORT_LIEFERUNG_VERMERK]</textarea><br><i>Variablen: {LAND}</i></td></tr>

  <tr><td>Variablen</td><td><i>{LAND}, {FREIFELD1},{FREIFELD2},{FREIFELD3},{ANSCHREIBEN},{BELEGNR},{KUNDENNUMMER},{VERBANDSNUMMER},{VERBAND},{LIEFERTERMIN},{LIEFERWOCHE},{GUELTIGBIS},{GUELTIGBISWOCHE},{LIEFERADRESSE},{LIEFERADRESSELANG},{NETTOGEWICHT}</i></td></tr>
</table>

</fieldset>

<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-3');" value="Speichern"></center>
</div>


<div id="tabs-4">
<fieldset><legend>Versand Einstellungen</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">Benutzername (E-Mail):&nbsp;</td><td><input type="text" name="benutzername" size="40" value="[BENUTZERNAME]"></td></tr>
  <tr><td>Passwort:&nbsp;</td><td><input type="password" name="passwort" size="40" value="[PASSWORT]" AUTOCOMPLETE="off"></td></tr>
  <tr><td>Postausgangsserver:&nbsp;</td><td><input type="text" name="host" size="40" value="[HOST]"></td></tr>
  <tr><td>Port:&nbsp;</td><td><input type="text" name="port" size="4" value="[PORT]"></td></tr>
  <tr><td width="50">Verschl&uuml;sselung:</td><td><select name="mailssl"><option value="0">keine</option><option value="1" [TLS]>TLS</option><option value="2" [SSL]>SSL</option></select></td></tr>
  <tr><td>Testmail Empfaenger:&nbsp;</td><td><input type="text" name="testmailempfaenger" size="40" value="[TESTMAILEMPFAENGER]"></td></tr>
  <tr><td width="50">Testmail:</td><td><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-4');" value="Speichern">&nbsp;<input type="button" value="Testmail senden" onclick="window.location.href='index.php?module=firmendaten&action=testmail'">&nbsp;<i>(Bitte erst speichern und dann senden!</i>)</td></tr>
  <tr><td width="50">PHP mail() verwenden (Standard):</td><td><input type="checkbox" name="mailanstellesmtp" [MAILANSTELLESMTP]>&nbsp;<i>Nur aktivieren wenn oben nichts eingestellt ist!</i></td></tr>
  <!--<tr><td align="center"></td><td><input type="button" name="testmail" value="Testmail schicken (zum Account Testen)"></td></tr>-->
</tr>
</table>
[MESSAGE]
</fieldset>

<fieldset><legend>Standard Einstellung E-Mail (bei Versand von E-Mails)</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">E-Mailadresse</td><td><input type="text" name="email" value="[EMAIL]" size="40">&nbsp;<i>Bei Empf&auml;nger angezeigte E-Mail Adresse.</i>
</td>
<tr><td>Name des Absenders</td><td><input type="text" name="absendername" value="[ABSENDERNAME]" size="40">&nbsp;<i>Bei Empf&auml;nger angezeigter Name.</i></td>
  <tr><td>Standardsignatur</td><td><textarea name="signatur" rows="15" cols="80">[SIGNATUR]</textarea></td>
  <tr><td>BCC 1</td><td><input type="text" name="bcc1" value="[BCC1]" size="40"> <i>(Jede ausgehende E-Mail wird parallel als BCC an Adresse gesendet)</i></td>
  <tr><td>BCC 2</td><td><input type="text" name="bcc2" value="[BCC2]" size="40"> <i>(Jede ausgehende E-Mail wird parallel als BCC an Adresse gesendet)</i></td>
</tr>
</table>
</fieldset>

<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-4');" value="Speichern"></center>
</div>

<div id="tabs-6">
<fieldset><legend>Nummernkreise</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">N&auml;chste Angebotsnummer</td><td><input type="text" name="next_angebot" readonly value="[NEXT_ANGEBOT]" size="40">
			&nbsp;<input type="button" onclick="next_number('angebot','[NEXT_ANGEBOT]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Auftragsnummer</td><td><input type="text" name="next_auftrag" readonly value="[NEXT_AUFTRAG]" size="40">
			&nbsp;<input type="button" onclick="next_number('auftrag','[NEXT_AUFTRAG]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Lieferscheinnummer</td><td><input type="text" name="next_lieferschein" readonly value="[NEXT_LIEFERSCHEIN]" size="40">
			&nbsp;<input type="button" onclick="next_number('lieferschein','[NEXT_LIEFERSCHEIN]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Rechnungsnummer</td><td><input type="text" name="next_rechnung" readonly value="[NEXT_RECHNUNG]" size="40">
			&nbsp;<input type="button" onclick="next_number('rechnung','[NEXT_RECHNUNG]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Gutschriftnummer</td><td><input type="text" name="next_gutschrift" readonly value="[NEXT_GUTSCHRIFT]" size="40">
			&nbsp;<input type="button" onclick="next_number('gutschrift','[NEXT_GUTSCHRIFT]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Bestellungsnummer</td><td><input type="text" name="next_bestellung" readonly value="[NEXT_BESTELLUNG]" size="40">
			&nbsp;<input type="button" onclick="next_number('bestellung','[NEXT_BESTELLUNG]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Arbeitsnachweisnummer</td><td><input type="text" name="next_arbeitsnachweis" readonly value="[NEXT_ARBEITSNACHWEIS]" size="40">
			&nbsp;<input type="button" onclick="next_number('arbeitsnachweis','[NEXT_ARBEITSNACHWEIS]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Reisekostennummer</td><td><input type="text" name="next_reisekosten" readonly value="[NEXT_REISEKOSTEN]" size="40">
			&nbsp;<input type="button" onclick="next_number('reisekosten','[NEXT_REISEKOSTEN]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Produktionnummer</td><td><input type="text" name="next_produktion" readonly value="[NEXT_PRODUKTION]" size="40">
			&nbsp;<input type="button" onclick="next_number('produktion','[NEXT_PRODUKTION]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Anfragenummer</td><td><input type="text" name="next_anfrage" readonly value="[NEXT_ANFRAGE]" size="40">
			&nbsp;<input type="button" onclick="next_number('anfrage','[NEXT_ANFRAGE]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Kundennummer</td><td><input type="text" name="next_kundennummer"  readonly value="[NEXT_KUNDENNUMMER]" size="40">
			&nbsp;<input type="button" onclick="next_number('kundennummer','[NEXT_KUNDENNUMMER]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Lieferantenummer</td><td><input type="text" name="next_lieferantennummer" readonly value="[NEXT_LIEFERANTENNUMMER]" size="40">
			&nbsp;<input type="button" onclick="next_number('lieferantennummer','[NEXT_LIEFERANTENNUMMER]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Mitarbeiternummer</td><td><input type="text" name="next_mitarbeiternummer" readonly value="[NEXT_MITARBEITERNUMMER]" size="40">
			&nbsp;<input type="button" onclick="next_number('mitarbeiternummer','[NEXT_MITARBEITERNUMMER]');" value="bearbeiten"></td></tr>
  <tr><td>N&auml;chste Artikelnummer</td><td><input type="text" name="next_artikelnummer" readonly value="[NEXT_ARTIKELNUMMER]" size="40">
			&nbsp;<input type="button" onclick="next_number('artikelnummer','[NEXT_ARTIKELNUMMER]');" value="bearbeiten"></td></tr>

  <tr><td width="300">Warnung doppelte Nr.</td><td><input type="checkbox" name="warnung_doppelte_nummern" [WARNUNG_DOPPELTE_NUMMERN]></td></tr>
<!--  <tr><td>Artikel: Ware</td><td><input type="text" name="next_waren" value="[NEXT_WAREN]" size="40">&nbsp;(Aktuell MAX: [NEXT_WAREN_MAX])</td></tr>
  <tr><td>Artikel: Produktion</td><td><input type="text" name="next_produktion" value="[NEXT_PRODUKTION]" size="40">&nbsp;(Aktuell MAX: [NEXT_PRODUKTION_MAX])</td></tr>
  <tr><td>Artikel: Dienstleistung/Sonstiges</td><td><input type="text" name="next_sonstiges" value="[NEXT_SONSTIGES]" size="40">&nbsp;(Aktuell MAX: [NEXT_SONSTIGES_MAX])</td></tr>-->
</table>
</fieldset>
<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-6');" value="Speichern"></center>
</div>

<div id="tabs-7">

<fieldset><legend>Zahlungsweisen</legend>
<table width="100%">
  <tr><td width="50"><input type="checkbox" name="zahlung_rechnung" [ZAHLUNG_RECHNUNG]></td><td>Rechnung</td><td></td></tr>
  <tr valign="top"><td></td><td>Satz Rechnung (sofort) (DE)</td><td><textarea name="zahlung_rechnung_sofort_de" rows="3" cols="80">[ZAHLUNG_RECHNUNG_SOFORT_DE]</textarea><br><i>z.B. Rechnung zahlbar sofort.</i></td></tr>
	<tr valign="top"><td></td><td>Satz Rechnung (>= 1 Tag) (DE)</td><td><textarea name="zahlung_rechnung_de" rows="3" cols="80">[ZAHLUNG_RECHNUNG_DE]</textarea><br>
	<i>z.B. Rechnung zahlbar innerhalb {ZAHLUNGSZIELTAGE} Tage bis zum {ZAHLUNGBISDATUM}.<br>Variabeln: {ZAHLUNGBISDATUM},{ZAHLUNGSZIELTAGE},{ZAHLUNGSZIELSKONTO},{ZAHLUNGSZIELTAGESKONTO},{ZAHLUNGSZIELSKONTODATUM},{SOLL},{SOLLMITSKONTO},{SKONTOBETRAG}, {BELEGNR}, {NAME}</i></td></tr>
 <tr><td></td><td>Rechnung Zahlungsziel in Tage</td><td><input type="text" name="zahlungszieltage" size="10" value="[ZAHLUNGSZIELTAGE]"></td></tr>
  <tr><td></td><td>Skonto in Tage</td><td><input type="text" name="zahlungszieltageskonto" size="10" value="[ZAHLUNGSZIELTAGESKONTO]"></td></tr>
  <tr><td></td><td>Skonto in Prozent</td><td><input type="text" name="zahlungszielskonto" size="10" value="[ZAHLUNGSZIELSKONTO]"></td></tr>

  <tr><td><input type="checkbox" name="zahlung_vorkasse" [ZAHLUNG_VORKASSE]></td><td>Vorkasse</td><td></td></tr>
  <tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_vorkasse_de" rows="3" cols="80">[ZAHLUNG_VORKASSE_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>

  <tr><td><input type="checkbox" name="zahlung_nachnahme" [ZAHLUNG_NACHNAHME]></td><td>Nachnahme</td><td></td></tr>
 <tr valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_nachnahme_de" rows="3" cols="80">[ZAHLUNG_NACHNAHME_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>


  <tr><td><input type="checkbox" name="zahlung_lastschrift" [ZAHLUNG_LASTSCHRIFT]></td><td>Lastschrift</td><td>
</td></tr>
 <tr valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_lastschrift_de" rows="3" cols="80">[ZAHLUNG_LASTSCHRIFT_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i><br><input type="checkbox" value="1" name="zahlung_lastschrift_konditionen" [ZAHLUNG_LASTSCHRIFT_KONDITIONEN]>&nbsp;Einzugsdatum berechnen anhand Rechnungskonditionen bei Kunden</td></tr>

  <tr><td><input type="checkbox" name="zahlung_bar" [ZAHLUNG_BAR]></td><td>Barzahlung</td><td></td></tr>
<tr valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_bar_de" rows="3" cols="80">[ZAHLUNG_BAR_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>


  <tr><td><input type="checkbox" name="zahlung_paypal" [ZAHLUNG_PAYPAL]></td><td>Paypal</td><td></td></tr>
<tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_paypal_de" rows="3" cols="80">[ZAHLUNG_PAYPAL_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>

  <tr><td><input type="checkbox" name="zahlung_kreditkarte" [ZAHLUNG_KREDITKARTE]></td><td>Kreditkarte</td><td></td></tr>
<tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_kreditkarte_de" rows="3" cols="80">[ZAHLUNG_KREDITKARTE_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>


  <tr><td><input type="checkbox" name="zahlung_amazon" [ZAHLUNG_AMAZON]></td><td>Amazon Payments</td><td></td></tr>
<tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_amazon_de" rows="3" cols="80">[ZAHLUNG_AMAZON_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>


  <tr><td><input type="checkbox" name="zahlung_amazon_bestellung" [ZAHLUNG_AMAZON_BESTELLUNG]></td><td>Amazon Bestellung</td><td></td></tr>
<tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_amazon_bestellung_de" rows="3" cols="80">[ZAHLUNG_AMAZON_BESTELLUNG_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>



  <tr><td><input type="checkbox" name="zahlung_billsafe" [ZAHLUNG_BILLSAFE]></td><td>Billsafe</td><td></td></tr>
<tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_billsafe_de" rows="3" cols="80">[ZAHLUNG_BILLSAFE_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>


  <tr><td><input type="checkbox" name="zahlung_secupay" [ZAHLUNG_SECUPAY]></td><td>Secupay</td><td></td></tr>
<tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_secupay_de" rows="3" cols="80">[ZAHLUNG_SECUPAY_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>



  <tr><td><input type="checkbox" name="zahlung_sofortueberweisung" [ZAHLUNG_SOFORTUEBERWEISUNG]></td><td>Sofort&uuml;berweisung</td><td></td></tr>
<tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_sofortueberweisung_de" rows="3" cols="80">[ZAHLUNG_SOFORTUEBERWEISUNG_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>



  <tr><td><input type="checkbox" name="zahlung_ratenzahlung" [ZAHLUNG_RATENZAHLUNG]></td><td>Ratenzahlung</td><td></td></tr>
<tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_ratenzahlung_de" rows="3" cols="80">[ZAHLUNG_RATENZAHLUNG_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>


  <tr><td><input type="checkbox" name="zahlung_eckarte" [ZAHLUNG_ECKARTE]></td><td>EC-Karte</td><td></td></tr>
<tr  valign="top"><td></td><td>Zahlungsbedingungen:</td><td><textarea name="zahlung_eckarte_de" rows="3" cols="80">[ZAHLUNG_ECKARTE_DE]</textarea><br>
<i>Dieser Text erscheint auf dem Angebot, Auftrag und der Rechnung.</i></td></tr>



</table>

</fieldset>

<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-7');" value="Speichern"></center>
</div>


<div id="tabs-8">
<fieldset><legend>Steuersätz</legend>
<table width="100%">
  <tr><td width="300">Steuersatz (normal)</td><td><input type="text" name="steuersatz_normal" size="10" value="[STEUERSATZNORMAL]">&nbsp;<i>z.B. 19.0 (mit Punkt statt Komma)</i></td></tr>
  <tr><td width="300">Steuersatz (erm&auml;&szlig;igt)</td><td><input type="text" name="steuersatz_ermaessigt" size="10" value="[STEUERSATZERMAESSIGT]">&nbsp;<i>z.B. 7.0 (mit Punkt statt Komma)</i></td></tr>
<tr><td>Kleinunternehmer</td><td><input type="checkbox" name="kleinunternehmer" [KLEINUNTERNEHMER]>&nbsp;<i>Die Kleinunternehmerregelung gemäß § 19 UStG.</i></td></tr>
<tr><td>Immer Netto Rechnungen</td><td><input type="checkbox" name="immernettorechnungen" [IMMERNETTORECHNUNGEN]>&nbsp;<i>In AN,AB,RE und GS werden Netto Preise angezeigt.</i></td></tr>
<tr><td>Immer Brutto Rechnungen</td><td><input type="checkbox" name="immerbruttorechnungen" [IMMERBRUTTORECHNUNGEN]>&nbsp;<i>In AN,AB,RE und GS werden Brutto Preise angezeigt.</i></td></tr>
<tr><td>Belege mit 4 Nachkommastellen</td><td><input type="checkbox" name="viernachkommastellen_belege" [VIERNACHKOMMASTELLEN_BELEGE]>&nbsp;<i>4 anstatt 2 Kommastellen auf Dokumente.</i></td></tr>
<tr><td>Standard Zahlungsweise</td><td><select name="zahlungsweise">[ZAHLUNGSWEISE]</select></td></tr>
<tr><td>Standard Versandart</td><td><select name="versandart">[VERSANDART]</select></td></tr>
</table>
</fieldset>
<fieldset><legend>W&auml;hrung</legend>
<table width="100%">
  <tr><td width="300">Standard W&auml;hrung</td><td><input type="text" name="waehrung" size="10" value="[WAEHRUNG]">&nbsp;<i>z.B. EUR</i></td></tr>
  <tr><td>Standard Marge</td><td><input type="text" name="standardmarge" size="5" value="[STANDARDMARGE]">&nbsp;<i>z.B. 30 f&uuml;r 30% bedeutet EK/0.7</i></td></tr>
</table>
</fieldset>

<fieldset><legend>Finanzbuchhaltung Export Kontenrahmen</legend>
<table width="100%">
  <tr>
		<td width="300"></td><td>Erl&ouml;se</td>
		<td width="300"></td><td>Aufwendungen</td>
	</tr>
  <tr>
		<td width="300">Inland (normal)</td><td><input type="text" name="steuer_erloese_inland_normal" size="10" value="[STEUER_ERLOESE_INLAND_NORMAL]"></td>
		<td width="300">Inland (normal)</td><td><input type="text" name="steuer_aufwendung_inland_normal" size="10" value="[STEUER_AUFWENDUNG_INLAND_NORMAL]"></td>
	</tr>

 <tr>
		<td width="300">Inland (erm&auml;&szlig;igt)</td><td><input type="text" name="steuer_erloese_inland_ermaessigt" size="10" value="[STEUER_ERLOESE_INLAND_ERMAESSIGT]"></td>
		<td width="300">Inland (erm&auml;&szlig;igt)</td><td><input type="text" name="steuer_aufwendung_inland_ermaessigt" size="10" value="[STEUER_AUFWENDUNG_INLAND_ERMAESSIGT]"></td>
  
        <tr>
		<td width="300">Inland (steuerfrei)</td><td><input type="text" name="steuer_erloese_inland_nichtsteuerbar" size="10" value="[STEUER_ERLOESE_INLAND_NICHTSTEUERBAR]"></td>
		<td width="300">Inland (steuefrei)</td><td><input type="text" name="steuer_aufwendung_inland_nichtsteuerbar" size="10" value="[STEUER_AUFWENDUNG_INLAND_NICHTSTEUERBAR]"></td>
	</tr>


	</tr>
<!--  <tr>
		<td width="300">Inland (steuerfrei)</td><td><input type="text" name="steuer_erloese_inland_steuerfrei" size="10" value="[STEUER_ERLOESE_INLAND_STEUERFREI]"></td>
		<td width="300">Inland (steuerfrei)</td><td><input type="text" name="steuer_aufwendung_inland_steuerfrei" size="10" value="[STEUER_AUFWENDUNG_INLAND_STEUERFREI]"></td>
	</tr>
-->
  <tr>
		<td width="300">Innergemeinschaftlich EU</td><td><input type="text" name="steuer_erloese_inland_innergemeinschaftlich" size="10" value="[STEUER_ERLOESE_INLAND_INNERGEMEINSCHAFTLICH]"></td>
		<td width="300">Innergemeinschaftlich EU</td><td><input type="text" name="steuer_aufwendung_inland_innergemeinschaftlich" size="10" value="[STEUER_AUFWENDUNG_INLAND_INNERGEMEINSCHAFTLICH]"></td>
	</tr>
      <tr>
              <td width="300">EU (normal)</td><td><input type="text" name="steuer_erloese_inland_eunormal" size="10" value="[STEUER_ERLOESE_INLAND_EUNORMAL]"></td>
              <td width="300">EU (normal)</td><td><input type="text" name="steuer_aufwendung_inland_eunormal" size="10" value="[STEUER_AUFWENDUNG_INLAND_EUNORMAL]"></td>
      </tr>
      <tr>
       <td width="300">EU (erm&auml;&szlig;igt)</td><td><input type="text" name="steuer_erloese_inland_euermaessigt" size="10" value="[STEUER_ERLOESE_INLAND_EUERMAESSIGT]"></td>
       <td width="300">EU (erm&auml;&szlig;igt)</td><td><input type="text" name="steuer_aufwendung_inland_euermaessigt" size="10" value="[STEUER_AUFWENDUNG_INLAND_EUERMAESSIGT]"></td>
      </tr>

       <tr>
		<td width="300">Export</td><td><input type="text" name="steuer_erloese_inland_export" size="10" value="[STEUER_ERLOESE_INLAND_EXPORT]"></td>
		<td width="300">Import</td><td><input type="text" name="steuer_aufwendung_inland_import" size="10" value="[STEUER_AUFWENDUNG_INLAND_IMPORT]"></td>
	</tr>
</table>
<table>
<tr>
		<td width="300">Anpassung Kundennummer</td><td colspan="3"><input type="text" name="steuer_anpassung_kundennummer" size="20" value="[STEUER_ANPASSUNG_KUNDENNUMMER]">&nbsp;<i>(Vor dem Export f&uuml;r die Buchhaltung wird der angegebene Wert gesucht und gel&ouml;scht.</i></td>
</tr>
</table>
</fieldset>

<!--
<fieldset><legend>Finanzbuchhaltung Export Kontenrahmen - Weitere Kostenarten</legend>
<table>
<tr><td width="300">Nr.</td><td>Bezeichnung</td><td>Steuer<br>(normal)</td><td>Steuer<br>(erm&auml;&szlig;igt)</td><td>Steuer<br>(steuerfrei)</td></tr>
<tr><td>Kostenart 1</td><td><input type="text" size="30" name="steuer_art_1" value="[STEUER_ART_1]"></td>
      <td><input type="text" size="10" name="steuer_art_1_normal" value="[STEUER_ART_1_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_1_ermaessigt" value="[STEUER_ART_1_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_1_steuerfrei" value="[STEUER_ART_1_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 2</td><td><input type="text" size="30" name="steuer_art_2" value="[STEUER_ART_2]"></td>
      <td><input type="text" size="10" name="steuer_art_2_normal" value="[STEUER_ART_2_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_2_ermaessigt" value="[STEUER_ART_2_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_2_steuerfrei" value="[STEUER_ART_2_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 3</td><td><input type="text" size="30" name="steuer_art_3" value="[STEUER_ART_3]"></td>
      <td><input type="text" size="10" name="steuer_art_3_normal" value="[STEUER_ART_3_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_3_ermaessigt" value="[STEUER_ART_3_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_3_steuerfrei" value="[STEUER_ART_3_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 4</td><td><input type="text" size="30" name="steuer_art_4" value="[STEUER_ART_4]"></td>
      <td><input type="text" size="10" name="steuer_art_4_normal" value="[STEUER_ART_4_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_4_ermaessigt" value="[STEUER_ART_4_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_4_steuerfrei" value="[STEUER_ART_4_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 5</td><td><input type="text" size="30" name="steuer_art_5" value="[STEUER_ART_5]"></td>
      <td><input type="text" size="10" name="steuer_art_5_normal" value="[STEUER_ART_5_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_5_ermaessigt" value="[STEUER_ART_5_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_5_steuerfrei" value="[STEUER_ART_5_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 6</td><td><input type="text" size="30" name="steuer_art_6" value="[STEUER_ART_6]"></td>
      <td><input type="text" size="10" name="steuer_art_6_normal" value="[STEUER_ART_6_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_6_ermaessigt" value="[STEUER_ART_6_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_6_steuerfrei" value="[STEUER_ART_6_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 7</td><td><input type="text" size="30" name="steuer_art_7" value="[STEUER_ART_7]"></td>
      <td><input type="text" size="10" name="steuer_art_7_normal" value="[STEUER_ART_7_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_7_ermaessigt" value="[STEUER_ART_7_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_7_steuerfrei" value="[STEUER_ART_7_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 8</td><td><input type="text" size="30" name="steuer_art_8" value="[STEUER_ART_8]"></td>
      <td><input type="text" size="10" name="steuer_art_8_normal" value="[STEUER_ART_8_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_8_ermaessigt" value="[STEUER_ART_8_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_8_steuerfrei" value="[STEUER_ART_8_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 9</td><td><input type="text" size="30" name="steuer_art_9" value="[STEUER_ART_9]"></td>
      <td><input type="text" size="10" name="steuer_art_9_normal" value="[STEUER_ART_9_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_9_ermaessigt" value="[STEUER_ART_9_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_9_steuerfrei" value="[STEUER_ART_9_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 10</td><td><input type="text" size="30" name="steuer_art_10" value="[STEUER_ART_10]"></td>
      <td><input type="text" size="10" name="steuer_art_10_normal" value="[STEUER_ART_10_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_10_ermaessigt" value="[STEUER_ART_10_STEUERFREI]"></td>
      <td><input type="text" size="10" name="steuer_art_10_steuerfrei" value="[STEUER_ART_10_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 11</td><td><input type="text" size="30" name="steuer_art_11" value="[STEUER_ART_11]"></td>
      <td><input type="text" size="10" name="steuer_art_11_normal" value="[STEUER_ART_11_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_11_ermaessigt" value="[STEUER_ART_11_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_11_steuerfrei" value="[STEUER_ART_11_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 12</td><td><input type="text" size="30" name="steuer_art_12" value="[STEUER_ART_12]"></td>
      <td><input type="text" size="10" name="steuer_art_12_normal" value="[STEUER_ART_12_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_12_ermaessigt" value="[STEUER_ART_12_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_12_steuerfrei" value="[STEUER_ART_12_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 13</td><td><input type="text" size="30" name="steuer_art_13" value="[STEUER_ART_13]"></td>
      <td><input type="text" size="10" name="steuer_art_13_normal" value="[STEUER_ART_13_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_13_ermaessigt" value="[STEUER_ART_13_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_13_steuerfrei" value="[STEUER_ART_13_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 14</td><td><input type="text" size="30" name="steuer_art_14" value="[STEUER_ART_14]"></td>
      <td><input type="text" size="10" name="steuer_art_14_normal" value="[STEUER_ART_14_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_14_ermaessigt" value="[STEUER_ART_14_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_14_steuerfrei" value="[STEUER_ART_14_STEUERFREI]"></td>
      </tr>
<tr><td>Kostenart 15</td><td><input type="text" size="30" name="steuer_art_15" value="[STEUER_ART_15]"></td>
      <td><input type="text" size="10" name="steuer_art_15_normal" value="[STEUER_ART_15_NORMAL]"></td>
      <td><input type="text" size="10" name="steuer_art_15_ermaessigt" value="[STEUER_ART_15_ERMAESSIGT]"></td>
      <td><input type="text" size="10" name="steuer_art_15_steuerfrei" value="[STEUER_ART_15_STEUERFREI]"></td>
      </tr>
</table>
</fieldset>
-->

<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-8');" value="Speichern"></center>
</div>

<div id="tabs-9">
<fieldset><legend>Einstellungen</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">Hauptprojekt</td><td>[PROJEKTAUTOSTART]<input type="text" name="projekt" id="projekt" value="[PROJEKT]" size="40">[PROJEKTAUTOENDE]&nbsp;<i>Standard Projekt</i></td></tr>
  <tr><td width="300">Kleine Aufl&ouml;sung</td><td><input type="checkbox" name="standardaufloesung" id="standardaufloesung" [STANDARDAUFLOESUNG]>&nbsp;<i>Keine Scrollbar bei kleinen Bildschirmen</i></td></tr>
  <tr><td width="300">Standard Drucker</td><td><select name="standardversanddrucker">[STANDARDVERSANDDRUCKER]</select>&nbsp;</td></tr>
  <tr><td width="300">Standard Etikettendrucker</td><td><select name="standardetikettendrucker">[STANDARDETIKETTENDRUCKER]</select>&nbsp;</td></tr>
  <tr><td width="300">Etikettendrucker Wareneingang</td><td><select name="etikettendrucker_wareneingang">[ETIKETTENDRUCKERWARENEINGANG]</select>&nbsp;</td></tr>
  <tr><td>Annahme mit Kamera/Waage</td><td><input type="checkbox" name="wareneingang_kamera_waage" [WARENEINGANG_KAMERA_WAAGE]> <i>(Es ist eine Kamera + Waage am Wareneingang vorhanden)</i></td></tr>
  <tr><td>Wareneingang mit Zwischenlager</td><td><input type="checkbox" name="wareneingang_zwischenlager" [WARENEINGANG_ZWISCHENLAGER]> <i>(Zwischenlager ist im Wareneingang vorausgew&auml;hlt.)</i></td></tr>

  <tr><td>Lieferschein Freitext Meldung</td><td><input type="checkbox" name="versand_gelesen" [VERSAND_GELESEN]> <i>(Rote Meldung im Versand muss von Mitarbeiter best&auml;tigt werden.)</i></td></tr>
  <tr><td>Mahnwesen mit Kontoabgleich</td><td><input type="checkbox" name="mahnwesenmitkontoabgleich" [MAHNWESENMITKONTOABGLEICH]> <i>(Der Zahlungsstatus von GS und RE werden automatisch gepr&uuml;ft.)</i></td></tr>
</table>
</fieldset>

<fieldset><legend>Artikel Parameter und Bezeichnung f&uuml; Freifelder</legend>
    <table cellspacing="5">
          <tr><td>aktiviert</td><td><input type="checkbox" name="parameterundfreifelder" [PARAMETERUNDFREIFELDER]>&nbsp;<i>Parameter und Freifelder im Artikel einblenden</i></td></tr>
          <tr><td width="300">Freifeld 1:</td><td><input type="text" name="freifeld1" size="40" value="[FREIFELD1]"></td></tr>
          <tr><td width="">Freifeld 2:</td><td><input type="text" name="freifeld2" size="40" value="[FREIFELD2]"></td></tr>
          <tr><td width="">Freifeld 3:</td><td><input type="text" name="freifeld3" size="40" value="[FREIFELD3]"></td></tr>
          <tr><td width="">Freifeld 4:</td><td><input type="text" name="freifeld4" size="40" value="[FREIFELD4]"></td></tr>
          <tr><td width="">Freifeld 5:</td><td><input type="text" name="freifeld5" size="40" value="[FREIFELD5]"></td></tr>
          <tr><td width="">Freifeld 6:</td><td><input type="text" name="freifeld6" size="40" value="[FREIFELD6]"></td></tr>
</table></fieldset>
<fieldset><legend>Bezeichnung Adresse Freifelder</legend>
    <table cellspacing="5">
          <tr><td width="300">Freifeld 1:</td><td><input type="text" name="adressefreifeld1" size="40" value="[ADRESSEFREIFELD1]"></td></tr>
          <tr><td width="300">Freifeld 2:</td><td><input type="text" name="adressefreifeld2" size="40" value="[ADRESSEFREIFELD2]"></td></tr>
          <tr><td width="300">Freifeld 3:</td><td><input type="text" name="adressefreifeld3" size="40" value="[ADRESSEFREIFELD3]"></td></tr>
          <tr><td width="300">Freifeld 4:</td><td><input type="text" name="adressefreifeld4" size="40" value="[ADRESSEFREIFELD4]"></td></tr>
          <tr><td width="300">Freifeld 5:</td><td><input type="text" name="adressefreifeld5" size="40" value="[ADRESSEFREIFELD5]"></td></tr>
          <tr><td width="300">Freifeld 6:</td><td><input type="text" name="adressefreifeld6" size="40" value="[ADRESSEFREIFELD6]"></td></tr>
          <tr><td width="300">Freifeld 7:</td><td><input type="text" name="adressefreifeld7" size="40" value="[ADRESSEFREIFELD7]"></td></tr>
          <tr><td width="300">Freifeld 8:</td><td><input type="text" name="adressefreifeld8" size="40" value="[ADRESSEFREIFELD8]"></td></tr>
          <tr><td width="300">Freifeld 9:</td><td><input type="text" name="adressefreifeld9" size="40" value="[ADRESSEFREIFELD9]"></td></tr>
          <tr><td width="300">Freifeld 10:</td><td><input type="text" name="adressefreifeld10" size="40" value="[ADRESSEFREIFELD10]"></td></tr>
</table></fieldset>

<fieldset><legend>Einstellungen Artikel, Optionen</legend>
    <table cellspacing="5">
          <tr><td width="300">Erweiterte Artikelsuche</td><td><input type="checkbox" name="artikel_suche_kurztext" [ARTIKELSUCHEKURZTEXT]><i>Suche auch im Kurztext DE</i></td></tr>
          <tr><td width="300">Artikelbilder in &Uuml;bersicht</td><td><input type="checkbox" name="artikel_bilder_uebersicht" [ARTIKEL_BILDER_UEBERSICHT]></td></tr>
          <tr><td width="300">Export Button (CSV,PDF,Clipboard) unter Tabelle</td><td><input type="checkbox" name="datatables_export_button_flash" [DATATABLES_EXPORT_BUTTON_FLASH]></td></tr>
          <tr><td width="300">Schnell anlegen</td><td><input type="checkbox" name="schnellanlegen" [SCHNELLANLEGEN]><i>Ohne Zwischenfragen beim Anlegen</i></td></tr>
          <tr><td width="300">Bestellvorschlag Menge</td><td><input type="checkbox" name="bestellvorschlaggroessernull" [BESTELLVORSCHLAGSGROESSERNULL]><i>Nur Artikel mit Menge > 0 anzeigen</i></td></tr>
          <tr><td width="300">Bestellung ohne Preise</td><td><input type="checkbox" name="bestellungohnepreis" [BESTELLUNGOHNEPREIS]><i>Als Standard definieren</i></td></tr>
          <tr><td width="300">Porto berechnen</td><td><input type="checkbox" name="porto_berechnen" [PORTO_BERECHNEN]><i>Porto wird wenn Bedingungen hinterlegt sind berechnet</i></td></tr>
          <tr><td width="300">Zeige Eintr&auml;ge:</td><td><input type="text" name="standard_datensaetze_datatables" size="40" value="[STANDARD_DATENSAETZE_DATATABLES]">&nbsp;(<i>10,25,50,200,1000)</i></td></tr>
          <tr><td width="300">Artikel Einheit im PDF</td><td><input type="checkbox" name="artikeleinheit" [ARTIKELEINHEIT]><i>Einblenden der Artikel Einheit in allen Dokumenten wie Angebot, Rechnung, Lieferschein usw.
          <tr><td width="300">Standard Artikel Einheit</td><td><input type="text" name="artikeleinheit_standard" value="[ARTIKELEINHEITSTANDARD]">&nbsp;<i>Einblenden wenn keine Artikel Einheit angegeben wurde.
</i></td></tr>
          <tr><td width="300">Herstellernummer im Dokument</td><td><input type="checkbox" name="herstellernummerimdokument" [HERSTELLERNUMMERIMDOKUMENT]><i>(Angebot, Auftrag, Rechnung, Lieferschein, Bestellung, Gutschrift) (wenn vorhanden)</i></td></tr>
          <tr><td width="300">Projekt im Dokument</td><td><input type="checkbox" name="projektnummerimdokument" [PROJEKTNUMMERIMDOKUMENT]><i>(Anzeige in Angebot, Auftrag, Rechnung, Lieferschein, Bestellung, Gutschrift) (wenn vorhanden)</i></td></tr>
          <tr><td width="300">Erweiterte Adresssuche</td><td><input type="checkbox" name="adresse_freitext1_suche" [ADRESSE_FREITEXT1_SUCHE]><i>(Suche in Freifeld 1)</i></td></tr>
          <tr><td width="300">Rechnung / Gutschrift Ansprechpartner</td><td><input type="checkbox"  name="rechnung_gutschrift_ansprechpartner" [RECHNUNG_GUTSCHRIFT_ANSPRECHPARTNER]><i>(Anzeige Ansprechpartner)</i></td></tr>
          <tr><td width="300">Geburtstage im Kalender</td><td><input type="checkbox"  name="geburtstagekalender" [GEBURTSTAGEKALENDER]></td></tr>

          <tr><td width="300">Beschriftung Kundennummer</td><td><input type="text" name="bezeichnungkundennummer" value="[BEZEICHNUNGKUNDENNUMMER]">&nbsp;<i>Beschriftung im PDF.</i></td></tr>
          <tr><td width="300">Auftrag Beschriftung Vertrieb</td><td><input type="text" name="auftrag_bezeichnung_vertrieb" value="[AUFTRAG_BEZEICHNUNG_VERTRIEB]">&nbsp;<i>Beschriftung im Auftrag.</i></td></tr>
          <tr><td width="300">Auftrag Beschriftung Bearbeiter</td><td><input type="text" name="auftrag_bezeichnung_bearbeiter" value="[AUFTRAG_BEZEICHNUNG_BEARBEITER]">&nbsp;<i>Beschriftung im Auftrag.</i></td></tr>
          <tr><td width="300">Auftrag Beschriftung Bestellnummer</td><td><input type="text" name="auftrag_bezeichnung_bestellnummer" value="[AUFTRAG_BEZEICHNUNG_BESTELLNUMMER]">&nbsp;<i>Beschriftung in allen Dokumenten.</i></td></tr>
          <tr><td width="300">Beschriftung Stornorechnung</td><td><input type="text" name="bezeichnungstornorechnung" value="[BEZEICHNUNGSTORNORECHNUNG]">&nbsp;<i>laut 06/2013 §14  UStG</i></td></tr>
          <tr><td width="300">[BEZEICHNUNGSTORNORECHNUNG] als Standard </td><td><input type="checkbox"  name="stornorechnung_standard" [STORNORECHNUNG_STANDARD]></td></tr>
          <tr><td width="300">Beschriftung Abweichend Angebot</td><td><input type="text" name="bezeichnungangebotersatz" value="[BEZEICHNUNGANGEBOTERSATZ]">&nbsp;<i>Beschriftung im Angebot</i></td></tr>
          <tr><td width="300">[BEZEICHNUNGANGEBOTERSATZ] als Standard </td><td><input type="checkbox"  name="angebotersatz_standard" [ANGEBOTERSATZ_STANDARD]></td></tr>
</table></fieldset>


<fieldset><legend>Farben</legend>
<table cellspacing="5" width="100%">
<tr><td width="300">Hintergrund</td><td><input type="text" name="firmenfarbe" value="[FIRMENFARBE]" size="40">&nbsp;<i>als HTML Farbcode (Helles Layout: #ececec)</i></td></tr>
<tr><td width="300">Dunkle Icons</td><td><input type="checkbox" name="iconset_dunkel" [ICONSET_DUNKEL]> <i>(Helles Layout)</i></td></tr>
<tr><td width="300"><br></td><td></td></tr>
<tr><td width="300">System 1 (Hell)</td><td><input type="text" name="firmenfarbehell" id="firmenfarbehell" value="[FIRMENFARBEHELL]" size="40">&nbsp;</td></tr>
<tr><td width="300">System 2 (Mittel)</td><td><input type="text" name="firmenfarbedunkel" id="firmenfarbedunkel" value="[FIRMENFARBEDUNKEL]" size="40">&nbsp;</td></tr>
<tr><td width="300">System 3 (Dunkel)</td><td><input type="text" name="firmenfarbeganzdunkel" id="firmenfarbeganzdunkel" value="[FIRMENFARBEGANZDUNKEL]" size="40">&nbsp;</td></tr>
<tr><td width="300">Navigation</td><td><input type="text" name="navigationfarbe" value="[NAVIGATIONFARBE]" size="40">&nbsp;<i>(Helles Layout: #e0e0e0)</i></td></tr>
<tr><td width="300">Navigation Schrift</td><td><input type="text" name="navigationfarbeschrift" value="[NAVIGATIONFARBESCHRIFT]" size="40">&nbsp;<i>(Helles Layout: #686868)</i></td></tr>
<!--<tr><td width="300">Unternavigation</td><td><input type="text" name="unternavigationfarbe" value="[UNTERNAVIGATIONFARBE]" size="40">&nbsp;<i>als HTML Farbcode</i></td></tr>
<tr><td width="300">Unternavigation Schrift</td><td><input type="text" name="unternavigationfarbeschrift" value="[UNTERNAVIGATIONFARBESCHRIFT]" size="40">&nbsp;<i>als HTML Farbcode</i></td></tr>-->
</table>
</fieldset>

<fieldset><legend>Logo</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300"><input type="checkbox" name="firmenlogoaktiv" [FIRMENLOGOAKTIV]> Eigene Datei</td><td><input type="file" name="firmenlogo">&nbsp;(<b style="color:red">Achtung aktuell wird nur PNG unterst&uuml;tzt!</b>)</td></tr>
</table>
</fieldset>


<fieldset><legend>Men&uuml;</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">Keine Icon Leiste</td><td><input type="checkbox" name="layout_iconbar" [LAYOUT_ICONBAR]> <i>(Icon Leiste im Layout de-aktivieren, nach Speichern auf neue Seite wechseln)</i></td></tr>
</table>
</fieldset>

<fieldset><legend>Datenbank</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">MySQL Version >= 5.5</td><td><input type="checkbox" name="mysql55" [MYSQL55]> <i>(Nur aktivieren wenn eine Version >= 5.5 verwendet wird) Version: [MYSQLVERSION]</i></td></tr>
</table>
</fieldset>



<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-9');" value="Speichern"></center>
</div>


<div id="tabs-10">
<fieldset><legend>Zugang Updateserver</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">Lizenz</td><td><input type="text" name="lizenz" value="[LIZENZ]" size="80"></td></tr>
  <tr><td>Schl&uuml;ssel</td><td><textarea rows="5" cols="80" name="schluessel">[SCHLUESSEL]</textarea></td></tr>
  <!--<tr><td>Branch</td><td><input type="text" name="branch" value="[BRANCH]" size="40"></td></tr>-->
  <!--<tr><td>Version</td><td><input type="text" name="version" readonly value="[VERSION]" size="40"></td></tr>-->
</table></fieldset>
<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-10');" value="Speichern"></center>
</div>


<div id="tabs-11">
<fieldset><legend>WaWision ERP API</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">API akiviert</td><td><input type="checkbox" name="api_enable" [APIENABLE]></td></tr>
  <tr><td>Init Key</td><td><input type="text" name="api_initkey" value="[APIINITKEY]" size="40"></td></tr>
  <tr><td>Remote Domain</td><td><input type="text" name="api_remotedomain" value="[APIREMOTEDOMAIN]" size="40"></td></tr>
  <tr><td>Aktueller Key</td><td>[APITEMPKEY]&nbsp;<i>(F&uuml;r Testzwecke)</i></td></tr>
  <tr><td>Event URL</td><td><input type="text" name="api_eventurl" value="[APIEVENTURL]" size="40"></td></tr>
  <tr><td width="300">Import Warteschlange</td><td><input type="checkbox" name="api_importwarteschlange" [API_IMPORTWARTESCHLANGE]></td></tr>
  <tr><td>Warteschlange Bezeichnung</td><td><input type="text" name="api_importwarteschlange_name" value="[API_IMPORTWARTESCHLANGE_NAME]" size="40"></td></tr>
  <tr><td>UTF8 Clean</td><td><input type="checkbox" name="api_cleanutf8" [API_CLEANUTF8]></td></tr>
  <!--<tr><td>Branch</td><td><input type="text" name="branch" value="[BRANCH]" size="40"></td></tr>-->
  <!--<tr><td>Version</td><td><input type="text" name="version" readonly value="[VERSION]" size="40"></td></tr>-->
</table></fieldset>
<fieldset><legend>WaWision Device API</legend>
<table cellspacing="5" width="100%">
  <tr><td width="300">WaWision Device API akiviert</td><td><input type="checkbox" name="deviceenable" [DEVICEENABLE]>&nbsp;<i>Wenn die API aktiv ist m&uuml;ssen alle Etikettendrucker &uuml;ber die API angesprochen werden.</i></td></tr>
  <tr><td>Security Key</td><td><input type="text" name="devicekey" id="devicekey" value="[DEVICEKEY]" size="40">&nbsp;
    <input type="button" value="Key generieren" onclick="document.getElementById('devicekey').value = generatePass(48);"></td></tr>
  <!--<tr><td>Device Seriennummern</td><td><textarea name="deviceserials" cols="40" rows="5">[DEVICESERIALS]</textarea></td></tr>-->
</table></fieldset>


<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-11');" value="Speichern"></center>
</div>

<div id="tabs-12">
<fieldset><legend>Module</legend>
    <table cellspacing="5">
          <tr><td width="300">Externer Einkauf</td><td><input type="checkbox" name="externereinkauf" [EXTERNEREINKAUF]>&nbsp;<i>(wenn Einkauf nicht &uuml;ber WaWision genutzt wird)</i></td></tr>
          <tr><td width="300">Modul Vertriebsstruktur (MLM)</td><td><input type="checkbox" name="modul_mlm" [MODUL_MLM]>&nbsp;<i>(aktiviert wenn Modul vorhanden)</i></td></tr>
          <tr><td width="300">Modul Verband</td><td><input type="checkbox" name="modul_verband" [MODUL_VERBAND]>&nbsp;<i>(aktiviert wenn Modul vorhanden)</i></td></tr>
          <tr><td width="300">Modul Mindesthaltbarkeit</td><td><input type="checkbox" name="modul_mhd" [MODUL_MHD]>&nbsp;<i>(aktiviert wenn Modul vorhanden)</i></td></tr>
          <tr><td width="300">Modul Verein</td><td><input type="checkbox" name="modul_verein" [MODUL_VEREIN]>&nbsp;<i>(aktiviert wenn Modul vorhanden)</i></td></tr>
          <tr><td width="300">Modul Finanzbuchhaltung</td><td><input type="checkbox" name="modul_finanzbuchhaltung" [MODUL_FINANZBUCHHALTUNG]>&nbsp;<i>(aktiviert wenn Modul vorhanden)</i></td></tr>
</table></fieldset>
<br><center><input type="submit" name="submitFirmendaten" onclick="$('#firmendatenform').attr('action','#tabs-12');" value="Speichern"></center>
</div>




</div>
</form>



