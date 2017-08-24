<?php namespace App\Module\Site;

use App\Base\Module;
use App\Exception\BadRequestException;
use App\Repo\MemberLoginTokenRepo;
use App\Repo\MemberRepo;
use App\Repo\ProfessionRepo;
use App\Repo\ProvinceRepo;
use App\Table\Member;
use App\Table\MemberLoginToken;
use App\Table\Profession;
use App\Table\Province;
use Carbon\Carbon;

class GuestModule extends Module
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

    /**
     * @Inject
     * @var MemberRepo
     */
    private $memberRepo;

    /**
     * @Inject
     * @var MemberLoginTokenRepo
     */
    private $memberLoginTokenRepo;

    public function Index()
    {
        return [
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
        ];
    }

    public function Login($data)
    {
        // Request
        $userEmail = isset($data['email']) ? $data['email'] : null;
        $password = isset($data['password']) ? $data['password'] : null;

        // Validation
        if (empty($userEmail)) {
            throw new BadRequestException('Lütfen E-posta adresini giriniz.');
        }

        if (empty($password)) {
            throw new BadRequestException('Lütfen şifrenizi giriniz.');
        }

        if (null === ($member = $this->memberRepo->getByEmail($userEmail))) {
            throw new BadRequestException('Belirtilen kullanıcı bulunamadı.');
        }

        if ( ! password_verify($password, $member->password)) {
            throw new BadRequestException('Şifre yanlış');
        }

        // Transaction
        do {
            $token = md5(md5(uniqid()));
        } while ($this->memberLoginTokenRepo->existByToken($token));

        $loginToken = new MemberLoginToken();
        $loginToken->token = $token;
        $loginToken->member_id = $member->id;
        $loginToken->save();

        return [
            'message' => 'Giriş başarılı',
            'member'  => [
                'id'    => $member->id,
                'name'  => $member->name,
                'email' => $member->email
            ],
            'token'   => $loginToken->token
        ];
    }

    public function Register($data)
    {
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $gender = $data['gender'] ?? null;
        $birthDate = $data['birth_day'] ?? null;
        $cityId = $data['city'] ?? null;
        $provinceId = $data['state'] ?? null;
        $professionId = $data['profession'] ?? null;
        $maritalStatus = $data['maritalStatus'] ?? null;
        // validations

        //E-Posta alanı boş geçilemez
        if (empty($email)) {
            throw new BadRequestException('E-Posta alanı boş geçilemez.');
        }

        //Şifre alanı boş geçilemez
        if (empty($password)) {
            throw new BadRequestException('Şifre alanı boş geçilemez.');
        }

        //E-Posta alanı boş geçilemez
        if (empty($gender)) {
            throw new BadRequestException('Cinsiyet alanı boş geçilemez.');
        }

        //todo:şimdilik kaldırıldı frontend problemi çözülünce eklenecek
        //E-Posta alanı boş geçilemez
        //if (empty($birthDate)) {
        //    throw new BadRequestException('Doğum tarihi alanı boş geçilemez.');
        //}

        //E-Posta alanı boş geçilemez
        if (empty($cityId)) {
            throw new BadRequestException('İl alanı boş geçilemez.');
        }

        //E-Posta alanı boş geçilemez
        if (empty($provinceId)) {
            throw new BadRequestException('İlçe alanı boş geçilemez.');
        }
        //E-Posta alanı boş geçilemez
        if (empty($professionId)) {
            throw new BadRequestException('Meslek alanı boş geçilemez.');
        }

        //E-Posta alanı boş geçilemez
        if (is_null($maritalStatus)) {
            throw new BadRequestException('Medeni durum alanı boş geçilemez.');
        }

        if ($this->memberRepo->existByEmail($email)) {
            throw new BadRequestException('Bu E-Posta ile daha önce kayıt olunmuş.');
        }

        //Kayıt işlemleri

        $member = new Member();

        $member->email = $email;
        $member->password = password_hash($password, PASSWORD_DEFAULT);
        $member->gender = $gender;
        $member->birth_date = Carbon::now()->toDateTimeString();
        $member->city_id = $cityId;
        $member->province_id = $provinceId;
        $member->profession_id = $professionId;
        $member->marital_status = $maritalStatus;
        $member->activation_token = md5(uniqid());

        $member->save();

        return [
            'message' => 'Kayıt başarılı',
            'member'  => [
                'id'    => $member->id,
                'name'  => $member->name,
                'email' => $member->email
            ]
        ];

    }
}