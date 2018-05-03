<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController
{
    public function show(Request $_)
    {
        return view('index');
    }
}