<?php namespace App\Contract\Repo;

interface UserLoginTokenContract
{
    /**
     * @param string $token
     * @return bool
     */
    public function existByToken($token);
}