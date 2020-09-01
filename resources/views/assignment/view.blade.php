@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="pb-3 mb-3">You are visiting Assignment:{{$assignment->id}}!</h3>
            <h4>Title:</h4>
            {{$assignment->title}}<br>
            <hr>
            <h4>Question:</h4>
            {{$assignment->question}}<br>
            <hr>
            <h4>published on:</h4>
            {{$assignment->created_at}}<br>
            <hr>
            @can('mentor')
                <h4>State:</h4>
                <form action="/assignment/{{$assignment->id}}/edit" method="post">
                    @csrf
                    <select id="state" class="form-control pb-2 mb-2" name="state">
                        @if($assignment->published == 1)
                            <option value="{{true}}" selected>published</option>
                            <option value="{{false}}" >unpublished</option>
                        @else
                            <option value="{{true}}" >published</option>
                            <option value="{{false}}" selected>unpublished</option>
                        @endif
                    </select>
                    <button type="submit" class="btn btn-primary">Change</button>
                </form>
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            @endcan
            <h4>Max Score:</h4>
            {{$assignment->max_score}}<br>
        @can('student')
                @if(((Auth::user()->id == $submission->user_id)
                &&
                ($submission->assignment_id == $assignment->id)) == false)
                <br>
                <hr>
                <h4>Answer this question:</h4>
                <form action="/assignment/{{$assignment->id}}/submit" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="answer" class="col-md-4 col-form-label">Your answer:</label>

                        <textarea id="answer"
                               type="text"
                               class="form-control @error('answer') is-invalid @enderror"
                               name="answer"
                                  autocomplete="title" autofocus></textarea>
                        @error('answer')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('answer') }}</strong>
                                </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit answer</button>
                </form>
                @if(session()->has('message'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session()->get('message') }}
                    </div>
                @endif
            @else
                <h4 class="pt-4 mt-4">You have submitted an answer!
                    Your score will be visible in the My Scores page.</h4>
            @endif
        @endcan
    </div>
@endsection
