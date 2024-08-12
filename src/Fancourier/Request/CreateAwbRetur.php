<?php

namespace Fancourier\Request;

use Fancourier\Response\CreateAwbRetur as CreateAwbReturResponse;

use Fancourier\Objects\AwbIntern;

/**
 * Class CreateAwb
 * @package Fancourier\Request
 */
class CreateAwbRetur extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'intern-awb';
    protected $method = 'POST';
    
    protected $awbList = [];
    
    public function __construct()
    {
        parent::__construct();
        $this->response = new CreateAwbReturResponse();
    }
    
    public function pack()
    {
        $this->response->setAwbList($this->awbList);
        
        
        $arr = [
            "clientId" => $this->auth->getClientId(), //obligatoriu
            "shipments" => [] // shipments
        ];
        
        foreach ($this->awbList as $awb)
        {
            $arr['shipments'][] = $awb->pack();
        }
        
        return $arr;
        
    }
    
    public function addAwb(AwbIntern $awb)
    {
        $this->awbList[] = $awb;
        return $this;
    }
    
    
    public function resetAwbs()
    {
        $this->awbList = [];
        return $this;
    }
    
    
}
