<?php

namespace App\Http\Controllers;

use App\Jobs\LoadIncentive;
use Illuminate\Http\Request;
use Peanut\Valu\NotFoundException;
use Peanut\Valu\OwnerLoader;
use Peanut\ValuIncentive\DisplayPermission;
use Peanut\ValuOwner\ValuOwner;

class DisplayPermissionController
{
    const MAX_USER_ID_LENGTH = 50;

    public function create(Request $request)
    {
        $valuUserId = $request->input('user_id');
        if (!$valuUserId || strlen($valuUserId) >= self::MAX_USER_ID_LENGTH) {
            return response()->json([
                'status' => 'error',
                'error'  => 'fucking input',
            ], 400);
        }

        $loader = resolve(OwnerLoader::class);
        assert($loader instanceof OwnerLoader);

        $valuOwner = ValuOwner::where('valu_user_id', $valuUserId)->first();
        if (is_null($valuOwner)) {
            try {
                $valuOwner = $loader->load($valuUserId);
            } catch (NotFoundException $e) {
                return response()->json([
                    'status' => 'error',
                    'error'  => 'valu user not found',
                ], 400);
            }
        }

        if (!$valuOwner->displayPermission) {
            DisplayPermission::create([
                'valu_owner_id' => $valuOwner->id,
                'ip_address'    => $_SERVER['REMOTE_ADDR'],
                'user_agent'    => $_SERVER['HTTP_USER_AGENT'],
            ]);
        }

        dispatch(new LoadIncentive($valuOwner));

        return response()->json([
            'status' => 'ok',
        ]);
    }
}