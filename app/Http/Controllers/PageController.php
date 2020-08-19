<?php

namespace App\Http\Controllers;

use App\assigmentPage;
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

    public function store(User $user){
        if (Gate::allows('mentor', $user)) {

            $data = request()->validate([
                'title' => 'required',
                'content' => ['required'],
            ]);


            auth()->user()->page()->create([
                'title' => $data['title'],
                'content' => $data['content'],
            ]);

            return redirect('/curriculum');

        } else {
            abort(403);

        }
    }



}
