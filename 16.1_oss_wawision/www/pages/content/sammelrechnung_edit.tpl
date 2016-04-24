<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">[TABTEXT]</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
<div id="ajaxmessage"></div>
[MESSAGE]
<table border="0" width="100%" cellpadding="0" cellspacing="0"><tr><td>
<table width="100%" align="center" style="background-color:#cfcfd1;">
<tr>
<td width="33%"></td>
<td align="center" nowrap><b style="font-size: 14pt">Adresse <font color="blue">[KUNDE]</font></b> Kunde: [KUNDENNUMMER]</td>
<td width="33%" align="right">&nbsp;</td>
</tr>
</table>
<div style="height:10px"></div>

</td></tr></table>
[TAB1]
<form method="POST">
<fieldset>
<table>
<tr><td><input type="radio" name="ld" checked="checked" value="ls" /></td><td>Lieferdatum aus Lieferscheinpositionen</td></tr>
<tr><td><input type="radio" name="ld" value="af" /></td><td>Lieferdatum aus Auftragspositionen</td></tr>
<tr><td></td><td><input type="submit" name="speichern" value="Rechung Erstellen"></td></tr>
</table>
</fieldset>
</form>
[TAB1NEXT]
<form method="POST">



</form>
<script>

function chcb(id)
{
  setTimeout(function() {
  var v = $('#cb_'+id).is(':checked');
  if(v == false)v = 0;
  $.ajax({
    url: 'index.php?module=sammelrechnung&action=chcb',
    type: 'POST',
    dataType: 'json',
    data: { lid: id, wert:v,adresse:[ID] },
    success: function(data) {
      if(data == null)
      {
        $('#ajaxmessage').html('<div class="error">Fehlende Rechte: Wert konnte nicht gesetzt werden!</div>');
      } else
      {
        if(typeof data.status == null)
        {
          $('#ajaxmessage').html('<div class="error">Fehler beim Setzen!</div>');
        } else {
          if(data.status != 1)$('#ajaxmessage').html('<div class="error">Fehler beim Setzen</div>');
        }
      }
    },
    error: function() {
      $('#ajaxmessage').html('<div class="error">Fehlende Rechte: Wert konnte nicht gesetzt werden!</div>');
      }
  });  
  },500);
}
function chmenge(id)
{
  var v = $('#auswahl_'+id).val();
  $.ajax({
    url: 'index.php?module=sammelrechnung&action=chmenge',
    type: 'POST',
    dataType: 'json',
    data: { lid: id, wert:v,adresse:[ID] },
    success: function(data) {
      if(data == null)
      {
        $('#ajaxmessage').html('<div class="error">Fehlende Rechte: Wert konnte nicht gesetzt werden!</div>');
      } else{
        if(typeof data.status == null)
        {
          $('#ajaxmessage').html('<div class="error">Fehler beim Setzen!</div>');
        } else {
          if(data.status != 1)$('#ajaxmessage').html('<div class="error">Fehler beim Setzen</div>');
        }
      }
    },
    error: function() {
      $('#ajaxmessage').html('<div class="error">Fehlende Rechte: Wert konnte nicht gesetzt werden!</div>');
      }
  }); 
}

</script>
</div>

<!-- tab view schließen -->
</div>

