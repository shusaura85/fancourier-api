<?php

namespace Fancourier\Objects;

class CityExternal
{
	protected $id;
	protected $name;
	protected $county;
	protected $country;
	
	public function __construct($id, $name, $county, $country)
		{
		$this->id = $id;
		$this->name = $name;
		$this->county = $county;
		$this->country = $country;
		}
	
	public function getId(): string
		{
		return $this->id;
		}
	
	public function getName(): string
		{
		return $this->name;
		}
	
	public function getCounty(): string
		{
		return $this->county;
		}
	
	public function getCountry(): string
		{
		return $this->country;
		}
}
