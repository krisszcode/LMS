@extends('layouts.app')

@section('content')
    <div class="container">
        @can('mentor')
            <form action="/assignment" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="row">
                            <h1>Add New Curriculum Assignment</h1>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label">Title</label>

                            <input id="title"
                                   type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   name="title"
                                   value="{{ old('title') }}"
                                   autocomplete="title" autofocus>

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="question" class="col-md-4 col-form-label">Question</label>

                            <textarea id="question"
                                      type="textarea"
                                      class="form-control @error('question') is-invalid @enderror"
                                      name="question"
                                      autocomplete="question" autofocus ></textarea>

                            @error('question')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('question') }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="maxScore" class="col-md-4 col-form-label">Max score</label>

                            <input id="maxScore"
                                      type="number"
                                      class="form-control @error('number') is-invalid @enderror"
                                      name="maxScore" autofocus >

                            @error('maxScore')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('maxScore') }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row pt-4">
                            <button class="btn btn-primary">Send to Publisher</button>
                        </div>
                    </div>
                </div>
            </form>
        @endcan
    </div>
@endsection
