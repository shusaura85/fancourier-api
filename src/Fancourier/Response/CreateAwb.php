<?php

namespace Fancourier\Response;

use \Fancourier\Objects\AwbIntern;

class CreateAwb extends Generic implements ResponseInterface
{
	protected $result;
	protected $awbList;
	
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
			
			if (isset($response_json['response']))
				{
				parent::setData($response_json['response']);
/*
{
"response": [
		{
			"awbNumber":2332300120218,
			"tariff":30.53,
			"packages":1,
			"letter":"B",
			"routingCode":"0200",
			"office":"Bucuresti",
			"visualCode":"02-01-01",
			"errors":null
		},
		{
			"awbNumber":2332300120219,
			"tariff":32.71,
			"packages":1,
			"letter":"B",
			"routingCode":"0200",
			"office":"Bucuresti",
			"visualCode":"02-01-01",
			"errors":null
		}
	]
}

{"response":[
{
	"awbNumber":null,
	"success":false,
	"errors": {
			"info.parcels":"At least one envelope or parcel is required"
			}
},


*/
				
				foreach ($response_json['response'] as $result)
					{
					$this->result[] = $result;
					}
				
				// update awbs
				foreach ($this->result as $idx=>$result)
					{
					$this->awbList[ $idx ]->setResult($result);
					}

				}
			else
				{
				$this->setErrorMessage($response_json['message'] ?? $response_json['errors'] ?? 'Unknown error');
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
	
	/*
	* @param array[AwbIntern] $awbList
	*/
	public function setAwbList(array $awbList)
		{
		// check list
		foreach ($awbList as $awb)
			{
			if (!($awb instanceof AwbIntern))
				{
				return false;
				}
			}
		
		$this->awbList = $awbList;
		return true;
		}
	
	public function getAll(): array
		{
		if (empty($this->result))
			{
			return [];
			}
		
		return $this->awbList;
		}
	
}
