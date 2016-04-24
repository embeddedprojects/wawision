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

/****************************************************************************
 1. zu jedem Template muss es in einem anderen Template eine Variable geben
	in htmlheader.tpl PAGE fuer page.tpl
****************************************************************************/

/// represent a template (file.tpl)
class ThemeTemplate {
  var $NAME; //Name des Templates
  var $PATH; //PFAD des Templates
  var $parsed; //Zustand 
  var $ORIGINAL; //Parse - Text Vorlage
  var $VARS; //assoziatives Array mit Variablennamen als Index

  function ThemeTemplate($_path, $_file){

    $fp=@fopen($_path.$_file,"r");
    if($fp){
      if(filesize($_path.$_file)>0)
				$contents = fread ($fp, filesize($_path.$_file));
      fclose($fp);
    }

    $this->PATH=$_path;
    $this->NAME=$_file;
    $this->ORIGINAL=isset($contents)?$contents:'';
    $this->CreateVarArray();
  }


  function CreateVarArray(){

    $this->SetVar("",'');
    $pattern = '/((\[[A-Z0-9_]+\]))/';
    preg_match_all($pattern,$this->ORIGINAL,$matches);
    for($i=0;$i<count($matches[0]);$i++)
    {
      $matches[0][$i] = str_replace('[','',$matches[0][$i]);
      $matches[0][$i] = str_replace(']','',$matches[0][$i]);
      $this->SetVar($matches[0][$i],'');
    }

/*
    $this->SetVar("",'');
    $parsevar=false;
    $tmpvar='';
    for($i=0; $i< strlen($this->ORIGINAL); $i++){
      $sign = substr($this->ORIGINAL,$i,1);
      if($sign=="[") $parsevar=true;
      if($parsevar==true && $sign!="[" && $sign!="]") $tmpvar.= $sign;
      if($sign=="]"){
	$parsevar=false;
	if(!preg_match("/ /i", $tmpvar)) $this->SetVar($tmpvar,'');
	$tmpvar='';
      }	
    }
*/

  }

  function Parsed()
  {
    return 1;
    if($this->parsed!=1)
    {
    $fp=@fopen($this->PATH.$this->NAME,"r");
    if($fp){
      $contents = fread ($fp, filesize($this->PATH.$this->FILE));
      fclose($fp);
    }
    $this->ORIGINAL=$contents;
    $this->CreateVarArray();

    }
    $this->parsed=1;
  }

  function AddVar($_var, $_value){ $this->VARS[$_var]=$this->VARS[$_var].$_value; }
  function SetVar($_var, $_value){ $this->VARS[$_var]=$_value; }

}

/*********************** Class PcmsTemplate ****************************/
/// Main Parser for building the html skin (gui) 
class TemplateParser { 
  var $TEMPLATELIST;
  var $VARARRAY;

  function TemplateParser(&$app){     
		$this->app = &$app;
   	$this->TEMPLATELIST=''; 
	}


  function GetVars($tplfile)
  {
    $fp=@fopen($tplfile,"r");
    if($fp){
      $contents = fread ($fp, filesize($tplfile));
      fclose($fp);
    }
    $suchmuster = '/[\[][A-Z_]+[\]]/';
    preg_match_all($suchmuster, $contents, $treffer);
    return $treffer[0];
  }

  function ResetParser()
  {
    unset($this->TEMPLATELIST);
    unset($this->VARARRAY);
  }

  function ReadTemplatesFromPath($_path){

    $directory=opendir($_path);
    while ($file=readdir($directory)){
      if(strstr($file, '.tpl')){ 
	$this->TEMPLATELIST[$file] = new ThemeTemplate($_path,$file);	
      }		
      //$i++;
    }
    closedir($directory);

    //$this->CreateVarArray();
  }

  function CreateVarArray(){
    foreach($this->TEMPLATELIST as $template=>$templatename){
      if(count($this->TEMPLATELIST[$template]->VARS) > 0){
        foreach($this->TEMPLATELIST[$template]->VARS as $key=>$value){
	  $this->VARARRAY[$key]=$value;
	}
      }
    }
  }

  function ShowVariables(){
    foreach($this->VARARRAY as $key=>$value)
    echo "<b>$key =></b>".htmlspecialchars($value)."<br>";
  }

  function ParseVariables($text){
    foreach($this->VARARRAY as $key=>$value)
    {
      if($key=!"")
	$text = str_replace('['.$key.']',$value,$text);
    }
    // fill empty vars
    return $text;
  }

  function ShowTemplates(){
    foreach ($this->TEMPLATELIST as $key=> $value){
      foreach ($value as $key1=> $text){
	if(!is_array($text))echo "$key ".htmlspecialchars($text)."<br>";
	if(is_array($text))foreach($text as $key2=>$value2) echo $key2." ".$value2;
      }
      echo "<br><br>";
    }
  }

  function Set($_var,$_value){ $this->VARARRAY[$_var]=$_value; }

  function Add($_var,$_value){  $this->VARARRAY[$_var]=isset($this->VARARRAY[$_var])?$this->VARARRAY[$_var].$_value:$_value; }
  function Get($_var){  return $this->VARARRAY[$_var]." ";/*=$this->VARARRAY[$_var].$_value;*/ }
  
  function Output($_template)
  {
    echo $this->app->erp->ClearDataBeforeOutput($this->Parse("",$_template,1));
  }


  function OutputAsString($_template)
  {
    return $this->app->erp->ClearDataBeforeOutput($this->Parse("",$_template,1));   
	}


  function Parse($_var, $_template,$return=0){

    //$this->AjaxParse(); 

    if($_template!=""){
      //alle template variablen aufuellen mit den werten aus VARARRAY 
      if(isset($this->TEMPLATELIST[$_template]) && isset($this->TEMPLATELIST[$_template]->VARS) && count($this->TEMPLATELIST[$_template]->VARS)>0){ 
	foreach ($this->TEMPLATELIST[$_template]->VARS as $key=> $value){
	  $this->TEMPLATELIST[$_template]->SetVar($key,isset($this->VARARRAY[$key])?$this->VARARRAY[$key]:'');
      }
      
      //ORIGINAL auffuellen
      $tmptpl = $this->TEMPLATELIST[$_template]->ORIGINAL;
      foreach ($this->TEMPLATELIST[$_template]->VARS as $key=>$value){
	if(!is_numeric($key) && $key!="")
	$tmptpl = str_replace("[".$key."]",$value, $tmptpl);	
      }
      } else $tmptpl = '';
      //aufgefuelltes ORIGINAL in $t_var add($_var,ORIGINAL)
      if($return==1)
	return $tmptpl;
      else
	$this->Add($_var,$tmptpl);
    }
  }

  function AddAndParse($_var, $_value, $_varparse, $_templateparse){
    $this->Set($_var, $_value);
    $this->Parse($_varparse,$_templateparse);
  }

  function FinalParse($_template){

		$print = $this->app->Secure->GetGET("print");
		$printcontent = $this->app->Secure->GetGET("printcontent");

		if($printcontent=="") $printcontent="TAB1";
		if($print=="true") {

			switch($printtype)
			{
				default:
/*
	$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output('test.pdf','D');
exit;
*/
				$out = str_replace("[PRINT]",$this->VARARRAY[$printcontent],$this->TEMPLATELIST['print.tpl']->ORIGINAL);
				echo $out;
			}
				exit;
		}     

    if($_template!=""){
      //alle template variablen aufuellen mit den werten aus VARARRAY
      if(count($this->TEMPLATELIST[$_template]->VARS)>0){ 
        foreach ($this->TEMPLATELIST[$_template]->VARS as $key=> $value)
        {
          $this->TEMPLATELIST[$_template]->SetVar($key,(isset($this->VARARRAY[$key])?$this->VARARRAY[$key]:''));
        }
      }
    }
    //ORIGINAL auffuellen
    $tmptpl = $this->TEMPLATELIST[$_template]->ORIGINAL;
    
    if(count($this->TEMPLATELIST[$_template]->VARS)>0){ 
      foreach ($this->TEMPLATELIST[$_template]->VARS as $key=>$value)
      {
	if($key!="")
	$tmptpl = str_replace("[".$key."]",$value, $tmptpl);
      }
    }
    
    if(count($this->VARARRAY)>0)
      foreach($this->VARARRAY as $key=>$value)
      {
	if($key!="")
	$tmptpl = str_replace('['.$key.']',$value,$tmptpl);
      }
    
		$tmptpl = $this->app->erp->ClearDataBeforeOutput($tmptpl);
    return $tmptpl;
  }

  function AjaxParse()
  {

    foreach($this->TEMPLATELIST as $key=>$value)
    {
      foreach ($this->TEMPLATELIST[$key]->VARS as $var=>$tmp)
      {
	if(strstr($var,"AJAX"))
	{
	  //$this->Set(AJAX_SELECT_PROJEKT,"Hallo");	
	  //$this->VARARRAY[$var]="XVZ";
	  //print_r($this->VARARRAY);
	}
      }
    }
  }


  function KeywordParse()
  {

    foreach($this->TEMPLATELIST as $key=>$value)
    {
      foreach ($this->TEMPLATELIST[$key]->VARS as $var=>$tmp)
      if(strstr($var,"AJAX"))
      {
				echo $var;
      }
    }
  }



} 
?>
