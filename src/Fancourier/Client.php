<?php
namespace Fancourier;

class Client {
	private $curl; // \CurlHandle|false

	private $error		= '';
	private $error_no	= 0;

	private $is_put		= false;
	private $is_delete	= false;
	
	private $verify_host = true;
	private $verify_peer = true;

	private $timeout = 6;
	private $con_timeout = 3;

	private $useragent	= 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/119.0';

	private $headers	= [];	// custom headers

	public function __construct(?string $useragent = null)
		{
		if (!is_null($useragent) && ($useragent != '') )
			{
			$this->useragent = $useragent;
			}
		}

	/*
	* Init curl and set common options. Called by get/post functions
	*/
	private function init()
		{
		$this->curl = curl_init();
		// init default data
		curl_setopt($this->curl, CURLOPT_USERAGENT, $this->useragent);

		curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, $this->con_timeout);
		curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->timeout);

		if (!$this->verify_host)
			{
			curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 0);
			}
		if (!$this->verify_peer)
			{
			curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0);
			}

		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);

		$this->set_custom_headers();
		}

	private function set_custom_headers()
		{
		if (count($this->headers) > 0)
			{
			$curl_headers = [];
			foreach ($this->headers as $hname=>$hvalue)
				{
				$curl_headers[] = $hname.":".$hvalue;
				}

			curl_setopt($this->curl, CURLOPT_HTTPHEADER, $curl_headers);
			}
		}

	private function close()
		{
		curl_close($this->curl);
		// reset put/delete requests
		$this->is_put = false;
		$this->is_delete = false;
		}

	public function get(string $url)//: string|false
		{
		//echo '<div style="font-family:monospace; padding: 5px; border: 1px solid red; margin: 5px">'.$url.'</div>';
		$this->init();
		
		curl_setopt($this->curl, CURLOPT_URL, $url);
		//curl_setopt($this->curl, CURLOPT_HEADER, 0);
		curl_setopt($this->curl, CURLOPT_POST, 0);
		if ($this->is_put)
			{
			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
			}
		elseif ($this->is_delete)
			{
			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			}

		$response = curl_exec($this->curl);

		if (!curl_error($this->curl) && $response)
			{
			$this->close();
			return $response;
			}

		$this->set_error(curl_error($this->curl));
		$this->set_error_no(curl_errno($this->curl));
		$this->close();
		return false;
		}

	/*
	Use this static function to prepare a file for posting it using cURL
	Pass the resulting object of this function inside the $data array of the post function
	*/
	public static function prepare_file(string $file) //: \CURLFile
		{
		$mime = mime_content_type($file);
		$info = pathinfo($file);
		$name = $info['basename'];
		return new \CURLFile($file, $mime, $name);
		}


	/*
	Use this static function to prepare a string for posting it using cURL to a file field
	Pass the resulting object of this function inside the $data array of the post function
	*/
	public static function prepare_file_string(string $data, string $postname, string $mime = 'text/plain') //: \CURLStringFile
		{
		return new \CURLStringFile($data, $postname, $mime);
		}


	public function post(string $url, array $data)
		{
		$this->init();

		curl_setopt($this->curl, CURLOPT_URL, $url);
		//curl_setopt($this->curl, CURLOPT_HEADER, 0);

		curl_setopt($this->curl, CURLOPT_POST, 1);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
		if ($this->is_put)
			{
			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
			}
		elseif ($this->is_delete)
			{
			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			}

		$response = curl_exec($this->curl);

		if (!curl_error($this->curl) && $response)
			{
			$this->close();
			return $response;
			}

		$this->set_error(curl_error($this->curl));
		$this->set_error_no(curl_errno($this->curl));
		$this->close();
		return false;
		}
	
	// curl doesn't like multilevel arrays in CURLOPT_POSTFIELDS, so we have to manually build the data with http_build_query
	public function post_ma(string $url, array $data)
		{
		$this->init();

		$datastr = http_build_query($data, '', '&');
		$datastr = str_replace(["%5B", "%5D"], ["[", "]"], $datastr);
/*
		echo '<pre>';
		print_r($data);
		echo $datastr;
		echo '</pre>';
*/
		curl_setopt($this->curl, CURLOPT_URL, $url);
		//curl_setopt($this->curl, CURLOPT_HEADER, 0);

		curl_setopt($this->curl, CURLOPT_POST, 1);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $datastr);
		if ($this->is_put)
			{
			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
			}
		elseif ($this->is_delete)
			{
			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			}

		$response = curl_exec($this->curl);

		if (!curl_error($this->curl) && $response)
			{
			$this->close();
			return $response;
			}

		$this->set_error(curl_error($this->curl));
		$this->set_error_no(curl_errno($this->curl));
		$this->close();
		return false;
		}
	
	public function post_json(string $url, array $data)//: string|false
		{
		$this->headers_add('Content-Type', 'application/json'); // add content-type to headers
		$this->init();

		curl_setopt($this->curl, CURLOPT_URL, $url);

		//curl_setopt($this->curl, CURLOPT_HEADER, ['Content-Type: application/json'] );

		//curl_setopt($this->curl, CURLOPT_POST, 1);
		$jsondata = json_encode($data);
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $jsondata);
		if ($this->is_put)
			{
			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
			}
		elseif ($this->is_delete)
			{
			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "DELETE");
			}
		
		$this->headers_delete('Content-Type'); // remove the custom content-type to not interfere with other requests

		$response = curl_exec($this->curl);

		if(empty($response)||is_null($response))
			{
			$this->close();
			}

		if (!curl_error($this->curl) && $response)
			{
			$this->close();
			return $response;
			}

		$this->set_error(curl_error($this->curl));
		$this->set_error_no(curl_errno($this->curl));
		$this->close();
		return false;
		}

	private function set_error(string $error)
		{
		$this->error = $error;
		return $this;
		}

	public function get_error(): string
		{
		return $this->error;
		}

	private function set_error_no(int $errno)
		{
		$this->error_no = $errno;
		return $this;
		}

	public function get_error_no(): int
		{
		return $this->error_no;
		}
	
	/*
	* Add a custom header to curl
	*/
	public function headers_add($name, $value)
		{
		$this->headers[ $name ] = $value;
		return $this;
		}

	/*
	* Remove a custom header from curl requests
	*/
	public function headers_delete($name)
		{
		if (array_key_exists($name, $this->headers))
			{
			unset($this->headers[ $name ]);
			}
		return $this;
		}
	
	/*
	* Clear all custom headers from curl
	*/

	public function headers_reset()
		{
		$this->headers = [];
		return $this;
		}
	
	
	/* set put request (automatically disables delete request) */
	public function set_put_request($enabled = false)
		{
		$this->is_put = $enabled;
		$this->is_delete = false;
		return $this;
		}
	
	/* set delete request (automatically disables put request) */
	public function set_delete_request($enabled = false)
		{
		$this->is_delete = $enabled;
		$this->is_put = false;
		return $this;
		}

	/* if you need to skip host/peer validation */
	public function set_verify($host = true, $peer = true)
		{
		$this->verify_host = $host;
		$this->verify_peer = $peer;
		return $this;
		}

	/* if you need a custom request timeout */
	public function set_timeout($con_timeout = 3, $timeout = 6)
		{
		$this->con_timeout = $con_timeout;
		$this->timeout = $timeout;
		return $this;
		}

	public function __destruct()
		{

		}
}
