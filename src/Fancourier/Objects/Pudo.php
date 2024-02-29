<?php

namespace Fancourier\Objects;

class Pudo
{
	protected $id;
	protected $name;
	protected $routingLocation;
	protected $description;
	protected $latitude;
	protected $longitude;
	
	protected $address;
	
	protected $schedule;
	protected $drawer;
	
	protected $phones;	// array
	protected $email;
	
	public function __construct($data)
		{
		$this->id				= $data['id'] ?? '';
		$this->name				= $data['name'] ?? '';
		$this->routingLocation	= $data['routingLocation'] ?? '';
		$this->description		= $data['description'] ?? '';
		
		$this->address			= $data['address'] ?? [];
		
		$this->latitude			= $data['latitude'] ?? '';
		$this->longitude		= $data['longitude'] ?? '';
		
		$this->schedule			= $data['schedule'] ?? [];
		$this->drawer			= $data['drawer'] ?? [];
		
		$this->phones			= $data['phones'] ?? [];
		
		$this->email			= $data['email'] ?? '';
		}
	
	public function getId(): string
		{
		return $this->id;
		}
	
	public function getName(): string
		{
		return $this->name ?? '';
		}
		
	public function getRoutingLocation(): string
		{
		return $this->routingLocation ?? '';
		}
	
	public function getDescription(): string
		{
		return $this->description ?? '';
		}
	
	public function getLatitude(): string
		{
		return $this->latitude ?? '';
		}
	
	public function getLongitude(): string
		{
		return $this->longitude ?? '';
		}
	
	public function getAddress(): array
		{
		return $this->address ?? '';
		}
	
	public function getSchedule() //: array|string
		{
		return $this->schedule ?? '';
		}
	
	public function getDrawer() //: array|string
		{
		return $this->drawer ?? '';
		}
	
	public function getPhones() //: array|string
		{
		return $this->phones ?? '';
		}
	
	public function getEmail(): string
		{
		return $this->email ?? '';
		}
	
	
	
	/* return array with data similar to fan courier api response */
	public function getArray(): array
		{
		$arr = [
			"id"				=> $this->id,
			"name"				=> $this->name,
			"routingLocation"	=> $this->routingLocation,
			"description"		=> $this->description,
			"latitude"			=> $this->latitude,
			"longitude"			=> $this->longitude,
			"address"			=> $this->address,
			"schedule"			=> $this->schedule,
			"drawer"			=> $this->drawer,
			"phones"			=> $this->phones,
			"email"				=> $this->email,
			];
		
		return $arr;
		}
	
}
