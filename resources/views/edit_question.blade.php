@extends('template')

@section('title', 'Edit Question')
    
@section('content')
    @include('navbar')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Question</h1>
        <form action="/edit-post/{{$question->id}}" method="post">
            @csrf
            <div class="row">
                <label for="question" class="col-sm-2 col-form-label">Question</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="question" rows="10" name="question">{{$question->post_content}}</textarea>
                </div>
            </div>
            <div class="row mt-3">
                <label for="programming-language" class="col-sm-2 col-form-label">Programming Language</label>
                <div class="col-sm-10">
                    <select class="form-select" id="programming-language" name="language">
                        <option selected>Select Language</option>
                        @foreach ($languages as $lang)
                            @if ($lang->id == $question->programmingLanguage->id)
                                <option value="{{$lang->id}}" selected>{{$lang->programming_language_name}}</option>
                            @else
                                <option value="{{$lang->id}}">{{$lang->programming_language_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary float-end">Edit Question</button>
                </div>
            </div>
        </form>
    </div>
@endsection