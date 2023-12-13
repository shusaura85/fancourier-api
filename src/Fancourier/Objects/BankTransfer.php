<?php

namespace Fancourier\Objects;

class BankTransfer
{
	protected $awbNumber;
	protected $awbDate;
	protected $returnAwbNumber;
	protected $reimbursementAwbNumber;
	protected $amountCollected;
	protected $content;
	protected $transferDate;
	protected $transactionType;
	protected $transactionDate;
	
	protected $recipientName;
	protected $recipientContactPerson;
	protected $recipientCity;
	
	public function __construct($data)
		{
		$this->awbNumber				= $data['info']['awbNumber'] ?? '';
 		$this->awbDate					= $data['info']['awbDate'] ?? '';
 		$this->returnAwbNumber			= $data['info']['returnAwbNumber'] ?? '';
 		$this->reimbursementAwbNumber	= $data['info']['reimbursementAwbNumber'] ?? '';
 		$this->amountCollected			= $data['info']['amountCollected'] ?? 0;
 		$this->content					= $data['info']['content'] ?? '';
 		$this->transferDate				= $data['info']['transferDate'] ?? '';
 		$this->transactionType			= $data['info']['transactionType'] ?? '';
 		$this->transactionDate			= $data['info']['transactionDate'] ?? '';
		
		$this->recipientName			= $data['recipient']['name'] ?? '';
		$this->recipientContactPerson	= $data['recipient']['contactPerson'] ?? '';
		$this->recipientCity			= $data['recipient']['address']['locality'] ?? '';
		
		$this->senderName				= $data['sender']['name'] ?? '';
		$this->senderContactPerson		= $data['sender']['contactPerson'] ?? '';
		}
	
	public function getAwbNumber(): string
		{
		return $this->awbNumber;
		}
	
	public function getAwbDate(): string
		{
		return $this->awbDate;
		}
	
	public function getReturnAwbNumber(): string
		{
		return $this->returnAwbNumber;
		}
	
	public function getReimbursementAwbNumber(): string
		{
		return $this->reimbursementAwbNumber;
		}
	
	public function getAmountCollected(): float
		{
		return $this->amountCollected;
		}
	
	public function getContent(): string
		{
		return $this->content;
		}
	
	public function getTransferDate(): string
		{
		return $this->transferDate;
		}
	
	public function getTransactionType(): string
		{
		return $this->transactionType;
		}
	
	public function getTransactionDate(): string
		{
		return $this->transactionDate;
		}
	
	public function getRecipientName(): string
		{
		return $this->recipientName;
		}
	
	public function getRecipientContactPerson(): string
		{
		return $this->recipientContactPerson;
		}
	
	public function getRecipientCity(): string
		{
		return $this->recipientCity;
		}
	
	public function getSenderName(): string
		{
		return $this->senderName;
		}
	
	public function getSenderContactPerson(): string
		{
		return $this->senderContactPerson;
		}

}


/*
    [0] => Array
        (
            [info] => Array
                (
                    [awbNumber] => 6000000000001
                    [awbDate] => 16.11.2023
                    [amountCollected] => 670.33
                    [content] => order #6783
                    [transferDate] => 20.11.2023
                    [returnAwbNumber] => 
                    [reimbursementAwbNumber] => 
                    [transactionType] => cash
                    [transactionDate] => 17.11.2023
                )

            [recipient] => Array
                (
                    [name] => M. INTREPRINDERE FAMILIALA
                    [contactPerson] => M. - Adjud
                    [address] => Array
                        (
                            [locality] => Adjud
                        )

                )

            [sender] => Array
                (
                    [name] => NETWORK SRL
                    [contactPerson] => 
                )

        )

    [1] => Array
        (
            [info] => Array
                (
                    [awbNumber] => 6000000000002
                    [awbDate] => 16.11.2023
                    [amountCollected] => 375.03
                    [content] => order #6785
                    [transferDate] => 20.11.2023
                    [returnAwbNumber] => 
                    [reimbursementAwbNumber] => 
                    [transactionType] => cash
                    [transactionDate] => 17.11.2023
                )

            [recipient] => Array
                (
                    [name] => COM S.R.L.
                    [contactPerson] => COM S.R.L.
                    [address] => Array
                        (
                            [locality] => Arad
                        )

                )

            [sender] => Array
                (
                    [name] => NETWORK SRL
                    [contactPerson] => 
                )

        )
*/