@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('successmessage'))
        <div class="alert alert-success">{{session()->get('successmessage')}}</div>
        @elseif(session()->has('dangermessage'))
        <div class="alert alert-danger">{{session()->get('dangermessage')}}</div>
        @elseif(session()->has('failedmessage'))
        <div class="alert alert-danger">{{session()->get('failedmessage')}}</div>
        @endif
        <form method="POST" action="/attendance/store">
            @csrf
        @if($date == null)
        <label for="date">Date:</label>
            <input type="date" id="date" name="date"

                min="2020-08-01" max="" class="@error('title') is-invalid @enderror">    <hr> <br>
                @error('date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
         @else
         <label for="date">Date:</label>
         <input type="date" id="date" name="date"
                value="{{$date}}"
                min="2020-08-01" max="{{$date}}" class="@error('title') is-invalid @enderror">    <hr> <br>
                @error('date')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
        @endif
    <h3>Students:</h3>
        @if($users == null)
            <p>No students</p>
            @else
            @foreach ($users as $user)
                {{$user->name}} <input type="checkbox" id="checkbox" value="{{$user->id}}" name="checkbox"><br>
            @endforeach
        @endif
        <input type="submit" id="submit-date" class="checked">
    </form>
    <hr>
    <h3>Verified student(s) that day:</h3>
    <div id="verifiedStudents"></div>

    </div>
@endsection
