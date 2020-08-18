@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
           @foreach($users as $user)
               <div>
                   <h1>{{$user->name}}</h1>
                   <p>{{$user->email}}</p>
                   <p>{{$user->roles}}</p>
                   <hr>
               </div>
            @endforeach
        </div>
    </div>
@endsection
