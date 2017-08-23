<?php namespace App\Contract\Repo;

use App\Table\State;
use Illuminate\Database\Eloquent\Collection;

interface StateContract
{
    /**
     * @param int $id
     * @return null|State
     */
    public function find($id);

    /**
     * @return Collection|State
     */
    public function all();

    /**
     * @param int $cityId
     * @return Collection|State
     */
    public function getByCityId($cityId);
}