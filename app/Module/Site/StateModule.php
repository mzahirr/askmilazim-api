<?php namespace App\Module\Site;

use App\Contract\Repo\StateContract;
use App\Exception\BadRequestException;
use App\Table\State;

class StateModule
{

    /**
     * @Inject
     * @var StateContract
     */
    private $stateRepo;

    public function getStateByCityId($cityId)
    {
        // Request
        if (empty($cityId)) {
            throw new BadRequestException('Şehir id alanı gereklidir.');
        }

        return $this->stateRepo->getByCityId($cityId)->map(function (State $state) {
            return [
                'id' => $state->id,
                'label' => $state->label
            ];
        });
    }
}