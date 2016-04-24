<div id="tabs">
    <ul>
        <li><a href="#tabs-1">offene Lieferungen</a></li>
        <li><a href="#tabs-2">versendete Lieferungen</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
<br>
<center>Barcode erfassen:&nbsp;<form action="" method="post"><input type="text" id="lieferschein" name="lieferschein" size="20"></form></center>
[MESSAGE]
[TAB1]
</div>

<div id="tabs-2">
[TAB2]
</div>

<!-- tab view schließen -->
</div>
<!-- ende tab view schließen -->
<script type="text/javascript">
$(document).ready(function() {
/*
$('div.dataTables_filter input').focus();
$('div.dataTables_filter input').val("");
$('div.dataTables_filter input').submit();
*/
$('#lieferschein').focus();
});
</script>

