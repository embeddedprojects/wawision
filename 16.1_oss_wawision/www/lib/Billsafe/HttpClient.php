<?php

require_once 'HttpResponse.php';
require_once 'Exception.php';

class Billsafe_HttpClient
{
    const REQUEST_TYPE_POST = 'POST';

    private $_host     = '';
    private $_port     = 80;
    private $_path     = '/';
    private $_protocol = 'tcp://';
    private $_user     = '';
    private $_password = '';
    private $_timeout  = 10;
    private $_logger;



    /**
     * Set URL the client connects to.
     * SSL, port and authentication can be set in the URL.
     *
     * examples:
     * http://www.dummy.com/index.php
     * https://www.dummy.com/index.php
     * http://www.dummy.com:8080/index.php
     * http://user:pass@www.dummy.com/index.php
     *
     * @param string $url
     * @throws Billsafe_Exception
     */
    public function __construct($url)
    {
        $parsedUrl = parse_url($url);
        
        if (   !is_array($parsedUrl)
            || !isset($parsedUrl['host']))
        {
            throw new Billsafe_Exception('Invalid url specified');
        }

        $this->_host = $parsedUrl['host'];

        if (!empty($parsedUrl['path']))
        {
            $query = empty($parsedUrl['query']) ? '' : '?' . $parsedUrl['query'];
            $this->_path = $parsedUrl['path'] . $query;
        }

        if (!empty($parsedUrl['port']))
        {
            $this->_port = $parsedUrl['port'];
        }

        if (!empty($parsedUrl['scheme']))
        {
            switch($parsedUrl['scheme'])
            {
                case 'http':
                    if (empty($parsedUrl['port']))
                    {
                        $this->_port = 80;
                    }

                    $this->_protocol = 'tcp://';
                    break;

                case 'https':
                    if (empty($parsedUrl['port']))
                    {
                        $this->_port = 443;
                    }

                    if (function_exists('stream_get_transports'))
                    {
                        $transports = stream_get_transports();

                        if (!in_array('ssl', $transports))
                        {
                            throw new Billsafe_Exception('Missing SSL transport support in PHP');
                        }
                    }

                    $this->_protocol = 'ssl://';
                    break;
            }
        }

        if (!empty($parsedUrl['user']))
        {
            $this->_user = $parsedUrl['user'];
        }

        if (!empty($parsedUrl['pass']))
        {
            $this->_password = $parsedUrl['pass'];
        }
    }
    
    
    
    /**
     * Sets a logger object to handle verbose messages.
     *
     * @param Billsafe_Logger $logger 
     */
    public function setLogger(Billsafe_Logger $logger)
    {
        $this->_logger = $logger;
    }



    /**
     * Set client timeout in seconds
     * @param int $seconds
     */
    public function setTimeout($seconds)
    {
        $this->_timeout = (int) $seconds;
    }



    /**
     * Set port to connect to
     *
     * @param int $port
     */
    public function setPort($port)
    {
        $this->_port = (int) $port;
    }



    /**
     * Set username for authentication
     *
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->_user = $username;
    }



    /**
     * Set password for authentication
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }



    /**
     * Do POST request.
     *
     * When $raw is set to false, content will be url encoded.
     * Otherwise $content will be send as is.
     *
     * @param mixed $content
     * @param boolean $isRaw
     * @param string $contentType
     * @return Billsafe_HttpResponse
     * @throws Billsafe_Exception
     */
    public function post($content, $isRaw = true, $contentType = 'text/plain')
    {
        return $this->_doRequest(
            self::REQUEST_TYPE_POST,
            $this->_convertContentToString($content, $isRaw),
            $contentType);
    }



    /**
     * Convert $content to string
     *
     * When $raw is set to false, content will be url encoded.
     * 
     * @param mixed $content
     * @param boolean $isRaw
     * @return string
     */
    private function _convertContentToString($content, $isRaw)
    {
        if (is_array($content))
        {
            $tmp = array();

            foreach($content as $key => $value)
            {
                $tmp[] = $isRaw ? $key . '=' . $value : urlencode($key) . '=' . urlencode($value);
            }

            $content = implode('&', $tmp);
        }
        else
        {
            $content = $isRaw ? (string) $content : urlencode((string) $content);
        }

        return (string) $content;
    }



    /**
     * Send HTTP request to specified host with given content
     *
     * @param int $requestType
     * @param string $content
     * @param string $contentType
     * @return Billsafe_HttpResponse
     */
    private function _doRequest($requestType, $content, $contentType)
    {
        $header = array();

        $header[] = $requestType . ' ' . $this->_path . ' HTTP/1.1';
        $header[] = 'Host: ' . $this->_host;
        $header[] = 'Content-Type: ' . $contentType;
        $header[] = 'Content-Length: ' . strlen($content);
        $header[] = 'Accept-Encoding: identity'; //no compression yet

        if (!empty($this->_user))
        {
            $header[] = 'Authorization: Basic ' . base64_encode($this->_user . ':' . $this->_password);
        }

        $header[] = 'Connection: close';

        $header = implode("\r\n", $header);

        $connection = @fsockopen(
            $this->_protocol . $this->_host,
            $this->_port,
            $errorNumber,
            $errorString,
            $this->_timeout);

        $this->_verbose("[fsockopen] \r\n" . $this->_protocol . $this->_host . ':' . $this->_port);

        if (   !$connection
            || get_resource_type($connection) !== 'stream')
        {
            throw new Billsafe_Exception('cannot establish connection to host ' . $this->_host . ' on port ' . $this->_port);
        }

        $this->_verbose("[request header] \r\n" . $header);
        $this->_verbose("[request body] \r\n" . $content);

        if (!fwrite($connection, $header . "\r\n\r\n" . $content))
        {
            throw new Billsafe_Exception('failed to send content to host');
        }

        $rawResponse = '';

        while (!feof($connection))
        {
            $rawResponse .= fgets($connection, 4096);
        }

        fclose($connection);

        return $this->_parseResponse($rawResponse);
    }



    /**
     * Parse request response
     *
     * @param string $responceString
     * @return Billsafe_HttpResponse
     */
    private function _parseResponse($responceString)
    {
        if (empty($responceString))
        {
            throw new Billsafe_Exception('invalid response');
        }
        
        $separator = "\r\n\r\n";
        $separatorLength = strlen($separator);

        $headerEndPosition = strpos($responceString, "\r\n\r\n");

        if ($headerEndPosition === false)
        {
            throw new Billsafe_Exception('invalid response');
        }

        $header = substr($responceString, 0, $headerEndPosition);
        $this->_verbose("[response header] \r\n" . $header);

        $body = substr($responceString, $headerEndPosition + $separatorLength);

        $response = new Billsafe_HttpResponse();

        if (preg_match('#http/\d.\d (\d+) (.*)#i', $header, $match))
        {
            $response->statusCode = trim($match[1]);
            $response->statusText = trim($match[2]);
        }

        if (preg_match('#Content-Type: (.*)#i', $header, $match))
        {
            $response->contentType = trim($match[1]);
        }

        if (preg_match('#Content-Length: (.*)#i', $header, $match))
        {
            $response->contentLength = (int) trim($match[1]);
        }

        if (preg_match('#Transfer-Encoding: chunked#i', $header, $match))
        {
            $response->body = $this->_joinChunks($body);
            $response->contentLength = strlen($response->body);
        }
        else
        {
            $response->body = trim($body);
        }

        $this->_verbose("[response body] \r\n" . $response->body);

        return $response;
    }



    /**
     * Join chunked HTTP body
     *
     * @param string $body
     * @return string
     */
    private function _joinChunks($body)
    {
        if (   !is_string($body)
            || strlen($body) < 1)
        {
            throw new Billsafe_Exception('Parse error: unable to join chunks');
        }

        $eol = "\r\n";
        $eolLength = strlen($eol);

        $result = '';

        do
        {
            $body   = ltrim($body);
            $eolPos = strpos($body, $eol);

            if ($eolPos === false)
            {
                throw new Billsafe_Exception('Parse error: unable to join chunks');
            }

            $chunkLength = hexdec(substr($body, 0, $eolPos));

            if (   !is_numeric($chunkLength)
                || $chunkLength < 0)
            {
                throw new Billsafe_Exception('Parse error: unable to join chunks');
            }

            $result .= substr($body, ($eolPos + $eolLength), $chunkLength);

            $body = substr($body, ($chunkLength + $eolPos + $eolLength));
        }
        while ($chunkLength > 0);

        return $result;
    }



    private function _verbose($msg)
    {
        $this->_logger->log($msg);
    }
}