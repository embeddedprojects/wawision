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
class Pinwand {
  var $app;

  function Pinwand($app) {
    $this->app=&$app;
    $this->app->ActionHandlerInit($this);

    $this->app->ActionHandler("list","PinwandList");
    $this->app->ActionHandler("edit","PinwandEdit");
    $this->app->ActionHandler("create","PinwandCreate");
    $this->app->ActionHandler("delete","PinwandDelete");

    $this->app->DefaultActionHandler("list");

    $this->app->ActionHandlerListen($app);
  }



  function PinwandList()
  {

    $this->app->erp->MenuEintrag("index.php?module=pinwand&action=list","&Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=pinwand&action=create","Neue Pinwand");

    $this->app->YUI->TableSearch(PAGE,"pinwand_list");

    $this->app->BuildNavigation=false;
  }

  function PinwandDelete()
  {
    $id = $this->app->Secure->GetGET("id");

    $check_user = $this->app->DB->Select("SELECT user FROM pinwand WHERE id='$id' LIMIT 1");
    if($check_user==$this->app->User->GetID() || $this->app->User->GetType()=="admin")
    {
      $this->app->DB->Delete("DELETE FROM pinwand_user WHERE pinwand='$id'");
      $this->app->DB->Delete("DELETE FROM aufgabe WHERE pinwand_id='$id'");
      $this->app->DB->Delete("DELETE FROM pinwand WHERE id='$id'");

      $msg = $this->app->erp->base64_url_encode("<div class=\"info\">Die Pinwand inkl. der Aufgaben wurde entfernt!</div>  ");
      header("Location: index.php?module=pinwand&action=list&msg=$msg");
      exit;
    }
  }


  function PinwandEdit()
  {
    $id = $this->app->Secure->GetGET("id");
    $speichern = $this->app->Secure->GetPOST("speichern");
    $name = $this->app->Secure->GetPOST("name");
    $personen = $this->app->Secure->GetPOST("personen");

    $this->app->BuildNavigation=false;

    $this->app->erp->MenuEintrag("index.php?module=pinwand&action=list","Zur&uuml;ck zur &Uuml;bersicht");
    $this->app->erp->MenuEintrag("index.php?module=pinwand&action=edit","Details");

    if($id > 0 && $speichern!="" && $name !="")
    {
      $this->app->DB->Delete("DELETE FROM pinwand_user WHERE pinwand='$id'");
      for($i=0;$i<count($personen);$i++)
      {
        $this->app->DB->Insert("INSERT INTO pinwand_user (id,pinwand,user) VALUES ('','$id','".$personen[$i]."')");
      } 
      $this->app->DB->Update("UPDATE pinwand SET name='$name' WHERE id='$id' LIMIT 1");
    }

    $user = $this->app->User->GetID();
    $users = $this->app->DB->SelectArr("SELECT u.id, a.name as description FROM user u LEFT JOIN adresse a ON a.id=u.adresse WHERE u.activ='1' ORDER BY a.name");
    $permissions = $this->app->DB->SelectArr("SELECT DISTINCT pu.user FROM pinwand_user pu WHERE pu.pinwand='$id'");
    for($i=0;$i<count($permissions);$i++)
    {
      $check_permissions[] = $permissions[$i]['user'];
    }

    for($i=0; $i<count($users);$i++){

      $select = (($user==$users[$i]['id']) || in_array($users[$i]['id'],$check_permissions) ? "checked" : "");
      $user_out .= "<input name=\"personen[]\" type=\"checkbox\" value=\"{$users[$i]['id']}\" $select>{$users[$i]['description']}<br>";
    }
    $this->app->Tpl->Set('PERSONEN', $user_out);

    $name = $this->app->DB->Select("SELECT name FROM pinwand WHERE id='$id' LIMIT 1");

    $this->app->Tpl->Set(NAME, $name);

    $this->app->Tpl->Parse(PAGE,"pinwand_edit.tpl");
  }




}
if(!class_exists('Pinwand'))
{
  class Pinwand
  {
    function __construct(&$app)
    {
      $this->app=&$app; 

      $this->app->ActionHandlerInit($this);

      $this->app->ActionHandler("list","PinwandList");
      $this->app->DefaultActionHandler("list");


      $this->app->ActionHandlerListen($app);
    }    
    function PinwandList()
    {
      $this->app->Tpl->Set(VERS,'Enterprise');
      $this->app->Tpl->Parse(PAGE, "only_version.tpl");
    }
  }
  
  
}
?>
