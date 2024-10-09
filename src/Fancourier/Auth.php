<?php

namespace Fancourier;

use Fancourier\Fancourier;
use Fancourier\Client;

class Auth {
	private $clientId;
	private $username;
	private $password;

	private $btoken = '';
    private $btoken_expires_at = '';
	private $btoken_message = '';

	protected $verifyHost = true;
	protected $verifyPeer = true;

	protected $timeout = 6;
	protected $con_timeout = 3;

	protected $gateway = 'login';

	public function __construct($clientId, $username, $password, $token = '')
		{
		$this->clientId = $clientId;
		$this->username = $username;
		$this->password = $password;

		$this->btoken   = $token;
		// if the token is empty, it will automatically retrieve it when performing a request
		}

	public function getClientId()		{	return $this->clientId;	}
	public function getClientUsername()	{	return $this->username;	}
	public function getClientPassword()	{	return $this->password;	}

	public function getToken($refresh = false)
		{
		$this->btoken_message = '';
		if ($refresh || ($this->btoken == ''))
			{
			try {
				$this->retrieve_token();
			}
			catch (\Exception $e)
				{
				$this->btoken_message = $e->getMessage();
				return false;
				}
			}

		return $this->btoken;
		}

	public function getTokenMessage()
		{
		return $this->btoken_message;
		}

	public function getTokenExpiresAt()
	{
		return $this->btoken_expires_at; // Date format: Y-m-d H:i:s (unknown timezone)
	}

	private function retrieve_token()
		{
		$client = new Client();
		$client->set_verify($this->verifyHost, $this->verifyPeer);
		$client->set_timeout($this->con_timeout, $this->timeout);

		$url = Fancourier::API_URL.$this->gateway;

		$data = [
			'username' => $this->username,
			'password' => $this->password
			];
		$response = $client->post($url, $data);
        // {"status":"success","data":{"token":"48944740|EJU0MgzeWY4y1zy9JpQg3cu3cDiqoVg1ZXsIrqLQ","expiresAt":"2024-06-11 07:23:53"}}

		$response_json = json_decode($response, true);

		if (json_last_error() === JSON_ERROR_NONE)
			{
			if ($response_json['status'] == 'success')
				{
				$this->btoken = $response_json['data']['token'];
				$this->btoken_expires_at = $response_json['data']['expiresAt'];
				}
			else
				{
				throw new \Exception("Login failed: ".$response_json['message']);
				}
			}
		else
			{
			throw new \Exception("Server error: invalid response: ".$response);
			}

		unset($client);

		return ($this->btoken !== '');
		}


    public function setVerify($host = true, $peer = true)
    {
        $this->verifyHost = $host;
        $this->verifyPeer = $peer;
		return $this;
    }

	public function setTimeout($con_timeout = 3, $timeout = 6)
	{
		$this->con_timeout = $con_timeout;
		$this->timeout = $timeout;
		return $this;
	}
}
