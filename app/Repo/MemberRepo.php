<?php namespace App\Repo;

use App\Table\Member;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MemberRepo
{
    /**
     * @param int $id
     * @return Member|Builder|null
     */
    public function find($id)
    {
        return Member::query()
            ->find($id);
    }

    /**
     * @return Collection|Member[]
     */
    public function all()
    {
        return Member::query()
            ->get();
    }

    /**
     * @param string $email
     * @return Member|null
     */
    public function getByEmail($email)
    {
        return Member::query()
            ->where('email', $email)
            ->first();
    }

    /**
     * @param string $email
     * @return bool
     */
    public function existByEmail($email)
    {
        return Member::query()
            ->where('email', $email)
            ->exists();
    }
}