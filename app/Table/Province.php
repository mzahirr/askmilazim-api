<?php namespace App\Table;

use App\Base\Table;
use Carbon\Carbon;

/**
 * @property int id
 * @property string label
 * @property int plate_code
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Province extends Table
{
    protected $table = 'provinces';
}
