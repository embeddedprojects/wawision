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
//function hex2dec
//returns an associative array (keys: R, G, B) from
//a hex html code (e.g. #3FE5AA)
function hex2dec($couleur = "#000000"){
    $R = substr($couleur, 1, 2);
    $rouge = hexdec($R);
    $V = substr($couleur, 3, 2);
    $vert = hexdec($V);
    $B = substr($couleur, 5, 2);
    $bleu = hexdec($B);
    $tbl_couleur = array();
    $tbl_couleur['R']=$rouge;
    $tbl_couleur['G']=$vert;
    $tbl_couleur['B']=$bleu;
    return $tbl_couleur;
}

//conversion pixel -> millimeter in 72 dpi
function px2mm($px){
    return $px*25.4/72;
}

function txtentities($html){
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans = array_flip($trans);
    return strtr($html, $trans);
}

class SuperFPDF extends PDF_EPS {
  
  /***********************************
   *     user space functions
   ***********************************/

 function SuperFPDF($orientation='P',$unit='mm',$format='A4'){
      $this->B=0;
    $this->I=0;
    $this->U=0;
    $this->HREF='';
    $this->issetfont=false;
    $this->issetcolor=false;
  parent::PDF_EPS($orientation,$unit,$format);
	}
 
  
  /***********************************
   *     data aggregation functions
   ***********************************/  

  /*
  * general setter function
  *
  * proper usage:
  * $field may be either a string or an array of strings
  * if field is an array, $rdata must be an array(A) of associative arrays(B) with each of B representing a field
  * if field is a string, $rdata must be an associative array 
  *
  */
  public function setDocumentDetails($field, $rdata){
    if(is_array($field)) {
      for($i=0;$i<count($field);$i++) {
        $this->$field[$i] = $rdata[$i];
      }
    } else $this->$field=$rdata;
  }

   //////////////////////////////////////
  //html parser

  function WriteHTML($html)
  {
      $html=strip_tags($html, "<b><u><i><a><img><p><br>
  <strong><em><font><tr><blockquote>"); //remove all unsupported tags

      $html = str_replace('&uuml;','ü',$html);
      $html = str_replace('&auml;','ä',$html);
      $html = str_replace('&ouml;','ö',$html);
      $html = str_replace('&szlig;','ß',$html);
      $html = str_replace('&Uuml;','Ü',$html);
      $html = str_replace('&Auml;','Ä',$html);
      $html = str_replace('&Ouml;','Ö',$html);
 
      $html=str_replace("\n", ' ', $html); //replace carriage returns by spaces
      $a=preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE); //explodes the string
      foreach($a as $i=>$e)
      {
          if($i%2==0)
          {
              //Text
              if($this->HREF)
                  $this->PutLink($this->HREF, $e);
              else
                  $this->Write(5, stripslashes(txtentities($e)));
          }
          else
          {
              //Tag
              if($e{0}=='/')
                  $this->CloseTag(strtoupper(substr($e, 1)));
              else
              {
                  //Extract attributes
                  $a2=explode(' ', $e);
                  $tag=strtoupper(array_shift($a2));
                  $attr=array();
                  foreach($a2 as $v)
                      if(ereg('^([^=]*)=["\']?([^"\']*)["\']?$', $v, $a3))
                          $attr[strtoupper($a3[1])]=$a3[2];
                  $this->OpenTag($tag, $attr);
              }
          }
      }
  }

  function OpenTag($tag, $attr)
  {
      //Opening tag
      switch($tag){
          case 'STRONG':
              $this->SetStyle('B', true);
              break;
          case 'EM':
              $this->SetStyle('I', true);
              break;
          case 'B':
          case 'I':
          case 'U':
              $this->SetStyle($tag, true);
              break;
          case 'A':
              $this->HREF=$attr['HREF'];
              break;
          case 'IMG':
              if(isset($attr['SRC']) and (isset($attr['WIDTH']) or isset($attr['HEIGHT']))) {
                  if(!isset($attr['WIDTH']))
                      $attr['WIDTH'] = 0;
                  if(!isset($attr['HEIGHT']))
                      $attr['HEIGHT'] = 0;
                  $this->Image($attr['SRC'], $this->GetX(), $this->GetY(), px2mm($attr['WIDTH']), px2mm($attr['HEIGHT']));
              }
              break;
          case 'TR':
          case 'BLOCKQUOTE':
          case 'BR':
              $this->Ln(4);
              break;
          case 'P':
              $this->Ln(4);
              break;
          case 'FONT':
              if (isset($attr['COLOR']) and $attr['COLOR']!='') {
                  $coul=hex2dec($attr['COLOR']);
                  $this->SetTextColor($coul['R'], $coul['G'], $coul['B']);
                  $this->issetcolor=true;
              }
              if (isset($attr['FACE']) and in_array(strtolower($attr['FACE']), $this->fontlist)) {
                  $this->SetFont(strtolower($attr['FACE']));
                  $this->issetfont=true;
              }
              break;
      }
  }

  function CloseTag($tag)
  {
      //Closing tag
      if($tag=='STRONG')
          $tag='B';
      if($tag=='EM')
          $tag='I';
      if($tag=='B' or $tag=='I' or $tag=='U')
          $this->SetStyle($tag, false);
      if($tag=='A')
          $this->HREF='';
      if($tag=='FONT'){
          if ($this->issetcolor==true) {
              $this->SetTextColor(0);
          }
          if ($this->issetfont) {
              $this->SetFont('arial');
              $this->issetfont=false;
          }
      }
  }

  function SetStyle($tag, $enable)
  {
      //Modify style and select corresponding font
      $this->$tag+=($enable ? 1 : -1);
      $style='';
      foreach(array('B', 'I', 'U') as $s)
          if($this->$s>0)
              $style.=$s;
      $this->SetFont('', $style);
  }

  function PutLink($URL, $txt)
  {
      //Put a hyperlink
      $this->SetTextColor(0, 0, 255);
      $this->SetStyle('U', true);
      $this->Write(5, $txt, $URL);
      $this->SetStyle('U', false);
      $this->SetTextColor(0);
  } 
  /*
  Informations
  Author: The-eh
  License: Freeware
  Description
  This script implements Code 39 barcodes. A Code 39 barcode can encode a string with the following characters: digits (0 to 9), uppercase letters (A to Z) and 8 additional characters (- . space $ / + % *).

  Code39(float xpos, float ypos, string code [, float baseline [, float height]])
  xpos: abscissa of barcode
  ypos: ordinate of barcode
  code: value of barcode
  baseline: corresponds to the width of a wide bar (defaults to 0.5)
  height: bar height (defaults to 5) 
  */
  public function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5, $printText=false){

    $wide = $baseline;
    $narrow = $baseline / 3 ;
    $gap = $narrow;

    $barChar['0'] = 'nnnwwnwnn';
    $barChar['1'] = 'wnnwnnnnw';
    $barChar['2'] = 'nnwwnnnnw';
    $barChar['3'] = 'wnwwnnnnn';
    $barChar['4'] = 'nnnwwnnnw';
    $barChar['5'] = 'wnnwwnnnn';
    $barChar['6'] = 'nnwwwnnnn';
    $barChar['7'] = 'nnnwnnwnw';
    $barChar['8'] = 'wnnwnnwnn';
    $barChar['9'] = 'nnwwnnwnn';
    $barChar['A'] = 'wnnnnwnnw';
    $barChar['B'] = 'nnwnnwnnw';
    $barChar['C'] = 'wnwnnwnnn';
    $barChar['D'] = 'nnnnwwnnw';
    $barChar['E'] = 'wnnnwwnnn';
    $barChar['F'] = 'nnwnwwnnn';
    $barChar['G'] = 'nnnnnwwnw';
    $barChar['H'] = 'wnnnnwwnn';
    $barChar['I'] = 'nnwnnwwnn';
    $barChar['J'] = 'nnnnwwwnn';
    $barChar['K'] = 'wnnnnnnww';
    $barChar['L'] = 'nnwnnnnww';
    $barChar['M'] = 'wnwnnnnwn';
    $barChar['N'] = 'nnnnwnnww';
    $barChar['O'] = 'wnnnwnnwn';
    $barChar['P'] = 'nnwnwnnwn';
    $barChar['Q'] = 'nnnnnnwww';
    $barChar['R'] = 'wnnnnnwwn';
    $barChar['S'] = 'nnwnnnwwn';
    $barChar['T'] = 'nnnnwnwwn';
    $barChar['U'] = 'wwnnnnnnw';
    $barChar['V'] = 'nwwnnnnnw';
    $barChar['W'] = 'wwwnnnnnn';
    $barChar['X'] = 'nwnnwnnnw';
    $barChar['Y'] = 'wwnnwnnnn';
    $barChar['Z'] = 'nwwnwnnnn';
    $barChar['-'] = 'nwnnnnwnw';
    $barChar['.'] = 'wwnnnnwnn';
    $barChar[' '] = 'nwwnnnwnn';
    $barChar['*'] = 'nwnnwnwnn';
    $barChar['$'] = 'nwnwnwnnn';
    $barChar['/'] = 'nwnwnnnwn';
    $barChar['+'] = 'nwnnnwnwn';
    $barChar['%'] = 'nnnwnwnwn';

    $this->SetFont('Arial', '', 10);
    if($printText) $this->Text($xpos, $ypos + $height + 4, $code);
    $this->SetFillColor(0);

    $code = '*'.strtoupper($code).'*';
    for($i=0; $i<strlen($code); $i++){
        $char = $code{$i};
        if(!isset($barChar[$char])){
            $this->Error('Invalid character in barcode: '.$char);
        }
        $seq = $barChar[$char];
        for($bar=0; $bar<9; $bar++){
            if($seq{$bar} == 'n'){
                $lineWidth = $narrow;
            }else{
                $lineWidth = $wide;
            }
            if($bar % 2 == 0){
                $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
            }
            $xpos += $lineWidth;
        }
        $xpos += $gap;
    }
  }
  
}

