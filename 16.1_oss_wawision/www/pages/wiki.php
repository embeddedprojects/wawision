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

class Wiki {
  var $app;

  function Wiki($app) {
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("create","WikiCreate");
    $this->app->ActionHandler("edit","WikiEdit");
    $this->app->ActionHandler("delete","WikiDelete");
    $this->app->ActionHandler("rename","WikiRename");
    $this->app->ActionHandler("new","WikiNew");
    $this->app->ActionHandler("alle","WikiAlle");
    $this->app->ActionHandler("dateien","WikiDateien");
    $this->app->ActionHandler("list","WikiList");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen($app);
  }

  function WikiDateien()
  {
    $id = $this->app->Secure->GetGET("id");
    $this->WikiMenu();
    $this->app->Tpl->Add(UEBERSCHRIFT," (Dateien)");
    $this->app->YUI->DateiUpload(PAGE,"Wiki",$id);
  }


  function WikiAlle()
  {

    //    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Wiki");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=alle","Alle Seiten anzeigen");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=list&name=Hauptseite","Zur&uuml;ck zur &Uuml;bersicht");

    $alle = $this->app->DB->SelectArr("SELECT name FROM wiki ORDER by name");

    $this->app->Tpl->Set(TAB1,"<h1>Alle Seiten nach Alphabet sortiert:</h1><ul>");

    for($i=0;$i<count($alle);$i++)
    {
      $this->app->Tpl->Add(TAB1,"<li><a href=\"index.php?module=wiki&action=list&name=".$alle[$i]['name']."\">".$alle[$i]['name']."</a></li>");
    }
    $this->app->Tpl->Add(TAB1,"</ul>");


    $this->app->Tpl->Set(TABTEXT,"Wiki");
    $this->app->Tpl->Parse(PAGE,"wiki.tpl");

  }

  function WikiCreateDialog()
  {

    $name = $this->app->Secure->GetGET("name");
    $this->app->Tpl->Set(TAB1,"<div class=\"info\">Seite: <b>$name</b> fehlt! Soll diese jetzt angelegt werden? <a href=\"index.php?module=wiki&action=create&name=$name\">Seite jetzt anlegen!</a></div>");

  }


  function WikiDelete()
  {
    session_start();
    $name = $this->app->Secure->GetGET("name");
    $key = $this->app->Secure->GetGET("key");

    if($key==$_SESSION['deletekey'] && $name !="" && $key!="")
    { 
      //loeschen
      $_SESSION['deletekey'] = "";
      $this->app->DB->Delete("DELETE FROM wiki WHERE name='$name' LIMIT 1");
      $this->app->DB->Delete("DELETE FROM datei_stichwoerter WHERE parameter='$name' AND objekt='Wiki'");
      header("Location: index.php?module=wiki&action=list");
      exit;
    }
    else if($name !="")
    { 
      $l=20;
      $c = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxwz0123456789";
      for(;$l > 0;$l--) $s .= $c{rand(0,strlen($c))};
      $key = str_shuffle($s);

      $_SESSION['deletekey'] = $key;
      $this->app->Tpl->Set(TAB1,"<div class=\"error\">Seite: <b>$name</b> wirklich l&ouml;schen? <a href=\"index.php?module=wiki&action=delete&name=$name&key=$key\">Seite jetzt l&ouml;schen!</a></div>");
      $this->app->Tpl->Set(TABTEXT,"$name");
      $this->app->Tpl->Parse(PAGE,"wiki.tpl");
    }

  }


  function WikiNew()
  {
    $submit = $this->app->Secure->GetPOST("submit");
    $name = $this->app->Secure->GetGET("name");
    $newname = $this->app->Secure->GetPOST("newname");
    $this->WikiMenu();

    if($submit!="")
    {
      // pruefen ob name passt

      $checkname = $this->app->DB->Select("SELECT name FROM wiki WHERE name='$newname' LIMIT 1");

      if($checkname == $name)
      {
        $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Diesen Namen gibt es bereits. Bitte w&auml;hlen Sie einen anderen Namen.</div>"); 
        $name = $newname;
      }
      else if($newname=="")
      {
        $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Bitte geben Sie eine Namen an!</div>"); 
        $name = $newname;
      } else {
        // alle 
        $newname = str_replace(' ','_',$newname);
        $this->app->DB->Insert("INSERT INTO wiki (name,content) VALUES ('$newname','')");
        header("Location: index.php?module=wiki&action=edit&name=$newname");
        exit;
      }
    }
    $this->app->Tpl->Set(TAB1,"<form action=\"\" method=\"post\">Neuer Name: <input type=\"text\" name=\"newname\" value=\"\" size=\"20\">&nbsp;<input type=\"submit\" value=\"anlegen\" name=\"submit\"></form>");
    $this->app->Tpl->Set(TABTEXT,"Wiki");
    $this->app->Tpl->Parse(PAGE,"wiki.tpl");


  }



  function WikiRename()
  {
    $submit = $this->app->Secure->GetPOST("submit");
    $name = $this->app->Secure->GetGET("name");
    $newname = $this->app->Secure->GetPOST("newname");
    $this->WikiMenu();

    if($submit!="")
    {
      // pruefen ob name passt

      $checkname = $this->app->DB->Select("SELECT name FROM wiki WHERE name='$newname' LIMIT 1");

      if($checkname == $name)
      {
        $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Diesen Namen gibt es bereits. Bitte w&auml;hlen Sie einen anderen Namen.</div>"); 
        $name = $newname;
      }
      else if($newname=="")
      {
        $this->app->Tpl->Set(MESSAGE,"<div class=\"error\">Bitte geben Sie eine Namen an!</div>"); 
        $name = $newname;
      } else {
        // alle 
        $newname = str_replace(' ','_',$newname);
        $this->app->DB->UPDATE("UPDATE wiki SET name='$newname' WHERE name='$name' LIMIT 1");
        $this->app->DB->UPDATE("UPDATE datei_stichwoerter SET parameter='$newname' WHERE parameter='$name' AND objekt='Wiki'");
        header("Location: index.php?module=wiki&action=list&name=$newname");
        exit;

      }
    }
    /*
       if($key==$_SESSION['deletekey'] && $name !="" && $key!="")
       { 
    //loeschen
    $_SESSION['deletekey'] = "";
    $this->app->DB->Delete("DELETE FROM wiki WHERE name='$name' LIMIT 1");
    header("Location: index.php?module=wiki&action=list");
    exit;
    }
    else if($name !="")
    { 
    $l=20;
    $c = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxwz0123456789";
    for(;$l > 0;$l--) $s .= $c{rand(0,strlen($c))};
    $key = str_shuffle($s);

    $_SESSION['deletekey'] = $key;
    $this->app->Tpl->Set(TAB1,"<div class=\"error\">Seite: <b>$name</b> wirklich l&ouml;schen? <a href=\"index.php?module=wiki&action=delete&name=$name&key=$key\">Seite jetzt l&ouml;schen!</a></div>");
    $this->app->Tpl->Set(TABTEXT,"Wiki");
    $this->app->Tpl->Parse(PAGE,"wiki.tpl");
    }
     */               

    $this->app->Tpl->Set(TAB1,"<form action=\"\" method=\"post\">Neuer Name: <input type=\"text\" name=\"newname\" value=\"$name\" size=\"20\">&nbsp;<input type=\"submit\" value=\"umbenennen\" name=\"submit\"></form>");
    $this->app->Tpl->Set(TABTEXT,"Wiki");
    $this->app->Tpl->Parse(PAGE,"wiki.tpl");


  }



  function WikiCreate()
  {
    $name = $this->app->Secure->GetGET("name");
    if($name !="")
    {
      $wikiname = $this->app->DB->Select("SELECT name FROM wiki WHERE name='$name' LIMIT 1");

      if($wikiname != $name)
      {
        $this->app->DB->Insert("INSERT INTO wiki (name,content) VALUES ('$name','')");
        header("Location: index.php?module=wiki&action=edit&name=$name");
        exit;
      } else {
        header("Location: index.php?module=wiki&action=edit&name=$name");
        exit;
      }
    }
  }

  function WikiList()
  {
    $this->WikiMenu();

    $name = $this->app->Secure->GetGET("name");

    if($name !="")
    {
      $wikiname = $this->app->DB->Select("SELECT name FROM wiki WHERE name='$name' LIMIT 1");

      if($wikiname == $name)
      {
        $content = $this->app->DB->Select("SELECT content FROM wiki WHERE name='$name' LIMIT 1");
        $str = $this->app->erp->ReadyForPDF($content);
        $wikiparser = new WikiParser();
        if (preg_match('/(<[^>].*?>)/e', $str))  	
        {
          $str=preg_replace('#(href)="([^:"]*)(?:")#','$1="index.php?module=wiki&action=list&name=$2"',$str);
          $content = $str;
        } else {
          $content = $wikiparser->parse($content);
          //$index = $wikiparser->BuildIndex();
        }

        if($index!==false) {
          //$this->app->Tpl->Set('INDEX', $index);
          //$this->app->Tpl->Parse('WIKIINDEX', 'wiki_index.tpl');
        }

        //Pruefe ob es die Seite Navigation gibt
        $navigation = $this->app->DB->Select("SELECT content FROM wiki WHERE name='Navigation' LIMIT 1");

        if($navigation!="" && $name!="Navigation")
        {
          $navigation = $this->app->erp->ReadyForPDF($navigation);
          $navigation=preg_replace('#(href)="([^:"]*)(?:")#','$1="index.php?module=wiki&action=list&name=$2"',$navigation);
          $content = "<table width=100%><tr valign=top><td width=200><div id=\"wikinav\"><ul><li style=\"color:white;font-weight:bold;padding-bottom:5px;\">Navigation<br></li></ul>$navigation</div></td><td style=\"padding:0px 15px;\">$content</td></tr></table>";
        }

        $this->app->Tpl->Set(TAB1,$content); // TODO Wiki Parser!!!!
      } else {
        $this->WikiCreateDialog();
      }

    } else {
      // hauptseite
      header("Location: index.php?module=wiki&action=list&name=Hauptseite");
      exit;
    }

    $this->app->Tpl->Set(TABTEXT,"$name");
    $this->app->Tpl->Parse(PAGE,"wiki.tpl");
  }

  function WikiMenu()
  {
    $name = $this->app->Secure->GetGET("name");
    $id = $this->app->Secure->GetGET("id");
    if($name=="" && $id!="") $name = $id;
    //    $this->app->Tpl->Add(KURZUEBERSCHRIFT,"Wiki");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=list&name=$name","Seite");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=dateien&id=$name","Dateien");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=edit&name=$name","bearbeiten");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=rename&name=$name","umbenennen");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=new&name=$name","neu");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=delete&name=$name","l&ouml;schen");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=alle","Alle Seiten anzeigen");
    $this->app->erp->MenuEintrag("index.php?module=wiki&action=list&name=Hauptseite","Zur&uuml;ck zur &Uuml;bersicht");
  }


  function WikiEdit()
  {
    $this->WikiMenu();

    $name = $this->app->Secure->GetGET("name");
    //$content = $this->app->Secure->GetPOST("content");
    $content = mysqli_real_escape_string($this->app->DB->connection, $this->app->Secure->POST["content"]);
    $content = str_replace(array('<','>'),array('&lt;','&gt;'),$content);
    $startseite_link = '';

    if($name !="")
    {
      // check if is valid page
      $wikiname = $this->app->DB->Select("SELECT name FROM wiki WHERE name='$name' LIMIT 1");

      $home_wikis = $this->app->DB->SelectArr("SELECT target FROM accordion");
      $found = false;
      for($i=0;$i<count($home_wikis);$i++)
        if($home_wikis[$i]['target']==$wikiname) {$found=true;break;}
      if($found) $startseite_link = "<input type=\"submit\" name=\"submitAndGoBack\" value=\"Speichern und zurück zur Startseite\" name=\"submit\">";


      if($wikiname != $name)	
      {
        // seite gibt es nicht!!!	
      } else { // wenn es seite gibt speichern
        if($this->app->Secure->GetPOST("submit")!="" || $this->app->Secure->GetPOST("submitAndGoBack")!="")
        {
          $this->app->DB->Update("UPDATE wiki SET lastcontent=content WHERE name='$name' LIMIT 1");
          $this->app->DB->Update("UPDATE wiki SET content='$content' WHERE name='$name' LIMIT 1");
          if($this->app->Secure->GetPOST("submitAndGoBack")!='')
            header("Location: index.php?module=welcome&action=start");
          else
            header("Location: index.php?module=wiki&action=list&name=$name");
          exit;
        }
        $content = $this->app->DB->Select("SELECT content FROM wiki WHERE name='$name' LIMIT 1");
        if (!preg_match('/(<[^>].*?>)/e', $str))  	
        {
          $wikiparser = new WikiParser();
          $content = $wikiparser->parse($content);
          //$index = $wikiparser->BuildIndex();
        }


      }
    } else {
      // Seite fehlt!!! soll diese angelegt werden?
      $this->WikiCreateDialog();
    }



    $this->app->Tpl->Set(TAB1,"<h1>Bearbeiten von Seite $name</h1><br><form action=\"\" method=\"post\"><textarea rows=\"25\" cols=\"120\" name=\"content\">$content</textarea><br>
        $startseite_link
        <center>
        <input type=\"submit\" value=\"Speichern\" name=\"submit\">
        </center>
        </form>");
    $this->app->Tpl->Set(TABTEXT,"$name - Seite bearbeiten");
    $this->app->Tpl->Parse(PAGE,"wiki.tpl");
  }





}

?>
