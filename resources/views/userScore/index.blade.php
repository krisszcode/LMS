@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Your scores:</h4>
        <hr>
        <br>
        @if(sizeof($scores) < 1)
            <h4>You have no scores yet.</h4>
            <p id="dd" style="text-decoration: #1b4b72;cursor: pointer;color: #1b4b72;font-style: italic;">Why am I seeing this?</p>
            @else
                @foreach($scores as $score)
                    <div class="card">
                        <div class="card-header">
                            Score {{$score->id}}
                        </div>
                        <div class="card-body">
                            Assignment:  {{$score->title}} <br>
                            @if($score->student_score != null)
                            Your points: {{$score->student_score}}/{{$score->max_score}} <br>
                            @else
                                Your points: You have not received a score yet. Stay tuned! <br>
                                @endif
                            Submitted on: {{$score->created_at}} <br>
                        </div>
                    </div>
                    @endforeach
            @endif
    </div>
@endsection
