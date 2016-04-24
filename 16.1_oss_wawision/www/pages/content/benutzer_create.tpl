<!--<table border="0" width="100%">
<tr><td><table width="100%"><tr><td>[USER_CREATE]</td></tr></table></td></tr>
</table>-->

<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Benutzer</a></li>
        <li><a href="#tabs-3">Rechte</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
[MESSAGE]
<form action="" method="post" name="eprooform">
[FORMHANDLEREVENT]

  <table class="tableborder" border="0" cellpadding="3" cellspacing="0" width="100%">
    <tbody>
      <tr valign="top" colspan="3">
        <td >
<fieldset><legend>Benutzer</legend>
    <table width="100%" border="0">
         <tr><td width="200">Benutzer ist aktiv:</td><td><input type="checkbox" name="activ" value="1" [ACTIVCHECKED]>&nbsp;</td></tr>
    <tr><td>Benutzername:*</td><td><input type="text" name="username" value="[USERNAME]" size="40"></td></tr>
 	<tr valign="top"><td width="200">Adresse aus Stammdaten:</td><td width="">[ADRESSEAUTOSTART]<input type="text" name="adresse" id="adresse" value="[ADRESSE]" size="40">[ADRESSEAUTOEND]&nbsp;<i>Jeder Benutzer muss auf eine eindeutige Adresse verweisen.</i></td></tr>

		<tr><td>Passwort:*</td><td><input type="password" name="password" value="[PASSWORD]" size="40" AUTOCOMPLETE="off"></td></tr>
    <tr><td>Passwort wdh:*</td><td><input type="password" name="repassword" value="[REPASSWORD]" size="40" AUTOCOMPLETE="off"></td></tr>
     
          <tr><td>Account-Typ:</td><td><select name="type">[TYPESELECT]</select></td></tr>
    <tr><td width="200">Interne Beschreibung:</td><td><input type="text" name="description" value="[DESCRIPTION]" size="40">&nbsp;<i>Dient f&uuml;r Infos oder Notizen.</i></td></tr>
    <tr><td><br></td><td></td></tr>
    <tr><td>Zugriff aus Ferne erlauben:</td><td><input type="checkbox" name="externlogin" value="1" [EXTERNLOGINCHECKED]>&nbsp;<i>Bei Installation auf externen Server immer aktivieren.</i></td></tr>
    <tr><td>Startseite:</td><td><input type="text" name="startseite" value="[STARTSEITE]" size="40">&nbsp;<i>z.B. index.php?module=welcome&action=pinwand</i>&nbsp;(für Pinwand)</td></tr>
    <tr><td>Fehllogins:</td><td><input type="text" name="fehllogins" value="[FEHLLOGINS]" size="40">&nbsp;<i>Z&auml;hler bei falschen Logins. Zum zur&uuml;cksetzten Feld leeren.</i></td></tr>
    <tr valign="top"><td>Benutzer Vorlage:</td><td><input type="text" name="vorlage" value="[VORLAGE]" size="40" id="vorlage">&nbsp;<br><i>Hinweis: Sobald eine Vorlage eingetragen ist k&ouml;nnen Rechte der Vorlage dem Benutzer nicht mehr entzogen werden.</i></td></tr>

</table></fieldset>

<fieldset><legend>RFID Tag</legend>
    <table width="100%" border="0">
          <tr><td width="200">Kennung:</td><td><input type="text" name="rfidtag" value="[RFIDTAG]" size="40"></td></tr>
</table></fieldset>


<fieldset><legend>Externer Login (wenn freigegeben)</legend>
    <table width="100%">
          <tr><td width="200">HW-Token:</td><td><select name="hwtoken">[TOKENSELECT]</select></td></tr>
          <tr><td>mOTP Pin:</td><td><input type="text" name="motppin" value="[MOTPPIN]" size="40"></td></tr>
          <tr><td>mOTP Secret:</td><td><input type="text" name="motpsecret" value="[MOTPSECRET]" size="40"></td></tr>
          <tr><td>HW Key:</td><td><input type="text" name="hwkey" value="[HWKEY]" size="40"></td></tr>
          <tr><td>HW Counter:</td><td><input type="text" name="hwcounter" value="[HWCOUNTER]" size="40"></td></tr>
          <tr><td>HW Datablock:</td><td><input type="text" name="hwdatablock" value="[HWDATABLOCK]" size="40"></td></tr>

</table></fieldset>

<fieldset><legend>Sonstige Einstellungen</legend>
    <table width="100%">
        <tr valign="top"><td>Projekt bevorzugen:</td><td><input type="checkbox" name="projekt_bevorzugen" value="1" [PROJEKTBEVORZUGENCHECKED]>&nbsp;
					<input type="text" name="projekt" value="[PROJEKT]" id="projekt" size="35">&nbsp;<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>(Beim Anlegen von Auftr&auml;gen & Co.)</i><br><br></td></tr>

        <tr valign="top"><td>Eigene E-Mail bevorzugen:</td><td><input type="checkbox" name="email_bevorzugen" value="1" [EMAILBEVORZUGENCHECKED]>&nbsp;<i>(Immer eigene E-Mail vor Firmenadresse bevorzugen.)</i></td></tr>

 
          <tr><td width="200">Standard Drucker:</td><td><select name="standarddrucker">[STANDARDDRUCKER]</select></td></tr>
          <tr><td width="200">Standard Etikettendrucker:</td><td><select name="standardetikett">[STANDARDETIKETT]</select></td></tr>
          <tr><td width="200">Standard Fax:</td><td><select name="standardfax">[STANDARDFAX]</select></td></tr>
          <tr><td>Parameter:</td><td><input type="text" name="settings" value="[SETTINGS]" size="40"></td></tr>

          <tr><td>GPS Stechuhr:</td><td><input type="checkbox" name="gpsstechuhr" value="1" [GPSSTECHUHRCHECKED]>&nbsp;</td></tr>
         <tr><td>Im Kalender/Chat ausblenden:</td><td><input type="checkbox" name="kalender_ausblenden" value="1" [KALENDERAUSBLENDENCHECKED]>&nbsp;<i>(Benutzer ausblenden)</i></td></tr>
         <tr><td>ICS Kalender:</td><td><input type="checkbox" name="kalender_aktiv" value="1" [KALENDERAKTIVCHECKED]>&nbsp;</td></tr>
          <tr><td>ICS Kalender Passwort:</td><td><input type="text" name="kalender_passwort" value="[KALENDERPASSWORT]" size="40"><br><i>&nbsp;URL: [SERVERNAME]/index.php?module=kalender&action=ics (Anmeldung: Benutzername siehe oben + ICS Kalender Passwort)</i></td></tr>
</table></fieldset>

<fieldset><legend>Rechte von Benutzer kopieren</legend>
	<table><tr><td width="200">Rechte von Benutzer kopieren:</td><td><select name="copyusertemplate" ><option value="">Bitte w&auml;hlen</option>[USERNAMESELECT]</select>
	<input type="button" name="templatesubmit" value="kopieren und &uuml;bernehmen" style="margin-left: 15px" 
		onclick="if(!confirm('Es werden alle Benutzerrechte überschrieben. Fortfahren?')) return false;else form.submit();">
	</td></tr></table>
</fieldset>


</td></tr>

    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" name="submituser" value="Speichern" />
    </tr>

    </tbody>
  </table>
</form>

</div>

<!-- tab view schließen -->
<style>
table.module {
	width: 100%;
	border-spacing: 1px;
}

table.module td.name {
	width: 100%;
	padding: 5px 10px;
	background:#5CCD00;
	color: #fff;
	font-size: 15px;
	font-weight: 600;
	border-radius: 3px;
	background:-moz-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#5CCD00),color-stop(100%,#4AA400));
	background:-webkit-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	background:-o-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	background:-ms-linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	background:linear-gradient(top,#5CCD00 0%,#4AA400 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5CCD00',endColorstr='#4AA400',GradientType=0);
}

table.action {
  width: 100%;
	margin-bottom: 20px;
	border-spacing: 2px;
}

table.action td.blue {
  padding: 3px;
	background:#25A6E1;
	color: #fff;
	border: 1px solid #0D7EE8;
	border-radius: 2px;
	background:-moz-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#25A6E1),color-stop(100%,#188BC0));
	background:-webkit-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background:-o-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background:-ms-linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	background:linear-gradient(top,#25A6E1 0%,#188BC0 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#25A6E1',endColorstr='#188BC0',GradientType=0);
}

table.action td.grey {
  padding: 3px;
  color: #fff;
  border-radius: 2px;
	background: #666666;
	background: -moz-linear-gradient(top, #666666 0%, #969696 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#666666), color-stop(100%,#969696));
	background: -webkit-linear-gradient(top, #666666 0%,#969696 100%);
	background: -o-linear-gradient(top, #666666 0%,#969696 100%);
	background: -ms-linear-gradient(top, #666666 0%,#969696 100%);
	background: linear-gradient(to bottom, #666666 0%,#969696 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#666666', endColorstr='#969696',GradientType=0 );
}

table.action td.blue:hover, td.grey:hover {
	cursor: pointer;
	text-shadow: 0px 2px 2px #555;
}

.allrightsremove {
	float: right;
	font-weight: normal;
}

.allrights {
	float: right;
	font-weight: normal;
}
</style>
<script>

function ChangeRights(el, user, module, action) {
	var value = $(el).attr('value');
	if(value=='1') value = 0; else value = 1;
	$.ajax({
		url: './index.php?module=benutzer&action=chrights&b_user='+user+'&b_module='+module+'&b_action='+action+'&b_value='+value, 
		success: function(r) {
			if(r==1) {
				$(el).attr('value', '1')
				$(el).removeClass('grey');
				$(el).addClass('blue');
			}else{
				$(el).attr('value', '0')
				$(el).removeClass('blue');
      $(el).addClass('grey');
			}


		}
	});

}

var geladenSoll = 0;
var geladenIst = 0;

$(document).ready(function() {

	$('td.name').append('<button class="allrights" onclick="">Alle setzen</button>');
	$('td.name').append('<button class="allrightsremove" onclick="">Alle entfernen</button>');
	$('.allrightsremove').click(function() {

		geladenSoll = 0;
		geladenIst = 0;

//		App.loading.open();

		var values = 0;
		var fields = 0;
		var rights = $(this).parent().parent().next().find('table.action').find('td');


		$.each(rights, function(key,elem) {

			var onclick = $(elem).attr('onclick');
			if (typeof onclick != 'undefined') {

				$(elem).attr('value', 1);
//				$(elem).removeClass('blue');
//				$(elem).addClass('grey');

				eval(onclick);

			}

		});
	});

	$('.allrights').click(function() {

		geladenSoll = 0;
		geladenIst = 0;

//		App.loading.open();

		var values = 0;
		var fields = 0;
		var rights = $(this).parent().parent().next().find('table.action').find('td');


		$.each(rights, function(key,elem) {

			var onclick = $(elem).attr('onclick');
			if (typeof onclick != 'undefined') {

					$(elem).attr('value', 0);
//		$(elem).removeClass('grey');
//				$(elem).addClass('blue');


				eval(onclick);

			}

		});
	});
});

</script>


<div id="tabs-3">
	<i>Hinweis: Blau = erlaubt, Grau = gesperrt</i>
[HINWEISADMIN]
	<br><br>
	<table class="module">
		[MODULES]
	</table>

</div>

</div>
