<?php

namespace App\Http\Controllers;

use App\user_Submission_Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function index(){

        //check if logged in

        $submissions = DB::table('assignment_pages')
            ->join('user__submission__scores', 'assignment_pages.id', '=', 'user__submission__scores.assignment_id')
            ->join('users','user__submission__scores.user_id','=','users.id')
            ->select('assignment_pages.title','user__submission__scores.answer','users.name','user__submission__scores.id')
            ->where('user__submission__scores.user_id', '=', auth()->user()->id)
            ->get();

        return view('submissions.index', compact('submissions'));
    }

    public function update(Request $request, $submissionID){
        $data = request()->validate([
            'score' => ['required','numeric','min:1']
        ]);

        $submission = user_Submission_Score::find($submissionID);
        $submission->student_score = $data['score'];
        $submission->save();

        //view ifes szerkezet még mindig nem jó + a message mindegyik form végén megjelenik


        return redirect()->back()->with('message', 'Successfully submitted score!');
    }
}
