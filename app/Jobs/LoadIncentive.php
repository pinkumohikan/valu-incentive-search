<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Peanut\Valu\IncentiveLoader;
use Peanut\ValuOwner\ValuOwner;

class LoadIncentive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $valuOwner;

    public function __construct(ValuOwner $owner)
    {
        $this->valuOwner = $owner;
    }

    public function handle(IncentiveLoader $loader)
    {
        \Log::info('[Job=IncentiveLoad] start.', ['valuOwnerId' => $this->valuOwner->id]);

        $loader->load($this->valuOwner);

        \Log::info('[Job=IncentiveLoad] finish.', ['valuOwnerId' => $this->valuOwner->id]);
    }
}
