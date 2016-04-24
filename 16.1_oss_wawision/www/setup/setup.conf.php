<?php
	$config['postinstall'] = true;

	/* ----------------- STEP 1 ----------------- */	
	$setup[1]['configfile'] = "user.inc.php";
	$setup[1]['description'] = 'Um dieses Setup auszuf&uuml;hren muss der Ordner <i>conf</i> Schreibrechte besitzen. Wenn diese passen klicken Sie auf ok (Diese Meldung dann ignorieren).';
	$setup[1]['action'] = "CheckDirRights";
	
	/* ----------------- STEP 2 ----------------- */
	
	$setup[2]['description'] = 'Schritt 2 - Datenbank-Einstellungen';
	$setup[2]['configfile'] = "user.inc.php";

	$setup[2]['fields']['WFdbhost']['text'] = "Host";
	$setup[2]['fields']['WFdbhost']['default'] = "localhost";
	$setup[2]['fields']['WFdbname'] = "Datenbank";
	$setup[2]['fields']['WFdbuser'] = "Benutzername";
	$setup[2]['fields']['WFdbpass']['text'] = "Passwort";
	$setup[2]['fields']['WFdbpass']['type'] = "password";

	$setup[2]['action'] = "CheckDatabase";

	/* ----------------- STEP 3 ----------------- */
	
	$setup[3]['description'] = 'Schritt 3 - Pfad f&uuml;r Dateien';
	$setup[3]['configfile'] = "user.inc.php";

	$setup[3]['fields']['WFuserdata']['text'] = "Userdata-Ordner";
	$setup[3]['fields']['WFuserdata']['default'] = str_replace("www\setup","userdata",str_replace("www/setup","userdata",getcwd()));
  
	$setup[3]['fields']['MainData']['invisible'] = "true";
	$setup[3]['fields']['MainData']['readonly'] = "true";
	$setup[3]['fields']['MainData']['sql'] = "../../database/struktur.sql";

  /*
	$setup[3]['fields']['InitialData']['invisible'] = "true";
	$setup[3]['fields']['InitialData']['readonly'] = "true";
	$setup[3]['fields']['InitialData']['sql'] = "../../database/init.sql";*/
/*
	$setup[3]['fields']['MainData']['invisible'] = "true";
	$setup[3]['fields']['MainData']['readonly'] = "true";
	$setup[3]['fields']['MainData']['sql'] = "../../database/main.sql";

	$setup[3]['fields']['InitialData']['invisible'] = "true";
	$setup[3]['fields']['InitialData']['readonly'] = "true";
	$setup[3]['fields']['InitialData']['sql'] = "../../database/initial.sql";*/
  $setup[3]['action'] = "CreateUserdata";

	/* ----------------- STEP 4 ----------------- */

	$setup[4]['description'] = 'Schritt 4 - Testdaten';
	$setup[4]['configfile'] = "user.inc.php";
  $setup[4]['fields']['BeispielTpl']['text'] = "Testdaten einspielen (empfohlen)";
	$setup[4]['fields']['BeispielTpl']['type'] = "checkbox";
	$setup[4]['fields']['BeispielTpl']['value'] = "1";
	$setup[4]['fields']['BeispielTpl']['readonly'] = "true";
	$setup[4]['fields']['BeispielTpl']['sql'] = "../../database/beispiel.sql";
  
/*
	$setup[4]['fields']['MailTpl']['text'] = "E-Mail Templates einspielen (empfohlen)";
	$setup[4]['fields']['MailTpl']['type'] = "checkbox";
	$setup[4]['fields']['MailTpl']['value'] = "1";
	$setup[4]['fields']['MailTpl']['readonly'] = "true";
	$setup[4]['fields']['MailTpl']['sql'] = "../../database/emailtemplates.sql";

	$setup[4]['fields']['DhlZones']['text'] = "DHL-Zonen einspielen";
	$setup[4]['fields']['DhlZones']['type'] = "checkbox";
	$setup[4]['fields']['DhlZones']['value'] = "1";
	$setup[4]['fields']['DhlZones']['readonly'] = "true";
	$setup[4]['fields']['DhlZones']['sql'] = "../../database/dhlzones.sql";
	
	$setup[4]['fields']['Testdata']['text'] = "Mustershop-Datens&auml;tze einspielen";
	$setup[4]['fields']['Testdata']['type'] = "checkbox";
	$setup[4]['fields']['Testdata']['value'] = "1";
	$setup[4]['fields']['Testdata']['readonly'] = "true";
	$setup[4]['fields']['Testdata']['sql'] = "../../database/shopdata.sql";

	
  
	$setup[4]['fields']['ArticleData']['text'] = "Beispielartikel einspielen (nur mit Mustershop-Option)";
	$setup[4]['fields']['ArticleData']['type'] = "checkbox";
	$setup[4]['fields']['ArticleData']['value'] = "1";
	$setup[4]['fields']['ArticleData']['readonly'] = "true";
	$setup[4]['fields']['ArticleData']['sql'] = "../../database/testarticles.sql";*/

	/* ------------------------- Functions ------------------------- */

  function pruefe($step)
  {
    if($step == 1)
    {
      
      $tmpfile = md5(microtime(true));

      if(!($fh = fopen('../../conf/'.$tmpfile,'w')))
      {

        $tmp['status'] = 'error';
        $tmp['text'] = 'Der Ordner conf besitzt unzureichende Schreibrechte';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'Der Ordner conf besitzt Schreibrechte';      
        $ret[] = $tmp; 
        fclose($fh);
        unlink('../../conf/'.$tmpfile);

        
      }
      if(!($fh = fopen('../../backup/'.$tmpfile,'w')))
      {

        $tmp['status'] = 'error';
        $tmp['text'] = 'Der Ordner backup besitzt unzureichende Schreibrechte';
        $ret[] = $tmp;        
      } else {
        fclose($fh);
        unlink('../../backup/'.$tmpfile);
        $tmp['status'] = 'ok';
        $tmp['text'] = 'Der Ordner backup besitzt Schreibrechte';      
        $ret[] = $tmp;
      }
      if(!($fh = fopen('../../userdata/'.$tmpfile,'w')))
      {

        $tmp['status'] = 'error';
        $tmp['text'] = 'Der Ordner userdata besitzt unzureichende Schreibrechte';
        $ret[] = $tmp;        
      } else {
        fclose($fh);
        $eigenguser = fileowner('../../userdata/'.$tmpfile);
        $eigengroup = filegroup('../../userdata/'.$tmpfile);
        $uploaduser = fileowner(__FILE__);
        $uploadgroup = filegroup(__FILE__);
        
        if($eigenguser !== $uploaduser)
        {
          $tmp['status'] = 'warning';
          $tmp['text'] = 'Die Dateieigent&uuml;mer stimmten nicht mit dem des Webservers &uuml;berein';
          $ret[] = $tmp;          
        } else {
          
          
        }
        unlink('../../userdata/'.$tmpfile);
        $tmp['status'] = 'ok';
        $tmp['text'] = 'Der Ordner userdata besitzt Schreibrechte';      
        $ret[] = $tmp;
      }      
      
      /*
      $rights = substr(sprintf('%o', fileperms('../../conf')), -3, 1);
      if($rights!='7')
      {
        $tmp['status'] = 'error';
        $tmp['text'] = 'Der Ordner conf besitzt unzureichende Schreibrechte';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'Der Ordner conf besitzt Schreibrechte';      
        $ret[] = $tmp;      
      }*/
      if(!function_exists('fsockopen'))
      {
        $tmp['status'] = 'error';
        $tmp['text'] = 'fsocket nicht installiert!';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'fsocket verf&uuml;gbar';      
        $ret[] = $tmp;          
      }
      if(!function_exists('mysqli_connect'))
      {
        $tmp['status'] = 'error';
        $tmp['text'] = 'MYSQLi nicht installiert';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'MYSQLi verf&uuml;gbar';      
        $ret[] = $tmp;          
      }
      
      if(!function_exists('curl_init'))
      {
        $tmp['status'] = 'error';
        $tmp['text'] = 'cURL nicht installiert';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'cURL verf&uuml;gbar';      
        $ret[] = $tmp;          
      }
      
      if(!function_exists('stream_socket_enable_crypto'))
      {
        $tmp['status'] = 'error';
        $tmp['text'] = 'stream_socket_enable_crypto nicht installiert';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'stream_socket_enable_crypto verf&uuml;gbar';      
        $ret[] = $tmp;          
      }
      
      if(!function_exists('openssl_error_string'))
      {
        $tmp['status'] = 'warning';
        $tmp['text'] = 'OpenSSL nicht installiert';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'OpenSSL verf&uuml;gbar';      
        $ret[] = $tmp;          
      }

      if(!function_exists('exec'))
      {
        $tmp['status'] = 'error';
        $tmp['text'] = 'exec nicht installiert';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'exec verf&uuml;gbar';      
        $ret[] = $tmp;          
      }
      if(!function_exists('imap_open'))
      {
        $tmp['status'] = 'warning';
        $tmp['text'] = 'imap nicht installiert';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'imap verf&uuml;gbar';      
        $ret[] = $tmp;          
      } 
      
      if(!function_exists('ioncube_loader_version'))
      {
        $tmp['status'] = 'warning';
        $tmp['text'] = 'Ioncube ist nicht installiert (Eine Installation ist trotzdem m&ouml;glich)';
        $ret[] = $tmp;
      } else {
        $tmp['status'] = 'ok';
        $tmp['text'] = 'Ioncube verf&uuml;gbar';      
        $ret[] = $tmp;          
      }

      if(!file_exists("../../database/main.sql") || !file_exists("../../database/initial.sql"))
      {
        $tmp['status'] = 'error';
        $tmp['text'] = 'Initial Datenbanken nicht vorhanden';
        $ret[] = $tmp;
      }
      if(!file_exists("../../database/testarticles.sql") || !file_exists("../../database/shopdata.sql") || !file_exists("../../database/emailtemplates.sql") || !file_exists("../../database/dhlzones.sql"))
      { 
        $tmp['status'] = 'warning';
        $tmp['text'] = 'Beispiel-Datenbanken nicht vorhanden';
        $ret[] = $tmp;
      }
      
      
      
      return $ret;
    } else {
      return false;
      
    }
  }
  
  function CreateUserdata()
  {
		foreach($_SESSION['setup'] as $file=>$vars) {
			$out = "<?php\n";
			foreach($vars as $key=>$value)
      {
        if($key == 'WFuserdata')
        {
          if(!is_dir($value))
          {
            if(!@mkdir($value,0777))return 'Userdata-Ordner konnte nicht erstellt werden!';

          }
          if(!is_dir($value.'/dms'))mkdir($value.'/dms',0777);
          if(!is_dir($value.'/tmp'))mkdir($value.'/tmp',0777);
          if(!is_dir($value.'/pdfmirror'))mkdir($value.'/pdfmirror',0777);
          if(!is_dir($value.'/emailbackup'))mkdir($value.'/emailbackup',0777);
        }
      }
    }
    return '';
  }
  
  function stepMessage($step)
  {
    $erg = pruefe($step);
    $ret = '';
    if($erg){
      if($step == 1)
      {
        $ret = '<div>Schritt 1 - Pr&uuml;fe Serverfunktionen:</div><br>';
      }
      foreach($erg as $Message)
      {
        $ret .= '<div class="box" style="font-size:12px;background-color:'.($Message['status'] == 'error'?'#FA5858':($Message['status'] == 'warning'?'#F4FA58':'#9FF781')).';">'.$Message['text']."</div><div style=\"height:10px;\"></div>\r\n";
      }
      return $ret;
    } else return $setup[$step]['description'];
    
  }
  
  function stepFehler($step)
  {
    $erg = pruefe($step);
    if($erg)
    {
      foreach($erg as $Message)
      {
        if($Message['status'] == 'error')return false;
        
      }
    }
    return true;
  }
  
 	function CheckDirRights()
	{
		$rights = substr(sprintf('%o', fileperms('../../conf')), -3, 1);
		if($rights!='7')
			return "Der Ordner conf besitzt unzureichende Schreibrechte";
		return "";
	}

	function CheckDatabase()
	{
	  global $db;
		$db = mysqli_connect($_POST['WFdbhost'], $_POST['WFdbuser'], $_POST['WFdbpass'],$_POST['WFdbname']);

		if(!$db) return 'Verbindung zum Server nicht m&ouml;glich - m&ouml;glicherweise ist Host, Benutzername oder Passwort falsch geschrieben'; 
		//if(!mysqli_select_db($db,$_POST['WFdbname'], $db)) return 'Verbindung zur Datenbank nicht m&ouml;glich - m&ouml;glicherweise ist der Datenbankname falsch geschrieben';

		return '';
	}

	function CheckMail()
	{
		$smtp_conn = fsockopen($_POST['WFMailHost'], $_POST['WFMailPort'], $errno, $errstr, 30);
		
		if(empty($smtp_conn)) 
			return "Verbindung zum Server nicht m&ouml;glich<br>$errstr";


		return '';//'Konnte E-Mail nicht finden';
	}

	function CheckOther()
	{
		return '';
	}

	function PostInstall()
	{
		// Copy main.conf.php.tpl to main.conf.php.tpl
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
    {
			copy('..\..\conf\main.conf.php.tpl','..\..\conf\main.conf.php');
      copy('..\..\conf\user_defined.php.tpl','..\..\conf\user_defined.php');
    }
		else
		{	
      copy("../../conf/main.conf.php.tpl","../../conf/main.conf.php");
      copy("../../conf/user_defined.php.tpl","../../conf/user_defined.php");
    }
	}
?>
