@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Textpages:</h2>
        @can('student')
            @if(sizeof($textPages) > 0)
                @foreach($textPages as $textpage)
                    @if($textpage->published == 1)
                    <div class="card text-black-50">
                        <div class="card-header">
                            {{$textpage->title}}
                        </div>
                        <div class="card-body">
                            {{$textpage->text_info}} - {{$textpage->created_at}}
                            @can('mentor')
                                @if($textpage->published == 1)
                                    <p class="align-items-center">State: published</p>
                                @else
                                <p class="align-items-center">State: unpublished</p>
                                @endif
                                    <a href="/textpage/{{$textpage->id}}">
                                        <button class="btn btn-primary btn-dark float-right">Set publicity settings</button>
                                    </a>
                            @endcan
                        </div>
                    </div>
                    @endif
                @endforeach
                <h3>There are unpublished text pages. Stay tuned! :)</h3>
            @else
                <h3>There are no text pages yet.</h3>
            @endif
        @elsecan('mentor')
            @if(sizeof($textPages) > 0)
                @foreach($textPages as $textpage)
                        <div class="card text-black-50">
                            <div class="card-header">
                                {{$textpage->title}}
                            </div>
                            <div class="card-body">
                                {{$textpage->text_info}} - {{$textpage->created_at}}
                                @can('mentor')
                                    @if($textpage->published == 1)
                                        <p class="align-items-center">State: published</p>
                                    @else
                                        <p class="align-items-center">State: unpublished</p>
                                    @endif
                                    <a href="/textpage/{{$textpage->id}}">
                                        <button class="btn btn-primary btn-dark float-right">Set publicity settings</button>
                                    </a>
                                @endcan
                            </div>
                        </div>
                @endforeach
            @else
                <h3>There are no text pages yet.</h3>
            @endif
        @endcan
    </div>
@endsection
