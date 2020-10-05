<?php

namespace Fancourier\Response;

class GetCities extends Generic implements ResponseInterface
{
    public function setBody($body)
    {
        if (empty($body)) {
            $this->setErrorMessage("Empty response");
            $this->setErrorCode(-1);
            return $this;
        }

        $body = str_replace("\r\n", "\n", $body);
        $body = str_replace("\r", "\n", $body);
        $body = explode("\n", $body);
        $body = array_filter($body);

        $keys = $data = [];
        $header = str_getcsv($body[0]);
        unset($body[0]);

        foreach ($header as $item) {
            $keys[] = trim(preg_replace("/[^a-z0-9]+/", '_', strtolower($item)), '_');
        }

        foreach ($body as $item) {
            $item = str_getcsv($item);
            $row = [];
            foreach ($keys as $i => $key) {
                $row[$key] = $item[$i] ?? null;
            }

            $data[] = $row;
        }


        parent::setBody($data);

        return $this;
    }
}
