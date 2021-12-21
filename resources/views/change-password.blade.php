@extends('layouts.default')

@section('title', 'Edit Profile')

@section('content')

    <div class="row">
        <div class="col-md-9">
            <form action="{{ route('password.change') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="password">{{__("Current Password")}}</label>
                    <div>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                               name="current_password">
                        @error('current_password')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="name">{{__("New Password")}}</label>
                    <div>
                        <input type="password" class="form-control @error('last_name') is-invalid @enderror"
                               name="password">
                        @error('password')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="email">{{__("Confirm Password")}}</label>
                    <div>
                        <input type="password" class="form-control @error('email') is-invalid @enderror"
                               name="password_confirmation">
                        @error('password_confirmation')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{__("Update Profile")}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection


{{--@extends('layouts.default')--}}

{{--@section('title','Edit Profile')--}}

{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-3">--}}
{{--            <img src="{{asset('storage/'.$user->profile_photo_path)}}" class="img-fluid">--}}
{{--        </div>--}}
{{--        <div class="col-md-9">--}}
{{--            <form action="{{route('profile')}}" method="post" enctype="multipart/form-data">--}}
{{--                @csrf--}}
{{--                @method('put')--}}
{{--                <div class="form-group mb-3">--}}
{{--                    <label for="first_name">First Name</label>--}}
{{--                    <div>--}}
{{--                        <input type="text" name="first_name" value="{{old('first_name',$user->profile->first_name)}}"--}}
{{--                               class="form-control  @error('first_name') is-invalid @enderror ">--}}
{{--                        @error('first_name')--}}
{{--                        <p class="invalid-feedback">{{$message}}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group mb-3">--}}
{{--                    <label for="last_name">Last Name</label>--}}
{{--                    <div>--}}
{{--                        <input type="text" name="last_name" value="{{old('last_name',$user->profile->last_name)}}"--}}
{{--                               class="form-control  @error('last_name') is-invalid @enderror ">--}}
{{--                        @error('last_name')--}}
{{--                        <p class="invalid-feedback">{{$message}}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group mb-3">--}}
{{--                    <label for="birthday">Birthday</label>--}}
{{--                    <div>--}}
{{--                        <input type="date" name="birthday" value="{{old('birthday',$user->profile->birthday)}}"--}}
{{--                               class="form-control  @error('birthday') is-invalid @enderror ">--}}
{{--                        @error('birthday')--}}
{{--                        <p class="invalid-feedback">{{$message}}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group mb-3">--}}
{{--                    <label for="gender">Gender</label>--}}
{{--                    <div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="radio" name="gender" id="gender-male" value="male">--}}
{{--                            <label class="form-check-label" for="gender-male">--}}
{{--                                Male--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="radio" name="gender" id="gender-female"--}}
{{--                                   value="female">--}}
{{--                            <label class="form-check-label" for="gender-female">--}}
{{--                                Female--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        @error('gender')--}}
{{--                        <p class="invalid-feedback">{{$message}}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group mb-3">--}}
{{--                    <label for="email">Email Address</label>--}}
{{--                    <div>--}}
{{--                        <input type="email" name="email" value="{{old('email',$user->email)}}"--}}
{{--                               class="form-control @error('email') is-invalid @enderror" disabled>--}}
{{--                        @error('email')--}}
{{--                        <p class="invalid-feedback">{{$message}}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group mb-3">--}}
{{--                    <label for="profile_photo">Profile Photo</label>--}}
{{--                    <div>--}}
{{--                        <input type="file" name="profile_photo"--}}
{{--                               class="form-control @error('profile_photo') is-invalid @enderror ">--}}
{{--                        @error('profile_photo')--}}
{{--                        <p class="invalid-feedback">{{$message}}</p>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="form-group mb-3">--}}
{{--                    <button type="submit" class="btn btn-primary">Update Profile</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
