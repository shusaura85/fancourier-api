<?php

namespace Fancourier\Objects;

class Branch
{
	protected $id;
	protected $name;
	protected $bank;
	protected $bankAccount;
	protected $email;
	protected $phone;
	protected $altPhone;
	protected $contactPerson;
	protected $addr_county;
	protected $addr_city;
	protected $addr_countyId;
	protected $addr_cityId;
	protected $addr_street;
	protected $addr_streetNo;
	protected $addr_zipcode;
	protected $addr_building;
	protected $addr_entrance;
	protected $addr_floor;
	protected $addr_apartment;
	
	public function __construct($data)
		{
		$this->id = $data['id'];
		$this->name = $data['name'];
		$this->bank = $data['bank'];
		$this->bankAccount = $data['bankAccount'];
		$this->email = $data['email'];
		$this->phone = $data['phone'];
		$this->altPhone = $data['secondaryPhone'];
		$this->contactPerson = $data['contactPerson'];
		$this->addr_county = $data['address']['county'];
		$this->addr_city = $data['address']['locality'];
		$this->addr_countyId = $data['address']['countyId'];
		$this->addr_cityId = $data['address']['localityId'];
		$this->addr_street = $data['address']['street'];
		$this->addr_streetNo = $data['address']['streetNo'];
		$this->addr_zipcode = $data['address']['zipCode'];
		$this->addr_building = $data['address']['building'];
		$this->addr_entrance = $data['address']['entrance'];
		$this->addr_floor = $data['address']['floor'];
		$this->addr_apartment = $data['address']['apartment'];
		}
	
	public function getId(): string
		{
		return $this->id;
		}
	
	public function getName(): string
		{
		return $this->name;
		}
	
	public function getBank(): string
		{
		return $this->bank;
		}
	
	public function getBankAccount(): string
		{
		return $this->bankAccount;
		}
	
	public function getEmail(): string
		{
		return $this->email;
		}
	
	public function getPhone(): string
		{
		return $this->phone;
		}
	
	public function getSecondaryPhone(): string
		{
		return $this->altPhone;
		}
	
	public function getContactPerson(): string
		{
		return $this->contactPerson;
		}
	
	public function getCounty(): string
		{
		return $this->addr_county;
		}
	
	public function getCity(): string
		{
		return $this->addr_city;
		}
	
	public function getCountyId(): string
		{
		return $this->addr_countyId;
		}
	
	public function getCityId(): string
		{
		return $this->addr_cityId;
		}
	
	public function getStreet(): string
		{
		return $this->addr_street;
		}
	
	public function getStreetNo(): string
		{
		return $this->addr_streetNo;
		}
	
	public function getPostalCode(): string
		{
		return $this->addr_zipcode;
		}
	
	public function getBuilding(): string
		{
		return $this->addr_building;
		}
	
	public function getEntrance(): string
		{
		return $this->addr_entrance;
		}
	
	public function getFloor(): string
		{
		return $this->addr_floor;
		}
	
	public function getApartment(): string
		{
		return $this->addr_apartment;
		}
	
}
