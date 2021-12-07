@extends('layouts.default')
@section('content')
    <h2>{{$title}}</h2>
    <form action="{{'/tags'}}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Tag Name:</label>
            <div class="mt-3">
                <input type="text" name="name" value="{{old('name')}}"
                       class="form-control @error('name')is-invalid @enderror">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
