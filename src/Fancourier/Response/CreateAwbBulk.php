<?php

namespace Fancourier\Response;

class CreateAwbBulk extends Generic implements ResponseInterface
{
    public function setBody($body)
    {
        if (empty($body)) {
            $this->setErrorMessage("Empty response");
            $this->setErrorCode(-1);
            return $this;
        }
		
		// check for errors
        $temp = str_getcsv($body);
        if (count($temp) == 1) {
            $this->setErrorMessage($temp[0]);
            $this->setErrorCode(0);
            return $this;
        }

		$awbresult = [];
		// we need to break the resulting data into each line for processing
		$results = explode("\n", $body);
		// loop over results and build response array
		foreach ($results as $awbline) {
			if (trim($awbline) != '') {
				$body = str_getcsv($awbline);
				$idx = intval($body[0]);
				$awbdata = ['line' => $idx,  'awb' => null, 'cost' => null, 'error' => ($body[1] == 0), 'message' => null];
				
				if ($awbdata['error']) {
					$awbdata['message'] = $body[2];
				}
				else {
					$awbdata['awb'] = $body[2];
					$awbdata['cost'] = (isset($body[3]) ? $body[3] : null);
				}
				
				$awbresult[ $idx ] = $awbdata;
			}
		}
		
		parent::setBody($awbresult);
		
		return $this;
    }
}
