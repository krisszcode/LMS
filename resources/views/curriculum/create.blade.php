@extends('layouts.app')

@section('content')
<div class="container">
    @can('mentor')
        <form action="/curriculum" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row">
                        <h1>Add New Curriculum Text Page</h1>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label"> Page Title</label>

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
                        <label for="content" class="col-md-4 col-form-label"> Page Body</label>

                        <textarea id="content"
                               type="textarea"
                               class="form-control @error('content') is-invalid @enderror"
                               name="content"
                               value="{{ old('content') }}"
                               autocomplete="content" autofocus ></textarea>

                        @error('content')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
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
