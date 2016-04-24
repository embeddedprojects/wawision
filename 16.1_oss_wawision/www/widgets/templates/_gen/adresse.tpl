<script type="text/javascript">

$(document).ready(function(){
    var vorname = $('#vorname').val();
    var typ = $('select[name=typ]').val();

    if(typ=='herr' || typ=='frau') {
      document.getElementById('ansprechpartner_label').innerHTML="";
      document.getElementById('ansprechpartner').style.visibility="hidden";
      document.getElementById('name_label').innerHTML="Vor- & Nachname:";
    }

 document.getElementById('abweichenderechnungsadressestyle').style.display="none";
    if(document.getElementById('abweichende_rechnungsadresse').checked)
      document.getElementById('abweichenderechnungsadressestyle').style.display="";

  });


  function onchange_typ(el)  {
    if(el=='herr' || el=='frau') {
      document.getElementById('ansprechpartner_label').innerHTML="";
      document.getElementById('ansprechpartner').style.visibility="hidden";
      document.getElementById('name_label').innerHTML="Vor- & Nachname:";
    } else {
      document.getElementById('ansprechpartner_label').innerHTML="Ansprechpartner:";
      document.getElementById('ansprechpartner').style.visibility= "";
      document.getElementById('name_label').innerHTML="Firmenname:";
    } 
  }

  function abweichend(cmd)
        {
          document.getElementById('abweichenderechnungsadressestyle').style.display="none";
    if(document.getElementById('abweichende_rechnungsadresse').checked)
      document.getElementById('abweichenderechnungsadressestyle').style.display="";
        }
      //-->
     </script>

[SAVEPAGEREALLY]
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Adressdaten</a></li>
        <li><a href="#tabs-2">Zahlungskonditionen</a></li>
        <li><a href="#tabs-3">Bankverbindung</a></li>
        <li><a href="#tabs-4">Dokumente Versandoptionen</a></li>
        <li><a href="#tabs-5">Sonstige Daten</a></li>
    </ul>

<div id="tabs-1">

[MESSAGEROLLE]
[MESSAGE]

<form action="" method="post" name="eprooform">
  <table class="tableborder" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
      <tr valign="top">
        <td >
<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%">[STATUSICONS]</td>
<td align="center" nowrap><b style="font-size: 14pt">Adresse <font color="blue">[ANZEIGENUMMER]</font></b>[ANZEIGENAMEDE]</td>
<td width="33%" align="right">[ICONMENU]&nbsp; <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-1';"/> [ABBRECHEN]</td>
</tr>
</table>
<div style="height:10px"></div>

[BUTTONS]
[FORMHANDLEREVENT]


<fieldset><legend>Stammdaten</legend>
		
    <table width="100%">
	  <tr><td width="110">Anrede:</td><td width="400">[TYP][MSGTYP]</td>
          <td>&nbsp;</td>
            <td width="210"></td><td></td></tr>

          <tr><td><span id="name_label">Firmenname:*</span></td><td>[NAME][MSGNAME]</td>
          <td>&nbsp;</td>
            <td>Telefon:</td><td>[TELEFON][MSGTELEFON]&nbsp;[TELEFONBUTTON]</td></tr>

    
          <tr><td><span id="ansprechpartner_label">Ansprechpartner:</span></td><td>[ANSPRECHPARTNER][MSGANSPRECHPARTNER]</td>
          <td>&nbsp;</td>
            <td>Telefax:</td><td>[TELEFAX][MSGTELEFAX]</td></tr>

      <tr><td>Titel:</td><td>[TITEL][MSGTITEL]</td>
          <td>&nbsp;</td>
            <td>Anschreiben (Sehr geehrter ...):</td><td>[ANSCHREIBEN][MSGANSCHREIBEN]</td></tr>

          <tr><td>Abteilung:</td><td>[ABTEILUNG][MSGABTEILUNG]</td><td>&nbsp;</td>
          <td>E-Mail:</td><td>[EMAIL][MSGEMAIL]</td></tr>

          <tr><td>Unterabteilung:</td><td>[UNTERABTEILUNG][MSGUNTERABTEILUNG]</td><td>&nbsp;</td>
           <td>Mobil:</td><td>[MOBIL][MSGMOBIL]</td></tr>

	  <tr><td>Adresszusatz:</td><td>[ADRESSZUSATZ][MSGADRESSZUSATZ]</td><td>&nbsp;</td>
          <td>Internetseite:</td><td>[INTERNETSEITE][MSGINTERNETSEITE]</td></tr>

          <tr><td>Stra&szlig;e:</td><td>[STRASSE][MSGSTRASSE]</td><td>&nbsp;</td>
            <td>Kundenfreigabe:</td><td>[KUNDENFREIGABE][MSGKUNDENFREIGABE]
	    </td></tr>
          <tr><td>PLZ/Ort:</td><td nowrap>[PLZ][MSGPLZ]&nbsp;[ORT][MSGORT]</td><td>&nbsp;</td>
            <td>Abweichende Rechnungsadresse</td><td>[ABWEICHENDE_RECHNUNGSADRESSE][MSGABWEICHENDE_RECHNUNGSADRESSE]</td></tr>

          <tr valign="top"><td>Land:</td><td colspan="2">[EPROO_SELECT_LAND]</td>
            <td colspan="2" align="right">[BUTTON_KONTAKTE]</td></tr>
          </tr>

</table></fieldset>
<div style="display:[ABWEICHENDERECHNUNGSADRESSESTYLE]" id="abweichenderechnungsadressestyle">
<fieldset><legend>Abweichende Rechnungsadresse</legend>
		[RECHNUNG_VORNAME][MSGRECHNUNG_VORNAME]
    <table width="100%">
	  <tr><td width="110">Anrede:</td><td>[RECHNUNG_TYP][MSGRECHNUNG_TYP]</td>
          <td>&nbsp;</td>
            <td></td><td></td></tr>

          <tr><td>Name:*</td><td>[RECHNUNG_NAME][MSGRECHNUNG_NAME]</td>
          <td>&nbsp;</td>
            <td>Telefon:</td><td>[RECHNUNG_TELEFON][MSGRECHNUNG_TELEFON]</td></tr>

    
          <tr><td><span id="ansprechpartner_label">Ansprechpartner:</span></td><td>[RECHNUNG_ANSPRECHPARTNER][MSGRECHNUNG_ANSPRECHPARTNER]</td>
          <td>&nbsp;</td>
            <td>Telefax:</td><td>[RECHNUNG_TELEFAX][MSGRECHNUNG_TELEFAX]</td></tr>

      <tr><td>Titel:</td><td>[RECHNUNG_TITEL][MSGRECHNUNG_TITEL]</td>
          <td>&nbsp;</td>
            <td>Anschreiben (Sehr geehrter ...):</td><td>[RECHNUNG_ANSCHREIBEN][MSGRECHNUNG_ANSCHREIBEN]</td></tr>


          <tr><td>Abteilung:</td><td>[RECHNUNG_ABTEILUNG][MSGRECHNUNG_ABTEILUNG]</td><td>&nbsp;</td>
          <td>E-Mail:</td><td>[RECHNUNG_EMAIL][MSGRECHNUNG_EMAIL]</td></tr>

          <tr><td>Unterabteilung:</td><td>[RECHNUNG_UNTERABTEILUNG][MSGRECHNUNG_UNTERABTEILUNG]</td><td>&nbsp;</td>
           <td></td><td></td></tr>

	  <tr><td>Adresszusatz:</td><td>[RECHNUNG_ADRESSZUSATZ][MSGRECHNUNG_ADRESSZUSATZ]</td><td>&nbsp;</td>
          <td></td><td></td></tr>

          <tr><td>Stra&szlig;e:</td><td>[RECHNUNG_STRASSE][MSGRECHNUNG_STRASSE]</td><td>&nbsp;</td>
            <td></td><td>
	    </td></tr>
          <tr><td>PLZ/Ort:</td><td nowrap>[RECHNUNG_PLZ][MSGRECHNUNG_PLZ]&nbsp;[RECHNUNG_ORT][MSGRECHNUNG_ORT]</td><td>&nbsp;</td>
            <td colspan="2" rowspan="2" align="right">[BUTTON_KONTAKTE_RECHNUNG]</td></tr>

          <tr><td>Land:</td><td colspan="2">[EPROO_SELECT_LAND_RECHNUNG]</td>
          </tr>

</table></fieldset>
</div>
</td></tr>
<tr valign="top"><td>
<fieldset><legend>Steuer</legend>
    <table width="98%">
	<tr><td width="110">USt-ID:</td><td width="400">[USTID][MSGUSTID]</td><td>&nbsp;</td><td width="210">Steuernummer</td><td>[STEUERNUMMER][MSGSTEUERNUMMER]</td></tr>
	<tr><td>Besteuerung:</td><td>[UST_BEFREIT][MSGUST_BEFREIT]</td><td></td><td>Kleingewerbe (UST befreit)</td><td>[STEUERBEFREIT][MSGSTEUERBEFREIT]</td></tr>
</table></fieldset>

</td></tr>

<tr valign="top"><td>
<fieldset><legend>Sonstiges</legend>
<table width="98%">
	<tr><td width="110">Hauptprojekt:</td><td width="400">[PROJEKTSTART][PROJEKT][MSGPROJEKT][PROJEKTENDE]</td><td>&nbsp;</td><td width="210">Sprache</td><td>[SPRACHE][MSGSPRACHE]</td></tr>
	
	  <tr><td>Liefersperre:</td><td>[LIEFERSPERRE][MSGLIEFERSPERRE]</td><td></td><td>Marketingsperre:</td><td>[MARKETINGSPERRE][MSGMARKETINGSPERRE]</td></tr>

	  <tr valign="top"><td rowspan="6">Liefersperre Grund:</td><td rowspan="5">[LIEFERSPERREGRUND][MSGLIEFERSPERREGRUND]</td><td></td><td>Potentieller Neukunde (Lead):</td><td>[LEAD][MSGLEAD]</td></tr>
	  <tr valign="top"><td></td><td><br></td><td><!---->&nbsp;</td></tr>
	  <tr valign="top"><td></td><td>Folgebest&auml;tigungsperre:</td><td>[FOLGEBESTAETIGUNGSPERRE][MSGFOLGEBESTAETIGUNGSPERRE]</td></tr>
	  <tr valign="top"><td></td><td>Trackingmailsperre:</td><td>[TRACKINGSPERRE][MSGTRACKINGSPERRE]</td></tr>
	  <tr valign="top"><td></td><td><!----></td><td><!---->&nbsp;</td></tr>
	  <tr valign="top"><td></td><td><!----></td><td><!---->&nbsp;</td></tr>
	  <!--<tr><td>Rechnungsadresse:</td><td>[RECHNUNGSADRESSE][MSGRECHNUNGSADRESSE]&nbsp;(Die Stammdaten werden als Rechnungsadresse verwendet. Manuelle Eingaben werden immer ignoriert.)</td></tr>-->
	  <!--<tr><td>URL Passwort erzeugt:</td><td>[PASSWORT_GESENDET][MSGPASSWORT_GESENDET]</td></tr>-->
	  <tr><td><br><br></td><td colspan="4"></td></tr>
	  <tr><td>Sonstiges:</td><td colspan="4">[SONSTIGES][MSGSONSTIGES]</td></tr>
	  <tr><td>Info f&uuml;r Auftragserfassung:</td><td colspan="4">[INFOAUFTRAGSERFASSUNG][MSGINFOAUFTRAGSERFASSUNG]</td></tr>
          </table>
</fieldset>
<fieldset><legend>Kunde/Lieferant</legend>
<table>
          <tr><td width="110">Kunden Nr.:</td><td>[KUNDENNUMMER][MSGKUNDENNUMMER]</td></tr>
          <tr><td>Lieferanten Nr.:</td><td>[LIEFERANTENNUMMER][MSGLIEFERANTENNUMMER]</td></tr>
          <tr><td>Mitarbeiter Nr.:</td><td>[MITARBEITERNUMMER][MSGMITARBEITERNUMMER]</td></tr>
          [STARTDISABLEVERBAND]<tr><td>Mitgliedsnummer im Verband:</td><td>[VERBANDSNUMMER][MSGVERBANDSNUMMER]</td></tr>[ENDEDISABLEVERBAND]
</table>
</fieldset>

</td>
</tr></table>
        </td>
      </tr>

    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="1" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" /> <input type="button" value="Abbrechen" /></td>
    </tr>
  
    </tbody>
  </table>

</div>



<div id="tabs-2">
[MESSAGE]
  <table class="tableborder" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>

      <tr valign="top">
        <td >

<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%">[STATUSICONS]</td>
<td align="center" nowrap><b style="font-size: 14pt">Adresse <font color="blue">[ANZEIGENUMMER]</font></b>[ANZEIGENAMEDE]</td>
<td width="33%" align="right">[ICONMENU]&nbsp; <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-2';"/> [ABBRECHEN]</td>
</tr>
</table>
<div style="height:10px"></div>

</td></tr></table>
  

<table width="100%" cellpadding="0" cellspacing="0"><tr valign="top"><td width="50%">
<fieldset style="height:200px"><legend>Zahlungskonditionen des Kunden f&uuml;r Rechnungen</legend>
<table border="0" width="100%">
            <tbody>
[STARTDISABLEVERBAND]<tr><td>Zahlungskonditionen festschreiben:</td><td>[ZAHLUNGSKONDITIONEN_FESTSCHREIBEN][MSGZAHLUNGSKONDITIONEN_FESTSCHREIBEN]&nbsp;<i>Immer diese verwenden (nie von Gruppe)</i></td></tr>[ENDEDISABLEVERBAND]
<tr><td width="200">Zahlungsweise:</td><td>[ZAHLUNGSWEISE][MSGZAHLUNGSWEISE]<td></tr>
<tr><td>Zahlungsziel (bei Rechnung):</td><td>[ZAHLUNGSZIELTAGE][MSGZAHLUNGSZIELTAGE]&nbsp; in Tagen</td></tr>
<tr><td nowrap>Zahlungsziel Skonto (bei Rechnung):</td><td>[ZAHLUNGSZIELTAGESKONTO][MSGZAHLUNGSZIELTAGESKONTO]&nbsp;in Tagen</td></tr>
<tr><td>Skonto (bei Rechnung):</td><td>[ZAHLUNGSZIELSKONTO][MSGZAHLUNGSZIELSKONTO]&nbsp;in %</td></tr>
<tr><td width="210">Lieferantennummer bei Kunde:</td><td>[LIEFERANTENNUMMERBEIKUNDE][MSGLIEFERANTENNUMMERBEIKUNDE]</td></tr>
</tbody></table>
</fieldset>

</td><td>
<fieldset style="height:200px"><legend>Zahlungskonditionen beim Lieferant bei Bestellungen</legend>
<table border="0" width="100%">
            <tbody>
<tr><td>Zahlungsweise:</td><td>[ZAHLUNGSWEISELIEFERANT][MSGZAHLUNGSWEISELIEFERANT]<td></tr>
<tr><td>Zahlungsziel (in Tagen):</td><td>[ZAHLUNGSZIELTAGELIEFERANT][MSGZAHLUNGSZIELTAGELIEFERANT]</td></tr>
<tr><td nowrap>Zahlungsziel Skonto (in Tagen):</td><td>[ZAHLUNGSZIELTAGESKONTOLIEFERANT][MSGZAHLUNGSZIELTAGESKONTOLIEFERANT]</td></tr>
<tr><td>Skonto:</td><td>[ZAHLUNGSZIELSKONTOLIEFERANT][MSGZAHLUNGSZIELSKONTOLIEFERANT]</td></tr>
<tr><td>Lieferart:</td><td>[VERSANDARTLIEFERANT][MSGVERSANDARTLIEFERANT]</td></tr>
<tr><td width="210">Kundennummer bei Lieferant:</td><td>[KUNDENNUMMERLIEFERANT][MSGKUNDENNUMMERLIEFERANT]</td></tr>
</tbody></table>
</fieldset>
</td></tr></table>
<br>
</td>
   <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" onclick="this.form.action += '#tabs-2';"/> <input type="button" value="Abbrechen" /></td>
    </tr>
    </tbody>
  </table>
</div>




<div id="tabs-3">
[MESSAGE]
  <table class="tableborder" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>

      <tr valign="top">
        <td >

<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%">[STATUSICONS]</td>
<td align="center" nowrap><b style="font-size: 14pt">Adresse <font color="blue">[ANZEIGENUMMER]</font></b>[ANZEIGENAMEDE]</td>
<td width="33%" align="right">[ICONMENU]&nbsp; <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-3';"/> [ABBRECHEN]</td>
</tr>
</table>
<div style="height:10px"></div>

</td></tr></table>
  

<fieldset><legend>Bankverbindung</legend>
<table>
<tr><td width="210">Inhaber:</td><td>[INHABER][MSGINHABER]</td>
<td>&nbsp;</td>
<td>Bank:</td><td>[BANK][MSGBANK]</td></tr>

<!--<tr><td>Konto:</td><td>[KONTO][MSGKONTO]</td><td>&nbsp;</td>
<td>BLZ:</td><td>[BLZ][MSGBLZ]</td></tr>-->

<tr><td>BIC:</td><td>[SWIFT][MSGSWIFT]</td>
<td>&nbsp;</td>
<td>IBAN:</td><td>[IBAN][MSGIBAN]</td></tr>

<tr><td>Mandatsreferenz:</td><td>[MANDATSREFERENZ][MSGMANDATSREFERENZ]</td>
<td>&nbsp;</td>
<td>Lastschrift Art:</td><td>[MANDATSREFERENZART][MSGMANDATSREFERENZART]
&nbsp;[MANDATSREFERENZWDHART][MSGMANDATSREFERENZWDHART]
</td></tr>

<tr><td>Mandatsreferenz Datum:</td><td>[MANDATSREFERENZDATUM][MSGMANDATSREFERENZDATUM]</td>
<td>&nbsp;</td>
<td>Mandatsreferent &Auml;nderung:</td><td>[MANDATSREFERENZAENDERUNG][MSGMANDATSREFERENZAENDERUNG]&nbsp;<i>&Auml;nderung seit letzter Lastschrift</i></td></tr>


<tr><td>W&auml;hrung:</td><td>[WAEHRUNG][MSGWAEHRUNG]</td><td>&nbsp;</td>
<td></td><td><a href="index.php?module=adresse&action=sepamandat&id=[ID]">Download SEPA Mandatsreferenz</a></td></tr>
</table></fieldset>
<fieldset><legend>Paypal (bei Zahlungen)</legend>
<table>
<tr><td width="210">Inhaber:</td><td>[PAYPALINHABER][MSGPAYPALINHABER]</td>
<td>&nbsp;</td>
<td>Paypal-Account:</td><td>[PAYPAL][MSGPAYPAL]</td></tr>
<tr><td>W&auml;hrung:</td><td>[PAYPALWAEHRUNG][MSGPAYPALWAEHRUNG]</td><td>&nbsp;</td>
<td></td><td></td></tr>
</table></fieldset>
<br>
</td>
   <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="1" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" onclick="this.form.action += '#tabs-3';"/> <input type="button" value="Abbrechen" /></td>
    </tr>
    </tbody>
  </table>
</div>


<div id="tabs-4">
[MESSAGE]
  <table class="tableborder" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>

      <tr valign="top">
        <td >

<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%">[STATUSICONS]</td>
<td align="center" nowrap><b style="font-size: 14pt">Adresse <font color="blue">[ANZEIGENUMMER]</font></b>[ANZEIGENAMEDE]</td>
<td width="33%" align="right">[ICONMENU]&nbsp; <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-4';"/> [ABBRECHEN]</td>
</tr>
</table>
<div style="height:10px"></div>

</td></tr></table>
 
<fieldset><legend>Allgemeine Versandoptionen</legend> 
<table>
<tr><td width="210">Immer Papier Rechnung:</td><td>[RECHNUNG_PAPIER][MSGRECHNUNG_PAPIER]&nbsp;<i>Bei automatischen Versand wird immer eine Rechnung per Papier versendet (auch wenn eine E-Mail vorhanden ist)</i></td></tr>
<tr><td width="210">Anzahl Ausdrucke Rechnung:</td><td>[RECHNUNG_ANZAHLPAPIER][MSGRECHNUNG_ANZAHLPAPIER]&nbsp;<i>Anzahl der Ausdrucke beim Versand</i></td></tr>
<tr><td width="210">Immer E-Mail Rechnung:</td><td>[RECHNUNG_PERMAIL][MSGRECHNUNG_PERMAIL]&nbsp;<i>(Immer E-Mail Rechnung, Kein Papier - wird aktuell noch nicht ausgewertet!)</i></td></tr>
</table>
</fieldset>

<fieldset><legend>E-Mail Kopie Empf&auml;nger (Dokument abschicken)</legend>
<table>
<tr><td width="210">Angebot:</td><td>[ANGEBOT_CC][MSGANGEBOT_CC]&nbsp;<i>Zus&auml;tzlich eingetragener E-Mail Empf&auml;nger</i></td></tr>
<tr><td width="210">Auftrag:</td><td>[AUFTRAG_CC][MSGAUFTRAG_CC]&nbsp;<i>Zus&auml;tzlich eingetragener E-Mail Empf&auml;nger</i></td></tr>
<tr><td width="210">Rechnung:</td><td>[RECHNUNG_CC][MSGRECHNUNG_CC]&nbsp;<i>Zus&auml;tzlich eingetragener E-Mail Empf&auml;nger</i></td></tr>
<tr><td width="210">Gutschrift:</td><td>[GUTSCHRIFT_CC][MSGGUTSCHRIFT_CC]&nbsp;<i>Zus&auml;tzlich eingetragener E-Mail Empf&auml;nger</i></td></tr>
<tr><td width="210">Lieferschein:</td><td>[LIEFERSCHEIN_CC][MSGLIEFERSCHEIN_CC]&nbsp;<i>Zus&auml;tzlich eingetragener E-Mail Empf&auml;nger</i></td></tr>
<tr><td width="210">Bestellung:</td><td>[BESTELLUNG_CC][MSGBESTELLUNG_CC]&nbsp;<i>Zus&auml;tzlich eingetragener E-Mail Empf&auml;nger</i></td></tr>
</table></fieldset>

<fieldset><legend>Fax Kopie Empf&auml;nger</legend>
<table>
<tr><td width="210">AB per Fax bevorzugt:</td><td>[ABPERFAX][MSGABPERFAX]&nbsp;<i>Fax vorausw&auml;hlen bei Versand</i></td></tr>
<!--
<tr><td width="210">Angebot:</td><td>[ANGEBOT_FAX_CC][MSGANGEBOT_FAX_CC]&nbsp;<i>Zus&auml;tzlich eingetragener Fax Empf&auml;nger</i></td></tr>
<tr><td width="210">Auftrag:</td><td>[AUFTRAG_FAX_CC][MSGAUFTRAG_FAX_CC]&nbsp;<i>Zus&auml;tzlich eingetragener Fax Empf&auml;nger</i></td></tr>
<tr><td width="210">Rechnung:</td><td>[RECHNUNG_FAX_CC][MSGRECHNUNG_FAX_CC]&nbsp;<i>Zus&auml;tzlich eingetragener Fax Empf&auml;nger</i></td></tr>
<tr><td width="210">Gutschrift:</td><td>[GUTSCHRIFT_FAX_CC][MSGGUTSCHRIFT_FAX_CC]&nbsp;<i>Zus&auml;tzlich eingetragener Fax Empf&auml;nger</i></td></tr>
<tr><td width="210">Lieferschein:</td><td>[LIEFERSCHEIN_FAX_CC][MSGLIEFERSCHEIN_FAX_CC]&nbsp;<i>Zus&auml;tzlich eingetragener Fax Empf&auml;nger</i></td></tr>
<tr><td width="210">Bestellung:</td><td>[BESTELLUNG_FAX_CC][MSGBESTELLUNG_FAX_CC]&nbsp;<i>Zus&auml;tzlich eingetragener Fax Empf&auml;nger</i></td></tr>
-->
</table></fieldset>


<br>
</td>
   <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="1" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" onclick="this.form.action += '#tabs-4';"/> <input type="button" value="Abbrechen" /></td>
    </tr>
    </tbody>
  </table>
</div>







<div id="tabs-5">
[MESSAGE]
<table class="tableborder" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>

      <tr valign="top">
        <td >

<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%">[STATUSICONS]</td>
<td align="center" nowrap><b style="font-size: 14pt">Adresse <font color="blue">[ANZEIGENUMMER]</font></b>[ANZEIGENAMEDE]</td>
<td width="33%" align="right">[ICONMENU]&nbsp; <input type="submit" name="speichern"
    value="Speichern" onclick="this.form.action += '#tabs-5';"/> [ABBRECHEN]</td>
</tr>
</table>
<div style="height:10px"></div>

</td></tr></table>



<fieldset><legend>Vertrieb / Innendienst</legend>
<table border="0" width="100%">
            <tbody>
<tr><td width="210">Vertrieb:</td><td>[VERTRIEB][MSGVERTRIEB]</td></tr>
<tr><td width="210">Provision:</td><td>[PROVISION][MSGPROVISION] % <i>(In Prozent f&uuml;r Vertrieb)</td></tr>
<tr><td>Innendienst:</td><td>[INNENDIENST][MSGINNENDIENST]</td></tr>
</tbody></table>
</fieldset>

<fieldset><legend>Porto / Versandart</legend>
<table border="0" width="100%">
            <tbody>
<tr><td width="210">Porto frei aktiv:</td><td>[PORTOFREI_AKTIV][MSGPORTOFREI_AKTIV]&nbsp;ab&nbsp;[PORTOFREIAB][MSGPORTOFREIAB]&nbsp;&euro;&nbsp;<i>Porto frei ab bestimmtem Umsatz (netto)</i></td></tr>

<tr><td>Versandart:</td><td>[VERSANDART][MSGVERSANDART]</td></tr>
<!--<tr><td>Standard Tour:</td><td>[TOUR][MSGTOUR]</td></tr>-->

</tbody></table>
</fieldset>
<fieldset><legend>Porto bei Lieferant</legend>
<table border="0" width="100%">
            <tbody>
<tr><td width="210">Porto frei aktiv:</td><td>[PORTOFREILIEFERANT_AKTIV][MSGPORTOFREILIEFERANT_AKTIV]&nbsp;ab&nbsp;[PORTOFREIABLIEFERANT][MSGPORTOFREIABLIEFERANT]&nbsp;&euro;&nbsp;<i>Porto frei ab bestimmtem Umsatz (netto)</i></td></tr>
</tbody></table>
</fieldset>



[STARTDISABLEPOS]
<!--<fieldset><legend>Modul POS (Kasse)</legend>
<table>
<tr><td width="210">Als Kassierer aktiv:</td><td>[KASSIERERAKTIV][MSGKASSIERERAKTIV]</td>
<tr><td width="210">Kassierer Nr.:</td><td>[KASSIERERNUMMER][MSGKASSIERERNUMMER]</td>
<tr><td width="210">Kassierer Filiale:</td><td>[KASSIERERPROJEKT][MSGKASSIERERPROJEKT]</td>
<td>&nbsp;</td>
<td></td><td></td></tr>
</table></fieldset>
-->
[ENDEDISABLEPOS]

[STARTDISABLEVERBAND]
<fieldset><legend>Verbandsoptionen</legend>

<table border="0">
<tr><td width="210">Kundenspezifische Angaben:</td><td>[RABATTE_FESTSCHREIBEN][MSGRABATTE_FESTSCHREIBEN]&nbsp;

Immer die folgenden Angaben f&uuml;r diesen Kunden verwenden!</td></tr>

<tr><td width="210">Grundrabatt:</td><td>
[RABATT][MSGRABATT] %
</td><td>
</td></tr>
</table>

    <table width="100%">
          <tr><td width="200">Rabatte:</td><td>
<table>
<tr><td>Rabatt 1:</td><td>[RABATT1][MSGRABATT1] %</td><td width="100">&nbsp;</td>
    <td>Bonus 1:</td><td>[BONUS1][MSGBONUS1] % ab [BONUS1_AB][MSGBONUS1_AB] &euro;</td><td width="50">&nbsp;</td>
    <td>Bonus 6:</td><td>[BONUS6][MSGBONUS6] % ab [BONUS6_AB][MSGBONUS6_AB] &euro;</td>
</tr>
<tr><td>Rabatt 2:</td><td>[RABATT2][MSGRABATT2] %</td><td width="100">&nbsp;</td>
    <td>Bonus 2:</td><td>[BONUS2][MSGBONUS2] % ab [BONUS2_AB][MSGBONUS2_AB] &euro;</td><td width="50">&nbsp;</td>
    <td>Bonus 7:</td><td>[BONUS7][MSGBONUS7] % ab [BONUS7_AB][MSGBONUS7_AB] &euro;</td>
</tr>
<tr><td>Rabatt 3:</td><td>[RABATT3][MSGRABATT3] %</td><td width="100">&nbsp;</td>
    <td>Bonus 3:</td><td>[BONUS3][MSGBONUS3] % ab [BONUS3_AB][MSGBONUS3_AB] &euro;</td><td width="50">&nbsp;</td>
    <td>Bonus 8:</td><td>[BONUS8][MSGBONUS8] % ab [BONUS8_AB][MSGBONUS8_AB] &euro;</td>
</tr>
<tr><td>Rabatt 4:</td><td>[RABATT4][MSGRABATT4] %</td><td width="100">&nbsp;</td>
    <td>Bonus 4:</td><td>[BONUS4][MSGBONUS4] % ab [BONUS4_AB][MSGBONUS4_AB] &euro;</td><td width="50">&nbsp;</td>
    <td>Bonus 9:</td><td>[BONUS9][MSGBONUS9] % ab [BONUS9_AB][MSGBONUS9_AB] &euro;</td>
</tr>
<tr><td>Rabatt 5:</td><td>[RABATT5][MSGRABATT5] %</td><td width="100">&nbsp;</td>
    <td>Bonus 5:</td><td>[BONUS5][MSGBONUS5] % ab [BONUS5_AB][MSGBONUS5_AB] &euro;</td><td width="50">&nbsp;</td>
    <td>Bonus 10:</td><td>[BONUS10][MSGBONUS10] % ab [BONUS10_AB][MSGBONUS10_AB] &euro;</td>
</tr>

</table>

</td><td></tr>
</table>

<table width="100%" border="0">
<tr><td width="210">Rabattinformationen:</td><td>[RABATTINFORMATION][MSGRABATTINFORMATION]</td></tr>
<tr><td width="210">Filiale:</td><td>[FILIALE][MSGFILIALE]</td></tr>
</table>


</fieldset>
[ENDEDISABLEVERBAND]
<fieldset><legend>Sonstiges</legend>
<table>
<tr><td width="210">Geburtstag:</td><td>[GEBURTSTAG][MSGGEBURTSTAG]&nbsp;[GEBURTSTAGKALENDER][MSGGEBURTSTAGKALENDER]&nbsp;im Kalender anzeigen</td>
<td>&nbsp;</td>
<td></td><td></td></tr>
</table></fieldset>


<fieldset><legend>Finanzbuchhaltung</legend>
<table>
<tr><td width="210">Reisekosten:</td><td>[VERRECHNUNGSKONTOREISEKOSTEN][MSGVERRECHNUNGSKONTOREISEKOSTEN]&nbsp;<i>Verrechnungskonto</i></td>
<td>&nbsp;</td>
<td></td><td></td></tr>
<!--<tr><td width="210">Sachkonto Erl&ouml;se:</td><td>[SACHKONTO][MSGSACHKONTO]&nbsp;<i>Optional falls es manuell f&uuml;r Kunden angegeben werden soll.</i></td>
<td>&nbsp;</td>
<td></td><td></td></tr>-->


<tr><td width="210">Kredit Limit:</td><td>[KREDITLIMIT][MSGKREDITLIMIT]&nbsp;<i>in &euro;</i></td>
<td>&nbsp;</td>
<td></td><td></td></tr>


</table></fieldset>

<fieldset><legend>Personalwesen Einstellungen</legend>
<table>
<tr><td width="210">Arbeitszeit pro Woche:</td><td>[ARBEITSZEITPROWOCHE][MSGARBEITSZEITPROWOCHE]&nbsp;<i>in Stunden</i></td>
<td>&nbsp;</td>
<td></td><td></td></tr>
</table>
</fieldset>


<fieldset><legend>Freifelder </legend>
<table>
<tr><td width="210">[FREIFELD1BEZEICHNUNG]:</td><td>[FREIFELD1][MSGFREIFELD1]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
<tr><td width="210">[FREIFELD2BEZEICHNUNG]:</td><td>[FREIFELD2][MSGFREIFELD2]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
<tr><td width="210">[FREIFELD3BEZEICHNUNG]:</td><td>[FREIFELD3][MSGFREIFELD3]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
<tr><td width="210">[FREIFELD4BEZEICHNUNG]:</td><td>[FREIFELD4][MSGFREIFELD4]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
<tr><td width="210">[FREIFELD5BEZEICHNUNG]:</td><td>[FREIFELD5][MSGFREIFELD5]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
<tr><td width="210">[FREIFELD6BEZEICHNUNG]:</td><td>[FREIFELD6][MSGFREIFELD6]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
<tr><td width="210">[FREIFELD7BEZEICHNUNG]:</td><td>[FREIFELD7][MSGFREIFELD7]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
<tr><td width="210">[FREIFELD8BEZEICHNUNG]:</td><td>[FREIFELD8][MSGFREIFELD8]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
<tr><td width="210">[FREIFELD9BEZEICHNUNG]:</td><td>[FREIFELD9][MSGFREIFELD9]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
<tr><td width="210">[FREIFELD10BEZEICHNUNG]:</td><td>[FREIFELD10][MSGFREIFELD10]&nbsp;</td><td>&nbsp;</td><td></td><td></td></tr>
</table></fieldset>


<fieldset><legend>Kennung (f&uuml;r vereinfachte Imports f&uuml;r Zeitferfassungen, Artikel-Imports, etc.)</legend>
<table>
<tr><td width="210">Eindeutige Kennung:</td><td>[KENNUNG][MSGKENNUNG]&nbsp;<i>(Grossbuchstaben, keine Sonderzeichen)</i></td>
<td>&nbsp;</td>
<td></td><td></td></tr>
</table></fieldset>

<fieldset><legend>Logbuch</legend>
<table>
<tr valign="top"><td width="210">Eintr&auml;ge:</td><td>[LOGFILE]</td>
</tr>
</table></fieldset>
</td></tr>


   <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit"
    value="Speichern" onclick="this.form.action += '#tabs-5';"/> <input type="button" value="Abbrechen" /></td>
    </tr>
  
    </tbody>
  </table>
</form>
</div>


</div>

