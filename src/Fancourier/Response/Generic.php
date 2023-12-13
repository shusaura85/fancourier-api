<?php

namespace Fancourier\Response;

class Generic implements ResponseInterface
{
    protected $errorCode;
    protected $errorMessage;
    protected $data;

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param mixed $errorCode
     * @return Generic
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     * @return Generic
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return Generic
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function isOk()
    {
        return empty($this->getErrorCode()) && empty($this->getErrorMessage());
    }
}
