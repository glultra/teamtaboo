<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LiveController extends Controller
{
    //
    public function test(Request $request)
    {
        event(new \App\Events\ExampleEvent('slaw'));
        return 'data here?';
    }
}
