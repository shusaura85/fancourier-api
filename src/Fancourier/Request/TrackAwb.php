<?php

namespace Fancourier\Request;

class TrackAwb extends AbstractRequest implements RequestInterface
{
    const MODE_LAST_STATUS = 1;
    const MODE_LAST = 2;
    const MODE_FULL = 3;
    const MODE_RECEIPT = 4;
    const MODE_JSON = 5;

    protected $verb = 'awb_tracking_integrat.php';

    protected $awb;
    protected $displayMode = self::MODE_FULL;

    public function pack()
    {
        return [
            'AWB' => $this->awb,
            'display_mode' => $this->displayMode,
        ];
    }

    /**
     * @return mixed
     */
    public function getAwb()
    {
        return $this->awb;
    }

    /**
     * @param mixed $awb
     * @return TrackAwb
     */
    public function setAwb($awb)
    {
        $this->awb = $awb;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDisplayMode()
    {
        return $this->displayMode;
    }

    /**
     * @param mixed $displayMode
     * @return TrackAwb
     */
    public function setDisplayMode($displayMode)
    {
        $this->displayMode = $displayMode;
        return $this;
    }
}
