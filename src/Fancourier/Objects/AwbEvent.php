<?php

namespace Fancourier\Objects;

class AwbEvent
{
	protected $id;
	protected $name;
	
	public function __construct($id, $name)
		{
		$this->id = $id;
		$this->name = $name;
		}
	
	public function getId(): string
		{
		return $this->id;
		}
	
	public function getName(): string
		{
		return $this->name;
		}
}
