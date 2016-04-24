<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
	ini_set('display_errors', 1);
	$config_file = 'setup.conf.php';
	$output_folder = '../../conf/';

	if(!is_file($config_file) ) { echo 'Config-File is missing'; return; }
	include_once($config_file);

	#########################################################################
	$max_steps = count(array_filter($setup));
	$step = (($_GET['step']!='') ? $_GET['step'] : 1);
	$submit = $_POST['_SUBMIT'];


        $isSecure = false;
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
          $isSecure = true;
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
          $isSecure = true;
        }
        $REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';

        $weburl = $REQUEST_PROTOCOL."://".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT'].str_replace('setup/setup.php?step=5','',$_SERVER['REQUEST_URI'])."index.php?module=welcome&action=cronjob";
        $weburllink = $REQUEST_PROTOCOL."://".$_SERVER['SERVER_ADDR'].":".$_SERVER['SERVER_PORT'].str_replace('setup/setup.php?step=5','',$_SERVER['REQUEST_URI']);

	if($step>$max_steps){
		//GenerateConfigFiles($output_folder);
		//if($config['postinstall']) PostInstall();
		$page = HtmlTemplate("<h2>Setup erfolgreich beendet!</h2><hr><br><p>Um den Prozessstarter nutzen zu k&ouml;nnen: Tragen Sie folgendes Script in ihrer crontab ein:<br /><br /><pre style=\"font-size:9pt\">php5 ".str_replace('www/setup','',dirname(__FILE__))."cronjobs/starter.php</pre><br />"."oder lassen Sie die Seite<br><br /><a href=\"$weburl\" target=_blank>".$weburl."</a><br><br /> regelm&auml;ssig aufrufen. Am besten eignet sich ein Interval von einer Minute.</p>

<br><br>
<center>
<font color=red>Bitte l&ouml;schen Sie den Ordner setup!</font>
<br><br>
<br><br>
<a href=\"$weburllink\">Anmelden mit Benutzer: <i>admin</i> und Passwort: <i>admin</i></a></center>
");
	}else{
    $ok = true;
    if($step == 1)
    {
      $setup[$step]['description'] = stepMessage($step);
      $ok = stepFehler($step);
    }
		$page = GenerateHtml($step, $setup);
		if($ok){$page = str_replace('[BUTTON]', (($step<=$max_steps)?"<input type=\"submit\" name=\"_SUBMIT\" value=\"Weiter\">":""), $page);}else{$page = str_replace('[BUTTON]','',$page);}
	}

	if($submit!='') {
		$configfile = $_POST['_CONFIGFILE'];
		$action = $_POST['_ACTION'];
		unset($_POST['_CONFIGFILE']);
		unset($_POST['_ACTION']);
		unset($_POST['_SUBMIT']);

		$error = ((function_exists($action)) ? $action() : '');
		if($configfile=='')  $error .= "<br>'configfile' for this step is missing";

		if($error=='') {
			// Convert Fields to Session
			foreach($_POST as $key=>$value) 
				$_SESSION['setup'][$configfile][$key] = $value;
      if($step == 3)GenerateConfigFiles($output_folder);
      if($step == 3)CreateUserdata();
      if($step == 3)PostInstall();
			// execute Sql-Files
			$sql_prefix = "sql_";
			foreach($_POST as $key=>$value) {
				if(strlen($key)>strlen($sql_prefix) && substr($key,0,strlen($sql_prefix))==$sql_prefix && 
					$_SESSION['setup'][$configfile][substr($key,strlen($sql_prefix), strlen($key)-strlen($sql_prefix))]!=''){
					unset($_SESSION['setup'][$configfile][$key]);
					if(is_file($value)){
						 	$import = file_get_contents($value);

   						$import = preg_replace ("%/\*(.*)\*/%Us", '', $import);
   						$import = preg_replace ("%^--(.*)\n%mU", '', $import);
   						$import = preg_replace ("%^$\n%mU", '', $import);

							$db= mysqli_connect($_SESSION['setup'][$configfile]['WFdbhost'],$_SESSION['setup'][$configfile]['WFdbuser'],$_SESSION['setup'][$configfile]['WFdbpass']);

              mysqli_select_db($db,$_SESSION['setup'][$configfile]['WFdbname']);
                                                        mysqli_set_charset($db,"utf8");
                                                        mysqli_query($db,"SET SESSION SQL_MODE :=''");
              //mysql_real_escape_string($import); 
              $import = explode (";", $import); 

              foreach ($import as $imp){
                if ($imp != '' && $imp != ' ' && trim($imp) != ''){
                  
                  mysqli_query($db,$imp);
                  
                  
                  
                }
              }
              if(isset($_POST['BeispielTpl']) && $_POST['BeispielTpl'])
                       mysqli_query($db, "INSERT INTO `user` (`id`, `username`, `password`, `repassword`, `description`, `settings`, `parentuser`, `activ`, `type`, `adresse`, `fehllogins`, `standarddrucker`, `firma`, `logdatei`, `startseite`, `hwtoken`, `hwkey`, `hwcounter`, `motppin`, `motpsecret`, `passwordmd5`, `externlogin`, `projekt_bevorzugen`, `email_bevorzugen`, `projekt`, `rfidtag`, `vorlage`, `kalender_passwort`, `kalender_ausblenden`, `kalender_aktiv`, `gpsstechuhr`, `standardetikett`, `standardfax`, `internebezeichnung`, `hwdatablock`) VALUES
                      (3, 'demomitarbeiter', 'pllIX0pw7JU9c', 0, '', 'a:6:{s:16:\"pos_list_projekt\";s:1:\"0\";s:18:\"pos_list_kassierer\";s:1:\"0\";s:22:\"pos_list_kassierername\";s:1:\"0\";s:18:\"pos_list_lkadresse\";s:1:\"0\";s:18:\"lohnabrechnung_von\";s:0:\"\";s:18:\"lohnabrechnung_bis\";s:0:\"\";}', 0, 1, 'standard', 6, 0, 0, 1, '2015-10-26 16:01:23', '', 0, '', 0, '', '', '2ad71933e4b074c4671425c8e6b48021', 0, 0, 1, 0, '', '', '', 0, 0, 0, 0, 0, NULL, '');
                      ");
              mysqli_close($db);

              /*
						if(exec("mysql --user='{$_SESSION['setup'][$configfile]['WFdbuser']}' --password='{$_SESSION['setup'][$configfile]['WFdbpass']}' --host='{$_SESSION['setup'][$configfile]['WFdbhost']}' --database='{$_SESSION['setup'][$configfile]['WFdbname']}' < '$value'", $sql_out, $sql_status)==2)
							$error = "Konnte '$value' nicht ausf&uuml;hren";
						}else
							$error .= "Konnte '$value' nicht finden";
*/
					}
				}
			}

			// remove Readonly-Fields
			$ro_prefix = "ro_";
			foreach($_POST as $key=>$value) {
				if(strlen($key)>strlen($ro_prefix) && substr($key,0,strlen($ro_prefix))==$ro_prefix){
					unset($_SESSION['setup'][$configfile][substr($key,strlen($ro_prefix), strlen($key)-strlen($ro_prefix))]);
					unset($_SESSION['setup'][$configfile][$key]);
				}
			}

			if($error=='') {
				header('Location: ./setup.php?step='.++$step);
				exit;
			}else
				$page = str_replace('[MESSAGE]', "<div class=\"inputerror\">$error</div>", $page);
		}else
			$page = str_replace('[MESSAGE]', "<div class=\"inputerror\">$error</div>", $page);
	}

	$page = str_replace('[MESSAGE]','', $page);
	echo $page;


	function GenerateConfigFiles($output_folder)
	{
    $fehler = true;
    foreach($_SESSION['setup'] as $file=>$vars)$fehler = false;
		foreach($_SESSION['setup'] as $file=>$vars) {
			$out = "<?php\n";
			foreach($vars as $key=>$value)
      {
        if(strpos($key, 'WF') !== false){
          if($value=='true' || $value=='false') 
            $out .= '$this->'.$key.'='.$value.';'."\n";
          else
            $out .= '$this->'.$key.'=\''.$value.'\';'."\n";
        }
      }
    
			$out .= "?>";
      /*$out2 = "<?php\n";
      $out2 .= "  define('USEFPDF2',true);\r\n";
      $out2 .= "?>";
      if(!file_put_contents(dirname(__FILE__).'/../../conf/user_defined.php', $out2))$fehler = true;*/
			if(!file_put_contents($output_folder.$file, $out))$fehler = true;
		}
		return !$fehler;
	}	

	function GenerateHtml($step, $setup)
	{
		if(!array_key_exists($step, $setup)) { return "<h2>Page doesnt exist</h2>"; }

		$html = "";
		if(array_key_exists('description',$setup[$step])) $html .= "<h2>{$setup[$step]['description']}</h2><hr>";
		if(array_key_exists('configfile',$setup[$step])) $html .= "<input type=\"hidden\" name=\"_CONFIGFILE\" value=\"{$setup[$step]['configfile']}\">";
		if(array_key_exists('action',$setup[$step])) $html .= "<input type=\"hidden\" name=\"_ACTION\" value=\"{$setup[$step]['action']}\">";
		
		$fields = '';
		foreach($setup[$step]['fields'] as $key=>$value)
		{
			$name = $key;
			$text = ((array_key_exists('text',$value)) ? $value['text'] : $value);
			$type = ((array_key_exists('type',$value)) ? $value['type'] : "text");
			$note = ((array_key_exists('note',$value)) ? $value['note'] : "");
			$default = ((array_key_exists('default',$value)) ? $value['default'] : "");
			$options = ((array_key_exists('options',$value)) ? $value['options'] : array());
			$fvalue = ((array_key_exists('value',$value)) ? $value['value'] : "");
			$readonly = ((array_key_exists('readonly',$value)) ? $value['readonly'] : "");
			$sql = ((array_key_exists('sql',$value)) ? $value['sql'] : "");
			$invisible = ((array_key_exists('invisible',$value)) ? $value['invisible'] : "");

			if($readonly!="") $ro = "<input type=\"hidden\" name=\"ro_$name\" value=\"$name\">";
			if($sql!="") $mysql = "<input type=\"hidden\" name=\"sql_$name\" value=\"$sql\">";

			if($invisible=="")
			{
				if($type=='text')
					$input = "<input type=\"text\" style=\"width:250px\" name=\"$name\" value=\"$default\">";
				if($type=='password')
					$input = "<input type=\"password\" style=\"width:250px\" name=\"$name\" value=\"$default\">";


				if($type=='checkbox')
			  	$input = "<input type=\"checkbox\" name=\"$name\" value=\"$fvalue\">";

				if($type=='select') {
					$opt_out = '';
					foreach($options as $opt_value=>$opt_text){
						$selected = (($default!="" && $default==$opt_value) ? 'selected' : '');
						$opt_out .= "<option value=\"$opt_value\" $selected>$opt_text</option>";
					}
					$input = "<select name=\"$name\">$opt_out</select>";
				}
				$field = "<div class=\"row\"><div>$text</div><div>{$input}{$ro}{$mysql}</div><div>$note</div></div>\n";
			}else
				$field = "<input type=\"hidden\" name=\"$name\" value=\"1\">{$ro}{$mysql}";

			$fields .= $field;
		}
		$html .= "\n[MESSAGE]\n$fields\n[BUTTON]";
	
		$page = HtmlTemplate($html);

		return $page;
	}

	function HtmlTemplate($html)
	{
		return "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
		        <html><head><link rel=\"stylesheet\" type=\"text/css\" href=\"setup.css\" />
						<title>WaWision Installer</title>
						</head><body><div id=\"content\"><h1>WaWision Installer</h1><hr><form action=\"\" method=\"POST\">
						 {$html}
						</form><div id=\"footer\" style=\"font-size:8pt\">Nutzen Sie unseren <a href=\"http://shop.wawision.de/sonstige/1-jahr-zugang-updateserver-open-source-version.html?c=164\" target=\"_blank\">Update-Server</a> um auch mit der Open-Source Version mit Updates versorgt zu sein.&nbsp;<a href=\"http://www.wawision.de\">embedded projects GmbH &copy; 2009-2016</a></div></div></body></html>";
	}
?>
