<!-- gehort zu tabview -->
<script>

$(document).keypress(function(e) {
    if(e.which == 13) {
        SendNachricht();    
           }
});


function SendNachricht()
{

  var nachricht = $( "#nachricht" ).val();
            $( "#nachricht" ).val('');

        $.ajax({
          type: 'POST',
          url: 'index.php?module=chat&action=messagelist&cmd=[CMD]',
          data: { postVar1: 'theValue1', postVar2: 'theValue2' },
          success:function(data){
            // successful request; do something with the data
                            $('#message').html(data);
$("#message").scrollTop($("#message")[0].scrollHeight);
document.getElementById("nachricht").focus(); 
          }
        });


        $.ajax({
          type: 'POST',
          url: 'index.php?module=chat&action=submit&cmd=[CMD]',
          data: { nachricht: nachricht },
          success:function(data){

   }
        });


}
$(window).on('resize', function(){

    //$('#heightSpan').html($(window).height());
    //$('#widthSpan').html($(window).width());
  ResizeMessageBox();
});


function ResizeMessageBox()
{
      var newwidth = $(window).width() - 400;

      if(newwidth <=0) newwidth=70;

      if(newwidth > 800) newwidth = 800;
      $("#message").width(newwidth);

      $("#nachricht").width(newwidth-70);


}


    $(document).ready(


            function() {
              $("#message").scrollTop($("#message")[0].scrollHeight);
              document.getElementById("nachricht").focus(); 
              ResizeMessageBox();

                setInterval(function() {
        $.ajax({
          type: 'POST',
          url: 'index.php?module=chat&action=userlist&cmd=[CMD]',
          data: { postVar1: 'theValue1', postVar2: 'theValue2' },
          success:function(data){
            // successful request; do something with the data
                            $('#show').html(data);
          }
        });

       }, 30000);


         setInterval(function() {
        $.ajax({
          type: 'POST',
          url: 'index.php?module=chat&action=messagelist&cmd=[CMD]',
          data: { postVar1: 'theValue1', postVar2: 'theValue2' },
          success:function(data){
            // successful request; do something with the data
                            $('#message').html(data);
$("#message").scrollTop($("#message")[0].scrollHeight);
document.getElementById("nachricht").focus(); 


          }
        });

                }, 2000);


            });

</script>


<div id="tabs">
    <ul>
        <li><a href="#tabs-1">[TABTEXT]</a></li>
    </ul>
<!-- ende gehort zu tabview -->

<style>
.auto {
height: 300px;
overflow-y: scroll;
border: 1px solid #000;
padding: 10px;
padding-bottom:10px;
} 
</style>

<!-- erstes tab -->
<div id="tabs-1">
<h3>&nbsp;[NAME]</h3>
<table border="0">
<tr valign="top"><td>
<table height="100%">
<tr><td height="300">

<div class="auto" id="message">
[CHATMESSAGE]
</div> 


</td></tr>
<tr><td>
<input type="text" size="70" name="nachricht" id="nachricht">&nbsp;<input type="button" name="submit" value="absenden" onclick="SendNachricht()">
<br><i>Prio Meldungen mit <b>:prio</b> beginnend Textnachricht beginnen.</i>
</td></tr>



</table>



</td><td width="200">
<b>Kollegen</b>
<div id="show">[SHOW]</div>
</td></tr>
</table>

</div>

<!-- tab view schließen -->
</div>
