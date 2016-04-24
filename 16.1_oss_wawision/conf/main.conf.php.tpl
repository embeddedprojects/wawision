<?php
    
//database connection
class Config {
    
  function Config() 
  {
    @session_start();
    include("user.inc.php");
    
    // define defaults
    $this->WFconf['defaultpage'] = 'adresse';
    $this->WFconf['defaultpageaction'] = 'list';
    $this->WFconf['defaulttheme'] = 'new';
    //$this->WFconf['defaulttheme'] = 'default_redesign';
    $this->WFconf['defaultgroup'] = 'web';
    
    // allow that cols where dynamically added so structure
    $this->WFconf['autoDBupgrade']=true;
    
    // time how long a user can be connected in seconds genau 8 stunden
    $this->WFconf['logintimeout'] = 3600 * 4;
    
    // alle vorhanden Gruppen in diesem System
    $this->WFconf['groups'] = array('web','admin','mitarbeiter');
    
    // gruppen die sich anmelden muessen
    $this->WFconf['havetoauth'] = array('admin','mitarbeiter');
    
    //menu structure
    
    $this->WFconf['permissions']['mitarbeiter']['hauptmenu'] = array('list');
    $this->WFconf['permissions']['mitarbeiter']['welcome'] = array('login','main','logout','vorgang','removevorgang','editvorgang');
    $this->WFconf['permissions']['mitarbeiter']['zeiterfassung'] = array('list','create','edit','delete','buchen','arbeitspaket','details');
  //  $this->WFconf['permissions']['mitarbeiter']['ticket'] = array('list','create','edit','delete','assistent','antwort','freigabe','beantwortet');
  //  $this->WFconf['permissions']['mitarbeiter']['dateien'] = array('list','create','edit','send');
    $this->WFconf['permissions']['mitarbeiter']['ajax'] = array('filter','table','tableposition','tooltipsuche');
//    $this->WFconf['permissions']['mitarbeiter']['bestellung'] = array('list','create','edit','positionen','positioneneditpopup','abschicken','protokoll','pdf',
 //     'addposition','upbestellungposition','downbestellungposition','delbestellungposition','copy');

    

    $this->WFconf['permissions']['verwaltung']['hauptmenu'] = array('list');
    $this->WFconf['permissions']['verwaltung']['wiki'] = array('list','edit','create');
    $this->WFconf['permissions']['verwaltung']['ajax'] = array('filter','table','tableposition','tooltipsuche','lieferadresse','ansprechpartner');
    $this->WFconf['permissions']['verwaltung']['welcome'] = array('login','main','logout','vorgang','removevorgang','editvorgang');
    $this->WFconf['permissions']['verwaltung']['dateien'] = array('list','create','edit','send');
    $this->WFconf['permissions']['verwaltung']['ticket'] = array('list','create','edit','delete','assistent','antwort','freigabe','beantwortet');
    $this->WFconf['permissions']['verwaltung']['kalender'] = array('list','create','edit','delete','anstehende');
    $this->WFconf['permissions']['verwaltung']['zeiterfassung'] = array('list','create','edit','delete','buchen','arbeitspaket','details');
    $this->WFconf['permissions']['verwaltung']['wareneingang'] = array('list','create','edit','paketannahme','paketabsender','paketzustand','paketetikett',
      'paketabschliessen','distribution','distriinhalt','distrietiketten','distriabschluss');
    $this->WFconf['permissions']['verwaltung']['versanderzeugen'] = array('main','list','offene','einzel','frankieren');
    $this->WFconf['permissions']['verwaltung']['lager'] = array('list','create','edit','delete','etiketten','platz','platzeditpopup','bewegung','bestand','inventur','bewegungpopup','zwischenlager','produktionslager','regaletiketten','reservierungen','buchen','buchenzwischenlager','bucheneinlagern','buchenauslagern','artikelfuerlieferungen','ausgehend');
     $this->WFconf['permissions']['verwaltung']['adresse'] = array('list','create','edit','delete','suchmaske','briefpdf','brief','email','lieferadresse','lieferadresseneu', 'dateien',
      'lieferadresseedit','ustprf','ustprfneu','ustprfedit','rolecreate','roledel','lieferadresseneditpopup','briefeditpopup','emaileditpopup','lieferantvorlage','artikel','artikeleditpopup','rolledelete','offenebestellungen','kontakthistorie','ansprechpartner','ansprechpartnereditpopup','kontakthistorieeditpopup','kontakthistorie','kundevorlage','auftraege');
    $this->WFconf['permissions']['verwaltung']['angebot'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf',
      'addposition','upangebotposition','downangebotposition','delangebotposition','copy','freigabe','auftrag');

    $this->WFconf['permissions']['verwaltung']['lieferschein'] = array('pdf');
    $this->WFconf['permissions']['verwaltung']['etikettendrucker'] = array('list');
    $this->WFconf['permissions']['verwaltung']['rechnung'] = array('pdf');
    $this->WFconf['permissions']['verwaltung']['kasse'] = array('list','edit','create','exportieren');

    $this->WFconf['permissions']['verwaltung']['auftrag'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf','verfuegbar',
      'addposition','upauftragposition','downauftragposition','delauftragposition','copy','freigabe','rechnung','lieferschein','versand','teilversand','nachlieferung','reservieren','search','uststart','zahlungsmail','checkdisplay');
     $this->WFconf['permissions']['verwaltung']['artikel'] = array('list','create','edit','delete','etiketten','verkauf','verkaufeditpopup',
      'stueckliste','provison','projekte','lager','seriennummern','offenebestellungen','offeneauftraege','dateien','wareneingang','upstueckliste','downstueckliste','editstueckliste','reservierung','verkaufdelete','onlineshop','newlist','delstueckliste','ajaxwerte');
 
 $this->WFconf['permissions']['verwaltung']['gutschrift'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf',
      'addposition','upgutschriftposition','downgutschriftposition','delgutschriftposition','copy','freigabe','storno');
    $this->WFconf['permissions']['verwaltung']['rechnung'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','search','pdf',
      'addposition','uprechnungposition','zahlungsmahnungswesen','downrechnungposition','delrechnungposition','copy','freigabe','gutschrift','mahnwesen','mahnweseneinstellungen','lastschrift','dta','stop','skonto','destop','mahnpdf');


    // permissions welcome
    $this->WFconf['permissions']['web']['welcome'] = array('login','main','logout');
    $this->WFconf['permissions']['vollzugriff']['hauptmenu'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['welcome'] = array('login','main','logout','vorgang','removevorgang','editvorgang');
    $this->WFconf['permissions']['vollzugriff']['netzwerk'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['ajax'] = array('filter','table','tableposition','tooltipsuche');
    $this->WFconf['permissions']['vollzugriff']['bestellvorschlag'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['wizard'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['stornierungen'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['firmendaten'] = array('edit');                   
    $this->WFconf['permissions']['vollzugriff']['geraete'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['einstellungen'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['wdcalendar'] = array('list','cmd','edit');
    $this->WFconf['permissions']['vollzugriff']['backup'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['paketmarke'] = array('create','tracking');
    $this->WFconf['permissions']['vollzugriff']['buchhaltung'] = array('preview');
    $this->WFconf['permissions']['vollzugriff']['marketing'] = array('list','kampangen','kampangenedit','kampangenanlegen','kampangenpopup','kampangendelete');
    $this->WFconf['permissions']['vollzugriff']['verkaufszahlen'] = array('list','details');
    $this->WFconf['permissions']['vollzugriff']['katalog'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['mailing'] = array('list');
    $this->WFconf['permissions']['vollzugriff']['rechnungslauf'] = array('rechnungslauf','artikel');
    $this->WFconf['permissions']['vollzugriff']['massenartikel'] = array('edit','main','pdf','createpdf');
    $this->WFconf['permissions']['vollzugriff']['uebersetzung'] = array('edit','main');
    $this->WFconf['permissions']['vollzugriff']['versanderzeugen'] = array('main','list','offene','einzel','frankieren');
    $this->WFconf['permissions']['vollzugriff']['wiki'] = array('list','edit','create');

    //$this->WFconf['permissions']['vollzugriff']['rechnung'] = array('login','main','logout','list','edit','create','suchen','storno');
    $this->WFconf['permissions']['vollzugriff']['verbindlichkeit'] = array('login','main','logout','list','edit','create','suchen','storno','bezahlt');

    $this->WFconf['permissions']['vollzugriff']['dateien'] = array('list','create','edit','delete','send','delete');
    $this->WFconf['permissions']['vollzugriff']['wareneingang'] = array('list','create','edit','delete','paketannahme','paketabsender','paketzustand','paketetikett',
      'paketabschliessen','distribution','distriinhalt','distrietiketten','distriabschluss','rmalist','rmadetail');
    $this->WFconf['permissions']['vollzugriff']['bestellung'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf',
      'addposition','upbestellungposition','downbestellungposition','delbestellungposition','copy','freigabe','minidetail','editable');
    $this->WFconf['permissions']['vollzugriff']['angebot'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf','livetabelle',
      'addposition','upangebotposition','downangebotposition','delangebotposition','copy','freigabe','auftrag','minidetail','editable');
    $this->WFconf['permissions']['vollzugriff']['lieferschein'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf','livetabelle',
      'addposition','uplieferscheinposition','downlieferscheinposition','dellieferscheinposition','copy','freigabe','minidetail','editable');
    $this->WFconf['permissions']['vollzugriff']['rechnung'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','search','pdf','livetabelle',
      'addposition','uprechnungposition','zahlungsmahnungswesen','downrechnungposition','delrechnungposition','copy','freigabe','gutschrift','mahnwesen','mahnweseneinstellungen','lastschrift','dta','stop','skonto','destop','mahnpdf','minidetail','editable');
    $this->WFconf['permissions']['vollzugriff']['auftrag'] = array('list','create','edit','editable','delete','positionen','minidetail','positioneneditpopup','abschicken','protokoll','pdf','verfuegbar','livetabelle','proforma','tracking',
      'addposition','upauftragposition','downauftragposition','delauftragposition','copy','freigabe','rechnung','lieferschein','versand','teillieferung','nachlieferung','reservieren','search','uststart','zahlungsmail','checkdisplay','ausversand','zahlungsmahnungswesen','berechnen');

    $this->WFconf['permissions']['vollzugriff']['gutschrift'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf','livetabelle',
      'addposition','upgutschriftposition','downgutschriftposition','delgutschriftposition','copy','freigabe','storno','minidetail','editable');


    $this->WFconf['permissions']['vollzugriff']['ticket'] = array('list','create','edit','delete','assistent','antwort','freigabe','beantwortet');
    $this->WFconf['permissions']['vollzugriff']['lohnabrechnung'] = array('list','monatsuebersicht');
    $this->WFconf['permissions']['vollzugriff']['zeiterfassung'] = array('list','create','edit','delete','buchen','arbeitspaket','details');

    $this->WFconf['permissions']['vollzugriff']['kunden'] = array('list','create','edit','delete','rechnungen','archiv','kontakt','artikel','angebotlist','auftraglist','rechnungenlist');

    $this->WFconf['permissions']['vollzugriff']['emailbackup'] = array('list','create','edit','delete','show','read');
    $this->WFconf['permissions']['vollzugriff']['partner'] = array('list','create','edit','delete','show','read');
    $this->WFconf['permissions']['vollzugriff']['zahlungseingang'] = array('list','minidetail','deutschebank','paypal','kreditkarte','bar','postbank','vorkasse','deutschebank1','deutschebank2','bucheneditpopup','onlinebanking','auftrag','editzeile');

    //$this->WFconf['permissions']['vollzugriff']['rechnung'] = array('list','create','edit','delete','show','offen','mahnwesen','zahlungseingang','rechnungslauf','artikel');
    //$this->WFconf['permissions']['vollzugriff']['rechnung'] = array('list','create','edit','delete','show','offen','mahnwesen','zahlungseingang','rechnungslauf','artikel');
    $this->WFconf['permissions']['vollzugriff']['kalender'] = array('list','create','edit','delete','anstehende');
    $this->WFconf['permissions']['vollzugriff']['webmail'] = array('list','create','edit','delete','lesen','view','schreiben','einstellungen','suchen','allegelesen','minidetail');
    $this->WFconf['permissions']['vollzugriff']['aufgaben'] = array('list','create','edit','delete','editpopup','editpopupi','kalender');
    $this->WFconf['permissions']['vollzugriff']['shopexport'] = array('list','create','edit','export','navigation');
    $this->WFconf['permissions']['vollzugriff']['shopimport'] = array('list','import');
    $this->WFconf['permissions']['vollzugriff']['kasse'] = array('list','edit','create','exportieren');
    $this->WFconf['permissions']['vollzugriff']['prozessstarter'] = array('list','edit','create');
    $this->WFconf['permissions']['vollzugriff']['drucker'] = array('list','edit','create');
    $this->WFconf['permissions']['vollzugriff']['onlineshops'] = array('list','edit','create');
    $this->WFconf['permissions']['vollzugriff']['artikelgruppen'] = array('list','edit','create');
    $this->WFconf['permissions']['vollzugriff']['benutzer'] = array('list','edit','create');
    $this->WFconf['permissions']['vollzugriff']['konten'] = array('list','edit','create');
    $this->WFconf['permissions']['vollzugriff']['geschaeftsbrief_vorlagen'] = array('list','edit','create');
    $this->WFconf['permissions']['vollzugriff']['inhalt'] = array('list','edit','create');
    $this->WFconf['permissions']['vollzugriff']['ticket_vorlage'] = array('list','edit','create','delete');
    $this->WFconf['permissions']['vollzugriff']['kontoblatt'] = array('list','edit','create','exportieren','datev','experte','fehlende','editable');

    $this->WFconf['permissions']['vollzugriff']['adresse'] = array('list','create','edit','delete','suchmaske','briefpdf','brief','email','lieferadresse','lieferadresseneu', 'dateien','rollen',
      'lieferadresseedit','ustprf','ustprfneu','ustprfedit','rolecreate','roledel','lieferadresseneditpopup','briefeditpopup','emaileditpopup','lieferantvorlage','artikel','artikeleditpopup','rolledelete','offenebestellungen','kontakthistorie','ansprechpartner','ansprechpartnereditpopup','kontakthistorieeditpopup','kontakthistorie','kundevorlage','downartikel','upartikel','delartikel','auftraege','addposition','positioneneditpopup','ansprechpartnerpopup','lieferadressepopup','ustpopup','lieferantartikel','autocomplete','briefdelete','adressebestellungmarkieren');
    
    $this->WFconf['permissions']['vollzugriff']['artikel'] = array('list','create','edit','delete','copy','etiketten','verkauf','einkauf','einkaufdelete','einkaufcopy','verkaufeditpopup','einkaufeditpopup',
      'stueckliste','provison','projekte','lager','seriennummern','offenebestellungen','offeneauftraege','dateien','wareneingang','upstueckliste','downstueckliste','editstueckliste','reservierung','verkaufcopy','verkaufdelete','onlineshop','newlist','delstueckliste','ajaxwerte','auslagern','profisuche');
    $this->WFconf['permissions']['vollzugriff']['lager'] = array('list','create','edit','delete','etiketten','platz','platzeditpopup','bewegung','bestand','inventur','bewegungpopup','zwischenlager','produktionslager','regaletiketten','reservierungen','buchen','buchenzwischenlager','bucheneinlagern','buchenauslagern','artikelfuerlieferungen','ausgehend','artikelentfernen','artikelentfernenreserviert');
    
    $this->WFconf['permissions']['vollzugriff']['projekt'] = array('list','create','edit','delete','arbeitspaket','arbeitspaketeditpopup','dateien','kostenstellen','schaltung','zeit','material');


    // permissions welcome
    $this->WFconf['permissions']['web']['welcome'] = array('login','main','logout');
    $this->WFconf['permissions']['admin']['hauptmenu'] = array('list');
    $this->WFconf['permissions']['admin']['welcome'] = array('login','main','logout','vorgang','removevorgang','editvorgang');
    $this->WFconf['permissions']['admin']['netzwerk'] = array('list');
    $this->WFconf['permissions']['admin']['ajax'] = array('filter','table','tableposition','tooltipsuche');
    $this->WFconf['permissions']['admin']['bestellvorschlag'] = array('list');
    $this->WFconf['permissions']['admin']['wizard'] = array('list');
    $this->WFconf['permissions']['admin']['stornierungen'] = array('list');
    $this->WFconf['permissions']['admin']['firmendaten'] = array('edit');                   
    $this->WFconf['permissions']['admin']['geraete'] = array('list');
    $this->WFconf['permissions']['admin']['einstellungen'] = array('list');
    $this->WFconf['permissions']['admin']['wdcalendar'] = array('list','cmd','edit');
    $this->WFconf['permissions']['admin']['backup'] = array('list');
    $this->WFconf['permissions']['admin']['paketmarke'] = array('create','tracking');
    $this->WFconf['permissions']['admin']['buchhaltung'] = array('preview');
    $this->WFconf['permissions']['admin']['marketing'] = array('list','kampangen','kampangenedit','kampangenanlegen','kampangenpopup','kampangendelete');
    $this->WFconf['permissions']['admin']['verkaufszahlen'] = array('list','details');
    $this->WFconf['permissions']['admin']['katalog'] = array('list');
    $this->WFconf['permissions']['admin']['mailing'] = array('list');
    $this->WFconf['permissions']['admin']['rechnungslauf'] = array('rechnungslauf','artikel');
    $this->WFconf['permissions']['admin']['massenartikel'] = array('edit','main','pdf','createpdf');
    $this->WFconf['permissions']['admin']['uebersetzung'] = array('edit','main');
    $this->WFconf['permissions']['admin']['versanderzeugen'] = array('main','list','offene','einzel','frankieren');

    //$this->WFconf['permissions']['admin']['rechnung'] = array('login','main','logout','list','edit','create','suchen','storno');
    $this->WFconf['permissions']['admin']['verbindlichkeit'] = array('login','main','logout','list','edit','create','suchen','storno','bezahlt');

    $this->WFconf['permissions']['admin']['dateien'] = array('list','create','edit','delete','send','delete');
    $this->WFconf['permissions']['admin']['wareneingang'] = array('list','create','edit','delete','paketannahme','paketabsender','paketzustand','paketetikett',
      'paketabschliessen','distribution','distriinhalt','distrietiketten','distriabschluss','rmalist','rmadetail');
    $this->WFconf['permissions']['admin']['bestellung'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf',
      'addposition','upbestellungposition','downbestellungposition','delbestellungposition','copy','freigabe','minidetail','editable');
    $this->WFconf['permissions']['admin']['angebot'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf','livetabelle',
      'addposition','upangebotposition','downangebotposition','delangebotposition','copy','freigabe','auftrag','minidetail','editable');
    $this->WFconf['permissions']['admin']['lieferschein'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf','livetabelle',
      'addposition','uplieferscheinposition','downlieferscheinposition','dellieferscheinposition','copy','freigabe','minidetail','editable');
    $this->WFconf['permissions']['admin']['rechnung'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','search','pdf','livetabelle',
      'addposition','uprechnungposition','zahlungsmahnungswesen','downrechnungposition','delrechnungposition','copy','freigabe','gutschrift','mahnwesen','mahnweseneinstellungen','lastschrift','dta','stop','skonto','destop','mahnpdf','minidetail','editable');
    $this->WFconf['permissions']['admin']['auftrag'] = array('list','create','edit','editable','delete','positionen','minidetail','positioneneditpopup','abschicken','protokoll','pdf','verfuegbar','livetabelle','proforma','tracking',
      'addposition','upauftragposition','downauftragposition','delauftragposition','copy','freigabe','rechnung','lieferschein','versand','teillieferung','nachlieferung','reservieren','search','uststart','zahlungsmail','checkdisplay','ausversand','zahlungsmahnungswesen','berechnen');

    $this->WFconf['permissions']['admin']['gutschrift'] = array('list','create','edit','delete','positionen','positioneneditpopup','abschicken','protokoll','pdf','livetabelle',
      'addposition','upgutschriftposition','downgutschriftposition','delgutschriftposition','copy','freigabe','storno','minidetail','editable');




    $this->WFconf['permissions']['admin']['ticket'] = array('list','create','edit','delete','assistent','antwort','freigabe','beantwortet');
    $this->WFconf['permissions']['admin']['lohnabrechnung'] = array('list','monatsuebersicht');
    $this->WFconf['permissions']['admin']['zeiterfassung'] = array('list','create','edit','delete','buchen','arbeitspaket','details');

    $this->WFconf['permissions']['admin']['kunden'] = array('list','create','edit','delete','rechnungen','archiv','kontakt','artikel','angebotlist','auftraglist','rechnungenlist');

    $this->WFconf['permissions']['admin']['emailbackup'] = array('list','create','edit','delete','show','read');
    $this->WFconf['permissions']['admin']['partner'] = array('list','create','edit','delete','show','read');
    $this->WFconf['permissions']['admin']['zahlungseingang'] = array('list','minidetail','deutschebank','paypal','kreditkarte','bar','postbank','vorkasse','deutschebank1','deutschebank2','bucheneditpopup','onlinebanking','auftrag','editzeile');

    //$this->WFconf['permissions']['admin']['rechnung'] = array('list','create','edit','delete','show','offen','mahnwesen','zahlungseingang','rechnungslauf','artikel');
    //$this->WFconf['permissions']['admin']['rechnung'] = array('list','create','edit','delete','show','offen','mahnwesen','zahlungseingang','rechnungslauf','artikel');
    $this->WFconf['permissions']['admin']['kalender'] = array('list','create','edit','delete','anstehende');
    $this->WFconf['permissions']['admin']['webmail'] = array('list','create','edit','delete','lesen','view','schreiben','einstellungen','suchen','allegelesen','minidetail');
    $this->WFconf['permissions']['admin']['aufgaben'] = array('list','create','edit','delete','editpopup','editpopupi','kalender');
    $this->WFconf['permissions']['admin']['shopexport'] = array('list','create','edit','export','navigation');
    $this->WFconf['permissions']['admin']['shopimport'] = array('list','import');
    $this->WFconf['permissions']['admin']['kasse'] = array('list','edit','create','exportieren');
    $this->WFconf['permissions']['admin']['prozessstarter'] = array('list','edit','create');
    $this->WFconf['permissions']['admin']['drucker'] = array('list','edit','create');
    $this->WFconf['permissions']['admin']['onlineshops'] = array('list','edit','create');
    $this->WFconf['permissions']['admin']['artikelgruppen'] = array('list','edit','create');
    $this->WFconf['permissions']['admin']['benutzer'] = array('list','edit','create');
    $this->WFconf['permissions']['admin']['konten'] = array('list','edit','create');
    $this->WFconf['permissions']['admin']['geschaeftsbrief_vorlagen'] = array('list','edit','create');
    $this->WFconf['permissions']['admin']['inhalt'] = array('list','edit','create');
    $this->WFconf['permissions']['admin']['ticket_vorlage'] = array('list','edit','create','delete');
    $this->WFconf['permissions']['admin']['kontoblatt'] = array('list','edit','create','exportieren','datev','experte','fehlende','editable');

    $this->WFconf['permissions']['admin']['adresse'] = array('list','create','edit','delete','suchmaske','briefpdf','brief','email','lieferadresse','lieferadresseneu', 'dateien','rollen',
      'lieferadresseedit','ustprf','ustprfneu','ustprfedit','rolecreate','roledel','lieferadresseneditpopup','briefeditpopup','emaileditpopup','lieferantvorlage','artikel','artikeleditpopup','rolledelete','offenebestellungen','kontakthistorie','ansprechpartner','ansprechpartnereditpopup','kontakthistorieeditpopup','kontakthistorie','kundevorlage','downartikel','upartikel','delartikel','auftraege','addposition','positioneneditpopup','ansprechpartnerpopup','lieferadressepopup','ustpopup','lieferantartikel','autocomplete','briefdelete','adressebestellungmarkieren');
    
    $this->WFconf['permissions']['admin']['artikel'] = array('list','create','edit','delete','copy','etiketten','verkauf','einkauf','einkaufdelete','einkaufcopy','verkaufeditpopup','einkaufeditpopup',
      'stueckliste','provison','projekte','lager','seriennummern','offenebestellungen','offeneauftraege','dateien','wareneingang','upstueckliste','downstueckliste','editstueckliste','reservierung','verkaufcopy','verkaufdelete','onlineshop','newlist','delstueckliste','ajaxwerte','auslagern','profisuche');
    $this->WFconf['permissions']['admin']['lager'] = array('list','create','edit','delete','etiketten','platz','platzeditpopup','bewegung','bestand','inventur','bewegungpopup','zwischenlager','produktionslager','regaletiketten','reservierungen','buchen','buchenzwischenlager','bucheneinlagern','buchenauslagern','artikelfuerlieferungen','ausgehend','artikelentfernen','artikelentfernenreserviert');
    
    $this->WFconf['permissions']['admin']['projekt'] = array('list','create','edit','delete','arbeitspaket','arbeitspaketeditpopup','dateien','kostenstellen','schaltung','zeit','material');


    // permissions auftrag
    //$this->WFconf['permissions']['admin']['auftrag'] = array('list','create','edit','delete','artikel','zahlung','protokoll','abschicken','freigabe','versand','lieferadresseauswahl','lieferadresseneu','kundeuebernehmen','listfreigegebene');



  }
}
?>
