<?php

namespace Fancourier;

class Auth
{
    private $clientId;
    private $username;
    private $password;

    private $hashPassword = false;

    public function __construct($clientId, $username, $password)
    {
        $this->clientId = $clientId;
        $this->username = $username;
        $this->password = $password;
    }

    public function pack()
    {
        return [
            'client_id' => $this->clientId,
            'username' => $this->username,
            'user_pass' => $this->hashPassword ? md5($this->password) : $this->password,
        ];
    }

    /**
     * @return bool
     */
    public function isHashPassword()
    {
        return $this->hashPassword;
    }

    /**
     * @param bool $hashPassword
     * @return Auth
     */
    public function setHashPassword($hashPassword)
    {
        $this->hashPassword = (bool) $hashPassword;
        return $this;
    }
}
