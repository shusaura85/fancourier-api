<?php

namespace Fancourier\Response;

use \Fancourier\Objects\AwbInternRetur;

class CreateAwbRetur extends Generic implements ResponseInterface
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
	* @param array[AwbInternRetur] $awbList
	*/
	public function setAwbList(array $awbList)
		{
		// check list
		foreach ($awbList as $awb)
			{
			if (!($awb instanceof AwbInternRetur))
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
