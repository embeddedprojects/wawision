<script type="text/javascript">
function LagerartikelCheck(radio)
{
	document.forms[0].elements["LagerartikelOn"].checked = true;
	document.forms[0].elements["JitlisteOn"].checked = false;
	document.forms[0].elements["JitlisteOf"].checked = true;

	CheckRadio(radio);

}

function CheckRadio(radio)
{
	if(radio!=null)
	{
		var mode = radio.name.substr(radio.name.length-2, radio.name.length);	
		var name = radio.name.substr(0, radio.name.length-2);

		radio.checked = true; 
		if(mode=='On')	name = name + "Of";	else	name = name + "On"; 
		document.forms[0].elements[name].checked = false;
	}

	if(document.forms[0].elements["stuecklisteOn"].checked == true)
  {
		document.forms[0].elements["JitlisteOn"].disabled = false;
    document.forms[0].elements["JitlisteOf"].disabled = false;


		if(document.forms[0].elements["JitlisteOn"].checked == true && 
				document.forms[0].elements["LagerartikelOn"].checked == true)
		{
			document.forms[0].elements["JitlisteOn"].checked = true;
			document.forms[0].elements["JitlisteOf"].checked = false;

			document.forms[0].elements["LagerartikelOn"].checked = false;
			document.forms[0].elements["LagerartikelOf"].checked = true;
		}
	}

	if(document.forms[0].elements["stuecklisteOf"].checked == true)
	{	
		document.forms[0].elements["JitlisteOn"].disabled = true;
    document.forms[0].elements["JitlisteOf"].disabled = true;
		document.forms[0].elements["JitlisteOn"].checked = false;
    document.forms[0].elements["JitlisteOf"].checked = true;
	}

	if(document.forms[0].elements["LagerartikelOn"].checked == true)
	{
		document.forms[0].elements["charge"].disabled = false;
    document.forms[0].elements["endmontage"].disabled = false;
		
		document.forms[0].elements["SnOpt1"].disabled = false;
	}else
	{
		document.forms[0].elements["charge"].disabled = true;
    document.forms[0].elements["charge"].checked = false;
    document.forms[0].elements["endmontage"].disabled = true;
    document.forms[0].elements["endmontage"].checked = false;

		document.forms[0].elements["SnOpt1"].disabled = true;
		document.forms[0].elements["SnOpt1"].checked = false;
		document.forms[0].elements["SnOpt2"].checked = true;
	}
}

function UncheckOther(obj)
{
	if(obj!="")
	{
		var name = obj.name.substr(0, obj.name.length-1);
		var num = obj.name.substr(obj.name.length-1, obj.name.length);

		for(i=0; i<10; i++)
		{
			var element = name + i;
			if(document.forms[0].elements[element] != "")
			{
				if(i==num)
					document.forms[0].elements[element].checked = true;
				else
					document.forms[0].elements[element].checked = false;
			}
		}
	}
}


</script>

<!-- Onload-Action ausnutzen -->
<img src="./themes/[THEME]/images/1x1t.gif" onload="CheckRadio(null)">

<table>
<tr><td>Ist der Artikel eine <u>St&uuml;ckliste</u>?</td><td><input type="radio" name="stuecklisteOn" value="1" onclick="CheckRadio(this)" [STUECKLISTEONCHECKED]>ja
																														 <input type="radio" name="stuecklisteOf" value="0" onclick="CheckRadio(this)" [STUECKLISTEOFCHECKED]>nein</td></tr>
<tr><td>Ist der Artikel ein <u>Just-In-Time-St&uuml;ckliste</u>?</td><td><input type="radio" name="JitlisteOn" value="1" onclick="CheckRadio(this)" [JITLISTEONCHECKED]>ja
																																				 <input type="radio" name="JitlisteOf" value="0" onclick="CheckRadio(this)" [JITLISTEOFCHECKED]>nein</td></tr>
<tr><td>Ist der Artikel ein <u>Lagerartikel</u>?</td><td><input type="radio" name="LagerartikelOn" value="1" onclick="LagerartikelCheck(this)" [LAGERARTIKELONCHECKED]>ja
																												 <input type="radio" name="LagerartikelOf" value="0" onclick="CheckRadio(this)" [LAGERARTIKELOFCHECKED]>nein</td></tr>
<tr><td>&nbsp;</td><td></td></tr>
<tr><td>Soll der Artikel als <u>Charge</u> verwaltet werden?</td><td><input type="checkbox" name="charge" value="1" [CHARGE] [CHARGEDISABLED]></td></tr>
<tr><td>Ist der Artikel zur <u>Endmontage</u> vorgesehen?</td><td><input type="checkbox" name="endmontage" value="1" [ENDMONTAGE] [ENDMONTAGEDISABLED]></td></tr>
<tr><td>&nbsp;</td><td></td></tr>
<tr><td>Welche <u>Seriennummer</u> soll der Artikel erhalten?</td><td><input type="radio" name="SnOpt0" value="1" onclick="UncheckOther(this)" [SNOPT0CHECKED]>Originale beibehalten
																																			<input type="radio" name="SnOpt1" value="1" onclick="UncheckOther(this)" [SNOPT1CHECKED]>Neue erzeugen
																																			<input type="radio" name="SnOpt2" value="1" onclick="UncheckOther(this)" [SNOPT2CHECKED]>keine</td></tr>
<tr><td>&nbsp;</td><td></td></tr>
<tr><td>Handelt es sich um eine <u>erm&auml;&szlig;igte Umsatzsteuer?</u></td><td><input type="checkbox" name="ust" value="1" [USTCHECKED]></td></tr>
</table>
