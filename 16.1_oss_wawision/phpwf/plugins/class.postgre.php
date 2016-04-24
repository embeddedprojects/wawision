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

  function DB($dbhost,$dbname,$dbuser,$dbpass,&$app="")
  {
    $this->app = &$app;
    $this->dbname=$dbname;

		/*
    mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);

    mysql_query("SET NAMES 'utf8'");
    mysql_query("SET CHARACTER SET 'utf8'");
    mysql_query('SET lc_time_names = "de_DE" ');
    */
    pg_connect("host=$dbhost port=5432 dbname=$dbname user=$dbuser password=$dbpass")
    or die ("Could not connect to server\n"); 
  }

	function ColumnExists($table, $column) 
	{
		if($table=='' || $column=='')
			return false;

		$exists = $this->Select("select count(*) from pg_class where relname='$table' and relkind='r'");
		if($exists) {
			return $this->Select("SELECT COUNT(*) FROM pg_attribute WHERE attrelid = (SELECT oid FROM pg_class WHERE relname = '$table') AND attname = '$column';");
		}
		return false;
	}

	function SelectDB($database)
  {
    //mysql_select_db($database);
  }
	
  function free(){
    // Speicher freimachen
    pg_free_result($this->_result);
  }

  function Select($sql){
  	/*
    if(mysql_query($sql)){
      $this->results = mysql_query($sql);
      $count = 0;
      $data = array();
      while( $row = mysql_fetch_array($this->results)){
	$data[$count] = $row;
	$count++;
      }
      mysql_free_result($this->results);
    }
    if(count($data) == 1)  $data = $data[0][0];
    if(count($data) < 1) $data="";
    return $data;
    */
		$sql = $this->MySqlToPg($sql);  

    if(pg_query($sql)){
      $this->results = pg_query($sql);
      $count = 0;
      $data = array();
      while( $row = pg_fetch_array($this->results)){
	$data[$count] = $row;
	$count++;
      }
      pg_free_result($this->results);
    }else
    {
      echo "<br><br><br>$sql<br><br><bR>";
			$this->app->erp->Stacktrace();
    }
    if(count($data) == 1)  $data = $data[0][0];
    if(count($data) < 1) $data="";
    
    return $data;
  }

  function MySqlToPg($sql) {
//		$sql = preg_replace('/\suser\s/', ' "user" ', $sql);
		$sql = str_replace('`','', $sql);	
		$sql = str_replace("''","'0'", $sql);	
		
		// wenn update dann entferne LIMIT 1
		

		if(strpos($sql,"UPDATE")!==false)
		$sql = str_replace("LIMIT 1","", $sql);	

		//echo $sql;
		return $sql;
}
 

  function SelectArr($sql){
    //if(mysql_query($sql)){
    /*
    if(1){
      $this->results = mysql_query($sql);
      $count = 0;
      $data = array();
      while( $row = mysql_fetch_array($this->results)){
	unset($ArrData); 
	// erstelle datensatz array
	foreach($row as $key=>$value){
	  if(!is_numeric($key))$ArrData[$key]=$value;
	}while( $row = mysql_fetch_array($this->results)){
	$data[$count] = $ArrData;
        $count++;
      }
      mysql_free_result($this->results);
    }
    return $data;
    */
		$sql = $this->MySqlToPg($sql);   
    $this->results = pg_query($sql);

		if(!$this->results)
    {
      echo "<br><br><br>$sql<br><br><bR>";
      $this->app->erp->Stacktrace();
    }

    $count = 0;
    $data = array();
    while( $row = pg_fetch_array($this->results)){
    	
    	unset($ArrData);
    	foreach($row as $key=>$value){
	  		if(!is_numeric($key))$ArrData[$key]=$value;
	  	}
			$data[$count] = $ArrData;
      $count++;
      
		}	
      pg_free_result($this->results);
   	return $data;
  }
	
  function Result($sql){ 
	$sql = $this->MySqlToPg($sql);
	return pg_fetch_result(pg_query($sql), 0);
	}

  function GetInsertID(){ 
$insert_query = pg_query("SELECT lastval();");
$insert_row = pg_fetch_row($insert_query);
return $insert_row[0];
	}

  function GetArray($sql){
    $i=0;
    $result = pg_query($sql);
    while($row = pg_fetch_assoc($result)) {
      foreach ($row as $key=>$value){
	$tmp[$i][$key]=$value;
      }
      $i++;
    }
    return $tmp;
  }

  function Insert($sql){
		$sql = $this->MySqlToPg($sql);
		$result = pg_query($sql);

		if(!$result)
    {
      echo "<br><br><br>$sql<br><br><bR>";
      $this->app->erp->Stacktrace();
    }
 
		$this->LogSQL($sql,"insert"); 
		return $result; 
	}

  function InsertWithoutLog($sql){ 
		//$sql = $this->MySqlToPg($sql); 
		return pg_query($sql); 
	}

  function Update($sql){ 
		$sql = $this->MySqlToPg($sql);
		$this->LogSQL($sql,"update"); 

		$result = pg_query($sql);
		if(!$result)
		{
      echo "<br><br><br>$sql<br><br><bR>";
			$this->app->erp->Stacktrace();
		}
    return $result;
	}

  function UpdateWithoutLog($sql){ 
		//$sql = $this->MySqlToPg($sql); 
		return pg_query($sql); 
	}
  
	function Delete($sql){ 
		//$sql = $this->MySqlToPg($sql); 
		$this->LogSQL($sql,"delete"); 
		return pg_query($sql); 
	}

  function LogSQL($sql,$befehl)
  {
/*
    $name = $this->app->User->GetName();
    $sql = base64_encode($sql);
    $serial = base64_encode(serialize($this->app->Secure));
    mysql_query("INSERT INTO logdatei (id,name,befehl,statement,app,zeit) 
      VALUES ('','$name','$befehl','$sql','$serial',NOW())");
*/
  }

  function Count($sql){
    if(pg_query($sql)){	
      return pg_num_rows(pg_query($sql));
    }
    else {return 0;}
  }

  function CheckTableExistence($table){
    $result = pg_query("SELECT * FROM $table");
    if (!$result) {
      return false;
      } else { return true; }
  }

 
  function CheckColExistence($table,$col)
  {
    if($this->CheckTableExistence($table)){
      $result = pg_query("SHOW COLUMNS FROM $table");
      if (!$result) {
	//echo 'Could not run query: ' . mysql_error();
	exit;
      }
      if (pg_num_rows($result) > 0) {
	while ($row = pg_fetch_assoc($result)) {
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
      $result = pg_query("SHOW COLUMNS FROM $table");
      if (!$result) {
	//echo 'Could not run query: ' . mysql_error();
	exit;
      }
      if (pg_num_rows($result) > 0) {
	while ($row = pg_fetch_assoc($result)) {
	  $ret[]=$row[Field];
	}
	return $ret;
      }
    }
  }


  function GetColAssocArray($table)
  {
    if($this->CheckTableExistence($table)){
      $result = pg_query("SHOW COLUMNS FROM $table");
      if (!$result) {
	//echo 'Could not run query: ' . mysql_error();
	exit;
      }
      if (pg_num_rows($result) > 0) {
	while ($row = pg_fetch_assoc($result)) {
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
    return pg_query($query);
  }

	function Fetch_Array($sql) {
		return pg_fetch_array($sql);
	}


  function MysqlCopyRow($TableName, $IDFieldName, $IDToDuplicate) 
  {
    if ($TableName AND $IDFieldName AND $IDToDuplicate > 0) {
      $sql = "SELECT * FROM $TableName WHERE $IDFieldName = $IDToDuplicate";
      $result = @pg_query($sql);
      if ($result) {
	$sql = "INSERT INTO $TableName SET ";
	$row = pg_fetch_array($result);
	$RowKeys = array_keys($row);
	$RowValues = array_values($row);
	for ($i=3;$i<count($RowKeys);$i+=2) {
	  if ($i!=3) { $sql .= ", "; }
	  $sql .= $RowKeys[$i] . " = '" . $RowValues[$i] . "'";
	}
	$result = @pg_query($sql);
      }
    }
		return $this->GetInsertID();
  }
  
  function real_escape_string($value)
  {
    return pg_escape_string($value);
    
  }
}
?>
