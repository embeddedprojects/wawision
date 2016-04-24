<?php

class Table2Array {

	private $data;

	private $rawData;
	private $convertedTitles;
	private $convertedData;
	

	public function __construct($filename,$sourcetype="xls") {
		error_reporting(E_ALL ^ E_NOTICE);
		$this->rawData = $this->convertedTitles = $this->convertedData = array();
		if($sourcetype=="xls"){
			require_once 'excel_reader.php';
			$this->data = new Spreadsheet_Excel_Reader($filename);
			$this->convertXLSTableToArray();
			$this->convertXLSTableToCompactArray();
		}
	}

	
	public function getRawData() {
		return $this->rawData;
	}	
	
	public function getData() {
		return $this->convertedData;
	}	
	
	public function getTitles() {
		return $this->convertedTitles;
	}

	
	
	/* 
		converts complete XLS table to a standard $myarray[x][y]
	*/
	private function convertXLSTableToArray() {
		for($i=1;$i<=$this->data->colcount();$i++) {
			$this->rawData[]=array();
			for($j=2;$j<=$this->data->rowcount();$j++)
				if( strlen($this->data->format($j,$i)) > 4) 
					$this->rawData[($i-1)][($j-1)] = $this->data->raw($j,$i);
				else
					$this->rawData[($i-1)][($j-1)] = $this->data->val($j,$i);
				
		}
	}	
	
	private function convertXLSTableToCompactArray() {
		// get titles
		$t=1;
		while($this->data->val(1,$t)){
			$curTitle = $this->data->val(1,$t);
			$this->convertedTitles[]= $curTitle;
			$this->convertedData[$curTitle]=array();
			$t++;
		}
		
		$y=2;
		while($this->data->val($y,1)){
			for($i=0;$i<count($this->convertedTitles);$i++) {
				if( strlen($this->data->format($y,($i+1))) > 4) 
					$this->convertedData[$this->convertedTitles[$i]][]=$this->data->raw($y,($i+1));
				else 
					$this->convertedData[$this->convertedTitles[$i]][]=$this->data->val($y,($i+1));
			}
			$y++;
		}
	}
}

?>

