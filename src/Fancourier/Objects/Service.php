<?php

namespace Fancourier\Objects;

class Service
{
	protected $id;
	protected $name;
	protected $description;
	
	public function __construct($id, $name, $description)
		{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		}
	
	public function getId(): string
		{
		return $this->id;
		}
	
	public function getName(): string
		{
		return $this->name;
		}
	
	public function getDescription(): string
		{
		return $this->description;
		}
}
