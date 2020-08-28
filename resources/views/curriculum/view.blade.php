@extends('layouts.app')

@section('content')
    <div class="container">
        @can('mentor')
            <h4>Page title:</h4>
           {{$textPage->title}}<br>
            <hr>
           <h4>Page text:</h4>
            {{$textPage->text_info}}<br>
            <hr>
            <h4>Bublished on:</h4>
            {{$textPage->created_at}}<br>
            <hr>
            <h4>State:</h4>
            <form action="/textpage/{{$textPage->id}}/edit" method="post">
                @csrf
            <select id="state" class="form-control pb-2 mb-2" name="state">
                    @if($textPage->published == 1)
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
    </div>
@endsection
