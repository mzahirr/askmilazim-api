<?php namespace App\Controller\Site;

use App\Controller\MainController;
use App\Module\Site\LoginModule;

class LoginController extends MainController
{
    /**
     * @Inject
     * @var LoginModule
     */
    private $module;

    public function Login()
    {
        return $this->json($this->module->Login($this->getParsedBody()));
    }
}
