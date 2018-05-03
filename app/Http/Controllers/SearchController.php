<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Peanut\ValuIncentive\Finder;

class SearchController
{
    const MAX_KEYWORD_LENGTH = 50;

    public function search(Request $request, Finder $finder)
    {
        $keyword = $request->keyword;
        if (!$keyword || mb_strlen($keyword) >= self::MAX_KEYWORD_LENGTH) {
            return redirect('/');
        }

        return view('search', [
            'keyword'         => $keyword,
            'foundIncentives' => $finder->findByKeyword($keyword),
        ]);
    }
}