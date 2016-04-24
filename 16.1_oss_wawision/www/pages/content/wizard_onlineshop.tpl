<script type="text/javascript" src="./js/base64.js"></script>
<script type="text/javascript">
	function showShopCategories(id)
	{
		var container = document.getElementById('kategorien');
		[JAVASCRIPT]
		if(id==null)
			container.innerHTML = "W&auml;hlen Sie bitte einen Online-Shop aus.";
		else
			container.innerHTML = base64_decode(content);
	}
</script>

<!-- Onload-Action ausnutzen -->
<img src="./themes/[THEME]/images/1x1t.gif" onload="showShopCategories([VORAUSWAHL])">

<table width="100%" border="0">
	<tr>
		<td valign="top" width="50%">
			<fieldset><legend>Ist es ein <u>Online-Shop-Artikel</u>?</legend>
				<input type="radio" name="shop" value="" onclick="showShopCategories(null)" [SHOPCHECKED]>Kein Online-Shop-Artikel<br>[SHOPS]
			</fieldset>
		</td>
		<td>
			<fieldset><legend>Welche <u>Eigenschaften</u> wollen Sie dem Artikel hinzuf&uuml;gen?</legend>
			<table>
				<tr><td>Neu:</td><td><input type="checkbox" name="neu" value="1" [NEUCHECKED]></td></tr>
				<tr><td>TopSeller:</td><td><input type="checkbox" name="topseller" value="1" [TOPSELLERCHECKED]></td></tr>
				<tr><td>Startseite:</td><td><input type="checkbox" name="startseite" value="1" [STARTSEITECHECKED]></td></tr>
				<tr><td>Wichtig:</u></td><td><input type="checkbox" name="wichtig" value="1" [WICHTIGCHECKED]></td></tr>
				<tr><td>Partnerprogramm-Sperre:</td><td><input type="checkbox" name="partnersperre" value="1" [PARTNERSPERRECHECKED]></td></tr>
			</table>
			</fieldset>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<fieldset><legend>In welcher <u>Kategorie</u> soll der Artikel angezeigt werden?</legend>
			<table border="0" width="100%" cellpadding="2">
				<tr><td width="60%" valign="top"><table width="100%"><div id="kategorien"></div></table></td></tr>
			</table>
			</fieldset>

		<td valign="top"><fieldset><legend>Neue Kategorie(n) hinzuf&uuml;gen:</legend>
      <table border="0" width="1000%" cellpadding="2">
        <tr>
          <td>
            <table>
              <tr><td>Deutsch:</td><td>Englisch:</td></tr>
              <tr><td><input type="text" name="newcatDE[0]" value="[NEWCAT0DE]"></td><td><input type="text" name="newcatEN[0]" value="[NEWCAT0EN]"></td></tr>
              <tr><td><input type="text" name="newcatDE[1]" value="[NEWCAT1DE]"></td><td><input type="text" name="newcatEN[1]" value="[NEWCAT1EN]"></td></tr>
              <tr><td><input type="text" name="newcatDE[2]" value="[NEWCAT2DE]"></td><td><input type="text" name="newcatEN[2]" value="[NEWCAT2EN]"></td></tr>
							<tr><td><input type="text" name="newcatDE[3]" value="[NEWCAT3DE]"></td><td><input type="text" name="newcatEN[3]" value="[NEWCAT3EN]"></td></tr>
							<tr><td colspan="2"><center><input type="submit" name="cat_submit" value="Hinzuf&uuml;gen"></center></td></tr>
            </table>
          </td>
        </tr>
      </table>
      </fieldset></td>
	</tr>
</table>

