<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
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

    public function view(Request $request)
    {
        $user = Auth::user();
        if($request->method()=="POST"){
            if($request->input('form_type')=="reminders_form"){
                $user->enable_reminders = 0;
                if($request->has('enable_reminders')){
                    $user->enable_reminders = 1;
                }
                $user->notify_before = $request->input('notify_before');
                $user->save();
            }
        }
        return view('pages.profile', [
            'user' => $user
        ]);
    }

    public function viewLockscreen(){
        return view("pages.lockscreen");
    }
}
