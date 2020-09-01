@extends('layouts.app')

@section('content')
    <div class="container">
        @can('ownProfile',$user)
        <a class="btn btn-primary float-right" href="/profile/{{$user->id}}/edit">
            Edit Profile
        </a>
        @endcan
        <div class="row align-items-center">
            <div class="float-left">
                <h1 class="pb-2">Profile</h1>
                <hr>
                <h3>{{$user->name}}</h3>
                <div class="pl-3">
                    <p>
                        Email: {{$user->email}}
                    </p>
                    <p>
                        Role: {{$user->roles}}
                    </p>
                    <p>
                        Registered: {{$user->created_at}}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
