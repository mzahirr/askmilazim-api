<?php namespace App\Controller\Site;

use App\Base\Controller;
use App\Module\Site\MemberModule;

class MemberController extends Controller
{
    /**
     * @Inject
     * @var MemberModule
     */
    private $module;

    public function Index()
    {
        return $this->json($this->module->Index());
    }
}