@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      @foreach($submissions as $submission)
        <div class="card pb-4 mb-4">
            <div class="card-body">
                Student: {{$submission->name}}<br>
                <hr>
                Assignment: {{$submission->title}}<br>
                Student answer: {{$submission->answer}}<br>
                <p>Max score for this assignment: {{$submission->max_score}}</p>
                <hr>
                <form action="/submission/{{$submission->id}}/grade" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="score" class=" col-form-label text-md-right">{{ __('Score') }}</label>

                        <div class="col-md-6">
                            <input style="width: 90px" id="score" type="number" name="score">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="pl-5 col-md-6">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endsection
