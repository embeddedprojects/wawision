<div id="tabs">
<ul>
<li><a href="#tabs-1"></a></li>
</ul>
 <div id="tabs-1">



  <script>
  $(function() {
    $( "#accordion" ).accordion({
      collapsible: true
    });
  });
  </script>
<style>
fieldset {
  padding: 10px;
  margin: 0px 0px 0px;
}
</style>



<table width="100%" border="0" style="background-color:" cellspacing="5">
<tr valign="top"><td width="650"  style="background-color:#ECECEC">
<fieldset><legend>Kalender</legend>
<div style="width:100%; min-height:552px; max-height:650px; overflow:auto;">
[KALENDER]
</div>
</fieldset>

</td>
<td style="background-color:#ECECEC">
<fieldset>
<legend>Intranet</legend>
<div style="overflow-y:auto; height:100%; background-color:white;padding:10px;min-height:532px">[ACCORDION]</div>
</fieldset>


</td>


<td width="20%" style="background-color:#ECECEC">
<fieldset><legend>Termine</legend>

<div style="background-color:white;padding:5px;min-height:97px;">
<h3>Heute</h3>
<p style="margin:5px">
	<ul class="home_termine">
		[TERMINE]
	</ul>
</p>
</div>
<br>
<div style="background-color:white;padding:5px;">
<h3>Morgen:</h3>
<p style="margin:5px">
  <ul class="home_termine">
    [TERMINEMORGEN]
  </ul>
</p>
<br><br>
</div>
</fieldset>

<fieldset><legend>Aufgaben</legend>
<span style="font-size:11pt;text-align: right;position: absolute;width: 100%;top:-18px;"><a href="index.php?module=aufgaben&action=pdf"><img src="./themes/[THEME]/images/pdf.png"></a>&nbsp;<a href="index.php?module=aufgaben&action=list"><img src="./themes/[THEME]/images/edit.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<div style="background-color:white;padding:5px;min-height:106px;">
<table width="100%" class="mkTable">
[TODOFORUSER]
</table>
<br>
<table width="100%" class="mkTable">
[TODOFORMITARBEITER]
</table>
</div>

</fieldset>


<fieldset><legend>Online Hilfe</legend>
<span style="font-size:11pt;text-align: right;position: absolute;width: 100%;top:-18px;"><a href="http://helpdesk.wawision.de/" target="_blank"><img src="./themes/[THEME]/images/forward.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;</span>
<div style="background-color:white;padding:5px;min-height:100px;">
[EXTERNALHANDBOOK]
</div>

</fieldset>





</div>
</td>
</tr>


<tr valign="top"><td style="background-color:#ECECEC">

[WELCOMENEWS]

</td><td colspan="2" style="background-color:#ECECEC">

<fieldset style="min-height:135px">
<legend>Neuigkeiten von WaWision</legend>
[EXTERNALNEWS]

</fieldset>
<div>

</td>
</tr>

</table>
 </div>




