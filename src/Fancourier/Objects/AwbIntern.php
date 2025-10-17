<?php

namespace Fancourier\Objects;

use \Fancourier\Request\CreateAwb;

class AwbIntern
{
	// response fields only
	protected $awb;
	protected $details;
	protected $errors;
	protected $hasErrors = false;
	
    protected $service = 'Standard';			// info.service
    protected $bank = '';	// optional						// info.bank
    protected $iban = '';	// optional						// info.bankAccount
    protected $envelopes = 0;	// optional if parcels set	// info.packages.envelope
    protected $parcels = 0;	// optional if envelopes set	// info.packages.parcel
    protected $weight = 0;									// info.weight
	protected $CoD = '';	// cash on delivery, optional			// info.cod
	protected $currency = 'RON';								// info.currency (apare doar in borderou in documentatie, nu stiu daca afecteaza crearea de awb)
    protected $declaredValue = 0;								// info.declaredValue
    protected $paymentType = CreateAwb::TYPE_RECIPIENT;			// info.payment
    protected $refund = '';	// refund payment			// info.refund
    protected $returnPayment = CreateAwb::TYPE_SENDER; //refund	// info.returnPayment
    protected $notes = '';		// observation					// info.observation
    protected $contents = '';									// info.content
	
    protected $height = 0; // cm							// info.dimensions.length
    protected $length = 0; // cm							// info.dimensions.height
    protected $width = 0; // cm								// info.dimensions.width
	
	protected $costCenter = '';	// optional					// info.costCenter
    protected $options = [];	// optional					// info.options
	protected $uitCode = '';	// optional					// info uitCode
	
    protected $name = '';										// info.recipient.name
    protected $contactPerson = '';								// info.recipient.contactPerson
    protected $phone = '';										// info.recipient.phone
    protected $altPhone = '';									// info.recipient.secondaryPhone
    protected $email = '';									// info.recipient.email
	
    protected $county = ''; 									// info.recipient.address.county
    protected $city = ''; // locality							// info.recipient.address.locality
    protected $street = '';										// info.recipient.address.street
    protected $number = '';									// info.recipient.address.streetNo
	
    protected $pickupLocationId = '';	// ONLY FOR PUDO		// info.recipient.address.pickupLocationId
    protected $dropOffLocationId = ''; // ONLY FOR PUDO		// info.sender.address.dropOffLocationId

    protected $postalCode = '';								// info.recipient.address.zipcode
	
    protected $building = '';								// info.recipient.address.building
    protected $entrance = '';								// info.recipient.address.entrance
    protected $floor = '';									// info.recipient.address.floor
    protected $apartment = '';								// info.recipient.address.apartment

    protected $senderName = '';
    protected $senderContactPerson = '';
    protected $senderPhone = '';
    protected $senderAltPhone = '';
    protected $senderEmail = '';

    protected $senderCounty = ''; // county							// info.sender.address.county
    protected $senderCity = ''; // locality							// info.sender.address.locality
    protected $senderStreet = '';										// info.sender.address.street
    protected $senderNumber = '';									// info.sender.address.streetNo
	protected $senderPostalCode = '';								// info.sender.address.zipcode
    protected $senderBuilding = '';								// info.sender.address.building
    protected $senderEntrance = '';								// info.sender.address.entrance
    protected $senderFloor = '';									// info.sender.address.floor
    protected $senderApartment = '';								// info.sender.address.apartment
	
	public function __construct()
		{
		}
	
/*	public function isValid(): bool
		{
		return false;
		}
*/
	public function pack(): array
		{
		
		$arr = [
			"info" => [
					"service" => $this->service, //obligatoriu; {{url}}/services 
					"bank" => $this->bank, //optional 
					"bankAccount" => $this->iban, //optional 
					"packages" => [
								"parcel" => $this->parcels,
								"envelope" => $this->envelopes
								], 
					"weight" => $this->weight, //obligatoriu 
					"cod" => $this->CoD, //optional 
					"currency" => $this->currency, //optional 
					"declaredValue" => $this->declaredValue, //optional 
					"payment" => $this->paymentType, //obligatoriu 
					"refund" => $this->refund, //optional 
					"returnPayment" => $this->returnPayment, //optional 
					"observation" => $this->notes, //optional 
					"content" => $this->contents, //optional 
					"dimensions" => [
								"length" => $this->length,
								"height" => $this->height,
								"width" => $this->width
								], 
					"costCenter" => $this->costCenter, //optional 
					"options" => $this->options,
					"uitCode" => $this->uitCode 
				], 
			"recipient" => [ //obligatoriu
						"name" => $this->name, 
						"contactPerson" => $this->contactPerson, // obligatoriu
						"phone" => $this->phone,
						"secondaryPhone" => $this->altPhone, // optional
						"email" => $this->email, 
						"address" => [ //obligatoriu
								"county" => $this->county, // {{url}}/counties 
								"locality" => $this->city, // {{url}}/localities 
								"street" => $this->street, // {{url}}/streets 
								"streetNo" => strval($this->number), 	// API demands this to be a string
								"pickupLocationId" => $this->pickupLocationId,//doar pentru FANbox - {{url}}/pickup-points 
								"zipCode" => $this->postalCode,
								
								"building" => $this->building, 
								"entrance" => $this->entrance, 
								"floor" => $this->floor, 
								"apartment" => $this->apartment,
								//"country" => "Romania" // optional
								] 
                        ],
            "sender" => [
                "address" => [
                    "dropOffLocationId" => $this->dropOffLocationId
                ]
            ]
        ];
		
		if ( ($this->senderName != '') || ($this->senderContactPerson != '') )
			{
			$arr["sender"] = [
						"name" => $this->senderName, 
						"contactPerson" => $this->senderContactPerson,
						"phone" => $this->senderPhone,
						"secondaryPhone" => $this->senderAltPhone, // optional
						"email" => $this->senderEmail, 
						"address" => [ //obligatoriu
								"county" => $this->senderCounty, // {{url}}/counties 
								"locality" => $this->senderCity, // {{url}}/localities 
								"street" => $this->senderStreet, // {{url}}/streets 
								"streetNo" => strval($this->senderNumber), 	// API demands this to be a string
								"dropOffLocationId" => $this->dropOffLocationId, //doar pentru FANbox - {{url}}/pickup-points 
								"zipCode" => $this->senderPostalCode,
								
								"building" => $this->senderBuilding, 
								"entrance" => $this->senderEntrance, 
								"floor" => $this->senderFloor, 
								"apartment" => $this->senderApartment,
								//"country" => "Romania" // optional
								] 
                        ];
			}
		
		return $arr;
		}


    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param string $service
     * @return AwbIntern
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * @param string $bank
     * @return AwbIntern
     */
    public function setBank($bank)
    {
        $this->bank = $bank;
        return $this;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     * @return AwbIntern
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }
	
    /**
     * @return mixed
     */
    public function getReimbursement()
    {
        return $this->CoD;
    }

    /**
     * @param mixed $cashondelivery
     * @return AwbIntern
     */
    public function setReimbursement($cashondelivery)
    {
        $this->CoD = $cashondelivery;
        return $this;
    }
	
    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     * @return AwbIntern
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }
	
    /**
     * @return mixed
     */
    public function getDeclaredValue()
    {
        return $this->declaredValue;
    }

    /**
     * @param mixed $declaredValue
     * @return AwbIntern
     */
    public function setDeclaredValue($declaredValue)
    {
        $this->declaredValue = $declaredValue;
        return $this;
    }
	
    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     * @return AwbIntern
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * @param mixed $refund
     * @return AwbIntern
     */
    public function setRefund($refund)
    {
        $this->refund = $refund;
        return $this;
    }

    /**
     * @return string
     */
    public function getReturnPayment()
    {
        return $this->returnPayment;
    }

    /**
     * @param string $reimbursementPaymentType
     * @return AwbIntern
     */
    public function setReturnPayment($reimbursementPaymentType)
    {
        $this->returnPayment = $reimbursementPaymentType;
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
     * @return AwbIntern
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @param mixed $contents
     * @return AwbIntern
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCostCenter()
    {
        return $this->costCenter;
    }

    /**
     * @param mixed $costCenter
     * @return AwbIntern
     */
    public function setCostCenter($costCenter)
    {
        $this->costCenter = $costCenter;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
	 * Replace all options with string containing options
     * @param string $options
     * @return GetCosts
     */
    public function setOptions($options)
    {
        $this->options = str_split($options);
        return $this;
    }

    /**
	 * Add a single option letter
     * @param string $option
     * @return $this
     */
    public function addOption($option)
    {
		if (strlen ($option) == 1)
			{
			$this->options[] = strtoupper($option);
			}
        return $this;
    }

    /**
	 * Clear all set options
     * @return $this
     */
    public function resetOptions()
    {
        $this->options = [];
        return $this;
    }

	/**
     * @return string
     */
    public function getUitCode()
    {
        return $this->uitCode;
    }

    /**
     * @param mixed $uitCode
     * @return AwbIntern
     */
    public function setUitCode($uitCode)
    {
        $this->uitCode = $uitCode;
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

   /**
     * @return string
     */
    public function getPickupLocation()
    {
        return $this->pickupLocationId;
    }

    /**
     * @param string $pudoId
     * @return AwbIntern
     */
    public function setPickupLocation($pudoId)
    {
        $this->pickupLocationId = $pudoId;
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
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
     * @return AwbIntern
     */
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;
        return $this;
    }

   /**
     * @return string
     */
    public function getDropOffLocation()
    {
        return $this->dropOffLocationId;
    }

    /**
     * @param string $pudoId
     * @return AwbIntern
     */
    public function setDropOffLocation($pudoId)
    {
        $this->dropOffLocationId = $pudoId;
        return $this;
    }


	/******
	SENDER
	*******/


	/**
     * @return mixed
     */
    public function getSenderName()
    {
        return $this->senderName;
    }

    /**
     * @param mixed $Sender
     * @return AwbExtern
     */
    public function setSenderName($sender)
    {
        $this->senderName = $sender;
        return $this;
    }

   /**
     * @return mixed
     */
    public function getSenderContactPerson()
    {
        return $this->senderContactPerson;
    }

    /**
     * @param mixed $contactPerson
     * @return AwbExtern
     */
    public function setSenderContactPerson($contactPerson)
    {
        $this->senderContactPerson = $contactPerson;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenderPhone()
    {
        return $this->senderPhone;
    }

    /**
     * @param mixed $phone
     * @return AwbExtern
     */
    public function setSenderPhone($phone)
    {
        $this->senderPhone = $phone;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getSenderAltPhone()
    {
        return $this->senderAltPhone;
    }

    /**
     * @param mixed $phone
     * @return AwbExtern
     */
    public function setSenderAltPhone($phone)
    {
        $this->senderAltPhone = $phone;
        return $this;
    }


    /**
     * @return string
     */
    public function getSenderEmail()
    {
        return $this->senderEmail;
    }

    /**
     * @param string $email
     * @return AwbExtern
     */
    public function setSenderEmail($email)
    {
        $this->senderEmail = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenderCounty()
    {
        return $this->senderCounty;
    }

    /**
     * @param mixed $county
     * @return AwbExtern
     */
    public function setSenderCounty($county)
    {
        $this->senderCounty = $county;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenderCity()
    {
        return $this->senderCity;
    }

    /**
     * @param mixed $city
     * @return AwbExtern
     */
    public function setSenderCity($city)
    {
        $this->senderCity = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenderStreet()
    {
        return $this->senderStreet;
    }

    /**
     * @param mixed $street
     * @return AwbExtern
     */
    public function setSenderStreet($street)
    {
        $this->senderStreet = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderNumber()
    {
        return $this->senderNumber;
    }

    /**
     * @param string $number
     * @return AwbExtern
     */
    public function setSenderNumber($number)
    {
        $this->senderNumber = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderPostalCode()
    {
        return $this->senderPostalCode;
    }

    /**
     * @param string $postalCode
     * @return AwbExtern
     */
    public function setSenderPostalCode($postalCode)
    {
        $this->senderPostalCode = $postalCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderBuilding()
    {
        return $this->senderBuilding;
    }

    /**
     * @param string $building
     * @return AwbExtern
     */
    public function setSenderBuilding($building)
    {
        $this->senderBuilding = $building;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderEntrance()
    {
        return $this->senderEntrance;
    }

    /**
     * @param string $entrance
     * @return AwbExtern
     */
    public function setSenderEntrance($entrance)
    {
        $this->senderEntrance = $entrance;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderFloor()
    {
        return $this->senderFloor;
    }

    /**
     * @param string $floor
     * @return AwbExtern
     */
    public function setSenderFloor($floor)
    {
        $this->senderFloor = $floor;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenderApartment()
    {
        return $this->senderApartment;
    }

    /**
     * @param string $apartment
     * @return AwbExtern
     */
    public function setSenderApartment($apartment)
    {
        $this->senderApartment = $apartment;
        return $this;
    }

// ********************************************
// ************** FUNCTII PT REZULTATE ********
// ********************************************

	public function setResult(array $data)
		{
		$this->hasErrors = false;
		$this->errors = [];
		$this->details = [];
		
		if ( (isset($data['success']) && ($data['success'] == false) ) || ( isset($data['errors']) && is_array($data['errors']) && (count($data['errors']) > 0) ) )
			{
			$this->hasErrors = true;
			$this->errors = $data['errors'] ?? [];
			}
		
		$this->awb = $data['awbNumber'];
		$this->details = [
				"tariff"		=> $data['tariff'] ?? '',
				"vat"			=> $data['vat'] ?? '',
				"packages"		=> $data['packages'] ?? '',
				"letter"		=> $data['letter'] ?? '',
				"routingCode"	=> $data['routingCode'] ?? '',
				"office"		=> $data['office'] ?? '',
				"pickUpPointId"	=> $data['pickUpPointId'] ?? '',
				"visualCode"	=> $data['visualCode'] ?? '',
				"estimatedDeliveryTime"	=>  $data['estimatedDeliveryTime'] ?? '',
				];

		}
	
	
    /**
     * @return bool
     */
    public function hasErrors()
    {
        return $this->hasErrors;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors ?? [];
    }

    /**
     * @return string
     */
    public function getAwb()
    {
        return $this->awb;
    }

    /**
     * @return array
     */
    public function getDetails()
    {
        return $this->details;
    }


}
