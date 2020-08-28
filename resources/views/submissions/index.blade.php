@extends('layouts.app')

@section('content')
    <div class="container">
      @foreach($submissions as $submission)
        <div class="card pb-4 mb-4">
            <div class="card-body">
                Student: {{$submission->name}}<br>
                <hr>
                Assignment: {{$submission->title}}<br>
                Student answer: {{$submission->answer}}<br>
                <hr>

                <form action="/submission/{{$submission->id}}/grade" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="score" class=" col-form-label text-md-right">{{ __('Score') }}</label>

                        <div class="col-md-6">
                            <input style="width: 90px" id="score" type="number" class="form-control @error('score') is-invalid @enderror" name="score" autofocus>

                            @error('score')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="pl-5 col-md-6">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endsection
