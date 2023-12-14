<?php

namespace Fancourier\Response;

use Fancourier\Objects\CourierOrder;

class GetCourierOrders extends Generic implements ResponseInterface
{
	protected $result;
	protected $total;		// total number of pages
	protected $perPage;
	protected $currentPage;
	
    public function setData($datastr)
    {
		$response_json = json_decode($datastr, true);
		
		if (json_last_error() === JSON_ERROR_NONE)
			{
			$this->result = [];
			
			if (isset($response_json['status']) && ($response_json['status'] == 'success'))
				{
				parent::setData($response_json);
				
				$this->total = intval($response_json['total']);
				$this->perPage = intval($response_json['perPage']);
				$this->currentPage = intval($response_json['currentPage']);
				
				foreach ($response_json['data'] as $rd)
					{
					$this->result[ $rd['info']['id'] ] = new CourierOrder($rd);
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
	
	public function get($orderId) //: CourierOrder|false
		{
		return $this->result[$orderId] ?? false;
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
	
	/*
		reports/orders api apparently doesn't follow the same response format as the other api functions as such
		the "total" field contains the total number of pages instead of total entries.
		This function is kept as an alias to the getTotal() function for consistentcy only
	*/
	public function getTotalPages(): int
		{
		return $this->getTotal();
		}
}
