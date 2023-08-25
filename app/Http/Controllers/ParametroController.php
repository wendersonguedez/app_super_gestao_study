<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParametroController extends Controller
{
    public function index(string|int $param1, string|int $param2)
    {
        // return view('site.param', compact('param1', 'param2')); ==> compact
        
        return view('site.param')->with('param1', $param1)->with('param2', $param2);
    }
}
