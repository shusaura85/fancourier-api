<?php

namespace Fancourier\Objects;

class AwbTracker
{
	protected $awbNumber;
	protected $message;
	protected $content;
	
	protected $date;
	protected $paymentDate;
	
	protected $returnAwbNumber;
	protected $redirectionAwbNumber;
	protected $reimbursementAwbNumber;
	protected $oPODAwbNumber;
	
	protected $confirmation;
	protected $events;
	
	public function __construct($data)
		{
		$this->awbNumber = $data['awbNumber'];
		$this->message = $data['message'] ?? '';
		$this->content = $data['content'] ?? '';
		
		if (!isset($data['message']))
			{
			$this->date = $data['date'] ?? '';
			$this->paymentDate = $data['paymentDate'] ?? ''; 
			$this->returnAwbNumber = $data['returnAwbNumber'] ?? '';
			$this->redirectionAwbNumber = $data['redirectionAwbNumber'] ?? '';
			$this->reimbursementAwbNumber = $data['reimbursementAwbNumber'] ?? ''; 
			$this->oPODAwbNumber = $data['oPODAwbNumber'] ?? ''; 
			}
		
		$this->confirmation = $data['confirmation'] ?? [];
		$this->events = $data['events'] ?? [];
		}
	
	public function getAwbNumber(): string
		{
		return $this->awbNumber ?? '';
		}
	
	public function getReturnAwbNumber(): string
		{
		return $this->returnAwbNumber ?? '';
		}
	
	public function getRedirectionAwbNumber(): string
		{
		return $this->redirectionAwbNumber ?? '';
		}
	
	public function getReimbursementAwbNumber(): string
		{
		return $this->reimbursementAwbNumber ?? '';
		}
	
	public function getOpodAwbNumber(): string
		{
		return $this->oPODAwbNumber ?? '';
		}
	
	public function getMessage(): string
		{
		return $this->message ?? '';
		}
	
	public function getContent(): string
		{
		return $this->content ?? '';
		}
	
	public function hasConfirmation(): bool
		{
		if ( isset($this->confirmation['name']) && ($this->confirmation['name'] != '') )
			{
			return true;
			}
		return false;
		}

	public function getConfirmation(): array
		{
		return $this->confirmation ?? [];
		}

	public function getEvents(): Array
		{
		return $this->events ?? [];
		}

	public function getStatus(): array
		{
		if (count($this->events) > 0)
			{
			$last = array_key_last($this->events);
			return $this->events[$last];
			}
		
		return [
				'id'	=>	null,
				'name'	=>	$this->message ?? '',
				'location' =>	'',
				'date'	=> date("Y-m-d H:i:s")
				];
		}

}


/*
    [0] => Array
        (
            [content] => 
            [awbNumber] => 2000000000000
            [message] => The AWB has been registerd by sender
        )
    [0] => Array
        (
            [content] => Order #135
            [awbNumber] => 2000000000082
            [date] => 2023-11-28 00:00:00
            [paymentDate] => 
            [returnAwbNumber] => 
            [redirectionAwbNumber] => 
            [reimbursementAwbNumber] => 
            [oPODAwbNumber] => 
            [confirmation] => Array
                (
                    [name] => 
                    [date] => 2023-11-29 
                )

            [events] => Array
                (
                    [0] => Array
                        (
                            [id] => C0
                            [name] => Expeditie ridicata
                            [location] => Bucuresti
                            [date] => 2023-11-28 18:58:00
                        )

                    [1] => Array
                        (
                            [id] => H3
                            [name] => Expeditie sortata pe banda
                            [location] => Bucuresti
                            [date] => 2023-11-28 21:57:06
                        )

                    [2] => Array
                        (
                            [id] => H3
                            [name] => Expeditie sortata pe banda
                            [location] => Bucuresti
                            [date] => 2023-11-29 00:00:44
                        )

                    [3] => Array
                        (
                            [id] => H10
                            [name] => Expeditie in tranzit spre depozitul de destinatie
                            [location] => Bucuresti
                            [date] => 2023-11-29 00:31:10
                        )

                    [4] => Array
                        (
                            [id] => H1
                            [name] => Expeditie descarcata in depozitulul de destinatie
                            [location] => Targu Frumos
                            [date] => 2023-11-29 08:56:21
                        )

                    [5] => Array
                        (
                            [id] => C1
                            [name] => Expeditie preluate spre livrare
                            [location] => Targu Frumos
                            [date] => 2023-11-29 09:17:00
                        )

                    [6] => Array
                        (
                            [id] => S1
                            [name] => Expeditie in livrare
                            [location] => Targu Frumos
                            [date] => 2023-11-29 09:17:00
                        )

                    [7] => Array
                        (
                            [id] => S12
                            [name] => Contactat; livrare ulterioara
                            [location] => Targu Frumos
                            [date] => 2023-11-29 09:50:13
                        )

                )

        )

*/