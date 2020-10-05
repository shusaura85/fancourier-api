<?php

namespace Fancourier\Request;

use Fancourier\Auth;
use Fancourier\Client;
use Fancourier\Response\Generic;

abstract class AbstractRequest implements RequestInterface
{
    const TYPE_RECIPIENT = 'destinatar';
    const TYPE_SENDER = 'expeditor';

    const SERVICE_STANDARD = 'Standard';
    const SERVICE_REDCODE = 'RedCode';
    const SERVICE_CAIET_SARCINI = 'Caiet Sarcini';
    const SERVICE_LOCO_SAMEDAY_1H = 'Loco Sameday 1H';
    const SERVICE_LOCO_SAMEDAY_2H = 'Loco Sameday 2H';
    const SERVICE_LOCO_SAMEDAY_4H = 'Loco Sameday 4H';
    const SERVICE_LOCO_SAMEDAY_6H = 'Loco Sameday 6H';
    const SERVICE_CONT_COLECTOR = 'Cont Colector';
    const SERVICE_LOCO_SAMEDAY_1H_CONT_COLECTOR = 'Loco Sameday 1H-Cont Colector';
    const SERVICE_LOCO_SAMEDAY_2H_CONT_COLECTOR = 'Loco Sameday 2H-Cont Colector';
    const SERVICE_LOCO_SAMEDAY_4H_CONT_COLECTOR = 'Loco Sameday 4H-Cont Colector';
    const SERVICE_LOCO_SAMEDAY_6H_CONT_COLECTOR = 'Loco Sameday 6H-Cont Colector';
    const SERVICE_RED_CODE_CONT_COLECTOR = 'Red code-Cont Colector';
    const SERVICE_PRODUSE_ALBE = 'Produse Albe';
    const SERVICE_PRODUSE_ALBE_CONT_COLECTOR = 'Produse Albe-Cont Colector';
    const SERVICE_TRANSPORT_MARFA = 'Transport Marfa';
    const SERVICE_TRANSPORT_MARFA_CONT_COLECTOR = 'Transport Marfa-Cont Colector';
    const SERVICE_TRANSPORT_MARFA_PRODUSE_ALBE = 'Transport Marfa Produse Albe';
    const SERVICE_TRANSPORT_MARFA_PRODUSE_ALBE_CONT_COLECTOR = 'Transport Marfa Produse Albe-Cont Colector';

    const OPTION_EPOD = 1;
    const OPTION_OPEN = 2;
    const OPTION_FANHQ = 4;
    const OPTION_SATURDAY = 8;

    protected $endpoint = 'https://www.selfawb.ro/';

    protected $verb;

    /** @var Auth */
    protected $auth;

    /** @var Client */
    protected $client;

    /** @var Generic */
    protected $response;

    public function __construct()
    {
        $this->client = new Client();
        $this->response = new Generic();
    }

    public function authenticate(Auth $auth)
    {
        $this->auth = $auth;
        return $this;
    }

    /**
     * @return Generic
     */
    public function send()
    {
        if (empty($this->verb)) {
            throw new \DomainException("No request verb implemented");
        }

        $data = array_merge(
            $this->auth->pack(),
            $this->pack()
        );

        $responseString = $this->client->post($this->endpoint . $this->verb, $data);
        if (false === $responseString) {
            $this->response->setErrorCode(-1)->setErrorMessage($this->client->getError());
        } else {
            $this->response->setBody($responseString);
        }

        return $this->response;
    }

    /**
     * @return string
     */
    protected function packOptions($options)
    {
        $options = (int)$options;
        
        $opts = [];
        if ($options & static::OPTION_EPOD) {
            $opts[] = "X"; //'ePOD';
        }

        if ($options & static::OPTION_OPEN) {
            $opts[] = "A"; //'Deschidere la livrare';
        }

        if ($options & static::OPTION_FANHQ) {
            $opts[] = "D"; //'Livrare din sediul FAN Courier';
        }

        if ($options & static::OPTION_SATURDAY) {
            $opts[] = "S"; //'Livrare sambata';
        }

        return count($opts) ? implode('', $opts) : '';
    }
}
