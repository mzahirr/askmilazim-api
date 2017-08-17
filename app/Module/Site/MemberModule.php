<?php namespace App\Module\Site;

use App\Contract\Repo\MemberContract;
use App\Contract\Repo\MemberLoginTokenContract;
use App\Exception\BadRequestException;
use App\Table\Member;
use App\Table\UserLoginToken;

class MemberModule
{

    /**
     * @Inject
     * @var MemberContract
     */
    private $memberRepo;

    /**
     * @Inject
     * @var MemberLoginTokenContract
     */
    private $memberLoginToken;


    public function generateToken($data)
    {
        // Request
        $userEmail = isset($data['email']) ? $data['email'] : null;
        $password = isset($data['password']) ? $data['password'] : null;

        // Validation
        if (null === ($member = $this->memberRepo->getByEmail($userEmail))) {
            throw new BadRequestException('Belirtilen kullanıcı bulunamadı.');
        }

        if (!password_verify($password, $member->password)) {
            throw new BadRequestException('The password is not correct');
        }

        // Transaction
        do {
            $token = md5(uniqid());
        } while ($this->memberLoginToken->existByToken($token));

        $userLoginToken = new UserLoginToken();
        $userLoginToken->token = $this->getUniqueToken($member);
        $userLoginToken->user_id = $member->id;
        $userLoginToken->save();

        return [
            'message' => 'Giriş başarılı',
            'member' => [
                'id' => $member->id,
                'name' => $member->name,
                'email' => $member->email,
                'token' => $userLoginToken->token
            ],
        ];
    }

    public function register($data)
    {
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $gender = $data['gender'] ?? null;
        $birthDate = $data['birth_day'] ?? null;
        $cityId = $data['city_id'] ?? null;
        $provinceId = $data['province_id'] ?? null;
        $professionId = $data['profession_id'] ?? null;
        $maritalStatus = $data['marital_status'] ?? null;
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

        //E-Posta alanı boş geçilemez
        if (empty($birthDate)) {
            throw new BadRequestException('Doğum tarihi alanı boş geçilemez.');
        }

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
        if (empty($maritalStatus)) {
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
        $member->birth_date =  $birthDate;
        $member->city_id = $cityId;
        $member->province_id = $provinceId;
        $member->profession_id = $professionId;
        $member->marital_status = $maritalStatus;
        $member->activation_token = md5(uniqid());

        $member->save();

        return [
            'message' => 'Kayıt başarılı',
            'member'    => [
                'name' => $member->email
            ]
        ];

    }

    /**
     * @param Member $member
     * @return string
     */
    private function getUniqueToken(Member $member)
    {
        $token = md5($member->name . uniqid());
        if ($this->memberLoginToken->existByToken($token)) {
            return $this->getUniqueToken($member);
        }

        return $token;
    }
}