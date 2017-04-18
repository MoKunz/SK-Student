@extends('layouts.app')

@section('title')
    Add News &ndash; @parent
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <form method="post">
                <div class="form-group">
                    <label for="input-news-name">News Title</label>
                    <input type="text" class="form-control" id="input-news-name" placeholder="News Title">
                </div>
                <div class="form-group">
                    <label for="input-category">Category</label>
                    <select id="input-category" name="category" class="form-control">
                        @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="input-content">Content</label>
                    <textarea rows="10" id="input-content" name="content" class="form-control">Your content here...</textarea>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@endsection