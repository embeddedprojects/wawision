<?php

class ConvertMentorPads {
	
	public $data;
	public $rawdata;
	public $metadata;
	
	public function __construct($filename) {

		require_once 'excel/class.table2array.php';
		$XLSArray = new Table2Array($filename);
		$this->data = $XLSArray->getData();
		$this->rawdata = $XLSArray->getRawData();
		$this->retrieveMetadata();
	}
	
	private function retrieveMetadata() {
		$this->metadata = array();
		
		// find offsets of metadata
		$startRow = count(current($this->data))+1;
		$dataCol=1;
		while(!$this->rawdata[0][$startRow]) $startRow++;
		while(!$this->rawdata[$dataCol][$startRow]) $dataCol++;
		
		//store metadata
		while($this->rawdata[0][$startRow]) {
			$this->metadata[$this->rawdata[0][$startRow]]=$this->rawdata[$dataCol][$startRow];
			$startRow++;
		}
	}

}


?>

