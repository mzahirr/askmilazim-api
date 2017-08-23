<?php namespace App\Contract\Repo;

use App\Table\Profession;
use Illuminate\Database\Eloquent\Collection;

interface ProfessionContract
{
    /**
     * @param int $id
     * @return null|Profession
     */
    public function find($id);

    /**
     * @return Collection|Profession
     */
    public function all();

}