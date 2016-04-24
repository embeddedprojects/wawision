<script type="text/javascript">

	var activeElement="";
	var activeMode="";

	function setActive(mode, index)
	{
		activeMode = mode;
		activeElement = index;
	}

	function fill()
	{
		if(activeElement!="" && activeMode!="")
    {
			var name = activeMode + "preis" + activeElement;
      var element = document.wizardform.elements[name];
      if(!isNaN(parseFloat(element.value)))
      {
				var mengeName = activeMode + "menge" + activeElement;
				var mengeElement = document.wizardform.elements[mengeName];
				if(isNaN(parseFloat(mengeElement.value)))
					mengeElement.value=1;
			}
		}
	}

	function fill2(element)
	{
		if(isNaN(parseFloat(element.value)))
		{
			element.value='1';
		}
	}

	function minusSt(satz)
	{
		if(activeElement!="" && activeMode!="")
		{
			var name = activeMode + "preis" + activeElement;
			var element = document.wizardform.elements[name];
			if(!isNaN(parseFloat(element.value.split(',').join('.'))))
			{
				var newValue = parseFloat(element.value.split(',').join('.')) / satz;
				element.value = Math.round(newValue*100)/100;
				element.focus();
			}	
		}			
	}

	function plusSt(satz)
	{
		if(activeElement!="" && activeMode!="")
    {
			var name = activeMode + "preis" + activeElement;
      var element = document.wizardform.elements[name];
      if(!isNaN(parseFloat(element.value.split(',').join('.'))))
      {
        var newValue = parseFloat(element.value.split(',').join('.')) * satz;
        element.value = Math.round(newValue*100)/100;
        element.focus();
      }
    }
	}
</script>

<!--<h1>Artikel:&nbsp;[ARTIKELNAME]</h1>-->
<div id="ekbox" style="display:[EKBOX];">
<div style="float: right;"><a href="./index.php?module=wizard&action=adresse&typ=lieferant"><img src="./themes/new/images/document-new.png">Neuen Lieferant anlegen</a></div><br><br><br>
<fieldset><legend>Einkaufspreise</legend>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr align="center">
	<td><b>Nr.</b></td>
	<td><b>Lieferant</b></td>
	<td><b>Bezeichnung</b></td>
	<td><b>Artikelnummer</b></td>
	<td><b>Menge</b></td>
	<td><b>Preis (netto)</b></td>
	<td><b>Standardlieferant</b></td>
	<td><b>Aktion</b></td>
</tr>
[EKPREISE]
<tr>
	<td colspan="5">&nbsp;</td>
	<td><center><input type="button" value="-7" onclick="minusSt(1.07)"><input type="button" value="+7" onclick="plusSt(1.07)">
							<input type="button" value="-19" onclick="minusSt(1.19)"><input type="button" value="+19" onclick="plusSt(1.19)"></center></td>
	<td colspan="2">&nbsp;</td>
</tr>
</table>
</fieldset>
</div>

<br><br>
<div style="float: right;"><a href="./index.php?module=wizard&action=adresse&typ=kunde"><img src="./themes/new/images/document-new.png">Neuen Kunden anlegen</a></div><br><br><br>
<fieldset><legend>Verkaufspreise</legend>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
<tr align="center">
	<td><b>Nr.</b></td>
	<td><b>Kunde</b></td>
	<td><b>Menge</b></td>
	<td><b>Preis (netto)</b></td>
	<td><b>Aktion</b></td>
</tr>
[VKPREISE]
<tr>
  <td colspan="3"><b>Hinweis:</b> Wird das Kunden-Feld freigelassen, so wird der Preis f&uuml;r alle Kunden &uuml;bernommen.</td>
  <td><center><input type="button" value="-7" onclick="minusSt(1.07)"><input type="button" value="+7" onclick="plusSt(1.07)">
              <input type="button" value="-19" onclick="minusSt(1.19)"><input type="button" value="+19" onclick="plusSt(1.19)"></center></td>
  <td colspan="2">&nbsp;</td>
</tr>
</table>
</fieldset>
<br>
