<!-- gehort zu tabview -->
<div id="tabs">
    <ul class="yui-nav">
        <li><a href="#tabs-1"></a></li>
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
<fieldset><legend>Einstellungen IMAP</legend>
    <table width="100%">
	<tr><td width="150">E-Mail Adresse:</td><td>[EMAIL][MSGEMAIL]</td></tr>
	<tr><td width="150">Benutzername:</td><td>[BENUTZERNAME][MSGBENUTZERNAME]</td></tr>
	      <tr><td>Passwort:</td><td>[PASSWORT][MSGPASSWORT]</td></tr>
	      <tr><td>IMAP-Server:</td><td>[SERVER][MSGSERVER]</td></tr>
</table></fieldset>
<fieldset><legend>Einstellungen SMTP (Optional wenn andere Einstellung als in Firma verwendet werden soll)</legend>
    <table width="100%">
     <tr><td>Extra SMTP Account:</td><td>[SMTP_EXTRA][MSGSMTP_EXTRA]<i>Dieser Haken muss gesetzt sein wenn ein anderer SMTP Server zum Versenden verwendet werden soll.</i></td></tr>
	<tr><td width="150">E-Mail Adresse:</td><td><i>Einstellung von "Einstellungen von IMAP"</i></td></tr>
	<tr><td width="150">Benutzername:</td><td><i>Einstellung von "Einstellungen von IMAP"</i></td></tr>
      <tr><td>Passwort:</td><td><i>Einstellung von "Einstellungen von IMAP"</i></td></tr>
     <tr><td>SMTP-Server:</td><td>[SMTP][MSGSMTP]</td></tr>
     <tr><td>SMTP-Port:</td><td>[SMTP_PORT][MSGSMTP_PORT]</td></tr>
     <tr><td>SMTP-SSL:</td><td>[SMTP_SSL][MSGSMTP_SSL]</td></tr>
     <tr><td>Sender E-Mailadresse:</td><td>[SMTP_FROMMAIL][MSGSMTP_FROMMAIL]&nbsp;<i>Optional</i></td></tr>
     <tr><td>Sender Name:</td><td>[SMTP_FROMNAME][MSGSMTP_FROMNAME]&nbsp;<i>Optional</i></td></tr>
</table></fieldset>


<fieldset><legend>Mitarbeiter</legend>
    <table width="100%">
	      <tr><td width="150">Mitarbeiter:</td><td>[MITARBEITERAUTOSTART][ADRESSE][MSGADRESSE][MITARBEITERAUTOEND]</td></tr>
</table></fieldset>


<fieldset><legend>Ticketsystem</legend>
    <table width="100%">
	      <tr><td width="150">Ticket-System:</td><td>[TICKET][MSGTICKET]&nbsp;<i>Wichtig: Es werden alle E-Mails nach dem Abholen von dem IMAP Account automatisch gel&ouml;scht.</i></td></tr>
	      <tr><td>Standard-Projekte:</td><td>[AUTOPROJEKTSTART][PROJEKT][MSGPROJEKT][AUTOPROJEKTENDE]</td></tr>
	      <tr><td>Standard-Warteschlange:</td><td>[TICKETQUEUE][MSGTICKETQUEUE]&nbsp;<i>E-Mails werden automatisch der Warteschlange zugeordnet.</i></td></tr>
</table></fieldset>

<fieldset><legend>E-Mail Backup</legend>
    <table width="100%">
	      <tr><td width="150">E-Mail Backup:</td><td>[EMAILBACKUP][MSGEMAILBACKUP]</td></tr>
	      <tr><td>E-Mails l&ouml;schen:</td><td>[LOESCHTAGE][MSGLOESCHTAGE]&nbsp;(Nach Anzahl Tage - Wert 0 bedeutet nie l&ouml;schen)</td></tr>
</table></fieldset>
<fieldset><legend>Autoresponder</legend>
    <table width="100%">
	      <tr><td width="150">Auto-Responder:</td><td>[AUTORESPONDER][MSGAUTORESPONDER]</td></tr>
	      <tr><td width="150">nur eine Mail pro Tag:</td><td>[AUTOSRESPONDER_BLACKLIST][MSGAUTOSRESPONDER_BLACKLIST]</td></tr>
	      <!--<tr><td>Auto-Responder Vorlage</td><td>[GESCHAEFTSBRIEFVORLAGE][MSGGESCHAEFTSBRIEFVORLAGE]</td></tr>-->
	      <tr><td>Auto-Responder Betreff</td><td>[AUTORESPONDERBETREFF][MSGAUTORESPONDERBETREFF]</td></tr>
	      <tr><td>Auto-Responder Text:</td><td>[AUTORESPONDERTEXT][MSGAUTORESPONDERTEXT]</td></tr>
</table></fieldset>
<fieldset><legend>Eigene Signatur</legend>
    <table width="100%">
	      <tr><td width="150">aktivieren:</td><td>[EIGENESIGNATUR][MSGEIGENESIGNATUR]</td></tr>
	      <tr><td>Signatur:</td><td>[SIGNATUR][MSGSIGNATUR]</td></tr>
</table></fieldset>


</td></tr>

    <tr valign="" height="" bgcolor="" align="" bordercolor="" class="klein" classname="klein">
    <td width="" valign="" height="" bgcolor="" align="right" colspan="3" bordercolor="" classname="orange2" class="orange2">
    <input type="submit" value="Speichern" />
    </tr>

    </tbody>
  </table>
</form>
</div>
<!-- tab view schließen -->
</div>



