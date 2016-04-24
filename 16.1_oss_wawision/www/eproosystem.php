<?php
/*
**** COPYRIGHT & LICENSE NOTICE *** DO NOT REMOVE ****
* 
* WaWision (c) embedded projects GmbH, Holzbachstrasse 4, D-86154 Augsburg, * Germany 2015 
*
* This file is licensed under the Embedded Projects General Public License *Version 3.1. 
*
* You should have received a copy of this license from your vendor and/or *along with this file; If not, please visit www.wawision.de/Lizenzhinweis 
* to obtain the text of the corresponding license version.  
*
**** END OF COPYRIGHT & LICENSE NOTICE *** DO NOT REMOVE ****
*/
?>
<?php
/* Author: Benedikt Sauter <sauter@embedded-projetcs.net> 2013
 *
 * Hier werden alle Plugins, Widgets usw instanziert die
 * fuer die Anwendung benoetigt werden.
 * Diese Klasse ist von class.application.php abgleitet.
 * Das hat den Vorteil, dass man dort bereits einiges starten kann,
 * was man eh in jeder Anwendung braucht.
 * - DB Verbindung
 * - Template Parser
 * - Sicherheitsmodul
 * - String Plugin
 * - usw....
 */

date_default_timezone_set("Europe/Berlin");
ini_set('default_charset', 'UTF-8');

ini_set('display_errors', 'on');
ini_set("magic_quotes_runtime", 0);

require("../phpwf/class.application.php");

require("lib/class.erpapi.php");

if( WithGUI())
{

  require("widgets/artikeltable.php");
  require("widgets/widget.aufgabe.php");
  require("widgets/widget.arbeitspaket.php");
  require("widgets/widget.verkaufspreise.php");
  require("widgets/widget.einkaufspreise.php");
  require("widgets/widget.lieferadressen.php");
  require("widgets/widget.ansprechpartner.php");
  require("widgets/widget.adresse_accounts.php");
  require("widgets/widget.brief.php");
  require("widgets/widget.email.php");
  require("widgets/widget.stueckliste.php");
  require("widgets/widget.lieferantvorlage.php");
  require("widgets/widget.kundevorlage.php");
  require("widgets/widget.bestellung_position.php");
  require("widgets/widget.rechnung_position.php");
  require("widgets/widget.angebot_position.php");
  require("widgets/widget.auftrag_position.php");
  require("widgets/widget.lieferschein_position.php");
  require("widgets/widget.arbeitsnachweis_position.php");
  require("widgets/widget.gutschrift_position.php");
  require("widgets/widget.reisekosten_position.php");
  require("widgets/widget.inventur_position.php");
  require("widgets/widget.auftrag_artikel.php");
  require("widgets/widget.abrechnungsartikel.php");
  require("widgets/widget.webmail_mails.php");
  require("widgets/widget.lager_platz.php");
  require("widgets/widget.adresse_rolle.php");
  require("widgets/widget.shopexport_kampange.php");
  require("widgets/widget.importvorlage.php");

  //require('lib/dokumente/class.superfpdf.php');
  define('FPDF_FONTPATH','lib/pdf/font/');

  if(file_exists(dirname(__FILE__).'/../conf/user_defined.php'))include_once(dirname(__FILE__).'/../conf/user_defined.php');
  
  if(defined('USEFPDF2') && USEFPDF2)
  {
    if(file_exists('lib/pdf/fpdf_2.php'))
    {
      require('lib/pdf/fpdf_2.php');  
    }else {
      require('lib/pdf/fpdf.php');  
    }
  } else {
    require('lib/pdf/fpdf.php');  
  }
  
  require('lib/pdf/fpdf_final.php');

  require("lib/dokumente/class.superfpdf.php");
  require("lib/dokumente/class.etikett.php");
  require("lib/dokumente/class.briefpapier.php");
  require("lib/dokumente/class.dokumentenvorlage.php");
  if(file_exists("lib/dokumente/class.layoutvorlagen.php"))require("lib/dokumente/class.layoutvorlagen.php");
  require("lib/dokumente/class.sepamandat.php");
  require("lib/dokumente/class.dokuarbeitszeit.php");


  $pdffiles = array('brief','korrespondenz','bestellung','angebot','auftrag','rechnung','gutschrift','lieferschein','anfrage',
    'katalog','produktion','arbeitsnachweis','reisekosten','adressstammblatt','posabschlusspdf','inventur','projekt',
    'provisionsgutschrift','zahlungsavis','provisionenartikel','lagermindestmengen');

  foreach($pdffiles as $pdffile)
  {
    if(is_file("lib/dokumente/class.".$pdffile."_custom.php"))
    {
      require("lib/dokumente/class.".$pdffile."_custom.php");
    } else if (is_file("lib/dokumente/class.".$pdffile.".php"))
    {
      require("lib/dokumente/class.".$pdffile.".php");
    }
  }

  require("lib/class.ustid.php");
  require("plugins/class.wikiparser.php");
  require("plugins/class.ics.php");
  require("plugins/simple_html_dom.php");
  require("lib/class.navigation_edit.php");
  require("lib/imap.inc.php");
}
require("lib/class.printer.php");
require("lib/class.image.php");
require("plugins/phpmailer/class.phpmailer.php");





require("lib/class.httpclient.php");
require("lib/class.aes.php");
require("lib/class.xtea.php");
require("lib/class.remote.php");
require("lib/class.help.php");

include("function_exists.php");

class erpooSystem extends Application
{
  public $obj;
  public $starttime;
  public $endtime;

  public function __construct($config,$group="") 
  {
    //$this->starttime = microtime(); 
    parent::Application($config,$group);

    // objekt api laden
    //$this->obj = new ObjConductor(&$this);


    // hier kann man standard plugins auch einstellen
    // $this->FormHandler->DefaultErrorClass("spezielleklasse");

    // hier koennte man extra plugins laden
    // $this->meinplugin = new MeinPlugin(&$this);

    if(is_file("lib/class.erpapi_custom.php"))
    {
      require("lib/class.erpapi_custom.php");
      $this->erp = new erpAPICustom($this);
    } else {
      $this->erp = new erpAPI($this);
    }

   

    $this->remote = new Remote($this);
    $module = $this->Secure->GetGET("module");
    $action = $this->Secure->GetGET("action");


    if(WithGUI())
    {

      $this->help = new Help($this);


      if($this->erp->Firmendaten("modul_mlm")!="1")
      {
        $this->Tpl->Set('STARTDISABLEMLM',"<!--");
        $this->Tpl->Set('ENDEDISABLEMLM',"-->");
      }

      if($this->erp->Firmendaten("modul_verband")!="1")
      {
        $this->Tpl->Set('STARTDISABLEVERBAND',"<!--");
        $this->Tpl->Set('ENDEDISABLEVERBAND',"-->");
      }

      if($this->erp->Version()=="stock")
      {
        $this->Tpl->Set('DISABLEOPENSTOCK',"<!--");
        $this->Tpl->Set('DISABLECLOSESTOCK',"-->");
      }


      if(is_file("js/".$module.".js"))
        $this->Tpl->Set('JSSCRIPTS','<script type="text/javascript" src="./js/'.$module.'.js?v=1"></script>');
      $this->erp->PrinterIcon();


      if($_SERVER['SERVER_ADDR']=="192.168.0.25")
      {
        $this->erp->HelpIcon();
      }

      if(method_exists($this->erp, 'VersionsInfos'))
      {
        $ver = $this->erp->VersionsInfos();
        $this->Tpl->Set('VERSIONINFO',$ver['Info']);
      }

      $this->Tpl->Set('ID',$this->Secure->GetGET("id"));
      $this->Tpl->Set('POPUPWIDTH',"1000");
      $this->Tpl->Set('POPUPHEIGHT',"700");

      $this->Tpl->Set('YEAR',date('Y'));

      $firmendatenid = $this->DB->Select("SELECT MAX(id) FROM firmendaten LIMIT 1");

      if($this->erp->RechteVorhanden("mhdwarning","list") && $this->erp->Firmendaten("modul_mhd")=="1")
      {
        $checkmhd = $this->DB->Select("SELECT ROUND(SUM(menge),0) FROM lager_mindesthaltbarkeitsdatum WHERE DATEDIFF(NOW(),mhddatum) > 0");

        $checkmhdwarnung = $this->DB->Select("SELECT ROUND(SUM(menge),0) FROM lager_mindesthaltbarkeitsdatum WHERE DATEDIFF(NOW(),mhddatum) + ".($this->erp->Firmendaten("mhd_warnung_tage")+1)." > 0") - $checkmhd;

        if($checkmhd > 0 || $checkmhdwarnung  > 0)
        {
          if($checkmhd <=0) $checkmhd=0;
          if($checkmhd==1) $ist = "ist"; else $ist="sind";

          $link = '<a href="index.php?module=mhdwarning&action=list" style="color:white">Pr&uuml;fen</a>';
          if($checkmhdwarnung) $text="$checkmhdwarnung Artikel laufen bald ab.";
          if($checkmhd) $text2="$checkmhd Artikel $ist abgelaufen!";
          if($text!="" && $text2!="") $text_out = $text."<br>".$text2." ".$link;
          else if($text!="" && $text2=="") $text_out = $text." ".$link;
          else $text_out = $text2." ".$link;

          $this->Tpl->Set('THEMEHEADER','<div style="float:left; height:50px; padding:3px 3px 3px 10px;  width:200px; background-color:#FA5858; border:1px solid #fff; z-index:1000; color:white; font-size:9pt;"><b>Mindesthaltbarkeitsdatum:</b><br>'.$text_out.'</div>');
        }
      }

      if($this->erp->Firmendaten("warnung_doppelte_nummern")=="1")
      {
        $belege = "";
        $gutschrift_check = 0;
        $rechnung_check = 0;
        $check_double_gutschrift = $this->DB->SelectArr("SELECT belegnr, COUNT(belegnr) AS NumOccurrences FROM gutschrift WHERE status!='angelegt' GROUP BY belegnr HAVING ( COUNT(belegnr) > 1 )");
        if(count($check_double_gutschrift)>0)
        {
          
          for($icheck=0;$icheck<count($check_double_gutschrift);$icheck++)
            $belege .=" ".$check_double_gutschrift[$icheck]['belegnr'];

          if(trim($belege)=="") $belege="ohne Nummer";

          $gesamt_gutschrift= count($check_double_gutschrift);
          $this->Tpl->Set('THEMEHEADER','<div style="float:left;height:50px; padding:3px 3px 3px 10px;  width:200px; background-color:#FA5858; border:1px solid #fff; z-index:1000; color:white; font-size:9pt;"><b>Achtung: Doppelte Gutschriftsnummern!</b><br>Dringend pr&uuml;fen! (Gesamt '.$gesamt_gutschrift.') <a href="#" title="Belege: '.$belege.'">*</a></div>');
          $gutschrift_check=1;
        }


        $check_double_rechnungen = $this->DB->SelectArr("SELECT belegnr, COUNT(belegnr) AS NumOccurrences FROM rechnung WHERE status!='angelegt' GROUP BY belegnr HAVING ( COUNT(belegnr) > 1 )");
        if(count($check_double_rechnungen)>0)
        {
          $gesamt_rechnungen = count($check_double_rechnungen);
          for($icheck=0;$icheck<$gesamt_rechnungen;$icheck++)
            $belege .=" ".$check_double_rechnungen[$icheck]['belegnr'];

          if(trim($belege)=="") $belege="ohne Nummer";

          if($gutschrift_check>0)
          {
            $this->Tpl->Set('THEMEHEADER','<div style="float:left;height:50px; padding:3px 3px 3px 10px;  width:200px; background-color:#FA5858; border:1px solid #fff; z-index:1000; color:white; font-size:9pt;"><b>Achtung: Doppelte Rechnungs- und Gutschriftnummern!</b><br>Dringend pr&uuml;fen! (Gesamt '.$gesamt_rechnungen.'/'.$gesamt_gutschrift.') <a href="#" title="Belege: '.$belege.'">*</a></div>');
          } else {
            $this->Tpl->Set('THEMEHEADER','<div style="float:left;height:50px; padding:3px 3px 3px 10px;  width:200px; background-color:#FA5858; border:1px solid #fff; z-index:1000; color:white; font-size:9pt;"><b>Achtung: Doppelte Rechnungsnummern!</b><br>Dringend pr&uuml;fen! (Gesamt '.$gesamt_rechnungen.') <a href="#" title="Belege: '.$belege.'">*</a></div>');

          }
          $rechnung_check = 1;
        }
        
        $check_double_artikel = $this->DB->SelectArr("SELECT nummer, count(nummer) as NumOccurrences FROM artikel WHERE geloescht <> '1' AND nummer <> '' GROUP BY nummer HAVING (COUNT(nummer) > 1) LIMIT 101");
        if($check_double_artikel && count($check_double_artikel) > 0)
        {
          $gesamt_artikel = count($check_double_artikel);
          $gcount = $gesamt_artikel;
          if($gcount > 10)$gcount = 10;
          for($icheck=0;$icheck<$gcount;$icheck++)
            $belege .=" ".$check_double_artikel[$icheck]['nummer'];
          if($gesamt_artikel > $gcount)$belege .= " ...";
          if($gutschrift_check && $rechnung_check)
          {
            $this->Tpl->Set('THEMEHEADER','<div style="float:left;height:50px; padding:3px 3px 3px 10px;  width:200px; background-color:#FA5858; border:1px solid #fff; z-index:1000; color:white; font-size:9pt;"><b>Achtung: Doppelte Rechnungs-, Gutschrift- und Artikelnummern!</b><br>Dringend pr&uuml;fen! (Gesamt '.$gesamt_rechnungen.'/'.$gesamt_gutschrift.'/'.$gesamt_artikel.') <a href="#" title="Belege: '.$belege.'">*</a></div>');
            
          } elseif($gutschrift_check) {
            $this->Tpl->Set('THEMEHEADER','<div style="float:left;height:50px; padding:3px 3px 3px 10px;  width:200px; background-color:#FA5858; border:1px solid #fff; z-index:1000; color:white; font-size:9pt;"><b>Achtung: Doppelte Gutschrift- und Artikelnummern!</b><br>Dringend pr&uuml;fen! (Gesamt '.$gesamt_gutschrift.'/'.$gesamt_artikel.') <a href="#" title="Belege: '.$belege.'">*</a></div>');            
          } elseif($rechnung_check){
            $this->Tpl->Set('THEMEHEADER','<div style="float:left;height:50px; padding:3px 3px 3px 10px;  width:200px; background-color:#FA5858; border:1px solid #fff; z-index:1000; color:white; font-size:9pt;"><b>Achtung: Doppelte Rechnungs- und Artikelnummern!</b><br>Dringend pr&uuml;fen! (Gesamt '.$gesamt_rechnungen.'/'.$gesamt_artikel.') <a href="#" title="Belege: '.$belege.'">*</a></div>');
          } else {
            $this->Tpl->Set('THEMEHEADER','<div style="float:left;height:50px; padding:3px 3px 3px 10px;  width:200px; background-color:#FA5858; border:1px solid #fff; z-index:1000; color:white; font-size:9pt;"><b>Achtung: Doppelte Artikelnummern!</b><br>Dringend pr&uuml;fen! (Gesamt '.$gesamt_artikel.') <a href="#" title="Artikelnummern: '.$belege.'">*</a></div>');
          }
         
          
        }
      }
      

      $benutzername = $this->DB->Select("SELECT benutzername FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");
      $passwort = $this->DB->Select("SELECT passwort FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");
      $host = $this->DB->Select("SELECT host FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");
      $port = $this->DB->Select("SELECT port FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");
      $mailssl = $this->DB->Select("SELECT mailssl FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");
      $mailanstellesmtp = $this->DB->Select("SELECT mailanstellesmtp FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");

      $this->Tpl->Set('COMMONREADONLYINPUT',"");
      $this->Tpl->Set('COMMONREADONLYSELECT',"");

      // templates laden

      //statisch überladen
      $this->Conf->WFconf['defaulttheme']="new";

      if(isset($this->Conf->WFtestmode) && $this->Conf->WFtestmode==true)
        $this->Tpl->Set('BODYSTYLE',"style=background-color:red");


      // mail
      $this->mail = new PHPMailer($this);
      $this->mail->PluginDir="plugins/phpmailer/";

      if($mailanstellesmtp=="1"){
        $this->mail->IsMail();
      } else {
        $this->mail->IsSMTP();
        $this->mail->SMTPAuth   = true;                  // enable SMTP authentication
        if($mailssl==1) 
            $this->mail->SMTPSecure = "tls";                 // sets the prefix to the servier
        else if ($mailssl==2)
            $this->mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

        $this->mail->Host       = $host;

        $this->mail->Port       = $port;                   // set the SMTP port for the GMAIL server

        $this->mail->Username   = $benutzername;  // GMAIL username
        $this->mail->Password   = $passwort;            // GMAIL password
      }

      // templates
      $this->Tpl->ReadTemplatesFromPath("widgets/templates/_gen/");
      $this->Tpl->ReadTemplatesFromPath("widgets/templates/");
      $this->Tpl->ReadTemplatesFromPath("themes/".$this->Conf->WFconf['defaulttheme']."/templates/");
      $this->Tpl->ReadTemplatesFromPath("pages/content/_gen/");
      $this->Tpl->ReadTemplatesFromPath("pages/content/");

      // drucker
      if(is_file("lib/class.printer_custom.php"))
      {
        require("lib/class.printer_custom.php");
        $this->printer = new PrinterCustom($this);
      } else {
        $this->printer = new Printer($this);
      } 

      $layout_iconbar = $this->DB->Select("SELECT layout_iconbar FROM firmendaten WHERE id='".$firmendatenid."' LIMIT 1");

      if($this->erp->Version()=="stock")
      {
          $this->Tpl->Set('STOCKOPEN',"<!--");
          $this->Tpl->Set('STOCKCLOSE',"-->");
      }

      //nur wenn leiste nicht deaktiviert ist
      if($layout_iconbar!=1)
      {
        if($this->erp->Firmendaten("iconset_dunkel")=="1")
          $this->Tpl->Parse('ICONBAR',"iconbar_dunkel.tpl");
        else
          $this->Tpl->Parse('ICONBAR',"iconbar.tpl");
      } else {
        $this->Tpl->Parse('ICONBAR',"iconbar_empty.tpl");
      }

      if($module!="kalender" && ($module!="welcome" && $action!="start"))
        $this->Tpl->Add('YUICSS',".ui-widget-content {}");

      $this->Tpl->Set('MODULE',$module);
      $this->Tpl->Set('ACTION',$action);

      $this->Tpl->Set('THEME', $this->Conf->WFconf['defaulttheme']);
      $doc_root  = preg_replace("!{$_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']); # ex: /var/www
      $path = preg_replace("!^{$doc_root}!", '', __DIR__);
      $this->Tpl->Set('WEBPATH',$path);
   

      if($action=="list" || $action=="")
        $this->Tpl->Set('TABSBACK',"index.php");
      else 
        $this->Tpl->Set('TABSBACK',"index.php?module=$module&action=list");


      $this->Tpl->Set('SAVEBUTTON','<input type="submit" name="speichern" value="Speichern" />');
      //$this->Tpl->Parse(SAVEPAGEREALLY,"savepagereally.tpl");

      $this->help->Run(); 

      $this->Tpl->Set('TMPSCRIPT',"");


      $msg2 = $this->Secure->GetGET("msg");

      if($msg2!="")
      {
        $msg2 = $this->erp->base64_url_decode($msg2);

        // zeigenur bis letztes > Zeichen an
        $letzte_zeichen = strrpos ($msg2,'</div>');
        $msg2 = substr ($msg2,0,$letzte_zeichen+6);		
        $this->Tpl->Set('MESSAGE',$msg2);
      }


      $module = $this->Secure->GetGET("module");
      $this->Tpl->Set('MODULE',$module);
      if($module == "")
        $module = "welcome";
      $this->Tpl->Set('ICON',$module);



      $id = $this->Secure->GetGET("id");
      $this->Tpl->Set('KID',$id);

      // pruefe welche version vorliegt
      include("../version.php");

      $this->Tpl->Set('REVISION',$this->erp->Revision(). " (".$this->erp->Branch().")");
      $this->Tpl->Set('REVISIONID',$this->erp->RevisionPlain());
      $this->Tpl->Set('BRANCH',$this->erp->Branch());

      $this->Tpl->Set('LIZENZHINWEIS','| <a href="http://www.wawision.de/lizenzhinweis" target="_blank">Lizenzhinweis</a>');

      if($this->erp->Version()=="OSS")
        $this->Tpl->Set('VERSION',"Open-Source Lizenz EGPLv3.1");
      else if($this->erp->Version()=="ENT")
        $this->Tpl->Set('VERSION',"Enterprise Version");
      else if($this->erp->Version()=="PRO")
        $this->Tpl->Set('VERSION',"Professional Version");
      else if($this->erp->Version()=="PRE")
        $this->Tpl->Set('VERSION',"Premium Version");
      else
        $this->Tpl->Set('VERSION',"Nutzungsbedingungen");

      $this->Tpl->Set('TIMESTAMP',time());

      $this->Tpl->Set('THEME',$this->Conf->WFconf['defaulttheme']);
      $this->Tpl->Set('AKTIV_GEN_TAB1',"selected");

      if(file_exists(dirname(__FILE__).'/pages/textvorlagen.php')){
        $displaytextvorlagen = true;
        if(in_array($module,array('auftrag','ticket','service','artikel')))$displaytextvorlagen = false;
        if($module == 'artikel' && $action == 'edit')$displaytextvorlagen = true;
        $displaytextvorlagen = false;
        if(true){
          $this->YUI->TableSearch('TABTEXTVORLAGEN',"textvorlagen".($displaytextvorlagen?'':'ohnefilter'));
          //if($displaytextvorlagen)
          if(true)
          {
            $this->Tpl->Add('TVFILTERHEADER','<table height="80" width="100%"><tr><td><fieldset><center><table width="100%" cellspacing="5"><tr></tr></table><br><br><br></center></fieldset></td></tr></table>');
          }
          
          $this->YUI->AutoComplete("textvorlageprojekt","projektname", 1);
          //$this->Tpl->Parse(TEXTVORLAGEN,"textvorlagen.tpl");
          $this->Tpl->Add('JSSCRIPTS',$this->Tpl->OutputAsString("textvorlagen.tpl"));
        }
      }
    }
  }


  function calledWhenAuth($type)
  {
    $id = $this->Secure->GetGET("id");
    $lid = $this->Secure->GetGET("lid");
    $module = $this->Secure->GetGET("module");
    $action  = $this->Secure->GetGET("action");

    if(!WithGUI())
      return;

    // Check Timeout Users
    $this->DB->Update("UPDATE useronline SET login=0 WHERE DATE_ADD(time,INTERVAL ".$this->Conf->WFconf['logintimeout']." second) < NOW() AND login=1");

    // check if time is expired
    //$time =  $this->app->DB->Select("SELECT UNIX_TIMESTAMP(time) FROM useronline,user WHERE
    //        login='1' AND sessionid='".$this->session_id."' AND user.id=useronline.user_id AND user.activ='1' LIMIT 1");

   //   if((time()-$time) > $this->app->Conf->WFconf[logintimeout])



    if($module=="adresse" || $module=="artikel" || $module=="angebot" || $module=="rechnung" || $module=="auftrag" || $module=="gutschrift" || $module=="lieferschein" 
        || $module=="onlineshops" || $module=="geschaeftsbrief_vorlagen" ||  $module=="emailbackup" || $module=="ticket_vorlage")
    {
      // module auf richtige tabellen mappen
      if($module=="onlineshops") $this->erp->Standardprojekt("shopexport",$id);
      else $this->erp->Standardprojekt($module,$id);

    }

    if(1)//($module=="adresse" || $module=="artikel" || $module=="angebot" || $module=="rechnung" || $module=="auftrag" || $module=="gutschrift" || $module=="lieferschein" ||
         // $module=="anfrage" || $module=="produktion" || $module=="reisekosten" || $module=="arbeitsnachweis" || $module=="bestellung" || $module=="inventur") && $action=="edit")
    {
      // userd edit ajax call

      $this->Tpl->Add('JAVASCRIPT',"
          function executeQuery() {
          $.ajax({
url: 'index.php?module=welcome&action=poll&smodule=$module&saction=$action&sid=$id&user=".$this->User->GetID()."',
success: function(data) {
// do something with the return value here if you like
obj = JSON.parse(data);
switch(obj.event)
{
  case 'warning':  
  if(obj.message!='')
  {
    generate('warning', obj.message);
  }
  break;

  case 'error':  
  if(obj.message!='')
  {
    generate('warning', obj.message);
  }
  break;

  case 'info':  
  if(obj.message!='')
  {
    generate('information', obj.message);
  }
  break;

  case 'confirm':  
  if(obj.message!='')
  {
    generate('confirm', obj.message);
  }
  break;

  case 'alert':  
  if(obj.message!='')
  {
    generateAlter(obj.message);
  }
  break;


  default:  
  if(obj.message!='' && obj.message != undefined)
  {
    generate('information', obj.message);
  }
  break;

}
if(obj.sound=='1')
{
  bell = new Audio('./sound/pling.mp3');
  bell.play();
}

}
});
          setTimeout(executeQuery, 20000); // you could choose not to continue on failure...
          }

          $(document).ready(function() {
            // run the first time; all subsequent calls will take care of themselves
            executeQuery();
            //setTimeout(executeQuery, 3000);
            });
          ");
      }

/*********** select field for projekt ***************/
if($this->Secure->GetPOST("projekt")=="")
{
  if(isset($this->Conf->WFdbType) && $this->Conf->WFdbType=="postgre")
  {
    //POSTGRE -->  dringend bei statements wo es die tabelle gibt machen!
    //$selectid = $this->DB->Select("SELECT projekt FROM `$module` WHERE id='$id' LIMIT 1");

  } else {
    $selectid = $this->DB->Select("SELECT projekt FROM `$module` WHERE id='$id' LIMIT 1");
  }
}
else
$selectid = $this->Secure->GetPOST("projekt");
$options = $this->erp->GetProjektSelect($selectid,isset($color_selected)?$color_selected:''); 
if(!isset($color_selected))$color_selected = '';
$this->Tpl->Set('EPROO_SELECT_PROJEKT',"<select name=\"projekt\" 
    style=\"background-color:$color_selected;\"
    onChange=\"this.style.backgroundColor=this.options[this.selectedIndex].style.backgroundColor\">$options</select>");
//$this->Tpl->Set(EPROO_SELECT_PROJEKT,"<select name=\"projekt\" onChange=\"fillUnterprojekt();\">$options</select>");
//$this->Tpl->Set(EPROO_SELECT_UNTERPROJEKT,"<select name=\"unterprojekt\"><option>Einkauf Olimex</option></select>");
$this->Tpl->Set('EPROO_SELECT_UNTERPROJEKT',"<div id=\"selectunterprojekt\">
    <select name=\"unterprojekt\">
    </select>
    </div>");


$this->Tpl->Set('LESEZEICHEN','<a title="Angebot" href="index.php?module=angebot&action=search">Angebotssuche</a>&nbsp;');
$this->Tpl->Add('LESEZEICHEN','<a title="Auftrag" href="index.php?module=auftrag&action=search">Auftragssuche</a>&nbsp;');
$this->Tpl->Add('LESEZEICHEN','<a title="Rechnung" href="index.php?module=rechnung&action=search">Rechnungssuche</a>&nbsp;');
$this->Tpl->Add('LESEZEICHEN','<a title="Adresse" href="index.php?module=adresse&action=search">Adressensuche</a>&nbsp;');
$this->Tpl->Add('LESEZEICHEN','<a title="Adresse" href="index.php?module=wareneingang&action=paketannahme">Paket Annahme</a>');

$this->Tpl->Set('KURZUEBERSCHRIFT',$module);

if($action=="edit")
$this->Tpl->Add('KURZUEBERSCHRIFT1',"BEARBEITEN");

$this->Tpl->Set('KURZUEBERSCHRIFTFIRSTUPPER',ucfirst($module));

/*********** select field for projekt ***************/
if($this->Secure->GetPOST("land")=="" && $this->Secure->GetGET("land")=="")
{
  if(isset($this->Conf->WFdbType) && $this->Conf->WFdbType=="postgre")
  {
    //POSTGRE -->  dringend bei statements wo es die tabelle gibt machen!
    //$selectid = $this->DB->Select("SELECT land FROM `$module` WHERE id='$id' LIMIT 1");
  }
  else {
    $selectid = $this->DB->Select("SELECT land FROM `$module` WHERE id='$id' LIMIT 1");
  }
  //if($selectid<=0 && $module=="lieferadressepopup") $this->DB->Select("SELECT land FROM `lieferadressen` WHERE id='$id' LIMIT 1");

  if(isset($this->Conf->WFdbType) && $this->Conf->WFdbType=="postgre") {

    if(!is_numeric($lid)) $lid=0;
    if($selectid<=0 && $selectid=="") { $selectid = $this->DB->Select("SELECT land FROM `lieferadressen` WHERE id='$lid' LIMIT 1"); }
  } else {

    if($selectid<=0 && $selectid=="") { $selectid = $this->DB->Select("SELECT land FROM `lieferadressen` WHERE id='$lid' LIMIT 1"); }
  }
}
else if($this->Secure->GetGET("land")!="")
$selectid = $this->Secure->GetGET("land");
else
$selectid = $this->Secure->GetPOST("land");


/*********** select field for projekt ***************/
if($this->Secure->GetPOST("rechnung_land")=="" && $this->Secure->GetGET("rechnung_land")=="" && $module=="adresse")
{
  $selectidrechnung = $this->DB->Select("SELECT rechnung_land FROM adresse WHERE id='$id' LIMIT 1");
  //if($selectid<=0 && $module=="lieferadressepopup") $this->DB->Select("SELECT land FROM `lieferadressen` WHERE id='$id' LIMIT 1");
}
else
$selectidrechnung = $this->Secure->GetPOST("rechnung_land");

/*********** select field for projekt ***************/
$lid = $this->Secure->GetGET("lid");
if($this->Secure->GetPOST("ansprechpartner_land")=="" && $this->Secure->GetGET("ansprechpartner_land")=="" && $module=="adresse")
{
  $selectidansprechpartner = $this->DB->Select("SELECT ansprechpartner_land FROM ansprechpartner WHERE id='$lid' LIMIT 1");
  //if($selectid<=0 && $module=="lieferadressepopup") $this->DB->Select("SELECT land FROM `lieferadressen` WHERE id='$id' LIMIT 1");
}
else
$selectidansprechpartner = $this->Secure->GetPOST("ansprechpartner_land");


$this->Tpl->Set('EPROO_SELECT_LAND',"<select name=\"land\" [COMMONREADONLYSELECT]>".$this->SelectLaenderliste($selectid)."</select>");
$this->Tpl->Set('EPROO_SELECT_LIEFERLAND',"<select name=\"lieferland\" [COMMONREADONLYSELECT]>".$this->SelectLaenderliste($selectid)."</select>");
$this->Tpl->Set('EPROO_SELECT_LAND_RECHNUNG',"<select name=\"rechnung_land\" [COMMONREADONLYSELECT]>".$this->SelectLaenderliste($selectidrechnung)."</select>");
$this->Tpl->Set('EPROO_SELECT_LAND_ANSPRECHPARTNER',"<select name=\"ansprechpartner_land\" [COMMONREADONLYSELECT]>".$this->SelectLaenderliste($selectidansprechpartner)."</select>");

if($this->Secure->GetPOST("lieferland")=="")
{
  if(isset($this->Conf->WFdbType) && $this->Conf->WFdbType=="postgre") {
    //POSTGRE -->  dringend bei statements wo es die tabelle gibt machen!
    //     	$selectid = $this->DB->Select("SELECT lieferland FROM `$module` WHERE id='$id' LIMIT 1");
  }
  else {
    $selectid = $this->DB->Select("SELECT lieferland FROM `$module` WHERE id='$id' LIMIT 1");
  }
}
else
$selectid = $this->Secure->GetPOST("lieferland");

$this->Tpl->Set('EPROO_SELECT_LIEFERLAND',"<select name=\"lieferland\" [COMMONREADONLYSELECT]>".$this->SelectLaenderliste($selectid)."</select>");


$this->Tpl->Set('VORGAENGELINK',"<a href=\"#\" onclick=\"var ergebnistext=prompt('Lesezeichen:','".ucfirst($module)."'); if(ergebnistext!='' && ergebnistext!=null) window.location.href='index.php?module=welcome&action=vorgang&titel='+ergebnistext;\">*</a>");

$anzahl_chat = $this->DB->Select("SELECT COUNT(id) FROM chat WHERE user_to='".$this->User->GetID()."' AND gelesen!=1");
if($anzahl_chat > 0) $anzahl_chat=" <div class=\"chat_circle\" onclick=\"window.location.href='index.php?module=chat&action=list'\">".$anzahl_chat."</div>"; else $anzahl_chat="";

$this->Tpl->Set('BENUTZER',$this->User->GetName().$anzahl_chat);
$this->Tpl->Set('CALENDERWEEK',date('W'));

$this->Tpl->Set('CALENDERWEEKMAX',date('W', date(mktime(0, 0, 0, 1, 1, date('Y')+1) - 4*86400)));

$this->Tpl->Set('VERSIONUNDSTATUS',"Server: ".$_SERVER["SERVER_NAME"]."&nbsp;|&nbsp;Client: ".$_SERVER [ 'REMOTE_ADDR' ]."&nbsp;|&nbsp;User: ".$this->User->GetDescription());
$this->Tpl->Set('SERVERDATE',"Serverzeit: ".date('d.m.Y H:i')." Uhr");

$this->Tpl->Set('MODUL',ucfirst($module));

$this->Tpl->Set('HTMLTITLE',"[MODUL] | WaWision ");
$firmenname = $this->DB->Select("SELECT name FROM firmendaten WHERE firma='".$this->User->GetFirma()."' LIMIT 1");

$firmenfarbe = $this->DB->Select("SELECT firmenfarbe FROM firmendaten WHERE firma='".$this->User->GetFirma()."' LIMIT 1");
$this->Tpl->Set('FIRMENNAME',$firmenname);
$this->Tpl->Set('NBBREITE','275');
$this->Tpl->Set('NBPROZ','25');

$check = false;


  if($this->erp->RechteVorhanden("stechuhr","change") && $this->erp->RechteVorhanden("stechuhr","list") && $check)
  {
    $kommen = '<a href="index.php?module=stechuhr&action=list" ';
    $checkkommen = $this->DB->SelectArr("SELECT status, kommen FROM stechuhr WHERE user='".$this->User->GetID()."' ORDER by datum DESC LIMIT 1");
    if($checkkommen){
      switch($checkkommen[0]['status'])
      {
        case 'kommen':
          $kommen .= 'style="color:#b1cd55; padding-top:0; text-decoration:none; font-size: 8pt; font-weigt:bold;">in Arbeit';
        break;
        case 'gehen':
          $kommen .= 'style="color:#fd5653; margin-top:-10px; display:inline-block; text-decoration:none; font-size: 8pt; font-weigt:bold;">nicht in Arbeit';
        break;        
        case 'pausestart':
          $kommen .= 'style="color:#fd5653; text-decoration:none; font-size: 8pt; font-weigt:bold;">Pause';
        break;
        case 'pausestop':
          $kommen .= 'style="color:#b1cd55; text-decoration:none; font-size: 8pt; font-weigt:bold;">in Arbeit';
        break;
        case '':
        case NULL:
          $kommen .= 'style="color:#fd5653; margin-top:-10px; display:inline-block; text-decoration:none; font-size: 8pt; font-weigt:bold;">nicht in Arbeit';
        break;
      }
      
    } else {
      $kommen .= 'style="color:#fd5653; margin-top:-10px; display:inline-block; text-decoration:none; font-size: 8pt; font-weigt:bold;">nicht in Arbeit';
    }
    $kommen .= '</a>';
  } else {
  
    $checkkommen = $this->DB->Select("SELECT kommen FROM stechuhr WHERE user='".$this->User->GetID()."' ORDER by datum DESC LIMIT 1");	
    if($checkkommen!=0)
      $kommen = '<a href="#" onclick="if(confirm(\'Status von Arbeit auf Pause / Freizeit ändern?\')) window.location.href=\'index.php?module=stechuhr&action=change&cmd=pause\';" style="color:#b1cd55;    
        text-decoration:none; font-size: 8pt; font-weigt:bold;">&nbsp;Arbeit&nbsp;</a>';
    else 
      $kommen = '<a href="#" onclick="if(confirm(\'Status von Pause / Freizeit auf Arbeit ändern?\')) window.location.href=\'index.php?module=stechuhr&action=change&cmd=arbeit\';" style="color:#fd5653; text-decoration:none; font-size: 8pt; font-weigt:bold;">&nbsp;Pause</a>';
  }
  $this->Tpl->Set('STECHUHR',$kommen);


$anznachrichtenboxen = 0;

if($this->erp->RechteVorhanden("wiedervorlage","list"))
{
  $anznachrichtenboxen++;
  $this->Tpl->Set('WIEDERVORLAGENHEAD','<td width="25%"><div class="nachrichtenbox">Wiedervor.</div></td>');
  $anzwiedervorlage = (int)$this->DB->Select("SELECT count(*) from wiedervorlage w left join adresse a on w.adresse = a.id left join projekt p on p.id = a.projekt where abgeschlossen = 0 and 
  TIMESTAMP(concat(datum_erinnerung,' ',zeit_erinnerung)) < TIMESTAMP(now())
  
  and adresse_mitarbeiter = ".$this->User->getAdresse().' '.$this->erp->ProjektRechte());
  $anzwiedervorlageges = (int)$this->DB->Select("SELECT count(*) from wiedervorlage w left join adresse a on w.adresse = a.id left join projekt p on p.id = a.projekt  where abgeschlossen = 0 and 
  TIMESTAMP(concat(datum_erinnerung,' ',zeit_erinnerung)) < TIMESTAMP(now())
  
  and adresse_mitarbeiter >= 0 ".' '.$this->erp->ProjektRechte());

  $this->Tpl->Set('WIEDERVORLAGENCOUNTER','<td width="25%"><div class="nachrichtenbox"><div class="nachrichtenboxzahl" onclick="window.location.href=\'index.php?module=wiedervorlage&action=list\'">'.$anzwiedervorlage.'/'.$anzwiedervorlageges.'</div></div></td>');
  
}

if(!$this->erp->RechteVorhanden("aufgaben","list"))
{
  $this->Tpl->Set('AUFGABENVOR','<!--');
  $this->Tpl->Set('AUFGABENNACH','-->');
}else {
  $anznachrichtenboxen++;
}
if(!$this->erp->RechteVorhanden("ticket","offene"))
{
  $this->Tpl->Set('TICKETVOR','<!--');
  $this->Tpl->Set('TICKETNACH','-->');
}else{
  $anznachrichtenboxen++;
}
if(!$this->erp->RechteVorhanden("service","list"))
{
  $this->Tpl->Set('SUPPORTVOR','<!--');
  $this->Tpl->Set('SUPPORTNACH','-->');
}else{
  $anznachrichtenboxen++;
}

if($anznachrichtenboxen < 3)
{
  if($anznachrichtenboxen == 2)
  {
    $this->Tpl->Set('NBBREITE','207');
    $this->Tpl->Set('NBPROZ','33');
  }elseif($anznachrichtenboxen == 1)
  {
    $this->Tpl->Set('NBBREITE','139');
    $this->Tpl->Set('NBPROZ','50');    
  }else{
    $this->Tpl->Set('NBBREITE','71');
    $this->Tpl->Set('NBPROZ','100');        
  }
  //$this->Tpl->Set(NACHRICHTENBOXSPACE,'<td width="'.((3-$anznachrichtenboxen)*25).'%"><div class="nachrichtenbox"></div></td>');
  
}


$anzahltickets = $this->erp->AnzahlOffeneAufgaben();
if($anzahltickets<=0)
{
	$this->Tpl->Set('ANZAHLAUFGABEN',0);
} else {
	$this->Tpl->Set('ANZAHLAUFGABEN',$anzahltickets);
}



$firmenfarbe = $this->erp->Firmendaten("firmenfarbe");
if($firmenfarbe =="")
$firmenfarbe = "#48494b";

$firmenfarbehell = $this->erp->Firmendaten("firmenfarbehell");
if($firmenfarbehell =="")
$firmenfarbehell = "#c2e3ea";

$firmenfarbedunkel = $this->erp->Firmendaten("firmenfarbedunkel");
if($firmenfarbedunkel =="")
$firmenfarbedunkel = "#53bed0";

$firmenfarbeganzdunkel = $this->erp->Firmendaten("firmenfarbeganzdunkel");
if($firmenfarbeganzdunkel =="")
$firmenfarbeganzdunkel = "#018fa3";

$navigationfarbeschrift = $this->erp->Firmendaten("navigationfarbeschrift");
if($navigationfarbeschrift =="")
$navigationfarbeschrift = "#c9c9cb";

$navigationfarbe = $this->erp->Firmendaten("navigationfarbe");
if($navigationfarbe =="")
$navigationfarbe = $firmenfarbe;



$this->Tpl->Set('TPLFIRMENFARBE',$this->erp->Firmendaten("firmenfarbe"));

$this->Tpl->Set('TPLSYSTEMBASE',$firmenfarbe);
$this->Tpl->Set('TPLFIRMENFARBEHELL',$firmenfarbehell);
$this->Tpl->Set('TPLFIRMENFARBEDUNKEL',$firmenfarbedunkel);
$this->Tpl->Set('TPLFIRMENFARBEGANZDUNKEL',$firmenfarbeganzdunkel);

$this->Tpl->Set('TPLNACHRICHTBOX',"#696969");

if(is_file("./themes/new/css/grid_cache.css") && ($module!="welcome" && $action!="start"))
$this->Tpl->Add('CSSLINKS','<link href="./themes/new/css/grid_cache.css" rel="stylesheet" type="text/css" />');
else
$this->Tpl->Add('CSSLINKS','<link href="./index.php?module=welcome&action=css&file=grid.css" rel="stylesheet" type="text/css" />');

if(is_file("./themes/new/css/style_cache.css") && ($module!="welcome" && $action!="start") && ($module!="kalender" && $action!="list"))
$this->Tpl->Add('CSSLINKS','<link href="./themes/new/css/style_cache.css" rel="stylesheet" type="text/css" />');
else
$this->Tpl->Add('CSSLINKS','<link href="./index.php?module=welcome&action=css&file=style.css&submodule=[MODULE]&subaction=[ACTION]" rel="stylesheet" type="text/css" />');

if(is_file("./themes/new/css/popup_cache.css") && ($module!="welcome" && $action!="start") && ($module!="kalender" && $action!="list"))
$this->Tpl->Set('CSSLINKSPOPUP','<link href="./themes/new/css/popup_cache.css" rel="stylesheet" type="text/css" />');
else
$this->Tpl->Set('CSSLINKSPOPUP','<link href="./index.php?module=welcome&action=css&file=popup.css&submodule=[MODULE]&subaction=[ACTION]" rel="stylesheet" type="text/css" />');

if(isset($this->Conf->WFtestmode) && $this->Conf->WFtestmode==true)
{
  $this->Tpl->Set('TPLLOGOFIRMA',"./themes/new/images/wawision_logo_testmode.png");
} else {
  if(is_file("./themes/new/images/logo_cache.png"))
    $this->Tpl->Set('TPLLOGOFIRMA',"./themes/new/images/logo_cache.png");
  else {
    if($this->erp->Firmendaten("firmenlogoaktiv")!="1")
    {
      if($this->erp->Firmendaten("iconset_dunkel")!="1")
        $this->Tpl->Set('TPLLOGOFIRMA',"./themes/new/images/wawision_logo_gruen_weiss.gif");
      else
        $this->Tpl->Set('TPLLOGOFIRMA',"./themes/new/images/wawision_logo_gruen_grau.gif");
    }
    else
      $this->Tpl->Set('TPLLOGOFIRMA',"./index.php?module=welcome&action=logo");
  }
}

$this->Tpl->Set('TPLNAVIGATIONFARBE',$navigationfarbe);
$this->Tpl->Set('TPLNAVIGATIONFARBESCHRIFT',$navigationfarbeschrift);
$this->Tpl->Set('TPLUNTERNAVIGATIONFARBE',$this->erp->Firmendaten("unternavigationfarbe"));
$this->Tpl->Set('TPLUNTERNAVIGATIONFARBESCHRIFT',$this->erp->Firmendaten("unternavigationfarbeschrift"));

}


function SelectLaenderliste($selected="")
{
  if($selected=="") $selected="DE";

  $laender = array(
      'Afghanistan'  => 'AF',
      '&Auml;gypten'  => 'EG',
      'Albanien'  => 'AL',
      'Algerien'  => 'DZ',
      'Andorra'  => 'AD',
      'Angola'  => 'AO',
      'Anguilla'  => 'AI',
      'Antarktis'  => 'AQ',
      'Antigua und Barbuda'  => 'AG',
      '&Auml;quatorial Guinea'  => 'GQ',
      'Argentinien'  => 'AR',
      'Armenien'  => 'AM',
      'Aruba'  => 'AW',
      'Aserbaidschan'  => 'AZ',
      '&Auml;thiopien'  => 'ET',
      'Australien'  => 'AU',
      'Bahamas'  => 'BS',
      'Bahrain'  => 'BH',
      'Bangladesh'  => 'BD',
      'Barbados'  => 'BB',
      'Belgien'  => 'BE',
      'Belize'  => 'BZ',
      'Benin'  => 'BJ',
      'Bermudas'  => 'BM',
      'Bhutan'  => 'BT',
      'Birma'  => 'MM',
      'Bolivien'  => 'BO',
      'Bosnien-Herzegowina'  => 'BA',
      'Botswana'  => 'BW',
      'Bouvet Inseln'  => 'BV',
      'Brasilien'  => 'BR',
      'Britisch-Indischer Ozean'  => 'IO',
      'Brunei'  => 'BN',
      'Bulgarien'  => 'BG',
      'Burkina Faso'  => 'BF',
      'Burundi'  => 'BI',
      'Chile'  => 'CL',
      'China'  => 'CN',
      'Christmas Island'  => 'CX',
      'Cook Inseln'  => 'CK',
      'Costa Rica'  => 'CR',
      'D&auml;nemark'  => 'DK',
      'Deutschland'  => 'DE',
      'Djibuti'  => 'DJ',
      'Dominika'  => 'DM',
      'Dominikanische Republik'  => 'DO',
      'Ecuador'  => 'EC',
      'El Salvador'  => 'SV',
      'Elfenbeink&uuml;ste'  => 'CI',
      'Eritrea'  => 'ER',
      'Estland'  => 'EE',
      'Falkland Inseln'  => 'FK',
      'F&auml;r&ouml;er Inseln'  => 'FO',
      'Fidschi'  => 'FJ',
      'Finnland'  => 'FI',
      'Frankreich'  => 'FR',
      'Franz&ouml;sisch Guyana'  => 'GF',
      'Franz&ouml;sisch Polynesien'  => 'PF',
      'Franz&ouml;sisches S&uuml;d-Territorium'  => 'TF',
      'Gabun'  => 'GA',
      'Gambia'  => 'GM',
      'Georgien'  => 'GE',
      'Ghana'  => 'GH',
      'Gibraltar'  => 'GI',
      'Grenada'  => 'GD',
      'Griechenland'  => 'GR',
      'Gr&ouml;nland'  => 'GL',
      'Großbritannien'  => 'UK',
      'Großbritannien (UK)'  => 'GB',
      'Guadeloupe'  => 'GP',
      'Guam'  => 'GU',
      'Guatemala'  => 'GT',
      'Guinea'  => 'GN',
      'Guinea Bissau'  => 'GW',
      'Guyana'  => 'GY',
      'Haiti'  => 'HT',
      'Heard und McDonald Islands'  => 'HM',
      'Honduras'  => 'HN',
      'Hong Kong'  => 'HK',
      'Indien'  => 'IN',
      'Indonesien'  => 'ID',
      'Irak'  => 'IQ',
      'Iran'  => 'IR',
      'Irland'  => 'IE',
      'Island'  => 'IS',
      'Israel'  => 'IL',
      'Italien'  => 'IT',
      'Jamaika'  => 'JM',
      'Japan'  => 'JP',
      'Jemen'  => 'YE',
      'Jordanien'  => 'JO',
      'Jugoslawien'  => 'YU',
      'Kaiman Inseln'  => 'KY',
      'Kambodscha'  => 'KH',
      'Kamerun'  => 'CM',
      'Kanada'  => 'CA',
      'Kap Verde'  => 'CV',
      'Kasachstan'  => 'KZ',
      'Kenia'  => 'KE',
      'Kirgisistan'  => 'KG',
      'Kiribati'  => 'KI',
      'Kokosinseln'  => 'CC',
      'Kolumbien'  => 'CO',
      'Komoren'  => 'KM',
      'Kongo'  => 'CG',
      'Kongo, Demokratische Republik'  => 'CD',
      'Kosovo'  => 'KO',
      'Kroatien'  => 'HR',
      'Kuba'  => 'CU',
      'Kuwait'  => 'KW',
      'Laos'  => 'LA',
      'Lesotho'  => 'LS',
      'Lettland'  => 'LV',
      'Libanon'  => 'LB',
      'Liberia'  => 'LR',
      'Libyen'  => 'LY',
      'Liechtenstein'  => 'LI',
      'Litauen'  => 'LT',
      'Luxemburg'  => 'LU',
      'Macao'  => 'MO',
      'Madagaskar'  => 'MG',
      'Malawi'  => 'MW',
      'Malaysia'  => 'MY',
      'Malediven'  => 'MV',
      'Mali'  => 'ML',
      'Malta'  => 'MT',
      'Marianen'  => 'MP',
      'Marokko'  => 'MA',
      'Marshall Inseln'  => 'MH',
      'Martinique'  => 'MQ',
      'Mauretanien'  => 'MR',
      'Mauritius'  => 'MU',
      'Mayotte'  => 'YT',
      'Mazedonien'  => 'MK',
      'Mexiko'  => 'MX',
      'Mikronesien'  => 'FM',
      'Mocambique'  => 'MZ',
      'Moldavien'  => 'MD',
      'Monaco'  => 'MC',
      'Mongolei'  => 'MN',
      'Montserrat'  => 'MS',
      'Namibia'  => 'NA',
      'Nauru'  => 'NR',
      'Nepal'  => 'NP',
      'Neukaledonien'  => 'NC',
      'Neuseeland'  => 'NZ',
      'Nicaragua'  => 'NI',
      'Niederlande'  => 'NL',
      'Niederl&auml;ndische Antillen'  => 'AN',
      'Niger'  => 'NE',
      'Nigeria'  => 'NG',
      'Niue'  => 'NU',
      'Nord Korea'  => 'KP',
      'Norfolk Inseln'  => 'NF',
      'Norwegen'  => 'NO',
      'Oman'  => 'OM',
      '&Ouml;sterreich'  => 'AT',
      'Pakistan'  => 'PK',
      'Pal&auml;stina'  => 'PS',
      'Palau'  => 'PW',
      'Panama'  => 'PA',
      'Papua Neuguinea'  => 'PG',
      'Paraguay'  => 'PY',
      'Peru'  => 'PE',
      'Philippinen'  => 'PH',
      'Pitcairn'  => 'PN',
      'Polen'  => 'PL',
      'Portugal'  => 'PT',
      'Puerto Rico'  => 'PR',
      'Qatar'  => 'QA',
      'Reunion'  => 'RE',
      'Ruanda'  => 'RW',
      'Rum&auml;nien'  => 'RO',
      'Ru&szlig;land'  => 'RU',
      'Saint Lucia'  => 'LC',
      'Sambia'  => 'ZM',
      'Samoa'  => 'AS',
      'Samoa'  => 'WS',
      'San Marino'  => 'SM',
      'Sao Tome'  => 'ST',
      'Saudi Arabien'  => 'SA',
      'Schweden'  => 'SE',
      'Schweiz'  => 'CH',
      'Senegal'  => 'SN',
      'Seychellen'  => 'SC',
      'Sierra Leone'  => 'SL',
      'Singapur'  => 'SG',
      'Slowakei -slowakische Republik-'  => 'SK',
      'Slowenien'  => 'SI',
      'Solomon Inseln'  => 'SB',
      'Somalia'  => 'SO',
      'South Georgia, South Sandwich Isl.'  => 'GS',
      'Spanien'  => 'ES',
      'Sri Lanka'  => 'LK',
      'St. Helena'  => 'SH',
      'St. Kitts Nevis Anguilla'  => 'KN',
      'St. Pierre und Miquelon'  => 'PM',
      'St. Vincent'  => 'VC',
      'S&uuml;d Korea'  => 'KR',
      'S&uuml;dafrika'  => 'ZA',
      'Sudan'  => 'SD',
      'Surinam'  => 'SR',
      'Svalbard und Jan Mayen Islands'  => 'SJ',
      'Swasiland'  => 'SZ',
      'Syrien'  => 'SY',
      'Tadschikistan'  => 'TJ',
      'Taiwan'  => 'TW',
      'Tansania'  => 'TZ',
      'Thailand'  => 'TH',
      'Timor'  => 'TP',
      'Togo'  => 'TG',
      'Tokelau'  => 'TK',
      'Tonga'  => 'TO',
      'Trinidad Tobago'  => 'TT',
      'Tschad'  => 'TD',
      'Tschechische Republik'  => 'CZ',
      'Tunesien'  => 'TN',
      'T&uuml;rkei'  => 'TR',
      'Turkmenistan'  => 'TM',
      'Turks und Kaikos Inseln'  => 'TC',
      'Tuvalu'  => 'TV',
      'Uganda'  => 'UG',
      'Ukraine'  => 'UA',
      'Ungarn'  => 'HU',
      'Uruguay'  => 'UY',
      'Usbekistan'  => 'UZ',
      'Vanuatu'  => 'VU',
      'Vatikan'  => 'VA',
      'Venezuela'  => 'VE',
      'Vereinigte Arabische Emirate'  => 'AE',
      'Vereinigte Staaten von Amerika'  => 'US',
      'Vietnam'  => 'VN',
      'Virgin Island (Brit.)'  => 'VG',
      'Virgin Island (USA)'  => 'VI',
      'Wallis et Futuna'  => 'WF',
      'Wei&szlig;ru&szlig;land'  => 'BY',
      'Westsahara'  => 'EH',
      'Zentralafrikanische Republik'  => 'CF',
      'Zimbabwe'  => 'ZW',
      'Zypern'  => 'CY'
        );

  foreach ($laender as $land => $kuerzel) {
    $options = (isset($options)?$options:'')."<option value=\"$kuerzel\"";
    if ($selected == $kuerzel) $options = $options." selected";
    $options = $options.">$land</option>\n";
  } 
  return $options;
}


/*

   function HauptMenu()
   {

//pruefe ob es cookie am rechner gibt   
if(0){


} else {
$this->BuildHauptMenu();

}


}

function BuildHauptMenu($usergroup="")
{
if($usergroup=="")
$usergroup = $this->User->GetType();

$user = $this->User->GetName();

// Allgemeine Regel
$datastruct = $this->DB->Select("SELECT datastruct FROM navigationcache WHERE user='".$this->User->GetID()."' AND usergroup='$usergroup' AND firma='".$this->User->GetFirma()."'");

if($datastruct=="")
$datastruct = $this->DB->Select("SELECT datastruct FROM navigationcache WHERE user='0' AND usergroup='$usergroup' AND firma='".$this->User->GetFirma()."'");


$menu = unserialize(base64_decode($datastruct));

$anzahl = count($menu);
$width = 100 / $anzahl;
$rowcount = 0;


if(is_array($menu))   
foreach($menu as $hauptmenu=>$hauptmenuuntergruppe)
{
$label = $hauptmenuuntergruppe[0][0];
$color = $hauptmenuuntergruppe[0][2];
$this->Tpl->Add(HAUPTMENU,"<td width=\"$width%\"style=\"background-color: $color\" align=\"center\"><a href=\"#\" onclick=\"setVisibility('hauptmenurow".$rowcount."')\">$label</a></td>");
if($rowcount < $anzahl /2) $posleft = 240; else $posleft=413;
$this->Tpl->Add(HAUPTMENUDIV,'<div id="hauptmenurow'.$rowcount.'" style="display: none; visibility: hidden; background-color: '.$color.'; 
position:absolute; top:40px; left:'.$posleft.'px; width: 800; height: 300; z-index: 1000;"><table width="800" height="300"><tr valign="top"><td>[HAUPTSUBMENU'.$rowcount.']</tr>
<tr height="20"><td align="right" colspan="'.$anzahl.'"><a href="#" onclick="setVisibility(\'hidden\');">Men&uuml; ausblenden</a></td></table></div>');
$this->Tpl->Add(HAUPTMENUJS,'document.getElementById("hauptmenurow'.$rowcount.'").style.visibility = "hidden";
document.getElementById("hauptmenurow'.$rowcount.'").style.display = "none";
');

// untermenu

for($i=1;$i<=count($hauptmenuuntergruppe[0]);$i++)
{

$this->Tpl->Add(HAUPTSUBMENU.$rowcount, "<td>");
$this->Tpl->Add(HAUPTSUBMENU.$rowcount, "<h3>".$hauptmenuuntergruppe[$i][0][0]."</h3>");
$this->Tpl->Add(HAUPTSUBMENU.$rowcount, "<ul>");

for($j=1;$j<=count($hauptmenuuntergruppe[$i]);$j++)
{
$label = $hauptmenuuntergruppe[$i][$j][0];
$link = $hauptmenuuntergruppe[$i][$j][1];
$this->Tpl->Add(HAUPTSUBMENU.$rowcount,"<li><a href=\"$link\">$label</a></li>"); 
}

$this->Tpl->Add(HAUPTSUBMENU.$rowcount, "</ul>");
$this->Tpl->Add(HAUPTSUBMENU.$rowcount, "</td>");

}


$rowcount++;
}
} 
*/
}





?>
