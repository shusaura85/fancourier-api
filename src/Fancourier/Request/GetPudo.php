<?php

namespace Fancourier\Request;

use Fancourier\Response\GetPudo as GetPudoResponse;

class GetPudo extends AbstractRequest implements RequestInterface
{
    protected $gateway = 'reports/pickup-points';
	protected $method = 'GET';

    protected $type = self::PUDO_FANBOX;
	protected $pudoId;					// if id is set, type will be ignored

    public function __construct()
    {
        parent::__construct();
        $this->response = new GetPudoResponse();
    }

    public function pack()
    {
		if (empty($this->pudoId))
			{
			$arr = [
				'type' => $this->type
				];
			}
		else
			{
			$arr = [
				'id' => $this->pudoId
				];
			}

		return $arr;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $pudoType
     * @return GetPudo
     */
    public function setType($pudoType)
    {
        $this->type = $pudoType;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->pudoId ?? false;
    }

    /**
     * @param string $pudoId
     * @return GetCities
     */
    public function setId($pudoId)
    {
        $this->pudoId = $pudoId;
        return $this;
    }

}
