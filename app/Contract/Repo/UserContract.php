<?php namespace App\Contract\Repo;

use App\Table\User;
use Illuminate\Database\Eloquent\Collection;

interface UserContract
{
    /**
     * @param int $id
     * @return User|null
     */
    public function find($id);

    /**
     * @return Collection|User[]
     */
    public function all();

    /**
     * @param string $email
     * @return User|null
     */
    public function getByEmail($email);
}