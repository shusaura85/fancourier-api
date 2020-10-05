<?php

namespace Fancourier\Request;

use Fancourier\Auth;
use Fancourier\Response\TrackAwbBulk as TrackAwbBulkResponse;

class TrackAwbBulk extends AbstractRequest implements RequestInterface
{
    const STANDARD_XML_FULL = 1; //not implemented yet
    const STANDARD_XML_SIMPLE = 2; //not implemented yet
    const STANDARD_XML_DETAILS = 3; //not implemented yet
    const STANDARD_JSON = 4;

    protected $verb = 'awb_tracking_list_integrat.php';

    private $standard = self::STANDARD_JSON;
    private $lang = 'ro';
    private $awbs = [];

    public function __construct()
    {
        parent::__construct();
        $this->response = new TrackAwbBulkResponse();

        return $this;
    }

    public function authenticate(Auth $auth)
    {
        parent::authenticate($auth);
        $this->auth->setHashPassword(true);

        return $this;
    }

    public function pack()
    {
        return [
            'standard' => $this->standard,
            'awburi' => json_encode($this->awbs),
            'language' => $this->lang
        ];
    }

    /**
     * @return mixed
     */
    public function getStandard()
    {
        return $this->standard;
    }

    /**
     * @param mixed $standard
     * @return TrackAwbBulk
     */
    public function setStandard($standard)
    {
        $this->standard = $standard;
        return $this;
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     * @return TrackAwbBulk
     */
    public function setLang($lang)
    {
        $lang = strtolower($lang);
        if (!in_array($lang, ['ro', 'en'])) {
            $lang = 'ro';
        }

        $this->lang = $lang;
        return $this;
    }

    /**
     * @return array
     */
    public function getAwbs()
    {
        return $this->awbs;
    }

    /**
     * @param array $awbs
     * @return TrackAwbBulk
     */
    public function setAwbs(array $awbs)
    {
        $this->awbs = $awbs;
        return $this;
    }
}
