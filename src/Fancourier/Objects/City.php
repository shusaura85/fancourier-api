<?php

namespace Fancourier\Objects;

class City
{
	protected $id;
	protected $name;
	protected $county;
	protected $agency;
	protected $extKm;
	
	public function __construct($id, $name, $county, $agency, $extKm)
		{
		$this->id = $id;
		$this->name = $name;
		$this->county = $county;
		$this->agency = $agency;
		$this->extKm = $extKm;
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
	
	public function getAgency(): string
		{
		return $this->agency;
		}
	
	public function getExtKm(): float
		{
		return $this->extKm;
		}
}
