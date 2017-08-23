<?php namespace App\Table;

use App\Base\Table;
use Carbon\Carbon;

/**
 * @property int id
 * @property string label
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Profession extends Table
{
    protected $table = 'professions';
}
