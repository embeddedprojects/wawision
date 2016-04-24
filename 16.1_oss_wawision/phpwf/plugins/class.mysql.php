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
/// Interface for communication with a MySQL Database
class DB{
  var $dbname;
  var $connection;

  function DB($dbhost,$dbname,$dbuser,$dbpass,&$app="")
  {
    $this->app = &$app;
    $this->dbname=$dbname;

    $this->connection = mysqli_connect($dbhost, $dbuser, $dbpass);
    mysqli_select_db($this->connection,$dbname);

    mysqli_query($this->connection,"SET NAMES 'utf8'");
    mysqli_query($this->connection,"SET SESSION SQL_MODE := ''");
    mysqli_query($this->connection,"SET CHARACTER SET 'utf8'");
    mysqli_query($this->connection,'SET lc_time_names = "de_DE" ');
  }

  function GetVersion()
  {
    $version_string = mysqli_get_server_info($this->connection);
    $version_string = substr($version_string,0,3);
    $version_string = str_replace('.','',$version_string);
    return $version_string;
  }

  function Close()
  {
    mysqli_close($this->connection);
  }

	function SelectDB($database)
  {
    mysqli_select_db($database);
  }
	
  function free(){
    // Speicher freimachen
    mysqli_free_result($this->_result);
  }

	  function ColumnExists($table, $column)
  {
    if($table=='' || $column=='')
      return false;

		$exists = $this->Select("SELECT COUNT(*)
FROM information_schema.columns
WHERE table_schema = '{$this->dbname}' 
AND table_name = '$table' AND column_name = '$column'");
		return $exists;
  }

  function Select($sql){
    if(mysqli_query($this->connection,$sql)){
      $this->results = mysqli_query($this->connection,$sql);
 			/**
       * Abbrechen query mit SET beginnt
       */
      if (substr(strtolower($sql),0,3) == 'set') {
        return "";
      }
      $count = 0;
      $data = array();
      while( $row = mysqli_fetch_array($this->results)){
        $data[$count] = $row;
        $count++;
      }
      mysqli_free_result($this->results);
    } else return false;
    if(count($data) == 1)  $data = $data[0][0];
    if(count($data) < 1) $data="";
    return $data;
  }
 
  function SelectArr($sql){

    //if(mysqli_query($this->connection,$sql)){
    if(1){
      $this->results = mysqli_query($this->connection,$sql);
      $count = 0;
      $data = array();
      while( $row = @mysqli_fetch_array($this->results)){
				unset($ArrData); 
				// erstelle datensatz array
				foreach($row as $key=>$value){
	  			if(!is_numeric($key))$ArrData[$key]=$value;
				}
				$data[$count] = $ArrData;
        $count++;
      }
      @mysqli_free_result($this->results);
    }
    return $data;
  }
	
  function Result($sql){ return mysqli_result(mysqli_query($this->connection,$sql), 0);}

  function GetInsertID(){ return mysqli_insert_id($this->connection);}

  function GetArray($sql){
    $i=0;
    $result = mysqli_query($this->connection,$sql);
    while($row = mysqli_fetch_assoc($result)) {
      foreach ($row as $key=>$value){
	$tmp[$i][$key]=$value;
      }
      $i++;
    }
    return $tmp;
  }

  function Insert($sql){ $this->LogSQL($sql,"insert"); return mysqli_query($this->connection,$sql); }
  function InsertWithoutLog($sql){ return mysqli_query($this->connection,$sql); }
  function Update($sql){ $this->LogSQL($sql,"update"); return mysqli_query($this->connection,$sql); }
  function UpdateWithoutLog($sql){ return mysqli_query($this->connection,$sql); }
  function Delete($sql){ $this->LogSQL($sql,"delete"); return mysqli_query($this->connection,$sql); }

  function LogSQL($sql,$befehl)
  {
/*
    $name = $this->app->User->GetName();
    $sql = base64_encode($sql);
    $serial = base64_encode(serialize($this->app->Secure));
    mysqli_query($this->connection,"INSERT INTO logdatei (id,name,befehl,statement,app,zeit) 
      VALUES ('','$name','$befehl','$sql','$serial',NOW())");
*/
  }

  function Count($sql){
    if(mysqli_query($this->connection,$sql)){	
      return mysqli_num_rows(mysqli_query($this->connection,$sql));
    }
    else {return 0;}
  }

  function CheckTableExistence($table){
    $result = mysqli_query($this->connection,"SELECT * FROM $table LIMIT 1");
    if (!$result) {
      return false;
      } else { return true; }
  }

 
  function CheckColExistence($table,$col)
  {
    if($this->CheckTableExistence($table)){
      $result = mysqli_query($this->connection,"SHOW COLUMNS FROM $table");
      if (!$result) {
	echo 'Could not run query: ' . mysqli_error();
	exit;
      }
      if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
	  if($row[Field]==$col)
	    return true;
	}
      }
    }
    return false;
  }



  function GetColArray($table)
  {
    if($this->CheckTableExistence($table)){
      $result = mysqli_query($this->connection,"SHOW COLUMNS FROM $table");
      if (!$result) {
	echo 'Could not run query: ' . mysqli_error();
	exit;
      }
      if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
	  $ret[]=$row[Field];
	}
	return $ret;
      }
    }
  }


  function GetColAssocArray($table)
  {
    if($this->CheckTableExistence($table)){
      $result = mysqli_query($this->connection,"SHOW COLUMNS FROM $table");
      if (!$result) {
	echo 'Could not run query: ' . mysqli_error();
	exit;
      }
      if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
	  $ret[$row[Field]]="";
	}
	return $ret;
      }
    }
  }

  function UpdateArr($tablename,$pk,$pkname,$ArrCols)
  {
    if(count($ArrCols)>0){
      foreach($ArrCols as $key=>$value){
	if($key!=$pkname)$this->Query("UPDATE `$tablename` SET `$key`='$value' 
	  WHERE `$pkname`='$pk' LIMIT 1");
      }
    }
  }

  function InsertArr($tablename,$pkname,$ArrCols)
  {
    // save primary than update
    $this->Query("INSERT INTO `$tablename` (id) VALUES ('')");
    
    $pk = $this->GetInsertID();
    $this->UpdateArr($tablename,$pk,$pkname,$ArrCols);
  }

  /// get table content with specified cols 
  function SelectTable($tablename,$cols){
   
    $firstcol = true;
    if(count($cols)==0)
      $selection = '*';
    else 
    {
			$selection = '';
      foreach($cols as $value)
      {
	if(!$firstcol)
	$selection .= ','; 
	
	$selection .= $value;

	$firstcol=false;
      }
    }
 
    $sql = "SELECT $selection FROM $tablename";
    return $this->SelectArr($sql);
  }
	


  function Query($query){
    return mysqli_query($this->connection,$query);
  }

  function Fetch_Array($sql) {
    return mysqli_fetch_array($sql);
  }


  function MysqlCopyRow($TableName, $IDFieldName, $IDToDuplicate) 
  {
    if ($TableName AND $IDFieldName AND $IDToDuplicate > 0) {
      $sql = "SELECT * FROM $TableName WHERE $IDFieldName = $IDToDuplicate";
      $result = @mysqli_query($this->connection,$sql);
      if ($result) {
      $sql = "INSERT INTO $TableName SET ";
      $row = mysqli_fetch_array($result);
      $RowKeys = array_keys($row);
      $RowValues = array_values($row);
      for ($i=3;$i<count($RowKeys);$i+=2) {
        if ($i!=3) { $sql .= ", "; }
        $sql .= $RowKeys[$i] . " = '" . $RowValues[$i] . "'";
      }
      $result = @mysqli_query($this->connection,$sql);
      }
    }
    return $this->GetInsertID();
  }
  function real_escape_string($value)
  {
    return mysqli_real_escape_string($this->connection, $value);
  }
}
?>
