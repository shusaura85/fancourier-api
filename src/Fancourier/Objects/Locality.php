<?php

namespace Fancourier\Objects;

class Locality
{
    protected $id;
    protected $name;
    protected $county;
    protected $agency;
    protected $extKm;

    public function __construct($data)
    {
        $this->id = intval($data['id']);
        $this->name = $data['name'];
        $this->county = $data['county'];
        $this->agency = $data['agency'];
        $this->extKm = $data['exteriorKm'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): mixed
    {
        return $this->name;
    }

    public function getCounty(): mixed
    {
        return $this->county;
    }

    public function getAgency(): mixed
    {
        return $this->agency;
    }

    public function getExtKm(): mixed
    {
        return $this->extKm;
    }
}
