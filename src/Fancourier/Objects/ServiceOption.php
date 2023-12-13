<?php

namespace Fancourier\Objects;

class ServiceOption
{
	protected $code;
	protected $name;
	
	public function __construct($code, $name)
		{
		$this->code = $code;
		$this->name = $name;
		}
	
	public function getCode(): string
		{
		return $this->code;
		}
	
	public function getName(): string
		{
		return $this->name;
		}
}
