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
class Benutzer 
{
  function Benutzer($app)
  {
    $this->app=&$app; 

    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","UserCreate");
    $this->app->ActionHandler("delete","UserDelete");
    $this->app->ActionHandler("edit","UserEdit");
    $this->app->ActionHandler("list","UserList");
    $this->app->ActionHandler("chrights","UserChangeRights");

    $this->app->DefaultActionHandler("list");

    //$this->Templates = $this->GetTemplates();

    $this->app->ActionHandlerListen($app);
  }

  function UserList()
  {
    //		$this->app->Tpl->Add(KURZUEBERSCHRIFT,"Benutzer");
    $this->app->erp->MenuEintrag("index.php?module=benutzer&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=benutzer&action=create","Neuen Benutzer anlegen");
    $this->app->erp->MenuEintrag("index.php?module=einstellungen&action=list","Zur&uuml;ck zur &Uuml;bersicht");

    $this->app->YUI->TableSearch('USER_TABLE',"userlist");
    $this->app->Tpl->Parse('PAGE', "benutzer_list.tpl");

  }


  function UserDelete()
  {
    $id = $this->app->Secure->GetGET("id");

    // Lager reseten
    $username = $this->app->DB->Select("SELECT username FROM user WHERE id='$id'");
    $this->app->DB->Delete("DELETE FROM user WHERE id='$id'");

    $this->app->Tpl->Set('MESSAGE',"<div class=\"error\">Der Benutzer \"$username\" wurde gel&ouml;scht</div>");

    $this->UserList();
  }


  function UserCreate()
  {
    //		$this->app->Tpl->Add(KURZUEBERSCHRIFT,"Benutzer");
    $this->app->erp->MenuEintrag("index.php?module=benutzer&action=list","Zur&uuml;ck zur &Uuml;bersicht");

    $input = $this->GetInput();
    $submit = $this->app->Secure->GetPOST('submituser');

    if($submit!='') {




      if($input['username']=='' && $this->app->Secure->GetPOST('hwtoken') != 4) $error .= 'Geben Sie bitte einen Benutzernamen ein.<br>';		
      if($input['password']=='' && $this->app->Secure->GetPOST('hwtoken') != 4) $error .= 'Geben Sie bitte ein Passwort ein.<br>';		
      if($input['repassword']=='' && $this->app->Secure->GetPOST('hwtoken') != 4) $error .= 'Wiederholen Sie bitte Ihr Passwort.<br>';		
      if($input['password'] != $input['repassword']) $error .= 'Die eingegebenen Passw&ouml;rter stimmen nicht &uuml;berein.<br>';
      if($this->app->DB->Select("SELECT '1' FROM user WHERE username='{$input['username']}' LIMIT 1")=='1')
        $error .= "Es existiert bereits ein Benutzer mit diesem Namen";

      $input['adresse'] = $this->app->erp->ReplaceAdresse($input['adresse'],$input['adresse'],1);
      $input['projekt'] = $this->app->erp->ReplaceProjekt($input['projekt'],$input['projekt'],1);

      if($input['adresse'] <=0)
        $error .= 'Geben Sie bitte eine g&uuml;tige Adresse aus den Stammdaten an.<br>';

      if($error!='')
        $this->app->Tpl->Set('MESSAGE', "<div class=\"error\">$error</div>");
      else {
        if($input['hwtoken'] == 4 && $input['type'] == 'admin')
        {
          $input['type'] = 'standard';
          $input['startseite'] = 'index.php?module=stechuhr&action=list';         
        }
        $id = $this->app->erp->CreateBenutzer($input);

        //$this->app->Tpl->Set('MESSAGE', "<div class=\"success\">Der Benutzer wurde erfolgreich angelegt</div>");
        $msg = $this->app->erp->base64_url_encode("<div class=\"success\">Der Benutzer wurde erfolgreich angelegt</div>");
        header("Location: index.php?module=benutzer&action=edit&id=$id&msg=$msg");
        exit;
      }
    }

    $this->SetInput($input);
    $this->app->Tpl->Set('ACTIVCHECKED',"checked");
    $this->app->Tpl->Parse('PAGE', "benutzer_create.tpl");
  }

  function UserEdit()
  {
    $id = $this->app->Secure->GetGET('id');
    $this->app->erp->MenuEintrag("index.php?module=benutzer&action=edit&id=$id","Details");
    $username = $this->app->DB->Select("SELECT username FROM user WHERE id='$id'");
    //		$this->app->Tpl->Add(KURZUEBERSCHRIFT2,$username);

    $this->app->erp->MenuEintrag("index.php?module=benutzer&action=list","Zur&uuml;ck zur &Uuml;bersicht");

    $id = $this->app->Secure->GetGET('id');
    $input = $this->GetInput();
    $submit = $this->app->Secure->GetPOST('submituser');
    $benutzer = $this->app->DB->Select("SELECT description FROM user WHERE id='$id' LIMIT 1");
    $name_angezeigt = $this->app->DB->Select("SELECT adresse FROM user WHERE id='$id' LIMIT 1");
    $name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='$name_angezeigt' LIMIT 1");
    if($benutzer!="")$tmp = "(".$benutzer.")";
    $this->app->Tpl->Add('KURZUEBERSCHRIFT2',$name." ".$tmp);


    if(is_numeric($id) && $submit!='') {


      $error = '';
      if($input['username']=='') $error .= 'Geben Sie bitte einen Benutzernamen ein.<br>';
      if($input['password'] != $input['repassword']) $error .= 'Die eingegebenen Passw&ouml;rter stimmen nicht &uuml;berein.<br>';

      $input['adresse'] = $this->app->erp->ReplaceAdresse(1,$input['adresse'],1);
      if($input['adresse'] <=0)
        $error .= 'Geben Sie bitte eine g&uuml;tige Adresse aus den Stammdaten an.<br>';

      $input['projekt'] = $this->app->erp->ReplaceProjekt(1,$input['projekt'],1);



      if($error!='')
        $this->app->Tpl->Set('MESSAGE', "<div class=\"error\">$error</div>");
      else {
        $settings = base64_encode(serialize($input['settings']));
        $firma = $this->app->User->GetFirma();

        if($input['gpsstechuhr']!="1")
        {
          $check = $this->app->DB->Delete("DELETE FROM gpsstechuhr 
              WHERE user='".$id."'
              AND DATE_FORMAT(zeit,'%Y-%m-%d')= DATE_FORMAT( NOW( ) , '%Y-%m-%d' ) LIMIT 1");
        }
        
        if($input['hwtoken'] == 4 && $input['type'] == 'admin')
        {
          $anzaktivadmin = $this->app->DB->Select("SELECT count(*) from user where activ=1 and type = 'admin' and id <> '$id'");
          if($anzaktivadmin < 1)
          {
            $error = 'Sie k&ouml;nnen den einzigen Administrator als Stechuhruer einbinden. Legen Sie daf&uuml;r einen neuen User an';
            $this->app->Tpl->Set('MESSAGE', "<div class=\"error\">$error</div>");
          } else {
            $input['type'] = 'standard';
            $input['startseite'] = 'index.php?module=stechuhr&action=list';
          }
          
        }
        if($error == "")
        {
          if($input['hwtoken'] == 4)
          {
            $stechuhrdevice = $this->app->DB->Select("SELECT stechuhrdevice from user where id = '$id'");
            if(substr($input['username'], 0,6) !== substr($stechuhrdevice,0,6))$this->app->DB->Update("UPDATE user set stechuhrdevice = '' where id = '$id'");
          }
          
          
          $this->app->DB->Update("UPDATE user SET username='{$input['username']}', description='{$input['description']}', settings='{$settings}',
              activ='{$input['activ']}', type='{$input['type']}', adresse='{$input['adresse']}', vorlage='{$input['vorlage']}',
              gpsstechuhr='{$input['gpsstechuhr']}',
              rfidtag='{$input['rfidtag']}',
              kalender_aktiv='{$input['kalender_aktiv']}',
              kalender_ausblenden='{$input['kalender_ausblenden']}',
              projekt='{$input['projekt']}',
              projekt_bevorzugen='{$input['projekt_bevorzugen']}',
              email_bevorzugen='{$input['email_bevorzugen']}',
              fehllogins='{$input['fehllogins']}', standarddrucker='{$input['standarddrucker']}',standardetikett='{$input['standardetikett']}',
              standardfax='{$input['standardfax']}',
              startseite='{$input['startseite']}', hwtoken='{$input['hwtoken']}', hwkey='{$input['hwkey']}', 
              hwcounter='{$input['hwcounter']}', hwdatablock='{$input['hwdatablock']}', motppin='{$input['motppin']}',
              motpsecret='{$input['motpsecret']}', externlogin='{$input['externlogin']}', firma='$firma',
              kalender_passwort='{$input['kalender_passwort']}' WHERE id='$id' LIMIT 1");

          if($input['password']!='' && $input['password']!='***************')
            $this->app->DB->Update("UPDATE user SET password=ENCRYPT('{$input['password']}'),passwordmd5=MD5('{$input['password']}') WHERE id='$id' LIMIT 1");

          $this->app->Tpl->Set('MESSAGE', "<div class=\"success\">Die Einstellungen wurden erfolgreich &uuml;bernommen.</div>");

          $this->app->erp->AbgleichBenutzerVorlagen($id);
        }
      }	
    }

    $data = $this->app->DB->SelectArr("SELECT * FROM user WHERE id='$id' LIMIT 1");
    if(is_array($data[0])) {
      $data[0]['password'] = '***************';
      $data[0]['repassword'] = '***************';
      //			$data[0]['motpsecret']	= $this->app->DB->Select("SELECT DECRYPT('{$input[0]['motpsecret']}')");
      //			$data[0]['hwkey']	= $this->app->DB->Select("SELECT DECRYPT('{$input[0]['hwkey']}')");
      $data[0]['settings'] = unserialize(base64_decode($data[0]['settings']));
    }

    if($data[0]['type']=="admin")
      $this->app->Tpl->Set('HINWEISADMIN',"<br><br><div class=\"info\">Dieser Benutzer ist vom Typ Administrator. Administratoren k&ouml;nnen keine Rechte genommen werden.</div>");
    $this->SetInput($data[0]);

    $this->UserRights();
    $this->app->Tpl->Parse('PAGE', "benutzer_create.tpl");
  }

  function GetInput()
  {
    $input = array();
    $input['description'] = $this->app->Secure->GetPOST('description');
    $input['type'] = $this->app->Secure->GetPOST('type');
    $input['username'] = $this->app->Secure->GetPOST('username');
    $input['vorlage'] = $this->app->Secure->GetPOST('vorlage');
    $input['adresse'] = $this->app->Secure->GetPOST('adresse');
    $input['externlogin'] = $this->app->Secure->GetPOST('externlogin');
    $input['activ'] = $this->app->Secure->GetPOST('activ');
    $input['gpsstechuhr'] = $this->app->Secure->GetPOST('gpsstechuhr');
    $input['rfidtag'] = $this->app->Secure->GetPOST('rfidtag');
    $input['kalender_aktiv'] = $this->app->Secure->GetPOST('kalender_aktiv');
    $input['kalender_ausblenden'] = $this->app->Secure->GetPOST('kalender_ausblenden');
    $input['projekt'] = $this->app->Secure->GetPOST('projekt');
    $input['projekt_bevorzugen'] = $this->app->Secure->GetPOST('projekt_bevorzugen');
    $input['email_bevorzugen'] = $this->app->Secure->GetPOST('email_bevorzugen');
    $input['startseite'] = $this->app->Secure->GetPOST('startseite');
    $input['fehllogins'] = $this->app->Secure->GetPOST('fehllogins');
    $input['password'] = $this->app->Secure->GetPOST('password');
    $input['repassword'] = $this->app->Secure->GetPOST('repassword');
    $input['hwtoken'] = $this->app->Secure->GetPOST('hwtoken');
    $input['motppin'] = $this->app->Secure->GetPOST('motppin');
    $input['motpsecret'] = $this->app->Secure->GetPOST('motpsecret');
    $input['hwkey'] = $this->app->Secure->GetPOST('hwkey');
    $input['hwcounter'] = $this->app->Secure->GetPOST('hwcounter');
    $input['hwdatablock'] = $this->app->Secure->GetPOST('hwdatablock');
    $input['standarddrucker'] = $this->app->Secure->GetPOST('standarddrucker');
    $input['standardetikett'] = $this->app->Secure->GetPOST('standardetikett');
    $input['standardfax'] = $this->app->Secure->GetPOST('standardfax');
    $input['settings'] = $this->app->Secure->GetPOST('settings');
    $input['kalender_passwort'] = $this->app->Secure->GetPOST('kalender_passwort');
    return $input;
  }

  function SetInput($input)
  {
    $this->app->Tpl->Set('DESCRIPTION', $input['description']);
    $this->app->Tpl->Set('TYPESELECT', $this->TypeSelect($input['type']));
    $this->app->Tpl->Set('USERNAME', $input['username']);
    $this->app->Tpl->Set('VORLAGE', $input['vorlage']);
    $this->app->Tpl->Set('ADRESSE', $this->app->erp->ReplaceAdresse(0,$input['adresse'],0));
    $this->app->Tpl->Set('PROJEKT', $this->app->erp->ReplaceProjekt(0,$input['projekt'],0));
    $this->app->Tpl->Set('RFIDTAG', $input['rfidtag']);

    $this->app->YUI->AutoComplete("adresse","adresse");
    $this->app->YUI->AutoComplete("vorlage","uservorlage");
    $this->app->YUI->AutoComplete("projekt","projektname",1);

    if($input['externlogin']=='1') $this->app->Tpl->Set('EXTERNLOGINCHECKED', 'checked');
    if($input['activ']=='1') $this->app->Tpl->Set('ACTIVCHECKED', 'checked');
    if($input['gpsstechuhr']=='1') $this->app->Tpl->Set('GPSSTECHUHRCHECKED', 'checked');
    if($input['kalender_aktiv']=='1') $this->app->Tpl->Set('KALENDERAKTIVCHECKED', 'checked');
    if($input['kalender_ausblenden']=='1') $this->app->Tpl->Set('KALENDERAUSBLENDENCHECKED', 'checked');
    if($input['projekt_bevorzugen']=='1') $this->app->Tpl->Set('PROJEKTBEVORZUGENCHECKED', 'checked');
    if($input['email_bevorzugen']=='1') $this->app->Tpl->Set('EMAILBEVORZUGENCHECKED', 'checked');

    $this->app->Tpl->Set('STARTSEITE', $input['startseite']);
    $this->app->Tpl->Set('FEHLLOGINS', $input['fehllogins']);
    $this->app->Tpl->Set('PASSWORD', $input['password']);
    $this->app->Tpl->Set('REPASSWORD', $input['repassword']);
    $this->app->Tpl->Set('TOKENSELECT', $this->TokenSelect($input['hwtoken']));
    $this->app->Tpl->Set('MOTPPIN', $input['motppin']);
    $this->app->Tpl->Set('MOTPSECRET', $input['motpsecret']);
    $this->app->Tpl->Set('HWKEY', $input['hwkey']);
    $this->app->Tpl->Set('HWCOUNTER', $input['hwcounter']);
    $this->app->Tpl->Set('HWDATABLOCK', $input['hwdatablock']);
    $this->app->Tpl->Set('STANDARDDRUCKER', $this->app->erp->GetSelectDrucker($input['standarddrucker']));
    $this->app->Tpl->Set('STANDARDETIKETT', $this->app->erp->GetSelectEtikettenDrucker($input['standardetikett']));
    $this->app->Tpl->Set('STANDARDFAX', $this->app->erp->GetSelectFax($input['standardfax']));
    $this->app->Tpl->Set('SETTINGS', $input['settings']);
    $this->app->Tpl->Set('SERVERNAME', $this->app->erp->UrlOrigin($_SERVER));
    $this->app->Tpl->Set('KALENDERPASSWORT', $input['kalender_passwort']);
  }

  function TypeSelect($select='admin')
  {
    $data = array('standard'=>'Benutzer','admin'=>'Administrator');
    //, 'verwaltung'=>'Verwaltung', 'vollzugriff'=>'Vollzugriff', 'mitarbeiter'=>'Mitarbeiter', 'produktion'=>'Produktion');

    $out = "";
    foreach($data as $key=>$value) {
      $selected = (($select==$key) ? 'selected' : '');
      $out .= "<option value=\"$key\" $selected>$value</option>";
    }
    return $out;
  }

  function TokenSelect($select='0')
  {
    //$data = array('0'=>'Benutzername + Passwort', '1'=>'Benutzername + Passwort + mOTP', '2'=>'Benutzername + Passwort + Picosafe Login','3'=>'WaWision OTP + Passwort');
    $data = array('0'=>'Benutzername + Passwort', 
        '3'=>'WaWision LoginKey + Benutzername + Passwort',
        '1'=>'mOTP + Benutzername + Passwort'
        );

    if($this->app->erp->RechteVorhanden('stechuhrdevice','list'))
    {
      $data['4'] = 'Mitarbeiterzeiterfassung QR-Code';
      
    }

    $out = "";
    foreach($data as $key=>$value) {
      $selected = (($select==$key) ? 'selected' : '');
      $out .= "<option value=\"$key\" $selected>$value</option>";
    }
    return $out;
  }

  function UserRights()
  {
    $id = $this->app->Secure->GetGET('id');
    $template = $this->app->Secure->GetPOST('usertemplate');
    $copytemplate = $this->app->Secure->GetPOST('copyusertemplate');
    $hwtoken = $this->app->DB->Select("SELECT hwtoken FROM user where id = '$id' LIMIT 1");
    $modules = $this->ScanModules();
    if($hwtoken == 4)
    {
      foreach($modules as $module=>$actions) {
        $lower_m = strtolower($module);	
        $curModule++;
        $actioncount = count($actions);
        for($i=0;$i<$actioncount;$i++) {
          $delimiter = (($curModule<$modulecount || $i+1<$actioncount) ? ', ' : ';');  
          $active = 0;
          if($lower_m == 'stechuhr' && ($actions[$i] == 'list' || $actions[$i] == 'change'))$active = 1;
          if($active==1)
            $this->app->DB->Insert("INSERT INTO userrights (user, module, action, permission) VALUES ('$id', '$lower_m', '{$actions[$i]}', '$active')");
        }        
      }     
    }else {

      if($template!='') {
        $mytemplate = $this->app->Conf->WFconf['permissions'][$template];
        $this->app->DB->Delete("DELETE FROM userrights WHERE user='$id'");
        //$sql = 'INSERT INTO userrights (user, module, action, permission) VALUES ';

        $modulecount = count($modules);
        $curModule = 0;
        foreach($modules as $module=>$actions) {
          $lower_m = strtolower($module);	
          $curModule++;
          $actioncount = count($actions);
          for($i=0;$i<$actioncount;$i++) {
            $delimiter = (($curModule<$modulecount || $i+1<$actioncount) ? ', ' : ';');  
            $active = ((isset($mytemplate[$lower_m]) && in_array($actions[$i], $mytemplate[$lower_m])) ? '1' : '0');
            if($active==1)
              $this->app->DB->Insert("INSERT INTO userrights (user, module, action, permission) VALUES ('$id', '$lower_m', '{$actions[$i]}', '$active')");
          }
        }
        //$this->app->DB->Query($sql);
      }

      if($copytemplate!='') {
        //			echo "User $id $copytemplate";	
        $this->app->DB->Delete("DELETE FROM userrights WHERE user='$id'");
        $this->app->DB->Update("INSERT INTO userrights (user, module,action,permission) (SELECT '$id',module, action,permission FROM userrights WHERE user='".$copytemplate."')");
      }
    }

    $dbrights = $this->app->DB->SelectArr("SELECT module, action, permission FROM userrights WHERE user='$id' ORDER BY module");
    $group = $this->app->DB->Select("SELECT type FROM user WHERE id='$id' LIMIT 1");

    $rights = $this->app->Conf->WFconf['permissions'][$group];
    if(is_array($dbrights) && count($dbrights)>0) 
      $rights = $this->AdaptRights($dbrights, $rights, $group);

    $modules = $this->ScanModules();
    $table = $this->CreateTable($id, $modules, $rights);	


    //$this->app->Tpl->Set('USERTEMPLATES', $this->TemplateSelect());	
    $this->app->Tpl->Set('USERNAMESELECT', $this->app->erp->GetSelectUser("",$id));	
    $this->app->Tpl->Set('MODULES', $table);
  }

  function UserChangeRights()
  {
    $user = $this->app->Secure->GetGET('b_user');
    $module = $this->app->Secure->GetGET('b_module');
    $action = $this->app->Secure->GetGET('b_action');
    $value = $this->app->Secure->GetGET('b_value');

    if(is_numeric($user) && $module!='' && $action!='' && $value!='') {
      $id = $this->app->DB->Select("SELECT id FROM userrights WHERE user='$user' AND module='$module' AND action='$action' LIMIT 1");
      if(is_numeric($id) && $id>0)
      {
        if($value=="1")
          $this->app->DB->Update("UPDATE userrights SET permission='$value' WHERE id='$id' LIMIT 1");
        else
          $this->app->DB->Delete("DELETE FROM userrights WHERE user='$user' AND module='$module' AND action='$action'");
      }
      //$this->app->DB->Update("UPDATE userrights SET permission='$value' WHERE id='$id' LIMIT 1");
      else
        $this->app->DB->Insert("INSERT INTO userrights (user, module, action, permission) VALUES ('$user', '$module', '$action', '$value')");
    }

    echo $this->app->DB->Select("SELECT permission FROM userrights WHERE user='$user' AND module='$module' AND action='$action' LIMIT 1");


    exit;
  }



  function AdaptRights($dbarr, $rights) 
  {
    $cnt = count($dbarr);
    for($i=0;$i<$cnt;$i++) {
      $module = $dbarr[$i]['module'];
      $action = $dbarr[$i]['action'];
      $perm = $dbarr[$i]['permission'];

      if(isset($rights[$module])) {
        if($perm=='1' && !in_array($action, $rights[$module])) 
          $rights[$module][] = $action;

        if($perm=='0' && in_array($action, $rights[$module])) {
          $index = array_search($action, $rights[$module]);
          unset($rights[$module][$index]);
          $rights[$module] = array_values($rights[$module]);
        }
      }else if($perm=='1') $rights[$module][] = $action;
    }
    return $rights;
  }

  function CreateTable($user, $modules, $rights) 
  {
    $maxcols = 6;
    $width = 100 / $maxcols;
    $out = '';
    foreach($modules as $key=>$value) {
      $out .= "<tr><td class=\"name\">$key</td></tr>";

      $out .= "<tr><td><table class=\"action\">";
      $module = strtolower($key); 
      for($i=0;$i<$maxcols || $i<count($value);$i++) {
        if($i%$maxcols==0) $out .= "<tr>";

        if(isset($value[$i]) && in_array($value[$i], $rights[$module])) {
          $class = 'class="blue"';
          $active = '1';
        }else{
          $class = 'class="grey"';
          $active = 0;
        }
        $class = ((isset($value[$i])) ? $class : '');

        $action = ((isset($value[$i])) ? strtolower($value[$i]) : '');
        $onclick = ((isset($value[$i])) ? "onclick=\"ChangeRights(this, '$user','$module','$action')\"" : '');
        $out .= "<td width=\"$width%\" $class value=\"$active\" $onclick>{$action}</td>";

        if($i%$maxcols==($maxcols-1)) $out .= "</tr>";
      }
      $out .= "</table></td></tr>";
    }

    return $out;
  }

  function ScanModules()
  {
    $files = glob('./pages/*.php');
    $enc = false;
    if(method_exists($this->app->erp,'getEncModullist'))
    {
      
      $enc = $this->app->erp->getEncModullist();
      
    }
    $modules = array();
    foreach($files as $page) {
      $name = ucfirst(basename($page,'.php'));

      $content = file_get_contents($page);		

      $foundItems = preg_match_all('/ActionHandler\(\"[[:alnum:]].*\",/', $content, $matches);
      if($foundItems > 0) {
        $action = str_replace(array('ActionHandler("','",'),'', $matches[0]);
        for($i=0;$i<count($action);$i++)
          $modules[$name][] = $action[$i];	
        sort($modules[$name]);
      } else {
        if(isset($enc[$name]) && is_array($enc[$name]) && count($enc[$name]) > 0)
        {
          $modules[$name] = $enc[$name];
          sort($modules[$name]);
        }
        
      }
    }
    return $modules;	
  }

  function TemplateSelect()
  {
    $options = "<option value=\"\">-- Bitte ausw&auml;len --</option>";
    foreach($this->Templates as $key=>$value) {
      if($key!="web")
      $options .= "<option value=\"$key\">".ucfirst($key)."</option>";
     }

     return $options;
  }

  function GetTemplates()
  {
     return $this->app->Conf->WFconf['permissions'];
  }
}
?>
