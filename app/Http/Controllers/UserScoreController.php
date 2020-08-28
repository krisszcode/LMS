<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserScoreController extends Controller
{
    public function index() {

        $scores = DB::table('assignment_pages')
            ->join('user__submission__scores', 'assignment_pages.id', '=', 'user__submission__scores.assignment_id')
            ->select('assignment_pages.title','assignment_pages.max_score','user__submission__scores.*')
            ->where('user__submission__scores.user_id', '=', auth()->user()->id)
            ->get();





        return view('userScore.index', compact('scores'));
    }
}
