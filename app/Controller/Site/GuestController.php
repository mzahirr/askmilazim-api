<?php namespace App\Controller\Site;

use App\Base\Controller;
use App\Module\Site\GuestModule;

class GuestController extends Controller
{
    /**
     * @Inject
     * @var GuestModule
     */
    private $module;

    public function Index()
    {
        return $this->json($this->module->Index());
    }

    public function Login()
    {
        return $this->json($this->module->Login($this->getParsedBody()));
    }

    public function register()
    {
        return $this->json($this->module->Register($this->getParsedBody()));
    }
}