<?php namespace App\Table;

use App\Base\Table;
use Carbon\Carbon;

/**
 * @property int id
 * @property string label
 * @property int province_id
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class State extends Table
{
    protected $table = 'states';
}
