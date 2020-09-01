@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row flex-column text-center">
        <h1 class="pb-4 mb-4">Welcome, {{$user->name}}!</h1>
        <hr>
    </div>
    <div>
        <h3>Watch the latest text pages:</h3>
    @if(sizeof($textPages) < 1)
            <h3>There are no text right now... Please stay updated!</h3>
        @else
        @can("mentor")
            @foreach($textPages as $textPage)
                <div class="card">
                    <div class="card-header">
                        {{$textPage->title}}
                    </div>
                    <div class="card-body">
                        {{$textPage->text_info}}
                        <a href="/textpage/{{$textPage->id}}">
                        <button class="btn btn-primary btn-dark float-right">Set publicity settings</button>
                        </a>
                    </div>
                </div>
            @endforeach
            <a href="/curriculum/index">View More...</a>
            @elsecan("student")
                @foreach($textPages as $textPage)
                    @if($textPage->published == 1)
                    <div class="card">
                        <div class="card-header">
                            {{$textPage->title}}
                        </div>
                        <div class="card-body">
                            {{$textPage->text_info}}
                        </div>
                    </div>
                    @endif
                @endforeach
                <h4>There are unpublished text pages. Stay tuned!</h4>
                    <a href="/curriculum/index">View More...</a>
            @endcan
        @endif
    </div>
    <hr>
    <div>
        <h3>Watch the latest assignments:</h3>
        @if(sizeof($assignments) < 1)
            <h3>There are no assignments right now... Please stay updated!</h3>
        @else
            @can("mentor")
                @foreach($assignments as $assignment)
                    <div class="card">
                        <div class="card-header">
                            {{$assignment->title}}
                        </div>
                        <div class="card-body">
                            {{$assignment->question}}
                            <a href="/assignment/{{$assignment->id}}">
                                <button class="btn btn-primary btn-dark float-right">Set publicity settings</button>
                            </a>
                        </div>
                    </div>
                @endforeach
                <a href="/assignment/index">View More...</a>
            @elsecan("student")
                @foreach($assignments as $assignment)
                    @if($assignment->published == 1)
                        <div class="card">
                            <div class="card-header">
                                {{$assignment->title}}
                            </div>
                            <div class="card-body">
                                {{$assignment->question}}
                            </div>
                        </div>
                    @endif
                @endforeach
                <h4>There are unpublished assignment pages. Stay tuned!</h4>
                    <a href="/assignment/index">View More...</a>
            @endcan
        @endif
</div>
@endsection
