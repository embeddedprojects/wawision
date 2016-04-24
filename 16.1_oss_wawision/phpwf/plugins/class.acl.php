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


class Acl 
{
  //var $engine;
  function Acl(&$app)
  {
    $this->app = &$app;
  }


  function CheckTimeOut()
  {
    $this->session_id = session_id();

    if(isset($_COOKIE["CH42SESSION"]) && $_COOKIE["CH42SESSION"]!="")
    {
      $this->session_id = $_COOKIE["CH42SESSION"];
      $this->app->DB->Update("UPDATE useronline SET time=NOW(),login=1 WHERE sessionid='".$this->app->DB->real_escape_string($_COOKIE["CH42SESSION"])."' LIMIT 1");
    }

    // check if user is applied 
    // 	$this->app->DB->Delete("DELETE FROM useronline WHERE user_id='".$this->app->User->GetID()."' AND sessionid!='".$this->session_id."'");
    $sessid =  $this->app->DB->Select("SELECT sessionid FROM useronline,user WHERE
          login='1' AND sessionid='".$this->app->DB->real_escape_string($this->session_id)."' AND user.id=useronline.user_id AND user.activ='1' LIMIT 1");

    if($this->session_id == $sessid)
    { 
      // check if time is expired
      $time =  $this->app->DB->Select("SELECT UNIX_TIMESTAMP(time) FROM useronline,user WHERE
            login='1' AND sessionid='".$this->app->DB->real_escape_string($this->session_id)."' AND user.id=useronline.user_id AND user.activ='1' LIMIT 1");

      if((time()-$time) > $this->app->Conf->WFconf['logintimeout'])
      {
        if(!isset($_COOKIE["CH42SESSION"]) || $_COOKIE["CH42SESSION"]=="")
        {
          //$this->app->WF->ReBuildPageFrame();
          $this->Logout("Ihre Zeit ist abgelaufen, bitte melden Sie sich erneut an.",true);
          return false;
        }
      }
      else {
        // update time
        $this->app->DB->Update("UPDATE useronline,user SET useronline.time=NOW() WHERE
            login='1' AND sessionid='".$this->app->DB->real_escape_string($this->session_id)."' AND user.id=useronline.user_id AND user.activ='1'");

        session_write_close(); // Blockade wegnehmen           

        return true; 
      }
    }

  }

  function Check($usertype,$module,$action, $userid='')
  {
    $ret = false;
    $permissions = isset($this->app->Conf->WFconf['permissions']) && isset($this->app->Conf->WFconf['permissions'][$usertype]) && isset($this->app->Conf->WFconf['permissions'][$usertype][$module])?$this->app->Conf->WFconf['permissions'][$usertype][$module]:null;

    if($usertype=="admin")
      return true;

    if($this->app->User->GetID() > 0)
    {
      if($module=="welcome" && $action=="css") return true;
      if($module=="ajax" && $action=="table") return true;
      if($module=="ajax" && $action=="filter") return true;
      if($module=="ajax" && $action=="tablefilter") return true;
      if($module=="welcome" && $action=="logo") return true;
      if($module=="welcome" && $action=="start") return true;
      if($module=="welcome" && $action=="logout") return true;
      if($module=="welcome" && $action=="login") return true;
      if($module=="gpsstechuhr" && $action=="create") return true;
      if($module=="gpsstechuhr" && $action=="save") return true;
    }

    // Change Userrights with new 'userrights'-Table	
    if(!is_array($permissions)) $permissions = array();
    if(is_numeric($userid) && $userid>0) {
      $permission_db = $this->app->DB->Select("SELECT permission FROM userrights WHERE module='".$this->app->DB->real_escape_string($module)."' AND action='".$this->app->DB->real_escape_string($action)."' AND user='$userid' LIMIT 1");
      $actionkey = array_search($action, $permissions);
      if($actionkey===false) {
        if($permission_db=='1')
          $permissions[] = $action;
      }else {
        if($permission_db=='0'){
          unset($permissions[$actionkey]);
          $permissions = array_values($permissions);
        }				
      }
    }
    // --- END ---

    while (list($key, $val) = @each($permissions)) 
    {
      if($val==$action || $usertype=="admin")
      {
        $ret = true;
        break;
      }
    }

    // TODO pruefen ob das so past
    if($action=="" && $module=="")
      $ret = true;

    if($ret && $usertype!="admin")
    {
      $id = (int)$this->app->Secure->GetGET('id');
      if($id)
      {
        if($action == 'edit' || $action == 'delete' || $action == 'copy' || $action = 'dateien')
        {
          switch($module)
          {
            case 'artikel':
            case 'adresse':
            case 'auftrag':
            case 'rechnung':
            case 'gutschrift':
            case 'angebot':
            case 'anfrage':
            case 'bestellung':
            case 'produktion':
            case 'lieferschein':
            case 'konten':
            case 'onlineshops':
            case 'benutzer':
              $ret = $this->app->erp->UserProjektRecht($this->app->DB->Select("SELECT projekt FROM $module WHERE id = '$id'"));
            break;
          }
        } else {
          $modact = array('artikel'=>array('einkauf', 'dateien','eigenschaften','verkauf','statistik','etikett','offenebestellungen','offeneauftraege','zertifikate','fremdnummern')
          ,'adresse' => array('rollen','ansprechpartner','lieferadresse','accounts','brief','belege','kundeartikel','abrechnungzeit','artikel','service','serienbrief')
          ,'lieferschein' => array('paketmarke')
          );
          foreach($modact as $mod => $actarr)
          {
            if($module = $mod)
            {
              foreach($actarr as $v)
              {
                if($v == $action)
                {
                  $ret = $this->app->erp->UserProjektRecht($this->app->DB->Select("SELECT projekt FROM $module WHERE id = '$id'"));
                }
              }
            }
          }
        }
      }
    }
    
    //if($this->app->User->GetID()<=0)
    //  $this->app->Tpl->Parse(PAGE,"sessiontimeout.tpl");
    // wenn es nicht erlaubt ist 
    if($ret!=true)
    {
      if($this->app->User->GetID()<=0)
      {
        $this->app->erp->Systemlog("Keine gueltige Benutzer ID erhalten",1);
        echo str_replace('BACK',"index.php?module=welcome&action=login",$this->app->Tpl->FinalParse("permissiondenied.tpl"));
      }
      else {
        $this->app->erp->Systemlog("Fehlendes Recht",1);
        echo str_replace('BACK',isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'',$this->app->Tpl->FinalParse("permissiondenied.tpl"));
      }
      exit;
    }
    return $ret;
  }

  function Login()
  {
    $username = $this->app->DB->real_escape_string($this->app->Secure->GetPOST("username"));
    $password = $this->app->Secure->GetPOST("password");
    $passwordunescaped = $this->app->Secure->GetPOST('password',"","","noescape");
    $stechuhrdevice = $this->app->Secure->GetPOST('stechuhrdevice');
    /*if($this->app->Secure->GetPOST('isbarcode'))
    {
      setcookie('nonavigation',true);
      /*$creda = explode('!!!',$username,2);
      $username = $creda[0];
      $password = $creda[1];*/
     /*
    } else {
      setcookie('nonavigation',false);
    }*/

    $token = $this->app->Secure->GetPOST("token");


    if($username=="" && ($password=="" || $token=="") && $stechuhrdevice == ""){
      setcookie('nonavigation',false);
      $this->app->Tpl->Set('LOGINMSG',"Bitte geben Sie Benutzername und Passwort ein.");  
      //if(isset($this->app->Conf->WFtpllogin) && $this->app->Conf->WFtpllogin && file_exists(dirname(__FILE__).'/../../www/themes/'.$this->app->Conf->WFconf[defaulttheme].'/templates/'.$this->app->Conf->WFtpllogin)){

      if($this->app->erp->UserDevice()=="smartphone")
      {
        $this->app->Tpl->Parse('PAGE',"login_smartphone.tpl");
      }
      else $this->app->Tpl->Parse('PAGE',"login.tpl");
    }
    /* elseif($username==""||$password==""){
       $this->app->Tpl->Set(LOGINERRORMSG,"Bitte geben Sie einen Benutzername und ein Passwort an.");  
       $this->app->Tpl->Parse(PAGE,"login.tpl");
       }*/
    else {
      // Benutzer hat Daten angegeben
      $encrypted = $this->app->DB->Select("SELECT password FROM user
          WHERE username='".$username."' AND activ='1' LIMIT 1");

      $encrypted_md5 = $this->app->DB->Select("SELECT passwordmd5 FROM user
          WHERE username='".$username."' AND activ='1' LIMIT 1");

      $fehllogins= $this->app->DB->Select("SELECT fehllogins FROM user
          WHERE username='".$username."' AND activ='1' LIMIT 1");

      //$fehllogins=0;

      $type= $this->app->DB->Select("SELECT type FROM user
          WHERE username='".$username."' AND activ='1' LIMIT 1");

      $externlogin= $this->app->DB->Select("SELECT externlogin FROM user
          WHERE username='".$username."' AND activ='1' LIMIT 1");

      $hwtoken = $this->app->DB->Select("SELECT hwtoken FROM user
          WHERE username='".$username."' AND activ='1' LIMIT 1");

      $stechuhrdevicelogin = false;
      $code = $this->app->Secure->GetPOST('code');
      $devices = $this->app->DB->SelectArr("SELECT * from stechuhrdevice where aktiv = 1 and code = '$code'");
      if($devices)
      {
        $IP = $_SERVER['REMOTE_ADDR'];
        foreach($devices as $device)
        {
          $IP = ip2long($_SERVER['REMOTE_ADDR']);
          $devIP = ip2long($device['IP']);
          $submask = ip2long($device['submask']);
          
          $maskIP = $IP & $submask;
          $dbIP = $devIP & $submask;
          if($maskIP == $dbIP)
          {
            $stechuhrdevicelogin = true;
          }
        }
      }
      if($code && !$stechuhrdevicelogin)
      {
        setcookie('nonavigation',false);
        $this->app->Tpl->Set('RESETSTORAGE','
              var devicecode = localStorage.getItem("devicecode"); 
      if(devicecode)
      {
        localStorage.setItem("devicecode", "");
      }

        ');
      }
      // try login and set user_login if login was successfull
      // wenn intern geht immer passwort???
      //$hwtoken=0;

      // MOTP

      $user_id="";

      $userip = $_SERVER['REMOTE_ADDR'];
      $ip_arr = split('\.',$userip);

      if($ip_arr[0]=="192" || $ip_arr[0]=="10" || $ip_arr[0]=="127")
        $localconnection = 1;
      else 
        $localconnection = 0;


      //HACK intern immer Passwort
      //if($localconnection==1)
      //  $hwtoken=0;
      if($stechuhrdevicelogin && $stechuhrdevice)
      {
        $nr = substr($stechuhrdevice,0,6);
        if(is_numeric($nr) && strlen($stechuhrdevice) > 200)
        {
          $user_id = $this->app->DB->Select("SELECT id FROM user WHERE username = '$nr' and hwtoken = 4 LIMIT 1");
          if($user_id)
          {
            
            $encrypted = $this->app->DB->Select("SELECT password FROM user
                WHERE id='".$user_id."' AND activ='1' LIMIT 1");

            $encrypted_md5 = $this->app->DB->Select("SELECT passwordmd5 FROM user
                WHERE id='".$user_id."' AND activ='1' LIMIT 1");

            $fehllogins= $this->app->DB->Select("SELECT fehllogins FROM user
                WHERE id='".$user_id."' AND activ='1' LIMIT 1");

            //$fehllogins=0;

            $type= $this->app->DB->Select("SELECT type FROM user
                WHERE id='".$user_id."' AND activ='1' LIMIT 1");

            $externlogin= $this->app->DB->Select("SELECT externlogin FROM user
                WHERE id='".$user_id."' AND activ='1' LIMIT 1");

            $hwtoken = $this->app->DB->Select("SELECT hwtoken FROM user
                WHERE id='".$user_id."' AND activ='1' LIMIT 1");
            
            $stechuhruser = $this->app->DB->Select("SELECT stechuhrdevice FROM user WHERE id = '$user_id'");
            {
              if($stechuhrdevice == $stechuhruser)
              {
                setcookie('nonavigation',true);
              } elseif($stechuhruser == "") {
                $this->app->DB->Update("UPDATE user set stechuhrdevice = '$stechuhrdevice' where id = '$user_id' LIMIT 1");
                setcookie('nonavigation',true);
              } else {
                $user_id = "";
                setcookie('nonavigation',false);
              }
            }
          }
        }
      }
      elseif($hwtoken==1) //motp
      {
        setcookie('nonavigation',false);
        $pin = $this->app->DB->Select("SELECT motppin FROM user
            WHERE username='".$username."' AND activ='1' LIMIT 1");

        $secret = $this->app->DB->Select("SELECT motpsecret FROM user
            WHERE username='".$username."' AND activ='1' LIMIT 1");

        if($this->mOTP($pin,$token,$secret) && $fehllogins<8 && (md5($password ) == $encrypted_md5 || md5($passwordunescaped ) == $encrypted_md5))
        {
          $user_id = $this->app->DB->Select("SELECT id FROM user
              WHERE username='".$username."' AND activ='1' LIMIT 1");
        } else { $user_id = ""; }

      } 
      //picosafe login
      else if ($hwtoken==2)
      {
        setcookie('nonavigation',false);
        //include("/var/www/wawision/trunk/phpwf/plugins/class.picosafelogin.php");
        $myPicosafe = new PicosafeLogin();

        $aes = $this->app->DB->Select("SELECT hwkey FROM user WHERE username='".$username."' AND activ='1' LIMIT 1");
        $datablock = $this->app->DB->Select("SELECT hwdatablock FROM user WHERE username='".$username."' AND activ='1' LIMIT 1");
        $counter = $this->app->DB->Select("SELECT hwcounter FROM user WHERE username='".$username."' AND activ='1' LIMIT 1");

        $myPicosafe->SetUserAES($aes);
        $myPicosafe->SetUserDatablock($datablock);
        $myPicosafe->SetUserCounter($counter);		

        if($encrypted_md5!="")
        {
          if ( $myPicosafe->LoginOTP($token) && (md5($password) == $encrypted_md5 || md5($passwordunescaped) == $encrypted_md5)  && $fehllogins<8)
          {
            $user_id = $this->app->DB->Select("SELECT id FROM user
                WHERE username='".$username."' AND activ='1' LIMIT 1");

            // Update counter
            $newcounter = $myPicosafe->GetLastValidCounter();
            $this->app->DB->Update("UPDATE user SET hwcounter='$newcounter' WHERE id='$user_id' LIMIT 1");

          } else {
            //echo $myPicosafe->error_message;
            $user_id = "";
          }
        } else {

          if ( $myPicosafe->LoginOTP($token) && (crypt( $password,  $encrypted ) == $encrypted || crypt( $passwordunescaped,  $encrypted ) == $encrypted)  && $fehllogins<8)
          {
            $user_id = $this->app->DB->Select("SELECT id FROM user
                WHERE username='".$username."' AND activ='1' LIMIT 1");

            // Update counter
            $newcounter = $myPicosafe->GetLastValidCounter();
            $this->app->DB->Update("UPDATE user SET hwcounter='$newcounter' WHERE id='$user_id' LIMIT 1");

          } else {
            //echo $myPicosafe->error_message;
            $user_id = "";
          }
        }
      }
      //wawision otp 
      else if ($hwtoken==3)
      {
        setcookie('nonavigation',false);
        $wawi = new WaWisionOTP();
        $hwkey = $this->app->DB->Select("SELECT hwkey FROM user WHERE username='".$username."' AND activ='1' LIMIT 1");
        $hwcounter = $this->app->DB->Select("SELECT hwcounter FROM user WHERE username='".$username."' AND activ='1' LIMIT 1");
        $hwdatablock = $this->app->DB->Select("SELECT hwdatablock FROM user WHERE username='".$username."' AND activ='1' LIMIT 1");

        //$wawi->SetKey($hwkey);
        //$wawi->SetCounter($hwcounter);

        $serial =$hwdatablock;
        //$key = pack('V*', 0x01,0x02,0x03,0x04);
        $hwkey = trim(str_replace(' ','',$hwkey));
        $hwkey_array = explode(",",$hwkey);  
        $key = pack('V*', $hwkey_array[0], $hwkey_array[1], $hwkey_array[2], $hwkey_array[3]);
        $check = $wawi->wawision_pad_verify($token,$key,$serial);

        if($encrypted_md5!="")
        {
          if ( $check > 0 && (md5($password) == $encrypted_md5 || md5($passwordunescaped) == $encrypted_md5)  && $fehllogins<8 && $check > $hwcounter)
          {
            $user_id = $this->app->DB->Select("SELECT id FROM user
                WHERE username='".$username."' AND activ='1' LIMIT 1");

            // Update counter
            $this->app->DB->Update("UPDATE user SET hwcounter='$check' WHERE id='$user_id' LIMIT 1");
            $this->app->erp->SystemLog("WaWision Login OTP Success User: $username Token: $token");

          } else {
            if($check===false)
            {
              $this->app->erp->SystemLog("WaWision Login OTP Falscher Key (Unkown Key) User: $username Token: $token");
            } else if ($check < $hwcounter && $check > 0)
            {
              $this->app->erp->SystemLog("WaWision Login OTP Counter Fehler (Replay Attacke) User: $username Token: $token");
            }
            //echo $myPicosafe->error_message;
            $user_id = "";
          }
        } else {
/*
          if ( $wawi->LoginOTP($token) && crypt( $password,  $encrypted ) == $encrypted  && $fehllogins<8)
          {
            $user_id = $this->app->DB->Select("SELECT id FROM user
                WHERE username='".$username."' AND activ='1' LIMIT 1");

            // Update counter
            $newcounter = $wawi->GetLastValidCounter();
            $this->app->DB->Update("UPDATE user SET hwcounter='$newcounter' WHERE id='$user_id' LIMIT 1");
          } else {

*/
            //echo $myPicosafe->error_message;
            $user_id = "";
//          }
        }
      }

      else {
        setcookie('nonavigation',false);
        if($encrypted_md5!=""){
          if ((md5($password ) == $encrypted_md5 || md5($passwordunescaped) == $encrypted_md5) && $fehllogins<8)
          {
            if(isset($this->app->Conf->WFdbType) && $this->app->Conf->WFdbType=="postgre"){
              $user_id = $this->app->DB->Select("SELECT id FROM \"user\"
                  WHERE username='".$username."' AND activ='1' LIMIT 1");
            } else {
              $user_id = $this->app->DB->Select("SELECT id FROM user
                  WHERE username='".$username."' AND activ='1' LIMIT 1");

            }
          }
          else { $user_id = ""; }
        } else {
          if (((crypt( $password,  $encrypted ) == $encrypted) || (crypt( $passwordunescaped,  $encrypted ) == $encrypted))  && $fehllogins<8)
          {
            if(isset($this->app->Conf->WFdbType) && $this->app->Conf->WFdbType=="postgre"){
              $user_id = $this->app->DB->Select("SELECT id FROM \"user\"
                  WHERE username='".$username."' AND activ='1' LIMIT 1");
            } else {
              $user_id = $this->app->DB->Select("SELECT id FROM user
                  WHERE username='".$username."' AND activ='1' LIMIT 1");

            }
          }
          else { $user_id = ""; }
        }
      }

      //$password = substr($password, 0, 8); //TODO !!! besseres verfahren!!

      //pruefen ob extern login erlaubt ist!!

      // wenn keine externerlogin erlaubt ist und verbindung extern
      if($externlogin==0 && $localconnection==0)
      {
        $this->app->Tpl->Set('LOGINERRORMSG',"Es ist kein externer Login mit diesem Account erlaubt.");  
        $this->app->Tpl->Parse('PAGE',"login.tpl");
      }
      else if(is_numeric($user_id))
      { 

        $this->app->DB->Delete("DELETE FROM useronline WHERE user_id='".$user_id."'");

        $this->app->DB->Insert("INSERT INTO useronline (user_id, sessionid, ip, login, time)
            VALUES ('".$user_id."','".$this->session_id."','".$_SERVER['REMOTE_ADDR']."','1',NOW())");

        $this->app->DB->Select("UPDATE user SET fehllogins=0
            WHERE username='".$username."' LIMIT 1");

        $this->app->erp->calledOnceAfterLogin($type);

        $module=$this->app->Secure->GetGET("module");
        $action=$this->app->Secure->GetGET("action");
        $id=$this->app->Secure->GetGET("id");

        //$this->app->erp->LogFile("LOG IN $module ".$_SERVER['HTTP_REFERER']);

        $ref = $_SERVER['HTTP_REFERER'];
        $refData = parse_url($ref);
        if($refData['query']!="")
        {
          header("Location: index.php?".$refData['query']);
          exit;
        }


        $this->app->erp->Startseite();

        exit;
      }
      else if ($fehllogins>=8)
      {
        $this->app->Tpl->Set('LOGINERRORMSG',"Max. Anzahl an Fehllogins erreicht. Bitte wenden Sie sich an Ihren Administrator.");  
        $this->app->Tpl->Parse('PAGE',"login.tpl");
      }
      else
      { 

        if(isset($this->app->Conf->WFdbType) && $this->app->Conf->WFdbType=="postgre")
          $this->app->DB->Select("UPDATE \"user\" SET fehllogins=fehllogins+1 WHERE username='".$username."'");
        else
          $this->app->DB->Select("UPDATE user SET fehllogins=fehllogins+1 WHERE username='".$username."' LIMIT 1");

        $this->app->Tpl->Set('LOGINERRORMSG',"Benutzername oder Passwort falsch.");  
        $this->app->Tpl->Parse('PAGE',"login.tpl");
      }
    }
  }

  function Logout($msg="",$logout=false)
  {
    if($logout)
      $this->app->Tpl->Parse('PAGE',"sessiontimeout.tpl");

    $username = $this->app->User->GetName();
    $this->app->DB->Delete("DELETE FROM useronline WHERE user_id='".$this->app->User->GetID()."'");
    session_destroy();
    session_start();
    session_regenerate_id(true);
    $_SESSION['database']="";


    if(!$logout)
    {
      header("Location: ".$this->app->http."://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']),'/'));
      exit;
    }
    //$this->app->Tpl->Set(LOGINERRORMSG,$msg);  
    //$this->app->Tpl->Parse(PAGE,"login.tpl");
  }


  function CreateAclDB()
  {

  }

  function mOTP($pin,$otp,$initsecret)
  {

    $maxperiod = 3*60; // in seconds = +/- 3 minutes
    $time=gmdate("U");
    for($i = $time - $maxperiod; $i <= $time + $maxperiod; $i++)
    {
      $md5 = substr(md5(substr($i,0,-1).$initsecret.$pin),0,6);

      if($otp == $md5) {
        return(true);
      }
    }
    return(false);
  }



}
?>
