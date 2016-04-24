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

/// Secure Layer, SQL Inject. Check, Syntax Check
class Secure 
{
  var $GET;
  var $POST;


	function Secure(&$app){
    $this->app = &$app;
    // clear global variables, that everybody have to go over secure layer
    
    $this->GET = $_GET;
//    $_GET="";
    $this->POST = $_POST;
 //   $_POST="";

    $this->AddRule('notempty','reg','.'); // at least one sign
    $this->AddRule('alpha','reg','[a-zA-Z]');
    $this->AddRule('digit','reg','[0-9]');
    $this->AddRule('space','reg','[ ]');
    $this->AddRule('specialchars','reg','[_-]');
    $this->AddRule('email','reg','^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$');
    $this->AddRule('datum','reg','([0-9]{1,2})\.([0-9]{1,2})\.([0-9]{4})');
    
    $this->AddRule('username','glue','alpha+digit');
    $this->AddRule('password','glue','alpha+digit+specialchars');
  }
 

  function GetGET($name,$rule="",$maxlength="",$sqlcheckoff="")
  {
    return $this->Syntax(isset($this->GET[$name])?$this->GET[$name]:'',$rule,$maxlength,$sqlcheckoff);
  }

  function GetPOST($name,$rule="",$maxlength="",$sqlcheckoff="")
  {
  	return $this->Syntax(isset($this->POST[$name])?$this->POST[$name]:'',$rule,$maxlength,$sqlcheckoff);
  }
 
	function GetPOSTForForms($name,$rule="",$maxlength="",$sqlcheckoff="")
  {
  	return $this->SyntaxForForms($this->POST[$name],$rule,$maxlength,$sqlcheckoff);
  }



  function GetPOSTArray()
  {
    if(count($this->POST)>0)
    {
      foreach($this->POST as $key=>$value)
      {
        $key = $this->GetPOST($key,"alpha+digit+specialchars",20);
        $ret[$key]=$this->GetPOST($value);
      }	
    }
    if(isset($ret))return $ret;
  }

  function GetGETArray()
  {
    if(count($this->GET)>0)
    {
      foreach($this->GET as $key=>$value)
      {
        $key = $this->GetGET($key,"alpha+digit+specialchars",20);
        $ret[$key]=$this->GetGET($value);
      }	
    }
    if(isset($ret))return $ret;
    return;
  }

function stripallslashes($string) {
    
  while(strchr($string,'\\')) {
      $string = stripslashes($string);
  }
  return $string;
} 

  function smartstripslashes($str) {
    $cd1 = substr_count($str, "\"");
    $cd2 = substr_count($str, "\\\"");
    $cs1 = substr_count($str, "'");
    $cs2 = substr_count($str, "\\'");
    $tmp = strtr($str, array("\\\"" => "", "\\'" => ""));
    $cb1 = substr_count($tmp, "\\");
    $cb2 = substr_count($tmp, "\\\\");
    if ($cd1 == $cd2 && $cs1 == $cs2 && $cb1 == 2 * $cb2) {
      return strtr($str, array("\\\"" => "\"", "\\'" => "'", "\\\\" => "\\"));
    }
    return $str;
  }

  function SyntaxForForms($value,$rule,$maxlength="",$sqlcheckoff="")
	{
    return $value;//mysqli_real_escape_string($this->app->DB->connection,$value);//mysqli_real_escape_string($value);
	}

  // check actual value with given rule
  function Syntax($value,$rule,$maxlength="",$sqlcheckoff="")
  {
		$value = str_replace("\xef\xbb\xbf","NONBLOCKINGZERO",$value);
    if(is_array($value))
		{
      return $value;
		}

    $value = $this->stripallslashes($value);
    $value = $this->smartstripslashes($value);

		$value = $this->app->erp->superentities($value);		


    //$value = htmlspecialchars($value,ENT_QUOTES);
//		$value = htmlentities($value,ENT_QUOTES,'UTF-8');
    //$value = html_entity_decode ($value);
//		$value = str_replace('"','&Prime;',$value);
//		$value = str_replace("'",'&prime;',$value);
		

//    $value = utf8_decode($value);
 
    //$value = strip_tags($value); //entfernt alle Entfernt HTML- und PHP-Tags aus einem String
//    $value=strip_tags($value,'<ol><ul><li><h1><h2><h3><h4><h5><h6><em><br><p><strong><a><hr><span><pre><img>');

  //  if($maxlength!=""){
  //    if(strlen($value)>$maxlength)
  //      return "";
  //  }


    if($rule=="" && $sqlcheckoff == "")
		{
      //return mysqli_real_escape_string($value);
      return mysqli_real_escape_string($this->app->DB->connection,$value);//mysqli_real_escape_string($value);
		}elseif($rule=="" && $sqlcheckoff != "")
    {
      return $value;
    }

    // build complete regexp

    // check if rule exists
   
    if($this->GetRegexp($rule)!=""){
      //$v = '/^['.$this->GetRegexp($rule).']+$/';
      $v = $this->GetRegexp($rule);
      if (preg_match_all('/'.$v.'/i', $value, $teffer) )
      {
	if($sqlcheckoff=="")
	  return mysqli_real_escape_string($this->app->DB->connection,$value);//mysqli_real_escape_string($value);
	else
	  return $value;
      }
      else
	return "";
    }
    else
    {
      echo "<table border=\"1\" width=\"100%\" bgcolor=\"#FFB6C1\">
	<tr><td>Rule <b>$rule</b> doesn't exists!</td></tr></table>";
      return "";
    }
  }


  function RuleCheck($value,$rule)
  {
    $v = $this->GetRegexp($rule);
    if (preg_match_all('/'.$v.'/i', $value, $teffer) )
      return true;
    else
      return false;
  }

  function AddRule($name,$type,$rule)
  {
    // type: reg = regular expression
    // type: glue ( already exists rules copy to new e.g. number+digit)
    $this->rules[$name]=array('type'=>$type,'rule'=>$rule);
  }

  // get complete regexp by rule name
  function GetRegexp($rule)
  {
    $rules = explode("+",$rule);
    $ret = '';
    foreach($rules as $key)
    {
        // check if rule is last in glue string
        if($this->rules[$key]['type']=="glue")
        {
          $subrules = explode("+",$this->rules[$key]['rule']);
          if(count($subrules)>0)
          {
            foreach($subrules as $subkey)
            {
              $ret .= $this->GetRegexp($subkey);
            }
          }
        }
        elseif($this->rules[$key]['type']=="reg")
        {
          $ret .= $this->rules[$key]['rule'];
        }
        else
        {
          //error
        }
    }
    if($ret=="")
      $ret = "none";
    return $ret;
  }

}


?>
