<?php

namespace Fancourier\Response;

class DeleteAwb extends Generic implements ResponseInterface
{
    public function setBody($body)
    {
        if (empty($body)) {
            $this->setErrorMessage("Empty response");
            $this->setErrorCode(-1);
            return $this;
        }

        if (preg_match('/(.*?) DELETED/', $body)) {
            parent::setBody(true);
            return $this;
        }

        $this->setErrorMessage($body);
        $this->setErrorCode(-2);
        return $this;
    }
}
