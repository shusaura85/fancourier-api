<?php
namespace Fancourier\Response;

interface ResponseInterface
{
    public function getErrorCode();
    public function setErrorCode($errorCode);
    public function getErrorMessage();
    public function setErrorMessage($errorMessage);
    public function getBody();
    public function setBody($body);
}
