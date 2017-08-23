<?php namespace App\Controller\Site;

use App\Contract\Repo\ProvinceContract;
use App\Controller\MainController;
use App\Table\Province;
use App\Table\State;

class ProvinceController extends MainController
{
    /**
     * @Inject
     * @var ProvinceContract
     */
    private $provinceRepo;

    public function Index()
    {
        return $this->response->withJson(['data' => $this->provinceRepo->all()->map(function (Province $province) {
            return [
                'id' => $province->id,
                'plate_code' => $province->plate_code,
                'label' => $province->label
            ];
        })]);
    }
}