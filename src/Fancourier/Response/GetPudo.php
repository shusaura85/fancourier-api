<?php

namespace Fancourier\Response;

use Fancourier\Objects\Pudo;

class GetPudo extends Generic implements ResponseInterface
{
	protected $result;
	
    public function setData($datastr)
    {
		$response_json = json_decode($datastr, true);
		
		if (json_last_error() === JSON_ERROR_NONE)
			{
			$this->result = [];
			
			if (isset($response_json['status']) && ($response_json['status'] == 'success'))
				{
				parent::setData($response_json);
				
				foreach ($response_json['data'] as $rd)
					{
					$this->result[ $rd['id'] ] = new Pudo($rd);
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
	
	public function getAll(): array
		{
		return $this->result ?? [];
		}
	
	public function get($pudoId = null) //: Pudo|false
		{
		if (is_null($pudoId))
			{
			if ( count($this->result) == 1)
				{
				return $this->result[ array_key_first($this->result) ];
				}
			}
		else
			{
			if ( count($this->result) > 0)
				{
				return $this->result[ $pudoId ] ?? false;
				}
			}
		
		return false;
		}
	
}
