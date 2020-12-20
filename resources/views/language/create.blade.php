@extends('layout')

@section('content')
    <div class="container">
        <h4>If you want to create a language, please just input slug of language and submit the form.</h4>
        <form method="post" action="/languages">
            @csrf
            <input type="text" name="slug" placeholder="Please input slug.">
            <input type="submit" value="submit" class="btn btn-success">
        </form>
        <a href="{{route('languages.index')}}" class="btn btn-info">List</a>
    </div>
@endsection
