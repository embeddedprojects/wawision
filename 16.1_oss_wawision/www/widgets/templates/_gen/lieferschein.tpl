 <script type="text/javascript"><!--

$(document).ready(function(){
		lieferantenretoureanzeige(0);
  });


  	function lieferantenretoureanzeige(cmd)
     {
    if(document.getElementById('lieferantenretoure').checked)
		{
      document.getElementById('kundestyle').style.display="none";
      document.getElementById('lieferantenretourestyle').style.display="";
		} else {

      document.getElementById('lieferantenretourestyle').style.display="none";
      document.getElementById('kundestyle').style.display="";
		}
        }
      //-->
     </script>

[SAVEPAGEREALLY]

<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-2">Lieferschein</a></li>
        <li><a href="#tabs-4" onclick="callCursor();">Positionen</a></li>
       <li><a href="index.php?module=lieferschein&action=inlinepdf&id=[ID]&frame=true#tabs-3">Vorschau</a></li>
      [FURTHERTABS]

    </ul>


<div id="tabs-2">
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
<td width="33%"></td>
<td align="center"><b style="font-size: 14pt">Lieferschein <font color="blue">[NUMMER]</font></b>[KUNDE]</td>
<td width="33%" align="right" nowrap>[ICONMENU]&nbsp;[SAVEBUTTON]</td>
</tr>
</table>

<div style="height:5px"></div>


<table width="100%" style="background-color:#ECECEC;" cellspacing="3">
  <tr id="kundestyle"><td width="150"><legend>Kunde</legend></td><td nowrap>[ADRESSE][MSGADRESSE]&nbsp;[BUTTON_UEBERNEHMEN]</td></tr>
<tr id="lieferantenretourestyle"><td width="150"><legend>Lieferant</legend></td><td nowrap>[LIEFERANT][MSGLIEFERANT]&nbsp;[BUTTON_UEBERNEHMEN2]</td></tr>
  <tr><td>an Lieferanten:</td><td nowrap>[LIEFERANTENRETOURE][MSGLIEFERANTENRETOURE]&nbsp;</td></tr>
</td></tr>
</table>

<div style="height:10px"></div>

<table width="100%" cellspacing="0" cellpadding="0"><tr valign="top"><td width="50%">


<fieldset><legend>Allgemein</legend>
<table width="100%">
  <tr><td width="150">Belegnr:</td><td>[BELEGNR][MSGBELEGNR]</td></tr>
  <tr><td>Projekt:</td><td>[PROJEKTAUTOSTART][PROJEKT][MSGPROJEKT][PROJEKTAUTOEND]</td></tr>
  <tr><td>Status:</td><td>[STATUS]</td></tr>
  <tr><td>Auftrag:</td><td>[AUFTRAGID][MSGAUFTRAGID]</td></tr>
  <tr><td>Ihre Bestellnummer:</td><td>[IHREBESTELLNUMMER][MSGIHREBESTELLNUMMER]</td></tr>

  <tr><td>Datum:</td><td>[DATUM][MSGDATUM]</td></tr>
  <tr><td>Schreibschutz:</td><td>[SCHREIBSCHUTZ][MSGSCHREIBSCHUTZ]&nbsp;</td></tr>


</table>
</fieldset>



</td><td>



</td></tr></table>

<!--
<table width="100%"><tr><td>
<fieldset><legend>Positionen</legend>
[POSITIONEN]
</fieldset>
</td></tr></table>
-->
<table width="100%"><tr><td>
<fieldset><legend>Stammdaten</legend>
  <table align="center" border="0" width="100%">
          <tr><td width="150">Anrede:</td><td width="200">[TYP][MSGTYP]</td>
          <td width="20">&nbsp;</td>
            <td width="120"></td><td></td></tr>
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
            <td></td><td>[LIEFERADRESSEPOPUP][ANSPRECHPARTNERPOPUP]
            </td></tr>
          <tr><td>PLZ/Ort</td><td>[PLZ][MSGPLZ]&nbsp;[ORT][MSGORT]</td><td>&nbsp;</td>
            <td></td><td></td></tr>

          <tr><td>Land:</td><td colspan="3">[EPROO_SELECT_LAND]</td>
          </tr>
</table>
</fieldset>
</td></tr></table>

<table width="100%"><tr><td>
<fieldset><legend>Freitext</legend>
[FREITEXT][MSGFREITEXT]
</fieldset>
</td></tr></table>


<table width="100%"><tr valign="top"><td width="50%">


<fieldset><legend>Lieferschein</legend>
<table width="100%">
<tr><td>Versandart:</td><td>[VERSANDART][MSGVERSANDART]</td></tr>

<tr><td>Vertrieb:</td><td>[VERTRIEB][MSGVERTRIEB]</td></tr>
<tr><td>Bearbeiter:</td><td>[BEARBEITER][MSGBEARBEITER]</td></tr>
<tr><td>Kein Briefpapier:</td><td>[OHNE_BRIEFPAPIER][MSGOHNE_BRIEFPAPIER]</td></tr>


</table>
</fieldset>


</td><td>




</td></tr></table>
<table width="100%"><tr><td>
<fieldset><legend>Interne Bemerkung</legend>
[INTERNEBEMERKUNG][MSGINTERNEBEMERKUNG]
</fieldset>
</td></tr></table>

</center>


</td>
</table>

<br><br>
<table width="100%">
<tr><td align="right">
    <input type="submit" name="speichern"
    value="Speichern" />
</td></tr></table>
</div>


</form>

<div id="tabs-4">

<center>
<!-- // rate anfang -->
<table width="100%" cellpadding="0" cellspacing="5" border="0" align="center" style="-moz-box-shadow: 10px 10px 5px #888;-webkit-box-shadow: 10px 10px 5px #888;box-shadow: 10px 10px 5px #888; background-color: #EFEFEF;">
<tr><td>


<!-- // ende anfang -->
<table width="100%" style="" align="center">
<tr>
<td width="33%"></td>
<td align="center"><b style="font-size: 14pt">Lieferschein <font color="blue">[NUMMER]</font></b>[KUNDE]</td>
<td width="33%" align="right">[ICONMENU2]</td>
</tr>

</table>


[POS]

</td></tr></table>
</center>




</div>

<div id="tabs-3"></div>

[FURTHERTABSDIV]

 <!-- tab view schließen -->
</div>

