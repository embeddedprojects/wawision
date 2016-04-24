<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">[TABTEXT]</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
[MESSAGE]
<table width="100%">
<tr>
<td width="75%"></td>
<td width="25%">
<fieldset style="height:30px"><legend></legend>
<center><form  id="frmjahr" method="post">Jahr: <select onchange="$('#frmjahr').submit()" name="jahr" />[JAHROPTIONEN]</select></form></center>
</fielset>
</td>
</table>
[TAB1]
[TAB1NEXT]
</div>

<!-- tab view schließen -->
</div>
<div id="urlauballedetaildiv" style="display:none;"></div>
<script type="text/javascript">
function getUrlaubdetails(datum)
{
  $.ajax({
    url: "index.php?module=mitarbeiterzeiterfassung&action=geturlauballe&datum="+datum,
    type: 'POST',
    dataType: 'json',
    data: {}
    }).done( function(data) {
      if (typeof data == 'undefined' || data == null || typeof data.status == 'undefined' || data.status == 0)
      {
        
      } else {
        jQuery('#urlauballedetaildiv').dialog({
          title: 'Urlaub- / Krankheitsinformationen',
          width: 600
        });
        jQuery('#urlauballedetaildiv').html(data.html);
      }
    }).fail( function( jqXHR, textStatus ) {
          
   });
}
</script>