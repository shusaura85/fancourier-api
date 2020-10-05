<?php

namespace Fancourier\Request;

use Fancourier\Auth;

interface RequestInterface
{
    public function authenticate(Auth $auth);
    public function send();
    public function pack();
}
