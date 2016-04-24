<div id="tabs">
    <ul>
        <li><a href="#tabs-1"></a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">

<table width="100%">
<tr>

<td width="25%">
<fieldset style="height:95px"><legend>Funktionstest durchf&uuml;hren</legend>
<br>
<center>Seriennummer:&nbsp;<form id="frmproduktionfunktionstest" action="" method="post"><input type="hidden" id="produktionfunktionstestid" name="produktionfunktionstestid" /><input type="text" [FUNKTIONSTESTDEAKTIVIERT] id="produktionfunktionstest" name="produktionfunktionstest" size="30"></form></center>
</fielset>
</td>


<td width="25%">
</td>

<td width="25%">
<fieldset style="height:95px"><legend>Neue Seriennummer anlegen</legend>
<br>
<center>Seriennummer:&nbsp;<form action="" method="post"><input type="hidden" id="produktionseriennummerid" name="produktionseriennummerid" /><input type="text" id="produktionseriennummer" name="produktionseriennummer" size="20"></form>&nbsp;<input type="button" id="seriennummerngenerieren" value="manuell" /></center>
</fielset>
[MESSAGENEUESERIENNUMMER]
</td>

<td width="25%">
<fieldset style="height:95px"><legend>Drucken</legend>
<input type="button" onclick="window.location.href='index.php?module=produktion&action=pdf&id=[ID]'" value="Produktionsanweisung als PDF" style="width:300px"><br>
<input type="button" onclick="window.location.href='index.php?module=produktion&action=pdfanhang&id=[ID]'" value="Anh&auml;nge als PDF" style="width:300px"><br>
<input type="button" onclick="window.location.href='index.php?module=produktion&action=alleetiketten&id=[ID]&cmd=produktionszentrum'" value="Etikettensets f&uuml;r alle Baugruppen" style="width:300px">
<!--<input type="button" onclick="window.location.href='index.php?module=produktion&action=pdf&id=[ID]'" value="Alle Seriennummernaufkleber drucken" style="width:150px"><br>-->
</td>



</tr></table>
<table height="80" width="100%"><tr><td>
<fieldset><legend>&nbsp;Filter</legend>
<center>
<table width="100%" cellspacing="5">
<tr>
  <td><input type="checkbox" id="fehlendehauptseriennummern">&nbsp;fehlende Hauptseriennummern</td>
  <td><input type="checkbox" id="fehlendeunterseriennummern">&nbsp;fehlende Unterseriennummern</td>
  <td><input type="checkbox" id="ohnefunktionstest">&nbsp;ohne Funktionstest</td>
  <td><input type="checkbox" id="negativerfuntkionstest">&nbsp;negativer Funktionstest</td>
  <td><input type="checkbox" id="positiverfunktionstest">&nbsp;positiver Funktionstest</td>
  <td><input type="checkbox" id="laufenderfunktionstest">laufender Funktionstest</td>
</tr></table>
</center>
</fieldset>
</td></tr></table>
[MESSAGE]
<div id="ajaxmessage"></div>
[TAB1]
</div>


<!-- tab view schließen -->
</div>
<!-- ende tab view schließen -->
<script type="text/javascript">

function refreshpzlivetable()
{
  $('#produktionszentrum_erfassen_filter').find('input').each(function(){
    var old = $(this).val();
    $(this).val(old+' ');
    $(this).trigger('keyup');
    
  });
}

function editUnterseriennummer(id)
{
    alert('deaktiviert');
}

function doFunktionstest(id)
{
  if(!$('#produktionfunktionstest').hasClass('disabled'))
  {
    $('#produktionfunktionstest').val('');
    $('#produktionfunktionstestid').val(id);
    $('#frmproduktionfunktionstest').submit();

  } else {
    alert('deaktiviert');
  }
}

function setzeAusschuss(id)
{
  $.ajax({
    url: "index.php?module=produktionszentrum&action=setzeausschuss&id="+id,
    type: 'POST',
    dataType: 'json',
    data: {
    }}).done( function(data) {
      if (typeof data == 'undefined' || data == null || typeof data.status == 'undefined' || data.status == 0)
      {
        $('#ajaxmessage').html('<div class="error">Fehler beim Laden. '+(typeof data != 'undefined' && data != null && typeof data.fehler != 'undefined'?data.fehler:'')+'</div>');
      } else {
        refreshpzlivetable();
      }
    }).fail( function( jqXHR, textStatus ) {
      $('#ajaxmessage').html('<div class="error">Fehler beim Laden!'+ textStatus+'</div>');
    
   });
}

function editSeriennummer(id)
{
  $.ajax({
    url: "index.php?module=produktionszentrum&action=getseriennummer&id="+id,
    type: 'POST',
    dataType: 'json',
    data: {
    }}).done( function(data) {
      if (typeof data == 'undefined' || data == null || typeof data.status == 'undefined' || data.status == 0)
      {
        $('#ajaxmessage').html('<div class="error">Fehler beim Laden. '+(typeof data != 'undefined' && data != null && typeof data.fehler != 'undefined'?data.fehler:'')+'</div>');
      } else {
        $('#baugruppeid').val(id);
        $('#diaseriennumer').val(data.seriennummer);
        jQuery('#seriennummeraendern').dialog({
				title: 'Seriennummer ändern',
				width: 600
			});
      }
    }).fail( function( jqXHR, textStatus ) {
      $('#ajaxmessage').html('<div class="error">Fehler beim Laden!'+ textStatus+'</div>');
    
   });

}

function editKommentar(id)
{
  $.ajax({
    url: "index.php?module=produktionszentrum&action=getkommentar&id="+id,
    type: 'POST',
    dataType: 'json',
    data: {
    }}).done( function(data) {
      if (typeof data == 'undefined' || data == null || typeof data.status == 'undefined' || data.status == 0)
      {
        $('#ajaxmessage').html('<div class="error">Fehler beim Laden. '+(typeof data != 'undefined' && data != null && typeof data.fehler != 'undefined'?data.fehler:'')+'</div>');
      } else {
        $('#kommentarbaugruppeid').val(id);
        $('#diakommentar').val(data.kommentar);
        jQuery('#kommentaraendern').dialog({
				title: 'Seriennummer ändern',
				width: 600
			});
      }
    }).fail( function( jqXHR, textStatus ) {
      $('#ajaxmessage').html('<div class="error">Fehler beim Laden!'+ textStatus+'</div>');
    
   });
}


$(document).ready(function() {
  $('#seriennummerngenerieren').on('click',function(){
    $('#seriennummerndiaglog').dialog({
				title: 'Seriennummer generieren',
				width: 600
			});
  });
  
  /*
  $('div.dataTables_filter input').focus();
  $('div.dataTables_filter input').val("");
  $('div.dataTables_filter input').submit();
  */
  //$('#produktion').focus();
});
</script>
<div id="seriennummerndiaglog" style="display:none;">
  <form method="POST">
    <table>
      <tr><td>Seriennummer von:</td><td><input type="text" name="seriennummervon" value="1" /></td></tr>
      <tr><td></td><td><input type="submit" name="seriennummergeneratorsubmit" value="Generieren" /></td></tr>
    </table>
  </form>
</div>
<div id="seriennummeraendern" style="display:none;">
  <form method="POST">
    <table>
      <tr><td>Seriennummer</td><td><input type="hidden" name="baugruppeid" value="" id="baugruppeid" /><input type="text" id="diaseriennumer" name="seriennummer" value="1" size="40"/>
      &nbsp;<input type="submit" name="seriennummereditsubmit" value="&Auml;ndern" /></td></tr>
    </table>
  </form>
</div>
<div id="kommentaraendern" style="display:none;">
  <form method="POST">
    <table>
      <tr><td>Kommentar</td><td><input type="hidden" name="baugruppeid" value="" id="kommentarbaugruppeid" /><input type="text" size="40" id="diakommentar" name="kommentar" value="1" />&nbsp;
      <input type="submit" name="kommentareditsubmit" value="&Auml;ndern" /></td></tr>
    </table>
  </form>
</div>
[DIVFUNKTIONSTEST]
[DIVUNTERSERIENNUMMERN]
