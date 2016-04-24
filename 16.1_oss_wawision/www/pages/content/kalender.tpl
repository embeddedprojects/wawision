<script type='text/javascript' src='./js/jquery.dateFormat-1.0.js'></script>
<script type='text/javascript' src='./plugins/fullcalendar-1.6.4/fullcalendar.js'></script>
<script type='text/javascript' src='./js/nocie.js'></script>

<link rel='stylesheet' type='text/css' href='./plugins/fullcalendar-1.6.4/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='./plugins/fullcalendar-1.6.4/fullcalendar.print.css' media='print' />


<script type='text/javascript'>
	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today tasks',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
  		allDayText: 'Ganzt&auml;gig',
			firstDay: 1,
		  dayNamesShort: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
		  dayNames: ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'],
      monthNames: ['Januar', 'Februar', 'März', 'April', 'Mai',
        'Juni', 'Juli', 'August', 'September', 'Oktober',  'November', 'Dezember'],	
  		monthNamesShort: ['Januar', 'Februar', 'März', 'April', 'Mai',
        'Juni', 'Juli', 'August', 'September', 'Oktober',  'November', 'Dezember'],	
			timeFormat: 'H:mm',
  buttonText: {
    prev: "<span class='fc-text-arrow'>&lsaquo;</span>",
    next: "<span class='fc-text-arrow'>&rsaquo;</span>",
    prevYear: "<span class='fc-text-arrow'>&laquo;</span>",
    nextYear: "<span class='fc-text-arrow'>&raquo;</span>",
    today: 'Heute',
    month: 'Monat',
    week: 'Woche',
    day: 'Tag'
  },
			axisFormat: 'HH:mm',
			columnFormat: {
            month: 'ddd',
            week: 'ddd d.M',
            day: 'dddd d.M'
        },
			weekNumbers: true,
			weekNumberTitle: 'W',
			selectable: true,
			loading: function(isLoading, view) {
				//var myView = $.cookie('currentView');
				//var myViewDate = $.cookie('currentViewDate');
	
				var myView = Nocie.Get('currentView')
				var myViewDate = Nocie.Get('currentViewDate')


				if(isLoading && myView!=null) {
					$('#calendar').fullCalendar('changeView', myView);
					if(myViewDate!=null){
						var mydate = Date.parse(myViewDate);
						var year = $.format.date(mydate, 'yyyy'); 
						var month = $.format.date(mydate, 'M') - 1; 
						var day = 15;
						$('#calendar').fullCalendar( 'gotoDate', year, month, day);

						Nocie.Remove('currentViewDate');
        		Nocie.Remove('currentView');
					}
				}
			},
			select: function(start, end, allDay) {
				var myView = $('#calendar').fullCalendar('getView');

				Nocie.Set('currentViewDate', myView.start);
				Nocie.Set('currentView', myView.name);

				$("#TerminDialog").SetFormData(-1, start, end, allDay);
				$("#TerminDialog").dialog("open");
			},


			eventDrop: function (event, dayDelta, minuteDelta, allDay, revertFunc) 
		//	eventDrop: function(event, element) 
			{
				var task = '';
				
				if(event.task!=undefined)
					task = '&task='+event.task;
				if(event.id > -1){
				$.get('./index.php?module=kalender&action=update&id='+event.id+'&start='+$.fullCalendar.formatDate(event.start,'yyyy-MM-dd HH-mm-ss')
								+'&end='+$.fullCalendar.formatDate(event.end,'yyyy-MM-dd HH:mm:ss')+'&allDay='+event.allDay+task,
							function() {$('#calendar').fullCalendar('updateEvent', event);});
				} else {
									alert("Eintrag kann nicht verschoben werden");
					        revertFunc();
				}
    	},
			eventResize: function (event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view ) {
			//eventResize: function(event, element) {
				if(event.id > -1){
        	$.get('./index.php?module=kalender&action=update&id='+event.id+'&start='+$.fullCalendar.formatDate(event.start,'yyyy-MM-dd HH-mm-ss')
                +'&end='+$.fullCalendar.formatDate(event.end,'yyyy-MM-dd HH:mm:ss'),
              function() {$('#calendar').fullCalendar('updateEvent', event);});
				} else {
									alert("Eintrag kann nicht verlängert werden");
					        revertFunc();
				}
      },

			eventClick: function(calEvent, jsEvent, view) {
				var myView = $('#calendar').fullCalendar('getView');
				//$.cookie("currentView",myView.name);
				//$.cookie("currentViewDate", myView.visStart);
	
				Nocie.Set('currentView', myView.name);
        Nocie.Set('currentViewDate', calEvent.start);

				if($("#TerminDialog").SetFormData(calEvent.id, calEvent.start, calEvent.end, calEvent.allDay,calEvent.task))
					$("#TerminDialog").dialog("open");
			},
			editable: true,
			events: "./index.php?module=kalender&action=data" 
		});
		
	});

function AllDay(el) {
	if(el.checked) {
		$("#von").attr('disabled', true);
    $("#bis").attr('disabled', true);
	}else{
		$("#von").attr('disabled', false);
    $("#bis").attr('disabled', false);
	}
}


$(function() {
	$.fn.SetFormData = function(id, start, end, allDay,task) {
		if(id==-2) {
			window.open('index.php?module=aufgaben&action=edit&id='+task+'&back=kalender#tabs-3','_blank');
			return false;
		}
		else if(id==-3) {
			// mindesthaltbarkeit	
			//alert("Eintrag kann nicht editiert werden");
			window.open('index.php?module=artikel&action=mindesthaltbarkeitsdatum&id='+task,'_blank');
			return false;
		}
		else if(id==-4) {
			// geburstag
			window.open('index.php?module=adresse&action=brief&id='+task,'_blank');
			return false;
		}
                else if(id > -1) {
			var formdata = null;
			// Edit
			$.ajax({
				url: './index.php?module=kalender&action=eventdata&id='+id,
				success: function(data) { EditMode(data); },
				error: function (request, statusCode, error) { $("#submitError").html("Keine Event-Daten gefunden"); }
			});
		}else{
			// New
			$("#mode").val("new");
			$("#datum").val($.format.date(start, "dd.MM.yyyy"));
			$("#datum_bis").val($.format.date(end, "dd.MM.yyyy"));
			
			// Buttons
			$(":button:contains('Kopieren')").prop("disabled",true).addClass( 'ui-state-disabled' );
			$(":button:contains('Löschen')").prop("disabled",true).addClass( 'ui-state-disabled' );

			$("#public").attr('checked', false);

			// Ganztags
    	if(allDay) {
      	$("#allday").attr('checked', true);
      	$("#von").attr('disabled', true);
      	$("#bis").attr('disabled', true);
    	}else{
      	$("#allday").attr('checked', false);
      	$("#von").attr('disabled', false);
      	$("#bis").attr('disabled', false);
    	}

			// Von & Bis
			$("#von").val($.format.date(start, "HH:mm"));
    	$("#bis").val($.format.date(end, "HH:mm"));
		}
		return true;
	}

	var EditMode = function(data) {
		$("#mode").val("edit");
		$("#eventid").val(data.id);
		$("#titel").val(data.titel);
		$("#ort").val(data.ort);
		$("#beschreibung").val(data.beschreibung);
		$("#datum").val($.format.date(data.von, "dd.MM.yyyy"));
		$("#datum_bis").val($.format.date(data.bis, "dd.MM.yyyy"));

		// Buttons
    $(":button:contains('Kopieren')").prop("disabled",false).removeClass( 'ui-state-disabled' );
    $(":button:contains('Löschen')").prop("disabled",false).removeClass( 'ui-state-disabled' );

		// Ganztags
    if(data.allDay) {
    	$("#allday").attr('checked', true);
      $("#von").attr('disabled', true);
      $("#bis").attr('disabled', true);
    }else{
      $("#allday").attr('checked', false);
      $("#von").attr('disabled', false);
      $("#bis").attr('disabled', false);
    }

		// Öffentlich
		if(data.public) 
			$("#public").attr('checked', true);
		else
			$("#public").attr('checked', false);

		// Von & Bis
    $("#von").val($.format.date(data.von, "HH:mm"));
    $("#bis").val($.format.date(data.bis, "HH:mm"));	

		// Color
		$("#colors option[value='"+data.color+"']").attr('selected','selected');
		if($("#colors option[value='"+data.color+"']").attr('selected')=='selected')
			$("#colors").css("background-color", data.color);

		// Personen
		$('#personen option').removeAttr('selected');
		jQuery.each(data.personen, function(k,v) {
			$("#personen option[value='"+v.userid+"']").attr('selected','selected');
		});		
	};

	$("#TerminDialog").dialog({
			autoOpen: false,
			height: 550,
			width: 480,
			modal: true,
			buttons: {
				"Speichern": function() {
					var errMsg = '';

					if($("#datum").val()=="") errMsg = "Geben Sie bitte ein g&uuml;ltiges Datum ein (dd.mm.jjjj)"
					if($("#titel").val()=="") errMsg = "Geben Sie bitte einen Titel ein";
					
					if(errMsg!="")
						$("#submitError").html(errMsg);	
					else{
						$('#TerminForm').submit();
						$(this).dialog("close");
					}
				},
				"Kopieren": function() {
					$("#mode").val("copy");
          $('#TerminForm').submit();
				},
				"Löschen": function() {
					if(confirm("Soll der Termin wirklich gelöscht werden?"))
          {
							$("#mode").val("delete");
							$('#TerminForm').submit();
          }
				},
				"Abbrechen": function() {
					$(this).dialog("close");
				}
			},
			close: function() {
				$("#submitError").html("");
				$("#titel").val("");
				$("#ort").val("");
				$("#beschreibung").val("");
				$("#datum").val("");
				$("#datum_bis").val("");
				$("#von").val("");
				$("#bis").val("");
				$("#public").attr('checked', false);
				$("#colors option[value='']").attr('selected','selected');
				$("#colors").css('background-color','#FFFFFF');
				//$('#personen option').removeAttr('selected');	
				$("#eventid").val("");
				$("#mode").val("");
			}
		});
});

function getDialogButton( jqUIdialog, button_names )
{
    if (typeof button_names == 'string')
        button_names = [button_names];
    var buttons = jqUIdialog.parent().find('.ui-dialog-buttonpane button');
    for (var i = 0; i < buttons.length; i++)
    {
        var jButton = $( buttons[i] );
        for (var j = 0; j < button_names.length; j++)
            if ( jButton.text() == button_names[j] )
                return jButton;
    }

    return null;
}
</script>


<div id='calendar'></div>
<div id="TerminDialog" title="Termin erstellen / bearbeiten">
	<form id="TerminForm" action="" method="POST">
	<table width="100%" border="0">
		<tr><td></td><td colspan="3"><div id="submitError" style="color:red;"></div></td></tr>
		<tr>
			<td>Titel:</td>
			<td colspan="3"><input type="text" name="titel" id="titel" size="40"></td>
		</tr>
		<tr>
			<td>Beschreibung:</td>
			<td colspan="3"><textarea name="beschreibung" id="beschreibung" cols="40" rows="4"></textarea></td>
		</tr>
		<tr>
			<td>Ort:</td>
			<td colspan="3"><input type="text" name="ort" id="ort" size="40"></td>
		</tr>
		
		<tr><td colspan="4">&nbsp;</td></tr>
		<tr>
			<td>Datum:</td><td><input type="text" name="datum" id="datum" size="10"></td>
			<td>Bis:</td><td><input type="text" name="datum_bis" id="datum_bis" size="10"></td>
		</tr>
		<tr>
			<td>Ganztags:</td>
			<td><input type="checkbox" name="allday" id="allday" value="1" onclick="AllDay(this)"></td>
		</tr>
		<tr>
      <td>Von:</td><td><input type="text" name="von" id="von" size="10"></td>
			<td>Bis:</td><td><input type="text" name="bis" id="bis" size="10"></td>
    </tr>
		<tr><td colspan="4">&nbsp;</td></tr>
		<tr>
			<td>Farbe:</td>
			<td><select name="color" id="colors">[COLORS]</select> </td>
		</tr>
		<tr>
			<td>&Ouml;ffentlich:</td>
			<td><input type="checkbox" name="public" id="public" value="1"></td>
		</tr>
		<tr>
			<td valign="top">Personen:</td>
			<td colspan="3">
				<select name="personen[]" id="personen" size="15" style="width: 250px" multiple>
					[PERSONEN]
				</select><br>
				<span style="font-size: 10px; color: #A0A0A0">Strg-Taste gedrückt halten um mehrere Personen auszuw&auml;hlen</span> 
			</td>
		</tr>
	</table>
	<input type="hidden" name="submitForm" value="1">
	<input type="hidden" name="mode" id="mode" value="">
	<input type="hidden" name="eventid" id="eventid" value="">
	</form>
</div>
