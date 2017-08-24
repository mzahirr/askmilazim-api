<?php namespace App\Module\Site;

use App\Base\Module;
use App\Repo\StateRepo;
use App\Table\State;

class StateModule extends Module
{
    /**
     * @Inject
     * @var StateRepo
     */
    private $stateRepo;

    public function States($data)
    {
        $provinceId = isset($data['province_id']) ? intval($data['province_id']) : null;

        return $this->stateRepo->items($provinceId)->map(function (State $state) {
            return [
                'id'    => $state->id,
                'label' => $state->label
            ];
        })->toArray();
    }
}