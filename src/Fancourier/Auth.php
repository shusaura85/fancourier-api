<?php

namespace Fancourier;

use Fancourier\Fancourier;
use Fancourier\Client;

class Auth {
	private $clientId;
	private $username;
	private $password;

	private $btoken = '';
	private $btoken_message = '';

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

	private function retrieve_token()
		{
		$client = new Client();
		$url = Fancourier::API_URL.$this->gateway;

		$data = [
			'username' => $this->username,
			'password' => $this->password
			];
		$response = $client->post($url, $data);
		// {"status":"success","data":{"token":"1811783|P28BQMrSipEdRfPujLKpqKJjoYLyxT8RsW0MxMQ7"}}

		$response_json = json_decode($response, true);

		if (json_last_error() === JSON_ERROR_NONE)
			{
			if ($response_json['status'] == 'success')
				{
				$this->btoken	= $response_json['data']['token'];
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

}
