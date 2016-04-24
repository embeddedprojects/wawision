<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1200, user-scalable=yes" />
<title>[HTMLTITLE]</title>



<!--[if IE 6]>
<style type="text/css">
.box li {
background:none;
filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='./themes/new/images/menue_arrow.png', sizingMethod='scale');
}
</style>
<![endif]-->


<script type="text/javascript" src="./js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="./js/ajax_001.js?v=1"></script>

<script type="text/javascript" src="./js/jquery.tablehover.min.js"></script>
<script type="text/javascript" src="./js/jquery.tablehover.min.js"></script>
<script type="text/javascript" src="./js/jquery.noty.packaged.min.js"></script>

<script type="text/javascript" src="./js/jquery.jeditable.js" ></script>
<script type="text/javascript" src="./js/jquery.cookie.js" ></script>

<script type="text/javascript" src="./js/jquery.zclip.min.js" ></script>


<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./js/jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript" src="./js/jquery.inputhighlight.min.js"></script>
<script type="text/javascript" src="./js/jquery.base64.min.js"></script>
<script type="text/javascript" src="./js/grider.js" ></script>
<script type="text/javascript" src="./js/jqclock_201.js"></script>

<link href="./themes/[THEME]/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" media="screen">
<link href="./themes/[THEME]/css/demo_table.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="./js/tinymce/tiny_mce.js"></script>
<script type="text/javascript" src="./js/tinymceinstances.js"></script>
<script type="text/javascript" src="./js/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="./plugins/datatables/dataTables.tableTools.min.js"></script>
<link href="./plugins/datatables/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen">


[CSSLINKS]

<link href="./themes/[THEME]/css/wiki.css" rel="stylesheet" type="text/css" />
<link href="./themes/[THEME]/css/colorPicker.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="./themes/[THEME]/js/jquery-ui-1.10.3.custom.min.js"></script>
<link type="text/css" href="./themes/[THEME]/css/start/jquery-ui-1.10.3.custom.css" rel="Stylesheet" /> 


<script type="text/javascript" src="./js/jquery.ui.touch-punch.js"></script>


<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="./js/jquery.colorPicker.js"></script>

<!--<script type="text/javascript" src="./js/jquery.qtip.js"></script>-->

<script type="text/JavaScript" language="javascript">
[JAVASCRIPT]


function generateAlter(text) {
            var n = noty({
                text        : text,
                type        : 'alter',
                dismissQueue: true,
                buttons     : [
                {addClass: 'btn btn-primary', text: 'Ok', onClick: function ($noty) {
                    $noty.close();
                }
                }],
                layout      : 'topRight',
                closeWith   : ['click'],
                theme       : 'relax',
                //timeout: , // delay for closing event. Set false for sticky notifications
                force: true, // adds notification to the beginning of queue when set to true
                maxVisible  : 15,
                animation: {
                  open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
                  close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
                  easing: 'swing',
                  speed: 500 // opening & closing animation speed
                },
            });
}

function generate(type, text) {
            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'topRight',
                closeWith   : ['click'],
                theme       : 'relax',
                //timeout: , // delay for closing event. Set false for sticky notifications
                force: true, // adds notification to the beginning of queue when set to true
                maxVisible  : 15,
                animation: {
                  open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
                  close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
                  easing: 'swing',
                  speed: 500 // opening & closing animation speed
                },
            });
}



function setVisibility(rowName) {
        // Tabellenzelle ermitteln
        [HAUPTMENUJS]

        if(rowName!="hidden")
        {
        document.getElementById(rowName).style.visibility = "visible";
        document.getElementById(rowName).style.display = "block";
        }
}

$(document).ready(function() {


var util = { };

document.addEventListener('keydown', function(e){

    var key = util.key[e.which];
    if( key ){
        e.preventDefault();
    }

    if( key === 'F2' ){        
      // do stuff
			document.getElementById("direktzugriff").focus();
    }
 
		
})

util.key = { 
  //112: "F1",
  113: "F2",
  /*114: "F3",
  115: "F4",
  116: "F5",
  117: "F6",
  118: "F7",
  119: "F8",
  120: "F9",
  121: "F10",
  122: "F11",
  123: "F12"*/
}


var nav_width = [];
var nav_complete = 310;
var nav_maxcomplete = 0;
var nav_lastindex=0;
var nav_maxindex=0;

function wawision_resize()
{
  win = $(this); //this = window

// speichere originale werte
// note this array has outer scope
if(nav_width.length <=0)
{
$('#jsddm li a').each(function( index ) {
    //this now refers to each li
  var tmp_width = $('#jsddm > li:nth-child(' + index + ') > a:nth-child(1)').width();
  if(index >=2 && tmp_width > 0)
  {
    nav_lastindex = index -2;
    //console.log("index "+(index -2) + " width " + nav_width[index -2]);
  }
  //do stuff to each
});
nav_maxindex=nav_lastindex;
}

      var new_width = (($('#scroller').width() - 350)/(nav_maxindex + 1));
      if(new_width > 200) new_width=200;
    //console.log("max "+nav_maxindex + " breite " + $('#scroller').width() + " einzelbreite "+ new_width +" gesamte brechnet " + (new_width*(nav_maxindex+1)) );
    for(i=0;i<=nav_maxindex;i++)
    {
      $('#jsddm > li:nth-child('+ (i + 2) +') > a:nth-child(1)').width(new_width);
    }
}


$(window).on('resize', function(){
wawision_resize();
});

$(window).scroll(function () {
    if ($(window).scrollTop() > 80) {
        $('#scroller').css('top',  $(window).scrollTop()-70);
        $('#scroller2').css('top',  $(window).scrollTop()-80);
        $('#scroller2').css('z-index', '2');
    }
		else
		{
        $('#scroller').css('top',  0);
        $('#scroller2').css('top',  0);
        $('#scroller2').css('z-index', '0');
		}
}
);

  [DATATABLES]

  [SPERRMELDUNG]
 
  [AUTOCOMPLETE]

  [JQUERY]

servertime = parseFloat( $("#servertime").val() ) * 1000;
$("#clock").clock({"timestamp":servertime,"format":"24","langSet":"de"});

   // Make sure to only match links to wikipedia with a rel tag
   $('a[tooltip]').each(function()
   {
      // We make use of the .each() loop to gain access to each element via the "this" keyword...
      $(this).qtip(
      {
         content: {
            // Set the text to an image HTML string with the correct src URL to the loading image you want to use
            text: '<img class="throbber" src="/projects/qtip/images/throbber.gif" alt="Loading..." />',
            ajax: {
               url: 'index.php?module=ajax&action=tooltipsuche&term=' + $(this).attr('tooltip') // Use the rel attribute of each element for the url to load
            },
            title: {
               text: 'Suche - ' + $(this).text(), // Give the tooltip a title using each elements text
               button: true
            }
         },
         position: {
            at: 'bottom center', // Position the tooltip above the link
            my: 'top center',
            adjust: { screen: true } // Keep the tooltip on-screen at all times
         },
         show: {
            event: 'click',
            solo: true // Only show one tooltip at a time
         },
         hide: 'unfocus',
         style: {
            classes: 'ui-tooltip-ajax ui-tooltip-light ui-tooltip-shadow', // Use the default light style
         }
      })
 // Make sure it doesn't follow the link when we click it
      .click(function() { return false; });
   });



 $('a.popup').click(function(e) {
            e.preventDefault();
            var $this = $(this);
            var horizontalPadding = 30;
            var verticalPadding = 30;
            $('<iframe id="externalSite" class="externalSite" src="' + this.href + '" />').dialog({
                title: ($this.attr('title')) ? $this.attr('title') : 'External Site',
                autoOpen: true,
                width: [POPUPWIDTH],
                height: [POPUPHEIGHT], 
                modal: true,
                resizable: true
            }).width([POPUPWIDTH] - horizontalPadding).height([POPUPHEIGHT] - verticalPadding);            
        });

$(document).ready(function() {
wawision_resize();
     $('.editable').editable('index.php?module=[MODULE]&action=editable', {
                                        indicator : 'Speichere...',
                                        tooltip : 'zum Bearbeiten anklicken...'

  });



 });



  [JQUERYREADY]

});

/*
$(".info").hide().first().show('slow');
setTimeout(showNotifications, 3000);
function showNotifications(){
    $(".info:visible").hide('slow', function(){
        $(this).remove();
        $(".info").first().show('slow');
        if($(".info").length > 0){
           setTimeout(showNotifications, 3000);
        }
    });
}

$(".error2").hide().first().show('slow');
setTimeout(showNotificationsError2, 3000);
function showNotificationsError2(){
    $(".error2:visible").hide('slow', function(){
        $(this).remove();
        $(".error2").first().show('slow');
        if($(".error2").length > 0){
           setTimeout(showNotificationsError2, 3000);
        }
    });
}
*/

var timeout    = 500;
var closetimer = 0;
var ddmenuitem = 0;

function jsddm_open()
{  jsddm_canceltimer();
   jsddm_close();

   $('#scroller2').css('z-index', '9');
   ddmenuitem = $(this).find('ul').css('visibility', 'visible');
}

function jsddm_close()
{  
	var ua = navigator.userAgent.toLowerCase();
	var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");

	$('#scroller2').css('z-index', '9');
	if(isAndroid) {

	} else {
	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');
	}
}

function jsddm_timer()
{  closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{  if(closetimer)
   {  window.clearTimeout(closetimer);
      closetimer = null;}}
$(document).ready(function()
{  $('#jsddm > li').bind('mouseover', jsddm_open)
   $('#jsddm > li').bind('mouseout',  jsddm_timer)});

document.onclick = jsddm_close;


</script>
<script>
	$(function() {
			$( "a", ".tabsbutton" ).button();
			});
</script>
							
  <script>
  $(function() {

[BEFORETABS]
$( "#tabs" ).tabs({
			cookie: {
				// store cookie for a day, without, it would be a session cookie
				expires: 0,
				load: 0
			}
		});


    // here we are looking for our tab header
    hash = window.location.hash;
    elements = $('a[href="' + hash + '"]');
    if (elements.length === 0) {
        $("ul.tabs li:first").addClass("active").show(); //Activate first tab
    } else {
        if(hash.substring(0, 5) == '#tabs')elements.click();
    }


  });
  </script>
[ADDITIONALJAVASCRIPT]
<style>
  .ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
  input.ui-autocomplete-input { background-color:#D5ECF2; }
  .ui-autocomplete { font-size: 8pt; }
	.ui-widget-header {border:0px;}
	.ui-dialog { z-index: 10000 !important ;}

[YUICSS]
</style>
</head>
<body  class="ex_highlight_row" [BODYSTYLE]>
[SPERRMELDUNGNACHRICHT]
    <div class="container_6">
    
<div id="header" class="grid_6">
<table width="100%" border="0"><tr valign="top"><td>
             <a href="index.php"><img src="[TPLLOGOFIRMA]" style="padding-left:20px; padding-top:8px;" height="50" align="left" border="0"/></a>
</td><td align="">
            <!-- end topnav -->

[THEMEHEADER]
</td><td align="right">


<div style="padding-right:5px; color: [TPLNAVIGATIONFARBESCHRIFT];" align="right"><!--<a href="index.php?module=welcome&action=logout">Logout</a>-->

<table border="0" cellpadding="0" cellspacing="0"><tr valign="top">
<td align="right" style="font-size:7pt;font-weight:bold;" nowrap>[FIRMENNAME]&nbsp;<!--[VORGAENGELINK]--><br>
Benutzer: [BENUTZER]<br>
KW [CALENDERWEEK] von [CALENDERWEEKMAX]<br><div id="clock"></div><input id='servertime' type='hidden' value='[TIMESTAMP]' /></td>

<td width="10">&nbsp;&nbsp;</td>
<td>
<table border="0" width="[NBBREITE]" cellpadding="0" cellspacing="1">
<tr>
<td width="[NBPROZ]%"><div class="nachrichtenbox">Status</div></td>
[AUFGABENVOR]<td width="[NBPROZ]%"><div class="nachrichtenbox">Aufgaben</div></td>[AUFGABENNACH]
[TICKETVOR]<td width="[NBPROZ]%"><div class="nachrichtenbox">Tickets</div></td>[TICKETNACH]
[SUPPORTVOR]<td width="[NBPROZ]%"><div class="nachrichtenbox">Support</div></td>[SUPPORTNACH]
[WIEDERVORLAGENHEAD]
[NACHRICHTENBOXSPACE]
</tr>
<tr><td><div class="nachrichtenbox">[STECHUHR]</div></td>

[AUFGABENVOR]<td width="[NBPROZ]%"><div class="nachrichtenbox"><div class="nachrichtenboxzahl" onclick="window.location.href='index.php?module=aufgaben&action=list'">[ANZAHLAUFGABEN]</div></div></td>[AUFGABENNACH]
[TICKETVOR]<td width="[NBPROZ]%"><div class="nachrichtenbox"><div class="nachrichtenboxzahl" onclick="window.location.href='index.php?module=ticket&action=offene'">[ANZAHLTICKETS]</div></div></td>[TICKETNACH]
[SUPPORTVOR]<td width="[NBPROZ]%"><div class="nachrichtenbox"><div class="nachrichtenboxzahl" onclick="window.location.href='index.php?module=service&action=list'">[ANZAHLSUPPORT]</div></div></td>[SUPPORTNACH]
[WIEDERVORLAGENCOUNTER]
[NACHRICHTENBOXSPACE]
</tr></table>

</td></tr></table>

</div>

</td></tr></table>
<div id="scroller" style="position: absolute; width:100%; top:0px; z-index:200;">
  <ul id="jsddm" style="background-color:[TPLNAVIGATIONFARBE]; z-index:200; width:99.7%; border: 1px solid #888a89;">
<li style="background-color:[TPLFIRMENFARBEGANZDUNKEL]; height:41px; border-right: 1px solid #888a89;">
<img src="./themes/new/images/module/Icon_Dashboard_64.gif" height="25" style="margin: 7px 5px 3px 5px" onclick="window.location.href='index.php?module=welcome&action=start'"></li>
[NAV]
</ul>
</div>
           <!-- end logo -->
		</div>
		<!-- end header -->
		<div class="clear"></div>
        
		<!-- end NAV -->
<!--
<div id="header2" class="grid_6">
		<div class="clear"></div>

<b>[UEBERSCHRIFT]</b>
</div>-->
<!--
<div id="header2" class="grid_6">
<span id="headertoolbar">[TOPHEADING]</span>&nbsp;&nbsp;&nbsp;<span id="headertoolbar2">[KURZUEBERSCHRIFT] [KURZUEBERSCHRIFT2]</span>
</div>-->
       
 <div class="grid_6 bgstyle">
<table width="100%"><tr valign="top">
[ICONBAR]
<td>
 <style>
.ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default  {
color:#fff;/*[TPLFIRMENFARBEHELL];*/
background-color:[TPLFIRMENFARBEHELL];
}

.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight {
    border: 1px solid [TPLFIRMENFARBEGANZDUNKEL];
		background:none;
    background-color: #E5E4E2;
    color: [TPLFIRMENFARBEGANZDUNKEL];
}

.ui-state-hover a,
.ui-state-hover a:hover,
.ui-state-hover a:link,
.ui-state-hover a:visited {
  color: [TPLFIRMENFARBEGANZDUNKEL];
  text-decoration: none;
}

.ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus {
  border: 1px solid #448dae;
  font-weight: normal;
  color: [TPLFIRMENFARBEGANZDUNKEL];
}


.ui-tabs-nav {
background: [TPLFIRMENFARBEHELL];
}

.ui-widget-content {
    border-top: 1px solid [TPLFIRMENFARBEHELL];
    border-left: 1px solid [TPLFIRMENFARBEHELL];
    border-right: 1px solid [TPLFIRMENFARBEHELL];
}

.ui-state-default, .ui-widget-header .ui-state-default {
    border: 0px solid none;
}

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    border: 0px solid [TPLFIRMENFARBEHELL];
}

.ui-widget-content .ui-state-default a, .ui-widget-header .ui-state-default a, .ui-button-text {
font-size:8pt;
font-weight:bold;
border: 0px;
}


.ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active  {
color:[TPLFIRMENFARBEGANZDUNKEL];
}

.ui-widget-content .ui-state-active a, .ui-widget-header .ui-state-active a {
color:[TPLFIRMENFARBEGANZDUNKEL];
font-weight:bold;
font-size:8pt;
background-color:[TPLFIRMENFARBEHELL];
border: 0px;
}

ul.ui-tabs-nav {
  background: [TPLFIRMENFARBEHELL];
  padding:2px;
}
.ui-widget-header {
  background: [TPLFIRMENFARBEHELL];
}
.ui-button-icon-primary.ui-icon.ui-icon-closethick
{
background-color:[TPLFIRMENFARBEDUNKEL];
color:white;
}


#toolbar {
padding: 4px;
display: inline-block;
}
/* support: IE7 */
*+html #toolbar {
display: inline;
}
</style>
<div id="scroller2" style="margin-top:3px; padding:0px; width:[CSSSMALL1];border: 0px solid rgb(166, 201, 226);
background-color:[TPLFIRMENFARBEGANZDUNKEL];position:relative; height:73px;">
<div style="  position: absolute;height: 20px;bottom: 3px;right: 8px;">[TABSPRINT]</div>
<div width="100%" style="height:10px; background-color:[TPLSYSTEMBASE];"></div>
<div width="100%" style="height:8px; background-color:[TPLFIRMENFARBEGANZDUNKEL];"></div>
<span id="headertoolbar">[KURZUEBERSCHRIFT]</span><span id="headertoolbar1">[KURZUEBERSCHRIFT1]</span>&nbsp;&nbsp;&nbsp;<span id="headertoolbar2">[KURZUEBERSCHRIFT2]</span>
<div width="100%" style="height:8px; background-color:[TPLFIRMENFARBEGANZDUNKEL];"></div>
 <table cellpadding="2" border="0"><tr><td></td><td width="25"><a href="[TABSBACK]"><img src="./themes/new/images/back.jpg"></a></td><td width="[TABSADDWIDTH]">&nbsp;[TABSADD]</td><td>
<div style="position:absolute;top:51px;">[TABS]</div></td></tr></table>
</div>
<div style="width:[CSSSMALL2]; border: 0px solid rgb(166, 201, 226); border-right:8px solid [TPLFIRMENFARBEGANZDUNKEL];border-left:8px solid [TPLFIRMENFARBEGANZDUNKEL];
background-color:white; min-height:400px; border-bottom:8px solid [TPLFIRMENFARBEGANZDUNKEL];">
[PAGE]
</div>
</td></tr></table>

<div class="clear"></div>
	    </div>
		<!-- end CONTENT -->
        
		<!-- end RIGHT -->
        
        <div id="footer" class="grid_6">
          <ul>
          	<li><a href="http://helpdesk.wawision.de" target="_blank">Handbuch</a></li>
          	<li><a href="http://www.wawision.de" target="_blank">www.wawision.de</a></li>
    		<li>&copy; [YEAR] embedded projects GmbH | waWision &reg; |
		Versionsnummer: <a href="http://update.embedded-projects.net/wawision.php?since=[REVISIONID]" target="_blank">[REVISION]</a> <a href="index.php?module=welcome&action=info">[VERSIONINFO]</a>  | <a href="index.php?module=welcome&action=info">[VERSION]</a> [LIZENZHINWEIS]</li>
		  </ul>
		</div>
        <!-- end FOOTER -->
		<div class="clear"></div>

    </div>

[JSSCRIPTS]

<script type="text/javascript">
  var aktlupe = null;
  var lastlupe = null;
  var blockclick = false;
  function clicklupe(el)
  {
    lastlupe = el;
      

    
  }
  
  function aktualisiereLupe()
  {
    $('.ui-autocomplete-input').each(function(){
      if($(this).css('display') == 'none')
      {
        $(this).next('.autocomplete_lupe').hide();
      } else {
        $(this).next('.autocomplete_lupe').show();
      }
    });
  }
  
  function trimel(el)
  {
    $(el).val($(el).val().trim());
  }
  
  $(document).ready(function() {
    $('.ui-autocomplete-input').each(function(){
      var elnext = $(this).next();
      if($(elnext).is('a') && $(elnext).html() == 'X')
      {
        $(elnext).after('<img  onclick="clicklupe(this);" style="right:-25px;top:5px;position:absolute" src="images/icon_lupe_plus.png" class="autocomplete_lupe" />');
      } else {
        $(this).after('<img  onclick="clicklupe(this);" style="left:5px;top:5px;margin-right:5px;position:relative" src="images/icon_lupe_plus.png" class="autocomplete_lupe" />');
      }
      
    
    });
    
    
    $('.ui-autocomplete-input').each(function(){
      if($(this).css('display') == 'none')$(this).next('.autocomplete_lupe').hide();
    });
    $('*').each(function(){
      $(this).on('click',function(){
        if($(this).hasClass('autocomplete_lupe'))
        {
          
          $('.ui-autocomplete-input').each(function(){
            if($(this).val() === ' ')
            {
              $(this).val('');
              $(this).trigger('keydown');
            }
          });
          blockclick = true;
          lastlupe = this;
          var el = this;
          //var height = $(window).scrollTop();
          $(el).prev('.ui-autocomplete-input').each(function(){
          //var v = $(this).val();
            aktlupe = this;
            $(this).val(' ');
            $(this).trigger('keydown');
            //if(v !== '')setTimeout(trimel, 1500,this);
            //setTimeout(function(){$(window).scrollTop(height);},100);
          });
          setTimeout(function(){blockclick = false;},200);
        } else {
          if(this !== lastlupe)
          {
            if(!blockclick)
            {
              $('.ui-autocomplete-input').each(function(){
                if($(this).val() === ' ')
                {
                  $(this).val('');
                  $(this).trigger('keydown');
                }
              });
            }
          }
        }
      });
    });


    $(window).scroll(function() {
      var topPos = $(window).scrollTop();
      var newTopPos = 0;
      if (topPos > 80) {
        newTopPos = topPos - 80;
      } else {
        newTopPos = 0;
      }
      $('.toolbarleftInner').css({
        top: newTopPos
      })
    });
  }); 
</script>
</body>

</html>
