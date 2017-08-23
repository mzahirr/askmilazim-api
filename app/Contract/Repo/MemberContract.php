<?php namespace App\Contract\Repo;

use App\Table\Member;
use Illuminate\Database\Eloquent\Collection;

interface MemberContract
{
    /**
     * @param int $id
     * @return null|Member
     */
    public function find($id);

    /**
     * @return Collection|Member
     */
    public function all();

    /**
     * @param string $email
     * @return null|Member
     */
    public function getByEmail($email);

    /**
     * @param string $email
     * @return bool
     */
    public function existByEmail($email);
}