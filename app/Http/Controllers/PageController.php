<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(User $user){
        if (Gate::allows('mentor', $user)) {

            return view('curriculum.create',compact($user));

        } else {
            abort(403);

        }
    }

}
