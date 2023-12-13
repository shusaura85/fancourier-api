<?php

namespace Fancourier\Request;

class PrintAwb extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'awb/label';
	protected $method = 'GET';

    private $awbs = [];
    private $pdf = true;
    private $lang = 'ro';

    public function pack()
    {
        $arr = [
			'clientId'	=> $this->auth->getClientId(),
            'awbs' => $this->awbs,
            'pdf' => ($this->pdf ? 1 : 0),
            'language' => $this->lang,
        ];
		
		return $arr;
    }

    /**
     * @return mixed
     */
    public function getAwb()
    {
        return $this->awbs;
    }

    /**
     * @param string $awb
     * @return PrintAwb
     */
    public function setAwb($awb)
    {
        return $this->addAwb($awb);
    }

    /**
     * @param string $awb
     * @return PrintAwb
     */
    public function addAwb($awb)
    {
        $this->awbs[] = $awb;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPdf()
    {
        return $this->pdf;
    }

    /**
     * @param bool $active
     * @return PrintAwb
     */
    public function setPdf($active = true)
    {
        $this->pdf = $active;
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
     * @return PrintAwb
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
}
