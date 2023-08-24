<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function view()
    {
        $user = Auth::user();
        return view('pages.users.list', [
            'user' => $user
        ]);
    }

    public function createView()
    {
        $user = Auth::user();
        return view('pages.users.create', [
            'user' => $user
        ]);
    }
}
