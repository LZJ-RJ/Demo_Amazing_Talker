@extends('layout')

@section('content')
    <div class="container">
        <h4>These are languages.</h4>
        <table class="table table-bordered">
            <thead>
            <td>id</td>
            <td>slug</td>
            <td>created_at</td>
            <td>updated_at</td>
            </thead>
            <tbody>
            @foreach($languages as $index => $language)
                <tr>
                    <td>{{$language->id}}</td>
                    <td>{{$language->slug}}</td>
                    <td>{{$language->created_at}}</td>
                    <td>{{$language->updated_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{route('languages.create')}}" class="btn btn-info">Language Create</a>
        <a href="{{route('tutors.index')}}" class="btn btn-warning">Tutor List</a>
        <a href="{{url('/')}}" class="btn btn-secondary">Home</a>
    </div>
@endsection
