<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use function Sodium\compare;



class ProfileController extends Controller
{
    public function show(User $user){
        return view('profile.show', compact('user'));
    }

    public function edit(User $user){

        if (Gate::allows('ownProfile', $user)) {

            $roles = ['mentor','student']; // contains the roles of the CC

            return view('profile.edit', compact('user','roles'));
        } else {
            abort(403);
        }
    }

    public function update(Request $request){
        $data = request()->validate([
            'name' => 'required',
            'roles' => ''
        ]);

        $user = User::find(Auth::user()->id);
        $user->name = $data['name'];
        $user->roles = $data['roles'];
        $user->save();

        return redirect("/profile/{$user->id}");
    }

}
