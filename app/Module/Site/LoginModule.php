<?php namespace App\Module\Site;

use App\Contract\Repo\MemberContract;
use App\Contract\Repo\MemberLoginTokenContract;
use App\Contract\Repo\UserLoginTokenContract;
use App\Exception\BadRequestException;
use App\Table\Member;
use App\Table\MemberLoginToken;

class LoginModule
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
    private $memberLoginTokenRepo;


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
            $token = md5(uniqid());
        } while ($this->memberLoginTokenRepo->existByToken($token));

        $loginToken = new MemberLoginToken();
        $loginToken->token = $this->getUniqueToken($member);
        $loginToken->member_id = $member->id;
        $loginToken->save();

        return [
            'message' => 'Giriş başarılı',
            'member'  => [
                'id'    => $member->id,
                'name'  => $member->name,
                'email' => $member->email,
                'token' => $loginToken->token
            ],
        ];
    }

    /**
     * @param Member $member
     * @return string
     */
    private function getUniqueToken($member)
    {
        $token = md5($member->name . uniqid());

        if ($this->memberLoginTokenRepo->existByToken($token)) {
            return $this->getUniqueToken($member);
        }

        return $token;
    }
}