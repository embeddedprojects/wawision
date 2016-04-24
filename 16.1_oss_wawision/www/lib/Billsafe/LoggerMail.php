<?php

class Billsafe_LoggerMail implements Billsafe_Logger
{
    private $_email;
    private $_log = '';
    
    
    
    public function __construct($email)
    {
        $this->_email = $email;
    }
    
    
    
    public function __destruct()
    {
        if (!empty($this->_log))
        {
            @mail($this->_email, 'BillSAFE SDK Verbose Log', $this->_log);
        }
    }
    
    
    
    public function log($message)
    {
        $this->_log .= '[' . date('Y-m-d H:i:s') . "]\r\n" . $message . "\r\n\r\n";
    }
}