<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCosts as GetCostsResponse;

class GetCosts extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/awb/internal-tariff';
	protected $method = 'GET';

    private $paymentType = self::TYPE_RECIPIENT;	// info['payment']
    private $city;
    private $county;
    private $senderCity;
    private $senderCounty;
    private $envelopes = 0;
    private $parcels = 0;
    private $weight;
    private $length = 0;
    private $width = 0;
    private $height = 0;
    private $declaredValue;
//    private $reimbursementPaymentType = self::TYPE_RECIPIENT;
    private $options = '';
    private $service = 'Standard';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCostsResponse();
    }

    public function pack()
    {
        $arr = [
			'clientId'	=> $this->auth->getClientId(),
			'info'		=> [
							'service'	=>	$this->service,
							'payment'	=>	$this->paymentType,
							'weight'	=>	$this->weight,
							'packages'	=>	[],
						],
			'recipient'	=> [
						'locality'	=> $this->city,
						'county'	=> $this->county
						],
			];

		if ($this->options != '')
			{
			$arr['info']['options'] = $this->options;
			}

		if ( ($this->width > 0) && ($this->height > 0) && ($this->length > 0) )
			{
			$arr['info']['dimensions'] = [
										'height'	=> $this->height,
										'width'		=> $this->width,
										'length'	=> $this->length,
										];
			}

		if ($this->envelopes > 0)
			{
			$arr['info']['packages']['envelope'] = $this->envelopes;
			}

		if ($this->parcels > 0)
			{
			$arr['info']['packages']['parcel'] = $this->parcels;
			}

		if (!empty($this->declaredValue))
			{
			$arr['info']['declaredValue'] = $this->declaredValue;
			}

		if (!empty($this->senderCity) || !empty($this->senderCounty))
			{
			$arr['sender'] = [];
			}
		if (!empty($this->senderCity))
			{
			$arr['sender']['locality'] = $this->senderCity;
			}
		if (!empty($this->senderCounty))
			{
			$arr['sender']['county'] = $this->senderCounty;
			}

		return $arr;
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
     * @return GetCosts
     */
    public function setPaymentType($paymentType)
    {
        if ($paymentType != self::TYPE_RECIPIENT && $paymentType != self::TYPE_SENDER) {
            throw new \InvalidArgumentException("Invalid paymentType value");
        }

        $this->paymentType = $paymentType;
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
     * @return GetCosts
     */
    public function setCity($city)
    {
        $this->city = $city;
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
     * @return GetCosts
     */
    public function setCounty($county)
    {
        $this->county = $county;
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
     * @return GetCosts
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
     * @return GetCosts
     */
    public function setSenderCounty($county)
    {
        $this->senderCounty = $county;
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
     * @return GetCosts
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
     * @return GetCosts
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
     * @return GetCosts
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
     * @return GetCosts
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
     * @return GetCosts
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
     * @return GetCosts
     */
    public function setHeight($height)
    {
        $this->height = $height;
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
     * @return GetCosts
     */
    public function setDeclaredValue($declaredValue)
    {
        $this->declaredValue = $declaredValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $options
     * @return GetCosts
     */
    public function setOptions($options)
    {
        $this->options = $options;
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
     * @return GetCosts
     */
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }
}
