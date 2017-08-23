<?php namespace App\Controller\Site;

use App\Contract\Repo\MemberContract;
use App\Controller\MainController;
use App\Module\Site\MemberModule;
use App\Table\Member;

class MemberController extends MainController
{
    /**
     * @Inject
     * @var MemberContract
     */
    private $memberRepo;

    /**
     * @Inject
     * @var MemberModule
     */
    private $memberModule;

    public function Index()
    {
        return $this->response->withJson([
            'data' => $this->memberRepo->all()->map(function (Member $member) {
                return [
                    'id'   => $member->id,
                    'name' => $member->name
                ];
            })
        ]);
    }

    public function register()
    {
        return $this->json($this->memberModule->register($this->getParsedBody()));
    }
}