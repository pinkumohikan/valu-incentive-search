<?php

namespace Peanut\ValuOwner;

use Illuminate\Database\Eloquent\Model;

class ValuOwner extends Model
{
    protected $fillable = [
        'valu_user_id',
        'name',
        'watcher_count',
        'job',
        'self_introduction',
        'icon_url',
        'created_at',
        'updated_at',
    ];

    public function incentives()
    {
        return $this->hasMany(ValuIncentive::class);
    }

    public function displayPermission()
    {
        return $this->hasOne(DisplayPermission::class);
    }
}