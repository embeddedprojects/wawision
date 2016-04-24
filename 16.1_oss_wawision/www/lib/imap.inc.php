<?php

/*
* IMAP include file, contains all email importing functions
* STILL EXPERIMENTAL - USE WITH CARE! you've been warned :)
*/

class IMAP {


  function IMAP()
  {
    // supported protocols
    $this->IMAP_IMAP	  = 1;
    $this->IMAP_POP3	  = 2;
    $this->IMAP_IMAP_SSL  = 3;
    $this->IMAP_POP3_SSL  = 4;
  }

  /* decode mime format strings */
  function imap_decode($text)
  {
    $elements=imap_mime_header_decode($text);
    for($i=0;$i<count($elements);$i++) 
      return htmlspecialchars($elements[$i]->text);
  }

  /* get mime type */
  function imap_get_mime_type(&$structure)
  {
    $primary_mime_type = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");
    if($structure->subtype)
      return $primary_mime_type[(int) $structure->type] . '/' . $structure->subtype;

    return "TEXT/PLAIN";
  }

  /* get part of body by mime type */
  function imap_get_part($stream, $msg_number, $mime_type, $structure = false, $part_number = false)
  {
    if(!$structure)
      $structure = @imap_fetchstructure($stream, $msg_number);
	
    if($structure)
    {
      if($mime_type == $this->imap_get_mime_type($structure))
      { 
	if(!$part_number)
	  $part_number = "1";
			
	$text = imap_fetchbody($stream, $msg_number, $part_number);
		
	if($structure->encoding == 3)
	  return imap_base64($text);
	else if($structure->encoding == 4)
	  return imap_qprint($text);
	else
	  return $text;
      }
	
      if($structure->type == 1) /* multipart */
      {
	while(list($index, $sub_structure) = each($structure->parts))
	{
	  if($part_number)
	    $prefix = $part_number . '.';

	  $data = $this->imap_get_part($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1));
	  if($data)
	    return $data;
	}
      }
    }
    return false;
  }

  /* connect to server and fetch an $mailbox object */
  function imap_connect($server,$port,$folder,$username,$password,$type)
  {
    //determine protocol type and fix the server connect string
    switch($type)
    {
      case $this->IMAP_IMAP: 	 $server_path = '{'.$server.':'.$port.'}'.$folder; 		break;
      case $this->IMAP_POP3: 	 $server_path = '{'.$server.':'.$port.'/pop3}'.$folder; 	break;
      case $this->IMAP_IMAP_SSL: $server_path = '{'.$server.':'.$port.'/imap/ssl/novalidate-cert}'.$folder; 	break;
      case $this->IMAP_POP3_SSL: $server_path = '{'.$server.':'.$port.'/pop3/ssl}'.$folder; 	break;
      default: 	$server_path = '{'.$server.':'.$port.'}'.$folder; 			break;
    }
    return imap_open($server_path, $username, $password);
  }

  /* return number of messages in current mailbox */
  function imap_message_count($mailbox)
  {
    if ($header = imap_check($mailbox)) 
      return $header->Nmsgs;
    else
      return 0;
  }


function flattenParts($messageParts, $flattenedParts = array(), $prefix = '', $index = 1, $fullPrefix = true) {

  foreach($messageParts as $part) {
    $flattenedParts[$prefix.$index] = $part;
    if(isset($part->parts)) {
      if($part->type == 2) {
        $flattenedParts = $this->flattenParts($part->parts, $flattenedParts, $prefix.$index.'.', 0, false);
      }
      elseif($fullPrefix) {
        $flattenedParts = $this->flattenParts($part->parts, $flattenedParts, $prefix.$index.'.');
      }
      else {
        $flattenedParts = $this->flattenParts($part->parts, $flattenedParts, $prefix);
      }
      unset($flattenedParts[$prefix.$index]->parts);
    }
    $index++;
  }

  return $flattenedParts;
      
}

  /* close server connection gracefully */
  function imap_disconnect($mailbox)
  {
    return imap_close($mailbox);
  }

  function encodeToUtf8($string) {
     return mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
  }

  
  function extract_attachments($connection, $message_number) {
   
    $attachments = array();
    $structure = imap_fetchstructure($connection, $message_number);
   
    if(isset($structure->parts) && count($structure->parts)) {
   
        for($i = 0; $i < count($structure->parts); $i++) {
   
            $attachments[$i] = array(
                'is_attachment' => false,
                'filename' => '',
                'name' => '',
                'attachment' => ''
            );
           
            if($structure->parts[$i]->ifdparameters) {
                foreach($structure->parts[$i]->dparameters as $object) {
                    if(strtolower($object->attribute) == 'filename') {
                        $attachments[$i]['is_attachment'] = true;
                        $attachments[$i]['filename'] = $object->value;
                    }
                }
            }
           
            if($structure->parts[$i]->ifparameters) {
                foreach($structure->parts[$i]->parameters as $object) {
                    if(strtolower($object->attribute) == 'name') {
                        $attachments[$i]['is_attachment'] = true;
                        $attachments[$i]['name'] = $object->value;
                    }
                }
            }
           
            if($attachments[$i]['is_attachment']) {
                $attachments[$i]['attachment'] = imap_fetchbody($connection, $message_number, $i+1);
                if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                    $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                }
                elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                    $attachments[$i]['attachment'] = 
quoted_printable_decode($attachments[$i]['attachment']);
                }
            }
           
        }
       
    }
   
    return $attachments;
  }

  function extract_attachments2($mbox, $mid) {

    $this->htmlmsg="";
    $this->plainmsg="";
    $this->charset="";
    unset($this->attachments);

    // BODY
    $s = imap_fetchstructure($mbox,$mid);
    if (!$s->parts)  // simple
        $this->getpart($mbox,$mid,$s,0);  // pass 0 as part-number
    else {  // multipart: cycle through each part
        foreach ($s->parts as $partno0=>$p)
            $this->getpart($mbox,$mid,$p,$partno0+1);
    }

    unset($attachments);
    for($i=0;$i<count($this->attachments);$i++)
    {
      $attachments[$i]['attachment'] = $this->attachments[$i][1];
      $attachments[$i]['is_attachment'] = true;
      $attachments[$i]['filename'] = $this->attachments[$i][0];
      $attachments[$i]['name'] = $this->attachments[$i][0];
    }

    return $attachments;
  }



  function getpart($mbox,$mid,$p,$partno) {
    // $partno = '1', '2', '2.1', '2.1.3', etc for multipart, 0 if simple
    // DECODE DATA
    $data = ($partno)?
        imap_fetchbody($mbox,$mid,$partno):  // multipart
        imap_body($mbox,$mid);  // simple
    // Any part may be encoded, even plain text messages, so check everything.
    if ($p->encoding==4)
        $data = quoted_printable_decode($data);
    elseif ($p->encoding==3)
        $data = base64_decode($data);
    // PARAMETERS
    // get all parameters, like charset, filenames of attachments, etc.
    $params = array();
    if ($p->parameters)
        foreach ($p->parameters as $x)
            $params[strtolower($x->attribute)] = $x->value;
    if ($p->dparameters)
        foreach ($p->dparameters as $x)
            $params[strtolower($x->attribute)] = $x->value;

    // ATTACHMENT
    // Any part with a filename is an attachment,
    // so an attached text file (type 0) is not mistaken as the message.
    if ($params['filename'] || $params['name']) {
        // filename may be given as 'Filename' or 'Name' or both
        $filename = ($params['filename'])? $params['filename'] : $params['name'];
        // filename may be encoded, so see imap_mime_header_decode()
        $this->attachments[] = array($filename,$data);  // this is a problem if two files have same name
    }

/*
    // TEXT
    if ($p->type==0 && $data) {
        // Messages may be split in different parts because of inline attachments,
        // so append parts together with blank row.
        if (strtolower($p->subtype)=='plain')
            $this->plainmsg. = trim($data) ."\n\n";
        else
            $this->htmlmsg. = $data ."<br><br>";
        $this->charset = $params['charset'];  // assume all parts are same charset
    }

    // EMBEDDED MESSAGE
    // Many bounce notifications embed the original message as type 2,
    // but AOL uses type 1 (multipart), which is not handled here.
    // There are no PHP functions to parse embedded messages,
    // so this just appends the raw source to the main message.
    elseif ($p->type==2 && $data) {
        $this->plainmsg. = $data."\n\n";
    }
*/
    // SUBPART RECURSION
    if ($p->parts) {
        foreach ($p->parts as $partno0=>$p2)
            $this->getpart($mbox,$mid,$p2,$partno.'.'.($partno0+1));  // 1.2, 1.2.1, etc.
    }
  }


}
?>
