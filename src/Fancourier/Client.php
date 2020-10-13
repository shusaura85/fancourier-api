<?php

namespace Fancourier;

class Client
{
    private $curl;

    private $error;

    private $useragent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0';

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function post($url, array $data)
    {
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 600);
        curl_setopt($this->curl, CURLOPT_HEADER, 0);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($this->curl);

        if (!curl_error($this->curl) && $response) {
            return $response;
        }

        $this->setError(curl_error($this->curl));
        return false;
    }

    public function setOption($option, $value)
    {
        curl_setopt($this->curl, $option, $value);
        return $this;
    }

    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }

    public function getError()
    {
        return $this->error;
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }
}
