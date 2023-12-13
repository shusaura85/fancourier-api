<?php

namespace Fancourier\Objects;

class Country
{
	protected $id;
	protected $name;
	protected $deliveryMode;
	protected $code;
	
	public function __construct($data)
		{
		$this->id = $data['id'];
		$this->name = $data['name'];
		$this->deliveryMode = [];
		foreach ($data['deliveryMode'] as $dm)
			{
			$this->deliveryMode[ intval($dm['id']) ] = $dm['name'];
			}
		$this->code = $data['code'];
		}
	
	public function getId(): string
		{
		return $this->id;
		}
	
	public function getName(): string
		{
		return $this->name;
		}
	
	public function getCode(): string
		{
		return $this->code;
		}
	
	public function hasAirShipping(): bool
		{
		return isset($this->deliveryMode[2]);
		}
	
	public function hasLandShipping(): bool
		{
		return isset($this->deliveryMode[1]);
		}
	
	public function getShipping(): array
		{
		return $this->deliveryMode;
		}
}

/*
    [88] => Array
        (
            [id] => 89
            [name] => Laos
            [deliveryMode] => Array
                (
                    [0] => Array
                        (
                            [id] => 2
                            [name] => Aerian
                        )

                )

            [code] => LA
        )

    [89] => Array
        (
            [id] => 14
            [name] => Letonia
            [deliveryMode] => Array
                (
                    [0] => Array
                        (
                            [id] => 2
                            [name] => Aerian
                        )

                    [1] => Array
                        (
                            [id] => 1
                            [name] => Rutier
                        )

                )

            [code] => LV
        )

    [90] => Array
        (
            [id] => 90
            [name] => Liban
            [deliveryMode] => Array
                (
                    [0] => Array
                        (
                            [id] => 2
                            [name] => Aerian
                        )

                )

            [code] => LB
        )

*/