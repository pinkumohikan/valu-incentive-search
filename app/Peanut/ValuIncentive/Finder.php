<?php

namespace Peanut\ValuIncentive;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Finder
{
    public function findNewly(int $limit = 10)
    {
        return ValuIncentive::join('display_permissions', 'valu_incentives.valu_owner_id', 'display_permissions.valu_owner_id')
            ->where('period_end_at', '>=', Carbon::now())
            ->orderByDesc('valu_incentives.created_at')
            ->take($limit)
            ->select('valu_incentives.*')
            ->get();
    }

    public function findPopular()
    {
        $valuOwnerIds = ValuIncentive::join('display_permissions', 'valu_incentives.valu_owner_id', 'display_permissions.valu_owner_id')
            ->join('valu_owners', 'valu_incentives.valu_owner_id', 'valu_owners.id')
            ->where('period_end_at', '>=', Carbon::now())
            ->orderByDesc('valu_owners.watcher_count')
            ->groupBy('valu_owners.id', 'valu_owners.watcher_count')
            ->select('valu_owners.id')
            ->take(10)
            ->get()
            ->pluck('id');

        return $this->findLatestByOnwerIds($valuOwnerIds);
    }

    public function findByKeyword(string $keyword)
    {
        return ValuIncentive::join('display_permissions', 'valu_incentives.valu_owner_id', 'display_permissions.valu_owner_id')
            ->where('name', 'like', '%'.$keyword.'%')
            ->where('period_end_at', '>=', Carbon::now())
            ->orWhere('description', 'like', '%'.$keyword.'%')
            ->select('valu_incentives.*')
            ->take(50)
            ->get();
    }

    public function findPeriodEndNearly()
    {
        return ValuIncentive::join('display_permissions', 'valu_incentives.valu_owner_id', 'display_permissions.valu_owner_id')
            ->where('period_end_at', '>=', Carbon::now())
            ->orderBy('valu_incentives.period_end_at')
            ->select('valu_incentives.*')
            ->take(10)
            ->get();
    }

    public function countIncentives()
    {
        return ValuIncentive::join('display_permissions', 'valu_incentives.valu_owner_id', 'display_permissions.valu_owner_id')
            ->where('period_end_at', '>=', Carbon::now())
            ->count();
    }

    private function findLatestByOnwerIds(Collection $ownerIds): Collection
    {
        $found = collect();

        $ownerIds->each(function (int $ownerId) use ($found) {
            $incentive = ValuIncentive::where('valu_owner_id', $ownerId)
                ->where('period_end_at', '>=', Carbon::now())
                ->orderBy('created_at')
                ->first();
            if (!$incentive) {
                return;
            }
            $found->push($incentive);
        });

        return $found;
    }
}