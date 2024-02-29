<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCostsExternal as GetCostsExternalResponse;

class GetCostsExternal extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/awb/external-tariff';
	protected $method = 'GET';

    private $senderCity;		// sender.locality
    private $senderCounty;	// sender.county
    private $country;
    private $envelopes = 0;
    private $parcels = 0;
    private $weight;
    private $length = 0;
    private $width = 0;
    private $height = 0;
	
    private $service = 'Export';
	private $deliveryMode = 'Rutier';		// "rutier" sau "aerian" (metodele disponibile se pot afla prin GetCountries)
	private $documentType = 'document';		// "document" sau "non document"

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCostsExternalResponse();
    }

    public function pack()
    {
        $arr = [
			'clientId'	=> $this->auth->getClientId(),
			'info'		=> [
							'service'		=>	$this->service,
							'deliveryMode'	=> $this->deliveryMode,
							'documentType'	=> $this->documentType,
							'weight'		=>	$this->weight,
							'dimensions'	=> [
												'height'	=> $this->height,
												'width'		=> $this->width,
												'length'	=> $this->length,
												],
							'packages'		=>	[
												'envelope'	=> $this->envelopes,
												'parcel'	=> $this->parcels,
												],
						],
			'recipient'	=> [
						'country'	=> $this->country,
						],
			];
		
		if ( ($this->senderCity != '') || ($this->senderCounty != '') )
			{
			$arr['sender'] = [];
			
			if ($this->senderCity != '')
				{
				$arr['sender']['locality'] = $this->senderCity;
				}
			
			if ($this->senderCounty != '')
				{
				$arr['sender']['county'] = $this->senderCounty;
				}
			}
		
		return $arr;
    }

    /**
     * @return mixed
     */
    public function getDeliveryMode()
    {
        return $this->deliveryMode;
    }

    /**
     * @param mixed $city
     * @return GetCostsExternal
     */
    public function setDeliveryMode($deliveryMode)
    {
	    $deliveryMode = strtolower($deliveryMode);
		if ( ($deliveryMode == 'rutier') || ($deliveryMode == 'aerian') )
		{
            $this->deliveryMode = $deliveryMode;
		}
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumentType()
    {
        return $this->documentType;
    }

    /**
     * @param mixed $documentType
     * @return GetCostsExternal
     */
    public function setDocumentType($documentType)
    {
	    $documentType = strtolower($documentType);
		if ( ($documentType == 'document') || ($documentType == 'non document') )
		{
            $this->documentType = $documentType;
		}
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
     * @return GetCostsExternal
     */
    public function setSenderCity($city)
    {
        $this->senderCity = $city;
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
     * @return GetCostsExternal
     */
    public function setSenderCounty($county)
    {
        $this->senderCounty = $county;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return GetCostsExternal
     */
    public function setCountry($country)
    {
        $this->country = $country;
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
     * @return GetCostsExternal
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
     * @return GetCostsExternal
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
     * @return GetCostsExternal
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
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
     * @return GetCostsExternal
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
     * @return GetCostsExternal
     */
    public function setWidth($width)
    {
        $this->width = $width;
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
     * @return GetCostsExternal
     */
    public function setHeight($height)
    {
        $this->height = $height;
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
     * @return GetCostsExternal
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }
}
