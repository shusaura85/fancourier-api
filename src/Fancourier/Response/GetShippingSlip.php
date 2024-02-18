<?php

namespace Fancourier\Response;

use Fancourier\Objects\ShippingSlip;

class GetShippingSlip extends Generic implements ResponseInterface
{
	protected $result;
	protected $total;		// total number of street entries
	protected $perPage;
	protected $currentPage;
	protected $totalPages;	// total page count (computed)
	
    public function setData($datastr)
    {
		$response_json = json_decode($datastr, true);
		
		if (json_last_error() === JSON_ERROR_NONE)
			{
			$this->result = [];
			
			if (isset($response_json['status']) && ($response_json['status'] == 'success'))
				{
				parent::setData($response_json['data']);
				
				$this->total = intval($response_json['total']);
				$this->perPage = intval($response_json['perPage']);
				$this->currentPage = intval($response_json['currentPage']);
				$this->totalPages = ceil($this->total / $this->perPage);
				
				foreach ($response_json['data'] as $rd)
					{
					$this->result[] = new ShippingSlip($rd);
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
	
	public function get($position) //: ShippingSlip|false
		{
		return $this->result[$position] ?? false;
		}
	
	public function getTotal(): int
		{
		return $this->total ?? 0;
		}
		
	public function getPerPage(): int
		{
		return $this->perPage ?? 0;
		}
		
	public function getCurrentPage(): int
		{
		return $this->currentPage ?? 0;
		}
		
	public function getTotalPages(): int
		{
		return $this->totalPages ?? 0;
		}

}
