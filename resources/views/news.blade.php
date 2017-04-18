@extends('layouts.app')

@section('title')
    News &ndash; @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div id="news-panel" class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">News</h3>
                </div>
                <div class="panel-body">
                    @if(!empty($news) && count($news) > 0)
                        @foreach($news as $singleNews)
                            <h3><a href="{{route('show-news',$singleNews->slug)}}">{{$singleNews->name}}</a></h3>
                            <small>by <a href="/user/{{$singleNews->user->id}}">{{$singleNews->user->name}}</a>
                                on {{$singleNews->created_at}}</small>
                            <p>{{str_limit($singleNews->content)}}</p>
                        @endforeach
                        <a href="{{route('add-news')}}" class="btn btn-primary">Add</a>
                        <div class="text-center">
                            {{$news->links()}}
                        </div>
                    @else
                        <a href="{{route('add-news')}}" class="btn btn-primary">Add</a>
                        <p>Empty here.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection