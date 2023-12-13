<?php

namespace Fancourier\Response;


class CreateCourierOrder extends Generic implements ResponseInterface
{
	protected $result;
	
    public function setData($datastr)
    {
		try {
			$response_json = json_decode($datastr, true);
			}
		catch (\TypeError $e)
			{ }
		
		if (json_last_error() === JSON_ERROR_NONE)
			{
			$this->result = [];
			
			if (isset($response_json['status']) && ($response_json['status'] == 'success'))
				{
				parent::setData($response_json['data']['id']);
				}
			else
				{
				$this->setErrorMessage($response_json['message']);
				$this->setErrorCode(-1);
				}
			}
		else
			{
			$this->setErrorMessage($datastr);
			$this->setErrorCode(-1);
			}


        return $this;
    }
	
}
