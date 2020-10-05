<?php

namespace Fancourier\Request;

use Fancourier\Response\GetCities as GetCitiesResponse;

class GetCities extends AbstractRequest implements RequestInterface
{
    protected $verb = 'export_distante_integrat.php';

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetCitiesResponse();
    }

    public function pack()
    {
        return [];
    }
}
