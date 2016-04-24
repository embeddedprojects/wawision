<form action="" enctype="multipart/form-data" method="POST" name="brief_erstellen_form" class="brief_erstellen_form" id="brief_erstellen_form">

	<input type="hidden" name="type" value="email">
	<input type="hidden" name="eintragId" value="[EINTRAGID]">

	<table width="495">
		<tr>
			<td width="100">Von:</td>
			<td><select name="von">[EMAIL_SENDER]</select></td>
		</tr>
		<tr>
			<td>An:</td>
			<td><input type="text" name="email_an" value="[EMAIL_AN]" style="width: 370px;" id="an"></td>
		</tr>
		<tr>
			<td>CC:</td>
			<td><input type="text" name="email_cc" value="[EMAIL_CC]" style="width: 370px;" id="cc"></td>
		</tr>
		<tr>
			<td>BCC:</td>
			<td><input type="text" name="email_bcc" value="[EMAIL_BCC]" style="width: 370px;" id="bcc"></td>
		</tr>
        <tr>
        	<td colspan="3"><br></td>
        </tr>
		<tr>
			<td>Betreff:</td>
			<td><input type="text" name="betreff" value="[BETREFF]" style="width: 370px;"></td>
		</tr>
		<tr>
			<td>Text:</td>
			<td><textarea name="content" style="width: 370px; min-height: 180px;">[CONTENT]</textarea><br><i>(Signatur für E-Mail wird automatisch angehängt)</i></td>
		</tr>
			[ANHAENGEHERAUFLADEN]

        <tr>
        	<td colspan="3"><br></td>
        </tr>
	
		<tr valign="top">
			<td>Anh&auml;nge:</td>
			<td><table width="100%" class="mkTable" cellpadding="0" cellspacing="0"><tr><th width="20"></th><th>Datei</th><th width=20></th></tr>[ANHAENGE]</table></td>
		</tr>
        <tr>
        	<td colspan="3"><br></td>
        </tr>
	
	</table>
	<table width="495">
		<tr>
			<td>
				<input type="submit" name="save" value="Speichern" id="save"/>
				<input type="submit" name="send" value="Absenden" class="brief_email_send">
				<input type="button" onclick="briefDrucken([EINTRAGID]);" value="Vorschau-Druck">
			</td>
			<td align="right">
				<input type="button" name="close" value="Schließen" class="anlegen_close">
			</td>
		</tr>
	</table>

</form>

<script type="text/javascript">

$('#file').change(function() {
  $('input[type=submit]#save').click();
});

$( "#an" ).autocomplete({
	source: "index.php?module=ajax&action=filter&filtername=emailname",
	select: function( event, ui ) {
		var i = $( "#an" ).val()+ui.item.value;
		var zahl = i.indexOf(",");
		var text = i.slice(0, zahl);
		if(zahl <=0) {
			$( "#an" ).val( ui.item.value );
		} else {
			var j = $( "#an" ).val();
			var zahlletzte = j.lastIndexOf(",");
			var text2 = j.substring(0,zahlletzte); 
			$( "#an" ).val( text2 + "," + ui.item.value );
		}
		return false;
	}
});

$( "#cc" ).autocomplete({
	source: "index.php?module=ajax&action=filter&filtername=emailname",
	select: function( event, ui ) {
		var i = $( "#cc" ).val()+ui.item.value;
		var zahl = i.indexOf(",");
		var text = i.slice(0, zahl);
		if(zahl <=0) {
			$( "#cc" ).val( ui.item.value );
		} else {
			var j = $( "#cc" ).val();
			var zahlletzte = j.lastIndexOf(",");
			var text2 = j.substring(0,zahlletzte); 
			$( "#cc" ).val( text2 + "," + ui.item.value );
		}
		return false;
	}
});

$( "#bcc" ).autocomplete({
	source: "index.php?module=ajax&action=filter&filtername=emailname",
	select: function( event, ui ) {
		var i = $( "#bcc" ).val()+ui.item.value;
		var zahl = i.indexOf(",");
		var text = i.slice(0, zahl);
		if(zahl <=0) {
			$( "#bcc" ).val( ui.item.value );
		} else {
			var j = $( "#bcc" ).val();
			var zahlletzte = j.lastIndexOf(",");
			var text2 = j.substring(0,zahlletzte); 
			$( "#bcc" ).val( text2 + "," + ui.item.value );
		}
		return false;
	}
});

function remdatei(datei)
{
  if(window.confirm("Datei wirklich löschen?"))
  {
    $.ajax({
      url: 'index.php',
      type: 'GET',
      data: {
        module: 'adresse',
        action: 'removeemailanhang',
        id: datei
      },
      success: function(data) {
        $('#trdatei_'+datei).remove();
      }
    });
  }
}

</script>
