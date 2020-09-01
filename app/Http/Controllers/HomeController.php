<?php

namespace App\Http\Controllers;

use App\assignmentPage;
use App\textPage;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * @return Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $textPages = textPage::latest()->paginate(3);
        $assignments = assignmentPage::latest()->paginate(3);
        return view('users.index', compact('user', 'textPages', 'assignments'));
    }
}
