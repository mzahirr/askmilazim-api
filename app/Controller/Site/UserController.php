<?php namespace App\Controller\Site;

use App\Contract\Repo\UserContract;
use App\Controller\MainController;
use App\Table\User;

class UserController extends MainController
{
    /**
     * @Inject
     * @var UserContract
     */
    private $userRepo;

    public function Index()
    {
        return $this->response->withJson(['data' => $this->userRepo->all()->map(function (User $user) {
            return [
                'id' => $user->id,
                'name' => $user->name
            ];
        })]);
    }
}