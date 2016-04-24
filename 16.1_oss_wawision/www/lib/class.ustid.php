<?php
include("IXR_Library.inc.php");
//$tmp = new USTID();
//echo $tmp->check("DE263136143","SE556459933901","Wind River AB","Kista","Finlandsgatan 52","16493","ja");
//echo $tmp->check("DE263136143","HU12925481","TGIF KFT.","Egerszaloki","3394","Szechenyiu","ja");
//echo $tmp->check("DE263136143","SE556459933901","jkjk","Kista","Finlandsgatan 52","16493","ja");
//echo "<br>";
//echo print_r($tmp->answer['Erg_Name']);

/*
$tmp->parse("UstId_1 DE263136143 ErrorCode 200 UstId_2 SE556459933901 Druck nein Erg_PLZ B Ort Kista Datum 04.07.2009 PLZ Finlandsgatan 52 Erg_Ort A Uhrzeit 20:17:09 Erg_Name A Gueltig_ab Gueltig_bis Strasse 16493 Firmenname Wind River AB Erg_Str D"); 
*/
class USTID
{
  var $answer;
  function ustid()
  { 
  }

  function check($ust1,$ust2,$firmenname,$ort,$strasse,$plz,$druck="nein",&$onlinefehler)
  { 
 
    $client = new IXR_Client('http://evatr.bff-online.de');
  
    if($druck!="ja")
      $druck="nein";

    if (!$client->query('evatrRPC',
                        $ust1,
			$ust2,
			$firmenname,
			$ort,
			$plz,
			$strasse,
			$druck))
    {
      $onlinefehler = $client->getErrorCode().":".$client->getErrorMessage();
      return -2;
    }

    $msg = new IXR_Message ($client->getResponse());
    $msg->parse();
    if(count($msg->params)>0)
    {
      for($i=0;$i<count($msg->params);$i++)
      {
	$this->answer[$msg->params[$i][0]]=$msg->params[$i][1];
      }
    }

    if($this->answer['ErrorCode']==200)
      return 1;
    else return -1;
  }


  function checkAndSendMailIfWrong()
  {

  }

  function errormessages($code)
  {
    $error[200]	= "Die angefragte USt-IdNr. ist gültig.";
    $error[201]	= "Die angefragte USt-IdNr. ist ungültig.";
    $error[202]	= "Die angefragte USt-IdNr. ist ungültig. Sie ist nicht in der Unternehmerdatei des betreffenden EU-Mitgliedstaates registriert.
    Hinweis:
    Ihr Geschäftspartner kann seine gültige USt-IdNr. bei der für ihn zuständigen Finanzbehörde in Erfahrung bringen. Möglicherweise muss er einen Antrag stellen, damit seine USt-IdNr. in die Datenbank aufgenommen wird.";
    $error[203]= "Die angefragte USt-IdNr. ist ungültig. Sie ist erst ab dem ... gültig (siehe Feld 'Gueltig_ab').";
    $error[204]= "Die angefragte USt-IdNr. ist ungültig. Sie war im Zeitraum von ... bis ... gültig (siehe Feld 'Gueltig_ab' und 'Gueltig_bis').";
    $error[205] ="Ihre Anfrage kann derzeit durch den angefragten EU-Mitgliedstaat oder aus anderen Gründen nicht beantwortet werden. Bitte versuchen Sie es später noch einmal. Bei wiederholten Problemen wenden Sie sich bitte an das Bundeszentralamt für Steuern - Dienstsitz Saarlouis.";
    $error[206] = "Ihre deutsche USt-IdNr. ist ungültig. Eine Bestätigungsanfrage ist daher nicht möglich. Den Grund hierfür können Sie beim Bundeszentralamt für Steuern - Dienstsitz Saarlouis - erfragen.";
    $error[207] = "Ihnen wurde die deutsche USt-IdNr. ausschliesslich zu Zwecken der Besteuerung des innergemeinschaftlichen Erwerbs erteilt. Sie sind somit nicht berechtigt, Bestätigungsanfragen zu stellen.";
    $error[208] ="Für die von Ihnen angefragte USt-IdNr. läuft gerade eine Anfrage von einem anderen Nutzer. Eine Bearbeitung ist daher nicht möglich. Bitte versuchen Sie es später noch einmal.";
    $errpr[209]	= "Die angefragte USt-IdNr. ist ungültig. Sie entspricht nicht dem Aufbau der für diesen EU-Mitgliedstaat gilt. ( Aufbau der USt-IdNr. aller EU-Länder)";
    $error[210]	 = "Die angefragte USt-IdNr. ist ungültig. Sie entspricht nicht den Prüfziffernregeln die für diesen EU-Mitgliedstaat gelten.";
    $error[211] = "Die angefragte USt-IdNr. ist ungültig. Sie enthält unzulässige Zeichen.";
    $error[212]="Die angefragte USt-IdNr. ist ungültig. Sie enthält ein unzulässiges Länderkennzeichen.";
    $error[213] =  "Die Abfrage einer deutschen USt-IdNr. ist nicht möglich.";
    $error[214] =  "Ihre deutsche USt-IdNr. ist fehlerhaft. Sie beginnt mit 'DE' gefolgt von 9 Ziffern.";
    $error[215]	=  "Ihre Anfrage enthält nicht alle notwendigen Angaben für eine einfache Bestätigungsanfrage (Ihre deutsche USt-IdNr. und die ausl. USt-IdNr.).
    Ihre Anfrage kann deshalb nicht bearbeitet werden.";
    $error[216]="Ihre Anfrage enthält nicht alle notwendigen Angaben für eine qualifizierte Bestätigungsanfrage (Ihre deutsche USt-IdNr., die ausl. USt-IdNr., Firmenname einschl. Rechtsform und Ort).
    Es wurde eine einfache Bestätigungsanfrage durchgeführt mit folgenden Ergebnis:
    Die angefragte USt-IdNr. ist gültig.";
    $error[217]="Bei der Verarbeitung der Daten aus dem angefragten EU-Mitgliedstaat ist ein Fehler aufgetreten. Ihre Anfrage kann deshalb nicht bearbeitet werden.";
    $error[218]="Eine qualifizierte Bestätigung ist zur Zeit nicht möglich. Es wurde eine einfache Bestätigungsanfrage mit folgendem Ergebnis durchgeführt:
    Die angefragte USt-IdNr. ist gültig.";
    $error[219] =  "Bei der Durchführung der qualifizierten Bestätigungsanfrage ist ein Fehler aufgetreten. Es wurde eine einfache Bestätigungsanfrage mit folgendem Ergebnis durchgeführt:
    Die angefragte USt-IdNr. ist gültig.";
    $error[220] = "Bei der Anforderung der amtlichen Bestätigungsmitteilung ist ein Fehler aufgetreten. Sie werden kein Schreiben erhalten.";
    $error[999]=  "Eine Bearbeitung Ihrer Anfrage ist zurzeit nicht möglich. Bitte versuchen Sie es später noch einmal. ";
    if($error[$code]!="")
      return $error[$code];
    else
      return "Kein gültiger Fehlercode vom Finanzamt-Server erhalten.";

  }
}


?>
