<?php

namespace Fancourier\Request;

class PrintAwb extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'awb/label';
	protected $method = 'GET';

    private $awbs = [];
    private $pdf = true;
    private $zpl = false;
    private $lang = 'ro';
    private $size = '';

    public function pack()
    {
        $arr = [
			'clientId'	=> $this->auth->getClientId(),
            'awbs' => $this->awbs,
            'language' => $this->lang
        ];
		
		// send pdf variable only if active (can't send both pdf and zpl at the same time)
		if ($this->pdf)
			{
			$arr['pdf'] = 1;
			}
		else // send zpl variable only if active
		if ($this->zpl)
			{
			$arr['zpl'] = 1;
			}
		
		// add the format only if user requests a specific size
		if ($this->size != '')
			{
			$arr['format'] = $this->size;
			}
		
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
        if ($this->zpl) { $this->zpl = false; }	// disable ZPL in case it's active
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZpl()
    {
        return $this->zpl;
    }

    /**
     * @param bool $active
     * @return PrintAwb
     */
    public function setZpl($active = false)
    {
        $this->zpl = $active;
        if ($this->pdf) { $this->pdf = false; }	// disable PDF in case it's active
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

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->lang;
    }

    /**
     * @param string $pageSize - Can be <empty>, 'A4', 'A5' and 'A6' (only for ePOD)
     * @return PrintAwb
     */
    public function setSize($pageSize = '')
    {
        $pageSize = strtoupper($pageSize);
        if (!in_array($pageSize, ['A4', 'A5', 'A6'])) {
            $pageSize = '';
        }

        $this->size = $pageSize;
        return $this;
    }
}
