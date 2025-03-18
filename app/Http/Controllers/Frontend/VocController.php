<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VocController extends Controller
{
    function voc(Request $request)
    {
        return view('frontend.voc');
    }
}
