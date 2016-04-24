<!-- gehort zu tabview -->
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">[TABTEXT]</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">
[MESSAGE]

<input type="button" id="filteropen" value="Filtern" />
[FILTER]
<table height="80" width="100%"><tr><td>
<fieldset><legend>&nbsp;Filter</legend>
<center>
<table width="100%" cellspacing="5">
<tr>
  <td><input type="checkbox" id="auchohneauswahl">nur ausgew&auml;hlte</td>
  <!--<td><input type="checkbox" id="marketingsp">auch mit Marketingsperre</td>-->
</tr></table>
</center>
</fieldset>
</td></tr></table>
<!--//<div id="adresstab" style="height:500px;overflow-y: scroll;">-->
[TAB1]
<!--//</div>-->
<form method="POST">Layout: [LAYOUTS] Drucker: <select name="drucker" id="drucker">[DRUCKER]</select><input type="submit" value="drucken" name="drucken" id="drucken" /></form>
<input type="button" value="vorschau" name="vorschau" id="vorschau" onclick="vorschau();" />
[TAB1NEXT]
</div>

<!-- tab view schließen -->
</div>
<div id="serienbriefModal">
<table><tr><td width="50%" valign="top">
<table>
<tr><td><input type="radio" id="typ1" name="typ" value="allgemein" checked="checked" /></td><td>Kunden angelegt am</td></tr>
<tr><td>Erfassungsmonat</td><td><select id="erfassungsmonat" onchange="seltyp(1);" name="erfassungsmonat">[ERFASSUNGSMONAT]</select></td></tr>
<tr><td>Jahr von</td><td><select id="jahrvon" name="jahrvon"  onchange="seltyp(1);">[JAHRVON]</select></td></tr>
<tr><td>Jahr bis</td><td><select id="jahrbis" name="jahrbis"  onchange="seltyp(1);">[JAHRBIS]</select></td></tr>
<tr><td>Kunden auch mit Marketingsperre</td><td><input type="checkbox"  onchange="seltyp(1);" id="marketingsperre" name="marketingsperre" value="1" [MARKETINGSPERRE] /></td></tr> 
</table>
</td><td width="50%" valign="top">
<table>
<tr><td><input type="radio" name="typ" id="typ2" value="artikel" /></td><td>Kunden mit Artikel in Auftr&auml;gen</td></tr>
<tr><td>Artikel</td><td><input  onchange="seltyp(2);" type="text" name="artikel" id="artikel" value="[ARTIKEL]" /></td></tr>
<tr><td>Datum von</td><td><input onchange="seltyp(2);" type="text" id="datumvon" name="datumvon" value="[DATUMVON]" /></td></tr>
<tr><td>Datum bis</td><td><input onchange="seltyp(2);" type="text" id="datumbis" name="datumbis" value="[DATUMBIS]" /></td></tr>
<tr><td>Kunden auch mit Marketingsperre</td><td><input type="checkbox" onchange="seltyp(2);" id="marketingsperre2" name="marketingsperre2" value="1" [MARKETINGSPERRE2] /></td></tr> 
</table>
</td></tr></table>
</div>

<script type="text/javascript">

function seltyp(val)
{
  if(val == 1)
  {
    $('#typ2').prop('checked',false);
    $('#typ1').prop('checked',true);
  }else{
    $('#typ1').prop('checked',false);
    $('#typ2').prop('checked',true);  
  }
}

function vorschau()
{
  window.open('index.php?module=serienbrief&action=vorschau&layout='+$('#layout').val(), '_blank');
}

function chserienbrief(id)
{
        //var el = this;
        //var id = 0;
        //var status = 0;
        //var ele = el.id.split('_');
        //if(ele[1] != 'undefined')id = ele[1];
        var el = $('#serienbrief_'+id);
        var status = $('#serienbrief_'+id).prop('checked');
        if(status)status = 1;
        if(id)
        {
          $.ajax({
            url: "index.php?module=serienbrief&action=chserienbrief&id="+id+"&status="+status,
            context: document.body
          }).done(function(data) {
            var obj = JSON.parse(data);
            if(obj.erg !== 'undefined')
            {
              if(obj.erg)
              {
                $(el).prop('checked',true);
              }else{
                $(el).prop('checked',false);
              }
            }
          });
        }
} 

  $(document).ready(function() {
  $('#serienbriefe .filter_column').first().css('display','none');
  $('#serienbriefe .filter_column').last().css('display','none');
    $('#drucken').on('click',function(){
      if($('#drucker').val())
      {
        var layout = 0;
        var layoutex = false;
        $('#layout').each(function(){
          layoutex = true;
          layout = $(this).val();
        });
        if(layoutex)
        {
          if(layout)
          {
            
          } else {
            alert('Kein Layout gewählt');
          }
        
        } else {
          alert('Kein Layout erstellt!');
        }
      
      } else {
        alert('Kein Drucker gewählt!');
      }
    
    });
  
    $("#serienbriefModal").dialog({
        modal: true,
        bgiframe: true,
        closeOnEscape:false,
        autoOpen: false,
        minWidth: 940,
        buttons: {
            "FILTER SETZEN": function() {
            $.post("index.php?module=serienbrief&action=setzefilter",
            {jahrvon:$('#jahrvon').val(),jahrbis:$('#jahrbis').val(),erfassungsmonat:$('#erfassungsmonat').val(),marketingsperre:$('#marketingsperre').prop('checked'),marketingsperre2:$('#marketingsperre2').prop('checked'),typ:$("input[name='typ']:checked").val(),artikel:$('#artikel').val(),datumvon:$('#datumvon').val(),datumbis:$('#datumbis').val() }
          ).done(function(data) {
            window.location = 'index.php?module=serienbrief';
          });
            
            
            
              
            },
            ABBRECHEN: function() {
                
              $(this).dialog('close');
                
            }
        }
    });


  
    $('#filteropen').on('click',function(){
      $("#serienbriefModal").dialog('open');
    })
    $('#adresstab :checkbox').each(function(){
      $(this).on('change',
      function()
      {
        var el = this;
        var id = 0;
        var status = 0;
        var ele = el.id.split('_');
        if(ele[1] != 'undefined')id = ele[1];
        status = $(el).prop('checked');
        if(status)status = 1;
        if(id)
        {
          $.ajax({
            url: "index.php?module=serienbrief&action=chserienbrief&id="+id+"&status="+status,
            context: document.body
          }).done(function(data) {
            var obj = JSON.parse(data);
            if(obj.erg !== 'undefined')
            {
              if(obj.erg)
              {
                $(el).prop('checked',true);
              }else{
                $(el).prop('checked',false);
              }
            }
          });
        }   
            
      }     
      );
    })
      $( "input#artikel" ).autocomplete({
        source: "index.php?module=ajax&action=filter&filtername=artikelnummer",
      });
  
      $( "#datumvon" ).datepicker({ dateFormat: 'dd.mm.yy',dayNamesMin: ['SO', 'MO', 'DI', 'MI', 'DO', 'FR', 'SA'], firstDay:1,
              showWeek: true, monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 
              'Juni', 'Juli', 'August', 'September', 'Oktober',  'November', 'Dezember'], });
              
      $( "#datumbis" ).datepicker({ dateFormat: 'dd.mm.yy',dayNamesMin: ['SO', 'MO', 'DI', 'MI', 'DO', 'FR', 'SA'], firstDay:1,
              showWeek: true, monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai', 
              'Juni', 'Juli', 'August', 'September', 'Oktober',  'November', 'Dezember'], });
      
  });
  
  
</script>
