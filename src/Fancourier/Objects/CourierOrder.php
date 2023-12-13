<?php

namespace Fancourier\Objects;

class CourierOrder
{
	protected $id;
	protected $number;
	protected $status;
	protected $date;
	protected $hour;
	protected $packages;
	protected $weight;
	protected $dimensions;
	protected $pickupDate;
	protected $pickupHours;
	protected $observation;
	protected $type;
	protected $awbs;
	protected $sender;
	
	public function __construct($data)
		{
		$this->id = $data['info']['id'] ?? '';
		$this->number = $data['info']['number'] ?? '';
		$this->status = $data['info']['status'] ?? [];
		$this->date = $data['info']['date'] ?? '';
		$this->hour = $data['info']['hour'] ?? '';
		$this->packages = $data['info']['packages'] ?? [];
		$this->weight = $data['info']['weight'] ?? '';
		$this->dimensions = $data['info']['dimensions'] ?? [];
		$this->pickupDate = $data['info']['pickupDate'] ?? '';
		$this->pickupHours = $data['info']['pickupHours'] ?? [];
		$this->observation = $data['info']['observation'] ?? '';
		$this->type = $data['info']['type'] ?? '';
		$this->awbs = $data['info']['awbs'] ?? [];
		$this->sender = $data['sender'] ?? [];
		}
	
	public function getId(): string
		{
		return $this->id;
		}
	
	public function getNumber(): string
		{
		return $this->number;
		}
	
	public function getStatus(): array
		{
		return $this->status;
		}
	
	public function getDate(): string
		{
		return $this->date;
		}
	
	public function getHour(): string
		{
		return $this->hour;
		}
	
	public function getEnvelopes(): int
		{
		return (int)$this->packages['envelope'] ?? 0;
		}
	
	public function getParcels(): int
		{
		return (int)$this->packages['parcel'] ?? 0;
		}
	
	public function getWeight(): float
		{
		return (float)$this->weight ?? 0;
		}
	
	public function getDimensions(): array
		{
		return $this->dimensions ?? [];
		}
	
	public function getHeight(): float
		{
		return $this->dimensions['height'] ?? [];
		}
	
	public function getLength(): float
		{
		return $this->dimensions['length'] ?? [];
		}
	
	public function getWidth(): float
		{
		return $this->dimensions['width'] ?? [];
		}
	
	public function getPickupDate(): string
		{
		return $this->pickupDate ?? '';
		}
	
	public function getPickupHours(): array
		{
		return $this->pickupHours ?? [];
		}
	
	public function getNotes(): string
		{
		return $this->observation ?? '';
		}
	
	public function getType(): string
		{
		return $this->type ?? '';
		}
	
	public function getAwbs(): array
		{
		return $this->awbs ?? [];
		}
	
	
	public function getSender(): array
		{
		return $this->sender ?? [];
		}
	
}

/*
            [0] => Array
                (
                    [info] => Array
                        (
                            [id] => 18601914
                            [number] => SI329300184
                            [status] => Array
                                (
                                    [id] => 0
                                    [name] => In asteptare
                                )

                            [date] => 2023-11-25
                            [hour] => 09:00
                            [packages] => Array
                                (
                                    [envelope] => 0
                                    [parcel] => 3
                                )

                            [weight] => 3
                            [dimensions] => Array
                                (
                                    [height] => 0.1
                                    [length] => 0.1
                                    [width] => 0.1
                                )

                            [pickupDate] => 2023-11-25
                            [pickupHours] => Array
                                (
                                    [firstHour] => 10:00
                                    [secondHour] => 13:00
                                )

                            [observation] => 
                            [type] => Standard
                            [awbs] => Array
                                (
                                )

                        )

                    [sender] => Array
                        (
                            [name] => FAN COURIER - cont test
                            [contactPerson] => Ionut Vasiliu
                            [email] => subscriptions@ivfuture.ro
                            [phone] => 0772269427
                            [address] => Array
                                (
                                    [localityId] => 11
                                    [locality] => Bucuresti
                                    [countyId] => 
                                    [county] => Bucuresti
                                    [agency] => Bucuresti
                                    [street] => Fabrica de Glucoza (sosea)
                                    [streetNo] => 11C
                                    [zipCode] => 
                                    [building] => 
                                    [entrance] => 
                                    [floor] => 
                                    [apartment] => 
                                    [country] => Romania
                                )

                        )

                )
*/