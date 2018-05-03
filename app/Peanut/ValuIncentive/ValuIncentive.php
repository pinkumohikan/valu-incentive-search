<?php

namespace Peanut\ValuIncentive;

use Illuminate\Database\Eloquent\Model;
use Peanut\ValuOwner\ValuOwner;

class ValuIncentive extends Model
{
    protected $fillable = [
        'valu_owner_id',
        'name',
        'description',
        'condition',
        'registered_at',
        'period_start_at',
        'period_end_at',
        'image_url',
        'thumbnail',
    ];

    public function valuOwner()
    {
        return $this->belongsTo(ValuOwner::class);
    }

    public function store(): self
    {
        return self::updateOrCreate(
            [
                'valu_owner_id'     => $this->valu_owner_id,
                'image_url'         => $this->image_url,
            ],
            $this->toArray()
        );
    }

    // TODO: 実装精査 (過渡期のコードが残ってる?)
    public function getImageUrl(): string
    {
        if ($this->thumbnail) {
            return 'data:image/png;base64,'.$this->thumbnail;
        }

        return $this->image_url;
    }
}