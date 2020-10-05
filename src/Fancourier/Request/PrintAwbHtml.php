<?php

namespace Fancourier\Request;

class PrintAwbHtml extends AbstractRequest implements RequestInterface
{
    protected $verb = 'view_awb_integrat.php';

    private $awb;
    private $pageSize = 'A4';
    private $lang = 'ro';

    public function pack()
    {
        return [
            'nr' => $this->awb,
            'page' => $this->pageSize,
            'ln' => $this->lang,
        ];
    }

    /**
     * @return mixed
     */
    public function getAwb()
    {
        return $this->awb;
    }

    /**
     * @param mixed $awb
     * @return PrintAwb
     */
    public function setAwb($awb)
    {
        $this->awb = $awb;
        return $this;
    }

    /**
     * @return string
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param string $pageSize
     * @return PrintAwb
     */
    public function setPageSize($pageSize)
    {
        $pageSize = strtoupper($pageSize);
        if (!in_array($pageSize, ['A4', 'A5', 'A6'])) {
            $pageSize = 'A4';
        }

        $this->pageSize = $pageSize;
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
