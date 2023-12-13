<?php

namespace Fancourier\Request;

use Fancourier\Response\TrackAwb as TrackAwbResponse;

/**
 * Class TrackAwb
 * @package Fancourier\Request
 * @SuppressWarnings(PHPMD)
 */
class TrackAwb extends AbstractRequest implements RequestInterface
{
	protected $gateway = 'reports/awb/tracking';
	protected $method = 'GET';
	
	protected $awbList = [];
	protected $language = '';

    public function __construct()
    {
        parent::__construct();
        $this->response = new TrackAwbResponse();
    }

    public function pack()
    {
		$arr = [
				"clientId" => $this->auth->getClientId(), //obligatoriu 
				"awb" => [] // shipments
				
			];
		
		foreach ($this->awbList as $awb)
			{
			$arr['awb'][] = $awb;
			}
		
		if ($this->language != '')
			{
			$arr['language'] = $this->language;
			}
		
		return $arr;
	
    }
	
	public function addAwb(string $awb)
	{
		$this->awbList[] = $awb;
		return $this;
	}
	
	public function setAwb(string $awb)
	{
		return $this->addAwb($awb);
	}
	
	
	public function resetAwbs()
	{
		$this->awbList = [];
		return $this;
	}

    /**
     * @return string
     */
	public function getLanguage()
	{
		return $this->language ?? '';
	}
	
    /**
     * @param string $language
     * @return TrackAwb
     */
    public function setLanguage($language)
    {
		$language = trim(strtolower($language));
		if (in_array($language, ['ro', 'en']))
			{
			$this->language = $language;
			}
        return $this;
    }


}
