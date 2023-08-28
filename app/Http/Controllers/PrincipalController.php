<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index()
    {
        /* titulo que será inserido no arquivo head */
        $title = "Home";
        return view('site.principal', compact('title'));
    }
}
