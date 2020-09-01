<?php

namespace App\Http\Controllers;


use App\assignmentPage;
use App\User;
use App\user_Submission_Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(User $user){
        if (Gate::allows('mentor', $user)) {

            return view('assignment.create',compact($user));

        } else {
            abort(403);

        }
    }

    public function index(){
        $assignments = assignmentPage::all();

        return view('assignment.index', compact('assignments'));
    }

    public function store(User $user){
        if (Gate::allows('mentor', $user)) {

            $data = request()->validate([
                'title' => 'required',
                'question' => 'required',
                'maxScore' => ['required','numeric','min:2']
            ]);

            $assignment = new assignmentPage();
            $assignment->title = $data['title'];
            $assignment->question = $data['question'];
            $assignment->max_score = $data['maxScore'];
            $assignment->published = false;
            $assignment->save();

            return redirect('/assignment/index');

        } else {
            abort(403);

        }
    }

    public function view($assignmentID){
        try {
            $assignment = assignmentPage::find($assignmentID);
            $submission_array = user_Submission_Score::firstOrFail()
                ->where('user_id', auth()->user()->getKey())
                ->where('assignment_id', '=',$assignmentID)
                ->get();
            if(sizeof($submission_array) != 0){ // found the submission for the assignment
                $submission = $submission_array[0];
            }else {
                throw new ModelNotFoundException;
            }
            return view('assignment.view', compact('assignment','submission'));
        } catch (ModelNotFoundException $e) {
            $submission = new user_Submission_Score();
            $submission->user_id = 0; //temporary solution
            return view('assignment.view', compact('assignment','submission'));
        }
    }

    public function edit($assignmentID, Request $request){
        $assignment = assignmentPage::find($assignmentID);
        $assignment->published = $request["state"];
        $assignment->save();

        return redirect('/assignment/'.$assignmentID)->with('message', 'Successfully changed!');
    }

    public function submitAnswer(Request $request, $assignment){
        $data = request()->validate([
            'answer' => 'required'
        ]);

        $submission = new user_Submission_Score();
        $submission->user_id = auth()->user()->id;
        $submission->assignment_id = $assignment;
        $submission->answer = $data['answer'];
        $submission->save();

        return redirect()->back()->with('message', 'Successfully submitted!');
    }
}
