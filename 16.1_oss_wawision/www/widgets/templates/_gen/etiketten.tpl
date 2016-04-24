<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs1"></a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs1">
[MESSAGE]
<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr valign="top" colspan="3">
        <td >
<fieldset><legend>Einstellung</legend>
<table><tr valign="top"><td>
    <table width="100%">
          <tr><td width="150">Name:</td><td>[NAME][MSGNAME]&nbsp;</td></tr>
          <tr><td width="150">XML:</td><td>[XML][MSGXML]</td><td></tr>
          <tr><td width="150">Bemerkung:</td><td>[BEMERKUNG][MSGBEMERKUNG]</td><td></tr>
          <tr><td width="150">Verwenden als:</td><td>[VERWENDENALS][MSGVERWENDENALS]&nbsp;
          [FORMAT][MSGFORMAT]</td></tr>

          <tr><td width="150">Etikett in mm angeben:</td><td>[MANUELL][MSGMANUELL]
                Breite:&nbsp;[LABELBREITE][MSGLABELBREITE]&nbsp;H&ouml;he:&nbsp;
                [LABELHOEHE][MSGLABELHOEHE]&nbsp;
                Abstand:&nbsp;[LABELABSTAND][MSGLABELABSTAND]&nbsp;Offset Links:&nbsp;[LABELOFFSETX][MSGLABELOFFSETX]&nbsp;
                Offset-Oben:&nbsp;[LABELOFFSETY][MSGLABELOFFSETY]
           </td><td></tr>
</table>
<br>
<table>
<tr><td width="150">Textbaustein</td><td>&lt;line x="5" y="1" size="3"&gt;Test&lt;/line&gt;</td></tr>
<tr><td width="150">Barcode</td><td>&lt;barcode x="5" y="1" size="3" type="2"&gt;Test&lt;/barcode&gt;</td></tr>
<tr><td width="150">QR-Code</td><td>&lt;qrcode x="5" y="1" size="3" type="3"&gt;Test&lt;/qrcode&gt;</td></tr>
<tr><td width="150">Artikel klein</td><td>
<br>

  <label>
&lt;label&gt;<br>
            &lt;barcode y="1" x="3" size="8" type="2"&gt;{NUMMER}&lt;/barcode&gt;<br>
            &lt;line x="3" y="10" size="3"&gt;NR {NUMMER}&lt;/line&gt;<br>
            &lt;line x="3" y="13" size="3"&gt;{NAME_DE}&lt;/line&gt;<br>
  &lt;/label&gt;
</td></tr>

<tr><td width="150">Lager klein</td><td>
<br>
&lt;label&gt;<br>
            &lt;barcode y="1" x="3" size="8" type="2"&gt;{ID}&lt;/barcode&gt;<br>
            &lt;line x="3" y="10" size="4"&gt;Lager: {KURZBEZEICHNUNG}&lt;/line&gt;<br>
            &lt;/label&gt;<br>
</td></tr>
</table>
<br><br>

</td><td>Variablen:
<br>
<ul>
<li>{ARTIKELNUMMER}</li>
<li>{SERIENNUMMER}</li>
<li>{VERKAUFSPREISBRUTTO}</li>
<li>{ARTIKEL_NAME_DE}</li>
<li>{LAGER_PLATZ_NAME}</li>
<li>{LAGER_PLATZ_ID}</li>
<li>{BELEGNR}</li>
<li>{BELEGID}</li>
<li>{BELEGART}</li>
</ul>
</td></tr></table>

</fieldset>
</td></tr>

    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" value="Speichern" name="submit"/>
    </tr>
  
    </tbody>
  </table>
</form>

</div>

<!-- tab view schließen -->
</div>


