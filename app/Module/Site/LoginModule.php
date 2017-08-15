<?php namespace App\Module\Site;

use App\Contract\Repo\UserContract;
use App\Contract\Repo\UserLoginTokenContract;
use App\Exception\BadRequestException;
use App\Table\User;
use App\Table\UserLoginToken;

class LoginModule
{

    /**
     * @Inject
     * @var UserContract
     */
    private $userRepo;

    /**
     * @Inject
     * @var UserLoginTokenContract
     */
    private $userLoginTokenRepo;


    public function generateToken($data)
    {
        // Request
        $userEmail = isset($data['email']) ? $data['email'] : null;
        $password = isset($data['password']) ? $data['password'] : null;

        // Validation
        if (null === ($user = $this->userRepo->getByEmail($userEmail))) {
            throw new BadRequestException('Belirtilen kullanıcı bulunamadı.');
        }

        if (!password_verify($password, $user->password)) {
            throw new BadRequestException('The password is not correct');
        }

        // Transaction
        do {
            $token = md5(uniqid());
        } while ($this->userLoginTokenRepo->existByToken($token));

        $userLoginToken = new UserLoginToken();
        $userLoginToken->token = $this->getUniqueToken($user);
        $userLoginToken->user_id = $user->id;
        $userLoginToken->save();

        return [
            'message' => 'Giriş başarılı',
            'member' => [
                'id' => $user->id,
                'name' => $user->name,
                'token' => $userLoginToken->token
            ],
        ];
    }

    /**
     * @param User $user
     * @return string
     */
    private function getUniqueToken(User $user)
    {
        $token = md5($user->name . uniqid());
        if ($this->userLoginTokenRepo->existByToken($token)) {
            return $this->getUniqueToken($user);
        }

        return $token;
    }
}