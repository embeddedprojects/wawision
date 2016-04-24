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

class String 
{


  function String()
  {
  }

  function Convert($value,$input,$output)
  {
    if($input=="")
      return $value;

    $array = $this->FindPercentValues($input);
    $regexp = $this->BuildRegExp($array);

    $elements =
      preg_split($regexp,$value,-1,PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

    // input und elements stimmmen ueberein

    $newout = $output;
    $i = 0;
    foreach($array as $key=>$value)
    {
      $newout = str_replace($key,$elements[$i],$newout);
      $i++;
    }
    return $newout;
  }


  function BuildRegExp($array)
  {

    $regexp = '/^';
    foreach($array as $value)
    {
      $value = str_replace('.','\.',$value);
      $value = str_replace('+','\+',$value);
      $value = str_replace('*','\*',$value);
      $value = str_replace('?','\?',$value);
      $regexp .= '(\S+)'.$value;
    }
    $regexp .= '/';

    return $regexp;
  }

  function FindPercentValues($pattern)
  {
    preg_match_all('/(?:(%[0-9]+)|.)/i', $pattern, $matches);

    $start = true;
    foreach($matches[1] as $key=>$value)
    {
      if($value=="")
	$collecting = true;
      else
      {
	$collecting = false;
	$oldhash = $hash;
	$hash = $value;
      }

      if(!$collecting)
      {
	if(!$start)
	  $replace[$oldhash] = $collect;
	$collect="";
      }
      else
	$collect .=$matches[0][$key];
      $start = false;
    }
    $replace[$hash] = $collect;
    return $replace;
  }

  function encodeText($string)
  {
    $string = str_replace("\\r\\n","#BR#",$string);
    $string = str_replace("\n","#BR#",$string);
    $encoded = htmlspecialchars(stripslashes($string), ENT_QUOTES); 

   
    return $encoded;
  }

 function decodeText($_str, $_form=true) 
 {
   if ($_form) {
     $_str      = str_replace("#BR#", "\r\n", $_str);
   }
   else {
     $_str      = str_replace("#BR#", "<br>", $_str);
   }
   return($_str);
 }

	function valid_utf8( $string )
	{
		return !((bool)preg_match('~\xF5\xF6\xF7\xF8\xF9\xFA\xFB\xFC\xFD\xFE\xFF\xC0\xC1~ms',$string));
	}

}
?>
