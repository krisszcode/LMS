@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row flex-column text-center">
        <h1 >Welcome {{$user->name}}</h1>
    </div>
    @can('mentor')
    <div class="row flex-column">
        <div class="text-right">
            <a href="#">
                <button  href="#" class="btn btn-primary " style="width:12%">submissions</button>
            </a>

        </div>

    </div>
    @endcan

</div>
@endsection
