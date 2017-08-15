<?php namespace App\Controller\Site;

use App\Controller\MainController;
use App\Module\Site\LoginModule;

class LoginController extends MainController
{


    /**
     * @Inject
     * @var LoginModule
     */
    private $loginModule;

    public function generateToken()
    {
        return $this->loginModule->generateToken($this->getParsedBody());
    }
}
