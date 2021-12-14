@extends('layouts.default')

@section('title','New Question')

@section('content')
    <form action="{{route('questions.store')}}" method="post">
        @csrf
        <div class="form-group mb-3">
            <label for="title">{{__('Title')}}</label>
            <div>
                <input type="text" name="title" value="{{old('title')}}"
                       class="form-control  @error('title') is-invalid
                @enderror ">
                @error('title')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>


        <div class="form-group mb-3">
            <label for="title">{{trans('Description')}}</label>
            <div>
                <textarea name="description" rows="6"
                          class="form-control @error('description') is-invalid
                @enderror ">{{old('description')}}</textarea>
                @error('description')
                <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="tags">Tags</label>
            <div>
                @foreach($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}"
                               id="{{$tag->id}}">
                        <label class="form-check-label" for="tag-{{$tag->id}}">
                            {{$tag->name}}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        @error('tag')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Ask Question</button>
        </div>
    </form>
@endsection
