<?php namespace App\Repo;

use App\Table\Member;
use App\Table\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserRepo
{
    /**
     * @param int $id
     * @return User|Builder|null
     */
    public function find($id)
    {
        return User::query()
            ->find($id);
    }

    /**
     * @return Collection|User[]
     */
    public function all()
    {
        return User::query()
            ->get();
    }

    /**
     * @param string $email
     * @return null|User
     */
    public function getByEmail($email)
    {
        return Member::query()
            ->where('email', $email)
            ->first();
    }
}