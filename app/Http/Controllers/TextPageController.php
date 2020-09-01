<?php

namespace App\Http\Controllers;

use App\assigmentPage;
use App\textPage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TextPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create(User $user)
    {
        if (Gate::allows('mentor', $user)) {

            return view('curriculum.create', compact($user));
        } else {
            abort(403);
        }
    }

    public function store(User $user)
    {
        if (Gate::allows('mentor', $user)) {
            $data = request()->validate([
                'title' => 'required',
                'content' => ['required'],
            ]);

            $textPage = new textPage();
            $textPage->title = $data['title'];
            $textPage->text_info = $data['content'];
            $textPage->published = false;
            $textPage->save();

            return redirect('/curriculum/index');
        } else {
            abort(403);
        }
    }

    public function view($textpageID)
    {
        if (Gate::allows('mentor', auth()->user())) {
            $textPage = textPage::find($textpageID);

            return view('curriculum.view', compact('textPage'));
        } else {
            abort(403);
        }
    }

    public function edit($textpageID, Request $request)
    {
        $textPage = textPage::find($textpageID);
        $textPage->published = $request["state"];
        $textPage->save();

        return redirect()->back()->with('message', 'Successfully changed!');
    }

    public function index()
    {
        $textPages = textPage::all();

        return view('curriculum.curriculumIndex', compact('textPages'));
    }

}
