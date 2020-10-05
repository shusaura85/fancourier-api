<?php

namespace Fancourier\Request;

class PrintAwb extends AbstractRequest implements RequestInterface
{
    protected $verb = 'view_awb_integrat_pdf.php';

    private $awb;
    private $pageSize = 'A6';
    private $label;
    private $lang = 'ro';

    public function pack()
    {
        return [
            'nr' => $this->awb,
            'page' => $this->pageSize,
            'label' => $this->label,
            'language' => $this->lang,
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
            $pageSize = 'A6';
        }

        $this->pageSize = $pageSize;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     * @return PrintAwb
     */
    public function setLabel($label)
    {
        $this->label = $label;
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
