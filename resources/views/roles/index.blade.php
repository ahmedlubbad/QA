@extends('layouts.default')
@section('title')
    {{__('Roles List')}} <a href="{{ route('roles.create') }}"
                       class="btn btn-outline-primary btn-sm">{{__('New Role')}}</a>
@endsection
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td><a href="{{route('roles.edit',$role->id)}}">{{$role->name}}</a></td>
                <td>{{$role->created_at}}</td>
                <td>{{$role->updated_at}}</td>
                <td>
                    <form method="post" action="{{route('roles.destroy',$role->id)}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-small">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
