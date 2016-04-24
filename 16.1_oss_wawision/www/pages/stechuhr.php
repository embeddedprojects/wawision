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
class Stechuhr {
  var $app;
  
  function Stechuhr($app) {
    $this->app=&$app;
    if(isset($_COOKIE['nonavigation']) && $_COOKIE['nonavigation'])$this->app->BuildNavigation = false;
    if(4 == $this->app->DB->Select("SELECT hwtoken from user where id = '".$this->app->User->GetID()."' LIMIT 1"))$this->app->BuildNavigation = false;
    $this->app->ActionHandlerInit($this);
    $this->app->ActionHandler("change","StechuhrChange");
    $this->app->ActionHandlerListen($app);
  }

	function StechuhrChange()
	{
			$cmd = $this->app->Secure->GetGET("cmd");

			if($cmd=="pause" || $cmd=="pausestart" || $cmd=="gehen") $kommen=0; else $kommen=1;
      $status = '';
      switch($cmd)
      {
        case 'pausestart':
        case 'pausestop':
        case 'kommen':
        case 'gehen':
          $status = $cmd;
        break;
        
      }
      if($status || $cmd == 'arbeit' || $cmd == 'pause')
      {
        $alterstatus = $this->app->DB->SelectArr("Select status, TIMESTAMPDIFF(HOUR,datum,now()) as dd, kommen from stechuhr where user = ".$this->app->User->GetID()." order by datum desc limit 1");
        if($alterstatus)
        {
          $dd = $alterstatus[0]['dd'];
          $altkommen = $alterstatus[0]['kommen'];
          $alterstatus = $alterstatus[0]['status'];
        }
        if((!$alterstatus && $status == 'kommen') || 
          (!$alterstatus && $status == 'gehen') || 
          ($alterstatus == 'kommen' && $status != 'kommen') || 
          ($alterstatus == 'gehen' && $status == 'kommen') ||
          ($alterstatus == 'pausestart' && $status == 'pausestop') ||
          ($alterstatus == 'pausestop' && $status == 'pausestart') ||
          ($alterstatus == 'pausestop' && $status == 'gehen') ||
          ($alterstatus == 'pausestart' && $status == 'gehen') ||
          ($cmd == 'arbeit') ||
          ($cmd == 'pause')
        )
        {
          if(!(!$status && $alterstatus && $altkommen == 1 && $kommen == 0 ) ||  $cmd == 'arbeit' || $cmd == 'pause')
          {
            if($status == '' && $kommen == 1 && $alterstatus == 'pausestart')$status = 'pausestop';
            if(($alterstatus === false || $alterstatus == 'gehen')&& $kommen == 1 && $status == '')$status = 'kommen';
            
            $this->app->DB->Insert("INSERT INTO stechuhr (id,adresse,user,datum,kommen, status) 
              VALUES ('','".$this->app->User->GetAdresse()."','".$this->app->User->GetID()."',NOW(),'".$kommen."','".($status)."')");
            $insid = $this->app->DB->GetInsertID();  
          }
        }
      }
      if($this->app->BuildNavigation === false)
      {
        header("Location: index.php?module=welcome&action=logout");
        
      } else {
        header("Location: ".$_SERVER['HTTP_REFERER']);
      }
			exit;
	}
  
}

?>
