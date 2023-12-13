<?php

namespace Fancourier\Request;

use Fancourier\Response\CreateCourierOrder as CreateCourierOrderResponse;

/**
 * Class CreateCourierOrder
 * @package Fancourier\Request
 * @SuppressWarnings(PHPMD)
 */
class CreateCourierOrder extends AbstractRequest implements RequestInterface
{
	protected $gateway = 'order';
	protected $method = 'POST';
	
	protected $awbNumber = '';
	protected $parcels = 0;
	protected $envelopes = 0;
	
	protected $weight = 1; // kg
	protected $width = 0; // cm
	protected $length = 0; // cm
	protected $height = 0; // cm
	
	protected $orderType = 'Standard';
	
	protected $pickupDate = ''; // YYYY-mm-dd
	protected $pickupHours = []; // ['min', 'max'] => pickupHours.first, pickupHours.second
	
	protected $notes = '';										// info.observations
	
    protected $name = null;										// info.recipient.name
    protected $contactPerson = '';								// info.recipient.contactPerson
    protected $phone = '';										// info.recipient.phone
    protected $altPhone = '';									// info.recipient.secondaryPhone
    protected $email = '';									// info.recipient.email
	
    protected $county = ''; 									// info.recipient.address.county
    protected $city = ''; // locality							// info.recipient.address.locality
    protected $street = '';										// info.recipient.address.street
    protected $number = '';									// info.recipient.address.streetNo
	
    protected $postalCode = '';								// info.recipient.address.zipcode
	
    protected $building = '';								// info.recipient.address.building
    protected $entrance = '';								// info.recipient.address.entrance
    protected $floor = '';									// info.recipient.address.floor
    protected $apartment = '';								// info.recipient.address.apartment
	
	
	
    public function __construct()
    {
        parent::__construct();
        $this->response = new CreateCourierOrderResponse();
    }

    public function pack()
    {
		$arr = [
				"clientId" => $this->auth->getClientId(), //obligatoriu 
				"info" => [
							'awbnumber'	=> $this->awbNumber,
							'packages'	=> [
											'parcel'	=> $this->parcels,
											'envelope'	=> $this->envelopes
											],
							'weight'		=> $this->weight,
							'dimensions'	=> [
												'width' => $this->width,
												'length' => $this->length,
												'height' => $this->height
												],
							'orderType'	=> $this->orderType,
							'pickupDate'	=> $this->pickupDate,
							'pickupHours'	=> [
												'first' => $this->pickupHours['min'],
												'second' => $this->pickupHours['max'],
												],
							'observations' => $this->notes,
							]
			];
			
			if (strtolower($this->orderType) != 'standard')
				{
				// doar pt orderType = 'Express Loco ...'
				$arr["recipient"] = [ //obligatoriu
						"name" => $this->name, 
						"contactPerson" => $this->contactPerson, // obligatoriu
						"phone" => $this->phone,
						"secondaryPhone" => $this->altPhone, // optional
						"email" => $this->email, 
						"address" => [ //obligatoriu
								"county" => $this->county, // {{url}}/counties 
								"locality" => $this->city, // {{url}}/localities 
								"street" => $this->street, // {{url}}/streets 
								"streetNo" => $this->number, 
								"zipCode" => $this->postalCode,
								"building" => $this->building, 
								"entrance" => $this->entrance, 
								"floor" => $this->floor, 
								"apartment" => $this->apartment,
								//"country" => "Romania" // optional
								] 
						];
				}
		
		return $arr;
	
    }
	
	public function getAwb($awbNo)
	{
		return $this->awbNumber;
	}
	
	public function setAwb($awbNo)
	{
		$this->awbNumber = $awbNo;
		return $this;
	}
	
    /**
     * @return int
     */
    public function getEnvelopes()
    {
        return $this->envelopes;
    }

    /**
     * @param int $envelopes
     * @return CreateCourierOrder
     */
    public function setEnvelopes($envelopes)
    {
        $this->envelopes = $envelopes;
        return $this;
    }

    /**
     * @return int
     */
    public function getParcels()
    {
        return $this->parcels;
    }

    /**
     * @param int $parcels
     * @return CreateCourierOrder
     */
    public function setParcels($parcels)
    {
        $this->parcels = $parcels;
        return $this;
    }

    /**
     * @return float (kg)
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight (in kg)
     * @return CreateCourierOrder
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSizes()
    {
        return [
			'length' => $this->length,
			'height' => $this->height,
			'width' => $this->width,
			];
    }

    /**
     * @param float $length
     * @return CreateCourierOrder
     */
    public function setSizes($length_cm, $height_cm, $width_cm)
    {
		if ( ($length_cm > 0) && ($height_cm > 0) && ($width_cm > 0) )
			{
			$this->length = $length_cm;
			$this->height = $height_cm;
			$this->width = $width_cm;
			
			return $this;
			}
		
		throw new \Exception("You can't set sizes to 0 or lower");
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return CreateCourierOrder
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return CreateCourierOrder
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return CreateCourierOrder
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * @param string $orderType
     * @return CreateCourierOrder
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;
        return $this;
    }

     /**
     * @return mixed
     */
    public function getPickupDate()
    {
        return $this->notes;
    }

    /**
     * @param mixed $date
     * @return CreateCourierOrder
     */
    public function setPickupDate($date)
    {
        $this->pickupDate = $date;
        return $this;
    }

     /**
     * @return mixed
     */
    public function getPickupHours(): array
    {
        return $this->pickupHours;
    }

    /**
     * @param mixed $firstHour
     * @param mixed $lastHour
     * @return CreateCourierOrder
     */
    public function setPickupHours($firstHour, $lastHour)
    {
        $this->pickupHours = [
							'min' => $firstHour,
							'max' => $lastHour
							];
        return $this;
    }

     /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     * @return CreateCourierOrder
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

	/**
     * @return mixed
     */
    public function getRecipientName()
    {
        return $this->name;
    }

    /**
     * @param mixed $recipient
     * @return CreateCourierOrder
     */
    public function setRecipientName($recipient)
    {
        $this->name = $recipient;
        return $this;
    }

   /**
     * @return mixed
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * @param mixed $contactPerson
     * @return CreateCourierOrder
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return CreateCourierOrder
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getAltPhone()
    {
        return $this->altPhone;
    }

    /**
     * @param mixed $phone
     * @return CreateCourierOrder
     */
    public function setAltPhone($phone)
    {
        $this->altPhone = $phone;
        return $this;
    }


    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return CreateCourierOrder
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * @param mixed $county
     * @return CreateCourierOrder
     */
    public function setCounty($county)
    {
        $this->county = $county;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return CreateCourierOrder
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     * @return CreateCourierOrder
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return CreateCourierOrder
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     * @return CreateCourierOrder
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param string $building
     * @return CreateCourierOrder
     */
    public function setBuilding($building)
    {
        $this->building = $building;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntrance()
    {
        return $this->entrance;
    }

    /**
     * @param string $entrance
     * @return CreateCourierOrder
     */
    public function setEntrance($entrance)
    {
        $this->entrance = $entrance;
        return $this;
    }

    /**
     * @return string
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param string $floor
     * @return CreateCourierOrder
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
        return $this;
    }

    /**
     * @return string
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * @param string $apartment
     * @return CreateCourierOrder
     */
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;
        return $this;
    }
	


}
