<?php

namespace Fancourier\Response;

use \Fancourier\Objects\AwbExtern;

class CreateAwbExternal extends Generic implements ResponseInterface
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
			
			if (count($response_json) > 0)
				{
				parent::setData($response_json);
/*
Array
(
    [0] => Array
        (
            [awbNumber] => 2338300120330
            [errors] => 
        )

)
*/
				foreach ($response_json as $result)
					{
					$this->result[] = $result;
					}
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
	
	/*
	* @param array[AwbIntern] $awbList
	*/
	public function setAwbList(array $awbList)
		{
		// check list
		foreach ($awbList as $awb)
			{
			if (!($awb instanceof AwbExtern))
				{
				return false;
				}
			}
		
		$this->awbList = $awbList;
		return true;
		}
	
	public function getAll(): array
		{
		//print_r($this->result);
		if (empty($this->result))
			{
			return [];
			}
		
		foreach ($this->result as $idx=>$result)
			{
			$this->awbList[ $idx ]->setResult($result);
			}
		
		return $this->awbList;
		}
	
}
