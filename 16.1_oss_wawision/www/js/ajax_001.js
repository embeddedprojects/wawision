var table_filter = {
    init: function() {

      $('.table_filter').find('input[type="text"]').css({
        width: 200
      });

      $('.table_filter').find('select').css({
        padding: '5px',
        width: 200,
        'border-radius': 0
      });


      $('.table_filter').find('.smallInput').css({
        width: 125
      });

      $('.table_filter').each(function() {

        $(this).find('table').first().wrap('<div class="table_filter_inner"/>');

        var data_filter = $(this).attr('data-filter');

        table_filter.getParameters($(this));
        table_filter.addTop(data_filter);


        var htmlLink = '';
        htmlLink += '<a href="javascript:;" onclick="table_filter.toggle(\'' + data_filter + '\');" style="position: relative; display: inline-block; width: 30px; height: 15px;">';
        htmlLink += '<img src="images/icon_lupe_plus.png" style="position: absolute; right: 0; top: 0;">';

        window.setTimeout(function() {
          $('.dataTables_wrapper')
            .find('input')
            .first()
            .parent()
            .after(htmlLink);
        }, 500);

        $(this).find('input').keypress(function(event) {
        if ( event.which == 13 ) {
            table_filter.setParameters(data_filter);
            event.preventDefault();
          }
        });

      });

      addDeleteInput('.table_filter');

    },
    setParameters: function(data_selector, dontReload) {
      var container = $('fieldset[data-filter="'+data_selector+'"]');
      var set = container.serialize();

      if ( container.hasClass('open') ) {
        set += '&filterIsOpen=1';
      }

      $.ajax({
        url: 'index.php?module=ajax&action=tablefilter&do=setParameters&filter=' + data_selector,
        data: set,
        success: function(data) {
          if (!dontReload) {
            window.setTimeout(function() {
              window.location.reload();
            });
          }
          // Filter gesetzt... DataTable aktualisieren
        }
      });
    },
    getParameters: function(container) {
      $.ajax({
        url: 'index.php?module=ajax&action=tablefilter',
        dataType: 'json',
        data: {
          do: 'getParameters',
          filter: container.attr('data-filter')
        },
        success: function(data) {

          var countSetFilters = 0;

          if (data == null) {
            return false;
          }

          if (typeof data.filter != 'undefined') {
            delete data.filter;            
          }

          if (typeof data.action != 'undefined') {
            delete data.action;            
          }

          if (typeof data.do != 'undefined') {
            delete data.do;            
          }

          if (typeof data.module != 'undefined') {
            delete data.module;            
          }

          var filterOpen = false;
          if (typeof data.filterIsOpen != 'undefined' && data.filterIsOpen >= 1) {
            filterOpen = true;
            delete data.filterIsOpen;
          } 

          $.each(data, function(key,value) {
            var input = container.find('[name="'+key+'"]');
            switch(input.attr('type')) {
              case 'checkbox':
                if (value.length > 0) {
                  input.prop('checked', true);
                }
              break;
              default:
              input.val(value);
              break;
            }

            if (value.length > 0) {
              countSetFilters++;
            }

          });

          if (countSetFilters > 0) {
            
            container.css({
              display: 'block'
            });

            if (filterOpen) {
              $('.table_filter_inner').css({
                display: 'block'
              });
              container.addClass('open');
              $('.sizeToggle').html('<img src="images/icon_min.png">');
            } else {
              $('.table_filter_inner').css({
                display: 'none'
              });
              $('.sizeToggle').html('<img src="images/icon_max.png">');
            }
            
            container.find('.table_filter_hinweis').html('<div class="warning">Achtung, es sind Filter aktiv!</div>');

          }

        }
      });
    },

    addTop: function(data_selector) {

      var container = $('fieldset[data-filter="'+data_selector+'"]');
      var beforeHtml = '';

      beforeHtml += '<div class="iOpen" style="position: relative;">';

        beforeHtml += '<div class="table_filter_hinweis"></div>';
        beforeHtml += ' <a style="position: absolute; right: 35px; top: 14px;" href="javascript:;" class="sizeToggle" onclick="table_filter.sizeToggle(\''+container.attr('data-filter')+'\');"><!-- LEER --></a>';
        beforeHtml += ' <a style="position: absolute; right: 10px; top: 14px;" href="javascript:;" onclick="table_filter.clearParameters(\''+container.attr('data-filter')+'\');"><img src="themes/new/images/delete.gif" border="0"></a>';

      beforeHtml += '</div>';

      container
        .find('.table_filter_inner')
          .before(beforeHtml);

    },

    clearParameters: function(data_selector) {
      var container = $('fieldset[data-filter="'+data_selector+'"]');
      var set = container.serialize();

      container.find('input[type="text"]').val('');
      container.find('input[type="checkbox"]').prop('checked', false);
      container.find('input[type="radio"]').prop('checked', false);
      container.find('select option').prop('selected', false);

      $.ajax({
        url: 'index.php?module=ajax&action=tablefilter&do=clearParameters&filter=' + data_selector,
        data: set,
        success: function(data) {
          // Filter gelöscht... DataTable aktualisieren
          window.setTimeout(function() {
            window.location.reload();
          });
        }
      });
    },

    open: function(data_selector) {
      var container = $('fieldset[data-filter="'+data_selector+'"]');
      container.find('.iOpen').remove();
      container.find('.table_filter_inner').css({
        display: 'block'
      });

    },

    sizeToggle: function(data_selector) {

      var container = $('fieldset[data-filter="'+data_selector+'"]');

      if (container.hasClass('open')) {

        container.removeClass('open');
        container.find('.table_filter_inner').css({
          display: 'none'
        });

        container.find('.sizeToggle').html('<img src="images/icon_max.png">');

      } else {

        container.addClass('open');
        container.find('.table_filter_inner').css({
          display: 'block'
        });

        container.find('.sizeToggle').html('<img src="images/icon_min.png">');

      }

      table_filter.setParameters(data_selector, true);

    },

    toggle: function(data_selector) {

      var container = $('fieldset[data-filter="'+data_selector+'"]');

      if (container.hasClass('smallPreview')) {
        table_filter.open(data_selector);
        return true;
      }

      if (container.is(':visible')) {
        container.slideUp();
        container.removeClass('open');
      } else {
        container.slideDown();
        container.addClass('open');
      }

    }
};


var App = {
  loading: {
    open: function(callback) {

      if ( $('.loader_app').length == 0 ) {
        App.loading.create();
      }

      if (typeof callback == 'function') {
        callback();
      }
      $('.loader_app').show();

    },
    close: function() {

      $('.loader_app').hide();

    },
    create: function() {
      $('#scroller2').append('<div class="loader_app"><img src="themes/new/images/icon_grau.png?v=1" width="18"></div>');
    }
  }
};


$(document).ready(function() {
  $('.table_filter').css({
    display: 'none'
  });
  table_filter.init();
});


(function() {

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;

}());

function beforePrint() {
  /*
  $('.mce-edit-area iframe').each(function() {
    $(this).attr('original-height', $(this).height());
    $(this).height($(this).contents().find("html").height());
  });
  */
}

function afterPrint() {
  $(this).height($(this).attr('original-height'));
}

function wawisionPrint() {

  App.loading.open();

  $('.mce-edit-area iframe').each(function() {
    $(this).attr('original-height', $(this).height());
    $(this).height( $(this).contents().find("html").height() );
  }); 

  window.setTimeout(function() {
    window.print();
    App.loading.close();
    window.setTimeout(function() {
      $('.mce-edit-area iframe').each(function() {
        $(this).height( $(this).attr('original-height') );
      }); 
    }, 500);
  }, 500);

}

function addDeleteInput(selector) {
  $(selector).find('input[type="text"]').wrap('<div class="inputwrapper" style="position: relative; display: inline-block;">');
  $('.inputwrapper').each(function(key,inputContainer) {
    if ( !$(inputContainer).hasClass('isWrappedInput') ) {
      $(inputContainer).addClass('inputContainer_' + key);
      $(inputContainer).addClass('isWrappedInput');
      $(inputContainer).append('<a href="javascript:;" onclick="deleteInput(' + key + ');" style="position: absolute; right: 5px; top: 5px; color: #999;">X</a>');
    }
  });
}

function deleteInput(key) {
  $('.inputContainer_' + key).find('input').val('');
}


function generatePass(plength){

    var keylistalpha="abcdefghijklmnopqrstuvwxyz";
    var keylistint="123456789";
    var keylistspec="!@#_";
    var temp='';
    var len = plength/2;
    var len = len - 1;
    var lenspec = plength-len-len;

    for (i=0;i<len;i++)
        temp+=keylistalpha.charAt(Math.floor(Math.random()*keylistalpha.length));

    for (i=0;i<lenspec;i++)
        temp+=keylistspec.charAt(Math.floor(Math.random()*keylistspec.length));

    for (i=0;i<len;i++)
        temp+=keylistint.charAt(Math.floor(Math.random()*keylistint.length));

        temp=temp.split('').sort(function(){return 0.5-Math.random()}).join('');

    return temp;
}




function isTouchDevice()
{
        var ua = navigator.userAgent;
        var isTouchDevice = (
            ua.match(/iPad/i) ||
            ua.match(/iPhone/i) ||
            ua.match(/iPod/i) ||
            ua.match(/Android/i)
        );
 
        return isTouchDevice;
}

function callCursorArbeitsnachweis()
{
  setTimeout(continueExecutionArbeitsnachweis, 200) //wait ten seconds before continuing
}

function callCursor()
{
  setTimeout(continueExecution, 200) //wait ten seconds before continuing
}

function continueExecutionArbeitsnachweis()
{
  document.getElementById('framepositionen').contentWindow.document.getElementById('adresse').value = ""; 
  document.getElementById('framepositionen').contentWindow.document.getElementById('adresse').focus();
}

function continueExecution()
{
  document.getElementById('framepositionen').contentWindow.document.getElementById('artikel').value = ""; 
  document.getElementById('framepositionen').contentWindow.document.getElementById('artikel').focus();
}

function AnsprechpartnerLieferadresse(value)
{
     var strSource = "./index.php";
     var strData = "module=ajax&action=ansprechpartner&id="+value;
     var intType= 0; //GET
     var intID = 0;
     command = 'getAnsprechpartnerLieferadresse';
     sendRequest(strSource,strData,intType,intID);
}

function Ansprechpartner(value)
{

     var strSource = "./index.php";
     var strData = "module=ajax&action=ansprechpartner&id="+value;
     var intType= 0; //GET
     var intID = 0;
     command = 'getAnsprechpartner';
     sendRequest(strSource,strData,intType,intID);

}

function Lieferadresse(value)
{

     var strSource = "./index.php";
     var strData = "module=ajax&action=lieferadresse&id="+value;
     var intType= 0; //GET
     var intID = 0;
     command = 'getLieferadresse';
     sendRequest(strSource,strData,intType,intID);
}


function AdresseStammdatenLieferscheinIframe(value)
{
     var strSource = "./index.php";
     var strData = "module=ajax&action=adressestammdaten&id="+value;
     var intType= 0; //GET
     var intID = 0;
     command = 'getAdresseStammdatenLieferschein';
     sendRequest(strSource,strData,intType,intID);
		 parent.closeIframe();
}

function AnsprechpartnerLieferscheinIframe(value)
{
     var strSource = "./index.php";
     var strData = "module=ajax&action=ansprechpartner&id="+value;
     var intType= 0; //GET
     var intID = 0;
     command = 'getAnsprechpartnerLieferschein';
     sendRequest(strSource,strData,intType,intID);
		 parent.closeIframe();
}



function AnsprechpartnerIframe(value)
{

     var strSource = "./index.php";
     var strData = "module=ajax&action=ansprechpartner&id="+value;
     var intType= 0; //GET
     var intID = 0;
     command = 'getAnsprechpartner';
     sendRequest(strSource,strData,intType,intID);
		 parent.closeIframe();
}

function LieferadresseIframe(value)
{
     var strSource = "./index.php";
     var strData = "module=ajax&action=lieferadresse&id="+value;
     var intType= 0; //GET
     var intID = 0;
     command = 'getLieferadresse';
     sendRequest(strSource,strData,intType,intID);
    parent.closeIframe();
}



function LieferadresseLS(value)
{

     var strSource = "./index.php";
     var strData = "module=ajax&action=lieferadresse&id="+value;
     var intType= 0; //GET
     var intID = 0;
     command = 'getLieferadresseLS';
     sendRequest(strSource,strData,intType,intID);
}




function CopyDialog(value)
{

  if(!confirm("Soll der Eintrag wirklich kopiert werden?")) return false;
    else window.location.href=value;

}


function PrintDialog(value)
{
  if(!confirm("Soll der Eintrag gedruckt werden?")) return false;
    else window.location.href=value;
}

function PrintDialogMenge(value)
{
  var menge = prompt("Anzahl Etiketten:",1);
  if(!menge) return false;
  else window.location.href=value + '&menge=' + menge;
}

function InsertDialog(value)
{

  if(!confirm("Soll der Eintrag wirklich eingefügt werden?")) return false;
    else window.location.href=value;

}

function DisableDialog(value)
{
  if(!confirm("Soll der Eintrag wirklich deaktiviert werden?")) return false;
    else window.location.href=value;

}

function FinalDialog(value)
{
  if(!confirm("Soll der Eintrag wirklich abgeschlossen werden?")) return false;
    else window.location.href=value;

}

function UndoDialog(value)
{
  if(!confirm("Soll der Eintrag wirklich rückgängig gemacht werden?")) return false;
    else window.location.href=value;
}


function BezahltDialog(value)
{

  if(!confirm("Soll der Eintrag manuell ohne SEPA Überweisung als bezahlt markiert werden?")) return false;
    else window.location.href=value;
}





function StornoDialog(value)
{

  if(!confirm("Soll der Eintrag wirklich storniert werden?")) return false;
    else window.location.href=value;

}

function DeleteAufloesen(value)
{

  if(!confirm("Soll die Verknüpfung aufgelöst werden?")) return false;
    else window.location.href=value;
}

function ConfirmVertriebDialog(value)
{

  if(!confirm("Soll der Vertreter / Verkäufer ausgewählt werden?")) return false;
    else window.location.href=value;

}

function DeleteDialog(value)
{

  if(!confirm("Soll der Eintrag wirklich gelöscht oder storniert werden?")) return false;
    else window.location.href=value;

}

function DialogGutschrift(value)
{

  if(!confirm("Soll die Rechnung storniert oder gut geschrieben werden?")) return false;
    else window.location.href=value;

}

function DialogAnfrageStatus(value)
{

  if(!confirm("Soll der nächste Status aktiviert werden?")) return false;
    else window.location.href=value;

}

function DialogAnfrageStart(value)
{

  if(!confirm("Soll die Anfrage gestartet werden?")) return false;
    else window.location.href=value;

}


function DialogAnfrageAbschluss(value)
{

  if(!confirm("Soll die Anfrage abgeschlossen werden?")) return false;
    else window.location.href=value;
}




function DialogForderungsverlust(value)
{

  if(!confirm("Soll der Betrag als Forderungsverlust gebucht werden?")) return false;
    else window.location.href=value;

}



function DialogDifferenz(value)
{

  if(!confirm("Soll der fehlende Betrag als Skonto gebucht werden?")) return false;
    else window.location.href=value;

}

function DialogMahnwesen(value)
{

  if(!confirm("Soll die Rechnung vorrübergehend aus dem Mahnwesen genommen werden?")) return false;
    else window.location.href=value;

}



function VerbandAbrechnen(value)
{
	var today = new Date();
	var month = today.getMonth()+1;
	var year = today.getYear();
	var day = today.getDate();
	if(day<10) day = "0" + day;
	if(month<10) month= "0" + month;
	if(year<1000) year+=1900;

	var vorschlag = year+ "-" + month + "-" + day;

  var termin = prompt("Abrechnung für Rechnungen bis zum YYYY-MM-DD starten:",vorschlag);

	if (termin != '' && termin != null) 
  	window.location.href=value+"&tag="+termin;

}

function BackupDialog(value)
{

	if(!confirm("Soll das Backup wirklich wieder eingespielt werden? Alle seit dem vorgenommenen Änderungen gehen verloren.")) return false;
    else window.location.href=value;

}

function ResetDialog()
{

  if(!confirm("Wollen Sie die Datenbank wirklich zurücksetzen?")) return false;
    else return true;

}

function getXMLRequester( )
{
    var xmlHttp = false; //Variable initialisieren
            
    try
    {
        // Der Internet Explorer stellt ein ActiveXObjekt zur Verfügung
        if( window.ActiveXObject )
        {
            // Versuche die neueste Version des Objektes zu laden
            for( var i = 5; i; i-- )
            {
                try
                {
                    //Wenn keine neuere geht, das alte Objekt verwenden
                    if( i == 2 )
                    {
                        xmlHttp = new ActiveXObject( "Microsoft.XMLHTTP" );    
                    }
                    // Sonst die neuestmögliche Version verwenden
                    else
                    {
                        
                        xmlHttp = new ActiveXObject( "Msxml2.XMLHTTP." + i + ".0" );
                    }
                    break; //Wenn eine Version geladen wurde, unterbreche Schleife
                }
                catch( excNotLoadable )
                {                        
                    xmlHttp = false;
                }
            }
        }
        // alle anderen Browser
        else if( window.XMLHttpRequest )
        {
            xmlHttp = new XMLHttpRequest();
        }
    }
    // loading of xmlhttp object failed
    catch( excNotLoadable )
    {
        xmlHttp = false;
    }
    return xmlHttp ;
}
// Konstanten
var REQUEST_GET        = 0;
var REQUEST_POST        = 2;
var REQUEST_HEAD    = 1;
var REQUEST_XML        = 3;

function sendRequest( strSource, strData, intType, intID )
{
    // Falls strData nicht gesetzt ist, als Standardwert einen leeren String setzen
    if( !strData )
        strData = '';

    // Falls der Request-Typ nicht gesetzt ist, standardmäßig auf GET setzen
    if( isNaN( intType ) )
        intType = 0;

    // wenn ein vorhergehender Request noch nicht beendet ist, beenden
    if( xmlHttp && xmlHttp.readyState )
    {
        xmlHttp.abort( );
        xmlHttp = false;
    }
        
    // wenn möglich, neues XMLHttpRequest-Objekt erzeugen, sonst abbrechen
    if( !xmlHttp )
    {
        xmlHttp = getXMLRequester( );
        if( !xmlHttp )
            return;
    }
    
    // Falls die zu sendenden Daten mit einem & oder einem ? beginnen, erstes Zeichen abschneiden
    if( intType != 1 && ( strData && strData.substr( 0, 1 ) == '&' || strData.substr( 0, 1 ) == '?' ))
        strData = strData.substring( 1, strData.length );

// Als Rückgabedaten die gesendeten Daten, oder die Zieladresse setzen
    var dataReturn = strData ? strData : strSource;
    
    switch( intType )
    {
        case 1:    //Falls Daten in XML-Form versendet werden, xml davorschreiben
            strData = "xml=" + strData;
        case 2: // falls Daten per POST versendet werden
            // Verbindung öffnen 
            xmlHttp.open( "POST", strSource, true );
            xmlHttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
            xmlHttp.setRequestHeader( 'Content-length', strData.length );
            break;
        case 3: // Falls keine Daten versendet werden
            // Verbindung zur Seite aufbauen
            xmlHttp.open( "HEAD", strSource, true );
            strData = null;
            break;
        default: // Falls Daten per GET versendet werden
            //Zieladresse zusammensetzen aus Adresse und Daten
            var strDataFile = strSource + (strData ? '?' + strData : '' );
            // Verbindung aufbauen
            xmlHttp.open( "GET", strDataFile, true );
            strData = null;
    }
    
    // die Funktion processResponse als Event-handler setzen, wenn sich der Verarbeitungszustand der 
    xmlHttp.onreadystatechange = new Function( "", "processResponse(" + intID + ")" ); ;

    // Anfrage an den Server setzen
    xmlHttp.send( strData );    //strData enthält nur dann Daten, wenn die Anfrage über POST passiert

    // gibt die gesendeten Daten oder die Zieladresse zurück
    return dataReturn;
}


function processResponse( intID )
{
    //aktuellen Status prüfen
    switch( xmlHttp.readyState )
    {
        //nicht initialisiert
        case 0:
        // initialisiert
        case 1:
        // abgeschickt
        case 2:
        // ladend
        case 3:
            break;
        // fertig
        case 4:    
            // Http-Status überprüfen
            if( xmlHttp.status == 200 )    // Erfolg
            {
                processData( xmlHttp, intID ); //Daten verarbeiten
            }
            //Fehlerbehandlung
            else
            {
                if( window.handleAJAXError )
                    handleAJAXError( xmlHttp, intID );
                else
                    alert( "ERROR\n HTTP status = " + xmlHttp.status + "\n" + xmlHttp.statusText ) ;
            }
    }
}

// handle response errors
function handleAJAXError( xmlHttp, intID )
{
  //alert("AJAX Fehler!");
}

var command;
var lastartikelnummer;

var once;

function Select_Value_Set(SelectName, Value) {
  eval('SelectObject = parent.document.' + 
    SelectName + ';');
  for(index = 0; 
    index < SelectObject.length; 
    index++) {
   if(SelectObject[index].value == Value)
     SelectObject.selectedIndex = index;
   }
}

function processData( xmlHttp, intID )
{
  // process text data
  //updateMenu( xmlHttp.responseText );
  var render=0;
  switch(command)
  {
		case 'getAnsprechpartner':
			var myString = xmlHttp.responseText;
                        var mySplitResult = myString.split("#*#");
			if(trim(mySplitResult[0])!="") parent.document.getElementById('ansprechpartner').value=trim(mySplitResult[0]);
			if(trim(mySplitResult[1])!="") parent.document.getElementById('email').value=trim(mySplitResult[1]);
			if(trim(mySplitResult[2])!="") parent.document.getElementById('telefon').value=trim(mySplitResult[2]);
			if(trim(mySplitResult[3])!="") parent.document.getElementById('telefax').value=trim(mySplitResult[3]);
			if(trim(mySplitResult[4])!="") parent.document.getElementById('abteilung').value=trim(mySplitResult[4]);
			if(trim(mySplitResult[5])!="") parent.document.getElementById('unterabteilung').value=trim(mySplitResult[5]);
			Select_Value_Set('eprooform.land',trim(mySplitResult[6]));
			if(trim(mySplitResult[7])!="") parent.document.getElementById('strasse').value=trim(mySplitResult[7]);
			if(trim(mySplitResult[8])!="") parent.document.getElementById('plz').value=trim(mySplitResult[8]);
			if(trim(mySplitResult[9])!="") parent.document.getElementById('ort').value=trim(mySplitResult[9]);
			if(trim(mySplitResult[10])!="") parent.document.getElementById('adresszusatz').value=trim(mySplitResult[10]);
			Select_Value_Set('eprooform.typ',trim(mySplitResult[11]));
			parent.document.getElementById('anschreiben').value=trim(mySplitResult[12]);
			parent.document.getElementById('ansprechpartnerid').value=trim(mySplitResult[13]);
		break;
		case 'getAnsprechpartnerLieferschein':
			var myString = xmlHttp.responseText;
                        var mySplitResult = myString.split("#*#");
			parent.document.getElementById('liefername').value=trim(mySplitResult[0]);
			parent.document.getElementById('lieferabteilung').value=trim(mySplitResult[4]);
			parent.document.getElementById('lieferunterabteilung').value=trim(mySplitResult[5]);
			//parent.document.getElementById('lieferland').options[parent.document.getElementById('lieferland').selectedIndex].value=trim(mySplitResult[3]);
			Select_Value_Set('eprooform.lieferland',trim(mySplitResult[6]));
			parent.document.getElementById('lieferstrasse').value=trim(mySplitResult[7]);
			parent.document.getElementById('lieferort').value=trim(mySplitResult[9]);
			parent.document.getElementById('lieferplz').value=trim(mySplitResult[8]);
			parent.document.getElementById('lieferadresszusatz').value=trim(mySplitResult[10]);
			parent.document.getElementById('ansprechpartnerid').value=trim(mySplitResult[13]);
//			parent.document.getElementById('lieferansprechpartner').value=trim(mySplitResult[0]);
		break;
		case 'getAdresseStammdatenLieferschein':
			var myString = xmlHttp.responseText;
                        var mySplitResult = myString.split("#*#");
			parent.document.getElementById('liefername').value=trim(mySplitResult[0]);
			parent.document.getElementById('lieferabteilung').value=trim(mySplitResult[1]);
			parent.document.getElementById('lieferunterabteilung').value=trim(mySplitResult[2]);
			//parent.document.getElementById('lieferland').options[parent.document.getElementById('lieferland').selectedIndex].value=trim(mySplitResult[3]);
			Select_Value_Set('eprooform.lieferland',trim(mySplitResult[3]));
			parent.document.getElementById('lieferstrasse').value=trim(mySplitResult[4]);
			parent.document.getElementById('lieferort').value=trim(mySplitResult[5]);
			parent.document.getElementById('lieferplz').value=trim(mySplitResult[6]);
			parent.document.getElementById('lieferadresszusatz').value=trim(mySplitResult[7]);
			parent.document.getElementById('ansprechpartnerid').value=trim(mySplitResult[9]);
//			parent.document.getElementById('lieferansprechpartner').value=trim(mySplitResult[0]);
		break;



		case 'getLieferadresse':
			var myString = xmlHttp.responseText;
      var mySplitResult = myString.split("#*#");
			if(parent.document.getElementById('liefername'))
			{
			parent.document.getElementById('liefername').value=trim(mySplitResult[0]);
			parent.document.getElementById('lieferabteilung').value=trim(mySplitResult[1]);
			parent.document.getElementById('lieferunterabteilung').value=trim(mySplitResult[2]);
			//parent.document.getElementById('lieferland').options[parent.document.getElementById('lieferland').selectedIndex].value=trim(mySplitResult[3]);
			Select_Value_Set('eprooform.lieferland',trim(mySplitResult[3]));
			parent.document.getElementById('lieferstrasse').value=trim(mySplitResult[4]);
			parent.document.getElementById('lieferort').value=trim(mySplitResult[5]);
			parent.document.getElementById('lieferplz').value=trim(mySplitResult[6]);
			parent.document.getElementById('lieferadresszusatz').value=trim(mySplitResult[7]);
			parent.document.getElementById('lieferansprechpartner').value=trim(mySplitResult[8]);
			parent.document.getElementById('lieferid').value=trim(mySplitResult[9]);

			} else {

			parent.document.getElementById('name').value=trim(mySplitResult[0]);
			parent.document.getElementById('abteilung').value=trim(mySplitResult[1]);
			parent.document.getElementById('unterabteilung').value=trim(mySplitResult[2]);
			//parent.document.getElementById('lieferland').options[parent.document.getElementById('lieferland').selectedIndex].value=trim(mySplitResult[3]);
			Select_Value_Set('eprooform.land',trim(mySplitResult[3]));
			parent.document.getElementById('strasse').value=trim(mySplitResult[4]);
			parent.document.getElementById('ort').value=trim(mySplitResult[5]);
			parent.document.getElementById('plz').value=trim(mySplitResult[6]);
			parent.document.getElementById('adresszusatz').value=trim(mySplitResult[7]);
			parent.document.getElementById('ansprechpartner').value=trim(mySplitResult[8]);
			parent.document.getElementById('lieferid').value=trim(mySplitResult[9]);
			}
		break;

    case 'fillArtikel':
      var myString = xmlHttp.responseText;
      var mySplitResult = myString.split("#*#");
      if(myString.length>3)
      {
				render=1;
      	document.getElementById("artikel").value=trim(mySplitResult[0]);
      	document.getElementById("nummer").value=mySplitResult[1];

			if(mySplitResult[1]=="") { 
				alert('In der Schnelleingabe können nur Artikel aus den Stammdaten eingefügt werden. Klicken Sie auf Artikel manuell suchen / neu anlegen.');
			} else {

      	document.getElementById("projekt").value=mySplitResult[2];
      	document.getElementById("preis").value=mySplitResult[3];
      	document.getElementById("menge").value=mySplitResult[4];


			if(document.getElementById("preis").value==0 || document.getElementById("preis").value=="") {
				document.getElementById('preis').style.background ='#FE2E2E';
				if(once!=1)
				alert('Achtung: Es ist kein Verkaufspreis hinterlegt!');
				once = 1;
				document.getElementById('preis').focus();
			} else {
				document.getElementById('preis').style.background ='';
				//document.getElementById('preis').setAttribute("readonly", "readonly");
				if(lastartikelnummer!=mySplitResult[1])
				{
					document.getElementById('menge').focus();
					document.getElementById('menge').select();
				}
			}
			}
				lastartikelnummer = mySplitResult[1];
      }
   	break;


   case 'fillArtikelBestellung':
  
      var myString = xmlHttp.responseText;
      var mySplitResult = myString.split("#*#");
      if(myString.length>3)
      {
				render=1;
      	document.getElementById("artikel").value=trim(mySplitResult[0]);
      	document.getElementById("nummer").value=mySplitResult[1];
				if(mySplitResult[1]=="") { 
					alert('In der Schnelleingabe können nur Artikel aus den Stammdaten eingefügt werden. Klicken Sie auf Artikel manuell suchen / neu anlegen.');
			} else {
      document.getElementById("projekt").value=mySplitResult[2];
      document.getElementById("preis").value=mySplitResult[3];
      document.getElementById("menge").value=mySplitResult[4];
      document.getElementById("bestellnummer").value=mySplitResult[5];
      document.getElementById("bezeichnunglieferant").value=mySplitResult[6];
      document.getElementById("vpe").value=mySplitResult[7];
      document.getElementById("waehrung").value=mySplitResult[8];
    }
    }
    break;


    case 'fillArtikelLieferschein':
      var myString = xmlHttp.responseText;
      var mySplitResult = myString.split("#*#");
      if(myString.length>3)
      {
			render=1;
      document.getElementById("artikel").value=trim(mySplitResult[0]);
      document.getElementById("nummer").value=mySplitResult[1];
			if(mySplitResult[1]=="") { 
				alert('In der Schnelleingabe können nur Artikel aus den Stammdaten eingefügt werden. Klicken Sie auf Artikel manuell suchen / neu anlegen.');
			} else {
      document.getElementById("projekt").value=mySplitResult[2];
      document.getElementById("menge").value=mySplitResult[4];
      }
      }
   break;
    case 'fillArtikelProduktion':
      var myString = xmlHttp.responseText;
      var mySplitResult = myString.split("#*#");
      if(myString.length>3)
      {
			render=1;
      document.getElementById("artikel").value=trim(mySplitResult[0]);
      document.getElementById("nummer").value=mySplitResult[1];
			if(mySplitResult[1]=="") { 
				alert('In der Schnelleingabe können nur Artikel aus den Stammdaten eingefügt werden. Klicken Sie auf Artikel manuell suchen / neu anlegen.');
			} else {
      document.getElementById("projekt").value=mySplitResult[2];
      document.getElementById("menge").value=mySplitResult[4];
      }
      }
   break;

   case 'fillArtikelInventur':
      var myString = xmlHttp.responseText;
      var mySplitResult = myString.split("#*#");
      if(myString.length>3)
      {
				render=1;
      document.getElementById("artikel").value=trim(mySplitResult[0]);
      document.getElementById("nummer").value=mySplitResult[1];
			if(mySplitResult[1]=="") { 
				alert('In der Schnelleingabe können nur Artikel aus den Stammdaten eingefügt werden. Klicken Sie auf Artikel manuell suchen / neu anlegen.');
			} else {


      document.getElementById("projekt").value=mySplitResult[2];
      document.getElementById("preis").value=mySplitResult[3];
      document.getElementById("menge").value=mySplitResult[4];
    }
    }
    break;

  }
  if(render<=0)
  {

    document.getElementById("menge").value="";
    document.getElementById("nummer").value="";
    document.getElementById("projekt").value="";
		if(command!='fillArtikelProduktion')
    document.getElementById("preis").value="";
  }
}

function trim (zeichenkette) {
  // Erst führende, dann Abschließende Whitespaces entfernen
  // und das Ergebnis dieser Operationen zurückliefern
  return zeichenkette.replace (/^\s+/, '').replace (/\s+$/, '');
}





// globales XMLHttpRequest-Objekt erzeugen
var xmlHttp = getXMLRequester();


