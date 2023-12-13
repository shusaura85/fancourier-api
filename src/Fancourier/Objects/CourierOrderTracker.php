<?php

namespace Fancourier\Objects;

class CourierOrderTracker
{
	protected $orderId;
	protected $orderNumber;
	
	protected $message;
	
	protected $events;
	
	public function __construct($data)
		{
		$this->orderId = $data['orderId'];
		$this->orderNumber = $data['orderNumber'] ?? '';
		
		$this->message = $data['message'] ?? '';
		
		$this->events = $data['events'] ?? [];
		}
	
	public function getOrderId(): string
		{
		return $this->orderId ?? '';
		}
	
	public function getOrderNo(): string
		{
		return $this->orderNumber ?? '';
		}

	public function getMessage(): string
		{
		return $this->message ?? '';
		}
	
	public function getEvents(): Array
		{
		return $this->events ?? [];
		}

	public function getStatus(): array
		{
		if (count($this->events) > 0)
			{
			$last = array_key_last($this->events);
			return $this->events[$last];
			}
		
		return [
				'id'	=>	null,
				'name'	=>	$this->message ?? '',
				'date'	=> date("Y-m-d H:i:s")
				];
		}

}
