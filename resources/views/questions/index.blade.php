@extends('layouts.default')
@section('title')
    Questions <a href="{{ route('questions.create') }}" class="btn btn-outline-primary btn-sm">New Question</a>
@endsection
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @endif
    @foreach($questions as $question)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><a
                        href="{{route('questions.show',['question'=>$question->id])}}">{{$question->title}}</a>
                </h5>
                <div class="mb-4 text-muted">
                    @lang('Asked'): {{$question->created_at->diffForHumans()}},
                    {{trans('By')}}By: {{$question->user->name}},
                    {{__('Answers')}} : {{$question->answers_count}}</div>
                <p class="card-text">{{Str::words($question->description,30)}}</p>
                <div>
                    Tags: {{implode(', ',$question->tags->pluck('name')->toArray())}}
                </div>
            </div>
            @if(Auth::id()== $question->user->id)
                <div class="card-footer">
                    <div class="d-flex">
                        <div>
                            <a href="{{route('questions.edit',['question'=>$question->id])}}"
                               class="btn btn-outline-dark btn-sm">Edit</a>
                        </div>
                        <form action="{{route('questions.destroy',['question'=>$question->id])}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
    {{ $questions->withQueryString()->links() }}
@endsection
