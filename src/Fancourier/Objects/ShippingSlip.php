<?php

namespace Fancourier\Objects;

class ShippingSlip
{
	protected $awbNumber;
	
	protected $service;
	protected $serviceId;
	
	protected $weight;
	protected $height;
	protected $width;
	protected $length;
	
	protected $payment;
	protected $returnPayment;
	protected $cod;
	protected $declaredValue;
	
	protected $notes;
	protected $contents;
	
    protected $envelopes;
    protected $parcels;
	
    protected $dateTime;
    protected $cost;
    protected $costCenter;
    protected $refund;
    protected $currency;
	
	protected $recipient;
	protected $sender;
	
	public function __construct($data)
		{
		$this->awbNumber	= $data['info']['awbNumber'] ?? '';
		
		$this->service		= $data['info']['service'] ?? '';
		$this->serviceId	= $data['info']['serviceId'] ?? '';
		
		$this->weight		= $data['info']['weight'] ?? 0;
		$this->height		= $data['info']['dimensions']['height'] ?? 0;
		$this->width		= $data['info']['dimensions']['width'] ?? 0;
		$this->length		= $data['info']['dimensions']['length'] ?? 0;
		
		$this->payment		= $data['info']['payment'] ?? '';
		$this->returnPayment	= $data['info']['returnPayment'] ?? '';
		$this->cod			= $data['info']['cod'] ?? 0;
		$this->declaredValue	= $data['info']['declaredValue'] ?? 0;
		$this->notes		= $data['info']['observations'] ?? '';
		$this->contents		= $data['info']['content'] ?? '';
		
		$this->envelopes	= $data['info']['packages']['envelope'] ?? 0;
		$this->parcels		= $data['info']['packages']['parcel'] ?? 0;
		
		$this->dateTime		= $data['info']['date'] ?? '';
		
		$this->cost			= $data['info']['cost'] ?? 0;
		$this->costCenter	= $data['info']['costCenter'] ?? '';
		
		$this->refund		= $data['info']['refund'] ?? '';
		
		$this->currency		= $data['info']['currency'] ?? '';
		
 		$this->recipient	= $data['recipient'] ?? [];
 		$this->sender		= $data['sender'] ?? [];
		}
	
	public function getAwbNumber(): string
		{
		return $this->awbNumber;
		}
	
	public function getService(): string
		{
		return $this->service;
		}
	
	public function getServiceId(): string
		{
		return $this->serviceId;
		}
	
	public function getWeight(): string
		{
		return $this->weight;
		}
	
	public function getHeight(): float
		{
		return $this->height;
		}
	
	public function getWidth(): float
		{
		return $this->width;
		}
	
	public function getLength(): float
		{
		return $this->length;
		}
	
	public function getPayment(): float
		{
		return $this->payment;
		}
	
	public function getReturnPayment(): float
		{
		return $this->returnPayment;
		}
	
	public function getReimbursement(): float
		{
		return $this->cod;
		}
	
	public function getDeclaredValue(): float
		{
		return $this->declaredValue;
		}
	
	public function getNotes(): string
		{
		return $this->notes;
		}
	
	public function getContents(): string
		{
		return $this->contents;
		}
	
	public function getEnvelopes(): int
		{
		return $this->envelopes;
		}
	
	public function getParcels(): int
		{
		return $this->parcels;
		}
	
	public function getDateTime(): string
		{
		return $this->dateTime;
		}
	
	public function getCost(): float
		{
		return $this->cost;
		}
	
	public function getCostCenter(): string
		{
		return $this->costCenter;
		}
	
	public function getRefund(): string
		{
		return $this->refund;
		}
	
	public function getCurrency(): string
		{
		return $this->currency;
		}
	
	public function getRecipient(): array
		{
		return $this->recipient;
		}
	
	public function getSender(): array
		{
		return $this->sender;
		}
	

}


/*
            [info] => Array
                (
                    [awbNumber] => 6324356450139
                    [serviceId] => 4
                    [weight] => 1
                    [dimensions] => Array
                        (
                            [height] => 10
                            [width] => 10
                            [length] => 10
                        )

                    [payment] => sender
                    [cod] => 75.29
                    [returnPayment] => expeditor
                    [declaredValue] => 59.88
                    [observations] => POS
                    [content] => Order #465
                    [date] => 2023-11-20 18:53:07
                    [service] => Cont Colector
                    [cost] => 14.4
                    [packages] => Array
                        (
                            [envelope] => 0
                            [parcel] => 1
                        )

                    [costCenter] => 
                    [refund] => 
                    [currency] => LEI
                )

            [recipient] => Array
                (
                    [name] => COM S.R.L.
                    [contactPerson] => COM S.R.L.
                    [phone] => +40 720 000 000
                    [secondaryPhone] => 
                    [email] => email@example.com
                    [address] => Array
                        (
                            [localityId] => 233
                            [locality] => Fetesti
                            [countyId] => 24
                            [county] => Ialomita
                            [agency] => Ialomita
                            [street] => Str. Grausor, bl. 0, sc. 0, et. 0, ap. 0
                            [streetNo] => 
                            [zipCode] => 000000
                            [building] => 
                            [entrance] => 
                            [floor] => 
                            [apartment] => 
                            [country] => Romania
                        )

                )

            [sender] => Array
                (
                    [name] => NETWORK SRL
                    [contactPerson] => 
                    [phone] => 0720000000
                    [secondaryPhone] => 
                    [email] => email@example.com
                    [address] => Array
                        (
                            [localityId] => 11
                            [locality] => Bucuresti
                            [countyId] => 10
                            [county] => Bucuresti
                            [agency] => Bucuresti
                            [street] => Ridicare din sediul FAN Otopeni (Sediu)
                            [streetNo] => 
                            [zipCode] => 000000
                            [building] => 
                            [entrance] => 
                            [floor] => 
                            [apartment] => 
                            [country] => Romania
                        )

                )

        )
*/