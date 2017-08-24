<?php namespace App\Repo;

use App\Table\State;
use Illuminate\Database\Eloquent\Collection;

class StateRepo
{
    /**
     * @param int $id
     * @return State|null
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
     * @param int $provinceId
     * @return Collection|State[]
     */
    public function items($provinceId)
    {
        $query = State::query();

        if ( ! empty($provinceId)) {
            $query->where('province_id', $provinceId);
        }

        return $query->get();
    }
}