@extends('layouts.app')

@section('title')
    News &ndash; @parent
@endsection

@section('content')
    <div class="container">
        <h3>{{$singleNews->name}}</h3>
        <small>by <a href="/user/{{$singleNews->user->id}}">{{$singleNews->user->name}}</a> on {{$singleNews->created_at}}</small>
        <p>{{$singleNews->content}}</p>
    </div>
@endsection