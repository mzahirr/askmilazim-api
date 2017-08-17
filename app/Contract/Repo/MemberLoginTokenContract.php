<?php namespace App\Contract\Repo;

interface MemberLoginTokenContract
{
    /**
     * @param string $token
     * @return bool
     */
    public function existByToken($token);
}