<?php namespace App\Controller\Site;

use App\Controller\MainController;
use App\Module\Site\StateModule;

class StateController extends MainController
{
    /**
     * @Inject
     * @var StateModule
     */
    private $stateModule;

    public function getByCityId($cityId)
    {
        return $this->response->withJson(['data' => $this->stateModule->getStateByCityId($cityId)]);
    }
}