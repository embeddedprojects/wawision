
<script language="javascript" type="text/javascript" src="./js/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="./js/flot/jquery.flot.stack.js"></script>
<script language="javascript" type="text/javascript" src="./js/flot/jquery.flot.pie.min.js"></script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
plotgraph_list();
});
</script>

<style type="text/css">
   #placeholder{
      width:100%;
      height:300px;
  }
</style>


<table width="100%" cellpadding="3" border="0">
<tr><td><h2 class="greyh2">Gesamt&uuml;bersicht Auftragseingang</h2></td><td><h2 class="greyh2">Statistik Auftr&auml;ge Heute [APIHINWEIS]</h2></td></tr>
<tr valign="top"><td width="50%" rowspan="3"><div id="placeholder" width="100%" height="400"></div></td><td>[STATISTIKHEUTE]</td></tr>
<tr valign="bottom"><td><h2 class="greyh2">Statistik Auftr&auml;ge Gestern [APIHINWEIS]</h2></td></tr>
<tr valign="top"><td>[STATISTIKGESTERN]</td></tr>


<tr><td width="50%"><h2 class="greyh2">Tages&uuml;bersicht Auftragseingang (nur versendet und freigegebene)</h2></td><td><h2 class="greyh2">Top Artikel (Lager) letzten 90 Tage</td></tr>
<tr valign="top"><td width="50%">[TAGESUEBERSICHT]</td><td>[TOPARTIKEL]</td></tr>
<tr><td width="50%">[EXTEND]<br><br></td><td></td></tr>

</table>

<style type="text/css">
    
    div.graph
    {
      width: 400px;
      height: 350px;
      float: right;
    }

#placeholder2{
      width:450px;
      height:300px;
}

</style>

