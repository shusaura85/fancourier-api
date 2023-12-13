<?php

namespace Fancourier\Objects;

class CountyExternal
{
	protected $id;
	protected $name;
	protected $code;
	protected $country;
	
	public function __construct($id, $name, $code, $country)
		{
		$this->id = $id;
		$this->name = $name;
		$this->code = $code;
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
	
	public function getCode(): string
		{
		return $this->code;
		}
	
	public function getCountry(): string
		{
		return $this->country;
		}
}
