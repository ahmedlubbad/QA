<x-dashboard-layout>
{{--    @extends('layouts.default')--}}
    <x-slot name="title">
        <h2 class="mb-4">{{$title}} <a href="/tags/create" class="btn btn-outline-dark btn-xs">Add New</a></h2>
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item">Tags</li>
    </x-slot>
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
            <th>Slug</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{$tag->id}}</td>
                <td><a href="/tags/{{$tag->id}}/edit">{{$tag->name}}</a></td>
                <td>{{$tag->slug}}</td>
                <td>{{$tag->created_at}}</td>
                <td>{{$tag->updated_at}}</td>
                <td>
                    <form method="post" action="/tags/{{$tag->id}}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-small">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-dashboard-layout>
