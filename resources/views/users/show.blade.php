@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
           @foreach($users as $user)
               <div class="pb-4 w-100">
                   <div class="card">
                       <h1 class="card-header w-100" style="background-color: lightblue">{{$user->name}}</h1>
                       <div class="card-body float-left" style="background-color: azure">
                           <strong>Email:</strong>
                           <p>{{$user->email}}</p>
                           <hr>
                           <strong>Role:</strong>
                           <p>{{$user->roles}}</p>
                       </div>
                   </div>
               </div>
            @endforeach
            {{$users->links()}}
        </div>
    </div>
@endsection
