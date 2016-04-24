<?php
    
  $this->WFdbhost='localhost';
  $this->WFdbuser='root';
  $this->WFdbpass='DBPASS';
  $this->WFdbname='wawision';
  $this->WFuserdata='/var/www/wawision/userdata/'; 
  $this->WFeasylog='/var/www/easylog/easylog.cvs';
  //define('WFHTMLTextareabr',true); //wenn true werden <br /> in HTMLTextareas nicht in \n umgewandelt
  //$this->WFBackupTMP='/tmp';

  $this->WFdemo='false';
  if(file_exists(dirname(__FILE__).'/user_db_version.php'))include(dirname(__FILE__).'/user_db_version.php');
    
?>
