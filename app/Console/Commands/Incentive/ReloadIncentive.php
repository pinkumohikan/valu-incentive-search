<?php

namespace App\Console\Commands\Incentive;

use App\Jobs\LoadIncentive;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Peanut\ValuIncentive\DisplayPermission;
use Peanut\ValuOwner\ValuOwner;

class Reload extends Command
{
    private const DELAY_SECOND = 2;

    protected $signature = 'incentive:reload';

    protected $description = '優待データを再取り込みする';

    public function handle()
    {
        \Log::info('[Command=incentive:reload] Reload reservation start.');

        $permissions = DisplayPermission::all();

        $permissions->each(function (DisplayPermission $permission, int $index) {
            $valuOwner = $permission->valuOwner;
            assert($valuOwner instanceof ValuOwner);

            $reservedAt = Carbon::now()->addSecond(self::DELAY_SECOND * $index);
            dispatch(new LoadIncentive($valuOwner))->delay($reservedAt);
        });

        \Log::info('[Command=incentive:reload] Reload reservation finish.', ['count' => $permissions->count()]);
    }
}
