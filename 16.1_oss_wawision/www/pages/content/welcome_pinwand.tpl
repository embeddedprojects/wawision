<div id="tabs">
    <ul>
        <li><a href="#tabs-1"></a></li>
    </ul>
<!-- ende gehort zu tabview -->

<!-- erstes tab -->
<div id="tabs-1">



<style type="text/css">
.note{
	height:125px;
	padding:10px;
	width:125px;
	position:absolute;
	overflow:hidden;
	cursor:move;
	word-wrap: break-word;

	font-family:Trebuchet MS,Tahoma,Myriad Pro,Arial,Verdana,sans-serif;
/*	font-size:16px; */

	

	/* Adding a CSS3 shadow below the note, in the browsers which support it: */
	-moz-box-shadow:2px 2px 0 #DDDDDD;
	-webkit-box-shadow:2px 2px 0 #DDDDDD;
	box-shadow:2px 2px 0 #DDDDDD;
}


#fancy_ajax .note{	cursor:default; }

/* Three styles for the notes: */

.yellow{
	background-color:#f69e06;
	border:1px solid #DEDC65;	
}

.blue{
	background-color:#41b3ce;
	border:1px solid #eee;	
}

.green{
	background-color:#a9ca45;
	border:1px solid #eee;	
}

.coral{
	background-color:#be3978;
	border:1px solid lightcoral;
}



/* Each note has a data span, which holds its ID */

span.data{	display:none; }

/* The "Add a note" button: */
#addButton{
	position:absolute;
	left:810px;
}


/* Green button class: */
a.green-button,a.green-button:visited{
	color:black;
	display:block;
	font-size:10px;
	font-weight:bold;
	height:15px;
	padding:6px 5px 4px;
	text-align:center;

	text-shadow:1px 1px 1px #DDDDDD;
}

a.green-button:hover{
	text-decoration:none;
	background-position:left bottom;
}

.author{
	/* The author name on the note: */
	bottom:10px;
	color:#666666;
	font-family:Arial,Verdana,sans-serif;
	font-size:12px;
	position:absolute;
	right:10px;
}

.main{
	/* Contains all the notes and limits their movement: */
	margin:0 auto;
	position:relative;
	width:100%;
	height:500px;
	z-index:10;
}

.fullscreen{
  position: absolute;
  top:-180px;
  left:-120px;
  z-index: 1000;
  margin: 0;
  padding: 0;
  width:100vw;
  background-color:white;
  height:100vh;
 }

h3.popupTitle{
	border-bottom:1px solid #DDDDDD;
	color:#666666;
	font-size:24px;
	font-weight:normal;
	padding:0 0 5px;
}

#noteData{
	/* The input form in the pop-up: */
	height:200px;
	margin:30px 0 0 200px;
	width:350px;
}

.note-form label{
	display:block;
	font-size:10px;
	font-weight:bold;
	letter-spacing:1px;
	text-transform:uppercase;
	padding-bottom:3px;
}

.note-form textarea, .note-form input[type=text]{
	background-color:#FCFCFC;
	border:1px solid #AAAAAA;
	font-family:Arial,Verdana,sans-serif;
	font-size:16px;
	height:60px;
	padding:5px;
	width:300px;
	margin-bottom:10px;
}


.note-form input[type=text]{	height:auto; }

.color{
	/* The color swatches in the form: */
	cursor:pointer;
	float:left;
	height:10px;
	margin:0 5px 0 0;
	width:10px;
}

#note-submit{	margin:20px auto; }
</style>


<script type="text/javascript">

$(document).ready(function(){
	/* This code is executed after the DOM has been completely loaded */

	var tmp;
	
	$('.note').each(function(){
		/* Finding the biggest z-index value of the notes */
		tmp = $(this).css('z-index');
		if(tmp>zIndex) zIndex = tmp;
	})

	/* A helper function for converting a set of elements to draggables: */
	make_draggable($('.note'));
	
	/* Configuring the fancybox plugin for the "Add a note" button: */
	$("#addButton").fancybox({
		'zoomSpeedIn'		: 600,
		'zoomSpeedOut'		: 500,
		'easingIn'			: 'easeOutBack',
		'easingOut'			: 'easeInBack',
		'hideOnContentClick': false,
		'padding'			: 15
	});
	
	/* Listening for keyup events on fields of the "Add a note" form: */
	$('.pr-body,.pr-author').live('keyup',function(e){
		if(!this.preview)
			this.preview=$('#fancy_ajax .note');
		
		/* Setting the text of the preview to the contents of the input field, and stripping all the HTML tags: */
		this.preview.find($(this).attr('class').replace('pr-','.')).html($(this).val().replace(/<[^>]+>/ig,''));
	});
	
	/* Changing the color of the preview note: */
	$('.color').live('click',function(){
		$('#fancy_ajax .note').removeClass('yellow green blue').addClass($(this).attr('class').replace('color',''));
	});
	
	/* The submit button: */
	$('#note-submit').live('click',function(e){
		
		if($('.pr-body').val().length<4)
		{
			alert("The note text is too short!")
			return false;
		}
		
		if($('.pr-author').val().length<1)
		{
			alert("You haven't entered your name!")
			return false;
		}
		
		$(this).replaceWith('<img src="img/ajax_load.gif" style="margin:30px auto;display:block" />');
		
		var data = {
			'zindex'	: ++zIndex,
			'body'		: $('.pr-body').val(),
			'author'		: $('.pr-author').val(),
			'color'		: $.trim($('#fancy_ajax .note').attr('class').replace('note',''))
		};
		
		
		/* Sending an AJAX POST request: */
		$.post('ajax/post.php',data,function(msg){
						 
			if(parseInt(msg))
			{
				/* msg contains the ID of the note, assigned by MySQL's auto increment: */
				
				var tmp = $('#fancy_ajax .note').clone();
				
				tmp.find('span.data').text(msg).end().css({'z-index':zIndex,top:0,left:0});
				tmp.appendTo($('#main'));
				
				make_draggable(tmp)
			}
			
			$("#addButton").fancybox.close();
		});
		
		e.preventDefault();
	})
	
	$('.note-form').live('submit',function(e){e.preventDefault();});
});

var zIndex = 0;

function make_draggable(elements)
{
	/* Elements is a jquery object: */
	
	elements.draggable({
		containment:'parent',
		start:function(e,ui){ ui.helper.css('z-index',++zIndex); },
		stop:function(e,ui){
			
			/* Sending the z-index and positon of the note to update_position.php via AJAX GET: */

			$.get('index.php?module=welcome&action=movenote',{
				  x		: ui.position.left,
				  y		: ui.position.top,
				  z		: zIndex,
				  id	: parseInt(ui.helper.find('span.data').html())
			});
		}
	});
}
</script>

<script>
	$(function() {
$(".button").button();
	});


	</script>


<div id="main" class="main">
<table width="100%"><tr><td>
<a id="addnote" class="popup button" href="#" 
  onclick="document.getElementById('addnote').href='index.php?module=welcome&action=addnote&pinwand=' + $('#pinwand').val()" title="Neue Aufgabe anlegen">Neue Aufgabe anlegen</a>
&nbsp;
</td><td align="right">
&nbsp;<select name="pinwand" id="pinwand" onchange="window.location.href='index.php?module=welcome&action=pinwand&pinwand='+$('#pinwand').val()"><option value="0">Eigene Pinwand</option>[PINWAENDE]</select>
<a id="" class="popup" href="index.php?module=welcome&action=addpinwand" title="Neue Pinwand anlegen"><img src="./themes/new/images/new.png"></a>
&nbsp;<a class="popup" href="index.php?module=pinwand&action=list" title="Pinwand bearbeiten"><img src="./themes/new/images/edit.png"></a>
<a href="#" onclick="$('#main').toggleClass('fullscreen');" title="Vollbild"><img src="images/icon_max.png"></a>
</td></tr></table>
[NOTES]

</div>




</div>

<!-- tab view schließen -->
</div>
