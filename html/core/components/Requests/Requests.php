<?php

namespace core\components\Requests;

class Requests
{
    protected static $instance = null;

    public static function Instance()
    {
        if ( null === self::$instance )
        {
            self::$instance = new self ();
        }

        return self::$instance;
    }

    public static function resetInstance()
    {
        self::$instance = null;
    }

    public function getPost( $key = null, $default = null )
    {
        if ( $key == null )
        {
            return $_POST;
        }

        return (isset($_POST[$key])) ? $_POST[$key] : $default;
    }

    public function getGet( $key = null, $default = null )
    {
        if ( $key == null )
        {
            return $_GET;
        }

        return (isset($_GET[$key])) ? $_GET[$key] : $default;
    }

    public function getRequest( $key = null, $default = null )
    {
        if ( $key == null )
        {
            return $_REQUEST;
        }

        return (isset($_REQUEST[$key])) ? $_REQUEST[$key] : $default;
    }

    public function getServer( $key = null, $default = null )
    {
        if ( $key == null )
        {
            return $_SERVER;
        }

        return (isset($_SERVER[$key])) ? $_SERVER[$key] : $default;
    }

    public function getCookie( $key = null, $default = null )
    {
        if ( $key == null )
        {
            return $_COOKIE;
        }

        return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : $default;
    }

    public function getSession( $key = null, $default = null )
    {
        if ( $key == null )
        {
            return $_SESSION['silenser'];
        }

        return (isset($_SESSION['silenser'][$key])) ? $_SESSION['silenser'][$key]
            : $default;
    }

    public function setSession( $insertData )
    {
        foreach ($insertData as $key => $value ) {
            $_SESSION['silenser'][$key] = $value;
        }
    }

    public function isPost()
    {
        if ( $this->_getMethod() == 'POST' )
        {
            return true;
        }

        return false;
    }

    public function isGet()
    {
        if ( $this->_getMethod() == 'GET' )
        {
            return true;
        }

        return false;
    }

    public function isXmlHttpRequest()
    {
        return ($this->getHeader('X_REQUESTED_WITH') == 'XMLHttpRequest');
    }

    public function getHeader( $header )
    {
        if ( !empty($header) )
        {
            $temp = 'HTTP_' . strtoupper(str_replace('-', '_', $header));

            if ( isset($_SERVER[$temp]) )
            {
                return $_SERVER[$temp];
            }

            if ( function_exists('apache_request_headers') )
            {
                $headers = apache_request_headers();
                if ( isset($headers[$header]) )
                {
                    return $headers[$header];
                }
                $header = strtolower($header);
                foreach ( $headers as $key => $value )
                {
                    if ( strtolower($key) == $header )
                    {
                        return $value;
                    }
                }
            }
        }

        return false;
    }

    public function Redirect( $targetUrl, $refreshTime = 0 )
    {
        $sendStatus = headers_sent($file, $line);

        if ( $sendStatus )
        {
            $message = sprintf('Cannot send headers; headers already sent in %s, line %d',
                $file, $line
            );

            die($message);
        }

        $redirect = sprintf('Refresh: %d; URL=%s', $refreshTime, $targetUrl);
        header($redirect);
        exit();
    }

    private function _getMethod()
    {
        return $this->getServer('REQUEST_METHOD');
    }
}