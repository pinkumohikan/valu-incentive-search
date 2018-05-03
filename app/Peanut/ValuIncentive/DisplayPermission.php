<?php

namespace Peanut\ValuIncentive;

use Illuminate\Database\Eloquent\Model;
use Peanut\ValuOwner\ValuOwner;

class DisplayPermission extends Model
{
    protected $fillable = [
        'valu_owner_id',
        'ip_address',
        'user_agent',
    ];

    public function valuOwner()
    {
        return $this->belongsTo(ValuOwner::class);
    }

    public static function exists(ValuOwner $owner): bool
    {
        return self::where('valu_owner_id', $owner->id)
            ->exists();
    }
}