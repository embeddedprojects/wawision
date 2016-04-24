[SAVEPAGEREALLY]
<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Angebot</a></li>
        <li><a href="#tabs-2" onclick="callCursor();">Positionen</a></li>
       <li><a href="index.php?module=angebot&action=inlinepdf&id=[ID]&frame=true#tabs-3">Vorschau</a></li>
      [FURTHERTABS]
    </ul>





<div id="tabs-1">
[MESSAGE]
<form action="" method="post" name="eprooform" id="eprooform">
[LIEFERID][MSGLIEFERID]
[ANSPRECHPARTNERID][MSGANSPRECHPARTNERID]
[FORMHANDLEREVENT]

<center>
<!-- // rate anfang -->
<table width="100%" cellpadding="0" cellspacing="5" border="0" align="center">
<tr><td>


<!-- // ende anfang -->
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr> 
<td width="33%">[STATUSICONS]</td>
<td align="center"><b style="font-size: 14pt">[BEZEICHNUNGTITEL] <font color="blue">[NUMMER]</font></b>[KUNDE][RABATTANZEIGE]</td> 
<td width="33%" align="right">[ICONMENU]&nbsp;[SAVEBUTTON]</td> 
</tr>
</table>
<div style="height:5px"></div>

<table width="100%" style="background-color:#ECECEC;" cellspacing="3">
  <tr><td width="230"><legend>Kunde</legend></td><td nowrap width="300">[KUNDEAUTOSTART][ADRESSE][MSGADRESSE][KUNDEAUTOEND]&nbsp;
[BUTTON_UEBERNEHMEN]
</td><td></td><td width="200">Aktionscode: </td><td width="200">[AKTIONAUTOSTART][AKTION][MSGAKTION][AKTIONAUTOEND]</td></tr>
</table>

<div style="height:10px"></div>

<table width="100%" cellspacing="0" cellpadding="0"><tr valign="top"><td width="50%">
<fieldset><legend>Allgemein</legend>
<table width="100%" height="280">
  <tr><td width="200">Projekt:</td><td>[PROJEKTAUTOSTART][PROJEKT][MSGPROJEKT][PROJEKTAUTOEND]</td></tr>
  <tr><td>Status:</td><td>[STATUS]</td></tr>
  <tr><td>Ihre Anfrage:</td><td>[ANFRAGE][MSGANFRAGE]</td></tr>
  <tr><td>Datum:</td><td>[DATUM][MSGDATUM]</td></tr>
	<tr><td>Liefertermin:</td><td>[LIEFERDATUM][MSGLIEFERDATUM]&nbsp;[LIEFERDATUMKW][MSGLIEFERDATUMKW]&nbsp;KW</td></tr>
	<tr><td>Angebot g&uuml;ltig bis:</td><td>[GUELTIGBIS][MSGGUELTIGBIS]</td></tr>
  <tr><td>Abweichende Lieferadresse:</td><td>[ABWEICHENDELIEFERADRESSE][MSGABWEICHENDELIEFERADRESSE]</td></tr>
  <tr><td>Schreibschutz:</td><td>[SCHREIBSCHUTZ][MSGSCHREIBSCHUTZ]&nbsp;</td></tr>
  <tr><td>Abweichende Bezeichnung:</td><td>[ABWEICHENDEBEZEICHNUNG][MSGABWEICHENDEBEZEICHNUNG]&nbsp;</td></tr>

</table>
</fieldset>



</td><td>

<div style="display:[ABWEICHENDELIEFERADRESSESTYLE];" id="abweichendelieferadressestyle">
<fieldset><legend>Abweichende Lieferadresse</legend>
   <table height="280" style="background-color:#c2e3ea;">
          <tr><td width="200">Name:</td><td>[LIEFERNAME][MSGLIEFERNAME]</td></tr>
          <tr><td>Ansprechpartner:</td><td>[LIEFERANSPRECHPARTNER][MSGLIEFERANSPRECHPARTNER]</td></tr>
          <tr><td>Abteilung:</td><td>[LIEFERABTEILUNG][MSGLIEFERABTEILUNG]</td></tr>
          <tr><td>Unterabteilung:</td><td>[LIEFERUNTERABTEILUNG][MSGLIEFERUNTERABTEILUNG]</td></tr>
          <tr><td>Adresszusatz:</td><td>[LIEFERADRESSZUSATZ][MSGLIEFERADRESSZUSATZ]</td></tr>
          <tr><td>Stra&szlig;e</td><td>[LIEFERSTRASSE][MSGLIEFERSTRASSE]</td><td>&nbsp;</td></tr>
          <tr><td>PLZ/Ort</td><td>[LIEFERPLZ][MSGLIEFERPLZ]&nbsp;[LIEFERORT][MSGLIEFERORT]</td>
          </tr>
          <tr><td>Land:</td><td>[EPROO_SELECT_LIEFERLAND]</td>
          </tr>
         <tr><td></td><td>[LIEFERADRESSEPOPUP]&nbsp;[ANSPRECHPARTNERLIEFERADRESSEPOPUP]</td></tr>
</table>
</fieldset>
</div>


</td></tr></table>

<!--
<table width="100%"><tr><td>
<fieldset><legend>Positionen</legend>
[POSITIONEN]
</fieldset>
</td></tr></table>
-->


<table width="100%"><tr valign="top"><td width="70%">
<fieldset><legend>Stammdaten</legend>
  <table align="center" border="0" width="100%">
          <tr><td width="200">Anrede:</td><td width="200">[TYP][MSGTYP]</td>
          <td width="20">&nbsp;</td>
            <td width="200"></td><td></td></tr>
          <tr><td>Name:</td><td>[NAME][MSGNAME]</td>
          <td>&nbsp;</td>
            <td>Telefon:</td><td>[TELEFON][MSGTELEFON]</td></tr>
          <tr><td>Ansprechpartner:</td><td>[ANSPRECHPARTNER][MSGANSPRECHPARTNER]</td>
          <td>&nbsp;</td>
            <td>Telefax:</td><td>[TELEFAX][MSGTELEFAX]</td></tr>
          <tr><td>Abteilung:</td><td>[ABTEILUNG][MSGABTEILUNG]</td><td>&nbsp;</td>
          <td>E-Mail:</td><td>[EMAIL][MSGEMAIL]</td></tr>
          <tr><td>Unterabteilung:</td><td>[UNTERABTEILUNG][MSGUNTERABTEILUNG]</td><td>&nbsp;</td>
           <td>Anschreiben</td><td>[ANSCHREIBEN][MSGANSCHREIBEN]</td></tr>
          <tr><td>Adresszusatz:</td><td>[ADRESSZUSATZ][MSGADRESSZUSATZ]</td><td>&nbsp;</td>
           <td></td><td></td></tr>
          <tr><td>Stra&szlig;e</td><td>[STRASSE][MSGSTRASSE]</td><td>&nbsp;</td>
            <td></td><td>[ANSPRECHPARTNERPOPUP]
            </td></tr>
          <tr><td>PLZ/Ort</td><td>[PLZ][MSGPLZ]&nbsp;[ORT][MSGORT]</td><td>&nbsp;</td>
            <td></td><td></td></tr>

          <tr><td>Land:</td><td colspan="3">[EPROO_SELECT_LAND]</td>
          </tr>
</table>
</fieldset>
</td><td>[INFOFUERAUFTRAGSERFASSUNG]</td></tr></table>

<table width="100%"><tr><td>
<fieldset><legend>Freitext</legend>
[FREITEXT][MSGFREITEXT]

</fieldset>
</td></tr></table>


<table width="100%"><tr valign="top"><td width="50%">


<fieldset><legend>Angebot</legend>
<table width="100%">

<tr><td>Zahlungsweise:</td><td>[ZAHLUNGSWEISE][MSGZAHLUNGSWEISE]</td></tr>
<tr><td width="200">Versandart:</td><td>[VERSANDART][MSGVERSANDART]</td></tr>

<tr><td>Vertrieb:</td><td>[VERTRIEB][MSGVERTRIEB]</td></tr>
<tr><td>Bearbeiter:</td><td>[BEARBEITER][MSGBEARBEITER]</td></tr>

<!--<tr><td>Auto-Versand:</td><td>[AUTOVERSAND][MSGAUTOVERSAND]-->
<tr><td>Kein Porto:</td><td>[KEINPORTO][MSGKEINPORTO]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Kein Briefpapier:&nbsp;[OHNE_BRIEFPAPIER][MSGOHNE_BRIEFPAPIER]</td></tr>
</table>
</fieldset>


</td><td>

  <script type="text/javascript"><!--

        function aktion_buchen(cmd)
        {
          document.getElementById('rechnung').style.display="none";
          document.getElementById('kreditkarte').style.display="none";
          document.getElementById('einzugsermaechtigung').style.display="none";
          document.getElementById('paypal').style.display="none";
          document.getElementById(cmd).style.display="";

        }

       function versand(cmd)
        {
          document.getElementById('packstation').style.display="none";
          document.getElementById(cmd).style.display="";
        }

	function abweichend(cmd)
        {
          document.getElementById('abweichendelieferadressestyle').style.display="none";
	  if(document.getElementById('abweichendelieferadresse').checked)
	    document.getElementById('abweichendelieferadressestyle').style.display="";
        }



      //-->
     </script>



<div id="rechnung" style="display:[RECHNUNG]">
<fieldset><legend>Rechnung</legend>
<table width="100%">
<tr><td width="200">Zahlungsziel (in Tagen):</td><td>[ZAHLUNGSZIELTAGE][MSGZAHLUNGSZIELTAGE]</td></tr>
<tr><td nowrap> Skonto (in Tagen):</td><td>[ZAHLUNGSZIELTAGESKONTO][MSGZAHLUNGSZIELTAGESKONTO]</td></tr>
</table>
</fieldset>
</div>

<div style="display:[EINZUGSERMAECHTIGUNG]" id="einzugsermaechtigung">
<fieldset><legend>Einzugserm&auml;chtigung</legend>
<table width="100%">
<tr><td width="150">Inhaber:</td><td>[BANK_INHABER][MSGBANK_INHABER]</td></tr>
<tr><td>Institut:</td><td>[BANK_INSTITUT][MSGBANK_INSTITUT]</td></tr>
<tr><td>BLZ:</td><td>[BANK_BLZ][MSGBANK_BLZ]</td></tr>
<tr><td>Konto:</td><td>[BANK_KONTO][MSGBANK_KONTO]</td></tr>
</table>
</fieldset>
</div>

<div style="display:[PAYPAL]" id="paypal">
</div>

<div style="display:[KREDITKARTE]" id="kreditkarte">
<fieldset><legend>Kreditkarte</legend>
 <table>
        <tr><td width="150">Kreditkarte:</td><td>[KREDITKARTE_TYP][MSGKREDITKARTE_TYP]</td>
        </tr>
        <tr><td>Karteninhaber:</td><td>[KREDITKARTE_INHABER][MSGKREDITKARTE_INHABER]</td>
	</tr>
        <tr><td>Kreditkartennummer:</td><td>[KREDITKARTE_NUMMER][MSGKREDITKARTE_NUMMER]</td>
	</tr>
        <tr><td>Pr&uuml;fnummer:</td><td>[KREDITKARTE_PRUEFNUMMER][MSGKREDITKARTE_PRUEFNUMMER]</td>
        </tr>
        <tr><td>G&uuml;ltig bis:</td><td>
        [KREDITKARTE_MONAT][MSGKREDITKARTE_MONAT]&nbsp;
        [KREDITKARTE_JAHR][MSGKREDITKARTE_JAHR]&nbsp;
        </td>
        </tr>
        </table>

</fieldset>
</div>

<div><fieldset><legend>Skonto (nur bei Rechnung und Lastschrift)</legend>
<table width="100%"><tr><td width="200">Skonto:</td><td>[ZAHLUNGSZIELSKONTO][MSGZAHLUNGSZIELSKONTO]</td></tr>
</table>
</fieldset>
</div>

[STARTDISABLEVERBAND]
<div style="">
<fieldset><legend>Verband</legend>
<table width="100%">
[VERBANDINFOSTART]<tr><td>Verband / Gruppe:</td><td colspan="6">[VERBAND]</td></tr>[VERBANDINFOENDE]<tr><td>Rabatt:</td><td>Grund %</td><td>1 in %</td><td>2 in %</td><td>3 in %</td><td>4 in %</td><td>5 in %</td></tr>
<tr><td></td>
 <td>[RABATT][MSGRABATT]</td>
    <td>[RABATT1][MSGRABATT1]</td>
    <td>[RABATT2][MSGRABATT2]</td>
    <td>[RABATT3][MSGRABATT3]</td>
    <td>[RABATT4][MSGRABATT4]</td>
    <td>[RABATT5][MSGRABATT5]</td>
  </tr>
<tr><td colspan="7">Information:<br>[VERBANDINFO]</td></tr>
</table>
</fieldset>
</div>
[ENDEDISABLEVERBAND]


</td></tr></table>
<table width="100%"><tr><td>
<fieldset><legend>Interne Bemerkung</legend>
[INTERNEBEMERKUNG][MSGINTERNEBEMERKUNG]
</fieldset>
</td></tr></table>

<table width="100%"><tr><td>
<fieldset><legend>UST-Pr&uuml;fung</legend>
<table width="100%">
<tr><td width="200">UST ID:</td><td>[USTID][MSGUSTID]</td></tr>
<tr><td>Besteuerung:</td><td>[UST_BEFREIT][MSGUST_BEFREIT]&nbsp;[KEINSTEUERSATZ][MSGKEINSTEUERSATZ]&nbsp;ohne gesetzlichen Hinweistext bei EU oder Export</td></tr>
</table>
</fieldset>
</td></tr></table>

</center>


</td>
</table>

<br><br>
<table width="100%">
<tr><td align="right">
    <input type="submit" name="speichern" value="Speichern" />
</td></tr></table>
</div>

<div id="tabs-2">

<center>
<!-- // rate anfang -->
<table width="100%" cellpadding="0" cellspacing="5" border="0" align="center">
<tr><td>


<!-- // ende anfang -->
<table width="100%" style="" align="center">
<tr> 
<td width="33%"></td> 
<td align="center"><b style="font-size: 14pt">Angebot <font color="blue">[NUMMER]</font></b>[KUNDE][RABATTANZEIGE]</td> 
<td width="33%" align="right">[ICONMENU2]</td> 
</tr>
</table>

[POS]


</td></tr></table>
</center>




</div>

<div id="tabs-3">
</div>

      [FURTHERTABSDIV]


</form>

 <!-- tab view schließen -->
</div>

