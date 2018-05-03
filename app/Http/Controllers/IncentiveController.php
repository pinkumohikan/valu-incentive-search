<?php

namespace App\Http\Controllers;

use Peanut\ValuIncentive\ValuIncentive;

class IncentiveController
{
    public function show(int $id)
    {
        $incentive = ValuIncentive::find($id);
        if (!$incentive) {
            abort(404);
        }

        return view('incentives.index', ['incentive' => $incentive]);
    }
}