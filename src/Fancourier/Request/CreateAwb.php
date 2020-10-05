<?php

namespace Fancourier\Request;

use Fancourier\Response\CreateAwb as CreateAwbResponse;

/**
 * Class CreateAwb
 * @package Fancourier\Request
 * @SuppressWarnings(PHPMD)
 */
class CreateAwb extends AbstractRequest implements RequestInterface
{
    protected $verb = 'import_awb_integrat.php';

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

    protected $tempDir = '/tmp';

    protected $options = 0;

    public function __construct()
    {
        parent::__construct();
        $this->response = new CreateAwbResponse();
    }

    public function send()
    {
        if (empty($this->verb)) {
            throw new \DomainException("No request verb implemented");
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
        $data = [
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
            'refund' => '',
            'cost_center' => '',
            'options' => $this->packOptions($this->getOptions()),
            'packing' => '',
            'recipient_info' => '',
        ];

        //need to write temporary csv
        $file = @tempnam($this->getTempDir(), 'fc' . md5(json_encode($data)));

        if (false !== $f = fopen($file, 'w')) {
            fputcsv($f, array_keys($data)); //',', chr(0)
            fputcsv($f, array_values($data));
            fclose($f);
            return $file;
        }

        throw new \Exception("Could not create temporary awb file");
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
     */
    public function setParcels($parcels)
    {
        $this->parcels = $parcels;
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
     * @return CreateAwb
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
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
     * @return CreateAwb
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
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
     * @return CreateAwb
     */
    public function setReimbursement($reimbursement)
    {
        $this->reimbursement = $reimbursement;
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
     * @return CreateAwb
     */
    public function setReimbursementPaymentType($reimbursementPaymentType)
    {
        $this->reimbursementPaymentType = $reimbursementPaymentType;
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
     * @return CreateAwb
     */
    public function setDeclaredValue($declaredValue)
    {
        $this->declaredValue = $declaredValue;
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
     * @return CreateAwb
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
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
     * @return CreateAwb
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
     * @return CreateAwb
     */
    public function setContents($contents)
    {
        $this->contents = $contents;
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
     * @return CreateAwb
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
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
     * @return CreateAwb
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
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
     * @return CreateAwb
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
     * @return CreateAwb
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
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
     * @return CreateAwb
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * @return CreateAwb
     */
    public function setRegion($region)
    {
        $this->region = $region;
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
     */
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;
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
     * @return CreateAwb
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
     * @return CreateAwb
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
     * @return CreateAwb
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
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
     * @return CreateAwb
     */
    public function setTempDir($tempDir)
    {
        $this->tempDir = $tempDir;
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
        return $this;
    }
}
