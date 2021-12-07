@extends('layouts.default')
@section('title')
    {{__('Questions')}} <a href="{{ route('questions.create') }}"
                           class="btn btn-outline-primary btn-sm">{{__('New Question')}}</a>
@endsection

@section('content')

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{$question->title}}</h5>
            <div class="mb-4 text-muted">{{__('Asked')}}: {{$question->created_at->diffForHumans()}},
                {{__('By')}}: {{$question->user->name}}</div>
            <p class="card-text">{{$question->description}}</p>
            <div>
                {{__('Tags')}}:
                <ul>
                    @foreach($question->tags as $tag)
                        <li>{{$tag->name.''}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if(Auth::id()== $question->user_id)
            <div class="card-footer">
                <div class="d-flex">
                    <div>
                        <a href="{{route('questions.edit',['question'=>$question->id])}}"
                           class="btn btn-outline-dark btn-sm">{{__('Edit')}}</a>
                    </div>
                    <form action="{{route('questions.destroy',['question'=>$question->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger">{{__('Delete')}}</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
    <section>
        <h3> {{$answers->count()}} {{__('Answers')}}</h3>
        @forelse($answers as $answer)
            <div class="card mb-3">
                <div class="card-body">
                    @if($answer->best_answer == 1)
                        <span class="badge bg-success">{{__('BEST')}}</span>
                    @endif
                    <p class="card-text">{{$answer->description}}</p>
                    <div class="mb-4 text-muted"> {{$answer->created_at->diffForHumans()}},
                        {{__('By')}}: {{$answer->user->name}}</div>
                </div>

                @auth
                    @if($answer->best_answer == 0 && Auth::id() == $question->user_id)
                        <form action="{{ route('answers.best', $answer->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success">{{__('Mark as best answer')}}</button>
                        </form>
                    @endif
                @endauth

                @empty
                    <div class="mb-3">
                        <p>{{__('No answers!')}}</p>
                    </div>
                @endforelse
                @auth
                    <hr>
                    <h4> {{__('Send Your Answer')}}</h4>
                    <form action="{{route('answers.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        <div class="form-group mb-3">
                            <div>
                <textarea name="description" rows="6"
                          class="form-control @error('description') is-invalid @enderror ">{{old('description')}}</textarea>
                                @error('description')
                                <p class="invalid-feedback">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                @endauth
                @guest
                    <a href="{{route('login')}}">{{__('Login to answers !')}}</a>
            @endguest
    </section>
@endsection
