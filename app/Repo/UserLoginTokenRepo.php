<?php namespace App\Repo;

use App\Contract\Repo\UserLoginTokenContract;
use App\Table\UserLoginToken;

class UserLoginTokenRepo implements UserLoginTokenContract
{
    /**
     * @param string $token
     * @return bool
     */
    public function existByToken($token)
    {
        return UserLoginToken::query()
            ->where('token', $token)
            ->exists();
    }
}