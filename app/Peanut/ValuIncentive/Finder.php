<?php

namespace Peanut\ValuIncentive;

use Illuminate\Support\Collection;

class Finder
{
    public function findNewly(int $limit = 10)
    {
        return ValuIncentive::join('display_permissions', 'valu_incentives.valu_owner_id', 'display_permissions.valu_owner_id')
            ->orderByDesc('valu_incentives.created_at')
            ->take($limit)
            ->select('valu_incentives.*')
            ->get();
    }

    public function findPopular()
    {
        $valuOwnerIds = ValuIncentive::join('display_permissions', 'valu_incentives.valu_owner_id', 'display_permissions.valu_owner_id')
            ->join('valu_owners', 'valu_incentives.valu_owner_id', 'valu_owners.id')
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
            ->orWhere('description', 'like', '%'.$keyword.'%')
            ->select('valu_incentives.*')
            ->take(50)
            ->get();
    }

    public function findPeriodEndNearly()
    {
        return ValuIncentive::join('display_permissions', 'valu_incentives.valu_owner_id', 'display_permissions.valu_owner_id')
            ->orderBy('valu_incentives.period_end_at')
            ->select('valu_incentives.*')
            ->take(10)
            ->get();
    }

    public function countIncentives()
    {
        return ValuIncentive::join('display_permissions', 'valu_incentives.valu_owner_id', 'display_permissions.valu_owner_id')
            ->count();
    }

    private function findLatestByOnwerIds(Collection $ownerIds): Collection
    {
        $found = collect();

        $ownerIds->each(function (int $ownerId) use ($found) {
            $incentive = ValuIncentive::where('valu_owner_id', $ownerId)
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