
<script language="javascript" type="text/javascript" src="./js/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="./js/flot/jquery.flot.stack.js"></script>
<script language="javascript" type="text/javascript" src="./js/flot/jquery.flot.pie.min.js"></script>

<script type="text/javascript" language="javascript">
$(document).ready(function() {
plotgraph();
});
</script>

<table width="100%" cellpadding="3" border="0">

<tr><td><h2 class="greyh2">Umsatz der max. letzten 12 Monate</h2></td><td><h2 class="greyh2">Umsatzanteile aktuelles Jahr (Rechnungen und Gutschriften)</h2></td></tr>
<tr valign="top"><td>[JAHR]</td><td><br><br><div id="umsatzpie" class="graph"></div></td></tr>

<tr><td colspan="2"><h2 class="greyh2">Jahres&uuml;bersicht Rechnungen, Gutschriften sortiert nach Projekte</h2></td></tr>
<tr valign="top"><td colspan="2">[JAHRESUEBERSICHTPROJEKTE]</td></tr>

<!--<tr><td><h2 class="greyh2">Jahres&uuml;bersicht Gutschriften</h2></td><td><h2 class="greyh2">Woher kennen Sie uns?</h2></td></tr>
<tr valign="top"><td>[GUTSCHRIFTJAHR]</td><td>[WOHERKENNENSIEUNS]</td></tr>-->

<tr><td colspan="2"><h2 class="greyh2">Tages&uuml;bersicht Auftragseingang Detail</h2></td></tr>
<tr valign="top"><td colspan="2">[TAGESUEBERSICHTDETAIL]</td></tr>



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


<div id="placeholder" width="100%" height="400"></div>
