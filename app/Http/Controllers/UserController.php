<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
     * User views all the registered users in one page.
     *
     * @return \Illuminate\View\View
     */
    public function show(){
        $users = User::all();
        return view ('users.show', compact('users'));
    }
}
