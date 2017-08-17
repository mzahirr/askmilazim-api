<?php namespace App\Table;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property string remember_token
 * @property string activation_token
 * @property string forgot_token
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property int activated
 * @property int gender
 * @property Carbon birth_date
 * @property int city_id
 * @property int province_id
 * @property int profession_id
 * @property int marital_status
 */
class Member extends Model
{

}
