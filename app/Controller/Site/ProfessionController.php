<?php namespace App\Controller\Site;

use App\Contract\Repo\ProfessionContract;
use App\Controller\MainController;
use App\Table\Profession;

class ProfessionController extends MainController
{
    /**
     * @Inject
     * @var ProfessionContract
     */
    private $professionRepo;

    public function all()
    {
        return $this->response->withJson(['data' => $this->professionRepo->all()->map(function (Profession $profession) {
            return [
                'id' => $profession->id,
                'label' => $profession->label
            ];
        })]);
    }
}