@extends('layouts.default')
@section('title')
    {{__('Edit Role')}}<a href="{{ route('roles.index') }}"
                          class="btn btn-outline-primary btn-sm">{{__('Role List')}}</a>
@endsection
@section('content')
    <form action="{{route('roles.update',$role->id)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group mb-3">
            <label for="name">Role Name:</label>
            <div class="mt-3">
                <input type="text" name="name" class="form-control @error('name')is-invalid @enderror"
                       value="{{$role->name}}">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        @foreach(config('abilities') as $code => $label)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="{{$code}}" name="abilities[]"
                       @if(in_array($code,$role->abilities)) checked @endif>
                <label class="form-check-label">
                    {{$label}}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
