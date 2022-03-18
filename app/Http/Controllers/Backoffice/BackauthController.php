<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackauthController extends Controller
{
    //
    public function login ()
    {
        // return 'teste';
        return view ('backoffice.login');
    }
    public function home ()
    {
        // dd(Auth::user());
        return 'teste';
    }
}
