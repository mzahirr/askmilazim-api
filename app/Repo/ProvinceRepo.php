<?php namespace App\Repo;

use App\Table\Province;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProvinceRepo
{
    /**
     * @param int $id
     * @return Province|Builder|null
     */
    public function find($id)
    {
        return Province::query()
            ->find($id);
    }

    /**
     * @return Collection|Province[]
     */
    public function all()
    {
        return Province::query()
            ->get();
    }
}