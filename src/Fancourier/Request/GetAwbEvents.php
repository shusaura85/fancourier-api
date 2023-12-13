<?php

namespace Fancourier\Request;

use Fancourier\Response\GetAwbEvents as GetAwbEventsResponse;

class GetAwbEvents extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/awb-events';
	protected $method = 'GET';
	
    protected $language = '';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetAwbEventsResponse();
    }

    public function pack()
    {
		$arr = [];
		if ($this->language != '')
			{
			$arr['language'] = $this->language;
			}
		
		return $arr;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->county;
    }

    /**
     * @param string $language
     * @return GetAwbEvents
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
