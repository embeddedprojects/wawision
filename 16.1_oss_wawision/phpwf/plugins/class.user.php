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


class User 
{

  function User(&$app)
  {
    $this->app = &$app;
  }

  function GetID()
  { 
    if(isset($_COOKIE["CH42SESSION"]) && $_COOKIE["CH42SESSION"]!="")$tmp = $_COOKIE["CH42SESSION"]; else $tmp = session_id();
    return $this->app->DB->Select("SELECT user_id FROM useronline WHERE sessionid='".$this->app->DB->real_escape_string($tmp)."' AND login ='1'");

    if($this->app->Conf->WFdbType=="postgre")
    {
      $result =  $this->app->DB->Select("SELECT user_id FROM useronline WHERE sessionid='".$this->app->DB->real_escape_string($tmp)."' AND login='1'");
      //       AND ip='".$_SERVER[REMOTE_ADDR]."' AND login='1'");

      if(!is_numeric($result)) return 0; 
      return $result;

    } else {
      return $this->app->DB->Select("SELECT user_id FROM useronline WHERE sessionid='".$this->app->DB->real_escape_string($tmp)."' AND login ='1'");
      //        AND ip='".$_SERVER[REMOTE_ADDR]."' AND login='1'");
    }
  }

  function GetType()
  { 
    if($this->GetID()<=0){
      return $this->app->Conf->WFconf['defaultgroup'];
    }
    else {
      if(isset($this->app->Conf->WFdbType) && $this->app->Conf->WFdbType=="postgre")
      {
        $type = $this->app->DB->Select("SELECT type FROM \"user\" WHERE id='".$this->GetID()."'");
      }
      else {
        $type = $this->app->DB->Select("SELECT type FROM user WHERE id='".$this->GetID()."'");
      }
      if($type=="")
        $type = $this->app->Conf->WFconf['defaultgroup'];

      return $type;
    }
  }

  function GetParameter($index)
  {
    $id = $this->GetID();

    if($index!="")
    {
      if($this->app->Conf->WFdbType=="postgre")
        $settings = $this->app->DB->Select("SELECT settings FROM \"user\" WHERE id='$id' LIMIT 1");
      else
        $settings = $this->app->DB->Select("SELECT settings FROM user WHERE id='$id' LIMIT 1");

      $settings = unserialize($settings);

      if(isset($settings[$index]))
        return $settings[$index];
    } 
  } 

  // value koennen beliebige Datentypen aus php sein (serialisiert) 
  function SetParameter($index,$value)
  {
    $id = $this->GetID();

    if($index!="" && isset($value))
    {
      $settings = $this->app->DB->Select("SELECT settings FROM user WHERE id='$id' LIMIT 1");
      $settings = unserialize($settings); 

      $settings[$index] = $value;

      $settings = serialize($settings);
      $this->app->DB->Update("UPDATE user SET settings='$settings' WHERE id='$id' LIMIT 1");
    }
  }



  function GetUsername()
  { 
    if($this->app->Conf->WFdbType=="postgre")
      return $this->app->DB->Select("SELECT username FROM \"user\" WHERE id='".$this->GetID()."'");
    else
      return $this->app->DB->Select("SELECT username FROM user WHERE id='".$this->GetID()."'");
  }

  function GetDescription()
  { 
    /*
       if($this->app->Conf->WFdbType=="postgre")
       return $this->app->DB->Select("SELECT description FROM \"user\" WHERE id='".$this->GetID()."'");
       else
       return $this->app->DB->Select("SELECT description FROM user WHERE id='".$this->GetID()."'");
     */
    return $this->GetName();
  }

  function GetMail()
  { 
    return $this->app->DB->Select("SELECT email FROM adresse WHERE id='".$this->GetAdresse()."'");
  }


  function GetName()
  { 
    return $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$this->GetAdresse()."'");
  }





  function GetAdresse()
  { 
    if(isset($this->app->Conf->WFdbType) && $this->app->Conf->WFdbType=="postgre")
      return $this->app->DB->Select("SELECT adresse FROM \"user\" WHERE id='".$this->GetID()."'");
    else
      return $this->app->DB->Select("SELECT adresse FROM user WHERE id='".$this->GetID()."'");
  }

  function GetProjektleiter()
  { 
    $result = $this->app->DB->SelectArr("SELECT parameter FROM adresse_rolle WHERE subjekt='Projektleiter' AND (bis='0000-00-00' OR bis < NOW()) AND adresse='".$this->app->User->GetAdresse()."'");      	


    if(count($result)>0)
      return true;
    else return false;
  }



  function DefaultProjekt()
  {
    $adresse = $this->GetAdresse();
    $projekt = $this->app->DB->Select("SELECT projekt FROM adresse WHERE id='".$adresse."'");
    if($projekt <=0)
      $projekt = $this->app->DB->Select("SELECT standardprojekt FROM firma WHERE id='".$this->app->User->GetFirma()."' LIMIT 1");

    return $projekt;
  }

  function GetEmail()
  { 
    $adresse = $this->GetAdresse();
    return $this->app->DB->Select("SELECT email FROM adresse WHERE id='".$adresse."'");
  }


  function GetFirma()
  { 
    //return $this->app->DB->Select("SELECT firma FROM adresse WHERE id='".$this->GetAdresse()."'");
    return 1;
  }


  function GetFirmaName()
  { 
    return $this->app->DB->Select("SELECT name FROM firma WHERE id='".$this->GetFirma()."'");
  }


  function GetField($field)
  { 
    return $this->app->DB->Select("SELECT $field FROM user WHERE id='".$this->GetID()."'");
  }


}
?>
