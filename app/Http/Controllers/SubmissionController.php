<?php

namespace App\Http\Controllers;

use App\user_Submission_Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class SubmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if (Gate::allows('mentor', auth()->user())) {
            $submissions = DB::table('assignment_pages')
                ->join('user__submission__scores', 'assignment_pages.id', '=', 'user__submission__scores.assignment_id')
                ->join('users', 'user__submission__scores.user_id', '=', 'users.id')
                ->select('assignment_pages.title','assignment_pages.max_score', 'user__submission__scores.answer', 'users.name', 'user__submission__scores.id')
                ->get();

            return view('submissions.index', compact('submissions'));
        } else{
            abort(403);
        }
    }

    public function update(Request $request, $submissionID){

        $scoreList = DB::table('assignment_pages')
            ->join('user__submission__scores', 'assignment_pages.id', '=', 'user__submission__scores.assignment_id')
            ->select('assignment_pages.max_score')
            ->where('user__submission__scores.id','=',$submissionID)
            ->pluck('assignment_pages.max_score');
        $maxScore = $scoreList[0]; //first element of the list is always the score we need

        $data = request()->validate([
            'score' => 'required|numeric|min:1|max:'. $maxScore
        ]);

        $submission = user_Submission_Score::find($submissionID);
        $submission->student_score = $data['score'];
        $submission->save();

        //if statement is still garbage

        return redirect()->back()->with('message', 'Successfully submitted score!');
    }
}
