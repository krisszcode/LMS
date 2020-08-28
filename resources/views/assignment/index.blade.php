@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Assignments:</h2>
        @can('student')
            @if(sizeof($assignments) > 0)
                @foreach($assignments as $assignment)
                    @if($assignment->published == 1)
                    <a href="/assignment/{{$assignment->id}}" class="text-decoration-none text-black-50">
                        <div class="card">
                            <div class="card-header">
                                {{$assignment->title}}
                            </div>
                            <div class="card-body">
                                {{$assignment->question}} - {{$assignment->created_at}} - MaxScore: {{$assignment->max_score}}
                                @can('mentor')
                                    @if($assignment->published == 1)
                                        <p class="align-items-center">State: published</p>
                                    @else
                                        <p class="align-items-center">State: unpublished</p>
                                    @endif
                                    <a href="/assignment/{{$assignment->id}}">
                                        <button class="btn btn-primary btn-dark float-right">Set publicity settings</button>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </a>
                    @endif
                @endforeach
                <h3>There are unpublished assignments. Stay tuned! :)</h3>
            @else
                <h3>There are no assignments yet.</h3>
            @endif
        @elsecan('mentor')
            @if(sizeof($assignments) > 0)
                @foreach($assignments as $assignment)
                        <a href="/assignment/{{$assignment->id}}" class="text-decoration-none text-black-50">
                            <div class="card">
                                <div class="card-header">
                                    {{$assignment->title}}
                                </div>
                                <div class="card-body">
                                    {{$assignment->question}} - {{$assignment->created_at}} - MaxScore: {{$assignment->max_score}}
                                    @can('mentor')
                                        @if($assignment->published == 1)
                                            <p class="align-items-center">State: published</p>
                                        @else
                                            <p class="align-items-center">State: unpublished</p>
                                        @endif
                                        <a href="/assignment/{{$assignment->id}}">
                                            <button class="btn btn-primary btn-dark float-right">Set publicity settings</button>
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </a>
                @endforeach
            @else
                <h3>There are no assignments yet.</h3>
            @endif
        @endcan
    </div>
@endsection
