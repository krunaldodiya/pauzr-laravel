<?php

namespace App\Http\Controllers;

use App\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function getSync(Request $request)
    {
        return [
            'changes' => [
                'countries' => [
                    'created' => Country::all(['id', 'name', 'shortname', 'phonecode'])
                ]
            ],
            'timestamp' => Carbon::now()->timestamp
        ];
    }

    public function postSync(Request $request)
    {
        return [
            'timestamp' => Carbon::now()->timestamp
        ];
    }
}
