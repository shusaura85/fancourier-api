<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCourierOrderEvents as GetCourierOrderEventsResponse;

/**
 * Class GetCourierOrderEvents
 * @package Fancourier\Request
 * @SuppressWarnings(PHPMD)
 */
class GetCourierOrderEvents extends AbstractRequest implements RequestInterface
{
	protected $gateway = 'reports/order-events';
	protected $method = 'GET';
	
	protected $language = '';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCourierOrderEventsResponse();
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
