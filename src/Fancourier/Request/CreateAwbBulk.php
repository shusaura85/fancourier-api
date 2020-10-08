<?php

namespace Fancourier\Request;

use Fancourier\Response\CreateAwbBulk as CreateAwbResponseBulk;

/**
 * Class CreateAwbBulk
 * @package Fancourier\Request
 * @SuppressWarnings(PHPMD)
 */
class CreateAwbBulk extends AbstractRequest implements RequestInterface
{
    protected $verb = 'import_awb_integrat.php';
	
	protected $hasChanges = false;	// this is used to check if save() was called before sending requests or not
	protected $awbList = [];

    protected $service = self::SERVICE_STANDARD;
    protected $bank = '';
    protected $iban = '';
    protected $envelopes = 0;
    protected $parcels = 0;
    protected $weight;
    protected $paymentType = self::TYPE_RECIPIENT;
    protected $reimbursement;
    protected $reimbursementPaymentType = self::TYPE_RECIPIENT;
    protected $declaredValue;
    protected $contactPerson;
    protected $notes;
    protected $contents;
    protected $recipient;
    protected $sender;
    protected $phone;
    protected $fax = '';
    protected $email = '';
    protected $region;
    protected $city;
    protected $street;
    protected $number = '';
    protected $postalCode = '';
    protected $building = '';
    protected $entrance = '';
    protected $floor = '';
    protected $apartment = '';
    protected $height = 0;
    protected $length = 0;
    protected $width = 0;
	protected $restitution = '';

    protected $tempDir = '/tmp';

    protected $options = 0;

    public function __construct()
    {
        parent::__construct();
        $this->response = new CreateAwbResponseBulk();
    }

    public function send()
    {
        if (empty($this->verb)) {
            throw new \DomainException("No request verb implemented");
        }

        if ($this->hasChanges) {
			$this->save();
		}
        $file = $this->pack();
        $data = ['fisier' => new \CURLFile($file, 'text/csv', 'fisier.csv')] + $this->auth->pack();

        $responseString = $this->client->post($this->endpoint . $this->verb, $data);
        if (false === $responseString) {
            $this->response->setErrorCode(-1)->setErrorMessage($this->client->getError());
        } else {
            $this->response->setBody($responseString);
        }

        unlink($file);

        return $this->response;
    }

    public function pack()
    {
		// for this array, only the keys are important, the actual data is loaded from $this->awbList
		if (count($this->awbList)<1) {
			throw new \Exception("No AWB entries to send");
		}

		$csv_header = array_keys($this->awbList[0]);

        //need to write temporary csv
        $file = @tempnam($this->getTempDir(), 'fc' . md5(json_encode($data)));

        if (false !== $f = fopen($file, 'w')) {
            fputcsv($f, $csv_header); //',', chr(0)
			foreach ($this->awbList as $data)
				{
				fputcsv($f, array_values($data));
				}
            fclose($f); echo $file;
            return $file;
        }

        throw new \Exception("Could not create temporary awb file");
    }
	
	
	/**
	 * Save the current data as a new AWB entry
     * @return CreateAwbBulk
	 */
	public function save()
	{
		// add new awb to list
        $this->awbList[] = [
            'Type of service' => $this->service,
            'Bank' => $this->bank,
            'IBAN' => $this->iban,
            'Nr. of envelopes' => $this->envelopes,
            'Nr. of parcels' => $this->parcels,
            'Weight' => $this->weight,
            'Payment of shipment' => $this->paymentType,
            'Reimbursement' => $this->reimbursement,
            'Reimbursement transport payment' => $this->reimbursementPaymentType,
            'Declared Value' => $this->declaredValue,
            'Contact person sender' => $this->sender,
            'Observations' => $this->notes,
            'Contains' => $this->contents,
            'Recipient name' => $this->recipient,
            'Contact person recipient' => $this->contactPerson,
            'Phone' => $this->phone,
            'Fax' => $this->fax,
            'Email' => $this->email,
            'County' => $this->region,
            'Town' => $this->city,
            'Street' => $this->street,
            'Number' => $this->number,
            'Postal Code' => $this->postalCode,
            'Block(building)' => $this->building,
            'Entrance' => $this->entrance,
            'Floor' => $this->floor,
            'Flat' => $this->apartment,
            'Height of packet' => $this->height,
            'Width of packet' => $this->length,
            'Lenght of packet' => $this->width,
            'refund' => $this->restitution,
            'cost_center' => '',
            'options' => $this->packOptions($this->getOptions()),
            'packing' => '',
            'recipient_info' => '',
        ];
		
		// reset awb fields to default values
		$this->service = self::SERVICE_STANDARD;
		$this->bank = '';
		$this->iban = '';
		$this->envelopes = 0;
		$this->parcels = 0;
		$this->weight;
		$this->paymentType = self::TYPE_RECIPIENT;
		$this->reimbursement;
		$this->reimbursementPaymentType = self::TYPE_RECIPIENT;
		$this->declaredValue;
		$this->contactPerson;
		$this->notes;
		$this->contents;
		$this->recipient;
		$this->sender;
		$this->phone;
		$this->fax = '';
		$this->email = '';
		$this->region;
		$this->city;
		$this->street;
		$this->number = '';
		$this->postalCode = '';
		$this->building = '';
		$this->entrance = '';
		$this->floor = '';
		$this->apartment = '';
		$this->height = 0;
		$this->length = 0;
		$this->width = 0;
		$this->restitution = '';
		$this->options = 0;
		// reset changes flag
		$this->hasChanges = false;
	
        return $this;
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
     * @return CreateAwbBulk
     */
    public function setService($service)
    {
        $this->service = $service;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setBank($bank)
    {
        $this->bank = $bank;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setEnvelopes($envelopes)
    {
        $this->envelopes = $envelopes;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setParcels($parcels)
    {
        $this->parcels = $parcels;
		$this->hasChanges = true;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     * @return CreateAwbBulk
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
		$this->hasChanges = true;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReimbursement()
    {
        return $this->reimbursement;
    }

    /**
     * @param mixed $reimbursement
     * @return CreateAwbBulk
     */
    public function setReimbursement($reimbursement)
    {
        $this->reimbursement = $reimbursement;
		$this->hasChanges = true;
        return $this;
    }

    /**
     * @return string
     */
    public function getReimbursementPaymentType()
    {
        return $this->reimbursementPaymentType;
    }

    /**
     * @param string $reimbursementPaymentType
     * @return CreateAwbBulk
     */
    public function setReimbursementPaymentType($reimbursementPaymentType)
    {
        $this->reimbursementPaymentType = $reimbursementPaymentType;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setDeclaredValue($declaredValue)
    {
        $this->declaredValue = $declaredValue;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
		$this->hasChanges = true;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param mixed $recipient
     * @return CreateAwbBulk
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
		$this->hasChanges = true;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     * @return CreateAwbBulk
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
		$this->hasChanges = true;
        return $this;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     * @return CreateAwbBulk
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setEmail($email)
    {
        $this->email = $email;
		$this->hasChanges = true;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     * @return CreateAwbBulk
     */
    public function setRegion($region)
    {
        $this->region = $region;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setCity($city)
    {
        $this->city = $city;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setStreet($street)
    {
        $this->street = $street;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setNumber($number)
    {
        $this->number = $number;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setBuilding($building)
    {
        $this->building = $building;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setEntrance($entrance)
    {
        $this->entrance = $entrance;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;
		$this->hasChanges = true;
        return $this;
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
     * @return CreateAwbBulk
     */
    public function setHeight($height)
    {
        $this->height = $height;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setLength($length)
    {
        $this->length = $length;
		$this->hasChanges = true;
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
     * @return CreateAwbBulk
     */
    public function setWidth($width)
    {
        $this->width = $width;
		$this->hasChanges = true;
        return $this;
    }

    /**
     * @param string $restitution
     * @return CreateAwbBulk
     */
    public function setRestitution($restitution)
    {
        $this->restitution = $restitution;
        return $this;
    }

    /**
     * @return string
     */
    public function getRestitution()
    {
        return $this->restitution;
    }

    /**
     * @return string
     */
    public function getTempDir()
    {
        return $this->tempDir;
    }

    /**
     * @param string $tempDir
     * @return CreateAwbBulk
     */
    public function setTempDir($tempDir)
    {
        $this->tempDir = $tempDir;
		$this->hasChanges = true;
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
     * @param $opts
     * @return $this
     */
    public function setOptions($opts)
    {
        if (!is_numeric($opts)) {
            return $this;
        }

        $this->options = $opts;
		$this->hasChanges = true;
        return $this;
    }
}
