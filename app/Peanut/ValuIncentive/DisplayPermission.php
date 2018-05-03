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
}