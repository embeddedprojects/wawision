<?php

class Billsafe_LoggerEcho implements Billsafe_Logger
{
    public function log($message)
    {
        echo $message . "\r\n\r\n";
    }
}