

var grabatt = 0;
var grabatteur = 0;
var lkaddr = '0';
var waehrung = 'EUR';
var zahlungselzwang = false;
var kassiererId = 0;
var grabattSaved = 0;

var saveCust = false;

var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;

$(document).ready(function(){

  $('#grabatt').css({
    display: 'none'
  });

  // dialoge
  $("#storeconfconf, #finconfconf, #entconf, #emptywarn, #zahlwarn").dialog({
    modal: true,
    bgiframe: true,
    closeOnEscape:false,
    autoOpen: false,
    buttons: {
      OK: function() {
        $(this).dialog('close');
        $('#artikelnummerprojekt').focus();
      }
    }
  });

  $("#kashin").dialog({
    modal: true,
    bgiframe: true,
    closeOnEscape:false,
    autoOpen: false,
    dialogClass: "no-close",
    open: function () {
      $(this).off('submit').on('submit', function () {
        var kanr = $('#kanr2').val();
        loginkas(kanr);
        $(this).dialog('close');
        return false;
      });
    },
    buttons: {
      OK: function() {
        loginkas($('#kanr2').val());
        $(this).dialog('close');
      }
    }
  });

  $("#resetconf").dialog({
    modal: true,
    bgiframe: true,
    closeOnEscape:false,
    autoOpen: false,
    buttons: {
      NEIN: function() {
        $(this).dialog('close');
      },
      JA: function() {

        storePOSSession("resetsess");

        $(this).dialog('close');
      }
    }
  });

  $("#skempty").dialog({
    modal: true,
    bgiframe: true,
    closeOnEscape:false,
    autoOpen: false,
    buttons: {
      OK: function() {
        $(this).dialog('close');
        $('#artikelnummerprojekt').focus();
      }
    }
  });
  
  $("#finconf").dialog({
    modal: true,
    bgiframe: true,
    closeOnEscape:false,
    autoOpen: false,
    buttons: {
      NEIN: function() {
        $(this).dialog('close');
      },
      JA: function() {
        storePOSSession('finsess');
        resetFields();
        $(this).dialog('close');
      }
    }
  });
  
  
  resetFields();
  
  // check for active session
  $.getJSON( '', {
    module: "pos",
    action: "checkkass"
  }).done(function( jdata ) {

    if(jdata.check!="ERR") {
      kassiererId = jdata.kid;
      kanr = jdata.kid;
      $('#tabs-1 input').removeAttr('disabled');
      $('#tabs-1').data('on',kanr);
      lkaddr = jdata.lkadresse; 
      // $('#logoutkas').show();
      $('#loggedinkas').html(' ' + jdata.kname);
      $('#filiale').html(' ' + jdata.filiale);
      //$('#kanr').html(kanr);
      loadPOSSession(kanr);
    } else {
      $('#kashin').dialog('open');
    }
  });

  waehrung = $('#waehrung').html();
  
  // felder sperren bis sich Kassierer anmeldet
  //$('#tabs-1 input').prop('disabled','disabled'); -- by bene, duke 29.03.
  $('#loadkass input').removeAttr('disabled');
  
  
  $('#rabatt2').click(function() {
    var ggrabatt = prompt("Rabatt in %");
    if(!ggrabatt) {
      ggrabatt = 0;
    } else if (ggrabatt > 100) {
      ggrabatt = 0;
    }

    grabattSaved = ggrabatt;

    $('#wk tbody .rabatt').val(ggrabatt);
    $('#grabatt').html(ggrabatt+'%');
    
    grabatt = 0;
    $('#wk > tbody > tr').each(function() {
      updatearttotal($(this));
    });
    updatetotals();
    grabatt = 0;

  });

  // @todo
  $('#rabatteur').click(function() {
    grabatteur = prompt("Rabatt in " + waehrung);
    if(!grabatteur) {
      grabatteur = '0,00';
    }
    grabatteur = parseFloat(grabatteur.replace(',','.'));
    
    if (grabattSaved != 0) {
      grabatt = 0;
      ggrabatt = grabattSaved;
      $('#wk > tbody > tr').each(function() {
        updatearttotal($(this));
      });
    }

    updatetotals();
    grabatt = 0;
  });



  $('#entnahme').click(function() {
    var wert = prompt("Wert in " + waehrung + "?");
    if(!wert || wert <= 0) {
      $('#entnahme').prop('checked', false);
      return;
    }

    var kontostand = 0;
    $.ajax({
      url: '',
      dataType: 'json',
      async: false,
      data: {
        module: 'pos',
        action: 'loadkassstand',
        kassiererId: kassiererId
      },
      success: function(jdata) {
        kontostand = jdata.kontostand;
      }
    });

    if (parseFloat(kontostand) < parseFloat(wert)) {
      alert('Sie haben nicht ausreichend Bargeld in der Kasse.');
      $('#entnahme').prop('checked', false);
      return;
    }

    wert = parseFloat(wert.replace(',','.'));
    var grund = prompt('Entnahme(' + wert + ' EUR): Grund?');
    if(!grund) {
      $('#entnahme').prop('checked', false);
      return;
    }

    var storeobj = {};
    storeobj['kasid'] = $('#tabs-1').data('on');
  
    storeobj['addr'] = {};
    
    storeobj['addrid'] = "";
    
    storeobj['wk'] = [];
    var nart = {};
    nart['id']      = "entnahme";
    nart['artikel'] = "entnahme";
    nart['kurztext_de'] = 'Entnahme: ' + grund;
    nart['nummer']  = "entnahme";
    nart['tax']     = '0';
    nart['preis']   = wert;
    
    nart['amount']  = '1';
    nart['rabatt']  = '0';

    storeobj['wk'].push(nart);

    storeobj['ptype']   = "bar";
    storeobj['rtype']   = "entnahme";
    
    storeobj['inbem']   = $('#inbem').val();
    storeobj['freit']   = $('#freit').val();

    storeobj['grabatt'] = '0';
    storeobj['grabatteur'] = '0';
    
    storeobj['kassiererId'] = kassiererId;
    
    var jsonString = JSON.stringify(storeobj);
    
    $.getJSON( '', {
      module: "pos",
      action: "finsess",
      sessdata: jsonString
    }).done(function( jdata ) {
      $('#entconf').dialog('open');
      $('#artikelnummerprojekt').focus();
      $('#entnahme').prop('checked', false);
    });
  });

  $('#trinkgeld').click(function() {
    var wert = prompt("Wert in " + waehrung + "?");
    if(!wert || wert <= 0) {
      $('#entnahme').prop('checked', false);
      return;
    }

    var kontostand = 0;
    $.ajax({
      url: '',
      dataType: 'json',
      async: false,
      data: {
        module: 'pos',
        action: 'loadkassstand',
        kassiererId: kassiererId
      },
      success: function(jdata) {
        kontostand = jdata.kontostand;
      }
    });

    if (parseFloat(kontostand) < parseFloat(wert)) {
      alert('Sie haben nicht ausreichend Bargeld in der Kasse.');
      $('#trinkgeld').prop('checked', false);
      return;
    }

    wert = parseFloat(wert.replace(',','.'));
    var grund = prompt('Trinkgeld(' + wert + ' EUR): Kunde?');
    if(!grund) {
      $('#trinkgeld').prop('checked', false);
      return;
    }

    var storeobj = {};
    storeobj['kasid'] = $('#tabs-1').data('on');
    storeobj['addr'] = {};
    storeobj['addrid'] = "";
    
    storeobj['wk'] = [];
    var nart = {};
    nart['id']      = "entnahme";
    nart['artikel'] = "entnahme";
    nart['kurztext_de'] = 'Trinkgeld: ' + grund;
    nart['nummer']  = "entnahme";
    nart['tax']     = '0';
    nart['preis']   = wert;
    
    nart['amount']  = '1';
    nart['rabatt']  = '0';

    storeobj['wk'].push(nart);

    storeobj['ptype']   = "bar";
    storeobj['rtype']   = "entnahme";
    
    storeobj['inbem']   = $('#inbem').val();
    storeobj['freit']   = $('#freit').val();

    storeobj['grabatt'] = '0';
    storeobj['grabatteur'] = '0';
    
    storeobj['kassiererId'] = kassiererId;
    
    var jsonString = JSON.stringify(storeobj);
    
    $.getJSON( '', {
      module: "pos",
      action: "finsess",
      sessdata: jsonString
    }).done(function( jdata ) {
      $('#entconf').dialog('open');
      $('#artikelnummerprojekt').focus();
      $('#trinkgeld').prop('checked', false);
    });
  });
  
  
  $('#abortsale').click(function() {
    $("#resetconf").dialog('open');
  });
  
  $('#finsale').click(function() {

    var ktype = $('input[name=ktype]:checked').val();

    var totalAmount = $('#sutotal').text().replace(',', '.');
    totalAmount = parseFloat(totalAmount);
    if (totalAmount < 0) {
      alert('Die Gesamtsumme darf nicht kleiner als 0 sein.');
      return false;
    }

    if ( ktype == 'sk' && $('#adresse').val().length == 0 ) {
      $("#skempty").dialog('open');
      return false;
    } else if ( ktype == 'sk' && $('#adresse').val().length > 0 && !checkStammkunde($('#adresse').val(), kassiererId)) {
        alert('Stammkunde nicht korrekt.')
        return false;
    }

    if((ktype=="nk" && !$("#t_name").html()) || $('#wk > tbody > tr').length == 0) {
      $("#emptywarn").dialog('open');
    } else if(zahlungselzwang && !$('#payment input[name=ptype]:checked').val()) {
      $('#zahlwarn').dialog('open');
    } else {
      $("#finconf").dialog('open');
    }
    return false;
  })
  
  $('#storesale').click(function() {
      storePOSSession('storesess');
      return false;
  });
  
  
  
  $('#loadkass').submit(function() {
    var kanr = $('#kanr').html();
    if(!kanr) return false;
    loginkas(kanr);
    return false;
  }); 
  
  $('#logoutkas').click(function() {
    resetFields();
    logoutkas();
    return false;
  });
  
  
  $('#loadaddr').submit(function() {
    var kunr = $('#adresse').val();
    if(!kunr) return false;
    loadAddr(kunr);
    return false;
  });


  $('#adresse').focus(function() {

    $('input[name=ktype]').prop('checked', false);

    var skInput = $('input[value="sk"]');
    skInput.attr('checked', '');


    // $('input[name=ktype]').prop('checked', false);
    // $('input[name=ktype]').removeProp('checked');
    // $('input[name=ktype][value=sk]').prop('checked',true);
    // $('input[value="sk"]').prop('checked', true);

  });

  $('#adresse').focusout(function() {
    var kunr = $('#adresse').val();
    if(!kunr) return false;
    loadAddr(kunr);
  });
  
  
  
  $('input[name=ktype]').change(function() {
    var ktype = $(this).val();

    $('.rechnungsadresse_container').find('#t_name').text('');
    $('#adjcust').hide();

    if(ktype=='lk' || ktype=='nk'){
      $('#modalcont input[type=text]').val('');
      $('#ob1 span').html('');
      $('#adresse').val('');
    }
    
    if (ktype == 'lk') {
      $('.rechnungsadresse_container').find('#t_name').text('Laufkundschaft');
       // $('#adjcust').show();
    }

    if(ktype=='nk'){
      tinyMCE.get('infoauftragserfassung_pos').setContent('');
      $('.rechnungsadresse_container').find('#t_name').text('');
      $('#modaloverlay').show(300);
      $('#adjcust').show();
    }
  });
  
  
  $('#adjcust').click(function() { 
    $('#ob1 span').each(function(i,e) {
      var tid = $(this).prop('id').split('t_');
      if (tid[1] != 'typ' && tid[0] != '') {
        $('#'+tid[1]).val($(this).html());
      }
    });
    $('#modaloverlay').show(300); 
  });

  $('#storecust').click(function() { 

    $('.mkErrors').remove();

    if ($('#modalcont').find('input#name').val().length == 0) {
      if (!$('#modalcont').hasClass('mkerror')) {
        $('#modalcont').addClass('mkerror');
        $('#modalcont').find('input#name').after('<span style="color: red;" class="mkErrors"><br>Bitte Name angeben.</span>');
      }
      return false;
    }

    $('#modalcont').removeClass('mkerror');

    var storeobj = {}; 

    storeobj['kassierer'] = kassiererId;

    storeobj['kundennummer'] = $('#adresse').val();
    storeobj['addr'] = {};

    $('#ob1 span').each(function(i,e) {
      var tid = $(this).prop('id').split('t_');
      storeobj['addr'][tid[1]] = $('#'+tid[1]).val();
    });

    storeobj['addr']['infoauftragserfassung'] = $.base64Encode( $('#infoauftragserfassung_pos').val() );

    $.ajax({
      url: '',
      data: {
        module: 'pos',
        action: 'storecust',
        obj: storeobj
      },
      dataType: 'json',
      beforeSend: function() {
        App.loading.open();
      },
      success: function(data) {
        if (data.status == 1) {
          $('#adresse').val(data.kundennummer);
          loadAddr(data.kundennummer);
          $('#modaloverlay').hide(300); 

          $('#loadaddr input[type="radio"]').attr('checked', false);
          $('#loadaddr input[type="radio"]').removeAttr('checked');
          $('#loadaddr input[type="radio"]').first().attr('checked', true);

        } else {
          // TODO: Fehlermeldungen?
        }
        App.loading.close();

      }
    });


    /*

    $('#ob1 span').each(function(i,e) {
      var tid = $(this).prop('id').split('t_');
      $(this).html($('#'+tid[1]).val());
    });

    */

    saveCust = true;

  });
  
  $('#xbutt, #abortcust').click(function() { $('#modaloverlay').hide(300); });

  
  
  $('#typ').change(function() {
    var namein = $('#name').parent();
    var nameinfo = namein.prev();
    var ansprow = namein.parent().next();
    if($(this).val() == "firma") {
      nameinfo.html('Firmenname');
      $('#ansprtit').show();
      $('#ansprechpartner').show();
    } else {
      nameinfo.html('Vor- und Nachname');
      $('#ansprtit').hide();
      $('#ansprechpartner').hide();
    }
  });
  
  
  $('#loadart').submit(function() {

    var adresseId = $('#adresse').val();
    var artean = $('#artikelnummerprojekt').val(); 
    if(!artean) return false;
    $.getJSON( '', {
      module: "pos",
      action: "loadart",
      artean: artean,
      kassenkennung: kassiererId,
      addrid: adresseId
    }).done(function( jdata ) {
      if(jdata.check) {alert('Artikel nicht gefunden'); return false; }
      addarticle(jdata);
      $('#artikelnummerprojekt').val('');
    });
    return false;
  });
  
  // @TODO: Chrome hat scheinbar probleme mit .prop()
  if (is_chrome) {
    $('input[value="sk"]').attr('checked', '');
  }

  tinyMCEsetup();

  // Ende document.ready
  });
  
  
  function checkStammkunde(a_kundennummer, a_kassiererId) {

    var output;

    $.ajax({
      url: '',
      async: false,
      data: {
        module: 'pos',
        action: 'checkstammkunde',
        kundennummer: a_kundennummer,
        kassierer: a_kassiererId
      },
      dataType: 'json'
    }).done(function(jdata) {
      output = jdata;
    });

    if (typeof output.status && output.status == true) {
      return true;
    }

    return false;

  }
  
  function loadAddr(kunr) {
    $.getJSON( '', {
      module: "pos",
      action: "loadaddr",
      kunr: kunr
    }).done(function( jdata ) {
      var ktype = $('input[name=ktype]:checked').val();
      if(jdata.check!="ERR" && ktype=='sk') {
        $.each(jdata, function(i, e) {        
          $('#ob1 #t_'+i).html(e);
        $('#adjcust').show();

          if (i == 'infoauftragserfassung') {
            $('#infoauftragserfassung_pos').val(e);
            if(e!='')
            {
              tinyMCE.get('infoauftragserfassung_pos').setContent(e);
            }
          } else {
            $('#modalcont').find('#' + i).val(e);            
          }

          if(i=='typ')
          {
            var namein = $('#name').parent();
            var nameinfo = namein.prev();
            if(e=='firma')       
              nameinfo.html('Firmenname');
            else
              nameinfo.html('Vor- und Nachname');
          }
        });
        // $('#inbem').val(jdata['infoauftragserfassung']);
        $('#artikelnummerprojekt').focus();
      } else {
        $('#adresse').val('');
	if(ktype=="sk")
	{
          alert('Kein Kunde gefunden');
	}
      }
    });  
  }  
  
  
  
  function addarticle(jdata) {
    var newart = $('#defart').clone();
    newart.attr('id', jdata['id']);
    delete(jdata['id']);
    
    var tpreis = jdata['preis'];
    jdata['preis'] = tpreis.replace(',','.');
    jdata['preis'] = Math.round(jdata['preis'] * 100) / 100;
    if('amount' in jdata) {
      newart.find('.amount').val(jdata['amount']);
      delete(jdata['amount']);
    }
    if('rabatt' in jdata) {
      newart.find('.rabatt').val(parseFloat(jdata['rabatt']).toFixed(0));
      delete(jdata['rabatt']);
    }
    
    jQuery.each(jdata, function(i,e) {
      newart.find('.'+i).html(e);
    });

    var preisAusgabe = parseFloat(newart.find('.preis').html()).toFixed(2).replace('.',',');
    var preisHtml = '';
    preisHtml += '<table width="100%" cellspacing="0" cellpadding="0">';

      preisHtml += '<tr class="preisNormal">';
        preisHtml += '<td>';
          preisHtml += preisAusgabe;
        preisHtml += '</td>';

        preisHtml += '<td>';
          preisHtml += '<a class="preisEditLink" href="javascript:;" onclick="changeArtikelPreis(this)"><img src="themes/new/images/edit.png" border="0" valign="middle"></a>';
        preisHtml += '</td>';
      preisHtml += '</tr>';

      preisHtml += '<tr class="preisEdit" style="display: none;">';
        preisHtml += '<td>';
          preisHtml += '<input type="text" name="preis" value="' + preisAusgabe + '" size="6">';
        preisHtml += '</td>';

        preisHtml += '<td>';
          //preisHtml += '<a class="preisSaveLink" href="javascript:;" onclick="saveArtikelPreis(this);"><img src="themes/new/images/edit.png" border="0" valign="middle"></a>';
        preisHtml += '</td>';
      preisHtml += '</tr>';

    preisHtml += '</table>';

    newart.find('.preis').html(preisHtml);

    // newart.find('.preis').html('<span class="preisNormal">' + preisAusgabe + '</span>');
    // newart.find('.preis').append('<a class="preisEditLink"><img src="themes/new/images/edit.png" border="0" valign="middle"></a>');
    // newart.find('.preis').append('<span class="preisEdit"><input type="text" name="preis" value="' + preisAusgabe + '" size="6" style="display:none;"></span>');

    var ges = ''+jdata['preis'];
    newart.find('.gesamt').html(ges.replace('.',','));
    newart.find('.nr').html($('#wk > tbody > tr').length + 1);
    newart.attr('title',jdata['kurztext_de']);

    $('#wk > tbody ').append(newart);
    $('#wkcontainer').animate({scrollTop : $('#wkcontainer').height()},800);
    
    grabatt = 0;
    $('#wk > tbody > tr').each(function() {
      updatearttotal($(this));
    });
    updatetotals();
    grabatt = 0;
    
    $('#artikelnummerprojekt').focus();
    
    
    // löschen eines Eintrags
    $('.delwkart').on('click', function() {
      // Zeilen neu nummerieren
      var row = $(this).parent().parent();
      var table = row.parent();
      row.remove();
      table.find('.nr').each(function(i) {
        $(this).html(i+1);
      });
      
      grabatt = 0;
      $('#wk > tbody > tr').each(function() {
        updatearttotal($(this));
      });
      updatetotals();
      grabatt = 0;
      
      $('#artikelnummerprojekt').focus();
      return false;
    });
    
    
    
    // Verändern der Produktmenge
    $('.amount').on('keyup', function() {
      if(!$(this).val()) return;
      grabatt = 0;
      $('#wk > tbody > tr').each(function() {
        updatearttotal($(this));
      });
      updatetotals();
      grabatt = 0;
    });

    $('.preisEdit input').on('keyup', function() {
      if(!$(this).val()) return;
      $('#wk > tbody > tr').each(function() {
        updatearttotal($(this));
      });
      updatetotals();
    });

    // Verändern des Rabatts
    $('.rabatt').on('keyup', function(event) {

      var newval;
      var oldval = parseFloat($(this).val());

      if (event.which == 38) {
        newval = oldval+1;
      } else if (event.which == 40) {
        newval = oldval-1;
      } else {
       newval = $(this).val().replace(/[^0-9\.]/g,'');
      }

      if (newval < 0 || newval.length == 0) {
        newval = 0;
      }

      if (newval > 100) {
        newval = 0;
      }

      $(this).val(newval);
    });

    $('.rabatt').on('keyup', function() {
      if(!$(this).val()) return;
      grabatt = 0;
      $('#wk > tbody > tr').each(function() {
        updatearttotal($(this));
      });
      updatetotals();
      grabatt = 0;
    });
  }

  
  function updatearttotal(art) {
    var rabatt = parseFloat(art.find('.rabatt').val()) / 100;
    // var total = parseFloat(art.find('.preis').html().replace(',','.')) * parseInt(art.find('.amount').val());

    var preis = art.find('.preis input').val();
    if (typeof preis == "undefined") {
      return;
    }

    var amount = art.find('.amount').val();
    var total = parseFloat( preis.replace(',', '.') * parseInt(amount) )

    lrabatt = total * rabatt;
    grabatt += lrabatt;
    art.data('total',total);
    total -= lrabatt;
    
    total = total.toFixed(2);
    art.find('.gesamt').html(total.replace('.',','));
  }
  
  
  function updatetotals() {
    totaltaraNorm = 0.0;
    totaltaraErm = 0.0;
    totalbrutto = 0.0;
    totalnetto = 0.0;
    
    $('#wk > tbody > tr').each(function(i,e) {
      var tbrutto = parseFloat($(this).data('total')); // find('.gesamt').html());
      // var tmwst = parseFloat($(this).find('.tax').html());
      // var tara = (tbrutto / 100) * tmwst;
      var tmwst = parseFloat($(this).find('.tax').html());
      var ltmwst = (tmwst + 100) / 100;
      var tnetto = tbrutto / ltmwst;
      tnetto = Math.round(tnetto * 100) / 100;
      var tara = tbrutto - tnetto;

      var taxnorm = parseInt($('#taxnorm').html());
      var taxerm  = parseInt($('#taxerm').html());
      if(tmwst == taxnorm)      totaltaraNorm += tara;
      else if(tmwst == taxerm)  totaltaraErm += tara;
      totalbrutto += tbrutto;
      totalnetto += tnetto;
    });

    grabatt     = parseFloat(grabatt);
    grabatteur  = parseFloat(grabatteur);


    // Minimal 0
    if (grabatteur.length == 0 || isNaN(grabatteur)) {
      grabatteur = 0;
    }

    // Minimal 0
    if (grabatt.length == 0 || isNaN(grabatt)) {
      grabatt = 0;
    }

    var totaltotal = totalbrutto - grabatt - grabatteur;
    
    /*
    totaltara19 = Math.round(totaltara19 * 100) / 100;
    totaltara7 = Math.round(totaltara7 * 100) / 100;
    totalbrutto = Math.round(totalbrutto * 100) / 100;
    totalnetto = Math.round(totalnetto * 100) / 100;
    */
    
    totaltaraNorm = totaltaraNorm.toFixed(2);
    totaltaraErm  = totaltaraErm.toFixed(2);
    totalbrutto = totalbrutto.toFixed(2);
    totalnetto  = totalnetto.toFixed(2);
    totaltotal  = totaltotal.toFixed(2);
    grabatt     = grabatt.toFixed(2);
    grabatteur  = grabatteur.toFixed(2);
    
    
    $('#sunetto').  html(totalnetto.replace('.',','));
    $('#taranorm').   html(totaltaraNorm.replace('.',','));
    $('#taraerm').    html(totaltaraErm.replace('.',','));
    $('#subrutto'). html(totalbrutto.replace('.',','));
    $('#trabatt').  html('-' + grabatt.replace('.',','));
    $('#trabatteur').html('-' + grabatteur.replace('.',','));
    $('#sutotal').  html(totaltotal.replace('.',','));
  }
  
  

  
  function storePOSSession(actioncomm) {

    var storeobj = {};
    storeobj['kasid'] = $('#tabs-1').data('on');
    if ($("#tabs-1").data('sid')) storeobj['sid'] = $("#tabs-1").data('sid');
  
    storeobj['addr'] = {};
    
    $('#ob1 span').each(function(i,e) {
      var tid = $(this).prop('id').split('t_');
      storeobj['addr'][tid[1]] = $(this).html();
    });
    // storeobj['addr']['land'] = $('#ob1 #t_land').html();
   
    if(actioncomm=="finsess")
    storeobj['addr']['infoauftragserfassung'] = $.base64Encode( $('#infoauftragserfassung_pos').val() );
    else
    storeobj['addr']['infoauftragserfassung'] = $('#infoauftragserfassung_pos').val();
    // ENDE ANPASSUNG FUER Uebertragung HTML in JSON 

    //storeobj['addr']['infoauftragserfassung'] = $('#infoauftragserfassung_pos').val();
    
    storeobj['addrid'] = $('#adresse').val();
    var ktype = $('input[name=ktype]:checked').val();
    
    if(ktype == 'lk') storeobj['addrid'] = lkaddr;
    else if(ktype == 'nk') storeobj['addrid'] = 'NEW';
    
    storeobj['addrstore'] = "nostore";
    if($('#storenewcust').is(':checked')) storeobj['addrstore'] = "store";
    if (saveCust) {
      storeobj['addrstore'] = "store";
      saveCust = false;
    }
    storeobj['wk'] = [];
    $('#wk > tbody > tr').each(function(i,e) {
      var nart = {};
      nart['id']      = $(this).prop('id');
      nart['artikel'] = $(this).find('.artikel').html().replace(/\"/g,'&quot;');
      nart['kurztext_de'] = $(this).prop('title').replace(/\"/g,'&quot;');
      nart['nummer']  = $(this).find('.nummer').html();
      nart['tax']     = $(this).find('.tax').html();
      nart['preis']   = $(this).find('.preis').find('input').val();
      
      nart['amount']  = $(this).find('.amount').val();
      nart['rabatt']  = $(this).find('.rabatt').val();

      storeobj['wk'].push(nart);
    });
    
    
    storeobj['ptype']   = $('#payment input[name=ptype]:checked').val();
    storeobj['rtype']   = $('#retyp input[name=rtype]:checked').val();
    
    storeobj['inbem']   = $('#inbem').val();
    storeobj['freit']   = $('#freit').val();
    grStr = $('#grabatt').html();
    grArr = grStr.split('%');
    storeobj['grabatt'] = grArr[0];
    storeobj['grabatteur'] = grabatteur;
    
    storeobj['kassiererId'] = kassiererId;

    var jsonString = JSON.stringify(storeobj);
    

    $.getJSON( '', {
      module: "pos",
      action: actioncomm,
      sessdata: jsonString
    }).done(function( jdata ) {
      if(actioncomm == 'finsess') $('#finconfconf').dialog('open');
      else if(actioncomm == 'resetsess') resetFields();
      else $('#storeconfconf').dialog('open');
      
      $('#artikelnummerprojekt').focus();
    });
  }
    
    
    
  function loadPOSSession(kasid) {
    // check for pending sessions
    $.getJSON( '', {
      module: "pos",
      action: "loadsess",
      kasid: kasid
    }).done(function( jdata ) {

      // no stored session found
      if('check' in jdata && jdata['check'] == "noss") {
        return false;
      }
    
      if('sid' in jdata) {
        $("#tabs-1").data('sid', jdata['sid']);
      }
  
      if (jdata.kassiererId != kassiererId) {
        kassiererId = jdata.kassiererId;
      }

      $.each(jdata['addr'], function(i, e) {
        $('#ob1 #t_'+i).html(e);
      });
      // set address radio button accordingly
      //$('input[name=ktype]').removeProp('checked');
      // Kundenid aus input "Stammkunde" löschen, falls neuer kunde oder laufkundschaft
      $('#adresse').val('');
      if(jdata['addrid'] == "NEW") {
        $('input[name=ktype][value=nk]').prop('checked',true);
      } else if(jdata['addrid'] == lkaddr) {
        //$('#adjcust').show();
        $('input[name=ktype][value=lk]').prop('checked',true);
      } else {
        $('#adjcust').show();
        $('input[name=ktype][value=sk]').prop('checked',true);
        $('#adresse').val(jdata['addrid']);
      }

      // Warenkorb Anfang
      $.each(jdata['wk'], function(i,e) {
        addarticle(e);
      });
      
      if(jdata['grabatt']) {
        $('#wk tbody .rabatt').val(jdata['grabatt']);
        $("#grabatt").val(jdata['grabatt']+'%');
      }
      if(jdata['grabatteur']) {
        grabatteur = jdata['grabatteur'];
      }
      
      grabatt = 0;
      $('#wk > tbody > tr').each(function() {
        updatearttotal($(this));
      });
      updatetotals();
      grabatt = 0;
      // Warenkorb Ende
      
      $("#"+jdata['ptype']).prop('checked','checked');
      $("#"+jdata['rtype']).prop('checked','checked');

      if (typeof jdata.inbem != "undefined") {
        $("#inbem").val(jdata.inbem);  
      }
      if (typeof jdata.freit != "undefined") {
        $("#freit").val(jdata.freit);  
      }
      /*
      $("#inbem").val(jdata['inbem']);
      $("#freit").val(jdata['freit']);
      */
      
      $('#artikelnummerprojekt').focus();
    });

  }
    
    
  function logoutkas() {
    $.getJSON( '', {
      module: "pos",
      action: "logoutkass"
    }).done(function( jdata ) {
      $('#tabs-1 input').prop('disabled','disabled');
      $('#loadkass input').removeAttr('disabled');
      $('#tabs-1').removeData('on');
      // $('#logoutkas').hide();
      $('#loggedinkas').html('');
      $('#filiale').html('');
      $('#kashin').dialog('open'); 
    });
  }
  
  
  function loginkas(kanr) {

    if ($("#tabs-1").data('on')) {
      if($("#tabs-1").data('on') == kanr) {
        alert('Kassierer ist bereits angemeldet');
        return false;
      }
      storePOSSession('storesess');
      resetFields();
      $('#tabs-1').removeData('on');
    }
    
    $.getJSON( '', {
      module: "pos",
      action: "loadkass",
      kanr: kanr
    }).done(function( data ) {

      if(data.check != "ERR") {
        $('#tabs-1 input').removeAttr('disabled');
        $('#tabs-1').data('on',kanr);
        lkaddr = data.lkadresse; 
        // $('#logoutkas').show();
        $('#loggedinkas').html(' ' + data.kname);
        $('#filiale').html(' ' + data.filiale);
        //$('#kanr').html(kanr);
        kassiererId = kanr;

        loadPOSSession(kanr);
        window.location.reload();
      } else {
        kassiererId = null;
        alert('Kassierer nicht vorhanden');
        logoutkas();
      }
    });
  }
  
    
  function resetFields() {
    
    // Adressen Felder
    $('#modalcont input[type=text]').val('');
    $('#ob1 span').html('');
    $('#adresse').val('');
    $('input[name=ktype]').removeProp('checked');
    $('input[name=ktype][value=sk]').prop('checked',true);
    
    $('#wk tbody').html('');
    $('#grabatt').text('0%');

    grabatteur = '0.00';
    grabatteur = parseFloat(grabatteur.replace(',','.'));

    grabatt = '0.00';
    grabatt = parseFloat(grabatt.replace(',','.'));

    // $('#trabatteur').val(0.0);
    // $('#trabatteur').text('0.0);

    grabatt = 0;
    updatetotals();
    $('#artikelnummerprojekt').val('');
    
    
    $('#inbem').val('');
    $('#freit').val('');
    
    
    $('#payment input:checked').prop('checked', false);
    $('#retyp input:checked').prop('checked', false);
    if(!zahlungselzwang) $($('#payment input[name=ptype]')[0]).prop('checked', true);
    $($('#retyp input[name=rtype]')[0]).prop('checked', true);
    
    $("#tabs-1").removeData('sid');

  }

function tinyMCEsetup() {

  

  tinyMCE.init({
  selector: '#infoauftragserfassung_pos',
  mode: "textareas",
  theme: "modern",
  menubar: false,
  statusbar: false,
  toolbar_items_size: 'small',
  width: "100%",
  entity_encoding: "raw",
  element_format: "html",
  force_br_newlines: true,
  force_p_newlines: false,
  plugins: [ "textcolor" ],
  toolbar1: "bold italic underline strikethrough |  styleselect formatselect fontsizeselect | searchreplace | forecolor backcolor | restoredraft",
  toolbar2: "",
  toolbar3: "",
  setup: function (editor) {
      editor.on('keyup', function () {

          $('textarea#infoauftragserfassung_pos').val(tinyMCE.get('infoauftragserfassung_pos').getContent());


      });
    }
  });

}
 
function changeArtikelPreis(container) {

  var elem = $(container);
  elem.parent().parent().next().show();
  elem.parent().parent().hide();

  elem.parent().parent().next().find('input').focus();
  elem.parent().parent().next().find('input').keydown(function(e) {

    if (e.which == 13) {

      var newVal = $(this).val();
      if (newVal == '') {
        newVal = 0;
      }

      newVal = newVal.replace(',', '.');
      newVal = parseFloat(newVal).toFixed(2);
      newVal = newVal.replace('.', ',');

      $(this).parent().parent().prev().children('td').first().text( newVal );
      $(this).parent().parent().hide();
      $(this).parent().parent().prev().show();

    } else if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 188]) !== -1 ||
       // Allow: Ctrl+A, Command+A
      (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
       // Allow: home, end, left, right, down, up
      (e.keyCode >= 35 && e.keyCode <= 40)) {
       // let it happen, don't do anything
       return;
    }

    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }

  });

  elem.parent().parent().next().find('input').focusout(function() {

    var newVal = $(this).val();
    if (newVal == '') {
      newVal = 0;
    }


    newVal = newVal.replace(',', '.');
    newVal = parseFloat(newVal).toFixed(2);
    newVal = newVal.replace('.', ',');

    $(this).parent().parent().prev().children('td').first().text( newVal );
    $(this).parent().parent().hide();
    $(this).parent().parent().prev().show();
    
  });
} 

