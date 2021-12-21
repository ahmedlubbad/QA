<!doctype html>
<html lang="{{App::currentLocale()}}" dir="{{App::currentLocale() == 'ar' ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if(App::currentLocale()=='ar')
        <link rel="stylesheet" href="{{asset('css/bootstrap.rtl.min.css')}}">
    @else
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    @endif
    <link rel="stylesheet" href="{{asset('css/headers.css')}}">
    <title>{{config('app.name')}}</title>
</head>
<body>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                {{--                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">--}}
                {{--                    <use xlink:href="#bootstrap"/>--}}
                {{--                </svg>--}}
                <img src="{{asset('storage/QA.png')}}" class="bi me-2" width="40" height="40" role="img">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="http://localhost:8000/" class="nav-link px-2 link-secondary">Overview</a></li>
                <li><a href="#" class="nav-link px-2 link-dark">Inventory</a></li>
                <li><a href="{{route('notifications')}}" class="nav-link px-2 link-dark">Notifications</a></li>
                <li><a href="{{route('questions.index')}}" class="nav-link px-2 link-dark">Questions</a></li>
                <li><a href="{{route('tags.index')}}" class="nav-link px-2 link-dark">Tags</a></li>
            </ul>

            <form method="get" action="{{route('questions.index')}}" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" name="search" class="form-control" placeholder="{{__('Search')}}..."
                       aria-label="Search">
            </form>

            {{--            mcamara-localization--}}
            <div class="dropdown text-end">
                <a href="#" class="d-block m-2 link-dark text-decoration-none dropdown-toggle" id="locale"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    {{--   {{__('Language')}}   --}}
                    {{LaravelLocalization::getCurrentLocaleNative()}}
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="locale">
                    @foreach(LaravelLocalization::getSupportedLocales() as $code => $locale)
                        <li><a class="dropdown-item"
                               href="{{LaravelLocalization::getLocalizedURL($code)}}">{{$locale['native']}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    @guest
                        <li><a href="{{route('login')}}" class="btn btn-outline-primary btn-sm m-1">{{__('login')}}</a>
                        </li>
                        <li><a href="{{route('register')}}"
                               class="btn btn-outline-primary btn-sm  m-1">{{__('register')}}</a></li>
                    @endguest
                </ul>
            </div>

            @auth()
                <x-notifications-menu/>
            @endauth
            @auth
                <div class="ms-2 dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img
                            src="{{Auth::user()->photo_url}}"
                            width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="{{route('questions.create')}}">{{__('New Question')}}...</a>
                        </li>
                        <li><a class="dropdown-item" href="{{route('profile')}}">{{__('Profile')}}</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @auth
                            <li>
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">{{__('Sign out')}}</button>

                                </form>
                            </li>
                        @endauth
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</header>
<div class="container">
    <header class="mb-4 bg-light">
        <h2>@yield('title', 'Page Title')</h2>
        <hr>
    </header>


    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script>
        const userId = {{Auth::id()}};
    </script>
    <script src="{{asset('js/app.js')}}"></script>
    @yield('content')
    {{--    toast message--}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="notificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="" class="rounded me-2" alt="...">
                <strong class="me-auto" id="notification-title"></strong>
                <small id="notification-time"></small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="notification-body">
            </div>
        </div>
    </div>

</div>
</body>
</html>
