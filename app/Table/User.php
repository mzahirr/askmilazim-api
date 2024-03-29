<?php namespace App\Table;

use App\Base\Table;
use Carbon\Carbon;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string mobilenumber
 * @property string remember_token
 * @property Carbon deleted_at
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class User extends Table
{
    protected $table = 'users';

    protected $dates = [
        'deleted_at'
    ];
}
