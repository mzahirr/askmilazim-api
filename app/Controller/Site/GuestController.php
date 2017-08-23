<?php namespace App\Controller\Site;

use App\Base\Controller;
use App\Repo\ProfessionRepo;
use App\Repo\ProvinceRepo;
use App\Table\Profession;
use App\Table\Province;

class GuestController extends Controller
{
    /**
     * @Inject
     * @var ProvinceRepo
     */
    private $provinceRepo;

    /**
     * @Inject
     * @var ProfessionRepo
     */
    private $professionRepo;

    public function Index()
    {
        return $this->json([
            'genders'         => [
                [
                    'id'    => 1,
                    'label' => 'Erkek'
                ],
                [
                    'id'    => 2,
                    'label' => 'Bayan'
                ]
            ],
            'provinces'       => $this->provinceRepo->all()->map(function (Province $province) {
                return [
                    'id'    => $province->id,
                    'label' => $province->label
                ];
            }),
            'professions'     => $this->professionRepo->all()->map(function (Profession $profession) {
                return [
                    'id'    => $profession->id,
                    'label' => $profession->label
                ];
            }),
            'maritalStatuses' => [
                [
                    'id'    => 1,
                    'label' => 'Bekar'
                ],
                [
                    'id'    => 2,
                    'label' => 'Evli'
                ]
            ]
        ]);
    }
}