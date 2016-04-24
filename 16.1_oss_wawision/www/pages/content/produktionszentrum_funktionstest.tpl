<div id="divfunktionstest" style="display:none;">
<table><tr><td><form method="POST">
<input type="hidden" name="step" value="[FTSTEP]" /><input type="hidden" value="[FTSERIENNUMMER]" name="produktionfunktionstest" />
<input type="hidden" value="[PRODUKTIONFUNKTIONSTESTID]" name="produktionfunktionstestid" />
<table>
<tr><td>[MESSAGEFUNKTIONSTEST]</td></tr>
<tr><td>[FTNAME]</td></tr>
<tr><td>[FTBESCHREIBUNG]</td></tr>
<tr><td>[FTBILD]</td></tr>
[FUNKTIONSTESTEINGABE1]
[FUNKTIONSTESTEINGABE2]
[FUNKTIONSTESTKLASSEN]
[FUNKTIONSTEST]
</table>
</form>
</td></tr></table>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $('#divfunktionstest').dialog({
          modal: true,
          minWidth: 940,
          title:'Funktionstest [FTSERIENNUMMER] Schritt [FTSTEP]',
          close: function(event, ui){
            $('#produktionfunktionstest').focus();
          }
  });
});
</script>
