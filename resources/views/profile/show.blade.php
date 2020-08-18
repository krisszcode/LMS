@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Profile:</h1>
            <br><br>
            email: {{$user->email}}<br>
            name: {{$user->name}}<br>
            role: {{$user->roles}}<br>
            <hr>
            *insert edit button here*

        </div>
    </div>
@endsection
