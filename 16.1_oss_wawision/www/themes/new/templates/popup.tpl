<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>[TITLE]</title>

<script type="text/javascript" src="./js/einfuegen.js"></script>


<script type="text/javascript" src="./js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="./js/ajax_001.js"></script>

<script type="text/javascript" src="./themes/new/js/jquery-ui-1.10.3.custom.min.js"></script>
<link type="text/css" href="./themes/new/css/start/jquery-ui-1.10.3.custom.css" rel="Stylesheet" /> 

<script type="text/javascript" src="./js/jquery.jeditable.js" ></script>

<script type="text/javascript" src="./js/jquery.dataTables.min.js"></script>
<link href="./themes/[THEME]/css/demo_table.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="./js/jquery-ui-timepicker-addon.js"></script>


<link href="./themes/new/css/grid.css" rel="stylesheet" type="text/css" />
<link href="./themes/new/css/style.css" rel="stylesheet" type="text/css" />
<link href="./themes/new/css/wiki.css" rel="stylesheet" type="text/css" />
<link href="./themes/new/css/colorPicker.css" rel="stylesheet" type="text/css" />

[CSSLINKSPOPUP]

<script type="text/javascript" src="./js/tinymce/tiny_mce.js"></script>

<style type="text/css">

  input.ui-autocomplete-input { background-color:#D5ECF2; }
/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
.ui-timepicker-rtl dl dt{ float: right; clear: right; }
.ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }

* {
	font-size: 9pt;
	font-family: Verdana,Arial,sans-serif;
}

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
  padding:7px; 
}
.ui-widget-header {
  background: [TPLFIRMENFARBEHELL];
}
.ui-button-icon-primary.ui-icon.ui-icon-closethick
{
background-color:[TPLFIRMENFARBEDUNKEL];
color:white;
}

  .ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
  input.ui-autocomplete-input { background-color:#D5ECF2; }
  .ui-autocomplete { font-size: 8pt; }
  .ui-widget-header {border:0px;}

[ADDITIONALCSS]


</style>


<script type="text/javascript">

[JAVASCRIPT]

/*
function fillArtikel(id,menge)
{   
     if(menge < 1)
      menge=1;
     strSource = "./index.php";
     strData = "module=artikel&action=ajaxwerte&id="+id+"&smodule=[MODULE]&sid=[KID]&menge="+menge;
     intType= 0; //GET
     intID = 0;
     command = 'fillArtikel';
     sendRequest(strSource,strData,intType,intID);

}
*/

function fillArtikel(id,menge)
{   
     if(menge < 1)
      menge=1;

		var tmp = id.split(' ');
		//wenn ab Menge dabei steht
		var first_pos = id.search("ab Menge"); 
		if(first_pos > 0)
		{
//			var first_pos = id.search("ab Menge"); 
			var res = id.substr(first_pos+9)
			var first_space = res.search(" "); 
			menge = res.substr(0,first_space)
			id = tmp[0];
		
     strSource = "./index.php";
     strData = "module=artikel&action=ajaxwerte&id="+id+"&smodule=[MODULE]&sid=[KID]&menge="+menge;
     intType= 0; //GET
     intID = 0;
     command = 'fillArtikel';
     sendRequest(strSource,strData,intType,intID);
		} else {
 		 strSource = "./index.php";
     strData = "module=artikel&action=ajaxwerte&id="+id+"&smodule=[MODULE]&sid=[KID]&menge="+menge;
     intType= 0; //GET
     intID = 0;
     command = 'fillArtikel';
     sendRequest(strSource,strData,intType,intID);
		}

}


function fillArtikelBestellung(id,menge)
{   
     if(menge < 1)
      menge=1;

		var tmp = id.split(' ');
		//wenn ab Menge dabei steht
		var first_pos = id.search("ab Menge"); 
		if(first_pos > 0)
		{
//			var first_pos = id.search("ab Menge"); 
			var res = id.substr(first_pos+9)
			var first_space = res.search(" "); 
			menge = res.substr(0,first_space)
			id = tmp[0];
		
     strSource = "./index.php";
     strData = "module=artikel&action=ajaxwerte&id="+id+"&smodule=[MODULE]&sid=[KID]&menge="+menge;
     intType= 0; //GET
     intID = 0;
     command = 'fillArtikelBestellung';
     sendRequest(strSource,strData,intType,intID);
		} else {
 		 strSource = "./index.php";
     strData = "module=artikel&action=ajaxwerte&id="+id+"&smodule=[MODULE]&sid=[KID]&menge="+menge;
     intType= 0; //GET
     intID = 0;
     command = 'fillArtikelBestellung';
     sendRequest(strSource,strData,intType,intID);

		}

}


function fillArtikelProduktion(id,menge)
{   
    if(menge < 1)
      menge=1;

		var tmp = id.split(' ');
		id = tmp[0];
	
 
    strSource = "./index.php";
    strData = "module=artikel&action=ajaxwerte&id="+id+"&smodule=[MODULE]&sid=[KID]&menge="+menge;
    intType= 0; //GET
    intID = 0;
    command = 'fillArtikelProduktion';
    sendRequest(strSource,strData,intType,intID);

}


function fillArtikelLieferschein(id,menge)
{   
		var tmp = id.split(' ');
		id = tmp[0];
		//wenn ab Menge dabei steht

     if(menge < 1)
      menge=1;
     strSource = "./index.php";
     strData = "module=artikel&action=ajaxwerte&id="+id+"&smodule=[MODULE]&sid=[KID]&menge="+menge;
     intType= 0; //GET
     intID = 0;
     command = 'fillArtikelLieferschein';
     sendRequest(strSource,strData,intType,intID);

}

function fillArtikelInventur(id,menge)
{   
    if(menge < 1)
    	menge=1;
		
		var tmp = id.split(' ');
		id = tmp[0];
	
    strSource = "./index.php";
    strData = "module=artikel&action=ajaxwerte&id="+id+"&smodule=[MODULE]&sid=[KID]&menge="+menge;
    intType= 0; //GET
    intID = 0;
    command = 'fillArtikelInventur';
    sendRequest(strSource,strData,intType,intID);
}



tinyMCE.init({
  theme: "modern",
  menubar: false,
  statusbar : false,
  toolbar_items_size: 'small',
  mode : "exact",
  width : "100%",
  entity_encoding : "raw",
  element_format : "html",
  force_br_newlines : true,
  force_p_newlines : false,
        forced_root_block : "" ,
  encoding : "xml",
  elements : "beschreibung_de,beschreibung_en,uebersicht_de,uebersicht_en,links_de,links_en,links_v,beschreibung_v,uebersicht_v",
  plugins: [
                "link fullscreen code image"
        ],

   toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontsizeselect | cut copy paste | searchreplace | bullist numlist | outdent indent | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor | restoredraft  | print fullscreen",
        toolbar2: "",
        toolbar3: ""

});


tinyMCE.init({
  theme: "modern",
  menubar: false,
  statusbar : false,
  toolbar_items_size: 'small',
  mode : "exact",
  width : "100%",
  encoding : "xml",
  elements : "ticket_nachricht",
   toolbar1: "",
        toolbar2: "",
        toolbar3: ""

});




$(document).ready(function() {

  [DATATABLES]

  [SPERRMELDUNG]

  [AUTOCOMPLETE]

  [JQUERY]

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
                resizable: false,
                overlay: {
                    opacity: 0.5,
                    background: "black"
                }
            }).width([POPUPWIDTH] - horizontalPadding).height([POPUPHEIGHT] - verticalPadding);
        });


 $(document).ready(function() {
     $('.editable').editable('index.php?module=[MODULE]&action=editable', { 
		                        indicator : 'Speichere...',
		                        tooltip : 'zum Bearbeiten anklicken...'

  });
 });
$( "#tabs" ).tabs({
      cookie: {
        // store cookie for a day, without, it would be a session cookie
        //expires: 1
      }
    });

  [JQUERYREADY]

});


</script>

<style>
  .ui-autocomplete-loading { background: white url('images/ui-anim_basic_16x16.gif') right center no-repeat; }
  .ui-autocomplete { font-size: 8pt; }
</style>



</head>
<body>

[PAGE]
</body>
