<?php

namespace Fancourier\Request;

use Fancourier\Auth;

interface RequestInterface
{
    public function authenticate(Auth $auth);
    public function setVerify($verifyHost, $verifyPeer);
    public function setTimeout($conTimeout, $timeout);
    public function send();
    public function pack();
}
