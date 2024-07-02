<?php

namespace Fancourier\Response;

class PrintAwb extends Generic implements ResponseInterface
{
    public function setData($datastr)
    {
		$response_json = json_decode($datastr, true);
		
		if (json_last_error() === JSON_ERROR_NONE)
			{
			// we received a json string from the api
			
			if (isset($response_json['status']) && in_array($response_json['status'], ['fail','error']))
				{
				$this->setErrorMessage($response_json['message']);
				$this->setErrorCode($response_json['status']);
				}
			else
				{
				$this->setErrorMessage($datastr);
				$this->setErrorCode(-1);
				}
			}
		else
			{
			// not a json
			parent::setData($datastr);
			}

        return $this;
    }

}
