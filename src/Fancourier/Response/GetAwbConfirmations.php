<?php

namespace Fancourier\Response;

class GetAwbConfirmations extends Generic implements ResponseInterface
{
	protected $result;
	
    public function setData($datastr)
    {
		if (substr($datastr, 0, 2) == 'PK')
			{
			// we got a ZIP file
			$this->result = $datastr;
			parent::setData($datastr);
			}
		else
			{
			$response_json = json_decode($datastr, true);
			
			if (json_last_error() === JSON_ERROR_NONE)
				{
				if (isset($response_json['status']) && ($response_json['status'] == 'success'))
					{
					}
				else
					{
					$this->setErrorMessage($response_json['message']);
					$this->setErrorCode(-1);
					}
				}
			}

        return $this;
    }
	
	public function getRAWbytes(): string
		{
		return $this->result;
		}
	
	public function getLength(): string
		{
		return strlen(strval($this->result));
		}
	
	public function saveToFile(string $filename)//: int|false
		{
		return file_put_contents($filename, $this->result);
		}
	
}
