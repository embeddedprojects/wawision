<script type="text/javascript">
<!--
function printContent(id){
str=document.getElementById(id).innerHTML
newwin=window.open('','printwin','left=100,top=100,width=400,height=400')
newwin.document.write('<HTML>\n<HEAD>\n')
newwin.document.write('<TITLE>Print Page</TITLE>\n')
newwin.document.write('<script>\n')
newwin.document.write('function chkstate(){\n')
newwin.document.write('if(document.readyState=="complete"){\n')
newwin.document.write('window.close()\n')
newwin.document.write('}\n')
newwin.document.write('else{\n')
newwin.document.write('setTimeout("chkstate()",2000)\n')
newwin.document.write('}\n')
newwin.document.write('}\n')
newwin.document.write('function print_win(){\n')
newwin.document.write('window.print();\n')
newwin.document.write('chkstate();\n')
newwin.document.write('}\n')
newwin.document.write('<\/script>\n')
newwin.document.write('</HEAD>\n')
newwin.document.write('<BODY onload="print_win()">\n')
newwin.document.write(str)
newwin.document.write('</BODY>\n')
newwin.document.write('</HTML>\n')
newwin.document.close()
}
//-->
</script><div id="projekt_minidetail_[ID]">
  
<script>
      $(function() {
    $( "#accordion[AUFTRAGID]" ).accordion({ autoHeight: true,fillSpace: true });
  });
  </script>
<style>

.auftrag_cell {
  color: #636363;border: 1px solid #ccc;padding: 0;
}

</style>


<table width="900" border="0">
<tr valign="top"><td>

</td><td width="100%">  
<div style="width:100%; height:100%; background-color:white; padding:20px;">

  <div>
<h2>Beschreibung</h2><hr>[BESCHREIBUNG]<br><br>
<h2>Vorg&auml;nger</h2><hr>[VORGAENGER]<br><br>
<h2>Gebuchte Zeit</h2><hr>
<form action="index.php?module=arbeitsnachweis&action=createfromproject&id=[PROJEKT]" method="post"><table width="100%"><tr><td>
[GEBUCHTEZEIT]
</td></tr></table>
<table width="100%"><tr><td align="center"><input type="submit" value="in Arbeitsnachweis &uuml;bernehmen">&nbsp;
</td></tr></table>
      </form>
			</div>
   <!--<h3><a href="#">Zahlungseingang</a></h3>
  <div>[ZAHLUNGEN]</div>
    <h3><a href="#">Rechnungs-/Lieferadresse</a></h3>
  <div>[RECHNUNGLIEFERADRESSE]</div>
     <h3><a href="#">RMA Prozess</a></h3>
  <div>[RMA]</div>-->
<br><br>
<center><button onclick="printContent('projekt_minidetail_[ID]')">Drucken</button></center>
</div>

</td></tr>

</table>

</div>
