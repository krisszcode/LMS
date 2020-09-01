<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AttendanceController extends Controller
{
    function index(){
        if (Gate::allows('mentor', auth()->user())) {
            try {
                $users = User::firstOrFail()->where('roles', 'student')->get();
                $date = null;


                $attendances = Attendance::all();
                //dd($attendances);

                if(sizeof($users) == 0){
                    throw new ModelNotFoundException();
                }
                return view('attendance.index', compact('users','date'));
            } catch (ModelNotFoundException $e) {
                $users = null;
                $date = null;
                return view('attendance.index', compact('users','date'));
            }
        } else{
            abort(403);
        }
    }


    function store(Request $request){
        if($request['checkbox'] != null){
            $data = request()->validate([
                'date' => 'required|date|before_or_equal:'. date('Y-m-d'),
                'checkbox' => '',
            ]);

            $attendances = Attendance::all();
            $alreadySubmitted = false;
            foreach ($attendances as $attendance) {
                if($attendance->created_at == date('Y-m-d') . " 00:00:00" && $attendance->user_id == $data['checkbox'] ){
                    $alreadySubmitted = true;
                }
            }
            if(!$alreadySubmitted){
                $attendance = new Attendance();
                $attendance->date = $data['date'];
                $attendance->user_id = $data['checkbox'];
                $attendance->created_at = date('Y-m-d');
                $attendance->save();
            }
            if($alreadySubmitted){
                return redirect()->back()->with('failedmessage','This student is already confirmed for this day!');
            }
            return redirect()->back()->with('successmessage','Attendance successfully saved!');
        }
        else{
            return redirect()->back()->with('dangermessage','Please select at least one checkbox!');
        }
    }

    public function getDate(Request $request){
            $date = $request['date'];
            $verifiedUsers = DB::table('users')
            ->join('attendances','attendances.user_id','=','users.id')
            ->select('users.name')
            ->where('attendances.created_at', '=', $date . " 00:00:00")
            ->get();
            return response()->json($verifiedUsers);
    }
}
