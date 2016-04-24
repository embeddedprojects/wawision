<script type="text/javascript">
function fill(index,element)
{
	var name = "artikel" + index;
	var artikel = document.wizardform.elements[name];
	if(artikel.value!="" && isNaN(parseFloat(element.value)))
		element.value = '1';		
}

</script>


<table width="100%" border="0">
	<tr>
		<td><b>Artikel</b></td>
		<td><b>Menge</b></td>
		<td><b>Aktion</b></td>
	</tr>
	[STUECKLISTE]
</table>
<div style="float:right"><input type="submit" name="addRows" value="+ 5 Zeilen"></div>
<br>

