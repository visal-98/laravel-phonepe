<?php

namespace Visal\PhonePe\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PhonePeRedirectController extends Controller
{
    public function success(Request $request)
    {
        return view('phonepe::success');
    }

    public function failure(Request $request)
    {
        return view('phonepe::failure');
    }
}
