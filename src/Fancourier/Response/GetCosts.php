<?php

namespace Fancourier\Response;

class GetCosts extends Generic implements ResponseInterface
{
	protected $result;
	
    public function setData($datastr)
    {
		$response_json = json_decode($datastr, true);
		
		if (json_last_error() === JSON_ERROR_NONE)
			{
			$this->result = $response_json['data'] ?? [];
			
			if (isset($response_json['status']) && ($response_json['status'] == 'success'))
				{
				parent::setData($response_json['data']);
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
	
	public function getAllErrors(): array
		{
		return $this->result['errors'] ?? [];
		}
	
	public function getKmCost(): float
		{
		return $this->result['extraKmCost'] ?? 0;
		}
		
	public function getWeightCost(): float
		{
		return $this->result['weightCost'] ?? 0;
		}
		
	public function getInsuranceCost(): float
		{
		return $this->result['insuranceCost'] ?? 0;
		}
		
	public function getOptionsCost(): float
		{
		return $this->result['optionsCost'] ?? 0;
		}
		
	public function getFuelCost(): float
		{
		return $this->result['fuelCost'] ?? 0;
		}
		
	public function getCost(): float
		{
		return $this->result['costNoVAT'] ?? 0;
		}
		
	public function getCostVat(): float
		{
		return $this->result['vat'] ?? 0;
		}
		
	public function getCostTotal(): float
		{
		return $this->result['total'] ?? 0;
		}
}
