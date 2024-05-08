@extends('template')

@section('title', 'Home')
    
@section('content')
    @include('navbar')
    <div class="container mt-5">
        <h1 class="mb-4">Add Question</h1>
        <form action="">
            <div class="row">
                <label for="question" class="col-sm-2 col-form-label">Question</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="question" rows="10"></textarea>
                </div>
            </div>
            <div class="row mt-3">
                <label for="programming-language" class="col-sm-2 col-form-label">Programming Language</label>
                <div class="col-sm-10">
                    <select class="form-select" id="programming-language">
                        <option selected>Select Language</option>
                        @foreach ($languages as $lang)
                            <option value="{{$lang->id}}">{{$lang->programming_language_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary float-end">Add Question</button>
                </div>
            </div>
        </form>
    </div>
@endsection