<?php

namespace Fancourier\Response;

class GetRates extends Generic implements ResponseInterface
{
    public function setBody($body)
    {
        if (is_numeric($body)) {
            parent::setBody($body);
            return $this;
        }

        preg_match('/(.*?)\((\d+)\)/', $body, $matches);
        $this->setErrorMessage($matches[1]);
        $this->setErrorCode($matches[2] ?: -1);

        return $this;
    }
}
