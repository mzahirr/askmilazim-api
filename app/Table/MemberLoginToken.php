<?php namespace App\Table;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int member_id
 * @property string token
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property Member member
 */
class MemberLoginToken extends Model
{
    /**
     * @return BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
