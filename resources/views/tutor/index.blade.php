@extends('layout')

@section('content')
    <div class="container">
        <h4>These are tutors.</h4>
        <table class="table table-bordered">
            <thead>
            <td>id</td>
            <td>slug</td>
            <td>name</td>
            <td>headline</td>
            <td>introduction</td>
            <td>languages</td>
            <td>trial_price</td>
            <td>normal_price</td>
            <td>created_at</td>
            <td>updated_at</td>
            </thead>
            <tbody>
            @foreach($tutors as $index => $tutor)
                <tr>
                    <td>{{$tutor->id}}</td>
                    <td>{{$tutor->slug}}</td>
                    <td>{{$tutor->name}}</td>
                    <td>{{$tutor->headline}}</td>
                    <td>{{$tutor->introduction}}</td>
                    <td> @foreach($tutor->getLanguages($tutor->id) as $slug) {{$slug.' '}}@endforeach</td>
                    <td>{{$tutor->getTrialPrice($tutor->id)}}</td>
                    <td>{{$tutor->getNormalPrice($tutor->id)}}</td>
                    <td>{{$tutor->created_at}}</td>
                    <td>{{$tutor->updated_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{route('tutors.create')}}" class="btn btn-warning">Tutor Create</a>
        <a href="{{route('languages.index')}}" class="btn btn-info">Languages List</a>
        <a href="{{url('/')}}" class="btn btn-secondary">Home</a>
    </div>
@endsection
