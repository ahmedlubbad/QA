@extends('layouts.default')
@section('title')
    {{__('Create New Role')}}
@endsection
@section('content')
    <form action="{{route('roles.store')}}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Role Name:</label>
            <div class="mt-3">
                <input type="text" name="name" value="{{old('name')}}"
                       class="form-control @error('name')is-invalid @enderror">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="mt-2">
            @foreach(config('abilities') as $code => $label)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="abilities[]"
                           value="{{$code}}">
                    <label class="form-check-label">
                        {{$label}}
                    </label>
                </div>
            @endforeach
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
