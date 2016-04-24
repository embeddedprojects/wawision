<?php

class Billsafe_LoggerFile implements Billsafe_Logger
{
    private $_filename;
    
    
    
    public function __construct($filename)
    {
        $this->_filename = $filename;
    }
    
    
    
    public function log($message)
    {
        $message = '[' . date('Y-m-d H:i:s') . "]\r\n" . $message . "\r\n\r\n";
        
        error_log($message, 3, $this->_filename);
    }
}