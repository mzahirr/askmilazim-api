<?php namespace App\Table;

use App\Base\Table;
use Carbon\Carbon;

/**
 * @property int id
 * @property int user_id
 * @property string token
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class UserLoginToken extends Table
{
    protected $table = 'user_login_tokens';
}