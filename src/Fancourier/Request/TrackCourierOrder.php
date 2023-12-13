<?php

namespace Fancourier\Request;

use Fancourier\Response\TrackCourierOrder as TrackCourierOrderResponse;

/**
 * Class TrackCourierOrder
 * @package Fancourier\Request
 * @SuppressWarnings(PHPMD)
 */
class TrackCourierOrder extends AbstractRequest implements RequestInterface
{
	protected $gateway = 'reports/orders/tracking';
	protected $method = 'GET';
	
	protected $orderList = [];
	protected $language = '';

    public function __construct()
    {
        parent::__construct();
        $this->response = new TrackCourierOrderResponse();
    }

    public function pack()
    {
		$arr = [
				"clientId" => $this->auth->getClientId(), //obligatoriu 
				"orderId" => [] // shipments
				
			];
		
		foreach ($this->orderList as $order)
			{
			$arr['orderId'][] = $order;
			}
		
		if ($this->language != '')
			{
			$arr['language'] = $this->language;
			}
		
		return $arr;
	
    }
	
	public function addOrder(string $order)
	{
		$this->orderList[] = $order;
		return $this;
	}
	
	public function setOrder(string $order)
	{
		return $this->addOrder($order);
	}
	
	public function resetOrders()
	{
		$this->orderList = [];
		return $this;
	}

    /**
     * @return string
     */
	public function getLanguage()
	{
		return $this->language ?? '';
	}
	
    /**
     * @param string $language
     * @return TrackAwb
     */
    public function setLanguage($language)
    {
		$language = trim(strtolower($language));
		if (in_array($language, ['ro', 'en']))
			{
			$this->language = $language;
			}
        return $this;
    }


}
