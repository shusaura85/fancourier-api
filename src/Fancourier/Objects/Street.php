<?php

namespace Fancourier\Objects;

class Street
{
	protected $id;
	protected $streetName;
	protected $type;
	protected $county;
	protected $city;
	// extra details
	protected $details;
	
	public function __construct($data)
		{
		$this->id			= intval($data['id']);
		$this->streetName	= $data['street'];
		$this->type			= $data['type'];
		$this->county		= $data['county'];
		$this->city			= $data['locality'];
		
		$this->details = [];
		foreach ($data['details'] as $pos=>$details)
			{
			$this->details[ $details['zipCode'] ] = $details;
			}
		}
	
	public function getId(): string
		{
		return $this->id;
		}
	
	public function getName(): string
		{
		return $this->streetName;
		}
		
	public function getType(): string
		{
		return $this->type;
		}
	
	public function getCounty(): string
		{
		return $this->county;
		}
	
	public function getCity(): string
		{
		return $this->city;
		}
	
	public function hasZipCode($zipCode): bool
		{
		return isset($this->details[$zipCode]);
		}
	
	public function getDetails($zipCode)//: array|false
		{
		return $this->details[$zipCode] ?? false;
		}
	
	
	/* return array with data similar to fan courier api response (details keys are set to the zipcode instead of numeric) */
	public function getArray(): array
		{
		$arr = [
			'id'		=> $this->id,
			"street"	=> $this->streetName,
			"type"		=> $this->type,
			"locality"	=> $this->city,
			"county"	=> $this->county,
			"details"	=> $this->details
			];
		
		return $arr;
		}
	
}
