@extends('layouts.default')
@section('content')
    <h2>{{$title}}</h2>
    <form action="/tags/{{$tag->id}}" method="post">
        @csrf
        @method('put')
        <div class="form-group mb-3">
            <label for="name">Tag Name:</label>
            <div class="mt-3">
                <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" value="{{$tag->name}}">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
