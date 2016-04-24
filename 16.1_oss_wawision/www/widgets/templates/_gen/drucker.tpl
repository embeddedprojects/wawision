<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1"></a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]
[MESSAGE]
  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr valign="top" colspan="3">
        <td >
<fieldset><legend>Einstellungen</legend>
    <table width="100%">
          <tr><td width="200">Name / Standort:</td><td>[NAME][MSGNAME]&nbsp;<i>z.B. Hauptdrucker, Eingang, Versand, ...</i></td></tr>
          <tr><td>Bezeichnung:</td><td>[BEZEICHNUNG][MSGBEZEICHNUNG]&nbsp;<i>z.B. Brother-HL-2250DN, Online-Account 1, ...</i></td></tr>
          <tr><td>Aktiv:</td><td>[AKTIV][MSGAKTIV]</td></tr>
          <tr><td>Ger&auml;teart:</td><td>[ART][MSGART]</td></tr>
          <tr><td>Format:</td><td>[FORMAT][MSGFORMAT]</td></tr>
</table>
</fieldset>
<fieldset><legend>Anbindung</legend>
    <table width="100%">

          <tr><td width="200">Anbindung:</td><td>[ANBINDUNG][MSGANBINDUNG]</td></tr>
	</table>
</fieldset>
<fieldset><legend>Kommandozeilenbefehl / PDF in Verzeichnis</legend>
    <table width="100%">
 		
          <tr><td width="200"> Kommandozeilenbefehl / <br>PDF in Verzeichnis:</td><td>
				<ul>
					<li><i>Bei Kommandozeilenbefehl z.B. CUPS: lpr -H 192.168.0.152 -P Brother-HL-2250DN-series</i></li>	
					<li><i>PDF zu Verzeichnis z.B. /var/www/userdata/drucker</i></li>	
				</ul>
					</td></tr>
          <tr><td>Befehl oder Verzeichnis:</td><td>[BEFEHL][MSGBEFEHL]</td></tr>

	</table>
</fieldset>
<fieldset><legend>E-Mail</legend>
    <table width="100%">
 
          <tr><td width="200">E-Mail Versand:</td><td><i>z.B. Versand an E-Mail Account zum gesammelten Drucken</i></td></tr>
          <tr><td>E-Mail Drucker Empf&auml;nger:</td><td>[TOMAIL][MSGTOMAIL]</td></tr>
          <tr><td>E-Mail Drucker Betreff:</td><td>[TOMAILSUBJECT][MSGTOMAILSUBJECT]</td></tr>
          <tr><td>E-Mail Drucker Text:</td><td>[TOMAILTEXT][MSGTOMAILTEXT]</td></tr>
	</table>
</fieldset>
<fieldset><legend>Adapterbox</legend>
    <table width="100%">
          <tr><td width="200">Seriennummer:</td><td>[ADAPTERBOXSERIENNUMMER][MSGADAPTERBOXSERIENNUMMER]</td></tr>
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


