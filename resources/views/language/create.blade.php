@extends('layout')

@section('content')
    <div class="container">
        <h4>If you want to create a language, please just input slug of language and submit the form.</h4>
        <form method="post" action="/languages">
            @csrf
            <input type="text" name="slug" placeholder="Please input slug.">
            <input type="submit" value="submit" class="btn btn-success">
        </form>
        <hr>
        <a href="{{route('languages.index')}}" class="btn btn-info">Language List</a>
        <a href="{{route('tutors.index')}}" class="btn btn-warning">Tutor List</a>
        <a href="{{url('/')}}" class="btn btn-secondary">Home</a>
    </div>
@endsection
