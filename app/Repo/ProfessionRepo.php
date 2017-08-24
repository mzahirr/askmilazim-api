<?php namespace App\Repo;

use App\Table\Profession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProfessionRepo
{
    /**
     * @param int $id
     * @return Profession|Builder|null
     */
    public function find($id)
    {
        return Profession::query()
            ->find($id);
    }

    /**
     * @return Collection|Profession[]
     */
    public function all()
    {
        return Profession::query()
            ->get();
    }
}