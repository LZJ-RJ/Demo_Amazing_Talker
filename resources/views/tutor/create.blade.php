@extends('layout')

@section('content')
    <div class="container">
        <h4>If you want to create a language, please just input slug of language and submit the form.</h4>
        <form method="post" action="/tutors">
            @csrf
            <div class="form-group">
                <label for="slug">slug*</label>
                <input type="text" name="slug" id="slug" placeholder="Please input slug.">
            </div>
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" id="name" placeholder="Please input name.">
            </div>
            <div class="form-group">
                <label for="headline">headline</label>
                <input type="text" name="headline" id="headline" placeholder="Please input headline.">
            </div>
            <div class="form-group">
                <label for="introduction">introduction</label>
                <input type="text" name="introduction" id="introduction" placeholder="Please input introduction.">
            </div>
            <div class="form-group">
                <label for="trial_price">trial_price</label>
                <input type="number" name="trial_price" placeholder="Please input trial_price.">
            </div>
            <div class="form-group">
                <label for="normal_price">normal_price</label>
                <input type="number" name="normal_price" placeholder="Please input normal_price.">
            </div>
            <div class="form-group">
                <label for="languages">languages</label>
                <select name="languages[]" id="languages" class="languages" multiple="multiple">
                    <option value="none" disabled>未選擇</option>
                    @foreach($languages as $language)
                        <option value="{{$language->id}}">{{$language->slug}}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="submit" class="btn btn-success">
        </form>
        <hr>
        <a href="{{route('tutors.index')}}" class="btn btn-warning">Tutor List</a>
        <a href="{{route('languages.index')}}" class="btn btn-info">Language List</a>
        <a href="{{url('/')}}" class="btn btn-secondary">Home</a>

    </div>
@endsection
