<?php

namespace Fancourier\Response;

class TrackAwbBulk extends Generic implements ResponseInterface
{
    public function setBody($body)
    {
        $data = json_decode($body, true);
        if (!$data || !is_array($data)) {
            $this->setErrorMessage($body);
            $this->setErrorCode(-1);
            return $this;
        }

        parent::setBody($data);

        return $this;
    }
}
