<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1"></a></li>
<!--       <li><a href="#tabs-2">Alle Aufgaben</a></li>-->
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
[MESSAGE]
    <div class="rTabs"><ul class="">
  <li class="[AKTIVAUFGABENLISTE]"><a href="index.php?module=aufgaben&action=list&cmd=aufgabenliste&sid=[MITARBEITER]">Aufgabenliste</a></li>
  <li class="[AKTIVWOCHENPLAN]"><a href="index.php?module=aufgaben&action=list&cmd=wochenplan&sid=[MITARBEITER]">Wochenplan</a></li>
</ul>

<div class="rTabSelect">[RTABSELECT]</div><div class="clear"></div></div>
  [ANZEIGE]

</div>
<!--
<div id="tabs-2">
<fieldset><legend>&nbsp;Filter</legend>
<center>
<table width="100%" cellspacing="5">
<tr>
  <td><input type="checkbox" id="aufgabenprio">&nbsp;<b style="color:red">Prio</b></td>
  <td><input type="checkbox" id="aufgabenoffeneigene">&nbsp;nur heute</td>
  <td><input type="checkbox" id="aufgabenintervall">&nbsp;alle geplanten Regelm&auml;&szlig;igen</td>
  <td align="right"><a href="index.php?module=aufgaben&action=pdf">Eigene Aufgaben-Liste als PDF</a><br>[EXTERNELISTE]</td>
</tr></table>
</center>
</fieldset>
[ALLE]
</div>
-->



</div>

<style>
.drag_drop_relative {
  position: relative !important;
}
</style>

<script type="text/javascript">
$(document).ready(function() { 

  buildDragDrop();

});

function buildDragDrop() {

    $('.drag_drop_aufgabe').draggable({ 
      connectToSortable: 'ul.drag_drop_list',
      scroll:true,
      revert: 'invalid',
      start: function() {
        $(this).data("startingScrollTop",$(this).parent().scrollTop());
      },
      drag: function(event,ui){
        var st = parseInt($(this).data("startingScrollTop"));
        ui.position.top -= $(this).parent().scrollTop() - st;
      }
    });


    $('ul.drag_drop_list').sortable({
      connectWith: ".drag_drop_aufgabe",
      revert: 1, 
      placeholder: "ui-state-highlight",
      stop: function (event, ui) {

        var sortIds = [];
        $(this).find('li').each(function() {
          if ( typeof($(this).attr('data-id')) != 'undefined' ) {
            sortIds.push( $(this).attr('data-id') );
          }
        });

        var aufgabeId = ui.item.attr('data-id');
        var aufgabeDatum = ui.item.parent().parent().attr('data-datum');

        $.ajax({
          url: 'index.php?module=aufgaben&action=dragdropaufgabe',
          method: 'POST',
          dataType: 'json',
          data: {
            aufgabeId: aufgabeId,
            aufgabeDatum: aufgabeDatum
          },
          success: function(data) {
            App.loading.close();
            if (data.status == 1) {
              sortAufgaben(sortIds);
            } else {
              alert(data.statusText);
            }

            $('ul.drag_drop_list').sortable( 'destroy' );

            buildDragDrop();
          },
          beforeSend: function() {
            App.loading.open();
          }
        });

      }
    });
  }

function sortAufgaben(idList) {

  $.ajax({
    url: 'index.php?module=aufgaben&action=sortaufgabe',
    method: 'POST',
    dataType: 'json',
    data: {
      idList: idList
    },
    success: function(data) {
      App.loading.close();
      if (data.status == 1) {

      } else {
        alert(data.statusText);
      }

    },
    beforeSend: function() {
      App.loading.open();
    }
  });
}
</script>
