<?php

namespace Fancourier\Response;

class CreateAwb extends Generic implements ResponseInterface
{
    public function setBody($body)
    {
        if (empty($body)) {
            $this->setErrorMessage("Empty response");
            $this->setErrorCode(-1);
            return $this;
        }

        $body = str_getcsv($body);
        if (count($body) == 1) {
            $this->setErrorMessage($body[0]);
            $this->setErrorCode(0);
            return $this;
        }

        if ($body[1] && !empty($body[2])) {
            parent::setBody($body[2]);
            return $this;
        }

        $message = trim(($body[2] ?? '') . (!empty($body[3]) ? " ({$body[3]})" : ""));
        $this->setErrorMessage($message);
        $this->setErrorCode(-2);

        return $this;
    }
}
