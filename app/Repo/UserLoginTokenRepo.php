<?php namespace App\Repo;

use App\Table\UserLoginToken;

class UserLoginTokenRepo
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