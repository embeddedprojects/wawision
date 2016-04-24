<?php

class Billsafe_LoggerNull implements Billsafe_Logger
{
    public function log($message)
    {
        //do nothing!
    }
}