<?php


require_once 'lib/Billsafe/HttpClient.php';
require_once 'lib/Billsafe/Logger.php';
require_once 'lib/Billsafe/LoggerNull.php';

class Billsafe_Sdk
{
    const SDK_SIGNATURE = 'BillSAFE SDK (PHP) 2012-02-09';
    const SANDBOX       = 'SANDBOX';
    const LIVE          = 'LIVE';

    private $_merchantId;
    private $_merchantLicenseSandbox;
    private $_merchantLicenseLive;
    private $_applicationSignature;
    private $_applicationVersion;
    private $_isLiveMode = false;
    private $_isUtf8Mode = false;
    private $_lastResponse;
    private $_logger;

    private $_apiVersion        = '208';
    private $_apiUrlSandbox     = 'https://sandbox-nvp.billsafe.de/V{VERSION}';
    private $_apiUrlLive        = 'https://nvp.billsafe.de/V{VERSION}';

    private $_gatewayVersion    = '200';
    private $_gatewayUrlSandbox = 'https://sandbox-payment.billsafe.de/V{VERSION}';
    private $_gatewayUrlLive    = 'https://payment.billsafe.de/V{VERSION}';



    /**
     * Constructor. Optionally you may provide the path to the billsafe_ini.php file.
     * If you omit it, the default billsafe_ini.php file located in the sdk folder
     * will be used.
     * Note that you can override the credentials specified in the billsafe_ini.php file
     * by calling setCredentials().
     *
     * @param string $iniFile Path to billsafe.ini config file
     */
    public function __construct($iniFile = '')
    {
        $this->setLogger(new Billsafe_LoggerNull());
/*
        if (empty($iniFile))
        {
            $iniFile = 'billsafe_ini.php';
        }

        require($iniFile);
*/
        $this->_isLiveMode = (bool) $ini['isLiveMode'];
        $this->_isUtf8Mode = (bool) $ini['isUtf8Mode'];

        if (isset($ini['apiVersion']))
        {
            $this->_apiVersion = (int) $ini['apiVersion'];
        }

        if (isset($ini['gatewayVersion']))
        {
            $this->_gatewayVersion = (int) $ini['gatewayVersion'];
        }

 //       $this->setCredentials($ini);
    }



    /**
     * You may override the credentials defined in the billsafe_ini.php file
     * by providing an array containing the appropriate information. The
     * array may contain the following keys:
     *   - merchantId
     *   - merchantLicenseSandbox
     *   - merchantLicenseLive
     *   - applicationSignature
     *   - applicationVersion
     *
     * @param array $credentials
     */
    public function setCredentials(array $credentials)
    {
        if (!empty($credentials['merchantId']))
        {
            $this->_merchantId = (int) $credentials['merchantId'];
        }

        if (!empty($credentials['merchantLicenseSandbox']))
        {
            $this->_merchantLicenseSandbox = (string) $credentials['merchantLicenseSandbox'];
        }

        if (!empty($credentials['merchantLicenseLive']))
        {
            $this->_merchantLicenseLive = (string) $credentials['merchantLicenseLive'];
        }

        if (!empty($credentials['applicationSignature']))
        {
            $this->_applicationSignature = (string) $credentials['applicationSignature'];
        }

        if (!empty($credentials['applicationVersion']))
        {
            $this->_applicationVersion = (string) $credentials['applicationVersion'];
        }
    }



    /**
     * Override API URLs (not recommended!)
     *
     * @param array $urls
     */
    public function setApiUrls(array $urls)
    {
        if (!empty($urls['sandbox']))
        {
            $this->_apiUrlSandbox = (string) $urls['sandbox'];
        }

        if (!empty($urls['live']))
        {
            $this->_apiUrlLive = (string) $urls['live'];
        }
    }



    /**
     * Override API version (not recommended!)
     *
     * @param int $version
     */
    public function setApiVersion($version)
    {
        $this->_apiVersion = (int) $version;
    }



    /**
     * Override Gateway URLs (not recommended!)
     *
     * @param array $urls
     */
    public function setGatewayUrls(array $urls)
    {
        if (!empty($urls['sandbox']))
        {
            $this->_gatewayUrlSandbox = (string) $urls['sandbox'];
        }

        if (!empty($urls['live']))
        {
            $this->_gatewayUrlLive = (string) $urls['live'];
        }
    }



    /**
     * Override Gateway version (not recommended!)
     *
     * @param int $version
     */
    public function setGatewayVersion($version)
    {
        $this->_gatewayVersion = (int) $version;
    }



    /**
     * Returns the logger object
     *
     * @return Billsafe_Logger
     */
    public function getLogger()
    {
        return $this->_logger;
    }



    /**
     * Sets a logger object to handle verbose messages.
     * $logger may be an instance of the Billsafe_LoggerXXX classes shipped
     * with the SDK or an instance of your own logger class that implements
     * Billsafe_Logger.
     *
     * @param Billsafe_Logger $logger
     */
    public function setLogger(Billsafe_Logger $logger)
    {
        $this->_logger = $logger;
    }



    /**
     * Sets sandbox or live mode
     *
     * @param string $mode SANDBOX | LIVE
     */
    public function setMode($mode)
    {
        $this->_isLiveMode = ($mode == self::LIVE);
    }



    /**
     * Returns TRUE if live mode is enabled
     *
     * @return bool
     */
    public function isLiveMode()
    {
        return $this->_isLiveMode;
    }



    /**
     * Toggle between UTF8- and LATIN1-mode
     *
     * @param bool $isUtf8Mode
     */
    public function setUtf8Mode($isUtf8Mode = true)
    {
        $this->_isUtf8Mode = (bool) $isUtf8Mode;
    }



    /**
     * Returns TRUE if UTF8-mode is enabled
     *
     * @return bool
     */
    public function isUtf8Mode()
    {
        return $this->_isUtf8Mode;
    }



    /**
     * Invokes an API method on the BillSAFE server
     *
     * @param string $methodName
     * @param mixed $parameter May be an array or an object
     * @return stdClass
     * @throws Billsafe_Exception
     */
    public function callMethod($methodName, $parameter)
    {
        $this->_lastResponse = null;

        if (   !is_object($parameter)
            && !is_array($parameter))
        {
            throw new Billsafe_Exception('parameter must be an object or an array');
        }

        $requestString = $this->_destructurize($parameter)
                       . 'method=' . urlencode($methodName)
                       . '&format=NVP'
                       . '&merchant_id=' . urlencode($this->_merchantId)
                       . '&merchant_license=' . urlencode($this->isLiveMode() ? $this->_merchantLicenseLive : $this->_merchantLicenseSandbox)
                       . '&application_signature=' . urlencode($this->_applicationSignature)
                       . '&application_version=' . urlencode($this->_applicationVersion)
                       . '&sdkSignature=' . urlencode(self::SDK_SIGNATURE);

        $httpClient = new Billsafe_HttpClient($this->_getApiUrl());

        $httpClient->setLogger($this->getLogger());

        $response = $httpClient->post($requestString, true, 'text/plain');

        if ($response->statusCode != 200)
        {
            throw new Billsafe_Exception('invalid server response! Status code is not 200 / OK!');
        }

        $structuredResponse = $this->_structurize($response->body);

        if (!isset($structuredResponse->ack))
        {
            throw new Billsafe_Exception('invalid server response! Element "ack" not found!');
        }

        $this->_lastResponse = $structuredResponse;

        return $this->_lastResponse;
    }



    /**
     * Performs a HTTP redirect onto the BillSAFE Payment Gateway.
     * Note that you must call this method BEFORE any output has been sent
     * to the webbrowser.
     *
     * @param string $token
     * @throws Billsafe_Exception
     */
    public function redirectToPaymentGateway($token)
    {
        if (!headers_sent())
        {
            header('Location: ' . $this->_getGatewayUrl() . '?token=' . $token);
            exit;
        }
        else
        {
            throw new Billsafe_Exception('Redirect to BillSAFE Payment Gateway failed because HTTP headers have already been sent! Make sure to redirect BEFORE any output is sent to the browser!');
        }
    }



    private function _structurize($rawNvpInput)
    {
        //only the last paragraph is relevant!
        $rawNvpInput = trim(substr($rawNvpInput, strrpos($rawNvpInput, "\n")));

        $pairs     = explode('&', $rawNvpInput, 500);
        $input     = array();
        $structure = new stdClass();

        foreach ($pairs as $rawPair)
        {
            $pair = explode('=', $rawPair, 2);

            if (count($pair) == 2)
            {
                @$this->_putInStructure(explode('_', urldecode($pair[0]), 10), urldecode($pair[1]), $structure);
            }
        }

        return $structure;
    }



    private function _putInStructure(array $parts, $value, &$structure)
    {
        $part = array_shift($parts);

        if (empty($parts))
        {
            if (is_numeric($part))
            {
                $structure[$part] = $this->_applyInputEncoding($value);
            }
            else
            {
                $structure->$part = $this->_applyInputEncoding($value);
            }
        }
        else
        {
            if (is_numeric($part))
            {
                $this->_putInStructure($parts, $value, $structure[$part]);
            }
            else
            {
                $this->_putInStructure($parts, $value, $structure->$part);
            }
        }
    }



    private function _destructurize($input, $prefix = '')
    {
        if (is_bool($input))
        {
            return urlencode($prefix) . '=' . ($input ? 'TRUE' : 'FALSE') . "&";
        }
        else if (is_string($input))
        {
            return urlencode($prefix) . '=' . urlencode($this->_applyOutputEncoding($input)) . "&";
        }
        else if (is_scalar($input))
        {
            return urlencode($prefix) . '=' . urlencode($input) . "&";
        }

        if (is_object($input))
        {
            $input = get_object_vars($input);
        }

        if (is_array($input))
        {
            $returnString = '';

            foreach ($input as $key => $value)
            {
                $returnString .= $this->_destructurize($value, empty($prefix) ? $key : $prefix . '_' . $key);
            }

            return $returnString;
        }
    }



    private function _applyOutputEncoding($outgoingData)
    {
        if (   is_string($outgoingData)
            && !$this->isUtf8Mode())
        {
            return utf8_encode($outgoingData);
        }
        else
        {
            return $outgoingData;
        }
    }



    private function _applyInputEncoding($incomingData)
    {
        if (   is_string($incomingData)
            && !$this->isUtf8Mode())
        {
            return utf8_decode($incomingData);
        }
        else
        {
            return $incomingData;
        }
    }



    private function _getApiUrl()
    {
        $url = $this->isLiveMode() ? $this->_apiUrlLive : $this->_apiUrlSandbox;
        return str_replace('{VERSION}', $this->_apiVersion, $url);
    }



    private function _getGatewayUrl()
    {
        $url = $this->isLiveMode() ? $this->_gatewayUrlLive : $this->_gatewayUrlSandbox;
        return str_replace('{VERSION}', $this->_gatewayVersion, $url);
    }
}
