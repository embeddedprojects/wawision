<script type="text/javascript">
$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkall').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkall').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
   
});
</script>


<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Arbeitsnachweise</a></li>
        <li><a href="#tabs-2">nicht versendete Arbeitsnachweise</a></li>
        <li><a href="#tabs-3">in Bearbeitung</a></li>
    </ul>
<div id="tabs-1">
<table height="80" width="100%"><tr><td>
<fieldset><legend>&nbsp;Filter</legend>
<center>
<table width="100%" cellspacing="5">
<tr>
  <td><input type="checkbox" id="arbeitsnachweisoffen">&nbsp;Alle nicht versendeten Arbeitsnachweise</td>
  <td><input type="checkbox" id="arbeitsnachweisheute">&nbsp;Alle Arbeitsnachweise von heute</td>
</tr></table>
</center>
</fieldset>
</td></tr></table>
<form action="index.php?module=arbeitsnachweis&action=abrechnung&back=[BACK]&id=[ID]" method="post">
[MESSAGE]
[TAB1]
</form>
</div>

<div id="tabs-2">
[TAB2]
</div>

<div id="tabs-3">
[TAB3]
</div>



</div>


