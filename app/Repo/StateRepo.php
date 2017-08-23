<?php namespace App\Repo;

use App\Contract\Repo\StateContract;
use App\Table\State;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class StateRepo implements StateContract
{
    /**
     * @param int $id
     * @return State|Builder|null
     */
    public function find($id)
    {
        return State::query()
            ->find($id);
    }

    /**
     * @return Collection|State[]
     */
    public function all()
    {
        return State::query()
            ->get();
    }

    /**
     * @param int $cityId
     * @return State
     */
    public function getByCityId($cityId)
    {
        return State::query()
            ->where('province_id' , $cityId)
            ->get();
    }
}