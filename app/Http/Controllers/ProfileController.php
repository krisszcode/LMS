<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use function Sodium\compare;


class ProfileController extends Controller
{
    public function show(User $user){
        return view('profile.show', compact('user'));
    }

    public function edit(User $user){

        $user = User::findOrFail($user->id);

        if (Gate::denies('update', $user)) {
            abort(403);
        }
        return view('profile.edit', compact('user'));
    }
}
