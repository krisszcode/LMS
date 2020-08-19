@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row flex-column text-center">
        <h1 >Welcome {{$user->name}}</h1>
    </div>
    <div class="row flex-column">
        <div class="text-right">
            <a href="/profile/{{$user->id}}">
                <button  href="#" class="btn btn-primary " style="width:12%">Profile</button>
            </a>

        </div>

    </div>


</div>
@endsection
