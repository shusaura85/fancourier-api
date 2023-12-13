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
    protected $envelopes = 0;	// optionalif parcels set	// info.packages.envelopes
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
	
    protected $name = '';										// info.recipient.name
    protected $contactPerson = '';								// info.recipient.contactPerson
    protected $phone = '';										// info.recipient.phone
    protected $altPhone = '';									// info.recipient.secondaryPhone
    protected $email = '';									// info.recipient.email
	
    protected $county = ''; 									// info.recipient.address.county
    protected $city = ''; // locality							// info.recipient.address.locality
    protected $street = '';										// info.recipient.address.street
    protected $number = '';									// info.recipient.address.streetNo
	
	protected $pickupLocation = '';	// ONLY FOR PUDO		// info.recipient.address.pickupLocation
	
    protected $postalCode = '';								// info.recipient.address.zipcode
	
    protected $building = '';								// info.recipient.address.building
    protected $entrance = '';								// info.recipient.address.entrance
    protected $floor = '';									// info.recipient.address.floor
    protected $apartment = '';								// info.recipient.address.apartment
	
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
					"returnPayment" => $this->returnPayment, //obligatoriu 
					"observation" => $this->notes, //obligatoriu 
					"content" => $this->contents, //optional 
					"dimensions" => [
								"length" => $this->length,
								"height" => $this->height,
								"width" => $this->width
								], 
					"costCenter" => $this->costCenter, //optional 
					"options" => $this->options 
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
								"streetNo" => $this->number, 
								"pickupLocation" => $this->pickupLocation,//doar pentru FANbox - {{url}}/pickup-points 
								"zipCode" => $this->postalCode,
								
								"building" => $this->building, 
								"entrance" => $this->entrance, 
								"floor" => $this->floor, 
								"apartment" => $this->apartment,
								//"country" => "Romania" // optional
								] 
				]
			];
		
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
    public function getCoD()
    {
        return $this->CoD;
    }

    /**
     * @param mixed $cod
     * @return AwbIntern
     */
    public function setCoD($cod)
    {
        $this->CoD = $cod;
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
     * @return int
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param $opt
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
     * @return $this
     */
    public function resetOptions()
    {
        $this->options = [];
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
        return $this->pickupLocation;
    }

    /**
     * @param string $number
     * @return AwbIntern
     */
    public function setPickupLocation($number)
    {
        $this->pickupLocation = $number;
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


// ********************************************
// ************** FUNCTII PT REZULTATE ********
// ********************************************

	public function setResult(array $data)
		{
		$this->hasErrors = false;
		$this->errors = [];
		$this->details = [];
		
		if (isset($data['status']) && ($data['status'] == false) )
			{
			$this->hasErrors = true;
			$this->errors = $data['errors'] ?? [];
			}
		
		$this->awb = $data['awbNumber'];
		$this->details = [
				"tariff"		=> $data['tariff'] ?? '',
				"packages"		=> $data['packages'] ?? '',
				"letter"		=> $data['letter'] ?? '',
				"routingCode"	=> $data['routingCode'] ?? '',
				"office"		=> $data['office'] ?? '',
				"visualCode"	=>  $data['visualCode'] ?? '',
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
