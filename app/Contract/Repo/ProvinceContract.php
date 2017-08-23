<?php namespace App\Contract\Repo;

use App\Table\Province;
use Illuminate\Database\Eloquent\Collection;

interface ProvinceContract
{
    /**
     * @param int $id
     * @return Province|null
     */
    public function find($id);

    /**
     * @return Collection|Province[]
     */
    public function all();
}