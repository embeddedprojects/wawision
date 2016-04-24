<?php
  if(file_exists(dirname(__FILE__).'/../version.php'))include_once(dirname(__FILE__).'/../version.php');
  //Datenbanken
  
  $dbs = array('15.3' => 'wawision_15_3');
  
  if(preg_match("/([0-9]{2}\.[0-9]{1}).*/",$version_revision, $version))
  {
    if($dbs[$version[1]])
    {
      $this->WFdbname=$dbs[$version[1]];
    }
  }
  

?>