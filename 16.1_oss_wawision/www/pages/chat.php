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
class Chat {
  var $app;

  function Chat($app) {
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","ChatList");
    $this->app->ActionHandler("userlist","ChatUserlist");
    $this->app->ActionHandler("submit","ChatSubmit");
    $this->app->ActionHandler("messagelist","ChatMessagelist");
    $this->app->ActionHandler("settings","ChatSetting");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen($app);
  }

  function ChatSubmit()
  {
    $nachricht = $this->app->Secure->GetPOST("nachricht");
    $cmd = $this->app->Secure->GetGET("cmd");

    if($nachricht!="")
    {
      $this->app->DB->Insert("INSERT INTO chat (id,user_from,user_to,message,zeitstempel) VALUES ('','".$this->app->User->GetID()."','".$cmd."','$nachricht',NOW())");

      if(strpos($nachricht,":prio")!==false) {
        $name = $this->app->DB->Select("SELECT a.name FROM user u LEFT JOIN adresse a ON a.id=u.adresse WHERE u.id=".$this->app->User->GetID());
        $nachricht = str_replace(":prio","",$nachricht);
        $this->app->erp->InternesEvent($cmd,"<b>$name (".date('d.m')." um ".date('H:i').")</b><br>$nachricht","alert",1);
      }

    }
    exit;
  }


  function ChatList()
  {
    $nachricht = $this->app->Secure->GetPOST("nachricht");
    $cmd = $this->app->Secure->GetGET("cmd");

    if($cmd=="")
    {
      header("Location: index.php?module=chat&action=list&cmd=0");
      exit;
    }

    

    $this->app->Tpl->Add(CHATMESSAGE,$this->ChatMessagelist(true));
    $this->app->Tpl->Add(SHOW,$this->ChatUserlist(true));
    $this->app->Tpl->Set(CMD,$cmd);
  
    $name = $this->app->DB->Select("SELECT a.name FROM user u LEFT JOIN adresse a ON a.id=u.adresse 
        WHERE u.id=$cmd");
    $this->app->Tpl->Set(NAME,$name);

    $this->app->erp->MenuEintrag("index.php?module=chat&action=list&cmd=0","&Ouml;ffentlich ");

    
    if($cmd>0)
      $this->app->erp->MenuEintrag("index.php?module=chat&action=list&cmd=".$cmd,$name);
/*
    $users = $this->app->DB->SelectArr("SELECT id FROM user WHERE activ=1 AND id!='".$this->app->User->GetID()."'"); 
    for($i=0;$i<count($users);$i++)
    {
      $name = $this->app->DB->Select("SELECT a.name FROM user u LEFT JOIN adresse a ON a.id=u.adresse WHERE u.id='".$users[$i]['id']."'");
      $this->app->erp->MenuEintrag("index.php?module=chat&action=list&cmd=".$users[$i]['id'],$name);
    }
*/

    $this->app->Tpl->Parse(PAGE,"chat_list.tpl");
  }

  function ChatSettings()
  {

    $this->app->erp->MenuEintrag("index.php?module=hilfsprogramme&action=list","&Uuml;bersicht");

    $this->app->Tpl->Parse(PAGE,"chat_settings.tpl");
  }

  function ChatUserlist($return=false)
  {
    $user = "<ul>";

    $cmd = $this->app->Secure->GetGET("cmd");

    $users = $this->app->DB->SelectArr("SELECT DISTINCT u.id, a.name,
      uo.login FROM user u LEFT JOIN adresse a ON a.id=u.adresse LEFT JOIN useronline uo ON uo.user_id=u.id AND uo.login=1
      LEFT JOIN adresse_rolle ar ON ar.adresse=a.id 
      WHERE u.activ=1 AND u.kalender_ausblenden!=1 AND ar.subjekt='Mitarbeiter' AND (ar.bis='0000-00-00' OR ar.bis <= NOW())
      AND u.id!='".$this->app->User->GetID()."' and u.hwtoken <> 4 ORDER by a.name");


    for($i=0;$i<count($users);$i++)
    {
      $ungelesen = $this->app->DB->Select("SELECT COUNT(id) FROM chat WHERE user_to='".$this->app->User->GetID()."' AND user_from='".$users[$i]['id']."' AND gelesen!=1");
      if($users[$i]['login']=="1") {
        $style[] = "color:green";
      } else {
        $style[] = "color:black";
      }

      if($ungelesen > 0) {
        $style[] = "font-weight:bold";
        $ungelesen ="(".$ungelesen.")"; 
      }
      else { 
        $style[] = "font-weight:normal";
        $ungelesen="";
      }

      if($cmd==$users[$i]['id'])
      {
        $style[] = "font-weight:bold";
        $style[]="text-decoration:underline";
      } else {
        $style[]="text-decoration:none";
      }

      $user .="<li><a href=\"index.php?module=chat&action=list&cmd=".$users[$i]['id']."\" style=\"".implode($style,';')."\">".$users[$i]['name']." ".$ungelesen."</a></li>";
    }


 
    $user .="</ul>";

    if($return) return $user;
    else echo $user;
    exit;
    //$this->app->erp->MenuEintrag("index.php?module=hilfsprogramme&action=list","&Uuml;bersicht");
    //$this->app->Tpl->Parse(PAGE,"chat_settings.tpl");
  }



  function ChatMessagelist($return=false)
  {
    //$last_message = $this->app->DB->SelectArr("SELECT * FROM chat Order by id DESC LIMIT 20");
    $cmd = $this->app->Secure->GetGET("cmd");
    if($cmd=="0")
    {
      $last_message = $this->app->DB->SelectArr("SELECT DATE_FORMAT(zeitstempel,'%d.%m um %H:%i:%s') as zeitstempel,user_from,message FROM chat 
      WHERE user_to=0
        Order by id DESC LIMIT 20");
    } else {
      $last_message = $this->app->DB->SelectArr("SELECT DATE_FORMAT(zeitstempel,'%d.%m um %H:%i:%s') as zeitstempel,user_from,message,gelesen,user_to FROM chat WHERE 
        (user_to='".$cmd."' AND user_from='".$this->app->User->GetID()."') OR (user_from='".$cmd."' AND user_to='".$this->app->User->GetID()."')
         ORDER by id DESC LIMIT 20");

      $this->app->DB->Update("UPDATE chat SET gelesen=1 WHERE user_to='".$this->app->User->GetID()."' AND user_from='".$cmd."'");
    }



    for($i=count($last_message);$i>=0;$i--)
    {
      $adresse = $this->app->DB->Select("SELECT adresse FROM user WHERE id='".$last_message[$i]['user_from']."' LIMIT 1");
      $name = $this->app->DB->Select("SELECT name FROM adresse WHERE id='".$adresse."' LIMIT 1");
      if($last_message[$i]['message']!="")
      {

        if($last_message[$i]['gelesen']==0)
        {
          // ($last_message[$i]['user_to']!=$cmd && ($last_message[$i]['user_from']==$this->app->User->GetID()))
          $name .= " (ungelesen)";
        }

        // links
        $last_message[$i]['message'] = $this->MakeLinks($last_message[$i]['message']);

        if($last_message[$i]['user_from']==$this->app->User->GetID())
        {
          $output .= "<br><i class=\"chat_own\">".$last_message[$i]['zeitstempel']." $name</i><br>&nbsp;&nbsp;".$last_message[$i]['message']."<br>";
        } else {
          $output .= "<br><i class=\"chat_other\">".$last_message[$i]['zeitstempel']." $name</i><br>&nbsp;&nbsp;".$last_message[$i]['message']."<br>";
        }
      }
    }
    if($output!="")$output.="<br>";
    if($return==true) return $output;
    else echo $output;
    exit;
  }


  function MakeLinks($str) {
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    $urls = array();
    $urlsToReplace = array();
    if(preg_match_all($reg_exUrl, $str, $urls)) {
      $numOfMatches = count($urls[0]);
      $numOfUrlsToReplace = 0;
      for($i=0; $i<$numOfMatches; $i++) {
        $alreadyAdded = false;
        $numOfUrlsToReplace = count($urlsToReplace);
        for($j=0; $j<$numOfUrlsToReplace; $j++) {
          if($urlsToReplace[$j] == $urls[0][$i]) {
            $alreadyAdded = true;
          }
        }
        if(!$alreadyAdded) {
          array_push($urlsToReplace, $urls[0][$i]);
        }
      }
      $numOfUrlsToReplace = count($urlsToReplace);
      for($i=0; $i<$numOfUrlsToReplace; $i++) {
        $str = str_replace($urlsToReplace[$i], "<a href=\"".$urlsToReplace[$i]."\" target=\"_blank\">".$urlsToReplace[$i]."</a> ", $str);
      }
      return $str;
    } else {
      return $str;
    }
  }




}

?>
