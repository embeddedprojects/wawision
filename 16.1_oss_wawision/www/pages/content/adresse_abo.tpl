<script>

  function anlegen(id, sid) {
  document.location.href='index.php?module=adresse&action=addposition&id='+id+'&sid='+sid+'&menge='+ document.getElementById('menge'+sid).value +
    '&datum=' + document.getElementById('datum'+sid).value + '&art=' + document.getElementById('art'+sid).value;
  }
</script>
<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Artikel</a></li>
        <li><a href="#tabs-2">neue Position einf&uuml;gen</a></li>
    </ul>

<!-- erstes tab -->
<div id="tabs-1">
[TAB1]
</div>

<div id="tabs-2">
[TAB2]
</div>

<!-- tab view schließen -->
</div>
<!-- ende tab view schließen -->

