<div id="tabs">
    <ul>
        <li><a href="#tabs-1">[TABTEXT]</a></li>
    </ul>
<div id="tabs-1">
[NEUMESSAGE]
<form action="" method="POST" name="eprooform">
[FORMHANDLEREVENT]
  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr valign="top" colspan="3">
        <td >
          <fieldset><legend>Wiedervorlage</legend>
            <table width="100%">
                  <tr><td width="100">Datum:</td><td width="100"><input type="hidden" id="datum_angelegt" name="datum_angelegt" size="10" value="[DATUM_ANGELEGT]" />[DATUM_ANGELEGT] [MSGDATUM_ANGELEGT]</td><td width="50">Zeit:</td><td><input type="hidden" id="zeit_angelegt" name="zeit_angelegt" size="10" value="[ZEIT_ANGELEGT]" />[ZEIT_ANGELEGT] [MSGZEIT_ANGELEGT]</td></tr>
                  <tr><td width="">Bezeichnung:</td><td colspan="3"><input type="text" name="bezeichnung" value="[BEZEICHNUNG]" size="50" style="width:320px;" /> [MSGBEZEICHNUNG]</td></tr>
                  <tr><td width="">Bearbeiter:</td><td colspan="3"><input type="text" id="bearbeiter" name="bearbeiter" style="width:320px;"  size="50" value="[BEARBEITER]" /> [MSGBEARBEITER]</td></tr>
                  <tr><td width="">f&uuml;r Kunde:</td><td colspan="3"><input type="text" id="adresse" name="adresse" style="width:320px;"  size="50" value="[ADRESSE]" /> [MSGADRESSE]</td></tr>
                  <tr><td>Beschreibung:</td><td colspan="3"><textarea name="beschreibung" rows="5" style="width:320px;">[BESCHREIBUNG]</textarea>[MSGBESCHREIBUNG]</td></tr>
                  <tr><td colspan="4">Wiedervorlage:</td></tr>
                  <tr><td width="">Datum:</td><td><input type="text" name="datum_erinnerung" id="datum_erinnerung" size="10" value="[DATUM_ERINNERUNG]"/> [MSGDATUM_ERINNERUNG]</td><td width="">Zeit:</td><td><input type="text" id="zeit_erinnerung" name="zeit_erinnerung" size="10" value="[ZEIT_ERINNERUNG]" /> [MSGZEIT_ERINNERUNG]</td></tr>
                  <tr><td width="">Melden bei Mitarbeiter:</td><td colspan="3"><input type="text"  size="50" id="adresse_mitarbeiter" name="adresse_mitarbeiter" style="width:320px;" value="[ADRESSE_MITARBEITER]" /> [MSGADRESSE_MITARBEITER]</td></tr>
                  <tr><td width="200">abgeschlossen:</td><td colspan="3"><input type="checkbox" name="abgeschlossen" value="1" [ABGESCHLOSSEN] />[MSGABGESCHLOSSEN]</td></tr>
            </table>
          </fieldset>
        </td>
      </tr>
    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="hidden" name="save" value="1" /><input type="submit" value="Speichern" />
    </tr>
    </tbody>
  </table>
</form>
<script type="text/javascript">
$(document).ready(function() {
  $( "#datum_angelegt" ).datepicker({ dateFormat: "dd.mm.yy" });
  $( "#zeit_angelegt" ).timepicker();
  $( "#datum_erinnerung" ).datepicker({ dateFormat: "dd.mm.yy" });
  $( "#zeit_erinnerung" ).timepicker();
      $( "#adresse_mitarbeiter" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=mitarbeiter"
});
    $( "#bearbeiter" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=mitarbeiter"
});
    $( "#adresse" ).autocomplete({
source: "index.php?module=ajax&action=filter&filtername=kunde"
});
});
</script>
</div>

<!-- tab view schließen -->
</div>
