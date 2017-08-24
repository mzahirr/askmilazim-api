<?php namespace App\Controller\Site;

use App\Base\Controller;
use App\Module\Site\StateModule;

class StateController extends Controller
{
    /**
     * @Inject
     * @var StateModule
     */
    private $module;

    public function States()
    {
        return $this->json($this->module->States($this->request->getParams()));
    }
}